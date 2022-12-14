/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package SKDD
 */

'use strict';

// Remove class with prefix.
jQuery.fn.removeClassPrefix = function( prefix ) {
	this.each(
		function( i, it ) {
			var classes = it.className.split( ' ' ).map(
				function( item ) {
					var j = 0 === item.indexOf( prefix ) ? '' : item;
					return j;
				}
			);

			it.className = jQuery.trim( classes.join( ' ' ) );
		}
	);

	return this;
};

// Colors.
function SKDD_colors_live_update( id, selector, property, fullId ) {
	var setting = fullId ? id : 'SKDD_setting[' + id + ']';

	wp.customize(
		setting,
		function( value ) {
			value.bind(
				function( newval ) {
					if ( jQuery( 'style#' + id ).length ) {
						jQuery( 'style#' + id ).html( selector + '{' + property + ':' + newval + ';}' );
					} else {
						jQuery( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + newval + '}</style>' );

						setTimeout(
							function() {
								jQuery( 'style#' + id ).not( ':last' ).remove();
							},
							1000
						);
					}
				}
			);
		}
	);
}

// Units.
function SKDD_unit_live_update( id, selector, property, unit, fullId ) {
	var unit    = 'undefined' !== typeof( unit ) ? unit : 'px',
		setting = fullId ? id : 'SKDD_setting[' + id + ']';

	// Wordpress customize.
	wp.customize(
		setting,
		function( value ) {
			value.bind(
				function( newval ) {
					// Sometime 'unit' is not use.
					if ( ! unit ) {
						unit = '';
					}

					// Get style.
					var data = '';
					if ( Array.isArray( property ) ) {
						for ( var i = 0, j = property.length; i < j; i ++ ) {
							data += newval ? selector + '{' + property[i] + ': ' + newval + unit + '}' : '';
						}
					} else {
						data += newval ? selector + '{' + property + ': ' + newval + unit + '}' : '';
					}

					// Append style.
					if ( jQuery( 'style#' + id ).length ) {
						jQuery( 'style#' + id ).html( data );
					} else {
						jQuery( 'head' ).append( '<style id="' + id + '">' + data + '</style>' );

						setTimeout(
							function() {
								jQuery( 'style#' + id ).not( ':last' ).remove();
							},
							100
						);
					}
				}
			);
		}
	);
}

// Html.
function SKDD_html_live_update( id, selector, fullId ) {
	var setting = fullId ? id : 'SKDD_setting[' + id + ']';

	wp.customize(
		setting,
		function( value ) {
			value.bind(
				function( newval ) {
					var element = document.querySelectorAll( selector );
					if ( ! element.length ) {
						return;
					}

					element.forEach(
						function( ele ) {
							ele.innerHTML = newval;
						}
					);
				}
			);
		}
	);
}

// Hidden product meta.
function SKDD_hidden_product_meta( id, selector ) {
	wp.customize(
		'SKDD_setting[' + id + ']',
		function( value ) {
			value.bind(
				function( newval ) {
					if ( false === newval ) {
						document.body.classList.add( selector );
					} else {
						document.body.classList.remove( selector );
					}
				}
			);
		}
	);
}

// Update element class.
function SKDD_update_element_class( id, selector, prefix, fullId ) {
	var setting = fullId ? id : 'SKDD_setting[' + id + ']';

	wp.customize(
		setting,
		function( value ) {
			value.bind(
				function( newval ) {
					var newClass = '';
					switch ( newval ) {
						case true:
							newClass = prefix;
							break;
						case false:
							newClass = '';
							break;
						default:
							newClass = prefix + newval;
							break;
					}
					jQuery( selector ).removeClassPrefix( prefix ).addClass( newClass );
				}
			);
		}
	);
}

/**
 * Upload background image.
 *
 * @param      string  id  The setting id
 * @param      string  dependencies  The dependencies with background image.
 * Must follow: Size -> Repeat -> Position -> Attachment.
 * @param      string  selector      The css selector
 */
function SKDD_background_image_live_upload( id, dependencies, selector ) {
	var dep     = ( arguments.length > 0 && undefined !== arguments[1] ) ? arguments[1] : false,
		element = document.querySelector( selector );

	if ( ! element ) {
		return;
	}

	wp.customize(
		'SKDD_setting[' + id + ']',
		function( value ) {
			value.bind(
				function( newval ) {
					if ( newval ) {
						element.style.backgroundImage = 'url(' + newval + ')';
					} else {
						element.style.backgroundImage = 'none';
					}
				}
			);
		}
	);

	if ( dep ) {
		dep.forEach(
			function( el, i ) {
				wp.customize(
					'SKDD_setting[' + el + ']',
					function( value ) {
						value.bind(
							function( newval ) {
								switch ( i ) {
									case 0:
										// Set background size.
										element.style.backgroundSize = newval;
										break;
									case 1:
										// Set background repeat.
										element.style.backgroundRepeat = newval;
										break;
									case 2:
										// Set background position.
										element.style.backgroundPosition = newval.replace( '-', ' ' );
										break;
									default:
										// Set background attachment.
										element.style.backgroundAttachment = newval;
										break;
								}
							}
						);
					}
				);
			}
		);
	}
}

/**
 * Multi device slider update
 *
 * @param      array   array     The Array of settings id. Follow Desktop -> Tablet -> Mobile
 * @param      string  selector  The selector: css selector
 * @param      string  property  The property: background-color, display...
 * @param      string  unit      The css unit: px, em, pt...
 */
function SKDD_range_slider_update( arr, selector, property, unit ) {
	arr.forEach(
		function( el, i ) {
			wp.customize(
				'SKDD_setting[' + el + ']',
				function( value ) {
					value.bind(
						function( newval ) {
							var styles = '';
							if ( arr.length > 1 ) {
								if ( 0 == i ) {
									styles = '@media ( min-width: 769px ) {' + selector + ' {' + property + ': ' + newval + unit + '}}';
								} else if ( 1 == i ) {
									styles = '@media ( min-width: 321px ) and ( max-width: 768px ) {' + selector + ' { ' + property + ': ' + newval + unit + ' } }';
								} else {
									styles = '@media ( max-width: 320px ) {' + selector + ' {' + property + ': ' + newval + unit + '}}';
								}
							} else {
								styles = selector + ' { ' + property + ': ' + newval + unit + ' }';
							}

							// Append style.
							if ( jQuery( 'style#SKDD_setting-' + el ).length ) {
								jQuery( 'style#SKDD_setting-' + el ).html( styles );
							} else {
								jQuery( 'head' ).append( '<style id="SKDD_setting-' + el + '">' + styles + '</style>' );

								setTimeout(
									function() {
										jQuery( 'style#SKDD_setting-' + el ).not( ':last' ).remove();
									},
									100
								);
							}
						}
					);
				}
			);
		}
	);
}

/**
 * Dynamic Internal/Embedded Style for a Control
 */
function SKDD_add_dynamic_css( control, style ) {
	control = control.replace( '[', '-' );
	control = control.replace( ']', '' );
	jQuery( 'style' + control ).remove();

	jQuery( 'head' ).append(
		'<style id="' + control + '">' + style + '</style>'
	);
}

( function( $ ) {
	/**
	 * Primary Width Option
	 */
	wp.customize(
		'SKDD_setting[sidebar_width]',
		function( setting ) {
			setting.bind(
				function( width ) {

					if ( ! jQuery( 'body' ).hasClass( 'site-full-width-container' ) ) {

						var dynamicStyle = '@media (min-width: 992px) {';

						dynamicStyle += '.has-sidebar #primary { width: ' + ( 100 - parseInt( width ) ) + '% } ';
						dynamicStyle += '.has-sidebar #secondary { width: ' + width + '% } ';
						dynamicStyle += '}';

						SKDD_add_dynamic_css( 'sidebar_width', dynamicStyle );
					}
				}
			);
		}
	);

} )( jQuery );


document.addEventListener(
	'DOMContentLoaded',
	function() {
		// Refresh Preview when remove Custom Logo.
		wp.customize(
			'custom_logo',
			function( value ) {
				value.bind(
					function( newval ) {
						if ( ! newval ) {
							wp.customize.preview.send( 'refresh' );
						}
					}
				);
			}
		);

		// Update the site title in real time...
		SKDD_html_live_update( 'blogname', '.site-title.beta a', true );

		// Update the site description in real time...
		SKDD_html_live_update( 'blogdescription', '.site-description', true );

		// Topbar.
		SKDD_colors_live_update( 'topbar_text_color', '.topbar *', 'color' );
		SKDD_colors_live_update( 'topbar_background_color', '.topbar', 'background-color' );
		SKDD_range_slider_update( ['topbar_height'], '.topbar', 'padding', 'px 0' );
		SKDD_html_live_update( 'topbar_left', '.topbar .topbar-left' );
		SKDD_html_live_update( 'topbar_center', '.topbar .topbar-center' );
		SKDD_html_live_update( 'topbar_right', '.topbar .topbar-right' );

		// HEADER.
		// Header background.
		SKDD_colors_live_update( 'header_background_color', '.site_header_inner, .has-header-layout-7 .sidebar-menu', 'background-color' );
		// Header transparent: border bottom width.
		SKDD_unit_live_update( 'header_transparent_border_width', '.has-header-transparent .site_header_inner', 'border-bottom-width' );
		// Header transparent: border bottom color.
		SKDD_colors_live_update( 'header_transparent_border_color', '.has-header-transparent .site_header_inner', 'border-bottom-color' );

		// Header menu transparent color.
		SKDD_colors_live_update( 'header_transparent_menu_color', '.has-header-transparent .primary-navigation > li > a', 'color' );

		// Header Icon transparent color.
		SKDD_colors_live_update( 'header_transparent_icon_color', '.has-header-transparent .site-tools .tools-icon', 'color' );

		// Header Icon transparent background.
		SKDD_colors_live_update( 'header_transparent_count_background', '.has-header-transparent .wishlist-item-count, .has-header-transparent .shop-cart-count', 'background-color' );

		// Logo width.
		SKDD_range_slider_update( ['logo_width', 'tablet_logo_width', 'mobile_logo_width'], '.site-branding img', 'max-width', 'px' );

		// Header transparent enable on...
		SKDD_update_element_class( 'header_transparent_enable_on', 'body', 'header-transparent-for-' );

		// PAGE HEADER.
		// Text align.
		SKDD_update_element_class( 'page_header_text_align', '.page-header .skdd-container', 'content-align-' );

		// Title color.
		SKDD_colors_live_update( 'page_header_title_color', '.page-header .entry-title', 'color' );

		// Breadcrumb text color.
		SKDD_colors_live_update( 'page_header_breadcrumb_text_color', '.skdd-breadcrumb, .skdd-breadcrumb a', 'color' );

		// Background image.
		SKDD_background_image_live_upload(
			'page_header_background_image',
			[
				'page_header_background_image_size',
				'page_header_background_image_repeat',
				'page_header_background_image_position',
				'page_header_background_image_attachment'
			],
			'.page-header'
		);

		// Padding top.
		SKDD_range_slider_update( ['page_header_padding_top'], '.page-header', 'padding-top', 'px' );

		// Padding bottom.
		SKDD_range_slider_update( ['page_header_padding_bottom'], '.page-header', 'padding-bottom', 'px' );

		// Margin bottom.
		SKDD_range_slider_update( ['page_header_margin_bottom'], '.page-header', 'margin-bottom', 'px' );

		// BODY.
		// Body font size.
		SKDD_unit_live_update( 'body_font_size', 'body, button, input, select, textarea, .woocommerce-loop-product__title', 'font-size' );

		// Body line height.
		SKDD_unit_live_update( 'body_line_height', 'body', 'line-height' );

		// Body font weight.
		SKDD_unit_live_update( 'body_font_weight', 'body, button, input, select, textarea', 'font-weight', false );

		// Body text transform.
		SKDD_unit_live_update( 'body_font_transform', 'body, button, input, select, textarea', 'text-transform', false );

		// MENU.
		// Menu font weight.
		SKDD_unit_live_update( 'menu_font_weight', '.primary-navigation a', 'font-weight', false );

		// Menu text transform.
		SKDD_unit_live_update( 'menu_font_transform', '.primary-navigation a', 'text-transform', false );

		// Parent menu font size.
		SKDD_unit_live_update( 'parent_menu_font_size', '.site_header .primary-navigation > li > a', 'font-size' );

		// Parent menu line-height.
		SKDD_unit_live_update( 'parent_menu_line_height', '.site_header .primary-navigation > li > a', 'line-height' );

		// Sub-menu font-size.
		SKDD_unit_live_update( 'sub_menu_font_size', '.site_header .primary-navigation .sub-menu a', 'font-size' );

		// Sub-menu line-height.
		SKDD_unit_live_update( 'sub_menu_line_height', '.site_header .primary-navigation .sub-menu a', 'line-height' );

		// HEADING.
		// Heading line height.
		SKDD_unit_live_update( 'heading_line_height', 'h1, h2, h3, h4, h5, h6', 'line-height', false );

		// Heading font weight.
		SKDD_unit_live_update( 'heading_font_weight', 'h1, h2, h3, h4, h5, h6', 'font-weight', false );

		// Heading text transform.
		SKDD_unit_live_update( 'heading_font_transform', 'h1, h2, h3, h4, h5, h6', 'text-transform', false );

		// H1 font size.
		SKDD_unit_live_update( 'heading_h1_font_size', 'h1', 'font-size' );

		// H2 font size.
		SKDD_unit_live_update( 'heading_h2_font_size', 'h2', 'font-size' );

		// H3 font size.
		SKDD_unit_live_update( 'heading_h3_font_size', 'h3', 'font-size' );

		// H4 font size.
		SKDD_unit_live_update( 'heading_h4_font_size', 'h4', 'font-size' );

		// H5 font size.
		SKDD_unit_live_update( 'heading_h5_font_size', 'h5', 'font-size' );

		// H6 font size.
		SKDD_unit_live_update( 'heading_h6_font_size', 'h6', 'font-size' );

		// BUTTONS.
		// Color.
		// Background color.
		// Hover color
		// Hover background color.
		// Border radius.
		SKDD_unit_live_update(
			'buttons_border_radius',
			'.cart .quantity, .button, .woocommerce-widget-layered-nav-dropdown__submit, .form-submit .submit, .elementor-button-wrapper .elementor-button, .has-skdd-contact-form input[type="submit"], #secondary .widget a.button, .product-loop-meta.no-transform .button',
			'border-radius'
		);

		// SHOP PAGE.
		SKDD_colors_live_update( 'shop_page_button_cart_background', '.product-loop-wrapper .button,.product-loop-meta.no-transform .button', 'background-color' );
		SKDD_colors_live_update( 'shop_page_button_cart_color', '.product-loop-wrapper .button,.product-loop-meta.no-transform .button', 'color' );
		SKDD_colors_live_update( 'shop_page_button_background_hover', '.product-loop-wrapper .button:hover,.product-loop-meta.no-transform .button:hover', 'background-color' );
		SKDD_colors_live_update( 'shop_page_button_color_hover', '.product-loop-wrapper .button:hover,.product-loop-meta.no-transform .button:hover', 'color' );
		SKDD_unit_live_update( 'shop_page_button_border_radius', '.product-loop-wrapper .button,.product-loop-meta.no-transform .button', 'border-radius' );
		// Sale tag.
		SKDD_update_element_class( 'shop_page_sale_tag_position', '.skdd-tag-on-sale', 'sale-' );
		SKDD_html_live_update( 'shop_page_sale_text', '.skdd-tag-on-sale' );
		SKDD_colors_live_update( 'shop_page_sale_color', '.skdd-tag-on-sale', 'color' );
		SKDD_colors_live_update( 'shop_page_sale_bg_color', '.skdd-tag-on-sale', 'background-color' );
		SKDD_unit_live_update( 'shop_page_sale_border_radius', '.skdd-tag-on-sale', 'border-radius' );
		SKDD_update_element_class( 'shop_page_sale_square', '.skdd-tag-on-sale', 'is-square' );
		SKDD_unit_live_update( 'shop_page_sale_size', '.skdd-tag-on-sale.is-square', [ 'width', 'height' ] );

		// Out of stock label.
		SKDD_update_element_class( 'shop_page_out_of_stock_position', '.skdd-out-of-stock-label', 'position-' );
		SKDD_html_live_update( 'shop_page_out_of_stock_text', '.skdd-out-of-stock-label' );
		SKDD_colors_live_update( 'shop_page_out_of_stock_color', '.skdd-out-of-stock-label', 'color' );
		SKDD_colors_live_update( 'shop_page_out_of_stock_bg_color', '.skdd-out-of-stock-label', 'background-color' );
		SKDD_unit_live_update( 'shop_page_out_of_stock_border_radius', '.skdd-out-of-stock-label', 'border-radius' );
		SKDD_update_element_class( 'shop_page_out_of_stock_square', '.skdd-out-of-stock-label', 'is-square' );
		SKDD_unit_live_update( 'shop_page_out_of_stock_size', '.skdd-out-of-stock-label.is-square', [ 'width', 'height' ] );

		// SHOP SINGLE.
		// Single Product Add To Cart.
		SKDD_colors_live_update( 'shop_single_button_cart_background', '.single_add_to_cart_button.button:not(.skdd-buy-now)', 'background-color' );
		SKDD_colors_live_update( 'shop_single_button_cart_color', '.single_add_to_cart_button.button:not(.skdd-buy-now)', 'color' );
		SKDD_colors_live_update( 'shop_single_button_background_hover', '.single_add_to_cart_button.button:not(.skdd-buy-now):hover', 'background-color' );
		SKDD_colors_live_update( 'shop_single_button_color_hover', '.single_add_to_cart_button.button:not(.skdd-buy-now):hover', 'color' );
		// Hidden product meta.
		SKDD_hidden_product_meta( 'shop_single_skus', 'hid-skus' );
		SKDD_hidden_product_meta( 'shop_single_categories', 'hid-categories' );
		SKDD_hidden_product_meta( 'shop_single_tags', 'hid-tags' );

		// Footer.
		SKDD_range_slider_update( ['footer_space'], '.site-footer', 'margin-top', 'px' );
		// Scroll To Top.
		SKDD_colors_live_update( 'scroll_to_top_background', '#scroll-to-top', 'background-color' );
		SKDD_colors_live_update( 'scroll_to_top_color', '#scroll-to-top', 'color' );
		SKDD_range_slider_update( ['scroll_to_top_border_radius'], '#scroll-to-top', 'border-radius', 'px' );
		SKDD_range_slider_update( ['scroll_to_top_icon_size'], '#scroll-to-top:before', 'font-size', 'px' );
		SKDD_range_slider_update( ['scroll_to_top_offset_bottom'], '#scroll-to-top', 'bottom', 'px' );
		SKDD_range_slider_update( ['shop_single_button_border_radius'], '.single_add_to_cart_button.button:not(.skdd-buy-now)', 'border-radius', 'px' );
		SKDD_update_element_class( 'scroll_to_top_position', '#scroll-to-top', 'scroll-to-top-position-' );
		SKDD_update_element_class( 'scroll_to_top_on', '#scroll-to-top', 'scroll-to-top-show-' );
	}
);
