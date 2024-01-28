<?php
/**
 * PWA support for Theme
 *
 * @package CtemaWP WordPress theme
 *
 * @author Amit Singh (apprimit@gmail.com)
 * @since 1.8.8
 */

// Start and run class.
if ( ! class_exists( 'CtemaWP_PWA' ) ) {

	/**
	 * CtemaWP AMP Setup
	 */
	class CtemaWP_PWA {

		/**
		 * Main Class Constructor
		 */
		public function __construct() {

			if ( ! $this->ctemawp_is_pwa() ) {
				return;
			}

			add_action( 'ctema_do_offline', array( $this, 'offline_default_template' ) );
			add_action( 'ctemawp_do_server_error', array( $this, 'server_error_default_template' ) );

		}

		/**
		 * Check if plugin exist or not.
		 */
		private function ctemawp_is_pwa() {
			return defined( 'PWA_VERSION' ) && function_exists( 'wp_service_worker_error_details_template' ) && function_exists( 'pwa_get_header' ) && function_exists( 'wp_service_worker_error_message_placeholder' ) && function_exists( 'pwa_get_footer' );
		}

		/**
		 *  Offline default template.
		 */
		public function offline_default_template() {
			?>
			<main>
				<h1><?php esc_html_e( 'Oops! It looks like you&#8217;re offline. Please check the network connection.', 'ctemawp' ); ?></h1>
				<?php wp_service_worker_error_message_placeholder(); ?>
			</main>
			<?php
		}

		/**
		 * Server error template.
		 */
		public function server_error_default_template() {

			?>
			<main>
				<h1><?php esc_html_e( 'Oops! Something went wrong. Please try again.', 'ctemawp' ); ?></h1>
				<?php wp_service_worker_error_message_placeholder(); ?>
				<?php wp_service_worker_error_details_template(); ?>
			</main>
			<?php
		}

	}

}
return new CtemaWP_PWA();
