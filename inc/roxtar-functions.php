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

if ( ! function_exists( 'roxtar_is_elementor_activated' ) ) {
	/**
	 * Check Elementor active
	 *
	 * @return     bool
	 */
	function roxtar_is_elementor_activated() {
		return defined( 'ELEMENTOR_VERSION' );
	}
}

if ( ! function_exists( 'roxtar_is_elementor_page' ) ) {
	/**
	 * Detect Elementor Page editor with current page
	 *
	 * @param int $page_id The page id.
	 * @return     bool
	 */
	function roxtar_is_elementor_page( $page_id = false ) {
		if ( ! roxtar_is_elementor_activated() ) {
			return false;
		}

		if ( ! $page_id ) {
			$page_id = roxtar_get_page_id();
		}

		$edit_mode = get_post_meta( $page_id, '_elementor_edit_mode', true );
		$edit_mode = 'builder' === $edit_mode ? true : false;

		// Priority first.
		if ( 'mega_menu' === get_post_type( $page_id ) ) {
			return $edit_mode;
		}

		if ( ! $page_id || is_tax() || is_singular( 'product' ) ) {
			$edit_mode = false;
		}

		return $edit_mode;
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

		$product_id = roxtar_is_elementor_editor() ? $last_product_id : roxtar_get_page_id();

		return apply_filters( 'roxtar_get_product_id', $product_id );
	}
}

if ( ! function_exists( 'roxtar_elementor_has_location' ) ) {
	/**
	 * Detect if a page has Elementor location template.
	 *
	 * @param      string $location The location.
	 * @return     boolean
	 */
	function roxtar_elementor_has_location( $location ) {
		if ( ! did_action( 'elementor_pro/init' ) ) {
			return false;
		}

		$conditions_manager = \ElementorPro\Plugin::instance()->modules_manager->get_modules( 'theme-builder' )->get_conditions_manager();
		$documents          = $conditions_manager->get_documents_for_location( $location );

		return ! empty( $documents );
	}
}

if ( ! function_exists( 'roxtar_is_elementor_editor' ) ) {
	/**
	 * Condition if Current screen is Edit mode || Preview mode.
	 */
	function roxtar_is_elementor_editor() {
		if ( ! roxtar_is_elementor_activated() ) {
			return false;
		}

		$editor = ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() );

		return $editor;
	}
}

if ( ! function_exists( 'roxtar_is_divi_page' ) ) {
	/**
	 * Get Divi page content
	 *
	 * @param int $id The page id.
	 */
	function roxtar_is_divi_page( $id = false ) {
		if ( ! defined( 'ET_BUILDER_PLUGIN_VERSION' ) ) {
			return false;
		}

		if ( ! $id ) {
			$id = roxtar_get_page_id();
		}

		if ( ! $id || is_tax() ) {
			return false;
		}

		$content_post = get_post( $id );
		$content      = $content_post->post_content;
		if ( false !== strpos( $content, '<!-- wp:divi/placeholder -->' ) || false !== strpos( $content, '[et_pb_' ) ) {
			return true;
		}

		return false;
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






define( "BWLM_file", __FILE__ );

class BeRocketLinkManager {
    private $options     = array();
    private $txn_options = array( 'product_cat' => '', 'product_tag' => '' );
    private $product_base;

    public $settings = 'wc_links';

    public function __construct() {
        $this->options = get_option( $this->settings );

        if ( $this->options[ 'category' ] ) {
            $this->txn_options[ 'product_cat' ] = $this->options[ 'category' ];
        }

        if ( $this->options[ 'tag' ] ) {
            $this->txn_options[ 'product_tag' ] = $this->options[ 'tag' ];
        }

        if ( ! empty( $this->options[ 'prefix' ] ) and ! empty( $this->options[ 'wc_crumbs' ] ) and ! is_admin() ) {
            add_filter( 'woocommerce_get_breadcrumb', array( $this, 'update_woocommerce_breadcrumb' ), 9999 );
        }	

        if ( is_admin() ) {
            add_action( 'current_screen', array( $this, 'register_permalink_option' ), 11 );
            add_filter( 'plugin_action_links_' . plugin_basename( BWLM_file ), array( $this, 'plugin_action_links' ) );
        } else {
            add_filter( 'post_type_link', array( $this, 'rewrite_products' ), 1, 2 );
            add_filter( 'term_link', array( $this, 'rewrite_terms' ), 0, 3 );

            if ( ! empty( $this->options[ 'product' ] ) ) {
                add_action( 'request', array( $this, 'request' ), 11 );
            }
        }

        add_filter( 'query_vars', array( $this, 'query_vars' ) );
        add_action( 'wp', array( $this, 'redirect_301' ) );
        add_filter( 'rewrite_rules_array', array( $this, 'rewrite_rules' ), 99 );

        foreach (
            array(
                'created_product_cat',
                'edited_product_cat',
                'delete_product_cat',
                'created_product_tag',
                'edited_product_tag',
                'delete_product_tag',
                'update_option_' . $this->settings
            ) as $action
        ) {
            add_action( $action, 'flush_rewrite_rules' );
        }

        register_deactivation_hook( BWLM_file, 'flush_rewrite_rules' );
        register_activation_hook( BWLM_file, 'flush_rewrite_rules' );
    }

    public function register_permalink_option() {
        $screen = get_current_screen();

        if ( $screen->id == 'options-permalink' ) {
            $this->save_permalink_option();
            $this->_register_permalink_option();
        }
    }

    public function _register_permalink_option() {
        global $wp_settings_sections;
        add_settings_section( 'bwlm_permalinks', '', array( $this, 'permalink_settings_page' ), 'permalink' );
    }

    public function save_permalink_option() {
        if ( isset( $_POST[ $this->settings ] ) and current_user_can('manage_options') ) {
            $post = array( 'category' => '', 'product' => '', 'tag' => '' );
            if ( in_array( $_POST[ $this->settings ]['category'], array('slug', 'hierarchical') ) )
                $post['category'] = $_POST[ $this->settings ]['category'];
            if ( in_array( $_POST[ $this->settings ]['product'], array('slug', 'category_slug', 'hierarchical') ) )
                $post['product'] = $_POST[ $this->settings ]['product'];
            if ( 'slug' == $_POST[ $this->settings ]['tag'] )
                $post['tag'] = $_POST[ $this->settings ]['tag'];

            if ( ( $post['prefix'] = sanitize_text_field( $_POST[ $this->settings ]['prefix'] ) ) == 'roxtar_custom_permalink') {
                $post['prefix'] = 'shop';
            }
            $post['wc_crumbs']          = ! empty( $_POST[ $this->settings ]['wc_crumbs'] );
            $post['redirect_old_links'] = ! empty( $_POST[ $this->settings ]['redirect_old_links'] );

            $prev_options = get_option( $this->settings );

            update_option( $this->settings, $post );

            $options = $post;

            if ( ( ! empty( $options[ 'product' ] ) or ! empty( $options[ 'category' ] ) ) and ( ! get_option( 'permalink_structure' ) ) ) {
                update_option( 'permalink_structure', '/%postname%/' );
            }

            if ( ! empty( $options[ 'product' ] ) ) {
                if ( $options[ 'product' ] == 'slug' ) {
                    $wc[ 'product_base' ] = 'product';
                } else {
                    $wc[ 'product_base' ] = '/roxtar_custom_permalink/%product_cat%/';
                }
                $wc['attribute_base'] = wc_sanitize_permalink( wp_unslash( $_POST['woocommerce_product_attribute_slug'] ) );

                update_option( 'woocommerce_permalinks', $wc );
            } else {
                if ( $this->get( $prev_options, 'product' ) ) {
                    $wc[ 'product_base' ] = 'product';
                    if ( $product_permalink_structure = wc_sanitize_permalink( wp_unslash( $_POST['product_permalink_structure'] ) ) and trim( $product_permalink_structure, '/' ) != 'roxtar_custom_permalink/%product_cat%' ) {
                        $wc[ 'product_base' ] = $product_permalink_structure;
                    }
                    update_option( 'woocommerce_permalinks', $wc );
                }
            }
        }
    }

    public function permalink_settings_page() {
        $options  = get_option( $this->settings );
        ?>
        <h2 class="bwlm" id="bwlm-settings"><?=__( 'Permalink Manager for WooCommerce', 'permalink-manager-for-woocommerce' )?></h2>
        <h3 class="bwlm"><?=__( 'General', 'permalink-manager-for-woocommerce' )?></h3>
        <table class="form-table bwlm">
            <tbody>
            <tr>
                <th><label for="bwlm-settings-prefix"><?=__( 'Prefix', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <input id="bwlm-settings-prefix" name="<?= $this->settings ?>[prefix]" type="text" value="<?=$this->get( $options, 'prefix' ) ?>">
                    <span class="description"><?=__( 'Add <code>shop</code> to have', 'permalink-manager-for-woocommerce' )?> <code><?= home_url( '/shop/category/' ) ?></code></span>
                </td>
            </tr>
            <tr>
                <th><label for="bwlm-settings-wc_crumbs"><?=__( 'Update breadcrumbs', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <input id="bwlm-settings-wc_crumbs" name="<?= $this->settings ?>[wc_crumbs]"
                           type="checkbox" <?=( $this->get( $options, 'wc_crumbs' ) ? "checked='checked'" : '' ) ?> value="1">
                    <span class=""><?=__( 'Add prefix to the WooCommerce breadcrumbs(if prefix is set)', 'permalink-manager-for-woocommerce' )?></span>
                </td>
            </tr>
            <tr>
                <th><label for="bwlm-settings-redirect_old_links"><?=__( 'Redirect old links', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <input id="bwlm-settings-redirect_old_links" name="<?= $this->settings ?>[redirect_old_links]"
                           type="checkbox" <?=( $this->get( $options, 'redirect_old_links' ) ? "checked='checked'" : '' ) ?> value="1">
                    <span class=""><?=__( 'Redirect old links to new location with status 301(Moved Permanently)', 'permalink-manager-for-woocommerce' )?></span>
                </td>
            </tr>
            </tbody>
        </table>

        <h3 class="bwlm"><?=__( 'Categories', 'permalink-manager-for-woocommerce' )?></h3>
        <table class="form-table bwlm">
            <tbody>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[category]" <?= ( ! $this->get( $options, 'category' ) ? "checked='checked'" : '' ) ?>
                            type="radio" value=""> <?=__( 'Default', 'permalink-manager-for-woocommerce' )?></label></th>
                <td><?=__( 'Use WooCommerce configuration', 'permalink-manager-for-woocommerce' )?></td>
            </tr>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[category]" <?= ( $this->get( $options, 'category' ) == 'slug' ? "checked='checked'" : '' ) ?>
                            type="radio" value="slug"> <?=__( 'Category', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <?=__( 'Remove WooCommerce keyword from the url and leave category slug', 'permalink-manager-for-woocommerce' )?>
                    <br>
                    <code><?= home_url( '/category/' ) ?></code>
                </td>
            </tr>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[category]" <?= ( $this->get( $options, 'category' ) == 'hierarchical' ? "checked='checked'" : '' ) ?>
                            type="radio" value="hierarchical"> <?=__( 'Category with parents', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <?=__( 'Add category parents hierarchy', 'permalink-manager-for-woocommerce' )?>
                    <br>
                    <code><?= home_url( '/parent-category/category/' ) ?></code>
                </td>
            </tr>
            </tbody>
        </table>

        <h3 class="bwlm"><?=__( 'Products', 'permalink-manager-for-woocommerce' )?></h3>
        <table class="form-table bwlm">
            <tbody>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[product]" <?= ( ! $this->get( $options, 'product' ) ? "checked='checked'" : '' ) ?>
                            type="radio" value=""> <?=__( 'Default', 'permalink-manager-for-woocommerce' )?></label></th>
                <td><?=__( 'Use WooCommerce configuration', 'permalink-manager-for-woocommerce' )?></td>
            </tr>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[product]" <?= ( $this->get( $options, 'product' ) == 'slug' ? "checked='checked'" : '' ) ?>
                            type="radio" value="slug"> <?=__( 'Product', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <?=__( 'Remove WooCommerce keyword from the url and leave product slug', 'permalink-manager-for-woocommerce' )?>
                    <br>
                    <code><?= home_url( '/product/' ) ?></code>
                </td>
            </tr>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[product]" <?= ( $this->get( $options, 'product' ) == 'category_slug' ? "checked='checked'" : '' ) ?>
                            type="radio" value="category_slug"> <?=__( 'Category', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <?=__( 'Change WooCommerce keyword to product\'s primary category and leave product slug', 'permalink-manager-for-woocommerce' )?>
                    <br>
                    <code><?= home_url( '/category/product/' ) ?></code>
                </td>
            </tr>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[product]" <?= ( $this->get( $options, 'product' ) == 'hierarchical' ? "checked='checked'" : '' ) ?>
                            type="radio" value="hierarchical"> <?=__( 'Category with parents', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <?=__( "Change WooCommerce keyword to product's primary category parents hierarchy and leave product slug", 'permalink-manager-for-woocommerce' )?>
                    <br>
                    <code><?= home_url( '/parent-category/category/product/' ) ?></code>
                </td>
            </tr>
            </tbody>
        </table>

        <h3 class="bwlm"><?=__( 'Tags', 'permalink-manager-for-woocommerce' )?></h3>
        <table class="form-table bwlm">
            <tbody>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[tag]" <?= ( ! $this->get( $options, 'tag' ) ? "checked='checked'" : '' ) ?>
                            type="radio" value=""> <?=__( 'Default', 'permalink-manager-for-woocommerce' )?></label></th>
                <td><?=__( 'Use WooCommerce configuration', 'permalink-manager-for-woocommerce' )?></td>
            </tr>
            <tr>
                <th><label><input
                            name="<?= $this->settings ?>[tag]" <?= ( $this->get( $options, 'tag' ) == 'slug' ? "checked='checked'" : '' ) ?>
                            type="radio" value="slug"> <?=__( 'Tag', 'permalink-manager-for-woocommerce' )?></label></th>
                <td>
                    <?=__( 'Remove WooCommerce keyword from the url and leave tag slug', 'permalink-manager-for-woocommerce' )?>
                    <br>
                    <code><?= home_url( '/tag/' ) ?></code>
                </td>
            </tr>
            </tbody>
        </table>
        <style>
            h2.bwlm {
                margin: 40px 0 30px;
            }

            h3.bwlm {
                font-size: 1.2em;
                color: #4d4d4d;
                margin-bottom: 10px;
            }

            table.bwlm th,
            table.bwlm td {
                padding-top: 8px;
                padding-bottom: 8px;
            }

            table.bwlm code {
                margin-top: 2px;
                display: inline-block;
            }
        </style>
        <?php
    }

    public function get( $array = array(), $key = '', $key2 = '' ) {
        $value = ( empty( $array[ $key ] ) ? '' : $array[ $key ] );
        if ( $value and ! empty( $key2 ) ) {
            return ( empty( $value[ $key2 ] ) ? '' : $value[ $key2 ] );
        }

        return $value;
    }

    public function plugin_action_links( $links ) {
        $action_links = array(
            'settings' => '<a href="' . admin_url( 'options-permalink.php#bwlm-settings' ) .
                          '" title="' . __( 'View Plugin Settings', 'permalink-manager-for-woocommerce' ) . '">' .
                          __( 'Settings', 'permalink-manager-for-woocommerce' ) . '</a>',
        );

        return array_merge( $action_links, $links );
    }

    /* REWRITE PROCESS */

    private function product_base() {
        if ( is_null( $this->product_base ) ) {
            $permalink_structure = wc_get_permalink_structure();
            $this->product_base  = $permalink_structure[ 'product_rewrite_slug' ];
        }

        return $this->product_base;
    }

    private function post_parent_link( $permalink, $post, $hierarchical ) {
        if ( false === strpos( $permalink, '%product_cat%' ) ) {
            return $permalink;
        }
        $term = $this->product_category( $post );

        if ( $term ) {
            $slug      = $this->term_path( $term, $hierarchical, apply_filters( 'wpml_current_language', '' ) );
            $permalink = str_replace( '%product_cat%', $slug, $permalink );
        }

        return $permalink;
    }

    private function product_category( $product ) {
        $term = false;

        if ( $this->has_seo_plugin() ) {
            $primary_term = yoast_get_primary_term_id( 'product_cat', $product->ID );
            $term         = get_term( $primary_term );
        }

        if ( ! $term instanceof \WP_Term ) {
            $term = $this->primary_term( $product );
        }

        return $term;
    }

    protected function has_seo_plugin() {
        if ( ! function_exists( 'is_plugin_active' ) ) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        return function_exists( 'is_plugin_active' ) && defined( 'WPSEO_BASENAME' ) && is_plugin_active( WPSEO_BASENAME ) && function_exists( 'yoast_get_primary_term_id' );
    }

    private function primary_term( $product ) {
        $terms = get_the_terms( $product->ID, 'product_cat' );
        if ( empty( $terms ) ) {
            return null;
        }

        if ( function_exists( 'wp_list_sort' ) ) {
            $terms = wp_list_sort( $terms, 'term_id', 'ASC' );
        } else {
            usort( $terms, '_usort_terms_by_ID' );
        }

        $category_object = apply_filters( 'wc_product_post_type_link_product_cat', $terms[ 0 ], $terms, $product );
        $category_object = get_term( $category_object, 'product_cat' );

        return $category_object;
    }

    private function term_path( $term, $hierarchical, $language_code = '' ) {
        $slug = urldecode( $term->slug );

        if ( $hierarchical && $term->parent ) {
            $ancestors = get_ancestors( $term->term_id, 'product_cat' );
            foreach ( $ancestors as $ancestor ) {
                $ancestor_object = get_term( $ancestor, 'product_cat' );
                $slug            = urldecode( $ancestor_object->slug ) . '/' . $slug;
            }
        }

        if ( $prefix = trim( __($this->get( $this->options, 'prefix' ), 'admin_texts_wc_links'), '/' ) ){
            if ( ! empty( $language_code ) ) {
                $prefix = apply_filters( 'wpml_translate_single_string', $prefix, 'admin_texts_wc_links', '[wc_links]prefix', $language_code );
            }
            if ( strpos( $slug, $prefix . '/' ) === false ) {
                $slug = $prefix . '/' . $slug;
            }
        }

        return $slug;
    }

    public function is_hierarchical( $type ) {
        return $type === 'hierarchical';
    }

    public function rewrite_products( $permalink, $post ) {
        if ( $post->post_type !== 'product' ) {
            return $permalink;
        }

        if ( ! get_option( 'permalink_structure' ) ) {
            return $permalink;
        }

        if ( empty( $this->options[ 'product' ] ) ) {
            return $permalink;
        }

        $product_base = $this->product_base();
        if ( strpos( $product_base, '%product_cat%' ) !== false ) {
            $product_base = str_replace( '%product_cat%', '', $product_base );
        }

        $product_base = '/' . trim( $product_base, '/' ) . '/';
        $link         = $this->post_parent_link( $permalink, $post, $this->is_hierarchical( $this->options[ 'product' ] ) );

        $prefix = '';

        if ( $_prefix = $this->get( $this->options, 'prefix' ) ) {
            $_prefix = apply_filters( 'wpml_translate_single_string', $_prefix, 'admin_texts_wc_links', '[wc_links]prefix' );
            if ( strpos( $link, '/' . $_prefix ) === false ) {
                $prefix = '/' . trim( $_prefix, '/' );
            }
        }

        $link = str_replace( $product_base, $prefix . '/', $link );

        return $link;
    }

    public function rewrite_terms( $link, $term, $taxonomy ) {
        if ( empty( $this->txn_options[ $taxonomy ] ) ) {
            return $link;
        }

        $isHierarchical = $this->is_hierarchical( $this->txn_options[ $taxonomy ] );

        return home_url( user_trailingslashit( $this->term_path( $term, $isHierarchical, apply_filters( 'wpml_current_language', '' ) ) ) );
    }

    public function rewrite_rules( $rules ) {
        if ( empty( $this->txn_options ) ) {
            return $rules;
        }

        wp_cache_flush();

        global $wp_rewrite;

        $feed      = '(' . trim( implode( '|', $wp_rewrite->feeds ) ) . ')';
        $new_rules = array();

        if ( isset( $GLOBALS[ 'sitepress' ] ) ) {
            $sitepress                 = $GLOBALS[ 'sitepress' ];
            $has_get_terms_args_filter = remove_filter( 'get_terms_args', array(
                $sitepress,
                'get_terms_args_filter'
            ) );
            $has_get_term_filter       = remove_filter( 'get_term', array( $sitepress, 'get_term_adjust_id' ), 1 );
            $has_terms_clauses_filter  = remove_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ) );
        }

        $berocket_filters = '';
        if ( class_exists( 'BeRocket_AAPF' ) ) {
            $berocket_filters_links = get_option( 'berocket_permalink_option' );
            $berocket_filters       = ( empty( $berocket_filters_links[ 'variable' ] ) ? '' : $berocket_filters_links[ 'variable' ] );
        }

        foreach ( $this->txn_options as $taxonomy => $option ) {

            if ( ! empty( $option ) ) {
                if ( $taxonomy == 'product_cat' ) {
                    $terms = get_categories( array(
                        'taxonomy'   => $taxonomy,
                        'hide_empty' => false,
                    ) );
                } elseif ( $taxonomy == 'product_tag' ) {
                    $terms = get_terms( 'product_tag' );
                }

                $hierarchical = $this->is_hierarchical( $option );
                $languages = apply_filters( 'wpml_active_languages', '' );
                if ( empty( $languages ) ) {
                    $languages = array( array( 'language_code' => "" ) );
                }
                foreach ( $terms as $term ) {
                    foreach ( $languages as $language ) {
                        $slug = $this->term_path( $term, $hierarchical, $language['language_code'] );
                        if ( $berocket_filters ) {
                            $new_rules[ "{$slug}/{$berocket_filters}/(.*)/?\$" ] = 'index.php?' . $taxonomy . '=' . $term->slug . '&filters=$matches[1]&bwlm=' . $taxonomy;
                        }

                        $new_rules[ "{$slug}/?\$" ]                                             = 'index.php?' . $taxonomy . '=' . $term->slug . '&bwlm=' . $taxonomy;
                        $new_rules[ "{$slug}/embed/?\$" ]                                       = 'index.php?' . $taxonomy . '=' . $term->slug . '&embed=true&bwlm=' . $taxonomy;
                        $new_rules[ "{$slug}/{$wp_rewrite->feed_base}/{$feed}/?\$" ]            = 'index.php?' . $taxonomy . '=' . $term->slug . '&feed=$matches[1]&bwlm=' . $taxonomy;
                        $new_rules[ "{$slug}/{$feed}/?\$" ]                                     = 'index.php?' . $taxonomy . '=' . $term->slug . '&feed=$matches[1]&bwlm=' . $taxonomy;
                        $new_rules[ "{$slug}/{$wp_rewrite->pagination_base}/?([0-9]{1,})/?\$" ] = 'index.php?' . $taxonomy . '=' . $term->slug . '&paged=$matches[1]&bwlm=' . $taxonomy;
                    }
                }
            }
        }

        if ( isset( $sitepress ) ) {
            if ( ! empty( $has_terms_clauses_filter ) ) {
                add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 3 );
            }

            if ( ! empty( $has_get_term_filter ) ) {
                add_filter( 'get_term', array( $sitepress, 'get_term_adjust_id' ), 1, 1 );
            }

            if ( ! empty( $has_get_terms_args_filter ) ) {
                add_filter( 'get_terms_args', array( $sitepress, 'get_terms_args_filter' ), 10, 2 );
            }
        }

        return $new_rules + $rules;
    }

    public function request( $request ) {
        global $wp, $wpdb;
        $url = $wp->request;

        if ( ! empty( $url ) ) {
            $url     = explode( '/', $url );
            $slug    = array_pop( $url );
            $replace = array();

            if ( $slug === 'feed' ) {
                $replace[ 'feed' ] = $slug;
                $slug              = array_pop( $url );
            }

            if ( $slug === 'amp' ) {
                $replace[ 'amp' ] = $slug;
                $slug             = array_pop( $url );
            }

            $comments_position = strpos( $slug, 'comment-page-' );

            if ( $comments_position === 0 ) {
                $replace[ 'cpage' ] = substr( $slug, strlen( 'comment-page-' ) );
                $slug               = array_pop( $url );
            }

            $sql   = "SELECT COUNT(ID) as count_id FROM {$wpdb->posts} WHERE post_name = %s AND post_type = %s";
            $query = $wpdb->prepare( $sql, array( $slug, 'product' ) );
            $num   = intval( $wpdb->get_var( $query ) );

            if ( $num > 0 ) {
                if ( empty( $request[ 'product' ] ) ) {
                    global $bwlm;
                    $bwlm = 'product';
                }

                $replace[ 'page' ]      = '';
                $replace[ 'post_type' ] = 'product';
                $replace[ 'product' ]   = $slug;
                $replace[ 'name' ]      = $slug;

                return $replace;
            }

        }

        return $request;
    }

    public function query_vars( $vars ) {
        $vars[] = 'bwlm';

        return $vars;
    }

    public function redirect_301() {
        global $wp, $bwlm;

        if ( $this->get( $this->options, 'redirect_old_links' ) and empty( $wp->query_vars[ 'bwlm' ] ) and empty( $bwlm ) and is_woocommerce() and ! is_admin() and ! is_preview() ) {
            if ( is_product_category() and $this->options[ 'category' ] ) {
                global $wp_query;
                $queried_object = $wp_query->get_queried_object();
                $url            = get_term_link( $queried_object->term_id, 'product_cat' );
            }

            if ( is_product_tag() and $this->options[ 'tag' ] ) {
                global $wp_query;
                $queried_object = $wp_query->get_queried_object();
                $url            = get_term_link( $queried_object->term_id, 'product_tag' );
            }

            if ( is_product() and $this->options[ 'product' ] ) {
                global $wp_query;
                $queried_object = $wp_query->get_queried_object();
                $url            = get_the_permalink( $queried_object->ID );
            }

            if ( ! empty( $url ) ) {
                wp_safe_redirect( $url, 301 );
                exit();
            }
        }
    }

			


	/* Add to breadcrumb */

    public function update_woocommerce_breadcrumb( $crumbs ) {
        $shop_id  = wc_get_page_id('shop');
        if ( empty( $crumbs ) or empty( $crumbs[0] ) or is_shop() or ! $shop_id ) return $crumbs;

        $home     = $crumbs[0];
        $shop_url = get_permalink( $shop_id );

        if ( rtrim( $home[1] , '/' ) != rtrim( $shop_url , '/' ) ) {
            $crumbs[0] = array( get_the_title( $shop_id ), $shop_url );
            array_unshift( $crumbs, $home );
        }

        return $crumbs;
    }
}

new BeRocketLinkManager;



/* remove custom_permalink from backend url box */

function custom_frontend_url( $permalink, $post ) { 
	$custom_permalink = str_replace( '/roxtar_custom_permalink', '',  $permalink );

	return $custom_permalink; 
} 

if ( is_admin() ) {

	add_filter( 'post_type_link', 'custom_frontend_url', 10, 2 );

}     