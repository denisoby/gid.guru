<?php
global $posts_st;
$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
if (isset($extra['aside_embed'])) { $aside_embed = $extra['aside_embed']; } else {$aside_embed = '';}
$color = get_post_meta(get_the_ID(), 'mom_fa_bg', TRUE);

?>
                                <article <?php post_class('format-note post_style'); ?>>
                                    <?php if ($aside_embed != '') { ?>
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
                                    <div class="aside_frame" style="<?php echo esc_attr($bg); ?>">
					<div class="aside_frame_inner">
                                           <?php
                                           echo balanceTags($aside_embed);
                                           ?>
					</div>
                                    </div><!-- End aside_frame-->
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
				<?php } else { ?>
					<div class="note_wrap">
					    <?php mom_butterfly_post_title(); ?>
					    <div class="note">
						    <?php
						    the_content();
						    ?>
					    </div>
					    <?php mom_post_format_icon(); ?>
					</div>
				<?php } ?>
			    </article><!--End Post-->