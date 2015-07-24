<?php
/**
 * Template part for displaying posts.
 *
 * @package Cerauno
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cerauno-home' ); ?></a>
			</div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-excerpt -->

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php cerauno_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->
