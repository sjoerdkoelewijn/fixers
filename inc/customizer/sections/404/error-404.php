<?php
/**
 * Woocommerce shop single customizer
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Custom text.
$wp_customize->add_setting(
	'SKDD_setting[error_404_text]',
	array(
		'default'           => $defaults['error_404_text'],
		'sanitize_callback' => 'SKDD_sanitize_raw_html',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[error_404_text]',
		array(
			'label'    => __( 'Custom Text', 'SKDD' ),
			'type'     => 'textarea',
			'section'  => 'SKDD_error',
			'settings' => 'SKDD_setting[error_404_text]',
		)
	)
);

// Background.
$wp_customize->add_setting(
	'SKDD_setting[error_404_image]',
	array(
		'default'           => $defaults['error_404_image'],
		'type'              => 'option',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'SKDD_setting[error_404_image]',
		array(
			'label'    => __( 'Background', 'SKDD' ),
			'section'  => 'SKDD_error',
			'settings' => 'SKDD_setting[error_404_image]',
		)
	)
);
