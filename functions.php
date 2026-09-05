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
    'manifiesto-programa', 'testimonials', 'blog',
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

    // Librerías de animación (CDN): GSAP + ScrollTrigger para las animaciones
    // fade+slide, Lenis para el scroll suave de todo el sitio.
    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true );
    wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true );
    wp_enqueue_script( 'lenis', 'https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js', array(), '1.1.14', true );

    // JS por sección
    $js_files = array( 'smooth-scroll', 'preloader', 'header', 'hero', 'trust-bar', 'kit-teaser', 'shop-categories', 'manifiesto-programa', 'manifiesto', 'testimonials', 'blog', 'reveal' );
    $gsap_deps = array( 'gsap', 'gsap-scrolltrigger', 'lenis' );
    $js_deps = array(
        'smooth-scroll'    => $gsap_deps,
        'shop-categories'  => $gsap_deps,
        'manifiesto'       => $gsap_deps,
    );
    foreach ( $js_files as $file ) {
        $path = "/js/{$file}.js";
        $full_path = get_stylesheet_directory() . $path;
        if ( file_exists( $full_path ) ) {
            $deps = isset( $js_deps[ $file ] ) ? $js_deps[ $file ] : array();
            wp_enqueue_script( "bagus-{$file}", $theme_uri . $path, $deps, filemtime( $full_path ), true );
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

/**
 * --- Endurecimiento de seguridad (auditoría 2026-09-04) ---
 */

/**
 * Oculta /wp-json/wp/v2/users a visitantes no logueados: el endpoint expone
 * el email del admin como "name" y is_super_admin. El editor de bloques y
 * WooCommerce lo siguen viendo normal porque solo se filtra cuando
 * is_user_logged_in() es false.
 */
function bagus_restrict_rest_users_endpoint( $endpoints ) {
    if ( ! is_user_logged_in() ) {
        foreach ( array( '/wp/v2/users', '/wp/v2/users/(?P<id>[\d]+)' ) as $route ) {
            unset( $endpoints[ $route ] );
        }
    }
    return $endpoints;
}
add_filter( 'rest_endpoints', 'bagus_restrict_rest_users_endpoint' );

/**
 * Mata las páginas públicas de autor (/author/{slug}/): confirman el
 * username real y son un vector de enumeración.
 */
function bagus_disable_author_pages() {
    if ( is_author() ) {
        wp_safe_redirect( home_url(), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'bagus_disable_author_pages' );

/**
 * Mensaje de login genérico: ya no se distingue "usuario no existe" de
 * "contraseña incorrecta" (enumeración de usuarios vía wp-login.php).
 */
add_filter( 'login_errors', function () {
    return 'Usuario o contraseña incorrectos.';
} );

// Desactiva XML-RPC (vector de fuerza bruta amplificada vía system.multicall).
add_filter( 'xmlrpc_enabled', '__return_false' );

// Oculta la versión exacta de WordPress (meta generator en <head>).
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

/**
 * Cabeceras de seguridad HTTP básicas. No se agrega CSP estricta ni HSTS
 * por código: hay que auditar antes todos los scripts externos del sitio
 * (Google Fonts, GTM, WhatsApp, etc.) para no romper nada.
 */
function bagus_security_headers() {
    if ( is_admin() ) {
        return;
    }
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-Content-Type-Options: nosniff' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
}
add_action( 'send_headers', 'bagus_security_headers' );