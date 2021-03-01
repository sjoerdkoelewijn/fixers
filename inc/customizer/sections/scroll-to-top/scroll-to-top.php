<?php
/**
 * Footer widgets column
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Scroll to top.
$wp_customize->add_setting(
	'roxtar_setting[scroll_to_top]',
	array(
		'default'           => $defaults['scroll_to_top'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top]',
		array(
			'label'    => __( 'Scroll To Top', 'roxtar' ),
			'settings' => 'roxtar_setting[scroll_to_top]',
			'section'  => 'roxtar_scroll_to_top',
		)
	)
);

// Scroll On.
$wp_customize->add_setting(
	'roxtar_setting[scroll_to_top_on]',
	array(
		'default'           => $defaults['scroll_to_top_on'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top_on]',
		array(
			'label'    => __( 'Scroll On', 'roxtar' ),
			'section'  => 'roxtar_scroll_to_top',
			'settings' => 'roxtar_setting[scroll_to_top_on]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_scroll_to_top_on_choices',
				array(
					'default' => __( 'Mobile + Desktop', 'roxtar' ),
					'mobile'  => __( 'Mobile', 'roxtar' ),
					'desktop' => __( 'Desktop', 'roxtar' ),
				)
			),
		)
	)
);

// Scroll Position.
$wp_customize->add_setting(
	'roxtar_setting[scroll_to_top_position]',
	array(
		'default'           => $defaults['scroll_to_top_position'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top_position]',
		array(
			'label'    => __( 'Position', 'roxtar' ),
			'section'  => 'roxtar_scroll_to_top',
			'settings' => 'roxtar_setting[scroll_to_top_position]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_sidebar_shop_single_choices',
				array(
					'right' => __( 'Right', 'roxtar' ),
					'left'  => __( 'Left', 'roxtar' ),
				)
			),
		)
	)
);

// Scroll To Top Background.
$wp_customize->add_setting(
	'roxtar_setting[scroll_to_top_background]',
	array(
		'default'           => $defaults['scroll_to_top_background'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top_background]',
		array(
			'label'    => __( 'Background', 'roxtar' ),
			'section'  => 'roxtar_scroll_to_top',
			'settings' => 'roxtar_setting[scroll_to_top_background]',
		)
	)
);

// Scroll To Top Color.
$wp_customize->add_setting(
	'roxtar_setting[scroll_to_top_color]',
	array(
		'default'           => $defaults['scroll_to_top_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top_color]',
		array(
			'label'    => __( 'Color', 'roxtar' ),
			'section'  => 'roxtar_scroll_to_top',
			'settings' => 'roxtar_setting[scroll_to_top_color]',
		)
	)
);

// Icons Size.
$wp_customize->add_setting(
	'roxtar_setting[scroll_to_top_icon_size]',
	array(
		'default'           => $defaults['scroll_to_top_icon_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top_icon_size]',
		array(
			'label'    => __( 'Icon Size', 'roxtar' ),
			'section'  => 'roxtar_scroll_to_top',
			'settings' => array(
				'desktop' => 'roxtar_setting[scroll_to_top_icon_size]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_scroll_to_top_icon_size_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_scroll_to_top_icon_size_max_step', 200 ),
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
	'roxtar_setting[scroll_to_top_border_radius]',
	array(
		'default'           => $defaults['scroll_to_top_border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'roxtar' ),
			'section'  => 'roxtar_scroll_to_top',
			'settings' => array(
				'desktop' => 'roxtar_setting[scroll_to_top_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_scroll_to_top_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_scroll_to_top_border_radius_max_step', 200 ),
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
	'roxtar_setting[scroll_to_top_offset_bottom]',
	array(
		'default'           => $defaults['scroll_to_top_offset_bottom'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[scroll_to_top_offset_bottom]',
		array(
			'label'    => __( 'Offset Bottom', 'roxtar' ),
			'section'  => 'roxtar_scroll_to_top',
			'settings' => array(
				'desktop' => 'roxtar_setting[scroll_to_top_offset_bottom]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_scroll_to_top_offset_bottom_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_scroll_to_top_offset_bottom_max_step', 700 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
