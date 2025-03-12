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

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for package carousel.
 *
* @package Litho
 */

// If class `Package_Carousel` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Package_Carousel' ) ) {

	class Package_Carousel extends Widget_Base {

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
			return 'litho-package-carousel';
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
			return __( 'Litho Package Carousel', 'litho-addons' );
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
		 * Retrieve the list of scripts the package carousel widget depended on.
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
			return [ 'image', 'slide', 'package', 'tour', 'holiday' ];
		}
		
		/**
		 * Register package carousel widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_package_carousel_content_section',
				[
					'label'			=> __( 'Slides', 'litho-addons' ),
				]
			);

			$repeater = new Repeater();
			$repeater->start_controls_tabs( 'litho_package_carousel_tabs' );
				$repeater->start_controls_tab( 'litho_package_carousel_image_tab', [ 'label' => __( 'Image', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_package_carousel_image',
						[
							'label' 		=> __( 'Image', 'litho-addons' ),
							'type' 			=> Controls_Manager::MEDIA,
							'dynamic'  	 	=> [
								'active' => true,
							],
							'default' 		=> [
								'url' 		=> Utils::get_placeholder_image_src(),
							],
						]
					);
					$repeater->add_control(
						'litho_package_carousel_caption',
						[
							'label' 		=> __( 'Caption', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'label_block' 	=> true,
						]
					);
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_package_carousel_content_tab', [ 'label' => __( 'Content', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_package_carousel_title',
						[
							'label' 		=> __( 'Title', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_package_carousel_title_link',
						[
							'label'         => __( 'Link', 'litho-addons' ),
							'type'          => Controls_Manager::URL,
							'dynamic'       => [
								'active' => true,
							],
							'placeholder'   => __( 'https://your-link.com', 'litho-addons' ),
							'default'       => [
								'url'       => '#',
							],
							'condition'     => [ 'litho_package_carousel_title!' => '' ],
						]
					);
					$repeater->add_control(
						'litho_package_carousel_subtitle',
						[
							'label' 		=> __( 'Subtitle', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_package_carousel_content',
						[
							'label' 		=> __( 'Content', 'litho-addons' ),
							'type' 			=> Controls_Manager::WYSIWYG,
							'dynamic'       => [
								'active' => true,
							],
							'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Sed do eiusmod tem', 'litho-addons' ),
						]
					);
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_package_carousel_icon_tab', [ 'label' => __( 'Icon', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_package_carousel_review_icon' ,
						[
							'label'        	=> __( 'Review', 'litho-addons' ),
							'type'         	=> Controls_Manager::SELECT,
							'default'		=> 1,
							'options' 		=> [
								'1' 		=> __( '1 Star', 'litho-addons' ),
								'2' 		=> __( '2 Star', 'litho-addons' ),
								'3' 		=> __( '3 Star', 'litho-addons' ),
								'4' 		=> __( '4 Star', 'litho-addons' ),
								'5' 		=> __( '5 Star', 'litho-addons' ),
							],
							'render_type' 	=> 'template',
						]
					);
					$repeater->add_control(
						'litho_package_carousel_review_text',
						[
							'label' 		=> __( 'Review Text', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'label_block' 	=> true,
						]
					);
				$repeater->end_controls_tab();
			$repeater->end_controls_tabs();
			$this->add_control(
				'litho_package_carousel',
				[
					'label' 		=> __( 'Carousel Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_package_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_package_carousel_caption'		=> __( 'From $350', 'litho-addons' ),
							'litho_package_carousel_title'			=> __( 'Add title here', 'litho-addons' ),
							'litho_package_carousel_subtitle'		=> __( 'Add subtitle', 'litho-addons' ),
							'litho_package_carousel_content' 		=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt.', 'litho-addons' ),
							'litho_package_carousel_review_icon'	=> 5,
							'litho_package_carousel_review_text'	=> __( '20 Reviews', 'litho-addons' ),
						],
						[
							'litho_package_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_package_carousel_caption'		=> __( 'From $250', 'litho-addons' ),
							'litho_package_carousel_title'			=> __( 'Add title here', 'litho-addons' ),
							'litho_package_carousel_subtitle'		=> __( 'Add subtitle', 'litho-addons' ),
							'litho_package_carousel_content' 		=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt.', 'litho-addons' ),
							'litho_package_carousel_review_icon'	=> 4,
							'litho_package_carousel_review_text'	=> __( '18 Reviews', 'litho-addons' ),
						],
						[
							'litho_package_carousel_image' 		=> Utils::get_placeholder_image_src(),
							'litho_package_carousel_caption'		=> __( 'From $700', 'litho-addons' ),
							'litho_package_carousel_title'			=> __( 'Add title here', 'litho-addons' ),
							'litho_package_carousel_subtitle'		=> __( 'Add subtitle', 'litho-addons' ),
							'litho_package_carousel_content' 		=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit, do eiusmod tempor incididunt.', 'litho-addons' ),
							'litho_package_carousel_review_icon'	=> 5,
							'litho_package_carousel_review_text'	=> __( '05 Reviews', 'litho-addons' ),
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
				'litho_package_carousel_settings_section',
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
				'litho_separator_line',
				[
					'label'      	=> __( 'Separator', 'litho-addons' ),
					'type'       	=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'return_value'  => 'yes',
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
				'litho_package_carousel_genaral_style_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_package_carousel_background',
					'selector' 		=> '{{WRAPPER}} .packages-content-wrap',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_package_carousel_shadow',
					'selector' 		=> '{{WRAPPER}} .packages-content-wrap',
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_aligment',
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
						'{{WRAPPER}} .packages-content-wrap'	=> 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_package_carousel_border',
					'selector'    	=> '{{WRAPPER}} .packages-content-wrap',
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_package_carousel_image_style_section',
				[
					'label' 		=> __( 'Image & Caption', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_image_size',
				[
					'label'      	=> __( 'Image Size', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-image-box img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_image_spacing',
				[
					'label'      	=> __( 'Bottom Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-image-box img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_package_carousel_image_border',
					'selector'    	=> '{{WRAPPER}} .packages-image-box img',
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_image_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-image-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_heading_style_caption',
				[
					'label' 		=> __( 'Caption', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_package_carousel_caption_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .packages-image-box .caption' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'litho_package_carousel_caption_typography',
					'global' 		=> [
							'default' 	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 		=> '{{WRAPPER}} .packages-image-box .caption',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_package_carousel_caption_background_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .packages-image-box .caption'
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_caption_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-image-box .caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_package_carousel_title_style_section',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_package_carousel_title_typography',
					'global' 	=> [
						'default' 	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .packages-content-wrap .title',
				]
			);
			$this->add_control(
				'litho_package_carousel_title_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .packages-content-wrap .title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->start_controls_tabs( 'litho_tabs_title_style' );
				$this->start_controls_tab( 'litho_tab_title_normal', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_package_carousel_title_color',
						'selector' 	=> '{{WRAPPER}} .packages-content-wrap .title',
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_tab_title_hover', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_package_carousel_title_color_hover',
						'selector' 	=> '{{WRAPPER}} .packages-content-wrap a > .title:hover',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_package_carousel_subtitle_style_section',
				[
					'label' 		=> __( 'Subtitle', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_package_carousel_subtitle_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .packages-content-wrap .subtitle' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_package_carousel_subtitle_typography',
					'global' 	=> [
						'default' 	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .packages-content-wrap .subtitle',
				]
			);
			$this->add_control(
				'litho_package_carousel_subtitle_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .packages-content-wrap .subtitle:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_package_carousel_content_style_section',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_package_carousel_content_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .packages-content-wrap .content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_package_carousel_content_typography',
					'selector' 	=> '{{WRAPPER}} .packages-content-wrap .content',
				]
			);
			$this->add_responsive_control(
				'litho_package_carousel_content_size',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .packages-content-wrap .content' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_package_carousel_content_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .packages-content-wrap .content:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_package_icon',
				[
					'label' => __( 'Icon', 'litho-addons' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 		=> 'litho_package_icon_color',
					'selector' 	=> '{{WRAPPER}} .rounded-icon i:before',
				]
			);
			$this->add_control(
				'litho_package_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .rounded-icon, {{WRAPPER}} .rounded-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_package_icon_line_height',
				[
					'label' 		=> __( 'Line height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .rounded-icon, {{WRAPPER}} .rounded-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_heading_style_review_text',
				[
					'label' 		=> __( 'Caption', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_package_carousel_review_text_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .packages-content-wrap .review-text' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_package_carousel_review_text_typography',
					'global' 	=> [
						'default' 	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .packages-content-wrap .review-text',
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
					'label' 		=> __( 'Arrows style', 'litho-addons' ),
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
						'label' 		=> __( 'Text Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg' => 'fill: {{VALUE}};',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_control(
					'litho_arrows_hover_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover' => 'border-color: {{VALUE}};',
						],
						'condition' 	=> [
							'litho_arrows_box_border!' => '',
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
				$this->add_control(
					'litho_arrows_hover_transition',
					[
						'label'         => __( 'Transition Duration', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'range'         => [
							'px'        => [
								'max'       => 3,
								'step'      => 0.1,
							],
						],
						'render_type'   => 'ui',
						'selectors'     => [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'transition-duration: {{SIZE}}s',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'			=> 'litho_arrows_box_border',
					'selector'		=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					'separator'		=> 'before'
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
					'name'			=> 'litho_arrows_box_shadow',
					'selector'		=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);

			 $this->add_control(
    			'litho_arrows_separator',
    			[
    				'type'      => Controls_Manager::DIVIDER,
    				'style'     => 'thick',
    				'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
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
		 * Render package carousel widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();

			if ( empty( $settings['litho_package_carousel'] ) ) {
				return;
			}

			$slides_count = '';
			$slides       = [];
			$id_int       = substr( $this->get_id_int(), 0, 3 );

			foreach ( $settings['litho_package_carousel'] as $index => $item ) {
				
				$icon        = '';
				$wrapper_key = 'wrapper_' . $index;
				$linkKey     = 'link_' . $index;

				$litho_package_carousel_image = '';
				if ( ! empty( $item['litho_package_carousel_image']['id'] ) ) {
					$srcset_data                      = litho_get_image_srcset_sizes( $item['litho_package_carousel_image']['id'], $settings['litho_thumbnail_size'] );
					$litho_package_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_package_carousel_image']['id'], 'litho_thumbnail', $settings );
					$litho_package_carousel_image_alt = Control_Media::get_image_alt( $item['litho_package_carousel_image'] );
					$litho_package_carousel_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_package_carousel_image_url ), esc_attr( $litho_package_carousel_image_alt ), $srcset_data );

				} elseif ( ! empty( $item['litho_package_carousel_image']['url'] ) ) {
					$litho_package_carousel_image_url = $item['litho_package_carousel_image']['url'];
					$litho_package_carousel_image_alt = '';
					$litho_package_carousel_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_package_carousel_image_url ), esc_attr( $litho_package_carousel_image_alt ) );
				}
				
				$package_carousel_icon_is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
				$package_carousel_icon_migrated = isset( $item['__fa4_migrated']['litho_package_carousel_icon'] );

				if ( isset( $item['package_carousel_icon'] ) ) {
					if ( $package_carousel_icon_is_new || $package_carousel_icon_migrated ) {
						ob_start();
							Icons_Manager::render_icon( $item['litho_package_carousel_icon'], [ 'aria-hidden' => 'true' ] );
						$icon .= ob_get_clean();
					} elseif ( isset( $settings['litho_package_carousel_icon']['value'] ) && ! empty( $settings['litho_package_carousel_icon']['value'] ) ) {
						$icon .= '<i class="' . esc_attr( $item['litho_package_carousel_icon']['value'] ) . '" aria-hidden="true"></i>';
					}
				}

				$this->add_render_attribute( $wrapper_key, [
				   'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide' ],
				] );

				$litho_review_icon = ( isset( $item['litho_package_carousel_review_icon'] ) && ! empty( $item['litho_package_carousel_review_icon'] ) ) ? $item['litho_package_carousel_review_icon'] : '';

				// Link on Title
				if ( ! empty( $item['litho_package_carousel_title_link']['url'] ) ) {

					$this->add_link_attributes( $linkKey, $item['litho_package_carousel_title_link'] );
					$this->add_render_attribute( $linkKey, 'class', 'title-link' );
				}
				// End Link on Title

				ob_start();
					?>
					<div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
						<div class="packages-wrapper">
							<?php if ( ! empty( $litho_package_carousel_image ) ) { ?>
								<div class="packages-image-box">
									<?php echo sprintf( '%s', $litho_package_carousel_image ); // phpcs:ignore ?>
									<?php if ( ! empty( $item['litho_package_carousel_caption'] ) ) { ?>
										<div class="caption"><?php echo esc_html( $item['litho_package_carousel_caption'] ); ?></div>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if ( ! empty( $item['litho_package_carousel_title'] ) || ! empty( $item['litho_package_carousel_subtitle'] ) ) { ?>
								<div class="packages-content-wrap">
									<?php if ( ! empty( $item['litho_package_carousel_subtitle'] ) ) { ?>
										<div class="subtitle"><?php echo esc_html( $item['litho_package_carousel_subtitle'] ); ?></div>
									<?php } ?>
									<?php if ( ! empty( $item['litho_package_carousel_title_link']['url'] ) ) { ?>
										<a <?php $this->print_render_attribute_string( $linkKey ); // phpcs:ignore ?>>
									<?php } ?>
										<?php if ( ! empty( $item['litho_package_carousel_title'] ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"><?php echo esc_html( $item['litho_package_carousel_title'] ); ?></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore ?>
										<?php } ?>
									<?php if ( ! empty( $item['litho_package_carousel_title_link']['url'] ) ) { ?>
										</a>
									<?php } ?>
									<?php if ( ! empty( $item['litho_package_carousel_content'] ) ) { ?>
										<div class="content"><?php echo sprintf( '%s', wp_kses_post( $item['litho_package_carousel_content'] ) ); ?></div>
									<?php } ?>
									<?php if ( ! empty( $litho_review_icon ) ) { ?>
										<span class="rounded-icon">
											<?php for ( $i = 1; $i <= $litho_review_icon; $i++ ) {?><i class="fa-solid fa-star"></i><?php }?>
										</span>
									<?php } ?>
									<?php if ( ! empty( $item['litho_package_carousel_review_text'] ) ) { ?>
										<span class="review-text"><?php echo esc_html( $item['litho_package_carousel_review_text'] ); ?></span>
									<?php } ?>
								</div>
							<?php } ?>
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

			$slides_count        = count( $settings['litho_package_carousel'] );
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
				'slides_count'               => $slides_count,
				'navigation_dynamic_bullets' => $this->get_settings( 'litho_navigation_dynamic_bullets' ),
			);

			$this->add_render_attribute( [
				'carousel' => [
					'class' => 'elementor-package-carousel swiper-wrapper',
				],
				'carousel-wrapper' => [
					'class'         => [ 'elementor-package-carousel-wrapper', 'swiper', 'package-carousel-style-1', $litho_slider_cursor ],
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
			?>
			<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
				<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
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
			<?php
		}
	}
}
