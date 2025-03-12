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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for content carousel.
 *
 * @package Litho
 */

// If class `Content_Carousel` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Content_Carousel' ) ) {

	class Content_Carousel extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-content-slider';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Content Carousel', 'litho-addons' );
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
			return 'eicon-slider-album';
		}

		/**
		 * Retrieve the list of scripts the content carousel widget depended on.
		 *
		 * Used to set scripts dependencies required to run the widget.
		 *
		 * @access public
		 *
		 * @return array Widget scripts dependencies.
		 */
		public function get_script_depends() {
			return [ 'elementor-frontend' ];
		}

		/**
		 * Retrieve the widget categories.
		 *
		 * @access public
		 *
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return [ 'litho' ];
		}

		/**
		 * Get button sizes.
		 *
		 * Retrieve an array of button sizes for the button widget.
		 *
		 * @access public
		 * @static
		 *
		 * @return array An array containing button sizes.
		 */
		public static function get_button_sizes() {
			return [
				'xs' => __( 'Extra Small', 'litho-addons' ),
				'sm' => __( 'Small', 'litho-addons' ),
				'md' => __( 'Medium', 'litho-addons' ),
				'lg' => __( 'Large', 'litho-addons' ),
				'xl' => __( 'Extra Large', 'litho-addons' ),
			];
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
			return [ 'image', 'photo', 'visual', 'slide', 'carousel', 'slider' ];
		}

		/**
		 * Register content carousel widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_image_carousel',
				[
					'label' 		=> __( 'Slider', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_carousel_slide_styles',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'content-carousel-style-1',
					'options' 		=> [
						'content-carousel-style-1' => __( 'Style 1', 'litho-addons' ),
						'content-carousel-style-2' => __( 'Style 2', 'litho-addons' ),
						'content-carousel-style-3' => __( 'Style 3', 'litho-addons' ),
						'content-carousel-style-4' => __( 'Style 4', 'litho-addons' ),
						'content-carousel-style-5' => __( 'Style 5', 'litho-addons' ),
						'content-carousel-style-6' => __( 'Style 6', 'litho-addons' ),
						'content-carousel-style-7' => __( 'Style 7', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$repeater = new Repeater();
			$repeater->start_controls_tabs( 'litho_carousel_image_tabs' );
				$repeater->start_controls_tab( 'litho_carousel_image_background_tab', [ 'label' => __( 'Image', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_carousel_image',
						[
							'label' 		=> __( 'Image', 'litho-addons' ),
							'type' 			=> Controls_Manager::MEDIA,
							'dynamic'		=> [
								'active' => true,
							],
							'default' 		=> [
								'url' 		=> Utils::get_placeholder_image_src(),
							],
						]
					);				
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_carousel_image_content_tab', [ 'label' => __( 'Content', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_item_use_image',
						[
							'label' 		=> __( 'Select Icon Type', 'litho-addons' ),
							'type' 			=> Controls_Manager::CHOOSE,
							'label_block' 	=> false,
							'options' 		=> [
								'none' => [
									'title' 	=> __( 'None', 'litho-addons' ),
									'icon' 		=> 'eicon-ban',
								],
								'image' => [
									'title' 	=> __( 'Image', 'litho-addons' ),
									'icon' 		=> 'eicon-image',
								],
								'icon' => [
									'title' 	=> __( 'Icon', 'litho-addons' ),
									'icon' 		=> 'eicon-star',
								],
							],
							'default' => 'image',
						]
					);
					$repeater->add_control(
						'litho_item_icon',
						[
							'label'       	=> __( 'Choose Icon', 'litho-addons' ),
							'type'        	=> Controls_Manager::ICONS,
							'label_block' 	=> true,
							'fa4compatibility' => 'icon',
							'default' 		=> [
								'value' 		=> 'fa-solid fa-star',
								'library' 		=> 'fa-solid',
							],
							'condition' 	=> [
								'litho_item_use_image' => 'icon',
							],
						]
					);
					$repeater->add_control(
						'litho_thumb_image',
						[
							'label'         => __( 'Upload Image', 'litho-addons' ),
							'type'          => Controls_Manager::MEDIA,
							'dynamic'		=> [
								'active' => true,
							],
							'default'       => [
								'url'       => '',
							],
							'condition'   	=> [ 'litho_item_use_image' => 'image' ],
						]
					);
					$repeater->add_control(
						'litho_carousel_digit',
						[
							'label' 		=> __( 'Digit', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_carousel_title',
						[
							'label' 		=> __( 'Title', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'default' 		=> __( 'Write title here', 'litho-addons' ),
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_carousel_subtitle',
						[
							'label' 		=> __( 'Subtitle', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'default' 		=> __( 'Write subtitle here', 'litho-addons' ),
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_carousel_description',
						[
							'label' 		=> __( 'Description', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXTAREA,
							'dynamic' => [
								'active' => true
							],
							'default' 		=> __( 'Lorem Ipsum is simply dummy the text of the printing & typesetting.', 'litho-addons' ),
						]
					);				
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_carousel_button_tab', [ 'label' => __( 'Button', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_carousel_button_text',
						[
							'label' 		=> __( 'Button Text', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'label_block' 	=> true,
							'default' 		=> __( 'Click Here', 'litho-addons' ),
						]
					);
					$repeater->add_control(
						'litho_link',
						[
							'label' 		=> __( 'Link', 'litho-addons' ),
							'type' 			=> Controls_Manager::URL,
							'dynamic'       => [
								'active' => true,
							],
							'default' 		=> [
								'url' 		=> '#',
							],
							'label_block' 	=> true,
							'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
						]
					);
					$repeater->add_control(
						'litho_selected_icon',
						[
							'label' 			=> __( 'Icon', 'litho-addons' ),
							'type' 				=> Controls_Manager::ICONS,
							'label_block' 		=> true,
							'fa4compatibility' 	=> 'icon',
						]
					);
				$repeater->end_controls_tab();
			$repeater->end_controls_tabs();
			$this->add_control(
				'litho_carousel_slider',
				[
					'label' 		=> __( 'Carousel Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_carousel_title' 		=> __( 'Write title here', 'litho-addons' ),
							'litho_carousel_subtitle' 		=> __( 'Write subtitle here', 'litho-addons' ),
							'litho_carousel_description' 	=> __( 'Lorem Ipsum is simply dummy the text of the printing & typesetting.', 'litho-addons' ),
						],
						[
							'litho_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_carousel_title' 		=> __( 'Write title here', 'litho-addons' ),
							'litho_carousel_subtitle' 		=> __( 'Write subtitle here', 'litho-addons' ),
							'litho_carousel_description' 	=> __( 'Lorem Ipsum is simply dummy the text of the printing & typesetting.', 'litho-addons' ),
						],
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
					'default' 		=> 'h3'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_image_carousel_setting',
				[
					'label' 		=> __( 'Slider Configuration', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator' 	=> 'none',
				]
			);
			$slides_to_show = range( 1, 10 );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
			$this->add_responsive_control(
				'litho_slides_to_show',
				[
					'label' 		=> __( 'Slides to Show', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 1,
					'options' 		=> [
						'' 			=> __( 'Default', 'litho-addons' ),
					] + $slides_to_show,
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
					'range' 		=> [
						'px' => [
							'min' => 0,
							'max' => 100
						]
					],
					'default' 		=> [ 'unit' => 'px', 'size' => 30 ],
					'condition' 	=> [ 'litho_slides_to_show' => '1' ],
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
				'litho_centered_slides',
				[
					'label' 		=> __( 'Center Slide', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'condition' => [
						'litho_slides_to_show!' => '1',
						'litho_carousel_slide_styles!' => [ 'content-carousel-style-5', 'content-carousel-style-7' ], // NOT IN
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
					'condition' => [
						'litho_navigation' => [ 'both', 'arrows' ],
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
						'litho_navigation' => [ 'both', 'arrows' ],
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
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_general',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' => [
						'litho_carousel_slide_styles' => [ 'content-carousel-style-1', 'content-carousel-style-2' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_swiper_container_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'placeholder'   => [
						'top'       => 'auto',
						'right'     => '',
						'bottom'    => 'auto',
						'left'      => '',
					],
					'selectors'     => [
						'{{WRAPPER}} .content-carousel-style-1.swiper' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
						'{{WRAPPER}} .content-carousel-style-2.swiper' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
					],
					'allowed_dimensions' => 'horizontal',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_image',
				[
					'label' 		=> __( 'Slides', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_slides_text_align',
				[
					'label' 		=> __( 'Text Align', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'left' 		=> [
							'title' 	=> __( 'Left', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-left',
						],
						'center' 	=> [
							'title'	 	=> __( 'Center', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-center',
						],
						'right' 	=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-right',
						],
					],
					'default' 		=> 'left',
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide, {{WRAPPER}} .content-carousel-style-6 .content-box' => 'text-align: {{VALUE}}',
					],
					'condition' => [
						'litho_carousel_slide_styles!' => 'content-carousel-style-5', // NOT IN
					]

				]
			);
			$this->add_responsive_control(
				'litho_slides_h_alignment',
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
						'{{WRAPPER}} .content-carousel-style-3 .content-box' => 'display: flex; flex-direction: column; justify-content: {{VALUE}};',
					],
					'condition' => [
						'litho_carousel_slide_styles' => 'content-carousel-style-3', // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_content_box_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .swiper-slide .content-box',
				]
			);
			$this->add_control(
				'litho_image_opacity',
				[
					'label'		=> __( 'Image Opacity', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 1,
							'min' 	=> 0.10,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .swiper-slide:not(.swiper-slide-active) .content-image' => 'opacity: {{SIZE}};',
					],
					'condition' 	=> [
						'litho_carousel_slide_styles' => [ 'content-carousel-style-5', 'content-carousel-style-7' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_image_height',
				[
					'label' 	=> __( 'Image Height', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .content-image' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_carousel_slide_styles' => [ 'content-carousel-style-5', 'content-carousel-style-7' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_content_box_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .content-carousel-wrapper .content-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_carousel_slide_styles!' => [ 'content-carousel-style-5', 'content-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_content_box_border',
					'selector' 		=> '{{WRAPPER}} .content-carousel-wrapper .content-slider',
					'condition' => [
						'litho_carousel_slide_styles!' => [ 'content-carousel-style-5', 'content-carousel-style-7' ], // NOT IN
					],
					'separator' 	=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_content_box_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_content_box_content_width',
				[
					'label' 	=> __( 'Content Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'default' => [
						'unit' 		=> '%',
						'size' 		=> '',
					],
					'selectors' => [
						'{{WRAPPER}} .content-box' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'litho_carousel_slide_styles' => [ 'content-carousel-style-3', 'content-carousel-style-4', 'content-carousel-style-5', 'content-carousel-style-7' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_content_box_content_height',
				[
					'label' 	=> __( 'Content Height', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'default' => [
						'unit' 		=> '%',
						'size' 		=> '',
					],
					'selectors' => [
						'{{WRAPPER}} .content-carousel-style-3 .content-box' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'litho_carousel_slide_styles' => [ 'content-carousel-style-3' ] ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_content_image',
				[
					'label' 		=> __( 'Icon or Image', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					//'condition' => [ 'litho_carousel_slide_styles' => [ 'content-carousel-style-1', 'content-carousel-style-2', 'content-carousel-style-3' ] ],
				]
			);
			$this->add_control(
				'litho_heading_style_icons',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
				]
			);
			$this->add_control(
				'litho_view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'default' 	=> __( 'Default', 'litho-addons' ),
						'stacked' 	=> __( 'Stacked', 'litho-addons' ),
						'framed' 	=> __( 'Framed', 'litho-addons' ),
					],
					'default' 		=> 'default',
					'prefix_class' 	=> 'elementor-view-',
				]
			);
			$this->add_control(
				'litho_icon_shape',
				[
					'label' 		=> __( 'Shape', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'circle' 	=> __( 'Circle', 'litho-addons' ),
						'square' 	=> __( 'Square', 'litho-addons' ),
					],
					'default' 		=> 'circle',
					'condition' 	=> [
						'litho_view!'	 => 'default',
					],
					'prefix_class' 	=> 'elementor-shape-',
				]
			);
			$this->add_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_icon_style_tabs' );
				$this->start_controls_tab(
					'litho_icon_style_normal_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_icon_color',
						'condition' => [
							'litho_view' 	=> 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .elementor-icon i:before',
					]
				);
				$this->add_control(
					'litho_primary_color',
					[
						'label'			=> __( 'Primary Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'condition'		=> [
								'litho_view!' => 'default',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_secondary_color',
					[
						'label' 		=> __( 'Secondary Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'condition'		=> [
							'litho_view!'	=> 'default',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_icon_style_hover_tab',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_hover_icon_color',
						'condition' => [
							'litho_view' 			=> 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default:hover .elementor-icon i:before',
					]
				);
				$this->add_control(
					'litho_hover_primary_color',
					[
						'label' => __( 'Primary Color', 'litho-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon, {{WRAPPER}}.elementor-view-default:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_hover_secondary_color',
					[
						'label' => __( 'Secondary Color', 'litho-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon' 	=> 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_heading_style_image',
				[
					'label' 		=> __( 'Image', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_icon_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator'		=> 'none'
				]
			);
			$this->add_responsive_control(
				'litho_content_image_w_size',
				[
					'label' 	=> __( 'Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'default' => [
						'unit' 		=> '%',
						'size' 		=> 25,
					],
					'selectors' => [
						'{{WRAPPER}} .content-carousel-style-3 .swiper-slide .content-box img, {{WRAPPER}} .swiper-slide .content-box .icon-image' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_content_image_h_size',
				[
					'label' 	=> __( 'Height', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'default' => [
						'unit' 		=> '%',
						'size' 		=> 25,
					],
					'selectors' => [
						'{{WRAPPER}} .content-carousel-style-3 .swiper-slide .content-box img, {{WRAPPER}} .swiper-slide .content-box .icon-image' => 'height: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_content_image_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 500 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .content-carousel-style-3 .swiper-slide .content-box img, {{WRAPPER}} .swiper-slide .content-box .icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_content_image_box_shadow',
					'selector'      => '{{WRAPPER}} .content-carousel-style-3 .swiper-slide .content-box img, {{WRAPPER}} .swiper-slide .content-box .icon-image',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_content_image_border',
					'selector'      => '{{WRAPPER}} .content-carousel-style-3 .swiper-slide .content-box img, {{WRAPPER}} .swiper-slide .content-box .icon-image',
				]
			);
			$this->add_responsive_control(
				'litho_content_image_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .content-carousel-style-3 .swiper-slide .content-box img, {{WRAPPER}} .swiper-slide .content-box .icon-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_digit',
				[
					'label' 		=> __( 'Digit', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' => [
						'litho_carousel_slide_styles' => [ 'content-carousel-style-5', 'content-carousel-style-7' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_digit_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .slider-digit' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_digit_background_color',
				[
					'label' 		=> __( 'Background Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .slider-digit' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'litho_carousel_slide_styles' => 'content-carousel-style-7', // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_digit_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .swiper-slide .slider-digit',
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_section_style_carousel_separator',
				[
					'label' 		=> __( 'Separator', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_carousel_slide_styles' => 'content-carousel-style-5', // IN
					],
				]
			);
			$this->add_control(
				'litho_separator',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes'
				]
			);
			$this->add_control(
				'litho_separator_height',
				[
					'label' 		=> __( 'Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 50 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .separator' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'litho_separator_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .separator' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_title_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .slide-title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'litho_title_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .slide-title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .slide-title',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_subtitle',
				[
					'label' 		=> __( 'Subtitle', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_subtitle_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .slide-subtitle:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'litho_subtitle_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .slide-subtitle' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_subtitle_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .slide-subtitle',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_description',
				[
					'label' 		=> __( 'Description', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_description_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'litho_description_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .slide-description' => 'color: {{VALUE}};',
					],				
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_description_typography',
					'selector' 	=> '{{WRAPPER}} .slide-description',
				]
			);
			$this->add_responsive_control(
				'litho_description_width',
				[
					'label' 	=> __( 'Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'default' => [
						'unit' 		=> '%',
						'size' 		=> '',
					],
					'selectors' => [
						'{{WRAPPER}} .slide-description' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_button',
				[
					'label' 			=> __( 'Button', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_size',
				[
					'label' 			=> __( 'Size', 'litho-addons' ),
					'type' 				=> Controls_Manager::SELECT,
					'default' 			=> 'xs',
					'options' 			=> self::get_button_sizes(),
					'style_transfer' 	=> true,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->start_controls_tabs( 'litho_tabs_button_style' );
			$this->start_controls_tab(
				'litho_tab_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_button_text_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->add_control(
				'litho_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tab_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_hover_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} a.elementor-button:hover svg, {{WRAPPER}} .elementor-button:hover svg, {{WRAPPER}} a.elementor-button:focus svg, {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_button_background_hover_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus',
				]
			);

			$this->add_control(
				'litho_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_border_border!' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_button_hover_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->add_control(
				'litho_button_hover_transition',
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
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'transition-duration: {{SIZE}}s',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
				]
			);
			$this->add_responsive_control(
				'litho_text_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_heading_style_button_icon',
				[
					'label' 		=> __( 'Button icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);

			$this->add_control(
				'litho_icon_align',
				[
					'label' 		=> __( 'Icon Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'left',
					'options' 		=> [
						'left' 		=> __( 'Before', 'litho-addons' ),
						'right' 	=> __( 'After', 'litho-addons' ),
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography_icon',
					'selector' 	=> '{{WRAPPER}} .elementor-button .elementor-button-icon',
					'exclude' 	=> [
						'text_transform',
						'text_decoration',
						'letter_spacing'
					],
					'condition' => [
						'litho_carousel_slide_styles' => 'content-carousel-style-7', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_left_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [
						'litho_icon_align'	=> 'left'
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_right_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [
						'litho_icon_align'	=> 'right'
					],
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_overlay',
				[
					'label' 			=> __( 'Overlay', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_carousel_slide_styles' => 'content-carousel-style-7', // IN
					],
				]
			);
			$this->add_control(
				'litho_slide_overlay_enable',
				[
					'label' 		=> __( 'Overlay', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'return_value'	=> 'yes',
					'condition' 	=> [
						'litho_carousel_slide_styles' => 'content-carousel-style-7', // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_slide_background_overlay',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .swiper-slide .slide-overlay',
					'condition' 	=> [
						'litho_carousel_slide_styles' => 'content-carousel-style-7', // IN
					],
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
					'label' 		=> __( 'Arrows', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
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
						'litho_carousel_slide_styles' => [ 'content-carousel-style-2', 'content-carousel-style-5', 'content-carousel-style-6', 'content-carousel-style-7' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_custom_position_top',
				[
					'label' 		=> __( 'Top', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => -1000, 'max' => 1000 ] ],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-prev' => 'top: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-next' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_arrows_position' 	=> 'custom',
						'litho_navigation'			=> [ 'arrows', 'both' ],
						'litho_carousel_slide_styles' => [ 'content-carousel-style-2', 'content-carousel-style-5', 'content-carousel-style-6', 'content-carousel-style-7' ], // IN
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
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next' => 'width: {{SIZE}}{{UNIT}} !important;',
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
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next' => 'height: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev i, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next' => 'line-height: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_arrows_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->start_controls_tabs( 'litho_arrows_box_style' );
				$this->start_controls_tab(
					'litho_arrows_box_normal_style',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);

				$this->add_control(
					'litho_arrows_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
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
						'selector' 			=> '{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next',
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_box_border',
						'selector'      => '{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_arrows_box_hover_style',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_arrows_hover_color',
					[
						'label' 		=> __( 'Text Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev:hover svg, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next:hover svg, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev:focus svg, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev:focus svg' => 'fill: {{VALUE}};',
						],
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
						'selector' 			=> '{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next:hover',
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_box_border_hover',
						'selector'      => '{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next:hover',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_heading_style_dots',
				[
					'label' 		=> __( 'Dots', 'litho-addons' ),
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
				'litho_dots_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 5, 'max' => 10 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
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
			$this->add_control(
				'litho_dots_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render content carousel widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$slides       = [];
			$slides_count = '';
			$settings     = $this->get_settings_for_display();

			if ( empty( $settings['litho_carousel_slider'] ) ) {
				return;
			}

			$is_new              = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$id_int              = substr( $this->get_id_int(), 0, 3 );
			$left_icon_migrated  = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
			$right_icon_migrated = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );

			$this->add_render_attribute( [
				'content-wrapper' => [
					'class' => 'elementor-button-content-wrapper',
				],
				'icon-align' => [
					'class' => [
						'elementor-button-icon',
						'elementor-align-icon-' . $settings['litho_icon_align'],
					],
				],
				'litho_text' => [
					'class' => 'elementor-button-text',
				],
			] );

			/* Custom button hover effect */
			$hover_animation_effect_array = litho_custom_hover_animation_effect();
			$litho_carousel_slide_styles  = ( isset( $settings['litho_carousel_slide_styles'] ) && $settings['litho_carousel_slide_styles'] ) ? $settings['litho_carousel_slide_styles'] : '';

			switch ( $litho_carousel_slide_styles ) {
				case 'content-carousel-style-3':
				case 'content-carousel-style-4':
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						$image_url       = '';
						$wrapper_key     = 'wrapper_' . $index;
						$img_key         = 'img_' . $index;
						$link_key        = 'link_' . $index;
						$btn_wrapper_key = 'btn_' . $index;
						$migrated        = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new          = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( ! empty( $item['litho_carousel_image']['id'] ) ) {
							$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_carousel_image']['id'], 'litho_thumbnail', $settings );

						} elseif ( ! empty( $item['litho_carousel_image']['url'] ) ) {
							
							$image_url = $item['litho_carousel_image']['url'];
						}

						$this->add_render_attribute( [
							$btn_wrapper_key => [
								'class' => [ 'elementor-button-wrapper', 'litho-button-wrapper' ] ]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-button-link' );
							$this->add_link_attributes( $link_key, $item['litho_link'] );
						}

						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$custom_animation_class = '';
							$this->add_render_attribute( $link_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
							$this->add_render_attribute( $link_key, 'class', [ $custom_animation_class ] );
						}

						$this->add_render_attribute( $link_key, 'class', 'elementor-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $this->get_settings( 'litho_size' ) ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $this->get_settings( 'litho_size' ) );
						}
						
						$image_url = ( $image_url ) ? 'background-image: url('. esc_url( $image_url ) .'); background-repeat: no-repeat;' : '';

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$this->add_render_attribute( $img_key, [
							'class' => [ 'cover-background', 'content-image' ],
							'style' => $image_url
						] );

						$icon     = '';
						$migrated = isset( $item['__fa4_migrated']['litho_item_icon'] );
						$is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( $is_new || $migrated ) {
							ob_start();
								Icons_Manager::render_icon( $item['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
							$icon .= ob_get_clean();
						} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
							$icon .= '<i class="' . esc_attr( $item['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
						}

						$litho_thumb_image = $this->litho_get_icon_image( $item );

						ob_start();
						?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
								<div <?php $this->print_render_attribute_string( $img_key ); // phpcs:ignore ?>>
									<div class="content-box">
										<?php
										if ( 'none' != $item['litho_item_use_image'] ) {
											if ( ! empty( $icon ) && ( 'icon' === $item['litho_item_use_image'] ) ) {
											?>
											<div class="elementor-icon"><?php printf( '%s', $icon ); // phpcs:ignore ?></div>
											<?php 
											} else {
												if ( ! empty( $litho_thumb_image ) ) {
													echo sprintf( '%s', $litho_thumb_image ); // phpcs:ignore
												}
											}
										}
										?>
										<?php if ( $item['litho_carousel_title'] ) { ?>
											<div class="slide-title"><?php echo esc_html( $item['litho_carousel_title'] ); ?></div>
										<?php } ?>
										<?php if ( $item['litho_carousel_subtitle'] ) { ?>
											<div class="slide-subtitle"><?php echo esc_html( $item['litho_carousel_subtitle'] ); ?></div>
										<?php } ?>
										<?php if ( $item['litho_carousel_description'] ) { ?>
											<div class="slide-description"><?php echo sprintf( '%s', wp_kses_post( $item['litho_carousel_description'] ) ); ?></div>
										<?php } ?>
										<?php if ( $item['litho_carousel_button_text'] ) { ?>
											<div <?php $this->print_render_attribute_string( $btn_wrapper_key ); // phpcs:ignore ?>>
												<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore ?>>
													<span <?php $this->print_render_attribute_string( 'content-wrapper' ); // phpcs:ignore ?>>
														<?php if ( ! empty( $item['icon'] ) || ! empty( $item['litho_selected_icon']['value'] ) ) : ?>
														<span <?php $this->print_render_attribute_string( 'icon-align' ); // phpcs:ignore ?>>
															<?php
															if ( $is_new || $migrated ) {
																Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
																?><i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i><?php
															}
															?>
														</span>
														<?php endif; ?>
														<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore ?>><?php echo esc_html( $item['litho_carousel_button_text'] ); ?></span>
													</span>
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'content-carousel-style-5':
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						$image_url       = '';
						$index           = $index + 1;
						$wrapper_key     = 'wrapper_' . $index;
						$img_key         = 'img_' . $index;
						$link_key        = 'link_' . $index;
						$btn_wrapper_key = 'btn_' . $index;
						$migrated        = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new          = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( ! empty( $item['litho_carousel_image']['id'] ) ) {
							$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_carousel_image']['id'], 'litho_thumbnail', $settings );
						} elseif ( ! empty( $item['litho_carousel_image']['url'] ) ) {
							$image_url = $item['litho_carousel_image']['url'];
						}

						$this->add_render_attribute( [
							$btn_wrapper_key => [
								'class' => [
									'elementor-button-wrapper',
									'litho-button-wrapper',
								]
							]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							
							$this->add_render_attribute( $link_key, 'class', 'elementor-button-link' );
							$this->add_link_attributes( $link_key, $item['litho_link'] );
						}

						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$custom_animation_class = '';
							$this->add_render_attribute( $link_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
							$this->add_render_attribute( $link_key, 'class', [ $custom_animation_class ] );
						}

						$this->add_render_attribute( $link_key, 'class', 'elementor-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $this->get_settings( 'litho_size' ) ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $this->get_settings( 'litho_size' ) );
						}
						
						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$image_url = ( $image_url ) ? 'background-image: url('. esc_url( $image_url ) .'); background-repeat: no-repeat;' : '';

						$this->add_render_attribute( $img_key, [
							'class' => [ 'col-12', 'cover-background', 'content-image', 'align-items-end', 'd-flex', 'justify-content-end' ],
							'style' => $image_url
						] );

						$icon     = '';
						$migrated = isset( $item['__fa4_migrated']['litho_item_icon'] );
						$is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( $is_new || $migrated ) {
							ob_start();
								Icons_Manager::render_icon( $item['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
							$icon .= ob_get_clean();
						} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
							$icon .= '<i class="' . esc_attr( $item['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
						}
						
						$litho_thumb_image = $this->litho_get_icon_image( $item );

						ob_start();
						?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
								<div <?php $this->print_render_attribute_string( $img_key ); // phpcs:ignore ?>></div>
								<div class="content-box">
									<?php 
									if ( 'none' != $item['litho_item_use_image'] ) {
										if ( ! empty( $icon ) && ( 'icon' === $item['litho_item_use_image'] ) ) {
										?>
										<div class="elementor-icon"><?php printf( '%s', $icon ); // phpcs:ignore ?></div>
										<?php 
										} else {
											if ( ! empty( $litho_thumb_image ) ) {
												echo sprintf( '%s', $litho_thumb_image ); // phpcs:ignore
											}
										}
									}
									?>
									<?php if ( $item['litho_carousel_digit'] || $item['litho_carousel_subtitle'] ) { ?>
										<div class="col-12 d-md-inline-block align-items-center justify-content-center slider-text-wrap">
											<div class="media">
												<?php if ( $item['litho_carousel_digit'] ) { ?>
													<span class="alt-font d-inline-block align-middle slider-digit"><?php echo esc_html( $item['litho_carousel_digit'] ); ?></span>
												<?php } ?>
												<?php if ( 'yes' === $this->get_settings( 'litho_separator' ) ) { ?>
													<span class="separator"></span>
												<?php } ?>
												<?php if ( $item['litho_carousel_subtitle'] ) { ?>
													<div class="slide-subtitle"><?php echo esc_html( $item['litho_carousel_subtitle'] ); ?></div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
									<?php if ( $item['litho_carousel_title'] ) { ?>
										<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="align-self-center slide-title"><?php echo esc_html( $item['litho_carousel_title'] ); ?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
									<?php } ?>
									<?php if ( $item['litho_carousel_description'] ) { ?>
										<div class="slide-description"><?php echo sprintf( '%s', wp_kses_post( $item['litho_carousel_description'] ) ); ?></div>
									<?php } ?>
									<?php if ( $item['litho_carousel_button_text'] ) { ?>
										<div <?php $this->print_render_attribute_string( $btn_wrapper_key ); // phpcs:ignore ?>>
											<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore ?>>
												<span <?php $this->print_render_attribute_string( 'content-wrapper' ); // phpcs:ignore ?>>
													<?php if ( ! empty( $item['icon'] ) || ! empty( $item['litho_selected_icon']['value'] ) ) : ?>
													<span <?php $this->print_render_attribute_string( 'icon-align' ); // phpcs:ignore ?>>
														<?php
														if ( $is_new || $migrated ) {
															Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
														} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
															?><i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i><?php
														}
														?>
													</span>
													<?php endif; ?>
													<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore ?>><?php echo esc_html( $item['litho_carousel_button_text'] ); ?></span>
												</span>
											</a>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'content-carousel-style-6':
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						$image_url       = '';
						$wrapper_key     = 'wrapper_' . $index;
						$img_key         = 'img_' . $index;
						$link_key        = 'link_' . $index;
						$btn_wrapper_key = 'btn_' . $index;
						$migrated        = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new          = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( ! empty( $item['litho_carousel_image']['id'] ) ) {

							$srcset_data              = litho_get_image_srcset_sizes( $item['litho_carousel_image']['id'], $settings['litho_thumbnail_size'] );
							$litho_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_carousel_image']['id'], 'litho_thumbnail', $settings );
							$litho_carousel_image_alt = Control_Media::get_image_alt( $item['litho_carousel_image'] );
							$litho_carousel_image     = sprintf( '<img class="slide-img" src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_carousel_image_url ), esc_attr( $litho_carousel_image_alt ), $srcset_data ); // phpcs:ignore

						} elseif ( ! empty( $item['litho_carousel_image']['url'] ) ) {
							$litho_carousel_image_url = $item['litho_carousel_image']['url'];
							$litho_carousel_image_alt = '';
							$litho_carousel_image     = sprintf( '<img class="slide-img" src="%1$s" alt="%2$s" />', esc_url( $litho_carousel_image_url ), esc_attr( $litho_carousel_image_alt ) );
						}

						$this->add_render_attribute( [
							$btn_wrapper_key => [
								'class' => [
									'elementor-button-wrapper',
									'litho-button-wrapper',
								]
							]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							
							$this->add_render_attribute( $link_key, 'class', 'elementor-button-link' );
							$this->add_link_attributes( $link_key, $item['litho_link'] );
						}

						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$custom_animation_class = '';
							$this->add_render_attribute( $link_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
							$this->add_render_attribute( $link_key, 'class', [ $custom_animation_class ] );
						}

						$this->add_render_attribute( $link_key, 'class', 'elementor-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $this->get_settings( 'litho_size' ) ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $this->get_settings( 'litho_size' ) );
						}

						$this->add_render_attribute( $wrapper_key, [
						   'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$icon     = '';
						$migrated = isset( $item['__fa4_migrated']['litho_item_icon'] );
						$is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( $is_new || $migrated ) {
							ob_start();
								Icons_Manager::render_icon( $item['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
							$icon .= ob_get_clean();
						} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
							$icon .= '<i class="' . esc_attr( $item['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
						}
						
						$litho_thumb_image = $this->litho_get_icon_image( $item );

						ob_start();
						?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
								<div class="content-slider">
									<?php echo sprintf( '%s', $litho_carousel_image ); // phpcs:ignore ?>
									<?php if ( $item['litho_carousel_title'] || $item['litho_carousel_subtitle'] || $item['litho_carousel_description'] || $item['litho_carousel_button_text'] ) { ?>
										<div class="content-box">
											<?php if ( $item['litho_carousel_subtitle'] ) { ?>
												<div class="slide-subtitle"><?php echo esc_html( $item['litho_carousel_subtitle'] ); ?></div>
											<?php } ?>
											<div class="content-box-inner">
												<?php 
												if ( 'none' != $item['litho_item_use_image'] ) {
													if ( ! empty( $icon ) && ( 'icon' === $item['litho_item_use_image'] ) ) {
													?>
													<div class="elementor-icon"><?php printf( '%s', $icon ); // phpcs:ignore ?></div>
													<?php 
													} else {
														if ( ! empty( $litho_thumb_image ) ) {
															echo sprintf( '%s', $litho_thumb_image ); // phpcs:ignore
														}
													}
												} 
												?>
												<?php if ( $item['litho_carousel_title'] ) { ?>
													<div class="slide-title"><?php echo esc_html( $item['litho_carousel_title'] ); ?></div>
												<?php } ?>
												<?php if ( $item['litho_carousel_description'] ) { ?>
													<div class="slide-description"><?php echo sprintf( '%s', wp_kses_post( $item['litho_carousel_description'] ) ); ?></div>
												<?php } ?>
												<?php if ( $item['litho_carousel_button_text'] ) { ?>
													<div <?php $this->print_render_attribute_string( $btn_wrapper_key ); // phpcs:ignore ?>>
														<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore ?>>
															<span <?php $this->print_render_attribute_string( 'content-wrapper' ); // phpcs:ignore ?>>
																<?php if ( ! empty( $item['icon'] ) || ! empty( $item['litho_selected_icon']['value'] ) ) : ?>
																<span <?php $this->print_render_attribute_string( 'icon-align' ); // phpcs:ignore ?>>
																	<?php
																	if ( $is_new || $migrated ) {
																		Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
																	} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
																		?><i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i><?php
																	}
																	?>
																</span>
																<?php endif; ?>
																<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore ?>><?php echo esc_html( $item['litho_carousel_button_text'] ); ?></span>
															</span>
														</a>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'content-carousel-style-7':
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						$image_url       = '';
						$index           = $index + 1;
						$wrapper_key     = 'wrapper_' . $index;
						$img_key         = 'img_' . $index;
						$link_key        = 'link_' . $index;
						$btn_wrapper_key = 'btn_' . $index;
						$migrated        = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new          = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( ! empty( $item['litho_carousel_image']['id'] ) ) {
							$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_carousel_image']['id'], 'litho_thumbnail', $settings );
						} elseif ( ! empty( $item['litho_carousel_image']['url'] ) ) {
							$image_url = $item['litho_carousel_image']['url'];
						}

						$this->add_render_attribute( [
							$btn_wrapper_key => [
								'class' => [
									'elementor-button-wrapper',
									'litho-button-wrapper',
								]
							]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-button-link' );
							$this->add_link_attributes( $link_key, $item['litho_link'] );
						}

						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$custom_animation_class = '';
							$this->add_render_attribute( $link_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
							$this->add_render_attribute( $link_key, 'class', [ $custom_animation_class ] );
						}

						$this->add_render_attribute( $link_key, 'class', 'elementor-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $this->get_settings( 'litho_size' ) ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $this->get_settings( 'litho_size' ) );
						}

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$image_url = ( $image_url ) ? 'background-image: url('. esc_url( $image_url ) .'); background-repeat: no-repeat;' : '';

						$this->add_render_attribute( $img_key, [
							'class' => [ 'col-12', 'cover-background', 'content-image', 'align-items-end', 'd-flex', 'justify-content-end' ],
							'style' => $image_url
						] );

						$slide_overlay = ( 'yes' === $this->get_settings( 'litho_slide_overlay_enable' ) && $image_url ) ? '<div class="slide-overlay"></div>' : '';

						$icon     = '';
						$migrated = isset( $item['__fa4_migrated']['litho_item_icon'] );
						$is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( $is_new || $migrated ) {
							ob_start();
								Icons_Manager::render_icon( $item['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
							$icon .= ob_get_clean();
						} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
							$icon .= '<i class="' . esc_attr( $item['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
						}
						
						$litho_thumb_image = $this->litho_get_icon_image( $item );

						ob_start();
						?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
								<?php printf( '%s', $slide_overlay ); // phpcs:ignore ?>
								<div <?php $this->print_render_attribute_string( $img_key ); // phpcs:ignore ?>></div>
								<div class="content-box">
									<?php
									if ( 'none' != $item['litho_item_use_image'] ) {
										if ( ! empty( $icon ) && ( 'icon' === $item['litho_item_use_image'] ) ) {
										?>
										<div class="elementor-icon"><?php printf( '%s', $icon ); // phpcs:ignore ?></div>
										<?php 
										} else {
											if ( ! empty( $litho_thumb_image ) ) {
												echo sprintf( '%s', $litho_thumb_image ); // phpcs:ignore
											}
										}
									}
									?>
									<?php if ( $item['litho_carousel_digit'] ) { ?>
										<span class="slider-digit"><?php echo esc_html( $item['litho_carousel_digit'] ); ?></span>
									<?php } ?>
									<?php if ( $item['litho_carousel_title'] ) { ?>
										<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="align-self-center slide-title"><?php echo esc_html( $item['litho_carousel_title'] ); ?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
									<?php } ?>
									<?php if ( $item['litho_carousel_subtitle'] ) { ?>
										<div class="slide-subtitle"><?php echo esc_html( $item['litho_carousel_subtitle'] ); ?></div>
									<?php } ?>
									<?php if ( $item['litho_carousel_description'] ) { ?>
										<div class="slide-description"><?php echo sprintf( '%s', wp_kses_post( $item['litho_carousel_description'] ) ); ?></div>
									<?php } ?>
									<?php if ( $item['litho_carousel_button_text'] ) { ?>
										<div <?php $this->print_render_attribute_string( $btn_wrapper_key ); // phpcs:ignore ?>>
											<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore ?>>
												<span <?php $this->print_render_attribute_string( 'content-wrapper' ); // phpcs:ignore ?>>
													<?php
													if ( isset( $settings['litho_selected_icon'] ) && ! empty( $item['litho_selected_icon'] ) ) :
														?>													
														<span <?php $this->print_render_attribute_string( 'icon-align' ); // phpcs:ignore ?>>
															<?php
															if ( $is_new || $migrated ) {
																Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
																?><i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i><?php
															}
															?>
														</span>
														<?php
													endif;
													?>
													<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore ?>><?php echo esc_html( $item['litho_carousel_button_text'] ); ?></span>
												</span>
											</a>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				default:
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						$image_url       = '';
						$wrapper_key     = 'wrapper_' . $index;
						$img_key         = 'img_' . $index;
						$link_key        = 'link_' . $index;
						$btn_wrapper_key = 'btn_' . $index;
						$migrated        = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new          = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						$this->add_render_attribute( [
							$btn_wrapper_key => [
								'class' => [
									'elementor-button-wrapper',
									'litho-button-wrapper',
								]
							]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_link_attributes( $link_key, $item['litho_link'] );
							$this->add_render_attribute( $link_key, 'class', 'elementor-button-link' );
						}

						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$custom_animation_class = '';
							$this->add_render_attribute( $link_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
							$this->add_render_attribute( $link_key, 'class', [ $custom_animation_class ] );
						}
						
						$this->add_render_attribute( $link_key, 'class', 'elementor-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $this->get_settings( 'litho_size' ) ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $this->get_settings( 'litho_size' ) );
						}
						
						if ( ! empty( $item['litho_carousel_image']['id'] ) ) {
							$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_carousel_image']['id'], 'litho_thumbnail', $settings );
						} elseif ( ! empty( $item['litho_carousel_image']['url'] ) ) {
							$image_url = $item['litho_carousel_image']['url'];
						}

						$image_url  = ( $image_url ) ? 'background-image: url('. esc_url( $image_url ) .'); background-repeat: no-repeat;' : '';

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$this->add_render_attribute( $img_key, [
							'class' => [ 'col', 'cover-background', 'content-image' ],
							'style' => $image_url
						] );

						$icon     = '';
						$migrated = isset( $item['__fa4_migrated']['litho_item_icon'] );
						$is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						if ( $is_new || $migrated ) {
							ob_start();
								Icons_Manager::render_icon( $item['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
							$icon .= ob_get_clean();
						} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
							$icon .= '<i class="' . esc_attr( $item['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
						}
						
						$litho_thumb_image = $this->litho_get_icon_image( $item );
						
						ob_start();
						?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
								<div class="row gx-0 row-cols-1 row-cols-sm-2 content-slider">
									<div <?php $this->print_render_attribute_string( $img_key ); // phpcs:ignore ?>></div>
									<div class="col content-box">
										<?php 
										if ( 'none' != $item['litho_item_use_image'] ) {
											if ( ! empty( $icon ) && ( 'icon' === $item['litho_item_use_image'] ) ) {
											?>
											<div class="elementor-icon"><?php printf( '%s', $icon ); // phpcs:ignore ?></div>
											<?php 
											} else {
												if ( ! empty( $litho_thumb_image ) ) {
													echo sprintf( '%s', $litho_thumb_image ); // phpcs:ignore
												}
											}
										}
										?>
										<?php if ( $item['litho_carousel_title'] ) { ?>
											<div class="slide-title"><?php echo esc_html( $item['litho_carousel_title'] ); ?></div>
										<?php } ?>
										<?php if ( $item['litho_carousel_subtitle'] ) { ?>
											<div class="slide-subtitle"><?php echo esc_html( $item['litho_carousel_subtitle'] ); ?></div>
										<?php } ?>
										<?php if ( $item['litho_carousel_description'] ) { ?>
											<div class="slide-description"><?php echo sprintf( '%s', wp_kses_post( $item['litho_carousel_description'] ) ); ?></div>
										<?php } ?>
										<?php if ( $item['litho_carousel_button_text'] ) { ?>
											<div <?php $this->print_render_attribute_string( $btn_wrapper_key ); // phpcs:ignore ?>>
												<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore ?>>
													<span <?php $this->print_render_attribute_string( 'content-wrapper' ); // phpcs:ignore ?>>
														<?php if ( ! empty( $item['icon'] ) || ! empty( $item['litho_selected_icon']['value'] ) ) : ?>
														<span <?php $this->print_render_attribute_string( 'icon-align' ); // phpcs:ignore ?>>
															<?php
															if ( $is_new || $migrated ) {
																Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
																?><i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i><?php
															}
															?>
														</span>
														<?php endif; ?>
														<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore ?>><?php echo esc_html( $item['litho_carousel_button_text'] ); ?></span>
													</span>
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
			}
			
			if ( empty( $slides ) ) {
				return;
			}

			$slides_count        = count( $settings['litho_carousel_slider'] );
			$litho_slide_styles  = $this->get_settings( 'litho_carousel_slide_styles' );
			$litho_rtl           = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor = $this->get_settings( 'litho_slider_cursor' );
			$litho_navigation    = $this->get_settings( 'litho_navigation' );

			$sliderConfig = array(
				'navigation'            => $this->get_settings( 'litho_navigation' ),
				'autoplay'              => $this->get_settings( 'litho_autoplay' ),
				'autoplay_speed'        => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover'        => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'                  => $this->get_settings( 'litho_infinite' ),
				'effect'                => $this->get_settings( 'litho_effect' ),
				'speed'                 => $this->get_settings( 'litho_speed' ),
				'image_spacing'         => $this->get_settings( 'litho_items_spacing' ),
				'slides_to_show'        => $this->get_settings( 'litho_slides_to_show' ),
				'slides_to_show_mobile' => $this->get_settings( 'litho_slides_to_show_mobile' ),
				'slides_to_show_tablet' => $this->get_settings( 'litho_slides_to_show_tablet' ),
				'slide_total'           => $slides_count,
			);

			$slideOptions = array();

			switch ( $litho_slide_styles ) {
				case 'content-carousel-style-5':
				case 'content-carousel-style-7':
					$this->add_render_attribute( 'carousel-wrapper', 'class', 'slider-zoom-slide' );

					$slideOptions = array(
						'centered_slides' => 'yes'
					);
					break;
				default:
					$slideOptions = array(
						'centered_slides' => $this->get_settings( 'litho_centered_slides' )
					);
					break;
			} 

			$slideSettingsArray = array_merge( $sliderConfig, $slideOptions );

			$this->add_render_attribute( [
				'carousel-wrapper' => [
					'class' => [
						'content-carousel-wrapper swiper',
						$litho_slide_styles,
						$litho_slider_cursor,
					],
					'data-settings' => json_encode( $slideSettingsArray ),
				],
				'carousel' => [
					'class' => [
						'elementor-content-carousel',
						'swiper-wrapper',
					],
				],
			] );

			if ( ! empty( $litho_rtl ) ) {
				$this->add_render_attribute( 'carousel-wrapper', 'dir', $litho_rtl );
			}
			
			$show_dots   = ( in_array( $litho_navigation, [ 'dots', 'both' ] ) );
			$show_arrows = ( in_array( $litho_navigation, [ 'arrows', 'both' ] ) );

			if ( 'yes' ===  $this->get_settings( 'litho_image_stretch' ) ) {
				$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
			}

			$left_arrow_icon  = '';
			$right_arrow_icon = '';

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
			?>
				<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
					<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
						<?php echo implode( '', $slides ); ?>
					</div>
					<?php if ( 1 < $slides_count ) { ?>
						<?php if ( $show_dots ) { ?>
							<div class="swiper-pagination"></div>
						<?php } ?>
					<?php } ?>
				<?php if ( 'content-carousel-style-3' === $litho_carousel_slide_styles ) { ?>
				</div>
				<div class="slider-arrow-rb">
				<?php } ?>
					<?php if ( 1 < $slides_count ) { ?>
						<?php if ( $show_arrows ) { ?>
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
						<?php } ?>
					<?php } ?>
				</div>
			<?php
		}

		// return icon image
		public function litho_get_icon_image( $item ) {

			$litho_thumb_image = '';
			$settings          = $this->get_settings_for_display();
			if ( ! empty( $item['litho_thumb_image']['id'] ) ) {
				$srcset_data           = litho_get_image_srcset_sizes( $item['litho_thumb_image']['id'], $settings['litho_icon_thumbnail_size'] );
				$litho_thumb_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_thumb_image']['id'], 'litho_icon_thumbnail', $settings );
				$litho_thumb_image_alt = Control_Media::get_image_alt( $item['litho_thumb_image'] );
				$litho_thumb_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s class="icon-image" />', esc_url( $litho_thumb_image_url ), esc_attr( $litho_thumb_image_alt ), $srcset_data ); // phpcs:ignore

			} elseif ( ! empty( $item['litho_thumb_image']['url'] ) ) {
				$litho_thumb_image_url = $item['litho_thumb_image']['url'];
				$litho_thumb_image_alt = '';
				$litho_thumb_image     = sprintf( '<img src="%1$s" alt="%2$s" class="icon-image" />', esc_url( $litho_thumb_image_url ), esc_attr( $litho_thumb_image_alt ) );
			}
			return $litho_thumb_image;
		}
	}
}
