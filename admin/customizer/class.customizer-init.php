<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since cosparell 1.0
 * @package cosparell
 */

if ( ! class_exists( 'COSPARELL_Customizer' ) ) {

	/**
	 * Class COSPARELL_Customizer
	 */
	class COSPARELL_Customizer {

		/**
		 * COSPARELL_Customizer constructor.
		 */
		public function __construct() {

			// Setup the Theme Customizer settings and controls.
			add_action( 'customize_register', array( $this, 'register' ) );

			// Enqueue live preview javascript in Theme Customizer admin screen.
			add_action( 'customize_preview_init', array( $this, 'live_preview' ) );

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'load_customizer_controls_scripts' ) );

		}

		/**
		 * This hooks into 'customize_register' (available as of WP 3.4) and allows
		 * you to add new sections and controls to the Theme Customize screen.
		 *
		 * Note: To enable instant preview, we have to actually write a bit of custom
		 * javascript. See live_preview() for more.
		 *
		 * @see add_action('customize_register',$func)
		 * @param {array} $wp_customize WP_Customize_Manager.
		 * @since cosparell 1.0
		 */
			public static function register( $wp_customize ) {

				$file_path = COSPARELL_CUSTOMIZER_DIR . '/customizer-settings.php';

				if ( file_exists( $file_path ) ) {
					include_once $file_path;
				}
			}

		/**
		 * This outputs the javascript needed to automate the live settings preview.
		 * Also keep in mind that this function isn't necessary unless your settings
		 * are using 'transport'=>'postMessage' instead of the default 'transport'
		 * => 'refresh'
		 *
		 * Used by hook: 'customize_preview_init'
		 *
		 * @see add_action('customize_preview_init',$func)
		 * @since cosparell 1.0
		 */
			public static function live_preview() {

				wp_enqueue_script( 'cosparell-themecustomizer',
					COSPARELL_CUSTOMIZER_JS . '/customizer-live-preview.js',
					array( 'jquery', 'customize-preview' ),
					'1.0',
					true
				);
			}

		/**
		 * Loads customizer Scripts.
		 */
		public function load_customizer_controls_scripts() {

			wp_enqueue_script(
				'cosparell-customizer-control-scripts',
				COSPARELL_CUSTOMIZER_JS . '/customizer-control.js',
				array( 'jquery' ),
				'1.0',
				true
			);

		}
	}
}

new COSPARELL_Customizer();
