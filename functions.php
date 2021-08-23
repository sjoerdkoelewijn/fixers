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
require_once SKDD_THEME_DIR . 'inc/skdd-functions.php';
require_once SKDD_THEME_DIR . 'inc/skdd-template-hooks.php';
require_once SKDD_THEME_DIR . 'inc/skdd-template-builder.php';
require_once SKDD_THEME_DIR . 'inc/skdd-template-functions.php';
require_once SKDD_THEME_DIR . 'inc/class-skdd-custom-header.php';

define( 'SKDD_VERSION', SKDD_get_current_git_commit() );

// SKDD generate css.
require_once SKDD_THEME_DIR . 'inc/customizer/class-skdd-fonts-helpers.php';
require_once SKDD_THEME_DIR . 'inc/customizer/class-skdd-get-css.php';

// SKDD customizer.
require_once SKDD_THEME_DIR . 'inc/class-SKDD.php';
require_once SKDD_THEME_DIR . 'inc/customizer/class-skdd-customizer.php';

// SKDD woocommerce.
if ( SKDD_is_woocommerce_activated() ) {
	require_once SKDD_THEME_DIR . 'inc/woocommerce/class-skdd-woocommerce.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/class-skdd-adjacent-products.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/skdd-woocommerce-template-functions.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/skdd-woocommerce-archive-product-functions.php';
	require_once SKDD_THEME_DIR . 'inc/woocommerce/skdd-woocommerce-single-product-functions.php';	
}

// SKDD admin.
if ( is_admin() ) {
	require_once SKDD_THEME_DIR . 'inc/admin/class-skdd-admin.php';
	require_once SKDD_THEME_DIR . 'inc/admin/class-skdd-meta-boxes.php';
	require_once SKDD_THEME_DIR . 'inc/admin/skdd-admin-menu-order.php';
	//require_once SKDD_THEME_DIR . 'inc/admin/skdd-dashboard-widgets.php';
	//require_once SKDD_THEME_DIR . 'inc/admin/skdd-require-featured-image.php';
	require_once SKDD_THEME_DIR . 'inc/admin/skdd-menu-checkbox.php'; // Add custom checkboxes to the menu items
}

require_once SKDD_THEME_DIR . 'inc/admin/skdd-custom-login.php';

// require_once SKDD_THEME_DIR . 'inc/skdd-howtos.php';


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
//require_once SKDD_THEME_DIR . 'inc/skdd-image-placeholder.php';	