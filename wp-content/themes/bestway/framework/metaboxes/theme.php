<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'mom_';

global $meta_boxes;

$meta_boxes = array();
$imgpath = MOM_URI . '/framework/metaboxes/img/';
$imagepath = MOM_URI . '/framework/metaboxes/img';

// Main settings
$meta_boxes[] = array(
	'id' => 'main_settings',
	'title' => __('Page Layout', 'theme'),
	'pages' => array( 'post', 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

                //custom page
                array(
			'name'  => __('Custom Page', 'theme'),
			'id'    => "{$prefix}custom_page",
			'desc'  => __('if you want build fully customizable page, Enable this option', 'theme'),
			'type'  => 'checkbox',
		),         
		// Page Layout
                array(
			'name'  => __('Page Layout', 'theme'),
			'id'    => "{$prefix}page_layout",
			'desc'  => __('Select page layout, none mean you will use the default layout or what you set by theme options -> Layout', 'theme'),
			'type'  => 'radioimg',
			'std'   => '',
			'options' => array(
				'' => '<img src="'.$imgpath.'none.png" alt="none">',
				'right_sidebar' => '<img src="'.$imgpath.'right_side.png" alt="Right Sidebar">',
				'left_sidebar' => '<img src="'.$imgpath.'left_side.png" alt="Left Sidebar">',
				'full' => '<img src="'.$imgpath.'no_side.png" alt="no Sidebar">',
			),
		),

                // Sidebars
                array(
			'name'  => __('Custom Sidebar', 'theme'),
			'id'    => "{$prefix}right_sidebar",
			'desc'  => __('Select main sidebar', 'theme'),
			'type'  => 'sidebars',
		),                

                
    )

);

// page settings
$meta_boxes[] = array(
	'id' => 'mom_page_setting',
	'title' => __('Page Settings', 'theme'),
	'pages' => array( 'page' ),
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(


        array(
			'name'  => __('Hide Page title', 'theme'),
			'id'    => "{$prefix}hide_page_title",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
        array(
			'name'  => __('Enable comments', 'theme'),
			'id'    => "{$prefix}page_comments",
                        'std'   => false,
			'type'  => 'checkbox',
		),                

    )

);

// post settings
$meta_boxes[] = array(
	'id' => 'posts_settings',
	'title' => __('Post Options', 'framework'),
	'pages' => array( 'post' ),
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(

                array(
			'name'  => __('Hide Feature Image', 'framework'),
			'id'    => "{$prefix}hide_fi",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable posts share', 'framework'),
			'id'    => "{$prefix}blog_ps",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable Next post and prev post links', 'framework'),
			'id'    => "{$prefix}blog_np",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable author box', 'framework'),
			'id'    => "{$prefix}blog_ab",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable Related posts', 'framework'),
			'id'    => "{$prefix}blog_rp",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable comments', 'framework'),
			'id'    => "{$prefix}comments_template",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Feature area background color', 'framework'),
			'id'    => "{$prefix}fa_bg",
                        'std'   => false,
			'type'  => 'color',
                        'desc'  => __('this works for Qoute, Aside and Status posts, if you upload feature image you will not see this','framework')
		),                
    )

);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function mom_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'mom_register_meta_boxes' );