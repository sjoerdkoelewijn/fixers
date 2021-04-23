<?php
/**
 * Register customizer panels & sections.
 *
 * @package     SKDD
 */

// LAYOUT.
$layout_sections = apply_filters(
	'SKDD_customizer_layout_sections',
	array(
		'SKDD_container'          => __( 'Site Container', 'SKDD' ),
		'SKDD_topbar'             => __( 'Topbar', 'SKDD' ),
		'SKDD_header'             => __( 'Normal Header', 'SKDD' ),
		'SKDD_header_transparent' => __( 'Header Transparent', 'SKDD' ),
		'SKDD_page_header'        => __( 'Page Header', 'SKDD' ),
		'SKDD_blog'               => __( 'Blog', 'SKDD' ),
		'SKDD_blog_single'        => __( 'Blog Single', 'SKDD' ),
		'SKDD_sidebar'            => __( 'Sidebar', 'SKDD' ),
		'SKDD_footer'             => __( 'Footer', 'SKDD' ),
		'SKDD_error'              => __( '404', 'SKDD' ),
		'SKDD_scroll_to_top'      => __( 'Scroll To Top', 'SKDD' ),		
	)
);

$wp_customize->add_panel(
	'SKDD_layout',
	array(
		'title'    => __( 'Layout', 'SKDD' ),
		'priority' => 30,
	)
);

foreach ( $layout_sections as $section_id => $name ) {
	$wp_customize->add_section(
		$section_id,
		array(
			'title' => $name,
			'panel' => 'SKDD_layout',
		)
	);
}

// COLORS.
$wp_customize->add_section(
	'SKDD_color',
	array(
		'title'    => __( 'Colors', 'SKDD' ),
		'priority' => 30,
	)
);

// BUTTONS.
$wp_customize->add_section(
	'SKDD_buttons',
	array(
		'title'    => __( 'Buttons', 'SKDD' ),
		'priority' => 35,
	)
);

// CUSTOM POST TYPES.
$wp_customize->add_section(
	'SKDD_custom_post_types',
	array(
		'title'    => __( 'Custom Post Types', 'SKDD' ),
		'priority' => 30,
	)
);

// TYPOGRAPHY.
$wp_customize->add_panel(
	'SKDD_typography',
	array(
		'title'    => __( 'Typography', 'SKDD' ),
		'priority' => 35,
	)
);

// Body.
$wp_customize->add_section(
	'body_font_section',
	array(
		'title' => __( 'Body', 'SKDD' ),
		'panel' => 'SKDD_typography',
	)
);

// Primary menu.
$wp_customize->add_section(
	'menu_font_section',
	array(
		'title' => __( 'Primary menu', 'SKDD' ),
		'panel' => 'SKDD_typography',
	)
);

// Heading.
$wp_customize->add_section(
	'heading_font_section',
	array(
		'title' => __( 'Heading', 'SKDD' ),
		'panel' => 'SKDD_typography',
	)
);

// WOOCOMMERCE.
// Shop page.
$wp_customize->add_section(
	'SKDD_shop_page',
	array(
		'title' => __( 'Shop Archive', 'SKDD' ),
		'panel' => 'woocommerce',
	)
);

// Shop single.
$wp_customize->add_section(
	'SKDD_shop_single',
	array(
		'title' => __( 'Product Single', 'SKDD' ),
		'panel' => 'woocommerce',
	)
);

// Cart page.
$wp_customize->add_section(
	'SKDD_cart_page',
	array(
		'title' => __( 'Cart Page', 'SKDD' ),
		'panel' => 'woocommerce',
	)
);

// Wholesale page.
$wp_customize->add_section(
	'SKDD_wholesale_page',
	array(
		'title' => __( 'Wholesale', 'SKDD' ),
		'panel' => 'woocommerce',
	)
);