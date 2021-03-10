<?php
/**
 * Roxtar functions.
 *
 * @package roxtar
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backwards compatibility for site WP < 5.2
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'roxtar_version' ) ) {
	/**
	 * Roxtar Version
	 *
	 * @return string Roxtar Version.
	 */
	function roxtar_version() {
		return esc_attr( ROXTAR_VERSION );
	}
}

if ( ! function_exists( 'roxtar_info' ) ) {
	/**
	 * Roxtar Information.
	 *
	 * @param      string $output  The output.
	 */
	function roxtar_info( $output ) {
		$output .= ' data-roxtar-version="' . roxtar_version() . '"';

		return $output;
	}
}

if ( ! function_exists( 'roxtar_suffix' ) ) {
	/**
	 * Define Script debug.
	 *
	 * @return     string $suffix
	 */
	function roxtar_suffix() {
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		return $suffix;
	}
}



if ( ! function_exists( 'roxtar_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function roxtar_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'roxtar_get_product_id' ) ) {
	/**
	 * Get product id
	 */
	function roxtar_get_product_id() {
		$last_product_id = roxtar_get_last_product_id();
		$post            = isset( $_REQUEST['post'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['post'] ) ) : false; // phpcs:ignore
		$editor_post_id  = isset( $_REQUEST['editor_post_id'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['editor_post_id'] ) ) : false; // phpcs:ignore
		$post_id         = $post ? $post : $editor_post_id;
		if ( $post_id ) {
			$selected_id = get_post_meta( $post_id, 'roxtar_woo_builder_select_product_preview', true );

			if ( $selected_id ) {
				$last_product_id = $selected_id;
			}
		}

		$product_id = roxtar_get_page_id();

		return apply_filters( 'roxtar_get_product_id', $product_id );
	}
}

if ( ! function_exists( 'roxtar_sanitize_array' ) ) {
	/**
	 * Sanitize integer value
	 *
	 * @param      array $value  The array.
	 */
	function roxtar_sanitize_array( $value ) {
		$data = array();
		foreach ( $value as $key ) {
			$data[] = sanitize_text_field( $key );
		}

		return $data;
	}
}

if ( ! function_exists( 'roxtar_sanitize_choices' ) ) {
	/**
	 * Sanitizes choices (selects / radios)
	 * Checks that the input matches one of the available choices
	 *
	 * @param array $input the available choices.
	 * @param array $setting the setting object.
	 */
	function roxtar_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

if ( ! function_exists( 'roxtar_sanitize_checkbox' ) ) {
	/**
	 * Checkbox sanitization callback.
	 *
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function roxtar_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
}

if ( ! function_exists( 'roxtar_sanitize_variants' ) ) {
	/**
	 * Sanitize our Google Font variants
	 *
	 * @param      string $input sanitize variants.
	 * @return     sanitize_text_field( $input )
	 */
	function roxtar_sanitize_variants( $input ) {
		if ( is_array( $input ) ) {
			$input = implode( ',', $input );
		}
		return sanitize_text_field( $input );
	}
}

if ( ! function_exists( 'roxtar_sanitize_rgba_color' ) ) {
	/**
	 * Sanitize color || rgba color
	 *
	 * @param      string $color  The color.
	 */
	function roxtar_sanitize_rgba_color( $color ) {
		if ( empty( $color ) || is_array( $color ) ) {
			return '';
		}

		// If string does not start with 'rgba', then treat as hex sanitize the hex color and finally convert hex to rgba.
		if ( false === strpos( $color, 'rgba' ) ) {
			return sanitize_hex_color( $color );
		}

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
	}
}

if ( ! function_exists( 'roxtar_sanitize_int' ) ) {
	/**
	 * Sanitize integer value
	 *
	 * @param      integer $value  The integer number.
	 */
	function roxtar_sanitize_int( $value ) {
		return intval( $value );
	}
}

if ( ! function_exists( 'roxtar_sanitize_raw_html' ) ) {
	/**
	 * Sanitize raw html value
	 *
	 * @param      string $value  The raw html value.
	 */
	function roxtar_sanitize_raw_html( $value ) {
		$content = wp_kses(
			$value,
			array(
				'a'      => array(
					'class'  => array(),
					'href'   => array(),
					'rel'    => array(),
					'title'  => array(),
					'target' => array(),
					'style'  => array(),
				),
				'code'   => array(),
				'div'    => array(
					'class' => array(),
					'style' => array(),
				),
				'em'     => array(),
				'h1'     => array(),
				'h2'     => array(),
				'h3'     => array(),
				'h4'     => array(),
				'h5'     => array(),
				'h6'     => array(),
				'i'      => array(),
				'li'     => array(
					'class' => array(),
				),
				'ul'     => array(
					'class' => array(),
				),
				'ol'     => array(
					'class' => array(),
				),
				'p'      => array(
					'class' => array(),
					'style' => array(),
				),
				'span'   => array(
					'class' => array(),
					'style' => array(),
				),
				'strong' => array(
					'class' => array(),
					'style' => array(),
				),
				'b'      => array(
					'class' => array(),
					'style' => array(),
				),
				'img'    => array(
					'class'  => array(),
					'alt'    => array(),
					'width'  => array(),
					'height' => array(),
					'src'    => array(),
				),
			)
		);

		return $content;
	}
}

if ( ! function_exists( 'roxtar_is_blog' ) ) {
	/**
	 * Roxtar detect blog page
	 *
	 * @return boolean $is_blog
	 */
	function roxtar_is_blog() {
		global $post;

		$post_type = get_post_type( $post );

		$is_blog = ( 'post' === $post_type && ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) ) ? true : false;

		return apply_filters( 'roxtar_is_blog', $is_blog );
	}
}

if ( ! function_exists( 'roxtar_options' ) ) {
	/**
	 * Theme option
	 * If ( $defaults = true ) return Default value
	 * Else return all theme option
	 *
	 * @param      bool $defaults  Condition check output.
	 * @return     array $options         All theme options
	 */
	function roxtar_options( $defaults = true ) {
		$default_settings = Roxtar_Customizer::roxtar_get_roxtar_default_setting_values();
		$default_fonts    = Roxtar_Fonts_Helpers::roxtar_get_default_fonts();
		$default_options  = array_merge( $default_settings, $default_fonts );

		if ( $defaults ) {
			return $default_options;
		}

		$options = wp_parse_args(
			get_option( 'roxtar_setting', array() ),
			$default_options
		);

		return $options;
	}
}

if ( ! function_exists( 'roxtar_image_alt' ) ) {

	/**
	 * Get image alt
	 *
	 * @param      bolean $id          The image id.
	 * @param      string $alt         The alternate.
	 * @param      bolean $placeholder The bolean.
	 *
	 * @return     string  The image alt
	 */
	function roxtar_image_alt( $id = null, $alt = '', $placeholder = false ) {
		if ( ! $id ) {
			if ( $placeholder ) {
				return esc_attr__( 'Placeholder image', 'roxtar' );
			}
			return esc_attr__( 'Error image', 'roxtar' );
		}

		$data    = get_post_meta( $id, '_wp_attachment_image_alt', true );
		$img_alt = ! empty( $data ) ? $data : $alt;

		return $img_alt;
	}
}

if ( ! function_exists( 'roxtar_hex_to_rgba' ) ) {
	/**
	 * Convert HEX to RGBA color
	 *
	 * @param      string  $hex    The hexadecimal color.
	 * @param      integer $alpha  The alpha.
	 * @return     string  The rgba color.
	 */
	function roxtar_hex_to_rgba( $hex, $alpha = 1 ) {
		$hex = str_replace( '#', '', $hex );

		if ( 3 === strlen( $hex ) ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}

		$rgba = array( $r, $g, $b, $alpha );

		return 'rgba(' . implode( ',', $rgba ) . ')';
	}
}

if ( ! function_exists( 'roxtar_browser_detection' ) ) {
	/**
	 * Roxtar broswer detection
	 */
	function roxtar_browser_detection() {
		global $is_IE, $is_edge, $is_safari, $is_iphone;

		$class = '';

		if ( $is_iphone ) {
			$class = 'iphone';
		} elseif ( $is_IE ) {
			$class = 'ie';
		} elseif ( $is_edge ) {
			$class = 'edge';
		} elseif ( $is_safari ) {
			$class = 'safari';
		}

		return $class;
	}
}

if ( ! function_exists( 'roxtar_dequeue_scripts_and_styles' ) ) {
	/**
	 * Dequeue scripts and style no need
	 */
	function roxtar_dequeue_scripts_and_styles() {
		// What is 'sb-font-awesome'?
		wp_deregister_style( 'sb-font-awesome' );
		wp_dequeue_style( 'sb-font-awesome' );

		// Remove default YITH Wishlist css.
		wp_dequeue_style( 'yith-wcwl-main' );
		wp_dequeue_style( 'yith-wcwl-font-awesome' );
		wp_dequeue_style( 'jquery-selectBox' );
	}
}

if ( ! function_exists( 'roxtar_narrow_data' ) ) {
	/**
	 * Get dropdown data
	 *
	 * @param      string $type   The type 'post' || 'term'.
	 * @param      string $terms  The terms post, category, product, product_cat, custom_post_type...
	 * @param      intval $total  The total.
	 *
	 * @return     array
	 */
	function roxtar_narrow_data( $type = 'post', $terms = 'category', $total = -1 ) {
		$output = array();
		switch ( $type ) {
			case 'post':
				$args = array(
					'post_type'           => $terms,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $total,
				);

				$qr = new WP_Query( $args );
				if ( $qr->have_posts() ) {
					$output = wp_list_pluck( $qr->posts, 'post_title', 'ID' );
				}
				break;

			case 'term':
				$terms = get_terms( $terms );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					$output = wp_list_pluck( $terms, 'name', 'term_id' );
				}
				break;
		}

		return $output;
	}
}

if ( ! function_exists( 'roxtar_get_metabox' ) ) {
	/**
	 * Get metabox option
	 *
	 * @param int    $page_id      The page ID.
	 * @param string $metabox_name Metabox option name.
	 */
	function roxtar_get_metabox( $page_id = false, $metabox_name ) {
		$page_id             = $page_id ? intval( $page_id ) : roxtar_get_page_id();
		$metabox             = get_post_meta( $page_id, $metabox_name, true );
		$is_product_category = class_exists( 'woocommerce' ) && is_product_category();

		if ( ! $metabox || $is_product_category ) {
			$metabox = 'default';
		}

		return $metabox;
	}
}

if ( ! function_exists( 'roxtar_header_transparent' ) ) {
	/**
	 * Detect header transparent on current page
	 */
	function roxtar_header_transparent() {
		$options             = roxtar_options( false );
		$transparent         = $options['header_transparent'];
		$archive_transparent = $options['header_transparent_disable_archive'];
		$index_transparent   = $options['header_transparent_disable_index'];
		$page_transparent    = $options['header_transparent_disable_page'];
		$post_transparent    = $options['header_transparent_disable_post'];
		$shop_transparent    = $options['header_transparent_disable_shop'];
		$product_transparent = $options['header_transparent_disable_product'];
		$metabox_transparent = roxtar_get_metabox( false, 'site_header-transparent' );

		// Disable header transparent on Shop page.
		if ( class_exists( 'woocommerce' ) && is_shop() && $shop_transparent ) {
			$transparent = false;
		} elseif ( class_exists( 'woocommerce' ) && is_product() && $product_transparent ) {
			// Disable header transparent on Product page.
			$transparent = false;
		} elseif ( ( ( is_archive() && ( class_exists( 'woocommerce' ) && ! is_shop() ) ) || is_404() || is_search() ) && $archive_transparent ) {
			// Disable header transparent on Archive, 404 and Search page NOT Shop page.
			$transparent = false;
		} elseif ( is_home() && $index_transparent ) {
			// Disable header transparent on Blog page.
			$transparent = false;
		} elseif ( is_page() && $page_transparent ) {
			// Disable header transparent on Pages.
			$transparent = false;
		} elseif ( is_singular( 'post' ) && $post_transparent ) {
			// Disable header transparent on Posts.
			$transparent = false;
		}

		// Metabox option for single post or page. Priority highest.
		if ( 'default' !== $metabox_transparent ) {
			if ( 'enabled' === $metabox_transparent ) {
				$transparent = true;
			} else {
				$transparent = false;
			}
		}

		return $transparent;
	}
}

if ( ! function_exists( 'roxtar_meta_charset' ) ) {
	/**
	 * Meta charset
	 */
	function roxtar_meta_charset() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php
	}
}

if ( ! function_exists( 'roxtar_meta_viewport' ) ) {
	/**
	 * Meta viewport
	 */
	function roxtar_meta_viewport() {
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<?php
	}
}

if ( ! function_exists( 'roxtar_rel_profile' ) ) {
	/**
	 * Rel profile
	 */
	function roxtar_rel_profile() {
		?>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
}

if ( ! function_exists( 'roxtar_pingback' ) ) {
	/**
	 * Pingback
	 */
	function roxtar_pingback() {
		if ( ! is_singular() || ! pings_open( get_queried_object() ) ) {
			return;
		}
		?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

if ( ! function_exists( 'roxtar_facebook_social' ) ) {
	/**
	 * Get Title and Image for Facebook share
	 */
	function roxtar_facebook_social() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}

		$id        = roxtar_get_page_id();
		$title     = get_the_title( $id );
		$image     = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
		$image_src = $image ? $image[0] : wc_placeholder_img_src();
		?>

		<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
		<meta property="og:image" content="<?php echo esc_attr( $image_src ); ?>">
		<?php
	}
}

if ( ! function_exists( 'roxtar_array_insert' ) ) {
	/**
	 * Insert an array into another array before/after a certain key
	 *
	 * @param array  $array The initial array.
	 * @param array  $pairs The array to insert.
	 * @param string $key The certain key.
	 * @param string $position Wether to insert the array before or after the key.
	 * @return array
	 */
	function roxtar_array_insert( $array, $pairs, $key, $position = 'after' ) {
		$key_pos = array_search( $key, array_keys( $array ), true );
		if ( 'after' === $position ) {
			$key_pos++;
			if ( false !== $key_pos ) {
				$result = array_slice( $array, 0, $key_pos );
				$result = array_merge( $result, $pairs );
				$result = array_merge( $result, array_slice( $array, $key_pos ) );
			}
		} else {
			$result = array_merge( $array, $pairs );
		}

		return $result;
	}
}

if ( ! function_exists( 'roxtar_support_wishlist_plugin' ) ) {
	/**
	 * Detect wishlist plugin
	 */
	function roxtar_support_wishlist_plugin() {
		if ( ! roxtar_is_woocommerce_activated() ) {
			return false;
		}

		$options = roxtar_options( false );
		$plugin  = $options['shop_page_wishlist_support_plugin'];

		// Ti plugin or YITH plugin.
		if ( ( defined( 'TINVWL_URL' ) && 'ti' === $plugin ) || ( defined( 'YITH_WCWL' ) && 'yith' === $plugin ) ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'roxtar_wishlist_page_url' ) ) {
	/**
	 * Get wishlist page url
	 */
	function roxtar_wishlist_page_url() {
		if ( ! roxtar_support_wishlist_plugin() ) {
			return '#';
		}

		$options   = roxtar_options( false );
		$shortcode = '[yith_wcwl_wishlist]';

		if ( 'ti' === $options['shop_page_wishlist_support_plugin'] ) {
			$shortcode = '[ti_wishlistsview]';
		}

		global $wpdb;
		$id = $wpdb->get_results( 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE post_content LIKE "%' . $shortcode . '%" AND post_parent = 0' ); // phpcs:ignore

		if ( $id ) {
			$id  = intval( $id[0]->ID );
			$url = get_the_permalink( $id );

			return $url;
		}

		return '#';
	}
}




// URL REWRITEs


/* remove bwlm-shop from backend url box and replace with product - Permalink Manager for WooCommerce */

function custom_frontend_url( $permalink, $post ) { 
	$custom_permalink = str_replace( '/bwlm-shop', '/products',  $permalink );

	return $custom_permalink; 
} 

if ( is_admin() ) {

	add_filter( 'post_type_link', 'custom_frontend_url', 10, 2 );

}     

/* Rewrite category url to include products */

add_filter('request', function( $vars ) {
	global $wpdb;
	if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
		$slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
		$exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
		if( $exists ){
			$old_vars = $vars;
			$vars = array('product_cat' => $slug );
			if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
				$vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
			if ( !empty( $old_vars['orderby'] ) )
	 	        	$vars['orderby'] = $old_vars['orderby'];
      			if ( !empty( $old_vars['order'] ) )
 			        $vars['order'] = $old_vars['order'];	
		}
	}
	return $vars;
});