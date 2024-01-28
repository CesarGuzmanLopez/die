<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package CtemaWP WordPress theme
 */

?>

<div class="page-content">

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

		<p>
			<?php
			/* translators: 1: Admin URL 2: </a> */
			echo sprintf( esc_html__( 'Ready to publish your first post? %1$sGet started here%2$s.', 'ctemawp' ), '<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '" target="_blank">', '</a>' );
			?>
		</p>

	<?php } elseif ( is_search() ) { ?>

		<p>
			<?php
			esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'ctemawp' );
			?>
		</p>

	<?php } elseif ( is_category() ) { ?>

		<p>
			<?php
			esc_html_e( 'There aren\'t any posts currently published in this category.', 'ctemawp' );
			?>
		</p>

	<?php } elseif ( is_tax() ) { ?>

		<p>
			<?php
			esc_html_e( 'There aren\'t any posts currently published under this taxonomy.', 'ctemawp' );
			?>
		</p>

	<?php } elseif ( is_tag() ) { ?>

		<p>
			<?php
			esc_html_e( 'There aren\'t any posts currently published under this tag.', 'ctemawp' );
			?>
		</p>

	<?php } else { ?>

		<p>
			<?php
			esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'ctemawp' );
			?>
		</p>

	<?php } ?>

</div><!-- .page-content -->
