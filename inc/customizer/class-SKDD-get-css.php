<?php
/**
 * SKDD Get CSS
 *
 * @package  SKDD
 */

/**
 * The SKDD Get CSS class
 */
class SKDD_Get_CSS {
	/**
	 * Wp enqueue scripts
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'SKDD_add_customizer_css' ), 130 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'SKDD_guten_block_editor_assets' ) );
	}

	/**
	 * Get Customizer css.
	 *
	 * @see get_SKDD_theme_mods()
	 * @return array $styles the css
	 */
	public function SKDD_get_css() {

		// Get all theme option value.
		$options = SKDD_options( false );

		// used on the frontend
		$styles = '

			:root {
				--body-font-size:'. esc_attr( ($options['body_font_size']) / 10 ) . 'rem' .';
				--body-font-size-tablet:'. esc_attr( ($options['body_font_size_tablet']) / 10 ) . 'rem' .';
				--body-font-size-mobile:'. esc_attr( ($options['body_font_size_mobile']) / 10 ) . 'rem' .';

				--body-font-family:' . esc_attr( $options['body_font_family'] ) . ';
				--body-font-weight:' . esc_attr( $options['body_font_weight'] ) . ';
				--body-line-height:'. esc_attr( ($options['body_line_height']) / 10 ) . 'rem' .';
				--body-line-height-tablet:'. esc_attr( ($options['body_line_height_tablet']) / 10 ) . 'rem' .';
				--body-line-height-mobile:'. esc_attr( ($options['body_line_height_mobile']) / 10 ) . 'rem' .';
				--body-font-transform:' . esc_attr( $options['body_font_transform'] ) . ';				

				--heading-font-family:' . esc_attr( $options['heading_font_family'] ) . ';
				--heading-font-weight:' . esc_attr( $options['heading_font_weight'] ) . ';
				--heading-line-height:'. esc_attr($options['heading_line_height']) . '%' .';				
				--heading-font-transform:' . esc_attr( $options['heading_font_transform'] ) . ';
								
				--header-size-1: '. esc_attr( ($options['heading_h1_font_size']) / 10 ) . 'rem' .';
				--header-size-2: '. esc_attr( ($options['heading_h2_font_size']) / 10) . 'rem' .';
				--header-size-3: '. esc_attr( ($options['heading_h3_font_size']) / 10) . 'rem' .';
				--header-size-4: '. esc_attr( ($options['heading_h4_font_size']) / 10) . 'rem' .';
				--header-size-5: '. esc_attr( ($options['heading_h5_font_size']) / 10) . 'rem' .';
				--header-size-6: '. esc_attr( ($options['heading_h6_font_size']) / 10) . 'rem' .';

				--header-size-1-tablet: '. esc_attr( ($options['heading_h1_font_size_tablet']) / 10 ) . 'rem' .';
				--header-size-2-tablet: '. esc_attr( ($options['heading_h2_font_size_tablet']) / 10) . 'rem' .';
				--header-size-3-tablet: '. esc_attr( ($options['heading_h3_font_size_tablet']) / 10) . 'rem' .';
				--header-size-4-tablet: '. esc_attr( ($options['heading_h4_font_size_tablet']) / 10) . 'rem' .';
				--header-size-5-tablet: '. esc_attr( ($options['heading_h5_font_size_tablet']) / 10) . 'rem' .';
				--header-size-6-tablet: '. esc_attr( ($options['heading_h6_font_size_tablet']) / 10) . 'rem' .';

				--header-size-1-mobile: '. esc_attr( ($options['heading_h1_font_size_mobile']) / 10 ) . 'rem' .';
				--header-size-2-mobile: '. esc_attr( ($options['heading_h2_font_size_mobile']) / 10) . 'rem' .';
				--header-size-3-mobile: '. esc_attr( ($options['heading_h3_font_size_mobile']) / 10) . 'rem' .';
				--header-size-4-mobile: '. esc_attr( ($options['heading_h4_font_size_mobile']) / 10) . 'rem' .';
				--header-size-5-mobile: '. esc_attr( ($options['heading_h5_font_size_mobile']) / 10) . 'rem' .';
				--header-size-6-mobile: '. esc_attr( ($options['heading_h6_font_size_mobile']) / 10) . 'rem' .';

				--scrollbar-width:17px;

				--header-max-height:'. esc_attr( $options['header_max_height'] ) . 'px' .';
				--header-max-height-tablet:'. esc_attr( $options['header_max_height_tablet'] ) . 'px' .';
				--header-max-height-mobile:'. esc_attr( $options['header_max_height_mobile'] ) . 'px' .';

				--header-width:'. esc_attr( $options['header_width'] ) .';

				--body-text-color:' . esc_attr( $options['text_color'] ) . ';
				--link-color:' . esc_attr( $options['link_color'] ) . ';
				--link-hover-color:' . esc_attr( $options['hover_color'] ) . ';
				--heading-color:' . esc_attr( $options['heading_color'] ) . ';
				--header-background-color:'. esc_attr( $options['header_background_color'] ) .';
				--theme-color:' . esc_attr( $options['theme_color'] ) . ';
				--secondary-theme-color:' . esc_attr( $options['secondary_theme_color'] ) . ';
				--tertiary-theme-color:' . esc_attr( $options['tertiary_theme_color'] ) . ';				
				--background-color:' . esc_attr( $options['background_color'] ) . ';
				--text-color:' . esc_attr( $options['text_color'] ) . ';
				--header-transparent-icon-color:' . esc_attr( $options['header_transparent_icon_color'] ) . ';
				
				--offset-color:' . esc_attr( $options['offset_color'] ) . ';
				--second-background-color:' . esc_attr( $options['second_background_color'] ) . ';

				--gkt-color-brand:' . esc_attr( $options['theme_color'] ) . ';
				--gkt-color-dark-gray:' . esc_attr( $options['background_color'] ) . ';
				--gkt-color-light-gray:' . esc_attr( $options['second_background_color'] ) . ';
				--gkt-color-light-gray-darken:' . esc_attr( $options['second_background_color'] ) . ';
				--gkt-color-primary:' . esc_attr( $options['theme_color'] ) . ';
				--gkt-color-success: ' . esc_attr( $options['secondary_theme_color'] ) . ';
				--gkt-color-danger:' . esc_attr( $options['link_color'] ) . ';
				--gkt-color-warning:' . esc_attr( $options['link_color'] ) . ';
				--gkt-color-info:' . esc_attr( $options['secondary_theme_color'] ) . ';
				--gkt-border-radius: '. esc_attr( $options['border_radius'] ) .'px;

				--button-text-color:'. esc_attr( $options['button_text_color'] ) . ';
				--button-background-color:'. esc_attr( $options['button_background_color'] ) . ';
				--button-hover-text-color:'. esc_attr( $options['button_hover_text_color'] ) . ';
				--button-hover-background-color:'. esc_attr( $options['button_hover_background_color'] ) . ';
				--button-border-radius:'. esc_attr( $options['buttons_border_radius'] ) .'px;

				--button-font-family:' . esc_attr( $options['button_font_family'] ) . ';
				--button-font-weight:' . esc_attr( $options['button_font_weight'] ) . ';
				--button-line-height:'. esc_attr( ($options['button_line_height']) ) . 'px' .';
				--button-font-transform:' . esc_attr( $options['button_font_transform'] ) . ';

				--border-radius:'. esc_attr( $options['border_radius'] ) . 'px' .';
			
				--content-width:'. esc_attr( $options['container_width'] ) .';

				--content-spacing:'. esc_attr( $options['content_spacing'] ) .'px;
				--content-spacing-tablet:'. esc_attr( $options['tablet_content_spacing'] ) .'px;
				--content-spacing-mobile:'. esc_attr( $options['mobile_content_spacing'] ) .'px;

				--vertical-spacing:clamp(var(--content-spacing), '. esc_attr( $options['vertical_spacing'] ) . 'vh' .', calc(var(--content-spacing) * 4) );
				
				--page-header-padding-top:'. esc_attr( $options['page_header_padding_top']) . 'px' .';
				--page-header-padding-bottom:'. esc_attr( $options['page_header_padding_bottom']) . 'px' .';
				--page-header-margin-bottom:'. esc_attr( $options['page_header_margin_bottom']) . 'px' .';
				
				--product-image-height:'. esc_attr( $options['shop_single_product_image_height']) . 'px' .';
				
				--footer-space:'. esc_attr( $options['footer_space'] ) . 'px' .';
			
				--sidebar-background-color:' . esc_attr( $options['sidebar_background_color'] ) . ';
				--sidebar-text-color:' . esc_attr( $options['sidebar_text_color'] ) . ';
				--sidebar-offset-color:' . esc_attr( $options['sidebar_offset_color'] ) . ';					

			} 			

			footer {
				--footer-text-color:' . esc_attr( $options['footer_text_color'] ) . ';
				--footer-link-color:' . esc_attr( $options['footer_link_color'] ) . ';
				--footer-heading-color:' . esc_attr( $options['footer_heading_color'] ) . ';
				--footer-background-color:' . esc_attr( $options['footer_background_color'] ) . ';				
			}

			.site_header_inner {
				--menu-font-family:' . esc_attr( $options['menu_font_family'] ) . ';					
				--menu-font-weight:' . esc_attr( $options['menu_font_weight'] ) . ';								
				--menu-text-transform:' . esc_attr( $options['menu_font_transform'] ) . ';
				--menu-color:' . esc_attr( $options['primary_menu_color'] ) . ';				
				--submenu-color:' . esc_attr( $options['primary_sub_menu_color'] ) . ';
				--submenu-background-color:' . esc_attr( $options['submenu_background_color'] ) . ';	
				--submenu-offset-color:' . esc_attr( $options['submenu_offset_color'] ) . ';		

				--menu-font-size:'. esc_attr($options['parent_menu_font_size']) . 'px' .';
				--menu-font-size-tablet:'. esc_attr($options['parent_menu_font_size_tablet']) . 'px' .';
				--menu-font-size-mobile:'. esc_attr($options['parent_menu_font_size_mobile']) . 'px' .';

				--menu-line-height:'. esc_attr($options['parent_menu_line_height']) . 'px' .';
				--menu-line-height-tablet:'. esc_attr($options['parent_menu_line_height_tablet']) . 'px' .';
				--menu-line-height-mobile:'. esc_attr($options['parent_menu_line_height_mobile']) . 'px' .';

				--submenu-font-size:'. esc_attr($options['sub_menu_font_size']) . 'px' .';
				--submenu-font-size-tablet:'. esc_attr($options['sub_menu_font_size_tablet']) . 'px' .';
				--submenu-font-size-mobile:'. esc_attr($options['sub_menu_font_size_mobile']) . 'px' .';

				--submenu-line-height:'. esc_attr($options['sub_menu_line_height']) . 'px' .';
				--submenu-line-height-tablet:'. esc_attr($options['sub_menu_line_height_tablet']) . 'px' .';
				--submenu-line-height-mobile:'. esc_attr($options['sub_menu_line_height_mobile']) . 'px' .';

			}

			#scroll-to-top {
				--scroll-top-icon-size:'. esc_attr( $options['scroll_to_top_icon_size']) . 'px' .';
				--scroll-top-offset-bottom:'. esc_attr( $options['scroll_to_top_offset_bottom']) . 'px' .';
				--scroll-top-background-color:' . esc_attr( $options['scroll_to_top_background'] ) . ';				
				--scroll-top-color:' . esc_attr( $options['scroll_to_top_color'] ) . ';				
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

			.ghostkit-button {				

				--button-font-size:'. esc_attr( ($options['button_font_size']) / 10 ) . 'rem' .';
				--button-font-size-tablet:'. esc_attr( ($options['button_font_size_tablet']) / 10 ) . 'rem' .';
				--button-font-size-mobile:'. esc_attr( ($options['button_font_size_mobile']) / 10 ) . 'rem' .';
			}

		';

		$topbar_display = $options['topbar_display'];
		
		if ( $topbar_display ) {
			$styles .= '
			
			.topbar {
				--topbar-background-color:' . esc_attr( $options['topbar_background_color'] ) . ';
				--topbar-text-color:' . esc_attr( $options['topbar_text_color'] ) . ';
				--topbar-height:'. esc_attr( $options['topbar_height']) . 'px' .';
				--topbar-align:' . esc_attr( $options['topbar_layout'] ) . '; 
			}

			.has-header-transparent.header-transparent-for-all-devices .site_header {
				margin-top:'. esc_attr( $options['topbar_height']) . 'px' .';
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

		// Header transparent.
		if ( SKDD_header_transparent() ) {

			$topbar_background_color = esc_attr( $options['topbar_background_color'] );
			$topbar_opacity = esc_attr( $options['topbar_opacity'] );
			
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
					color: ' . esc_attr( $options['header_transparent_menu_color'] ) . ';
				}

				.has-header-transparent .active .primary-navigation > li > a {
					color: ' . esc_attr( $options['text_color'] ) . ';

				}

				.has-header-transparent .active .site-tools .tools-icon {
					color: ' . esc_attr( $options['text_color'] ) . ';
				}

				.has-header-transparent.header-transparent-for-all-devices .topbar {
					background-color:' . SKDD_hex_to_rgb( $topbar_background_color, $topbar_opacity ) . ';
				}

				.has-header-transparent.header-transparent-for-all-devices .site_header.active { 
					position: fixed;
					top: 0;
					margin-top:0;
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

				.SKDD-breadcrumb,
				.SKDD-breadcrumb a,
				.rank-math-breadcrumb,
				.rank-math-breadcrumb a{
					color: ' . esc_attr( $options['page_header_breadcrumb_text_color'] ) . ';
					
				}

				.page-header .SKDD-breadcrumb, 
				.page-header .SKDD-breadcrumb a {
					color: ' . esc_attr( $options['page_header_title_color'] ) . ';
					'. $page_header_color .'
				}

				.term-description p {
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

			
		if ( SKDD_is_woocommerce_activated() ) {
			
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
					.SKDD-tag-on-sale.is-square {
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
					.SKDD-out-of-stock-label.is-square {
						width: ' . esc_attr( $options['shop_page_out_of_stock_size'] ) . 'px;
						height: ' . esc_attr( $options['shop_page_out_of_stock_size'] ) . 'px;
					}
				';
			}
			$styles .= '
				.SKDD-out-of-stock-label {
					color: ' . esc_attr( $options['shop_page_out_of_stock_color'] ) . ';
					background-color: ' . esc_attr( $options['shop_page_out_of_stock_bg_color'] ) . ';
					border-radius: ' . esc_attr( $options['shop_page_out_of_stock_border_radius'] ) . 'px;
				}
			';

			// Single Product Add to cart.
			$styles .= '
				.single_add_to_cart_button.button:not(.SKDD-buy-now){
					border-radius: ' . esc_attr( $options['shop_single_button_border_radius'] ) . 'px;
					background-color:  ' . esc_attr( $options['shop_single_button_cart_background'] ) . ';
					color:  ' . esc_attr( $options['shop_single_button_cart_color'] ) . ';
				}
				.single_add_to_cart_button.button:not(.SKDD-buy-now):hover{
					color:  ' . esc_attr( $options['shop_single_button_color_hover'] ) . ';
					background-color:  ' . esc_attr( $options['shop_single_button_background_hover'] ) . ';
				}
			';

		}

		// 404.
		$error_404_bg = $options['error_404_image'];
		if ( $error_404_bg ) {
			$styles .= '
				.error404 .site_content{
					background-image: url(' . esc_url( $error_404_bg ) . ');
				}
			';
		}

		$styles = apply_filters( 'SKDD_customizer_css', $styles );
		$styles = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles);
		$styles = str_replace(': ', ':', $styles);
		$styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $styles);
		return $styles;
	}

	/**
	 * Add Gutenberg css. used in the wordpress backend
	 */
	public function SKDD_guten_block_editor_assets() {
		
		$options = SKDD_options( false );
		
		if (is_user_logged_in() && current_user_can( 'edit_posts' )) {			

			$block_styles = '

					:root {
						--body-font-size:'. esc_attr( ($options['body_font_size']) / 10 ) . 'rem' .';

						--body-font-family:' . esc_attr( $options['body_font_family'] ) . ';
						--body-font-weight:' . esc_attr( $options['body_font_weight'] ) . ';
						--body-line-height:'. esc_attr( ($options['body_line_height']) / 10 ) . 'rem' .';
						--body-font-transform:' . esc_attr( $options['body_font_transform'] ) . ';				

						--heading-font-family:' . esc_attr( $options['heading_font_family'] ) . ';
						--heading-font-weight:' . esc_attr( $options['heading_font_weight'] ) . ';
						--heading-line-height:'. esc_attr($options['heading_line_height']) . '%' .';				
						--heading-font-transform:' . esc_attr( $options['heading_font_transform'] ) . ';
										
						--header-size-1: '. esc_attr( ($options['heading_h1_font_size']) / 10 ) . 'rem' .';
						--header-size-2: '. esc_attr( ($options['heading_h2_font_size']) / 10) . 'rem' .';
						--header-size-3: '. esc_attr( ($options['heading_h3_font_size']) / 10) . 'rem' .';
						--header-size-4: '. esc_attr( ($options['heading_h4_font_size']) / 10) . 'rem' .';
						--header-size-5: '. esc_attr( ($options['heading_h5_font_size']) / 10) . 'rem' .';
						--header-size-6: '. esc_attr( ($options['heading_h6_font_size']) / 10) . 'rem' .';

						--scrollbar-width:17px;

						--header-max-height:'. esc_attr( $options['header_max_height'] ) . 'px' .';
						--header-width:'. esc_attr( $options['header_width'] ) .';

						--body-text-color:' . esc_attr( $options['text_color'] ) . ';
						--link-color:' . esc_attr( $options['link_color'] ) . ';
						--link-hover-color:' . esc_attr( $options['hover_color'] ) . ';
						--heading-color:' . esc_attr( $options['heading_color'] ) . ';
						--header-background-color:'. esc_attr( $options['header_background_color'] ) .';
						--theme-color:' . esc_attr( $options['theme_color'] ) . ';
						--secondary-theme-color:' . esc_attr( $options['secondary_theme_color'] ) . ';
						--tertiary-theme-color:' . esc_attr( $options['tertiary_theme_color'] ) . ';				
						--background-color:' . esc_attr( $options['background_color'] ) . ';
						--text-color:' . esc_attr( $options['text_color'] ) . ';
						--header-transparent-icon-color:' . esc_attr( $options['header_transparent_icon_color'] ) . ';
						
						--offset-color:' . esc_attr( $options['offset_color'] ) . ';
						--second-background-color:' . esc_attr( $options['second_background_color'] ) . ';

						--gkt-color-brand:' . esc_attr( $options['theme_color'] ) . ';
						--gkt-color-dark-gray:' . esc_attr( $options['background_color'] ) . ';
						--gkt-color-light-gray:' . esc_attr( $options['second_background_color'] ) . ';
						--gkt-color-light-gray-darken:' . esc_attr( $options['second_background_color'] ) . ';
						--gkt-color-primary:' . esc_attr( $options['theme_color'] ) . ';
						--gkt-color-success: ' . esc_attr( $options['secondary_theme_color'] ) . ';
						--gkt-color-danger:' . esc_attr( $options['link_color'] ) . ';
						--gkt-color-warning:' . esc_attr( $options['link_color'] ) . ';
						--gkt-color-info:' . esc_attr( $options['secondary_theme_color'] ) . ';
						--gkt-border-radius: '. esc_attr( $options['border_radius'] ) .'px;

						--button-text-color:'. esc_attr( $options['button_text_color'] ) . ';
						--button-background-color:'. esc_attr( $options['button_background_color'] ) . ';
						--button-hover-text-color:'. esc_attr( $options['button_hover_text_color'] ) . ';
						--button-hover-background-color:'. esc_attr( $options['button_hover_background_color'] ) . ';
						--button-border-radius:'. esc_attr( $options['buttons_border_radius'] ) .'px;

						--button-font-family:' . esc_attr( $options['button_font_family'] ) . ';
						--button-font-weight:' . esc_attr( $options['button_font_weight'] ) . ';
						--button-line-height:'. esc_attr( ($options['button_line_height']) ) . 'px' .';
						--button-font-transform:' . esc_attr( $options['button_font_transform'] ) . ';

						--border-radius:'. esc_attr( $options['border_radius'] ) . 'px' .';
					
						--content-width:'. esc_attr( $options['container_width'] ) .';
						--content-spacing:'. esc_attr( $options['content_spacing'] ) .'px;

						--vertical-spacing:clamp(var(--content-spacing), '. esc_attr( $options['vertical_spacing'] ) . 'vh' .', calc(var(--content-spacing) * 4) );
						
						--page-header-padding-top:'. esc_attr( $options['page_header_padding_top']) . 'px' .';
						--page-header-padding-bottom:'. esc_attr( $options['page_header_padding_bottom']) . 'px' .';
						--page-header-margin-bottom:'. esc_attr( $options['page_header_margin_bottom']) . 'px' .';
						
				
					
					} 			
			

				};

				.block-editor-writing-flow p{
					font-size: calc(var(--body-font-size) * .625) !important;
					font-family: var(--body-font-family);
					font-weight:var(--body-font-weight);
				}

				.block-editor-writing-flow a {
					color: var(--link-color) !important;
					transition:color 0.2s linear;
				}

				.block-editor-writing-flow a:hover {
					color: var(--link-hover-color) !important;
					transition:color 0.2s linear;
				}

				.editor-post-title__block .editor-post-title__input,
				.wp-block-heading, .editor-rich-text__tinymce{
					font-family: var(--heading-font-family);
					font-weight:var(--heading-font-weight);
				}			
				
				.block-editor-writing-flow h1 {
					font-size:calc(var(--header-size-1) * .75) !important;
					font-weight:var(--heading-font-weight);
				}
				
				.block-editor-writing-flow h2{
					font-size:calc(var(--header-size-2) * .75) !important;
					font-weight:var(--heading-font-weight);
				}
				
				.block-editor-writing-flow h3 {
					font-size:calc(var(--header-size-3) * .75) !important;
					font-weight:var(--heading-font-weight);
				}
				
				.block-editor-writing-flow h4 {
					font-size:calc(var(--header-size-4) * .75) !important;
					font-weight:var(--heading-font-weight);
				}
				
				.block-editor-writing-flow h5 {
					font-size:calc(var(--header-size-5) * .75) !important;
					font-weight:var(--heading-font-weight);
				}
				
				.block-editor-writing-flow h6 {
					font-size:calc(var(--header-size-6) * .75) !important;
					font-weight:var(--heading-font-weight);
				}
			';

			wp_register_style( 'SKDD-block-editor', false ); 
			wp_enqueue_style( 'SKDD-block-editor' );
			wp_add_inline_style( 'SKDD-block-editor', $block_styles );

		}
		
	}

	/**
	 * Add CSS in <head> for styles handled by the theme customizer
	 *
	 * @return void
	 */
	public function SKDD_add_customizer_css() {
		wp_add_inline_style( 'SKDD-style', $this->SKDD_get_css() );
	}
}

return new SKDD_Get_CSS();
