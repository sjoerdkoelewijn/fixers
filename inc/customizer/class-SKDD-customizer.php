<?php
/**
 * SKDD Customizer Class
 *
 * @package  SKDD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SKDD_Customizer' ) ) :

	/**
	 * The SKDD Customizer class
	 */
	class SKDD_Customizer {

		/**
		 * Setup class.
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'SKDD_customize_register' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'SKDD_customize_controls_scripts' ) );
			add_action( 'customize_controls_print_styles', array( $this, 'SKDD_customize_controls_styles' ) );
		}

		/**
		 * Add script for customize controls
		 */
		public function SKDD_customize_controls_scripts() {
			wp_enqueue_script(
				'SKDD-condition-control',
				SKDD_THEME_URI . 'inc/customizer/custom-controls/conditional/js/condition.js',
				array(),
				SKDD_version(),
				true
			);
		}

		/**
		 * Add style for customize controls
		 */
		public function SKDD_customize_controls_styles() {
			wp_enqueue_style(
				'SKDD-condition-control',
				SKDD_THEME_URI . 'inc/customizer/custom-controls/conditional/css/condition.css',
				array(),
				SKDD_version()
			);
		}

		/**
		 * Returns an array of the desired default SKDD Options
		 *
		 * @return array
		 */
		public static function SKDD_get_SKDD_default_setting_values() {
			$args = array(
				// CONTAINER.
				'header_width'                         	  => 'Large',
				'container_width'                         => 'Large',
				'content_spacing'                         => '20',
				'vertical_spacing'                        => '10',				
				'border_radius'							  => '0',
				// LOGO.
				'logo_mobile'                             => '',
				'logo_width'                              => '',
				'tablet_logo_width'                       => '',
				'mobile_logo_width'                       => '',
				// COLOR.
				'theme_color'                             => '#1346af',
				'secondary_theme_color'                   => '#FFE45E',
				'primary_menu_color'                      => '#2b2b2b',
				'primary_sub_menu_color'                  => '#2b2b2b',
				'heading_color'                           => '#2b2b2b',
				'text_color'                              => '#000000',
				'link_color'                              => '#1346af',
				'hover_color'                             => '#FFE45E',
				'background_color'						  => '#FAF8F2',
				'second_background_color'				  => '#ffffff',
				'offset_color'						  	  => '#efefef',
				// TOPBAR.
				'topbar_display'                          => false,
				'topbar_text_color'                       => '#ffffff',
				'topbar_background_color'                 => '#292f34',
				'topbar_opacity'						  => 100,
				'topbar_height'                           => 0,
				'topbar_left'                             => '',
				'topbar_center'                           => '',
				'topbar_right'                            => '',
				// HEADER.
				'header_layout'                           => 'layout-1',
				'header_background_color'                 => '#ffffff',
				'header_primary_menu'                     => true,
				'header_max_height'                    	  => '100',
				'header_menu_breakpoint'                  => 992,
				'header_search_icon'                      => true,
				'header_widget_area'                      => false,
				'header_wishlist_icon'                    => true,
				'header_search_only_product'              => true,
				'header_account_icon'                     => true,
				'header_shop_cart_icon'                   => true,
				// Header transparent.
				'header_transparent'                      => false,
				'header_transparent_enable_on'            => 'all-devices',
				'header_transparent_disable_archive'      => true,
				'header_transparent_disable_index'        => false,
				'header_transparent_disable_page'         => false,
				'header_transparent_disable_post'         => false,
				'header_transparent_disable_shop'         => false,
				'header_transparent_disable_product'      => false,
				'header_transparent_border_width'         => 0,
				'header_transparent_border_color'         => '#ffffff',
				'header_transparent_box_shadow'           => false,
				'header_transparent_shadow_type'          => 'outset',
				'header_transparent_shadow_x'             => 0,
				'header_transparent_shadow_y'             => 0,
				'header_transparent_shadow_blur'          => 0,
				'header_transparent_shadow_spread'        => 0,
				'header_transparent_shadow_color'         => '#000000',
				'header_transparent_logo'                 => '',
				'header_transparent_menu_color'           => '#ffffff',
				'header_transparent_icon_color'           => '#ffffff',
				'header_transparent_count_background'     => '#000000',
				// PAGE HEADER.
				'page_header_display'                     => false,
				'page_header_title'                       => true,
				'page_header_breadcrumb'                  => true,
				'page_header_text_align'                  => 'justify',
				'page_header_title_color'                 => '#4c4c4c',
				'page_header_breadcrumb_text_color'       => '#606060',
				'page_header_background_image'            => '',
				'page_header_background_image_size'       => 'auto',
				'page_header_background_image_repeat'     => 'repeat',
				'page_header_background_image_position'   => 'center-center',
				'page_header_background_image_attachment' => 'scroll',
				'page_header_padding_top'                 => 50,
				'page_header_padding_bottom'              => 50,
				'page_header_margin_bottom'               => 50,
				// FOOTER.
				'footer_display'                          => true,
				'footer_space'                            => 100,
				'footer_column'                           => 0,
				'footer_background_color'                 => '#eeeeec',
				'footer_heading_color'                    => '#2b2b2b',
				'footer_link_color'                       => '#8f8f8f',
				'footer_text_color'                       => '#8f8f8f',
				'footer_custom_text'                      => SKDD_footer_custom_text(),
				// Scroll To Top.
				'scroll_to_top'                           => true,
				'scroll_to_top_background'                => '#000000',
				'scroll_to_top_color'                     => '#ffffff',
				'scroll_to_top_border_radius'             => 0,
				'scroll_to_top_position'                  => 'right',
				'scroll_to_top_offset_bottom'             => 20,
				'scroll_to_top_on'                        => 'default',
				'scroll_to_top_icon_size'                 => 17,
				// BUTTONS.
				'button_text_color'                       => '#ffffff',
				'button_background_color'                 => '#1346af',
				'button_hover_text_color'                 => '#ffffff',
				'button_hover_background_color'           => '#3a3a3a',
				'buttons_border_radius'                   => 50,
				// BLOG.
				'blog_list_layout'                        => 'list',
				'blog_list_limit_exerpt'                  => 20,
				'blog_list_structure'                     => array( 'image', 'title-meta', 'post-meta' ),
				'blog_list_post_meta'                     => array( 'date', 'author', 'comments' ),
				// BLOG SINGLE.
				'blog_single_structure'                   => array( 'image', 'title-meta', 'post-meta' ),
				'blog_single_post_meta'                   => array( 'date', 'author', 'category', 'comments' ),
				'blog_single_author_box'                  => false,
				'blog_single_related_post'                => true,
				// SHOP.
				'shop_page_product_alignment'             => 'center',
				'shop_page_title'                         => true,
				'shop_page_breadcrumb'                    => true,
				'shop_page_result_count'                  => true,
				'shop_page_product_filter'                => true,
				// Product catalog.
				'products_per_row'                        => 3,
				'tablet_products_per_row'                 => 2,
				'mobile_products_per_row'                 => 1,
				'products_per_page'                       => 12,
				// Product card.
				'shop_page_product_card_border_style'     => 'none',
				'shop_page_product_card_border_width'     => 1,
				'shop_page_product_card_border_color'     => '#cccccc',
				// Product content.
				'shop_page_product_content_equal'         => false,
				'shop_page_product_content_min_height'    => 160,
				'shop_page_product_title'                 => true,
				'shop_page_product_category'              => false,
				'shop_page_product_rating'                => true,
				'shop_page_product_price'                 => true,
				// Product image.
				'shop_page_product_image_hover'           => 'swap',
				'shop_page_product_image_border_style'    => 'none',
				'shop_page_product_image_border_width'    => 1,
				'shop_page_product_image_border_color'    => '#cccccc',
				'shop_page_product_image_equal_height'    => false,
				'shop_page_product_image_height'          => 300,
				// Add to cart button.
				'shop_page_add_to_cart_button_position'   => 'bottom',
				'shop_product_add_to_cart_icon'           => true,
				'shop_page_button_cart_background'        => '#333333',
				'shop_page_button_cart_color'             => '#ffffff',
				'shop_page_button_background_hover'       => '#000000',
				'shop_page_button_color_hover'            => '#ffffff',
				'shop_page_button_border_radius'          => '10',
				// Wishlist.
				'shop_page_wishlist_support_plugin'       => 'ti',
				'shop_page_wishlist_position'             => 'top-right',
				// Sale tag.
				'shop_page_sale_tag_position'             => 'left',
				'shop_page_sale_percent'                  => true,
				'shop_page_sale_text'                     => __( 'Sale!', 'SKDD' ),
				'shop_page_sale_border_radius'            => 0,
				'shop_page_sale_square'                   => false,
				'shop_page_sale_size'                     => 40,
				'shop_page_sale_color'                    => '#ffffff',
				'shop_page_sale_bg_color'                 => '#1346af',
				// Out of stock label.
				'shop_page_out_of_stock_position'         => 'left',
				'shop_page_out_of_stock_text'             => __( 'Out Of Stock', 'SKDD' ),
				'shop_page_out_of_stock_border_radius'    => 0,
				'shop_page_out_of_stock_square'           => false,
				'shop_page_out_of_stock_size'             => 40,
				'shop_page_out_of_stock_color'            => '#ffffff',
				'shop_page_out_of_stock_bg_color'         => '#818486',
				// SHOP SINGLE.
				'shop_single_breadcrumb'                  => true,
				'shop_single_product_navigation'          => true,
				'shop_single_ajax_add_to_cart'            => true,
				'shop_single_stock_label'                 => true,
				'shop_single_stock_product_limit'         => 0,
				'shop_single_loading_bar'                 => true,
				'shop_single_additional_information'      => true,
				'shop_single_content_background'          => '#f3f3f3',
				'shop_single_trust_badge_image'           => '',
				'shop_single_gallery_layout'              => 'vertical',
				'shop_single_product_image_height'        => '550',
				'shop_single_image_zoom'                  => true,
				'shop_single_image_lightbox'              => true,
				'shop_single_product_sticky_top_space'    => 50,
				'shop_single_product_sticky_bottom_space' => 50,				
				// Meta.
				'shop_single_skus'                        => true,
				'shop_single_categories'                  => true,
				'shop_single_tags'                        => true,
				// Related.
				'shop_single_related_product'             => true,
				'shop_single_product_related_total'       => 4,
				'shop_single_product_related_columns'     => 4,
				// Recently view.
				'shop_single_product_recently_viewed'     => false,
				'shop_single_recently_viewed_title'       => __( 'Recently Viewed Products', 'SKDD' ),
				'shop_single_recently_viewed_count'       => 4,
				// Single Product Add To Cart.
				'shop_single_button_cart_background'      => '#000000',
				'shop_single_button_cart_color'           => '#ffffff',
				'shop_single_button_background_hover'     => '#000000',
				'shop_single_button_color_hover'          => '#ffffff',
				'shop_single_button_border_radius'        => '50',
				// CART PAGE.
				'cart_page_layout'                        => 'layout-2',
				'cart_page_sticky_proceed_button'         => true,
				// WHOLESALE
				'only_show_price_when_logged_in'          => false,
				'single_product_weight'					  => false,
				// CHECKOUT PAGE.
				'checkout_distraction_free'               => false,
				'checkout_multi_step'                     => false,
				'checkout_sticky_place_order_button'      => true,
				// SIDEBAR.
				'sidebar_default'                         => is_rtl() ? 'left' : 'right',
				'sidebar_page'                            => 'full',
				'sidebar_blog'                            => 'default',
				'sidebar_blog_single'                     => 'default',
				'sidebar_shop'                            => 'default',
				'sidebar_shop_single'                     => 'full',
				'sidebar_width'                           => 20,
				// 404.
				'error_404_image'                         => '',
				'error_404_text'                          => __( 'Oops! The page you are looking for cannot be found.', 'SKDD' ),
			);

			return apply_filters( 'SKDD_setting_default_values', $args );
		}

		/**
		 * Get all of the SKDD theme option.
		 *
		 * @return array $SKDD_options The SKDD Theme Options.
		 */
		public function SKDD_get_SKDD_options() {
			$SKDD_options = wp_parse_args(
				get_option( 'SKDD_setting', array() ),
				self::SKDD_get_SKDD_default_setting_values()
			);

			return apply_filters( 'SKDD_options', $SKDD_options );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function SKDD_customize_register( $wp_customize ) {

			// Custom default section, panel.
			require_once SKDD_THEME_DIR . 'inc/customizer/override-defaults.php';

			// Add customizer custom controls.
			$customizer_controls = glob( SKDD_THEME_DIR . 'inc/customizer/custom-controls/**/*.php' );
			foreach ( $customizer_controls as $file ) {
				if ( file_exists( $file ) ) {
					require_once $file;
				}
			}

			// Register section & panel.
			require_once SKDD_THEME_DIR . 'inc/customizer/register-sections.php';

			// Add customizer sections.
			$customizer_sections = glob( SKDD_THEME_DIR . 'inc/customizer/sections/**/*.php' );
			foreach ( $customizer_sections as $file ) {
				if ( file_exists( $file ) ) {
					require_once $file;
				}
			}

			// Register Control Type - Register for controls has content_template function.
			if ( method_exists( $wp_customize, 'register_control_type' ) ) {
				$wp_customize->register_control_type( 'SKDD_Section_Control' );
				$wp_customize->register_control_type( 'SKDD_Color_Control' );
				$wp_customize->register_control_type( 'SKDD_Typography_Control' );
				$wp_customize->register_control_type( 'SKDD_Range_Slider_Control' );
				$wp_customize->register_control_type( 'SKDD_Sortable_Control' );
			}


		}
	}

endif;

return new SKDD_Customizer();
