const input = document.getElementById('documents');
const uploadedDocsPreview = document.getElementById('uploadedDocsPreview');
const docPreviewContainer = document.getElementById('docPreviewContainer');

input.addEventListener('change', function () {
  const files = Array.from(input.files);
  uploadedDocsPreview.innerHTML = ''; // Clear previous content

  if (files.length === 0) {
    uploadedDocsPreview.innerHTML = '<p class="text-muted mb-0">No documents uploaded.</p>';
    return;
  }

  files.forEach(file => {
    const fileType = file.type;
    const fileURL = URL.createObjectURL(file);
    const fileElement = document.createElement('div');
    fileElement.classList.add('border', 'rounded', 'p-2', 'text-center');
    fileElement.style.width = '120px';
    fileElement.style.cursor = 'pointer';

    if (fileType.startsWith('image/')) {
      // 🖼️ Display image thumbnail
      fileElement.innerHTML = `<img src="${fileURL}" class="img-fluid rounded" style="height:100px; object-fit:cover;">`;
    } else if (fileType === 'application/pdf') {
      // 📄 Display PDF icon or preview
      fileElement.innerHTML = `
        <div class="d-flex flex-column align-items-center">
          <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:48px;"></i>
          <small class="text-truncate" style="max-width:100px;">${file.name}</small>
        </div>`;
    } else {
      // ❌ Unsupported file type
      fileElement.innerHTML = `
        <div class="text-center text-muted">
          <i class="bi bi-file-earmark-fill" style="font-size:48px;"></i>
          <small class="text-truncate" style="max-width:100px;">${file.name}</small>
        </div>`;
    }

    // 🖱️ On click -> open modal preview
    fileElement.addEventListener('click', () => {
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

    uploadedDocsPreview.appendChild(fileElement);
  });
});