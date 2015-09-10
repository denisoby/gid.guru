<?php
//add_image_size( 'post_large_image', '655', '419', 1);
//add_image_size( 'grid_slider_image', '498', '288', 1);
//add_image_size( 'feature_slider_big', '679', '550', 1);
//add_image_size( 'feature_slider_small', '317', '273', 1);
//add_image_size( 'feature_slider_square', '330', '263', 1);
//add_image_size( 'post_list', '290', '207', 1);


//add_image_size( 'portfolio_thumb', '330', '211', 1);
//add_image_size( 'portfolio_thumb2', '497', '318', 1);
//add_image_size( 'portfolio_thumb4', '247', '158', 1);
//add_image_size( 'portfolio_thumb_HD', '660', '422', 1);

$mom_thumbs_sizes = array(
'thumbnail' => array(get_option( 'thumbnail_size_w' ), get_option( 'thumbnail_size_h' )),
'medium' => array(get_option( 'medium_size_w' ), get_option( 'medium_size_h' )),
'large' => array(get_option( 'large_size_w' ), get_option( 'large_size_h' )),
'full' => array('', ''),

'post_large_image' => array(680, 435),
'grid_slider_image' => array(498, 288),
'feature_slider_big' => array(679, 550),
'feature_slider_small' => array(317, 273),
'feature_slider_square' => array(330, 263),
'post_list' => array(260, 207),


'portfolio_thumb' => array(330, 211),
'portfolio_thumb2' => array(497, 318),
'portfolio_thumb4' => array(247, 158),
'portfolio_thumb_HD' => array(660, 422),

);

   function butterfly_post_image($size='') {
	$posts_layout = mom_posts_layout();
	if ($size == '') {
	    $size = 'post_large_image';
	}
    $layout = get_post_meta(get_the_ID(), 'mom_page_layout', true);
        if ($layout == '') {$layout = mom_option('main_layout');}
	if (isset($_GET['layout'])) {
		$layout = $_GET['layout'];
	}
	if ($layout == 'full') {
		$size = 'large';
	}
	if ($posts_layout == 'list' && !is_single()) {
		$size = 'post_list';
	}
	if ($posts_layout == 'list' && $layout == 'full') {
		$size = 'feature_slider_square';
	}
    ?>
            <div class="featured-img">
                <?php if (is_single()) { ?>
                    <?php echo mom_post_image_full($size); ?>
                <?php } else { ?>
                <a href="<?php the_permalink(); ?>"><?php echo mom_post_image_full($size); ?></a>
                <?php } ?>
            </div>
  <?php }
   function mom_butterfly_post_title() {
	$posts_layout = mom_posts_layout();
	$format = get_post_format();
        if(is_single()) { 
        	?>
            <h1 class="entry-title post_title"><?php the_title(); ?></h1>
        <?php } else { 
        		if ($posts_layout == 'list' && $format != 'chat' ) {
					$category = get_the_category(); 
					if($category[0]){
						echo '<span class="grid_cat_link"><a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a></span>'; 
					}         			
        		}

        	?>
            <h2 class="entry-title post_title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
 		<?php }
  	}
  function mom_post_format_icon() { 
  	$format = get_post_format();
  	$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M28.681 7.159c-0.694-0.947-1.662-2.053-2.724-3.116s-2.169-2.030-3.116-2.724c-1.612-1.182-2.393-1.319-2.841-1.319h-15.5c-1.378 0-2.5 1.121-2.5 2.5v27c0 1.378 1.122 2.5 2.5 2.5h23c1.378 0 2.5-1.122 2.5-2.5v-19.5c0-0.448-0.137-1.23-1.319-2.841zM24.543 5.457c0.959 0.959 1.712 1.825 2.268 2.543h-4.811v-4.811c0.718 0.556 1.584 1.309 2.543 2.268zM28 29.5c0 0.271-0.229 0.5-0.5 0.5h-23c-0.271 0-0.5-0.229-0.5-0.5v-27c0-0.271 0.229-0.5 0.5-0.5 0 0 15.499-0 15.5 0v7c0 0.552 0.448 1 1 1h7v19.5z"></path>
<path fill="#444444" d="M23 26h-14c-0.552 0-1-0.448-1-1s0.448-1 1-1h14c0.552 0 1 0.448 1 1s-0.448 1-1 1z"></path>
<path fill="#444444" d="M23 22h-14c-0.552 0-1-0.448-1-1s0.448-1 1-1h14c0.552 0 1 0.448 1 1s-0.448 1-1 1z"></path>
<path fill="#444444" d="M23 18h-14c-0.552 0-1-0.448-1-1s0.448-1 1-1h14c0.552 0 1 0.448 1 1s-0.448 1-1 1z"></path>
</svg>';
  	switch ($format) {
  		case 'quote':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M7.031 14c3.866 0 7 3.134 7 7s-3.134 7-7 7-7-3.134-7-7l-0.031-1c0-7.732 6.268-14 14-14v4c-2.671 0-5.182 1.040-7.071 2.929-0.364 0.364-0.695 0.751-0.995 1.157 0.357-0.056 0.724-0.086 1.097-0.086zM25.031 14c3.866 0 7 3.134 7 7s-3.134 7-7 7-7-3.134-7-7l-0.031-1c0-7.732 6.268-14 14-14v4c-2.671 0-5.182 1.040-7.071 2.929-0.364 0.364-0.695 0.751-0.995 1.157 0.358-0.056 0.724-0.086 1.097-0.086z"></path>
</svg>';
  		break;
  		
  		case 'image':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M26 28h-20v-4l6-10 8.219 10 5.781-4v8z"></path>
<path fill="#444444" d="M26 15c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3c1.657 0 3 1.343 3 3z"></path>
<path fill="#444444" d="M28.681 7.159c-0.694-0.947-1.662-2.053-2.724-3.116s-2.169-2.030-3.116-2.724c-1.612-1.182-2.393-1.319-2.841-1.319h-15.5c-1.378 0-2.5 1.121-2.5 2.5v27c0 1.378 1.122 2.5 2.5 2.5h23c1.378 0 2.5-1.122 2.5-2.5v-19.5c0-0.448-0.137-1.23-1.319-2.841zM24.543 5.457c0.959 0.959 1.712 1.825 2.268 2.543h-4.811v-4.811c0.718 0.556 1.584 1.309 2.543 2.268zM28 29.5c0 0.271-0.229 0.5-0.5 0.5h-23c-0.271 0-0.5-0.229-0.5-0.5v-27c0-0.271 0.229-0.5 0.5-0.5 0 0 15.499-0 15.5 0v7c0 0.552 0.448 1 1 1h7v19.5z"></path>
</svg>';
  		break;
  		
  		case 'gallery':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M26 28h-20v-4l6-10 8.219 10 5.781-4v8z"></path>
<path fill="#444444" d="M26 15c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3c1.657 0 3 1.343 3 3z"></path>
<path fill="#444444" d="M28.681 7.159c-0.694-0.947-1.662-2.053-2.724-3.116s-2.169-2.030-3.116-2.724c-1.612-1.182-2.393-1.319-2.841-1.319h-15.5c-1.378 0-2.5 1.121-2.5 2.5v27c0 1.378 1.122 2.5 2.5 2.5h23c1.378 0 2.5-1.122 2.5-2.5v-19.5c0-0.448-0.137-1.23-1.319-2.841zM24.543 5.457c0.959 0.959 1.712 1.825 2.268 2.543h-4.811v-4.811c0.718 0.556 1.584 1.309 2.543 2.268zM28 29.5c0 0.271-0.229 0.5-0.5 0.5h-23c-0.271 0-0.5-0.229-0.5-0.5v-27c0-0.271 0.229-0.5 0.5-0.5 0 0 15.499-0 15.5 0v7c0 0.552 0.448 1 1 1h7v19.5z"></path>
</svg>';
  		break;
  		
  		case 'audio':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M28.681 7.159c-0.694-0.947-1.662-2.053-2.724-3.116s-2.169-2.030-3.116-2.724c-1.612-1.182-2.393-1.319-2.841-1.319h-15.5c-1.378 0-2.5 1.121-2.5 2.5v27c0 1.378 1.121 2.5 2.5 2.5h23c1.378 0 2.5-1.122 2.5-2.5v-19.5c0-0.448-0.137-1.23-1.319-2.841v0zM24.543 5.457c0.959 0.959 1.712 1.825 2.268 2.543h-4.811v-4.811c0.718 0.556 1.584 1.309 2.543 2.268v0zM28 29.5c0 0.271-0.229 0.5-0.5 0.5h-23c-0.271 0-0.5-0.229-0.5-0.5v-27c0-0.271 0.229-0.5 0.5-0.5 0 0 15.499-0 15.5 0v7c0 0.552 0.448 1 1 1h7v19.5z"></path>
<path fill="#444444" d="M23.634 12.227c-0.232-0.19-0.536-0.266-0.83-0.207l-10 2c-0.467 0.094-0.804 0.504-0.804 0.981v7.402c-0.588-0.255-1.271-0.402-2-0.402-2.209 0-4 1.343-4 3s1.791 3 4 3 4-1.343 4-3v-7.18l8-1.6v4.183c-0.588-0.255-1.271-0.402-2-0.402-2.209 0-4 1.343-4 3s1.791 3 4 3 4-1.343 4-3v-10c0-0.3-0.134-0.583-0.366-0.773z"></path>
</svg>';
  		break;
  		
  		case 'video':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M28.681 7.159c-0.694-0.947-1.662-2.053-2.724-3.116s-2.169-2.030-3.116-2.724c-1.612-1.182-2.394-1.319-2.841-1.319h-15.5c-1.378 0-2.5 1.121-2.5 2.5v27c0 1.378 1.121 2.5 2.5 2.5h23c1.378 0 2.5-1.122 2.5-2.5v-19.5c0-0.448-0.137-1.23-1.319-2.841v0 0zM24.543 5.457c0.959 0.959 1.712 1.825 2.268 2.543h-4.811v-4.811c0.718 0.556 1.584 1.309 2.543 2.268v0 0zM28 29.5c0 0.271-0.229 0.5-0.5 0.5h-23c-0.271 0-0.5-0.229-0.5-0.5v-27c0-0.271 0.229-0.5 0.5-0.5 0 0 15.499-0 15.5 0v7c0 0.552 0.448 1 1 1h7v19.5z"></path>
<path fill="#444444" d="M8 16h10v10h-10v-10z"></path>
<path fill="#444444" d="M18 20l6-4v10l-6-4z"></path>
</svg>';
  		break;
  		
  		case 'chat':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 28 28">
<path fill="#444444" d="M11 6q-2.391 0-4.469 0.812t-3.305 2.203-1.227 2.984q0 1.281 0.828 2.469t2.328 2.063l1.516 0.875-0.547 1.313q0.531-0.313 0.969-0.609l0.688-0.484 0.828 0.156q1.219 0.219 2.391 0.219 2.391 0 4.469-0.812t3.305-2.203 1.227-2.984-1.227-2.984-3.305-2.203-4.469-0.812zM11 4q2.984 0 5.523 1.070t4.008 2.914 1.469 4.016-1.469 4.016-4.008 2.914-5.523 1.070q-1.344 0-2.75-0.25-1.937 1.375-4.344 2-0.562 0.141-1.344 0.25h-0.047q-0.172 0-0.32-0.125t-0.18-0.328q-0.016-0.047-0.016-0.102t0.008-0.102 0.031-0.094l0.039-0.078t0.055-0.086 0.063-0.078 0.070-0.078 0.063-0.070q0.078-0.094 0.359-0.391t0.406-0.461 0.352-0.453 0.391-0.602 0.32-0.688q-1.937-1.125-3.047-2.766t-1.109-3.5q0-2.172 1.469-4.016t4.008-2.914 5.523-1.070zM23.844 22.266q0.156 0.375 0.32 0.688t0.391 0.602 0.352 0.453 0.406 0.461 0.359 0.391q0.016 0.016 0.063 0.070t0.070 0.078 0.063 0.078 0.055 0.086l0.039 0.078t0.031 0.094 0.008 0.102-0.016 0.102q-0.047 0.219-0.203 0.344t-0.344 0.109q-0.781-0.109-1.344-0.25-2.406-0.625-4.344-2-1.406 0.25-2.75 0.25-4.234 0-7.375-2.063 0.906 0.063 1.375 0.063 2.516 0 4.828-0.703t4.125-2.016q1.953-1.437 3-3.313t1.047-3.969q0-1.203-0.359-2.375 2.016 1.109 3.187 2.781t1.172 3.594q0 1.875-1.109 3.508t-3.047 2.758z"></path>
</svg>';
  		break;
  		
  		case 'link':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M13.757 19.868c-0.416 0-0.832-0.159-1.149-0.476-2.973-2.973-2.973-7.81 0-10.783l6-6c1.44-1.44 3.355-2.233 5.392-2.233s3.951 0.793 5.392 2.233c2.973 2.973 2.973 7.81 0 10.783l-2.743 2.743c-0.635 0.635-1.663 0.635-2.298 0s-0.635-1.663 0-2.298l2.743-2.743c1.706-1.706 1.706-4.481 0-6.187-0.826-0.826-1.925-1.281-3.094-1.281s-2.267 0.455-3.094 1.281l-6 6c-1.706 1.706-1.706 4.481 0 6.187 0.635 0.635 0.635 1.663 0 2.298-0.317 0.317-0.733 0.476-1.149 0.476z"></path>
<path fill="#444444" d="M8 31.625c-2.037 0-3.952-0.793-5.392-2.233-2.973-2.973-2.973-7.81 0-10.783l2.743-2.743c0.635-0.635 1.664-0.635 2.298 0s0.635 1.663 0 2.298l-2.743 2.743c-1.706 1.706-1.706 4.481 0 6.187 0.826 0.826 1.925 1.281 3.094 1.281s2.267-0.455 3.094-1.281l6-6c1.706-1.706 1.706-4.481 0-6.187-0.635-0.635-0.635-1.663 0-2.298s1.663-0.635 2.298 0c2.973 2.973 2.973 7.81 0 10.783l-6 6c-1.44 1.44-3.355 2.233-5.392 2.233z"></path>
</svg>';
  		break;
  		
  		case 'aside':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 32 32">
<path fill="#444444" d="M28.681 7.159c-0.694-0.947-1.662-2.053-2.724-3.116s-2.169-2.030-3.116-2.724c-1.612-1.182-2.393-1.319-2.841-1.319h-15.5c-1.378 0-2.5 1.121-2.5 2.5v27c0 1.378 1.122 2.5 2.5 2.5h23c1.378 0 2.5-1.122 2.5-2.5v-19.5c0-0.448-0.137-1.23-1.319-2.841zM24.543 5.457c0.959 0.959 1.712 1.825 2.268 2.543h-4.811v-4.811c0.718 0.556 1.584 1.309 2.543 2.268zM28 29.5c0 0.271-0.229 0.5-0.5 0.5h-23c-0.271 0-0.5-0.229-0.5-0.5v-27c0-0.271 0.229-0.5 0.5-0.5 0 0 15.499-0 15.5 0v7c0 0.552 0.448 1 1 1h7v19.5z"></path>
</svg>';
  		break;
  		
  		case 'status':
  			$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 28 28">
<path fill="#444444" d="M14 6q-3.187 0-5.961 1.086t-4.406 2.93-1.633 3.984q0 1.75 1.117 3.336t3.148 2.742l1.359 0.781-0.422 1.5q-0.375 1.422-1.094 2.688 2.375-0.984 4.297-2.672l0.672-0.594 0.891 0.094q1.078 0.125 2.031 0.125 3.187 0 5.961-1.086t4.406-2.93 1.633-3.984-1.633-3.984-4.406-2.93-5.961-1.086zM28 14q0 2.719-1.875 5.023t-5.094 3.641-7.031 1.336q-1.094 0-2.266-0.125-3.094 2.734-7.187 3.781-0.766 0.219-1.781 0.344h-0.078q-0.234 0-0.422-0.164t-0.25-0.43v-0.016q-0.047-0.063-0.008-0.187t0.031-0.156 0.070-0.148l0.094-0.141t0.109-0.133 0.125-0.141q0.109-0.125 0.484-0.539t0.539-0.594 0.484-0.617 0.508-0.797 0.422-0.922 0.406-1.188q-2.453-1.391-3.867-3.437t-1.414-4.391q0-2.719 1.875-5.023t5.094-3.641 7.031-1.336 7.031 1.336 5.094 3.641 1.875 5.023z"></path>
</svg>
';
  		break;

  	}
  	?>
    <a href="<?php echo get_post_format_link(get_post_format()); ?>"><span class="post_format"><?php echo balanceTags($icon); ?></span></a>
 <?php }
function mom_butterfly_post_meta() { 
	$posts_layout = mom_posts_layout();
	$format = get_post_format();

			if ($posts_layout != 'list' || is_singular() || $format == 'chat') {
	?>

                <div class="entry-meta post_meta">
                    <span class="entry_comments"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17"  viewBox="0 0 28 28">
<path fill="#444444" d="M14 6q-3.187 0-5.961 1.086t-4.406 2.93-1.633 3.984q0 1.75 1.117 3.336t3.148 2.742l1.359 0.781-0.422 1.5q-0.375 1.422-1.094 2.688 2.375-0.984 4.297-2.672l0.672-0.594 0.891 0.094q1.078 0.125 2.031 0.125 3.187 0 5.961-1.086t4.406-2.93 1.633-3.984-1.633-3.984-4.406-2.93-5.961-1.086zM28 14q0 2.719-1.875 5.023t-5.094 3.641-7.031 1.336q-1.094 0-2.266-0.125-3.094 2.734-7.187 3.781-0.766 0.219-1.781 0.344h-0.078q-0.234 0-0.422-0.164t-0.25-0.43v-0.016q-0.047-0.063-0.008-0.187t0.031-0.156 0.070-0.148l0.094-0.141t0.109-0.133 0.125-0.141q0.109-0.125 0.484-0.539t0.539-0.594 0.484-0.617 0.508-0.797 0.422-0.922 0.406-1.188q-2.453-1.391-3.867-3.437t-1.414-4.391q0-2.719 1.875-5.023t5.094-3.641 7.031-1.336 7.031 1.336 5.094 3.641 1.875 5.023z"></path>
</svg>
<i class="fa-comment-o svg-fallback"></i><a href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'theme') , __('1 Comment', 'theme'), __('Комментариев: %', 'theme')); ?></a></span>
                    <span class="cat-links"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17" viewBox="0 0 30 28">
<path fill="#444444" d="M27.828 14.547q0-0.547-0.828-0.547h-17q-0.625 0-1.336 0.336t-1.117 0.82l-4.594 5.672q-0.281 0.375-0.281 0.625 0 0.547 0.828 0.547h17q0.625 0 1.344-0.344t1.109-0.828l4.594-5.672q0.281-0.344 0.281-0.609zM10 12h12v-2.5q0-0.625-0.438-1.062t-1.062-0.438h-9q-0.625 0-1.062-0.438t-0.438-1.062v-1q0-0.625-0.438-1.062t-1.062-0.438h-5q-0.625 0-1.062 0.438t-0.438 1.062v13.328l4-4.922q0.688-0.828 1.813-1.367t2.188-0.539zM29.828 14.547q0 0.969-0.719 1.875l-4.609 5.672q-0.672 0.828-1.813 1.367t-2.188 0.539h-17q-1.437 0-2.469-1.031t-1.031-2.469v-15q0-1.437 1.031-2.469t2.469-1.031h5q1.437 0 2.469 1.031t1.031 2.469v0.5h8.5q1.437 0 2.469 1.031t1.031 2.469v2.5h3q0.844 0 1.547 0.383t1.047 1.102q0.234 0.5 0.234 1.062z"></path>
</svg>
<i class="fa-folder-open-o svg-fallback"></i><?php the_category(', '); ?></span>
                </div><!--End Meta-->
                
 <?php } 

}
 function mom_butterfly_more_link(){ ?>
    <?php if(!is_single()) { ?>
        <div class="more-link-wrap"><a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read more', 'theme'); ?><i></i></a></div>
    <?php } ?>
 <?php }
  function mom_logo(){ ?>
		    	<div class="logo">
			<a href="<?php echo esc_url(home_url()); ?>">
			<?php
			    $logo = mom_option('logo_img');
			    $retina_logo = mom_option('retina_logo_img');
			    $header_style = mom_option('header_style');
			    if (isset($_GET['header_style'])) {
			    	$header_style = $_GET['header_style'];
			    }
          $color = mom_option('main_skin');
          if (isset($_GET['color'])) {
            $color = $_GET['color'];
          }
			?>
			    <?php if (isset($logo['url']) && $logo['url'] != '') { ?>
			    <img src="<?php echo esc_url($logo['url']); ?>" width="<?php echo intval($logo['width']); ?>" height="<?php echo intval($logo['height']); ?>"  alt="<?php bloginfo('name'); ?>" />
			    <?php } else { ?>
				<?php if ($header_style == 'header1' || $color == 'dark') { ?>
				<img src="<?php echo MOM_IMG.'/logo-dark.png'; ?>" alt="<?php bloginfo('name'); ?>"  width="346" height="77" />
			    <?php } else { ?>
				<img src="<?php echo MOM_IMG.'/logo.png'; ?>" alt="<?php bloginfo('name'); ?>"  width="346" height="77" />
			    <?php } ?>
			    <?php } ?>
			    <?php if (isset($retina_logo['url']) && $retina_logo['url'] != '') {
				$logo_dem = mom_option('logo_dem');
			    ?>
				<img class="mom_retina_logo" src="<?php echo mom_option('retina_logo_img', 'url'); ?>"  width="<?php echo intval($logo['width']); ?>" height="<?php echo intval($logo['height']); ?>" alt="<?php bloginfo('name'); ?>" />
			    <?php } else { ?>
				<?php if (isset($logo['url']) && $logo['url'] != '') { ?>
				<img class="mom_retina_logo" src="<?php echo esc_url($logo['url']) ?>"  width="346" height="77" alt="<?php bloginfo('name'); ?>" />
				<?php } else { ?>
	   				<?php $hs = mom_option('header_style'); if (isset($_GET['header_style'])) {$hs = $_GET['header_style'];} if ($hs == 'header1' || $color == 'dark') { ?>
				    <img class="mom_retina_logo" src="<?php echo MOM_IMG.'/logo-dark-retina.png'; ?>"  width="346" height="77" alt="<?php bloginfo('name'); ?>" />
				    <?php } else { ?>
				    <img class="mom_retina_logo" src="<?php echo MOM_IMG.'/logo.png'; ?>"  width="346" height="77" alt="<?php bloginfo('name'); ?>" />
				    <?php } ?>
				<?php } ?>
			    <?php } ?>
			</a>
                        </div>

 <?php }


function mom_get_content($type = '') {
	if (mom_option('post_content_excerpt') == true) {
		$type = 'excerpt';
	}
	$format = get_post_format();
	$posts_layout = mom_posts_layout();
	$style = mom_option('blog_style');
	$layout = mom_page_layout();

if (isset($_GET['style'])) {
	$style = $_GET['style'];
} 


		if (!is_singular()) {
			if ($posts_layout == 'list') {
	            $excerpt = get_the_excerpt();
	            if ($excerpt == false) {
	            	$excerpt = get_the_content();
	            }
	            $length = 120;
	            if ($style == '') {
	            	$length = 200;
	            }
	            if ($layout == 'full') {
	            	$length = 350;
	            }
	            echo '<p class="mom_visibility_desktop">'.wp_html_excerpt(strip_shortcodes($excerpt), $length, '...').'</p>';
	            echo '<p class="mom_visibility_device">'.wp_html_excerpt(strip_shortcodes($excerpt), 150, '...').'</p>';
	            if ($posts_layout == 'list' && !is_singular() && ( $format != 'link' || $format != 'chat' ) ) { ?>
				<div class="post_meta list_post_meta">
					<span class="author"><?php _e('by: ', 'theme') ?><?php the_author_posts_link(); ?></span>
					<span class="time"><?php _e('on: ', 'theme') ?><?php echo mom_date_format(); ?></span>

				<?php mom_share_post_outside(); ?>


				</div>

				 <?php }


			} else {		 
		if ($type == 'excerpt' || is_search()) {
			echo '<p>'.strip_shortcodes(get_the_excerpt()).'</p>';
		} else {
			the_content(false);
		}
	}
		} else {
			the_content();
		}
}

function mom_posts_layout () {
	$posts_layout = mom_option('posts_layout');
      	if (is_category()) {
      		$posts_layout = get_option("category_".get_query_var('cat'));
      		$posts_layout = isset($posts_layout['posts_layout']) ? $posts_layout['posts_layout'] :'';
      	}

	if (isset($_GET['posts_layout'])) {
		$posts_layout = $_GET['posts_layout'];
	}
	if ($posts_layout == 'none') {
		$posts_layout = mom_option('posts_layout');
	}
	return $posts_layout;
}

function mom_grid_columns () {
	$grid_cols = mom_option('grid_cols');
      	if (is_category()) {
      		$grid_cols = get_option("category_".get_query_var('cat'));
      		$grid_cols = isset($grid_cols['grid_cols']) ? $grid_cols['grid_cols'] :'';
      	}

	if (isset($_GET['grid_cols'])) {
		$grid_cols = $_GET['grid_cols'];
	}
	if ($grid_cols == '') {
		$grid_cols = mom_option('grid_cols');
	}
	return $grid_cols;
}

function mom_page_layout () {
if ( is_singular()) {
	
      global $post;
      $layout = get_post_meta($post->ID, 'mom_page_layout', TRUE);
		if ($layout == '') { $layout = mom_option('main_layout');}

} else {
    	$layout = mom_option('main_layout');  
}

if(function_exists('is_woocommerce') && is_woocommerce()) {
		  $woo_page_id = '';
		  if (is_shop()) {
		      $woo_page_id = get_option('woocommerce_shop_page_id');
		  } elseif (is_cart()) {
		      $woo_page_id = get_option('woocommerce_cart_page_id');
		  } elseif (is_checkout()) {
		      $woo_page_id = get_option('woocommerce_checkout_page_id');
		  } elseif (is_account_page()) {
		      $woo_page_id = get_option('woocommerce_myaccount_page_id');
		  } else {
		      $woo_page_id = get_option('woocommerce_shop_page_id');
		  }
		  $layout = get_post_meta($woo_page_id, 'mom_page_layout', true);
		          if ($layout == '') {$layout = mom_option('main_layout');}

}
	if (is_search()) {
	    $layout = mom_option('main_layout');
	}

  	if (is_category()) {
  		$layout = get_option("category_".get_query_var('cat'));
  		$layout = isset($layout['page_layout']) ? $layout['page_layout'] :'';
  	}

	if (isset($_GET['layout'])) {
		$layout = $_GET['layout'];
	}

	if ($layout == '') { $layout = mom_option('main_layout');}


	return $layout;
}

/* ==========================================================================
 *                Posts Class
   ========================================================================== */
function mom_post_class($classes) {
	$post_layout = mom_posts_layout();
	$layout = mom_page_layout();
	$format = get_post_format();
	$class = '';
	if ($post_layout != '' && !is_singular() ) {
		$class = 'post_'.$post_layout;
	}
	if ($format == 'link' || $format == 'chat') {
		$class = '';
	}
	$classes[] = esc_attr($class);

	if ($layout == 'full') {
		$classes[] = 'layout-full';
	}

	return $classes;
}
add_filter( 'post_class', 'mom_post_class' );

/* ==========================================================================
 *                Body classes
   ========================================================================== */
function mom_body_classes( $classes ) {

$layout = mom_page_layout();
$posts_layout = mom_posts_layout();

if (mom_option('sticky_navigation') == 1) {
    $classes[] = esc_attr('sticky_navigation_on');
}
$hs = mom_option('header_style');
	if (isset($_GET['header_style'])) {
		$hs = $_GET['header_style'];
	}
if ($hs != '') {
    $classes[] = esc_attr('header_style_'.$hs);
}
if ($layout != '') {
    $classes[] = esc_attr($layout);
}

if ($layout == 'full') {
    if (mom_option('content_in_full') == false) {
	      $classes[] = esc_attr('content_in_full');

    }
}

if ( is_singular() && ! is_front_page() ) {
	$classes[] = esc_attr('singular');
}

$theme_layout = mom_option('theme_style');
  if (isset($_GET['theme_layout'])) {
    $theme_layout = $_GET['theme_layout'];
  }

if ($theme_layout == 'boxed' || $theme_layout == 'boxed2') {
		$classes[] = esc_attr('layout-boxed');
}

if ($theme_layout == 'boxed2') {
		$classes[] = esc_attr('layout-boxed2');
}

if (mom_option('nav_align') == 'context') {
		$classes[] = esc_attr('navigation-align-context');
}
$style = mom_option('blog_style');

if (isset($_GET['style'])) {
	$style = $_GET['style'];
} 

if (mom_option('style_radius') == true) {
      $classes[] = esc_attr('style_radius');
}
if ($style == 'border') {
      $classes[] = esc_attr('style_border_box');
}
if ($style == 'white') {
      $classes[] = esc_attr('style_border_box style_white_box');
}
if (mom_option('top_search') == 1) {
      $classes[] = esc_attr('top_search_style');
}


if (mom_option('enable_responsive') == 1) {
	$classes[] = esc_attr('responsive_enabled');
}

if ($posts_layout == 'grid') { 
	$classes[] = esc_attr('posts-grid-layout');
}
if (mom_option('main_skin') != '') {
  $classes[] = esc_attr('color-'.mom_option('main_skin'));
}
	return $classes;
}
add_filter( 'body_class', 'mom_body_classes' );

/* ==========================================================================
 *                category options 
   ========================================================================== */

add_action ( 'edit_category_form_fields', 'mom_category_style');
    function mom_category_style( $tag ) {
	$t_id = $tag->term_id;
	$cat_meta = get_option( "category_$t_id");
    ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Category Layout', 'theme'); ?></label></th>
	<td>	
	<label for="cat_page_layout">
		<select name="Cat_meta[page_layout]" id="cat_page_layout">
		    <?php
			if (!isset($cat_meta['page_layout'])) { $cat_meta['page_layout'] = ''; }
		    ?>
			<option value=""><?php _e('None', 'theme'); ?></option>
			<option value="right-sidebar" <?php selected($cat_meta['page_layout'], 'right-sidebar'); ?>><?php _e('Right sidebar', 'theme'); ?></option>
			<option value="left-sidebar" <?php selected($cat_meta['page_layout'], 'left-sidebar'); ?>><?php _e('Left Sidebar', 'theme'); ?></option>
			<option value="full" <?php selected($cat_meta['page_layout'], 'full'); ?>><?php _e('Full width', 'theme'); ?></option>
		</select>
	    <br /><span class="description"><?php _e('select custom layout for this category, none mean this option will depend on theme options -> main layout', 'theme'); ?></span>
	</label>
	</td>
	</tr>

	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Posts Layout', 'theme'); ?></label></th>
	<td>	
	<label for="cat_layout">
		<select name="Cat_meta[posts_layout]" id="cat_layout">
		    <?php
			if (!isset($cat_meta['posts_layout'])) { $cat_meta['posts_layout'] = ''; }
		    ?>
			<option value="none" <?php selected($cat_meta['posts_layout'], 'none'); ?>><?php _e('Posts Layout...', 'theme'); ?></option>
			<option value="" <?php selected($cat_meta['posts_layout'], ''); ?>><?php _e('Default', 'theme'); ?></option>
			<option value="grid" <?php selected($cat_meta['posts_layout'], 'grid'); ?>><?php _e('Grid', 'theme'); ?></option>
			<option value="list" <?php selected($cat_meta['posts_layout'], 'list'); ?>><?php _e('List', 'theme'); ?></option>
		</select>
	    <br /><span class="description"><?php _e('select category posts layout', 'theme'); ?></span>
	</label>
	</td>
	</tr>

	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Grid columns', 'theme'); ?></label></th>
	<td>	
	<label for="grid_cols">
		<select name="Cat_meta[grid_cols]" id="grid_cols">
		    <?php
			if (!isset($cat_meta['grid_cols'])) { $cat_meta['grid_cols'] = ''; }
		    ?>
			<option value="2" <?php selected($cat_meta['grid_cols'], '2'); ?>><?php _e('Two columns', 'theme'); ?></option>
			<option value="3" <?php selected($cat_meta['grid_cols'], '3'); ?>><?php _e('Three columns', 'theme'); ?></option>
			<option value="3" <?php selected($cat_meta['grid_cols'], '3'); ?>><?php _e('Four columns', 'theme'); ?></option>
		</select>
	</label>
	</td>
	</tr>

	
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Sidebar', 'theme'); ?></label></th>
	<td>	
	<label for="cat_sidebar">
		<?php
			$sidebars = $GLOBALS['wp_registered_sidebars'];
		?>
		<select name="Cat_meta[sidebar]" id="cat_sidebar">
			<option value=""><?php _e('Select Sidebar ...', 'theme'); ?></option>
			<?php foreach ($sidebars as $sidebar) { 
				echo '<option value="'.esc_attr($sidebar['id']).'"'. selected($cat_meta['sidebar'], esc_attr($sidebar['id'])).'>'.$sidebar['name'].'</option>';
			} ?>
		</select>
	    <br /><span class="description"><?php _e('select category sidebar', 'theme'); ?></span>
	</label>
	</td>
	</tr>
	
	
    <?php
    }
add_action ( 'edited_category', 'save_mom_category_style');
function save_mom_category_style( $term_id ) {
	if ( isset( $_POST['Cat_meta'] ) ) {
	    $t_id = $term_id;
	    $cat_meta = get_option( "category_$t_id");
	    $cat_keys = array_keys($_POST['Cat_meta']);
	    foreach ($cat_keys as $key){
	    if (isset($_POST['Cat_meta'][$key])){
	    $cat_meta[$key] = $_POST['Cat_meta'][$key];
	    }
	    }
	    update_option( "category_$t_id", $cat_meta );
	}
}

add_action ( 'edit_category_form_fields', 'add_styles_scripts_color');
function add_styles_scripts_color(){
    wp_enqueue_style ('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('mom-cats-settings', get_template_directory_uri() . '/framework/helpers/js/cats.js');
    wp_enqueue_media();
}
