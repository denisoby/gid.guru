                            <article <?php post_class('post_style'); ?>>
				<?php if(mom_post_image() != false) {
				    butterfly_post_image();    
				} ?>
				<div class="post_content">
                                    <?php mom_butterfly_post_title(); ?>
                                <div class="meta_format">
				    <?php mom_butterfly_post_meta(); ?>
                                    <?php mom_post_format_icon(); ?>
                                </div><!--End Meta Wrap-->
				    <div class="entry-content">
					<?php
                                            the_content(false); 

                                        ?>
                                    <?php mom_butterfly_more_link(); ?>
				    </div><!--End Content-->
				</div><!--End Post Inner-->
			    </article><!--End Post-->