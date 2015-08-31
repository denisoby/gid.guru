<?php 

add_action('widgets_init','mom_video_widgets');

function mom_video_widgets() {
	register_widget('mom_video_widgets');
	
	}

class mom_video_widgets extends WP_Widget {
	function mom_video_widgets() {
			
		$widget_ops = array('classname' => 'momiazat-videos','description' => __('Widget display viddeo support Youtube, vimeo, dailymotion','theme'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('momizar-videos',__('Themelions - Videos','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$type = $instance['type'];
		$id = $instance['id'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
	<?php if($type == 'Youtube') { ?>
		<iframe width="100%" height="200" src="http://www.youtube.com/embed/<?php echo esc_attr($id); ?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($type == 'Vimeo') { ?>
	<iframe src="http://player.vimeo.com/video/<?php echo esc_attr($id); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="264" height="200" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($type == 'Dialymotion') { ?>
<iframe frameborder="0" width="264" height="200" src="http://www.dailymotion.com/embed/video/<?php echo esc_attr($id) ?>?logo=0"></iframe>
	<?php } ?>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['id'] = $new_instance['id'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Video','theme'), 
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
	if (isset($instance['type'])) { $typeS = $instance['type'];} else {$typeS = ''; }
	if (isset($instance['id'])) { $ids = $instance['id'];} else {$ids = ''; }
	
		?>
	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'theme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>

	<p>
<label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php _e('type', 'theme') ?></label>
<select id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" class="widefat">
<option <?php if ( 'Youtube' == $typeS ) echo 'selected="selected"'; ?>>Youtube</option>
<option <?php if ( 'Vimeo' == $typeS ) echo 'selected="selected"'; ?>>Vimeo</option>
<option <?php if ( 'Dialymotion' == $typeS ) echo 'selected="selected"'; ?>>Dialymotion</option>
</select>
	</p>

		<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'id' )); ?>"><?php _e('Video ID:', 'theme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'id' )); ?>" value="<?php echo esc_attr($ids); ?>" class="widefat" />
		</p>

        
   <?php 
}
	} //end class