document.addEventListener('DOMContentLoaded', function () {

    var section = document.querySelector('.bagus-manifiesto-resumen');
    if (!section) return;

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
