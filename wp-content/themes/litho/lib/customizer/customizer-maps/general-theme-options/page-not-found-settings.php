<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_page_not_found_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_page_not_found_separator', array(
	'label'      		=> esc_html__( '404 page', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_404_page_panel',
	'settings'   		=> 'litho_page_not_found_separator',
	'priority'	 		=> 7, 
) ) );

/* End Separator Settings */


/* Page Not Found Image */

$wp_customize->add_setting( 'litho_page_not_found_image', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'litho_page_not_found_image', array(
	'label'       		=> esc_html__( 'Background image', 'litho' ),
	'description'		=> esc_html__( 'Recommended image size is 1920px X 1200px.', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_image',
	'priority'	 		=> 7,
) ) );

/* End Page Not Found Image */

/* Page Main Title */

$wp_customize->add_setting( 'litho_page_not_found_main_title', array(
	'default' 			=> esc_html__( 'OOOPS!', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_not_found_main_title', array(
	'label'       		=> esc_html__( 'Main title', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_main_title',
	'type'              => 'text',
	'priority'	 		=> 7,
) ) );

/* End Page Not Found Title */

/* Page Not Found Title */

$wp_customize->add_setting( 'litho_page_not_found_title', array(
	'default' 			=> esc_html__( '404', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_not_found_title', array(
	'label'       		=> esc_html__( 'Title', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_title',
	'type'              => 'text',
	'priority'	 		=> 7,
	
) ) );

/* End Page Not Found Title */

/* Page Not Found Subtitle */

$wp_customize->add_setting( 'litho_page_not_found_subtitle', array(
	'default' 			=> esc_html__( 'This page could not be found!', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_not_found_subtitle', array(
	'label'       		=> esc_html__( 'Subtitle', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_subtitle',
	'type'              => 'text',
	'priority'	 		=> 7,
	
) ) );

/* Page Not Found Subtitle */

/* Page Not Found Hide Button */

$wp_customize->add_setting( 'litho_page_not_found_button', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_page_not_found_button', array(
	'label'       		=> esc_html__( 'BACK TO HOMEPAGE', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_button',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'priority'	 		=> 7,
) ) );

/* End Page Not Found Hide Button */

/* Page Not Found Button Text */

$wp_customize->add_setting( 'litho_page_not_found_button_text', array(
	'default' 			=> esc_html__( 'BACK TO HOME PAGE', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_not_found_button_text', array(
	'label'       		=> esc_html__( 'Button text', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_button_text',
	'type'              => 'text',
	'active_callback'   => 'litho_page_not_found_hide_button',
	'priority'	 		=> 7,
) ) );

/* End Page Not Found Button Text */

/* Page Not Found Button URL */

$wp_customize->add_setting( 'litho_page_not_found_button_url', array(
	'default' 			=> home_url( '/' ),
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_not_found_button_url', array(
	'label'       		=> esc_html__( 'Button URL', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_button_url',
	'type'              => 'text',
	'active_callback'   => 'litho_page_not_found_hide_button',
	'priority'	 		=> 7,
) ) );

/* End Page Not Found Button URL */

/* 404 Main Title color setting */

$wp_customize->add_setting( 'litho_404_main_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_404_main_title_color', array(
	'label'      		=> esc_html__( 'Main title color', 'litho' ),
	'section'    		=> 'litho_add_404_page_panel',
	'settings'	 		=> 'litho_404_main_title_color',
	'priority'	 		=> 7,
) ) );

/* End 404 Title color setting */

/* 404 Title color setting */

$wp_customize->add_setting( 'litho_404_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_404_title_color', array(
	'label'      		=> esc_html__( 'Title color', 'litho' ),
	'section'    		=> 'litho_add_404_page_panel',
	'settings'	 		=> 'litho_404_title_color',
	'priority'	 		=> 7,
) ) );

/* End 404 Title color setting */

/* 404 Subtitle color setting */

$wp_customize->add_setting( 'litho_404_subtitle_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_404_subtitle_color', array(
	'label'      		=> esc_html__( 'Subtitle color', 'litho' ),
	'section'    		=> 'litho_add_404_page_panel',
	'settings'	 		=> 'litho_404_subtitle_color',
	'priority'	 		=> 7,
) ) );

/* End 404 Subtitle color setting */

/* 404 button color setting */

$wp_customize->add_setting( 'litho_404_button_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_404_button_color', array(
	'label'      		=> esc_html__( 'Button color', 'litho' ),
	'section'    		=> 'litho_add_404_page_panel',
	'settings'	 		=> 'litho_404_button_color',
	'priority'	 		=> 7,
	'active_callback'   => 'litho_page_not_found_hide_button',
) ) );

/* End 404 button color setting */

/* 404 button hover color setting */

$wp_customize->add_setting( 'litho_404_button_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_404_button_hover_color', array(
	'label'      		=> esc_html__( 'Button hover color', 'litho' ),
	'section'    		=> 'litho_add_404_page_panel',
	'settings'	 		=> 'litho_404_button_hover_color',
	'priority'	 		=> 7,
	'active_callback'   => 'litho_page_not_found_hide_button',
) ) );

/* End 404 button hover color setting */

/* 404 button background color setting */

$wp_customize->add_setting( 'litho_404_button_background_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_404_button_background_color', array(
	'label'      		=> esc_html__( 'Button Background color', 'litho' ),
	'section'    		=> 'litho_add_404_page_panel',
	'settings'	 		=> 'litho_404_button_background_color',
	'priority'	 		=> 7,
	'active_callback'   => 'litho_page_not_found_hide_button',
) ) );

/* End 404 button background color setting */

	/* Custom Callback Functions */

	if ( ! function_exists( 'litho_page_not_found_hide_button' ) ) :
	function litho_page_not_found_hide_button( $control ) {
		if ( $control->manager->get_setting( 'litho_page_not_found_button' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}  
	}
endif;

/* End Custom Callback Functions */

/* 404 Add Top Space setting */

$wp_customize->add_setting( 'litho_page_not_found_top_space', array(
	'default' 			=> 'no',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_not_found_top_space', array(
	'label'				=> esc_html__( 'Add top space of header height', 'litho' ),
	'section'     		=> 'litho_add_404_page_panel',
	'settings'			=> 'litho_page_not_found_top_space',
	'type'              => 'select',
	'choices'           => array(
								'yes'	=> esc_html__( 'Yes', 'litho' ),
								'no' 	=> esc_html__( 'No', 'litho' ),
							   ),
) ) );

/* End 404 Add Top Space setting */
