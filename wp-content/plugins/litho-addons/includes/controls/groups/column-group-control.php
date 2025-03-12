<?php
namespace LithoAddons\Controls\Groups;

use Elementor\Group_Control_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Litho Column Group Control
 *
 * @package Litho
 */

// If class `Column_Group_Control` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Controls\Groups\Column_Group_Control' ) ) {

	/**
	 * Define Column_Group_Control class
	 */
	class Column_Group_Control extends Group_Control_Base {

		/**
		 * Fields.
		 *
		 * Holds all the column group control fields.
		 *
		 * @access protected
		 * @static
		 *
		 * @var array column group control fields.
		 */
		protected static $fields;

		/**
		 * Retrieve type.
		 *
		 * Get column group control type.
		 *
		 * @access public
		 * @static
		 *
		 * @return string Control type.
		 */
		public static function get_type() {
			return 'column-group-control';
		}

		/**
		 * Init fields.
		 *
		 * Initialize column group control fields.
		 *
		 * @access public
		 *
		 * @return array Control fields.
		 */
		public function init_fields() {

			$fields = [];

			$fields['litho_larger_desktop_column'] = [
				'label'			=> _x( 'Larger Desktop', 'Larger Desktop Column', 'litho-addons' ),
				'description'	=> __( '( 1600px and up )', 'litho-addons' ),
				'type'			=> 'select',
				'options'       => [
					'grid-1col'	=> '1',
					'grid-2col'	=> '2',
					'grid-3col'	=> '3',
					'grid-4col'	=> '4',
					'grid-5col'	=> '5',
					'grid-6col'	=> '6',
				],
				'default'		=> 'grid-3col',
			];

			$fields['litho_large_desktop_column'] = [
				'label'			=> _x( 'Large Desktop', 'Large Desktop Column', 'litho-addons' ),
				'description'	=> __( '( 1200px and up )', 'litho-addons' ),
				'type'			=> 'select',
				'options'		=> [
					''				=> __( 'Default', 'litho-addons' ),
					'xl-grid-1col'	=> '1',
					'xl-grid-2col'	=> '2',
					'xl-grid-3col'	=> '3',
					'xl-grid-4col'	=> '4',
					'xl-grid-5col'	=> '5',
					'xl-grid-6col'	=> '6',
				],
			];

			$fields['litho_desktop_column'] = [
				'label'			=> _x( 'Desktop', 'Desktop Column', 'litho-addons' ),
				'description'	=> __( '( 992px and up )', 'litho-addons' ),
				'type'			=> 'select',
				'options'		=> [
					''				=> __( 'Default', 'litho-addons' ),
					'lg-grid-1col'	=> '1',
					'lg-grid-2col'	=> '2',
					'lg-grid-3col'	=> '3',
					'lg-grid-4col'	=> '4',
					'lg-grid-5col'	=> '5',
					'lg-grid-6col'	=> '6',
				],
			];

			$fields['litho_tablet_column'] = [
				'label'			=> _x( 'Tablet', 'Tablet Column', 'litho-addons' ),
				'description'	=> __( '( 768px and up )', 'litho-addons' ),
				'type'			=> 'select',
				'options'		=> [
					''				=> __( 'Default', 'litho-addons' ),
					'md-grid-1col'	=> '1',
					'md-grid-2col'	=> '2',
					'md-grid-3col'	=> '3',
					'md-grid-4col'	=> '4',
					'md-grid-5col'	=> '5',
					'md-grid-6col'	=> '6',
				],
			];

			$fields['litho_landscape_phone_column'] = [
				'label'			=> _x( 'Landscape Phone', 'Landscape Phone Column', 'litho-addons' ),
				'description'	=> __( '( 576px and up )', 'litho-addons' ),
				'type'			=> 'select',
				'options'		=> [
					''				=> __( 'Default', 'litho-addons' ),
					'sm-grid-1col'	=> '1',
					'sm-grid-2col'	=> '2',
					'sm-grid-3col'	=> '3',
					'sm-grid-4col'	=> '4',
				],
			];

			$fields['litho_portrait_phone_column'] = [
				'label'			=> _x( 'Portrait Phone', 'Portrait Phone Column', 'litho-addons' ),
				'description'	=> __( '( 0px and up )', 'litho-addons' ),
				'type'			=> 'select',
				'options'		=> [
					''				=> __( 'Default', 'litho-addons' ),
					'xs-grid-1col'	=> '1',
					'xs-grid-2col'	=> '2',
					'xs-grid-3col'	=> '3',
				],
			];

			return $fields;
		}

		/**
		 * Retrieve default options.
		 *
		 * @access protected
		 */
		protected function get_default_options() {
			return [
			'popover' => [
					'starter_title' => _x( 'No. of Column', 'Column Group Control', 'litho-addons' ),
				]
			];
		}
	}
}
