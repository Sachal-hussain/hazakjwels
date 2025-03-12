<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get All Register Sidebar List.
$litho_sidebar_array = litho_register_sidebar_customizer_array(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_product_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_separator', array(
	'label'      		=> esc_html__( 'Layout and Container', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_separator',
) ) );

/* End Separator Settings */

/* Product Layout */

$wp_customize->add_setting( 'litho_product_layout_setting', array(
	'default' 			=> 'litho_layout_no_sidebar',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_product_layout_setting', array(
	'label'       		=> esc_html__( 'Layout Style', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_product_layout_setting',
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

/* End Product Layout */

/* Product Left Sidebar */

$wp_customize->add_setting( 'litho_product_left_sidebar', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_left_sidebar', array(
	'label'       		=> esc_html__( 'Left Sidebar', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_product_left_sidebar',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'   => 'litho_product_left_sidebar_layout_callback',
) ) );

/* End Product Left Sidebar */

/* Product Right Sidebar */

$wp_customize->add_setting( 'litho_product_right_sidebar', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_right_sidebar', array(
	'label'       		=> esc_html__( 'Right Sidebar', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_product_right_sidebar',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'   => 'litho_product_right_sidebar_layout_callback',
) ) );

/* End Product Right Sidebar */

/* Product Container Setting */

$wp_customize->add_setting( 'litho_product_container_style', array(
	'default' 			=> 'container',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_container_style', array(
	'label'       		=> esc_html__( 'Container Style', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_product_container_style',
	'type'              => 'select',
	'choices'           => array(
								'container'						=> esc_html__( 'Fixed', 'litho' ),
								'container-fluid'				=> esc_html__( 'Full width', 'litho' ),
								'container-fluid-with-padding' 	=> esc_html__( 'Full width ( with paddings )', 'litho' ),
						   ),
) ) );

/* End Product Container Setting */

/* Container custom Width setting */

$wp_customize->add_setting( 'litho_product_container_fluid_with_padding', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_container_fluid_with_padding', array(
	'label'				=> esc_html__( 'Full width padding', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_product_container_fluid_with_padding',
	'type'              => 'text',
	'active_callback'	=> 'litho_product_container_fluid_with_padding_callback',
) ) );

/* End Container custom Width setting */

/* Main Section Top Space */

$wp_customize->add_setting( 'litho_single_product_top_space', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_single_product_top_space', array(
	'label'				=> esc_html__( 'Add top space of header height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_top_space',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Main Section Top Space */

/* Product Rich Snippet */

$wp_customize->add_setting( 'litho_product_rich_snippet', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_product_rich_snippet', array(
	'label'				=> esc_html__( 'Rich Snippet', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_product_rich_snippet',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Product Rich Snippet */


if ( ! function_exists( 'litho_product_left_sidebar_layout_callback' ) ) :
	function litho_product_left_sidebar_layout_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_product_layout_setting' )->value() == 'litho_layout_left_sidebar' || $control->manager->get_setting( 'litho_product_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_product_right_sidebar_layout_callback' ) ) :
	function litho_product_right_sidebar_layout_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_product_layout_setting' )->value() == 'litho_layout_right_sidebar' || $control->manager->get_setting( 'litho_product_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}  
	}
endif;

if ( ! function_exists( 'litho_product_container_fluid_with_padding_callback' ) ) :
	function litho_product_container_fluid_with_padding_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_product_container_style' )->value() == 'container-fluid-with-padding' ) {
			return true;
		} else {
			return false;
		}
	}
endif;


/* Separator Settings */
$wp_customize->add_setting( 'litho_single_product_style_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
 ) );

 $wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_style_separator', array(
	'label'				=> esc_html__( 'Product style and data', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_style_separator',
) ) );

/* End Separator Settings */

/* Hide Product Title */

$wp_customize->add_setting( 'litho_single_product_enable_title', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_title', array(
	'label'				=> esc_html__( 'Title', 'litho' ),
	'section'			=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_title',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Product Title */

/* Enable Product Short Description */

$wp_customize->add_setting( 'litho_single_product_enable_short_description', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_short_description', array(
	'label'       		=> esc_html__( 'Short Description', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_short_description',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Product Short Description */

/* Enable Product SKU */

$wp_customize->add_setting( 'litho_single_product_enable_sku', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_sku', array(
	'label'       		=> esc_html__( 'SKU', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_sku',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Product SKU */

/* Enable Product Categories */

$wp_customize->add_setting( 'litho_single_product_enable_category', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_category', array(
	'label'       		=> esc_html__( 'Category', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_category',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Product Categoriese */


/* Enable Product Tags */

$wp_customize->add_setting( 'litho_single_product_enable_tag', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_tag', array(
	'label'       		=> esc_html__( 'Tags', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_tag',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Product Tags */

/* Enable Product Share */

$wp_customize->add_setting( 'litho_single_product_enable_social_share', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_social_share', array(
	'label'       		=> esc_html__( 'Social Share', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_social_share',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Product Share */

/* Product Share Title */

$wp_customize->add_setting( 'litho_single_product_share_title', array(
	'default' 			=> esc_html__( 'Share:', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_share_title', array(
	'label'       		=> esc_html__( 'Share Heading', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_share_title',
	'type'              => 'text',
	'active_callback'   => 'litho_single_product_share_title_callback',
) ) );

/* End Product Share Title */


/* Enable Product Tab Content Heading */

$wp_customize->add_setting( 'litho_single_product_enable_tab_content_heading', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_tab_content_heading', array(
	'label'       		=> esc_html__( 'Tab Content Heading', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_tab_content_heading',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Product Tab Content Heading */

/* Product Sale Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_sale_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_sale_typography', array(
	'label'      		=> esc_html__( 'Sale Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_sale_typography',
) ) );

/* End Product Sale Typography Separator setting */

/* Product Sale Font Size */

$wp_customize->add_setting( 'litho_single_product_sale_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_sale_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_sale_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Sale Font Size */

/* Product Sale Line Height */

$wp_customize->add_setting( 'litho_single_product_sale_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_sale_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_sale_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Sale Line Height */

/* Product Sale Font Weight */

$wp_customize->add_setting( 'litho_single_product_sale_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_sale_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_sale_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''		=> esc_html__( 'Select Font Weight', 'litho' ),
								'100'	=> esc_html__( 'Font weight 100', 'litho' ),
								'200'	=> esc_html__( 'Font weight 200', 'litho' ),
								'300'	=> esc_html__( 'Font weight 300', 'litho' ),
								'400'	=> esc_html__( 'Font weight 400', 'litho' ),
								'500'	=> esc_html__( 'Font weight 500', 'litho' ),
								'600'	=> esc_html__( 'Font weight 600', 'litho' ),
								'700'	=> esc_html__( 'Font weight 700', 'litho' ),
								'800'	=> esc_html__( 'Font weight 800', 'litho' ),
								'900'	=> esc_html__( 'Font weight 900', 'litho' ),
						   ),
) ) );

/* End Product Sale Font Weight */

/* Product Sale Color */

$wp_customize->add_setting( 'litho_single_product_sale_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_sale_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_sale_color',
) ) );

/* End Product Sale Color */

/* Product Sale Background Color setting */

$wp_customize->add_setting( 'litho_single_product_sale_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_sale_bg_color', array(
	'label'      		=> esc_html__( 'Background Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_sale_bg_color',
) ) );

/* Product Sale Background Color setting */

/* Product Show Box Sale Border setting */

$wp_customize->add_setting( 'litho_single_product_sale_enable_border', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_sale_enable_border', array(
	'label'       		=> esc_html__( 'Box Border', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_sale_enable_border',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* Product Show Box Sale Border setting */

/* Product Sale Border Size setting */

$wp_customize->add_setting( 'litho_single_product_sale_border_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_sale_border_size', array(
	'label'       		=> esc_html__( 'Box Border Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_sale_border_size',
	'type'              => 'text',
	'active_callback'	=> 'litho_single_product_sale_border_callback',
) ) );

/* End Product Sale Border Size setting */

/* Product Sale Border Type setting */

$wp_customize->add_setting( 'litho_single_product_sale_border_type', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_sale_border_type', array(
	'label'       		=> esc_html__( 'Box Border Type', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_sale_border_type',
	'type'              => 'select',
	'choices'           => array(
								''			=> esc_html__( 'Select Border Type', 'litho' ),
								'dotted' 	=> esc_html__( 'Dotted', 'litho' ),
								'dashed'	=> esc_html__( 'Dashed', 'litho' ),
								'solid'		=> esc_html__( 'Solid', 'litho' ),
								'double'	=> esc_html__( 'Double', 'litho' ),
							   ),
	'active_callback'	=> 'litho_single_product_sale_border_callback',
) ) );

/* End Product Sale Border Type setting */

/* Product Sale Border Color */

$wp_customize->add_setting( 'litho_single_product_sale_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_sale_border_color', array(
	'label'      		=> esc_html__( 'Box Border Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_sale_border_color',
	'active_callback'	=> 'litho_single_product_sale_border_callback',
) ) );

/* End Product Sale Border Color */

/* Product Title Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_page_title_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_page_title_typography', array(
	'label'      		=> esc_html__( 'Title Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_page_title_typography',
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Title Typography Separator setting */

/* Product Title Font Size */

$wp_customize->add_setting( 'litho_single_product_page_title_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_title_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_title_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Title Font Size */

/* Product Title Line Height */

$wp_customize->add_setting( 'litho_single_product_page_title_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_title_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_title_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Title Line Height */

/* Product Title Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_page_title_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_title_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_title_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Title Letter Spacing */

/* Product Title Font Weight */

$wp_customize->add_setting( 'litho_single_product_page_title_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_title_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_title_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''		=> esc_html__( 'Select Font Weight', 'litho' ),
								'100'	=> esc_html__( 'Font weight 100', 'litho' ),
								'200'	=> esc_html__( 'Font weight 200', 'litho' ),
								'300'	=> esc_html__( 'Font weight 300', 'litho' ),
								'400'	=> esc_html__( 'Font weight 400', 'litho' ),
								'500'	=> esc_html__( 'Font weight 500', 'litho' ),
								'600'	=> esc_html__( 'Font weight 600', 'litho' ),
								'700'	=> esc_html__( 'Font weight 700', 'litho' ),
								'800'	=> esc_html__( 'Font weight 800', 'litho' ),
								'900'	=> esc_html__( 'Font weight 900', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Title Font Weight */

/* Product Font Italic */

$wp_customize->add_setting( 'litho_single_product_page_title_font_italic', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_page_title_font_italic', array(
	'label'       		=> esc_html__( 'Font Italic', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_title_font_italic',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Font Italic */

/* Product Font Underline */

$wp_customize->add_setting( 'litho_single_product_page_title_font_underline', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_page_title_font_underline', array(
	'label'       		=> esc_html__( 'Font Underline', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_title_font_underline',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Font Underline */

/* Product Title Color */

$wp_customize->add_setting( 'litho_single_product_page_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_page_title_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_page_title_color',
	'active_callback'	=> 'litho_single_product_page_title_callback',
) ) );

/* End Product Title Color */

/* Product Rating Star Color Separator setting */

$wp_customize->add_setting( 'litho_single_product_rating_star_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_rating_star_typography', array(
	'label'      		=> esc_html__( 'Rating Star Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_rating_star_typography',
) ) );

/* End Product Rating Star Color Separator setting */

/* Product Rating Star Color */

$wp_customize->add_setting( 'litho_single_product_rating_star_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_rating_star_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_rating_star_color',
) ) );

/* End Product Rating Star Color */

/* Product Price Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_price_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_price_typography', array(
	'label'      		=> esc_html__( 'Price Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_price_typography',
) ) );

/* End Product Price Typography Separator setting */

/* Product Price Font Size */

$wp_customize->add_setting( 'litho_single_product_price_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_price_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_price_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Price Font Size */

/* Product Price Line Height */

$wp_customize->add_setting( 'litho_single_product_price_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_price_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_price_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Price Line Height */

/* Product Price Font Weight */

$wp_customize->add_setting( 'litho_single_product_price_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_price_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_price_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''		=> esc_html__( 'Select Font Weight', 'litho' ),
								'100'	=> esc_html__( 'Font weight 100', 'litho' ),
								'200'	=> esc_html__( 'Font weight 200', 'litho' ),
								'300'	=> esc_html__( 'Font weight 300', 'litho' ),
								'400'	=> esc_html__( 'Font weight 400', 'litho' ),
								'500'	=> esc_html__( 'Font weight 500', 'litho' ),
								'600'	=> esc_html__( 'Font weight 600', 'litho' ),
								'700'	=> esc_html__( 'Font weight 700', 'litho' ),
								'800'	=> esc_html__( 'Font weight 800', 'litho' ),
								'900'	=> esc_html__( 'Font weight 900', 'litho' ),
						   ),
) ) );

/* End Product Price Font Weight */

/* Product Price Color */

$wp_customize->add_setting( 'litho_single_product_price_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_price_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_price_color',
) ) );

/* End Product Price Color */

/* Product Main Price Color */

$wp_customize->add_setting( 'litho_single_product_regular_price_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_regular_price_color', array(
	'label'      		=> esc_html__( 'Main Price Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_regular_price_color',
) ) );

/* End Product Main Price Color */

/* Product Short Description Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_short_description_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_short_description_typography', array(
	'label'      		=> esc_html__( 'Short Description Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_short_description_typography',
	'active_callback'	=> 'litho_single_product_short_description_callback',
) ) );

/* End Product Short Description Typography Separator setting */

/* Product Short Description Font Size */

$wp_customize->add_setting( 'litho_single_product_short_description_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_short_description_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_short_description_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_short_description_callback',
) ) );

/* End Product Short Description Font Size */

/* Product Short Description Line Height */

$wp_customize->add_setting( 'litho_single_product_short_description_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_short_description_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_short_description_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_short_description_callback',
) ) );

/* End Product Short Description Line Height */

/* Product Short Description Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_short_description_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_short_description_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_short_description_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_short_description_callback',
) ) );

/* End Product Short Description Letter Spacing */

/* Product Short Description Font Weight */

$wp_customize->add_setting( 'litho_single_product_short_description_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_short_description_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_short_description_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''		=> esc_html__( 'Select Font Weight', 'litho' ),
								'100'	=> esc_html__( 'Font weight 100', 'litho' ),
								'200'	=> esc_html__( 'Font weight 200', 'litho' ),
								'300'	=> esc_html__( 'Font weight 300', 'litho' ),
								'400'	=> esc_html__( 'Font weight 400', 'litho' ),
								'500'	=> esc_html__( 'Font weight 500', 'litho' ),
								'600'	=> esc_html__( 'Font weight 600', 'litho' ),
								'700'	=> esc_html__( 'Font weight 700', 'litho' ),
								'800'	=> esc_html__( 'Font weight 800', 'litho' ),
								'900'	=> esc_html__( 'Font weight 900', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_short_description_callback',
) ) );

/* End Product Short Description Font Weight */

/* Product Short Description Color */

$wp_customize->add_setting( 'litho_single_product_short_description_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_short_description_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_short_description_color',
	'active_callback'	=> 'litho_single_product_short_description_callback',
) ) );

/* End Product Short Description Color */

/* Product Stock Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_stock_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_stock_typography', array(
	'label'      		=> esc_html__( 'Stock Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_stock_typography',
) ) );

/* End Product Stock Typography Separator setting */

/* Product Stock Font Size */

$wp_customize->add_setting( 'litho_single_product_stock_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_stock_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_stock_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Stock Font Size */

/* Product Stock Line Height */

$wp_customize->add_setting( 'litho_single_product_stock_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_stock_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_stock_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Stock Line Height */

/* Product Stock Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_stock_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_stock_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_stock_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Stock Letter Spacing */

/* Product Stock Font Weight */

$wp_customize->add_setting( 'litho_single_product_stock_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_stock_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_stock_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''		=> esc_html__( 'Select Font Weight', 'litho' ),
								'100'	=> esc_html__( 'Font weight 100', 'litho' ),
								'200'	=> esc_html__( 'Font weight 200', 'litho' ),
								'300'	=> esc_html__( 'Font weight 300', 'litho' ),
								'400'	=> esc_html__( 'Font weight 400', 'litho' ),
								'500'	=> esc_html__( 'Font weight 500', 'litho' ),
								'600'	=> esc_html__( 'Font weight 600', 'litho' ),
								'700'	=> esc_html__( 'Font weight 700', 'litho' ),
								'800'	=> esc_html__( 'Font weight 800', 'litho' ),
								'900'	=> esc_html__( 'Font weight 900', 'litho' ),
						   ),
) ) );

/* End Product Stock Font Weight */

/* Product In Stock Color */

$wp_customize->add_setting( 'litho_single_product_stock_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_stock_color', array(
	'label'      		=> esc_html__( 'In Stock Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_stock_color',
) ) );

/* End Product In Stock Color */

/* Product Out Of Stock Color */

$wp_customize->add_setting( 'litho_single_product_out_of_stock_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_out_of_stock_color', array(
	'label'      		=> esc_html__( 'Out Of Stock Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_out_of_stock_color',
) ) );

/* End Product Out Of Stock Color */

/* Product Stock Background Color setting */

$wp_customize->add_setting( 'litho_single_product_stock_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_stock_bg_color', array(
	'label'      		=> esc_html__( 'Background Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_stock_bg_color',
) ) );

/* Product Stock Background Color setting */

/* Product Show Box Stock Border setting */

$wp_customize->add_setting( 'litho_single_product_stock_enable_border', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_stock_enable_border', array(
	'label'       		=> esc_html__( 'Box Border', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_stock_enable_border',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* Product Show Box Stock Border setting */

/* Product Stock Border Size setting */

$wp_customize->add_setting( 'litho_single_product_stock_border_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_stock_border_size', array(
	'label'       		=> esc_html__( 'Box Border Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_stock_border_size',
	'type'              => 'text',
	'active_callback'	=> 'litho_single_product_stock_border_callback',
) ) );

/* End Product Stock Border Size setting */

/* Product Stock Border Type setting */

$wp_customize->add_setting( 'litho_single_product_stock_border_type', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_stock_border_type', array(
	'label'       		=> esc_html__( 'Box Border Type', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_stock_border_type',
	'type'              => 'select',
	'choices'           => array(
								''			=> esc_html__( 'Select Border Type', 'litho' ),
								'dotted' 	=> esc_html__( 'Dotted', 'litho' ),
								'dashed'	=> esc_html__( 'Dashed', 'litho' ),
								'solid'		=> esc_html__( 'Solid', 'litho' ),
								'double'	=> esc_html__( 'Double', 'litho' ),
							   ),
	'active_callback'	=> 'litho_single_product_stock_border_callback',
) ) );

/* End Product Stock Border Type setting */

/* Product In Stock Border Color */

$wp_customize->add_setting( 'litho_single_product_stock_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_stock_border_color', array(
	'label'      		=> esc_html__( 'In Stock Box Border Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_stock_border_color',
	'active_callback'	=> 'litho_single_product_stock_border_callback',
) ) );

/* End Product In Stock Border Color */

/* Product Out Of Stock Border Color */

$wp_customize->add_setting( 'litho_single_product_out_of_stock_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_out_of_stock_border_color', array(
	'label'      		=> esc_html__( 'Out Of Stock Box Border Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_out_of_stock_border_color',
	'active_callback'	=> 'litho_single_product_stock_border_callback',
) ) );

/* End Product Out Of Stock Border Color */

/* Product Button Separator setting */

$wp_customize->add_setting( 'litho_single_product_button_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_button_typography', array(
	'label'      		=> esc_html__( 'Button Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_button_typography',
) ) );

/* End Product Button Separator setting */

/* Product Button color setting */

$wp_customize->add_setting( 'litho_single_product_button_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_button_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_button_color',
) ) );

/* End Product Button color setting */

/* Product Button BG color setting */

$wp_customize->add_setting( 'litho_single_product_button_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_button_bg_color', array(
	'label'      		=> esc_html__( 'Background Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_button_bg_color',
) ) );

/* End Product Button BG color setting */

/* Product Button Border color setting */

$wp_customize->add_setting( 'litho_single_product_button_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_button_border_color', array(
	'label'      		=> esc_html__( 'Border Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_button_border_color',
) ) );

/* End Product Button Border color setting */

/* Product Button Hover color setting */

$wp_customize->add_setting( 'litho_single_product_button_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_button_hover_color', array(
	'label'      		=> esc_html__( 'Hover Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_button_hover_color',
) ) );

/* End Product Button Hover color setting */

/* Product Button Hover BG color setting */

$wp_customize->add_setting( 'litho_single_product_button_hover_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_button_hover_bg_color', array(
	'label'      		=> esc_html__( 'Hover Background Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_button_hover_bg_color',
) ) );

/* End Product Button Hover BG color setting */

/* Product Meta Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_page_meta_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_page_meta_typography', array(
	'label'      		=> esc_html__( 'Product Meta Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_page_meta_typography',
) ) );

/* End Product Meta Typography Separator setting */

/* Product Meta Font Size */

$wp_customize->add_setting( 'litho_single_product_page_meta_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_meta_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_meta_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Meta Font Size */

/* Product Meta Line Height */

$wp_customize->add_setting( 'litho_single_product_page_meta_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_meta_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_meta_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Meta Line Height */

/* Product Meta Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_page_meta_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_meta_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_meta_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Meta Letter Spacing */

/* Product Meta Font Weight */

$wp_customize->add_setting( 'litho_single_product_page_meta_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_meta_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_meta_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''		=> esc_html__( 'Select Font Weight', 'litho' ),
								'100'	=> esc_html__( 'Font weight 100', 'litho' ),
								'200'	=> esc_html__( 'Font weight 200', 'litho' ),
								'300'	=> esc_html__( 'Font weight 300', 'litho' ),
								'400'	=> esc_html__( 'Font weight 400', 'litho' ),
								'500'	=> esc_html__( 'Font weight 500', 'litho' ),
								'600'	=> esc_html__( 'Font weight 600', 'litho' ),
								'700'	=> esc_html__( 'Font weight 700', 'litho' ),
								'800'	=> esc_html__( 'Font weight 800', 'litho' ),
								'900'	=> esc_html__( 'Font weight 900', 'litho' ),
						   ),
) ) );

/* End Product Meta Font Weight */

/* Product Meta Color */

$wp_customize->add_setting( 'litho_single_product_page_meta_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_page_meta_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_page_meta_color',
) ) );

/* End Product Meta Color */

/* Product Meta Link Hover Color */

$wp_customize->add_setting( 'litho_single_product_page_meta_link_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_page_meta_link_hover_color', array(
	'label'      		=> esc_html__( 'Link Hover Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_page_meta_link_hover_color',
) ) );

/* End Product Meta Link Hover Color */

/* Product Meta Heading Color */

$wp_customize->add_setting( 'litho_single_product_page_meta_heading_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_page_meta_heading_color', array(
	'label'      		=> esc_html__( 'Heading Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_page_meta_heading_color',
) ) );

/* End Product Meta Heading Color */

/* Product Meta Social Icon Color */

$wp_customize->add_setting( 'litho_single_product_page_meta_social_icon_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_page_meta_social_icon_color', array(
	'label'      		=> esc_html__( 'Social Icon Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_page_meta_social_icon_color',
	'active_callback'   => 'litho_single_product_share_title_callback',
) ) );

/* End Product Meta Social Icon Color */

/* Product Tab Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_page_tab_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_page_tab_typography', array(
	'label'      		=> esc_html__( 'Product Tab Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_page_tab_typography',
) ) );

/* End Product Tab Typography Separator setting */

/* Product Tab Font Size */

$wp_customize->add_setting( 'litho_single_product_page_tab_text_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_tab_text_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_tab_text_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Tab Font Size */

/* Product Tab Line Height */

$wp_customize->add_setting( 'litho_single_product_page_tab_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_tab_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_tab_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Tab Line Height */

/* Product Tab Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_page_tab_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_tab_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_tab_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Tab Letter Spacing */

/* Product Tab Font Weight */

$wp_customize->add_setting( 'litho_single_product_page_tab_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_page_tab_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_page_tab_font_weight',
	'type'              => 'select',
	'choices'           => array(
								''		=> esc_html__( 'Select Font Weight', 'litho' ),
								'100'	=> esc_html__( 'Font weight 100', 'litho' ),
								'200'	=> esc_html__( 'Font weight 200', 'litho' ),
								'300'	=> esc_html__( 'Font weight 300', 'litho' ),
								'400'	=> esc_html__( 'Font weight 400', 'litho' ),
								'500'	=> esc_html__( 'Font weight 500', 'litho' ),
								'600'	=> esc_html__( 'Font weight 600', 'litho' ),
								'700'	=> esc_html__( 'Font weight 700', 'litho' ),
								'800'	=> esc_html__( 'Font weight 800', 'litho' ),
								'900'	=> esc_html__( 'Font weight 900', 'litho' ),
						   ),
) ) );

/* End Product Tab Font Weight */

/* Product Tab Color */

$wp_customize->add_setting( 'litho_single_product_page_tab_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_page_tab_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_page_tab_color',
) ) );

/* End Product Tab Color */

/* Product Active Tab Color */

$wp_customize->add_setting( 'litho_single_product_page_tab_active_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_page_tab_active_color', array(
	'label'      		=> esc_html__( 'Active Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_page_tab_active_color',
) ) );

/* End Product Active Tab Color */

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_product_related_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_related_separator', array(
	'label'      		=> esc_html__( 'Related Product', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_related_separator',
) ) );

/* End Separator Settings */

/* Enable Related Product */

$wp_customize->add_setting( 'litho_single_product_enable_related', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_related', array(
	'label'       		=> esc_html__( 'Related Product', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_related',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Related Product */

/*  No. of related Product Column  */

$wp_customize->add_setting( 'litho_single_product_no_of_columns_related', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_single_product_no_of_columns_related', array(
	'label'       		=> esc_html__( 'No. of Columns', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_no_of_columns_related',
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
	'active_callback'   => 'litho_single_product_related_callback',
) ) );

/* End No. of related Product Column */

/*  No. of related Product  */

$wp_customize->add_setting( 'litho_single_product_no_of_products_related', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_no_of_products_related', array(
	'label'       		=> esc_html__( 'No. of Products', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_no_of_products_related',
	'type'      		=> 'select',
	'choices'    		=> array(
								'1' => esc_html__( '1', 'litho' ),
								'2' => esc_html__( '2', 'litho' ),
								'3' => esc_html__( '3', 'litho' ),
								'4' => esc_html__( '4', 'litho' ),
								'5' => esc_html__( '5', 'litho' ),
								'6' => esc_html__( '6', 'litho' )
							),
	'active_callback'   => 'litho_single_product_related_callback',
) ) );

/* End No. of related Product */

/* Related Product Heading Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_related_product_heading_typography', array(
	'label'      		=> esc_html__( 'Related Product Heading Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_related_product_heading_typography',
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Typography Separator setting */

/* Related Product Heading Font Size */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_related_product_heading_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_related_product_heading_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Font Size */

/* Related Product Heading Line Height */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_related_product_heading_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_related_product_heading_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Line Height */

/* Related Product Heading Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_related_product_heading_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_related_product_heading_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Letter Spacing */

/* Related Product Heading Font Weight */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_related_product_heading_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_related_product_heading_font_weight',
	'type'              => 'select',
	'choices'           => array(
								'' => esc_html__( 'Select Font Weight', 'litho' ),
								'100' => esc_html__( 'Font weight 100', 'litho' ),
								'200' => esc_html__( 'Font weight 200', 'litho' ),
								'300' => esc_html__( 'Font weight 300', 'litho' ),
								'400' => esc_html__( 'Font weight 400', 'litho' ),
								'500' => esc_html__( 'Font weight 500', 'litho' ),
								'600' => esc_html__( 'Font weight 600', 'litho' ),
								'700' => esc_html__( 'Font weight 700', 'litho' ),
								'800' => esc_html__( 'Font weight 800', 'litho' ),
								'900' => esc_html__( 'Font weight 900', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Font Weight */

/* Related Product Heading Font Italic */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_font_italic', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_related_product_heading_font_italic', array(
	'label'       		=> esc_html__( 'Font Italic', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_related_product_heading_font_italic',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Font Italic */

/* Related Product Heading Font Underline */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_font_underline', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_related_product_heading_font_underline', array(
	'label'       		=> esc_html__( 'Font Underline', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_related_product_heading_font_underline',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Font Underline */

/* Related Product Heading Color */

$wp_customize->add_setting( 'litho_single_product_related_product_heading_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_related_product_heading_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_related_product_heading_color',
	'active_callback'	=> 'litho_single_product_related_callback',
) ) );

/* End Related Product Heading Color */

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_product_up_sells_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_up_sells_separator', array(
	'label'      		=> esc_html__( 'Up Sells Product', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_up_sells_separator',
) ) );

/* End Separator Settings */

/* Enable Up Sells Product */

$wp_customize->add_setting( 'litho_single_product_enable_up_sells', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_up_sells', array(
	'label'       		=> esc_html__( 'Up Sells Product', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_up_sells',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Up Sells Product */

/*  No. of Up Sells Product Column  */

$wp_customize->add_setting( 'litho_single_product_no_of_columns_up_sells', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_single_product_no_of_columns_up_sells', array(
	'label'       		=> esc_html__( 'No. of Columns', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_no_of_columns_up_sells',
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
	'active_callback'   => 'litho_single_product_up_sells_callback',
) ) );

/* End No. of Up Sells Product Column */

/*  No. of Up Sells Product  */

$wp_customize->add_setting( 'litho_single_product_no_of_products_up_sells', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_no_of_products_up_sells', array(
	'label'       		=> esc_html__( 'No. of Products', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_no_of_products_up_sells',
	'type'      		=> 'select',
	'choices'    		=> array(
								'1' => esc_html__( '1', 'litho' ),
								'2' => esc_html__( '2', 'litho' ),
								'3' => esc_html__( '3', 'litho' ),
								'4' => esc_html__( '4', 'litho' ),
								'5' => esc_html__( '5', 'litho' ),
								'6' => esc_html__( '6', 'litho' )
							),
	'active_callback'   => 'litho_single_product_up_sells_callback',
) ) );

/* End No. of Up Sells Product */

/* Up Sells Product Heading Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_typography', array(
	'label'      		=> esc_html__( 'Up Sells Heading Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_up_sells_product_heading_typography',
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Typography Separator setting */

/* Up Sells Product Heading Font Size */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_up_sells_product_heading_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Font Size */

/* Up Sells Product Heading Line Height */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_up_sells_product_heading_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Line Height */

/* Up Sells Product Heading Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_up_sells_product_heading_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Letter Spacing */

/* Up Sells Product Heading Font Weight */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_up_sells_product_heading_font_weight',
	'type'              => 'select',
	'choices'           => array(
								'' => esc_html__( 'Select Font Weight', 'litho' ),
								'100' => esc_html__( 'Font weight 100', 'litho' ),
								'200' => esc_html__( 'Font weight 200', 'litho' ),
								'300' => esc_html__( 'Font weight 300', 'litho' ),
								'400' => esc_html__( 'Font weight 400', 'litho' ),
								'500' => esc_html__( 'Font weight 500', 'litho' ),
								'600' => esc_html__( 'Font weight 600', 'litho' ),
								'700' => esc_html__( 'Font weight 700', 'litho' ),
								'800' => esc_html__( 'Font weight 800', 'litho' ),
								'900' => esc_html__( 'Font weight 900', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Font Weight */

/* Up Sells Product Heading Font Italic */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_font_italic', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_font_italic', array(
	'label'       		=> esc_html__( 'Font Italic', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_up_sells_product_heading_font_italic',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Font Italic */

/* Up Sells Product Heading Font Underline */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_font_underline', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_font_underline', array(
	'label'       		=> esc_html__( 'Font Underline', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_up_sells_product_heading_font_underline',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Font Underline */

/* Up Sells Product Heading Color */

$wp_customize->add_setting( 'litho_single_product_up_sells_product_heading_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_up_sells_product_heading_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_up_sells_product_heading_color',
	'active_callback'	=> 'litho_single_product_up_sells_callback',
) ) );

/* End Up Sells Product Heading Color */

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_product_cross_sells_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_cross_sells_separator', array(
	'label'      		=> esc_html__( 'Cross Sells Product', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_cross_sells_separator',
) ) );

/* End Separator Settings */

/* Enable Cross Sells Product */

$wp_customize->add_setting( 'litho_single_product_enable_cross_sells', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_enable_cross_sells', array(
	'label'       		=> esc_html__( 'Cross Sells Product On Cart', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_enable_cross_sells',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Cross Sells Product */

/*  No. of Cross Sells Product Column  */

$wp_customize->add_setting( 'litho_single_product_no_of_columns_cross_sells', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_single_product_no_of_columns_cross_sells', array(
	'label'       		=> esc_html__( 'No. of Columns', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_no_of_columns_cross_sells',
	'type'              => 'litho_preview_image',
	'choices'    		=> array(
								'2' => esc_html__( '2', 'litho' ),
								'3' => esc_html__( '3', 'litho' )
							),
	'litho_img'			=> array(
								LITHO_THEME_IMAGES_URI . '/2-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/3-columns.jpg',
						   ),
	'litho_columns'    	=> '3',
	'active_callback'   => 'litho_single_product_cross_sells_callback',
) ) );

/* End No. of Cross Sells Product Column */

/*  No. of Cross Sells Product  */

$wp_customize->add_setting( 'litho_single_product_no_of_products_cross_sells', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_no_of_products_cross_sells', array(
	'label'       		=> esc_html__( 'No. of Products', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_no_of_products_cross_sells',
	'type'      		=> 'select',
	'choices'    		=> array(
								'1' => esc_html__( '1', 'litho' ),
								'2' => esc_html__( '2', 'litho' ),
								'3' => esc_html__( '3', 'litho' ),
								'4' => esc_html__( '4', 'litho' ),
								'5' => esc_html__( '5', 'litho' ),
								'6' => esc_html__( '6', 'litho' )
							),
	'active_callback'   => 'litho_single_product_cross_sells_callback',
) ) );

/* End No. of Cross Sells Product */

/* Cross Sells Product Heading Typography Separator setting */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_typography', array(
	'label'      		=> esc_html__( 'Cross Sells Heading Typography', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'   		=> 'litho_single_product_cross_sells_product_heading_typography',
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Typography Separator setting */

/* Cross Sells Product Heading Font Size */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_cross_sells_product_heading_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Font Size */

/* Cross Sells Product Heading Line Height */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_cross_sells_product_heading_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Line Height */

/* Cross Sells Product Heading Letter Spacing */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_cross_sells_product_heading_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Letter Spacing */

/* Cross Sells Product Heading Font Weight */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_cross_sells_product_heading_font_weight',
	'type'              => 'select',
	'choices'           => array(
								'' => esc_html__( 'Select Font Weight', 'litho' ),
								'100' => esc_html__( 'Font weight 100', 'litho' ),
								'200' => esc_html__( 'Font weight 200', 'litho' ),
								'300' => esc_html__( 'Font weight 300', 'litho' ),
								'400' => esc_html__( 'Font weight 400', 'litho' ),
								'500' => esc_html__( 'Font weight 500', 'litho' ),
								'600' => esc_html__( 'Font weight 600', 'litho' ),
								'700' => esc_html__( 'Font weight 700', 'litho' ),
								'800' => esc_html__( 'Font weight 800', 'litho' ),
								'900' => esc_html__( 'Font weight 900', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Font Weight */

/* Cross Sells Product Heading Font Italic */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_font_italic', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_font_italic', array(
	'label'       		=> esc_html__( 'Font Italic', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_cross_sells_product_heading_font_italic',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Font Italic */

/* Cross Sells Product Heading Font Underline */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_font_underline', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_font_underline', array(
	'label'       		=> esc_html__( 'Font Underline', 'litho' ),
	'section'     		=> 'litho_add_product_layout_panel',
	'settings'			=> 'litho_single_product_cross_sells_product_heading_font_underline',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Font Underline */

/* Cross Sells Product Heading Color */

$wp_customize->add_setting( 'litho_single_product_cross_sells_product_heading_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_single_product_cross_sells_product_heading_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_layout_panel',
	'settings'	 		=> 'litho_single_product_cross_sells_product_heading_color',
	'active_callback'	=> 'litho_single_product_cross_sells_callback',
) ) );

/* End Cross Sells Product Heading Color */

/* Custom Callback Functions */

if ( ! function_exists( 'litho_single_product_share_title_callback' ) ) :
	function litho_single_product_share_title_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_enable_social_share' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_product_sale_border_callback' ) ) :
	function litho_single_product_sale_border_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_sale_enable_border' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_product_page_title_callback' ) ) :
	function litho_single_product_page_title_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_enable_title' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_product_short_description_callback' ) ) :
	function litho_single_product_short_description_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_enable_short_description' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_product_stock_border_callback' ) ) :
	function litho_single_product_stock_border_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_stock_enable_border' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_product_related_callback' ) ) :
	function litho_single_product_related_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_enable_related' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_product_up_sells_callback' ) ) :
	function litho_single_product_up_sells_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_enable_up_sells' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_product_cross_sells_callback' ) ) :
	function litho_single_product_cross_sells_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_single_product_enable_cross_sells' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Custom Callback Functions */
