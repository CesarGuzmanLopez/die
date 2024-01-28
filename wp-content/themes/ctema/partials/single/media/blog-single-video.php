<?php
/**
 * Blog single video format media
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

// Get post video.
$video = ctemawp_get_post_video_html();

// Display video if one exists and it's not a password protected post.
if ( $video && ! post_password_required() ) :

	?>
	<div id="post-media" class="thumbnail clr">

		<div class="blog-post-video">

			<?php echo $video; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		</div><!-- .blog-post-video -->

	</div><!-- #post-media -->
	<?php

	// Else display post thumbnail.
else :

	get_template_part( 'partials/single/media/blog-single' );

endif;
