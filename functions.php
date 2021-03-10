<?php
/**
 * Roxtar
 *
 * @package roxtar
 */

// Define constants.
define( 'ROXTAR_VERSION', '1.8.0' );
define( 'ROXTAR_PRO_MIN_VERSION', '1.4.6' );
define( 'ROXTAR_THEME_DIR', get_template_directory() . '/' );
define( 'ROXTAR_THEME_URI', get_template_directory_uri() . '/' );

// Roxtar functions, hooks.
require_once ROXTAR_THEME_DIR . 'inc/roxtar-functions.php';
require_once ROXTAR_THEME_DIR . 'inc/roxtar-template-hooks.php';
require_once ROXTAR_THEME_DIR . 'inc/roxtar-template-builder.php';
require_once ROXTAR_THEME_DIR . 'inc/roxtar-template-functions.php';

// Roxtar generate css.
require_once ROXTAR_THEME_DIR . 'inc/customizer/class-roxtar-fonts-helpers.php';
require_once ROXTAR_THEME_DIR . 'inc/customizer/class-roxtar-get-css.php';

// Roxtar customizer.
require_once ROXTAR_THEME_DIR . 'inc/class-roxtar.php';
require_once ROXTAR_THEME_DIR . 'inc/customizer/class-roxtar-customizer.php';

// Roxtar woocommerce.
if ( roxtar_is_woocommerce_activated() ) {
	require_once ROXTAR_THEME_DIR . 'inc/woocommerce/class-roxtar-woocommerce.php';
	require_once ROXTAR_THEME_DIR . 'inc/woocommerce/class-roxtar-adjacent-products.php';
	require_once ROXTAR_THEME_DIR . 'inc/woocommerce/roxtar-woocommerce-template-functions.php';
	require_once ROXTAR_THEME_DIR . 'inc/woocommerce/roxtar-woocommerce-archive-product-functions.php';
	require_once ROXTAR_THEME_DIR . 'inc/woocommerce/roxtar-woocommerce-single-product-functions.php';
	
}

// Roxtar admin.
if ( is_admin() ) {
	require_once ROXTAR_THEME_DIR . 'inc/admin/class-roxtar-admin.php';
	require_once ROXTAR_THEME_DIR . 'inc/admin/class-roxtar-meta-boxes.php';
}

require_once ROXTAR_THEME_DIR . 'inc/roxtar-howtos.php';


/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 */
