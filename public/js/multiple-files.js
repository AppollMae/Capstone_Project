// 📁 File Upload + Modal Display
// Element references
const fileInput = document.getElementById('documents');
const uploadedDocsPreview = document.getElementById('uploadedDocsPreview');
const confirmDocuments = document.getElementById('confirmDocuments');
const confirmModal = document.getElementById('confirmModal');
const finalSubmitBtn = document.getElementById('finalSubmit');
const docPreviewContainer = document.getElementById('docPreviewContainer');

let filesArray = [];

// 🗂️ Handle multiple file selection
fileInput.addEventListener('change', (event) => {
    const newFiles = Array.from(event.target.files);
    filesArray = filesArray.concat(newFiles);
    fileInput.value = ''; // Reset input
    renderFilePreview(uploadedDocsPreview, true); // show with remove buttons
});

// 🖼️ Render file previews
function renderFilePreview(container, allowRemove = false) {
    container.innerHTML = '';

    if (filesArray.length === 0) {
        container.innerHTML = '<p class="text-muted mb-0">No documents uploaded.</p>';
        return;
    }

    const previewWrapper = document.createElement('div');
    previewWrapper.classList.add('d-flex', 'flex-wrap', 'gap-2', 'justify-content-start');

    filesArray.forEach((file, index) => {
        const fileType = file.type;
        const fileURL = URL.createObjectURL(file);

        const fileDiv = document.createElement('div');
        fileDiv.classList.add('border', 'rounded', 'p-2', 'text-center');
        fileDiv.style.width = '120px';
        fileDiv.style.position = 'relative';
        fileDiv.style.cursor = 'pointer';

        // 🖼️ Show thumbnail or icon
        if (fileType.startsWith('image/')) {
            fileDiv.innerHTML = `<img src="${fileURL}" alt="${file.name}" style="width:100%;height:100px;object-fit:cover;" class="rounded">`;
        } else if (fileType === 'application/pdf') {
            fileDiv.innerHTML = `
                <div class="d-flex flex-column align-items-center">
                    <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:48px;"></i>
                    <small class="text-truncate" style="max-width:100px;">${file.name}</small>
                </div>`;
        } else {
            fileDiv.innerHTML = `
                <div class="text-center text-muted">
                    <i class="bi bi-file-earmark-fill" style="font-size:48px;"></i>
                    <small class="text-truncate" style="max-width:100px;">${file.name}</small>
                </div>`;
        }

        // ❌ Remove button (only if allowed)
        if (allowRemove) {
            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '&times;';
            removeBtn.classList.add('btn', 'btn-sm', 'btn-danger', 'position-absolute');
            removeBtn.style.top = '2px';
            removeBtn.style.right = '5px';
            removeBtn.onclick = (e) => {
                e.stopPropagation(); // prevent triggering preview
                filesArray.splice(index, 1);
                renderFilePreview(uploadedDocsPreview, true);
            };
            fileDiv.appendChild(removeBtn);
        }

        // 🖱️ Click to open modal preview
        fileDiv.addEventListener('click', () => {
            let previewHTML = '';
            if (fileType.startsWith('image/')) {
                previewHTML = `<img src="${fileURL}" class="img-fluid rounded" alt="${file.name}">`;
            } else if (fileType === 'application/pdf') {
                previewHTML = `<iframe src="${fileURL}" width="100%" height="600px" style="border:none;"></iframe>`;
            } else {
                previewHTML = `<p class="text-muted">Preview not available for this file type.</p>`;
            }

            docPreviewContainer.innerHTML = previewHTML;
            const previewModal = new bootstrap.Modal(document.getElementById('docPreviewModal'));
            previewModal.show();
        });

        previewWrapper.appendChild(fileDiv);
    });

    container.appendChild(previewWrapper);
}


// 🧾 Fill confirmation modal with details
if (confirmModal) {
    confirmModal.addEventListener('shown.bs.modal', () => {
        // Render uploaded files inside modal (no remove buttons)
        renderFilePreview(confirmDocuments, false);

        // Populate confirmation fields
        const projectName = document.getElementById('project_name')?.value?.trim();
        const address = document.getElementById('address')?.value?.trim();
        const location = document.getElementById('location')?.value?.trim();
        const projectCost = document.getElementById('project_cost')?.value?.trim();
        const radius = document.getElementById('radiusRange')?.value?.trim();
        const description = document.getElementById('description')?.value?.trim();

        document.getElementById('confirmProjectName').textContent = projectName || 'N/A';
        document.getElementById('confirmAddress').textContent = address || 'N/A';
        document.getElementById('confirmLocation').textContent = location || 'N/A';
        document.getElementById('confirmProjectCost').textContent = projectCost ? `₱${projectCost}` : '₱0';
        document.getElementById('confirmRadius').textContent = radius || '0';
        document.getElementById('confirmDescription').textContent = description || 'N/A';

        // Delay map rendering (if using Leaflet)
        setTimeout(() => {
            initConfirmMap(location, radius);
        }, 300);
    });

    // 🧹 Clean map on close
    confirmModal.addEventListener('hidden.bs.modal', () => {
        const mapContainer = document.getElementById('confirmMap');
        if (mapContainer && mapContainer._leaflet_id) {
            mapContainer._leaflet_id = null;
            mapContainer.innerHTML = "";
        }
    });
}

// 🗺️ Initialize map (Leaflet)

function initConfirmMap(location, radiusValue) {
    const mapContainer = document.getElementById('confirmMap');
    if (!mapContainer) return;

    if (mapContainer._leaflet_id) {
        mapContainer._leaflet_id = null;
        mapContainer.innerHTML = "";
    }

    let latitude = 14.5995, longitude = 120.9842;
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    if (latInput && lngInput) {
        latitude = parseFloat(latInput.value) || latitude;
        longitude = parseFloat(lngInput.value) || longitude;
    }

    const map = L.map(mapContainer).setView([latitude, longitude], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
        .bindPopup(location || 'Project Location')
        .openPopup();

    const radiusMeters = parseFloat(radiusValue) || 0;
    if (radiusMeters > 0) {
        L.circle([latitude, longitude], {
            radius: radiusMeters,
            color: '#007bff',
            fillColor: '#007bff',
            fillOpacity: 0.2,
            weight: 2,
        }).addTo(map);

        map.fitBounds([
            [latitude + 0.01, longitude + 0.01],
            [latitude - 0.01, longitude - 0.01]
        ]);
    }
}

// ✅ Final submission
if (finalSubmitBtn) {
    finalSubmitBtn.addEventListener('click', (e) => {
        e.preventDefault();

        const form = document.getElementById('permitForm');
        const formData = new FormData(form);

        // Append uploaded files
        filesArray.forEach((file) => {
            formData.append('documents[]', file);
        });

        // Disable button while submitting
        finalSubmitBtn.disabled = true;
        finalSubmitBtn.textContent = 'Submitting...';

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
            redirect: 'follow', // follow Laravel redirect
        })
        .then(response => {
            // ✅ If Laravel redirected (after success)
            if (response.redirected) {
                // Redirect to that URL → reloads Blade → shows @if(session('success'))
                window.location.href = response.url;
            } else {
                return response.text();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // 
            finalSubmitBtn.disabled = false;
            finalSubmitBtn.textContent = 'Confirm & Submit';
        });
    });
}
