<?php
namespace LithoAddons\Custom_icons;

/**
 * Custom icons list
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Render_custom_icons_html` doesn't exists yet.
if ( ! class_exists( 'Render_custom_icons_html' ) ) {

	/**
	 * Define Render_custom_icons_html class
	 */
	class Render_custom_icons_html {

		/**
		 * Get icons array
		 */
		public static function render_icon( $key ) {

			if ( empty( $key ) ) {
				return;
			}

			$get_icons_data = self::extract_json_value( $key );
			return $get_icons_data;

		}
		/**
		 * Return icons array from json
		 */
		public static function extract_json_value( $file ) {

			$json_assets = LITHO_ADDONS_INCLUDES_PATH . '/assets/font-json/' . $file . '.json';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			if ( file_exists( $json_assets ) ) {
				$get_json_data = file_get_contents( $json_assets );
				$icons_obj     = json_decode( $get_json_data );

				if ( is_object( $icons_obj ) ) {
					return $icons_obj->icons;
				}
			} else {
				return;
			}
		}
	}
}
