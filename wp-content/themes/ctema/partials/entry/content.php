<?php
/**
 * Displays post entry content
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php do_action( 'ctema_before_blog_entry_content' ); ?>

<div class="blog-entry-summary clr"<?php ctemawp_schema_markup( 'entry_content' ); ?>>

	<?php
	// Display excerpt.
	if ( '500' !== get_theme_mod( 'ctema_blog_entry_excerpt_length', '30' ) ) :
		?>

		<p>
			<?php
			// Display custom excerpt.
			echo ctemawp_excerpt( get_theme_mod( 'ctema_blog_entry_excerpt_length', '30' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</p>

		<?php

		// If excerpts are disabled, display full content.
	else :

		the_content( '', '&hellip;' );

	endif;
	?>

</div><!-- .blog-entry-summary -->

<?php do_action( 'ctema_after_blog_entry_content' ); ?>
