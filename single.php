<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

while ( have_posts() ) : the_post();

    $bagus_categories = get_the_category();
    $bagus_cat_slug   = ! empty( $bagus_categories ) ? $bagus_categories[0]->slug : '';

    // CTA suave según el pilar del artículo — nunca el mismo lugar para todo.
    switch ( $bagus_cat_slug ) {
        case 'bioindividualidad':
            $bagus_cta_text = 'Si sientes que necesitas algo más profundo que un producto, conoce el Programa BAGUS de Bioindividualidad.';
            $bagus_cta_label = 'Conocer el Programa';
            $bagus_cta_url   = home_url( '/programa-bioindividualidad' );
            break;
        case 'como-leer-etiquetas':
        case 'mitos-del-greenwashing':
            $bagus_cta_text = '¿No sabes qué elegir? Descubre productos ya verificados por BAGUS.';
            $bagus_cta_label = 'Explorar la tienda';
            $bagus_cta_url   = function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' );
            break;
        default:
            $bagus_cta_text = 'Encuentra el kit BAGUS que se ajusta a lo que necesitas hoy.';
            $bagus_cta_label = 'Descubre tu kit ideal';
            $bagus_cta_url   = home_url( '/comprar-por-objetivo' );
            break;
    }

    $bagus_related = new WP_Query( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'post__not_in'   => array( get_the_ID() ),
        'category__in'   => ! empty( $bagus_categories ) ? wp_list_pluck( $bagus_categories, 'term_id' ) : array(),
    ) );
    ?>

    <main class="single-post">

        <header class="single-post-header">
            <div class="container">

                <?php if ( ! empty( $bagus_categories ) ) : ?>
                    <span class="single-post-category"><?php echo esc_html( $bagus_categories[0]->name ); ?></span>
                <?php endif; ?>

                <h1 class="single-post-title"><?php the_title(); ?></h1>

                <p class="single-post-meta">
                    <span><?php the_author(); ?></span>
                    <span><?php echo esc_html( get_the_date() ); ?></span>
                </p>

            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="single-post-thumb">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
        <?php endif; ?>

        <div class="single-post-body">
            <div class="container">

                <div class="single-post-content">
                    <?php the_content(); ?>
                </div>

                <div class="single-post-cta">
                    <p><?php echo esc_html( $bagus_cta_text ); ?></p>
                    <a href="<?php echo esc_url( $bagus_cta_url ); ?>" class="btn btn-primary"><?php echo esc_html( $bagus_cta_label ); ?></a>
                </div>

            </div>
        </div>

        <?php if ( $bagus_related->have_posts() ) : ?>
            <section class="single-post-related">
                <div class="container">
                    <h2 class="section-title">Artículos relacionados</h2>

                    <div class="single-post-related-grid">
                        <?php while ( $bagus_related->have_posts() ) : $bagus_related->the_post(); ?>
                            <a class="single-post-related-card" href="<?php the_permalink(); ?>">
                                <h4><?php the_title(); ?></h4>
                            </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    </main>

<?php endwhile; ?>

<?php get_footer(); ?>
