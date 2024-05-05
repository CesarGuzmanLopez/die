jQuery(window).on('load', function() {
    // Vincula el evento change a los botones de radio dentro del contenedor del slider
    jQuery('.slider-container input[type="radio"]').change(function () {
        // Obtiene el valor del botón de radio seleccionado
        const index = jQuery(this).index();
        // Encuentra el contenedor del slider
        const sliderContainer = jQuery(this).closest('.slider-container');
        // Encuentra todas las diapositivas dentro del contenedor del slider
        const slides = sliderContainer.find('.slide');
        
        // Itera sobre las diapositivas
        slides.each(function (slideIndex) {
            // Verifica si el índice de la diapositiva coincide con el índice del botón de radio seleccionado
            if (slideIndex === index) {
                // Agrega la clase 'active' a la diapositiva si coincide
                jQuery(this).addClass('active');
            } else {
                // De lo contrario, elimina la clase 'active' de la diapositiva
                jQuery(this).removeClass('active');
            }
        });
    });
});