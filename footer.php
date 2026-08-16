<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<footer class="footer">

    <div class="container footer-container">

        <div class="footer-col">
            <h4>Explorar</h4>
            <a href="<?php echo esc_url( function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' ) ); ?>">Tienda</a>
            <a href="<?php echo esc_url( home_url( '/product-category/alimentacion-consciente' ) ); ?>">Alimentación Consciente</a>
            <a href="<?php echo esc_url( home_url( '/product-category/bienestar-suplementacion' ) ); ?>">Bienestar &amp; Suplementación</a>
            <a href="<?php echo esc_url( home_url( '/product-category/cuidado-personal-limpio' ) ); ?>">Cuidado Personal Limpio</a>
            <a href="<?php echo esc_url( home_url( '/comprar-por-objetivo' ) ); ?>">Comprar por Objetivo (Kits)</a>
        </div>

        <div class="footer-col">
            <h4>BAGUS</h4>
            <a href="<?php echo esc_url( home_url( '/programa-bioindividualidad' ) ); ?>">Programa de Bioindividualidad</a>
            <a href="<?php echo esc_url( home_url( '/manifiesto' ) ); ?>">Nuestro Manifiesto</a>
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a>
            <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">Preguntas Frecuentes</a>
        </div>

        <div class="footer-col">
            <h4>Contacto</h4>
            <!-- TODO: reemplazar por el número real, formato https://wa.me/57XXXXXXXXXX -->
            <a href="https://wa.me/57XXXXXXXXXX" class="footer-whatsapp" target="_blank" rel="noopener">Escríbenos por WhatsApp</a>
            <!-- TODO: reemplazar por el correo real de contacto -->
            <a href="mailto:hola@bagus.co">hola@bagus.co — placeholder</a>
            <!-- TODO: confirmar horario de atención, o si es 100% asíncrono -->
            <p class="footer-note">Horario de atención — placeholder</p>
            <p class="footer-note">Envíos en Bucaramanga y alrededores</p>
        </div>

        <div class="footer-col footer-social-newsletter">
            <h4>Síguenos</h4>
            <!-- TODO: reemplazar por el @handle real de Instagram -->
            <a href="https://instagram.com/bagus" class="footer-social-link" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="3" width="18" height="18" rx="5"></rect>
                    <circle cx="12" cy="12" r="4.2"></circle>
                    <circle cx="17.4" cy="6.6" r="1"></circle>
                </svg>
                <span>@bagus — placeholder</span>
            </a>
            <!-- TODO: agregar Facebook / TikTok aquí si la marca los va a usar -->

            <h4 class="footer-newsletter-title">Newsletter</h4>
            <p class="footer-newsletter-copy">Recetas, tips y lanzamientos — sin spam, solo lo bueno.</p>
            <!-- TODO: conectar a un proveedor real (Mailchimp, Klaviyo, Brevo, etc.) -->
            <form class="footer-newsletter-form">
                <input type="email" placeholder="Tu correo" required>
                <button type="submit">Suscribirme</button>
            </form>
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
            <p class="footer-outro-tagline">"Conecta con lo bueno."</p>
        </div>
        <p class="footer-outro-wordmark">BAGUS</p>
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
