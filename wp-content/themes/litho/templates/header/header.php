<?php
/**
 * The template for displaying the header part
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_enable_mini_header_general = litho_builder_customize_option( 'litho_enable_mini_header_general', '1' );
$litho_enable_mini_header         = litho_builder_option( 'litho_enable_mini_header', '0', $litho_enable_mini_header_general );
$litho_mini_header_section        = litho_builder_option( 'litho_mini_header_section', '', $litho_enable_mini_header_general );
$litho_enable_header_general      = litho_builder_customize_option( 'litho_enable_header_general', '1' );
$litho_enable_header              = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
$litho_header_section_id          = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );

if ( 1 == $litho_enable_mini_header || 1 == $litho_enable_header ) {

	if ( is_litho_addons_activated() && is_elementor_activated() && ( ! empty( $litho_mini_header_section ) || ( ! empty( $litho_header_section_id ) && litho_post_exists( $litho_header_section_id ) ) ) ) {

		get_template_part( 'templates/header/header', 'builder' );

	} else {

		$litho_default_enable_header = get_theme_mod( 'litho_default_enable_header', '1' );

		if ( 1 == $litho_default_enable_header ) {
			get_template_part( 'templates/header/header', 'default' );
		}
	}
}
