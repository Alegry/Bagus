<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<section class="section bagus-shop-categories">
    <div class="container">

        <h2 class="section-title">Compra por categoría</h2>

        <div class="shop-categories-grid">

            <a class="shop-category-card" href="<?php echo esc_url( home_url( '/categoria-producto/alacena-consciente' ) ); ?>">
                <span class="shop-category-image"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Alimentacion-Consciente.jpeg' ); ?>" alt="" loading="lazy" decoding="async"></span>
                <span class="shop-category-label"><span>Alacena</span><span>Consciente</span></span>
            </a>

            <a class="shop-category-card" href="<?php echo esc_url( home_url( '/categoria-producto/bienestar-suplementacion' ) ); ?>">
                <span class="shop-category-image"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Bienestar-y-Suplementacion.jpeg' ); ?>" alt="" loading="lazy" decoding="async"></span>
                <span class="shop-category-label"><span>Bienestar y</span><span>Suplementación</span></span>
            </a>

            <a class="shop-category-card" href="<?php echo esc_url( home_url( '/categoria-producto/cuidado-personal' ) ); ?>">
                <span class="shop-category-image"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Cuidado-Personal.jpeg' ); ?>" alt="" loading="lazy" decoding="async"></span>
                <span class="shop-category-label"><span>Cuidado</span><span>Personal</span></span>
            </a>

            <a class="shop-category-card" href="<?php echo esc_url( home_url( '/comprar-por-objetivo' ) ); ?>">
                <span class="shop-category-image"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Kits-de-Bienestar.jpeg' ); ?>" alt="" loading="lazy" decoding="async"></span>
                <span class="shop-category-label"><span>Kits de</span><span>Bienestar</span></span>
            </a>

        </div>

    </div>
</section>
