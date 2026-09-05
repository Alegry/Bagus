document.addEventListener('DOMContentLoaded', function () {

    var cards = document.querySelectorAll('.shop-category-card');
    if (!cards.length) return;

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function revealAll() {
        cards.forEach(function (card) {
            card.classList.add('is-visible');
            card.style.opacity = '';
            card.style.transform = '';
        });
    }

    // Sin GSAP/ScrollTrigger (CDN caído) o con reduced-motion: mostrar todo
    // de una, sin animación.
    if (reduceMotion || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        revealAll();
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    gsap.set(cards, { opacity: 0, y: 48 });

    ScrollTrigger.batch(cards, {
        start: 'top 85%',
        once: true,
        onEnter: function (batch) {
            // El reveal de la imagen (clip-path, ver shop-categories.css) se
            // dispara para todo el batch de una sola vez acá, no adentro de
            // un callback por-tarjeta del stagger de GSAP: ese callback no
            // siempre llega a dispararse para cada tarjeta, y cuando fallaba
            // la tarjeta quedaba en opacity:1 pero con la imagen tapada.
            batch.forEach(function (card) {
                card.classList.add('is-visible');
            });
            gsap.to(batch, {
                opacity: 1,
                y: 0,
                duration: .8,
                ease: 'power3.out',
                stagger: .12,
                overwrite: true
            });
        }
    });

    // Red de seguridad: esta es una home larga con secciones pineadas y
    // scroll suave por Lenis; si por lo que sea el trigger de arriba no
    // llega a dispararse bien, una tarjeta nunca debe quedar invisible para
    // siempre. Un IntersectionObserver aparte revisa cada una por su cuenta
    // y la fuerza a visible si sigue en opacity 0 un rato después de entrar
    // en pantalla.
    var safetyObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var card = entry.target;
            safetyObserver.unobserve(card);
            setTimeout(function () {
                if (parseFloat(getComputedStyle(card).opacity) < 1) {
                    // CSS transition en vez de gsap.to(): no depende del
                    // ticker de GSAP, así que igual funciona si esa parte
                    // es justamente lo que se trabó.
                    card.classList.add('is-visible');
                    card.style.transition = 'opacity .4s ease, transform .4s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            }, 1500);
        });
    }, { threshold: .15 });

    cards.forEach(function (card) {
        safetyObserver.observe(card);
    });

});
