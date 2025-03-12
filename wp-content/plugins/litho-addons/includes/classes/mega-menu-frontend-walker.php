<?php
namespace LithoAddons\Classes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Mega_Menu_Frontend_Walker` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Classes\Mega_Menu_Frontend_Walker' ) ) {

	/**
	 * Define Mega_Menu_Frontend_Walker class
	 */
	class Mega_Menu_Frontend_Walker extends \Walker_Nav_Menu {

		public $mega_menu_sub_status = '';

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$link_class = array();
			$item_id    = $item->ID;

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

			$litho_mega_item               = get_post_meta( $item->ID, '_litho_menu_item', true ); // Get from "litho-mega-menu" Post type.
			$litho_mega_submenu_status     = get_post_meta( $item->ID, '_enable_mega_submenu', true );
			$litho_menu_item_icon          = get_post_meta( $item->ID, '_menu_item_icon', true );
			$litho_menu_item_icon_position = get_post_meta( $item->ID, '_menu_item_icon_position', true );
			$litho_menu_item_icon_color    = get_post_meta( $item->ID, '_menu_item_icon_color', true );
			$mega_menu_parent_status       = get_post_meta( $item->menu_item_parent, '_enable_mega_submenu', true );
			$this->mega_menu_sub_status    = $litho_mega_submenu_status;

			$litho_icon_color_css = ( ! empty( $litho_menu_item_icon_color ) ) ? ' style="color:' . $litho_menu_item_icon_color . '"' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			switch ( $depth ) {
				case '0':
					$classes[] = 'nav-item';
					if ( 'yes' === $litho_mega_submenu_status ) {
						$classes[] = 'dropdown megamenu';
					} else {
						$classes[] = 'simple-dropdown';
					}
					if ( 'yes' === $litho_mega_submenu_status ) {
						$this->get_first_level_menu_id = $item->ID;
					}
					$link_class[] = 'nav-link';
					break;
				case '1':
					if ( $args->walker->has_children && $mega_menu_parent_status ) {
						$classes[] = 'mega-menu-li';
					}
					break;
				default:
					if ( $args->walker->has_children ) {
						$classes[] = 'dropdown';
					}
					break;
			}

			switch ( $litho_menu_item_icon_position ) {
				case 'before':
				default:
					$link_class[] = 'before';
					break;
				case 'after':
					$link_class[] = 'after';
					break;
			}

			/**
			 * Filters the arguments for a single nav menu item.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			/**
			 * Filters the CSS class(es) applied to a menu item's list item element.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts = array();

			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : 'javascript:void(0);';

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			$item_output = $args->before;

			$link_class      = join( ' ', apply_filters( 'litho_mega_menu_main_link_css_class', array_filter( $link_class ), $depth ) );
			$link_class_name = $link_class ? ' class="' . esc_attr( $link_class ) . '"' : '';

			$item_output .= '<a' . $attributes . ' itemprop="url" ' . $link_class_name . '>';

			if ( 'before' === $litho_menu_item_icon_position && ! empty( $litho_menu_item_icon ) && '' != $litho_menu_item_icon ) {
				$item_output .= '<i class="menu-item-icon ' . esc_attr( $litho_menu_item_icon ) . '"' . $litho_icon_color_css . '></i>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
			}

			$item_output .= $args->link_before . $title . $args->link_after;

			if ( 'after' === $litho_menu_item_icon_position && ! empty( $litho_menu_item_icon ) && '' != $litho_menu_item_icon ) {
				$item_output .= '<i class="menu-item-icon ' . esc_attr( $litho_menu_item_icon ) . '"' . $litho_icon_color_css . '></i>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
			}

			$item_output .= '</a>';

			if ( ( $depth > 0 ) && $args->walker->has_children ) {
				$item_output .= '<span class="handler"><i class="fa-solid fa-angle-right"></i></span>';
			}
			// Mobile Icon Dropdown.
			if ( $args->walker->has_children || 'yes' === $litho_mega_submenu_status ) {
				$item_output .= '<i class="fa-solid fa-angle-down dropdown-toggle" data-bs-toggle="dropdown" aria-hidden="true"></i>';
			}

			if ( class_exists( 'Elementor\Plugin' ) && 'yes' === $litho_mega_submenu_status ) {

				$template_content = litho_get_builder_content_for_display( $litho_mega_item );
				if ( ! empty( $template_content ) ) {
					$item_output .= sprintf( '<div class="menu-back-div dropdown-menu megamenu-content" role="menu"><div class="d-lg-flex justify-content-center">%s</div></div>', do_shortcode( $template_content ) );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
				}
			}

			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

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

		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			// Default class.
			$classes = array( 'sub-menu', 'dropdown-menu' );

			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}<ul $class_names>{$n}";
		}

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
