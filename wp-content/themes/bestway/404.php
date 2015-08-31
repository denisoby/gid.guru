<?php get_header(); ?>
	    <header class="header_page">
		<div class="inner">
		<span class="br_title"><?php _e('Search For:', 'theme'); ?></span>
		<h1 class="page_title main_title cpt"><?php _e('Page Not Found', 'theme'); ?></h1>
		</div>
	    </header>
	    <div class="inner">
		<div class="big_container">
		    <div class="big_main">
                        <div class="posts">
			    <div class="post_content page_style">
				<div class="page404">
				    <h1 class="h404">404</h1><h1><?php _e('Page Not Found', 'theme'); ?></h1><h1><?php _e('Please try searching other words', 'theme'); ?></h1>
				    <div class="search_box">
					<form action="<?php echo home_url(); ?>">
					    <input type="text" value="" name="s" class="sf" placeholder="<?php _e('Search here', 'theme'); ?>">
						<?php if (function_exists('icl_get_languages')) { ?>
						    <botton name="sb" class="sb subb" id="ssbt"<?php echo (ICL_LANGUAGE_CODE); ?>"/></botton>
						<?php } else { ?>
						    <botton name="sb" class="sb subb" /></botton>
						<?php } ?>
					</form>
				    </div><!--End Search Box-->
				</div>
                            </div>
                        </div>
		    </div><!--End main-->
		    <?php get_sidebar(); ?>
		    <div class="clear"></div>
		</div><!--End Container-->
	    </div><!--End Inner-->
<?php get_footer(); ?>