<?php
/**
 * Metabox For Post Layout Setting.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_sidebar_array = litho_register_sidebar_array();

litho_after_main_separator_start(
	'separator_main_start',
	''
);
	litho_meta_box_dropdown(
		'litho_post_layout_setting_single',
		esc_html__( 'Sidebar settings', 'litho-addons' ),
		array(
			'default'                    => esc_html__( 'Default', 'litho-addons' ),
			'litho_layout_no_sidebar'    => esc_html__( 'No sidebar', 'litho-addons' ),
			'litho_layout_left_sidebar'  => esc_html__( 'Left sidebar', 'litho-addons' ),
			'litho_layout_right_sidebar' => esc_html__( 'Right sidebar', 'litho-addons' ),
			'litho_layout_both_sidebar'  => esc_html__( 'Both sidebar', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown_sidebar(
		'litho_post_left_sidebar_single',
		esc_html__( 'Left sidebar', 'litho-addons' ),
		$litho_sidebar_array,
		esc_html__( 'Select sidebar to display in left column of page', 'litho-addons' ),
		array(
			'element' => 'litho_post_layout_setting_single',
			'value'   => array( 'default', 'litho_layout_left_sidebar', 'litho_layout_both_sidebar' ),
		)
	);
	litho_meta_box_dropdown_sidebar(
		'litho_post_right_sidebar_single',
		esc_html__( 'Right sidebar', 'litho-addons' ),
		$litho_sidebar_array,
		esc_html__( 'Select sidebar to display in right column of page', 'litho-addons' ),
		array(
			'element' => 'litho_post_layout_setting_single',
			'value'   => array( 'default', 'litho_layout_right_sidebar', 'litho_layout_both_sidebar' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_post_container_style_single',
		esc_html__( 'Container style', 'litho-addons' ),
		array(
			'default'                      => esc_html__( 'Default', 'litho-addons' ),
			'container'                    => esc_html__( 'Fixed', 'litho-addons' ),
			'container-fluid'              => esc_html__( 'Full Width', 'litho-addons' ),
			'container-fluid-with-padding' => esc_html__( 'Full width ( with paddings )', 'litho-addons' ),
		)
	);
	litho_meta_box_text(
		'litho_post_container_fluid_with_padding_single',
		esc_html__( 'Full width padding', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_post_container_style_single',
			'value'   => array( 'default', 'container-fluid-with-padding' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_post_within_content_area_single',
		esc_html__( 'Within content area', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_box_layout_single',
		esc_html__( 'Box layout', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_before_main_separator_end(
		'separator_main_end',
		''
	);
