<?php
/*
Plugin Name: Proyectos-Servicios
Description: Este plugiin sirve para crear usuarios y postypes del tipo  
Version: 0.1
Requires at least: 5.0
Author: Cesar Gerardo Guzman Lopez
Author URI: guzman-lopez.com
License: Public Domain
License URI: https://wikipedia.org/wiki/Public_domain
Text Domain: 
*/
// block direct access to this file
if ( !defined( 'ABSPATH' ) ) {
	http_response_code( 404 );
	die();
}
function wporg_custom_post_type() {
	register_post_type('Proyectos',
		array(
			'labels'      => array(
				'name'          => __( 'Proyectos Terminales', 'textdomain' ),
  				'singular_name' => __( 'Proyecto Terminal', 'textdomain' ),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array( 'slug' => 'Proyectos-terminales' ), // my custom slug
		)
	);
    register_post_type('Servicios',
        array(
            'labels'      => array(
                'name'          => __( 'Servicios Sociales', 'textdomain' ),
                'singular_name' => __( 'Servicio Social', 'textdomain' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array( 'slug' => 'Servicios-Sociales' ), // my custom slug
        )
    );
    $cat_name = 'profesor';
    $cat_slug = 'profesor';
    
    // Crear la categoría
    $cat_args = array(
        'description' => '',
        'slug'        => $cat_slug,
        'parent'      => 0,
    );
    $category = wp_insert_term( $cat_name, 'category', $cat_args );
    add_role( 'Profesor', 'Profesor', array(
        'read' => true, // True allows that capability
        'edit_proyectos' => true, // Allows user to edit the "Proyectos" post type
        'edit_servicios' => true, // Allows user to edit the "Servicios" post type
        'edit_posts' => false, // Disallow editing other post types
        'publish_posts' => false, // Disallow publishing other post types
        'edit_published_posts' => false, // Disallow editing published posts of other post types
        'upload_files' => true,
        'delete_published_posts' => false, // Disallow deleting published posts of other post types
    ));
}
add_action('init', 'wporg_custom_post_type');
