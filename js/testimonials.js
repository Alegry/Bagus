document.addEventListener('DOMContentLoaded', function () {

    var section = document.querySelector('.bagus-testimonials');
    if (!section) return;

    var cards = Array.prototype.slice.call(section.querySelectorAll('.testimonial-card'));
    if (!cards.length) return;

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (reduceMotion) {
        cards.forEach(function (card) {
            card.style.clipPath = 'inset(0 0 0% 0)';
            card.style.transform = 'none';
        });
        return;
    }

    var STAGGER = .45;

    // Cada columna se "descorre" como una cortina (clip-path) dentro de su
    // propia ventana de progreso, igual técnica que el trazo del preloader
    // y el título de manifiesto-programa — pero aplicada a un wipe vertical
    // en vez de a letras, para que se sienta distinta a las otras secciones.
    var update = function () {
        var rect = section.getBoundingClientRect();
        var vh = window.innerHeight;
        var progress = (vh * .85 - rect.top) / (vh * .6);
        progress = Math.min(Math.max(progress, 0), 1);

        var count = cards.length;
        cards.forEach(function (card, i) {
            var offset = count > 1 ? (i / count) * STAGGER : 0;
            var span = 1 - offset;
            var local = span > 0 ? Math.min(Math.max((progress - offset) / span, 0), 1) : 1;

            card.style.clipPath = 'inset(0 0 ' + ((1 - local) * 100).toFixed(1) + '% 0)';
            card.style.transform = 'translateY(' + ((1 - local) * 22).toFixed(1) + 'px)';
        });
    };

    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();

});
