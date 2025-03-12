<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_sticky_post_list_style_data_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_sticky_post_list_style_data_separator', array(
	'label'				=> esc_html__( 'Post list style and data', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_sticky_layout_panel',
	'settings'   		=> 'litho_sticky_post_list_style_data_separator',
) ) );

/* End Separator Settings */

/* Sticky Show Post Thumbnail setting */

$wp_customize->add_setting( 'litho_show_post_thumbnail_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_post_thumbnail_sticky', array(
	'label'				=> esc_html__( 'Post thumbnail', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_post_thumbnail_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show Post Thumbnail setting */

/* Sticky Image srcset setting */

$wp_customize->add_setting( 'litho_image_srcset_sticky', array(
	'default' 			=> 'full',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Image_SRCSET_Control( $wp_customize, 'litho_image_srcset_sticky', array(
	'label'				=> esc_html__( 'Post thumbnail size', 'litho' ),
	'type'              => 'litho_image_srcset',
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_image_srcset_sticky',
) ) );

/* End Sticky Type */

/* Sticky Show Post Title setting */

$wp_customize->add_setting( 'litho_show_post_title_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_post_title_sticky', array(
	'label'				=> esc_html__( 'Post title', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_post_title_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show Post Title setting */

/* Sticky Show Post Author setting */

$wp_customize->add_setting( 'litho_show_post_author_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_post_author_sticky', array(
	'label'				=> esc_html__( 'Post author', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_post_author_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show Post Author setting */

/* Sticky Show Post Author Image setting */

$wp_customize->add_setting( 'litho_show_post_author_image_sticky', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_post_author_image_sticky', array(
	'label'				=> esc_html__( 'Post author image', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_post_author_image_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback'	=> 'litho_show_post_author_sticky_callback'
) ) );

if ( ! function_exists( 'litho_show_post_author_sticky_callback' ) ) :
function litho_show_post_author_sticky_callback( $control )	{
	if ( $control->manager->get_setting( 'litho_show_post_author_sticky' )->value() == '1' ) {
		return true;
	} else {
		return false;
	}
}
endif;

/* End Sticky Show Post Author Image setting */

/* Sticky Show Post Date setting */

$wp_customize->add_setting( 'litho_show_post_date_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_post_date_sticky', array(
	'label'				=> esc_html__( 'Post date', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_post_date_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show Post Date setting */

/* Sticky Date Format setting */

$wp_customize->add_setting( 'litho_date_format_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_date_format_sticky', array(
	'label'				=> esc_html__( 'Post date format', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_date_format_sticky',
	'type'              => 'text',
	'description'		=> sprintf(
								'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
								esc_html__( 'Date format should be like F j, Y', 'litho' ),
								esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
								esc_html__( 'click here', 'litho' ),
								esc_html__( 'to see other date formates.', 'litho' ),
							),
	'active_callback'   => 'litho_date_format_sticky_callback',
) ) );

if ( ! function_exists( 'litho_date_format_sticky_callback' ) ) :
	function litho_date_format_sticky_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_show_post_date_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
/* End Sticky Date Format setting */

/* Sticky Show Excerpt setting */

$wp_customize->add_setting( 'litho_show_excerpt_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_excerpt_sticky', array(
	'label'				=> esc_html__( 'Post excerpt', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_excerpt_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show Excerpt setting */

/* Sticky Excerpt Length setting */

$wp_customize->add_setting( 'litho_excerpt_length_sticky', array(
	'default' 			=> '35',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_excerpt_length_sticky', array(
	'label'				=> esc_html__( 'Excerpt length', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_excerpt_length_sticky',
	'type'              => 'text',
	'active_callback'   => 'litho_excerpt_length_sticky_callback',
) ) );

if ( ! function_exists( 'litho_excerpt_length_sticky_callback' ) ) :
	function litho_excerpt_length_sticky_callback( $control )	{

		if ( $control->manager->get_setting( 'litho_show_excerpt_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
/* End Sticky Excerpt Length setting */

/* Sticky Show Content setting */

$wp_customize->add_setting( 'litho_show_content_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_content_sticky', array(
	'label'				=> esc_html__( 'Post full content', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_content_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback'   => 'litho_show_content_sticky_callback',
) ) );

if ( ! function_exists( 'litho_show_content_sticky_callback' ) ) :
	function litho_show_content_sticky_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_show_excerpt_sticky' )->value() == '0' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
/* End Sticky Show Content setting */

/* Sticky Show Categories setting */

$wp_customize->add_setting( 'litho_show_category_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_category_sticky', array(
	'label'				=> esc_html__( 'Post Terms', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_category_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );


$wp_customize->add_setting(
	'litho_post_terms_sticky',
	array(
		'default'           => 'category',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_post_terms_sticky',
		array(
			'label'    => esc_html__( 'Select Post Terms', 'litho' ),
			'section'  => 'litho_add_sticky_layout_panel',
			'settings' => 'litho_post_terms_sticky',
			'type'     => 'select',
			'choices'  => array(
				'category' => esc_html__( 'Category', 'litho' ),
				'tags'     => esc_html__( 'Tags', 'litho' ),
			),
			'active_callback'   => 'litho_post_terms_sticky_callback',
		)
	)
);

if ( ! function_exists( 'litho_post_terms_sticky_callback' ) ) :
	function litho_post_terms_sticky_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_show_category_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;


/* End Sticky Show Categories setting */

if ( is_litho_addons_activated() ) {

/* Sticky Show like setting */

$wp_customize->add_setting( 'litho_show_like_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_like_sticky', array(
	'label'				=> esc_html__( 'Post like', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_like_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show like setting */

/* Sticky Show like text setting */

$wp_customize->add_setting( 'litho_show_like_text_sticky', array(
	'default' 			=> 'inline-block',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_show_like_text_sticky', array(
	'label'				=> esc_html__( 'Post like text', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_like_text_sticky',
	'type'              => 'select',
	'choices'           => array(
								''				=> esc_html__( 'Select', 'litho' ),
								'inline-block'	=> esc_html__( 'Block', 'litho' ),
								'none'			=> esc_html__( 'None', 'litho' ),
							   ),
	'active_callback'   => 'litho_show_like_sticky_callback',
) ) );

if ( ! function_exists( 'litho_show_like_sticky_callback' ) ) :
	function litho_show_like_sticky_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_show_like_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Sticky Show like text setting */
}
/* Sticky Show Comment setting */

$wp_customize->add_setting( 'litho_show_comment_sticky', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_comment_sticky', array(
	'label'				=> esc_html__( 'Post comment', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_comment_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show Comment setting */

/* Sticky Show Comment Text setting */

$wp_customize->add_setting( 'litho_show_comment_text_sticky', array(
	'default' 			=> 'inline-block',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_show_comment_text_sticky', array(
	'label'				=> esc_html__( 'Post comment text', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_comment_text_sticky',
	'type'              => 'select',
	'choices'           => array(
								''				=> esc_attr( 'Select', 'litho' ),
								'inline-block'	=> esc_attr( 'Block', 'litho' ),
								'none'			=> esc_attr( 'None', 'litho' ),
							   ),
	'active_callback'   => 'litho_show_comment_sticky_callback',
) ) );

if ( ! function_exists( 'litho_show_comment_sticky_callback' ) ) :
	function litho_show_comment_sticky_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_show_comment_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* END Sticky Show Comment Text setting */

/* Sticky Show Button setting */

$wp_customize->add_setting( 'litho_show_button_sticky', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_show_button_sticky', array(
	'label'				=> esc_html__( 'Read more button', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_show_button_sticky',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
) ) );

/* End Sticky Show Button setting */

/* Sticky Button Text setting */

$wp_customize->add_setting( 'litho_button_text_sticky', array(
	'default' 			=> esc_html__( 'Read more', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_button_text_sticky', array(
	'label'				=> esc_html__( 'Button text', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_button_text_sticky',
	'type'              => 'text',
	'active_callback'	=> 'litho_button_text_sticky_callback'
) ) );

if ( ! function_exists( 'litho_button_text_sticky_callback' ) ) :
	function litho_button_text_sticky_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_show_button_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Sticky Button Text setting */

/* Title Typography Separator setting */

$wp_customize->add_setting( 'litho_sticky_layout_separator_title_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_sticky_layout_separator_title_typography', array(
	'label'				=> esc_html__( 'Title typography and color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_sticky_layout_panel',
	'settings'   		=> 'litho_sticky_layout_separator_title_typography',
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

if ( ! function_exists( 'litho_sticky_layout_title_typography_callback' ) ) :
	function litho_sticky_layout_title_typography_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_show_post_title_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Title Typography Separator setting */

/* Sticky Font size setting */

$wp_customize->add_setting( 'litho_title_font_size_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_title_font_size_sticky', array(
	'label'				=> esc_html__( 'Font size', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_title_font_size_sticky',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

/* End Sticky Font size setting */

/* Sticky Line height setting */

$wp_customize->add_setting( 'litho_title_line_height_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_title_line_height_sticky', array(
	'label'				=> esc_html__( 'Line height', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_title_line_height_sticky',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

/* End Sticky Line height setting */

/* Sticky Letter spacing setting */

$wp_customize->add_setting( 'litho_title_letter_spacing_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_title_letter_spacing_sticky', array(
	'label'				=> esc_html__( 'Letter spacing', 'litho' ),
	'section'			=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_title_letter_spacing_sticky',
	'type'				=> 'text',
	'description'		=> esc_html__( 'In pixel like 1px', 'litho' ),
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

/* End Sticky Letter spacing setting */

/* Sticky Font weight setting */

$wp_customize->add_setting( 'litho_title_font_weight_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_title_font_weight_sticky', array(
	'label'				=> esc_html__( 'Font weight', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_title_font_weight_sticky',
	'type'              => 'select',
	'choices'           => $litho_font_weight, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

/* End Sticky Font weight setting */

/* Sticky Post Title Text Transform setting */

$wp_customize->add_setting( 'litho_title_text_transform_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_title_text_transform_sticky', array(
	'label'				=> esc_html__( 'Post title text case', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_title_text_transform_sticky',
	'type'              => 'select',
	'choices'           => array(
								''					=> esc_html__( 'Select', 'litho' ),
								'uppercase'			=> esc_html__( 'Uppercase', 'litho' ),
								'lowercase'			=> esc_html__( 'Lowercase', 'litho' ),
								'capitalize'		=> esc_html__( 'Capitalize', 'litho' ),
								'none'				=> esc_html__( 'None', 'litho' ),
							   ),
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

/* End Sticky Post Title Text Transform setting */

/* Sticky Title Color setting */

$wp_customize->add_setting( 'litho_title_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_title_color_sticky', array(
	'label'				=> esc_html__( 'Title color', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_title_color_sticky',
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

/* End Sticky Title Color setting */

/* Sticky Title Hover Color setting */

$wp_customize->add_setting( 'litho_title_hover_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_title_hover_color_sticky', array(
	'label'				=> esc_html__( 'Title hover color', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_title_hover_color_sticky',
	'active_callback'	=> 'litho_sticky_layout_title_typography_callback',
) ) );

/* End Sticky Title Hover Color setting */

/* Content Typography Separator setting */
$wp_customize->add_setting( 'litho_sticky_layout_separator_content_typography', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_sticky_layout_separator_content_typography', array(
	'label'				=> esc_html__( 'Content typography and color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_sticky_layout_panel',
	'settings'   		=> 'litho_sticky_layout_separator_content_typography',
	'active_callback'	=> 'litho_sticky_layout_content_typography_callback',
) ) );

if ( ! function_exists( 'litho_sticky_layout_content_typography_callback' ) ) :
	function litho_sticky_layout_content_typography_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_show_excerpt_sticky' )->value() == '1' || $control->manager->get_setting( 'litho_show_content_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;
/* End Content Typography Separator setting */

/* Sticky Content Font size setting*/
$wp_customize->add_setting( 'litho_content_font_size_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_content_font_size_sticky', array(
	'label'				=> esc_html__( 'Font size', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_content_font_size_sticky',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_sticky_layout_content_typography_callback',
) ) );
/* End Sticky Content Font size setting */

/* Sticky Content Line height setting*/
$wp_customize->add_setting( 'litho_content_line_height_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_content_line_height_sticky', array(
	'label'				=> esc_html__( 'Line height', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_content_line_height_sticky',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_sticky_layout_content_typography_callback',
) ) );
/* End Sticky Content Line height setting */

/* Sticky Content Letter spacing setting*/
$wp_customize->add_setting( 'litho_content_letter_spacing_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_content_letter_spacing_sticky', array(
	'label'				=> esc_html__( 'Letter spacing', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_content_letter_spacing_sticky',
	'type'              => 'text',
	'description'		=> esc_html__( 'In pixel like 1px', 'litho' ),
	'active_callback'	=> 'litho_sticky_layout_content_typography_callback',
) ) );
/* End Sticky Content Letter spacing setting */

/* Sticky Content Font weight setting */

$wp_customize->add_setting( 'litho_content_font_weight_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_content_font_weight_sticky', array(
	'label'				=> esc_html__( 'Font weight', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_content_font_weight_sticky',
	'type'              => 'select',
	'choices'           => $litho_font_weight, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_sticky_layout_content_typography_callback',
) ) );
/* End Sticky Content Font weight setting */

/* Sticky content Color setting */
$wp_customize->add_setting( 'litho_content_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_content_color_sticky', array(
	'label'				=> esc_html__( 'Content color', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_content_color_sticky',
	'active_callback'	=> 'litho_sticky_layout_content_typography_callback',
) ) );
	
/* End Sticky content Color setting */

/* Style Separator setting */

$wp_customize->add_setting( 'litho_sticky_layout_separator_style_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_sticky_layout_separator_style_color', array(
	'label'				=> esc_html__( 'Post meta and button colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_sticky_layout_panel',
	'settings'   		=> 'litho_sticky_layout_separator_style_color',
) ) );

/* End Style Separator setting */

/* Sticky Post Box Background Color setting */

$wp_customize->add_setting( 'litho_box_bg_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_box_bg_color_sticky', array(
	'label'				=> esc_html__( 'Box background', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_box_bg_color_sticky',
) ) );

/* End Sticky Post Box Background Color setting */

/* Sticky Box Border Size setting */

$wp_customize->add_setting( 'litho_box_border_size_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_box_border_size_sticky', array(
	'label'				=> esc_html__( 'Box border size', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_box_border_size_sticky',
	'description'		=> esc_html__( 'In pixel like 1px', 'litho' ),
	'type'              => 'text',
) ) );

/* End Sticky Box Border Size setting */

/* Sticky Box Border Type Transform setting */

$wp_customize->add_setting( 'litho_box_border_type_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_box_border_type_sticky', array(
	'label'				=> esc_html__( 'Box border type', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_box_border_type_sticky',
	'type'              => 'select',
	'choices'           => array(
								''			=> esc_html__( 'Select', 'litho' ),
								'dotted' 	=> esc_html__( 'Dotted', 'litho' ),
								'dashed'	=> esc_html__( 'Dashed', 'litho' ),
								'solid'		=> esc_html__( 'Solid', 'litho' ),
								'double'	=> esc_html__( 'Double', 'litho' ),
							),
) ) );

/* Sticky Button Color setting */

/* Sticky Box Border Color setting */

$wp_customize->add_setting( 'litho_box_border_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_box_border_color_sticky', array(
	'label'				=> esc_html__( 'Box border color', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_box_border_color_sticky',
) ) );

/* End Sticky Box Border Color setting */

$wp_customize->add_setting( 'litho_button_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_color_sticky', array(
	'label'				=> esc_html__( 'Button', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_button_color_sticky',
	'active_callback'	=> 'litho_button_color_sticky_callback',
) ) );

if ( ! function_exists( 'litho_button_color_sticky_callback' ) ) :
	function litho_button_color_sticky_callback( $control )	{
		if ( $control->manager->get_setting( 'litho_show_button_sticky' )->value() == '1' ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Sticky Button Color setting */

/* Sticky Button Hover Color setting */

$wp_customize->add_setting( 'litho_button_hover_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_hover_color_sticky', array(
	'label'				=> esc_html__( 'Button hover', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_button_hover_color_sticky',
	'active_callback'	=> 'litho_button_color_sticky_callback',
) ) );

/* End Sticky Button Hover Color setting */

/* Sticky Button Text Color setting */

$wp_customize->add_setting( 'litho_button_text_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_text_color_sticky', array(
	'label'				=> esc_html__( 'Button text', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_button_text_color_sticky',
	'active_callback'	=> 'litho_button_color_sticky_callback',
) ) );

/* End Sticky Button Text Color setting */

/* Sticky Button Hover Text Color setting */

$wp_customize->add_setting( 'litho_button_hover_text_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_hover_text_color_sticky', array(
	'label'				=> esc_html__( 'Button text hover', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_button_hover_text_color_sticky',
	'active_callback'	=> 'litho_button_color_sticky_callback',
) ) );

/* End Sticky Button Hover Text Color setting */

/* Sticky Button Border Color setting */

$wp_customize->add_setting( 'litho_button_border_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_button_border_color_sticky', array(
	'label'				=> esc_html__( 'Button border', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_button_border_color_sticky',
	'active_callback'	=> 'litho_button_color_sticky_callback',
) ) );

/* End Sticky Button Border Color setting */

/* Sticky Post Meta Color setting */

$wp_customize->add_setting( 'litho_post_meta_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_meta_color_sticky', array(
	'label'				=> esc_html__( 'Post meta color', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_post_meta_color_sticky',
) ) );

/* End Sticky Post Meta Color setting */

/* Sticky Post Meta Hover Color setting */

$wp_customize->add_setting( 'litho_post_meta_hover_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_post_meta_hover_color_sticky', array(
	'label'				=> esc_html__( 'Post meta hover color', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_post_meta_hover_color_sticky',
) ) );

/* End Sticky Post Meta Hover Color setting */

/* Sticky Meta Border Color Setting */

$wp_customize->add_setting( 'litho_meta_border_color_sticky', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_meta_border_color_sticky', array(
	'label'				=> esc_html__( 'Meta Border Color', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_meta_border_color_sticky',
) ) );

/* End Sticky Meta Border Color Setting */

/* Sticky Post Meta Text Transform setting */

$wp_customize->add_setting( 'litho_meta_text_transform_sticky', array(
	'default' 			=> 'uppercase',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_meta_text_transform_sticky', array(
	'label'				=> esc_html__( 'Post meta text case', 'litho' ),
	'section'     		=> 'litho_add_sticky_layout_panel',
	'settings'			=> 'litho_meta_text_transform_sticky',
	'type'              => 'select',
	'choices'           => 	array(
								''					=> esc_html__( 'Select', 'litho' ),
								'uppercase'			=> esc_html__( 'Uppercase', 'litho' ),
								'lowercase'			=> esc_html__( 'Lowercase', 'litho' ),
								'capitalize'		=> esc_html__( 'Capitalize', 'litho' ),
								'none'				=> esc_html__( 'None', 'litho' ),
							),
) ) );

/* End Sticky Post Meta Text Transform setting */
