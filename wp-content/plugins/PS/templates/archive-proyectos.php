<?php
/**
 * Template for displaying all proyectos.
 */
    wp_head();
    
?>
<!-- wp:template-part {"slug":"header","area":"header","tagName":"header"} /-->
<!-- wp:group {"tagName":"main"} -->
<main id="primary" class="site-main">
    <header class="page-header">
        <h1 class="page-title"><?php _e('Proyectos Terminales', 'ps-plugin'); ?></h1>
    </header>
    <?php if (have_posts()) : ?>
        <div class="project-list">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p><?php _e('No projects found.', 'ps-plugin'); ?></p>
    <?php endif; ?>
</main>

<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","area":"footer","tagName":"footer"} /-->
<?php
    wp_footer();
?>