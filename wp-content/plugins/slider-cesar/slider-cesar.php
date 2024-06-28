<?php
/**
 * Plugin Name:       Slider Cesar
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       slider-cesar
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$dir = __DIR__;



 /**
  * Register slidercesar
  */
function slidercesar() {
	$dir = __DIR__;

	$script_asset_path = "$dir/build/slider-cesar.asset.php";

	$index_js     = 'build/slider-cesar.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'slidercesar-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$slider_js = 'build/slidercesar.js';
	wp_register_script(
		'slidercesar',
		plugins_url( $slider_js, __FILE__ ),
		array(),
		$script_asset['version'],
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	$editor_css = 'build/slider-cesar.css';
	wp_register_style(
		'slidercesar-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-slider-cesar.css';
	wp_register_style(
		'slidercesar',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type(
		'slidercesar/slider',
		array(
			'editor_script' => 'slidercesar-editor',
			'editor_style'  => 'slidercesar-editor',
			'style'         => 'slidercesar',
			'script'        => 'slidercesar',
		)
	);
}
add_action( 'init', 'slidercesar' );
