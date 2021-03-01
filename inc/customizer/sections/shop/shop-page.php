<?php
/**
 * Woocommerce shop single customizer
 *
 * @package roxtar
 */

if ( ! roxtar_is_woocommerce_activated() ) {
	return;
}

// Default values.
$defaults = roxtar_options();

// SHOP STRUCTURE SECTION.
$wp_customize->add_setting(
	'shop_page_structure_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_structure_section',
		array(
			'label'      => __( 'Shop Structure', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_page_title]',
				'roxtar_setting[shop_page_breadcrumb]',
				'roxtar_setting[shop_page_result_count]',
				'roxtar_setting[shop_page_product_filter]',
			),
		)
	)
);

// Shop title.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_title]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_title'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_title]',
		array(
			'label'    => __( 'Shop Title', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_title]',
		)
	)
);

// Breadcrumbs.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_breadcrumb]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_breadcrumb'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_breadcrumb]',
		array(
			'label'    => __( 'Breadcrumb', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_breadcrumb]',
		)
	)
);

// Result count.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_result_count]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_result_count'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_result_count]',
		array(
			'label'    => __( 'Result Count', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_result_count]',
		)
	)
);

// Product filter.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_filter]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_filter'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_filter]',
		array(
			'label'    => __( 'Product Filtering', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_filter]',
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_product_card_section',
		array(
			'label'      => __( 'Product Card', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_page_product_card_border_style]',
				'roxtar_setting[shop_page_product_card_border_width]',
				'roxtar_setting[shop_page_product_card_border_color]',
			),
		)
	)
);

// Border style.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_card_border_style]',
	array(
		'default'           => $defaults['shop_page_product_card_border_style'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_card_border_style]',
		array(
			'label'    => __( 'Border Style', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_card_border_style]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_product_card_border_style_choices',
				array(
					'none'   => __( 'None', 'roxtar' ),
					'solid'  => __( 'Solid', 'roxtar' ),
					'dashed' => __( 'Dashed', 'roxtar' ),
					'dotted' => __( 'Dotted', 'roxtar' ),
					'double' => __( 'Double', 'roxtar' ),
				)
			),
		)
	)
);

// Border width.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_card_border_width]',
	array(
		'default'           => $defaults['shop_page_product_card_border_width'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_card_border_width]',
		array(
			'label'    => __( 'Border Width', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_product_card_border_width]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_product_card_border_width_min_step', 1 ),
					'max'  => apply_filters( 'roxtar_product_card_border_width_max_step', 10 ),
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
	'roxtar_setting[shop_page_product_card_border_color]',
	array(
		'default'           => $defaults['shop_page_product_card_border_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_card_border_color]',
		array(
			'label'    => __( 'Border Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_card_border_color]',
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_product_meta_section',
		array(
			'label'      => __( 'Product Content', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_page_product_alignment]',
				'shop_page_product_alignment_divider',
				'roxtar_setting[shop_page_product_title]',
				'roxtar_setting[shop_page_product_category]',
				'roxtar_setting[shop_page_product_rating]',
				'roxtar_setting[shop_page_product_price]',
				'roxtar_setting[shop_page_product_content_equal]',
				'roxtar_setting[shop_page_product_content_min_height]',
			),
		)
	)
);

// Alignment.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_alignment]',
	array(
		'default'           => $defaults['shop_page_product_alignment'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_alignment]',
		array(
			'label'    => __( 'Alignment', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_alignment]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_product_alignment_choices',
				array(
					'left'   => __( 'Left', 'roxtar' ),
					'center' => __( 'Center', 'roxtar' ),
					'right'  => __( 'Right', 'roxtar' ),
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
	new Roxtar_Divider_Control(
		$wp_customize,
		'shop_page_product_alignment_divider',
		array(
			'section'  => 'roxtar_shop_page',
			'settings' => 'shop_page_product_alignment_divider',
			'type'     => 'divider',
		)
	)
);

// Product title.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_title]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_title'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_title]',
		array(
			'label'    => __( 'Product Title', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_title]',
		)
	)
);

// Product category.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_category]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_category'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_category]',
		array(
			'label'    => __( 'Product Category', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_category]',
		)
	)
);

// Product rating.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_rating]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_rating'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_rating]',
		array(
			'label'    => __( 'Product Rating', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_rating]',
		)
	)
);

// Product price.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_price]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_price'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_price]',
		array(
			'label'    => __( 'Product Price', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_price]',
		)
	)
);

// Equal product content.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_content_equal]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_page_product_content_equal'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_content_equal]',
		array(
			'label'    => __( 'Equal Product Content', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_content_equal]',
		)
	)
);

// Product content min height.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_content_min_height]',
	array(
		'default'           => $defaults['shop_page_product_content_min_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_content_min_height]',
		array(
			'label'    => __( 'Product Content Min Height', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_product_content_min_height]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_product_content_min_height_min_step', 10 ),
					'max'  => apply_filters( 'roxtar_product_content_min_height_max_step', 500 ),
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_product_image_section',
		array(
			'label'      => __( 'Product Image', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_page_product_image_border_style]',
				'roxtar_setting[shop_page_product_image_border_width]',
				'roxtar_setting[shop_page_product_image_border_color]',
				'roxtar_setting[shop_page_product_image_hover]',
				'roxtar_setting[shop_page_product_image_equal_height]',
				'roxtar_setting[shop_page_product_image_height]',
			),
		)
	)
);

// Image hover.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_image_hover]',
	array(
		'default'           => $defaults['shop_page_product_image_hover'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_image_hover]',
		array(
			'label'    => __( 'Hover Effect', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_image_hover]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_image_hover_choices',
				array(
					'none' => __( 'None', 'roxtar' ),
					'zoom' => __( 'Zoom', 'roxtar' ),
					'swap' => __( 'Swap', 'roxtar' ),
				)
			),
		)
	)
);

// Border style.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_image_border_style]',
	array(
		'default'           => $defaults['shop_page_product_image_border_style'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_image_border_style]',
		array(
			'label'    => __( 'Border Style', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_image_border_style]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_product_image_border_style_choices',
				array(
					'none'   => __( 'None', 'roxtar' ),
					'solid'  => __( 'Solid', 'roxtar' ),
					'dashed' => __( 'Dashed', 'roxtar' ),
					'dotted' => __( 'Dotted', 'roxtar' ),
					'double' => __( 'Double', 'roxtar' ),
				)
			),
		)
	)
);

// Border width.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_image_border_width]',
	array(
		'default'           => $defaults['shop_page_product_image_border_width'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_image_border_width]',
		array(
			'label'    => __( 'Border Width', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_product_image_border_width]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_product_image_border_width_min_step', 1 ),
					'max'  => apply_filters( 'roxtar_product_image_border_width_max_step', 10 ),
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
	'roxtar_setting[shop_page_product_image_border_color]',
	array(
		'default'           => $defaults['shop_page_product_image_border_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_image_border_color]',
		array(
			'label'    => __( 'Border Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_product_image_border_color]',
		)
	)
);

// Equal image height.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_image_equal_height]',
	array(
		'default'           => $defaults['shop_page_product_image_equal_height'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_image_equal_height]',
		array(
			'label'    => __( 'Equal Image Height', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_page_product_image_equal_height]',
			'section'  => 'roxtar_shop_page',
		)
	)
);

// Image height.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_product_image_height]',
	array(
		'default'           => $defaults['shop_page_product_image_height'],
		'type'              => 'option',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_product_image_height]',
		array(
			'type'     => 'roxtar-range-slider',
			'label'    => __( 'Image Height', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_product_image_height]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_shop_page_product_image_height_min_step', 50 ),
					'max'  => apply_filters( 'roxtar_shop_page_product_image_height_max_step', 600 ),
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_sale_tag_section',
		array(
			'label'      => __( 'Sale Tag', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_page_sale_tag_position]',
				'roxtar_setting[shop_page_sale_percent]',
				'roxtar_setting[shop_page_sale_text]',
				'roxtar_setting[shop_page_sale_border_radius]',
				'roxtar_setting[shop_page_sale_square]',
				'roxtar_setting[shop_page_sale_size]',
				'roxtar_setting[shop_page_sale_color]',
				'roxtar_setting[shop_page_sale_bg_color]',
			),
		)
	)
);

// Position.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_sale_tag_position]',
	array(
		'default'           => $defaults['shop_page_sale_tag_position'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_page_sale_tag_position]',
		array(
			'label'    => __( 'Position', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_sale_tag_position]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_sale_tag_position_choices',
				array(
					'left'  => __( 'Left', 'roxtar' ),
					'right' => __( 'Right', 'roxtar' ),
				)
			),
		)
	)
);

// Sale text.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_sale_text]',
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
		'roxtar_setting[shop_page_sale_text]',
		array(
			'label'    => __( 'Text', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_sale_text]',
			'type'     => 'text',
		)
	)
);

// Text color.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_sale_color]',
	array(
		'default'           => $defaults['shop_page_sale_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_sale_color]',
		array(
			'label'    => __( 'Text Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_sale_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_sale_bg_color]',
	array(
		'default'           => $defaults['shop_page_sale_bg_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_sale_bg_color]',
		array(
			'label'    => __( 'Background Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_sale_bg_color]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_sale_border_radius]',
	array(
		'default'           => $defaults['shop_page_sale_border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_sale_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_sale_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_sale_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_sale_border_radius_max_step', 200 ),
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
	'roxtar_setting[shop_page_sale_percent]',
	array(
		'default'           => $defaults['shop_page_sale_percent'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_sale_percent]',
		array(
			'label'    => __( 'Sale Percentage', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_page_sale_percent]',
			'section'  => 'roxtar_shop_page',
		)
	)
);

// Sale square.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_sale_square]',
	array(
		'default'           => $defaults['shop_page_sale_square'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_sale_square]',
		array(
			'label'    => __( 'Sale Square', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_page_sale_square]',
			'section'  => 'roxtar_shop_page',
		)
	)
);

// Sale size.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_sale_size]',
	array(
		'default'           => $defaults['shop_page_sale_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_sale_size]',
		array(
			'label'    => __( 'Size', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_sale_size]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_sale_size_min_step', 20 ),
					'max'  => apply_filters( 'roxtar_sale_size_max_step', 200 ),
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_out_of_stock_section',
		array(
			'label'      => __( 'Out Of Stock Label', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_page_out_of_stock_position]',
				'roxtar_setting[shop_page_out_of_stock_text]',
				'roxtar_setting[shop_page_out_of_stock_color]',
				'roxtar_setting[shop_page_out_of_stock_bg_color]',
				'roxtar_setting[shop_page_out_of_stock_border_radius]',
				'roxtar_setting[shop_page_out_of_stock_square]',
				'roxtar_setting[shop_page_out_of_stock_size]',
			),
		)
	)
);

// Display.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_out_of_stock_position]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_position'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_page_out_of_stock_position]',
		array(
			'label'    => __( 'Display', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_out_of_stock_position]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_out_of_stock_position_choices',
				array(
					'left'  => __( 'Left', 'roxtar' ),
					'right' => __( 'Right', 'roxtar' ),
					'none'  => __( 'None', 'roxtar' ),
				)
			),
		)
	)
);

// Text.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_out_of_stock_text]',
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
		'roxtar_setting[shop_page_out_of_stock_text]',
		array(
			'label'    => __( 'Text', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_out_of_stock_text]',
			'type'     => 'text',
		)
	)
);

// Text color.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_out_of_stock_color]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_out_of_stock_color]',
		array(
			'label'    => __( 'Text Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_out_of_stock_color]',
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_out_of_stock_bg_color]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_bg_color'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_out_of_stock_bg_color]',
		array(
			'label'    => __( 'Background Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_out_of_stock_bg_color]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_out_of_stock_border_radius]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_border_radius'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_out_of_stock_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_out_of_stock_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_out_of_stock_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_out_of_stock_border_radius_max_step', 200 ),
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
	'roxtar_setting[shop_page_out_of_stock_square]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_square'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_page_out_of_stock_square]',
		array(
			'label'    => __( 'Square', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_page_out_of_stock_square]',
			'section'  => 'roxtar_shop_page',
		)
	)
);

// Size.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_out_of_stock_size]',
	array(
		'default'           => $defaults['shop_page_out_of_stock_size'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_out_of_stock_size]',
		array(
			'label'    => __( 'Size', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_out_of_stock_size]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_out_of_stock_size_min_step', 20 ),
					'max'  => apply_filters( 'roxtar_out_of_stock_size_max_step', 200 ),
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_wishlist_section',
		array(
			'label'      => __( 'Wishlist Button', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_page_wishlist_support_plugin]',
				'roxtar_setting[shop_page_wishlist_position]',
			),
		)
	)
);

// Support plugin.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_wishlist_support_plugin]',
	array(
		'default'           => $defaults['shop_page_wishlist_support_plugin'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_page_wishlist_support_plugin]',
		array(
			'label'    => __( 'Support For Plugin', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_wishlist_support_plugin]',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_wishlist_support_plugin_choices',
				array(
					'yith' => __( 'YITH WooCommerce Wishlist', 'roxtar' ),
					'ti'   => __( 'TI WooCommerce Wishlist', 'roxtar' ),
				)
			),
		)
	)
);

// Position.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_wishlist_position]',
	array(
		'default'           => $defaults['shop_page_wishlist_position'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Radio_Image_Control(
		$wp_customize,
		'roxtar_setting[shop_page_wishlist_position]',
		array(
			'label'    => __( 'Position', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_wishlist_position]',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_wishlist_position_choices',
				array(
					'none'         => ROXTAR_THEME_URI . 'assets/images/customizer/wishlist/wishlist-1.jpg',
					'top-right'    => ROXTAR_THEME_URI . 'assets/images/customizer/wishlist/wishlist-2.jpg',
					'bottom-right' => ROXTAR_THEME_URI . 'assets/images/customizer/wishlist/wishlist-3.jpg',
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_page_add_to_cart_section',
		array(
			'label'      => __( 'Add To Cart Button', 'roxtar' ),
			'section'    => 'roxtar_shop_page',
			'dependency' => array(
				'roxtar_setting[shop_product_add_to_cart_icon]',
				'roxtar_setting[shop_page_add_to_cart_button_position]',
				'roxtar_setting[shop_page_button_cart_background]',
				'roxtar_setting[shop_page_button_cart_color]',
				'roxtar_setting[shop_page_button_background_hover]',
				'roxtar_setting[shop_page_button_color_hover]',
				'roxtar_setting[shop_page_button_border_radius]',
			),
		)
	)
);

// Position.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_add_to_cart_button_position]',
	array(
		'default'           => $defaults['shop_page_add_to_cart_button_position'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Radio_Image_Control(
		$wp_customize,
		'roxtar_setting[shop_page_add_to_cart_button_position]',
		array(
			'label'    => __( 'Position', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_add_to_cart_button_position]',
			'choices'  => apply_filters(
				'roxtar_setting_shop_page_add_to_cart_button_position_choices',
				array(
					'none'           => ROXTAR_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-1.jpg',
					'bottom'         => ROXTAR_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-2.jpg',
					'bottom-visible' => ROXTAR_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-3.jpg',
					'image'          => ROXTAR_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-4.jpg',
					'icon'           => ROXTAR_THEME_URI . 'assets/images/customizer/add-to-cart/add-cart-5.jpg',
				)
			),
		)
	)
);

// Cart icon.
$wp_customize->add_setting(
	'roxtar_setting[shop_product_add_to_cart_icon]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_product_add_to_cart_icon'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_product_add_to_cart_icon]',
		array(
			'label'    => __( 'Cart Icon', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_product_add_to_cart_icon]',
		)
	)
);
// Button Background.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_button_cart_background]',
	array(
		'default'           => $defaults['shop_page_button_cart_background'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_button_cart_background]',
		array(
			'label'    => __( 'Background', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_button_cart_background]',
		)
	)
);

// Button Color.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_button_cart_color]',
	array(
		'default'           => $defaults['shop_page_button_cart_color'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_button_cart_color]',
		array(
			'label'    => __( 'Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_button_cart_color]',
		)
	)
);

// Button Hover Background.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_button_background_hover]',
	array(
		'default'           => $defaults['shop_page_button_background_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_button_background_hover]',
		array(
			'label'    => __( 'Hover Background', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_button_background_hover]',
		)
	)
);

// Button Hover Color.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_button_color_hover]',
	array(
		'default'           => $defaults['shop_page_button_color_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_page_button_color_hover]',
		array(
			'label'    => __( 'Hover Color', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => 'roxtar_setting[shop_page_button_color_hover]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'roxtar_setting[shop_page_button_border_radius]',
	array(
		'default'           => $defaults['shop_page_button_border_radius'],
		'type'              => 'option',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_page_button_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'roxtar' ),
			'section'  => 'roxtar_shop_page',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_page_button_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_shop_page_button_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_shop_page_button_border_radius_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
