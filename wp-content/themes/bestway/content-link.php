<?php
    $link_url = get_post_meta(get_the_ID(), '_format_link_url', true);
?>
                            <article <?php post_class('post_style'); ?>>
				<div class="post_content">
                                    <?php mom_post_format_icon(); ?>
                                    <h2 class="entry-title post_title"><a href="<?php echo esc_url($link_url); ?>" target="_blank"><?php the_title(); ?></a></h2>
				                    <?php if (mom_get_content() != '') { ?>
                                        <div class="entry-content">
                                            <?php mom_get_content(); ?>
                                        </div><!--End Content-->
                                    <?php } ?>
				</div><!--End Post Inner-->
			    </article><!--End Post-->