<?php
/**
 * Blog single customizer
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Blog single structure.
$wp_customize->add_setting(
	'SKDD_setting[blog_single_structure]',
	array(
		'default'           => $defaults['blog_single_structure'],
		'sanitize_callback' => 'SKDD_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Sortable_Control(
		$wp_customize,
		'SKDD_setting[blog_single_structure]',
		array(
			'label'    => __( 'Blog Single Structure', 'SKDD' ),
			'section'  => 'SKDD_blog_single',
			'settings' => 'SKDD_setting[blog_single_structure]',
			'choices'  => apply_filters(
				'SKDD_setting_blog_single_structure_choices',
				array(
					'image'      => __( 'Featured Image', 'SKDD' ),
					'title-meta' => __( 'Title', 'SKDD' ),
					'post-meta'  => __( 'Post Meta', 'SKDD' ),
				)
			),
		)
	)
);

// Blog single post meta.
$wp_customize->add_setting(
	'SKDD_setting[blog_single_post_meta]',
	array(
		'default'           => $defaults['blog_single_post_meta'],
		'sanitize_callback' => 'SKDD_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Sortable_Control(
		$wp_customize,
		'SKDD_setting[blog_single_post_meta]',
		array(
			'label'    => __( 'Blog Single Post Meta', 'SKDD' ),
			'section'  => 'SKDD_blog_single',
			'settings' => 'SKDD_setting[blog_single_post_meta]',
			'choices'  => apply_filters(
				'SKDD_setting_blog_single_post_meta_choices',
				array(
					'date'     => __( 'Publish Date', 'SKDD' ),
					'author'   => __( 'Author', 'SKDD' ),
					'category' => __( 'Category', 'SKDD' ),
					'comments' => __( 'Comments', 'SKDD' ),
				)
			),
		)
	)
);

// Breadcrumb divider.
$wp_customize->add_setting(
	'blog_single_author_box_start',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'blog_single_author_box_start',
		array(
			'section'  => 'SKDD_blog_single',
			'settings' => 'blog_single_author_box_start',
			'type'     => 'divider',
		)
	)
);

// Author box.
$wp_customize->add_setting(
	'SKDD_setting[blog_single_author_box]',
	array(
		'type'              => 'option',
		'default'           => $defaults['blog_single_author_box'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[blog_single_author_box]',
		array(
			'label'    => __( 'Author Box', 'SKDD' ),
			'section'  => 'SKDD_blog_single',
			'settings' => 'SKDD_setting[blog_single_author_box]',
		)
	)
);

// Related post.
$wp_customize->add_setting(
	'SKDD_setting[blog_single_related_post]',
	array(
		'type'              => 'option',
		'default'           => $defaults['blog_single_related_post'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[blog_single_related_post]',
		array(
			'label'    => __( 'Related Post', 'SKDD' ),
			'section'  => 'SKDD_blog_single',
			'settings' => 'SKDD_setting[blog_single_related_post]',
		)
	)
);
