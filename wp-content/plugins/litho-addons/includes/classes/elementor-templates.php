<?php
namespace LithoAddons\Classes;

use Elementor\Plugin;

/**
 * Elementor template list
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Elementor_Templates` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Classes\Elementor_Templates' ) ) {

	/**
	 * Define Elementor_Templates class
	 */
	class Elementor_Templates {

		/**
		 * Get elementor templates list for options.
		 *
		 * @return array
		 */
		public static function get_elementor_templates_options() {

			$templates = Plugin::$instance->templates_manager->get_source( 'local' )->get_items();

			$options = array(
				'0' => '— ' . esc_html__( 'Select', 'litho-addons' ) . ' —',
			);

			foreach ( $templates as $template ) {
				$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')'; // phpcs:ignore
			}
			return $options;
		}
	}
}
