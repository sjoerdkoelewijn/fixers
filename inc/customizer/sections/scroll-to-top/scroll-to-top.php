<?php
/**
 * Footer widgets column
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Scroll to top.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top]',
	array(
		'default'           => $defaults['scroll_to_top'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top]',
		array(
			'label'    => __( 'Scroll To Top', 'SKDD' ),
			'settings' => 'SKDD_setting[scroll_to_top]',
			'section'  => 'SKDD_scroll_to_top',
		)
	)
);

// Scroll On.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top_on]',
	array(
		'default'           => $defaults['scroll_to_top_on'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top_on]',
		array(
			'label'    => __( 'Scroll On', 'SKDD' ),
			'section'  => 'SKDD_scroll_to_top',
			'settings' => 'SKDD_setting[scroll_to_top_on]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_scroll_to_top_on_choices',
				array(
					'default' => __( 'Mobile + Desktop', 'SKDD' ),
					'mobile'  => __( 'Mobile', 'SKDD' ),
					'desktop' => __( 'Desktop', 'SKDD' ),
				)
			),
		)
	)
);

// Scroll Position.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top_position]',
	array(
		'default'           => $defaults['scroll_to_top_position'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top_position]',
		array(
			'label'    => __( 'Position', 'SKDD' ),
			'section'  => 'SKDD_scroll_to_top',
			'settings' => 'SKDD_setting[scroll_to_top_position]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_sidebar_shop_single_choices',
				array(
					'right' => __( 'Right', 'SKDD' ),
					'left'  => __( 'Left', 'SKDD' ),
				)
			),
		)
	)
);

// Scroll To Top Background.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top_background]',
	array(
		'default'           => $defaults['scroll_to_top_background'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top_background]',
		array(
			'label'    => __( 'Background', 'SKDD' ),
			'section'  => 'SKDD_scroll_to_top',
			'settings' => 'SKDD_setting[scroll_to_top_background]',
		)
	)
);

// Scroll To Top Color.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top_color]',
	array(
		'default'           => $defaults['scroll_to_top_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top_color]',
		array(
			'label'    => __( 'Color', 'SKDD' ),
			'section'  => 'SKDD_scroll_to_top',
			'settings' => 'SKDD_setting[scroll_to_top_color]',
		)
	)
);

// Icons Size.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top_icon_size]',
	array(
		'default'           => $defaults['scroll_to_top_icon_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top_icon_size]',
		array(
			'label'    => __( 'Icon Size', 'SKDD' ),
			'section'  => 'SKDD_scroll_to_top',
			'settings' => array(
				'desktop' => 'SKDD_setting[scroll_to_top_icon_size]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_scroll_to_top_icon_size_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_scroll_to_top_icon_size_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);


// Scroll to top Border radius.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top_border_radius]',
	array(
		'default'           => $defaults['scroll_to_top_border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'SKDD' ),
			'section'  => 'SKDD_scroll_to_top',
			'settings' => array(
				'desktop' => 'SKDD_setting[scroll_to_top_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_scroll_to_top_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_scroll_to_top_border_radius_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Offset Bottom.
$wp_customize->add_setting(
	'SKDD_setting[scroll_to_top_offset_bottom]',
	array(
		'default'           => $defaults['scroll_to_top_offset_bottom'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[scroll_to_top_offset_bottom]',
		array(
			'label'    => __( 'Offset Bottom', 'SKDD' ),
			'section'  => 'SKDD_scroll_to_top',
			'settings' => array(
				'desktop' => 'SKDD_setting[scroll_to_top_offset_bottom]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_scroll_to_top_offset_bottom_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_scroll_to_top_offset_bottom_max_step', 700 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
