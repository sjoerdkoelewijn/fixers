<?php
/**
 * Sidebar customizer
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Default sidebar.
$wp_customize->add_setting(
	'SKDD_setting[sidebar_default]',
	array(
		'default'           => $defaults['sidebar_default'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[sidebar_default]',
		array(
			'label'    => __( 'Default', 'SKDD' ),
			'section'  => 'SKDD_sidebar',
			'settings' => 'SKDD_setting[sidebar_default]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_sidebar_default_choices',
				array(
					'full'  => __( 'No sidebar', 'SKDD' ),
					'left'  => __( 'Left sidebar', 'SKDD' ),
					'right' => __( 'Right sidebar', 'SKDD' ),
				)
			),
		)
	)
);

// Page sidebar.
$wp_customize->add_setting(
	'SKDD_setting[sidebar_page]',
	array(
		'default'           => $defaults['sidebar_page'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[sidebar_page]',
		array(
			'label'    => __( 'Page', 'SKDD' ),
			'section'  => 'SKDD_sidebar',
			'settings' => 'SKDD_setting[sidebar_page]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_sidebar_page_choices',
				array(
					'default' => __( 'Default', 'SKDD' ),
					'full'    => __( 'No sidebar', 'SKDD' ),
					'left'    => __( 'Left sidebar', 'SKDD' ),
					'right'   => __( 'Right sidebar', 'SKDD' ),
				)
			),
		)
	)
);

// Blog sidebar divider.
$wp_customize->add_setting(
	'blog_sidebar_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'blog_sidebar_divider',
		array(
			'section'  => 'SKDD_sidebar',
			'settings' => 'blog_sidebar_divider',
			'type'     => 'divider',
		)
	)
);

// Blog archive sidebar.
$wp_customize->add_setting(
	'SKDD_setting[sidebar_blog]',
	array(
		'default'           => $defaults['sidebar_blog'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[sidebar_blog]',
		array(
			'label'    => __( 'Blog List', 'SKDD' ),
			'section'  => 'SKDD_sidebar',
			'settings' => 'SKDD_setting[sidebar_blog]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_sidebar_blog_choices',
				array(
					'default' => __( 'Default', 'SKDD' ),
					'full'    => __( 'No sidebar', 'SKDD' ),
					'left'    => __( 'Left sidebar', 'SKDD' ),
					'right'   => __( 'Right sidebar', 'SKDD' ),
				)
			),
		)
	)
);

// Blog single sidebar.
$wp_customize->add_setting(
	'SKDD_setting[sidebar_blog_single]',
	array(
		'default'           => $defaults['sidebar_blog_single'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[sidebar_blog_single]',
		array(
			'label'    => __( 'Blog Single', 'SKDD' ),
			'section'  => 'SKDD_sidebar',
			'settings' => 'SKDD_setting[sidebar_blog_single]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_sidebar_blog_single_choices',
				array(
					'default' => __( 'Default', 'SKDD' ),
					'full'    => __( 'No sidebar', 'SKDD' ),
					'left'    => __( 'Left sidebar', 'SKDD' ),
					'right'   => __( 'Right sidebar', 'SKDD' ),
				)
			),
		)
	)
);

if ( class_exists( 'woocommerce' ) ) {
	// woocommerce divider.
	$wp_customize->add_setting(
		'woocommerce_sidebar_divider',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new SKDD_Divider_Control(
			$wp_customize,
			'woocommerce_sidebar_divider',
			array(
				'section'  => 'SKDD_sidebar',
				'settings' => 'woocommerce_sidebar_divider',
				'type'     => 'divider',
			)
		)
	);

	// Shop page sidebar.
	$wp_customize->add_setting(
		'SKDD_setting[sidebar_shop]',
		array(
			'default'           => $defaults['sidebar_shop'],
			'sanitize_callback' => 'SKDD_sanitize_choices',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'SKDD_setting[sidebar_shop]',
			array(
				'label'    => __( 'Shop/Product Archive', 'SKDD' ),
				'section'  => 'SKDD_sidebar',
				'settings' => 'SKDD_setting[sidebar_shop]',
				'type'     => 'select',
				'choices'  => apply_filters(
					'SKDD_setting_sidebar_shop_choices',
					array(
						'default' => __( 'Default', 'SKDD' ),
						'full'    => __( 'No sidebar', 'SKDD' ),
						'left'    => __( 'Left sidebar', 'SKDD' ),
						'right'   => __( 'Right sidebar', 'SKDD' ),
					)
				),
			)
		)
	);

	// Product page sidebar.
	$wp_customize->add_setting(
		'SKDD_setting[sidebar_shop_single]',
		array(
			'default'           => $defaults['sidebar_shop_single'],
			'sanitize_callback' => 'SKDD_sanitize_choices',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'SKDD_setting[sidebar_shop_single]',
			array(
				'label'    => __( 'Shop Single', 'SKDD' ),
				'section'  => 'SKDD_sidebar',
				'settings' => 'SKDD_setting[sidebar_shop_single]',
				'type'     => 'select',
				'choices'  => apply_filters(
					'SKDD_setting_sidebar_shop_single_choices',
					array(
						'default' => __( 'Default', 'SKDD' ),
						'full'    => __( 'No sidebar', 'SKDD' ),
						'left'    => __( 'Left sidebar', 'SKDD' ),
						'right'   => __( 'Right sidebar', 'SKDD' ),
					)
				),
			)
		)
	);
}

// Blog sidebar divider.
$wp_customize->add_setting(
	'width_sidebar_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'width_sidebar_divider',
		array(
			'section'  => 'SKDD_sidebar',
			'settings' => 'width_sidebar_divider',
			'type'     => 'divider',
		)
	)
);

// Width.
$wp_customize->add_setting(
	'SKDD_setting[sidebar_width]',
	array(
		'default'           => $defaults['sidebar_width'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[sidebar_width]',
		array(
			'label'    => __( 'Sidebar Width', 'SKDD' ),
			'section'  => 'SKDD_sidebar',
			'settings' => array(
				'desktop' => 'SKDD_setting[sidebar_width]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_sidebar_width_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_sidebar_width_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => '%',
				),
			),
		)
	)
);
