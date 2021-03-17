<?php
/**
 * WooCommerce Template Functions.
 *
 * @package roxtar
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'roxtar_get_last_product_id' ) ) {
	/**
	 * Get the last ID of product, exclude Group and External Product.
	 */
	function roxtar_get_last_product_id() {
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'tax_query'      => array( // phpcs:ignore
				array(
					array(
						'taxonomy' => 'product_type',
						'field'    => 'slug',
						'terms'    => array( 'simple', 'variable' ),
						'operator' => 'IN',
					),
				),
			),
		);

		$query = new WP_Query( $args );

		$id = false;

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$id = get_the_ID();
			}

			wp_reset_postdata();
		}

		return $id;
	}
}

if ( ! function_exists( 'roxtar_woocommerce_no_js' ) ) {

	function roxtar_woocommerce_no_js() { ?>

		<script>
			(function () {
				var c = document.body.className;
				c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
				document.body.className = c;
			})();
		</script>
			
	<?php }
}

if ( ! function_exists( 'roxtar_ajax_update_quantity_in_mini_cart' ) ) {
	/**
	 * Update product quantity in minicart
	 */
	function roxtar_ajax_update_quantity_in_mini_cart() {
		check_ajax_referer( 'roxtar_woocommerce_general_nonce', 'ajax_nonce', false );

		if ( ! isset( $_POST['key'] ) || ! isset( $_POST['qty'] ) ) {
			wp_send_json_error();
		}

		$response = array();

		$cart_item_key = sanitize_text_field( wp_unslash( $_POST['key'] ) );
		$product_qty   = absint( $_POST['qty'] );

		WC()->cart->set_quantity( $cart_item_key, $product_qty );

		$count = WC()->cart->get_cart_contents_count();

		ob_start();
		$response['item']        = $count;
		$response['total_price'] = WC()->cart->get_cart_total();
		$response['content']     = ob_get_clean();

		wp_send_json_success( $response );
	}
}

if ( ! function_exists( 'roxtar_update_quantity_mini_cart' ) ) {
	/**
	 * Update quantity in mini cart
	 *
	 * @param string $output        Output.
	 * @param array  $cart_item     Cart item.
	 * @param string $cart_item_key Cart item key.
	 */
	function roxtar_update_quantity_mini_cart( $output, $cart_item, $cart_item_key ) {
		$product        = $cart_item['data'];
		$product_id     = $cart_item['product_id'];
		$stock_quantity = $product->get_stock_quantity();
		$product_price  = WC()->cart->get_product_price( $product );

		ob_start();
		?>
		<span class="mini-cart-product-infor">
			<span class="mini-cart-quantity">
				<span class="mini-cart-product-qty ti-minus" data-qty="minus"></span>

				<input type="number" data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>" class="input-text qty" step="1" min="1" max="<?php echo esc_attr( $stock_quantity ? $stock_quantity : '' ); ?>" value="<?php echo esc_attr( $cart_item['quantity'] ); ?>" inputmode="numeric">

				<span class="mini-cart-product-qty ti-plus" data-qty="plus"></span>
			</span>

			<span class="mini-cart-product-price"><?php echo wp_kses_post( $product_price ); ?></span>
		</span>
		<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'roxtar_ajax_update_checkout' ) ) {
	/**
	 * Update checkout
	 */
	function roxtar_ajax_update_checkout() {
		check_ajax_referer( 'roxtar_update_checkout_nonce', 'ajax_nonce', false );

		WC()->cart->calculate_totals();
		$wc_total = WC()->cart->get_totals();

		$res['content_total'] = wc_price( $wc_total['cart_contents_total'] );
		$res['cart_total']    = wc_price( $wc_total['total'] );

		wp_send_json_success( $res );
	}
}

if ( ! function_exists( 'roxtar_before_content' ) ) {
	/**
	 * Before Content
	 * Wraps all WooCommerce content in wrappers which match the theme markup
	 *
	 * @return  void
	 */
	function roxtar_before_content() {
		$class = apply_filters( 'roxtar_site_main_class', 'site-main' );
		?>
		<div id="primary" class="content-area">
			<main id="main" class="<?php echo esc_attr( $class ); ?>">
			<?php
	}
}

if ( ! function_exists( 'roxtar_after_content' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 *
	 * @return  void
	 */
	function roxtar_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		do_action( 'roxtar_sidebar' );
	}
}

if ( ! function_exists( 'roxtar_sorting_wrapper' ) ) {
	/**
	 * Sorting wrapper
	 *
	 * @return  void
	 */
	function roxtar_sorting_wrapper() {
		echo '<div class="roxtar-sorting">';
	}
}

if ( ! function_exists( 'roxtar_sorting_wrapper_close' ) ) {
	/**
	 * Sorting wrapper close
	 *
	 * @return  void
	 */
	function roxtar_sorting_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'roxtar_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper
	 *
	 * @return  void
	 */
	function roxtar_product_columns_wrapper() {
		$columns = wc_get_loop_prop( 'columns' );
		echo '<div class="columns-' . esc_attr( $columns ) . '">';
	}
}

if ( ! function_exists( 'roxtar_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close
	 *
	 * @return  void
	 */
	function roxtar_product_columns_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'roxtar_shop_messages' ) ) {
	/**
	 * Roxtar shop messages
	 *
	 * @uses    roxtar_do_shortcode
	 */
	function roxtar_shop_messages() {
		if ( is_checkout() ) {
			return;
		}

		echo do_shortcode( '[woocommerce_messages]' );
	}
}

if ( ! function_exists( 'roxtar_woocommerce_pagination' ) ) {
	/**
	 * Roxtar WooCommerce Pagination
	 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
	 * but since Roxtar adds pagination before that function is excuted we need a separate function to
	 * determine whether or not to display the pagination.
	 */
	function roxtar_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

if ( ! function_exists( 'roxtar_mini_cart' ) ) {
	/**
	 * Mini cart
	 */
	function roxtar_mini_cart() {
		if ( ! roxtar_is_woocommerce_activated() ) {
			return;
		}

		do_action( 'woocommerce_before_mini_cart' );

		if ( ! WC()->cart->is_empty() ) {
			?>
			<ul class="woocommerce-mini-cart cart_list product_list_widget">
				<?php
				do_action( 'woocommerce_before_mini_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					// $bundled_cart_items = wc_pb_get_bundled_cart_items( $cart_item ); This is template code.

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
						$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
						$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<li class="woocommerce-mini-cart-item mini_cart_item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
							<?php
							echo apply_filters( // phpcs:ignore
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'roxtar' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								),
								$cart_item_key
							);
							?>
							<?php if ( empty( $product_permalink ) ) : ?>
								<?php echo $thumbnail . $product_name; // phpcs:ignore ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>">
									<?php echo $thumbnail . $product_name; // phpcs:ignore ?>
								</a>
							<?php endif; ?>
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore ?>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore ?>
						</li>
						<?php
					}
				}

				do_action( 'woocommerce_mini_cart_contents' );
				?>
			</ul>

			<p class="woocommerce-mini-cart__total total">
				<?php
				/**
				 * Hook: woocommerce_widget_shopping_cart_total.
				 *
				 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
				 */
				do_action( 'woocommerce_widget_shopping_cart_total' );
				?>
			</p>

			<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

			<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

			<?php
			do_action( 'woocommerce_widget_shopping_cart_after_buttons' );
		} else {
			?>
			<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'roxtar' ); ?></p>
			<?php
		}

		do_action( 'woocommerce_after_mini_cart' );
	}
}

if ( ! function_exists( 'roxtar_woocommerce_cart_sidebar' ) ) {
	/**
	 * Cart sidebar
	 */
	function roxtar_woocommerce_cart_sidebar() {
		$total = WC()->cart->cart_contents_count;
		?>
			<div id="shop-cart-sidebar">
				<div class="cart-sidebar-head">
					<h4 class="cart-sidebar-title"><?php esc_html_e( 'Shopping cart', 'roxtar' ); ?></h4>
					<span class="shop-cart-count"><?php echo esc_html( $total ); ?></span>
					<button id="close-cart-sidebar-btn" class="ti-close"></button>
				</div>

				<div class="cart-sidebar-content">
					<?php roxtar_mini_cart(); ?>
				</div>
			</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_modify_loop_add_to_cart_class' ) ) {
	/**
	 * Modify loop add to cart class name
	 */
	function roxtar_modify_loop_add_to_cart_class() {
		global $product;
		$options      = roxtar_options( false );
		$button_class = 'loop-add-to-cart-btn';
		$icon_class   = '';
		if (
			( ! in_array( $options['shop_page_add_to_cart_button_position'], array( 'none', 'icon' ), true ) && $options['shop_product_add_to_cart_icon'] ) ||
			'icon' === $options['shop_page_add_to_cart_button_position']
		) {
			$icon_class = apply_filters( 'roxtar_pro_loop_add_to_cart_icon', 'custom-shopping-cart' );
		}

		if ( 'image' === $options['shop_page_add_to_cart_button_position'] ) {
			$button_class = 'loop-add-to-cart-on-image';
		} elseif ( 'icon' === $options['shop_page_add_to_cart_button_position'] ) {
			$button_class = 'loop-add-to-cart-icon-btn';
		}

		$args = array(
			'class'      => implode(
				' ',
				array_filter(
					array(
						$icon_class,
						$button_class,
						'button',
						'product_type_' . $product->get_type(),
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
					)
				)
			),
			'attributes' => array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'title'            => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			),
		);

		return $args;
	}
}

if ( ! function_exists( 'roxtar_is_woocommerce_page' ) ) {
	/**
	 * Returns true if on a page which uses WooCommerce templates
	 * Cart and Checkout are standard pages with shortcodes and which are also included
	 */
	function roxtar_is_woocommerce_page() {
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			return true;
		}

		$keys = array(
			'woocommerce_shop_page_id',
			'woocommerce_terms_page_id',
			'woocommerce_cart_page_id',
			'woocommerce_checkout_page_id',
			'woocommerce_pay_page_id',
			'woocommerce_thanks_page_id',
			'woocommerce_myaccount_page_id',
			'woocommerce_edit_address_page_id',
			'woocommerce_view_order_page_id',
			'woocommerce_change_password_page_id',
			'woocommerce_logout_page_id',
			'woocommerce_lost_password_page_id',
		);

		foreach ( $keys as $k ) {
			if ( get_the_ID() === get_option( $k, 0 ) ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'roxtar_modifided_woocommerce_breadcrumb' ) ) {
	/**
	 * Modify breadcrumb item
	 *
	 * @param      array $default The breadcrumb item.
	 */
	function roxtar_modifided_woocommerce_breadcrumb( $default ) {
		$default['delimiter']   = '<span class="item-bread delimiter">' . apply_filters( 'roxtar_breadcrumb_delimiter', '&#47;' ) . '</span>';
		$default['wrap_before'] = '<nav class="roxtar-breadcrumb">';
		$default['wrap_after']  = '</nav>';
		$default['before']      = '<span class="item-bread">';
		$default['after']       = '</span>';

		return $default;
	}
}

if ( ! function_exists( 'roxtar_get_modifided_woocommerce_breadcrumb' ) ) {
	/**
	 * Woocommerce crumbs
	 *
	 * @param      array $crumbs The woocommerce crumbs.
	 */
	function roxtar_get_modifided_woocommerce_breadcrumb( $crumbs ) {
		$home = array(
			0 => apply_filters( 'roxtar_breadcrumb_home', __( 'Home', 'roxtar' ) ),
			1 => get_home_url( '/' ),
		);

		$blog = array(
			0 => apply_filters( 'roxtar_breadcrumb_blog', __( 'News', 'roxtar' ) ),
			1 => get_permalink( get_option( 'page_for_posts' ) ),
		);

		$shop = array(
			0 => apply_filters( 'roxtar_breadcrumb_shop', __( 'Products', 'roxtar' ) ),
			1 => roxtar_is_woocommerce_activated() ? wc_get_page_permalink( 'shop' ) : '#',
		);

		if ( is_tag() || is_category() || is_singular( 'post' ) ) {
			// For all blog page.
			array_splice( $crumbs, 0, 1, array( $home, $blog ) );
		} elseif ( roxtar_is_woocommerce_activated() && ( is_product_tag() || is_singular( 'product' ) || is_product_category() ) ) {
			//For all shop page.
			//array_splice( $crumbs, 0, 1, array( $home, $shop ) );
		} elseif ( is_checkout() ) {
			//do not show breadcrumb on checkout pages
			return;
		}

		return $crumbs;
	}
}

if ( ! function_exists( 'roxtar_breadcrumb_for_product_page' ) ) {
	/**
	 * Add breadcrumb for Product page
	 */
	function roxtar_breadcrumb_for_product_page() {
		
	}
}


if ( ! function_exists( 'custom_rank_math_the_breadcrumbs' ) ) {
	/**
	 * Custom rankmath breadcrumbs
	 */
	function custom_rank_math_the_breadcrumbs() {
		// Hooked to `roxtar_content_top` only Product page.
		if ( ! is_singular( 'product' ) ) {
			return;
		}

		$options = roxtar_options( false );

		if ( $options['shop_single_breadcrumb'] ) {
			
			add_action( 'roxtar_content_top', 'rank_math_the_breadcrumbs', 40 );
			
		}

		if ( $options['shop_single_product_navigation'] ) {
			add_action( 'roxtar_content_top', 'roxtar_product_navigation', 50 );
		}	
	}
}


if ( ! function_exists( 'roxtar_related_products_args' ) ) {
	/**
	 * Related Products Args
	 *
	 * @param  array $args related products args.
	 * @return  array $args related products args
	 */
	function roxtar_related_products_args( $args ) {
		$options = roxtar_options( false );
		$args    = apply_filters(
			'roxtar_related_products_args',
			array(
				'posts_per_page' => $options['shop_single_product_related_total'],
				'columns'        => $options['shop_single_product_related_columns'],
			)
		);

		return $args;
	}
}

if ( ! function_exists( 'roxtar_change_woocommerce_arrow_pagination' ) ) {
	/**
	 * Change arrow for pagination
	 *
	 * @param array $args Woocommerce pagination.
	 */
	function roxtar_change_woocommerce_arrow_pagination( $args ) {
		$args['prev_text'] = __( 'Previous', 'roxtar' );
		$args['next_text'] = __( 'Next', 'roxtar' );
		return $args;
	}
}

if ( ! function_exists( 'roxtar_product_out_of_stock' ) ) {
	/**
	 * Check product out of stock
	 *
	 * @param      object $product The product.
	 */
	function roxtar_product_out_of_stock( $product ) {
		if ( ! $product || ! is_object( $product ) ) {
			return false;
		}

		$in_stock     = $product->is_in_stock();
		$manage_stock = $product->managing_stock();
		$quantity     = $product->get_stock_quantity();

		if (
			( $product->is_type( 'simple' ) && ( ! $in_stock || ( $manage_stock && 0 === $quantity ) ) ) ||
			( $product->is_type( 'variable' ) && $manage_stock && 0 === $quantity )
		) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'roxtar_print_out_of_stock_label' ) ) {
	/**
	 * Print out of stock label
	 */
	function roxtar_print_out_of_stock_label() {
		global $product;
		$out_of_stock = get_post_meta( get_the_ID(), '_stock_status', true );
		$options      = roxtar_options( false );

		if ( ! $out_of_stock || 'none' === $options['shop_page_out_of_stock_position'] ) {
			return;
		}

		$is_square = $options['shop_page_out_of_stock_square'] ? 'is-square' : '';

		if ( $product->backorders_allowed() ) {
			return;
		}

		if ( 'outofstock' === $out_of_stock ) {
			?>
			<span class="roxtar-out-of-stock-label position-<?php echo esc_attr( $options['shop_page_out_of_stock_position'] ); ?> <?php echo esc_attr( $is_square ); ?>"><?php echo esc_html( $options['shop_page_out_of_stock_text'] ); ?></span>
			<?php
		}
	}
}

if ( ! function_exists( 'roxtar_change_sale_flash' ) ) {
	/**
	 * Change sale flash
	 */
	function roxtar_change_sale_flash() {
		global $product;
		if ( empty( $product ) ) {
			return;
		}
		$options      = roxtar_options( false );
		$sale         = $product->is_on_sale();
		$price_sale   = $product->get_sale_price();
		$price        = $product->get_regular_price();
		$simple       = $product->is_type( 'simple' );
		$variable     = $product->is_type( 'variable' );
		$external     = $product->is_type( 'external' );
		$sale_text    = $options['shop_page_sale_text'];
		$sale_percent = $options['shop_page_sale_percent'];
		$final_price  = '';
		$out_of_stock = roxtar_product_out_of_stock( $product );

		// Out of stock.
		if ( $out_of_stock ) {
			return;
		}

		if ( $sale ) {
			// For simple product.
			if ( $simple || $external ) {
				if ( $sale_percent ) {
					$final_price = ( ( $price - $price_sale ) / $price ) * 100;
					$final_price = '-' . round( $final_price ) . '%';
				} elseif ( $sale_text ) {
					$final_price = $sale_text;
				}
			} elseif ( $variable && $sale_text ) {
				// For variable product.
				$final_price = $sale_text;
			}

			if ( ! $final_price ) {
				return;
			}

			$classes[] = 'roxtar-tag-on-sale onsale';
			$classes[] = 'sale-' . $options['shop_page_sale_tag_position'];
			$classes[] = $options['shop_page_sale_square'] ? 'is-square' : '';
			?>
			<span class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
				<?php echo esc_html( $final_price ); ?>
			</span>
			<?php
		}
	}
}

if ( ! function_exists( 'roxtar_product_video_button_play' ) ) {
	/**
	 * Add button play video lightbox for product
	 */
	function roxtar_product_video_button_play() {
		global $product;
		if ( ! $product || ! is_object( $product ) ) {
			return;
		}

		$product_id = $product->get_id();
		$video_url  = roxtar_get_metabox( $product_id, 'roxtar_product_video_metabox' );

		if ( 'default' !== $video_url ) {
			?>
			<a href="<?php echo esc_url( $video_url ); ?>" data-lity class="ti-control-play roxtar-lightbox-button"></a>
			<?php
		}
	}
}

if ( ! function_exists( 'roxtar_content_fragments' ) ) {
	/**
	 * Update content via ajax
	 *
	 * @param      array $fragments Fragments to refresh via AJAX.
	 * @return     array $fragments Fragments to refresh via AJAX
	 */
	function roxtar_content_fragments( $fragments ) {
		$options         = roxtar_options( false );
		$cart_item_count = WC()->cart->cart_contents_count;

		// Get mini cart content.
		ob_start();
		roxtar_mini_cart();
		$mini_cart = ob_get_clean();

		// Cart item count.
		$fragments['span.shop-cart-count'] = sprintf( '<span class="shop-cart-count">%s</span>', $cart_item_count );

		// Cart sidebar.
		$fragments['div.cart-sidebar-content'] = sprintf( '<div class="cart-sidebar-content">%s</div>', $mini_cart );

		// Wishlist counter.
		if ( 'ti' === $options['shop_page_wishlist_support_plugin'] && function_exists( 'tinv_get_option' ) && tinv_get_option( 'topline', 'show_counter' ) ) {
			$fragments['span.theme-item-count.wishlist-item-count'] = sprintf( '<span class="theme-item-count wishlist-item-count">%s</span>', roxtar_get_wishlist_count() );
		}

		return $fragments;
	}
}

if ( ! function_exists( 'roxtar_woocommerce_loop_start' ) ) {
	/**
	 * Modify: Loop start
	 *
	 * @param string $loop_start The loop start.
	 */
	function roxtar_woocommerce_loop_start( $loop_start ) {
		if ( defined( 'KADENCE_BLOCKS_VERSION' ) ) {
			return $loop_start;
		}

		$options = roxtar_options( false );
		$class[] = 'products';
		$class[] = 'columns-' . wc_get_loop_prop( 'columns' );
		$class[] = 'tablet-columns-' . $options['tablet_products_per_row'];
		$class[] = 'mobile-columns-' . $options['mobile_products_per_row'];
		$class   = implode( ' ', $class );
		?>
		<ul class="<?php echo esc_attr( apply_filters( 'roxtar_product_catalog_columns', $class ) ); ?>">
		<?php

		// If displaying categories, append to the loop.
		$loop_html = woocommerce_maybe_show_product_subcategories();
		echo $loop_html; // phpcs:ignore
	}
}

if ( ! function_exists( 'roxtar_products_per_row' ) ) {
	/**
	 * Products per row
	 */
	function roxtar_products_per_row() {
		$options = roxtar_options( false );

		return $options['products_per_row'];
	}
}

if ( ! function_exists( 'roxtar_products_per_page' ) ) {
	/**
	 * Products per page
	 */
	function roxtar_products_per_page() {
		$options = roxtar_options( false );

		return $options['products_per_page'];
	}
}

if ( ! function_exists( 'roxtar_product_loop_item_add_to_cart_icon' ) ) {
	/**
	 * Add to cart icon
	 */
	function roxtar_product_loop_item_add_to_cart_icon() {
		$options = roxtar_options( false );
		if ( 'icon' !== $options['shop_page_add_to_cart_button_position'] ) {
			return;
		}

		roxtar_modified_add_to_cart_button();
	}
}

if ( ! function_exists( 'roxtar_product_loop_item_wishlist_icon' ) ) {
	/**
	 * Product loop wishlist icon
	 */
	function roxtar_product_loop_item_wishlist_icon() {
		$options = roxtar_options( false );
		if ( 'top-right' !== $options['shop_page_wishlist_position'] || ! roxtar_support_wishlist_plugin() ) {
			return;
		}

		$shortcode = ( 'ti' === $options['shop_page_wishlist_support_plugin'] ) ? '[ti_wishlists_addtowishlist]' : '[yith_wcwl_add_to_wishlist]';

		echo do_shortcode( $shortcode );
	}
}

if ( ! function_exists( 'roxtar_detect_clear_cart_submit' ) ) {
	/**
	 * Clear cart button.
	 */
	function roxtar_detect_clear_cart_submit() {
		global $woocommerce;

		if ( isset( $_GET['empty-cart'] ) ) { // phpcs:ignore
			$woocommerce->cart->empty_cart();
		}
	}
}

if ( ! function_exists( 'roxtar_remove_woocommerce_shop_title' ) ) {
	/**
	 * Removes a woocommerce shop title.
	 */
	function roxtar_remove_woocommerce_shop_title() {
		return false;
	}
}

if ( ! function_exists( 'roxtar_change_cross_sells_total' ) ) {
	/**
	 * Change cross sell total
	 *
	 * @param      int $limit  The total product.
	 */
	function roxtar_change_cross_sells_total( $limit ) {
		return 4;
	}
}

if ( ! function_exists( 'roxtar_change_cross_sells_columns' ) ) {
	/**
	 * Change cross sell column
	 *
	 * @param      int $columns  The columns.
	 */
	function roxtar_change_cross_sells_columns( $columns ) {
		return 2;
	}
}

if ( ! function_exists( 'roxtar_add_product_thumbnail_to_checkout_order' ) ) {
	/**
	 * Add thumbnail image for checkout detail
	 *
	 * @param      string       $product_name   The product name.
	 * @param      array|object $cart_item      The cartesian item.
	 * @param      string       $cart_item_key  The cartesian item key.
	 */
	function roxtar_add_product_thumbnail_to_checkout_order( $product_name, $cart_item, $cart_item_key ) {
		$options             = roxtar_options( false );
		$multi_step_checkout = roxtar_is_multi_checkout();
		if ( ! is_checkout() || ! ( $options['checkout_multi_step'] && $multi_step_checkout && ! is_singular( array( 'cartflows_flow', 'cartflows_step' ) ) ) ) {
			return $product_name;
		}

		$data      = $cart_item['data'];
		$image_id  = ! empty( $data ) ? $data->get_image_id() : false;
		$image_alt = roxtar_image_alt( $image_id, __( 'Product Image', 'roxtar' ) );
		$image_src = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : wc_placeholder_img_src();

		ob_start();
		?>
		<img class="review-order-product-image" src="<?php echo esc_url( wp_get_attachment_image_url( $image_id ) ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">

		<span class="review-order-product-name">
			<?php echo wp_kses_post( $product_name ); ?>
		</span>
		<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'roxtar_check_shipping_method' ) ) {
	/**
	 * Check shipping method
	 */
	function roxtar_check_shipping_method() {
		if ( ! roxtar_is_woocommerce_activated() ) {
			return false;
		}

		return WC()->cart->needs_shipping() && WC()->cart->show_shipping();
	}
}

if ( ! function_exists( 'roxtar_is_multi_checkout' ) ) {
	/**
	 * Detect multi checkout page
	 */
	function roxtar_is_multi_checkout() {
		if ( ! roxtar_is_woocommerce_activated() || is_singular( array( 'cartflows_flow', 'cartflows_step' ) ) ) {
			return false;
		}

		$options = roxtar_options( false );
		return ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && ! is_wc_endpoint_url( 'order-pay' ) && $options['checkout_multi_step'] );
	}
}

if ( ! function_exists( 'roxtar_multi_step_checkout' ) ) {
	/**
	 * Multi step checkout
	 */
	function roxtar_multi_step_checkout() {
		$disable_multi_step = apply_filters( 'roxtar_disable_multi_step_checkout', false );

		if ( $disable_multi_step || ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>

		<div class="multi-step-checkout checkout">
			<div class="checkout_inner">
				<div class="multi-step-inner">
					<span class="multi-step-item active" data-state="billing">
						<span class="item-text"><?php esc_html_e( 'Billing Details', 'roxtar' ); ?></span>
					</span>

					<span class="multi-step-item" data-state="delivery">
						<span class="item-text"><?php esc_html_e( 'Delivery', 'roxtar' ); ?></span>
					</span>

					<span class="multi-step-item" data-state="payment">
						<span class="item-text"><?php esc_html_e( 'Payment', 'roxtar' ); ?></span>
					</span>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_multi_checkout_wrapper_start' ) ) {
	/**
	 * Wrapper start
	 */
	function roxtar_multi_checkout_wrapper_start() {
		if ( ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>
		<div class="multi-step-checkout-wrapper first">
		<?php
	}
}

if ( ! function_exists( 'roxtar_multi_checkout_wrapper_end' ) ) {
	/**
	 * First step end
	 */
	function roxtar_multi_checkout_wrapper_end() {
		if ( ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_multi_checkout_first_wrapper_start' ) ) {
	/**
	 * First wrapper start
	 */
	function roxtar_multi_checkout_first_wrapper_start() {
		if ( ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>
		<div class="multi-step-checkout-content active" data-step="first">
		<?php
	}
}

if ( ! function_exists( 'roxtar_multi_checkout_first_wrapper_end' ) ) {
	/**
	 * First wrapper end
	 */
	function roxtar_multi_checkout_first_wrapper_end() {
		if ( ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_multi_checkout_second' ) ) {
	/**
	 * Second step
	 */
	function roxtar_multi_checkout_second() {
		if ( ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>

		<div class="multi-step-checkout-content" data-step="second">
			<div class="multi-step-review-information">
				<div class="multi-step-review-information-row" data-type="email">
					<div class="review-information-inner">
						<div class="review-information-label"><?php esc_html_e( 'Contact', 'roxtar' ); ?></div>
						<div class="review-information-content"></div>
					</div>
					<span class="review-information-link"><?php esc_html_e( 'Change', 'roxtar' ); ?></span>
				</div>

				<div class="multi-step-review-information-row" data-type="address">
					<div class="review-information-inner">
						<div class="review-information-label"><?php esc_html_e( 'Address', 'roxtar' ); ?></div>
						<div class="review-information-content"></div>
					</div>
					<span class="review-information-link"><?php esc_html_e( 'Change', 'roxtar' ); ?></span>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_multi_checkout_third' ) ) {
	/**
	 * Third step
	 */
	function roxtar_multi_checkout_third() {
		if ( ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>
		<div class="multi-step-checkout-content" data-step="last">
			<div class="multi-step-review-information">
				<div class="multi-step-review-information-row" data-type="email">
					<div class="review-information-inner">
						<div class="review-information-label"><?php esc_html_e( 'Contact', 'roxtar' ); ?></div>
						<div class="review-information-content"></div>
					</div>
					<span class="review-information-link"><?php esc_html_e( 'Change', 'roxtar' ); ?></span>
				</div>

				<div class="multi-step-review-information-row" data-type="address">
					<div class="review-information-inner">
						<div class="review-information-label"><?php esc_html_e( 'Address', 'roxtar' ); ?></div>
						<div class="review-information-content"></div>
					</div>
					<span class="review-information-link"><?php esc_html_e( 'Change', 'roxtar' ); ?></span>
				</div>

				<div class="multi-step-review-information-row" data-type="shipping">
					<div class="review-information-inner">
						<div class="review-information-label"><?php esc_html_e( 'Shipping', 'roxtar' ); ?></div>
						<div class="review-information-content"></div>
					</div>
					<span class="review-information-link"><?php esc_html_e( 'Change', 'roxtar' ); ?></span>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_multi_checkout_button_action' ) ) {
	/**
	 * First step end
	 */
	function roxtar_multi_checkout_button_action() {
		if ( ! roxtar_is_multi_checkout() ) {
			return;
		}
		?>
			<div class="multi-step-checkout-button-wrapper">
				<span class="multi-step-checkout-button ti-angle-left" data-action="back"><?php esc_html_e( 'Back', 'roxtar' ); ?></span>
				<span class="multi-step-checkout-button button" data-action="continue" data-continue="<?php esc_attr_e( 'Continue to', 'roxtar' ); ?>"><?php esc_html_e( 'Continue to Delivery', 'roxtar' ); ?></span>
				<span class="multi-step-checkout-button button" data-action="place_order"><?php esc_html_e( 'Place Order', 'roxtar' ); ?></span>
			</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_checkout_before_order_review' ) ) {
	/**
	 * Before order review
	 */
	function roxtar_checkout_before_order_review() {
		$cart = WC()->cart->get_cart();
		if ( empty( $cart ) || ! roxtar_is_multi_checkout() ) {
			return;
		}

		$cart_count = sprintf( /* translators: 1: single item, 2: plural items */ _n( '%s item', '%s items', count( $cart ), 'roxtar' ), count( $cart ) );
		?>

		<div class="roxtar-before-order-review">
			<div class="roxtar-before-order-review-summary">
				<strong><?php esc_html_e( 'Order Summary', 'roxtar' ); ?></strong>
				<span class="roxtar-before-order-review-cart-count">(<?php echo esc_html( $cart_count ); ?>)</span>
			</div>
			<span class="roxtar-before-order-review-total-price"><?php wc_cart_totals_order_total_html(); ?></span>
			<span class="roxtar-before-order-review-icon ti-angle-down"></span>
		</div>
		<?php
	}
}

if ( ! function_exists( 'custom_template_single_title' ) ) {
	/**
	 * Custom title
	 */
	function custom_template_single_title() {
		?>
			<h1 class="product_title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php
	}
}

if ( ! function_exists( 'custom_template_single_price' ) ) {
	/**
	 * Custom title
	 */
	function custom_template_single_price() {
		$options = roxtar_options( false );
		global $product;
		$price_html = $product->get_price_html();
		
		if ( $options['only_show_price_when_logged_in'] ) {

			if ( is_user_logged_in() ) {
				?>
					<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
					
						<?php echo wp_kses_post( $price_html ); ?>
						
					</p>
				<?php
			} else { ?>
				
			<?php }

		} else {
			?>
				<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
					<?php echo wp_kses_post( $price_html ); ?>
				</p>
			<?php
		}
		
	}
}



if ( ! function_exists( 'custom_template_single_add_to_cart' ) ) {
	/**
	 * Custom title
	 */
	function custom_template_single_add_to_cart() {
		$options = roxtar_options( false );
		global $product;
		
		if ( $options['only_show_price_when_logged_in'] ) {

			if ( is_user_logged_in() ) {
				?>
					<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>					
				<?php
			} else { ?>

				<a href="/<?php esc_html_e( 'register', 'roxtar' ); ?>/" class="not_logged_in_btn button">
					<?php esc_html_e( 'See prices', 'roxtar' ); ?>
				</a>
				
			<?php }

		} else {
			?>

				<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );  ?>
				
			<?php
		}
		
	}
}


if ( ! function_exists( 'custom_template_single_product_weight' ) ) {
	/**
	 * Add 
	 */
	function custom_template_single_product_weight($price) {
		$options = roxtar_options( false );
		global $product;
		
		if ( $options['single_product_weight'] ) {

			$after_price = '<span class="price_per_weight"> / ' . $product->get_weight() . ' kg </span>';

		}
		
		return $price . $after_price;	
		
	}
}