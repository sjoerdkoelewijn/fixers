<?php
/**
 * Color customizer
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Theme color.
$wp_customize->add_setting(
	'SKDD_setting[theme_color]',
	array(
		'default'           => $defaults['theme_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[theme_color]',
		array(
			'label'    => __( 'Theme Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[theme_color]',
		)
	)
);

// Secondary Theme color.
$wp_customize->add_setting(
	'SKDD_setting[secondary_theme_color]',
	array(
		'default'           => $defaults['secondary_theme_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[secondary_theme_color]',
		array(
			'label'    => __( 'Secondary Theme Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[secondary_theme_color]',
		)
	)
);

// Tertiary Theme color.
$wp_customize->add_setting(
	'SKDD_setting[tertiary_theme_color]',
	array(
		'default'           => $defaults['tertiary_theme_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[tertiary_theme_color]',
		array(
			'label'    => __( 'Tertiary Theme Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[tertiary_theme_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'SKDD_setting[background_color]',
	array(
		'default'           => $defaults['background_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[background_color]',
		array(
			'label'    => __( 'Background Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[background_color]',
		)
	)
);


// Second background color.
$wp_customize->add_setting(
	'SKDD_setting[second_background_color]',
	array(
		'default'           => $defaults['second_background_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[second_background_color]',
		array(
			'label'    => __( 'Second Background Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[second_background_color]',
		)
	)
);

// ----------------------------------------------------------------------------------------------------------

$wp_customize->add_setting(
	'color_divider_section_1',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'color_divider_section_1',
		array(
			'section'  => 'SKDD_color',
			'settings' => 'color_divider_section_1',
			'type'     => 'divider',
		)
	)
);

// Heading color.
$wp_customize->add_setting(
	'SKDD_setting[heading_color]',
	array(
		'default'           => $defaults['heading_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[heading_color]',
		array(
			'label'    => __( 'Heading Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[heading_color]',
		)
	)
);

// Text Color.
$wp_customize->add_setting(
	'SKDD_setting[text_color]',
	array(
		'default'           => $defaults['text_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[text_color]',
		array(
			'label'    => __( 'Text Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[text_color]',
		)
	)
);

// Link Color.
$wp_customize->add_setting(
	'SKDD_setting[link_color]',
	array(
		'default'           => $defaults['link_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[link_color]',
		array(
			'label'    => __( 'Link Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[link_color]',
		)
	)
);

// Link Color.
$wp_customize->add_setting(
	'SKDD_setting[hover_color]',
	array(
		'default'           => $defaults['hover_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[hover_color]',
		array(
			'label'    => __( 'Link Hover Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[hover_color]',
		)
	)
);

// offset color.
$wp_customize->add_setting(
	'SKDD_setting[offset_color]',
	array(
		'default'           => $defaults['offset_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[offset_color]',
		array(
			'label'    => __( 'Offset Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[offset_color]',
		)
	)
);


// ----------------------------------------------------------------------------------------------------------

$wp_customize->add_setting(
	'color_divider_section_2',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'color_divider_section_2',
		array(
			'section'  => 'SKDD_color',
			'settings' => 'color_divider_section_2',
			'type'     => 'divider',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'SKDD_setting[header_background_color]',
	array(
		'default'           => $defaults['header_background_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[header_background_color]',
		array(
			'label'    => __( 'Header Background', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[header_background_color]',
		)
	)
);

// Primary parent menu color.
$wp_customize->add_setting(
	'SKDD_setting[primary_menu_color]',
	array(
		'default'           => $defaults['primary_menu_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[primary_menu_color]',
		array(
			'label'    => __( 'Parent Menu Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[primary_menu_color]',
		)
	)
);

// Primary sub menu color.
$wp_customize->add_setting(
	'SKDD_setting[primary_sub_menu_color]',
	array(
		'default'           => $defaults['primary_sub_menu_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[primary_sub_menu_color]',
		array(
			'label'    => __( 'Sub-menu Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[primary_sub_menu_color]',
		)
	)
);

// ----------------------------------------------------------------------------------------------------------

// Footer background color divider.
$wp_customize->add_setting(
	'footer_background_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'footer_background_color_divider',
		array(
			'section'  => 'SKDD_color',
			'settings' => 'footer_background_color_divider',
			'type'     => 'divider',
		)
	)
);

// Footer Background.
$wp_customize->add_setting(
	'SKDD_setting[footer_background_color]',
	array(
		'default'           => $defaults['footer_background_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[footer_background_color]',
		array(
			'label'    => __( 'Footer Background Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[footer_background_color]',
		)
	)
);

// Footer heading color.
$wp_customize->add_setting(
	'SKDD_setting[footer_heading_color]',
	array(
		'default'           => $defaults['footer_heading_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[footer_heading_color]',
		array(
			'label'    => __( 'Footer Heading Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[footer_heading_color]',
		)
	)
);

// Footer link color.
$wp_customize->add_setting(
	'SKDD_setting[footer_link_color]',
	array(
		'default'           => $defaults['footer_link_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[footer_link_color]',
		array(
			'label'    => __( 'Footer Link Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[footer_link_color]',
		)
	)
);

// Footer text color.
$wp_customize->add_setting(
	'SKDD_setting[footer_text_color]',
	array(
		'default'           => $defaults['footer_text_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[footer_text_color]',
		array(
			'label'    => __( 'Footer Text Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[footer_text_color]',
		)
	)
);

// ----------------------------------------------------------------------------------------------------------

// Scroll To Top divider.
$wp_customize->add_setting(
	'scroll_to_top_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'scroll_to_top_divider',
		array(
			'section'  => 'SKDD_color',
			'settings' => 'scroll_to_top_divider',
			'type'     => 'divider',
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
			'label'    => __( 'Scroll to top background', 'SKDD' ),
			'section'  => 'SKDD_color',
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
			'label'    => __( 'Scroll to top color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[scroll_to_top_color]',
		)
	)
);

// ----------------------------------------------------------------------------------------------------------

// Footer background color divider.
$wp_customize->add_setting(
	'sidebar_background_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'sidebar_background_color_divider',
		array(
			'section'  => 'SKDD_color',
			'settings' => 'sidebar_background_color_divider',
			'type'     => 'divider',
		)
	)
);


// Sidebar background color
$wp_customize->add_setting(
	'SKDD_setting[sidebar_background_color]',
	array(
		'default'           => $defaults['sidebar_background_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[sidebar_background_color]',
		array(
			'label'    => __( 'Sidebar Background Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[sidebar_background_color]',
		)
	)
);

// Sidebar background color
$wp_customize->add_setting(
	'SKDD_setting[sidebar_background_color]',
	array(
		'default'           => $defaults['sidebar_background_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[sidebar_background_color]',
		array(
			'label'    => __( 'Sidebar & Submenu Background Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[sidebar_background_color]',
		)
	)
);

// Sidebar Text color
$wp_customize->add_setting(
	'SKDD_setting[sidebar_text_color]',
	array(
		'default'           => $defaults['sidebar_text_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[sidebar_text_color]',
		array(
			'label'    => __( 'Sidebar & Submenu Text Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[sidebar_text_color]',
		)
	)
);

// Sidebar offset color
$wp_customize->add_setting(
	'SKDD_setting[sidebar_offset_color]',
	array(
		'default'           => $defaults['sidebar_offset_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[sidebar_offset_color]',
		array(
			'label'    => __( 'Sidebar & Submenu Offset Color', 'SKDD' ),
			'section'  => 'SKDD_color',
			'settings' => 'SKDD_setting[sidebar_offset_color]',
		)
	)
);