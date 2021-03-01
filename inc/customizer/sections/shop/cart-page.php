<?php
/**
 * Cart page customizer
 *
 * @package roxtar
 */

if ( ! roxtar_is_woocommerce_activated() ) {
	return;
}

// Default values.
$defaults = roxtar_options();

// Cart page layout.
$wp_customize->add_setting(
	'roxtar_setting[cart_page_layout]',
	[
		'default'           => $defaults['cart_page_layout'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	]
);
$wp_customize->add_control(
	new Roxtar_Radio_Image_Control(
		$wp_customize,
		'roxtar_setting[cart_page_layout]',
		[
			'label'    => __( 'Cart Page Layout', 'roxtar' ),
			'section'  => 'roxtar_cart_page',
			'settings' => 'roxtar_setting[cart_page_layout]',
			'choices'  => apply_filters(
				'roxtar_setting_cart_page_layout_choices',
				[
					'layout-1' => ROXTAR_THEME_URI . 'assets/images/customizer/cart-page/layout-1.jpg',
					'layout-2' => ROXTAR_THEME_URI . 'assets/images/customizer/cart-page/layout-2.jpg',
				]
			),
		]
	)
);

// Sticky proceed to checkout button.
$wp_customize->add_setting(
	'roxtar_setting[cart_page_sticky_proceed_button]',
	[
		'default'           => $defaults['cart_page_sticky_proceed_button'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	]
);

$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[cart_page_sticky_proceed_button]',
		[
			'label'       => __( 'Sticky Proceed To Checkout Button', 'roxtar' ),
			'description' => __( 'This option only available on mobile devices', 'roxtar' ),
			'settings'    => 'roxtar_setting[cart_page_sticky_proceed_button]',
			'section'     => 'roxtar_cart_page',
		]
	)
);
