<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cosparell
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-wrap">
		<!-- //code for displaying footer widgets -->
			<?php if( is_active_sidebar('Footer Widgets' )): ?>
				
				<div id="custom-footer" class="clear">
					<?php dynamic_sidebar('Footer Widgets' ); ?>
				</div><!-- END #custom-footer -->

			<?php endif; ?>
		</div><!-- END .footer-wrap -->
	
		<div class="site-info clear">
			<div class="footer-wrap">
				<ul>
					<li>
						<span class="sep"> Supernova Themes </span>
						<span class="sep"> | </span>
						<span class="canis-copyright-text"><?php echo cosparell_copyright_text(); ?></span>
					</li>
				</ul>
				<!-- ICONS -->
				<ul class="footer-icons">

				</ul>
			</div> <!-- END .footer-wrap -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
<div class="footer-scroll"><span></span></div> 

<?php wp_footer(); ?>
</body>
</html>
