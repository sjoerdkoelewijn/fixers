<?php
/**
 * Primary menu typography
 *
 * @package SKDD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Default values.
$defaults = SKDD_options();

// menu font family.
$wp_customize->add_setting(
	'SKDD_setting[menu_font_family]',
	array(
		'default'           => $defaults['menu_font_family'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

// menu font category.
$wp_customize->add_setting(
	'menu_font_category',
	array(
		'default'           => $defaults['menu_font_category'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

// font font variants.
$wp_customize->add_setting(
	'menu_font_family_variants',
	array(
		'default'           => $defaults['menu_font_family_variants'],
		'sanitize_callback' => 'SKDD_sanitize_variants',
	)
);

// menu font weight.
$wp_customize->add_setting(
	'SKDD_setting[menu_font_weight]',
	array(
		'default'           => $defaults['menu_font_weight'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// menu text transform.
$wp_customize->add_setting(
	'SKDD_setting[menu_font_transform]',
	array(
		'default'           => $defaults['menu_font_transform'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);

// add control for menu typography.
$wp_customize->add_control(
	new SKDD_Typography_Control(
		$wp_customize,
		'menu_typography',
		array(
			'section'  => 'menu_font_section',
			'label'    => __( 'Menu Font', 'SKDD' ),
			'settings' => array(
				'family'    => 'SKDD_setting[menu_font_family]',
				'variant'   => 'menu_font_family_variants',
				'category'  => 'menu_font_category',
				'weight'    => 'SKDD_setting[menu_font_weight]',
				'transform' => 'SKDD_setting[menu_font_transform]',
			),
		)
	)
);

// Parent menu divider.
$wp_customize->add_setting(
	'parent_menu_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'parent_menu_divider',
		array(
			'section'  => 'menu_font_section',
			'settings' => 'parent_menu_divider',
			'type'     => 'divider',
		)
	)
);

// CUSTOM HEADING.
$wp_customize->add_setting(
	'parent_menu_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'parent_menu_title',
		array(
			'label'    => __( 'Parent Menu', 'SKDD' ),
			'section'  => 'menu_font_section',
			'settings' => 'parent_menu_title',
			'type'     => 'hidden',
		)
	)
);

// parent menu font size.
$wp_customize->add_setting(
	'SKDD_setting[parent_menu_font_size]',
	array(
		'default'           => $defaults['parent_menu_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[parent_menu_font_size_tablet]',
	array(
		'default'           => $defaults['parent_menu_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[parent_menu_font_size_mobile]',
	array(
		'default'           => $defaults['parent_menu_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);



$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[parent_menu_font_size]',
		array(
			'type'           => 'skdd-range-slider',
			'description'    => __( 'Font Size', 'SKDD' ),
			'section'        => 'menu_font_section',
			'settings'       => array(
				'desktop' => 'SKDD_setting[parent_menu_font_size]',
				'tablet' => 'SKDD_setting[parent_menu_font_size_tablet]',
				'mobile' => 'SKDD_setting[parent_menu_font_size_mobile]',
			),
			'choices'        => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_parent_menu_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_parent_menu_font_size_max_step', 60 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_parent_menu_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_parent_menu_font_size_max_step', 60 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_parent_menu_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_parent_menu_font_size_max_step', 60 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// parent menu line height.
$wp_customize->add_setting(
	'SKDD_setting[parent_menu_line_height]',
	array(
		'default'           => $defaults['parent_menu_line_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[parent_menu_line_height_tablet]',
	array(
		'default'           => $defaults['parent_menu_line_height_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[parent_menu_line_height_mobile]',
	array(
		'default'           => $defaults['parent_menu_line_height_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[parent_menu_line_height]',
		array(
			'type'           => 'skdd-range-slider',
			'description'    => __( 'Line Height', 'SKDD' ),
			'section'        => 'menu_font_section',
			'settings'       => array(
				'desktop' => 'SKDD_setting[parent_menu_line_height]',
				'tablet' => 'SKDD_setting[parent_menu_line_height_tablet]',
				'mobile' => 'SKDD_setting[parent_menu_line_height_mobile]',
			),
			'choices'        => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_parent_menu_line_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_parent_menu_line_height_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_parent_menu_line_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_parent_menu_line_height_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_parent_menu_line_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_parent_menu_line_height_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);


// Menu letter spacing.
$wp_customize->add_setting(
	'SKDD_setting[menu_letter_spacing]',
	array(
		'default'           => $defaults['menu_letter_spacing'],
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[menu_letter_spacing]',
		array(
			'type'           => 'skdd-range-slider',
			'description'    => __( 'Letter Spacing', 'SKDD' ),
			'section'        => 'menu_font_section',
			'settings'       => array(
				'desktop' => 'SKDD_setting[menu_letter_spacing]',
			),
			'choices'        => array(
				'desktop' => array(
					'min'  => apply_filters( 'menu_letter_spacing_space_min_step', -2 ),
					'max'  => apply_filters( 'menu_letter_spacing_max_step', 2 ),
					'step' => 0.01,
					'edit' => true,
					'unit' => 'em',
				),
			),
		)
	)
);


// Submenu divider.
$wp_customize->add_setting(
	'sub_menu_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'sub_menu_divider',
		array(
			'section'  => 'menu_font_section',
			'settings' => 'sub_menu_divider',
			'type'     => 'divider',
		)
	)
);

// CUSTOM HEADING.
$wp_customize->add_setting(
	'sub_menu_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'sub_menu_title',
		array(
			'label'    => __( 'Sub Menu', 'SKDD' ),
			'section'  => 'menu_font_section',
			'settings' => 'sub_menu_title',
			'type'     => 'hidden',
		)
	)
);

// sub menu font size.
$wp_customize->add_setting(
	'SKDD_setting[sub_menu_font_size]',
	array(
		'default'           => $defaults['sub_menu_font_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

// sub menu font size.
$wp_customize->add_setting(
	'SKDD_setting[sub_menu_font_size_tablet]',
	array(
		'default'           => $defaults['sub_menu_font_size_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

// sub menu font size.
$wp_customize->add_setting(
	'SKDD_setting[sub_menu_font_size_mobile]',
	array(
		'default'           => $defaults['sub_menu_font_size_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[sub_menu_font_size]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'Font Size', 'SKDD' ),
			'section'     => 'menu_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[sub_menu_font_size]',
				'tablet' => 'SKDD_setting[sub_menu_font_size_tablet]',
				'mobile' => 'SKDD_setting[sub_menu_font_size_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_sub_menu_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_sub_menu_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_sub_menu_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_sub_menu_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_sub_menu_font_size_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_sub_menu_font_size_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// sub menu line height.
$wp_customize->add_setting(
	'SKDD_setting[sub_menu_line_height]',
	array(
		'default'           => $defaults['sub_menu_line_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[sub_menu_line_height_tablet]',
	array(
		'default'           => $defaults['sub_menu_line_height_tablet'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[sub_menu_line_height_mobile]',
	array(
		'default'           => $defaults['sub_menu_line_height_mobile'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[sub_menu_line_height]',
		array(
			'type'        => 'skdd-range-slider',
			'description' => __( 'Line Height', 'SKDD' ),
			'section'     => 'menu_font_section',
			'settings'    => array(
				'desktop' => 'SKDD_setting[sub_menu_line_height]',
				'tablet' => 'SKDD_setting[sub_menu_line_height_tablet]',
				'mobile' => 'SKDD_setting[sub_menu_line_height_mobile]',
			),
			'choices'     => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_sub_menu_line_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_sub_menu_line_height_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_sub_menu_line_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_sub_menu_line_height_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_sub_menu_line_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_sub_menu_line_height_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
