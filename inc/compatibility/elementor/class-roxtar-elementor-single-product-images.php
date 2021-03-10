<?php
/**
 * Elementor Single Product Images
 *
 * @package Roxtar Pro
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class
 */
class Roxtar_Elementor_Single_Product_Images extends Widget_Base {
	/**
	 * Category
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Name
	 */
	public function get_name() {
		return 'roxtar-default-product-images';
	}

	/**
	 * Gets the title.
	 */
	public function get_title() {
		return __( 'Roxtar - Default Product Images', 'roxtar' );
	}

	/**
	 * Gets the icon.
	 */
	public function get_icon() {
		return 'eicon-product-images';
	}

	/**
	 * Gets the keywords.
	 */
	public function get_keywords() {
		return array( 'roxtar', 'woocommerce', 'shop', 'store', 'image', 'product', 'gallery', 'lightbox' );
	}


	/**
	 * Controls
	 */
	protected function _register_controls() { // phpcs:ignore
		$this->start_controls_section(
			'general',
			array(
				'label' => __( 'General', 'roxtar' ),
			)
		);

		$this->add_control(
			'roxtar_style_warning',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Default single product image', 'roxtar' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render
	 */
	public function render() {
		$product_id = roxtar_get_product_id();
		$product    = wc_get_product( $product_id );

		if ( empty( $product ) ) {
			return;
		}

		$GLOBALS['product'] = $product;

		woocommerce_show_product_sale_flash();
		woocommerce_show_product_images();

		unset( $GLOBALS['product'] );
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Roxtar_Elementor_Single_Product_Images() );
