<?php
/**
 * Divi Builder File.
 *
 * @package roxtar
 */

// If plugin - 'Divi Builder' not exist then return.
if ( ! class_exists( 'ET_Builder_Plugin' ) ) {
	return;
}

if ( ! class_exists( 'Roxtar_Divi_Builder' ) ) {
	/**
	 * Main class
	 */
	class Roxtar_Divi_Builder {
		/**
		 * Instance
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function init() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'roxtar_divi_builder_hooks' ) );
			add_filter( 'roxtar_customizer_css', array( $this, 'roxtar_divi_builder_add_custom_css' ) );
		}

		/**
		 * Hooks and filters
		 */
		public function roxtar_divi_builder_hooks() {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'et_divi_builder_template_loop_product_thumbnail', 10 );
		}

		/**
		 * Custom css
		 *
		 * @param string $styles Stylesheet.
		 */
		public function roxtar_divi_builder_add_custom_css( $styles ) {
			$styles .= 'body.et-fb:not(.folded) #view { position: static; }';
			return $styles;
		}
	}
}

Roxtar_Divi_Builder::init();
