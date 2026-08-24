document.addEventListener('DOMContentLoaded', function () {

    var stage = document.querySelector('.kit-teaser-scroll-stage');
    var section = document.querySelector('.bagus-kit-teaser');
    if (!stage || !section) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var ticking = false;

    function clamp01(v) {
        return Math.min(Math.max(v, 0), 1);
    }

    function mapRange(v, inMin, inMax, outMin, outMax) {
        var t = clamp01((v - inMin) / (inMax - inMin));
        return outMin + (outMax - outMin) * t;
    }

    function update() {
        var rect = stage.getBoundingClientRect();
        // Alto de la sección pineada, no window.innerHeight: ver comentario
        // equivalente en js/manifiesto-programa.js.
        var vh = section.getBoundingClientRect().height;
        var runway = rect.height - vh;

        // progress = 0 mientras la sección todavía no llegó a quedar "pegada"
        // arriba del todo; progress = 1 justo cuando el escenario (más alto
        // que la pantalla) terminó de pasar y la sección se despega de nuevo.
        var progress = runway > 0 ? clamp01(-rect.top / runway) : 1;

        // Fase 1: un agujero circular (deja ver el degradado de categorías)
        // se va cerrando desde los bordes/esquinas hacia el centro.
        // -2 en vez de 0: dos stops negativos garantizan que el mask quede
        // 100% opaco en el centro; en 0 quedaba un borde residual de 1% (el
        // "+1%" del CSS) siempre transparente, visible como un punto de color.
        var bgHole = mapRange(progress, 0, .45, 100, -2);

        // Fase 2: recién cuando el fondo terminó, salen signos y texto
        var markOpen = mapRange(progress, .45, .68, -180, -15);
        var markClose = mapRange(progress, .45, .68, 180, 15);
        var markOpacity = mapRange(progress, .45, .6, 0, 1);
        var titleOpacity = mapRange(progress, .55, .75, 0, 1);
        var titleY = mapRange(progress, .55, .75, 32, 0);
        var introOpacity = mapRange(progress, .62, .82, 0, 1);
        var introY = mapRange(progress, .62, .82, 32, 0);
        var ctaOpacity = mapRange(progress, .7, .9, 0, 1);
        var ctaY = mapRange(progress, .7, .9, 32, 0);

        var style = section.style;
        style.setProperty('--kt-bg-hole', bgHole.toFixed(2) + '%');
        style.setProperty('--kt-mark-open-y', markOpen.toFixed(1) + '%');
        style.setProperty('--kt-mark-close-y', markClose.toFixed(1) + '%');
        style.setProperty('--kt-mark-opacity', markOpacity.toFixed(3));
        style.setProperty('--kt-title-opacity', titleOpacity.toFixed(3));
        style.setProperty('--kt-title-y', titleY.toFixed(1) + 'px');
        style.setProperty('--kt-intro-opacity', introOpacity.toFixed(3));
        style.setProperty('--kt-intro-y', introY.toFixed(1) + 'px');
        style.setProperty('--kt-cta-opacity', ctaOpacity.toFixed(3));
        style.setProperty('--kt-cta-y', ctaY.toFixed(1) + 'px');

        ticking = false;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    }, { passive: true });

    window.addEventListener('resize', update);

    update();

});