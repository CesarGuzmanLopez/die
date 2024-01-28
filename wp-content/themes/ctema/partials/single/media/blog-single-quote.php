<?php
/**
 * Blog single quote format
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

<div class="post-quote-wrap">

	<div class="post-quote-content">

		<?php echo wp_kses_post( get_post_meta( get_the_ID(), 'ctema_quote_format', true ) ); ?>

		<span class="post-quote-icon"><?php ctemawp_icon( 'quote' ); ?></span>

	</div>

	<div class="post-quote-author"><?php the_title(); ?></div>

</div>
