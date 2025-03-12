<?php
namespace LithoAddons\Classes;

use Elementor\Controls_Manager;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho Responsive Breakpoints.
 *
 * @package Litho
 */

// If class `Responsive_Custom_Breakpoints` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Classes\Responsive_Custom_Breakpoints' ) ) {

	/**
	 * Define Responsive_Custom_Breakpoints class
	 */
	class Responsive_Custom_Breakpoints {

		/**
		 * Responsive_Custom_Breakpoints instance.
		 *
		 * @access public
		 *
		 * @var Responsive_Custom_Breakpoints
		 */
		public static $instance;

		/**
		 * Ensures only one instance of the Responsive_Custom_Breakpoints class is loaded or can be loaded.
		 *
		 * @access public
		 * @static
		 *
		 * @return Responsive_Custom_Breakpoints An instance of the class.
		 */
		public static function get_instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @access public
		 */
		public function __construct() {

			$this->responsive_breakpints_init();
		}

		public function responsive_breakpints_init() {

			/* Custom Responsive Breakpoints hooks */
			add_action( 'elementor/element/parse_css', [ $this, 'litho_print_post_css' ], 10, 2 );
			add_action( 'elementor/element/column/_litho_advanced_tab_style/after_section_start', array( $this, 'litho_custom_breackpoints_options' ), 10, 2 );
		}

		// add options here which will show in `Litho Advanced` under `Advanced` TAB.
		public function litho_custom_breackpoints_options( $element, $args ) {

			$element->add_control(
				'litho_column_breakpoints_heading',
				[
					'label'		=> __( 'Responsive Breakpoints', 'litho-addons' ),
					'type'		=> Controls_Manager::HEADING,
				]
			);

			$element->add_control(
				'litho_column_breakpoints_description',
				[
					'type'				=> Controls_Manager::RAW_HTML,
					'raw'				=> __( 'Add custom breakpoints and extended responsive column options', 'litho-addons' ),
					'content_classes'	=> 'elementor-descriptor',
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'litho_media_min_width',
				[
					'label'			=> __( 'Min Width', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', 'custom' ],
					'range'			=> [
						'px' => [
							'min'	=> 0,
							'max'	=> 3000,
							'step'	=> 1,
						],
					],
					'default'		=> [
						'unit' => 'px',
						'size' => 0,
					],
				]
			);

			$repeater->add_control(
				'litho_media_max_width',
				[
					'label'			=> __( 'Max Width', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', 'custom' ],
					'range'			=> [
						'px' => [
							'min'	=> 0,
							'max'	=> 3000,
							'step'	=> 1,
						],
					],
					'default'		=> [
						'unit' => 'px',
						'size' => 0,
					],
				]
			);
			$repeater->add_control(
				'column_visibility',
				[
					'label'			=> __( 'Column Visibility', 'litho-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'Show', 'litho-addons' ),
					'label_off'		=> __( 'Hide', 'litho-addons' ),
					'default'		=> 'yes',
				]
			);
			$repeater->add_control(
				'column_width',
				[
					'label'			=> __( 'Column Width', 'litho-addons' ) . ' (%)',
					'type'			=> Controls_Manager::NUMBER,
					'min'			=> 0,
					'max'			=> 100,
					'required'		=> false,
				]
			);

			$repeater->add_control(
				'column_margin',
				[
					'label'			=> __( 'Margin', 'litho-addons' ),
					'type'			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
					'condition'		=> [
						'column_visibility' => 'yes',
					]
				]
			);

			$repeater->add_control(
				'column_padding',
				[
					'label'			=> __( 'Padding', 'litho-addons' ),
					'type'			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
					'condition'		=> [
						'column_visibility' => 'yes',
					]
				]
			);

			$repeater->add_control(
				'column_order',
				[
					'label'		=> __( 'Order', 'litho-addons' ),
					'type'		=> Controls_Manager::NUMBER,
					'min'		=> -20,
					'max'		=> 20,
					'condition' => [
						'column_visibility' => 'yes',
					]
				]
			);

			$element->add_control(
				'litho_column_breakpoints_list',
				[
					'type'			=> Controls_Manager::REPEATER,
					'fields'		=> $repeater->get_controls(),
					'title_field'	=> 'Min: {{{ litho_media_min_width.size }}} - Max: {{{ litho_media_max_width.size }}}',
					'prevent_empty' => false,
					'separator'		=> 'after',
					'show_label'	=> false,
				]
			);
		}

		public function litho_print_post_css( $post_css, $element ) {

			if ( $post_css instanceof Dynamic_CSS ) {
				return;
			}

			if ( 'section' === $element->get_type() ) {

				$output_responsive_css = '';
				$section_output_css    = '';

				$section_selector = $post_css->get_element_unique_selector( $element ); // get selector for specific section.

				foreach ( $element->get_children() as $child ) {

					if ( 'column' === $child->get_type() ) { // Check column or not.

						$settings = $child->get_settings();

						if ( ! empty( $settings['litho_column_breakpoints_list'] ) ) {

							$column_selector = $post_css->get_element_unique_selector( $child ); // get selector for specific column.

							$i = 1;
							foreach ( $settings['litho_column_breakpoints_list'] as $breakpoint ) {

								$litho_media_min_width = ! empty( $breakpoint['litho_media_min_width'] ) && ! empty( $breakpoint['litho_media_min_width']['size'] ) ? intval( $breakpoint['litho_media_min_width']['size'] ) : 0;

								$litho_media_max_width = ! empty( $breakpoint['litho_media_max_width'] ) && ! empty( $breakpoint['litho_media_max_width']['size'] ) ? intval( $breakpoint['litho_media_max_width']['size'] ) : 0;

								if ( $litho_media_min_width > 0 || $litho_media_max_width > 0 ) {

									$media_query = array();

									if ( $litho_media_max_width > 0 ) {
										$media_query[] = '(max-width:' . $litho_media_max_width . 'px)';
									}
									if ( $litho_media_min_width > 0 ) {
										$media_query[] = '(min-width:' . $litho_media_min_width . 'px)';
									}

									if ( $this->litho_generate_responsive_css( $column_selector, $breakpoint ) ) {

										if ( 1 === $i ) {
											$section_output_css = $section_selector . ' > .elementor-container > .elementor-row{flex-wrap: wrap;}';
											$section_output_css = '@media ' . implode(' and ', $media_query ) . '{' . $section_output_css . '}';
										}

										$output_responsive_css .= '@media ' . implode(' and ', $media_query ) . '{' . $this->litho_generate_responsive_css( $column_selector, $breakpoint ) . '}';
									}
								}
								$i++;
							}
						}
					}
				}

				if ( ! empty( $output_responsive_css ) ) {

					if ( ! empty( $section_output_css ) ) {

						$post_css->get_stylesheet()->add_raw_css( $section_output_css );
					}

					$post_css->get_stylesheet()->add_raw_css( $output_responsive_css );
				}
			}

			$element_settings = $element->get_settings();

			if ( empty( $element_settings['litho_custom_css'] ) ) {
				return;
			}

			$custom_css = trim( $element_settings['litho_custom_css'] );

			if ( empty( $custom_css ) ) {
				return;
			}

			$custom_css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $custom_css );
			$post_css->get_stylesheet()->add_raw_css( $custom_css );
		}

		public function litho_generate_responsive_css( $selector, $breakpoint = array() ) {

			$output_responsive_css = '';
			$column_visibility     = ! empty( $breakpoint['column_visibility'] ) && 'no' !== $breakpoint['column_visibility'];

			if ( $column_visibility ) {
				$column_width = ! empty( $breakpoint['column_width'] ) ? floatval( $breakpoint['column_width'] ) : -1;

				if ( $column_width >= 0 ) {
					$output_responsive_css .= 'width: ' . $column_width . '% !important;';
				}

				if ( ! empty( $breakpoint['column_order'] ) ) {
					$output_responsive_css .= 'order : ' . $breakpoint['column_order'] . ';';
				}

				if ( ! empty( $output_responsive_css ) ) {
					$output_responsive_css = $selector . '{' . $output_responsive_css . '}';
				}

				$paddings = array();
				$margins  = array();

				foreach ( array( 'top', 'right', 'bottom', 'left' ) as $side ) {

					if ( '' !== $breakpoint['column_padding'][ $side ] ) {
						$paddings[] = intval( $breakpoint['column_padding'][ $side ] ) . $breakpoint['column_padding']['unit'];
					}

					if ( '' !== $breakpoint['column_margin'][ $side ] ) {
						$margins[] = intval( $breakpoint['column_margin'][ $side ] ) . $breakpoint['column_margin']['unit'];
					}
				}

				$dimensions_css         = ! empty( $paddings ) ? 'padding: ' . implode( ' ', $paddings ) . ' !important;' : '';
				$dimensions_css        .= ! empty( $margins ) ? 'margin: ' . implode( ' ', $margins ) . ' !important;' : '';
				$output_responsive_css .= ! empty( $dimensions_css ) ? $selector . ' > .elementor-element-populated{' . $dimensions_css . '}' : '';

			} else {

				$output_responsive_css .= $selector . '{display: none;}';
			}
			return $output_responsive_css;
		}
	}
}
