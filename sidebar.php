<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package cosparell
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area <?php cosparell_secondary_classes(); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
