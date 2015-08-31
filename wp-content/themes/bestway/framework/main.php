<?php

/*------------------------------------------*/
/*	Theme constants
/*------------------------------------------*/

define ('MOM_URI' , get_template_directory_uri());
define ('MOM_DIR' , get_template_directory());
define ('MOM_JS' , MOM_URI . '/js');
define ('MOM_CSS' , MOM_URI . '/css');
define ('MOM_IMG' , MOM_URI . '/images');
define ('MOM_FW' , MOM_DIR . '/framework');
define ('MOM_PLUGINS', MOM_FW . '/plugins');
define ('MOM_FUN', MOM_FW . '/functions');
define ('MOM_WIDGETS', MOM_FW . '/widgets');
define ('MOM_SC', MOM_FW . '/shortcodes');
define ('MOM_TINYMCE', MOM_FW . '/tinymce');
define ('MOM_AJAX', MOM_FW . '/ajax');


//include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/*------------------------------------------*/
/*	Theme Translation
/*------------------------------------------*/
if (file_exists(get_stylesheet_directory().'/languages')) {
	load_theme_textdomain( 'theme', get_stylesheet_directory().'/languages' );
	load_theme_textdomain( 'framework', get_stylesheet_directory().'/languages' );

	 
	$locale = get_locale();
	$locale_file = get_stylesheet_directory()."/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);
} else {
	load_theme_textdomain( 'theme', get_template_directory().'/languages' );
	load_theme_textdomain( 'framework', get_template_directory().'/languages' );
	$locale = get_locale();
	$locale_file = get_stylesheet_directory()."/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);	
}

/*------------------------------------------*/
/*	Theme Plugins
/*------------------------------------------*/

if (is_admin()) {
require_once  MOM_FW . '/plugins.php';
}

/*------------------------------------------*/
/*	Theme Widgets
/*------------------------------------------*/
function mom_is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}
	if(!mom_is_edit_page()) {
	    foreach ( glob( MOM_WIDGETS . '/*.php' ) as $file )
		{
			require_once $file;
		}
		if (file_exists(MOM_FW. '/sidebars/sidebars.php')) {
			include MOM_FW. '/sidebars/sidebars.php';
		}
	}


/*------------------------------------------*/
/*	Theme Ajax
/*------------------------------------------*/
    foreach ( glob( MOM_AJAX . '/*.php' ) as $file )
	{
		require_once $file;
	}


if (is_admin()) {
if (file_exists(MOM_FW . '/demo/init.php')) {
require_once MOM_FW . '/demo/init.php';
}
}
/*------------------------------------------*/
/*	Theme TinyMCE
/*------------------------------------------*/
if (function_exists('tl_mom_shortcodes_plugin')) { 
    foreach ( glob( MOM_TINYMCE . '/*.php' ) as $file )
	{
		require_once $file;
	}

if (is_admin() && file_exists( MOM_FW . '/shortcodes/editor/shortcodes-ultimate.php')) {
	require_once MOM_FW . '/shortcodes/editor/shortcodes-ultimate.php';
	require_once MOM_FW . '/shortcodes/editor/shortcodes-init.php';
}


add_filter( 'mce_buttons', 'my_mce_buttons_1' );
function my_mce_buttons_1( $buttons ) {
    array_unshift( $buttons, 'fontsizeselect' );
    return $buttons;
}

function customize_text_sizes($initArray){
   $initArray['theme_advanced_font_sizes'] = "10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px,26px,27px,28px,29px,30px,32px,48px";
   return $initArray;
}

// Assigns customize_text_sizes() to "tiny_mce_before_init" filter
add_filter('tiny_mce_before_init', 'customize_text_sizes');

global $wp_version;
if ( $wp_version < 3.9 ) {
function register_momcols_dropdown( $buttons ) {
   array_push( $buttons, "momcols" );
   return $buttons;
}

function add_momcols_dropdown( $plugin_array ) {
   $plugin_array['momcols'] = get_template_directory_uri() . '/framework/shortcodes/js/cols.js';
   return $plugin_array;
}

function momcols_dropdown() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_momcols_dropdown' );
      add_filter( 'mce_buttons_2', 'register_momcols_dropdown' );
   }

}

add_action('admin_init', 'momcols_dropdown');

} else {

add_action('admin_head', 'mom_sc_cols_list');
function mom_sc_cols_list() {
    global $typenow;
    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
   	return;
    }
    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
	// check if WYSIWYG is enabled
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "mom_cols_add_tinymce_plugin");
		add_filter('mce_buttons', 'mom_cols_register_my_tc_button');
	}
}
function mom_cols_add_tinymce_plugin($plugin_array) {
   	$plugin_array['columns'] = MOM_URI . '/framework/shortcodes/js/cols-list.js';
   	return $plugin_array;
}
function mom_cols_register_my_tc_button($buttons) {
   array_push($buttons, 'columns');
   return $buttons;
}

}

}
/*------------------------------------------*/
/*	Theme Functions
/*------------------------------------------*/
    foreach ( glob( MOM_FUN . '/*.php' ) as $file )
	{
		require_once $file;
	}

        
/*------------------------------------------*/
/*	Theme Menus
/*------------------------------------------*/
if ( function_exists( 'register_nav_menu' ) ) {
  register_nav_menus(
   array(
    'main'   => __('Main Menu', 'framework'),
    'responsive'   => __('Responsive Menu', 'framework'),
   )
  );
 }

/*------------------------------------------*/
/*	Theme Support
/*------------------------------------------*/
// Adds RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );
add_theme_support('post-thumbnails');
add_theme_support( 'post-formats', array( 'quote', 'gallery', 'audio', 'video', 'image', 'aside','status', 'link', 'chat' ) );
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

/*------------------------------------------*/
/*	Mega menus
/*------------------------------------------*/
if ( file_exists( MOM_FW . '/menus/menu.php' ) ) {
	require_once( MOM_FW . '/menus/menu.php' );
}
		
/*------------------------------------------*/
/*	Theme Admin
/*------------------------------------------*/
if ( !class_exists( 'ReduxFramework' ) && file_exists( MOM_FW . '/options/redux/ReduxCore/framework.php' ) ) {
require_once( MOM_FW . '/options/redux/ReduxCore/framework.php' );
//require_once( MOM_FW . '/options/redux/sample/sample-config.php' );
}
if ( file_exists( MOM_FW . '/options/theme_options.php' ) ) {
require_once( MOM_FW . '/options/theme_options.php' );
}

function mom_option($option, $arr=null)
{
global $mom_options;
if($arr) {
if(isset($mom_options[$option])) {
	if (isset($mom_options[$option][$arr])) {
return $mom_options[$option][$arr];
	}
}
} else {
if(isset($mom_options[$option])) {
return $mom_options[$option];
}
}
}
/*------------------------------------------*/
/*	Theme Sidebars
/*------------------------------------------*/
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
	'name' => __('Main Sidebar', 'framewrok'),
        'id' => 'main-sidebar',
	'description' => __('Default sidebar.', 'theme'),
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));
register_sidebar(array(
	'name' => __('Photo Stream', 'framewrok'),
        'id' => 'instagram-widget',
	'description' => __('Instagram Widget.', 'theme'),
	'before_widget' => '<div class="images_feed_widget widget_instagram"><div class="widget in_image_feed %2$s">',
	'after_widget' => '</div></div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));
// footers
      register_sidebar(array(
	'name' => __('Footer 1', 'framewrok'),
        'id' => 'footer1',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => __('Footer 2', 'framewrok'),
        'id' => 'footer2',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => __('Footer 3', 'framewrok'),
        'id' => 'footer3',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => __('Footer 4', 'framewrok'),
        'id' => 'footer4',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => __('Footer 5', 'framewrok'),
        'id' => 'footer5',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => __('Footer 6', 'framewrok'),
        'id' => 'footer6',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));
 }
 
/*------------------------------------------*/
/*	Theme Metaboxes
/*------------------------------------------*/
require_once  MOM_FW . '/metaboxes/meta-box.php';
require_once  MOM_FW . '/metaboxes/theme.php';
include_once MOM_FW . '/metaboxes/momizat-class/MetaBox.php';
include_once MOM_FW . '/metaboxes/momizat-class/MediaAccess.php';

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('momizat-metabox', get_template_directory_uri() . '/framework/metaboxes/meta.css');
	wp_enqueue_script('momizat-metabox-js', get_template_directory_uri() . '/framework/metaboxes/meta.js');
}
$wpalchemy_media_access = new MomizatMB_MediaAccess();

include_once MOM_FW . '/metaboxes/posts-spec.php';
include_once MOM_FW . '/metaboxes/portfolio-spec.php';

// Portfolio columns
add_filter( 'manage_edit-portfolio_columns', 'add_type' );
function add_type($columns) {
    $columns['cat'] = 'Categories';
    $columns['type'] = 'Type';
    $columns['image'] = 'Feature Image';
    return $columns;
}

add_action( 'manage_posts_custom_column', 'art_type' );
function art_type($column) {
    global $post;
global $portfolio_st;
$settings = get_post_meta($post->ID, $portfolio_st->get_the_id(), TRUE);
$terms = get_the_terms( $post->ID, 'portfolio_category');

    switch($column) {
        case 'type' :
                echo '<span style="text-transform: capitalize;">'.$settings['type'].'</span>';
        break;
        case 'cat' :
			$terms = get_the_terms( $post->ID, 'portfolio_category' );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'portfolio_category' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'portfolio_category', 'display' ) )
					);
				}
				echo join( ', ', $out );
			}
			else {
				_e( 'No Categories', 'default' );
			}
	break;

        case 'image' :
                echo '<span style="padding:2px; padding-bottom:0; margin-bottom:2px; background:#fff; border:1px solid #DFDFDF; display:inline-block;">'.get_the_post_thumbnail($post->ID, array(100,60)).'</span>';
        break;
    }
}

/*------------------------------------------*/
/*	Theme Enhancments
/*------------------------------------------*/
//shortcodes in widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode', 11);


// ajax Action
add_action( 'wp_ajax_mom_loadIcon', 'mom_icon_container' );

function mom_google_fonts () {
$safe_fonts = array(
			'' => 'Default',
			'arial'=>'Arial',
			'georgia' =>'Georgia',
			'arial'=>'Arial',
			'verdana'=>'Verdana, Geneva',
			'trebuchet'=>'Trebuchet',
			'times'=>'Times New Roman',
			'tahoma'=>'Tahoma, Geneva',
			'palatino'=>'Palatino',
			'helvetica'=>'Helvetica',
			'play'=>'Play',
			);

return $safe_fonts;

}

/*------------------------------------------*/
/*	Ads system
/*------------------------------------------*/
if (function_exists('tl_mom_ads_post_type')) {
//Backend
include_once MOM_FW . '/ads/ads-spec.php';
include_once MOM_FW . '/ads/ads-widget.php';

//frontend
include_once MOM_FW . '/ads/ads-system.php';
}
/*------------------------------------------*/
/*	Woocommerce
/*------------------------------------------*/
if ( class_exists( 'woocommerce' ) ) {
	include_once MOM_FW . '/woocommerce/woocommerce.php';
}

/* ==========================================================================
 *                Modal Box
   ========================================================================== */
// Modal box Wrap
add_action( 'admin_head', 'mom_admin_modal_box' );
function mom_admin_modal_box() { ?>
	<div class="mom_modal_box">
		<div class="mom_modal_header"><h1><?php _e('Select Icon', 'theme'); ?></h1><a class="media-modal-close" id="mom_modal_close" href="#"><span class="media-modal-icon"></span></a></div>
		<div class="mom_modal_content"><span class="mom_modal_loading"></span></div>
		<div class="mom_modal_footer"><a class="mom_modal_save button-primary" href="#"><?php _e('Save', 'theme'); ?></a></div>
	</div>
	<div class="mom_media_box_overlay"></div>
<?php }
add_action( 'admin_enqueue_scripts', 'mom_admin_global_scripts' );
function mom_admin_global_scripts () {
//Load our custom javascript file
	$Lpage = '';
	if (isset($_GET['page']) && $_GET['page'] == 'codestyling-localization/codestyling-localization.php') {
		$Lpage = true;
	}
	if ($Lpage == false) {
		wp_enqueue_script( 'mom-admin-global-script', get_template_directory_uri() . '/framework/helpers/js/admin.js' );
		wp_localize_script( 'mom-admin-global-script', 'MomCats', array(
			'url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'ajax-nonce' ),
			)
		);
	}
    
}
// ajax Action
add_action( 'wp_ajax_mom_loadIcon', 'mom_icon_container' );


/* ==========================================================================
 *                Allow SVG in media uploader 
   ========================================================================== */
function mom_custom_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'mom_custom_mime_types' );

/* ==========================================================================
 *                Default Media Image Resize
   ========================================================================== */
function mom_media_image_dimensions() {
global $pagenow;
if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
return;
}

//Thumbnail image sizes
update_option('thumbnail_size_w', 70);
update_option('thumbnail_size_h', 70);
update_option('thumbnail_crop', 1);

//Medium image sizes
update_option('medium_size_w', 300);
update_option('medium_size_h', 300);
update_option('medium_crop', 0);

//Large image sizes
update_option('large_size_w', 1000);
update_option('large_size_h', 639);
update_option('large_crop', 1);

}
 
add_action( 'after_switch_theme', 'mom_media_image_dimensions', 1 );

if ( ! isset( $content_width ) ) {

    $content_width = 1000;

}