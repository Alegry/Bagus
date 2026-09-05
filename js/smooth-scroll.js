document.addEventListener('DOMContentLoaded', function () {

    if (typeof Lenis === 'undefined' || typeof gsap === 'undefined') return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var lenis = new Lenis({
        duration: 1.1,
        smoothWheel: true,
    });

    // Lenis dispara su propio evento "scroll" en cada frame; ScrollTrigger
    // necesita enterarse de esos frames para recalcular sus triggers, si no
    // se desincroniza del scroll real (ver shop-categories.js / manifiesto.js).
    lenis.on('scroll', function () {
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.update();
        }
    });

    // El RAF de Lenis se cuelga del ticker de GSAP (en vez de su propio
    // requestAnimationFrame) para que ambos queden en el mismo reloj.
    gsap.ticker.add(function (time) {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);

    window.bagusLenis = lenis;

    // En una página tan larga como el home (con secciones pineadas de altura
    // en vh), las imágenes lazy y las fuentes web pueden terminar de asentar
    // el layout después de que ScrollTrigger ya calculó sus posiciones. GSAP
    // refresca solo una vez en "load", pero forzar el refresh acá de nuevo
    // (con las fuentes ya confirmadas) evita triggers desalineados.
    window.addEventListener('load', function () {
        if (typeof ScrollTrigger === 'undefined') return;
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(function () { ScrollTrigger.refresh(); });
        } else {
            ScrollTrigger.refresh();
        }
    });

});
