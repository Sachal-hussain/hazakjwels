<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_base_color_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_base_color_setting_separator', array(
	'label'             => esc_html__( 'Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_base_color_section',
	'settings'          => 'litho_base_color_setting_separator',
) ) );

/* End Separator Settings */

/* Base Color Setting */

$wp_customize->add_setting( 'litho_base_color', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_base_color', array(
	'label'             => esc_html__( 'Base Color', 'litho' ),
	'section'           => 'litho_add_base_color_section',
	'settings'          => 'litho_base_color',
) ) );

/* End Base Color Setting */
