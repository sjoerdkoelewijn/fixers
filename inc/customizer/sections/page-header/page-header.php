<?php
/**
 * Page Header
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Page header display.
$wp_customize->add_setting(
	'SKDD_setting[page_header_display]',
	array(
		'default'           => $defaults['page_header_display'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[page_header_display]',
		array(
			'label'    => __( 'Page Header Display', 'SKDD' ),
			'settings' => 'SKDD_setting[page_header_display]',
			'section'  => 'SKDD_page_header',
		)
	)
);

// Breadcrumb divider.
$wp_customize->add_setting(
	'page_header_breadcrumb_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'page_header_breadcrumb_divider',
		array(
			'section'  => 'SKDD_page_header',
			'settings' => 'page_header_breadcrumb_divider',
			'type'     => 'divider',
		)
	)
);

// Page title.
$wp_customize->add_setting(
	'SKDD_setting[page_header_title]',
	array(
		'default'           => $defaults['page_header_title'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[page_header_title]',
		array(
			'label'    => __( 'Title', 'SKDD' ),
			'settings' => 'SKDD_setting[page_header_title]',
			'section'  => 'SKDD_page_header',
		)
	)
);

// Breadcrumb.
$wp_customize->add_setting(
	'SKDD_setting[page_header_breadcrumb]',
	array(
		'default'           => $defaults['page_header_breadcrumb'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[page_header_breadcrumb]',
		array(
			'label'    => __( 'Breadcrumb', 'SKDD' ),
			'settings' => 'SKDD_setting[page_header_breadcrumb]',
			'section'  => 'SKDD_page_header',
		)
	)
);

// Text align.
$wp_customize->add_setting(
	'SKDD_setting[page_header_text_align]',
	array(
		'default'           => $defaults['page_header_text_align'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[page_header_text_align]',
		array(
			'label'       => __( 'Text Align', 'SKDD' ),
			'settings'    => 'SKDD_setting[page_header_text_align]',
			'section'     => 'SKDD_page_header',
			'type'        => 'select',
			'choices'     => array(
				'left'    => __( 'Left', 'SKDD' ),
				'center'  => __( 'Center', 'SKDD' ),
				'right'   => __( 'Right', 'SKDD' ),
				'justify' => __( 'Page Title / Breadcrumb', 'SKDD' ),
			),
		)
	)
);

// Title color divider.
$wp_customize->add_setting(
	'page_header_title_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'page_header_title_color_divider',
		array(
			'section'  => 'SKDD_page_header',
			'settings' => 'page_header_title_color_divider',
			'type'     => 'divider',
		)
	)
);

// Title color.
$wp_customize->add_setting(
	'SKDD_setting[page_header_title_color]',
	array(
		'default'           => $defaults['page_header_title_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[page_header_title_color]',
		array(
			'label'    => __( 'Title Color', 'SKDD' ),
			'section'  => 'SKDD_page_header',
			'settings' => 'SKDD_setting[page_header_title_color]',
		)
	)
);

// Breadcrumb text color.
$wp_customize->add_setting(
	'SKDD_setting[page_header_breadcrumb_text_color]',
	array(
		'default'           => $defaults['page_header_breadcrumb_text_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[page_header_breadcrumb_text_color]',
		array(
			'label'    => __( 'Breadcrumb Color', 'SKDD' ),
			'section'  => 'SKDD_page_header',
			'settings' => 'SKDD_setting[page_header_breadcrumb_text_color]',
		)
	)
);

// Background image.
$wp_customize->add_setting(
	'SKDD_setting[page_header_background_image]',
	array(
		'type'              => 'option',
		'default'           => $defaults['page_header_background_image'],
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'SKDD_setting[page_header_background_image]',
		array(
			'label'    => __( 'Default Background Image', 'SKDD' ),
			'section'  => 'SKDD_page_header',
			'settings' => 'SKDD_setting[page_header_background_image]',
		)
	)
);

// Background image size.
$wp_customize->add_setting(
	'SKDD_setting[page_header_background_image_size]',
	array(
		'default'           => $defaults['page_header_background_image_size'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[page_header_background_image_size]',
		array(
			'label'       => __( 'Background Size', 'SKDD' ),
			'settings'    => 'SKDD_setting[page_header_background_image_size]',
			'section'     => 'SKDD_page_header',
			'type'        => 'select',
			'choices'     => array(
				'auto'    => __( 'Default', 'SKDD' ),
				'cover'   => __( 'Cover', 'SKDD' ),
				'contain' => __( 'Contain', 'SKDD' ),
			),
		)
	)
);

// Background image repeat.
$wp_customize->add_setting(
	'SKDD_setting[page_header_background_image_repeat]',
	array(
		'default'           => $defaults['page_header_background_image_repeat'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[page_header_background_image_repeat]',
		array(
			'label'       => __( 'Background Repeat', 'SKDD' ),
			'settings'    => 'SKDD_setting[page_header_background_image_repeat]',
			'section'     => 'SKDD_page_header',
			'type'        => 'select',
			'choices'     => array(
				'repeat'    => __( 'Default', 'SKDD' ),
				'no-repeat' => __( 'No Repeat', 'SKDD' ),
				'repeat-x'  => __( 'Repeat X', 'SKDD' ),
				'repeat-y'  => __( 'Repeat Y', 'SKDD' ),
				'space'     => __( 'Space', 'SKDD' ),
				'round'     => __( 'Round', 'SKDD' ),
			),
		)
	)
);

// Background image position.
$wp_customize->add_setting(
	'SKDD_setting[page_header_background_image_position]',
	array(
		'default'           => $defaults['page_header_background_image_position'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[page_header_background_image_position]',
		array(
			'label'       => __( 'Background Position', 'SKDD' ),
			'settings'    => 'SKDD_setting[page_header_background_image_position]',
			'section'     => 'SKDD_page_header',
			'type'        => 'select',
			'choices'     => array(
				'left-top'      => __( 'Left Top', 'SKDD' ),
				'left-center'   => __( 'Left Center', 'SKDD' ),
				'left-bottom'   => __( 'Left Bottom', 'SKDD' ),
				'center-top'    => __( 'Center Top', 'SKDD' ),
				'center-center' => __( 'Center Center', 'SKDD' ),
				'center-bottom' => __( 'Center Bottom', 'SKDD' ),
				'right-top'     => __( 'Right Top', 'SKDD' ),
				'right-center'  => __( 'Right Center', 'SKDD' ),
				'right-bottom'  => __( 'Right Bottom', 'SKDD' ),
			),
		)
	)
);

// Background image attachment.
$wp_customize->add_setting(
	'SKDD_setting[page_header_background_image_attachment]',
	array(
		'default'           => $defaults['page_header_background_image_attachment'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[page_header_background_image_attachment]',
		array(
			'label'       => __( 'Background Attachment', 'SKDD' ),
			'settings'    => 'SKDD_setting[page_header_background_image_attachment]',
			'section'     => 'SKDD_page_header',
			'type'        => 'select',
			'choices'     => array(
				'scroll' => __( 'Default', 'SKDD' ),
				'fixed'  => __( 'Fixed', 'SKDD' ),
				'local'  => __( 'Local', 'SKDD' ),
			),
		)
	)
);

// Padding divider.
$wp_customize->add_setting(
	'page_header_spacing_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'page_header_spacing_divider',
		array(
			'section'  => 'SKDD_page_header',
			'settings' => 'page_header_spacing_divider',
			'type'     => 'divider',
		)
	)
);

// Padding top.
$wp_customize->add_setting(
	'SKDD_setting[page_header_padding_top]',
	array(
		'default'           => $defaults['page_header_padding_top'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[page_header_padding_top]',
		array(
			'label'    => __( 'Padding Top', 'SKDD' ),
			'section'  => 'SKDD_page_header',
			'settings' => array(
				'desktop' => 'SKDD_setting[page_header_padding_top]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_page_header_padding_top_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_page_header_padding_top_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Padding bottom.
$wp_customize->add_setting(
	'SKDD_setting[page_header_padding_bottom]',
	array(
		'default'           => $defaults['page_header_padding_bottom'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[page_header_padding_bottom]',
		array(
			'label'    => __( 'Padding Bottom', 'SKDD' ),
			'section'  => 'SKDD_page_header',
			'settings' => array(
				'desktop' => 'SKDD_setting[page_header_padding_bottom]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_page_header_padding_bottom_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_page_header_padding_bottom_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Margin bottom.
$wp_customize->add_setting(
	'SKDD_setting[page_header_margin_bottom]',
	array(
		'default'           => $defaults['page_header_margin_bottom'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[page_header_margin_bottom]',
		array(
			'label'    => __( 'Margin Bottom', 'SKDD' ),
			'section'  => 'SKDD_page_header',
			'settings' => array(
				'desktop' => 'SKDD_setting[page_header_margin_bottom]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_page_header_margin_bottom_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_page_header_margin_bottom_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
