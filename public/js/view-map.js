document.addEventListener("DOMContentLoaded", function () {
    const modals = document.querySelectorAll('[id^="viewMapModal-"]');

    modals.forEach((modal) => {
        modal.addEventListener("shown.bs.modal", function () {
            const mapContainer = modal.querySelector("[id^='map-']");
            if (!mapContainer) return;

            // ✅ Get coordinates and radius from dataset
            const lat = parseFloat(mapContainer.dataset.lat);
            const lng = parseFloat(mapContainer.dataset.lng);
            const radius = parseInt(mapContainer.dataset.radius) || 0;

            // ✅ Prevent re-initialization
            if (mapContainer.dataset.initialized) return;
            mapContainer.dataset.initialized = true;

            // ✅ Initialize map
            const map = L.map(mapContainer).setView([lat, lng], 16);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map);

            // ✅ Add marker
            const marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup("<b>Selected Location</b>").openPopup();

            // ✅ Add dynamic radius circle if radius > 0
            if (radius > 0) {
                const circle = L.circle([lat, lng], {
                    color: "#ff0000",
                    weight: 3,
                    fillColor: "rgba(255, 0, 0, 0.25)",
                    fillOpacity: 0.4,
                    radius: radius,
                }).addTo(map);

                // ✅ Add tooltip label showing radius value
                L.tooltip({
                    permanent: true,
                    direction: "top",
                    className: "radius-label",
                })
                    .setContent(
                        `<div style="color:#ff0000;font-weight:bold;background:white;padding:3px 6px;border-radius:4px;box-shadow:0 0 4px rgba(0,0,0,0.3);">
                            Radius: ${radius} meters
                        </div>`
                    )
                    .setLatLng([lat, lng])
                    .addTo(map);
            }

            // ✅ Fix rendering when modal is shown
            setTimeout(() => {
                map.invalidateSize();
            }, 400);
        });
    });
});