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
			'label'    => __( 'Add custom meta tags to the head section', 'SKDD' ),
			'type'     => 'textarea',
			'section'  => 'SKDD_header',
			'settings' => 'SKDD_setting[custom_meta_tags]',
		)
	)
);