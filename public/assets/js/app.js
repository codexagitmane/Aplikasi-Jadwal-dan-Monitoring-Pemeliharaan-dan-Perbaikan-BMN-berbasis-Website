document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', event => {
        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            event.preventDefault();
        }
    });
});
