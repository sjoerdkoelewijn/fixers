<?php
/**
 * Roxtar Class
 *
 * @package  roxtar
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Roxtar' ) ) {
	/**
	 * The main Roxtar class
	 */
	class Roxtar {

		/**
		 * Setup class.
		 */
		public function __construct() {
			// Set the content width based on the theme's design and stylesheet.
			$this->roxtar_content_width();
			$this->roxtar_includes();

			// Add theme version into html tag.
			add_filter( 'language_attributes', 'roxtar_info' );

			add_action( 'after_setup_theme', array( $this, 'roxtar_setup' ) );
			add_action( 'wp', array( $this, 'roxtar_wp_action' ) );
			add_action( 'widgets_init', array( $this, 'roxtar_widgets_init' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'roxtar_scripts' ), 10 );
			add_filter( 'wpcf7_load_css', '__return_false' );
			add_filter( 'excerpt_length', array( $this, 'roxtar_limit_excerpt_character' ), 99 );

			// ELEMENTOR.
			add_action( 'elementor/theme/register_locations', array( $this, 'roxtar_register_elementor_locations' ) );
			add_action( 'elementor/preview/enqueue_scripts', array( $this, 'roxtar_elementor_preview_scripts' ) );

			// Add Image column on blog list in admin screen.
			add_filter( 'manage_post_posts_columns', array( $this, 'roxtar_columns_head' ), 10 );
			add_action( 'manage_post_posts_custom_column', array( $this, 'roxtar_columns_content' ), 10, 2 );

			add_filter( 'body_class', array( $this, 'roxtar_body_classes' ) );
			add_filter( 'wp_page_menu_args', array( $this, 'roxtar_page_menu_args' ) );
			add_filter( 'navigation_markup_template', array( $this, 'roxtar_navigation_markup_template' ) );
			add_action( 'customize_preview_init', array( $this, 'roxtar_customize_live_preview' ) );
			add_filter( 'wp_tag_cloud', array( $this, 'roxtar_remove_tag_inline_style' ) );
			add_filter( 'excerpt_more', array( $this, 'roxtar_modify_excerpt_more' ) );

			// Compatibility.
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'roxtar_add_elementor_widget' ) );
			add_filter( 'the_content', array( $this, 'roxtar_modify_the_content' ) );
			add_action( 'init', array( $this, 'roxtar_override_divi_color_pciker' ), 12 );
		}

		/**
		 * Add elementor widget
		 */
		public function roxtar_add_elementor_widget() {
			if ( ! roxtar_is_elementor_activated() ) {
				return;
			}

			require_once ROXTAR_THEME_DIR . 'inc/compatibility/elementor/class-roxtar-elementor-single-product-images.php';
		}

		/**
		 * Modify content
		 *
		 * @param      object $content The content.
		 */
		public function roxtar_modify_the_content( $content ) {
			if ( ! defined( 'ET_BUILDER_PLUGIN_VERSION' ) ) {
				return $content;
			}

			return et_builder_get_layout_opening_wrapper() . $content . et_builder_get_layout_closing_wrapper();
		}

		/**
		 * Modify again for Divi, lol
		 */
		public function roxtar_override_divi_color_pciker() {
			if ( ! defined( 'ET_BUILDER_PLUGIN_VERSION' ) || ! is_customize_preview() ) {
				return;
			}

			wp_localize_script(
				'wp-color-picker',
				'wpColorPickerL10n',
				array(
					'clear'            => __( 'Clear', 'roxtar' ),
					'clearAriaLabel'   => __( 'Clear color', 'roxtar' ),
					'defaultString'    => __( 'Default', 'roxtar' ),
					'defaultAriaLabel' => __( 'Select default color', 'roxtar' ),
					'pick'             => __( 'Select Color', 'roxtar' ),
					'defaultLabel'     => __( 'Color value', 'roxtar' ),
				)
			);
		}

		/**
		 * Includes
		 */
		public function roxtar_includes() {
			// Nav menu walker.
			require_once ROXTAR_THEME_DIR . 'inc/class-roxtar-walker-menu.php';
		}

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		public function roxtar_content_width() {
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
		public function roxtar_get_featured_image_src( $post_ID ) {
			$img_id  = get_post_thumbnail_id( $post_ID );
			$img_src = ROXTAR_THEME_URI . 'assets/images/thumbnail-default.jpg';

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
		public function roxtar_columns_head( $defaults ) {
			// See: https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_$post_type_posts_columns.
			$order    = array();
			$checkbox = 'cb';
			foreach ( $defaults as $key => $value ) {
				$order[ $key ] = $value;
				if ( $key === $checkbox ) {
					$order['thumbnail_image'] = __( 'Image', 'roxtar' );
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
		public function roxtar_columns_content( $column_name, $post_ID ) {
			if ( 'thumbnail_image' === $column_name ) {
				$_img_src = $this->roxtar_get_featured_image_src( $post_ID );
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
		 * Note that this function roxtar_is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function roxtar_setup() {
			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			// Loads wp-content/languages/themes/roxtar-it_IT.mo.
			load_theme_textdomain( 'roxtar', WP_LANG_DIR . '/themes/' );

			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain( 'roxtar', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/roxtar/languages/it_IT.mo.
			load_theme_textdomain( 'roxtar', ROXTAR_THEME_DIR . 'languages' );

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
					'roxtar_custom_logo_args',
					array(
						'height'      => 110,
						'width'       => 470,
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
					'roxtar_register_nav_menus',
					array(
						'primary' => __( 'Primary Menu', 'roxtar' ),
						'footer'  => __( 'Footer Menu', 'roxtar' ),
						'mobile'  => __( 'Mobile Menu', 'roxtar' ),
					)
				)
			);

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				apply_filters(
					'roxtar_html5_args',
					array(
						'search-form',
						'comment-form',
						'comment-list',
						'gallery',
						'caption',
						'widgets',
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
			$options = roxtar_options( false );

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
						'name'  => __( 'Primary Color', 'roxtar' ),
						'slug'  => 'roxtar-primary',
						'color' => $options['theme_color'],
					),
					array(
						'name'  => __( 'Background Color', 'roxtar' ),
						'slug'  => 'roxtar-background',
						'color' => $options['background_color'],
					),		
					array(
						'name'  => __( 'Text Color', 'roxtar' ),
						'slug'  => 'roxtar-text',
						'color' => $options['text_color'],
					),					
				)
			);

			// Block Font Sizes.
			add_theme_support(
				'editor-font-sizes',
				array(
					array(
						'name' => __( 'H6', 'roxtar' ),
						'size' => $options['heading_h6_font_size'],
						'slug' => 'roxtar-heading-6',
					),
					array(
						'name' => __( 'H5', 'roxtar' ),
						'size' => $options['heading_h5_font_size'],
						'slug' => 'roxtar-heading-5',
					),
					array(
						'name' => __( 'H4', 'roxtar' ),
						'size' => $options['heading_h4_font_size'],
						'slug' => 'roxtar-heading-4',
					),
					array(
						'name' => __( 'H3', 'roxtar' ),
						'size' => $options['heading_h3_font_size'],
						'slug' => 'roxtar-heading-3',
					),
					array(
						'name' => __( 'H2', 'roxtar' ),
						'size' => $options['heading_h2_font_size'],
						'slug' => 'roxtar-heading-2',
					),
					array(
						'name' => __( 'H1', 'roxtar' ),
						'size' => $options['heading_h1_font_size'],
						'slug' => 'roxtar-heading-1',
					),
				)
			);

			// Boostify Header Footer plugin support.
			add_theme_support( 'boostify-header-footer' );
		}

		/**
		 * WP Action
		 */
		public function roxtar_wp_action() {
			// Support Elementor Pro - Theme Builder.
			if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
				return;
			}

			if ( roxtar_elementor_has_location( 'header' ) && roxtar_elementor_has_location( 'footer' ) ) {
				add_action( 'roxtar_theme_header', 'roxtar_view_open', 0 );
				add_action( 'roxtar_after_footer', 'roxtar_view_close', 0 );
			} elseif ( roxtar_elementor_has_location( 'header' ) && ! roxtar_elementor_has_location( 'footer' ) ) {
				add_action( 'roxtar_theme_header', 'roxtar_view_open', 0 );
			} elseif ( ! roxtar_elementor_has_location( 'header' ) && roxtar_elementor_has_location( 'footer' ) ) {
				add_action( 'roxtar_after_footer', 'roxtar_view_close', 0 );
			}
		}

		/**
		 * Register widget area.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function roxtar_widgets_init() {
			// Roxtar widgets.
			require_once ROXTAR_THEME_DIR . 'inc/widget/class-roxtar-recent-post-thumbnail.php';

			// Setup.
			$sidebar_args['sidebar'] = array(
				'name'          => __( 'Main Sidebar', 'roxtar' ),
				'id'            => 'sidebar',
				'description'   => __( 'Appears in the sidebar of the site.', 'roxtar' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			);

			if ( class_exists( 'woocommerce' ) ) {
				$sidebar_args['shop_sidebar'] = array(
					'name'          => __( 'Woocommerce Sidebar', 'roxtar' ),
					'id'            => 'sidebar-shop',
					'description'   => __( ' Appears in the sidebar of shop/product page.', 'roxtar' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				);
			}

			$sidebar_args['footer'] = array(
				'name'          => __( 'Footer Widget', 'roxtar' ),
				'id'            => 'footer',
				'description'   => __( 'Appears in the footer section of the site.', 'roxtar' ),
				'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</div>',
			);

			$sidebar_args['header_menu'] = array(
				'name'          => __( 'Main Menu Widget', 'roxtar' ),
				'id'            => 'header_menu',
				'description'   => __( 'Appears in the header section of the site next to the main menu.', 'roxtar' ),
				'before_widget' => '<div id="%1$s" class="widget main_menu_widget %2$s">',
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
				$filter_hook = sprintf( 'roxtar_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}

			// Register.
			register_widget( 'Roxtar_Recent_Post_Thumbnail' );
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function roxtar_scripts() {
			$options = roxtar_options( false );

			// Import parent theme if using child-theme.
			if ( is_child_theme() ) {
				wp_enqueue_style(
					'roxtar-parent-style',
					get_template_directory_uri() . '/style.css',
					array(),
					roxtar_version()
				);
			}

			/**
			 * Styles
			 */
			wp_enqueue_style(
				'roxtar-style',
				ROXTAR_THEME_URI . '/assets/css/style.css',
				array(),
				roxtar_version()
			);

			if ( is_rtl() ) {
				wp_enqueue_style(
					'roxtar-rtl',
					ROXTAR_THEME_URI . 'rtl.css',
					array(),
					roxtar_version()
				);
			}

			/**
			 * Scripts
			 */
			// For IE.
			if ( 'ie' === roxtar_browser_detection() ) {
				// Fetch API polyfill.
				wp_enqueue_script(
					'roxtar-fetch-api-polyfill',
					ROXTAR_THEME_URI . 'assets/js/fetch-api-polyfill' . roxtar_suffix() . '.js',
					array(),
					roxtar_version(),
					true
				);

				// Foreach polyfill.
				wp_enqueue_script(
					'roxtar-for-each-polyfill',
					ROXTAR_THEME_URI . 'assets/js/for-each-polyfill' . roxtar_suffix() . '.js',
					array(),
					roxtar_version(),
					true
				);
			}

			// General script.
			wp_enqueue_script(
				'roxtar-general',
				ROXTAR_THEME_URI . 'assets/js/general' . roxtar_suffix() . '.js',
				array( 'jquery' ),
				roxtar_version(),
				true
			);

			// Mobile menu.
			wp_enqueue_script(
				'roxtar-navigation',
				ROXTAR_THEME_URI . 'assets/js/navigation' . roxtar_suffix() . '.js',
				array( 'jquery' ),
				roxtar_version(),
				true
			);

			// Quantity button.
			wp_register_script(
				'roxtar-quantity-button',
				ROXTAR_THEME_URI . 'assets/js/woocommerce/quantity-button' . roxtar_suffix() . '.js',
				array(),
				roxtar_version(),
				true
			);

			// Multi step checkout.
			wp_register_script(
				'roxtar-multi-step-checkout',
				ROXTAR_THEME_URI . 'assets/js/woocommerce/multi-step-checkout' . roxtar_suffix() . '.js',
				array(),
				roxtar_version(),
				true
			);

			if ( class_exists( 'woocommerce' ) && is_checkout() ) {
				$wc_total = WC()->cart->get_totals();
				$price    = (float) $wc_total['total'] - (float) $wc_total['discount_total'];

				wp_localize_script(
					'roxtar-multi-step-checkout',
					'roxtar_multi_step_checkout',
					array(
						'ajax_none'     => wp_create_nonce( 'roxtar_update_checkout_nonce' ),
						'price'         => empty( $wc_total['discount_total'] ) ? false : wc_price( $price ),
						'content_total' => wp_kses( wc_price( $wc_total['cart_contents_total'] ), array() ),
						'cart_total'    => wp_kses( wc_price( $wc_total['total'] ), array() ),
					)
				);
			}

			// Woocommerce sidebar for mobile.
			wp_register_script(
				'roxtar-woocommerce-sidebar',
				ROXTAR_THEME_URI . 'assets/js/woocommerce/woocommerce-sidebar' . roxtar_suffix() . '.js',
				array(),
				roxtar_version(),
				true
			);

			// Woocommerce.
			wp_register_script(
				'roxtar-woocommerce',
				ROXTAR_THEME_URI . 'assets/js/woocommerce/woocommerce' . roxtar_suffix() . '.js',
				array( 'jquery', 'roxtar-quantity-button' ),
				roxtar_version(),
				true
			);

			if ( $options['shop_single_image_zoom'] ) {
				// Product gallery zoom.
				wp_register_script(
					'easyzoom',
					ROXTAR_THEME_URI . 'assets/js/easyzoom' . roxtar_suffix() . '.js',
					array( 'jquery' ),
					roxtar_version(),
					true
				);

				// Product gallery zoom handle.
				wp_register_script(
					'easyzoom-handle',
					ROXTAR_THEME_URI . 'assets/js/woocommerce/easyzoom-handle' . roxtar_suffix() . '.js',
					array( 'easyzoom' ),
					roxtar_version(),
					true
				);
			}

			// Product varitions.
			wp_register_script(
				'roxtar-product-variation',
				ROXTAR_THEME_URI . 'assets/js/woocommerce/product-variation' . roxtar_suffix() . '.js',
				array( 'jquery' ),
				roxtar_version(),
				true
			);

			// Lightbox js.
			wp_register_script(
				'lity',
				ROXTAR_THEME_URI . 'assets/js/lity' . roxtar_suffix() . '.js',
				array( 'jquery' ),
				roxtar_version(),
				true
			);

			// Sticky sidebar js.
			wp_register_script(
				'sticky-sidebar',
				ROXTAR_THEME_URI . 'assets/js/sticky-sidebar' . roxtar_suffix() . '.js',
				array(),
				roxtar_version(),
				true
			);

			// Tiny slider js.
			wp_register_script(
				'tiny-slider',
				ROXTAR_THEME_URI . 'assets/js/tiny-slider' . roxtar_suffix() . '.js',
				array(),
				roxtar_version(),
				true
			);

			// Product images ( Tiny slider ).
			wp_register_script(
				'roxtar-product-images',
				ROXTAR_THEME_URI . 'assets/js/woocommerce/product-images' . roxtar_suffix() . '.js',
				array( 'jquery', 'tiny-slider' ),
				roxtar_version(),
				true
			);

			if ( $options['shop_single_image_lightbox'] ) {
				// Photoswipe init js.
				wp_register_script(
					'photoswipe-init',
					ROXTAR_THEME_URI . 'assets/js/photoswipe-init' . roxtar_suffix() . '.js',
					array( 'photoswipe', 'photoswipe-ui-default' ),
					roxtar_version(),
					true
				);
			}

			// Ajax single add to cart.
			if ( $options['shop_single_ajax_add_to_cart'] ) {
				wp_register_script(
					'roxtar-single-add-to-cart',
					ROXTAR_THEME_URI . 'assets/js/woocommerce/ajax-single-add-to-cart' . roxtar_suffix() . '.js',
					array(),
					roxtar_version(),
					true
				);
			}

			// Comment reply.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Support Elementor Location
		 *
		 * @param      array|object $elementor_theme_manager  The elementor theme manager.
		 */
		public function roxtar_register_elementor_locations( $elementor_theme_manager ) {
			$elementor_theme_manager->register_location(
				'header',
				array(
					'hook'         => 'roxtar_theme_header',
					'remove_hooks' => array( 'roxtar_template_header' ),
				)
			);
			$elementor_theme_manager->register_location(
				'footer',
				array(
					'hook'         => 'roxtar_theme_footer',
					'remove_hooks' => array( 'roxtar_template_footer' ),
				)
			);
			$elementor_theme_manager->register_location(
				'single',
				array(
					'hook'         => 'roxtar_theme_single',
					'remove_hooks' => array( 'roxtar_template_single' ),
				)
			);
			$elementor_theme_manager->register_location(
				'product_archive',
				array(
					'hook'         => 'roxtar_theme_archive',
					'remove_hooks' => array( 'roxtar_template_archive' ),
				)
			);
			$elementor_theme_manager->register_location(
				'404',
				array(
					'hook'         => 'roxtar_theme_404',
					'remove_hooks' => array( 'roxtar_template_404' ),
					'label'        => __( 'Roxtar 404', 'roxtar' ),
				)
			);
		}

		/**
		 * Elementor pewview scripts
		 */
		public function roxtar_elementor_preview_scripts() {
			// Elementor widgets js.
			wp_enqueue_script(
				'roxtar-elementor-live-preview',
				ROXTAR_THEME_URI . 'assets/js/elementor-preview' . roxtar_suffix() . '.js',
				array(),
				roxtar_version(),
				true
			);
		}

		/**
		 * Limit the character length in exerpt
		 *
		 * @param      int $length The length.
		 */
		public function roxtar_limit_excerpt_character( $length ) {
			// Don't change anything inside /wp-admin/.
			if ( is_admin() ) {
				return $length;
			}

			$options = roxtar_options( false );
			$length  = $options['blog_list_limit_exerpt'];
			return $length;
		}

		/**
		 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
		 *
		 * @param array $args Configuration arguments.
		 * @return array
		 */
		public function roxtar_page_menu_args( $args ) {
			$args['show_home'] = true;
			return $args;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function roxtar_body_classes( $classes ) {
			// Get theme options.
			$options = roxtar_options( false );

			// Broser detection.
			if ( roxtar_browser_detection() ) {
				$classes[] = roxtar_browser_detection() . '-detected';
			}

			// Detect site using child theme.
			if ( is_child_theme() ) {
				$classes[] = 'child-theme-detected';
			}

			// Site container layout.
			$classes[] = roxtar_get_site_container_class();

			// Header layout.
			$classes[] = apply_filters( 'roxtar_has_header_layout_classes', 'has-header-' . $options['header_layout'] );

			// Header transparent.
			if ( roxtar_header_transparent() ) {
				$classes[] = 'has-header-transparent header-transparent-for-' . $options['header_transparent_enable_on'];
			}

			// Sidebar class detected.
			$classes[] = roxtar_sidebar_class();

			// Blog page layout.
			if ( roxtar_is_blog() && ! is_singular( 'post' ) ) {
				$classes[] = 'blog-layout-' . $options['blog_list_layout'];
			}

			// Detect page created by Divi builder.
			if ( roxtar_is_divi_page() ) {
				$classes[] = 'edited-by-divi-builder';
			}

			return array_filter( $classes );
		}

		/**
		 * Custom navigation markup template hooked into `navigation_markup_template` filter hook.
		 */
		public function roxtar_navigation_markup_template() {
			$template  = '<nav class="post-navigation navigation %1$s" aria-label="' . esc_attr__( 'Post Pagination', 'roxtar' ) . '">';
			$template .= '<h2 class="screen-reader-text">%2$s</h2>';
			$template .= '<div class="nav-links">%3$s</div>';
			$template .= '</nav>';

			return apply_filters( 'roxtar_navigation_markup_template', $template );
		}

		/**
		 * Customizer live preview
		 */
		public function roxtar_customize_live_preview() {
			wp_enqueue_script(
				'roxtar-customizer-preview',
				ROXTAR_THEME_URI . 'assets/js/customizer-preview' . roxtar_suffix() . '.js',
				array( 'jquery' ),
				roxtar_version(),
				true
			);
		}

		/**
		 * Remove inline css on tag cloud
		 *
		 * @param string $string tagCloud.
		 */
		public function roxtar_remove_tag_inline_style( $string ) {
			return preg_replace( '/ style=("|\')(.*?)("|\')/', '', $string );
		}


		/**
		 * Modify excerpt more to `...`
		 *
		 * @param string $more More exerpt.
		 */
		public function roxtar_modify_excerpt_more( $more ) {
			// Don't change anything inside /wp-admin/.
			if ( is_admin() ) {
				return $more;
			}

			$more = apply_filters( 'roxtar_excerpt_more', '...' );
			return $more;
		}
	}

	$roxtar = new Roxtar();
}
