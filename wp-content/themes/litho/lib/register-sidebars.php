<?php
/**
 * Register Litho theme required widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'litho_widgets_init' ) ) {
	/**
	 * Register widget area.
	 */
	function litho_widgets_init() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Main Sidebar', 'litho' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Place widgets to show in your sidebar', 'litho' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title alt-font">',
				'after_title'   => '</div>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Langauge Sidebar', 'litho' ),
				'id'            => 'litho-langauge-sidebar',
				'description'   => esc_html__( 'Place widgets to show in your navigation', 'litho' ),
				'before_widget' => '<div class="widget %2$s" id="%1$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title alt-font">',
				'after_title'   => '</div>',
			)
		);

		/* if WooCommerce plugin is activated */
		if ( is_woocommerce_activated() ) {

			register_sidebar(
				array(
					'name'          => esc_html__( 'Mini Cart Sidebar', 'litho' ),
					'id'            => 'litho-mini-cart',
					'description'   => esc_html__( 'Place widgets to show in your mini cart sidebar', 'litho' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title">',
					'after_title'   => '</div>',
				)
			);

			register_sidebar(
				array(
					'name'          => esc_html__( 'Shop Sidebar', 'litho' ),
					'id'            => 'litho-shop-1',
					'description'   => esc_html__( 'Place widgets to show in your shop pages sidebar', 'litho' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title alt-font">',
					'after_title'   => '</div>',
				)
			);
		}
	}
}
add_action( 'widgets_init', 'litho_widgets_init' );
