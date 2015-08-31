<?php get_header(); ?>
<div class="inner">
<div class="big_container">
    <div class="post_content page_style">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="portfolio_single">
		<?php 
		    global $post;
    global $portfolio_mb;
    global $portfolio_st;
    $settings = get_post_meta(get_the_ID(), $portfolio_st->get_the_id(), TRUE);

    $type = $settings['type'];
    if (isset($settings['video_url'])) {$video_url = $settings['video_url'];} else { $video_url = '';}
     if (strpos($video_url, 'youtube')) {
    parse_str( parse_url( $video_url, PHP_URL_QUERY ), $matches );
	$video = $matches['v'];    
	}
    if (strpos($video_url, 'vimeo')) {
	$id = mom_discoverVimeo($video_url);
	$video = $id['id'];
	}

		?>
    <?php if ($type == 'video') { ?>
	<div class="video_wrap">
	    <div class="video_frame">
	    <?php if (strpos($video_url, 'youtube')) { ?>
	    <iframe width="100%" height="525" src="http://www.youtube.com/embed/<?php echo esc_attr($video); ?>" frameborder="0" allowfullscreen></iframe>
	    <?php } ?>
	    <?php  if (strpos($video_url, 'vimeo')) { ?>
	    <iframe src="http://player.vimeo.com/video/<?php echo esc_attr($video); ?>" width="100%" height="525" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	    <?php } ?>
	    </div>
	</div>

    <?php } elseif ($type == 'slider') { ?>
    <div class="feature_slider_class">
	<div class="feature_slider s_default portfolio_slider">
		<div class="feature_wrap default-slider-wrap pt_slider">
			    <?php
			    if (isset($settings['use_fi'])) {
			    if ($settings['use_fi'] == 'yes') {
				global $post;
				if ( has_post_thumbnail() ) {
    $fi = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $fi_id = get_post_thumbnail_id( $post->ID );
    $fi_meta = wp_get_attachment_metadata($fi_id);
$full_url = $fi['0'];				
$url = $full_url;
				?>
		    		<?php echo "<div class='slider_item'><a href='{$full_url}' rel='prettyPhoto[pt_slide]'><img src='{$url}' alt='' /><span class='plus_overlay pt_single_ov'><i></i></span></a></div>"; ?>
			    <?php }}} ?>
			<?php
			foreach ($settings['slides'] as $slide) {
			$thumb = $slide['imgurl'];
			$fImage = $thumb;
			if (empty($fImage)) {
			    $fImage = $thumb;
			}
		    if (isset($slide['title'])) {$title = $slide['title'];} else { $title = '';}
		    if (isset($slide['caption'])) {$caption = $slide['caption'];} else { $caption = '';}

			 ?>
		<?php echo "<div class='slider_item'><a href='{$slide['imgurl']}' rel='prettyPhoto[pt_slide]' title='{$title}'><img src='{$fImage}' alt='{$title}' /><span class='plus_overlay pt_single_ov'><i></i></span></a><div class='pt_slide_caption caption'><div class='sp_details'><h3 class='sp_title'>{$caption}</h3></div></div></div>"; ?>
		<?php } ?>
		</div> <!--pt slider-->
	</div>
</div>

    <?php } else {

		butterfly_post_image('full');

	} ?>
            <div class="post_inner">
                <h1 class="pt_single_title entry-title post_title"><?php the_title(); ?></h1>
                <div class="entry_content">
		    <?php the_content(); ?>
                 </div>
		<div class="project_details">
		    <h4><?php _e('Project Details', 'theme'); ?></h4>
		    <?php
			global $portfolio_mb;
			$meta = get_post_meta(get_the_ID(), $portfolio_mb->get_the_id(), TRUE);
			if (isset($meta['client'])) { $client = $meta['client']; } else { $client = ''; }
			if (isset($meta['hide_date'])) { $date = $meta['hide_date']; } else { $date = ''; }
			if (isset($meta['hide_cat'])) { $cat = $meta['hide_cat']; } else { $cat = ''; }
			if (isset($meta['url'])) { $url = $meta['url']; } else { $url = ''; }
		    ?>
		    <div class="pt_infos">
			<?php if($client != '') { ?>
			    <div class="pt_info">
				<span class="info-term"><?php _e('Client:', 'theme'); ?> </span>
				<span class="info-data"><?php echo esc_html($client); ?></span>
			    </div>
			    <?php } ?>
			    <?php if($date != 'yes') { ?>
			    <div class="pt_info">
				<span class="info-term"><?php _e('Date:', 'theme'); ?></span>
				<span class="info-data" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time(mom_option('date_format')); ?></span>
			    </div>
			    <?php } ?>
		    
			    <?php if($cat != 'yes') { ?>
			    <div class="pt_info">
				<span class="info-term"><?php _e('Categories:', 'theme'); ?></span>
				<span class="info-data"> <?php
				$ptcats = wp_get_object_terms($post->ID, 'portfolio_category');
				foreach ($ptcats as $ptcat) {
				    echo esc_html($ptcat->name) . '<span class="cat_comma">, </span>';
				}
				?></span>
			    </div>
			    <?php } ?>
			    <?php if($url != '') { ?>
			    <div class="pt_info">
				<span class="info-term"><?php _e('Project URL:', 'theme'); ?></span>
				<span class="info-data"><a href="<?php echo esc_url($url); ?>" target="_blank"><?php _e('View Project', 'theme'); ?></a></span>
			    </div>
			    <?php } ?>
			    <?php
			    if (isset($meta['ptc'])) { $infos = $meta['ptc']; } else { $infos = array(); }
				foreach ($infos as $info) { ?>
					<div class="pt_info">
					    <span class="info-term"><?php _e($info['title'].':', 'theme'); ?></span>
					    <span class="info-data"><?php _e($info['content'],'theme'); ?></a></span>
					</div>
			    <?php } ?>
		    </div>
		    <div class="details_arrow">
			<span class="prev"><?php previous_post_link('%link', ''); ?></span>
			<span class="next"><?php next_post_link('%link', ''); ?></span>
		    </div>
		</div>
            </div>
	    <?php mom_share_it (); ?>
	    <?php mom_related_projects(); ?>
        </div><!--End Portfolio Single-->
<?php endwhile; else: ?>
<?php endif; ?>
	
    </div><!--End Main-->
</div><!--End Container-->
</div>
<?php get_footer(); ?>