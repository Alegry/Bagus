<?php
/**
 * Template Name: Contacto y Envíos
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-contacto">

    <section class="container">

        <?php while ( have_posts() ) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

        <?php endwhile; ?>

        <!--
        TODO (contenido pendiente, ver estructura-sitio-web-bagus.md):
        - WhatsApp
        - Horarios
        - Cobertura de envío en Bucaramanga
        -->

    </section>

</main>

<?php get_footer(); ?>
