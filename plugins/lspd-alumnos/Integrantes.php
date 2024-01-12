<?php

function wporg_custom_post_type_integrantes() {
    register_post_type('integrantes',
        array(
            'labels'      => array(
                'name'          => __('integrantes', 'textdomain'),
                'singular_name' => __('integrante', 'textdomain'),
            ),
            'rewrite'     => array('slug' => 'integrantes'), // Mi slug personalizado

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
add_action('init', 'wporg_custom_post_type_integrantes');



// Agregar una meta box personalizada con un campo de fecha en el tipo de entrada personalizado "integrantes"
function agregar_meta_box_fecha_integrante() {
    add_meta_box(
        'fecha_integrante_meta_box',
        'Inicio de instancia del integrante',
        'mostrar_campo_fecha_integrante',
        'integrantes',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_fecha_integrante');

// Mostrar el campo de fecha en la meta box
function mostrar_campo_fecha_integrante($post) {
    // Obtener el valor de la fecha guardada
    $fecha_integrante = get_post_meta($post->ID, 'fecha_integrante', true);

    // Calcular la fecha predeterminada sumando 2 meses a la fecha actual
    $fecha_predeterminada = date('Y-m-d', strtotime('+2 months'));

    // Usar la fecha predeterminada si no hay una fecha guardada
    $valor_predeterminado = !empty($fecha_integrante) ? $fecha_integrante : $fecha_predeterminada;

    // Mostrar el campo de fecha
    ?>
    <label for="fecha_integrante">Fecha:</label>
    <input type="date" id="fecha_integrante" name="fecha_integrante" value="<?php echo esc_attr($valor_predeterminado); ?>">
    <?php
}

// Guardar el valor de la fecha cuando se guarda el post
function guardar_fecha_integrante($post_id) {
    if (isset($_POST['fecha_integrante'])) {
        $fecha_integrante = sanitize_text_field($_POST['fecha_integrante']);
        update_post_meta($post_id, 'fecha_integrante', $fecha_integrante);
    }
}
add_action('save_post_integrantes', 'guardar_fecha_integrante');


// Agregar una meta box personalizada con un campo de fecha en el tipo de entrada personalizado "integrantes"
function agregar_meta_box_fechaf_integrante() {
    add_meta_box(
        'fechaf_integrante_meta_box',
        'Fin de instancia del integrante',
        'mostrar_campo_fechaf_integrante',
        'integrantes',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_fechaf_integrante');

// Mostrar el campo de fecha en la meta box
function mostrar_campo_fechaf_integrante($post) {
    // Obtener el valor de la fecha guardada
    $fechaf_integrante = get_post_meta($post->ID, 'fechaf_integrante', true);

    // Calcular la fecha predeterminada sumando 2 meses a la fecha actual
    $fechaf_predeterminada = date('Y-m-d', strtotime('+2 months'));

    // Usar la fecha predeterminada si no hay una fecha guardada
    $valor_predeterminado = !empty($fechaf_integrante) ? $fechaf_integrante : $fechaf_predeterminada;

    // Mostrar el campo de fecha
    ?>
    <label for="fechaf_integrante">Fecha:</label>
    <input type="date" id="fechaf_integrante" name="fechaf_integrante" value="<?php echo esc_attr($valor_predeterminado); ?>">
    <?php
}

// Guardar el valor de la fecha cuando se guarda el post
function guardar_fechaf_integrante($post_id) {
    if (isset($_POST['fechaf_integrante'])) {
        $fechaf_integrante = sanitize_text_field($_POST['fechaf_integrante']);
        update_post_meta($post_id, 'fechaf_integrante', $fechaf_integrante);
    }
}
add_action('save_post_integrantes', 'guardar_fechaf_integrante');



// Agregar una meta box personalizada con un campo de descripción en el tipo de entrada personalizado "integrantes"
function agregar_meta_box_perfil_integrante() {
    add_meta_box(
        'perfil_integrante_meta_box',
        'Ocupacion del integrante',
        'mostrar_campo_perfil_integrante',
        'integrantes',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_perfil_integrante');

// Mostrar el campo de descripción en la meta box
function mostrar_campo_perfil_integrante($post) {
    // Obtener el valor de la descripción guardada
    $perfil_integrante = get_post_meta($post->ID, 'perfil_integrante', true);

    // Mostrar el campo de descripción
    ?>
    <textarea id="perfil_integrante" style="min-width: 500px;" name="perfil_integrante"><?php echo esc_textarea($perfil_integrante); ?></textarea>
    <?php
}

// Guardar el valor de la descripción cuando se guarda el post
function guardar_perfil_integrante($post_id) {
    if (isset($_POST['perfil_integrante'])) {
        $perfil_integrante = sanitize_textarea_field($_POST['perfil_integrante']);
        update_post_meta($post_id, 'perfil_integrante', $perfil_integrante);
    }
}
add_action('save_post_integrantes', 'guardar_perfil_integrante');

// Agregar una meta box personalizada con un campo de habilidades en el tipo de entrada personalizado "integrantes"
function agregar_meta_box_habilidades_integrante() {
    add_meta_box(
        'habilidades_integrante_meta_box',
        'Perfil del integrante',
        'mostrar_campo_habilidades_integrante',
        'integrantes',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_habilidades_integrante');

// Mostrar el campo de habilidades en la meta box
function mostrar_campo_habilidades_integrante($post) {
    // Obtener el valor de las habilidades guardadas
    $habilidades_integrante = get_post_meta($post->ID, 'habilidades_integrante', true);

    // Mostrar el campo de habilidades
    ?>
    <textarea id="habilidades_integrante" style="min-width: 500px;" name="habilidades_integrante"><?php echo esc_textarea($habilidades_integrante); ?></textarea>
    <?php
}

// Guardar el valor de las habilidades cuando se guarda el post
function guardar_habilidades_integrante($post_id) {
    if (isset($_POST['habilidades_integrante'])) {
        $habilidades_integrante = sanitize_textarea_field($_POST['habilidades_integrante']);
        update_post_meta($post_id, 'habilidades_integrante', $habilidades_integrante);
    }
}
add_action('save_post_integrantes', 'guardar_habilidades_integrante');

function wporg_add_custom_box()
{
    
        add_meta_box(
            'wporg_box_id',           // Unique ID
            'Ocupacion del Integrante',  // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            'integrantes',
            'normal',
            'high'              
        );
    
}
add_action('add_meta_boxes', 'wporg_add_custom_box');

function wporg_custom_box_html($post)
{
    $value = get_post_meta($post->ID, '_wporg_meta_key', true);
    ?>
    <label for="wporg_field">Seleccione que tipo de integrante es</label>
    <select name="wporg_field" id="wporg_field" class="postbox">
        
        <option value="Servicio" <?php selected($value, 'Servicio'); ?>>Servicio Social</option>
        <option value="Proyecto" <?php selected($value, 'Proyecto'); ?>>Proyecto Terminal</option>
        <option value="Ayudantia" <?php selected($value, 'Ayudantia'); ?>>Ayudantia</option>
        <option value="Posgrado" <?php selected($value, 'Posgrado'); ?>>Posgrado</option>

    </select>
    <?php
}
function wporg_save_postdata($post_id)
{
    if (array_key_exists('wporg_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_wporg_meta_key',
            $_POST['wporg_field']
        );
    }
}
add_action('save_post', 'wporg_save_postdata');






// Agregar una meta box personalizada con un campo de imagen en el tipo de entrada personalizado "integrantes"
function agregar_meta_box_imagen_integrante() {
    add_meta_box(
        'imagen_integrante_meta_box',
        'Imagen del integrante',
        'mostrar_campo_imagen_integrante',
        'integrantes',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_imagen_integrante');

// Mostrar el campo de imagen en la meta box
function mostrar_campo_imagen_integrante($post) {
    // Obtener el valor de la imagen guardada
    $imagen_integrante = get_post_meta($post->ID, 'imagen_integrante', true);

    // Mostrar el campo de imagen
    ?>
    <label for="imagen_integrante">Imagen:</label>
    <input type="text" id="imagen_integrante" name="imagen_integrante" value="<?php echo esc_attr($imagen_integrante); ?>" readonly>
    <input type="button" id="imagen_integrante_button" class="button" value="Seleccionar imagen">
    <p><img src="<?php echo esc_url($imagen_integrante); ?>" alt="" style="max-width: 200px;"></p>

    <script>
        jQuery(document).ready(function($) {
            var imagenintegranteButton = document.getElementById('imagen_integrante_button');
            var imagenintegranteInput = document.getElementById('imagen_integrante');

            imagenintegranteButton.addEventListener('click', function() {
                wp.media.editor.send.attachment = function(props, attachment) {
                    imagenintegranteInput.value = attachment.url;
                    document.querySelector('img').src = attachment.url;
                };
                wp.media.editor.open(imagenintegranteButton);
                return false;
            });
        });
    </script>
    <?php
}

// Guardar el valor de la imagen cuando se guarda el post
function guardar_imagen_integrante($post_id) {
    if (isset($_POST['imagen_integrante'])) {
        $imagen_integrante = sanitize_text_field($_POST['imagen_integrante']);
        update_post_meta($post_id, 'imagen_integrante', $imagen_integrante);
    }
}
add_action('save_post_integrantes', 'guardar_imagen_integrante');



add_filter('single_template', 'asignar_plantilla_a_integrantes');
function asignar_plantilla_a_integrantes($single_template) {
    if (is_singular('integrantes')) {
        $single_template =   dirname( __FILE__ ) . '/templates/single-integrantes.php';
    }
    return $single_template;
}

function agregar_css_encabezado_integrantes() {
    if( is_singular('integrantes')) {
        echo
        "<style type='text/css'>
        ".
        file_get_contents(dirname( __FILE__ ) . '/templates/style.css').
        "
        </style>
        ";
    }
}
add_action( 'wp_head', 'agregar_css_encabezado_integrantes' );
