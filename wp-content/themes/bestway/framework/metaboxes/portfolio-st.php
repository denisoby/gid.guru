<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control">

<?php $mb->the_field('type'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Type', 'framework') ?></label>
<select name="<?php $mb->the_name(); ?>">
<option value="image" <?php $mb->the_select_state('image'); ?>><?php _e('Image', 'theme'); ?></option>
<option value="slider" <?php $mb->the_select_state('slider'); ?>><?php _e('Slider', 'theme'); ?></option>
<option value="video" <?php $mb->the_select_state('video'); ?>><?php _e('Video', 'theme'); ?></option>
</select>
<p class="description"><?php _e('Select Portfolio Type "image, slider, video"', 'framework'); ?></p>
</p>
<div id="pt_slider_meta" class="hide">
<div>
<?php $mb->the_field('use_fi'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Use Feature Image', 'framework') ?></label>
<select name="<?php $mb->the_name(); ?>">
<option value="" <?php $mb->the_select_state(''); ?>><?php _e('No', 'theme'); ?></option>
<option value="yes" <?php $mb->the_select_state('yes'); ?>><?php _e('Yes', 'theme'); ?></option>
</select>
<p class="description"><?php _e('Use feature image as the first image in the slider', 'framework'); ?></p>
</div>
 
    <div id="slider_meta_control" style="margin-top: 15px;">
    <?php while($mb->have_fields_and_multi('slides')): ?>
    <?php $mb->the_group_open(); ?>
 <div class="slides_meta_wrap">
 
        <a href="#" class="dodelete button"><?php _e('Remove <img src="'. MOM_URI.'/framework/metaboxes/img/trash.png" alt="x">', 'framework') ?></a>
 <span class="shandle"><img src="<?php  echo MOM_URI; ?>/framework/metaboxes/img/move.png" alt="move"></span>
        <?php $mb->the_field('imgurl'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e('upload Image', 'framework') ?></label>
        <?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 
        <p>
            <?php echo balanceTags($wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => 'mom_full_meta_input'))); ?>
            <?php echo balanceTags($wpalchemy_media_access->getButton()); ?>
 	<span class="image-preview apple_img_prev"><img alt="" /></span>
        <?php $mb->the_field('preview'); ?>
	<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mom_preview_meta_input" style="visibility: hidden; position: absolute;">
        </p>
 
        <?php $mb->the_field('caption'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e('Caption', 'framework') ?></label>
        <p><textarea id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>"><?php $mb->the_value(); ?></textarea></p>

 </div>
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    </div>
    <p style="margin-bottom:15px;"><a href="#" class="docopy-slides copy_bt button"><?php _e('Add Slide <img src="'. MOM_URI.'/framework/metaboxes/img/add.png" alt="+">', 'framework') ?></a></p>
</div>

<?php $mb->the_field('video_url'); ?>
<p class="pt_video_url hide">
<label for="<?php $mb->the_name(); ?>"><?php _e('Video URL', 'framework') ?></label>
<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
<span class="description"><?php _e('Only Youtube or vimeo links  eg. http://vimeo.com/59393483', 'framework'); ?></span>
</p>

</div>
<script type="text/javascript">
//<![CDATA[
 jQuery(function($) {
 $('#wpa_loop-slides').sortable({
 placeholder: "port-state-highlight",
 handle: ".shandle"
 });
  $('.wpa_group-slides').each( function() {
			var $this = $(this);
			var $img = $this.find('input.mom_preview_meta_input').val();
			$this.find('.image-preview img').attr('src', $img);
			
});

// Portfolio settings
    $('[name="mom_portfolio_settings[type]"]').change(function() {
        var value = $(this).val();
        if (value === 'video') {
            $('#pt_slider_meta').fadeOut()
            $('.pt_video_url').fadeIn()
        } else if (value === 'slider') {
            $('#pt_slider_meta').fadeIn()
            $('.pt_video_url').fadeOut()
        } else {
            $('#pt_slider_meta').fadeOut()
            $('.pt_video_url').fadeOut()
        }
        
    });

 if ($('[name="mom_portfolio_settings[type]"]').val() === 'video') {
            $('#pt_slider_meta').fadeOut()
            $('.pt_video_url').fadeIn()
        } else if ($('[name="mom_portfolio_settings[type]"]').val() === 'slider') {
            $('#pt_slider_meta').fadeIn()
            $('.pt_video_url').fadeOut()
        } else {
            $('#pt_slider_meta').fadeOut()
            $('.pt_video_url').fadeOut()
        }        
 });
//]]>
</script>