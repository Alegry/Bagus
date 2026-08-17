document.addEventListener('DOMContentLoaded', function () {

    var section = document.querySelector('.bagus-programa-bridge');
    if (!section) return;

    var title = section.querySelector('.section-title');
    var intro = section.querySelector('.section-intro');
    var ctaWrap = section.querySelector('.programa-bridge-cta-wrap');
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var targets = [title, intro, ctaWrap].filter(Boolean);
    if (!targets.length) return;

    if (reduceMotion) {
        targets.forEach(function (el) {
            el.style.opacity = 1;
            el.style.transform = 'none';
            el.style.filter = 'none';
        });
        return;
    }

    // Ventanas escalonadas dentro del progreso general de la sección: el
    // título arranca primero y ocupa la mitad del recorrido; intro y CTA
    // lo siguen con superposición, como en kit-teaser.js (mapRange).
    var windows = [
        { el: title, start: 0, span: .55 },
        { el: intro, start: .3, span: .55 },
        { el: ctaWrap, start: .55, span: .45 }
    ].filter(function (w) { return w.el; });

    var update = function () {
        var rect = section.getBoundingClientRect();
        var vh = window.innerHeight;
        var progress = (vh * .85 - rect.top) / (vh * .7);
        progress = Math.min(Math.max(progress, 0), 1);

        windows.forEach(function (w) {
            var local = w.span > 0 ? Math.min(Math.max((progress - w.start) / w.span, 0), 1) : 1;

            if (w.el === title) {
                var scale = 1.14 - .14 * local;
                var blur = 8 * (1 - local);
                w.el.style.opacity = local;
                w.el.style.transform = 'scale(' + scale.toFixed(3) + ')';
                w.el.style.filter = 'blur(' + blur.toFixed(2) + 'px)';
            } else {
                w.el.style.opacity = local;
                w.el.style.transform = 'translateY(' + ((1 - local) * 26).toFixed(1) + 'px)';
            }
        });
    };

    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();

});
