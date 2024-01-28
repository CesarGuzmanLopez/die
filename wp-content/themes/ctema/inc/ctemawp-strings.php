<?php
/**
 * CtemaWP theme strings
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ctemawp_theme_strings' ) ) {

	/**
	 * CtemaWP Theme Strings
	 *
	 *  @author Amit Singh (apprimit@gmail.com)
	 *  @since 1.8.5
	 *
	 * @param  string  $value  String key.
	 * @param  boolean $echo   Print string.
	 * @return mixed           Return string or nothing.
	 */
	function ctemawp_theme_strings( $value, $echo = true ) {

		$ctemawp_strings = apply_filters(
			'ctemawp_theme_strings',
			array(

				// Headers General.
				'owp-string-open-menu'                   => apply_filters( 'ctema_wai_open_menu', __( 'View website Menu', 'ctemawp' ) ),

				// Vertical Header.
				'owp-string-vertical-header-toggle'      => apply_filters( 'ctema_wai_vertical_header_toggle', __( 'Toggle the button to expand or collapse the Menu', 'ctemawp' ) ),
				'owp-string-vertical-header-anchor'      => apply_filters( 'ctema_vertical_header_anchor', _x( 'vertical-header-toggle', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),

				// Full Screen Header.
				'owp-string-fullscreen-header-anchor'    => apply_filters( 'ctema_full_screen_anchor', _x( 'header-menu-toggle', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),

				// Mobile General.
				'owp-string-mobile-icon-anchor'          => apply_filters( 'ctema_mobile_icon_anchor', _x( 'mobile-menu-toggle', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),
				'owp-string-close-mobile-menu'           => apply_filters( 'ctema_wai_close_mobile_menu', __( 'Close mobile menu', 'ctemawp' ) ),
				'owp-string-mh-search-close-anchor'      => apply_filters( 'ctema_mh_search_close_anchor', _x( 'mobile-header-search-close', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),

				// Mobile Sidebar Header Style.
				'owp-string-sidr-close-anchor'           => apply_filters( 'ctema_sidr_close_anchor', _x( 'sidr-menu-close', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),

				// Mobile Full Screen Header Style.
				'owp-string-mobile-fullscreen-anchor'    => apply_filters( 'ctema_mobile_fullscreen_anchor', _x( 'mobile-fullscreen-menu', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),

				// Search Forms General.
				'owp-string-search-form-label'           => apply_filters( 'ctema_wai_search_form_label', __( 'Search this website', 'ctemawp' ) ),
				'owp-string-close-search-form'           => apply_filters( 'ctema_wai_close_search_form', __( 'Close this search form', 'ctemawp' ) ),
				'owp-string-search-field'                => apply_filters( 'ctema_wai_search_field', __( 'Insert search query', 'ctemawp' ) ),
				'owp-string-search-text'                 => apply_filters( 'ctema_search_text', __( 'Search', 'ctemawp' ) ),

				// Mobile Search Forms General.
				'owp-string-mobile-search-text'          => apply_filters( 'ctema_mobile_search_text', __( 'Search', 'ctemawp' ) ),
				'owp-string-mobile-submit-search'        => apply_filters( 'ctema_wai_mobile_search_submit', __( 'Submit search', 'ctemawp' ) ),
				'owp-string-mobile-search-anchor'        => apply_filters( 'ctema_mobile_search_anchor', _x( 'mobile-header-search', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),

				// Search Header Replace.
				'owp-string-header-replace-search-text'  => apply_filters( 'ctema_header_replace_search_text', __( 'Type then hit enter to search...', 'ctemawp' ) ),

				// Search Hader Overlay.
				'owp-string-hs-overlay-close-anchor'     => apply_filters( 'ctema_hs_overlay_close_anchor', _x( 'hsoverlay-close', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'ctemawp' ) ),

				// Main.
				'owp-string-header-skip-link'            => apply_filters( 'ctema_header_skip_link', __( 'Skip to content', 'ctemawp' ) ),
				'owp-string-scroll-top'                  => apply_filters( 'ctema_wai_scroll_top', __( 'Scroll to the top of the page', 'ctemawp' ) ),

				'owp-string-mobile-fs-search-text'       => apply_filters( 'ctema_mobile_fs_search_text', __( 'Type your search', 'ctemawp' ) ),

				'owp-string-search-overlay-search-text'  => apply_filters( 'ctema_search_overlay_search_text', __( 'Type then hit enter to search', 'ctemawp' ) ),
				'owp-string-vertical-header-search-text' => apply_filters( 'ctema_vertical_header_search_text', __( 'Search...', 'ctemawp' ) ),
				'owp-string-medium-header-search-text'   => apply_filters( 'ctema_medium_header_search_text', __( 'Search...', 'ctemawp' ) ),

				// Comments.
				'owp-string-comment-logout-text'         => apply_filters( 'ctema_comment_logout_text', __( 'Log out of this account', 'ctemawp' ) ),
				'owp-string-comment-placeholder'         => apply_filters( 'ctema_comment_placeholder', __( 'Your comment here...', 'ctemawp' ) ),
				'owp-string-comment-profile-edit'        => apply_filters( 'ctema_comment_profile_edit', __( 'Click to edit your profile', 'ctemawp' ) ),
				'owp-string-comment-post-button'         => apply_filters( 'ctema_comment_post_button', __( 'Post Comment', 'ctemawp' ) ),
				'owp-string-comment-name-req'            => apply_filters( 'ctema_comment_name_req', __( 'Name (required)', 'ctemawp' ) ),
				'owp-string-comment-email-req'           => apply_filters( 'ctema_comment_email_req', __( 'Email (required)', 'ctemawp' ) ),
				'owp-string-comment-name'                => apply_filters( 'ctema_comment_name', __( 'Name', 'ctemawp' ) ),
				'owp-string-comment-email'               => apply_filters( 'ctema_comment_email', __( 'Email', 'ctemawp' ) ),
				'owp-string-comment-website'             => apply_filters( 'ctema_comment_website', __( 'Website', 'ctemawp' ) ),

				'owp-string-search-continue-reading'     => apply_filters( 'ctema_search_continue_reading', __( 'Continue Reading', 'ctemawp' ) ),
				'owp-string-post-continue-reading'       => apply_filters( 'ctema_post_continue_reading', __( 'Continue Reading', 'ctemawp' ) ),
				'owp-string-single-related-posts'        => apply_filters( 'ctema_single_related_posts', __( 'You Might Also Like', 'ctemawp' ) ),
				'owp-string-single-next-post'            => apply_filters( 'ctema_single_next_post', __( 'Next Post', 'ctemawp' ) ),
				'owp-string-single-prev-post'            => apply_filters( 'ctema_single_prev_post', __( 'Previous Post', 'ctemawp' ) ),
				'owp-string-single-screen-reader-rm'     => apply_filters( 'ctema_single_screen_reader_rm', __( 'Read more articles', 'ctemawp' ) ),
				'owp-string-author-page'                 => apply_filters( 'ctema_author_page', __( 'Visit author page', 'ctemawp' ) ),

				// Woocommerce.
				'owp-string-woo-quick-view-text'         => apply_filters( 'ctema_woo_quick_view_text', __( 'Quick View', 'ctemawp' ) ),
				'owp-string-woo-quick-view-close'        => apply_filters( 'ctema_woo_quick_view_close', __( 'Close quick preview', 'ctemawp' ) ),
				'owp-string-woo-floating-bar-select-btn' => apply_filters( 'ctema_woo_floating_bar_select_btn', __( 'Select Options', 'ctemawp' ) ),
				'owp-string-woo-floating-bar-selected'   => apply_filters( 'ctema_woo_floating_bar_selected', __( 'Selected:', 'ctemawp' ) ),
				'owp-string-woo-floating-bar-out-stock'  => apply_filters( 'ctema_woo_floating_bar_out_stock', __( 'Out of stock', 'ctemawp' ) ),
				'owp-string-woo-nav-next-product'        => apply_filters( 'ctema_woo_nav_next_text', __( 'Next Product', 'ctemawp' ) ),
				'owp-string-woo-nav-prev-product'        => apply_filters( 'ctema_woo_nav_prev_text', __( 'Previous Product', 'ctemawp' ) ),

				// Aria.
				'owp-string-website-search-icon'         => apply_filters( 'ctema_wai_website_search_icon', __( 'Toggle website search', 'ctemawp' ) ),
				'owp-string-website-search-form'         => apply_filters( 'ctema_wai_website_search_form', __( 'Website search form', 'ctemawp' ) ),
				'owp-string-mobile-search'               => apply_filters( 'ctema_wai_mobile_search', __( 'Search for:', 'ctemawp' ) ),
				'owp-string-fullscreen-submit-search'    => apply_filters( 'ctema_wai_fullscreen_search_submit', __( 'After typing hit enter to submit search query', 'ctemawp' ) ),
				'owp-string-link-post-format'            => apply_filters( 'ctema_wai_link_post_format', __( 'Visit this link', 'ctemawp' ) ),
				'owp-string-new-tab-alert'               => apply_filters( 'ctema_wai_new_tab_alert', __( 'Opens in a new tab', 'ctemawp' ) ),
				'owp-string-read-more'                   => apply_filters( 'ctema_wai_read_more', __( 'Read more about', 'ctemawp' ) ),
				'owp-string-read-more-article'           => apply_filters( 'ctema_wai_read_more_article', __( 'Read more about the article', 'ctemawp' ) ),
				'owp-string-current-read'                => apply_filters( 'ctema_wai_current_read', __( 'You are currently viewing', 'ctemawp' ) ),
				'owp-string-author-img'                  => apply_filters( 'ctema_wai_author_img', __( 'Post author avatar', 'ctemawp' ) ),

				// Woo Aria.
				'owp-string-wai-next-product'            => apply_filters( 'ctema_wai_next_product', __( 'View next product', 'ctemawp' ) ),
				'owp-string-wai-prev-product'            => apply_filters( 'ctema_wai_prev_product', __( 'View previous product', 'ctemawp' ) ),

				// Post Header templates.
				'owp-string-posted-by'                   => apply_filters( 'ctema_posted_by', _x( 'By', 'Prefix for post author name', 'ctemawp' ) ),
				'owp-string-written-by'                  => apply_filters( 'ctema_written_by', _x( 'Written by', 'Prefix for post author name', 'ctemawp' ) ),
				'owp-string-all-posts-by'                => apply_filters( 'ctema_wai_all_posts_by', _x( 'All posts by', 'Aria label prefix for post author link', 'ctemawp' ) ),
				'owp-string-posted-on'                   => apply_filters( 'ctema_posted_on', _x( 'Published', 'Prefix for post published date', 'ctemawp' ) ),
				'owp-string-updated-on'                  => apply_filters( 'ctema_updated_on', _x( 'Updated', 'Prefix for post modified date', 'ctemawp' ) ),
				'owp-string-reading-one'                 => apply_filters( 'ctema_reading_one', _x( 'min read', 'Suffix for post reading time equal to 1', 'ctemawp' ) ),
				'owp-string-reading-more'                => apply_filters( 'ctema_reading_more', _x( 'mins read', 'Suffix for post reading time more than 1', 'ctemawp' ) ),
				'owp-string-posted-in'                   => apply_filters( 'ctema_posted_in', _x( 'Posted in', 'Prefix for categories list', 'ctemawp' ) ),
				'owp-string-tagged-as'                   => apply_filters( 'ctema_tagged_as', _x( 'Tagged as', 'Prefix for tags list', 'ctemawp' ) ),
				'owp-string-wai-updated-on'              => apply_filters( 'ctema_wai_updated_on', _x( 'Updated on', 'Aria label: post modified date', 'ctemawp' ) ),
				'owp-string-wai-published-on'            => apply_filters( 'ctema_wai_published_on', _x( 'Published on', 'Aria label: post published date', 'ctemawp' ) ),
				'owp-string-wai-reading-time'            => apply_filters( 'ctema_wai_reading_time', _x( 'Reading time', 'Aria label: post reading time', 'ctemawp' ) ),
				'owp-string-wai-comments'                => apply_filters( 'ctema_wai_comments', _x( 'Comments', 'Aria label: post comments', 'ctemawp' ) ),

			)
		);

		if ( is_rtl() ) {
			// do your stuff.
		}

		$owp_string = isset( $ctemawp_strings[ $value ] ) ? $ctemawp_strings[ $value ] : '';

		/**
		 * Print or return strings
		 */
		if ( $echo ) {
			echo $owp_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped on function usage.
		} else {
			return $owp_string;
		}
	}
}
