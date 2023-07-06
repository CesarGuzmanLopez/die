<?php
/*
Plugin Name: Proyectos-Servicios
Description: Este plugiin sirve para crear usuarios y Asi como los post de proyectos y servicios
Version: 0.1
Requires at least: 5.0
Author: Cesar Gerardo Guzman Lopez
Author URI: guzman-lopez.com
License: Public Domain
License URI: https://wikipedia.org/wiki/Public_domain
Text Domain: 
*/



// Registrar el tipo de entrada personalizado "Proyectos"
function wporg_custom_post_type() {
    register_post_type('proyectos',
        array(
            'labels'      => array(
                'name'          => __('Proyectos Terminales', 'textdomain'),
                'singular_name' => __('Proyecto Terminal', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'proyectos-terminales'), // Mi slug personalizado
            'supports'    => array('title'),
            'show_in_rest' => true,
            'show_in_menu' => true,
            'hierarchical'      => true,
            'menu_icon'         => 'dashicons-groups',
            'map_meta_cap'      => true,
            'taxonomies'        => array( 'member-type' ),
            'menu_position'     => 3,
        )
    );
    // Registrar el tipo de entrada personalizado "Servicios"
    register_post_type('servicios',
        array(
            'labels'      => array(
                'name'          => __('Servicios Sociales', 'textdomain'),
                'singular_name' => __('Servicio Social', 'textdomain'),
            ),
            'rewrite'     => array('slug' => 'servicios-sociales'), // Mi slug personalizado

            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title'),
            'show_in_rest' => true,
            'show_in_menu' => true,
            'hierarchical'      => true,
            'menu_icon'         => 'dashicons-groups',
            'map_meta_cap'      => true,
            'taxonomies'        => array( 'member-type' ),
            'menu_position'     => 3,
        )
    );
    

}
add_action('init', 'wporg_custom_post_type');

function wporg_custom_role() {
    //Agregar un nuevo rol de usuario "profesor" con capacidades personalizadas
    add_role( 'Profesor_1', 'profesor_1', get_role( 'author' )->capabilities );
    $role = get_role( 'profesor_1' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    //$role->add_cap( 'edit_others_posts' ); 
}
add_action('init', 'wporg_custom_role');


// Agregar una meta box personalizada con un campo de fecha en el tipo de entrada personalizado "Proyectos"
function agregar_meta_box_fecha_proyecto() {
    add_meta_box(
        'fecha_proyecto_meta_box',
        'Vigencia de publicacion',
        'mostrar_campo_fecha_proyecto',
        'proyectos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_fecha_proyecto');

// Mostrar el campo de fecha en la meta box
function mostrar_campo_fecha_proyecto($post) {
    // Obtener el valor de la fecha guardada
    $fecha_proyecto = get_post_meta($post->ID, 'fecha_proyecto', true);

    // Calcular la fecha predeterminada sumando 2 meses a la fecha actual
    $fecha_predeterminada = date('Y-m-d', strtotime('+2 months'));

    // Usar la fecha predeterminada si no hay una fecha guardada
    $valor_predeterminado = !empty($fecha_proyecto) ? $fecha_proyecto : $fecha_predeterminada;

    // Mostrar el campo de fecha
    ?>
    <label for="fecha_proyecto">Fecha:</label>
    <input type="date" id="fecha_proyecto" name="fecha_proyecto" value="<?php echo esc_attr($valor_predeterminado); ?>">
    <?php
}

// Guardar el valor de la fecha cuando se guarda el post
function guardar_fecha_proyecto($post_id) {
    if (isset($_POST['fecha_proyecto'])) {
        $fecha_proyecto = sanitize_text_field($_POST['fecha_proyecto']);
        update_post_meta($post_id, 'fecha_proyecto', $fecha_proyecto);
    }
}
add_action('save_post_proyectos', 'guardar_fecha_proyecto');

// Agregar una meta box personalizada con un campo de descripción en el tipo de entrada personalizado "Proyectos"
function agregar_meta_box_descripcion_proyecto() {
    add_meta_box(
        'descripcion_proyecto_meta_box',
        'Descripción del Proyecto',
        'mostrar_campo_descripcion_proyecto',
        'proyectos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_descripcion_proyecto');

// Mostrar el campo de descripción en la meta box
function mostrar_campo_descripcion_proyecto($post) {
    // Obtener el valor de la descripción guardada
    $descripcion_proyecto = get_post_meta($post->ID, 'descripcion_proyecto', true);
    // Mostrar el campo de descripción
    ?>
    <textarea id="descripcion_proyecto" style="min-width: 500px;" name="descripcion_proyecto"><?php echo esc_textarea($descripcion_proyecto); ?></textarea>
    <?php
}

// Guardar el valor de la descripción cuando se guarda el post
function guardar_descripcion_proyecto($post_id) {
    if (isset($_POST['descripcion_proyecto'])) {
        $descripcion_proyecto = sanitize_textarea_field($_POST['descripcion_proyecto']);
        update_post_meta($post_id, 'descripcion_proyecto', $descripcion_proyecto);
    }
}
add_action('save_post_proyectos', 'guardar_descripcion_proyecto');

// Agregar una meta box personalizada con un campo de habilidades en el tipo de entrada personalizado "Proyectos"
function agregar_meta_box_habilidades() {
    add_meta_box(
        'habilidades_proyecto_meta_box',
        'Habilidades para el Proyecto',
        'mostrar_campo_habilidades',
        'proyectos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_habilidades');

// Mostrar el campo de habilidades en la meta box
function mostrar_campo_habilidades($post) {
    // Obtener el valor de las habilidades guardadas
    $habilidades_proyecto = get_post_meta($post->ID, 'habilidades_proyecto', true);

    // Mostrar el campo de habilidades
    ?>
    <textarea id="habilidades_proyecto" style="min-width: 500px;" name="habilidades_proyecto"><?php echo esc_textarea($habilidades_proyecto); ?></textarea>
    <?php
}

// Guardar el valor de las habilidades_proyecto cuando se guarda el post
function guardar_habilidades_proyecto($post_id) {
    if (isset($_POST['habilidades_proyecto'])) {
        $habilidades_proyecto = sanitize_textarea_field($_POST['habilidades_proyecto']);
        update_post_meta($post_id, 'habilidades_proyecto', $habilidades_proyecto);
    }
}
add_action('save_post_proyectos', 'guardar_habilidades_proyecto');

add_action('add_meta_boxes', 'agregar_meta_box_datos_contacto_proyecto');

// Agregar una meta box personalizada con un campo de Datos de contacto en el tipo de entrada personalizado "Proyectos"
function agregar_meta_box_datos_contacto_proyecto() {
    add_meta_box(
        'datos_contacto_proyecto_meta_box',
        'Datos de Contacto',
        'mostrar_campo_datos_contacto_proyecto',
        'proyectos',
        'normal',
        'high'
    );
}

// Mostrar el campo de datos de contacto en la meta box
function mostrar_campo_datos_contacto_proyecto($post) {
    // Obtener el valor de los datos de contacto guardados
    $datos_contacto_proyecto = get_post_meta($post->ID, 'datos_contacto_proyecto', true);

    // Mostrar el campo de datos de contacto
    ?>
    <textarea id="datos_contacto_proyecto" style="min-width: 500px;" name="datos_contacto_proyecto"><?php echo esc_textarea($datos_contacto_proyecto); ?></textarea>
    <?php
}

//guardar el valor de los datos de contacto cuando se guarda el post
function guardar_datos_contacto_proyecto($post_id) {
    if (isset($_POST['datos_contacto_proyecto'])) {
        $datos_contacto_proyecto = sanitize_textarea_field($_POST['datos_contacto_proyecto']);
        update_post_meta($post_id, 'datos_contacto_proyecto', $datos_contacto_proyecto);
    }
}
add_action('save_post_proyectos', 'guardar_datos_contacto_proyecto');


// Agregar una meta box personalizada con un campo de imagen en el tipo de entrada personalizado "Proyectos"
function agregar_meta_box_imagen_proyecto() {
    add_meta_box(
        'imagen_proyecto_meta_box',
        'Imagen del Proyecto',
        'mostrar_campo_imagen_proyecto',
        'proyectos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_imagen_proyecto');

// Mostrar el campo de imagen en la meta box
function mostrar_campo_imagen_proyecto($post) {
    // Obtener el valor de la imagen guardada
    $imagen_proyecto = get_post_meta($post->ID, 'imagen_proyecto', true);

    // Mostrar el campo de imagen
    ?>
    <label for="imagen_proyecto">Imagen:</label>
    <input type="text" id="imagen_proyecto" name="imagen_proyecto" value="<?php echo esc_attr($imagen_proyecto); ?>" readonly>
    <input type="button" id="imagen_proyecto_button" class="button" value="Seleccionar imagen">
    <p><img src="<?php echo esc_url($imagen_proyecto); ?>" alt="" style="max-width: 200px;"></p>

    <script>
        jQuery(document).ready(function($) {
            var imagenProyectoButton = document.getElementById('imagen_proyecto_button');
            var imagenProyectoInput = document.getElementById('imagen_proyecto');

            imagenProyectoButton.addEventListener('click', function() {
                wp.media.editor.send.attachment = function(props, attachment) {
                    imagenProyectoInput.value = attachment.url;
                    document.querySelector('img').src = attachment.url;
                };
                wp.media.editor.open(imagenProyectoButton);
                return false;
            });
        });
    </script>
    <?php
}

// Guardar el valor de la imagen cuando se guarda el post
function guardar_imagen_proyecto($post_id) {
    if (isset($_POST['imagen_proyecto'])) {
        $imagen_proyecto = sanitize_text_field($_POST['imagen_proyecto']);
        update_post_meta($post_id, 'imagen_proyecto', $imagen_proyecto);
    }
}
add_action('save_post_proyectos', 'guardar_imagen_proyecto');

// Cargar la biblioteca de medios de WordPress
function cargar_biblioteca_medios() {
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'cargar_biblioteca_medios');







// Agregar una meta box personalizada con un campo de fecha en el tipo de entrada personalizado "Servicios"
function agregar_meta_box_fecha_servicio() {
    add_meta_box(
        'fecha_servicio_meta_box',
        'Vigencia de publicación',
        'mostrar_campo_fecha_servicio',
        'servicios',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_fecha_servicio');

// Mostrar el campo de fecha en la meta box
function mostrar_campo_fecha_servicio($post) {
    // Obtener el valor de la fecha guardada
    $fecha_servicio = get_post_meta($post->ID, 'fecha_servicio', true);

    // Calcular la fecha predeterminada sumando 2 meses a la fecha actual
    $fecha_predeterminada = date('Y-m-d', strtotime('+2 months'));

    // Usar la fecha predeterminada si no hay una fecha guardada
    $valor_predeterminado = !empty($fecha_servicio) ? $fecha_servicio : $fecha_predeterminada;

    // Mostrar el campo de fecha
    ?>
    <label for="fecha_servicio">Fecha:</label>
    <input type="date" id="fecha_servicio" name="fecha_servicio" value="<?php echo esc_attr($valor_predeterminado); ?>">
    <?php
}

// Guardar el valor de la fecha cuando se guarda el post
function guardar_fecha_servicio($post_id) {
    if (isset($_POST['fecha_servicio'])) {
        $fecha_servicio = sanitize_text_field($_POST['fecha_servicio']);
        update_post_meta($post_id, 'fecha_servicio', $fecha_servicio);
    }
}
add_action('save_post_servicios', 'guardar_fecha_servicio');

// Agregar una meta box personalizada con un campo de descripción en el tipo de entrada personalizado "Servicios"
function agregar_meta_box_descripcion_servicio() {
    add_meta_box(
        'descripcion_servicio_meta_box',
        'Descripción del Servicio',
        'mostrar_campo_descripcion_servicio',
        'servicios',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_descripcion_servicio');

// Mostrar el campo de descripción en la meta box
function mostrar_campo_descripcion_servicio($post) {
    // Obtener el valor de la descripción guardada
    $descripcion_servicio = get_post_meta($post->ID, 'descripcion_servicio', true);

    // Mostrar el campo de descripción
    ?>
    <textarea id="descripcion_servicio" style="min-width: 500px;" name="descripcion_servicio"><?php echo esc_textarea($descripcion_servicio); ?></textarea>
    <?php
}

// Guardar el valor de la descripción cuando se guarda el post
function guardar_descripcion_servicio($post_id) {
    if (isset($_POST['descripcion_servicio'])) {
        $descripcion_servicio = sanitize_textarea_field($_POST['descripcion_servicio']);
        update_post_meta($post_id, 'descripcion_servicio', $descripcion_servicio);
    }
}
add_action('save_post_servicios', 'guardar_descripcion_servicio');

// Agregar una meta box personalizada con un campo de habilidades en el tipo de entrada personalizado "Servicios"
function agregar_meta_box_habilidades_servicio() {
    add_meta_box(
        'habilidades_servicio_meta_box',
        'Habilidades para el Servicio',
        'mostrar_campo_habilidades_servicio',
        'servicios',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_habilidades_servicio');





// Mostrar el campo de habilidades en la meta box
function mostrar_campo_habilidades_servicio($post) {
    // Obtener el valor de las habilidades guardadas
    $habilidades_servicio = get_post_meta($post->ID, 'habilidades_servicio', true);

    // Mostrar el campo de habilidades
    ?>
    <textarea id="habilidades_servicio" style="min-width: 500px;" name="habilidades_servicio"><?php echo esc_textarea($habilidades_servicio); ?></textarea>
    <?php
}

// Guardar el valor de las habilidades cuando se guarda el post
function guardar_habilidades_servicio($post_id) {
    if (isset($_POST['habilidades_servicio'])) {
        $habilidades_servicio = sanitize_textarea_field($_POST['habilidades_servicio']);
        update_post_meta($post_id, 'habilidades_servicio', $habilidades_servicio);
    }
}
add_action('save_post_servicios', 'guardar_habilidades_servicio');


add_action('add_meta_boxes', 'agregar_meta_box_datos_contacto_Servicio');

function agregar_meta_box_datos_contacto_Servicio() {
    add_meta_box(
        'datos_contacto_Servicio_meta_box',
        'Datos de contacto',
        'mostrar_campo_datos_contacto_Servicio',
        'servicios',
        'normal',
        'high'
    );
}

// Mostrar el campo de datos de contacto en la meta box

function mostrar_campo_datos_contacto_Servicio($post) {
    // Obtener el valor de los datos de contacto guardados
    $datos_contacto_Servicio = get_post_meta($post->ID, 'datos_contacto_Servicio', true);

    // Mostrar el campo de datos de contacto
    ?>
    <textarea id="datos_contacto_Servicio" style="min-width: 500px;" name="datos_contacto_Servicio"><?php echo esc_textarea($datos_contacto_Servicio); ?></textarea>
    <?php
}

// Guardar el valor de los datos de contacto cuando se guarda el post

function guardar_datos_contacto_Servicio($post_id) {
    if (isset($_POST['datos_contacto_Servicio'])) {
        $datos_contacto_Servicio = sanitize_textarea_field($_POST['datos_contacto_Servicio']);
        update_post_meta($post_id, 'datos_contacto_Servicio', $datos_contacto_Servicio);
    }
}
add_action('save_post_servicios', 'guardar_datos_contacto_Servicio');

// Agregar una meta box personalizada con un campo de imagen en el tipo de entrada personalizado "Servicios"
function agregar_meta_box_imagen_servicio() {
    add_meta_box(
        'imagen_servicio_meta_box',
        'Imagen del Servicio',
        'mostrar_campo_imagen_servicio',
        'servicios',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_imagen_servicio');

// Mostrar el campo de imagen en la meta box
function mostrar_campo_imagen_servicio($post) {
    // Obtener el valor de la imagen guardada
    $imagen_servicio = get_post_meta($post->ID, 'imagen_servicio', true);

    // Mostrar el campo de imagen
    ?>
    <label for="imagen_servicio">Imagen:</label>
    <input type="text" id="imagen_servicio" name="imagen_servicio" value="<?php echo esc_attr($imagen_servicio); ?>" readonly>
    <input type="button" id="imagen_servicio_button" class="button" value="Seleccionar imagen">
    <p><img src="<?php echo esc_url($imagen_servicio); ?>" alt="" style="max-width: 200px;"></p>

    <script>
        jQuery(document).ready(function($) {
            var imagenServicioButton = document.getElementById('imagen_servicio_button');
            var imagenServicioInput = document.getElementById('imagen_servicio');

            imagenServicioButton.addEventListener('click', function() {
                wp.media.editor.send.attachment = function(props, attachment) {
                    imagenServicioInput.value = attachment.url;
                    document.querySelector('img').src = attachment.url;
                };
                wp.media.editor.open(imagenServicioButton);
                return false;
            });
        });
    </script>
    <?php
}

// Guardar el valor de la imagen cuando se guarda el post
function guardar_imagen_servicio($post_id) {
    if (isset($_POST['imagen_servicio'])) {
        $imagen_servicio = sanitize_text_field($_POST['imagen_servicio']);
        update_post_meta($post_id, 'imagen_servicio', $imagen_servicio);
    }
}
add_action('save_post_servicios', 'guardar_imagen_servicio');
// Agregar una meta box personalizada con un campo de ubicación en el tipo de entrada personalizado "Servicios"
function agregar_meta_box_ubicacion_servicio() {
    add_meta_box(
        'ubicacion_servicio_meta_box',
        'Ubicación del Servicio',
        'mostrar_campo_ubicacion_servicio',
        'servicios',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_ubicacion_servicio');

// Mostrar el campo de ubicación en la meta box
function mostrar_campo_ubicacion_servicio($post) {
    // Obtener el valor de la ubicación guardada
    $ubicacion_servicio = get_post_meta($post->ID, 'ubicacion_servicio', true);

    // Mostrar el campo de ubicación
    ?>
    <label for="ubicacion_servicio">Ubicación:</label>
    <input type="text" id="ubicacion_servicio" name="ubicacion_servicio" value="<?php echo esc_attr($ubicacion_servicio); ?>">
    <?php
}

// Guardar el valor de la ubicación cuando se guarda el post
function guardar_ubicacion_servicio($post_id) {
    if (isset($_POST['ubicacion_servicio'])) {
        $ubicacion_servicio = sanitize_text_field($_POST['ubicacion_servicio']);
        update_post_meta($post_id, 'ubicacion_servicio', $ubicacion_servicio);
    }
}
add_action('save_post_servicios', 'guardar_ubicacion_servicio');
add_filter('single_template', 'asignar_plantilla_a_servicios');


function asignar_plantilla_a_servicios($single_template) {
    if (is_singular('servicios')) {
        $single_template =   dirname( __FILE__ ) . '/templates/single-servicios.php';
    }
    return $single_template;
}

add_filter('single_template', 'asignar_plantilla_a_proyectos');
function asignar_plantilla_a_proyectos($single_template) {
    if (is_singular('proyectos')) {
        $single_template =   dirname( __FILE__ ) . '/templates/single-proyectos.php';
    }
    return $single_template;
}

function agregar_css_encabezado() {
    if (is_singular('proyectos') || is_singular('servicios')) {

    echo
    "<style type='text/css'>
    ".
    file_get_contents(dirname( __FILE__ ) . '/templates/style.css').
    "
    </style>
    ";
    }

}
add_action( 'wp_head', 'agregar_css_encabezado' );
