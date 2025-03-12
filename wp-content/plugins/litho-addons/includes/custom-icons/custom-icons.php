<?php
namespace LithoAddons\Custom_icons;

/**
 * Custom Icons initialize
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Custom_icons` doesn't exists yet.
if ( ! class_exists( 'Custom_icons' ) ) {

	/**
	 * Define Custom_icons class
	 */
	class Custom_icons {

		public function __construct() {
			$this->add_hooks();
		}

		private function add_hooks() {
			// Bind custom icons with elementor.
			add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'litho_custom_icons' ] );
			// Editor enqueue scripts.
			add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'litho_editor_custom_styles_scripts' ] );
			// Frontend enqueue scripts.
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'litho_frontend_custom_styles_scripts' ], 10 );
		}

		public function litho_editor_custom_styles_scripts() {

			wp_register_style(
				'font-awesome',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/font-awesome.min.css',
				array(),
				'6.5.2'
			);
			wp_enqueue_style( 'font-awesome' );

			wp_register_style(
				'themify-icons',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/themify-icons.css',
				array(),
				LITHO_ADDONS_PLUGIN_VERSION
			);
			wp_enqueue_style( 'themify-icons' );

			wp_register_style(
				'simple-line-icons',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/simple-line-icons.css',
				array(),
				LITHO_ADDONS_PLUGIN_VERSION
			);
			wp_enqueue_style( 'simple-line-icons' );

			wp_register_style(
				'et-line-icons',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/et-line-icons.css',
				array(),
				LITHO_ADDONS_PLUGIN_VERSION
			);
			wp_enqueue_style( 'et-line-icons' );

			wp_register_style(
				'iconsmind-line-icons',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/iconsmind-line.css',
				array(),
				LITHO_ADDONS_PLUGIN_VERSION
			);
			wp_enqueue_style( 'iconsmind-line-icons' );

			wp_register_style(
				'iconsmind-solid-icons',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/iconsmind-solid.css',
				array(),
				LITHO_ADDONS_PLUGIN_VERSION
			);
			wp_enqueue_style( 'iconsmind-solid-icons' );

			wp_register_style(
				'feather-icons',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/feather-icons.css',
				array(),
				LITHO_ADDONS_PLUGIN_VERSION
			);
			wp_enqueue_style( 'feather-icons' );
		}

		public function litho_frontend_custom_styles_scripts() {

			if ( litho_load_stylesheet_by_key( 'font-awesome' ) ) {
				wp_register_style(
					'font-awesome',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/font-awesome.min.css',
					array(),
					'6.5.2'
				);
				wp_enqueue_style( 'font-awesome' );
			}

			if ( litho_load_stylesheet_by_key( 'themify-icons' ) ) {
				wp_register_style(
					'themify-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/themify-icons.css',
					array(),
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_enqueue_style( 'themify-icons' );
			}

			if ( litho_load_stylesheet_by_key( 'simple-line-icons' ) ) {
				wp_register_style(
					'simple-line-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/simple-line-icons.css',
					array(),
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_enqueue_style( 'simple-line-icons' );
			}

			if ( litho_load_stylesheet_by_key( 'et-line-icons' ) ) {
				wp_register_style(
					'et-line-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/et-line-icons.css',
					array(),
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_enqueue_style( 'et-line-icons' );
			}

			if ( litho_load_stylesheet_by_key( 'iconsmind-line-icons' ) ) {
				wp_register_style(
					'iconsmind-line-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/iconsmind-line.css',
					array(),
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_enqueue_style( 'iconsmind-line-icons' );
			}

			if ( litho_load_stylesheet_by_key( 'iconsmind-solid-icons' ) ) {
				wp_register_style(
					'iconsmind-solid-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/iconsmind-solid.css',
					array(),
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_enqueue_style( 'iconsmind-solid-icons' );
			}

			if ( litho_load_stylesheet_by_key( 'feather-icons' ) ) {
				wp_register_style(
					'feather-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/feather-icons.css',
					array(),
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_enqueue_style( 'feather-icons' );
			}
		}

		public function litho_custom_icons( $settings ) {

			$config      = [];
			$set_config  = [];
			$icons_array = [];

			$custom_icon_library_load = [
				'fa-regular',
				'fa-solid',
				'fa-brands',
				'themify',
				'et-line',
				'simple-line',
				'iconsmind-line',
				'iconsmind-solid',
				'feather',
			];

			foreach ( $custom_icon_library_load as $value ) {

				$prefix         = '';
				$display_prefix = '';
				$key            = str_replace( '-', '_', $value );
				$json_path      = LITHO_ADDONS_INCLUDES_PATH . '/assets/font-json/' . $value . '.json';
				$label          = ucwords( str_replace( '-', ' ', $value ) );

				switch ( $value ) {
					case 'fa-regular':
						$label          = esc_html__( 'Font Awesome - Regular ( v6.5.1 )', 'litho-addons' );
						$prefix         = 'fa-';
						$display_prefix = 'fa-regular';
						break;
					case 'fa-solid':
						$label          = esc_html__( 'Font Awesome - Solid ( v6.5.1 )', 'litho-addons' );
						$prefix         = 'fa-';
						$display_prefix = 'fa-solid';
						break;
					case 'fa-brands':
						$label          = esc_html__( 'Font Awesome - Brands ( v6.5.1 )', 'litho-addons' );
						$prefix         = 'fa-';
						$display_prefix = 'fa-brands';
						break;
					case 'themify':
						$prefix = 'ti-';
						break;
				}

				if ( file_exists( $json_path ) ) {
					$icons_array[ $key ] = [
						ucwords( $label ),
						$prefix,
						$display_prefix,
						'fa-brands fa-font-awesome',
						LITHO_ADDONS_PLUGIN_VERSION,
						LITHO_ADDONS_INCLUDES_DIR . '/assets/font-json/' . $value . '.json',
					];
				}
			}

			$litho_custom_icons_list = apply_filters( 'litho_add_custom_icons', [] );
			$icons_array             = array_merge( $icons_array, $litho_custom_icons_list );

			if ( ! empty( $icons_array ) ) {
				foreach ( $icons_array as $icon_name => $icon_val ) {

					$set_config['name']            = $icon_name . '_icons';
					$set_config['label']           = $icon_val[0];
					$set_config['url']             = '';
					$set_config['enqueue']         = '';
					$set_config['prefix']          = $icon_val[1];
					$set_config['displayPrefix']   = $icon_val[2];
					$set_config['labelIcon']       = $icon_val[3];
					$set_config['ver']             = $icon_val[4];
					$set_config['fetchJson']       = $icon_val[5];
					$set_config['native']          = true;
					$config[ $set_config['name'] ] = $set_config;
				}
			}

			return array_merge( $settings, $config );
		}
	}
}
