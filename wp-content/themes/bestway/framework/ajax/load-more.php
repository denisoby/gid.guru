<?php
add_action( 'init', 'mom_load_more_init' );
function mom_load_more_init() {
	// add scripts
        /*
         * added on main.js
         *
         wp_register_script( 'mom_load_more', get_template_directory_uri().'/framework/ajax/load-more.js',  array('jquery'),'1.0',true);
	wp_localize_script( 'mom_load_more', 'MomLMore', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		)
	);
        wp_enqueue_script('mom_load_more');
	*/
        // ajax Action
        add_action( 'wp_ajax_mom_loadMore', 'mom_load_more' );  
        add_action( 'wp_ajax_nopriv_mom_loadMore', 'mom_load_more');
        add_action( 'wp_ajax_mom_grid_loadMore', 'mom_grid_loadMore' );  
        add_action( 'wp_ajax_nopriv_mom_grid_loadMore', 'mom_grid_loadMore');
}

function mom_load_more () {
// stay away from bad guys 
$nonce = $_POST['nonce'];
$offset = $_POST['offset'];
$cat = $_POST['cat'];
$tag = $_POST['tag'];
$format = $_POST['format'];
$m = $_POST['m'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
die ( 'Nope!' );
	if ($format != '') {
		$format = array(
				array(
				    'taxonomy' => 'post_format',
				    'field' => 'slug',
				    'terms' => array($format),
				    'operator' => 'IN'
				)
			);
	}

?>
<?php
$posts_layout = mom_posts_layout();

$query = new WP_Query( array('posts_per_page' => get_option('posts_per_page'), 'offset' => $offset, 'post_status' => 'publish', 'cat' => $cat, 'tag' => $tag, 'tax_query' => $format, 'm' => $m) );
if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
        if ($posts_layout == 'grid') {
        	mom_grid_content();
        } else {
        	get_template_part('content', get_post_format());
        }
endwhile;?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
exit();
}

/* ==========================================================================
 *                Grid load more
   ========================================================================== */

function mom_grid_loadMore () {
    $count = $_POST['number_of_posts'];
    $display = $_POST['display'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
    $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
    $orderby = isset($_POST['orderby']) ? $_POST['orderby'] : '';
    $offset = $_POST['offset'];
    $formati = $_POST['format'];
    $load_more_count = $_POST['load_more_count'];
    

// stay away from bad guys 
    $nonce = $_POST['nonce'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) { die ( 'Nope!' ); }
//post format
if ($formati != '') {
$formati = explode(',',$formati);
$formats = array ();
foreach ($formati as $f) {
$formats[] = 'post-format-'.$f;
}
$formati = array(
array(
'taxonomy' => 'post_format',
'field' => 'slug',
'terms' => $formats,
'operator' => 'IN'
)
);
}
?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $formati,
'post_status' => 'publish',
'offset' => $offset,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $formati,
'post_status' => 'publish',
'offset' => $offset,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $formati,
'post_status' => 'publish',
'offset' => $offset,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
			$format = get_post_format();
				$extra_class = '';
			if ($format == 'aside') {
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['aside_type'])) { $aside_type = $extra['aside_type']; } else {$aside_type = '';}
				if($aside_type != 'code') {
					$extra_class = 'note_inside';
				}

			}
			if ($format == 'status') {
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['status_type'])) { $status_type = $extra['status_type']; } else {$status_type = '';}
				if($status_type != 'code') {
					$extra_class = 'note_inside';
				}

			}
		?>
		<li <?php post_class('post-grid '.$extra_class) ?>>
		<div class="pg-container">
			<?php if ($format == 'quote') { ?>
				<?php
					$bg = '';
					if (has_post_thumbnail( get_the_id() )) {
					    $bg = 'style="background:url('.mom_post_image('post_large_image').');"';
					}
				?>
				
				<div class="pg-content" <?php echo esc_attr($bg); ?>>
					<blockquote class="content_quote">
                                            <a href="<?php the_permalink(); ?>">
					<?php the_content(false); ?>
                                            </a>
                                        </blockquote>
				</div>


			<?php } elseif ($format == 'link') { ?>

				<?php
				    global $posts_st;
				    $extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), true); 
				    if (isset($extra['link_url']) && $extra['link_url'] != '') { $link_url = $extra['link_url']; } else{$link_url='';}
				?>
				<div class="pg-content">
                                    <h2 class="entry-title"><a href="<?php echo esc_url($link_url); ?>" target="_blank"><?php the_title(); ?></a></h2>
				    <span class="post_format"></span>
				</div>

			<?php } elseif ($format == 'aside') { 
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['aside_type'])) { $aside_type = $extra['aside_type']; } else {$aside_type = '';}
				if (isset($extra['aside_embed'])) { $aside_embed = $extra['aside_embed']; } else {$aside_embed = '';}				
			?>
			
			<?php if ($aside_type == 'code') { ?>
				<?php
					$bg = '';
					if (has_post_thumbnail( get_the_id() )) {
					    $bg = 'style="background-image:url('.mom_post_image('post_large_image').');"';
					}
				    ?>
					<div class="pg_head">
						<div class="aside_frame" <?php echo esc_attr($bg); ?>>
							<div class="aside_frame_inner">
							   <?php
							   echo balanceTags($aside_embed);
							   ?>
							</div>
						</div><!-- End aside_frame-->
					</div> <!--pg head-->
					<div class="pg-content">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
						<?php mom_grid_meta(); ?>
				    <?php } else { ?>
					<div class="format-note note_wrap">
					<?php mom_butterfly_post_title(); ?>
					    <div class="note">
						<p>
						    <?php
						    echo balanceTags($aside_embed);
						    ?>
						</p>
					    </div>
					    
					</div>
				    <?php } ?>
                        <?php } elseif ($format == 'status') { 
				global $posts_st;
				$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
				if (isset($extra['status_type'])) { $status_type = $extra['status_type']; } else {$status_type = '';}
				if (isset($extra['status_embed'])) { $status_embed = $extra['status_embed']; } else {$status_embed = '';}				
			?>
			
			<?php if ($status_type == 'code') { ?>
				<?php
					$bg = '';
					if (has_post_thumbnail( get_the_id() )) {
					    $bg = 'style="background-image:url('.mom_post_image('post_large_image').');"';
					}
				    ?>
					<div class="pg_head">
						<div class="status_frame" <?php echo esc_attr($bg); ?>>
							<div class="status_frame_inner">
							   <?php
							   echo balanceTags($status_embed);
							   ?>
							</div>
						</div><!-- End status_frame-->
					</div> <!--pg head-->
					<div class="pg-content">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
						<?php mom_grid_meta(); ?>
				    <?php } else { ?>
					<div class="format-note note_wrap">
					<?php mom_butterfly_post_title(); ?>
					    <div class="note">
						<p>
						    <?php
						    echo balanceTags($status_embed);
						    ?>
						</p>
					    </div>
					    
					</div>
				    <?php } ?>
			<?php } else { ?>
			<div class="pg-head">
				<?php mom_pg_post_head(); ?>
			</div>
			<div class="pg-content">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
						<?php mom_grid_meta(); ?>
			<?php } ?>

			</div>
		</li>

<?php
endwhile; else: ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
exit();
}
