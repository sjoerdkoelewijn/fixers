<?php
/**
 * SKDD
 *
 * @package SKDD
 */

// Define constants.
define( 'SKDD_THEME_DIR', get_template_directory() . '/' );
define( 'SKDD_THEME_URI', get_template_directory_uri() . '/' );

// SKDD functions, hooks.
require_once SKDD_THEME_DIR . 'inc/SKDD-functions.php';
require_once SKDD_THEME_DIR . 'inc/SKDD-template-hooks.php';
require_once SKDD_THEME_DIR . 'inc/SKDD-template-builder.php';
require_once SKDD_THEME_DIR . 'inc/SKDD-template-functions.php';
require_once SKDD_THEME_DIR . 'inc/class-SKDD-custom-header.php';

define( 'SKDD_VERSION', wp_get_theme()->get('Version') );
//define( 'SKDD_VERSION', SKDD_get_current_git_commit() );

// SKDD generate css.
require_once SKDD_THEME_DIR . 'inc/customizer/class-SKDD-fonts-helpers.php';
require_once SKDD_THEME_DIR . 'inc/customizer/class-SKDD-get-css.php';

// SKDD customizer.
require_once SKDD_THEME_DIR . 'inc/class-SKDD.php';
require_once SKDD_THEME_DIR . 'inc/customizer/class-SKDD-customizer.php';

// SKDD woocommerce.
if ( SKDD_is_woocommerce_activated() ) {
	require_once SKDD_THEME_DIR . 'inc/woocommerce/class-SKDD-woocommerce.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/class-SKDD-adjacent-products.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/SKDD-woocommerce-template-functions.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/SKDD-woocommerce-archive-product-functions.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/SKDD-woocommerce-single-product-functions.php';	
}

// SKDD admin.
if ( is_admin() ) {
	require_once SKDD_THEME_DIR . 'inc/admin/class-SKDD-admin.php';
	require_once SKDD_THEME_DIR . 'inc/admin/class-SKDD-meta-boxes.php';
	require_once SKDD_THEME_DIR . 'inc/admin/SKDD-admin-menu-order.php';
	//require_once SKDD_THEME_DIR . 'inc/admin/SKDD-dashboard-widgets.php';
	//require_once SKDD_THEME_DIR . 'inc/admin/SKDD-require-featured-image.php';
	require_once SKDD_THEME_DIR . 'inc/admin/SKDD-menu-checkbox.php'; // Add custom checkboxes to the menu items
}

require_once SKDD_THEME_DIR . 'inc/admin/SKDD-custom-login.php';

// require_once SKDD_THEME_DIR . 'inc/SKDD-howtos.php';


$options = SKDD_options( false );

// Add Premade Custom Post Types

if ( $options['cpt_portfolio_display'] ) {
	require_once SKDD_THEME_DIR . 'inc/cpt/portfolio.php';		
}

if ( $options['cpt_services_display'] ) {
	require_once SKDD_THEME_DIR . 'inc/cpt/services.php';		
}

if ( $options['cpt_knowledge_display'] ) {
	require_once SKDD_THEME_DIR . 'inc/cpt/knowledge.php';		
}

if ( $options['cpt_team_display'] ) {
	require_once SKDD_THEME_DIR . 'inc/cpt/team.php';		
}

if ( $options['cpt_portfolio_display'] || $options['cpt_knowledge_display'] ) {
	require_once SKDD_THEME_DIR . 'inc/cpt/custom-url.php';	
}


// Add knowledgebase shortcut
require_once SKDD_THEME_DIR . 'inc/shortcodes/knowledge-base.php';	


// low quality image placeholder
//require_once SKDD_THEME_DIR . 'inc/SKDD-image-placeholder.php';	