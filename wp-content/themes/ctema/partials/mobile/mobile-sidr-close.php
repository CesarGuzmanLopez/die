<?php
/**
 * Mobile Menu sidr close
 *
 * @package CtemaWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get icon.
$icon_html  = '';
$icon_type  = ctemawp_theme_icon_class();
$theme_icon = ctemawp_theme_icons();
$icon       = $theme_icon['close_x'][ $icon_type ];
$icon_class = get_theme_mod( 'ctema_mobile_menu_close_btn_icon', $icon );

if ( 'svg' === $icon_type ) {
	$icon_html = ctemawp_icon( 'close_x', false );
} else {
	$icon_html = '<i class="icon ' . esc_attr( $icon_class ) . '" aria-hidden="true"></i>';
}

$icon = apply_filters( 'ctema_mobile_menu_close_btn_icon', $icon );

// Text.
$text = get_theme_mod( 'ctema_mobile_menu_close_btn_text' );
$text = ctemawp_tm_translation( 'ctema_mobile_menu_close_btn_text', $text );
$text = $text ? $text : esc_html__( 'Close Menu', 'ctemawp' );

// SEO link txt.
$anchorlink_text = esc_html( ctemawp_theme_strings( 'owp-string-sidr-close-anchor', false ) );

?>

<div id="sidr-close">
	<a href="<?php echo esc_url( ctema_get_site_name_anchors( $anchorlink_text ) ); ?>" class="toggle-sidr-close" aria-label="<?php echo esc_attr( ctemawp_theme_strings( 'owp-string-close-mobile-menu', false ) ); ?>">
		<?php echo wp_kses_post( $icon_html ); ?><span class="close-text"><?php echo do_shortcode( $text ); ?></span>
	</a>
</div>
