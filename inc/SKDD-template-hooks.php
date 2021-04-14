<?php
/**
 * SKDD hooks
 *
 * @package SKDD
 */

defined( 'ABSPATH' ) || exit;

/**
 * General
 */
add_action( 'SKDD_sidebar', 'SKDD_get_sidebar', 10 );

// Head tag.
add_action( 'wp_head', 'SKDD_meta_charset', 0 );
add_action( 'wp_head', 'SKDD_meta_viewport', 220 );
add_action( 'wp_head', 'SKDD_rel_profile', 230 );
add_action( 'wp_head', 'SKDD_facebook_social', 240 );
add_action( 'wp_head', 'SKDD_pingback', 250 );

// Performance.
add_action( 'wp_enqueue_scripts', 'SKDD_dequeue_scripts_and_styles' );

/**
 * Header
 */
add_action( 'SKDD_theme_header', 'SKDD_template_header' );
add_action( 'SKDD_theme_header', 'SKDD_after_header', 100 );

// Header template part.
add_action( 'SKDD_template_part_header', 'SKDD_view_open', 10 ); // Open #view.
add_action( 'SKDD_template_part_header', 'SKDD_topbar', 20 );
add_action( 'SKDD_template_part_header', 'SKDD_site_header', 30 );

// Inside @SKDD_site_header hook.
add_action( 'SKDD_site_header', 'SKDD_skip_links', 5 );
add_action( 'SKDD_site_header', 'SKDD_menu_toggle_btn', 10 );
add_action( 'SKDD_site_header', 'SKDD_site_branding', 20 );
add_action( 'SKDD_site_header', 'SKDD_primary_navigation', 30 );

add_action( 'SKDD_site_header', 'SKDD_header_action', 50 );

// Inside @SKDD_after_header hook.
add_action( 'SKDD_after_header', 'SKDD_page_header', 10 );
add_action( 'SKDD_after_header', 'SKDD_content_open', 20 ); // Open #content.
add_action( 'SKDD_after_header', 'SKDD_content_top', 30 );

// Inside @SKDD_content_top hook.
add_action( 'SKDD_content_top', 'SKDD_content_top_open', 10 );
add_action( 'SKDD_content_top', 'SKDD_content_top_close', 70 );

/**
 * Page Header
 */
add_action( 'SKDD_page_header_breadcrumb', 'SKDD_breadcrumb', 10 );

/**
 * Footer
 */
add_action( 'SKDD_theme_footer', 'SKDD_before_footer', 0 );
add_action( 'SKDD_theme_footer', 'SKDD_template_footer' );
add_action( 'SKDD_theme_footer', 'SKDD_after_footer', 100 );

// Footer template part.
add_action( 'SKDD_template_part_footer', 'SKDD_site_footer', 10 );

// Inside @SKDD_before_footer hook.
add_action( 'SKDD_before_footer', 'SKDD_content_close', 10 ); // Close #content.

// Inside @SKDD_after_footer hook.
add_action( 'SKDD_after_footer', 'SKDD_view_close', 0 ); // Close #view.
add_action( 'SKDD_after_footer', 'SKDD_toggle_sidebar', 10 );
add_action( 'SKDD_after_footer', 'SKDD_overlay', 20 );
add_action( 'SKDD_after_footer', 'SKDD_footer_action', 20 );
add_action( 'SKDD_after_footer', 'SKDD_dialog_search', 30 );

// Inside @SKDD_footer_action hook.
add_action( 'SKDD_footer_action', 'SKDD_scroll_to_top', 40 );

// Inside @SKDD_site_footer hook.
add_action( 'SKDD_footer_content', 'SKDD_footer_widgets', 10 );
add_action( 'SKDD_footer_content', 'SKDD_credit', 20 );

// Inside @SKDD_toggle_sidebar hook.
add_action( 'SKDD_toggle_sidebar', 'SKDD_sidebar_menu_open', 10 );
add_action( 'SKDD_toggle_sidebar', 'SKDD_search', 20 );
add_action( 'SKDD_toggle_sidebar', 'SKDD_primary_navigation', 30 );
add_action( 'SKDD_toggle_sidebar', 'SKDD_sidebar_menu_action', 40 );
add_action( 'SKDD_toggle_sidebar', 'SKDD_sidebar_menu_close', 50 );

/**
 * Posts
 */
add_action( 'SKDD_loop_post', 'SKDD_post_loop_image_thumbnail', 10 );
add_action( 'SKDD_loop_post', 'SKDD_post_loop_inner_open', 20 );
add_action( 'SKDD_loop_post', 'SKDD_post_header_open', 30 );
add_action( 'SKDD_loop_post', 'SKDD_post_structure', 40 );
add_action( 'SKDD_loop_post', 'SKDD_post_header_close', 50 );
add_action( 'SKDD_loop_post', 'SKDD_post_content', 60 );
add_action( 'SKDD_loop_post', 'SKDD_post_loop_inner_close', 70 );

add_action( 'SKDD_loop_after', 'SKDD_paging_nav', 10 );
add_action( 'SKDD_post_content_after', 'SKDD_post_read_more_button', 10 );

add_action( 'SKDD_single_post', 'SKDD_post_single_structure', 10 );
add_action( 'SKDD_single_post', 'SKDD_post_content', 20 );
add_action( 'SKDD_single_post', 'SKDD_post_tags', 30 );

add_action( 'SKDD_single_post_after', 'SKDD_post_nav', 10 );
add_action( 'SKDD_single_post_after', 'SKDD_post_author_box', 20 );
add_action( 'SKDD_single_post_after', 'SKDD_post_related', 30 );
add_action( 'SKDD_single_post_after', 'SKDD_display_comments', 40 );

/**
 * Pages
 */
add_action( 'SKDD_page', 'SKDD_page_content', 20 );
add_action( 'SKDD_page_after', 'SKDD_display_comments', 10 );



// Template builder. See inc/SKDD-template-builder.php.
add_action( 'SKDD_theme_single', 'SKDD_template_single' );
add_action( 'SKDD_theme_archive', 'SKDD_template_archive' );
add_action( 'SKDD_theme_404', 'SKDD_template_404' );