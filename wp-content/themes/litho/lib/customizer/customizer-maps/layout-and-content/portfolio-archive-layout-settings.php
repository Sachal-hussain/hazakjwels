<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get All Register Sidebar List.
$litho_sidebar_array = litho_register_sidebar_customizer_array(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
/*
 * Archive layout setting panel.
 */

/* Separator Settings */
$wp_customize->add_setting( 'litho_archive_portfolio_layout_container_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_archive_portfolio_layout_container_separator', array(
	'label'				=> esc_html__( 'Layout and Container', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_archive_portfolio_layout_container_separator',
) ) );

/* End Separator Settings */

/* Archive Layout For Post */
$wp_customize->add_setting( 'litho_portfolio_layout_setting_archive', array(
	'default' 			=> 'litho_layout_no_sidebar',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_portfolio_layout_setting_archive', array(
	'label'				=> esc_html__( 'Layout style', 'litho' ),
	'section'     		=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_layout_setting_archive',
	'type'              => 'litho_preview_image',
	'choices'           => array(
								'litho_layout_no_sidebar'    => esc_html__( 'No sidebar', 'litho' ),
								'litho_layout_left_sidebar'  => esc_html__( 'Left sidebar', 'litho' ),
								'litho_layout_right_sidebar' => esc_html__( 'Right sidebar', 'litho' ),
								'litho_layout_both_sidebar'  => esc_html__( 'Both sidebar', 'litho' ),
							),
	'litho_img'			=> array(
							LITHO_THEME_IMAGES_URI . '/1col.png',
							LITHO_THEME_IMAGES_URI . '/2cl.png',
							LITHO_THEME_IMAGES_URI . '/2cr.png',
							LITHO_THEME_IMAGES_URI . '/3cm.png',
						),
	'litho_columns'		=> '4',
) ) );

/* End Archive Layout For Post */

/* Archive Left Sidebar */

$wp_customize->add_setting( 'litho_portfolio_left_sidebar_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_left_sidebar_archive', array(
	'label'				=> esc_html__( 'Left sidebar', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_left_sidebar_archive',
	'type'				=> 'select',
	'choices'			=> $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_portfolio_left_sidebar_layout_archive_callback',
) ) );

if ( ! function_exists( 'litho_portfolio_left_sidebar_layout_archive_callback' ) ) :
	function litho_portfolio_left_sidebar_layout_archive_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_portfolio_layout_setting_archive' )->value() == 'litho_layout_left_sidebar' || $control->manager->get_setting( 'litho_portfolio_layout_setting_archive' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Archive Left Sidebar */

/* Archive Right Sidebar */
$wp_customize->add_setting( 'litho_portfolio_right_sidebar_archive', array(
	'default' 			=> 'sidebar-1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_right_sidebar_archive', array(
	'label'				=> esc_html__( 'Right sidebar', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_right_sidebar_archive',
	'type'				=> 'select',
	'choices'			=> $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_portfolio_right_sidebar_layout_archive_callback',
) ) );

if ( ! function_exists( 'litho_portfolio_right_sidebar_layout_archive_callback' ) ) :
	function litho_portfolio_right_sidebar_layout_archive_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_portfolio_layout_setting_archive' )->value() == 'litho_layout_right_sidebar' || $control->manager->get_setting( 'litho_portfolio_layout_setting_archive' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Archive Right Sidebar */

/* Archive Container Setting */

$wp_customize->add_setting( 'litho_portfolio_container_style_archive', array(
	'default' 			=> 'container',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_container_style_archive', array(
	'label'				=> esc_html__( 'Container style', 'litho' ),
	'section'     		=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_container_style_archive',
	'type'              => 'select',
	'choices'           => array(
				'container'						=> esc_html__( 'Fixed', 'litho' ),
				'container-fluid'				=> esc_html__( 'Full width', 'litho' ),
				'container-fluid-with-padding'	=> esc_html__( 'Full width ( with paddings )', 'litho' ),
		   ),	
) ) );

/* End Archive Container Setting */

/* Container custom Width setting */
$wp_customize->add_setting( 'litho_portfolio_container_fluid_with_padding_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_container_fluid_with_padding_archive', array(
	'label'				=> esc_html__( 'Full width padding', 'litho' ),
	'section'     		=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_container_fluid_with_padding_archive',
	'type'              => 'text',
	'active_callback'	=> 'litho_portfolio_container_fluid_with_padding_archive_callback'
) ) );

if ( ! function_exists( 'litho_portfolio_container_fluid_with_padding_archive_callback' ) ) :
	function litho_portfolio_container_fluid_with_padding_archive_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_portfolio_container_style_archive' )->value() == 'container-fluid-with-padding' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Container custom Width setting */

/* Archive Show Description Setting */

$wp_customize->add_setting( 'litho_show_portfolio_archive_description_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_show_portfolio_archive_description_archive', array(
	'label'       		=> esc_html__( 'Description', 'litho' ),
	'section'     		=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_show_portfolio_archive_description_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Archive Show Description Setting */

/* Main Section Top Space */

$wp_customize->add_setting( 'litho_portfolio_top_space_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_portfolio_top_space_archive', array(
	'label'				=> esc_html__( 'Add top space of header height', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_top_space_archive',
	'description'		=> esc_html__( 'Note: Setting will work while you have setup page without Elementor & Page title.', 'litho' ),		
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Main Section Top Space */

/* Separator Settings */
$wp_customize->add_setting( 'litho_portfolio_styles_separator_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_styles_separator_archive', array(
	'label'				=> esc_html__( 'Portfolio List Style And Data', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_styles_separator_archive',
) ) );

/* End Separator Settings */

/*  No. of Columns  */
$wp_customize->add_setting( 'litho_no_of_portfolios_columns_archive', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_no_of_portfolios_columns_archive', array(
	'label'				=> esc_html__( 'No. of columns', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_no_of_portfolios_columns_archive',
	'type'				=> 'litho_preview_image',
	'choices'			=> array(
								'2' => esc_html__( '2', 'litho' ),
								'3' => esc_html__( '3', 'litho' ),
								'4' => esc_html__( '4', 'litho' ),
								'5' => esc_html__( '5', 'litho' ),
								'6' => esc_html__( '6', 'litho' )
							),
	'litho_img'			=> array(
								LITHO_THEME_IMAGES_URI . '/2-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/3-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/4-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/5-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/6-columns.jpg',
							),
	'litho_columns'		=> '4',
) ) );
/* End No. of Columns */

/* Featured Image Size */

$wp_customize->add_setting( 'litho_portfolio_feature_image_size_archive', array(
	'default' 			=> 'full',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Image_SRCSET_Control( $wp_customize, 'litho_portfolio_feature_image_size_archive', array(
	'label'				=> esc_html__( 'Thumbnail size', 'litho' ),
	'type'				=> 'litho_image_srcset',
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_feature_image_size_archive',
) ) );

/* End Featured Image Size */

/* Portfolio Title */

$wp_customize->add_setting( 'litho_portfolio_enable_title_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_portfolio_enable_title_archive', array(
	'label'				=> esc_html__( 'Title', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_enable_title_archive',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Portfolio Title */

/* Portfolio Subtitle */

$wp_customize->add_setting( 'litho_portfolio_enable_subtitle_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_portfolio_enable_subtitle_archive', array(
	'label'				=> esc_html__( 'Subtitle', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_enable_subtitle_archive',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Portfolio Subtitle */

/* Portfolio link icon */

$wp_customize->add_setting( 'litho_portfolio_enable_link_icon_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_portfolio_enable_link_icon_archive', array(
	'label'				=> esc_html__( 'Post link icon', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_enable_link_icon_archive',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Portfolio link icon */

/* Pagination */

$wp_customize->add_setting( 'litho_portfolio_enable_pagination_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_portfolio_enable_pagination_archive', array(
	'label'				=> esc_html__( 'Pagination', 'litho' ),
	'section'			=> 'litho_add_portfolio_archive_layout_panel',
	'settings'			=> 'litho_portfolio_enable_pagination_archive',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* END Pagination */
