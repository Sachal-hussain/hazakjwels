<?php
/**
 * The template for side icon - section builder customizer settings
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
	esc_url( get_admin_url().'edit.php?post_type=sectionbuilder&template_type=side_icon' ),
	esc_html__( 'Click here', 'litho' ),
	esc_html__( 'to create / manage side icon in the section builder.', 'litho' )
);

/* Get All Register Mini Header Section List. */
$litho_side_icon_section_data 			= litho_get_builder_section_data( 'side_icon' );
$litho_general_side_icon_section_data 	= litho_get_builder_section_data( 'side_icon', false, true );

/* Separator Settings */
$wp_customize->add_setting( 'litho_side_icon_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_side_icon_separator', array(
	'label'     		=> esc_html__( 'Side icon button', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_side_icon_panel',
	'settings'   		=> 'litho_side_icon_separator',
	'priority'	 		=> 3, 
) ) );

/* End Separator Settings */

/* Enable Side Icon */

$wp_customize->add_setting( 'litho_enable_side_icon', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_side_icon', array(
	'label'     		=> esc_html__( 'Side icon button', 'litho' ),
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_enable_side_icon',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'Yes', 'litho' ),
								'0' => esc_html__( 'No', 'litho' ),
						   ),
	'priority'	 		=> 3,
) ) );

/* End Enable Side Icon */

/* Enable Side Icon Only Home Page */

$wp_customize->add_setting( 'litho_enable_side_icon_on_home_page', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_side_icon_on_home_page', array(
	'label'     		=> esc_html__( 'Side icon only home page', 'litho' ),
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_enable_side_icon_on_home_page',
	'type'              => 'litho_switch',
	'active_callback' 	=> 'litho_side_icon_enable_callback',
	'choices'           => array(
								'1' => esc_html__( 'Yes', 'litho' ),
								'0' => esc_html__( 'No', 'litho' ),
							),
	'priority'	 		=> 3,
) ) );

/* End Enable Side Icon Only Home Page */


$wp_customize->add_setting( 'litho_enable_side_icon_first_button', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_side_icon_first_button', array(
	'label'     		=> esc_html__( 'Demos button', 'litho' ),
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_enable_side_icon_first_button',
	'type'              => 'litho_switch',
	'active_callback' 	=> 'litho_side_icon_enable_callback',
	'choices'           => array(
								'1' => esc_html__( 'Yes', 'litho' ),
								'0' => esc_html__( 'No', 'litho' ),
							),
	'priority'	 		=> 3,
) ) );

$wp_customize->add_setting( 'litho_side_icon_button_first_text', array(
	'default' 			=> esc_html__( '37+ demos', 'litho' ),
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_side_icon_button_first_text', array(
	'label'				=> esc_html__( 'Demos button text', 'litho' ),
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_side_icon_button_first_text',
	'type'              => 'text',
	'active_callback'   => 'litho_side_icon_section_callback',
	'priority'	 		=> 3,
) ) );

$wp_customize->add_setting( 'litho_side_icon_section', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_side_icon_section', array(
	'label'     		=> esc_html__( 'Side icon template', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_side_icon_section',
	'choices'           => $litho_side_icon_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_side_icon_section_callback',
	'priority'	 		=> 3,
) ) );

$wp_customize->add_setting( 'litho_enable_side_icon_second_button', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_side_icon_second_button', array(
	'label'     		=> esc_html__( 'Buy now button', 'litho' ),
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_enable_side_icon_second_button',
	'type'              => 'litho_switch',
	'active_callback' 	=> 'litho_side_icon_enable_callback',
	'choices'           => array(
								'1' => esc_html__( 'Yes', 'litho' ),
								'0' => esc_html__( 'No', 'litho' ),
						   ),
	'priority'	 		=> 3,
) ) );

$wp_customize->add_setting( 'litho_side_icon_second_button_text', array(
	'default' 			=> esc_html__( 'Buy now', 'litho' ),
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_side_icon_second_button_text', array(
	'label'				=> esc_html__( 'Buy now button text', 'litho' ),
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_side_icon_second_button_text',
	'type'              => 'text',
	'active_callback'   => 'litho_side_icon_link_section_callback',
	'priority'	 		=> 3,
) ) );


$wp_customize->add_setting( 'litho_side_icon_second_button_link', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_side_icon_second_button_link', array(
	'label'				=> esc_html__( 'Buy now button link', 'litho' ),
	'section'     		=> 'litho_add_side_icon_panel',
	'settings'			=> 'litho_side_icon_second_button_link',
	'type'              => 'text',
	'active_callback'   => 'litho_side_icon_link_section_callback',
	'priority'	 		=> 3,
) ) );

/* Typography Settings*/

$wp_customize->add_setting( 'litho_side_icon_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_side_icon_typography', array(
	'label'     		=> esc_html__( 'Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_side_icon_panel',
	'settings'   		=> 'litho_side_icon_typography',
	'active_callback'   => 'litho_side_icon_enable_callback',
	'priority'	 		=> 3, 
) ) );

$wp_customize->add_setting( 'litho_side_icon_first_button_background_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_side_icon_first_button_background_color', array(
	'label'      		=> esc_html__( 'Demos button background color', 'litho' ),
	'section'    		=> 'litho_add_side_icon_panel',
	'settings'	 		=> 'litho_side_icon_first_button_background_color',
	'priority'	 		=> 3,
	'active_callback'   => 'litho_side_icon_enable_callback',
) ) );


$wp_customize->add_setting( 'litho_side_icon_first_button_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_side_icon_first_button_text_color', array(
	'label'      		=> esc_html__( 'Demos button text color', 'litho' ),
	'section'    		=> 'litho_add_side_icon_panel',
	'settings'	 		=> 'litho_side_icon_first_button_text_color',
	'priority'	 		=> 3,
	'active_callback'   => 'litho_side_icon_enable_callback',
) ) );


$wp_customize->add_setting( 'litho_side_icon_second_button_background_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_side_icon_second_button_background_color', array(
	'label'      		=> esc_html__( 'Buy now button background color', 'litho' ),
	'section'    		=> 'litho_add_side_icon_panel',
	'settings'	 		=> 'litho_side_icon_second_button_background_color',
	'priority'	 		=> 3,
	'active_callback'   => 'litho_side_icon_enable_callback',
) ) );

$wp_customize->add_setting( 'litho_side_icon_second_button_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_side_icon_second_button_text_color', array(
	'label'      		=> esc_html__( 'Buy now button text color', 'litho' ),
	'section'    		=> 'litho_add_side_icon_panel',
	'settings'	 		=> 'litho_side_icon_second_button_text_color',
	'priority'	 		=> 3,
	'active_callback'   => 'litho_side_icon_enable_callback',
) ) );

// callback functions
if ( ! function_exists( 'litho_side_icon_enable_callback' ) ) {
	function litho_side_icon_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_side_icon' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_side_icon_section_callback' ) ) {
	function litho_side_icon_section_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_side_icon' )->value() == '1' && $control->manager->get_setting( 'litho_enable_side_icon_first_button' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_side_icon_link_section_callback' ) ) {
	function litho_side_icon_link_section_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_side_icon' )->value() == '1' && $control->manager->get_setting( 'litho_enable_side_icon_second_button' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
}
