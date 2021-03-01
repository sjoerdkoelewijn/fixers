<?php
/**
 * Heading typography
 *
 * @package roxtar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Default values.
$defaults = roxtar_options();

// Heading font family.
$wp_customize->add_setting(
	'roxtar_setting[heading_font_family]',
	array(
		'default'           => $defaults['heading_font_family'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

// Heading font family.
$wp_customize->add_setting(
	'heading_font_category',
	array(
		'default'           => $defaults['heading_font_category'],
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'option',
	)
);

// Heading font variants.
$wp_customize->add_setting(
	'heading_font_family_variants',
	array(
		'default'           => $defaults['heading_font_family_variants'],
		'sanitize_callback' => 'roxtar_sanitize_variants',
		'type'              => 'option',
	)
);

// Heading font weight.
$wp_customize->add_setting(
	'roxtar_setting[heading_font_weight]',
	array(
		'default'           => $defaults['heading_font_weight'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// Heading text transform.
$wp_customize->add_setting(
	'roxtar_setting[heading_font_transform]',
	array(
		'default'           => $defaults['heading_font_transform'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// Generate options.
$wp_customize->add_control(
	new Roxtar_Typography_Control(
		$wp_customize,
		'heading_typography',
		array(
			'section'  => 'heading_font_section',
			'label'    => __( 'Heading Font', 'roxtar' ),
			'settings' => array(
				'family'    => 'roxtar_setting[heading_font_family]',
				'variant'   => 'heading_font_family_variants',
				'category'  => 'heading_font_category',
				'weight'    => 'roxtar_setting[heading_font_weight]',
				'transform' => 'roxtar_setting[heading_font_transform]',
			),
		)
	)
);

// heading line height.
$wp_customize->add_setting(
	'roxtar_setting[heading_line_height]',
	array(
		'default'           => $defaults['heading_line_height'],
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[heading_line_height]',
		array(
			'type'        => 'roxtar-range-slider',
			'description' => __( 'Line Height', 'roxtar' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'roxtar_setting[heading_line_height]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_heading_line_height_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_heading_line_height_max_step', 20 ),
					'step' => 1,
					'edit' => true,
					'unit' => '',
				),
			),
		)
	)
);

// Heading font size divider.
$wp_customize->add_setting(
	'heading_font_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Divider_Control(
		$wp_customize,
		'heading_font_divider',
		array(
			'section'  => 'heading_font_section',
			'settings' => 'heading_font_divider',
			'type'     => 'divider',
		)
	)
);

// Heading font size title.
$wp_customize->add_setting(
	'heading_font_size_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'heading_font_size_title',
		array(
			'label'    => __( 'Font Size', 'roxtar' ),
			'section'  => 'heading_font_section',
			'settings' => 'heading_font_size_title',
			'type'     => 'hidden',
		)
	)
);

// h1.
$wp_customize->add_setting(
	'roxtar_setting[heading_h1_font_size]',
	array(
		'default'           => $defaults['heading_h1_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[heading_h1_font_size]',
		array(
			'type'        => 'roxtar-range-slider',
			'description' => __( 'H1', 'roxtar' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'roxtar_setting[heading_h1_font_size]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_heading_h1_font_size_min_step', 10 ),
					'max'  => apply_filters( 'roxtar_heading_h1_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// h2.
$wp_customize->add_setting(
	'roxtar_setting[heading_h2_font_size]',
	array(
		'default'           => $defaults['heading_h2_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[heading_h2_font_size]',
		array(
			'type'        => 'roxtar-range-slider',
			'description' => __( 'H2', 'roxtar' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'roxtar_setting[heading_h2_font_size]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_heading_h2_font_size_min_step', 10 ),
					'max'  => apply_filters( 'roxtar_heading_h2_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// h3.
$wp_customize->add_setting(
	'roxtar_setting[heading_h3_font_size]',
	array(
		'default'           => $defaults['heading_h3_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[heading_h3_font_size]',
		array(
			'type'        => 'roxtar-range-slider',
			'description' => __( 'H3', 'roxtar' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'roxtar_setting[heading_h3_font_size]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_heading_h3_font_size_min_step', 10 ),
					'max'  => apply_filters( 'roxtar_heading_h3_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// h4.
$wp_customize->add_setting(
	'roxtar_setting[heading_h4_font_size]',
	array(
		'default'           => $defaults['heading_h4_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[heading_h4_font_size]',
		array(
			'type'        => 'roxtar-range-slider',
			'description' => __( 'H4', 'roxtar' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'roxtar_setting[heading_h4_font_size]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_heading_h4_font_size_min_step', 10 ),
					'max'  => apply_filters( 'roxtar_heading_h4_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// h5.
$wp_customize->add_setting(
	'roxtar_setting[heading_h5_font_size]',
	array(
		'default'           => $defaults['heading_h5_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[heading_h5_font_size]',
		array(
			'type'        => 'roxtar-range-slider',
			'description' => __( 'H5', 'roxtar' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'roxtar_setting[heading_h5_font_size]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_heading_h5_font_size_min_step', 10 ),
					'max'  => apply_filters( 'roxtar_heading_h5_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// h6.
$wp_customize->add_setting(
	'roxtar_setting[heading_h6_font_size]',
	array(
		'default'           => $defaults['heading_h6_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[heading_h6_font_size]',
		array(
			'type'        => 'roxtar-range-slider',
			'description' => __( 'H6', 'roxtar' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'roxtar_setting[heading_h6_font_size]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_heading_h6_font_size_min_step', 10 ),
					'max'  => apply_filters( 'roxtar_heading_h6_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
