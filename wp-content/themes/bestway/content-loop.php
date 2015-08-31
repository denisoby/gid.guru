<?php 

$count = 0; 
$posts_layout = mom_posts_layout();
if (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] != '' ) {
	query_posts(array( 
			'posts_per_page' => $_GET['posts_per_page']
	));
} 
if ( have_posts() ) : ?>
	<?php if ($posts_layout == 'grid') { 
		$columns = mom_grid_columns();
		?>
		<div id="item_mas" style="overflow: hidden;"><ul id="mas_container" class="posts-grid pg-coloumns-<?php echo esc_attr($columns); ?> js-masonry clearfix">
	<?php } ?>
<?php while ( have_posts() ) : the_post(); ?>
        <?php 
        	if ($posts_layout == 'grid') { 
        		mom_grid_content();$count++; 
        	} else {
        		get_template_part('content', get_post_format()); $count++; 
        	}
        ?>
<?php endwhile; ?>
	<?php if ($posts_layout == 'grid') { ?>
			</ul>
		</div>
	<?php } ?>
			<?php  
			$pagination = mom_option('pagination_type');
			if (isset($_GET['pagination'])) {
					$pagination = $_GET['pagination'];
			} 


			if ($pagination == 'ajax' || $pagination == 'scroll') {
			    $cat = '';
			    $tag = '';
			    $format = '';
			    $m = '';
			    if (is_archive()) {
				if (get_query_var('m') != '') {
				    $m = get_query_var('m');
				}
			    if (is_category()) {
				$cat = get_query_var('cat');
			    }
			    if (is_tag()) {
				$tag = get_query_var('tag');
			    }
			    if ( get_query_var('post_format') != '') {
				$format = get_query_var('post_format');
			    }
			    }

				if (get_option('posts_per_page') <= $count ) { ?>
				<?php if($pagination == 'ajax'){ ?>
			    <div style="text-align: center;"><a href="#" class="button more-posts" data-m="<?php echo esc_attr($m); ?>" data-format="<?php echo esc_attr($format); ?>" data-cat="<?php echo esc_attr($cat); ?>" data-tag="<?php echo esc_attr($tag); ?>" data-offset="<?php echo get_option('posts_per_page'); ?>" data-number_of_posts="<?php echo get_option('posts_per_page'); ?>"><?php _e('Older Posts', 'theme'); ?></a><div class="ajax-loading hide"></div></div>
			    <?php } ?>
				<?php if($pagination == 'scroll'){ ?>
			    <div style="text-align: center;"><a href="#" style="opacity:0;" class="button more-posts" data-m="<?php echo esc_attr($m); ?>" data-format="<?php echo esc_attr($format); ?>" data-cat="<?php echo esc_attr($cat); ?>" data-tag="<?php echo esc_attr($tag); ?>" data-offset="<?php echo get_option('posts_per_page'); ?>" data-number_of_posts="<?php echo get_option('posts_per_page'); ?>"><?php _e('Older Posts', 'theme'); ?></a><div class="ajax-loading hide"></div></div>
			    <?php } ?>
			<?php }
			} elseif ($pagination == 'pagination') { ?>
			    <?php mom_pagination(); ?>
			<?php } else { ?>
			    <div class="posts_pagination">
				<span class="older_posts"><?php next_posts_link(__('Older Posts', 'theme')); ?></span>
				<span class="newer_posts"><?php previous_posts_link(__('Newer Posts', 'theme')); ?></span>
			    </div>
			<?php }  ?>
<?php else: ?>
<div class="post_style">
    <div class="post_content">
<p><?php _e('Sorry, no posts matched your criteria, please try again with different keywords', 'theme'); ?></p>
<?php if(is_search()) { get_search_form(); } ?>
</div>
</div>
<?php endif; ?>