<?php
/**
 * Template for displaying archive layout for easy digital downloads
 *
 * @package CtemaWP WordPress theme
 */

global $post;

do_action( 'ctema_before_archive_download_item' );

?>

<div <?php post_class(); ?>>

	<div class="edd_download_inner">

	<?php

	// Get elements.
	$elements = ctemawp_edd_archive_elements_positioning();

	// Loop through elements.
	foreach ( $elements as $element ) {

		// Image.
		if ( 'image' === $element ) {
			do_action( 'ctema_before_archive_download_image' );

			edd_get_template_part( 'shortcode', 'content-image' );

			do_action( 'ctema_after_archive_download_image' );
		}

		// Category.
		if ( 'category' === $element ) {

			do_action( 'ctema_before_archive_download_categories' );

			echo '<div class="edd_download_categories">';

			echo ctemawp_edd_terms_list( 'download_category' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			echo '</div>';

			do_action( 'ctema_after_archive_download_categories' );
		}

		// Title.
		if ( 'title' === $element ) {

			do_action( 'ctema_before_archive_download_title' );

			edd_get_template_part( 'shortcode', 'content-title' );

			do_action( 'ctema_after_archive_download_title' );

		}

		// Price.
		if ( 'price' === $element ) {

			do_action( 'ctema_before_archive_download_price' );

			edd_get_template_part( 'shortcode', 'content-price' );

			do_action( 'ctema_before_archive_download_price' );

		}

		// Description.
		if ( 'description' === $element ) {

			do_action( 'ctema_before_archive_download_description' );

			edd_get_template_part( 'shortcode', 'content-excerpt' );

			do_action( 'ctema_after_archive_download_description' );

		}

		// Add to cart button.
		if ( 'button' === $element ) {

			do_action( 'ctema_before_archive_download_add_to_cart' );

			echo ctemawp_edd_add_to_cart_link(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			do_action( 'ctema_after_archive_download_add_to_cart' );

		}
	}
	?>

	</div>

</div>

<?php

do_action( 'ctema_after_archive_download_item' );
