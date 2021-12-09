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

// SHOP SINGLE STRUCTURE SECTION.
$wp_customize->add_setting(
	'shop_single_general_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_single_general_section',
		array(
			'label'      => __( 'General', 'SKDD' ),
			'section'    => 'SKDD_shop_single',
			'dependency' => array(
				'SKDD_setting[shop_single_breadcrumb]',
				'SKDD_setting[shop_single_product_navigation]',
				'SKDD_setting[shop_single_related_product]',
				'SKDD_setting[shop_single_ajax_add_to_cart]',
				'SKDD_setting[shop_single_stock_label]',
				'SKDD_setting[shop_single_stock_product_limit]',
				'SKDD_setting[shop_single_show_weight]',
				'SKDD_setting[shop_single_loading_bar]',
				'SKDD_setting[shop_single_additional_information]',
				'SKDD_setting[shop_single_content_background]',
				'SKDD_setting[shop_single_trust_badge_image]',
			),
		)
	)
);

// Breadcrumbs.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_breadcrumb]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_breadcrumb'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_breadcrumb]',
		array(
			'label'    => __( 'Breadcrumb', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_breadcrumb]',
		)
	)
);

// Product navigation.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_product_navigation]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_product_navigation'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_product_navigation]',
		array(
			'label'    => __( 'Product Navigation', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_product_navigation]',
		)
	)
);

// Ajax single add to cart.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_ajax_add_to_cart]',
	array(
		'default'           => $defaults['shop_single_ajax_add_to_cart'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_ajax_add_to_cart]',
		array(
			'label'    => __( 'Ajax Single Add To Cart', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_ajax_add_to_cart]',
		)
	)
);

// Stock label.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_stock_label]',
	array(
		'default'           => $defaults['shop_single_stock_label'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_stock_label]',
		array(
			'label'    => __( 'Stock Label', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_stock_label]',
		)
	)
);

// Loading Bar.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_loading_bar]',
	array(
		'default'           => $defaults['shop_single_loading_bar'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_loading_bar]',
		array(
			'label'    => __( 'Loading Bar', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_loading_bar]',
		)
	)
);

// Show weight in KG after product price.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_show_weight]',
	array(
		'default'           => $defaults['shop_single_show_weight'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_show_weight]',
		array(
			'label'    => __( 'Show weight after price', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_show_weight]',
		)
	)
);


// Stock product limit.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_stock_product_limit]',
	array(
		'default'           => $defaults['shop_single_stock_product_limit'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_single_stock_product_limit]',
		array(
			'label'       => __( 'Min stock to show', 'SKDD' ),
			'description' => __( 'Default = 0 show stock', 'SKDD' ),
			'settings'    => 'SKDD_setting[shop_single_stock_product_limit]',
			'section'     => 'SKDD_shop_single',
			'type'        => 'number',
		)
	)
);

// Additional information.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_additional_information]',
	array(
		'default'           => $defaults['shop_single_additional_information'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_additional_information]',
		array(
			'label'    => __( 'Additional Information Tab', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_additional_information]',
		)
	)
);

// Product content background.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_content_background]',
	array(
		'default'           => $defaults['shop_single_content_background'],
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_single_content_background]',
		array(
			'label'    => __( 'Content Background', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_content_background]',
		)
	)
);

// Trust badge image.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_trust_badge_image]',
	array(
		'default'           => $defaults['shop_single_trust_badge_image'],
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'SKDD_setting[shop_single_trust_badge_image]',
		array(
			'label'    => __( 'Trust Badge Image', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_trust_badge_image]',
		)
	)
);

// SHOP SINGLE PRODUCT IMAGE SECTION.
$wp_customize->add_setting(
	'shop_single_product_images_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_single_product_images_section',
		array(
			'label'      => __( 'Product Images', 'SKDD' ),
			'section'    => 'SKDD_shop_single',
			'dependency' => array(
				'SKDD_setting[shop_single_gallery_layout]',
				'SKDD_setting[shop_single_image_zoom]',
				'SKDD_setting[shop_single_product_image_height]',
				'SKDD_setting[shop_single_image_lightbox]',
				'SKDD_setting[shop_single_product_sticky_top_space]',
				'SKDD_setting[shop_single_product_sticky_bottom_space]',
			),
		)
	)
);

// Gallery layout.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_gallery_layout]',
	array(
		'default'           => $defaults['shop_single_gallery_layout'],
		'sanitize_callback' => 'SKDD_sanitize_choices',
		'type'              => 'option',
	)
);

$wp_customize->add_control(
	new SKDD_Radio_Image_Control(
		$wp_customize,
		'SKDD_setting[shop_single_gallery_layout]',
		array(
			'label'    => __( 'Gallery Layout', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_gallery_layout]',
			'choices'  => apply_filters(
				'SKDD_setting_sidebar_default_choices',
				array(
					'vertical'   => SKDD_THEME_URI . 'assets/images/customizer/product-images/vertical.jpg',
					'horizontal' => SKDD_THEME_URI . 'assets/images/customizer/product-images/horizontal.jpg',
					'column'     => SKDD_THEME_URI . 'assets/images/customizer/product-images/column.jpg',
					'grid'       => SKDD_THEME_URI . 'assets/images/customizer/product-images/grid.jpg',
				)
			),
		)
	)
);




// Main image height
$wp_customize->add_setting(
	'SKDD_setting[shop_single_product_image_height]',
	array(
		'default'           => $defaults['shop_single_product_image_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_single_product_image_height]',
		array(
			'label'    => __( 'Product image height', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_single_product_image_height]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_shop_single_product_image_height_min_step', 300 ),
					'max'  => apply_filters( 'SKDD_shop_single_product_image_height_max_step', 1000 ),
					'step' => 50,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);




// Image zoom.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_image_zoom]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_image_zoom'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_image_zoom]',
		array(
			'label'    => __( 'Gallery Zoom Effect', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_image_zoom]',
		)
	)
);

// Image lightbox.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_image_lightbox]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_image_lightbox'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_image_lightbox]',
		array(
			'label'    => __( 'Gallery Lightbox Effect', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_image_lightbox]',
		)
	)
);

// Sticky top spacing.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_product_sticky_top_space]',
	array(
		'default'           => $defaults['shop_single_product_sticky_top_space'],
		'type'              => 'option',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_single_product_sticky_top_space]',
		array(
			'label'    => __( 'Top Space', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_single_product_sticky_top_space]',
			'section'  => 'SKDD_shop_single',
			'type'     => 'number',
		)
	)
);

// Sticky bottom spacing.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_product_sticky_bottom_space]',
	array(
		'default'           => $defaults['shop_single_product_sticky_bottom_space'],
		'type'              => 'option',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_single_product_sticky_bottom_space]',
		array(
			'label'    => __( 'Bottom Space', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_single_product_sticky_bottom_space]',
			'section'  => 'SKDD_shop_single',
			'type'     => 'number',
		)
	)
);

// SHOP SINGLE PRODUCT META SECTION.
$wp_customize->add_setting(
	'shop_single_product_meta_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_single_product_meta_section',
		array(
			'label'      => __( 'Product Meta', 'SKDD' ),
			'section'    => 'SKDD_shop_single',
			'dependency' => array(
				'SKDD_setting[shop_single_skus]',
				'SKDD_setting[shop_single_categories]',
				'SKDD_setting[shop_single_tags]',
			),
		)
	)
);

// Sku.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_skus]',
	array(
		'type'              => 'option',
		'transport'         => 'postMessage',
		'default'           => $defaults['shop_single_skus'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_skus]',
		array(
			'label'    => __( 'SKU', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_skus]',
		)
	)
);

// Categories.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_categories]',
	array(
		'type'              => 'option',
		'transport'         => 'postMessage',
		'default'           => $defaults['shop_single_categories'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_categories]',
		array(
			'label'    => __( 'Categories', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_categories]',
		)
	)
);

// Tags.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_tags]',
	array(
		'type'              => 'option',
		'transport'         => 'postMessage',
		'default'           => $defaults['shop_single_tags'],
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_tags]',
		array(
			'label'    => __( 'Tags', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_tags]',
		)
	)
);

// Tab Order
$wp_customize->add_setting(
	'SKDD_setting[wc_tab_order]',
	[
		'default'           => $defaults['wc_tab_order'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
	]
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[wc_tab_order]',
		[
			'label'       => __( 'Order of additional information', 'SKDD' ),
			'description' => __( 'The tab order for specs & downloads', 'SKDD' ),
			'settings'    => 'SKDD_setting[wc_tab_order]',
			'section'     => 'SKDD_shop_single',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_wc_tab_order_choices',
				array(
					'default'   => __( 'Default Order', 'SKDD' ),
					'specs_first' => __( 'Product Specs First', 'SKDD' ),
					'reviews_first' => __( 'Product Reviews First', 'SKDD' ),
				)
			),
		]
	)
);

// SHOP SINGLE RELATED PRODUCT SECTION.
$wp_customize->add_setting(
	'shop_single_product_related_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_single_product_related_section',
		array(
			'label'      => __( 'Related Products', 'SKDD' ),
			'section'    => 'SKDD_shop_single',
			'dependency' => array(
				'SKDD_setting[shop_single_related_product]',
				'SKDD_setting[shop_single_product_related_total]',
				'SKDD_setting[shop_single_product_related_columns]',
			),
		)
	)
);

// Product related.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_related_product]',
	array(
		'default'           => $defaults['shop_single_related_product'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_related_product]',
		array(
			'label'    => __( 'Display', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_single_related_product]',
			'section'  => 'SKDD_shop_single',
		)
	)
);

// Related product total.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_product_related_total]',
	array(
		'default'           => $defaults['shop_single_product_related_total'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_single_product_related_total]',
		array(
			'label'    => __( 'Total Products', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_single_product_related_total]',
			'section'  => 'SKDD_shop_single',
			'type'     => 'number',
		)
	)
);

// Related columns.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_product_related_columns]',
	array(
		'default'           => $defaults['shop_single_product_related_columns'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_single_product_related_columns]',
		array(
			'label'    => __( 'Columns', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_single_product_related_columns]',
			'section'  => 'SKDD_shop_single',
			'type'     => 'select',
			'choices'  => apply_filters(
				'SKDD_setting_shop_single_product_related_columns_choices',
				array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
					6 => 6,
				)
			),
		)
	)
);

// SHOP SINGLE RECENTLY VIEW SECTION.
$wp_customize->add_setting(
	'shop_single_recently_viewed_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_single_recently_viewed_section',
		array(
			'label'      => __( 'Recently Viewed Products', 'SKDD' ),
			'section'    => 'SKDD_shop_single',
			'dependency' => array(
				'SKDD_setting[shop_single_product_recently_viewed]',
				'SKDD_setting[shop_single_recently_viewed_title]',
				'SKDD_setting[shop_single_recently_viewed_count]',
			),
		)
	)
);

// Product recently viewed.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_product_recently_viewed]',
	array(
		'default'           => $defaults['shop_single_product_recently_viewed'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new SKDD_Switch_Control(
		$wp_customize,
		'SKDD_setting[shop_single_product_recently_viewed]',
		array(
			'label'    => __( 'Display', 'SKDD' ),
			'settings' => 'SKDD_setting[shop_single_product_recently_viewed]',
			'section'  => 'SKDD_shop_single',
		)
	)
);

// Section title.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_recently_viewed_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => $defaults['shop_single_recently_viewed_title'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_single_recently_viewed_title]',
		array(
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_recently_viewed_title]',
			'type'     => 'text',
			'label'    => __( 'Section Title', 'SKDD' ),
		)
	)
);

// Total product.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_recently_viewed_count]',
	array(
		'sanitize_callback' => 'absint',
		'default'           => $defaults['shop_single_recently_viewed_count'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'SKDD_setting[shop_single_recently_viewed_count]',
		array(
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_recently_viewed_count]',
			'type'     => 'number',
			'label'    => __( 'Total Product', 'SKDD' ),
		)
	)
);

// SHOP SINGLE ADD TO CART.
$wp_customize->add_setting(
	'shop_single_product_button_cart',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new SKDD_Section_Control(
		$wp_customize,
		'shop_single_product_button_cart',
		array(
			'label'      => __( 'Button Add To Cart', 'SKDD' ),
			'section'    => 'SKDD_shop_single',
			'dependency' => array(
				'SKDD_setting[shop_single_button_cart_background]',
				'SKDD_setting[shop_single_button_cart_color]',
				'SKDD_setting[shop_single_button_background_hover]',
				'SKDD_setting[shop_single_button_color_hover]',
				'SKDD_setting[shop_single_button_border_radius]',
			),
		)
	)
);

// Button Background.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_button_cart_background]',
	array(
		'default'           => $defaults['shop_single_button_cart_background'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_single_button_cart_background]',
		array(
			'label'    => __( 'Background', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_button_cart_background]',
		)
	)
);

// Button Color.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_button_cart_color]',
	array(
		'default'           => $defaults['shop_single_button_cart_color'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_single_button_cart_color]',
		array(
			'label'    => __( 'Color', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_button_cart_color]',
		)
	)
);

// Button Hover Background.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_button_background_hover]',
	array(
		'default'           => $defaults['shop_single_button_background_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_single_button_background_hover]',
		array(
			'label'    => __( 'Hover Background', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_button_background_hover]',
		)
	)
);

// Button Hover Color.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_button_color_hover]',
	array(
		'default'           => $defaults['shop_single_button_color_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'SKDD_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Color_Control(
		$wp_customize,
		'SKDD_setting[shop_single_button_color_hover]',
		array(
			'label'    => __( 'Hover Color', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => 'SKDD_setting[shop_single_button_color_hover]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'SKDD_setting[shop_single_button_border_radius]',
	array(
		'default'           => $defaults['shop_single_button_border_radius'],
		'type'              => 'option',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SKDD_Range_Slider_Control(
		$wp_customize,
		'SKDD_setting[shop_single_button_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'SKDD' ),
			'section'  => 'SKDD_shop_single',
			'settings' => array(
				'desktop' => 'SKDD_setting[shop_single_button_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'SKDD_shop_single_button_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'SKDD_shop_single_button_border_radius_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
