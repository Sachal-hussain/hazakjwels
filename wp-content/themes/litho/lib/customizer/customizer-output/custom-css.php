<?php
/**
 * Generate css.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_enable_main_font = get_theme_mod( 'litho_enable_main_font', '1' );
$litho_enable_alt_font  = get_theme_mod( 'litho_enable_alt_font', '1' );
$litho_main_font        = get_theme_mod( 'litho_main_font', 'Roboto' ); // Roboto.
$litho_alt_font         = get_theme_mod( 'litho_alt_font', 'Poppins' ); // Poppins.
?>
<?php if ( $litho_enable_main_font && $litho_main_font ) : ?>
/* Body Font Family */
body, .main-font { font-family: <?php echo esc_attr( $litho_main_font ); ?>; }
<?php endif; ?>

<?php if ( $litho_enable_alt_font && $litho_alt_font ) : ?>
/* Alternate Font Family */
.alt-font, .sidebar .widget h2, .sidebar .widget.widget_search label, .editor-post-title__block .editor-post-title__input, .litho-button-wrapper .elementor-button, .elementor-widget-litho-button a.elementor-button, .btn, [type=submit], .wp-block-search .wp-block-search__button, input[type="submit"], .elementor-button-wrapper a.elementor-button, .elementor-widget-container .litho-top-cart-wrapper .buttons a, footer .elementor-widget-litho-simple-navigation .title, footer .elementor-widget-wp-widget-litho_recent_post_widget h5, .swiper-number-pagination, .woocommerce ul.shop-product-list li.product .button, .woocommerce ul.shop-product-list li.product .added_to_cart, .woocommerce div.product .product_title, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs .panel h2, .woocommerce-page .cart-collaterals .cart_totals h2, .woocommerce .related > h2, .woocommerce .up-sells > h2, .woocommerce .cross-sells > h2, .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta .woocommerce-review__author, .woocommerce table.shop_table th, .woocommerce-cart .cart-collaterals .cart_totals h2, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce form.checkout_coupon .button, .woocommerce form.login .lost_password a, .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-page h3, .woocommerce-checkout .woocommerce h3, .woocommerce-order-details .woocommerce-order-details__title, .woocommerce-account .woocommerce h2, .woocommerce-page legend, .woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before, .woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before, .woocommerce-Reviews .comment-reply-title { font-family: <?php echo esc_attr( $litho_alt_font ); ?>; }
<?php endif; ?>

<?php
/* Body Settings */
$litho_body_font_size           = get_theme_mod( 'litho_body_font_size', '' );
$litho_body_font_line_height    = get_theme_mod( 'litho_body_font_line_height', '' );
$litho_body_font_letter_spacing = get_theme_mod( 'litho_body_font_letter_spacing', '' );
$litho_body_background_color    = get_theme_mod( 'litho_body_background_color', '' );
$litho_body_text_color          = get_theme_mod( 'litho_body_text_color', '' );
?>

<?php if ( $litho_body_font_size ) : ?>
/* Body Font Size */
body { font-size: <?php echo esc_attr( $litho_body_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_body_font_line_height ) : ?>
/* Body Font Line Height */
body { line-height: <?php echo esc_attr( $litho_body_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_body_font_letter_spacing ) : ?>
/* Body Font Letter Spacing */
body { letter-spacing: <?php echo esc_attr( $litho_body_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_body_background_color ) : ?>
/* Body Background Color */
body { background-color: <?php echo esc_attr( $litho_body_background_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_body_text_color ) : ?>
/* Body Color */
body { color: <?php echo esc_attr( $litho_body_text_color ); ?>; }
<?php endif; ?>

<?php
/* Box Width */
$litho_enable_box_layout       = litho_option( 'litho_enable_box_layout', '0' );
$litho_enable_box_layout_width = get_theme_mod( 'litho_enable_box_layout_width', '' );
?>
<?php if ( 1 == $litho_enable_box_layout ) : ?>
	/* Box Width */
	<?php if ( ( $litho_enable_box_layout_width ) && $litho_enable_box_layout_width > 1170 ) : ?>
		@media ( min-width: <?php echo esc_attr( $litho_enable_box_layout_width ); ?>px ) { .box-layout { max-width: <?php echo esc_attr( $litho_enable_box_layout_width ); ?>px; width: <?php echo esc_attr( $litho_enable_box_layout_width ); ?>px; } }
	<?php endif; ?>
<?php endif; ?>

<?php
/* Scroll to Top Button */
$litho_scroll_to_top_icon_font_size         = get_theme_mod( 'litho_scroll_to_top_icon_font_size', '' );
$litho_scroll_to_top_icon_line_height       = get_theme_mod( 'litho_scroll_to_top_icon_line_height', '' );
$litho_scroll_to_top_icon_size              = get_theme_mod( 'litho_scroll_to_top_icon_size', '' );
$litho_scroll_to_top_background_color       = get_theme_mod( 'litho_scroll_to_top_background_color', '' );
$litho_scroll_to_top_background_hover_color = get_theme_mod( 'litho_scroll_to_top_background_hover_color', '' );
$litho_scroll_to_top_color                  = get_theme_mod( 'litho_scroll_to_top_color', '' );
$litho_scroll_to_top_hover_color            = get_theme_mod( 'litho_scroll_to_top_hover_color', '' );
?>
<?php if ( $litho_scroll_to_top_icon_font_size ) : ?>
/* Scroll TO Top Icon Font Size */
.scroll-top-arrow { font-size: <?php echo esc_attr( $litho_scroll_to_top_icon_font_size ); ?>; }
<?php endif; ?>
<?php if ( $litho_scroll_to_top_icon_line_height ) : ?>
/* Scroll TO Top Icon Line Height */
.scroll-top-arrow { line-height: <?php echo esc_attr( $litho_scroll_to_top_icon_line_height ); ?>; }
<?php endif; ?>
<?php if ( $litho_scroll_to_top_icon_size ) : ?>
/* Scroll TO Top Icon Height, Width */
.scroll-top-arrow { height: <?php echo esc_attr( $litho_scroll_to_top_icon_size ); ?>; width: <?php echo esc_attr( $litho_scroll_to_top_icon_size ); ?>; }
<?php endif; ?>
<?php if ( $litho_scroll_to_top_background_color ) : ?>
/* Scroll TO Top background color */
.scroll-top-arrow { background: <?php echo esc_attr( $litho_scroll_to_top_background_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_scroll_to_top_background_hover_color ) : ?>
/* Scroll TO Top background hover color */
.scroll-top-arrow:hover { background: <?php echo esc_attr( $litho_scroll_to_top_background_hover_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_scroll_to_top_color ) : ?>
/* Scroll TO Top Icon Font color */
.scroll-top-arrow { color: <?php echo esc_attr( $litho_scroll_to_top_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_scroll_to_top_hover_color ) : ?>
	/* Scroll TO Top Icon Font hover color */
	.scroll-top-arrow:hover, .scroll-top-arrow:focus:hover { color: <?php echo esc_attr( $litho_scroll_to_top_hover_color ); ?> }
<?php endif; ?>

<?php
/* Post layout 1 */
$litho_single_post_bg_pattern = litho_option( 'litho_single_post_bg_pattern', '' );
?>
<?php if ( $litho_single_post_bg_pattern ) : ?>
/* background pattern image */
.litho-main-layout-wrap.post-layout-style-1 .overlap-section { background-image: url(<?php echo esc_attr( $litho_single_post_bg_pattern ); ?>) }
<?php endif; ?>

<?php
/* Sticky Post */

/* Title Typography And Color */
$litho_title_font_size_sticky      = get_theme_mod( 'litho_title_font_size_sticky', '' );
$litho_title_line_height_sticky    = get_theme_mod( 'litho_title_line_height_sticky', '' );
$litho_title_letter_spacing_sticky = get_theme_mod( 'litho_title_letter_spacing_sticky', '' );
$litho_title_font_weight_sticky    = get_theme_mod( 'litho_title_font_weight_sticky', '' );
$litho_title_color_sticky          = get_theme_mod( 'litho_title_color_sticky', '' );
$litho_title_hover_color_sticky    = get_theme_mod( 'litho_title_hover_color_sticky', '' );
$litho_title_text_transform_sticky = get_theme_mod( 'litho_title_text_transform_sticky', '' );
/* Content Typography And Color */
$litho_content_font_size_sticky      = get_theme_mod( 'litho_content_font_size_sticky', '' );
$litho_content_line_height_sticky    = get_theme_mod( 'litho_content_line_height_sticky', '' );
$litho_content_letter_spacing_sticky = get_theme_mod( 'litho_content_letter_spacing_sticky', '' );
$litho_content_font_weight_sticky    = get_theme_mod( 'litho_content_font_weight_sticky', '' );
$litho_content_color_sticky          = get_theme_mod( 'litho_content_color_sticky', '' );
/* Post comment / like text */
$litho_show_like_text_sticky    = get_theme_mod( 'litho_show_like_text_sticky', 'inline-block' );
$litho_show_comment_text_sticky = get_theme_mod( 'litho_show_comment_text_sticky', 'inline-block' );
/* Post Meta And Button Colors */
$litho_box_bg_color_sticky            = get_theme_mod( 'litho_box_bg_color_sticky', '' );
$litho_post_meta_color_sticky         = get_theme_mod( 'litho_post_meta_color_sticky', '' );
$litho_post_meta_hover_color_sticky   = get_theme_mod( 'litho_post_meta_hover_color_sticky', '' );
$litho_post_meta_icon_color_sticky    = get_theme_mod( 'litho_post_meta_icon_color_sticky', '' );
$litho_button_color_sticky            = get_theme_mod( 'litho_button_color_sticky', '' );
$litho_button_hover_color_sticky      = get_theme_mod( 'litho_button_hover_color_sticky', '' );
$litho_button_text_color_sticky       = get_theme_mod( 'litho_button_text_color_sticky', '' );
$litho_button_hover_text_color_sticky = get_theme_mod( 'litho_button_hover_text_color_sticky', '' );
$litho_button_border_color_sticky     = get_theme_mod( 'litho_button_border_color_sticky', '' );
$litho_box_border_color_sticky        = get_theme_mod( 'litho_box_border_color_sticky', '' );
$litho_box_border_size_sticky         = get_theme_mod( 'litho_box_border_size_sticky', '' );
$litho_box_border_type_sticky         = get_theme_mod( 'litho_box_border_type_sticky', '' );
$litho_meta_border_color_sticky       = get_theme_mod( 'litho_meta_border_color_sticky', '' );
$litho_meta_text_transform_sticky     = get_theme_mod( 'litho_meta_text_transform_sticky', 'uppercase' );
?>
/* Title Typography And Color */
<?php if ( $litho_title_font_size_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-title { font-size : <?php echo esc_attr( $litho_title_font_size_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_title_line_height_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-title { line-height : <?php echo esc_attr( $litho_title_line_height_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_title_letter_spacing_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-title { letter-spacing : <?php echo esc_attr( $litho_title_letter_spacing_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_title_font_weight_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-title { font-weight : <?php echo esc_attr( $litho_title_font_weight_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_title_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-title { color : <?php echo esc_attr( $litho_title_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_title_hover_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-title:hover { color : <?php echo esc_attr( $litho_title_hover_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_title_text_transform_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-title { text-transform : <?php echo esc_attr( $litho_title_text_transform_sticky ); ?>; }
<?php endif; ?>

/* Content Typography And Color */
<?php if ( $litho_content_font_size_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-content { font-size : <?php echo esc_attr( $litho_content_font_size_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_content_line_height_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-content { line-height : <?php echo esc_attr( $litho_content_line_height_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_content_letter_spacing_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-content { letter-spacing : <?php echo esc_attr( $litho_content_letter_spacing_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_content_font_weight_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-content { font-weight : <?php echo esc_attr( $litho_content_font_weight_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_content_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .entry-content { color : <?php echo esc_attr( $litho_content_color_sticky ); ?>; }
<?php endif; ?>

/* Post Comment / Like Text */
<?php if ( $litho_show_like_text_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-meta-wrapper .blog-like span.posts-like { display : <?php echo esc_attr( $litho_show_like_text_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_show_comment_text_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-meta-wrapper .comment-link span.comment-text { display : <?php echo esc_attr( $litho_show_comment_text_sticky ); ?>; }
<?php endif; ?>

/* Post Meta And Button Colors */
<?php if ( $litho_box_bg_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .blog-post { background-color : <?php echo esc_attr( $litho_box_bg_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_post_meta_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-meta, .blog-standard.blog-post-sticky .post-meta a, .blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a { color : <?php echo esc_attr( $litho_post_meta_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_post_meta_hover_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-meta a:hover, a:focus, .blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a:hover, a:focus, .blog-standard.blog-post-sticky .blog-post .blog-category a:hover { color : <?php echo esc_attr( $litho_post_meta_hover_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .litho-button-wrapper .elementor-button, .blog-standard.blog-post-sticky .elementor-widget-litho-button a.elementor-button, .blog-standard.blog-post-sticky .btn { background-color : <?php echo esc_attr( $litho_button_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_hover_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .litho-button-wrapper .elementor-button:hover, .blog-standard.blog-post-sticky .elementor-widget-litho-button a.elementor-button:hover, .blog-standard.blog-post-sticky .btn:hover { background-color : <?php echo esc_attr( $litho_button_hover_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_text_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-details .btn { color : <?php echo esc_attr( $litho_button_text_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_hover_text_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-details .btn:hover { color : <?php echo esc_attr( $litho_button_hover_text_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_border_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-details .btn { border-color : <?php echo esc_attr( $litho_button_border_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_box_border_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .blog-post { border-color : <?php echo esc_attr( $litho_box_border_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_box_border_size_sticky ) : ?>
	.blog-standard.blog-post-sticky .blog-post { border-width : <?php echo esc_attr( $litho_box_border_size_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_box_border_type_sticky ) : ?>
	.blog-standard.blog-post-sticky .blog-post { border-style : <?php echo esc_attr( $litho_box_border_type_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_meta_border_color_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-meta-wrapper,.blog-standard.blog-post-sticky .post-meta-wrapper > span { border-color : <?php echo esc_attr( $litho_meta_border_color_sticky ); ?>; }
<?php endif; ?>
<?php if ( $litho_meta_text_transform_sticky ) : ?>
	.blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a, .blog-standard.blog-post-sticky .post-meta span, .blog-standard.blog-post-sticky .post-meta a { text-transform : <?php echo esc_attr( $litho_meta_text_transform_sticky ); ?>; }
<?php endif; ?>

<?php
/* Single Post Color Setting */
$litho_related_post_general_title_color       = get_theme_mod( 'litho_related_post_general_title_color', '' );
$litho_related_post_general_sub_title_color   = get_theme_mod( 'litho_related_post_general_sub_title_color', '' );
$litho_related_post_title_color               = get_theme_mod( 'litho_related_post_title_color', '' );
$litho_related_post_title_hover_color         = get_theme_mod( 'litho_related_post_title_hover_color', '' );
$litho_related_post_content_color             = get_theme_mod( 'litho_related_post_content_color', '' );
$litho_related_post_meta_color                = get_theme_mod( 'litho_related_post_meta_color', '' );
$litho_related_post_meta_hover_color          = get_theme_mod( 'litho_related_post_meta_hover_color', '' );
$litho_related_post_separator_color           = get_theme_mod( 'litho_related_post_separator_color', '' );
$litho_related_post_button_bg_color           = get_theme_mod( 'litho_related_post_button_bg_color', '' );
$litho_related_post_button_bg_hover_color     = get_theme_mod( 'litho_related_post_button_bg_hover_color', '' );
$litho_related_post_button_text_color         = get_theme_mod( 'litho_related_post_button_text_color', '' );
$litho_related_post_button_text_hover_color   = get_theme_mod( 'litho_related_post_button_text_hover_color', '' );
$litho_related_post_button_border_color       = get_theme_mod( 'litho_related_post_button_border_color', '' );
$litho_related_post_button_border_hover_color = get_theme_mod( 'litho_related_post_button_border_hover_color', '' );
$litho_post_title_color                       = get_theme_mod( 'litho_post_title_color', '' );
$litho_post_meta_color                        = get_theme_mod( 'litho_post_meta_color', '' );
$litho_post_meta_hover_color                  = get_theme_mod( 'litho_post_meta_hover_color', '' );
$litho_post_meta_icon_color                   = get_theme_mod( 'litho_post_meta_icon_color', '' );
$litho_post_tag_like_color                    = get_theme_mod( 'litho_post_tag_like_color', '' );
$litho_post_tag_like_hover_color              = get_theme_mod( 'litho_post_tag_like_hover_color', '' );
$litho_post_tag_like_bg_color                 = get_theme_mod( 'litho_post_tag_like_bg_color', '' );
$litho_post_navigation_color                  = get_theme_mod( 'litho_post_navigation_color', '' );
$litho_post_navigation_hover_color            = get_theme_mod( 'litho_post_navigation_hover_color', '' );
$litho_post_author_box_bg_color               = get_theme_mod( 'litho_post_author_box_bg_color', '' );
$litho_post_author_title_text_color           = get_theme_mod( 'litho_post_author_title_text_color', '' );
$litho_post_author_title_text_hover_color     = get_theme_mod( 'litho_post_author_title_text_hover_color', '' );
$litho_post_author_content_color              = get_theme_mod( 'litho_post_author_content_color', '' );
$litho_button_text_color_author_box           = get_theme_mod( 'litho_button_text_color_author_box', '' );
$litho_button_hover_text_color_author_box     = get_theme_mod( 'litho_button_hover_text_color_author_box', '' );
$litho_button_border_color_author_box         = get_theme_mod( 'litho_button_border_color_author_box', '' );
$litho_button_hover_border_color_author_box   = get_theme_mod( 'litho_button_hover_border_color_author_box', '' );
?>
<?php if ( $litho_related_post_general_title_color ) : ?>
	.litho-related-posts-wrap .related-post-general-title { color : <?php echo esc_attr( $litho_related_post_general_title_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_general_sub_title_color ) : ?>
	.litho-related-posts-wrap .related-post-general-subtitle { color : <?php echo esc_attr( $litho_related_post_general_sub_title_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_title_color ) : ?>
	.litho-related-posts-wrap .blog-clean.blog-grid .entry-title { color : <?php echo esc_attr( $litho_related_post_title_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_title_hover_color ) : ?>
	.litho-related-posts-wrap .blog-clean.blog-grid .entry-title:hover { color : <?php echo esc_attr( $litho_related_post_title_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_content_color ) : ?>
	.litho-related-posts-wrap .blog-clean.blog-grid .entry-content { color : <?php echo esc_attr( $litho_related_post_content_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_meta_color ) : ?>
	.litho-related-posts-wrap .blog-grid .post-date, .litho-related-posts-wrap .blog-grid .author-name, .litho-related-posts-wrap .blog-grid .author-name a, .litho-related-posts-wrap .blog-grid .blog-like, .litho-related-posts-wrap .blog-grid .comment-link { color : <?php echo esc_attr( $litho_related_post_meta_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_meta_hover_color ) : ?>
	.litho-related-posts-wrap .blog-grid .author-name a:hover, .litho-related-posts-wrap .blog-grid .blog-like:hover, .litho-related-posts-wrap .blog-grid .comment-link:hover { color : <?php echo esc_attr( $litho_related_post_meta_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_separator_color ) : ?>
	.litho-related-posts-wrap .horizontal-separator { background-color : <?php echo esc_attr( $litho_related_post_separator_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_button_bg_color ) : ?>
	.litho-related-posts-wrap .blog-grid .blog-post-button { background-color : <?php echo esc_attr( $litho_related_post_button_bg_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_button_bg_hover_color ) : ?>
	.litho-related-posts-wrap .blog-grid .blog-post-button:hover { background-color : <?php echo esc_attr( $litho_related_post_button_bg_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_button_text_color ) : ?>
	.litho-related-posts-wrap .blog-grid .blog-post-button { color : <?php echo esc_attr( $litho_related_post_button_text_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_button_text_hover_color ) : ?>
	.litho-related-posts-wrap .blog-grid .blog-post-button:hover { color : <?php echo esc_attr( $litho_related_post_button_text_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_button_border_color ) : ?>
	.litho-related-posts-wrap .blog-grid .blog-post-button { border-color : <?php echo esc_attr( $litho_related_post_button_border_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_post_button_border_hover_color ) : ?>
	.litho-related-posts-wrap .blog-grid .blog-post-button:hover { border-color : <?php echo esc_attr( $litho_related_post_button_border_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_title_color ) : ?>
	.litho-main-layout-wrap .litho-main-title, .single-post-main-section .single-post-title { color : <?php echo esc_attr( $litho_post_title_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_meta_color ) : ?>
	.single-post-main-section .litho-single-post-meta ul li,
	.single-post-main-section .litho-single-post-meta ul li a,
	.single-post-main-section .litho-single-post-meta ul li i,
	.single-post-main-section .litho-single-post-author,
	.single-post-main-section .litho-single-post-date,
	.single-post-main-section .litho-single-post-date .post-date,
	.single-post-main-section .litho-single-post-categories ul li a,
	.single-post-main-section .litho-single-post-categories .post-date,
	.single-post-main-section .litho-single-post-author a { color : <?php echo esc_attr( $litho_post_meta_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_meta_hover_color ) : ?>
	.single-post-main-section .litho-single-post-meta ul li a:hover, .single-post-main-section .litho-single-post-categories ul li a:hover, .single-post-main-section .litho-single-post-author a:hover { color : <?php echo esc_attr( $litho_post_meta_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_meta_icon_color ) : ?>
	.single-post-main-section .litho-single-post-meta ul li i { color : <?php echo esc_attr( $litho_post_meta_icon_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_tag_like_color ) : ?>
	.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a, .single-post .tag-like-social-wrapper .litho-blog-detail-like a i, .single-post .blog-details-social-sharing ul li a { color : <?php echo esc_attr( $litho_post_tag_like_color ); ?>; border-color : <?php echo esc_attr( $litho_post_tag_like_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_tag_like_hover_color ) : ?>
	.single-post .tag-like-social-wrapper .litho-blog-detail-like a:hover, .single-post .tag-like-social-wrapper .tagcloud a:hover, .single-post .tag-like-social-wrapper .litho-blog-detail-like a:hover i, .single-post .blog-details-social-sharing ul li a:hover{ color : <?php echo esc_attr( $litho_post_tag_like_hover_color ); ?>; border-color : <?php echo esc_attr( $litho_post_tag_like_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_tag_like_bg_color ) : ?>
	.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a { background-color : <?php echo esc_attr( $litho_post_tag_like_bg_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_post_navigation_color ) : ?>
	.single-post-navigation .blog-nav-link a, .single-post-navigation .blog-nav-link i { color : <?php echo esc_attr( $litho_post_navigation_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_post_navigation_hover_color ) : ?>
	.single-post-navigation .blog-nav-link:hover a, .single-post-navigation .blog-nav-link:hover i { color : <?php echo esc_attr( $litho_post_navigation_hover_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_post_author_box_bg_color ) : ?>
	.litho-author-box-wrap .litho-author-box { background-color : <?php echo esc_attr( $litho_post_author_box_bg_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_post_author_title_text_color ) : ?>
	.litho-author-box-wrap .litho-author-box .avtar-image-meta .author-title { color : <?php echo esc_attr( $litho_post_author_title_text_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_post_author_title_text_hover_color ) : ?>
	.litho-author-box-wrap .litho-author-box .avtar-image-meta .author-title:hover { color : <?php echo esc_attr( $litho_post_author_title_text_hover_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_post_author_content_color ) : ?>
	.litho-author-box-wrap .litho-author-box .author-content-meta p { color : <?php echo esc_attr( $litho_post_author_content_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_text_color_author_box ) : ?>
	.litho-author-box-wrap .litho-author-box .author-content-meta .btn { color : <?php echo esc_attr( $litho_button_text_color_author_box ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_hover_text_color_author_box ) : ?>
	.litho-author-box-wrap .litho-author-box .author-content-meta .btn:hover { color : <?php echo esc_attr( $litho_button_hover_text_color_author_box ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_border_color_author_box ) : ?>
	.litho-author-box-wrap .litho-author-box .author-content-meta .btn { border-color : <?php echo esc_attr( $litho_button_border_color_author_box ); ?>; }
<?php endif; ?>
<?php if ( $litho_button_hover_border_color_author_box ) : ?>
	.litho-author-box-wrap .litho-author-box .author-content-meta .btn:hover { border-color : <?php echo esc_attr( $litho_button_hover_border_color_author_box ); ?>; }
<?php endif; ?>

<?php
/* Portfolio Single Color Setting */
$litho_single_portfolio_meta_title_color             = get_theme_mod( 'litho_single_portfolio_meta_title_color', '' );
$litho_single_portfolio_meta_color                   = get_theme_mod( 'litho_single_portfolio_meta_color', '' );
$litho_single_portfolio_meta_hover_color             = get_theme_mod( 'litho_single_portfolio_meta_hover_color', '' );
$litho_single_portfolio_share_heading_font_size      = get_theme_mod( 'litho_single_portfolio_share_heading_font_size', '' );
$litho_single_portfolio_share_heading_line_height    = get_theme_mod( 'litho_single_portfolio_share_heading_line_height', '' );
$litho_single_portfolio_share_heading_letter_spacing = get_theme_mod( 'litho_single_portfolio_share_heading_letter_spacing', '' );
$litho_single_portfolio_share_heading_font_weight    = get_theme_mod( 'litho_single_portfolio_share_heading_font_weight', '' );
$litho_single_portfolio_share_heading_text_transform = get_theme_mod( 'litho_single_portfolio_share_heading_text_transform', '' );
$litho_single_portfolio_share_heading_text_color     = get_theme_mod( 'litho_single_portfolio_share_heading_text_color', '' );
$litho_single_portfolio_share_icon_color             = get_theme_mod( 'litho_single_portfolio_share_icon_color', '' );
$litho_related_single_portfolio_box_bg_color         = get_theme_mod( 'litho_related_single_portfolio_box_bg_color', '' );
$litho_related_single_portfolio_title_text_color     = get_theme_mod( 'litho_related_single_portfolio_title_text_color', '' );
$litho_related_single_portfolio_content_color        = get_theme_mod( 'litho_related_single_portfolio_content_color', '' );
$litho_related_single_portfolio_subtitle_transform   = litho_option( 'litho_related_single_portfolio_subtitle_text_transform', 'capitalize' );
$litho_related_single_portfolio_bg_color             = get_theme_mod( 'litho_related_single_portfolio_bg_color', '' );
$litho_related_single_portfolio_title_color          = get_theme_mod( 'litho_related_single_portfolio_title_color', '' );
$litho_related_single_portfolio_subtitle_color       = get_theme_mod( 'litho_related_single_portfolio_subtitle_color', '' );
$litho_navigation_single_portfolio_bg_color          = get_theme_mod( 'litho_navigation_single_portfolio_bg_color', '' );
$litho_navigation_single_portfolio_text_color        = get_theme_mod( 'litho_navigation_single_portfolio_text_color', '' );
$litho_navigation_single_portfolio_link_color        = get_theme_mod( 'litho_navigation_single_portfolio_link_color', '' );
$litho_navigation_single_portfolio_link_hover_color  = get_theme_mod( 'litho_navigation_single_portfolio_link_hover_color', '' );
?>
<?php if ( $litho_single_portfolio_meta_title_color ) : ?>
	.single-portfolio .porfolio-categories-lists .posted_in { color : <?php echo esc_attr( $litho_single_portfolio_meta_title_color ); ?> }
<?php endif; ?>

<?php if ( $litho_single_portfolio_meta_color ) : ?>
	.single-portfolio .porfolio-categories-lists .posted_in a, .single-portfolio .porfolio-categories-lists .tagcloud a { color : <?php echo esc_attr( $litho_single_portfolio_meta_color ); ?>; border-color : <?php echo esc_attr( $litho_single_portfolio_meta_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_meta_hover_color ) : ?>
	.single-portfolio .porfolio-categories-lists .posted_in a:hover, .single-portfolio .porfolio-categories-lists .tagcloud a:hover { color : <?php echo esc_attr( $litho_single_portfolio_meta_hover_color ); ?>; border-color : <?php echo esc_attr( $litho_single_portfolio_meta_hover_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_share_heading_font_size ) : ?>
	.single-portfolio .share-heading { font-size : <?php echo esc_attr( $litho_single_portfolio_share_heading_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_share_heading_line_height ) : ?>
	.single-portfolio .share-heading { line-height : <?php echo esc_attr( $litho_single_portfolio_share_heading_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_share_heading_letter_spacing ) : ?>
	.single-portfolio .share-heading { letter-spacing : <?php echo esc_attr( $litho_single_portfolio_share_heading_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_share_heading_font_weight ) : ?>
	.single-portfolio .share-heading { font-weight : <?php echo esc_attr( $litho_single_portfolio_share_heading_font_weight ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_share_heading_text_transform ) : ?>
	.single-portfolio .share-heading { text-transform : <?php echo esc_attr( $litho_single_portfolio_share_heading_text_transform ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_share_heading_text_color ) : ?>
	.single-portfolio .share-heading { color : <?php echo esc_attr( $litho_single_portfolio_share_heading_text_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_single_portfolio_share_icon_color ) : ?>
	.single-portfolio .blog-details-social-sharing ul li a { color : <?php echo esc_attr( $litho_single_portfolio_share_icon_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_related_single_portfolio_box_bg_color ) : ?>
	.litho-main-content-wrap .litho-related-portfolio-wrap { background-color : <?php echo esc_attr( $litho_related_single_portfolio_box_bg_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_related_single_portfolio_title_text_color ) : ?>
	.litho-related-portfolio-wrap .related-portfolio-general-title { color : <?php echo esc_attr( $litho_related_single_portfolio_title_text_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_related_single_portfolio_content_color ) : ?>
	.litho-related-portfolio-wrap .related-portfolio-general-subtitle { color : <?php echo esc_attr( $litho_related_single_portfolio_content_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_related_single_portfolio_subtitle_transform ) : ?>
	.litho-related-portfolio-wrap .related-portfolio-general-subtitle { text-transform : <?php echo esc_attr( $litho_related_single_portfolio_subtitle_transform ); ?>; }
<?php endif; ?>
<?php if ( $litho_related_single_portfolio_bg_color ) : ?>
	.litho-related-portfolio-wrap .portfolio-classic .portfolio-item .portfolio-caption { background-color : <?php echo esc_attr( $litho_related_single_portfolio_bg_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_related_single_portfolio_title_color ) : ?>
	.litho-related-portfolio-wrap .blog-grid .portfolio-item .title a { color : <?php echo esc_attr( $litho_related_single_portfolio_title_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_related_single_portfolio_subtitle_color ) : ?>
	.litho-related-portfolio-wrap .portfolio-classic .portfolio-item .portfolio-caption .subtitle { color : <?php echo esc_attr( $litho_related_single_portfolio_subtitle_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_navigation_single_portfolio_bg_color ) : ?>
	.portfolio-navigation-wrapper .fancy-box-item { background-color : <?php echo esc_attr( $litho_navigation_single_portfolio_bg_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_navigation_single_portfolio_text_color ) : ?>
	.portfolio-navigation-wrapper .fancy-box-item .title { color : <?php echo esc_attr( $litho_navigation_single_portfolio_text_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_navigation_single_portfolio_link_color ) : ?>
	.portfolio-navigation-wrapper .fancy-box-item .next-previous-navigation .prev-link-text, .portfolio-navigation-wrapper .fancy-box-item .next-previous-navigation .next-link-text, .portfolio-navigation-wrapper .fancy-box-item .next-previous-navigation i { color : <?php echo esc_attr( $litho_navigation_single_portfolio_link_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_navigation_single_portfolio_link_hover_color ) : ?>
	.portfolio-navigation-wrapper .fancy-box-item:hover .next-previous-navigation i, .portfolio-navigation-wrapper .fancy-box-item:hover .prev-link-text, .portfolio-navigation-wrapper .fancy-box-item:hover .next-previous-navigation .next-link-text { color : <?php echo esc_attr( $litho_navigation_single_portfolio_link_hover_color ); ?>; }
<?php endif; ?>

<?php
/* if WooCommerce plugin is activated */
if ( is_woocommerce_activated() ) {

	/* Single Product Sale */
	$litho_single_product_sale_font_size     = get_theme_mod( 'litho_single_product_sale_font_size', '' );
	$litho_single_product_sale_line_height   = get_theme_mod( 'litho_single_product_sale_line_height', '' );
	$litho_single_product_sale_font_weight   = get_theme_mod( 'litho_single_product_sale_font_weight', '' );
	$litho_single_product_sale_color         = get_theme_mod( 'litho_single_product_sale_color', '' );
	$litho_single_product_sale_bg_color      = get_theme_mod( 'litho_single_product_sale_bg_color', '' );
	$litho_single_product_sale_enable_border = get_theme_mod( 'litho_single_product_sale_enable_border', '1' );
	$litho_single_product_sale_border_size   = get_theme_mod( 'litho_single_product_sale_border_size', '' );
	$litho_single_product_sale_border_type   = get_theme_mod( 'litho_single_product_sale_border_type', '' );
	$litho_single_product_sale_border_color  = get_theme_mod( 'litho_single_product_sale_border_color', '' );
	?>

	<?php if ( $litho_single_product_sale_font_size ) : ?>
	/* Product Sale Font Size */
	.single-product .product > .onsale { font-size: <?php echo esc_attr( $litho_single_product_sale_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_sale_line_height ) : ?>
	/* Product Sale Line Height */
	.single-product .product > .onsale { line-height: <?php echo esc_attr( $litho_single_product_sale_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_sale_font_weight ) : ?>
	/* Product Sale Font Weight */
	.single-product .product > .onsale { font-weight: <?php echo esc_attr( $litho_single_product_sale_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_sale_color ) : ?>
	/* Product Sale Color */
	.single-product .product > .onsale { color: <?php echo esc_attr( $litho_single_product_sale_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_sale_bg_color ) : ?>
	/* Product Sale Background Color */
	.single-product .product > .onsale { background-color: <?php echo esc_attr( $litho_single_product_sale_bg_color ); ?> }
	<?php endif; ?>

	<?php if ( '1' != $litho_single_product_sale_enable_border ) : ?>
	/* Product Sale Border None */
	.single-product .product > .onsale { border: none }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_sale_enable_border && $litho_single_product_sale_border_size ) : ?>
	/* Product Sale Border Size */
	.single-product .product > .onsale { border-width: <?php echo esc_attr( $litho_single_product_sale_border_size ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_sale_enable_border && $litho_single_product_sale_border_type ) : ?>
	/* Product Sale Border Style */
	.single-product .product > .onsale { border-style: <?php echo esc_attr( $litho_single_product_sale_border_type ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_sale_enable_border && $litho_single_product_sale_border_color ) : ?>
	/* Product Sale Border Color */
	.single-product .product > .onsale { border-color: <?php echo esc_attr( $litho_single_product_sale_border_color ); ?> }
	<?php endif; ?>
	<?php

	/* Single Product Title */
	$litho_single_product_page_title_font_size      = get_theme_mod( 'litho_single_product_page_title_font_size', '' );
	$litho_single_product_page_title_line_height    = get_theme_mod( 'litho_single_product_page_title_line_height', '' );
	$litho_single_product_page_title_letter_spacing = get_theme_mod( 'litho_single_product_page_title_letter_spacing', '' );
	$litho_single_product_page_title_font_weight    = get_theme_mod( 'litho_single_product_page_title_font_weight', '' );
	$litho_single_product_page_title_font_italic    = get_theme_mod( 'litho_single_product_page_title_font_italic', '0' );
	$litho_single_product_page_title_font_underline = get_theme_mod( 'litho_single_product_page_title_font_underline', '0' );
	$litho_single_product_page_title_color          = get_theme_mod( 'litho_single_product_page_title_color', '' );
	?>
	<?php if ( $litho_single_product_page_title_font_size ) : ?>
	/* Product Title Font Size */
	.single-product .product .summary .product_title { font-size: <?php echo esc_attr( $litho_single_product_page_title_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_title_line_height ) : ?>
	/* Product Title Line Height */
	.single-product .product .summary .product_title { line-height: <?php echo esc_attr( $litho_single_product_page_title_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_title_letter_spacing ) : ?>
	/* Product Title Letter Spacing */
	.single-product .product .summary .product_title { letter-spacing: <?php echo esc_attr( $litho_single_product_page_title_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_title_font_weight ) : ?>
	/* Product Title Font Weight */
	.single-product .product .summary .product_title { font-weight: <?php echo esc_attr( $litho_single_product_page_title_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_page_title_font_italic ) : ?>
	/* Product Title Font Italic */
	.single-product .product .summary .product_title { font-style: italic }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_page_title_font_underline ) : ?>
	/* Product Title Font Underline */
	.single-product .product .summary .product_title { text-decoration: underline }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_title_color ) : ?>
	/* Product Title Color */
	.single-product .product .summary .product_title { color: <?php echo esc_attr( $litho_single_product_page_title_color ); ?> }
	<?php endif; ?>

	<?php
	/* Single Product Rating Star Color */
	$litho_single_product_rating_star_color = get_theme_mod( 'litho_single_product_rating_star_color', '' );
	?>
	<?php if ( $litho_single_product_rating_star_color ) : ?>
	/* Product Rating Star Color */
	.single-product .product .summary .star-rating span { color: <?php echo esc_attr( $litho_single_product_rating_star_color ); ?> }
	<?php endif; ?>
	<?php
	/* Single Product Price */
	$litho_single_product_price_font_size     = get_theme_mod( 'litho_single_product_price_font_size', '' );
	$litho_single_product_price_line_height   = get_theme_mod( 'litho_single_product_price_line_height', '' );
	$litho_single_product_price_font_weight   = get_theme_mod( 'litho_single_product_price_font_weight', '' );
	$litho_single_product_price_color         = get_theme_mod( 'litho_single_product_price_color', '' );
	$litho_single_product_regular_price_color = get_theme_mod( 'litho_single_product_regular_price_color', '' );
	?>
	<?php if ( $litho_single_product_price_font_size ) : ?>
	/* Product Price Font Size */
	.single-product .product .summary .price, .single-product .product .summary .price ins { font-size: <?php echo esc_attr( $litho_single_product_price_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_price_line_height ) : ?>
	/* Product Price Line Height */
	.single-product .product .summary .price, .single-product .product .summary .price ins { line-height: <?php echo esc_attr( $litho_single_product_price_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_price_font_weight ) : ?>
	/* Product Price Font Weight */
	.single-product .product .summary .price, .single-product .product .summary .price ins { font-weight: <?php echo esc_attr( $litho_single_product_price_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_price_color ) : ?>
	/* Product Price Color */
	.single-product .product .summary .price, .single-product .product .summary .price ins { color: <?php echo esc_attr( $litho_single_product_price_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_regular_price_color ) : ?>
	/* Product Regular Price Color */
	.single-product .product .summary .price del { color: <?php echo esc_attr( $litho_single_product_regular_price_color ); ?> }
	<?php endif; ?>
	<?php
	/* Single Product Short Description */
	$litho_single_product_short_description_font_size      = get_theme_mod( 'litho_single_product_short_description_font_size', '' );
	$litho_single_product_short_description_line_height    = get_theme_mod( 'litho_single_product_short_description_line_height', '' );
	$litho_single_product_short_description_letter_spacing = get_theme_mod( 'litho_single_product_short_description_letter_spacing', '' );
	$litho_single_product_short_description_font_weight    = get_theme_mod( 'litho_single_product_short_description_font_weight', '' );
	$litho_single_product_short_description_color          = get_theme_mod( 'litho_single_product_short_description_color', '' );
	?>
	<?php if ( $litho_single_product_short_description_font_size ) : ?>
	/* Product Short Description Font Size */
	.single-product .product .summary .woocommerce-product-details__short-description { font-size: <?php echo esc_attr( $litho_single_product_short_description_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_short_description_line_height ) : ?>
	/* Product Short Description Line Height */
	.single-product .product .summary .woocommerce-product-details__short-description { line-height: <?php echo esc_attr( $litho_single_product_short_description_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_short_description_letter_spacing ) : ?>
	/* Product Short Description Letter Spacing */
	.single-product .product .summary .woocommerce-product-details__short-description { letter-spacing: <?php echo esc_attr( $litho_single_product_short_description_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_short_description_font_weight ) : ?>
	/* Product Short Description Font Weight */
	.single-product .product .summary .woocommerce-product-details__short-description { font-weight: <?php echo esc_attr( $litho_single_product_short_description_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_short_description_color ) : ?>
	/* Product Short Description Color */
	.single-product .product .summary .woocommerce-product-details__short-description { color: <?php echo esc_attr( $litho_single_product_short_description_color ); ?> }
	<?php endif; ?>
	<?php
	/* Single Product Stock */
	$litho_single_product_stock_font_size           = get_theme_mod( 'litho_single_product_stock_font_size', '' );
	$litho_single_product_stock_line_height         = get_theme_mod( 'litho_single_product_stock_line_height', '' );
	$litho_single_product_stock_font_weight         = get_theme_mod( 'litho_single_product_stock_font_weight', '' );
	$litho_single_product_stock_letter_spacing      = get_theme_mod( 'litho_single_product_stock_letter_spacing', '' );
	$litho_single_product_stock_color               = get_theme_mod( 'litho_single_product_stock_color', '' );
	$litho_single_product_out_of_stock_color        = get_theme_mod( 'litho_single_product_out_of_stock_color', '' );
	$litho_single_product_stock_bg_color            = get_theme_mod( 'litho_single_product_stock_bg_color', '' );
	$litho_single_product_stock_enable_border       = get_theme_mod( 'litho_single_product_stock_enable_border', '1' );
	$litho_single_product_stock_border_size         = get_theme_mod( 'litho_single_product_stock_border_size', '' );
	$litho_single_product_stock_border_type         = get_theme_mod( 'litho_single_product_stock_border_type', '' );
	$litho_single_product_stock_border_color        = get_theme_mod( 'litho_single_product_stock_border_color', '' );
	$litho_single_product_out_of_stock_border_color = get_theme_mod( 'litho_single_product_out_of_stock_border_color', '' );
	?>
	<?php if ( $litho_single_product_stock_font_size ) : ?>
	/* Product Stock Font Size */
	.single-product .product .summary .stock { font-size: <?php echo esc_attr( $litho_single_product_stock_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_stock_line_height ) : ?>
	/* Product Stock Line Height */
	.single-product .product .summary .stock { line-height: <?php echo esc_attr( $litho_single_product_stock_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_stock_font_weight ) : ?>
	/* Product Stock Font Weight */
	.single-product .product .summary .stock { font-weight: <?php echo esc_attr( $litho_single_product_stock_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_stock_letter_spacing ) : ?>
	/* Product Stock Letter Spacing */
	.single-product .product .summary .stock { letter-spacing: <?php echo esc_attr( $litho_single_product_stock_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_stock_color ) : ?>
	/* Product Stock Color */
	.single-product .product .summary .stock.in-stock { color: <?php echo esc_attr( $litho_single_product_stock_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_out_of_stock_color ) : ?>
	/* Product Out Of Stock Color */
	.single-product .product .summary .stock.out-of-stock { color: <?php echo esc_attr( $litho_single_product_out_of_stock_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_stock_bg_color ) : ?>
	/* Product Stock Background Color */
	.single-product .product .summary p.stock { background-color: <?php echo esc_attr( $litho_single_product_stock_bg_color ); ?> }
	<?php endif; ?>

	<?php if ( '1' != $litho_single_product_stock_enable_border ) : ?>
	/* Product Stock Border None */
	.single-product .product .summary .stock { border: none }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_stock_enable_border && $litho_single_product_stock_border_size ) : ?>
	/* Product Stock Border Size */
	.single-product .product .summary .stock { border-width: <?php echo esc_attr( $litho_single_product_stock_border_size ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_stock_enable_border && $litho_single_product_stock_border_type ) : ?>
	/* Product Stock Border Style */
	.single-product .product .summary .stock { border-style: <?php echo esc_attr( $litho_single_product_stock_border_type ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_stock_enable_border && $litho_single_product_stock_border_color ) : ?>
	/* Product Stock Border Color */
	.single-product .product .summary .stock.in-stock { border-color: <?php echo esc_attr( $litho_single_product_stock_border_color ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_stock_enable_border && $litho_single_product_out_of_stock_border_color ) : ?>
	/* Product Out Of Stock Border Color */
	.single-product .product .summary .stock.out-of-stock { border-color: <?php echo esc_attr( $litho_single_product_out_of_stock_border_color ); ?> }
	<?php endif; ?>
	<?php
	/* Single Product Button */
	$litho_single_product_button_color          = get_theme_mod( 'litho_single_product_button_color', '' );
	$litho_single_product_button_bg_color       = get_theme_mod( 'litho_single_product_button_bg_color', '' );
	$litho_single_product_button_border_color   = get_theme_mod( 'litho_single_product_button_border_color', '' );
	$litho_single_product_button_hover_color    = get_theme_mod( 'litho_single_product_button_hover_color', '' );
	$litho_single_product_button_hover_bg_color = get_theme_mod( 'litho_single_product_button_hover_bg_color', '' );
	?>
	<?php if ( $litho_single_product_button_color ) : ?>
	/* Product Button Color */
	.single-product .product .summary .button { color: <?php echo esc_attr( $litho_single_product_button_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_button_bg_color ) : ?>
	/* Product Button Background Color */
	.single-product .product .summary .button { background-color: <?php echo esc_attr( $litho_single_product_button_bg_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_button_border_color ) : ?>
	/* Product Button Border Color */
	.single-product .product .summary .button { border-color: <?php echo esc_attr( $litho_single_product_button_border_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_button_hover_color ) : ?>
	/* Product Button Hover Color */
	.single-product .product .summary .button:hover { color: <?php echo esc_attr( $litho_single_product_button_hover_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_button_hover_bg_color ) : ?>
	/* Product Button Hover Background Color */
	.single-product .product .summary .button:hover { background-color: <?php echo esc_attr( $litho_single_product_button_hover_bg_color ); ?> }
	<?php endif; ?>

	<?php
	/* Single Product Meta */
	$litho_single_product_page_meta_font_size         = get_theme_mod( 'litho_single_product_page_meta_font_size', '' );
	$litho_single_product_page_meta_line_height       = get_theme_mod( 'litho_single_product_page_meta_line_height', '' );
	$litho_single_product_page_meta_letter_spacing    = get_theme_mod( 'litho_single_product_page_meta_letter_spacing', '' );
	$litho_single_product_page_meta_font_weight       = get_theme_mod( 'litho_single_product_page_meta_font_weight', '' );
	$litho_single_product_page_meta_color             = get_theme_mod( 'litho_single_product_page_meta_color', '' );
	$litho_single_product_page_meta_link_hover_color  = get_theme_mod( 'litho_single_product_page_meta_link_hover_color', '' );
	$litho_single_product_page_meta_heading_color     = get_theme_mod( 'litho_single_product_page_meta_heading_color', '' );
	$litho_single_product_page_meta_social_icon_color = get_theme_mod( 'litho_single_product_page_meta_social_icon_color', '' );
	?>
	<?php if ( $litho_single_product_page_meta_font_size ) : ?>
	/* Product Meta Font Size */
	.single-product .product .summary .product_meta .sku_wrapper, .single-product .product .summary .product_meta .posted_in, .single-product .product .summary .product_meta .tagged_as, .single-product .product .summary .product_meta .social-icons-wrapper { font-size: <?php echo esc_attr( $litho_single_product_page_meta_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_meta_line_height ) : ?>
	/* Product Meta Line Height */
	.single-product .product .summary .product_meta .sku_wrapper, .single-product .product .summary .product_meta .posted_in, .single-product .product .summary .product_meta .tagged_as, .single-product .product .summary .product_meta .social-icons-wrapper { line-height: <?php echo esc_attr( $litho_single_product_page_meta_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_meta_letter_spacing ) : ?>
	/* Product Meta Letter Spacing */
	.single-product .product .summary .product_meta .sku_wrapper, .single-product .product .summary .product_meta .posted_in, .single-product .product .summary .product_meta .tagged_as, .single-product .product .summary .product_meta .social-icons-wrapper { letter-spacing: <?php echo esc_attr( $litho_single_product_page_meta_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_meta_font_weight ) : ?>
	/* Product Meta Font Weight */
	.single-product .product .summary .product_meta .sku_wrapper, .single-product .product .summary .product_meta .posted_in, .single-product .product .summary .product_meta .tagged_as, .single-product .product .summary .product_meta .social-icons-wrapper { font-weight: <?php echo esc_attr( $litho_single_product_page_meta_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_meta_social_icon_color ) : ?>
	/* Product Meta Social Icon Color */
	.single-product .product_meta .social-icons-wrapper .default-icon li a { color: <?php echo esc_attr( $litho_single_product_page_meta_social_icon_color ); ?> }
	<?php endif; ?>
	/* Product Meta Heading Color */
	<?php if ( $litho_single_product_page_meta_heading_color ) : ?>
	.single-product .product .summary .product_meta .sku_wrapper, .single-product .product .summary .product_meta .posted_in, .single-product .product .summary .product_meta .tagged_as, .single-product .product .summary .product_meta .social-icons-wrapper { color: <?php echo esc_attr( $litho_single_product_page_meta_heading_color ); ?> }
	<?php endif; ?>
	<?php if ( $litho_single_product_page_meta_color ) : ?>
	/* Product Meta Color */
	.single-product .product .summary .product_meta .sku_wrapper .sku, .single-product .product .summary .product_meta .posted_in a, .single-product .product .summary .product_meta .tagged_as a, .woocommerce div.product form.cart .variations label, .woocommerce div.product form.cart .reset_variations { color: <?php echo esc_attr( $litho_single_product_page_meta_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_meta_link_hover_color ) : ?>
	/* Product Meta Link Hover Color */
	.single-product .product .summary .product_meta a:hover { color: <?php echo esc_attr( $litho_single_product_page_meta_link_hover_color ); ?> }
	<?php endif; ?>
	<?php
	/* Single Product Tab */
	$litho_single_product_page_tab_font_size      = get_theme_mod( 'litho_single_product_page_tab_text_font_size', '' );
	$litho_single_product_page_tab_line_height    = get_theme_mod( 'litho_single_product_page_tab_line_height', '' );
	$litho_single_product_page_tab_letter_spacing = get_theme_mod( 'litho_single_product_page_tab_letter_spacing', '' );
	$litho_single_product_page_tab_font_weight    = get_theme_mod( 'litho_single_product_page_tab_font_weight', '' );
	$litho_single_product_page_tab_color          = get_theme_mod( 'litho_single_product_page_tab_color', '' );
	$litho_single_product_page_tab_active_color   = get_theme_mod( 'litho_single_product_page_tab_active_color', '' );
	?>
	<?php if ( $litho_single_product_page_tab_font_size ) : ?>
	/* Product Tab Font Size */
	.woocommerce.single-product .product .woocommerce-tabs ul.tabs li a { font-size: <?php echo esc_attr( $litho_single_product_page_tab_font_size ); ?>; }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_tab_line_height ) : ?>
	/* Product Tab Line Height */
	.woocommerce.single-product .product .woocommerce-tabs ul.tabs li a { line-height: <?php echo esc_attr( $litho_single_product_page_tab_line_height ); ?>; }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_tab_letter_spacing ) : ?>
	/* Product Tab Letter Spacing */
	.woocommerce.single-product .product .woocommerce-tabs ul.tabs li a { letter-spacing: <?php echo esc_attr( $litho_single_product_page_tab_letter_spacing ); ?>; }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_tab_font_weight ) : ?>
	/* Product Tab Font Weight */
	.woocommerce.single-product .product .woocommerce-tabs ul.tabs li a { font-weight: <?php echo esc_attr( $litho_single_product_page_tab_font_weight ); ?>; }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_tab_color ) : ?>
	/* Product Tab Color */
	.woocommerce.single-product .product .woocommerce-tabs ul.tabs li a { color: <?php echo esc_attr( $litho_single_product_page_tab_color ); ?>; }
	<?php endif; ?>

	<?php if ( $litho_single_product_page_tab_active_color ) : ?>
	/* Product Active Tab Color */
	.woocommerce.single-product .product .woocommerce-tabs ul.tabs li.active a { color: <?php echo esc_attr( $litho_single_product_page_tab_active_color ); ?>; }
	.woocommerce.single-product .product .woocommerce-tabs ul.tabs li.active a{ border-bottom-color: <?php echo esc_attr( $litho_single_product_page_tab_active_color ); ?>; }
	<?php endif; ?>
	<?php
	/* Related Product Heading */
	$litho_single_product_related_product_heading_font_size      = get_theme_mod( 'litho_single_product_related_product_heading_font_size', '' );
	$litho_single_product_related_product_heading_line_height    = get_theme_mod( 'litho_single_product_related_product_heading_line_height', '' );
	$litho_single_product_related_product_heading_letter_spacing = get_theme_mod( 'litho_single_product_related_product_heading_letter_spacing', '' );
	$litho_single_product_related_product_heading_font_weight    = get_theme_mod( 'litho_single_product_related_product_heading_font_weight', '' );
	$litho_single_product_related_product_heading_font_italic    = get_theme_mod( 'litho_single_product_related_product_heading_font_italic', '0' );
	$litho_single_product_related_product_heading_font_underline = get_theme_mod( 'litho_single_product_related_product_heading_font_underline', '0' );
	$litho_single_product_related_product_heading_color          = get_theme_mod( 'litho_single_product_related_product_heading_color', '' );
	?>
	<?php if ( $litho_single_product_related_product_heading_font_size ) : ?>
	/* Related Product Heading Font Size */
	.woocommerce.single-product .related > h2 { font-size: <?php echo esc_attr( $litho_single_product_related_product_heading_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_related_product_heading_line_height ) : ?>
	/* Related Product Heading Line Height */
	.woocommerce.single-product .related > h2 { line-height: <?php echo esc_attr( $litho_single_product_related_product_heading_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_related_product_heading_letter_spacing ) : ?>
	/* Related Product Heading Letter Spacing */
	.woocommerce.single-product .related > h2 { letter-spacing: <?php echo esc_attr( $litho_single_product_related_product_heading_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_related_product_heading_font_weight ) : ?>
	/* Related Product Heading Font Weight */
	.woocommerce.single-product .related > h2 { font-weight: <?php echo esc_attr( $litho_single_product_related_product_heading_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_related_product_heading_font_italic ) : ?>
	/* Related Product Heading Font Italic */
	.woocommerce.single-product .related > h2 { font-style: italic }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_related_product_heading_font_underline ) : ?>
	/* Related Product Heading Font Underline */
	.woocommerce.single-product .related > h2 { text-decoration: underline }
	<?php endif; ?>

	<?php if ( $litho_single_product_related_product_heading_color ) : ?>
	/* Related Product Heading Color */
	.woocommerce.single-product .related > h2 { color: <?php echo esc_attr( $litho_single_product_related_product_heading_color ); ?> }
	<?php endif; ?>
	<?php
	/* Up Sells Product Heading */
	$litho_single_product_up_sells_product_heading_font_size      = get_theme_mod( 'litho_single_product_up_sells_product_heading_font_size', '' );
	$litho_single_product_up_sells_product_heading_line_height    = get_theme_mod( 'litho_single_product_up_sells_product_heading_line_height', '' );
	$litho_single_product_up_sells_product_heading_letter_spacing = get_theme_mod( 'litho_single_product_up_sells_product_heading_letter_spacing', '' );
	$litho_single_product_up_sells_product_heading_font_weight    = get_theme_mod( 'litho_single_product_up_sells_product_heading_font_weight', '' );
	$litho_single_product_up_sells_product_heading_font_italic    = get_theme_mod( 'litho_single_product_up_sells_product_heading_font_italic', '0' );
	$litho_single_product_up_sells_product_heading_font_underline = get_theme_mod( 'litho_single_product_up_sells_product_heading_font_underline', '0' );
	$litho_single_product_up_sells_product_heading_color          = get_theme_mod( 'litho_single_product_up_sells_product_heading_color', '' );
	?>
	<?php if ( $litho_single_product_up_sells_product_heading_font_size ) : ?>
	/* Up Sells Product Heading Font Size */
	.woocommerce.single-product .up-sells > h2 { font-size: <?php echo esc_attr( $litho_single_product_up_sells_product_heading_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_up_sells_product_heading_line_height ) : ?>
	/* Up Sells Product Heading Line Height */
	.woocommerce.single-product .up-sells > h2 { line-height: <?php echo esc_attr( $litho_single_product_up_sells_product_heading_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_up_sells_product_heading_letter_spacing ) : ?>
	/* Up Sells Product Heading Letter Spacing */
	.woocommerce.single-product .up-sells > h2 { letter-spacing: <?php echo esc_attr( $litho_single_product_up_sells_product_heading_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_up_sells_product_heading_font_weight ) : ?>
	/* Up Sells Product Heading Font Weight */
	.woocommerce.single-product .up-sells > h2 { font-weight: <?php echo esc_attr( $litho_single_product_up_sells_product_heading_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_up_sells_product_heading_font_italic ) : ?>
	/* Up Sells Product Heading Font Italic */
	.woocommerce.single-product .up-sells > h2 { font-style: italic }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_up_sells_product_heading_font_underline ) : ?>
	/* Up Sells Product Heading Font Underline */
	.woocommerce.single-product .up-sells > h2 { text-decoration: underline }
	<?php endif; ?>

	<?php if ( $litho_single_product_up_sells_product_heading_color ) : ?>
	/* Up Sells Product Heading Color */
	.woocommerce.single-product .up-sells > h2 { color: <?php echo esc_attr( $litho_single_product_up_sells_product_heading_color ); ?> }
	<?php endif; ?>
	<?php
	/* Cross Sells Product Heading */
	$litho_single_product_cross_sells_product_heading_font_size      = get_theme_mod( 'litho_single_product_cross_sells_product_heading_font_size', '' );
	$litho_single_product_cross_sells_product_heading_line_height    = get_theme_mod( 'litho_single_product_cross_sells_product_heading_line_height', '' );
	$litho_single_product_cross_sells_product_heading_letter_spacing = get_theme_mod( 'litho_single_product_cross_sells_product_heading_letter_spacing', '' );
	$litho_single_product_cross_sells_product_heading_font_weight    = get_theme_mod( 'litho_single_product_cross_sells_product_heading_font_weight', '' );
	$litho_single_product_cross_sells_product_heading_font_italic    = get_theme_mod( 'litho_single_product_cross_sells_product_heading_font_italic', '0' );
	$litho_single_product_cross_sells_product_heading_font_underline = get_theme_mod( 'litho_single_product_cross_sells_product_heading_font_underline', '0' );
	$litho_single_product_cross_sells_product_heading_color          = get_theme_mod( 'litho_single_product_cross_sells_product_heading_color', '' );
	?>
	<?php if ( $litho_single_product_cross_sells_product_heading_font_size ) : ?>
	/* Cross Sells Product Heading Font Size */
	.woocommerce.single-product .cross-sells > h2 { font-size: <?php echo esc_attr( $litho_single_product_cross_sells_product_heading_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_cross_sells_product_heading_line_height ) : ?>
	/* Cross Sells Product Heading Line Height */
	.woocommerce.single-product .cross-sells > h2 { line-height: <?php echo esc_attr( $litho_single_product_cross_sells_product_heading_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_cross_sells_product_heading_letter_spacing ) : ?>
	/* Cross Sells Product Heading Letter Spacing */
	.woocommerce.single-product .cross-sells > h2 { letter-spacing: <?php echo esc_attr( $litho_single_product_cross_sells_product_heading_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_single_product_cross_sells_product_heading_font_weight ) : ?>
	/* Cross Sells Product Heading Font Weight */
	.woocommerce.single-product .cross-sells > h2 { font-weight: <?php echo esc_attr( $litho_single_product_cross_sells_product_heading_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_cross_sells_product_heading_font_italic ) : ?>
	/* Cross Sells Product Heading Font Italic */
	.woocommerce.single-product .cross-sells > h2 { font-style: italic }
	<?php endif; ?>

	<?php if ( '1' == $litho_single_product_cross_sells_product_heading_font_underline ) : ?>
	/* Cross Sells Product Heading Font Underline */
	.woocommerce.single-product .cross-sells > h2 { text-decoration: underline }
	<?php endif; ?>

	<?php if ( $litho_single_product_cross_sells_product_heading_color ) : ?>
	/* Cross Sells Product Heading Color */
	.woocommerce.single-product .cross-sells > h2 { color: <?php echo esc_attr( $litho_single_product_cross_sells_product_heading_color ); ?> }
	<?php endif; ?>

	<?php
	/* Product Archive or Shop Product Sale */
	$litho_product_archive_product_sale_font_size     = get_theme_mod( 'litho_product_archive_product_sale_font_size', '' );
	$litho_product_archive_product_sale_line_height   = get_theme_mod( 'litho_product_archive_product_sale_line_height', '' );
	$litho_product_archive_product_sale_font_weight   = get_theme_mod( 'litho_product_archive_product_sale_font_weight', '' );
	$litho_product_archive_product_sale_color         = get_theme_mod( 'litho_product_archive_product_sale_color', '' );
	$litho_product_archive_product_sale_bg_color      = get_theme_mod( 'litho_product_archive_product_sale_bg_color', '' );
	$litho_product_archive_product_sale_enable_border = get_theme_mod( 'litho_product_archive_product_sale_enable_border', '1' );
	$litho_product_archive_product_sale_border_size   = get_theme_mod( 'litho_product_archive_product_sale_border_size', '' );
	$litho_product_archive_product_sale_border_type   = get_theme_mod( 'litho_product_archive_product_sale_border_type', '' );
	$litho_product_archive_product_sale_border_color  = get_theme_mod( 'litho_product_archive_product_sale_border_color', '' );
	?>
	<?php if ( $litho_product_archive_product_sale_font_size ) : ?>
	/* Archive Product Sale Font Size */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { font-size: <?php echo esc_attr( $litho_product_archive_product_sale_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_sale_line_height ) : ?>
	/* Archive Product Sale Line Height */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { line-height: <?php echo esc_attr( $litho_product_archive_product_sale_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_sale_font_weight ) : ?>
	/* Archive Product Sale Font Weight */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { font-weight: <?php echo esc_attr( $litho_product_archive_product_sale_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_sale_color ) : ?>
	/* Archive Product Sale Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { color: <?php echo esc_attr( $litho_product_archive_product_sale_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_sale_bg_color ) : ?>
	/* Archive Product Sale Background Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { background-color: <?php echo esc_attr( $litho_product_archive_product_sale_bg_color ); ?> }
	<?php endif; ?>

	<?php if ( '1' != $litho_product_archive_product_sale_enable_border ) : ?>
	/* Archive Product Sale Border None */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { border: none }
	<?php endif; ?>

	<?php if ( '1' == $litho_product_archive_product_sale_enable_border && $litho_product_archive_product_sale_border_size ) : ?>
	/* Archive Product Sale Border Size */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { border-width: <?php echo esc_attr( $litho_product_archive_product_sale_border_size ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_product_archive_product_sale_enable_border && $litho_product_archive_product_sale_border_type ) : ?>
	/* Archive Product Sale Border Style */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { border-style: <?php echo esc_attr( $litho_product_archive_product_sale_border_type ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_product_archive_product_sale_enable_border && $litho_product_archive_product_sale_border_color ) : ?>
	/* Archive Product Sale Border Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale { border-color: <?php echo esc_attr( $litho_product_archive_product_sale_border_color ); ?> }
	<?php endif; ?>
	<?php
	/* Product Archive or Shop Product Title */
	$litho_product_archive_product_title_font_size      = get_theme_mod( 'litho_product_archive_product_title_font_size', '' );
	$litho_product_archive_product_title_line_height    = get_theme_mod( 'litho_product_archive_product_title_line_height', '' );
	$litho_product_archive_product_title_letter_spacing = get_theme_mod( 'litho_product_archive_product_title_letter_spacing', '' );
	$litho_product_archive_product_title_font_weight    = get_theme_mod( 'litho_product_archive_product_title_font_weight', '' );
	$litho_product_archive_product_title_font_italic    = get_theme_mod( 'litho_product_archive_product_title_font_italic', '0' );
	$litho_product_archive_product_title_font_underline = get_theme_mod( 'litho_product_archive_product_title_font_underline', '0' );
	$litho_product_archive_product_title_color          = get_theme_mod( 'litho_product_archive_product_title_color', '' );
	$litho_product_archive_product_title_hover_color    = get_theme_mod( 'litho_product_archive_product_title_hover_color', '' );
	?>
	<?php if ( $litho_product_archive_product_title_font_size ) : ?>
	/* Archive Product Title Font Size */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a { font-size: <?php echo esc_attr( $litho_product_archive_product_title_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_title_line_height ) : ?>
	/* Archive Product Title Line Height */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a { line-height: <?php echo esc_attr( $litho_product_archive_product_title_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_title_letter_spacing ) : ?>
	/* Archive Product Title Letter Spacing */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a { letter-spacing: <?php echo esc_attr( $litho_product_archive_product_title_letter_spacing ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_title_font_weight ) : ?>
	/* Archive Product Title Font Weight */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a { font-weight: <?php echo esc_attr( $litho_product_archive_product_title_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( '1' == $litho_product_archive_product_title_font_italic ) : ?>
	/* Archive Product Title Font Italic */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a { font-style: italic }
	<?php endif; ?>

	<?php if ( '1' == $litho_product_archive_product_title_font_underline ) : ?>
	/* Archive Product Title Font Underline */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a { text-decoration: underline }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_title_color ) : ?>
	/* Archive Product Title Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a { color: <?php echo esc_attr( $litho_product_archive_product_title_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_title_hover_color ) : ?>
	/* Archive Product Title Hover Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a:hover { color: <?php echo esc_attr( $litho_product_archive_product_title_hover_color ); ?> }
	<?php endif; ?>
	<?php
	/* Product Archive or Shop Product Rating Star Color */
	$litho_product_archive_product_rating_star_color = get_theme_mod( 'litho_product_archive_product_rating_star_color', '' );
	?>
	<?php if ( $litho_product_archive_product_rating_star_color ) : ?>
	/* Archive Product Rating Star Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .star-rating::before, .woocommerce.archive .litho-shop-content-wrap ul li.product .star-rating span::before, .woocommerce.archive .litho-shop-content-wrap ul li.product .star-rating span::before { color: <?php echo esc_attr( $litho_product_archive_product_rating_star_color ); ?> }
	<?php endif; ?>
	<?php
	/* Product Archive or Shop Product Price */
	$litho_product_archive_product_price_font_size     = get_theme_mod( 'litho_product_archive_product_price_font_size', '' );
	$litho_product_archive_product_price_line_height   = get_theme_mod( 'litho_product_archive_product_price_line_height', '' );
	$litho_product_archive_product_price_font_weight   = get_theme_mod( 'litho_product_archive_product_price_font_weight', '' );
	$litho_product_archive_product_price_color         = get_theme_mod( 'litho_product_archive_product_price_color', '' );
	$litho_product_archive_product_regular_price_color = get_theme_mod( 'litho_product_archive_product_regular_price_color', '' );
	?>
	<?php if ( $litho_product_archive_product_price_font_size ) : ?>
	/* Archive Product Price Font Size */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .price, .woocommerce.archive .litho-shop-content-wrap ul li.product .price ins { font-size: <?php echo esc_attr( $litho_product_archive_product_price_font_size ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_price_line_height ) : ?>
	/* Archive Product Price Line Height */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .price, .woocommerce.archive .litho-shop-content-wrap ul li.product .price ins { line-height: <?php echo esc_attr( $litho_product_archive_product_price_line_height ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_price_font_weight ) : ?>
	/* Archive Product Price Font Weight */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .price, .woocommerce.archive .litho-shop-content-wrap ul li.product .price ins { font-weight: <?php echo esc_attr( $litho_product_archive_product_price_font_weight ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_price_color ) : ?>
	/* Archive Product Price Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .price, .woocommerce.archive .litho-shop-content-wrap ul li.product .price ins { color: <?php echo esc_attr( $litho_product_archive_product_price_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_regular_price_color ) : ?>
	/* Archive Product Regular Price Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product .price del { color: <?php echo esc_attr( $litho_product_archive_product_regular_price_color ); ?> }
	<?php endif; ?>
	<?php
	/* Product Archive or Shop Product Button */
	$litho_product_archive_product_button_color          = get_theme_mod( 'litho_product_archive_product_button_color', '' );
	$litho_product_archive_product_button_bg_color       = get_theme_mod( 'litho_product_archive_product_button_bg_color', '' );
	$litho_product_archive_product_button_hover_color    = get_theme_mod( 'litho_product_archive_product_button_hover_color', '' );
	$litho_product_archive_product_button_hover_bg_color = get_theme_mod( 'litho_product_archive_product_button_hover_bg_color', '' );
	?>
	<?php if ( $litho_product_archive_product_button_color ) : ?>
	/* Archive Product Button Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product a.button { color: <?php echo esc_attr( $litho_product_archive_product_button_color ); ?> }
	.woocommerce.archive .litho-shop-content-wrap a.added_to_cart:hover { color: <?php echo esc_attr( $litho_product_archive_product_button_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_button_bg_color ) : ?>
	/* Archive Product Button Background Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product a.button { background-color: <?php echo esc_attr( $litho_product_archive_product_button_bg_color ); ?> }
	.woocommerce.archive .litho-shop-content-wrap a.added_to_cart:hover { background-color: <?php echo esc_attr( $litho_product_archive_product_button_bg_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_button_hover_color ) : ?>
	/* Archive Product Button Hover Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product a.button:hover { color: <?php echo esc_attr( $litho_product_archive_product_button_hover_color ); ?> }
	.woocommerce.archive .litho-shop-content-wrap a.added_to_cart { color: <?php echo esc_attr( $litho_product_archive_product_button_hover_color ); ?> }
	<?php endif; ?>

	<?php if ( $litho_product_archive_product_button_hover_bg_color ) : ?>
	/* Archive Product Button Hover Background Color */
	.woocommerce.archive .litho-shop-content-wrap ul li.product a.button:hover { background-color: <?php echo esc_attr( $litho_product_archive_product_button_hover_bg_color ); ?> 
		!important; }
	.woocommerce.archive .litho-shop-content-wrap a.added_to_cart { background-color: <?php echo esc_attr( $litho_product_archive_product_button_hover_bg_color ); ?> 
		!important; }
	<?php endif; ?>
	<?php
}
?>
<?php
/* 404 Page Settings */
$litho_404_main_title_color        = get_theme_mod( 'litho_404_main_title_color', '' );
$litho_404_title_color             = get_theme_mod( 'litho_404_title_color', '' );
$litho_404_subtitle_color          = get_theme_mod( 'litho_404_subtitle_color', '' );
$litho_404_button_color            = get_theme_mod( 'litho_404_button_color', '' );
$litho_404_button_hover_color      = get_theme_mod( 'litho_404_button_hover_color', '' );
$litho_404_button_background_color = get_theme_mod( 'litho_404_button_background_color', '' );
?>
<?php if ( $litho_404_main_title_color ) : ?>
.error404 .litho-sub-heading { color: <?php echo esc_attr( $litho_404_main_title_color ); ?>!important; }
<?php endif; ?>

<?php if ( $litho_404_title_color ) : ?>
.error404 .litho-heading { color: <?php echo esc_attr( $litho_404_title_color ); ?>!important; }
<?php endif; ?>

<?php if ( $litho_404_subtitle_color ) : ?>
.error404 .litho-not-found-text { color: <?php echo esc_attr( $litho_404_subtitle_color ); ?>!important; }
<?php endif; ?>

<?php if ( $litho_404_button_color ) : ?>
.error404 .btn { color: <?php echo esc_attr( $litho_404_button_color ); ?>!important; }
<?php endif; ?>

<?php if ( $litho_404_button_hover_color ) : ?>
.error404 .btn:hover { color: <?php echo esc_attr( $litho_404_button_hover_color ); ?>!important; }
<?php endif; ?>

<?php if ( $litho_404_button_background_color ) : ?>
.error404 .btn { background-image: none !important; background-color: <?php echo esc_attr( $litho_404_button_background_color ); ?>!important; }
<?php endif; ?>

<?php
/* Side Icon Settings */
$litho_side_icon_first_button_background_color  = get_theme_mod( 'litho_side_icon_first_button_background_color', '' );
$litho_side_icon_first_button_text_color        = get_theme_mod( 'litho_side_icon_first_button_text_color', '' );
$litho_side_icon_second_button_background_color = get_theme_mod( 'litho_side_icon_second_button_background_color', '' );
$litho_side_icon_second_button_text_color       = get_theme_mod( 'litho_side_icon_second_button_text_color', '' );
?>
<?php if ( $litho_side_icon_first_button_background_color ) : ?>
.theme-demos .all-demo { background-color: <?php echo esc_attr( $litho_side_icon_first_button_background_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_side_icon_first_button_text_color ) : ?>
.theme-demos .all-demo a { color: <?php echo esc_attr( $litho_side_icon_first_button_text_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_side_icon_second_button_background_color ) : ?>
.theme-demos .buy-theme { background-color: <?php echo esc_attr( $litho_side_icon_second_button_background_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_side_icon_second_button_text_color ) : ?>
.theme-demos .buy-theme a { color: <?php echo esc_attr( $litho_side_icon_second_button_text_color ); ?>; }
<?php endif; ?>

<?php
/* Comment Settings */
$litho_comment_title_font_size           = get_theme_mod( 'litho_comment_title_font_size', '' );
$litho_comment_title_font_line_height    = get_theme_mod( 'litho_comment_title_font_line_height', '' );
$litho_comment_title_font_letter_spacing = get_theme_mod( 'litho_comment_title_font_letter_spacing', '' );
$litho_general_comment_title_color       = get_theme_mod( 'litho_general_comment_title_color', '' );
?>

<?php if ( $litho_comment_title_font_size ) : ?>
/* Comment Title Font Line Height */
.comment-title, .litho-comments-wrap .comment-respond .comment-reply-title { font-size: <?php echo esc_attr( $litho_comment_title_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_comment_title_font_line_height ) : ?>
/* Comment Title Line Height */
.comment-title, .litho-comments-wrap .comment-respond .comment-reply-title { line-height: <?php echo esc_attr( $litho_comment_title_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_comment_title_font_letter_spacing ) : ?>
/* Comment Title Letter Spacing */
.comment-title, .litho-comments-wrap .comment-respond .comment-reply-title { letter-spacing: <?php echo esc_attr( $litho_comment_title_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_general_comment_title_color ) : ?>
/* Comment Title Color */
.comment-title, .litho-comments-wrap .comment-respond .comment-reply-title { color: <?php echo esc_attr( $litho_general_comment_title_color ); ?>; }
<?php endif; ?>

<?php
/* Header SVG logo width */
$litho_header_svg_width = get_theme_mod( 'litho_header_svg_width', '' );
?>
<?php if ( ! empty( $litho_header_svg_width ) ) : ?>
/* Header SVG logo light width */
header a.logo-light img {width: <?php echo esc_attr( $litho_header_svg_width ); ?>;}
/* Header SVG logo dark width */
header a.logo-dark img {width: <?php echo esc_attr( $litho_header_svg_width ); ?>;}
<?php endif; ?>

<?php
/* Heading Settings */
$litho_h1_font_size           = get_theme_mod( 'litho_h1_font_size', '' );
$litho_h1_font_line_height    = get_theme_mod( 'litho_h1_font_line_height', '' );
$litho_h1_font_letter_spacing = get_theme_mod( 'litho_h1_font_letter_spacing', '' );
$litho_h1_font_weight         = get_theme_mod( 'litho_h1_font_weight', '' );
$litho_heading_h1_color       = get_theme_mod( 'litho_heading_h1_color', '' );
$litho_h2_font_size           = get_theme_mod( 'litho_h2_font_size', '' );
$litho_h2_font_line_height    = get_theme_mod( 'litho_h2_font_line_height', '' );
$litho_h2_font_letter_spacing = get_theme_mod( 'litho_h2_font_letter_spacing', '' );
$litho_h2_font_weight         = get_theme_mod( 'litho_h2_font_weight', '' );
$litho_heading_h2_color       = get_theme_mod( 'litho_heading_h2_color', '' );
$litho_h3_font_size           = get_theme_mod( 'litho_h3_font_size', '' );
$litho_h3_font_line_height    = get_theme_mod( 'litho_h3_font_line_height', '' );
$litho_h3_font_letter_spacing = get_theme_mod( 'litho_h3_font_letter_spacing', '' );
$litho_h3_font_weight         = get_theme_mod( 'litho_h3_font_weight', '' );
$litho_heading_h3_color       = get_theme_mod( 'litho_heading_h3_color', '' );
$litho_h4_font_size           = get_theme_mod( 'litho_h4_font_size', '' );
$litho_h4_font_line_height    = get_theme_mod( 'litho_h4_font_line_height', '' );
$litho_h4_font_letter_spacing = get_theme_mod( 'litho_h4_font_letter_spacing', '' );
$litho_h4_font_weight         = get_theme_mod( 'litho_h4_font_weight', '' );
$litho_heading_h4_color       = get_theme_mod( 'litho_heading_h4_color', '' );
$litho_h5_font_size           = get_theme_mod( 'litho_h5_font_size', '' );
$litho_h5_font_line_height    = get_theme_mod( 'litho_h5_font_line_height', '' );
$litho_h5_font_letter_spacing = get_theme_mod( 'litho_h5_font_letter_spacing', '' );
$litho_h5_font_weight         = get_theme_mod( 'litho_h5_font_weight', '' );
$litho_heading_h5_color       = get_theme_mod( 'litho_heading_h5_color', '' );
$litho_h6_font_size           = get_theme_mod( 'litho_h6_font_size', '' );
$litho_h6_font_line_height    = get_theme_mod( 'litho_h6_font_line_height', '' );
$litho_h6_font_letter_spacing = get_theme_mod( 'litho_h6_font_letter_spacing', '' );
$litho_h6_font_weight         = get_theme_mod( 'litho_h6_font_weight', '' );
$litho_heading_h6_color       = get_theme_mod( 'litho_heading_h6_color', '' );
?>
<?php if ( $litho_h1_font_size ) : ?>
/* H1 Font Size */
h1 { font-size: <?php echo esc_attr( $litho_h1_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_h1_font_line_height ) : ?>
/* H1 Font Line Height */
h1 { line-height: <?php echo esc_attr( $litho_h1_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_h1_font_letter_spacing ) : ?>
/* H1 Font Letter Spacing */
h1 { letter-spacing: <?php echo esc_attr( $litho_h1_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_h1_font_weight ) : ?>
/* H1 Font Weight */
h1 { font-weight: <?php echo esc_attr( $litho_h1_font_weight ); ?>; }
<?php endif; ?>

<?php if ( $litho_heading_h1_color ) : ?>
/* H1 Color */
h1 { color: <?php echo esc_attr( $litho_heading_h1_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_h2_font_size ) : ?>
/* H2 Font Size */
h2 { font-size: <?php echo esc_attr( $litho_h2_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_h2_font_line_height ) : ?>
/* H2 Font Line Height */
h2 { line-height: <?php echo esc_attr( $litho_h2_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_h2_font_letter_spacing ) : ?>
/* H2 Font Letter Spacing */
h2 { letter-spacing: <?php echo esc_attr( $litho_h2_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_h2_font_weight ) : ?>
/* H2 Font Weight */
h2 { font-weight: <?php echo esc_attr( $litho_h2_font_weight ); ?>; }
<?php endif; ?>

<?php if ( $litho_heading_h2_color ) : ?>
/* H2 Color */
h2 { color: <?php echo esc_attr( $litho_heading_h2_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_h3_font_size ) : ?>
/* H3 Font Size */
h3 { font-size: <?php echo esc_attr( $litho_h3_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_h3_font_line_height ) : ?>
/* H3 Font Line Height */
h3 { line-height: <?php echo esc_attr( $litho_h3_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_h3_font_letter_spacing ) : ?>
/* H3 Font Letter Spacing */
h3 { letter-spacing: <?php echo esc_attr( $litho_h3_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_h3_font_weight ) : ?>
/* H3 Font Weight */
h3 { font-weight: <?php echo esc_attr( $litho_h3_font_weight ); ?>; }
<?php endif; ?>

<?php if ( $litho_heading_h3_color ) : ?>
/* H3 Color */
h3 { color: <?php echo esc_attr( $litho_heading_h3_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_h4_font_size ) : ?>
/* H4 Font Size */
h4 { font-size: <?php echo esc_attr( $litho_h4_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_h4_font_line_height ) : ?>
/* H4 Font Line Height */
h4 { line-height: <?php echo esc_attr( $litho_h4_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_h4_font_letter_spacing ) : ?>
/* H4 Font Letter Spacing */
h4 { letter-spacing: <?php echo esc_attr( $litho_h4_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_h4_font_weight ) : ?>
/* H4 Font Weight */
h4 { font-weight: <?php echo esc_attr( $litho_h4_font_weight ); ?>; }
<?php endif; ?>

<?php if ( $litho_heading_h4_color ) : ?>
/* H4 Color */
h4 { color: <?php echo esc_attr( $litho_heading_h4_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_h5_font_size ) : ?>
/* H5 Font Size */
h5 { font-size: <?php echo esc_attr( $litho_h5_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_h5_font_line_height ) : ?>
/* H5 Font Line Height */
h5 { line-height: <?php echo esc_attr( $litho_h5_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_h5_font_letter_spacing ) : ?>
/* H5 Font Letter Spacing */
h5 { letter-spacing: <?php echo esc_attr( $litho_h5_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_h5_font_weight ) : ?>
/* H5 Font Weight */
h5 { font-weight: <?php echo esc_attr( $litho_h5_font_weight ); ?>; }
<?php endif; ?>

<?php if ( $litho_heading_h5_color ) : ?>
/* H5 Color */
h5 { color: <?php echo esc_attr( $litho_heading_h5_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_h6_font_size ) : ?>
/* H6 Font Size */
h6 { font-size: <?php echo esc_attr( $litho_h6_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_h6_font_line_height ) : ?>
/* H6 Font Line Height */
h6 { line-height: <?php echo esc_attr( $litho_h6_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_h6_font_letter_spacing ) : ?>
/* H6 Font Letter Spacing */
h6 { letter-spacing: <?php echo esc_attr( $litho_h6_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_h6_font_weight ) : ?>
/* H6 Font Weight */
h6 { font-weight: <?php echo esc_attr( $litho_h6_font_weight ); ?>; }
<?php endif; ?>

<?php if ( $litho_heading_h6_color ) : ?>
/* H6 Color */
h6 { color: <?php echo esc_attr( $litho_heading_h6_color ); ?>; }
<?php endif; ?>

<?php
/* Content */
$litho_content_font_size           = get_theme_mod( 'litho_content_font_size', '' );
$litho_content_font_line_height    = get_theme_mod( 'litho_content_font_line_height', '' );
$litho_content_font_letter_spacing = get_theme_mod( 'litho_content_font_letter_spacing', '' );
$litho_content_link_color          = get_theme_mod( 'litho_content_link_color', '' );
$litho_content_link_hover_color    = get_theme_mod( 'litho_content_link_hover_color', '' );
?>
<?php if ( $litho_content_font_size ) : ?>
/* Content Font Size */
.entry-content, .entry-content p { font-size: <?php echo esc_attr( $litho_content_font_size ); ?>; }
<?php endif; ?>

<?php if ( $litho_content_font_line_height ) : ?>
/* Content Font Line Height */
.entry-content, .entry-content p { line-height: <?php echo esc_attr( $litho_content_font_line_height ); ?>; }
<?php endif; ?>

<?php if ( $litho_content_font_letter_spacing ) : ?>
/* Content Font Letter Spancing */
.entry-content, .entry-content p { letter-spacing: <?php echo esc_attr( $litho_content_font_letter_spacing ); ?>; }
<?php endif; ?>

<?php if ( $litho_content_link_color ) : ?>
/* Content Text Color */
a, .blog-details-text a { color: <?php echo esc_attr( $litho_content_link_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_content_link_hover_color ) : ?>
/* Content Text Hover Color */
a:hover, .blog-details-text a:hover { color: <?php echo esc_attr( $litho_content_link_hover_color ); ?>; }
<?php endif; ?>

<?php
/* GDPR General Settings */
$litho_gdpr_box_background_color = get_theme_mod( 'litho_gdpr_box_background_color', '' );
$litho_gdpr_overlay_color        = get_theme_mod( 'litho_gdpr_overlay_color', '' );
/* GDPR Content Settings */
$litho_gdpr_content_font_size      = get_theme_mod( 'litho_gdpr_content_font_size', '' );
$litho_gdpr_content_line_height    = get_theme_mod( 'litho_gdpr_content_line_height', '' );
$litho_gdpr_content_letter_spacing = get_theme_mod( 'litho_gdpr_content_letter_spacing', '' );
$litho_gdpr_content_font_weight    = get_theme_mod( 'litho_gdpr_content_font_weight', '' );
$litho_gdpr_content_color          = get_theme_mod( 'litho_gdpr_content_color', '' );
$litho_gdpr_content_hover_color    = get_theme_mod( 'litho_gdpr_content_hover_color', '' );
/* GDPR Button Settings */
$litho_gdpr_button_font_size           = get_theme_mod( 'litho_gdpr_button_font_size', '' );
$litho_gdpr_button_line_height         = get_theme_mod( 'litho_gdpr_button_line_height', '' );
$litho_gdpr_button_letter_spacing      = get_theme_mod( 'litho_gdpr_button_letter_spacing', '' );
$litho_gdpr_button_font_text_transform = get_theme_mod( 'litho_gdpr_button_font_text_transform', 'uppercase' );
$litho_gdpr_button_font_weight         = get_theme_mod( 'litho_gdpr_button_font_weight', '' );
$litho_gdpr_button_bg_color            = get_theme_mod( 'litho_gdpr_button_bg_color', '' );
$litho_gdpr_button_bg_hover_color      = get_theme_mod( 'litho_gdpr_button_bg_hover_color', '' );
$litho_gdpr_button_color               = get_theme_mod( 'litho_gdpr_button_color', '' );
$litho_gdpr_button_hover_color         = get_theme_mod( 'litho_gdpr_button_hover_color', '' );
$litho_gdpr_button_border_color        = get_theme_mod( 'litho_gdpr_button_border_color', '' );
$litho_gdpr_button_border_hover_color  = get_theme_mod( 'litho_gdpr_button_border_hover_color', '' );
?>
<?php if ( $litho_gdpr_box_background_color ) : ?>
/* GDPR Box Background Color */
.litho-cookie-policy-wrapper .cookie-container { background-color: <?php echo esc_attr( $litho_gdpr_box_background_color ); ?> }
<?php endif; ?>
<?php if ( $litho_gdpr_overlay_color ) : ?>
/* GDPR Overlay Color */
.litho-cookie-policy-wrapper { background-color: <?php echo esc_attr( $litho_gdpr_overlay_color ); ?> }
<?php endif; ?>
<?php if ( $litho_gdpr_content_font_size ) : ?>
/* GDPR Content Font Size */
.cookie-container .litho-cookie-policy-text { font-size: <?php echo esc_attr( $litho_gdpr_content_font_size ); ?>; }
<?php endif; ?>
<?php if ( $litho_gdpr_content_line_height ) : ?>
/* GDPR Content Line Height */
.cookie-container .litho-cookie-policy-text { line-height: <?php echo esc_attr( $litho_gdpr_content_line_height ); ?>; }
<?php endif; ?>
<?php if ( $litho_gdpr_content_letter_spacing ) : ?>
/* GDPR Content Letter Spacing */
.cookie-container .litho-cookie-policy-text { letter-spacing: <?php echo esc_attr( $litho_gdpr_content_letter_spacing ); ?>; }
<?php endif; ?>
<?php if ( $litho_gdpr_content_font_weight ) : ?>
/* GDPR Content Font Weight */
.cookie-container .litho-cookie-policy-text { font-weight: <?php echo esc_attr( $litho_gdpr_content_font_weight ); ?>; }
<?php endif; ?>
<?php if ( $litho_gdpr_content_color ) : ?>
/* GDPR Content Color */
.cookie-container .litho-cookie-policy-text, .cookie-container .litho-cookie-policy-text a { color: <?php echo esc_attr( $litho_gdpr_content_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_gdpr_content_hover_color ) : ?>
/* GDPR Content Hover Color */
.cookie-container .litho-cookie-policy-text a:hover { color: <?php echo esc_attr( $litho_gdpr_content_hover_color ); ?>; }
<?php endif; ?>
<?php if ( $litho_gdpr_button_font_size ) : ?>
	/* GDPR Button Font Size */
	.litho-cookie-policy-wrapper .cookie-container .btn { font-size: <?php echo esc_attr( $litho_gdpr_button_font_size ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_line_height ) : ?>
	/* GDPR Button Line Height */
	.litho-cookie-policy-wrapper .cookie-container .btn { line-height: <?php echo esc_attr( $litho_gdpr_button_line_height ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_letter_spacing ) : ?>
	/* GDPR Button Letter Spacing */
	.litho-cookie-policy-wrapper .cookie-container .btn { letter-spacing: <?php echo esc_attr( $litho_gdpr_button_letter_spacing ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_font_text_transform ) : ?>
	/* GDPR Button Text Transform */
	.litho-cookie-policy-wrapper .cookie-container .btn { text-transform: <?php echo esc_attr( $litho_gdpr_button_font_text_transform ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_font_weight ) : ?>
	/* GDPR Button Font Weight */
	.litho-cookie-policy-wrapper .cookie-container .btn { font-weight: <?php echo esc_attr( $litho_gdpr_button_font_weight ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_bg_color ) : ?>
	/* GDPR Button Background Color */
	.litho-cookie-policy-wrapper .cookie-container .btn { background-color: <?php echo esc_attr( $litho_gdpr_button_bg_color ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_bg_hover_color ) : ?>
	/* GDPR Button Hover Background Color */
	.litho-cookie-policy-wrapper .cookie-container .btn:hover { background-color: <?php echo esc_attr( $litho_gdpr_button_bg_hover_color ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_color ) : ?>
	/* GDPR Button Color */
	.litho-cookie-policy-wrapper .cookie-container .btn { color: <?php echo esc_attr( $litho_gdpr_button_color ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_hover_color ) : ?>
	/* GDPR Button Hover Color */
	.litho-cookie-policy-wrapper .cookie-container .btn:hover { color: <?php echo esc_attr( $litho_gdpr_button_hover_color ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_border_color ) : ?>
	/* GDPR Button Border Color */
	.litho-cookie-policy-wrapper .cookie-container .btn { border-color: <?php echo esc_attr( $litho_gdpr_button_border_color ); ?>}
<?php endif; ?>
<?php if ( $litho_gdpr_button_border_hover_color ) : ?>
	/* GDPR Button Hover Border Color */
	.litho-cookie-policy-wrapper .cookie-container .btn:hover { border-color: <?php echo esc_attr( $litho_gdpr_button_border_hover_color ); ?>}
<?php endif; ?>

<?php
$litho_content_container_fluid_with_padding = '';
if ( is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() ) ) { // if WooCommerce plugin is activated and WooCommercecategory, brand, shop page.
	$litho_content_container_fluid_with_padding = get_theme_mod( 'litho_product_container_fluid_with_padding_archive', '' );

} elseif ( is_woocommerce_activated() && is_product() ) {

	$litho_content_container_fluid_with_padding = get_theme_mod( 'litho_product_container_fluid_with_padding', '' );

} elseif ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) {

	$litho_content_container_fluid_with_padding = get_theme_mod( 'litho_portfolio_container_fluid_with_padding_archive', '' );

} elseif ( is_search() || is_category() || is_tag() || is_archive() ) {

	$litho_content_container_fluid_with_padding = get_theme_mod( 'litho_post_container_fluid_with_padding_archive', '' );

} elseif ( is_home() ) {

	$litho_content_container_fluid_with_padding = get_theme_mod( 'litho_post_container_fluid_with_padding_default', '' );

} elseif ( 'portfolio' === get_post_type() && is_singular( 'portfolio' ) ) {

	$litho_content_container_fluid_with_padding = litho_option( 'litho_portfolio_container_fluid_with_padding', '' );

} elseif ( is_single() ) {

	$litho_content_container_fluid_with_padding = litho_option( 'litho_post_container_fluid_with_padding', '' );

} else {

	$litho_content_container_fluid_with_padding = litho_option( 'litho_page_container_fluid_with_padding', '' );
}
?>
<?php if ( $litho_content_container_fluid_with_padding ) : ?>
/* Default Custom Padding Content */
.litho-main-content-wrap .container-fluid-with-padding { padding-left : <?php echo esc_attr( $litho_content_container_fluid_with_padding ); ?>; padding-right : <?php echo esc_attr( $litho_content_container_fluid_with_padding ); ?>; }
<?php endif; ?>

<?php
/* Page Preloader */
$litho_preload_bg_color = get_theme_mod( 'litho_preload_bg_color', '' );
?>
<?php if ( $litho_preload_bg_color ) : ?>
	/* Preload background color */
	.preloader-overlay { background-color : <?php echo esc_attr( $litho_preload_bg_color ); ?>; }
<?php endif; ?>


