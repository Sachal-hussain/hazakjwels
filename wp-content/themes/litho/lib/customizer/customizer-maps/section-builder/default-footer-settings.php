<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Default Footer Separator Settings */
$wp_customize->add_setting( 'litho_default_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_default_footer_separator', array(
	'label'     		=> esc_html__( 'General', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_default_footer_separator',
) ) );

/* End Default Footer Separator Settings */

/* Enable Footer */
$wp_customize->add_setting( 'litho_default_enable_footer', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_default_enable_footer', array(
	'label'       		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_default_enable_footer',
	'type'              => 'litho_switch',
	'choices'           => array(
							'1' => esc_html__( 'On', 'litho' ),
							'0' => esc_html__( 'Off', 'litho' ),
	   ),
) ) );

/* End Enable Footer */
