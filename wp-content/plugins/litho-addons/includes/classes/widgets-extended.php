<?php
namespace LithoAddons\Classes;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use LithoAddons\Controls\Groups\Text_Gradient_Background;

/**
 * Extend Widgets Features
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Widgets_Extended` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Classes\Widgets_Extended' ) ) {

	/**
	 * Define Widgets_Extended class
	 */
	class Widgets_Extended {
		/**
		 * Constructor
		 */
		public function __construct() {

			// Text editor Widget style TAB.
			add_action( 'elementor/element/text-editor/section_drop_cap/before_section_end', [ $this, 'litho_add_text_editor_section_tab' ], 10, 2 );

			// Counter Widget style TAB.
			add_action( 'elementor/element/counter/section_number/before_section_end', [ $this, 'litho_add_counter_section_tab' ], 10, 2 );

			add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'litho_add_widget_litho_advanced_panel' ], 10, 2 );
			add_action( 'elementor/element/common/_section_position/after_section_end', [ $this, 'litho_add_widget_section_position' ], 10, 2 );
		}

		public function litho_add_text_editor_section_tab( $element, $args ) {

			$element->update_control(
				'drop_cap_view',
				[
					'label'		=> __( 'View', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'options'	=> [
						'default'		=> __( 'Default', 'litho-addons' ),
						'stacked'		=> __( 'Stacked', 'litho-addons' ),
						'framed'		=> __( 'Framed', 'litho-addons' ),
						'letter-big'	=> __( 'Big letter', 'litho-addons' ),
					],
					'default' 		=> 'default',
					'prefix_class'	=> 'elementor-drop-cap-view-',
				]
			);

			$element->update_control(
				'drop_cap_primary_color',
				[
					'label' => __( 'Primary Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap, {{WRAPPER}}.elementor-drop-cap-view-default .elementor-drop-cap' => 'color: {{VALUE}}; border-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-drop-cap-view-letter-big .elementor-drop-cap' => 'color: {{VALUE}};',
					],
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
				]
			);

			$element->update_control(
				'drop_cap_secondary_color',
				[
					'label' => __( 'Secondary Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'color: {{VALUE}};',
					],
					'condition' => [
						'drop_cap_view!' => [ 'default', 'letter-big' ],
					],
				]
			);
		}

		public function litho_add_counter_section_tab( $element, $args ) {

			$element->remove_control( 'number_color' );

			$element->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'number_color',
					'selector'	=> '{{WRAPPER}} .elementor-counter-number-wrapper',
				]
			);

			$element->add_responsive_control(
				'litho_counte_number_space',
				[
					'label' => __( 'Spacing', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-counter-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};'
					],
				]
			);
			$element->add_responsive_control(
				'litho_counter_display_settings' ,
				[
					'label'        	=> __( 'Display', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-counter-number-wrapper' => 'display: {{VALUE}}',
					],
				]
			);
			$element->add_control(
				'litho_heading_style_number_prefix',
				[
					'label' 		=> __( 'Number Prefix style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$element->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_counter_number_prefix_typography',
					'exclude' => [
						'text_transform',
						'text_decoration',
						'letter_spacing'
					],
					'selector'	=> '{{WRAPPER}} .elementor-counter .elementor-counter-number-prefix',
				]
			);
			$element->add_control(
				'litho_counter_number_prefix_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-counter .elementor-counter-number-prefix' => 'color: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
				'litho_counter_number_prefix_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-counter .elementor-counter-number-prefix' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_control(
				'litho_heading_style_number_suffix',
				[
					'label' 		=> __( 'Number Suffix style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$element->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_counter_number_suffix_typography',
					'exclude' => [
						'text_transform',
						'text_decoration',
						'letter_spacing'
					],
					'selector'	=> '{{WRAPPER}} .elementor-counter .elementor-counter-number-suffix',
				]
			);
			$element->add_control(
				'litho_counter_number_suffix_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'color: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
				'litho_counter_number_suffix_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
					],
				]
			);
		}

		public function litho_add_widget_litho_advanced_panel( $element, $args ) {

			$element->start_controls_section(
				'_litho_advanced_tab_widget_style',
				[
					'label'		=> __( 'Litho Advanced', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_ADVANCED,
				]
			);

			$element->add_control(
				'_overflow_settings' ,
				[
					'label'		=> __( 'Overflow', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'options'	=> [
						''			=> __( 'Default', 'litho-addons' ),
						'hidden'	=> __( 'Hidden', 'litho-addons' ),
						'visible'	=> __( 'Visible', 'litho-addons' ),
						'none'		=> __( 'None', 'litho-addons' ),
					],
					'selectors'	=> [
						'{{WRAPPER}} > .elementor-widget-container' => 'overflow: {{VALUE}}',
					],
				]
			);

			$element->add_responsive_control(
				'_display_order',
				[
					'label'		=> __( 'Order', 'litho-addons' ),
					'type'		=> Controls_Manager::NUMBER,
					'selectors' => [
						'{{WRAPPER}}' => 'order: {{VALUE}};',
					]
				]
			);

			$element->end_controls_section();
		}

		public function litho_add_widget_section_position( $element, $args ) {

			$element->update_control(
				'_position',
				[
					'options' => [
						'' 			=> __( 'Default', 'litho-addons' ),
						'absolute' 	=> __( 'Absolute', 'litho-addons' ),
						'fixed' 	=> __( 'Fixed', 'litho-addons' ),
						'inherit' 	=> __( 'Inherit', 'litho-addons' ),
						'initial' 	=> __( 'Initial', 'litho-addons' ),
						'unset' 	=> __( 'Unset', 'litho-addons' )
					]
				]
			);
		}
	}
}
