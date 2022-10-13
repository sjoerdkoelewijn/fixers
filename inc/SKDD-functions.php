<?php
/**
 * SKDD functions.
 *
 * @package SKDD
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

if ( ! function_exists( 'SKDD_version' ) ) {
	/**
	 * SKDD Version
	 *
	 * @return string SKDD Version.
	 */
	function SKDD_version() {
		return esc_attr( SKDD_VERSION );
	}
}

if ( ! function_exists( 'SKDD_get_current_git_commit' ) ) {

	function SKDD_get_current_git_commit( $branch='main' ) {

		if (file_exists(get_stylesheet_directory() . '/.git/refs/heads/main' ) ) {
			$hash = file_get_contents( sprintf( get_stylesheet_directory() . '/.git/refs/heads/%s', $branch ) );
		} else {
			return 'no-git-version'; 
		}	

		if ( isset($hash) ) {
			return trim($hash);
		  } else {
			return false;
		  }
	}

}

if ( ! function_exists( 'SKDD_info' ) ) {
	/**
	 * SKDD Information.
	 *
	 * @param      string $output  The output.
	 */
	function SKDD_info( $output ) {
		$output .= ' data-skdd-version="' . SKDD_version() . '"';

		return $output;
	}
}

if ( ! function_exists( 'SKDD_suffix' ) ) {
	/**
	 * Define Script debug.
	 *
	 * @return     string $suffix
	 */
	function SKDD_suffix() {
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		return $suffix;
	}
}


if ( ! function_exists( 'SKDD_is_woocommerce_activated' ) ) {

	function SKDD_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}

}

if ( ! function_exists( 'SKDD_get_product_id' ) ) {
	/**
	 * Get product id
	 */
	function SKDD_get_product_id() {
		$last_product_id = SKDD_get_last_product_id();
		$post            = isset( $_REQUEST['post'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['post'] ) ) : false; // phpcs:ignore
		$editor_post_id  = isset( $_REQUEST['editor_post_id'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['editor_post_id'] ) ) : false; // phpcs:ignore
		$post_id         = $post ? $post : $editor_post_id;
		if ( $post_id ) {
			$selected_id = get_post_meta( $post_id, 'SKDD_woo_builder_select_product_preview', true );

			if ( $selected_id ) {
				$last_product_id = $selected_id;
			}
		}

		$product_id = SKDD_get_page_id();

		return apply_filters( 'SKDD_get_product_id', $product_id );
	}
}

if ( ! function_exists( 'SKDD_sanitize_array' ) ) {
	/**
	 * Sanitize integer value
	 *
	 * @param      array $value  The array.
	 */
	function SKDD_sanitize_array( $value ) {
		$data = array();
		foreach ( $value as $key ) {
			$data[] = sanitize_text_field( $key );
		}

		return $data;
	}
}

if ( ! function_exists( 'SKDD_sanitize_choices' ) ) {
	/**
	 * Sanitizes choices (selects / radios)
	 * Checks that the input matches one of the available choices
	 *
	 * @param array $input the available choices.
	 * @param array $setting the setting object.
	 */
	function SKDD_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

if ( ! function_exists( 'SKDD_sanitize_checkbox' ) ) {
	/**
	 * Checkbox sanitization callback.
	 *
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function SKDD_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
}

if ( ! function_exists( 'SKDD_sanitize_variants' ) ) {
	/**
	 * Sanitize our Google Font variants
	 *
	 * @param      string $input sanitize variants.
	 * @return     sanitize_text_field( $input )
	 */
	function SKDD_sanitize_variants( $input ) {
		if ( is_array( $input ) ) {
			$input = implode( ',', $input );
		}
		return sanitize_text_field( $input );
	}
}

if ( ! function_exists( 'SKDD_sanitize_rgba_color' ) ) {
	/**
	 * Sanitize color || rgba color
	 *
	 * @param      string $color  The color.
	 */
	function SKDD_sanitize_rgba_color( $color ) {
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

if ( ! function_exists( 'SKDD_sanitize_int' ) ) {
	/**
	 * Sanitize integer value
	 *
	 * @param      integer $value  The integer number.
	 */
	function SKDD_sanitize_int( $value ) {
		return intval( $value );
	}
}

if ( ! function_exists( 'SKDD_sanitize_raw_html' ) ) {
	/**
	 * Sanitize raw html value
	 *
	 * @param      string $value  The raw html value.
	 */
	function SKDD_sanitize_raw_html( $value ) {
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

if ( ! function_exists( 'SKDD_is_blog' ) ) {
	/**
	 * SKDD detect blog page
	 *
	 * @return boolean $is_blog
	 */
	function SKDD_is_blog() {
		global $post;

		$post_type = get_post_type( $post );

		$is_blog = ( 'post' === $post_type && ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) ) ? true : false;

		return apply_filters( 'SKDD_is_blog', $is_blog );
	}
}

if ( ! function_exists( 'SKDD_is_cpt' ) ) {
	/**
	 * SKDD detect blog page
	 *
	 * @return boolean $is_blog
	 */
	function SKDD_is_cpt() {
		global $post;

		$post_type = get_post_type( $post );

		// 'portfolio|services|team|knowledge|location|support';

		$custom_post_type = $post_type && ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() );

		if ( 'portfolio' === $post_type && $custom_post_type || 'services' === $post_type && $custom_post_type || 'team' === $post_type && $custom_post_type || 'knowledge' === $post_type && $custom_post_type || 'location' === $post_type && $custom_post_type || 'support' === $post_type && $custom_post_type )  {
			$is_cpt = true;
			return apply_filters( 'SKDD_is_cpt', $is_cpt );
		} 		
		
	}
}

if ( ! function_exists( 'SKDD_options' ) ) {
	/**
	 * Theme option
	 * If ( $defaults = true ) return Default value
	 * Else return all theme option
	 *
	 * @param      bool $defaults  Condition check output.
	 * @return     array $options         All theme options
	 */
	function SKDD_options( $defaults = true ) {
		$default_settings = SKDD_Customizer::SKDD_get_SKDD_default_setting_values();
		$default_fonts    = SKDD_Fonts_Helpers::SKDD_get_default_fonts();
		$default_options  = array_merge( $default_settings, $default_fonts );

		if ( $defaults ) {
			return $default_options;
		}

		$options = wp_parse_args(
			get_option( 'SKDD_setting', array() ),
			$default_options
		);

		return $options;
	}
}

if ( ! function_exists( 'SKDD_image_alt' ) ) {

	/**
	 * Get image alt
	 *
	 * @param      bolean $id          The image id.
	 * @param      string $alt         The alternate.
	 * @param      bolean $placeholder The bolean.
	 *
	 * @return     string  The image alt
	 */
	function SKDD_image_alt( $id = null, $alt = '', $placeholder = false ) {
		if ( ! $id ) {
			if ( $placeholder ) {
				return esc_attr__( 'Placeholder image', 'SKDD' );
			}
			return esc_attr__( 'Error image', 'SKDD' );
		}

		$data    = get_post_meta( $id, '_wp_attachment_image_alt', true );
		$img_alt = ! empty( $data ) ? $data : $alt;

		return $img_alt;
	}
}

if ( ! function_exists( 'SKDD_hex_to_rgba' ) ) {
	/**
	 * Convert HEX to RGBA color
	 *
	 * @param      string  $hex    The hexadecimal color.
	 * @param      integer $alpha  The alpha.
	 * @return     string  The rgba color.
	 */
	function SKDD_hex_to_rgba( $hex, $alpha = 1 ) {
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

if ( ! function_exists( 'SKDD_browser_detection' ) ) {
	/**
	 * SKDD broswer detection
	 */
	function SKDD_browser_detection() {
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

if ( ! function_exists( 'SKDD_dequeue_scripts_and_styles' ) ) {
	/**
	 * Dequeue scripts and style no need
	 */
	function SKDD_dequeue_scripts_and_styles() {
		// What is 'sb-font-awesome'?
		wp_deregister_style( 'sb-font-awesome' );
		wp_dequeue_style( 'sb-font-awesome' );

		// Remove default YITH Wishlist css.
		wp_dequeue_style( 'yith-wcwl-main' );
		wp_dequeue_style( 'yith-wcwl-font-awesome' );
		wp_dequeue_style( 'jquery-selectBox' );
	}
}

if ( ! function_exists( 'SKDD_narrow_data' ) ) {
	/**
	 * Get dropdown data
	 *
	 * @param      string $type   The type 'post' || 'term'.
	 * @param      string $terms  The terms post, category, product, product_cat, custom_post_type...
	 * @param      intval $total  The total.
	 *
	 * @return     array
	 */
	function SKDD_narrow_data( $type = 'post', $terms = 'category', $total = -1 ) {
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

if ( ! function_exists( 'SKDD_get_metabox' ) ) {
	/**
	 * Get metabox option
	 *
	 * @param int    $page_id      The page ID.
	 * @param string $metabox_name Metabox option name.
	 */
	function SKDD_get_metabox( $page_id = false, $metabox_name ) {
		$page_id             = $page_id ? intval( $page_id ) : SKDD_get_page_id();
		$metabox             = get_post_meta( $page_id, $metabox_name, true );
		$is_product_category = class_exists( 'woocommerce' ) && is_product_category();

		if ( ! $metabox || $is_product_category ) {
			$metabox = 'default';
		}

		return $metabox;
	}
}

if ( ! function_exists( 'SKDD_header_transparent' ) ) {
	/**
	 * Detect header transparent on current page
	 */
	function SKDD_header_transparent() {
		$options             = SKDD_options( false );
		$transparent         = $options['header_transparent'];
		$archive_transparent = $options['header_transparent_disable_archive'];
		$index_transparent   = $options['header_transparent_disable_index'];
		$page_transparent    = $options['header_transparent_disable_page'];
		$post_transparent    = $options['header_transparent_disable_post'];
		$shop_transparent    = $options['header_transparent_disable_shop'];
		$product_transparent = $options['header_transparent_disable_product'];
		$metabox_transparent = SKDD_get_metabox( false, 'site_header-transparent' );

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

if ( ! function_exists( 'SKDD_meta_charset' ) ) {
	/**
	 * Meta charset
	 */
	function SKDD_meta_charset() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php
	}
}

if ( ! function_exists( 'SKDD_meta_viewport' ) ) {
	/**
	 * Meta viewport
	 */
	function SKDD_meta_viewport() {
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=2.0">
		<?php
	}
}

if ( ! function_exists( 'SKDD_rel_profile' ) ) {
	/**
	 * Rel profile
	 */
	function SKDD_rel_profile() {
		?>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
}

if ( ! function_exists( 'SKDD_pingback' ) ) {
	/**
	 * Pingback
	 */
	function SKDD_pingback() {
		if ( ! is_singular() || ! pings_open( get_queried_object() ) ) {
			return;
		}
		?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

if ( ! function_exists( 'SKDD_facebook_social' ) ) {
	/**
	 * Get Title and Image for Facebook share
	 */
	function SKDD_facebook_social() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}

		$id        = SKDD_get_page_id();
		$title     = get_the_title( $id );
		$image     = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
		$image_src = $image ? $image[0] : wc_placeholder_img_src();
		?>

		<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
		<meta property="og:image" content="<?php echo esc_attr( $image_src ); ?>">
		<?php
	}
}

if ( ! function_exists( 'SKDD_custom_meta_tags' ) ) {

	function SKDD_custom_meta_tags() {
		$options = SKDD_options( false );
		$meta_tags   = $options['custom_meta_tags'];

		echo $meta_tags;

	}
}

if ( ! function_exists( 'SKDD_enqueue_readspeaker' ) ) {

	function SKDD_enqueue_readspeaker() {

		$options = SKDD_options( false );
		$readspeaker = $options['readspeaker_enabled'];
		$readspeaker_id = $options['readspeaker_id'];
				
		if ( ! $readspeaker ) {
			return;
		}
		
		?>

		<script src="//cdn-eu.readspeaker.com/script/<?php echo $readspeaker_id ?>/webReader/webReader.js?pids=wr" type="text/javascript" id="rs_req_Init"></script>
		
		<?php
	}

}

if ( ! function_exists( 'SKDD_array_insert' ) ) {
	/**
	 * Insert an array into another array before/after a certain key
	 *
	 * @param array  $array The initial array.
	 * @param array  $pairs The array to insert.
	 * @param string $key The certain key.
	 * @param string $position Wether to insert the array before or after the key.
	 * @return array
	 */
	function SKDD_array_insert( $array, $pairs, $key, $position = 'after' ) {
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


// Remove woocommerce schema for products

add_filter( 'woocommerce_structured_data_product', 'SKDD_structured_data_product_nulled', 10, 2 );

function SKDD_structured_data_product_nulled( $markup, $product ){
    if( is_product() ) {
        $markup = '';
    }
    return $markup;
}


if ( ! function_exists( 'SKDD_support_wishlist_plugin' ) ) {
	/**
	 * Detect wishlist plugin
	 */
	function SKDD_support_wishlist_plugin() {
		if ( ! SKDD_is_woocommerce_activated() ) {
			return false;
		}

		$options = SKDD_options( false );
		$plugin  = $options['shop_page_wishlist_support_plugin'];

		// Ti plugin or YITH plugin.
		if ( ( defined( 'TINVWL_URL' ) && 'ti' === $plugin ) || ( defined( 'YITH_WCWL' ) && 'yith' === $plugin ) ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'SKDD_wishlist_page_url' ) ) {
	/**
	 * Get wishlist page url
	 */
	function SKDD_wishlist_page_url() {
		if ( ! SKDD_support_wishlist_plugin() ) {
			return '#';
		}

		$options   = SKDD_options( false );
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




// URL REWRITE

if ( is_admin() ) {

	//add_filter( 'post_type_link', 'custom_frontend_url', 10, 2 );

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


// Remove style tags in body from complianz GDPR plugin.

add_action( 'init', 'remove_style_tags_cmplz' );

function remove_style_tags_cmplz () {
    remove_action('wp_footer', 'cmplz_forminator_css');
}

// Convert HEX to RGB and optionally to RGBA if alpha is provided

if ( ! function_exists( 'SKDD_hex_to_rgb' ) ) {

	function SKDD_hex_to_rgb($color, $opacity = false) {
		
		$default = 'rgb(0,0,0)';

        //Return default if no color provided
        if(empty($color))
              return $default;

        //Sanitize $color if "#" is provided
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }

            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                    return $default;
            }

            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);

            //Check if opacity is set(rgba or rgb)
            if($opacity){
                $opacity_value = $opacity / 100;                    
                $output = 'rgba('.implode(",",$rgb).','.$opacity_value.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }

			return $output;
		
	}

}

// Remove the default wordpress emojis 

if ( ! function_exists( 'SKDD_disable_emojis' ) ) {

	function SKDD_disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	add_action( 'init', 'SKDD_disable_emojis' );

}
