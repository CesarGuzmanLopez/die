(function(blocks, editor, components, element, blockEditor) {
    const { createElement: el } = element;
    const { registerBlockType } = blocks;
    const { InnerBlocks, MediaUpload, InspectorControls, ColorPalette } = editor;
    const { PanelBody, TextControl, TextareaControl, SelectControl, RangeControl, ToggleControl } = components;
    const { useBlockProps } = blockEditor;

    const blockConfig = {
        title: 'Imagen Personalizada',
        icon: 'format-image',
        category: 'media',
        attributes: {
            mediaURL: {
                type: 'string',
                source: 'attribute',
                selector: 'img',
                attribute: 'src',
            },
            mediaID: {
                type: "number",
            },
            html: {
                type: 'string',
                default: '<h2 style="color: red; font-size: 20px; text-align: center;">UAM Iztapalapa</h2>',
            },
            titulo: {
                type: 'string',
                default: 'Titulo',
            },
            contenido: {
                type: 'string',
                default: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum at molestiae perspiciatis molestias similique non necessitatibus consequatur nostrum officia voluptatibus delectus debitis unde aliquam dolorem qui suscipit, voluptatum ad? Illo.',
            },
            urlBoton: {
                type: 'string',
                default: 'http://www.iztapalapa.uam.mx/',
            },
            ocultarBloque: {
                type: 'boolean',
                default: true,
            },
            ocultarHTML: {
                type: 'boolean',
                default: true,
            },
            ocultarTitulo: {
                type: 'boolean',
                default: false,
            },
            ocultarContenido: {
                type: 'boolean',
                default: false,
            },
            ocultarBoton: {
                type: 'boolean',
                default: false,
            },
            usarTransparencia: {
                type: 'boolean',
                default: false,
            },
            nivelDegradado: {
                type: 'number',
                default: 1,
            },
            tamContenido: {
                type: 'number',
                default: 40,
            },
            tamDegradado: {
                type: 'number',
                default: 40,
            },
            justificado: {
                type: "string",
                default: "center",
            },
            ubicacion: {
                type: "string",
                default: "derecha",
            },
            colorTitulo: {
                type: "string",
                default: "#ffffff",
            },
            colorContenido: {
                type: "string",
                default: "#ffffff",
            },
            colorBoton: {
                type: "string",
                default: "#ffffff",
            },
            ancho: {
                type: "number",
                default: 100,
            },
            alto: {
                type: "number",
                default: 65,
            },
        },

        edit: function(props) {
            const {
                attributes: {
                    mediaURL,
                    mediaID,
                    html,
                    titulo,
                    contenido,
                    urlBoton,
                    ocultarBloque,
                    ocultarHTML,
                    ocultarTitulo,
                    ocultarContenido,
                    ocultarBoton,
                    usarTransparencia,
                    nivelDegradado,
                    tamContenido,
                    tamDegradado,
                    justificado,
                    ubicacion,
                    colorTitulo,
                    colorContenido,
                    colorBoton,
                    ancho,
                    alto,
                },
                setAttributes
            } = props;

            const nuevoTitulo = (value) => {
                props.setAttributes({ titulo: value });
            };
            const nuevoHtml = (value) => {
                props.setAttributes({ html: value });
            };
            const nuevoContenido = (value) => {
                props.setAttributes({ contenido: value });
            };
            const obtenerUrl = (value) => {
                props.setAttributes({ urlBoton: value });
            };
            const tipoDegradado = () => {
                props.setAttributes({ usarTransparencia: !usarTransparencia });
            };
            const oculBloque = () => {
                props.setAttributes({ ocultarBloque: !ocultarBloque, });
            };
            const oculHTML = () => {
                props.setAttributes({ ocultarHTML: !ocultarHTML, });
            };
            const oculTitulo = () => {
                props.setAttributes({ ocultarTitulo: !ocultarTitulo, });
            };
            const oculContenido = () => {
                props.setAttributes({ ocultarContenido: !ocultarContenido });
            };
            const oculBoton = () => {
                props.setAttributes({ ocultarBoton: !ocultarBoton });
            };
            const tamDeg = (value) => {
                props.setAttributes({ tamDegradado: value });
            };
            const tamCon = (value) => {
                props.setAttributes({ tamContenido: value });
            };
            const nivelDeg = (value) => {
                props.setAttributes({ nivelDegradado: value });
            };

            const blockProps = useBlockProps({
                className: 'bloque',
                style: {
                    position: 'relative',
                    width: ancho + "%",
                    height: alto + "vh",
                    backgroundImage: `url(${mediaURL})`,
                    backgroundSize: 'cover',
                    border: '10px solid #000000',
                },
            });

            const getTamañoContenido = () => {
                if (ubicacion === 'derecha') {
                    return {
                        right: '0',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        width: tamContenido + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'izquierda') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: '0',
                        bottom: 'auto',
                        width: tamContenido + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'abajo') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: '0',
                        width: ancho + "%",
                        height: tamContenido + "%",
                    };
                } else if (ubicacion === 'arriba') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        width: ancho + "%",
                        height: tamContenido + "%",
                    };
                } else if (ubicacion === 'centro') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: 'auto',
                        width: '100%',
                        height: '100%',
                    };
                }
            };

            const getDegradadoStyle = () => {
                if (ubicacion === 'derecha') {
                    return {
                        right: '0',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: tamDegradado + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'izquierda') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: '0',
                        bottom: 'auto',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to left, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: tamDegradado + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'abajo') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: '0',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: ancho + "%",
                        height: tamDegradado + "%",
                    };
                } else if (ubicacion === 'arriba') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: ancho + "%",
                        height: tamDegradado + "%",
                    };
                } else if (ubicacion === 'centro') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: 'auto',
                        width: '100%',
                        height: '100%',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `radial-gradient(circle at center, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                    };
                }
            };

            return el(
                "div",
                blockProps,
                el(
                    InspectorControls, {},
                    el(
                        PanelBody, { title: "Configuraciones del Bloque", initialOpen: true },
                        el(MediaUpload, {
                            onSelect: function(media) {
                                props.setAttributes({ mediaID: media.id, mediaURL: media.url });
                            },
                            type: 'image',
                            value: mediaID,
                            render: function(obj) {
                                return el(
                                    components.Button, {
                                        className: 'button-edit',
                                        onClick: obj.open,
                                    }, !mediaID ? "Seleccionar Imagen" : "Cambiar Imagen",
                                );
                            },
                        }),
                        el(RangeControl, {
                            label: "Ancho del Bloque (%)",
                            value: ancho,
                            onChange: (value) => props.setAttributes({ ancho: value }),
                            min: 10,
                            max: 100,
                            step: 1,
                        }),
                        el(RangeControl, {
                            label: "Alto del Bloque (vh)",
                            value: alto,
                            onChange: (value) => props.setAttributes({ alto: value }),
                            min: 10,
                            max: 100,
                            step: 1,
                        }),
                        el(RangeControl, {
                            label: 'Tamaño del área de texto',
                            value: tamContenido,
                            onChange: tamCon,
                            min: 35,
                            max: 100,
                            step: 1,
                        }),
                        el(RangeControl, {
                            label: 'Tamaño del área degradada',
                            value: tamDegradado,
                            onChange: tamDeg,
                            min: 35,
                            max: 100,
                            step: 1,
                        }),
                        el(RangeControl, {
                            label: 'Nivel del degradado del área',
                            value: nivelDegradado,
                            onChange: nivelDeg,
                            min: 0,
                            max: 1,
                            step: 0.05,
                        }),
                        el(SelectControl, {
                            label: "Ubicación de area degradada",
                            value: ubicacion,
                            options: [
                                { label: "Derecha", value: "derecha" },
                                { label: "Izquierda", value: "izquierda" },
                                { label: "Abajo", value: "abajo" },
                                { label: "Arriba", value: "arriba" },
                                { label: "Centro", value: "centro" },
                            ],
                            onChange: (value) => props.setAttributes({ ubicacion: value }),
                        }), !ocultarContenido &&
                        el(SelectControl, {
                            label: "Alineación de texto del contenido",
                            value: justificado,
                            options: [
                                { label: "Centro", value: "center" },
                                { label: "Justificado", value: "justify" },
                                { label: "Derecha", value: "right" },
                                { label: "Izquierda", value: "left" },
                            ],
                            onChange: (value) => props.setAttributes({ justificado: value }),
                        }), !ocultarHTML &&
                        el(TextareaControl, {
                            label: 'Inyecta HTML',
                            value: props.attributes.html,
                            onChange: nuevoHtml,
                            style: {
                                width: '100%', // Ancho del textarea
                                height: 'auto', // Altura inicial
                                minHeight: '100px', // Altura mínima (ajusta según tus necesidades)
                            },
                        }), !ocultarTitulo &&
                        el(TextControl, {
                            label: 'Titulo',
                            value: props.attributes.titulo,
                            onChange: nuevoTitulo,
                        }), !ocultarContenido &&
                        el(TextareaControl, {
                            label: 'Contenido',
                            value: props.attributes.contenido,
                            onChange: nuevoContenido,
                            style: {
                                width: '100%', // Ancho del textarea
                                height: 'auto', // Altura inicial
                                minHeight: '100px', // Altura mínima (ajusta según tus necesidades)
                            },
                        }), !ocultarBoton &&
                        el(TextControl, {
                            label: 'URL del botón "Conocer Más"',
                            value: props.attributes.urlBoton,
                            onChange: obtenerUrl,
                        }),
                        el(ToggleControl, {
                            label: 'Ocultar Bloque',
                            checked: ocultarBloque,
                            onChange: oculBloque,
                        }),
                        el(ToggleControl, {
                            label: 'Ocultar Inyectar HTML en Titulo',
                            checked: ocultarHTML,
                            onChange: oculHTML,
                        }),
                        el(ToggleControl, {
                            label: 'Ocultar Titulo',
                            checked: ocultarTitulo,
                            onChange: oculTitulo,
                        }),
                        el(ToggleControl, {
                            label: 'Ocultar Contenido',
                            checked: ocultarContenido,
                            onChange: oculContenido,
                        }),
                        el(ToggleControl, {
                            label: 'Ocultar botón "Conocer Más"',
                            checked: ocultarBoton,
                            onChange: oculBoton,
                        }),
                        el(ToggleControl, {
                            label: 'Tipo de transparencia',
                            checked: usarTransparencia,
                            onChange: tipoDegradado,
                        }), !ocultarTitulo &&
                        el('p', {}, 'Color del Titulo',
                            el(ColorPalette, {
                                value: colorTitulo,
                                onChange: (value) => props.setAttributes({ colorTitulo: value }),
                            })), !ocultarContenido &&
                        el('p', {}, 'Color del Contenido',
                            el(ColorPalette, {
                                value: colorContenido,
                                onChange: (value) => props.setAttributes({ colorContenido: value }),
                            })),
                        el('p', {}, 'Color texto del boton',
                            el(ColorPalette, {
                                value: colorBoton,
                                onChange: (value) => props.setAttributes({ colorBoton: value }),
                            })),
                    ),
                ),
                el(
                    'div', {
                        className: 'degradado',
                        style: {
                            ...getDegradadoStyle(),
                        },
                    },
                ),
                el(
                    "div", {
                        className: 'areaContenido',
                        style: {
                            ...getTamañoContenido(),
                        },
                    }, !ocultarBloque &&
                    el(
                        InnerBlocks, // Este componente renderizará el contenido de bloques internos
                        {
                            className: 'bloque',
                            style: {
                                width: '80 %',
                                height: 'auto',
                                margin: '0 auto',
                            },
                            template: [
                                ['core/paragraph', { placeholder: 'Titulo' }],
                            ],
                        },
                    ), !ocultarHTML &&
                    el(
                        'div', {
                            dangerouslySetInnerHTML: { __html: props.attributes.html },
                        },
                    ), !ocultarTitulo &&
                    el(
                        'h2', {
                            className: 'titulo',
                            style: { color: colorTitulo },
                        },
                        props.attributes.titulo), !ocultarContenido &&
                    el(
                        "div", {
                            className: 'contenido',
                            style: {
                                color: colorContenido,
                            },
                        },
                        el(
                            'p', {
                                style: {
                                    textAlign: justificado,
                                },
                            },
                            props.attributes.contenido),
                    ), !ocultarBoton &&
                    el(
                        'a', {
                            className: 'conocer-mas',
                            style: {
                                color: colorBoton,
                            },
                            href: props.attributes.urlBoton,
                        }, 'Conocer Más'),
                ),
            );
        },
        save: function(props) {
            const {
                attributes: {
                    mediaURL,
                    mediaID,
                    html,
                    titulo,
                    contenido,
                    urlBoton,
                    ocultarBloque,
                    ocultarHTML,
                    ocultarTitulo,
                    ocultarContenido,
                    ocultarBoton,
                    usarTransparencia,
                    nivelDegradado,
                    tamDegradado,
                    tamContenido,
                    justificado,
                    ubicacion,
                    colorTitulo,
                    colorContenido,
                    colorBoton,
                    ancho,
                    alto,
                },
            } = props;

            const blockProps = useBlockProps.save({
                className: 'bloque',
                style: {
                    position: 'relative',
                    width: ancho + "%",
                    height: alto + "vh",
                    backgroundImage: `url(${mediaURL})`,
                    backgroundSize: 'cover',
                    border: '10px solid #000000',
                },
            });

            const getTamañoContenido = () => {
                if (ubicacion === 'derecha') {
                    return {
                        right: '0',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        width: tamContenido + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'izquierda') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: '0',
                        bottom: 'auto',
                        width: tamContenido + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'abajo') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: '0',
                        width: ancho + "%",
                        height: tamContenido + "%",
                    };
                } else if (ubicacion === 'arriba') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        width: ancho + "%",
                        height: tamContenido + "%",
                    };
                } else if (ubicacion === 'centro') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: 'auto',
                        width: '100%',
                        height: '100%',
                    };
                }
            };

            const getDegradadoStyle = () => {
                if (ubicacion === 'derecha') {
                    return {
                        right: '0',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: tamDegradado + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'izquierda') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: '0',
                        bottom: 'auto',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to left, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: tamDegradado + "%",
                        height: alto + "vh",
                    };
                } else if (ubicacion === 'abajo') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: '0',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: ancho + "%",
                        height: tamDegradado + "%",
                    };
                } else if (ubicacion === 'arriba') {
                    return {
                        right: 'auto',
                        top: '0',
                        left: 'auto',
                        bottom: 'auto',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                        width: ancho + "%",
                        height: tamDegradado + "%",
                    };
                } else if (ubicacion === 'centro') {
                    return {
                        right: 'auto',
                        top: 'auto',
                        left: 'auto',
                        bottom: 'auto',
                        width: '100%',
                        height: '100%',
                        background: usarTransparencia ? `rgba(0, 0, 0, ${nivelDegradado})` : `radial-gradient(circle at center, rgba(0, 0, 0, 0), rgba(0, 0, 0, ${nivelDegradado}))`,
                    };
                }
            };

            return el(
                "div",
                blockProps,
                el(
                    'div', {
                        className: 'degradado',
                        style: {
                            ...getDegradadoStyle(),
                        },
                    },
                ),
                el(
                    "div", {
                        className: 'areaContenido',
                        style: {
                            ...getTamañoContenido(),
                        },
                    }, !ocultarBloque &&
                    el(
                        InnerBlocks.Content,
                    ), !ocultarHTML &&
                    el(
                        'div', {
                            dangerouslySetInnerHTML: { __html: props.attributes.html },
                        },
                    ), !ocultarTitulo &&
                    el(
                        'h2', {
                            className: 'titulo',
                            style: { color: colorTitulo },
                        },
                        props.attributes.titulo), !ocultarContenido &&
                    el(
                        "div", {
                            className: 'contenido',
                            style: {
                                color: colorContenido,
                            },
                        },
                        el(
                            'p', {
                                style: {
                                    textAlign: justificado,
                                },
                            },
                            props.attributes.contenido),
                    ), !ocultarBoton &&
                    el(
                        'a', {
                            className: 'conocer-mas',
                            style: {
                                color: colorBoton,
                            },
                            href: props.attributes.urlBoton,
                        }, 'Conocer Más'),
                ),
            );
        },
    };
    registerBlockType("tu-plugin-imagen-licenciatura/imagen-licenciatura", blockConfig);
})(
    window.wp.blocks,
    window.wp.editor,
    window.wp.components,
    window.wp.element,
    window.wp.blockEditor
);

/*(function (wp) {
  const { subscribe } = wp.data;
  let lastBlocks = [];
  subscribe(() => {
    const blocks = wp.data.select("core/block-editor").getBlocks();
    if (blocks.length !== lastBlocks.length) {
      lastBlocks = blocks;
      wp.data.dispatch("core/editor").lockPostSaving("bloque-imagen");
      wp.data.dispatch("core/editor").savePost();
    }
  });
})(window.wp);*/