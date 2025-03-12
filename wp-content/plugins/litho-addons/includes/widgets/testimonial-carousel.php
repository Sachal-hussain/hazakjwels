<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for testimonial carousel.
 *
 * @package Litho
 */

// If class `Testimonial_Carousel` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Testimonial_Carousel' ) ) {

	class Testimonial_Carousel extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-testimonial-carousel';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Testimonial Carousel', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-slider-album';
		}

		/**
		 * Retrieve the list of scripts the testimonial carousel widget depended on.
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
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the widget belongs to.
		 *
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'slide', 'carousel', 'slider', 'testimonial', 'review' ];
		}

		/**
		 * Register testimonial carousel widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_testimonial_carousel_general_section',
				[
					'label' => __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_layout_type',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'testimonial-carousel-style-1',
					'options' 		=> [
						'testimonial-carousel-style-1' => __( 'Style 1', 'litho-addons' ),
						'testimonial-carousel-style-2' => __( 'Style 2', 'litho-addons' ),
						'testimonial-carousel-style-3' => __( 'Style 3', 'litho-addons' ),
						'testimonial-carousel-style-4' => __( 'Style 4', 'litho-addons' ),
						'testimonial-carousel-style-5' => __( 'Style 5', 'litho-addons' ),
						'testimonial-carousel-style-6' => __( 'Style 6', 'litho-addons' ),
						'testimonial-carousel-style-7' => __( 'Style 7', 'litho-addons' ),
						'testimonial-carousel-style-8' => __( 'Style 8', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_heading',
				[
					'label' 		=> __( 'Heading', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'		=> __( 'Write heading here', 'litho-addons' ),
					'label_block' 	=> true,
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_subheading',
				[
					'label' 		=> __( 'Subheading', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'		=> __( 'Write subheading here', 'litho-addons' ),
					'label_block' 	=> true,
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_slide_content',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'type' 			=> Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
						'active' => true
					],
					'show_label'	=> false,
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
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
					'default' 		=> 'h6',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_content_section',
				[
					'label' => __( 'Testimonial', 'litho-addons' ),
				]
			);
			$repeater = new Repeater();
			$repeater->start_controls_tabs( 'litho_testimonial_carousel_tabs' );
				$repeater->start_controls_tab( 'litho_testimonial_carousel_image_tab', [ 'label' => __( 'Image', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_testimonial_carousel_image',
						[
							'label' 		=> __( 'Image', 'litho-addons' ),
							'show_label'	=> false,
							'type' 			=> Controls_Manager::MEDIA,
							'dynamic'		=> [
								'active' => true,
							],
							'default' 		=> [
								'url' 		=> Utils::get_placeholder_image_src(),
							],
						]
					);
					$repeater->add_control(
						'litho_testimonial_carousel_review_icon' ,
						[
							'label'        	=> __( 'Review', 'litho-addons' ),
							'type'         	=> Controls_Manager::SELECT,
							'default'		=> 1,
							'description'	=> __( 'Please make sure review icon will use only in style 1 and style 4.', 'litho-addons' ),
							'options' 		=> [
								'1' => __( '1 Star', 'litho-addons' ),
								'2' => __( '2 Star', 'litho-addons' ),
								'3' => __( '3 Star', 'litho-addons' ),
								'4' => __( '4 Star', 'litho-addons' ),
								'5' => __( '5 Star', 'litho-addons' ),
							],
							'render_type' 	=> 'template',
							'frontend_available' => true,
						]
					);
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_testimonial_carousel_content_tab', [ 'label' => __( 'Content', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_testimonial_carousel_title',
						[
							'label' 		=> __( 'Title', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'label_block' 	=> true,
							'description'	=> __( 'Please make sure title will use only in style 3 and style 8.', 'litho-addons' ),
						]
					);	
					$repeater->add_control(
						'litho_testimonial_carousel_content',
						[
							'label' 		=> __( 'Content', 'litho-addons' ),
							'show_label'	=> false,
							'type' 			=> Controls_Manager::WYSIWYG,
							'dynamic' 		=> [
								'active' => true
							],
							'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Sed do eiusmod tem', 'litho-addons' ),
						]
					);
					$repeater->add_control(
						'litho_testimonial_carousel_name',
						[
							'label' 		=> __( 'First name', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'label_block' 	=> false,
							'default' 		=> __( 'John Doe', 'litho-addons' ),
						]
					);
					$repeater->add_control(
						'litho_testimonial_carousel_lastname',
						[
							'label' 		=> __( 'Last name', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'label_block' 	=> false,
						]
					);
					$repeater->add_control(
						'litho_testimonial_carousel_position',
						[
							'label' 		=> __( 'Position', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'label_block' 	=> true,
							'default' 		=> __( 'Designer', 'litho-addons' ),
						]
					);
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_testimonial_carousel_icon_tab', [ 'label' => __( 'Icon', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_testimonial_carousel_icon',
						[
							'label'             => __( 'Quote Icon', 'litho-addons' ),
							'show_label'		=> false,
							'type'              => Controls_Manager::ICONS,
							'fa4compatibility'  => 'icon',
							'default'           => [
									'value'         => 'fa-solid fa-quote-left',
									'library'       => 'fa-solid',
							],
							'description'	=> __( 'Please make sure icon will use only in style 2, style 3 and style 5.', 'litho-addons' ),
						]
					);
				$repeater->end_controls_tab();
			$repeater->end_controls_tabs();
			$this->add_control(
				'litho_testimonial_carousel',
				[
					'label' 		=> __( 'Carousel Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_testimonial_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_testimonial_carousel_review_icon'	=>	1,
							'litho_testimonial_carousel_content' 		=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt ut labore et dolore magna aliqua lorem ipsum dolor sit amet.', 'litho-addons' ),
							'litho_testimonial_carousel_name' 			=> __( 'Lindsay Swanson', 'litho-addons' ),
							'litho_testimonial_carousel_position' 		=> __( 'Creative Director', 'litho-addons' ),
						],
						[
							'litho_testimonial_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_testimonial_carousel_review_icon'	=>	1,
							'litho_testimonial_carousel_content' 		=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt ut labore et dolore magna aliqua lorem ipsum dolor sit amet.', 'litho-addons' ),
							'litho_testimonial_carousel_name' 			=> __( 'Bryan Johnson', 'litho-addons' ),
							'litho_testimonial_carousel_position' 		=> __( 'HR Manager', 'litho-addons' ),
						],
						[
							'litho_testimonial_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_testimonial_carousel_review_icon'	=>	1,
							'litho_testimonial_carousel_content' 		=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt ut labore et dolore magna aliqua lorem ipsum dolor sit amet.', 'litho-addons' ),
							'litho_testimonial_carousel_name' 			=> __( 'Alexander Harvard', 'litho-addons' ),
							'litho_testimonial_carousel_position' 		=> __( 'Co Founder / CEO', 'litho-addons' ),
						],
					],
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_testimonial_carousel_settings_section',
				[
					'label' => __( 'Slider Configuration', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'litho_thumbnail',
					'default'   => 'full',
					'exclude'   => [ 'custom' ],
					'separator' => 'none',
				]
			);
			$slides_to_show = range( 1, 10 );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
			$this->add_responsive_control(
				'litho_slides_to_show',
				[
					'label' 		=> __( 'Slides to Show', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 3,
					'options' 		=> [
						'' 			=> __( 'Default', 'litho-addons' ),
					] + $slides_to_show,
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
				]
			);
			$this->add_control(
				'litho_separator_line',
				[
					'label'      	=> __( 'Separator', 'litho-addons' ),
					'type'       	=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'return_value'  => 'yes',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // IN
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
				'litho_navigation',
				[
					'label' 		=> __( 'Navigation', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'dots',
					'options' 		=> [
						'both' 			=> __( 'Arrows and Dots', 'litho-addons' ),
						'both_thumb'	=> __( 'Arrows and Thumb', 'litho-addons' ),
						'arrows' 		=> __( 'Arrows', 'litho-addons' ),
						'dots' 			=> __( 'Dots', 'litho-addons' ),
						'custom' 		=> __( 'Thumb', 'litho-addons' ),
						'none'			=> __( 'None', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_navigation_dynamic_bullets',
				[
					'label' 		=> __( 'Dynamic Bullets', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
					'condition' => [
						'litho_navigation' => [ 'both', 'dots' ],
					],
				]
			);
			$this->add_control(
				'litho_navigation_arrow_prev_next_text',
				[
					'label' 		=> __( 'Show Prev/Next Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
					'condition' => [
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], //IN
						'litho_navigation' => [ 'both', 'both_thumb', 'arrows' ]
					],
				]
			);	
			$this->add_control(
				'litho_navigation_prev_text',
				[
					'label' 		=> __( 'Prev Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
					'default' 		=> __( 'Prev', 'litho-addons' ),
					'condition' 	=> [
						'litho_navigation' => [ 'both', 'both_thumb', 'arrows' ],
						'litho_navigation_arrow_prev_next_text'	=> 'yes',
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], //IN
					],
				]
			);
			$this->add_control(
				'litho_navigation_next_text',
				[
					'label' 		=> __( 'Next Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
					'default' 		=> __( 'Next', 'litho-addons' ),
					'condition' 	=> [
						'litho_navigation' => [ 'both', 'both_thumb', 'arrows' ],
						'litho_navigation_arrow_prev_next_text'	=> 'yes',
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], //IN
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
			/*$this->add_control(
				'litho_centered_slides',
				[
					'label' 		=> __( 'Center Slide', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'condition' => [
						'litho_slides_to_show!' => '1',
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-7' ], //IN
					],
				]
			);*/
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
						''			=> __( 'Default', 'litho-addons' ),
						'ltr' 		=> __( 'Left', 'litho-addons' ),
						'rtl' 		=> __( 'Right', 'litho-addons' ),
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
					'condition' 	=> [
						'litho_navigation' => [ 'both', 'both_thumb', 'arrows' ],
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
				'litho_testimonial_carousel_genaral_style_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_aligment',
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
						'{{WRAPPER}}  .testimonial-wrap'	=> 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_testimonial_carousel_background',
					'selector' 		=> '{{WRAPPER}} .testimonial-wrap',
				]
			);
			$this->add_control(
				'litho_box_shadow_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-2' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_testimonial_carousel_shadow',
					'selector' 		=> '{{WRAPPER}} .testimonial-wrap',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_testimonial_carousel_hover_shadow',
					'label' 		=> __( 'Hover Box Shadow', 'litho-addons' ),
					'selector' 		=> '{{WRAPPER}} .testimonials-style-2:hover .testimonial-wrap',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-2' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_testimonial_carousel_border',
					'selector'    	=> '{{WRAPPER}} .testimonial-wrap',
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_testimonial_carousel_slide_container_width_heading',
				[
					'label' 		=> __( 'Slide Container Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => 'testimonial-carousel-style-7', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_slide_container_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%' ],
					'default' 		=> [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' 		=> [ '%' => [ 'min' => 50, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-carousel-style-7.swiper' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => 'testimonial-carousel-style-7', // IN
					],
				]
			);
			
			$this->add_control(
				'litho_testimonial_carousel_title_box_heading',
				[
					'label' 		=> __( 'Title Box', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_title_box_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 500 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .carousel-title-box' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_title_box_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .carousel-title-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_title_box_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .carousel-title-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_slider_box_heading',
				[
					'label' 		=> __( 'Slider Carousel Box', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_slider_box_min_width',
				[
					'label'      	=> __( 'Min.Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 500 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonials-carousel-wrap' => 'min-width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_slider_box_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonials-carousel-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_slider_box_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonials-carousel-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					],
				]
			);

			$this->add_control(
				'litho_testimonial_carousel_content_box_heading',
				[
					'label' 		=> __( 'Content style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_testimonial_carousel_content_box_background',
					'selector' 		=> '{{WRAPPER}} .testimonials-content-wrap',
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_testimonial_carousel_content_box_shadow',
					'selector' 		=> '{{WRAPPER}} .testimonials-content-wrap',
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_box_aligment',
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
						'{{WRAPPER}} .testimonials-content-wrap'	=> 'text-align: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-2' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_testimonial_carousel_content_box_border',
					'selector'    	=> '{{WRAPPER}} .testimonials-content-wrap',
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_box_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonials-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_box_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonials-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_box_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonials-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-7' ], // NOT IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_image_style_section',
				[
					'label' 		=> __( 'Image', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-3' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_image_size',
				[
					'label'      	=> __( 'Image Size', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap img, {{WRAPPER}} .testimonials-content-wrap img, {{WRAPPER}} .testimonials-image-box img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_image_right_spacing',
				[
					'label'      	=> __( 'Image Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap .testimonials-image-box' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => 'testimonial-carousel-style-4', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_image_spacing',
				[
					'label'      	=> __( 'Bottom Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap img, {{WRAPPER}} .testimonials-content-wrap img, {{WRAPPER}} .testimonials-image-box img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type!' => 'testimonial-carousel-style-8', // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_testimonial_carousel_image_border',
					'selector'    	=> '{{WRAPPER}} .testimonial-wrap img, {{WRAPPER}} .testimonials-content-wrap img, {{WRAPPER}} .testimonials-image-box img',
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_image_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap img, {{WRAPPER}} .testimonials-content-wrap img, {{WRAPPER}} .testimonials-image-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_testimonial_carousel_image_box_shadow',
					'selector'      => '{{WRAPPER}} .testimonial-wrap img, {{WRAPPER}} .testimonials-content-wrap img, {{WRAPPER}} .testimonials-image-box img',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_content_slide_section',
				[
					'label' 		=> __( 'Content Slide', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-4', 'testimonial-carousel-style-6' ], // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_slide_aligment',
				[
					'label'   		=> __( 'Alignment', 'litho-addons' ),
					'type'    		=> Controls_Manager::CHOOSE,
					'default' 		=> '',
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
						'{{WRAPPER}} .carousel-title-box'	=> 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_content_slide_heading',
				[
					'label' 		=> __( 'Heading', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_heading_title_type',
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

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 				=> 'litho_testimonial_carousel_heading_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 			=> '{{WRAPPER}} .heading',
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_heading_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .heading' => 'color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_heading_title_type' => 'normal',
					],
				]
			);

			// STROKE Title Type
			$this->add_control(
				'litho_testimonial_carousel_heading_stroke_color',
				[
					'label'			=> __( 'Text Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'default'		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .heading' => '-webkit-text-fill-color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_heading_title_type' => 'stroke',
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_heading_stroke_border_color',
				[
					'label'			=> __( 'Stroke Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'default'		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .heading' => '-webkit-text-stroke-color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_heading_title_type' => 'stroke',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_heading_stroke_border_width',
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
						'{{WRAPPER}} .heading' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
					],
					'condition'		=> [
						'litho_heading_title_type' => 'stroke',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_slide_heading_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .heading' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_heading_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_content_slide_subheading',
				[
					'label' 		=> __( 'Subheading', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_subheading_title_type',
				[
					'label' 		=> __( 'Title Type', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'normal' => [
							'title' 	=> __( 'Normal', 'litho-addons' ),
							'icon' 		=> 'line-icon-Normal-Text',
						],
						'stroke' => [
							'title' 	=> __( 'Stroke', 'litho-addons' ),
							'icon' 		=> 'fa-solid fa-font',
						],
					],
					'default' => 'normal',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_testimonial_carousel_subheading_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .subheading',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' => 'litho_testimonial_carousel_subheading_color',
					'selector' => '{{WRAPPER}} .subheading',
					'condition'		=> [
						'litho_subheading_title_type' => 'normal',
					],
				]
			);
			// STROKE Title Type
			$this->add_control(
				'litho_testimonial_carousel_subheading_stroke_color',
				[
					'label'			=> __( 'Text Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'default'		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .subheading' => '-webkit-text-fill-color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_subheading_title_type' => 'stroke',
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_subheading_stroke_border_color',
				[
					'label'			=> __( 'Stroke Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'default'		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .subheading' => '-webkit-text-stroke-color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_subheading_title_type' => 'stroke',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_subheading_stroke_border_width',
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
						'{{WRAPPER}} .subheading' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
					],
					'condition'		=> [
						'litho_subheading_title_type' => 'stroke',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_slide_subheading_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .subheading' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_subheading_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_content_slide_content',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_content_slide_content_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .carousel-content-box' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 				=> 'litho_testimonial_carousel_content_slide_content_typography',
					'selector' 			=> '{{WRAPPER}} .carousel-content-box',
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_slide_content_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .carousel-content-box' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_title_style_section',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 			=> [
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-3', 'testimonial-carousel-style-8' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_title_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .testimonial-wrap .testimonial-title, {{WRAPPER}} .testimonials-content-wrap .testimonial-title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_testimonial_carousel_title_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .testimonial-wrap .testimonial-title, {{WRAPPER}} .testimonials-content-wrap .testimonial-title',
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_title_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap .testimonial-title, {{WRAPPER}} .testimonials-content-wrap .testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_name_style_section',
				[
					'label' 		=> __( 'Name', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 			=> 'litho_testimonial_carousel_name_color',
					'selector' 		=> '{{WRAPPER}} .testimonial-wrap .testimonial-name, {{WRAPPER}} .testimonials-content-wrap .testimonial-name',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_testimonial_carousel_name_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .testimonial-wrap .testimonial-name, {{WRAPPER}} .testimonials-content-wrap .testimonial-name',
				]
			);
			$this->add_control(
				'litho_heading_style_lastname',
				[
					'label' 		=> __( 'Lastname', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);

			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 			=> 'litho_testimonial_carousel_lastname_color',
					'selector' 		=> '{{WRAPPER}} .testimonial-wrap .testimonial-lastname, {{WRAPPER}} .testimonials-content-wrap .testimonial-lastname',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_testimonial_carousel_lastname_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .testimonial-wrap .testimonial-lastname, {{WRAPPER}} .testimonials-content-wrap .testimonial-lastname',
				]
			);
			$this->add_responsive_control(
	            'litho_testimonial_carousel_lastname_display_settings' ,
	            [
	                'label'        	=> __( 'Display', 'litho-addons' ),
	                'type'         	=> Controls_Manager::SELECT,
	                'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inherit' 		=> __( 'Inherit', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .testimonial-wrap .testimonial-lastname, {{WRAPPER}} .testimonials-content-wrap .testimonial-lastname' => 'display: {{VALUE}}',
					],
	            ]
	        );
	        $this->add_responsive_control(
				'litho_testimonial_carousel_name_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .testimonial-wrap .testimonial-name, {{WRAPPER}} .testimonials-content-wrap .testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_content_style_section',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_testimonial_carousel_content_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .testimonial-wrap .testimonial-content, {{WRAPPER}} .testimonials-content-wrap .testimonial-content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_testimonial_carousel_content_typography',
					'selector' 	=> '{{WRAPPER}} .testimonial-wrap .testimonial-content, {{WRAPPER}} .testimonials-content-wrap .testimonial-content',
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_size',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .testimonial-wrap .testimonial-content, {{WRAPPER}} .testimonials-content-wrap .testimonial-content' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_testimonial_carousel_content_margin',
				[
					'label'      			=> __( 'Margin', 'litho-addons' ),
					'type'       			=> Controls_Manager::DIMENSIONS,
					'size_units' 			=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  			=> [
						'{{WRAPPER}} .testimonial-wrap .testimonial-content, {{WRAPPER}} .testimonials-content-wrap .testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 			=> [
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-2', 'testimonial-carousel-style-5' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_position_style_section',
				[
					'label' 		=> __( 'Position', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 			=> 'litho_testimonial_carousel_position_color',
					'selector' 		=> '{{WRAPPER}} .testimonial-wrap .testimonial-position, {{WRAPPER}} .testimonials-content-wrap .testimonial-position',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 				=> 'litho_testimonial_carousel_position_typography',
					'selector' 			=> '{{WRAPPER}} .testimonial-wrap .testimonial-position, {{WRAPPER}} .testimonials-content-wrap .testimonial-position',
				]
			);
			 $this->add_responsive_control(
				'litho_testimonial_carousel_position_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .testimonial-wrap .testimonial-position, {{WRAPPER}} .testimonials-content-wrap .testimonial-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_testimonial_icon',
				[
					'label' => __( 'Icon', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type!' => [ 'testimonial-carousel-style-7', 'testimonial-carousel-style-8' ], // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_section_style_testimonial_icon_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .testimonials-rounded-icon',
					'condition' 	=> [ 
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-2' ], // IN
					],
				]
			);

			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' => 'litho_testimonial_icon_color',
					'selector' => '{{WRAPPER}} .testimonials-rounded-icon i:before, {{WRAPPER}} .testimonials-rounded-icon svg',
				]
			);			

			$this->add_control(
				'litho_testimonial_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .testimonials-rounded-icon, {{WRAPPER}} .testimonials-rounded-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_control(
				'litho_heading_style_svg_icon',
				[
					'label' 		=> __( 'SVG Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_testimonial_svg_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'show_label'    => false,
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => ['min' => 6, 'max' => 300 ], '%' => ['min' => 1, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .testimonials-rounded-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_testimonial_carousel_navigation_style_section',
				[
					'label' 		=> __( 'Navigation', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_navigation' => [ 'arrows', 'dots', 'both', 'both_thumb', 'custom' ]
					],
				]
			);
			$this->add_control(
				'litho_heading_style_arrows',
				[
					'label' 		=> __( 'Arrows style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [
						'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ]
					],
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
						'litho_testimonial_carousel_layout_type' => [ 'testimonial-carousel-style-1', 'testimonial-carousel-style-2', 'testimonial-carousel-style-3', 'testimonial-carousel-style-5', 'testimonial-carousel-style-7' ], // IN
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
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
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
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> [ 'min' => 1, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev i, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
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
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_top',
				[
					'label' 		=> __( 'Top', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> [ 'min' => 1, 'max' => 500 ], '%' => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_prev_next_text_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev span, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next span',
					'condition' => [
						'litho_navigation' 						=> [ 'both', 'both_thumb', 'arrows' ],
						'litho_navigation_arrow_prev_next_text'	=> 'yes'
					],
					'separator'	=> 'before'
				]
			);
			$this->start_controls_tabs( 'litho_arrows_tabs', [ 'condition' => [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ] ] );
				$this->start_controls_tab( 'litho_arrows_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_arrows_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
								'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next svg' => 'fill: {{VALUE}};',
								'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev span, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next span' => 'color: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
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
							'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_arrows_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_arrows_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover' => 'color: {{VALUE}};',
								'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover span, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover span' => 'color: {{VALUE}};',
								'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg' => 'fill: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_arrows_background_hover_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector' 		=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
							'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
						]
					);
					$this->add_control(
						'litho_arrows_hover_border_color',
						[
							'label' 		=> __( 'Border Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover' => 'border-color: {{VALUE}} !important;',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_arrows_box_border',
					'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
					'fields_options'=> [ 'border' => [ 'separator' => 'before' ] ],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
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
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both', 'both_thumb' ] ],
				]
			);
			$this->add_control(
				'litho_heading_style_dots_separator_panel_style',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
					'condition' 	=> [ 'litho_navigation' => [ 'both', 'both_thumb' ] ],
				]
			);
			$this->add_control(
				'litho_heading_style_dots',
				[
					'label' 		=> __( 'Dots style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
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
						'outside' 	=> __( 'Outside', 'litho-addons' ),
						'inside' 	=> __( 'Inside', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-pagination-position-',
					'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
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
							'name'        	=> 'litho_dots_hover_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_dots_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'placeholder'   => [
						'top'       => 'auto',
						'right'     => '',
						'bottom'    => 'auto',
						'left'      => '',
					],
					'allowed_dimensions' => 'horizontal',
					'selectors'  	=> [
						'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
					'separator'		=> 'before'
				]
			);

			$this->add_control(
				'litho_heading_style_custom_pagination',
				[
					'label' 		=> __( 'Custom style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'condition' 	=> [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ],
					'separator'		=> 'before'
				]
			);
			$this->start_controls_tabs( 'litho_custom_pagination_tabs', [ 'condition' => [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ] ]  );
				$this->start_controls_tab( 'litho_custom_pagination_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_responsive_control(
						'litho_custom_pagination_size',
						[
							'label' 		=> __( 'Size', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 100 ],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .slider-custom-image-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_custom_pagination_active_tab', [ 'label' => __( 'Active', 'litho-addons' ) ] );
					$this->add_responsive_control(
						'litho_custom_pagination_active_size',
						[
							'label' 		=> __( 'Size', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 100 ],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .slider-custom-image-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ],
						]
					);				
				$this->end_controls_tab();
			$this->end_controls_tabs();		
			$this->add_responsive_control(
				'litho_custom_pagination_aligment',
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
						'{{WRAPPER}} .slider-custom-image-pagination'	=> 'text-align: {{VALUE}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ],
					'separator'		=> 'before'
				]
			);

			$this->add_responsive_control(
				'litho_custom_pagination_spacing',
				[
					'label'			=> __( 'Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 100 ],
					],
					'selectors'  	=> [
						'{{WRAPPER}} .slider-custom-image-pagination .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_custom_pagination_padding',
				[
					'label'			=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'default'		=> [
						'unit'		=> 'px',
						'top'		=> 20,
						'right'		=> 0,
						'bottom'	=> 0,
						'left'		=> 0,
					],
					'selectors'  	=> [
						'{{WRAPPER}} .slider-custom-image-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_custom_pagination_margin',
				[
					'label'			=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'default'		=> [
						'unit'		=> 'px',
						'top'		=> 20,
						'right'		=> 0,
						'bottom'	=> 0,
						'left'		=> 0,
					],
					'selectors'  	=> [
						'{{WRAPPER}} .slider-custom-image-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'custom', 'both_thumb' ] ],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render testimonial carousel widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();

			if ( empty( $settings['litho_testimonial_carousel'] ) ) {
				return;
			}

			$slides_count             = '';
			$slider_custom_image_next = '';
			$slider_custom_image_prev = '';
			$slides                   = [];
			$slidesThumbs             = [];
			$id_int                   = substr( $this->get_id_int(), 0, 3 );
			$layou_type               = $this->get_settings( 'litho_testimonial_carousel_layout_type' );

			switch ( $layou_type ) {
				case 'testimonial-carousel-style-1':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$wrapper_key = 'wrapper_' . $index;
						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );
						$litho_review_icon = ( isset( $item['litho_testimonial_carousel_review_icon'] ) && ! empty( $item['litho_testimonial_carousel_review_icon'] ) ) ? $item['litho_testimonial_carousel_review_icon'] : '';
						ob_start();
						if ( ! empty( $item['litho_testimonial_carousel_image'] ) || ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {

							?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								
								<div class="testimonials-wrapper testimonial-wrap"><?php
									if ( ! empty( $item['litho_testimonial_carousel_image'] ) ) {
										?><div class="testimonials-image-box">
											<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
										</div><?php
									}
									if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) ) {
										?><div class="testimonials-content-wrap"><?php
											if ( ! empty( $litho_review_icon ) ) {
												?><div class="testimonials-rounded-icon"><?php
													for ( $i=1; $i <=$litho_review_icon; $i++ ) {
														?><i class="fa-solid fa-star"></i><?php
													}
												?></div><?php
											}
											if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
												?><div class="testimonial-name"><?php
													echo esc_html( $item['litho_testimonial_carousel_name'] );
													if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
														?><span class="testimonial-lastname"><?php
															echo esc_html( $item['litho_testimonial_carousel_lastname'] );
														?></span><?php
													}
												?></div><?php
											}
											if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) {
												?><span class="testimonial-position"><?php
													echo esc_html( $item['litho_testimonial_carousel_position'] );
												?></span><?php
											}
										?></div><?php
									}
									if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) {
										?><div class="testimonial-content"><?php
											echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
										?></div><?php
									}
								?></div>
							</div><?php
						}
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'testimonial-carousel-style-2':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$wrapper_key = 'wrapper_' . $index;
						$link_key    = 'link_' . $index;

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'testimonials-style-2', 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$icon = $this->get_testimonial_carousel_icon( $item );
						ob_start();
							if ( ! empty( $item['litho_testimonial_carousel_image'] ) || ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {
								?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
									<div class="testimonial-wrap"><?php
										if ( ! empty( $item['litho_testimonial_carousel_image'] ) ) {
											?>
												<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
											<?php
										}
										?><div class="testimonials-content-wrap"><?php
											if ( ! empty( $item['litho_testimonial_carousel_image'] ) && ! empty( $icon ) ) {
												?><div class="testimonials-rounded-icon"><?php
													echo sprintf( '%s', $icon );
												?></div><?php
											}
											if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) {
												?><div class="testimonial-content"><?php
													echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
												?></div><?php
											}
											if ( ! empty( $settings['litho_link']['url'] ) ) {
												?><a <?php $this->print_render_attribute_string( 'link' ); ?>><?php
											}
												if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
													?><span class="testimonial-name"><?php
														echo esc_html( $item['litho_testimonial_carousel_name'] );
														if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
															?><span class="testimonial-lastname"><?php
																echo esc_html( $item['litho_testimonial_carousel_lastname'] );
															?></span><?php
														}
													?></span><?php
												}
											if ( ! empty( $settings['litho_link']['url'] ) ) {
												?></a><?php
											}
											if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) {
												?><span class="testimonial-position"><?php
													echo esc_html( $item['litho_testimonial_carousel_position'] );
												?></span><?php
											}
										?></div>
									</div>
								</div><?php 
							}

						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'testimonial-carousel-style-3':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$wrapper_key = 'wrapper_' . $index;
						$icon        = $this->get_testimonial_carousel_icon( $item );

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );
						ob_start();
						
						if ( ! empty( $item['litho_testimonial_carousel_image'] ) || ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {
							?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								<div class="d-flex flex-column flex-sm-row testimonial-wrap">
									<div class="align-self-center"><?php
										if ( ! empty( $item['litho_testimonial_carousel_image'] ) ) {
											?><div class="avtar-image">
												<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
											</div><?php
										}

										if ( ! empty( $icon ) ) {
											?><div class="testimonials-rounded-icon"><?php
												echo sprintf( '%s', $icon );
											?></div><?php
										}

										if ( ! empty( $item['litho_testimonial_carousel_title'] ) ) {
											?><span class="testimonial-title"><?php
												echo esc_html( $item['litho_testimonial_carousel_title'] );
											?></span><?php
										}
										
										if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) {
											?><div class="testimonial-content"><?php
												echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
											?></div><?php
										}
										
										if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) ) {
											?><div class="testimonial-bottom"><?php
												if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
													?><span class="testimonial-name"><?php
														echo esc_html( $item['litho_testimonial_carousel_name'] );
														if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
															?><span class="testimonial-lastname"><?php
																echo esc_html( $item['litho_testimonial_carousel_lastname'] );
															?></span><?php
														}
													?></span><?php
												}
												
												if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) {
													?><span class="testimonial-position"><?php
														echo esc_html( $item['litho_testimonial_carousel_position'] );
													?></span><?php
												}
											?></div><?php
										}
									?></div>
								</div>
							</div><?php
						}

						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'testimonial-carousel-style-4':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$wrapper_key = 'wrapper_'.$index;
						$icon        = $this->get_testimonial_carousel_icon( $item );

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );
						$litho_review_icon = ( isset( $item['litho_testimonial_carousel_review_icon'] ) && ! empty( $item['litho_testimonial_carousel_review_icon'] ) ) ? $item['litho_testimonial_carousel_review_icon'] : '';
						ob_start();
						if ( ! empty( $item['litho_testimonial_carousel_image'] ) || ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {
							?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								<div class="testimonials-wrapper testimonial-wrap">
									<?php if ( ! empty( $item['litho_testimonial_carousel_image'] ) ) { ?>
										<div class="testimonials-image-box">
											<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
										</div>
									<?php } ?>
									<?php if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) ) { ?>
										<div class="testimonials-content-wrap">
											<?php if ( ! empty( $litho_review_icon ) ) { ?>
												<div class="testimonials-rounded-icon">
													<?php for ( $i=1; $i <= $litho_review_icon; $i++ ) { ?><i class="fa-solid fa-star"></i><?php } ?>
												</div>
											<?php } ?>
											<?php if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) ) { ?>
												<div class="testimonial-name"><?php
													echo esc_html( $item['litho_testimonial_carousel_name'] );
													if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
														?><span class="testimonial-lastname"><?php
															echo esc_html( $item['litho_testimonial_carousel_lastname'] );
														?></span><?php
													}
												?></div>
											<?php } ?>
											<?php if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) {
												?><span class="testimonial-position"><?php
													echo esc_html( $item['litho_testimonial_carousel_position'] );
												?></span><?php
											} ?>
										</div>
									<?php } ?>
									<?php if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) {
										?><div class="testimonial-content"><?php
											echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
										?></div>
									<?php } ?>
								</div>
							</div><?php
						}

						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'testimonial-carousel-style-5':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$wrapper_key = 'wrapper_' . $index;
						$link_key    = 'link_' . $index;

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );
						$icon = $this->get_testimonial_carousel_icon( $item );
						ob_start();
						if ( ! empty( $item['litho_testimonial_carousel_image'] ) || ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {
							
							?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								<div class="testimonial-wrap">
									<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
									<div class="testimonials-content-wrap">
										<?php if ( ! empty( $icon ) ) { ?>
											<div class="testimonials-rounded-icon"><?php echo sprintf( '%s', $icon ); ?></div>
										<?php } ?>
										<?php if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) {
											?><div class="testimonial-content"><?php
												echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
											?></div>
										<?php } ?>
										<?php if ( ! empty( $settings['litho_link']['url'] ) ) { ?>
											<a <?php $this->print_render_attribute_string( 'link' ); ?>>
										<?php } ?>
											<?php if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] )  ) { ?>
												<span class="testimonial-name"><?php
													echo esc_html( $item['litho_testimonial_carousel_name'] );
													if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
														?><span class="testimonial-lastname"><?php
															echo esc_html( $item['litho_testimonial_carousel_lastname'] );
														?></span><?php
													}
												?></span>
											<?php } ?>
										<?php if ( ! empty( $settings['litho_link']['url'] ) ) { ?>
											</a>
										<?php } ?>
										<?php if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) {
											?><span class="testimonial-position"><?php
												echo esc_html( $item['litho_testimonial_carousel_position'] );
											?></span>
										<?php } ?>
									</div>
								</div>
							</div><?php
						}

						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'testimonial-carousel-style-6':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$wrapper_key = 'wrapper_' . $index;
						$icon        = $this->get_testimonial_carousel_icon( $item );

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$litho_review_icon = ( isset( $item['litho_testimonial_carousel_review_icon'] ) && ! empty( $item['litho_testimonial_carousel_review_icon'] ) ) ? $item['litho_testimonial_carousel_review_icon'] : '';
						ob_start();
						if ( ! empty( $item['litho_testimonial_carousel_image'] ) || ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {
						
							?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								<div class="testimonials-wrapper testimonial-wrap">
									<?php if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) { ?>
										<div class="testimonial-content"><?php
											echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
										?></div>
									<?php } ?>
									<?php if ( ! empty( $item['litho_testimonial_carousel_image'] ) ) { ?>
										<div class="testimonials-image-box">
											<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
										</div>
									<?php } ?>
									<?php if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) ) { ?>
										<div class="testimonials-content-wrap">
											<?php if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) ) { ?>
												<div class="testimonial-name"><?php
													echo esc_html( $item['litho_testimonial_carousel_name'] );
													if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
														?><span class="testimonial-lastname"><?php
															echo esc_html( $item['litho_testimonial_carousel_lastname'] );
														?></span><?php
													}
												?></div><?php
											}
											if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) { ?>
												<span class="testimonial-position"><?php
													echo esc_html( $item['litho_testimonial_carousel_position'] );
												?></span><?php
											}
										?></div>
									<?php } ?>
								</div>
							</div><?php
						}

						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'testimonial-carousel-style-7':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$wrapper_key = 'wrapper_' . $index;
						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide', 'testimonial-wrap' ],
						] );
						ob_start();
							?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
							</div>
						<?php
						$slides[] = ob_get_contents();
						ob_end_clean();

						// Swiper Slide 2
						ob_start();
						if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {
							?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								<div class="d-flex flex-column flex-sm-row testimonial-wrap">
									<div class="align-self-center"><?php
										if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) {
											?><div class="testimonial-content"><?php
												echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
											?></div><?php
										}
										if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) ) {
											?><div class="testimonial-bottom"><?php
												if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
													?><span class="testimonial-name"><?php
														echo esc_html( $item['litho_testimonial_carousel_name'] );
														if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
															?><span class="testimonial-lastname"><?php echo esc_html( $item['litho_testimonial_carousel_lastname'] );
															?></span><?php 
														}
													?></span><?php
												}
												if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) {
													?><span class="testimonial-position"><?php
														echo esc_html( $item['litho_testimonial_carousel_position'] );
													?></span><?php
												}
											?></div><?php
										}
									?></div>
								</div>
							</div><?php
						}
						$slidesThumbs[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'testimonial-carousel-style-8':
					foreach ( $settings['litho_testimonial_carousel'] as $index => $item ) {
						$icon        = '';
						$wrapper_key = 'wrapper_' . $index;
						$link_key    = 'link_' . $index;

						$this->add_render_attribute( $wrapper_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						ob_start();
						if ( ! empty( $item['litho_testimonial_carousel_image'] ) || ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) || ! empty( $item['litho_testimonial_carousel_position'] ) || ! empty( $item['litho_testimonial_carousel_content'] ) ) {
							?><div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
								<div class="testimonial-wrap">
									<?php $this->get_testimonial_carousel_image( $item, array( 'testimonial-image' ) ); ?>
									<div class="testimonials-content-wrap"><?php
										if ( $item['litho_testimonial_carousel_title'] ) {
											?><span class="testimonial-title"><?php
												echo esc_html( $item['litho_testimonial_carousel_title'] );
											?></span><?php
										}
										if ( ! empty( $item['litho_testimonial_carousel_content'] ) ) {
											?><div class="testimonial-content"><?php
												echo sprintf( '%s', wp_kses_post( $item['litho_testimonial_carousel_content'] ) );
											?></div><?php
										}
										if ( ! empty( $settings['litho_link']['url'] ) ) {
											?><a <?php $this->print_render_attribute_string( 'link' ); ?>><?php
										}
										if ( ! empty( $item['litho_testimonial_carousel_name'] ) || ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
											?><span class="testimonial-name"><?php
											echo esc_html( $item['litho_testimonial_carousel_name'] ); ?><?php
												if ( ! empty( $item['litho_testimonial_carousel_lastname'] ) ) {
													?><span class="testimonial-lastname"><?php
														echo esc_html( $item['litho_testimonial_carousel_lastname'] );
													?></span><?php
												}
											?></span><?php
										}
										if ( ! empty( $settings['litho_link']['url'] ) ) {
											?></a><?php
										}
										if ( ! empty( $item['litho_testimonial_carousel_position'] ) ) {
											?><span class="testimonial-position"><?php
												echo esc_html( $item['litho_testimonial_carousel_position'] );
											?></span><?php
										}
									?></div>
								</div>
							</div><?php
						}

						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
			}

			if ( empty( $slides ) ) {
				return;
			}

			$litho_left_arrow_icon = '';
			$right_arrow_icon      = '';
			$left_icon_migrated    = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
			$right_icon_migrated   = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );
			$is_new                = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

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

			$slides_count          = count( $settings['litho_testimonial_carousel'] );
			$litho_rtl             = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor   = $this->get_settings( 'litho_slider_cursor' );
			$litho_navigation      = $this->get_settings( 'litho_navigation' );
			$litho_prev_text       = $this->get_settings( 'litho_navigation_prev_text' );
			$litho_next_text       = $this->get_settings( 'litho_navigation_next_text' );
			$litho_prev_next_check = $this->get_settings( 'litho_navigation_arrow_prev_next_text' );
			
			$sliderConfig = array(
				'navigation'                 => $this->get_settings( 'litho_navigation' ),
				'autoplay'                   => $this->get_settings( 'litho_autoplay' ),
				'autoplay_speed'             => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover'             => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'                       => $this->get_settings( 'litho_infinite' ),
				'effect'                     => $this->get_settings( 'litho_effect' ),
				'speed'                      => $this->get_settings( 'litho_speed' ),
				'image_spacing'              => $this->get_settings( 'litho_items_spacing' ),
				'slides_to_show'             => $this->get_settings( 'litho_slides_to_show' ),
				'slides_to_show_mobile'      => $this->get_settings( 'litho_slides_to_show_mobile' ),
				'slides_to_show_tablet'      => $this->get_settings( 'litho_slides_to_show_tablet' ),
				'navigation_dynamic_bullets' => $this->get_settings( 'litho_navigation_dynamic_bullets' ),
				'slides_count'               => $slides_count,
			);

			$slideOptions = array();
			switch ( $layou_type ) {
				case 'testimonial-carousel-style-7':
					$this->add_render_attribute( [
						'thumbs-carousel' => [
							'class' => 'swiper-wrapper',
						],
						'thumbs-carousel-wrapper' => [
							'class' => [ 'swiper', 'slider-review-image' ],
						],
					] );

					$slideOptions = array(
						'centered_slides' => 'yes'
					);
					break;
				case 'testimonial-carousel-style-8':
					
					$slideOptions = array(
						'centered_slides' => 'yes',
						'coverflowEffect' => 'yes',
					);
					break;
			}

			$slideSettingsArray = array_merge( $sliderConfig, $slideOptions );

			$this->add_render_attribute( [
				'carousel' => [
					'class' => [
						'elementor-content-carousel',
						'swiper-wrapper',
					],
				],
				'carousel-wrapper' => [
					'class'            => [
						'elementor-testimonial-carousel-wrapper',
						'swiper',
						$layou_type,
						$litho_slider_cursor,
					],
					'data-settings'    => json_encode( $slideSettingsArray ),
					'data-layout-type' => $layou_type,
				],
			] );

			if ( ! empty( $litho_rtl ) ) {
				$this->add_render_attribute( 'carousel-wrapper', 'dir', $litho_rtl );
			}

			$show_dots   = ( in_array( $litho_navigation, [ 'dots', 'both' ] ) );
			$show_arrows = ( in_array( $litho_navigation, [ 'arrows', 'both', 'both_thumb' ] ) );
			$show_custom = ( in_array( $litho_navigation, [ 'custom', 'both_thumb' ] ) );

			if ( ( 'yes' === $litho_prev_next_check && $show_arrows ) ) {
				$this->add_render_attribute( 'carousel-wrapper', 'class', 'prev-next-navigation' );
			}

			if ( 'yes' === $this->get_settings( 'litho_image_stretch' ) ) {
				$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
			}

			$litho_prev_text = ( $litho_prev_text )	? $litho_prev_text : esc_html__( 'Previous', 'litho-addons' );
			$litho_next_text = ( $litho_next_text )	? $litho_next_text : esc_html__( 'Next', 'litho-addons' );

			if ( in_array( $litho_navigation, [ 'both_thumb' ] ) ) {
				$this->add_render_attribute( 'swiper-button-prev', 'class', [ $slider_custom_image_prev ] );
				$this->add_render_attribute( 'swiper-button-next', 'class', [ $slider_custom_image_next ] );
			}

			$this->add_render_attribute( 'swiper-button-prev', 'class', [ 'elementor-swiper-button', 'elementor-swiper-button-prev' ] );
			$this->add_render_attribute( 'swiper-button-next', 'class', [ 'elementor-swiper-button', 'elementor-swiper-button-next' ] );
			?>
			
			<?php if ( 'testimonial-carousel-style-4' === $layou_type || 'testimonial-carousel-style-6' === $layou_type ) { ?>
				<?php if ( ! empty( $settings['litho_testimonial_carousel_subheading'] ) || ! empty( $settings['litho_testimonial_carousel_heading'] ) || ! empty( $settings['litho_testimonial_carousel_slide_content'] )) {?>
					<div class="carousel-title-box">
						<?php if ( ! empty( $settings['litho_testimonial_carousel_subheading'] ) ) {?>
							<div class="subheading"><?php echo esc_html( $settings['litho_testimonial_carousel_subheading'] ); ?></div>
						<?php } ?>
						<?php if ( ! empty( $settings['litho_testimonial_carousel_heading'] ) ) {?>
						<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="heading"><?php echo esc_html( $settings['litho_testimonial_carousel_heading'] ); ?></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore ?>
						<?php } ?>
						<?php if ( ! empty( $settings['litho_testimonial_carousel_slide_content'] ) ) { ?>
							<div class="carousel-content-box"><?php echo sprintf( '%s', wp_kses_post( $settings['litho_testimonial_carousel_slide_content'] ) ); ?></div>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="testimonials-carousel-wrap">
			<?php } ?>

			<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
				<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
					<?php echo implode( '', $slides ); ?>
				</div>
				<?php if ( 1 < $slides_count ) { ?>
					<?php if ( $show_dots ) { ?>
						<div class="swiper-pagination"></div>
					<?php } ?>
					<?php if ( $show_custom ) { ?>
						<div class="slider-custom-image-pagination"></div>
					<?php } ?>
					<?php if ( $show_arrows ) { ?>
						<div <?php $this->print_render_attribute_string( 'swiper-button-prev' ); ?>>
							<?php if ( ! empty( $litho_left_arrow_icon ) ) {
								echo sprintf( '%s', $litho_left_arrow_icon ); // phpcs:ignore
							} else { ?>
								<i class="eicon-chevron-left" aria-hidden="true"></i>
							<?php } ?>
							<span class="elementor-screen-only"><?php echo esc_html( $litho_prev_text ); ?></span>
						</div>
						<div <?php $this->print_render_attribute_string( 'swiper-button-next' ); ?>>
							<?php if ( ! empty( $right_arrow_icon ) ) {
								echo sprintf( '%s', $right_arrow_icon ); // phpcs:ignore
							} else { ?>
								<i class="eicon-chevron-right" aria-hidden="true"></i>
							<?php } ?>	
							<span class="elementor-screen-only"><?php echo esc_html( $litho_next_text ); ?></span>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
			<?php if ( 'testimonial-carousel-style-7' === $layou_type && ! empty( $slidesThumbs ) ) { ?>
				<div <?php $this->print_render_attribute_string( 'thumbs-carousel-wrapper' ); ?>>
					<div <?php $this->print_render_attribute_string( 'thumbs-carousel' ); ?>>
						<?php echo implode( '', $slidesThumbs ); ?>
					</div>
				</div>
			<?php } ?>
			<?php if ( 'testimonial-carousel-style-4' === $layou_type || 'testimonial-carousel-style-6' === $layou_type ) { ?>
				</div>
			<?php } ?>
			<?php
		}

		/* Return carousel image */
		public function get_testimonial_carousel_image( $item, $classes_arr = array() ) {

			$class_list                       = '';
			$classes                          = '';
			$litho_testimonial_carousel_image = '';
			$settings                         = $this->get_settings_for_display();
			if ( ! empty ( $classes_arr ) ) {
				$class_list = ( is_array( $classes_arr ) ) ? implode( ' ' , $classes_arr ) : '';
			} else {
				$class_list = $classes_arr;
			}

			if ( ! empty ( $class_list ) ) {
				$classes = ' class="' . $class_list . '"';
			}

			if ( ! empty( $item['litho_testimonial_carousel_image']['id'] ) ) {
				$litho_srcset_data                    = litho_get_image_srcset_sizes( $item['litho_testimonial_carousel_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_testimonial_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_testimonial_carousel_image']['id'], 'litho_thumbnail', $settings );
				$litho_testimonial_carousel_image_alt = Control_Media::get_image_alt( $item['litho_testimonial_carousel_image'] );
				$litho_testimonial_carousel_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s %4$s />', esc_url( $litho_testimonial_carousel_image_url ), esc_attr( $litho_testimonial_carousel_image_alt ), $litho_srcset_data, $classes );
			} elseif ( ! empty( $item['litho_testimonial_carousel_image']['url'] ) ) {
				$litho_testimonial_carousel_image_url = $item['litho_testimonial_carousel_image']['url'];
				$litho_testimonial_carousel_image_alt = '';
				$litho_testimonial_carousel_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_testimonial_carousel_image_url ), esc_attr( $litho_testimonial_carousel_image_alt ), $classes );
			}

			echo sprintf( '%s', $litho_testimonial_carousel_image ); // phpcs:ignore
		}

		/* Return carousel icon */
		public function get_testimonial_carousel_icon( $item ) {
			$icon     = '';
			$settings = $this->get_settings_for_display();
			if ( ! empty( $item['litho_testimonial_carousel_icon'] ) || ( ! empty( $item['litho_testimonial_carousel_icon']['value'] ) ) ) {
				$testimonial_carousel_icon_is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
				$testimonial_carousel_icon_migrated = isset( $item['__fa4_migrated']['litho_testimonial_carousel_icon'] );

				if ( $testimonial_carousel_icon_is_new || $testimonial_carousel_icon_migrated ) {
					ob_start();
						Icons_Manager::render_icon( $item['litho_testimonial_carousel_icon'], [ 'aria-hidden' => 'true' ] );
					$icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_testimonial_carousel_icon']['value'] ) && ! empty( $settings['litho_testimonial_carousel_icon']['value'] ) ) {
					$icon .= '<i class="' . esc_attr( $item['litho_testimonial_carousel_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}
			return $icon;
		}
	}
}
