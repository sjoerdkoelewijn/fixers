<?php
/**
 * Button typography
 *
 * @package SKDD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Default values.
$defaults = SKDD_options();


$wp_customize->add_setting(
	'button_fonts',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'team_divider',
		array(
			'section'  => 'SKDD_buttons',
			'settings' => 'team_divider',
			'type'     => 'divider',
		)
	)
);

// button font family.
$wp_customize->add_setting(
	'SKDD_setting[button_font_family]',
	array(
		'default'           => $defaults['button_font_family'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

// button font category.
$wp_customize->add_setting(
	'button_font_category',
	array(
		'default'           => $defaults['button_font_category'],
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'option',
	)
);

// font font variants.
$wp_customize->add_setting(
	'button_font_family_variants',
	array(
		'default'           => $defaults['button_font_family_variants'],
		'sanitize_callback' => 'SKDD_sanitize_variants',
		'type'              => 'option',
	)
);

// button font weight.
$wp_customize->add_setting(
	'SKDD_setting[button_font_weight]',
	array(
		'default'           => $defaults['button_font_weight'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// button text transform.
$wp_customize->add_setting(
	'SKDD_setting[button_font_transform]',
	array(
		'default'           => $defaults['button_font_transform'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// add control for button typography.
$wp_customize->add_control(
	new SKDD_Typography_Control(
		$wp_customize,
		'button_typography',
		array(
			'section'  => 'SKDD_buttons',
			'label'    => __( 'Button Font', 'SKDD' ),
			'settings' => array(
				'family'    => 'SKDD_setting[button_font_family]',
				'variant'   => 'button_font_family_variants',
				'category'  => 'button_font_category',
				'weight'    => 'SKDD_setting[button_font_weight]',
				'transform' => 'SKDD_setting[button_font_transform]',
			),
		)
	)
);

// button font size.
$wp_customize->add_setting(
	'SKDD_setting[button_font_size]',
	array(
		'default'           => $defaults['button_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[button_font_size]',
		array(
			'type'     => 'SKDD-range-slider',
			'label'    => __( 'Font Size', 'SKDD' ),
			'section'  => 'SKDD_buttons',
			'settings' => array(
				'desktop' => 'SKDD_setting[button_font_size]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_button_font_size_min_step', 5 ),
					'max'  => apply_filters( 'SKDD_button_font_size_max_step', 60 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// button line height.
$wp_customize->add_setting(
	'SKDD_setting[button_line_height]',
	array(
		'default'           => $defaults['button_line_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[button_line_height]',
		array(
			'type'           => 'SKDD-range-slider',
			'description'    => __( 'Line Height', 'SKDD' ),
			'section'        => 'SKDD_buttons',
			'settings'       => array(
				'desktop' => 'SKDD_setting[button_line_height]',
			),
			'choices'        => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_button_line_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_button_line_height_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
