<?php
/**
 * Search Form for The Vertical Header Style
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type.
$search_post_type = get_theme_mod( 'ctema_menu_search_source', 'any' );

?>

<div id="vertical-searchform" class="header-searchform-wrap clr">
	<form id="verh-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-searchform" aria-label="<?php echo esc_attr( ctemawp_theme_strings( 'owp-string-website-search-form', false ) ); ?>">
		<label for="verh-input"><?php echo esc_html( ctemawp_theme_strings( 'owp-string-vertical-header-search-text', false ) ); ?></label>	
		<input aria-labelledby="verh-search verh-input" id="verh-input" type="search" name="s" autocomplete="off" value="" />
		<button class="search-submit"><?php ctemawp_icon( 'search' ); ?><span class="screen-reader-text"><?php echo esc_html( ctemawp_theme_strings( 'owp-string-mobile-submit-search', false ) ); ?></span></button>
		<div class="search-bg"></div>
		<?php if ( 'any' !== $search_post_type ) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
		<?php } ?>
		<?php do_action( 'wpml_add_language_form_field' ); ?>
	</form>
</div><!-- #vertical-searchform -->
