<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="body-content-wrapper-full">
			
			<header id="header-main">
				<div id="header-top">
					<div id="header-top-content-wrapper">
						<?php fkidd_show_header_top(); ?>
					</div><!-- #header-top-content-wrapper -->
				</div><!-- #header-top-content-wrapper -->
				<div id="header-content-wrapper">
					<div id="header-logo">
						<?php fkidd_show_website_logo_image_or_title(); ?>
					</div><!-- #header-logo -->
					<nav id="navmain">
						<?php wp_nav_menu( array( 'theme_location' => 'primary',
												  'fallback_cb'    => 'wp_page_menu',				  
												  ) ); ?>
					</nav><!-- #navmain -->
					
					<div class="clear">
					</div><!-- .clear -->
				</div><!-- #header-content-wrapper -->
			</header><!-- #header-main -->
