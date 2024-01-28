<?php
/**
 * bbPress class
 *
 * @package CtemaWP WordPress theme
 */

// If bbPress plugins doesn't exist then return.
if ( ! class_exists( 'bbPress' ) ) {
	return;
}

if ( ! class_exists( 'CtemaWP_bbPress' ) ) :

	class CtemaWP_bbPress {

		/**
		 * Setup class.
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'add_custom_css' ) );
		}

		/**
		 * Load custom CSS file
		 *
		 * @since 1.4.3
		 */
		public static function add_custom_css() {
			wp_enqueue_style( 'ctemawp-bbpress', CTEMAWP_CSS_DIR_URI .'third/bbpress.min.css' );
		}

	}

endif;

return new CtemaWP_bbPress();