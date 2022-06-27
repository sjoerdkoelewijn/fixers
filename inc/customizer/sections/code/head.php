<?php
/**
 * Head sectie
 *
 * @package SKDD
 */

// Custom code to the head section
$wp_customize->add_setting(
	'SKDD_setting[custom_meta_tags]',
	array(
		'default'           => $defaults['custom_meta_tags'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[custom_meta_tags]',
		array(
			'label'    => __( 'Add custom tags to the head section', 'SKDD' ),
			'type'     => 'textarea',
			'section'  => 'SKDD_head_code',
			'settings' => 'SKDD_setting[custom_meta_tags]',
		)
	)
);



// Enable Readspeaker.
$wp_customize->add_setting(
	'SKDD_setting[readspeaker_enabled]',
	array(
		'type'              => 'option',
		'default'           => $defaults['readspeaker_enabled'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[readspeaker_enabled]',
		array(
			'label'    => __( 'Enable Readspeaker', 'SKDD' ),
			'section'  => 'SKDD_head_code',
			'settings' => 'SKDD_setting[readspeaker_enabled]',
		)
	)
);


// Readspeaker customer ID
$wp_customize->add_setting(
	'SKDD_setting[readspeaker_id]',
	array(
		'default'           => $defaults['readspeaker_id'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[readspeaker_id]',
		array(
			'label'    => __( 'Readspeaker Customer ID', 'SKDD' ),
			'type'     => 'number',
			'section'  => 'SKDD_head_code',
			'settings' => 'SKDD_setting[readspeaker_id]',
		)
	)
);

