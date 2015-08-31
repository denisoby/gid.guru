<header class="header_page">
    <div class="inner">
	<?php
	    if (is_category()) {
		echo '<span class="br_title">'. __('Browsing Category', 'theme').'</span><h1 class="page_title cpt">'.single_cat_title('', false).'</h1>';
	    } elseif (is_tag()) {
		echo '<span class="br_title">'. __('Browsing Tag', 'theme').'</span><h1 class="page_title cpt">'.single_cat_title('', false).'</h1>';
	    } elseif (is_author()) {
		echo '<span class="br_title">'. __('Browsing Author', 'theme').'</span><h1 class="page_title cpt">'.single_cat_title('', false).' '. __('Admin', 'theme').'</h1>';
	    } else {
		echo '<span class="br_title">'. __('Browsing Archive', 'theme').'</span><h1 class="page_title cpt">'.__('Archives', 'theme').'</h1>';
	    }
	?>
    </div>
</header>
	    <div class="inner">
		<div class="big_container ptl">
		    <div class="big_main">
			<div class="posts">
			    <?php get_template_part('content','loop'); ?>
			</div><!--End Posts-->
			    <div class="clear"></div>
		    </div><!--End main-->
		    <?php get_sidebar(); ?>
		    <div class="clear"></div>
		</div><!--End Container-->
	    </div><!--End Inner-->