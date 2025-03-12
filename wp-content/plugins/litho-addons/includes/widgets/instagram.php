<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use LithoAddons\Controls\Groups\Column_Group_Control;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Instagram.
 *
 * @package Litho
 */
class Instagram extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'litho-instagram';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Litho Instagram', 'litho-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-instagram-gallery';
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
	 * Register instagram widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'litho_section_instaaccount',
			[
				'label' => __( 'Instagram Account', 'litho-addons' ),
			]
		);
		$this->add_control(
			'litho_access_token',
			[
				'label'	 		=> __( 'Access Token', 'litho-addons' ),
				'type' 			=> Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'	=> true,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'litho_section_instafeed',
			[
				'label' 	=> __( 'Settings', 'litho-addons' ),
			]
		);

		$this->add_control(
			'litho_feed_layout',
			[
				'label' 		=> __( 'Layout', 'litho-addons' ),
				'type'	 		=> Controls_Manager::SELECT,
				'default' 		=> 'grid',
				'options' 		=> [
					'grid'     => __( 'Grid', 'litho-addons' ),
					'carousel' => __( 'Carousel', 'litho-addons' ),
				],
			]
		);

		$this->add_control(
			'litho_no_items_to_show',
			[
				'label' 		=> __( 'No. of items to display', 'litho-addons' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default'  		=> [ 'size' => 5 ],
				'range' 		=> [ 'px' => [ 'min'   => 1, 'max'   => 100, 'step'  => 1 ] ],
				'size_units' 	=> '',
			]
		);

		$this->add_control(
			'litho_icon',
			[
				'label' 		=> __( 'Icon', 'litho-addons' ),
				'type' 			=> Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' 		=> [
					'value' 		=> 'fab fa-instagram',
					'library' 		=> 'fa-brands',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'litho_section_layout_style',
			[
				'label'     => __( 'Grid', 'litho-addons' ),
				'condition' => [ 'litho_feed_layout' => 'grid' ],
			]
		);

		$this->add_control(
			'litho_enable_masonry',
			[
				'label'        => __('Masonry', 'litho-addons'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'litho-addons'),
				'label_off'    => __('No', 'litho-addons'),
				'description'  => __('If yes, a masonry will display in page.', 'litho-addons'),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'litho_feed_layout' => 'grid',
				],
			]
		);

		$this->add_group_control(
			Column_Group_Control::get_type(),
			[
				'name'      => 'litho_column_settings',
				'condition' => [ 'litho_feed_layout' => 'grid' ],
			]
		);

		$this->add_responsive_control(
			'litho_columns_gap',
			[
				'label' 	=> __( 'Columns Gap', 'litho-addons' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size'	=> 10,
				],
				'range' 	=> [
					'px' => [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} ul li.grid-gutter' => 'padding: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();

		// Carousel Slider.
		$this->start_controls_section(
			'litho_section_brand_logo_carousel_setting',
			[
				'label' 		=> __( 'Slider', 'litho-addons' ),
				'condition'	 	=> [ 'litho_feed_layout' => 'carousel' ],
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
					'' 			=> __( 'Default', 'litho-addons' ),
				] + $slides_to_show,
			]
		);
		$this->add_control(
			'litho_image_stretch',
			[
				'label'   => __( 'Image Stretch', 'litho-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
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
				'label' 		=> __( 'Arrows', 'litho-addons' ),
				'condition' => [
					'litho_navigation' => [ 'both', 'arrows' ],
					'litho_feed_layout' => 'carousel',
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
			'litho_section_button_settings',
			[
				'label' 		=> __( 'Button', 'litho-addons' ),
				'condition'	 	=> [ 'litho_feed_layout' => 'carousel' ],
			]
		);

		$this->add_control(
			'litho_button_title',
			[
				'label' 		=> __( 'Title', 'litho-addons' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'dynamic' 		=> [
					'active' 	=> true,
				],
			]
		);

		$this->add_control(
			'litho_button_title_link',
			[
				'label' 		=> __( 'Link', 'litho-addons' ),
				'type' 			=> Controls_Manager::URL,
				'dynamic'       => [
					'active' => true,
				],
				'default' 		=> [
					'url' 		=> '',
				],
				'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'litho_icon_section_style',
			[
				'label' 			=> __( 'Icon', 'litho-addons' ),
				'tab' 				=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'litho_icon_color',
			[
				'label' 		=> __( 'Icon Color', 'litho-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .instagram-feed figure a .insta-counts i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .instagram-feed figure a .insta-counts svg' => 'fill: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'litho_icon_overlay_background_color',
			[
				'label' 		=> __( 'Overlay Color', 'litho-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .instagram-feed figure a .insta-counts'     => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .instagram-feed figure a .insta-counts svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'litho_button_title_section',
			[
				'label' 			=> __( 'Button', 'litho-addons' ),
				'tab' 				=> Controls_Manager::TAB_STYLE,
				'condition' 		=> [
					'litho_button_title!' => '',
					'litho_feed_layout' => 'carousel'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'litho_button_title_typography',
				'selector' 	=> '{{WRAPPER}} .instagram-title span',
			]
		);
		$this->start_controls_tabs( 'litho_button_title_style' );
			$this->start_controls_tab(
				'litho_button_title_normal_style',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
				$this->add_control(
					'litho_button_title_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .instagram-title span' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_button_title_background_color',
					[
						'label' 		=> __( 'Background Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .instagram-title span' => 'background-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_button_title_hover_style',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
				$this->add_control(
					'litho_button_title_hover_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .instagram-title a:hover span' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_button_title_hover_background_color',
					[
						'label' 		=> __( 'Background Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .instagram-title a:hover span' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_button_title_hover_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .instagram-title a:hover span, {{WRAPPER}} .instagram-title a:focus span' => 'border-color: {{VALUE}};',
						],
						'condition' 	=> [
							'litho_button_title_border_border!' => '',
						]
					]
				);
				$this->add_control(
					'litho_button_title_hover_transition',
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
							'{{WRAPPER}} .instagram-title span' => 'transition-duration: {{SIZE}}s',
						],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'litho_button_title_padding',
			[
				'label' 	=> __( 'Padding', 'litho-addons' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
				'size_units'=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .instagram-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'	=> 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'litho_button_title_border',
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .instagram-title span',
			]
		);
		$this->add_responsive_control(
			'litho_button_title_border_radius',
			[
				'label'			=> __( 'Border Radius', 'litho-addons' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'custom' ],
				'selectors'		=> [
					'{{WRAPPER}} .instagram-title span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'litho_button_title_box_shadow',
				'selector' => '{{WRAPPER}} .instagram-title span',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'litho_section_style_navigation',
			[
				'label'     => __( 'Navigation', 'litho-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'litho_navigation' => [ 'arrows', 'dots', 'both' ],
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
					'inside'  => __( 'Inside', 'litho-addons' ),
					'outside' => __( 'Outside', 'litho-addons' ),
					'custom'  => __( 'Custom', 'litho-addons' ),
				],
				'prefix_class' 	=> 'elementor-arrows-position-',
				'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
			]
		);
		$this->add_responsive_control(
			'litho_arrows_custom_position',
			[
				'label'     => __( 'Custom Position', 'litho-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px'   => [ 'min' => -1000, 'max' => 1000 ] ],
				'selectors' => [
					'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'litho_arrows_position' => 'custom',
					'litho_navigation'      => [ 'arrows', 'both' ],
				],
			]
		);
		$this->add_control(
			'litho_arrows_box_width',
			[
				'label'     => __( 'Box Width', 'litho-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
				'selectors' => [
					'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'litho_navigation' => [ 'arrows', 'both' ] ],
			]
		);
		$this->add_control(
			'litho_arrows_box_height',
			[
				'label'     => __( 'Box Height', 'litho-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
				'selectors' => [
					'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'litho_navigation' => [ 'arrows', 'both' ] ],
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
	 * Render instagram widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$litho_access_token      = ! empty( $settings['litho_access_token'] ) ? $settings['litho_access_token'] : '';
		$litho_no_items_to_show  = ! empty( $settings['litho_no_items_to_show']['size'] ) ? $settings['litho_no_items_to_show']['size'] : '';
		$litho_feed_layout       = ! empty( $settings['litho_feed_layout'] ) ? $settings['litho_feed_layout'] : '';
		/* Column Settings */
		$litho_column_class      = array();
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_larger_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_larger_desktop_column' ] : 'grid-3col';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_large_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_large_desktop_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_desktop_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_tablet_column' ] ) ? $settings[ 'litho_column_settings_litho_tablet_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_landscape_phone_column' ] ) ? $settings[ 'litho_column_settings_litho_landscape_phone_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_portrait_phone_column' ] ) ? $settings[ 'litho_column_settings_litho_portrait_phone_column' ] : '';
		$litho_column_class      = array_filter( $litho_column_class );
		$litho_column_class_list = implode( ' ', $litho_column_class );
		/* End Column Settings */		
		$migrated                = isset( $settings['__fa4_migrated']['litho_icon'] );
		$is_new                  = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( $litho_access_token ) {
			$litho_instagram_api_data = wp_remote_get( 'https://graph.instagram.com/me/media?count=-1&fields=media_type,media_url,permalink&limit=' . $litho_no_items_to_show . '&access_token=' . $litho_access_token, array( 'timeout' => 2000 ) );
		
			if ( ! empty( $litho_instagram_api_data ) && ! is_wp_error( $litho_instagram_api_data ) || wp_remote_retrieve_response_code( $litho_instagram_api_data ) === 200 ) {

				$litho_instagram_api_data = json_decode( $litho_instagram_api_data['body'] );

				if ( ! empty( $litho_instagram_api_data->data ) ) {

					if ( $litho_no_items_to_show ) {
						$litho_instagram_api_data->data = array_slice( $litho_instagram_api_data->data, 0, $litho_no_items_to_show, true );
					}

					switch ( $litho_feed_layout ) {
						case 'carousel':
							$litho_button_title    = ! empty( $settings['litho_button_title'] ) ? '<span>' . $settings['litho_button_title'] . '</span>' : '';
							$litho_left_arrow_icon  = '';
							$litho_right_arrow_icon = '';

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
									$litho_right_arrow_icon .= ob_get_clean();
								} elseif ( isset( $settings['litho_right_arrow_icon']['value'] ) && ! empty( $settings['litho_right_arrow_icon']['value'] ) ) {
									$litho_right_arrow_icon .= '<i class="' . esc_attr( $settings['litho_right_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
								}
							}

							$litho_rtl           = $this->get_settings( 'litho_rtl' );
							$litho_slider_cursor = $this->get_settings( 'litho_slider_cursor' );
							$litho_navigation    = $this->get_settings( 'litho_navigation' );

							$dataSettings = array(
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
							);

							$this->add_render_attribute( [
								'carousel' => [
									'class' => 'instagram-feed-carousel swiper-wrapper',
								],
								'carousel-wrapper' => [
									'id'            => 'instagram-feed-' . esc_attr( $this->get_id() ),
									'class'         => [
										'instagram-feed-carousel-wrapper',
										'swiper',
										'instagram-feed',
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

							if ( 'yes' ===  $this->get_settings( 'litho_image_stretch' ) ) {
								$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
							}
							?>
							<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); // phpcs:ignore ?>>
								<div <?php $this->print_render_attribute_string( 'carousel' ); // phpcs:ignore ?>>
									<?php
									$i = 0;
									foreach ( $litho_instagram_api_data->data as $key => $instagram_data ) {
										if ( $i < $litho_no_items_to_show ) {
											if ( 'IMAGE' === $instagram_data->media_type || 'CAROUSEL_ALBUM' === $instagram_data->media_type ) {
												$i++;
												?>
												<div class="swiper-slide">
													<figure>
													<a href="<?php echo esc_url( $instagram_data->permalink ); ?>" target="_blank">
														<img class="insta-image skip-lazy" src="<?php echo esc_url( $instagram_data->media_url ); ?>" alt="" />
														<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_icon']['value'] ) ) : ?>
															<span class="insta-counts">
																<?php if ( $is_new || $migrated ) :
																	Icons_Manager::render_icon( $settings['litho_icon'], [ 'aria-hidden' => 'true' ] );
																else : ?>
																	<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
																<?php endif; ?>
															</span>
														<?php endif; ?>
													</a>
													</figure>
												</div>
												<?php
											}
										}
									}
									?>
								</div>
								<?php
								if ( ! empty( $settings['litho_button_title_link']['url'] ) ) {

									$this->add_link_attributes( 'url', $settings['litho_button_title_link'] );

									$litho_button_title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $litho_button_title );
								}

								if ( ! empty( $litho_button_title ) ) {
									echo sprintf( '<div class="instagram-title">%s</div>', $litho_button_title ); // phpcs:ignore
								}
								?>
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
							
							</div>
							<?php
							break;
						default:
							$this->add_render_attribute(
								[
									'instagram-feed-inner' => [
										'id'    => 'instagram-feed-' . esc_attr( $this->get_id() ),
										'class' => [
											'instagram-feed',
											'grid',
											$litho_column_class_list,
										],
									],
								]
							);

							if ( 'yes' === $settings['litho_enable_masonry'] ) {
								$this->add_render_attribute(
									[
										'instagram-feed-inner' => [
											'class' => [
												'instagram-feed-masonry',
											],
										],
									]
								);
							}
							?>
							<ul <?php $this->print_render_attribute_string( 'instagram-feed-inner' ); // phpcs:ignore ?>>
							<?php
							$i = 0;
							foreach ( $litho_instagram_api_data->data as $key => $instagram_data ) {
								if ( $i < $litho_no_items_to_show ) {
									if ( 'IMAGE' === $instagram_data->media_type || 'CAROUSEL_ALBUM' === $instagram_data->media_type ) {
										if ( 0 === $i && $settings['litho_enable_masonry'] ) {
											echo '<li class="grid-sizer p-0 m-0"></li>';
										}
										$i++;
										?>
										<li class="grid-item grid-gutter">
											<figure>
											<a href="<?php echo esc_url( $instagram_data->permalink ); ?>" target="_blank">
												<img class="insta-image" src="<?php echo esc_url( $instagram_data->media_url ); ?>" alt="<?php echo esc_attr__( 'Instagram Image', 'litho-addons' ); ?>" />
												<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_icon']['value'] ) ) : ?>
													<span class="insta-counts">
														<?php if ( $is_new || $migrated ) :
															Icons_Manager::render_icon( $settings['litho_icon'], [ 'aria-hidden' => 'true' ] );
														else : ?>
															<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
														<?php endif; ?>
													</span>
												<?php endif; ?>
											</a>
											</figure>
										</li>
										<?php
									} elseif ( isset( $instagram_data->media_type ) && 'VIDEO' === $instagram_data->media_type ) {
										?>
										<li class="grid-item grid-gutter">
											<div class="col-video-wrapper">
												<a href="<?php echo esc_url( $instagram_data->permalink ); ?>" target="_blank">
													<video playsinline autoplay muted loop controls>
													<source src="<?php echo esc_url( $instagram_data->media_url ); ?>" />
													<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_icon']['value'] ) ) : ?>
														<span class="insta-counts">
														<?php if ( $is_new || $migrated ) :
															Icons_Manager::render_icon( $settings['litho_icon'], [ 'aria-hidden' => 'true' ] );
														else : ?>
															<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
														<?php endif; ?>
														</span>
													<?php endif; ?>
													</video>
												</a>
											</div>
										</li>
										<?php
									}
								}
							}
							?>
							</ul>
							<?php
							break;
					}
				}
			}
		}
	}
}
