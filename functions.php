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
        'reset', 'variables', 'global',
        'header', 'footer',
        'hero', 'shop-categories', 'products',
        'about', 'benefits', 'cta', 'blog',
    );
    foreach ( $css_files as $file ) {
        $path = "/assets/css/{$file}.css";
        if ( file_exists( get_stylesheet_directory() . $path ) ) {
            wp_enqueue_style( "bagus-{$file}", $theme_uri . $path, array( 'bagus-child-style' ), $version );
        }
    }

    if ( class_exists( 'WooCommerce' ) && file_exists( get_stylesheet_directory() . '/assets/css/woocommerce.css' ) ) {
        wp_enqueue_style( 'bagus-woocommerce', $theme_uri . '/assets/css/woocommerce.css', array( 'bagus-child-style' ), $version );
    }
}
add_action( 'wp_enqueue_scripts', 'bagus_child_enqueue_assets' );