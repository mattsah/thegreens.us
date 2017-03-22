<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Simpel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class = "container">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'simpel' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</div>
		</nav><!-- #site-navigation -->
	
	<header id="masthead" class="site-header" role="banner">
	<div class="header-image">
		
		
		<div class="site-branding container">
			<?php if (get_theme_mod("logo")) { ?>
			<div id = "logo" class = "col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<a href="<?php echo esc_url(home_url('/')); ?>"><img src ="<?php echo esc_url(get_theme_mod('logo')); ?>">
				</div>
			<?php } 
				else {
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="site-description-wrapper">
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
			<?php } ?>
		</div><!-- .site-branding -->
		
		
		<div class="search-wrapper">
		
			<div class="container">
			
				<div id="search-top" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				
					<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
						<div><input type="text" size="18" value="" name="s" id="s" />
							<button type="submit" class="search-submit">
								<i class="fa fa-search"></i>
							</button>
						</div>
					</form>
					
				</div>

	<?php
	
	if (get_theme_mod("social")) {
	 get_template_part('social'); 
	 }
	 
	 ?>
			</div>
		</div>
	</div>
		
		
	</header><!-- #masthead -->
	
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'simpel' ); ?></a>

	<div id="content" class="site-content container">
