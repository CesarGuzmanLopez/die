/* Función anónima que toma como parámetros diferentes partes 
de la API de WordPress para la creación de bloques */
(function (blocks, editor, components, element) {
  // Asignacion de alias a algunas funciones
  var el = element.createElement; // Elementos del edit y save
  var registerBlockType = blocks.registerBlockType;
  var MediaUpload = editor.MediaUpload; // Biblioteca de medios
  var InspectorControls = editor.InspectorControls; //Inspector
  var PanelBody = components.PanelBody; // Panel de edicion de la configuración del bloque
  // Componentes del editor
  var TextControl = components.TextControl;
  var ToggleControl = components.ToggleControl;
  var RangeControl = components.RangeControl;

  // Bloque personalizado en WordPress
  registerBlockType("tu-plugin-imagen-licenciatura/imagen-licenciatura", {
    // Se establecen las configuraciones específicas del bloque
    title: "Imagen Licenciatura", // Titulo del bloque en el editor
    icon: "format-image", // Icono dentro de las opciones de los bloques
    category: "media", // Seccion o categoria
    attributes: {
      // Tipos de atributos (boton, texto y url imagen, adicionales los de ocultar)
      mediaURL: {
        type: "string",
        source: "attribute",
        selector: "img",
        attribute: "src",
      },
      texto: {
        type: "string",
        default: "Licenciatura",
      },
      urlBoton: {
        type: "string",
        default: "http://www.iztapalapa.uam.mx/",
      },
      ocultarTexto: {
        type: "boolean",
        default: false,
      },
      ocultarBoton: {
        type: "boolean",
        default: false,
      },
      usarTransparencia: {
        type: "boolean",
        default: false, // Por default el contenido oscuro es degradado
      },
      nivelDegradado: {
        type: "number",
        default: 1,
      },
      tamOscuro: {
        type: "number",
        default: 35,
      },
    },
    // Se define la función de edición del bloque, que se ejecuta cuando se edita el bloque
    // Lógica para la interfaz de usuario del bloque
    edit: function (props) {
      // props se utiliza para acceder y manipular las propiedades del bloque
      const { attributes } = props;
      const { ocultarBoton } = attributes;
      const { ocultarTexto } = attributes;
      const { usarTransparencia } = attributes;
      const { nivelDegradado } = attributes;
      const { tamOscuro } = attributes;
      //Obtener texto
      const nuevoTexto = (value) => {
        props.setAttributes({ texto: value });
      };
      //Funcion para manejar la visibilidad del boton 'Conocer Mas'
      const oculBoton = () => {
        props.setAttributes({ ocultarBoton: !ocultarBoton });
      };
      //Funcion para manejar la visibilidad del texto en la imagen
      const oculTexto = () => {
        props.setAttributes({ ocultarTexto: !ocultarTexto });
      };
      // Función para manejar el cambio de transparencia
      const efectoTransparente = () => {
        props.setAttributes({ usarTransparencia: !usarTransparencia });
      };
      const nivelDeg = (value) => {
        props.setAttributes({ nivelDegradado: value });
      };
      const tamOs = (value) => {
        props.setAttributes({ tamOscuro: value });
      };
      return [
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            {
              title: "Configuraciones del Bloque",
              initialOpen: true,
            },
            el(
              //  Se crea un componente MediaUpload que permite seleccionar una imagen
              // y se utiliza un botón personalizado para abrir el selector de medios
              MediaUpload,
              {
                onSelect: function (media) {
                  props.setAttributes({ mediaURL: media.url });
                },
                type: "image", //Tipo de seleccion imagen
                value: props.attributes.mediaURL, //Devuelve la url de la imagen
                render: function (obj) {
                  return el(
                    components.Button, //Boton de seleccionar imagen
                    {
                      className: "button-edit",
                      onClick: obj.open, //Abre el selector de medios
                    },
                    "Seleccionar Imagen"
                  );
                },
              }
            ),
            !ocultarTexto && // Ocultar el ingreso de texto
              el(TextControl, {
                //Texto de la imagen
                label: "Licenciatura o Titulo",
                value: props.attributes.texto,
                onChange: nuevoTexto,
              }),
            !ocultarBoton && // Ocultar el ingreso de url
              el(TextControl, {
                //URL del boton
                label: "URL del botón Conocer Más",
                value: props.attributes.urlBoton,
                onChange: function (value) {
                  props.setAttributes({ urlBoton: value });
                },
              }), //Muestra o oculta configuraciones de la imagen
            el(ToggleControl, {
              label: "Ocultar Texto",
              checked: ocultarTexto,
              onChange: oculTexto,
            }),
            el(ToggleControl, {
              label: 'Ocultar botón "Conocer Más"',
              checked: ocultarBoton,
              onChange: oculBoton,
            }),
            el(ToggleControl, {
              label: "Tipo de transparencia",
              checked: usarTransparencia,
              onChange: efectoTransparente,
            }),
            // Añade el RangeControl para el nivel de degradado
            el(RangeControl, {
              label: "Nivel del degradado del área",
              value: nivelDegradado,
              onChange: nivelDeg,
              onInput: nivelDeg,
              min: 0,
              max: 1,
              step: 0.05, // Salto al deslizar
            }),
            el(RangeControl, {
              label: "Tamaño del área degradada",
              value: tamOscuro,
              onChange: tamOs,
              onInput: tamOs,
              min: 35,
              max: 100,
              step: 1, // Salto al deslizar
            })
          )
        ),

        el(
          "div",
          // Estilo del contenedor del bloque en el editor
          { className: "pagina-container-edit" },
          el(
            //  Se crea un elemento div para el contenido oscuro del bloque, que incluye texto y un enlace
            "div",
            {
              className: `contenido-oscuro-edit`,
              style: {
                background: usarTransparencia
                  ? `rgba(0, 0, 0, ${nivelDegradado})`
                  : `linear-gradient(to left, rgba(0, 0, 0, ${nivelDegradado}), rgba(0, 0, 0, 0))`,
                width: `${tamOscuro}%`,
              },
            },
            !ocultarTexto && // Ocultar texto
              // Se agrega un elemento h2 para mostrar el texto del bloque
              el("h2", { className: "texto-edit" }, props.attributes.texto),
            !ocultarBoton && // Ocultar boton 'Conocer Más'
              // Se agrega un enlace (a)
              el(
                "a",
                {
                  className: "conocer-mas-btn-edit",
                  href: props.attributes.urlBoton,
                  onClick: function () {
                    console.log("¡Enlace clickeado!"); // Test
                  },
                },
                "Conocer Más"
              )
          ),
          //  Se agrega un elemento img para mostrar la imagen de fondo seleccionada, con estilos específicos
          el("img", {
            className: "imagen-fondo-edit",
            src: props.attributes.mediaURL,
            alt: "Vista previa",
          })
        ),
      ];
    },
    //  Visualización del bloque en la página real
    save: function (props) {
      // props se utiliza para acceder y manipular las propiedades del bloque
      // Se crea un elemento div para la visualización del bloque en la página
      const { attributes } = props;
      const {
        usarTransparencia,
        ocultarBoton,
        ocultarTexto,
        nivelDegradado,
        tamOscuro,
      } = attributes;
      return el(
        "div",
        {
          className: "pagina-container-save",
        },
        el(
          "div", // div del contenido oscuro
          {
            className: `contenido-oscuro-save`,
            style: {
              background: usarTransparencia
                ? `rgba(0, 0, 0, ${nivelDegradado})`
                : `linear-gradient(to left, rgba(0, 0, 0, ${nivelDegradado}), rgba(0, 0, 0, 0))`,
              width: `${tamOscuro}%`,
            },
          },
          !ocultarTexto && // Ocultar texto
            // Se agrega un elemento h2 para mostrar el texto del bloque
            el("h2", { className: "texto-save" }, props.attributes.texto),
          !ocultarBoton && // Ocultar boton 'Conocer Más'
            // Se agrega un enlace (a)
            el(
              "a",
              {
                className: "conocer-mas-btn-save",
                href: props.attributes.urlBoton,
                onClick: function () {
                  console.log("¡Enlace clickeado!"); // Test
                },
              },
              "Conocer Más"
            )
        ),
        el("img", {
          className: "imagen-fondo-save",
          src: props.attributes.mediaURL,
          alt: "Imagen personalizada",
        })
      );
    },
  });
})(
  // Se cierra la función anónima y se invoca inmediatamente
  // con los objetos de la API de WordPress para que el bloque esté disponible
  window.wp.blocks,
  window.wp.editor,
  window.wp.components,
  window.wp.element
);
