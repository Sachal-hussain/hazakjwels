<?php
namespace LithoAddons\Classes;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Sticky Header Controls & Features
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Sticky_Header_Options` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Classes\Sticky_Header_Options' ) ) {

	/**
	 * Define Sticky_Header_Options class
	 */
	class Sticky_Header_Options {
		/**
		 * Constructor
		 */
		public function __construct() {
			/** STICKY HEADER hook */
			add_filter( 'elementor/documents/register_controls', [ $this, 'litho_add_sticky_header_settings' ] );
			/** STICKY MINI HEADER hook */
			add_filter( 'elementor/documents/register_controls', [ $this, 'litho_add_sticky_mini_header_settings' ] );
		}

		public function litho_add_sticky_header_settings( $documents ) {

			$documents->start_controls_section(
				'document_sticky_header_style_section',
				[
					'label' => __( 'Sticky Header Style', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_SETTINGS,
				]
			);

				$documents->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'          => 'litho_sticky_header_typography',
						'selector'      => '.sticky .header-common-wrapper .navbar-collapse .navbar-nav > li > a.nav-link, .sticky .header-common-wrapper .navbar-collapse .navbar-nav > li > a.nav-link i',
					]
				);

				$documents->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'          => 'litho_sticky_header_background_color',
						'types'         => [ 'classic', 'gradient' ],
						'exclude'       => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'fields_options'	=> [
							'color'	=> [
								'responsive' => true
							]
						],
						'selector'      => '.sticky.site-header .header-common-wrapper section.elementor-section:not(section.elementor-section section.elementor-section)',
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_header_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'.sticky.site-header .header-common-wrapper section.elementor-section:not(section.elementor-section section.elementor-section)' => 'border-bottom-style: solid; border-bottom-color: {{VALUE}};',
						],
						'separator'		=> 'before'
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_header_border_width',
					[
						'label' => __( 'Border Width', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 10,
							],
						],
						'selectors' => [
							'.sticky.site-header .header-common-wrapper section.elementor-section:not(section.elementor-section section.elementor-section)' => 'border-bottom-width: {{SIZE}}{{UNIT}};'
						],
					]
				);

				$documents->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_sticky_header_box_shadow',
						'selector' 		=> '.sticky .header-common-wrapper',
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_header_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_header_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_text_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .navbar-nav > li > a' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav > li > a.nav-link' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav > li > a.nav-link > i' => 'color: {{VALUE}};',
							],
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_header_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_text_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav > li > a.nav-link:hover' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a.nav-link > i'         => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a.nav-link > i'  => 'color: {{VALUE}};',
							],
						]
					);
					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_header_active_tab',
						[
							'label' 		=> __( 'Active', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_text_active_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item > a'             => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item > a'      => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-ancestor > a'         => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor > a'  => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item  > a.nav-link > i'           => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item  > a.nav-link > i'    => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor  > a.nav-link > i' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor  > a.nav-link > i' => 'color: {{VALUE}};',
							],
						]
					);
					$documents->end_controls_tab();

				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_header_hamburger_icon_heading',
					[
						'label'         => __( 'Hamburger icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_header_hamburger_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_header_hamburger_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_hamburger_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .navbar-toggler .navbar-toggler-line' => 'background-color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .push-button > span' => 'background-color: {{VALUE}};',
							],
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_header_hamburger_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_hamburger_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .push-button:hover > span' => 'background-color: {{VALUE}};',
							],
						]
					);
					$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_header_search_icon_heading',
					[
						'label'         => __( 'Search icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);
				$documents->add_responsive_control(
					'litho_sticky_header_search_icon_size',
					[
						'label' => __( 'Size', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'.sticky .header-common-wrapper .search-form-icon .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};'
						],
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_header_search_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_header_search_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_search_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .search-form-icon .elementor-icon' => 'color: {{VALUE}};',
							],
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_header_search_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_search_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .search-form-icon .elementor-icon:hover' => 'color: {{VALUE}};',
							],
						]
					);
					$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_header_mini_cart_icon_heading',
					[
						'label'         => __( 'Mini cart icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_header_mini_cart_icon_size',
					[
						'label' => __( 'Size', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'.sticky .header-common-wrapper .cart-top-counter' => 'font-size: {{SIZE}}{{UNIT}};'
						],
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_header_mini_cart_icon_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_header_mini_cart_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_mini_cart_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .top-cart-wrapper .cart-icon' => 'color: {{VALUE}};',
							],
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_header_mini_cart_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_mini_cart_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .top-cart-wrapper:hover .cart-icon' => 'color: {{VALUE}};',
							],
						]
					);
					$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_header_social_icon_heading',
					[
						'label'         => __( 'Social icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_header_social_icon_size',
					[
						'label' => __( 'Size', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'.sticky .header-common-wrapper.standard .social-icons-wrapper ul li a.elementor-social-icon' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_header_social_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_header_social_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_social_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .social-icons-wrapper ul li a.elementor-social-icon i' => 'color: {{VALUE}};',
							],
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_header_social_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_social_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .social-icons-wrapper ul li a.elementor-social-icon:hover i' => 'color: {{VALUE}};',
							],
						]
					);
					$documents->end_controls_tab();

				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_header_general_heading',
					[
						'label'         => __( 'General style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_header_general_tabs' );

					$documents->start_controls_tab( 'litho_sticky_header_general_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_general_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .elementor-widget-icon-box .elementor-icon-box-content .elementor-icon-box-title, .sticky .header-common-wrapper.standard .elementor-widget-icon-box .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .elementor-widget-icon-box.elementor-view-default .elementor-icon' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .elementor-widget-litho-icon-box .elementor-icon-box-content .elementor-icon-box-title, .sticky .header-common-wrapper.standard .elementor-widget-litho-icon-box .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .elementor-widget-litho-icon-box.elementor-view-default .elementor-icon' => 'color: {{VALUE}};',
							],
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_header_general_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_header_general_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .header-common-wrapper.standard .elementor-widget-icon-box .elementor-icon-box-content .elementor-icon-box-title a:hover' => 'color: {{VALUE}};',
								'.sticky .header-common-wrapper.standard .elementor-widget-litho-icon-box .elementor-icon-box-content .elementor-icon-box-title a:hover' => 'color: {{VALUE}};',
							],
						]
					);
					$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_header_button_heading',
					[
						'label'         => __( 'Button style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 		=> 'litho_sticky_header_button_typography',
						'global' 	=> [
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
						],
						'selector' 	=> '.sticky .header-common-wrapper.standard a.elementor-button, .sticky .header-common-wrapper.standard .elementor-button',
					]
				);

				$documents->add_group_control(
					Group_Control_Text_Shadow::get_type(),
					[
						'name' 			=> 'litho_sticky_header_button_text_shadow',
						'selector' 		=> '.sticky .header-common-wrapper.standard a.elementor-button, .sticky .header-common-wrapper.standard .elementor-button',
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_header_tabs_button_style' );

				$documents->start_controls_tab(
					'litho_sticky_header_tab_button_normal',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);

				$documents->add_control(
					'litho_sticky_header_button_text_color',
					[
						'label' 		=> __( 'Text Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'selectors' 	=> [
							'.sticky .header-common-wrapper.standard a.elementor-button, .sticky .header-common-wrapper.standard .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);

				$documents->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_sticky_header_button_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '.sticky .header-common-wrapper.standard a.elementor-button:not(.hvr-btn-expand-ltr), .sticky .header-common-wrapper.standard a.elementor-button.btn-custom-effect:before, .sticky .header-common-wrapper.standard a.elementor-button.hvr-btn-expand-ltr:before',
					]
				);

				$documents->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_sticky_header_button_box_shadow',
						'selector' 		=> '.sticky .header-common-wrapper.standard .elementor-button',
						'fields_options' 	=> [
							'box_shadow' 	=> [
								'responsive' => true,
							],
						],
					]
				);

				$documents->add_control(
					'litho_sticky_header_button_border_radius',
					[
						'label' 		=> __( 'Border Radius', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'.sticky .header-common-wrapper.standard a.elementor-button:not(.btn-custom-effect), .sticky .header-common-wrapper.standard a.elementor-button.btn-custom-effect:not(.hvr-btn-expand-ltr), .sticky .header-common-wrapper.standard a.elementor-button.hvr-btn-expand-ltr:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$documents->end_controls_tab();

				$documents->start_controls_tab(
					'litho_sticky_header_tab_button_hover',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);

				$documents->add_control(
					'litho_sticky_header_button_text_hover_color',
					[
						'label' 		=> __( 'Text Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'.sticky .header-common-wrapper.standard a.elementor-button:hover, .sticky .header-common-wrapper.standard .elementor-button:hover, .sticky .header-common-wrapper.standard a.elementor-button:focus, .sticky .header-common-wrapper.standard .elementor-button:focus' => 'color: {{VALUE}};',
							'.sticky .header-common-wrapper.standard a.elementor-button:hover svg, .sticky .header-common-wrapper.standard .elementor-button:hover svg, .sticky .header-common-wrapper.standard a.elementor-button:focus svg, .sticky .header-common-wrapper.standard .elementor-button:focus svg' => 'fill: {{VALUE}};',
						],
					]
				);

				$documents->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_sticky_header_button_background_hover_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '.sticky .header-common-wrapper.standard a.elementor-button:not(.hvr-btn-expand-ltr):hover, .sticky .header-common-wrapper.standard a.elementor-button.btn-custom-effect:not(.hvr-btn-expand-ltr):hover:before',
					]
				);

				$documents->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_sticky_header_button_hover_box_shadow',
						'selector' 		=> '.sticky .header-common-wrapper.standard a.elementor-button:hover, .sticky .header-common-wrapper.standard .elementor-button:hover, .sticky .header-common-wrapper.standard a.elementor-button:focus, .sticky .header-common-wrapper.standard .elementor-button:focus',
					]
				);

				$documents->add_control(
					'litho_sticky_header_button_hover_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'.sticky .header-common-wrapper.standard a.elementor-button:hover, .sticky .header-common-wrapper.standard .elementor-button:hover, .sticky .header-common-wrapper.standard a.elementor-button:focus, .sticky .header-common-wrapper.standard .elementor-button:focus' => 'border-color: {{VALUE}};',
						],
					]
				);
				$documents->add_control(
					'litho_sticky_header_button_hover_border_radius',
					[
						'label' 		=> __( 'Border Radius', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'.sticky .header-common-wrapper.standard a.elementor-button:hover, .sticky .header-common-wrapper.standard .elementor-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' 				=> 'litho_sticky_header_button_border',
						'selector' 			=> '.sticky .header-common-wrapper.standard .elementor-button',
						'fields_options'	=> [
							'border' 	=> [
								'separator'	=> 'before'
							]
						]
					]
				);
				$documents->add_control(
					'litho_sticky_header_button_text_padding',
					[
						'label' 		=> __( 'Padding', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem' ],
						'selectors' 	=> [
							'.sticky .header-common-wrapper.standard a.elementor-button, .sticky .header-common-wrapper.standard .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);
			$documents->end_controls_section();
		}

		public function litho_add_sticky_mini_header_settings( $documents ) {

			$documents->start_controls_section(
				'document_sticky_mini_header_style_section',
				[
					'label' => __( 'Sticky Mini Header Style', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_SETTINGS,
				]
			);

				$documents->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'          => 'litho_sticky_mini_header_typography',
						'selector'      => '.sticky .mini-header-main-wrapper .simple-navigation-menu li > a, .sticky .mini-header-main-wrapper .elementor-widget-text-editor, .sticky .mini-header-main-wrapper .elementor-widget-icon-box .elementor-icon-box-content .elementor-icon-box-title, .sticky .mini-header-main-wrapper .elementor-widget-icon-box.elementor-view-default .elementor-icon, .sticky .mini-header-main-wrapper .elementor-widget-litho-icon-box .elementor-icon-box-content .elementor-icon-box-title, .sticky .mini-header-main-wrapper .elementor-widget-litho-icon-box.elementor-view-default .elementor-icon',
					]
				);

				$documents->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'          => 'litho_sticky_mini_header_background_color',
						'types'         => [ 'classic', 'gradient' ],
						'exclude'       => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'fields_options'	=> [
							'color'	=> [
								'responsive' => true
							]
						],
						'selector'      => '.sticky.site-header .mini-header-main-wrapper section.elementor-section:not(section.elementor-section section.elementor-section)',
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_mini_header_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'.sticky.site-header .mini-header-main-wrapper section.elementor-section:not(section.elementor-section section.elementor-section)' => 'border-bottom-style: solid; border-bottom-color: {{VALUE}};',
						],
						'separator'		=> 'before'
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_mini_header_border_width',
					[
						'label' => __( 'Border Width', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 10,
							],
						],
						'selectors' => [
							'.sticky.site-header .mini-header-main-wrapper section.elementor-section:not(section.elementor-section section.elementor-section)' => 'border-bottom-width: {{SIZE}}{{UNIT}};'
						]
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_mini_header_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_mini_header_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_text_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .simple-navigation-menu li > a' => 'color: {{VALUE}};',
							]
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_mini_header_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_text_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .simple-navigation-menu li > a:hover' => 'color: {{VALUE}};',
							]
						]
					);
					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_mini_header_active_tab',
						[
							'label' 		=> __( 'Active', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_text_active_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .simple-navigation-menu li.current-menu-item > a' => 'color: {{VALUE}};',
							]
						]
					);
					$documents->end_controls_tab();

				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_mini_header_hamburger_icon_heading',
					[
						'label'         => __( 'Hamburger icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_mini_header_hamburger_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_mini_header_hamburger_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_hamburger_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .navbar-toggler .navbar-toggler-line' => 'background-color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .push-button > span' => 'background-color: {{VALUE}};',
							],
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_mini_header_hamburger_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_hamburger_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .push-button:hover > span' => 'background-color: {{VALUE}};',
							]
						]
					);

					$documents->end_controls_tab();

				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_mini_header_search_icon_heading',
					[
						'label'         => __( 'Search icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);
				$documents->add_responsive_control(
					'litho_sticky_mini_header_search_icon_size',
					[
						'label' => __( 'Size', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'.sticky .header-common-wrapper .search-form-icon .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};'
						]
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_mini_header_search_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_mini_header_search_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_search_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .search-form-icon .elementor-icon' => 'color: {{VALUE}};',
							]
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_mini_header_search_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_search_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .search-form-icon .elementor-icon:hover' => 'color: {{VALUE}};',
							]
						]
					);
					$documents->end_controls_tab();

				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_mini_header_mini_cart_icon_heading',
					[
						'label'         => __( 'Mini cart icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_mini_header_mini_cart_icon_size',
					[
						'label' => __( 'Size', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'.sticky .header-common-wrapper .cart-top-counter' => 'font-size: {{SIZE}}{{UNIT}};'
						]
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_mini_header_mini_cart_icon_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_mini_header_mini_cart_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_mini_cart_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .top-cart-wrapper .cart-icon' => 'color: {{VALUE}};',
							]
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_mini_header_mini_cart_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_mini_cart_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .top-cart-wrapper:hover .cart-icon' => 'color: {{VALUE}};',
							]
						]
					);
					$documents->end_controls_tab();

				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_mini_header_social_icon_heading',
					[
						'label'         => __( 'Social icon style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->add_responsive_control(
					'litho_sticky_mini_header_social_icon_size',
					[
						'label' => __( 'Size', 'litho-addons' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'.sticky .mini-header-main-wrapper .social-icons-wrapper ul li a.elementor-social-icon' => 'font-size: {{SIZE}}{{UNIT}};'
						]
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_mini_header_social_icon_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_mini_header_social_icon_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_social_icon_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .social-icons-wrapper ul li a.elementor-social-icon i' => 'color: {{VALUE}};',
							]
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_mini_header_social_icon_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_social_icon_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .social-icons-wrapper ul li a.elementor-social-icon:hover i' => 'color: {{VALUE}};',
							]
						]
					);
					$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_mini_header_general_heading',
					[
						'label'         => __( 'General style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_mini_header_general_tabs' );

					$documents->start_controls_tab(
						'litho_sticky_mini_header_general_normal_tab',
						[
							'label' 		=> __( 'Normal', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_general_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .elementor-widget-litho-heading .litho-primary-title, .sticky .mini-header-main-wrapper .elementor-widget-litho-heading .litho-primary-title a' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-litho-heading .litho-secondary-title, .sticky .mini-header-main-wrapper .elementor-widget-litho-heading .litho-secondary-title a' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-text-editor' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-icon-box .elementor-icon-box-content .elementor-icon-box-title, .sticky .mini-header-main-wrapper .elementor-widget-icon-box .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-icon-box.elementor-view-default .elementor-icon' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-litho-icon-box .elementor-icon-box-content .elementor-icon-box-title, .sticky .mini-header-main-wrapper .elementor-widget-litho-icon-box .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-litho-icon-box.elementor-view-default .elementor-icon' => 'color: {{VALUE}};',
							]
						]
					);

					$documents->end_controls_tab();

					$documents->start_controls_tab(
						'litho_sticky_mini_header_general_hover_tab',
						[
							'label' 		=> __( 'Hover', 'litho-addons' ),
						]
					);

					$documents->add_responsive_control(
						'litho_sticky_mini_header_general_hover_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'.sticky .mini-header-main-wrapper .elementor-widget-litho-heading .litho-primary-title a:hover' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-litho-heading .litho-secondary-title a:hover' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-text-editor a:hover' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-icon-box .elementor-icon-box-content .elementor-icon-box-title a:hover' => 'color: {{VALUE}};',
								'.sticky .mini-header-main-wrapper .elementor-widget-litho-icon-box .elementor-icon-box-content .elementor-icon-box-title a:hover' => 'color: {{VALUE}};',
							]
						]
					);
					$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_control(
					'litho_sticky_mini_header_button_heading',
					[
						'label'         => __( 'Button style', 'litho-addons' ),
						'type'          => Controls_Manager::HEADING,
						'separator'     => 'before',
					]
				);

				$documents->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 		=> 'litho_sticky_mini_header_button_typography',
						'global' 	=> [
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
						],
						'selector' 	=> '.sticky .mini-header-main-wrapper a.elementor-button, .sticky .mini-header-main-wrapper .elementor-button',
					]
				);

				$documents->add_group_control(
					Group_Control_Text_Shadow::get_type(),
					[
						'name' 			=> 'litho_sticky_mini_header_button_text_shadow',
						'selector' 		=> '.sticky .mini-header-main-wrapper a.elementor-button, .sticky .mini-header-main-wrapper .elementor-button',
					]
				);

				$documents->start_controls_tabs( 'litho_sticky_mini_header_tabs_button_style' );

				$documents->start_controls_tab(
					'litho_sticky_mini_header_tab_button_normal',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);

				$documents->add_control(
					'litho_sticky_mini_header_button_text_color',
					[
						'label' 		=> __( 'Text Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'selectors' 	=> [
							'.sticky .mini-header-main-wrapper a.elementor-button, .sticky .mini-header-main-wrapper .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
						]
					]
				);

				$documents->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_sticky_mini_header_button_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '.sticky .mini-header-main-wrapper a.elementor-button:not(.hvr-btn-expand-ltr), .sticky .mini-header-main-wrapper a.elementor-button.btn-custom-effect:before, .sticky .mini-header-main-wrapper a.elementor-button.hvr-btn-expand-ltr:before',
					]
				);

				$documents->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_sticky_mini_header_button_box_shadow',
						'selector' 		=> '.sticky .mini-header-main-wrapper .elementor-button',
						'fields_options' 	=> [
							'box_shadow' 	=> [
								'responsive' => true,
							]
						]
					]
				);

				$documents->add_control(
					'litho_sticky_mini_header_button_border_radius',
					[
						'label' 		=> __( 'Border Radius', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'.sticky .mini-header-main-wrapper a.elementor-button:not(.btn-custom-effect), .sticky .mini-header-main-wrapper a.elementor-button.btn-custom-effect:not(.hvr-btn-expand-ltr), .sticky .mini-header-main-wrapper a.elementor-button.hvr-btn-expand-ltr:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);

				$documents->end_controls_tab();

				$documents->start_controls_tab(
					'litho_sticky_mini_header_tab_button_hover',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);

				$documents->add_control(
					'litho_sticky_mini_header_button_text_hover_color',
					[
						'label' 		=> __( 'Text Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'.sticky .mini-header-main-wrapper a.elementor-button:hover, .sticky .mini-header-main-wrapper .elementor-button:hover, .sticky .mini-header-main-wrapper a.elementor-button:focus, .sticky .mini-header-main-wrapper .elementor-button:focus' => 'color: {{VALUE}};',
							'.sticky .mini-header-main-wrapper a.elementor-button:hover svg, .sticky .mini-header-main-wrapper .elementor-button:hover svg, .sticky .mini-header-main-wrapper a.elementor-button:focus svg, .sticky .mini-header-main-wrapper .elementor-button:focus svg' => 'fill: {{VALUE}};',
						]
					]
				);

				$documents->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_sticky_mini_header_button_background_hover_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '.sticky .mini-header-main-wrapper a.elementor-button:not(.hvr-btn-expand-ltr):hover, .sticky .mini-header-main-wrapper a.elementor-button.btn-custom-effect:not(.hvr-btn-expand-ltr):hover:before',
					]
				);

				$documents->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_sticky_mini_header_button_hover_box_shadow',
						'selector' 		=> '.sticky .mini-header-main-wrapper a.elementor-button:hover, .sticky .mini-header-main-wrapper .elementor-button:hover, .sticky .mini-header-main-wrapper a.elementor-button:focus, .sticky .mini-header-main-wrapper .elementor-button:focus',
					]
				);

				$documents->add_control(
					'litho_sticky_mini_header_button_hover_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'.sticky .mini-header-main-wrapper a.elementor-button:hover, .sticky .mini-header-main-wrapper .elementor-button:hover, .sticky .mini-header-main-wrapper a.elementor-button:focus, .sticky .mini-header-main-wrapper .elementor-button:focus' => 'border-color: {{VALUE}};',
						]
					]
				);
				$documents->add_control(
					'litho_sticky_mini_header_button_hover_border_radius',
					[
						'label' 		=> __( 'Border Radius', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'.sticky .mini-header-main-wrapper a.elementor-button:hover, .sticky .mini-header-main-wrapper .elementor-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);
				$documents->end_controls_tab();
				$documents->end_controls_tabs();

				$documents->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' 			=> 'litho_sticky_mini_header_button_border',
						'selector' 		=> '.sticky .mini-header-main-wrapper .elementor-button',
						'fields_options' 	=> [
							'border' 	=> [
								'separator'	=> 'before'
							]
						]
					]
				);
				$documents->add_control(
					'litho_sticky_mini_header_button_text_padding',
					[
						'label' 		=> __( 'Padding', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem' ],
						'selectors' 	=> [
							'.sticky .mini-header-main-wrapper a.elementor-button, .sticky .mini-header-main-wrapper .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);

			$documents->end_controls_section();
		}
	}
}
