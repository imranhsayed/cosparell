<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cosparell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

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
	<!-- For applying featured Image -->
	<?php if ( has_post_thumbnail( ) )
		{
			the_post_thumbnail( );

		}
		else
			{ 
				//To display the default featured image in posts
				$img_url = esc_url(get_template_directory_uri() . '/images/default.png');

				echo "<img src={$img_url} >";
			} 
		
	?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<footer class="entry-footer clear">
		<ul>
			<!-- Edit Post -->
			<li><?php edit_post_link( __( 'Edit', 'cosparell' ), '<span class="edit-link">', '</span>' ); ?></li>
			<!-- Read More Tab -->
			<li><span><a href="<?php the_permalink(); ?>"><?php _e('Read More' , 'cosparell' ) ?></a></span></li>
		</ul>
	</footer><!-- .entry-footer -->



</article><!-- #post-## -->
