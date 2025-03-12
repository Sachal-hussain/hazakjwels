<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Section Builder Admin URL */
$litho_secion_builder_url =	sprintf(
	'<a target="_blank" href="%s">%s </a> %s',
	esc_url( get_admin_url().'edit.php?post_type=sectionbuilder&template_type=mini-header' ),
	esc_html__( 'Click here', 'litho' ),
	esc_html__( 'to create / manage mini header in the section builder.', 'litho' )
);
/* Get All Register Mini Header Section List. */
$litho_mini_header_section_data         = litho_get_builder_section_data( 'mini-header' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
$litho_general_mini_header_section_data = litho_get_builder_section_data( 'mini-header', false, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
$litho_mini_header_sticky_type          = litho_get_mini_header_sticky_type_by_key(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped


/*============================================*/
/* For Page */
/*============================================*/

/* Separator Settings */
$wp_customize->add_setting( 'litho_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_mini_header_separator', array(
	'label'     		=> esc_html__( 'General', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_mini_header_separator',
) ) );

/* End Separator Settings */

/* Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Mini Header */

/* Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section',
	'choices'           => $litho_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
) ) );

/* End Mini Header Section */

/* Page Separator Settings */

$wp_customize->add_setting( 'litho_page_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_page_mini_header_separator', array(
	'label'     		=> esc_html__( 'Page', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_page_mini_header_separator',
) ) );

/* End Page Separator Settings */

/* Page Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_single_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_single_page', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Page Enable General Mini Header */

	/* Page Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_single_page', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_single_page', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_page_mini_header_enable_callback',
) ) );

/* End Page Enable Mini Header */

/* Page Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_single_page', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_single_page', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_single_page',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_page_mini_header_enable_callback',
) ) );

/* End Page Mini Header Section */

// Page Mini header callback
if ( ! function_exists( 'litho_page_mini_header_enable_callback' ) ) {
	function litho_page_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_single_page' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Post */
/*============================================*/

/* Single Post Separator Settings */

$wp_customize->add_setting( 'litho_single_post_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_post_mini_header_separator', array(
	'label'     		=> esc_html__( 'Post Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_single_post_mini_header_separator',
) ) );

/* End Single Post Separator Settings */

/* Single Post Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_single_post', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_single_post', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Post Enable General Mini Header */

/* Single Post Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_single_post', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_single_post', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_single_post_mini_header_enable_callback',
) ) );

/* End Single Post Enable Mini Header */

/* Single Post Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_single_post', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_single_post', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_single_post',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_single_post_mini_header_enable_callback',
) ) );

/* End Single Post Mini Header Section */

// Single Post Mini header callback
if ( ! function_exists( 'litho_single_post_mini_header_enable_callback' ) ) {
	function litho_single_post_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_single_post' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* Post Archive Separator Settings */

$wp_customize->add_setting( 'litho_archive_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_archive_mini_header_separator', array(
	'label'     		=> esc_html__( 'Post Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_archive_mini_header_separator',
) ) );

/* End Post Archive Separator Settings */

/* Post Archive Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_archive', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Post Archive Enable General Mini Header */

/* Post Archive Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_archive', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_archive_mini_header_enable_callback',
) ) );

/* End Post Archive Enable Mini Header */

/* Post Archive Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_archive', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_archive',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_archive_mini_header_enable_callback',
) ) );

/* End Post Archive Mini Header Section */

// Post Archive Mini header callback
if ( ! function_exists( 'litho_post_archive_mini_header_enable_callback' ) ) {
	function litho_post_archive_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_archive' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* Post Default Separator Settings */

$wp_customize->add_setting( 'litho_default_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_default_mini_header_separator', array(
	'label'     		=> esc_html__( 'Default Posts / Blog Home', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_default_mini_header_separator',
) ) );

/* End Post Default Separator Settings */

/* Default Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_default', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_default',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Default Enable General Mini Header */

/* Post Default Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_default', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_default', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_default',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_default_mini_header_enable_callback',
) ) );

/* End Post Default Enable Mini Header */

/* Post Default Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_default', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_default', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_default',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_default_mini_header_enable_callback',
) ) );

/* End Post Default Mini Header Section */

// Post Default Mini header callback
if ( ! function_exists( 'litho_default_mini_header_enable_callback' ) ) {
	function litho_default_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_default' )->value() == '0' ) {
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

$wp_customize->add_setting( 'litho_single_portfolio_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_mini_header_separator', array(
	'label'     		=> esc_html__( 'Portfolio Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_single_portfolio_mini_header_separator',
) ) );

/* End Single Portfolio Separator Settings */

/* Single Portfolio Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_single_portfolio', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_single_portfolio', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Portfolio Enable General Mini Header */

/* Single Portfolio Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_single_portfolio', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_single_portfolio', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_single_portfolio_mini_header_enable_callback',
) ) );

/* End Single Portfolio Enable Mini Header */

/* Single Portfolio Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_single_portfolio', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_single_portfolio', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_single_portfolio',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_single_portfolio_mini_header_enable_callback',
) ) );

/* End Single Portfolio Mini Header Section */

// Single Portfolio Mini header callback
if ( ! function_exists( 'litho_single_portfolio_mini_header_enable_callback' ) ) {
	function litho_single_portfolio_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_single_portfolio' )->value() == '0' ) {
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

$wp_customize->add_setting( 'litho_portfolio_archive_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_archive_mini_header_separator', array(
	'label'     		=> esc_html__( 'Portfolio Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_portfolio_archive_mini_header_separator',
) ) );

/* End Portfolio Archive Separator Settings */

/* Portfolio Archive Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_portfolio_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_portfolio_archive', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Portfolio Archive Enable General Mini Header */

/* Portfolio Archive Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_portfolio_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_portfolio_archive', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_portfolio_archive_mini_header_enable_callback',
) ) );

/* End Portfolio Archive Enable Mini Header */

/* Portfolio Archive Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_portfolio_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_portfolio_archive', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_portfolio_archive',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_portfolio_archive_mini_header_enable_callback',
) ) );

/* End Portfolio Archive Mini Header Section */

// Portfolio Archive Mini header callback
if ( ! function_exists( 'litho_post_portfolio_archive_mini_header_enable_callback' ) ) {
	function litho_post_portfolio_archive_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_portfolio_archive' )->value() == '0' ) {
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

$wp_customize->add_setting( 'litho_single_product_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_mini_header_separator', array(
	'label'     		=> esc_html__( 'Product Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_single_product_mini_header_separator',
) ) );

/* End Single Product Separator Settings */

/* Single Product Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_single_product', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_single_product', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_single_product',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Product Enable General Mini Header */

/* Single Product Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_single_product', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_single_product', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_single_product',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_single_product_mini_header_enable_callback',
) ) );

/* End Single Product Enable Mini Header */

/* Single Product Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_single_product', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_single_product', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_single_product',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_single_product_mini_header_enable_callback',
) ) );

/* End Single Product Mini Header Section */

// Single Product Mini header callback
if ( ! function_exists( 'litho_single_product_mini_header_enable_callback' ) ) {
	function litho_single_product_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_single_product' )->value() == '0' ) {
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

$wp_customize->add_setting( 'litho_product_archive_mini_header_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_mini_header_separator', array(
	'label'     		=> esc_html__( 'Product Archive / Shop', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_mini_header_section',
	'settings'   		=> 'litho_product_archive_mini_header_separator',
) ) );

/* End Product Archive Separator Settings */

/* Product Archive Enable General Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_general_product_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_general_product_archive', array(
	'label'     		=> esc_html__( 'General mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_general_product_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Product Archive Enable General Mini Header */

/* Product Archive Enable Mini Header */

$wp_customize->add_setting( 'litho_enable_mini_header_product_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_mini_header_product_archive', array(
	'label'     		=> esc_html__( 'Mini header', 'litho' ),
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_enable_mini_header_product_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_product_archive_mini_header_enable_callback',
) ) );

/* End Product Archive Enable Mini Header */

/* Product Archive Mini Header Section */

$wp_customize->add_setting( 'litho_mini_header_section_product_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_mini_header_section_product_archive', array(
	'label'     		=> esc_html__( 'Mini header section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_mini_header_section',
	'settings'			=> 'litho_mini_header_section_product_archive',
	'choices'           => $litho_general_mini_header_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_product_archive_mini_header_enable_callback',
) ) );

/* End Product Archive Mini Header Section */

// Product Archive Mini header callback
if ( ! function_exists( 'litho_post_product_archive_mini_header_enable_callback' ) ) {
	function litho_post_product_archive_mini_header_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_mini_header_general_product_archive' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}
