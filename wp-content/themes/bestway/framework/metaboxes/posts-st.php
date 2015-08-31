<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control">
    <p class="posts_extra_item posts_extra_empty"><?php _e('This boxes show only if you select post format need extra options', 'theme'); ?></p>

<div class="posts_extra_item pt_aside_st hide">
<?php $mb->the_field('aside_embed'); ?>
<p>
<label for="<?php $mb->the_name(); ?>"><?php _e('Aside embed code', 'framework') ?></label>
<textarea id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" rows="4"><?php $mb->the_value(); ?></textarea>
<span class="description"><?php _e('it can be twitter tweet, facebook post or anything else. or just leave it empty to add a text note', 'framework'); ?></span>
</p>
</div>

<div class="posts_extra_item pt_status_st hide">
<?php $mb->the_field('status_embed'); ?>
<p>
<label for="<?php $mb->the_name(); ?>"><?php _e('status embed', 'framework') ?></label>
<textarea id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" rows="4"><?php $mb->the_value(); ?></textarea>
<span class="description"><?php _e('it can be twitter tweet, facebook post or anything else. or just leave it empty to add a text note', 'framework'); ?></span>
</p>
</div>

<div class="posts_extra_item pt_chat_st hide">
<?php $mb->the_field('chat_speaker1_avatar'); ?>
<p style="position: relative;">
<label for="<?php $mb->the_name(); ?>"><?php _e('First Speaker Avatar', 'framework') ?></label>
    <?php echo balanceTags($wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value() , 'class' => 'mom_full_meta_input'))); ?>
    <?php echo balanceTags($wpalchemy_media_access->getButton()); ?>
<span class="image-preview chat_img_prev speaker1"><img alt="" /></span>
<?php $mb->the_field('chat_avatar1'); ?>
<input type="hidden" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="chat_speaker1_avatar mom_preview_meta_input" style="visibility: hidden; position: absolute;">
    <?php $mb->the_field('chat_avatar1_id'); ?>
<input type="hidden" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="image_id">
<span class="description"><?php _e('size is 64x64 for retina devices double this size it will be 128x128', 'framework'); ?></span>
</p>

<?php $mb->the_field('chat_speaker2_avatar'); ?>
<p style="position: relative;">
<label for="<?php $mb->the_name(); ?>"><?php _e('Second Speaker Avatar', 'framework') ?></label>
    <?php echo balanceTags($wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => 'mom_full_meta_input'))); ?>
    <?php echo balanceTags($wpalchemy_media_access->getButton()); ?>
<span class="image-preview chat_img_prev speaker2"><img alt="" /></span>
<?php $mb->the_field('chat_avatar2'); ?>
<input type="hidden" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="chat_speaker2_avatar mom_preview_meta_input" style="visibility: hidden; position: absolute;">
    <?php $mb->the_field('chat_avatar2_id'); ?>
<input type="hidden" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="image_id">
<span class="description"><?php _e('size is 64x64 for retina devices double this size it will be 128x128', 'framework'); ?></span>
</p>


</div>

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
$('.speaker1 img').attr('src',$('input.chat_speaker1_avatar').val())
$('.speaker2 img').attr('src',$('input.chat_speaker2_avatar').val())

$('.html5_poster img').attr('src',$('input.html5_poster_prev').val())



 });

//]]>
</script>