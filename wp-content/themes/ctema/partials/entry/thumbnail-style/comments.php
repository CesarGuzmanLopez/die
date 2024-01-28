<?php
/**
 * The default template for displaying post meta.
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'post' === get_post_type() ) {
	?>

	<div class="blog-entry-comments clr">
		<?php ctemawp_icon( 'comment' ); ?><?php comments_popup_link( esc_html__( '0 Comments', 'ctemawp' ), esc_html__( '1 Comment', 'ctemawp' ), esc_html__( '% Comments', 'ctemawp' ), 'comments-link' ); ?>
	</div>

	<?php
}
?>
