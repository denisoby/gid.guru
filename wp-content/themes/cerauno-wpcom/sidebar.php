<?php
/**
 * The sidebar containing the main widget areas.
 *
 * @package Cerauno
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area sidebar-left" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->

<div id="tertiary" class="widget-area sidebar-right" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div><!-- #tertiary -->
