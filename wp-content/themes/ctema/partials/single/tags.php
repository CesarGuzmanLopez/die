<?php
/**
 * Blog single tags
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display tags. ?>
<div class="post-tags clr">
	<?php the_tags( '<span class="owp-tag-text">' . esc_attr__( 'Tags: ', 'ctemawp' ) . '</span>', '<span class="owp-sep">,</span> ', '' ); ?>
</div>
