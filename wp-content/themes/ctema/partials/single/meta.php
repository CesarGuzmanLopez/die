<?php
/**
 * Post single meta
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get meta sections.
$sections = ctemawp_blog_single_meta();

// Return if sections are empty.
if ( empty( $sections )
	|| 'post' !== get_post_type() ) {
	return;
}

// Return if quote format.
if ( 'quote' === get_post_format() ) {
	return;
}

// Get meta separator class.
$sp_meta_sep_class = ctemawp_theme_single_post_separator();

// Don't display modified date if the same as the published date.
$ctema_date_onoff = false;
$ctema_date_onoff = apply_filters( 'ctema_single_modified_date_state', $ctema_date_onoff );
$display_mod_date = ( false === $ctema_date_onoff || ( true === $ctema_date_onoff && ( get_the_date() != get_the_modified_date() ) ) ) ? true : false;

do_action( 'ctema_before_single_post_meta' );
?>

<ul class="meta ospm-<?php echo $sp_meta_sep_class; ?> clr">

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

		<?php if ( 'mod-date' === $section && true === $display_mod_date ) { ?>
			<li class="meta-mod-date"<?php ctemawp_schema_markup( 'modified_date' ); ?>><span class="screen-reader-text"><?php esc_html_e( 'Post last modified:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'm_date' ); ?><?php echo esc_html( get_the_modified_date() ); ?></li>
		<?php } ?>

		<?php if ( 'categories' === $section ) { ?>
			<li class="meta-cat"><span class="screen-reader-text"><?php esc_html_e( 'Post category:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'category' ); ?><?php the_category( ' <span class="owp-sep">/</span> ', get_the_ID() ); ?></li>
		<?php } ?>

		<?php if ( 'reading-time' === $section ) { ?>
			<li class="meta-cat"><span class="screen-reader-text"><?php esc_html_e( 'Reading time:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'r_time' ); ?><?php echo esc_html( ctema_reading_time() ); ?></li>
		<?php } ?>

		<?php if ( 'comments' === $section && comments_open() && ! post_password_required() ) { ?>
			<li class="meta-comments"><span class="screen-reader-text"><?php esc_html_e( 'Post comments:', 'ctemawp' ); ?></span><?php ctemawp_icon( 'comment' ); ?><?php comments_popup_link( esc_html__( '0 Comments', 'ctemawp' ), esc_html__( '1 Comment', 'ctemawp' ), esc_html__( '% Comments', 'ctemawp' ), 'comments-link' ); ?></li>
		<?php } ?>

	<?php } ?>

</ul>

<?php do_action( 'ctema_after_single_post_meta' ); ?>
