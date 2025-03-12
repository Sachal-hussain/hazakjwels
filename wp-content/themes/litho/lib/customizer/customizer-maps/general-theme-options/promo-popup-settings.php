<?php
/**
 * The template for promo popup - section builder customizer settings
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Section Builder Admin URL */
$litho_secion_builder_url =	sprintf(
	'<a target="_blank" href="%s">%s </a> %s',
	esc_url( get_admin_url().'edit.php?post_type=sectionbuilder&template_type=promo_popup' ),
	esc_html__( 'Click here', 'litho' ),
	esc_html__( 'to create / manage promo popup in the section builder.', 'litho' )
);

/* Get All Register Mini Header Section List. */
$litho_promo_popup_section_data 			= litho_get_builder_section_data( 'promo_popup' );
$litho_general_promo_popup_section_data 	= litho_get_builder_section_data( 'promo_popup', false, true );

/* Separator Settings */
$wp_customize->add_setting( 'litho_promo_popup_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_promo_popup_separator', array(
	'label'     		=> esc_html__( 'Promo popup', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_promo_popup_panel',
	'settings'   		=> 'litho_promo_popup_separator',
	'priority'	 		=> 3, 
) ) );

/* End Separator Settings */

/* Enable Promo Popup */

$wp_customize->add_setting( 'litho_enable_promo_popup', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_promo_popup', array(
	'label'     		=> esc_html__( 'Promo popup', 'litho' ),
	'section'     		=> 'litho_add_promo_popup_panel',
	'settings'			=> 'litho_enable_promo_popup',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'Yes', 'litho' ),
								'0' => esc_html__( 'No', 'litho' ),
						   ),
	'priority'	 		=> 3,
) ) );

/* End Enable Promo Popup */

/* Enable Promo Popup Only Home Page */

$wp_customize->add_setting( 'litho_enable_promo_popup_on_home_page', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_promo_popup_on_home_page', array(
	'label'     		=> esc_html__( 'Promo popup only home page', 'litho' ),
	'section'     		=> 'litho_add_promo_popup_panel',
	'settings'			=> 'litho_enable_promo_popup_on_home_page',
	'type'              => 'litho_switch',
	'active_callback' 	=> 'litho_promo_popup_enable_callback',
	'choices'           => array(
								'1' => esc_html__( 'Yes', 'litho' ),
								'0' => esc_html__( 'No', 'litho' ),
						   ),
	'priority'	 		=> 3,
) ) );

/* End Enable Promo Popup Only Home Page */

$wp_customize->add_setting( 'litho_promo_popup_section', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_promo_popup_section', array(
	'label'     		=> esc_html__( 'Promo popup section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_promo_popup_panel',
	'settings'			=> 'litho_promo_popup_section',
	'choices'           => $litho_promo_popup_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_promo_popup_enable_callback',
	'priority'	 		=> 3,
) ) );

// callback functions
if ( ! function_exists( 'litho_promo_popup_enable_callback' ) ) {
	function litho_promo_popup_enable_callback( $control ) {
			if ( $control->manager->get_setting( 'litho_enable_promo_popup' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
}
