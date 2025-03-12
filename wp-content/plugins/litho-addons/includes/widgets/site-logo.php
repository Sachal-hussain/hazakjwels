<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for site logo.
 *
* @package Litho
 */

// If class `Site_Logo` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Site_Logo' ) ) {
	
	class Site_Logo extends Widget_Base {

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
			return 'litho-site-logo';
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
			return __( 'Litho Site Logo', 'litho-addons' );
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
			return 'eicon-site-logo';
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
			return [ 'litho', 'litho-header' ];
		}

		/**
		 * Register the widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 *
		 * @access protected
		 */

		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_site_logo_content_section',
				[
					'label' 	=> __( 'Site Logo', 'litho-addons' ),
				]
			);
			$this->start_controls_tabs( 'litho_site_logo_content_tabs' );		
				$this->start_controls_tab( 'litho_site_logo_content_tab', [ 'label' => __( 'Logo', 'litho-addons' ) ] );
				$this->add_control(
					'litho_site_logo',
					[
						'label' 		=> __( 'Choose Image', 'litho-addons' ),
						'type' 			=> Controls_Manager::MEDIA,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default' 		=> [
							'url' 		=> Utils::get_placeholder_image_src(),
						],
						'description'	=> __( 'Upload the logo image which will be displayed in the website header.', 'litho-addons' )
					]
				);
				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' 			=> 'litho_site_logo_image_size',
						'default' 		=> 'full',
						'exclude'	=> [ 'custom' ],
						'separator' 	=> 'none',
					]
				);
				$this->add_control(
					'litho_site_logo_ratina_heading',
					[
						'label'         => __( 'Retina Logo', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before', 
					]
				);

				$this->add_control(
					'litho_site_logo_ratina',
					[
						'label' 		=> __( 'Choose Image', 'litho-addons' ),
						'type' 			=> Controls_Manager::MEDIA,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default' 		=> [
							'url' 		=> Utils::get_placeholder_image_src(),
						],
						'description'	=> __( 'Upload the double size logo image which will be displayed in the website header of retina devices.', 'litho-addons' )
					]
				);
				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' 			=> 'litho_site_logo_ratina_image_size',
						'default' 		=> 'full',
						'exclude'	=> [ 'custom' ],
						'separator' 	=> 'none',
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_site_sticky_logo_content_tab',['label' 	=> __( 'Sticky Logo', 'litho-addons' ) ] );
				$this->add_control(
					'litho_site_sticky_logo',
					[
						'label' 		=> __( 'Choose Image', 'litho-addons' ),
						'type' 			=> Controls_Manager::MEDIA,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default' 		=> [
							'url' 		=> Utils::get_placeholder_image_src(),
						],
						'description'	=> __( 'Upload the logo image which will be displayed in the scrolled / sticky header version.', 'litho-addons' )
					]
				);
				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' 			=> 'litho_site_sticky_logo_image_size',
						'default' 		=> 'full',
						'exclude'	=> [ 'custom' ],
						'separator' 	=> 'none',
					]
				);
				$this->add_control(
					'litho_site_sticky_logo_ratina_heading',
					[
						'label'         => __( 'Retina Logo', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before', 
					]
				);

				$this->add_control(
					'litho_site_sticky_logo_ratina',
					[
						'label' 		=> __( 'Choose Image', 'litho-addons' ),
						'type' 			=> Controls_Manager::MEDIA,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default' 		=> [
							'url' 		=> Utils::get_placeholder_image_src(),
						],
						'description'	=> __( 'Upload the logo image which will be displayed in the scrolled / sticky header version of retina devices.', 'litho-addons' )
					]
				);
				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' 			=> 'litho_site_sticky_logo_ratina_image_size',
						'default' 		=> 'full',
						'exclude'	=> [ 'custom' ],
						'separator' 	=> 'none',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_site_mobile_logo_content_section',
				[
					'label' 	=> __( 'Mobile Logo', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_site_mobile_logo',
				[
					'label' 		=> __( 'Choose Image', 'litho-addons' ),
					'type' 			=> Controls_Manager::MEDIA,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'description'	=> __( 'Upload the logo image which will be displayed in the website header.', 'litho-addons' )
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_site_mobile_image_size',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator' 	=> 'none',
				]
			);
			$this->add_control(
				'litho_site_mobile_ratina_heading',
				[
					'label'         => __( 'Retina Logo', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before', 
				]
			);

			$this->add_control(
				'litho_site_mobile_logo_ratina',
				[
					'label' 		=> __( 'Choose Image', 'litho-addons' ),
					'type' 			=> Controls_Manager::MEDIA,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'description'	=> __( 'Upload the logo image which will be displayed in the scrolled / sticky header version of retina devices.', 'litho-addons' )
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_site_mobile_logo_ratina_image_size',
					'default' 		=> 'full',
					'exclude'	    => [ 'custom' ],
					'separator' 	=> 'none',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_site_logo_settings_section',
				[
					'label' 		=> __( 'Settings', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_h1_logo_font_page',
				[
					'label'         => __( 'H1 in logo in front / home page?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
				]
			);

			$this->add_control(
				'litho_enable_link_logo',
				[
					'label'         => __( 'Enable Link on Logo', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_site_logo_style_section',
				[
					'label' 		=> __( 'Logo', 'litho-addons' ),
					'tab'   		=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'litho_site_logo_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'vw', 'custom' ],
					'range' 		=> [
						'%' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
						'px' 		=> [
							'min' 		=> 1,
							'max' 		=> 1000,
						],
						'vw' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .default-logo, {{WRAPPER}} .mobile-logo' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_site_logo_space',
				[
					'label' 		=> __( 'Max Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [
						'%' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
						'px' 		=> [
							'min' 		=> 1,
							'max' 		=> 1000,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .default-logo, {{WRAPPER}} .mobile-logo' => 'max-width: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->add_responsive_control(
				'litho_site_logo_max_height',
				[
					'label' 		=> __( 'Max Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [
						'%' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
						'px' 		=> [
							'min' 		=> 1,
							'max' 		=> 1000,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .default-logo, {{WRAPPER}} .mobile-logo' => 'max-height: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->add_control(
				'litho_site_logo_separator',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
				]
			);

			$this->start_controls_tabs( 'litho_site_logo_style_tabs' );
				$this->start_controls_tab( 'litho_site_logo_style_normal_tab', [ 'label' 	=> __( 'Normal', 'litho-addons' ) ] );
				$this->add_control(
					'litho_site_logo_opacity',
					[
						'label' 		=> __( 'Opacity', 'litho-addons' ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [ 'px' => [ 'max' => 1, 'min' => 0.10, 'step' => 0.01 ] ],
						'selectors' 	=> [
							'{{WRAPPER}} .default-logo'	=> 'opacity: {{SIZE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					[
						'name' 			=> 'litho_site_logo_css_filters',
						'selector' 		=> '{{WRAPPER}} .default-logo',
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_site_logo_style_hover_tab', [ 'label'	=> __( 'Hover', 'litho-addons' ) ] );
				$this->add_control(
					'litho_site_logo_opacity_hover',
					[
						'label' 		=> __( 'Opacity', 'litho-addons' ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [ 'px' => [ 'max' => 1, 'min' => 0.10, 'step' => 0.01 ] ],
						'selectors' 	=> [
							'{{WRAPPER}} .default-logo:hover'	=> 'opacity: {{SIZE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					[
						'name' 			=> 'litho_site_logo_css_filters_hover',
						'selector' 		=> '{{WRAPPER}} .default-logo:hover',
					]
				);
				$this->add_control(
					'litho_site_logo_hover_transition',
					[
						'label' 		=> __( 'Transition Duration', 'litho-addons' ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [ 'px' => [ 'max' => 3, 'step' => 0.1 ] ],
						'selectors' 	=> [
							'{{WRAPPER}} .default-logo' => 'transition-duration: {{SIZE}}s',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_site_logo_border',
					'selector' 		=> '{{WRAPPER}} .default-logo',
					'separator' 	=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_site_logo_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .default-logo'	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_site_logo_box_shadow',
					'exclude' 		=> [
						'box_shadow_position',
					],
					'selector' 		=> '{{WRAPPER}} .default-logo',
				]
			);
			$this->end_controls_section();

			/* Sticky Logo Style */
			$this->start_controls_section(
				'litho_site_sticky_logo_style_section',
				[
					'label' 		=> __( 'Sticky Logo', 'litho-addons' ),
					'tab'   		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_site_sticky_logo_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'vw', 'custom' ],
					'range' 		=> [
						'%' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
						'px' 		=> [
							'min' 		=> 1,
							'max' 		=> 1000,
						],
						'vw' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .alt-logo' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_site_sticky_logo_space',
				[
					'label' 		=> __( 'Max Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 1,
							'max' 		=> 1000,
						],
						'%' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .alt-logo' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_site_sticky_logo_max_height',
				[
					'label' 		=> __( 'Max Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [
						'%' 		=> [
							'min' 		=> 1,
							'max' 		=> 100,
						],
						'px' 		=> [
							'min' 		=> 1,
							'max' 		=> 1000,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .alt-logo' => 'max-height: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->add_control(
				'litho_site_sticky_logo_separator',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
				]
			);

			$this->start_controls_tabs( 'litho_site_sticky_logo_style_tabs' );
				$this->start_controls_tab( 'litho_site_sticky_logo_style_normal_tab', [ 'label' 	=> __( 'Normal', 'litho-addons' ) ] );
				$this->add_control(
					'litho_site_sticky_logo_opacity',
					[
						'label' 		=> __( 'Opacity', 'litho-addons' ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [ 'px' => [ 'max' => 1, 'min' => 0.10, 'step' => 0.01 ] ],
						'selectors' 	=> [
							'{{WRAPPER}} .alt-logo'	=> 'opacity: {{SIZE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					[
						'name' 			=> 'litho_site_sticky_logo_css_filters',
						'selector' 		=> '{{WRAPPER}} .alt-logo',
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_site_sticky_logo_style_hover_tab', [ 'label' 	=> __( 'Hover', 'litho-addons' ) ] );
				$this->add_control(
					'litho_site_sticky_logo_opacity_hover',
					[
						'label' 		=> __( 'Opacity', 'litho-addons' ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [ 'px' => [ 'max' => 1, 'min' => 0.10, 'step' => 0.01 ] ],
						'selectors' 	=> [
							'{{WRAPPER}} .alt-logo:hover'	=> 'opacity: {{SIZE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					[
						'name' 			=> 'litho_site_sticky_logo_css_filters_hover',
						'selector' 		=> '{{WRAPPER}} .alt-logo:hover',
					]
				);
				$this->add_control(
					'litho_site_sticky_logo_hover_transition',
					[
						'label' 		=> __( 'Transition Duration', 'litho-addons' ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [ 'px' => [ 'max' => 3, 'step' => 0.1 ] ],
						'selectors' 	=> [
							'{{WRAPPER}} .alt-logo' => 'transition-duration: {{SIZE}}s',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_site_sticky_logo_border',
					'selector' 		=> '{{WRAPPER}} .alt-logo',
					'separator' 	=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_site_sticky_logo_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .alt-logo'	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_site_sticky_logo_box_shadow',
					'exclude' 		=> [
						'box_shadow_position',
					],
					'selector' 		=> '{{WRAPPER}} .alt-logo',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render site logo widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                = $this->get_settings_for_display();
			$litho_h1_logo_font_page = ( isset( $settings['litho_h1_logo_font_page'] ) && ! empty( $settings['litho_h1_logo_font_page'] ) ) ? $settings['litho_h1_logo_font_page'] : '';
			$litho_enable_link_logo = ( isset( $settings['litho_enable_link_logo'] ) && ! empty( $settings['litho_enable_link_logo'] ) ) ? $settings['litho_enable_link_logo'] : '';

			if ( empty( $settings['litho_site_logo']['url'] ) ) {
				return;
			}

			// Logo
			$site_logo_url = '';
			if ( ! empty( $settings['litho_site_logo']['id'] ) ) {

				$site_logo_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_site_logo']['id'], 'litho_site_logo_image_size', $settings );

			} elseif ( ! empty( $settings['litho_site_logo']['url'] ) ) {

				$site_logo_url = $settings['litho_site_logo']['url'];
			}

			// Retina Logo
			$site_logo_ratina_url = '';
			if ( ! empty( $settings['litho_site_logo_ratina']['id'] ) ) {

				$site_logo_ratina_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_site_logo_ratina']['id'], 'litho_site_logo_ratina_image_size', $settings );

			} elseif ( ! empty( $settings['litho_site_logo_ratina']['url'] ) ) {

				$site_logo_ratina_url = $settings['litho_site_logo_ratina']['url'];
			}

			// Sticky Logo
			$site_sticky_logo_url = '';
			if ( ! empty( $settings['litho_site_sticky_logo']['id'] ) ) {

				$site_sticky_logo_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_site_sticky_logo']['id'], 'litho_site_sticky_logo_image_size', $settings );

			} elseif ( ! empty( $settings['litho_site_sticky_logo']['url'] ) ) {

				$site_sticky_logo_url = $settings['litho_site_sticky_logo']['url'];
			}

			// Sticky Retina Logo
			$site_sticky_logo_ratina_url = '';
			if ( ! empty( $settings['litho_site_sticky_logo_ratina']['id'] ) ) {

				$site_sticky_logo_ratina_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_site_sticky_logo_ratina']['id'], 'litho_site_sticky_logo_image_size', $settings );

			} elseif ( ! empty( $settings['litho_site_sticky_logo_ratina']['url'] ) ) {

				$site_sticky_logo_ratina_url = $settings['litho_site_sticky_logo_ratina']['url'];
			}

			// Mobile Logo
			$site_mobile_logo_url = '';
			if ( ! empty( $settings['litho_site_mobile_logo']['id'] ) ) {

				$site_mobile_logo_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_site_mobile_logo']['id'], 'litho_site_mobile_image_size', $settings );

			} elseif ( ! empty( $settings['litho_site_mobile_logo']['url'] ) ) {

				$site_mobile_logo_url = $settings['litho_site_mobile_logo']['url'];
			}

			// Mobile Retina Logo
			$site_mobile_logo_ratina_url = '';
			if ( ! empty( $settings['litho_site_mobile_logo_ratina']['id'] ) ) {

				$site_mobile_logo_ratina_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_site_mobile_logo_ratina']['id'], 'litho_site_mobile_logo_ratina_image_size', $settings );

			} elseif ( ! empty( $settings['litho_site_mobile_logo_ratina']['url'] ) ) {

				$site_mobile_logo_ratina_url = $settings['litho_site_mobile_logo_ratina']['url'];
			}
			
			$this->add_render_attribute( 'link', [
				'class' => [ 'navbar-brand' ],
				'href'  => get_home_url()
			] );

			$this->add_render_attribute( 'logo', [
				'class'     => [ 'default-logo' ],
				'src'       => $site_logo_url,
				'alt'       => get_bloginfo( 'name' ),
				'data-at2x' => $site_logo_ratina_url
			] );

			$this->add_render_attribute( 'sticky_logo', [
				'class'     => [ 'alt-logo' ],
				'src'       => $site_sticky_logo_url,
				'alt'       => get_bloginfo( 'name' ),
				'data-at2x' => $site_sticky_logo_ratina_url
			] );

			$this->add_render_attribute( 'mobile_logo', [
				'class'     => [ 'mobile-logo' ],
				'src'       => $site_mobile_logo_url,
				'alt'       => get_bloginfo( 'name' ),
				'data-at2x' => $site_mobile_logo_ratina_url
			] );

			if ( is_front_page() && 'yes' == $litho_h1_logo_font_page ) {
				?><h1><?php
			}

			if ( ! empty( $site_logo_url ) || ! empty( $site_sticky_logo_url ) ) {
				if ( 'yes' === $litho_enable_link_logo ) {
					?>
					<a <?php $this->print_render_attribute_string( 'link' ); ?>>
					<?php
				} else {
					?>
					<div class="navbar-brand">
					<?php
				}

				if ( ! empty( $site_logo_url ) ) {
					?><img <?php $this->print_render_attribute_string( 'logo' ); ?>/><?php
				}
				if ( ! empty( $site_sticky_logo_url ) ) {
					?><img <?php $this->print_render_attribute_string( 'sticky_logo' ); ?>/><?php
				}
				if ( ! empty( $site_mobile_logo_url ) ) {
					?><img <?php $this->print_render_attribute_string( 'mobile_logo' ); ?>/><?php
				}

				if ( 'yes' === $litho_enable_link_logo ) {
					?>
					</a>
					<?php
				} else {
					?>
					</div>
					<?php
				}
			} else {
				?><a href="<?php echo get_home_url(); ?>" class="site-title">
					<span class="logo"><?php echo get_bloginfo( 'name' ); ?></span>
				</a><?php
			}
			if ( is_front_page() && 'yes' == $litho_h1_logo_font_page ) {
			?></h1><?php
			}
		}
	}
}
