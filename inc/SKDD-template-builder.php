<?php
/**
 * Theme Builder
 *
 * @package SKDD
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'SKDD_GTM_NoJsCode' ) ) {
	/**
	 * Header template
	 */
	function SKDD_GTM_NoJsCode() {
		if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { 
			gtm4wp_the_gtm_tag(); 
		} 
	}
}

if ( ! function_exists( 'SKDD_template_header' ) ) {
	/**
	 * Header template
	 */
	function SKDD_template_header() {
		get_template_part( 'template-parts/header' );
	}
}

if ( ! function_exists( 'SKDD_template_footer' ) ) {
	/**
	 * Footer template
	 */
	function SKDD_template_footer() {
		get_template_part( 'template-parts/footer' );
	}
}

if ( ! function_exists( 'SKDD_template_single' ) ) {
	/**
	 * Single template
	 */
	function SKDD_template_single() {
		get_template_part( 'template-parts/single' );
	}
}

if ( ! function_exists( 'SKDD_template_archive' ) ) {
	/**
	 * Archive template
	 */
	function SKDD_template_archive() {
		get_template_part( 'template-parts/archive' );
	}
}

if ( ! function_exists( 'SKDD_template_404' ) ) {
	/**
	 * 404 template
	 */
	function SKDD_template_404() {
		get_template_part( 'template-parts/404' );
	}
}
