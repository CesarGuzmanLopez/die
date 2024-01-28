<?php
function uami_die_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'uami-die-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'parent-style' )
    );
    //agrego los estilos al editor
    add_theme_support( 'editor-styles' );
}
add_action( 'wp_enqueue_scripts', 'uami_die_enqueue_styles' );
add_action( 'enqueue_block_editor_assets', 'uami_die_enqueue_styles' );
function uami_die_add_gutenberg_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => 'strong magenta',
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        // Añade más colores aquí
    ));

    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => 'small',
            'size' => 12,
            'slug' => 'small'
        ),
        // Añade más tamaños aquí
    ));
}

add_action( 'after_setup_theme', 'uami_die_add_gutenberg_features' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'uami_die_pattern_categories' ) ) :
    function uami_die_pattern_categories() {

        register_block_pattern_category(
            'page',
            array(
                'label'       => _x( 'Pages', 'Block pattern category' ),
                'description' => __( 'Una coleccion de paginas para el departamento.' ),
            )
        );
    }
endif;

add_action( 'init', 'uami_die_pattern_categories' );