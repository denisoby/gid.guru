<?php
/**
 * Version 0.0.2
 */

require_once(  dirname( __FILE__ ) .'/importer/radium-importer.php' ); //load admin theme data importer

class Radium_Theme_Demo_Data_Importer extends Radium_Theme_Importer {

    /**
     * Holds a copy of the object for easy reference.
     *
     * @since 0.0.1
     *
     * @var object
     */
    private static $instance;
    
    /**
     * Set the key to be used to store theme options
     *
     * @since 0.0.2
     *
     * @var object
     */
    public $theme_option_name = 'mom_options'; //set theme options name here
		
	public $theme_options_file_name = 'options.json';
	
	public $widgets_file_name 		=  'widgets.json';
	
	public $content_demo_file_name  =  'content.xml';
	

	public $theme_options_rtl_file_name = 'options-rtl.json';
	
	public $widgets_rtl_file_name 		=  'widgets-rtl.json';
	
	public $content_demo_rtl_file_name  =  'content-rtl.xml';

	/**
	 * Holds a copy of the widget settings 
	 *
	 * @since 0.0.2
	 *
	 * @var object
	 */
	public $widget_import_results;
	
    /**
     * Constructor. Hooks all interactions to initialize the class.
     *
     * @since 0.0.1
     */
    public function __construct() {
    
		$this->demo_files_path = dirname(__FILE__) . '/demo-files/';

        self::$instance = $this;
		parent::__construct();

    }
	
	/**
	 * Add menus
	 *
	 * @since 0.0.1
	 */
	public function set_demo_menus(){

		// Menus to Import and assign - you can remove or add as many as you want
		$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
	
		$locations = array(
				'main' => $main_menu->term_id,
			);
		set_theme_mod('nav_menu_locations', $locations);


	}
	public function set_home_page()
	{


		// remove hello world post
		wp_delete_post( 1, true );

		// remove default sidebars widgets 
		$widgets = get_option('sidebars_widgets');
		$widgets['main-sidebar'] = '';

		update_option('sidebars_widgets', $widgets);

		// update permalinks
		update_option('permalink_structure', '/%year%/%monthnum%/%postname%/');
		update_option('posts_per_page', 5);

	}

	public function set_demo_custom_sidebars() {
		return;
	}


}

new Radium_Theme_Demo_Data_Importer;