    <ul class="social_icons">
        <?php if(mom_option('twitter_url') != '') { ?>
        <li class="twitter"><a href="<?php echo esc_url(mom_option('twitter_url')); ?>"><i class="bt-icon-twitter"></i></a></li>
        <?php } ?>

        <?php if(mom_option('facebook_url') != '') { ?>
        <li class="facebook"><a href="<?php echo esc_url(mom_option('facebook_url')); ?>"><i class="bt-icon-facebook"></i></a></li>        
        <?php } ?>

        <?php if(mom_option('gplus_url') != '') { ?>
        <li class="gplus"><a href="<?php echo esc_url(mom_option('gplus_url')); ?>" ><i class="bt-icon-google-plus"></i></a></li>     
        <?php } ?>

        <?php if(mom_option('linkedin_url') != '') { ?>
         <li class="linkedin"><a href="<?php echo esc_url(mom_option('linkedin_url')); ?>"><i class="bt-icon-linkedin"></i></a></li>
        <?php } ?>

        <?php if(mom_option('youtube_url') != '') { ?>
        <li class="youtube"><a href="<?php echo esc_url(mom_option('youtube_url')); ?>"><i class="momizat-icon-play"></i></a></li>
        <?php } ?>
        <?php if(mom_option('skype_url') != '') { ?>
	<li class="skype"><a href="skype:<?php echo esc_url(mom_option('skype_name')); ?>?call"><i class="bt-icon-skype"></i></a></li>
        <?php } ?>

        <?php if(mom_option('flickr_url') != '') { ?>
        <li class="flickr"><a href="<?php echo esc_url(mom_option('flickr_url')); ?>"><i class="bt-icon-flickr"></i></a></li>
        <?php } ?>

        <?php if(mom_option('picasa_url') != '') { ?>
        <li class="picasa"><a href="<?php echo esc_url(mom_option('picasa_url')); ?>"><i class="bt-icon-picasa"></i></a></li>
        <?php } ?>

        <?php if(mom_option('vimeo_url') != '') { ?>
        <li class="vimeo"><a href="<?php echo esc_url(mom_option('vimeo_url')); ?>"><i class="bt-icon-vimeo"></i></a></li>
        <?php } ?>

        <?php if(mom_option('tumblr_url') != '') { ?>
        <li class="tumblr"><a href="<?php echo esc_url(mom_option('tumblr_url')); ?>"><i class="bt-icon-tumblr"></i></a></li>
        <?php } ?>
	
	<?php if(mom_option('pintrest_url') != '') { ?>
        <li class="pintrest"><a href="<?php echo esc_url(mom_option('pintrest_url')); ?>"><i class="bt-icon-pinterest"></i></a></li>
        <?php } ?>
	
	<?php if(mom_option('dribble_url') != '') { ?>
        <li class="dribble"><a href="<?php echo esc_url(mom_option('dribble_url')); ?>"><i class="bt-icon-dribbble3"></i></a></li>
        <?php } ?>
	
	<?php if(mom_option('soundcloud_url') != '') { ?>
        <li class="soundcloud"><a href="<?php echo esc_url(mom_option('soundcloud_url')); ?>"><i class="bt-icon-soundcloud"></i></a></li>
        <?php } ?>
	
	<?php if(mom_option('instagram_url') != '') { ?>
        <li class="instagram"><a href="<?php echo esc_url(mom_option('instagram_url')); ?>"><i class="bt-icon-instagram"></i></a></li>
        <?php } ?>
	
        <?php if(mom_option('rss_on_off') != false) {
	    $url = esc_url(get_bloginfo( 'rss2_url' ));
	    if (mom_option('rss_custom') != '') {
	    $url = mom_option('rss_custom');
	    }
	?>
        <li class="rss"><a href="<?php echo esc_url($url); ?>"><i class="bt-icon-rss"></i></a></li>
        <?php } ?>
    </ul>

