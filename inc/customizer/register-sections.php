<?php
/**
 * Register customizer panels & sections.
 *
 * @package     Roxtar
 */

// LAYOUT.
$layout_sections = apply_filters(
	'roxtar_customizer_layout_sections',
	array(
		'roxtar_container'          => __( 'Site Container', 'roxtar' ),
		'roxtar_topbar'             => __( 'Topbar', 'roxtar' ),
		'roxtar_header'             => __( 'Normal Header', 'roxtar' ),
		'roxtar_header_transparent' => __( 'Header Transparent', 'roxtar' ),
		'roxtar_page_header'        => __( 'Page Header', 'roxtar' ),
		'roxtar_blog'               => __( 'Blog', 'roxtar' ),
		'roxtar_blog_single'        => __( 'Blog Single', 'roxtar' ),
		'roxtar_sidebar'            => __( 'Sidebar', 'roxtar' ),
		'roxtar_footer'             => __( 'Footer', 'roxtar' ),
		'roxtar_error'              => __( '404', 'roxtar' ),
		'roxtar_scroll_to_top'      => __( 'Scroll To Top', 'roxtar' ),
	)
);

$wp_customize->add_panel(
	'roxtar_layout',
	array(
		'title'    => __( 'Layout', 'roxtar' ),
		'priority' => 30,
	)
);

foreach ( $layout_sections as $section_id => $name ) {
	$wp_customize->add_section(
		$section_id,
		array(
			'title' => $name,
			'panel' => 'roxtar_layout',
		)
	);
}

// COLORS.
$wp_customize->add_section(
	'roxtar_color',
	array(
		'title'    => __( 'Color', 'roxtar' ),
		'priority' => 30,
	)
);

// BUTTONS.
$wp_customize->add_section(
	'roxtar_buttons',
	array(
		'title'    => __( 'Buttons', 'roxtar' ),
		'priority' => 30,
	)
);

// TYPOGRAPHY.
$wp_customize->add_panel(
	'roxtar_typography',
	array(
		'title'    => __( 'Typography', 'roxtar' ),
		'priority' => 35,
	)
);

// Body.
$wp_customize->add_section(
	'body_font_section',
	array(
		'title' => __( 'Body', 'roxtar' ),
		'panel' => 'roxtar_typography',
	)
);

// Primary menu.
$wp_customize->add_section(
	'menu_font_section',
	array(
		'title' => __( 'Primary menu', 'roxtar' ),
		'panel' => 'roxtar_typography',
	)
);

// Heading.
$wp_customize->add_section(
	'heading_font_section',
	array(
		'title' => __( 'Heading', 'roxtar' ),
		'panel' => 'roxtar_typography',
	)
);

// WOOCOMMERCE.
// Shop page.
$wp_customize->add_section(
	'roxtar_shop_page',
	array(
		'title' => __( 'Shop Archive', 'roxtar' ),
		'panel' => 'woocommerce',
	)
);

// Shop single.
$wp_customize->add_section(
	'roxtar_shop_single',
	array(
		'title' => __( 'Product Single', 'roxtar' ),
		'panel' => 'woocommerce',
	)
);

// Cart page.
$wp_customize->add_section(
	'roxtar_cart_page',
	array(
		'title' => __( 'Cart Page', 'roxtar' ),
		'panel' => 'woocommerce',
	)
);

// Wholesale page.
$wp_customize->add_section(
	'roxtar_wholesale_page',
	array(
		'title' => __( 'Wholesale', 'roxtar' ),
		'panel' => 'woocommerce',
	)
);
