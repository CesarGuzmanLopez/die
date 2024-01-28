<?php

class Slider_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'slider_widget',
            'Slider de Imágenes',
            array(
                'description' => 'Un widget para mostrar un slider de imágenes responsive con tamaño personalizable.'
            )
        );
        add_action('admin_enqueue_scripts', array($this, 'enqueue_styles_and_scripts'));
    }

    public function enqueue_styles_and_scripts($hook) {
      if ($hook === 'widgets.php') {
            // Agrega un script personalizado para manejar la carga de imágenes desde la biblioteca de medios
            wp_enqueue_script('custom-media-upload', get_template_directory_uri() . '/assets/js/custom-media-upload.js', array('jquery', 'media-upload'), '1.0', true);
        }
    }

    public function form($instance) {
        $images = isset($instance['images']) ? esc_attr($instance['images']) : '';
        $slider_size = isset($instance['slider_size']) ? absint($instance['slider_size']) : '';
        $image_links = isset($instance['image_links']) ? esc_attr($instance['image_links']) : '';
        $slide_duration = isset($instance['slide_duration']) ? absint($instance['slide_duration']) : 5;
        

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('images'); ?>">Seleccionar imágenes:</label>
            <input type="text" class="widefat custom-media-url" id="<?php echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>" value="<?php echo $images; ?>" />
            <button class="button" id="Boton_subir_imagenes_slider" onclick="abrirMediaUploader()">Cargar/Seleccionar Imágenes</button>
        </p>
        <p>Ingrese las URLs de las imágenes separadas por comas (,).</p>
        <p>
            <label for="<?php echo $this->get_field_id('slider_size'); ?>">Tamaño del slider:</label>
            <input type="number" class="widefat" id="<?php echo $this->get_field_id('slider_size'); ?>" name="<?php echo $this->get_field_name('slider_size'); ?>" value="<?php echo $slider_size; ?>" />
            <p class="description">El ancho máximo del slider en píxeles.</p>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_links'); ?>">Enlaces de las imágenes:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('image_links'); ?>" name="<?php echo $this->get_field_name('image_links'); ?>" value="<?php echo $image_links; ?>" />
            <p class="description">Ingrese los enlaces de las imágenes separados por comas (,).</p>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('slide_duration'); ?>">Duración de cada elemento (segundos):</label>
            <input type="number" class="widefat" id="<?php echo $this->get_field_id('slide_duration'); ?>" name="<?php echo $this->get_field_name('slide_duration'); ?>" value="<?php echo $slide_duration; ?>" />
            <p class="description">Especifique la duración de cada elemento en segundos.</p>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['images'] = sanitize_text_field($new_instance['images']);
        $instance['slider_size'] = absint($new_instance['slider_size']);
        $instance['image_links'] = sanitize_text_field($new_instance['image_links']);
        $instance['slide_duration'] = absint($new_instance['slide_duration']);
        return $instance;
    }

    public function widget($args, $instance) {
        $widget_id = isset($instance['widget_id']) ? $instance['widget_id'] : '';
        $images = isset($instance['images']) ? $instance['images'] : '';
        $slider_size = isset($instance['slider_size']) ? $instance['slider_size'] : '';
        $image_links = isset($instance['image_links']) ? $instance['image_links'] : '';
        $captions = isset($instance['captions']) ? $instance['captions'] : ''; // Nuevo campo para las leyendas
        $slide_duration = isset($instance['slide_duration']) ? absint($instance['slide_duration']) : 5;
    
        echo $args['before_widget'];
    
        if (!empty($images)) {
            $imageUrls = explode(',', $images);
            $imageLinks = explode(',', $image_links);
            $imageCaptions = explode(',', $captions); // Nuevo array para las leyendas
    
            // Contenedor principal del slider con un ID único
            echo '<div class="custom-slider" id="custom-slider-' . esc_attr($widget_id) . '" style="height:' . esc_attr($slider_size) . 'px;">';
    
            // Contenedor para las imágenes con un ID único
            echo '<div class="slider-images-container" id="slider-images-container-' . esc_attr($widget_id) . '">';
    
            for ($i = 0; $i < count($imageUrls); $i++) {
                // Contenedor individual de cada imagen con un ID único
                echo '<div class="slider-image-container" id="slider-image-container-'. $i . ' ">';
    
                // Verificamos si existe un enlace para esta imagen
                if (isset($imageLinks[$i]) && !empty($imageLinks[$i])) {
                    // Si existe un enlace, envuelve la imagen en el enlace
                    echo '<a href="' . esc_url($imageLinks[$i]) . '">';
                }
    
                // Imagen con clase y atributos
                echo '<img src="' . esc_url($imageUrls[$i]) . '" alt="" class="slider-image"'
                    . ' data-widget-id="' . esc_attr($widget_id) . '"'
                    . ' data-image-index="' . $i . '"';
    
                // Verificamos si existe un caption para esta imagen
                if (isset($imageCaptions[$i]) && !empty($imageCaptions[$i])) {
                    echo ' data-caption="' . esc_attr($imageCaptions[$i]) . '"';
                }
    
                echo '>';
    
                // Cierra el enlace si existe
                if (isset($imageLinks[$i]) && !empty($imageLinks[$i])) {
                    echo '</a>';
                }
    
                // Cierra el contenedor de la imagen individual
                echo '</div>';
            }
    
            // Cierra el contenedor de las imágenes
            echo '</div>';
    
            // Botones de navegación (puedes personalizar esto según tus necesidades)
            // Uso de ASCII code para los botones de flecha izquierda y derecha
            echo '<div class="slider-navigation">';
            echo '<button class="prev-slide" data-widget-id="' . esc_attr($widget_id) . '"> &#10094; </button>';
            echo '<button class="next-slide" data-widget-id="' . esc_attr($widget_id) . '"> &#10095; </button>';
    
            ?>

<script>
    jQuery(document).ready(function($) {
        // Configura las variables para el slider
        var widgetId = "<?php echo esc_js($widget_id); ?>"; // Obtén el ID único del widget actual
        var slider = $('#custom-slider-' + widgetId);
        var images = slider.find('.slider-image');
        var captions = slider.find('.slider-image').map(function() {
            return $(this).data('caption');
        }).get(); // Obtiene todas las leyendas de las imágenes
        var totalImages = images.length;
        var currentIndex = 0;
        var isPaused = false; // Variable para rastrear el estado de pausa
        setBackgroud(images.eq(currentIndex).attr('src'));
        
        // Oculta todas las imágenes excepto la primera
        images.hide();
        images.eq(currentIndex).show();
        
        function setBackgroud(img){
            nextImageContainer = $('.custom-slider')
            nextImageContainer.css('background-size', 'cover')
            nextImageContainer.css('background-color', 'black')
            nextImageContainer.css('background-image', 'linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(' + img + ')');
            nextImageContainer.css('background-position', 'center');
            nextImageContainer.css('background-repeat', 'no-repeat');
        }
        
        // Función para mostrar la siguiente imagen
        function showNextImage() {
            if (!isPaused) {
                images.eq(currentIndex).hide();
                currentIndex = (currentIndex + 1) % totalImages;
                images.eq(currentIndex).show();
                showCaption(); // Muestra la leyenda de la nueva imagen
                setBackgroud(images.eq(currentIndex).attr('src'));
            }
        }

        // Función para mostrar la imagen anterior
        function showPrevImage() {
            if (!isPaused) {
                images.eq(currentIndex).hide();
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
                images.eq(currentIndex).show();
                showCaption(); // Muestra la leyenda de la nueva imagen
                var prevImageContainer = $('.custom-slider');
                prevImageContainer.css('background-image', 'url(' + images.eq(currentIndex).attr('src') + ')');
                setBackgroud(images.eq(currentIndex).attr('src'));
            }
        }

        // Agrega eventos de clic a las flechas de navegación
        $('.prev-slide[data-widget-id="' + widgetId + '"]').on('click', function() {
            showPrevImage();
            restartSlideTimer(); // Reinicia el temporizador
        });

        $('.next-slide[data-widget-id="' + widgetId + '"]').on('click', function() {
            showNextImage();
            restartSlideTimer(); // Reinicia el temporizador
        });

        // Configura un temporizador para cambiar automáticamente las imágenes 
        var slideDuration = <?php echo $slide_duration * 1000; ?>; // Convierte segundos a milisegundos
        var slideTimer = setInterval(showNextImage, slideDuration);

        // Función para reiniciar el temporizador
        function restartSlideTimer() {
            clearInterval(slideTimer); // Detiene el temporizador actual
            slideTimer = setInterval(showNextImage, slideDuration); // Inicia un nuevo temporizador
        }

        // Muestra la leyenda de la imagen actual
        function showCaption() {
            var captionElement = $('#slider-caption-' + widgetId);
            var currentCaption = captions[currentIndex];

            if (currentCaption !== undefined) {
                captionElement.text(currentCaption);
            } else {
                captionElement.text('');
            }
        }

        // Llama a la función para mostrar la leyenda inicial
        showCaption();
        
        // Agrega un evento de clic al botón de pausa
        $('.pause-slider[data-widget-id="' + widgetId + '"]').on('click', function() {
            var button = $(this);
            if (isPaused) {
                // Si está pausado, reanuda el slider
                isPaused = false;
                button.text("Pausar");
                restartSlideTimer(); // Reinicia el temporizador
            } else {
                // Si no está pausado, pausa el slider
                isPaused = true;
                button.text("Continuar");
                clearInterval(slideTimer); // Detiene el temporizador actual
            }
        });

    });
</script>
            <?php
        }
    
        echo $args['after_widget'];
    }
}
function register_slider_widget() {
    $version = wp_get_theme()->get('Version');
    
    register_widget('Slider_Widget');
    wp_enqueue_style('slider', get_template_directory_uri() . '/assets/css/slider.css', array(), $version);
    wp_enqueue_script('slider-widget-script', get_template_directory_uri() . '/assets/js/slider.js', array('jquery', 'media-upload'), $version, true);

}

add_action('widgets_init', 'register_slider_widget');