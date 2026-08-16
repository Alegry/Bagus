<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bagus_child_enqueue_assets() {
    $version = wp_get_theme()->get( 'Version' );
    $theme_uri = get_stylesheet_directory_uri();

    wp_enqueue_style( 'kadence-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bagus-child-style', $theme_uri . '/style.css', array( 'kadence-parent-style' ), $version );

    $css_files = array(
    'fonts', 'reset', 'variables', 'global',
    'header',
    'hero', 'trust-bar', 'kit-teaser', 'shop-categories',
    'manifiesto-resumen', 'programa-bridge', 'testimonials', 'blog',
    'footer',
    );
    foreach ( $css_files as $file ) {
        $path = "/css/{$file}.css";
        $full_path = get_stylesheet_directory() . $path;
        if ( file_exists( $full_path ) ) {
            wp_enqueue_style( "bagus-{$file}", $theme_uri . $path, array( 'bagus-child-style' ), filemtime( $full_path ) );
        }
    }

    // JS por sección
    $js_files = array( 'header', 'hero', 'trust-bar', 'kit-teaser', 'shop-categories' );
    foreach ( $js_files as $file ) {
        $path = "/js/{$file}.js";
        $full_path = get_stylesheet_directory() . $path;
        if ( file_exists( $full_path ) ) {
            wp_enqueue_script( "bagus-{$file}", $theme_uri . $path, array(), filemtime( $full_path ), true );
        }
    }

    $wc_path = '/css/woocommerce.css';
    $wc_full_path = get_stylesheet_directory() . $wc_path;
    if ( class_exists( 'WooCommerce' ) && file_exists( $wc_full_path ) ) {
        wp_enqueue_style( 'bagus-woocommerce', $theme_uri . $wc_path, array( 'bagus-child-style' ), filemtime( $wc_full_path ) );
    }
}
add_action( 'wp_enqueue_scripts', 'bagus_child_enqueue_assets' );