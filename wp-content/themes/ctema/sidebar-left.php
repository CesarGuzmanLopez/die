<?php
/**
 * The left sidebar containing the widget area.
 *
 * @package CtemaWP WordPress theme
 */

?>

<?php do_action( 'ctema_before_sidebar' ); ?>

<aside id="left-sidebar" class="sidebar-container widget-area sidebar-secondary"<?php ctemawp_schema_markup( 'sidebar' ); ?> role="complementary" aria-label="<?php esc_attr_e( 'Secondary Sidebar', 'ctemawp' ); ?>">

	<?php do_action( 'ctema_before_sidebar_inner' ); ?>

	<div id="left-sidebar-inner" class="clr">

		<?php
		$sidebar = ctemawp_get_second_sidebar();
		if ( $sidebar ) {
			dynamic_sidebar( $sidebar );
		}
		?>

	</div><!-- #sidebar-inner -->

	<?php do_action( 'ctema_after_sidebar_inner' ); ?>

</aside><!-- #sidebar -->

<?php do_action( 'ctema_after_sidebar' ); ?>
