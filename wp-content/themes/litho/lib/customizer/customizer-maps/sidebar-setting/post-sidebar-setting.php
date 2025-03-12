<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */

$wp_customize->add_setting( 'litho_post_widget_general_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_widget_general_setting_separator', array(
	'label'				=> esc_html__( 'General', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_post_sidebar_section',
	'settings'   		=> 'litho_post_widget_general_setting_separator',
) ) );

/* End Separator Settings */

/* Widget content Color setting*/

$wp_customize->add_setting( 'litho_post_widget_content_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_widget_content_color', array(
	'label'				=> esc_html__( 'Content color', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_content_color',
) ) );

/* End Widget content Color setting */

/* Widget content link Color setting*/

$wp_customize->add_setting( 'litho_post_widget_content_link_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_widget_content_link_color', array(
	'label'				=> esc_html__( 'Content link color', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_content_link_color',
) ) );

/* End Widget content link Color setting */

/* Widget content link hover Color setting*/

$wp_customize->add_setting( 'litho_post_widget_content_link_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_widget_content_link_hover_color', array(
	'label'				=> esc_html__( 'Content link hover color', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_content_link_hover_color',
) ) );

/* End Widget content link hover Color setting */

/* Widget Background Color setting*/

$wp_customize->add_setting( 'litho_post_widget_background_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_widget_background_color', array(
	'label'				=> esc_html__( 'Background color', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_background_color',
) ) );

/* End Widget Background Color setting */

/* Widget Border Color setting*/

$wp_customize->add_setting( 'litho_post_widget_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_widget_border_color', array(
	'label'				=> esc_html__( 'Border color', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_border_color',
) ) );

/* End Widget Border Color setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_post_widget_title_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_widget_title_setting_separator', array(
	'label'				=> esc_html__( 'Widget Title Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_post_sidebar_section',
	'settings'   		=> 'litho_post_widget_title_setting_separator',
) ) );

/* End Separator Settings */

/* Widget title Font Size */

$wp_customize->add_setting( 'litho_post_widget_title_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_post_widget_title_font_size', array(
	'label'				=> esc_html__( 'Font size', 'litho' ),
	'section'    		=> 'litho_add_post_sidebar_section',
	'settings'	 		=> 'litho_post_widget_title_font_size',
	'type'       		=> 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
) );

/* End Widget title Font Size */

/* Widget Title Line Height */

$wp_customize->add_setting( 'litho_post_widget_title_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_post_widget_title_line_height', array(
	'label'				=> esc_html__( 'Line height', 'litho' ),
	'section'    		=> 'litho_add_post_sidebar_section',
	'settings'	 		=> 'litho_post_widget_title_line_height',
	'type'       		=> 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
) );

/* End Widget Title Line Height */

/* Widget Title Letter Spacing */

$wp_customize->add_setting( 'litho_post_widget_title_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_post_widget_title_letter_spacing', array(
	'label'				=> esc_html__( 'Letter spacing', 'litho' ),
	'section'    		=> 'litho_add_post_sidebar_section',
	'settings'	 		=> 'litho_post_widget_title_letter_spacing',
	'type'       		=> 'text',
	'description'		=> esc_html__( 'In pixel like 1px', 'litho' ),
) );

/* End Widget Title Letter Spacing */

/* Widget Title Text Transform */

$wp_customize->add_setting( 'litho_post_widget_title_text_transform', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_widget_title_text_transform', array(
	'label'				=> esc_html__( 'Text case', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_title_text_transform',
	'type'              => 'select',
	'choices'           => array(
								''			=> esc_html__( 'Select', 'litho' ),
								'uppercase' => esc_html__( 'Uppercase', 'litho' ),
								'lowercase'	=> esc_html__( 'Lowercase', 'litho' ),
								'capitalize'=> esc_html__( 'Capitalize', 'litho' ),
								'none'		=> esc_html__( 'None', 'litho' ),
						   ),
) ) );

/* End Widget Title Text Transform */

/* Widget Title weight setting */

$wp_customize->add_setting( 'litho_post_widget_title_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_widget_title_font_weight', array(
	'label'				=> esc_html__( 'Font weight', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_title_font_weight',
	'type'              => 'select',
	'choices'           => $litho_font_weight, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
) ) );

/* End Widget Title Font weight setting */

/* Widget Title Color setting*/

$wp_customize->add_setting( 'litho_post_widget_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_widget_title_color', array(
	'label'				=> esc_html__( 'Color', 'litho' ),
	'section'     		=> 'litho_add_post_sidebar_section',
	'settings'			=> 'litho_post_widget_title_color',
) ) );

/* End Widget Title Color setting */
