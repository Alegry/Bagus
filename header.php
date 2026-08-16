<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fonts/Poppins-Regular.ttf" as="font" type="font/ttf" crossorigin>
<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fonts/ArsenicaTrial-Regular.ttf" as="font" type="font/ttf" crossorigin>
<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fonts/DelicateElegance-Regular.otf" as="font" type="font/otf" crossorigin>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="site-preloader" id="site-preloader" aria-hidden="true">
    <img class="site-preloader-mark" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="">
    <p class="site-preloader-phrase"></p>
</div>
<noscript><style>.site-preloader{display:none;}</style></noscript>

<div class="site-bg" aria-hidden="true"></div>

<header class="header">

    <div class="container header-container">

        <nav class="nav">

            <div class="nav-left">

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a>

                <div class="nav-dropdown">

                    <button class="nav-dropdown-toggle" aria-expanded="false">
                        Tienda
                    </button>

                    <div class="nav-dropdown-menu">
                        <a href="<?php echo esc_url( home_url( '/comprar-por-objetivo' ) ); ?>">Comprar por Objetivo</a>
                        <a href="<?php echo esc_url( home_url( '/product-category/alimentacion-consciente' ) ); ?>">Alimentación Consciente</a>
                        <a href="<?php echo esc_url( home_url( '/product-category/bienestar-suplementacion' ) ); ?>">Bienestar &amp; Suplementación</a>
                        <a href="<?php echo esc_url( home_url( '/product-category/cuidado-personal-limpio' ) ); ?>">Cuidado Personal Limpio</a>
                        <a href="<?php echo esc_url( function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' ) ); ?>">Ver todo</a>
                    </div>

                </div>

                <a href="<?php echo esc_url( home_url( '/programa-bioindividualidad' ) ); ?>">Programa de Bioindividualidad</a>

            </div>

            <div class="nav-right">

                <a href="<?php echo esc_url( home_url( '/manifiesto' ) ); ?>">Nuestro Manifiesto</a>

                <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a>

                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>">Contacto</a>

            </div>

        </nav>

        <a href="<?php echo home_url(); ?>" class="logo">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>

        <button class="menu-toggle" aria-label="Abrir menú" aria-expanded="false">
            [ Menu ]
        </button>

    </div>

</header>