<?php
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
    //Page settings
    $pc = get_post_meta($woo_page_id, 'mom_page_comments', true);
    //Page Layout
    $custom_page = get_post_meta($woo_page_id, 'mom_custom_page', true);
    $layout = get_post_meta($woo_page_id, 'mom_page_layout', true);
    $custom_sidebar = get_post_meta($woo_page_id, 'mom_custom_sidebar', true);
?>

<?php get_header(); ?>
	    <div class="inner">
		<div class="big_container">
		    <div class="big_main">
			<div class="shop-page-title">
			    <h1><?php woocommerce_page_title(); ?></h1>
			    <div class="mom-select woocommerce-sortby">
				<?php do_action('mom_woo_page_title'); ?>
			    </div>
			    <div class="shop-style-switcher">
				<a href="#" id="grid" class="layout-grid active"><i class="brankic-icon-grid2"></i></a><a href="#" id="list" class="layout-list"><i class="brankic-icon-list2"></i></a>
			    </div>
			</div>
			<?php if ($custom_page) { ?>
			<?php woocommerce_content(); ?>
			<?php } else { ?>
<div class="shop_wrap">
<?php
    if ($pc == true) {$pc_class=' page_has_comments';} else {$pc_class = '';}
?>
    <div class="page_content<?php echo esc_attr($pc_class); ?> entry_content">
			<?php woocommerce_content(); ?>
    </div>
    <?php
    if ($pc == true) {comments_template();}
    ?>
    </div>
    <?php } ?>
    <div class="clear"></div>
		    </div><!--End main-->
		    <?php get_sidebar(); ?>
		    <div class="clear"></div>
		</div><!--End Container-->
	    </div><!--End Inner-->
<?php get_footer(); ?>