<?php
/**
 * Would generate the widget for recent post.
 * Though wordpress already has recent post widget available by default,
 * this widget do just a little extra by showing featured images as well
 *
 * @package cosparell
 */

/**
 * Class cosparell_recent_posts
 */
class Cosparell_Recent_Posts extends WP_Widget {

	/**
	 * Cosparell_recent_posts constructor.
	 */
	function __construct() {

	}

	/**
	 * Cosparell Recent Post
	 */
	function cosparell_recent_post() {

		$widget_opts = array(

			'classname' => 'cosparell',

			'description' => __( 'This widget will show recent posts with date and featured image', 'cosparell' ),

		);

		$control_opts = array(

			'width' => 250,

			'height' => 350,

			'id_base' => 'cosparell_recentposts',

		);

		$this->WP_Widget(
			'cosparell_recentposts',
		 __( 'Recent Posts cosparell', 'cosparell' ),
		  $widget_opts, $control_opts
			);
		}

	/**
	 * Widget
	 *
	 * @param {array} $arg Args.
	 * @param {array} $instance Instance.
	 */
	function widget( $arg, $instance ) {
		extract( $arg, EXTR_SKIP );

		/* Our variables from the widget settings. */

		$title = ( isset( $instance['title'] ) ) ? apply_filters( 'widget_title', $instance['title'] ) : __( 'Recent posts', 'cosparell' );

		$number = ( isset( $instance['number'] ) ) ? $instance['number'] : '';

		echo $before_widget;
		echo $before_title . $title . $after_title;

			$recent_posts = new WP_Query(
				array(

					'showposts' => $number,

				)
				);

		?>

	<div id="recent_posts" class="widget_recent_posts " >

		<ul class="slides clear" >

			<?php
			while ( $recent_posts->have_posts() ) :
$recent_posts->the_post();
?>

			<li>
				<div class="aside-post-img ">

					<?php

						if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'side-thumb' );
						} else {
						// To display the default image in aside recent posts.
						$img_url = esc_url( get_template_directory_uri() . '/images/default.png' );

						echo "<img src={$img_url} >";
						}

					?>
				</div>
					<div class="post-title-date ">
						<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						<?php the_title_attribute(); ?>
						</a></br>
						<span><?php the_time( get_option( 'date_format' ) ); ?></span>
					</div>
			</li>

	<?php endwhile; ?>

		<!-- to reset custom loop -->
		<?php wp_reset_postdata(); ?>


		</ul><!-- .slides -->

	</div><!-- #recent_posts -->

		<!--OUTPUT ENDS -->

		<?php echo $after_widget; ?>

		<?php

		}

	/**
	 * Update Widget Data.
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;

	}
	// function update
		// dashboard form
	function form( $instance ) {

		$defaults = array(
			'title' => 'Recent posts',
			'number' => 5,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		// Widget Title: Text Input.
		echo '<p>';

					echo '<label for="' . $this->get_field_id( 'title' ) . '">' . __( 'Title:', 'cosparell' ) . '</label>';

					echo '<input id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" value="' . esc_attr( $instance['title'] ) . '" style="width:90%;" />';

		echo '</p>';

		// Number of posts
		echo '<p>';

				echo '<label for="' . $this->get_field_id( 'number' ) . '">' . __( 'Number of posts to show:', 'cosparell' ) . '</label>';

				echo '<input id="' . $this->get_field_id( 'number' ) . '" name="' . $this->get_field_name( 'number' ) . '" value="' . esc_attr( $instance['number'] ) . '" size="3" />';

		echo '</p>';

		}
	}
