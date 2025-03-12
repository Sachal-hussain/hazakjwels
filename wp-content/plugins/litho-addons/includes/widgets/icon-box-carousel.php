<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for icon box carousel.
 *
 * @package Litho
 */

// If class `Icon_Box_Carousel` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Icon_Box_Carousel' ) ) {

	class Icon_Box_Carousel extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve icon box carousel widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-icon-box-carousel';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve icon box carousel widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Icon Box Carousel', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve icon box carousel widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-slider-album';
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
			return [ 'slider', 'icon', 'fancy', 'slider', 'featurebox', 'content' ];
		}

		/**
		 * Register icon box carousel widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_icon',
				[
					'label' => __( 'Icon Box', 'litho-addons' ),
				]
			);
			$repeater = new Repeater();
			$repeater->add_control(
				'litho_item_use_image',
				[
					'label'        	=> __( 'Use Image?', 'litho-addons' ),
					'type'         	=> Controls_Manager::SWITCHER,
					'label_on'     	=> __( 'Yes', 'litho-addons' ),
					'label_off'    	=> __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'default'      	=> '',
				]
			);
			$repeater->add_control(
				'litho_selected_icon',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-star',
						'library' 		=> 'fa-solid',
					],
					'condition' 	=> [
						'litho_item_use_image' => '',
					],
				]
			);
			$repeater->add_control(
				'litho_item_image',
				[
					'label'   		=> __( 'Image', 'litho-addons' ),
					'type'    		=> Controls_Manager::MEDIA,
					'dynamic'		=> [
						'active' => true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$repeater->add_control(
				'litho_title_text',
				[
					'label' 		=> __( 'Title & Description', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'This is the heading', 'litho-addons' ),
					'placeholder' 	=> __( 'Enter your title', 'litho-addons' ),
					'description'	=> __( 'Use || to break the word in new line.', 'litho-addons' ),
					'label_block' 	=> true,
				]
			);

			$repeater->add_control(
				'litho_description_text',
				[
					'label' 		=> __( 'Description', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'dynamic' => [
					    'active' => true
					],
					'show_label' 	=> false,
					'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
					'placeholder' 	=> __( 'Enter your description', 'litho-addons' ),
					'rows' 			=> 10,
					'separator' 	=> 'none',
				]
			);
			$repeater->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'separator' 	=> 'before',
				]
			);

			$this->add_control(
				'litho_carousel_slider',
				[
					'label' 		=> __( 'Carousel Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default'		=> [
						[
							'litho_selected_icon'		=> [
											'value' 	=> 'fa-solid fa-star',
											'library' 	=> 'fa-solid',
							],
							'litho_title_text'			=> __( 'This is the heading', 'litho-addons' ),
							'litho_description_text'	=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' )
						],
						[
							'litho_selected_icon'		=> [
											'value' 	=> 'fa-solid fa-star',
											'library' 	=> 'fa-solid',
							],
							'litho_title_text'			=> __( 'This is the heading', 'litho-addons' ),
							'litho_description_text'	=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' )
						]
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_setting',
				[
					'label' 		=> __( 'Settings', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_view',
				[
					'label' 		=> __( 'Icon View', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'default' 		=> __( 'Default', 'litho-addons' ),
						'stacked' 		=> __( 'Stacked', 'litho-addons' ),
						'framed' 		=> __( 'Framed', 'litho-addons' ),
						'custom' 		=> __( 'Custom', 'litho-addons' ),
					],
					'default' 		=> 'default',
					'prefix_class' 	=> 'elementor-view-',
				]
			);

			$this->add_control(
				'litho_shape',
				[
					'label' 		=> __( 'Shape', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
							'circle' 	=> __( 'Circle', 'litho-addons' ),
							'square' 	=> __( 'Square', 'litho-addons' ),
					],
					'default' 		=> 'circle',
					'condition' 	=> [
						'litho_view!' 	=> 'default',
					],
					'prefix_class' => 'elementor-shape-',
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'			=> 'litho_thumbnail',
					'default'		=> 'full',
				]
			);

			$this->add_control(
				'litho_title_size',
				[
					'label' 	=> __( 'Title HTML Tag', 'litho-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'h1' 	=> 'H1',
						'h2' 	=> 'H2',
						'h3' 	=> 'H3',
						'h4' 	=> 'H4',
						'h5' 	=> 'H5',
						'h6' 	=> 'H6',
						'div' 	=> 'div',
						'span' 	=> 'span',
						'p' 	=> 'p',
					],
					'default' 	=> 'h3',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_brand_logo_carousel_setting',
				[
					'label' 		=> __( 'Slider Configuration', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_items_spacing',
				[
					'label'      	=> __( 'Items Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
					'default' 		=> [ 'unit' => 'px', 'size' => 30 ],
					'condition' 	=> [ 'litho_slides_to_show!' => '1' ],
				]
			);
			$slides_to_show = range( 1, 10 );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
			$this->add_responsive_control(
				'litho_slides_to_show',
				[
					'label' 		=> __( 'Slides to Show', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 2,
					'options' 		=> [
						''     => __( 'Default', 'litho-addons' ),
						'auto' => __( 'Auto', 'litho-addons' ),
					] + $slides_to_show,

				]
			);
			$this->add_responsive_control(
				'litho_slide_width',
				[
					'label'			=> __( 'Slide Width', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range'			=> [
						'px' => [
								'min' => 1,
								'max' => 1000,
						],
						'%' => [
							'max' => 100,
							'min' => 0,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 100,
					],
					'selectors'		=> [
						'{{WRAPPER}} .swiper-slide' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'		=> [
						'litho_slides_to_show' => [ 'auto' ],
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
						'both' 		=> __( 'Arrows and Dots', 'litho-addons' ),
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
					'label'			=> __( 'Arrows', 'litho-addons' ),
					'condition'		=> [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->add_control(
				'litho_left_arrow_icon',
				[
					'label'       		=> __( 'Left Arrow Icon', 'litho-addons' ),
					'type'        		=> Controls_Manager::ICONS,
					'label_block' 		=> true,
					'fa4compatibility' => 'icon',
					'default' 			=> [
								'value' 		=> 'fa-solid fa-chevron-left',
								'library' 		=> 'fa-solid',
					],
					'condition'			=> [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->add_control(
				'litho_right_arrow_icon',
				[
					'label'				=> __( 'Right Arrow Icon', 'litho-addons' ),
					'type'				=> Controls_Manager::ICONS,
					'label_block'		=> true,
					'fa4compatibility'	=> 'icon',
					'default'			=> [
							'value' 		=> 'fa-solid fa-chevron-right',
							'library' 		=> 'fa-solid',
					],
					'condition'			=> [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_general',
				[
					'label'		=> __( 'General', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_text_align',
				[
					'label' => __( 'Alignment', 'litho-addons' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'litho-addons' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-wrapper, {{WRAPPER}} .litho-image-box-wrapper' => 'text-align: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_icon_box_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->add_control(
				'litho_icon_box_hover_transition',
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
						'{{WRAPPER}} .icon-box-hover' => 'transition-duration: {{SIZE}}s',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_icon_box_slide_background_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} .swiper-slide',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_icon_box_slide_border',
					'selector'      => '{{WRAPPER}} .swiper-slide',
				]
			);
			$this->add_responsive_control(
				'litho_icon_box_slide_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_box_slide_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_icon_box_slide_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .swiper-slide' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_icon_box_slide_box_shadow',
					'selector'      => '{{WRAPPER}} .swiper-slide',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_icon',
				[
					'label'		=> __( 'Icon', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'icon_colors' );

			$this->start_controls_tab(
				'litho_icon_colors_normal',
				[
					'label' 	=> __( 'Normal', 'litho-addons' ),
				]
			);

			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 				=> 'litho_icon_color',
					'condition' 		=> [
						'litho_view'	=> [ 'default', 'custom' ],
					],
					'selector'			=> '{{WRAPPER}}.elementor-view-default .elementor-icon i:before, {{WRAPPER}}.elementor-view-custom .elementor-icon i:before, {{WRAPPER}}.elementor-view-default .elementor-icon svg, {{WRAPPER}}.elementor-view-custom .elementor-icon svg, {{WRAPPER}}.elementor-view-default .elementor-icon svg, {{WRAPPER}}.elementor-view-custom .elementor-icon svg',
					'fields_options'	=> [
						'color' 	=> [
							'responsive' => true
						],
						'background'	=> [
							'label' => __( 'Icon Color', 'litho-addons' ),
						]
					]
				]
			);
			$this->add_responsive_control(
				'litho_primary_color',
				[
					'label' 		=> __( 'Primary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'global' 		=> [
						'default'	=> Global_Colors::COLOR_PRIMARY,
					],
					'condition' 	=> [
						'litho_view!'	=> [ 'default', 'custom' ],
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon'  => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_secondary_color',
				[
					'label' 		=> __( 'Secondary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' 	=> [
						'litho_view!'	=> [ 'default', 'custom' ],
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon'  => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_icon_background_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}}.elementor-view-custom .elementor-icon',
					'condition' 	=> [
						'litho_view' => 'custom',
					],
					'fields_options' => [
						'color' => [
							'responsive' => true
						]
					]
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'litho_icon_colors_hover',
				[
					'label' 	=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 		=> 'litho_hover_icon_color',
					'condition' => [
						'litho_view' => [ 'default', 'custom' ],
					],
					'selector' 	=> '{{WRAPPER}}.elementor-view-default .icon-box-carousel .swiper-slide:hover .elementor-icon i:before, {{WRAPPER}}.elementor-view-custom .icon-box-carousel .swiper-slide:hover .elementor-icon i:before,
					{{WRAPPER}}.elementor-view-default .icon-box-carousel .swiper-slide:hover .elementor-icon svg, {{WRAPPER}}.elementor-view-custom .icon-box-carousel .swiper-slide:hover .elementor-icon svg, {{WRAPPER}}.elementor-view-default .icon-box-carousel .swiper-slide:hover .elementor-icon svg, {{WRAPPER}}.elementor-view-custom .icon-box-carousel .swiper-slide:hover .elementor-icon svg', 
					'fields_options' => [
						'color' 	=> [
							'responsive' => true
						],
						'background'	=> [
							'label' => __( 'Icon Color', 'litho-addons' ),
						]
					]
				]
			);

			$this->add_responsive_control(
				'litho_hover_primary_color',
				[
					'label'		=> __( 'Primary Color', 'litho-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> '',
					'condition' => [
						'litho_view!' => [ 'default', 'custom' ],
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-stacked .icon-box-carousel .swiper-slide:hover .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .icon-box-carousel .swiper-slide:hover .elementor-icon, {{WRAPPER}}.elementor-view-default .icon-box-carousel .swiper-slide:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_hover_secondary_color',
				[
					'label' 	=> __( 'Secondary Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'condition' => [
							'litho_view!' => [ 'default', 'custom' ],
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-framed .icon-box-carousel .swiper-slide:hover .elementor-icon' 	=> 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .icon-box-carousel .swiper-slide:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_icon_hover_background_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}}.elementor-view-custom .icon-box-carousel .swiper-slide:hover .elementor-icon',
					'condition' 	=> [
							'litho_view'	=> 'custom',
					],
					'fields_options' => [
						'color' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 	=> __( 'Hover Animation', 'litho-addons' ),
					'type' 		=> Controls_Manager::HOVER_ANIMATION,
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label' 	=> __( 'Size', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 6,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator'	=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_icon_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'em' 		=> [
							'min' => 0,
							'max' => 5,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_view!' => 'default',
					],
				]
			);
			$this->add_control(
				'litho_rotate',
				[
					'label' 	=> __( 'Rotate', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size' 	=> 0,
						'unit' 	=> 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_responsive_control(
				'litho_border_width',
				[
					'label' 		=> __( 'Border Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
							'litho_view'	=> 'framed',
					],
				]
			);
			$this->add_responsive_control(
				'litho_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
							'litho_view!'	=> 'default',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'				=> 'litho_icon_box_shadow',
					'selector'			=> '{{WRAPPER}} .elementor-icon',
					'fields_options'	=> [ 'box_shadow' 	=> [ 'responsive' => true ] ]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_image',
				[
					'label' 		=> __( 'Image', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'litho_image_size',
				[
					'label' 		=> __( 'Width', 'litho-addons' ) . ' (%)',
					'type' 			=> Controls_Manager::SLIDER,
					'default' 		=> [
								'size'	=> 30,
								'unit'	=> '%',
					],
					'tablet_default' => [
								'unit'	=> '%',
					],
					'mobile_default' => [
								'unit'	=> '%',
					],
					'size_units' 	=> [ '%' ],
					'range'			=> [
							'%' => [
								'min' => 5,
								'max' => 100,
							],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .litho-image-box-wrapper .litho-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_image_effects' );
			$this->start_controls_tab( 'litho_image_normal',
				[
					'label'		=> __( 'Normal', 'litho-addons' ),
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name'			=> 'litho_image_css_filters',
					'selector'		=> '{{WRAPPER}} .litho-image-box-img img',
				]
			);
			$this->add_control(
				'litho_image_opacity',
				[
					'label'		=> __( 'Opacity', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 1,
							'min' 	=> 0.10,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .litho-image-box-img img' => 'opacity: {{SIZE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'litho_image_hover',
				[
					'label' 	=> __( 'Hover', 'litho-addons' ),
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' 		=> 'litho_image_css_filters_hover',
					'selector' 	=> '{{WRAPPER}} .swiper-slide:hover .litho-image-box-img img',
				]
			);
			$this->add_control(
				'litho_image_opacity_hover',
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
						'{{WRAPPER}} .swiper-slide:hover .litho-image-box-img img' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_control(
				'litho_image_background_hover_transition',
				[
					'label'		=> __( 'Transition Duration', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
							'size'	=> 0.3,
					],
					'range' 	=> [
							'px' => [
								'max' => 3,
								'step' => 0.1,
							],
					],
					'selectors'	=> [
						'{{WRAPPER}} .litho-image-box-img img' => 'transition-duration: {{SIZE}}s',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_content',
				[
					'label' => __( 'Content', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'litho_title_typography',
					'selector' 		=> '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title, {{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title a',
					'global' 		=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
				]
			);
			$this->start_controls_tabs( 'litho_title_styles_tabs' );
			$this->start_controls_tab(
				'litho_title_color_tab',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_title_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title, {{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
					],
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_title_hover_color_tab',
				[
					'label'			=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_title_hover_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide:hover .elementor-icon-box-content .elementor-icon-box-title, {{WRAPPER}} .swiper-slide:hover .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_title_bottom_space',
				[
					'label' => __( 'Spacing', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'	=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_title_display_settings' ,
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
						'{{WRAPPER}} .elementor-icon-box-title' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'litho_heading_description',
				[
					'label'		=> __( 'Description', 'litho-addons' ),
					'type'		=> Controls_Manager::HEADING,
					'separator'	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_description_typography',
					'selector'	=> '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
				]
			);
			$this->add_responsive_control(
				'litho_description_width',
				[
					'label' => __( 'Content Width', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_description_styles_tabs' );
			
			$this->start_controls_tab(
				'litho_description_color_tab',
				[
					'label' => __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_description_color',
				[
					'label' => __( 'Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_description_link_color',
				[
					'label' => __( 'Link Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a' => 'color: {{VALUE}};',
					]
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'litho_description_hover_color_tab',
				[
					'label' => __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_description_hover_color',
				[
					'label' => __( 'Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .swiper-slide:hover .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_description_link_hover_color',
				[
					'label' => __( 'Link Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a:hover' => 'color: {{VALUE}};',
					]
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_description_display_settings' ,
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
						'{{WRAPPER}} .elementor-icon-box-description' => 'display: {{VALUE}}',
					],
					'separator'		=> 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_navigation',
				[
					'label' 			=> __( 'Navigation', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE,
					'condition' 		=> [
						'litho_navigation'		=> [ 'arrows', 'dots', 'both' ],
					],
				]
			);
			$this->add_control(
				'litho_heading_style_arrows',
				[
					'label' 		=> __( 'Arrows style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_position',
				[
					'label' 		=> __( 'Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'inside',
					'options' 		=> [
						'inside' 	=> __( 'Inside', 'litho-addons' ),
						'outside' 	=> __( 'Outside', 'litho-addons' ),
						'custom' 	=> __( 'Custom', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-arrows-position-',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_custom_position',
				[
					'label' 		=> __( 'Custom Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => -1000, 'max' => 1000 ] ],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_arrows_position' 	=> 'custom',
						'litho_navigation'			=> [ 'arrows', 'both' ],
					],
				]
			);
			$this->add_control(
				'litho_arrows_box_width',
				[
					'label' 		=> __( 'Box Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_height',
				[
					'label' 		=> __( 'Box Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 15, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev i, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_arrows_box_shadow',
					'selector' 		=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);

			$this->start_controls_tabs( 'litho_arrows_box_style' );
				$this->start_controls_tab(
					'litho_arrows_box_normal_style',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);

				$this->add_control(
					'litho_arrows_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next svg' => 'fill: {{VALUE}};',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_arrows_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_box_border',
						'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_arrows_box_hover_style',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_control(
					'litho_arrows_hover_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg' => 'fill: {{VALUE}};',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_arrows_background_hover_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_box_border_hover',
						'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_heading_style_dots',
				[
					'label' 		=> __( 'Dots style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
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
					'condition' 	=> [ 'litho_navigation' 	=> [ 'dots', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_dots_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-pagination-position-outside .swiper' => 'padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [ 
						'litho_navigation' 	=> [ 'dots', 'both' ],
						'litho_dots_position'	=> 'outside'
					],
				]
			);
			$this->start_controls_tabs( 'litho_dots_tabs', [ 'condition' => [ 'litho_navigation' => [ 'dots', 'both' ] ] ] );
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
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
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
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'        	=> 'litho_dots_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)',
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
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
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
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
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
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
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'        	=> 'litho_dots_active_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
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
						'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * Render icon box carousel widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$slides               = [];
			$slides_count         = '';
			$settings             = $this->get_settings_for_display();

			if ( empty( $settings['litho_carousel_slider'] ) ) {
				return;
			}

			$id_int = substr( $this->get_id_int(), 0, 3 );
			foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
				$wrapper_key        = 'wrapper_' . $index;
				$innerr_wrapper_key = 'inner_wrapper_' . $index;
				$icon_key           = 'icon_' . $index;
				$link_key           = 'link_' . $index;

				$this->add_render_attribute( $icon_key, 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['litho_hover_animation'] ] );

				$icon_tag = 'span';

				if ( ! isset( $item['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
					// add old default
					$item['icon'] = 'fa fa-star';
				}

				$has_icon = ! empty( $item['icon'] );

				if ( ! empty( $item['litho_link']['url'] ) ) {
					$icon_tag = 'a';
					$this->add_link_attributes( $link_key, $item['litho_link'] );
				}

				if ( $has_icon ) {
					$this->add_render_attribute( 'i', 'class', $item['icon'] );
					$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
				}

				$icon_attributes = $this->get_render_attribute_string( $icon_key );
				$link_attributes = $this->get_render_attribute_string( $link_key );

				if ( ! $has_icon && ! empty( $item['litho_selected_icon']['value'] ) ) {
					$has_icon = true;
				}
				$migrated = isset( $item['__fa4_migrated']['litho_selected_icon'] );
				$is_new = ! isset( $item['icon'] ) && Icons_Manager::is_migration_allowed();

				$this->add_render_attribute( $wrapper_key, [
					'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
				] );

				if ( $has_icon ) {
					$this->add_render_attribute( $wrapper_key, 'class', [ 'elementor-icon-box-wrapper', 'litho-icon-box-wrapper' ] );
					$this->add_render_attribute( $innerr_wrapper_key, 'class', [ 'elementor-icon-box-icon' ] );

				} else {

					$this->add_render_attribute( $wrapper_key, 'class', [ 'litho-image-box-wrapper' ] );
					$this->add_render_attribute( $innerr_wrapper_key, 'class', [ 'litho-image-box-img' ] );
				}
				if ( $this->get_settings( 'litho_icon_box_hover_animation' ) ) {
					$this->add_render_attribute( $wrapper_key, [
						'class' => [ 'icon-box-hover', 'hvr-' . $this->get_settings( 'litho_icon_box_hover_animation' ) ]
					] );
				}
				$icon = '';
				if ( $is_new || $migrated ) {
					ob_start();
					?>
						<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
							<?php Icons_Manager::render_icon( $item['litho_selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</<?php echo $icon_tag; // phpcs:ignore ?>>
					<?php
					$icon .= ob_get_clean();
				} else {
					ob_start();
					?>
						<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
							<i class="<?php echo esc_attr( $item['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i>
						</<?php echo $icon_tag; ?>>
					<?php
					$icon .= ob_get_clean();
				}

				$litho_item_image = '';
				if ( ! empty( $item['litho_item_image']['id'] ) ) {

					if ( 'custom' === $item['litho_thumbnail_size'] ) {

						$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_item_image']['id'], 'litho_thumbnail', $settings );
						$litho_item_image_alt = Control_Media::get_image_alt( $item['litho_item_image'] );
						$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
			
					} else {
						$srcset_data          = litho_get_image_srcset_sizes( $item['litho_item_image']['id'], $settings['litho_thumbnail_size'] );
						$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_item_image']['id'], 'litho_thumbnail', $settings );
						$litho_item_image_alt = Control_Media::get_image_alt( $item['litho_item_image'] );
						
						$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );
					}

				} elseif ( ! empty( $item['litho_item_image']['url'] ) ) {
					$litho_item_image_url = $item['litho_item_image']['url'];
					$litho_item_image_alt = '';
					$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
				}
				ob_start();
					?>
					<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
						<?php
						if ( ! empty( $item['litho_selected_icon'] ) || ! empty( $litho_item_image ) ) {
							?>
						<div <?php $this->print_render_attribute_string( $innerr_wrapper_key ); // phpcs:ignore ?>><?php
							echo filter_var( $item['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; // phpcs:ignore
						?></div>
						<?php
						}
						?>
						<div class="elementor-icon-box-content">
							<?php
							if ( ! empty( $item['litho_title_text'] ) ) {
								$litho_title_text =  str_replace( '||', '<br />', $item['litho_title_text'] );
								?>
								<<?php echo $settings['litho_title_size']; ?> class="elementor-icon-box-title"><<?php // phpcs:ignore
									echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>><?php
										echo sprintf( '%s', wp_kses_post( $litho_title_text ) );
										?></<?php echo $icon_tag; ?>>
								</<?php echo $settings['litho_title_size']; // phpcs:ignore ?>>
							<?php
							}
							if ( ! Utils::is_empty( $item['litho_description_text'] ) ) :
								?>
							<p class="elementor-icon-box-description"><?php
								echo sprintf( '%s', wp_kses_post( $item['litho_description_text'] ) );
							?></p>
							<?php
							endif;
							?>
						</div>
					</div>
					<?php
				$slides[] = ob_get_contents();
				ob_end_clean();
			}

			if ( empty( $slides ) ) {
				return;
			}

			$litho_left_arrow_icon  = '';
			$litho_right_arrow_icon = '';
			$left_icon_migrated     = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
			$right_icon_migrated    = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );
			$is_new                 = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( isset( $settings['litho_left_arrow_icon'] ) && ! empty( $settings['litho_left_arrow_icon'] ) ) {
				if ( $is_new || $left_icon_migrated ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_left_arrow_icon'], [ 'aria-hidden' => 'true' ] );
					$litho_left_arrow_icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_left_arrow_icon']['value'] ) && ! empty( $settings['litho_left_arrow_icon']['value'] ) ) {
					$litho_left_arrow_icon .= '<i class="' . esc_attr( $settings['litho_left_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}

			if ( isset( $settings['litho_right_arrow_icon'] ) && ! empty( $settings['litho_right_arrow_icon'] ) ) {
				if ( $is_new || $right_icon_migrated ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_right_arrow_icon'], [ 'aria-hidden' => 'true' ] );
					$litho_right_arrow_icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_right_arrow_icon']['value'] ) && ! empty( $settings['litho_right_arrow_icon']['value'] ) ) {
					$litho_right_arrow_icon .= '<i class="' . esc_attr( $settings['litho_right_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}

			$litho_rtl           = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor = $this->get_settings( 'litho_slider_cursor' );
			$litho_navigation    = $this->get_settings( 'litho_navigation' );
			$slides_count        = count( $settings['litho_carousel_slider'] );

			$dataSettings = array(
				'navigation'            => $this->get_settings( 'litho_navigation' ),
				'autoplay'              => $this->get_settings( 'litho_autoplay' ),
				'autoplay_speed'        => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover'        => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'                  => $this->get_settings( 'litho_infinite' ),
				'effect'                => $this->get_settings( 'litho_effect' ),
				'speed'                 => $this->get_settings( 'litho_speed' ),
				'image_spacing'         => $this->get_settings( 'litho_items_spacing' ),
				'slide_total'           => $slides_count,
				'slides_to_show'        => $this->get_settings( 'litho_slides_to_show' ),
				'slides_to_show_mobile' => $this->get_settings( 'litho_slides_to_show_mobile' ),
				'slides_to_show_tablet' => $this->get_settings( 'litho_slides_to_show_tablet' ),
			);

			$this->add_render_attribute( [
				'carousel' => [
					'class' => 'icon-box-carousel swiper-wrapper',
				],
				'carousel-wrapper' => [
					'class'         => [
						'icon-box-carousel-wrapper',
						'swiper',
						$litho_slider_cursor,
					],
					'data-settings' => json_encode( $dataSettings ),
				],
			] );

			if ( ! empty( $litho_rtl ) ) {
				$this->add_render_attribute( 'carousel-wrapper', 'dir', $litho_rtl );
			}
			$show_dots   = ( in_array( $litho_navigation, [ 'dots', 'both' ] ) );
			$show_arrows = ( in_array( $litho_navigation, [ 'arrows', 'both' ] ) );
			?>
			<div class="icon-box-carousel-content-box">
				<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); // phpcs:ignore ?>>
					<div <?php $this->print_render_attribute_string( 'carousel' ); // phpcs:ignore ?>>
						<?php echo implode( '', $slides ); ?>
					</div>
					<?php if ( 1 < $slides_count ) { ?>
						<?php if ( $show_dots ) { ?>
							<div class="swiper-pagination"></div>
						<?php } ?>
						<?php if ( $show_arrows ) { ?>
							<div class="elementor-swiper-button elementor-swiper-button-prev">
								<?php if ( ! empty( $litho_left_arrow_icon ) ) {
									echo sprintf( '%s', $litho_left_arrow_icon ); // phpcs:ignore
								} else { ?>
									<i class="eicon-chevron-left" aria-hidden="true"></i>
								<?php } ?>
								<span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'litho-addons' ); ?></span>
							</div>
							<div class="elementor-swiper-button elementor-swiper-button-next">
								<?php if ( ! empty( $litho_right_arrow_icon ) ) {
									echo sprintf( '%s', $litho_right_arrow_icon ); // phpcs:ignore
								} else { ?>
									<i class="eicon-chevron-right" aria-hidden="true"></i>
								<?php } ?>
								<span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'litho-addons' ); ?></span>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}
