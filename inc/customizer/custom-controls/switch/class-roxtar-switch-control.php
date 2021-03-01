<?php
/**
 * Switch for Customizer.
 *
 * @package roxtar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Create a range slider control.
 * This control allows you to add responsive settings.
 */
class Roxtar_Switch_Control extends WP_Customize_Control {

	/**
	 * Declare the control type.
	 *
	 * @var string
	 */
	public $type = 'switch';

	/**
	 * Enqueue scripts and styles for the custom control.
	 */
	public function enqueue() {
		wp_enqueue_style(
			'roxtar-switch-control',
			ROXTAR_THEME_URI . 'inc/customizer/custom-controls/switch/css/switch.css',
			array(),
			roxtar_version()
		);
	}

	/**
	 * Render the control to be displayed in the Customizer.
	 */
	public function render_content() {
		$name    = '_customize-switch-' . $this->id;
		$id      = $this->id;
		$label   = $this->label;
		$value   = false == $this->value() ? 0 : 1;
		$desc    = $this->description;
		?>

		<div class="roxtar-switch-customize-control">
			<?php if ( ! empty( $label ) ) { ?>
				<span class="customize-control-title">
					<?php echo esc_html( $label ); ?>
				</span>
			<?php } ?>

			<div class="roxtar-switch-toggle">
				<input
					id="<?php echo esc_attr( $id ); ?>"
					type="checkbox"
					name="<?php echo esc_attr( $name ); ?>"
					class="roxtar-switch-control switch-control"
					value="<?php echo esc_attr( $value ); ?>"
					<?php
						$this->link();
						checked( $value );
					?>
					/>

				<label for="<?php echo esc_attr( $id ); ?>" class="switch-control-label">
					<span class="on-off-label"></span>
				</label>
			</div>

			<?php if ( ! empty( $desc ) ) { ?>
				<span class="description customize-control-description"><?php echo esc_html( $desc ); ?></span>
			<?php } ?>
		</div>

		<?php
	}
}

