<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get All Register Sidebar List.
$litho_sidebar_array = litho_register_sidebar_customizer_array(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_post_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_post_separator', array(
	'label'				=> esc_html__( 'Layout and container', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'   		=> 'litho_single_post_separator',
) ) );

/* End Separator Settings */

/* General Layout For Post */

$wp_customize->add_setting( 'litho_post_layout_setting', array(
	'default' 			=> 'litho_layout_right_sidebar',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_post_layout_setting', array(
	'label'				=> esc_html__( 'Layout style', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_layout_setting',
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

/* End General Layout For Post */

/* Post Left Sidebar */

$wp_customize->add_setting( 'litho_post_left_sidebar', array(
	'default' 			=> 'sidebar-1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_left_sidebar', array(
	'label'				=> esc_html__( 'Left sidebar', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_left_sidebar',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'   => 'litho_post_left_sidebar_layout_callback',
) ) );

/* End Post Left Sidebar */

/* Post Right Sidebar */

$wp_customize->add_setting( 'litho_post_right_sidebar', array(
	'default' 			=> 'sidebar-1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_right_sidebar', array(
	'label'				=> esc_html__( 'Right sidebar', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_right_sidebar',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'   => 'litho_post_right_sidebar_layout_callback',
) ) );

/* End Post Right Sidebar */

/* Post Container Setting */

$wp_customize->add_setting( 'litho_post_container_style', array(
	'default' 			=> 'container',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_container_style', array(
	'label'				=> esc_html__( 'Container style', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_container_style',
	'type'              => 'select',
	'choices'           => array(
								'container'						=> esc_html__( 'Fixed', 'litho' ),
								'container-fluid'				=> esc_html__( 'Full width', 'litho' ),
								'container-fluid-with-padding' 	=> esc_html__( 'Full width ( with paddings )', 'litho' ),
						   ),	
) ) );

/* End Post Container Setting */

/* Container custom Width setting */

$wp_customize->add_setting( 'litho_post_container_fluid_with_padding', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_container_fluid_with_padding', array(
	'label'				=> esc_html__( 'Full width padding', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_container_fluid_with_padding',
	'type'              => 'text',
	'active_callback'	=> 'litho_post_container_fluid_with_padding_callback',
) ) );

/* End Container custom Width setting */

/* Start Within Content Area */

$wp_customize->add_setting( 'litho_post_within_content_area', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_within_content_area', array(
	'label'				=> esc_html__( 'Within content area', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_within_content_area',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Within Content Area */

/* Separator Settings */
$wp_customize->add_setting( 'litho_single_post_style_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_post_style_separator', array(
	'label'				=> esc_html__( 'Post style and data', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'   		=> 'litho_single_post_style_separator',
) ) );

/* End Separator Settings */

/* Post Style Setting */

$wp_customize->add_setting( 'litho_post_layout_style', array(
	'default' 			=> 'post-layout-standard',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_layout_style', array(
	'label'				=> esc_html__( 'Post style', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_layout_style',
	'type'              => 'select',
	'choices'           => array(
								''							=> esc_html__( 'Select', 'litho' ),
								'post-layout-standard'		=> esc_html__( 'Post Layout Standard', 'litho' ),
								'post-layout-style-1'		=> esc_html__( 'Post Layout Style 1', 'litho' ),
								'post-layout-style-2'		=> esc_html__( 'Post Layout Style 2', 'litho' ),
								'post-layout-style-3'		=> esc_html__( 'Post Layout Style 3', 'litho' ),
								'post-layout-style-4'		=> esc_html__( 'Post Layout Style 4', 'litho' ),
								'post-layout-style-5'		=> esc_html__( 'Post Layout Style 5', 'litho' )
						   ),
) ) );

/* End Post Style Setting */

/* Hide Feature Image */

$wp_customize->add_setting( 'litho_featured_image', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_featured_image', array(
	'label'				=> esc_html__( 'Featured image', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_featured_image',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Hide Feature Image */


/* Start Heading Tag */

$wp_customize->add_setting( 'litho_heading_tag', array(
	'default' 			=> 'h1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_heading_tag', array(
	'label'				=> esc_html__( 'Heading tag', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_heading_tag',
	'type'              => 'select',
	'choices'           => array(
								'h1' => esc_html__( 'H1', 'litho' ),
								'h2' => esc_html__( 'H2', 'litho' ),
								'h3' => esc_html__( 'H3', 'litho' ),
								'h4' => esc_html__( 'H4', 'litho' ),
								'h5' => esc_html__( 'H5', 'litho' ),
								'h6' => esc_html__( 'H6', 'litho' ),
						   ),	
) ) );

/* End Heading Tag*/

/* Hide Post Title */

$wp_customize->add_setting( 'litho_enable_post_title', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_post_title', array(
	'label'				=> esc_html__( 'Title', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_post_title',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Hide Post Title */

/* Hide Date */

$wp_customize->add_setting( 'litho_enable_date', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_date', array(
	'label'				=> esc_html__( 'Date', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_date',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Hide Date */

/* Post Date Format */

$wp_customize->add_setting( 'litho_post_date_format', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_date_format', array(
	'label'				=> esc_html__( 'Date format', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_date_format',
	'type'              => 'text',
	'description'		=> sprintf(
								'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
								esc_html__( 'Date format should be like F j, Y', 'litho' ),
								esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
								esc_html__( 'click here', 'litho' ),
								esc_html__( 'to see other date formates.', 'litho' ),
							),
	'active_callback'   => 'litho_post_date_callback',
) ) );

/* End Post Date Format */

/* Hide Author */

$wp_customize->add_setting( 'litho_enable_author', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_author', array(
	'label'				=> esc_html__( 'Author', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_author',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Hide Author */

/* Hide Category */

$wp_customize->add_setting( 'litho_enable_category', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_category', array(
	'label'				=> esc_html__( 'Category', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_category',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Category */

/* Hide Tags */

$wp_customize->add_setting( 'litho_enable_tags', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_tags', array(
	'label'				=> esc_html__( 'Tags', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_tags',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Tags */

/* Hide Navigation Links */

$wp_customize->add_setting( 'litho_enable_navigation_link', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_navigation_link', array(
	'label'				=> esc_html__( 'Navigation link', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_navigation_link',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Navigation Links */

if ( is_litho_addons_activated() ) {

	/* Hide Like */
	$wp_customize->add_setting( 'litho_enable_like', array(
		'default' 			=> '0',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_like', array(
		'label'				=> esc_html__( 'Like', 'litho' ),
		'section'     		=> 'litho_add_post_layout_panel',
		'settings'			=> 'litho_enable_like',
		'type'              => 'litho_switch',
		'choices'           => array(
									'1' => esc_html__( 'On', 'litho' ),
									'0' => esc_html__( 'Off', 'litho' ),
							   ),
	) ) );

	/* End Hide Like */

	/* Hide Share */

	$wp_customize->add_setting( 'litho_enable_share', array(
		'default' 			=> '1',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_share', array(
		'label'				=> esc_html__( 'Share', 'litho' ),
		'section'     		=> 'litho_add_post_layout_panel',
		'settings'			=> 'litho_enable_share',
		'type'              => 'litho_switch',
		'choices'           => array(
									'1' => esc_html__( 'On', 'litho' ),
									'0' => esc_html__( 'Off', 'litho' ),
							   ),
	) ) );

	/* End Hide Share */
}


/* Hide Post Author Box */

$wp_customize->add_setting( 'litho_enable_post_author_box', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_post_author_box', array(
	'label'				=> esc_html__( 'Author box', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_post_author_box',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Post Author Box */

/* Author Button Title */

$wp_customize->add_setting( 'litho_author_box_button_title', array(
	'default' 			=> esc_html__( 'All author posts', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_author_box_button_title', array(
	'label'				=> esc_html__( 'Author box button title', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_author_box_button_title',
	'type'              => 'text',
	'active_callback'   => 'litho_author_box_callback',
) ) );

/* End Author Button Title */

/* Hide Comment */

$wp_customize->add_setting( 'litho_enable_comment', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_comment', array(
	'label'				=> esc_html__( 'Comment', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_comment',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Hide Comment */

/* Single Post BG Pattern image */

$wp_customize->add_setting( 'litho_single_post_bg_pattern', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'litho_single_post_bg_pattern', array(
	'label'       		=> esc_html__( 'Background pattern image', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_single_post_bg_pattern',
	'active_callback'   => 'litho_single_post_bg_pattern_callback',
) ) );

/* End Single Post BG Pattern image */

/* Main Section Top Space */

$wp_customize->add_setting( 'litho_single_post_top_space', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_single_post_top_space', array(
	'label'				=> esc_html__( 'Add top space of header height', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_single_post_top_space',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Main Section Top Space */

/* Post Rich Snippet */

$wp_customize->add_setting( 'litho_post_rich_snippet', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_rich_snippet', array(
	'label'				=> esc_html__( 'Rich Snippet', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_post_rich_snippet',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End Post Rich Snippet */


/* Separator Settings */
$wp_customize->add_setting( 'litho_single_post_related_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_single_post_related_separator', array(
	'label'				=> esc_html__( 'Related posts', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_single_post_related_separator',
) ) );

/* End Separator Settings */

/* Hide Related Posts */

$wp_customize->add_setting( 'litho_enable_related_posts', array(
	'default' 			=> '1',
	'sanitize_callback'	=> 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_enable_related_posts', array(
	'label'				=> esc_html__( 'Related posts', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_enable_related_posts',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Hide Related Posts */

/*  No. of Columns  */

$wp_customize->add_setting( 'litho_no_of_related_posts_columns', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_no_of_related_posts_columns', array(
	'label'				=> esc_html__( 'No. of columns', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_no_of_related_posts_columns',
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
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End No. of Columns */

/* Featured Image Size */

$wp_customize->add_setting( 'litho_related_post_feature_image_size', array(
	'default' 			=> 'full',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Image_SRCSET_Control( $wp_customize, 'litho_related_post_feature_image_size', array(
	'label'				=> esc_html__( 'Post thumbnail size', 'litho' ),
	'type'              => 'litho_image_srcset',
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_feature_image_size',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Featured Image Size */

/* Related Post Block Title */

$wp_customize->add_setting( 'litho_related_posts_title', array(
	'default' 			=> esc_html__( 'Related Posts', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_related_posts_title', array(
	'label'				=> esc_html__( 'Title', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_posts_title',
	'type'              => 'text',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Block Title */

/* Related Post Block Subtitle */

$wp_customize->add_setting( 'litho_related_posts_subtitle', array(
	'default' 			=> esc_html__( 'YOU MAY ALSO LIKE', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_related_posts_subtitle', array(
	'label'				=> esc_html__( 'Subtitle', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_posts_subtitle',
	'type'              => 'text',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Block Subtitle */

/*  No. of related post  */

$wp_customize->add_setting( 'litho_no_of_related_posts', array(
	'default' 			=> '3',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_no_of_related_posts', array(
	'label'				=> esc_html__( 'No. of posts', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_no_of_related_posts',
	'type'      		=> 'select',
	'choices'    		=> array(
								'1' => esc_html__( '1', 'litho' ),
								'2' => esc_html__( '2', 'litho' ),
								'3' => esc_html__( '3', 'litho' ),
								'4' => esc_html__( '4', 'litho' ),
								'5' => esc_html__( '5', 'litho' ),
								'6' => esc_html__( '6', 'litho' )
							),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End No. of related post */

/* Hide Related Block Thumbnail */

$wp_customize->add_setting( 'litho_related_posts_enable_post_thumbnail', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_posts_enable_post_thumbnail', array(
	'label'				=> esc_html__( 'Post thumbnail', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_posts_enable_post_thumbnail',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Hide Related Block Thumbnail */

/* Hide Related Block Date */

$wp_customize->add_setting( 'litho_related_posts_enable_date', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_posts_enable_date', array(
	'label'				=> esc_html__( 'Post date', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_posts_enable_date',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Hide Related Block Date */

/* Related Post Block Date */

$wp_customize->add_setting( 'litho_related_posts_date_format', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_related_posts_date_format', array(
	'label'				=> esc_html__( 'Post date format', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_posts_date_format',
	'type'              => 'text',
	'description'		=> sprintf(
								'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
								esc_html__( 'Date format should be like F j, Y', 'litho' ),
								esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
								esc_html__( 'click here', 'litho' ),
								esc_html__( 'to see other date formates.', 'litho' ),
							),
	'active_callback'   => 'litho_related_posts_date_callback',
) ) );

/* End Related Post Block Date */

/* Hide Related Block Date */

$wp_customize->add_setting( 'litho_related_posts_enable_author', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_posts_enable_author', array(
	'label'				=> esc_html__( 'Post author', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_posts_enable_author',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Hide Related Block Date */

/* Hide Related Excerpt */
$wp_customize->add_setting( 'litho_related_post_excerpt', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_post_excerpt', array(
	'label'				=> esc_html__( 'Post excerpt', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_excerpt',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Excerpt */

/* Excerpt Length */

$wp_customize->add_setting( 'litho_related_post_excerpt_length', array(
	'default' 			=> '35',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_related_post_excerpt_length', array(
	'label'				=> esc_html__( 'Excerpt length', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_excerpt_length',
	'type'       		=> 'text',
	'active_callback'   => 'litho_related_posts_excerpt_callback',
) );

/* End Excerpt Length  */


/* Hide Related Excerpt */
$wp_customize->add_setting( 'litho_related_post_enable_button', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_post_enable_button', array(
	'label'				=> esc_html__( 'Read more', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_enable_button',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Excerpt */

/* Read more text */

$wp_customize->add_setting( 'litho_related_post_button_text', array(
	'default' 			=> esc_html__( 'Read more', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_related_post_button_text', array(
	'label'				=> esc_html__( 'Read more text', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_button_text',
	'type'       		=> 'text',
	'active_callback'   => 'litho_related_post_button_callback',
) );

/* End Read more text  */

/* Hide Category */

$wp_customize->add_setting( 'litho_related_post_enable_category', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_post_enable_category', array(
	'label'				=> esc_html__( 'Post Terms', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_enable_category',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );


$wp_customize->add_setting(
	'litho_related_post_terms',
	array(
		'default'           => 'category',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_related_post_terms',
		array(
			'label'    => esc_html__( 'Select Post Terms', 'litho' ),
			'section'  => 'litho_add_post_layout_panel',
			'settings' => 'litho_related_post_terms',
			'type'     => 'select',
			'choices'  => array(
				'category' => esc_html__( 'Category', 'litho' ),
				'tags'     => esc_html__( 'Tags', 'litho' ),
			),
			'active_callback'   => 'litho_related_posts_terms_callback',
		)
	)
);

/* End Hide Category */

/* Hide Comment */

$wp_customize->add_setting( 'litho_related_post_enable_comment', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_post_enable_comment', array(
	'label'				=> esc_html__( 'Comment', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_enable_comment',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Hide Comment */

if ( is_litho_addons_activated() ) {

/* Hide Like */
$wp_customize->add_setting( 'litho_related_post_enable_like', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_post_enable_like', array(
	'label'				=> esc_html__( 'Like', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_enable_like',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Hide Like */
}
/* Hide Separator */

$wp_customize->add_setting( 'litho_related_posts_separator', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_related_posts_separator', array(
	'label'				=> esc_html__( 'Post separator', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_posts_separator',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Hide Separator */

/* Related Post Title Color Setting */

$wp_customize->add_setting( 'litho_related_post_general_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_general_title_color', array(
	'label'				=> esc_html__( 'Related title color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_general_title_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Title Color Setting */

/* Related Post Title Color Setting */

$wp_customize->add_setting( 'litho_related_post_general_sub_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_general_sub_title_color', array(
	'label'				=> esc_html__( 'Related sub title color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_general_sub_title_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Title Color Setting */

/* Related Post Title Color Setting */

$wp_customize->add_setting( 'litho_related_post_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_title_color', array(
	'label'				=> esc_html__( 'Post title color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_title_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Title Color Setting */

/* Related Post Title Hover Color Setting */

$wp_customize->add_setting( 'litho_related_post_title_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_title_hover_color', array(
	'label'				=> esc_html__( 'Post title hover color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_title_hover_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Title Hover Color Setting */

/* Related Post Excerpt Color Setting */

$wp_customize->add_setting( 'litho_related_post_content_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_content_color', array(
	'label'				=> esc_html__( 'Post excerpt color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_content_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Content Color Setting */

/* Related Post Meta Color Setting */

$wp_customize->add_setting( 'litho_related_post_meta_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_meta_color', array(
	'label'				=> esc_html__( 'Meta color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_meta_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Meta Color Setting */

/* Related Post Meta Hover Color Setting */

$wp_customize->add_setting( 'litho_related_post_meta_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_meta_hover_color', array(
	'label'				=> esc_html__( 'Meta hover color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_related_post_meta_hover_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End Related Post Meta Hover Color Setting */

/* Related Post Button Text Color setting */

$wp_customize->add_setting( 'litho_related_post_separator_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_separator_color', array(
	'label'				=> esc_html__( 'Separator color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_separator_color',
	'active_callback'   => 'litho_related_posts_callback',
) ) );

/* End  Related Post Button Text Color setting */

/* Related Post Button Background Color setting */

$wp_customize->add_setting( 'litho_related_post_button_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_button_bg_color', array(
	'label'				=> esc_html__( 'Button color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_button_bg_color',
	'active_callback'   => 'litho_related_post_button_callback',
) ) );

/* End  Related Post Button Background Color setting */

/* Related Post Button Background Hover Color setting */

$wp_customize->add_setting( 'litho_related_post_button_bg_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_button_bg_hover_color', array(
	'label'				=> esc_html__( 'Button hover color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_button_bg_hover_color',
	'active_callback'   => 'litho_related_post_button_callback',
) ) );

/* End  Related Post Button Background Hover Color setting */

/* Related Post Button Text Color setting */

$wp_customize->add_setting( 'litho_related_post_button_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_button_text_color', array(
	'label'				=> esc_html__( 'Button text color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_button_text_color',
	'active_callback'   => 'litho_related_post_button_callback',
) ) );

/* End  Related Post Button Text Color setting */


/* Related Post Button Text Hover Color setting */

$wp_customize->add_setting( 'litho_related_post_button_text_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_button_text_hover_color', array(
	'label'				=> esc_html__( 'Button text hover color', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_button_text_hover_color',
	'active_callback'   => 'litho_related_post_button_callback',
) ) );

/* End  Related Post Button Text Hover Color setting */

/* Related Post Button Border Color setting */

$wp_customize->add_setting( 'litho_related_post_button_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_button_border_color', array(
	'label'				=> esc_html__( 'Button border color', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_button_border_color',
	'active_callback'   => 'litho_related_post_button_callback',
) ) );

/* End  Related Post Button Border Color setting */
	
/* Related Post Button Border Hover Color setting */

$wp_customize->add_setting( 'litho_related_post_button_border_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_related_post_button_border_hover_color', array(
	'label'				=> esc_html__( 'Button border hover color', 'litho' ),
	'section'			=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_related_post_button_border_hover_color',
	'active_callback'   => 'litho_related_post_button_callback',
) ) );

/* End Related Post Button Border Hover Color setting */

/* Color Separator Setting */

$wp_customize->add_setting( 'litho_post_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_separator', array(
	'label'				=> esc_html__( 'Font and colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'   		=> 'litho_post_separator',
) ) );

/* End Color Separator Setting */

/* Post Title Color Setting */

$wp_customize->add_setting( 'litho_post_title_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_title_color', array(
	'label'				=> esc_html__( 'Post title color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_title_color',
	'active_callback'   => 'litho_post_title_callback',
) ) );

/* End Post Title Color Setting */

/* Post Meta Color Setting */

$wp_customize->add_setting( 'litho_post_meta_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_meta_color', array(
	'label'				=> esc_html__( 'Post meta color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_meta_color',
	'active_callback'   => 'litho_post_meta_callback',
) ) );

/* End Post Meta Color Setting */

/* Post Meta Hover Color Setting */

$wp_customize->add_setting( 'litho_post_meta_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_meta_hover_color', array(
	'label'				=> esc_html__( 'Post meta hover color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_meta_hover_color',
	'active_callback'   => 'litho_post_meta_callback',
) ) );

/* End Post Meta Hover Color Setting */

/* Post Meta Icon Color Setting */

$wp_customize->add_setting( 'litho_post_meta_icon_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_meta_icon_color', array(
	'label'				=> esc_html__( 'Post meta icon color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_meta_icon_color',
	'active_callback'   => 'litho_post_meta_callback',
) ) );

/* End Post Meta Icon Color Setting */

/* Tag, Like, Social icon color Setting */

$wp_customize->add_setting( 'litho_post_tag_like_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_tag_like_color', array(
	'label'				=> esc_html__( 'Tag, Like, Social icon color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_tag_like_color',
) ) );

/* End Tag, Like, Social icon color Setting */

/* Tag, Like, Social icon hover color Setting */

$wp_customize->add_setting( 'litho_post_tag_like_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_tag_like_hover_color', array(
	'label'				=> esc_html__( 'Tag, Like, Social icon hover color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_tag_like_hover_color',
) ) );

/* End Tag, Like, Social icon hover color Setting */

/* Tag, Like background color Setting */

$wp_customize->add_setting( 'litho_post_tag_like_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_tag_like_bg_color', array(
	'label'				=> esc_html__( 'Tag, Like background color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_tag_like_bg_color',
) ) );

/* End Tag, Like background color Setting */

/* Navigation text color Setting */

$wp_customize->add_setting( 'litho_post_navigation_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_navigation_color', array(
	'label'				=> esc_html__( 'Navigation color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_navigation_color',
	'active_callback'   => 'litho_post_navigation_callback',
) ) );

/* End Navigation text color Setting */

/* Navigation text hover color Setting */

$wp_customize->add_setting( 'litho_post_navigation_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_navigation_hover_color', array(
	'label'				=> esc_html__( 'Navigation hover color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_navigation_hover_color',
	'active_callback'   => 'litho_post_navigation_callback',
) ) );

/* End Navigation text hover color Setting */

/* Author Box Separator Setting */

$wp_customize->add_setting( 'litho_author_box_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_author_box_separator', array(
	'label'				=> esc_html__( 'Author box colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'   		=> 'litho_author_box_separator',
) ) );

/* End Author Box Separator Setting */

/* Author Box Background Color Setting */

$wp_customize->add_setting( 'litho_post_author_box_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_author_box_bg_color', array(
	'label'				=> esc_html__( 'Background color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_author_box_bg_color',
) ) );

/* End Author Box Background Color Setting */

/* Author Box Title Text Color Setting */

$wp_customize->add_setting( 'litho_post_author_title_text_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_author_title_text_color', array(
	'label'				=> esc_html__( 'Title color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_author_title_text_color',
) ) );

/* End Author Box Title Text Color Setting */

/* Author Box Title Text Hover Color Setting */

$wp_customize->add_setting( 'litho_post_author_title_text_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_author_title_text_hover_color', array(
	'label'				=> esc_html__( 'Title hover color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_author_title_text_hover_color',
) ) );

/* End Author Box Title Text Hover Color Setting */

/* Author Box Content Color Setting */

$wp_customize->add_setting( 'litho_post_author_content_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
	
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_author_content_color', array(
	'label'				=> esc_html__( 'Content color', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_author_content_color',
) ) );

/* End Author Box Content Color Setting */

/* Author Box Button Text Color setting */

$wp_customize->add_setting( 'litho_button_text_color_author_box', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_text_color_author_box', array(
	'label'				=> esc_html__( 'Button text color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_button_text_color_author_box',
) ) );

/* End Author Box Button Text Color setting */

/* Author Box Button Hover Text Color setting */

$wp_customize->add_setting( 'litho_button_hover_text_color_author_box', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_hover_text_color_author_box', array(
	'label'				=> esc_html__( 'Button text hover color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_button_hover_text_color_author_box',
) ) );

/* End Author Box Button Hover Text Color setting */

/* Author Box Button Border Color setting */

$wp_customize->add_setting( 'litho_button_border_color_author_box', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_border_color_author_box', array(
	'label'				=> esc_html__( 'Button border color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_button_border_color_author_box',
) ) );

/* End Author Box Button Border Color setting */

/* Author Box Button Border Hover Color setting */

$wp_customize->add_setting( 'litho_button_hover_border_color_author_box', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_hover_border_color_author_box', array(
	'label'				=> esc_html__( 'Button border hover color', 'litho' ),
	'section'     		=> 'litho_add_post_layout_panel',
	'settings'			=> 'litho_button_hover_border_color_author_box',
) ) );

/* End Author Box Button Border Color setting */

/* Custom Callback Functions */

if ( ! function_exists( 'litho_post_left_sidebar_layout_callback' ) ) :
	function litho_post_left_sidebar_layout_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_layout_setting' )->value() == 'litho_layout_left_sidebar' || $control->manager->get_setting( 'litho_post_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_container_fluid_with_padding_callback' ) ) :
	function litho_post_container_fluid_with_padding_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_post_container_style' )->value() == 'container-fluid-with-padding' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_related_posts_excerpt_callback' ) ) :
	function litho_related_posts_excerpt_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_related_post_excerpt' )->value() == '1' && $control->manager->get_setting( 'litho_enable_related_posts' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_right_sidebar_layout_callback' ) ) :
	function litho_post_right_sidebar_layout_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_layout_setting' )->value() == 'litho_layout_right_sidebar' || $control->manager->get_setting( 'litho_post_layout_setting' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_single_post_bg_pattern_callback' ) ) :
	function litho_single_post_bg_pattern_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_layout_style' )->value() == 'post-layout-style-1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_title_callback' ) ) :
	function litho_post_title_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_post_title' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_meta_callback' ) ) :
	function litho_post_meta_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_date' )->value() == '1' || $control->manager->get_setting( 'litho_enable_category' )->value() == '1' || $control->manager->get_setting( 'litho_enable_author' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_date_callback' ) ) :
	function litho_post_date_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_date' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_related_posts_callback' ) ) :
	function litho_related_posts_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_related_posts' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_related_posts_post_thumbnail_callback' ) ) :
	function litho_related_posts_post_thumbnail_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_related_posts_enable_post_thumbnail' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_related_posts_date_callback' ) ) :
	function litho_related_posts_date_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_related_posts' )->value() == '1' && $control->manager->get_setting( 'litho_related_posts_enable_date' )->value() == '1' ) {
			return true;
		}else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_related_post_button_callback' ) ) :
	function litho_related_post_button_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_enable_related_posts' )->value() == '1' && $control->manager->get_setting( 'litho_related_post_enable_button' )->value() == '1' ) {
			return true;
		}else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_related_posts_separator_callback' ) ) :
	function litho_related_posts_separator_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_related_posts_separator' )->value() == '1' && $control->manager->get_setting( 'litho_enable_related_posts' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_navigation_callback' ) ) :
	function litho_post_navigation_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_navigation_link' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_author_box_callback' ) ) :
	function litho_author_box_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_post_author_box' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_related_posts_terms_callback' ) ) :
	function litho_related_posts_terms_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_enable_related_posts' )->value() == '1' && $control->manager->get_setting( 'litho_related_post_enable_category' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;


/* End Custom Callback Functions */
