<?php
/**
 * Blog customizer
 *
 * @package roxtar
 */

// Default values.
$defaults = roxtar_options();

// Blog layout.
$wp_customize->add_setting(
	'roxtar_setting[blog_list_layout]',
	array(
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'default'           => $defaults['blog_list_layout'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Radio_Image_Control(
		$wp_customize,
		'roxtar_setting[blog_list_layout]',
		array(
			'section'  => 'roxtar_blog',
			'settings' => 'roxtar_setting[blog_list_layout]',
			'label'    => __( 'Blog Layout', 'roxtar' ),
			'choices'  => apply_filters(
				'roxtar_setting_blog_list_layout_choices',
				array(
					'standard' => ROXTAR_THEME_URI . 'assets/images/customizer/blog/standard.jpg',
					'list'     => ROXTAR_THEME_URI . 'assets/images/customizer/blog/list.jpg',
					'grid'     => ROXTAR_THEME_URI . 'assets/images/customizer/blog/grid.jpg',
					'zigzag'   => ROXTAR_THEME_URI . 'assets/images/customizer/blog/zigzag.jpg',
				)
			),
		)
	)
);

// Limit exerpt.
$wp_customize->add_setting(
	'roxtar_setting[blog_list_limit_exerpt]',
	array(
		'sanitize_callback' => 'absint',
		'default'           => $defaults['blog_list_limit_exerpt'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[blog_list_limit_exerpt]',
		array(
			'section'  => 'roxtar_blog',
			'settings' => 'roxtar_setting[blog_list_limit_exerpt]',
			'type'     => 'number',
			'label'    => __( 'Limit Excerpt', 'roxtar' ),
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'blog_list_section_one_divider',
		array(
			'section'  => 'roxtar_blog',
			'settings' => 'blog_list_section_one_divider',
			'type'     => 'divider',
		)
	)
);

// Blog list structure.
$wp_customize->add_setting(
	'roxtar_setting[blog_list_structure]',
	array(
		'default'           => $defaults['blog_list_structure'],
		'sanitize_callback' => 'roxtar_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Sortable_Control(
		$wp_customize,
		'roxtar_setting[blog_list_structure]',
		array(
			'label'    => __( 'Blog List Structure', 'roxtar' ),
			'section'  => 'roxtar_blog',
			'settings' => 'roxtar_setting[blog_list_structure]',
			'choices'  => apply_filters(
				'roxtar_setting_blog_list_structure_choices',
				array(
					'image'      => __( 'Featured Image', 'roxtar' ),
					'title-meta' => __( 'Title', 'roxtar' ),
					'post-meta'  => __( 'Post Meta', 'roxtar' ),
				)
			),
		)
	)
);

// Blog list post meta.
$wp_customize->add_setting(
	'roxtar_setting[blog_list_post_meta]',
	array(
		'default'           => $defaults['blog_list_post_meta'],
		'sanitize_callback' => 'roxtar_sanitize_array',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Sortable_Control(
		$wp_customize,
		'roxtar_setting[blog_list_post_meta]',
		array(
			'label'    => __( 'Blog Post Meta', 'roxtar' ),
			'section'  => 'roxtar_blog',
			'settings' => 'roxtar_setting[blog_list_post_meta]',
			'choices'  => apply_filters(
				'roxtar_setting_blog_list_post_meta_choices',
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
