<?php
/**
 * Excerpt Class.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Excerpt` doesn't exists yet.
if ( ! class_exists( 'Litho_Excerpt' ) ) {
	/**
	 * Define Litho_Excerpt class
	 */
	class Litho_Excerpt {

		public static $length = 34;

		public static function litho_get_by_length( $new_length = 34 ) {
			return self::litho_get( $new_length );
		}

		public static function litho_get( $new_length ) {

			global $post;

			if ( empty( $post->post_excerpt ) ) {
				return;
			}

			$litho_output_data = '';
			$litho_content     = get_the_content();
			$pattern           = get_shortcode_regex();

			if ( $post->post_excerpt ) {
				$litho_output_data = $post->post_excerpt;
			} else {
				$litho_output_data = preg_replace_callback( "/$pattern/s", 'litho_extract_shortcode_contents', $litho_content );
			}

			if ( post_password_required() ) {
				$litho_output_data = $litho_content;
			} else {
				if ( $new_length > 0 ) {
					$litho_output_data = wp_trim_words( $litho_output_data, $new_length, '...' );
				} else {
					$litho_output_data = wp_trim_words( $litho_output_data, $new_length, '' );
				}
			}
			return $litho_output_data;
		}
	}
}
