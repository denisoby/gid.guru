                            <article <?php post_class('post_style'); ?>>
<?php
	if (is_category()) {
    		$cat = get_query_var('cat');
    		$category = get_category($cat);
	}
?>
	<?php if($category->parent != 0 || is_single()) : ?>
			<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
				<?php if(function_exists('bcn_display'))
    					{
        					bcn_display();
    					}?>
			</div>
	<?php endif; ?>

				<?php if(mom_post_image() != false) {
				    butterfly_post_image();    
				} ?>
				<div class="post_content">
                                    <?php mom_butterfly_post_title(); ?>
				    <div class="meta_format">
					<?php mom_butterfly_post_meta(); ?>
					<?php mom_post_format_icon(); ?>
				    </div><!--End Meta Format-->
				    <div class="entry-content">
					<?php
                                            mom_get_content();

                                        ?>
					<?php mom_butterfly_more_link(); ?>
				    </div> <!--End Content-->
				</div> <!--End post Content-->
			    </article> <!--End Post-->