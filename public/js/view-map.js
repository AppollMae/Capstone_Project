document.addEventListener('DOMContentLoaded', function () {
        var mapModals = document.querySelectorAll('.modal');

        mapModals.forEach(function (modal) {
            modal.addEventListener('shown.bs.modal', function () {
                var mapContainer = modal.querySelector('[id^="map-"]');

                if (mapContainer && !mapContainer.classList.contains('map-initialized')) {
                    var lat = parseFloat(mapContainer.dataset.lat);
                    var lng = parseFloat(mapContainer.dataset.lng);

                    if (!isNaN(lat) && !isNaN(lng)) {
                        var map = L.map(mapContainer.id).setView([lat, lng], 17);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);

                        // 🟢 Add a visible marker at the location
                        var marker = L.marker([lat, lng]).addTo(map);
                        marker.bindPopup("<b>Selected Location</b>").openPopup();

                        // 🔴 Add a bright, clearly visible radius circle
                        var radius = 150; // radius in meters — adjust to fit your use case
                        L.circle([lat, lng], {
                            color: '#ff0000',          // bright red outline
                            weight: 3,                 // thicker border
                            fillColor: 'rgba(255, 0, 0, 0.25)', // semi-transparent red fill
                            fillOpacity: 0.4,          // visibility of the fill
                            radius: radius             // in meters
                        }).addTo(map);

                        // 🟢 Optional: add text label for clarity
                        var label = L.tooltip({
                            permanent: true,
                            direction: 'top',
                            className: 'radius-label'
                        })
                        .setContent(`<div style="color:#ff0000;font-weight:bold;background:white;padding:3px 6px;border-radius:4px;box-shadow:0 0 4px rgba(0,0,0,0.3);">
                            Radius: ${radius} m
                        </div>`)
                        .setLatLng([lat, lng])
                        .addTo(map);

                        // Mark as initialized
                        mapContainer.classList.add('map-initialized');

                        // Fix map rendering inside modal
                        setTimeout(() => {
                            map.invalidateSize();
                        }, 300);
                    } else {
                        console.error('Invalid coordinates for map:', mapContainer.id);
                    }
                }
            });
        });
    });