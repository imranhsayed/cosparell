<?php
/**
 * Custom Functions.
 *
 * @package Cosparell
 */

/**
 * Styles and scripts.
 */
function cosparell_styles_and_scripts() {
	wp_register_style( 'cosparell-font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'cosparell-font-awesome' );
	wp_register_style( 'normalize_css', COSPARELL_CSS_URI . '/normalize.css' );
	wp_enqueue_style( 'normalize_css', COSPARELL_CSS_URI . '/normalize.css' );

	wp_register_style( 'foundation_css', COSPARELL_CSS_URI . '/foundation.css' );
	wp_enqueue_style( 'foundation_css' );
	wp_register_style( 'slick_css', COSPARELL_CSS_URI . '/slick.css' );
	wp_enqueue_style( 'slick_css' );
	wp_register_style( 'slick_theme', COSPARELL_CSS_URI . '/slick-theme.css' );
	wp_enqueue_style( 'slick_theme' );
	wp_register_style( 'mmenu_css', COSPARELL_CSS_URI . '/jquery.mmenu.css' );
	wp_enqueue_style( 'mmenu_css' );

	wp_enqueue_script( 'foundation_js', COSPARELL_JS_URI . '/foundation.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'app_js', COSPARELL_JS_URI . '/app.js', array( 'jquery', 'foundation_js' ), '', true );
	wp_enqueue_script( 'cosparell-modernizr', get_template_directory_uri() . '/js/modernizr.js' );
	wp_enqueue_script( 'cosparell-REM-unit-polyfill', get_template_directory_uri() . '/js/rem.js', false, false, true );

	wp_enqueue_style( 'cosparell-style', get_stylesheet_uri() );

	wp_enqueue_script( 'cosparell-navigation-jquery', get_template_directory_uri() . '/js/vendor/jquery.mmenu.js', array(), '', true );
	wp_enqueue_script( 'cosparell-navigation', get_template_directory_uri() . '/js/vendor/navigation.js', array( 'cosparell-navigation-jquery' ), '', true );

	wp_enqueue_script( 'cosparell-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Slick slider.
	wp_enqueue_script( 'slick-js', COSPARELL_JS_URI . '/vendor/slick.min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'cosparell-comment-reply' );
	}
	// Registering main.js.
	wp_register_script( 'cosparell-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), 1.0, true );

	// Flexslider javascript.
	wp_enqueue_script( 'cosparell-jquery-flexslider' );
	wp_enqueue_script( 'cosparell-main' );

}
add_action( 'wp_enqueue_scripts', 'cosparell_styles_and_scripts' );

// Cosparell Recognized Social Links.
add_filter( 'cosparell_type_social_links_defaults', 'cosparell_recognized_social_links', 10, 1 );

if ( ! function_exists( 'cosparell_site_description' ) ) {

	/**
	 * Displays Site Description.
	 */
	function cosparell_site_description() {
		$hide_tagline = get_theme_mod( 'cosparell_hide_tagline' );
		$desc_class   = $hide_tagline ? ' screen-reader-text' : false;
		?>
		<p class="site-description<?php echo esc_attr( $desc_class ); ?>"><?php bloginfo( 'description' ); ?></p>
		<?php
	}
}

if ( ! function_exists( 'cosparell_site_branding' ) ) {

	/**
	 * Display Site Title and Site Description.
	 */
	function cosparell_site_branding() {
		$site_title = '';
		$site_logo = '';

		if ( function_exists( 'the_custom_logo' ) ) {
			$site_logo = get_custom_logo();
		}

		$site_title   = get_bloginfo( 'name' );
		$title_class  = $site_logo ? ' screen-reader-text' : false;

		if ( $site_logo ) {
			return;
		}
		if ( is_front_page() && is_home() ) {
		?>
			<h1 class="site-title<?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $site_title ); ?></a></h1>
			<?php cosparell_site_description(); ?>
		<?php } else { ?>
			<h2 class="site-title<?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $site_title ); ?></a></h2>
			<?php cosparell_site_description(); ?>
		<?php
		}
	}
}

if ( ! function_exists( 'cosparell_site_logo' ) ) {

	/**
	 * Displays Site Logo.
	 */
	function cosparell_site_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			$site_logo = get_custom_logo();
		}

		if ( ! $site_logo ) {
			return;
		}

		$site_logo_args = array(
			'a' => array(
				'href'      => array(),
				'class'     => array(),
				'rel'       => array(),
				'itemprop'  => array(),
			),
			'img' => array(
				'width'     => array(),
				'height'    => array(),
				'src'       => array(),
				'class'     => array(),
				'alt'       => array(),
				'itemprop'  => array(),
			),
		);

		echo wp_kses( $site_logo, $site_logo_args );
		cosparell_site_description();
	}
}

if ( ! function_exists( 'cosparell_primary_classes' ) ) {
	/**
	 * Adds Foundation classes to #primary section of all templates
	 *
	 * @param {bool} $more_classes More Classes.
	 * @param {bool} $override_foundation_classes Override Foundation Classes.
	 */
	function cosparell_primary_classes( $more_classes = false, $override_foundation_classes = false ) {
		$sidebar_postion = get_theme_mod( 'cosparell_sidebar_position' );

		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-8 medium-8 small-12 cell column';

		if ( 'left' === $sidebar_postion ) {
			$foundation_classes .= ' large-order-2 medium-order-2 small-order-1 ';
		} elseif ( 'right' === $sidebar_postion ) {
			$foundation_classes .= ' ';
		} elseif ( 'no_sidebar' === $sidebar_postion ) {
			$foundation_classes = ' large-12 medium-12 small-12 cell column ';
		}

		echo esc_html( apply_filters( 'cosparell_primary_classes', "cosparell-primary {$foundation_classes} {$more_classes} clearfix", $more_classes, $foundation_classes ) );
	}
}

if ( ! function_exists( 'cosparell_secondary_classes' ) ) {

	/**
	 * Adds Foundation classes to #primary section of all templates.
	 *
	 * @param bool $more_classes More Classes.
	 * @param bool $override_foundation_classes Override Foundation Classes.
	 */
	function cosparell_secondary_classes( $more_classes = false, $override_foundation_classes = false ) {
		// Override will be useful in page-templates.
		$sidebar_postion = get_theme_mod( 'cosparell_sidebar_position' );
		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-4 medium-4 small-12 cell column';
		$foundation_classes .= 'left' === $sidebar_postion ? ' large-order-1 medium-order-1 small-order-2' : false;
		$foundation_classes .= 'no_sidebar' === $sidebar_postion ? ' screen-reader-text' : false;

		echo esc_html( apply_filters( 'cosparell_secondary_classes', "cosparell-secondary widget-area {$foundation_classes} {$more_classes} clearfix", $more_classes, $foundation_classes ) );
	}
}

if ( ! function_exists( 'cosparell_copyright_text' ) ) {

	/**
	 * Returns the
	 *
	 * @return string
	 */
	function cosparell_copyright_text() {
		$theme_uri = 'http://supernovathemes.com';

		$default = sprintf( esc_html__( '%1$s by %2$s', 'cosparell' ), 'Theme Cosparell', '<a href="" rel="designer">Imran Sayed</a>' );

		$copyright_text = get_theme_mod( 'cosparell_copyright_text', $default );

		return $copyright_text;
	}
}
