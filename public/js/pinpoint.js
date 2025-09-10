document.addEventListener("DOMContentLoaded", function () {
    var draftPermits = window.draftPermits || [];

    // Default coordinates (Philippines)
    var defaultLat = 12.8797;
    var defaultLng = 121.7740;

    // Remove previous map if exists
    if (window.map) {
        window.map.remove();
    }

    // Initialize map
    window.map = L.map("map").setView([defaultLat, defaultLng], 6);

    // Add tiles
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "© OpenStreetMap"
    }).addTo(window.map);

    var apiKey = "78122c1b953943be9e59fdff73cc1513"; // Replace with your API key
    var bounds = L.latLngBounds(); // To auto-fit all markers

    function addMarker(lat, lng, name, location) {
        let marker = L.marker([lat, lng]).addTo(window.map);
        marker.bindPopup(`<strong>${name}</strong><br>${location || ""}`);
        bounds.extend([lat, lng]);
    }

    draftPermits.forEach(function (draft) {
        if (draft.latitude && draft.longitude) {
            // Use DB coordinates if available
            addMarker(draft.latitude, draft.longitude, draft.project_name, draft.location);
        } else if (draft.location) {
            // Fallback: Geocode the textual location
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
                        addMarker(lat, lng, draft.project_name, draft.location);
                        window.map.fitBounds(bounds); // Adjust to fit
                    } else {
                        console.warn(`Location not found: ${draft.project_name} (${draft.location})`);
                    }
                })
                .catch((err) => console.error(err));
        }
    });

    // Auto adjust map after all markers loaded
    setTimeout(() => {
        if (bounds.isValid()) {
            window.map.fitBounds(bounds);
        }
    }, 1000);

    // Resize fix
    function refreshMapSize() {
        setTimeout(() => {
            window.map.invalidateSize();
        }, 300);
    }
    window.addEventListener("resize", refreshMapSize);
    refreshMapSize();
});
