<?php 

add_action('widgets_init','mom_flickr');

function mom_flickr() {
	register_widget('mom_flickr');
	
	}

class mom_flickr extends WP_Widget {
	function mom_flickr() {
			
		$widget_ops = array('classname' => 'flickr','description' => __('Widget display Flickr Feed','framework'));
		$this->WP_Widget('flickr-photo',__('Themelions - Flickr','framework'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
$title = apply_filters('widget_title', $instance['title'] );
	$flickrID = $instance['flickrID'];
	$count = $instance['count'];
	$box = $instance['box'];


		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
	wp_enqueue_script('jflicker');
	wp_enqueue_script('prettyPhoto');
?>
	<div class="flicker-widget-wrap clearfix" data-id="<?php echo esc_attr($flickrID); ?>" data-count="<?php echo esc_attr($count); ?>" data-box="<?php echo esc_attr($box); ?>"></div>

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['count'] = $new_instance['count'];
		$instance['box'] = $new_instance['box'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Flickr','framework'), 
		'flickrID' => '71447254@N00',
		'count' => '10',
		'box' => 'on',
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'flickrID' )); ?>"><?php _e('Flickr ID:', 'framework') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'flickrID' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickrID' )); ?>" value="<?php echo esc_attr($instance['flickrID']); ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e('Number of Photos:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance['count']); ?>" />
	</p>
	
	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['box'], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'box' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'box' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'box' )); ?>"><?php _e('Open in light box', 'framework'); ?></label>
	</p>
	
        
   <?php 
}
	} //end class