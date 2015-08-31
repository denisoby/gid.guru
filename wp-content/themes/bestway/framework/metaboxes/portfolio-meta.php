<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">


<p>
<?php $mb->the_field('client'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Client', 'framework') ?></label>
<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
</p>

<p>
<?php $mb->the_field('hide_date'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Hide Date', 'framework') ?></label>
<select name="<?php $mb->the_name(); ?>">
<option value="" <?php $mb->the_select_state(''); ?>><?php _e('No', 'theme'); ?></option>
<option value="yes" <?php $mb->the_select_state('yes'); ?>><?php _e('Yes', 'theme'); ?></option>
</select>
</p>

<p>
<?php $mb->the_field('hide_cat'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Hide Category', 'framework') ?></label>
<select name="<?php $mb->the_name(); ?>">
<option value="" <?php $mb->the_select_state(''); ?>><?php _e('No', 'theme'); ?></option>
<option value="yes" <?php $mb->the_select_state('yes'); ?>><?php _e('Yes', 'theme'); ?></option>
</select>
</p>

<p>
<?php $mb->the_field('url'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Project Url', 'framework') ?></label>
<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
</p>

 <h4><?php _e('Custom Portfolio Details', 'framework'); ?></h4>
<p><a href="#" class="dodelete-ptc button">Remove All</a></p>
<?php while($mb->have_fields_and_multi('ptc')): ?>
<?php $mb->the_group_open(); ?>
<div class="port_meta_wrap">
 
        <a href="#" class="dodelete button"><?php _e('Remove <img src="'. MOM_URI.'/framework/metaboxes/img/trash.png" alt="x">', 'framework') ?></a>
 <span class="shandle"><img src="<?php  echo MOM_URI; ?>/framework/metaboxes/img/move.png" alt="move"></span>
<div class="pt_info_wrap">
        <?php $mb->the_field('title'); ?>
        <p class="pt_extra_info">
	<label for="<?php $mb->the_name(); ?>"><?php _e('Title', 'framework') ?></label>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
	</p>

        <?php $mb->the_field('content'); ?>
        <p class="pt_extra_info last">
	<label for="<?php $mb->the_name(); ?>"><?php _e('Content', 'framework') ?></label>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
	</p>
</div>


 </div>
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <p style="margin-bottom:15px;"><a href="#" class="docopy-ptc copy_bt button"><?php _e('Add Info <img src="'. MOM_URI.'/framework/metaboxes/img/add.png" alt="+">', 'framework') ?></a></p>
 
</div>
<script type="text/javascript">
//<![CDATA[
 jQuery(function($) {
 $('#wpa_loop-ptc').sortable({
 placeholder: "port-state-highlight",
 handle: ".shandle"
 });
 });
//]]>
</script>