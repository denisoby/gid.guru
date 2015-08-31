			    <article <?php post_class('post_style format-link'); ?>>
				<div class="post_content">
                                    <?php mom_post_format_icon(); ?>
                                    <!-- <h2 class="entry-title post_title"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h2> -->
                                        <div class="entry-content">
                                            <?php mom_get_content(); ?>
                                            <a href="<?php global $post; echo esc_url(get_post_meta($post->ID, '_format_quote_source_url', true)); ?>"><?php echo esc_html(get_post_meta($post->ID, '_format_quote_source_name', true)); ?></a>
                                        </div><!--End Content-->

				</div><!--End Post Inner-->
			    </article><!--End Post-->