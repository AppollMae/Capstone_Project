document.addEventListener("DOMContentLoaded", function () {
    // Initialize map centered roughly in the Philippines (hidden marker initially)
    const map = L.map("map", { zoomControl: true }).setView(
        [12.8797, 121.774],
        6
    );

    // Add OpenStreetMap tiles
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    // Elements
    const searchButton = document.getElementById("search-location");
    const searchField = document.querySelector("#address");
    const locationField = document.querySelector("#location");
    const radiusInput = document.getElementById("radiusRange");
    const radiusDisplay = document.getElementById("radiusValue");

    let marker = null;
    let circle = null;

    // Function: Update radius display live
    radiusInput.addEventListener("input", function () {
        const newRadius = parseInt(this.value);
        if (circle) {
            circle.setRadius(newRadius);
        }
        if (radiusDisplay) radiusDisplay.textContent = newRadius + " meters";
    });

    // Function: Reverse geocode coordinates → address text
    function updateAddressFromCoords(lat, lng) {
        fetch(
            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
        )
            .then((res) => res.json())
            .then((data) => {
                const text =
                    data && data.display_name
                        ? data.display_name
                        : `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
                if (searchField) searchField.value = text;
                if (locationField) locationField.value = text;
            })
            .catch(() => {
                const fallback = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(
                    6
                )}`;
                if (searchField) searchField.value = fallback;
                if (locationField) locationField.value = fallback;
            });
    }

    // 🔍 Search button click
    searchButton?.addEventListener("click", function () {
        const query = searchField.value.trim();
        if (!query) {
            alert("Please enter a location first.");
            return;
        }

        // Use Nominatim API to search for the location
        fetch(
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
                query
            )}`
        )
            .then((res) => res.json())
            .then((data) => {
                if (data && data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lng = parseFloat(data[0].lon);

                    map.setView([lat, lng], 17);

                    // If marker doesn't exist, create it
                    if (!marker) {
                        marker = L.marker([lat, lng], {
                            draggable: true,
                        }).addTo(map);

                        // When dragging ends → update location fields
                        marker.on("dragend", function (e) {
                            const pos = e.target.getLatLng();
                            updateAddressFromCoords(pos.lat, pos.lng);
                            if (circle) circle.setLatLng(pos);
                        });
                    } else {
                        marker.setLatLng([lat, lng]);
                    }

                    // If circle doesn't exist, create it
                    const radius = parseInt(radiusInput.value);
                    if (!circle) {
                        circle = L.circle([lat, lng], {
                            color: "red",
                            fillColor: "#f90c24ff",
                            fillOpacity: 0.25,
                            radius: radius,
                        }).addTo(map);
                    } else {
                        circle.setLatLng([lat, lng]);
                        circle.setRadius(radius);
                    }

                    // Update both fields
                    if (searchField) searchField.value = data[0].display_name;
                    if (locationField)
                        locationField.value = data[0].display_name;

                    setTimeout(() => {
                        map.invalidateSize();
                        circle.bringToFront();
                    }, 500);
                } else {
                    alert("Location not found. Try another address.");
                }
            })
            .catch(() => {
                alert("Error searching for location.");
            });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("radiusRange");
    const radiusValue = document.getElementById("radiusValue");

    function updateSliderColor() {
        const min = parseInt(slider.min);
        const max = parseInt(slider.max);
        const val = parseInt(slider.value);
        const percent = ((val - min) / (max - min)) * 100;

        // ✅ Red progress bar fill
        slider.style.background = `linear-gradient(to right, #dc3545 ${percent}%, #f0f0f0 ${percent}%)`;

        // Update text
        radiusValue.textContent = `${val} meters`;
    }

    updateSliderColor();
    slider.addEventListener("input", updateSliderColor);
});
