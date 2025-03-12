<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Button_Group_Control;
use LithoAddons\Controls\Groups\Icon_Group_Control;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for content block.
 *
 * @package Litho
 */

// If class `Content_Block` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Content_Block' ) ) {

	class Content_Block extends Widget_Base {

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
			return 'litho-content-block';
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
			return __( 'Litho Content Block', 'litho-addons' );
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
			return 'eicon-post-info';
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
		 * Register content block widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_content_block_general_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_content_block_style',
				[
					'label'         => __( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'block-style-1',
					'options'       => [
						'block-style-1'     => __( 'Style 1', 'litho-addons' ),
						'block-style-2'     => __( 'Style 2', 'litho-addons' ),
						'block-style-3'     => __( 'Style 3', 'litho-addons' ),
						'block-style-4'     => __( 'Style 4', 'litho-addons' ),
						'block-style-5'     => __( 'Style 5', 'litho-addons' ),
					],
					'frontend_available'    => true,
				]
			);
			$this->add_control(
				'litho_content_block_image',
				[
					'label'         => __( 'Image', 'litho-addons' ),
					'type'          => Controls_Manager::MEDIA,
					'dynamic'		=> [
								'active' => true,
							],
					'default'       => [
						'url'       => Utils::get_placeholder_image_src(),
					],
					'condition'     => [ 'litho_content_block_style' => [ 'block-style-2', 'block-style-3', 'block-style-4' ] ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'          => 'litho_thumbnail',
					'default'       => 'full',
					'exclude'	=> [ 'custom' ],
					'separator'     => 'none',
					'condition'     => [ 'litho_content_block_style' => [ 'block-style-2', 'block-style-3', 'block-style-4' ] ], // IN
				]
			);
			$this->add_control(
				'litho_content_block_image_position',
				[
					'label'     => __( 'Image Position', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'top',
					'options'   => [
						'left' => [
							'title' => __( 'Left', 'litho-addons' ),
							'icon'  => 'eicon-h-align-left',
						],
						'top' => [
							'title' => __( 'Top', 'litho-addons' ),
							'icon'  => 'eicon-v-align-top',
						],
						'right' => [
							'title' => __( 'Right', 'litho-addons' ),
							'icon'  => 'eicon-h-align-right',
						],
					],
					'prefix_class'  => 'elementor-position-',
					'toggle'        => false,
					'condition'     => [ 'litho_content_block_style' => [ 'block-style-3' ] ], // IN
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_content_block_title_section',
				[
					'label'		=> __( 'Title', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_content_block_title',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' => true
					],
					'label_block'   => true,
					'default'       => __( 'Write title here', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_link_on_title',
				[
					'label'         => __( 'Link on Title?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_off'     => __( 'No', 'litho-addons' ),
					'label_on'      => __( 'Yes', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_content_block_title_link',
				[
					'label'         => __( 'Link', 'litho-addons' ),
					'type'          => Controls_Manager::URL,
					'dynamic'       => [
						'active' => true,
					],
					'placeholder'   => __( 'https://your-link.com', 'litho-addons' ),
					'default'       => [
						'url'           => '#',
					],
					'condition'     => [ 'litho_link_on_title!' => '' ],
				]
			);
			$this->add_control(
				'litho_header_size',
				[
					'label' 		=> __( 'HTML Tag', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'h1'   => 'H1',
						'h2'   => 'H2',
						'h3'   => 'H3',
						'h4'   => 'H4',
						'h5'   => 'H5',
						'h6'   => 'H6',
						'div'  => 'div',
						'span' => 'span',
						'p'    => 'p',
					],
					'default' 		=> 'div',
				]
			);
			$this->add_control(
				'litho_content_block_label',
				[
					'label'         => __( 'Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' => true
					],
					'label_block'   => true,
					'condition'     => [
						'litho_content_block_title!' 	=> '',
						'litho_content_block_style' 	=> [ 'block-style-3' ], // IN
					]
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_content_block_subtitle_section',
				[
					'label'		=> __( 'Subtitle', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_content_block_subtitle',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'type'          => Controls_Manager::TEXTAREA,
					'dynamic' 		=> [
						'active' => true
					],
					'show_label'	=> false,
					'rows'          => '5',
					'default'       => __( 'Write subtitle here.', 'litho-addons' ),
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_content_block_content_section',
				[
					'label'		=> __( 'Content', 'litho-addons' ),
					'condition'	=> [ 'litho_content_block_style!' => [ 'block-style-5' ] ], // Not IN
				]
			);
			$this->add_control(
				'litho_content_block_content',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'type'          => Controls_Manager::WYSIWYG,
					'dynamic'       => [
						'active' => true,
					],
					'show_label'	=> false,
					'default'       => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_content_block_icon_image_section',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'condition'     => [ 'litho_content_block_style' => [ 'block-style-1' ] ], // IN
				]
			);
			Icon_Group_Control::icon_fields( $this );
			$this->end_controls_section();

			Button_Group_Control::button_content_fields( $this, 'primary', __( 'Button', 'litho-addons' ) );

			$this->start_controls_section(
				'litho_content_block_settings_section',
				[
					'label'         => __( 'Settings', 'litho-addons' ),
					'condition'     => [ 'litho_content_block_style' => [ 'block-style-2' ] ], // IN
				]
			);
			$this->add_control(
				'litho_show_separator',
				[
					'label'         => __( 'Horizontal Separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [ 'litho_content_block_style' => [ 'block-style-2' ] ], // IN
				]
			);
			$this->add_control(
				'litho_show_vertical_separator',
				[
					'label'         => __( 'Vertical Separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
					'condition'     => [ 'litho_content_block_style' => [ 'block-style-2' ] ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_content_block_general_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_content_block_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'left',
					'options'       => [
						'left'          => [
							'title'         => __( 'Left', 'litho-addons' ),
							'icon'          => 'eicon-text-align-left',
						],
						'center'        => [
							'title'         => __( 'Center', 'litho-addons' ),
							'icon'          => 'eicon-text-align-center',
						],
						'right'         => [
							'title'         => __( 'Right', 'litho-addons' ),
							'icon'          => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .content-block, {{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-content' => 'text-align: {{VALUE}};',
					],
					'condition'     => [ 'litho_content_block_style!' => [ 'block-style-4' ] ], // NOT IN
				]
			);
			$this->add_control(
				'litho_content_block_vertical_alignment',
				[
					'label'     => __( 'Vertical Alignment', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => [
						'top'       => __( 'Top', 'litho-addons' ),
						'middle'    => __( 'Middle', 'litho-addons' ),
						'bottom'    => __( 'Bottom', 'litho-addons' ),
					],
					'default'   	=> 'top',
					'prefix_class' 	=> 'elementor-vertical-align-',
					'condition'     => [
						'litho_content_block_image_position!' => [ 'top' ],
						'litho_content_block_style' => [ 'block-style-3' ], // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_content_block_box_background',
					'selector'      => '{{WRAPPER}} .content-block .content-wrap, {{WRAPPER}} .content-block .elementor-image-box-content',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_content_block_box_shadow',
					'selector'      => '{{WRAPPER}} .content-block .content-wrap, {{WRAPPER}} .content-block .elementor-image-box-content',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_content_block_box_border',
					'selector'      => '{{WRAPPER}} .content-block .content-wrap, {{WRAPPER}} .content-block .elementor-image-box-content',
				]
			);
			$this->add_responsive_control(
				'litho_content_block_box_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .content-wrap, {{WRAPPER}} .content-block .elementor-image-box-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_width',
				[
					'label'     => __( 'Block Width', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'default'   => [
						'size' => 575,
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 2000,
						],
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .content-title-wrap' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'	=> [
						'litho_content_block_style' => 'block-style-5', // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_content_block_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .content-wrap, {{WRAPPER}} .content-block .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_content_block_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .content-wrap, {{WRAPPER}} .content-block .elementor-image-box-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_content_block_section_style_image',
				[
					'label'     => __( 'Image', 'litho-addons' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition'	=> [ 'litho_content_block_style' => [ 'block-style-3' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_content_block_image_space',
				[
					'label'     => __( 'Spacing', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 15,
					],
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-position-right .elementor-image-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-left .elementor-image-box-img' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-top .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'(mobile){{WRAPPER}} .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_image_size',
				[
					'label'     => __( 'Width', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 30,
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'%' => [
							'min' => 5,
							'max' => 100,
						],
						'px' => [
							'min' => 1,
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_content_block_image_box_shadow',
					'selector'      => '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img img',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_content_block_image_border',
					'selector'      => '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img img',
				]
			);
			$this->add_responsive_control(
				'litho_content_block_image_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_content_block_image_effects' );
				$this->start_controls_tab(
					'litho_content_block_image_normal',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					[
						'name'      => 'litho_content_block_image_css_filters',
						'selector'  => '{{WRAPPER}} .elementor-image-box-img img',
					]
				);
				$this->add_control(
					'litho_content_block_image_opacity',
					[
						'label'     => __( 'Opacity', 'litho-addons' ),
						'type'      => Controls_Manager::SLIDER,
						'range'     => [
								'px'    => [
									'max'   => 1,
									'min'   => 0.10,
									'step'  => 0.01,
								],
						],
						'selectors' => [
							'{{WRAPPER}} .elementor-image-box-img img' => 'opacity: {{SIZE}};',
						],
					]
				);
				$this->add_control(
					'litho_content_block_image_background_hover_transition',
					[
						'label' => __( 'Transition Duration', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => 0.3,
						],
						'range' => [
							'px' => [
								'max' => 3,
								'step' => 0.1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .elementor-image-box-img img' => 'transition-duration: {{SIZE}}s',
						],
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_content_block_image_hover',
				[
					'label'     => __( 'Hover', 'litho-addons' ),
				]
			);
				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					[
						'name'      => 'litho_content_block_image_css_filters_hover',
						'selector'  => '{{WRAPPER}}:hover .elementor-image-box-img img',
					]
				);
				$this->add_control(
					'litho_content_block_image_opacity_hover',
					[
						'label'     => __( 'Opacity', 'litho-addons' ),
						'type'      => Controls_Manager::SLIDER,
						'range'     => [
								'px'    => [
									'max'   => 1,
									'min'   => 0.10,
									'step'  => 0.01,
								],
						],
						'selectors' => [
							'{{WRAPPER}}:hover .elementor-image-box-img img' => 'opacity: {{SIZE}};',
						],
					]
				);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_content_block_title_style_section',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_content_block_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .content-block .title, {{WRAPPER}} .content-block .title a',
				]
			);
			$this->add_control(
				'litho_content_block_title_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .title, {{WRAPPER}} .content-block .title a:not(:hover)' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_content_block_title_hover_color',
				[
					'label'         => __( 'Hover Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .title-link:hover' => 'color: {{VALUE}};',
					],
					'condition'     => [ 'litho_link_on_title!' => '' ],
				]
			);
			$this->add_control(
				'litho_content_block_title_hover_transition',
				[
					'label' => __( 'Transition Duration', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 0.3,
					],
					'range' => [
						'px' => [
							'max' => 3,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .content-block .title-link' => 'transition-duration: {{SIZE}}s',
					],
					'condition'     => [ 'litho_link_on_title!' => '' ],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_content_block_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_content_block_label_heading',
				[
					'label'     => __( 'Label', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_content_block_label_typography',
					'selector'  => '{{WRAPPER}} .content-block .label',
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_content_block_label_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .label'  => 'color: {{VALUE}};',
					],
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_content_block_label_bg_color',
				[
					'label'         => __( 'Background Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .label'  => 'background-color: {{VALUE}};',
					],
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_content_block_label_box_shadow',
					'selector'      => '{{WRAPPER}} .content-block .label',
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_content_block_label_box_border',
					'selector'      => '{{WRAPPER}} .content-block .label',
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_label_box_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_label_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .label'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_content_block_label_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .label'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_content_block_label!'	=> '',
						'litho_content_block_style'	=> [ 'block-style-3' ] // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_content_block_subtitle_style_section',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_content_block_subtitle_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => '',
					'options'       => [
						'left'          => [
							'title'         => __( 'Left', 'litho-addons' ),
							'icon'          => 'eicon-text-align-left',
						],
						'center'        => [
							'title'         => __( 'Center', 'litho-addons' ),
							'icon'          => 'eicon-text-align-center',
						],
						'right'         => [
							'title'         => __( 'Right', 'litho-addons' ),
							'icon'          => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .subtitle' => 'text-align: {{VALUE}};',
					],
					'condition'     => [
						'litho_content_block_style' => [ 'block-style-4' ], // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_content_block_subtitle_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .content-block .subtitle',
				]
			);
			$this->add_control(
				'litho_content_block_subtitle_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .subtitle'  => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_content_block_subtitle_bg_color',
				[
					'label'         => __( 'Background Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .subtitle'  => 'background-color: {{VALUE}};',
					],
					'condition'     => [ 'litho_content_block_style'  => [ 'block-style-2' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_content_block_subtitle_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .subtitle'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_content_block_style'  => [ 'block-style-2' ] ], // IN
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_content_block_subtitle_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .subtitle'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_content_block_style'  => [ 'block-style-2' ] ], // IN
				]
			);

			$this->add_control(
				'litho_content_block_subtitle_separator_color',
				[
					'label'         => __( 'Separator Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .subtitle' => 'border-right-color: {{VALUE}};',
					],
					'separator' 	=> 'before',
					'condition'     => [ 'litho_content_block_style'  => [ 'block-style-4' ] ], // IN
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_content_block_content_style_section',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_content_block_style!'  => [ 'block-style-5' ] ], // NOT IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_content_typography',
					'selector'	=> '{{WRAPPER}} .content-block .content',
				]
			);
			$this->add_control(
				'litho_content_block_content_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .content'   => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_content_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'size'      => '',
						'unit'      => 'px',
					],
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px' => [ 'min' => 50, 'max' => 500 ], '%' => [ 'min' => 10, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .content' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_content_block_style!' => [ 'block-style-4' ], // NOT IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_content_block_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .content-wrap'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_content_block_style'  => [ 'block-style-2' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_content_block_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .content-wrap'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_content_block_style'  => [ 'block-style-2' ] ], // IN
				]
			);
			$this->end_controls_section();

			Button_Group_Control::button_style_fields( $this, 'primary', __( 'Button', 'litho-addons' ) );

			$this->start_controls_section(
				'litho_content_block_separator_style_section',
				[
					'label'         => __( 'Horizontal Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_content_block_style'   => [ 'block-style-2' ], // IN
						'litho_show_separator'        => [ 'yes' ],
					],
				]
			);
			$this->add_control(
				'litho_content_block_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .content-block .separator-line' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_separator_thickness',
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
						'{{WRAPPER}} .content-block .separator-line' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_separator_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .separator-line' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_content_block_vertical_separator_style_section',
				[
					'label'         => __( 'Vertical Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_content_block_style'       => [ 'block-style-2' ], // IN
						'litho_show_vertical_separator'   => [ 'yes' ],
					],
				]
			);
			$this->add_control(
				'litho_content_block_vertical_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .content-block .vertical-separator' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_block_vertical_separator_thickness',
				[
					'label'         => __( 'Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px' ],
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 10 ] ],
					'selectors'     => [
						'{{WRAPPER}} .content-block .vertical-separator' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render content block widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$litho_content_block_image = '';
			$settings                  = $this->get_settings_for_display();
			$content_style             = ( isset( $settings['litho_content_block_style'] ) && $settings['litho_content_block_style'] ) ? $settings['litho_content_block_style'] : 'block-style-1';
			$title                     = ( isset( $settings['litho_content_block_title'] ) && $settings['litho_content_block_title'] ) ? $settings['litho_content_block_title'] : '';
			$label                     = ( isset( $settings['litho_content_block_label'] ) && $settings['litho_content_block_label'] ) ? $settings['litho_content_block_label'] : '';
			$subtitle                  = ( isset( $settings['litho_content_block_subtitle'] ) && $settings['litho_content_block_subtitle'] ) ? $settings['litho_content_block_subtitle'] : '';
			$content                   = ( isset( $settings['litho_content_block_content'] ) && $settings['litho_content_block_content'] ) ? $settings['litho_content_block_content'] : '';
			$link_on_title             = ( isset( $settings['litho_link_on_title'] ) && $settings['litho_link_on_title'] ) ? $settings['litho_link_on_title'] : '';
			$show_separator            = ( isset( $settings['litho_show_separator'] ) && $settings['litho_show_separator'] ) ? $settings['litho_show_separator'] : '';
			$show_vertical_separator   = ( isset( $settings['litho_show_vertical_separator'] ) && $settings['litho_show_vertical_separator'] ) ? $settings['litho_show_vertical_separator'] : '';

			$this->add_render_attribute(
				'wrapper', 'class', [ 'content-block', 'content-' . $content_style ]
			);

			$this->add_render_attribute( 'content_block_title', 'class', 'title' );

			if ( ! empty( $settings['litho_content_block_title_link']['url'] ) ) {

				$this->add_link_attributes( '_link', $settings['litho_content_block_title_link'] );
				$this->add_render_attribute( '_link', 'class', 'title-link' );
			}

			$this->add_render_attribute( 'content_block_subtitle', 'class', 'subtitle' );
			$this->add_render_attribute( 'content_block_content', 'class', 'content' );

			if ( ! empty( $settings['litho_content_block_image']['id'] ) ) {

				$srcset_data                   = litho_get_image_srcset_sizes( $settings['litho_content_block_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_content_block_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_content_block_image']['id'], 'litho_thumbnail', $settings );
				$litho_content_block_image_alt = Control_Media::get_image_alt( $settings['litho_content_block_image'] );
				$litho_content_block_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_content_block_image_url ), esc_attr( $litho_content_block_image_alt ), $srcset_data );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			} elseif ( ! empty( $settings['litho_content_block_image']['url'] ) ) {
				$litho_content_block_image_url = $settings['litho_content_block_image']['url'];
				$litho_content_block_image_alt = '';
				$litho_content_block_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_content_block_image_url ), esc_attr( $litho_content_block_image_alt ) );
			}
			?>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>>
				<?php
				switch ( $content_style ) {
					case 'block-style-1':
						?>
						<div class="content-wrap"><?php
							echo Icon_Group_Control::render_icon_content( $this );
							if ( ! empty( $subtitle ) ) {
								?><div <?php $this->print_render_attribute_string( 'content_block_subtitle' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									echo esc_html( $subtitle );
								?></div><?php
							}
							if ( ! empty( $title ) ) {
								?><<?php echo $this->get_settings( 'litho_header_size'); ?> <?php $this->print_render_attribute_string( 'content_block_title' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php 
									if ( 'yes' === $link_on_title ) {
										?><a <?php $this->print_render_attribute_string( '_link' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									}
									echo esc_html( $title );
									if ( 'yes' === $link_on_title ) {
										?></a><?php
									}
								?></<?php echo $this->get_settings( 'litho_header_size'); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							if ( ! empty( $content ) ) {
								?><div <?php $this->print_render_attribute_string( 'content_block_content' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									echo sprintf( '%s', wp_kses_post( $content ) );
								?></div><?php
							}
							Button_Group_Control::render_button_content( $this, 'primary' );
						?></div>
						<?php
						break;
					case 'block-style-2':
						echo sprintf( '%s', $litho_content_block_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
						<div class="content-wrap"><?php
							if ( 'yes' === $show_vertical_separator ) {
								?><span class="vertical-separator"></span><?php
							}
							if ( ! empty( $subtitle ) ) {
								?><div <?php $this->print_render_attribute_string( 'content_block_subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									echo esc_html( $subtitle );
								?></div><?php
							}
							if ( ! empty( $title ) ) {
								?><<?php echo $this->get_settings( 'litho_header_size'); ?> <?php $this->print_render_attribute_string( 'content_block_title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									if ( 'yes' === $link_on_title ) {
										?><a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									}
									echo esc_html( $title );
									if ( 'yes' === $link_on_title ) {
										?></a><?php
									}
								?></<?php echo $this->get_settings( 'litho_header_size'); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							if ( ! empty( $content ) ) {
								?><div <?php $this->print_render_attribute_string( 'content_block_content' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									echo sprintf( '%s', wp_kses_post( $content ) );
								?></div><?php
							}
							if ( 'yes' === $show_separator ) {
								?><div class="width-100 separator-line"></div><?php
							}
							Button_Group_Control::render_button_content( $this, 'primary' );
						?></div>
						<?php
						break;
					case 'block-style-3':
						?>
						<div class="elementor-image-box-wrapper"><?php
							if ( ! empty( $litho_content_block_image ) ) {
								?><div class="elementor-image-box-img">
									<?php echo sprintf( '%s', $litho_content_block_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div><?php
							}
							?><div class="elementor-image-box-content"><?php
								if ( ! empty( $subtitle ) ) {
									?><div <?php $this->print_render_attribute_string( 'content_block_subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
										echo esc_html( $subtitle );
									?></div><?php
								}
								if ( ! empty( $title ) ) {
									?><<?php echo $this->get_settings( 'litho_header_size'); ?> <?php $this->print_render_attribute_string( 'content_block_title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										if ( 'yes' === $link_on_title ) {
											?><a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>><?php
										}
										echo esc_html( $title );
										if ( 'yes' === $link_on_title ) {
											?></a><?php
										}
										if ( ! empty( $label ) ) {
											?><span class="label"><?php
												echo esc_html( $label );
											?></span><?php
										}
									?></<?php echo $this->get_settings( 'litho_header_size'); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}
								if ( ! empty( $content ) ) {
									?><div <?php $this->print_render_attribute_string( 'content_block_content' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>><?php
										echo sprintf( '%s', wp_kses_post( $content ) );
									?></div><?php
								}
								Button_Group_Control::render_button_content( $this, 'primary' );
							?></div>
						</div>
						<?php
						break;
					case 'block-style-4':
						echo sprintf( '%s', $litho_content_block_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
						<div class="content-wrap d-flex align-items-center justify-content-center"><?php
							if ( ! empty( $subtitle ) ) {
								?><h5 <?php $this->print_render_attribute_string( 'content_block_subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									echo esc_html( $subtitle );
								?></h5><?php
							}
							?><div class="d-inline-block align-top content-box"><?php
								if ( ! empty( $title ) ) {
									?><<?php echo $this->get_settings( 'litho_header_size'); ?> <?php $this->print_render_attribute_string( 'content_block_title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										if ( 'yes' === $link_on_title ) {
											?><a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
										}
										echo esc_html( $title );
										if ( 'yes' === $link_on_title ) {
											?></a><?php
										}
									?></<?php echo $this->get_settings( 'litho_header_size'); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}
								if ( ! empty( $content ) ) {
									?><div <?php $this->print_render_attribute_string( 'content_block_content' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
										echo sprintf( '%s', wp_kses_post( $content ) );
									?></div><?php
								}
								Button_Group_Control::render_button_content( $this, 'primary' );
							?></div>
						</div>
						<?php
						break;
					case 'block-style-5':
						?>
						<div class="content-wrap"><?php
							if ( ! empty( $title ) && ! empty( $subtitle ) ) { ?>
								<div class="content-title-wrap"><?php
							}
								if ( ! empty( $title ) ) {
									?><<?php echo $this->get_settings( 'litho_header_size'); ?> <?php $this->print_render_attribute_string( 'content_block_title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										if ( 'yes' === $link_on_title ) {
											?><a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
										}
										echo esc_html( $title );
										if ( 'yes' === $link_on_title ) {
											?></a><?php
										}
									?></<?php echo $this->get_settings( 'litho_header_size'); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}

								if ( ! empty( $subtitle ) ) {
									?><span <?php $this->print_render_attribute_string( 'content_block_subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
										echo esc_html( $subtitle );
									?></span><?php
								}
							if ( ! empty( $title ) && ! empty( $subtitle ) ) { ?>
								</div><?php
							}
							Button_Group_Control::render_button_content( $this, 'primary' );
						?></div>
						<?php
						break;
				}
			?>
			</div>
			<?php
		}
	}
}
