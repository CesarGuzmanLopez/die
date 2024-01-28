<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @author CesarGuzmanLopez
 * @package IdentidadUAMStandar
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:description" content="<?php echo wp_strip_all_tags(get_the_excerpt(), true); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:image" content="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="300" />
	<meta property="og:image:height" content="300" />
	<meta property="fb:app_id" content="1389482644948713" />
	<meta name="description" content="<?php echo wp_strip_all_tags(get_the_excerpt(), true); ?>" />
	<meta name="keywords" content="<?php the_title(); ?>" />
	<meta name="author" content="UAM Iztapalapa" />
	<meta name="robots" content="index, follow" />
	<meta name="canonical" href="<?php the_permalink(); ?>" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>
		<a class="skip-link button" href="#site-content"><?php _e( 'Skip to the content', 'rowling' ); ?></a>
		<?php if ( has_nav_menu( 'secondary' ) || has_nav_menu( 'social' ) ) : ?>
			<div class="top-nav">
				<div class="section-inner group">
					<?php if ( has_nav_menu( 'secondary' ) ) : ?>
						<ul class="secondary-menu dropdown-menu reset-list-style">
							<?php 
							wp_nav_menu( array( 
								'container' 		=> '', 
								'items_wrap' 		=> '%3$s',
								'theme_location' 	=> 'secondary'
							) ); 
							?>
						</ul><!-- .secondary-menu -->

					<?php endif; ?>
				</div><!-- .section-inner -->
			</div><!-- .top-nav -->
		<?php endif; ?>

		<header class="header-wrapper section-inner">
			<div class="header">
			
					<div class="header-logos">
					<?php
					$logo_header_1 = get_theme_mod('logo_header_1_setting', '');
					$logo_header_2 = get_theme_mod('logo_header_2_setting', '');
						
						if (!empty($logo_header_1)) {
							$logo_header_1_link = get_theme_mod('logo_header_1_link_setting', ''); // Obtener el enlace
							echo '<div class="logo"><a href="' . esc_url($logo_header_1_link) . '"><img src="' . esc_url($logo_header_1) . '" alt="Logo Header 1" class="logo-header"></a></div>';
						}

						if (!empty($logo_header_2)) {
							$logo_header_2_link = get_theme_mod('logo_header_2_link_setting', ''); // Obtener el enlace
							echo '<div  class="logo"><a href="' . esc_url($logo_header_2_link) . '"><img src="' . esc_url($logo_header_2) . '" alt="Logo Header 2" class="logo-header"></a></div>';
						}
					?>
					</div>
		
					<?php if ( is_active_sidebar('header-sidebar') ) : ?>
					<div class="header-sidebar">
						<?php dynamic_sidebar('header-sidebar'); ?>
					</div>
					<?php endif; ?>


					
					</div>
					<div class="nav-toggle">
					<span class="menu-text">Menú</span>
						<div class="bars">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
					</div><!-- .nav-toggle -->
			</div><!-- .header -->
			
			<div class="navigation">
				
				<div class="group">
					
					<ul class="primary-menu reset-list-style dropdown-menu">
						
						<?php if ( has_nav_menu( 'primary' ) ) {

							$nav_args = array( 
								'container' => '', 
								'items_wrap' => '%3$s',
								'theme_location' => 'primary'
							);
																		
							wp_nav_menu( $nav_args ); 
						
						} else {

							$list_pages_args = array(
								'container' => '',
								'title_li' 	=> ''
							);

							wp_list_pages( $list_pages_args );
							
						} ?>
															
					</ul>
					
				</div><!-- .section-inner -->
				
			</div><!-- .navigation -->
			
				
				<?php 
					if ( has_nav_menu( 'primary' ) ) { ?>
					<ul class="mobile-menu reset-list-style">
				<?php
					wp_nav_menu( $nav_args );  ?>
				</ul>  
					<?php
				} else {
					wp_list_pages( $list_pages_args );
				}
				?>
				
		
		</header><!-- .header-wrapper -->
		<main id="site-content">
		<!--bajo-menu-sidebar-->
		<?php if ( is_active_sidebar('bajo-menu-sidebar') ) : ?>
			<div class="bajo-menu-sidebar">
				<?php dynamic_sidebar('bajo-menu-sidebar'); ?>
			</div>
		<?php endif; ?>