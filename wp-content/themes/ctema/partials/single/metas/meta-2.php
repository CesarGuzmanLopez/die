<?php
/**
 * Post single header meta style
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or exit;

// Get meta sections.
$sections = ctema_blog_single_header_meta();

// Return if sections are empty, not post type or quote post format.
if ( empty( $sections ) || 'post' !== get_post_type() || 'quote' === get_post_format() ) {
	return;
}

// Don't display modified date if the same as the published date.
$ctema_date_onoff = false;
$ctema_date_onoff = apply_filters( 'ctema_single_header_modified_date_state', $ctema_date_onoff );
$display_mod_date = ( false === $ctema_date_onoff || ( true === $ctema_date_onoff && ( get_the_date() != get_the_modified_date() ) ) ) ? true : false;

do_action( 'ctema_before_single_post_header_meta' );
?>

<ul class="meta-item meta-style-2 <?php echo ctema_blog_single_header_meta_separator_class(); ?>">

	<?php
	// Loop through meta sections.
	foreach ( $sections as $section ) {
		?>

		<?php if ( 'author' === $section ) { ?>
			<li class="meta-author"><?php ctema_get_post_author(); ?></li>
		<?php } ?>

		<?php if ( 'date' === $section ) { ?>
			<li class="meta-date"><?php ctema_get_post_date(); ?></li>
		<?php } ?>

		<?php if ( 'mod-date' === $section && true === $display_mod_date ) { ?>
				<li class="meta-mod-date"><?php ctema_get_post_modified_date(); ?></li>
		<?php } ?>

		<?php if ( 'categories' === $section && has_category() ) { ?>
			<li class="meta-cat"><?php ctema_get_post_categories(); ?></li>
		<?php } ?>

		<?php if ( 'tags' === $section && ! empty( ctema_get_post_tags( '', false ) ) ) { ?>
			<li class="meta-tag"><?php ctema_get_post_tags(); ?></li>
		<?php } ?>

		<?php if ( 'reading-time' === $section ) { ?>
			<li class="meta-rt"><?php ctema_get_post_reading_time(); ?></li>
		<?php } ?>

		<?php if ( 'comments' === $section && comments_open() && ! post_password_required() ) { ?>
			<li class="meta-comments"><?php comments_popup_link( esc_html__( '0 Comments', 'ctemawp' ), esc_html__( '1 Comment', 'ctemawp' ), esc_html__( '% Comments', 'ctemawp' ), 'comments-link' ); ?></li>
		<?php } ?>

	<?php } ?>

</ul>

<?php do_action( 'ctema_after_single_post_header_meta' ); ?>