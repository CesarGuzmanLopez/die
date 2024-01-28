<?php

if ( ! class_exists( 'uam_die_Customize' ) ) :
    class uam_die_Customize {

        public static function register( $wp_customize ) {

            /* SECTION: uam_die OPTIONS */

            $wp_customize->add_section( 'uam_die_options', array(
                'title'         => __( 'Options for uam_die', 'uam_die' ),
                'priority'      => 10,
                'capability'    => 'edit_theme_options',
                'description'   => __( 'Allows you to customize theme settings for uam_die.', 'uam_die' ),
            ) );

            /* SETTING: ACCENT COLOR */

            // Define an array of CSS variable names and their default values.
            $css_variables_colors = array(
                // Colors
                '--color-primario'               => '#509F4A',
                '--color-secundario'             => '#ff5733',
                '--color-terciario'              => '#4287f5',
                '--color-advertencia'            => '#e85d0f',
                '--color-error'                  => '#a154e8',
                '--color-exito'                  => '#0f4a8a',
                '--color-informativo'            => '#0fc8e8',
                '--color-neutral'                => '#777',
                '--color-fondo'                  => '#fff',
                '--color-fondo-2'                => '#f1f1f1',
                '--color-texto'                  => '#111',
				'--color-fondo-secundario-resalta' => '#313131',
				'--color-texto-secundario-resalta'     => '#ff5733',
            );

            $css_variables_sizes = array(
                '--espaciado'                    => '20px',
                '--padding-m'                    => '15px',
                '--padding-l'                    => '20px',
                '--padding-xl'                   => '25px',
                '--margin-m'                     => '15px',
                '--margin-l'                     => '20px',
                '--margin-xl'                    => '25px',
                '--tamano-pantalla-responsive'    => '768px',
            );

            $css_variables_fuentes = array(
                // Fonts
                '--fuente-base'                  => 'Arial, Helvetica, sans-serif',
                '--fuente-titulo'                => "'Roboto', sans-serif",
                '--fuente-texto'                 => "'Open Sans', sans-serif",
                '--fuente-monoespaciada'         => "'Courier New', monospace",
                '--fuente-iconos'                => "'FontAwesome', sans-serif",
            );

            // Loop through the array of CSS variable names and values.
            foreach ( $css_variables_colors as $name_oroginal => $default ) {
                $name = str_replace( '--', '', $name_oroginal );
                // Set up the setting and control for each variable.
                $wp_customize->add_setting( $name_oroginal, array(
                    'default'           => $default,
                    'type'              => 'theme_mod',
                    'sanitize_callback' => 'sanitize_hex_color'
                ) );

                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $name_oroginal, array(
                    'label'     => $name_oroginal,
                    'section'   => 'uam_die_options',
                    'settings'  => $name_oroginal,
                    'priority'  => 10,
                ) ) );
            }

            // Loop through the array of CSS variable names and values for sizes.

            foreach ( $css_variables_sizes as $name_oroginal => $default ) {
                $name = str_replace( '--', '', $name_oroginal );
                // Set up the setting and control for each variable.
                $wp_customize->add_setting( $name_oroginal, array(
                    'default'           => $default,
                    'type'              => 'theme_mod',
                ) );

                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $name_oroginal, array(
                    'label'     => $name_oroginal,
                    'section'   => 'uam_die_options',
                    'settings'  => $name_oroginal,
                    'priority'  => 10,
                ) ) );
            }

            foreach ( $css_variables_fuentes as $name_oroginal => $default ) {
                $name = str_replace( '--', '', $name_oroginal );
                // Set up the setting and control for each variable.
                $wp_customize->add_setting( $name_oroginal, array(
                    'default'           => $default,
                    'type'              => 'theme_mod',
                ) );

                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $name_oroginal, array(
                    'label'     => $name_oroginal,
                    'section'   => 'uam_die_options',
                    'settings'  => $name_oroginal,
                    'priority'  => 10,
                ) ) );
            }

        }

        public static function header_output() {

            echo '<!-- Customizer CSS -->';
            echo '<style type="text/css">';
            echo ":root {";
            // Loop through the array of CSS variable names and values.
            $css_variables_colors = array(
                // Colors
                '--color-primario'               => '#509F4A',
                '--color-secundario'             => '#ff5733',
                '--color-terciario'              => '#4287f5',
                '--color-advertencia'            => '#e85d0f',
                '--color-error'                  => '#a154e8',
                '--color-exito'                  => '#0f4a8a',
                '--color-informativo'            => '#0fc8e8',
                '--color-neutral'                => '#777',
                '--color-fondo'                  => '#fff',
                '--color-fondo-2'                => '#f1f1f1',
                '--color-fondo-secundario-resalta' => '#313131',
                '--color-texto'                  => '#111',
				'--color-texto-secundario-resalta'     => '#ff5733',

            );
            foreach ( $css_variables_colors as $name => $default ) {
                // Get the current value of the variable.
                $value = get_theme_mod( $name, $default );
                // If the current value is different from the default, output it.
                if ( $value !== $default ) {
                    echo sprintf( '%s:%s;', $name, $value );
                }
            }
            // Loop through the array of CSS variable names and values for sizes.
            $css_variables_sizes = array(
                '--espaciado'                    => '20px',
                '--padding-m'                    => '15px',
                '--padding-l'                    => '20px',
                '--padding-xl'                   => '25px',
                '--margin-m'                     => '15px',
                '--margin-l'                     => '20px',
                '--margin-xl'                    => '25px',
                '--tamano-pantalla-responsive'    => '768px',
            );
            foreach ( $css_variables_sizes as $name => $default ) {
                // Get the current value of the variable.
                $value = get_theme_mod( $name, $default );
                // If the current value is different from the default, output it.
                if ( $value !== $default ) {
                    echo sprintf( '%s:%s;', $name, $value );
                }
            }
            // Loop through the array of CSS variable names and values for fonts.
            $css_variables_fuentes = array(
                // Fonts
                '--fuente-base'                  => 'Arial, Helvetica, sans-serif',
                '--fuente-titulo'                => "'Roboto', sans-serif",
                '--fuente-texto'                 => "'Open Sans', sans-serif",
                '--fuente-monoespaciada'         => "'Courier New', monospace",
                '--fuente-iconos'                => "'FontAwesome', sans-serif",
            );
            foreach ( $css_variables_fuentes as $name => $default ) {
                // Get the current value of the variable.
                $value = get_theme_mod( $name, $default );
                // If the current value is different from the default, output it.
                if ( $value !== $default ) {
                    echo sprintf( '%s:%s;', $name, $value );
                }
            }
            echo '</style>';
            echo '<!--/Customizer CSS-->';

        }

        public static function generate_css( $selector, $style, $value, $prefix='', $postfix='', $echo=true ) {
            $return = '';
            if ( $value ) {
                $return = sprintf( '%s { %s:%s; }',
                    $selector,
                    $style,
                    $prefix.$value.$postfix
                );
                if ( $echo ) echo $return;
            }
            return $return;
        }

    }

    add_action( 'customize_register', array( 'uam_die_Customize', 'register' ) );
    add_action( 'wp_head', array( 'uam_die_Customize', 'header_output' ) );

endif;
