<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package roxtar
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	do_action( 'roxtar_theme_404' );
}

get_footer();
