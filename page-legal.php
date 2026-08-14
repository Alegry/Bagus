<?php
/**
 * Template Name: Legal
 *
 * Reutilizable para las 3 páginas legales: Privacidad, Términos y
 * Consentimiento informado del Programa. El contenido de cada una
 * se edita desde el editor de WordPress al crear cada página.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-legal">

    <section class="container">

        <?php while ( have_posts() ) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

        <?php endwhile; ?>

    </section>

</main>

<?php get_footer(); ?>
