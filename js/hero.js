document.addEventListener('DOMContentLoaded', function () {

    var hero = document.querySelector('.hero');
    if (!hero) return;

    var root = document.documentElement.style;
    var ticking = false;

    // Valores objetivo del fondo una vez el hero termina de salir de vista
    // (los mismos que usa .bagus-shop-categories como estado final)
    var TARGET = {
        gradX: 30,
        gradY: -20,
        stopSky: 60,
        stopPrimary: 130,
        stopPink: 160
    };

    var BASE = {
        gradX: 0,
        gradY: 0,
        stopSky: 35,
        stopPrimary: 75,
        stopPink: 100
    };

    function lerp(from, to, t) {
        return from + ( to - from ) * t;
    }

    function updateBackground() {
        var rect = hero.getBoundingClientRect();
        var progress = -rect.top / rect.height;
        progress = Math.min( Math.max( progress, 0 ), 1 );

        root.setProperty( '--grad-x', lerp( BASE.gradX, TARGET.gradX, progress ) + '%' );
        root.setProperty( '--grad-y', lerp( BASE.gradY, TARGET.gradY, progress ) + '%' );
        root.setProperty( '--stop-sky', lerp( BASE.stopSky, TARGET.stopSky, progress ) + '%' );
        root.setProperty( '--stop-primary', lerp( BASE.stopPrimary, TARGET.stopPrimary, progress ) + '%' );
        root.setProperty( '--stop-pink', lerp( BASE.stopPink, TARGET.stopPink, progress ) + '%' );

        ticking = false;
    }

    window.addEventListener( 'scroll', function () {
        if ( ! ticking ) {
            window.requestAnimationFrame( updateBackground );
            ticking = true;
        }
    }, { passive: true } );

    updateBackground();

});
