document.querySelectorAll(".navbar-nav .nav-link").forEach((link) => {
    link.addEventListener("click", () => {
        const navbar = document.getElementById("navbarNav");
        if (navbar.classList.contains("show")) {
            new bootstrap.Collapse(navbar).toggle();
        }
    });
});

// document.querySelectorAll(".dropdown-hover").forEach(function (el) {
//     el.addEventListener("touchstart", function () {
//         let menu = this.querySelector(".dropdown-menu");
//         if (menu) {
//             menu.classList.toggle("show");
//         }
//     });
// });
