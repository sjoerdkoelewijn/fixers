<?php
/* Custom Post TypeS */

// Default values.
$defaults = SKDD_options();

// Show portfolio cpt
$wp_customize->add_setting(
	'SKDD_setting[cpt_portfolio_display]',
	array(
		'type'              => 'option',
		'default'           => $defaults['cpt_portfolio_display'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[cpt_portfolio_display]',
		array(
			'label'    => __( 'Portfolio Post Type', 'SKDD' ),
			'section'  => 'SKDD_custom_post_types',
			'settings' => 'SKDD_setting[cpt_portfolio_display]',
		)
	)
);


// ----------------------------------------------------------------------------------------------------------

$wp_customize->add_setting(
	'services_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'services_divider',
		array(
			'section'  => 'SKDD_custom_post_types',
			'settings' => 'services_divider',
			'type'     => 'divider',
		)
	)
);

// Show diensten cpt
$wp_customize->add_setting(
	'SKDD_setting[cpt_services_display]',
	array(
		'type'              => 'option',
		'default'           => $defaults['cpt_services_display'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[cpt_services_display]',
		array(
			'label'    => __( 'Services Post Type', 'SKDD' ),
			'section'  => 'SKDD_custom_post_types',
			'settings' => 'SKDD_setting[cpt_services_display]',
		)
	)
);


// ----------------------------------------------------------------------------------------------------------

$wp_customize->add_setting(
	'knowledge_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'knowledge_divider',
		array(
			'section'  => 'SKDD_custom_post_types',
			'settings' => 'knowledge_divider',
			'type'     => 'divider',
		)
	)
);

// Show diensten cpt
$wp_customize->add_setting(
	'SKDD_setting[cpt_knowledge_display]',
	array(
		'type'              => 'option',
		'default'           => $defaults['cpt_knowledge_display'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[cpt_knowledge_display]',
		array(
			'label'    => __( 'Knowledge Base Post Type', 'SKDD' ),
			'section'  => 'SKDD_custom_post_types',
			'settings' => 'SKDD_setting[cpt_knowledge_display]',
		)
	)
);


// ----------------------------------------------------------------------------------------------------------

$wp_customize->add_setting(
	'team_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'team_divider',
		array(
			'section'  => 'SKDD_custom_post_types',
			'settings' => 'team_divider',
			'type'     => 'divider',
		)
	)
);

// Show diensten cpt
$wp_customize->add_setting(
	'SKDD_setting[cpt_team_display]',
	array(
		'type'              => 'option',
		'default'           => $defaults['cpt_team_display'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[cpt_team_display]',
		array(
			'label'    => __( 'Team Post Type', 'SKDD' ),
			'section'  => 'SKDD_custom_post_types',
			'settings' => 'SKDD_setting[cpt_team_display]',
		)
	)
);