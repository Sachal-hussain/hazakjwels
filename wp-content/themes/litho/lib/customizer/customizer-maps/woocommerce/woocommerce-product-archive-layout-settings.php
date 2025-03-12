<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get All Register Sidebar List.
$litho_sidebar_array = litho_register_sidebar_customizer_array(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/* Separator Settings */
$wp_customize->add_setting( 'litho_archive_product_layout_container_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_archive_product_layout_container_separator', array(
	'label'				=> esc_html__( 'Layout and Container', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_archive_product_layout_container_separator',
) ) );

/* End Separator Settings */

/* Archive Layout For Post */
$wp_customize->add_setting( 'litho_product_layout_setting_archive', array(
	'default' 			=> 'litho_layout_right_sidebar',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_product_layout_setting_archive', array(
	'label'				=> esc_html__( 'Layout style', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_layout_setting_archive',
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

$wp_customize->add_setting( 'litho_product_left_sidebar_archive', array(
	'default' 			=> 'litho-shop-1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_left_sidebar_archive', array(
	'label'				=> esc_html__( 'Left sidebar', 'litho' ),
	'section'			=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_left_sidebar_archive',
	'type'				=> 'select',
	'choices'			=> $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_product_left_sidebar_layout_archive_callback',
) ) );

/* End Archive Left Sidebar */

/* Archive Right Sidebar */
$wp_customize->add_setting( 'litho_product_right_sidebar_archive', array(
	'default' 			=> 'litho-shop-1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_right_sidebar_archive', array(
	'label'				=> esc_html__( 'Right sidebar', 'litho' ),
	'section'			=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_right_sidebar_archive',
	'type'				=> 'select',
	'choices'			=> $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_product_right_sidebar_layout_archive_callback',
) ) );

/* End Archive Right Sidebar */

/* Archive Container Setting */

$wp_customize->add_setting( 'litho_product_container_style_archive', array(
	'default' 			=> 'container',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_container_style_archive', array(
	'label'				=> esc_html__( 'Container style', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_container_style_archive',
	'type'              => 'select',
	'choices'           => array(
				'container'						=> esc_html__( 'Fixed', 'litho' ),
				'container-fluid'				=> esc_html__( 'Full width', 'litho' ),
				'container-fluid-with-padding'	=> esc_html__( 'Full width ( with paddings )', 'litho' ),
		   ),	
) ) );

/* End Archive Container Setting */

/* Container custom Width setting */
$wp_customize->add_setting( 'litho_product_container_fluid_with_padding_archive', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_container_fluid_with_padding_archive', array(
	'label'				=> esc_html__( 'Full width padding', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_container_fluid_with_padding_archive',
	'type'              => 'text',
	'active_callback'	=> 'litho_product_container_fluid_with_padding_archive_callback'
) ) );

/* End Container custom Width setting */

/* Archive Show Description Setting */

$wp_customize->add_setting( 'litho_show_product_archive_description_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_show_product_archive_description_archive', array(
	'label'       		=> esc_html__( 'Description', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_show_product_archive_description_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Archive Show Description Setting */

/* Main Section Top Space */

$wp_customize->add_setting( 'litho_product_top_space_archive', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_product_top_space_archive', array(
	'label'				=> esc_html__( 'Add top space of header height', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_top_space_archive',
	'description'       => esc_html__( 'Note: Setting will work while you have setup page without Elementor & Page title.', 'litho' ),		
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Main Section Top Space */


/* Product Rich Snippet */

$wp_customize->add_setting( 'litho_product_rich_snippet_archive', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_product_rich_snippet_archive', array(
	'label'				=> esc_html__( 'Rich Snippet', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_rich_snippet_archive',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Product Rich Snippet */


/* Separator Settings */
$wp_customize->add_setting( 'litho_product_archive_style_data_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_style_data_separator', array(
	'label'      		=> esc_html__( 'Product Lists Style and Data', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'   		=> 'litho_product_archive_style_data_separator',
) ) );

/* End Separator Settings */

/* Product Archive Column Type Setting */

$wp_customize->add_setting( 'litho_product_archive_page_column', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_product_archive_page_column', array(
	'label'       		=> esc_html__( 'Column Type', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_page_column',
	'type'              => 'litho_preview_image',
	'choices'           => array(
								'2' => esc_html__( '2 Columns', 'litho' ),
								'3' => esc_html__( '3 Columns', 'litho' ),
								'4' => esc_html__( '4 Columns', 'litho' ),
								'5' => esc_html__( '5 Columns', 'litho' ),
								'6' => esc_html__( '6 Columns', 'litho' ),
						   ),
	'litho_img'			=> array(
								LITHO_THEME_IMAGES_URI . '/2-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/3-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/4-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/5-columns.jpg',
								LITHO_THEME_IMAGES_URI . '/6-columns.jpg',
						   ),
	'litho_columns'    	=> '3',
) ) );

/* End Product Archive Column Type Setting */

/*  No. of Product Per Page  */

$wp_customize->add_setting( 'litho_product_archive_page_per_page', array(
	'default' 			=> '12',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_page_per_page', array(
	'label'       		=> esc_html__( 'Products Per Page', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_page_per_page',
	'type'      		=> 'text',
) ) );

/* End No. of Product Per Page */

/* Enable Alternate Product Image */

$wp_customize->add_setting( 'litho_product_archive_enable_alternate_image', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_product_archive_enable_alternate_image', array(
	'label'				=> esc_html__( 'Alternate image', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_enable_alternate_image',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							)
) ) );

/* End Enable Alternate Product Image */

/* Enable Product Star Rating */

$wp_customize->add_setting( 'litho_product_archive_enable_star_rating', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_product_archive_enable_star_rating', array(
	'label'       		=> esc_html__( 'Star Rating', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_enable_star_rating',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Enable Product Star Rating */

/* Product Archive Sale Typography Separator setting */

$wp_customize->add_setting( 'litho_product_archive_product_sale_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_product_sale_typography', array(
	'label'      		=> esc_html__( 'Sale Typography and Colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'   		=> 'litho_product_archive_product_sale_typography',
) ) );

/* End Product Archive Sale Typography Separator setting */

/* Product Archive Sale Font Size */

$wp_customize->add_setting( 'litho_product_archive_product_sale_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_sale_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_sale_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Archive Sale Font Size */

/* Product Archive Sale Line Height */

$wp_customize->add_setting( 'litho_product_archive_product_sale_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_sale_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_sale_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Archive Sale Line Height */

/* Product Archive Sale Font Weight */

$wp_customize->add_setting( 'litho_product_archive_product_sale_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_sale_font_weight', array(
	'label'				=> esc_html__( 'Font Weight', 'litho' ),
	'section'			=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_sale_font_weight',
	'type'				=> 'select',
	'choices'			=> array(
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

/* End Product Archive Sale Font Weight */

/* Product Archive Sale Color */

$wp_customize->add_setting( 'litho_product_archive_product_sale_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_sale_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_sale_color',
) ) );

/* End Product Archive Sale Color */

/* Product Archive Sale Background Color setting */

$wp_customize->add_setting( 'litho_product_archive_product_sale_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_sale_bg_color', array(
	'label'      		=> esc_html__( 'Background Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_sale_bg_color',
) ) );

/* Product Archive Sale Background Color setting */

/* Product Archive Show Box Sale Border setting */

$wp_customize->add_setting( 'litho_product_archive_product_sale_enable_border', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_product_archive_product_sale_enable_border', array(
	'label'       		=> esc_html__( 'Box Border', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_sale_enable_border',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* Product Archive Show Box Sale Border setting */

/* Product Archive Sale Border Type setting */

$wp_customize->add_setting( 'litho_product_archive_product_sale_border_type', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_sale_border_type', array(
	'label'       		=> esc_html__( 'Box Border Type', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_sale_border_type',
	'type'              => 'select',
	'choices'           => array(
								''			=> esc_html__( 'Select Border Type', 'litho' ),
								'dotted' 	=> esc_html__( 'Dotted', 'litho' ),
								'dashed'	=> esc_html__( 'Dashed', 'litho' ),
								'solid'		=> esc_html__( 'Solid', 'litho' ),
								'double'	=> esc_html__( 'Double', 'litho' ),
							   ),
	'active_callback'	=> 'litho_product_archive_product_sale_border_callback',
) ) );

/* End Product Archive Sale Border Type setting */

/* Product Archive Sale Border Size setting */

$wp_customize->add_setting( 'litho_product_archive_product_sale_border_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_sale_border_size', array(
	'label'       		=> esc_html__( 'Box Border Size', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_sale_border_size',
	'type'              => 'text',
	'active_callback'	=> 'litho_product_archive_product_sale_border_callback',
) ) );

/* End Product Archive Sale Border Size setting */

/* Product Archive Sale Border Color */

$wp_customize->add_setting( 'litho_product_archive_product_sale_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_sale_border_color', array(
	'label'      		=> esc_html__( 'Box Border Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_sale_border_color',
	'active_callback'	=> 'litho_product_archive_product_sale_border_callback',
) ) );

/* End Product Archive Sale Border Color */

/* Product Archive Title Typography Separator setting */

$wp_customize->add_setting( 'litho_product_archive_product_title_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_product_title_typography', array(
	'label'      		=> esc_html__( 'Title Typography and Colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'   		=> 'litho_product_archive_product_title_typography',
) ) );

/* End Product Archive Title Typography Separator setting */

/* Product Archive Title Font Size */

$wp_customize->add_setting( 'litho_product_archive_product_title_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_title_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_title_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Archive Title Font Size */

/* Product Archive Title Line Height */

$wp_customize->add_setting( 'litho_product_archive_product_title_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_title_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_title_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Archive Title Line Height */

/* Product Archive Title Letter Spacing */

$wp_customize->add_setting( 'litho_product_archive_product_title_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_title_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter Spacing', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_title_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Archive Title Letter Spacing */

/* Product Archive Title Font Weight */

$wp_customize->add_setting( 'litho_product_archive_product_title_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_title_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_title_font_weight',
	'type'              => 'select',
	'choices'           => array(
								'' 		=> esc_html__( 'Select Font Weight', 'litho' ),
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

/* End Product Archive Title Font Weight */

/* Product Archive Font Italic */

$wp_customize->add_setting( 'litho_product_archive_product_title_font_italic', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_product_archive_product_title_font_italic', array(
	'label'       		=> esc_html__( 'Font Italic', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_title_font_italic',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Product Archive Font Italic */

/* Product Archive Font Underline */

$wp_customize->add_setting( 'litho_product_archive_product_title_font_underline', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_switch_Control( $wp_customize, 'litho_product_archive_product_title_font_underline', array(
	'label'       		=> esc_html__( 'Font Underline', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_title_font_underline',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Product Archive Font Underline */

/* Product Archive Title Color */

$wp_customize->add_setting( 'litho_product_archive_product_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_title_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_title_color',
) ) );

/* End Product Archive Title Color */

/* Product Archive Hover Title Color */

$wp_customize->add_setting( 'litho_product_archive_product_title_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_title_hover_color', array(
	'label'      		=> esc_html__( 'Hover Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_title_hover_color',
) ) );

/* End Product Archive Hover Title Color */

/* Product Archive Rating Star Color Separator setting */

$wp_customize->add_setting( 'litho_product_archive_product_rating_star_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_product_rating_star_typography', array(
	'label'      		=> esc_html__( 'Rating Star Color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'   		=> 'litho_product_archive_product_rating_star_typography',
	'active_callback'	=> 'litho_product_archive_product_rating_star_color_callback',
) ) );

/* End Product Archive Rating Star Color Separator setting */

/* Product Archive Rating Star Color */

$wp_customize->add_setting( 'litho_product_archive_product_rating_star_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_rating_star_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_rating_star_color',
	'active_callback'	=> 'litho_product_archive_product_rating_star_color_callback',
) ) );

/* End Product Archive Rating Star Color */

/* Product Archive Price Typography Separator setting */

$wp_customize->add_setting( 'litho_product_archive_product_price_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_product_price_typography', array(
	'label'      		=> esc_html__( 'Price Typography and Colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'   		=> 'litho_product_archive_product_price_typography',
) ) );

/* End Product Archive Price Typography Separator setting */

/* Product Archive Price Font Size */

$wp_customize->add_setting( 'litho_product_archive_product_price_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_price_font_size', array(
	'label'       		=> esc_html__( 'Font Size', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_price_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
) ) );

/* End Product Archive Price Font Size */

/* Product Archive Price Line Height */

$wp_customize->add_setting( 'litho_product_archive_product_price_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_price_line_height', array(
	'label'       		=> esc_html__( 'Line Height', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_price_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
) ) );

/* End Product Archive Price Line Height */

/* Product Archive Price Font Weight */

$wp_customize->add_setting( 'litho_product_archive_product_price_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_product_archive_product_price_font_weight', array(
	'label'       		=> esc_html__( 'Font Weight', 'litho' ),
	'section'     		=> 'litho_add_product_archive_layout_panel',
	'settings'			=> 'litho_product_archive_product_price_font_weight',
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

/* End Product Archive Price Font Weight */

/* Product Archive Price Color */

$wp_customize->add_setting( 'litho_product_archive_product_price_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_price_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_price_color',
) ) );

/* End Product Archive Price Color */

/* Product Archive Main Price Color */

$wp_customize->add_setting( 'litho_product_archive_product_regular_price_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_regular_price_color', array(
	'label'      		=> esc_html__( 'Main Price Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_regular_price_color',
) ) );

/* End Product Archive Main Price Color */

/* Product Archive Button Separator setting */

$wp_customize->add_setting( 'litho_product_archive_product_button_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_archive_product_button_typography', array(
	'label'      		=> esc_html__( 'Button Typography and Colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'   		=> 'litho_product_archive_product_button_typography',
) ) );

/* End Product Archive Button Separator setting */

/* Product Archive Button color setting */

$wp_customize->add_setting( 'litho_product_archive_product_button_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_button_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_button_color',
) ) );

/* End Product Archive Button color setting */

/* Product Archive Button BG color setting */

$wp_customize->add_setting( 'litho_product_archive_product_button_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_button_bg_color', array(
	'label'      		=> esc_html__( 'Background Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_button_bg_color',
) ) );

/* End Product Archive Button BG color setting */

/* Product Archive Button Hover color setting */

$wp_customize->add_setting( 'litho_product_archive_product_button_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_button_hover_color', array(
	'label'      		=> esc_html__( 'Hover Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_button_hover_color',
) ) );

/* End Product Archive Button Hover color setting */

/* Product Archive Button Hover BG color setting */

$wp_customize->add_setting( 'litho_product_archive_product_button_hover_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_product_archive_product_button_hover_bg_color', array(
	'label'      		=> esc_html__( 'Hover Background Color', 'litho' ),
	'section'    		=> 'litho_add_product_archive_layout_panel',
	'settings'	 		=> 'litho_product_archive_product_button_hover_bg_color',
) ) );

/* End Product Archive Button Hover BG color setting */

if ( ! function_exists( 'litho_product_archive_product_rating_star_color_callback' ) ) :
	function litho_product_archive_product_rating_star_color_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_product_archive_enable_star_rating' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_product_archive_product_sale_border_callback' ) ) :
	function litho_product_archive_product_sale_border_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_product_archive_product_sale_enable_border' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_product_left_sidebar_layout_archive_callback' ) ) :
	function litho_product_left_sidebar_layout_archive_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_product_layout_setting_archive' )->value() == 'litho_layout_left_sidebar' || $control->manager->get_setting( 'litho_product_layout_setting_archive' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_product_right_sidebar_layout_archive_callback' ) ) :
	function litho_product_right_sidebar_layout_archive_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_product_layout_setting_archive' )->value() == 'litho_layout_right_sidebar' || $control->manager->get_setting( 'litho_product_layout_setting_archive' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_product_container_fluid_with_padding_archive_callback' ) ) :
	function litho_product_container_fluid_with_padding_archive_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_product_container_style_archive' )->value() == 'container-fluid-with-padding' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
