<?php
/**
 * The template for displaying the slider
 *
 * @package cosparell
 */

// Default Pictures for Slider if user put any.
$cosparell_default_slider_settings = array(
	array(
		'image'             => get_template_directory_uri() . '/Images/slides/slide1.jpg',
		'title'             => __( 'The Supermodel', 'cosparell' ),
		'link'              => '',
		'description'       => __( 'Latest Trends', 'cosparell' ),
	),
	array(
		'image'             => get_template_directory_uri() . '/Images/slides/slide2.jpg',
		'title'             => __( 'Winter Season', 'cosparell' ),
		'link'              => '',
		'description'       => __( 'Snow of winter', 'cosparell' ),
	),
	array(
		'image'             => get_template_directory_uri() . '/Images/slides/slide3.jpg',
		'title'             => __( 'The Perfect Couple', 'cosparell' ),
		'link'              => '',
		'description'       => __( 'Newly Married Couple', 'cosparell' ),
	),
);

/**
 *  Used for showing the slider
 *
 *  @package cosparell
 */

$slides = get_theme_mod( 'cosparell_slides' );

/* Assign the $slides value to default if the slider not set by the user in customizer. */
if ( ! is_array( $slides ) || empty( $slides ) ) {
	$slides = $cosparell_default_slider_settings;
}

if ( is_array( $slides ) && ( is_home() || is_front_page() ) ) : ?>

	<div id="cosparell-slider" class="flexslider clearfix">

		<?php
		foreach ( $slides as $slide ) :
			$link        = isset( $slide['link'] ) ? $slide['link'] : false;
			$title       = isset( $slide['title'] ) ? sprintf( '<h2 class="slide-title" ><a href="%s">%s</a></h2>', esc_url( $link ), esc_html( $slide['title'] ) ) : false;
			$description = isset( $slide['description'] ) ? sprintf( '<p class="slide-description"><a href="%s">%s</a></p>', esc_url( $link ), esc_html( $slide['description'] ) ) : false;
			$image       = isset( $slide['image'] ) ? sprintf( '<img src="%s" alt="%s">', esc_url( $slide['image'] ), __( 'Slide Image', 'cosparell' ) ) : false;
			?>
			<div class="cosparell-slide">
				<?php if ( $title || $description ) { ?>
					<div class="cosparell-slide-content">
						<div class="row">
							<?php echo $title . $description; ?>
						</div>
					</div>
				<?php } ?>
				<?php echo $image; ?>
			</div>
		<?php endforeach; ?>

	</div> <!-- #cosparell-slider -->

<?php endif; ?>
