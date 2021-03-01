<?php
/**
 * Color customizer
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Theme color.
$wp_customize->add_setting(
	'roxtar_setting[theme_color]',
	array(
		'default'           => $defaults['theme_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[theme_color]',
		array(
			'label'    => __( 'Theme Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[theme_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'roxtar_setting[background_color]',
	array(
		'default'           => $defaults['background_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[background_color]',
		array(
			'label'    => __( 'Background Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[background_color]',
		)
	)
);


// Second background color.
$wp_customize->add_setting(
	'roxtar_setting[second_background_color]',
	array(
		'default'           => $defaults['second_background_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[second_background_color]',
		array(
			'label'    => __( 'Second Background Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[second_background_color]',
		)
	)
);


// Line color.
$wp_customize->add_setting(
	'roxtar_setting[line_color]',
	array(
		'default'           => $defaults['line_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[line_color]',
		array(
			'label'    => __( 'Line Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[line_color]',
		)
	)
);



// Heading color.
$wp_customize->add_setting(
	'roxtar_setting[heading_color]',
	array(
		'default'           => $defaults['heading_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[heading_color]',
		array(
			'label'    => __( 'Heading Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[heading_color]',
		)
	)
);

// Text Color.
$wp_customize->add_setting(
	'roxtar_setting[text_color]',
	array(
		'default'           => $defaults['text_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[text_color]',
		array(
			'label'    => __( 'Text Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[text_color]',
		)
	)
);

// Accent Color.
$wp_customize->add_setting(
	'roxtar_setting[accent_color]',
	array(
		'default'           => $defaults['accent_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[accent_color]',
		array(
			'label'    => __( 'Link / Accent Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[accent_color]',
		)
	)
);


// Primary parent menu color.
$wp_customize->add_setting(
	'roxtar_setting[primary_menu_color]',
	array(
		'default'           => $defaults['primary_menu_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[primary_menu_color]',
		array(
			'label'    => __( 'Parent Menu Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[primary_menu_color]',
		)
	)
);

// Primary sub menu color.
$wp_customize->add_setting(
	'roxtar_setting[primary_sub_menu_color]',
	array(
		'default'           => $defaults['primary_sub_menu_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[primary_sub_menu_color]',
		array(
			'label'    => __( 'Sub-menu Color', 'roxtar' ),
			'section'  => 'roxtar_color',
			'settings' => 'roxtar_setting[primary_sub_menu_color]',
		)
	)
);