<?php
/**
 * Metabox For Portfolio Setting.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

litho_meta_box_text(
	'litho_subtitle_single',
	esc_html__( 'Subtitle', 'litho-addons' ),
	''
);
litho_meta_box_text(
	'litho_portfolio_external_link_single',
	esc_html__( 'External Link', 'litho-addons' )
);
litho_meta_box_dropdown(
	'litho_portfolio_link_target_single',
	esc_html__( 'Target', 'litho-addons' ),
	array(
		'_self'  => esc_html__( 'Self', 'litho-addons' ),
		'_blank' => esc_html__( 'New Window', 'litho-addons' ),
	)
);
