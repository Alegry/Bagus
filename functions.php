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
    'preloader',
    'header',
    'hero', 'trust-bar', 'kit-teaser', 'shop-categories',
    'manifiesto-resumen', 'programa-bridge', 'testimonials', 'blog',
    'programa', 'manifiesto', 'contacto', 'blog-archive', 'blog-single',
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
    $js_files = array( 'preloader', 'header', 'hero', 'trust-bar', 'kit-teaser', 'shop-categories', 'manifiesto-resumen', 'programa-bridge', 'testimonials', 'blog', 'reveal' );
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

/**
 * Las "Entradas" nativas de WordPress son el apartado del blog (alimentan
 * la sección "Del blog" del home y el archivo /blog). Se renombran a
 * "Blog"/"Artículo" en el admin para que sea obvio dónde publicar.
 */
function bagus_rename_posts_to_blog_labels() {
    global $wp_post_types;

    if ( ! isset( $wp_post_types['post'] ) ) {
        return;
    }

    $labels = &$wp_post_types['post']->labels;

    $labels->name               = 'Blog';
    $labels->singular_name      = 'Artículo';
    $labels->menu_name          = 'Blog';
    $labels->name_admin_bar     = 'Artículo';
    $labels->add_new            = 'Añadir nuevo';
    $labels->add_new_item       = 'Añadir nuevo artículo';
    $labels->edit_item          = 'Editar artículo';
    $labels->new_item           = 'Nuevo artículo';
    $labels->view_item          = 'Ver artículo';
    $labels->view_items         = 'Ver artículos';
    $labels->search_items       = 'Buscar artículos';
    $labels->not_found          = 'No se encontraron artículos';
    $labels->not_found_in_trash = 'No se encontraron artículos en la papelera';
    $labels->all_items          = 'Todos los artículos';
    $labels->archives           = 'Archivo de artículos';
    $labels->insert_into_item   = 'Insertar en el artículo';
    $labels->uploaded_to_this_item = 'Subido a este artículo';
    $labels->featured_image     = 'Imagen destacada';
    $labels->set_featured_image = 'Definir imagen destacada';
    $labels->remove_featured_image = 'Quitar imagen destacada';
    $labels->use_featured_image = 'Usar como imagen destacada';
}
add_action( 'init', 'bagus_rename_posts_to_blog_labels', 20 );

function bagus_rename_posts_menu() {
    global $menu, $submenu;

    if ( is_array( $menu ) ) {
        foreach ( $menu as $key => $item ) {
            if ( isset( $item[2] ) && 'edit.php' === $item[2] ) {
                $menu[ $key ][0] = 'Blog';
            }
        }
    }

    if ( isset( $submenu['edit.php'] ) ) {
        foreach ( $submenu['edit.php'] as $key => $item ) {
            if ( 'edit.php' === $item[2] ) {
                $submenu['edit.php'][ $key ][0] = 'Todos los artículos';
            } elseif ( 'post-new.php' === $item[2] ) {
                $submenu['edit.php'][ $key ][0] = 'Añadir nuevo';
            }
        }
    }
}
add_action( 'admin_menu', 'bagus_rename_posts_menu', 999 );

/**
 * Los 4 pilares de contenido del blog (ver instrucciones-ia-paginas-bagus.md),
 * creados como categorías nativas de WordPress si aún no existen, para que
 * el filtro de la página Blog / Recursos siempre tenga a dónde apuntar.
 */
function bagus_register_blog_pillars() {
    $pillars = array(
        'como-leer-etiquetas'          => 'Cómo leer etiquetas',
        'bioindividualidad'            => 'Qué es la bioindividualidad',
        'mitos-del-greenwashing'       => 'Mitos del greenwashing',
        'habitos-simples-de-bienestar' => 'Hábitos simples de bienestar',
    );

    foreach ( $pillars as $slug => $name ) {
        if ( ! term_exists( $slug, 'category' ) ) {
            wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'init', 'bagus_register_blog_pillars', 21 );