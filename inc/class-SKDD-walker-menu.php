<?php
/**
 * SKDD Walker Menu Class 
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'SKDD_Walker_Menu' ) ) {
	/**
	 * SKDD Walker Menu Class
	 */
	class SKDD_Walker_Menu extends Walker_Nav_Menu {
		/**
		 * Walker menu
		 *
		 * @see Walker::start_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 * @param object $args The array.
		 * @param int    $id The id.
		 */		

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent      = $depth ? str_repeat( "\t", $depth ) : '';
			$class_names = '';
			$value       = '';
			$show_as_button = get_post_meta($item->ID, '_show-as-button', true);

			// Classes name.
			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			if ($show_as_button) {
				$classes[] = 'button';
			}	
		
			$classes = array_filter( $classes );

			// Check this item has children.
			$has_child = in_array( 'menu-item-has-children', $classes, true ) ? true : false;

			// Join classes name.
			$class_names = join( ' ', apply_filters( 'SKDD_mega_menu_css_class', $classes, $item, $args ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			// Ids.
			//$id = apply_filters( 'SKDD_mega_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			//$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			// Start output.
			$output .= $indent . '<li' . $value . $class_names . '>';

			// Attributes.
			$atts           = array();
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';
			$atts           = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$attributes     = '';

			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = 'href' === $attr ? esc_url( $value ) : esc_attr( $value );
					$value       = 'mega_menu' === $item->object ? $href : $value;
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			if ( ! empty( $item->attr_title ) ) {
				$item_output .= '<a' . $attributes . ' title="' . esc_attr( $item->attr_title ) . '">';
			} else {
				$item_output .= '<a' . $attributes . '>';
			}

			$title = apply_filters( 'the_title', $item->title, $item->ID );
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			// Menu item text.
			$item_output .= $args->link_before . '<span class="menu-item-text">' . $title . '</span>' . $args->link_after;

			// Add arrow icon.
			if ( $has_child ) {
				$item_output .= '<span class="menu-item-arrow arrow-icon"></span>';
			}

			$item_output .= '</a>';


			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

if ( ! class_exists( 'SKDD_Walker_Mega_Menu' ) ) {
	/**
	 * SKDD Walker Menu Class
	 */
	class SKDD_Walker_Mega_Menu extends Walker_Nav_Menu {
		/**
		 * Walker menu
		 *
		 * @see Walker::start_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 * @param object $args The array.
		 * @param int    $id The id.
		 */		
 
		public function end_lvl( &$output, $depth = 0, $args = array() ) {

			ob_start();

			dynamic_sidebar('mega_menu_widget');
			$sidebar_html = ob_get_clean();
		
			if ($depth == 0) {
				$output .= '<div class="sidebar">' . $sidebar_html . '</div>';
			}	

			$output .= '</ul>';


		}

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent      = $depth ? str_repeat( "\t", $depth ) : '';
			$class_names = '';
			$value       = '';
			$show_as_button = get_post_meta($item->ID, '_show-as-button', true);
			$show_as_megamenu = get_post_meta($item->ID, '_show-as-megamenu', true);
			

			// Classes name.
			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			
			if ($show_as_button) {
				$classes[] = 'button';
			}		

			if ($show_as_megamenu) {
				$classes[] = 'mega-menu';
			}
		
			$classes = array_filter( $classes );

			// Check this item has children.
			$has_child = in_array( 'menu-item-has-children', $classes, true ) ? true : false;

			// Join classes name.
			$class_names = join( ' ', apply_filters( 'SKDD_mega_menu_css_class', $classes, $item, $args ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			// Ids.
			//$id = apply_filters( 'SKDD_mega_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			//$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			// Start output.
			$output .= $indent . '<li' . $value . $class_names . '>';

			// Attributes.
			$atts           = array();
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';
			$atts           = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$attributes     = '';

			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = 'href' === $attr ? esc_url( $value ) : esc_attr( $value );
					$value       = 'mega_menu' === $item->object ? $href : $value;
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			if ( ! empty( $item->attr_title ) ) {
				$item_output .= '<a' . $attributes . ' title="' . esc_attr( $item->attr_title ) . '">';
			} else {
				$item_output .= '<a' . $attributes . '>';
			}

			$title = apply_filters( 'the_title', $item->title, $item->ID );
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			// Menu item text.
			$item_output .= $args->link_before . '<span class="menu-item-text">' . $title . '</span>' . $args->link_after;

			// Add arrow icon.
			if ( $has_child ) {
				$item_output .= '<span class="menu-item-arrow arrow-icon"></span>';
			}

			$item_output .= '</a>';


			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );


		}
	}
}
