<?php
/**
 * Cart page customizer
 *
 * @package SKDD
 */

if ( ! SKDD_is_woocommerce_activated() ) {
	return;
}

// Default values.
$defaults = SKDD_options();

// Cart page layout.
$wp_customize->add_setting(
	'SKDD_setting[cart_page_layout]',
	[
		'default'           => $defaults['cart_page_layout'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	]
);
$wp_customize->add_control(
	new SKDD_Radio_Image_Control(
		$wp_customize,
		'SKDD_setting[cart_page_layout]',
		[
			'label'    => __( 'Cart Page Layout', 'SKDD' ),
			'section'  => 'SKDD_cart_page',
			'settings' => 'SKDD_setting[cart_page_layout]',
			'choices'  => apply_filters(
				'SKDD_setting_cart_page_layout_choices',
				[
					'layout-1' => SKDD_THEME_URI . 'assets/images/customizer/cart-page/layout-1.jpg',
					'layout-2' => SKDD_THEME_URI . 'assets/images/customizer/cart-page/layout-2.jpg',
				]
			),
		]
	)
);

// Sticky proceed to checkout button.
$wp_customize->add_setting(
	'SKDD_setting[cart_page_sticky_proceed_button]',
	[
		'default'           => $defaults['cart_page_sticky_proceed_button'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	]
);

$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[cart_page_sticky_proceed_button]',
		[
			'label'       => __( 'Sticky Proceed To Checkout Button', 'SKDD' ),
			'description' => __( 'This option only available on mobile devices', 'SKDD' ),
			'settings'    => 'SKDD_setting[cart_page_sticky_proceed_button]',
			'section'     => 'SKDD_cart_page',
		]
	)
);
