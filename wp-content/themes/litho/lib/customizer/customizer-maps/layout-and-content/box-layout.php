<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Box Layout Separator Settings */

$wp_customize->add_setting( 'litho_box_layout_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_box_layout_separator', array(
	'label'      		=> esc_html__( 'Box layout', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_box_layout_panel',
	'settings'   		=> 'litho_box_layout_separator',
	'priority'	 		=> 4,
) ) );

/* End Box Layout Separator Settings */

/* Select Header Box layout */

$wp_customize->add_setting( 'litho_enable_box_layout', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_box_layout', array(
	'label'       		=> esc_html__( 'Box layout', 'litho' ),
	'section'     		=> 'litho_add_box_layout_panel',
	'settings'			=> 'litho_enable_box_layout',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							   ),
	 'priority'	 		=> 4,
) ) );

/* End Header Box layout */

$wp_customize->add_setting( 'litho_enable_box_layout_width', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field',
	'validate_callback' => 'litho_box_layout_validate_callback'
) );

if ( ! function_exists( 'litho_box_layout_validate_callback' ) ) {
	function litho_box_layout_validate_callback( $validity, $value ) {

		if ( ! empty( $value ) && ! is_numeric( $value ) ) {
			$validity->add( 'required', __( 'Please add numeric width', 'litho' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} elseif ( ! empty( $value ) && $value < 1170 ) {
			$validity->add( 'required', __( 'Please add width should be greater than 1170', 'litho' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		return $validity;
	}
}

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_enable_box_layout_width', array(
	'label'             => esc_html__( 'Box layout width', 'litho' ),
	'section'           => 'litho_add_box_layout_panel',
	'settings'          => 'litho_enable_box_layout_width',
	'type'              => 'text',
	'description'		=> esc_html__( 'Width should be greater than 1170', 'litho' ),
	'priority'	 		=> 4,
	'active_callback'   => 'litho_enable_box_layout_width_callback'
) ) );

if ( ! function_exists( 'litho_enable_box_layout_width_callback' ) ) :
	function litho_enable_box_layout_width_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_box_layout' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
