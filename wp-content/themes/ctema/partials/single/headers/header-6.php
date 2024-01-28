<?php
/**
 * CtemaWP Single Post Header template
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Only display for standard posts.
if ( 'post' !== get_post_type() ) {
	return;
}

// Heading tag.
$heading = 'h1';
$heading = apply_filters( 'single_ctema_header_6_h_tag', $heading );

// Display meta filter.
$display_sph_meta = true;
$display_sph_meta = apply_filters( 'display_single_ctema_header_6_meta', $display_sph_meta );

$class = '';
if ( has_post_thumbnail() ) {
	$class = 'header-has-post-thumbnail';
}

?>

<div class="ctema-single-post-header single-header-ctema-6 <?php echo esc_attr( $class ); ?>">
	<?php ctemawp_paint_post_thumbnail( 'full', array( 'name' => 'ctema-sh-6' ) ); ?>
	<div class="sh-container head-row">
		<div class="col-xs-12">

			<?php do_action( 'ctema_before_page_header' ); ?>

			<header class="blog-post-title">

				<?php the_title( '<' . esc_attr( $heading ) . ' class="single-post-title">', '</' . esc_attr( $heading ) . '>' ); ?>

				<div class="blog-post-author">

					<?php
					wp_kses_post(
						ctema_get_post_author_avatar(
							array(
								'before' => '<div class="post-author-avatar">',
								'after'  => '</div>',
								'size'   => 80,
							)
						)
					);
					?>

					<div class="blog-post-author-content">
						<?php
						wp_kses_post(
							ctema_get_post_author(
								array(
									'prefix' => esc_html( ctemawp_theme_strings( 'owp-string-written-by', false ) ),
									'before' => '<div class="post-author-name">',
									'after'  => '</div>',
								)
							)
						);
						?>
						<?php
						wp_kses_post(
							ctema_get_post_author_bio(
								array(
									'before' => '<div class="post-author-description">',
									'after'  => '</div>',
								)
							)
						);
						?>
					</div>

				</div><!-- .blog-post-author -->

				<?php if ( true === $display_sph_meta ) { ?>

					<?php do_action( 'ctema_single_post_header_meta' ); ?>

				<?php } ?>

			</header><!-- .blog-post-title -->

			<?php do_action( 'ctema_after_page_header' ); ?>

		</div>
	</div>
</div>
