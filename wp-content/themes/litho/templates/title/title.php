<?php
/**
 * The template for displaying the title part
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_404() || is_singular( 'attachment' ) ) {
	return;
}

$litho_enable_custom_title_general = litho_builder_customize_option( 'litho_enable_custom_title_general', '1' );
$litho_enable_custom_title         = litho_builder_option( 'litho_enable_custom_title', '1', $litho_enable_custom_title_general );
$litho_custom_title_section_id     = litho_builder_option( 'litho_custom_title_section', '', $litho_enable_custom_title_general );

if ( is_litho_addons_activated() ) {

	if ( 1 == $litho_enable_custom_title ) {

		if ( ! empty( $litho_custom_title_section_id ) ) {

			get_template_part( 'templates/title/title', 'builder' );

		} else {

			get_template_part( 'templates/title/title', 'default' );
		}
	}
} else {

	get_template_part( 'templates/title/title', 'default' );
}
