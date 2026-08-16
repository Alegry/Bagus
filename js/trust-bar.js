document.addEventListener('DOMContentLoaded', function () {

    var items = document.querySelectorAll('.trust-bar-item');
    if (!items.length) return;

    if (!('IntersectionObserver' in window)) {
        items.forEach(function (item) {
            item.classList.add('is-visible');
        });
        return;
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            entry.target.classList.toggle('is-visible', entry.isIntersecting);
        });
    }, {
        threshold: .15,
        rootMargin: '0px 0px -10% 0px'
    });

    items.forEach(function (item) {
        observer.observe(item);
    });

});
