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



// Add weight amount to price
$wp_customize->add_setting(
	'SKDD_setting[single_product_weight]',
	[
		'default'           => $defaults['single_product_weight'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
	]
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[single_product_weight]',
		[
			'label'       => __( 'Add weight to price', 'SKDD' ),
			'description' => __( 'Show the per weight after the price so customers know how much they pay per kilo', 'SKDD' ),
			'settings'    => 'SKDD_setting[single_product_weight]',
			'section'     => 'SKDD_wholesale_page',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_single_product_weight_choices',
				array(
					'none'   => __( 'Do not show', 'SKDD' ),
					'actual' => __( 'Show actual amount', 'SKDD' ),
					'kilo'  => __( 'Show per kilo', 'SKDD' ),
					'gram'  => __( 'Show per gram', 'SKDD' ),
				)
			),
		]
	)
);

// Tab Order
$wp_customize->add_setting(
	'SKDD_setting[wc_tab_order]',
	[
		'default'           => $defaults['wc_tab_order'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
	]
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[wc_tab_order]',
		[
			'label'       => __( 'Add weight to price', 'SKDD' ),
			'description' => __( 'Show the per weight after the price so customers know how much they pay per kilo', 'SKDD' ),
			'settings'    => 'SKDD_setting[wc_tab_order]',
			'section'     => 'SKDD_wholesale_page',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_wc_tab_order_choices',
				array(
					'default'   => __( 'Default Order', 'SKDD' ),
					'specs_first' => __( 'Product Specs First', 'SKDD' ),
					'reviews_first' => __( 'Product Reviews First', 'SKDD' ),
				)
			),
		]
	)
);