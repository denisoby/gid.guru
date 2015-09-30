<?php
    //Page settings
    $pc = get_post_meta(get_the_ID(), 'mom_page_comments', true);
    //Page Layout
    $custom_page = get_post_meta(get_the_ID(), 'mom_custom_page', true);
    $layout = get_post_meta(get_the_ID(), 'mom_page_layout', true);
    $custom_sidebar = get_post_meta(get_the_ID(), 'mom_custom_sidebar', true);
    $hide_page_title = get_post_meta(get_the_ID(), 'mom_hide_page_title', true);
?>
<?php get_header(); ?>
		<?php if ($hide_page_title != true) { ?>
	    <header class="header_page">
		<div class="inner">		
		<h1 class="page_title main_title cpt"><?php the_title(); ?></h1>
		</div>
	    </header>
	    <?php } ?>
	    <div class="inner">
		<div class="big_container">
		    <div class="big_main">
			<?php if ($custom_page) { ?>
			    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php
				    the_content(false);
				    wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'theme' ), 'after' => '</div>' ) );	
				?>
			    <?php endwhile; else: ?>
			    <?php endif; ?>
			<?php } else { ?>
<div class="post_content page_style">
<?php
    if ($pc == true) {$pc_class=' page_has_comments';} else {$pc_class = '';}
?>
    <div class="page_content<?php echo esc_attr($pc_class); ?> entry_content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php
		the_content(false);
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'theme' ), 'after' => '</div>' ) );	
	    ?>
        <?php endwhile; else: ?>
        <?php endif; ?>
    </div>
    <?php
    if ($pc == true) {comments_template();}
    ?>
    </div>
    <?php } ?>
    <div class="clear"></div>
		    </div><!--End main-->
		    <?php get_sidebar(); ?>
		    <div class="clear"></div>
		</div><!--End Container-->
	    </div><!--End Inner-->
<?php get_footer(); ?>