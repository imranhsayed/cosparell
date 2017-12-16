<?php
/**
 * canis Admin loads from here.
 * @package cosparell
 */

//Enter the path where you have put the admin folder.
define( 'COSPARELL_ADMIN_FOLDER_PATH', '/admin' );

define( 'COSPARELL_ADMIN_DIR' , get_template_directory() . COSPARELL_ADMIN_FOLDER_PATH );
define( 'COSPARELL_ADMIN_URI' , get_template_directory_uri() . COSPARELL_ADMIN_FOLDER_PATH );
define( 'COSPARELL_CUSTOMIZER_URI' , COSPARELL_ADMIN_DIR . '/customizer' );
define( 'COSPARELL_CUSTOMIZER_DIR' , COSPARELL_ADMIN_DIR . '/customizer' );
define( 'COSPARELL_CUSTOMIZER_JS' , COSPARELL_ADMIN_URI . '/customizer/js' );
define( 'COSPARELL_CUSTOMIZER_CSS' , COSPARELL_ADMIN_URI . '/customizer/css' );
define( 'COSPARELL_KIRKI_DIR' , COSPARELL_ADMIN_DIR . '/kirki' );

$files_to_include = array(

	//Customzier
	COSPARELL_CUSTOMIZER_DIR . '/customizer-functions.php',
	COSPARELL_CUSTOMIZER_DIR . '/class.customizer-init.php',
	COSPARELL_CUSTOMIZER_DIR . '/class.customizer-front.php',

	//Kirki
	// COSPARELL_KIRKI_DIR . '/kirki.php',
	// COSPARELL_KIRKI_DIR . '/kirki-settings.php',

);

//Loading Files
foreach ( $files_to_include as $file_path ) {
	if ( file_exists( $file_path ) ) {
		include_once $file_path;
	}
}
