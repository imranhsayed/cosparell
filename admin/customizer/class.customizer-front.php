<?php
/**
 * Handles frontend.
 *
 * @package cosparell
 */

/**
 * Class COSPARELL_Customizer_Front
 */
class COSPARELL_Customizer_Front {

	/**
	 * COSPARELL_Customizer_Front constructor.
	 */
	public function __construct() {

	}

	/**
	 * Generates all CSS.
	 */
	public static function custom_css() {

		// Background image and background color is handled by wordpress.
		do_action( 'canis_customizer_custom_css' );
	}
}

new COSPARELL_Customizer_Front();
