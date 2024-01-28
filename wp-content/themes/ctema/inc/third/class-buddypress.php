<?php
/**
 * BuddyPress class
 *
 * @package CtemaWP WordPress theme
 */

// If BuddyPress plugins doesn't exist then return.
if ( ! class_exists( 'BuddyPress' ) ) {
	return;
}

if ( ! class_exists( 'CtemaWP_BuddyPress' ) ) :

	class CtemaWP_BuddyPress {

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
			wp_enqueue_style( 'ctemawp-buddypress', CTEMAWP_CSS_DIR_URI .'third/buddypress.min.css' );
		}

	}

endif;

return new CtemaWP_BuddyPress();