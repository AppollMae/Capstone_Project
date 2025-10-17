document.addEventListener("DOMContentLoaded", function () {
    const radiusRange = document.getElementById("radiusRange");
    const radiusValue = document.getElementById("radiusValue");
    const confirmBtn = document.getElementById("confirmSubmitBtn");
    const finalSubmit = document.getElementById("finalSubmit");
    const form = document.getElementById("permitForm");
    const modalEl = document.getElementById("confirmModal");

    // 🟢 Update radius value live
    radiusRange.addEventListener("input", function () {
        radiusValue.textContent = `${this.value} meters`;
    });

    // 🟢 Handle "Confirm" button click (before submit)
    confirmBtn.addEventListener("click", function () {
        // Fill modal data
        document.getElementById("confirmProjectName").textContent =
            document.getElementById("project_name").value || "N/A";
        document.getElementById("confirmAddress").textContent =
            document.getElementById("address").value || "N/A";
        document.getElementById("confirmLocation").textContent =
            document.getElementById("location").value || "N/A";
        document.getElementById("confirmProjectCost").textContent = parseFloat(
            document.getElementById("project_cost").value || 0
        ).toLocaleString();
        document.getElementById("confirmRadius").textContent =
            document.getElementById("radiusRange").value || "N/A";
        document.getElementById("confirmDescription").textContent =
            document.getElementById("description").value || "N/A";

        // 🟢 Document Previews
        const confirmDocs = document.getElementById("confirmDocuments");
        confirmDocs.innerHTML = ""; // clear previous previews
        const files = document.getElementById("documents").files;

        if (files.length > 0) {
            for (const file of files) {
                const fileType = file.type;
                const preview = document.createElement("div");
                preview.classList.add("text-center");
                preview.style.width = "100px";

                if (fileType.includes("image")) {
                    // 🖼️ Image preview
                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.classList.add("img-thumbnail");
                    img.style.width = "100px";
                    img.style.height = "100px";
                    img.style.objectFit = "cover";
                    img.title = file.name;
                    img.onclick = () => window.open(img.src, "_blank");
                    preview.appendChild(img);
                } else if (fileType === "application/pdf") {
                    // 📄 PDF preview icon + link
                    const pdfIcon = document.createElement("i");
                    pdfIcon.classList.add("bx", "bxs-file-pdf", "text-danger");
                    pdfIcon.style.fontSize = "40px";
                    const name = document.createElement("p");
                    name.classList.add("small", "mb-0", "text-truncate");
                    name.title = file.name;
                    name.textContent = file.name;

                    // open in new tab
                    preview.style.cursor = "pointer";
                    preview.onclick = () => {
                        const blobUrl = URL.createObjectURL(file);
                        window.open(blobUrl, "_blank");
                    };

                    preview.appendChild(pdfIcon);
                    preview.appendChild(name);
                } else {
                    // 📁 Other file types
                    const fileIcon = document.createElement("i");
                    fileIcon.classList.add("bx", "bxs-file", "text-secondary");
                    fileIcon.style.fontSize = "40px";
                    const name = document.createElement("p");
                    name.classList.add("small", "mb-0", "text-truncate");
                    name.textContent = file.name;
                    preview.appendChild(fileIcon);
                    preview.appendChild(name);
                }

                confirmDocs.appendChild(preview);
            }
        } else {
            confirmDocs.innerHTML =
                `<p class="text-muted mb-0">No documents uploaded.</p>`;
        }

        // 🗺️ Map Setup
        const lat = parseFloat(document.getElementById("latitude").value);
        const lng = parseFloat(document.getElementById("longitude").value);
        const radius = parseInt(document.getElementById("radiusRange").value);

        // Show modal
        const modal = new bootstrap.Modal(modalEl);
        modal.show();

        // Initialize map once modal is visible
        modalEl.addEventListener(
            "shown.bs.modal",
            function () {
                const mapContainer = document.getElementById("confirmMap");
                mapContainer.innerHTML = ""; // reset
                mapContainer.removeAttribute("data-initialized");

                const map = L.map(mapContainer).setView(
                    [lat || 12.8797, lng || 121.774],
                    lat && lng ? 16 : 6
                );

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    maxZoom: 19,
                    attribution:
                        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                }).addTo(map);

                if (!isNaN(lat) && !isNaN(lng)) {
                    const marker = L.marker([lat, lng]).addTo(map);
                    marker.bindPopup("<b>Selected Project Location</b>").openPopup();

                    L.circle([lat, lng], {
                        color: "red",
                        fillColor: "#f03",
                        fillOpacity: 0.25,
                        radius: radius || 0,
                    }).addTo(map);
                }

                setTimeout(() => map.invalidateSize(), 400);
            },
            { once: true }
        );
    });

    // 🟢 Submit form on confirmation
    finalSubmit.addEventListener("click", function () {
        form.submit();
    });
});
