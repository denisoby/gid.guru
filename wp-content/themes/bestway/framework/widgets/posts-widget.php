<?php 

add_action('widgets_init','mom_widget_posts');

function mom_widget_posts() {
	register_widget('mom_widget_posts');
	
	}

class mom_widget_posts extends WP_Widget {
	function mom_widget_posts() {
			
		$widget_ops = array('classname' => 'posts','description' => __('Widget display Posts order by : Popular, Random, Recent','theme'));
		$this->WP_Widget('momizat-posts',__('Themelions - Posts','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$orderby = $instance['orderby'];
		$count = $instance['count'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			global $post;
?>
		<ul class="popular_posts">
<?php if($orderby == 'Popular') { ?>
			<?php $query = new WP_Query(array(  "ignore_sticky_posts" => 1, 'showposts' => $count, "orderby" => "comment_count" )); ?>
<?php } elseif($orderby == 'Random') { ?>
			<?php $query = new WP_Query(array(  "ignore_sticky_posts" => 1, 'showposts' => $count, "orderby" => "rand" )); ?>
<?php } elseif($orderby == 'Recent') { ?>
			<?php $query = new WP_Query(array(  "ignore_sticky_posts" => 1, 'showposts' => $count )); ?>
<?php } ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

                                <li>
	<?php if(mom_post_image() != false) { ?>

		<?php 
		    $thumb = mom_post_image('thumbnail'); 
		?>
	<a href="<?php the_permalink(); ?>" class="post-img"><img class="alignleft" src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr(the_title()); ?>" width="70" height="70"></a>
	<?php } ?>
	                                <div class="pop_content">
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <span><?php the_time(mom_option('date_format')); ?></span>
					</div>
                                </li>
			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_postdata(); ?>
			
		</ul>

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];
		$instance['orderby'] = $new_instance['orderby'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Most Popular','theme'), 
			'count' => 3,
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		if (isset($instance['orderby'])) { $orderbyS = $instance['orderby'];} else {$orderbyS = ''; }
		
		?>
	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:','theme'); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>"><?php _e('orderby', 'theme') ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>" class="widefat">
		<option <?php if ( 'Popular' == $orderbyS ) echo 'selected="selected"'; ?>>Popular</option>
		<option <?php if ( 'Random' == $orderbyS ) echo 'selected="selected"'; ?>>Random</option>
		<option <?php if ( 'Recent' == $orderbyS ) echo 'selected="selected"'; ?>>Recent</option>
		</select>
		</p>


		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e('Number Of Posts:','theme'); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance['count']); ?>" class="widefat" />
		</p>

   <?php 
}
	} //end class