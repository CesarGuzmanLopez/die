<?php
/**
 * The template for displaying search forms.
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type.
$search_post_type = get_theme_mod( 'ctema_menu_search_source', 'any' );

// Generate unique form ID.
$ctema_sf_id = ctemawp_unique_id( 'ctema-search-form-' );

?>

<form aria-label="<?php echo esc_attr( ctemawp_theme_strings( 'owp-string-search-form-label', false ) ); ?>" role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">	
	<input aria-label="<?php echo esc_attr( ctemawp_theme_strings( 'owp-string-search-field', false ) ); ?>" type="search" id="<?php echo esc_attr( $ctema_sf_id ); ?>" class="field" autocomplete="off" placeholder="<?php echo esc_attr( ctemawp_theme_strings( 'owp-string-search-text', false ) ); ?>" name="s">
	<?php if ( 'any' !== $search_post_type ) { ?>
		<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
	<?php } ?>
	<?php do_action( 'wpml_add_language_form_field' ); ?>
</form>
