<?php
/**
 * Blog entry audio format media
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

?>

<?php $audio = ctemawp_get_post_audio_html(); ?>

<?php if ( $audio ) : ?>

	<div class="thumbnail"><?php echo $audio; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>

	<?php

else :

	// Else display post thumbnail.
	?>

	<?php get_template_part( 'partials/entry/media/blog-entry' ); ?>

<?php endif; ?>
