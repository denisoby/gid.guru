<?php 

add_action('widgets_init','mom_about_me');

function mom_about_me() {
	register_widget('mom_about_me');
	
	}

class mom_about_me extends WP_Widget {
	function mom_about_me() {
			
		$widget_ops = array('classname' => 'momiazat-about-me','description' => __('about me widget','theme'));
		
		$this->WP_Widget('momiazat-about-me',__('Themelions - About me','theme'),$widget_ops);

		add_action('admin_enqueue_scripts', array( $this, 'scripts'));

		}

		function scripts(){
		  wp_enqueue_media();
		  wp_enqueue_script('about-me-widget', get_template_directory_uri() . '/framework/widgets/js/about-me.js');
		}

	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$image = $instance['image'];
		$image_id = $instance['image_id'];
		$text = $instance['text'];
		$round_image = $instance['round_image'];
		$img_class = '';
		if($round_image == 'on') {
			$img_class = 'round-image';
		}
		/* Before widget (defined by themes). */
		echo $before_widget;


		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
			<div class="about-me-widget">
				<?php 
					if ($image)  {
						echo balanceTags('<img src="'.$image.'" alt="about me" class="about-me-image '.$img_class.'" width="210" height="210">');
					}
					if ($text) {
						echo "<p>";
						echo balanceTags($text);
						echo "</p>";
					}
				?>


			</div>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = $new_instance['text'];
		$instance['image'] = $new_instance['image'];
		$instance['image_id'] = $new_instance['image_id'];
		$instance['round_image'] = $new_instance['round_image'];


		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
				'title' => __('About Me','theme'), 
				'image' => '', 
				'text' => '', 
				'image_id' => '',
				'round_image' => ''
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
	
		?>
	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'theme') ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'image' )); ?>"><?php _e('Upload your image:', 'theme') ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" value="<?php echo esc_attr($instance['image']); ?>"  class="widefat custom_media_url" style="margin-bottom:6px;" />
		<input type="hidden" id="<?php echo esc_attr($this->get_field_id( 'image_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image_id' )); ?>" value="<?php echo esc_attr($instance['image_id']); ?>"  class="widefat custom_media_id"  />
		<a href="#" class="button custom_media_upload" id="<?php echo esc_attr($this->get_field_id( 'upload_button' )); ?>"><?php _e('Upload your Image'); ?></a>

		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['round_image'], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'round_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'round_image' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id( 'round_image' )); ?>"><?php _e('Round Image', 'theme'); ?></label>
		</p>


		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'text' )); ?>"><?php _e('Descrip your self:', 'theme') ?></label>
		<textarea id="<?php echo esc_attr($this->get_field_id( 'text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text' )); ?>" class="widefat" cols="20" rows="10"><?php echo esc_textarea($instance['text']); ?></textarea>

		</p>


        
   <?php 
}
	} //end class