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

});

window.addEventListener('load', function () {

    var preloader = document.getElementById('site-preloader');
    if (!preloader) return;

    preloader.classList.add('is-hidden');
    preloader.addEventListener('transitionend', function () {
        preloader.remove();
    }, { once: true });

});
