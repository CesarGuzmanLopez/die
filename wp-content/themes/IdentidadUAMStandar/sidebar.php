<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @author CesarGuzmanLopez
 * @package IdentidadUAMStandar
 */
?><div class="sidebar">
	<?php 
	// Comprobar si la barra lateral tiene widgets activos
	if (is_active_sidebar('sidebar')) { 
		dynamic_sidebar('sidebar'); // Mostrar widgets activos
	} else { // Si la barra lateral está vacía, mostrar widgets predeterminados
		echo '<div class="widgets">';
		
		// Widget de Categorías
		the_widget(
			'WP_Widget_Categories', 
			array(
				'count'			=>	'1',
				'hierarchical'	=>	'1',
			),
			array(
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'before_widget' => '<div class="widget widget_categories"><div class="widget-content">',
				'after_widget' => '</div></div>'
			) 
		);
		
		// Widget de Archivos
		the_widget(
			'WP_Widget_Archives', 
			array(
				'count'			=>	'1',
				'hierarchical'	=>	'1',
			),
			array(
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'before_widget' => '<div class="widget widget_archive"><div class="widget-content">',
				'after_widget' => '</div></div>'
			) 
		);
		
		echo '</div>';
	}
	?>

</div>
