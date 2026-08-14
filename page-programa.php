<?php
/**
 * Template Name: Programa de Bioindividualidad
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-programa">

    <section class="container">

        <?php while ( have_posts() ) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

        <?php endwhile; ?>

        <!--
        TODO (contenido pendiente, ver estructura-sitio-web-bagus.md):
        - Qué es y qué no es el Programa (nunca "diagnóstico" ni "tratamiento")
        - Para quién es
        - Las 4 fases: Autoconocimiento → Educación personalizada → Implementación guiada → Autonomía
        - Qué incluye
        - Inversión
        - Testimonios
        - FAQ propio del programa
        - Botón de agendamiento
        - Enlace al consentimiento informado (página Legal)
        -->

    </section>

</main>

<?php get_footer(); ?>
