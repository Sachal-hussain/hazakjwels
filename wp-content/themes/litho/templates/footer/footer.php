<?php
/**
 * The template for displaying the footer part
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_enable_footer_general = litho_builder_customize_option( 'litho_enable_footer_general', '1' );
$litho_enable_footer         = litho_builder_option( 'litho_enable_footer', '1', $litho_enable_footer_general );
$litho_footer_section_id     = litho_builder_option( 'litho_footer_section', '', $litho_enable_footer_general );

if ( 1 == $litho_enable_footer ) {

	if ( is_litho_addons_activated() && is_elementor_activated() && ( ! empty( $litho_footer_section_id ) && litho_post_exists( $litho_footer_section_id ) ) ) {

		get_template_part( 'templates/footer/footer', 'builder' );

	} else {

		$litho_default_enable_footer = get_theme_mod( 'litho_default_enable_footer', '1' );

		if ( 1 == $litho_default_enable_footer ) {
			get_template_part( 'templates/footer/footer', 'default' );
		}
	}
}
