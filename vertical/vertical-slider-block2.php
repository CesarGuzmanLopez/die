<?php
/*
Plugin Name: Vertical Slider Block
Description: A Gutenberg block to display a vertical slider with images from the media library.
Version: 3.0
Author: German
*/
function vertical_slider_block2_register_block() {
    // Registrar el script del editor
    wp_register_script(
        'vertical-slider-block2-editor-script',
        plugins_url('editor-script.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components')
    );

    // Registrar los estilos del slider
    wp_register_style(
        'vertical-slider-styles',
        plugins_url('vertical-slider-styles.css', __FILE__)
    );

    // Registrar el bloque en el servidor
    register_block_type('vertical-slider-block2/slider', array(
        'editor_script' => 'vertical-slider-block2-editor-script',
        'editor_style'  => 'vertical-slider-styles',
        'style'         => 'vertical-slider-styles',
    ));
}

add_action('init', 'vertical_slider_block2_register_block');
