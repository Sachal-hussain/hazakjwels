<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for progress step.
 *
 * @package Litho
 */

// If class `Progress_Step` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Progress_Step' ) ) {

	class Progress_Step extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve progress step widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-progress-step';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve progress step widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Progress Steps', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve progress step widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-exchange';
		}

		/**
		 * Retrieve the widget categories.
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
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'progress', 'process', 'step' ];
		}

		/**
		 * Register progress step widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_section_progress_step_settings',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_progress_step_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'progress-step-style-2',
					'options'     	=> [
							'progress-step-style-1' => __( 'Style 1', 'litho-addons' ),
							'progress-step-style-2' => __( 'Style 2', 'litho-addons' ),
							'progress-step-style-3' => __( 'Style 3', 'litho-addons' ),
							'progress-step-style-4' => __( 'Style 4', 'litho-addons' ),
							'progress-step-style-5' => __( 'Style 5', 'litho-addons' ),
					],
					'label_block' 	=> true,
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_section_progress_step',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_progress_step_number',
				[
					'label'     	=> __( 'Number', 'litho-addons' ),
					'type'      	=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( '1', 'litho-addons' ),
					'condition'     => [ 
						'litho_progress_step_style' => [ 'progress-step-style-1', 'progress-step-style-3', 'progress-step-style-4', 'progress-step-style-5' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_enable_custom_image',
				[
					'label' 		=> __( 'Custom Image?', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'condition'     => [
						'litho_progress_step_style' => [ 'progress-step-style-2' ], // IN
					]
				]
			);
			$this->add_control(
				'litho_progress_step_icon',
				[
					'label' 			=> __( 'Icon', 'litho-addons' ),
					'type' 				=> Controls_Manager::ICONS,
					'default' 			=> [
						'value' 		=> 'fa-solid fa-star',
						'library' 		=> 'fa-solid',
					],
					'label_block' 		=> true,
					'fa4compatibility' 	=> 'icon',
					'condition' 	=> [
						'litho_enable_custom_image' => '',
						'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN

					],
				]
			);
			$this->add_control(
				'litho_progress_step_image',
				[
					'label' 		=> __( 'Choose Image', 'litho-addons' ),
					'type' 			=> Controls_Manager::MEDIA,
					'dynamic'   	=> [
						'active' => true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'condition' 	=> [
						'litho_enable_custom_image!' => '',
						'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator' 	=> 'none',
					'condition' 	=> [
						'litho_enable_custom_image!' => '',
						'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
					],
				]
			);
			$this->add_control(
				'litho_progress_step_title',
				[
					'label'     	=> __( 'Title', 'litho-addons' ),
					'type'      	=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
					'default'       => __( 'Write title here', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_progress_step_content',
				[
					'label'     	=> __( 'Content', 'litho-addons' ),
					'type'      	=> Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
					    'active' => true
					],
					'show_label'	=> false,
					'default'		=> __( 'Lorem ipsum amet consectetur adipiscing', 'litho-addons' ),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_progress_step_general_style',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_carousel_aligment',
				[
					'label'   		=> __( 'Alignment', 'litho-addons' ),
					'type'    		=> Controls_Manager::CHOOSE,
					'default' 		=> 'center',
					'options' 		=> [
						'left'    		=> [
							'title' 	=> __( 'Left', 'litho-addons' ),
							'icon'  	=> 'eicon-text-align-left',
						],
						'center' 		=> [
							'title' 	=> __( 'Center', 'litho-addons' ),
							'icon'  	=> 'eicon-text-align-center',
						],
						'right' 		=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon'  	=> 'eicon-text-align-right',
						],
					],				
					'selectors'  	=> [
						'{{WRAPPER}}  .progress-step-box' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_section_progress_step_image_style',
				[
					'label' 		=> __( 'Icon or Image', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
					],
				]
			);

			$this->add_responsive_control(
				'litho_progress_step_image_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'default' 		=> [
						'unit' 			=> '%',
					],
					'tablet_default' => [
						'unit' 			=> '%',
					],
					'mobile_default' => [
						'unit' 			=> '%',
					],
					'size_units' 	=> [ '%', 'px', 'vw', 'custom' ],
					'range' 		=> [
						'%' => [
							'min' => 1,
							'max' => 100,
						],
						'px' => [
							'min' => 1,
							'max' => 1000,
						],
						'vw' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .progress-step-icon img'	=> 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .progress-step-icon svg'	=> 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'litho_enable_custom_image!' => '',
						'litho_progress_step_style'  => [ 'progress-step-style-2' ], //IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_icon_size',
				[
					'label' 	=> __( 'Size', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .progress-step-box .progress-step-icon i' 	 => 'font-size: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .progress-step-box .progress-step-icon svg' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'litho_enable_custom_image' => '',
						'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
					],
				]
			);		
			$this->start_controls_tabs( 'litho_progress_step_image_tabs' );
				$this->start_controls_tab( 'litho_progress_step_image_normal_tab',
					[
						'label' 	=> __( 'Normal', 'litho-addons' ),
						'condition' => [
							'litho_progress_step_style' => [ 'progress-step-style-2' ] // IN
						],
					]
				);
					/* For ICON */
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' 			=> 'litho_progress_step_icon_color',
							'selector' 		=> '{{WRAPPER}} .progress-step-box .progress-step-icon i, {{WRAPPER}} .progress-step-box .progress-step-icon svg',
							'condition' 	=> [
								'litho_enable_custom_image' => '',
								'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 				=> 'litho_progress_step_icon_box_bg_color',
							'types' 			=> [ 'classic', 'gradient' ],
							'exclude'			=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector' 			=> '{{WRAPPER}} .progress-step-icon-box .progress-step-icon',
							'condition'     	=> [
								'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
							]
						]
					);
					/* For IMAGE */
					$this->add_control(
						'litho_progress_step_image_opacity',
						[
							'label' 	=> __( 'Opacity', 'litho-addons' ),
							'type' 		=> Controls_Manager::SLIDER,
							'range' 	=> [
								'px' 	=> [
									'max' 	=> 1,
									'min' 	=> 0.10,
									'step' 	=> 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .progress-step-icon img' => 'opacity: {{SIZE}};',
							],
							'condition' => [
								'litho_enable_custom_image!' 	=> '',
								'litho_progress_step_style' 	=> [ 'progress-step-style-2' ], //IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter::get_type(),
						[
							'name' 		=> 'litho_progress_step_image_css_filters',
							'selector' 	=> '{{WRAPPER}} .progress-step-icon img',
							'condition' => [
								'litho_enable_custom_image!' 	=> '',
								'litho_progress_step_style' 	=> [ 'progress-step-style-2' ], //IN
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_section_progress_step_image_hover_tab',
					[
						'label' 	=> __( 'Hover', 'litho-addons' ),
						'condition' => [
							'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
						],
					]
				);
					/* For ICON*/
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' 			=> 'litho_progress_step_icon_hover_color',
							'selector' 		=> '{{WRAPPER}} .progress-step-icon-box:hover .progress-step-icon i, {{WRAPPER}} .progress-step-icon-box:hover .progress-step-icon svg',
							'condition' 	=> [
								'litho_enable_custom_image' => '',
								'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 			=> 'litho_progress_step_icon_box_hover_bg_color',
							'types' 		=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector' 		=> '{{WRAPPER}} .progress-step-icon-box:hover .progress-step-icon',
							'condition'     => [
								'litho_progress_step_style' => [ 'progress-step-style-2' ], //IN
							]
						]
					);
					/* For IMAGE*/
					$this->add_control(
						'litho_progress_step_image_opacity_hover',
						[
							'label' 	=> __( 'Opacity', 'litho-addons' ),
							'type'	 	=> Controls_Manager::SLIDER,
							'range' 	=> [
								'px' 	=> [
									'max' 	=> 1,
									'min' 	=> 0.10,
									'step' 	=> 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .progress-step-icon:hover img' => 'opacity: {{SIZE}};',
							],
							'condition' => [
								'litho_enable_custom_image!' 	=> '',
								'litho_progress_step_style' 	=> [ 'progress-step-style-2' ] // IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter::get_type(),
						[
							'name' 		=> 'litho_progress_step_image_css_filters_hover',
							'selector' 	=> '{{WRAPPER}} .progress-step-icon:hover img',
							'condition' => [
								'litho_enable_custom_image!' 	=> '',
								'litho_progress_step_style' 	=> [ 'progress-step-style-2' ] // IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_progress_step_icon_hover_box_shadow',
							'selector'      => '{{WRAPPER}} .progress-step-icon-box:hover .progress-step-icon',
							'condition'     => [ 'litho_progress_step_style' => [ 'progress-step-style-2' ] ] // IN
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_progress_step_box_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .progress-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom'],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_progress_step_number_style',
				[
					'label' 		=> __( 'Number', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [ 
						'litho_progress_step_style!' => [ 'progress-step-style-2' ], // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_progress_step_number_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .progress-step-box .progress-step-number',
					'condition'     => [ 
						'litho_progress_step_style!' => [ 'progress-step-style-2' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_progress_step_number_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-number' => 'color: {{VALUE}};',
					],
					'condition'     => [ 
						'litho_progress_step_style!' => [ 'progress-step-style-2' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_progress_step_number_hover_color',
				[
					'label'         => __( 'Hover Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .progress-step-item:hover .progress-step-number-bfr' => 'color: {{VALUE}};',
					],
					'condition'     => [ 
						'litho_progress_step_style' => [ 'progress-step-style-3' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 			=> 'litho_progress_step_number_bg_color',
					'fields_options'=> [ 'background' => [ 'label' => __( 'Number Background Color', 'litho-addons' ) ] ],
					'types' 		=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 		=> '{{WRAPPER}} .progress-step-box .progress-step-item-bfr, {{WRAPPER}} .progress-step-box .progress-step-icon-bfr, {{WRAPPER}} .progress-step-box .progress-step-number-bfr',
					'condition'     => [ 
						'litho_progress_step_style' => [ 'progress-step-style-1', 'progress-step-style-3', 'progress-step-style-4', 'progress-step-style-5' ], // IN
					],
					'separator' => 'before'
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 			=> 'litho_progress_step_icon_bg_color',
					'fields_options'=> [ 'background' => [ 'label' => __( 'Icon Background Color', 'litho-addons' ) ] ],
					'types' 		=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 		=> '{{WRAPPER}} .progress-step-box .progress-step-icon-afr',
					'condition'     => [ 
						'litho_progress_step_style' => [ 'progress-step-style-5' ], // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 			=> 'litho_progress_step_number_hover_bg_color',
					'fields_options'=> [ 'background' => [ 'label' => __( 'Hover Background Color', 'litho-addons' ) ] ],
					'types' 		=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 		=> '{{WRAPPER}} .progress-step-item:hover .progress-step-number-bfr',
					'condition'     => [ 
						'litho_progress_step_style' => [ 'progress-step-style-3' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_progress_step_number_border',
					'selector' 		=> '{{WRAPPER}} .progress-step-box .progress-step-number-bfr',
					'condition'     => [ 
						'litho_progress_step_style' => [ 'progress-step-style-3' ], // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_progress_step_number_box_shadow',
					'selector'      => '{{WRAPPER}} .progress-step-box .progress-step-number-bfr',
					'condition'     => [ 'litho_progress_step_style' => [ 'progress-step-style-5' ] ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_progress_step_title_style',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_progress_step_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .progress-step-box .progress-step-title',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 			=> 'litho_progress_step_title_color',
					'selector' 		=> '{{WRAPPER}} .progress-step-box .progress-step-title',
				]
			);
			$this->add_responsive_control(
	            'litho_progress_step_title_display_settings' ,
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
						'{{WRAPPER}} .progress-step-box .progress-step-title' => 'display: {{VALUE}}',
					],
	            ]
	        );
			$this->add_responsive_control(
				'litho_progress_step_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_progress_step_content_style',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_progress_step_content_typography',
					'selector'	=> '{{WRAPPER}} .progress-step-box .progress-step-content',
				]
			);
			$this->add_control(
				'litho_progress_step_content_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_content_width',
				[
					'label'			=> __( 'Width', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'range'			=> [ 'px'   => [ 'min' => 10, 'max' => 200 ], '%'   => [ 'min' => 10, 'max' => 100 ] ],
					'selectors'		=> [
						'{{WRAPPER}} .progress-step-box .progress-step-content' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
	            'litho_progress_step_content_display_settings' ,
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
						'{{WRAPPER}} .progress-step-box .progress-step-content' => 'display: {{VALUE}}',
					],
	            ]
	        );
			$this->add_responsive_control(
				'litho_progress_step_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_progress_step_separator_style_section',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_display_separator',
				[
					'label'             => __( 'Separator', 'litho-addons' ),
					'type'              => Controls_Manager::CHOOSE,
					'label_block'       => false,
					'default'           => 'block',
					'options'           => [
						'none'      => [
							'title'     => __( 'Hide', 'litho-addons' ),
							'icon'      => 'fa-solid fa-eye-slash',
						],
						'block'    => [
							'title'     => __( 'Show', 'litho-addons' ),
							'icon'      => 'fa-solid fa-eye',
						]
					],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-separator' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_progress_step_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box .progress-step-separator' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_progress_step_separator_thickness',
				[
					'label'         => __( 'Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'size'      => 1,
						'unit'      => 'px',
					],
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 20 ] ],
					'selectors'     => [
						'{{WRAPPER}} .progress-step-box:not(.progress-step-style-3) .progress-step-separator' => 'height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .progress-step-box.progress-step-style-3 .progress-step-separator'       => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render progress step widget output on the frontend.
		 * Make sure value does no exceed 100%.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {
			
			$icon                      = '';
			$settings                  = $this->get_settings_for_display();
			$litho_progress_step_style = ( isset( $settings['litho_progress_step_style'] ) &&  $settings['litho_progress_step_style'] ) ? $settings['litho_progress_step_style'] : '';
			$progress_step_number      = ( isset( $settings['litho_progress_step_number'] ) &&  $settings['litho_progress_step_number'] ) ? $settings['litho_progress_step_number'] : '';
			$progress_step_title       = ( isset( $settings['litho_progress_step_title'] ) &&  $settings['litho_progress_step_title'] ) ? $settings['litho_progress_step_title'] : '';
			$progress_step_content     = ( isset( $settings['litho_progress_step_content'] ) &&  $settings['litho_progress_step_content'] ) ? $settings['litho_progress_step_content'] : '';
			$migrated                  = isset( $settings['__fa4_migrated']['litho_progress_step_icon'] );
			$is_new                    = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( empty( $progress_step_number ) && empty( $progress_step_title ) && empty( $progress_step_content ) ) {
				return;
			}
			
			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_progress_step_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_progress_step_icon']['value'] ) && ! empty( $settings['litho_progress_step_icon']['value'] ) ) {
				$icon .= '<i class="' . esc_attr( $settings['litho_progress_step_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			$litho_progress_step_image = '';
			if ( ! empty( $settings['litho_progress_step_image']['id'] ) ) {
				$srcset_data                   = litho_get_image_srcset_sizes( $settings['litho_progress_step_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_progress_step_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_progress_step_image']['id'], 'litho_thumbnail', $settings );
				$litho_progress_step_image_alt = Control_Media::get_image_alt( $settings['litho_progress_step_image'] );
				$litho_progress_step_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_progress_step_image_url ), esc_attr( $litho_progress_step_image_alt ), $srcset_data );

			} elseif ( ! empty( $settings['litho_progress_step_image']['url'] ) ) {
				$litho_progress_step_image_url = $settings['litho_progress_step_image']['url'];
				$litho_progress_step_image_alt = '';
				$litho_progress_step_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_progress_step_image_url ), esc_attr( $litho_progress_step_image_alt ) );
			}

			$this->add_render_attribute( 'wrapper', 'class', [ 'progress-step-box', $litho_progress_step_style ] );

			switch ( $litho_progress_step_style ) {
				case 'progress-step-style-1':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="progress-step-item">
							<span class="progress-step-item-bfr"></span>
							<div class="progress-step-item-box">
								<span class="progress-step-item-box-bfr progress-step-separator"></span>
								<div class="progress-step-icon">
									<span class="progress-step-icon-bfr"></span>
									<span class="progress-step-number">
										<span class="progress-step-number-bfr"></span><?php echo esc_html( $progress_step_number ); ?>
									</span>
								</div>
								<?php if ( ! empty( $progress_step_title ) || ! empty( $progress_step_content ) ) { ?>
									<div class="progress-content">
										<?php if ( ! empty( $progress_step_title ) ) { ?>
											<span class="progress-step-title"><?php echo esc_html( $progress_step_title ); ?></span>
										<?php } ?>
										<?php if ( ! empty( $progress_step_content ) ) { ?>
											<div class="progress-step-content"><?php echo sprintf( '%s', wp_kses_post( $progress_step_content ) ); ?></div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
					break;
				case 'progress-step-style-2':
				default:
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="progress-step-icon-box">
							<span class="progress-step-item-box-bfr progress-step-separator"></span>
							<?php if ( ! empty( $icon ) || ! empty( $litho_progress_step_image ) ) { ?>
								<div class="progress-step-icon">
									<?php
									if ( '' === $settings['litho_enable_custom_image'] ) {
										echo sprintf( '%s', $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									} elseif ( ! empty( $litho_progress_step_image ) ) { ?>
										<?php echo sprintf( '%s', $litho_progress_step_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
						<?php if ( ! empty( $progress_step_title ) ) { ?>
							<span class="progress-step-title"><?php echo esc_html( $progress_step_title ); ?></span>
						<?php } ?>
						<?php if ( ! empty( $progress_step_content ) ) { ?>
							<div class="progress-step-content"><?php echo sprintf( '%s', wp_kses_post( $progress_step_content ) ); ?></div>
						<?php } ?>
					</div>
					<?php
					break;
				case 'progress-step-style-3':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="progress-step-item">
							<div class="progress-step-item-box">
								<span class="progress-step-number-bfr progress-step-number"><?php echo esc_html( $progress_step_number ); ?></span>
								<span class="progress-step-item-box-bfr progress-step-separator"></span>
							</div>
							<?php if ( ! empty( $progress_step_title ) || ! empty( $progress_step_content ) ) { ?>
								<div class="progress-content">
									<?php if ( ! empty( $progress_step_title ) ) { ?>
										<span class="progress-step-title"><?php echo esc_html( $progress_step_title ); ?></span>
									<?php } ?>
									<?php if ( ! empty( $progress_step_content ) ) { ?>
										<div class="progress-step-content"><?php echo sprintf( '%s', wp_kses_post( $progress_step_content ) ); ?></div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php
					break;
				case 'progress-step-style-4':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="progress-step-item">
							<div class="progress-step-item-box">
								<span class="progress-step-item-box-bfr progress-step-separator"></span>
								<div class="progress-step-icon">
									<span class="progress-step-icon-bfr"></span>
									<span class="progress-step-number">
										<span class="progress-step-number-bfr"></span><?php echo esc_html( $progress_step_number ); ?>
									</span>
								</div>
								<?php if ( ! empty( $progress_step_title ) || ! empty( $progress_step_content ) ) { ?>
									<div class="progress-content">
										<?php if ( ! empty( $progress_step_title ) ) { ?>
											<span class="progress-step-title"><?php echo esc_html( $progress_step_title ); ?></span>
										<?php } ?>
										<?php if ( ! empty( $progress_step_content ) ) { ?>
											<div class="progress-step-content"><?php echo sprintf( '%s', wp_kses_post( $progress_step_content ) ); ?></div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
					break;
				case 'progress-step-style-5':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="progress-step-item">
							<div class="progress-step-item-box">
								<span class="progress-step-item-box-bfr progress-step-separator"></span>
								<div class="progress-step-icon">
									<span class="progress-step-icon-afr"></span>
									<span class="progress-step-number">
										<span class="progress-step-number-bfr"></span><?php echo esc_html( $progress_step_number ); ?>
									</span>
								</div>
								<?php if ( ! empty( $progress_step_title ) || ! empty( $progress_step_content ) ) { ?>
									<div class="progress-content">
										<?php if ( ! empty( $progress_step_title ) ) { ?>
											<span class="progress-step-title"><?php echo esc_html( $progress_step_title ); ?></span>
										<?php } ?>
										<?php if ( ! empty( $progress_step_content ) ) { ?>
											<div class="progress-step-content"><?php echo sprintf( '%s', wp_kses_post( $progress_step_content ) ); ?></div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
					break;
			}
		}
	}
}
