(function (blocks, element, editor, components) {
  // Creación de alias para las funciones de la API de WordPress
  const el = element.createElement;
  const MediaUpload = editor.MediaUpload;
  const InspectorControls = editor.InspectorControls;
  const PanelBody = components.PanelBody;

  // Función para manejar la selección de imágenes
  function selectImages(images, setAttributes) {
    // Mapea las imágenes seleccionadas a sus URLs y actualiza los atributos del bloque
    const imageUrls = images.map((image) => image.url);
    setAttributes({ imageUrls, currentSlide: 0 });
  }

  // Componente Slider que renderiza el slider y maneja la lógica
  function Slider({ attributes, setAttributes }) {
    // Extracción de atributos del bloque
    const { imageUrls, currentSlide } = attributes;

    // Función para actualizar la posición del slide
    const updateSlidePosition = (index) => {
      // Actualiza el índice del slide actual
      setAttributes({ currentSlide: index });
    };

    // Manejador de cambio en los botones de radio
    const onRadioChange = (index) => {
      // Llama a updateSlidePosition cuando se selecciona un radio button
      updateSlidePosition(index);
    };

    // Renderiza las diapositivas
    const renderSlides = () =>
      imageUrls.map((imageUrl, index) =>
        el(
          "div",
          {
            className: `slide ${index === currentSlide ? "active" : ""}`,
            key: index,
          },
          el("img", { src: imageUrl, alt: `Slide ${index + 1}` })
        )
      );

    // Renderiza los botones de radio
    const renderRadioButtons = () =>
      imageUrls.map((_, index) =>
        el("input", {
          type: "radio",
          name: "slider-radio",
          checked: index === currentSlide,
          onChange: () => onRadioChange(index),
          key: index,
        })
      );

    // Renderiza el contenedor del slider completo
    return el(
      "div",
      { className: "slider-container" },
      el("div", { className: "slides" }, renderSlides()),
      el(
        "div",
        { className: "radio-container" },
        el("div", { className: "radio-buttons" }, renderRadioButtons())
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
    },
    // Función de edición del bloque
    edit: function (props) {
      // Renderiza el bloque en el editor junto con los controles de Inspector
      return [
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "Slider Settings", initialOpen: true },
            el(MediaUpload, {
              onSelect: (images) => selectImages(images, props.setAttributes),
              allowedTypes: ["image"],
              multiple: true,
              gallery: true,
              render: (obj) =>
                el(components.Button, { onClick: obj.open }, "Select Images"),
            })
          )
        ),
        el(Slider, props),
      ];
    },
    // Función de guardado del bloque
    save: function (props) {
      // Renderiza el bloque para el frontend
      return el(
        "div",
        { className: "wp-block-vertical-slider-block2-slider" },
        el(Slider, props)
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.editor, window.wp.components);
