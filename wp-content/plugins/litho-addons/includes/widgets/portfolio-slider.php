<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for portfolio slider.
 *
* @package Litho
 */

// If class `Portfolio_Slider` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Portfolio_Slider' ) ) {

	class Portfolio_Slider extends Widget_Base {

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
			return 'litho-portfolio-slider';
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
			return __( 'Litho Portfolio Slider', 'litho-addons' );
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
			return 'eicon-posts-carousel';
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
			return [ 'portfolio', 'gallery', 'slider', 'project', 'carousel', 'lightbox', 'popup' ];
		}

		/**
		 * Register portfolio slider widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 *
		 * @access protected
		 */

		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_portfolio_section_content',
				[
					'label'         => __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_portfolio_style',
				[
					'label'         => __( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'portfolio-slider-style-1',
					'options'       => [
						'portfolio-slider-style-1'		=> __( 'Style 1', 'litho-addons' ),
						'portfolio-slider-style-2'		=> __( 'Style 2', 'litho-addons' ),
						'portfolio-slider-style-3'		=> __( 'Style 3', 'litho-addons' ),
						'portfolio-slider-style-4'		=> __( 'Style 4', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_portfolio_type_selection',
				[
					'label'     => __( 'Type of Selection', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'	=> 'portfolio-category',
					'options'   => [
						'portfolio-category'	=> __( 'Category', 'litho-addons' ),
						'portfolio-tags' 		=> __( 'Tags', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_portfolio_categories_list',
				[
					'label'			=> __( 'Categories', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_portfolio_category_array' ) ) ? litho_portfolio_category_array() : [],
					'condition'     => [
						'litho_portfolio_type_selection' => 'portfolio-category',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_tags_list',
				[
					'label'         => __( 'Tags', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_portfolio_tags_array' ) ) ? litho_portfolio_tags_array() : [],
					'condition'     => [
						'litho_portfolio_type_selection' => 'portfolio-tags',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_settings',
				[
					'label'			=> __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_portfolio_tilt_box',
				[
					'label'			=> __( 'Enable Tilt box', 'litho-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'Yes', 'litho-addons' ),
					'label_off'		=> __( 'No', 'litho-addons' ),
					'return_value'	=> 'yes',
					'default'		=> 'yes',
					'condition'		=> [
						'litho_portfolio_style' => [ 'portfolio-slider-style-1' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_portfolio_post_per_page',
				[
					'label'     => __( 'Number of posts to show', 'litho-addons' ),
					'type'      => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'   => 8,
				]
			);
			$this->add_control(
				'litho_thumbnail',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'full',
					'options' => ( function_exists( 'litho_get_thumbnail_image_sizes' ) ) ? litho_get_thumbnail_image_sizes() : [],
					'style_transfer'=> true,
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_title',
				[
					'label'         => __( 'Show Title', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_subtitle',
				[
					'label'         => __( 'Show Subtitle', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			
			$this->add_control(
				'litho_portfolio_show_custom_link',
				[
					'label'         => __( 'Show Link', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);

			$this->add_control(
				'litho_portfolio_orderby',
				[
					'label'         => __( 'Posts order by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'date',
					'options'       => [
						'date'          => __( 'Date', 'litho-addons' ),
						'ID'            => __( 'ID', 'litho-addons' ),
						'author'        => __( 'Author', 'litho-addons' ),
						'title'         => __( 'Title', 'litho-addons' ),
						'modified'      => __( 'Modified', 'litho-addons' ),
						'rand'          => __( 'Random', 'litho-addons' ),
						'comment_count' => __( 'Comment count', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_portfolio_order',
				[
					'label'     => __( 'Posts sort by', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'DESC',
					'options'   => [                        
						'DESC'      => __( 'Descending', 'litho-addons' ),
						'ASC'       => __( 'Ascending', 'litho-addons' ),
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_custom_link_icon_section',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'condition'         => [
						'litho_portfolio_show_custom_link' => 'yes',
						'litho_portfolio_style' => [ 'portfolio-slider-style-2', 'portfolio-slider-style-3' ], // IN
					],
				]
			);

			$this->add_control(
				'litho_portfolio_custom_link_icon',
				[
					'label'             => __( 'Icon', 'litho-addons' ),
					'type'              => Controls_Manager::ICONS,
					'fa4compatibility'  => 'icon',
					'default'           => [
							'value'         => 'fa-solid fa-link',
							'library'       => 'fa-solid',
					],
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_image_carousel_setting',
				[
					'label' 		=> __( 'Slider Configuration', 'litho-addons' ),
				]
			);
			$slides_to_show = range( 1, 10 );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
			$this->add_responsive_control(
				'litho_slides_to_show',
				[
					'label' 		=> __( 'Slides to Show', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 5,
					'options' 		=> [
						'' 			=> __( 'Default', 'litho-addons' ),
					] + $slides_to_show,
					'condition' 	=> [
						'litho_portfolio_style!' => [ 'portfolio-slider-style-1', 'portfolio-slider-style-2', 'portfolio-slider-style-4' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_image_stretch',
				[
					'label' 		=> __( 'Image Stretch', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
				]
			);
			$this->add_control(
				'litho_items_spacing',
				[
					'label'      	=> __( 'Items Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 500 ] ],
					'default' 		=> [ 'unit' => 'px', 'size' => 30 ],
				]
			);
			$this->add_control(
				'litho_navigation',
				[
					'label' 	=> __( 'Navigation', 'litho-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'dots',
					'options' 	=> [
						'arrows' 	=> __( 'Arrows', 'litho-addons' ),
						'dots' 		=> __( 'Dots', 'litho-addons' ),
						'none'		=> __( 'None', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_pause_on_hover',
				[
					'label' 		=> __( 'Pause on Hover', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
				]
			);
			$this->add_control(
				'litho_centered_slides',
				[
					'label' 		=> __( 'Center Slide', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-slider-style-4', // IN
					],
				]
			);
			$this->add_control(
				'litho_autoplay',
				[
					'label' 		=> __( 'Autoplay', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
				]
			);
			$this->add_control(
				'litho_autoplay_speed',
				[
					'label' 		=> __( 'Autoplay Speed', 'litho-addons' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 3000,
				]
			);
			$this->add_control(
				'litho_infinite',
				[
					'label' 		=> __( 'Infinite Loop', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
				]
			);
			$this->add_control(
				'litho_effect',
				[
					'label' 		=> __( 'Effect', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'slide',
					'options' 		=> [
						'slide' 	=> __( 'Slide', 'litho-addons' ),
						'fade' 		=> __( 'Fade', 'litho-addons' ),
					],
					'condition' 	=> [ 'litho_slides_to_show' => '1' ],
				]
			);
			$this->add_control(
				'litho_speed',
				[
					'label' 		=> __( 'Animation Speed', 'litho-addons' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 500,
				]
			);
			$this->add_control(
				'litho_rtl',
				[
					'label' 		=> __( 'RTL', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'ltr',
					'options' 		=> [
						''		=> __( 'Default', 'litho-addons' ),
						'ltr'	=> __( 'Left', 'litho-addons' ),
						'rtl' 	=> __( 'Right', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_slider_cursor',
				[
					'label' 		=> __( 'Cursor', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'' 				=> __( 'Default', 'litho-addons' ),
						'white-cursor'	=> __( 'White Cursor', 'litho-addons' ),
						'black-cursor' 	=> __( 'Black Cursor', 'litho-addons' ),
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_arrows_options',
				[
					'label' 		=> __( 'Arrows', 'litho-addons' ),
					'condition'		=> [
						'litho_navigation' => [ 'arrows' ],
					],
				]
			);
			$this->add_control(
				'litho_left_arrow_icon',
				[
					'label'       	=> __( 'Left Arrow Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-chevron-left',
						'library' 		=> 'fa-solid',
					],
					'condition' => [
						'litho_navigation' => [ 'arrows' ],
					],
				]
			);
			$this->add_control(
				'litho_right_arrow_icon',
				[
					'label'       	=> __( 'Right Arrow Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-chevron-right',
						'library' 		=> 'fa-solid',
					],
					'condition' => [
						'litho_navigation' => [ 'arrows' ],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_general_style',
				[
					'label'             => __( 'General', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'show_label'        => false,
					'condition'		=> [
						'litho_portfolio_style!'	=> 'portfolio-slider-style-4', // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_content_box_alignment',
				[
					'label'             => __( 'Text  Alignment', 'litho-addons' ),
					'type'              => Controls_Manager::CHOOSE,
					'label_block'       => false,
					'default'           => 'center',
					'options'           => [
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
					],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-caption' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_content_box_heading',
				[
					'label'         => __( 'Content Box', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_portfolio_content_box_bg_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .portfolio-item .portfolio-caption, {{WRAPPER}} .portfolio-colorful .portfolio-item .portfolio-caption',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_portfolio_content_box_shadow',
					'selector'      => '{{WRAPPER}} .portfolio-item .portfolio-caption',
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_content_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_content_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_slide_style',
				[
					'label'             => __( 'Slide', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'show_label'        => false,
					'condition'		=> [
						'litho_portfolio_style'	=> 'portfolio-slider-style-4', // IN
					],
				]
			);
			$this->add_control(
				'litho_slide_opacity',
				[
					'label' 		=> __( 'Slide Opacity', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' 	=> 1,
							'step' 	=> 0.01,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide'  => 'opacity: {{SIZE}};',
					],
					'condition'		=> [
						'litho_portfolio_style'	=> 'portfolio-slider-style-4', // IN
					],
				]
			);
			$this->add_control(
				'litho_active_slide_opacity',
				[
					'label' 		=> __( 'Active Slide Opacity', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' 	=> 1,
							'step' 	=> 0.01,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide.swiper-slide-active'  => 'opacity: {{SIZE}};',
					],
					'condition'		=> [
						'litho_portfolio_style'	=> 'portfolio-slider-style-4', // IN
					],
				]
			);

			$this->add_responsive_control(
				'litho_slide_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'allowed_dimensions' => 'horizontal',
					'placeholder'   => [
						'top'       => 'auto',
						'right'     => '',
						'bottom'    => 'auto',
						'left'      => '',
					],
					'selectors'     => [
						'{{WRAPPER}} .swiper-slide .swiper-slide-inner' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
					],
					'condition'		=> [
						'litho_portfolio_style'	=> 'portfolio-slider-style-4', // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_portfolio_image_box_shadow',
					'selector'      => '{{WRAPPER}} .portfolio-item',
					'condition'		=> [
						'litho_portfolio_style'	=> 'portfolio-slider-style-4', // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_title_style',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'		=> [
						'litho_portfolio_show_post_title'	=> 'yes',
						'litho_portfolio_style!'			=> 'portfolio-slider-style-4', // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .portfolio-caption .title',
				]
			);
			$this->start_controls_tabs( 'litho_portfolio_title_tabs' );
				$this->start_controls_tab( 'litho_portfolio_title_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style!' => [ 'portfolio-slider-style-2' ], // NOT IN
						],
					] );
					$this->add_control(
						'litho_portfolio_title_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-item .portfolio-caption .title'		=> 'color: {{VALUE}};',
								'{{WRAPPER}} .portfolio-item .portfolio-caption .title a'	=> 'color: {{VALUE}};',
							]
						]
					);  
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_portfolio_title_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style!' => [ 'portfolio-slider-style-2' ], // NOT IN
						],
					] );
					$this->add_control(
						'litho_portfolio_title_hover_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-item .portfolio-caption .title a:hover' => 'color: {{VALUE}};',
								'{{WRAPPER}} .portfolio-slider-style-1 .portfolio-item .portfolio-caption .title:hover' => 'color: {{VALUE}};',
								'{{WRAPPER}} .portfolio-item .portfolio-caption .slider-title-hover' => 'background-color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_portfolio_style!' => [ 'portfolio-slider-style-2' ], // NOT IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_portfolio_title_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'default'       => 'move-bottom-top-self',
					'options'       => [
						''						=> __( 'None', 'litho-addons' ),
						'move-bottom-top-self'	=> __( 'Move Bottom Top Self', 'litho-addons' ),
						'move-top-bottom-self'	=> __( 'Move Top Bottom Self', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-slider-style-2' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_subtitle_style',
				[
					'label'             => __( 'Subtitle', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'show_label'        => false,
					'condition'		=> [
						'litho_portfolio_show_post_subtitle'	=> 'yes',
						'litho_portfolio_style!'				=> 'portfolio-slider-style-4', // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_subtitle_typography',
					'selector'	=> '{{WRAPPER}} .portfolio-caption .subtitle',
				]
			);

			$this->add_control(
				'litho_portfolio_subtitle_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .portfolio-item .portfolio-caption .subtitle' => 'color: {{VALUE}};',
					]
				]
			);
				
			$this->add_control(
				'litho_portfolio_subtitle_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'default'       => 'move-bottom-top-self',
					'options'       => [
						''						=> __( 'None', 'litho-addons' ),
						'move-bottom-top-self'	=> __( 'Move Bottom Top Self', 'litho-addons' ),
						'move-top-bottom-self'	=> __( 'Move Top Bottom Self', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-slider-style-2' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_overlay_style',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition' 	=> [
						'litho_portfolio_style!' => [ 'portfolio-slider-style-1', 'portfolio-slider-style-4' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_overlay_icon_v_alignment',
				[
					'label'             => __( 'Vertical Alignment', 'litho-addons' ),
					'type'              => Controls_Manager::CHOOSE,
					'label_block'       => false,
					'default'           => '',
					'options'           => [
						'flex-start'      => [
							'title'     => __( 'Top', 'litho-addons' ),
							'icon'      => 'eicon-v-align-top',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-v-align-middle',
						],
						'flex-end'     => [
							'title'     => __( 'Bottom', 'litho-addons' ),
							'icon'      => 'eicon-v-align-bottom',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-item .portfolio-hover' => 'align-items: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_overlay_icon_h_alignment',
				[
					'label'             => __( 'Horizontal Alignment', 'litho-addons' ),
					'type'              => Controls_Manager::CHOOSE,
					'label_block'       => false,
					'default'           => '',
					'options'           => [
						'flex-start'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-h-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-h-align-center',
						],
						'flex-end'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-h-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-item .portfolio-hover' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_portfolio_overlay_color',
					'fields_options'    => [ 'background' => [ 'label' => __( 'Overlay Color', 'litho-addons' ) ]],
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'			=> '{{WRAPPER}} .portfolio-item .portfolio-image',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_icons_style',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'		=> [
						'litho_portfolio_show_custom_link' => 'yes',
						'litho_portfolio_style!' => [ 'portfolio-slider-style-1', 'portfolio-slider-style-4' ], // NOT IN
					]
				]
			);

			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label'		=> __( 'Size', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'range'		=> [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .portfolio-item .portfolio-hover .portfolio-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator'			=> 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_portfolio_icons_background',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .portfolio-swiper-slider .portfolio-item .portfolio-icon a',
					'condition'		=> [
						'litho_portfolio_style' => 'portfolio-slider-style-3', // IN
					],
				]
			);
			$this->start_controls_tabs( 'litho_portfolio_icons_tabs' );
				$this->start_controls_tab( 'litho_portfolio_icons_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style' => 'portfolio-slider-style-3', // IN
						],
					] );
					$this->add_control(
						'litho_portfolio_icons_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-item .portfolio-hover .portfolio-icon i' => 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_portfolio_icons_hover_tab', 
					[
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style' => 'portfolio-slider-style-3', // IN
						],
					] );
					$this->add_control(
						'litho_portfolio_icons_hover_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-item .portfolio-hover .portfolio-icon a:hover i' => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_portfolio_style' => 'portfolio-slider-style-3', // IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_portfolio_icon_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'default'       => 'move-right-left',
					'options'       => [
						''						=> __( 'None', 'litho-addons' ),
						'move-top-bottom'		=> __( 'Move Top Bottom', 'litho-addons' ),
						'move-bottom-top'		=> __( 'Move Bottom Top', 'litho-addons' ),
						'move-left-right'		=> __( 'Move Left Right', 'litho-addons' ),
						'move-right-left'		=> __( 'Move Right Left', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-slider-style-2', // IN
					],
				]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'           => 'litho_portfolio_icons_border',
					'selector'       => '{{WRAPPER}} .portfolio-item .portfolio-hover .portfolio-icon a',
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-slider-style-3', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_icons_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'default'       => [
						'unit'      => '%',
						'top'       => 50,
						'right'     => 50,
						'bottom'    => 50,
						'left'      => 50,
					],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-item .portfolio-hover .portfolio-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-slider-style-3', // IN
					],
				]
			);
			
			$this->end_controls_section();			

			$this->start_controls_section(
				'litho_section_style_navigation',
				[
					'label' 			=> __( 'Navigation', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_navigation!' => [ 'none' ] ],
				]
			);
			$this->add_control(
				'litho_heading_style_arrows',
				[
					'label' 		=> __( 'Arrows', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'			=> [ 'px'   => [ 'min' => 20, 'max' => 60 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev i, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_spacing',
				[
					'label' 		=> __( 'Bottom Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'			=> [ 'px'   => [ 'min' => 0, 'max' => 200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .portfolio-swiper-slider' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-slider-style-3', // IN
						'litho_navigation' 	=> [ 'arrows' ]
					],
				]
			);
			$this->start_controls_tabs( 'arrows_style_tabs' );
				$this->start_controls_tab(
					'litho_arrows_style_normal_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_navigation' => [ 'arrows' ],
						],
					]
				);
				$this->add_control(
					'litho_arrows_color',
					[
						'label'			=> __( 'Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'selectors'		=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next svg' => 'fill: {{VALUE}};',
						],
						'condition'		=> [
							'litho_navigation' => [ 'arrows' ],
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'			=> 'litho_arrows_background',
						'types'			=> [ 'classic', 'gradient' ],
						'exclude'		=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'		=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
						'condition'		=> [
							'litho_navigation' => [ 'arrows' ],
						],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_border',
						'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
						'condition'		=> [
							'litho_navigation' => [ 'arrows' ],
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'			=> 'litho_arrows_box_shadow',
						'selector'		=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
						'condition'		=> [
							'litho_navigation' => [ 'arrows' ],
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_arrows_style_hover_tab',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_navigation' => [ 'arrows' ],
						],
					]
				);
				$this->add_control(
					'litho_arrows_hover_color',
					[
						'label'			=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg' => 'fill: {{VALUE}};',
						],
						'condition' 	=> [
							'litho_navigation' => [ 'arrows' ],
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'			=> 'litho_arrows_hover_background',
						'types'			=> [ 'classic', 'gradient' ],
						'exclude'		=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'		=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_hover_border',
						'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'          => 'litho_arrows_hover_box_shadow',
						'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_arrows_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before',
					'condition'		=> [
						'litho_navigation' => [ 'arrows' ],
					],
				]
			);
			$this->add_control(
				'litho_heading_style_dots',
				[
					'label' 		=> __( 'Dots', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
				]
			);
			$this->add_control(
				'litho_dots_position',
				[
					'label' 		=> __( 'Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'outside',
					'options' 		=> [
						'outside' 		=> __( 'Outside', 'litho-addons' ),
						'inside' 		=> __( 'Inside', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-pagination-position-',
					'condition' 	=> [ 'litho_navigation' 	=> [ 'dots' ] ],
				]
			);
			$this->add_control(
				'litho_dots_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'			=> [ 'px'   => [ 'min' => 5, 'max' => 10 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' 	=> [ 'dots' ] ],
				]
			);
			$this->add_control(
				'litho_dots_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'			=> [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-pagination-position-outside .swiper' => 'padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [ 
						'litho_navigation' 	=> [ 'dots' ],
						'litho_dots_position'	=> 'outside'
					],
				]
			);
			$this->add_control(
				'litho_dots_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
					],
					'condition' 	=> [ 'litho_navigation' 	=> [ 'dots' ] ],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render portfolio slider widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                           = $this->get_settings_for_display();
			$is_new                             = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$custom_link_icon_migrated          = isset( $settings['__fa4_migrated']['litho_portfolio_custom_link_icon'] );

			$portfolio_style                    = ( isset( $settings['litho_portfolio_style'] ) && $settings['litho_portfolio_style'] ) ? $settings['litho_portfolio_style'] : '';
			$portfolio_type_selection           = ( isset( $settings['litho_portfolio_type_selection'] ) && $settings['litho_portfolio_type_selection'] ) ? $settings['litho_portfolio_type_selection'] : 'portfolio-category';
			$portfolio_categories_list          = ( isset( $settings['litho_portfolio_categories_list'] ) && $settings['litho_portfolio_categories_list'] ) ?  $settings['litho_portfolio_categories_list'] : array();
			$portfolio_tags_list                = ( isset( $settings['litho_portfolio_tags_list'] ) && $settings['litho_portfolio_tags_list'] ) ?  $settings['litho_portfolio_tags_list'] : array();
			$portfolio_post_per_page            = ( isset( $settings['litho_portfolio_post_per_page'] ) && $settings['litho_portfolio_post_per_page'] ) ? $settings['litho_portfolio_post_per_page'] : 8;
			$portfolio_title_hover_animation    = ( isset( $settings['litho_portfolio_title_hover_animation'] ) && $settings['litho_portfolio_title_hover_animation'] ) ? ' hvr-' . $settings['litho_portfolio_title_hover_animation'] : '';
			$portfolio_subtitle_hover_animation = ( isset( $settings['litho_portfolio_subtitle_hover_animation'] ) && $settings['litho_portfolio_subtitle_hover_animation'] ) ? ' hvr-' . $settings['litho_portfolio_subtitle_hover_animation'] : '';
			$portfolio_icon_hover_animation     = ( isset( $settings['litho_portfolio_icon_hover_animation'] ) && $settings['litho_portfolio_icon_hover_animation'] ) ? ' hvr-' . $settings['litho_portfolio_icon_hover_animation'] : '';
			$portfolio_show_post_title          = ( isset( $settings['litho_portfolio_show_post_title'] ) && $settings['litho_portfolio_show_post_title'] ) ? $settings['litho_portfolio_show_post_title'] : '';
			$portfolio_show_post_subtitle       = ( isset( $settings['litho_portfolio_show_post_subtitle'] )&& $settings['litho_portfolio_show_post_subtitle'] ) ? $settings['litho_portfolio_show_post_subtitle'] : '';
			$portfolio_orderby                  = ( isset( $settings['litho_portfolio_orderby'] ) && $settings['litho_portfolio_orderby'] ) ? $settings['litho_portfolio_orderby'] : '';
			$portfolio_order                    = ( isset( $settings['litho_portfolio_order'] ) && $settings['litho_portfolio_order'] ) ? $settings['litho_portfolio_order'] : '';

			if ( 'portfolio-tags' === $portfolio_type_selection ) {
				$categories_to_display_ids = ( ! empty( $portfolio_tags_list ) ) ? $portfolio_tags_list : array();
			} else {
				$categories_to_display_ids = ( ! empty( $portfolio_categories_list ) ) ? $portfolio_categories_list : array();
			}

			// If no categories are chosen or "All categories", we need to load all available categories
			if ( ! is_array( $categories_to_display_ids ) || 0 === count( $categories_to_display_ids ) ) {

				$terms = get_terms( $portfolio_type_selection );

				if ( ! is_array( $categories_to_display_ids ) ) {
					$categories_to_display_ids = array();
				}
				foreach ( $terms as $term ) {
					$categories_to_display_ids[] = $term->slug;
				}
			} else {
				$categories_to_display_ids = array_values( $categories_to_display_ids );
			}

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' ); 
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' ); 
			} else {
				$paged = 1;
			}

			$query_args = array(
				'post_type'      => 'portfolio',
				'post_status'    => 'publish',
				'posts_per_page' => intval( $portfolio_post_per_page ),
				'paged'          => $paged,
			);
			if ( ! empty( $categories_to_display_ids ) ) {
				$query_args['tax_query'] = [
					[
						'taxonomy' => $portfolio_type_selection,
						'field'    => 'slug',
						'terms'    => $categories_to_display_ids
				   ],
				];
			}

			if ( ! empty( $portfolio_orderby ) ) {
				$query_args['orderby'] = $portfolio_orderby;
			}

			if ( ! empty( $portfolio_order ) ) {
				$query_args['order'] = $portfolio_order;
			}
			
			$portfolio_query          = new \WP_Query( $query_args );
			$slides_count             = $portfolio_query->post_count;
			$litho_rtl                = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor      = $this->get_settings( 'litho_slider_cursor' );
			$litho_portfolio_tilt_box = $this->get_settings( 'litho_portfolio_tilt_box' );

			$sliderConfig = array(
				'navigation'     => $this->get_settings( 'litho_navigation' ),
				'autoplay'       => $this->get_settings( 'litho_autoplay' ),
				'autoplay_speed' => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover' => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'           => $this->get_settings( 'litho_infinite' ),
				'effect'         => $this->get_settings( 'litho_effect' ),
				'speed'          => $this->get_settings( 'litho_speed' ),
				'image_spacing'  => $this->get_settings( 'litho_items_spacing' ),
				'slider-style'   => $portfolio_style
			);

			$slideOptions = array();

			switch ( $portfolio_style ) {
				case 'portfolio-slider-style-1':
				case 'portfolio-slider-style-2':
					$slideOptions = array(
						'slides_to_show'        => 'auto',
						'slides_to_show_mobile' => 'auto',
						'slides_to_show_tablet' => 'auto'
					);
					break;
				case 'portfolio-slider-style-4':
					$slideOptions = array(
						'centered_slides'		=> $this->get_settings( 'litho_centered_slides' ),
						'slides_to_show'        => 'auto',
						'slides_to_show_mobile' => 'auto',
						'slides_to_show_tablet' => 'auto'
					);
					
					break;
				default:
					$slideOptions = array(
						'slides_to_show'        => $this->get_settings( 'litho_slides_to_show' ),
						'slides_to_show_mobile' => $this->get_settings( 'litho_slides_to_show_mobile' ),
						'slides_to_show_tablet' => $this->get_settings( 'litho_slides_to_show_tablet' )
					);
					break;
			} 

			$slideSettingsArray = array_merge( $sliderConfig, $slideOptions  );

			$this->add_render_attribute( [
				'carousel-wrapper' => [
					'class'         => [
						'portfolio-swiper-slider',
						'swiper',
						$portfolio_style,
						$litho_slider_cursor,
					],
					'data-settings' => json_encode( $slideSettingsArray ),
				],
				'carousel' => [
					'class' => 'swiper-wrapper',
				],
			] );


			if ( 'portfolio-slider-style-1' === $portfolio_style ) {
				$this->add_render_attribute( [
					'carousel-wrapper' => [
						'class' => 'full-screen-height'
					],
				] );
			}

			if ( ! empty( $litho_rtl ) ) {
				$this->add_render_attribute( 'carousel-wrapper', 'dir', $litho_rtl );
			}

			if ( 'yes' ===  $this->get_settings( 'litho_image_stretch' ) ) {
				$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
			}

			$litho_portfolio_tilt_box_start_wrapper = $litho_portfolio_tilt_box_end_wrapper = '';
			switch ( $portfolio_style ) {
				case 'portfolio-slider-style-1':
					if ( 'yes' === $litho_portfolio_tilt_box ) {
						/* Add class in wrapper DIV */
						$this->add_render_attribute( '_wrapper', 'class', [ 'portfolio-tile-box-slider' ] );

						$litho_portfolio_tilt_box_start_wrapper .= '<div class="tilt-box">';
						$litho_portfolio_tilt_box_end_wrapper .= '</div>';
					}
					break;
				case 'portfolio-slider-style-2':
					$this->add_render_attribute( 'carousel-wrapper', [
						'class' => [ 
							'portfolio-colorful'
						],
					] );
					break;
			}

			if ( $portfolio_query->have_posts() ) { ?>
				<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
					<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
						<?php
						$index = 0;
						while ( $portfolio_query->have_posts() ) :
							$portfolio_query->the_post();

							$figure_wrap_key = 'figure_wrap_' . $index;
							$inner_wrap_key  = 'inner_wrap_' . $index;
							$custom_link_key = 'custom_link_' . $index;
							$litho_subtitle  = litho_post_meta( 'litho_subtitle' );
							$has_post_format = litho_post_meta( 'litho_portfolio_post_type' );
							
							if ( 'link' == $has_post_format || has_post_format( 'link', get_the_ID() ) ) {

								$portfolio_external_link = litho_post_meta( 'litho_portfolio_external_link' );
								$portfolio_link_target   = litho_post_meta( 'litho_portfolio_link_target' );
								$portfolio_external_link = ( ! empty( $portfolio_external_link ) ) ? $portfolio_external_link : '#' ;
								$portfolio_link_target   = ( ! empty( $portfolio_link_target ) ) ? $portfolio_link_target : '_self';
							} else {
								$portfolio_external_link = get_permalink() ;
								$portfolio_link_target   = '_self';
							}

							$this->add_render_attribute( $custom_link_key, [
								'href'   => $portfolio_external_link,
								'target' => $portfolio_link_target
							] );

							$litho_subtitle = ( $litho_subtitle ) ? str_replace( '||', '<br />', $litho_subtitle ) : '';
							
							$this->add_render_attribute( $inner_wrap_key, [
								'class' => [ 'portfolio-item', 'swiper-slide' ]
							] );

							switch ( $portfolio_style ) {
								case 'portfolio-slider-style-1':
									?>
									<div <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
										<?php echo sprintf( '%s', $litho_portfolio_tilt_box_start_wrapper ); // phpcs:ignore ?>
											<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
											<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>>
											<?php } ?>
												<figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
													<div class="portfolio-image">
														<?php $this->litho_get_portfolio_thumbnail(); ?>
													</div>
													<figcaption>
														<div class="portfolio-hover d-flex flex-row">
															<div class="portfolio-caption">
																<div class="portfolio-caption-text">
																	<?php if ( 'yes' === $portfolio_show_post_title ) { ?>
																		<div class="title"><?php the_title(); ?><span class="slider-title-hover"></span></div>
																	<?php } ?>
																	<?php if ( 'yes' === $portfolio_show_post_subtitle ) { ?>
																		<div class="subtitle"><span><?php echo esc_html( $litho_subtitle ); ?></span></div>
																	<?php } ?>
																</div>
															</div>
														</div>
													</figcaption>
												</figure>
											<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
											</a>
											<?php } ?>
										<?php echo sprintf( '%s', $litho_portfolio_tilt_box_end_wrapper ); // phpcs:ignore ?>
									</div>
									<?php
									break;
								case 'portfolio-slider-style-2':
									if ( ! empty( $portfolio_title_hover_animation ) || ! empty( $portfolio_subtitle_hover_animation ) || ! empty( $portfolio_icon_hover_animation ) ) {

										$this->add_render_attribute( $figure_wrap_key, [
											'class' => [ 'hover-box-slide-text' ]
										] );
									}
									?>
									<div <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
										<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
										<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>>
										<?php } ?>
											<figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
												<div class="portfolio-image">
													<?php $this->litho_get_portfolio_thumbnail(); ?>
												</div>
												<figcaption>
													<div class="portfolio-hover d-flex flex-row">
														<div class="portfolio-caption">
															<div class="portfolio-caption-text">
																<?php if ( 'yes' === $portfolio_show_post_subtitle ) { ?>
																	<div class="subtitle<?php echo esc_attr( $portfolio_subtitle_hover_animation ); ?>">
																		<span><?php echo esc_html( $litho_subtitle ); ?></span>
																	</div>
																<?php } ?>
																<?php if ( 'yes' === $portfolio_show_post_title ) { ?>
																	<div class="title<?php echo esc_attr( $portfolio_title_hover_animation ); ?>">
																		<span><?php the_title(); ?></span>
																	</div>
																<?php } ?>
															</div>
															<?php if ( ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) { ?>
																<div class="portfolio-icon<?php echo esc_attr( $portfolio_icon_hover_animation ); ?>">
																	<?php
																	if ( $is_new || $custom_link_icon_migrated ) {
																		Icons_Manager::render_icon( $settings['litho_portfolio_custom_link_icon'], [ 'aria-hidden' => 'true' ] );
																	} elseif ( isset( $settings['litho_portfolio_custom_link_icon']['value'] ) && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) {
																		?><i class="<?php echo esc_attr( $settings['litho_portfolio_custom_link_icon']['value'] ); ?>" aria-hidden="true"></i><?php
																	}
																	?>
																</div>
															<?php } ?>
														</div>
													</div>
												</figcaption>
											</figure>
										<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
										</a>
										<?php } ?>
									</div>
									<?php
									break;
								case 'portfolio-slider-style-3':
									?>
									<div <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
										<figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
											<div class="portfolio-image">
												<?php $this->litho_get_portfolio_thumbnail(); ?>
												<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
												<div class="portfolio-hover d-flex">
													<?php if ( ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) { ?>
														<div class="portfolio-icon">
															<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>>
															<?php
															if ( $is_new || $custom_link_icon_migrated ) {
																Icons_Manager::render_icon( $settings['litho_portfolio_custom_link_icon'], [ 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_portfolio_custom_link_icon']['value'] ) && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) {
																?><i class="<?php echo esc_attr( $settings['litho_portfolio_custom_link_icon']['value'] ); ?>" aria-hidden="true"></i><?php
															}
															?>
															</a>
														</div>
													<?php } ?>
												</div>
												<?php } ?>
											</div>
											<figcaption>
												<div class="portfolio-caption">
													<?php if ( 'yes' === $portfolio_show_post_title ) { ?>
														<span class="title">
															<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>><?php the_title(); ?></a>
														</span>
													<?php } ?>
													<?php if ( 'yes' === $portfolio_show_post_subtitle ) {
														echo sprintf( '<span class="subtitle">%s</span>', esc_html( $litho_subtitle ) );
													} ?>
												</div>
											</figcaption>
										</figure>
									</div>
									<?php
									break;
								case 'portfolio-slider-style-4':

									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ 'swiper-slide-inner' ]
									] );
									?>
									<div <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
										<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
										<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>>
										<?php } ?>
											<figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
												<?php $this->litho_get_portfolio_thumbnail(); ?>
											</figure>
										<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
										</a>
										<?php } ?>
									</div>
									<?php
									break;
							}
							$index++;
						endwhile;
						wp_reset_postdata();
						?>
					</div>
					<?php
					if ( 1 < $slides_count ) {
						echo sprintf( '%s', $this->litho_swiper_pagination() ); // phpcs:ignore
					}
					?>
				</div>
			<?php
			}
		}

		public function litho_swiper_pagination() {

			$output              = '';
			$left_arrow_icon     = '';
			$right_arrow_icon    = '';
			$settings            = $this->get_settings_for_display();
			$litho_navigation    = $this->get_settings( 'litho_navigation' );
			$is_new              = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$left_icon_migrated  = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
			$right_icon_migrated = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );
			$show_dots           = ( in_array( $litho_navigation, [ 'dots' ] ) );
			$show_arrows         = ( in_array( $litho_navigation, [ 'arrows' ] ) );

			if ( isset( $settings['litho_left_arrow_icon'] ) && ! empty( $settings['litho_left_arrow_icon'] ) ) {
				if ( $is_new || $left_icon_migrated ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_left_arrow_icon'], [ 'aria-hidden' => 'true' ] );
					$left_arrow_icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_left_arrow_icon']['value'] ) && ! empty( $settings['litho_left_arrow_icon']['value'] ) ) {
					$left_arrow_icon .= '<i class="' . esc_attr( $settings['litho_left_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}
			if ( isset( $settings['litho_right_arrow_icon'] ) && ! empty( $settings['litho_right_arrow_icon'] ) ) {
				if ( $is_new || $right_icon_migrated ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_right_arrow_icon'], [ 'aria-hidden' => 'true' ] );
					$right_arrow_icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_right_arrow_icon']['value'] ) && ! empty( $settings['litho_right_arrow_icon']['value'] ) ) {
					$right_arrow_icon .= '<i class="' . esc_attr( $settings['litho_right_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}

			ob_start();
			if ( $show_dots ) {
				?>
				<div class="swiper-pagination"></div>
				<?php
			}
			if ( $show_arrows ) {
				?>
				<div class="elementor-swiper-button elementor-swiper-button-prev">
					<?php if ( ! empty( $left_arrow_icon ) ) {
						echo sprintf( '%s', $left_arrow_icon ); // phpcs:ignore
					} else { ?>
						<i class="eicon-chevron-left" aria-hidden="true"></i>
					<?php } ?>
					<span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'litho-addons' ); ?></span>
				</div>
				<div class="elementor-swiper-button elementor-swiper-button-next">
					<?php if ( ! empty( $right_arrow_icon ) ) {
						echo sprintf( '%s', $right_arrow_icon ); // phpcs:ignore
					} else { ?>
						<i class="eicon-chevron-right" aria-hidden="true"></i>
					<?php } ?>
					<span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'litho-addons' ); ?></span>
				</div>
			<?php
			}
			$output = ob_get_contents();
			ob_get_clean();
			return $output;
		}

		public function litho_get_portfolio_thumbnail() {

			$post_thumbanail = '';
			$litho_thumbnail = $this->get_settings( 'litho_thumbnail' );

			if ( has_post_thumbnail() ) {
				$post_thumbanail = get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );
			} else {
				$post_thumbanail = sprintf( '<img src="%1$s" alt="%2$s" />', Utils::get_placeholder_image_src(), __( 'Portfolio Image ' . get_the_ID(), 'litho-addons' ) );
			}
			echo sprintf( '%s', $post_thumbanail ); // phpcs:ignore
		}
	}
}
