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

// SHOP SINGLE STRUCTURE SECTION.
$wp_customize->add_setting(
	'shop_single_general_section',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_single_general_section',
		array(
			'label'      => __( 'General', 'roxtar' ),
			'section'    => 'roxtar_shop_single',
			'dependency' => array(
				'roxtar_setting[shop_single_breadcrumb]',
				'roxtar_setting[shop_single_product_navigation]',
				'roxtar_setting[shop_single_related_product]',
				'roxtar_setting[shop_single_ajax_add_to_cart]',
				'roxtar_setting[shop_single_stock_label]',
				'roxtar_setting[shop_single_stock_product_limit]',
				'roxtar_setting[shop_single_loading_bar]',
				'roxtar_setting[shop_single_additional_information]',
				'roxtar_setting[shop_single_content_background]',
				'roxtar_setting[shop_single_trust_badge_image]',
			),
		)
	)
);

// Breadcrumbs.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_breadcrumb]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_breadcrumb'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_breadcrumb]',
		array(
			'label'    => __( 'Breadcrumb', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_breadcrumb]',
		)
	)
);

// Product navigation.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_product_navigation]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_product_navigation'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_product_navigation]',
		array(
			'label'    => __( 'Product Navigation', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_product_navigation]',
		)
	)
);

// Ajax single add to cart.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_ajax_add_to_cart]',
	array(
		'default'           => $defaults['shop_single_ajax_add_to_cart'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_ajax_add_to_cart]',
		array(
			'label'    => __( 'Ajax Single Add To Cart', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_ajax_add_to_cart]',
		)
	)
);

// Stock label.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_stock_label]',
	array(
		'default'           => $defaults['shop_single_stock_label'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_stock_label]',
		array(
			'label'    => __( 'Stock Label', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_stock_label]',
		)
	)
);

// Loading Bar.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_loading_bar]',
	array(
		'default'           => $defaults['shop_single_loading_bar'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_loading_bar]',
		array(
			'label'    => __( 'Loading Bar', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_loading_bar]',
		)
	)
);

// Stock product limit.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_stock_product_limit]',
	array(
		'default'           => $defaults['shop_single_stock_product_limit'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_single_stock_product_limit]',
		array(
			'label'       => __( 'Min stock to show', 'roxtar' ),
			'description' => __( 'Default = 0 show stock', 'roxtar' ),
			'settings'    => 'roxtar_setting[shop_single_stock_product_limit]',
			'section'     => 'roxtar_shop_single',
			'type'        => 'number',
		)
	)
);

// Additional information.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_additional_information]',
	array(
		'default'           => $defaults['shop_single_additional_information'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_additional_information]',
		array(
			'label'    => __( 'Additional Information Tab', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_additional_information]',
		)
	)
);

// Product content background.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_content_background]',
	array(
		'default'           => $defaults['shop_single_content_background'],
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_single_content_background]',
		array(
			'label'    => __( 'Content Background', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_content_background]',
		)
	)
);

// Trust badge image.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_trust_badge_image]',
	array(
		'default'           => $defaults['shop_single_trust_badge_image'],
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'roxtar_setting[shop_single_trust_badge_image]',
		array(
			'label'    => __( 'Trust Badge Image', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_trust_badge_image]',
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_single_product_images_section',
		array(
			'label'      => __( 'Product Images', 'roxtar' ),
			'section'    => 'roxtar_shop_single',
			'dependency' => array(
				'roxtar_setting[shop_single_gallery_layout]',
				'roxtar_setting[shop_single_image_zoom]',
				'roxtar_setting[shop_single_product_image_height]',
				'roxtar_setting[shop_single_image_lightbox]',
				'roxtar_setting[shop_single_product_sticky_top_space]',
				'roxtar_setting[shop_single_product_sticky_bottom_space]',
			),
		)
	)
);

// Gallery layout.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_gallery_layout]',
	array(
		'default'           => $defaults['shop_single_gallery_layout'],
		'sanitize_callback' => 'roxtar_sanitize_choices',
		'type'              => 'option',
	)
);

$wp_customize->add_control(
	new Roxtar_Radio_Image_Control(
		$wp_customize,
		'roxtar_setting[shop_single_gallery_layout]',
		array(
			'label'    => __( 'Gallery Layout', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_gallery_layout]',
			'choices'  => apply_filters(
				'roxtar_setting_sidebar_default_choices',
				array(
					'vertical'   => ROXTAR_THEME_URI . 'assets/images/customizer/product-images/vertical.jpg',
					'horizontal' => ROXTAR_THEME_URI . 'assets/images/customizer/product-images/horizontal.jpg',
					'column'     => ROXTAR_THEME_URI . 'assets/images/customizer/product-images/column.jpg',
					'grid'       => ROXTAR_THEME_URI . 'assets/images/customizer/product-images/grid.jpg',
				)
			),
		)
	)
);




// Main image height
$wp_customize->add_setting(
	'roxtar_setting[shop_single_product_image_height]',
	array(
		'default'           => $defaults['shop_single_product_image_height'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_single_product_image_height]',
		array(
			'label'    => __( 'Product image height', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_single_product_image_height]',
			),
			'choices' => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_shop_single_product_image_height_min_step', 300 ),
					'max'  => apply_filters( 'roxtar_shop_single_product_image_height_max_step', 1000 ),
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
	'roxtar_setting[shop_single_image_zoom]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_image_zoom'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_image_zoom]',
		array(
			'label'    => __( 'Gallery Zoom Effect', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_image_zoom]',
		)
	)
);

// Image lightbox.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_image_lightbox]',
	array(
		'type'              => 'option',
		'default'           => $defaults['shop_single_image_lightbox'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_image_lightbox]',
		array(
			'label'    => __( 'Gallery Lightbox Effect', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_image_lightbox]',
		)
	)
);

// Sticky top spacing.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_product_sticky_top_space]',
	array(
		'default'           => $defaults['shop_single_product_sticky_top_space'],
		'type'              => 'option',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_single_product_sticky_top_space]',
		array(
			'label'    => __( 'Top Space', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_single_product_sticky_top_space]',
			'section'  => 'roxtar_shop_single',
			'type'     => 'number',
		)
	)
);

// Sticky bottom spacing.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_product_sticky_bottom_space]',
	array(
		'default'           => $defaults['shop_single_product_sticky_bottom_space'],
		'type'              => 'option',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_single_product_sticky_bottom_space]',
		array(
			'label'    => __( 'Bottom Space', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_single_product_sticky_bottom_space]',
			'section'  => 'roxtar_shop_single',
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_single_product_meta_section',
		array(
			'label'      => __( 'Product Meta', 'roxtar' ),
			'section'    => 'roxtar_shop_single',
			'dependency' => array(
				'roxtar_setting[shop_single_skus]',
				'roxtar_setting[shop_single_categories]',
				'roxtar_setting[shop_single_tags]',
			),
		)
	)
);

// Sku.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_skus]',
	array(
		'type'              => 'option',
		'transport'         => 'postMessage',
		'default'           => $defaults['shop_single_skus'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_skus]',
		array(
			'label'    => __( 'SKU', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_skus]',
		)
	)
);

// Categories.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_categories]',
	array(
		'type'              => 'option',
		'transport'         => 'postMessage',
		'default'           => $defaults['shop_single_categories'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_categories]',
		array(
			'label'    => __( 'Categories', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_categories]',
		)
	)
);

// Tags.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_tags]',
	array(
		'type'              => 'option',
		'transport'         => 'postMessage',
		'default'           => $defaults['shop_single_tags'],
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_tags]',
		array(
			'label'    => __( 'Tags', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_tags]',
		)
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_single_product_related_section',
		array(
			'label'      => __( 'Related Products', 'roxtar' ),
			'section'    => 'roxtar_shop_single',
			'dependency' => array(
				'roxtar_setting[shop_single_related_product]',
				'roxtar_setting[shop_single_product_related_total]',
				'roxtar_setting[shop_single_product_related_columns]',
			),
		)
	)
);

// Product related.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_related_product]',
	array(
		'default'           => $defaults['shop_single_related_product'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_related_product]',
		array(
			'label'    => __( 'Display', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_single_related_product]',
			'section'  => 'roxtar_shop_single',
		)
	)
);

// Related product total.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_product_related_total]',
	array(
		'default'           => $defaults['shop_single_product_related_total'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_single_product_related_total]',
		array(
			'label'    => __( 'Total Products', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_single_product_related_total]',
			'section'  => 'roxtar_shop_single',
			'type'     => 'number',
		)
	)
);

// Related columns.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_product_related_columns]',
	array(
		'default'           => $defaults['shop_single_product_related_columns'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_choices',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_single_product_related_columns]',
		array(
			'label'    => __( 'Columns', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_single_product_related_columns]',
			'section'  => 'roxtar_shop_single',
			'type'     => 'select',
			'choices'  => apply_filters(
				'roxtar_setting_shop_single_product_related_columns_choices',
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_single_recently_viewed_section',
		array(
			'label'      => __( 'Recently Viewed Products', 'roxtar' ),
			'section'    => 'roxtar_shop_single',
			'dependency' => array(
				'roxtar_setting[shop_single_product_recently_viewed]',
				'roxtar_setting[shop_single_recently_viewed_title]',
				'roxtar_setting[shop_single_recently_viewed_count]',
			),
		)
	)
);

// Product recently viewed.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_product_recently_viewed]',
	array(
		'default'           => $defaults['shop_single_product_recently_viewed'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Roxtar_Switch_Control(
		$wp_customize,
		'roxtar_setting[shop_single_product_recently_viewed]',
		array(
			'label'    => __( 'Display', 'roxtar' ),
			'settings' => 'roxtar_setting[shop_single_product_recently_viewed]',
			'section'  => 'roxtar_shop_single',
		)
	)
);

// Section title.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_recently_viewed_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => $defaults['shop_single_recently_viewed_title'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_single_recently_viewed_title]',
		array(
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_recently_viewed_title]',
			'type'     => 'text',
			'label'    => __( 'Section Title', 'roxtar' ),
		)
	)
);

// Total product.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_recently_viewed_count]',
	array(
		'sanitize_callback' => 'absint',
		'default'           => $defaults['shop_single_recently_viewed_count'],
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'roxtar_setting[shop_single_recently_viewed_count]',
		array(
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_recently_viewed_count]',
			'type'     => 'number',
			'label'    => __( 'Total Product', 'roxtar' ),
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
	new Roxtar_Section_Control(
		$wp_customize,
		'shop_single_product_button_cart',
		array(
			'label'      => __( 'Button Add To Cart', 'roxtar' ),
			'section'    => 'roxtar_shop_single',
			'dependency' => array(
				'roxtar_setting[shop_single_button_cart_background]',
				'roxtar_setting[shop_single_button_cart_color]',
				'roxtar_setting[shop_single_button_background_hover]',
				'roxtar_setting[shop_single_button_color_hover]',
				'roxtar_setting[shop_single_button_border_radius]',
			),
		)
	)
);

// Button Background.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_button_cart_background]',
	array(
		'default'           => $defaults['shop_single_button_cart_background'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_single_button_cart_background]',
		array(
			'label'    => __( 'Background', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_button_cart_background]',
		)
	)
);

// Button Color.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_button_cart_color]',
	array(
		'default'           => $defaults['shop_single_button_cart_color'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_single_button_cart_color]',
		array(
			'label'    => __( 'Color', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_button_cart_color]',
		)
	)
);

// Button Hover Background.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_button_background_hover]',
	array(
		'default'           => $defaults['shop_single_button_background_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_single_button_background_hover]',
		array(
			'label'    => __( 'Hover Background', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_button_background_hover]',
		)
	)
);

// Button Hover Color.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_button_color_hover]',
	array(
		'default'           => $defaults['shop_single_button_color_hover'],
		'type'              => 'option',
		'sanitize_callback' => 'roxtar_sanitize_rgba_color',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Color_Control(
		$wp_customize,
		'roxtar_setting[shop_single_button_color_hover]',
		array(
			'label'    => __( 'Hover Color', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => 'roxtar_setting[shop_single_button_color_hover]',
		)
	)
);

// Border radius.
$wp_customize->add_setting(
	'roxtar_setting[shop_single_button_border_radius]',
	array(
		'default'           => $defaults['shop_single_button_border_radius'],
		'type'              => 'option',
		'sanitize_callback' => 'esc_html',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Roxtar_Range_Slider_Control(
		$wp_customize,
		'roxtar_setting[shop_single_button_border_radius]',
		array(
			'label'    => __( 'Border Radius', 'roxtar' ),
			'section'  => 'roxtar_shop_single',
			'settings' => array(
				'desktop' => 'roxtar_setting[shop_single_button_border_radius]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'roxtar_shop_single_button_border_radius_min_step', 0 ),
					'max'  => apply_filters( 'roxtar_shop_single_button_border_radius_max_step', 50 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);
