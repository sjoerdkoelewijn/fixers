<?php
/**
 * Roxtar hooks
 *
 * @package roxtar
 */

defined( 'ABSPATH' ) || exit;

/**
 * General
 */
add_action( 'roxtar_sidebar', 'roxtar_get_sidebar', 10 );

// Head tag.
add_action( 'wp_head', 'roxtar_meta_charset', 0 );
add_action( 'wp_head', 'roxtar_meta_viewport', 220 );
add_action( 'wp_head', 'roxtar_rel_profile', 230 );
add_action( 'wp_head', 'roxtar_facebook_social', 240 );
add_action( 'wp_head', 'roxtar_pingback', 250 );

// Performance.
add_action( 'wp_enqueue_scripts', 'roxtar_dequeue_scripts_and_styles' );

/**
 * Header
 */
add_action( 'roxtar_theme_header', 'roxtar_template_header' );
add_action( 'roxtar_theme_header', 'roxtar_after_header', 100 );

// Header template part.
add_action( 'roxtar_template_part_header', 'roxtar_view_open', 10 ); // Open #view.
add_action( 'roxtar_template_part_header', 'roxtar_topbar', 20 );
add_action( 'roxtar_template_part_header', 'roxtar_site_header', 30 );

// Inside @roxtar_site_header hook.
add_action( 'roxtar_site_header', 'roxtar_skip_links', 5 );
add_action( 'roxtar_site_header', 'roxtar_menu_toggle_btn', 10 );
add_action( 'roxtar_site_header', 'roxtar_site_branding', 20 );
add_action( 'roxtar_site_header', 'roxtar_primary_navigation', 30 );
add_action( 'roxtar_site_header', 'roxtar_header_action', 50 );

// Inside @roxtar_after_header hook.
add_action( 'roxtar_after_header', 'roxtar_page_header', 10 );
add_action( 'roxtar_after_header', 'roxtar_content_open', 20 ); // Open #content.
add_action( 'roxtar_after_header', 'roxtar_content_top', 30 );

// Inside @roxtar_content_top hook.
add_action( 'roxtar_content_top', 'roxtar_content_top_open', 10 );
add_action( 'roxtar_content_top', 'roxtar_content_top_close', 70 );

/**
 * Page Header
 */
add_action( 'roxtar_page_header_breadcrumb', 'roxtar_breadcrumb', 10 );

/**
 * Footer
 */
add_action( 'roxtar_theme_footer', 'roxtar_before_footer', 0 );
add_action( 'roxtar_theme_footer', 'roxtar_template_footer' );
add_action( 'roxtar_theme_footer', 'roxtar_after_footer', 100 );

// Footer template part.
add_action( 'roxtar_template_part_footer', 'roxtar_site_footer', 10 );

// Inside @roxtar_before_footer hook.
add_action( 'roxtar_before_footer', 'roxtar_content_close', 10 ); // Close #content.

// Inside @roxtar_after_footer hook.
add_action( 'roxtar_after_footer', 'roxtar_view_close', 0 ); // Close #view.
add_action( 'roxtar_after_footer', 'roxtar_toggle_sidebar', 10 );
add_action( 'roxtar_after_footer', 'roxtar_overlay', 20 );
add_action( 'roxtar_after_footer', 'roxtar_footer_action', 20 );
add_action( 'roxtar_after_footer', 'roxtar_dialog_search', 30 );

// Inside @roxtar_footer_action hook.
add_action( 'roxtar_footer_action', 'roxtar_scroll_to_top', 40 );

// Inside @roxtar_site_footer hook.
add_action( 'roxtar_footer_content', 'roxtar_footer_widgets', 10 );
add_action( 'roxtar_footer_content', 'roxtar_credit', 20 );

// Inside @roxtar_toggle_sidebar hook.
add_action( 'roxtar_toggle_sidebar', 'roxtar_sidebar_menu_open', 10 );
add_action( 'roxtar_toggle_sidebar', 'roxtar_search', 20 );
add_action( 'roxtar_toggle_sidebar', 'roxtar_primary_navigation', 30 );
add_action( 'roxtar_toggle_sidebar', 'roxtar_sidebar_menu_action', 40 );
add_action( 'roxtar_toggle_sidebar', 'roxtar_sidebar_menu_close', 50 );

/**
 * Posts
 */
add_action( 'roxtar_loop_post', 'roxtar_post_loop_image_thumbnail', 10 );
add_action( 'roxtar_loop_post', 'roxtar_post_loop_inner_open', 20 );
add_action( 'roxtar_loop_post', 'roxtar_post_header_open', 30 );
add_action( 'roxtar_loop_post', 'roxtar_post_structure', 40 );
add_action( 'roxtar_loop_post', 'roxtar_post_header_close', 50 );
add_action( 'roxtar_loop_post', 'roxtar_post_content', 60 );
add_action( 'roxtar_loop_post', 'roxtar_post_loop_inner_close', 70 );

add_action( 'roxtar_loop_after', 'roxtar_paging_nav', 10 );
add_action( 'roxtar_post_content_after', 'roxtar_post_read_more_button', 10 );

add_action( 'roxtar_single_post', 'roxtar_post_single_structure', 10 );
add_action( 'roxtar_single_post', 'roxtar_post_content', 20 );
add_action( 'roxtar_single_post', 'roxtar_post_tags', 30 );

add_action( 'roxtar_single_post_after', 'roxtar_post_nav', 10 );
add_action( 'roxtar_single_post_after', 'roxtar_post_author_box', 20 );
add_action( 'roxtar_single_post_after', 'roxtar_post_related', 30 );
add_action( 'roxtar_single_post_after', 'roxtar_display_comments', 40 );

/**
 * Pages
 */
add_action( 'roxtar_page', 'roxtar_page_content', 20 );
add_action( 'roxtar_page_after', 'roxtar_display_comments', 10 );


/**
 * Elementor
 */

// Template builder. See inc/roxtar-template-builder.php.
add_action( 'roxtar_theme_single', 'roxtar_template_single' );
add_action( 'roxtar_theme_archive', 'roxtar_template_archive' );
add_action( 'roxtar_theme_404', 'roxtar_template_404' );

// Add Cart sidebar for Page using Elementor Canvas.
if ( roxtar_is_woocommerce_activated() ) {
	add_action( 'elementor/page_templates/canvas/after_content', 'roxtar_woocommerce_cart_sidebar', 20 );
}
add_action( 'elementor/page_templates/canvas/after_content', 'roxtar_overlay', 30 );
add_action( 'elementor/page_templates/canvas/after_content', 'roxtar_footer_action', 40 );
add_action( 'elementor/page_templates/canvas/after_content', 'roxtar_dialog_search', 50 );
