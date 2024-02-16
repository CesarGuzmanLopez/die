(function (blocks, element, editor, components) {
    // Creación de alias para las funciones de la API de WordPress
    const el = element.createElement;
    const MediaUpload = editor.MediaUpload;
    const InspectorControls = editor.InspectorControls;
    const PanelBody = components.PanelBody;
    const { RangeControl, ToggleControl, TextControl, SelectControl, Button } = components;

    // Función para obtener el valor de una variable CSS
    function getCSSVariableValue(variableName) {
        return getComputedStyle(document.documentElement).getPropertyValue(variableName);
    }

    // Obtener los valores de las variables CSS
    const radioButtonSize = parseInt(getCSSVariableValue('--radio-button-size'));
    const activeColor = getCSSVariableValue('--active-color');
    const inactiveColor = getCSSVariableValue('--inactive-color');

    // Función para manejar la selección de imágenes
    function selectImages(images, setAttributes) {
        // Mapea las imágenes seleccionadas a sus URLs y actualiza los atributos del bloque
        const imageUrls = images.map((image) => image.url);
        setAttributes({ imageUrls, currentSlide: 0 });
    }

    // Componente Slider que renderiza el slider y maneja la lógica
    function Slider({ attributes, setAttributes }) {
        // Extracción de atributos del bloque
        const {
            imageUrls,
            currentSlide,
            sliderHeight,
            sliderWidth,
            orientation,
            gradientLevel,
            gradientDirection,
        } = attributes;

        // Manejador de cambio en los botones de radio
        const onRadioChange = (index) => {
            // Llama a updateSlidePosition cuando se selecciona un radio button
            setAttributes({ currentSlide: index });
            console.log("nueva slide actual", index);
        };

        // Renderiza las diapositivas
        const renderSlides = () =>
            imageUrls.map((imageUrl, index) =>
                el(
                    "div",
                    {
                        className: `slide ${index === currentSlide ? "active" : "inactive"}`,
                        key: index,
                    },
                    el("img", { src: imageUrl, alt: `Slide ${index + 1}` }),
                    el("div", {
                        className: "gradient-container",
                        style: {
                            background: `linear-gradient(${gradientDirection}, rgba(255,255,255,0) 0%, rgba(0,0,0,${gradientLevel / 100}) 100%)`,
                        },
                    })
                )
            );

        // Renderiza los botones de radio
        const renderRadioButtons = () =>
            imageUrls.map((_, index) =>
                el("div", {
                    className: `radio-button ${index === currentSlide ? "active" : ""}`,
                    onClick: () => onRadioChange(index),
                    key: index,
                    style: {
                        width: `${radioButtonSize}px`,
                        height: `${radioButtonSize}px`,
                        backgroundColor: index === currentSlide ? activeColor : inactiveColor
                    }
                })
            );

        // Renderiza el contenedor del slider completo
        return el(
            "div",
            {
                className: `slider-container ${
                    orientation === "horizontal" ? "horizontal" : ""
                    }`,
                style: { height: `${sliderHeight}vh`, width: `${sliderWidth}%` },
            },
            el("div", { className: "slides" }, renderSlides()),
            el(
                "div",
                {
                    className: `radio-container ${
                        orientation === "horizontal" ? "horizontal" : ""
                        }`,
                },
                el(
                    "div",
                    {
                        className: `radio-buttons ${
                            orientation === "horizontal" ? "horizontal" : ""
                            }`,
                    },
                    renderRadioButtons()
                )
            )
        );
    }

    // Registro del bloque en WordPress
    blocks.registerBlockType("vertical-slider-block2/slider", {
        title: "Vertical Slider",
        icon: "images-alt2",
        category: "layout",
        attributes: {
            // Definición de los atributos del bloque
            imageUrls: { type: "array", default: [] },
            currentSlide: { type: "number", default: 0 },
            sliderHeight: { type: "number", default: 100 },
            sliderWidth: { type: "number", default: 100 },
            orientation: { type: "string", default: "vertical" }, // Nuevo atributo para direccion del slider (to + top,bottom,right,left)
            gradientLevel: { type: "number", default: 50 }, //  atributo para nivel de degradado
            gradientDirection: { type: "string", default: "to bottom" }, //  atributo para dirección de degradado
        },
        // Función de edición del bloque
        edit: function ({ attributes, setAttributes }) {
            // Renderiza el bloque en el editor junto con los controles de Inspector
            return [
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: "Slider Settings", initialOpen: true },
                        el(MediaUpload, {
                            onSelect: (images) => selectImages(images, setAttributes),
                            allowedTypes: ["image"],
                            multiple: true,
                            gallery: true,
                            render: (obj) =>
                                el(Button, { onClick: obj.open }, "Select Images")
                        }),
                        el(RangeControl, {
                            label: "Altura del slider ",
                            value: attributes.sliderHeight,
                            onChange: (value) =>
                                setAttributes({ sliderHeight: value })
                        }),
                        el(RangeControl, {
                            label: "Ancho del slider",
                            value: attributes.sliderWidth,
                            onChange: (value) =>
                                setAttributes({ sliderWidth: value })
                        }),
                        el(RangeControl, {
                            label: "Nivel de Degradado",
                            value: attributes.gradientLevel,
                            onChange: (value) =>
                                setAttributes({ gradientLevel: value }),
                        }),
                        el(TextControl, {
                            label: "Dirección del Degradado",
                            value: attributes.gradientDirection,
                            onChange: (value) =>
                                setAttributes({ gradientDirection: value }),
                        }),
                        el(ToggleControl, {
                            label: "Orientación Horizontal",
                            checked: attributes.orientation === "horizontal",
                            onChange: (value) => setAttributes({ orientation: value ? "horizontal" : "vertical" }),
                        })
                    )
                ),
                el(Slider, { attributes, setAttributes }),
            ];
        },
        // Función de guardado del bloque
        save: function ({ attributes }) {
            // Renderiza el bloque para el frontend
            return el(
                "div",
                {
                    className: "wp-block-vertical-slider-block2-slider",
                    style: {
                        height: `${attributes.sliderHeight}vh`,
                        width: `${attributes.sliderWidth}%`
                    }
                },
                el(Slider, { attributes })
            );
        },
    });
})(window.wp.blocks, window.wp.element, window.wp.editor, window.wp.components);