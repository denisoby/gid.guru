<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<?php if(mom_option('enable_responsive') != true) { ?>
	<meta name="viewport" content="user-scalable=yes, minimum-scale=0.25, maximum-scale=3.0" />
	<?php } else {  ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } ?>

<?php 
if (mom_option('mom_og_tags') == 1) {
if (is_singular()) { ?>
<meta property="og:image" content="<?php echo esc_url(mom_post_image('feature_slider_square')); ?>"/>
<meta property="og:image:width" content="330" /> 
<meta property="og:image:height" content="263" />
<?php
    $mom_og_title = get_the_title(); 
if (function_exists('is_buddypress') && is_buddypress()) {
    if ( bp_is_user() && !bp_is_register_page() ) {
			$mom_og_title = bp_get_displayed_user_fullname();
    } else {
	$mom_og_title = wp_title('', false);
    }
}
?>
<meta property="og:title" content="<?php echo esc_attr($mom_og_title); ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:description" content="<?php global $post; echo esc_attr(wp_html_excerpt(strip_shortcodes($post->post_content), 200)); ?>"/>
<meta property="og:url" content="<?php esc_url(the_permalink()); ?>"/>
<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo( 'name' )) ?>"/>
<?php }
} //end facebook og ?>


	<?php if ( mom_option('custom_favicon', 'url') != '') { ?>
	<link rel="shortcut icon" href="<?php echo esc_url(mom_option('custom_favicon', 'url')); ?>" />
	<?php } ?>
	<?php if ( mom_option('apple_touch_icon', 'url') != '') { ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(mom_option('apple_touch_icon', 'url')); ?>" />
	<?php } else { ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(MOM_URI); ?>/apple-touch-icon-precomposed.png" />
	<?php } ?>

	<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/framework/helpers/js/html5.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/framework/helpers/js/IE9.js"></script>
	<![endif]-->
	<!--[if gte IE 9]>
	    <style type="text/css">
	      .gradient {
		 filter: none;
	      }
	    </style>
	<![endif]-->
	<?php wp_head(); ?>
        <link rel="stylesheet" type="text/css" media="all" href="/wp-content/themes/bestway/custom.css">
    </head>
<body <?php body_class(); ?>>
    <?php do_action('mom_first_on_body'); ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<?php
	    $mom_header_style = mom_option('header_style');
	    if (isset($_GET['header_style'])) {
	    	$mom_header_style = $_GET['header_style'];
	    }
	?>
	<div class="search-overlay overlay-scale">
	    <div class="inner">
		<div class="search_box">
		    <span class="so-close"><i class="enotype-icon-cross"></i></span>
		    <form action="<?php echo esc_url(home_url()); ?>">
			<input type="text" value="" name="s" class="ov-sf sf" placeholder="<?php _e('Search here', 'theme'); ?>">
			    <?php if (function_exists('icl_get_languages')) { ?>
				<button type="submit" name="sb" class="sb subb" id="ssbt<?php echo esc_attr(ICL_LANGUAGE_CODE); ?>"></button>
			    <?php } else { ?>
				<button type="submit" name="sb" class="sb subb"></button>
			    <?php } ?>
		    </form>
		</div><!--End Search Box-->
	    </div>
	</div>
        <div class="wrap">
	    <?php if ($mom_header_style == 'header_top') { ?>
	    <div id="header-wrap">
		<?php get_template_part('top', 'bar'); ?>
		<header class="default_header">
		    <div class="inner">
			<?php echo mom_logo(); ?>
		    </div> <!--End Inner-->
		</header> <!--End Default Header-->
	    </div> <!--End Header Wrapper-->
	    <?php } else { ?>
	    <header id="header" class="header <?php echo esc_attr($mom_header_style); ?>" >
		<div id="header-wrapper" class="inner">
		    	<?php echo mom_logo(); ?>
		</div><!--End Inner-->
	   <?php get_template_part('navigation', 'menu'); ?>
	    </header><!--End Header-->
	    <?php } ?>