<?php
/**
 * Layout style passing by parameter
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'litho_override_page_container_style' ) ) {

	/**
	 * Change layout style using passing parameter like ?container=full
	 *
	 * @param string $container Set Layout Container.
	 */
	function litho_override_page_container_style( $container ) {

		$compare_params = array( 'fix', 'full', 'box' );

		if ( ! empty( $_GET['container'] ) && in_array( $_GET['container'], $compare_params ) ) { // phpcs:ignore
			if ( 'fix' == $_GET['container'] ) { // phpcs:ignore

				$container = 'container';

			} elseif ( 'full' == $_GET['container'] ) { // phpcs:ignore

				$container = 'container-fluid';

			} elseif ( 'box' == $_GET['container'] ) { // phpcs:ignore

				$container = 'container-fluid-with-padding';
			}
		}
		return $container;
	}
}
add_filter( 'litho_page_container_style', 'litho_override_page_container_style', 100 );

if ( ! function_exists( 'litho_override_page_layout_style' ) ) {

	/**
	 * Change sidebar style using passing parameter like ?sidebar=right_sidebar
	 *
	 * @param string $layout_style Set Layout Sidebar Style.
	 */
	function litho_override_page_layout_style( $layout_style ) {

		$compare_params = array( 'no_sidebar', 'left_sidebar', 'right_sidebar', 'both_sidebar' );

		if ( ! empty( $_GET['sidebar'] ) && in_array( $_GET['sidebar'], $compare_params ) ) { // phpcs:ignore
			$layout_style = 'litho_layout_' . $_GET['sidebar']; // phpcs:ignore
		}
		return $layout_style;
	}
}
add_filter( 'litho_page_layout_style', 'litho_override_page_layout_style', 100 );

if ( ! function_exists( 'litho_override_page_padding_top' ) ) {

	/**
	 * Change sidebar style using passing parameter like ?no_padding_top=1
	 */
	function litho_override_page_padding_top() {

		$no_padding_top = '';
		if ( isset( $_GET['no_padding_top'] ) && '1' == $_GET['no_padding_top'] ) { // phpcs:ignore
			$no_padding_top = ' pt-0';
		}

		return $no_padding_top;
	}
}
add_filter( 'litho_page_no_padding_top', 'litho_override_page_padding_top', 100 );

if ( ! function_exists( 'litho_override_product_column' ) ) {
	/**
	 * Change product archive column using passing parameter like ?column=4
	 *
	 * @param string $column Set Layout Column.
	 */
	function litho_override_product_column( $column ) {

		$compare_params = array( '2', '3', '4', '5', '6' );

		if ( ! empty( $_GET['column'] ) && in_array( $_GET['column'], $compare_params ) ) { // phpcs:ignore
			$column = $_GET['column']; // phpcs:ignore
		}

		return $column;
	}
}
add_filter( 'litho_product_lists_column', 'litho_override_product_column', 100 );

if ( ! function_exists( 'litho_override_filter_current_page_url' ) ) {
	/**
	 * Add arguments in filter current page URL
	 *
	 * @param string $link current page URL.
	 */
	function litho_override_filter_current_page_url( $link ) {

		// Container parameter.
		if ( isset( $_GET['container'] ) ) { // phpcs:ignore
			$link = add_query_arg( 'container', wc_clean( wp_unslash( $_GET['container'] ) ), $link ); // phpcs:ignore
		}

		// Layout parameter.
		if ( isset( $_GET['sidebar'] ) ) { // phpcs:ignore
			$link = add_query_arg( 'sidebar', wc_clean( wp_unslash( $_GET['sidebar'] ) ), $link ); // phpcs:ignore
		}

		// Column parameter.
		if ( isset( $_GET['column'] ) ) { // phpcs:ignore
			$link = add_query_arg( 'column', wc_clean( wp_unslash( $_GET['column'] ) ), $link ); // phpcs:ignore
		}

		// Padding parameter.
		if ( isset( $_GET['no_padding_top'] ) ) { // phpcs:ignore
			$link = add_query_arg( 'no_padding_top', wc_clean( wp_unslash( $_GET['no_padding_top'] ) ), $link ); // phpcs:ignore
		}

		return $link;
	}
}
add_filter( 'woocommerce_layered_nav_link', 'litho_override_filter_current_page_url' );
add_filter( 'woocommerce_rating_filter_link', 'litho_override_filter_current_page_url' );
