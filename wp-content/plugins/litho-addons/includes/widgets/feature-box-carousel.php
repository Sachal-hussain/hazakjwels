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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Litho widget for feature box carousel.
 *
 * @package Litho
 */

// If class `Feature_Box_Carousel` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Feature_Box_Carousel' ) ) {

	class Feature_Box_Carousel extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-feature-box-carousel';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Feature Box Carousel', 'litho-addons' );
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
		 * Retrieve the list of scripts the feature box carousel widget depended on.
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
		 * @return string Widget categories.
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
			return [ 'image', 'photo', 'visual', 'slide', 'carousel', 'slider', 'content' ];
		}
		
		/**
		 * Register feature box carousel widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_feature_box_carousel_general_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_layout_type',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'feature-box-carousel-style-1',
					'options' 		=> [
						'feature-box-carousel-style-1' => __( 'Style 1', 'litho-addons' ),
						'feature-box-carousel-style-2' => __( 'Style 2', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_carousel_content_tabs' );
				$this->start_controls_tab( 'litho_feature_box_carousel_heading_tab',
					[
						'label' => __( 'Heading', 'litho-addons' )
					]
				);
				$this->add_control(
					'litho_feature_box_carousel_heading',
					[
						'label' 		=> __( 'Heading', 'litho-addons' ),
						'type' 			=> Controls_Manager::TEXT,
						'dynamic' => [
						    'active' => true
						],
						'default'		=> __( 'Write heading here', 'litho-addons' ),
						'label_block' 	=> true,
					]
				);
				$this->add_control(
					'litho_header_size',
					[
						'label'		=> __( 'Heading HTML Tag', 'litho-addons' ),
						'type' 		=> Controls_Manager::SELECT,
						'options' 	=> [
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
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_feature_box_carousel_subheading_tab',
					[
						'label' => __( 'Subheading', 'litho-addons' )
					]
				);
				$this->add_control(
					'litho_feature_box_carousel_subheading',
					[
						'label' 		=> __( 'Subheading', 'litho-addons' ),
						'type' 			=> Controls_Manager::TEXT,
						'dynamic' => [
						    'active' => true
						],
						'default'     => __( 'Write subheading here', 'litho-addons' ),
						'label_block' => true,
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_feature_box_carousel_content_tab',
					[
						'label' => __( 'Content', 'litho-addons' )
					]
				);
				$this->add_control(
					'litho_feature_box_carousel_slide_content',
					[
						'label'      => __( 'Content', 'litho-addons' ),
						'show_label' => false,
						'type'       => Controls_Manager::WYSIWYG,
						'default'    => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'litho-addons' ),
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_carousel_content_section',
				[
					'label'			=> __( 'Carousel', 'litho-addons' ),
				]
			);
			$repeater = new Repeater();
			$repeater->start_controls_tabs( 'litho_feature_box_carousel_tabs' );
				$repeater->start_controls_tab(
					'litho_feature_box_carousel_image_tab',
					[
						'label' => __( 'Icon', 'litho-addons' )
					]
				);
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
					'litho_item_icon',
					[
						'label'       	=> __( 'Icon', 'litho-addons' ),
						'type'        	=> Controls_Manager::ICONS,
						'label_block' 	=> true,
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
				$repeater->end_controls_tab();
				$repeater->start_controls_tab(
					'litho_feature_box_carousel_content_tab',
					[
						'label' => __( 'Content', 'litho-addons' )
					]
				);
				$repeater->add_control(
					'litho_feature_box_carousel_digit',
					[
						'label' 		=> __( 'Digit/Subtitle', 'litho-addons' ),
						'type' 			=> Controls_Manager::TEXT,
						'dynamic' => [
							'active' => true
						],
						'label_block' 	=> true,
					]
				);
				$repeater->add_control(
					'litho_feature_box_carousel_title',
					[
						'label' 		=> __( 'Title', 'litho-addons' ),
						'type' 			=> Controls_Manager::TEXT,
						'dynamic' => [
						    'active' => true
						],
						'default'		=> __( 'Write title here', 'litho-addons' ),
						'label_block' 	=> true,
					]
				);	
				$repeater->add_control(
					'litho_feature_box_carousel_content',
					[
						'label' 		=> __( 'Content', 'litho-addons' ),
						'type' 			=> Controls_Manager::WYSIWYG,
						'dynamic' 		=> [
						    'active' => true
						],
						'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Sed do eiusmod tem', 'litho-addons' ),
					]
				);
				$repeater->add_control(
					'litho_button_heading',
					[
						'label' 		=> __( 'Button', 'litho-addons' ),
						'type' 			=> Controls_Manager::HEADING,
						'separator' 	=> 'before',
					]
				);
				$repeater->add_control(
					'litho_button_text',
					[
						'label' 		=> __( 'Button Text', 'litho-addons' ),
						'type' 			=> Controls_Manager::TEXT,
						'dynamic' => [
						    'active' => true
						],
						'default' 		=> __( 'Click Here', 'litho-addons' ),
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
						'label_block' 	=> true,
						'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
						'default'       => [
							'url'       => '#',
						],
					]
				);
				$repeater->add_control(
					'litho_size',
					[
						'label' 			=> __( 'Size', 'litho-addons' ),
						'type' 				=> Controls_Manager::SELECT,
						'default' 			=> 'xs',
						'options' 			=> self::get_button_sizes(),
						'style_transfer' 	=> true,
					]
				);
				$repeater->add_control(
					'litho_selected_icon',
					[
						'label'            => __( 'Icon', 'litho-addons' ),
						'type'             => Controls_Manager::ICONS,
						'label_block'      => true,
						'fa4compatibility' => 'icon',
					]
				);
				$repeater->end_controls_tab();
				$repeater->start_controls_tab(
					'litho_feature_box_carousel_background_tab',
					[
						'label' => __( 'Background', 'litho-addons' )
					]
				);
				$repeater->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     => 'litho_feature_box_carousel_slide_background',
						'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .feature-box-carousel-wrap',
					]
				);
				$repeater->end_controls_tab();
			$repeater->end_controls_tabs();

			$this->add_control(
				'litho_feature_box_carousel',
				[
					'label' 		=> __( 'Carousel Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_feature_box_carousel_image'   => '',
							'litho_feature_box_carousel_digit'   => __( '01', 'litho-addons' ),
							'litho_feature_box_carousel_title'   => __( 'Write title here', 'litho-addons' ),
							'litho_feature_box_carousel_content' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt ut labore et dolore magna aliqua lorem ipsum dolor sit amet.', 'litho-addons' ),
						],
						[
							'litho_feature_box_carousel_image'   => '',
							'litho_feature_box_carousel_digit'   => __( '02', 'litho-addons' ),
							'litho_feature_box_carousel_title'   => __( 'Write title here', 'litho-addons' ),
							'litho_feature_box_carousel_content' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt ut labore et dolore magna aliqua lorem ipsum dolor sit amet.', 'litho-addons' ),
						],
						[
							'litho_feature_box_carousel_image'   => '',
							'litho_feature_box_carousel_digit'   => __( '03', 'litho-addons' ),
							'litho_feature_box_carousel_title'   => __( 'Write title here', 'litho-addons' ),
							'litho_feature_box_carousel_content' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt ut labore et dolore magna aliqua lorem ipsum dolor sit amet.', 'litho-addons' ),
						],
					],
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_feature_box_carousel_settings_section',
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
					'condition' 	=> [ 'litho_slides_to_show!' => '1' ],
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
					'default' 		=> 'arrows',
					'options' 		=> [
						'both' 			=> __( 'Arrows and Dots', 'litho-addons' ),
						'arrows' 		=> __( 'Arrows', 'litho-addons' ),
						'dots' 			=> __( 'Dots', 'litho-addons' ),
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

			/////////////////// STYLE TAB START ///////////////////////

			$this->start_controls_section(
				'litho_feature_box_carousel_genaral_style_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_carousel_box_tabs' );
				$this->start_controls_tab( 'litho_feature_box_carousel_box_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_feature_box_carousel_box_background',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .feature-box-carousel-wrap',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_feature_box_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_feature_box_carousel_box_background_hover',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .feature-box-carousel-wrap:hover',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_feature_box_carousel_aligment',
				[
					'label'   		=> __( 'Text Alignment', 'litho-addons' ),
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
						'{{WRAPPER}}  .feature-box-carousel-wrap' => 'text-align: {{VALUE}};',
						'{{WRAPPER}}  .feature-box-carousel-wrap .elementor-icon' => 'text-align: {{VALUE}};',
					],
					'separator' 	=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_h_aligment',
				[
					'label'   		=> __( 'Horizontal Alignment', 'litho-addons' ),
					'type'    		=> Controls_Manager::CHOOSE,
					'default' 		=> '',
					'options' 		=> [
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
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-style-2 .feature-box-carousel-wrap' => 'display:flex;justify-content: {{VALUE}};',
						'{{WRAPPER}} .feature-box-carousel-style-2 .feature-box-carousel-wrap .elementor-icon' => 'display:flex;justify-content: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_feature_box_carousel_layout_type' => [ 'feature-box-carousel-style-2' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_feature_box_carousel_border',
					'selector'    	=> '{{WRAPPER}} .feature-box-carousel-wrap',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_height',
				[
					'label'         => __( 'Min Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 1000 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'default'       => [ 'unit' => 'px', 'size' => '' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box-carousel-wrap' => 'min-height: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [
						'litho_feature_box_carousel_layout_type' => [ 'feature-box-carousel-style-2' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_feature_box_carousel_box_shadow',
					'selector'      => '{{WRAPPER}} .feature-box-carousel-wrap',
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_title_box_heading',
				[
					'label' 		=> __( 'Title Box', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_title_box_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 500 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .carousel-title-box' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_title_box_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .carousel-title-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_title_box_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .carousel-title-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_feature_box_carousel_slider_box_heading',
				[
					'label' 		=> __( 'Left Content Box', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			
			$this->add_responsive_control(
				'litho_feature_box_carousel_slider_box_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_slider_box_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-content-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_content_box_heading',
				[
					'label' 		=> __( 'Slide Content Box', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_feature_box_carousel_content_box_background',
					'selector' 		=> '{{WRAPPER}} .feature-box-carousel-content-wrap',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_feature_box_carousel_content_box_shadow',
					'selector' 		=> '{{WRAPPER}} .feature-box-carousel-content-wrap',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_feature_box_carousel_content_box_border',
					'selector'    	=> '{{WRAPPER}} .feature-box-carousel-content-wrap',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_content_box_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_content_box_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_content_box_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_carousel_content_slide_section',
				[
					'label' 		=> __( 'Content Slide', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_content_slide_heading',
				[
					'label' 		=> __( 'Heading', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_heading_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .heading' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_feature_box_carousel_heading_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .heading',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_heading_margin',
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
				'litho_feature_box_carousel_content_slide_subheading',
				[
					'label' 		=> __( 'Subheading', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' => 'litho_feature_box_carousel_subheading_color',
					'selector' => '{{WRAPPER}} .subheading',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_feature_box_carousel_subheading_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .subheading',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_subheading_margin',
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
				'litho_feature_box_carousel_content_slide_content',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_content_slide_content_color',
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
					'name' 		=> 'litho_feature_box_carousel_content_slide_content_typography',
					'selector' 	=> '{{WRAPPER}} .carousel-content-box',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_content_slide_content_width',
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

			$this->add_responsive_control(
				'litho_feature_box_carousel_slide_padding',
				[
					'label'      	=> __( 'Slide Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .elementor-feature-box-carousel-wrapper .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_carousel_icon_style_section',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_style_icons',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
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
					'prefix_class' 	=> 'elementor-shape-',
				]
			);
			$this->add_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_heading_style_image',
				[
					'label' 		=> __( 'Image', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator'		=> 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator'		=> 'none',
				]
			);
			$this->add_responsive_control(
				'litho_content_image_w_h_size',
				[
					'label' 	=> __( 'Image Size', 'litho-addons' ),
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
						'size' 		=> '25',
					],
					'selectors' => [
						'{{WRAPPER}} .feature-carousel-box .elementor-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_carousel_icon_style_tabs' );
				$this->start_controls_tab(
					'litho_feature_box_carousel_icon_style_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_icon_color',
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .elementor-icon i:before, {{WRAPPER}}.elementor-view-framed .elementor-icon svg, {{WRAPPER}}.elementor-view-default .elementor-icon svg',
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
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon'     => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .elementor-icon'      => 'color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-default .elementor-icon'     => 'color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .elementor-icon svg'  => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
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
							'{{WRAPPER}}.elementor-view-framed .elementor-icon'      => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon'     => 'color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_feature_box_carousel_icon_style_hover_tab',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_hover_icon_color',
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .feature-box-carousel-wrap:hover .elementor-icon i:before,{{WRAPPER}}.elementor-view-framed .feature-box-carousel-wrap:hover .elementor-icon svg, {{WRAPPER}}.elementor-view-default .feature-box-carousel-wrap:hover .elementor-icon svg',
					]
				);
				$this->add_control(
					'litho_hover_primary_color',
					[
						'label' 	=> __( 'Primary Color', 'litho-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-stacked .feature-box-carousel-wrap:hover .elementor-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .feature-box-carousel-wrap:hover .elementor-icon, {{WRAPPER}}.elementor-view-default .feature-box-carousel-wrap:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .feature-box-carousel-wrap:hover .elementor-icon svg'  => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-default .feature-box-carousel-wrap:hover .elementor-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_hover_secondary_color',
					[
						'label'		=> __( 'Secondary Color', 'litho-addons' ),
						'type'		=> Controls_Manager::COLOR,
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-framed .feature-box-carousel-wrap:hover .elementor-icon' 	=> 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .feature-box-carousel-wrap:hover .elementor-icon' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .feature-box-carousel-wrap:hover .elementor-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_feature_icon_image_size',
				[
					'label' 	=> __( 'Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 1,
								'max' => 1000,
						],
						'%' => [
							'max' => 100,
							'min' => 1,
						],
					],
					'default'       => [ 'unit' => '%', 'size' => 100 ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_icon_padding',
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
				'litho_feature_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_overlay_section',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition' 	=> [
						'litho_feature_box_carousel_layout_type' => [ 'feature-box-carousel-style-2' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_feature_overlay_background_color',
					'fields_options'    => [ 'background' => [ 'label' => __( 'Overlay Color', 'litho-addons' ) ] ],
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .feature-box-overlay',
					'condition' 	=> [
						'litho_feature_box_carousel_layout_type' => [ 'feature-box-carousel-style-2' ] // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_carousel_title_style_section',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_title_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap .feature-box-title, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_feature_box_carousel_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .feature-box-carousel-wrap .feature-box-title, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-title',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_title_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 100, 'max' => 500 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap .feature-box-title, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-title' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_title_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap .feature-box-title, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_carousel_digit_style_section',
				[
					'label' 		=> __( 'Digit/Subtitle', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_feature_box_carousel_digit_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .feature-box-carousel-wrap .feature-box-digit, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-digit',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 			=> 'litho_feature_box_carousel_digit_color',
					'selector' 		=> '{{WRAPPER}} .feature-box-carousel-wrap .feature-box-digit, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-digit',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_feature_box_carousel_digit_color_background',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-digit',
					'condition' 	=> [
						'litho_feature_box_carousel_layout_type' => [ 'feature-box-carousel-style-2' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_digit_opacity',
				[
					'label'		=> __( 'Opacity ( Hover )', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 1,
							'min' 	=> 0,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .feature-box-carousel-style-2 .feature-box-carousel-wrap:hover .feature-box-digit' => 'opacity: {{SIZE}};',
					],
					'condition' 	=> [
						'litho_feature_box_carousel_layout_type' => [ 'feature-box-carousel-style-2' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_digit_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-style-2 .feature-box-carousel-content-wrap .feature-box-digit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_feature_box_carousel_layout_type' => [ 'feature-box-carousel-style-2' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_digit_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-digit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_carousel_content_style_section',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_content_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap .feature-box-carousel-content, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-carousel-content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_feature_box_carousel_content_typography',
					'selector' 	=> '{{WRAPPER}} .feature-box-carousel-wrap .feature-box-carousel-content, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-carousel-content',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_content_size',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .feature-box-carousel-wrap .feature-box-carousel-content, {{WRAPPER}} .feature-box-carousel-content-wrap .feature-box-carousel-content' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_carousel_button',
				[
					'label' 			=> __( 'Button', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE
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
					'name' 		=> 'litho_feature_box_carousel_button_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_feature_box_carousel_button_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_carousel_button_style' );
			$this->start_controls_tab(
				'litho_feature_box_carousel_button_normal_style',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_button_text_color',
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
					'name' 				=> 'litho_feature_box_carousel_button_background_color',
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
				'litho_feature_box_carousel_button_border_radius',
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
				'litho_feature_box_carousel_button_hover_style',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_button_hover_text_color',
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
					'name' 				=> 'litho_feature_box_carousel_button_background_hover_color',
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
				'litho_feature_box_carousel_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_feature_box_carousel_button_border_border!' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_feature_box_carousel_button_hover_border_radius',
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
					'name' 			=> 'litho_feature_box_carousel_button_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_feature_box_carousel_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_carousel_button_padding',
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
			$this->add_responsive_control(
				'litho_feature_box_carousel_button_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_navigation',
				[
					'label' 		=> __( 'Navigation', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'dots', 'both' ] ],
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
					],
					'prefix_class' 	=> 'elementor-arrows-position-',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_width',
				[
					'label' 		=> __( 'Box Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'width: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev' => 'height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'height: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next i' => 'font-size: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev' => 'line-height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
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
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev'     => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next'     => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev svg' => 'fill: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next svg' => 'fill: {{VALUE}};',
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
						'label' 		=> __( 'Text Color', 'litho-addons' ),
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
						'selector' 			=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
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
					'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
					'separator'		=> 'before'
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
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 10 ],
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
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 10 ],
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

			$this->end_controls_section();
		}

		/**
		 * Render feature box carousel widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();

			if ( empty( $settings['litho_feature_box_carousel'] ) ) {
				return;
			}

			$slides_count = '';
			$slides       = [];
			$id_int       = substr( $this->get_id_int(), 0, 3 );
			$layou_type   = $this->get_settings( 'litho_feature_box_carousel_layout_type' );
			
			/* Custom Effect */
			$hover_animation_effect_array = litho_custom_hover_animation_effect();
			
			switch ( $layou_type ) {
				case 'feature-box-carousel-style-1':
					foreach ( $settings['litho_feature_box_carousel'] as $index => $item ) {
						
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
						
						if ( ! empty( $item['litho_item_image']['id'] ) ) {

							$srcset_data          = litho_get_image_srcset_sizes( $item['litho_item_image']['id'], $settings['litho_thumbnail_size'] );
							$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_item_image']['id'], 'litho_thumbnail', $settings );
							$litho_item_image_alt = Control_Media::get_image_alt( $item['litho_item_image'] );
							$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );

						} elseif ( ! empty( $item['litho_item_image']['url'] ) ) {

							$litho_item_image_url = $item['litho_item_image']['url'];
							$litho_item_image_alt = '';
							$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
						}
						
						$wrapper_key = 'wrapper_' . $index;
						$this->add_render_attribute( $wrapper_key, [
						   'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$button_key        = 'button_' . $index;
						$link_key          = 'link_' . $index;
						$migrated_btn_icon = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new_btn_icon   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						$this->add_render_attribute( $button_key, 'class', 'elementor-button-wrapper' );

						if ( ! empty( $item['litho_link']['url'] ) ) {
							$this->add_link_attributes( $link_key, $item['litho_link'] );
							$this->add_render_attribute( $link_key, 'class', 'elementor-button-link' );
						}

						$this->add_render_attribute( $link_key, 'class', 'elementor-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $item['litho_size'] ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $item['litho_size'] );
						}

						$custom_animation_class = '';
						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$this->add_render_attribute( $button_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						$this->add_render_attribute( $button_key, 'class', [ $custom_animation_class ] );

						$buttonWrapper = 'content_wrapper_' . $index;
						$buttonIcon    = 'icon_align_' . $index;
						$buttonText    = 'litho_text' . $index;

						$this->add_render_attribute( [
							$buttonWrapper => [
								'class' => 'elementor-button-content-wrapper',
							],
							$buttonIcon => [
								'class' => [
									'elementor-button-icon',
									'elementor-align-icon-' . $settings['litho_icon_align']
								],
							],
							$buttonText => [
								'class' => 'elementor-button-text'
							]
						] );
						
						ob_start();
						?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
								<div class="feature-box-carousel-wrap">
									<div class="feature-carousel-box">
										<?php 
										if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) {
											?>
											<div class="elementor-icon"><?php
												echo filter_var( $item['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon;
											?></div>
										<?php
										}
										if ( ! empty( $item['litho_feature_box_carousel_digit'] ) || ! empty( $item['litho_feature_box_carousel_content'] ) || ! empty( $item['litho_feature_box_carousel_title'] ) ) {
											?>
											<div class="feature-box-carousel-content-wrap">
												<?php
												if ( ! empty( $item['litho_feature_box_carousel_digit'] ) ) {
													?>
													<div class="feature-box-digit"><?php
														echo esc_html( $item['litho_feature_box_carousel_digit'] );
													?></div>
												<?php
												}
												if ( ! empty( $item['litho_feature_box_carousel_title'] ) ) {
													?>
													<div class="feature-box-title"><?php
														echo esc_html( $item['litho_feature_box_carousel_title'] );
													?></div>
												<?php
												}
												if ( ! empty( $item['litho_feature_box_carousel_content'] ) ) {
													?>
													<div class="feature-box-carousel-content"><?php
														printf( '%s', wp_kses_post( $item['litho_feature_box_carousel_content'] ) );
													?></div>
												<?php
												}
												?>
											</div>
											<?php
										}
										if ( $item['litho_button_text'] ) { ?>
											<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
												<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore ?>>
													<span <?php $this->print_render_attribute_string( $buttonWrapper ); // phpcs:ignore ?>>
														<?php
														if ( ! empty( $item['icon'] ) || ! empty( $item['litho_selected_icon']['value'] ) ) :
														?>
														<span <?php $this->print_render_attribute_string( $buttonIcon ); // phpcs:ignore ?>>
															<?php
															if ( $is_new_btn_icon || $migrated_btn_icon ) {
																Icons_Manager::render_icon( $item['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
															?>
																<i class="<?php echo esc_attr( $item['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
															<?php
															}
															?>
														</span>
														<?php
														endif;
														?>
														<span <?php $this->print_render_attribute_string( $buttonText ); // phpcs:ignore ?>><?php
															echo esc_html( $item['litho_button_text'] );
														?></span>
													</span>
												</a>
											</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						<?php 
						$slides[] = ob_get_contents();
						ob_end_clean();
					}
					break;
				case 'feature-box-carousel-style-2':
					foreach ( $settings['litho_feature_box_carousel'] as $index => $item ) {
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

						if ( ! empty( $item['litho_item_image']['id'] ) ) {
							$srcset_data          = litho_get_image_srcset_sizes( $item['litho_item_image']['id'], $settings['litho_thumbnail_size'] );
							$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_item_image']['id'], 'litho_thumbnail', $settings );
							$litho_item_image_alt = Control_Media::get_image_alt( $item['litho_item_image'] );
							$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );
						} elseif ( ! empty( $item['litho_item_image']['url'] ) ) {
							$litho_item_image_url = $item['litho_item_image']['url'];
							$litho_item_image_alt = '';
							$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
						}

						$wrapper_key = 'wrapper_' . $index;
						$this->add_render_attribute( $wrapper_key, [
						   'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
						] );

						$button_key        = 'button_' . $index;
						$link_key          = 'link_' . $index;
						$migrated_btn_icon = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new_btn_icon   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

						$this->add_render_attribute( $button_key, 'class', 'elementor-button-wrapper' );

						if ( ! empty( $item['litho_link']['url'] ) ) {

							$this->add_link_attributes( $link_key, $item['litho_link'] );
							$this->add_render_attribute( $link_key, 'class', 'elementor-button-link' );
						}

						$this->add_render_attribute( $link_key, 'class', 'elementor-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $item['litho_size'] ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $item['litho_size'] );
						}

						$custom_animation_class = '';
						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$this->add_render_attribute( $button_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}
						
						$this->add_render_attribute( $button_key, 'class', [ $custom_animation_class ] );

						$buttonWrapper = 'content_wrapper_' . $index;
						$buttonIcon    = 'icon_align_' . $index;
						$buttonText    = 'litho_text' . $index;

						$this->add_render_attribute( [
							$buttonWrapper => [
								'class' => 'elementor-button-content-wrapper',
							],
							$buttonIcon => [
								'class' => [
									'elementor-button-icon',
									'elementor-align-icon-' . $settings['litho_icon_align']
								]
							],
							$buttonText => [
								'class' => 'elementor-button-text'
							]
						] );

						ob_start();
						?>
							<div <?php $this->print_render_attribute_string( $wrapper_key ); // phpcs:ignore ?>>
								<div class="feature-box-carousel-wrap">
									<div class="feature-carousel-box">
										<div class="feature-box-overlay"></div>
										<?php
										if ( ! empty( $item['litho_feature_box_carousel_digit'] ) || ! empty( $item['litho_feature_box_carousel_content'] ) || ! empty( $item['litho_feature_box_carousel_title'] ) || ! empty( $item['litho_button_text'] ) ) {
											?>
											<div class="feature-box-carousel-content-wrap">
												<?php
												if ( ! empty( $item['litho_feature_box_carousel_digit'] ) ) {
												?>
													<div class="feature-box-digit"><?php
														echo esc_html( $item['litho_feature_box_carousel_digit'] );
													?></div>
												<?php
												}
												if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) {
												?>
													<div class="elementor-icon">
														<?php echo filter_var( $item['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; ?>
													</div>
												<?php
												}
												if ( ! empty( $item['litho_feature_box_carousel_title'] ) ) {
												?>
													<div class="feature-box-title"><?php 
														echo esc_html( $item['litho_feature_box_carousel_title'] );
													?></div>
												<?php
												}
												if ( ! empty( $item['litho_feature_box_carousel_content'] ) ) {
												?>
													<div class="feature-box-carousel-content"><?php
														printf( '%s', wp_kses_post( $item['litho_feature_box_carousel_content'] ) );
													?></div>
												<?php
												}
												if ( ! empty( $item['litho_button_text'] ) ) {
													?>
													<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
														<a <?php $this->print_render_attribute_string( $link_key ); // phpcs:ignore ?>>
															<span <?php $this->print_render_attribute_string( $buttonWrapper ); // phpcs:ignore ?>>
																<?php
																if ( ! empty( $item['icon'] ) || ! empty( $item['litho_selected_icon']['value'] ) ) :
																	?>
																<span <?php $this->print_render_attribute_string( $buttonIcon ); // phpcs:ignore ?>>
																	<?php
																	if ( $is_new_btn_icon || $migrated_btn_icon ) {
																		Icons_Manager::render_icon( $item['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
																	} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
																		?>
																		<i class="<?php echo esc_attr( $item['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i>
																	<?php
																	}
																	?>
																</span>
																<?php
																endif;
																?>
																<span <?php $this->print_render_attribute_string( $buttonText ); // phpcs:ignore ?>><?php
																	echo esc_html( $item['litho_button_text'] );
																?></span>
															</span>
														</a>
													</div>
												<?php
												}
												?>
											</div>
										<?php
										}
										?>
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

			$slides_count        = count( $settings['litho_feature_box_carousel'] );
			$litho_rtl           = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor = $this->get_settings( 'litho_slider_cursor' );
			$litho_navigation    = $this->get_settings( 'litho_navigation' );

			$dataSettings = array(
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

			$this->add_render_attribute( [
				'carousel' => [
					'class' => 'elementor-content-carousel swiper-wrapper',
				],
				'carousel-wrapper' => [
					'class'         => [
						'elementor-feature-box-carousel-wrapper',
						'swiper',
						$layou_type,
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

			if ( 'yes' === $this->get_settings( 'litho_image_stretch' ) ) {
				$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
			}

			if ( 'feature-box-carousel-style-1' === $layou_type || 'feature-box-carousel-style-2' === $layou_type ) {
				if ( ! empty( $settings['litho_feature_box_carousel_subheading'] ) || ! empty( $settings['litho_feature_box_carousel_heading'] ) || ! empty( $settings['litho_feature_box_carousel_slide_content'] ) ) {
					?>
					<div class="carousel-title-box">
						<?php
						if ( ! empty( $settings['litho_feature_box_carousel_subheading'] ) ) {
							?>
							<div class="subheading"><?php
								echo esc_html( $settings['litho_feature_box_carousel_subheading'] );
							?></div>
							<?php
						}

						if ( ! empty( $settings['litho_feature_box_carousel_heading'] ) ) {
							?>
							<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="heading"><?php // phpcs:ignore ?>
							<?php
								echo esc_html( $settings['litho_feature_box_carousel_heading'] );
							?></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore ?>
							<?php
						}

						if ( ! empty( $settings['litho_feature_box_carousel_slide_content'] ) ) {
							?>
							<div class="carousel-content-box"><?php
								printf( '%s', wp_kses_post( $settings['litho_feature_box_carousel_slide_content'] ) );
							?></div>
						<?php
						}
						?>
					</div>
					<?php
				}
				?>
				<div class="feature-box-carousel-content-box">
				<?php
			}
			?>
			<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); // phpcs:ignore ?>>
				<div <?php $this->print_render_attribute_string( 'carousel' ); // phpcs:ignore ?>><?php
					echo implode( '', $slides );
				?></div>
				<?php
				if ( 1 < $slides_count ) {
					if ( $show_dots ) {
						?>
						<div class="swiper-pagination"></div>
					<?php
					}
					if ( $show_arrows ) {
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
							<span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'litho-addons' ); ?></span>
						</div>
						<div class="elementor-swiper-button elementor-swiper-button-next">
							<?php 
							if ( ! empty( $right_arrow_icon ) ) {
								echo sprintf( '%s', $right_arrow_icon ); // phpcs:ignore
							} else {
							?>
								<i class="eicon-chevron-right" aria-hidden="true"></i>
							<?php
							}
							?>	
							<span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'litho-addons' ); ?></span>
						</div>
					<?php
					}
				}
				?>
			</div>
			<?php
			if ( 'feature-box-carousel-style-1' === $layou_type || 'feature-box-carousel-style-2' === $layou_type ) {
				?>
				</div>
			<?php
			}
		}
	}
}
