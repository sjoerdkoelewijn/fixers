<?php
/**
 * Page Header
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Page header display.
$wp_customize->add_setting(
	'roxtar_setting[page_header_display]',
	array(
		'default'           => $defaults['page_header_display'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[page_header_display]',
		array(
			'label'    => __( 'Page Header Display', 'roxtar' ),
			'settings' => 'roxtar_setting[page_header_display]',
			'section'  => 'roxtar_page_header',
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'page_header_breadcrumb_divider',
		array(
			'section'  => 'roxtar_page_header',
			'settings' => 'page_header_breadcrumb_divider',
			'type'     => 'divider',
		)
	)
);

// Page title.
$wp_customize->add_setting(
	'roxtar_setting[page_header_title]',
	array(
		'default'           => $defaults['page_header_title'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[page_header_title]',
		array(
			'label'    => __( 'Title', 'roxtar' ),
			'settings' => 'roxtar_setting[page_header_title]',
			'section'  => 'roxtar_page_header',
		)
	)
);

// Breadcrumb.
$wp_customize->add_setting(
	'roxtar_setting[page_header_breadcrumb]',
	array(
		'default'           => $defaults['page_header_breadcrumb'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[page_header_breadcrumb]',
		array(
			'label'    => __( 'Breadcrumb', 'roxtar' ),
			'settings' => 'roxtar_setting[page_header_breadcrumb]',
			'section'  => 'roxtar_page_header',
		)
	)
);

// Text align.
$wp_customize->add_setting(
	'roxtar_setting[page_header_text_align]',
	array(
		'default'           => $defaults['page_header_text_align'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[page_header_text_align]',
		array(
			'label'       => __( 'Text Align', 'roxtar' ),
			'settings'    => 'roxtar_setting[page_header_text_align]',
			'section'     => 'roxtar_page_header',
			'type'        => 'select',
			'choices'     => array(
				'left'    => __( 'Left', 'roxtar' ),
				'center'  => __( 'Center', 'roxtar' ),
				'right'   => __( 'Right', 'roxtar' ),
				'justify' => __( 'Page Title / Breadcrumb', 'roxtar' ),
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'page_header_title_color_divider',
		array(
			'section'  => 'roxtar_page_header',
			'settings' => 'page_header_title_color_divider',
			'type'     => 'divider',
		)
	)
);

// Title color.
$wp_customize->add_setting(
	'roxtar_setting[page_header_title_color]',
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
		'roxtar_setting[page_header_title_color]',
		array(
			'label'    => __( 'Title Color', 'roxtar' ),
			'section'  => 'roxtar_page_header',
			'settings' => 'roxtar_setting[page_header_title_color]',
		)
	)
);

// Breadcrumb text color.
$wp_customize->add_setting(
	'roxtar_setting[page_header_breadcrumb_text_color]',
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
		'roxtar_setting[page_header_breadcrumb_text_color]',
		array(
			'label'    => __( 'Breadcrumb Color', 'roxtar' ),
			'section'  => 'roxtar_page_header',
			'settings' => 'roxtar_setting[page_header_breadcrumb_text_color]',
		)
	)
);

// Background image.
$wp_customize->add_setting(
	'roxtar_setting[page_header_background_image]',
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
		'roxtar_setting[page_header_background_image]',
		array(
			'label'    => __( 'Default Background Image', 'roxtar' ),
			'section'  => 'roxtar_page_header',
			'settings' => 'roxtar_setting[page_header_background_image]',
		)
	)
);

// Background image size.
$wp_customize->add_setting(
	'roxtar_setting[page_header_background_image_size]',
	array(
		'default'           => $defaults['page_header_background_image_size'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[page_header_background_image_size]',
		array(
			'label'       => __( 'Background Size', 'roxtar' ),
			'settings'    => 'roxtar_setting[page_header_background_image_size]',
			'section'     => 'roxtar_page_header',
			'type'        => 'select',
			'choices'     => array(
				'auto'    => __( 'Default', 'roxtar' ),
				'cover'   => __( 'Cover', 'roxtar' ),
				'contain' => __( 'Contain', 'roxtar' ),
			),
		)
	)
);

// Background image repeat.
$wp_customize->add_setting(
	'roxtar_setting[page_header_background_image_repeat]',
	array(
		'default'           => $defaults['page_header_background_image_repeat'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[page_header_background_image_repeat]',
		array(
			'label'       => __( 'Background Repeat', 'roxtar' ),
			'settings'    => 'roxtar_setting[page_header_background_image_repeat]',
			'section'     => 'roxtar_page_header',
			'type'        => 'select',
			'choices'     => array(
				'repeat'    => __( 'Default', 'roxtar' ),
				'no-repeat' => __( 'No Repeat', 'roxtar' ),
				'repeat-x'  => __( 'Repeat X', 'roxtar' ),
				'repeat-y'  => __( 'Repeat Y', 'roxtar' ),
				'space'     => __( 'Space', 'roxtar' ),
				'round'     => __( 'Round', 'roxtar' ),
			),
		)
	)
);

// Background image position.
$wp_customize->add_setting(
	'roxtar_setting[page_header_background_image_position]',
	array(
		'default'           => $defaults['page_header_background_image_position'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[page_header_background_image_position]',
		array(
			'label'       => __( 'Background Position', 'roxtar' ),
			'settings'    => 'roxtar_setting[page_header_background_image_position]',
			'section'     => 'roxtar_page_header',
			'type'        => 'select',
			'choices'     => array(
				'left-top'      => __( 'Left Top', 'roxtar' ),
				'left-center'   => __( 'Left Center', 'roxtar' ),
				'left-bottom'   => __( 'Left Bottom', 'roxtar' ),
				'center-top'    => __( 'Center Top', 'roxtar' ),
				'center-center' => __( 'Center Center', 'roxtar' ),
				'center-bottom' => __( 'Center Bottom', 'roxtar' ),
				'right-top'     => __( 'Right Top', 'roxtar' ),
				'right-center'  => __( 'Right Center', 'roxtar' ),
				'right-bottom'  => __( 'Right Bottom', 'roxtar' ),
			),
		)
	)
);

// Background image attachment.
$wp_customize->add_setting(
	'roxtar_setting[page_header_background_image_attachment]',
	array(
		'default'           => $defaults['page_header_background_image_attachment'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[page_header_background_image_attachment]',
		array(
			'label'       => __( 'Background Attachment', 'roxtar' ),
			'settings'    => 'roxtar_setting[page_header_background_image_attachment]',
			'section'     => 'roxtar_page_header',
			'type'        => 'select',
			'choices'     => array(
				'scroll' => __( 'Default', 'roxtar' ),
				'fixed'  => __( 'Fixed', 'roxtar' ),
				'local'  => __( 'Local', 'roxtar' ),
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'page_header_spacing_divider',
		array(
			'section'  => 'roxtar_page_header',
			'settings' => 'page_header_spacing_divider',
			'type'     => 'divider',
		)
	)
);

// Padding top.
$wp_customize->add_setting(
	'roxtar_setting[page_header_padding_top]',
	array(
		'default'           => $defaults['page_header_padding_top'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[page_header_padding_top]',
		array(
			'label'    => __( 'Padding Top', 'roxtar' ),
			'section'  => 'roxtar_page_header',
			'settings' => array(
				'desktop' => 'roxtar_setting[page_header_padding_top]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_page_header_padding_top_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_page_header_padding_top_max_step', 200 ),
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
	'roxtar_setting[page_header_padding_bottom]',
	array(
		'default'           => $defaults['page_header_padding_bottom'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[page_header_padding_bottom]',
		array(
			'label'    => __( 'Padding Bottom', 'roxtar' ),
			'section'  => 'roxtar_page_header',
			'settings' => array(
				'desktop' => 'roxtar_setting[page_header_padding_bottom]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_page_header_padding_bottom_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_page_header_padding_bottom_max_step', 200 ),
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
	'roxtar_setting[page_header_margin_bottom]',
	array(
		'default'           => $defaults['page_header_margin_bottom'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[page_header_margin_bottom]',
		array(
			'label'    => __( 'Margin Bottom', 'roxtar' ),
			'section'  => 'roxtar_page_header',
			'settings' => array(
				'desktop' => 'roxtar_setting[page_header_margin_bottom]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_page_header_margin_bottom_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_page_header_margin_bottom_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
