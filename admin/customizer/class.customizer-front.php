<?php

/**
 * Handles frontend
 */

class COSPARELL_Customizer_Front
{

	public function __construct() {

	}

	/**
	 * Generates all css
	 * @return css output
	 */
	public static function custom_css() {

		//Background image and background color is handled by wordpress

		do_action( 'canis_customizer_custom_css' );
	}
}

new COSPARELL_Customizer_Front();
