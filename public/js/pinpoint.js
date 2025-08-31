document.addEventListener("DOMContentLoaded", function () {
    var draftPermits = window.draftPermits || [];

    // Default coordinates if geocoding fails
    var defaultLat = 10.3157;
    var defaultLng = 123.8854;

    // Remove previous map instance if it exists
    if (window.map) {
        window.map.remove();
    }

    // Initialize the map
    window.map = L.map("map").setView([defaultLat, defaultLng], 16);

    // Add OpenStreetMap tiles
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(window.map);

    var apiKey = "78122c1b953943be9e59fdff73cc1513"; // Replace with your API key

    function addMarker(lat, lng, name) {
        L.marker([lat, lng])
            .addTo(window.map)
            .bindPopup(`<strong>${name}</strong>`);
    }

    draftPermits.forEach(function (draft, index) {
        if (draft.location) {
            fetch(
                `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(
                    draft.location
                )}&key=${apiKey}`
            )
                .then((res) => res.json())
                .then((data) => {
                    if (data.results && data.results.length > 0) {
                        let lat = data.results[0].geometry.lat;
                        let lng = data.results[0].geometry.lng;

                        if (index === 0) {
                            window.map.setView([lat, lng], 16);
                        }

                        addMarker(lat, lng, draft.project_name);
                    } else {
                        console.warn(
                            `Location not found: ${draft.project_name} (${draft.location})`
                        );
                    }
                })
                .catch((err) => console.error(err));
        }
    });
});

var map = L.map("map").setView([10.3526978, 125.0312962], 16);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
}).addTo(map);

// Ensure the map adjusts when screen size or layout changes
function refreshMapSize() {
    setTimeout(() => {
        map.invalidateSize();
    }, 300);
}

window.addEventListener("resize", refreshMapSize);
document.addEventListener("DOMContentLoaded", refreshMapSize);
