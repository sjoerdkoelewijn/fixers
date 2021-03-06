<?php
/**
 * Roxtar template functions.
 *
 * @package roxtar
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'roxtar_replace_text' ) ) {
	/**
	 * Print dynamic tag like Current year, blog name...
	 *
	 * @param string $output The output value.
	 */
	function roxtar_replace_text( $output ) {
		$output = str_replace( '[current_year]', date_i18n( 'Y' ), $output );
		$output = str_replace( '[site_title]', '<span class="roxtar-site-title">' . get_bloginfo( 'name' ) . '</span>', $output );

		$theme_author = apply_filters(
			'roxtar_theme_author',
			array(
				'theme_name'       => __( 'ROXTAR Online Marketing', 'roxtar' ),
				'theme_author_url' => 'https://roxtar.nl/',
			)
		);

		$output = str_replace( '[theme_author]', '<a href="' . esc_url( $theme_author['theme_author_url'] ) . '">' . $theme_author['theme_name'] . '</a>', $output );

		return wp_specialchars_decode( $output );
	}
}

if ( ! function_exists( 'roxtar_post_related' ) ) {
	/**
	 * Display related post.
	 */
	function roxtar_post_related() {
		$options = roxtar_options( false );

		if ( ! $options['blog_single_related_post'] || ! is_singular( 'post' ) ) {
			return;
		}

		$id = get_queried_object_id();

		$args = array(
			'post_type'           => 'post',
			'post__not_in'        => array( $id ),
			'posts_per_page'      => 3,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
			?>
			<div class="related-box">
				<div class="row">
					<h3 class="related-title"><?php esc_html_e( 'Related Posts', 'roxtar' ); ?></h3>
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();

						$post_id = get_the_ID();
						?>
						<div class="related-post col-md-4">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="entry-header">
									<?php the_post_thumbnail( 'medium' ); ?>
								</a>
							<?php } ?>

							<div class="posted-on"><?php echo get_the_date(); ?></div>
							<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h2>
							<a class="post-read-more" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read more', 'roxtar' ); ?></a>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<?php
			wp_reset_postdata();
		endif;
	}
}

if ( ! function_exists( 'roxtar_display_comments' ) ) {
	/**
	 * Roxtar display comments
	 */
	function roxtar_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( is_single() || is_page() ) {
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		}
	}
}

if ( ! function_exists( 'roxtar_relative_time' ) ) {

	/**
	 * Display relative time for comment
	 *
	 * @param      string $type `comment` or `post`.
	 * @return     string real_time relative time
	 */
	function roxtar_relative_time( $type = 'comment' ) {
		$time      = 'comment' === $type ? 'get_comment_time' : 'get_post_time';
		$timestamp = time() + (int) ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
		$time      = sprintf(
			/* translators: Date time */
			__( '%s ago', 'roxtar' ),
			human_time_diff( $time( 'U' ), $timestamp )
		);

		return apply_filters( 'roxtar_real_time_comment', $time );
	}
}

if ( ! function_exists( 'roxtar_comment' ) ) {
	/**
	 * Roxtar comment template
	 *
	 * @param array $comment the comment array.
	 * @param array $args the comment args.
	 * @param int   $depth the comment depth.
	 */
	function roxtar_comment( $comment, $args, $depth ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>

		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
			<div class="comment-body">
				<?php if ( get_avatar( get_the_author_meta( 'ID' ) ) ) { ?>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 70 ); ?>
					</div>
				<?php } ?>

				<?php if ( 'div' !== $args['style'] ) : ?>
				<div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
				<?php endif; ?>

					<div class="comment-meta commentmetadata">
						<?php printf( wp_kses_post( '<cite class="fn">%s</cite>', 'roxtar' ), get_comment_author_link() ); ?>

						<?php if ( 0 === $comment->comment_approved ) : ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'roxtar' ); ?></em>
						<?php endif; ?>

						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-date">
							<?php echo esc_html( roxtar_relative_time() ); ?>
							<?php echo '<time datetime="' . esc_attr( get_comment_date( 'c' ) ) . '" class="sr-only">' . esc_html( get_comment_date() ) . '</time>'; ?>
						</a>
					</div>

					<div class="comment-text">
						<?php comment_text(); ?>
					</div>

					<div class="reply">
						<?php
							comment_reply_link(
								array_merge(
									$args,
									array(
										'add_below' => $add_below,
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
									)
								)
							);
						?>
						<?php edit_comment_link( __( 'Edit', 'roxtar' ), '  ', '' ); ?>
					</div>

				<?php if ( 'div' !== $args['style'] ) : ?>
				</div>
				<?php endif; ?>
			</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_footer_widgets' ) ) {
	/**
	 * Display the footer widget regions.
	 */
	function roxtar_footer_widgets() {

		// Default values.
		$option        = roxtar_options( false );
		$footer_column = (int) $option['footer_column'];

		if ( 0 === $footer_column ) {
			return;
		}

		if ( is_active_sidebar( 'footer' ) ) {
			?>
			<div class="site-footer-widget footer-widget-col-<?php echo esc_attr( $footer_column ); ?>">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
			<?php
		} elseif ( is_user_logged_in() ) {
			?>
			<div class="site-footer-widget footer-widget-col-<?php echo esc_attr( $footer_column ); ?>">
				<div class="widget widget_text default-widget">
					<h6 class="widgettitle"><?php esc_html_e( 'Footer Widget', 'roxtar' ); ?></h6>
					<div class="textwidget">
						<p>
							<?php
							printf(
								/* translators: 1: admin URL */
								__( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets / Footer Widget</strong></a> and dragging widgets into this widget area.', 'roxtar' ), // phpcs:ignore
								esc_url( admin_url( 'widgets.php' ) )
							);
							?>
						</p>
					</div>
				</div>

				<div class="widget widget_text default-widget">
					<h6 class="widgettitle"><?php esc_html_e( 'Footer Widget', 'roxtar' ); ?></h6>
					<div class="textwidget">
						<p>
							<?php
							printf(
								/* translators: 1: admin URL */
								__( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets / Footer Widget</strong></a> and dragging widgets into this widget area.', 'roxtar' ), // phpcs:ignore
								esc_url( admin_url( 'widgets.php' ) )
							);
							?>
						</p>
					</div>
				</div>

				<div class="widget widget_text default-widget">
					<h6 class="widgettitle"><?php esc_html_e( 'Footer Widget', 'roxtar' ); ?></h6>
					<div class="textwidget">
						<p>
							<?php
							printf(
								/* translators: 1: admin URL */
								__( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets / Footer Widget</strong></a> and dragging widgets into this widget area.', 'roxtar' ), // phpcs:ignore
								esc_url( admin_url( 'widgets.php' ) )
							);
							?>
						</p>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'roxtar_footer_custom_text' ) ) {
	/**
	 * Footer custom text
	 *
	 * @return string $content Footer custom text
	 */
	function roxtar_footer_custom_text() {
		$content = __( 'Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'roxtar' );

		if ( apply_filters( 'roxtar_credit_info', true ) ) {

			if ( apply_filters( 'roxtar_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
				$content .= get_the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			}
		}

		return $content;

	}
}

if ( ! function_exists( 'roxtar_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @return void
	 */
	function roxtar_credit() {
		$options = roxtar_options( false );
		if ( ! $options['footer_custom_text'] && ! has_nav_menu( 'footer' ) ) {
			return;
		}
		?>

		<div class="site-info">
			<?php
			if ( $options['footer_custom_text'] ) {
				$footer_text = roxtar_replace_text( $options['footer_custom_text'] );
				?>
				<div class="site-infor-col">
					<?php echo do_shortcode( $footer_text ); ?>
				</div>
			<?php } ?>

			<?php
			if ( has_nav_menu( 'footer' ) ) {
				echo '<div class="site-infor-col">';
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'roxtar-footer-menu',
							'container'      => '',
							'depth'          => 1,
						)
					);
				echo '</div>';
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @return void
	 */
	function roxtar_site_branding() {
		// Default values.
		$class           = '';
		$mobile_logo_src = '';
		$options         = roxtar_options( false );

		$transparent_logo_src = $options['header_transparent_logo'];

		$classes[] = 'site-branding';

		if ( ! empty( $options['logo_mobile'] ) ) {
			$mobile_logo_src = $options['logo_mobile'];
			$classes[]       = 'has-custom-mobile-logo';
		}

		$transparent_class = roxtar_header_transparent();
		$classes[]         = ( $transparent_class ) ? 'logo-transparent' : '';
		$classes           = implode( ' ', array_filter( $classes ) );

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$normal_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );		

		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
		<?php
		if ( ! roxtar_header_transparent() ) {
			roxtar_site_title_or_logo();
			// Custom mobile logo.
			if ( ! empty( $mobile_logo_src ) ) {
				$mobile_logo_id  = attachment_url_to_postid( $mobile_logo_src );
				$mobile_logo_alt = roxtar_image_alt( $mobile_logo_id, __( 'Roxtar mobile logo', 'roxtar' ) );
				?>
					<a class="custom-mobile-logo-url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
						<img class="custom-mobile-logo" src="<?php echo esc_url( $mobile_logo_src ); ?>" alt="<?php echo esc_attr( $mobile_logo_alt ); ?>" itemprop="logo">
					</a>
				<?php
			}
		} else {
			if ( ! empty( $transparent_logo_src ) ) {
				?>
					<a class="custom-transparent-logo-url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
						<img class="custom-transparent-logo" src="<?php echo esc_url( $transparent_logo_src ); ?>" alt="<?php echo esc_attr( 'Logo transparent' ); ?>" itemprop="logo">
						<img class="normal-logo-active" src="<?php echo $normal_logo[0]; ?>" alt="<?php echo esc_attr( 'Logo' ); ?>" itemprop="logo">
					</a>
				<?php
			} else {
				roxtar_site_title_or_logo();
				// Custom mobile logo.
				if ( ! empty( $mobile_logo_src ) ) {
					$mobile_logo_id  = attachment_url_to_postid( $mobile_logo_src );
					$mobile_logo_alt = roxtar_image_alt( $mobile_logo_id, __( 'Roxtar mobile logo', 'roxtar' ) );
					?>
						<a class="custom-mobile-logo-url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
							<img class="custom-mobile-logo" src="<?php echo esc_url( $mobile_logo_src ); ?>" alt="<?php echo esc_attr( $mobile_logo_alt ); ?>" itemprop="logo">
						</a>
					<?php
				}
			}
		}
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_replace_logo_attr' ) ) {
	/**
	 * Replace header logo.
	 *
	 * @param array  $attr Image.
	 * @param object $attachment Image obj.
	 * @param sting  $size Size name.
	 *
	 * @return array Image attr.
	 */
	function roxtar_replace_logo_attr( $attr, $attachment, $size ) {

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$options        = roxtar_options( false );

		if ( $custom_logo_id === $attachment->ID ) {

			$attr['alt'] = roxtar_image_alt( $custom_logo_id, __( 'Roxtar logo', 'roxtar' ) );

			$attach_data = array();
			if ( ! is_customize_preview() ) {
				$attach_data = wp_get_attachment_image_src( $attachment->ID, 'full' );

				if ( isset( $attach_data[0] ) ) {
					$attr['src'] = $attach_data[0];
				}
			}

			$file_type      = wp_check_filetype( $attr['src'] );
			$file_extension = $file_type['ext'];

			if ( 'svg' === $file_extension ) {
				$attr['width']  = '100%';
				$attr['height'] = '100%';
				$attr['class']  = 'roxtar-logo-svg';
			}

			// Retina logo.
			$retina_logo = $options['retina_logo'];

			$attr['srcset'] = '';

			if ( $retina_logo ) {
				$cutom_logo     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
				$cutom_logo_url = $cutom_logo[0];
				$attr['alt']    = roxtar_image_alt( $custom_logo_id, __( 'Roxtar retina logo', 'roxtar' ) );

				// Replace logo src on IE.
				if ( 'ie' === roxtar_browser_detection() ) {
					$attr['src'] = $retina_logo;
				}

				$attr['srcset'] = $cutom_logo_url . ' 1x, ' . $retina_logo . ' 2x';

			}
		}

		return apply_filters( 'roxtar_replace_logo_attr', $attr );
	}
	add_filter( 'wp_get_attachment_image_attributes', 'roxtar_replace_logo_attr', 10, 3 );
}

if ( ! function_exists( 'roxtar_get_logo_image_url' ) ) {
	/**
	 * Get logo image url
	 *
	 * @param string $size The image size.
	 */
	function roxtar_get_logo_image_url( $size = 'full' ) {
		$options   = roxtar_options( false );
		$image_src = '';

		if ( $options['retina_logo'] ) {
			$image_src = $options['retina_logo'];
		} elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$image_id  = get_theme_mod( 'custom_logo' );
			$image     = wp_get_attachment_image_src( $image_id, $size );
			$image_src = $image[0];
		}

		return $image_src;
	}
}

if ( ! function_exists( 'roxtar_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function roxtar_site_title_or_logo( $echo = true ) {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			// Image logo.
			$logo = get_custom_logo();
			$html = is_home() ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
		} else {
			$tag = is_home() ? 'h1' : 'div';

			$html  = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';
			$html .= '<span class="site-description">' . esc_html( get_bloginfo( 'description' ) ) . '</span>';
		}

		if ( ! $echo ) {
			return $html;
		}

		echo $html; // phpcs:ignore
	}
}

if ( ! function_exists( 'roxtar_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 */
	function roxtar_primary_navigation() {
		// Customize disable primary menu.
		$options             = roxtar_options( false );
		$header_primary_menu = $options['header_primary_menu'];

		if ( ! $header_primary_menu ) {
			return;
		}
		?>

		<div class="site-navigation">
			<?php do_action( 'roxtar_before_main_nav' ); ?>

			<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'roxtar' ); ?>">
				<?php
				if ( has_nav_menu( 'mobile' ) ) {
					$mobile = array(
						'theme_location' => 'mobile',
						'menu_class'     => 'primary-navigation primary-mobile-navigation',
						'container'      => '',
						'walker'         => new Roxtar_Walker_Menu(),
					);

					wp_nav_menu( $mobile );
				}

				if ( has_nav_menu( 'primary' ) ) {
					$args = array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-navigation',
						'container'      => '',
						'walker'         => new Roxtar_Walker_Menu(),
					);

					wp_nav_menu( $args );
				} elseif ( is_user_logged_in() ) {
					?>
					<a class="add-menu" href="<?php echo esc_url( get_admin_url() . 'nav-menus.php' ); ?>"><?php esc_html_e( 'Add a Primary Menu', 'roxtar' ); ?></a>
				<?php } ?>
			</nav>

			<?php do_action( 'roxtar_after_main_nav' ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_skip_links' ) ) {
	/**
	 * Skip links
	 */
	function roxtar_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_html_e( 'Skip to navigation', 'roxtar' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'roxtar' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'roxtar_breadcrumb' ) ) {
	/**
	 * Roxtar breadcrumb
	 */
	function roxtar_breadcrumb() {
		$object        = get_queried_object();
		$home_url      = home_url( '/' );
		$page_id       = roxtar_get_page_id();
		$options       = roxtar_options( false );
		$blog_page_url = get_option( 'page_for_posts' );
		$blog_page_url = 0 !== $blog_page_url ? get_permalink( $blog_page_url ) : $home_url;
		$shop_page_url = '#';
		$breadcrumb    = $options['page_header_breadcrumb'];
		$container[]   = 'roxtar-breadcrumb roxtar-theme-breadcrumb';

		if ( class_exists( 'woocommerce' ) ) {
			$shop_page_url = wc_get_page_permalink( 'shop' );

			if ( is_singular( 'product' ) ) {
				$breadcrumb = $options['shop_single_breadcrumb'];
			} elseif ( roxtar_is_woocommerce_page() ) {
				$breadcrumb = $options['shop_page_breadcrumb'];
			}
		}

		$container = implode( ' ', $container );

		if ( is_front_page() || ! $breadcrumb ) {
			return;
		}
		?>

		<nav class="<?php echo esc_attr( $container ); ?>" itemscope itemtype="http://schema.org/BreadcrumbList">
			<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="<?php echo esc_url( $home_url ); ?>">
					<span itemprop="name"><?php echo esc_html( apply_filters( 'roxtar_breadcrumb_home', get_bloginfo( 'name' ) ) ); ?></span>
				</a>
				<meta itemprop="position" content="1"></span>
			</span>

			<?php
			// Single product.
			if ( class_exists( 'woocommerce' ) && is_singular( 'product' ) ) {
				$terms = get_the_terms( $page_id, 'product_cat' );

				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					?>
					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( $shop_page_url ); ?>">
							<span itemprop="name"><?php esc_html_e( 'Shop', 'roxtar' ); ?></span>
						</a>
						<meta itemprop="position" content="2"></span>
					</span>

					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( get_term_link( $terms[0]->term_id, 'product_cat' ) ); ?>">
							<span itemprop="name"><?php echo esc_html( $terms[0]->name ); ?></span>
						</a>
						<meta itemprop="position" content="3"></span>
					</span>

					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( $home_url ); ?>"></a>
						<span itemprop="name"><?php echo esc_html( get_the_title( $page_id ) ); ?></span>
						<meta itemprop="position" content="4"></span>
					</span>
					<?php
				}
			} elseif ( is_single() ) { // Single blog.
				$cat = get_the_category();
				if ( ! empty( $cat ) && ! is_wp_error( $cat ) ) {
					?>
					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( $blog_page_url ); ?>">
							<span itemprop="name"><?php esc_html_e( 'Blog', 'roxtar' ); ?></span>
						</a>
						<meta itemprop="position" content="2"></span>
					</span>

					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( get_term_link( $cat[0]->term_id ) ); ?>">
							<span itemprop="name"><?php echo esc_html( $cat[0]->name ); ?></span>
						</a>
						<meta itemprop="position" content="3"></span>
					</span>

					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( $home_url ); ?>"></a>
						<span itemprop="name"><?php echo esc_html( get_the_title() ); ?></span>
						<meta itemprop="position" content="4"></span>
					</span>
					<?php
				}
			} else {
				// Product category.
				if ( class_exists( 'woocommerce' ) && is_product_category() ) {
					?>
					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( $shop_page_url ); ?>">
							<span itemprop="name"><?php esc_html_e( 'Shop', 'roxtar' ); ?></span>
						</a>
						<meta itemprop="position" content="2"></span>
					</span>

					<?php
					$parent_cat_id = $object->parent;
					if ( $parent_cat_id ) {
						$parent_category = get_term( $parent_cat_id, 'product_cat' );
						?>
						<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a itemprop="item" href="<?php echo esc_url( get_term_link( $parent_category->term_id ) ); ?>">
								<span itemprop="name"><?php echo esc_html( $parent_category->name ); ?></span>
							</a>
							<meta itemprop="position" content="3"></span>
						</span>
						<?php
					}
				} elseif ( is_category() ) { // Blog category.
					?>
					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( $blog_page_url ); ?>">
							<span itemprop="name"><?php esc_html_e( 'Blog', 'roxtar' ); ?></span>
						</a>
						<meta itemprop="position" content="2"></span>
					</span>

					<?php
					$parent_cat_id = $object->category_parent;
					if ( $parent_cat_id ) {
						$parent_category = get_category( $parent_cat_id );
						?>
						<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a itemprop="item" href="<?php echo esc_url( get_term_link( $parent_category->term_id ) ); ?>">
								<span itemprop="name"><?php echo esc_html( $parent_category->name ); ?></span>
							</a>
							<meta itemprop="position" content="2"></span>
						</span>
						<?php
					}
				}
				?>
					<span class="item-bread" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo esc_url( $home_url ); ?>"></a>
						<span itemprop="name">
							<?php
							global $post;
							if ( is_day() ) {
								/* translators: post date */
								printf( esc_html__( 'Daily Archives: %s', 'roxtar' ), get_the_date() );
							} elseif ( is_month() ) {
								/* translators: post date */
								printf( esc_html__( 'Monthly Archives: %s', 'roxtar' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'roxtar' ) ) );
							} elseif ( is_home() ) {
								echo esc_html( get_the_title( $page_id ) );
							} elseif ( is_author() ) {
								$author = get_query_var( 'author_name' ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
								echo esc_html( $author->display_name );
							} elseif ( is_category() || is_tax() ) {
								single_term_title();
							} elseif ( is_year() ) {
								/* translators: post date */
								printf( esc_html__( 'Yearly Archives: %s', 'roxtar' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'roxtar' ) ) );
							} elseif ( is_search() ) {
								esc_html_e( 'Search results: ', 'roxtar' );
								echo get_search_query();
							} elseif ( class_exists( 'woocommerce' ) && is_shop() ) {
								esc_html_e( 'Shop', 'roxtar' );
							} elseif ( class_exists( 'woocommerce' ) && ( is_product_tag() || is_tag() ) ) {
								esc_html_e( 'Tags: ', 'roxtar' );
								single_tag_title();
							} elseif ( class_exists( 'woocommerce' ) && is_cart() ) {
								echo esc_html( $object->post_title );
							} elseif ( is_page() ) {
								if ( $post->post_parent ) {
									$anc   = get_post_ancestors( $post->ID );
									$title = get_the_title();
									foreach ( $anc as $ancestor ) {
										$output = ' <a href=" ' . get_permalink( $ancestor ) . ' " title=" ' . get_the_title( $ancestor ) . ' "> ' . get_the_title( $ancestor ) . '</a> <span class="item-bread delimiter"></span><span>' . $title . '</span>';
									}
									echo wp_kses_post( $output );
								} else {
									echo esc_html( get_the_title() );
								}
							} else {
								esc_html_e( 'Archives', 'roxtar' );
							}
							?>
						</span>
						<?php
						$index = 2;
						if ( class_exists( 'woocommerce' ) && is_product_category() ) {
							$index = 4;
						}
						?>
						<meta itemprop="position" content="<?php echo esc_attr( $index ); ?>"></span>
					</span>
				<?php
			}
			?>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'roxtar_page_header' ) ) {
	/**
	 * Display the page header
	 */
	function roxtar_page_header() {
		// Not showing page title on Product page.
		if ( is_singular( 'product' ) ) {
			return;
		}

		$page_id       = roxtar_get_page_id();
		$options       = roxtar_options( false );
		$page_header   = $options['page_header_display'];
		$metabox       = roxtar_get_metabox( false, 'site-page-header' );
		$title         = get_the_title( $page_id );
		$display_title = $options['page_header_title'];

		$classes[] = 'content-align-' . $options['page_header_text_align'];
		$classes   = implode( ' ', $classes );
		$wc        = class_exists( 'woocommerce' );

		if ( $wc && is_shop() ) {
			if ( ! $options['shop_page_title'] ) {
				$display_title = false;
			}
		} elseif ( $wc && is_wc_endpoint_url( 'orders' ) ) {
			$title = __( 'Orders', 'roxtar' );
		} elseif ( $wc && is_wc_endpoint_url( 'downloads' ) ) {
			$title = __( 'Downloads', 'roxtar' );
		} elseif ( $wc && is_wc_endpoint_url( 'edit-account' ) ) {
			$title = __( 'Account details', 'roxtar' );
		} elseif ( $wc && is_wc_endpoint_url( 'edit-address' ) ) {
			$title = __( 'Addresses', 'roxtar' );
		} elseif ( $wc && is_wc_endpoint_url( 'customer-logout' ) ) {
			$title = __( 'Logout', 'roxtar' );
		} elseif ( $wc && is_wc_endpoint_url( 'lost-password' ) ) {
			$title = __( 'Lost password', 'roxtar' );
		} elseif ( is_category() ) {
			$title = single_cat_title( '<h1></h1>', false );	
		} elseif ( is_tag() ) {
			$title = single_tag_title( '<h1></h1>', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '<h1></h1>', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} elseif ( is_home() ) {
			$title = __( 'Blog', 'roxtar' );
		} elseif ( is_search() ) {
			$title = __( 'Search', 'roxtar' );
		}

		if ( is_404() ) {
			$display_title = false;
		}

		// Metabox option.
		if ( 'default' !== $metabox ) {
			if ( 'enabled' === $metabox ) {
				$page_header = true;
			} else {
				$page_header = false;
			}
		}

		// Hide default page header on Multi step checkout.
		$disable_page_header = class_exists( 'woocommerce' ) && is_checkout() && $options['checkout_multi_step'];

		if ( ! $page_header || $disable_page_header ) {
			return;
		}
		?>

		<div class="page-header">
			<div class="<?php echo esc_attr( $classes ); ?>">
				<?php do_action( 'roxtar_page_header_start' ); ?>

				<?php if ( $display_title ) { ?>
					<h1 class="entry-title"><?php echo wp_kses_post( $title ); ?></h1>
				<?php } ?>

				<?php
				$breadcrumb = class_exists( 'woocommerce' ) && is_shop() ? $options['shop_page_breadcrumb'] : $options['page_header_breadcrumb'];
				if ( $breadcrumb ) {
					/**
					 * Functions hooked in to roxtar_page_header_breadcrumb
					 *
					 * @hooked roxtar_breadcrumb   - 10
					 */
					do_action( 'roxtar_page_header_breadcrumb' );
				}

				do_action( 'roxtar_page_header_end' );
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_page_content' ) ) {
	/**
	 * Display the post content
	 */
	function roxtar_page_content() {
		the_content();

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'roxtar' ),
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			)
		);
	}
}

if ( ! function_exists( 'roxtar_post_loop_inner_open' ) ) {
	/**
	 * Post inner open
	 */
	function roxtar_post_loop_inner_open() {
		?>
			<div class="loop-post-inner">
		<?php
	}
}

if ( ! function_exists( 'roxtar_post_loop_inner_close' ) ) {
	/**
	 * Post inner close
	 */
	function roxtar_post_loop_inner_close() {
		?>
			</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_post_loop_image_thumbnail' ) ) {
	/**
	 * Display thumbnail image for Blog layout: Standard and Zigzag
	 *
	 * @param string $size The image size.
	 */
	function roxtar_post_loop_image_thumbnail( $size = 'full' ) {
		$options = roxtar_options( false );
		$value   = array( 'zigzag', 'standard' );
		if ( ! in_array( $options['blog_list_layout'], $value, true ) || ! has_post_thumbnail() ) {
			return;
		}
		?>
			<a class="entry-image-link" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $size ); ?>
			</a>
		<?php
	}
}

if ( ! function_exists( 'roxtar_post_header_open' ) ) {
	/**
	 * Post header wrapper
	 */
	function roxtar_post_header_open() {
		?>
			<header class="entry-header">
		<?php
	}
}

if ( ! function_exists( 'roxtar_post_header_close' ) ) {
	/**
	 * Post header wrapper close
	 */
	function roxtar_post_header_close() {
		?>
			</header>
		<?php
	}
}

if ( ! function_exists( 'roxtar_get_post_thumbnail' ) ) {
	/**
	 * Get post thumbnail
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 * @param string  $size The post thumbnail size.
	 * @param boolean $echo Echo.
	 */
	function roxtar_get_post_thumbnail( $size = 'full', $echo = true ) {
		if ( ! has_post_thumbnail() ) {
			return;
		}

		$image   = '';
		$options = roxtar_options( false );
		ob_start();

		if ( ! is_single() ) {
			if ( in_array( $options['blog_list_layout'], array( 'zigzag', 'standard' ), true ) ) {
				return $image;
			} else {
				?>
					<div class="entry-header-item post-cover-image">
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php the_post_thumbnail( $size ); ?>
						</a>
					</div>
				<?php
			}
		} else {
			?>
				<div class="entry-header-item post-cover-image">
					<?php the_post_thumbnail( $size ); ?>
				</div>
			<?php
		}

		$image = ob_get_clean();

		if ( $echo ) {
			echo $image; // phpcs:ignore
		} else {
			return $image;
		}
	}
}

if ( ! function_exists( 'roxtar_get_post_title' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @param boolean $echo Echo.
	 */
	function roxtar_get_post_title( $echo = true ) {
		$title_tag = apply_filters( 'roxtar_post_title_html_tag', 'h2' );

		$title  = '<' . esc_attr( $title_tag ) . ' class="entry-header-item alpha entry-title">';
		$title .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		$title .= get_the_title();
		$title .= '</a>';
		$title .= '</' . esc_attr( $title_tag ) . '>';

		if ( $echo ) {
			echo $title; // phpcs:ignore
		} else {
			return $title;
		}
	}
}

if ( ! function_exists( 'roxtar_get_post_structure' ) ) {
	/**
	 * Get post structure
	 *
	 * @param string  $option_name The option name.
	 * @param boolean $echo        Echo.
	 */
	function roxtar_get_post_structure( $option_name, $echo = true ) {
		if ( ! is_search() && ! roxtar_is_blog() ) {
			return;
		}

		$output    = '';
		$options   = roxtar_options( false );
		$meta_data = $options[ $option_name ];

		if ( ! $meta_data || empty( $meta_data ) ) {
			return $output;
		}

		$filter_key  = is_single() ? 'roxtar_post_single_structure_' : 'roxtar_post_structure_';
		$option_name = is_single() ? 'blog_single_post_meta' : 'blog_list_post_meta';

		foreach ( $meta_data as $key ) {
			switch ( $key ) {
				case 'image':
					$output .= roxtar_get_post_thumbnail( 'full', false );
					break;
				case 'title-meta':
					$output .= roxtar_get_post_title( false );
					break;
				case 'post-meta':
					$output .= roxtar_get_post_meta( $option_name, false );
					break;
				default:
					$output = apply_filters( $filter_key . $key, $output );
					break;
			}
		}

		if ( $echo ) {
			echo $output; // phpcs:ignore
		} else {
			return $output;
		}
	}
}

if ( ! function_exists( 'roxtar_get_post_meta' ) ) {
	/**
	 * Get output order post meta
	 *
	 * @param string  $option_name The option name.
	 * @param boolean $echo        Echo.
	 */
	function roxtar_get_post_meta( $option_name, $echo = true ) {
		if ( ! is_search() && ! roxtar_is_blog() ) {
			return;
		}

		$output    = '';
		$options   = roxtar_options( false );
		$meta_data = $options[ $option_name ];

		if ( ! $meta_data || empty( $meta_data ) ) {
			return $output;
		}

		$separator = apply_filters( 'roxtar_post_meta_separator', '<span class="post-meta-separator">.</span>' );

		$output .= '<aside class="entry-header-item entry-meta">';

		foreach ( $meta_data as $key ) {
			switch ( $key ) {
				case 'date':
					$output .= roxtar_post_meta_posted_on( false ) . $separator;
					break;
				case 'author':
					$output .= roxtar_post_meta_author( false ) . $separator;
					break;
				case 'comments':
					if ( roxtar_post_meta_comments( false ) ) {
						$output .= roxtar_post_meta_comments( false ) . $separator;
					}
					break;
				case 'category':
					if ( roxtar_post_meta_category( false ) ) {
						$output .= roxtar_post_meta_category( false ) . $separator;
					}
					break;
				default:
					$output = apply_filters( 'roxtar_post_meta_' . $key, $output, $separator );
					break;
			}
		}

		$output .= '</aside>';

		if ( $echo ) {
			echo $output; // phpcs:ignore
		} else {
			return $output;
		}
	}
}

if ( ! function_exists( 'roxtar_post_structure' ) ) {
	/**
	 * Display post structure
	 */
	function roxtar_post_structure() {
		roxtar_get_post_structure( 'blog_list_structure' );
	}
}

if ( ! function_exists( 'roxtar_post_single_structure' ) ) {
	/**
	 * Display the single post structure
	 */
	function roxtar_post_single_structure() {
		roxtar_get_post_structure( 'blog_single_structure' );
	}
}

if ( ! function_exists( 'roxtar_show_excerpt' ) ) {
	/**
	 * Show the blog excerpts or full posts
	 *
	 * @return bool $show_excerpt
	 */
	function roxtar_show_excerpt() {
		global $post;

		// Check to see if the more tag is being used.
		$more_tag = apply_filters( 'roxtar_more_tag', strpos( $post->post_content, '<!--more-->' ) );

		// Check the post format.
		$format = get_post_format() ? get_post_format() : 'standard';

		// If our post format isn't standard, show the full content.
		$show_excerpt = 'standard' !== $format ? false : true;

		// If the more tag is found, show the full content.
		$show_excerpt = $more_tag ? false : $show_excerpt;

		// If we're on a search results page, show the excerpt.
		$show_excerpt = is_search() ? true : $show_excerpt;

		// Return our value.
		return apply_filters( 'roxtar_show_excerpt', $show_excerpt );
	}
}

if ( ! function_exists( 'roxtar_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 */
	function roxtar_post_content() {

		do_action( 'roxtar_post_content_before' );

		if ( roxtar_show_excerpt() && ! is_single() ) {
			?>
				<div class="entry-summary summary-text">
					<?php
					the_excerpt();

					// Add 'Read More' button in Grid layout.
					$options = roxtar_options( false );
					if ( 'grid' === $options['blog_list_layout'] ) {
						$read_more_text = apply_filters( 'roxtar_read_more_text', __( 'Read More', 'roxtar' ) );
						?>
						<span class="post-read-more">
							<a href="<?php the_permalink(); ?>">
								<?php echo esc_html( $read_more_text ); ?>
							</a>
						</span>
						<?php
					}
					?>
				</div>
			<?php
		} else {
			?>
			<div class="entry-content summary-text">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before'      => '<div class="page-links">' . __( 'Pages:', 'roxtar' ),
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					)
				);

				/**
				 * Functions hooked in to roxtar_post_content_after action
				 *
				 * @hooked roxtar_post_read_more_button - 5
				 */
				do_action( 'roxtar_post_content_after' );
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'roxtar_post_read_more_button' ) ) {
	/**
	 * Display read more button
	 */
	function roxtar_post_read_more_button() {
		if ( ! is_single() ) {
			$read_more_text = apply_filters( 'roxtar_read_more_text', __( 'Read More', 'roxtar' ) );
			?>

			<p class="post-read-more">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php echo esc_html( $read_more_text ); ?>
				</a>
			</p>
			<?php
		}
	}
}

if ( ! function_exists( 'roxtar_post_tags' ) ) {
	/**
	 * Display post tags
	 */
	function roxtar_post_tags() {
		$tags_list = get_the_tag_list( '<span class="label">' . esc_html__( 'Tags', 'roxtar' ) . '</span>: ', __( ', ', 'roxtar' ) );
		if ( $tags_list ) :
			?>
			<footer class="entry-footer">
				<div class="tags-links">
					<?php echo wp_kses_post( $tags_list ); ?>
				</div>
			</footer>
			<?php
		endif;
	}
}

if ( ! function_exists( 'roxtar_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function roxtar_paging_nav() {
		global $wp_query;

		$args = array(
			'type'      => 'list',
			'next_text' => _x( 'Next', 'Next post', 'roxtar' ),
			'prev_text' => _x( 'Prev', 'Previous post', 'roxtar' ),
		);

		the_posts_pagination( $args );
	}
}

if ( ! function_exists( 'roxtar_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function roxtar_post_nav() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		$args = array(
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'roxtar' ) . ' </span>%title',
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'roxtar' ) . ' </span>%title',
		);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'roxtar_post_author_box' ) ) {
	/**
	 * Display author box
	 */
	function roxtar_post_author_box() {
		$options = roxtar_options( false );
		if ( ! $options['blog_single_author_box'] || ! is_singular( 'post' ) ) {
			return;
		}

		$author_id   = get_the_author_meta( 'ID' );
		$author_avar = get_avatar_url( $author_id );
		$author_url  = get_author_posts_url( $author_id );
		$author_name = get_the_author_meta( 'nickname', $author_id );
		$author_bio  = get_the_author_meta( 'description', $author_id );
		?>

		<div class="post-author-box">
			<?php if ( $author_avar ) { ?>
				<a class="author-ava" href="<?php echo esc_url( $author_url ); ?>">
					<img src="<?php echo esc_url( $author_avar ); ?>" alt="<?php esc_attr_e( 'Author Avatar', 'roxtar' ); ?>">
				</a>
			<?php } ?>

			<div class="author-content">
				<span class="author-name-before"><?php esc_html_e( 'Written by', 'roxtar' ); ?></span>
				<a class="author-name" href="<?php echo esc_url( $author_url ); ?>"><?php echo esc_html( $author_name ); ?></a>

				<?php if ( ! empty( $author_bio ) ) { ?>
					<div class="author-bio"><?php echo wp_kses_post( $author_bio ); ?></div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_post_meta_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @param boolean $echo Echo posted on.
	 */
	function roxtar_post_meta_posted_on( $echo = true ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on  = '<span class="sr-only">' . esc_html__( 'Posted on', 'roxtar' ) . '</span>';
		$posted_on .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		$data = wp_kses(
			apply_filters(
				'roxtar_single_post_posted_on_html',
				'<span class="post-meta-item posted-on">' . $posted_on . '</span>',
				$posted_on
			),
			array(
				'span' => array(
					'class' => array(),
				),
				'a'    => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'time' => array(
					'datetime' => array(),
					'class'    => array(),
				),
			)
		);

		if ( $echo ) {
			echo $data; // phpcs:ignore
		} else {
			return $data;
		}
	}
}

if ( ! function_exists( 'roxtar_post_meta_author' ) ) {
	/**
	 * Post meta author
	 *
	 * @param boolean $echo Echo author meta.
	 */
	function roxtar_post_meta_author( $echo = true ) {
		$author = '<span class="post-meta-item vcard author">';
		if ( ! get_the_author() ) {
			$author .= esc_html_e( 'by Unknown author', 'roxtar' );
		} else {
			$author .= '<span class="label">' . esc_html__( 'by', 'roxtar' ) . '</span>';
			$author .= sprintf(
				' <a href="%1$s" class="url fn" rel="author">%2$s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}
		$author .= '</span>';

		if ( $echo ) {
			echo $author; // phpcs:ignore
		} else {
			return $author;
		}
	}
}

if ( ! function_exists( 'roxtar_post_meta_category' ) ) {
	/**
	 * Post meta category
	 *
	 * @param boolean $echo Echo post category.
	 */
	function roxtar_post_meta_category( $echo = true ) {
		$categories = get_the_category_list( __( ', ', 'roxtar' ) );
		if ( ! $categories ) {
			return false;
		}

		$category  = '<span class="post-meta-item cat-links">';
		$category .= '<span class="label sr-only">' . esc_html( __( 'Posted in', 'roxtar' ) ) . '</span>';
		$category .= wp_kses_post( $categories );
		$category .= '</span>';

		if ( $echo ) {
			echo $category; // phpcs:ignore
		} else {
			return $category;
		}
	}
}

if ( ! function_exists( 'roxtar_post_meta_comments' ) ) {
	/**
	 * Post meta comment
	 *
	 * @param boolean $echo Echo post comment.
	 */
	function roxtar_post_meta_comments( $echo = true ) {
		$comments = '';
		if ( post_password_required() || ! comments_open() ) {
			return false;
		}

		ob_start();
		?>

		<span class="post-meta-item comments-link">
		<?php
			comments_popup_link(
				__( 'No comments yet', 'roxtar' ),
				__( '1 Comment', 'roxtar' ),
				__( '% Comments', 'roxtar' )
			);
		?>
		</span>

		<?php
		$comments = ob_get_clean();

		if ( $echo ) {
			echo $comments; // phpcs:ignore
		} else {
			return $comments;
		}
	}
}

if ( ! function_exists( 'roxtar_header_class' ) ) {
	/**
	 * Header class
	 */
	function roxtar_header_class() {
		$options = roxtar_options( false );
		$class[] = 'site_header';
		$class[] = apply_filters( 'roxtar_header_layout_classes', 'header-' . $options['header_layout'] );
		$class   = implode( ' ', array_filter( $class ) );

		echo esc_attr( $class );
	}
}


if ( ! function_exists( 'roxtar_content_top' ) ) {
	/**
	 * Content top, after Header. Apply only for Single Product
	 */
	function roxtar_content_top() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}

		do_action( 'roxtar_content_top' );
	}
}

if ( ! function_exists( 'roxtar_content_top_open' ) ) {
	/**
	 * Roxtar .content-top open
	 */
	function roxtar_content_top_open() {
		echo '<div class="content-top">';
	}
}

if ( ! function_exists( 'roxtar_content_top_close' ) ) {
	/**
	 * Roxtar .content-top close
	 */
	function roxtar_content_top_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'roxtar_is_product_archive' ) ) {
	/**
	 * Checks if the current page is a product archive
	 *
	 * @return boolean
	 */
	function roxtar_is_product_archive() {
		if ( ! roxtar_is_woocommerce_activated() ) {
			return false;
		}

		if ( is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag() ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'roxtar_topbar' ) ) {
	/**
	 * Display topbar
	 */
	function roxtar_topbar() {
		$options = roxtar_options( false );
		$display = $options['topbar_display'];
		$topbar  = roxtar_get_metabox( false, 'site-topbar' );

		if ( 'disabled' === $topbar ) {
			$display = false;
		}

		if ( ! $display ) {
			return;
		}

		$topbar_left   = roxtar_replace_text( $options['topbar_left'] );
		$topbar_center = roxtar_replace_text( $options['topbar_center'] );
		$topbar_right  = roxtar_replace_text( $options['topbar_right'] );
		?>

		<div class="topbar">
			<div class=topbar_inner>
				<div class="topbar-item topbar-left"><?php echo do_shortcode( $topbar_left ); ?></div>
				<div class="topbar-item topbar-center"><?php echo do_shortcode( $topbar_center ); ?></div>
				<div class="topbar-item topbar-right"><?php echo do_shortcode( $topbar_right ); ?></div>
			</div>	
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @uses  roxtar_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function roxtar_search() {
		$options = roxtar_options( false );
		if ( ! $options['header_search_icon'] ) {
			return;
		}
		?>

		<div class="site-search">
			<?php
			do_action( 'roxtar_site_search_start' );

			if ( ! $options['header_search_only_product'] ) {
				get_search_form();
			} elseif ( roxtar_is_woocommerce_activated() ) {
				the_widget( 'WC_Widget_Product_Search', 'title=' );
			}

			do_action( 'roxtar_site_search_end' );
			?>
		</div>
		<?php
	}
}


if ( ! function_exists( 'roxtar_dialog_search' ) ) {
	/**
	 * Display Dialog Search
	 *
	 * @uses  roxtar_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function roxtar_dialog_search() {
		$options    = roxtar_options( false );
		$close_icon = apply_filters( 'roxtar_dialog_search_close_icon', 'ti-close' );
		?>

		<div class="site-dialog-search">
			<div class="dialog-search-content">
				<?php do_action( 'roxtar_dialog_search_content_start' ); ?>

				<div class="dialog-search-header">
					<span class="dialog-search-title"><?php esc_html_e( 'Type to search', 'roxtar' ); ?></span>
					<span class="dialog-search-close-icon <?php echo esc_attr( $close_icon ); ?>"></span>
				</div>

				<div class="dialog-search-main">
					<?php
					if ( roxtar_is_woocommerce_activated() && $options['header_search_only_product'] ) {
						the_widget( 'WC_Widget_Product_Search', 'title=' );
					} else {
						get_search_form();
					}
					?>
				</div>

				<?php do_action( 'roxtar_dialog_search_content_end' ); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_product_check_in' ) ) {
	/**
	 * Check product already in cart || product quantity in cart
	 *
	 * @param      int     $pid          Product id.
	 * @param      boolean $in_cart      Check in cart.
	 * @param      boolean $qty_in_cart  Get product quantity.
	 */
	function roxtar_product_check_in( $pid = null, $in_cart = true, $qty_in_cart = false ) {
		global $woocommerce;
		if ( empty( $woocommerce->cart ) ) {
			return;
		}

		$_cart    = $woocommerce->cart->get_cart();
		$_product = wc_get_product( $pid );
		$variable = $_product->is_type( 'variable' );

		// Check product already in cart. Return boolean.
		if ( $in_cart ) {
			foreach ( $_cart as $key ) {
				$product_id = $key['product_id'];

				if ( $product_id === $pid ) {
					return true;
				}
			}

			return false;
		}

		// Get product quantity in cart. Return INT.
		if ( $qty_in_cart ) {
			if ( $variable ) {
				$arr = array();
				foreach ( $_cart as $key ) {
					if ( $key['product_id'] === $pid ) {
						$qty   = $key['quantity'];
						$arr[] = $qty;
					}
				}

				return array_sum( $arr );
			} else {
				foreach ( $_cart as $key ) {
					if ( $key['product_id'] === $pid ) {
						$qty = $key['quantity'];

						return $qty;
					}
				}
			}

			return 0;
		}
	}
}

if ( ! function_exists( 'roxtar_get_sidebar_id' ) ) {
	/**
	 * Get sidebar by id
	 *
	 * @param      string $sidebar_id      The sidebar id.
	 * @param      string $sidebar_layout  The sidebar layout: left, right, full.
	 * @param      string $sidebar_default The sidebar layout default.
	 * @param      string $wc_sidebar      The woocommerce sidebar.
	 */
	function roxtar_get_sidebar_id( $sidebar_id, $sidebar_layout, $sidebar_default, $wc_sidebar = false ) {

		$wc_sidebar_class      = $wc_sidebar ? ' woocommerce-sidebar' : '';
		$sidebar_layout_class  = 'full' === $sidebar_layout ? 'no-sidebar' : $sidebar_layout . '-sidebar has-sidebar' . $wc_sidebar_class;
		$sidebar_default_class = 'full' === $sidebar_default ? 'no-sidebar' : $sidebar_default . '-sidebar has-sidebar default-sidebar' . $wc_sidebar_class;

		if ( 'default' !== $sidebar_layout ) {
			$sidebar = $sidebar_layout_class;
		} else {
			$sidebar = $sidebar_default_class;
		}

		return $sidebar;
	}
}

if ( ! function_exists( 'roxtar_sidebar_class' ) ) {
	/**
	 * Get sidebar class
	 *
	 * @return string $sidebar Class name
	 */
	function roxtar_sidebar_class() {
		// All theme options.
		$options = roxtar_options( false );

		// Metabox options.
		$metabox_sidebar = roxtar_get_metabox( false, 'site-sidebar' );

		// Customize options.
		$sidebar             = '';
		$sidebar_default     = $options['sidebar_default'];
		$sidebar_page        = 'default' !== $metabox_sidebar ? $metabox_sidebar : $options['sidebar_page'];
		$sidebar_blog        = 'default' !== $metabox_sidebar ? $metabox_sidebar : $options['sidebar_blog'];
		$sidebar_blog_single = 'default' !== $metabox_sidebar ? $metabox_sidebar : $options['sidebar_blog_single'];
		$sidebar_shop        = 'default' !== $metabox_sidebar ? $metabox_sidebar : $options['sidebar_shop'];
		$sidebar_shop_single = 'default' !== $metabox_sidebar ? $metabox_sidebar : $options['sidebar_shop_single'];

		// Dokan support.
		$dokan_store_sidebar = false;
		$is_dokan_store      = class_exists( 'WeDevs_Dokan' ) && roxtar_is_woocommerce_activated() && dokan_is_store_page();
		if ( $is_dokan_store && 'off' === dokan_get_option( 'enable_theme_store_sidebar', 'dokan_appearance', 'off' ) ) {
			$dokan_store_sidebar = true;
		}

		if ( roxtar_is_elementor_page() || is_404() || $dokan_store_sidebar || ( class_exists( 'woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ) ) {
			return $sidebar;
		}

		if ( class_exists( 'woocommerce' ) && ( is_shop() || is_product_taxonomy() ) ) {
			// Shop page.
			$sidebar = roxtar_get_sidebar_id( 'sidebar-shop', $sidebar_shop, $sidebar_default );
		} elseif ( class_exists( 'woocommerce' ) && is_singular( 'product' ) ) {
			// Product page.
			$sidebar = roxtar_get_sidebar_id( 'sidebar-shop', $sidebar_shop_single, $sidebar_default );
		} elseif ( is_page() ) {
			// Page.
			$sidebar = roxtar_get_sidebar_id( 'sidebar', $sidebar_page, $sidebar_default );
		} elseif ( is_singular( 'post' ) ) {
			// Post page.
			$sidebar = roxtar_get_sidebar_id( 'sidebar', $sidebar_blog_single, $sidebar_default );
		} else {
			// Other page.
			$sidebar = roxtar_get_sidebar_id( 'sidebar', $sidebar_default, $sidebar_default );
		}

		return $sidebar;
	}
}

if ( ! function_exists( 'roxtar_get_sidebar' ) ) {
	/**
	 * Display roxtar sidebar
	 *
	 * @uses get_sidebar()
	 */
	function roxtar_get_sidebar() {
		$sidebar             = roxtar_sidebar_class();
		$dokan_store_sidebar = false;
		$is_dokan_store      = class_exists( 'WeDevs_Dokan' ) && roxtar_is_woocommerce_activated() && dokan_is_store_page();
		if ( $is_dokan_store && 'off' === dokan_get_option( 'enable_theme_store_sidebar', 'dokan_appearance', 'off' ) ) {
			$dokan_store_sidebar = true;
		}

		if ( false !== strpos( $sidebar, 'no-sidebar' ) || ! $sidebar || roxtar_is_elementor_page() || $dokan_store_sidebar ) {
			return;
		}

		if ( false !== strpos( $sidebar, 'woocommerce-sidebar' ) || roxtar_is_product_archive() || is_singular( 'product' ) ) {
			get_sidebar( 'shop' );
		} else {
			get_sidebar();
		}
	}
}

if ( ! function_exists( 'roxtar_menu_toggle_btn' ) ) {
	/**
	 * Menu toggle button
	 */
	function roxtar_menu_toggle_btn() {
		$menu_toggle_icon  = apply_filters( 'roxtar_header_menu_toggle_icon', 'roxtar-icon-bar' );
		$roxtar_icon_bar = apply_filters( 'roxtar_header_icon_bar', '<span></span>' );
		?>
		<div class="wrap-toggle-sidebar-menu">
			<span class="toggle-sidebar-menu-btn <?php echo esc_attr( $menu_toggle_icon ); ?>">
				<?php echo wp_kses_post( $roxtar_icon_bar ); ?>
			</span>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_overlay' ) ) {
	/**
	 * Roxtar overlay
	 */
	function roxtar_overlay() {
		echo '<div id="roxtar-overlay"></div>';
	}
}

if ( ! function_exists( 'roxtar_toggle_sidebar' ) ) {
	/**
	 * Toogle sidebar
	 */
	function roxtar_toggle_sidebar() {
		do_action( 'roxtar_toggle_sidebar' );
	}
}

if ( ! function_exists( 'roxtar_sidebar_menu_open' ) ) {
	/**
	 * Sidebar menu open
	 */
	function roxtar_sidebar_menu_open() {
		echo '<div class="sidebar-menu">';
	}
}

if ( ! function_exists( 'roxtar_sidebar_menu_action' ) ) {
	/**
	 * Sidebar menu action
	 */
	function roxtar_sidebar_menu_action() {
		$options = roxtar_options( false );

		if ( ! roxtar_is_woocommerce_activated() || ! $options['header_account_icon'] ) {
			return;
		}

		$page_account_id = get_option( 'woocommerce_myaccount_page_id' );
		$logout_url      = wp_logout_url( get_permalink( $page_account_id ) );

		if ( 'yes' === get_option( 'woocommerce_force_ssl_checkout' ) ) {
			$logout_url = str_replace( 'http:', 'https:', $logout_url );
		}
		?>

		<div class="sidebar-menu-bottom">
			<?php do_action( 'roxtar_sidebar_account_before' ); ?>

			<ul class="sidebar-account">
				<?php do_action( 'roxtar_sidebar_account_top' ); ?>

				<?php if ( ! is_user_logged_in() ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $page_account_id ) ); ?>"><?php esc_html_e( 'Login', 'roxtar' ); ?></a></li>
					<li><a href="/register/"><?php esc_html_e( 'Register', 'roxtar' ); ?></a></li>
				<?php else : ?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $page_account_id ) ); ?>"><?php esc_html_e( 'Dashboard', 'roxtar' ); ?></a>
					</li>
					<li><a href="<?php echo esc_url( $logout_url ); ?>"><?php esc_html_e( 'Logout', 'roxtar' ); ?></a>
					</li>
				<?php endif; ?>

				<?php do_action( 'roxtar_sidebar_account_bottom' ); ?>
			</ul>

			<?php do_action( 'roxtar_sidebar_account_after' ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_sidebar_menu_close' ) ) {
	/**
	 * Sidebar menu close
	 */
	function roxtar_sidebar_menu_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'roxtar_get_wishlist_count' ) ) {
	/**
	 * Get wishlist count
	 */
	function roxtar_get_wishlist_count() {
		$options = roxtar_options( false );
		$plugin  = $options['shop_page_wishlist_support_plugin'];
		$count   = 0;

		if ( 'ti' === $plugin && class_exists( 'TInvWL_Public_WishlistCounter' ) ) {
			$ti    = TInvWL_Public_WishlistCounter::instance();
			$count = $ti->counter();
		} elseif ( 'yith' === $plugin && function_exists( 'yith_wcwl_count_all_products' ) ) {
			$count = yith_wcwl_count_all_products();
		}

		return $count;
	}
}

if ( ! function_exists( 'roxtar_header_action' ) ) {
	/**
	 * Display header action
	 *
	 * @uses  roxtar_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function roxtar_header_action() {
		$options = roxtar_options( false );
		$count   = 0;

		if ( roxtar_is_woocommerce_activated() ) {
			global $woocommerce;
			$page_account_id = get_option( 'woocommerce_myaccount_page_id' );
			$logout_url      = wp_logout_url( get_permalink( $page_account_id ) );

			if ( 'yes' === get_option( 'woocommerce_force_ssl_checkout' ) ) {
				$logout_url = str_replace( 'http:', 'https:', $logout_url );
			}

			$count = $woocommerce->cart->cart_contents_count;
		}

		$search_icon     = apply_filters( 'roxtar_header_search_icon', 'ti-search' );
		$wishlist_icon   = apply_filters( 'roxtar_header_wishlist_icon', 'ti-heart' );
		$my_account_icon = apply_filters( 'roxtar_header_my_account_icon', 'ti-user' );
		$shop_bag_icon   = apply_filters( 'roxtar_header_shop_bag_icon', 'custom-shopping-cart cart-icon-rotate' );
		?>

		<div class="site-tools">

			<?php do_action( 'roxtar_site_tool_before_first_item' ); ?>

			<?php // Search icon. 

			if ( $options['header_search_icon'] ) { ?>
				<span class="tools-icon header-search-icon <?php echo esc_attr( $search_icon ); ?>"></span>
				<?php
			}

			if ( roxtar_is_woocommerce_activated() ) {
				do_action( 'roxtar_site_tool_before_second_item' );

				// Wishlist icon.
				if ( $options['header_wishlist_icon'] && roxtar_support_wishlist_plugin() ) {
					$wishlist_item_count = roxtar_get_wishlist_count();
					?>
					<a href="<?php echo esc_url( roxtar_wishlist_page_url() ); ?>" class="tools-icon header-wishlist-icon <?php echo esc_attr( $wishlist_icon ); ?>">
						<?php if ( 'ti' === $options['shop_page_wishlist_support_plugin'] && function_exists( 'tinv_get_option' ) && tinv_get_option( 'topline', 'show_counter' ) ) { ?>
						<span class="theme-item-count wishlist-item-count"><?php echo esc_html( $wishlist_item_count ); ?></span>
						<?php } ?>
					</a>
					<?php
				}

				do_action( 'roxtar_site_tool_before_third_item' );

				// My account icon.
				if ( $options['header_account_icon'] ) {
					$subbox = apply_filters( 'roxtar_header_account_subbox', true );
					?>
					<div class="tools-icon my-account">

						<?php if(is_user_logged_in()) { ?>

							<a href="<?php echo esc_url( get_permalink( $page_account_id ) ); ?>" class="tools-icon my-account-icon <?php echo esc_attr( $my_account_icon ); ?>"></a>

						<?php } else { ?>

							<a href="<?php echo esc_url( get_permalink( $page_account_id ) ); ?>" class="tools-icon my-account-icon <?php echo esc_attr( $my_account_icon ); ?>"></a>

						<?php } ?>
						

						<?php if ( $subbox ) { ?>
							<div class="subbox">
								<ul>
									<?php
									do_action( 'roxtar_header_account_subbox_start' );

									if ( ! is_user_logged_in() ) {
										$login_reg_button = '<a href="' . get_permalink( $page_account_id ) . '" class="text-center">' . esc_html__( 'Login', 'roxtar' ) . '</a>';
										?>
										<li>
											<a href="<?php _e( '/register/', 'roxtar' ) ?>"><?php _e( 'Register', 'roxtar' ) ?></a>
										</li>
										<?php
									} else {
										$dasboard = '<a href="' . get_permalink( $page_account_id ) . '">' . esc_html__( 'Dashboard', 'roxtar' ) . '</a>';
										?>
										<li><?php echo wp_kses_post( apply_filters( 'roxtar_header_account_subbox_dasboard_link', $dasboard ) ); ?></li>

										<?php do_action( 'roxtar_header_account_subbox_before_logout' ); ?>

										<li><a href="<?php echo esc_url( $logout_url ); ?>"><?php esc_html_e( 'Logout', 'roxtar' ); ?></a>
										</li>
										<?php

										do_action( 'roxtar_header_account_subbox_end' );
									}
									?>
								</ul>
							</div>
						<?php } ?>
					</div>
					<?php
				}

				do_action( 'roxtar_site_tool_before_fourth_item' );

				// Shopping cart icon.
				if ( $options['header_shop_cart_icon'] ) {
					?>
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="tools-icon shopping-bag-button <?php echo esc_attr( $shop_bag_icon ); ?>">
						<span class="shop-cart-count"><?php echo esc_html( $count ); ?></span>
					</a>
					<?php
				}

				do_action( 'roxtar_site_tool_after_last_item' );
			}

			if ( $options['header_widget_area'] ) { 
					
				if ( is_active_sidebar( 'header_menu' ) ) {
					?>
					<div class="header_widget_area">
						<?php dynamic_sidebar( 'header_menu' ); ?>
					</div>
					<?php
				}  

			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_get_page_id' ) ) {
	/**
	 * Get page id
	 *
	 * @return int $page_id Page id
	 */
	function roxtar_get_page_id() {
		$page_id = get_queried_object_id();

		if ( class_exists( 'woocommerce' ) ) {
			if ( is_shop() ) {
				$page_id = get_option( 'woocommerce_shop_page_id' );
			} elseif ( is_product_category() ) {
				$page_id = false;
			}
		}

		return $page_id;
	}
}

if ( ! function_exists( 'roxtar_view_open' ) ) {
	/**
	 * Open #view
	 */
	function roxtar_view_open() {
		?>
		<div id="view">
		<?php
	}
}

if ( ! function_exists( 'roxtar_view_close' ) ) {
	/**
	 * Close #view
	 */
	function roxtar_view_close() {
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_content_open' ) ) {
	/**
	 * Open #content
	 */
	function roxtar_content_open() {
		?>
		<div id="content" class="site_content" tabindex="-1">
		<?php
	}
}

if ( ! function_exists( 'roxtar_content_close' ) ) {
	/**
	 * Close #content
	 */
	function roxtar_content_close() {
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'roxtar_get_site_container_class' ) ) {
	/**
	 * Get site container class
	 */
	function roxtar_get_site_container_class() {
		$options   = roxtar_options( false );
		$metabox   = roxtar_get_metabox( false, 'site-container' ); // Metabox container.
		$container = 'default';

		if ( roxtar_is_woocommerce_activated() && is_shop() ) {
			$container = $options['shop_container'];
		} elseif ( roxtar_is_woocommerce_activated() && is_singular( 'product' ) ) {
			$container = $options['shop_single_container'];
		} elseif ( is_page() ) {
			$container = $options['page_container'];
		} elseif ( is_singular( 'post' ) ) {
			$container = $options['blog_single_container'];
		} elseif ( is_archive() || is_search() || is_author() || is_category() || is_home() || is_tag() ) {
			$container = $options['archive_container'];
		}

		// Customizer container.
		if ( 'default' === $container ) {
			$container = $options['default_container'];
		}

		// Metabox in post and page.
		if ( 'default' !== $metabox ) {
			$container = $metabox;
		}

		// Fallback.
		if ( ! in_array( $container, array( 'normal', 'boxed', 'content-boxed', 'full-width', 'full-width-stretched' ), true ) ) {
			$container = $options['default_container'];
		}

		return 'site-' . $container . '-container';
	}
}



if ( ! function_exists( 'roxtar_site_header' ) ) {
	/**
	 * Display header
	 */
	function roxtar_site_header() {
		$header = roxtar_get_metabox( false, 'site_header' );
		if ( 'disabled' === $header ) {
			return;
		}
		?>
			<header id="masthead" class="<?php roxtar_header_class(); ?>">
				<div class="site_header_inner">
					<?php
						/**
						 * Functions hooked into roxtar_site_header action
						 *
						 * @hooked roxtar_default_container_open  - 0
						 * @hooked roxtar_skip_links              - 5
						 * @hooked roxtar_menu_toggle_btn         - 10
						 * @hooked roxtar_site_branding           - 20
						 * @hooked roxtar_primary_navigation      - 30
						 * @hooked roxtar_header_action           - 50
						 * @hooked roxtar_default_container_close - 200
						 */
						do_action( 'roxtar_site_header' );
					?>
				</div>
			</header>
		<?php
	}
}

if ( ! function_exists( 'roxtar_after_header' ) ) {
	/**
	 * After header
	 */
	function roxtar_after_header() {
		do_action( 'roxtar_after_header' );
	}
}

if ( ! function_exists( 'roxtar_before_footer' ) ) {
	/**
	 * After header
	 */
	function roxtar_before_footer() {
		do_action( 'roxtar_before_footer' );
	}
}

if ( ! function_exists( 'roxtar_site_footer' ) ) {

	/**
	 * Roxtar footer
	 */
	function roxtar_site_footer() {
		// Customize disable footer.
		$options        = roxtar_options( false );
		$footer_display = $options['footer_display'];

		// Metabox disable footer.
		$metabox_footer = roxtar_get_metabox( false, 'site-footer' );
		if ( 'disabled' === $metabox_footer ) {
			$footer_display = false;
		}

		// Return.
		if ( ! $footer_display ) {
			return;
		}

		?>
			<footer id="colophon" class="site-footer">				

					<?php
					/**
					 * Functions hooked in to roxtar_footer action
					 *
					 * @hooked roxtar_footer_widgets - 10
					 * @hooked roxtar_credit         - 20
					 */
					do_action( 'roxtar_footer_content' );
					?>

			</footer>
		<?php
	}
}

if ( ! function_exists( 'roxtar_footer_action' ) ) {
	/**
	 * Footer action
	 */
	function roxtar_footer_action() {
		do_action( 'roxtar_footer_action' );
	}
}

if ( ! function_exists( 'roxtar_after_footer' ) ) {
	/**
	 * After footer
	 */
	function roxtar_after_footer() {
		do_action( 'roxtar_after_footer' );
	}
}

if ( ! function_exists( 'roxtar_scroll_to_top' ) ) {
	/**
	 * Scroll to top
	 */
	function roxtar_scroll_to_top() {
		$options  = roxtar_options( false );
		$position = $options['scroll_to_top_position'];
		$display  = $options['scroll_to_top_on'];

		if ( ! $options['scroll_to_top'] ) {
			return;
		}

		$icon = apply_filters( 'roxtar_scroll_to_top_icon', 'ti-angle-up' );
		?>
		<span id="scroll-to-top" class="<?php echo esc_attr( $icon ); ?> scroll-to-top-position-<?php echo esc_attr( $position ); ?> scroll-to-top-show-<?php echo esc_attr( $display ); ?>" title="<?php esc_attr_e( 'Scroll To Top', 'roxtar' ); ?>"></span>
		<?php
	}
}


function roxtar_dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}
add_action( 'wp_default_scripts', 'roxtar_dequeue_jquery_migrate' );