<?php
    $hide_ps = get_post_meta($post->ID, 'mom_blog_ps', true);
    $hide_np = get_post_meta($post->ID, 'mom_blog_np', true);
    $hide_ab = get_post_meta($post->ID, 'mom_blog_ab', true);
    $hide_rp = get_post_meta($post->ID, 'mom_blog_rp', true);
    $hide_pc = get_post_meta($post->ID, 'mom_blog_pc', true);
?>
	    <?php get_header(); ?>
	    <?php //mom_setPostViews(get_the_id()); ?>
            <div class="clear"></div>
            <div class="inner">
		<div class="big_container">
		    <div class="big_main">
			<div class="posts single_page">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			    $format = get_post_format(); 
			?>
                                <?php get_template_part('content', get_post_format()); ?>				
                        <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.', 'theme'); ?></p>
                        <?php endif; ?>
			<?php if ($format != 'link') { ?>
			<div class="single_content">
				<?php if (is_single()) { 
				
                                            wp_link_pages( array(
                                                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>',
                                                      'after'       => '</div>',
                                                      'link_before' => '<span>',
                                                      'link_after'  => '</span>',
                                              ) );
                                            
                                    if (has_tag()) { ?>
                                    <div class="tag_cloud">
					<h4 class="tag_title"><?php _e('Tags :', 'theme'); ?></h4>
                                        <?php the_tags('', '', '', ''); ?>
                                    </div><!--End Post Tags-->
                                    <?php } ?>
                                <?php } ?>
				<?php
				    if ($hide_ps != true) {
					$hide_ps = mom_option('blog_ps');
				    }
				    if ($hide_np != true) {
					$hide_np = mom_option('blog_np');
				    }
				    if ($hide_ab != true) {
					$hide_ab = mom_option('blog_ab');
				    }
				    if ($hide_rp != true) {
					$hide_rp = mom_option('blog_rp');
				    }
				    if ($hide_pc != true) {
					$hide_pc = mom_option('blog_pc');
				    }
				?>
			<?php if ($hide_np != true)  { mom_post_nav(); } ?>
                        <?php if ($hide_pc != true)  { comments_template();} ?>
			</div>
			<?php } ?>
			</div><!--End Posts-->
		    </div><!--End main-->
                    <?php get_sidebar(); ?>
		    <div class="clear"></div>
		</div><!--End Container-->
	    </div><!--End Inner-->
	    <?php get_footer(); ?>