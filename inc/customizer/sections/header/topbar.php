<?php
/**
 * Topbar
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Display topbar.
$wp_customize->add_setting(
	'SKDD_setting[topbar_display]',
	array(
		'type'              => 'option',
		'default'           => $defaults['topbar_display'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[topbar_display]',
		array(
			'label'    => __( 'Topbar Display', 'SKDD' ),
			'section'  => 'SKDD_topbar',
			'settings' => 'SKDD_setting[topbar_display]',
		)
	)
);

// Display close btn on topbar.
$wp_customize->add_setting(
	'SKDD_setting[topbar_close_btn]',
	array(
		'type'              => 'option',
		'default'           => $defaults['topbar_close_btn'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[topbar_close_btn]',
		array(
			'label'    => __( 'Display close button', 'SKDD' ),
			'section'  => 'SKDD_topbar',
			'settings' => 'SKDD_setting[topbar_close_btn]',
		)
	)
);

// Topbar color.
$wp_customize->add_setting(
	'SKDD_setting[topbar_text_color]',
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
		'SKDD_setting[topbar_text_color]',
		array(
			'label'    => __( 'Text Color', 'SKDD' ),
			'section'  => 'SKDD_topbar',
			'settings' => 'SKDD_setting[topbar_text_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'SKDD_setting[topbar_background_color]',
	array(
		'default'           => $defaults['topbar_background_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[topbar_background_color]',
		array(
			'label'    => __( 'Background Color', 'SKDD' ),
			'section'  => 'SKDD_topbar',
			'settings' => 'SKDD_setting[topbar_background_color]',
		)
	)
);

// Opacity.
$wp_customize->add_setting(
	'SKDD_setting[topbar_opacity]',
	array(
		'default'           => $defaults['topbar_opacity'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[topbar_opacity]',
		array(
			'label'    => __( 'Topbar Opacity', 'SKDD' ),
			'section'  => 'SKDD_topbar',
			'settings' => array(
				'desktop' => 'SKDD_setting[topbar_opacity]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_topbar_opacity_min_step', 1 ),
					'max'  => apply_filters( 'SKDD_topbar_opacity_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => '%',
				),
			),
		)
	)
);

// Height.
$wp_customize->add_setting(
	'SKDD_setting[topbar_height]',
	array(
		'default'           => $defaults['topbar_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[topbar_height]',
		array(
			'label'    => __( 'Topbar Height', 'SKDD' ),
			'section'  => 'SKDD_topbar',
			'settings' => array(
				'desktop' => 'SKDD_setting[topbar_height]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_topbar_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_topbar_max_step', 100 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);