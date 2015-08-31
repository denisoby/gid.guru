<?php
global $posts_st;
$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
if (isset($extra['status_embed'])) { $status_embed = $extra['status_embed']; } else {$status_embed = '';}
$color = get_post_meta(get_the_ID(), 'mom_fa_bg', TRUE);
?>
                                <article <?php post_class('format-note post_style'); ?>>
                                    <?php if ($status_embed != '') { ?>
				    <?php
					$bg = '';
					if (has_post_thumbnail( get_the_id() )) {
					    $bg = 'background-image:url('.mom_post_image('post_large_image').');';
					} else {
					    if ($color != '') {
						$bg = 'background-color:'.$color.';';
					    }
					}
				    ?>
                                    <div class="status_frame" style="<?php echo esc_attr($bg); ?>">
                                           <?php
                                           echo balanceTags($status_embed);
                                           ?>
                                    </div><!-- End status_frame-->
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
				</article>
				<?php } else { ?>
					<div class="note_wrap">
					    <?php mom_butterfly_post_title(); ?>
					    <div class="note">
						    <?php the_content(); ?>
					    </div>
					    <?php mom_post_format_icon(); ?>
					</div>
				<?php } ?>
				
			    </article><!--End Post-->