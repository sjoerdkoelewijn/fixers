<?php
/**
 * Section control class
 *
 * @package  SKDD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The section control class
 */
class SKDD_Section_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'SKDD-section';

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
			'SKDD-section',
			SKDD_THEME_URI . 'inc/customizer/custom-controls/section/js/section.js',
			[],
			SKDD_version(),
			true
		);

		wp_enqueue_style(
			'SKDD-section',
			SKDD_THEME_URI . 'inc/customizer/custom-controls/section/css/section.css',
			[],
			SKDD_version()
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
		<div class="SKDD-section-control">
			<# if ( data.label ) { #>
			<span class="SKDD-section-control-label">{{ data.label }}</span>
			<# } #>
			<span class="SKDD-section-control-arrow dashicons dashicons-arrow-right-alt2"></span>
		</div>
		<?php
	}
}
