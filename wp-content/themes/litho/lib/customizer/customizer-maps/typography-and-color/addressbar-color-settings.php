<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_addressbar_color_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_addressbar_color_setting_separator', array(
	'label'             => esc_html__( 'Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_addressbar_color_section',
	'settings'          => 'litho_addressbar_color_setting_separator',
) ) );

/* End Separator Settings */

/* Address Bar Color Setting */

$wp_customize->add_setting( 'litho_addressbar_color', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_addressbar_color', array(
	'label'             => esc_html__( 'Address Bar Color', 'litho' ),
	'section'           => 'litho_add_addressbar_color_section',
	'settings'          => 'litho_addressbar_color',
) ) );

/* End Address Bar Color Setting */
