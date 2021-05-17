<?php
/**
 * SKDD Class
 *
 * @package  SKDD
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'SKDD' ) ) {
	/**
	 * The main SKDD class
	 */
	class SKDD {

		/**
		 * Setup class.
		 */
		public function __construct() {
			// Set the content width based on the theme's design and stylesheet.
			$this->SKDD_content_width();
			$this->SKDD_includes();

			// Add theme version into html tag.
			add_filter( 'language_attributes', 'SKDD_info' );

			add_action( 'after_setup_theme', array( $this, 'SKDD_setup' ) );
			add_action( 'widgets_init', array( $this, 'SKDD_widgets_init' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'SKDD_scripts' ), 10 );
			add_filter( 'excerpt_length', array( $this, 'SKDD_limit_excerpt_character' ), 99 );

			// Add Image column on blog list in admin screen.
			add_filter( 'manage_post_posts_columns', array( $this, 'SKDD_columns_head' ), 10 );
			add_action( 'manage_post_posts_custom_column', array( $this, 'SKDD_columns_content' ), 10, 2 );

			add_filter( 'body_class', array( $this, 'SKDD_body_classes' ) );
			add_filter( 'wp_page_menu_args', array( $this, 'SKDD_page_menu_args' ) );
			add_filter( 'navigation_markup_template', array( $this, 'SKDD_navigation_markup_template' ) );
			add_action( 'customize_preview_init', array( $this, 'SKDD_customize_live_preview' ) );
			add_filter( 'wp_tag_cloud', array( $this, 'SKDD_remove_tag_inline_style' ) );
			add_filter( 'excerpt_more', array( $this, 'SKDD_modify_excerpt_more' ) );

			// Compatibility.
			//add_filter( 'the_content', array( $this, 'SKDD_modify_the_content' ) );
		}


	


		/**
		 * Includes
		 */
		public function SKDD_includes() {
			// Nav menu walker.
			require_once SKDD_THEME_DIR . 'inc/class-SKDD-walker-menu.php';			
		}

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		public function SKDD_content_width() {
			if ( ! isset( $content_width ) ) {
				// Pixel.
				$content_width = 1170;
			}
		}

		/**
		 * Get featured image
		 *
		 * @param      int $post_ID The post id.
		 * @return     string Image src.
		 */
		public function SKDD_get_featured_image_src( $post_ID ) {
			$img_id  = get_post_thumbnail_id( $post_ID );
			$img_src = SKDD_THEME_URI . 'assets/images/thumbnail-default.jpg';

			if ( $img_id ) {
				$src = wp_get_attachment_image_src( $img_id, 'thumbnail' );
				if ( $src ) {
					$img_src = $src[0];
				}
			}

			return $img_src;
		}

		/**
		 * Column head
		 *
		 * @param      array $defaults  The defaults.
		 */
		public function SKDD_columns_head( $defaults ) {
			// See: https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_$post_type_posts_columns.
			$order    = array();
			$checkbox = 'cb';
			foreach ( $defaults as $key => $value ) {
				$order[ $key ] = $value;
				if ( $key === $checkbox ) {
					$order['thumbnail_image'] = __( 'Image', 'SKDD' );
				}
			}

			return $order;
		}

		/**
		 * Column content
		 *
		 * @param      string $column_name  The column name.
		 * @param      int    $post_ID      The post id.
		 */
		public function SKDD_columns_content( $column_name, $post_ID ) {
			if ( 'thumbnail_image' === $column_name ) {
				$_img_src = $this->SKDD_get_featured_image_src( $post_ID );
				?>
					<a href="<?php echo esc_url( get_edit_post_link( $post_ID ) ); ?>">
						<img src="<?php echo esc_url( $_img_src ); ?>"/>
					</a>
				<?php
			}
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function SKDD_is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function SKDD_setup() {
			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			// Loads wp-content/languages/themes/SKDD-it_IT.mo.
			load_theme_textdomain( 'SKDD', WP_LANG_DIR . '/themes/' );

			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain( 'SKDD', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/SKDD/languages/it_IT.mo.
			load_theme_textdomain( 'SKDD', SKDD_THEME_DIR . 'languages' );

			/**
			 * Add default posts and comments RSS feed links to head.
			 */
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );


			// Post formats.
			add_theme_support(
				'post-formats',
				array(
					'gallery',
					'image',
					'link',
					'quote',
					'video',
					'audio',
					'status',
					'aside',
				)
			);

			/**
			 * Enable support for site logo.
			 */
			add_theme_support(
				'custom-logo',
				apply_filters(
					'SKDD_custom_logo_args',
					array(
						//'height'      => 110,
						//'width'       => 470,
						'flex-width'  => true,
						'flex-height' => true,
					)
				)
			);

			/**
			 * Register menu locations.
			 */
			register_nav_menus(
				apply_filters(
					'SKDD_register_nav_menus',
					array(
						'primary' => __( 'Primary Menu', 'SKDD' ),
						'footer'  => __( 'Footer Menu', 'SKDD' ),
						'mobile'  => __( 'Mobile Menu', 'SKDD' ),
					)
				)
			);

			/*
			 * Switch default core markup to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				apply_filters(
					'SKDD_html5_args',
					array(
						'search-form',
						'comment-form',
						'comment-list',
						'gallery',
						'caption',
						'widgets',
						'script',
						'style',
					)
				)
			);


			/**
			 * Declare support for title theme feature.
			 */
			add_theme_support( 'title-tag' );

			/**
			 * Declare support for selective refreshing of widgets.
			 */
			add_theme_support( 'customize-selective-refresh-widgets' );

			/**
			 * Gutenberg.
			 */
			$options = SKDD_options( false );

			// Default block styles.
			add_theme_support( 'wp-block-styles' );

			// Responsive embedded content.
			add_theme_support( 'responsive-embeds' );

			// Editor styles.
			add_theme_support( 'editor-styles' );

			// Wide Alignment.
			add_theme_support( 'align-wide' );

			// Editor Color Palette.
			add_theme_support(
				'editor-color-palette',
				array(
					array(
						'name'  => __( 'Primary Color', 'SKDD' ),
						'slug'  => 'SKDD-primary',
						'color' => $options['theme_color'],
					),
					array(
						'name'  => __( 'Secondary Color', 'SKDD' ),
						'slug'  => 'SKDD-secondary',
						'color' => $options['secondary_theme_color'],
					),
					array(
						'name'  => __( 'Tertiary Color', 'SKDD' ),
						'slug'  => 'SKDD-tertiary',
						'color' => $options['tertiary_theme_color'],
					),
					array(
						'name'  => __( 'Background Color', 'SKDD' ),
						'slug'  => 'SKDD-background',
						'color' => $options['background_color'],
					),
					array(
						'name'  => __( 'Secondary Background Color', 'SKDD' ),
						'slug'  => 'SKDD-secondary-background',
						'color' => $options['second_background_color'],
					),
					array(
						'name'  => __( 'Text Color', 'SKDD' ),
						'slug'  => 'SKDD-text',
						'color' => $options['text_color'],
					),		
					array(
						'name'  => __( 'Offset Color', 'SKDD' ),
						'slug'  => 'SKDD-offset',
						'color' => $options['offset_color'],
					),				
				)
			);

			// Block Font Sizes.
			add_theme_support(
				'editor-font-sizes',
				array(
					array(
						'name' => __( 'H6', 'SKDD' ),
						'size' => $options['heading_h6_font_size'],
						'slug' => 'SKDD-heading-6',
					),
					array(
						'name' => __( 'H5', 'SKDD' ),
						'size' => $options['heading_h5_font_size'],
						'slug' => 'SKDD-heading-5',
					),
					array(
						'name' => __( 'H4', 'SKDD' ),
						'size' => $options['heading_h4_font_size'],
						'slug' => 'SKDD-heading-4',
					),
					array(
						'name' => __( 'H3', 'SKDD' ),
						'size' => $options['heading_h3_font_size'],
						'slug' => 'SKDD-heading-3',
					),
					array(
						'name' => __( 'H2', 'SKDD' ),
						'size' => $options['heading_h2_font_size'],
						'slug' => 'SKDD-heading-2',
					),
					array(
						'name' => __( 'H1', 'SKDD' ),
						'size' => $options['heading_h1_font_size'],
						'slug' => 'SKDD-heading-1',
					),
				)
			);

		}

		/**
		 * WP Action
		 */


		/**
		 * Register widget area.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function SKDD_widgets_init() {
			// SKDD widgets.
			require_once SKDD_THEME_DIR . 'inc/widget/class-SKDD-recent-post-thumbnail.php';

			// Setup.
			$sidebar_args['sidebar'] = array(
				'name'          => __( 'Main Sidebar', 'SKDD' ),
				'id'            => 'sidebar',
				'description'   => __( 'Appears in the sidebar of the site.', 'SKDD' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			);

			if ( class_exists( 'woocommerce' ) ) {
				$sidebar_args['shop_sidebar'] = array(
					'name'          => __( 'Woocommerce Sidebar', 'SKDD' ),
					'id'            => 'sidebar-shop',
					'description'   => __( ' Appears in the sidebar of shop/product page.', 'SKDD' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				);
			}

			$sidebar_args['footer'] = array(
				'name'          => __( 'Footer Widget', 'SKDD' ),
				'id'            => 'footer',
				'description'   => __( 'Appears in the footer section of the site.', 'SKDD' ),
				'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</div>',
			);

			$sidebar_args['header_menu'] = array(
				'name'          => __( 'Main Menu Widget', 'SKDD' ),
				'id'            => 'header_menu',
				'description'   => __( 'Appears in the header section of the site next to the main menu.', 'SKDD' ),
				'before_widget' => '<div id="%1$s" class="widget main_menu_widget %2$s">',
				'after_widget'  => '</div>',
			);

			$sidebar_args['mobile_header_menu'] = array(
				'name'          => __( 'Mobile Header Widget', 'SKDD' ),
				'id'            => 'mobile_header_menu',
				'description'   => __( 'Appears in the mobile header in layout 3', 'SKDD' ),
				'before_widget' => '<div id="%1$s" class="mobile_header_widget_area %2$s">',
				'after_widget'  => '</div>',
			);

			$sidebar_args['topbar_widget'] = array(
				'name'          => __( 'Top Bar Widget', 'SKDD' ),
				'id'            => 'topbar_widget',
				'description'   => __( 'Appears in the top bar above the header', 'SKDD' ),
				'before_widget' => '<div id="%1$s" class="topbar-item %2$s">',
				'after_widget'  => '</div>',
			);

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_title' => '<h6 class="widget-title">',
					'after_title'  => '</h6>',
				);

				/**
				 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
				 */
				$filter_hook = sprintf( 'SKDD_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}

			// Register.
			register_widget( 'SKDD_Recent_Post_Thumbnail' );
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function SKDD_scripts() {
			$options = SKDD_options( false );

			// Import parent theme if using child-theme.
			if ( is_child_theme() ) {
				wp_enqueue_style(
					'SKDD-parent-style',
					get_template_directory_uri() . '/style.css',
					array(),
					SKDD_version()
				);
			}
			// Import woocommerce css if applicable
			if ( class_exists( 'woocommerce' ) ) {
				wp_enqueue_style(
					'SKDD-woocommerce-style',
					SKDD_THEME_URI . 'assets/css/woocommerce.css',
					array(),
					SKDD_version()
				);
			}

			/**
			 * Styles
			 */
			wp_enqueue_style(
				'SKDD-style',
				SKDD_THEME_URI . 'assets/css/style.css',
				array(),
				SKDD_version()
			);

			if ( is_rtl() ) {
				wp_enqueue_style(
					'SKDD-rtl',
					SKDD_THEME_URI . 'rtl.css',
					array(),
					SKDD_version()
				);
			}

			wp_enqueue_style(
				'SKDD-small-screen-styles',
				SKDD_THEME_URI . 'assets/css/small-screens.css',
				array(),
				SKDD_version(),
				'all and ( max-width: ' . esc_attr( $options['header_menu_breakpoint'] ) . 'px )'
			);	
			
			wp_enqueue_style(
				'SKDD-large-screen-styles',
				SKDD_THEME_URI . 'assets/css/large-screens.css',
				array(),
				SKDD_version(),
				'all and ( min-width: ' . esc_attr( $options['header_menu_breakpoint'] + 1 ) . 'px )'
			);

			/**
			 * Scripts
			 */
			// For IE.
			if ( 'ie' === SKDD_browser_detection() ) {
				// Fetch API polyfill.
				wp_enqueue_script(
					'SKDD-fetch-api-polyfill',
					SKDD_THEME_URI . 'assets/js/fetch-api-polyfill' . SKDD_suffix() . '.js',
					array(),
					SKDD_version(),
					true
				);

				// Foreach polyfill.
				wp_enqueue_script(
					'SKDD-for-each-polyfill',
					SKDD_THEME_URI . 'assets/js/for-each-polyfill' . SKDD_suffix() . '.js',
					array(),
					SKDD_version(),
					true
				);
			}

			// General script.
			wp_enqueue_script(
				'SKDD-general',
				SKDD_THEME_URI . 'assets/js/general' . SKDD_suffix() . '.js',
				array( 'jquery' ),
				SKDD_version(),
				true
			);

			// Mobile menu.
			wp_enqueue_script(
				'SKDD-navigation',
				SKDD_THEME_URI . 'assets/js/navigation' . SKDD_suffix() . '.js',
				array( 'jquery' ),
				SKDD_version(),
				true
			);

			// Quantity button.
			wp_register_script(
				'SKDD-quantity-button',
				SKDD_THEME_URI . 'assets/js/woocommerce/quantity-button' . SKDD_suffix() . '.js',
				array(),
				SKDD_version(),
				true
			);

			// Multi step checkout.
			wp_register_script(
				'SKDD-multi-step-checkout',
				SKDD_THEME_URI . 'assets/js/woocommerce/multi-step-checkout' . SKDD_suffix() . '.js',
				array(),
				SKDD_version(),
				true
			);

			if ( class_exists( 'woocommerce' ) && is_checkout() ) {
				$wc_total = WC()->cart->get_totals();
				$price    = (float) $wc_total['total'] - (float) $wc_total['discount_total'];

				wp_localize_script(
					'SKDD-multi-step-checkout',
					'SKDD_multi_step_checkout',
					array(
						'ajax_none'     => wp_create_nonce( 'SKDD_update_checkout_nonce' ),
						'price'         => empty( $wc_total['discount_total'] ) ? false : wc_price( $price ),
						'content_total' => wp_kses( wc_price( $wc_total['cart_contents_total'] ), array() ),
						'cart_total'    => wp_kses( wc_price( $wc_total['total'] ), array() ),
					)
				);
			}

			// Woocommerce sidebar for mobile.
			wp_register_script(
				'SKDD-woocommerce-sidebar',
				SKDD_THEME_URI . 'assets/js/woocommerce/woocommerce-sidebar' . SKDD_suffix() . '.js',
				array(),
				SKDD_version(),
				true
			);

			// Woocommerce.
			wp_register_script(
				'SKDD-woocommerce',
				SKDD_THEME_URI . 'assets/js/woocommerce/woocommerce' . SKDD_suffix() . '.js',
				array( 'jquery', 'SKDD-quantity-button' ),
				SKDD_version(),
				true
			);

			

			// Product variations.
			wp_register_script(
				'SKDD-product-variation',
				SKDD_THEME_URI . 'assets/js/woocommerce/product-variation' . SKDD_suffix() . '.js',
				array( 'jquery' ),
				SKDD_version(),
				true
			);			

			// Sticky sidebar js.
			wp_register_script(
				'sticky-sidebar',
				SKDD_THEME_URI . 'assets/js/sticky-sidebar' . SKDD_suffix() . '.js',
				array(),
				SKDD_version(),
				true
			);

			// Only load on woocommerce single product page
			if ( SKDD_is_woocommerce_activated() && is_product() ){

				if ( $options['shop_single_image_zoom'] ) {
					// Product gallery zoom.
					wp_register_script(
						'easyzoom',
						SKDD_THEME_URI . 'assets/js/easyzoom' . SKDD_suffix() . '.js',
						array( 'jquery' ),
						SKDD_version(),
						true
					);
	
					// Product gallery zoom handle.
					wp_register_script(
						'easyzoom-handle',
						SKDD_THEME_URI . 'assets/js/woocommerce/easyzoom-handle' . SKDD_suffix() . '.js',
						array( 'easyzoom' ),
						SKDD_version(),
						true
					);
				}

				// Lightbox js.
				wp_register_script(
					'lity',
					SKDD_THEME_URI . 'assets/js/lity' . SKDD_suffix() . '.js',
					array( 'jquery' ),
					SKDD_version(),
					true
				);

				// Tiny slider js.
				wp_register_script(
					'tiny-slider',
					SKDD_THEME_URI . 'assets/js/tiny-slider' . SKDD_suffix() . '.js',
					array(),
					SKDD_version(),
					true
				);

				// Product images ( Tiny slider ).
				wp_register_script(
					'SKDD-product-images',
					SKDD_THEME_URI . 'assets/js/woocommerce/product-images' . SKDD_suffix() . '.js',
					array( 'jquery', 'tiny-slider' ),
					SKDD_version(),
					true
				);

				if ( $options['shop_single_image_lightbox'] ) {
					// Photoswipe init js.
					wp_register_script(
						'photoswipe-init',
						SKDD_THEME_URI . 'assets/js/photoswipe-init' . SKDD_suffix() . '.js',
						array( 'photoswipe', 'photoswipe-ui-default' ),
						SKDD_version(),
						true
					);
				}

			}

			// Ajax single add to cart.
			if ( $options['shop_single_ajax_add_to_cart'] ) {
				wp_register_script(
					'SKDD-single-add-to-cart',
					SKDD_THEME_URI . 'assets/js/woocommerce/ajax-single-add-to-cart' . SKDD_suffix() . '.js',
					array(),
					SKDD_version(),
					true
				);
			}

			// Comment reply.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}


		/**
		 * Limit the character length in exerpt
		 *
		 * @param      int $length The length.
		 */
		public function SKDD_limit_excerpt_character( $length ) {
			// Don't change anything inside /wp-admin/.
			if ( is_admin() ) {
				return $length;
			}

			$options = SKDD_options( false );
			$length  = $options['blog_list_limit_exerpt'];
			return $length;
		}

		/**
		 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
		 *
		 * @param array $args Configuration arguments.
		 * @return array
		 */
		public function SKDD_page_menu_args( $args ) {
			$args['show_home'] = true;
			return $args;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function SKDD_body_classes( $classes ) {
			// Get theme options.
			$options = SKDD_options( false );

			// Broser detection.
			if ( SKDD_browser_detection() ) {
				$classes[] = SKDD_browser_detection() . '-detected';
			}

			// Detect site using child theme.
			if ( is_child_theme() ) {
				$classes[] = 'child-theme-detected';
			}


			// Header layout.
			$classes[] = apply_filters( 'SKDD_has_header_layout_classes', 'has-header-' . $options['header_layout'] );

			// Header transparent.
			if ( SKDD_header_transparent() ) {
				$classes[] = 'has-header-transparent header-transparent-for-' . $options['header_transparent_enable_on'];
			}

			// Sidebar class detected.
			$classes[] = SKDD_sidebar_class();

			// Blog page layout.
			if ( ( SKDD_is_blog() || SKDD_is_cpt() ) && ! is_singular( 'post' ) && ! is_singular( 'portfolio' ) && ! is_singular( 'team' ) && ! is_singular( 'services' ) && ! is_singular( 'knowledge' ) ) {
				$classes[] = 'blog-layout-' . $options['blog_list_layout'];
			}


			return array_filter( $classes );
		}

		/**
		 * Custom navigation markup template hooked into `navigation_markup_template` filter hook.
		 */
		public function SKDD_navigation_markup_template() {
			$template  = '<nav class="post-navigation navigation %1$s" aria-label="' . esc_attr__( 'Post Pagination', 'SKDD' ) . '">';
			$template .= '<h2 class="screen-reader-text">%2$s</h2>';
			$template .= '<div class="nav-links">%3$s</div>';
			$template .= '</nav>';

			return apply_filters( 'SKDD_navigation_markup_template', $template );
		}

		/**
		 * Customizer live preview
		 */
		public function SKDD_customize_live_preview() {
			wp_enqueue_script(
				'SKDD-customizer-preview',
				SKDD_THEME_URI . 'assets/js/customizer-preview' . SKDD_suffix() . '.js',
				array( 'jquery' ),
				SKDD_version(),
				true
			);
		}

		/**
		 * Remove inline css on tag cloud
		 *
		 * @param string $string tagCloud.
		 */
		public function SKDD_remove_tag_inline_style( $string ) {
			return preg_replace( '/ style=("|\')(.*?)("|\')/', '', $string );
		}


		/**
		 * Modify excerpt more to `...`
		 *
		 * @param string $more More exerpt.
		 */
		public function SKDD_modify_excerpt_more( $more ) {
			// Don't change anything inside /wp-admin/.
			if ( is_admin() ) {
				return $more;
			}

			$more = apply_filters( 'SKDD_excerpt_more', '...' );
			return $more;
		}
	}

	$SKDD = new SKDD();
}
