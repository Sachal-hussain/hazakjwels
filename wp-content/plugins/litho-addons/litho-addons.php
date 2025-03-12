<?php
/*
Plugin Name: Litho Addons
Plugin URI: https://www.themezaa.com
Description: A part of Litho theme, which contains premium features, custom elements and templates library.
Version: 2.7
Author: Themezaa Team
Author URI: https://www.themezaa.com
Text Domain: litho-addons
*/

defined( 'LITHO_ADDONS_PLUGIN_VERSION' ) || define( 'LITHO_ADDONS_PLUGIN_VERSION', '2.7' );

defined( 'LITHO_ADDONS_ROOT' ) || define( 'LITHO_ADDONS_ROOT', dirname( __FILE__ ) );
defined( 'LITHO_ADDONS_PLUGIN_PATH' ) || define( 'LITHO_ADDONS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
defined( 'LITHO_ADDONS_ROOT_DIR' ) || define( 'LITHO_ADDONS_ROOT_DIR', plugins_url() . '/litho-addons' );

defined( 'LITHO_ADDONS_IMPORT' ) || define( 'LITHO_ADDONS_IMPORT', LITHO_ADDONS_PLUGIN_PATH . 'importer' );
defined( 'LITHO_ADDONS_WIDGET' ) || define( 'LITHO_ADDONS_WIDGET', LITHO_ADDONS_PLUGIN_PATH . 'widgets' );

defined( 'LITHO_ADDONS_CUSTOM_POST_TYPE_PATH' ) || define( 'LITHO_ADDONS_CUSTOM_POST_TYPE_PATH', LITHO_ADDONS_ROOT . '/custom-post-type' );
defined( 'LITHO_ADDONS_METABOX_PATH' ) || define( 'LITHO_ADDONS_METABOX_PATH', LITHO_ADDONS_ROOT . '/meta-box' );
defined( 'LITHO_ADDONS_WIDGET_PATH' ) || define( 'LITHO_ADDONS_WIDGET_PATH', LITHO_ADDONS_ROOT . '/widgets' );
defined( 'LITHO_ADDONS_INCLUDES_PATH' ) || define( 'LITHO_ADDONS_INCLUDES_PATH', LITHO_ADDONS_ROOT . '/includes' );
defined( 'LITHO_ADDONS_BUILDER_PATH' ) || define( 'LITHO_ADDONS_BUILDER_PATH', LITHO_ADDONS_INCLUDES_PATH . '/section-builder' );
defined( 'LITHO_ADDONS_TEMPLATE_LIBRARY_PATH' ) || define( 'LITHO_ADDONS_TEMPLATE_LIBRARY_PATH', LITHO_ADDONS_INCLUDES_PATH . '/template-library' );

defined( 'LITHO_ADDONS_ASSETS_DIR' ) || define( 'LITHO_ADDONS_ASSETS_DIR', LITHO_ADDONS_ROOT_DIR . '/assets' );
defined( 'LITHO_ADDONS_CSS_DIR' ) || define( 'LITHO_ADDONS_CSS_DIR', LITHO_ADDONS_ASSETS_DIR . '/css' );
defined( 'LITHO_ADDONS_ADMIN_CSS_DIR' ) || define( 'LITHO_ADDONS_ADMIN_CSS_DIR', LITHO_ADDONS_CSS_DIR . '/admin' );
defined( 'LITHO_ADDONS_JS_DIR' ) || define( 'LITHO_ADDONS_JS_DIR', LITHO_ADDONS_ASSETS_DIR . '/js' );
defined( 'LITHO_ADDONS_ADMIN_JS_DIR' ) || define( 'LITHO_ADDONS_ADMIN_JS_DIR', LITHO_ADDONS_JS_DIR . '/admin' );
defined( 'LITHO_ADDONS_METABOX_DIR' ) || define( 'LITHO_ADDONS_METABOX_DIR', LITHO_ADDONS_ROOT_DIR . '/meta-box' );
defined( 'LITHO_ADDONS_INCLUDES_DIR' ) || define( 'LITHO_ADDONS_INCLUDES_DIR', LITHO_ADDONS_ROOT_DIR . '/includes' );
defined( 'LITHO_ADDONS_BUILDER_DIR' ) || define( 'LITHO_ADDONS_BUILDER_DIR', LITHO_ADDONS_INCLUDES_DIR . '/section-builder' );
defined( 'LITHO_ADDONS_TEMPLATE_LIBRARY_DIR' ) || define( 'LITHO_ADDONS_TEMPLATE_LIBRARY_DIR', LITHO_ADDONS_INCLUDES_DIR . '/template-library' );
defined( 'LITHO_ADDONS_MEGAMENU_DIR' ) || define( 'LITHO_ADDONS_MEGAMENU_DIR', LITHO_ADDONS_INCLUDES_DIR . '/mega-menu' );

defined( 'LITHO_ADDONS_CUSTOMIZER' ) || define( 'LITHO_ADDONS_CUSTOMIZER', LITHO_ADDONS_PLUGIN_PATH . 'lib/customizer' );
defined( 'LITHO_ADDONS_CUSTOMIZER_MAPS' ) || define( 'LITHO_ADDONS_CUSTOMIZER_MAPS', LITHO_ADDONS_PLUGIN_PATH . 'lib/customizer/customizer-map' );
defined( 'LITHO_ADDONS_CUSTOMIZER_CONTROLS' ) || define( 'LITHO_ADDONS_CUSTOMIZER_CONTROLS', LITHO_ADDONS_PLUGIN_PATH . 'lib/customizer/customizer-control' );

defined( 'LITHO_ADDONS_IMPORTER_SAMPLE_DATA_URI' ) || define( 'LITHO_ADDONS_IMPORTER_SAMPLE_DATA_URI', plugins_url() . '/litho-addons/importer/sample-data/' );
defined( 'LITHO_ADDONS_IMPORTER_SAMPLE_DATA' ) || define( 'LITHO_ADDONS_IMPORTER_SAMPLE_DATA', plugin_dir_path( __FILE__ ) . 'importer/sample-data/' );

defined( 'LITHO_ADDONS_DEMO_URI' ) || define( 'LITHO_ADDONS_DEMO_URI', 'https://litho.themezaa.com/' );

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Addons` doesn't exists yet.
if ( ! class_exists( 'Litho_Addons' ) ) {

	/**
	 * Define Litho_Addons class
	 */
	class Litho_Addons {
		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'init', [ $this, 'litho_require_files' ] );
			add_action( 'plugins_loaded', [ $this, 'litho_elementor_controls' ] );

			// For Enqueue custom style.
			add_action( 'wp_enqueue_scripts', [ $this, 'litho_enqueue_style_scripts' ], 1000 );

			// Include WordPress custom widgets.
			if ( file_exists( LITHO_ADDONS_ROOT . '/widgets/about-me.php' ) ) {
				require_once LITHO_ADDONS_ROOT . '/widgets/about-me.php';
			}

			if ( file_exists( LITHO_ADDONS_ROOT . '/widgets/recent-post.php' ) ) {
				require_once LITHO_ADDONS_ROOT . '/widgets/recent-post.php';
			}

			if ( file_exists( LITHO_ADDONS_ROOT . '/widgets/instagram.php' ) ) {
				require_once LITHO_ADDONS_ROOT . '/widgets/instagram.php';
			}
		}

		/**
		 * Require files
		 */
		public function litho_require_files() {
			if ( file_exists( LITHO_ADDONS_ROOT . '/lib/require-theme-files.php' ) ) {
				require_once LITHO_ADDONS_ROOT . '/lib/require-theme-files.php';
			}
		}

		/**
		 * Elementor Require files
		 */
		public function litho_elementor_controls() {
			if ( file_exists( LITHO_ADDONS_ROOT . '/includes/plugin.php' ) ) {
				require_once LITHO_ADDONS_ROOT . '/includes/plugin.php';
			}
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function litho_enqueue_style_scripts() {

			if ( litho_load_stylesheet_by_key( 'magnific-popup' ) ) {
				wp_register_style(
					'magnific-popup',
					LITHO_ADDONS_ROOT_DIR . '/assets/css/magnific-popup.css',
					array(),
					'1.1.0'
				);
				wp_enqueue_style( 'magnific-popup' );
			}

			if ( litho_load_javascript_by_key( 'magnific-popup' ) ) {
				wp_register_script(
					'magnific-popup',
					LITHO_ADDONS_ROOT_DIR . '/assets/js/jquery.magnific-popup.min.js',
					array( 'jquery' ),
					'1.1.0',
					true
				);
				wp_enqueue_script( 'magnific-popup' );
			}
		}
	}
	$litho_addons = new Litho_Addons();
}
