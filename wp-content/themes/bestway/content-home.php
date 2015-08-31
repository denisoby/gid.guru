<?php 

	//Slider options
	$show = mom_option('slider_show'); // Show / hide feature slider
	$type = mom_option('slider_type'); 
	$slides_hint = mom_option('feature_slider_boxed'); 
	$display = mom_option('slider_display');
	$category = mom_option('slider_category');
	$exclude_categories = mom_option('slider_exclude_categories');
	$class = mom_option('slider_class');
	$tag = mom_option('slider_tag');
	$specific_posts = mom_option('slider_specific_posts');
	$format = mom_option('slider_format');
	$orderby = mom_option('slider_orderby');
	$sort = mom_option('slider_sort');
	$count = mom_option('slider_count');
	$post_type = mom_option('slider_post_type');
	if (isset($_GET['slider'])) {
		$type = $_GET['slider'];
	}

	if (isset($_GET['count'])) {
		$count = $_GET['count'];
	}
	
	if (isset($_GET['slides_hint'])) {
		$slides_hint = $_GET['slides_hint'];
	}
	if ($slides_hint == 1) {
		$slides_hint = 'yes';
	}

?>
		<?php if($show == 1) { ?>
		    <?php if (is_home()){ ?>
			    <?php  echo do_shortcode('[feature_slider type="'.$type.'" slides_hint="'.$slides_hint.'" display="'.$display.'" category="'.$category.'" exclude_categories="'.$exclude_categories.'" class="'.$class.'" tag="'.$tag.'" specific_posts="'.$specific_posts.'" format="'.$format.'" orderby="'.$orderby.'" sort="'.$sort.'" count="'.$count.'" post_type="'.$post_type.'"]'); ?>
		    <?php } ?>
		<?php } ?>
		
			<?php if (is_search()) {
			    echo '<header class="header_page">
		    		<div class="inner"><span class="br_title">'.__('Search for:', 'theme').'</span><h1 class="page_title main_title cpt">"'.esc_html($s).'"</h1></div>
				</header>';
			} ?>
		    
	    <div class="inner">
		<div class="big_container">
		    <div class="big_main">
			<div class="posts">
			    <?php get_template_part('content','loop'); ?>
			    <div class="clear"></div>
			</div><!--End Posts-->
			<div class="clear"></div>
		    </div><!--End main-->
		    <?php get_sidebar(); ?>
		    <div class="clear"></div>
		</div><!--End Container-->
	    </div><!--End Inner-->