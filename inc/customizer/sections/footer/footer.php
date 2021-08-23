<?php
/**
 * Footer widgets column
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Footer display.
$wp_customize->add_setting(
	'SKDD_setting[footer_display]',
	array(
		'default'           => $defaults['footer_display'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[footer_display]',
		array(
			'label'    => __( 'Footer Display', 'SKDD' ),
			'settings' => 'SKDD_setting[footer_display]',
			'section'  => 'SKDD_footer',
		)
	)
);

// Space.
$wp_customize->add_setting(
	'SKDD_setting[footer_space]',
	array(
		'default'           => $defaults['footer_space'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[footer_space]',
		array(
			'label'    => __( 'Space', 'SKDD' ),
			'section'  => 'SKDD_footer',
			'settings' => array(
				'desktop' => 'SKDD_setting[footer_space]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_footer_space_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_footer_space_max_step', 200 ),
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
	'SKDD_setting[footer_column]',
	array(
		'default'           => $defaults['footer_column'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[footer_column]',
		array(
			'label'    => __( 'Widget Columns', 'SKDD' ),
			'settings' => 'SKDD_setting[footer_column]',
			'section'  => 'SKDD_footer',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_footer_column_choices',
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

// Footer text divider.
$wp_customize->add_setting(
	'footer_text_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'footer_text_divider',
		array(
			'section'  => 'SKDD_footer',
			'settings' => 'footer_text_divider',
			'type'     => 'divider',
		)
	)
);

// Custom text.
$wp_customize->add_setting(
	'SKDD_setting[footer_custom_text]',
	array(
		'default'           => $defaults['footer_custom_text'],
		'sanitize_callback' => 'SKDD_sanitize_raw_html',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[footer_custom_text]',
		array(
			'label'    => __( 'Custom Text', 'SKDD' ),
			'type'     => 'textarea',
			'section'  => 'SKDD_footer',
			'settings' => 'SKDD_setting[footer_custom_text]',
		)
	)
);

// Topbar layout.
$wp_customize->add_setting(
	'SKDD_setting[footer_layout]',
	array(
		'default'           => $defaults['footer_layout'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Radio_Image_Control(
		$wp_customize,
		'SKDD_setting[footer_layout]',
		array(
			'label'    => __( 'Topbar Layout', 'SKDD' ),
			'section'  => 'SKDD_footer',
			'settings' => 'SKDD_setting[footer_layout]',
			'choices'  => apply_filters(
				'SKDD_setting_footer_layout_choices',
				array(
					'flex-start' => SKDD_THEME_URI . 'assets/images/customizer/header/skdd-topbar-flexstart.jpg',
					'flex-end' => SKDD_THEME_URI . 'assets/images/customizer/header/skdd-topbar-flexend.jpg',
					'center' => SKDD_THEME_URI . 'assets/images/customizer/header/skdd-topbar-flexcenter.jpg',
					'space-between' => SKDD_THEME_URI . 'assets/images/customizer/header/skdd-topbar-flexspacebetween.jpg',
				)
			),
		)
	)
);
