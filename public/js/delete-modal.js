 document.addEventListener('DOMContentLoaded', function () {
        let deleteForm = null;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteDraftModal'));
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        // When user clicks delete button
        document.querySelectorAll('.delete-draft-btn').forEach(button => {
            button.addEventListener('click', function () {
                deleteForm = this.closest('form');
                deleteModal.show();
            });
        });

        // When user confirms deletion
        confirmDeleteBtn.addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    });