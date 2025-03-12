<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for heading.
 *
 * @package Litho
 */

// If class `Heading` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Heading' ) ) {

	class Heading extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve heading widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-heading';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve heading widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Heading', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve heading widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-t-letter';
		}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the heading widget belongs to.
		 *
		 * Used to determine where to display the widget in the editor.
		 *
		 *
		 * @access public
		 *
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return [ 'litho' ];
		}

		/**
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the widget belongs to.
		 *
		 *
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'heading', 'title', 'text', 'subtitle', 'description' ];
		}

		/**
		 * Register heading widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_section_title',
				[
					'label' 	=> __( 'Primary Title', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_title',
				[
					'label' 		=> __( 'Primary Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> __( 'Enter your title', 'litho-addons' ),
					'default' 		=> __( 'Add Your Heading Text Here', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic'       => [
						'active' => true,
					],
					'default' 		=> [
						'url' 		=> '',
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_secondary_title',
				[
					'label' 	=> __( 'Secondary Title', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_secondary_title',
				[
					'label' 		=> __( 'Secondary Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> __( 'Enter your title', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_secondary_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic' 		=> [
						'active'	=> true,
					],
					'default' 		=> [
						'url' 		=> '',
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();


			$this->start_controls_section(
				'litho_section_title_settings',
				[
					'label' 	=> __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_size',
				[
					'label' 		=> __( 'Text Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'default',
					'options' 		=> [
						'default' 		=> __( 'Default', 'litho-addons' ),
						'small' 		=> __( 'Small', 'litho-addons' ),
						'medium'	 	=> __( 'Medium', 'litho-addons' ),
						'large' 		=> __( 'Large', 'litho-addons' ),
						'xl' 			=> __( 'XL', 'litho-addons' ),
						'xxl' 			=> __( 'XXL', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_header_size',
				[
					'label' 		=> __( 'HTML Tag', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'h1' 			=> 'H1',
						'h2' 			=> 'H2',
						'h3' 			=> 'H3',
						'h4' 			=> 'H4',
						'h5' 			=> 'H5',
						'h6' 			=> 'H6',
						'div' 			=> 'div',
						'span' 			=> 'span',
						'p' 			=> 'p',
					],
					'default' 		=> 'h2',
				]
			);
			$this->add_control(
				'litho_vertical_direction',
				[
					'label' 		=> __( 'Vertical Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
					'prefix_class'	=> 'elementor-title-',
					'return_value' 	=> 'vertical-text',
					'condition' 	=> [
						'litho_secondary_title'	=> '',
					],
				]
			);

			$this->add_responsive_control(
				'litho_align',
				[
					'label' 		=> __( 'Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left' => [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}, {{WRAPPER}} .litho-heading' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_line_height',
				[
					'label'         => __( 'Line Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [
						'px'    => [
							'min'   => 1,
							'max'   => 400,
							'step'  => 1,
						],
					],
					'size_units'    => [ 'px', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-heading' => 'line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_title_separator',
				[
					'label' 		=> __( 'Separator', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
					'label_on'      => __( 'Show', 'litho-addons' ),
					'label_off'     => __( 'Hide', 'litho-addons' ),
					'return_value' 	=> 'yes',
				]
			);
			$this->add_control(
				'litho_title_separator_position',
				[
					'label' 		=> __( 'Separator Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'before',
					'options' 		=> [
					   'before' 	=> __( 'Before', 'litho-addons' ),
					   'after' 		=> __( 'After', 'litho-addons' ),
					],
					'condition' 	=> [ 'litho_title_separator' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_enable_bubble_stroke',
				[
					'label' 		=> __( 'Enable Bubble', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'prefix_class' 	=> 'elementor-heading-box-',
					'return_value'	=> 'bubble',
				]
			);
			$this->add_control(
				'litho_bubble_color',
				[
					'label'			=> __( 'Bubble Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'default'		=> '',
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-heading-box-bubble .elementor-widget-container:before' => 'border-top-color: {{VALUE}};',
					],
					'condition' 	=> [ 'litho_enable_bubble_stroke' => 'bubble' ],
				]
			);

			$this->add_control(
				'view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::HIDDEN,
					'default' 		=> 'traditional',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_general_style_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_primary_title_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .litho-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_primary_title_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .litho-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_title_style',
				[
					'label' 		=> __( 'Primary Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_primary_title_type',
				[
					'label' 		=> __( 'Title Type', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'normal' => [
							'title' 	=> __( 'Normal', 'litho-addons' ),
							'icon' 		=> 'eicon-t-letter-bold',
						],
						'stroke' => [
							'title' 	=> __( 'Stroke', 'litho-addons' ),
							'icon' 		=> 'eicon-t-letter',
						],
					],
					'default' => 'normal',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'fields_options'    => [
						'line_height'   => [
							'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						],
					],
					'selector' 	=> '{{WRAPPER}} .litho-primary-title, {{WRAPPER}} .litho-primary-title a',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-primary-title, {{WRAPPER}} .litho-primary-title a',
				]
			);
			$this->add_control(
				'litho_white_space',
				[
					'label' 		=> __( 'White Space', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'normal' 		=> __( 'Normal', 'litho-addons' ),
						'nowrap' 		=> __( 'Nowrap', 'litho-addons' ),
						'pre-line' 		=> __( 'Pre-line', 'litho-addons' ),
						'pre-wrap' 		=> __( 'Pre-wrap', 'litho-addons' ),
						'revert'	 	=> __( 'Revert', 'litho-addons' ),
						'unset' 		=> __( 'Unset', 'litho-addons' ),
						'inherit' 		=> __( 'Inherit', 'litho-addons' ),
						'initial' 		=> __( 'Initial', 'litho-addons' ),
					],
					'default'		=> 'normal',
					'selectors' 	=> [
						'{{WRAPPER}} .litho-primary-title' => 'white-space: {{VALUE}}',
					],
					'condition'		=> [
						'litho_heading_primary_title_type' => 'normal',
					],
					'separator' 	=> 'none',
				]
			);
			$this->start_controls_tabs( 'litho_title_tabs' );
				$this->start_controls_tab(
					'litho_title_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' ),
					]
				);
				// NORMAL Title Type
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_title_color',
						'selector' 	=> '{{WRAPPER}} .litho-primary-title, {{WRAPPER}} .litho-primary-title a',
						'condition'		=> [
							'litho_heading_primary_title_type' => 'normal',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_primary_border',
						'selector'      => '{{WRAPPER}} .litho-primary-title',
						'condition'		=> [
							'litho_heading_primary_title_type' => 'normal',
						],
					]
				);

				// STROKE Title Type
				$this->add_control(
					'litho_stroke_primary_title_color',
					[
						'label'			=> __( 'Text Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .litho-primary-title, {{WRAPPER}} .litho-primary-title a' => '-webkit-text-fill-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_heading_primary_title_type' => 'stroke',
						],
					]
				);
				$this->add_control(
					'litho_stroke_primary_border_color',
					[
						'label'			=> __( 'Stroke Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .litho-primary-title, {{WRAPPER}} .litho-primary-title a' => '-webkit-text-stroke-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_heading_primary_title_type' => 'stroke',
						],
					]
				);
				$this->add_responsive_control(
					'litho_stroke_primary_border_width',
					[
						'label'         => __( 'Stroke Width', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'default'       => [ 'size' => '2' ],
						'range'         => [
							'px'    => [
								'min'   => 1,
								'max'   => 100,
								'step'  => 1,
							],
						],
						'size_units'    => [ 'px', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .litho-primary-title, {{WRAPPER}} .litho-primary-title a' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
						],
						'condition'		=> [
							'litho_heading_primary_title_type' => 'stroke',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_title_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				);
				// NORMAL Title Type
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_title_hover_color',
						'selector' 	=> '{{WRAPPER}} .litho-primary-title a:hover',
						'condition'		=> [
							'litho_heading_primary_title_type' => 'normal',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_title_hover_border',
						'selector'      => '{{WRAPPER}} .litho-primary-title:hover',
						'condition'		=> [
							'litho_heading_primary_title_type' => 'normal',
						],
					]
				);

				// STROKE Title Type
				$this->add_control(
					'litho_stroke_primary_title_hvr_color',
					[
						'label'			=> __( 'Text Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .litho-primary-title a:hover' => '-webkit-text-fill-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_heading_primary_title_type' => 'stroke',
						],
					]
				);
				$this->add_control(
					'litho_stroke_primary_hvr_border_color',
					[
						'label'			=> __( 'Stroke Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .litho-primary-title a:hover' => '-webkit-text-stroke-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_heading_primary_title_type' => 'stroke',
						],
					]
				);
				$this->add_responsive_control(
					'litho_stroke_primary_hvr_border_width',
					[
						'label'         => __( 'Stroke Width', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'default'       => [ 'size' => '2' ],
						'range'         => [
							'px'    => [
								'min'   => 1,
								'max'   => 100,
								'step'  => 1,
							],
						],
						'size_units'    => [ 'px', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .litho-primary-title a:hover' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
						],
						'condition'		=> [
							'litho_heading_primary_title_type' => 'stroke',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_primary_display_settings' ,
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
						'{{WRAPPER}} .litho-primary-title, {{WRAPPER}} .litho-primary-title a' => 'display: {{VALUE}}',
					],
					'separator' 	=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_primary_first_title_border_radius',
				[
					'label'			=> __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-primary-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_primary_first_title_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', 'rem', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .litho-primary-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_primary_first_title_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', 'rem', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .litho-primary-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_secondary_title_style',
				[
					'label' 		=> __( 'Secondary Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_secondary_title_type',
				[
					'label' 		=> __( 'Title Type', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'normal' => [
							'title' 	=> __( 'Normal', 'litho-addons' ),
							'icon' 		=> 'eicon-t-letter-bold',
						],
						'stroke' => [
							'title' 	=> __( 'Stroke', 'litho-addons' ),
							'icon' 		=> 'eicon-t-letter',
						],
					],
					'default' => 'normal',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_secondary_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .litho-secondary-title, {{WRAPPER}} .litho-secondary-title a',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_secondary_text_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-secondary-title, {{WRAPPER}} .litho-secondary-title a',
				]
			);
			$this->start_controls_tabs( 'litho_secondary_title_tabs' );
				$this->start_controls_tab( 'litho_secondary_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					
					// NORMAL Title Type
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' => 'litho_secondary_title_color',
							'selector' => '{{WRAPPER}} .litho-secondary-title, {{WRAPPER}} .litho-secondary-title a',
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'normal',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_secondary_border',
							'selector'      => '{{WRAPPER}} .litho-secondary-title',
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'normal',
							],
						]
					);

					// STROKE Title Type
					$this->add_control(
						'litho_stroke_secondary_title_color',
						[
							'label'			=> __( 'Text Color', 'litho-addons' ),
							'type'			=> Controls_Manager::COLOR,
							'default'		=> '',
							'selectors' 	=> [
								'{{WRAPPER}} .litho-secondary-title, {{WRAPPER}} .litho-secondary-title a' => '-webkit-text-fill-color: {{VALUE}};',
							],
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'stroke',
							],
						]
					);
					$this->add_control(
						'litho_stroke_secondary_border_color',
						[
							'label'			=> __( 'Stroke Color', 'litho-addons' ),
							'type'			=> Controls_Manager::COLOR,
							'default'		=> '',
							'selectors' 	=> [
								'{{WRAPPER}} .litho-secondary-title, {{WRAPPER}} .litho-secondary-title a' => '-webkit-text-stroke-color: {{VALUE}};',
							],
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'stroke',
							],
						]
					);
					$this->add_responsive_control(
						'litho_stroke_secondary_border_width',
						[
							'label'         => __( 'Stroke Width', 'litho-addons' ),
							'type'          => Controls_Manager::SLIDER,
							'default'       => [ 'size' => '2' ],
							'range'         => [
								'px'    => [
									'min'   => 1,
									'max'   => 100,
									'step'  => 1,
								],
							],
							'size_units'    => [ 'px', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-secondary-title, {{WRAPPER}} .litho-secondary-title a' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
							],
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'stroke',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_secondary_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					
					// NORMAL Title Type
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' 			=> 'litho_secondary_title_hover_color',
							'selector' 		=> '{{WRAPPER}} .litho-secondary-title a:hover',
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'normal',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_secondary_title_hover_border',
							'selector'      => '{{WRAPPER}} .litho-secondary-title:hover',
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'normal',
							],
						]
					);

					// STROKE Title Type
					$this->add_control(
						'litho_stroke_secondary_title_hvr_color',
						[
							'label'			=> __( 'Text Color', 'litho-addons' ),
							'type'			=> Controls_Manager::COLOR,
							'default'		=> '',
							'selectors' 	=> [
								'{{WRAPPER}} .litho-secondary-title a:hover' => '-webkit-text-fill-color: {{VALUE}};',
							],
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'stroke',
							],
						]
					);
					$this->add_control(
						'litho_stroke_secondary_hvr_border_color',
						[
							'label'			=> __( 'Stroke Color', 'litho-addons' ),
							'type'			=> Controls_Manager::COLOR,
							'default'		=> '',
							'selectors' 	=> [
								'{{WRAPPER}} .litho-secondary-title a:hover' => '-webkit-text-stroke-color: {{VALUE}};',
							],
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'stroke',
							],
						]
					);
					$this->add_responsive_control(
						'litho_stroke_secondary_hvr_border_width',
						[
							'label'         => __( 'Stroke Width', 'litho-addons' ),
							'type'          => Controls_Manager::SLIDER,
							'default'       => [ 'size' => '2' ],
							'range'         => [
								'px'    => [
									'min'   => 1,
									'max'   => 100,
									'step'  => 1,
								],
							],
							'size_units'    => [ 'px', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-secondary-title a:hover' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
							],
							'condition'		=> [
								'litho_heading_secondary_title_type' => 'stroke',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_secondary_display_settings' ,
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
						'{{WRAPPER}} .litho-secondary-title, {{WRAPPER}} .litho-secondary-title a' => 'display: {{VALUE}}',
					],
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_title_separator_style',
				[
					'label' 		=> __( 'Separator', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_title_separator_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .horizontal-separator' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_title_separator_thickness',
				[
					'label'         => __( 'Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [ 'size' => '1' ],
					'range'         => [
						'px'    => [
							'min'   => 1,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'    => [ 'px', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .horizontal-separator' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_title_separator_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [ 'size' => '10', 'unit' => '%'],
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [
						'%'    => [
							'min'   => 1,
							'max'   => 100,
						],
						'px'    => [
							'min'   => 1,
							'max'   => 100,
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .horizontal-separator' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_separato_display_settings' ,
				[
					'label'        	=> __( 'Display', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'default'		=> 'inline-block',
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .horizontal-separator' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_separato_vertical_align_settings' ,
				[
					'label'        	=> __( 'Vertical Align', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'default'		=> 'middle',
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'top' 			=> __( 'Top', 'litho-addons' ),
						'middle' 		=> __( 'Middle', 'litho-addons' ),
						'bottom' 		=> __( 'Bottom', 'litho-addons' ),
						'space-between' => __( 'Space Between', 'litho-addons' ),
						'space-around' 	=> __( 'Space Around', 'litho-addons' ),
						'space-evenly' 	=> __( 'Space Evenly', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .horizontal-separator' => 'vertical-align: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_title_separator_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .horizontal-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render heading widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$separator_before_title = '';
			$separator_after_title  = '';
			$settings               = $this->get_settings_for_display();

			if ( '' === $settings['litho_title'] && '' === $settings['litho_secondary_title']) {
				return;
			}

			$title                  = $settings['litho_title'];
			$secondary_title        = $settings['litho_secondary_title'];
			$enable_title_separator = $settings['litho_title_separator'];
			$separator_position     = $settings['litho_title_separator_position'];
			
			$this->add_render_attribute( 'primary_title', 'class', 'litho-primary-title' );
			$this->add_render_attribute( 'secondary_title', 'class', 'litho-secondary-title' );
			$this->add_render_attribute( 'separator', 'class', 'horizontal-separator' );

			if ( 'yes' == $enable_title_separator ) {
				switch ( $separator_position ) {
					case 'before':
					default:
						$separator_before_title = sprintf( '<span %1$s></span>', $this->get_render_attribute_string( 'separator' ) );
						break;
					case 'after':
						$separator_after_title = sprintf( '<span %1$s></span>', $this->get_render_attribute_string( 'separator' ) );
						break;
				}
			}

			$this->add_render_attribute( 'title', 'class', 'litho-heading' );
			if ( ! empty( $settings['litho_size'] ) ) {
				$this->add_render_attribute( 'title', 'class', 'elementor-size-' . $settings['litho_size'] );
			}

			if ( ! empty( $settings['litho_link']['url'] ) ) {
				$this->add_link_attributes( 'url', $settings['litho_link'] );
				$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
			}

			if ( ! empty( $title ) ) {
				$title = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'primary_title' ), $title );
			}

			if ( ! empty( $settings['litho_secondary_link']['url'] ) ) {
				$this->add_link_attributes( 'secondary_url', $settings['litho_secondary_link'] );
				$secondary_title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'secondary_url' ), $secondary_title );
			}

			if ( ! empty( $secondary_title ) ) {
				$secondary_title = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'secondary_title' ), $secondary_title );
			}
			$title_html = sprintf( '<%1$s %2$s>%3$s%4$s%5$s%6$s</%1$s>', $settings['litho_header_size'], $this->get_render_attribute_string( 'title' ), $separator_before_title, $title, $separator_after_title, $secondary_title ); 

			printf( '%s', $title_html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
