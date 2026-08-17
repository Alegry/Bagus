document.addEventListener('DOMContentLoaded', function () {

    var section = document.querySelector('.bagus-blog-preview');
    if (!section) return;

    var cards = Array.prototype.slice.call(section.querySelectorAll('.blog-preview-card'));
    if (!cards.length) return;

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (reduceMotion) {
        cards.forEach(function (card) {
            card.style.opacity = 1;
            card.style.transform = 'none';
        });
        return;
    }

    var STAGGER = .4;
    // Cada tarjeta entra desde un lado distinto (izquierda / abajo /
    // derecha) en vez de subir todas parejo — se nota más "armado a mano"
    // que una cortina o un enfoque de cámara, que son las otras dos.
    var OFFSETS_X = [-40, 0, 40];
    var ROTATE = [-3, 0, 3];

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

            var x = OFFSETS_X[i % OFFSETS_X.length] * (1 - local);
            var rot = ROTATE[i % ROTATE.length] * (1 - local);
            var y = (1 - local) * 40;

            card.style.opacity = local;
            card.style.transform = 'translate(' + x.toFixed(1) + 'px, ' + y.toFixed(1) + 'px) rotate(' + rot.toFixed(2) + 'deg)';
        });
    };

    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();

});
