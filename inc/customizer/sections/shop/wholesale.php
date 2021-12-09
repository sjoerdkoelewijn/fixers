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

// Only show price when logged in
$wp_customize->add_setting(
	'SKDD_setting[only_show_price_when_logged_in]',
	[
		'default'           => $defaults['only_show_price_when_logged_in'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	]
);

$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[only_show_price_when_logged_in]',
		[
			'label'       => __( 'Only show price when logged in', 'SKDD' ),
			'description' => __( 'Hide price and add to cart for users that are not logged in', 'SKDD' ),
			'settings'    => 'SKDD_setting[only_show_price_when_logged_in]',
			'section'     => 'SKDD_wholesale_page',
		]
	)
);
