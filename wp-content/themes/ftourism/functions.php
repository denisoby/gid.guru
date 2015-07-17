<?php
/*
 * fTourism functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 */

if ( ! function_exists( 'ftourism_setup' ) ) :
/**
 * fTourism setup.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function ftourism_setup() {

	load_theme_textdomain( 'ftourism',  get_stylesheet_directory() . '/languages' );
	
	add_action( 'widgets_init', 'ftourism_widgets_init' );
}
endif; // ftourism_setup
add_action( 'after_setup_theme', 'ftourism_setup' );

/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function ftourism_widgets_init() {

	/**
	 * Add Homepage Columns Widget areas
	 */
	register_sidebar( array (
							'name'			 =>  __( 'Homepage Column #1', 'ftourism' ),
							'id' 			 =>  'homepage-column-1-widget-area',
							'description'	 =>  __( 'The Homepage Column #1 widget area', 'ftourism' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="sidebar-title">',
							'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
						) );
						
	register_sidebar( array (
							'name'			 =>  __( 'Homepage Column #2', 'ftourism' ),
							'id' 			 =>  'homepage-column-2-widget-area',
							'description'	 =>  __( 'The Homepage Column #2 widget area', 'ftourism' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="sidebar-title">',
							'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
						) );
	
	/**
	 * Add Footer Columns Widget areas
	 */
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'ftourism' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'ftourism' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="sidebar-title">',
							'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
						) );
						
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'ftourism' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'ftourism' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="sidebar-title">',
							'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
						) );
}

/**
 *
 * Override functions defined in the fTourism Child Theme
 *
 */
 
/**
 * Returns URL to the full theme.
 */
function fkidd_get_full_theme_url() {

	return "http://tishonator.com/product/ttourism";
}

/**
 * Returns the get full theme name.
 */
function fkidd_get_full_theme_name() {

	return __("Get tTourism Theme", "ftourism");
}

?>