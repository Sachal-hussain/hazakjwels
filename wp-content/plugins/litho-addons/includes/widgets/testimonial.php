<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
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
 * Litho widget for testimonial.
 *
* @package Litho
 */

// If class `Testimonial` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Testimonial' ) ) {

	class Testimonial extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve testimonial widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-testimonial';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve testimonial widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Testimonial', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve testimonial widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-testimonial';
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
			return [ 'testimonial', 'blockquote' ];
		}

		/**
		 * Register testimonial widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_testimonial_general_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_testimonial_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'testimonials-style-1',
					'options'     	=> [
						'testimonials-style-1' => __( 'Style 1', 'litho-addons' ),
						'testimonials-style-2' => __( 'Style 2', 'litho-addons' ),
						'testimonials-style-3' => __( 'Style 3', 'litho-addons' ),
						'testimonials-style-4' => __( 'Style 4', 'litho-addons' ),
					],
					'label_block' 	=> true,
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_section_testimonial',
				[
					'label' 	=> __( 'Testimonial', 'litho-addons' ),
				]
			);
			$this->start_controls_tabs( 'litho_testimonial_tabs' );
			$this->start_controls_tab( 'litho_testimonial_image_tab', [ 'label' => __( 'Image', 'litho-addons' ) ] );
				$this->add_control(
					'litho_testimonial_image',
					[
						'label' 	=> __( 'Choose Image', 'litho-addons' ),
						'type' 		=> Controls_Manager::MEDIA,
						'dynamic'		=> [
								'active' => true,
							],
						'default' 	=> [
								'url'	=> Utils::get_placeholder_image_src(),
						],
					]
				);

				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' 		=> 'litho_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `litho_thumbnail_image_size` and `litho_thumbnail_custom_dimension`.
						'default' 	=> 'full',
						'exclude'	=> [ 'custom' ],
						'separator' => 'none',
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab( 'litho_testimonial_content_tab', [ 'label' => __( 'Content', 'litho-addons' ) ] );
			$this->add_control(
				'litho_testimonial_content',
				[
					'label' 	=> __( 'Content', 'litho-addons' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'rows' 		=> '10',
					'default' 	=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_testimonial_name',
				[
					'label' 	=> __( 'Name', 'litho-addons' ),
					'type' 		=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 	=> __( 'John Doe', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_link',
				[
					'label' 	=> __( 'Link', 'litho-addons' ),
					'type' 		=> Controls_Manager::URL,
					'dynamic'   => [
						'active' => true,
					],
					'placeholder' => __( 'https://your-link.com', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_testimonial_job',
				[
					'label' 		=> __( 'Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'Designer', 'litho-addons' ),
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab( 'litho_testimonial_icon_tab', [ 'label' => __( 'Icon', 'litho-addons' ) ] );
				$this->add_control(
					'litho_testimonial_icon',
					[
						'label'             => __( 'Icon', 'litho-addons' ),
						'type'              => Controls_Manager::ICONS,
						'fa4compatibility'  => 'icon',
						'default'           => [
								'value'         => 'fa-solid fa-quote-left',
								'library'       => 'fa-solid',
						],
					]
				);
				$this->add_control(
					'litho_testimonial_review_icon' ,
					[
						'label'		=> __( 'Review', 'litho-addons' ),
						'type'		=> Controls_Manager::SELECT,
						'default'	=> '2',
						'options'	=> [
							'1' 		=> __( '1 Star', 'litho-addons' ),
							'2' 		=> __( '2 Star', 'litho-addons' ),
							'3' 		=> __( '3 Star', 'litho-addons' ),
							'4' 		=> __( '4 Star', 'litho-addons' ),
							'5' 		=> __( '5 Star', 'litho-addons' ),
						],
						'frontend_available' => true,
						'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-3', 'testimonials-style-4' ] ] // IN
					]
				);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_section_settings',
				[
					'label' 		=> __( 'Settings', 'litho-addons' ),
					'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-1' ] ] // IN
				]
			);
			$this->add_control(
				'litho_show_separator',
				[
					'label'         => __( 'Show Separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __( 'Select Yes to show separator', 'litho-addons' ),
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-1' ] ] // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_general_style_section',
				[
					'label' => __( 'General', 'litho-addons' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);
			 $this->start_controls_tabs( 'litho_testimonial_box_tabs' );
				$this->start_controls_tab( 'litho_testimonial_box_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          	=> 'litho_testimonial_box_background',
							'types'     		=> [ 'classic', 'gradient' ],
							'exclude'       	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .testimonials',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_testimonial_box_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          	=> 'litho_testimonial_box_background_hover',
							'types'     		=> [ 'classic', 'gradient' ],
							'exclude'       	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .testimonials:hover',
						]
					);
					$this->add_control(
						'litho_testimonial_box_hover_transition',
						[
							'label' 		=> __( 'Transition Duration', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [ 'px' => [ 'max' => 3, 'step' => 0.1 ] ],
							'selectors' 	=> [
								'{{WRAPPER}} .testimonials' => 'transition-duration: {{SIZE}}s',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_testimonial_box_border',
					'selector'      => '{{WRAPPER}} .testimonials',
					'separator' 	=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_box_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonials' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_testimonial_box_shadow',
					'selector'      => '{{WRAPPER}} .testimonials',
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .testimonials .testimonials-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .testimonials .testimonials-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_testimonial_icon',
				[
					'label' 	=> __( 'Icon', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_testimonial_icon_tabs' );
				$this->start_controls_tab(
					'litho_testimonial_icon_normal_tab',
					[
						'label' 	=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_testimonial_icon_color',
						'selector' 	=> '{{WRAPPER}} .testimonials-rounded-icon i:before, {{WRAPPER}} .testimonials-rounded-icon svg',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'          	=> 'litho_testimonial_icon_box_background',
						'types'     		=> [ 'classic', 'gradient' ],
						'exclude'       	=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'      => '{{WRAPPER}} .testimonials-rounded-icon',
						'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-2' ] ] // IN
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_testimonial_icon_hover_tab',
					[
						'label' 	=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_testimonial_icon_hover_color',
						'selector' 	=> '{{WRAPPER}} .testimonials:hover .testimonials-rounded-icon i:before, {{WRAPPER}} .testimonials:hover .testimonials-rounded-icon svg',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'          	=> 'litho_testimonial_icon_box_hover_background',
						'types'     		=> [ 'classic', 'gradient' ],
						'exclude'       	=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'      => '{{WRAPPER}} .testimonials:hover .testimonials-rounded-icon',
						'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-2' ] ] // IN
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_testimonial_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .testimonials-rounded-icon, {{WRAPPER}} .testimonials-rounded-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .testimonials-rounded-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .testimonials-rounded-icon, {{WRAPPER}} .testimonials-rounded-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .testimonials-rounded-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			// Content.
			$this->start_controls_section(
				'litho_section_style_testimonial_content',
				[
					'label' 	=> __( 'Content', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_testimonial_content_typography',
					'selector' 	=> '{{WRAPPER}} .testimonial-content',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          	=> 'litho_testimonial_content_box_background',
					'types'     		=> [ 'classic', 'gradient' ],
					'exclude'       	=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} .testimonial-content',
					'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-4' ] ] // IN
				]
			);
			$this->add_control(
				'litho_testimonial_content_box_border_color',
				[
					'label' 	=> __( 'Box Border Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .testimonial-content'			=> 'border-color: {{VALUE}};',
						'{{WRAPPER}} .testimonial-content:before'	=> 'border-top-color: {{VALUE}};',
					],
					'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-4' ] ] // IN
				]
			);
			$this->start_controls_tabs( 'litho_testimonial_content_tabs' );
				$this->start_controls_tab(
					'litho_testimonial_content_normal_tab',
					[
						'label' 	=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_testimonial_content_color',
					[
						'label' 	=> __( 'Text Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonial-content' => 'color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_testimonial_content_hover_tab',
					[
						'label' 	=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_testimonial_content_hover_color',
					[
						'label' 	=> __( 'Text Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonials:hover .testimonial-content' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_testimonial_content_hover_animation',
					[
						'label' 		=> __( 'Hover Animation', 'litho-addons' ),
						'type'			=> Controls_Manager::HOVER_ANIMATION,
						'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-4' ] ] // IN
					]
				);
				$this->add_control(
					'litho_testimonial_content_hover_transition',
					[
						'label' 		=> __( 'Transition Duration', 'litho-addons' ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [ 'px' => [ 'max' => 3, 'step' => 0.1 ] ],
						'selectors' 	=> [
							'{{WRAPPER}} .testimonials-style-4 .testimonial-content:hover' => 'transition-duration: {{SIZE}}s',
						],
						'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-4' ] ] // IN
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_testimonial_content_box_shadow',
					'selector'      => '{{WRAPPER}} .testimonials-style-4 .testimonial-content',
					'condition'     => [ 'litho_testimonial_style' => [ 'testimonials-style-4' ] ], // IN
					'separator'		=> 'before'
				]
			);
			$this->end_controls_section();

			// Image.
			$this->start_controls_section(
				'litho_section_style_testimonial_image',
				[
					'label' 	=> __( 'Image', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
					'condition' => [
						'litho_testimonial_image[url]!' => '',
					],
				]
			);
			$this->add_control(
				'litho_image_size',
				[
					'label' 	=> __( 'Image Size', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' => 20,
							'max' => 1000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .testimonials-image-box img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'litho_image_border',
					'selector' 	=> '{{WRAPPER}} .testimonials-image-box img',
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_image_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::DIMENSIONS,
					'size_units'=> [ 'px', '%', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .testimonials-image-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			// Name.
			$this->start_controls_section(
				'litho_section_style_testimonial_name',
				[
					'label' 	=> __( 'Name', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_testimonial_name_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .testimonial-name',
				]
			);
			$this->start_controls_tabs( 'litho_testimonial_name_tabs' );
				$this->start_controls_tab(
					'litho_testimonial_name_normal_tab',
					[
						'label' 	=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_testimonial_name_color',
					[
						'label' 	=> __( 'Text Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonial-name' => 'color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_testimonial_name_hover_tab',
					[
						'label' 	=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_testimonial_name_hover_color',
					[
						'label' 	=> __( 'Text Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonials:hover .testimonial-name' => 'color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs(); 
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_testimonial_position',
				[
					'label' 	=> __( 'Position', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_testimonial_position_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .testimonial-position',
				]
			);
			$this->start_controls_tabs( 'litho_testimonial_position_tabs' );
				$this->start_controls_tab(
					'litho_testimonial_position_normal_tab',
					[
						'label'	 	=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_testimonial_position_color',
					[
						'label' 	=> __( 'Text Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonial-position' => 'color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_testimonial_position_hover_tab',
					[
						'label' 	=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_testimonial_position_hover_color',
					[
						'label' 	=> __( 'Text Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonials:hover .testimonial-position' => 'color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs(); 
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_separator_style_section',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_show_separator'		=> 'yes',
						'litho_testimonial_style'	=> 'testimonials-style-1', // IN
					]
				]
			);
			$this->add_control(
				'litho_testimonial_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .testimonials .separator-line' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_separator_thickness',
				[
					'label'         => __( 'Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'size'      => 1,
						'unit'      => 'px',
					],
					'size_units'    => [ 'px' ],
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 30 ] ],
					'selectors'     => [
						'{{WRAPPER}} .testimonials .separator-line' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_separator_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .testimonials .separator-line' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render testimonial widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			$icon = '';

			$litho_testimonial_style 	= ( isset( $settings['litho_testimonial_style'] ) && $settings['litho_testimonial_style'] ) ? $settings['litho_testimonial_style'] : '';
			$litho_testimonial_content 	= ( isset( $settings['litho_testimonial_content'] ) && $settings['litho_testimonial_content'] ) ? $settings['litho_testimonial_content'] : '';
			$litho_testimonial_name 	= ( isset( $settings['litho_testimonial_name'] ) && $settings['litho_testimonial_name'] ) ? $settings['litho_testimonial_name'] : '';
			$litho_testimonial_job 		= ( isset( $settings['litho_testimonial_job'] ) && $settings['litho_testimonial_job'] ) ? $settings['litho_testimonial_job'] : '';
			$litho_show_separator 		= ( isset( $settings['litho_show_separator'] ) && $settings['litho_show_separator'] ) ? $settings['litho_show_separator'] : '';
			$migrated 					= isset( $settings['__fa4_migrated']['litho_testimonial_icon'] );
			$is_new 					= empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			$litho_testimonial_image = '';
			if ( ! empty( $settings['litho_testimonial_image']['id'] ) ) {

				$srcset_data 					= litho_get_image_srcset_sizes( $settings['litho_testimonial_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_testimonial_image_url 	= Group_Control_Image_Size::get_attachment_image_src( $settings['litho_testimonial_image']['id'], 'litho_thumbnail', $settings );
				$litho_testimonial_image_alt 	= Control_Media::get_image_alt( $settings['litho_testimonial_image'] );
				$litho_testimonial_image 		= sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_testimonial_image_url ), esc_attr( $litho_testimonial_image_alt ), $srcset_data );

			} elseif ( ! empty( $settings['litho_testimonial_image']['url'] ) ) {
				
				$litho_testimonial_image_url 	= $settings['litho_testimonial_image']['url'];
				$litho_testimonial_image_alt 	= '';
				$litho_testimonial_image 		= sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_testimonial_image_url ), esc_attr( $litho_testimonial_image_alt ) );
			}

			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_testimonial_icon'], [ 'class' => 'testimonials-quotes', 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_testimonial_icon']['value'] ) && ! empty( $settings['litho_testimonial_icon']['value'] ) ) {
				$icon .= '<i class="testimonials-quotes ' . esc_attr( $settings['litho_testimonial_icon']['value'] ) . '" aria-hidden="true"></i>';
			}
			$this->add_render_attribute( 'wrapper', 'class', ['testimonials', $settings['litho_testimonial_style'] ] );
			
			if ( ! empty( $settings['litho_link']['url'] ) ) {

				$this->add_link_attributes( 'link', $settings['litho_link'] );
			}
			
			$this->add_render_attribute( '_content', 'class', 'testimonial-content' );

			switch ( $litho_testimonial_style ) {
				case 'testimonials-style-1':
				default:
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<?php
						if ( ! empty( $icon ) ) { ?>
							<div class="testimonials-rounded-icon"><?php
								echo sprintf( '%s', $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?></div>
						<?php
						}
						if ( ! empty( $litho_testimonial_content ) ) {
							?>
							<div <?php $this->print_render_attribute_string( '_content' ); ?>><?php
								echo sprintf( '%s', wp_kses_post( $litho_testimonial_content ) );
							?></div>
						<?php
						}
						if ( 'yes' === $litho_show_separator ) { ?>
							<div class="separator-line"></div>
						<?php } ?>
						<div class="author">
							<?php
							if ( ! empty( $litho_testimonial_image ) ) {
								?>
								<div class="testimonials-image-box">
									<?php echo sprintf( '%s', $litho_testimonial_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div><?php
							}
							?>
							<div class="align-middle author-main">
								<?php
								if ( ! empty( $settings['litho_link']['url'] ) ) {
									?>
									<a <?php $this->print_render_attribute_string( 'link' ); ?>>
								<?php
								}
								if ( ! empty( $litho_testimonial_name ) ) {
									?>
									<span class="testimonial-name"><?php
										echo esc_html( $litho_testimonial_name );
									?></span>
									<?php
									}
								if ( ! empty( $settings['litho_link']['url'] ) ) { ?>
									</a>
								<?php
								}
								if ( ! empty( $litho_testimonial_job ) ) { ?>
									<span class="testimonial-position"><?php
										echo esc_html( $litho_testimonial_job );
									?></span>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<?php
					break;
				case 'testimonials-style-2':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<?php
						if ( ! empty( $litho_testimonial_image ) ) {
							?>
							<div class="testimonials-image-box">
								<?php echo sprintf( '%s', $litho_testimonial_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div><?php
						}
						?>
						<div class="testimonials-content-wrap">
							<?php if ( ! empty( $icon ) ) { ?>
								<div class="testimonials-rounded-icon"><?php
									echo sprintf( '%s', $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?></div>
							<?php
							}
							if ( ! empty( $litho_testimonial_content ) ) {
								?>
								<div <?php $this->print_render_attribute_string( '_content' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									echo sprintf( '%s', wp_kses_post( $litho_testimonial_content ) );
								?></div>
							<?php
							}
							if ( ! empty( $settings['litho_link']['url'] ) ) {
								?>
								<a <?php $this->print_render_attribute_string( 'link' ); ?>>
							<?php
							}
							if ( ! empty( $litho_testimonial_name ) ) {
								?>
									<span class="testimonial-name"><?php
										echo esc_html( $litho_testimonial_name );
									?></span>
							<?php 
							}
							if ( ! empty( $settings['litho_link']['url'] ) ) {
								?>
								</a>
							<?php
							}
							if ( ! empty( $litho_testimonial_job ) ) { ?>
								<span class="testimonial-position"><?php
									echo esc_html( $litho_testimonial_job );
								?></span>
							<?php } ?>
						</div>
					</div>
				<?php
					break;
				case 'testimonials-style-3':
					$litho_testimonial_review_icon = ( isset( $settings['litho_testimonial_review_icon'] ) && ! empty( $settings['litho_testimonial_review_icon'] ) ) ? $settings['litho_testimonial_review_icon'] : '';
					$this->add_render_attribute( 'wrapper', 'class', ['testimonials-wrapper'] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
						if ( ! empty( $litho_testimonial_image ) ) {
							?>
							<div class="testimonials-image-box">
								<?php echo sprintf( '%s', $litho_testimonial_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div><?php
						}
						?>
						<div class="testimonials-content-wrap"><?php
							if ( ! empty( $litho_testimonial_review_icon ) && ! empty( $icon ) ) {
								?>
								<div class="testimonials-rounded-icon"><?php
									for ( $i=1; $i <= $litho_testimonial_review_icon; $i++ ) {
										echo sprintf( '%s', $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									}
								?></div><?php
							}
							if ( ! empty( $settings['litho_link']['url'] ) ) {
								?>
								<a <?php $this->print_render_attribute_string( 'link' ); ?>><?php
							}
							if ( ! empty( $litho_testimonial_name ) ) {
								?>
								<span class="testimonial-name"><?php
									echo esc_html( $litho_testimonial_name );
								?></span><?php 
							}
							if ( ! empty( $settings['litho_link']['url'] ) ) {
								?>
								</a><?php
							}
							if ( ! empty( $litho_testimonial_job ) ) {
								?>
								<span class="testimonial-position"><?php
									echo esc_html( $litho_testimonial_job );
								?></span>
							<?php
							}
							?>
						</div><?php
						if ( ! empty( $litho_testimonial_content ) ) {
							?>
							<div <?php $this->print_render_attribute_string( '_content' ); ?>><?php
								echo sprintf( '%s', wp_kses_post( $litho_testimonial_content ) );
							?></div><?php
						}
						?>
					</div>
					<?php
					break;
				case 'testimonials-style-4':
					$litho_testimonial_review_icon = ( isset( $settings['litho_testimonial_review_icon'] ) && ! empty( $settings['litho_testimonial_review_icon'] ) ) ? $settings['litho_testimonial_review_icon'] : '';

					if ( $this->get_settings( 'litho_testimonial_content_hover_animation' ) ) {
						$this->add_render_attribute( '_content', 'class', 'hvr-' . $this->get_settings( 'litho_testimonial_content_hover_animation' ) );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="testimonials-content-wrap"><?php
							if ( ! empty( $litho_testimonial_content ) ) {
								?>
								<div <?php $this->print_render_attribute_string( '_content' ); ?>><?php
									echo sprintf( '%s', wp_kses_post( $litho_testimonial_content ) );
								?></div><?php
							}
							?>
							<div class="testimonials-author-box"><?php
								if ( ! empty( $litho_testimonial_image ) ) {
									?>
									<div class="testimonials-image-box">
										<?php echo sprintf( '%s', $litho_testimonial_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div><?php
								}
								?>
								<div class="testimonials-author-details"><?php
									if ( ! empty( $settings['litho_link']['url'] ) ) {
										?>
										<a <?php $this->print_render_attribute_string( 'link' ); ?>><?php
									}
									if ( $litho_testimonial_name ) {
										?>
											<span class="testimonial-name"><?php
												echo esc_html( $litho_testimonial_name );
											?></span><?php
										}
										if ( ! empty( $settings['litho_link']['url'] ) ) {
											?>
										</a><?php
									}
									if ( ! empty( $litho_testimonial_job ) ) {
										?>
										<span class="testimonial-position"><?php
											echo esc_html( $litho_testimonial_job );
										?></span><?php
									}
									if ( ! empty( $litho_testimonial_review_icon ) && ! empty( $icon ) ) {
										?>
										<div class="testimonials-rounded-icon"><?php
											for ( $i=1; $i <= $litho_testimonial_review_icon; $i++ ) {
												echo sprintf( '%s', $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											}
											?>
										</div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
					break;
			}
		}
	}
}
