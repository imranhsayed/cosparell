<?php
/**
 * Contains Custom functions for Customizer.
 *
 * @package Cosparell
 */

if ( ! function_exists( 'cosparell_pages_array' ) ) {
	/**
	 * Fetches all pages
	 *
	 * @return array pages
	 */
	function cosparell_pages_array() {

		$args = array(
			'posts_per_page' => 100,
			'offset'         => 0,
			'post_type'      => 'page',
			'post_status'    => 'publish',
		);

		$query = new WP_Query( apply_filters( 'cosparell_customizer_list_pages', $args ) );

		$posts = $query->posts;

		$pages_array = array();

		if ( is_array( $posts ) ) {
			foreach ( $posts as $post ) {
				$pages_array[ $post->ID ] = $post->post_title;
			}
		}

		return $pages_array;

	}
}

if ( ! function_exists( 'cosparell_category_array' ) ) {
	/**
	 * Fetches all category
	 *
	 * @return array categories
	 */
	function cosparell_category_array() {

		$args = array(
			'posts_per_page' => 100,
			'child_of'       => 0,
			'orderby'        => 'name',
			'order'          => 'ASC',
			'hide_empty'     => 1,
			'hierarchical'   => 1,
			'taxonomy'       => 'category',
			'pad_counts'     => false,
		);

		$categories = get_categories( apply_filters( 'cosparell_customizer_list_categories', $args ) );

		if ( is_array( $categories ) ) {
			foreach ( $categories as $category ) {
				$cat_array[ $category->term_id ] = $category->cat_name;
			}
		}

		return $cat_array;

	}
}


if ( ! function_exists( 'cosparell_generate_css' ) ) {
	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 *
	 * @param {string}       $selector CSS selector.
	 * @param {string/array} $style The name of the CSS *property* to modify.
	 * @param {string/array} $mod_name The name of the 'theme_mod' option to fetch.
	 * @param {string/array} $prefix Optional. Anything that needs to be output before the CSS property.
	 * @param {string/array} $postfix Optional. Anything that needs to be output after the CSS property.
	 * @param {string/array} $default Default.
	 * @param {string/array} $echo Echo.
	 * @return {string} Returns a single line of CSS with selectors and a property.
	 * @since cosparell theme 1.0
	 */
	function cosparell_generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $default = false, $echo = true ) {

		$return = '';

		$selector = is_array( $selector ) ? join( ',', $selector ) : $selector;

		if ( is_array( $style ) && is_array( $mod_name ) ) {
			$return .= $selector . '{';
			foreach ( $style as $key => $property ) {
				$mod = is_array( $default ) ? get_theme_mod( $mod_name[ $key ], $default[ $key ] ) : get_theme_mod( $mod_name[ $key ], $default );
				$this_prefix  = is_array( $prefix ) ? $prefix[ $key ] : $prefix;
				$this_postfix = is_array( $postfix ) ? $postfix[ $key ] : $postfix;
				$return .= ( isset( $mod ) && ! empty( $mod ) ) ?
						   sprintf( '%s:%s;', $property, $this_prefix . $mod . $this_postfix ) :
						   false;
			}
			$return .= '}';
		} else {
			$mod = get_theme_mod( $mod_name, $default );
			$return = ( isset( $mod ) && ! empty( $mod ) ) ?
					  sprintf( '%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix ) :
					  false;
		}

		if ( $echo ) {
			echo $return;
		} else {
			return $return;
		}
	}
}



if ( ! function_exists( 'cosparell_sanitize_choices' ) ) {
	/**
	 * Used for sanitizing radio or select options in customizer
	 *
	 * @param {mixed} $input User input.
	 * @param {mixed} $setting Choices provied to the user.
	 * @return {mixed} Output after sanitization
	 */
	function cosparell_sanitize_choices( $input, $setting ) {
		global $wp_customize;

		$control = $wp_customize->get_control( $setting->id );

		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

if ( ! function_exists( 'cosparell_sanitize_checkboxes' ) ) {
	/**
	 * Sanitizes checkbox for customizer
	 *
	 * @param {int} $input Input.
	 *
	 * @return int Either 1 or 0
	 */
	function cosparell_sanitize_checkboxes( $input ) {
		$input = intval( $input );
		if ( 1 === $input ) {
			return 1;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'cosparell_allow_all' ) ) {
	/**
	 * Cosparell Allow all.
	 *
	 * @param {int} $input Input.
	 *
	 * @return mixed
	 */
	function cosparell_allow_all( $input ) {
		return $input;
	}
}
