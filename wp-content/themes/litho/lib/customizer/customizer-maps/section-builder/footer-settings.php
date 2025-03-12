<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Section Builder Admin URL */
$litho_secion_builder_url =	sprintf(
	'<a target="_blank" href="%s">%s </a> %s',
	esc_url( get_admin_url().'edit.php?post_type=sectionbuilder&template_type=footer' ),
	esc_html__( 'Click here', 'litho' ),
	esc_html__( 'to create / manage footer in the section builder.', 'litho' )
);

/* Get All Register footer Section List. */
$litho_footer_section_data         = litho_get_builder_section_data( 'footer' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
$litho_general_footer_section_data = litho_get_builder_section_data( 'footer', false, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped


/*============================================*/
/* For General */
/*============================================*/

/* Separator Footer General Settings */
$wp_customize->add_setting( 'litho_general_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_general_footer_separator', array(
	'label'      		=> esc_html__( 'General', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_general_footer_separator',
) ) );
/* End Separator Footer General Settings */

/* Enable Footer */
$wp_customize->add_setting( 'litho_enable_footer', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer', array(
	'label'       		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
	   ),
) ) );

/* End Enable Footer */

/* Footer Section */
$wp_customize->add_setting( 'litho_footer_section', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section', array(
	'label'       		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section',
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'choices'           => $litho_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
) ) );

/* End Footer Section */

/*============================================*/
/* For Page */
/*============================================*/

/* Page Footer Separator Settings */
$wp_customize->add_setting( 'litho_page_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_page_footer_separator', array(
	'label'     		=> esc_html__( 'Page', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_page_footer_separator',
) ) );

/* End Page Footer Separator Settings */

/* Page Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_single_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_single_page', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Page Enable General Footer */

/* Page Enable Footer */
$wp_customize->add_setting( 'litho_enable_footer_single_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_single_page', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_single_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_page_footer_enable_callback',
) ) );

/* End Page Enable Footer */

/* Page Footer Section */

$wp_customize->add_setting( 'litho_footer_section_single_page', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_single_page', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_single_page',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_page_footer_enable_callback',
) ) );

/* End Page Footer Section */

// Footer enable callback
if ( ! function_exists( 'litho_page_footer_enable_callback' ) ) {
	function litho_page_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_single_page' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For 404 Page */
/*============================================*/

/* 404 Page Footer Separator Settings */
$wp_customize->add_setting( 'litho_404_page_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_404_page_footer_separator', array(
	'label'     		=> esc_html__( '404 Page', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_404_page_footer_separator',
) ) );

/* End 404 Page Footer Separator Settings */

/* 404 Page Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_404_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_404_page', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_404_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End 404 Page Enable General Footer */

/* 404 Page Enable Footer */
$wp_customize->add_setting( 'litho_enable_footer_404_page', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_404_page', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_404_page',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_404_page_footer_enable_callback',
) ) );

/* End 404 Page Enable Footer */

/* 404 Page Footer Section */

$wp_customize->add_setting( 'litho_footer_section_404_page', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_404_page', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_404_page',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_404_page_footer_enable_callback',
) ) );

/* End 404 Page Footer Section */

// Footer enable callback
if ( ! function_exists( 'litho_404_page_footer_enable_callback' ) ) {
	function litho_404_page_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_404_page' )->value() != '1' ) {
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

$wp_customize->add_setting( 'litho_post_single_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_single_footer_separator', array(
	'label'     		=> esc_html__( 'Post Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_post_single_footer_separator',
) ) );

/* End Separator Settings */

/* Single Post Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_single_post', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_single_post', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Post Enable General Footer */

/* Post Single Enable Footer */

$wp_customize->add_setting( 'litho_enable_footer_single_post', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_single_post', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_single_post',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_single_footer_enable_callback',
) ) );

/* End Post Single Enable Footer */

/* Post Single Footer Section */

$wp_customize->add_setting( 'litho_footer_section_single_post', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_single_post', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_single_post',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_single_footer_enable_callback',
) ) );

/* End Post Single Footer Section */

// Footer enable callback
if ( ! function_exists( 'litho_post_single_footer_enable_callback' ) ) {
	function litho_post_single_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_single_post' )->value() != '1' ) {
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

$wp_customize->add_setting( 'litho_post_archive_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_archive_footer_separator', array(
	'label'     		=> esc_html__( 'Post Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_post_archive_footer_separator',
) ) );

/* End Separator Settings */

/* Post Archive Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_archive', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Post Archive Enable General Footer */

/* Post Archive Enable Footer */

$wp_customize->add_setting( 'litho_enable_footer_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_archive', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_archive_footer_enable_callback',
) ) );

/* End Post Archive Enable Footer */

/* Post Archive Footer Section */

$wp_customize->add_setting( 'litho_footer_section_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_archive', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_archive',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_archive_footer_enable_callback',
) ) );

/* End Post Archive Footer Section */

// Footer enable callback
if ( ! function_exists( 'litho_post_archive_footer_enable_callback' ) ) {
	function litho_post_archive_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_archive' )->value() != '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/*============================================*/
/* For Post Default / Blog */
/*============================================*/

/* Separator Settings */

$wp_customize->add_setting( 'litho_post_default_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_default_footer_separator', array(
	'label'     		=> esc_html__( 'Default Posts / Blog Home', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_post_default_footer_separator',
) ) );

/* End Separator Settings */

/* Post Default Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_default', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_default',
	'type'              => 'litho_switch',
	'choices'           => 	array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Post Default Enable General Footer */

/* Post Default Enable Footer */

$wp_customize->add_setting( 'litho_enable_footer_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_default', array(
	'label'     		=> 	__( 'Footer', 'litho' ),
	'section'     		=> 	'litho_add_footer_section',
	'settings'			=> 	'litho_enable_footer_default',
	'type'              => 	'litho_switch',
	'choices'           => 	array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback' 	=> 'litho_post_default_footer_enable_callback',
) ) );

/* End Post Default Enable Footer */

/* Post Default Footer Section */

$wp_customize->add_setting( 'litho_footer_section_default', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_default', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_default',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_default_footer_enable_callback',
) ) );

/* End Post Default Footer Section */

// Footer enable callback
if ( ! function_exists( 'litho_post_default_footer_enable_callback' ) ) {
	function litho_post_default_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_default' )->value() != '1' ) {
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

$wp_customize->add_setting( 'litho_single_portfolio_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_footer_separator', array(
	'label'     		=> esc_html__( 'Portfolio Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_single_portfolio_footer_separator',
) ) );

/* End Single Portfolio Separator Settings */

/* Single Portfolio Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_single_portfolio', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_single_portfolio', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Portfolio Enable General Footer */

/* Single Portfolio Enable Footer */

$wp_customize->add_setting( 'litho_enable_footer_single_portfolio', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_single_portfolio', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_single_portfolio_footer_enable_callback',
) ) );

/* End Single Portfolio Enable Footer */

/* Single Portfolio Footer Section */

$wp_customize->add_setting( 'litho_footer_section_single_portfolio', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_single_portfolio', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_single_portfolio',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_single_portfolio_footer_enable_callback',
) ) );

/* End Single Portfolio Footer Section */

// Single Portfolio Footer callback
if ( ! function_exists( 'litho_single_portfolio_footer_enable_callback' ) ) {
	function litho_single_portfolio_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_single_portfolio' )->value() == '0' ) {
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

$wp_customize->add_setting( 'litho_portfolio_archive_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_archive_footer_separator', array(
	'label'     		=> esc_html__( 'Portfolio Archive', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_portfolio_archive_footer_separator',
) ) );

/* End Portfolio Archive Separator Settings */

/* Portfolio Archive Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_portfolio_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_portfolio_archive', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Portfolio Archive Enable General Footer */

/* Portfolio Archive Enable Footer */

$wp_customize->add_setting( 'litho_enable_footer_portfolio_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_portfolio_archive', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_portfolio_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_portfolio_archive_footer_enable_callback',
) ) );

/* End Portfolio Archive Enable Footer */

/* Portfolio Archive Footer Section */

$wp_customize->add_setting( 'litho_footer_section_portfolio_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_portfolio_archive', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_portfolio_archive',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_portfolio_archive_footer_enable_callback',
) ) );

/* End Portfolio Archive Footer Section */

// Portfolio Archive Footer callback
if ( ! function_exists( 'litho_post_portfolio_archive_footer_enable_callback' ) ) {
	function litho_post_portfolio_archive_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_portfolio_archive' )->value() == '0' ) {
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

$wp_customize->add_setting( 'litho_single_product_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_footer_separator', array(
	'label'     		=> esc_html__( 'Product Single', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_single_product_footer_separator',
) ) );

/* End Single Product Separator Settings */

/* Single Product Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_single_product', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_single_product', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_single_product',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Single Product Enable General Footer */

/* Single Product Enable Footer */

$wp_customize->add_setting( 'litho_enable_footer_single_product', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_single_product', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_single_product',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_single_product_footer_enable_callback',
) ) );

/* End Single Product Enable Footer */

/* Single Product Footer Section */

$wp_customize->add_setting( 'litho_footer_section_single_product', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_single_product', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_single_product',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_single_product_footer_enable_callback',
) ) );

/* End Single Product Footer Section */

// Single Product Footer callback
if ( ! function_exists( 'litho_single_product_footer_enable_callback' ) ) {
	function litho_single_product_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_single_product' )->value() == '0' ) {
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

$wp_customize->add_setting( 'litho_product_archive_footer_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_footer_separator', array(
	'label'     		=> esc_html__( 'Product Archive / Shop', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_footer_section',
	'settings'   		=> 'litho_product_archive_footer_separator',
) ) );

/* End Product Archive Separator Settings */

/* Product Archive Enable General Footer */

$wp_customize->add_setting( 'litho_enable_footer_general_product_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_general_product_archive', array(
	'label'     		=> esc_html__( 'General footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_general_product_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Product Archive Enable General Footer */

/* Product Archive Enable Footer */

$wp_customize->add_setting( 'litho_enable_footer_product_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_footer_product_archive', array(
	'label'     		=> esc_html__( 'Footer', 'litho' ),
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_enable_footer_product_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback' 	=> 'litho_post_product_archive_footer_enable_callback',
) ) );

/* End Product Archive Enable Footer */

/* Product Archive Footer Section */

$wp_customize->add_setting( 'litho_footer_section_product_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_footer_section_product_archive', array(
	'label'     		=> esc_html__( 'Footer section', 'litho' ),
	'type'              => 'select',
	'section'     		=> 'litho_add_footer_section',
	'settings'			=> 'litho_footer_section_product_archive',
	'choices'           => $litho_general_footer_section_data, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'description'		=> $litho_secion_builder_url, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback' 	=> 'litho_post_product_archive_footer_enable_callback',
) ) );

/* End Product Archive Footer Section */

// Product Archive Footer callback
if ( ! function_exists( 'litho_post_product_archive_footer_enable_callback' ) ) {
	function litho_post_product_archive_footer_enable_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_footer_general_product_archive' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
}
