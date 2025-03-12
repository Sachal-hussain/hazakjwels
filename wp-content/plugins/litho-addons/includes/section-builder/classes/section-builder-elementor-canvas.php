<?php
namespace LithoAddons\Section_builder\Classes;

/**
 * Section builder Elementor Canvas
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Section_Builder_Elementor_Canvas` doesn't exists yet.
if ( ! class_exists( 'Section_Builder_Elementor_Canvas' ) ) {

	/**
	 * Define Section_Builder_Elementor_Canvas class
	 */
	class Section_Builder_Elementor_Canvas {

		public $current_template_type;

		private static $elementor_instance;

		public function __construct() {

			if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
				self::$elementor_instance = \Elementor\Plugin::instance();
			}

			add_action( 'wp', array( $this, 'litho_load_hooks' ) );
		}

		public function litho_load_hooks() {

			add_action( 'theme_mini_header', 'sectionbuilder_render_html_mini_header' );
			add_action( 'theme_header', 'sectionbuilder_render_html_header' );
			add_action( 'theme_footer', 'sectionbuilder_render_html_footer' );
			add_action( 'theme_archive', 'sectionbuilder_render_html_archive' );
			add_action( 'theme_archive_portfolio', 'sectionbuilder_render_html_archive_portfolio' );
			add_action( 'theme_custom_title', 'sectionbuilder_render_html_custom_title' );
			add_action( 'theme_promo_popup', 'sectionbuilder_render_html_promo_popup' );
			add_action( 'theme_side_icon', 'sectionbuilder_render_html_side_icon' );
		}
	}
}
