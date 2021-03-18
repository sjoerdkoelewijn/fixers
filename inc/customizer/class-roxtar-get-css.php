<?php
/**
 * Roxtar Get CSS
 *
 * @package  roxtar
 */

/**
 * The Roxtar Get CSS class
 */
class Roxtar_Get_CSS {
	/**
	 * Wp enqueue scripts
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'roxtar_add_customizer_css' ), 130 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'roxtar_guten_block_editor_assets' ) );
	}

	/**
	 * Get Customizer css.
	 *
	 * @see get_roxtar_theme_mods()
	 * @return array $styles the css
	 */
	public function roxtar_get_css() {

		// Get all theme option value.
		$options = roxtar_options( false );

		// GENERATE CSS.
		// Remove outline select on Firefox.
		$styles = '
			select:-moz-focusring{
				text-shadow: 0 0 0 ' . esc_attr( $options['text_color'] ) . ';
			}
		';

		// Container.
		$styles .= '

			:root {
				--body-font-size:'. esc_attr( ($options['body_font_size']) / 10 ) . 'rem' .';

				--body-font-family:' . esc_attr( $options['body_font_family'] ) . ';
				--body-font-weight:' . esc_attr( $options['body_font_weight'] ) . ';
				--body-line-height:'. esc_attr( ($options['body_line_height']) / 10 ) . 'rem' .';
				--body-font-transform:' . esc_attr( $options['body_font_transform'] ) . ';
				--body-text-color:' . esc_attr( $options['text_color'] ) . ';

				--heading-font-family:' . esc_attr( $options['heading_font_family'] ) . ';
				--heading-font-weight:' . esc_attr( $options['heading_font_weight'] ) . ';
				--heading-line-height:'. esc_attr( ($options['heading_line_height']) / 10 ) . 'rem' .';				
				--heading-font-transform:' . esc_attr( $options['heading_font_transform'] ) . ';
				--heading-text-color:' . esc_attr( $options['heading_color'] ) . ';				

				--header-size-1: '. esc_attr( ($options['heading_h1_font_size']) / 10 ) . 'rem' .';
				--header-size-2: '. esc_attr( ($options['heading_h2_font_size']) / 10) . 'rem' .';
				--header-size-3: '. esc_attr( ($options['heading_h3_font_size']) / 10) . 'rem' .';
				--header-size-4: '. esc_attr( ($options['heading_h4_font_size']) / 10) . 'rem' .';
				--header-size-5: '. esc_attr( ($options['heading_h5_font_size']) / 10) . 'rem' .';
				--header-size-6: '. esc_attr( ($options['heading_h6_font_size']) / 10) . 'rem' .';

				--scrollbar-width:17px;

				--header-background-color:'. esc_attr( $options['header_background_color'] ) .';
				--theme-color:' . esc_attr( $options['theme_color'] ) . ';
				--background-color:' . esc_attr( $options['background_color'] ) . ';
				--text-color:' . esc_attr( $options['text_color'] ) . ';

				--line-color:' . esc_attr( $options['line_color'] ) . ';
				--second-background-color:' . esc_attr( $options['second_background_color'] ) . ';

				--button-text-color:'. esc_attr( $options['button_text_color'] ) . ';
				--button-background-color:'. esc_attr( $options['button_background_color'] ) . ';
				--button-hover-text-color:'. esc_attr( $options['button_hover_text_color'] ) . ';
				--button-hover-background-color:'. esc_attr( $options['button_hover_background_color'] ) . ';
				--button-border-radius:'. esc_attr( $options['buttons_border_radius'] ) .'px;

				--border-radius:'. esc_attr( $options['border_radius'] ) . 'px' .';
			
				--content-width:'. esc_attr( $options['container_width'] ) .';
				--content-spacing:'. esc_attr( $options['content_spacing'] ) .'px;

				--vertical-spacing:clamp(var(--content-spacing), '. esc_attr( $options['vertical_spacing'] ) . 'vh' .', calc(var(--content-spacing) * 4) );
				
				--page-header-padding-top:'. esc_attr( $options['page_header_padding_top']) . 'px' .';
				--page-header-padding-bottom:'. esc_attr( $options['page_header_padding_bottom']) . 'px' .';
				--page-header-margin-bottom:'. esc_attr( $options['page_header_margin_bottom']) . 'px' .';
				
				--product-image-height:'. esc_attr( $options['shop_single_product_image_height']) . 'px' .';
				
				--footer-space:'. esc_attr( $options['footer_space'] ) . 'px' .';
			
			} 			

			header {
				--header-max-height:'. esc_attr( $options['header_max_height'] ) . 'px' .';
				--header-width:'. esc_attr( $options['header_width'] ) .';
			}

			footer {
				--footer-text-color:' . esc_attr( $options['footer_text_color'] ) . ';
				--footer-link-color:' . esc_attr( $options['footer_link_color'] ) . ';
				--footer-heading-color:' . esc_attr( $options['footer_heading_color'] ) . ';
				--footer-background-color:' . esc_attr( $options['footer_background_color'] ) . ';				
			}

			@media screen and (max-width: '. esc_attr( $options['container_width'] ) .') {
				.alignfull {
					margin:0 0 0 calc(var(--content-spacing) * -1);
				}
				.site_content {
					max-width:var(--content-width);
					margin:0 var(--content-spacing);
				}
			}
			
			@media (min-width: 992px) {
				.site-boxed-container #view,
				.site_content-boxed-container .site_content {
					max-width: ' . esc_attr( $options['container_width'] ) . ';
				}
			}
		';

		$topbar_display = $options['topbar_display'];
		
		if ( $topbar_display ) {
			$styles .= '
			
			.topbar {
				--topbar-background-color:' . esc_attr( $options['topbar_background_color'] ) . ';
				--topbar-text-color:' . esc_attr( $options['topbar_text_color'] ) . ';
				--topbar-space:'. esc_attr( $options['topbar_space']) . 'px' .';
			}
			
			';			
		}

		// Logo width.
		$logo_width        = $options['logo_width'];
		$tablet_logo_width = $options['tablet_logo_width'];
		$mobile_logo_width = $options['mobile_logo_width'];

		if ( $logo_width && $logo_width > 0 ) {
			$styles .= '
				@media ( min-width: 769px ) {
					
					.site-branding img{
						max-width: ' . esc_attr( $logo_width ) . 'px;
					}
				}
			';
		}

		if ( $tablet_logo_width && $tablet_logo_width > 0 ) {
			$styles .= '
				@media ( min-width: 481px ) and ( max-width: 768px ) {
					
					.site-branding img{
						max-width: ' . esc_attr( $tablet_logo_width ) . 'px;
					}
				}
			';
		}

		if ( $mobile_logo_width && $mobile_logo_width > 0 ) {
			$styles .= '
				@media ( max-width: 480px ) {
					
					.site-branding img{
						max-width: ' . esc_attr( $mobile_logo_width ) . 'px;
					}
				}
			';
		}

		// Body css.
		$styles .= '
			.pagination a,
			.pagination a,
			.woocommerce-pagination a,
			.woocommerce-loop-product__category a,
			.woocommerce-loop-product__title,
			.price del,
			.stars a,
			.woocommerce-review-link,
			.woocommerce-tabs .tabs li:not(.active) a,
			.woocommerce-cart-form__contents .product-remove a,
			.comment-body .comment-meta .comment-date,
			.roxtar-breadcrumb a,
			.rank-math-breadcrumb a,
			.breadcrumb-separator,
			.has-roxtar-text-color,
			.button.loop-add-to-cart-icon-btn,
			.loop-wrapper-wishlist a,
			#order_review .shop_table .product-name {
				color: ' . esc_attr( $options['text_color'] ) . ';
			}

			.loop-wrapper-wishlist a:hover,
			.price_slider_wrapper .price_slider,
			.has-roxtar-text-background-color{
				background-color: ' . esc_attr( $options['text_color'] ) . ';
			}

		';

		// Primary menu css.
		$styles .= '
			.primary-navigation a{
				font-family: ' . esc_attr( $options['menu_font_family'] ) . ';
				text-transform: ' . esc_attr( $options['menu_font_transform'] ) . ';
			}

			.primary-navigation > li > a,
			.primary-navigation .sub-menu a {
				font-weight: ' . esc_attr( $options['menu_font_weight'] ) . ';
			}

			.primary-navigation > li > a{
				font-size: ' . esc_attr( $options['parent_menu_font_size'] ) . 'px;
				line-height: ' . esc_attr( $options['parent_menu_line_height'] ) . 'px;
				color: ' . esc_attr( $options['primary_menu_color'] ) . ';
			}

			.primary-navigation .sub-menu a{
				line-height: ' . esc_attr( $options['sub_menu_line_height'] ) . 'px;
				font-size: ' . esc_attr( $options['sub_menu_font_size'] ) . 'px;
				color: ' . esc_attr( $options['primary_sub_menu_color'] ) . ';
			}

			.site-tools .tools-icon {
				color: ' . esc_attr( $options['primary_menu_color'] ) . ';
			}
		';

		// Heading css.
		$styles .= '
			
			

			.product-loop-meta .price,
			.variations label,
			.woocommerce-review__author,
			.button[name="apply_coupon"],
			.quantity .qty,
			.form-row label,
			.select2-container--default .select2-selection--single .select2-selection__rendered,
			.form-row .input-text:focus,
			.wc_payment_method label,
			.shipping-methods-modified-label,
			.woocommerce-checkout-review-order-table thead th,
			.woocommerce-checkout-review-order-table .product-name,
			.woocommerce-thankyou-order-details strong,
			.woocommerce-table--order-details th,
			.woocommerce-table--order-details .amount,
			.wc-breadcrumb .roxtar-breadcrumb,
			.sidebar-menu .primary-navigation .arrow-icon,
			
			.roxtar-subscribe-form input,			
			.shop_table_responsive td:before,
			.dialog-search-title,
			.cart-collaterals th,
			.woocommerce-mini-cart__total strong,
			.woocommerce-form-login-toggle .woocommerce-info a,
			.woocommerce-form-coupon-toggle .woocommerce-info a,
			.has-roxtar-heading-color,
			.woocommerce-table--order-details td,
			.woocommerce-table--order-details td.product-name a,
			.has-distraction-free-checkout .site_header .site-branding:after,
			.woocommerce-cart-form__contents thead th,
			#order_review .shop_table th,
			#order_review .shop_table th.product-name,
			#order_review .shop_table .product-quantity {
				color: ' . esc_attr( $options['heading_color'] ) . ';
			}

			.has-roxtar-heading-background-color{
				background-color: ' . esc_attr( $options['heading_color'] ) . ';
			}

			.variations label{
				font-weight: ' . esc_attr( $options['heading_font_weight'] ) . ';
			}
		';

		// Link color.
		$styles .= '
			.cart-sidebar-content .woocommerce-mini-cart__buttons a:not(.checkout),
			.product-loop-meta .button,
			.multi-step-checkout-button[data-action="back"],
			.review-information-link,
			a{
				color: ' . esc_attr( $options['accent_color'] ) . ';
			}

		';

		// Buttons.
		$styles .= '
			.roxtar-button-color,
			.loop-add-to-cart-on-image+.added_to_cart {
				color: ' . esc_attr( $options['button_text_color'] ) . ';
			}

			.roxtar-button-bg-color,
			.woocommerce-cart-form__contents:not(.elementor-menu-cart__products) .actions .coupon [name="apply_coupon"],
			.loop-add-to-cart-on-image+.added_to_cart {
				background-color: ' . esc_attr( $options['button_background_color'] ) . ';
			}

			.roxtar-button-hover-color,
			.button[name="apply_coupon"]:hover{
				color: ' . esc_attr( $options['button_hover_text_color'] ) . ';
			}

			.roxtar-button-hover-bg-color,
			.loop-add-to-cart-on-image+.added_to_cart:hover,
			.button.loop-add-to-cart-icon-btn:hover,
			.product-loop-action .yith-wcwl-add-to-wishlist:hover,
			.product-loop-action .yith-wcwl-wishlistaddedbrowse.show,
			.product-loop-action .yith-wcwl-wishlistexistsbrowse.show,
			.product-loop-action .added_to_cart,
			.product-loop-image-wrapper .tinv-wraper .tinvwl_add_to_wishlist_button:hover {
				background-color: ' . esc_attr( $options['button_hover_background_color'] ) . ';
			}

			@media (min-width: 992px) {
				.main-navigation .primary-navigation > .menu-item ul:not(.sub-mega-menu) a.tinvwl_add_to_wishlist_button:hover {
					background-color: ' . esc_attr( $options['button_hover_background_color'] ) . ';
				}
			}

			

			@media ( max-width: 600px ) {
				.woocommerce-cart-form__contents [name="update_cart"],
				.woocommerce-cart-form__contents .coupon button {
					background-color: ' . esc_attr( $options['button_background_color'] ) . ';
					filter: grayscale(100%);
				}
				.woocommerce-cart-form__contents [name="update_cart"],
				.woocommerce-cart-form__contents .coupon button {
					color: ' . esc_attr( $options['button_text_color'] ) . ';
				}
			}
		';

		// Header transparent.
		if ( roxtar_header_transparent() ) {
			$styles .= '
				.has-header-transparent .site_header_inner{
					border-bottom-width: ' . esc_attr( $options['header_transparent_border_width'] ) . 'px;
					border-bottom-color: ' . esc_attr( $options['header_transparent_border_color'] ) . ';
				}
				.has-header-transparent .primary-navigation > li > a {
					color: ' . esc_attr( $options['header_transparent_menu_color'] ) . ';
				}
				.has-header-transparent .sidebar-menu .primary-navigation > li > a {
					color: ' . esc_attr( $options['text_color'] ) . ';
				}
				.has-header-transparent .sidebar-menu .primary-navigation > li > a:hover {
					color: ' . esc_attr( $options['text_color'] ) . ';
				}
				.has-header-transparent .site-tools .tools-icon {
					color: ' . esc_attr( $options['header_transparent_icon_color'] ) . ';
				}
				.has-header-transparent .wishlist-item-count, .has-header-transparent .shop-cart-count {
					background-color: ' . esc_attr( $options['header_transparent_count_background'] ) . ';
				}

				.has-header-transparent .active .primary-navigation > li > a {
					color: ' . esc_attr( $options['text_color'] ) . ';

				}

				.has-header-transparent .active .site-tools .tools-icon {
					color: ' . esc_attr( $options['text_color'] ) . ';
				}
			';
		}

		// Page header.
		if ( $options['page_header_display'] ) {
			$page_header_background_image = '';
			$page_header_color = '';
			$page_header_margin = '';

			if ( $options['page_header_background_image'] ) {

				if (is_page() && has_post_thumbnail() ) {

					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'large');
					$page_header_background_image .= 'background-image: url(' . esc_attr( $featured_img_url ) . ');';
					
				} elseif (is_single() && has_post_thumbnail() ) {

					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'large');
					$page_header_background_image .= 'background-image: url(' . esc_attr( $featured_img_url ) . ');';
					
				} elseif(is_archive()) {

					global $wp_query;
					$cat = $wp_query->get_queried_object();
					$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
					$category_img_url = wp_get_attachment_url( $thumbnail_id );
					if ( $category_img_url ) {
						$page_header_background_image .= 'background-image: url(' . esc_attr( $category_img_url ) . ');';
					} else {
						$page_header_background_image .= 'background-image: url(' . esc_attr( $options['page_header_background_image'] ) . ');';
					}			
	
				} else {
					$page_header_background_image .= 'background-image: url(' . esc_attr( $options['page_header_background_image'] ) . ');';
				}
				
				$page_header_background_image .= 'background-size: ' . esc_attr( $options['page_header_background_image_size'] ) . ';';
				$page_header_background_image .= 'background-repeat: ' . esc_attr( $options['page_header_background_image_repeat'] ) . ';';
				$page_header_bg_image_position = str_replace( '-', ' ', $options['page_header_background_image_position'] );
				$page_header_background_image .= 'background-position: ' . esc_attr( $page_header_bg_image_position ) . ';';
				$page_header_background_image .= 'background-attachment: ' . esc_attr( $options['page_header_background_image_attachment'] ) . ';';
				$page_header_color .= 'color: var(--background-color);text-shadow: 1px 4px 4px rgba(0, 0, 0, 0.1);';
				$page_header_margin .= 'margin-bottom:30px;';

			}

			$styles .= '
				.page-header{
					'. $page_header_background_image .'
					'. $page_header_margin .'
				}

				.page-header .entry-title{
					color: ' . esc_attr( $options['page_header_title_color'] ) . ';
					'. $page_header_color .'					
				}

				.roxtar-breadcrumb,
				.roxtar-breadcrumb a,
				.rank-math-breadcrumb,
				.rank-math-breadcrumb a{
					color: ' . esc_attr( $options['page_header_breadcrumb_text_color'] ) . ';
					
				}

				.page-header .roxtar-breadcrumb, 
				.page-header .roxtar-breadcrumb a {
					color: ' . esc_attr( $options['page_header_title_color'] ) . ';
					'. $page_header_color .'
				}

				.term-description {
					'. $page_header_color .'
				}
			';
		}

		// Sidebar Width.
		$styles .= '
			@media (min-width: 992px) {

				.has-sidebar #secondary {
				width: ' . esc_attr( $options['sidebar_width'] ) . '%;
				}

				.has-sidebar #primary {
					width: calc( 100% - ' . esc_attr( $options['sidebar_width'] ) . '%);
				}
			}
		';

		// Scroll to top.
		$styles .= '
			#scroll-to-top:before {
				font-size: ' . esc_attr( $options['scroll_to_top_icon_size'] ) . 'px;
			}

			#scroll-to-top {
				bottom: ' . esc_attr( $options['scroll_to_top_offset_bottom'] ) . 'px;
				background-color: ' . esc_attr( $options['scroll_to_top_background'] ) . ';
				color: ' . esc_attr( $options['scroll_to_top_color'] ) . ';
			}

			@media (min-width: 992px) {
				#scroll-to-top.scroll-to-top-show-mobile {
					display: none;
				}
			}
			@media (max-width: 992px) {
				#scroll-to-top.scroll-to-top-show-desktop {
					display: none;
				}
			}
		';

		// Spinner color.
		$styles .= '
			.circle-loading:before,
			.product_list_widget .remove_from_cart_button:focus:before,
			.updating-cart.ajax-single-add-to-cart .single_add_to_cart_button:before,
			.product-loop-meta .loading:before,
			.updating-cart #shop-cart-sidebar:before,
			#product-images:not(.tns-slider) .image-item:first-of-type:before,
			#product-thumbnail-images:not(.tns-slider) .thumbnail-item:first-of-type:before{
				border-top-color: ' . esc_attr( $options['theme_color'] ) . ';
			}
		';

		// SHOP PAGE.

		$styles .= '
			.product-loop-wrapper .button,.product-loop-meta.no-transform .button {
				background-color: ' . esc_attr( $options['shop_page_button_cart_background'] ) . ';
				color: ' . esc_attr( $options['shop_page_button_cart_color'] ) . ';
				border-radius: ' . esc_attr( $options['shop_page_button_border_radius'] ) . 'px;
			}

			.product-loop-wrapper .button:hover, .product-loop-meta.no-transform .button:hover {
				background-color: ' . esc_attr( $options['shop_page_button_background_hover'] ) . ';
				color: ' . esc_attr( $options['shop_page_button_color_hover'] ) . ';
			}
		';

		// Product card.
		if ( 'none' !== $options['shop_page_product_card_border_style'] ) {
			$styles .= '
				.products .product:not(.product-category) .product-loop-wrapper {
					border-style: ' . esc_attr( $options['shop_page_product_card_border_style'] ) . ';
					border-width: ' . esc_attr( $options['shop_page_product_card_border_width'] ) . 'px;
					border-color: ' . esc_attr( $options['shop_page_product_card_border_color'] ) . ';
				}
			';
		}

		// Product content.
		if ( $options['shop_page_product_content_equal'] ) {
			$styles .= '
				.product-loop-content {
					min-height: ' . esc_attr( $options['shop_page_product_content_min_height'] ) . 'px;
				}
			';
		}

		// Product image.
		if ( 'none' !== $options['shop_page_product_image_border_style'] ) {
			$styles .= '
				.product-loop-image-wrapper {
					border-style: ' . esc_attr( $options['shop_page_product_image_border_style'] ) . ';
					border-width: ' . esc_attr( $options['shop_page_product_image_border_width'] ) . 'px;
					border-color: ' . esc_attr( $options['shop_page_product_image_border_color'] ) . ';
				}
			';
		}

		// Equal image height.
		if ( $options['shop_page_product_image_equal_height'] ) {
			$styles .= '
				.has-equal-image-height {
					height: ' . $options['shop_page_product_image_height'] . 'px;
				}
			';
		}

		// Sale tag.
		if ( $options['shop_page_sale_square'] ) {
			$styles .= '
				.roxtar-tag-on-sale.is-square {
					width: ' . esc_attr( $options['shop_page_sale_size'] ) . 'px;
					height: ' . esc_attr( $options['shop_page_sale_size'] ) . 'px;
				}
			';
		}
		$styles .= '
			.onsale {
				color: ' . esc_attr( $options['shop_page_sale_color'] ) . ';
				background-color: ' . esc_attr( $options['shop_page_sale_bg_color'] ) . ';
				border-radius: ' . esc_attr( $options['shop_page_sale_border_radius'] ) . 'px;
			}
		';

		// Out of stock label.
		if ( $options['shop_page_out_of_stock_square'] ) {
			$styles .= '
				.roxtar-out-of-stock-label.is-square {
					width: ' . esc_attr( $options['shop_page_out_of_stock_size'] ) . 'px;
					height: ' . esc_attr( $options['shop_page_out_of_stock_size'] ) . 'px;
				}
			';
		}
		$styles .= '
			.roxtar-out-of-stock-label {
				color: ' . esc_attr( $options['shop_page_out_of_stock_color'] ) . ';
				background-color: ' . esc_attr( $options['shop_page_out_of_stock_bg_color'] ) . ';
				border-radius: ' . esc_attr( $options['shop_page_out_of_stock_border_radius'] ) . 'px;
			}
		';

		// Single Product Add to cart.
		$styles .= '
			.single_add_to_cart_button.button:not(.roxtar-buy-now){
				border-radius: ' . esc_attr( $options['shop_single_button_border_radius'] ) . 'px;
				background-color:  ' . esc_attr( $options['shop_single_button_cart_background'] ) . ';
				color:  ' . esc_attr( $options['shop_single_button_cart_color'] ) . ';
			}
			.single_add_to_cart_button.button:not(.roxtar-buy-now):hover{
				color:  ' . esc_attr( $options['shop_single_button_color_hover'] ) . ';
				background-color:  ' . esc_attr( $options['shop_single_button_background_hover'] ) . ';
			}
		';

		// 404.
		$error_404_bg = $options['error_404_image'];
		if ( $error_404_bg ) {
			$styles .= '
				.error404 .site_content{
					background-image: url(' . esc_url( $error_404_bg ) . ');
				}
			';
		}

		return apply_filters( 'roxtar_customizer_css', $styles );
	}

	/**
	 * Add Gutenberg css.
	 */
	public function roxtar_guten_block_editor_assets() {
		// Get all theme option value.
		$options = roxtar_options( false );

		$block_styles = '
			.edit-post-visual-editor, .edit-post-visual-editor p{
				font-family: ' . esc_attr( $options['body_font_family'] ) . ';
			}

			.editor-post-title__block .editor-post-title__input,
			.wp-block-heading, .editor-rich-text__tinymce{
				font-family: ' . esc_attr( $options['heading_font_family'] ) . ';
			}
		';

		wp_register_style( 'roxtar-block-editor', false ); // @codingStandardsIgnoreLine
		wp_enqueue_style( 'roxtar-block-editor' );
		wp_add_inline_style( 'roxtar-block-editor', $block_styles );
	}

	/**
	 * Add CSS in <head> for styles handled by the theme customizer
	 *
	 * @return void
	 */
	public function roxtar_add_customizer_css() {
		wp_add_inline_style( 'roxtar-style', $this->roxtar_get_css() );
	}
}

return new Roxtar_Get_CSS();
