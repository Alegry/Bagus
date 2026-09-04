<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main>
    <?php get_template_part( 'template-parts/hero/hero' ); ?>
    <?php get_template_part( 'template-parts/trust-bar/trust-bar' ); ?>
    <?php get_template_part( 'template-parts/shop-categories/shop-categories' ); ?>
    <?php get_template_part( 'template-parts/kit-teaser/kit-teaser' ); ?>
    <?php get_template_part( 'template-parts/manifiesto-programa/manifiesto-programa' ); ?>
    <?php get_template_part( 'template-parts/testimonials/testimonials' ); ?>
    <?php get_template_part( 'template-parts/blog/blog' ); ?>
</main>

<?php get_footer(); ?>s