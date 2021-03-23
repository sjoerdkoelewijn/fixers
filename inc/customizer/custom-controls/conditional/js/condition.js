/**
 * Roxtar condition control
 *
 * @package roxtar
 */

'use strict';

( function( api ) {
	api.bind( 'ready', function() {

		/**
		 * Condition controls.
		 *
		 * @param string  id            Setting id.
		 * @param array   dependencies  Setting id dependencies.
		 * @param string  value         Setting value.
		 * @param array   parentvalue   Parent setting id and value.
		 * @param boolean operator      Operator.
		 */
		var condition = function( id, dependencies, value, operator ) {
			var value    = undefined !== arguments[2] ? arguments[2] : false,
				operator = undefined !== arguments[3] ? arguments[3] : false;

			api( id, function( setting ) {

				/**
				 * Update a control's active setting value.
				 *
				 * @param {api.Control} control
				 */
				var dependency = function( control ) {
					var visibility = function() {
						// wp.customize.control( parentValue[0] ).setting.get();.
						var compare = false;

						// Support array || string || boolean.
						if ( Array.isArray( value ) ) {
							compare = value.includes( setting.get() );
						} else {
							compare = value === setting.get();
						}

						// Is NOT of value.
						if ( operator ) {
							if ( compare ) {
								control.container.removeClass( 'hide' );
							} else {
								control.container.addClass( 'hide' );
							}
						} else {
							if ( compare ) {
								control.container.addClass( 'hide' );
							} else {
								control.container.removeClass( 'hide' );
							}
						}
					}

					// Set initial active state.
					visibility();

					// Update activate state whenever the setting is changed.
					setting.bind( visibility );
				};

				// Call dependency on the setting controls when they exist.
				for ( var i = 0, j = dependencies.length; i < j; i++ ) {
					api.control( dependencies[i], dependency );
				}
			} );
		}

		/**
		 * Condition controls.
		 *
		 * @param string  id            Setting id.
		 * @param array   dependencies  Setting id dependencies.
		 * @param string  value         Setting value.
		 * @param array   parentvalue   Parent setting id and value.
		 * @param boolean operator      Operator.
		 * @param array   arr           The parent setting value.
		 */
		var subCondition = function( id, dependencies, value, operator, arr ) {
			var value    = undefined !== arguments[2] ? arguments[2] : false,
				operator = undefined !== arguments[3] ? arguments[3] : false,
				arr      = undefined !== arguments[4] ? arguments[4] : false;

			api( id, function( setting ) {

				/**
				 * Update a control's active setting value.
				 *
				 * @param {api.Control} control
				 */
				var dependency = function( control ) {
					var visibility = function() {
						// arr[0] = control setting id.
						// arr[1] = control setting value.
						if ( ! arr || arr[1] !== wp.customize.control( arr[0] ).setting.get() ) {
							return;
						}

						if ( operator ) {
							if ( value === setting.get() ) {
								control.container.removeClass( 'hide' );
							} else {
								control.container.addClass( 'hide' );
							}
						} else {
							if ( value === setting.get() ) {
								control.container.addClass( 'hide' );
							} else {
								control.container.removeClass( 'hide' );
							}
						}
					}

					// Set initial active state.
					visibility();

					// Update activate state whenever the setting is changed.
					setting.bind( visibility );
				};

				// Call dependency on the setting controls when they exist.
				for ( var i = 0, j = dependencies.length; i < j; i++ ) {
					api.control( dependencies[i], dependency );
				}
			} );
		}

		/**
		 * Condition controls.
		 *
		 * @param string  id            Setting id.
		 * @param array   dependencies  Setting id dependencies.
		 * @param string  value         Setting value.
		 * @param array   parentvalue   Parent setting id and value.
		 */
		var arrayCondition = function( id, dependencies, value ) {
			var value    = undefined !== arguments[2] ? arguments[2] : false,
				operator = undefined !== arguments[3] ? arguments[3] : false;

			api( id, function( setting ) {

				/**
				 * Update a control's active setting value.
				 *
				 * @param {api.Control} control
				 */
				var dependency = function( control ) {
					var visibility = function() {
						if ( setting.get().includes( value ) ) {
							control.container.removeClass( 'hide' );
						} else {
							control.container.addClass( 'hide' );
						}
					}

					// Set initial active state.
					visibility();

					// Update activate state whenever the setting is changed.
					setting.bind( visibility );
				};

				// Call dependency on the setting controls when they exist.
				for ( var i = 0, j = dependencies.length; i < j; i++ ) {
					api.control( dependencies[i], dependency );
				}
			} );
		}

		// POST.
		// Post structure.
		arrayCondition(
			'roxtar_setting[blog_list_structure]',
			[ 'roxtar_setting[blog_list_post_meta]' ],
			'post-meta'
		);

		// Post single structure.
		arrayCondition(
			'roxtar_setting[blog_single_structure]',
			[ 'roxtar_setting[blog_single_post_meta]' ],
			'post-meta'
		);

		// Topbar.
		condition(
			'roxtar_setting[topbar_display]',
			[
				'roxtar_setting[topbar_text_color]',
				'roxtar_setting[topbar_background_color]',				
				'roxtar_setting[topbar_transparent]',
				'roxtar_setting[topbar_height]',
				'roxtar_setting[topbar_opacity]',
				'topbar_content_divider',
				'roxtar_setting[topbar_left]',
				'roxtar_setting[topbar_center]',
				'roxtar_setting[topbar_right]',
			],
			false
		);

		// Topbar transparency
		condition(
			'roxtar_setting[header_transparent]',
			[
				'roxtar_setting[topbar_opacity]',
			],
			false
		);

		// Search product only.
		condition(
			'roxtar_setting[header_search_icon]',
			['roxtar_setting[header_search_only_product]']
		);

		// HEADER TRANSPARENT SECTION.
		// Enable transparent header.
		condition(
			'roxtar_setting[header_transparent]',
			[
				'roxtar_setting[header_transparent_disable_archive]',
				'roxtar_setting[header_transparent_disable_index]',
				'roxtar_setting[header_transparent_disable_page]',
				'roxtar_setting[header_transparent_disable_post]',
				'roxtar_setting[header_transparent_disable_shop]',
				'roxtar_setting[header_transparent_disable_product]',
				'roxtar_setting[header_transparent_enable_on]',
				'header_transparent_border_divider',
				'roxtar_setting[header_transparent_border_width]',
				'roxtar_setting[header_transparent_border_color]',
				'roxtar_setting[header_transparent_logo]',
				'roxtar_setting[header_transparent_menu_color]',
				'roxtar_setting[header_transparent_icon_color]',
				'roxtar_setting[header_transparent_count_background]'
			]
		);

		// PAGE HEADER
		// Enable page header.
		condition(
			'roxtar_setting[page_header_display]',
			[
				'roxtar_setting[page_header_title]',
				'roxtar_setting[page_header_breadcrumb]',
				'roxtar_setting[page_header_text_align]',
				'roxtar_setting[page_header_title_color]',
				'roxtar_setting[page_header_background_image]',
				'roxtar_setting[page_header_background_image_size]',
				'roxtar_setting[page_header_background_image_position]',
				'roxtar_setting[page_header_background_image_repeat]',
				'roxtar_setting[page_header_background_image_attachment]',
				'page_header_breadcrumb_divider',
				'page_header_title_color_divider',
				'page_header_spacing_divider',
				'roxtar_setting[page_header_breadcrumb_text_color]',
				'roxtar_setting[page_header_padding_top]',
				'roxtar_setting[page_header_padding_bottom]',
				'roxtar_setting[page_header_margin_bottom]'
			]
		);

		// Background image.
		subCondition(
			'roxtar_setting[page_header_background_image]',
			[
				'roxtar_setting[page_header_background_image_size]',
				'roxtar_setting[page_header_background_image_position]',
				'roxtar_setting[page_header_background_image_repeat]',
				'roxtar_setting[page_header_background_image_attachment]'
			],
			'',
			false,
			[
				'roxtar_setting[page_header_display]',
				true
			]
		);
		// And trigger if parent control update.
		wp.customize( 'roxtar_setting[page_header_display]', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					subCondition(
						'roxtar_setting[page_header_background_image]',
						[
							'roxtar_setting[page_header_background_image_size]',
							'roxtar_setting[page_header_background_image_position]',
							'roxtar_setting[page_header_background_image_repeat]',
							'roxtar_setting[page_header_background_image_attachment]'
						],
						'',
						false,
						[
							'roxtar_setting[page_header_display]',
							true
						]
					);
				}
			} );
		} );

		// SHOP.
		// Position Add to cart.
		condition(
			'roxtar_setting[shop_page_add_to_cart_button_position]',
			[
				'roxtar_setting[shop_product_add_to_cart_icon]',
			],
			[ 'icon', 'none' ],
			false
		);

		// Equal product content.
		condition(
			'roxtar_setting[shop_page_product_content_equal]',
			[
				'roxtar_setting[shop_page_product_content_min_height]',
			],
			false
		);

		// Equal image height.
		condition(
			'roxtar_setting[shop_page_product_image_equal_height]',
			[
				'roxtar_setting[shop_page_product_image_height]',
			],
			false
		);

		// Sale square.
		condition(
			'roxtar_setting[shop_page_sale_square]',
			[
				'roxtar_setting[shop_page_sale_size]',
			],
			false
		);

		// Out of stock square.
		condition(
			'roxtar_setting[shop_page_out_of_stock_square]',
			[
				'roxtar_setting[shop_page_out_of_stock_size]',
			],
			false
		);

		// Product card border.
		condition(
			'roxtar_setting[shop_page_product_card_border_style]',
			[
				'roxtar_setting[shop_page_product_card_border_width]',
				'roxtar_setting[shop_page_product_card_border_color]',
			],
			'none'
		);

		// Product image border.
		condition(
			'roxtar_setting[shop_page_product_image_border_style]',
			[
				'roxtar_setting[shop_page_product_image_border_width]',
				'roxtar_setting[shop_page_product_image_border_color]',
			],
			'none'
		);

		// SHOP SINGLE.
		// Product related.
		condition(
			'roxtar_setting[shop_single_related_product]',
			[
				'roxtar_setting[shop_single_product_related_total]',
				'roxtar_setting[shop_single_product_related_columns]',
			],
			false
		);

		// Gallery layout.
		condition(
			'roxtar_setting[shop_single_gallery_layout]',
			[
				'roxtar_setting[shop_single_product_sticky_top_space]',
				'roxtar_setting[shop_single_product_sticky_bottom_space]',
			],
			'column',
			true
		);

		// Product Single Button Add To Cart.
		condition(
			'roxtar_setting[shop_single_product_button_cart]',
			[
				'roxtar_setting[shop_single_button_cart_background]',
				'roxtar_setting[shop_single_button_cart_color]',
				'roxtar_setting[shop_single_button_background_hover]',
				'roxtar_setting[shop_single_button_color_hover]',
			],
			false
		);


		// Product recently viewed.
		condition(
			'roxtar_setting[shop_single_product_recently_viewed]',
			[
				'roxtar_setting[shop_single_recently_viewed_title]',
				'roxtar_setting[shop_single_recently_viewed_count]',
			],
			false
		);

		// FOOTER SECTION.
		condition(
			'roxtar_setting[scroll_to_top]',
			[
				'roxtar_setting[scroll_to_top_background]',
				'roxtar_setting[scroll_to_top_color]',
				'roxtar_setting[scroll_to_top_position]',
				'roxtar_setting[scroll_to_top_border_radius]',
				'roxtar_setting[scroll_to_top_offset_bottom]',
				'roxtar_setting[scroll_to_top_on]',
				'roxtar_setting[scroll_to_top_icon_size]',
			],
			false
		);
		// Disable footer.
		condition(
			'roxtar_setting[footer_display]',
			[
				'roxtar_setting[footer_space]',
				'roxtar_setting[footer_column]',
				'roxtar_setting[footer_background_color]',
				'roxtar_setting[footer_heading_color]',
				'roxtar_setting[footer_link_color]',
				'roxtar_setting[footer_text_color]',
				'roxtar_setting[footer_custom_text]',
				'footer_text_divider',
				'footer_background_color_divider'
			]
		);
	} );

}( wp.customize ) );
