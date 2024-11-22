<?php
/**
 * Plugin Name:       Proyectos y Servicios
 * Description:       Plugin para gestionar proyectos y servicios usando el último estándar de WordPress.
 * Version:           1.0.0
 * Requires at least: 6.6
 * Requires PHP:      7.4
 * Requires Plugins:  gutenberg
 * Text Domain:       ps-plugin
 */

add_action('wp_enqueue_scripts', 'ps_enqueue_styles');
add_action('init', 'ps_register_custom_post_types');
add_action('init', 'ps_register_plugin_templates');
add_action('add_meta_boxes', 'ps_add_meta_boxes');
add_action('save_post', 'ps_save_meta_boxes');
add_action('admin_init', 'ps_add_custom_capabilities');
add_filter('wp_insert_post_data', 'ps_restrict_post_status', 10, 2);
add_filter('user_has_cap', 'ps_restrict_editing_published_posts', 10, 4);
add_filter('template_include', 'ps_set_default_templates');
add_filter('user_has_cap', 'ps_restrict_republishing', 10, 4);
add_filter('user_has_cap', 'ps_allow_unpublish_delete', 10, 4);
add_filter('post_row_actions', 'ps_add_unpublish_delete_actions', 10, 2);
add_filter('page_row_actions', 'ps_add_unpublish_delete_actions', 10, 2);

function ps_enqueue_styles() {
    wp_enqueue_style('ps-plugin-styles', plugins_url('css/styles.css', __FILE__));
}

function ps_register_custom_post_types() {
    register_post_type('proyectos', [
        'labels' => [
            'name' => __('Proyectos Terminales', 'ps-plugin'),
            'singular_name' => __('Proyecto Terminal', 'ps-plugin'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'proyectos-terminales'],
        'supports' => ['title', 'thumbnail'],
        'show_in_rest' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',
        'map_meta_cap' => true,
        'capability_type' => 'proyecto',
        'capabilities' => [
            'edit_posts' => 'edit_proyectos',
            'edit_others_posts' => 'edit_others_proyectos',
            'publish_posts' => 'publish_proyectos',
            'read_private_posts' => 'read_private_proyectos',
        ],
        'taxonomies' => ['category'],
        'menu_position' => 3,
        'template' => [
            ['core/paragraph', ['placeholder' => 'Descripción del proyecto...']],
        ],
        'template_lock' => 'all',
    ]);

    register_post_type('servicios', [
        'labels' => [
            'name' => __('Servicios Sociales', 'ps-plugin'),
            'singular_name' => __('Servicio Social', 'ps-plugin'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'servicios-sociales'],
        'supports' => ['title', 'thumbnail'],
        'show_in_rest' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',
        'map_meta_cap' => true,
        'capability_type' => 'servicio',
        'capabilities' => [
            'edit_posts' => 'edit_servicios',
            'edit_others_posts' => 'edit_others_servicios',
            'publish_posts' => 'publish_servicios',
            'read_private_posts' => 'read_private_servicios',
        ],
        'taxonomies' => ['category'],
        'menu_position' => 3,
        'template' => [
            ['core/paragraph', ['placeholder' => 'Descripción del servicio...']],
        ],
        'template_lock' => 'all',
    ]);
}

function ps_register_plugin_templates() {
    register_block_template('ps-plugin//single-proyecto', [
        'title' => __('Single Proyecto', 'ps-plugin'),
        'description' => __('Template for single proyecto posts.', 'ps-plugin'),
        'content' => ps_get_template_content('single-proyecto.php'),
        'post_types' => ['proyectos'],
    ]);

    register_block_template('ps-plugin//single-servicio', [
        'title' => __('Single Servicio', 'ps-plugin'),
        'description' => __('Template for single servicio posts.', 'ps-plugin'),
        'content' => ps_get_template_content('single-servicio.php'),
        'post_types' => ['servicios'],
    ]);

    register_block_template('ps-plugin//archive-proyectos', [
        'title' => __('Archive Proyectos', 'ps-plugin'),
        'description' => __('Template for displaying all proyectos.', 'ps-plugin'),
        'content' => ps_get_template_content('archive-proyectos.php'),
        'post_types' => ['proyectos'],
    ]);

    register_block_template('ps-plugin//archive-servicios', [
        'title' => __('Archive Servicios', 'ps-plugin'),
        'description' => __('Template for displaying all servicios.', 'ps-plugin'),
        'content' => ps_get_template_content('archive-servicios.php'),
        'post_types' => ['servicios'],
    ]);
}

function ps_get_template_content($template) {
    ob_start();
    include __DIR__ . "/templates/{$template}";
    return ob_get_clean();
}

function ps_add_meta_boxes() {
    add_meta_box('ps_proyecto_meta', 'Detalles del Proyecto', 'ps_proyecto_meta_box', 'proyectos', 'normal', 'high');
    add_meta_box('ps_servicio_meta', 'Detalles del Servicio', 'ps_servicio_meta_box', 'servicios', 'normal', 'high');
}

function ps_proyecto_meta_box($post) {
    $descripcion = get_post_meta($post->ID, 'descripcion_proyecto', true);
    $habilidades = get_post_meta($post->ID, 'habilidades_proyecto', true);
    $contacto = get_post_meta($post->ID, 'datos_contacto_proyecto', true);
    $imagen = get_post_meta($post->ID, 'imagen_proyecto', true);
    ?>
    <p>
        <label for="descripcion_proyecto">Descripción:</label>
        <textarea id="descripcion_proyecto" name="descripcion_proyecto" rows="4" style="width:100%;"><?php echo esc_textarea($descripcion); ?></textarea>
    </p>
    <p>
        <label for="habilidades_proyecto">Habilidades:</label>
        <textarea id="habilidades_proyecto" name="habilidades_proyecto" rows="4" style="width:100%;"><?php echo esc_textarea($habilidades); ?></textarea>
    </p>
    <p>
        <label for="datos_contacto_proyecto">Datos de Contacto:</label>
        <textarea id="datos_contacto_proyecto" name="datos_contacto_proyecto" rows="4" style="width:100%;"><?php echo esc_textarea($contacto); ?></textarea>
    </p>
    <p>
        <label for="imagen_proyecto">Imagen:</label>
        <input type="text" id="imagen_proyecto" name="imagen_proyecto" value="<?php echo esc_attr($imagen); ?>" style="width:80%;" readonly>
        <input type="button" id="imagen_proyecto_button" class="button" value="Seleccionar imagen">
    </p>
    <p><img src="<?php echo esc_url($imagen); ?>" alt="" style="max-width: 200px;"></p>
    <script>
        jQuery(document).ready(function($) {
            var imagenProyectoButton = $('#imagen_proyecto_button');
            var imagenProyectoInput = $('#imagen_proyecto');

            imagenProyectoButton.on('click', function() {
                wp.media.editor.send.attachment = function(props, attachment) {
                    imagenProyectoInput.val(attachment.url);
                    imagenProyectoInput.next('img').attr('src', attachment.url);
                };
                wp.media.editor.open(imagenProyectoButton);
                return false;
            });
        });
    </script>
    <?php
}

function ps_servicio_meta_box($post) {
    $descripcion = get_post_meta($post->ID, 'descripcion_servicio', true);
    $habilidades = get_post_meta($post->ID, 'habilidades_servicio', true);
    $contacto = get_post_meta($post->ID, 'datos_contacto_servicio', true);
    $imagen = get_post_meta($post->ID, 'imagen_servicio', true);
    $ubicacion = get_post_meta($post->ID, 'ubicacion_servicio', true);
    ?>
    <p>
        <label for="descripcion_servicio">Descripción:</label>
        <textarea id="descripcion_servicio" name="descripcion_servicio" rows="4" style="width:100%;"><?php echo esc_textarea($descripcion); ?></textarea>
    </p>
    <p>
        <label for="habilidades_servicio">Habilidades:</label>
        <textarea id="habilidades_servicio" name="habilidades_servicio" rows="4" style="width:100%;"><?php echo esc_textarea($habilidades); ?></textarea>
    </p>
    <p>
        <label for="datos_contacto_servicio">Datos de Contacto:</label>
        <textarea id="datos_contacto_servicio" name="datos_contacto_servicio" rows="4" style="width:100%;"><?php echo esc_textarea($contacto); ?></textarea>
    </p>
    <p>
        <label for="ubicacion_servicio">Ubicación:</label>
        <input type="text" id="ubicacion_servicio" name="ubicacion_servicio" value="<?php echo esc_attr($ubicacion); ?>" style="width:100%;">
    </p>
    <p>
        <label for="imagen_servicio">Imagen:</label>
        <input type="text" id="imagen_servicio" name="imagen_servicio" value="<?php echo esc_attr($imagen); ?>" style="width:80%;" readonly>
        <input type="button" id="imagen_servicio_button" class="button" value="Seleccionar imagen">
    </p>
    <p><img src="<?php echo esc_url($imagen); ?>" alt="" style="max-width: 200px;"></p>
    <script>
        jQuery(document).ready(function($) {
            var imagenServicioButton = $('#imagen_servicio_button');
            var imagenServicioInput = $('#imagen_servicio');

            imagenServicioButton.on('click', function() {
                wp.media.editor.send.attachment = function(props, attachment) {
                    imagenServicioInput.val(attachment.url);
                    imagenServicioInput.next('img').attr('src', attachment.url);
                };
                wp.media.editor.open(imagenServicioButton);
                return false;
            });
        });
    </script>
    <?php
}

function ps_save_meta_boxes($post_id) {
    if (isset($_POST['descripcion_proyecto'])) {
        update_post_meta($post_id, 'descripcion_proyecto', sanitize_textarea_field($_POST['descripcion_proyecto']));
    }
    if (isset($_POST['habilidades_proyecto'])) {
        update_post_meta($post_id, 'habilidades_proyecto', sanitize_textarea_field($_POST['habilidades_proyecto']));
    }
    if (isset($_POST['datos_contacto_proyecto'])) {
        update_post_meta($post_id, 'datos_contacto_proyecto', sanitize_textarea_field($_POST['datos_contacto_proyecto']));
    }
    if (isset($_POST['imagen_proyecto'])) {
        update_post_meta($post_id, 'imagen_proyecto', sanitize_text_field($_POST['imagen_proyecto']));
    }
    if (isset($_POST['descripcion_servicio'])) {
        update_post_meta($post_id, 'descripcion_servicio', sanitize_textarea_field($_POST['descripcion_servicio']));
    }
    if (isset($_POST['habilidades_servicio'])) {
        update_post_meta($post_id, 'habilidades_servicio', sanitize_textarea_field($_POST['habilidades_servicio']));
    }
    if (isset($_POST['datos_contacto_servicio'])) {
        update_post_meta($post_id, 'datos_contacto_servicio', sanitize_textarea_field($_POST['datos_contacto_servicio']));
    }
    if (isset($_POST['imagen_servicio'])) {
        update_post_meta($post_id, 'imagen_servicio', sanitize_text_field($_POST['imagen_servicio']));
    }
    if (isset($_POST['ubicacion_servicio'])) {
        update_post_meta($post_id, 'ubicacion_servicio', sanitize_text_field($_POST['ubicacion_servicio']));
    }
}

function ps_add_custom_capabilities() {
    $roles = ['profesor', 'profesor_1','administrator'];
    foreach ($roles as $role_name) {
        $role = get_role($role_name);
        if ($role) {
            $role->add_cap('edit_proyectos');
            $role->add_cap('edit_others_proyectos');
            $role->add_cap('edit_servicios');
            $role->add_cap('edit_others_servicios');
            $role->add_cap('edit_published_proyectos');
            $role->add_cap('edit_published_servicios');
            $role->add_cap('delete_proyectos');
            $role->add_cap('delete_servicios');
        }
    }

    $admin_role = get_role('administrator');
    if ($admin_role) {
        $admin_role->add_cap('publish_proyectos');
        $admin_role->add_cap('publish_servicios');
        $admin_role->add_cap('delete_others_proyectos');
        $admin_role->add_cap('delete_others_servicios');
    }
}

function ps_restrict_post_status($data, $postarr) {
    if (in_array($data['post_type'], ['proyectos', 'servicios']) && !current_user_can('publish_posts')) {
        if ($data['post_status'] === 'publish') {
            $data['post_status'] = 'pending';
        }
    }
    return $data;
}

function ps_restrict_editing_published_posts($allcaps, $cap, $args, $user) {
    if (in_array('profesor', $user->roles) || in_array('profesor_1', $user->roles)) {
        if (isset($args[2]) && get_post_status($args[2]) === 'publish') {
            if (in_array($args[0], ['edit_post'])) {
                $allcaps[$cap[0]] = false;
            }
        }
    }
    return $allcaps;
}

function ps_restrict_republishing($allcaps, $cap, $args, $user) {
    if (in_array('administrator', $user->roles)) {
        return $allcaps; // Admin can do everything
    }
    if (in_array('profesor', $user->roles) || in_array('profesor_1', $user->roles)) {
        if (isset($args[2])) {
            $post = get_post($args[2]);
            if ($post->post_status === 'publish' && in_array($args[0], ['publish_post'])) {
                $allcaps[$cap[0]] = false;
            }
        }
    }
    return $allcaps;
}

function ps_allow_unpublish_delete($allcaps, $cap, $args, $user) {
    if (in_array('administrator', $user->roles)) {
        return $allcaps; // Admin can do everything
    }
    if (in_array('profesor', $user->roles) || in_array('profesor_1', $user->roles)) {
        if (isset($args[2])) {
            $post = get_post($args[2]);
            if ($post->post_author == $user->ID && in_array($args[0], ['delete_post', 'edit_post'])) {
                $allcaps[$cap[0]] = true;
            }
        }
    }
    return $allcaps;
}

function ps_set_default_templates($template) {
    if (is_singular('proyectos')) {
        $template = plugin_dir_path(__FILE__) . 'templates/single-proyecto.php';
    } elseif (is_singular('servicios')) {
        $template = plugin_dir_path(__FILE__) . 'templates/single-servicio.php';
    } elseif (is_post_type_archive('proyectos')) {
        $template = plugin_dir_path(__FILE__) . 'templates/archive-proyectos.php';
    } elseif (is_post_type_archive('servicios')) {
        $template = plugin_dir_path(__FILE__) . 'templates/archive-servicios.php';
    }
    return $template;
}

function ps_add_unpublish_delete_actions($actions, $post) {
    if (in_array($post->post_type, ['proyectos', 'servicios']) && current_user_can('edit_post', $post->ID)) {
        if ($post->post_status === 'publish') {
            $actions['unpublish'] = '<a href="' . admin_url('admin-post.php?action=ps_unpublish_post&post_id=' . $post->ID) . '">' . __('Unpublish', 'ps-plugin') . '</a>';
        }
        $actions['delete'] = '<a href="' . get_delete_post_link($post->ID) . '">' . __('Delete', 'ps-plugin') . '</a>';
    }
    return $actions;
}

add_action('admin_post_ps_unpublish_post', 'ps_handle_unpublish_post');

function ps_handle_unpublish_post() {
    if (!isset($_GET['post_id']) || !current_user_can('edit_post', $_GET['post_id'])) {
        wp_die(__('You do not have permission to unpublish this post.', 'ps-plugin'));
    }

    $post_id = intval($_GET['post_id']);
    $post = get_post($post_id);

    if ($post && $post->post_status === 'publish') {
        wp_update_post([
            'ID' => $post_id,
            'post_status' => 'draft',
        ]);
    }

    wp_redirect(admin_url('edit.php?post_type=' . $post->post_type));
    exit;
}
