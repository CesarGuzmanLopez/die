<?php
/**
 * Blog entry gallery format media
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if Ctema Extra is not active.
if ( ! CTEMA_EXTRA_ACTIVE ) {
	return;
}

// Get attachments.
$attachments = ctemawp_get_gallery_ids( get_the_ID() );

// Return standard entry style if password protected or there aren't any attachments.
if ( post_password_required() || empty( $attachments ) ) {
	get_template_part( 'partials/entry/media/blog-entry' );
	return;
}

// Add images size if blog grid.
if ( 'grid-entry' === ctemawp_blog_entry_style() ) {
	$size = ctemawp_blog_entry_images_size();
} else {
	$size = 'full';
}

?>

<div class="thumbnail">

	<div class="gallery-format clr">

		<?php
		// Loop through each attachment ID.
		foreach ( $attachments as $attachment ) :

			// Get attachment data.
			$attachment_title = get_the_title( $attachment );
			$attachment_alt   = get_post_meta( $attachment, '_wp_attachment_image_alt', true );
			$attachment_alt   = $attachment_alt ? $attachment_alt : $attachment_title;

			// Image width.
			$img_width  = apply_filters( 'ctema_blog_entry_image_width', absint( get_theme_mod( 'ctema_blog_entry_image_width' ) ) );
			$img_height = apply_filters( 'ctema_blog_entry_image_height', absint( get_theme_mod( 'ctema_blog_entry_image_height' ) ) );

			// Images url.
			$img_url = wp_get_attachment_image_src( $attachment, 'full', true );

			if ( CTEMA_EXTRA_ACTIVE
				&& function_exists( 'ctema_extra_image_attributes' ) ) {
				$img_atts = ctema_extra_image_attributes( $img_url[1], $img_url[2], $img_width, $img_height );
			}

			// If Ctema Extra is active and has a custom size.
			if ( CTEMA_EXTRA_ACTIVE
				&& function_exists( 'ctema_extra_resize' )
				&& ! empty( $img_atts ) ) {

				$attachment_html = '<img src="' . ctema_extra_resize( $img_url[0], $img_atts['width'], $img_atts['height'], $img_atts['crop'], true, $img_atts['upscale'] ) . '" alt="' . $attachment_alt . '" width="' . $img_width . '" height="' . $img_height . '" itemprop="image" />';


			} else {

				// Image args.
				$img_args = array(
					'alt' => $attachment_alt,
				);
				if ( ctemawp_get_schema_markup( 'image' ) ) {
					$img_args['itemprop'] = 'image';
				}

				// Get image output.
				$attachment_html = wp_get_attachment_image( $attachment, $size, '', $img_args );

			}

			// Display with lightbox.
			if ( ctemawp_gallery_is_lightbox_enabled() ) {
				?>

				<a href="<?php echo esc_url( wp_get_attachment_url( $attachment ) ); ?>" title="<?php echo esc_attr( $attachment_alt ); ?>" class="gallery-lightbox" data-width="<?php echo esc_attr( $img_url[1] ); ?>" data-height="<?php echo esc_attr( $img_url[2] ); ?>">
					<?php echo wp_kses_post( $attachment_html ); ?>
				</a>

				<?php

			} else {

				// Display single image.
				?>

				<a href="<?php the_permalink(); ?>" class="thumbnail-link">
					<?php echo wp_kses_post( $attachment_html ); ?>
				</a>

				<?php
			}

		endforeach;
		?>

	</div>

</div>
