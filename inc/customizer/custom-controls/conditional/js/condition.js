/**
 * SKDD condition control
 *
 * @package SKDD
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
			'SKDD_setting[blog_list_structure]',
			[ 'SKDD_setting[blog_list_post_meta]' ],
			'post-meta'
		);

		// Post single structure.
		arrayCondition(
			'SKDD_setting[blog_single_structure]',
			[ 'SKDD_setting[blog_single_post_meta]' ],
			'post-meta'
		);

		// Topbar.
		condition(
			'SKDD_setting[topbar_display]',
			[
				'SKDD_setting[topbar_text_color]',
				'SKDD_setting[topbar_background_color]',				
				'SKDD_setting[topbar_transparent]',
				'SKDD_setting[topbar_height]',
				'SKDD_setting[topbar_opacity]',
				'topbar_content_divider',
				'SKDD_setting[topbar_left]',
				'SKDD_setting[topbar_center]',
				'SKDD_setting[topbar_right]',
			],
			false
		);

		// CPT.
		condition(
			'SKDD_setting[cpt_portfolio_display]',
			[
				'SKDD_setting[cpt_portfolio_has_archive]',
				'SKDD_setting[cpt_portfolio_has_tax]',
			],
			false
		);

		condition(
			'SKDD_setting[cpt_services_display]',
			[
				'SKDD_setting[cpt_services_has_archive]',
				'SKDD_setting[cpt_services_has_tax]',
			],
			false
		);

		condition(
			'SKDD_setting[cpt_team_display]',
			[
				'SKDD_setting[cpt_team_has_archive]',
				'SKDD_setting[cpt_team_has_tax]',
			],
			false
		);

		condition(
			'SKDD_setting[cpt_knowledge_display]',
			[
				'SKDD_setting[cpt_knowledge_has_archive]',
				'SKDD_setting[cpt_knowledge_has_tax]',
			],
			false
		);

		// Topbar transparency
		condition(
			'SKDD_setting[header_transparent]',
			[
				'SKDD_setting[topbar_opacity]',
			],
			false
		);

		// Search product only.
		condition(
			'SKDD_setting[header_search_icon]',
			['SKDD_setting[header_search_only_product]']
		);

		// HEADER TRANSPARENT SECTION.
		// Enable transparent header.
		condition(
			'SKDD_setting[header_transparent]',
			[
				'SKDD_setting[header_transparent_disable_archive]',
				'SKDD_setting[header_transparent_disable_index]',
				'SKDD_setting[header_transparent_disable_page]',
				'SKDD_setting[header_transparent_disable_post]',
				'SKDD_setting[header_transparent_disable_shop]',
				'SKDD_setting[header_transparent_disable_product]',
				'SKDD_setting[header_transparent_enable_on]',
				'header_transparent_border_divider',
				'SKDD_setting[header_transparent_border_width]',
				'SKDD_setting[header_transparent_border_color]',
				'SKDD_setting[header_transparent_logo]',
				'SKDD_setting[header_transparent_menu_color]',
				'SKDD_setting[header_transparent_icon_color]',
				'SKDD_setting[header_transparent_count_background]'
			]
		);

		// PAGE HEADER
		// Enable page header.
		condition(
			'SKDD_setting[page_header_display]',
			[
				'SKDD_setting[page_header_title]',
				'SKDD_setting[page_header_breadcrumb]',
				'SKDD_setting[page_header_text_align]',
				'SKDD_setting[page_header_title_color]',
				'SKDD_setting[page_header_background_image]',
				'SKDD_setting[page_header_background_image_size]',
				'SKDD_setting[page_header_background_image_position]',
				'SKDD_setting[page_header_background_image_repeat]',
				'SKDD_setting[page_header_background_image_attachment]',
				'page_header_breadcrumb_divider',
				'page_header_title_color_divider',
				'page_header_spacing_divider',
				'SKDD_setting[page_header_breadcrumb_text_color]',
				'SKDD_setting[page_header_padding_top]',
				'SKDD_setting[page_header_padding_bottom]',
				'SKDD_setting[page_header_margin_bottom]'
			]
		);

		// Background image.
		subCondition(
			'SKDD_setting[page_header_background_image]',
			[
				'SKDD_setting[page_header_background_image_size]',
				'SKDD_setting[page_header_background_image_position]',
				'SKDD_setting[page_header_background_image_repeat]',
				'SKDD_setting[page_header_background_image_attachment]'
			],
			'',
			false,
			[
				'SKDD_setting[page_header_display]',
				true
			]
		);
		// And trigger if parent control update.
		wp.customize( 'SKDD_setting[page_header_display]', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					subCondition(
						'SKDD_setting[page_header_background_image]',
						[
							'SKDD_setting[page_header_background_image_size]',
							'SKDD_setting[page_header_background_image_position]',
							'SKDD_setting[page_header_background_image_repeat]',
							'SKDD_setting[page_header_background_image_attachment]'
						],
						'',
						false,
						[
							'SKDD_setting[page_header_display]',
							true
						]
					);
				}
			} );
		} );

		// SHOP.
		// Position Add to cart.
		condition(
			'SKDD_setting[shop_page_add_to_cart_button_position]',
			[
				'SKDD_setting[shop_product_add_to_cart_icon]',
			],
			[ 'icon', 'none' ],
			false
		);

		// Equal product content.
		condition(
			'SKDD_setting[shop_page_product_content_equal]',
			[
				'SKDD_setting[shop_page_product_content_min_height]',
			],
			false
		);

		// Equal image height.
		condition(
			'SKDD_setting[shop_page_product_image_equal_height]',
			[
				'SKDD_setting[shop_page_product_image_height]',
			],
			false
		);

		// Sale square.
		condition(
			'SKDD_setting[shop_page_sale_square]',
			[
				'SKDD_setting[shop_page_sale_size]',
			],
			false
		);

		// Out of stock square.
		condition(
			'SKDD_setting[shop_page_out_of_stock_square]',
			[
				'SKDD_setting[shop_page_out_of_stock_size]',
			],
			false
		);

		// Product card border.
		condition(
			'SKDD_setting[shop_page_product_card_border_style]',
			[
				'SKDD_setting[shop_page_product_card_border_width]',
				'SKDD_setting[shop_page_product_card_border_color]',
			],
			'none'
		);

		// Product image border.
		condition(
			'SKDD_setting[shop_page_product_image_border_style]',
			[
				'SKDD_setting[shop_page_product_image_border_width]',
				'SKDD_setting[shop_page_product_image_border_color]',
			],
			'none'
		);

		// SHOP SINGLE.
		// Product related.
		condition(
			'SKDD_setting[shop_single_related_product]',
			[
				'SKDD_setting[shop_single_product_related_total]',
				'SKDD_setting[shop_single_product_related_columns]',
			],
			false
		);

		// Gallery layout.
		condition(
			'SKDD_setting[shop_single_gallery_layout]',
			[
				'SKDD_setting[shop_single_product_sticky_top_space]',
				'SKDD_setting[shop_single_product_sticky_bottom_space]',
			],
			'column',
			true
		);

		// Product Single Button Add To Cart.
		condition(
			'SKDD_setting[shop_single_product_button_cart]',
			[
				'SKDD_setting[shop_single_button_cart_background]',
				'SKDD_setting[shop_single_button_cart_color]',
				'SKDD_setting[shop_single_button_background_hover]',
				'SKDD_setting[shop_single_button_color_hover]',
			],
			false
		);


		// Product recently viewed.
		condition(
			'SKDD_setting[shop_single_product_recently_viewed]',
			[
				'SKDD_setting[shop_single_recently_viewed_title]',
				'SKDD_setting[shop_single_recently_viewed_count]',
			],
			false
		);

		// FOOTER SECTION.
		condition(
			'SKDD_setting[scroll_to_top]',
			[
				'SKDD_setting[scroll_to_top_background]',
				'SKDD_setting[scroll_to_top_color]',
				'SKDD_setting[scroll_to_top_position]',
				'SKDD_setting[scroll_to_top_border_radius]',
				'SKDD_setting[scroll_to_top_offset_bottom]',
				'SKDD_setting[scroll_to_top_on]',
				'SKDD_setting[scroll_to_top_icon_size]',
			],
			false
		);
		// Disable footer.
		condition(
			'SKDD_setting[footer_display]',
			[
				'SKDD_setting[footer_space]',
				'SKDD_setting[footer_background_color]',
				'SKDD_setting[footer_heading_color]',
				'SKDD_setting[footer_link_color]',
				'SKDD_setting[footer_text_color]',
				'SKDD_setting[footer_custom_text]',
				'footer_text_divider',
				'footer_background_color_divider'
			]
		);
	} );

}( wp.customize ) );
