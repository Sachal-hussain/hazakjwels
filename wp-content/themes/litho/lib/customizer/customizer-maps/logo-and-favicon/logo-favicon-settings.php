<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_general_header_logo_separator', array(
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_general_header_logo_separator', array(
	'label'				=> esc_html__( 'Logo', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_general_header_logo_separator',
) ) );

/* End Separator Settings */

/* Enable Logo */

$wp_customize->add_setting( 'litho_enable_header_logo', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_logo', array(
	'label'				=> esc_html__( 'Logo', 'litho' ),
	'section'			=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_enable_header_logo',
	'type'				=> 'litho_switch',
	'choices'			=>	array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Enable Header */

/* Logo */

$wp_customize->add_setting( 'litho_logo', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'litho_logo', array(
	'label'				=> esc_html__( 'Logo', 'litho' ),
	'description'		=> esc_html__( 'Upload the logo image which will be displayed in the website header.', 'litho' ),
	'section'     		=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_logo',
) ) );

/* End Logo */

/* Light Logo */

$wp_customize->add_setting( 'litho_logo_light', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'litho_logo_light', array(
	'label'				=> esc_html__( 'Sticky logo', 'litho' ),
	'description'		=> esc_html__( 'Upload the logo image which will be displayed in the scrolled / sticky header version.', 'litho' ),
	'section'			=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_logo_light',
) ) );

/* End Light Logo */

/* Logo Retina */

$wp_customize->add_setting( 'litho_logo_ratina', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'litho_logo_ratina', array(
	'label'				=> esc_html__( 'Retina logo', 'litho' ),
	'description'       => esc_html__( 'Upload the double size logo image which will be displayed in the website header of retina devices.', 'litho' ),
	'section'     		=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_logo_ratina',
) ) );

/* End Logo Ratina */

/* Light Logo Retina */

$wp_customize->add_setting( 'litho_logo_light_ratina', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'litho_logo_light_ratina', array(
	'label'				=> esc_html__( 'Sticky retina logo', 'litho' ),
	'description'		=> esc_html__( 'Upload the logo image which will be displayed in the scrolled / sticky header version of retina devices.', 'litho' ),
	'section'			=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_logo_light_ratina',
) ) );

/* End Light Logo Ratina */

/* SVG Width*/

$wp_customize->add_setting( 'litho_header_svg_width', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_svg_width', array(
	'label'				=> esc_html__( 'SVG width', 'litho' ),
	'section'			=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_header_svg_width',
	'type'				=> 'text',
	'description'		=> esc_html__( 'Add font size like 32px. Custom Image max width.', 'litho' ),
) ) );

/* SVG Width*/

/* Site Icon Separator Settings */

$wp_customize->add_setting( 'litho_favicon_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_favicon_separator', array(
	'label'				=> esc_html__( 'Site / Favicon icon', 'litho' ),
	'type'				=> 'litho_separator',
	'description'		=> esc_html__( 'This icon will be used as a browser favicon and app icon for your website. Icon must be square, and at least 512 pixels wide and tall.', 'litho' ),
	'section'			=> 'litho_add_logo_favicon_panel',
	'settings'			=> 'litho_favicon_separator',
) ) );

/* End Site Icon Separator Settings */
