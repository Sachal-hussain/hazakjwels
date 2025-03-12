<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for social icons.
 *
* @package Litho
 */

// If class `Social_Icons` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Social_Icons' ) ) {

	class Social_Icons extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve social icons widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-social-icons';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve social icons widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Social Icons', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve social icons widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-social-icons';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return string Widget categories.
		 */

		public function get_categories() {
			return [ 'litho', 'litho-header' ];
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
			return [ 'social', 'icon', 'link' ];
		}

		/**
		 * Register social icons widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			$this->start_controls_section(
				'litho_section_social_icon',
				[
					'label'	=> __( 'Social Icons', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_social_icon_layout_type',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'default',
					'options' 		=> [
						'default' 				=> __( 'Default', 'litho-addons' ),
						'social-icon-style-1' 	=> __( 'Style 1', 'litho-addons' ),
						'social-icon-style-2' 	=> __( 'Style 2', 'litho-addons' ),
						'social-icon-style-3' 	=> __( 'Style 3', 'litho-addons' ),
						'social-icon-style-4' 	=> __( 'Style 4', 'litho-addons' ),
						'social-icon-style-5' 	=> __( 'Style 5', 'litho-addons' ),
					],				
				]
			);

			$repeater = new Repeater();
			$repeater->add_control(
				'litho_social_icon',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'default' 		=> [
						'value' 		=> 'fab fa-wordpress',
						'library' 		=> 'fa-brands',
					],
					'fa4compatibility' 	=> 'social',
				]
			);
			$repeater->add_control(
				'litho_social_icon_custom_text',
				[
					'label'			=> __( 'Custom Text', 'litho-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'		=> '',
					'label_block' 	=> true,
				]
			);
			$repeater->add_control(
				'litho_social_icon_follow_text',
				[
					'label'			=> __( 'Follow Text', 'litho-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'		=> __( 'like us', 'litho-addons' ),
					'label_block'	=> true,
					'description'	=> __( 'Please make sure follow text will use only in social icon style 5.', 'litho-addons' ),
				]
			);
			$repeater->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'label_block' 	=> true,
					'default' 		=> [
						'is_external' 	=> true,
					],
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
				]
			);
			$repeater->add_control(
				'litho_item_icon_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'default',
					'options' 		=> [
						'default' 		=> __( 'Official Color', 'litho-addons' ),
						'custom' 		=> __( 'Custom', 'litho-addons' ),
					],
				]
			);
			$repeater->start_controls_tabs( 'litho_social_icon_tabs' );
			$repeater->start_controls_tab(
				'litho_social_icon_icon_tab',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_item_icon_bg_color',
				[
					'label' 		=> __( 'Background Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .social-icons-wrapper:not(.social-icon-style-5) {{CURRENT_ITEM}}.elementor-icon:not(.litho-hover-effect), {{WRAPPER}} .social-icon-style-5 {{CURRENT_ITEM}}.elementor-icon .social-front, {{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon .litho-social-hover-effect'	=> 'background-color: {{VALUE}};',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_item_icon_text_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
					'selectors' 	=> [
						'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon i, {{WRAPPER}} .social-icons-wrapper {{CURRENT_ITEM}}.elementor-social-icon .social-icon-text'	=> 'color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$repeater->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 			=> 'litho_item_icon_icon_color',
					'selector'		=> '{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon i:before',
					'fields_options'=> [
						'color' 	=> [
							'responsive' => true
						],
						'background'	=> [
								'label' => __( 'Icon Color', 'litho-addons' ),
						]
					]
				]
			);
			$repeater->add_responsive_control(
				'litho_item_icon_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .social-icons-wrapper:not(.social-icon-style-3) {{CURRENT_ITEM}}.elementor-icon' 	=> 'border-color: {{VALUE}};',
						'{{WRAPPER}} .social-icons-wrapper.social-icon-style-3 {{CURRENT_ITEM}}.elementor-icon:after' 	=> 'border-color: {{VALUE}};',
					],
				]
			);
			$repeater->add_control(
				'litho_item_icon_border_width',
				[
					'label' 		=> __( 'Border Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon' => 'border-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$repeater->end_controls_tab();
			$repeater->start_controls_tab(
				'litho_social_icon_icon_tab_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_hover_item_icon_bg_color',
				[
					'label' 		=> __( 'Background Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .social-icons-wrapper:not(.social-icon-style-5) {{CURRENT_ITEM}}.elementor-icon:not(.litho-hover-effect):hover, {{WRAPPER}} .social-icon-style-5 {{CURRENT_ITEM}}.elementor-icon .social-back, {{WRAPPER}} .social-icons-wrapper {{CURRENT_ITEM}}.elementor-icon:hover .litho-social-hover-effect'	=> 'background-color: {{VALUE}};',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_hover_item_icon_text_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
					'selectors' 	=> [
						'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon:hover i, {{WRAPPER}} .social-icons-wrapper:not(.social-icon-style-5) {{CURRENT_ITEM}}.elementor-social-icon:hover .social-icon-text' 	=> 'color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon:hover svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_hover_item_icon_color',
				[
					'label' 		=> __( 'Icon Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
					'selectors' 	=> [
						'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon:hover i, {{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon:hover i:before' 	=> 'color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-icon:hover svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_hover_item_icon_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .social-icons-wrapper:not(.social-icon-style-3) {{CURRENT_ITEM}}.elementor-icon:hover' => 'border-color: {{VALUE}};',
						'{{WRAPPER}} .social-icons-wrapper.social-icon-style-3 {{CURRENT_ITEM}}.elementor-icon:hover:after' => 'border-color: {{VALUE}};',
					],
				]
			);
			$repeater->add_control(
				'litho_hover_item_animation',
				[	
					'label' 		=> __( 'Hover Effect', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> '',
					'description' 	=> __( 'Please make sure animation will use only in social icon style 5.', 'litho-addons' ),
					'options' 		=> [
						'' 						=> __( 'Default', 'litho-addons' ),
						'icon-box-move-up' 		=> __( 'Move Up', 'litho-addons' ),
						'icon-box-move-left' 	=> __( 'Move left', 'litho-addons' ),
						'icon-box-move-right' 	=> __( 'Move Right', 'litho-addons' ),

					],
					'condition' 	=> [
						'litho_item_icon_color' => 'custom',
					],
				]
			);
			$repeater->end_controls_tab();
			$repeater->end_controls_tabs();
			
			$this->add_control(
				'litho_social_icon_list',
				[
					'label' 		=> __( 'Social Icons', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_social_icon' => [
								'value' 	=> 'fab fa-facebook-f',
								'library' 	=> 'fa-brands',
							],
							'litho_hover_item_animation'	=> ''
						],
						[
							'litho_social_icon' => [
								'value' 	=> 'fab fa-x-twitter',
								'library' 	=> 'fa-brands',
							],
							'litho_hover_item_animation'	=> ''
						],
						[
							'litho_social_icon' => [
								'value' 	=> 'fab fa-linkedin-in',
								'library' 	=> 'fa-brands',
							],
							'litho_hover_item_animation'	=> ''
						],
					],
					'title_field' 	=> '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( litho_social_icon, social, true, migrated, true ) }}}',
				]
			);

			$this->add_control(
				'litho_social_icon_list_view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'horizontal',
					'options' 		=> [
						'horizontal' 	=> [
								'title' 	=> __( 'Horizontal', 'litho-addons' ),
								'icon' 		=> 'eicon-ellipsis-h',
						],
						'vertical'		=> [
								'title' 	=> __( 'Vertical', 'litho-addons' ),
								'icon' 		=> 'eicon-ellipsis-v',
						],
					],
					'prefix_class' 	=> 'elementor-icon-view-',
					'condition' 	=> [
						'litho_social_icon_layout_type' => [ 'default' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_icon_show_text',
				[
					'label' 		=> __( 'Show Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
					'label_on'      => __( 'Show', 'litho-addons' ),
					'label_off'     => __( 'Hide', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'condition'		=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-1', 'social-icon-style-2', 'social-icon-style-3', 'social-icon-style-4' ], // NOT IN
					]

				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_social_icon_settings',
				[
					'label' => __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_social_icon_size',
				[
					'label' 		=> __( 'Icon Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'extra-small-icon',
					'options' 		=> [
						'default-icon'		=> __( 'Default', 'litho-addons' ),
						'extra-small-icon' 	=> __( 'Extra Small Icon', 'litho-addons' ),
						'small-icon' 		=> __( 'Small Icon', 'litho-addons' ),
						'medium-icon' 		=> __( 'Medium Icon', 'litho-addons' ),
						'large-icon' 		=> __( 'Large Icon', 'litho-addons' ),
						'extra-large-icon' 	=> __( 'Extra Large Icon', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_shape',
				[
					'label' 		=> __( 'Shape', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'rounded',
					'options' 		=> [
						'rounded' 		=> __( 'Rounded', 'litho-addons' ),
						'square' 		=> __( 'Square', 'litho-addons' ),
						'circle' 		=> __( 'Circle', 'litho-addons' ),
					],
					'prefix_class' => 'elementor-shape-',
					'condition'		=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-1', 'social-icon-style-2', 'social-icon-style-5' ] // NOT IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_align',
				[
					'label' 		=> __( 'Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left'    	=> [
							'title' 	=> __( 'Left', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-left',
						],
						'center' 	=> [
							'title' 	=> __( 'Center', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-center',
						],
						'right' 	=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-right',
						],
					],
					'default' 		=> '',
					'selectors' => [
						'{{WRAPPER}}' 	=> 'text-align: {{VALUE}};',
					]
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
				'litho_section_social_general_style',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_social_icon_general_tabs' );
				$this->start_controls_tab(
					'litho_social_icon_general_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_item_icon_general_bg_color',
						[
							'label' 		=> __( 'Background Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .elementor-icon:not(.litho-hover-effect), {{WRAPPER}} .elementor-icon .litho-social-hover-effect'	=> 'background-color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_social_icon_layout_type!' => [ 'social-icon-style-4', 'social-icon-style-5' ], // NOT IN
							],
						]
					);
					$this->add_responsive_control(
						'litho_item_icon_general_text_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .elementor-icon i, {{WRAPPER}} .elementor-icon .social-icon-text' 	=> 'color: {{VALUE}};',
								'{{WRAPPER}} .elementor-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'			=> 'litho_icon_border',
							'selector'		=> '{{WRAPPER}} .elementor-social-icon',
							'condition'		=> [
								'litho_social_icon_layout_type!' => 'social-icon-style-5' // NOT IN
							],
						]
					);

					$this->add_control(
						'litho_icon_border_radius',
						[
							'label'			=> __( 'Border Radius', 'litho-addons' ),
							'type'			=> Controls_Manager::DIMENSIONS,
							'size_units'	=> [ 'px', '%', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .elementor-icon:not(.litho-hover-effect), {{WRAPPER}} .elementor-icon .litho-social-hover-effect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

							],
							'condition' 	=> [
								'litho_social_icon_layout_type!' => [ 'social-icon-style-4', 'social-icon-style-5' ] // NOT IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_icon_shadow',
							'selector'      => '{{WRAPPER}} .elementor-social-icon',
							'condition' 	=> [
								'litho_social_icon_layout_type!' => [ 'social-icon-style-1', 'social-icon-style-4', 'social-icon-style-5' ] // NOT IN
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'litho_social_icon_general_tab_hover',
					[
						'label'		=> __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_hover_item_icon_general_bg_color',
						[
							'label' 		=> __( 'Background Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .elementor-icon:not(.litho-hover-effect):hover, {{WRAPPER}} .elementor-icon:hover .litho-social-hover-effect'	=> 'background-color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_social_icon_layout_type!' => 'social-icon-style-5', // NOT IN
							],
						]
					);

					$this->add_responsive_control(
						'litho_hover_item_icon_general_text_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .elementor-social-icon:hover i, {{WRAPPER}} .elementor-social-icon:hover .social-icon-text' 		=> 'color: {{VALUE}};',
								'{{WRAPPER}} .elementor-social-icon:hover svg' 	=> 'fill: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'			=> 'litho_icon_hover_border',
							'selector'		=> '{{WRAPPER}} .elementor-social-icon:hover',
							'condition'		=> [
								'litho_social_icon_layout_type!' => 'social-icon-style-5', // NOT IN
							],
						]
					);

					$this->add_control(
						'litho_icon_hover_border_radius',
						[
							'label'			=> __( 'Border Radius', 'litho-addons' ),
							'type'			=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'custom' ],
							'selectors'		=> [
								'{{WRAPPER}} .elementor-icon:not(.litho-hover-effect):hover, {{WRAPPER}} .elementor-icon:hover .litho-social-hover-effect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition' 	=> [
								'litho_social_icon_layout_type!' => [ 'social-icon-style-4', 'social-icon-style-5' ], // NOT IN
							],
						]
					);
				
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_icon_hover_shadow',
							'selector'      => '{{WRAPPER}} .elementor-social-icon:hover',
							'condition' 	=> [
								'litho_social_icon_layout_type!' => [ 'social-icon-style-4', 'social-icon-style-5' ] // NOT IN
							],
						]
					);

					$this->add_responsive_control(
						'litho_icon_rotation',
						[
							'label' 		=> __( 'Icon Rotate', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [
								'px' 		=> [
									'min' 	=> 1,
									'max' 	=> 360,
								],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .elementor-social-icon:hover i' => 'transform: rotateZ({{SIZE}}deg); -webkit-transform: rotateZ({{SIZE}}deg);transition: transform {{litho_icon_hover_transition.SIZE}}s ease-out; -webkit-transition: transform {{litho_icon_hover_transition.SIZE}}s ease-out;',
							],
							'condition' 	=> [
								'litho_social_icon_layout_type!' => [ 'social-icon-style-2', 'social-icon-style-4', 'social-icon-style-5' ] // NOT IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_icon_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 6, 'max' => 300 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'default' 		=> [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-social-icon' => 'width: {{SIZE}}{{UNIT}};',
					],
					'separator'		=> 'before',
					'condition' 	=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-2', 'social-icon-style-5' ] // NOT IN
					],
				]
			);

			$this->add_responsive_control(
				'litho_icon_height',
				[
					'label' 		=> __( 'Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 6, 'max' => 300 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'default' 		=> [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-social-icon' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-2', 'social-icon-style-5' ] // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-social-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-1', 'social-icon-style-3', 'social-icon-style-4', 'social-icon-style-5' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_social_icon_text_section',
				[
					'label' 		=> __( 'Custom / Follow Text', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-1', 'social-icon-style-2', 'social-icon-style-3', 'social-icon-style-4' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_social_icon_custom_text_heading',
				[
					'label'     	=> __( 'Custom Text', 'litho-addons' ),
					'type'      	=> Controls_Manager::HEADING,	
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_social_icon_text_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .elementor-social-icon .social-icon-text',
				]
			);
			$this->add_responsive_control(
				'litho_social_icon_text_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-social-icon .social-icon-text'	=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_icon_text_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-social-icon .social-icon-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);

			$this->add_control(
				'litho_social_icon_follow_text_heading',
				[
					'label'     	=> __( 'Follow Text', 'litho-addons' ),
					'type'      	=> Controls_Manager::HEADING,
					'separator'		=>	'before',
					'condition'		=> [
						'litho_social_icon_layout_type' => 'social-icon-style-5', // IN
					],	
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_social_icon_follow_text_typography',
					'global'	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .elementor-social-icon .social-icon-follow-text',
					'condition' 	=> [
						'litho_social_icon_layout_type' => 'social-icon-style-5', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_icon_follow_text_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .social-icon-follow-text'	=> 'color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_social_icon_layout_type' => 'social-icon-style-5', // IN
					],
				]
			);

			$this->end_controls_section();
			$this->start_controls_section(
				'litho_section_social_style',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' 	=> 6,
							'max' 	=> 120,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-social-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' 	=> 6,
							'max' 	=> 200,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-social-icon' => 'line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_social_icon_layout_type' => 'social-icon-style-2', // IN
					],
				]
			);

			$icon_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';

			$this->add_responsive_control(
				'litho_icon_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> [ 'min'	=> 0, 'max'	=> 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} li:not(:last-child) .elementor-social-icon' => $icon_spacing,
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_social_hover',
				[
					'label' 		=> __( 'Icon Hover', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-5' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type' 			=> Controls_Manager::HOVER_ANIMATION,
					'condition' 	=> [
						'litho_social_icon_layout_type!' => [ 'social-icon-style-2', 'social-icon-style-3' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_icon_hover_opacity',
				[
					'label'		=> __( 'Opacity', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
						'size' => 0.9,
					],
					'range'		=> [
						'px' => [
							'max'	=> 1,
							'step'	=> 0.1,
						],
					],
					'render_type'	=> 'ui',
					'selectors'		=> [
						'{{WRAPPER}} .elementor-social-icon:hover' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_hover_transform',
				[
					'label'		=> __( 'Transform', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
						'size' => 1.3,
					],
					'range'		=> [
						'px' => [
							'max'	=> 2,
							'step'	=> 0.1,
						],
					],
					'render_type'	=> 'ui',
					'selectors'		=> [
						'{{WRAPPER}} .elementor-social-icon:hover' => '-webkit-transform: scale( {{SIZE}} ); -ms-transform: scale( {{SIZE}} ); -o-transform: scale( {{SIZE}} ); transform: scale( {{SIZE}} );',
					],
					'condition' 	=> [
						'litho_hover_animation' => 'scale-effect',
					]
				]
			);

			$this->add_control(
				'litho_icon_hover_transition',
				[
					'label'		=> __( 'Transition Duration', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
						'size' => 0.3,
					],
					'range'		=> [
						'px' => [
							'max'	=> 3,
							'step'	=> 0.1,
						],
					],
					'render_type'	=> 'ui',
					'selectors'		=> [
						'{{WRAPPER}} .elementor-social-icon:hover' => 'transition: all {{SIZE}}s; -webkit-transition: all {{SIZE}}s;',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render social icons widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();

			$fallback_defaults = [
				'fa fa-facebook',
				'fa fa-x-twitter',
				'fa fa-google-plus',
			];

			$litho_animation_style_list = array(
				'social-icon-style-1',
				'social-icon-style-4'
			);

			$migration_allowed = Icons_Manager::is_migration_allowed();
			$this->add_render_attribute( 'wrapper', 'class', [
				$settings['litho_social_icon_layout_type'],
				'social-icons-wrapper',
			] );

			$this->add_render_attribute( 'icon_class', 'class', [
				$settings['litho_social_icon_size'],
			] );
				?>
				<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
					<ul <?php $this->print_render_attribute_string( 'icon_class' ); ?>>
						<?php
						foreach ( $settings['litho_social_icon_list'] as $index => $item ) {
							$social   = '';
							$migrated = isset( $item['__fa4_migrated']['litho_social_icon'] );
							$is_new   = empty( $item['social'] ) && $migration_allowed;

							// add old default
							if ( empty( $item['social'] ) && ! $migration_allowed ) {
								$item['social'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-wordpress';
							}

							if ( ! empty( $item['social'] ) ) {
								$social = str_replace( 'fa fa-', '', $item['social'] );
							}

							if ( ( $is_new || $migrated ) && 'svg' !== $item['litho_social_icon']['library'] ) {
								$social = explode( ' ', $item['litho_social_icon']['value'], 2 );
								if ( empty( $social[1] ) ) {
									$social = '';
								} else {
									$social = str_replace( array( 'fa-', 'ti-' ), '', $social[1] );	
								}
							}
							if ( 'svg' === $item['litho_social_icon']['library'] ) {
								$social = '';
							}

							$link_key = 'link_' . $index;

							$this->add_render_attribute( $link_key, 
								'href',
								( $item['litho_link']['url'] ) ? $item['litho_link']['url'] : '#'
							);

							$this->add_render_attribute( $link_key, 'class', [
								'elementor-icon',
								'elementor-social-icon',
								'elementor-social-icon-' . $social,
								'elementor-repeater-item-' . $item['_id']
							] );

							if ( $item['litho_link']['is_external'] ) {
								$this->add_render_attribute( $link_key, 'target', '_blank' );
							}

							if ( $item['litho_link']['nofollow'] ) {
								$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							}
							
							switch ( $settings['litho_social_icon_layout_type'] ) {
								case 'social-icon-style-1':
									$litho_animation_div   = '';
									$litho_animation_class = '';

									if ( ! empty( $settings['litho_hover_animation'] ) ) {
										$this->add_render_attribute( $link_key, 'class', 'hvr-' . $settings['litho_hover_animation'] );
									}
									if ( in_array( $settings['litho_social_icon_layout_type'], $litho_animation_style_list ) ) {

										$litho_animation_class = 'litho-hover-effect';
										$litho_animation_div   = '<span class="litho-social-hover-effect"></span>';
									}
									$this->add_render_attribute( $link_key, 'class', $litho_animation_class );
										?>
										<li>
											<a <?php $this->print_render_attribute_string( $link_key ); ?>>
												<?php
												if ( $is_new || $migrated ) {
													Icons_Manager::render_icon( $item['litho_social_icon'] );
												} else { ?>
													<i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
												<?php } ?>
												<?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</a>
										</li>
									<?php
									break;
								case 'social-icon-style-2':
									?>
									<li>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php
											if ( $item['litho_social_icon_custom_text'] ) {
												?>
												<span class="social-icon-text alt-font"><?php
													echo ucwords( esc_html( $item['litho_social_icon_custom_text'] ) );
												?></span>
												<?php
											} else {
											?>
												<span class="social-icon-text alt-font"><?php echo ucwords( $social ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
											<?php 
											}

											if ( $is_new || $migrated ) {
												Icons_Manager::render_icon( $item['litho_social_icon'] );
											} else { ?>
												<i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
											<?php } ?>
										</a>
									</li>
									<?php
									break;
								case 'social-icon-style-3':
									?>
									<li>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php
											if ( $is_new || $migrated ) {
												Icons_Manager::render_icon( $item['litho_social_icon'] );
											} else { ?>
												<i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
											<?php } ?>
										</a>
									</li>
									<?php
									break;
								case 'social-icon-style-4':
								
									$litho_animation_div = $litho_animation_class = '';

									if ( ! empty( $settings['litho_hover_animation'] ) ) {
										$this->add_render_attribute( $link_key, 'class', 'hvr-' . $settings['litho_hover_animation'] );
									}
									if ( in_array( $settings['litho_social_icon_layout_type'], $litho_animation_style_list ) ) {

										$litho_animation_class = 'litho-hover-effect';
										$litho_animation_div   = '<span class="litho-social-hover-effect"></span>';
									}
									$this->add_render_attribute( $link_key, 'class', $litho_animation_class );
										?>
										<li>
											<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php
												if ( $is_new || $migrated ) {
													Icons_Manager::render_icon( $item['litho_social_icon'] );
												} else { ?>
													<i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
												<?php } ?>
												<?php
												echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
												?>
											</a>
										</li>
									<?php
									break;
								case 'social-icon-style-5':

									if ( ! empty( $item['litho_hover_item_animation'] ) ) {
										$this->add_render_attribute( $link_key, 'class', 'hvr-' . $item['litho_hover_item_animation'] );
									}
									?>
									<li>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php if ( $item['litho_social_icon_follow_text'] ) { ?>
												<div class="social-back"><span class="social-icon-follow-text"><?php echo esc_html( $item['litho_social_icon_follow_text'] ) ?></span></div>
											<?php } ?>
											<div class="social-front">
												<?php
												if ( $is_new || $migrated ) {
													Icons_Manager::render_icon( $item['litho_social_icon'] );
												} else { ?>
													<i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
												<?php } ?>
												<?php
												if ( 'yes' === $settings['litho_social_icon_show_text'] ) {
													if ( $item['litho_social_icon_custom_text'] ) {
														?>
														<span class="social-icon-text alt-font"><?php echo ucwords( esc_html( $item['litho_social_icon_custom_text'] ) ); ?></span>
														<?php
													} else {
													?>
														<span class="social-icon-text alt-font"><?php echo ucwords( $social ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
													<?php
													}
												}
												?>
											</div>
										</a>
									</li>
									<?php
									break;
								default:
									$litho_animation_div   = '';
									$litho_animation_class = '';

									if ( ! empty( $settings['litho_hover_animation'] ) ) {
										$this->add_render_attribute( $link_key, 'class', 'hvr-' . $settings['litho_hover_animation'] );
									}
									if ( in_array( $settings['litho_social_icon_layout_type'], $litho_animation_style_list ) ) {

										$litho_animation_class = 'litho-hover-effect';
										$litho_animation_div   = '<span class="litho-social-hover-effect"></span>';
									}
									$this->add_render_attribute( $link_key, 'class', $litho_animation_class );
										?>
										<li>
											<a <?php $this->print_render_attribute_string( $link_key ); ?>>
												<?php
												if ( $is_new || $migrated ) {
													Icons_Manager::render_icon( $item['litho_social_icon'] );
												} else { ?>
													<i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
												<?php } ?>
												<?php
												if ( 'yes' === $settings['litho_social_icon_show_text'] ) {
													if ( $item['litho_social_icon_custom_text'] ) {
														?>
														<span class="social-icon-text alt-font"><?php echo ucwords( esc_html( $item['litho_social_icon_custom_text'] ) ); ?></span>
														<?php
													} else {
													?>
														<span class="social-icon-text alt-font"><?php echo ucwords( $social ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
													<?php
													}
												}
												echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												?>
											</a>
										</li>
									<?php
									break;
							}
						}
						?>
					</ul>
				</div>
			<?php
		}
	}
}
