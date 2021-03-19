<?php
/**
 * Topbar
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Display topbar.
$wp_customize->add_setting(
	'roxtar_setting[topbar_display]',
	array(
		'type'              => 'option',
		'default'           => $defaults['topbar_display'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[topbar_display]',
		array(
			'label'    => __( 'Topbar Display', 'roxtar' ),
			'section'  => 'roxtar_topbar',
			'settings' => 'roxtar_setting[topbar_display]',
		)
	)
);

// Topbar color.
$wp_customize->add_setting(
	'roxtar_setting[topbar_text_color]',
	array(
		'default'           => $defaults['topbar_text_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[topbar_text_color]',
		array(
			'label'    => __( 'Text Color', 'roxtar' ),
			'section'  => 'roxtar_topbar',
			'settings' => 'roxtar_setting[topbar_text_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'roxtar_setting[topbar_background_color]',
	array(
		'default'           => $defaults['topbar_background_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[topbar_background_color]',
		array(
			'label'    => __( 'Background Color', 'roxtar' ),
			'section'  => 'roxtar_topbar',
			'settings' => 'roxtar_setting[topbar_background_color]',
		)
	)
);

// Space.
$wp_customize->add_setting(
	'roxtar_setting[topbar_height]',
	array(
		'default'           => $defaults['topbar_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[topbar_height]',
		array(
			'label'    => __( 'Space', 'roxtar' ),
			'section'  => 'topbar_height',
			'settings' => array(
				'desktop' => 'roxtar_setting[topbar_height]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_topbar_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_topbar_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Content divider.
$wp_customize->add_setting(
	'topbar_content_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Divider_Control(
		$wp_customize,
		'topbar_content_divider',
		array(
			'section'  => 'roxtar_topbar',
			'settings' => 'topbar_content_divider',
			'type'     => 'divider',
		)
	)
);

// Topbar left.
$wp_customize->add_setting(
	'roxtar_setting[topbar_left]',
	array(
		'default'           => $defaults['topbar_left'],
		'sanitize_callback' => 'roxtar_sanitize_raw_html',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[topbar_left]',
		array(
			'label'    => __( 'Content Left', 'roxtar' ),
			'section'  => 'roxtar_topbar',
			'settings' => 'roxtar_setting[topbar_left]',
			'type'     => 'textarea',
		)
	)
);

// Topbar center.
$wp_customize->add_setting(
	'roxtar_setting[topbar_center]',
	array(
		'default'           => $defaults['topbar_center'],
		'sanitize_callback' => 'roxtar_sanitize_raw_html',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[topbar_center]',
		array(
			'label'    => __( 'Content Center', 'roxtar' ),
			'section'  => 'roxtar_topbar',
			'settings' => 'roxtar_setting[topbar_center]',
			'type'     => 'textarea',
		)
	)
);

// Topbar right.
$wp_customize->add_setting(
	'roxtar_setting[topbar_right]',
	array(
		'default'           => $defaults['topbar_right'],
		'sanitize_callback' => 'roxtar_sanitize_raw_html',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[topbar_right]',
		array(
			'label'    => __( 'Content Right', 'roxtar' ),
			'section'  => 'roxtar_topbar',
			'settings' => 'roxtar_setting[topbar_right]',
			'type'     => 'textarea',
		)
	)
);
