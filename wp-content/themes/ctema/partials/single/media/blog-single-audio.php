<?php
/**
 * Blog single audio format media
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

// Get audio html.
$audio = ctemawp_get_post_audio_html();

// Display audio if audio exists and the post isn't protected.
if ( $audio && ! post_password_required() ) :
	?>

	<div id="post-media" class="thumbnail clr">
		<div class="blog-post-audio clr"><?php echo $audio; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	</div>

	<?php
	// Else display post thumbnail.
else :

	get_template_part( 'partials/single/media/blog-single' );

endif;
