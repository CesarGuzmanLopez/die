<?php
/**
 * CtemaWP Customizer Class
 *
 * @package CtemaWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CtemaWP_Customizer' ) ) :

	/**
	 * The CtemaWP Customizer class
	 */
	class CtemaWP_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_register',					array( $this, 'custom_controls' ) );
			add_action( 'customize_register',					array( $this, 'controls_helpers' ) );
			add_action( 'customize_register',					array( $this, 'customize_register' ), 11 );
			add_action( 'after_setup_theme',					array( $this, 'register_options' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'customize_panel_init' ) );
			add_action( 'customize_preview_init', 				array( $this, 'customize_preview_init' ) );
			add_action( 'customize_controls_enqueue_scripts',   array( $this, 'custom_customize_enqueue' ), 7 );
			add_action( 'customize_controls_print_scripts', 'ctema_get_svg_icon' );
			add_action( 'wp_ajax_ctema_update_search_box_light_mode', array( $this, 'update_search_box_light_Mode' ) );
		}

		/**
		 * Adds custom controls
		 *
		 * @since 1.0.0
		 */
		public function custom_controls( $wp_customize ) {

			// Path
			$dir = CTEMAWP_INC_DIR . 'customizer/controls/';

			// Load customize control classes
			require_once( $dir . 'dimensions/class-control-dimensions.php' 					);
			require_once( $dir . 'dropdown-pages/class-control-dropdown-pages.php' 			);
			require_once( $dir . 'heading/class-control-heading.php' 						);
			require_once( $dir . 'info/class-control-info.php' 	       					);
			require_once( $dir . 'icon-select/class-control-icon-select.php' 				);
			require_once( $dir . 'icon-select-multi/class-control-icon-select-multi.php' 	);
			require_once( $dir . 'multiple-select/class-control-multiple-select.php' 		);
			require_once( $dir . 'slider/class-control-slider.php' 							);
			require_once( $dir . 'sortable/class-control-sortable.php' 						);
			require_once( $dir . 'text/class-control-text.php' 								);
			require_once( $dir . 'textarea/class-control-textarea.php' 						);
			require_once( $dir . 'typo/class-control-typo.php' 								);
			require_once( $dir . 'typography/class-control-typography.php' 					);

			// Register JS control types
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Dimensions_Control' 		);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Dropdown_Pages' 			);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Heading_Control' 			);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Info_Control' 			);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Icon_Select_Control' 		);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Icon_Select_Multi_Control' );
			$wp_customize->register_control_type( 'CtemaWP_Customize_Multiple_Select_Control' 	);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Slider_Control' 			);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Sortable_Control' 		);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Text_Control' 			);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Textarea_Control' 		);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Typo_Control' 			);
			$wp_customize->register_control_type( 'CtemaWP_Customizer_Typography_Control' 		);

		}

		/**
		 * Updating the search box light Mode via Ajax request
		 *
		 * @since 1.0.0
		 */
		public function update_search_box_light_Mode() {
			$darkMode = esc_attr( $_REQUEST['darkMode'] );
			update_option( 'ctemaCustomizerSearchdarkMode', $darkMode );
			wp_send_json_success();
		}

		/**
		 * Adds customizer helpers
		 *
		 * @since 1.0.0
		 */
		public function controls_helpers() {
			require_once( CTEMAWP_INC_DIR .'customizer/customizer-helpers.php' );
			require_once( CTEMAWP_INC_DIR .'customizer/sanitization-callbacks.php' );
		}

		/**
		 * Core modules
		 *
		 * @since 1.0.0
		 */
		public static function customize_register( $wp_customize ) {

			// Tweak default controls
			$wp_customize->get_setting( 'custom_logo' )->transport      = 'refresh';
			$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';

			// Move custom logo setting
			$wp_customize->get_control( 'custom_logo' )->section 		= 'ctema_header_logo';
 

		}

		/**
		 * Adds customizer options
		 *
		 * @since 1.0.0
		 */
		public function register_options() {
			// Var
			$dir = CTEMAWP_INC_DIR .'customizer/settings/';

			// Customizer files array
			$files = array(
				'typography',
				'general',
				'blog',
				'header',
				'topbar',
				'footer-widgets',
				'footer-bottom',
				'sidebar',
			);

			foreach ( $files as $key ) {

				$setting = str_replace( '-', '_', $key );

				// If Ctema Extra is activated
				if ( CTEMA_EXTRA_ACTIVE
					&& class_exists( 'Ctema_Extra_Theme_Panel' ) ) {

					if ( Ctema_Extra_Theme_Panel::get_setting( 'oe_'. $setting .'_panel' ) ) {
						require_once( $dir . $key .'.php' );
					}

				} else {

					require_once( $dir . $key .'.php' );

				}

			}

			// If WooCommerce is activated.
			if ( CTEMAWP_WOOCOMMERCE_ACTIVE ) {
				require_once( $dir .'woocommerce.php' );
			}

			// Easy Digital Downloads Settings.
			if ( CTEMAWP_EDD_ACTIVE ) {
				require_once( $dir .'edd.php' );
			}

			// If LifterLMS is activated.
			if ( CTEMAWP_LIFTERLMS_ACTIVE ) {
				require_once( $dir .'lifterlms.php' );
			}

			// If LearnDash is activated.
			if ( CTEMAWP_LEARNDASH_ACTIVE ) {
				require_once( $dir .'learndash.php' );
			}
		}


		/**
		 * Loads Css files for customizer Panel
		 *
		 * @since 1.0.0
		 */
		public function customize_panel_init() {

			$settings = wp_parse_args( get_option( 'oe_panels_settings', [] ) );

			if ( isset( $settings['customizer-search'] ) && (bool) $settings['customizer-search'] === true ) {
				wp_enqueue_script( 'ctemawp-customize-search-js', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/customize-search.js', array( 'lodash', 'wp-i18n', 'wp-util' ) );
				wp_enqueue_style( 'ctemawp-customize-search', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/customize-search.css' );
				wp_localize_script( 'ctemawp-customize-search-js', 'ctemaCustomizerSearchOptions', [
					'darkMode' => get_option( 'ctemaCustomizerSearchdarkMode', false )
				] );
			}


			wp_enqueue_script( 'ctemawp-customize-js', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/customize.js', array( 'jquery' ) );
			wp_enqueue_style( 'ctemawp-customize-preview', CTEMAWP_INC_DIR_URI . 'customizer/assets/css/customize-preview.min.css');
		}

		/**
		 * Loads js files for customizer preview
		 *
		 * @since 1.0.0
		 */
		public function customize_preview_init() {
			wp_enqueue_script( 'ctemawp-customize-preview', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/customize-preview.min.js', array( 'customize-preview' ), CTEMAWP_THEME_VERSION, true );

			// If WooCommerce is activated.
			if ( CTEMAWP_WOOCOMMERCE_ACTIVE ) {
				wp_enqueue_script( 'ctemawp-woo-customize-preview', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/woo-customize-preview.min.js', array( 'customize-preview' ), CTEMAWP_THEME_VERSION, true );
			}

			// Easy Digital Downloads Settings.
			if ( CTEMAWP_EDD_ACTIVE ) {
				wp_enqueue_script( 'ctemawp-edd-customize-preview', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/edd-customize-preview.min.js', array( 'customize-preview' ), CTEMAWP_THEME_VERSION, true );
			}

			// If LifterLMS is activated.
			if ( CTEMAWP_LIFTERLMS_ACTIVE ) {
				wp_enqueue_script( 'ctemawp-llms-customize-preview', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/llms-customize-preview.min.js', array( 'customize-preview' ), CTEMAWP_THEME_VERSION, true );
			}

			// If LearnDash is activated.
			if ( CTEMAWP_LEARNDASH_ACTIVE ) {
				wp_enqueue_script( 'ctemawp-ld-customize-preview', CTEMAWP_INC_DIR_URI . 'customizer/assets/js/ld-customize-preview.min.js', array( 'customize-preview' ), CTEMAWP_THEME_VERSION, true );
			}
		}

		/**
		 * Load scripts for customizer
		 *
		 * @since 1.0.0
		 */
		public function custom_customize_enqueue() {
			wp_enqueue_style( 'font-awesome', CTEMAWP_THEME_URI .'/assets/fonts/fontawesome/css/all.min.css', false, '5.11.2'  );
			wp_enqueue_style( 'simple-line-icons', CTEMAWP_INC_DIR_URI .'customizer/assets/css/customizer-simple-line-icons.min.css', false, '2.4.0' );
			wp_enqueue_style( 'ctemawp-general', CTEMAWP_INC_DIR_URI . 'customizer/assets/min/css/general.min.css' );
			wp_enqueue_script( 'ctemawp-general', CTEMAWP_INC_DIR_URI . 'customizer/assets/min/js/general.min.js', array( 'jquery', 'customize-base' ), false, true );


			if ( is_rtl() ) {
				wp_enqueue_style( 'ctemawp-controls-rtl', CTEMAWP_INC_DIR_URI . 'customizer/assets/min/css/rtl.min.css' );
			}
		}

	}

endif;

return new CtemaWP_Customizer();
