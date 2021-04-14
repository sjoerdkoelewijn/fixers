<?php
/**
 * Site Title & Tagline
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();


// Logo mobile.
$wp_customize->add_setting(
	'SKDD_setting[logo_mobile]',
	array(
		'type'              => 'option',
		'default'           => $defaults['logo_mobile'],
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'SKDD_setting[logo_mobile]',
		array(
			'label'    => __( 'Mobile Logo (Optional)', 'SKDD' ),
			'section'  => 'title_tagline',
			'settings' => 'SKDD_setting[logo_mobile]',
			'priority' => 8,
		)
	)
);

// Above logo width divider.
$wp_customize->add_setting(
	'above_logo_with_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'above_logo_with_color_divider',
		array(
			'section'  => 'title_tagline',
			'settings' => 'above_logo_with_color_divider',
			'type'     => 'divider',
			'priority' => 8,
		)
	)
);

// Logo width.
$wp_customize->add_setting(
	'SKDD_setting[logo_width]',
	array(
		'default'           => $defaults['logo_width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_setting(
	'SKDD_setting[tablet_logo_width]',
	array(
		'default'           => $defaults['tablet_logo_width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_setting(
	'SKDD_setting[mobile_logo_width]',
	array(
		'default'           => $defaults['mobile_logo_width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[logo_width]',
		array(
			'type'     => 'SKDD-range-slider',
			'label'    => __( 'Logo Width', 'SKDD' ),
			'section'  => 'title_tagline',
			'settings' => array(
				'desktop' => 'SKDD_setting[logo_width]',
				'tablet'  => 'SKDD_setting[tablet_logo_width]',
				'mobile'  => 'SKDD_setting[mobile_logo_width]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_logo_desktop_width_min_step', 50 ),
					'max'  => apply_filters( 'SKDD_logo_desktop_width_max_step', 500 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'SKDD_logo_tablet_width_min_step', 50 ),
					'max'  => apply_filters( 'SKDD_logo_tablet_width_max_step', 500 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'SKDD_logo_mobile_width_min_step', 50 ),
					'max'  => apply_filters( 'SKDD_logo_mobile_width_max_step', 500 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
			'priority' => 8,
		)
	)
);

// Under logo width divider.
$wp_customize->add_setting(
	'under_logo_with_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'under_logo_with_color_divider',
		array(
			'section'  => 'title_tagline',
			'settings' => 'under_logo_with_color_divider',
			'type'     => 'divider',
			'priority' => 8,
		)
	)
);
