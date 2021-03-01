<?php
/**
 * Roxtar_Color_Control
 *
 * @package roxtar
 */

/**
 * Customize Alpha Color Control class.
 */
class Roxtar_Color_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'roxtar-color';

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $suffix = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['value']  = $this->value();
		$this->json['link']   = $this->get_link();
		$this->json['id']     = $this->id;
		$this->json['label']  = esc_html( $this->label );
		$this->json['suffix'] = $this->suffix;

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		$uri = ROXTAR_THEME_URI . 'inc/customizer/custom-controls/alpha-color-picker/';

		wp_enqueue_style(
			'roxtar-alpha-color',
			$uri . 'css/alpha-color-picker.css',
			array(),
			roxtar_version()
		);

		wp_enqueue_script(
			'roxtar-alpha-color',
			$uri . 'js/alpha-color-picker.js',
			array( 'jquery', 'wp-color-picker' ),
			roxtar_version(),
			true
		);

		wp_enqueue_script(
			'roxtar-customizer-color-control',
			$uri . 'js/roxtar-color-control.js',
			array( 'roxtar-alpha-color' ),
			roxtar_version(),
			true
		);

		wp_localize_script(
			'roxtar-alpha-color',
			'roxtar_customizer_color_control',
			array(
				'clear'            => esc_html__( 'Clear', 'roxtar' ),
				'clearAriaLabel'   => esc_html__( 'Clear color', 'roxtar' ),
				'defaultAriaLabel' => esc_html__( 'Select default color', 'roxtar' ),
				'defaultLabel'     => esc_html__( 'Color value', 'roxtar' ),
				'defaultString'    => esc_html__( 'Default', 'roxtar' ),
				'pick'             => esc_html__( 'Select Color', 'roxtar' ),
			)
		);
	}

	/**
	 * Render a JS template for the content of the color picker control.
	 */
	public function content_template() {
		?>

		<#
		var defaultValue = '#RRGGBB', defaultValueAttr = '';
		if ( data.default ) {
			defaultValue     = data.default;
			defaultValueAttr = ' data-default-color=' + data.default; // Quotes added automatically.
		}

		if ( data.label ) {
		#>
			<label>
				<span class="customize-control-title">{{{ data.label }}}</span>
			</label>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<input class="roxtar-color-picker-alpha color-picker-hex" type="text" maxlength="7" data-alpha="true" placeholder="{{ defaultValue }}" {{ defaultValueAttr }} value="{{data.value}}" />
		</div>

		<?php
	}
}
