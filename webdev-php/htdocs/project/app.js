function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('show');
}

function openModal(id) {
    new bootstrap.Modal(document.getElementById(id)).show();
}

document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('sidebar');
    if (sidebar && sidebar.classList.contains('show') && !sidebar.contains(e.target) && !e.target.closest('.btn-outline-secondary')) {
        sidebar.classList.remove('show');
    }
});

document.querySelectorAll('.table tbody tr').forEach(function(row) {
    row.addEventListener('mouseenter', function() {
        this.style.backgroundColor = '#f8fafc';
    });
    row.addEventListener('mouseleave', function() {
        this.style.backgroundColor = '';
    });
});
