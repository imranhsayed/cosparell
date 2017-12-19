<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cosparell
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
	<div class="cosparell-site-logo"><?php cosparell_site_logo(); ?></div>
	<div class="site-branding">
		<?php cosparell_site_branding(); ?>
	</div><!-- .site-branding -->
<!--		<a id="primary-nav-button" class="canis-mobile-nav-button menu-toggle" href="#site-navigation">--><?php //esc_html_e( 'Mobile Menu' , 'canis' ); ?><!--</a>-->
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'cosparell' ); ?></a>
		<div class="header-icons clear">
			<ul>
				<li>
					<?php get_search_form();  ?> <!-- picks up the searchform.php file -->
				</li>
				<li><span class="search-icon"></span></li>
			</ul>

		</div>




		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h1 class="screen-reader-text">Main Navigation</h1>
			<div class="navicon closed"><i class="fa fa-navicon"></i></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 3 ) ); ?>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'primary-menu menu',
				'container_class' => 'cosparell-mobile-menu',
				'depth'          => 3,
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<!-- *including flexslider.php file from template -parts folder -->
	<?php get_template_part( 'template-parts/banner' ); ?>
	<div class="grid-container grid-container-padded">
			<div id="content" class="site-content row grid-x grid-margin-x">
