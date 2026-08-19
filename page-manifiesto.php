<?php
/**
 * Template Name: Nuestro Manifiesto
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-manifiesto">

    <!-- MANIFIESTO COMPLETO — texto oficial, tal cual, sin parafrasear -->
    <section class="manifiesto-full">
        <div class="container">

            <h1 class="manifiesto-full-title reveal">Nuestro Manifiesto</h1>

            <div class="manifiesto-full-text">
                <p class="reveal">No creemos en las tendencias pasajeras, en las rutinas de veinte pasos, ni en las soluciones milagrosas de "talla única".</p>

                <p class="reveal">Creemos que tu cuerpo es sabio, único y responde a su propio ritmo.</p>

                <p class="reveal">En BAGUS hacemos el trabajo pesado por ti: leemos las etiquetas bajo lupa, investigamos cada activo y seleccionamos solo marcas honestas, limpias y libres de tóxicos. Pero no nos quedamos ahí. Te acompañamos a descifrar lo que tu cuerpo realmente necesita a través de la bioindividualidad.</p>

                <p class="reveal"><span class="manifiesto-line">Menos ruido. Más claridad.</span><span class="manifiesto-line">Bienestar real, diseñado exclusivamente para ti.</span></p>
            </div>
        </div>
    </section>

    <!-- NUESTRA HISTORIA -->
    <section class="manifiesto-history">
        <div class="container manifiesto-history-inner">
            <h2 class="section-title">Nuestra historia</h2>

            <p><em>[Contenido pendiente: por qué nació BAGUS — completar con la historia real de la fundadora antes de publicar.]</em></p>

            <p><em>[Contenido pendiente: qué vacío vio la fundadora en el mercado de bienestar consciente que la llevó a crear BAGUS.]</em></p>

            <p>El nombre "BAGUS" viene del indonesio y significa "bueno, bello, excelente" — una palabra simple para nombrar algo que no debería ser complicado: elegir bien lo que ponemos en y sobre nuestro cuerpo.</p>

            <p><em>[Contenido pendiente: hacia dónde va la marca — visión a futuro de BAGUS.]</em></p>
        </div>
    </section>

    <!-- CIERRE SUAVE -->
    <section class="manifiesto-close">
        <div class="container">
            <a href="<?php echo esc_url( home_url( '/programa-bioindividualidad' ) ); ?>">Conoce el Programa de Bioindividualidad →</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
