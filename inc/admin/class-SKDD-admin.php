<?php
/**
 * SKDD Admin Class
 *
 * @package  SKDD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SKDD_Admin' ) ) :
	/**
	 * The SKDD admin class
	 */
	class SKDD_Admin {

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
			//add_action( 'admin_notices', array( $this, 'SKDD_admin_notice' ) );
			add_action( 'wp_ajax_dismiss_admin_notice', array( $this, 'SKDD_dismiss_admin_notice' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'SKDD_welcome_static' ) );
			add_action( 'admin_body_class', array( $this, 'SKDD_admin_classes' ) );
			add_filter('upload_mimes', array( $this, 'SKDD_mime_types' ) );
		}

		// Allow SVG uploads
		public function SKDD_mime_types( $mimes ) {
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
		}
		  
		/**
		 * Admin body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function SKDD_admin_classes( $classes ) {
			$wp_version = version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ? 'gutenberg-version' : 'old-version';
			$classes   .= " $wp_version";

			return $classes;
		}

		/**
		 * Add admin notice
		 
		public function SKDD_admin_notice() {
			if ( ! current_user_can( 'edit_theme_options' ) ) {
				return;
			}

			// For theme options box.
			if ( is_admin() && ! get_user_meta( get_current_user_id(), 'welcome_box' ) ) {
				?>
				<div class="SKDD-admin-notice SKDD-options-notice notice is-dismissible" data-notice="welcome_box">
					<div class="SKDD-notice-content">
						<div class="SKDD-notice-img">
							<img src="<?php echo esc_url( SKDD_THEME_URI . 'assets/images/logo.svg' ); ?>" alt="<?php esc_attr_e( 'logo', 'SKDD' ); ?>">
						</div>

						<div class="SKDD-notice-text">
							<div class="SKDD-notice-heading"><?php esc_html_e( 'Deze website is gemaakt door SKDD Online Marketing', 'SKDD' ); ?></div>
							<p>
								<?php
								echo wp_kses_post(
									sprintf(
										__( 'Voor meer informatie kijk op onze website of neem contact op. <a href="%1$s">SKDD website</a>.', 'SKDD' ),
										esc_url( admin_url( 'https://SKDD.nl/webdevelopment/' ) )
									)
								);
								?>
							</p>
						</div>
					</div>

					<button type="button" class="notice-dismiss">
						<span class="spinner"></span>
						<span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'SKDD' ); ?></span>
					</button>
				</div>
				<?php
			}
		}
		*/

		/**
		 * Dismiss admin notice
		 */
		public function SKDD_dismiss_admin_notice() {

			// Nonce check.
			check_ajax_referer( 'SKDD_dismiss_admin_notice', 'nonce' );

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
		public function SKDD_welcome_static( $hook ) {
			$is_welcome = false !== strpos( $hook, 'SKDD-welcome' );

			// Dismiss admin notice.
			wp_enqueue_style(
				'SKDD-admin-general',
				SKDD_THEME_URI . 'assets/css/admin/general.css',
				array(),
				SKDD_version()
			);

			// Dismiss admin notice.
			wp_enqueue_script(
				'SKDD-dismiss-admin-notice',
				SKDD_THEME_URI . 'assets/js/admin/dismiss-admin-notice' . SKDD_suffix() . '.js',
				array(),
				SKDD_version(),
				true
			);

			// Add custom block styles
			wp_enqueue_script(
				'SKDD-custom-block-styles',
				SKDD_THEME_URI . 'assets/js/admin/custom-block-styles.js',
				array(),
				SKDD_version(),
				true
			);
			

			wp_localize_script(
				'SKDD-dismiss-admin-notice',
				'SKDD_dismiss_admin_notice',
				array(
					'nonce' => wp_create_nonce( 'SKDD_dismiss_admin_notice' ),
				)
			);

			// Welcome screen style.
			if ( $is_welcome ) {
				wp_enqueue_style(
					'SKDD-welcome-screen',
					SKDD_THEME_URI . 'assets/css/admin/welcome.css',
					array(),
					SKDD_version()
				);
			}

		}

		/**
		 * Customizer settings link
		 */
		public function SKDD_welcome_customizer_settings() {
			$customizer_settings = apply_filters(
				'SKDD_panel_customizer_settings',
				array(
					'upload_logo' => array(
						'icon'     => 'dashicons dashicons-format-image',
						'name'     => __( 'Upload Logo', 'SKDD' ),
						'type'     => 'control',
						'setting'  => 'custom_logo',
						'required' => '',
					),
					'set_color'   => array(
						'icon'     => 'dashicons dashicons-admin-appearance',
						'name'     => __( 'Set Colors', 'SKDD' ),
						'type'     => 'section',
						'setting'  => 'SKDD_color',
						'required' => '',
					),
					'layout'      => array(
						'icon'     => 'dashicons dashicons-layout',
						'name'     => __( 'Layout', 'SKDD' ),
						'type'     => 'panel',
						'setting'  => 'SKDD_layout',
						'required' => '',
					),
					'button'      => array(
						'icon'     => 'dashicons dashicons-admin-customizer',
						'name'     => __( 'Buttons', 'SKDD' ),
						'type'     => 'section',
						'setting'  => 'SKDD_buttons',
						'required' => '',
					),
					'cpt'      => array(
						'icon'     => 'dashicons dashicons-admin-customizer',
						'name'     => __( 'Custom Post Types', 'SKDD' ),
						'type'     => 'section',
						'setting'  => 'SKDD_custom_post_types',
						'required' => '',
					),
					'typo'        => array(
						'icon'     => 'dashicons dashicons-editor-paragraph',
						'name'     => __( 'Typography', 'SKDD' ),
						'type'     => 'panel',
						'setting'  => 'SKDD_typography',
						'required' => '',
					),
					'shop'        => array(
						'icon'     => 'dashicons dashicons-cart',
						'name'     => __( 'Shop', 'SKDD' ),
						'type'     => 'panel',
						'setting'  => 'SKDD_shop',
						'required' => 'woocommerce',
					),
				)
			);

			return $customizer_settings;
		}

	}

	SKDD_Admin::get_instance();

endif;
