<?php get_header(); ?>

<div class="wrapper section-inner group">
	<div class="content">		        
		<article class="post single single-post">
			<p class="post-categories"><?php _e( 'Error 404', 'uam_die' ); ?></p>
		
			<div class="post-header">
			    <h1 class="post-title"><?php _e( "No se pudo encontrar la pagina que buscabas", "uam_die" ); ?></h1>
			</div><!-- .post-header -->
				
			<div class="post-inner">
				
				<div class="post-content entry-content">
				
					<p><?php _e( "Esta pagina es un error 404 ", "uam_die" ); ?></p>
					
					<p><?php printf(__( 'También puedes regresar a la %1$s página de inicio %2$s y continuar tu búsqueda desde allí.', 'uam_die' ), '<a href="' . esc_url( get_home_url() ) .  '">', '</a>' ); ?></p>
					
					<p><?php get_search_form(); ?></p>
				
				</div><!-- .post-content -->
									
			</div><!-- .post-inner -->
																
		</article><!-- .post -->
									                        		
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
</div><!-- .wrapper.section-inner -->
								
<?php get_footer(); ?>