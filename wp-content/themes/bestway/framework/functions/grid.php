<?php

function mom_share_post_outside () {
    $url = esc_url(get_permalink());
    $desc = esc_js(wp_html_excerpt(strip_shortcodes(get_the_content()), 160));
    $img = esc_url(mom_post_image('medium'));
    $title = esc_attr(get_the_title());
    $window_title = __('Share This', 'theme');
    $window_width = 600;
    $window_height = 455;
    ?>
    					<span class="grid_share"  title="<?php _e('Share this', 'theme'); ?>"><i class="share-icon momizat-icon-share2"></i></span>
					<div class="share-wrap">
						<a href="#" onclick="window.open('http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $url; ?>', '<?php _e('Post this On twitter', 'theme'); ?>', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');"><i class="fa-twitter"></i></a>
						<a href="#" onclick="window.open('http://www.facebook.com/sharer/sharer.php?m2w&s=100&p&#91;url&#93;=<?php echo $url; ?>&p&#91;images&#93;&#91;0&#93;=<?php echo $img; ?>&p&#91;title&#93;=<?php $title; ?>&p&#91;summary&#93;=<?php echo $desc; ?>', '<?php echo $window_title; ?>', 'menubar=no,toolbar=no,resizable=no,scrollbars=no, width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');"><i class="fa-facebook"></i></a>
						<a href="https://plus.google.com/share?url=<?php echo $url;?>"
onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false"><i class="fa-google-plus"></i></a>
						<a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $img;?>&amp;
url=<?php echo $url;?>&amp;
is_video=false&amp;description=<?php echo $title;?>"
onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false;"><i class="fa-pinterest"></i></a>
						<a href="mailto:?subject=<?php print(urlencode(the_title())); ?>&body=<?php print(urlencode(wp_html_excerpt(get_the_content(), 160))); ?><?php __('Read More', 'framework'); ?> : <?php echo $url; ?>" class="share-email"><i class="fa-envelope-o"></i></a>
					</div>
<?php 
}
function mom_grid_meta() { 

	?>
			<div class="pg-meta entry-meta">
				<div class="meta">
					<span class="author" itemprop="author"><?php _e('by: ', 'theme') ?><?php the_author_posts_link(); ?></span>
					<span class="time" itemprop="startDate"><?php _e('on: ', 'theme') ?><?php echo mom_date_format(); ?></span>
				</div>
				<?php mom_share_post_outside(); ?>
			</div>
<?php }


function mom_elements_blog_grid_posts($atts, $content) {
	extract(shortcode_atts(array(
	'columns' => '3',
	'display' => '',
	'category' => '',
	'tag' => '',
	'format' => '',
	'orderby' => 'date', // recent, popular, random
	'sort' => 'DESC', //DESC & ASC
	'count' => 9,
	'excerpt_length' => '0',
	'pagination' => 'yes',
	'pagination_type' => '', // default, ajax, infinite scroll
	'load_more_count' => '', //default is columns 
	), $atts));
	ob_start();
	$sm_format = $format;
	//orderby 
	if ($orderby == 'popular') {
		$orderby = 'comment_count';	
	} elseif ($orderby == 'random') {
		$orderby = 'rand';
	} else {
		$orderby = 'date';
	}
	//post format
	if ($format != '') {
		$format = explode(',',$format);
		$formats = array ();
		foreach ($format as $f) {
			$formats[] = 'post-format-'.$f;
		}
		$format = array(
				array(
				    'taxonomy' => 'post_format',
				    'field' => 'slug',
				    'terms' => $formats,
				    'operator' => 'IN'
				)
			);
	}
	if ($load_more_count == '') {
		$load_more_count = $columns;
	}
	?>
<div id="item_mas" style="overflow: hidden;">
<ul id="mas_container" class="posts-grid pg-coloumns-<?php echo $columns; ?> clearfix">
		<?php
		global $paged;
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format,
			'paged' => $paged,
			'cache_results' => false
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count,
			'tag' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format,
			'paged' => $paged,
			'cache_results' => false
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count,
				'orderby' => $orderby,
				'order' => $sort,
				'tax_query' => $format,
				'paged' => $paged,
				'cache_results' => false
			); 
		}

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); 
			mom_grid_content();
		endwhile; ?>
		<?php else: ?>
		<?php endif; ?>
</ul>
	
	</div>	
		<?php if ($pagination == 'yes' && $pagination_type == '') { mom_pagination($query->max_num_pages); } ?>
		<?php if (($pagination == 'yes' && $pagination_type == 'ajax') || ($pagination == 'yes' && $pagination_type == 'scroll')) { ?>
		<div style="text-align: center;">
			<a href="#" class="button load-more-posts pagination-type-<?php echo esc_attr($pagination_type); ?>" data-count="<?php echo esc_attr($count); ?>" data-offset="<?php echo esc_attr($count); ?>" data-display="<?php echo esc_attr($display); ?>" data-category="<?php echo esc_attr($category); ?>" data-tag="<?php echo esc_attr($tag); ?>" data-sort="<?php echo esc_attr($sort); ?>" data-orderby="<?php echo esc_attr($orderby); ?>" data-format="<?php echo esc_attr($sm_format); ?>" data-excerpt_length="<?php echo esc_attr($excerpt_length); ?>" data-load_more_count="<?php echo esc_attr($load_more_count); ?>"><?php _e('Load More Posts','theme'); ?></a>
			    <div class="ajax-loading hide"></div>
		</div>

		<?php } ?>
		<?php wp_reset_postdata(); ?>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('posts_grid', 'mom_elements_blog_grid_posts');

function mom_grid_content() {
				$format = get_post_format();
				$extra_class = '';

		$category = get_the_category(); 
		if($category[0]){
			$cat_link = '<span class="grid_cat_link"><a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a></span>'; 
		} 

			if ($format == 'aside') {
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['aside_type'])) { $aside_type = $extra['aside_type']; } else {$aside_type = '';}
				if($aside_type != 'code') {
					$extra_class = 'note_inside';
				}

			}
			if ($format == 'status') {
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['status_type'])) { $status_type = $extra['status_type']; } else {$status_type = '';}
				if($status_type != 'code') {
					$extra_class = 'note_inside';
				}

			}
		?>
		<li <?php post_class('post-grid '.$extra_class) ?>>
		<div class="pg-container">
			<?php if ($format == 'quote') { ?>
				
				<div class="pg-content">
                                        <div class="entry-content">
                                            <?php mom_get_content(); ?>
                                            <a href="<?php global $post; echo esc_url(get_post_meta($post->ID, '_format_quote_source_url', true)); ?>"><?php echo esc_html(get_post_meta($post->ID, '_format_quote_source_name', true)); ?></a>
                                        </div><!--End Content-->
				</div>


			<?php } elseif ($format == 'link') { ?>

				<?php
				    $link_url = get_post_meta(get_the_ID(), '_format_link_url', true);
				?>
				<div class="pg-content">
                                    		<?php echo $cat_link; ?>
                                    <h2 class="entry-title post_title"><a href="<?php echo $link_url; ?>" target="_blank"><?php the_title(); ?></a></h2>
				    <span class="post_format"></span>
				</div>

			<?php } elseif ($format == 'aside') { 
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['aside_embed'])) { $aside_embed = $extra['aside_embed']; } else {$aside_embed = '';}				
			?>
			
			<?php if ($aside_embed != '') { ?>
				<?php
					$bg = '';
					if (has_post_thumbnail( get_the_id() )) {
					    $bg = 'background-image:url('.mom_post_image('post_large_image').');';
					}
				    ?>
					<div class="pg_head">
                                    <div class="aside_frame" style="<?php echo esc_attr($bg); ?>">
					<div class="aside_frame_inner">
                                           <?php
                                           echo balanceTags($aside_embed);
                                           ?>
					</div>
						</div><!-- End aside_frame-->
					</div> <!--pg head-->
					<div class="pg-content">
								<?php echo $cat_link; ?>
						<h2 class="entry-title post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<?php mom_grid_meta(); ?>
				    <?php } else { ?>
					<div class="format-note note_wrap">
					<?php mom_butterfly_post_title(); ?>
					    <div class="note">
						    <?php
						    the_content();
						    ?>
					    </div>
					    
					</div>
				    <?php } ?>
                        <?php } elseif ($format == 'status') { 
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['status_embed'])) { $status_embed = $extra['status_embed']; } else {$status_embed = '';}				
			?>
			
			<?php if ($status_embed != '') { ?>
				<?php
					$bg = '';
					if (has_post_thumbnail( get_the_id() )) {
					    $bg = 'background-image:url('.mom_post_image('post_large_image').');';
					}
				    ?>
					<div class="pg_head">
						<div class="status_frame" style="<?php echo esc_attr($bg); ?>">
							<div class="status_frame_inner">
							   <?php
							   echo balanceTags($status_embed);
							   ?>
							</div>
						</div><!-- End status_frame-->
					</div> <!--pg head-->
					<div class="pg-content">
								<?php echo $cat_link; ?>
						<h2 class="entry-title post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<?php mom_grid_meta(); ?>
				    <?php } else { ?>
					<div class="format-note note_wrap">
					<?php mom_butterfly_post_title(); ?>
					    <div class="note">
					    	<?php the_content(); ?>
					    </div>
					    
					</div>
				    <?php } ?>
			<?php } else { ?>
			<div class="pg-head">
				<?php mom_pg_post_head(); ?>
			</div>
			<div class="pg-content">
						<?php echo $cat_link; ?>
				<h2 class="entry-title post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<?php mom_grid_meta(); ?>
			<?php } ?>

			</div>
		</li>
<?php 
}
function mom_pg_post_head () {
	$image_size = 'post_large_image';

	global $post;
	$format = get_post_format();
	if ($format == 'video')	{ ?>
                                    <div class="video_frame">
                                           <?php echo do_shortcode(get_post_meta(get_the_ID(), '_format_video_embed', true)); ?>
                                    </div><!--End Vido_frame-->
	<?php } elseif ($format == 'audio') {	?>
			<?php if (mom_post_image() != false) { ?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($image_size); ?>" alt="<?php the_title(); ?>"></a>
			<?php } ?>
                                   <div class="audio_frame">
                                            <?php if(mom_post_image() != false) {
                                                butterfly_post_image();    
                                            } ?>
                                           <?php echo do_shortcode(get_post_meta(get_the_ID(), '_format_audio_embed', true)); ?>
                                    </div>
		
	<?php } elseif($format == 'gallery') { ?>
                                               <?php
				    global $post;
            $image_size = 'post_large_image';
            $layout = mom_page_layout();
            $posts_layout = mom_posts_layout();
            if (is_single()) {
                if ($posts_layout == 'list') {
                    $image_size = 'post_list';
                    if ($layout == 'full') {
                    $image_size = 'feature_slider_square';                    
                    }
                }
            } else {
                $image_size = 'post_large_image';


            }                    
                                   ?>
                         
                            <article <?php post_class('post_style'); ?>>
                                                 <?php
                                                $imgs = get_post_meta(get_the_ID(), '_format_gallery_images', false);
                                                $imgs = $imgs[0];
                                            ?>
    <?php if (is_array($imgs)) { ?>
    <div class="feature_slider_class">
    <div class="feature_slider s_default post_slider post_gallery">
        <div class="feature_wrap default-slider-wrap pt_slider">
                                                <?php foreach( $imgs as $slide) { ?>
                                                <?php
                                                $alt = get_post_meta($slide, '_wp_attachment_image_alt', true);
                                                $title = get_the_title($slide);
                                                $caption = get_post_field('post_excerpt', $slide);
;
                                                $slide_img = wp_get_attachment_image_src($slide, $image_size);
                                                $slide_url = wp_get_attachment_image_src($slide, 'full');
                                                $slide_img = $slide_img[0];

                                                ?>
                                               
                                                <div class='slider_item'><a href='<?php echo esc_url($slide_url[0]); ?>' rel='prettyPhoto[post_slide]' title='<?php echo esc_attr($title); ?>'><img src='<?php echo esc_url($slide_img); ?>' alt='<?php echo esc_attr($alt); ?>' /></a>
                                               
                                               <?php if ($caption != '') { ?>
                                                    <div class='post_slide_caption caption'><div class='sp_details'><h3 class='sp_title'><?php echo esc_html($caption); ?></h3></div></div>
                                                <?php } ?>
                                                </div> 

                                               <?php } ?>
        </div> <!--pt slider-->
    </div>
</div>
<?php } ?>
				   				
			<?php }  else { ?>
		<?php if (mom_post_image() != false) { ?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($image_size); ?>" alt="<?php the_title(); ?>"></a>
		<?php } ?>
		
	 <?php }
	
}