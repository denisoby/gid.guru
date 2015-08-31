<?php
/*
    Template Name: Archive
 */
?>
<?php get_header(); ?>
    <div class="inner">
        <div class="big_container">
            <div class="big_main">
		<div class="archive_page"> 
		<h1 class="page_title main_title cpt"><?php the_title(); ?></h1>
                <div class="post_content page_style">
		    <div class="page_content<?php echo esc_attr($pc_class); ?> entry_content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			    <?php the_content(false); ?>
			<?php endwhile; else: ?>
			<?php endif; ?>
		    </div>
<div class="one_half">
<div class="main_title"><h4><?php _e('Last 30 Posts', 'theme'); ?></h4></div>
                                <ul>
        <?php query_posts('posts_per_page=30'); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                    
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; else: ?>
        <?php endif; ?>
                                </ul>
</div>
<div class="one_half last">
    <div class="main_title"><h4><?php _e('Pages', 'theme'); ?></h4></div>
                                <ul>
                                    <?php wp_list_pages('title_li='); ?>
                                </ul>

</div>
<div class="divider"></div>
<div style="height:40px;" class="clear"></div>
<div class="one_third">
<div class="main_title"><h4><?php _e('Monthly Archives', 'theme'); ?></h4></div>
                                <ul>
                                    <?php wp_get_archives(); ?>
                                </ul>
</div>
<div class="one_third">
<div class="main_title"><h4><?php _e('Categories', 'theme'); ?></h4></div>
<ul>
                                    <?php wp_list_categories('title_li='); ?>
</ul>
</div>

<div class="one_third last">
<div class="main_title"><h4><?php _e('Tag Cloud', 'theme'); ?></h4></div>
<div class="tags"><?php wp_tag_cloud('smallest=8&largest=22'); ?></div>
</div>

<div class="clear" style="height: 40px;"></div>
                </div>
		</div>
            </div><!--End main-->
            <?php get_sidebar(); ?>
            <div class="clear"></div>
        </div><!--End Container-->
    </div><!--End Inner-->
<?php get_footer(); ?>