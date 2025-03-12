<?php
/**
 * Metabox For Section Settings.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_description = '';
// Type of Template.
$litho_type_of_template_array = litho_get_template_type_by_key();
// Sticky header type.
$litho_section_sticky_type = litho_get_header_sticky_type_by_key();
// Sticky mini header type.
$litho_mini_header_sticky_type = litho_get_mini_header_sticky_type_by_key();
// Header layout style ( standard, left etc.. ).
$litho_template_header_style = litho_get_header_style_by_key();
// Sticky footer type.
$litho_footer_sticky_type = litho_get_footer_sticky_type_by_key();
// Archives.
$litho_template_archive_style = litho_get_archive_style_by_key();
// Archives Portfolio.
$litho_template_archive_portfolio_style = litho_get_archive_portfolio_style_by_key();

if ( is_sectionbuilder_screen() ) {

	$litho_section_builder_template = litho_post_meta_by_id( get_the_ID(), 'litho_section_builder_template' );

	if ( ! empty( $litho_section_builder_template ) ) {

		$header_class            = ' hidden';
		$footer_class            = ' hidden';
		$archive_class           = ' hidden';
		$archive_portfolio_class = ' hidden';
		$custom_title_class      = ' hidden';
		$promo_popup_class       = ' hidden';
		$side_icon_class         = ' hidden';

		switch ( $litho_section_builder_template ) {
			case 'mini-header':
			case 'header':
			default:
				$header_class = '';
				break;
			case 'footer':
				$footer_class = '';
				break;
			case 'archive':
				$archive_class = '';
				break;
			case 'archive-portfolio':
				$archive_portfolio_class = '';
				break;
			case 'custom-title':
				$custom_title_class = '';
				break;
			case 'promo_popup':
				$promo_popup_class = '';
				break;
			case 'side_icon':
				$side_icon_class = '';
				break;
		}

		$litho_description .= '<div class="mini-header header template-notice' . esc_attr( $header_class ) . '">' . esc_html__( 'Please select type of template like mini header, header etc... and then assign it at Appearance > Customize > Header and Footer.', 'litho-addons' ) . ' <a href="' . esc_url( LITHO_ADDONS_DEMO_URI . 'documentation/setup-your-website-header/?category=header' ) . '" target="_blank">' . esc_html__( 'Click here', 'litho-addons' ) . '</a> ' . esc_html__( 'for more information.', 'litho-addons' ) . '</div>';

		$litho_description .= '<div class="footer template-notice' . esc_attr( $footer_class ) . '">' . esc_html__( 'Please select type of template like footer and then assign it at Appearance > Customize > Header and Footer.', 'litho-addons' ) . ' <a href="' . esc_url( LITHO_ADDONS_DEMO_URI . 'documentation/setup-your-website-footer/?category=footer' ) . '" target="_blank">' . esc_html__( 'Click here', 'litho-addons' ) . '</a> ' . esc_html__( 'for more information.', 'litho-addons' ) . '</div>';

		$litho_description .= '<div class="archive template-notice' . esc_attr( $archive_class ) . '">' . esc_html__( 'Please select type of template like archive and select archive from dropdown.', 'litho-addons' ) . ' <a href="' . esc_url( LITHO_ADDONS_DEMO_URI . 'documentation/how-to-create-an-archive-template-for-post/?category=archive' ) . '" target="_blank">' . esc_html__( 'Click here', 'litho-addons' ) . '</a> ' . esc_html__( 'for more information.', 'litho-addons' ) . '</div>';

		$litho_description .= '<div class="archive-portfolio template-notice' . esc_attr( $archive_portfolio_class ) . '">' . esc_html__( 'Please select type of template archive portfolio and select archive from dropdown.', 'litho-addons' ) . ' <a href="' . esc_url( LITHO_ADDONS_DEMO_URI . 'documentation/how-to-create-an-archive-template-for-portfolio/?category=archive' ) . '" target="_blank">' . esc_html__( 'Click here', 'litho-addons' ) . '</a> ' . esc_html__( 'for more information.', 'litho-addons' ) . '</div>';

		$litho_description .= '<div class="custom-title template-notice' . esc_attr( $custom_title_class ) . '">' . esc_html__( 'Please select type of template page title and then assign it at Appearance > Customize > Title Wrapper.', 'litho-addons' ) . ' <a href="' . esc_url( LITHO_ADDONS_DEMO_URI . 'documentation/setup-your-website-page-title-area/?category=page-title' ) . '" target="_blank">' . esc_html__( 'Click here', 'litho-addons' ) . '</a> ' . esc_html__( 'for more information.', 'litho-addons' ) . '</div>';

		$litho_description .= '<div class="promo_popup template-notice' . esc_attr( $promo_popup_class ) . '">' . esc_html__( 'Please select type of template promo popup and then assign it at Appearance > Customize > General Theme Options > Promo Popup.', 'litho-addons' ) . ' <a href="' . esc_url( LITHO_ADDONS_DEMO_URI . 'documentation/how-to-setup-your-website-promo-popup' ) . '" target="_blank">' . esc_html__( 'Click here', 'litho-addons' ) . '</a> ' . esc_html__( 'for more information.', 'litho-addons' ) . '</div>';

		$litho_description .= '<div class="side_icon template-notice' . esc_attr( $side_icon_class ) . '">' . esc_html__( 'Please select type of template side icon and then assign it at Appearance > Customize > General Theme Options > Side Icon.', 'litho-addons' ) . ' <a href="' . esc_url( LITHO_ADDONS_DEMO_URI . 'documentation/how-to-setup-your-website-side-icon-button' ) . '" target="_blank">' . esc_html__( 'Click here', 'litho-addons' ) . '</a> ' . esc_html__( 'for more information.', 'litho-addons' ) . '</div>';
	}
}

/**
 * Section Settings
 */
litho_meta_box_separator(
	'litho_section_builder_template_settings',
	esc_html__( 'General Settings', 'litho-addons' ),
	$litho_description
);

litho_meta_box_dropdown(
	'litho_section_builder_template',
	esc_html__( 'Type of Template', 'litho-addons' ),
	$litho_type_of_template_array,
	''
);
litho_meta_box_dropdown(
	'litho_template_header_style',
	esc_html__( 'Header Style', 'litho-addons' ),
	$litho_template_header_style,
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_meta_box_dropdown(
	'litho_header_sticky_type',
	esc_html__( 'Sticky type', 'litho-addons' ),
	$litho_section_sticky_type,
	esc_html__( 'You will choose sticky type of section', 'litho-addons' ),
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_meta_box_dropdown(
	'litho_mini_header_sticky_type',
	esc_html__( 'Sticky type', 'litho-addons' ),
	$litho_mini_header_sticky_type,
	esc_html__( 'You will choose sticky type of section', 'litho-addons' ),
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);
litho_meta_box_dropdown(
	'litho_footer_sticky_type',
	esc_html__( 'Sticky type', 'litho-addons' ),
	$litho_footer_sticky_type,
	esc_html__( 'You will choose sticky type of section', 'litho-addons' ),
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'footer' ),
	)
);

litho_meta_box_dropdown_multiple(
	'litho_template_archive_style',
	esc_html__( 'Select Archive', 'litho-addons' ),
	$litho_template_archive_style,
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'archive' ),
	)
);
litho_meta_box_dropdown_multiple(
	'litho_template_archive_portfolio_style',
	esc_html__( 'Select Archive Portfolio', 'litho-addons' ),
	$litho_template_archive_portfolio_style,
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'archive-portfolio' ),
	)
);

/**
 * Mini Header Settings
 */

litho_meta_box_separator(
	'litho_mini_header_settings',
	esc_html__( 'Mini Header Settings', 'litho-addons' ),
	'',
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);
litho_after_main_separator_start(
	'separator_main_start',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);
// Mini Header Mobile Menu Color.
litho_meta_box_separator(
	'litho_mini_header_mobile_color',
	esc_html__( 'Mobile menu color', 'litho-addons' ),
	'',
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);
litho_after_inner_separator_start(
	'separator_start',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);
litho_meta_box_colorpicker(
	'litho_mini_header_mobile_menu_bg_color',
	esc_html__( 'Background color', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);

litho_meta_box_colorpicker(
	'litho_mini_header_mobile_menu_color',
	esc_html__( 'Color', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);

litho_meta_box_colorpicker(
	'litho_mini_header_mobile_menu_hover_color',
	esc_html__( 'Hover color', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);

litho_before_inner_separator_end(
	'separator_end',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);

litho_before_main_separator_end(
	'separator_main_end',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'mini-header' ),
	)
);
/**
 * Header Settings
 */

litho_meta_box_separator(
	'litho_header_color',
	esc_html__( 'Header Settings', 'litho-addons' ),
	'',
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_after_main_separator_start(
	'separator_main_start',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);

// Header Mobile Menu Color.
litho_meta_box_separator(
	'litho_header_mobile_navigation',
	esc_html__( 'Mobile Navigation', 'litho-addons' ),
	'',
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_after_inner_separator_start(
	'separator_start',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_meta_box_dropdown(
	'litho_header_mobile_menu_style',
	esc_html__( 'Menu Style', 'litho-addons' ),
	array(
		'classic'          => esc_html__( 'Classic', 'litho-addons' ),
		'modern'           => esc_html__( 'Modern', 'litho-addons' ),
		'full-screen-menu' => esc_html__( 'Full Screen', 'litho-addons' ),
	),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_meta_box_dropdown(
	'litho_header_mobile_menu_trigger_alignment',
	esc_html__( 'Trigger Alignment', 'litho-addons' ),
	array(
		'left'  => esc_html__( 'Left', 'litho-addons' ),
		'right' => esc_html__( 'Right', 'litho-addons' ),
	),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_meta_box_colorpicker(
	'litho_header_mobile_menu_navbar_bg_color',
	esc_html__( 'Navbar', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_meta_box_colorpicker(
	'litho_header_mobile_menu_bg_color',
	esc_html__( 'Background color', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_before_inner_separator_end(
	'separator_end',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);
litho_before_main_separator_end(
	'separator_main_end',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'header' ),
	)
);

/**
 * Promo Popup Settings
 */
litho_meta_box_separator(
	'litho_promo_popup_settings',
	esc_html__( 'Promo Popup Settings', 'litho-addons' ),
	'',
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_after_main_separator_start(
	'separator_main_start',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_meta_box_separator(
	'litho_promo_popup_general_settings',
	esc_html__( 'General settings', 'litho-addons' ),
	'',
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_after_inner_separator_start(
	'separator_start',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_meta_box_dropdown(
	'litho_display_promo_popup_after',
	esc_html__( 'Display popup after', 'litho-addons' ),
	array(
		''            => esc_html__( 'Select', 'litho-addons' ),
		'some-time'   => esc_html__( 'Some Time', 'litho-addons' ),
		'User-scroll' => esc_html__( 'User Scroll', 'litho-addons' ),
	),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_meta_box_text(
	'litho_delay_time_promo_popup',
	esc_html__( 'Delay time', 'litho-addons' ),
	esc_html__( 'Show popup after some time (in milliseconds)', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_meta_box_text(
	'litho_scroll_promo_popup',
	esc_html__( 'Scroll pixels', 'litho-addons' ),
	esc_html__( 'Number of pixels to scroll down', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_meta_box_text(
	'litho_promo_popup_cokkie_expire',
	esc_html__( 'Re-open popup after (in days)', 'litho-addons' ),
	esc_html__( 'By default popup will display again after 7 days', 'litho-addons' ),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_meta_box_dropdown(
	'litho_enable_mobile_promo_popup',
	esc_html__( 'Display in mobile', 'litho-addons' ),
	array(
		''  => esc_html__( 'Select', 'litho-addons' ),
		'0' => esc_html__( 'On', 'litho-addons' ),
		'1' => esc_html__( 'Off', 'litho-addons' ),
	),
	'',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_before_inner_separator_end(
	'separator_end',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
litho_before_main_separator_end(
	'separator_main_end',
	array(
		'element' => 'litho_section_builder_template',
		'value'   => array( 'promo_popup' ),
	)
);
