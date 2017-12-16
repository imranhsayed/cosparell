<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package cosparell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title_attribute( 'before=<h1 class="entry-title">  &after=</h1>' ); ?>
			<?php if ( 'post' == get_post_type() ) : ?>
			
			<div class="head-post">
				<!-- Author name and icon -->
				<li class="cosparell-post-user"><span ><?php the_author(); ?></span></li>
				<!-- Leave a comment and edit ,function coming from inc>template-tags.php -->
				<li class="cosparell-post-comment"><?php cosparell_entry_footer(); ?></li>
				
				<!-- Date posted on -->
				<li class="cosparell-post-calander"><span><?php the_date(); ?></span></li>
				
			</div><!-- .head-post -->

		<!-- <div class="entry-meta">
			<?php cosparell_posted_on(); ?>
		</div> --><!-- .entry-meta -->
		<?php endif; ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'cosparell' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
