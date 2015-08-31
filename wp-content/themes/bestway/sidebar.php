<?php
$layout = mom_page_layout();
$custom_sidebar = '';
if ($layout != 'full') { ?>
		    <div id="sidebar" class="sidebar">
			<?php if (is_single() || is_page() ) {
			    global $post;
			    
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
				    $custom_sidebar = get_post_meta($woo_page_id, 'mom_right_sidebar', TRUE);
				      
			    } else {
			    $custom_sidebar = get_post_meta($post->ID, 'mom_right_sidebar', TRUE);
			    
	    }
			} elseif(function_exists('is_woocommerce') && is_woocommerce()) {
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
		  $custom_sidebar = get_post_meta($woo_page_id, 'mom_right_sidebar', TRUE);
		    
	    } elseif (is_category()) {
      		$sidebar = get_option("category_".get_query_var('cat'));
      		$custom_sidebar = isset($sidebar['sidebar']) ? $sidebar['sidebar'] :'';
		    
	    }

	    if (isset($_GET['sidebar'])) {
				$custom_sidebar = $_GET['sidebar'];
		}
	    if (!empty($custom_sidebar)) {
			if ( is_active_sidebar( $custom_sidebar ) ) {
					  dynamic_sidebar($custom_sidebar);	
			}	    
		} else {
			if ( is_active_sidebar( 'main-sidebar' ) ) {
				  dynamic_sidebar( 'main-sidebar' );
			}
		}

			?>
		    </div><!--End SideBar-->
<?php } ?>