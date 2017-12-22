<?php
/**
 * The Slider Settings
 *
 * This file is placed under customizer-settings.php to enable slider settings.
 * And slider.php file is called where we want to display slider
 *
 * @package cosparell
 */

/**
 * Slider
 */
$wp_customize->add_panel(
	 'cosparell_pannel', array(
		 'priority'       => 10,
		 'capability'     => 'edit_theme_options',
		 'title'          => __( 'Slider Options', 'cosparell' ),
		 'description'    => __( 'Add slider', 'cosparell' ),
	 )
	);

for ( $i = 1; $i <= 8; $i++ ) {
	$wp_customize->add_section(
		 'cosparell_section_' . $i, array(
			 'priority'       => 10,
			 'capability'     => 'edit_theme_options',
			 /* translators: %s: $i */
			 'title'          => sprintf( __( 'Slide %s', 'cosparell' ), $i ),
			 'description'    => __( 'Add slide', 'cosparell' ),
			 'panel'          => 'cosparell_pannel',
		 )
		);

	$wp_customize->add_setting(
		 'cosparell_slides[' . $i . '][title]', array(
			 'default'           => '',
			 'sanitize_callback' => 'sanitize_text_field',
			 'capability'        => 'edit_theme_options',
		 )
		);

	$wp_customize->add_control(
		 'cosparell_slides[' . $i . '][title]', array(
			 'priority' => 10,
			 'section'  => 'cosparell_section_' . $i,
			 'label'    => __( 'Title', 'cosparell' ),
			 'settings' => 'cosparell_slides[' . $i . '][title]',
		 )
		);

	$wp_customize->add_setting(
		 'cosparell_slides[' . $i . '][description]', array(
			 'default'           => '',
			 'sanitize_callback' => 'sanitize_text_field',
			 'capability'        => 'edit_theme_options',
		 )
		);

	$wp_customize->add_control(
		 'cosparell_slides[' . $i . '][description]', array(
			 'priority' => 10,
			 'section'  => 'cosparell_section_' . $i,
			 'label'    => __( 'Description', 'cosparell' ),
			 'settings' => 'cosparell_slides[' . $i . '][description]',
		 )
		);

	$wp_customize->add_setting(
		 'cosparell_slides[' . $i . '][link]', array(
			 'default'           => '',
			 'sanitize_callback' => 'esc_url_raw',
			 'capability'        => 'edit_theme_options',
		 )
		);

	$wp_customize->add_control(
		 'cosparell_slides[' . $i . '][link]', array(
			 'priority' => 10,
			 'section'  => 'cosparell_section_' . $i,
			 'label'    => __( 'Link', 'cosparell' ),
			 'settings' => 'cosparell_slides[' . $i . '][link]',
		 )
		);

	$wp_customize->add_setting(
		 'cosparell_slides[' . $i . '][image]', array(
			 'default'           => '',
			 'sanitize_callback' => 'esc_url_raw',
			 'capability'        => 'edit_theme_options',
		 )
		);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		 $wp_customize, 'cosparell_slides[' . $i . '][image]', array(
			 'priority' => 10,
			 'section'  => 'cosparell_section_' . $i,
			 'label'    => __( 'Image', 'cosparell' ),
			 'settings' => 'cosparell_slides[' . $i . '][image]',
		 )
		)
		);

}
