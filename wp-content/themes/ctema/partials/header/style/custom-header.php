<?php
/**
 * Custom Header Style
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get ID.
$get_id = ctemawp_custom_header_template();

// Check if page is Elementor page.
$elementor = get_post_meta( $get_id, '_elementor_edit_mode', true );

// Get content.
$get_content = ctemawp_header_template_content();

// Get classes.
$classes = array( 'clr' );

// Add container class.
if ( true === get_theme_mod( 'ctema_add_custom_header_container', true ) ) {
	$classes[] = 'container';
}

// Turn classes into space seperated string.
$classes = implode( ' ', $classes ); ?>

<?php do_action( 'ctema_before_header_inner' ); ?>

<div id="site-header-inner" class="<?php echo esc_attr( $classes ); ?>">

	<?php

	if ( CTEMAWP_ELEMENTOR_ACTIVE && $elementor ) {

		// If Elementor.
		CtemaWP_Elementor::get_header_content();

	} elseif ( CTEMAWP_BEAVER_BUILDER_ACTIVE && ! empty( $get_id ) ) {

		// If Beaver Builder.
		echo do_shortcode( '[fl_builder_insert_layout id="' . $get_id . '"]' );

	} else if ( class_exists( 'SiteOrigin_Panels' ) && get_post_meta( $get_id, 'panels_data', true ) ) {

		echo SiteOrigin_Panels::renderer()->render( $get_id );

	} else {

		// If Gutenberg.
		if ( ctema_is_block_template( $get_id ) ) {
			$get_content = apply_filters( 'ctema_header_template_content', do_blocks( $get_content ) );
		}

		// Display template content.
		echo do_shortcode( $get_content );

	}

	?>

</div>

<?php get_template_part( 'partials/mobile/mobile-dropdown' ); ?>

<?php do_action( 'ctema_after_header_inner' ); ?>
