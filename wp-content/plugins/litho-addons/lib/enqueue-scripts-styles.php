<?php
/**
 * Litho Addons Register CSS and JS.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'litho_enqueue_script_style' ) ) {
	function litho_enqueue_script_style() {

		if ( litho_load_stylesheet_by_key( 'hover-animation' ) ) {
			wp_register_style(
				'hover-animation',
				LITHO_ADDONS_CSS_DIR . '/hover-min.css',
				array(),
				'2.3.2'
			);

			wp_enqueue_style( 'hover-animation' );
		}

		if ( litho_load_stylesheet_by_key( 'font-awesome' ) ) {
			// Elementor's Enqueue Fonts Style.
			wp_enqueue_style( 'elementor-icons-fa-regular' );
			wp_enqueue_style( 'elementor-icons-fa-brands' );
			wp_enqueue_style( 'elementor-icons-fa-solid' );

			wp_deregister_style( 'font-awesome' );
			wp_dequeue_style( 'font-awesome' );

			wp_register_style(
				'font-awesome',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/font-awesome.min.css',
				array(),
				'6.5.2'
			);
			wp_enqueue_style( 'font-awesome' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'litho_enqueue_script_style' );

if ( ! function_exists( 'litho_admin_enqueue_style_script' ) ) {
	function litho_admin_enqueue_style_script() {

		wp_register_style(
			'select2',
			LITHO_ADDONS_ADMIN_CSS_DIR . '/select2.min.css',
			array(),
			'4.0.13'
		);

		wp_enqueue_style( 'select2' );

		wp_register_style(
			'litho-addons-custom-admin',
			LITHO_ADDONS_ADMIN_CSS_DIR . '/litho-addons-custom-admin.css',
			array(),
			LITHO_ADDONS_PLUGIN_VERSION
		);

		wp_enqueue_style( 'litho-addons-custom-admin' );

		wp_register_script(
			'select2',
			LITHO_ADDONS_ADMIN_JS_DIR . '/select2.min.js',
			array( 'jquery' ),
			'4.0.13',
			true
		);
		wp_enqueue_script( 'select2' );
	}
}
add_action( 'admin_enqueue_scripts', 'litho_admin_enqueue_style_script' );
