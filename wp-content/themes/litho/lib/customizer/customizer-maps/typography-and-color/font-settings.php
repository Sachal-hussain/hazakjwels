<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_font_list = litho_font_list(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/* Google Font Languages Separator Settings */
$wp_customize->add_setting( 'litho_main_font_languages_setting_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_main_font_languages_setting_separator', array(
	'label'             => esc_html__( 'Google Font Languages', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_general_font_family_section',
	'settings'          => 'litho_main_font_languages_setting_separator',
	'active_callback'   => 'litho_google_alt_main_font_callback'
) ) );
/* End Google Font Languages Separator Settings */

/* Google Font Languages Settings */
$wp_customize->add_setting( 'litho_main_font_subsets', array(
	'default'			=> array( 
								'cyrillic', 
								'cyrillic-ext',
								'greek',
								'greek-ext',
								'latin-ext',
								'vietnamese'
							),
	'sanitize_callback' => 'litho_sanitize_multiple_checkbox',
	'transport'			=> 'postMessage'
) );
 $wp_customize->add_control( new Litho_Customize_Checkbox_Multiple( $wp_customize, 'litho_main_font_subsets', array(
	'label'             => esc_html__( 'Font Languages', 'litho' ),
	'type'              => 'litho_checkbox_multiple',
	'section'           => 'litho_add_general_font_family_section',
	'settings'          => 'litho_main_font_subsets',
	'choices'           => array(
								'cyrillic'      => esc_html__( 'Cyrillic', 'litho' ),
								'cyrillic-ext'  => esc_html__( 'Cyrillic Extended', 'litho' ),
								'greek'         => esc_html__( 'Greek', 'litho' ),
								'greek-ext'     => esc_html__( 'Greek Extended', 'litho' ),
								'latin-ext'     => esc_html__( 'Latin Extended', 'litho' ),
								'vietnamese'    => esc_html__( 'Vietnamese', 'litho' ),
							),
	'active_callback'   => 'litho_google_alt_main_font_callback'
) ) );
/* Google Font Languages Settings */

/* Main Font Separator Settings */
$wp_customize->add_setting( 'litho_main_font_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_main_font_setting_separator', array(
	'label'      		=> esc_html__( 'Main / Body Font', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_general_font_family_section',
	'settings'   		=> 'litho_main_font_setting_separator',
	'description'	    => esc_html__('In this section you can overwrite theme default body and additional fonts with your desired Google fonts.', 'litho' ),
) ) );

/* End Main Font Separator Settings */

$wp_customize->add_setting( 'litho_enable_main_font', array(
	'default'           => '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_enable_main_font', array(
	'label'             => esc_html__( 'Main / Body Font', 'litho' ),
	'section'           => 'litho_add_general_font_family_section',
	'settings'          => 'litho_enable_main_font',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

$wp_customize->add_setting( 'litho_main_font', array(
	'default'			=> 'Roboto',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Select_Optgroup( $wp_customize, 'litho_main_font', array(
	'label'				=> esc_html__( 'Main / Body Font', 'litho' ),
	'section'			=> 'litho_add_general_font_family_section',
	'setting'			=> 'litho_main_font',
	'type'              => 'litho_select',
	'choices'           => $litho_font_list, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'   => 'litho_main_font_callback',
) ) );

$wp_customize->add_setting( 'litho_main_font_weight', array(
	'default'           => array( '100', '300', '400', '500', '700', '900' ),
	'sanitize_callback' => 'litho_sanitize_multiple_checkbox'
) );

$wp_customize->add_control( new Litho_Customize_Checkbox_Multiple( $wp_customize, 'litho_main_font_weight', array(
	'label'   			=> esc_html__( 'Font Weight', 'litho' ),
	'type'              => 'litho_checkbox_multiple',
	'section' 			=> 'litho_add_general_font_family_section',
	'settings'			=> 'litho_main_font_weight',
	'choices'           => array(
								'100' => esc_html__( '100', 'litho' ),
								'200' => esc_html__( '200', 'litho' ),
								'300' => esc_html__( '300', 'litho' ),
								'400' => esc_html__( '400', 'litho' ),
								'500' => esc_html__( '500', 'litho' ),
								'600' => esc_html__( '600', 'litho' ),
								'700' => esc_html__( '700', 'litho' ),
								'800' => esc_html__( '800', 'litho' ),
								'900' => esc_html__( '900', 'litho' )
							),
	'active_callback'  => 'litho_main_font_google_callback',
) ) );

/* Alt Font Separator Settings */
$wp_customize->add_setting( 'litho_alt_font_setting_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_alt_font_setting_separator', array(
	'label'      		=> esc_html__( 'Additional Font', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_general_font_family_section',
	'settings'   		=> 'litho_alt_font_setting_separator',
) ) );

/* End Alt Font Separator Settings */

$wp_customize->add_setting( 'litho_enable_alt_font', array(
	'default'           => '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_enable_alt_font', array(
	'label'             => esc_html__( 'Additional Font', 'litho' ),
	'section'           => 'litho_add_general_font_family_section',
	'settings'          => 'litho_enable_alt_font',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

$wp_customize->add_setting( 'litho_alt_font', array(
	'default'			=> 'Poppins',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Select_Optgroup( $wp_customize, 'litho_alt_font', array(
	'label'				=> esc_html__( 'Additional Font', 'litho' ),
	'section'			=> 'litho_add_general_font_family_section',
	'setting'			=> 'litho_alt_font',
	'type'              => 'litho_select',
	'choices'           => $litho_font_list, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'  => 'litho_alt_font_callback',
) ) );

$wp_customize->add_setting( 'litho_alt_font_weight', array(
	'default'           => array( '100', '200', '300', '400', '500', '600', '700', '800', '900' ),
	'sanitize_callback' => 'litho_sanitize_multiple_checkbox'
) );

$wp_customize->add_control( new Litho_Customize_Checkbox_Multiple( $wp_customize, 'litho_alt_font_weight', array(
	'label'   			=> esc_html__( 'Font Weight', 'litho' ),
	'type'              => 'litho_checkbox_multiple',
	'section' 			=> 'litho_add_general_font_family_section',
	'settings'			=> 'litho_alt_font_weight',
	'choices'           => array(
								'100' => esc_html__( '100', 'litho' ),
								'200' => esc_html__( '200', 'litho' ),
								'300' => esc_html__( '300', 'litho' ),
								'400' => esc_html__( '400', 'litho' ),
								'500' => esc_html__( '500', 'litho' ),
								'600' => esc_html__( '600', 'litho' ),
								'700' => esc_html__( '700', 'litho' ),
								'800' => esc_html__( '800', 'litho' ),
								'900' => esc_html__( '900', 'litho' )
							),
	'active_callback'  => 'litho_alt_font_google_callback',
) ) );

/* Main Font Display Separator Settings */
$wp_customize->add_setting( 'litho_main_font_display_separator', array(
	'default'           => '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_main_font_display_separator', array(
	'label'             => esc_html__( 'Google Font Display', 'litho' ),
	'type'              => 'litho_separator',
	'section'           => 'litho_add_general_font_family_section',
	'settings'          => 'litho_main_font_display_separator',
	'active_callback'   => 'litho_google_alt_main_font_callback'
) ) );

$wp_customize->add_setting( 'litho_main_font_display', array(
	'default'           => 'swap',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new Wp_Customize_Control( $wp_customize, 'litho_main_font_display', array(
	'label'             => esc_html__( 'Google Font Display', 'litho' ),
	'type'              => 'select',
	'section'           => 'litho_add_general_font_family_section',
	'settings'          => 'litho_main_font_display',
	'choices'           => array(
								''          => esc_html__( 'Select', 'litho' ),
								'auto'      => esc_html__( 'Auto', 'litho' ),
								'block'     => esc_html__( 'Block', 'litho' ),
								'swap'      => esc_html__( 'Swap', 'litho' ),
								'fallback'  => esc_html__( 'Fallback', 'litho' ),
								'optional'  => esc_html__( 'Optional', 'litho' ),
							),
	'active_callback'   => 'litho_google_alt_main_font_callback'
) ) );

if ( ! function_exists( 'litho_main_font_callback' ) ) {
	function litho_main_font_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_main_font' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_main_font_google_callback' ) ) {
	function litho_main_font_google_callback( $control ) {
		$font_list = litho_font_list();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$google_font_list = ! empty( $font_list['google'] ) ? $font_list['google'] : array();
		if ( $control->manager->get_setting( 'litho_enable_main_font' )->value() == '1' && array_key_exists( $control->manager->get_setting( 'litho_main_font' )->value(), $google_font_list ) ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_alt_font_callback' ) ) {
	function litho_alt_font_callback( $control ) {
			if ( $control->manager->get_setting( 'litho_enable_alt_font' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_alt_font_google_callback' ) ) {
	function litho_alt_font_google_callback( $control ) {
		$font_list = litho_font_list();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$google_font_list = ! empty( $font_list['google'] ) ? $font_list['google'] : array();

		if ( $control->manager->get_setting( 'litho_enable_alt_font' )->value() == '1' && array_key_exists( $control->manager->get_setting( 'litho_alt_font' )->value(), $google_font_list ) ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_google_alt_main_font_callback' ) ) :
	function litho_google_alt_main_font_callback( $control ) {
		$font_list = litho_font_list();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$google_font_list = ! empty( $font_list['google'] ) ? $font_list['google'] : array();

		if ( ( $control->manager->get_setting( 'litho_enable_alt_font' )->value() == '1' && array_key_exists( $control->manager->get_setting( 'litho_alt_font' )->value(), $google_font_list ) ) || ( $control->manager->get_setting( 'litho_enable_main_font' )->value() == '1' && array_key_exists( $control->manager->get_setting( 'litho_main_font' )->value(), $google_font_list ) ) ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* Separator Typography Adobe Font Settings */
$wp_customize->add_setting( 'litho_adobe_font_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_adobe_font_separator', array(
	'label'			=> esc_html__( 'Adobe Font', 'litho' ),
	'type'			=> 'litho_separator',
	'section'		=> 'litho_add_general_font_family_section',
	'settings'		=> 'litho_adobe_font_separator',
) ) );

/* End Separator Typography Adobe Font Settings */

/* Enable Adobe Font */
$wp_customize->add_setting( 'litho_enable_adobe_font', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_adobe_font', array(
	'label'       		=> esc_html__( 'Enable adobe font', 'litho' ),
	'section'     		=> 'litho_add_general_font_family_section',
	'settings'			=> 'litho_enable_adobe_font',
	'type'              => 'litho_switch',
	'choices'           => array(
			'1' => esc_html__( 'On', 'litho' ),
			'0' => esc_html__( 'Off', 'litho' ),
	   ),
) ) );

/* End Enable Adobe Font */

/* Adobe Font Id */
$wp_customize->add_setting( 'litho_adobe_font_id', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_adobe_font_id', array(
  'type' 				=> 'text',
  'section' 			=> 'litho_add_general_font_family_section', // Add a default or your own section
  'label' 				=> esc_html__( 'Adobe font typekit ID', 'litho' ),
  'active_callback' 	=> 'litho_enable_adobe_font_callback',
) );

/* End Adobe Font Id */

// Enable adobe font callback
if ( ! function_exists( 'litho_enable_adobe_font_callback' ) ) {
	function litho_enable_adobe_font_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_adobe_font' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( is_litho_addons_activated() ) {
	/* Separator Typography Custom Font Settings */
	$wp_customize->add_setting( 'litho_custom_font_separator', array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_custom_font_separator', array(
		'label'             => esc_html__( 'Custom Font', 'litho' ),
		'type'              => 'litho_separator',
		'section'           => 'litho_add_general_font_family_section',
		'settings'          => 'litho_custom_font_separator',
	) ) );

	/* End Separator Typography Custom Font Settings */

	/* Custom Font */
	$wp_customize->add_setting( 'litho_custom_fonts', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post'
	) );

	$wp_customize->add_control( new Litho_Custom_Font( $wp_customize, 'litho_custom_fonts', array(
		'label'             => esc_html__( 'Custom fonts', 'litho' ),
		'type'              => 'litho_custom_fonts',
		'section'           => 'litho_add_general_font_family_section',
		'settings'          => 'litho_custom_fonts',
	) ) );
	/* Custom Font */
}
