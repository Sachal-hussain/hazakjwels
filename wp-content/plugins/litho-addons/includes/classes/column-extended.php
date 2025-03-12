<?php
namespace LithoAddons\Classes;

use Elementor\Controls_Manager;

/**
 * Extend Column Features
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Column_Extended` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Classes\Column_Extended' ) ) {

	/**
	 * Define Column_Extended class
	 */
	class Column_Extended {
		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'litho_add_section_litho_advanced_panel' ], 10, 2 );
			add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'litho_update_padding_control' ], 10, 2 );
			add_action( 'elementor/element/column/layout/before_section_end', [ $this, 'litho_add_column_layout_option' ], 10, 2 );
			add_action( 'elementor/element/column/layout/after_section_end', [ $this, 'litho_add_column_litho_settings_tab' ], 10, 2 );
			add_action( 'elementor/frontend/column/before_render', [ $this, 'litho_column_before_render' ], 10, 2 );
		}
		/**
		 * Litho Advanced Section
		 */
		public function litho_add_section_litho_advanced_panel( $element, $args ) {

			$element->start_controls_section(
				'_litho_advanced_tab_style',
				[
					'label' 		=> __( 'Litho Advanced', 'litho-addons' ),
					'tab'	 		=> Controls_Manager::TAB_ADVANCED,
				]
			);
			$element->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type' 			=> Controls_Manager::HOVER_ANIMATION,
					'prefix_class' => 'hvr-',
				]
			);
			$element->end_controls_section();
		}

		public function litho_update_padding_control( $element, $args ) {

			$element->update_responsive_control(
				'padding',
				[
					'selectors' => [
						'{{WRAPPER}} > .elementor-element-populated' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
		}

		public function litho_add_column_layout_option( $element, $args ) {

			$element->add_responsive_control(
				'litho_width_auto',
				[
					'label'		=> __( 'Width Auto', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> '',
					'options'	=> [
						''			=> __( 'Default', 'litho-addons' ),
						'auto'		=> __( 'Auto', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}}' => 'width: {{VALUE}}',
					],
				]
			);
		}

		public function litho_add_column_litho_settings_tab( $element, $args ) {

			$element->start_controls_section(
				'_litho_layout_tab_style',
				[
					'label'		=> __( 'Litho Settings', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_LAYOUT,
				]
			);

			$element->add_control(
				'litho_overflow_settings' ,
				[
					'label'		=> __( 'Overflow', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'options'	=> [
						''			=> __( 'Default', 'litho-addons' ),
						'hidden'	=> __( 'Hidden', 'litho-addons' ),
						'visible'	=> __( 'Visible', 'litho-addons' ),
						'none'		=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} > .elementor-column-wrap.elementor-element-populated, {{WRAPPER}} > .elementor-widget-wrap.elementor-element-populated' => 'overflow: {{VALUE}}',
					],
				]
			);

			$element->add_control(
				'litho_position_settings' ,
				[
					'label'		=> __( 'Position', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'options'	=> [
						''			=> __( 'Default', 'litho-addons' ),
						'relative'	=> __( 'Relative', 'litho-addons' ),
						'absolute'	=> __( 'Absolute', 'litho-addons' ),
						'inherit' 	=> __( 'Inherit', 'litho-addons' ),
					],
					'selectors'	=> [
						'{{WRAPPER}} > .elementor-column-wrap.elementor-element-populated, {{WRAPPER}} > .elementor-widget-wrap.elementor-element-populated' => 'position: {{VALUE}}',
					],
				]
			);

			$element->add_responsive_control(
				'litho_clear_settings' ,
				[
					'label'			=> __( 'Clear', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'options'		=> [
						''		=> __( 'Default', 'litho-addons' ),
						'both'	=> __( 'Both', 'litho-addons' ),
						'none'	=> __( 'None', 'litho-addons' ),
					],
					'selectors'		=> [
						'{{WRAPPER}} > .elementor-column-wrap.elementor-element-populated, {{WRAPPER}} > .elementor-widget-wrap.elementor-element-populated' => 'clear: {{VALUE}}',
					],
				]
			);

			$element->add_responsive_control(
				'litho_display_settings' ,
				[
					'label'     => __( 'Display', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => [
						''             => __( 'Default', 'litho-addons' ),
						'block'        => __( 'Block', 'litho-addons' ),
						'inline'       => __( 'Inline', 'litho-addons' ),
						'inline-block' => __( 'Inline Block', 'litho-addons' ),
						'none'         => __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} > .elementor-column-wrap.elementor-element-populated, {{WRAPPER}} > .elementor-widget-wrap.elementor-element-populated' => 'display: {{VALUE}}',
					],
				]
			);

			$element->add_responsive_control(
				'litho_min_height',
				[
					'label' => __( 'Min Height', 'litho-addons' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max'  => 1000,
							'step' => 10,
						],
					],
					'render_type' => 'ui',
					'separator'   => 'before',
					'selectors'   => [
						'{{WRAPPER}}' => 'min-height: {{SIZE}}{{UNIT}} !important',
					],
				]
			);

			$element->add_control(
				'fullscreen',
				[
					'label'        => __( 'Full Screen', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'label_on'     => __( 'Yes', 'litho-addons' ),
					'label_off'    => __( 'No', 'litho-addons' ),
					'return_value' => 'yes',
				]
			);

			$element->end_controls_section();
		}

		public function litho_column_before_render( $element ) {

			if ( 'column' === $element->get_name() ) {

				$fullscreen_class = '';

				$fullscreen_config = array(
					'fullscreen' => $element->get_settings( 'fullscreen' )
				);

				if ( 'yes' == $element->get_settings( 'fullscreen' ) ) {
					$fullscreen_class = 'full-screen';
				}

				$element->add_render_attribute(
					'_wrapper',
					'class',
					[
						$fullscreen_class
					]
				);

				$element->add_render_attribute(
					'_wrapper',
					'data-fullscreen-column-settings',
					json_encode( $fullscreen_config )
				);
			}
		}
	}
}
