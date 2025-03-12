<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
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
 * Litho widget for slider.
 *
* @package Litho
 */

// If class `Slider` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Slider' ) ) {

	class Slider extends Widget_Base {

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
			return 'litho-slider';
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
			return __( 'Litho Slider', 'litho-addons' );
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
			return 'eicon-slider-push';
		}
		/**
		 * Retrieve the list of scripts the image carousel widget depended on.
		 *
		 * Used to set scripts dependencies required to run the widget.
		 *
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
			return [ 'image', 'slide', 'carousel', 'slider' ];
		}

		/**
		 * Get button sizes.
		 *
		 * Retrieve an array of button sizes for the button widget.
		 *
		 *
		 * @access public
		 * @static
		 *
		 * @return array An array containing button sizes.
		 */
		public static function get_button_sizes() {
			return [
				'default' => __( 'Default', 'litho-addons' ),
				'xs'      => __( 'Extra Small', 'litho-addons' ),
				'sm'      => __( 'Small', 'litho-addons' ),
				'md'      => __( 'Medium', 'litho-addons' ),
				'lg'      => __( 'Large', 'litho-addons' ),
				'xl'      => __( 'Extra Large', 'litho-addons' ),
			];
		}
		/**
		 * Register slider widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_image_carousel_general',
				[
					'label' => __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_carousel_slide_styles',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'slider-style-1',
					'options' 		=> [						
						'slider-style-1' => __( 'Style 1', 'litho-addons' ),
						'slider-style-2' => __( 'Style 2', 'litho-addons' ),
						'slider-style-3' => __( 'Style 3', 'litho-addons' ),
						'slider-style-4' => __( 'Style 4', 'litho-addons' ),
					], 
					'frontend_available' => true,
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_section_image_carousel',
				[
					'label' 	=> __( 'Slides', 'litho-addons' ),
				]
			);
			$repeater = new Repeater();
			$repeater->start_controls_tabs( 'litho_carousel_image_tabs' );
				$repeater->start_controls_tab( 'litho_carousel_image_content_tab', [ 'label' 	=> __( 'Content', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_carousel_title',
						[
							'label' 		=> __( 'Title', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'default' 		=> __( 'Write title here', 'litho-addons' ),
							'label_block' 	=> true,
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
							'label_block' 	=> true,
							'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
						]
					);
					$repeater->add_control(
						'litho_carousel_subtitle',
						[
							'label' 		=> __( 'Subtitle', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'default' 		=> __( 'Write subtitle here', 'litho-addons' ),
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_button_text',
						[
							'label' 		=> __( 'Button Text', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'default' 		=> __( 'Click Here', 'litho-addons' ),
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_button_link',
						[
							'label' 		=> __( 'Link', 'litho-addons' ),
							'type' 			=> Controls_Manager::URL,
							'dynamic'       => [
								'active' => true,
							],
							'label_block' 	=> true,
							'default' 		=> [
								'url' 		=> '#',
							],
							'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
						]
					);

					$repeater->add_control(
						'litho_second_button_text',
						[
							'label' 		=> __( 'Second Button Text', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_second_button_link',
						[
							'label' 		=> __( 'Second Button Link', 'litho-addons' ),
							'type' 			=> Controls_Manager::URL,
							'dynamic'       => [
								'active' => true,
							],
							'label_block' 	=> true,
							'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
						]
					);

				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_carousel_image_background_tab', [ 'label' => __( 'Background', 'litho-addons' ) ] );
					$repeater->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'litho_carousel_image_background',
							'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.swiper-slide',
							'fields_options' => [
								'background' => [
									'default' => 'classic',
								],
								'image' => [
									'default' => [
										'url' => Utils::get_placeholder_image_src(),
									],
								],
							],
						]
					);
				$repeater->end_controls_tab();
			$repeater->end_controls_tabs();

			$this->add_control(
				'litho_carousel_slider',
				[
					'label' 		=> __( 'Carousel Items', 'litho-addons' ),
					'label_block' 	=> true,
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_carousel_title' 	=> __( 'Write title here', 'litho-addons' ),
							'litho_carousel_subtitle' 	=> __( 'Write subtitle here', 'litho-addons' ),
						],
						[
							'litho_carousel_title' 	=> __( 'Write title here', 'litho-addons' ),
							'litho_carousel_subtitle' 	=> __( 'Write subtitle here', 'litho-addons' ),
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
			$this->add_control(
				'litho_carousel_slider_horizontal_separator',
				[
					'label' 		=> __( 'Horizontal Separator', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-4' ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_carousel_setting',
				[
					'label' 		=> __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_full_screen',
				[
					'label' 		=> __( 'Full Screen Slider', 'litho-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'label_on' 		=> __( 'Yes', 'litho-addons' ),
					'label_off' 	=> __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
				]
			);
			$this->add_responsive_control(
				'litho_slider_height',
				[
					'label' => __( 'Height', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 2000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .swiper' => 'height: {{SIZE}}{{UNIT}} !important',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator' 	=> 'before',
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
				'litho_navigation',
				[
					'label' 		=> __( 'Navigation', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'both',
					'options' 		=> [
						'both' 			=> __( 'Arrows and Dots', 'litho-addons' ),
						'arrows' 		=> __( 'Arrows', 'litho-addons' ),
						'dots' 			=> __( 'Dots', 'litho-addons' ),
						'none'			=> __( 'None', 'litho-addons' ),
					]
				]
			);
			$this->add_control(
				'litho_number_pagination',
				[
					'label' 		=> __( 'Show Pagination', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'condition'     => [ 
						'litho_carousel_slide_styles' => 'slider-style-4', // IN
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
					'default' 		=> 5000,
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
						'slide'			=> __( 'Slide', 'litho-addons' ),
						'fade' 			=> __( 'Fade', 'litho-addons' ),
					]
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
				]
			);
			$this->add_control(
				'litho_direction',
				[
					'label' 		=> __( 'Direction', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'horizontal',
					'options' 		=> [
						'horizontal'	=> __( 'Horizontal', 'litho-addons' ),
						'vertical' 		=> __( 'Vertical', 'litho-addons' ),
					],
					'condition'     => [ 'litho_carousel_slide_styles!' => 'slider-style-2' ], // NOT IN
				]
			);
            $this->add_control(
                'litho_direction_mobile',
                [
                    'label'         => __( 'Direction for Device', 'litho-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'condition'     => [ 'litho_carousel_slide_styles!' => 'slider-style-2' ], // NOT IN
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
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_arrows_options',
				[
					'label' 		=> __( 'Arrows', 'litho-addons' ),
					'condition' 	=> [
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
					]
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
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_image',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_content_max_width',
				[
					'label' 			=> __( 'Content Width', 'litho-addons' ),
					'type' 				=> Controls_Manager::SLIDER,
					'size_units'    	=> [ 'px', '%', 'custom' ],
					'range'         	=> [ 
						'px'   => [ 'min' => 0, 'max' => 2000 ],
						'%'   => [ 'min' => 0, 'max' => 100 ]
					],
					'selectors' 		=> [
						'{{WRAPPER}} .slider-text-middle-main' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_content_box_background',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .slider-text-middle-main',
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-1' ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_slides_vertical_position',
				[
					'label' 		=> __( 'Vertical Align', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'flex-start' 	=> [
							'title' 	=> __( 'Top', 'litho-addons' ),
							'icon' 		=> 'eicon-v-align-top',
						],
						'center' 		=> [
							'title' 	=> __( 'Middle', 'litho-addons' ),
							'icon' 		=> 'eicon-v-align-middle',
						],
						'flex-end' 		=> [
							'title' 	=> __( 'Bottom', 'litho-addons' ),
							'icon' 		=> 'eicon-v-align-bottom',
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide' => 'align-content: {{VALUE}}; align-items: {{VALUE}};',
					],
					'default' 		=> 'center',
				]
			);
			$this->add_responsive_control(
				'litho_slides_horizontal_position',
				[
					'label' 		=> __( 'Horizontal Align', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'flex-start' 	=> [
							'title' 	=> __( 'LEFT', 'litho-addons' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> __( 'Center', 'litho-addons' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'flex-end' 		=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide' => 'justify-content: {{VALUE}};',
					],
					'default' 		=> 'center',
					//'condition'     => [ 'litho_carousel_slide_styles!' => [ 'slider-style-2', 'slider-style-3', 'slider-style-4' ] ], // NOT IN
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
					'default' 		=> 'center',
					'selectors' 	=> [
						'{{WRAPPER}} .slider-text-middle-main' => 'text-align: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_slides_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .slider-text-middle-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_slides_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-text-middle-main' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_carousel_slider_horizontal_separator_box_heading',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Bottom Horizontal Separator Box', 'litho-addons' ),
					'separator' => 'before',
					'condition'     => [
						'litho_carousel_slider_horizontal_separator!'	=> '',
						'litho_carousel_slide_styles' 					=> 'slider-style-4', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_carousel_slider_horizontal_separator_box_max_width',
				[
					'label' 			=> __( 'Width', 'litho-addons' ),
					'type' 				=> Controls_Manager::SLIDER,
					'size_units'    	=> [ 'px', '%', 'custom' ],
					'range'         	=> [ 
						'px'   => [ 'min' => 0, 'max' => 2000 ],
						'%'   => [ 'min' => 0, 'max' => 100 ]
					],
					'selectors' 		=> [
						'{{WRAPPER}} .slide-button-separator-wrapper' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_carousel_slider_horizontal_separator!'	=> '',
						'litho_carousel_slide_styles' 					=> 'slider-style-4', // IN
					],
				]
			);
			$this->add_control(
				'litho_carousel_slider_horizontal_separator_heading',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Horizontal Separator', 'litho-addons' ),
					'separator' => 'before',
					'condition'     => [
						'litho_carousel_slider_horizontal_separator!'	=> '',
						'litho_carousel_slide_styles' 					=> 'slider-style-4', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_carousel_slider_horizontal_separator_height',
				[
					'label' 			=> __( 'Thickness', 'litho-addons' ),
					'type' 				=> Controls_Manager::SLIDER,
					'size_units'    	=> [ 'px', '%', 'custom' ],
					'range'         	=> [ 
						'px'   => [ 'min' => 1, 'max' => 10 ],
						'%'   => [ 'min' => 1, 'max' => 10 ]
					],
					'selectors' 		=> [
						'{{WRAPPER}} .horizontal-separator' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_carousel_slider_horizontal_separator!'	=> '',
						'litho_carousel_slide_styles' 					=> 'slider-style-4', // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_carousel_slider_horizontal_separator_background',
					'fields_options' 	=> [
						'background' 	=> [
							'label' => __( 'Separator Color', 'litho-addons' ),
						],
					],
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .horizontal-separator',
					'condition'     => [
						'litho_carousel_slider_horizontal_separator!'	=> '',
						'litho_carousel_slide_styles' 					=> 'slider-style-4', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_carousel_slider_horizontal_separator_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .horizontal-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_carousel_slider_horizontal_separator!'	=> '',
						'litho_carousel_slide_styles' 					=> 'slider-style-4', // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_overlay',
				[
					'label' 		=> __( 'Overlay', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_carousel_slide_styles!' => 'slider-style-1' ], // NOT IN
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_carousel_image_background_overlay',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .swiper-slide .bg-overlay',
					'condition'     => [ 'litho_carousel_slide_styles!' => 'slider-style-1' ], // NOT IN
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
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_title_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .swiper-slide .title',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_title_text_shadow',
					'selector' 		=> '{{WRAPPER}} .swiper-slide .title',
				]
			);

			$this->start_controls_tabs( 'litho_title_styles_tabs' );
				$this->start_controls_tab(
					'litho_normal_title_style',
					[
						'label'		=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_title_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper-slide .title, {{WRAPPER}} .swiper-slide .title a' => 'color: {{VALUE}};',
						]
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_hover_title_style',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_title_hover_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper-slide .title a:hover' => 'color: {{VALUE}};',
						]
					]
				);
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_title_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_title_max_width',
				[
					'label' 			=> __( 'Width', 'litho-addons' ),
					'type' 				=> Controls_Manager::SLIDER,
					'size_units'		=> [ 'px', '%', 'custom' ],
					'range'				=> [ 
						'px'   => [ 'min' => 0, 'max' => 2000 ],
						'%'   => [ 'min' => 0, 'max' => 100 ]
					],
					'selectors' 		=> [
						'{{WRAPPER}} .swiper-slide .title' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_digit',
				[
					'label' 		=> __( 'Digit', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-1' ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_digit_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'exclude'	=> [
						'letter_spacing',
						'text_decoration',
						'text_transform'
					],
					'selector' 	=> '{{WRAPPER}} .swiper-slide .slider-digit',
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-1' ], // IN
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
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-1' ], // IN
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
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_subtitle_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .swiper-slide .subtitle',
				]
			);
			$this->add_control(
				'litho_subtitle_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .subtitle' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_subtitle_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .subtitle:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_subtitle_max_width',
				[
					'label' 			=> __( 'Width', 'litho-addons' ),
					'type' 				=> Controls_Manager::SLIDER,
					'size_units'		=> [ 'px', '%', 'custom' ],
					'range'				=> [ 
						'px'   => [ 'min' => 0, 'max' => 2000 ],
						'%'   => [ 'min' => 0, 'max' => 100 ]
					],
					'selectors' 		=> [
						'{{WRAPPER}} .swiper-slide .subtitle' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_subtitle_box_shadow',
					'selector' 		=> '{{WRAPPER}} .swiper-slide .subtitle',
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-2' ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_separator',
				[
					'label' 		=> __( 'Separator', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-1' ], // IN
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
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-1' ], // IN
				]
			);
			$this->add_control(
				'litho_separator_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .separator' => 'background-color: {{VALUE}};',
					],
					'condition'     => [ 'litho_carousel_slide_styles' => 'slider-style-1' ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_button',
				[
					'label' 		=> __( 'Button', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_button_display',
				[
					'label'			=> __( 'Display', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'options'		=> [
						''				=> __( 'Default', 'litho-addons' ),
						'block'			=> __( 'Block', 'litho-addons' ),
						'inline'		=> __( 'Inline', 'litho-addons' ),
						'inline-block'	=> __( 'Inline Block', 'litho-addons' ),
						'none'			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .litho-button-wrapper:not(.litho-second-button-wrapper)' => 'display: {{VALUE}}',
					],
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
					'name' 		=> 'litho_button_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)',
				]
			);
			$this->add_responsive_control(
				'litho_button_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)' => 'width: {{SIZE}}{{UNIT}}',
					]
				]
			);
			$this->add_responsive_control(
				'litho_button_height',
				[
					'label'         => __( 'Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)' => 'height: {{SIZE}}{{UNIT}}',
					]
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
						'{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_button_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'			=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)',
				]
			);
			$this->add_control(
				'litho_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'litho_button_hover_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover:not(.elementor-second-button), {{WRAPPER}} .elementor-button:hover:not(.elementor-second-button), {{WRAPPER}} a.elementor-button:focus:not(.elementor-second-button), {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} a.elementor-button:hover:not(.elementor-second-button) svg, {{WRAPPER}} .elementor-button:hover:not(.elementor-second-button) svg, {{WRAPPER}} a.elementor-button:focus:not(.elementor-second-button) svg, {{WRAPPER}} .elementor-button:focus:not(.elementor-second-button) svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_button_background_hover_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'			=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-button:hover:not(.elementor-second-button), {{WRAPPER}} .elementor-button:hover:not(.elementor-second-button), {{WRAPPER}} a.elementor-button:focus:not(.elementor-second-button), {{WRAPPER}}:focus .elementor-button',
				]
			);
			$this->add_control(
				'litho_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_button_border_border!' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover:not(.elementor-second-button), {{WRAPPER}} .elementor-button:hover:not(.elementor-second-button), {{WRAPPER}} a.elementor-button:focus:not(.elementor-second-button), {{WRAPPER}} .elementor-button:focus:not(.elementor-second-button)' => 'border-color: {{VALUE}};',
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
						'{{WRAPPER}} a.elementor-button:hover:not(.elementor-second-button), {{WRAPPER}} .elementor-button:hover:not(.elementor-second-button)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_button_hover_animation',
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
						'{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)' => 'transition-duration: {{SIZE}}s',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_button_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button:not(.elementor-second-button)',
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button:not(.elementor-second-button)',
				]
			);
			$this->add_responsive_control(
				'litho_button_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_button_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-button:not(.elementor-second-button), {{WRAPPER}} .elementor-button:not(.elementor-second-button)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_heading',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'		=> 'before'
				]
			);

			$this->add_control(
				'litho_item_use_image',
				[
					'label' 		=> __( 'Choose Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'default'		=> 'none',
					'options' 		=> [
						'none' => [
							'title' 	=> __( 'None', 'litho-addons' ),
							'icon' 		=> 'eicon-ban',
						],
						'icon' => [
							'title' 	=> __( 'Icon', 'litho-addons' ),
							'icon' 		=> 'eicon-star',
						],
					],
				]
			);
			$this->add_control(
				'litho_item_icon',
				[
					'label'       	=> __( 'Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'condition' => [
						'litho_item_use_image' => 'icon',
					]
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
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
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
						'litho_item_use_image' => 'icon',
					],
					'prefix_class' 	=> 'elementor-shape-',
				]
			);
			$this->add_control(
				'litho_icon_width',
				[
					'label' 		=> __( 'Icon Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon:not(.elementor-second-icon)' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_height',
				[
					'label' 		=> __( 'Icon Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon:not(.elementor-second-icon)' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 300 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon:not(.elementor-second-icon), {{WRAPPER}} .elementor-icon:not(.elementor-second-icon) i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 300 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon:not(.elementor-second-icon), {{WRAPPER}} .elementor-icon:not(.elementor-second-icon) i' => 'line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_spacing',
				[
					'label' 		=> __( 'Icon Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 200 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon:not(.elementor-second-icon)' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_icon_style_tabs' );
				$this->start_controls_tab(
					'litho_icon_style_normal_tab',
					[
						'label' 	=> __( 'Normal', 'litho-addons' ),
						'condition' => [
								'litho_item_use_image' => 'icon',
						],
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_icon_color',
						'condition' => [
							'litho_item_use_image' => 'icon',
							'litho_view' 			=> 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .elementor-icon:not(.elementor-second-icon) i:before',
					]
				);
				$this->add_control(
					'litho_primary_color',
					[
						'label'		=> __( 'Primary Color', 'litho-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '',
						'condition'	=> [
							'litho_view!' => 'default',
							'litho_item_use_image' => 'icon',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon:not(.elementor-second-icon)' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .elementor-icon:not(.elementor-second-icon), {{WRAPPER}}.elementor-view-default .elementor-icon:not(.elementor-second-icon)' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_secondary_color',
					[
						'label' 	=> __( 'Secondary Color', 'litho-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '',
						'condition'	=> [
							'litho_view!'	=> 'default',
							'litho_item_use_image' => 'icon',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-framed .elementor-icon:not(.elementor-second-icon)' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon:not(.elementor-second-icon)' => 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_icon_style_hover_tab',
					[
						'label' 	=> __( 'Hover', 'litho-addons' ),
						'condition' => [
							'litho_item_use_image' => 'icon',
						],
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_hover_icon_color',
						'condition' => [
							'litho_item_use_image' => 'icon',
							'litho_view' 			=> 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default a.elementor-button:hover .elementor-icon:not(.elementor-second-icon) i:before, {{WRAPPER}}.elementor-view-default .elementor-button:hover .elementor-icon:not(.elementor-second-icon) i:before',
					]
				);
				$this->add_control(
					'litho_hover_primary_color',
					[
						'label' 	=> __( 'Primary Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'condition' => [
							'litho_view!' 				=> 'default',
							'litho_item_use_image'		=> 'icon',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-stacked  a.elementor-button:hover .elementor-icon:not(.elementor-second-icon)' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed  a.elementor-button:hover .elementor-icon, {{WRAPPER}}.elementor-view-default  a.elementor-button:hover .elementor-icon:not(.elementor-second-icon)' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_hover_secondary_color',
					[
						'label' 	=> __( 'Secondary Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'condition' => [
							'litho_view!' 			=> 'default',
							'litho_item_use_image' => 'icon',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-framed a.elementor-button:hover .elementor-icon:not(.elementor-second-icon)' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked a.elementor-button:hover .elementor-icon:not(.elementor-second-icon)' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_carousel_secondary_btn',
				[
					'label' 		=> __( 'Second Button', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_carousel_slide_styles!' => [ 'slider-style-1', 'slider-style-4' ] ], // NOT IN
				]
			);
			$this->add_responsive_control(
				'litho_second_button_display',
				[
					'label'        => __( 'Display', 'litho-addons' ),
					'type'         => Controls_Manager::SELECT,
					'options' => [
						'' 				=> __( 'Default', 'litho-addons' ),
						'block'			=> __( 'Block', 'litho-addons' ),
						'inline'		=> __( 'Inline', 'litho-addons' ),
						'inline-block'	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .litho-second-button-wrapper' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'litho_second_button_size',
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
					'name' 		=> 'litho_second_button_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button',
				]
			);
			$this->add_responsive_control(
				'litho_second_button_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button' => 'width: {{SIZE}}{{UNIT}}',
					]
				]
			);
			$this->add_responsive_control(
				'litho_second_button_height',
				[
					'label'         => __( 'Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button' => 'height: {{SIZE}}{{UNIT}}',
					]
				]
			);
			$this->start_controls_tabs( 'litho_tabs_second_button_style' );
			$this->start_controls_tab(
				'litho_tab_second_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_second_button_text_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_second_button_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button'
				]
			);
			$this->add_control(
				'litho_second_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tab_second_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_second_button_hover_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-second-button:hover, {{WRAPPER}} .elementor-second-button:hover, {{WRAPPER}} a.elementor-second-button:focus, {{WRAPPER}} .elementor-second-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} a.elementor-second-button:hover svg, {{WRAPPER}} .elementor-second-button:hover svg, {{WRAPPER}} a.elementor-second-button:focus svg, {{WRAPPER}} .elementor-second-button:focus svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_second_button_background_hover_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-second-button:hover, {{WRAPPER}} .elementor-second-button:hover, {{WRAPPER}} a.elementor-second-button:focus, {{WRAPPER}} .elementor-second-button:focus'
				]
			);
			$this->add_control(
				'litho_second_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_second_button_border_border!' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-second-button:hover, {{WRAPPER}} .elementor-second-button:hover, {{WRAPPER}} a.elementor-second-button:focus, {{WRAPPER}} .elementor-second-button:focus' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_second_button_hover_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-second-button:hover, {{WRAPPER}} .elementor-second-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_second_button_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->add_control(
				'litho_second_button_hover_transition',
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
						'{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-second-button' => 'transition-duration: {{SIZE}}s',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_second_button_border',
					'selector' 		=> '{{WRAPPER}} .elementor-second-button',
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_second_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-second-button',
				]
			);
			$this->add_responsive_control(
				'litho_second_button_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_second_button_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-second-button, {{WRAPPER}} .elementor-second-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_second_icon_heading',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'		=> 'before'
				]
			);
			$this->add_control(
				'litho_second_item_use_image',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'none' => [
							'title' 	=> __( 'None', 'litho-addons' ),
							'icon' 		=> 'eicon-ban',
						],
						'icon' => [
							'title' 	=> __( 'Icon', 'litho-addons' ),
							'icon' 		=> 'eicon-star',
						],
					],
					'default'		=> 'none'
				]
			);
			$this->add_control(
				'litho_second_item_icon',
				[
					'label'       	=> __( 'Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'condition' => [
						'litho_second_item_use_image' => 'icon',
					]
				]
			);
			$this->add_control(
				'litho_second_view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'default' 	=> __( 'Default', 'litho-addons' ),
						'stacked' 	=> __( 'Stacked', 'litho-addons' ),
						'framed' 	=> __( 'Framed', 'litho-addons' ),
					],
					'default' 		=> 'default',
					'condition' 	=> [
						'litho_second_item_use_image' => 'icon',
					],
					'prefix_class' 	=> 'elementor-view-',
				]
			);
			$this->add_control(
				'litho_second_icon_shape',
				[
					'label' 		=> __( 'Shape', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'circle' 	=> __( 'Circle', 'litho-addons' ),
						'square' 	=> __( 'Square', 'litho-addons' ),
					],
					'default' 		=> 'circle',
					'condition' 	=> [
						'litho_second_view!'	 => 'default',
						'litho_second_item_use_image' => 'icon',
					],
					'prefix_class' 	=> 'elementor-shape-',
				]
			);
			$this->add_control(
				'litho_second_icon_width',
				[
					'label' 		=> __( 'Icon Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-second-icon' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_second_icon_height',
				[
					'label' 		=> __( 'Icon Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-second-icon' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_second_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 300 ] ],
					'condition' 	=> [
						'litho_second_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-second-icon, {{WRAPPER}} .elementor-second-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'litho_second_icon_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 300 ] ],
					'condition' 	=> [
						'litho_second_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-second-icon, {{WRAPPER}} .elementor-second-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_second_icon_spacing',
				[
					'label' 		=> __( 'Icon Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 200 ] ],
					'condition' 	=> [
						'litho_item_use_image' => 'icon',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-second-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_second_icon_style_tabs' );
				$this->start_controls_tab(
					'litho_second_icon_style_normal_tab',
					[
						'label' 	=> __( 'Normal', 'litho-addons' ),
						'condition' => [
								'litho_second_item_use_image' => 'icon',
						],
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_second_icon_color',
						'condition' => [
							'litho_second_item_use_image' => 'icon',
							'litho_second_view' 		   => 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .elementor-second-icon i:before',
					]
				);
				$this->add_control(
					'litho_second_primary_color',
					[
						'label'		=> __( 'Primary Color', 'litho-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '',
						'condition'	=> [
								'litho_second_view!' => 'default',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-stacked .elementor-second-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .elementor-second-icon, {{WRAPPER}}.elementor-view-default .elementor-second-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_second_secondary_color',
					[
						'label' 	=> __( 'Secondary Color', 'litho-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '',
						'condition'	=> [
								'litho_second_view!'	=> 'default',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-framed .elementor-second-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .elementor-second-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_second_icon_style_hover_tab',
					[
						'label' 	=> __( 'Hover', 'litho-addons' ),
						'condition' => [
							'litho_second_item_use_image' => 'icon',
						],
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_second_hover_icon_color',
						'condition' => [
							'litho_second_item_use_image' => 'icon',
							'litho_second_view' 		   => 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default a.elementor-button:hover .elementor-second-icon i:before, {{WRAPPER}}.elementor-view-default .elementor-button:hover .elementor-second-icon i:before',
					]
				);
				$this->add_control(
					'litho_second_hover_primary_color',
					[
						'label' 	=> __( 'Primary Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'condition' => [
							'litho_second_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-stacked  a.elementor-button:hover .elementor-second-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed  a.elementor-button:hover .elementor-second-icon, {{WRAPPER}}.elementor-view-default  a.elementor-button:hover .elementor-second-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_second_hover_secondary_color',
					[
						'label' 	=> __( 'Secondary Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'condition' => [
							'litho_second_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-framed a.elementor-button:hover .elementor-second-icon' 	=> 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked a.elementor-button:hover .elementor-second-icon' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_second_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-second-icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [ 'litho_second_item_use_image!' => 'none' ],
				]
			);
			$this->add_responsive_control(
				'litho_second_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-second-icon img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [ 'litho_second_item_use_image!' => 'none' ],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_navigation',
				[
					'label' 		=> __( 'Navigation', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_navigation'	=> [ 'arrows', 'dots', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_heading_style_arrows',
				[
					'label' 		=> __( 'Arrows', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'condition' 	=> [ 'litho_navigation'	=> [ 'arrows', 'both' ] ],
					'separator' 	=> 'before',
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
						'custom'	=> __( 'Custom', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-arrows-position-',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_left_position',
				[
					'label' 		=> __( 'Left Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range'        	=> [ 
						'px' => [ 'min' => 0, 'max' => 1000 ],
						'%'  => [ 'min' => 0, 'max' => 100 ]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_navigation' => [ 'arrows', 'both' ],
						'litho_arrows_position' => [ 'custom' ],
					],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_right_position',
				[
					'label' 		=> __( 'Right Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range'        	=> [ 
						'px'   => [ 'min' => 0, 'max' => 1000 ],
						'%'   => [ 'min' => 0, 'max' => 100 ]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_navigation' => [ 'arrows', 'both' ],
						'litho_arrows_position' => [ 'custom' ],
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
						'selector' 			=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next'
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
						'selector' 			=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover'
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
					'label' 		=> __( 'Dots', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'condition' 	=> [ 'litho_navigation'	=> [ 'dots', 'both' ] ],
					'separator' 	=> 'before',
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
					'condition' 	=> [ 'litho_navigation'	=> [ 'dots', 'both' ] ],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_dots_border',
					'selector' 		=> '{{WRAPPER}} .elementor-image-carousel-wrapper .swiper-pagination-bullet',
					'condition' 	=> [ 'litho_navigation'	=> [ 'dots', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_dots_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'			=> [ 'px'   => [ 'min' => 5, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					],
					'condition' 	=> [ 'litho_navigation'	=> [ 'dots', 'both' ] ]
				]
			);
			$this->add_control(
				'litho_dots_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'			=> [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-pagination-position-outside .swiper' => 'padding-bottom: {{SIZE}}{{UNIT}} !important',
					],
					'condition' 	=> [ 
						'litho_navigation' 			=> [ 'dots', 'both' ],
						'litho_dots_position'			=> 'outside',
						'litho_carousel_slide_styles'	=> [ 'slider-style-1', 'slider-style-2' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_dots_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->start_controls_tabs( 'litho_dots_box_style' );
				$this->start_controls_tab(
					'litho_dots_box_normal_style',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);

				$this->add_control(
					'litho_dots_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}} !important;',
						],
						'condition' 	=> [ 'litho_navigation'	=> [ 'dots', 'both' ] ]
					]
				);
				
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_arrows_box_active_style',
					[
						'label' 		=> __( 'Active', 'litho-addons' ),
					]
				);

				$this->add_control(
					'litho_active_dots_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}} !important; border-color: {{VALUE}} !important;',
						],
						'condition' 	=> [ 'litho_navigation'	=> [ 'dots', 'both' ] ]
					]
				);

				$this->add_control(
					'litho_active_dots_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}} !important;',
						],
						'condition' 	=> [ 'litho_navigation'	=> [ 'dots', 'both' ] ]
					]
				);

				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_number_pagination',
				[
					'label' 		=> __( 'Number Pagination', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_number_pagination'		=> 'yes',
						'litho_carousel_slide_styles'	=> 'slider-style-4', // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_number_pagination_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'exclude' => [
						'text_transform',
						'text_decoration'
					],
					'selector' 	=> '{{WRAPPER}} .swiper-number-pagination',
				]
			);
			$this->add_control(
				'litho_number_pagination_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-number-pagination' => 'color: {{VALUE}};',
					]
				]
			);
			$this->end_controls_section();

		}

		/**
		 * Render slider widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$slides               = [];
			$slide_html           = '';
			$render_link_attr     = '';
			$render_carousel_attr = '';
			$slides_count         = '';
			$settings             = $this->get_settings_for_display();
			$id_int               = substr( $this->get_id_int(), 0, 3 );
			$slide_styles         = $this->get_settings( 'litho_carousel_slide_styles' );

			$litho_carousel_slider_horizontal_separator = ( isset( $settings['litho_carousel_slider_horizontal_separator'] ) && $settings['litho_carousel_slider_horizontal_separator'] ) ? $settings['litho_carousel_slider_horizontal_separator'] : '';

			$this->add_render_attribute( [
				'btn_wrapper' => [
					'class' => [ 'elementor-button-wrapper', 'litho-button-wrapper' ]
				]
			] );

			$this->add_render_attribute( [
				'second_btn_wrapper' => [
					'class' => [ 'elementor-button-wrapper', 'litho-button-wrapper', 'litho-second-button-wrapper' ]
				]
			] );

			/* Custom Effect */
			$hover_animation_effect_array = litho_custom_hover_animation_effect();

			switch ( $slide_styles ) {
				case 'slider-style-1':
					$this->add_render_attribute( [
						'btn_wrapper' => [
							'class' => [ 'text-center', 'align-self-center' ]
						]
					] );

					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {

						$image_url              = '';
						$image_alt              = ''; 
						$custom_animation_class = '';
						$index                  = $index + 1;
						$i                      = $index < 10 ? '0' . $index : $index;
						$wrapper_key            = 'wrapper_' . $index;
						$titleKey               = 'title_' . $index;
						$linkKey                = 'link_' . $index;

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide', 'cover-background' ]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_link_attributes( $titleKey, $item['litho_link'] );
						}

						$button_text = ( isset( $item['litho_button_text'] ) && $item['litho_button_text'] ) ? $item['litho_button_text'] : '';
						if ( ! empty( $item['litho_button_link']['url'] ) ) {
							$this->add_link_attributes( $linkKey, $item['litho_button_link'] );
							$this->add_render_attribute( $linkKey, 'class', 'elementor-button-link' );
						}

						$this->add_render_attribute( $linkKey, 'class', 'elementor-button' );
						$this->add_render_attribute( $linkKey, 'role', 'button' );

						if ( ! empty( $settings['litho_size'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', 'elementor-size-' . $settings['litho_size'] );
						}

						if ( ! empty( $settings['litho_button_hover_animation'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', [ 'hvr-' . $settings['litho_button_hover_animation'] ] );
							if ( in_array( $settings['litho_button_hover_animation'], $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						$this->add_render_attribute( $linkKey, 'class', [ $custom_animation_class ] );
						
						ob_start();
						?>
						<div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
							<div class="bg-overlay"></div>
							<div class="slider-text-middle-main">
								<div class="col-12 d-md-inline-block align-items-center justify-content-center slider-text-wrap">
									<span class="alt-font d-inline-block align-middle slider-digit"><?php
										echo sprintf( '%s', $i ); // phpcs:ignore
									?></span>
									<span class="separator"></span>
									<?php if ( ! empty( $item['litho_carousel_subtitle'] ) ) { ?>
										<span class="d-inline-block subtitle align-middle"><?php
											echo esc_html( $item['litho_carousel_subtitle'] );
										?></span>
									<?php } ?>
								</div>
								<div class="col-12 alt-font justify-content-center slider-title-wrap">
									<div class="media d-flex align-items-start">
										<?php
										if ( ! empty( $item['litho_carousel_title'] ) ) {
											?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"><?php // phpcs:ignore ?>
												<?php
												if ( ! empty( $item['litho_link']['url'] ) ) {
													?><a <?php $this->print_render_attribute_string( $titleKey ); ?>><?php
												}
													echo esc_html( $item['litho_carousel_title'] );
												if ( ! empty( $item['litho_link']['url'] ) ) {
													?></a><?php
												}
											?></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore ?>
										<?php
										}
										if ( ! empty( $item['litho_button_link']['url'] ) ) {
										?>
										<div <?php $this->print_render_attribute_string( 'btn_wrapper' ); ?>>
											<a <?php $this->print_render_attribute_string( $linkKey ); ?>><?php
												echo esc_html( $button_text );
												$this->litho_get_button_icon(); // phpcs:ignore
											?></a>
										</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'slider-style-2':
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						
						$image_url              = '';
						$image_alt              = ''; 
						$custom_animation_class = '';
						$index                  = $index + 1;
						$i                      = $index < 10 ? '0' . $index : $index;
						$wrapper_key            = 'wrapper_'.$index;
						$linkKey                = 'link_' . $index;
						$secondLinkKey          = 'secondlink_' . $index;
						$titleKey               = 'title_' . $index;

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide', 'cover-background' ]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_link_attributes( $titleKey, $item['litho_link'] );
						}

						$button_text = ( isset( $item['litho_button_text'] ) && $item['litho_button_text'] ) ? $item['litho_button_text'] : '';
						if ( ! empty( $item['litho_button_link']['url'] ) ) {
							$this->add_link_attributes( $linkKey, $item['litho_button_link'] );
							$this->add_render_attribute( $linkKey, 'class', 'elementor-button-link' );
						}

						$this->add_render_attribute( $linkKey, 'class', 'elementor-button' );
						$this->add_render_attribute( $linkKey, 'role', 'button' );

						if ( ! empty( $settings['litho_size'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', 'elementor-size-' . $settings['litho_size'] );
						}

						if ( ! empty( $settings['litho_button_hover_animation'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', [ 'hvr-' . $settings['litho_button_hover_animation'] ] );
							if ( in_array( $settings['litho_button_hover_animation'], $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						$this->add_render_attribute( $linkKey, 'class', [ $custom_animation_class ] );

						/* Second button */
						$second_button_text = ( isset( $item['litho_second_button_text'] ) && $item['litho_second_button_text'] ) ? $item['litho_second_button_text'] : '';
						if ( ! empty( $item['litho_second_button_link']['url'] ) ) {
							$this->add_link_attributes( $secondLinkKey, $item['litho_second_button_link'] );
							$this->add_render_attribute( $secondLinkKey, 'class', 'elementor-button-link' );
						}

						$this->add_render_attribute( $secondLinkKey, 'class', 'elementor-button elementor-second-button' );
						$this->add_render_attribute( $secondLinkKey, 'role', 'button' );

						if ( ! empty( $settings['litho_second_button_size'] ) ) {
							$this->add_render_attribute( $secondLinkKey, 'class', 'elementor-size-' . $settings['litho_second_button_size'] );
						}
						
						if ( ! empty( $settings['litho_second_button_hover_animation'] ) ) {
							$this->add_render_attribute( $secondLinkKey, 'class', [ 'hvr-' . $settings['litho_second_button_hover_animation'] ] );
							if ( in_array( $settings['litho_second_button_hover_animation'], $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						$this->add_render_attribute( $secondLinkKey, 'class', [ $custom_animation_class ] );

						ob_start();
						?>
						<div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
							<div class="bg-overlay"></div>
							<div class="slider-text-middle-main">
								<?php
								if ( ! empty( $item['litho_carousel_subtitle'] ) ) {
									?>
									<span class="subtitle"><?php
										echo esc_html( $item['litho_carousel_subtitle'] );
									?></span>
								<?php
								}
								if ( ! empty( $item['litho_carousel_title'] ) ) {
									?>
									<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"><?php // phpcs:ignore ?>
										<?php
										if ( ! empty( $item['litho_link']['url'] ) ) {
											?><a <?php $this->print_render_attribute_string( $titleKey ); ?>><?php
										}
											echo esc_html( $item['litho_carousel_title'] );
										if ( ! empty( $item['litho_link']['url'] ) ) {
											?></a><?php
										}
									?></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore ?>
								<?php
								}
								if ( ! empty( $button_text ) && ! empty( $second_button_text ) ) {
								?>
								<div class="slide-button-wrapper">
								<?php
								}
								if ( ! empty( $button_text ) ) {
									?>
									<div <?php $this->print_render_attribute_string( 'btn_wrapper' ); ?>>
										<a <?php $this->print_render_attribute_string( $linkKey ); ?>><?php
											echo esc_html( $button_text );
											$this->litho_get_button_icon(); // phpcs:ignore
										?></a>
									</div>
									<?php
									}
									if ( ! empty( $second_button_text ) ) {
									?>
									<div <?php $this->print_render_attribute_string( 'second_btn_wrapper' ); ?>>
										<a <?php $this->print_render_attribute_string( $secondLinkKey ); ?>><?php
											echo esc_html( $second_button_text );
											$this->litho_get_second_button_icon();
										?></a>
									</div>
									<?php
									}
								if ( ! empty( $button_text ) && ! empty( $second_button_text ) ) {
								?>
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'slider-style-3':
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						$image_url     = '';
						$image_alt     = '';
						$index         = $index + 1;
						$i             = $index < 10 ? '0' . $index : $index;
						$wrapper_key   = 'wrapper_'. $index;
						$linkKey       = 'link_' . $index;
						$secondLinkKey = 'secondlink_' . $index;
						$titleKey      = 'title_' . $index;

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide', 'cover-background' ]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_link_attributes( $titleKey, $item['litho_link'] );
						}

						$button_text = ( isset( $item['litho_button_text'] ) && $item['litho_button_text'] ) ? $item['litho_button_text'] : '';
						if ( ! empty( $item['litho_button_link']['url'] ) ) {

							$this->add_render_attribute( $linkKey, 'href', $item['litho_button_link']['url'] );
							$this->add_render_attribute( $linkKey, 'class', 'elementor-button-link' );

							if ( $item['litho_button_link']['is_external'] ) {
								$this->add_render_attribute( $linkKey, 'target', '_blank' );
							}

							if ( $item['litho_button_link']['nofollow'] ) {
								$this->add_render_attribute( $linkKey, 'rel', 'nofollow' );
							}
						}

						$this->add_render_attribute( $linkKey, 'class', 'elementor-button' );
						$this->add_render_attribute( $linkKey, 'role', 'button' );

						if ( ! empty( $settings['litho_size'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', 'elementor-size-' . $settings['litho_size'] );
						}

						$custom_animation_class = '';
						if ( ! empty( $settings['litho_button_hover_animation'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', [ 'hvr-' . $settings['litho_button_hover_animation'] ] );
							if ( in_array( $settings['litho_button_hover_animation'], $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						$this->add_render_attribute( $linkKey, 'class', [ $custom_animation_class ] );

						/* Second button */
						$second_button_text = ( isset( $item['litho_second_button_text'] ) && $item['litho_second_button_text'] ) ? $item['litho_second_button_text'] : '';
						if ( ! empty( $item['litho_second_button_link']['url'] ) ) {

							$this->add_link_attributes( $secondLinkKey, $item['litho_second_button_link'] );
							$this->add_render_attribute( $secondLinkKey, 'class', 'elementor-button-link' );

						}

						$this->add_render_attribute( $secondLinkKey, 'class', 'elementor-button elementor-second-button' );
						$this->add_render_attribute( $secondLinkKey, 'role', 'button' );

						if ( ! empty( $settings['litho_second_button_size'] ) ) {
							$this->add_render_attribute( $secondLinkKey, 'class', 'elementor-size-' . $settings['litho_second_button_size'] );
						}
						if ( ! empty( $settings['litho_second_button_hover_animation'] ) ) {
							$this->add_render_attribute( $secondLinkKey, 'class', [ 'hvr-' . $settings['litho_second_button_hover_animation'] ] );
							if ( in_array( $settings['litho_second_button_hover_animation'], $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						$this->add_render_attribute( $secondLinkKey, 'class', [ $custom_animation_class ] );

						ob_start();
						?>
						<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
							<div class="bg-overlay"></div>
							<div class="slider-text-middle-main">
								<?php
								if ( ! empty( $item['litho_carousel_title'] ) ) {
									?>
									<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"><?php // phpcs:ignore ?>
										<?php
										if ( ! empty( $item['litho_link']['url'] ) ) {
											?><a <?php $this->print_render_attribute_string( $titleKey ); ?>><?php
										}
											echo esc_html( $item['litho_carousel_title'] );
										if ( ! empty( $item['litho_link']['url'] ) ) {
											?></a><?php
										}
									?></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore ?>
								<?php
								}
								if ( ! empty( $item['litho_carousel_subtitle'] ) ) {
									?>
									<span class="subtitle"><?php
										echo esc_html( $item['litho_carousel_subtitle'] );
									?></span>
								<?php
								}
								if ( ! empty( $button_text ) && ! empty( $second_button_text ) ) {
								?>
								<div class="slide-button-wrapper">
								<?php
								}
								if ( ! empty( $button_text ) ) {
									?>
									<div <?php $this->print_render_attribute_string( 'btn_wrapper' ); ?>>
										<a <?php $this->print_render_attribute_string( $linkKey ); ?>><?php
											$this->litho_get_button_icon(); // phpcs:ignore
											echo esc_html( $button_text );
										?></a>
									</div>
									<?php
									}
									if ( ! empty( $second_button_text ) ) {
									?>
									<div <?php $this->print_render_attribute_string( 'second_btn_wrapper' ); ?>>
										<a <?php $this->print_render_attribute_string( $secondLinkKey ); ?>><?php
											$this->litho_get_second_button_icon();
											echo esc_html( $second_button_text );
										?></a>
									</div>
									<?php
									}
									if ( ! empty( $button_text ) && ! empty( $second_button_text ) ) {
									?>
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'slider-style-4':
					foreach ( $settings['litho_carousel_slider'] as $index => $item ) {
						$image_url              = '';
						$image_alt              = '';
						$custom_animation_class = '';
						$index                  = $index + 1;
						$i                      = $index < 10 ? '0' . $index : $index;
						$wrapper_key            = 'wrapper_' . $index;
						$linkKey                = 'link_' . $index;
						$titleKey               = 'title_' . $index;

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide', 'cover-background' ]
						] );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_link_attributes( $titleKey, $item['litho_link'] );
						}
						
						$button_text = ( isset( $item['litho_button_text'] ) && $item['litho_button_text'] ) ? $item['litho_button_text'] : '';
						if ( ! empty( $item['litho_button_link']['url'] ) ) {

							$this->add_render_attribute( $linkKey, 'href', $item['litho_button_link']['url'] );
							$this->add_render_attribute( $linkKey, 'class', 'elementor-button-link' );

							if ( $item['litho_button_link']['is_external'] ) {
								$this->add_render_attribute( $linkKey, 'target', '_blank' );
							}

							if ( $item['litho_button_link']['nofollow'] ) {
								$this->add_render_attribute( $linkKey, 'rel', 'nofollow' );
							}
						} else {
							$this->add_render_attribute( $linkKey, 'href', '#' );
						}

						$this->add_render_attribute( $linkKey, 'class', 'elementor-button' );
						$this->add_render_attribute( $linkKey, 'role', 'button' );

						if ( ! empty( $settings['litho_size'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', 'elementor-size-' . $settings['litho_size'] );
						}

						if ( ! empty( $settings['litho_button_hover_animation'] ) ) {
							$this->add_render_attribute( $linkKey, 'class', [ 'hvr-' . $settings['litho_button_hover_animation'] ] );
							if ( in_array( $settings['litho_button_hover_animation'], $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						$this->add_render_attribute( $linkKey, 'class', [ $custom_animation_class ] );

						ob_start();
						?>
						<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
							<div class="bg-overlay"></div>
							<div class="slider-text-middle-main">
								<?php
								if ( ! empty( $item['litho_carousel_title'] ) || ! empty( $item['litho_carousel_subtitle'] ) ) {
								?>
								<div class="slide-title-wrapper">
								<?php
								}
									if ( ! empty( $item['litho_carousel_title'] ) ) {
										?>
										<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"><?php // phpcs:ignore
											if ( ! empty( $item['litho_link']['url'] ) ) {
												?><a <?php $this->print_render_attribute_string( $titleKey ); ?>><?php
											}
												echo esc_html( $item['litho_carousel_title'] );
											if ( ! empty( $item['litho_link']['url'] ) ) {
												?></a><?php
											}
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
									<?php
									}
									if ( ! empty( $item['litho_carousel_subtitle'] ) ) {
										?>
										<span class="subtitle"><?php
											echo esc_html( $item['litho_carousel_subtitle'] );
										?></span>
									<?php
									}
									if ( ! empty( $item['litho_carousel_title'] ) || ! empty( $item['litho_carousel_subtitle'] ) ) {
									?>
								</div>
								<?php
								}
								if ( 'yes' === $litho_carousel_slider_horizontal_separator && ! empty( $button_text ) ) {
								?>
								<div class="slide-button-separator-wrapper">
								<?php
								}
								if ( 'yes' === $litho_carousel_slider_horizontal_separator ) {
									?>
									<div class="horizontal-separator"></div>
								<?php
								}
								if ( ! empty( $button_text ) ) {
									?>
									<div <?php $this->print_render_attribute_string( 'btn_wrapper' ); ?>>
										<a <?php $this->print_render_attribute_string( $linkKey ); ?>><?php
											$this->litho_get_button_icon(); // phpcs:ignore
											echo esc_html( $button_text );
										?></a>
									</div>
									<?php
									}
									if ( 'yes' === $litho_carousel_slider_horizontal_separator && ! empty( $button_text ) ) {
									?>
								</div>
								<?php
								}
								?>
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

			$swiper_pagination_class = '';
			$litho_full_screen       = '';
			$slides_count            = count( $settings['litho_carousel_slider'] );
			$litho_rtl               = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor     = $this->get_settings( 'litho_slider_cursor' );
			$litho_navigation        = $this->get_settings( 'litho_navigation' );
			$litho_number_pagination = $this->get_settings( 'litho_number_pagination' );

			$dataSettings = array(
				'navigation'     => $this->get_settings( 'litho_navigation' ),
				'autoplay'       => $this->get_settings( 'litho_autoplay' ),
				'autoplay_speed' => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover' => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'           => $this->get_settings( 'litho_infinite' ),
				'effect'         => $this->get_settings( 'litho_effect' ),
				'speed'          => $this->get_settings( 'litho_speed' ),
				'mousewheel'     => $this->get_settings( 'litho_mousewheel' ),
				'slide-total'    => $slides_count,
			);

			if ( 'slider-style-2' != $slide_styles ) {

				if ( 'yes' === $litho_number_pagination ) {
					$dataSettings[ 'number_pagination' ] = $litho_number_pagination;
				}
				
				$dataSettings[ 'direction' ]              = $this->get_settings( 'litho_direction' );
				$dataSettings[ 'litho_direction_mobile' ] = $this->get_settings( 'litho_direction_mobile' );
				
				$this->add_render_attribute( [
					'carousel-wrapper' => [
						'class' => [ 'slider-vertical' ],
					]
				] );

				$swiper_pagination_class = ' swiper-vertical-pagination';
			}

			if ( 'yes' === $this->get_settings( 'litho_full_screen' ) ) {
				$litho_full_screen = 'full-screen-slide';
			}

			$this->add_render_attribute( [
				'carousel-wrapper' => [
					'class'         => [
						'elementor-image-carousel-wrapper',
						'swiper',
						'swiper-container-initialized',
						$litho_full_screen,
						$slide_styles,
						$litho_slider_cursor,
					],
					'data-settings' => json_encode( $dataSettings ),
				],
				'carousel' => [
					'class' => 'elementor-image-carousel swiper-wrapper',
				]
			] );

			if ( ! empty( $litho_rtl ) ) {
				$this->add_render_attribute( 'carousel-wrapper', 'dir', $litho_rtl );
			}

			$show_dots   = ( in_array( $litho_navigation, [ 'dots', 'both' ] ) );
			$show_arrows = ( in_array( $litho_navigation, [ 'arrows', 'both' ] ) );

			if ( 'yes' ===  $this->get_settings( 'litho_image_stretch' ) ) {
				$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
			}
			?>
			<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
				<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
					<?php echo implode( '', $slides ); ?>
				</div>
				<?php if ( 1 < $slides_count ) { ?>
					<?php if ( $show_dots ) { ?>
						<div class="swiper-pagination<?php echo esc_attr( $swiper_pagination_class ); ?>"></div>
					<?php } ?>
					<?php if ( $show_arrows ) { ?>
						<?php $this->litho_get_navigation_arrows(); // phpcs:ignore ?>
					<?php } ?>
				<?php } ?>
				<?php
				if ( 'slider-style-4' === $slide_styles && 'yes' === $litho_number_pagination ) {
					?>
					 <!-- start slider number pagination -->
					<div class="swiper-number-pagination">
						<div class="swiper-pagination-current"></div>
						<div class="swiper-pagination-total"></div>
					</div>
					<!-- end slider number pagination -->
					<?php
				}
				?>
			</div>
			<?php
		}

		/**
		 * Retrieve the navigation arrows
		 *
		 *
		 *
		 * @access public
		 *
		 */
		public function litho_get_navigation_arrows() {

			$litho_left_arrow_icon = '';
			$right_arrow_icon      = '';
			$settings              = $this->get_settings_for_display();
			$is_new                = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$left_icon_migrated    = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
			$right_icon_migrated   = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );

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
					$right_arrow_icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_right_arrow_icon']['value'] ) && ! empty( $settings['litho_right_arrow_icon']['value'] ) ) {
					$right_arrow_icon .= '<i class="' . esc_attr( $settings['litho_right_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}
			?>
			<div class="elementor-swiper-button elementor-swiper-button-prev">
				<?php
				if ( ! empty( $litho_left_arrow_icon ) ) {
					echo sprintf( '%s', $litho_left_arrow_icon ); // phpcs:ignore
				} else {
				?>
					<i class="eicon-chevron-left" aria-hidden="true"></i>
				<?php
				}
				?>
				<span class="elementor-screen-only"><?php echo esc_html__( 'Prev', 'litho-addons' ); ?></span>
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
		/**
		 * Retrieve the button icon
		 *
		 * @access public
		 *
		 */
		public function litho_get_button_icon() {

			$icon       = '';
			$icon_image = '';
			$settings   = $this->get_settings_for_display();
			$migrated   = isset( $settings['__fa4_migrated']['litho_item_icon'] );
			$is_new     = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
				$icon .= '<i class="' . esc_attr( $settings['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
			}
			
			if ( 'none' != $settings['litho_item_use_image'] ) {
				if ( ! empty( $icon ) ) {
				?>
					<div class="elementor-icon"><?php
						echo sprintf( '%s', $icon ); // phpcs:ignore
					?></div>
				<?php 
				}
			} 
		}

		/**
		 * Retrieve the second button icon
		 *
		 * @access public
		 *
		 */
		public function litho_get_second_button_icon() {

			$icon       = '';
			$icon_image = '';
			$settings   = $this->get_settings_for_display();
			$migrated   = isset( $settings['__fa4_migrated']['litho_second_item_icon'] );
			$is_new     = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_second_item_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} else {
				$icon .= '<i class="' . esc_attr( $settings['litho_second_item_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			if ( 'none' != $settings['litho_second_item_use_image'] ) {
				if ( ! empty( $icon ) ) {
				?>
					<div class="elementor-icon elementor-second-icon"><?php
						echo sprintf( '%s', $icon ); // phpcs:ignore
					?></div>
				<?php 
				}
			} 
		}
	}
}
