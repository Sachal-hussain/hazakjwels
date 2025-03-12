<?php
namespace LithoAddons\Template_Library;

use Elementor\TemplateLibrary\Source_Base;

/**
 * Template Library Data
 *
 * @package Litho
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Template_Library_Source extends Source_Base {

	/**
	 * Template library data cache
	 */
	const LIBRARY_CACHE_ID = 'litho_library_cache';

	/**
	 * Template info api url
	 */
	const TEMPLATE_LIBRARY_API_INFO = 'https://litholib.themezaa.com/wp-json/litho/v1';

	/**
	 * Template data api url
	 */
	const TEMPLATE_LIBRARY_ITEMS_API_TEMPLATES = 'https://litholib.themezaa.com/wp-json/litho/v1/templates/';

	public function get_id() {
		return 'litho-addons-library';
	}

	public function get_title() {
		return __( 'Template Library', 'litho-addons' );
	}

	public function register_data() {}

	public function save_item( $template_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot save template to Template Library' );
	}

	public function update_item( $new_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot update template to Template Library' );
	}

	public function delete_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot delete template from Template Library' );
	}

	public function export_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot export template from Template Library' );
	}

	public function get_items( $args = [] ) {

		$library_data = self::get_library_data();

		$templates = [];

		if ( ! empty( $library_data['data'] ) ) {
			foreach ( $library_data['data'] as $template_data ) {
				$templates[] = $this->prepare_template( $template_data );
			}
		}
		return $templates;
	}

	public function get_categories() {

		$data = array();
		$category_data = self::litho_get_remote_categories();

		foreach ( $category_data as $value) {
			$key = strtolower( str_replace( ' ', '-', $value ) );
			$data[$key] = $value;
		}

		return ( ! empty( $data ) ? $data : [] );
	}

	public function get_type_category() {

		$data = array();
		$category_data = self::litho_get_remote_categories();

		foreach ( $category_data as $value) {
			$key = strtolower( str_replace( ' ', '-', $value ) );
			$data[] = $key;
		}

		$result['section'] = $data;
		return ( ! empty( $result ) ? $result : [] );
	}

	public static function litho_get_remote_categories() {

		$cat_arr  = array();
		$url      = self::TEMPLATE_LIBRARY_API_INFO . '/categories/';
		$response = wp_remote_get( $url, array( 'timeout' => 60 ) );
		$body     = wp_remote_retrieve_body( $response );
		$body     = json_decode( $body, true );

		return ! empty( $body['data'] ) ? $body['data'] : array();
	}

	/**
	 * Prepare template items to match model
	 *
	 * @param array $template_data
	 * @return array
	 */
	private function prepare_template( array $template_data ) {
		$subtype = $template_data['subtype'] ? : '';
		return [
			'template_id' => $template_data['template_id'],
			'title'       => $template_data['title'],
			'type'        => ( $template_data['type'] == 'block' ) ? 'section' : 'page',
			'thumbnail'   => $template_data['thumbnail'],
			'category'    => ( $template_data['type'] == 'block' && $template_data['subtype'] ) ? array( strtolower( str_replace( ' ', '-', $template_data['subtype'] ) ) , 'section' )  : '',
			'isPro'       => $template_data['isPro'],
			'url'         => $template_data['url'],
		];
	}

	/**
	 * Get library data from remote source and cache
	 *
	 * @param boolean $force_update
	 * @return array
	 */
	private static function request_library_data( $force_update = false ) {

		$data = get_option( self::LIBRARY_CACHE_ID );

		if ( $force_update || false === $data ) {
			$timeout = ( $force_update ) ? 25 : 8;

			$response = wp_remote_get( self::TEMPLATE_LIBRARY_ITEMS_API_TEMPLATES, [
				'timeout' => $timeout,
			] );

			if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
				update_option( self::LIBRARY_CACHE_ID, [] );
				return false;
			}

			$data = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( empty( $data ) || ! is_array( $data ) ) {
				update_option( self::LIBRARY_CACHE_ID, [] );
				return false;
			}

			update_option( self::LIBRARY_CACHE_ID, $data, 'no' );
		}

		return $data;
	}

	/**
	 * Get library data
	 *
	 * @param boolean $force_update
	 * @return array
	 */
	public static function get_library_data( $force_update = false ) {
		self::request_library_data( $force_update );

		$data = get_option( self::LIBRARY_CACHE_ID );

		if ( empty( $data ) ) {
			return [];
		}

		return $data;
	}

	/**
	 * Get remote template.
	 *
	 * Retrieve a single remote template from Elementor.com servers.
	 *
	 * @param int $template_id The template ID.
	 *
	 * @return array Remote template.
	 */
	public function get_item( $template_id ) {
		$templates = $this->get_items();

		return $templates[ $template_id ];
	}

	/**
	 * Get remote template data.
	 *
	 * Retrieve the data of a single remote template
	 *
	 * @return array|\WP_Error Remote Template data.
	 */
	public function get_data( array $args, $context = 'display' ) {

		$id       = $args['template_id'];
		$url      = self::TEMPLATE_LIBRARY_API_INFO . '/template/'. $id;
		$response = wp_remote_get( $url, array( 'timeout' => 60 ) );
		$body     = wp_remote_retrieve_body( $response );
		$body     = json_decode( $body, true );
		$data     = ! empty( $body['data'] ) ? $body['data'] : false;
		$result   = array();

		$result['content']       = $this->replace_elements_ids( $data );
		$result['content']       = $this->process_export_import_content( $result['content'], 'on_import' );
		$result['page_settings'] = array();

		return $result;
	}
}
