<?php
/**
 * The template for header - section builder customizer settings
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
	esc_url( get_admin_url().'edit.php?post_type=sectionbuilder&template_type=header' ),
	esc_html__( 'Click here', 'litho' ),
	esc_html__( 'to create / manage header in the section builder.', 'litho' )
);

/* Get All Register Header Section List. */
$litho_header_section_data         = litho_get_builder_section_data( 'header' );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
$litho_general_header_section_data = litho_get_builder_section_data( 'header', false, true );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/*============================================*/
/* For General */
/*============================================*/

/* Separator Header General Settings */
$wp_customize->add_setting( 'litho_general_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_general_header_separator', array(
	'label'				=> esc_html__( 'General', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_header_section',
	'settings'			=> 'litho_general_header_separator',
) ) );
/* End Separator Header General Settings */

/* Enable Header */
$wp_customize->add_setting( 'litho_enable_header', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header', array(
	'label'				=> esc_html__( 'Header', 'litho' ),
	'section'			=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header',
	'type'				=> 'litho_switch',
	'choices'			=> array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
		),
) ) );

/* End Enable Header */

/* Header Section */
$wp_customize->add_setting( 'litho_header_section', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section', array(
	'label'       		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section',
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'choices'           => $litho_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
) ) );

/* End Header Section */

/*============================================*/
/* For Page */
/*============================================*/

/* Page Header Separator Settings */
$wp_customize->add_setting( 'litho_page_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_page_header_separator', array(
	'label'     		=> esc_html__( 'Page', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_page_header_separator',
) ) );

/* End Page Header Separator Settings */

/* Page Enable General Header */

$wp_customize->add_setting( 'litho_enable_header_general_single_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_single_page', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Page Enable General Header */

/* Page Enable Header */
$wp_customize->add_setting( 'litho_enable_header_single_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_single_page', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_page_header_enable_callback',
) ) );

/* End Page Enable Header */

/* Page Header Section */
$wp_customize->add_setting( 'litho_header_section_single_page', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_single_page', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_single_page',
	'choices'           => $litho_general_header_section_data,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_page_header_enable_callback',
) ) );

/* End Page Header Section */

// Header enable callback
if ( ! function_exists( 'litho_page_header_enable_callback' ) ) {
	function litho_page_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_single_page' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For 404 Page */
/*============================================*/

/* 404 Page Header Separator Settings */
$wp_customize->add_setting( 'litho_404_page_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_404_page_header_separator', array(
	'label'     		=> esc_html__( '404 Page', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_404_page_header_separator',
) ) );

/* End 404 Page Header Separator Settings */

/* 404 Page Enable General Header */

$wp_customize->add_setting( 'litho_enable_header_general_404_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_404_page', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_404_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End 404 Page Enable General Header */

/* 404 Page Enable Header */
$wp_customize->add_setting( 'litho_enable_header_404_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_404_page', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_404_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_404_page_header_enable_callback',
) ) );

/* End 404 Page Enable Header */

/* 404 Page Header Section */
$wp_customize->add_setting( 'litho_header_section_404_page', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_404_page', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_404_page',
	'choices'           => $litho_general_header_section_data,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_404_page_header_enable_callback',
) ) );

/* End 404 Page Header Section */

// Header enable callback
if ( ! function_exists( 'litho_404_page_header_enable_callback' ) ) {
	function litho_404_page_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_404_page' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Post Single */
/*============================================*/

/* Separator Settings */
$wp_customize->add_setting( 'litho_post_single_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_single_header_separator', array(
	'label'     		=> esc_html__( 'Post Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_post_single_header_separator',
) ) );
/* End Separator Settings */

/* Single Post Enable General Header */
$wp_customize->add_setting( 'litho_enable_header_general_single_post', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_single_post', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );
/* End Single Post Enable General Header */

/* Post Single Enable Header */

$wp_customize->add_setting( 'litho_enable_header_single_post', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_single_post', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_single_header_enable_callback',
) ) );
/* End Post Single Enable Header */

/* Post Single Header Section */
$wp_customize->add_setting( 'litho_header_section_single_post', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_single_post', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_single_post',
	'choices'           => $litho_general_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_single_header_enable_callback',
) ) );
/* End Post Single Header Section */

// Header enable callback
if ( ! function_exists( 'litho_post_single_header_enable_callback' ) ) {
	function litho_post_single_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_single_post' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Post Archive */
/*============================================*/

/* Separator Settings */
$wp_customize->add_setting( 'litho_post_archive_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_archive_header_separator', array(
	'label'     		=> esc_html__( 'Post Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_post_archive_header_separator',
) ) );
/* End Separator Settings */

/* Post Archive Enable General Header */
$wp_customize->add_setting( 'litho_enable_header_general_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_archive', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Post Archive Enable General Header */

/* Post Archive Enable Header */
$wp_customize->add_setting( 'litho_enable_header_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_archive', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_archive_header_enable_callback',
) ) );
/* End Post Archive Enable Header */

/* Post Archive Header Section */
$wp_customize->add_setting( 'litho_header_section_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_archive', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_archive',
	'choices'           => $litho_general_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_archive_header_enable_callback',
) ) );
/* End Post Archive Header Section */

// Header enable callback
if ( ! function_exists( 'litho_post_archive_header_enable_callback' ) ) {
	function litho_post_archive_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_archive' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Post Default/ Blog */
/*============================================*/

/* Separator Settings */
$wp_customize->add_setting( 'litho_post_default_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_default_header_separator', array(
	'label'     		=> esc_html__( 'Default Posts / Blog Home', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_post_default_header_separator',
) ) );
/* End Separator Settings */

/* Post Default Enable General Header */
$wp_customize->add_setting( 'litho_enable_header_general_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_default', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_default',
	'type'              => 'litho_switch',
	'choices'           => 	array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );
/* End Post Default Enable General Header */

/* Post Default Enable Header */
$wp_customize->add_setting( 'litho_enable_header_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_default', array(
	'label'     		=> 	__( 'Header', 'litho' ),
	'section'     		=> 	'litho_add_header_section',
	'settings'			=> 	'litho_enable_header_default',
	'type'              => 	'litho_switch',
	'choices'           => 	array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback' 	=> 'litho_post_default_header_enable_callback',
) ) );

/* End Post Default Enable Header */

/* Post Default Header Section */
$wp_customize->add_setting( 'litho_header_section_default', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_default', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_default',
	'choices'           => $litho_general_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_default_header_enable_callback',
) ) );

/* End Post Default Header Section */

// Header enable callback
if ( ! function_exists( 'litho_post_default_header_enable_callback' ) ) {
	function litho_post_default_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_default' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}


/*============================================*/
/* For Portfolio Single */
/*============================================*/

/* Single Portfolio Separator Settings */

$wp_customize->add_setting( 'litho_single_portfolio_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_header_separator', array(
	'label'     		=> esc_html__( 'Portfolio Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_single_portfolio_header_separator',
) ) );

/* End Single Portfolio Separator Settings */

/* Single Portfolio Enable General Header */

$wp_customize->add_setting( 'litho_enable_header_general_single_portfolio', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_single_portfolio', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Portfolio Enable General Header */

/* Single Portfolio Enable Header */

$wp_customize->add_setting( 'litho_enable_header_single_portfolio', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_single_portfolio', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_single_portfolio_header_enable_callback',
) ) );

/* End Single Portfolio Enable Header */

/* Single Portfolio Header Section */

$wp_customize->add_setting( 'litho_header_section_single_portfolio', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_single_portfolio', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_single_portfolio',
	'choices'           => $litho_general_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_single_portfolio_header_enable_callback',
) ) );

/* End Single Portfolio Header Section */

// Single Portfolio Header callback
if ( ! function_exists( 'litho_single_portfolio_header_enable_callback' ) ) {
	function litho_single_portfolio_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_single_portfolio' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Portfolio Archive */
/*============================================*/

/* Portfolio Archive Separator Settings */

$wp_customize->add_setting( 'litho_portfolio_archive_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_archive_header_separator', array(
	'label'     		=> esc_html__( 'Portfolio Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_portfolio_archive_header_separator',
) ) );

/* End Portfolio Archive Separator Settings */

/* Portfolio Archive Enable General Header */

$wp_customize->add_setting( 'litho_enable_header_general_portfolio_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_portfolio_archive', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Portfolio Archive Enable General Header */

/* Portfolio Archive Enable Header */

$wp_customize->add_setting( 'litho_enable_header_portfolio_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_portfolio_archive', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_portfolio_archive_header_enable_callback',
) ) );

/* End Portfolio Archive Enable Header */

/* Portfolio Archive Header Section */

$wp_customize->add_setting( 'litho_header_section_portfolio_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_portfolio_archive', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_portfolio_archive',
	'choices'           => $litho_general_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_portfolio_archive_header_enable_callback',
) ) );

/* End Portfolio Archive Header Section */

// Portfolio Archive Header callback
if ( ! function_exists( 'litho_post_portfolio_archive_header_enable_callback' ) ) {
	function litho_post_portfolio_archive_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_portfolio_archive' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Product Single */
/*============================================*/

/* Single Product Separator Settings */

$wp_customize->add_setting( 'litho_single_product_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_header_separator', array(
	'label'     		=> esc_html__( 'Product Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_single_product_header_separator',
) ) );

/* End Single Product Separator Settings */

/* Single Product Enable General Header */

$wp_customize->add_setting( 'litho_enable_header_general_single_product', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_single_product', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_single_product',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Product Enable General Header */

/* Single Product Enable Header */

$wp_customize->add_setting( 'litho_enable_header_single_product', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_single_product', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_single_product',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_single_product_header_enable_callback',
) ) );

/* End Single Product Enable Header */

/* Single Product Header Section */

$wp_customize->add_setting( 'litho_header_section_single_product', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_single_product', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_single_product',
	'choices'           => $litho_general_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_single_product_header_enable_callback',
) ) );

/* End Single Product Header Section */

// Single Product Header callback
if ( ! function_exists( 'litho_single_product_header_enable_callback' ) ) {
	function litho_single_product_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_single_product' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Product Archive */
/*============================================*/

/* Product Archive Separator Settings */

$wp_customize->add_setting( 'litho_product_archive_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_header_separator', array(
	'label'     		=> esc_html__( 'Product Archive / Shop', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_header_section',
	'settings'   		=> 'litho_product_archive_header_separator',
) ) );

/* End Product Archive Separator Settings */

/* Product Archive Enable General Header */

$wp_customize->add_setting( 'litho_enable_header_general_product_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_general_product_archive', array(
	'label'     		=> esc_html__( 'General header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_general_product_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Product Archive Enable General Header */

/* Product Archive Enable Header */

$wp_customize->add_setting( 'litho_enable_header_product_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_header_product_archive', array(
	'label'     		=> esc_html__( 'Header', 'litho' ),
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_enable_header_product_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_product_archive_header_enable_callback',
) ) );

/* End Product Archive Enable Header */

/* Product Archive Header Section */

$wp_customize->add_setting( 'litho_header_section_product_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_header_section_product_archive', array(
	'label'     		=> esc_html__( 'Header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_header_section',
	'settings'			=> 'litho_header_section_product_archive',
	'choices'           => $litho_general_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_product_archive_header_enable_callback',
) ) );

/* End Product Archive Header Section */

// Product Archive Header callback
if ( ! function_exists( 'litho_post_product_archive_header_enable_callback' ) ) {
	function litho_post_product_archive_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_header_general_product_archive' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}
