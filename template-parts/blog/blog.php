<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$bagus_blog_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
) );
?>

<section class="section bagus-blog-preview">
    <div class="container">

        <h2 class="section-title">Del blog</h2>

        <?php if ( $bagus_blog_query->have_posts() ) : ?>

            <div class="blog-preview-grid">
                <?php while ( $bagus_blog_query->have_posts() ) : $bagus_blog_query->the_post(); ?>

                    <a class="blog-preview-card" href="<?php the_permalink(); ?>">

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="blog-preview-thumb"><?php the_post_thumbnail( 'medium' ); ?></div>
                        <?php endif; ?>

                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>

                    </a>

                <?php endwhile; ?>
            </div>

        <?php else : ?>

            <p class="blog-preview-empty">Aún no hay artículos publicados — placeholder.</p>

        <?php endif; wp_reset_postdata(); ?>

        <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn btn-outline">Ver todos los artículos</a>

    </div>
</section>
