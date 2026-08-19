<?php
/**
 * Template Name: Contacto y Envíos
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="page-contacto">

    <!-- HERO -->
    <section class="page-contacto-hero">
        <div class="container">
            <h1 class="page-hero-title">Contacto y Envíos</h1>
            <p class="page-hero-subtitle">Resolvemos rápido: pedidos, envíos, devoluciones o cualquier duda sobre el Programa.</p>
        </div>
    </section>

    <!-- CUERPO: canales + formulario -->
    <section class="section contacto-body">
        <div class="container contacto-grid">

            <div class="contacto-channels">

                <div class="contacto-block reveal">
                    <h3>Escríbenos</h3>
                    <p>Nuestro canal principal es WhatsApp. También puedes encontrarnos en Instagram.</p>
                    <div class="contacto-channel-btns">
                        <!-- TODO: reemplazar por el número real, formato https://wa.me/57XXXXXXXXXX -->
                        <a href="https://wa.me/57XXXXXXXXXX" target="_blank" rel="noopener" class="btn btn-primary">WhatsApp</a>
                        <!-- TODO: reemplazar por el @handle real de Instagram -->
                    </div>
                </div>

                <div class="contacto-block reveal">
                    <h3>Horarios de atención</h3>
                    <!-- TODO: reemplazar por el horario real de atención -->
                    <p>[Horario de atención — pendiente de confirmar. Ej.: Lunes a viernes, 9:00 a.m. – 6:00 p.m.]</p>
                </div>

                <div class="contacto-block reveal">
                    <h3>Cobertura y tiempos de envío</h3>
                    <p>Hacemos envíos en Bucaramanga y su área metropolitana.</p>
                    <!-- TODO: reemplazar por tiempos reales de entrega por zona -->
                    <p>[Tiempos de entrega estimados por zona — pendiente de confirmar.]</p>
                </div>

            </div>

            <!-- TODO: este formulario aún no está conectado a ningún proveedor —
                 falta integrarlo con un plugin de formularios o un endpoint propio
                 para que los envíos realmente lleguen a algún lado. -->
            <form class="contacto-form reveal" action="" method="post">

                <div class="contacto-form-field">
                    <label for="contacto-nombre">Nombre</label>
                    <input type="text" id="contacto-nombre" name="nombre" required>
                </div>

                <div class="contacto-form-field">
                    <label for="contacto-correo">Correo</label>
                    <input type="email" id="contacto-correo" name="correo" required>
                </div>

                <div class="contacto-form-field">
                    <label for="contacto-motivo">Motivo de contacto</label>
                    <select id="contacto-motivo" name="motivo" required>
                        <option value="">Selecciona una opción</option>
                        <option value="compra">Compra</option>
                        <option value="envio-devolucion">Envío o devolución</option>
                        <option value="programa">Programa de Bioindividualidad</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="contacto-form-field">
                    <label for="contacto-mensaje">Mensaje</label>
                    <textarea id="contacto-mensaje" name="mensaje" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Enviar mensaje</button>

                <p class="contacto-form-note">Para gestiones urgentes, escríbenos directamente por WhatsApp — es más rápido.</p>

            </form>

        </div>
    </section>

    <!-- ENLACE A FAQ -->
    <section class="contacto-faq-link">
        <div class="container">
            <p>¿Tienes dudas sobre envíos, devoluciones o el Programa? Es probable que ya estén resueltas.</p>
            <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>" class="btn btn-outline">Ver Preguntas Frecuentes</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
