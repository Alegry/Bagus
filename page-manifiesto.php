<?php
/**
 * Template Name: Nuestro Manifiesto
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-manifiesto">

    <section class="container">

        <?php while ( have_posts() ) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

        <?php endwhile; ?>

        <!--
        TODO (contenido pendiente, ver estructura-sitio-web-bagus.md):
        - Manifiesto completo tal como está escrito
        - Historia de la marca
        - Página de conexión emocional: sin productos alrededor
        -->

    </section>

</main>

<?php get_footer(); ?>
