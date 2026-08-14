<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<footer class="footer">

    <div class="container footer-container">

        <div class="footer-col footer-brand">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="footer-logo">
            <p>Conecta con lo bueno.</p>
        </div>

        <div class="footer-col">
            <h4>Categorías</h4>
            <a href="<?php echo esc_url( home_url( '/product-category/alimentacion-consciente' ) ); ?>">Alimentación Consciente</a>
            <a href="<?php echo esc_url( home_url( '/product-category/bienestar-suplementacion' ) ); ?>">Bienestar &amp; Suplementación</a>
            <a href="<?php echo esc_url( home_url( '/product-category/cuidado-personal-limpio' ) ); ?>">Cuidado Personal Limpio</a>
        </div>

        <div class="footer-col">
            <h4>BAGUS</h4>
            <a href="<?php echo esc_url( home_url( '/manifiesto' ) ); ?>">Nuestro Manifiesto</a>
            <a href="<?php echo esc_url( home_url( '/programa-bioindividualidad' ) ); ?>">Programa de Bioindividualidad</a>
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a>
            <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">Preguntas Frecuentes</a>
        </div>

        <div class="footer-col">
            <h4>Contacto y envíos</h4>
            <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>">Contacto</a>
            <a href="#" class="footer-whatsapp">WhatsApp — placeholder</a>
            <p class="footer-note">Envíos en Bucaramanga — placeholder</p>
        </div>

        <div class="footer-col footer-newsletter">
            <h4>Newsletter</h4>
            <!-- TODO: conectar a un proveedor real (Mailchimp, Brevo, etc.) -->
            <form class="footer-newsletter-form">
                <input type="email" placeholder="Tu correo" required>
                <button type="submit">Suscribirme</button>
            </form>
        </div>

    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> BAGUS. Todos los derechos reservados.</p>
            <div class="footer-legal">
                <a href="<?php echo esc_url( home_url( '/privacidad' ) ); ?>">Privacidad</a>
                <a href="<?php echo esc_url( home_url( '/terminos' ) ); ?>">Términos</a>
            </div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
