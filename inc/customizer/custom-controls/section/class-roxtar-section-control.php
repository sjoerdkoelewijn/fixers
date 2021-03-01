<?php
/**
 * Section control class
 *
 * @package  roxtar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The section control class
 */
class Roxtar_Section_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'roxtar-section';

	/**
	 * The description var
	 *
	 * @var string $description the control description.
	 */
	public $description = '';

	/**
	 * The dependency var
	 *
	 * @var array $description the array dependency.
	 */
	public $dependency = [];

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script(
			'roxtar-section',
			ROXTAR_THEME_URI . 'inc/customizer/custom-controls/section/js/section.js',
			[],
			roxtar_version(),
			true
		);

		wp_enqueue_style(
			'roxtar-section',
			ROXTAR_THEME_URI . 'inc/customizer/custom-controls/section/css/section.css',
			[],
			roxtar_version()
		);
	}

	/**
	 * To Json
	 */
	public function to_json() {
		parent::to_json();
		$this->json['dependency'] = maybe_unserialize( $this->dependency );
	}

	/**
	 * Renter the control
	 */
	public function content_template() {
		?>
		<div class="roxtar-section-control">
			<# if ( data.label ) { #>
			<span class="roxtar-section-control-label">{{ data.label }}</span>
			<# } #>
			<span class="roxtar-section-control-arrow dashicons dashicons-arrow-right-alt2"></span>
		</div>
		<?php
	}
}
