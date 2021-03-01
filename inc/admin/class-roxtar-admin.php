<?php
/**
 * Roxtar Admin Class
 *
 * @package  roxtar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Roxtar_Admin' ) ) :
	/**
	 * The Roxtar admin class
	 */
	class Roxtar_Admin {

		/**
		 * Instance
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Setup class.
		 */
		public function __construct() {
			add_action( 'admin_notices', array( $this, 'roxtar_admin_notice' ) );
			add_action( 'wp_ajax_dismiss_admin_notice', array( $this, 'roxtar_dismiss_admin_notice' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'roxtar_welcome_static' ) );
			add_action( 'admin_body_class', array( $this, 'roxtar_admin_classes' ) );
			add_filter('upload_mimes', array( $this, 'roxtar_mime_types' ) );
		}

		// Allow SVG uploads
		public function roxtar_mime_types( $mimes ) {
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
		}
		  

		/**
		 * Admin body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function roxtar_admin_classes( $classes ) {
			$wp_version = version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ? 'gutenberg-version' : 'old-version';
			$classes   .= " $wp_version";

			return $classes;
		}

		/**
		 * Add admin notice
		 */
		public function roxtar_admin_notice() {
			if ( ! current_user_can( 'edit_theme_options' ) ) {
				return;
			}

			// For theme options box.
			if ( is_admin() && ! get_user_meta( get_current_user_id(), 'welcome_box' ) ) {
				?>
				<div class="roxtar-admin-notice roxtar-options-notice notice is-dismissible" data-notice="welcome_box">
					<div class="roxtar-notice-content">
						<div class="roxtar-notice-img">
							<img src="<?php echo esc_url( ROXTAR_THEME_URI . 'assets/images/logo.svg' ); ?>" alt="<?php esc_attr_e( 'logo', 'roxtar' ); ?>">
						</div>

						<div class="roxtar-notice-text">
							<div class="roxtar-notice-heading"><?php esc_html_e( 'Deze website is gemaakt door ROXTAR Online Marketing', 'roxtar' ); ?></div>
							<p>
								<?php
								echo wp_kses_post(
									sprintf(
										/* translators: Theme options */
										__( 'Voor meer informatie kijk op onze website of neem contact op. <a href="%1$s">ROXTAR website</a>.', 'roxtar' ),
										esc_url( admin_url( 'https://roxtar.nl/webdevelopment/' ) )
									)
								);
								?>
							</p>
						</div>
					</div>

					<button type="button" class="notice-dismiss">
						<span class="spinner"></span>
						<span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'roxtar' ); ?></span>
					</button>
				</div>
				<?php
			}
		}

		/**
		 * Dismiss admin notice
		 */
		public function roxtar_dismiss_admin_notice() {

			// Nonce check.
			check_ajax_referer( 'roxtar_dismiss_admin_notice', 'nonce' );

			// Bail if user can't edit theme options.
			if ( ! current_user_can( 'edit_theme_options' ) ) {
				wp_send_json_error();
			}

			$notice = isset( $_POST['notice'] ) ? sanitize_text_field( wp_unslash( $_POST['notice'] ) ) : '';

			if ( $notice ) {
				update_user_meta( get_current_user_id(), $notice, true );
				wp_send_json_success();
			}

			wp_send_json_error();
		}

		/**
		 * Load welcome screen script and css
		 *
		 * @param  obj $hook Hooks.
		 */
		public function roxtar_welcome_static( $hook ) {
			$is_welcome = false !== strpos( $hook, 'roxtar-welcome' );

			// Dismiss admin notice.
			wp_enqueue_style(
				'roxtar-admin-general',
				ROXTAR_THEME_URI . 'assets/css/admin/general.css',
				array(),
				roxtar_version()
			);

			// Dismiss admin notice.
			wp_enqueue_script(
				'roxtar-dismiss-admin-notice',
				ROXTAR_THEME_URI . 'assets/js/admin/dismiss-admin-notice' . roxtar_suffix() . '.js',
				array(),
				roxtar_version(),
				true
			);

			wp_localize_script(
				'roxtar-dismiss-admin-notice',
				'roxtar_dismiss_admin_notice',
				array(
					'nonce' => wp_create_nonce( 'roxtar_dismiss_admin_notice' ),
				)
			);

			// Welcome screen style.
			if ( $is_welcome ) {
				wp_enqueue_style(
					'roxtar-welcome-screen',
					ROXTAR_THEME_URI . 'assets/css/admin/welcome.css',
					array(),
					roxtar_version()
				);
			}

			// Install plugin import demo.
			wp_enqueue_script(
				'roxtar-install-demo',
				ROXTAR_THEME_URI . 'assets/js/admin/install-demo' . roxtar_suffix() . '.js',
				array( 'updates' ),
				roxtar_version(),
				true
			);
		}



		/**
		 * Customizer settings link
		 */
		public function roxtar_welcome_customizer_settings() {
			$customizer_settings = apply_filters(
				'roxtar_panel_customizer_settings',
				array(
					'upload_logo' => array(
						'icon'     => 'dashicons dashicons-format-image',
						'name'     => __( 'Upload Logo', 'roxtar' ),
						'type'     => 'control',
						'setting'  => 'custom_logo',
						'required' => '',
					),
					'set_color'   => array(
						'icon'     => 'dashicons dashicons-admin-appearance',
						'name'     => __( 'Set Colors', 'roxtar' ),
						'type'     => 'section',
						'setting'  => 'roxtar_color',
						'required' => '',
					),
					'layout'      => array(
						'icon'     => 'dashicons dashicons-layout',
						'name'     => __( 'Layout', 'roxtar' ),
						'type'     => 'panel',
						'setting'  => 'roxtar_layout',
						'required' => '',
					),
					'button'      => array(
						'icon'     => 'dashicons dashicons-admin-customizer',
						'name'     => __( 'Buttons', 'roxtar' ),
						'type'     => 'section',
						'setting'  => 'roxtar_buttons',
						'required' => '',
					),
					'typo'        => array(
						'icon'     => 'dashicons dashicons-editor-paragraph',
						'name'     => __( 'Typography', 'roxtar' ),
						'type'     => 'panel',
						'setting'  => 'roxtar_typography',
						'required' => '',
					),
					'shop'        => array(
						'icon'     => 'dashicons dashicons-cart',
						'name'     => __( 'Shop', 'roxtar' ),
						'type'     => 'panel',
						'setting'  => 'roxtar_shop',
						'required' => 'woocommerce',
					),
				)
			);

			return $customizer_settings;
		}

	}

	Roxtar_Admin::get_instance();

endif;
