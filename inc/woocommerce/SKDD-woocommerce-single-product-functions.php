<?php
/**
 * Single Product template functions
 *
 * @package SKDD
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'SKDD_get_prev_product' ) ) {
	/**
	 * Retrieves the previous product.
	 *
	 * @param bool         $in_same_term   Optional. Whether post should be in a same taxonomy term. Default false.
	 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
	 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
	 * @return WC_Product|false Product object if successful. False if no valid product is found.
	 */
	function SKDD_get_prev_product( $in_same_term = true, $excluded_terms = '', $taxonomy = 'product_cat' ) {
		$product = new SKDD_Adjacent_Products( $in_same_term, $excluded_terms, $taxonomy, true );
		return $product->get_product();
	}
}

if ( ! function_exists( 'SKDD_get_next_product' ) ) {
	/**
	 * Retrieves the next product.
	 *
	 * @param bool         $in_same_term   Optional. Whether post should be in a same taxonomy term. Default false.
	 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
	 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
	 * @return WC_Product|false Product object if successful. False if no valid product is found.
	 */
	function SKDD_get_next_product( $in_same_term = true, $excluded_terms = '', $taxonomy = 'product_cat' ) {
		$product = new SKDD_Adjacent_Products( $in_same_term, $excluded_terms, $taxonomy );
		return $product->get_product();
	}
}

if ( ! function_exists( 'SKDD_product_navigation' ) ) {
	/**
	 * Product navigation
	 */
	function SKDD_product_navigation() {
		$prev_product = SKDD_get_prev_product();
		$prev_id      = $prev_product ? $prev_product->get_id() : false;
		$next_product = SKDD_get_next_product();
		$next_id      = $next_product ? $next_product->get_id() : false;

		if ( ! $prev_id && ! $next_id ) {
			return;
		}

		$content = '';
		$classes = '';

		if ( $prev_id ) {
			$classes        = ! $next_id ? 'product-nav-last' : '';
			$prev_icon      = apply_filters( 'SKDD_product_navigation_prev_icon', 'ti-arrow-circle-left' );
			$prev_image_id  = $prev_product->get_image_id();
			$prev_image_src = wp_get_attachment_image_src( $prev_image_id );
			$prev_image_alt = SKDD_image_alt( $prev_image_id, __( 'Previous Product Image', 'SKDD' ) );

			ob_start();
			?>
				<div class="prev-product-navigation product-nav-item">
					<a class="product-nav-item-text" href="<?php echo esc_url( get_permalink( $prev_id ) ); ?>"><span class="product-nav-icon <?php echo esc_attr( $prev_icon ); ?>"></span><?php esc_html_e( 'Previous', 'SKDD' ); ?></a>
					<div class="product-nav-item-content">
						<a class="product-nav-item-link" href="<?php echo esc_url( get_permalink( $prev_id ) ); ?>"></a>
						<?php if ( $prev_image_src ) { ?>
							<img src="<?php echo esc_url( $prev_image_src[0] ); ?>" alt="<?php echo esc_attr( $prev_image_alt ); ?>">
						<?php } ?>
						<div class="product-nav-item-inner">
							<h4 class="product-nav-item-title"><?php echo esc_html( get_the_title( $prev_id ) ); ?></h4>
							<span class="product-nav-item-price"><?php echo wp_kses_post( $prev_product->get_price_html() ); ?></span>
						</div>
					</div>
				</div>
			<?php
			$content .= ob_get_clean();

		}

		if ( $next_id ) {
			$classes        = ! $prev_id ? 'product-nav-first' : '';
			$next_icon      = apply_filters( 'SKDD_product_navigation_next_icon', 'ti-arrow-circle-right' );
			$next_image_id  = $next_product->get_image_id();
			$next_image_src = wp_get_attachment_image_src( $next_image_id );
			$next_image_alt = SKDD_image_alt( $next_image_id, __( 'Next Product Image', 'SKDD' ) );

			ob_start();
			?>
				<div class="next-product-navigation product-nav-item">
					<a class="product-nav-item-text" href="<?php echo esc_url( get_permalink( $next_id ) ); ?>"><?php esc_html_e( 'Next', 'SKDD' ); ?><span class="product-nav-icon <?php echo esc_attr( $next_icon ); ?>"></span></a>
					<div class="product-nav-item-content">
						<a class="product-nav-item-link" href="<?php echo esc_url( get_permalink( $next_id ) ); ?>"></a>
						<div class="product-nav-item-inner">
							<h4 class="product-nav-item-title"><?php echo esc_html( get_the_title( $next_id ) ); ?></h4>
							<span class="product-nav-item-price"><?php echo wp_kses_post( $next_product->get_price_html() ); ?></span>
						</div>
						<?php if ( $next_image_src ) { ?>
							<img src="<?php echo esc_url( $next_image_src[0] ); ?>" alt="<?php echo esc_attr( $next_image_alt ); ?>">
						<?php } ?>
					</div>
				</div>
			<?php
			$content .= ob_get_clean();
		}
		?>

		<div class="skdd-product-navigation <?php echo esc_attr( $classes ); ?>">
			<?php echo $content; // phpcs:ignore ?>
		</div>
		<?php
	}
}


if ( ! function_exists( 'SKDD_remove_additional_information_tabs' ) ) {
	/**
	 * Remove additional information
	 *
	 * @param      array $tabs The tabs.
	 */
	function SKDD_remove_additional_information_tabs( $tabs ) {
		unset( $tabs['additional_information'] );
		return $tabs;
	}
}


if ( ! function_exists( 'SKDD_single_product_gallery_open' ) ) {
	/**
	 * Single gallery product open
	 */
	function SKDD_single_product_gallery_open() {
		$product_id = SKDD_get_product_id();
		$product    = wc_get_product( $product_id );
		$options    = SKDD_options( false );
		$gallery_id = ! empty( $product ) ? $product->get_gallery_image_ids() : array();
		$classes[]  = $options['shop_single_gallery_layout'] . '-style';
		$classes[]  = ! empty( $gallery_id ) ? 'has-product-thumbnails' : '';

		// Global variation gallery.
		SKDD_global_for_vartiation_gallery( $product );
		?>
		<div class="product-gallery <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php
	}
}



if ( ! function_exists( 'SKDD_file_downloads_tabs' ) ) {

	function SKDD_file_downloads_tabs( $tabs ){
	
		//unset( $tabs['inventory'] );
	
		$tabs['SKDD'] = array(
			'label'    => 'Downloads',
			'target'   => 'SKDD_product_data',
			'priority' => 21,
		);
		return $tabs;
	
	}

}


if ( ! function_exists( 'SKDD_get_default_gallery' ) ) {
	/**
	 * Get variation gallery
	 *
	 * @param object $product The product.
	 */
	function SKDD_get_default_gallery( $product ) {
		$images = array();
		if ( empty( $product ) ) {
			return $images;
		}

		$product_id             = $product->get_id();
		$gallery_images         = $product->get_gallery_image_ids();
		$has_default_thumbnails = false;

		if ( ! empty( $gallery_images ) ) {
			$has_default_thumbnails = true;
		}

		if ( has_post_thumbnail( $product_id ) ) {
			array_unshift( $gallery_images, get_post_thumbnail_id( $product_id ) );
		}

		if ( ! empty( $gallery_images ) ) {
			foreach ( $gallery_images as $i => $image_id ) {
				$images[ $i ]                           = wc_get_product_attachment_props( $image_id );
				$images[ $i ]['image_id']               = $image_id;
				$images[ $i ]['has_default_thumbnails'] = $has_default_thumbnails;
			}
		}

		return $images;
	}
}

if ( ! function_exists( 'SKDD_available_variation_gallery' ) ) {
	/**
	 * Available Gallery
	 *
	 * @param array  $available_variation Avaiable Variations.
	 * @param object $variation_product_object Product object.
	 * @param array  $variation Variations.
	 */
	function SKDD_available_variation_gallery( $available_variation, $variation_product_object, $variation ) {
		$product_id         = absint( $variation->get_parent_id() );
		$variation_id       = absint( $variation->get_id() );
		$variation_image_id = absint( $variation->get_image_id() );
		$product            = wc_get_product( $product_id );

		if ( ! $product->is_type( 'variable' ) || ! class_exists( 'WC_Additional_Variation_Images' ) ) {
			return $available_variation;
		}

		$gallery_images = get_post_meta( $variation_id, '_wc_additional_variation_images', true );
		if ( ! $gallery_images ) {
			return $available_variation;
		}
		$gallery_images = explode( ',', $gallery_images );

		if ( $variation_image_id ) {
			// Add Variation Default Image.
			array_unshift( $gallery_images, $variation->get_image_id() );
		} elseif ( has_post_thumbnail( $product_id ) ) {
			// Add Product Default Image.
			array_unshift( $gallery_images, get_post_thumbnail_id( $product_id ) );
		}

		$available_variation['SKDD_variation_gallery_images'] = array();
		foreach ( $gallery_images as $k => $v ) {
			$available_variation['SKDD_variation_gallery_images'][ $k ] = wc_get_product_attachment_props( $v );
		}

		return $available_variation;
	}
}

if ( ! function_exists( 'SKDD_get_variation_gallery' ) ) {
	/**
	 * Get variation gallery
	 *
	 * @param object $product The product.
	 */
	function SKDD_get_variation_gallery( $product ) {
		$images = array();

		if ( ! is_object( $product ) || ! $product->is_type( 'variable' ) ) {
			return $images;
		}

		$variations = array_values( $product->get_available_variations() );
		$key        = class_exists( 'WC_Additional_Variation_Images' ) ? 'SKDD_variation_gallery_images' : 'variation_gallery_images';

		$images = array();
		foreach ( $variations as $k ) {
			if ( ! isset( $k[ $key ] ) ) {
				break;
			}

			array_unshift( $k[ $key ], array( 'variation_id' => $k['variation_id'] ) );
			array_push( $images, $k[ $key ] );
		}

		return $images;
	}
}

if ( ! function_exists( 'SKDD_global_for_vartiation_gallery' ) ) {
	/**
	 * Add global variation
	 *
	 * @param object $product The Product.
	 */
	function SKDD_global_for_vartiation_gallery( $product ) {

		// SKDD Variation gallery.
		wp_localize_script(
			'skdd-product-variation',
			'SKDD_variation_gallery',
			SKDD_get_variation_gallery( $product )
		);

		// SKDD default gallery.
		wp_localize_script(
			'skdd-product-variation',
			'SKDD_default_gallery',
			SKDD_get_default_gallery( $product )
		);
	}
}

if ( ! function_exists( 'SKDD_single_product_gallery_image_slide' ) ) {
	/**
	 * Product gallery product image slider
	 */
	function SKDD_single_product_gallery_image_slide() {
		$product_id = SKDD_get_product_id();
		$product    = wc_get_product( $product_id );

		if ( empty( $product ) ) {
			return;
		}

		$image_id            = $product->get_image_id();
		$image_alt           = SKDD_image_alt( $image_id, esc_attr__( 'Product image', 'SKDD' ) );
		$get_size            = wc_get_image_size( 'shop_catalog' );
		$image_size          = $get_size['width'] . 'x' . ( ! empty( $get_size['height'] ) ? $get_size['height'] : $get_size['width'] );
		$image_medium_src[0] = wc_placeholder_img_src();
		$image_full_src[0]   = wc_placeholder_img_src();
		$image_srcset        = '';

		if ( $image_id ) {
			$image_medium_src = wp_get_attachment_image_src( $image_id, 'woocommerce_single' );
			$image_full_src   = wp_get_attachment_image_src( $image_id, 'full' );
			$image_size       = $image_full_src[1] . 'x' . $image_full_src[2];
			$image_srcset     = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $image_id, 'woocommerce_single' ) : '';
		}

		if ( ! $image_id ) {
			$image_full_src[1] = '800';
			$image_full_src[2] = '800';
		}

		// Gallery.
		$gallery_id = $product->get_gallery_image_ids();
		?>

		<div class="product-images">
			<div id="product-images">
				<figure class="image-item ez-zoom">
					<a href="<?php echo esc_url( $image_full_src[0] ); ?>" data-size="<?php echo esc_attr( $image_size ); ?>" >
						<img width="<?php echo esc_attr( $image_full_src[1] ); ?>" height="<?php echo esc_attr( $image_full_src[2] ); ?>" srcset="<?php echo wp_kses_post( $image_srcset ); ?>" src="<?php echo esc_url( $image_medium_src[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
					</a>
				</figure>
				<?php

				if ( ! empty( $gallery_id ) ) {
					foreach ( $gallery_id as $key ) {
						$g_full_img_src   = wp_get_attachment_image_src( $key, 'full' );
						$g_medium_img_src = wp_get_attachment_image_src( $key, 'woocommerce_single' );
						$g_image_size     = $g_full_img_src[1] . 'x' . $g_full_img_src[2];
						$g_img_alt        = SKDD_image_alt( $key, esc_attr__( 'Product image', 'SKDD' ) );
						$g_img_srcset     = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $key, 'woocommerce_single' ) : '';
						?>
						<figure class="image-item ez-zoom">
							<a href="<?php echo esc_url( $g_full_img_src[0] ); ?>" data-size="<?php echo esc_attr( $g_image_size ); ?>" >
								<img width="<?php echo esc_attr( $g_full_img_src[1] ); ?>" height="<?php echo esc_attr( $g_full_img_src[2] ); ?>"  src="<?php echo esc_url( $g_medium_img_src[0] ); ?>" alt="<?php echo esc_attr( $g_img_alt ); ?>" srcset="<?php echo wp_kses_post( $g_img_srcset ); ?>">
							</a>
						</figure>
						<?php
					}
				}
				?>
			</div>

			<?php do_action( 'SKDD_product_images_box_end' ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'SKDD_single_product_gallery_thumb_slide' ) ) {
	/**
	 * Product gallery product thumbnail slider
	 */
	function SKDD_single_product_gallery_thumb_slide() {
		$options = SKDD_options( false );
		if ( ! in_array( $options['shop_single_gallery_layout'], array( 'vertical', 'horizontal' ), true ) ) {
			return;
		}

		$product_id = SKDD_get_product_id();
		$product    = wc_get_product( $product_id );

		if ( empty( $product ) ) {
			return;
		}

		$image_id        = $product->get_image_id();
		$image_alt       = SKDD_image_alt( $image_id, esc_attr__( 'Product image', 'SKDD' ) );
		$image_small_src = $image_id ? wp_get_attachment_image_src( $image_id, 'woocommerce_gallery_thumbnail' ) : wc_placeholder_img_src();
		$gallery_id      = $product->get_gallery_image_ids();
		?>

		<div class="product-thumbnail-images">
			<?php if ( ! empty( $gallery_id ) ) { ?>
			<div id="product-thumbnail-images">
				<div class="thumbnail-item">
					<img src="<?php echo esc_url( $image_small_src[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
				</div>

				<?php
				foreach ( $gallery_id as $key ) :
					$g_thumb_src = wp_get_attachment_image_src( $key, 'woocommerce_gallery_thumbnail' );
					$g_thumb_alt = SKDD_image_alt( $key, esc_attr__( 'Product image', 'SKDD' ) );
					?>
					<div class="thumbnail-item">
						<img src="<?php echo esc_url( $g_thumb_src[0] ); ?>" alt="<?php echo esc_attr( $g_thumb_alt ); ?>">
					</div>
				<?php endforeach; ?>
			</div>
			<?php } ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'SKDD_single_product_gallery_dependency' ) ) {
	/**
	 * Html markup for photo swipe lightbox
	 */
	function SKDD_single_product_gallery_dependency() {
		// Theme options.
		$options = SKDD_options( false );

		// Photoswipe markup html.
		if ( ! $options['shop_single_image_lightbox'] ) {
			return;
		}

		get_template_part( 'template-parts/content', 'photoswipe' );
	}
}

if ( ! function_exists( 'SKDD_single_product_gallery_close' ) ) {
	/**
	 * Single product gallery close
	 */
	function SKDD_single_product_gallery_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'SKDD_single_product_container_close' ) ) {
	/**
	 * Product container close.
	 */
	function SKDD_single_product_container_close() {
		?>
			</div>
		</div>
		<?php
	}
}


if ( ! function_exists( 'SKDD_single_product_wrapper_summary_open' ) ) {
	/**
	 * Wrapper product summary open
	 */
	function SKDD_single_product_wrapper_summary_open() {
		?>
		<div class="product-summary">
		<?php
	}
}

if ( ! function_exists( 'SKDD_single_product_wrapper_summary_close' ) ) {
	/**
	 * Wrapper product summary close
	 */
	function SKDD_single_product_wrapper_summary_close() {
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'SKDD_modified_quantity_stock' ) ) {
	/**
	 * Modify stock label
	 *
	 * @param string $html    Default html markup.
	 * @param object $product The product.
	 */
	function SKDD_modified_quantity_stock( $html, $product ) {
		$options = SKDD_options( false );
		// Remove quantity stock label if this option disabled.
		$limit = $options['shop_single_stock_product_limit'];

		$stock_quantity = $product->get_stock_quantity();

		// Only for simple product, variable work with javascript.
		if ( $stock_quantity < 1 || $product->is_type( 'variable' ) ) {
			return $html;
		}

		$number = $stock_quantity <= 10 ? $stock_quantity : wp_rand( 10, 75 );
		ob_start();
		if ( $limit >= $number || ! $limit ) {
			?>
				<div class="skdd-single-product-stock stock">

					<?php
					if ( $options['shop_single_stock_label'] ) {
						?>
							<span class="skdd-single-product-stock-label">
								<?php echo esc_html( sprintf( /* translators: %s stock quantity */ __( 'Hurry! only %s left in stock.', 'SKDD' ), $stock_quantity ) ); ?>
							</span>
						<?php
					}

					if ( $options['shop_single_loading_bar'] ) {
						?>
							<div class="skdd-product-stock-progress">
								<span class="skdd-single-product-stock-progress-bar" data-number="<?php echo esc_attr( $number ); ?>"></span>
							</div>
						<?php
					}
					?>

				</div>
			<?php
		}
		return ob_get_clean();
	}
}

if ( ! function_exists( 'SKDD_trust_badge_image' ) ) {
	/**
	 * Trust badge image
	 */
	function SKDD_trust_badge_image() {
		$options   = SKDD_options( false );
		$image_url = $options['shop_single_trust_badge_image'];

		if ( ! $image_url ) {
			return;
		}
		?>
		<div class="skdd-trust-badge-box">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Trust Badge Image', 'SKDD' ); ?>">
		</div>
		<?php
	}
}

if ( ! function_exists( 'SKDD_product_recently_viewed' ) ) {
	/**
	 * Product recently viewed
	 */
	function SKDD_product_recently_viewed() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}

		global $post;
		$options         = SKDD_options( false );
		$viewed_products = array();

		if ( ! empty( $_COOKIE['SKDD_product_recently_viewed'] ) ) {
			$viewed_products = (array) explode( '|', sanitize_text_field( wp_unslash( $_COOKIE['SKDD_product_recently_viewed'] ) ) );
		}

		if ( ! in_array( $post->ID, $viewed_products, true ) ) {
			$viewed_products[] = $post->ID;
		}

		if ( count( $viewed_products ) > $options['shop_single_recently_viewed_count'] ) {
			array_shift( $viewed_products );
		}

		// Store for session only.
		wc_setcookie( 'SKDD_product_recently_viewed', implode( '|', array_filter( $viewed_products ) ) );
	}
}

if ( ! function_exists( 'SKDD_product_recently_viewed_template' ) ) {
	/**
	 * Display product recently viewed
	 */
	function SKDD_product_recently_viewed_template() {
		$options = SKDD_options( false );
		$cookies = isset( $_COOKIE['SKDD_product_recently_viewed'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['SKDD_product_recently_viewed'] ) ) : false;
		if ( ! $cookies || ! $options['shop_single_product_recently_viewed'] || ! is_singular( 'product' ) ) {
			return;
		}

		$ids       = explode( '|', $cookies );
		$args      = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'post__in'       => $ids,
		);

		$products_query = new WP_Query( $args );
		if ( ! $products_query->have_posts() ) {
			return;
		}
		?>

		<div class="skdd-product-recently-viewed-section recently_viewed">
			<div class="recently_viewed_inner">
				<div class="skdd-product-recently-viewed-inner">
					<h2 class="skdd-product-recently-viewed-title"><?php echo esc_html( $options['shop_single_recently_viewed_title'] ); ?></h2>
					<?php
					woocommerce_product_loop_start();

					while ( $products_query->have_posts() ) :
						$products_query->the_post();

						wc_get_template_part( 'content', 'product' );
					endwhile;

					wp_reset_postdata();

					woocommerce_product_loop_end();
					?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'SKDD_ajax_single_add_to_cart' ) ) {
	/**
	 * Ajax single add to cart
	 */
	function SKDD_ajax_single_add_to_cart() {
		check_ajax_referer( 'SKDD_ajax_single_add_to_cart', 'ajax_nonce', false );

		if ( ! isset( $_POST['product_id'] ) || ! isset( $_POST['product_qty'] ) ) {
			wp_send_json_error();
		}

		$product_id        = intval( $_POST['product_id'] );
		$product_qty       = intval( $_POST['product_qty'] );
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $product_qty );
		$variation_id      = isset( $_POST['variation_id'] ) ? intval( $_POST['variation_id'] ) : false;
		$variations        = isset( $_POST['variations'] ) ? (array) json_decode( sanitize_text_field( wp_unslash( $_POST['variations'] ) ), true ) : array();

		// Check stock quantity first.
		$quantities = WC()->cart->get_cart_item_quantities();
		if ( ! empty( $quantities ) ) {
			$pid         = $variation_id ? $variation_id : $product_id;
			$in_cart_qty = isset( $quantities[ $pid ] ) ? $quantities[ $pid ] : 0;
			$stock_count = intval( get_post_meta( $pid, '_stock', true ) );

			if (
				$stock_count &&
				( ( $product_qty + $in_cart_qty ) > $stock_count )
			) {
				$response['mess'] = sprintf( /* translators: stock quantity number */__( 'You cannot add that amount of this product to the cart. We have %1$s in stock and you already have %2$s in your cart', 'SKDD' ), $stock_count, $in_cart_qty );

				wp_send_json_success( $response );
			}
		}

		// For gift_wrap plugin.
		$product_data = isset( $_POST['gift_wrap_data'] ) ? (array) json_decode( sanitize_text_field( wp_unslash( $_POST['gift_wrap_data'] ) ), true ) : array();
		if ( ! empty( $product_data ) && ! empty( $product_data['gift_product_id'] ) ) {
			$gift_product = wc_get_product( $product_data['gift_product_id'] );

			$gift_wrap_data['wcgwp_single_product_selection'] = $gift_product->get_title();
			$gift_wrap_data['wcgwp_single_product_price']     = $gift_product->get_price();

			if ( ! empty( $product_data['gift_product_note'] ) ) {
				$gift_wrap_data['wcgwp_single_product_note'] = $product_data['gift_product_note'];
			}

			// Add to cart.
			if ( $variation_id && $passed_validation ) {
				WC()->cart->add_to_cart( $product_id, $product_qty, $variation_id, $variations, $gift_wrap_data );
			} else {
				WC()->cart->add_to_cart( $product_id, $product_qty, 0, array(), $gift_wrap_data );
			}
		} else {
			// Add to cart.
			if ( $variation_id && $passed_validation ) {
				WC()->cart->add_to_cart( $product_id, $product_qty, $variation_id, $variations );
			} else {
				WC()->cart->add_to_cart( $product_id, $product_qty );
			}
		}

		ob_start();
		SKDD_mini_cart();
		$response['item']    = WC()->cart->get_cart_contents_count();
		$response['total']   = WC()->cart->get_cart_total();
		$response['content'] = ob_get_clean();

		wp_send_json_success( $response );
	}
}




if ( ! function_exists( 'SKDD_single_product_categories' ) ) {
	/**
	 * Display categories
	 */
	function SKDD_single_product_categories() {
		global $product;

		?>

		<table class="woocommerce-product-attributes shop_attributes">
			<tbody>
				<tr class="woocommerce-product-attributes-item">
					<th class="woocommerce-product-attributes-item__label">
						<?php esc_attr_e( 'Category', 'SKDD' ); ?>
					</th>
					<td class="woocommerce-product-attributes-item__value">
						<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
					</td>
				</tr>
			</tbody>
		</table>		

		<?php
	
	}
}


if ( ! function_exists( 'SKDD_single_product_tags' ) ) {
	/**
	 * Display tags
	 */
	function SKDD_single_product_tags() {
		global $product;

		if (!empty(wc_get_product_tag_list($product->get_id()))) { ?>

			<div class="tags">
					
				<p class="header">

					<?php // esc_attr_e( 'This product can be used for:', 'SKDD' ); ?>
					
				</p>

				<?php echo wc_get_product_tag_list( $product->get_id(), $sep = '' ); ?>

			</div>

		<?php }
		
	}
}




if ( ! function_exists( 'skdd_product_image' ) ) {
	
	function skdd_product_image($product) { ?>
		<div class="product_image_wrap">
			<?php 
			
				global $product;
				$attachment_ids = $product->get_gallery_attachment_ids();
				$secondary_image = '';
				if ($attachment_ids) {
					$secondary_image_id = $attachment_ids['0'];
					$secondary_image = wp_get_attachment_image($secondary_image_id, apply_filters('woocommerce_full_size', 'woocommerce_full_size'));
				}

				if (!empty($secondary_image)) { ?>
				
					//echo wp_kses_post($secondary_image);
					
					<img class="fixers_slogan" src="/wp-content/uploads/fixers-jouw-device-zo-gefixt-blauw-oranje-nl.svg">

					<?php 
					
				} else { ?>

					<img class="fixers_slogan" src="/wp-content/uploads/fixers-jouw-device-zo-gefixt-blauw-oranje-nl.svg">
					
					<?php 

					// echo woocommerce_get_product_thumbnail('woocommerce_full_size'); 

				}	
				
			?>

		</div>	
	<?php	
	}
}

if ( ! function_exists( 'skdd_product_info_wrap_open' ) ) {

	function skdd_product_info_wrap_open() { ?>
		<div class="product_info_wrap">				
	<?php	
	}
}

if ( ! function_exists( 'skdd_product_info_wrap_close' ) ) {

	function skdd_product_info_wrap_close() { ?>
		</div>			
	<?php	
	}
}










// Enable Gutenberg editor for WooCommerce
function skdd_activate_gutenberg_product( $can_edit, $post_type ) {
	if ( $post_type == 'product' ) {
		   $can_edit = true;
	   }
	   return $can_edit;
   }
   add_filter( 'use_block_editor_for_post_type', 'skdd_activate_gutenberg_product', 20, 2 );
   
   // enable taxonomy fields for woocommerce with gutenberg on
   function skdd_enable_taxonomy_rest( $args ) {
	   $args['show_in_rest'] = true;
	   return $args;
   }
   add_filter( 'woocommerce_taxonomy_args_product_cat', 'skdd_enable_taxonomy_rest' );
   add_filter( 'woocommerce_taxonomy_args_product_tag', 'skdd_enable_taxonomy_rest' );







	
// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {

    return __( 'Maak nu een afspraak', 'woocommerce' ); 
}
	
	

	



add_action( 'woocommerce_grouped_product_list_before_label', 'wc_grouped_product_thumbnail' );
  
function wc_grouped_product_thumbnail( $product ) {
    $image_size = array( 120, 120 );
    $attachment_id = get_post_meta( $product->get_id(), '_thumbnail_id', true );
    
    ?>
    
    	<?php echo wp_get_attachment_image( $attachment_id, $image_size ); ?>
    
    <?php
}



function skdd_single_product_main_content() { ?>

	<div class="main_content">

		<?php echo the_content(); ?>

	</div>

<?php } ?>