<?php
/**
 * Template Name: Programa de Bioindividualidad
 *
 * El Programa todavía no está activo: por defecto esta página muestra un
 * "Próximamente" y el contenido completo de más abajo queda oculto (pero
 * intacto) detrás de una contraseña de acceso interno, para poder seguir
 * puliéndolo hasta el lanzamiento. Cuando esté listo para publicarse,
 * cambiar BAGUS_PROGRAMA_LIVE a true más abajo (y de paso reemplazar
 * $bagus_programa_password por una contraseña nueva).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// Cambiar a true el día que el Programa esté listo para todo el público.
define( 'BAGUS_PROGRAMA_LIVE', false );

$bagus_programa_password = 'Bagus2026';
$bagus_programa_cookie   = 'bagus_programa_preview';
$bagus_programa_unlocked = BAGUS_PROGRAMA_LIVE || ( isset( $_COOKIE[ $bagus_programa_cookie ] ) && hash_equals( md5( $bagus_programa_password ), $_COOKIE[ $bagus_programa_cookie ] ) );
$bagus_programa_wrong    = false;

if ( ! $bagus_programa_unlocked && isset( $_POST['bagus_programa_password'] ) ) {
    $bagus_programa_attempt = wp_unslash( $_POST['bagus_programa_password'] );

    if ( hash_equals( $bagus_programa_password, $bagus_programa_attempt ) ) {
        setcookie( $bagus_programa_cookie, md5( $bagus_programa_password ), time() + 30 * DAY_IN_SECONDS, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
        $bagus_programa_unlocked = true;
    } else {
        $bagus_programa_wrong = true;
    }
}

get_header();
?>

<main class="page-programa">

<?php if ( ! $bagus_programa_unlocked ) : ?>

    <!-- PRÓXIMAMENTE -->
    <section class="programa-coming-soon">
        <div class="container">
            <span class="page-hero-eyebrow">Programa BAGUS de Bioindividualidad</span>
            <h1 class="page-hero-title">Próximamente</h1>
            <p class="page-hero-subtitle">Estamos preparando este espacio con mucho cuidado. Muy pronto vas a poder conocer todo el acompañamiento del Programa BAGUS de Bioindividualidad.</p>

            <!-- TODO: reemplazar por el número real, formato https://wa.me/57XXXXXXXXXX -->
            <a href="https://wa.me/57XXXXXXXXXX" target="_blank" rel="noopener" class="btn btn-outline">¿Necesitas ayuda para elegir mientras tanto? Escríbenos</a>

            <details class="programa-unlock">
                <summary>Acceso interno</summary>
                <form class="programa-unlock-form" method="post">
                    <input type="password" name="bagus_programa_password" placeholder="Contraseña" required>
                    <button type="submit">Entrar</button>
                </form>
                <?php if ( $bagus_programa_wrong ) : ?>
                    <p class="programa-unlock-error">Contraseña incorrecta.</p>
                <?php endif; ?>
            </details>
        </div>
    </section>

<?php else : ?>

    <!-- HERO -->
    <section class="page-programa-hero">
        <div class="container">
            <span class="page-hero-eyebrow">Programa BAGUS de Bioindividualidad</span>
            <h1 class="page-hero-title">Más allá del producto: un acompañamiento hecho a tu medida</h1>
            <p class="page-hero-subtitle">Porque tu cuerpo es sabio, único, y lo que le funciona a otra persona no tiene por qué funcionarte a ti.</p>
            <a href="#agenda" class="btn btn-primary">Agenda tu primera sesión</a>
        </div>
    </section>

    <!-- QUÉ ES Y QUÉ NO ES -->
    <section class="section programa-what">
        <div class="container">
            <h2 class="section-title reveal">Qué es (y qué no es) el Programa</h2>
            <p class="section-intro reveal">Antes de dar el paso, queremos que sepas exactamente en qué te estás embarcando — y en qué no.</p>

            <div class="programa-what-grid">

                <div class="programa-what-card programa-what-card--is reveal">
                    <h3>Qué es</h3>
                    <ul>
                        <li>Un acompañamiento personalizado basado en el concepto de bioindividualidad: lo que tu cuerpo necesita, específicamente el tuyo.</li>
                        <li>Un proceso guiado, paso a paso, para que aprendas a leer las señales de tu propio cuerpo.</li>
                        <li>Educación real sobre hábitos, ingredientes y bienestar, sin fórmulas genéricas ni "talla única".</li>
                        <li>Un espacio de escucha y seguimiento, hecho con y para ti.</li>
                    </ul>
                </div>

                <div class="programa-what-card programa-what-card--isnot reveal">
                    <h3>Qué no es</h3>
                    <ul>
                        <li>No es un diagnóstico médico ni un servicio clínico.</li>
                        <li>No es un tratamiento ni sustituye ningún tipo de terapia.</li>
                        <li>No reemplaza a un profesional de la salud cuando lo necesitas — te acompañamos, no te sustituimos.</li>
                        <li>No es la Guía de Compra gratuita de BAGUS: es un siguiente nivel, más profundo y personalizado.</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- PARA QUIÉN ES -->
    <section class="section programa-audience">
        <div class="container">
            <h2 class="section-title reveal">¿Para quién es este Programa?</h2>
            <p class="reveal">Para quien ya cuida lo que consume, ya lee etiquetas, ya intenta elegir mejor — pero siente que le falta algo más: claridad sobre qué necesita <em>su</em> cuerpo específicamente. Para quien está cansada de probar por ensayo y error, de seguir rutinas que le funcionaron a alguien más y a ella no, y quiere por fin un camino diseñado para ella.</p>
        </div>
    </section>

    <!-- LAS 4 FASES -->
    <section class="section programa-phases">
        <div class="container">
            <h2 class="section-title reveal">Las 4 fases del Programa</h2>
            <p class="section-intro reveal">Un recorrido progresivo, no una lista de tareas: cada fase te deja lista para la siguiente.</p>

            <div class="programa-phases-list">

                <div class="programa-phase reveal">
                    <span class="programa-phase-number"></span>
                    <h3>Autoconocimiento</h3>
                    <p>Empezamos por entender tu punto de partida: tu historia, tus hábitos, tus síntomas y lo que ya intentaste. Aquí no se supone nada — se escucha.</p>
                </div>

                <div class="programa-phase reveal">
                    <span class="programa-phase-number"></span>
                    <h3>Educación personalizada</h3>
                    <p>Con eso claro, te explicamos —sin tecnicismos— qué está pasando y por qué, y qué opciones reales tiene sentido explorar para tu caso.</p>
                </div>

                <div class="programa-phase reveal">
                    <span class="programa-phase-number"></span>
                    <h3>Implementación guiada</h3>
                    <p>Pasamos a la práctica: ajustes concretos en tu día a día, acompañados de cerca para que no tengas que resolverlo sola.</p>
                </div>

                <div class="programa-phase reveal">
                    <span class="programa-phase-number"></span>
                    <h3>Autonomía</h3>
                    <p>El objetivo final no es que dependas de nosotras: es que salgas sabiendo leer tu propio cuerpo y elegir con confianza, con o sin nosotras cerca.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- QUÉ INCLUYE -->
    <section class="section programa-includes">
        <div class="container">
            <h2 class="section-title reveal">Qué incluye</h2>
            <p class="section-intro reveal">Entregables concretos, no promesas vagas.</p>

            <ul class="programa-includes-list reveal">
                <li>[Número] sesiones de acompañamiento individual, una a una a lo largo del Programa.</li>
                <li>Materiales de apoyo personalizados según tu proceso (guías, recursos, recomendaciones).</li>
                <li>Seguimiento entre sesiones por [canal a confirmar: WhatsApp / correo].</li>
                <li>Un plan de implementación adaptado a tu rutina real, no genérico.</li>
                <li>Cierre del Programa con herramientas para sostener lo aprendido por tu cuenta.</li>
            </ul>

            <p class="programa-includes-note">[Nota interna: reemplazar la lista de arriba con el número exacto de sesiones, duración y materiales una vez estén definidos — no publicar con placeholders.]</p>
        </div>
    </section>

    <!-- INVERSIÓN -->
    <section class="section programa-investment">
        <div class="container">
            <h2 class="section-title reveal">Inversión</h2>

            <div class="programa-investment-card reveal">
                <p class="programa-investment-price">[Precio del Programa]</p>
                <p>[Espacio reservado para las modalidades de pago — ej. pago único, cuotas, etc. Completar antes de publicar.]</p>
                <a href="#agenda" class="btn btn-primary">Agenda tu primera sesión</a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIOS -->
    <section class="section programa-testimonials">
        <div class="container">
            <h2 class="section-title reveal">Lo que viven quienes hacen el Programa</h2>

            <div class="testimonials-grid">

                <blockquote class="testimonial-card reveal">
                    <p>"[Espacio reservado para testimonios reales de participantes del Programa.]"</p>
                    <cite>— Nombre, participante del Programa</cite>
                </blockquote>

                <blockquote class="testimonial-card reveal">
                    <p>"[Espacio reservado para testimonios reales de participantes del Programa.]"</p>
                    <cite>— Nombre, participante del Programa</cite>
                </blockquote>

                <blockquote class="testimonial-card reveal">
                    <p>"[Espacio reservado para testimonios reales de participantes del Programa.]"</p>
                    <cite>— Nombre, participante del Programa</cite>
                </blockquote>

            </div>
        </div>
    </section>

    <!-- FAQ DEL PROGRAMA -->
    <section class="section programa-faq">
        <div class="container">
            <h2 class="section-title reveal">Preguntas frecuentes del Programa</h2>

            <div class="programa-faq-list">

                <details class="programa-faq-item">
                    <summary>¿Cuál es la diferencia con la Guía de Compra gratuita?</summary>
                    <p>La Guía de Compra es una conversación rápida y gratuita por WhatsApp para ayudarte a elegir productos. El Programa es un servicio pago, mucho más profundo: un acompañamiento personalizado a lo largo de varias sesiones para entender lo que tu cuerpo necesita, no solo qué comprar.</p>
                </details>

                <details class="programa-faq-item">
                    <summary>¿Cuánto dura el Programa?</summary>
                    <p>[Espacio reservado — confirmar duración total y frecuencia de las sesiones antes de publicar.]</p>
                </details>

                <details class="programa-faq-item">
                    <summary>¿Es presencial o virtual?</summary>
                    <p>[Espacio reservado — confirmar modalidad(es) disponibles antes de publicar.]</p>
                </details>

                <details class="programa-faq-item">
                    <summary>¿El Programa reemplaza una consulta médica?</summary>
                    <p>No. El Programa acompaña y educa, pero no diagnostica ni trata condiciones de salud. Si necesitas atención médica, seguimos recomendándote consultar a un profesional de la salud.</p>
                </details>

            </div>
        </div>
    </section>

    <!-- CTA DE AGENDAMIENTO -->
    <section class="section programa-agenda" id="agenda">
        <div class="container">
            <h2 class="section-title reveal">¿Lista para empezar?</h2>
            <p class="section-intro reveal">Agenda tu primera sesión y demos juntas el primer paso hacia un bienestar diseñado para ti.</p>
            <!-- TODO: reemplazar por el número real, formato https://wa.me/57XXXXXXXXXX -->
            <a href="https://wa.me/57XXXXXXXXXX?text=Hola%2C%20quiero%20agendar%20mi%20primera%20sesi%C3%B3n%20del%20Programa%20de%20Bioindividualidad" target="_blank" rel="noopener" class="btn btn-primary">Agenda tu primera sesión</a>
        </div>
    </section>

    <!-- CONSENTIMIENTO INFORMADO -->
    <section class="programa-consent">
        <div class="container">
            <!-- TODO: el consentimiento informado debe pasar por revisión legal antes de publicarse -->
            <p>Antes de iniciar el Programa te pediremos leer y aceptar nuestro <a href="<?php echo esc_url( home_url( '/consentimiento-informado' ) ); ?>">Consentimiento Informado del Programa</a>.</p>
        </div>
    </section>

<?php endif; ?>

</main>

<?php get_footer(); ?>