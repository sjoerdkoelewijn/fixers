<?php
/**
 * Site Title & Tagline
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Divider.
$wp_customize->add_setting(
	'site_container_other_element_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'site_container_other_element_divider',
		array(
			'section'  => 'SKDD_container',
			'settings' => 'site_container_other_element_divider',
			'type'     => 'divider',
		)
	)
);

// Header width.
$wp_customize->add_setting(
	'SKDD_setting[header_width]',
	array(
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'default'           => $defaults['header_width'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[header_width]',
		array(
			'section'  => 'SKDD_container',
			'settings' => 'SKDD_setting[header_width]',
			'type'     => 'select',
			'label'    => __( 'Header width', 'SKDD' ),
			'choices' => array(
                '100vw' => 'Fullwidth',
                '1920px' => 'Large',
                '1400px' => 'Medium',
                '1200px' => 'Small',
                '1000px' => 'Narrow',
            ),
		)
	)
);

// Container width.
$wp_customize->add_setting(
	'SKDD_setting[container_width]',
	array(
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'default'           => $defaults['container_width'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[container_width]',
		array(
			'section'  => 'SKDD_container',
			'settings' => 'SKDD_setting[container_width]',
			'type'     => 'select',
			'label'    => __( 'Container width', 'SKDD' ),
			'choices' => array(
                '100vw' => 'Fullwidth',
                '1800px' => 'Large',
                '1400px' => 'Medium',
                '1200px' => 'Small',
                '1000px' => 'Narrow',
            ),
		)
	)
);


// Content Spacing
$wp_customize->add_setting(
	'SKDD_setting[content_spacing]',
	array(
		'default'           => $defaults['content_spacing'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[tablet_content_spacing]',
	array(
		'default'           => $defaults['tablet_content_spacing'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'SKDD_setting[mobile_content_spacing]',
	array(
		'default'           => $defaults['mobile_content_spacing'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);


$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[content_spacing]',
		array(
			'label'    => __( 'Horizontal spacing', 'SKDD' ),
			'section'  => 'SKDD_container',
			'settings' => array(
				'desktop' => 'SKDD_setting[content_spacing]',
				'tablet'  => 'SKDD_setting[tablet_content_spacing]',
				'mobile'  => 'SKDD_setting[mobile_content_spacing]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_content_spacing_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_content_spacing_max_step', 200 ),
					'step' => 10,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_content_spacing_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_content_spacing_max_step', 150 ),
					'step' => 10,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_content_spacing_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_content_spacing_max_step', 100 ),
					'step' => 10,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);



// Vertical Spacing
$wp_customize->add_setting(
	'SKDD_setting[vertical_spacing]',
	array(
		'default'           => $defaults['vertical_spacing'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[vertical_spacing]',
		array(
			'label'    => __( 'Vertical spacing', 'SKDD' ),
			'section'  => 'SKDD_container',
			'settings' => array(
				'desktop' => 'SKDD_setting[vertical_spacing]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_vertical_spacing_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_vertical_spacing_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'vh',
				),
			),
		)
	)
);



// Border Radius
$wp_customize->add_setting(
	'SKDD_setting[border_radius]',
	array(
		'default'           => $defaults['border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[border_radius]',
		array(
			'label'    => __( 'Border Radius', 'SKDD' ),
			'section'  => 'SKDD_container',
			'settings' => array(
				'desktop' => 'SKDD_setting[border_radius]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_border_radius_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);


