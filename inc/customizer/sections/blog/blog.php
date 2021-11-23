<?php
/**
 * Blog customizer
 *
 * @package SKDD
 */

// Default values.
$defaults = SKDD_options();

// Enable/disable posts section.
$wp_customize->add_setting(
	'SKDD_setting[blog_section_enabled]',
	array(
		'default'           => $defaults['blog_section_enabled'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[blog_section_enabled]',
		array(
			'label'    => __( 'Enable posts section', 'SKDD' ),
			'settings' => 'SKDD_setting[blog_section_enabled]',
			'section'  => 'SKDD_blog',
		)
	)
);

// Blog layout.
$wp_customize->add_setting(
	'SKDD_setting[blog_list_layout]',
	array(
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'default'           => $defaults['blog_list_layout'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Radio_Image_Control(
		$wp_customize,
		'SKDD_setting[blog_list_layout]',
		array(
			'section'  => 'SKDD_blog',
			'settings' => 'SKDD_setting[blog_list_layout]',
			'label'    => __( 'Blog Layout', 'SKDD' ),
			'choices'  => apply_filters(
				'SKDD_setting_blog_list_layout_choices',
				array(
					'standard' => SKDD_THEME_URI . 'assets/images/customizer/blog/standard.jpg',
					'list'     => SKDD_THEME_URI . 'assets/images/customizer/blog/list.jpg',
					'grid'     => SKDD_THEME_URI . 'assets/images/customizer/blog/grid.jpg',
					'zigzag'   => SKDD_THEME_URI . 'assets/images/customizer/blog/zigzag.jpg',
				)
			),
		)
	)
);

// Limit exerpt.
$wp_customize->add_setting(
	'SKDD_setting[blog_list_limit_exerpt]',
	array(
		'sanitize_callback' => 'absint',
		'default'           => $defaults['blog_list_limit_exerpt'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[blog_list_limit_exerpt]',
		array(
			'section'  => 'SKDD_blog',
			'settings' => 'SKDD_setting[blog_list_limit_exerpt]',
			'type'     => 'number',
			'label'    => __( 'Limit Excerpt', 'SKDD' ),
		)
	)
);

// End section one divider.
$wp_customize->add_setting(
	'blog_list_section_one_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'blog_list_section_one_divider',
		array(
			'section'  => 'SKDD_blog',
			'settings' => 'blog_list_section_one_divider',
			'type'     => 'divider',
		)
	)
);

// Blog list structure.
$wp_customize->add_setting(
	'SKDD_setting[blog_list_structure]',
	array(
		'default'           => $defaults['blog_list_structure'],
		'sanitize_callback' => 'SKDD_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Sortable_Control(
		$wp_customize,
		'SKDD_setting[blog_list_structure]',
		array(
			'label'    => __( 'Blog List Structure', 'SKDD' ),
			'section'  => 'SKDD_blog',
			'settings' => 'SKDD_setting[blog_list_structure]',
			'choices'  => apply_filters(
				'SKDD_setting_blog_list_structure_choices',
				array(
					'image'      => __( 'Featured Image', 'SKDD' ),
					'title-meta' => __( 'Title', 'SKDD' ),
					'post-meta'  => __( 'Post Meta', 'SKDD' ),
				)
			),
		)
	)
);

// Blog list post meta.
$wp_customize->add_setting(
	'SKDD_setting[blog_list_post_meta]',
	array(
		'default'           => $defaults['blog_list_post_meta'],
		'sanitize_callback' => 'SKDD_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Sortable_Control(
		$wp_customize,
		'SKDD_setting[blog_list_post_meta]',
		array(
			'label'    => __( 'Blog Post Meta', 'SKDD' ),
			'section'  => 'SKDD_blog',
			'settings' => 'SKDD_setting[blog_list_post_meta]',
			'choices'  => apply_filters(
				'SKDD_setting_blog_list_post_meta_choices',
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
