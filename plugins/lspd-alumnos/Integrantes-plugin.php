<?php
/*
Plugin Name: lspd-alumnos
Description: Este plugiin sirve para crear usuarios y Asi como los post de los alumnos integrantes del lspd
Version: 0.1
Requires at least: 5.0
Author: Soriano Garcia German Gabriel 
Author URI: guzman-lopez.com
License: Public Domain
License URI: https://wikipedia.org/wiki/Public_domain
Text Domain: 
*/


function cargar_biblioteca_medios() {
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'cargar_biblioteca_medios');

function wporg_custom_role() {
    add_role( 'Profesor_1', 'profesor_1', get_role( 'author' )->capabilities );
    $role = get_role( 'profesor_1' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    //$role->add_cap( 'edit_others_posts' ); 
}
add_action('init', 'wporg_custom_role');
include_once( 'Integrantes.php' );