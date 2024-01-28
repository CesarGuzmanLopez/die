<?php
/**
 * The Header for our theme in PWA.
 *
 * @package CtemaWP WordPress theme
 * @since   1.8.8
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
