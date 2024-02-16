(function () {
    console.log("Slider script loaded successfully");

    const root = document.documentElement;
    const radioButtonSize = parseInt(getComputedStyle(root).getPropertyValue('--radio-button-size'));
    const activeColor = getComputedStyle(root).getPropertyValue('--active-color');
    const inactiveColor = getComputedStyle(root).getPropertyValue('--inactive-color');
    const slideInterval = 2000; // Intervalo de tiempo entre cambios de slide en milisegundos

    // Función para manejar el cambio de diapositiva al hacer clic en un botón estilizado
    function onButtonClick(slider, index) {
        console.log("Botón presionado:", index);

        const slides = slider.querySelectorAll('.slide');
        const buttons = slider.querySelectorAll('.radio-button');

        // Itera sobre cada slide y botón para actualizar las clases
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.add('active');
                slide.classList.remove('inactive');
                buttons[i].classList.add('active');
                buttons[i].style.backgroundColor = activeColor; // Actualiza el color del botón activo
            } else {
                slide.classList.add('inactive');
                slide.classList.remove('active');
                buttons[i].classList.remove('active');
                buttons[i].style.backgroundColor = inactiveColor; // Actualiza el color del botón inactivo
            }
        });

        // Reiniciar el temporizador de cambio de slide
        clearInterval(slider.slideTimer);
        slider.slideTimer = setInterval(() => {
            const nextIndex = (index + 1) % slides.length;
            onButtonClick(slider, nextIndex);
        }, slideInterval);
    }

    // Función para iniciar el cambio automático de slide
    function startSlideShow(slider) {
        clearInterval(slider.slideTimer);
        slider.slideTimer = setInterval(() => {
            const currentSlide = slider.querySelector('.slide.active');
            if (currentSlide) {
                const currentSlideIndex = parseInt(currentSlide.dataset.index);
                const nextIndex = (currentSlideIndex + 1) % slider.querySelectorAll('.slide').length;
                onButtonClick(slider, nextIndex);
            }
        }, slideInterval);
    }
    // Obtiene todos los bloques de slider y configura los eventos de clic para cada uno
    const sliders = document.querySelectorAll('.wp-block-vertical-slider-block2-slider');
    sliders.forEach((slider) => {
        const styledButtons = slider.querySelectorAll('.radio-button');
        styledButtons.forEach((button, index) => {
            button.addEventListener('click', () => onButtonClick(slider, index));
        });

        // Asignar índices de slide
        const slides = slider.querySelectorAll('.slide');
        slides.forEach((slide, index) => {
            slide.dataset.index = index;
        });

       
        startSlideShow(slider);

    });
})();