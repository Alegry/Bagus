<?php
/**
 * Template Name: Comprar por Objetivo
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-comprar-por-objetivo">

    <section class="container">

        <?php while ( have_posts() ) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

        <?php endwhile; ?>

        <!--
        TODO (contenido pendiente, ver estructura-sitio-web-bagus.md):
        - Quiz de 3 preguntas
        - Resultados del quiz mapeados a los 7 kits
        - Kit Primeros Pasos como puerta de entrada de bajo compromiso
        - Grid/detalle de los 7 kits
        -->

    </section>

</main>

<?php get_footer(); ?>
