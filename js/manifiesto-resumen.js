document.addEventListener('DOMContentLoaded', function () {

    var section = document.querySelector('.bagus-manifiesto-resumen');
    if (!section) return;

    var title = section.querySelector('.manifiesto-title');
    var letters = [];

    if (title) {
        var text = title.textContent.trim();
        title.textContent = '';
        title.setAttribute('aria-label', text);

        letters = text.split('').map(function (char) {
            var span = document.createElement('span');
            span.className = 'letter' + (char === ' ' ? ' is-space' : '');
            span.textContent = char === ' ' ? ' ' : char;
            span.setAttribute('aria-hidden', 'true');
            title.appendChild(span);
            return span;
        });
    }

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Arma el título letra por letra exactamente al ritmo del scroll (sin
    // transición CSS de por medio): cada letra tiene su propia ventana de
    // progreso dentro del progreso global, igual que el trazo del preloader
    // (ver STAGGER/setProgress en js/preloader.js). Al scrollear hacia
    // arriba el progreso baja y las letras se deshacen en el mismo orden.
    if (letters.length && !reduceMotion) {
        var STAGGER = .35;

        var setLettersProgress = function (globalProgress) {
            var count = letters.length;
            letters.forEach(function (letter, i) {
                var offset = count > 1 ? (i / count) * STAGGER : 0;
                var span = 1 - offset;
                var local = span > 0 ? Math.min(Math.max((globalProgress - offset) / span, 0), 1) : 1;

                var rotateDir = i % 2 === 0 ? 1 : -1;
                letter.style.opacity = local;
                letter.style.transform = 'translateY(' + (56 * (1 - local)).toFixed(2) + 'px) scale(' + (.55 + .45 * local).toFixed(3) + ') rotate(' + (rotateDir * 16 * (1 - local)).toFixed(2) + 'deg)';
                letter.style.filter = 'blur(' + (6 * (1 - local)).toFixed(2) + 'px)';
            });
        };

        // Se actualiza directo en cada evento de scroll, sin pasar por
        // requestAnimationFrame: si el frame de animación se retrasa (pestaña
        // en segundo plano, scroll con inercia, throttling del navegador),
        // las letras quedaban "congeladas" en el último estado pintado.
        // La ventana (vh * .32) es más corta que la del scroll normal para
        // que el título termine de armarse antes que la frase/botón de abajo.
        var updateLetters = function () {
            var rect = title.getBoundingClientRect();
            var vh = window.innerHeight;
            var progress = (vh * .85 - rect.top) / (vh * .32);
            progress = Math.min(Math.max(progress, 0), 1);
            setLettersProgress(progress);
        };

        window.addEventListener('scroll', updateLetters, { passive: true });
        window.addEventListener('resize', updateLetters);
        updateLetters();
    } else if (letters.length) {
        letters.forEach(function (letter) {
            letter.style.opacity = 1;
            letter.style.transform = 'none';
            letter.style.filter = 'none';
        });
    }

    if (!('IntersectionObserver' in window)) {
        section.classList.add('is-visible');
        return;
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            entry.target.classList.toggle('is-visible', entry.isIntersecting);
        });
    }, {
        threshold: .55,
        rootMargin: '0px 0px -20% 0px'
    });

    observer.observe(section);

});
