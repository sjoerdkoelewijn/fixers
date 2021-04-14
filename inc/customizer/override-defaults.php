<?php
/**
 * Override default customizer panels, sections, settings or controls.
 *
 * @package     SKDD
 */

// Move default background color setting to color section.
//$wp_customize->get_control( 'background_color' )->section  = 'SKDD_color';
//$wp_customize->get_control( 'background_color' )->priority = 1;

// Change background image section title & priority.
//$wp_customize->get_section( 'background_image' )->panel    = 'SKDD_layout';
//$wp_customize->get_section( 'background_image' )->title    = __( 'Site Container', 'SKDD' );
//$wp_customize->get_section( 'background_image' )->priority = 10;

//$wp_customize->get_control( 'background_image' )->priority = 6;

// Remove description on Site Icon.
$wp_customize->get_control( 'site_icon' )->description = '';

$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

// Chage Woocommerce panel priority, after Typography panel.
if ( class_exists( 'woocommerce' ) ) {
	$wp_customize->get_panel( 'woocommerce' )->priority = 40;
}
