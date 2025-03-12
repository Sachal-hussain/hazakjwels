<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get All Register Sidebar List.
$litho_sidebar_array = litho_register_sidebar_customizer_array();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_portfolio_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_separator', array(
	'label'      		=> esc_html__( 'Layout and Container', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'   		=> 'litho_single_portfolio_separator',
) ) );

/* End Separator Settings */

/* Portfolio Layout */

$wp_customize->add_setting( 'litho_portfolio_layout_setting', array(
	'default' 			=> 'litho_layout_no_sidebar',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_portfolio_layout_setting', array(
	'label'       		=> esc_html__( 'Layout Style', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_layout_setting',
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
	'litho_columns'    	=> '4',
) ) );

/* End Portfolio Layout */

/* Portfolio Left Sidebar */

$wp_customize->add_setting( 'litho_portfolio_left_sidebar', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_left_sidebar', array(
	'label'       		=> esc_html__( 'Left Sidebar', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_left_sidebar',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'   => 'litho_portfolio_left_sidebar_layout_callback',
) ) );

/* End Portfolio Left Sidebar */

/* Portfolio Right Sidebar */

$wp_customize->add_setting( 'litho_portfolio_right_sidebar', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_right_sidebar', array(
	'label'       		=> esc_html__( 'Right Sidebar', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_right_sidebar',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'   => 'litho_portfolio_right_sidebar_layout_callback',
) ) );

/* End Portfolio Right Sidebar */

/* Portfolio Container Setting */

$wp_customize->add_setting( 'litho_portfolio_container_style', array(
	'default' 			=> 'container',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_container_style', array(
	'label'       		=> esc_html__( 'Container Style', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_container_style',
	'type'              => 'select',
	'choices'           => array(
								'container'						=> esc_html__( 'Fixed', 'litho' ),
								'container-fluid'				=> esc_html__( 'Full width', 'litho' ),
								'container-fluid-with-padding' 	=> esc_html__( 'Full width ( with paddings )', 'litho' ),
						   ),
) ) );

/* End Portfolio Container Setting */

/* Container custom Width setting */

$wp_customize->add_setting( 'litho_portfolio_container_fluid_with_padding', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_container_fluid_with_padding', array(
	'label'				=> esc_html__( 'Full width padding', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_container_fluid_with_padding',
	'type'              => 'text',
	'active_callback'	=> 'litho_portfolio_container_fluid_with_padding_callback',
) ) );

/* End Container custom Width setting */

/* Start Within Content Area */

$wp_customize->add_setting( 'litho_portolio_within_content_area', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_portolio_within_content_area', array(
	'label'				=> esc_html__( 'Within content area', 'litho' ),
	'section'			=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portolio_within_content_area',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Within Content Area */

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_portfolio_style_data_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_style_data_separator', array(
	'label'      		=> esc_html__( 'Portfolio Style and Data', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'   		=> 'litho_single_portfolio_style_data_separator',
) ) );

/* End Separator Settings */

/* Hide Feature Image */

$wp_customize->add_setting( 'litho_portfolio_featured_image', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_portfolio_featured_image', array(
	'label'       		=> esc_html__( 'Featured image', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_featured_image',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Feature Image */

/* Hide Portfolio Comment */

$wp_customize->add_setting( 'litho_hide_single_portfolio_comment', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_hide_single_portfolio_comment', array(
	'label'       		=> esc_html__( 'Comment', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_hide_single_portfolio_comment',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Portfolio Comment */

/* Enable Category */

$wp_customize->add_setting( 'litho_portfolio_enable_category', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_portfolio_enable_category', array(
	'label'       		=> esc_html__( 'Category', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_enable_category',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Category */

/* Enable Tag */

$wp_customize->add_setting( 'litho_portfolio_enable_tag', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_portfolio_enable_tag', array(
	'label'       		=> esc_html__( 'Tag', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_enable_tag',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Category */

/* Hide Portfolio Social Share */

$wp_customize->add_setting( 'litho_hide_single_portfolio_share', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_hide_single_portfolio_share', array(
	'label'       		=> esc_html__( 'Social share', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_hide_single_portfolio_share',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Portfolio Share */


/* Portfolio Share Heading */

$wp_customize->add_setting( 'litho_single_portfolio_share_title', array(
	'default' 			=> esc_html__( 'Share this project', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_portfolio_share_title', array(
	'label'       		=> esc_html__( 'Share heading', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_single_portfolio_share_title',
	'type'              => 'text',
	'active_callback'   => 'litho_single_portfolio_share_callback',
) ) );

/* End Portfolio Share Heading */

/* Portfolio Rich Snippet */

$wp_customize->add_setting( 'litho_portfolio_rich_snippet', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_portfolio_rich_snippet', array(
	'label'				=> esc_html__( 'Rich Snippet', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_rich_snippet',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Portfolio Rich Snippet */

/* Color Separator Setting */

$wp_customize->add_setting( 'litho_portfolio_meta_color_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_meta_color_separator', array(
	'label'				=> esc_html__( 'Font and colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'   		=> 'litho_portfolio_meta_color_separator',
) ) );

/* End Color Separator Setting */

/* Portfolio Meta title color Setting */

$wp_customize->add_setting( 'litho_single_portfolio_meta_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_portfolio_meta_title_color', array(
	'label'      		=> esc_html__( 'Portfolio meta title color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_single_portfolio_meta_title_color',
) ) );

/* End Portfolio Meta title color Setting */


/* Portfolio Meta color Setting */

$wp_customize->add_setting( 'litho_single_portfolio_meta_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_portfolio_meta_color', array(
	'label'      		=> esc_html__( 'Portfolio meta color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_single_portfolio_meta_color',
) ) );

/* End Portfolio Meta color Setting */

/* Portfolio Meta color Setting */

$wp_customize->add_setting( 'litho_single_portfolio_meta_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_portfolio_meta_hover_color', array(
	'label'      		=> esc_html__( 'Portfolio meta hover color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_single_portfolio_meta_hover_color',
) ) );

/* End Portfolio Meta color Setting */

/* Share Heading Fonts & Color Separator Settings */
$wp_customize->add_setting( 'litho_single_portfolio_share_font_colors_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_share_font_colors_separator', array(
	'label'      		=> esc_html__( 'Share icons font and colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'   		=> 'litho_single_portfolio_share_font_colors_separator',
	'active_callback'   => 'litho_single_portfolio_share_callback',
) ) );

/* End Share Heading Fonts & Color Separator Settings */

/* Share Heading Font size setting */

$wp_customize->add_setting( 'litho_single_portfolio_share_heading_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_portfolio_share_heading_font_size', array(
	'label'				=> esc_html__( 'Font size', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_single_portfolio_share_heading_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_single_portfolio_share_callback',
) ) );

/* End Share Heading Font size setting */

/* Share Heading Font line height setting */

$wp_customize->add_setting( 'litho_single_portfolio_share_heading_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_portfolio_share_heading_line_height', array(
	'label'				=> esc_html__( 'Line height', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_single_portfolio_share_heading_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_single_portfolio_share_callback',
) ) );

/* End Share Heading Font line height setting */

/* Share Heading Font letter spacing setting */

$wp_customize->add_setting( 'litho_single_portfolio_share_heading_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_portfolio_share_heading_letter_spacing', array(
	'label'				=> esc_html__( 'Letter spacing', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_single_portfolio_share_heading_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 2px', 'litho' ),
	'active_callback'	=> 'litho_single_portfolio_share_callback',
) ) );

/* End Share Heading Font letter spacing setting */

/* Share Heading Font weight setting */

$wp_customize->add_setting( 'litho_single_portfolio_share_heading_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_portfolio_share_heading_font_weight', array(
	'label'				=> esc_html__( 'Font weight', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_single_portfolio_share_heading_font_weight',
	'type'              => 'select',
	'choices'           => $litho_font_weight,
	'active_callback'	=> 'litho_single_portfolio_share_callback',
) ) );

/* End Share Heading Font weight setting */

/* Share Heading Text Transform setting */

$wp_customize->add_setting( 'litho_single_portfolio_share_heading_text_transform', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_portfolio_share_heading_text_transform', array(
	'label'				=> esc_html__( 'Share heading text case', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_single_portfolio_share_heading_text_transform',
	'type'              => 'select',
	'choices'           => array(
								''					=> esc_html__( 'Select', 'litho' ),
							    'uppercase'			=> esc_html__( 'Uppercase', 'litho' ),
							    'lowercase'			=> esc_html__( 'Lowercase', 'litho' ),
							    'capitalize'		=> esc_html__( 'Capitalize', 'litho' ),
							    'none'				=> esc_html__( 'None', 'litho' ),
							   ),
	'active_callback'	=> 'litho_single_portfolio_share_callback',
) ) );

/* End Share Heading Text Transform setting */

/* Share heading Text Color Setting */

$wp_customize->add_setting( 'litho_single_portfolio_share_heading_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_portfolio_share_heading_text_color', array(
	'label'      		=> esc_html__( 'Share heading color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_single_portfolio_share_heading_text_color',
	'active_callback'   => 'litho_single_portfolio_share_callback',
) ) );

/* End Share heading Text Color Setting */

/* Share Icon Color Setting */

$wp_customize->add_setting( 'litho_single_portfolio_share_icon_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_portfolio_share_icon_color', array(
	'label'      		=> esc_html__( 'Share icon color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_single_portfolio_share_icon_color',
	'active_callback'   => 'litho_single_portfolio_share_callback',
) ) );

/* End Share Icon Color Setting */


/* Separator Settings */
$wp_customize->add_setting( 'litho_single_portfolio_related_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_related_separator', array(
	'label'      		=> esc_html__( 'Related Portfolio', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'   		=> 'litho_single_portfolio_related_separator',
) ) );

/* End Separator Settings */

/* Hide Related Portfolio */

$wp_customize->add_setting( 'litho_hide_related_single_portfolio', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_hide_related_single_portfolio', array(
	'label'       		=> esc_html__( 'Related Portfolio', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_hide_related_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Related Portfolio */

/*  No. of related Portfolio Column  */

$wp_customize->add_setting( 'litho_no_of_related_single_portfolio_columns', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_no_of_related_single_portfolio_columns', array(
	'label'       		=> esc_html__( 'No. of columns', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_no_of_related_single_portfolio_columns',
	'type'              => 'litho_preview_image',
	'choices'    		=> array(
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
	'litho_columns'    	=> '4',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End No. of related Portfolio Column */

/* Portfolio Featured Image Size */

$wp_customize->add_setting( 'litho_related_single_portfolio_feature_image_size', array(
	'default' 			=> 'full',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Image_SRCSET_Control( $wp_customize, 'litho_related_single_portfolio_feature_image_size', array(
	'label'       		=> esc_html__( 'Thumbnail size', 'litho' ),
	'type'              => 'litho_image_srcset',
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_related_single_portfolio_feature_image_size',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Portfolio Featured Image Size */

/* Related Portfolio Block Heading */

$wp_customize->add_setting( 'litho_related_single_portfolio_title', array(
	'default' 			=> esc_html__( 'Our Recent Works', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_related_single_portfolio_title', array(
	'label'       		=> esc_html__( 'Title', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_related_single_portfolio_title',
	'type'              => 'text',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Block Heading */

/* Related Portfolio Block Content */

$wp_customize->add_setting( 'litho_related_single_portfolio_content', array(
	'default' 			=> esc_html__( 'Other creative work for brands', 'litho' ),
	'sanitize_callback' => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_related_single_portfolio_content', array(
	'label'       		=> esc_html__( 'Content', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_related_single_portfolio_content',
	'type'              => 'textarea',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Block Content */

/*  No. of related Portfolio  */

$wp_customize->add_setting( 'litho_no_of_related_single_portfolio', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_no_of_related_single_portfolio', array(
	'label'       		=> esc_html__( 'Number of portfolios', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_no_of_related_single_portfolio',
	'type'      		=> 'select',
	'choices'    		=> array(
								'1' => esc_html__( '1', 'litho' ),
								'2' => esc_html__( '2', 'litho' ),
								'3' => esc_html__( '3', 'litho' ),
								'4' => esc_html__( '4', 'litho' ),
								'5' => esc_html__( '5', 'litho' ),
								'6' => esc_html__( '6', 'litho' )
							),
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End No. of related Portfolio */

/* Related Portfolio Display By */

$wp_customize->add_setting( 'litho_related_single_portfolio_display_by', array(
	'default' 			=> 'portfolio-category',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_related_single_portfolio_display_by', array(
	'label'       		=> esc_html__( 'Related portfolio display by', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_related_single_portfolio_display_by',
	'type'              => 'select',
	'choices'           => array(
								'portfolio-category'	=> esc_html__( 'Categories', 'litho' ),
								'portfolio-tags'		=> esc_html__( 'Tags', 'litho' ),
						   ),
	'active_callback'	=> 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio display by */

/* Related Portfolio Content Text Transform */

$wp_customize->add_setting( 'litho_related_single_portfolio_subtitle_text_transform', array(
	'default' 			=> 'capitalize',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_related_single_portfolio_subtitle_text_transform', array(
	'label'       		=> esc_html__( 'Related portfolio content text case', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_related_single_portfolio_subtitle_text_transform',
	'type'              => 'select',
	'choices'           => array(
								'' 				=> esc_html__( 'Select', 'litho' ),
								'lowercase' 	=> esc_html__( 'Lowercase', 'litho' ),
								'uppercase' 	=> esc_html__( 'Uppercase', 'litho' ),
								'capitalize' 	=> esc_html__( 'Capitalize', 'litho' ),
						   ),
	'active_callback'	=> 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Content Text Transform */

/* Related Portfolio Box Background Color Setting */

$wp_customize->add_setting( 'litho_related_single_portfolio_box_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_single_portfolio_box_bg_color', array(
	'label'      		=> esc_html__( 'Box background color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_related_single_portfolio_box_bg_color',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Box Background Color Setting */

/* Related Portfolio Box Title Text Color Setting */

$wp_customize->add_setting( 'litho_related_single_portfolio_title_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_single_portfolio_title_text_color', array(
	'label'      		=> esc_html__( 'Box title color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_related_single_portfolio_title_text_color',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Box Title Text Color Setting */

/* Related Portfolio Box Content Color Setting */

$wp_customize->add_setting( 'litho_related_single_portfolio_content_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_single_portfolio_content_color', array(
	'label'      		=> esc_html__( 'Box content color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_related_single_portfolio_content_color',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Box Content Color Setting */

/* Related Portfolio Background Color Setting */

$wp_customize->add_setting( 'litho_related_single_portfolio_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_single_portfolio_bg_color', array(
	'label'      		=> esc_html__( 'Portfolio background color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_related_single_portfolio_bg_color',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Background Color Setting */

/* Related Portfolio Title Color Setting */

$wp_customize->add_setting( 'litho_related_single_portfolio_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_single_portfolio_title_color', array(
	'label'      		=> esc_html__( 'Portfolio title color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_related_single_portfolio_title_color',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Title Color Setting */

/* Related Portfolio Content Color Setting */

$wp_customize->add_setting( 'litho_related_single_portfolio_subtitle_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_single_portfolio_subtitle_color', array(
	'label'      		=> esc_html__( 'Portfolio content color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_related_single_portfolio_subtitle_color',
	'active_callback'   => 'litho_related_single_portfolio_callback',
) ) );

/* End Related Portfolio Content Color Setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_portfolio_navigation_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_portfolio_navigation_separator', array(
	'label'      		=> esc_html__( 'Navigation', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'   		=> 'litho_single_portfolio_navigation_separator',
) ) );

/* End Separator Settings */

/* Hide Portfolio Navigation */

$wp_customize->add_setting( 'litho_hide_navigation_single_portfolio', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_hide_navigation_single_portfolio', array(
	'label'       		=> esc_html__( 'Navigation', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_hide_navigation_single_portfolio',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   )
) ) );

/* End Hide Portfolio Navigation */

/* Portfolio Navigation Type*/

$wp_customize->add_setting( 'litho_portfolio_navigation_type', array(
	'default' 			=> 'latest',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_navigation_type', array(
	'label'       		=> esc_html__( 'Navigation type', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_navigation_type',
	'type'              => 'select',
	'choices'           => array(
								'latest'		=> esc_html__( 'Latest Portfolio', 'litho' ),
								'category'		=> esc_html__( 'Category', 'litho' ),
								'tag'			=> esc_html__( 'Tag', 'litho' ),

						   ),
	'active_callback'	=> 'litho_portfolio_navigation_callback'
) ) );

/* End Portfolio Navigation Type*/

/* Portfolio Order By*/

$wp_customize->add_setting( 'litho_portfolio_navigation_orderby', array(
	'default' 			=> 'date',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_navigation_orderby', array(
	'label'       		=> esc_html__( 'Order by', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_navigation_orderby',
	'type'              => 'select',
	'choices'           => array(
								'date'		=> esc_html__( 'Date', 'litho' ),
								'title'		=> esc_html__( 'Title', 'litho' ),
						   ),
	'active_callback'	=> 'litho_portfolio_navigation_type_callback'
) ) );

/* End Portfolio Order By*/

/* Portfolio Order*/

$wp_customize->add_setting( 'litho_portfolio_navigation_order', array(
	'default' 			=> 'DESC',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_navigation_order', array(
	'label'       		=> esc_html__( 'Order', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_navigation_order',
	'type'              => 'select',
	'choices'           => array(
								'DESC'	=> esc_html__( 'DESC', 'litho' ),
								'ASC'	=> esc_html__( 'ASC', 'litho' ),
						   ),
	'active_callback'	=> 'litho_portfolio_navigation_type_callback'
) ) );

/* End Portfolio Order */

/* Portfolio Navigation Type Callback Functions */

if ( ! function_exists( 'litho_portfolio_navigation_type_callback' ) ) {
	function litho_portfolio_navigation_type_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_hide_navigation_single_portfolio' )->value() == 1 && $control->manager->get_setting( 'litho_portfolio_navigation_type' )->value() != 'latest' ) {
			return true;
		} else {
			return false;
		}
	}
}

/* Portfolio Navigation Next Link Text*/

$wp_customize->add_setting( 'litho_portfolio_navigation_nextlink_text', array(
	'default' 			=> esc_html__( 'Next Project', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_navigation_nextlink_text', array(
	'label'       		=> esc_html__( 'Next link text', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_navigation_nextlink_text',
	'type'              => 'text',
	'active_callback'	=> 'litho_portfolio_navigation_callback'
) ) );

/* End Portfolio Navigation Next Link Text*/

/* Portfolio Navigation Previous Link Text*/

$wp_customize->add_setting( 'litho_portfolio_navigation_priviouslink_text', array(
	'default' 			=> esc_html__( 'Previous Project', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_portfolio_navigation_priviouslink_text', array(
	'label'       		=> esc_html__( 'Previous link text', 'litho' ),
	'section'     		=> 'litho_add_portfolio_layout_panel',
	'settings'			=> 'litho_portfolio_navigation_priviouslink_text',
	'type'              => 'text',
	'active_callback'	=> 'litho_portfolio_navigation_callback'
) ) );

/* End Portfolio Navigation Previous Link Text*/

/* Portfolio Navigation Background Color Setting */

$wp_customize->add_setting( 'litho_navigation_single_portfolio_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_navigation_single_portfolio_bg_color', array(
	'label'      		=> esc_html__( 'Navigation background color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_navigation_single_portfolio_bg_color',
	'active_callback'	=> 'litho_portfolio_navigation_callback'
) ) );

/* End Portfolio Navigation Background Color Setting */

/* Portfolio Navigation Text Color Setting */

$wp_customize->add_setting( 'litho_navigation_single_portfolio_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_navigation_single_portfolio_text_color', array(
	'label'      		=> esc_html__( 'Navigation text color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_navigation_single_portfolio_text_color',
	'active_callback'	=> 'litho_portfolio_navigation_callback'
) ) );

/* End Portfolio Navigation Text Color Setting */

/* Portfolio Navigation Link Color Setting */

$wp_customize->add_setting( 'litho_navigation_single_portfolio_link_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_navigation_single_portfolio_link_color', array(
	'label'      		=> esc_html__( 'Navigation link color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_navigation_single_portfolio_link_color',
	'active_callback'	=> 'litho_portfolio_navigation_callback'
) ) );

/* End Portfolio Navigation Link Color Setting */

/* Portfolio Navigation Link Hover Color Setting */

$wp_customize->add_setting( 'litho_navigation_single_portfolio_link_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_navigation_single_portfolio_link_hover_color', array(
	'label'      		=> esc_html__( 'Navigation link hover color', 'litho' ),
	'section'    		=> 'litho_add_portfolio_layout_panel',
	'settings'	 		=> 'litho_navigation_single_portfolio_link_hover_color',
	'active_callback'	=> 'litho_portfolio_navigation_callback'
) ) );

/* End Portfolio Navigation Link Hover Color Setting */

/* Custom Callback Functions */

if ( ! function_exists( 'litho_portfolio_left_sidebar_layout_callback' ) ) :
	function litho_portfolio_left_sidebar_layout_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_portfolio_layout_setting' )->value() == 'litho_layout_left_sidebar' || $control->manager->get_setting( 'litho_portfolio_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_portfolio_right_sidebar_layout_callback' ) ) :
	function litho_portfolio_right_sidebar_layout_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_portfolio_layout_setting' )->value() == 'litho_layout_right_sidebar' || $control->manager->get_setting( 'litho_portfolio_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}  
	}
endif;

if ( ! function_exists( 'litho_portfolio_container_fluid_with_padding_callback' ) ) :
	function litho_portfolio_container_fluid_with_padding_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_portfolio_container_style' )->value() == 'container-fluid-with-padding' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Custom Callback Functions */

/* Portfolio Navigation Callback Functions */

if ( ! function_exists( 'litho_portfolio_navigation_callback' ) ) {
	function litho_portfolio_navigation_callback( $control ) {
			if ( $control->manager->get_setting( 'litho_hide_navigation_single_portfolio' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
}

/* End Portfolio Navigation Callback Functions */

/* Related Portfolio Callback Functions */

if ( ! function_exists( 'litho_related_single_portfolio_callback' ) ) :
	function litho_related_single_portfolio_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_hide_related_single_portfolio' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Related Portfolio Callback Functions */

/* Portfolio Share Callback Functions */

if ( ! function_exists( 'litho_single_portfolio_share_callback' ) ) :
	function litho_single_portfolio_share_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_hide_single_portfolio_share' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Portfolio Share Callback Functions */

/* Portfolio Date Format Callback Functions */
if ( ! function_exists( 'litho_portfolio_date_callback' ) ) :
	function litho_portfolio_date_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_portfolio_hide_date' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;
