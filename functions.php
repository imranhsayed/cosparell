<?php
/**
 * cosparell functions and definitions
 *
 * @package cosparell
 */

if ( ! defined( 'COSPARELL_VERSION' ) ) {
	define( 'COSPARELL_VERSION', 1.0 );
}
if ( ! defined( 'COSPARELL_TEMP_URI' ) ) {
	define( 'COSPARELL_TEMP_URI', get_template_directory_uri() );
}
if ( ! defined( 'COSPARELL_TEMP_DIR' ) ) {
	define( 'COSPARELL_TEMP_DIR', get_template_directory() );
}
if ( ! defined( 'COSPARELL_CSS_URI' ) ) {
	define( 'COSPARELL_CSS_URI', COSPARELL_TEMP_URI . '/css' );
}
if ( ! defined( 'COSPARELL_JS_URI' ) ) {
	define( 'COSPARELL_JS_URI', COSPARELL_TEMP_URI . '/js' );
}
if ( ! defined( 'COSPARELL_IMG_URI' ) ) {
	define( 'COSPARELL_IMG_URI', COSPARELL_TEMP_URI . '/images' );
}
if ( ! defined( 'COSPARELL_IS_DEV' ) ) {
	define( 'COSPARELL_IS_DEV', true );
}

do_action( 'cosparell_before' );



/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}



/**
 * Required: set 'cosparell_theme_mode' filter to true.
 */
add_filter( 'cosparell_theme_mode', '__return_true' ); 
add_filter( 'cosparell_show_pages', '__return_false' );//comment out this code to bring back Option tree settings



if ( ! function_exists( 'cosparell_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cosparell_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cosparell, use a find and replace
	 * to change 'cosparell' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cosparell', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array( 'header-text' => array( 'site-title', 'site-description' ) ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//FOR FEATURED IMAGE
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cosparell' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cosparell_custom_background_args', array(
		'default-color' => 'e6e7e9',
		'default-image' => '',
	) ) );

	//registering image size of side-thumb
	add_image_size( 'cosparell-side-thumb',74,74 );

	add_editor_style( array( 'editor-style.css', cosparell_main_font_url() ) );

}
endif; // cosparell_setup
add_action( 'after_setup_theme', 'cosparell_setup' );

if ( ! function_exists( 'cosparell_main_font_url' ) ) {
	/**
	 * Returns the main font url of the theme, we are returning it from a function to handle two things
	 * one is to handle the http problems and the other is so that we can also load it to post editor.
	 * @return string font url
	 */
	function cosparell_main_font_url() {
		/**
		 * Use font url without http://, we do this because google font without https have
		 * problem loading on websites with https.
		 * @var font_url
		 */
		$font_url = 'fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700';

		return ( substr( site_url(), 0, 8 ) === 'https://') ? 'https://' . $font_url : 'http://' . $font_url;
	}
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cosparell_widgets_init() {
	//To register sidebar widgets
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cosparell' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	//To register footer widgets
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'cosparell' ),
		'id'            => 'footer-widgets',
		'description'   => __('I will show at the footer', 'cosparell'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );


}
add_action( 'widgets_init', 'cosparell_widgets_init' );

//Function to increase the font-size of Tag Widget
add_filter('widget_tag_cloud_args','cosparell_set_tag_cloud_sizes');
function cosparell_set_tag_cloud_sizes($args)
{
	$args['smallest'] = 12;
	$args['largest'] = 19;

	return $args; 
}


/*==============================
          FILE INCLUDES
===============================*/

$cosparell_depedencies = apply_filters( 'cosparell_depedencies', array(
	COSPARELL_TEMP_DIR . '/inc/*.php',
	COSPARELL_TEMP_DIR . '/admin/*.php',
));

foreach ( $cosparell_depedencies as $path ) {
	foreach ( glob( $path ) as $filename ) {
		include $filename;
	}
}

do_action( 'cosparell_after' );