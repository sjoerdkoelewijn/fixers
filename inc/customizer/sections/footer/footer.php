<?php
/**
 * Footer widgets column
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Footer display.
$wp_customize->add_setting(
	'SKDD_setting[footer_display]',
	array(
		'default'           => $defaults['footer_display'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[footer_display]',
		array(
			'label'    => __( 'Footer Display', 'SKDD' ),
			'settings' => 'SKDD_setting[footer_display]',
			'section'  => 'SKDD_footer',
		)
	)
);

// Space.
$wp_customize->add_setting(
	'SKDD_setting[footer_space]',
	array(
		'default'           => $defaults['footer_space'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[footer_space]',
		array(
			'label'    => __( 'Space', 'SKDD' ),
			'section'  => 'SKDD_footer',
			'settings' => array(
				'desktop' => 'SKDD_setting[footer_space]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_footer_space_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_footer_space_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Footer text divider.
$wp_customize->add_setting(
	'footer_text_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'footer_text_divider',
		array(
			'section'  => 'SKDD_footer',
			'settings' => 'footer_text_divider',
			'type'     => 'divider',
		)
	)
);



