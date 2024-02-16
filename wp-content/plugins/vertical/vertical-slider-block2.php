<?php
/*
Plugin Name: Vertical Slider Block
Description: A Gutenberg block to display a vertical slider with images from the media library.
Version: 3.5
Author: German
*/

// Función para registrar el bloque de slider vertical
function vertical_slider_block2_register_block() {
    // Registrar los estilos del slider
    wp_enqueue_style(
        'vertical-slider-styles', // Nombre único para el estilo
        plugins_url('vertical-slider-styles.css', __FILE__), // URL del archivo CSS
        array(), // No hay dependencias
        filemtime(plugin_dir_path(__FILE__) . 'vertical-slider-styles.css') // Versión basada en la última modificación del archivo
    );

    // Registrar el script del editor
    wp_register_script(
        'vertical-slider-block2-editor-script',
        plugins_url('editor-script.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components')
    );

    // Encolar el script en el frontend
    wp_enqueue_script(
        'vertical-slider-script',
        plugins_url('slider-script.js', __FILE__),
        array(),
        '1.0',
        true // Cargar en el footer
    );

    // Registrar el bloque en el servidor
    register_block_type('vertical-slider-block2/slider', array(
        'editor_script' => 'vertical-slider-block2-editor-script',
        'editor_style'  => 'vertical-slider-styles',
        'style'         => 'vertical-slider-styles',
    ));
}

add_action('init', 'vertical_slider_block2_register_block');
?>