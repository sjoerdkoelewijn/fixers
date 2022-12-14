<?php
/**
 * Heading typography
 *
 * @package SKDD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Default values.
$defaults = SKDD_options();

// Heading font family.
$wp_customize->add_setting(
	'SKDD_setting[heading_font_family]',
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
		'sanitize_callback' => 'SKDD_sanitize_variants',
		'type'              => 'option',
	)
);

// Heading font weight.
$wp_customize->add_setting(
	'SKDD_setting[heading_font_weight]',
	array(
		'default'           => $defaults['heading_font_weight'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// Heading text transform.
$wp_customize->add_setting(
	'SKDD_setting[heading_font_transform]',
	array(
		'default'           => $defaults['heading_font_transform'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// Generate options.
$wp_customize->add_control(
	new SKDD_Typography_Control(
		$wp_customize,
		'heading_typography',
		array(
			'section'  => 'heading_font_section',
			'label'    => __( 'Heading Font', 'SKDD' ),
			'settings' => array(
				'family'    => 'SKDD_setting[heading_font_family]',
				'variant'   => 'heading_font_family_variants',
				'category'  => 'heading_font_category',
				'weight'    => 'SKDD_setting[heading_font_weight]',
				'transform' => 'SKDD_setting[heading_font_transform]',
			),
		)
	)
);

// heading line height.
$wp_customize->add_setting(
	'SKDD_setting[heading_line_height]',
	array(
		'default'           => $defaults['heading_line_height'],
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[heading_line_height]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'Line Height', 'SKDD' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[heading_line_height]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_heading_line_height_min_step', 100 ),
					'max'  => apply_filters( 'SKDD_heading_line_height_max_step', 200 ),
					'step' => 10,
					'edit' => true,
					'unit' => '%',
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
	new SKDD_Divider_Control(
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
			'label'    => __( 'Font Size', 'SKDD' ),
			'section'  => 'heading_font_section',
			'settings' => 'heading_font_size_title',
			'type'     => 'hidden',
		)
	)
);

// h1.
$wp_customize->add_setting(
	'SKDD_setting[heading_h1_font_size]',
	array(
		'default'           => $defaults['heading_h1_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h1_font_size_tablet]',
	array(
		'default'           => $defaults['heading_h1_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h1_font_size_mobile]',
	array(
		'default'           => $defaults['heading_h1_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[heading_h1_font_size]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'H1', 'SKDD' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[heading_h1_font_size]',
				'tablet' => 'SKDD_setting[heading_h1_font_size_tablet]',
				'mobile' => 'SKDD_setting[heading_h1_font_size_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_heading_h1_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h1_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_heading_h1_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h1_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_heading_h1_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h1_font_size_max_step', 100 ),
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
	'SKDD_setting[heading_h2_font_size]',
	array(
		'default'           => $defaults['heading_h2_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h2_font_size_tablet]',
	array(
		'default'           => $defaults['heading_h2_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h2_font_size_mobile]',
	array(
		'default'           => $defaults['heading_h2_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[heading_h2_font_size]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'H2', 'SKDD' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[heading_h2_font_size]',
				'tablet' => 'SKDD_setting[heading_h2_font_size_tablet]',
				'mobile' => 'SKDD_setting[heading_h2_font_size_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_heading_h2_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h2_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_heading_h2_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h2_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_heading_h2_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h2_font_size_max_step', 100 ),
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
	'SKDD_setting[heading_h3_font_size]',
	array(
		'default'           => $defaults['heading_h3_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h3_font_size_tablet]',
	array(
		'default'           => $defaults['heading_h3_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h3_font_size_mobile]',
	array(
		'default'           => $defaults['heading_h3_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[heading_h3_font_size]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'H3', 'SKDD' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[heading_h3_font_size]',
				'tablet' => 'SKDD_setting[heading_h3_font_size_tablet]',
				'mobile' => 'SKDD_setting[heading_h3_font_size_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_heading_h3_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h3_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_heading_h3_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h3_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_heading_h3_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h3_font_size_max_step', 100 ),
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
	'SKDD_setting[heading_h4_font_size]',
	array(
		'default'           => $defaults['heading_h4_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h4_font_size_tablet]',
	array(
		'default'           => $defaults['heading_h4_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h4_font_size_mobile]',
	array(
		'default'           => $defaults['heading_h4_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[heading_h4_font_size]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'H4', 'SKDD' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[heading_h4_font_size]',
				'tablet' => 'SKDD_setting[heading_h4_font_size_tablet]',
				'mobile' => 'SKDD_setting[heading_h4_font_size_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_heading_h4_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h4_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_heading_h4_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h4_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_heading_h4_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h4_font_size_max_step', 100 ),
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
	'SKDD_setting[heading_h5_font_size]',
	array(
		'default'           => $defaults['heading_h5_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h5_font_size_tablet]',
	array(
		'default'           => $defaults['heading_h5_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[heading_h5_font_size_mobile]',
	array(
		'default'           => $defaults['heading_h5_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[heading_h5_font_size]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'H5', 'SKDD' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[heading_h5_font_size]',
				'tablet' => 'SKDD_setting[heading_h5_font_size_tablet]',
				'mobile' => 'SKDD_setting[heading_h5_font_size_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_heading_h5_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h5_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_heading_h5_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h5_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_heading_h5_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h5_font_size_max_step', 100 ),
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
	'SKDD_setting[heading_h6_font_size]',
	array(
		'default'           => $defaults['heading_h6_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'SKDD_setting[heading_h6_font_size_tablet]',
	array(
		'default'           => $defaults['heading_h6_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'SKDD_setting[heading_h6_font_size_mobile]',
	array(
		'default'           => $defaults['heading_h6_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[heading_h6_font_size]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'H6', 'SKDD' ),
			'section'     => 'heading_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[heading_h6_font_size]',
				'tablet' => 'SKDD_setting[heading_h6_font_size_tablet]',
				'mobile' => 'SKDD_setting[heading_h6_font_size_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_heading_h6_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h6_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_heading_h6_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h6_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_heading_h6_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_heading_h6_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
