<?php
if ( ! function_exists( 'mom_comment' ) ) :
function mom_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'theme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'theme' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment_box">
					<?php 
					$has_avatar = '';
					echo get_avatar( $comment, 58 ); 
					if (get_avatar( $comment, 58 ) != '') {
						$has_avatar = 'has_avatar';
					}
					?>

				<div class="comment_info <?php echo esc_attr($has_avatar); ?>">
					<div class="comment_head">
					<?php
				    printf( '<h3 class="comment_author_name fn">%1$s %2$s</h3>',
					    get_comment_author_link(),
					    // If current post author is also comment author, make it known visually.
					    ( $comment->user_id === $post->post_author ) ? '' : ''
					 );
	
					?>
					 <?php
						printf( '<span class="comment_meta time commentmetadata "><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'theme' ), get_comment_date(), get_comment_time() )
						);
	
					?>
					</div>
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'theme' ); ?></em>
						<?php endif; ?>
							<?php comment_text(); ?>                      
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'theme' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( 'Edit', 'theme' )); ?>					
				</div><!--End Comments Box-->

	<?php
		break;
	endswitch; // end comment_type check
}
endif;
