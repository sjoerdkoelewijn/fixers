<?php
/**
 * Button customizer
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Text color.
$wp_customize->add_setting(
	'roxtar_setting[button_text_color]',
	array(
		'default'           => $defaults['button_text_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[button_text_color]',
		array(
			'label'    => __( 'Text Color', 'roxtar' ),
			'section'  => 'roxtar_buttons',
			'settings' => 'roxtar_setting[button_text_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'roxtar_setting[button_background_color]',
	array(
		'default'           => $defaults['button_background_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[button_background_color]',
		array(
			'label'    => __( 'Background Color', 'roxtar' ),
			'section'  => 'roxtar_buttons',
			'settings' => 'roxtar_setting[button_background_color]',
		)
	)
);

// Hover text divider.
$wp_customize->add_setting(
	'button_hover_text_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Divider_Control(
		$wp_customize,
		'button_hover_text_divider',
		array(
			'section'  => 'roxtar_buttons',
			'settings' => 'button_hover_text_divider',
			'type'     => 'divider',
		)
	)
);

// Hover text color.
$wp_customize->add_setting(
	'roxtar_setting[button_hover_text_color]',
	array(
		'default'           => $defaults['button_hover_text_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[button_hover_text_color]',
		array(
			'label'    => __( 'Hover Text Color', 'roxtar' ),
			'section'  => 'roxtar_buttons',
			'settings' => 'roxtar_setting[button_hover_text_color]',
		)
	)
);

// Hover background color.
$wp_customize->add_setting(
	'roxtar_setting[button_hover_background_color]',
	array(
		'default'           => $defaults['button_hover_background_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[button_hover_background_color]',
		array(
			'label'    => __( 'Hover Background Color', 'roxtar' ),
			'section'  => 'roxtar_buttons',
			'settings' => 'roxtar_setting[button_hover_background_color]',
		)
	)
);

// Border radius divider.
$wp_customize->add_setting(
	'button_radius_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Divider_Control(
		$wp_customize,
		'button_radius_divider',
		array(
			'section'  => 'roxtar_buttons',
			'settings' => 'button_radius_divider',
			'type'     => 'divider',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'roxtar_setting[buttons_border_radius]',
	array(
		'default'           => $defaults['buttons_border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[buttons_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'roxtar' ),
			'section'  => 'roxtar_buttons',
			'settings' => array(
				'desktop' => 'roxtar_setting[buttons_border_radius]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_buttons_border-radius_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_buttons_border-radius_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
