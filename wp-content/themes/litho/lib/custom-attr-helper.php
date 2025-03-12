<?php
/**
 * Custom Attributes Helper
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Custom_Attr_Helper` doesn't exists yet.
if ( ! class_exists( 'Litho_Custom_Attr_Helper' ) ) {
	/**
	 * The Main Custom Attr Helper class
	 */
	class Litho_Custom_Attr_Helper {

		/**
		 * Hold an instance of Litho_Custom_Attr_Helper class.
		 *
		 * @var static $instance
		 */
		public static $instance;

		/**
		 * Main Litho_Custom_Attr_Helper instance.
		 *
		 * @return Litho_Custom_Attr_Helper - Main instance.
		 */
		public static function get_instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function attr( $context, $attributes = array() ) {
			$atts = $this->get_attr( $context, $attributes );
			echo apply_filters( 'litho_attributes', $atts ); // phpcs:ignore
		}

		public function get_attr( $context, $attributes = array() ) {

			$defaults   = array();
			$attributes = wp_parse_args( $attributes, $defaults );
			$attributes = apply_filters( "litho_attr_{$context}", $attributes, $context );// phpcs:ignore
			$output     = $this->html_attributes( $attributes );
			$output     = apply_filters( "litho_{$context}_output", $output, $attributes, $context );// phpcs:ignore

			return trim( $output );
		}

		public function html_attributes( $attributes = array(), $prefix = '' ) {

			/**
			 * If empty return false
			 */
			if ( empty( $attributes ) ) {
				return false;
			}

			$options = false;
			if ( isset( $attributes['data-options'] ) ) {
				$options = $attributes['data-options'];
				unset( $attributes['data-options'] );
			}

			$html_attributes_output = '';
			foreach ( $attributes as $key => $value ) {

				if ( ! $value ) {
					continue;
				}

				$key = $prefix . $key;
				if ( true === $value ) {
					$value = 'true';
				}

				if ( false === $value ) {
					$value = 'false';
				}

				if ( is_array( $value ) ) {
					$html_attributes_output .= sprintf( ' %s=\'%s\'', esc_html( $key ), json_encode( $value ) );
				} else {
					$html_attributes_output .= sprintf( ' %s="%s"', esc_html( $key ), esc_attr( $value ) );
				}
			}

			if ( $options ) {
				$html_attributes_output .= sprintf( ' data-options=\'%s\'', $options );
			}

			return $html_attributes_output;
		}
	}
}

function litho_custom_attr_helper_obj() {
	return Litho_Custom_Attr_Helper::get_instance();
}

litho_custom_attr_helper_obj();
