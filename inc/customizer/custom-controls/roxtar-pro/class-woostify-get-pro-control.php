<?php
/**
 * SKDD get pro control
 *
 * @package SKDD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'SKDD_Get_Pro_Control' ) ) {
	/**
	 * Create our in-section pro controls.
	 */
	class SKDD_Get_Pro_Control extends WP_Customize_Control {
		/**
		 * Description
		 *
		 * @var $description
		 */
		public $description = '';

		/**
		 * Url
		 *
		 * @var $url
		 */
		public $url         = '';

		/**
		 * Type
		 *
		 * @var $type
		 */
		public $type        = 'addon';

		/**
		 * Laebl
		 *
		 * @var $label
		 */
		public $label       = '';

		/**
		 * Add JS/CSS for our controls
		 */
		public function enqueue() {
			wp_enqueue_style(
				'SKDD-get-pro-control',
				SKDD_THEME_URI . 'inc/customizer/custom-controls/SKDD-pro/css/get-pro-control.css',
				array(),
				SKDD_version()
			);
		}

		/**
		 * To Json
		 */
		public function to_json() {
			parent::to_json();
			$this->json['url'] = esc_url( $this->url );
		}

		/**
		 * Render template
		 */
		public function content_template() {
			?>
			<p class="description">{{{ data.description }}}</p>
			<span class="get-addon">
				<a href="{{{ data.url }}}" class="button button-primary" target="_blank">{{ data.label }}</a>
			</span>
			<?php
		}
	}
}
