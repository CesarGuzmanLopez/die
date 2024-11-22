<?php
/**
 * Plantilla para mostrar un servicio social individual.
 */

// Obtener los campos personalizados
$descripcion = get_post_meta(get_the_ID(), 'descripcion_servicio', true);
$habilidades = get_post_meta(get_the_ID(), 'habilidades_servicio', true);
$contacto = get_post_meta(get_the_ID(), 'datos_contacto_servicio', true);
$imagen = get_post_meta(get_the_ID(), 'imagen_servicio', true);
$ubicacion = get_post_meta(get_the_ID(), 'ubicacion_servicio', true);

?>
<!-- wp:template-part {"slug":"header","area":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main"} -->
<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content">
                <div class="c-meta">
                    <?php if ($imagen) : ?>
                        <div class="c-imagen-container">
                            <img src="<?php echo esc_url($imagen); ?>" alt="" class="c-imagen">
                        </div>
                    <?php endif; ?>
                    <div class="c-contenido">
                        <?php if ($descripcion) : ?>
                            <div class="c-meta-item">
                                <strong>Descripción:</strong>
                                <div class="content-item">
                                    <?php echo esc_html($descripcion); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($habilidades) : ?>
                            <div class="c-meta-item">
                                <strong>Habilidades requeridas:</strong>
                                <div class="content-item">
                                    <?php echo esc_html($habilidades); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($ubicacion) : ?>
                            <div class="c-meta-item">
                                <strong>Ubicación:</strong>
                                <div class="content-item">
                                    <?php echo esc_html($ubicacion); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($contacto) : ?>
                            <div class="c-meta-item">
                                <strong>Datos de Contacto:</strong>
                                <div class="content-item">
                                    <?php echo esc_html($contacto); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
    <div class="author-section">
        <div class="author-info">
            <p>Profesor: <a href="<?php echo esc_url(get_the_author_meta('url')); ?>"><?php the_author(); ?></a></p>
        </div>
    </div>
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","area":"footer","tagName":"footer"} /-->