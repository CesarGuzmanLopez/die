<?php
/**
 * Plantilla para mostrar un servicio social individual.
 * */

get_header();
?>
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
                <?php the_content(); ?>

                <?php
                // Mostrar campos personalizados
                $ubicacion = get_post_meta(get_the_ID(), 'ubicacion_servicio', true);
                $fecha = get_post_meta(get_the_ID(), 'fecha_proyecto', true);
                $descripcion = get_post_meta(get_the_ID(), 'descripcion_proyecto', true);
                $habilidades = get_post_meta(get_the_ID(), 'habilidades', true);
                $imagen = get_post_meta(get_the_ID(), 'imagen_proyecto', true);
                ?>

                <div class="servicio-meta">
                    <?php if ($ubicacion) : ?>
                        <p><strong>Ubicación:</strong> <?php echo esc_html($ubicacion); ?></p>
                    <?php endif; ?>

                    <?php if ($fecha) : ?>
                        <p><strong>Fecha de vigencia:</strong> <?php echo esc_html($fecha); ?></p>
                    <?php endif; ?>

                    <?php if ($descripcion) : ?>
                        <p><strong>Descripción:</strong> <?php echo esc_html($descripcion); ?></p>
                    <?php endif; ?>

                    <?php if ($habilidades) : ?>
                        <p><strong>Habilidades requeridas:</strong> <?php echo esc_html($habilidades); ?></p>
                    <?php endif; ?>

                    <?php if ($imagen) : ?>
                        <img src="<?php echo esc_url($imagen); ?>" alt="" class="servicio-imagen">
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php
get_footer();