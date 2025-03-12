<?php
/**
 * Metabox For Title Wrapper.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Get all register custom title section list. */
$litho_custom_title_section_array = litho_get_builder_section_data( 'custom-title', true );

/* If WooCommerce plugin is activated */
if ( 'product' === $post->post_type && is_woocommerce_activated() ) {

	litho_after_main_separator_start(
		'separator_main_start',
		''
	);
	litho_meta_box_dropdown(
		'litho_enable_custom_title_single',
		esc_html__( 'Title', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_custom_title_section_single',
		esc_html__( 'Title section', 'litho-addons' ),
		$litho_custom_title_section_array,
		'',
		array(
			'element' => 'litho_enable_custom_title_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_colorpicker(
		'litho_single_product_title_gradient_color_first_single',
		esc_html__( 'Select Color 1', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_product_title_gradient_color_second_single',
		esc_html__( 'Select Color 2', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_product_title_gradient_color_third_single',
		esc_html__( 'Select Color 3', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_product_title_gradient_color_fourth_single',
		esc_html__( 'Select Color 4', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_product_title_gradient_color_fifth_single',
		esc_html__( 'Select Color 5', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_text(
		'litho_single_product_title_subtitle_single',
		esc_html__( 'Subtitle', 'litho-addons' ),
		'',
		''
	);
	litho_meta_box_upload(
		'litho_single_product_title_bg_image_single',
		esc_html__( 'Background image', 'litho-addons' ),
		esc_html__( 'Recommended image size is 1920px X 700px.', 'litho-addons' )
	);
	litho_meta_box_upload_multiple(
		'litho_single_product_title_bg_multiple_image_single',
		esc_html__( 'Background gallery images', 'litho-addons' ),
		esc_html__( 'Use only for gallery background title style.', 'litho-addons' )
	);
	litho_meta_box_text(
		'litho_single_product_title_callto_section_id_single',
		esc_html__( 'Next section ID', 'litho-addons' ),
		esc_html__( 'Use only for big Typography & gallery background title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_product_title_video_mp4_single',
		esc_html__( 'MP4', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_product_title_video_ogg_single',
		esc_html__( 'OGG', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_product_title_video_webm_single',
		esc_html__( 'WEBM', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_product_title_video_youtube_single',
		esc_html__( 'External video url', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_dropdown(
		'litho_single_product_title_parallax_effect_single',
		esc_html__( 'Parallax effects', 'litho-addons' ),
		array(
			'default'     => esc_html__( 'Default', 'litho-addons' ),
			'no-parallax' => esc_html__( 'No Parallax', 'litho-addons' ),
			'0.1'         => esc_html__( 'Parallax Effect 1', 'litho-addons' ),
			'0.2'         => esc_html__( 'Parallax Effect 2', 'litho-addons' ),
			'0.3'         => esc_html__( 'Parallax Effect 3', 'litho-addons' ),
			'0.4'         => esc_html__( 'Parallax Effect 4', 'litho-addons' ),
			'0.5'         => esc_html__( 'Parallax Effect 5', 'litho-addons' ),
			'0.6'         => esc_html__( 'Parallax Effect 6', 'litho-addons' ),
			'0.7'         => esc_html__( 'Parallax Effect 7', 'litho-addons' ),
			'0.8'         => esc_html__( 'Parallax Effect 8', 'litho-addons' ),
			'0.9'         => esc_html__( 'Parallax Effect 9', 'litho-addons' ),
			'1.0'         => esc_html__( 'Parallax Effect 10', 'litho-addons' ),
		),
		esc_html__( 'Choose parallax effect', 'litho-addons' )
	);

	litho_before_main_separator_end(
		'separator_main_end',
		''
	);
} elseif ( 'portfolio' === $post->post_type ) {

	litho_after_main_separator_start(
		'separator_main_start',
		''
	);
	litho_meta_box_dropdown(
		'litho_enable_custom_title_single',
		esc_html__( 'Title', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_custom_title_section_single',
		esc_html__( 'Title section', 'litho-addons' ),
		$litho_custom_title_section_array,
		'',
		array(
			'element' => 'litho_enable_custom_title_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_colorpicker(
		'litho_single_portfolio_title_gradient_color_first_single',
		esc_html__( 'Select Color 1', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_portfolio_title_gradient_color_second_single',
		esc_html__( 'Select Color 2', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_portfolio_title_gradient_color_third_single',
		esc_html__( 'Select Color 3', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_portfolio_title_gradient_color_fourth_single',
		esc_html__( 'Select Color 4', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_portfolio_title_gradient_color_fifth_single',
		esc_html__( 'Select Color 5', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_text(
		'litho_single_portfolio_title_subtitle_single',
		esc_html__( 'Subtitle', 'litho-addons' ),
		'',
		''
	);
	litho_meta_box_upload(
		'litho_single_portfolio_title_bg_image_single',
		esc_html__( 'Background image', 'litho-addons' ),
		esc_html__( 'Recommended image size is 1920px X 700px.', 'litho-addons' )
	);
	litho_meta_box_upload_multiple(
		'litho_single_portfolio_title_bg_multiple_image_single',
		esc_html__( 'Background gallery images', 'litho-addons' ),
		esc_html__( 'Use only for gallery background title style.', 'litho-addons' )
	);
	litho_meta_box_text(
		'litho_single_portfolio_title_callto_section_id_single',
		esc_html__( 'Next section ID', 'litho-addons' ),
		esc_html__( 'Use only for big Typography & gallery background title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_portfolio_title_video_mp4_single',
		esc_html__( 'MP4', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_portfolio_title_video_ogg_single',
		esc_html__( 'OGG', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_portfolio_title_video_webm_single',
		esc_html__( 'WEBM', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_portfolio_title_video_youtube_single',
		esc_html__( 'External video url', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_dropdown(
		'litho_single_portfolio_title_parallax_effect_single',
		esc_html__( 'Parallax effects', 'litho-addons' ),
		array(
			'default'     => esc_html__( 'Default', 'litho-addons' ),
			'no-parallax' => esc_html__( 'No Parallax', 'litho-addons' ),
			'0.1'         => esc_html__( 'Parallax Effect 1', 'litho-addons' ),
			'0.2'         => esc_html__( 'Parallax Effect 2', 'litho-addons' ),
			'0.3'         => esc_html__( 'Parallax Effect 3', 'litho-addons' ),
			'0.4'         => esc_html__( 'Parallax Effect 4', 'litho-addons' ),
			'0.5'         => esc_html__( 'Parallax Effect 5', 'litho-addons' ),
			'0.6'         => esc_html__( 'Parallax Effect 6', 'litho-addons' ),
			'0.7'         => esc_html__( 'Parallax Effect 7', 'litho-addons' ),
			'0.8'         => esc_html__( 'Parallax Effect 8', 'litho-addons' ),
			'0.9'         => esc_html__( 'Parallax Effect 9', 'litho-addons' ),
			'1.0'         => esc_html__( 'Parallax Effect 10', 'litho-addons' ),
		),
		esc_html__( 'Choose parallax effect', 'litho-addons' )
	);
	litho_before_main_separator_end(
		'separator_main_end',
		''
	);

} elseif ( 'post' === $post->post_type ) {

	litho_after_main_separator_start(
		'separator_main_start',
		''
	);
	litho_meta_box_dropdown(
		'litho_enable_custom_title_single',
		esc_html__( 'Title', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_custom_title_section_single',
		esc_html__( 'Title section', 'litho-addons' ),
		$litho_custom_title_section_array,
		'',
		array(
			'element' => 'litho_enable_custom_title_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_colorpicker(
		'litho_single_post_title_gradient_color_first_single',
		esc_html__( 'Select Color 1', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_post_title_gradient_color_second_single',
		esc_html__( 'Select Color 2', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_post_title_gradient_color_third_single',
		esc_html__( 'Select Color 3', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_post_title_gradient_color_fourth_single',
		esc_html__( 'Select Color 4', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_single_post_title_gradient_color_fifth_single',
		esc_html__( 'Select Color 5', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_text(
		'litho_single_post_title_subtitle_single',
		esc_html__( 'Subtitle', 'litho-addons' ),
		'',
		''
	);
	litho_meta_box_upload(
		'litho_single_post_title_bg_image_single',
		esc_html__( 'Background image', 'litho-addons' ),
		esc_html__( 'Recommended image size is 1920px X 700px.', 'litho-addons' )
	);
	litho_meta_box_upload_multiple(
		'litho_single_post_title_bg_multiple_image_single',
		esc_html__( 'Background gallery images', 'litho-addons' ),
		esc_html__( 'Use only for gallery background title style.', 'litho-addons' )
	);
	litho_meta_box_text(
		'litho_single_post_title_callto_section_id_single',
		esc_html__( 'Next section ID', 'litho-addons' ),
		esc_html__( 'Use only for big Typography & gallery background title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_post_title_video_mp4_single',
		esc_html__( 'MP4', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_post_title_video_ogg_single',
		esc_html__( 'OGG', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_post_title_video_webm_single',
		esc_html__( 'WEBM', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_single_post_title_video_youtube_single',
		esc_html__( 'External video url', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_dropdown(
		'litho_single_post_title_parallax_effect_single',
		esc_html__( 'Parallax effects', 'litho-addons' ),
		array(
			'default'     => esc_html__( 'Default', 'litho-addons' ),
			'no-parallax' => esc_html__( 'No Parallax', 'litho-addons' ),
			'0.1'         => esc_html__( 'Parallax Effect 1', 'litho-addons' ),
			'0.2'         => esc_html__( 'Parallax Effect 2', 'litho-addons' ),
			'0.3'         => esc_html__( 'Parallax Effect 3', 'litho-addons' ),
			'0.4'         => esc_html__( 'Parallax Effect 4', 'litho-addons' ),
			'0.5'         => esc_html__( 'Parallax Effect 5', 'litho-addons' ),
			'0.6'         => esc_html__( 'Parallax Effect 6', 'litho-addons' ),
			'0.7'         => esc_html__( 'Parallax Effect 7', 'litho-addons' ),
			'0.8'         => esc_html__( 'Parallax Effect 8', 'litho-addons' ),
			'0.9'         => esc_html__( 'Parallax Effect 9', 'litho-addons' ),
			'1.0'         => esc_html__( 'Parallax Effect 10', 'litho-addons' ),
		),
		esc_html__( 'Choose parallax effect', 'litho-addons' )
	);

	litho_before_main_separator_end(
		'separator_main_end',
		''
	);

} else {

	litho_after_main_separator_start(
		'separator_main_start',
		''
	);
	litho_meta_box_dropdown(
		'litho_enable_custom_title_single',
		esc_html__( 'Title', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_custom_title_section_single',
		esc_html__( 'Title section', 'litho-addons' ),
		$litho_custom_title_section_array,
		'',
		array(
			'element' => 'litho_enable_custom_title_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_colorpicker(
		'litho_page_title_gradient_color_first_single',
		esc_html__( 'Select Color 1', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_page_title_gradient_color_second_single',
		esc_html__( 'Select Color 2', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_page_title_gradient_color_third_single',
		esc_html__( 'Select Color 3', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_page_title_gradient_color_fourth_single',
		esc_html__( 'Select Color 4', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_colorpicker(
		'litho_page_title_gradient_color_fifth_single',
		esc_html__( 'Select Color 5', 'litho-addons' ),
		esc_html__( 'Use only for colorful title style.', 'litho-addons' )
	);
	litho_meta_box_text(
		'litho_page_title_subtitle_single',
		esc_html__( 'Subtitle', 'litho-addons' ),
		'',
		''
	);
	litho_meta_box_upload(
		'litho_page_title_bg_image_single',
		esc_html__( 'Background image', 'litho-addons' ),
		esc_html__( 'Recommended image size is 1920px X 700px.', 'litho-addons' )
	);
	litho_meta_box_upload_multiple(
		'litho_page_title_bg_multiple_image_single',
		esc_html__( 'Background gallery images', 'litho-addons' ),
		esc_html__( 'Use only for gallery background title style.', 'litho-addons' )
	);

	litho_meta_box_text(
		'litho_page_title_callto_section_id_single',
		esc_html__( 'Next section ID', 'litho-addons' ),
		esc_html__( 'Use only for big Typography & gallery background title style.', 'litho-addons' ),
		'',
		array(
			'element' => 'litho_page_title_scroll_to_down_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_text(
		'litho_page_title_video_mp4_single',
		esc_html__( 'MP4', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_page_title_video_ogg_single',
		esc_html__( 'OGG', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_page_title_video_webm_single',
		esc_html__( 'WEBM', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_text(
		'litho_page_title_video_youtube_single',
		esc_html__( 'External video url', 'litho-addons' ),
		esc_html__( 'Use only for background video title style.', 'litho-addons' ),
		''
	);
	litho_meta_box_dropdown(
		'litho_page_title_parallax_effect_single',
		esc_html__( 'Parallax effects', 'litho-addons' ),
		array(
			'default'     => esc_html__( 'Default', 'litho-addons' ),
			'no-parallax' => esc_html__( 'No Parallax', 'litho-addons' ),
			'0.1'         => esc_html__( 'Parallax Effect 1', 'litho-addons' ),
			'0.2'         => esc_html__( 'Parallax Effect 2', 'litho-addons' ),
			'0.3'         => esc_html__( 'Parallax Effect 3', 'litho-addons' ),
			'0.4'         => esc_html__( 'Parallax Effect 4', 'litho-addons' ),
			'0.5'         => esc_html__( 'Parallax Effect 5', 'litho-addons' ),
			'0.6'         => esc_html__( 'Parallax Effect 6', 'litho-addons' ),
			'0.7'         => esc_html__( 'Parallax Effect 7', 'litho-addons' ),
			'0.8'         => esc_html__( 'Parallax Effect 8', 'litho-addons' ),
			'0.9'         => esc_html__( 'Parallax Effect 9', 'litho-addons' ),
			'1.0'         => esc_html__( 'Parallax Effect 10', 'litho-addons' ),
		),
		esc_html__( 'Choose parallax effect', 'litho-addons' )
	);
	litho_before_main_separator_end(
		'separator_main_end',
		''
	);
}
