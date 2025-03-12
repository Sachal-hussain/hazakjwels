<?php
/**
 * Main Elementor `Plugin` Class
 *
 * The main class that initiates and runs the elementor plugin.
 *
 * @package Litho
 */

namespace LithoAddons;

defined( 'ABSPATH' ) || die();

// If class `Plugin` doesn't exists yet.
if ( ! class_exists( 'Plugin' ) ) {
	/**
	 * Main class
	 */
	class Plugin {

		const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

		const MINIMUM_PHP_VERSION = '7.0';

		const SECTION_BUILDER_MENU_SLUG = 'edit.php?post_type=sectionbuilder';

		/**
		 * Plugin instance.
		 *
		 * @access public
		 *
		 * @var Plugin
		 */
		public static $instance;

		public $modules = [];
		/**
		 * Ensures only one instance of the plugin class is loaded or can be loaded.
		 *
		 * @access public
		 * @static
		 *
		 * @return Plugin An instance of the class.
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public static function elementor() {
			return \Elementor\Plugin::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @access private
		 */
		private function __construct() {

			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'litho_check_missing_elementor' ] );
				return;
			}

			// Check for required Elementor version.
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'litho_check_minimum_elementor_version' ] );
				return;
			}

			// Define elementor compatibility.
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				defined( 'ELEMENTOR_OLD_COMPATIBLITY' ) or define( 'ELEMENTOR_OLD_COMPATIBLITY', true );
			} else {
				defined( 'ELEMENTOR_OLD_COMPATIBLITY' ) or define( 'ELEMENTOR_OLD_COMPATIBLITY', false );
			}

			// Check for required PHP version.
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'litho_check_minimum_php_version' ] );
				return;
			}

			spl_autoload_register( [ $this, 'autoload' ] );

			$this->add_hooks();
		}

		public function litho_check_missing_elementor() {

			if ( isset( $_GET['activate'] ) ) { // phpcs:ignore
				unset( $_GET['activate'] );// phpcs:ignore
			}

			$message = sprintf(
				__( '"%1$s" requires "%2$s" to be installed and activated.', 'litho-addons' ),
				'<strong>' . esc_html__( 'Litho Addons', 'litho-addons' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'litho-addons' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function litho_check_minimum_elementor_version() {

			if ( isset( $_GET['activate'] ) ) { // phpcs:ignore
				unset( $_GET['activate'] );// phpcs:ignore
			}

			$message = sprintf(
				__( '"%1$s" requires "%2$s" version %3$s or greater.', 'litho-addons' ),
				'<strong>' . esc_html__( 'Litho Addons', 'litho-addons' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'litho-addons' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function litho_check_minimum_php_version() {

			if ( isset( $_GET['activate'] ) ) { // phpcs:ignore
				unset( $_GET['activate'] );// phpcs:ignore
			}

			$message = sprintf(
				__( '"%1$s" requires "%2$s" version %3$s or greater.', 'litho-addons' ),
				'<strong>' . esc_html__( 'Litho Addons', 'litho-addons' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'litho-addons' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Autoload classes based on namesapce.
		 *
		 * @access public
		 */
		public function autoload( $class ) {

			// Return if Litho name space is not set.
			if ( false === strpos( $class, __NAMESPACE__ ) ) {
				return;
			}
			/**
			 * Prepare filename.
			 *
			 * @todo Refactor to use preg_replace.
			 */
			$filename = str_replace( __NAMESPACE__ . '\\', '', $class );

			$filename = str_replace( '\\', DIRECTORY_SEPARATOR, $filename );
			$filename = str_replace( '_', '-', $filename );
			$filename = dirname( __FILE__ ) . '/' . strtolower( $filename ) . '.php';

			// Return if file is not found.
			if ( ! is_readable( $filename ) ) {
				return;
			}

			include $filename;
		}

		/**
		 * Adds required hooks.
		 *
		 * @access private
		 */
		private function add_hooks() {

			add_action( 'elementor/init', [ $this, 'init' ], 0 );

			// load templates.
			add_action( 'wp_footer', [ $this, 'litho_html_templates' ] );

			// Register controls.
			add_action( 'elementor/controls/controls_registered', [ $this, 'litho_register_controls' ], 15 );
			// Register widgets.
			add_action( 'elementor/widgets/register', [ $this, 'litho_register_widgets' ], 15 );
			// Register categories.
			add_action( 'elementor/elements/categories_registered', [ $this, 'litho_register_categories' ], 15 );
			// Section Builder - Reorder admin menu order with #add_new.
			add_action( 'admin_menu', [ $this, 'litho_admin_menu_reorder' ], 800 );
			// Register editor scripts.
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'litho_register_editor_scripts' ], 999 );
			// Register editor styles.
			add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'litho_register_editor_styles' ], 999 );
			// Register editor styles for mega menu.
			add_action( 'elementor/editor/after_enqueue_styles',[ $this, 'litho_register_menu_editor_styles' ], 999 );
			// Register frontend scripts.
			add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'litho_register_front_scripts' ], 10 );
			// Register frontend styles.
			add_action( 'elementor/frontend/after_register_styles', [ $this, 'litho_enqueue_front_register_styles' ] );
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'litho_enqueue_front_enqueue_styles' ] );

			// Localized settings for editor.
			add_filter( 'elementor/editor/localize_settings', [ $this, 'litho_localized_settings' ] );

			// add menu in admin bar.
			add_filter( 'elementor/frontend/admin_bar/settings', [ $this, 'litho_add_menu_in_admin_bar' ] );
		}

		public function litho_add_menu_in_admin_bar( $admin_bar_config ) {

			if ( isset( $admin_bar_config['elementor_edit_page']['children'] ) && ! empty( $admin_bar_config['elementor_edit_page']['children'] ) && is_array( $admin_bar_config['elementor_edit_page']['children'] ) ) {
				foreach ( $admin_bar_config['elementor_edit_page']['children'] as $key => $value ) {
					if ( 'litho-mega-menu' === get_post_type( $key ) ) {
						unset( $admin_bar_config['elementor_edit_page']['children'][ $key ]);
					}
				}
			}

			$admin_bar_config['elementor_edit_page']['children'][] = [
				'id'    => 'elementor_app_site_editor',
				'title' => __( 'Open Litho Section Builder', 'litho-addons' ),
				'href'  => admin_url( self::SECTION_BUILDER_MENU_SLUG ),
				'class' => 'litho-app-link',
			];
			return $admin_bar_config;
		}

		public function litho_localized_settings( $settings ) {

			$settings = array_replace_recursive(
				$settings,
				[
					'i18n' => [
						'litho_panel_menu_item_customizer' => __( 'Theme Settings (Customizer)', 'litho-addons' ),
					],
				]
			);

			return $settings;
		}
		/**
		 * Get array of custom html templates
		 */
		public function litho_html_templates() {

			$templates = array(
				'count-down'       => 'count-down.html',
				'instagram-feed'   => 'instagram-feed.html',
				'vertical-counter' => 'vertical-counter.html',
				'element-section'  => 'element-section.html',
			);
			$this->litho_print_templates_array( $templates );
		}

		/**
		 * Print templates array
		 *
		 * @param array $templates List of templates to print.
		 * @return [type][description]
		 */
		public function litho_print_templates_array( $templates = array() ) {

			if ( empty( $templates ) ) {
				return;
			}
			foreach ( $templates as $id => $file ) {

				$file = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'template/' . $file;

				if ( ! file_exists( $file ) ) {
					continue;
				}
				ob_start();
				include $file;
				$content = ob_get_clean();
				printf( '<script type="text/html" id="tmpl-%1$s">%2$s</script>', esc_attr( $id ), $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		/**
		 * Register controls with Elementor.
		 *
		 * @access public
		 *
		 * @param object $controls_manager The controls manager.
		 */
		public function litho_register_controls( $controls_manager ) {

			$group_controls = preg_grep( '/^((?!index.php).)*$/', glob( LITHO_ADDONS_ROOT . '/includes/controls/groups/*.php' ) );

			// Register controls.
			foreach ( $group_controls as $control ) {
				// Prepare control name.
				$control_basename = basename( $control, '.php' );
				$control_name     = str_replace( '-', '_', $control_basename );
				// Prepare class name.
				$class_name = str_replace( '-', '_', $control_name );
				$class_name = __NAMESPACE__ . '\Controls\Groups\\' . $class_name;

				if ( ! class_exists( $class_name ) ) {
					continue;
				}
				// Register now.
				$controls_manager->add_group_control( $control_basename, new $class_name() );
			}

			$controls = preg_grep( '/^((?!index.php).)*$/', glob( LITHO_ADDONS_ROOT . '/includes/controls/*.php' ) );

			// Register controls.
			foreach ( $controls as $control ) {
				// Prepare control name.
				$control_basename = basename( $control, '.php' );
				$control_name     = str_replace( '-', '_', $control_basename );
				// Prepare class name.
				$class_name = str_replace( '-', '_', $control_name );
				$class_name = __NAMESPACE__ . '\Controls\\' . $class_name;

				if ( ! class_exists( $class_name ) ) {
					continue;
				}
				// Register now.
				$controls_manager->register( new $class_name() );
			}
		}
		/**
		 * Register widgets with Elementor.
		 *
		 * @access public
		 *
		 * @param object $widgets_manager The controls manager.
		 */
		public function litho_register_widgets( $widgets_manager ) {

			$widgets = preg_grep( '/^((?!index.php).)*$/', glob( LITHO_ADDONS_ROOT . '/includes/widgets/*.php' ) );

			// Register widgets.
			foreach ( $widgets as $widget ) {

				// Prepare widget name.
				$widget_name = basename( $widget, '.php' );
				$widget_name = str_replace( '-', '_', $widget_name );
				// Prepare class name.
				$class_name = str_replace( '-', '_', $widget_name );
				$class_name = __NAMESPACE__ . '\Widgets\\' . $class_name;

				if ( ! class_exists( $class_name ) ) {
					continue;
				}

				// Register now.
				$widgets_manager->register( new $class_name() );
			}
		}
		/**
		 * Register modules.
		 *
		 * @access public
		 */
		public function litho_register_modules() {

			$modules = [
				'custom-fonts\custom-theme-fonts',
				'custom-icons\custom-icons',
				'mega-menu\menu',
				'classes\elementor-templates',
				'classes\mega-menu-frontend-walker',
				'classes\left-menu-frontend-walker',
				'classes\responsive-custom-breakpoints',
				'classes\widgets-extended',
				'classes\column-extended',
				'classes\section-extended',
				'classes\sticky-header-options',
				'template-library\class-elementor-template-library-source',
				'template-library\class-elementor-template-library-manager',
				'section-builder\section-builder-init',
				'section-builder\classes\section-builder-admin',
				'section-builder\classes\section-builder-elementor-canvas',
			];

			foreach ( $modules as $module_name ) {
				// Prepare class name.
				$class_name = str_replace( '-', ' ', $module_name );
				$class_name = str_replace( ' ', '_', ucwords( $class_name ) );
				$class_name = __NAMESPACE__ . '\\' . $class_name;

				if ( ! class_exists( $class_name ) ) {
					continue;
				}

				// Register.
				$this->modules[ $module_name ] = new $class_name();
			}
		}

		/**
		 * Register categories with Elementor.
		 *
		 * @access public
		 *
		 * @param object $category_manager The categories manager.
		 */
		public function litho_register_categories( $category_manager ) {

			global $post;
			$litho_categories = [];

			if ( 'sectionbuilder' === $post->post_type ) {
				$litho_categories['litho-archive'] = [
					'title'  => __( 'Litho Archive', 'litho-addons' ),
					'icon'   => 'fa fa-plug',
					'active' => true,
				];
				$litho_categories['litho-page-title'] = [
					'title'  => __( 'Litho Page Title', 'litho-addons' ),
					'icon'   => 'fa fa-plug',
					'active' => true,
				];

				$litho_categories['litho-header'] = [
					'title'  => __( 'Litho Header', 'litho-addons' ),
					'icon'   => 'fa fa-plug',
					'active' => true,
				];
			}

			$litho_categories['litho'] = [
				'title'  => __( 'Litho', 'litho-addons' ),
				'icon'   => 'fa fa-plug',
				'active' => true,
			];

			$litho_old_categories = $category_manager->get_categories();
			$litho_categories     = array_merge( $litho_categories, $litho_old_categories );
			$litho_set_categories = function ( $litho_categories ) {
				$this->categories = $litho_categories;
			};

			$litho_set_categories->call( $category_manager, $litho_categories );
		}

		public function litho_admin_menu_reorder() {

			global $submenu;

			if ( ! isset( $submenu[ self::SECTION_BUILDER_MENU_SLUG ] ) ) {
				return;
			}
			$library_submenu = &$submenu[ self::SECTION_BUILDER_MENU_SLUG ];

			// If current use can 'Add New' - move the menu to end, and add the '#add_new' anchor.
			if ( isset( $library_submenu[10][2] ) ) {
				$library_submenu[700] = $library_submenu[10];
				unset( $library_submenu[10] );
				$library_submenu[700][2] = admin_url( self::SECTION_BUILDER_MENU_SLUG . '#add_new' );
			}

			// Move the 'Categories' menu to end.
			if ( isset( $library_submenu[15] ) ) {
				$library_submenu[800] = $library_submenu[15];
				unset( $library_submenu[15] );
			}
		}

		public function litho_register_editor_scripts() {

			wp_register_script(
				'litho-addons-editor-script',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/js/editor.js',
				[ 'jquery' ],
				LITHO_ADDONS_PLUGIN_VERSION,
				true
			);
			wp_enqueue_script( 'litho-addons-editor-script' );

			wp_localize_script(
				'litho-addons-editor-script',
				'LithoEditorScript',
				array(
					'ajaxurl'             => admin_url( 'admin-ajax.php' ),
					'elementorCompatible' => ELEMENTOR_OLD_COMPATIBLITY,
				)
			);

		}

		public function litho_register_editor_styles() {

			wp_register_style(
				'litho-addons-editor',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/editor.css',
				[],
				LITHO_ADDONS_PLUGIN_VERSION 
			);
			wp_enqueue_style( 'litho-addons-editor' );
		}

		public function litho_register_menu_editor_styles() {

			if ( ! isset( $_REQUEST['context'] ) || 'litho-addons' !== $_REQUEST['context'] ) { // phpcs:ignore
				return;
			}
			wp_register_style(
				'litho-addons-menu-editor',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/menu-editor.css',
				[],
				LITHO_ADDONS_PLUGIN_VERSION
			);
			wp_enqueue_style( 'litho-addons-menu-editor' );
		}

		public function litho_register_front_scripts() {

			wp_enqueue_script( 'wp-util' );

			wp_register_script(
				'waypoints',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/js/waypoints.min.js',
				[ 'jquery' ],
				'2.0.2',
				true
			);
			wp_enqueue_script( 'waypoints' );

			if ( litho_load_javascript_by_key( 'mCustomScrollbar' ) ) {
				wp_register_script(
					'mCustomScrollbar',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/js/jquery.mCustomScrollbar.concat.min.js',
					[ 'jquery', 'elementor-frontend' ],
					'3.1.5',
					true
				);
				wp_enqueue_script( 'mCustomScrollbar' );
			}

			if ( litho_load_javascript_by_key( 'fitvids' ) ) {
				wp_register_script(
					'fitvids',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/js/jquery.fitvids.js',
					[ 'jquery', 'elementor-frontend' ],
					'1.1',
					true
				);
				wp_enqueue_script( 'fitvids' );
			}

			if ( litho_load_javascript_by_key( 'jquery-match-height' ) ) {
				wp_register_script(
					'jquery-match-height',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/js/jquery.matchHeight-min.js',
					[ 'jquery' ],
					'0.7.2',
					true
				);
				wp_enqueue_script( 'jquery-match-height' );
			}

			wp_register_script(
				'litho-addons-frontend-script',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/js/frontend.js',
				[ 'jquery', 'waypoints', 'elementor-frontend' ],
				LITHO_ADDONS_PLUGIN_VERSION,
				true
			);
			wp_enqueue_script( 'litho-addons-frontend-script' );

			wp_localize_script(
				'litho-addons-frontend-script',
				'LithoFrontend',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'site_id' => ( is_multisite() ) ? '-' . get_current_blog_id() : '',
					'i18n'    => array(
						'likeText'   => __( 'Like', 'litho-addons' ),
						'unlikeText' => __( 'Unlike', 'litho-addons' ),
					),
				)
			);
		}

		public function litho_enqueue_front_register_styles() {

			if ( litho_load_stylesheet_by_key( 'mCustomScrollbar' ) ) {
				wp_register_style(
					'mCustomScrollbar',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/jquery.mCustomScrollbar.min.css',
					[],
					'3.1.5'
				);
			}

			wp_register_style(
				'litho-addons-frontend',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/frontend.css',
				[ 'elementor-frontend' ],
				LITHO_ADDONS_PLUGIN_VERSION
			);
		}

		public function litho_enqueue_front_enqueue_styles() {

			if ( litho_load_stylesheet_by_key( 'mCustomScrollbar' ) ) {
				wp_enqueue_style( 'mCustomScrollbar' );
			}

			wp_enqueue_style( 'litho-addons-frontend' );
		}

		/**
		 * Adds actions after Elementor init.
		 *
		 * @access public
		 */
		public function init() {
			$this->litho_register_modules();
		}
	}
}

if ( ! function_exists( 'litho_elementor_initialize' ) ) {
	/**
	 * Returns instanse of the plugin class.
	 *
	 * @return object
	 */
	function litho_elementor_initialize() {
		return Plugin::get_instance();
	}
}

/**
 * Initializes the Plugin.
 */
litho_elementor_initialize();
