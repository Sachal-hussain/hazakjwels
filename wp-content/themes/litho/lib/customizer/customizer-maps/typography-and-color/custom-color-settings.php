<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_body_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_body_setting_separator', array(
	'label'      		=> esc_html__( 'Font Size and Line Height', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_general_color_section',
	'settings'   		=> 'litho_body_setting_separator',
) ) );

/* End Separator Settings */

/* Body font size setting */

$wp_customize->add_setting( 'litho_body_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_body_font_size', array(
	'label'      		=> esc_html__( 'Body Font Size', 'litho' ),
	'section'    		=> 'litho_add_general_color_section',
	'settings'	 		=> 'litho_body_font_size',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End Body font size setting */

/* Body Font Line Height Setting */

$wp_customize->add_setting( 'litho_body_font_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_body_font_line_height', array(
	'label'      		=> esc_html__( 'Body Font Line Height', 'litho' ),
	'section'    		=> 'litho_add_general_color_section',
	'settings'	 		=> 'litho_body_font_line_height',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End Body Font Line Height Setting */

/* Body Font Line Height Setting */

$wp_customize->add_setting( 'litho_body_font_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_body_font_letter_spacing', array(
	'label'      		=> esc_html__( 'Body Font Character Spacing', 'litho' ),
	'section'    		=> 'litho_add_general_color_section',
	'settings'	 		=> 'litho_body_font_letter_spacing',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font letter spacing like 24px.', 'litho' ),
) );

/* End Body Font Line Height Setting */

/* Content font size setting */

$wp_customize->add_setting( 'litho_content_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_content_font_size', array(
	'label'      		=> esc_html__( 'Content Font Size', 'litho' ),
	'section'    		=> 'litho_add_general_color_section',
	'settings'	 		=> 'litho_content_font_size',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font size like 12px.', 'litho' ),
) );

/* End Content font size setting */

/* Body Font Line Height Setting */

$wp_customize->add_setting( 'litho_content_font_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_content_font_line_height', array(
	'label'      		=> esc_html__( 'Content Font Line Height', 'litho' ),
	'section'    		=> 'litho_add_general_color_section',
	'settings'	 		=> 'litho_content_font_line_height',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End Body Font Line Height Setting */

/* Body Font Line Height Setting */

$wp_customize->add_setting( 'litho_content_font_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_content_font_letter_spacing', array(
	'label'      		=> esc_html__( 'Content Font Character Spacing', 'litho' ),
	'section'    		=> 'litho_add_general_color_section',
	'settings'	 		=> 'litho_content_font_letter_spacing',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font letter spacing like 24px.', 'litho' ),
) );

/* End Body Font Line Height Setting */

/*
 * For Content Settings
 */

/* Separator Settings */
$wp_customize->add_setting( 'litho_general_content_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_general_content_setting_separator', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_content_color_section',
	'settings'   		=> 'litho_general_content_setting_separator',
) ) );

/* End Separator Settings */

/* Body Background Color Setting */

$wp_customize->add_setting( 'litho_body_background_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_body_background_color', array(
	'label'      		=> esc_html__( 'Body Background', 'litho' ),
	'section'    		=> 'litho_add_content_color_section',
	'settings'	 		=> 'litho_body_background_color',
) ) );

/* End Body Background Color Setting */

/* Body Text Color Setting */

$wp_customize->add_setting( 'litho_body_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_body_text_color', array(
	'label'      		=> esc_html__( 'Body Text', 'litho' ),
	'section'    		=> 'litho_add_content_color_section',
	'settings'	 		=> 'litho_body_text_color',
) ) );

/* End Body Text Color Setting */

/* Content Link Color Setting */

$wp_customize->add_setting( 'litho_content_link_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_content_link_color', array(
	'label'      		=> esc_html__( 'Link', 'litho' ),
	'section'    		=> 'litho_add_content_color_section',
	'settings'	 		=> 'litho_content_link_color',
) ) );

/* End Content Link Color Setting */

/* Content Link Hover Color Setting */

$wp_customize->add_setting( 'litho_content_link_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_content_link_hover_color', array(
	'label'      		=> esc_html__( 'Link Hover', 'litho' ),
	'section'    		=> 'litho_add_content_color_section',
	'settings'	 		=> 'litho_content_link_hover_color',
) ) );

/* End Content Link Hover Color Setting */
