<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get All Register Sidebar List.
$litho_sidebar_array = litho_register_sidebar_customizer_array(); // phpcs:ignore

/* Separator Settings */
$wp_customize->add_setting( 'litho_default_post_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_default_post_separator', array(
	'label'      		=> esc_html__( 'Layout and Container', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_default_layout_panel',
	'settings'   		=> 'litho_default_post_separator',
) ) );
/* End Separator Settings */

/* Default Layout For Post*/
$wp_customize->add_setting( 'litho_post_layout_setting_default', array(
	'default' 			=> 'litho_layout_right_sidebar',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_post_layout_setting_default', array(
	'label'       		=> esc_html__( 'Layout style', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_layout_setting_default',
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
	'litho_columns'    		=> '4',
) ) );
/* End Default Layout For Post */

/* Default Left Sidebar*/
$wp_customize->add_setting( 'litho_post_left_sidebar_default', array(
	'default' 			=> 'sidebar-1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_left_sidebar_default', array(
	'label'       		=> esc_html__( 'Left sidebar', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_left_sidebar_default',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array, // phpcs:ignore
	'active_callback'   => 'litho_post_left_sidebar_layout_default_callback',
) ) );

if ( ! function_exists( 'litho_post_left_sidebar_layout_default_callback' ) ) :
	function litho_post_left_sidebar_layout_default_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_layout_setting_default' )->value() == 'litho_layout_left_sidebar' || $control->manager->get_setting( 'litho_post_layout_setting_default' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
/* End Default Left Sidebar */

/* Default Right Sidebar */

$wp_customize->add_setting( 'litho_post_right_sidebar_default', array(
	'default' 			=> 'sidebar-1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_right_sidebar_default', array(
	'label'       		=> esc_html__( 'Right sidebar', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_right_sidebar_default',
	'type'              => 'select',
	'choices'           => $litho_sidebar_array, // phpcs:ignore
	'active_callback'   => 'litho_post_right_sidebar_layout_default_callback',
) ) );

if ( ! function_exists( 'litho_post_right_sidebar_layout_default_callback' ) ) :
	function litho_post_right_sidebar_layout_default_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_layout_setting_default' )->value() == 'litho_layout_right_sidebar' || $control->manager->get_setting( 'litho_post_layout_setting_default' )->value() == 'litho_layout_both_sidebar' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
/* End Default Right Sidebar */

/* Default Container Setting*/
$wp_customize->add_setting( 'litho_post_container_style_default', array(
	'default' 			=> 'container',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_container_style_default', array(
	'label'       		=> esc_html__( 'Container style', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_container_style_default',
	'type'              => 'select',
	'choices'           => array(
			'container'						=> esc_html__( 'Fixed', 'litho' ),
			'container-fluid'				=> esc_html__( 'Full width', 'litho' ),
			'container-fluid-with-padding'	=> esc_html__( 'Full width ( with paddings )', 'litho' ),
	   ),
) ) );
/* End Default Container Setting */

/* Container custom Width setting */

$wp_customize->add_setting( 'litho_post_container_fluid_with_padding_default', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_container_fluid_with_padding_default', array(
	'label'       		=> esc_html__( 'Full width padding', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_container_fluid_with_padding_default',
	'type'              => 'text',
	'active_callback'	=> 'litho_post_container_fluid_with_padding_default_callback',
) ) );

if ( ! function_exists( 'litho_post_container_fluid_with_padding_default_callback' ) ) :
	function litho_post_container_fluid_with_padding_default_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_post_container_style_default' )->value() == 'container-fluid-with-padding' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Container custom Width setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_post_styles_separator_default', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_post_styles_separator_default', array(
	'label'				=> esc_html__( 'Post List Style And Data', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_styles_separator_default',
) ) );

/* End Separator Settings */

/*  No. of Columns  */
$wp_customize->add_setting( 'litho_no_of_posts_columns_default', array(
	'default' 			=> '2',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_no_of_posts_columns_default', array(
	'label'				=> esc_html__( 'No. of columns', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_no_of_posts_columns_default',
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
) ) );
/* End No. of Columns */


/* Post Thumbnail */

$wp_customize->add_setting( 'litho_post_enable_thumbnail_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_thumbnail_default', array(
	'label'				=> esc_html__( 'Post Thumbnail', 'litho' ),
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_thumbnail_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Featured Image Size */

$wp_customize->add_setting( 'litho_post_feature_image_size_default', array(
	'default' 			=> 'full',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Image_SRCSET_Control( $wp_customize, 'litho_post_feature_image_size_default', array(
	'label'				=> esc_html__( 'Post thumbnail size', 'litho' ),
	'type'              => 'litho_image_srcset',
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_feature_image_size_default',
	'active_callback'   => 'litho_post_thumbnail_default_callback',
) ) );

/* End Featured Image Size */

/* Post Title */

$wp_customize->add_setting( 'litho_post_enable_title_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_title_default', array(
	'label'				=> esc_html__( 'Post Title', 'litho' ),
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_title_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Post Title */

/* Post Author */

$wp_customize->add_setting( 'litho_post_enable_author_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_author_default', array(
	'label'				=> esc_html__( 'Post Author', 'litho' ),
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_author_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Post Author */

/* Post Comment */

$wp_customize->add_setting( 'litho_post_enable_comment_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_comment_default', array(
	'label'				=> esc_html__( 'Post Comment', 'litho' ),
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_comment_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Post Comment */

/* Post Date */

$wp_customize->add_setting( 'litho_post_enable_date_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_date_default', array(
	'label'				=> esc_html__( 'Post Date', 'litho' ),
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_date_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Post Date */

/* Post Date Format */

$wp_customize->add_setting( 'litho_post_date_format_default', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_date_format_default', array(
	'label'				=> esc_html__( 'Post Date Format', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_date_format_default',
	'type'              => 'text',
	'description'		=> 	sprintf(
								'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
								esc_html__( 'Date format should be like F j, Y', 'litho' ),
								esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
								esc_html__( 'click here', 'litho' ),
								esc_html__( 'to see other date formates.', 'litho' ),
							),
	'active_callback'   => 'litho_post_date_default_callback',

) ) );

/* End Post Date Format */

/* Post Excerpt */

$wp_customize->add_setting( 'litho_post_enable_excerpt_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_excerpt_default', array(
	'label'				=> esc_html__( 'Post Excerpt', 'litho' ),
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_excerpt_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Post Excerpt */

/* Excerpt Length */

$wp_customize->add_setting( 'litho_post_excerpt_length_default', array(
	'default' 			=> '15',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'litho_post_excerpt_length_default', array(
	'label'				=> esc_html__( 'Excerpt length', 'litho' ),
	'section'    		=> 'litho_add_post_layout_panel',
	'settings'	 		=> 'litho_post_excerpt_length',
	'type'       		=> 'text',
	'active_callback'   => 'litho_post_excerpt_default_callback',
) );

/* End Excerpt Length  */

/* Read more */

$wp_customize->add_setting( 'litho_post_enable_read_more_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_read_more_default', array(
	'label'				=> esc_html__( 'Read more', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_read_more_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Read more */

/* Read more text */

$wp_customize->add_setting( 'litho_post_read_more_text_default', array(
	'default' 			=> esc_html__( 'Read more', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_post_read_more_text_default', array(
	'label'				=> esc_html__( 'Read more text', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_read_more_text_default',
	'type'              => 'text',
	'active_callback'   => 'litho_post_read_more_default_callback',
) ) );

/* End Read more text */

/* Post Category */

$wp_customize->add_setting( 'litho_post_enable_category_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_category_default', array(
	'label'				=> esc_html__( 'Post Terms', 'litho' ),
	'section'			=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_category_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback'   => 'litho_post_thumbnail_default_callback',
) ) );


$wp_customize->add_setting(
	'litho_post_terms_default',
	array(
		'default'           => 'category',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_post_terms_default',
		array(
			'label'    => esc_html__( 'Select Post Terms', 'litho' ),
			'section'  => 'litho_add_default_layout_panel',
			'settings' => 'litho_post_terms_default',
			'type'     => 'select',
			'choices'  => array(
				'category' => esc_html__( 'Category', 'litho' ),
				'tags'     => esc_html__( 'Tags', 'litho' ),
			),
			'active_callback'   => 'litho_post_terms_default_callback',
		)
	)
);


/* Post Category */

/* Pagination */

$wp_customize->add_setting( 'litho_post_enable_pagination_default', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_post_enable_pagination_default', array(
	'label'				=> esc_html__( 'Pagination', 'litho' ),
	'section'     		=> 'litho_add_default_layout_panel',
	'settings'			=> 'litho_post_enable_pagination_default',
	'type'				=> 'litho_switch',
	'choices'			=> array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* Pagination */

// callback function
if ( ! function_exists( 'litho_post_thumbnail_default_callback' ) ) :
	function litho_post_thumbnail_default_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_enable_thumbnail_default' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_excerpt_default_callback' ) ) :
	function litho_post_excerpt_default_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_enable_excerpt_default' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_date_default_callback' ) ) :
	function litho_post_date_default_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_enable_date_default' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;


if ( ! function_exists( 'litho_post_terms_default_callback' ) ) :
	function litho_post_terms_default_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_enable_category_default' )->value() == '1' && $control->manager->get_setting( 'litho_post_enable_thumbnail_default' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_post_read_more_default_callback' ) ) :
	function litho_post_read_more_default_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_post_enable_read_more_default' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
