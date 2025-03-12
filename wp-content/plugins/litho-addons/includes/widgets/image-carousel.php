<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for image carousel.
 *
* @package Litho
 */

// If class `Image_Carousel` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Image_Carousel' ) ) {

	class Image_Carousel extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve image carousel widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-image-carousel';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve image carousel widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Image Carousel', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve image carousel widget icon.
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
			return [ 'image', 'photo', 'visual', 'carousel', 'slider' ];
		}

		/**
		 * Register image carousel widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			$this->start_controls_section(
				'litho_section_image_carousel',
				[
					'label' 	=> __( 'Image Carousel', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_carousel',
				[
					'label' 		=> __( 'Add Images', 'litho-addons' ),
					'type' 			=> Controls_Manager::GALLERY,
					'default' 		=> [],
					'show_label' 	=> false,
					'dynamic' 		=> [
						'active' 	=> true,
					],
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default'		=> 'full',
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
					'default'		=> 1,
					'options' 		=> [
						''				 => __( 'Default', 'litho-addons' ),
						'auto'			 => __( 'Auto', 'litho-addons' ),
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
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'no',
					'options' 		=> [
						'no' 			=> __( 'No', 'litho-addons' ),
						'yes'	 		=> __( 'Yes', 'litho-addons' ),
					],
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
						'none' 			=> __( 'None', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_link_to',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'none',
					'options' 		=> [
						'none' 			=> __( 'None', 'litho-addons' ),
						'file' 			=> __( 'Media File', 'litho-addons' ),
						'custom' 		=> __( 'Custom URL', 'litho-addons' ),
					],
				]
			);

			$this->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic'       => [
						'active' => true,
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'condition' 	=> [
						'litho_link_to' 	=> 'custom',
					],
					'show_label' 	=> false,
				]
			);

			$this->add_control(
				'litho_open_lightbox',
				[
					'label' 		=> __( 'Lightbox', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'no',
					'options' 		=> [
						'yes' 			=> __( 'Yes', 'litho-addons' ),
						'no' 			=> __( 'No', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_link_to' 		=> 'file',
					],
				]
			);

			$this->add_control(
				'litho_caption_type',
				[
					'label' 		=> __( 'Caption', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> '',
					'options' 		=> [
						'' 				=> __( 'None', 'litho-addons' ),
						'title' 		=> __( 'Title', 'litho-addons' ),
						'caption'	 	=> __( 'Caption', 'litho-addons' ),
						'description' 	=> __( 'Description', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::HIDDEN,
					'default' 		=> 'traditional',
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
			$this->add_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_additional_options',
				[
					'label' 		=> __( 'Additional Options', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_autoplay',
				[
					'label' 		=> __( 'Autoplay', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'yes',
					'options' 		=> [
						'yes' 			=> __( 'Yes', 'litho-addons' ),
						'no' 			=> __( 'No', 'litho-addons' ),
					],
				]
			);

			$this->add_control(
				'litho_centeredslides',
				[
					'label' 		=> __( 'Centered Slides', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'no',
					'options' 		=> [
						'yes' 			=> __( 'Yes', 'litho-addons' ),
						'no' 			=> __( 'No', 'litho-addons' ),
					],
				]
			);
			
			$this->add_control(
				'litho_slide_width_auto',
				[
					'label' 		=> __( 'Slide Auto Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_off' 	=> __( 'No', 'litho-addons' ),
		            'label_on' 		=> __( 'Yes', 'litho-addons' ),
		            'default'		=> '',
		            'return_value' 	=> 'slider-width-auto',
					'condition' => [
						//'litho_centeredslides!'	=> [ 'yes' ],
						'litho_slides_to_show'		=> [ 'auto' ],
					],
				]
			);

			$this->add_responsive_control(
				'litho_slide_width',
				[
					'label' 		=> __( 'Slide Width', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 1,
								'max' => 1000,
						],
						'%' => [
							'max' => 100,
							'min' => 0,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .swiper-slide' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						//'litho_centeredslides' => [ 'yes' ],
						'litho_slides_to_show' => [ 'auto' ],
					],
				]
			);
			
			$this->add_control(
				'litho_slide_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide-inner' => 'padding: 0 {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 
						'litho_centeredslides' => [ 'yes' ],
						'litho_slides_to_show' => [ 'auto' ],
					],
				]
			);

			$this->add_control(
				'litho_pause_on_hover',
				[
					'label' 		=> __( 'Pause on Hover', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'yes',
					'options' 		=> [
						'yes' 			=> __( 'Yes', 'litho-addons' ),
						'no' 			=> __( 'No', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_autoplay' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'litho_pause_on_interaction',
				[
					'label' 		=> __( 'Pause on Interaction', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'	 	=> 'yes',
					'options' 		=> [
						'yes' 			=> __( 'Yes', 'litho-addons' ),
						'no' 			=> __( 'No', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_autoplay' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'litho_autoplay_speed',
				[
					'label' 		=> __( 'Autoplay Speed', 'litho-addons' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 5000,
					'condition' 	=> [
						'litho_autoplay' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'litho_infinite',
				[
					'label' => __( 'Infinite Loop', 'litho-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'litho-addons' ),
						'no' => __( 'No', 'litho-addons' ),
					],
				]
			);

			$this->add_control(
				'litho_effect',
				[
					'label' => __( 'Effect', 'litho-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'slide',
					'options' => [
						'slide'	=> __( 'Slide', 'litho-addons' ),
						'fade'	=> __( 'Fade', 'litho-addons' ),
					],
					/*'condition' => [
						'litho_slides_to_show' => '1',
					],*/
				]
			);

			$this->add_control(
				'litho_speed',
				[
					'label' => __( 'Animation Speed', 'litho-addons' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 500,
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
				'litho_section_style_general',
				[
					'label' => __( 'General', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_carousel_box_border',
					'selector'      => '{{WRAPPER}} .elementor-images-carousel-wrapper',
					'separator' 	=> 'before',
				]
			);
			$this->add_control(
				'litho_carousel_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::DIMENSIONS,                 
					'selectors' => [
						'{{WRAPPER}} .elementor-images-carousel-wrapper' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_carousel_box_shadow',
					'selector'      => '{{WRAPPER}} .elementor-images-carousel-wrapper',
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
				]
			);

			$this->add_responsive_control(
				'litho_slide_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'placeholder'   => [
						'top'       => 'auto',
						'right'     => '',
						'bottom'    => 'auto',
						'left'      => '',
					],
					'selectors'     => [
						'{{WRAPPER}} .swiper-slide .swiper-slide-inner' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
					],
					'allowed_dimensions' => 'horizontal'
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_image',
				[
					'label' => __( 'Image', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'litho_gallery_vertical_align',
				[
					'label' 		=> __( 'Vertical Align', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'flex-start' => [
							'title' 	=> __( 'Start', 'litho-addons' ),
							'icon' 		=> 'eicon-v-align-top',
						],
						'center' 	=> [
							'title' 	=> __( 'Center', 'litho-addons' ),
							'icon' 		=> 'eicon-v-align-middle',
						],
						'flex-end' => [
							'title' 	=> __( 'End', 'litho-addons' ),
							'icon' 		=> 'eicon-v-align-bottom',
						],
					],
					'condition' 	=> [
						'litho_slides_to_show!' => '1',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-wrapper' => 'display: flex; align-items: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'litho_image_border',
					'selector' 	=> '{{WRAPPER}} .elementor-images-carousel-wrapper .elementor-images-carousel .swiper-slide-image',
				]
			);

			$this->add_control(
				'litho_image_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::DIMENSIONS,
					'size_units'=> [ 'px', '%', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .elementor-images-carousel-wrapper .elementor-images-carousel .swiper-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_caption',
				[
					'label' 	=> __( 'Caption', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
					'condition' => [
						'litho_caption_type!' => '',
					],
				]
			);

			$this->add_control(
				'litho_caption_align',
				[
					'label' 	=> __( 'Alignment', 'litho-addons' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-justify',
						],
					],
					'default' 	=> 'center',
					'selectors' => [
						'{{WRAPPER}} .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'litho_caption_text_color',
				[
					'label' 	=> __( 'Text Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .elementor-image-carousel-caption' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_caption_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .elementor-image-carousel-caption',
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
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev i'   => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next i'   => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
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
					'name'          => 'litho_arrows_box_shadow',
					'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
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
		 * Render image carousel widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();

			if ( empty( $settings['litho_carousel'] ) ) {
				return;
			}

			$slides                 = [];
			$left_arrow_icon        = '';
			$right_arrow_icon       = '';
			$litho_slide_width_auto = $this->get_settings( 'litho_slide_width_auto' );
			$left_icon_migrated     = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
			$right_icon_migrated    = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );
			$is_new                 = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			foreach ( $settings['litho_carousel'] as $index => $attachment ) {
				
				$link_tag   = '';
				$image_html = '';
				
				if ( ! empty( $attachment['id'] ) ) {

					$srcset_data          = litho_get_image_srcset_sizes( $attachment['id'], $settings['litho_thumbnail_size'] );
					$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'litho_thumbnail', $settings );
					$litho_item_image_alt = Control_Media::get_image_alt( $attachment['id'] );
					$image_html           = sprintf( '<img src="%1$s" alt="%2$s" class="swiper-slide-image" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );
				}

				$link = $this->get_link_url( $attachment, $settings );
				if ( $link ) {
					$link_key = 'link_' . $index;

					$this->add_render_attribute( $link_key, [
						'data-elementor-open-lightbox' => 'no',
					] );

					$this->add_link_attributes( $link_key, $link );

					if ( 'file' === $settings['litho_link_to'] && 'yes' === $settings['litho_open_lightbox'] ) {

						$this->add_render_attribute( $link_key, [
							'data-group' => $this->get_id(),
							'class'      => 'lightbox-group-gallery-item',
						] );

						$litho_image_title_lightbox_popup   = get_theme_mod( 'litho_image_title_lightbox_popup', '0' );
						$litho_image_caption_lightbox_popup = get_theme_mod( 'litho_image_caption_lightbox_popup', '0' );

						if ( 1 == $litho_image_title_lightbox_popup ) {
							$litho_attachment_title = get_the_title( $attachment['id'] );
							if ( ! empty( $litho_attachment_title ) ) {
								$this->add_render_attribute( $link_key, [
									'title'	=> $litho_attachment_title,
								] );
							}
						}

						if ( 1 == $litho_image_caption_lightbox_popup ) {
							$litho_lightbox_caption = wp_get_attachment_caption( $attachment['id'] );
							if ( ! empty( $litho_lightbox_caption ) ) {
								$this->add_render_attribute( $link_key, [
									'data-lightbox-caption' => $litho_lightbox_caption,
								] );
							}
						}
					}
					$link_tag = '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
				}

				$image_caption = $this->get_image_caption( $attachment );

				$slide_html = '<div class="swiper-slide '.esc_attr( $litho_slide_width_auto ).'">' . $link_tag . '<figure class="swiper-slide-inner">' . $image_html; // phpcs:ignore

				if ( ! empty( $image_caption ) ) {
					$slide_html .= '<figcaption class="elementor-image-carousel-caption">' . $image_caption . '</figcaption>';
				}

				$slide_html .= '</figure>';

				if ( $link ) {
					$slide_html .= '</a>';
				}

				$slide_html .= '</div>';

				$slides[] = $slide_html;
			}

			if ( empty( $slides ) ) {
				return;
			}
			
			$slides_count        = count( $settings['litho_carousel'] );
			$litho_rtl           = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor = $this->get_settings( 'litho_slider_cursor' );
			$litho_navigation    = $this->get_settings( 'litho_navigation' );

			$dataSettings = array(
				'navigation'            => $this->get_settings( 'litho_navigation' ),
				'autoplay'              => $this->get_settings( 'litho_autoplay' ),
				'centered_slides'       => $this->get_settings( 'litho_centeredslides' ),
				'autoplay_speed'        => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover'        => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'                  => $this->get_settings( 'litho_infinite' ),
				'effect'                => $this->get_settings( 'litho_effect' ),
				'speed'                 => $this->get_settings( 'litho_speed' ),
				'image_spacing'         => $this->get_settings( 'litho_items_spacing' ),
				'slides_to_show'        => $this->get_settings( 'litho_slides_to_show' ),
				'slides_to_show_mobile' => $this->get_settings( 'litho_slides_to_show_mobile' ),
				'slides_to_show_tablet' => $this->get_settings( 'litho_slides_to_show_tablet' ),
				'slides_count'          => $slides_count,
			);

			$this->add_render_attribute( [
				'carousel-wrapper' => [
					'class' => [ 'elementor-images-carousel-wrapper', 'swiper', $litho_slider_cursor ],
					'data-settings' => json_encode( $dataSettings ),
				],
				'carousel' => [
					'class' => 'elementor-images-carousel swiper-wrapper',
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
			<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); // phpcs:ignore ?>>
				<div <?php $this->print_render_attribute_string( 'carousel' );  // phpcs:ignore ?>>
					<?php echo implode( '', $slides ); ?>
				</div>
				<?php if ( 1 < $slides_count ) : ?>
					<?php if ( $show_dots ) : ?>
						<div class="swiper-pagination"></div>
					<?php endif; ?>
					<?php if ( $show_arrows ) : ?>
						<div class="elementor-swiper-button elementor-swiper-button-prev elementor-icon">
							<?php if ( ! empty( $left_arrow_icon ) ) {
								echo sprintf( '%s', $left_arrow_icon ); // phpcs:ignore
							} else { ?>
								<i class="eicon-chevron-left" aria-hidden="true"></i>
							<?php } ?>
							<span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'litho-addons' ); ?></span>
						</div>
						<div class="elementor-swiper-button elementor-swiper-button-next elementor-icon">
							<?php if ( ! empty( $right_arrow_icon ) ) {
								echo sprintf( '%s', $right_arrow_icon ); // phpcs:ignore
							} else { ?>
								<i class="eicon-chevron-right" aria-hidden="true"></i>
							<?php } ?>
							<span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'litho-addons' ); ?></span>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php
		}

		/**
		 * Retrieve image carousel link URL.
		 *
		 *
		 * @access private
		 *
		 * @param array $attachment
		 * @param object $instance
		 *
		 * @return array|string|false An array/string containing the attachment URL, or false if no link.
		 */
		private function get_link_url( $attachment, $instance ) {
			if ( 'none' === $instance['litho_link_to'] ) {
				return false;
			}

			if ( 'custom' === $instance['litho_link_to'] ) {
				if ( empty( $instance['litho_link']['url'] ) ) {
					return false;
				}

				return $instance['litho_link'];
			}

			return [
				'url' => wp_get_attachment_url( $attachment['id'] ),
			];
		}

		/**
		 * Retrieve image carousel caption.
		 *
		 *
		 * @access private
		 *
		 * @param array $attachment
		 *
		 * @return string The caption of the image.
		 */
		private function get_image_caption( $attachment ) {
			
			$caption_type = $this->get_settings_for_display( 'litho_caption_type' );

			if ( empty( $caption_type ) ) {
				return '';
			}

			$attachment_post = get_post( $attachment['id'] );

			if ( 'caption' === $caption_type ) {
				return $attachment_post->post_excerpt;
			}

			if ( 'title' === $caption_type ) {
				return $attachment_post->post_title;
			}

			return $attachment_post->post_content;
		}
	}
}
