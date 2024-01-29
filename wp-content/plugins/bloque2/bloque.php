<?php
/*
Plugin Name: imagen-personalizada 3.0
Plugin URI: http://www.iztapalapa.uam.mx/
Description: Publica en una página específica de wordpress una imagen sombreada con un boton que redirige 
Author: Jorge Luis
Version: 1.2
Author URI: dxdiag41@gmail.com
*/

// Evita el acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Registra el bloque de "Imagen Licenciatura"
function registrar_bloque_imagen_licenciatura() {
    // Encola los estilos del bloque
    wp_enqueue_style(
        'tu-plugin-imagen-licenciatura-style', // Nombre único para los estilos
        plugins_url('style.css', __FILE__) // Ruta del archivo style.css
    );

    register_block_type('tu-plugin-imagen-licenciatura/imagen-licenciatura', array(
        'editor_script' => 'tu-plugin-imagen-licenciatura-editor-script',
    ));
}
add_action('init', 'registrar_bloque_imagen_licenciatura');

// Registra el script del editor de bloques
function cargar_editor_script_imagen_licenciatura() {
    wp_register_script(
        'tu-plugin-imagen-licenciatura-editor-script',
        plugins_url('editor-script.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components')
    );
}
add_action('init', 'cargar_editor_script_imagen_licenciatura');
