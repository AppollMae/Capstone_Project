document.addEventListener("DOMContentLoaded", function () {
    const map = L.map("map", { zoomControl: true }).setView(
        [12.8797, 121.774],
        6
    );

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    const searchButton = document.getElementById("search-location");
    const searchField = document.getElementById("address");
    const locationField = document.getElementById("location");
    const radiusInput = document.getElementById("radiusRange");
    const radiusDisplay = document.getElementById("radiusValue");
    const latInput = document.getElementById("latitude");
    const lngInput = document.getElementById("longitude");

    let marker = null;
    let circle = null;

    function updateAddressFromCoords(lat, lng) {
        fetch(
            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
        )
            .then((res) => res.json())
            .then((data) => {
                const display =
                    data?.display_name || `Lat: ${lat}, Lng: ${lng}`;
                searchField.value = display;
                locationField.value = display;
                latInput.value = lat;
                lngInput.value = lng;
            })
            .catch(() => {
                searchField.value = `Lat: ${lat}, Lng: ${lng}`;
                locationField.value = `Lat: ${lat}, Lng: ${lng}`;
                latInput.value = lat;
                lngInput.value = lng;
            });
    }

    function updateRadius() {
        const val = parseInt(radiusInput.value);
        radiusDisplay.textContent = `${val} meters`;
        if (circle) circle.setRadius(val);
    }

    radiusInput.addEventListener("input", updateRadius);

    searchButton.addEventListener("click", function () {
        const query = searchField.value.trim();
        if (!query) return alert("Please enter an address.");

        fetch(
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
                query
            )}`
        )
            .then((res) => res.json())
            .then((data) => {
                if (data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lng = parseFloat(data[0].lon);
                    const radius = parseInt(radiusInput.value);

                    map.setView([lat, lng], 17);

                    if (!marker) {
                        marker = L.marker([lat, lng], {
                            draggable: true,
                        }).addTo(map);
                        marker.on("dragend", function (e) {
                            const pos = e.target.getLatLng();
                            updateAddressFromCoords(pos.lat, pos.lng);
                            if (circle) circle.setLatLng(pos);
                        });
                    } else {
                        marker.setLatLng([lat, lng]);
                    }

                    if (!circle) {
                        circle = L.circle([lat, lng], {
                            color: "red",
                            fillColor: "#f03",
                            fillOpacity: 0.25,
                            radius: radius,
                        }).addTo(map);
                    } else {
                        circle.setLatLng([lat, lng]);
                        circle.setRadius(radius);
                    }

                    latInput.value = lat;
                    lngInput.value = lng;
                    updateAddressFromCoords(lat, lng);
                } else {
                    alert("Location not found.");
                }
            });
    });
});
