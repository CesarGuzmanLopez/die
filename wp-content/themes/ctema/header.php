<?php
/**
 * The Header for our theme.
 *
 * @package CtemaWP WordPress theme
 */

?>
<!DOCTYPE html>
<html class="<?php echo esc_attr( ctemawp_html_classes() ); ?>" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php ctemawp_schema_markup( 'html' ); ?>>

	<?php wp_body_open(); ?>

	<?php do_action( 'ctema_before_outer_wrap' ); ?>

	<div id="outer-wrap" class="site clr">

		<a class="skip-link screen-reader-text" href="#main"><?php echo esc_html( ctemawp_theme_strings( 'owp-string-header-skip-link', false ) ); ?></a>

		<?php do_action( 'ctema_before_wrap' ); ?>

		<div id="wrap" class="clr">

			<?php do_action( 'ctema_top_bar' ); ?>

			<?php do_action( 'ctema_header' ); ?>

			<?php do_action( 'ctema_before_main' ); ?>

			<main id="main" class="site-main clr"<?php ctemawp_schema_markup( 'main' ); ?> role="main">

				<?php do_action( 'ctema_page_header' ); ?>
