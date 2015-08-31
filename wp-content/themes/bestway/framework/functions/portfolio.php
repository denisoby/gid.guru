<?php
function mom_portfolio_items () {
    $rndn = rand(1, 100);
    global $post;
    
    $layout = mom_option('portfolio_cols');
    if ($layout == false) {
	$layout = 3;
    }
    $pt_class = 'three_col';
    $img_size = 'portfolio_thumb';
    switch ($layout) {
	case '2' :
	    $pt_class = 'tow_col';
	    $img_size = 'portfolio_thumb2';
	break; 
	case '4' :
	    $pt_class = 'four_col';
	    $img_size = 'portfolio_thumb4';
	break; 
    }
    $posts_count = mom_option('portfolio_count');
    if ($posts_count == false) {
	$posts_count = 9;
    }

    $pt_nav = mom_option('portfolio_nav');
    
    if ($pt_nav == false) {
	$pt_nav = 'both';
    }
     
    if ($pt_nav == 'filter') {
	$posts_count = -1;
    }
    
    ?>

	<div class="page_head">
    <?php if ($pt_nav == 'both' || $pt_nav == 'filter') { ?>
	<?php
            wp_enqueue_script('easing');
        ?>
	    <div class="protfolio_filter pt_filtern_<?php echo esc_attr($rndn); ?>">
		<ul>
		    <li class="all current"><a href="#" data-filter="*"><?php _e('All', 'framework'); ?></a></li>
		    <?php 
			    $portCats = get_terms("portfolio_category");
			    $count = count($portCats);
			    if ( $count > 0 ){
				    foreach ( $portCats as $portCat ) {
						    echo '<li><a href="#"  data-filter=".'.esc_attr($portCat->slug).'">' . $portCat->name . '</a></li>';
			    }
			    }
		    ?>
		</ul>
	    </div> <!--porfolio terms-->
	    <?php } ?>
	</div><!--End Page Head-->

	<div class="portfolio_style">
	    <ul class="portfolio_list <?php echo esc_attr($pt_class);?> portfolion_<?php echo esc_attr($rndn); ?>">
		    <?php
		    global $paged;
			    $args = array(
			    'posts_per_page' => $posts_count,
			    'post_type' => 'portfolio',
			    'paged' => $paged 
			    );
	    $query = new WP_Query( $args );
	    ?>
	    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
	    <?php
		    global $portfolio_mb;
		    global $portfolio_st;
		    $meta = get_post_meta(get_the_ID(), $portfolio_mb->get_the_id(), TRUE);
		    $settings = get_post_meta(get_the_ID(), $portfolio_st->get_the_id(), TRUE);
			    $taxonomy = 'portfolio_category';
			    $terms = get_the_terms( $post->ID, $taxonomy);
	    ?>
	    
		    <li class="<?php
			    if (! empty($terms)) {
			    foreach ($terms as $term ) {
			    echo esc_attr($term->slug).' ';
			    }
			    }
			    ?>">
			    <div class="portfolio_image">
				<div class="pt_ov_content">
				    <div class="pt_overlay">
					<div class="pt_all_overlay">
					    <div class="pt_ov_icons">
							<a class="pt_ov_link" href="<?php the_permalink(); ?>"><i class="momizat-icon-link"></i></a>
							<a class="pt_ov_zoom" href="<?php echo esc_url(mom_post_image('full')); ?>" rel="prettyPhoto[gall]"><i class="fa-search"></i></a>
						    </div>
					    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
				    </div>
				    <?php
					    $thumb = mom_post_image($img_size); 
					    $thumb_HD = mom_post_image('portfolio_thumb_HD'); 
				    ?>
				    <img src="<?php echo esc_attr($thumb); ?>" data-hidpi="<?php echo esc_attr($thumb_HD); ?>" alt="<?php the_title(); ?>">
				</div>
			    </div>
		    </li>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.', 'theme'); ?></p>
		<?php endif; ?>
	    </ul>
	    <div class="clear"></div>
	<?php if ($pt_nav == 'both' || $pt_nav == 'pagination') { ?>
	    <?php mom_pagination($query->max_num_pages); ?>
	<?php } ?>
	    <?php wp_reset_postdata(); ?>
	    <div class="clear"></div>
	</div>
<?php 
}
// portfolio Single

function mom_related_projects () {
?>

	<div class="clear"></div>
	<div class="pt_related_pro">
        <h2 class="related_pro_title"><?php _e('Related Projects', 'theme'); ?></h2>


		<div class="pt_related_items mom_portfolio">
                    <?php if (mom_option('theme_layout') == 'full') { $rc = 3; } else { $rc = 3; } ?>
                <?php global $post;  $cat = wp_get_post_terms($post->ID, 'portfolio_category', array("fields" => "ids")); ?>
		<div class="pt_items">
		<ul class="portfolio_list three_col">
			<?php
				$args = array(
				'posts_per_page' => $rc,
				'post_type' => 'portfolio',
				'post__not_in' => array($post->ID),
	    'tax_query' => array(
		array(
			'taxonomy' => 'portfolio_category',
			'field' => 'id',
			'terms' => $cat,
			'operator' => 'IN'
		)
	)
				);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                			<li>
					    <div class="portfolio_image">
						<div class="pt_ov_content">
						    <div class="pt_overlay">
							<div class="pt_all_overlay">
							    <div class="pt_ov_icons">
									<a class="pt_ov_link" href="<?php the_permalink(); ?>"><i class="momizat-icon-link"></i></a>
									<a class="pt_ov_zoom" href="<?php echo esc_url(mom_post_image('full')); ?>" rel="prettyPhoto[gall_<?php the_ID(); ?>]"><i class="fa-search"></i></a>
								    </div>
							    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
						    </div>
						    <?php
								$fImage = mom_post_image('portfolio_thumb3');
						    ?>
						    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($fImage); ?>" alt="<?php the_title(); ?>">
						    
						    </a>
						</div>
					    </div>
					</li>
					
                
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.', 'theme'); ?></p>
<?php endif; ?>
		</ul>
		</div>
		<div class="clear"></div>
<?php wp_reset_postdata(); ?>
	</div>
	</div>
<?php
}