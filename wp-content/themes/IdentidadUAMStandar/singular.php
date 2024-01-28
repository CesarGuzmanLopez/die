<?php get_header(); ?>

<div class="wrapper section-inner group">
	<div class="content">
		<?php 
		// Comprobar si hay publicaciones disponibles
		if (have_posts()) : 
			while (have_posts()) : 
				the_post(); 
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('single single-post group'); ?>>
					<div class="post-header">
						<?php 
						// Mostrar categorías si es una publicación individual y tiene categorías
						if (is_single() && has_category()) : ?>
							<p class="post-categories"><?php the_category(', '); ?></p>
						<?php endif;
						// Mostrar título de la publicación
						the_title('<h1 class="post-title">', '</h1>');
						?>
							
						
					</div><!-- .post-header -->
					
					<?php 
					// Comprobar si la publicación tiene una imagen destacada y no está protegida por contraseña y no es categoria profesores
					$post_format = get_post_format() ? get_post_format() : 'standard';
					if (has_post_thumbnail() && !post_password_required() 
							&& !in_category('profesores') 
					) : ?>
						<figure class="post-image">
							<?php 
							// Mostrar imagen destacada
							the_post_thumbnail('post-image');
							
							// Obtener el pie de foto de la imagen destacada
							$image_caption = get_the_post_thumbnail_caption($post->ID);
							
							if ($image_caption) : ?>
								<div class="post-image-caption"><span class="fa fw fa-camera"></span><?php echo wpautop($image_caption); ?></div>
							<?php endif; ?>
						</figure><!-- .post-image -->
					<?php endif;
					?>
							
					<div class="post-inner">
						<div class="post-content entry-content">
							<?php 
							// Mostrar contenido de la publicación
							the_content();
							
							// Mostrar enlaces de paginación si existen
							wp_link_pages(array(
								'before'           => '<p class="page-links"><span class="title">' . __('Páginas:', 'uam_die') . '</span>',
								'after'            => '</p>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'separator'        => '',
								'pagelink'         => '%',
								'echo'             => 1
							));
							?>
						</div><!-- .post-content -->
						
						<?php 
						// Mostrar etiquetas si es una publicación individual
						if (is_single()) : ?>
							<?php the_tags('<div class="post-tags">', '', '</div>'); ?>
						<?php endif; ?>
					</div><!-- .post-inner -->
				</article><!-- .post -->
				
				<?php 
			endwhile; 
		endif; 
		?>
	</div><!-- .content -->
	<?php get_sidebar(); ?>
	
</div><!-- .wrapper -->
		
<?php get_footer(); ?>
