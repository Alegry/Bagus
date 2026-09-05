document.addEventListener('DOMContentLoaded', function () {

    var phrases = [
        'Leyendo las etiquetas bajo lupa...',
        'Filtrando el ruido...',
        'Curando lo esencial para ti...',
        'Escuchando lo que tu cuerpo necesita...',
        'Aquí no hay talla única...',
        'Investigando cada activo...',
        'Menos ruido, más claridad...',
        'Bienestar, diseñado para ti...',
        'Alejando el greenwashing...',
        'Preparando tu bioindividualidad...',
        'Bueno. Bello. Excelente. BAGUS.',
        'Cero tóxicos, cero prisa...',
        'Tu ritmo, tu cuerpo, tu bienestar...',
        'Seleccionando con conciencia...',
        'Bienvenida a un espacio sin ruido...'
    ];

    var phraseEl = document.querySelector('.site-preloader-phrase');
    if (phraseEl) {
        phraseEl.textContent = phrases[Math.floor(Math.random() * phrases.length)];
    }

    initPreloaderMark();

});

// Tiempo mínimo que el usuario debe ver la pantalla de carga, sin importar
// qué tan rápido termine de cargar la página.
var PRELOADER_MIN_VISIBLE = 3000;

// Tope duro: el dibujo del logo depende de requestAnimationFrame, y una
// pestaña que pierde el foco justo durante la carga (o una descarga lenta
// del SVG) puede dejar ese loop sin correr — pase lo que pase, el preloader
// no se queda tapando el sitio más de esto. setTimeout no depende de rAF,
// así que corre igual aunque el dibujo se haya trabado.
var PRELOADER_HARD_TIMEOUT = 8000;

function initPreloaderMark() {

    var preloader = document.getElementById('site-preloader');
    var markHost = document.getElementById('site-preloader-mark');
    if (!preloader) return;

    setTimeout(function () {
        hidePreloader(preloader);
    }, PRELOADER_HARD_TIMEOUT);

    if (!markHost || !markHost.getAttribute('data-src') || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        hidePreloaderWhenReady(preloader);
        return;
    }

    fetch(markHost.getAttribute('data-src'))
        .then(function (res) { return res.text(); })
        .then(function (svgText) {
            // El archivo trae encabezado XML/DOCTYPE antes del <svg>; para
            // inyectarlo como innerHTML nos quedamos solo con el <svg>...</svg>.
            markHost.innerHTML = svgText.slice(svgText.indexOf('<svg'));

            // El archivo trae width/height="100%" propios; los sacamos para que
            // el tamaño dependa solo del CSS (evita que un estilo viejo cacheado
            // en otro lado lo deje sin controlar y se vea gigante).
            var svgEl = markHost.querySelector('svg');
            if (svgEl) {
                svgEl.removeAttribute('width');
                svgEl.removeAttribute('height');
            }

            var paths = markHost.querySelectorAll('path');
            if (!paths.length) {
                hidePreloaderWhenReady(preloader);
                return;
            }

            var lengths = [];
            paths.forEach(function (path) {
                var len = path.getTotalLength();
                lengths.push(len);
                path.style.fill = 'none';
                path.style.stroke = 'var(--color-primary)';
                path.style.strokeDasharray = String(len);
                path.style.strokeDashoffset = String(len);
            });

            runDrawAnimation(preloader, paths, lengths);
        })
        .catch(function () {
            hidePreloaderWhenReady(preloader);
        });
}

// Anima el "armado" del logo trazo por trazo, con una velocidad atada a la
// carga real de la página: mientras la página sigue cargando, el progreso se
// acerca a un techo (nunca se completa solo); recién cuando la página ya
// cargó Y pasó el mínimo de PRELOADER_MIN_VISIBLE, el dibujo se deja terminar.
function runDrawAnimation(preloader, paths, lengths) {

    var TAU = 2200;      // ms: qué tan rápido se acerca al techo mientras se espera
    var CEILING = .9;    // progreso máximo mientras la carga real no terminó
    var STAGGER = .32;   // fracción del progreso repartida entre el arranque de cada trazo

    var start = performance.now();
    var loaded = document.readyState === 'complete';
    var current = 0;

    if (!loaded) {
        window.addEventListener('load', function () { loaded = true; }, { once: true });
    }

    function setProgress(global) {
        var count = paths.length;
        for (var i = 0; i < count; i++) {
            var offset = count > 1 ? (i / count) * STAGGER : 0;
            var span = 1 - offset;
            var local = span > 0 ? Math.min(Math.max((global - offset) / span, 0), 1) : 1;
            paths[i].style.strokeDashoffset = String(lengths[i] * (1 - local));
        }
    }

    function frame(now) {
        // Si el tope duro (PRELOADER_HARD_TIMEOUT) ya lo ocultó, no sigue
        // gastando frames en un elemento que ya se está por remover del DOM.
        if (preloader.dataset.hidden) return;

        var elapsed = now - start;
        var finishing = loaded && elapsed >= PRELOADER_MIN_VISIBLE;
        var target = finishing ? 1 : CEILING * (1 - Math.exp(-elapsed / TAU));

        current += (target - current) * .12;
        if (finishing && current > .995) current = 1;

        setProgress(current);

        if (current >= 1) {
            hidePreloader(preloader);
            return;
        }

        requestAnimationFrame(frame);
    }

    requestAnimationFrame(frame);
}

function hidePreloaderWhenReady(preloader) {
    var start = performance.now();

    function done() {
        var wait = Math.max(PRELOADER_MIN_VISIBLE - (performance.now() - start), 0);
        setTimeout(function () { hidePreloader(preloader); }, wait);
    }

    if (document.readyState === 'complete') {
        done();
    } else {
        window.addEventListener('load', done, { once: true });
    }
}

function hidePreloader(preloader) {
    // Idempotente a propósito: puede llegar a llamarse dos veces (el camino
    // normal y el tope duro de PRELOADER_HARD_TIMEOUT de más arriba), y la
    // segunda vez no debe hacer nada.
    if (preloader.dataset.hidden) return;
    preloader.dataset.hidden = '1';

    // Marca en <body> para que otras secciones (ver .hero-title/.hero-subtitle/
    // .hero-ctas en hero.css) puedan animar su entrada recién cuando el
    // preloader se va, en vez de jugarse esa animación mientras todavía está tapada.
    document.body.classList.add('preloader-done');
    preloader.classList.add('is-hidden');
    preloader.addEventListener('transitionend', function () {
        preloader.remove();
    }, { once: true });
}
