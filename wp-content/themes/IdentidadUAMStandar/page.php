<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @author CesarGuzmanLopez
 * @package IdentidadUAMStandar
 */


 $show_sidebar = get_post_meta(get_the_ID(), 'show_sidebar', true);
 $show_thumbnail = get_post_meta(get_the_ID(), 'show_thumbnail', true);
 $show_title = get_post_meta(get_the_ID(), 'show_title', true);
get_header();

if (is_front_page() && is_active_sidebar('principal-sidebar')) :
    ?>
    <div id="secondary-sidebar" class="principal-sidebar">
        <?php dynamic_sidebar('principal-sidebar'); ?>
    </div>
<?php endif; ?>

<div class="wrapper section-inner group">
    <div class="content">

        <?php
        while (have_posts()) {
            the_post();
            $is_single = is_single();
            $post_classes = $is_single ? 'single single-post group' : '';
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>

                <?php if (!$is_single && !is_front_page() && $show_title !== 'no') : ?>
                    <div class="post-header">
                        <?php if ($is_single && has_category()) : ?>
                            <p class="post-categories"><?php the_category(', '); ?></p>
                        <?php endif; ?>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                    </div><!-- .post-header -->
                <?php endif; ?>

                <div class="post-inner">
                    <div class="post-content entry-content">
                        <?php
                        the_content();
                        wp_link_pages(array(
                            'before' => '<p class="page-links"><span class="title">' . __('Pages:', 'rowling') . '</span>',
                            'after' => '</p>',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                            'separator' => '',
                            'pagelink' => '%',
                            'echo' => 1,
                        ));
                        ?>
                    </div><!-- .post-content -->

                    <?php if ($is_single) : ?>
                        <?php the_tags('<div class="post-tags">', '', '</div>'); ?>
                        <?php rowling_related_posts(); ?>
                    <?php endif; ?>
                </div><!-- .post-inner -->
            </article><!-- .post -->

        <?php
        } // endwhile
        ?>

        <?php
        if (has_post_thumbnail() && !post_password_required() && $show_thumbnail !== 'no') :
            echo '<figure class="post-image">';
            the_post_thumbnail('post-image', array('class' => 'post-image-oculta', 'id' => 'post-image-' . get_the_ID()));
            $image_caption = get_the_post_thumbnail_caption($post->ID);
            if ($image_caption) : ?>
                <div class="caption"><?php echo esc_html($image_caption); ?></div>
            <?php endif;
            echo '</figure><!-- .post-image -->';
        endif;
        ?>

    </div><!-- .content -->

    <?php
	if ($show_sidebar !== 'no' && is_active_sidebar('principal-sidebar')) :
    if (!is_front_page()) {
        get_sidebar();
    }
	endif;
    ?>


</div><!-- .wrapper -->

<?php
get_footer();
?>
