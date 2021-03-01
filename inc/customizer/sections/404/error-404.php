<?php
/**
 * Woocommerce shop single customizer
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Custom text.
$wp_customize->add_setting(
	'roxtar_setting[error_404_text]',
	array(
		'default'           => $defaults['error_404_text'],
		'sanitize_callback' => 'roxtar_sanitize_raw_html',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[error_404_text]',
		array(
			'label'    => __( 'Custom Text', 'roxtar' ),
			'type'     => 'textarea',
			'section'  => 'roxtar_error',
			'settings' => 'roxtar_setting[error_404_text]',
		)
	)
);

// Background.
$wp_customize->add_setting(
	'roxtar_setting[error_404_image]',
	array(
		'default'           => $defaults['error_404_image'],
		'type'              => 'option',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'roxtar_setting[error_404_image]',
		array(
			'label'    => __( 'Background', 'roxtar' ),
			'section'  => 'roxtar_error',
			'settings' => 'roxtar_setting[error_404_image]',
		)
	)
);
