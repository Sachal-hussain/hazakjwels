<?php
/**
 * Generate sidebar css.
 *
 * @package Litho
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Post Widget General Settings */
$litho_post_widget_content_color            = get_theme_mod( 'litho_post_widget_content_color', '' );
$litho_post_widget_content_link_color       = get_theme_mod( 'litho_post_widget_content_link_color', '' );
$litho_post_widget_content_link_hover_color = get_theme_mod( 'litho_post_widget_content_link_hover_color', '' );
$litho_post_widget_background_color         = get_theme_mod( 'litho_post_widget_background_color', '' );
$litho_post_widget_border_color             = get_theme_mod( 'litho_post_widget_border_color', '' );
/* Post Widget Title Settings */
$litho_post_widget_title_font_size      = get_theme_mod( 'litho_post_widget_title_font_size', '' );
$litho_post_widget_title_line_height    = get_theme_mod( 'litho_post_widget_title_line_height', '' );
$litho_post_widget_title_letter_spacing = get_theme_mod( 'litho_post_widget_title_letter_spacing', '' );
$litho_post_widget_title_text_transform = get_theme_mod( 'litho_post_widget_title_text_transform', '' );
$litho_post_widget_title_font_weight    = get_theme_mod( 'litho_post_widget_title_font_weight', '' );
$litho_post_widget_title_color          = get_theme_mod( 'litho_post_widget_title_color', '' );
/* Page Widget General Settings */
$litho_page_widget_content_color            = get_theme_mod( 'litho_page_widget_content_color', '' );
$litho_page_widget_content_link_color       = get_theme_mod( 'litho_page_widget_content_link_color', '' );
$litho_page_widget_content_link_hover_color = get_theme_mod( 'litho_page_widget_content_link_hover_color', '' );
$litho_page_widget_background_color         = get_theme_mod( 'litho_page_widget_background_color', '' );
$litho_page_widget_border_color             = get_theme_mod( 'litho_page_widget_border_color', '' );
/* Page Widget Title Settings */
$litho_page_widget_title_font_size      = get_theme_mod( 'litho_page_widget_title_font_size', '' );
$litho_page_widget_title_line_height    = get_theme_mod( 'litho_page_widget_title_line_height', '' );
$litho_page_widget_title_letter_spacing = get_theme_mod( 'litho_page_widget_title_letter_spacing', '' );
$litho_page_widget_title_text_transform = get_theme_mod( 'litho_page_widget_title_text_transform', '' );
$litho_page_widget_title_font_weight    = get_theme_mod( 'litho_page_widget_title_font_weight', '' );
$litho_page_widget_title_color          = get_theme_mod( 'litho_page_widget_title_color', '' );
/* portfolio Widget General Settings */
$litho_portfolio_widget_content_color            = get_theme_mod( 'litho_portfolio_widget_content_color', '' );
$litho_portfolio_widget_content_link_color       = get_theme_mod( 'litho_portfolio_widget_content_link_color', '' );
$litho_portfolio_widget_content_link_hover_color = get_theme_mod( 'litho_portfolio_widget_content_link_hover_color', '' );
$litho_portfolio_widget_background_color         = get_theme_mod( 'litho_portfolio_widget_background_color', '' );
$litho_portfolio_widget_border_color             = get_theme_mod( 'litho_portfolio_widget_border_color', '' );
/* portfolio Widget Title Settings */
$litho_portfolio_widget_title_font_size      = get_theme_mod( 'litho_portfolio_widget_title_font_size', '' );
$litho_portfolio_widget_title_line_height    = get_theme_mod( 'litho_portfolio_widget_title_line_height', '' );
$litho_portfolio_widget_title_letter_spacing = get_theme_mod( 'litho_portfolio_widget_title_letter_spacing', '' );
$litho_portfolio_widget_title_text_transform = get_theme_mod( 'litho_portfolio_widget_title_text_transform', '' );
$litho_portfolio_widget_title_font_weight    = get_theme_mod( 'litho_portfolio_widget_title_font_weight', '' );
$litho_portfolio_widget_title_color          = get_theme_mod( 'litho_portfolio_widget_title_color', '' );
/* Product Widget General Settings */
$litho_product_widget_content_color            = get_theme_mod( 'litho_product_widget_content_color', '' );
$litho_product_widget_content_link_color       = get_theme_mod( 'litho_product_widget_content_link_color', '' );
$litho_product_widget_content_link_hover_color = get_theme_mod( 'litho_product_widget_content_link_hover_color', '' );
$litho_product_widget_background_color         = get_theme_mod( 'litho_product_widget_background_color', '' );
$litho_product_widget_border_color             = get_theme_mod( 'litho_product_widget_border_color', '' );
/* Product Widget Title Settings */
$litho_product_widget_title_font_size      = get_theme_mod( 'litho_product_widget_title_font_size', '' );
$litho_product_widget_title_line_height    = get_theme_mod( 'litho_product_widget_title_line_height', '' );
$litho_product_widget_title_letter_spacing = get_theme_mod( 'litho_product_widget_title_letter_spacing', '' );
$litho_product_widget_title_text_transform = get_theme_mod( 'litho_product_widget_title_text_transform', '' );
$litho_product_widget_title_font_weight    = get_theme_mod( 'litho_product_widget_title_font_weight', '' );
$litho_product_widget_title_color          = get_theme_mod( 'litho_product_widget_title_color', '' );
?>
/* POST Sidebar Widget General Settings */
<?php if ( $litho_post_widget_content_color ) : ?>
	/* Post Widget Content Color */
	.litho-post-sidebar p, .litho-post-sidebar .widget, .litho-post-sidebar .about-me-wp-widget .author-name, .litho-post-sidebar .about-me-wp-widget .author-designation { color: <?php echo esc_attr( $litho_post_widget_content_color ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_content_link_color ) : ?>
	/* Post Widget Content Link Color */
	.litho-post-sidebar a, .litho-post-sidebar .social-icon-style-1 a, .litho-post-sidebar ul.recent-post-wp-widget li .media-body .recent-post-title { color: <?php echo esc_attr( $litho_post_widget_content_link_color ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_content_link_hover_color ) : ?>
	/* Post Widget Content Link Hover Color */
	.litho-post-sidebar a:hover, .litho-post-sidebar .social-icon-style-1 a:hover, .litho-post-sidebar ul.recent-post-wp-widget li .media-body .recent-post-title:hover { color: <?php echo esc_attr( $litho_post_widget_content_link_hover_color ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_background_color ) : ?>
	/* Post Widget background Color */
	.litho-post-sidebar .about-me-wp-widget { background-color: <?php echo esc_attr( $litho_post_widget_background_color ); ?> }
<?php endif; ?>
<?php if ( $litho_post_widget_border_color ) : ?>
	/* Post Widget Content Link Hover Color */
	.litho-post-sidebar .about-me-wp-widget, .litho-post-sidebar .widget_search input { border-color: <?php echo esc_attr( $litho_post_widget_border_color ); ?> }
<?php endif; ?>
/* End POST Widget General Settings */

/* POST Sidebar Widget Title Settings */
<?php if ( $litho_post_widget_title_font_size ) : ?>
	/* Post Widget Title Font Size */
	.litho-post-sidebar .widget-title { font-size: <?php echo esc_attr( $litho_post_widget_title_font_size ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_title_line_height ) : ?>
	/* Post Widget Title Line Height */
	.litho-post-sidebar .widget-title { line-height: <?php echo esc_attr( $litho_post_widget_title_line_height ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_title_letter_spacing ) : ?>
	/* Post Widget Title Letter Spacing */
	.litho-post-sidebar .widget-title { letter-spacing: <?php echo esc_attr( $litho_post_widget_title_letter_spacing ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_title_text_transform ) : ?>
	/* Post Widget Title Text Transform */
	.litho-post-sidebar .widget-title { text-transform: <?php echo esc_attr( $litho_post_widget_title_text_transform ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_title_font_weight ) : ?>
	/* Post Widget Title Font Weight */
	.litho-post-sidebar .widget-title { font-weight: <?php echo esc_attr( $litho_post_widget_title_font_weight ); ?>}
<?php endif; ?>
<?php if ( $litho_post_widget_title_color ) : ?>
	/* Post Widget Title Color */
	.litho-post-sidebar .widget-title { color: <?php echo esc_attr( $litho_post_widget_title_color ); ?>}
<?php endif; ?>
/* End POST Widget Title Settings */

/* PAGE Sidebar Widget General Settings */
<?php if ( $litho_page_widget_content_color ) : ?>
	/* Page Widget Content Color */
	.litho-page-sidebar p, .litho-page-sidebar .widget, .litho-page-sidebar .about-me-wp-widget .author-name, .litho-page-sidebar .about-me-wp-widget .author-designation { color: <?php echo esc_attr( $litho_page_widget_content_color ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_content_link_color ) : ?>
	/* Page Widget Content Link Color */
	.litho-page-sidebar a, .litho-page-sidebar .social-icon-style-1 a, .litho-page-sidebar ul.recent-page-wp-widget li .media-body .recent-page-title { color: <?php echo esc_attr( $litho_page_widget_content_link_color ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_content_link_hover_color ) : ?>
	/* Page Widget Content Link Hover Color */
	.litho-page-sidebar a:hover, .litho-page-sidebar .social-icon-style-1 a:hover, .litho-page-sidebar ul.recent-page-wp-widget li .media-body .recent-page-title:hover { color: <?php echo esc_attr( $litho_page_widget_content_link_hover_color ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_background_color ) : ?>
	/* Page Widget background Color */
	.litho-page-sidebar .about-me-wp-widget { background-color: <?php echo esc_attr( $litho_page_widget_background_color ); ?> }
<?php endif; ?>
<?php if ( $litho_page_widget_border_color ) : ?>
	/* Page Widget Content Link Hover Color */
	.litho-page-sidebar .about-me-wp-widget, .litho-page-sidebar .widget_search input { border-color: <?php echo esc_attr( $litho_page_widget_border_color ); ?> }
<?php endif; ?>
/* End PAGE Widget General Settings */

/* PAGE Sidebar Widget Title Settings */
<?php if ( $litho_page_widget_title_font_size ) : ?>
	/* Page Widget Title Font Size */
	.litho-page-sidebar .widget-title { font-size: <?php echo esc_attr( $litho_page_widget_title_font_size ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_title_line_height ) : ?>
	/* Page Widget Title Line Height */
	.litho-page-sidebar .widget-title { line-height: <?php echo esc_attr( $litho_page_widget_title_line_height ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_title_letter_spacing ) : ?>
	/* Page Widget Title Letter Spacing */
	.litho-page-sidebar .widget-title { letter-spacing: <?php echo esc_attr( $litho_page_widget_title_letter_spacing ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_title_text_transform ) : ?>
	/* Page Widget Title Text Transform */
	.litho-page-sidebar .widget-title { text-transform: <?php echo esc_attr( $litho_page_widget_title_text_transform ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_title_font_weight ) : ?>
	/* Page Widget Title Font Weight */
	.litho-page-sidebar .widget-title { font-weight: <?php echo esc_attr( $litho_page_widget_title_font_weight ); ?>}
<?php endif; ?>
<?php if ( $litho_page_widget_title_color ) : ?>
	/* Page Widget Title Color */
	.litho-page-sidebar .widget-title { color: <?php echo esc_attr( $litho_page_widget_title_color ); ?>}
<?php endif; ?>
/* End PAGE Widget Title Settings */

/* PORTFOLIO Sidebar Widget General Settings */
<?php if ( $litho_portfolio_widget_content_color ) : ?>
	/* Portfolio Widget Content Color */
	.litho-portfolio-sidebar p, .litho-portfolio-sidebar .widget, .litho-portfolio-sidebar .about-me-wp-widget .author-name, .litho-portfolio-sidebar .about-me-wp-widget .author-designation { color: <?php echo esc_attr( $litho_portfolio_widget_content_color ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_content_link_color ) : ?>
	/* Portfolio Widget Content Link Color */
	.litho-portfolio-sidebar a, .litho-portfolio-sidebar .social-icon-style-1 a, .litho-portfolio-sidebar ul.recent-portfolio-wp-widget li .media-body .recent-portfolio-title { color: <?php echo esc_attr( $litho_portfolio_widget_content_link_color ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_content_link_hover_color ) : ?>
	/* Portfolio Widget Content Link Hover Color */
	.litho-portfolio-sidebar a:hover, .litho-portfolio-sidebar .social-icon-style-1 a:hover, .litho-portfolio-sidebar ul.recent-portfolio-wp-widget li .media-body .recent-portfolio-title:hover { color: <?php echo esc_attr( $litho_portfolio_widget_content_link_hover_color ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_background_color ) : ?>
	/* Portfolio Widget background Color */
	.litho-portfolio-sidebar .about-me-wp-widget { background-color: <?php echo esc_attr( $litho_portfolio_widget_background_color ); ?> }
<?php endif; ?>
<?php if ( $litho_portfolio_widget_border_color ) : ?>
	/* Portfolio Widget Content Link Hover Color */
	.litho-portfolio-sidebar .about-me-wp-widget, .litho-portfolio-sidebar .widget_search input { border-color: <?php echo esc_attr( $litho_portfolio_widget_border_color ); ?> }
<?php endif; ?>
/* End PORTFOLIO Widget General Settings */

/* PORTFOLIO Sidebar Widget Title Settings */
<?php if ( $litho_portfolio_widget_title_font_size ) : ?>
	/* Portfolio Widget Title Font Size */
	.litho-portfolio-sidebar .widget-title { font-size: <?php echo esc_attr( $litho_portfolio_widget_title_font_size ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_title_line_height ) : ?>
	/* Portfolio Widget Title Line Height */
	.litho-portfolio-sidebar .widget-title { line-height: <?php echo esc_attr( $litho_portfolio_widget_title_line_height ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_title_letter_spacing ) : ?>
	/* Portfolio Widget Title Letter Spacing */
	.litho-portfolio-sidebar .widget-title { letter-spacing: <?php echo esc_attr( $litho_portfolio_widget_title_letter_spacing ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_title_text_transform ) : ?>
	/* Portfolio Widget Title Text Transform */
	.litho-portfolio-sidebar .widget-title { text-transform: <?php echo esc_attr( $litho_portfolio_widget_title_text_transform ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_title_font_weight ) : ?>
	/* Portfolio Widget Title Font Weight */
	.litho-portfolio-sidebar .widget-title { font-weight: <?php echo esc_attr( $litho_portfolio_widget_title_font_weight ); ?>}
<?php endif; ?>
<?php if ( $litho_portfolio_widget_title_color ) : ?>
	/* Portfolio Widget Title Color */
	.litho-portfolio-sidebar .widget-title { color: <?php echo esc_attr( $litho_portfolio_widget_title_color ); ?>}
<?php endif; ?>
/* End PORTFOLIO Widget Title Settings */

/* PRODUCT Sidebar Widget General Settings */
<?php if ( $litho_product_widget_content_color ) : ?>
	/* Product Widget Content Color */
	.litho-product-sidebar p, .litho-product-sidebar .widget, .litho-product-sidebar .about-me-wp-widget .author-name, .litho-product-sidebar .about-me-wp-widget .author-designation { color: <?php echo esc_attr( $litho_product_widget_content_color ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_content_link_color ) : ?>
	/* Product Widget Content Link Color */
	.litho-product-sidebar a, .litho-product-sidebar .social-icon-style-1 a, .litho-product-sidebar ul.recent-product-wp-widget li .media-body .recent-product-title { color: <?php echo esc_attr( $litho_product_widget_content_link_color ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_content_link_hover_color ) : ?>
	/* Product Widget Content Link Hover Color */
	.litho-product-sidebar a:hover, .litho-product-sidebar .social-icon-style-1 a:hover, .litho-product-sidebar ul.recent-product-wp-widget li .media-body .recent-product-title:hover { color: <?php echo esc_attr( $litho_product_widget_content_link_hover_color ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_background_color ) : ?>
	/* Product Widget background Color */
	.litho-product-sidebar .about-me-wp-widget { background-color: <?php echo esc_attr( $litho_product_widget_background_color ); ?> }
<?php endif; ?>
<?php if ( $litho_product_widget_border_color ) : ?>
	/* Product Widget Content Link Hover Color */
	.litho-product-sidebar .about-me-wp-widget, .litho-product-sidebar .widget_search input { border-color: <?php echo esc_attr( $litho_product_widget_border_color ); ?> }
<?php endif; ?>
/* End PRODUCT Widget General Settings */

/* PRODUCT Sidebar Widget Title Settings */
<?php if ( $litho_product_widget_title_font_size ) : ?>
	/* Product Widget Title Font Size */
	.litho-product-sidebar .widget-title { font-size: <?php echo esc_attr( $litho_product_widget_title_font_size ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_title_line_height ) : ?>
	/* Product Widget Title Line Height */
	.litho-product-sidebar .widget-title { line-height: <?php echo esc_attr( $litho_product_widget_title_line_height ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_title_letter_spacing ) : ?>
	/* Product Widget Title Letter Spacing */
	.litho-product-sidebar .widget-title { letter-spacing: <?php echo esc_attr( $litho_product_widget_title_letter_spacing ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_title_text_transform ) : ?>
	/* Product Widget Title Text Transform */
	.litho-product-sidebar .widget-title { text-transform: <?php echo esc_attr( $litho_product_widget_title_text_transform ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_title_font_weight ) : ?>
	/* Product Widget Title Font Weight */
	.litho-product-sidebar .widget-title { font-weight: <?php echo esc_attr( $litho_product_widget_title_font_weight ); ?>}
<?php endif; ?>
<?php if ( $litho_product_widget_title_color ) : ?>
	/* Product Widget Title Color */
	.litho-product-sidebar .widget-title { color: <?php echo esc_attr( $litho_product_widget_title_color ); ?>}
<?php endif; ?>
/* End PRODUCT Widget Title Settings */
