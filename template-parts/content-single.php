<?php
/**
 * @package cosparell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php the_title_attribute( ); ?>
		</h1>

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
