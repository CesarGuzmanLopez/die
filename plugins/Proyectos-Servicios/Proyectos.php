<?php
/**
 * @pacage Proyectos-Servicios
*/

// Registrar el tipo de entrada personalizado "Proyectos"
function wporg_custom_post_type_proyecto() {
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
}
add_action('init', 'wporg_custom_post_type_proyecto');

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
function agregar_meta_box_habilidades_proyecto() {
    add_meta_box(
        'habilidades_proyecto_meta_box',
        'Habilidades para el Proyecto',
        'mostrar_campo_habilidades_rpoyecto',
        'proyectos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_habilidades_proyecto');

// Mostrar el campo de habilidades en la meta box
function mostrar_campo_habilidades_rpoyecto($post) {
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

add_filter('single_template', 'asignar_plantilla_a_proyectos');
function asignar_plantilla_a_proyectos($single_template) {
    if (is_singular('proyectos')) {
        $single_template =   dirname( __FILE__ ) . '/templates/single-proyectos.php';
    }
    return $single_template;
}

function agregar_css_encabezado_proyecto() {
    if (is_singular('proyectos') ) {

    echo
    "<style type='text/css'>
    ".
    file_get_contents(dirname( __FILE__ ) . '/templates/style.css').
    "
    </style>
    ";
    }
}
add_action( 'wp_head', 'agregar_css_encabezado_proyecto' );
