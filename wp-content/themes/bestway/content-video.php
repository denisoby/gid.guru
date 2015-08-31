                            <article <?php post_class('post_style'); ?>>

                                    <div class="video_frame">
                                        <?php 
                                           $video = get_post_meta(get_the_ID(), '_format_video_embed', true); 
                                            if(wp_oembed_get( $video )) {
                                                echo wp_oembed_get( $video ); 
                                            } else {
                                                echo do_shortcode($video);
                                            }
                                        ?>
                                    </div><!--End Vido_frame-->
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
				</div><!--End Post Inner-->
			    </article><!--End Post-->