<?php
		    $topbar = mom_option('style_topbar');
		    if (isset($_GET['topbar'])) {
	    		$topbar = $_GET['topbar'];
	    	}
		    if ($topbar == 'topbar_light' || $topbar == 'light') {
					$class = 'topbar_light';
		    } else {
					$class = '';
		    }
?>
<div class="topbar <?php echo esc_attr($class); ?>">
		    <div class="inner">
			<div class="top-left-content">
		    <?php get_template_part('navigation', 'menu'); ?>
			</div> <!--End Top Left Content-->
			<div class="top-right-content">
			    <?php if(mom_option('tn_right_content') == 'custom') { ?>
				<?php echo do_shortcode(mom_option('tn_right_custom_text')); ?>
			    <?php } else { ?>
				<?php get_template_part('mom', 'social'); ?>
			    <?php } ?>
			</div> <!--Top Right Content -->
			<?php if(mom_option('top_search') == 1) { ?>
			<div class="search_box_top">
			    <form action="<?php echo esc_url(home_url()); ?>">
				<input type="text" value="" name="s" class="sf ov-sf" placeholder="<?php _e('Search here', 'theme'); ?>">
				    <?php if (function_exists('icl_get_languages')) { ?>
					<button type="submit" name="sb" class="sb subb" id="ssbt<?php echo(ICL_LANGUAGE_CODE); ?>"></button>
				    <?php } else { ?>
					<button type="submit" name="sb" class="sb subb hidden"></button>
				    <?php } ?>
				    <i class="search_icon"></i>
			    </form>
			</div><!--End Search Box-->
			<?php } ?>
		    </div> <!--End Inner-->
		</div> <!--End Top Bar-->