<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get All Register Sidebar List.
$litho_sidebar_array = litho_register_sidebar_customizer_array(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/*
 * Page layout setting panel.
 */
/* Separator Settings */
$wp_customize->add_setting( 'litho_single_page_separator', array(
	'default'			=> '',
	'sanitize_callback'	=> 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_page_separator', array(
	'label'				=> esc_html__( 'Layout and Container', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_single_page_separator',
) ) );

/* End Separator Settings */

/* Page General Layout */

$wp_customize->add_setting( 'litho_page_layout_setting', array(
	'default' 			=> 'litho_layout_no_sidebar',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_page_layout_setting', array(
	'label'				=> esc_html__( 'Layout style', 'litho' ),
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_page_layout_setting',
	'type'				=> 'litho_preview_image',
	'choices'			=> array(
									'litho_layout_no_sidebar'	=> esc_html__( 'No sidebar', 'litho' ),
									'litho_layout_left_sidebar'	=> esc_html__( 'Left sidebar', 'litho' ),
									'litho_layout_right_sidebar'=> esc_html__( 'Right sidebar', 'litho' ),
									'litho_layout_both_sidebar'	=> esc_html__( 'Both sidebar', 'litho' ),
								),
	'litho_img'			=> array(
								LITHO_THEME_IMAGES_URI . '/1col.png',
								LITHO_THEME_IMAGES_URI . '/2cl.png',
								LITHO_THEME_IMAGES_URI . '/2cr.png',
								LITHO_THEME_IMAGES_URI . '/3cm.png',
							),
	'litho_columns'		=> '4',
) ) );

/* End Page General Layout */

/* Page Left Sidebar */

$wp_customize->add_setting( 'litho_page_left_sidebar', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_left_sidebar', array(
	'label'				=> esc_html__( 'Left sidebar', 'litho' ),
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_page_left_sidebar',
	'type'				=> 'select',
	'choices'			=> $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_page_left_sidebar_layout_callback',
) ) );

/* End Page Left Sidebar */

/* Page Right Sidebar */

$wp_customize->add_setting( 'litho_page_right_sidebar', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_right_sidebar', array(
	'label'				=> esc_html__( 'Right sidebar', 'litho' ),
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_page_right_sidebar',
	'type'				=> 'select',
	'choices'			=> $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_page_right_sidebar_layout_callback',
) ) );

/* End Page Right Sidebar */

/* Page Container Setting */

$wp_customize->add_setting( 'litho_page_container_style', array(
	'default' 			=> 'container',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_container_style', array(
	'label'				=> esc_html__( 'Container style', 'litho' ),
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_page_container_style',
	'type'				=> 'select',
	'choices'			=> array(
								'container'						=> esc_html__( 'Fixed', 'litho' ),
								'container-fluid' 				=> esc_html__( 'Full width', 'litho' ),
								'container-fluid-with-padding'	=> esc_html__( 'Full width ( with paddings )', 'litho' ),
							),
) ) );

/* End Page Container Setting */

/* Start Container custom Width setting */

$wp_customize->add_setting( 'litho_page_container_fluid_with_padding', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_page_container_fluid_with_padding', array(
	'label'				=> esc_html__( 'Full width padding', 'litho' ),
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_page_container_fluid_with_padding',
	'type'				=> 'text',
	'active_callback'	=> 'litho_page_container_fluid_with_padding_callback'
) ) );
/* End Container custom Width setting */

/* Start Within Content Area */

$wp_customize->add_setting( 'litho_page_within_content_area', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_page_within_content_area', array(
	'label'				=> esc_html__( 'Within content area', 'litho' ),
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_page_within_content_area',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Within Content Area */

if ( ! function_exists( 'litho_page_container_fluid_with_padding_callback' ) ) {
	function litho_page_container_fluid_with_padding_callback( $control ) {
	if ( $control->manager->get_setting( 'litho_page_container_style' )->value() == 'container-fluid-with-padding' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* End Container custom Width setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_page_comment_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_page_comment_separator', array(
	'label'				=> esc_html__( 'Comments', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_single_page_comment_separator',
) ) );

/* End Separator Settings */

/* Hide Comment */

$wp_customize->add_setting( 'litho_hide_page_comment', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_hide_page_comment', array(
	'label'				=> esc_html__( 'Comments', 'litho' ),
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_hide_page_comment',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'description'		=> esc_html__( '( If page comment is off in WordPress then it cannot be switched on here. )', 'litho' ),
) ) );

/* End Hide Comment */

/* Rich Snippet */

$wp_customize->add_setting( 'litho_page_rich_snippet', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_page_rich_snippet', array(
	'label'				=> esc_html__( 'Rich Snippet', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_page_layout_panel',
	'settings'			=> 'litho_page_rich_snippet',

	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Rich Snippet */

/* Custom Callback Functions */

if ( ! function_exists( 'litho_page_left_sidebar_layout_callback' ) ) {
	function litho_page_left_sidebar_layout_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_page_layout_setting' )->value() == 'litho_layout_left_sidebar' || $control->manager->get_setting( 'litho_page_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_page_right_sidebar_layout_callback' ) ) {
	function litho_page_right_sidebar_layout_callback( $control ) {
	if ( $control->manager->get_setting( 'litho_page_layout_setting' )->value() == 'litho_layout_right_sidebar' || $control->manager->get_setting( 'litho_page_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* End Custom Callback Functions */
