<?php
/**
 * Metabox For Post Setting.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

litho_meta_box_dropdown(
	'litho_featured_image_single',
	esc_html__( 'Featured Image in Post Page', 'litho-addons' ),
	array(
		'default' => esc_html__( 'Default', 'litho-addons' ),
		'1'       => esc_html__( 'On', 'litho-addons' ),
		'0'       => esc_html__( 'Off', 'litho-addons' ),
	),
	esc_html__( 'Select Off if you want to hide featured image in the post detail page.', 'litho-addons' )
);
litho_meta_box_textarea(
	'litho_quote_single',
	esc_html__( 'Blockquote', 'litho-addons' ),
	esc_html__( 'Add block quote content', 'litho-addons' )
);
litho_meta_box_dropdown(
	'litho_lightbox_image_single',
	esc_html__( 'List Type', 'litho-addons' ),
	array(
		'1' => esc_html__( 'Grid with Lightbox Popup', 'litho-addons' ),
		'0' => esc_html__( 'Slider', 'litho-addons' ),
	),
	esc_html__( 'Select listing type', 'litho-addons' )
);
litho_meta_box_upload_multiple(
	'litho_gallery_single',
	esc_html__( 'Images', 'litho-addons' ),
	esc_html__( 'Upload / select multiple images to build a gallery', 'litho-addons' )
);
litho_meta_box_dropdown(
	'litho_video_type_single',
	esc_html__( 'Video Type', 'litho-addons' ),
	array(
		'self'     => esc_html__( 'Self Hosted', 'litho-addons' ),
		'external' => esc_html__( 'External Url', 'litho-addons' ),
	),
	esc_html__( 'Select video type', 'litho-addons' )
);
litho_meta_box_dropdown(
	'litho_enable_mute_single',
	esc_html__( 'Video Mute', 'litho-addons' ),
	array(
		'1' => esc_html__( 'On', 'litho-addons' ),
		'0' => esc_html__( 'Off', 'litho-addons' ),
	),
	esc_html__( 'Select on to mute background video sound.', 'litho-addons' )
);
litho_meta_box_text(
	'litho_video_mp4_single',
	esc_html__( 'MP4', 'litho-addons' ),
	esc_html__( 'Video url is required here if self hosted option is selected', 'litho-addons' ),
	''
);
litho_meta_box_text(
	'litho_video_ogg_single',
	esc_html__( 'OGG', 'litho-addons' ),
	esc_html__( 'Video url is required here if self hosted option is selected', 'litho-addons' ),
	''
);
litho_meta_box_text(
	'litho_video_webm_single',
	esc_html__( 'WEBM', 'litho-addons' ),
	esc_html__( 'Video url is required here if self hosted option is selected', 'litho-addons' ),
	''
);
litho_meta_box_text(
	'litho_video_single',
	esc_html__( 'External video url', 'litho-addons' ),
	esc_html__( 'Video url is required here if external url option is selected.', 'litho-addons' ),
	esc_html__( 'Add YOUTUBE VIDEO EMBED URL like https://www.youtube.com/embed/xxxxxxxxxx, you will get this from youtube embed iframe src code. or add VIMEO VIDEO EMBED URL like https://player.vimeo.com/video/xxxxxxxx, you will get this from vimeo embed iframe src code.', 'litho-addons' )
);
litho_meta_box_textarea(
	'litho_audio_single',
	esc_html__( 'Audio URL (Oembed) OR Embed Code', 'litho-addons' ),
	esc_html__( 'Add code.', 'litho-addons' )
);
