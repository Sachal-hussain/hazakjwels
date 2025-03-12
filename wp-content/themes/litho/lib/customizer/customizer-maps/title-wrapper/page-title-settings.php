<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Section Builder Admin URL */
$litho_secion_builder_url =	sprintf(
	'<a target="_blank" href="%s">%s </a> %s',
	esc_url( get_admin_url().'edit.php?post_type=sectionbuilder&template_type=custom-title' ),
	esc_html__( 'Click here', 'litho' ),
	esc_html__( 'to create / manage title in the section builder.', 'litho' )
);

/* Get all register custom title section list. */
$litho_custom_title_section_data 			= litho_get_builder_section_data( 'custom-title' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
$litho_general_custom_title_section_data 	= litho_get_builder_section_data( 'custom-title', false, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/*============================================*/
/* For General */
/*============================================*/

/* Separator Page Title General Settings */
$wp_customize->add_setting( 'litho_general_custom_title_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_general_custom_title_separator', array(
	'label'      		=> esc_html__( 'General', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_page_title_section',
	'settings'   		=> 'litho_general_custom_title_separator',
) ) );
/* End Separator Page Title General Settings */

/* Enable Page Title */
$wp_customize->add_setting( 'litho_enable_custom_title', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title', array(
	'label'       		=> esc_html__( 'Title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title',
	'type'              => 'litho_switch',
	'choices'           => array(
							'1' => esc_html__( 'On', 'litho' ),
							'0' => esc_html__( 'Off', 'litho' ),
	   ),
) ) );

/* End Enable Page Title */

/* Page Title Section */
$wp_customize->add_setting( 'litho_custom_title_section', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section', array(
	'label'       		=> esc_html__( 'Title section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_custom_title_section',
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'choices'           => $litho_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
) ) );

/* End Page Title Section */

/*============================================*/
/* For Page */
/*============================================*/

/* Page Page Title Separator Settings */
$wp_customize->add_setting( 'litho_page_custom_title_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_page_custom_title_separator', array(
	'label'     		=> esc_html__( 'Page', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_page_title_section',
	'settings'   		=> 'litho_page_custom_title_separator',
) ) );

/* End Page Page Title Separator Settings */

/* Page Enable General Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_general_single_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_single_page', array(
	'label'     		=> esc_html__( 'General title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_general_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Page Enable General Page Title */

/* Page Enable Page Title */
$wp_customize->add_setting( 'litho_enable_custom_title_single_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_single_page', array(
	'label'     		=> esc_html__( 'Page Title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_page_custom_title_enable_callback',
) ) );

/* End Page Enable Page Title */

/* Page Page Title Section */

$wp_customize->add_setting( 'litho_custom_title_section_single_page', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_single_page', array(
	'label'     		=> esc_html__( 'Page Title section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_custom_title_section_single_page',
	'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_page_custom_title_enable_callback',
) ) );

/* End Page Page Title Section */

// Page Title enable callback
if ( ! function_exists( 'litho_page_custom_title_enable_callback' ) ) {
	function litho_page_custom_title_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_custom_title_general_single_page' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Post */
/*============================================*/

/* Separator Settings */

$wp_customize->add_setting( 'litho_post_single_custom_title_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_single_custom_title_separator', array(
	'label'     		=> esc_html__( 'Post Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_page_title_section',
	'settings'   		=> 'litho_post_single_custom_title_separator',
) ) );

/* End Separator Settings */

/* Single Post Enable General Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_general_single_post', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_single_post', array(
	'label'     		=> esc_html__( 'General title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_general_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Single Post Enable General Page Title */

/* Post Single Enable Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_single_post', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_single_post', array(
	'label'     		=> esc_html__( 'Page Title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_single_custom_title_enable_callback',
) ) );

/* End Post Single Enable Page Title */

/* Post Single Page Title Section */

$wp_customize->add_setting( 'litho_custom_title_section_single_post', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_single_post', array(
	'label'     		=> esc_html__( 'Page Title section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_custom_title_section_single_post',
	'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_single_custom_title_enable_callback',
) ) );

/* End Post Single Page Title Section */

// Page Title enable callback
if ( ! function_exists( 'litho_post_single_custom_title_enable_callback' ) ) {
	function litho_post_single_custom_title_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_custom_title_general_single_post' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* Separator Settings */

$wp_customize->add_setting( 'litho_post_archive_custom_title_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_archive_custom_title_separator', array(
	'label'     		=> esc_html__( 'Post Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_page_title_section',
	'settings'   		=> 'litho_post_archive_custom_title_separator',
) ) );

/* End Separator Settings */

/* Post Archive Enable General Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_general_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_archive', array(
	'label'     		=> esc_html__( 'General title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_general_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Post Archive Enable General Page Title */

/* Post Archive Enable Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_archive', array(
	'label'     		=> esc_html__( 'Page Title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_archive_custom_title_enable_callback',
) ) );

/* End Post Archive Enable Page Title */

/* Post Archive Page Title Section */

$wp_customize->add_setting( 'litho_custom_title_section_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_archive', array(
	'label'     		=> esc_html__( 'Page Title section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_custom_title_section_archive',
	'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_archive_custom_title_enable_callback',
) ) );

/* End Post Archive Page Title Section */

// Page Title enable callback
if ( ! function_exists( 'litho_post_archive_custom_title_enable_callback' ) ) {
	function litho_post_archive_custom_title_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_custom_title_general_archive' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* Separator Settings */

$wp_customize->add_setting( 'litho_post_default_custom_title_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_default_custom_title_separator', array(
	'label'     		=> esc_html__( 'Default Posts / Blog Home', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_page_title_section',
	'settings'   		=> 'litho_post_default_custom_title_separator',
) ) );

/* End Separator Settings */

/* Post Default Enable General Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_general_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_default', array(
	'label'     		=> esc_html__( 'General title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_general_default',
	'type'              => 'litho_switch',
	'choices'           => 	array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Post Default Enable General Page Title */

/* Post Default Enable Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_default', array(
	'label'     		=> 	__( 'Page Title', 'litho' ),
	'section'     		=> 	'litho_add_page_title_section',
	'settings'			=> 	'litho_enable_custom_title_default',
	'type'              => 	'litho_switch',
	'choices'           => 	array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback' 	=> 'litho_post_default_custom_title_enable_callback',
) ) );

/* End Post Default Enable Page Title */

/* Post Default Page Title Section */

$wp_customize->add_setting( 'litho_custom_title_section_default', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_default', array(
	'label'     		=> esc_html__( 'Page Title section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_custom_title_section_default',
	'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_default_custom_title_enable_callback',
) ) );

/* End Post Default Page Title Section */

// Page Title enable callback
if ( ! function_exists( 'litho_post_default_custom_title_enable_callback' ) ) {
	function litho_post_default_custom_title_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_custom_title_general_default' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Portfolio */
/*============================================*/

/* Separator Settings */

$wp_customize->add_setting( 'litho_portfolio_single_custom_title_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_single_custom_title_separator', array(
	'label'     		=> esc_html__( 'Portfolio Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_page_title_section',
	'settings'   		=> 'litho_portfolio_single_custom_title_separator',
) ) );

/* End Separator Settings */

/* Single Portfolio Enable General Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_general_single_portfolio', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_single_portfolio', array(
	'label'     		=> esc_html__( 'General title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_general_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Single Portfolio Enable General Page Title */

/* Portfolio Single Enable Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_single_portfolio', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_single_portfolio', array(
	'label'     		=> esc_html__( 'Page Title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_portfolio_single_custom_title_enable_callback',
) ) );

/* End Portfolio Single Enable Page Title */

/* Portfolio Single Page Title Section */

$wp_customize->add_setting( 'litho_custom_title_section_single_portfolio', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_single_portfolio', array(
	'label'     		=> esc_html__( 'Page Title section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_custom_title_section_single_portfolio',
	'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_portfolio_single_custom_title_enable_callback',
) ) );

/* End Portfolio Single Page Title Section */

// Page Title enable callback
if ( ! function_exists( 'litho_portfolio_single_custom_title_enable_callback' ) ) {
	function litho_portfolio_single_custom_title_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_custom_title_general_single_portfolio' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* Separator Settings */

$wp_customize->add_setting( 'litho_portfolio_archive_custom_title_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_archive_custom_title_separator', array(
	'label'     		=> esc_html__( 'Portfolio Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_page_title_section',
	'settings'   		=> 'litho_portfolio_archive_custom_title_separator',
) ) );

/* End Separator Settings */

/* Portfolio Archive Enable General Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_general_portfolio_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_portfolio_archive', array(
	'label'     		=> esc_html__( 'General title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_general_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Portfolio Archive Enable General Page Title */

/* Portfolio Archive Enable Page Title */

$wp_customize->add_setting( 'litho_enable_custom_title_portfolio_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_portfolio_archive', array(
	'label'     		=> esc_html__( 'Page Title', 'litho' ),
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_enable_custom_title_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_portfolio_archive_custom_title_enable_callback',
) ) );

/* End Portfolio Archive Enable Page Title */

/* Portfolio Archive Page Title Section */

$wp_customize->add_setting( 'litho_custom_title_section_portfolio_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_portfolio_archive', array(
	'label'     		=> esc_html__( 'Page Title section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_page_title_section',
	'settings'			=> 'litho_custom_title_section_portfolio_archive',
	'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_portfolio_archive_custom_title_enable_callback',
) ) );

/* End Portfolio Archive Page Title Section */

// Page Title enable callback
if ( ! function_exists( 'litho_portfolio_archive_custom_title_enable_callback' ) ) {
	function litho_portfolio_archive_custom_title_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_custom_title_general_portfolio_archive' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}


/*============================================*/
/* For Product */
/*============================================*/

if ( is_woocommerce_activated() ) {
	/* Separator Settings */

	$wp_customize->add_setting( 'litho_product_single_custom_title_separator', array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_single_custom_title_separator', array(
		'label'     		=> esc_html__( 'Product Single', 'litho' ),
		'type'              => 'litho_separator',
		'section'    		=> 'litho_add_page_title_section',
		'settings'   		=> 'litho_product_single_custom_title_separator',
	) ) );

	/* End Separator Settings */

	/* Single Product Enable General Page Title */

	$wp_customize->add_setting( 'litho_enable_custom_title_general_single_product', array(
		'default' 			=> '1',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_single_product', array(
		'label'     		=> esc_html__( 'General title', 'litho' ),
		'section'     		=> 'litho_add_page_title_section',
		'settings'			=> 'litho_enable_custom_title_general_single_product',
		'type'              => 'litho_switch',
		'choices'           => array(
									'1' => esc_html__( 'On', 'litho' ),
									'0' => esc_html__( 'Off', 'litho' ),
								),
	) ) );

	/* End Single Product Enable General Page Title */

	/* Product Single Enable Page Title */

	$wp_customize->add_setting( 'litho_enable_custom_title_single_product', array(
		'default' 			=> '1',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_single_product', array(
		'label'     		=> esc_html__( 'Page Title', 'litho' ),
		'section'     		=> 'litho_add_page_title_section',
		'settings'			=> 'litho_enable_custom_title_single_product',
		'type'              => 'litho_switch',
		'choices'           => array(
									'1' => esc_html__( 'On', 'litho' ),
									'0' => esc_html__( 'Off', 'litho' ),
							   ),
		'active_callback' 	=> 'litho_product_single_custom_title_enable_callback',
	) ) );

	/* End Product Single Enable Page Title */

	/* Product Single Page Title Section */

	$wp_customize->add_setting( 'litho_custom_title_section_single_product', array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_single_product', array(
		'label'     		=> esc_html__( 'Page Title section', 'litho' ),
		'type'              => 'select',
		'section'     		=> 'litho_add_page_title_section',
		'settings'			=> 'litho_custom_title_section_single_product',
		'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'active_callback' 	=> 'litho_product_single_custom_title_enable_callback',
	) ) );

	/* End Product Single Page Title Section */

	// Page Title enable callback
	if ( ! function_exists( 'litho_product_single_custom_title_enable_callback' ) ) {
		function litho_product_single_custom_title_enable_callback( $control ) {
			if ( $control->manager->get_setting( 'litho_enable_custom_title_general_single_product' )->value() != '1' ) {
				return true;
			} else {
				return false;
			}
		}
	}

	/* Separator Settings */

	$wp_customize->add_setting( 'litho_product_archive_custom_title_separator', array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_custom_title_separator', array(
		'label'     		=> esc_html__( 'Product Archive / Shop', 'litho' ),
		'type'              => 'litho_separator',
		'section'    		=> 'litho_add_page_title_section',
		'settings'   		=> 'litho_product_archive_custom_title_separator',
	) ) );

	/* End Separator Settings */

	/* Product Archive Enable General Page Title */

	$wp_customize->add_setting( 'litho_enable_custom_title_general_product_archive', array(
		'default' 			=> '1',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_general_product_archive', array(
		'label'     		=> esc_html__( 'General title', 'litho' ),
		'section'     		=> 'litho_add_page_title_section',
		'settings'			=> 'litho_enable_custom_title_general_product_archive',
		'type'              => 'litho_switch',
		'choices'           => array(
									'1' => esc_html__( 'On', 'litho' ),
									'0' => esc_html__( 'Off', 'litho' ),
							   ),
	) ) );

	/* End Product Archive Enable General Page Title */

	/* Product Archive Enable Page Title */

	$wp_customize->add_setting( 'litho_enable_custom_title_product_archive', array(
		'default' 			=> '1',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_custom_title_product_archive', array(
		'label'     		=> esc_html__( 'Page Title', 'litho' ),
		'section'     		=> 'litho_add_page_title_section',
		'settings'			=> 'litho_enable_custom_title_product_archive',
		'type'              => 'litho_switch',
		'choices'           => array(
									'1' => esc_html__( 'On', 'litho' ),
									'0' => esc_html__( 'Off', 'litho' ),
							   ),
		'active_callback' 	=> 'litho_product_archive_custom_title_enable_callback',
	) ) );

	/* End Product Archive Enable Page Title */

	/* Product Archive Page Title Section */

	$wp_customize->add_setting( 'litho_custom_title_section_product_archive', array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_custom_title_section_product_archive', array(
		'label'     		=> esc_html__( 'Page Title section', 'litho' ),
		'type'              => 'select',
		'section'     		=> 'litho_add_page_title_section',
		'settings'			=> 'litho_custom_title_section_product_archive',
		'choices'           => $litho_general_custom_title_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'active_callback' 	=> 'litho_product_archive_custom_title_enable_callback',
	) ) );

	/* End Product Archive Page Title Section */

	// Page Title enable callback
	if ( ! function_exists( 'litho_product_archive_custom_title_enable_callback' ) ) {
		function litho_product_archive_custom_title_enable_callback( $control ) {
			if ( $control->manager->get_setting( 'litho_enable_custom_title_general_product_archive' )->value() != '1' ) {
				return true;
			} else {
				return false;
			}
		}
	}
}
