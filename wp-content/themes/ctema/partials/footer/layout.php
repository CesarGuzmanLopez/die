<?php
/**
 * Footer layout
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<footer id="footer" class="<?php echo esc_attr( ctemawp_footer_classes() ); ?>"<?php ctemawp_schema_markup( 'footer' ); ?> role="contentinfo">

	<?php do_action( 'ctema_before_footer_inner' ); ?>

	<div id="footer-inner" class="clr">

		<?php

		// Display the footer widgets if enabled.
		if ( ctemawp_display_footer_widgets() ) {
			get_template_part( 'partials/footer/widgets' );
		}

		// Display the footer bottom if enabled.
		if ( ctemawp_display_footer_bottom() ) {
			get_template_part( 'partials/footer/copyright' );
		}

		?>

	</div><!-- #footer-inner -->

	<?php do_action( 'ctema_after_footer_inner' ); ?>

</footer><!-- #footer -->
