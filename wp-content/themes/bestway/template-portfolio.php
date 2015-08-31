<?php
/*
    Template Name: Portfolio
 */
?>
<?php get_header(); ?>
<header class="header_page">
	    <div class="inner">
			<span class="br_title"><?php _e('Browsing Page', 'theme'); ?></span>
			<h1 class="page_title main_title cpt"><?php the_title(); ?></h1>
	    </div>
</header>
<div class="inner">
<div class="big_container">
    <div class="post_content page_style">
	<div <?php post_class('portfolio_page'); ?>>
	    <div class="page_content entry_content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		    <?php the_content(); ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php if (function_exists('tl_portfolio_register_portfolio_post_type')) { mom_portfolio_items(); } ?>
	    </div>
	</div>
    </div>
</div><!--End Container-->
</div>
<?php get_footer(); ?>