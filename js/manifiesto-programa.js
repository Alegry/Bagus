document.addEventListener('DOMContentLoaded', function () {

    var stage = document.querySelector('.manifiesto-programa-stage');
    var section = document.querySelector('.bagus-manifiesto-programa');
    if (!stage || !section) return;

    var layerManifiesto = section.querySelector('.mp-layer--manifiesto');
    var layerPrograma = section.querySelector('.mp-layer--programa');
    var titleManifiesto = layerManifiesto.querySelector('.mp-title');
    var titlePrograma = layerPrograma.querySelector('.mp-title');
    var quote = layerManifiesto.querySelector('.mp-copy');
    var cta = layerManifiesto.querySelector('.mp-cta');
    var ctaPrograma = layerPrograma.querySelector('.mp-cta');

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Parte un título en spans por letra, con un pequeño desfasaje
    // pseudoaleatorio (--gd) para que la ráfaga de glitch (más abajo) no se
    // vea como una ola pareja sino más orgánica.
    function splitLetters(el) {
        var text = el.textContent.trim();
        el.textContent = '';
        el.setAttribute('aria-label', text);
        return text.split('').map(function (char, i) {
            var span = document.createElement('span');
            span.className = 'letter' + (char === ' ' ? ' is-space' : '');
            span.textContent = char === ' ' ? ' ' : char;
            span.setAttribute('aria-hidden', 'true');
            span.style.setProperty('--gd', ((i * 37) % 90) + 'ms');
            el.appendChild(span);
            return span;
        });
    }

    var lettersManifiesto = splitLetters(titleManifiesto);
    var lettersPrograma = splitLetters(titlePrograma);
    var glitchLetters = lettersManifiesto.concat(lettersPrograma);

    // Las letras del programa no tienen su propio armado letra-por-letra
    // (esa entrada la hace todo el .mp-layer--programa vía --mp-p-*, ver
    // update() más abajo) — solo se usan para el golpe de glitch. Sin esto
    // se quedan pegadas al estado inicial de ".mp-title .letter" en el CSS
    // (opacity:0, filter:blur(6px)): el glitch sí las deja visibles porque
    // anima opacity/transform con fill:both, pero nunca toca "filter", así
    // que el blur quedaba ahí para siempre después de la transición.
    lettersPrograma.forEach(function (letter) {
        letter.style.opacity = 1;
        letter.style.transform = 'none';
        letter.style.filter = 'none';
    });

    if (reduceMotion) {
        lettersManifiesto.concat(lettersPrograma).forEach(function (letter) {
            letter.style.opacity = 1;
            letter.style.transform = 'none';
            letter.style.filter = 'none';
        });
        return;
    }

    function clamp01(v) {
        return Math.min(Math.max(v, 0), 1);
    }

    function mapRange(v, inMin, inMax, outMin, outMax) {
        var t = clamp01((v - inMin) / (inMax - inMin));
        return outMin + (outMax - outMin) * t;
    }

    // Arma el título del manifiesto letra por letra, cada una con su propia
    // ventana de progreso dentro de la ventana general del título (igual
    // que el trazo del preloader, ver STAGGER/setProgress en js/preloader.js).
    var TITLE_STAGGER = .35;

    function setTitleLetters(letters, globalProgress) {
        var count = letters.length;
        letters.forEach(function (letter, i) {
            var offset = count > 1 ? (i / count) * TITLE_STAGGER : 0;
            var span = 1 - offset;
            var local = span > 0 ? clamp01((globalProgress - offset) / span) : 1;

            var rotateDir = i % 2 === 0 ? 1 : -1;
            letter.style.opacity = local;
            letter.style.transform = 'translateY(' + (56 * (1 - local)).toFixed(2) + 'px) scale(' + (.55 + .45 * local).toFixed(3) + ') rotate(' + (rotateDir * 16 * (1 - local)).toFixed(2) + 'deg)';
            letter.style.filter = 'blur(' + (6 * (1 - local)).toFixed(2) + 'px)';
        });
    }

    // Ráfaga de glitch: se dispara una sola vez al cruzar GLITCH_AT, en
    // cualquiera de los dos sentidos de scroll — no es continua/scrubbable
    // como el resto, es un golpe puntual justo en el momento del cruce.
    var GLITCH_AT = .58;
    var glitchedSide = null;

    function triggerGlitch() {
        glitchLetters.forEach(function (letter) {
            letter.classList.remove('is-glitching');
            void letter.offsetWidth;
            letter.classList.add('is-glitching');
        });
    }

    var ticking = false;

    function update() {
        var rect = stage.getBoundingClientRect();
        var vh = window.innerHeight;
        var runway = rect.height - vh;
        var progress = runway > 0 ? clamp01(-rect.top / runway) : 0;

        // Fase 1: arma el título letra por letra.
        setTitleLetters(lettersManifiesto, mapRange(progress, 0, .18, 0, 1));

        // Fase 1b: la frase y el botón del manifiesto entran justo después.
        var quoteOpacity = mapRange(progress, .12, .26, 0, 1);
        var quoteY = mapRange(progress, .12, .26, 40, 0);
        var ctaOpacity = mapRange(progress, .20, .32, 0, 1);
        var ctaScale = mapRange(progress, .20, .32, .7, 1);

        // Fase 2 (.32–.40): pausa — todo queda quieto y legible.

        // Fase 3: la marea rosa sube desde abajo y tapa el celeste.
        var tide = mapRange(progress, .34, .88, 0, 118);

        // Fase 3b: el manifiesto se desenfoca y se va; el programa entra.
        var mOpacity = mapRange(progress, .40, .64, 1, 0);
        var mBlur = mapRange(progress, .40, .64, 0, 7);
        var mY = mapRange(progress, .40, .64, 0, -30);
        var mScale = mapRange(progress, .40, .64, 1, 1.06);

        var pOpacity = mapRange(progress, .58, .84, 0, 1);
        var pBlur = mapRange(progress, .58, .84, 7, 0);
        var pY = mapRange(progress, .58, .84, 26, 0);
        var pScale = mapRange(progress, .58, .84, .94, 1);

        var style = section.style;
        style.setProperty('--mp-tide', tide.toFixed(2) + '%');
        style.setProperty('--mp-quote-opacity', quoteOpacity.toFixed(3));
        style.setProperty('--mp-quote-y', quoteY.toFixed(1) + 'px');
        style.setProperty('--mp-btn-opacity', ctaOpacity.toFixed(3));
        style.setProperty('--mp-btn-scale', ctaScale.toFixed(3));
        style.setProperty('--mp-m-opacity', mOpacity.toFixed(3));
        style.setProperty('--mp-m-blur', mBlur.toFixed(2) + 'px');
        style.setProperty('--mp-m-y', mY.toFixed(1) + 'px');
        style.setProperty('--mp-m-scale', mScale.toFixed(3));
        style.setProperty('--mp-p-opacity', pOpacity.toFixed(3));
        style.setProperty('--mp-p-blur', pBlur.toFixed(2) + 'px');
        style.setProperty('--mp-p-y', pY.toFixed(1) + 'px');
        style.setProperty('--mp-p-scale', pScale.toFixed(3));

        var sideNow = progress >= GLITCH_AT;
        if (glitchedSide === null) {
            glitchedSide = sideNow;
        } else if (sideNow !== glitchedSide) {
            glitchedSide = sideNow;
            triggerGlitch();
        }

        // Solo el CTA visible es interactivo/enfocable por teclado.
        cta.tabIndex = sideNow ? -1 : 0;
        cta.setAttribute('aria-hidden', sideNow ? 'true' : 'false');
        ctaPrograma.tabIndex = sideNow ? 0 : -1;
        ctaPrograma.setAttribute('aria-hidden', sideNow ? 'false' : 'true');

        ticking = false;
    }

    function onScrollOrResize() {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScrollOrResize, { passive: true });
    window.addEventListener('resize', onScrollOrResize);
    update();

});
