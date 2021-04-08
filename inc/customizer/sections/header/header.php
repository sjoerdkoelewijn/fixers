<?php
/**
 * Header
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Header layout.
$wp_customize->add_setting(
	'roxtar_setting[header_layout]',
	array(
		'default'           => $defaults['header_layout'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Radio_Image_Control(
		$wp_customize,
		'roxtar_setting[header_layout]',
		array(
			'label'    => __( 'Header Layout', 'roxtar' ),
			'section'  => 'roxtar_header',
			'settings' => 'roxtar_setting[header_layout]',
			'choices'  => apply_filters(
				'roxtar_setting_header_layout_choices',
				array(
					'layout-1' => ROXTAR_THEME_URI . 'assets/images/customizer/header/roxtar-header-1.jpg',
					'layout-2' => ROXTAR_THEME_URI . 'assets/images/customizer/header/roxtar-header-2.jpg',
				)
			),
		)
	)
);


// Menu Breakpoint.
$wp_customize->add_setting(
	'roxtar_setting[header_max_height]',
	array(
		'default'           => $defaults['header_max_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[header_max_height]',
		array(
			'priority' => 46,
			'label'    => __( 'Max Height', 'roxtar' ),
			'section'  => 'roxtar_header',
			'settings' => array(
				'desktop' => 'roxtar_setting[header_max_height]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_header_max_height_min_step', 50 ),
					'max'  => apply_filters( 'roxtar_header_max_height_max_step', 400 ),
					'step' => 10,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);



// Background color.
$wp_customize->add_setting(
	'roxtar_setting[header_background_color]',
	array(
		'default'           => $defaults['header_background_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[header_background_color]',
		array(
			'priority' => 30,
			'label'    => __( 'Header Background', 'roxtar' ),
			'section'  => 'roxtar_header',
			'settings' => 'roxtar_setting[header_background_color]',
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'header_after_background_color_divider',
		array(
			'priority' => 40,
			'section'  => 'roxtar_header',
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'header_element_title',
		array(
			'priority' => 50,
			'section'  => 'roxtar_header',
			'settings' => 'header_element_title',
			'type'     => 'heading',
			'label'    => __( 'Elements', 'roxtar' ),
		)
	)
);

// HEADER ELEMENT.
// Header menu.
$wp_customize->add_setting(
	'roxtar_setting[header_primary_menu]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_primary_menu'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[header_primary_menu]',
		array(
			'priority' => 70,
			'label'    => __( 'Header Menu', 'roxtar' ),
			'section'  => 'roxtar_header',
			'settings' => 'roxtar_setting[header_primary_menu]',
		)
	)
);

// Menu Breakpoint.
$wp_customize->add_setting(
	'roxtar_setting[header_menu_breakpoint]',
	array(
		'default'           => $defaults['header_menu_breakpoint'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[header_menu_breakpoint]',
		array(
			'priority' => 46,
			'label'    => __( 'Menu Breakpoint', 'roxtar' ),
			'section'  => 'roxtar_header',
			'settings' => array(
				'desktop' => 'roxtar_setting[header_menu_breakpoint]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_header_menu_breakpoint_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_header_menu_breakpoint_max_step', 6000 ),
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
	'roxtar_setting[header_widget_area]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_widget_area'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[header_widget_area]',
		array(
			'priority' => 90,
			'label'    => __( 'Widget area', 'roxtar' ),
			'section'  => 'roxtar_header',
			'settings' => 'roxtar_setting[header_widget_area]',
		)
	)
);

// Search icon.
$wp_customize->add_setting(
	'roxtar_setting[header_search_icon]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_search_icon'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[header_search_icon]',
		array(
			'priority' => 90,
			'label'    => __( 'Search Icon', 'roxtar' ),
			'section'  => 'roxtar_header',
			'settings' => 'roxtar_setting[header_search_icon]',
		)
	)
);

// Woocommerce.
if ( class_exists( 'woocommerce' ) ) {
	// Search product only.
	$wp_customize->add_setting(
		'roxtar_setting[header_search_only_product]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_search_only_product'],
			'sanitize_callback' => 'roxtar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Roxtar_Switch_Control(
			$wp_customize,
			'roxtar_setting[header_search_only_product]',
			array(
				'priority' => 110,
				'label'    => __( 'Search Only Product', 'roxtar' ),
				'section'  => 'roxtar_header',
				'settings' => 'roxtar_setting[header_search_only_product]',
			)
		)
	);

	// Wishlist icon.
	if ( roxtar_support_wishlist_plugin() ) {
		$wp_customize->add_setting(
			'roxtar_setting[header_wishlist_icon]',
			array(
				'type'              => 'option',
				'default'           => $defaults['header_wishlist_icon'],
				'sanitize_callback' => 'roxtar_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new Roxtar_Switch_Control(
				$wp_customize,
				'roxtar_setting[header_wishlist_icon]',
				array(
					'priority' => 130,
					'label'    => __( 'Wishlist Icon', 'roxtar' ),
					'section'  => 'roxtar_header',
					'settings' => 'roxtar_setting[header_wishlist_icon]',
				)
			)
		);
	}

	// Account icon.
	$wp_customize->add_setting(
		'roxtar_setting[header_account_icon]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_account_icon'],
			'sanitize_callback' => 'roxtar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Roxtar_Switch_Control(
			$wp_customize,
			'roxtar_setting[header_account_icon]',
			array(
				'priority' => 150,
				'label'    => __( 'Account Icon', 'roxtar' ),
				'section'  => 'roxtar_header',
				'settings' => 'roxtar_setting[header_account_icon]',
			)
		)
	);

	// Shopping bag icon.
	$wp_customize->add_setting(
		'roxtar_setting[header_shop_cart_icon]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_shop_cart_icon'],
			'sanitize_callback' => 'roxtar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Roxtar_Switch_Control(
			$wp_customize,
			'roxtar_setting[header_shop_cart_icon]',
			array(
				'priority' => 170,
				'label'    => __( 'Shopping Cart Icon', 'roxtar' ),
				'section'  => 'roxtar_header',
				'settings' => 'roxtar_setting[header_shop_cart_icon]',
			)
		)
	);
}
