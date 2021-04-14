<?php
/**
 * Woocommerce shop single customizer
 *
 * @package SKDD
 */

if ( ! SKDD_is_woocommerce_activated() ) {
	return;
}

// Default values.
$defaults = SKDD_options();

// SHOP STRUCTURE SECTION.
$wp_customize->add_setting(
	'shop_page_structure_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_structure_section',
		array(
			'label'      => __( 'Shop Structure', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_page_title]',
				'SKDD_setting[shop_page_breadcrumb]',
				'SKDD_setting[shop_page_result_count]',
				'SKDD_setting[shop_page_product_filter]',
			),
		)
	)
);

// Shop title.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_title]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_title'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_title]',
		array(
			'label'    => __( 'Shop Title', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_title]',
		)
	)
);

// Breadcrumbs.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_breadcrumb]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_breadcrumb'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_breadcrumb]',
		array(
			'label'    => __( 'Breadcrumb', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_breadcrumb]',
		)
	)
);

// Result count.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_result_count]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_result_count'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_result_count]',
		array(
			'label'    => __( 'Result Count', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_result_count]',
		)
	)
);

// Product filter.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_filter]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_filter'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_filter]',
		array(
			'label'    => __( 'Product Filtering', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_filter]',
		)
	)
);

// PRODUCT CARD SECTION.
$wp_customize->add_setting(
	'shop_page_product_card_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_product_card_section',
		array(
			'label'      => __( 'Product Card', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_page_product_card_border_style]',
				'SKDD_setting[shop_page_product_card_border_width]',
				'SKDD_setting[shop_page_product_card_border_color]',
			),
		)
	)
);

// Border style.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_card_border_style]',
	array(
		'default'           => $defaults['shop_page_product_card_border_style'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_card_border_style]',
		array(
			'label'    => __( 'Border Style', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_card_border_style]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_product_card_border_style_choices',
				array(
					'none'   => __( 'None', 'SKDD' ),
					'solid'  => __( 'Solid', 'SKDD' ),
					'dashed' => __( 'Dashed', 'SKDD' ),
					'dotted' => __( 'Dotted', 'SKDD' ),
					'double' => __( 'Double', 'SKDD' ),
				)
			),
		)
	)
);

// Border width.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_card_border_width]',
	array(
		'default'           => $defaults['shop_page_product_card_border_width'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_card_border_width]',
		array(
			'label'    => __( 'Border Width', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_product_card_border_width]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_product_card_border_width_min_step', 1 ),
					'max'  => apply_filters( 'SKDD_product_card_border_width_max_step', 10 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Border color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_card_border_color]',
	array(
		'default'           => $defaults['shop_page_product_card_border_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_card_border_color]',
		array(
			'label'    => __( 'Border Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_card_border_color]',
		)
	)
);

// PRODUCT CONTENT SECTION.
$wp_customize->add_setting(
	'shop_page_product_meta_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_product_meta_section',
		array(
			'label'      => __( 'Product Content', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_page_product_alignment]',
				'shop_page_product_alignment_divider',
				'SKDD_setting[shop_page_product_title]',
				'SKDD_setting[shop_page_product_category]',
				'SKDD_setting[shop_page_product_rating]',
				'SKDD_setting[shop_page_product_price]',
				'SKDD_setting[shop_page_product_content_equal]',
				'SKDD_setting[shop_page_product_content_min_height]',
			),
		)
	)
);

// Alignment.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_alignment]',
	array(
		'default'           => $defaults['shop_page_product_alignment'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_alignment]',
		array(
			'label'    => __( 'Alignment', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_alignment]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_product_alignment_choices',
				array(
					'left'   => __( 'Left', 'SKDD' ),
					'center' => __( 'Center', 'SKDD' ),
					'right'  => __( 'Right', 'SKDD' ),
				)
			),
		)
	)
);

// Divider.
$wp_customize->add_setting(
	'shop_page_product_alignment_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Divider_Control(
		$wp_customize,
		'shop_page_product_alignment_divider',
		array(
			'section'  => 'SKDD_shop_page',
			'settings' => 'shop_page_product_alignment_divider',
			'type'     => 'divider',
		)
	)
);

// Product title.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_title]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_title'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_title]',
		array(
			'label'    => __( 'Product Title', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_title]',
		)
	)
);

// Product category.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_category]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_category'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_category]',
		array(
			'label'    => __( 'Product Category', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_category]',
		)
	)
);

// Product rating.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_rating]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_rating'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_rating]',
		array(
			'label'    => __( 'Product Rating', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_rating]',
		)
	)
);

// Product price.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_price]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_price'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_price]',
		array(
			'label'    => __( 'Product Price', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_price]',
		)
	)
);

// Equal product content.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_content_equal]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_content_equal'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_content_equal]',
		array(
			'label'    => __( 'Equal Product Content', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_content_equal]',
		)
	)
);

// Product content min height.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_content_min_height]',
	array(
		'default'           => $defaults['shop_page_product_content_min_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_content_min_height]',
		array(
			'label'    => __( 'Product Content Min Height', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_product_content_min_height]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_product_content_min_height_min_step', 10 ),
					'max'  => apply_filters( 'SKDD_product_content_min_height_max_step', 500 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// PRODUCT IMAGE SECTION.
$wp_customize->add_setting(
	'shop_page_product_image_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_product_image_section',
		array(
			'label'      => __( 'Product Image', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_page_product_image_border_style]',
				'SKDD_setting[shop_page_product_image_border_width]',
				'SKDD_setting[shop_page_product_image_border_color]',
				'SKDD_setting[shop_page_product_image_hover]',
				'SKDD_setting[shop_page_product_image_equal_height]',
				'SKDD_setting[shop_page_product_image_height]',
			),
		)
	)
);

// Image hover.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_image_hover]',
	array(
		'default'           => $defaults['shop_page_product_image_hover'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_image_hover]',
		array(
			'label'    => __( 'Hover Effect', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_image_hover]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_image_hover_choices',
				array(
					'none' => __( 'None', 'SKDD' ),
					'zoom' => __( 'Zoom', 'SKDD' ),
					'swap' => __( 'Swap', 'SKDD' ),
				)
			),
		)
	)
);

// Border style.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_image_border_style]',
	array(
		'default'           => $defaults['shop_page_product_image_border_style'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_image_border_style]',
		array(
			'label'    => __( 'Border Style', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_image_border_style]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_product_image_border_style_choices',
				array(
					'none'   => __( 'None', 'SKDD' ),
					'solid'  => __( 'Solid', 'SKDD' ),
					'dashed' => __( 'Dashed', 'SKDD' ),
					'dotted' => __( 'Dotted', 'SKDD' ),
					'double' => __( 'Double', 'SKDD' ),
				)
			),
		)
	)
);

// Border width.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_image_border_width]',
	array(
		'default'           => $defaults['shop_page_product_image_border_width'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_image_border_width]',
		array(
			'label'    => __( 'Border Width', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_product_image_border_width]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_product_image_border_width_min_step', 1 ),
					'max'  => apply_filters( 'SKDD_product_image_border_width_max_step', 10 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Border color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_image_border_color]',
	array(
		'default'           => $defaults['shop_page_product_image_border_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_image_border_color]',
		array(
			'label'    => __( 'Border Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_product_image_border_color]',
		)
	)
);

// Equal image height.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_image_equal_height]',
	array(
		'default'           => $defaults['shop_page_product_image_equal_height'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_image_equal_height]',
		array(
			'label'    => __( 'Equal Image Height', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_page_product_image_equal_height]',
			'section'  => 'SKDD_shop_page',
		)
	)
);

// Image height.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_product_image_height]',
	array(
		'default'           => $defaults['shop_page_product_image_height'],
		'type'              => 'option',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_product_image_height]',
		array(
			'type'     => 'SKDD-range-slider',
			'label'    => __( 'Image Height', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_product_image_height]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_shop_page_product_image_height_min_step', 50 ),
					'max'  => apply_filters( 'SKDD_shop_page_product_image_height_max_step', 600 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// SALE TAG SECTION.
$wp_customize->add_setting(
	'shop_page_sale_tag_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_sale_tag_section',
		array(
			'label'      => __( 'Sale Tag', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_page_sale_tag_position]',
				'SKDD_setting[shop_page_sale_percent]',
				'SKDD_setting[shop_page_sale_text]',
				'SKDD_setting[shop_page_sale_border_radius]',
				'SKDD_setting[shop_page_sale_square]',
				'SKDD_setting[shop_page_sale_size]',
				'SKDD_setting[shop_page_sale_color]',
				'SKDD_setting[shop_page_sale_bg_color]',
			),
		)
	)
);

// Position.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_tag_position]',
	array(
		'default'           => $defaults['shop_page_sale_tag_position'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_tag_position]',
		array(
			'label'    => __( 'Position', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_sale_tag_position]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_sale_tag_position_choices',
				array(
					'left'  => __( 'Left', 'SKDD' ),
					'right' => __( 'Right', 'SKDD' ),
				)
			),
		)
	)
);

// Sale text.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_text]',
	array(
		'default'           => $defaults['shop_page_sale_text'],
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_text]',
		array(
			'label'    => __( 'Text', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_sale_text]',
			'type'     => 'text',
		)
	)
);

// Text color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_color]',
	array(
		'default'           => $defaults['shop_page_sale_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_color]',
		array(
			'label'    => __( 'Text Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_sale_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_bg_color]',
	array(
		'default'           => $defaults['shop_page_sale_bg_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_bg_color]',
		array(
			'label'    => __( 'Background Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_sale_bg_color]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_border_radius]',
	array(
		'default'           => $defaults['shop_page_sale_border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_sale_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_sale_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_sale_border_radius_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Sale percentage.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_percent]',
	array(
		'default'           => $defaults['shop_page_sale_percent'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_percent]',
		array(
			'label'    => __( 'Sale Percentage', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_page_sale_percent]',
			'section'  => 'SKDD_shop_page',
		)
	)
);

// Sale square.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_square]',
	array(
		'default'           => $defaults['shop_page_sale_square'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_square]',
		array(
			'label'    => __( 'Sale Square', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_page_sale_square]',
			'section'  => 'SKDD_shop_page',
		)
	)
);

// Sale size.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_sale_size]',
	array(
		'default'           => $defaults['shop_page_sale_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_sale_size]',
		array(
			'label'    => __( 'Size', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_sale_size]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_sale_size_min_step', 20 ),
					'max'  => apply_filters( 'SKDD_sale_size_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// OUT OF STOCK TAG SECTION.
$wp_customize->add_setting(
	'shop_page_out_of_stock_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_out_of_stock_section',
		array(
			'label'      => __( 'Out Of Stock Label', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_page_out_of_stock_position]',
				'SKDD_setting[shop_page_out_of_stock_text]',
				'SKDD_setting[shop_page_out_of_stock_color]',
				'SKDD_setting[shop_page_out_of_stock_bg_color]',
				'SKDD_setting[shop_page_out_of_stock_border_radius]',
				'SKDD_setting[shop_page_out_of_stock_square]',
				'SKDD_setting[shop_page_out_of_stock_size]',
			),
		)
	)
);

// Display.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_out_of_stock_position]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_position'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_out_of_stock_position]',
		array(
			'label'    => __( 'Display', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_out_of_stock_position]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_out_of_stock_position_choices',
				array(
					'left'  => __( 'Left', 'SKDD' ),
					'right' => __( 'Right', 'SKDD' ),
					'none'  => __( 'None', 'SKDD' ),
				)
			),
		)
	)
);

// Text.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_out_of_stock_text]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_text'],
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_out_of_stock_text]',
		array(
			'label'    => __( 'Text', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_out_of_stock_text]',
			'type'     => 'text',
		)
	)
);

// Text color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_out_of_stock_color]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_out_of_stock_color]',
		array(
			'label'    => __( 'Text Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_out_of_stock_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_out_of_stock_bg_color]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_bg_color'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_out_of_stock_bg_color]',
		array(
			'label'    => __( 'Background Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_out_of_stock_bg_color]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_out_of_stock_border_radius]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_out_of_stock_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_out_of_stock_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_out_of_stock_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_out_of_stock_border_radius_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Square.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_out_of_stock_square]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_square'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_page_out_of_stock_square]',
		array(
			'label'    => __( 'Square', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_page_out_of_stock_square]',
			'section'  => 'SKDD_shop_page',
		)
	)
);

// Size.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_out_of_stock_size]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_out_of_stock_size]',
		array(
			'label'    => __( 'Size', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_out_of_stock_size]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_out_of_stock_size_min_step', 20 ),
					'max'  => apply_filters( 'SKDD_out_of_stock_size_max_step', 200 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// WISHLIST SECTION.
$wp_customize->add_setting(
	'shop_page_wishlist_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_wishlist_section',
		array(
			'label'      => __( 'Wishlist Button', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_page_wishlist_support_plugin]',
				'SKDD_setting[shop_page_wishlist_position]',
			),
		)
	)
);

// Support plugin.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_wishlist_support_plugin]',
	array(
		'default'           => $defaults['shop_page_wishlist_support_plugin'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_page_wishlist_support_plugin]',
		array(
			'label'    => __( 'Support For Plugin', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_wishlist_support_plugin]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_wishlist_support_plugin_choices',
				array(
					'yith' => __( 'YITH WooCommerce Wishlist', 'SKDD' ),
					'ti'   => __( 'TI WooCommerce Wishlist', 'SKDD' ),
				)
			),
		)
	)
);

// Position.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_wishlist_position]',
	array(
		'default'           => $defaults['shop_page_wishlist_position'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Radio_Image_Control(
		$wp_customize,
		'SKDD_setting[shop_page_wishlist_position]',
		array(
			'label'    => __( 'Position', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_wishlist_position]',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_wishlist_position_choices',
				array(
					'none'         => SKDD_THEME_URI . 'assets/images/customizer/wishlist/wishlist-1.jpg',
					'top-right'    => SKDD_THEME_URI . 'assets/images/customizer/wishlist/wishlist-2.jpg',
					'bottom-right' => SKDD_THEME_URI . 'assets/images/customizer/wishlist/wishlist-3.jpg',
				)
			),
		)
	)
);

// ADD TO CART SECTION.
$wp_customize->add_setting(
	'shop_page_add_to_cart_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_page_add_to_cart_section',
		array(
			'label'      => __( 'Add To Cart Button', 'SKDD' ),
			'section'    => 'SKDD_shop_page',
			'dependency' => array(
				'SKDD_setting[shop_product_add_to_cart_icon]',
				'SKDD_setting[shop_page_add_to_cart_button_position]',
				'SKDD_setting[shop_page_button_cart_background]',
				'SKDD_setting[shop_page_button_cart_color]',
				'SKDD_setting[shop_page_button_background_hover]',
				'SKDD_setting[shop_page_button_color_hover]',
				'SKDD_setting[shop_page_button_border_radius]',
			),
		)
	)
);

// Position.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_add_to_cart_button_position]',
	array(
		'default'           => $defaults['shop_page_add_to_cart_button_position'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Radio_Image_Control(
		$wp_customize,
		'SKDD_setting[shop_page_add_to_cart_button_position]',
		array(
			'label'    => __( 'Position', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_add_to_cart_button_position]',
			'choices'  => apply_filters(
				'SKDD_setting_shop_page_add_to_cart_button_position_choices',
				array(
					'none'           => SKDD_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-1.jpg',
					'bottom'         => SKDD_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-2.jpg',
					'bottom-visible' => SKDD_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-3.jpg',
					'image'          => SKDD_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-4.jpg',
					'icon'           => SKDD_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-5.jpg',
				)
			),
		)
	)
);

// Cart icon.
$wp_customize->add_setting(
	'SKDD_setting[shop_product_add_to_cart_icon]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_product_add_to_cart_icon'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_product_add_to_cart_icon]',
		array(
			'label'    => __( 'Cart Icon', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_product_add_to_cart_icon]',
		)
	)
);
// Button Background.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_button_cart_background]',
	array(
		'default'           => $defaults['shop_page_button_cart_background'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_button_cart_background]',
		array(
			'label'    => __( 'Background', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_button_cart_background]',
		)
	)
);

// Button Color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_button_cart_color]',
	array(
		'default'           => $defaults['shop_page_button_cart_color'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_button_cart_color]',
		array(
			'label'    => __( 'Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_button_cart_color]',
		)
	)
);

// Button Hover Background.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_button_background_hover]',
	array(
		'default'           => $defaults['shop_page_button_background_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_button_background_hover]',
		array(
			'label'    => __( 'Hover Background', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_button_background_hover]',
		)
	)
);

// Button Hover Color.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_button_color_hover]',
	array(
		'default'           => $defaults['shop_page_button_color_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_page_button_color_hover]',
		array(
			'label'    => __( 'Hover Color', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => 'SKDD_setting[shop_page_button_color_hover]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'SKDD_setting[shop_page_button_border_radius]',
	array(
		'default'           => $defaults['shop_page_button_border_radius'],
		'type'              => 'option',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_page_button_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'SKDD' ),
			'section'  => 'SKDD_shop_page',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_page_button_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_shop_page_button_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_shop_page_button_border_radius_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
