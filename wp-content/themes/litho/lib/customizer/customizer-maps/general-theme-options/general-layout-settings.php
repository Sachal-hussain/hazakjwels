<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$all_post_type = litho_get_post_types(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

/* Separator Settings */
$wp_customize->add_setting(
	'litho_custom_sidebar_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_custom_sidebar_separator',
		array(
			'label'    => esc_html__( 'Custom Sidebars', 'litho' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_add_custom_sidebars_panel',
			'settings' => 'litho_custom_sidebar_separator',
			'priority' => 2,
		)
	)
);

/* End Separator Settings */

/* Custom Sidebars Settings */
$wp_customize->add_setting(
	'litho_custom_sidebars',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Custom_Sidebars(
		$wp_customize,
		'litho_custom_sidebars',
		array(
			'label'       => esc_html__( 'Manage Sidebars', 'litho' ),
			'type'        => 'litho_custom_sidebar',
			'description' => esc_html__( 'You can add widgets in these sidebars at Appearance > Widgets and these sidebars can be assigned in header, footer, pages and posts.', 'litho' ),
			'section'     => 'litho_add_custom_sidebars_panel',
			'settings'    => 'litho_custom_sidebars',
			'priority'    => 2,
		)
	)
);


/* End Custom Sidebars Settings */

/* Separator Settings */
$wp_customize->add_setting(
	'litho_page_scroll_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_page_scroll_separator',
		array(
			'label'    => esc_html__( 'Page Scroll', 'litho' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_other_settings_panel',
			'settings' => 'litho_page_scroll_separator',
			'priority' => 3,
		)
	)
);

/* End Separator Settings */

/* Smooth Scroll */
$wp_customize->add_setting(
	'litho_enable_page_scrolling_effect',
	array(
		'default'           => '0',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Switch_Control(
		$wp_customize,
		'litho_enable_page_scrolling_effect',
		array(
			'label'    => esc_html__( 'Page smooth scroll', 'litho' ),
			'section'  => 'litho_other_settings_panel',
			'settings' => 'litho_enable_page_scrolling_effect',
			'type'     => 'litho_switch',
			'choices'  => array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
			),
			'priority' => 6,
		)
	)
);

/* End Smooth Scroll */

/* Scroll To Top Title Settings */

$wp_customize->add_setting(
	'litho_scroll_to_top_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_scroll_to_top_separator',
		array(
			'label'    => esc_html__( 'Scroll to top', 'litho' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_add_scroll_to_top_panel',
			'settings' => 'litho_scroll_to_top_separator',
			'priority' => 9,
		)
	)
);

/* End Scroll To Top Title Settings */

/* Hide Scroll to Top */

$wp_customize->add_setting(
	'litho_hide_scroll_to_top',
	array(
		'default'           => '1',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Switch_Control(
		$wp_customize,
		'litho_hide_scroll_to_top',
		array(
			'label'    => esc_html__( 'Scroll to top', 'litho' ),
			'section'  => 'litho_add_scroll_to_top_panel',
			'settings' => 'litho_hide_scroll_to_top',
			'type'     => 'litho_switch',
			'choices'  => array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
			),
			'priority' => 9,
		)
	)
);

/* End Hide Scroll to Top */

/* Scroll to Top Show on Mobile */

$wp_customize->add_setting(
	'litho_hide_scroll_to_top_on_tablet',
	array(
		'default'           => '0',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_switch_Control(
		$wp_customize,
		'litho_hide_scroll_to_top_on_tablet',
		array(
			'label'           => esc_html__( 'Show on tablet', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_hide_scroll_to_top_on_tablet',
			'active_callback' => 'litho_scroll_to_top_callback',
			'type'            => 'litho_switch',
			'choices'         => array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
			),
			'priority' => 9,
		)
	)
);

/* End Scroll to Top Show on Mobile */


/* Scroll To Top Title Settings */

$wp_customize->add_setting(
	'litho_scroll_to_top_typography_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_scroll_to_top_typography_separator',
		array(
			'label'           => esc_html__( 'Scroll to top typography', 'litho' ),
			'type'            => 'litho_separator',
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_typography_separator',
			'priority'        => 9,
			'active_callback' => 'litho_scroll_to_top_callback',
		)
	)
);

/* End Scroll To Top Title Settings */

/* Scroll To Top Font Size */

$wp_customize->add_setting(
	'litho_scroll_to_top_icon_font_size',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_scroll_to_top_icon_font_size',
		array(
			'label'           => esc_html__( 'Icon size', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_icon_font_size',
			'type'            => 'text',
			'priority'        => 9,
			'description'     => esc_html__( 'Define size like 12px', 'litho' ),
			'active_callback' => 'litho_scroll_to_top_callback',
		)
	)
);

/* End Scroll To Top Font Size */

/* Scroll To Top Font Line Height */

$wp_customize->add_setting(
	'litho_scroll_to_top_icon_line_height',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_scroll_to_top_icon_line_height',
		array(
			'label'           => esc_html__( 'Icon line height', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_icon_line_height',
			'type'            => 'text',
			'priority'        => 9,
			'description'     => esc_html__( 'Define icon line height like 12px', 'litho' ),
			'active_callback' => 'litho_scroll_to_top_callback',
		)
	)
);

/* End Scroll To Top Font Line Height */

/* Scroll To Top Font Size */

$wp_customize->add_setting(
	'litho_scroll_to_top_icon_size',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_scroll_to_top_icon_size',
		array(
			'label'           => esc_html__( 'Icon height / width', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_icon_size',
			'type'            => 'text',
			'priority'        => 9,
			'description'     => esc_html__( 'Define icon height / width like 12px', 'litho' ),
			'active_callback' => 'litho_scroll_to_top_callback',
		)
	)
);

/* End Scroll To Top Font Size */

/* Scroll To Top Background Color */

$wp_customize->add_setting(
	'litho_scroll_to_top_background_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Litho_Alpha_Color_Control(
		$wp_customize,
		'litho_scroll_to_top_background_color',
		array(
			'label'           => esc_html__( 'Background color', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_background_color',
			'active_callback' => 'litho_scroll_to_top_callback',
			'priority'        => 9,
		)
	)
);

/* End Scroll To Top Background Color */

/* Scroll To Top Background Hover Color */

$wp_customize->add_setting(
	'litho_scroll_to_top_background_hover_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Litho_Alpha_Color_Control(
		$wp_customize,
		'litho_scroll_to_top_background_hover_color',
		array(
			'label'           => esc_html__( 'Background hover color', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_background_hover_color',
			'active_callback' => 'litho_scroll_to_top_callback',
			'priority'        => 9,
		)
	)
);

/* End Scroll To Top Background Hover Color */

/* Scroll To Top Color */

$wp_customize->add_setting(
	'litho_scroll_to_top_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Litho_Alpha_Color_Control(
		$wp_customize,
		'litho_scroll_to_top_color',
		array(
			'label'           => esc_html__( 'Color', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_color',
			'active_callback' => 'litho_scroll_to_top_callback',
			'priority'        => 9,
		)
	)
);

/* End Scroll To Top Color */

/* Scroll To Top Color */

$wp_customize->add_setting(
	'litho_scroll_to_top_hover_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new Litho_Alpha_Color_Control(
		$wp_customize,
		'litho_scroll_to_top_hover_color',
		array(
			'label'           => esc_html__( 'Hover color', 'litho' ),
			'section'         => 'litho_add_scroll_to_top_panel',
			'settings'        => 'litho_scroll_to_top_hover_color',
			'active_callback' => 'litho_scroll_to_top_callback',
			'priority'        => 9,
		)
	)
);

/* End Scroll To Top Color */

/* Callback Functions */

if ( ! function_exists( 'litho_scroll_to_top_callback' ) ) :

	/**
	 * Scroll to Top Callback
	 */
	function litho_scroll_to_top_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_hide_scroll_to_top' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Callback Functions */

/* Separator Settings */
$wp_customize->add_setting(
	'litho_portfolio_rewrite_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_portfolio_rewrite_separator',
		array(
			'label'       => esc_html__( 'Portfolio URL Slug', 'litho' ),
			'type'        => 'litho_separator',
			'description' => esc_html__( 'Set portfolio, categories and tags url slug. After updating slug in this setting please go to Settings > Permalinks and click Save Changes button to have this new url slug change affected in your overall website.', 'litho' ),
			'section'     => 'litho_add_portfolio_url_slug_panel',
			'settings'    => 'litho_portfolio_rewrite_separator',
			'priority'    => 6,
		)
	)
);

/* End Separator Settings */

/* Portfolio URL Slug */
$wp_customize->add_setting(
	'litho_portfolio_url_slug',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_portfolio_url_slug',
		array(
			'label'    => esc_html__( 'Portfolio URL Slug', 'litho' ),
			'section'  => 'litho_add_portfolio_url_slug_panel',
			'settings' => 'litho_portfolio_url_slug',
			'type'     => 'text',
			'priority' => 6,
		)
	)
);
/* End Portfolio URL Slug */

/* Categories URL Slug */
$wp_customize->add_setting(
	'litho_portfolio_cat_url_slug',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new WP_Customize_Control( $wp_customize, 'litho_portfolio_cat_url_slug', array(
	'label'       		=> esc_html__( 'Categories URL Slug', 'litho' ),
	'section'     		=> 'litho_add_portfolio_url_slug_panel',
	'settings'			=> 'litho_portfolio_cat_url_slug',
	'type'              => 'text',
	'priority'	 		=> 6,
) ) );
/* End Categories URL Slug */

/* Tags URL Slug */
$wp_customize->add_setting( 'litho_portfolio_tags_url_slug', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize, 'litho_portfolio_tags_url_slug',
		array(
			'label'       		=> esc_html__( 'Tags URL Slug', 'litho' ),
			'section'     		=> 'litho_add_portfolio_url_slug_panel',
			'settings'			=> 'litho_portfolio_tags_url_slug',
			'type'              => 'text',
			'priority'	 		=> 6,
		)
	)
);
/* End Tags URL Slug */

/* Separator Settings */
$wp_customize->add_setting( 'litho_image_meta_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_image_meta_separator', array(
	'label'      		=> esc_html__( 'Image meta data', 'litho' ),
	'type'              => 'litho_separator',
	'description'       => esc_html__('Set visibility for image alt, title and caption attributes by check marking below options.', 'litho' ),
	'section'    		=> 'litho_add_general_settings_panel',
	'settings'   		=> 'litho_image_meta_separator',
	'priority'	 		=> 6,
) ) );

/* End Separator Settings */

/* Render Image Alt */
$wp_customize->add_setting( 'litho_image_alt', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_image_alt', array(
	'label'       		=> esc_html__( 'Alt', 'litho' ),
	'section'     		=> 'litho_add_general_settings_panel',
	'settings'			=> 'litho_image_alt',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'priority'	 		=> 6,
) ) );

/* End Render Image Alt */

/* Render Image Title */
$wp_customize->add_setting( 'litho_image_title', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_image_title', array(
	'label'       		=> esc_html__( 'Title', 'litho' ),
	'section'     		=> 'litho_add_general_settings_panel',
	'settings'			=> 'litho_image_title',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'priority'	 		=> 6,
) ) );

/* End Render Image Title */

/* Show Image Title in Lightbox Popup */
$wp_customize->add_setting( 'litho_image_title_lightbox_popup', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_image_title_lightbox_popup', array(
	'label'       		=> esc_html__( 'Title in lightbox popup', 'litho' ),
	'section'     		=> 'litho_add_general_settings_panel',
	'settings'			=> 'litho_image_title_lightbox_popup',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'priority'	 		=> 6,
) ) );

/* End Show Image Title in Lightbox Popup */

/* Show Image Caption in Lightbox Popup */
$wp_customize->add_setting( 'litho_image_caption_lightbox_popup', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_image_caption_lightbox_popup', array(
	'label'       		=> esc_html__( 'Caption in lightbox popup', 'litho' ),
	'section'     		=> 'litho_add_general_settings_panel',
	'settings'			=> 'litho_image_caption_lightbox_popup',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
	'priority'	 		=> 6,
) ) );

/* End Show Image Caption in Lightbox Popup */


/* Disbale Style & Script Settings */
$wp_customize->add_setting( 'litho_styles_scripts_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_styles_scripts_separator', array(
	'label'     		=> esc_html__( 'Disable Styles & Scripts', 'litho' ),
	'type'              => 'litho_separator',
	'section'   		=> 'litho_add_disable_style_script_panel',
	'settings'  		=> 'litho_styles_scripts_separator',
	'priority'	 		=> 7,
) ) );

/* End Disbale Style & Script Settings */

/* Disable Styles */

$wp_customize->add_setting( 'litho_disable_style_details', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Checkbox_Multiple( $wp_customize, 'litho_disable_style_details', array(
	'label'     		=> esc_html__( 'Disable Styles', 'litho' ),
	'section'   		=> 'litho_add_disable_style_script_panel',
	'settings'			=> 'litho_disable_style_details',
	'type'              => 'litho_checkbox',
	'choices'   		=> array(
		'swiper'						=> esc_html__( 'Swiper', 'litho' ),
		'themify-icons'					=> esc_html__( 'Themify Icons', 'litho' ),
		'feather-icons' 				=> esc_html__( 'Feather Icons', 'litho' ),
		'simple-line-icons'				=> esc_html__( 'Simple Icons', 'litho' ),
		'et-line-icons' 				=> esc_html__( 'Et Line Icons', 'litho' ),
		'iconsmind-line-icons' 			=> esc_html__( 'Iconsmind Line Icons', 'litho' ),
		'iconsmind-solid-icons'			=> esc_html__( 'Iconsmind Solid Icons', 'litho' ),
		'font-awesome'					=> esc_html__( 'Font Awesome', 'litho' ),
		'justified-gallery'				=> esc_html__( 'Justified Gallery', 'litho' ),
		'mCustomScrollbar'				=> esc_html__( 'mCustomScrollbar', 'litho' ),
		'magnific-popup'				=> esc_html__( 'Magnific', 'litho' ),
		'hover-animation'				=> esc_html__( 'Hover Animation', 'litho' ),
	),
	'priority'			=> 7,
) ) );

/* End Disable Styles */

/* Disable Script */

$wp_customize->add_setting( 'litho_disable_script_details', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Checkbox_Multiple( $wp_customize, 'litho_disable_script_details', array(
	'label'    => esc_html__( 'Disable Scripts', 'litho' ),
	'section'  => 'litho_add_disable_style_script_panel',
	'settings' => 'litho_disable_script_details',
	'type'     => 'litho_checkbox',
	'priority' => 7,
	'choices'  => array(
		'smooth-scroll'       => esc_html__( 'Smooth Scroll', 'litho' ),
		'swiper'              => esc_html__( 'Swiper', 'litho' ),
		'justified-gallery'   => esc_html__( 'Justified Gallery', 'litho' ),
		'jquery-appear'       => esc_html__( 'Appear', 'litho' ),
		'imagesloaded'        => esc_html__( 'Images Loaded', 'litho' ),
		'isotope'             => esc_html__( 'Isotope', 'litho' ),
		'easypiechart'        => esc_html__( 'Easypiechart', 'litho' ),
		'infinite-scroll'     => esc_html__( 'Infinite Scroll', 'litho' ),
		'jquery-countdown'    => esc_html__( 'Countdown', 'litho' ),
		'sticky-kit'          => esc_html__( 'Sticky Kit', 'litho' ),
		'tilt'                => esc_html__( 'Tilt', 'litho' ),
		'mCustomScrollbar'    => esc_html__( 'mCustomScrollbar', 'litho' ),
		'fitvids'             => esc_html__( 'Fitvids', 'litho' ),
		'jquery-match-height' => esc_html__( 'Match Height', 'litho' ),
		'magnific-popup'      => esc_html__( 'Magnific', 'litho' ),
		'page-scroll'         => esc_html__( 'Page Scroll', 'litho' ),
	),
) ) );

/* End Disable Script */

/* Search Block Settings */
$wp_customize->add_setting( 'litho_search_block_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_search_block_separator', array(
	'label'				=> esc_html__( 'Search Page Settings', 'litho' ),
	'type'				=> 'litho_separator',
	'section'			=> 'litho_add_search_block_panel',
	'settings'			=> 'litho_search_block_separator',
) ) );

$wp_customize->add_setting( 'litho_search_content_setting', array(
	'default'			=> array( 'page', 'post' ),
	'sanitize_callback'	=> 'esc_attr'
) );
$wp_customize->add_control( new Litho_Customize_Checkbox_Multiple( $wp_customize, 'litho_search_content_setting', array(
	'label'				=> esc_html__( 'Search Options', 'litho' ),
	'type'				=> 'litho_checkbox_multiple',
	'section' 			=> 'litho_add_search_block_panel',
	'settings'			=> 'litho_search_content_setting',
	'choices'			=> $all_post_type, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
) ) );
/* End Search Block Settings */

/* GDPR Separator Setting */

$wp_customize->add_setting( 'litho_general_gdpr_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_general_gdpr_separator', array(
	'label'      		=> esc_html__( 'GDPR settings', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'   		=> 'litho_general_gdpr_separator',
) ) );

/* End GDPR Separator Setting */

/* GDPR Enable */
$wp_customize->add_setting( 'litho_gdpr_enable', array(
	'default' 			=> '0',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_gdpr_enable', array(
	'label'       		=> esc_html__( 'GDPR', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_enable',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
						   ),
) ) );

/* End GDPR Enable */

/* GDPR Style  */

$wp_customize->add_setting( 'litho_gdpr_style', array(
	'default' 			=> 'left-content',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Preview_Image_Control( $wp_customize, 'litho_gdpr_style', array(
	'label'       		=> esc_html__( 'GDPR style', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_style',
	'type'              => 'litho_preview_image',
	'choices'           => array(
								'full-content' 	   	=> esc_html__( 'Bottom full', 'litho' ),
								'left-content'      => esc_html__( 'Left corner', 'litho' ),
								'right-content'     => esc_html__( 'Right corner', 'litho' ),
							   ),
	'litho_img'			=> array(
								LITHO_THEME_IMAGES_URI . '/bottom.jpg',
								LITHO_THEME_IMAGES_URI . '/bottom-left.jpg',
								LITHO_THEME_IMAGES_URI . '/bottom-right.jpg',
						   ),
	'litho_columns'    	=> '4',
	'active_callback'   => 'litho_gdpr_callback',
) ) );

/* End GDPR Style */

/* GDPR Text Setting */
$wp_customize->add_setting( 'litho_gdpr_text', array(
	'default' 			=> sprintf( '%s <a href="/privacy-policy/" target="_blank">%s</a>', esc_html__( 'Our site uses cookies. By continuing to our site you are agreeing to our cookie', 'litho' ), esc_html__( 'privacy policy', 'litho' ) ),
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_text', array(
	'label'       		=> esc_html__( 'GDPR content', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_text',
	'type'              => 'textarea',
	'active_callback'   => 'litho_gdpr_callback',
) ) );

/* End GDPR Text Setting */

/* GDPR Button Text Setting */

$wp_customize->add_setting( 'litho_gdpr_button_text', array(
	'default' 			=> esc_html__( 'GOT IT', 'litho' ),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_button_text', array(
	'label'       		=> esc_html__( 'Button text', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_button_text',
	'type'              => 'text',
	'active_callback'   => 'litho_gdpr_callback',
) ) );

/* GDPR Button Text Setting */

/* GDPR General Separator Settings */
$wp_customize->add_setting( 'litho_gdpr_general_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_gdpr_general_separator', array(
	'label'      		=> esc_html__( 'General', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'   		=> 'litho_gdpr_general_separator',
	'active_callback'   => 'litho_gdpr_callback',
) ) );

/* End GDPR General Separator Settings */

/* GDPR Enable Overlay */

$wp_customize->add_setting( 'litho_gdpr_enable_overlay', array(
	'default' 			=> '1',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_gdpr_enable_overlay', array(
	'label'				=> esc_html__( 'Overlay', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_enable_overlay',
	'type'              => 'litho_switch',
	'choices'           => array(
								'1' => esc_html__( 'On', 'litho' ),
								'0' => esc_html__( 'Off', 'litho' ),
							),
	'active_callback' 	=> 'litho_gdpr_callback',
) ) );

/* End Enable Product image slider */

/* GDPR Box Background Color */

$wp_customize->add_setting( 'litho_gdpr_box_background_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_box_background_color', array(
	'label'      		=> esc_html__( 'Box background color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_box_background_color',
	'active_callback' 	=> 'litho_gdpr_callback',
) ) );

/* End GDPR Box Background Color */

/* GDPR Overlay Color */

$wp_customize->add_setting( 'litho_gdpr_overlay_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_overlay_color', array(
	'label'      		=> esc_html__( 'Overlay color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_overlay_color',
	'active_callback' 	=> 'litho_gdpr_overlay_callback',
) ) );

/* End GDPR Overlay Color */


/* GDPR Content Typography Separator setting */
$wp_customize->add_setting( 'litho_gdpr_content_typography_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_gdpr_content_typography_separator', array(
	'label'      		=> esc_html__( 'Content typography and color', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'   		=> 'litho_gdpr_content_typography_separator',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Content Typography Separator setting */

/* GDPR Content Font size setting*/
$wp_customize->add_setting( 'litho_gdpr_content_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_content_font_size', array(
	'label'       		=> esc_html__( 'Font size', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_content_font_size',
	'type'              => 'text',
	'description'       => esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Content Font size setting */

/* GDPR Content Line height setting*/
$wp_customize->add_setting( 'litho_gdpr_content_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_content_line_height', array(
	'label'       		=> esc_html__( 'Line height', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_content_line_height',
	'type'              => 'text',
	'description'       => esc_html__( 'In pixel like 15px', 'litho' ),
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Content Line height setting */

/* GDPR Content Letter spacing setting*/
$wp_customize->add_setting( 'litho_gdpr_content_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_content_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter spacing', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_content_letter_spacing',
	'type'              => 'text',
	'description'       => esc_html__( 'In pixel like 1px', 'litho' ),
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Content Letter spacing setting */

/* GDPR Content Font weight setting */

$wp_customize->add_setting( 'litho_gdpr_content_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_content_font_weight', array(
	'label'       		=> esc_html__( 'Font weight', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_content_font_weight',
	'type'              => 'select',
	'choices'           => $litho_font_weight, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Content Font weight setting */

/* GDPR Content Color setting*/
$wp_customize->add_setting( 'litho_gdpr_content_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_content_color', array(
	'label'       		=> esc_html__( 'Color', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_content_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Content Color setting */

/* GDPR Content Hover Color setting*/
$wp_customize->add_setting( 'litho_gdpr_content_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_content_hover_color', array(
	'label'       		=> esc_html__( 'Hover color', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_content_hover_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Content Hover Color setting */

/* Separator Settings */
$wp_customize->add_setting( 'litho_gdpr_button_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_gdpr_button_separator', array(
	'label'      		=> esc_html__( 'Button typography and colors', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'   		=> 'litho_gdpr_button_separator',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );

/* End Separator Settings */

/* GDPR Button Font Size */

$wp_customize->add_setting( 'litho_gdpr_button_font_size', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_button_font_size', array(
	'label'       		=> esc_html__( 'Font size', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_button_font_size',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define font size like 12px', 'litho' ),
	'active_callback'	=> 'litho_gdpr_callback',
) ) );

/* End Button GDPR Font Size */

/* GDPR Button Line Height */

$wp_customize->add_setting( 'litho_gdpr_button_line_height', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_button_line_height', array(
	'label'       		=> esc_html__( 'Line height', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_button_line_height',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define line height like 12px', 'litho' ),
	'active_callback'	=> 'litho_gdpr_callback',
) ) );

/* End GDPR Button Line Height */

/* GDPR Button Letter Spacing */

$wp_customize->add_setting( 'litho_gdpr_button_letter_spacing', array(
	'default' 			=> '',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_button_letter_spacing', array(
	'label'       		=> esc_html__( 'Letter spacing', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_button_letter_spacing',
	'type'              => 'text',
	'description'		=> esc_html__( 'Define letter spacing like 12px', 'litho' ),
	'active_callback'	=> 'litho_gdpr_callback',
) ) );

/* End GDPR Button Letter Spacing */

/* GDPR Button Font Weight */

$wp_customize->add_setting( 'litho_gdpr_button_font_weight', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_button_font_weight', array(
	'label'       		=> esc_html__( 'Font weight', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_button_font_weight',
	'type'              => 'select',
	'choices'           => $litho_font_weight, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'active_callback'	=> 'litho_gdpr_callback',
) ) );

/* End GDPR Button Font Weight */

/* GDPR Button Text Transform setting */

$wp_customize->add_setting( 'litho_gdpr_button_font_text_transform', array(
	'default' 			=> 'uppercase',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'litho_gdpr_button_font_text_transform', array(
	'label'       		=> esc_html__( 'Text Case', 'litho' ),
	'section'     		=> 'litho_add_gdpr_block_panel',
	'settings'			=> 'litho_gdpr_button_font_text_transform',
	'type'              => 'select',
	'choices'           => array(
		''				=> esc_html__( 'Select Title Text Transform', 'litho' ),
		'uppercase'		=> esc_html__( 'Uppercase', 'litho' ),
		'lowercase'		=> esc_html__( 'Lowercase', 'litho' ),
		'capitalize'	=> esc_html__( 'Capitalize', 'litho' ),
		'normal'		=> esc_html__( 'Normal', 'litho' ),
	),
	'active_callback'	=> 'litho_gdpr_callback',
) ) );

/* End GDPR Button Text Transform setting */

/* GDPR Button Background Color */

$wp_customize->add_setting( 'litho_gdpr_button_bg_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_button_bg_color', array(
	'label'      		=> esc_html__( 'Background color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_button_bg_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Button Background Color */

/* GDPR Button Background Hover Color */

$wp_customize->add_setting( 'litho_gdpr_button_bg_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_button_bg_hover_color', array(
	'label'      		=> esc_html__( 'Background hover color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_button_bg_hover_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Button Background Hover Color */

/* GDPR Button Color */

$wp_customize->add_setting( 'litho_gdpr_button_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_button_color', array(
	'label'      		=> esc_html__( 'Color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_button_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Button Color */

/* GDPR Button Hover Color */

$wp_customize->add_setting( 'litho_gdpr_button_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_button_hover_color', array(
	'label'      		=> esc_html__( 'Hover color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_button_hover_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Button Hover Color */

/* GDPR Border Button Color */

$wp_customize->add_setting( 'litho_gdpr_button_border_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_button_border_color', array(
	'label'      		=> esc_html__( 'Border color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_button_border_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );
/* End GDPR Border Button Color */

/* GDPR Border Button Hover Color */

$wp_customize->add_setting( 'litho_gdpr_button_border_hover_color', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( new Litho_Alpha_Color_Control( $wp_customize, 'litho_gdpr_button_border_hover_color', array(
	'label'      		=> esc_html__( 'Border hover color', 'litho' ),
	'section'    		=> 'litho_add_gdpr_block_panel',
	'settings'	 		=> 'litho_gdpr_button_border_hover_color',
	'active_callback'	=> 'litho_gdpr_callback',
) ) );

/* End Border GDPR Button Hover Color */

/* Callback Functions */

if ( ! function_exists( 'litho_gdpr_callback' ) ) :
	function litho_gdpr_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_gdpr_enable' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'litho_gdpr_overlay_callback' ) ) :
	function litho_gdpr_overlay_callback( $control ) {
		if ( $control->manager->get_setting( 'litho_gdpr_enable' )->value() == 1 && $control->manager->get_setting( 'litho_gdpr_enable_overlay' )->value() == 1 ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( is_litho_addons_activated() ) {

	/* Separator Settings */
	$wp_customize->add_setting( 'litho_svg_support_separator', array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_svg_support_separator', array(
		'label'      		=> esc_html__( 'SVG Support', 'litho' ),
		'type'              => 'litho_separator',
		'section'    		=> 'litho_other_settings_panel',
		'settings'   		=> 'litho_svg_support_separator',
		'priority'	 		=> 7,
	) ) );

	/* End Separator Settings */

	/* SVG Support */
	$wp_customize->add_setting( 'litho_svg_support', array(
		'default'           => '0',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Switch_Control( $wp_customize, 'litho_svg_support', array(
		'label'       => esc_html__( 'SVG Support', 'litho' ),
		'description' => esc_html__( 'Allow to support MIME Type like ( e.g., svg, ttf, woff, woff2, csv )', 'litho' ),
		'section'     => 'litho_other_settings_panel',
		'settings'    => 'litho_svg_support',
		'type'        => 'litho_switch',
		'choices'     => array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
			),
		'priority'    => 7,
	) ) );

	/* End SVG Support */
}

/* Separator Settings */
$wp_customize->add_setting(
	'litho_preload_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_preload_separator',
		array(
			'label'    => esc_html__( 'Preloader', 'litho' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_preloader_settings_panel',
			'settings' => 'litho_preload_separator',
			'priority' => 7,
		)
	)
);

/* End Separator Settings */

/* Preloader */
$wp_customize->add_setting(
	'litho_preload',
	array(
		'default'           => '0',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control(
	new Litho_Customize_Switch_Control(
		$wp_customize,
		'litho_preload',
		array(
			'label'       => esc_html__( 'Page Preloader', 'litho' ),
			'section'     => 'litho_preloader_settings_panel',
			'settings'    => 'litho_preload',
			'type'        => 'litho_switch',
			'choices'     => array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
			),
			'priority'    => 7,
		)
	)
);

/* End Preloader */

/* Preloader types setting */

$wp_customize->add_setting(
	'litho_preload_types',
	array(
		'default'           => 'style-1',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'litho_preload_types',
		array(
			'label'             => esc_html__( 'Preload types', 'litho' ),
			'section'           => 'litho_preloader_settings_panel',
			'settings'          => 'litho_preload_types',
			'type'              => 'select',
			'choices'           => array(
				''        => esc_html__( 'Select types', 'litho' ),
				'style-1' => esc_html__( 'Style 1', 'litho' ),
			),
			'priority'    => 7,
			'active_callback'   => 'litho_preload_callback',
		)
	)
);

/* Page Preloader Image */

$wp_customize->add_setting( 'litho_page_preload_image', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'litho_page_preload_image',
		array(
			'label'           => esc_html__( 'Preload image', 'litho' ),
			'section'         => 'litho_preloader_settings_panel',
			'settings'        => 'litho_page_preload_image',
			'priority'        => 7,
			'active_callback' => 'litho_preload_callback',
		)
	)
);

/* End Page Not Found Image */

/* Separator Settings */
$wp_customize->add_setting(
	'litho_preload_typography_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_preload_typography_separator',
		array(
			'label'           => esc_html__( 'Preloader Typography', 'litho' ),
			'type'            => 'litho_separator',
			'section'         => 'litho_preloader_settings_panel',
			'settings'        => 'litho_preload_typography_separator',
			'priority'        => 7,
			'active_callback' => 'litho_preload_callback',
		)
	)
);

/* End Separator Settings */

/* End Preloader types setting */

$wp_customize->add_setting(
	'litho_preload_bg_color',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	new Litho_Alpha_Color_Control(
		$wp_customize,
		'litho_preload_bg_color',
		array(
			'label'           => esc_html__( 'Background color', 'litho' ),
			'section'         => 'litho_preloader_settings_panel',
			'settings'        => 'litho_preload_bg_color',
			'active_callback' => 'litho_preload_callback',
		)
	)
);

/* Preloader callback functions */

if ( ! function_exists( 'litho_preload_callback' ) ) :
	function litho_preload_callback( $control ) {
		if ( '1' === $control->manager->get_setting( 'litho_preload' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/* End Preloader callback functions */
