document.addEventListener("DOMContentLoaded", function () {
    // Default coordinates (center of the Philippines)
    var defaultLat = 12.8797;
    var defaultLng = 121.7740;

    // Initialize map
    var map = L.map("map").setView([defaultLat, defaultLng], 6);

    // Add OpenStreetMap tiles
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    }).addTo(map);

    // Create a draggable marker at the default position
    var marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    // Default radius (from input)
    var radius = parseInt(document.getElementById("radius").value) || 200;

    // Create a HIGHLY visible red circle
    var circle = L.circle(marker.getLatLng(), {
        radius: radius,
        color: "red",         // Bright red border
        weight: 4,            // Thicker outline
        opacity: 1.0,         // Fully visible border
        fillColor: "#ff0000", // Strong red fill
        fillOpacity: 0.25,    // Slight transparency
    }).addTo(map);

    // 🔹 Function to update position and circle
    function updatePosition(lat, lng) {
        document.getElementById("latitude").value = lat.toFixed(6);
        document.getElementById("longitude").value = lng.toFixed(6);
        circle.setLatLng([lat, lng]);
    }

    // 🔹 When marker is dragged
    marker.on("dragend", function () {
        var pos = marker.getLatLng();
        updatePosition(pos.lat, pos.lng);
    });

    // 🔹 When user clicks on the map
    map.on("click", function (e) {
        marker.setLatLng(e.latlng);
        updatePosition(e.latlng.lat, e.latlng.lng);
    });

    // 🔹 Update radius live when slider moves
    document.getElementById("radiusRange").addEventListener("input", function () {
        var newRadius = parseInt(this.value);
        document.getElementById("radius").value = newRadius; // sync hidden input
        circle.setRadius(newRadius);
    });

    // 🔹 Try to get user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                map.setView([lat, lng], 16);
                marker.setLatLng([lat, lng]);
                updatePosition(lat, lng);
            },
            function () {
                alert("Could not get your location. You can move the marker manually.");
            }
        );
    } else {
        alert("Geolocation is not supported by your browser.");
    }
});
