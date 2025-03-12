<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for split portfolio slider.
 *
* @package Litho
 */
// If class `Split_Portfolio_Slider` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Split_Portfolio_Slider' ) ) {

	class Split_Portfolio_Slider extends Widget_Base {

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
			return 'litho-split-portfolio-slider';
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
			return __( 'Litho Split Portfolio Slider', 'litho-addons' );
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
			return 'eicon-posts-grid';
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
			return [ 'portfolio', 'masonry', 'grid', 'gallery', 'half', 'project', 'split' ];
		}

		/**
		 * Register split portfolio slider widget controls.
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
					'label'		=> __( 'General', 'litho-addons' ),
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
					'options'     => ( function_exists( 'litho_portfolio_tags_array' ) ) ? litho_portfolio_tags_array() : [],
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
				'litho_portfolio_post_per_page',
				[
					'label'     => __( 'Number of posts to show', 'litho-addons' ),
					'type'      => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' => 3,
				]
			);
			$this->add_control(
				'litho_portfolio_thumbnail',
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
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_portfolio_title_tag',
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
					'default' 		=> 'h2'
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_subtitle',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_excerpt',
				[
					'label'         =>  __( 'Excerpt', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
				]
			);
			$this->add_control(
				'litho_portfolio_excerpt_length',
				[
					'label'         => __( 'Excerpt Length', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'min'           => 1,
					'default'       => 18,
					'condition'     => [
						'litho_portfolio_show_post_excerpt'	=> 'yes',
					]
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
					'label'     =>  __( 'Posts sort by', 'litho-addons' ),
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
				'litho_section_image_carousel_setting',
				[
					'label' 		=> __( 'Slider Configuration', 'litho-addons' ),
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
				'litho_speed',
				[
					'label' 		=> __( 'Animation Speed', 'litho-addons' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 500,
				]
			);
			$this->add_control(
				'litho_mousewheel',
				[
					'label' 		=> __( 'Mousewheel', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
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
			$this->add_control(
				'litho_navigation',
				[
					'label' 	=> __( 'Navigation', 'litho-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'dots',
					'options' 	=> [
						'dots' 		=> __( 'Dots', 'litho-addons' ),
						'none'		=> __( 'None', 'litho-addons' ),
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_title_style',
				[
					'label'         =>  __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_shadow',
					'selector' 		=> '{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title',
					'condition'		=> [
						'litho_title_type' => 'normal',
					],
				]
			);
			$this->add_control(
				'litho_title_type',
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
			$this->start_controls_tabs( 'litho_title_tabs' );
				$this->start_controls_tab( 'litho_title_normal_tab',
					[
						'label'	=> __( 'Normal', 'litho-addons' ),
					]
				);
				// NORMAL Title Type
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_title_color',
						'selector' 	=> '{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a',
						'condition'	=> [
							'litho_title_type' => 'normal',
						],
					]
				);

				// STROKE Title Type
				$this->add_control(
					'litho_stroke_title_color',
					[
						'label'			=> __( 'Text Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a' => '-webkit-text-fill-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_title_type' => 'stroke',
						],
					]
				);
				$this->add_control(
					'litho_stroke_title_border_color',
					[
						'label'			=> __( 'Stroke Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a' => '-webkit-text-stroke-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_title_type' => 'stroke',
						],
					]
				);
				$this->add_responsive_control(
					'litho_stroke_title_border_width',
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
							'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
						],
						'condition'		=> [
							'litho_title_type' => 'stroke',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_title_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				);
				// NORMAL Title Type
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_title_hover_color',
						'selector' 	=> '{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a:hover',
						'condition'		=> [
							'litho_title_type' => 'normal',
						],
					]
				);
				
				// STROKE Title Type
				$this->add_control(
					'litho_stroke_title_hvr_color',
					[
						'label'			=> __( 'Text Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a:hover' => '-webkit-text-fill-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_title_type' => 'stroke',
						],
					]
				);
				$this->add_control(
					'litho_stroke_title_hvr_border_color',
					[
						'label'			=> __( 'Stroke Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a:hover' => '-webkit-text-stroke-color: {{VALUE}};',
						],
						'condition'		=> [
							'litho_title_type' => 'stroke',
						],
					]
				);
				$this->add_responsive_control(
					'litho_stroke_title_hvr_border_width',
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
							'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title a:hover' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
						],
						'condition'		=> [
							'litho_title_type' => 'stroke',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			
			$this->add_responsive_control(
				'litho_portfolio_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_subtitle_style',
				[
					'label'             =>  __( 'Subtitle', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_subtitle_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .subtitle',
				]
			);
			$this->add_control(
				'litho_portfolio_subtitle_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .slider-split-scroll .swiper-slide .swiper-slide-l .subtitle' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_heading_style_number',
				[
					'label' 		=> __( 'Number', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before'
				]
			);
			$this->add_control(
				'litho_number_color',
				[
					'label'     => __( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .post-meta-detail .number' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_heading_style_separator',
				[
					'label' 		=> __( 'Separator', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before'
				]
			);
			$this->add_control(
				'litho_separator_color',
				[
					'label'     => __( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .swiper-slide .swiper-slide-l .subtitle .separator-line' => 'background-color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_separator_thickness',
				[
					'label'         => __( 'Separator Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 10 ] ],
					'default'       => [ 'unit' => 'px', 'size' => 1 ],
					'selectors'     => [
						'{{WRAPPER}} .swiper-slide .swiper-slide-l .subtitle .separator-line' => 'height: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_separator_length',
				[
					'label'         => __( 'Separator Length', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 200 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'default'       => [ 'unit' => 'px', 'size' => 35 ],
					'selectors'     => [
						'{{WRAPPER}} .swiper-slide .swiper-slide-l .subtitle .separator-line' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_excerpt_style',
				[
					'label'             => __( 'Excerpt', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'condition'			=> [ 'litho_portfolio_show_post_excerpt' => 'yes', ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_excerpt_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_TEXT,
					],
					'selector'	=> '{{WRAPPER}} .slider-split-scroll .swiper-slide .portfolio-excerpt',
				]
			);
			$this->add_control(
				'litho_portfolio_excerpt_color',
				[
					'label'     => __( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .swiper-slide .portfolio-excerpt' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_excerpt_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .swiper-slide .portfolio-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_navigation',
				[
					'label'			=> __( 'Navigation', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'condition'		=> [ 'litho_navigation!' => [ 'none' ] ],
				]
			);
			$this->add_control(
				'litho_heading_style_dots',
				[
					'label' 		=> __( 'Dots', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
					'separator' 	=> 'before',
				]
			);
			$this->start_controls_tabs( 'litho_dots_tabs', [ 'condition' => [ 'litho_navigation' => [ 'dots' ] ] ] );
				$this->start_controls_tab( 'litho_dots_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_dots_size',
						[
							'label' 		=> __( 'Size', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 30 ],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
						]
					);
					$this->add_control(
						'litho_dots_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'        	=> 'litho_dots_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)',
							'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
						]
					);
					$this->add_responsive_control(
						'litho_dots_margin',
						[
							'label'      	=> __( 'Margin', 'litho-addons' ),
							'type'       	=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors'  	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_dots_active_tab', [ 'label' => __( 'Active', 'litho-addons' ) ] );
					$this->add_control(
						'litho_dots_active_size',
						[
							'label' 		=> __( 'Size', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 30 ],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
						]
					);
					$this->add_control(
						'litho_dots_active_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'        	=> 'litho_dots_active_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
							'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
						]
					);
				$this->add_responsive_control(
					'litho_dots_active_margin',
					[
						'label'      	=> __( 'Margin', 'litho-addons' ),
						'type'       	=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'  	=> [
							'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'dots' ] ],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * Render split portfolio slider widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render( $instance = [] ) {

			$settings                           = $this->get_settings_for_display();
			$litho_portfolio_type_selection     = ( isset( $settings['litho_portfolio_type_selection'] ) && $settings['litho_portfolio_type_selection'] ) ? $settings['litho_portfolio_type_selection'] : 'portfolio-category';
			$litho_portfolio_categories_list    = ( isset( $settings['litho_portfolio_categories_list'] ) && $settings['litho_portfolio_categories_list'] ) ?  $settings['litho_portfolio_categories_list'] : array();
			$litho_portfolio_tags_list          = ( isset( $settings['litho_portfolio_tags_list'] ) && $settings['litho_portfolio_tags_list'] ) ?  $settings['litho_portfolio_tags_list'] : array();
			$litho_portfolio_post_per_page      = ( isset( $settings['litho_portfolio_post_per_page'] ) && $settings['litho_portfolio_post_per_page'] ) ? $settings['litho_portfolio_post_per_page'] : '';
			$litho_portfolio_thumbnail          = ( isset( $settings['litho_portfolio_thumbnail'] ) && $settings['litho_portfolio_thumbnail'] ) ? $settings['litho_portfolio_thumbnail'] : '';
			$litho_portfolio_show_post_title    = ( isset( $settings['litho_portfolio_show_post_title'] ) && $settings['litho_portfolio_show_post_title'] ) ? $settings['litho_portfolio_show_post_title'] : '';
			$litho_portfolio_show_post_excerpt  = ( isset( $settings['litho_portfolio_show_post_excerpt'] ) && $settings['litho_portfolio_show_post_excerpt'] ) ? $settings['litho_portfolio_show_post_excerpt'] : '';
			$litho_portfolio_excerpt_length     = ( isset( $settings['litho_portfolio_excerpt_length'] )&& $settings['litho_portfolio_excerpt_length'] ) ? $settings['litho_portfolio_excerpt_length'] : '';
			$litho_portfolio_show_post_subtitle = ( isset( $settings['litho_portfolio_show_post_subtitle'] )&& $settings['litho_portfolio_show_post_subtitle'] ) ? $settings['litho_portfolio_show_post_subtitle'] : '';
			$litho_portfolio_orderby            = ( isset( $settings['litho_portfolio_orderby'] ) && $settings['litho_portfolio_orderby'] ) ? $settings['litho_portfolio_orderby'] : '';
			$litho_portfolio_order              = ( isset( $settings['litho_portfolio_order'] ) && $settings['litho_portfolio_order'] ) ? $settings['litho_portfolio_order'] : '';
			$litho_portfolio_title_tag          = ( isset( $settings['litho_portfolio_title_tag'] ) && $settings['litho_portfolio_title_tag'] ) ? $settings['litho_portfolio_title_tag'] : '';
			$litho_slider_cursor                = $this->get_settings( 'litho_slider_cursor' );
			
			$sliderConfig = array(
				'navigation'     => $this->get_settings( 'litho_navigation' ),
				'autoplay'       => $this->get_settings( 'litho_autoplay' ),
				'autoplay_speed' => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover' => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'           => $this->get_settings( 'litho_infinite' ),
				'speed'          => $this->get_settings( 'litho_speed' ),
				'mousewheel'     => $this->get_settings( 'litho_mousewheel' )
			);
			
			$this->add_render_attribute( [
				'carousel-wrapper' => [
					'class' => [
						'slider-split-scroll',
						'full-screen-height',
						'swiper',
						$litho_slider_cursor,
					],
					'data-settings' => json_encode( $sliderConfig )
				],
				'carousel' => [
					'class' => 'swiper-wrapper'
				]
			] );

			if ( 'portfolio-tags' === $litho_portfolio_type_selection ) {
				$categories_to_display_ids = ( ! empty( $litho_portfolio_tags_list ) ) ? $litho_portfolio_tags_list : array();
			} else {
				$categories_to_display_ids = ( ! empty( $litho_portfolio_categories_list ) ) ? $litho_portfolio_categories_list : array();
			}

			// If no categories are chosen or "All categories", we need to load all available categories
			if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
				
				$terms = get_terms( $litho_portfolio_type_selection );

				if ( ! is_array( $categories_to_display_ids ) ) {
					$categories_to_display_ids = array();
				}
				foreach ( $terms as $term ) {
					$categories_to_display_ids[] = $term->slug;
				}
			} else {
				$categories_to_display_ids = array_values( $categories_to_display_ids );
			}

			$query_args = array(
				'post_type'      => 'portfolio',
				'post_status'    => 'publish',
				'posts_per_page' => intval( $litho_portfolio_post_per_page ),
			);

			if ( ! empty( $categories_to_display_ids ) ) {
				$query_args['tax_query'] = [
					[
						'taxonomy' => $litho_portfolio_type_selection,
						'field'    => 'slug',
						'terms'    => $categories_to_display_ids
					],
				];
			}

			if ( ! empty( $litho_portfolio_orderby ) ) {
				$query_args['orderby'] = $litho_portfolio_orderby;
			}

			if ( ! empty( $litho_portfolio_order ) ) {
				$query_args['order'] = $litho_portfolio_order;
			}
			
			$portfolio_query = new \WP_Query( $query_args );
			$slides_count = $portfolio_query->post_count;

			if ( $portfolio_query->have_posts() ) { ?>
				<div class="home-split-portfolio p-0 full-screen w-100 position-relative">
					<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
						<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
							<?php
							$index = 1;
							while ( $portfolio_query->have_posts() ) :
								$portfolio_query->the_post();
								$counter         = esc_html( '0' ) . $index;
								$slide_left_key  = 'slide_left_' . $index;
								$slide_right_key = 'slide_right_' . $index;
								$custom_link_key = 'link_' . $index;

								$litho_portfolio_thumbnail       = $this->get_settings( 'litho_portfolio_thumbnail' );
								$litho_subtitle                  = litho_post_meta( 'litho_subtitle' );
								$litho_portfolio_alternate_image = litho_post_meta( 'litho_portfolio_alternate_image' );
								$has_post_format                 = litho_post_meta( 'litho_portfolio_post_type' );
							
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

								$this->add_render_attribute( [
									$slide_left_key => [
										'class' => [ 'swiper-slide-l d-flex justify-content-start justify-content-lg-center vh-100 w-50 background-position-left background-no-repeat' ]
									]
								] );

								$this->add_render_attribute( [
									$slide_right_key => [
										'class' => [ 'swiper-slide-r cover-background vh-100 w-50'  ]
									]
								] );

								if ( $litho_portfolio_alternate_image ) {
									$litho_portfolio_alternate_image_url = wp_get_attachment_url( $litho_portfolio_alternate_image );

									$this->add_render_attribute( [
										$slide_left_key => [
											'style' => 'background-image: url('. esc_url( $litho_portfolio_alternate_image_url ) .');'
										]
									] );
								}

								if ( has_post_thumbnail() ) {
									$this->add_render_attribute( [
										$slide_right_key => [
											'style' => 'background-image: url('.esc_url( get_the_post_thumbnail_url() ).');'
										]
									] );
								}
								?>
								<div class="swiper-slide d-flex">
									<div <?php $this->print_render_attribute_string( $slide_left_key ); ?>>
										<div class="d-flex flex-column justify-content-center w-50 position-relative">
											<?php if ( 'yes' === $litho_portfolio_show_post_title ) { ?>
												<<?php echo $this->get_settings( 'litho_portfolio_title_tag' );?> class="title mb-0 offset-2 offset-xl-0">
												<a <?php $this->print_render_attribute_string( $custom_link_key );?>><?php the_title(); ?></a>
												</<?php echo $this->get_settings( 'litho_portfolio_title_tag' );?>>
											<?php } ?>

											<?php if ( 'yes' === $litho_portfolio_show_post_excerpt ) {
												$show_excerpt = ! empty( $litho_portfolio_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_portfolio_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
												if ( ! empty( $show_excerpt ) ) { ?>
													<div class="portfolio-excerpt offset-2 offset-xl-0">
														<?php echo sprintf( '%s', wp_kses_post( $show_excerpt ) ); ?>
													</div><?php
												} 
											} ?>
											<?php if ( 'yes' === $litho_portfolio_show_post_subtitle && $litho_subtitle ) { ?>
												<div class="post-meta-detail subtitle">
													<span class="number"><?php echo esc_html( $counter ); ?></span>
													<span class="separator-line"></span><?php echo esc_html( $litho_subtitle ); ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div <?php $this->print_render_attribute_string( $slide_right_key ); ?>>
										<a <?php $this->print_render_attribute_string( $custom_link_key ); ?> class="post-title-link position-absolute w-100 h-100"></a>
									</div>
								</div>
								<?php
								$index++;
							endwhile;
							wp_reset_postdata();
							?>
						</div>
						<?php
							if ( 1 < $slides_count ) {
								echo sprintf( '%s', $this->litho_swiper_pagination() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
						?>
					</div>
				</div>
			<?php
			}
		}

		// swiper pagination
		public function litho_swiper_pagination() {

			$output           = '';
			$left_arrow_icon  = '';
			$right_arrow_icon = '';
			$settings         = $this->get_settings_for_display();
			$litho_navigation = $this->get_settings( 'litho_navigation' );
			$show_dots        = ( in_array( $litho_navigation, [ 'dots' ] ) );
			ob_start();
			if ( $show_dots ) { ?>
				<div class="swiper-pagination swiper-pagination-split-scroll swiper-pagination-medium d-flex flex-column align-items-center swiper-pagination-clickable swiper-pagination-bullets"></div>
			<?php
			}
			$output = ob_get_contents();
			ob_get_clean();
			return $output;
		}
	}
}
