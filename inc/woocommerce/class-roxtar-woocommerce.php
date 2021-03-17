<?php
/**
 * Roxtar WooCommerce Class
 *
 * @package  roxtar
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Roxtar_WooCommerce' ) ) {
	/**
	 * The Roxtar WooCommerce Integration class
	 */
	class Roxtar_WooCommerce {
		/**
		 * Instance
		 *
		 * @var object instance
		 */
		public static $instance;

		/**
		 * Initiator
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
			add_action( 'wp', array( $this, 'roxtar_woocommerce_wp_action' ) );
			add_action( 'init', array( $this, 'roxtar_woocommerce_init_action' ) );
			add_action( 'after_setup_theme', array( $this, 'roxtar_woocommerce_setup' ) );
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
			add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_scripts' ), 200 );
			add_filter( 'body_class', array( $this, 'woocommerce_body_class' ) );

			// GENERAL.			
			add_action( 'init', 'roxtar_detect_clear_cart_submit' );
			add_filter( 'loop_shop_columns', 'roxtar_products_per_row' );
			add_filter( 'loop_shop_per_page', 'roxtar_products_per_page' );
			add_filter( 'woocommerce_cross_sells_total', 'roxtar_change_cross_sells_total' );
			add_filter( 'woocommerce_cross_sells_columns', 'roxtar_change_cross_sells_columns' );
			add_filter( 'woocommerce_show_page_title', 'roxtar_remove_woocommerce_shop_title' );
			add_filter( 'woocommerce_available_variation', 'roxtar_available_variation_gallery', 90, 3 );
			add_action( 'woocommerce_before_shop_loop', 'roxtar_toggle_sidebar_mobile_button', 25 );
			add_filter( 'woocommerce_output_related_products_args', 'roxtar_related_products_args' );
			add_filter( 'woocommerce_pagination_args', 'roxtar_change_woocommerce_arrow_pagination' );
			add_filter( 'woocommerce_add_to_cart_fragments', 'roxtar_content_fragments' );
			add_filter( 'woocommerce_product_loop_start', 'roxtar_woocommerce_loop_start' );
			add_action( 'roxtar_product_loop_item_action_item', 'roxtar_product_loop_item_add_to_cart_icon', 10 );
			add_action( 'roxtar_product_loop_item_action_item', 'roxtar_product_loop_item_wishlist_icon', 30 );
			add_action(	'admin_menu', 'roxtar_customer_service_submenu', 10);
			// Ajax single add to cart.
			add_action( 'wp_ajax_single_add_to_cart', 'roxtar_ajax_single_add_to_cart' );
			add_action( 'wp_ajax_nopriv_single_add_to_cart', 'roxtar_ajax_single_add_to_cart' );
			// Update product quantity in minicart.
			add_action( 'wp_ajax_update_quantity_in_mini_cart', 'roxtar_ajax_update_quantity_in_mini_cart' );
			add_action( 'wp_ajax_nopriv_update_quantity_in_mini_cart', 'roxtar_ajax_update_quantity_in_mini_cart' );
			// Update checkout.
			add_action( 'wp_ajax_update_checkout', 'roxtar_ajax_update_checkout' );
			add_action( 'wp_ajax_nopriv_update_checkout', 'roxtar_ajax_update_checkout' );
			

			add_filter( 'woocommerce_widget_cart_item_quantity', 'roxtar_update_quantity_mini_cart', 10, 3 );

			// replace the default woocommerce js check so it passes validation
			add_filter( 'body_class', function($classes){
				if(in_array("woocommerce-no-js", $classes)) {
					remove_action( 'wp_footer', 'wc_no_js' );
					$classes = array_diff($classes, array('woocommerce-no-js'));
					$classes[] = 'woocommerce-js';
				}
				return array_values($classes);
			},10, 1);
			
			add_filter( 'wp_footer', 'roxtar_woocommerce_no_js' ); 

			// MY ACCOUNT PAGE.
			add_filter( 'woocommerce_my_account_edit_address_title', '__return_empty_string' );

			// SHOP PAGE.
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_wrapper_open', 10 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_print_out_of_stock_label', 15 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_image_wrapper_open', 20 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_change_sale_flash', 23 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_product_loop_item_action', 25 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_link_open', 30 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_hover_image', 40 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_image', 50 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_link_close', 60 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_add_to_cart_on_image', 70 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_product_loop_item_wishlist_icon_bottom', 80 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_image_wrapper_close', 90 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'roxtar_loop_product_content_open', 100 );

			add_action( 'woocommerce_after_shop_loop_item_title', 'roxtar_loop_product_rating', 2 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'roxtar_loop_product_meta_open', 5 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'roxtar_loop_product_price', 10 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'roxtar_loop_product_add_to_cart_button', 15 );

			add_action( 'woocommerce_shop_loop_item_title', 'roxtar_add_template_loop_product_category', 5 );
			add_action( 'woocommerce_shop_loop_item_title', 'roxtar_add_template_loop_product_title', 10 );

			add_action( 'woocommerce_after_shop_loop_item', 'roxtar_loop_product_meta_close', 20 );
			add_action( 'woocommerce_after_shop_loop_item', 'roxtar_loop_product_content_close', 50 );
			add_action( 'woocommerce_after_shop_loop_item', 'roxtar_loop_product_wrapper_close', 100 );

			add_filter( 'woocommerce_subcategory_count_html', '__return_null' );

			// PRODUCT PAGE.
			// Product images box.
			add_action( 'roxtar_product_images_box_end', 'roxtar_change_sale_flash', 10 );
			add_action( 'roxtar_product_images_box_end', 'roxtar_print_out_of_stock_label', 20 );
			add_action( 'roxtar_product_images_box_end', 'roxtar_product_video_button_play', 30 );

			add_action( 'woocommerce_before_single_product_summary', 'roxtar_single_product_gallery_open', 20 );
			add_action( 'woocommerce_before_single_product_summary', 'roxtar_single_product_gallery_image_slide', 30 );
			add_action( 'woocommerce_before_single_product_summary', 'roxtar_single_product_gallery_thumb_slide', 40 );
			add_action( 'woocommerce_before_single_product_summary', 'roxtar_single_product_gallery_close', 50 );
			add_action( 'woocommerce_before_single_product_summary', 'roxtar_single_product_gallery_dependency', 100 );
			add_action( 'woocommerce_before_single_product_summary', 'roxtar_single_product_wrapper_summary_open', 200 );

			add_action( 'woocommerce_after_single_product_summary', 'roxtar_single_product_wrapper_summary_close', 0 );

			// Breadcrumbs
			if (function_exists('rank_math_the_breadcrumbs')) {				
				
				add_action( 'wp', 'custom_rank_math_the_breadcrumbs' );	
				add_action( 'roxtar_page_header_breadcrumb', 'woocommerce_taxonomy_archive_description', 30 );
				add_filter( 'woocommerce_breadcrumb_defaults', 'roxtar_modifided_woocommerce_breadcrumb' );
				add_filter( 'woocommerce_get_breadcrumb', 'roxtar_get_modifided_woocommerce_breadcrumb' );
				

			} else {

				add_action( 'wp', 'roxtar_breadcrumb_for_product_page' );
				add_action( 'roxtar_page_header_breadcrumb', 'woocommerce_taxonomy_archive_description', 30 );
				add_filter( 'woocommerce_breadcrumb_defaults', 'roxtar_modifided_woocommerce_breadcrumb' );
				add_filter( 'woocommerce_get_breadcrumb', 'roxtar_get_modifided_woocommerce_breadcrumb' );

			}
			
			// Archive Page

			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );		


			add_action( 'woocommerce_single_product_summary', 'roxtar_trust_badge_image', 200 );
			add_action( 'template_redirect', 'roxtar_product_recently_viewed', 20 );
			add_action( 'woocommerce_after_single_product', 'roxtar_product_recently_viewed_template', 20 );

			// Modify product quantity.
			add_filter( 'woocommerce_get_stock_html', 'roxtar_modified_quantity_stock', 10, 2 );

			// METABOXS.
			add_action( 'add_meta_boxes', array( $this, 'roxtar_add_product_metaboxes' ) );
			add_action( 'save_post', array( $this, 'roxtar_save_product_metaboxes' ) );


		}

		/**
		 * Sets up theme defaults and registers support for various WooCommerce features.
		 */
		public function roxtar_woocommerce_setup() {
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			add_theme_support(
				'woocommerce',
				apply_filters(
					'roxtar_woocommerce_args',
					array(
						'product_grid' => array(
							'default_columns' => 4,
							'default_rows'    => 3,
							'min_columns'     => 1,
							'max_columns'     => 6,
							'min_rows'        => 1,
						),
					)
				)
			);
		}

		/**
		 * Woocommerce enqueue scripts and styles.
		 */
		public function woocommerce_scripts() {
			$product_id = roxtar_get_product_id();
			$product    = $product_id ? wc_get_product( $product_id ) : false;
			$options    = roxtar_options( false );


			// Main woocommerce js file.
			wp_enqueue_script( 'roxtar-woocommerce' );
			// Quantity minicart.
			wp_localize_script(
				'roxtar-woocommerce',
				'roxtar_woocommerce_general',
				array(
					'ajax_url'            => admin_url( 'admin-ajax.php' ),
					'ajax_nonce'          => wp_create_nonce( 'roxtar_woocommerce_general_nonce' ),
					'ajax_error'          => __( 'Sorry, something went wrong. Please try again!', 'roxtar' ),
					'qty_warning'         => __( 'Please enter a valid quantity for this product', 'roxtar' ),
					'shipping_text'       => __( 'Shipping', 'roxtar' ),
					'shipping_next'       => __( 'Calculated at next step', 'roxtar' ),
					'sticky_top_space'    => $options['shop_single_product_sticky_top_space'],
					'sticky_bottom_space' => $options['shop_single_product_sticky_bottom_space'],
				)
			);

			// Product variations.
			wp_enqueue_script( 'roxtar-product-variation' );

			// Quantity button.
			wp_enqueue_script( 'roxtar-quantity-button' );

			// Sticky sidebar.
			if ( in_array( $options['shop_single_gallery_layout'], array( 'column', 'grid' ), true ) ) {
				wp_enqueue_script( 'sticky-sidebar' );
			}

			// Lightbox.
			wp_enqueue_script( 'lity' );

			// Tiny slider: product images.
			wp_enqueue_script( 'roxtar-product-images' );

			// Easyzoom.
			wp_enqueue_script( 'easyzoom-handle' );

			// Photoswipe.
			wp_enqueue_script( 'photoswipe-init' );

			// Woocommerce sidebar.
			wp_enqueue_script( 'roxtar-woocommerce-sidebar' );

			// Add to cart variation.
			if ( wp_script_is( 'wc-add-to-cart-variation', 'registered' ) && ! wp_script_is( 'wc-add-to-cart-variation', 'enqueued' ) ) {
				wp_enqueue_script( 'wc-add-to-cart-variation' );
			}

			// Multi step checkout.
			if ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && $options['checkout_multi_step'] ) {
				wp_enqueue_script( 'roxtar-multi-step-checkout' );
			}

			// Single add to cart script.
			if ( $options['shop_single_ajax_add_to_cart'] ) {
				wp_enqueue_script( 'roxtar-single-add-to-cart' );
				wp_localize_script(
					'roxtar-single-add-to-cart',
					'roxtar_ajax_single_add_to_cart_data',
					array(
						'ajax_url'   => admin_url( 'admin-ajax.php' ),
						'ajax_error' => __( 'Sorry, something went wrong. Please try again!', 'roxtar' ),
						'ajax_nonce' => wp_create_nonce( 'roxtar_ajax_single_add_to_cart' ),
					)
				);
			}

			// For variable product.
			if ( $product && $product->is_type( 'variable' ) ) {
				wp_localize_script(
					'roxtar-woocommerce',
					'roxtar_woocommerce_variable_product_data',
					array(
						'ajax_url'             => admin_url( 'admin-ajax.php' ),
						// Sale tag.
						'sale_tag_percent'     => $options['shop_page_sale_percent'],
						// Out of stock.
						'out_of_stock_display' => $options['shop_page_out_of_stock_position'],
						'out_of_stock_square'  => $options['shop_page_out_of_stock_square'] ? 'is-square' : '',
						'out_of_stock_text'    => $options['shop_page_out_of_stock_text'],
						/* translators: %s number of product */
						'stock_label'          => __( 'Hurry! only %s left in stock.', 'roxtar' ),
					)
				);
			}
		}

		/**
		 * Add WooCommerce specific classes to the body tag
		 *
		 * @param  array $classes css classes applied to the body tag.
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			$options            = roxtar_options( false );
			$disable_multi_step = roxtar_is_multi_checkout();

			// Product gallery.
			$page_id = roxtar_get_page_id();
			$product = wc_get_product( $page_id );
			$gallery = $product ? $product->get_gallery_image_ids() : false;

			if ( in_array( $options['shop_single_gallery_layout'], array( 'vertical', 'horizontal' ), true ) ) {
				$classes[] = 'has-gallery-slider-layout';
			} else {
				$classes[] = 'has-gallery-list-layout';
			}

			if ( $gallery || is_singular( 'woo_builder' ) ) {
				$classes[] = 'has-gallery-layout-' . $options['shop_single_gallery_layout'];
			}

			// Product meta.
			$sku        = $options['shop_single_skus'];
			$categories = $options['shop_single_categories'];
			$tags       = $options['shop_single_tags'];

			if ( ! $sku ) {
				$classes[] = 'hid-skus';
			}

			if ( ! $categories ) {
				$classes[] = 'hid-categories';
			}

			if ( ! $tags ) {
				$classes[] = 'hid-tags';
			}

			// Ajax single add to cart button.
			if ( $options['shop_single_ajax_add_to_cart'] ) {
				$classes[] = 'ajax-single-add-to-cart';
			}

			// Cart page.
			if ( is_cart() ) {
				$proceed_button = $options['cart_page_sticky_proceed_button'];
				if ( $proceed_button ) {
					$classes[] = 'has-proceed-sticky-button';
				}

				$classes[] = apply_filters( 'roxtar_cart_page_layout_class_name', 'cart-page-' . $options['cart_page_layout'] );
			}

			// Checkout page.
			if ( is_checkout() ) {
				$order_button     = $options['checkout_sticky_place_order_button'];
				$distraction_free = $options['checkout_distraction_free'];
				$multi_step       = $options['checkout_multi_step'];

				if ( $order_button ) {
					$classes[] = 'has-order-sticky-button';
				}

				if ( $distraction_free ) {
					$classes[] = 'has-distraction-free-checkout';
				}

				if ( $multi_step && $disable_multi_step ) {
					$classes[] = 'has-multi-step-checkout';
				}
			}


		

			return array_filter( $classes );
		}

		/**
		 * WP action
		 */
		public function roxtar_woocommerce_wp_action() {
			$options             = roxtar_options( false );
			$multi_step_checkout = roxtar_is_multi_checkout();

			// SHOP PAGE.
			// Result count.
			if ( ! $options['shop_page_result_count'] ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			}

			// Product filter.
			if ( ! $options['shop_page_product_filter'] ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			}

			// SHOP SINGLE.
			// Product tab additional information.
			if ( ! $options['shop_single_additional_information'] ) {
				add_filter( 'woocommerce_product_tabs', 'roxtar_remove_additional_information_tabs', 98 );
			}

			// Related product.
			if ( ! $options['shop_single_related_product'] ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}

			// Multi step checkout. Replace default Page header.
			$is_checkout = is_checkout() && ! is_wc_endpoint_url( 'order-received' ); // Is Checkout page only, not Thank you page.
			if ( $is_checkout && $options['checkout_multi_step'] && $multi_step_checkout ) {
				add_action( 'roxtar_after_header', 'roxtar_multi_step_checkout', 10 );

				add_action( 'woocommerce_checkout_before_customer_details', 'roxtar_multi_checkout_wrapper_start', 10 ); // Wrapper start.

				add_action( 'woocommerce_checkout_before_customer_details', 'roxtar_multi_checkout_first_wrapper_start', 20 ); // First step wrapper start.
				add_action( 'woocommerce_checkout_after_customer_details', 'roxtar_multi_checkout_first_wrapper_end', 10 ); // First step wrapper end.

				add_action( 'woocommerce_checkout_after_customer_details', 'roxtar_multi_checkout_second', 20 ); // Second step.
				add_action( 'woocommerce_checkout_after_customer_details', 'roxtar_multi_checkout_third', 30 ); // Third step.
				add_action( 'woocommerce_checkout_after_customer_details', 'roxtar_multi_checkout_button_action', 40 ); // Button action.

				add_action( 'woocommerce_checkout_after_customer_details', 'roxtar_multi_checkout_wrapper_end', 100 ); // Wrapper end.

				add_action( 'woocommerce_checkout_after_order_review', 'roxtar_checkout_before_order_review', 10 );
			}

			// Add product thumbnail to review order.
			add_filter( 'woocommerce_cart_item_name', 'roxtar_add_product_thumbnail_to_checkout_order', 10, 3 );

			if ( ! is_cart() ) {
				remove_action( 'roxtar_page_header_breadcrumb', 'roxtar_breadcrumb', 10 );
				add_action( 'roxtar_page_header_breadcrumb', 'woocommerce_breadcrumb', 10 );
			}
		}

		/**
		 * Init action
		 */
		public function roxtar_woocommerce_init_action() {
			// Remove default add to wishlist button TI wishlist plugin.
			remove_action( 'woocommerce_after_shop_loop_item', 'tinvwl_view_addto_htmlloop', 10 );

			// Remove wc notice on checkout page, when login error.
			remove_action( 'woocommerce_before_checkout_form_cart_notices', 'woocommerce_output_all_notices', 10 );

			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

			// Shop page.
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			// Single product.
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			remove_action( 'woocommerce_add_to_cart', 'action_woocommerce_add_to_cart', 10 ); 

			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

			add_filter( 'woocommerce_get_price_html', 'custom_template_single_product_weight' );

			add_action( 'woocommerce_single_product_summary', 'custom_template_single_title', 5 );
			
			add_action( 'woocommerce_before_main_content', 'roxtar_before_content', 10 );
			add_action( 'woocommerce_after_main_content', 'roxtar_after_content', 10 );
			add_action( 'roxtar_content_top', 'roxtar_shop_messages', 30 );

			add_action( 'woocommerce_before_shop_loop', 'roxtar_sorting_wrapper', 9 );
			add_action( 'woocommerce_before_shop_loop', 'roxtar_sorting_wrapper_close', 31 );

			add_action( 'woocommerce_single_product_summary', 'roxtar_single_product_tags', 60 );
			
			add_action( 'woocommerce_product_additional_information', 'roxtar_single_product_categories', 200 );

			// Woocommerce sidebar.
			add_action( 'roxtar_theme_footer', 'roxtar_woocommerce_cart_sidebar', 120 );

			// Legacy WooCommerce columns filter.
			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
				add_action( 'woocommerce_before_shop_loop', 'roxtar_product_columns_wrapper', 40 );
				add_action( 'woocommerce_after_shop_loop', 'roxtar_product_columns_wrapper_close', 40 );
			}

			// SHOP SINGLE.
			// Swap position price and rating star.
			add_action( 'woocommerce_single_product_summary', 'custom_template_single_price', 10 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

			add_action( 'woocommerce_single_product_summary', 'custom_template_single_add_to_cart', 30 );

			$options = roxtar_options( false );
			

		}

		/**
		 * Metaboxs
		 */
		public function roxtar_add_product_metaboxes() {
			add_meta_box(
				'roxtar-product-video-metabox',
				__( 'Product video url', 'roxtar' ),
				array( $this, 'roxtar_product_metabox_content' ),
				'product',
				'side'
			);

		}

		/**
		 * Product metabox content
		 *
		 * @param      object $post The post.
		 */
		public function roxtar_product_metabox_content( $post ) {
			// Add a nonce field so we can check for it later.
			wp_nonce_field( basename( __FILE__ ), 'roxtar_product_video_metabox_nonce' );
			$value = get_post_meta( $post->ID, 'roxtar_product_video_metabox', true );
			?>

			<div class="roxtar-metabox-setting">
				<div class="roxtar-metabox-option-content">
					<label for="roxtar-product-video-url" style="margin-top: 10px; display: block;">
						<textarea class="widefat" id="roxtar-product-video-url" name="roxtar_product_video_metabox" rows="4" placeholder="<?php esc_attr_e( 'Enter Youtube or Vimeo video url', 'roxtar' ); ?>" ><?php echo esc_html( $value ); ?></textarea>
					</label>
				</div>
			</div>
			<?php
		}

	
		/**
		 * Save metaboxs
		 *
		 * @param      int $post_id The post identifier.
		 */
		public function roxtar_save_product_metaboxes( $post_id ) {
			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST['roxtar_product_video_metabox_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['roxtar_product_video_metabox_nonce'] ) ), basename( __FILE__ ) ) ) ? true : false;

			// Exits script depending on save status.
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			// Sanitize user input.
			$video = empty( $_POST['roxtar_product_video_metabox'] ) ? '' : sanitize_text_field( wp_unslash( $_POST['roxtar_product_video_metabox'] ) );
			update_post_meta( $post_id, 'roxtar_product_video_metabox', $video );
		}
	}
	Roxtar_WooCommerce::get_instance();
}
