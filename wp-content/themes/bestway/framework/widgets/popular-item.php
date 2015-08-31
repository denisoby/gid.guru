<?php 

add_action('widgets_init','mom_popular_item');

function mom_popular_item () {
	register_widget('mom_popular_item');
	
	}

class mom_popular_item extends WP_Widget {
	function mom_popular_item() {
			
		$widget_ops = array('classname' => 'popular-items','description' => __('Widget display one popular media it can be (image, video) only','theme'));
		$this->WP_Widget('popular-items',__('Themelions - Popular Item','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$type = $instance['type'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
				global $post;
?>
			<?php $args = array(
						"ignore_sticky_posts" => 1,
						'posts_per_page' => 1,
						"orderby" => "comment_count",
						'tax_query' => array(
								array(
									'taxonomy' => 'post_format',
									'field' => 'slug',
									'terms' => array( 'post-format-'.$type )
								)
							)					    
					    ); ?>

			<?php $query = new WP_Query( $args ); ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class="popular_widget">
                           <div class="popular_frame">
                                <div class="pop_video_frame">
<?php if ($type == 'video') { ?>
				<?php
                                      global $posts_st;
                                      $extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
    
                                        if (isset($extra['video_type'])) { $video_type = $extra['video_type']; }
                                        if (isset($extra['video_id'])) { $video_id = $extra['video_id']; }
                                        if (isset($extra['html5_poster_img'])) { $html5_poster = 'poster="'.$extra['html5_poster_img'].'"'; } else {$html5_poster = '';}
                                        
                                        if (isset($extra['html5_mp4']) && $extra['html5_mp4'] != '') { $mp4 = ' mp4="'.$extra['html5_mp4'].'"'; } else{$mp4='';}
                                        if (isset($extra['html5_m4v']) && $extra['html5_m4v'] != '') { $m4v = ' m4v="'.$extra['html5_m4v'].'"'; } else{$m4v='';}
                                        if (isset($extra['html5_webm']) && $extra['html5_webm'] != '') { $webm = ' webm="'.$extra['html5_webm'].'"'; } else{$webm='';}
                                        if (isset($extra['html5_ogv']) && $extra['html5_ogv'] != '') { $ogv = ' ogv="'.$extra['html5_ogv'].'"'; } else{$ogv='';}
                                        if (isset($extra['html5_wmv']) && $extra['html5_wmv'] != '') { $wmv = ' wmv="'.$extra['html5_wmv'].'"'; } else{$wmv='';}
                                        if (isset($extra['html5_flv']) && $extra['html5_flv'] != '') { $flv = ' flv="'.$extra['html5_flv'].'"'; } else{$flv='';}
					
				?>
                                        <?php if ($video_type == 'youtube') { ?>
             <iframe width="275px" height="175" src="http://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" frameborder="0" allowfullscreen></iframe>
                                    <?php } elseif ($video_type == 'vimeo') { ?>
                                        <iframe src="//player.vimeo.com/video/<?php echo esc_attr($video_id); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="275" height="175" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    <?php } elseif ($video_type == 'html5') { ?>
					<div class="video_frame">
                                        <?php echo do_shortcode('[video '.$mp4 .$m4v.$webm.$ogv.$wmv.$flv.$html5_poster.']'); ?>
					</div>
                                    <?php } ?>
				    
<?php } elseif ($type == 'image') { ?>
						<?php 
                                                $thumb = mom_post_image_full('medium'); 
                                                $fImage = $thumb;
						?>
                                    <a href="<?php the_permalink(); ?>"><?php echo balanceTags($fImage); ?></a>

<?php } ?>
                                </div><!--End Pop Vido_frame-->
                           </div><!--End Popular Frame-->
                            <h3 class="popular_posts_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                           <div class="popular_meta">
                                <span class="entry_comments"><i class="fa-comment-o"></i><a href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'theme') , __('1 Comment', 'theme'), __('% Comments', 'theme')); ?></a></span>
								<?php if(function_exists('the_views')) { ?><span class="viw"><i class="fa-eye"></i><?php the_views(); ?></span><?php } ?>
                           </div><!--End Popular Meta-->
                           <div class="clear"></div>
                        </div><!--End Popular Widget-->
			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_postdata(); ?>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Popular Video','theme'), 
		'type' => 'video'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'theme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php _e('Type:', 'theme') ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" class="widefat">
			<option <?php if ( 'video' == $instance['type'] ) echo 'selected="selected"'; ?>>video</option>
			<option <?php if ( 'image' == $instance['type'] ) echo 'selected="selected"'; ?>>image</option>
		</select>
	</p>
	
        
   <?php 
}
	} //end class