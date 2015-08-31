<?php 

add_action('widgets_init','mom_dribbble');

function mom_dribbble() {
	register_widget('mom_dribbble');
	
	}

class mom_dribbble extends WP_Widget {
	function mom_dribbble() {
			
		$widget_ops = array('classname' => 'mom-dribbble','description' => __('Widget display Dribbble feed','framework'));
		$this->WP_Widget('mom-dribbble-feed',__('Themelions - Dribbble','framework'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
$title = apply_filters('widget_title', $instance['title'] );
	$dribbbleID = $instance['dribbbleID'];
	$count = $instance['count'];
	$box = $instance['box'];
	$size = $instance['size'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
	<div class="dribbble-widget-wrap clearfix" data-id="<?php echo esc_attr($dribbbleID); ?>" data-count="<?php echo esc_attr($count); ?>" data-box="<?php echo esc_attr($box); ?>" data-size="<?php echo esc_attr($size); ?>"></div>

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['dribbbleID'] = strip_tags( $new_instance['dribbbleID'] );
		$instance['count'] = $new_instance['count'];
		$instance['box'] = $new_instance['box'];
		$instance['size'] = $new_instance['size'];


		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Dribbble','framework'), 
		'dribbbleID' => '',
		'count' => '10',
		'box' => 'on',
		'size' => 'thumb',
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'dribbbleID' )); ?>"><?php _e('Dribbble username or ID:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'dribbbleID' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbbleID' )); ?>" value="<?php echo esc_attr($instance['dribbbleID']); ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e('Number of Photos:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance['count']); ?>" />
	</p>
		
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'size' )); ?>"><?php _e('Image size:', 'theme') ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'size' )); ?>" class="widefat">
			<option value="thumb" <?php if ( 'thumb' == $instance['size'] ) echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'theme'); ?></option>
			<option value="large" <?php if ( 'large' == $instance['size'] ) echo 'selected="selected"'; ?>><?php _e('Large', 'theme'); ?></option>
		</select>
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['box'], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'box' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'box' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'box' )); ?>"><?php _e('Open in light box', 'framework'); ?></label>
	</p>
	
        
   <?php 
}
	} //end class