document.addEventListener('DOMContentLoaded', function () {

    var header = document.querySelector('.header');
    var menuToggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.nav');

    if (!header) return;

    var DEFAULT_THRESHOLD = 80;
    var isHome = document.body.classList.contains('home');
    var scrolledThreshold = DEFAULT_THRESHOLD;

    function computeThreshold() {
        if (isHome) {
            // Sigue transparente/blanco a través de todo el home (hero, trust-bar,
            // categorías, kit-teaser, manifiesto-programa, testimonials);
            // recién al llegar a la sección del blog el header pasa a fondo blanco.
            var lightZoneEnd = document.querySelector('.bagus-blog-preview');
            if (lightZoneEnd) {
                var rect = lightZoneEnd.getBoundingClientRect();
                scrolledThreshold = rect.top + window.scrollY - header.offsetHeight;
                return;
            }
        }
        scrolledThreshold = DEFAULT_THRESHOLD;
    }

    function updateHeader() {
        if (window.scrollY > scrolledThreshold) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    computeThreshold();
    window.addEventListener('load', computeThreshold);
    window.addEventListener('resize', computeThreshold);
    window.addEventListener('scroll', updateHeader, { passive: true });
    updateHeader();

    if (menuToggle && nav) {
        menuToggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('is-open');
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            // Bloquea el scroll de la página de atrás mientras el menú (fixed)
            // está abierto — ver body.nav-open en header.css.
            document.body.classList.toggle('nav-open', isOpen);
        });
    }

    var dropdown = document.querySelector('.nav-dropdown');
    var dropdownToggle = document.querySelector('.nav-dropdown-toggle');

    if (dropdown && dropdownToggle) {
        dropdownToggle.addEventListener('click', function (e) {
            // "Tienda" es un <a> a la tienda: en mobile navega directo (el
            // submenú ya queda siempre visible ahí, ver header.css) y este
            // toggle de abrir/cerrar es solo para el click de escritorio.
            if (window.matchMedia('(max-width: 768px)').matches) {
                return;
            }
            e.preventDefault();
            e.stopPropagation();
            var isOpen = dropdown.classList.toggle('is-open');
            dropdownToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('is-open');
                dropdownToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

});