<?php
/**
 * Metabox For Content.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'post' === $post->post_type ) {
	litho_meta_box_dropdown(
		'litho_enable_comment_single',
		esc_html__( 'Comment', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
} elseif ( 'portfolio' === $post->post_type ) {
	litho_meta_box_dropdown(
		'litho_hide_single_portfolio_comment_single',
		esc_html__( 'Comment', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
} else {

	litho_meta_box_dropdown(
		'litho_hide_page_comment_single',
		esc_html__( 'Comments', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
}
