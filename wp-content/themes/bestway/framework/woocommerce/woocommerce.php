<?php
if ( class_exists( 'woocommerce' ) ) {
add_theme_support( 'woocommerce' );
add_image_size('mom-woo-product', 450, 450, true);

/* ==========================================================================
 *                Custom woocommerece styles/scripts
   ========================================================================== */

add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style');
function wp_enqueue_woocommerce_style(){
wp_register_style( 'woocommerce', get_template_directory_uri() . '/framework/woocommerce/woocommerce.css' );
wp_register_style( 'woocommerce-responsive', get_template_directory_uri() . '/framework/woocommerce/woocommerce-media.css' );
wp_register_script( 'woocommerce-js', get_template_directory_uri() . '/framework/woocommerce/woocommerce.js' );
	wp_enqueue_style( 'woocommerce' );
	wp_enqueue_script( 'prettyphoto' );
	wp_enqueue_script( 'woocommerce-js' );
	if(mom_option('enable_responsive') != false) {
	    wp_enqueue_style('woocommerce-responsive');
	}
wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
wp_dequeue_script( 'prettyPhoto-init' ); // in my js
}


// Remove woocommerce defauly styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


/*----------------------------
    remove woo defaults
 ----------------------------*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); /*remove result count above products*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); /*remove woocommerce ordering dropdown*/


/*----------------------------
    Add my owns
 ----------------------------*/
//add_action( 'woocommerce_before_shop_loop', 'momizat_cusotm_ordering_p1', 10 );
//add_action( 'woocommerce_before_shop_loop', 'momizat_cusotm_ordering_p2', 30 );
add_action( 'mom_woo_page_title', 'woocommerce_catalog_ordering', 30 );

/*----------------------------
    Remove from the product
 ----------------------------*/
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
//remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); //remove woo pagination
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/*----------------------------
    add to product
 ----------------------------*/
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10);
add_action( 'woocommerce_before_shop_loop_item', 'mom_shop_thumbnail', 10);
add_action( 'momizat_woo_product_head', 'woocommerce_template_loop_add_to_cart', 10);
//add_action( 'momizat_woo_product_details', 'woocommerce_template_loop_add_to_cart', 20);
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_rating', 5 ); //remove rating
add_action( 'momizat_woo_product_details', 'mom_product_desc', 15);



/* ==========================================================================
 *                Functions Start Here
   ========================================================================== */

// hide default shop title
add_filter('woocommerce_show_page_title', 'override_page_title');
function override_page_title() {
return false;
}
//custom order
function momizat_cusotm_ordering_p1() {
    $output = '<div class="mom-select woocommerce-sortby">';
   echo balanceTags($output);
}
function momizat_cusotm_ordering_p2() {
    $output = '</div>';
    echo balanceTags($output);
}

//thumbnail
function mom_shop_thumbnail () {
global $product;
	$rating = $product->get_rating_html(); //get rating
	    global $woocommerce;
	    $cart_url = $woocommerce->cart->get_cart_url();

	$id = get_the_ID();
	$size = 'mom-woo-product';

	$output = "<div class='mom_product_thumbnail'><div class='overlay'></div>";
	$output .= get_the_post_thumbnail( $id , $size );
	$output .= mom_add_to_cart_button();
	if($product->product_type == 'simple') $output .= "<a href='esc_url($cart_url)' class='mom_cart_loading mom_added_check'></a>";
	$output .= "</div>";
	echo balanceTags($output);
}
//prducts per row
add_filter('loop_shop_columns', 'mom_loop_columns');
if (!function_exists('loop_columns')) {
function mom_loop_columns() {
   $cols = mom_option('shop_products_columns');
    if (empty($cols)) {
	$cols = 3;
    }
return $cols; 
}
}


//add to cart button
function mom_add_to_cart_button()
{
	global $product;

	if ($product->product_type == 'bundle' ){
		$product = new WC_Product_Bundle($product->id);
	}

	$btclass  = "";
	$output = '';

	ob_start();
	woocommerce_template_loop_add_to_cart();
	$output .= ob_get_clean();

	if(!empty($output))
	{
		$pos = strpos($output, ">");
		
		if ($pos !== false) {
		    $output = substr_replace($output,">", $pos , strlen(1));
		}
	}
	

	if($product->product_type == 'variable' && empty($output))
	{
		$output = "<a class='mom_woo_bt button' href='".get_permalink($product->id)."'>".__('Select options','theme')."</a>";
	}

	if($product->product_type == 'simple')
	{
		$output .= "<a class='mom_woo_bt show_details_button button' href='".get_permalink($product->id)."'>".__('Details','framework')."</a>";
	}
	else
	{
		$btclass  = "single_bt";
	}
	 

	
	if($output) return "<div class='mom_woo_cart_bt $btclass'>$output</div>";
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'mom_related_products', 20);
function mom_related_products()
{
    woocommerce_related_products( array('posts_per_page' => 4));
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
add_action( 'woocommerce_after_single_product_summary', 'mom_upsells_products', 19);
function mom_upsells_products()
{
    woocommerce_upsell_display(4,4);
}
//products per page
$pcount = mom_option('woo_products_per_page');
if ($pcount == '') {
$pcount = 9;
}
add_filter( 'loop_shop_per_page', create_function( '$cols', 'global $pcount; return $pcount;' ), 20 );
//breadcrumb
add_filter( 'woocommerce_breadcrumb_defaults', 'mom_change_breadcrumb_delimiter' );
function mom_change_breadcrumb_delimiter( $defaults ) {
// Change the breadcrumb delimeter from '/' to '>'
$defaults['delimiter'] = '<i class="sep fa-double-angle-right"></i>';
if (is_rtl()) {
$defaults['delimiter'] = '<i class="sep fa-double-angle-left"></i>';
}
return $defaults;
}
//pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
function mom_woo_pagination() {
		mom_pagination(); 		
	}
add_action( 'woocommerce_after_shop_loop', 'mom_woo_pagination', 10);


/* ==========================================================================
 *                Single Product
   ========================================================================== */
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

//add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_price', 10);

/* ==========================================================================
 *               functions
   ========================================================================== */

function mom_is_woocommerce_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}
function mom_product_desc()
{
	global $post;
        echo '<p class="product_desc">'.wp_html_excerpt(get_the_content(), 300).'</p>';
}

// search form 
function mom_get_product_search_form() {
        ob_start(); 
   ?>
<div class="search_box">
<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<input type="text" class="search-field sf" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
            <?php if (function_exists('icl_get_languages')) { ?>
                <button type="submit" name="sb" class="sb subb" id="ssbt<?php echo(ICL_LANGUAGE_CODE); ?>"></button>
            <?php } else { ?>
                <button type="submit" name="sb" class="sb subb"></button>
            <?php } ?>
	<input type="hidden" name="post_type" value="product" />
</form>
</div>
<?php 
      $output = ob_get_contents();
      ob_get_clean();
      return $output;
   }
   add_filter('get_product_search_form', 'mom_get_product_search_form');

} // is woocommerce activated