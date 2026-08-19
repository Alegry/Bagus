<?php
/**
 * Template Name: Blog / Recursos
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$bagus_pillars = array(
    'como-leer-etiquetas'          => 'Cómo leer etiquetas',
    'bioindividualidad'            => 'Qué es la bioindividualidad',
    'mitos-del-greenwashing'       => 'Mitos del greenwashing',
    'habitos-simples-de-bienestar' => 'Hábitos simples de bienestar',
);

$bagus_active_category = isset( $_GET['categoria'] ) ? sanitize_title( wp_unslash( $_GET['categoria'] ) ) : '';
$bagus_paged           = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

$bagus_blog_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $bagus_paged,
);

if ( $bagus_active_category && array_key_exists( $bagus_active_category, $bagus_pillars ) ) {
    $bagus_blog_args['category_name'] = $bagus_active_category;
}

$bagus_blog_query = new WP_Query( $bagus_blog_args );
?>

<main class="page-blog">

    <!-- HERO -->
    <section class="page-blog-hero">
        <div class="container">
            <h1 class="page-hero-title">Blog &amp; Recursos</h1>
            <p class="page-hero-subtitle">La investigación pesada, ya hecha por nosotras: etiquetas, greenwashing, bioindividualidad y hábitos simples, explicados sin tecnicismos.</p>
        </div>
    </section>

    <!-- FILTRO DE CATEGORÍAS -->
    <section class="blog-filters">
        <div class="container">
            <ul class="blog-filters-list">

                <li>
                    <a class="blog-filter-link<?php echo empty( $bagus_active_category ) ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Todos</a>
                </li>

                <?php foreach ( $bagus_pillars as $slug => $label ) : ?>
                    <li>
                        <a class="blog-filter-link<?php echo $bagus_active_category === $slug ? ' is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'categoria', $slug, home_url( '/blog' ) ) ); ?>"><?php echo esc_html( $label ); ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </section>

    <!-- GRID DE ARTÍCULOS -->
    <section class="section blog-index">
        <div class="container">

            <?php if ( $bagus_blog_query->have_posts() ) : ?>

                <div class="blog-index-grid">
                    <?php while ( $bagus_blog_query->have_posts() ) : $bagus_blog_query->the_post(); ?>

                        <a class="blog-index-card reveal" href="<?php the_permalink(); ?>">

                            <div class="blog-index-thumb">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                <?php endif; ?>
                            </div>

                            <?php
                            $bagus_categories = get_the_category();
                            if ( ! empty( $bagus_categories ) ) :
                                ?>
                                <span class="blog-index-category"><?php echo esc_html( $bagus_categories[0]->name ); ?></span>
                            <?php endif; ?>

                            <h3><?php the_title(); ?></h3>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>

                        </a>

                    <?php endwhile; ?>
                </div>

                <div class="blog-index-pagination">
                    <?php
                    $bagus_big = 999999999;
                    echo paginate_links( array(
                        'total'     => $bagus_blog_query->max_num_pages,
                        'current'   => $bagus_paged,
                        'base'      => str_replace( $bagus_big, '%#%', esc_url( add_query_arg( 'paged', $bagus_big ) ) ),
                        'format'    => '',
                        'prev_text' => '← Anteriores',
                        'next_text' => 'Siguientes →',
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <p class="blog-index-empty">Aún no hay artículos publicados en esta categoría.</p>

            <?php endif; wp_reset_postdata(); ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
