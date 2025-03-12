<?php
namespace LithoAddons\Template_Library;

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

/**
 * Template Library Manager
 *
 * @package Litho
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Template_Library_Manager {

	protected static $source = null;

	public static function init() {

		add_action( 'elementor/editor/footer', [ __CLASS__, 'print_template_views' ] );
		add_action( 'elementor/ajax/register_actions', [ __CLASS__, 'register_ajax_actions' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ __CLASS__, 'editor_scripts' ] );
		add_action( 'elementor/preview/enqueue_styles', [ __CLASS__, 'enqueue_preview_styles' ] );
	}

	public static function print_template_views() {
		if ( file_exists( LITHO_ADDONS_TEMPLATE_LIBRARY_PATH . '/templates.php' ) ) {
			include_once LITHO_ADDONS_TEMPLATE_LIBRARY_PATH . '/templates.php';
		}
	}

	public static function editor_scripts() {

		wp_enqueue_style( 'litho-template-library-style', LITHO_ADDONS_TEMPLATE_LIBRARY_DIR . '/assets/css/template-library.css', [ 'elementor-editor' ], LITHO_ADDONS_PLUGIN_VERSION );
		wp_enqueue_script( 'litho-template-library-script', LITHO_ADDONS_TEMPLATE_LIBRARY_DIR . '/assets/js/template-library.min.js', [ 'elementor-editor' ], LITHO_ADDONS_PLUGIN_VERSION, true );

		$localized_data = [
			'lithoProWidgets' => [],
			'i18n' => [
				'templatesEmptyTitle'       => esc_html__( 'No Templates Found', 'litho-addons' ),
				'templatesEmptyMessage'     => esc_html__( 'Try different category or sync for new templates.', 'litho-addons' ),
				'templatesNoResultsTitle'   => esc_html__( 'No Results Found', 'litho-addons' ),
				'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different word.', 'litho-addons' ),
			]
		];
		wp_localize_script( 'litho-template-library-script', 'ExclusiveAddonsEditor', $localized_data );
	
	}	

	public static function enqueue_preview_styles() {
		wp_enqueue_style( 'litho-template-preview-style', LITHO_ADDONS_TEMPLATE_LIBRARY_DIR . '/assets/css/template-preview.css', LITHO_ADDONS_PLUGIN_VERSION );
	}

	/**
	 * Undocumented function
	 *
	 * @return Template_Library_Source
	 */
	public static function get_source() {
		if ( is_null( self::$source ) ) {
			self::$source = new Template_Library_Source();
		}

		return self::$source;
	}

	public static function register_ajax_actions( Ajax $ajax ) {

		$ajax->register_ajax_action( 'litho_get_template_library_data', function( $data ) {

			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new \Exception( 'Access Denied' );
			}

			if ( ! empty( $data['editor_post_id'] ) ) {
				$editor_post_id = absint( $data['editor_post_id'] );

				if ( ! get_post( $editor_post_id ) ) {
					throw new \Exception( __( 'Post not found.', 'litho-addons' ) );
				}

				\Elementor\Plugin::instance()->db->switch_to_post( $editor_post_id );
			}

			$result = self::get_library_data( $data );

			return $result;
		} );

		$ajax->register_ajax_action( 'litho_get_template_item_data', function( $data ) {

			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new \Exception( 'Access Denied' );
			}

			if ( ! empty( $data['editor_post_id'] ) ) {
				$editor_post_id = absint( $data['editor_post_id'] );

				if ( ! get_post( $editor_post_id ) ) {
					throw new \Exception( __( 'Post not found', 'litho-addons' ) );
				}

				\Elementor\Plugin::instance()->db->switch_to_post( $editor_post_id );
			}

			if ( empty( $data['template_id'] ) ) {
				throw new \Exception( __( 'Template id missing', 'litho-addons' ) );
			}

			$result = self::get_template_data( $data );

			return $result;
		} );
	}

	public static function get_template_data( array $args ) {
		$source = self::get_source();
		$data = $source->get_data( $args );
		return $data;
	}

	public static function get_library_data( array $args ) {
		$source = self::get_source();

		if ( ! empty( $args['sync'] ) ) {
			Template_Library_Source::get_library_data( true );
		}

		return [
			'templates'     => $source->get_items(),
			'category'      => $source->get_categories(),
			'type_category' => $source->get_type_category(),
		];
	}
}

Template_Library_Manager::init();
