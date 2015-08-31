<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 
    <p><a href="#" class="dodelete-slides button">Remove All</a></p>
    <div id="slider_meta_control">
    <?php while($mb->have_fields_and_multi('slides')): ?>
    <?php $mb->the_group_open(); ?>
<?php
$rndn = rand(0,50);
?>
 <script type="text/javascript">
//<![CDATA[
 jQuery(function($) {

$('.mms_<?php echo esc_js($rndn); ?>').slider({
range: 'min',
value : 0.8,
step: 0.1,
min: 0,
max: 1,
slide: function( event, ui ) {
$( '.mmr_<?php echo esc_js($rndn); ?>' ).val(ui.value );
}        
});

$('.mmr_<?php echo esc_js($rndn); ?>').change(function () {
var value = this.value.substring(1);
$('.mms_<?php echo esc_js($rndn); ?>').slider('value', parseInt(value));
});

$('.cmms_<?php echo esc_js($rndn); ?>').slider({
range: 'min',
value : 0.8,
step: 0.1,
min: 0,
max: 1,
slide: function( event, ui ) {
$( '.cmmr_<?php echo esc_js($rndn); ?>' ).val(ui.value );
}        
});

$('.cmmr_<?php echo esc_js($rndn); ?>').change(function () {
var value = this.value.substring(1);
$('.cmms_<?php echo esc_js($rndn); ?>').slider('value', parseInt(value));
});

 });
//]]>
</script>
 <div class="slides_meta_wrap">
 
        <a href="#" class="dodelete button"><?php _e('Remove <img src="'. MOM_URI.'/framework/metaboxes/img/trash.png" alt="x">', 'framework') ?></a>
 <span class="shandle"><img src="<?php  echo MOM_URI; ?>/framework/metaboxes/img/move.png" alt="move"></span>
        <?php $mb->the_field('imgurl'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e('upload Image', 'framework') ?></label>
        <?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 
        <p>
            <?php echo balanceTags($wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value()))); ?>
            <?php echo balanceTags($wpalchemy_media_access->getButton()); ?>
 	<span class="image-preview apple_img_prev"><img alt="" /></span>
        <?php $mb->the_field('preview'); ?>
	<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mom_preview_meta_input" style="visibility: hidden; position: absolute;">
       </p>
 
        <?php $mb->the_field('title'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e('Title', 'framework') ?></label>
        <div><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<div class="custom_color">
			<i class="color_handle title_ch">T</i>
			<div class="colors_wrap title_cw">
			<?php $mb->the_field('title_color'); ?>
			<div class="color_meta">
			<h4><?php _e('Title color', 'theme') ?></h4>
			<input type="text" class="mom_color_field_txt" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/><br>
			</div>
			<?php $mb->the_field('title_bg'); ?>
			<div class="color_meta">
			<h4><?php _e('Title background color', 'theme') ?></h4>
			<input type="text" class="mom_color_field_bg" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			</div>
			<?php $mb->the_field('title_bg_opacity'); ?>
			<div class="color_meta">
			<h4><?php _e('Background opacity', 'theme') ?></h4>
			<div class="mom_range_wrap">
			<div style="width: 100px;" class='mom_range_slider mms_<?php echo esc_attr($rndn); ?>'></div>
			<input type="text" class="mom_range mmr_<?php echo esc_attr($rndn); ?>" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="0.8" />
			</div>
			<a class="button cl_close"><?php _e('Close', 'framework'); ?></a>
			</div>
			</div> <!--color wrap-->
			</div> <!--custom color-->
	</div>

        <?php $mb->the_field('caption'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e('Caption', 'framework') ?></label>
        <div><textarea style="float: left;" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>"><?php $mb->the_value(); ?></textarea>
				<div class="custom_color">
			<i class="color_handle caption_ch">C</i>
			<div class="colors_wrap caption_cw">
			<?php $mb->the_field('caption_color'); ?>
			<div class="color_meta">
			<h4><?php _e('Caption color', 'theme') ?></h4>
			<input type="text" class="mom_color_field_ctxt" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/><br>
			</div>
			<?php $mb->the_field('caption_bg'); ?>
			<div class="color_meta">
			<h4><?php _e('Caption background color', 'theme') ?></h4>
			<input type="text" class="mom_color_field_cbg" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			</div>
			<?php $mb->the_field('caption_bg_opacity'); ?>
			<div class="color_meta">
			<h4><?php _e('Background opacity', 'theme') ?></h4>
			<div class="mom_range_wrap">
			<div style="width: 100px;" class='mom_range_slider cmms_<?php echo esc_attr($rndn); ?>'></div>
			<input type="text" class="mom_range cmmr_<?php echo esc_attr($rndn); ?>" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="0.8" />
			</div>
			<a class="button cl_close"><?php _e('Close', 'framework'); ?></a>
			</div>
			</div> <!--color wrap-->
			</div> <!--custom color-->
<div class="clear"></div>
	</div>

        <?php $mb->the_field('url'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e('Link', 'framework') ?></label>
        <p><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
        <?php $mb->the_field('target'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e('Link Target', 'framework') ?></label>
			<p>
			<select name="<?php $mb->the_name(); ?>">
			<option value=""<?php $mb->the_select_state(''); ?>><?php _e('Open link in the same window', 'framework'); ?></option>
			<option value="_blank"<?php $mb->the_select_state('_blank'); ?>><?php _e('Open link in new window', 'framework'); ?></option>
		</select>
			</p>

 </div>
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    </div>
    <p style="margin-bottom:15px;"><a href="#" class="docopy-slides copy_bt button"><?php _e('Add Slide <img src="'. MOM_URI.'/framework/metaboxes/img/add.png" alt="+">', 'framework') ?></a></p>
</div>
<script type="text/javascript">
//<![CDATA[
 jQuery(function($) {
 $('#wpa_loop-slides').sortable({
 placeholder: "ui-state-highlight",
 handle: ".shandle"
 });
 $('.wpa_group-slides').each( function() {
			var $this = $(this);
			var $img = $this.find('input.mom_preview_meta_input').val();
			$this.find('.image-preview img').attr('src', $img);
			
});
var bgs = {
    change: function(event, ui){
	jQuery(this).parents('.colors_wrap').prev('.color_handle').css('background', ui.color.toString());
    },
};

var txts = {
    change: function(event, ui){
	jQuery(this).parents('.colors_wrap').prev('.color_handle').css('color', ui.color.toString());
    },
};

var cbgs = {
    change: function(event, ui){
	jQuery(this).parents('.colors_wrap').prev('.color_handle').css('background', ui.color.toString());
    },
};

var ctxts = {
    change: function(event, ui){
	jQuery(this).parents('.colors_wrap').prev('.color_handle').css('color', ui.color.toString());
    },
};

 $('.mom_color_field_bg').wpColorPicker(bgs);
 $('.mom_color_field_txt').wpColorPicker(txts);
 
 $('.mom_color_field_cbg').wpColorPicker(cbgs);
 $('.mom_color_field_ctxt').wpColorPicker(ctxts);
 
$('.color_handle').live('click', function (event) {
     $(this).next().fadeToggle();
     console.log('Clicka')
});
$('.cl_close').live('click', function () {
     $('.colors_wrap').fadeOut();			
});

$('.color_handle').each(function () {
var txt = $(this).next().find('.color_meta:eq(0) a.wp-color-result').css('background-color');
var bg = $(this).next().find('.color_meta:eq(1) a.wp-color-result').css('background-color');
if (bg !== 'rgb(249, 249, 249)') {
$(this).css('background', bg);
}

if (txt !== 'rgb(249, 249, 249)') {
$(this).css('color', txt);
}

});


});
//]]>
</script>