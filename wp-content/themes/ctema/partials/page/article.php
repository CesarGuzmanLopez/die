<?php
/**
 * Outputs page article
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="entry clr"<?php ctemawp_schema_markup( 'entry_content' ); ?>>

	<?php do_action( 'ctema_before_page_entry' ); ?>

	<?php
	the_content();

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'ctemawp' ),
			'after'  => '</div>',
		)
	);
	?>

	<?php do_action( 'ctema_after_page_entry' ); ?>

</div>
