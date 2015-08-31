<div class="search_box">
    <form action="<?php echo esc_url(home_url()); ?>">
        <input type="text" value="" name="s" class="sf" placeholder="<?php _e('Search here', 'theme'); ?>">
            <?php if (function_exists('icl_get_languages')) { ?>
                <button type="submit" name="sb" class="sb subb" id="ssbt<?php echo(ICL_LANGUAGE_CODE); ?>"></button>
            <?php } else { ?>
                <button type="submit" name="sb" class="sb subb"></button>
            <?php } ?>
    </form>
</div><!--End Search Box-->