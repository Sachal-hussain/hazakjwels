<?php
/**
 * Theme register style and JS.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'litho_gutenberg_block_editor_assets' ) ) {
	/**
	 * Enqueue scripts and styles in gutenberg blog.
	 */
	function litho_gutenberg_block_editor_assets() {

		if ( litho_elementor_edit_mode() ) {
			/* Google Fonts */
			wp_enqueue_style( 'litho-google-font', litho_enqueue_fonts_url(), null, null ); // phpcs:ignore
		}
	}
}
add_action( 'enqueue_block_editor_assets', 'litho_gutenberg_block_editor_assets' );

if ( ! function_exists( 'litho_enqueue_style' ) ) {
	/**
	 * Enqueue google and adobe fonts.
	 */
	function litho_enqueue_style() {

		if ( litho_elementor_edit_mode() ) {
			/* Google Fonts */
			wp_enqueue_style( 'litho-google-font', litho_enqueue_fonts_url(), null, null ); // phpcs:ignore

			/* Adobe Fonts */
			wp_enqueue_style( 'litho-adobe-font', litho_enqueue_abobe_fonts_url(), null, null ); // phpcs:ignore
		}
	}
}
add_action( 'wp_enqueue_scripts', 'litho_enqueue_style', 99 );

if ( ! function_exists( 'litho_register_style_js' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function litho_register_style_js() {

		$litho_theme    = wp_get_theme();
		$script_details = litho_option( 'litho_disable_script_details', '' );
		$script_details = ! empty( $script_details ) ? explode( ',', $script_details ) : array();

		/**
		 * Load scripts and styles before all js/css libraries.
		 *
		 * @since 1.0
		 */
		do_action( 'litho_before_register_style_js' );

		wp_register_style(
			'bootstrap',
			get_theme_file_uri( 'assets/css/bootstrap.min.css' ),
			array(),
			'5.3.2'
		);
		wp_enqueue_style( 'bootstrap' );

		if ( litho_load_stylesheet_by_key( 'swiper' ) ) {

			if ( is_elementor_activated() ) {
				wp_deregister_style( 'swiper' );
				wp_dequeue_style( 'swiper' );
			}

			wp_register_style(
				'swiper',
				get_theme_file_uri( 'assets/css/swiper.min.css' ),
				array(),
				'8.4.7'
			);
			wp_enqueue_style( 'swiper' );
		}

		if ( litho_load_stylesheet_by_key( 'et-line-icons' ) ) {
			wp_register_style(
				'et-line-icons',
				get_theme_file_uri( 'assets/css/et-line-icons.css' ),
				array(),
				$litho_theme->get( 'Version' )
			);
			wp_enqueue_style( 'et-line-icons' );
		}

		if ( litho_load_stylesheet_by_key( 'iconsmind-line-icons' ) ) {
			wp_register_style(
				'iconsmind-line-icons',
				get_theme_file_uri( 'assets/css/iconsmind-line.css' ),
				array(),
				$litho_theme->get( 'Version' )
			);
			wp_enqueue_style( 'iconsmind-line-icons' );
		}

		if ( litho_load_stylesheet_by_key( 'iconsmind-solid-icons' ) ) {
			wp_register_style(
				'iconsmind-solid-icons',
				get_theme_file_uri( 'assets/css/iconsmind-solid.css' ),
				array(),
				$litho_theme->get( 'Version' )
			);
			wp_enqueue_style( 'iconsmind-solid-icons' );
		}

		if ( litho_load_stylesheet_by_key( 'simple-line-icons' ) ) {
			wp_register_style(
				'simple-line-icons',
				get_theme_file_uri( 'assets/css/simple-line-icons.css' ),
				array(),
				$litho_theme->get( 'Version' )
			);
			wp_enqueue_style( 'simple-line-icons' );
		}

		if ( litho_load_stylesheet_by_key( 'themify-icons' ) ) {
			wp_register_style(
				'themify-icons',
				get_theme_file_uri( 'assets/css/themify-icons.css' ),
				array(),
				$litho_theme->get( 'Version' )
			);
			wp_enqueue_style( 'themify-icons' );
		}

		if ( litho_load_stylesheet_by_key( 'feather-icons' ) ) {
			wp_register_style(
				'feather-icons',
				get_theme_file_uri( 'assets/css/feather-icons.css' ),
				array(),
				$litho_theme->get( 'Version' )
			);
			wp_enqueue_style( 'feather-icons' );
		}

		if ( litho_load_stylesheet_by_key( 'font-awesome' ) ) {
			wp_register_style(
				'font-awesome',
				get_theme_file_uri( 'assets/css/font-awesome.min.css' ),
				array(),
				'6.5.2'
			);

			if ( ! is_elementor_activated() ) {

				wp_enqueue_style( 'font-awesome1' );

			} else {
				// Elementor's Enqueue Style.
				wp_enqueue_style( 'elementor-icons-fa-regular' );
				wp_enqueue_style( 'elementor-icons-fa-brands' );
				wp_enqueue_style( 'elementor-icons-fa-solid' );
			}
		}

		if ( litho_load_stylesheet_by_key( 'justified-gallery' ) ) {
			wp_register_style(
				'justified-gallery',
				get_theme_file_uri( 'assets/css/justified-gallery.min.css' ),
				array(),
				'3.8.1'
			);
			wp_enqueue_style( 'justified-gallery' );
		}

		if ( litho_load_stylesheet_by_key( 'mCustomScrollbar' ) ) {
			wp_register_style(
				'mCustomScrollbar',
				get_theme_file_uri( 'assets/css/jquery.mCustomScrollbar.min.css' ),
				array(),
				'3.1.5'
			);
			wp_enqueue_style( 'mCustomScrollbar' );
		}

		if ( litho_load_stylesheet_by_key( 'magnific-popup' ) ) {
			wp_register_style(
				'magnific-popup',
				get_theme_file_uri( 'assets/css/magnific-popup.css' ),
				array(),
				'1.1.0'
			);
			wp_enqueue_style( 'magnific-popup' );
		}

		/*
		 * Load Litho theme main and other required jquery files.
		 */

		/* To hide/show page scrolling effect */
		$litho_enable_page_scrolling_effect = get_theme_mod( 'litho_enable_page_scrolling_effect', '0' );

		wp_register_script(
			'bootstrap-bundle',
			get_theme_file_uri( 'assets/js/bootstrap.bundle.min.js' ),
			array( 'jquery' ),
			'5.3.2',
			true
		);
		wp_enqueue_script( 'bootstrap-bundle' );

		if ( litho_load_javascript_by_key( 'smooth-scroll' ) ) {
			wp_register_script(
				'smooth-scroll',
				get_theme_file_uri( 'assets/js/smooth-scroll.js' ),
				array( 'jquery' ),
				'2.2.0',
				true
			);
			wp_enqueue_script( 'smooth-scroll' );
		}

		wp_register_script(
			'custom-parallax',
			get_theme_file_uri( 'assets/js/custom-parallax.js' ),
			array( 'jquery' ),
			$litho_theme->get( 'Version' ),
			true
		);
		wp_enqueue_script( 'custom-parallax' );

		if ( litho_load_javascript_by_key( 'swiper' ) ) {
			wp_register_script(
				'swiper',
				get_theme_file_uri( 'assets/js/swiper-bundle.min.js' ),
				array(),
				'8.4.7',
				true
			);
			wp_enqueue_script( 'swiper' );
		}

		if ( litho_load_javascript_by_key( 'justified-gallery' ) ) {
			wp_register_script(
				'justified-gallery',
				get_theme_file_uri( 'assets/js/justified-gallery.min.js' ),
				array(),
				'3.8.1',
				true
			);
			wp_enqueue_script( 'justified-gallery' );
		}

		wp_register_script(
			'jquery.easing',
			get_theme_file_uri( 'assets/js/jquery.easing.1.3.js' ),
			array( 'jquery' ),
			'1.3',
			true
		);
		wp_enqueue_script( 'jquery.easing' );

		if ( litho_load_javascript_by_key( 'jquery-appear' ) ) {
			wp_register_script(
				'jquery.appear',
				get_theme_file_uri( 'assets/js/jquery.appear.js' ),
				array( 'jquery' ),
				'0.6.2',
				true
			);
			wp_enqueue_script( 'jquery.appear' );
		}

		if ( litho_load_javascript_by_key( 'imagesloaded' ) ) {
			wp_register_script(
				'imagesloaded',
				get_theme_file_uri( 'assets/js/imagesloaded.pkgd.min.js' ),
				array( 'jquery' ),
				'4.1.4',
				true
			);
			wp_enqueue_script( 'imagesloaded' );
		}

		if ( litho_load_javascript_by_key( 'isotope' ) ) {
			wp_register_script(
				'isotope',
				get_theme_file_uri( 'assets/js/isotope.pkgd.min.js' ),
				array( 'jquery' ),
				'3.0.6',
				true
			);
			wp_enqueue_script( 'isotope' );
		}

		if ( litho_load_javascript_by_key( 'easypiechart' ) ) {
			wp_register_script(
				'easypiechart',
				get_theme_file_uri( 'assets/js/jquery.easypiechart.min.js' ),
				array( 'jquery' ),
				'2.1.7',
				true
			);
			wp_enqueue_script( 'easypiechart' );
		}

		if ( litho_load_javascript_by_key( 'infinite-scroll' ) ) {
			wp_register_script(
				'infinite-scroll',
				get_theme_file_uri( 'assets/js/infinite-scroll.pkgd.min.js' ),
				array( 'jquery' ),
				'4.0.1',
				true
			);
			wp_enqueue_script( 'infinite-scroll' );
		}

		if ( litho_load_javascript_by_key( 'jquery-countdown' ) ) {
			wp_register_script(
				'jquery.countdown',
				get_theme_file_uri( 'assets/js/jquery.countdown.min.js' ),
				array( 'jquery' ),
				'2.2.0',
				true
			);
			wp_enqueue_script( 'jquery.countdown' );
		}

		if ( litho_load_javascript_by_key( 'sticky-kit' ) ) {
			wp_register_script(
				'sticky-kit',
				get_theme_file_uri( 'assets/js/jquery.sticky-kit.min.js' ),
				array( 'jquery' ),
				'1.1.3',
				true
			);
			wp_enqueue_script( 'sticky-kit' );
		}

		if ( litho_load_javascript_by_key( 'tilt' ) ) {
			wp_register_script(
				'tilt',
				get_theme_file_uri( 'assets/js/tilt.min.js' ),
				array( 'jquery' ),
				'1.2.1',
				true
			);
			wp_enqueue_script( 'tilt' );
		}

		if ( litho_load_javascript_by_key( 'mCustomScrollbar' ) ) {
			wp_register_script(
				'mCustomScrollbar',
				get_theme_file_uri( 'assets/js/jquery.mCustomScrollbar.concat.min.js' ),
				array( 'jquery' ),
				'3.1.5',
				true
			);
			wp_enqueue_script( 'mCustomScrollbar' );
		}

		if ( litho_load_javascript_by_key( 'fitvids' ) ) {
			wp_register_script(
				'fitvids',
				get_theme_file_uri( 'assets/js/jquery.fitvids.js' ),
				array( 'jquery' ),
				'1.1',
				true
			);
			wp_enqueue_script( 'fitvids' );
		}

		wp_register_script(
			'retina',
			get_theme_file_uri( 'assets/js/retina.min.js' ),
			array( 'jquery' ),
			'1.3.0',
			true
		);
		wp_enqueue_script( 'retina' );

		if ( litho_load_javascript_by_key( 'magnific-popup' ) ) {
			wp_register_script(
				'magnific-popup',
				get_theme_file_uri( 'assets/js/jquery.magnific-popup.min.js' ),
				array( 'jquery' ),
				'1.1.0',
				true
			);
			wp_enqueue_script( 'magnific-popup' );
		}

		if ( litho_load_javascript_by_key( 'page-scroll' ) && 1 == $litho_enable_page_scrolling_effect ) {
			wp_register_script(
				'page-scroll',
				get_theme_file_uri( 'assets/js/page-scroll.js' ),
				array( 'jquery' ),
				'1.4.9',
				true
			);
			wp_enqueue_script( 'page-scroll' );
		}

		wp_register_script(
			'litho-main',
			get_theme_file_uri( 'assets/js/main.js' ),
			array( 'jquery' ),
			$litho_theme->get( 'Version' ),
			true
		);
		wp_enqueue_script( 'litho-main' );

		// Promo Popup options.
		$litho_enable_promo_popup = get_theme_mod( 'litho_enable_promo_popup', '0' );
		/**
		 * Apply filters for enable or disable promo popup.
		 *
		 * @since 1.0
		 */
		$litho_enable_promo_popup        = apply_filters( 'litho_enable_promo_popup', $litho_enable_promo_popup );
		$litho_promo_popup_section       = get_theme_mod( 'litho_promo_popup_section', '' );
		$litho_display_promo_popup_after = litho_post_meta_by_id( $litho_promo_popup_section, 'litho_display_promo_popup_after' );
		$litho_display_promo_popup_after = ( ! empty( $litho_display_promo_popup_after ) ) ? $litho_display_promo_popup_after : 'some-time';
		$litho_delay_time_promo_popup    = litho_post_meta_by_id( $litho_promo_popup_section, 'litho_delay_time_promo_popup' );
		$litho_delay_time_promo_popup    = ( ! empty( $litho_delay_time_promo_popup ) ) ? $litho_delay_time_promo_popup : '100';
		$litho_scroll_promo_popup        = litho_post_meta_by_id( $litho_promo_popup_section, 'litho_scroll_promo_popup' );
		$litho_scroll_promo_popup        = ( ! empty( $litho_scroll_promo_popup ) ) ? $litho_scroll_promo_popup : '500';
		$litho_enable_mobile_promo_popup = litho_post_meta_by_id( $litho_promo_popup_section, 'litho_enable_mobile_promo_popup' );
		$litho_promo_popup_cokkie_expire = litho_post_meta_by_id( $litho_promo_popup_section, 'litho_promo_popup_cokkie_expire' );
		$litho_promo_popup_cokkie_expire = ( ! empty( $litho_promo_popup_cokkie_expire ) ) ? $litho_promo_popup_cokkie_expire : '7';

		if ( 1 == $litho_enable_promo_popup && ! empty( $litho_promo_popup_section ) ) {
			wp_register_script(
				'promo-popup',
				get_theme_file_uri( 'assets/js/promo-popup.js' ),
				array( 'jquery' ),
				$litho_theme->get( 'Version' ),
				true
			);
		}

		wp_localize_script(
			'litho-main',
			'LithoMain',
			array(
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'site_id'                   => ( is_multisite() ) ? '-' . get_current_blog_id() : '',
				'disable_scripts'           => $script_details,
				// assets/js/promo-popup.js.
				'enable_promo_popup'        => $litho_enable_promo_popup,
				'display_promo_popup_after' => $litho_display_promo_popup_after,
				'delay_time_promo_popup'    => $litho_delay_time_promo_popup,
				'scroll_promo_popup'        => $litho_scroll_promo_popup,
				'expired_days_promo_popup'  => $litho_promo_popup_cokkie_expire,
				'enable_mobile_promo_popup' => $litho_enable_mobile_promo_popup,
			)
		);

		if ( is_singular() && ( comments_open() || get_comments_number() ) && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'litho_register_style_js' );

if ( ! function_exists( 'litho_enqueue_main_style' ) ) :
	/**
	 * Enqueue Main & Responsive style.
	 */
	function litho_enqueue_main_style() {

		$litho_theme = wp_get_theme();

		$dependency_css = array();
		if ( is_litho_addons_activated() && is_elementor_activated() ) {
			$dependency_css[] = 'elementor-frontend';
			$dependency_css[] = 'litho-addons-frontend';
		}

		wp_register_style(
			'litho-style',
			get_template_directory_uri() . '/style.css',
			$dependency_css,
			$litho_theme->get( 'Version' )
		);
		wp_register_style(
			'litho-responsive',
			get_theme_file_uri( 'assets/css/responsive.css' ),
			array( 'litho-style' ),
			$litho_theme->get( 'Version' )
		);

		/* Main & Responsive style */
		wp_enqueue_style( 'litho-style' );
		wp_enqueue_style( 'litho-responsive' );
		wp_style_add_data( 'litho-style', 'rtl', 'replace' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'litho_enqueue_main_style', 11 );

if ( ! function_exists( 'litho_enqueue_custom_style' ) ) {
	/**
	 * Enqueue Custom css base on customizer settings
	 */
	function litho_enqueue_custom_style() {

		$output_css = '';
		ob_start();

		// custom css.
		if ( file_exists( LITHO_THEME_CUSTOMIZER . '/customizer-output/custom-css.php' ) ) {
			require_once LITHO_THEME_CUSTOMIZER . '/customizer-output/custom-css.php';
		}
		// For sidebar css.
		if ( file_exists( LITHO_THEME_CUSTOMIZER . '/customizer-output/sidebar-custom-css.php' ) ) {
			require_once LITHO_THEME_CUSTOMIZER . '/customizer-output/sidebar-custom-css.php';
		}
		// For custom theme css.
		if ( file_exists( LITHO_THEME_CUSTOMIZER . '/customizer-output/custom-theme-css.php' ) ) {
			require_once LITHO_THEME_CUSTOMIZER . '/customizer-output/custom-theme-css.php';
		}
		// For custom theme mobilebreakpoint css.
		if ( file_exists( LITHO_THEME_CUSTOMIZER . '/customizer-output/custom-mobilebreakpoint-css.php' ) ) {
			require_once LITHO_THEME_CUSTOMIZER . '/customizer-output/custom-mobilebreakpoint-css.php';
		}

		$output_css = ob_get_contents();
		ob_end_clean();

		/**
		 * Apply filters for custom css so user can add its own custom css.
		 *
		 * @since 1.0
		 */
		$output_css = apply_filters( 'litho_inline_custom_css', $output_css );

		// 1. Remove comments.
		// 2. Remove whitespace.
		// 3. Remove starting whitespace.
		$output_css = preg_replace( '#/\*.*?\*/#s', '', $output_css );
		$output_css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $output_css );
		$output_css = preg_replace( '/\s\s+(.*)/', '$1', $output_css );

		/**
		 * Apply filters for custom css after minified so user can add its own custom css.
		 *
		 * @since 1.0
		 */
		$output_css = apply_filters( 'litho_inline_custom_css_after_minified', $output_css );
		wp_add_inline_style( 'litho-responsive', $output_css );

		/* Check Header Image */
		$header_image = get_header_image();

		if ( ! empty( $header_image ) ) {
			$litho_header_image_css = ".header-img { background-image: url( " . esc_url( $header_image ) . " ); background-repeat: no-repeat !important; background-position: 50% 50% !important; -webkit-background-size: cover !important; -moz-background-size: cover !important; -o-background-size: cover !important; background-size: cover !important; }"; // phpcs:ignore.

			wp_add_inline_style( 'litho-responsive', $litho_header_image_css );
		}

		if ( is_litho_addons_activated() && is_elementor_activated() && ! litho_elementor_edit_mode() ) {

			$default_heading_typography = '.alt-font, .sidebar .widget h2, .sidebar .widget.widget_search label, .editor-post-title__block .editor-post-title__input, .litho-button-wrapper .elementor-button, .elementor-widget-litho-button a.elementor-button, .btn, [type=submit], .wp-block-search .wp-block-search__button, input[type="submit"], .elementor-button-wrapper a.elementor-button, .elementor-widget-container .litho-top-cart-wrapper .buttons a, footer .elementor-widget-litho-simple-navigation .title, footer .elementor-widget-wp-widget-litho_recent_post_widget h5, .swiper-number-pagination, .woocommerce ul.shop-product-list li.product .button, .woocommerce ul.shop-product-list li.product .added_to_cart, .woocommerce div.product .product_title, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs .panel h2, .woocommerce-page .cart-collaterals .cart_totals h2, .woocommerce .related > h2, .woocommerce .up-sells > h2, .woocommerce .cross-sells > h2, .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta .woocommerce-review__author, .woocommerce table.shop_table th, .woocommerce-cart .cart-collaterals .cart_totals h2, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce form.checkout_coupon .button, .woocommerce form.login .lost_password a, .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-page h3, .woocommerce-checkout .woocommerce h3, .woocommerce-order-details .woocommerce-order-details__title, .woocommerce-account .woocommerce h2, .woocommerce-page legend, .woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before, .woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before, .woocommerce-Reviews .comment-reply-title, .woocommerce .wc-block-components-notice-banner {
				font-family: var( --e-global-typography-primary-font-family ), Sans-serif;
				font-weight: var( --e-global-typography-primary-font-weight ); }';

			wp_add_inline_style( 'litho-responsive', $default_heading_typography );

			$default_body_typography = '.main-font, body {
				font-family: var( --e-global-typography-text-font-family ), Sans-serif;
				font-weight: var( --e-global-typography-text-font-weight ); }';
			wp_add_inline_style( 'litho-responsive', $default_body_typography );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'litho_enqueue_custom_style', 999 );

if ( ! function_exists( 'litho_customizer_scripts_preview' ) ) {
	/**
	 * Load theme customizer script.
	 */
	function litho_customizer_scripts_preview() {

		$litho_theme = wp_get_theme();

		wp_register_script(
			'litho-customizer-preview',
			get_theme_file_uri( 'assets/js/admin/customizer-preview.js' ),
			array( 'jquery', 'customize-preview' ),
			$litho_theme->get( 'Version' ),
			false
		);

		wp_enqueue_script( 'litho-customizer-preview' );
	}
}
add_action( 'customize_preview_init', 'litho_customizer_scripts_preview' );

if ( ! function_exists( 'litho_admin_custom_scripts' ) ) {
	/**
	 * Load theme admin css and script.
	 */
	function litho_admin_custom_scripts() {

		$litho_theme = wp_get_theme();

		wp_register_style(
			'font-awesome',
			get_theme_file_uri( 'assets/css/font-awesome.min.css' ),
			array(),
			'6.5.2'
		);
		wp_register_style(
			'et-line-icons',
			get_theme_file_uri( 'assets/css/et-line-icons.css' ),
			array(),
			$litho_theme->get( 'Version' )
		);
		wp_register_style(
			'themify-icons',
			get_theme_file_uri( 'assets/css/themify-icons.css' ),
			array(),
			$litho_theme->get( 'Version' )
		);

		// common admin side CSS.
		wp_register_style(
			'litho-custom-admin',
			get_theme_file_uri( 'assets/css/admin/litho-custom-admin.css' ),
			array(),
			$litho_theme->get( 'Version' )
		);

		wp_register_style(
			'litho-import',
			get_theme_file_uri( 'assets/css/admin/import.css' ),
			array(),
			$litho_theme->get( 'Version' )
		);

		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'et-line-icons' );
		wp_enqueue_style( 'themify-icons' );
		wp_enqueue_style( 'litho-custom-admin' );
		wp_enqueue_style( 'litho-import' );

		// common admin side JS.
		wp_register_script(
			'litho-custom-admin',
			get_theme_file_uri( 'assets/js/admin/custom-admin.js' ),
			array( 'jquery' ),
			$litho_theme->get( 'Version' ),
			true
		);
		wp_enqueue_script( 'litho-custom-admin' );

		wp_localize_script(
			'litho-custom-admin',
			'LithoCustomAdmin',
			array(
				'empty_purchase_code' => esc_html__( 'Please enter your purchase code.', 'litho' ),
				'confirm_deactivate'  => esc_html__( 'Are you sure to deactivate Litho license? This may break your existing website.', 'litho' ),
			)
		);

		wp_register_script(
			'litho-customizer-controls',
			get_theme_file_uri( 'assets/js/admin/customizer-controls.js' ),
			array( 'jquery', 'wp-util' ),
			$litho_theme->get( 'Version' ),
			true
		);

		wp_enqueue_script( 'wp-util' );
		wp_enqueue_script( 'litho-customizer-controls' );

		wp_localize_script(
			'litho-customizer-controls',
			'LithoCustomizer',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'i18n'    => array(
					'error_message' => esc_html__( 'Please Enter Font Family name first!', 'litho' ),
				),
			)
		);
	}
}
add_action( 'admin_enqueue_scripts', 'litho_admin_custom_scripts' );
