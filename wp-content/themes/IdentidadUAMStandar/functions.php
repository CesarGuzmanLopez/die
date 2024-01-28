<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @author CesarGuzmanLopez
 * @package UAM-Die
 */

// Función para cargar hojas de estilo y scripts
function uam_die_cargar_scripts() {

}
add_action('wp_enqueue_scripts', 'uam_die_cargar_scripts');
function uam_die_cargar_clases(){
     // Cargar hojas de estilo
     $version = wp_get_theme()->get('Version');
     wp_enqueue_style('style', get_stylesheet_uri(), array(), $version);
 
     // Cargar scripts
     wp_enqueue_script('global', get_template_directory_uri() . '/assets/js/global.js', array('jquery'), $version, true);

     wp_enqueue_style('main.css', get_template_directory_uri() . "/assets/css/Tema/main.css", array(), $version, 'all');

    add_image_size('custom-thumbnail', 300, 300, true);
    wp_enqueue_style('principal.css', get_template_directory_uri() . "/assets/css/Tema/principal.css", array(), $version, 'all');
    wp_enqueue_style('wordpress.css', get_template_directory_uri() . "/assets/css/Tema/wordpress.css", array(), $version, 'all');
    wp_enqueue_style('blocks.css', get_template_directory_uri() . "/assets/css/blocks.css", array(), $version, 'all');
    add_theme_support('editor-styles');
    //habilito  el editor de bloques
    add_theme_support('wp-block-styles');
    //


}
add_action('wp_enqueue_scripts', 'uam_die_cargar_clases');
add_action('enqueue_block_editor_assets', 'uam_die_cargar_clases');



// Función para configurar el tema
function uam_die_setup() {
    // Habilitar feeds automáticos
    add_theme_support('automatic-feed-links');

    // Habilitar título personalizable
    add_theme_support('title-tag');

    // Habilitar formatos de entrada personalizados
    add_theme_support('post-formats', array(
        'link',
        'aside',
        'gallery',
        'image',
        'quote',
        'status',
        'video',
        'audio',
        'chat',
    ));

    // Habilitar formatos de entrada personalizados (ej. gallery)
    add_theme_support('post-formats', array('gallery'));

    // Habilitar formatos de entrada personalizados (ej. gallery)
    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ));

    // Establecer el ancho del contenido
    if (!isset($content_width)) {
        $content_width = 616;
    }

    // Habilitar miniaturas de entradas
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 350, 350, true );
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(88, 88, true);

    // Agregar tamaños personalizados de imagen
    add_image_size('post-image', 816, 9999);
    add_image_size('post-image-thumb', 400, 200, true);

    // Registrar menús de navegación
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'uam_die'),
        'secondary' => __('Menú Secundario', 'uam_die'),
        'social' => __('Menú Social', 'uam_die'),
    ));

    // Habilitar logotipo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 240,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('blog-title', 'blog-description'),
    ));

    // Habilitar soporte para responsive embeds
    add_theme_support('responsive-embeds');

    // Habilitar soporte para alineación amplia
    add_theme_support('align-wide');

    // Habilitar soporte para Selective Refresh en widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Hacer que el tema sea compatible con la traducción
    load_theme_textdomain('uam_die', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'uam_die_setup');


// Función para registrar la sección y controles del personalizador
function personalizador_logo_header($wp_customize) {
    // Sección para logotipos del encabezado
    $wp_customize->add_section('logo_header_section', array(
        'title'    => __('Logotipos del Encabezado', 'identidad-uam-standar'),
        'priority' => 30,
    ));

    // Control para subir la imagen del primer logotipo
    $wp_customize->add_setting('logo_header_1_setting', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_header_1_control', array(
        'label'    => __('Subir Logotipo 1', 'identidad-uam-standar'),
        'section'  => 'logo_header_section',
        'settings' => 'logo_header_1_setting',
        'height'   => 240,
        'width'    => 320,
        'flex-height' => true,
        'flex-width'  => true,
    )));

    // Control para agregar el enlace del primer logotipo (interno o externo)
    $wp_customize->add_setting('logo_header_1_link_setting', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'logo_header_1_link_control', array(
        'label'    => __('Enlace para Logotipo 1', 'identidad-uam-standar'),
        'section'  => 'logo_header_section',
        'settings' => 'logo_header_1_link_setting',
        'type'     => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ingrese un enlace interno o externo',
        ),
    )));

    // Control para subir la imagen del segundo logotipo
    $wp_customize->add_setting('logo_header_2_setting', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_header_2_control', array(
        'label'    => __('Subir Logotipo 2', 'identidad-uam-standar'),
        'section'  => 'logo_header_section',
        'settings' => 'logo_header_2_setting',
        'height'   => 240,
        'width'    => 320,
        'flex-height' => true,
        'flex-width'  => true,
    )));

    // Control para agregar el enlace del segundo logotipo (interno o externo)
    $wp_customize->add_setting('logo_header_2_link_setting', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'logo_header_2_link_control', array(
        'label'    => __('Enlace para Logotipo 2', 'identidad-uam-standar'),
        'section'  => 'logo_header_section',
        'settings' => 'logo_header_2_link_setting',
        'type'     => 'text',
        'input_attrs' => array(
            'placeholder' => 'Ingrese un enlace interno o externo',
        ),
    )));
}
add_action('customize_register', 'personalizador_logo_header');

// Registrar áreas de widgets
function uam_die_sidebar_registration() {
    register_sidebar(array(
        'name'          => __('Barra lateral', 'uam_die'),
        'id'            => 'sidebar',
        'description'   => __('Los widgets en esta área se mostrarán en la barra lateral.', 'uam_die'),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
    ));
}
add_action('widgets_init', 'uam_die_sidebar_registration');

// Registrar área de widgets personalizada
function register_custom_widget_area() {
    register_sidebar(
        array(
            'id'            => 'pie-de-pagina',
            'name'          => esc_html__('Pie de Página', 'uam_die'),
            'description'   => esc_html__('Un área de widgets personalizada para pruebas', 'uam_die'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="pie-title-holder"><h3 class="sidebar-pie">',
            'after_title'   => '</h3></div>',
        )
    );
}
add_action('widgets_init', 'register_custom_widget_area');

// Registrar área de widgets de la barra de la cabecera
function custom_header_sidebar() {
    register_sidebar(array(
        'name'          => 'barra de Cabecera',
        'id'            => 'header-sidebar',
        'description'   => 'Esta es la barra que aparecerá en la cabecera. enmedio entre barra de busqueda y logos',
        'before_widget' => '<div class="header-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'custom_header_sidebar');

// Registrar área de widgets de la barra de la página principal
function custom_principal_sidebar() {
    register_sidebar(array(
        'name'          => 'barra de Página Principal',
        'id'            => 'principal-sidebar',
        'description'   => 'Esta es la barra que aparecerá en la página principal.',
        'before_widget' => '<div class="principal-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'custom_principal_sidebar');

// Agregar barra de widgets que irá abajo del menú principal en todas las páginas
function custom_menu_sidebar() {
    register_sidebar(array(
        'name'          => 'barra bajo del Menu',
        'id'            => 'bajo-menu-sidebar',
        'description'   => 'Esta es la barra que aparecerá en la parte inferior del menú principal. servirá para noticias y eventos importantes.',
        'before_widget' => '<div class="menu-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'custom_menu_sidebar');

// Incluir archivos requeridos
require get_template_directory() . '/inc/classes/class-uam-die-customizer.php';
require get_template_directory() . '/inc/classes/post-type-switcher.php';
require get_template_directory() . '/inc/widgets/sliders.php';

// Modificar texto personalizado para "Leer más"
function uam_die_modify_read_more_link() {
    return '<p><a class="more-link" href="' . get_permalink() . '">' . __('Leer más', 'uam_die') . '</a></p>';
}
add_filter('the_content_more_link', 'uam_die_modify_read_more_link');

// Agregar clases al body
function uam_die_body_classes($classes) {
    if (is_single() && has_post_thumbnail()) {
        $classes[] = 'has-featured-image';
    }
    return $classes;
}
add_filter('body_class', 'uam_die_body_classes');



// Mostrar o no la barra lateral en cada página
function custom_sidebar_option_meta_box() {
    add_meta_box(
        'show_sidebar_meta_box',
        'Mostrar Barra Lateral',
        'custom_sidebar_option_meta_box_callback',
        'page', // Aquí puedes especificar otro tipo de contenido si es necesario.
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_sidebar_option_meta_box');

function custom_sidebar_option_meta_box_callback($post) {
    $show_sidebar = get_post_meta($post->ID, 'show_sidebar', true);
    ?>
    <label for="show_sidebar">¿Mostrar la barra lateral en esta página?</label>
    <select name="show_sidebar" id="show_sidebar">
        <option value="yes" <?php selected($show_sidebar, 'yes'); ?>>Sí</option>
        <option value="no" <?php selected($show_sidebar, 'no'); ?>>No</option>
    </select>
    <?php
}

function save_custom_sidebar_option($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['show_sidebar'])) {
        update_post_meta($post_id, 'show_sidebar', sanitize_text_field($_POST['show_sidebar']));
    }
}
add_action('save_post', 'save_custom_sidebar_option');

// Mostrar o no la imagen destacada en cada página
function custom_thumbnail_option_meta_box() {
    add_meta_box(
        'show_thumbnail_meta_box',
        'Mostrar Imagen Destacada',
        'custom_thumbnail_option_meta_box_callback',
        'page', // Aquí puedes especificar otro tipo de contenido si es necesario.
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_thumbnail_option_meta_box');

function custom_thumbnail_option_meta_box_callback($post) {
    $show_thumbnail = get_post_meta($post->ID, 'show_thumbnail', true);
    ?>
    <label for="show_thumbnail">¿Mostrar la imagen destacada en esta página?</label>
    <select name="show_thumbnail" id="show_thumbnail">
        <option value="yes" <?php selected($show_thumbnail, 'yes'); ?>>Sí</option>
        <option value="no" <?php selected($show_thumbnail, 'no'); ?>>No</option>
    </select>
    <?php
}

function save_custom_thumbnail_option($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['show_thumbnail'])) {
        update_post_meta($post_id, 'show_thumbnail', sanitize_text_field($_POST['show_thumbnail']));
    }
}
add_action('save_post', 'save_custom_thumbnail_option');

// Mostrar o no el título de la página en cada página
function custom_title_option_meta_box() {
    add_meta_box(
        'show_title_meta_box',
        'Mostrar Título',
        'custom_title_option_meta_box_callback',
        'page', // Aquí puedes especificar otro tipo de contenido si es necesario.
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_title_option_meta_box');

function custom_title_option_meta_box_callback($post) {
    $show_title = get_post_meta($post->ID, 'show_title', true);
    ?>
    <label for="show_title">¿Mostrar el título de la página?</label>
    <select name="show_title" id="show_title">
        <option value="yes" <?php selected($show_title, 'yes'); ?>>Sí</option>
        <option value="no" <?php selected($show_title, 'no'); ?>>No</option>
    </select>
    <?php
}

function save_custom_title_option($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['show_title'])) {
        update_post_meta($post_id, 'show_title', sanitize_text_field($_POST['show_title']));
    }
}
add_action('save_post', 'save_custom_title_option');

// Desactivar por completo los comentarios en WordPress
function uam_die_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

// Cerrar comentarios en el front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Ocultar comentarios existentes
add_filter('comments_array', '__return_empty_array', 10, 2);

// Quitar enlaces de comentarios del admin bar
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Quitar enlaces de comentarios del admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

// Quitar widgets del dashboard
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
    foreach ($wp_meta_boxes["dashboard"] as $position => $core) {
        foreach ($core["core"] as $widget_id => $widget_info) {
            remove_meta_box($widget_id, 'dashboard', $position);
        }
    }
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 1000000);
