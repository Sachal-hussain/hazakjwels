<?php
/**
 * Adds options to the customizer
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Customizer` doesn't exists yet.
if ( ! class_exists( 'Litho_Customizer' ) ) {
	/**
	 * Main Customizer class
	 */
	class Litho_Customizer {
		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'litho_add_customizer_sections' ), 10 );
			add_action( 'customize_register', array( $this, 'litho_register_options_settings_and_controls' ), 20 );
			add_action( 'customize_controls_print_scripts', array( $this, 'litho_print_repeater_template' ) );
		}
		/**
		 * Add customizer sections
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function litho_add_customizer_sections( $wp_customize ) {

			/* Logo and Favicon Panels */
			$wp_customize->add_section(
				'litho_add_logo_favicon_panel',
				array(
					'title'      => esc_html__( 'Logo and Favicon', 'litho' ),
					'capability' => 'manage_options',
					'priority'   => 125,
				)
			);

			/* Header and Footer Panel */
			$wp_customize->add_panel(
				'litho_builder_panel',
				array(
					'title'      => esc_html__( 'Header and Footer', 'litho' ),
					'capability' => 'manage_options',
					'priority'   => 130,
				)
			);

			/* Add Mini Header Settings*/
			$wp_customize->add_section(
				'litho_add_mini_header_section',
				array(
					'title'      => esc_html__( 'Mini Header', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_builder_panel',
				)
			);

			/* Add Header Settings*/
			$wp_customize->add_section(
				'litho_add_header_section',
				array(
					'title'      => esc_html__( 'Header', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_builder_panel',
				)
			);

			/* Add Footer Settings*/
			$wp_customize->add_section(
				'litho_add_footer_section',
				array(
					'title'      => esc_html__( 'Footer', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_builder_panel',
				)
			);

			/* Add Layout and Content Settings page */
			$wp_customize->add_panel(
				'litho_post_layout_setting_archive_panel',
				array(
					'title'      => esc_html__( 'Layout and Content', 'litho' ),
					'capability' => 'manage_options',
					'priority'   => 135,
				)
			);

			/* Add Page Layout */
			$wp_customize->add_section(
				'litho_add_page_layout_panel',
				array(
					'title'      => esc_html__( 'Page', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_post_layout_setting_archive_panel',
				)
			);

			/* Add Post Single Layout */
			$wp_customize->add_section(
				'litho_add_post_layout_panel',
				array(
					'title'      => esc_html__( 'Post Single', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_post_layout_setting_archive_panel',
				)
			);

			/* Add Archive Layout */
			$wp_customize->add_section(
				'litho_add_archive_layout_panel',
				array(
					'title'      => esc_html__( 'Post Archive', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_post_layout_setting_archive_panel',
				)
			);

			/* Add Default Posts / Blog Home Layout */
			$wp_customize->add_section(
				'litho_add_default_layout_panel',
				array(
					'title'      => esc_html__( 'Default Posts / Blog Home', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_post_layout_setting_archive_panel',
				)
			);

			/* Add Sticky Posts Layout */
			$wp_customize->add_section(
				'litho_add_sticky_layout_panel',
				array(
					'title'      => esc_html__( 'Sticky Post', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_post_layout_setting_archive_panel',
				)
			);

			if ( is_litho_addons_activated() ) {
				/* Add Portfolio Single Layout */
				$wp_customize->add_section(
					'litho_add_portfolio_layout_panel',
					array(
						'title'      => esc_html__( 'Portfolio Single', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_post_layout_setting_archive_panel',
					)
				);

				/* Add Portfolio Archive Layout */
				$wp_customize->add_section(
					'litho_add_portfolio_archive_layout_panel',
					array(
						'title'      => esc_html__( 'Portfolio Archive', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_post_layout_setting_archive_panel',
					)
				);

				/* Add Page Title */
				$wp_customize->add_section(
					'litho_add_page_title_section',
					array(
						'title'      => esc_html__( 'Title Wrapper', 'litho' ),
						'capability' => 'manage_options',
						'priority'   => 140,
					)
				);
			}

			/* General Panels */
			$wp_customize->add_panel(
				'litho_add_general_panel',
				array(
					'title'      => esc_html__( 'General Theme Options', 'litho' ),
					'capability' => 'manage_options',
					'priority'   => 145,
				)
			);

			/* Add 404 page Layout */
			$wp_customize->add_section(
				'litho_add_404_page_panel',
				array(
					'title'      => esc_html__( '404 Page', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Add scroll to top Layout */
			$wp_customize->add_section(
				'litho_add_scroll_to_top_panel',
				array(
					'title'      => esc_html__( 'Scroll to Top', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Add Custom Sidebars Layout */
			$wp_customize->add_section(
				'litho_add_search_block_panel',
				array(
					'title'      => esc_html__( 'Search Page Settings', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Add gdpr cookie block Layout */
			$wp_customize->add_section(
				'litho_add_gdpr_block_panel',
				array(
					'title'      => esc_html__( 'GDPR Settings', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Add General setting Layout */
			$wp_customize->add_section(
				'litho_add_general_settings_panel',
				array(
					'title'      => esc_html__( 'Image Meta Data', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Add Disable Styles & Scripts */
			$wp_customize->add_section(
				'litho_add_disable_style_script_panel',
				array(
					'title'      => esc_html__( 'Disable Styles & Scripts', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Add Custom Sidebars Layout */
			$wp_customize->add_section(
				'litho_add_custom_sidebars_panel',
				array(
					'title'      => esc_html__( 'Custom Sidebars', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			if ( is_litho_addons_activated() ) {

				/* Add Side Icon Layout */
				$wp_customize->add_section(
					'litho_add_side_icon_panel',
					array(
						'title'      => esc_html__( 'Side Icon', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_general_panel',
					)
				);

				/* Add Promo popup Layout */
				$wp_customize->add_section(
					'litho_add_promo_popup_panel',
					array(
						'title'      => esc_html__( 'Promo Popup', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_general_panel',
					)
				);

				/* Add Portfolio URL Slug */
				$wp_customize->add_section(
					'litho_add_portfolio_url_slug_panel',
					array(
						'title'      => esc_html__( 'Portfolio URL Slug', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_general_panel',
					)
				);

				/* Add Elementor Settings Panel */
				$wp_customize->add_section(
					'litho_add_elementor_template_library_panel',
					array(
						'title'      => esc_html__( 'Elementor Settings', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_general_panel',
					)
				);
			}

			/* Add Preloader settings panel */
			$wp_customize->add_section(
				'litho_preloader_settings_panel',
				array(
					'title'      => esc_html__( 'Preloader Settings', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Add General setting Layout */
			$wp_customize->add_section(
				'litho_other_settings_panel',
				array(
					'title'      => esc_html__( 'Other Settings', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_general_panel',
				)
			);

			/* Typography Panel */
			$wp_customize->add_panel(
				'litho_typography_panel',
				array(
					'title'      => esc_html__( 'Typography and Color', 'litho' ),
					'capability' => 'manage_options',
					'priority'   => 150,
				)
			);

			/* Add Font Family Settings*/
			$wp_customize->add_section(
				'litho_add_general_font_family_section',
				array(
					'title'      => esc_html__( 'Font Family', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_typography_panel',
				)
			);

			/* Add Font Size Settings*/
			$wp_customize->add_section(
				'litho_add_general_color_section',
				array(
					'title'      => esc_html__( 'Font Size', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_typography_panel',
				)
			);

			/* Add Content Color Settings */
			$wp_customize->add_section(
				'litho__add_content_color_section',
				array(
					'title'      => esc_html__( 'Font Color', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_typography_panel',
				)
			);

			/* Add Comment Settings*/
			$wp_customize->add_section(
				'litho_add_comment_color_section',
				array(
					'title'      => esc_html__( 'Comment', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_typography_panel',
				)
			);

			/* Add Heading Color Settings*/
			$wp_customize->add_section(
				'litho_add_heading_color_section',
				array(
					'title'      => esc_html__( 'Heading', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_typography_panel',
				)
			);

			/* Add Base Color Settings*/
			$wp_customize->add_section(
				'litho_add_base_color_section',
				array(
					'title'      => esc_html__( 'Base Color', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_typography_panel',
				)
			);

			/* Add Address Bar Color Settings*/
			$wp_customize->add_section(
				'litho_add_addressbar_color_section',
				array(
					'title'      => esc_html__( 'Address Bar Color', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_typography_panel',
				)
			);

			// Add Social Icons Switch Sections.
			$wp_customize->add_panel(
				'litho_add_social_share_panel',
				array(
					'title'      => esc_html__( 'Social Share', 'litho' ),
					'capability' => 'manage_options',
				)
			);

			// Add Social Icons Post Panel.
			$wp_customize->add_section(
				'litho_add_social_share_section',
				array(
					'title'      => esc_html__( 'Post Single', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_social_share_panel',
				)
			);

			if ( is_litho_addons_activated() ) {
				// Add Social Icons Portfolio Panel.
				$wp_customize->add_section(
					'litho_portfolio_add_social_share_section',
					array(
						'title'      => esc_html__( 'Portfolio Single', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_social_share_panel',
					)
				);
			}
			/* Add Page Sidebar settings Panel */
			$wp_customize->add_panel(
				'litho_add_sidebar_settings_panel',
				array(
					'title'      => esc_html__( 'Sidebar Settings', 'litho' ),
					'capability' => 'manage_options',
					'priority'   => 145,
				)
			);

			/* Add Post Sidebar section */
			$wp_customize->add_section(
				'litho_add_post_sidebar_section',
				array(
					'title'      => esc_html__( 'Post', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_sidebar_settings_panel',
				)
			);

			/* Add Page Sidebar section */
			$wp_customize->add_section(
				'litho_add_page_sidebar_section',
				array(
					'title'      => esc_html__( 'Page', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_add_sidebar_settings_panel',
				)
			);

			if ( is_litho_addons_activated() ) {
				/* Add Portfolio Sidebar section */
				$wp_customize->add_section(
					'litho_add_portfolio_sidebar_section',
					array(
						'title'      => esc_html__( 'Portfolio', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_sidebar_settings_panel',
					)
				);
			}

			if ( is_woocommerce_activated() ) {

				/* Add Product Single Layout */
				$wp_customize->add_section(
					'litho_add_product_layout_panel',
					array(
						'title'      => esc_html__( 'Product Single', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_post_layout_setting_archive_panel',
					)
				);

				/* Add Product Archive Layout */
				$wp_customize->add_section(
					'litho_add_product_archive_layout_panel',
					array(
						'title'      => esc_html__( 'Product Archive / Shop', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_post_layout_setting_archive_panel',
					)
				);

				// Add Social Icons Product Panel.
				$wp_customize->add_section(
					'litho_product_add_social_share_section',
					array(
						'title'      => esc_html__( 'Product Single', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_social_share_panel',
					)
				);
				/* Add Product Sidebar section */
				$wp_customize->add_section(
					'litho_add_product_sidebar_section',
					array(
						'title'      => esc_html__( 'Product', 'litho' ),
						'capability' => 'manage_options',
						'panel'      => 'litho_add_sidebar_settings_panel',
					)
				);
			}

			/* Add Box Layout */
			$wp_customize->add_section(
				'litho_add_box_layout_panel',
				array(
					'title'      => esc_html__( 'Box Layout', 'litho' ),
					'capability' => 'manage_options',
					'panel'      => 'litho_post_layout_setting_archive_panel',
				)
			);
		}

		/**
		 * Register option settings To Customizer
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function litho_register_options_settings_and_controls( $wp_customize ) {

			/* Customize controls */
			$litho_customizer_controls_array = array(
				'font-weight',
				'multiple-images',
				'alpha-color-picker',
				'custom-sidebars',
				'multi-checkbox',
				'custom-controls',
				'select-optgroup',
				'fonts-custom',
				'post-social-share-icon',
			);

			if ( ! empty( $litho_customizer_controls_array ) ) {
				foreach ( $litho_customizer_controls_array as $value ) {
					if ( file_exists( LITHO_THEME_CUSTOMIZER_CONTROLS . '/' . $value . '.php' ) ) {
						require_once LITHO_THEME_CUSTOMIZER_CONTROLS . '/' . $value . '.php';
					}
				}
			}

			/* Register Post Layout Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/layout-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/layout-settings.php';
			}

			/* Register Single Post Layout Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/single-post-layout-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/single-post-layout-settings.php';
			}

			/* Register Post Archive Layout Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/post-archive-layout-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/post-archive-layout-settings.php';
			}

			/* Register Default Post Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/default-layout-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/default-layout-settings.php';
			}

			/* Register Sticky Post Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/sticky-layout-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/sticky-layout-settings.php';
			}

			/* Register Box Layout Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/box-layout.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/box-layout.php';
			}

			/* Register General Separator title Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/general-separator-title.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/general-separator-title.php';
			}

			/* Register 404 page Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/page-not-found-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/page-not-found-settings.php';
			}

			/* Register Side Icon Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/side-icon-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/side-icon-settings.php';
			}

			/* Register General Theme Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/general-layout-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/general-layout-settings.php';
			}

			/* Register Post/Portfolio/Product Social Share Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/post-social-share/post-social-share-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/post-social-share/post-social-share-settings.php';
			}

			/* Register Post Sidebar Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/post-sidebar-setting.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/post-sidebar-setting.php';
			}
			/* Register Page Sidebar Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/page-sidebar-setting.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/page-sidebar-setting.php';
			}

			/* Register Logo and Favicon Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/logo-and-favicon/logo-favicon-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/logo-and-favicon/logo-favicon-settings.php';
			}

			/* Register Custom Font Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/font-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/font-settings.php';
			}

			/* Register Custom Font Size & Color Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/custom-color-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/custom-color-settings.php';
			}

			/* Register Comment Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/comment-color-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/comment-color-settings.php';
			}

			/* Register Heading Color Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/heading-color-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/heading-color-settings.php';
			}

			/* Register Base Color Settings */
			if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/base-color-settings.php' ) ) {
				require_once LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/base-color-settings.php';
			}

			if ( is_litho_addons_activated() ) {

				/* Register Address Bar Color Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/addressbar-color-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/typography-and-color/addressbar-color-settings.php';
				}
				/* Register Single Portfolio Layout Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/single-portfolio-layout-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/single-portfolio-layout-settings.php';
				}
				/* Register Portfolio Archive Layout Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/portfolio-archive-layout-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/layout-and-content/portfolio-archive-layout-settings.php';
				}
				/* Register Portfolio Sidebar Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/portfolio-sidebar-setting.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/portfolio-sidebar-setting.php';
				}
				/* Register Page Title Setting */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/title-wrapper/page-title-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/title-wrapper/page-title-settings.php';
				}
				/* Register Promo popup Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/promo-popup-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/promo-popup-settings.php';
				}
				/* Register Elementor Template Library Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/elementor-template-library-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/general-theme-options/elementor-template-library-settings.php';
				}
				/* Register Mini Header Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/mini-header-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/mini-header-settings.php';
				}
				/* Register Header and Footer Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/header-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/header-settings.php';
				}
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/footer-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/footer-settings.php';
				}
			} else {

				/* Register Default Header Setting */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/default-header-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/default-header-settings.php';
				}
				/* Register Default Footer Setting */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/default-footer-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/section-builder/default-footer-settings.php';
				}
			}

			if ( is_woocommerce_activated() ) {

				/* Register Single Product Layout Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/woocommerce/woocommerce-single-product-layout-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/woocommerce/woocommerce-single-product-layout-settings.php';
				}

				/* Register Product Archive Layout Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/woocommerce/woocommerce-product-archive-layout-settings.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/woocommerce/woocommerce-product-archive-layout-settings.php';
				}

				/* Register Product Sidebar Settings */
				if ( file_exists( LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/product-sidebar-setting.php' ) ) {
					require_once LITHO_THEME_CUSTOMIZER_MAPS . '/sidebar-setting/product-sidebar-setting.php';
				}
			}
		}

		/**
		 * Custom fonts templates
		 */
		public function litho_print_repeater_template() {
			?>
			<script type="text/template" id="tmpl-litho-custom-font-repeater">
				<ul class="custom-font">
					<li>
						<label><?php esc_html_e( 'Font Family', 'litho' ); ?></label>
						<input type="text" class="font-family">
						<span class="font-family-decription"><em><?php esc_html_e( 'Allowed only characters & spaces. Ex : Poster Bodani', 'litho' ); ?></em></span>
					</li>
					<li>
						<label for=""><?php esc_html_e( 'WOFF2', 'litho' ); ?></label>
						<input class="upload_field type-woff2" id="litho_upload" type="text" />
						<div class="custom-font-upload-button">
							<i class="dashicons dashicons-upload"></i>
							<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="woff2" data-mime_type="font/woff2,application/octet-stream,font/x-woff2"/>
						</div>
					</li>
					<li>
						<label><?php esc_html_e( 'WOFF', 'litho' ); ?></label>
						<input type="text" class="upload_field type-woff" id="litho_upload" />
						<div class="custom-font-upload-button">
							<i class="dashicons dashicons-upload"></i>
							<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="woff" data-mime_type="font/woff,application/font-woff,application/x-font-woff,application/octet-stream"/>
						</div
					</li>
					<li>
						<label><?php esc_html_e( 'TTF', 'litho' ); ?></label>
						<input type="text" class="upload_field type-ttf" id="litho_upload" />
						<div class="custom-font-upload-button">
							<i class="dashicons dashicons-upload"></i>
							<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="ttf" data-mime_type="application/x-font-ttf,application/octet-stream,font/ttf"/>
						</div>
					</li>
					<li>
						<label><?php esc_html_e( 'EOT', 'litho' ); ?></label>
						<input type="text" class="upload_field type-eot" id="litho_upload" />
						<div class="custom-font-upload-button">
							<i class="dashicons dashicons-upload"></i>
							<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="eot" data-mime_type="application/vnd.ms-fontobject,application/octet-stream,application/x-vnd.ms-fontobject"/>
						</div>
					</li>
					<li>
						<input type="button" class="button button-secondary remove-custom-font" value="<?php echo esc_attr__( 'Remove font', 'litho' ); ?>">
					</li>
				</ul>
			</script>

			<script type="text/template" id="tmpl-litho-custom-sidebar-repeater">
				<li><input type="text" class="add-text-input" value="{{{ data.input_val }}}"><input type="button" class="remove-text-box" value="<?php esc_attr_e( 'Remove', 'litho' ); ?>"></li>
			</script>
			<?php
		}

	} // end of class

	$litho_customizer = new Litho_Customizer();

} // end of class_exists
