<?php
/**
 * Beaver Themer class
 *
 * @package CtemaWP WordPress theme
 */

// If Beaver Builder or Beaver Themer plugins doesn't exist then return.
if ( ! CTEMAWP_BEAVER_BUILDER_ACTIVE
	|| ! class_exists( 'FLThemeBuilderLoader' ) ) {
	return;
}

if ( ! class_exists( 'CtemaWP_Beaver_Themer' ) ) :

	class CtemaWP_Beaver_Themer {

		/**
		 * Setup class.
		 *
		 * @since 1.2.5
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'header_footer_support' ) );
			add_action( 'wp', array( $this, 'header_footer_render' ) );
			add_action( 'wp', array( $this, 'page_content_render' ) );
			add_filter( 'fl_theme_builder_part_hooks', array( $this, 'register_part_hooks' ) );
		}

		/**
		 * Add theme support
		 *
		 * @since 1.2.5
		 */
		public function header_footer_support() {
			add_theme_support( 'fl-theme-builder-headers' );
			add_theme_support( 'fl-theme-builder-footers' );
			add_theme_support( 'fl-theme-builder-parts' );
		}

		/**
		 * Update header/footer with Beaver template
		 *
		 * @since 1.2.5
		 */
		public function header_footer_render() {

			// Get the header ID.
			$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();

			// If we have a header, remove the theme top bar and header and hook in Theme Builder's.
			if ( ! empty( $header_ids ) ) {
				remove_action( 'ctema_top_bar', 'ctemawp_top_bar_template' );
				remove_action( 'ctema_header', 'ctemawp_header_template' );
				add_action( 'ctema_header', 'FLThemeBuilderLayoutRenderer::render_header' );
			}

			// Get the footer ID.
			$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();

			// If we have a footer, remove the theme footer and hook in Theme Builder's.
			if ( ! empty( $footer_ids ) ) {
				remove_action( 'ctema_footer', 'ctemawp_footer_template' );
				add_action( 'ctema_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
			}
		}

		/**
		 * Remove page header if page's content layouts with Beaver template
		 *
		 * @since 1.2.5
		 */
		public function page_content_render() {

			// Get the page ID.
			$page_ids = FLThemeBuilderLayoutData::get_current_page_content_ids();

			// If we have a content layout, remove the theme page header.
			if ( ! empty( $page_ids ) ) {
				remove_action( 'ctema_page_header', 'ctemawp_page_header_template' );
			}
		}

		/**
		 * Register hooks
		 *
		 * @since 1.2.5
		 */
		public function register_part_hooks() {

			return array(
				array(
					'label' => esc_html__( 'Page', 'ctemawp' ),
					'hooks' => array(
						'ctema_before_outer_wrap' 			=> esc_html__( 'Before Page', 'ctemawp' ),
						'ctema_after_outer_wrap' 			=> esc_html__( 'After Page', 'ctemawp' ),
					),
				),
				array(
					'label' => esc_html__( 'Top Bar', 'ctemawp' ),
					'hooks' => array(
						'ctema_before_top_bar' 				=> esc_html__( 'Before Top Bar', 'ctemawp' ),
						'ctema_before_top_bar_inner' 		=> esc_html__( 'Before Top Bar Inner', 'ctemawp' ),
						'ctema_after_top_bar_inner' 		=> esc_html__( 'After Top Bar Inner', 'ctemawp' ),
						'ctema_after_header'  				=> esc_html__( 'After Top Bar', 'ctemawp' ),
					),
				),
				array(
					'label' => esc_html__( 'Header', 'ctemawp' ),
					'hooks' => array(
						'ctema_before_header' 				=> esc_html__( 'Before Header', 'ctemawp' ),
						'ctema_before_header_inner' 		=> esc_html__( 'Before Header Inner', 'ctemawp' ),
						'ctema_after_header_inner'  		=> esc_html__( 'After Header Inner', 'ctemawp' ),
						'ctema_after_header'  				=> esc_html__( 'After Header', 'ctemawp' ),
					),
				),
				array(
					'label' => esc_html__( 'Page Header', 'ctemawp' ),
					'hooks' => array(
						'ctema_before_page_header' 			=> esc_html__( 'Before Page Header', 'ctemawp' ),
						'ctema_before_page_header_inner' 	=> esc_html__( 'Before Page Header Inner', 'ctemawp' ),
						'ctema_after_page_header_inner'  	=> esc_html__( 'After Page Header Inner', 'ctemawp' ),
						'ctema_after_page_header'  			=> esc_html__( 'After Page Header', 'ctemawp' ),
					),
				),
				array(
					'label' => esc_html__( 'Content', 'ctemawp' ),
					'hooks' => array(
						'ctema_before_content' 				=> esc_html__( 'Before Content', 'ctemawp' ),
						'ctema_before_content_inner' 		=> esc_html__( 'Before Content Inner', 'ctemawp' ),
						'ctema_after_content_inner' 		=> esc_html__( 'After Content Inner', 'ctemawp' ),
						'ctema_after_content' 				=> esc_html__( 'After Content', 'ctemawp' ),
					),
				),
				array(
					'label' => esc_html__( 'Sidebar', 'ctemawp' ),
					'hooks' => array(
						'ctema_before_sidebar' 				=> esc_html__( 'Before Sidebar', 'ctemawp' ),
						'ctema_before_sidebar_inner' 		=> esc_html__( 'Before Sidebar Inner', 'ctemawp' ),
						'ctema_after_sidebar_inner' 		=> esc_html__( 'After Sidebar Inner', 'ctemawp' ),
						'ctema_after_sidebar' 				=> esc_html__( 'After Sidebar', 'ctemawp' ),
					),
				),
				array(
					'label' => esc_html__( 'Footer', 'ctemawp' ),
					'hooks' => array(
						'ctema_before_footer' 				=> esc_html__( 'Before Footer', 'ctemawp' ),
						'ctema_before_footer_inner' 		=> esc_html__( 'Before Footer Inner', 'ctemawp' ),
						'ctema_after_footer_inner' 			=> esc_html__( 'After Footer Inner', 'ctemawp' ),
						'ctema_after_footer' 				=> esc_html__( 'After Footer', 'ctemawp' ),
					),
				),
			);
		}

	}

endif;

return new CtemaWP_Beaver_Themer();