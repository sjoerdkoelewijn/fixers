<?php
/**
 * Site Title & Tagline
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();


// Logo mobile.
$wp_customize->add_setting(
	'roxtar_setting[logo_mobile]',
	array(
		'type'              => 'option',
		'default'           => $defaults['logo_mobile'],
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'roxtar_setting[logo_mobile]',
		array(
			'label'    => __( 'Mobile Logo (Optional)', 'roxtar' ),
			'section'  => 'title_tagline',
			'settings' => 'roxtar_setting[logo_mobile]',
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
	new Roxtar_Divider_Control(
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
	'roxtar_setting[logo_width]',
	array(
		'default'           => $defaults['logo_width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_setting(
	'roxtar_setting[tablet_logo_width]',
	array(
		'default'           => $defaults['tablet_logo_width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_setting(
	'roxtar_setting[mobile_logo_width]',
	array(
		'default'           => $defaults['mobile_logo_width'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[logo_width]',
		array(
			'type'     => 'roxtar-range-slider',
			'label'    => __( 'Logo Width', 'roxtar' ),
			'section'  => 'title_tagline',
			'settings' => array(
				'desktop' => 'roxtar_setting[logo_width]',
				'tablet'  => 'roxtar_setting[tablet_logo_width]',
				'mobile'  => 'roxtar_setting[mobile_logo_width]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_logo_desktop_width_min_step', 50 ),
					'max'  => apply_filters( 'roxtar_logo_desktop_width_max_step', 500 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'tablet' => array(
					'min'  => apply_filters( 'roxtar_logo_tablet_width_min_step', 50 ),
					'max'  => apply_filters( 'roxtar_logo_tablet_width_max_step', 500 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
				'mobile' => array(
					'min'  => apply_filters( 'roxtar_logo_mobile_width_min_step', 50 ),
					'max'  => apply_filters( 'roxtar_logo_mobile_width_max_step', 500 ),
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
	new Roxtar_Divider_Control(
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
