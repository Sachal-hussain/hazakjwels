<?php
/**
 * The menu walker for header default
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Default_Menu_Frontend_Walker' ) ) {
	/**
	 * The main default header nav walker.
	 */
	class Default_Menu_Frontend_Walker extends Walker_Nav_Menu {
		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 *
		 * @param string       $output Used to append additional content (passed by reference).
		 * @param WP_Post      $item   Menu item data object.
		 * @param int          $depth  Depth of menu item. Used for padding.
		 * @param array|object $args   An array of arguments.
		 * @param int          $id     Optional. ID of the current menu item. Default 0.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$link_class = array();

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent    = ( $depth ) ? str_repeat( $t, $depth ) : '';
			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . esc_attr( $item->ID );
			$classes[] = 'item-depth-' . $depth;

			if ( $args->walker->has_children ) {
				$classes[] = 'dropdown';
			}

			switch ( $depth ) {
				case '0':
					$classes[]    = 'nav-item simple-dropdown';
					$link_class[] = 'nav-link';
					break;
			}

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param WP_Post  $item      Menu item data object.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			/**
			 * Filters the CSS classes applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $item      The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $item      The current menu item.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : 'javascript:void(0);';

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title        Title attribute.
			 *     @type string $target       Target attribute.
			 *     @type string $rel          The rel attribute.
			 *     @type string $href         The href attribute.
			 *     @type string $aria-current The aria-current attribute.
			 * }
			 * @param WP_Post  $item      The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID ); // phpcs:ignore

			if ( is_array( $args ) ) {
				$item_output = $args['before'];
			} else {
				$item_output = $args->before;
			}
			/**
			 *  Filters the CSS classes applied to a menu item's link.
			 *
			 * @since 1.0
			 */
			$link_class      = join( ' ', apply_filters( 'litho_mega_menu_main_link_css_class', array_filter( $link_class ), $depth ) );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$link_class_name = $link_class ? ' class="' . esc_attr( $link_class ) . '"' : '';

			$item_output .= '<a' . $attributes . ' itemprop="url" ' . $link_class_name . '>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			if ( is_array( $args ) ) {
				$item_output .= $args['link_before'] . $title . $args['link_after'];
			} else {
				$item_output .= $args->link_before . $title . $args->link_after;
			}

			$item_output .= '</a>';

			if ( ( $depth > 0 ) && $args->walker->has_children ) {
				$item_output .= '<span class="handler"><i class="fa-solid fa-angle-right"></i></span>';
			}
			// Mobile Icon Dropdown.
			if ( $args->walker->has_children ) {
				$item_output .= '<i class="fa-solid fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>';
			}

			if ( is_array( $args ) ) {
				$item_output .= $args['after'];
			} else {
				$item_output .= $args->after;
			}

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $item        Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @param string       $output Used to append additional content (passed by reference).
		 * @param WP_Post      $item   Menu item data object.
		 * @param int          $depth  Depth of category. Used for tab indentation.
		 * @param array|object $args   An array of arguments.
		 */
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$output .= "</li>{$n}";
		}

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker:start_lvl()
		 *
		 * @param string       $output Used to append additional content (passed by reference).
		 * @param int          $depth  Depth of category. Used for tab indentation.
		 * @param array|object $args   An array of arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			// Default class..
			$classes = array( 'sub-menu', 'dropdown-menu' );

			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @since 4.8.0
			 *
			 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}<ul $class_names>{$n}";
		}
		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @param string       $output Passed by reference.
		 * @param int          $depth  Depth of menu item. Used for padding.
		 * @param array|object $args   An array of arguments.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent  = str_repeat( $t, $depth );
			$output .= "$indent</ul>{$n}";
		}
	}
}
