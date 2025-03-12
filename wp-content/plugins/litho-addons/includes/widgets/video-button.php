<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for video button.
 *
 * @package Litho
 */

// If class `Video_Button` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Video_Button' ) ) {

	class Video_Button extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve video button widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-video-button';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve video button widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Video Button', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve video button widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-play';
		}

		/**
		 * Retrieve the widget categories.
		 *
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
			return [ 'button', 'video', 'link', 'popup', 'lightbox' ];
		}

		/**
		 * Register video button widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_video_button_image_section',
				[
					'label' 		=> __( 'Image', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_video_button_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'video-button-style-1',
					'options'     	=> [
							'video-button-style-1' 		=> __( 'Style 1', 'litho-addons' ),
							'video-button-style-2'   	=> __( 'Style 2', 'litho-addons' ),
					],
					'label_block' 	=> false,
				]
			);
			$this->add_control(
				'litho_item_use_image',
				[
					'label'        	=> __( 'Use Image?', 'litho-addons' ),
					'type'         	=> Controls_Manager::SWITCHER,
					'label_on'     	=> __( 'Yes', 'litho-addons' ),
					'label_off'    	=> __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
				]
			);
			$this->add_control(
				'litho_item_icon',
				[
					'label'       	=> __( 'Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-play',
						'library' 		=> 'fa-solid',
					],
					'condition'   	=> [ 'litho_item_use_image' => '' ],
				]
			);
			$this->add_control(
				'litho_item_image',
				[
					'label'   		=> __( 'Image', 'litho-addons' ),
					'type'    		=> Controls_Manager::MEDIA,
					'dynamic'		=> [
						'active' => true,
					],
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator' 	=> 'none',
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_position',
				[
					'label' 		=> __( 'Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'video-icon-left',
					'options' 		=> [
						'video-icon-left' => [
							'title' 		=> __( 'Left', 'litho-addons' ),
							'icon' 			=> 'eicon-h-align-left',
						],
						'video-icon-top' => [
							'title' 		=> __( 'Top', 'litho-addons' ),
							'icon' 			=> 'eicon-v-align-top',
						],
						'video-icon-right' => [
							'title' 		=> __( 'Right', 'litho-addons' ),
							'icon' 			=> 'eicon-h-align-right',
						],
					],
					'conditions' 	=> [
						'terms' 	=> [
							[
								'name' 		=> 'litho_video_button_title',
								'operator' 	=> '!=',
								'value' 	=> '',
							],
						],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_video_button_section_title',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_video_button_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
				]
			);
			$this->add_control(
				'litho_video_link',
				[
					'label' 		=> __( 'Video URL', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_video_button_section_secondary_title',
				[
					'label' 		=> __( 'Secondary Title', 'litho-addons' ),
					'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ],
				]
			);
			$this->add_control(
				'litho_secondary_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_video_button_section_settings',
				[
					'label' 		=> __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_enable_button',
				[
					'label' 		=> __( 'Enable Button', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default'		=> 'yes',
					'label_on'      => __( 'Show', 'litho-addons' ),
					'label_off'     => __( 'Hide', 'litho-addons' ),
					'return_value' 	=> 'yes',
				]
			);
			$this->add_control(
				'litho_enable_sonar_animation',
				[
					'label' 		=> __( 'Enable Animation', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default'		=> 'yes',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'condition'     => [ 
						'litho_video_button_style' => [ 'video-button-style-1' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_video_button_box_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'center',
					'options'       => [
						'left'          => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'        => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'         => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .video-button-wrap' => 'text-align: {{VALUE}};',
					],
					'condition'     => [ 
						'litho_video_button_style' => [ 'video-button-style-1' ], // IN
					],
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_video_button_icon_section_style',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'lightbox_ui_color',
				[
					'label' => __( 'Close Button Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .mfp-close, .litho-video-popup .mfp-close' => 'color: {{VALUE}} !important',
					],
				]
			);

			$this->add_control(
				'lightbox_ui_color_hover',
				[
					'label' => __( 'Close Button Hover Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .mfp-close:hover, .litho-video-popup .mfp-close:hover' => 'color: {{VALUE}} !important',
					],
					'separator' => 'after',
				]
			);
			$this->add_responsive_control(
				'litho_video_button_icon_size',
				[
					'label'         => __( 'Size', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom'],
					'range'         => [ 'px'   => [ 'min' => 10, 'max' => 200 ] ],
					'selectors'     => [
						'{{WRAPPER}} .video-button-style-1 .video-icon, {{WRAPPER}} .video-button-style-2 .video-icon-box i' => 'font-size: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .video-icon-box .video-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [
						'litho_item_use_image' => ''
					],
				]
			);
			$this->add_responsive_control(
				'litho_video_button_icon_box_size',
				[
					'label'         => __( 'Icon box size', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 20, 'max' => 400 ] ],
					'selectors'     => [
						'{{WRAPPER}} .video-button-style-1 .video-icon' 			=> 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .video-button-style-1 .video-icon-sonar-bfr'	=> 'height: calc( {{SIZE}}{{UNIT}} + 30px ); width: calc( {{SIZE}}{{UNIT}} + 30px )',
					],
					'condition'     => [
						'litho_video_button_style' => [ 'video-button-style-1' ], // IN
					],
				]
			);
			$this->start_controls_tabs( 'litho_video_button_icon_tabs' );
				$this->start_controls_tab( 'litho_video_button_icon_normal_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' 				=> 'litho_video_button_icon_color',
							'fields_options'    => [ 'background' => [ 'label' => __( 'Icon Color', 'litho-addons' ) ] ],
							'selector' 			=> '{{WRAPPER}} .video-button-style-1 .video-icon i, {{WRAPPER}} .video-button-style-1 .video-icon svg, {{WRAPPER}} .video-button-style-2 .video-icon-box i, {{WRAPPER}} .video-button-style-2 .video-icon-box svg',
							'condition'   	=> [ 'litho_item_use_image' => '' ],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          	=> 'litho_video_button_icon_bg_color',
							'types'     		=> [ 'classic', 'gradient' ],
							'exclude'       	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      	=> '{{WRAPPER}} .video-button-style-1 .video-icon-box .video-icon, {{WRAPPER}} .video-icon .video-icon-sonar .video-icon-sonar-bfr, {{WRAPPER}} .video-button-style-2 .litho-popup-wrapper',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_video_button_icon_hover_tab',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' 				=> 'litho_video_button_icon_hover_color',
							'fields_options'    => [ 'background' => [ 'label' => __( 'Icon Color', 'litho-addons' ) ]],
							'selector' 			=> '{{WRAPPER}} .video-button-style-1 .video-icon-box:hover .video-icon i, {{WRAPPER}} .video-button-style-2 .video-icon-box:hover i, {{WRAPPER}} .video-button-style-1 .video-icon-box:hover .video-icon svg, {{WRAPPER}} .video-button-style-2 .video-icon-box:hover svg',
							'condition'   	=> [ 'litho_item_use_image' => '' ],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_video_button_icon_hover_bg_color',
							'types'     		=> [ 'classic', 'gradient' ],
							'exclude'       	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .video-button-style-1 .video-icon-box:hover .video-icon, {{WRAPPER}} .video-button-style-2  .video-icon-box:hover',
						]
					);
					$this->add_control(
						'litho_video_button_icon_hover_border_color',
						[
							'label'     => __( 'Border Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .video-icon-box:hover' => 'border-color: {{VALUE}};',
							],
							'condition'     => [ 
								'litho_video_button_style' => [ 'video-button-style-2' ], // IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_video_button_img_icon_style_heading',
				[
					'label'     => __( 'Image style', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'condition' => [ 'litho_item_use_image' => 'yes' ],
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_video_button_img_icon_size',
				[
					'label'		=> __( 'Width', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
						'unit'	=> '%',
					],
					'size_units'=> [ 'px', '%', 'custom' ],
					'range'		=> [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'	=> [
						'{{WRAPPER}} .video-button-style-1 .video-icon img' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_video_button_box_border',
					'selector' 		=> '{{WRAPPER}} .video-icon-box',
					'fields_options'=> [ 'border' => [ 'separator' => 'before' ] ],
					'condition'     => [ 
						'litho_video_button_style' => [ 'video-button-style-2' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_video_button_box_border_radius',
				[
					'label'			=> __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .video-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_video_button_style' => [ 'video-button-style-2' ], // IN
					],
				]
			);

			$this->add_responsive_control(
				'litho_video_button_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .video-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_video_button_style' => [ 'video-button-style-2' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_video_button_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .video-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_video_button_box_shadow',
					'selector'      => '{{WRAPPER}} .video-button-style-1 .video-icon, {{WRAPPER}} .video-button-style-2 .video-icon-box',
				]
			);
			$this->add_responsive_control(
				'litho_video_icon_margin',
				[
					'label'         => __( 'Icon Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .video-icon-box .video-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_video_button_style' => [ 'video-button-style-1' ], // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_video_button_title_section_style',
				[
					'label' 		=> __( 'Primary Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_video_button_title_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .video-title',
				]
			);
			$this->start_controls_tabs( 'litho_video_button_title_tabs' );
				$this->start_controls_tab( 'litho_video_button_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_video_button_title_color',
						[
							'label'     	=> __( 'Color', 'litho-addons' ),
							'type'      	=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .video-title' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_video_button_title_border',
							'selector'      => '{{WRAPPER}} .video-icon-box .video-title',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_video_button_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_video_button_title_hover_color',
						[
							'label'     	=> __( 'Color', 'litho-addons' ),
							'type'      	=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .video-icon-box:hover .video-title' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_video_button_title_hover_border',
							'selector'      => '{{WRAPPER}} .video-icon-box:hover .video-title',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_video_button_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .video-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_video_button_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .video-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ], // IN
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_video_button_secondary_title_section_style',
				[
					'label' 		=> __( 'Secondary Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_video_button_secondary_title_typography',
					'global'	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .video-subtitle',
					'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ], // IN
				]
			);
			$this->start_controls_tabs( 'litho_video_button_secondary_title_tabs' );
				$this->start_controls_tab( 'litho_video_button_secondary_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_video_button_secondary_title_color',
						[
							'label'     	=> __( 'Color', 'litho-addons' ),
							'type'      	=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .video-subtitle' => 'color: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ], // IN
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_video_button_secondary_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_video_button_secondary_title_hover_color',
						[
							'label'     	=> __( 'Color', 'litho-addons' ),
							'type'      	=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .video-icon-box:hover .video-subtitle' => 'color: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ], // IN
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_video_button_secondary_title_border',
					'selector'      => '{{WRAPPER}} .video-subtitle',
					'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ], // IN
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_video_button_secondary_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .video-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_video_button_style' => 'video-button-style-2' ], // IN
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render video button widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings            = $this->get_settings_for_display();
			$litho_video_link    = $this->get_settings( 'litho_video_link' );
			$litho_enable_button = ( isset( $settings['litho_enable_button'] ) && $settings['litho_enable_button'] ) ? $settings['litho_enable_button'] : '';
			$migrated            = isset( $settings['__fa4_migrated']['litho_item_icon'] );
			$is_new              = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			
			$icon = '';
			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
				$icon .= '<i class="' . esc_attr( $settings['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			$litho_item_image = '';
			if ( ! empty( $settings['litho_item_image']['id'] ) ) {
				$srcset_data          = litho_get_image_srcset_sizes( $settings['litho_item_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_item_image']['id'], 'litho_thumbnail', $settings );
				$litho_item_image_alt = Control_Media::get_image_alt( $settings['litho_item_image'] );
				$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );
			} elseif ( ! empty( $settings['litho_item_image']['url'] ) ) {
				$litho_item_image_url = $settings['litho_item_image']['url'];
				$litho_item_image_alt = '';
				$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
			}

			$link_url = ( isset( $litho_video_link ) && ! empty( $litho_video_link ) ) ? $litho_video_link : 'javascript:void(0);';

			$this->add_render_attribute( [
				'wrapper' => [
					'class' => [ 'video-button-wrap', $settings['litho_video_button_style'], $settings['litho_position'] ],
				]
			] );
			$this->add_render_attribute( [
				'icon_sonar' => [
					'class' => [ 'video-icon-sonar-bfr' ],
				]
			] );

			$this->add_render_attribute( 'url', 'href', $link_url );
			$this->add_render_attribute( 'url', 'class', [ 'video-icon-box', 'litho-popup-wrapper' ] );

			if ( isset( $litho_video_link ) && ! empty( $litho_video_link ) ) {
				$this->add_render_attribute( 'url', 'class', [ 'popup-youtube' ] );
			}

			if ( '' == $litho_enable_button ) {
				return;
			}

			switch ( $settings['litho_video_button_style'] ) {
				case 'video-button-style-1':
				default:
					if ( ! empty( $litho_item_image ) || ! empty( $icon ) || ! empty( $settings['litho_video_button_title'] ) ) {
						?>
						<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
							<?php if ( $link_url ) { ?>
								<a <?php $this->print_render_attribute_string( 'url' ); ?>>
							<?php } ?>
							<?php if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) { ?>
								<span class="video-icon">
									<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; // phpcs:ignore ?>
									<?php if ( 'yes' === $settings['litho_enable_sonar_animation'] ) { ?>
										<span class="video-icon-sonar">
											<span <?php $this->print_render_attribute_string( 'icon_sonar' ); ?>></span>
										</span>
									<?php } ?>
								</span>
							<?php } ?>
							<?php 
								if ( ! empty( $settings['litho_video_button_title'] ) ) {
									echo sprintf( '<div class="video-title">%s</div>', $settings['litho_video_button_title'] ); // phpcs:ignore
								}
							?>
							<?php if ( $link_url ) { ?>
							</a>
							<?php } ?>
						</div>
					<?php
					}
					break;
				case 'video-button-style-2':
					if ( ! empty( $litho_item_image ) || ! empty( $icon ) || ! empty( $settings['litho_video_button_title'] ) ) {
						?>
						<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
							<?php if ( $link_url ) { ?>
								<a <?php $this->print_render_attribute_string( 'url' ); ?>>
							<?php } ?>
							<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; // phpcs:ignore ?>
							<?php 
								if ( ! empty( $settings['litho_video_button_title'] ) || ! empty( $settings['litho_secondary_title'] ) ) {
									echo sprintf( '<div class="video-button-text"><span class="video-title">%1$s</span><span class="video-subtitle">%2$s</span></div>', $settings['litho_video_button_title'], $settings['litho_secondary_title'] ); // phpcs:ignore
								}
							?>
							<?php if ( $link_url ) { ?>
							</a>
							<?php } ?>
						</div>
						<?php
					}
					break;
			}
		}
	}
}
