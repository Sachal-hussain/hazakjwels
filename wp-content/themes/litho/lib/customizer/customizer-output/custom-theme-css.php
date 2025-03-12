<?php
/**
 * Generate css for theme base color.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_base_color = get_theme_mod( 'litho_base_color', '' );

if ( $litho_base_color ) {
	?>
	/* text color */
	body, a, a:active, a:focus, .newsletter-style-6 input, .newsletter-style-7 input, .mini-header-main-wrapper .litho-navigation-menu li a, .wpml-ls-legacy-dropdown .wpml-ls-flag+span, .wpml-ls-sidebars-litho-langauge-sidebar a, .elementor-widget-container .litho-top-cart-wrapper .cart_list li .product-detail .quantity, .elementor-widget-container .litho-top-cart-wrapper .cart_list li .product-detail .amount, .dropdown-menu.megamenu-content li a, .simple-dropdown .sub-menu a, .simple-dropdown .sub-menu li .handler, .litho-left-menu .sub-menu-item .sub-menu-item li a, .hamburger-menu-modern .litho-left-menu li ul li a, .feature-box-carousel-style-1 .elementor-swiper-button, .icon-box-carousel-content-box .icon-box-carousel .swiper-slide .elementor-icon-box-description, .grid-filter li a, .blog-grid-filter li a, .sidebar .social-icon-style-1 ul li a:hover i, .tagcloud a:hover, .tagcloud a.active, .single-post-main-section .litho-blog-blockquote blockquote .author-name, .sidebar table.wp-calendar-table caption, .elementor-widget table.wp-calendar-table caption, .porfolio-categories-lists .posted_in a:hover, .sidebar .widget_search input, .elementor-widget-sidebar .widget_search input, .elementor-widget-wp-widget-search .search-box input, .sidebar select, .elementor-widget-sidebar select, .elementor-widget select, .woocommerce .woocommerce-ordering select, .woocommerce ul.shop-product-list li.product .price, .woocommerce nav.woocommerce-pagination .page-numbers li .page-numbers, .woocommerce .widget_price_filter .price_slider_amount, .woocommerce .widget_rating_filter ul li a, .woocommerce div.product .product_meta .sku_wrapper .sku, .woocommerce div.product form.cart .variations select, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce a.remove, .woocommerce ul#shipping_method .amount, .select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected], .woocommerce table.shop_table.woocommerce-checkout-review-order-table tfoot .order-total .includes_tax .amount, #add_payment_method #payment div.payment_box, .woocommerce-cart #payment div.payment_box, .woocommerce-checkout #payment div.payment_box, .woocommerce-checkout .checkout.woocommerce-checkout .col-2 .woocommerce-shipping-fields h3, .woocommerce .woocommerce-MyAccount-content table.order_details tfoot td .includes_tax, .litho-pagination .page-numbers li .page-numbers, .page-links .inner-page-links .post-page-numbers, .feature-box .content, .tab-style-2 li a.nav-link span, .accordion-style-2 .panel-time, .accordion-style-2 .panel-speaker, .fancy-text-box-style-8 a, .icon-text-style-7 .elementor-button-wrapper .elementor-button, .scroll-top-arrow:hover, .footer-default-wrapper a, .sidebar select, .wp-block-pullquote, .wp-block-search .wp-block-search__label, .wp-block-search .wp-block-search__button, .has-primary-color, .wp-block-cover p.has-primary-color a, .wp-block-cover p.has-primary-color, .sidebar .wpml-ls-legacy-dropdown a, .sidebar .wpml-ls-legacy-dropdown a:hover, .sidebar .wpml-ls-legacy-dropdown .wpml-ls-item:hover a, .sidebar .wpml-ls-legacy-dropdown .wpml-ls-sub-menu li a { color: <?php echo esc_attr( $litho_base_color ); ?>; }
	<?php
}
