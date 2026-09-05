document.addEventListener('DOMContentLoaded', function () {

    var items = document.querySelectorAll('.page-manifiesto .gsap-reveal');
    if (!items.length) return;

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Sin GSAP/ScrollTrigger (CDN caído) o con reduced-motion: los bloques ya
    // son visibles por defecto en CSS (ver .gsap-reveal en manifiesto.css).
    if (reduceMotion || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    items.forEach(function (item) {
        gsap.set(item, { opacity: 0, y: 46 });

        var played = false;
        function play() {
            if (played) return;
            played = true;
            gsap.to(item, { opacity: 1, y: 0, duration: 1.1, ease: 'power3.out', overwrite: true });
        }

        ScrollTrigger.create({
            trigger: item,
            start: 'top 85%',
            once: true,
            onEnter: play
        });

        // Misma red de seguridad que shop-categories.js: si el trigger de
        // scroll no llega a dispararse, el bloque no debe quedar invisible
        // para siempre.
        var safetyObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                safetyObserver.unobserve(item);
                setTimeout(function () {
                    if (played) return;
                    if (parseFloat(getComputedStyle(item).opacity) < 1) {
                        // CSS transition en vez de gsap.to(): no depende del
                        // ticker de GSAP, así que igual funciona si esa parte
                        // es justamente lo que se trabó.
                        played = true;
                        item.style.transition = 'opacity .5s ease, transform .5s ease';
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    } else {
                        play();
                    }
                }, 1500);
            });
        }, { threshold: .15 });
        safetyObserver.observe(item);
    });

});
