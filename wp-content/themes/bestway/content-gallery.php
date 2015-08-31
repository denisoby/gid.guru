<?php
				    global $post;
            $image_size = 'post_large_image';
            $layout = mom_page_layout();
            $posts_layout = mom_posts_layout();
            if (is_single()) {
                if ($posts_layout == 'list') {
                    $image_size = 'post_list';
                    if ($layout == 'full') {
                    $image_size = 'feature_slider_square';                    
                    }
                }
            } else {
                $image_size = 'post_large_image';
                if ($layout == 'full') {
                    $image_size = 'large';
                }

            }                    
                                   ?>
                         
                            <article <?php post_class('post_style'); ?>>
                                              <?php
                                                $imgs = get_post_meta(get_the_ID(), '_format_gallery_images', false);
                                                $imgs = $imgs[0];
                                            ?>
    <?php if (is_array($imgs)) { ?>
    <div class="feature_slider_class">
    <div class="feature_slider s_default post_slider post_gallery">
        <div class="feature_wrap default-slider-wrap pt_slider">
                                                <?php foreach( $imgs as $slide) { ?>
                                                <?php
                                                $alt = get_post_meta($slide, '_wp_attachment_image_alt', true);
                                                $title = get_the_title($slide);
                                                $caption = get_post_field('post_excerpt', $slide);
;
                                                $slide_img = wp_get_attachment_image_src($slide, $image_size);
                                                $slide_url = wp_get_attachment_image_src($slide, 'full');
                                                $slide_img = $slide_img[0];

                                                ?>
                                               
                                                <div class='slider_item'><a href='<?php echo esc_url($slide_url[0]); ?>' rel='prettyPhoto[post_slide]' title='<?php echo esc_attr($title); ?>'><img src='<?php echo esc_url($slide_img); ?>' alt='<?php echo esc_attr($alt); ?>' /></a>
                                               
                                               <?php if ($caption != '') { ?>
                                                    <div class='post_slide_caption caption'><div class='sp_details'><h3 class='sp_title'><?php echo esc_html($caption); ?></h3></div></div>
                                                <?php } ?>
                                                </div> 

                                               <?php } ?>
        </div> <!--pt slider-->
    </div>
</div>
<?php } ?>

                                <div class="post_content">
                                    <?php mom_butterfly_post_title(); ?>
                                    <div class="meta_format">
				    <?php mom_butterfly_post_meta(); ?>
                                    <?php mom_post_format_icon(); ?>
                                </div><!--End Meta Wrap-->
				    <div class="entry-content">
					<?php
					    mom_get_content();
					?>
                                    <?php mom_butterfly_more_link(); ?>
				    </div><!--End Content-->
				</div><!--End Post Content-->
			    </article><!--End Post-->