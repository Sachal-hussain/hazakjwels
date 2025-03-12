<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_comment_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_comment_setting_separator', array(
	'label'      		=> esc_html__( 'Font and Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_comment_color_section',
	'settings'   		=> 'litho_comment_setting_separator',
) ) );

/* End Separator Settings */

/* Comment Title */

$wp_customize->add_setting( 'litho_comment_title', array(
	'default' 			=> esc_html__( 'Write a comment', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_comment_title', array(
	'label'       		=> esc_html__( 'Comment Title', 'litho' ),
	'section'     		=> 'litho_add_comment_color_section',
	'settings'			=> 'litho_comment_title',
	'type'              => 'text',
) ) );

/* End Comment Title */

/* Comment font size setting */

$wp_customize->add_setting( 'litho_comment_title_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_comment_title_font_size', array(
	'label'      		=> esc_html__( 'Comment Title Font Size', 'litho' ),
	'section'    		=> 'litho_add_comment_color_section',
	'settings'	 		=> 'litho_comment_title_font_size',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End Comment font size setting */

/* Comment Font Line Height Setting */

$wp_customize->add_setting( 'litho_comment_title_font_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_comment_title_font_line_height', array(
	'label'      		=> esc_html__( 'Comment Title Font Line Height', 'litho' ),
	'section'    		=> 'litho_add_comment_color_section',
	'settings'	 		=> 'litho_comment_title_font_line_height',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End Comment Font Line Height Setting */

/* Comment Font Letter Spacing Setting */

$wp_customize->add_setting( 'litho_comment_title_font_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_comment_title_font_letter_spacing', array(
	'label'      		=> esc_html__( 'Comment Title Font Character Spacing', 'litho' ),
	'section'    		=> 'litho_add_comment_color_section',
	'settings'	 		=> 'litho_comment_title_font_letter_spacing',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font letter spacing like 24px.', 'litho' ),
) );

/* End Comment Font Letter Spacing Setting */

/* Comment Title Color Setting */

$wp_customize->add_setting( 'litho_general_comment_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_general_comment_title_color', array(
	'label'      		=> esc_html__( 'Comment Title Color', 'litho' ),
	'section'    		=> 'litho_add_comment_color_section',
	'settings'	 		=> 'litho_general_comment_title_color',
) ) );

/* End Comment Title Color Setting */
