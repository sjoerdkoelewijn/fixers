<?php
/**
 * Blog single customizer
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Blog single structure.
$wp_customize->add_setting(
	'roxtar_setting[blog_single_structure]',
	array(
		'default'           => $defaults['blog_single_structure'],
		'sanitize_callback' => 'roxtar_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Sortable_Control(
		$wp_customize,
		'roxtar_setting[blog_single_structure]',
		array(
			'label'    => __( 'Blog Single Structure', 'roxtar' ),
			'section'  => 'roxtar_blog_single',
			'settings' => 'roxtar_setting[blog_single_structure]',
			'choices'  => apply_filters(
				'roxtar_setting_blog_single_structure_choices',
				array(
					'image'      => __( 'Featured Image', 'roxtar' ),
					'title-meta' => __( 'Title', 'roxtar' ),
					'post-meta'  => __( 'Post Meta', 'roxtar' ),
				)
			),
		)
	)
);

// Blog single post meta.
$wp_customize->add_setting(
	'roxtar_setting[blog_single_post_meta]',
	array(
		'default'           => $defaults['blog_single_post_meta'],
		'sanitize_callback' => 'roxtar_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Sortable_Control(
		$wp_customize,
		'roxtar_setting[blog_single_post_meta]',
		array(
			'label'    => __( 'Blog Single Post Meta', 'roxtar' ),
			'section'  => 'roxtar_blog_single',
			'settings' => 'roxtar_setting[blog_single_post_meta]',
			'choices'  => apply_filters(
				'roxtar_setting_blog_single_post_meta_choices',
				array(
					'date'     => __( 'Publish Date', 'roxtar' ),
					'author'   => __( 'Author', 'roxtar' ),
					'category' => __( 'Category', 'roxtar' ),
					'comments' => __( 'Comments', 'roxtar' ),
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'blog_single_author_box_start',
		array(
			'section'  => 'roxtar_blog_single',
			'settings' => 'blog_single_author_box_start',
			'type'     => 'divider',
		)
	)
);

// Author box.
$wp_customize->add_setting(
	'roxtar_setting[blog_single_author_box]',
	array(
		'type'              => 'option',
		'default'           => $defaults['blog_single_author_box'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[blog_single_author_box]',
		array(
			'label'    => __( 'Author Box', 'roxtar' ),
			'section'  => 'roxtar_blog_single',
			'settings' => 'roxtar_setting[blog_single_author_box]',
		)
	)
);

// Related post.
$wp_customize->add_setting(
	'roxtar_setting[blog_single_related_post]',
	array(
		'type'              => 'option',
		'default'           => $defaults['blog_single_related_post'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[blog_single_related_post]',
		array(
			'label'    => __( 'Related Post', 'roxtar' ),
			'section'  => 'roxtar_blog_single',
			'settings' => 'roxtar_setting[blog_single_related_post]',
		)
	)
);
