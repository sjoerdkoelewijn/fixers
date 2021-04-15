<?php
/**
 * Header
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Header layout.
$wp_customize->add_setting(
	'SKDD_setting[header_layout]',
	array(
		'default'           => $defaults['header_layout'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Radio_Image_Control(
		$wp_customize,
		'SKDD_setting[header_layout]',
		array(
			'label'    => __( 'Header Layout', 'SKDD' ),
			'section'  => 'SKDD_header',
			'settings' => 'SKDD_setting[header_layout]',
			'choices'  => apply_filters(
				'SKDD_setting_header_layout_choices',
				array(
					'layout-1' => SKDD_THEME_URI . 'assets/images/customizer/header/SKDD-header-1.jpg',
					'layout-2' => SKDD_THEME_URI . 'assets/images/customizer/header/SKDD-header-2.jpg',
					'layout-3' => SKDD_THEME_URI . 'assets/images/customizer/header/SKDD-header-3.jpg',
					'layout-4' => SKDD_THEME_URI . 'assets/images/customizer/header/SKDD-header-4.jpg',
				)
			),
		)
	)
);


// Menu Breakpoint.
$wp_customize->add_setting(
	'SKDD_setting[header_max_height]',
	array(
		'default'           => $defaults['header_max_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[header_max_height]',
		array(
			'priority' => 46,
			'label'    => __( 'Max Height', 'SKDD' ),
			'section'  => 'SKDD_header',
			'settings' => array(
				'desktop' => 'SKDD_setting[header_max_height]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_header_max_height_min_step', 50 ),
					'max'  => apply_filters( 'SKDD_header_max_height_max_step', 400 ),
					'step' => 10,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// After background color divider.
$wp_customize->add_setting(
	'header_after_background_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'header_after_background_color_divider',
		array(
			'priority' => 40,
			'section'  => 'SKDD_header',
			'settings' => 'header_after_background_color_divider',
			'type'     => 'divider',
		)
	)
);

// Header element title.
$wp_customize->add_setting(
	'header_element_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'header_element_title',
		array(
			'priority' => 50,
			'section'  => 'SKDD_header',
			'settings' => 'header_element_title',
			'type'     => 'heading',
			'label'    => __( 'Elements', 'SKDD' ),
		)
	)
);

// HEADER ELEMENT.
// Header menu.
$wp_customize->add_setting(
	'SKDD_setting[header_primary_menu]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_primary_menu'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[header_primary_menu]',
		array(
			'priority' => 70,
			'label'    => __( 'Header Menu', 'SKDD' ),
			'section'  => 'SKDD_header',
			'settings' => 'SKDD_setting[header_primary_menu]',
		)
	)
);

// Menu Breakpoint.
$wp_customize->add_setting(
	'SKDD_setting[header_menu_breakpoint]',
	array(
		'default'           => $defaults['header_menu_breakpoint'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[header_menu_breakpoint]',
		array(
			'priority' => 46,
			'label'    => __( 'Menu Breakpoint', 'SKDD' ),
			'section'  => 'SKDD_header',
			'settings' => array(
				'desktop' => 'SKDD_setting[header_menu_breakpoint]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_header_menu_breakpoint_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_header_menu_breakpoint_max_step', 6000 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Header widget area.
$wp_customize->add_setting(
	'SKDD_setting[header_widget_area]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_widget_area'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[header_widget_area]',
		array(
			'priority' => 90,
			'label'    => __( 'Widget area', 'SKDD' ),
			'section'  => 'SKDD_header',
			'settings' => 'SKDD_setting[header_widget_area]',
		)
	)
);

// Search icon.
$wp_customize->add_setting(
	'SKDD_setting[header_search_icon]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_search_icon'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[header_search_icon]',
		array(
			'priority' => 90,
			'label'    => __( 'Search Icon', 'SKDD' ),
			'section'  => 'SKDD_header',
			'settings' => 'SKDD_setting[header_search_icon]',
		)
	)
);

// Woocommerce.
if ( class_exists( 'woocommerce' ) ) {
	// Search product only.
	$wp_customize->add_setting(
		'SKDD_setting[header_search_only_product]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_search_only_product'],
			'sanitize_callback' => 'SKDD_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new SKDD_Switch_Control(
			$wp_customize,
			'SKDD_setting[header_search_only_product]',
			array(
				'priority' => 110,
				'label'    => __( 'Search Only Product', 'SKDD' ),
				'section'  => 'SKDD_header',
				'settings' => 'SKDD_setting[header_search_only_product]',
			)
		)
	);

	// Wishlist icon.
	if ( SKDD_support_wishlist_plugin() ) {
		$wp_customize->add_setting(
			'SKDD_setting[header_wishlist_icon]',
			array(
				'type'              => 'option',
				'default'           => $defaults['header_wishlist_icon'],
				'sanitize_callback' => 'SKDD_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new SKDD_Switch_Control(
				$wp_customize,
				'SKDD_setting[header_wishlist_icon]',
				array(
					'priority' => 130,
					'label'    => __( 'Wishlist Icon', 'SKDD' ),
					'section'  => 'SKDD_header',
					'settings' => 'SKDD_setting[header_wishlist_icon]',
				)
			)
		);
	}

	// Account icon.
	$wp_customize->add_setting(
		'SKDD_setting[header_account_icon]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_account_icon'],
			'sanitize_callback' => 'SKDD_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new SKDD_Switch_Control(
			$wp_customize,
			'SKDD_setting[header_account_icon]',
			array(
				'priority' => 150,
				'label'    => __( 'Account Icon', 'SKDD' ),
				'section'  => 'SKDD_header',
				'settings' => 'SKDD_setting[header_account_icon]',
			)
		)
	);

	// Shopping bag icon.
	$wp_customize->add_setting(
		'SKDD_setting[header_shop_cart_icon]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_shop_cart_icon'],
			'sanitize_callback' => 'SKDD_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new SKDD_Switch_Control(
			$wp_customize,
			'SKDD_setting[header_shop_cart_icon]',
			array(
				'priority' => 170,
				'label'    => __( 'Shopping Cart Icon', 'SKDD' ),
				'section'  => 'SKDD_header',
				'settings' => 'SKDD_setting[header_shop_cart_icon]',
			)
		)
	);
}
