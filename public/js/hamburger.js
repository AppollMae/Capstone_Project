document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const navbar = document.getElementById('navbarNav');
            if (navbar.classList.contains('show')) {
                new bootstrap.Collapse(navbar).toggle();
            }
        });
    });