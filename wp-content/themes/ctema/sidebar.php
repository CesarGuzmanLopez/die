<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package CtemaWP WordPress theme
 */

// Retunr if full width or full screen.
if ( in_array( ctemawp_post_layout(), array( 'full-screen', 'full-width' ), true ) ) {
	return;
} ?>

<?php do_action( 'ctema_before_sidebar' ); ?>

<aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary"<?php ctemawp_schema_markup( 'sidebar' ); ?> role="complementary" aria-label="<?php esc_attr_e( 'Primary Sidebar', 'ctemawp' ); ?>">

	<?php do_action( 'ctema_before_sidebar_inner' ); ?>

	<div id="right-sidebar-inner" class="clr">

		<?php
		$sidebar = ctemawp_get_sidebar();
		if ( $sidebar ) {
			dynamic_sidebar( $sidebar );
		}
		?>

	</div><!-- #sidebar-inner -->

	<?php do_action( 'ctema_after_sidebar_inner' ); ?>

</aside><!-- #right-sidebar -->

<?php do_action( 'ctema_after_sidebar' ); ?>
