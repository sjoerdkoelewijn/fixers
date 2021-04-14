<?php
/**
 * Checkout page customizer
 *
 * @package SKDD
 */

if ( ! SKDD_is_woocommerce_activated() ) {
	return;
}

// Default values.
$defaults = SKDD_options();

// Distraction Free Checkout.
$wp_customize->add_setting(
	'SKDD_setting[checkout_distraction_free]',
	array(
		'default'           => $defaults['checkout_distraction_free'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[checkout_distraction_free]',
		array(
			'label'    => __( 'Distraction Free Checkout', 'SKDD' ),
			'settings' => 'SKDD_setting[checkout_distraction_free]',
			'section'  => 'woocommerce_checkout',
			'priority' => 0,
		)
	)
);

// Multi step checkout.
$wp_customize->add_setting(
	'SKDD_setting[checkout_multi_step]',
	array(
		'default'           => $defaults['checkout_multi_step'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[checkout_multi_step]',
		array(
			'label'    => __( 'Multi Step Checkout', 'SKDD' ),
			'settings' => 'SKDD_setting[checkout_multi_step]',
			'section'  => 'woocommerce_checkout',
			'priority' => 0,
		)
	)
);

// Sticky place order button.
$wp_customize->add_setting(
	'SKDD_setting[checkout_sticky_place_order_button]',
	array(
		'default'           => $defaults['checkout_sticky_place_order_button'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[checkout_sticky_place_order_button]',
		array(
			'label'       => __( 'Sticky Place Order Button', 'SKDD' ),
			'description' => __( 'This option only available on mobile devices', 'SKDD' ),
			'settings'    => 'SKDD_setting[checkout_sticky_place_order_button]',
			'section'     => 'woocommerce_checkout',
			'priority'    => 0,
		)
	)
);

// Theme checkout divider.
$wp_customize->add_setting(
	'SKDD_checkout_start',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'SKDD_checkout_start',
		array(
			'section'  => 'woocommerce_checkout',
			'settings' => 'SKDD_checkout_start',
			'type'     => 'divider',
			'priority' => 0,
		)
	)
);
