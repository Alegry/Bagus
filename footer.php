<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<footer class="footer">

    <div class="container footer-nav">

        <div class="footer-group">
            <h4 class="footer-group-label">Categorías</h4>
            <div class="footer-group-divider"></div>
            <div class="footer-group-links">
                <a href="<?php echo esc_url( function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' ) ); ?>">Tienda</a>
                <a href="<?php echo esc_url( home_url( '/categoria-producto/alacena-consciente' ) ); ?>">Alacena Consciente</a>
                <a href="<?php echo esc_url( home_url( '/categoria-producto/bienestar-suplementacion' ) ); ?>">Bienestar &amp; Suplementación</a>
                <a href="<?php echo esc_url( home_url( '/categoria-producto/cuidado-personal' ) ); ?>">Cuidado Personal</a>
                <a href="<?php echo esc_url( home_url( '/comprar-por-objetivo' ) ); ?>">Comprar por Objetivo (Kits)</a>
            </div>
        </div>

        <div class="footer-group">
            <h4 class="footer-group-label">Bagus</h4>
            <div class="footer-group-divider"></div>
            <div class="footer-group-links">
                <a href="<?php echo esc_url( home_url( '/manifiesto' ) ); ?>">Nuestro Manifiesto</a>
                <a href="<?php echo esc_url( home_url( '/programa-bioindividualidad' ) ); ?>">Programa de Bioindividualidad</a>
                <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a>
                <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">Preguntas Frecuentes</a>
            </div>
        </div>

        <div class="footer-group">
            <h4 class="footer-group-label">Contacto y Envíos</h4>
            <div class="footer-group-divider"></div>
            <div class="footer-group-links">
                <!-- TODO: reemplazar por el correo real de contacto -->
                <a href="mailto:hola@bagus.co">Contacto</a>
                <!-- TODO: reemplazar por el número real, formato https://wa.me/57XXXXXXXXXX -->
                <a href="https://wa.me/57XXXXXXXXXX" target="_blank" rel="noopener">WhatsApp</a>
                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>">Envíos en Bucaramanga</a>
            </div>
        </div>

        <div class="footer-group footer-group-social">
            <h4 class="footer-group-label">Síguenos</h4>
            <div class="footer-group-divider"></div>
            <div class="footer-group-links">
                <!-- TODO: reemplazar por el @handle real de Instagram -->
                <a href="https://instagram.com/bagus" target="_blank" rel="noopener">Instagram</a>
                <!-- TODO: conectar a un proveedor real (Mailchimp, Klaviyo, Brevo, etc.) -->
                <form class="footer-newsletter-form">
                    <input type="email" placeholder="Tu correo" required>
                    <button type="submit">Suscribirme</button>
                </form>
            </div>
        </div>

    </div>

    <div class="footer-trust-mini">
        <div class="container footer-trust-mini-container">

            <div class="footer-trust-mini-item">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Lupa.svg' ); ?>" alt="" width="28" height="28">
                <span>Curaduría bajo lupa</span>
            </div>

            <div class="footer-trust-mini-item">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Flor.svg' ); ?>" alt="" width="28" height="28">
                <span>Libre de tóxicos</span>
            </div>

            <div class="footer-trust-mini-item">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Camion.svg' ); ?>" alt="" width="28" height="28">
                <span>Envíos en Bucaramanga</span>
            </div>

            <div class="footer-trust-mini-item">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Mensaje.svg' ); ?>" alt="" width="28" height="28">
                <span>Acompañamiento experto</span>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> BAGUS. Todos los derechos reservados.</p>
            <div class="footer-legal">
                <a href="<?php echo esc_url( home_url( '/privacidad' ) ); ?>">Política de Privacidad</a>
                <a href="<?php echo esc_url( home_url( '/terminos' ) ); ?>">Términos y Condiciones</a>
                <!-- TODO: consentimiento informado del Programa — debe pasar por revisión legal antes de publicarse -->
                <a href="<?php echo esc_url( home_url( '/consentimiento-informado' ) ); ?>">Consentimiento Informado del Programa</a>
            </div>
        </div>
    </div>

    <div class="footer-outro">
        <div class="container">
            <p class="footer-outro-tagline">&quot;Conecta con lo bueno.&quot;</p>
        </div>
        <img class="footer-outro-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/LOGOTIPO.svg' ); ?>" alt="BAGUS" loading="lazy">
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
