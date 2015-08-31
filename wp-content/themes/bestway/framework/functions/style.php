<?php
add_action('wp_head', 'mom_custom_style', 150);
function mom_custom_style() {
    global $post;
    if (is_singular()) { 
    $layout = get_post_meta($post->ID, 'mom_page_layout', true);
    if ($layout == '') {$layout = mom_option('main_layout');}
    } else {
	$layout = mom_option('main_layout');
    }
    
    if(function_exists('is_woocommerce') && is_woocommerce()) {
		  $woo_page_id = '';
		  if (is_shop()) {
		      $woo_page_id = get_option('woocommerce_shop_page_id');
		  } elseif (is_cart()) {
		      $woo_page_id = get_option('woocommerce_cart_page_id');
		  } elseif (is_checkout()) {
		      $woo_page_id = get_option('woocommerce_checkout_page_id');
		  } elseif (is_account_page()) {
		      $woo_page_id = get_option('woocommerce_myaccount_page_id');
		  } else {
		      $woo_page_id = get_option('woocommerce_shop_page_id');
		  }
		  $layout = get_post_meta($woo_page_id, 'mom_page_layout', true);
		          if ($layout == '') {$layout = mom_option('main_layout');}

}
    ?>
    <style id="theme-dynamic-style">
<?php if(mom_option('Header_Padding')) { ?>
        #header .logo {
	    padding-top: <?php echo mom_option('Header_Padding', 'padding-top'); ?>;
	    padding-bottom: <?php echo mom_option('Header_Padding', 'padding-bottom'); ?>;
	}
<?php } ?>
<?php if(mom_option('header_background', 'background-image') != '') { ?>
	#header {
	    position: relative;
	}
	#header:before {
	    background: <?php echo mom_option('Image_Light', 'background'); ?>;
	    content: "/";
	    position: absolute;
	    height: 100%;
	    width: 100%;
	    opacity: 0.85;
	    z-index: 100;
	    top: 0;
	}
    <?php } ?>
<?php echo mom_option('custom_css'); ?>
    </style>
<?php

}