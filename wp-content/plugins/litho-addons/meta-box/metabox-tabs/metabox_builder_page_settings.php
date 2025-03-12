<?php
/**
 * Metabox For Builder Page Settings
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Get All Register Mini Header Section List. */
$litho_mini_header_section_array = litho_get_builder_section_data( 'mini-header', true );
/* Get All Register Header Section List. */
$litho_header_section_array = litho_get_builder_section_data( 'header', true );
/* Get All Register Footer Section List. */
$litho_footer_section_array = litho_get_builder_section_data( 'footer', true );

litho_after_main_separator_start(
	'separator_main_start',
	''
);
/* Mini Header Settings Start */
litho_meta_box_separator(
	'litho_mini_header_separator_single',
	esc_html__( 'Mini header Settings', 'litho-addons' )
);

litho_after_inner_separator_start(
	'separator_start',
	''
);
litho_meta_box_dropdown(
	'litho_enable_mini_header_single',
	esc_html__( 'Mini header', 'litho-addons' ),
	array(
		'default' => esc_html__( 'Default', 'litho-addons' ),
		'1'       => esc_html__( 'On', 'litho-addons' ),
		'0'       => esc_html__( 'Off', 'litho-addons' ),
	)
);

litho_meta_box_dropdown(
	'litho_mini_header_section_single',
	esc_html__( 'Mini header section', 'litho-addons' ),
	$litho_mini_header_section_array,
	'',
	array(
		'element' => 'litho_enable_mini_header_single',
		'value'   => array( 'default', '1' ),
	)
);

litho_before_inner_separator_end(
	'separator_end',
	''
);
/* Mini Header Settings End */

/* Header Settings Start */
litho_meta_box_separator(
	'litho_header_separator_single',
	esc_html__( 'Header Settings', 'litho-addons' )
);

litho_after_inner_separator_start(
	'separator_start',
	''
);

litho_meta_box_dropdown(
	'litho_enable_header_single',
	esc_html__( 'Header', 'litho-addons' ),
	array(
		'default' => esc_html__( 'Default', 'litho-addons' ),
		'1'       => esc_html__( 'On', 'litho-addons' ),
		'0'       => esc_html__( 'Off', 'litho-addons' ),
	)
);

litho_meta_box_dropdown(
	'litho_header_section_single',
	esc_html__( 'Header section', 'litho-addons' ),
	$litho_header_section_array,
	'',
	array(
		'element' => 'litho_enable_header_single',
		'value'   => array( 'default', '1' ),
	)
);
litho_before_inner_separator_end(
	'separator_end',
	''
);
/* Header Settings End */

/* Footer Settings Start */
litho_meta_box_separator(
	'litho_footer_separator_single',
	esc_html__( 'Footer Settings', 'litho-addons' )
);
litho_after_inner_separator_start(
	'separator_start',
	''
);
litho_meta_box_dropdown(
	'litho_enable_footer_single',
	esc_html__( 'Footer', 'litho-addons' ),
	array(
		'default' => esc_html__( 'Default', 'litho-addons' ),
		'1'       => esc_html__( 'On', 'litho-addons' ),
		'0'       => esc_html__( 'Off', 'litho-addons' ),
	)
);
litho_meta_box_dropdown(
	'litho_footer_section_single',
	esc_html__( 'Footer section', 'litho-addons' ),
	$litho_footer_section_array,
	'',
	array(
		'element' => 'litho_enable_footer_single',
		'value'   => array( 'default', '1' ),
	)
);

litho_before_inner_separator_end(
	'separator_end',
	''
);
/* Footer Settings End */
litho_before_main_separator_end(
	'separator_main_end',
	''
);
