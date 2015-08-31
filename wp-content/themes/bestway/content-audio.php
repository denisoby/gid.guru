                            <article <?php post_class('post_style'); ?>>
                                   <div class="audio_frame">
                                            <?php if(mom_post_image() != false) {
                                                //butterfly_post_image();    
                                            } ?>
                                        <?php 
                                           $audio = get_post_meta(get_the_ID(), '_format_audio_embed', true); 
                                            if(wp_oembed_get( $audio )) {
                                                echo wp_oembed_get( $audio ); 
                                            } else {
                                                echo do_shortcode($audio);
                                            }
                                        ?>
                                    </div>
				<div class="post_content">
                                    <?php mom_butterfly_post_title(); ?>
				<div class="meta_format">
				    <?php mom_butterfly_post_meta(); ?>
                                    <?php mom_post_format_icon(); ?>
                                </div><!--End Meta Wrap-->
				    <div class="entry-content">
					<?php mom_get_content(); ?>
                                    <?php mom_butterfly_more_link(); ?>
				    </div><!--End Content-->
				</div><!--End Post Inner-->
			    </article><!--End Post-->