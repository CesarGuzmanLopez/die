<?php
/**
 * The default template for displaying post meta.
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get meta sections.
$sections = ctemawp_blog_entry_meta();

// Return if sections are empty.
if ( empty( $sections ) ) {
	return;
}

// Get meta separator style.
$meta_class = ctemawp_theme_blog_meta_separator();

do_action( 'ctema_before_blog_entry_meta' );
?>

<ul class="meta obem-<?php echo $meta_class; ?> clr" aria-label="<?php esc_attr_e( 'Post details:', 'ctemawp' ); ?>">

	<?php
	// Loop through meta sections.
	foreach ( $sections as $section ) {
		?>

		<?php if ( 'author' === $section ) { ?>
			<li class="meta-author"<?php ctemawp_schema_markup( 'author_name' ); ?>><span class="screen-reader-text"><?php esc_html_e( 'Post author:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'user' ); ?><?php echo esc_html( the_author_posts_link() ); ?></li>
		<?php } ?>

		<?php if ( 'date' === $section ) { ?>
			<li class="meta-date"<?php ctemawp_schema_markup( 'publish_date' ); ?>><span class="screen-reader-text"><?php esc_html_e( 'Post published:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'date' ); ?><?php echo get_the_date(); ?></li>
		<?php } ?>

		<?php if ( 'mod-date' === $section ) { ?>
			<li class="meta-mod-date"<?php ctemawp_schema_markup( 'modified_date' ); ?>><span class="screen-reader-text"><?php esc_html_e( 'Post last modified:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'm_date' ); ?><?php echo esc_html( get_the_modified_date() ); ?></li>
		<?php } ?>

		<?php if ( 'categories' === $section ) { ?>
			<li class="meta-cat"><span class="screen-reader-text"><?php esc_html_e( 'Post category:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'category' ); ?><?php the_category( '<span class="owp-sep" aria-hidden="true">/</span>', get_the_ID() ); ?></li>
		<?php } ?>

		<?php if ( 'reading-time' === $section ) { ?>
			<li class="meta-cat"><span class="screen-reader-text"><?php esc_html_e( 'Reading time:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'r_time' ); ?><?php echo esc_html( ctema_reading_time() ); ?></li>
		<?php } ?>

		<?php if ( 'comments' === $section && comments_open() && ! post_password_required() ) { ?>
			<li class="meta-comments"><span class="screen-reader-text"><?php esc_html_e( 'Post comments:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'comment' ); ?><?php comments_popup_link( esc_html__( '0 Comments', 'ctemawp' ), esc_html__( '1 Comment', 'ctemawp' ), esc_html__( '% Comments', 'ctemawp' ), 'comments-link' ); ?></li>
		<?php } ?>

	<?php } ?>

</ul>

<?php do_action( 'ctema_after_blog_entry_meta' ); ?>
