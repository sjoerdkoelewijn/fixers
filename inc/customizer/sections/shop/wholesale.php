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

// Only show price when logged in
$wp_customize->add_setting(
	'roxtar_setting[only_show_price_when_logged_in]',
	[
		'default'           => $defaults['only_show_price_when_logged_in'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	]
);

$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[only_show_price_when_logged_in]',
		[
			'label'       => __( 'Only show price when logged in', 'roxtar' ),
			'description' => __( 'Hide price and add to cart for users that are not logged in', 'roxtar' ),
			'settings'    => 'roxtar_setting[only_show_price_when_logged_in]',
			'section'     => 'roxtar_wholesale_page',
		]
	)
);



// Add weight amount to price
$wp_customize->add_setting(
	'roxtar_setting[single_product_weight]',
	[
		'default'           => $defaults['single_product_weight'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	]
);

$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[single_product_weight]',
		[
			'label'       => __( 'Add weight to price', 'roxtar' ),
			'description' => __( 'Show the per weight after the price so customers know how much they pay per kilo', 'roxtar' ),
			'settings'    => 'roxtar_setting[single_product_weight]',
			'section'     => 'roxtar_wholesale_page',
		]
	)
);