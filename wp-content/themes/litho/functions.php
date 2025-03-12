<?php
/**
 * This file use for define custom function
 * Also include required files.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
update_option( 'litho_green_light_pcode', '*******' );
/*
 *	Litho Theme namespace.
 */
define( 'LITHO_THEME_VERSION', '2.7' );
define( 'LITHO_ADDONS_VERSION', '2.7' );
define( 'LITHO_REVOLUTION_VERSION', '6.7.20' );

/*
 *	Litho Theme Folders
 */
define( 'LITHO_THEME_DIR', get_template_directory() );
define( 'LITHO_THEME_LANGUAGES', LITHO_THEME_DIR . '/languages' );
define( 'LITHO_THEME_ASSETS', LITHO_THEME_DIR . '/assets' );
define( 'LITHO_THEME_JS', LITHO_THEME_ASSETS . '/js' );
define( 'LITHO_THEME_CSS', LITHO_THEME_ASSETS . '/css' );
define( 'LITHO_THEME_IMAGES', LITHO_THEME_ASSETS . '/images' );
define( 'LITHO_THEME_ADMIN_JS', LITHO_THEME_JS . '/admin' );
define( 'LITHO_THEME_ADMIN_CSS', LITHO_THEME_CSS . '/admin' );
define( 'LITHO_THEME_LIB', LITHO_THEME_DIR . '/lib' );
define( 'LITHO_THEME_CUSTOMIZER', LITHO_THEME_LIB . '/customizer' );
define( 'LITHO_THEME_CUSTOMIZER_MAPS', LITHO_THEME_CUSTOMIZER . '/customizer-maps' );
define( 'LITHO_THEME_CUSTOMIZER_CONTROLS', LITHO_THEME_CUSTOMIZER . '/customizer-control' );
define( 'LITHO_THEME_TGM', LITHO_THEME_LIB . '/tgm' );

/*
 *  Litho Theme Folder URI
 */
define( 'LITHO_THEME_URI', get_template_directory_uri() );
define( 'LITHO_THEME_LANGUAGES_URI', LITHO_THEME_URI . '/languages' );
define( 'LITHO_THEME_ASSETS_URI', LITHO_THEME_URI . '/assets' );
define( 'LITHO_THEME_JS_URI', LITHO_THEME_ASSETS_URI . '/js' );
define( 'LITHO_THEME_CSS_URI', LITHO_THEME_ASSETS_URI . '/css' );
define( 'LITHO_THEME_IMAGES_URI', LITHO_THEME_ASSETS_URI . '/images' );
define( 'LITHO_THEME_ADMIN_JS_URI', LITHO_THEME_JS_URI . '/admin' );
define( 'LITHO_THEME_ADMIN_CSS_URI', LITHO_THEME_CSS_URI . '/admin' );
define( 'LITHO_THEME_LIB_URI', LITHO_THEME_URI . '/lib' );
define( 'LITHO_THEME_CUSTOMIZER_URI', LITHO_THEME_LIB_URI . '/customizer' );
define( 'LITHO_THEME_CUSTOMIZER_MAPS_URI', LITHO_THEME_CUSTOMIZER_URI . '/customizer-maps' );
define( 'LITHO_THEME_TGM_URI', LITHO_THEME_LIB_URI . '/tgm' );

if ( ! function_exists( 'litho_theme_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function litho_theme_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Litho, use a find and replace
		 * to change 'litho' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'litho', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'image',
				'gallery',
				'video',
				'audio',
				'quote',
				'link',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'litho-popular-posts-thumb', 200, '', true );
		set_post_thumbnail_size( 1568, 9999 );

		// Set Custom Header.
		add_theme_support(
			'custom-header',
			/**
			 * Filter for set Custom Header Args.
			 *
			 * @since 1.0
			 */
			apply_filters(
				'litho_custom_header_args',
				array(
					'width'  => 1920,
					'height' => 100,
				)
			)
		);

		// Set Custom Body Background.
		add_theme_support( 'custom-background' );

		/*
		 * Register menu for Litho theme.
		 */
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'litho' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style();

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'litho' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'litho' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'litho' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'litho' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'litho' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'litho' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'litho' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'litho' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'litho' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'litho' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'litho' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'litho' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'litho' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'litho' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Primary', 'litho' ),
					'slug'  => 'primary',
					'color' => '#fff',
				),
				array(
					'name'  => esc_html__( 'Secondary', 'litho' ),
					'slug'  => 'secondary',
					'color' => '#000',
				),
				array(
					'name'  => esc_html__( 'Dark Gray', 'litho' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => esc_html__( 'Light Gray', 'litho' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => esc_html__( 'White', 'litho' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		/*
		 * woocommerce support
		 */
		add_theme_support( 'woocommerce' );

		/*
		 * product gallery features (zoom, swipe, lightbox)
		*/
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
}
add_action( 'after_setup_theme', 'litho_theme_setup' );

if ( ! function_exists( 'litho_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width Content width.
	 */
	function litho_content_width() {
		/**
		 * Filter to set content width so user can add its own width.
		 *
		 * @since 1.0
		 */
		$GLOBALS['content_width'] = apply_filters( 'litho_content_width', 1170 );
	}
}
add_action( 'after_setup_theme', 'litho_content_width', 0 );

/**
 * Required files
 */
if ( file_exists( LITHO_THEME_LIB . '/require-theme-files.php' ) ) {
	require LITHO_THEME_LIB . '/require-theme-files.php';
}

if ( ! function_exists( 'litho_woocommerce_create_pages' ) ) {
	/**
	 * Blank data for WooCommerce Pages.
	 */
	function litho_woocommerce_create_pages() {

		return array();
	}
}

if ( ! function_exists( 'litho_high_priority_init' ) ) {
	/**
	 * Create WooCommerce Pages.
	 */
	function litho_high_priority_init() {
		add_filter( 'woocommerce_create_pages', 'litho_woocommerce_create_pages' );
	}
}
add_action( 'init', 'litho_high_priority_init', 4 );
