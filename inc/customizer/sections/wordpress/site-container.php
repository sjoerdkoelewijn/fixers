<?php
/**
 * Site Title & Tagline
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Default container.
$default_container = array(
	'normal'               => __( 'Normal', 'roxtar' ),
	'boxed'                => __( 'Boxed', 'roxtar' ),
	'content-boxed'        => __( 'Content Boxed', 'roxtar' ),
	'full-width'           => __( 'Full Width / Contained', 'roxtar' ),
	'full-width-stretched' => __( 'Full Width / Stretched', 'roxtar' ),
);

// Other container.
$other_container = array(
	'default'              => __( 'Default', 'roxtar' ),
	'normal'               => __( 'Normal', 'roxtar' ),
	'boxed'                => __( 'Boxed', 'roxtar' ),
	'content-boxed'        => __( 'Content Boxed', 'roxtar' ),
	'full-width'           => __( 'Full Width / Contained', 'roxtar' ),
	'full-width-stretched' => __( 'Full Width / Stretched', 'roxtar' ),
);

// Divider.
$wp_customize->add_setting(
	'site_container_other_element_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Divider_Control(
		$wp_customize,
		'site_container_other_element_divider',
		array(
			'section'  => 'roxtar_container',
			'settings' => 'site_container_other_element_divider',
			'type'     => 'divider',
		)
	)
);

// Header width.
$wp_customize->add_setting(
	'roxtar_setting[header_width]',
	array(
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'default'           => $defaults['header_width'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[header_width]',
		array(
			'section'  => 'roxtar_container',
			'settings' => 'roxtar_setting[header_width]',
			'type'     => 'select',
			'label'    => __( 'Header width', 'roxtar' ),
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
	'roxtar_setting[container_width]',
	array(
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'default'           => $defaults['container_width'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[container_width]',
		array(
			'section'  => 'roxtar_container',
			'settings' => 'roxtar_setting[container_width]',
			'type'     => 'select',
			'label'    => __( 'Container width', 'roxtar' ),
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


// Content Spacing
$wp_customize->add_setting(
	'roxtar_setting[content_spacing]',
	array(
		'default'           => $defaults['content_spacing'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[content_spacing]',
		array(
			'label'    => __( 'Horizontal spacing', 'roxtar' ),
			'section'  => 'roxtar_container',
			'settings' => array(
				'desktop' => 'roxtar_setting[content_spacing]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_content_spacing_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_content_spacing_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);



// Vertical Spacing
$wp_customize->add_setting(
	'roxtar_setting[vertical_spacing]',
	array(
		'default'           => $defaults['vertical_spacing'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[vertical_spacing]',
		array(
			'label'    => __( 'Vertical spacing', 'roxtar' ),
			'section'  => 'roxtar_container',
			'settings' => array(
				'desktop' => 'roxtar_setting[vertical_spacing]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_vertical_spacing_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_vertical_spacing_max_step', 50 ),
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
	'roxtar_setting[border_radius]',
	array(
		'default'           => $defaults['border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[border_radius]',
		array(
			'label'    => __( 'Border Radius', 'roxtar' ),
			'section'  => 'roxtar_container',
			'settings' => array(
				'desktop' => 'roxtar_setting[border_radius]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_border_radius_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);



// Divider.
$wp_customize->add_setting(
	'site_container_mid_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Divider_Control(
		$wp_customize,
		'site_container_mid_divider',
		array(
			'section'  => 'roxtar_container',
			'settings' => 'site_container_mid_divider',
			'type'     => 'divider',
		)
	)
);



// Default container.
$wp_customize->add_setting(
	'roxtar_setting[default_container]',
	array(
		'type'              => 'option',
		'default'           => $defaults['default_container'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[default_container]',
		array(
			'label'    => __( 'Default Container', 'roxtar' ),
			'section'  => 'roxtar_container',
			'type'     => 'select',
			'settings' => 'roxtar_setting[default_container]',
			'choices'  => $default_container,
		)
	)
);

// Page container.
$wp_customize->add_setting(
	'roxtar_setting[page_container]',
	array(
		'type'              => 'option',
		'default'           => $defaults['page_container'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[page_container]',
		array(
			'label'    => __( 'Page Container', 'roxtar' ),
			'section'  => 'roxtar_container',
			'type'     => 'select',
			'settings' => 'roxtar_setting[page_container]',
			'choices'  => $other_container,
		)
	)
);

// Blog single container.
$wp_customize->add_setting(
	'roxtar_setting[blog_single_container]',
	array(
		'type'              => 'option',
		'default'           => $defaults['blog_single_container'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[blog_single_container]',
		array(
			'label'    => __( 'Blog Single Container', 'roxtar' ),
			'section'  => 'roxtar_container',
			'type'     => 'select',
			'settings' => 'roxtar_setting[blog_single_container]',
			'choices'  => $other_container,
		)
	)
);

// Archive container.
$wp_customize->add_setting(
	'roxtar_setting[archive_container]',
	array(
		'type'              => 'option',
		'default'           => $defaults['archive_container'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[archive_container]',
		array(
			'label'    => __( 'Archives Container', 'roxtar' ),
			'section'  => 'roxtar_container',
			'type'     => 'select',
			'settings' => 'roxtar_setting[archive_container]',
			'choices'  => $other_container,
		)
	)
);

// Shop container.
if ( roxtar_is_woocommerce_activated() ) {
	// Divider.
	$wp_customize->add_setting(
		'site_container_end_divider',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new Roxtar_Divider_Control(
			$wp_customize,
			'site_container_end_divider',
			array(
				'section'  => 'roxtar_container',
				'settings' => 'site_container_end_divider',
				'type'     => 'divider',
			)
		)
	);

	// Shop container.
	$wp_customize->add_setting(
		'roxtar_setting[shop_container]',
		array(
			'type'              => 'option',
			'default'           => $defaults['shop_container'],
			'sanitize_callback' => 'roxtar_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'roxtar_setting[shop_container]',
			array(
				'label'    => __( 'Shop Container', 'roxtar' ),
				'section'  => 'roxtar_container',
				'type'     => 'select',
				'settings' => 'roxtar_setting[shop_container]',
				'choices'  => $other_container,
			)
		)
	);

	// Shop single container.
	$wp_customize->add_setting(
		'roxtar_setting[shop_single_container]',
		array(
			'type'              => 'option',
			'default'           => $defaults['shop_single_container'],
			'sanitize_callback' => 'roxtar_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'roxtar_setting[shop_single_container]',
			array(
				'label'    => __( 'Shop Single Container', 'roxtar' ),
				'section'  => 'roxtar_container',
				'type'     => 'select',
				'settings' => 'roxtar_setting[shop_single_container]',
				'choices'  => $other_container,
			)
		)
	);
}
