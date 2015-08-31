<?php
//js Files
function mom_scripts_styles() {
	global $wp_styles;

// Scripts and Styles
	wp_register_script('googlemaps', ('http://maps.google.com/maps/api/js?sensor=false'), false, null, false);

	wp_register_script( 'Momizat-main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'boxSlider', get_template_directory_uri() . '/js/box-slider-all.jquery.min.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'Momizat-main-js', 'MomLMore', array(
		'more' => __('More', 'theme'),
		'less' => __('Less', 'theme'),
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		)
	);
	wp_enqueue_script('jquery');
	wp_enqueue_script('Momizat-main-js');
	wp_enqueue_script('plugins', MOM_JS . '/plugins/min/plugins.min.js', 'jquery');
	wp_enqueue_script('prettyPhoto', MOM_JS . '/jquery.prettyPhoto.js', 'jquery');
	wp_enqueue_script('owelcarousel', MOM_JS . '/owl.carousel.min.js', 'jquery');

// Our stylesheets
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'icons-css', get_template_directory_uri() . '/css/icons.css' );
	wp_enqueue_style( 'plugins', get_template_directory_uri() . '/css/owl.carousel.css' );

	if(mom_option('enable_responsive') != false) { wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/media.css' ); }

}
add_action( 'wp_enqueue_scripts', 'mom_scripts_styles');

/*----------------------------
    predefined Colors
 ----------------------------*/
add_action( 'wp_enqueue_scripts', 'mom_predefined_colors', 20);
function mom_predefined_colors() {
	$color = mom_option('main_skin');
	if (isset($_GET['color'])) {
		$color = $_GET['color'];
	}
	if ($color != '' && $color != 'light' ) {
		wp_enqueue_style( 'black-style', get_template_directory_uri() . '/css/'.$color.'.css' );
	}
	
}
add_action( 'admin_enqueue_scripts', 'mom_admin_scripts' );
function mom_admin_scripts( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style('shortcodes', MOM_URI.'/framework/shortcodes/css/tinymce.css');
}
// Momizat Get Images
function mom_post_image($size = 'thumbnail'){
		global $post;
		$image = '';
		//get the post thumbnail
		$image_id = get_post_thumbnail_id($post->ID);
		$image = wp_get_attachment_image_src($image_id,  
		$size);
		$image = $image[0];
		if ($image) return $image;
		//if the post is video post and haven't a feutre image
/*		$type = get_post_meta($post->ID, 'mom_article_type', true);
		$vtype = get_post_meta($post->ID, 'mom_video_type', true);
		$vId = get_post_meta($post->ID, 'mom_video_id', true);
		if($type == 'video') {
						if($vtype == 'youtube') {
						  $image = 'http://img.youtube.com/vi/'.$vId.'/0.jpg';
						} elseif ($vtype == 'vimeo') {
						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vId.php"));
						  $image = $hash[0]['thumbnail_large'];
						} elseif ($vtype == 'daily') {
						  $image = 'http://www.dailymotion.com/thumbnail/video/'.$vId;
						}
				}
				
		if ($image) return $image;
		*/
		//If there is still no image, get the first image from the post
		//return mom_get_first_image();
return false;
		}
		function mom_get_first_image() {
		  global $post, $posts;
		  $first_img = '';
		  ob_start();
		  ob_end_clean();
		  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		  $first_img = '';
		  if (isset($matches[1][0])) {$first_img = $matches[1][0];}
		  return $first_img;
		}

function mom_post_image_full($size = 'thumbnail', $hd = '', $alt = '', $id = ''){
if (mom_post_image($size, $id) != '') { 
	if ($hd == '') {
		$hd = $size;
	}
	global $post;
	if ($alt == '') {
		$alt = $post->post_title;
	}
	global $mom_thumbs_sizes;
	$w = isset($mom_thumbs_sizes[$size][0]) ? $mom_thumbs_sizes[$size][0] : '';
	$h = isset($mom_thumbs_sizes[$size][1]) ? $mom_thumbs_sizes[$size][1] : '';

	echo '<img src="'.mom_post_image($size, $id).'" data-hidpi="'.mom_post_image($hd, $id).'" alt="'.$alt.'" width="'.$w.'" height="'.$h.'">';
	} else {
		return false;
	}
}	
		
// Limit String Words
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
//Descover Vimeo
function mom_discoverVimeo($url)
{
    if ((($url = parse_url($url)) !== false) && (preg_match('~vimeo[.]com$~', $url['host']) > 0))
    {
        $url = array_filter(explode('/', $url['path']), 'strlen');

        if (in_array(@$url[0], array('album', 'channels', 'groups')) !== true)
        {
            array_unshift($url, 'users');
        }

        return array('type' => rtrim(array_shift($url), 's'), 'id' => array_shift($url));
    }

    return false;
}
//date format
function mom_date_format() {
	if (mom_option('date_format') == '') {
		return the_time(get_option('date_format'));
	} else {
		return the_time(mom_option('date_format'));
	}
}

//Share it
function mom_share_it () { ?>
<?php
$excerpt = get_the_content();
$excerpt = wp_html_excerpt($excerpt, 160);
?>
<div class="mom_share_it double_dots">
    <h4><?php _e('Share It : ', 'theme'); ?></h4>
    <div class="mom_share_buttons">

<?php if (mom_option('ss_facebook') != false ) { ?>
  <a class="mom_share_bt facebook" href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php print(esc_url(get_permalink())); ?>&p[title]=<?php print(esc_attr(the_title())); ?>&p[summary]=<?php print(urlencode(wp_html_excerpt(get_the_content(), 160))); ?>&p[images[0]=<?php print(urlencode(mom_post_image('large'))); ?>" target="_blank"><i class="bt-icon-facebook"></i><?php _e('facebook', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_twitter') != false ) { ?>
<a class="mom_share_bt twitter" href="http://twitter.com/home?status=<?php print(esc_attr(the_title())); ?>+<?php print(esc_url(get_permalink())); ?>"><i class="bt-icon-twitter"></i><?php _e('twitter', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_google') != false ) { ?>
<a class="mom_share_bt googleplus" href="https://plus.google.com/share?url=<?php print(esc_url(get_permalink())); ?>"><i class="bt-icon-google-plus"></i><?php _e('google+', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_linkedin') != false ) { ?>
<a class="mom_share_bt linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php print(esc_url(get_permalink())); ?>&title=<?php print(esc_attr(the_title())); ?>&source=<?php echo home_url(); ?>"><i class="bt-icon-linkedin"></i><?php _e('linkedin', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_pinterest') != false ) { ?>
<a class="mom_share_bt pinterest" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo mom_post_image('medium'); ?>&url=<?php print(esc_url(get_permalink())); ?>&is_video=false&description=<?php print(esc_attr(the_title())); ?>"><i class="bt-icon-pinterest"></i><?php _e('pinterest', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_email') != false ) { ?>
<a class="mom_share_bt email" href="mailto:mail@mail.com?subject=<?php print(esc_attr(the_title())); ?>&body=<?php print(esc_url(get_permalink())); ?>"><i class="bt-icon-envelope"></i><?php _e('email', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_su') != false ) { ?>
<a class="mom_share_bt su" href="http://www.stumbleupon.com/submit?url=<?php print(esc_url(get_permalink())); ?>&title=<?php print(esc_attr(the_title())); ?>"><i class="bt-icon-stumbleupon"></i><?php _e('StumbleUpon', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_reddit') != false ) { ?>
<a class="mom_share_bt reddit" href="http://www.reddit.com/submit?url=<?php print(esc_url(get_permalink())); ?>&title=<?php print(esc_attr(the_title())); ?>"><i class="bt-icon-reddit"></i><?php _e('reddit', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_evernote') != false ) { ?>
<a class="mom_share_bt evernote" href="http://www.evernote.com/clip.action?url=<?php print(esc_url(get_permalink())); ?>&title=<?php print(esc_attr(the_title())); ?>"><i class="bt-icon-evernote"></i><?php _e('evernote', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_delicious') != false ) { ?>
<a class="mom_share_bt delicious" href="http://del.icio.us/post?url=<?php print(esc_url(get_permalink())); ?>&title=<?php print(esc_attr(the_title())); ?>&notes=<?php echo esc_attr($excerpt); ?>"><i class="bt-icon-delicious"></i><?php _e('delicious', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_tumblr') != false ) { ?>
<a class="mom_share_bt tumblr" href="http://www.tumblr.com/share?v=3&u=<?php print(esc_url(get_permalink())); ?>&t=<?php print(esc_attr(the_title())); ?>"><i class="bt-icon-tumblr"></i><?php _e('tumblr', 'theme'); ?></a>
<?php } ?>

<?php if (mom_option('ss_ff') != false ) { ?>
<a class="mom_share_bt ff" href="http://www.friendfeed.com/share?url=<?php print(esc_url(get_permalink())); ?>&<?php print(esc_attr(the_title())); ?>"><i class="bt-icon-facebook"></i><?php _e('friendfeed', 'theme'); ?></a>
<?php } ?>
    </div>
    
	<a href="#" class="sh_arrow"><span><span><?php _e('More', 'theme'); ?></span><i class="bt-icon-angle-double-down"></i></span></a>
</div> <!--End Share-->
<?php
}
//next & prev post
function mom_post_nav () { ?>
    <div class="article_nav">
        <span class="prev_article"><?php previous_post_link('%link',__('Previous', 'theme')); ?></span>
        <span class="next_article"><?php next_post_link('%link', __('Next', 'theme')); ?> </span>
    </div> <!--Articles Nav-->
<?php } 
// author box
function mom_author_box () { ?>
                            <h4 class="main_title"><?php _e('About the author', 'theme'); ?></h4>
                            <div class="author_box">
				<?php
				$has_avatar = '';
				if (get_avatar( get_the_author_meta( 'user_email' ), '80' ) != '') { 
				$has_avatar = 'has_avatar';

				?>
				<div class="author_img">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), '80' ); ?>
				</div><!--End Author Image-->
				<?php } ?>
				<div class="author_info <?php echo esc_attr($has_avatar); ?>">
					<div class="author_head">
						<?php
						$author_name = get_the_author_meta('nickname');
						 if(function_exists('icl_register_string')) {
							icl_register_string('Author', 'author name', get_the_author_meta('nickname'));
							$author_name = icl_t('Author', 'author name', get_the_author_meta('nickname'));
						 }					
						?>
						<h3 class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo esc_html($author_name); ?></a></h3>
                                        </div><!--End Author head-->
                                    <p>
					<?php
					 if(function_exists('icl_register_string')) {
					icl_register_string('author', 'description', get_the_author_meta('description'));
					echo icl_t('author', 'description', get_the_author_meta('description'));
					} else {
						echo the_author_meta('description');
					}
					?>
                                    </p>
				    
				    <ul class="author_social">
					<?php if (get_the_author_meta('url') != '') { ?><li class="home"><a target="_blank" href="<?php the_author_meta('url'); ?>"><i class="bt-icon-home"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('facebook') != '') { ?><li class="facebook"><a target="_blank" href="<?php the_author_meta('facebook'); ?>"><i class="bt-icon-facebook"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('twitter') != '') { ?><li class="twitter"><a target="_blank" href="<?php the_author_meta('twitter'); ?>"><i class="bt-icon-twitter"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('googleplus') != '') { ?><li class="googleplus"><a target="_blank" href="<?php the_author_meta('googleplus'); ?>"><i class="bt-icon-google-plus"></i></a></li><?php } ?>
					<li class="rss"><a target="_blank" href="<?php echo get_author_feed_link(get_the_author_meta('ID')); ?>"><i class="bt-icon-rss"></i></a></li>
					<?php if (get_the_author_meta('youtube') != '') { ?><li class="youtube"><a target="_blank" href="<?php the_author_meta('youtube'); ?>"><i class="momizat-icon-play"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('dribbble') != '') { ?><li class="dribbble"><a target="_blank" href="<?php the_author_meta('dribbble'); ?>"><i class="bt-icon-dribbble"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('vimeo') != '') { ?><li class="vimeo"><a target="_blank" href="<?php the_author_meta('vimeo'); ?>"><i class="bt-icon-vimeo"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('pinterest') != '') { ?><li class="pinterest"><a target="_blank" href="<?php the_author_meta('pinterest'); ?>"><i class="bt-icon-pinterest"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('instagram') != '') { ?><li class="instgram"><a target="_blank" href="<?php the_author_meta('instagram'); ?>"><i class="bt-icon-instagram"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('tumblr') != '') { ?><li class="tumblr"><a target="_blank" href="<?php the_author_meta('tumblr'); ?>"><i class="bt-icon-tumblr"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('linkedin') != '') { ?><li class="linkedin"><a target="_blank" href="<?php the_author_meta('linkedin'); ?>"><i class="bt-icon-linkedin"></i></a></li><?php } ?>
					<?php if (get_the_author_meta('soundcloud') != '') { ?><li class="soundcloud"><a target="_blank" href="<?php the_author_meta('soundcloud'); ?>"><i class="bt-icon-soundcloud"></i></a></li><?php } ?>
					</ul>
                                </div><!--End Author Info-->
                            </div><!--End Author Box-->

<?php
}
//author meta
add_filter( 'user_contactmethods', 'mom_user_contactmethods', 10, 1 );
function mom_user_contactmethods( $contactmethods ) {
$contactmethods['googleplus'] = __( "Google+ URL", 'theme' );
$contactmethods['twitter'] = __( 'Twitter URL', 'theme' );
$contactmethods['facebook'] = __( 'Facebook profile URL', 'theme' );
$contactmethods['youtube'] = __( 'Youtube URL', 'theme' );
$contactmethods['dribbble'] = __( 'Dribbble URL', 'theme' );
$contactmethods['vimeo'] = __( 'Vimeo URL', 'theme' );
$contactmethods['pinterest'] = __( 'Pinterest URL', 'theme' );
$contactmethods['instagram'] = __( 'Instagram URL', 'theme' );
$contactmethods['tumblr'] = __( 'Tumblr URL', 'theme' );
$contactmethods['linkedin'] = __( 'Linkedin URL', 'theme' );
$contactmethods['soundcloud'] = __( 'Soundcloud URL', 'theme' );

return $contactmethods;
}
// Related posts
function mom_related_posts () { ?>
                            <h4 class="main_title"><?php _e('Related posts', 'theme'); ?></h4>
                            <div class="article_related_posts">
                                <ul class="related_posts">
	<?php $relatedby = 'category'; ?>
   <?php if ($relatedby == 'tags' ) { ?>
	    <?php
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) :
		$tag_ids = array();
		foreach($tags as $individual_tag){ $tag_ids[] = $individual_tag->term_id;}

		$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'posts_per_page'=> 5,
		'ignore_sticky_posts'=>1
		);
		$query =  new WP_Query( $args );
	    ?>
               <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <li class="related_item">
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </li>
                  <?php endwhile; ?>
                <?php  else:  ?>
                <h5><?php echo __('There is no related posts.', 'theme'); ?></h5>
                <?php  endif; ?>
                <?php wp_reset_postdata(); ?>
                  <?php endif;?>

<?php } else { ?>
	    <?php
		global $post;
		$cats = get_the_category($post->ID);
		if ($cats) :
		    $cat_ids = array();
		    foreach($cats as $individual_cat){ $cat_ids[] = $individual_cat->cat_ID;}
		
		    $args=array(
			'category__in' => $cat_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>5,
			'ignore_sticky_posts'=>1
		    );
		$query =  new WP_Query( $args );
	    ?>
 <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
 <?php $format = get_post_format(); ?>
    <li class="related_item">
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

    </li>
                   <?php endwhile; ?>
                <?php  else:  ?>
                <h5><?php echo __('There is no related posts.', 'theme'); ?></h5>
                <?php  endif; ?>
                <?php wp_reset_postdata(); ?> 
	         <?php endif;?>
	    <?php } ?>

                                </ul><!--End Related Posts-->
                                <div class="clear"></div>
                            </div><!--End Single Related Posts-->
<?php
}

// Hex To RGB
function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	if(strlen($hex) == 3) {
	   $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	   $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	   $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
	   $r = hexdec(substr($hex,0,2));
	   $g = hexdec(substr($hex,2,2));
	   $b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	//return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}
////breadcrumbs
//function mom_breadcrumb () {
//	if (mom_option('breadcrumb') != false) {
//		breadcrumbs_plus();
//	}
//}

// Custom Author Meta
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3><?php _e('Extra Information','theme'); ?></h3>

	<table class="form-table">


		<tr>
			<th><label for="twitter"><?php _e('Twitter','theme'); ?></label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Insert twitter name','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="facebook"><?php _e('Facebook','theme'); ?></label></th>

			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Insert facebook page URL','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="linkedin"><?php _e('linkedin','theme'); ?></label></th>

			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Insert LinkedIn URL','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="gplus"><?php _e('Google+','theme'); ?></label></th>

			<td>
				<input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( get_the_author_meta( 'gplus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Inesrt google+ URL','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="flickr"><?php _e('Flickr','theme'); ?></label></th>

			<td>
				<input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Inesrt flickr URL','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="youtube"><?php _e('Youtube','theme'); ?></label></th>

			<td>
				<input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Inesrt Youtube URL','theme'); ?>.</span>
			</td>
		</tr>
		<tr>
			<th><label for="pintrest"><?php _e('Pintrest','theme'); ?></label></th>

			<td>
				<input type="text" name="pintrest" id="pintrest" value="<?php echo esc_attr( get_the_author_meta( 'pintrest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Inesrt Pintrest URL','theme'); ?>.</span>
			</td>
		</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'gplus', $_POST['gplus'] );
	update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
	update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
	update_user_meta( $user_id, 'pintrest', $_POST['pintrest'] );
}

//Chat post format
/* Filter the content of chat posts. */
add_filter( 'the_content', 'my_format_chat_content' );

/* Auto-add paragraphs to the chat text. */
add_filter( 'my_post_format_chat_text', 'wpautop' );

/**
 * This function filters the post content when viewing a post with the "chat" post format.  It formats the 
 * content with structured HTML markup to make it easy for theme developers to style chat posts.  The 
 * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can 
 * have 100s of speakers in your chat post, each with their own, unique classes for styling.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
function my_format_chat_content( $content ) {
	global $_post_format_chat_ids;

	/* If this is not a 'chat' post, return the content. */
	if ( !has_post_format( 'chat' ) )
		return $content;

	/* Set the global variable of speaker IDs to a new, empty array for this chat. */
	$_post_format_chat_ids = array();

	/* Allow the separator (separator for speaker/text) to be filtered. */
	$separator = apply_filters( 'my_post_format_chat_separator', ':' );

	/* Open the chat transcript div and give it a unique ID based on the post ID. */
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

	/* Split the content to get individual chat rows. */
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

	/* Loop through each row and format the output. */
	foreach ( $chat_rows as $chat_row ) {
	global $posts_st;
$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
$avatar1 = '';
$avatar2 = '';
$avatar = '';
$has_avatar = 'no_avatar';
if (isset($extra['chat_avatar1_id'])) { $avatar1 = wp_get_attachment_image_src($extra['chat_avatar1_id'], 'square-widgets'); $has_avatar = 'has_avatar'; }
if (isset($extra['chat_avatar2_id'])) { $avatar2 = wp_get_attachment_image_src($extra['chat_avatar2_id'], 'square-widgets'); $has_avatar = 'has_avatar'; }


		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {

			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[1] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = my_format_chat_row_id( $chat_author );
if ($speaker_id == '1') {
	if ($avatar1) $avatar = '<img src="'.$avatar1[0].'" alt="'. sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) .'" width="50" height="50">';
} else {
	if ($avatar2) $avatar = '<img src="'.$avatar2[0].'" alt="'. sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) .'" width="50" height="50">';
}
			/* Open the chat row. */
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row '.$has_avatar.' ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

			/* Add the chat row author. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard">'.$avatar.'<cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite></div>';

			/* Add the chat row text. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

			/* Close the chat row. */
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
		}

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */
		else {

			/* Make sure we have text. */
			if ( !empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row '.$has_avatar.' ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'my_post_format_chat_content', $chat_output );
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global 
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John" 
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class 
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function my_format_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;

	/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
	$chat_author = strtolower( strip_tags( $chat_author ) );

	/* Add the chat author to the array. */
	$_post_format_chat_ids[] = $chat_author;

	/* Make sure the array only holds unique values. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

	/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}


/*
//Post views
function mom_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// function to display number of posts.
function mom_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.__(' Views', 'framework');
}
*/
?>