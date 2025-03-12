<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Default Header Separator Settings */
$wp_customize->add_setting( 'litho_default_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_default_header_separator', array(
	'label'     		=> esc_html__( 'General', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_default_header_separator',
) ) );

/* End Default Header Separator Settings */

/* Enable Header */
$wp_customize->add_setting( 'litho_default_enable_header', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_default_enable_header', array(
	'label'       		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_default_enable_header',
	'type'              => 'litho_switch',
	'choices'           => array(
							'1' => esc_html__( 'On', 'litho' ),
							'0' => esc_html__( 'Off', 'litho' ),
	   ),
) ) );

/* End Enable Header */
