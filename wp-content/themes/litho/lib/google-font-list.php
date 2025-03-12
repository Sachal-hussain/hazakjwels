<?php
/**
 * Google fonts list
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'litho_googlefonts_list' ) ) {
	/**
	 * Return array google fonts
	 */
	function litho_googlefonts_list() {
		$litho_google_fonts      = litho_google_font_list();
		$litho_google_font_array = array();
		foreach ( $litho_google_fonts as $fontkey => $fontvalue ) {
			$litho_google_font_array[ $fontvalue ] = $fontvalue;
		}
		return $litho_google_font_array;
	}
}

if ( ! function_exists( 'litho_google_font_list' ) ) {
	/**
	 * Return google fonts lists
	 */
	function litho_google_font_list() {

		global $wp_filesystem;
		$googlefonts      = array();
		$google_font_json = '';

		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();

		$local_file = LITHO_THEME_LIB . '/litho-google-font.json';
		if ( $wp_filesystem->exists( $local_file ) ) {
			$google_font_json = $wp_filesystem->get_contents( $local_file );
		}

		if ( ! empty( $google_font_json ) ) {
			$google_fonts = json_decode( $google_font_json );
			if ( ! empty( $google_fonts->items ) ) {
				foreach ( $google_fonts->items as $key => $value ) {
					if ( ! empty( $value ) && ! empty( $value->family ) ) {
						$googlefonts[] = $value->family;
					}
				}
			}
		}

		/**
		 * Apply filters to load another google fonts lists so user can add its fonts.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'litho_google_font_lists', $googlefonts );
	}
}
