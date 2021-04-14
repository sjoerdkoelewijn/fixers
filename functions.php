<?php
/**
 * SKDD
 *
 * @package SKDD
 */

// Define constants.
define( 'SKDD_VERSION', '1.8.0' );
define( 'SKDD_PRO_MIN_VERSION', '1.4.6' );
define( 'SKDD_THEME_DIR', get_template_directory() . '/' );
define( 'SKDD_THEME_URI', get_template_directory_uri() . '/' );

// SKDD functions, hooks.
require_once SKDD_THEME_DIR . 'inc/SKDD-functions.php';
require_once SKDD_THEME_DIR . 'inc/SKDD-template-hooks.php';
require_once SKDD_THEME_DIR . 'inc/SKDD-template-builder.php';
require_once SKDD_THEME_DIR . 'inc/SKDD-template-functions.php';
require_once SKDD_THEME_DIR . 'inc/class-SKDD-custom-header.php';

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
}

require_once SKDD_THEME_DIR . 'inc/SKDD-howtos.php';


/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 */
