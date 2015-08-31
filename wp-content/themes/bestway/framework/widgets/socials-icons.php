<?php 

add_action('widgets_init','mom_social_icons');

function mom_social_icons() {
	register_widget('mom_social_icons');
	
	}

class mom_social_icons extends WP_Widget {
	function mom_social_icons() {
			
		$widget_ops = array('classname' => 'mom_social_networks','description' => __('Widget display social icons','theme'));
		$this->WP_Widget('momizat-social-networks',__('Themelions - social icons','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$rss = $instance['rss'];
		$youtube = $instance['youtube'];
		$dribble = $instance['dribble'];
		$pintrest = $instance['pintrest'];
		$instagram = $instance['instagram'];
		$vimeo = $instance['vimeo'];
		$tumblr = $instance['tumblr'];
		$linkedin = $instance['linkedin'];
		$soundcloud = $instance['soundcloud'];
		$skype = $instance['skype'];
		$flickr = $instance['flickr'];
		$picasa = $instance['picasa'];
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
<div class="big_socials">
    <ul>
        <?php if($twitter != '') { ?>
		<li class="twitter"><a href="<?php echo esc_url($twitter); ?>"><i class="fa-twitter"></i></a></li>
        <?php } ?>

        <?php if($facebook != '') { ?>
		<li class="facebook"><a href="<?php echo esc_url($facebook); ?>"><i class="fa-facebook"></i></a></li>        
        <?php } ?>

        <?php if($googleplus != '') { ?>
		<li class="gplus"><a href="<?php echo esc_url($googleplus); ?>" ><i class="fa-google-plus"></i></a></li>     
        <?php } ?>
	
        <?php if($linkedin != '') { ?>
                <li class="linkedin"><a href="<?php echo esc_url($linkedin); ?>"><i class="fa-linkedin"></i></a></li>
        <?php } ?>
	
	<?php if($youtube != '') { ?>
		<li class="youtube"><a href="<?php echo esc_url($youtube); ?>"><i class="fa-youtube-play"></i></a></li>
        <?php } ?>
	
	<?php if($dribble != '') { ?>
		<li class="dribble"><a href="<?php echo esc_url($dribble); ?>"><i class="fa-dribbble"></i></a></li>
        <?php } ?>
	
	<?php if($pintrest != '') { ?>
		<li class="pintrest"><a href="<?php echo esc_url($pintrest); ?>"><i class="fa-pinterest"></i></a></li>
        <?php } ?>
	
	<?php if($instagram != '') { ?>
                <li class="instagram"><a href="<?php echo esc_url($instagram); ?>"><i class="fa-instagram"></i></a></li>
        <?php } ?>
	
	<?php if($vimeo != '') { ?>
		<li class="vimeo"><a href="<?php echo esc_url($vimeo); ?>"><i class="momizat-icon-vimeo"></i></a></li>
        <?php } ?>
	
	<?php if($tumblr != '') { ?>
		<li class="tumblr"><a href="<?php echo esc_url($tumblr); ?>"><i class="fa-tumblr"></i></a></li>
        <?php } ?>

	<?php if($soundcloud != '') { ?>
	       <li class="soundcloud"><a href="<?php echo esc_url($soundcloud); ?>"><i class="fa-soundcloud"></i></a></li>
        <?php } ?>
	
        <?php if($skype != '') { ?>
	       <li class="skype"><a href="skype:<?php echo esc_url($skype); ?>?"><i class="fa-skype"></i></a></li>
        <?php } ?>
	
        <?php if($flickr != '') { ?>
                <li class="flickr"><a href="<?php echo esc_url($flickr); ?>"><i class="fa-flickr"></i></a></li>
        <?php } ?>
	
        <?php if($picasa != '') { ?>
		<li class="picasa"><a href="<?php echo esc_url($picasa); ?>"><i class="bt-icon-picasa"></i></a></li>
        <?php } ?>
	
	<?php if($rss == 'on') { ?>
		<li class="rss"><a href="<?php echo esc_url(get_bloginfo( 'rss2_url' )); ?>"><i class="fa-rss"></i></a></li>
        <?php } ?>
    </ul>
    <div class="clear"></div>
</div>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['googleplus'] = $new_instance['googleplus'];
		$instance['rss'] = $new_instance['rss'];
                $instance['youtube'] = $new_instance['youtube'];
                $instance['dribble'] = $new_instance['dribble'];
                $instance['pintrest'] = $new_instance['pintrest'];
                $instance['instagram'] = $new_instance['instagram'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['soundcloud'] = $new_instance['soundcloud'];
		$instance['skype'] = $new_instance['skype'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['picasa'] = $new_instance['picasa'];
		
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Follow US','theme'), 
			'twitter' => '#',
			'facebook' => '#',
			'googleplus' => '#',
			'youtube' => '',
			'dribble' => '',
			'pintrest' => '',
			'instagram' => '',
			'vimeo' => '',
			'tumblr' => '',
			'linkedin' => '',
			'soundcloud' => '',
			'skype' => '',
			'flickr' => '',
			'picasa' => '',
			
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		if (isset($instance['orderby'])) { $orderbyS = $instance['orderby'];} else {$orderbyS = ''; }
		
		?>
	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php _e('twitter','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" value="<?php echo esc_attr($instance['twitter']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php _e('facebook','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" value="<?php echo esc_attr($instance['facebook']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'googleplus' )); ?>"><?php _e('google plus','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'googleplus' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'googleplus' )); ?>" value="<?php echo esc_attr($instance['googleplus']); ?>" class="widefat" />
		</p>
		
		<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['rss'], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rss' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>"><?php _e('RSS', 'theme'); ?></label>
		</p>
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php _e('youtube','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" value="<?php echo esc_attr($instance['youtube']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'dribble' )); ?>"><?php _e('dribble','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'dribble' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribble' )); ?>" value="<?php echo esc_attr($instance['dribble']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'pintrest' )); ?>"><?php _e('pintrest','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'pintrest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pintrest' )); ?>" value="<?php echo esc_attr($instance['pintrest']); ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>"><?php _e('instagram','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" value="<?php echo esc_attr($instance['instagram']); ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'vimeo' )); ?>"><?php _e('vimeo','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'vimeo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vimeo' )); ?>" value="<?php echo esc_attr($instance['vimeo']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>"><?php _e('tumblr','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tumblr' )); ?>" value="<?php echo esc_attr($instance['tumblr']); ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php _e('linkedin','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" value="<?php echo esc_attr($instance['linkedin']); ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud' )); ?>"><?php _e('soundcloud','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'soundcloud' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud' )); ?>" value="<?php echo esc_attr($instance['soundcloud']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>"><?php _e('skype','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype' )); ?>" value="<?php echo esc_attr($instance['skype']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>"><?php _e('flickr','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr' )); ?>" value="<?php echo esc_attr($instance['flickr']); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'picasa' )); ?>"><?php _e('picasa','theme'); ?></label>
		<input type="text" id="<?php echo esc_attr($this->get_field_id( 'picasa' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'picasa' )); ?>" value="<?php echo esc_attr($instance['picasa']); ?>" class="widefat" />
		</p>

   <?php 
}
	} //end class