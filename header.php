<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hmsphr
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hmsphr' ); ?></a>

	<header id="masthead" class="site-header">
		<div id="sidebar_fixed_wrapper">
			<div class="site-branding typo_alpha">
				<?php if ( is_home() or is_singular( 'actu' ) or is_singular( 'annonce' )){ ?>
			 		<h1 class="logo typo_alpha">
		 				<a class="" title="ESACM" href="<?php echo site_url(); ?>">ÉCOLE</br>SUPÉRIEURE</br>D’ART</br>DE CLERMONT</br>MÉTROPOLE</a>
			 		</h1>
			 	<?php }?>

			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hmsphr' ); ?></button>
				<div id="esacm_logo_wrapper_mobile" class="only_mobile">
					<a href="<?php echo site_url(); ?>">
						<?php if( is_home()||(basename(get_permalink())=='diplomes') ){?>
						<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ESACM-blanc.svg">
						<?php } else{ ?>
						<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ESACM-noir.svg">
						<?php } ?>
					</a>
				</div>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu nav-menu typo_epsilon'
					) );
				?>


				<div id="english_link_wrapper" class="typo_epsilon">
					<br>
					<?php
						wp_nav_menu( array(
							'menu'        => 'english-menu',
							'menu_class'     => 'menu nav-menu typo_epsilon'
						) );
					?>
					<br>
				</div>
				<div id="esacm_logo_wrapper" class="not_mobile">
					<a href="<?php echo site_url(); ?>">
						<?php if( is_home()||(basename(get_permalink())=='diplomes') ){?>
						<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ESACM-blanc.svg">
						<?php } else{ ?>
						<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ESACM-noir.svg">
						<?php } ?>
					</a>
				</div>
				<div id="other_links_wrapper" class="typo_epsilon">
					<br>
					<?php
						wp_nav_menu( array(
							'menu'        => 'bottom-menu',
							'menu_class'     => 'menu nav-menu typo_epsilon'
						) );
					?>
				</div>
			</nav><!-- #site-navigation -->



		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
