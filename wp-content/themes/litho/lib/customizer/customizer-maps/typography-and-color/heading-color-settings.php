<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * For General Settings
 */

/* Separator Settings */
$wp_customize->add_setting( 'litho_h1_logo_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_h1_logo_separator', array(
	'label'             => esc_html__( 'H1 Logo', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h1_logo_separator',
) ) );

/* End Separator Settings */

/* H1 in logo in front page setting */

$wp_customize->add_setting( 'litho_h1_logo_font_page', array(
	'default'           => '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_h1_logo_font_page', array(
	'label'             => esc_html__( 'H1 in logo in front / home page?', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h1_logo_font_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End H1 in logo in front page setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_h1_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_h1_setting_separator', array(
	'label'      		=> esc_html__( 'H1 Font and Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_heading_color_section',
	'settings'   		=> 'litho_h1_setting_separator',
) ) );

/* End Separator Settings */

/* H1 font size setting */

$wp_customize->add_setting( 'litho_h1_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h1_font_size', array(
	'label'      		=> esc_html__( 'H1 Font Size', 'litho' ),
	'section'    		=> 'litho_add_heading_color_section',
	'settings'	 		=> 'litho_h1_font_size',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End H1 font size setting */

/* H1 Font Line Height Setting */

$wp_customize->add_setting( 'litho_h1_font_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h1_font_line_height', array(
	'label'      		=> esc_html__( 'H1 Font Line Height', 'litho' ),
	'section'    		=> 'litho_add_heading_color_section',
	'settings'	 		=> 'litho_h1_font_line_height',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End H1 Font Line Height Setting */

/* H1 Font Letter Spacing Setting */

$wp_customize->add_setting( 'litho_h1_font_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h1_font_letter_spacing', array(
	'label'      		=> esc_html__( 'H1 Font Character Spacing', 'litho' ),
	'section'    		=> 'litho_add_heading_color_section',
	'settings'	 		=> 'litho_h1_font_letter_spacing',
	'type'       		=> 'text',
	'description'       => esc_html__( 'Add font letter spacing like 2px.', 'litho' ),
) );

/* End H1 Font Letter Spacing Setting */

/* H1 Font Weight Setting */

$wp_customize->add_setting( 'litho_h1_font_weight', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_h1_font_weight', array(
	'label'             => esc_html__( 'H1 Font Weight Setting', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h1_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''      => esc_html__( 'Select Font Weight', 'litho' ),
								'300'   => esc_html__( 'Font weight 300', 'litho' ),
								'400'   => esc_html__( 'Font weight 400', 'litho' ),
								'500'   => esc_html__( 'Font weight 500', 'litho' ),
								'600'   => esc_html__( 'Font weight 600', 'litho' ),
								'700'   => esc_html__( 'Font weight 700', 'litho' ),
								'800'   => esc_html__( 'Font weight 800', 'litho' ),
								'900'   => esc_html__( 'Font weight 900', 'litho' ),
							),
) );

/* End H1 Font Weight Setting */


/* H1 Color Setting */

$wp_customize->add_setting( 'litho_heading_h1_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_heading_h1_color', array(
	'label'      		=> esc_html__( 'H1 Color', 'litho' ),
	'section'    		=> 'litho_add_heading_color_section',
	'settings'	 		=> 'litho_heading_h1_color',
) ) );

/* End H1 Color Setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_h2_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_h2_setting_separator', array(
	'label'             => esc_html__( 'H2 Font and Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h2_setting_separator',
) ) );

/* End Separator Settings */

/* H2 font size setting */

$wp_customize->add_setting( 'litho_h2_font_size', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h2_font_size', array(
	'label'             => esc_html__( 'H2 Font Size', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h2_font_size',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End H2 font size setting */

/* H2 Font Line Height Setting */

$wp_customize->add_setting( 'litho_h2_font_line_height', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h2_font_line_height', array(
	'label'             => esc_html__( 'H2 Font Line Height', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h2_font_line_height',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End H2 Font Line Height Setting */

/* H2 Font Letter Spacing Setting */

$wp_customize->add_setting( 'litho_h2_font_letter_spacing', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h2_font_letter_spacing', array(
	'label'             => esc_html__( 'H2 Font Character Spacing', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h2_font_letter_spacing',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font letter spacing like 2px.', 'litho' ),
) );

/* End H2 Font Letter Spacing Setting */

/* H2 Font Weight Setting */

$wp_customize->add_setting( 'litho_h2_font_weight', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_h2_font_weight', array(
	'label'             => esc_html__( 'H2 Font Weight Setting', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h2_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''      => esc_html__( 'Select Font Weight', 'litho' ),
								'300'   => esc_html__( 'Font weight 300', 'litho' ),
								'400'   => esc_html__( 'Font weight 400', 'litho' ),
								'500'   => esc_html__( 'Font weight 500', 'litho' ),
								'600'   => esc_html__( 'Font weight 600', 'litho' ),
								'700'   => esc_html__( 'Font weight 700', 'litho' ),
								'800'   => esc_html__( 'Font weight 800', 'litho' ),
								'900'   => esc_html__( 'Font weight 900', 'litho' ),
							),
) );

/* End H1 Font Weight Setting */

/* H2 Color Setting */

$wp_customize->add_setting( 'litho_heading_h2_color', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_heading_h2_color', array(
	'label'             => esc_html__( 'H2 Color', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_heading_h2_color',
) ) );

/* End H2 Color Setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_h3_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_h3_setting_separator', array(
	'label'             => esc_html__( 'H3 Font and Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h3_setting_separator',
) ) );

/* End Separator Settings */

/* H3 font size setting */

$wp_customize->add_setting( 'litho_h3_font_size', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h3_font_size', array(
	'label'             => esc_html__( 'H3 Font Size', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h3_font_size',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End H3 font size setting */

/* H3 Font Line Height Setting */

$wp_customize->add_setting( 'litho_h3_font_line_height', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h3_font_line_height', array(
	'label'             => esc_html__( 'H3 Font Line Height', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h3_font_line_height',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End H3 Font Line Height Setting */

/* H3 Font Letter Spacing Setting */

$wp_customize->add_setting( 'litho_h3_font_letter_spacing', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h3_font_letter_spacing', array(
	'label'             => esc_html__( 'H3 Font Character Spacing', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h3_font_letter_spacing',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font letter spacing like 2px.', 'litho' ),
) );

/* End H3 Font Letter Spacing Setting */

/* H3 Font Weight Setting */

$wp_customize->add_setting( 'litho_h3_font_weight', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_h3_font_weight', array(
	'label'             => esc_html__( 'H3 Font Weight Setting', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h3_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''      => esc_html__( 'Select Font Weight', 'litho' ),
								'300'   => esc_html__( 'Font weight 300', 'litho' ),
								'400'   => esc_html__( 'Font weight 400', 'litho' ),
								'500'   => esc_html__( 'Font weight 500', 'litho' ),
								'600'   => esc_html__( 'Font weight 600', 'litho' ),
								'700'   => esc_html__( 'Font weight 700', 'litho' ),
								'800'   => esc_html__( 'Font weight 800', 'litho' ),
								'900'   => esc_html__( 'Font weight 900', 'litho' ),
							),
) );

/* End H3 Font Weight Setting */

/* H3 Color Setting */

$wp_customize->add_setting( 'litho_heading_h3_color', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_heading_h3_color', array(
	'label'             => esc_html__( 'H3 Color', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_heading_h3_color',
) ) );

/* End H3 Color Setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_h4_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_h4_setting_separator', array(
	'label'             => esc_html__( 'H4 Font and Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h4_setting_separator',
) ) );

/* End Separator Settings */

/* H4 font size setting */

$wp_customize->add_setting( 'litho_h4_font_size', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h4_font_size', array(
	'label'             => esc_html__( 'H4 Font Size', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h4_font_size',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End H4 font size setting */

/* H4 Font Line Height Setting */

$wp_customize->add_setting( 'litho_h4_font_line_height', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h4_font_line_height', array(
	'label'             => esc_html__( 'H4 Font Line Height', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h4_font_line_height',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End H4 Font Line Height Setting */

/* H4 Font Letter Spacing Setting */

$wp_customize->add_setting( 'litho_h4_font_letter_spacing', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h4_font_letter_spacing', array(
	'label'             => esc_html__( 'H4 Font Character Spacing', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h4_font_letter_spacing',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font letter spacing like 2px.', 'litho' ),
) );

/* End H4 Font Letter Spacing Setting */

/* H4 Font Weight Setting */

$wp_customize->add_setting( 'litho_h4_font_weight', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_h4_font_weight', array(
	'label'             => esc_html__( 'H4 Font Weight Setting', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h4_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''      => esc_html__( 'Select Font Weight', 'litho' ),
								'300'   => esc_html__( 'Font weight 300', 'litho' ),
								'400'   => esc_html__( 'Font weight 400', 'litho' ),
								'500'   => esc_html__( 'Font weight 500', 'litho' ),
								'600'   => esc_html__( 'Font weight 600', 'litho' ),
								'700'   => esc_html__( 'Font weight 700', 'litho' ),
								'800'   => esc_html__( 'Font weight 800', 'litho' ),
								'900'   => esc_html__( 'Font weight 900', 'litho' ),
							),
) );

/* End H4 Font Weight Setting */

/* H4 Color Setting */

$wp_customize->add_setting( 'litho_heading_h4_color', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_heading_h4_color', array(
	'label'             => esc_html__( 'H4 Color', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_heading_h4_color',
) ) );

/* End H4 Color Setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_h5_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_h5_setting_separator', array(
	'label'             => esc_html__( 'H5 Font and Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h5_setting_separator',
) ) );

/* End Separator Settings */

/* H5 font size setting */

$wp_customize->add_setting( 'litho_h5_font_size', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h5_font_size', array(
	'label'             => esc_html__( 'H5 Font Size', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h5_font_size',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End H5 font size setting */

/* H5 Font Line Height Setting */

$wp_customize->add_setting( 'litho_h5_font_line_height', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h5_font_line_height', array(
	'label'             => esc_html__( 'H5 Font Line Height', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h5_font_line_height',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End H5 Font Line Height Setting */

/* H5 Font Letter Spacing Setting */

$wp_customize->add_setting( 'litho_h5_font_letter_spacing', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h5_font_letter_spacing', array(
	'label'             => esc_html__( 'H5 Font Character Spacing', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h5_font_letter_spacing',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font letter spacing like 2px.', 'litho' ),
) );

/* End H5 Font Letter Spacing Setting */

/* H5 Font Weight Setting */

$wp_customize->add_setting( 'litho_h5_font_weight', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_h5_font_weight', array(
	'label'             => esc_html__( 'H5 Font Weight Setting', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h5_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''      => esc_html__( 'Select Font Weight', 'litho' ),
								'300'   => esc_html__( 'Font weight 300', 'litho' ),
								'400'   => esc_html__( 'Font weight 400', 'litho' ),
								'500'   => esc_html__( 'Font weight 500', 'litho' ),
								'600'   => esc_html__( 'Font weight 600', 'litho' ),
								'700'   => esc_html__( 'Font weight 700', 'litho' ),
								'800'   => esc_html__( 'Font weight 800', 'litho' ),
								'900'   => esc_html__( 'Font weight 900', 'litho' ),
							),
) );

/* End H5 Font Weight Setting */

/* H5 Color Setting */

$wp_customize->add_setting( 'litho_heading_h5_color', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_heading_h5_color', array(
	'label'             => esc_html__( 'H5 Color', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_heading_h5_color',
) ) );

/* End H5 Color Setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_h6_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_h6_setting_separator', array(
	'label'             => esc_html__( 'H6 Font and Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h6_setting_separator',
) ) );

/* End Separator Settings */

/* H6 font size setting */

$wp_customize->add_setting( 'litho_h6_font_size', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h6_font_size', array(
	'label'             => esc_html__( 'H6 Font Size', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h6_font_size',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font size like 14px.', 'litho' ),
) );

/* End H6 font size setting */

/* H6 Font Line Height Setting */

$wp_customize->add_setting( 'litho_h6_font_line_height', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h6_font_line_height', array(
	'label'             => esc_html__( 'H6 Font Line Height', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h6_font_line_height',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font line height like 24px.', 'litho' ),
) );

/* End H6 Font Line Height Setting */

/* H6 Font Letter Spacing Setting */

$wp_customize->add_setting( 'litho_h6_font_letter_spacing', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_h6_font_letter_spacing', array(
	'label'             => esc_html__( 'H6 Font Character Spacing', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h6_font_letter_spacing',
	'type'              => 'text',
	'description'       => esc_html__( 'Add font letter spacing like 2px.', 'litho' ),
) );

/* End H6 Font Letter Spacing Setting */

 /* H6 Font Weight Setting */

$wp_customize->add_setting( 'litho_h6_font_weight', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( 'litho_h6_font_weight', array(
	'label'             => esc_html__( 'H6 Font Weight Setting', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_h6_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''      => esc_html__( 'Select Font Weight', 'litho' ),
								'300'   => esc_html__( 'Font weight 300', 'litho' ),
								'400'   => esc_html__( 'Font weight 400', 'litho' ),
								'500'   => esc_html__( 'Font weight 500', 'litho' ),
								'600'   => esc_html__( 'Font weight 600', 'litho' ),
								'700'   => esc_html__( 'Font weight 700', 'litho' ),
								'800'   => esc_html__( 'Font weight 800', 'litho' ),
								'900'   => esc_html__( 'Font weight 900', 'litho' ),
							),
) );

/* End H6 Font Weight Setting */

/* H6 Color Setting */

$wp_customize->add_setting( 'litho_heading_h6_color', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_heading_h6_color', array(
	'label'             => esc_html__( 'H6 Color', 'litho' ),
	'section'           => 'litho_add_heading_color_section',
	'settings'          => 'litho_heading_h6_color',
) ) );
/* End H6 Color Setting */
