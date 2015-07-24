<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Cerauno
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
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cerauno' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<nav id="site-navigation" class="main-navigation clear" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'cerauno' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<?php wp_nav_menu( array(
									'theme_location'  => 'social',
									'depth'           => 1,
									'link_before'     => '<span class="screen-reader-text">',
									'link_after'      => '</span>',
									'container_class' => 'social-links', ) ); ?>
			<?php endif; ?>
		</nav><!-- #site-navigation -->

		<div class="site-branding">
			<?php if ( function_exists( 'jetpack_the_site_logo' ) && has_site_logo() ) : ?>
				<?php jetpack_the_site_logo(); ?>
			<?php endif; ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

	<?php if ( is_single() || is_page() && has_post_thumbnail() ) : ?>
		<div class="featured-header-image">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php the_post_thumbnail( 'cerauno-header' ); ?>
			</a>
		</div><!-- .featured-header-image -->
	<?php endif; ?>