<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Newsletter.
 *
* @package Litho
 */

// If class `Newsletter` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Newsletter' ) ) {

	class Newsletter extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-newsletter';
		}

		/**
		 * Retrieve the widget title.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Newsletter', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-mail';
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
			return [ 'subscribe', 'newsletter', 'mail',  ];
		}

		/**
		 * Register the widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_newsletter_form',
				[
					'label'     => __( 'Form', 'litho-addons' ),
					'tab'       => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_newsletter_style',
				[
					'label'         => __( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'newsletter-style-1',
					'options'       => [
						'newsletter-style-1' => __( 'Style 1', 'litho-addons' ),
						'newsletter-style-2' => __( 'Style 2', 'litho-addons' ),
						'newsletter-style-3' => __( 'Style 3', 'litho-addons' ),
						'newsletter-style-4' => __( 'Style 4', 'litho-addons' ),
						'newsletter-style-5' => __( 'Style 5', 'litho-addons' ),
						'newsletter-style-6' => __( 'Style 6', 'litho-addons' ),
						'newsletter-style-7' => __( 'Style 7', 'litho-addons' ),
						'newsletter-promo'   => __( 'Promo', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'      => 'litho_newsletter_section_background',
					'types'     => [ 'classic', 'gradient' ],
					'exclude'	=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'	=> '{{WRAPPER}} .newsletter-form-wrapper',
					'condition'	=> [
						'litho_newsletter_style!' => [ 'newsletter-style-1', 'newsletter-style-2', 'newsletter-style-3', 'newsletter-style-4', 'newsletter-style-5' ] // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_newsletter_section_align',
				[
					'label'     => __( 'Alignment', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'center',
					'options'   => [
						'left'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						],
						'justify'   => [
							'title'     => __( 'Justified', 'litho-addons' ),
							'icon'      => 'eicon-text-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .newsletter-form-wrapper' => 'text-align: {{VALUE}};',
					],
					'condition'     => [
						'litho_newsletter_style' => 'newsletter-style-7' // IN
					],
					'separator' =>'before',
				]
			);
			$this->add_responsive_control(
				'litho_newsletter_form_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .mc4wp-form-fields' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_newsletter_style!' => [ 'newsletter-style-1' ] // NOT IN
					],
					'separator'     => 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_newsletter_field_style',
				[
					'label'     => __( 'Fields', 'litho-addons' ),
					'tab' 	    => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_style_label',
				[
					'label'     => __( 'Label', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'condition'	=> [
						'litho_newsletter_style!' => [ 'newsletter-style-1' ] // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_newsletter_label_typography',
					'global'	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form label',
					'condition'	=> [
						'litho_newsletter_style!' => [ 'newsletter-style-1' ] // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_newsletter_label_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form label' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'litho_newsletter_style!' => [ 'newsletter-style-1' ] // NOT IN
					],
				]
			);

			$this->add_control(
				'litho_heading_style_input_separator_panel_style',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
					'condition'     	=> [ 'litho_newsletter_style!' => [ 'newsletter-style-1' ] ] // NOT IN
				]
			);

			$this->add_control(
				'litho_heading_style_input',
				[
					'label'     => __( 'Input style', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
				]
			);
			$this->add_responsive_control(
				'litho_newsletter_input_width',
				[
					'label'			=> __( 'Width', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 1,
								'max' => 1000,
						],
						'%' => [
							'max' => 100,
							'min' => 10,
						],
					],
					'selectors'		=> [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'	=> [
						'litho_newsletter_style' => [ 'newsletter-style-7' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_newsletter_input_spacing',
				[
					'label'			=> __( 'Spacing', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'range'			=> [ 'px' => [ 'min' => 0, 'max' => 400 ], '%' => [ 'min' => 0, 'max' => 100 ] ],
					'selectors'		=> [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition'	=> [
						'litho_newsletter_style' => [ 'newsletter-style-6' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_newsletter_input_box_typography',
					'selector'  => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input',
				]
			);
			$this->add_control(
				'litho_newsletter_input_box_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_newsletter_input_box_placeholder_color',
				[
					'label'     => __( 'Placeholder Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input::placeholder' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_newsletter_input_background_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_newsletter_input_border',
					'selector'      => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input',
				]
			);
			$this->add_responsive_control(
				'newsletter_input_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_newsletter_input_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_newsletter_input_shadow',
					'selector'      => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input',
					'separator'     => 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_newsletter_button_style',
				[
					'label'         => __( 'Submit Button', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_submit_button_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'      => 'litho_submit_button_text_shadow',
					'selector'  => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button',
				]
			);
			$this->start_controls_tabs( 'newsletter_submit_button_tabs' );
				$this->start_controls_tab(
					'litho_submit_button_normal_tab',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_submit_button_text_color',
						[
							'label'     => __( 'Text Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button'  => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' => 'litho_submit_button_icon_color',
							'selector' => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"] > i, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button > i',
							'fields_options'    => [ 'background' => [ 'label' => __( 'Icon Color', 'litho-addons' ) ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'litho_submit_button_background_color',
							'types'     => [ 'classic', 'gradient' ],
							'exclude'	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'  => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button',
							'condition'     => [
								'litho_newsletter_style!' => [ 'newsletter-style-5' ] // NOT IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' 		=> 'litho_submit_submit_border',
							'selector'  => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_submit_button_hover_tab',
					[
						'label'     => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_submit_button_hover_text_color',
						[
							'label'         => __( 'Text Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:hover'  => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' => 'litho_submit_button_hover_icon_color',
							'selector' => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover > i, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:hover > i',
							'fields_options'    => [ 'background' => [ 'label' => __( 'Icon Color', 'litho-addons' ) ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'litho_submit_button_hover_background_color',
							'types'     => [ 'classic', 'gradient' ],
							'exclude'	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'  => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:hover',
							'condition'     => [
								'litho_newsletter_style!' => [ 'newsletter-style-5' ] // NOT IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' 		   => 'litho_submit_button_hover_border',
							'selector'     => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:hover',
						]
					);
					$this->add_control(
						'litho_submit_button_hover_transition',
						[
							'label'         => __( 'Transition Duration', 'litho-addons' ),
							'type'          => Controls_Manager::SLIDER,
							'default'       => [
								'size'          => 0.6,
							],
							'range'         => [
								'px'        => [
									'max'       => 3,
									'step'      => 0.1,
								],
							],
							'render_type'   => 'ui',
							'selectors'     => [
								'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button' => 'transition-duration: {{SIZE}}s',
								'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"] > i, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button > i' => 'transition-duration: {{SIZE}}s',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_submit_button_active_tab',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_submit_button_active_text_color',
						[
							'label'         => __( 'Text Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:active, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:focus'  => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' => 'litho_submit_button_active_icon_color',
							'selector' => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active > i, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:active > i, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus > i, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:focus > i',
							'fields_options'    => [ 'background' => [ 'label' => __( 'Icon Color', 'litho-addons' ) ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'litho_submit_button_active_background_color',
							'types'     => [ 'classic', 'gradient' ],
							'exclude'	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'  => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:active, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:focus',
							'condition'     => [
								'litho_newsletter_style!' => [ 'newsletter-style-5' ] // NOT IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_submit_button_active_border',
							'selector'      => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:active, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus, {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button:focus',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_submit_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					],
					'condition'     => [
						'litho_newsletter_style!' => [ 'newsletter-style-5' ] // NOT IN
					],
					'separator'     => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_submit_button_box_shadow',
					'selector'      => '{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button',
					'condition'     => [
						'litho_newsletter_style!' => [ 'newsletter-style-1', 'newsletter-style-5' ] // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_submit_button_icon_spacing',
				[
					'label'			=> __( 'Icon Spacing', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', 'custom' ],
					'range'			=> [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
					'selectors'		=> [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button > i' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_submit_button_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_submit_button_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], {{WRAPPER}} .newsletter-form-wrapper .mc4wp-form button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_newsletter_style!' => [ 'newsletter-style-1', 'newsletter-style-2', 'newsletter-style-3', 'newsletter-style-4', 'newsletter-style-5' ] // NOT IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_newsletter_prevent_checkbox_style',
				[
					'label'         => __( 'Prevent Text', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_newsletter_style' => 'newsletter-promo' // IN
					],
				]
			);

			$this->add_control(
				'litho_prevent_label',
				[
					'label' 		=> __( 'Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'default' 		=> __( 'Prevent This Pop-up', 'litho-addons' ),
					'placeholder' 	=> __( 'Prevent This Pop-up', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_newsletter_prevent_text_typography',
					'selector'  => '{{WRAPPER}} .popup-prevent-text',
				]
			);
			$this->add_control(
				'litho_newsletter_prevent_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .popup-prevent-text' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render newsletter widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings            = $this->get_settings_for_display();
			$mailchimp_id        = get_option( 'mc4wp_default_form_id' );
			$newsletter_style    = ( isset( $settings['litho_newsletter_style'] ) && ! empty( $settings['litho_newsletter_style'] ) ) ? $settings['litho_newsletter_style'] : 'newsletter-style-1';
			$litho_prevent_label = ( isset( $settings['litho_prevent_label'] ) && ! empty( $settings['litho_prevent_label'] ) ) ? $settings['litho_prevent_label'] : esc_html__( 'Prevent This Pop-up', 'litho-addons' );

			$this->add_render_attribute(
				'newsletter_attr',
				'class',
				[
					'newsletter-form-wrapper',
					$newsletter_style,
				]
			);

			$litho_prevent_cehckbox = '';
			if ( 'newsletter-promo' === $newsletter_style ) {
				$litho_prevent_cehckbox = '<label class="litho-show-popup popup-prevent-text"><input type="checkbox" class="litho-promo-show-popup" id="litho-promo-show-popup">' . esc_html( $litho_prevent_label ) . '</label>';
				$this->add_render_attribute(
					'newsletter_attr',
					'class',
					[
						'newsletter-style-1',
					]
				);
			}

			if ( $mailchimp_id && is_mailchimp_form_activated() ) {
				$shortcode = sprintf( '[mc4wp_form id="%s"]', $mailchimp_id );
				?>
					<div <?php $this->print_render_attribute_string( 'newsletter_attr' ); ?>>
						<?php
							echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
					<?php echo sprintf( '%s', $litho_prevent_cehckbox ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php } else { ?>
					<div class="form-not-available alert alert-warning"><?php echo esc_html__( 'No form exists.', 'litho-addons' ); ?></div>
				<?php
			}
		}
	}
}
