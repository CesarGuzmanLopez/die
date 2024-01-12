<?php
/**
 * Plantilla para mostrar un integrante social individual.
 */

get_header();

// Obtener los campos personalizados

$descripcion = get_post_meta(get_the_ID(), 'descripcion_integrante', true);
$habilidades = get_post_meta(get_the_ID(), 'habilidades_integrante', true);
$imagen = get_post_meta(get_the_ID(), 'imagen_integrante', true);
$select= get_post_meta(get_the_ID(), '_wporg_meta_key', true);
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
                <div class="c-meta">
                    <?php if ($imagen) : ?>
                        <div class="c-imagen-container">
                            <img src="<?php echo esc_url($imagen); ?>" alt="" class="c-imagen">
                        </div>
                    <?php endif; ?>

                    <div class="c-contenido">
                        <?php if ($descripcion) : ?>
                            <div class="c-meta-item">
                                <strong>Perfil:</strong>
                                <div class="content-item">
                                    <?php echo esc_html($descripcion); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($habilidades) : ?>
                            <div class="c-meta-item">
                                <strong>Ocupacion</strong>
                                <div class="content-item">
                                    <?php echo esc_html($habilidades); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($select) : ?>
                            !<div class="c-meta-item">
                                <strong>Seleccion:</strong>
                                <div class="content-item">
                                    <?php echo esc_html($select); ?>
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
        <p>Profesor: <a href="<?php echo the_author_meta("url",get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p>
        </div>
    </div>
</main>
<?php
get_footer();
?>