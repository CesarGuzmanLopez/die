<?php
/**
 * The template for displaying the page subheading
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display subheading if there is one.
if ( $subheading = ctemawp_get_page_subheading() ) :
	?>

	<div class="clr page-subheading">
		<?php echo do_shortcode( $subheading ); ?>
	</div><!-- .page-subheading -->

<?php endif; ?>
