<?php
/**
 * Footer widgets column
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Footer display.
$wp_customize->add_setting(
	'roxtar_setting[footer_display]',
	array(
		'default'           => $defaults['footer_display'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[footer_display]',
		array(
			'label'    => __( 'Footer Display', 'roxtar' ),
			'settings' => 'roxtar_setting[footer_display]',
			'section'  => 'roxtar_footer',
		)
	)
);

// Space.
$wp_customize->add_setting(
	'roxtar_setting[footer_space]',
	array(
		'default'           => $defaults['footer_space'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[footer_space]',
		array(
			'label'    => __( 'Space', 'roxtar' ),
			'section'  => 'roxtar_footer',
			'settings' => array(
				'desktop' => 'roxtar_setting[footer_space]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_footer_space_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_footer_space_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Footer widget columns.
$wp_customize->add_setting(
	'roxtar_setting[footer_column]',
	array(
		'default'           => $defaults['footer_column'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[footer_column]',
		array(
			'label'    => __( 'Widget Columns', 'roxtar' ),
			'settings' => 'roxtar_setting[footer_column]',
			'section'  => 'roxtar_footer',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_footer_column_choices',
				array(
					0 => 0,
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
				)
			),
		)
	)
);

// Footer background color divider.
$wp_customize->add_setting(
	'footer_background_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Divider_Control(
		$wp_customize,
		'footer_background_color_divider',
		array(
			'section'  => 'roxtar_footer',
			'settings' => 'footer_background_color_divider',
			'type'     => 'divider',
		)
	)
);

// Footer Background.
$wp_customize->add_setting(
	'roxtar_setting[footer_background_color]',
	array(
		'default'           => $defaults['footer_background_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[footer_background_color]',
		array(
			'label'    => __( 'Background Color', 'roxtar' ),
			'section'  => 'roxtar_footer',
			'settings' => 'roxtar_setting[footer_background_color]',
		)
	)
);

// Footer heading color.
$wp_customize->add_setting(
	'roxtar_setting[footer_heading_color]',
	array(
		'default'           => $defaults['footer_heading_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[footer_heading_color]',
		array(
			'label'    => __( 'Heading Color', 'roxtar' ),
			'section'  => 'roxtar_footer',
			'settings' => 'roxtar_setting[footer_heading_color]',
		)
	)
);

// Footer link color.
$wp_customize->add_setting(
	'roxtar_setting[footer_link_color]',
	array(
		'default'           => $defaults['footer_link_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[footer_link_color]',
		array(
			'label'    => __( 'Link Color', 'roxtar' ),
			'section'  => 'roxtar_footer',
			'settings' => 'roxtar_setting[footer_link_color]',
		)
	)
);

// Footer text color.
$wp_customize->add_setting(
	'roxtar_setting[footer_text_color]',
	array(
		'default'           => $defaults['footer_text_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[footer_text_color]',
		array(
			'label'    => __( 'Text Color', 'roxtar' ),
			'section'  => 'roxtar_footer',
			'settings' => 'roxtar_setting[footer_text_color]',
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'footer_text_divider',
		array(
			'section'  => 'roxtar_footer',
			'settings' => 'footer_text_divider',
			'type'     => 'divider',
		)
	)
);

// Custom text.
$wp_customize->add_setting(
	'roxtar_setting[footer_custom_text]',
	array(
		'default'           => $defaults['footer_custom_text'],
		'sanitize_callback' => 'roxtar_sanitize_raw_html',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[footer_custom_text]',
		array(
			'label'    => __( 'Custom Text', 'roxtar' ),
			'type'     => 'textarea',
			'section'  => 'roxtar_footer',
			'settings' => 'roxtar_setting[footer_custom_text]',
		)
	)
);
