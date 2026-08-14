<?php
/**
 * Template Name: Preguntas Frecuentes
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-faq">

    <section class="container">

        <?php while ( have_posts() ) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

        <?php endwhile; ?>

        <!--
        TODO (contenido pendiente, ver estructura-sitio-web-bagus.md):
        - Envíos y devoluciones
        - Ingredientes
        - Diferencia entre Guía de Compra (gratuita, por WhatsApp) y Programa (pago)
        -->

    </section>

</main>

<?php get_footer(); ?>
