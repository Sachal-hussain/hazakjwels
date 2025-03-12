<?php
/**
 * Metabox For Single Post Layout.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'post' === $post->post_type ) {

	litho_after_main_separator_start(
		'separator_main_start',
		''
	);
	litho_meta_box_separator(
		'litho_post_settings_separator_single',
		esc_html__( 'Single post settings', 'litho-addons' )
	);

	litho_after_inner_separator_start(
		'separator_start',
		''
	);
	litho_meta_box_dropdown(
		'litho_post_layout_style_single',
		esc_html__( 'Post layout style', 'litho-addons' ),
		array(
			'default'              => esc_html__( 'Default', 'litho-addons' ),
			'post-layout-standard' => esc_html__( 'Post Layout Standard', 'litho-addons' ),
			'post-layout-style-1'  => esc_html__( 'Post Layout Style 1', 'litho-addons' ),
			'post-layout-style-2'  => esc_html__( 'Post Layout Style 2', 'litho-addons' ),
			'post-layout-style-3'  => esc_html__( 'Post Layout Style 3', 'litho-addons' ),
			'post-layout-style-4'  => esc_html__( 'Post Layout Style 4', 'litho-addons' ),
			'post-layout-style-5'  => esc_html__( 'Post Layout Style 5', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_post_layout_container_style_single',
		esc_html__( 'Container style', 'litho-addons' ),
		array(
			'default'                      => esc_html__( 'Default', 'litho-addons' ),
			'container'                    => esc_html__( 'Fixed', 'litho-addons' ),
			'container-fluid'              => esc_html__( 'Full Width', 'litho-addons' ),
			'container-fluid-with-padding' => esc_html__( 'Full width ( with paddings )', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_post_layout_style_single',
			'value'   => array( 'default', 'post-layout-style-1', 'post-layout-style-2', 'post-layout-style-3', 'post-layout-style-4', 'post-layout-style-5' ),
		)
	);
	litho_meta_box_text(
		'litho_post_layout_container_fluid_with_padding_single',
		esc_html__( 'Full width padding', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_post_layout_style_single',
			'value'   => array( 'default', 'post-layout-style-1', 'post-layout-style-2', 'post-layout-style-3', 'post-layout-style-4', 'post-layout-style-5' ),
		)
	);
	litho_meta_box_text(
		'litho_post_layout_overlap_text_single',
		esc_html__( 'Overlap Text', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_post_layout_style_single',
			'value'   => array( 'default', 'post-layout-style-3' ),
		)
	);
	litho_meta_box_upload(
		'litho_post_layout_bg_image_single',
		esc_html__( 'Background Image', 'litho-addons' ),
		'',
		array(
			'element' => 'litho_post_layout_style_single',
			'value'   => array( 'default', 'post-layout-style-2' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_post_title_single',
		esc_html__( 'Title', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_heading_tag_single',
		esc_html__( 'Heading tag', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'h1'      => esc_html__( 'H1', 'litho-addons' ),
			'h2'      => esc_html__( 'H2', 'litho-addons' ),
			'h3'      => esc_html__( 'H3', 'litho-addons' ),
			'h4'      => esc_html__( 'H4', 'litho-addons' ),
			'h5'      => esc_html__( 'H5', 'litho-addons' ),
			'h6'      => esc_html__( 'H6', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_category_single',
		esc_html__( 'Category', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_date_single',
		esc_html__( 'Date', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_text(
		'litho_post_date_format_single',
		esc_html__( 'Date format', 'litho-addons' ),
		sprintf(
			'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
			esc_html__( 'Date format should be like F j, Y', 'litho-addons' ),
			esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
			esc_html__( 'click here', 'litho-addons' ),
			esc_html__( 'to see other date formates.', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_date_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_author_single',
		esc_html__( 'Author', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_tags_single',
		esc_html__( 'Tags', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_navigation_link_single',
		esc_html__( 'Navigation link', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_like_single',
		esc_html__( 'Like', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_share_single',
		esc_html__( 'Share', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_enable_post_author_box_single',
		esc_html__( 'Author box', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_upload(
		'litho_single_post_bg_pattern_single',
		esc_html__( 'Background pattern image', 'litho-addons' ),
		'',
		array(
			'element' => 'litho_post_layout_style_single',
			'value'   => array( 'default', 'post-layout-style-1' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_single_post_top_space_single',
		esc_html__( 'Add top space of header height', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		''
	);
	litho_before_inner_separator_end(
		'separator_end',
		''
	);

	litho_meta_box_separator(
		'litho_single_related_posts_single',
		esc_html__( 'Related posts', 'litho-addons' )
	);

	litho_after_inner_separator_start(
		'separator_start',
		''
	);
	litho_meta_box_dropdown(
		'litho_enable_related_posts_single',
		esc_html__( 'Related posts', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_no_of_related_posts_columns_single',
		esc_html__( 'No. of columns', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => '1',
			'2'       => '2',
			'3'       => '3',
			'4'       => '4',
			'5'       => '5',
			'6'       => '6',
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_text(
		'litho_related_posts_title_single',
		esc_html__( 'Title', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_text(
		'litho_related_posts_subtitle_single',
		esc_html__( 'Subtitle', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_no_of_related_posts_single',
		esc_html__( 'No. of posts', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => '1',
			'2'       => '2',
			'3'       => '3',
			'4'       => '4',
			'5'       => '5',
			'6'       => '6',
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_related_posts_enable_date_single',
		esc_html__( 'Post date', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_text(
		'litho_related_posts_date_format_single',
		esc_html__( 'Post date format', 'litho-addons' ),
		sprintf(
			'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
			esc_html__( 'Date format should be like F j, Y', 'litho-addons' ),
			esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
			esc_html__( 'click here', 'litho-addons' ),
			esc_html__( 'to see other date formates.', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_related_posts_enable_date_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_related_posts_enable_author_single',
		esc_html__( 'Post author', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_related_post_excerpt_single',
		esc_html__( 'Post excerpt', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_text(
		'litho_related_post_excerpt_length_single',
		esc_html__( 'Excerpt length', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_related_post_enable_button_single',
		esc_html__( 'Read more', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_text(
		'litho_related_post_button_text_single',
		esc_html__( 'Read more text', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_related_post_enable_category_single',
		esc_html__( 'Post category', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_related_post_enable_comment_single',
		esc_html__( 'Post comment', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_related_post_enable_like_single',
		esc_html__( 'Post like', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_related_posts_separator_single',
		esc_html__( 'Post separator', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_enable_related_posts_single',
			'value'   => array( 'default', '1' ),
		)
	);
	litho_before_inner_separator_end(
		'separator_end',
		''
	);
	litho_before_main_separator_end(
		'separator_main_end',
		''
	);

} elseif ( 'portfolio' === $post->post_type ) {

	// Portfolio Style & Data.

	litho_after_main_separator_start(
		'separator_main_start',
		''
	);
	litho_meta_box_separator(
		'litho_portfolio_settings_separator_single',
		esc_html__( 'Single portfolio settings', 'litho-addons' )
	);

	litho_after_inner_separator_start(
		'separator_start',
		''
	);

	litho_meta_box_dropdown(
		'litho_portfolio_featured_image_single',
		esc_html__( 'Featured image', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_portfolio_enable_category_single',
		esc_html__( 'Category', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_portfolio_enable_tag_single',
		esc_html__( 'Tags', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_hide_navigation_single_portfolio_single',
		esc_html__( 'Navigation link', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_hide_single_portfolio_share_single',
		esc_html__( 'Share', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);

	litho_meta_box_text(
		'litho_single_portfolio_share_title_single',
		esc_html__( 'Share Heading', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_hide_single_portfolio_share_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_colorpicker(
		'litho_single_portfolio_item_hover_color_single',
		esc_html__( 'Colorful Style Hover Color', 'litho-addons' )
	);
	litho_before_inner_separator_end(
		'separator_end',
		''
	);

	litho_meta_box_separator(
		'litho_single_related_portfolio_single',
		esc_html__( 'Related portfolio', 'litho-addons' )
	);

	litho_after_inner_separator_start(
		'separator_start',
		''
	);

	litho_meta_box_dropdown(
		'litho_hide_related_single_portfolio_single',
		esc_html__( 'Related portfolio', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => esc_html__( 'On', 'litho-addons' ),
			'0'       => esc_html__( 'Off', 'litho-addons' ),
		)
	);
	litho_meta_box_dropdown(
		'litho_no_of_related_single_portfolio_columns_single',
		esc_html__( 'No. of columns', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => '1',
			'2'       => '2',
			'3'       => '3',
			'4'       => '4',
			'5'       => '5',
			'6'       => '6',
		),
		'',
		array(
			'element' => 'litho_hide_related_single_portfolio_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_text(
		'litho_related_single_portfolio_title_single',
		esc_html__( 'Title', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_hide_related_single_portfolio_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_textarea(
		'litho_related_single_portfolio_content_single',
		esc_html__( 'Content', 'litho-addons' ),
		'',
		'',
		array(
			'element' => 'litho_hide_related_single_portfolio_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_no_of_related_single_portfolio_single',
		esc_html__( 'No. of portfolio', 'litho-addons' ),
		array(
			'default' => esc_html__( 'Default', 'litho-addons' ),
			'1'       => '1',
			'2'       => '2',
			'3'       => '3',
			'4'       => '4',
			'5'       => '5',
			'6'       => '6',
		),
		'',
		array(
			'element' => 'litho_hide_related_single_portfolio_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_related_single_portfolio_display_by_single',
		esc_html__( 'Related portfolio display by', 'litho-addons' ),
		array(
			'default'            => esc_html__( 'Default', 'litho-addons' ),
			'portfolio-category' => esc_html__( 'Categories', 'litho-addons' ),
			'portfolio-tags'     => esc_html__( 'Tags', 'litho-addons' ),
		),
		'',
		array(
			'element' => 'litho_hide_related_single_portfolio_single',
			'value'   => array( 'default', '1' ),
		)
	);

	litho_meta_box_dropdown(
		'litho_related_single_portfolio_subtitle_text_transform_single',
		esc_html__( 'Related portfolio content text case', 'litho-addons' ),
		array(
			'default'    => esc_html__( 'Default', 'litho-addons' ),
			'uppercase'  => esc_html__( 'Uppercase', 'litho-addons' ),
			'lowercase'  => esc_html__( 'Lowercase', 'litho-addons' ),
			'capitalize' => esc_html__( 'Capitalize', 'litho-addons' ),
		)
	);

	litho_before_inner_separator_end(
		'separator_end',
		''
	);
	litho_before_main_separator_end(
		'separator_main_end',
		''
	);
}
