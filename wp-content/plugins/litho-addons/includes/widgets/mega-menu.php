<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Classes\Mega_Menu_Frontend_Walker;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for mega menu.
 *
 * @package Litho
 */

// If class `Mega_Menu` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Mega_Menu' ) ) {
	/**
	 * Define Mega Menu class
	 */
	class Mega_Menu extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-mega-menu';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Mega Menu', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-nav-menu';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 * @access public
		 *
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return [ 'litho', 'litho-header' ];
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
			return [ 'menu', 'nav', 'navigation', 'mega', 'mega menu' ];
		}

		/**
		 * Register mega menu widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_menu_section_content',
				[
					'label' => __( 'Menu', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_menu',
				[
					'label'   => __( 'Select Menu', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => $this->litho_get_menus_list(),
				]
			);
			$this->add_control(
				'litho_menu_toggle',
				[
					'label'        => __( 'Toggle', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Show', 'litho-addons' ),
					'label_off'    => __( 'Hide', 'litho-addons' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'litho_toggle_icon_text',
				[
					'label'       => __( 'Toggle Icon with Text', 'litho-addons' ),
					'type'        => Controls_Manager::TEXT,
					'description' => __( 'Add menu word with toggle icon.', 'litho-addons' ),
					'label_block' => true,
					'dynamic'     => [
						'active' => true,
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_menu_container_style',
				[
					'label'      => __( 'Menu Container', 'litho-addons' ),
					'tab'        => Controls_Manager::TAB_STYLE,
					'show_label' => false,
				]
			);
			$this->add_responsive_control(
				'litho_menu_container_alignment',
				[
					'label'       => __( 'Alignment', 'litho-addons' ),
					'type'        => Controls_Manager::CHOOSE,
					'label_block' => false,
					'default'     => 'flex-end',
					'options'     => [
						'flex-start'    => [
							'title' => __( 'Left', 'litho-addons' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center'    => [
							'title' => __( 'Center', 'litho-addons' ),
							'icon'  => 'eicon-text-align-center',
						],
						'flex-end'  => [
							'title' => __( 'Right', 'litho-addons' ),
							'icon'  => 'eicon-text-align-right',
						],
						'stretch'   => [
							'title' => __( 'Justify', 'litho-addons' ),
							'icon'  => 'eicon-text-align-justify',
						],
					],
					'selectors'    => [
						'{{WRAPPER}} .navbar-collapse'   => 'justify-content: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'           => 'litho_menu_container_background',
					'selector'       => '{{WRAPPER}} .navbar-collapse',
					'fields_options' => [
						'color'	=> [
							'responsive' => true,
						],
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_menu_container_border',
					'selector'      => '{{WRAPPER}} .navbar-collapse',
				]
			);
			$this->add_responsive_control(
				'litho_menu_container_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_container_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_menu_container_shadow',
					'selector'      => '{{WRAPPER}} .navbar-collapse',
					'fields_options' 	=> [
						'box_shadow' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_top_menu_style',
				[
					'label'         => __( 'Top Level', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_menu_top_menu_typography',
					'global'		=> [
							'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link',
				]
			);
			$this->start_controls_tabs( 'litho_menu_top_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_top_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_top_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_top_menu_shadow',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_icon_color',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link > i'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_top_menu_background',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_top_menu_border',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_top_menu_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_top_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a'          => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_top_menu_shadow_hover',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a.nav-link',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_icon_color_hover',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a.nav-link > i'         => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a.nav-link > i'  => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_top_menu_background_hover',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a.nav-link',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_top_menu_border_hover',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a.nav-link',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu:hover > a.nav-link'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown:hover > a.nav-link'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_top_menu_active',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_top_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item > a'             => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item > a'      => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-ancestor > a'         => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor > a'  => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown > a.active'  	=> 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'			=> 'litho_menu_top_menu_shadow_active',
							'selector'		=> '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-ancestor > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown > a.active',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_icon_color_active',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item  > a.nav-link > i'           => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item  > a.nav-link > i'    => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor  > a.nav-link > i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor  > a.nav-link > i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown > a.active > i' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_top_menu_background_active',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-ancestor > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown > a.active',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_top_menu_border_active',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-ancestor > a.nav-link, {{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown > a.active',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_border_radius_active',
						[
							'label'			=> __( 'Border Radius', 'litho-addons' ),
							'type'			=> Controls_Manager::DIMENSIONS,
							'size_units'	=> [ 'px', '%', 'custom' ],
							'selectors'		=> [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-item > a.nav-link'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-item > a.nav-link'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu.current-menu-ancestor > a.nav-link'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown.current-menu-ancestor > a.nav-link'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown > a.active' 	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_menu_top_menu_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_top_menu_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

		/** 2nd Level ( Simple Submenu ) **/

			$this->start_controls_section(
				'litho_menu_section_simple_sub_menu_style',
				[
					'label'         => __( '2nd Level ( Simple Submenu )', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_simple_background',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown ul.sub-menu',
					'fields_options' 	=> [
						'color' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_simple_border',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown ul.sub-menu',
				]
			);
			$this->add_responsive_control(
				'litho_menu_sub_menu_simple_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown ul.sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_sub_menu_simple_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_sub_menu_simple_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown ul.sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_simple_shadow',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown ul.sub-menu',
					'fields_options' 	=> [
						'box_shadow' 	=> [
							'responsive' => true
						]
					]
				]
			);

			$this->add_control(
				'litho_menu_sub_menu_heading',
				[
					'label'         => __( 'Submenu Items', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before', 
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_typography',
					'global'		=> [
							'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > span.handler',
				]
			);
			$this->start_controls_tabs( 'litho_menu_sub_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_sub_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_sub_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > span.handler' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_shadow',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_icon_color',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a > i' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_background',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_border',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_sub_menu_hover',
					[
						'label'     => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_sub_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1:hover > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1:hover > span.handler' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_shadow_hover',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1:hover > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_icon_color_hover',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1:hover > a > i' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_background_hover',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1:hover > a',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_border_hover',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1:hover > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_sub_menu_active',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_sub_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-item > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-ancestor > a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_shadow_active',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-ancestor > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_icon_color_active',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-item > a > i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-ancestor > a > i' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_background_active',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-ancestor > a',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_border_active',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-ancestor > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1.current-menu-ancestor > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_menu_sub_menu_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_sub_menu_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			/** 2nd Level ( Mega Submenu ) **/

			$this->start_controls_section(
				'litho_menu_section_mega_sub_menu_style',
				[
					'label'         => __( '2nd Level ( Mega Submenu )', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_megamenu_background',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu .megamenu-content',
					'fields_options' 	=> [
						'color' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_megamenu_border',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu .megamenu-content',
				]
			);
			$this->add_responsive_control(
				'litho_menu_sub_menu_megamenu_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu .megamenu-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_sub_menu_megamenu_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu .megamenu-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_sub_menu_megamenu_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu .megamenu-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_megamenu_shadow',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.megamenu .megamenu-content',
					'fields_options' 	=> [
						'box_shadow' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->add_control(
				'litho_menu_mega_menu_label_heading',
				[
					'label'         => __( 'Submenu Title', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_mega_menu_label_typography',
					'global'		=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content h5, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content .elementor-widget-litho-simple-navigation .title',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'          => 'litho_mega_menu_label_shadow',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content h5, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content .elementor-widget-litho-simple-navigation .title',
				]
			);
			$this->add_responsive_control(
				'litho_mega_menu_label_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content h5, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content .elementor-widget-litho-simple-navigation .title'   => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_mega_menu_label_border',
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content h5, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content .elementor-widget-litho-simple-navigation .title',
				]
			);

			$this->add_responsive_control(
				'litho_mega_menu_label_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content h5, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content .elementor-widget-litho-simple-navigation .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_mega_menu_label_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content h5, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content .elementor-widget-litho-simple-navigation .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_menu_mega_sub_menu_heading',
				[
					'label'         => __( 'Submenu Items', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before', 
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_menu_mega_sub_menu_typography',
					'global' 		=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a',
				]
			);
			$this->start_controls_tabs( 'litho_menu_mega_sub_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_mega_sub_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a' => 'color: {{VALUE}};'
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_shadow',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_icon_color',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a > i' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_background',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_border',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_mega_sub_menu_hover',
					[
						'label'     => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li:hover > a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_shadow_hover',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li:hover > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_icon_color_hover',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li:hover > a > i' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_background_hover',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li:hover > a',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_border_hover',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li:hover > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_mega_sub_menu_active',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-item > a' => 'color: {{VALUE}};',
								 '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-item > span.handler' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-ancestor > a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Text_Shadow::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_shadow_active',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-ancestor > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_icon_color_active',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-item > a > i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-ancestor > a > i' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_background_active',
							'types'         => [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-ancestor > a',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_mega_sub_menu_border_active',
							'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-ancestor > a',
						]
					);
					$this->add_responsive_control(
						'litho_menu_mega_sub_menu_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li.current-menu-ancestor > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_menu_mega_sub_menu_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_mega_sub_menu_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_sub_menu_third_style',
				[
					'label'         => __( '3rd Level', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'          => 'litho_menu_sub_menu_third_typography',
						'global'		=> [
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
						],
						'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > span.handler',
					]
				);
				$this->start_controls_tabs( 'litho_menu_sub_menu_third_state_tabs' );
					$this->start_controls_tab(
						'litho_menu_sub_menu_third',
						[
							'label'     => __( 'Normal', 'litho-addons' ),
						]
					);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_text_color',
							[
								'label'         => __( 'Text color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > span.handler' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Text_Shadow::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_shadow',
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_icon_color',
							[
								'label'         => __( 'Icon color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a > i' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_background',
								'types'         => [ 'classic', 'gradient' ],
								'exclude'       => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a',
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_border',
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_border_radius',
							[
								'label'         => __( 'Border Radius', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_menu_sub_menu_third_hover',
						[
							'label'     => __( 'Hover', 'litho-addons' ),
						]
					);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_text_color_hover',
							[
								'label'         => __( 'Text color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li:hover > a, {{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li:hover > span.handler' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Text_Shadow::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_shadow_hover',
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li:hover > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_icon_color_hover',
							[
								'label'         => __( 'Icon color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li:hover > a > i' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_background_hover',
								'types'         => [ 'classic', 'gradient' ],
								'exclude'       => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li:hover > a',
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_border_hover',
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li:hover > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_border_radius_hover',
							[
								'label'         => __( 'Border Radius', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_menu_sub_menu_third_active',
						[
							'label'     => __( 'Active', 'litho-addons' ),
						]
					);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_text_color_active',
							[
								'label'         => __( 'Text color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-item > span.handler' => 'color: {{VALUE}};',
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a, {{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > span.handler' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Text_Shadow::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_shadow_active',
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_icon_color_active',
							[
								'label'         => __( 'Icon color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a > i' => 'color: {{VALUE}};',
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a > i' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_background_active',
								'types'         => [ 'classic', 'gradient' ],
								'exclude'       => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a',
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_third_border_active',
								'selector'      => '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_border_radius_active',
							[
								'label'         => __( 'Border Radius', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
									 '{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
					$this->end_controls_tab();
				$this->end_controls_tabs();
				$this->add_responsive_control(
					'litho_menu_sub_menu_third_padding',
					[
						'label'         => __( 'Padding', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator'     => 'before'
					]
				);
				$this->add_responsive_control(
					'litho_menu_sub_menu_third_margin',
					[
						'label'         => __( 'Margin', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'          => 'litho_menu_sub_menu_third_box_shadow',
						'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav .nav-item.simple-dropdown ul.sub-menu > li > ul.sub-menu',
					]
				);
			$this->end_controls_section();



			$this->start_controls_section(
				'litho_menu_section_sub_menu_fourth_style',
				[
					'label'         => __( '4th Level', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'          => 'litho_menu_sub_menu_fourth_typography',
						'global'		=> [
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
						],
						'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > span.handler',
					]
				);
				$this->start_controls_tabs( 'litho_menu_sub_menu_fourth_state_tabs' );
					$this->start_controls_tab(
						'litho_menu_sub_menu_fourth',
						[
							'label'     => __( 'Normal', 'litho-addons' ),
						]
					);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_text_color',
							[
								'label'         => __( 'Text color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > span.handler' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Text_Shadow::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_shadow',
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_icon_color',
							[
								'label'         => __( 'Icon color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a > i' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_background',
								'types'         => [ 'classic', 'gradient' ],
								'exclude'       => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a',
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_border',
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_border_radius',
							[
								'label'         => __( 'Border Radius', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_menu_sub_menu_fourth_hover',
						[
							'label'     => __( 'Hover', 'litho-addons' ),
						]
					);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_text_color_hover',
							[
								'label'         => __( 'Text color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li:hover > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > span.handler' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Text_Shadow::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_shadow_hover',
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li:hover > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_icon_color_hover',
							[
								'label'         => __( 'Icon color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li:hover > a > i' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_background_hover',
								'types'         => [ 'classic', 'gradient' ],
								'exclude'       => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li:hover > a',
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_border_hover',
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li:hover > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_border_radius_hover',
							[
								'label'         => __( 'Border Radius', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_menu_sub_menu_fourth_active',
						[
							'label'     => __( 'Active', 'litho-addons' ),
						]
					);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_text_color_active',
							[
								'label'         => __( 'Text color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-item > span.handler' => 'color: {{VALUE}};',
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > span.handler' => 'color: {{VALUE}};',

								],
							]
						);
						$this->add_group_control(
							Group_Control_Text_Shadow::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_shadow_active',
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_icon_color_active',
							[
								'label'         => __( 'Icon color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a > i' => 'color: {{VALUE}};',
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a > i' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_background_active',
								'types'         => [ 'classic', 'gradient' ],
								'exclude'       => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a',
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_menu_sub_menu_fourth_border_active',
								'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a, {{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_border_radius_active',
							[
								'label'         => __( 'Border Radius', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li.current-menu-ancestor > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
					$this->end_controls_tab();
				$this->end_controls_tabs();
				$this->add_responsive_control(
					'litho_menu_sub_menu_fourth_padding',
					[
						'label'         => __( 'Padding', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						],
						'separator'     => 'before'
					]
				);
				$this->add_responsive_control(
					'litho_menu_sub_menu_fourth_margin',
					[
						'label'         => __( 'Margin', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'          => 'litho_menu_sub_menu_fourth_box_shadow',
						'selector'      => '{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu',	
					]
				);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_icon_style',
				[
					'label'         => __( 'Icon', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
				$this->start_controls_tabs( 'litho_menu_section_icon_style_tabs' );
					$this->start_controls_tab(
						'litho_menu_section_icon_top_menu',
						[
							'label'     => __( 'Top Menu', 'litho-addons' ),
						]
					);
						$this->add_responsive_control(
							'litho_menu_section_icon_top_menu_size',
							[
								'label'         => __( 'Icon Size', 'litho-addons' ),
								'type'          => Controls_Manager::SLIDER,
								'size_units'    => [ 'px', 'custom' ],
								'range'         => [ 'px'   => [ 'min' => 10, 'max' => 100 ] ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link > i' => 'font-size: {{SIZE}}{{UNIT}}',
								],
							]
						);
						$this->add_responsive_control(
							'litho_menu_section_icon_top_menu_margin',
							[
								'label'         => __( 'Margin', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a.nav-link > i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_menu_section_icon_sub_menu',
						[
							'label'     => __( 'Sub Menu', 'litho-addons' ),
						]
					);

						$this->add_control(
							'litho_menu_section_icon_sub_menu_size_heading',
							[
								'label'         => __( '2nd Level', 'litho-addons' ),
								'type'          => Controls_Manager::HEADING,
								'separator'     => 'before',
							]
						);
						$this->add_responsive_control(
							'litho_menu_section_icon_sub_menu_size',
							[
								'label'         => __( 'Icon Size', 'litho-addons' ),
								'type'          => Controls_Manager::SLIDER,
								'size_units'    => [ 'px', 'custom' ],
								'range'         => [ 'px'   => [ 'min' => 10, 'max' => 100 ] ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a > i, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a > i' => 'font-size: {{SIZE}}{{UNIT}}',
								],
							]
						);
						$this->add_responsive_control(
							'litho_menu_section_icon_sub_menu_margin',
							[
								'label'         => __( 'Margin', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li.item-depth-1 > a > i, {{WRAPPER}} .navbar-collapse .navbar-nav .dropdown-menu.megamenu-content li a > i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
						$this->add_control(
							'litho_menu_sub_menu_third_icon_size_heading',
							[
								'label'         => __( '3rd Level', 'litho-addons' ),
								'type'          => Controls_Manager::HEADING,
								'separator'     => 'before',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_icon_size',
							[
								'label'         => __( 'Icon Size', 'litho-addons' ),
								'type'          => Controls_Manager::SLIDER,
								'size_units'    => [ 'px', 'custom' ],
								'range'         => [ 'px'   => [ 'min' => 10, 'max' => 100 ] ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a > i' => 'font-size: {{SIZE}}{{UNIT}}',
								],
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_third_icon_margin',
							[
								'label'         => __( 'Margin', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > a > i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
						$this->add_control(
							'litho_menu_sub_menu_fourth_icon_size_heading',
							[
								'label'         => __( '4th Level', 'litho-addons' ),
								'type'          => Controls_Manager::HEADING,
								'separator'     => 'before',
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_icon_size',
							[
								'label'         => __( 'Icon Size', 'litho-addons' ),
								'type'          => Controls_Manager::SLIDER,
								'size_units'    => [ 'px', 'custom' ],
								'range'         => [ 'px'   => [ 'min' => 10, 'max' => 100 ] ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a > i' => 'font-size: {{SIZE}}{{UNIT}}',
								],
							]
						);
						$this->add_responsive_control(
							'litho_menu_sub_menu_fourth_icon_margin',
							[
								'label'         => __( 'Margin', 'litho-addons' ),
								'type'          => Controls_Manager::DIMENSIONS,
								'size_units'    => [ 'px', '%', 'custom' ],
								'selectors'     => [
									'{{WRAPPER}} .navbar-collapse .navbar-nav li.simple-dropdown ul.sub-menu > li > ul.sub-menu > li > ul.sub-menu > li > a > i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);

					$this->end_controls_tab();
				$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_mobile_style',
				[
					'label'		=> __( 'Mobile Menu', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_menu_mobile_toggle_color',
				[
					'label'			=> __( 'Toggle Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'selectors'		=> [
						'{{WRAPPER}} .navbar-toggler-line'   => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_toggle_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'rem', 'em', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .navbar-toggler' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_control(
				'litho_menu_toggle_icon_text_heading',
				[
					'label'         => __( 'Toggle Icon with Text', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'litho_menu_mobile_toggle_text_typography',
					'selector' => '{{WRAPPER}} .toggle-menu-word',
				]
			);
			$this->add_control(
				'litho_menu_mobile_toggle_text_color',
				[
					'label'     => __( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .toggle-menu-word' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_toggle_text_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'rem', 'em', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .toggle-menu-word' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render mega menu widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$menu_type = '';
			$args      = array();
			$settings  = $this->get_settings_for_display();

			if ( 'sectionbuilder' === get_post_type( get_the_ID() ) ) {
				$menu_type = get_post_meta( get_the_ID(), '_litho_template_header_style', true );
			} else {
				$litho_header_section_id = litho_post_meta( 'litho_header_section' );
				$menu_type = get_post_meta( $litho_header_section_id, '_litho_template_header_style', true );
			}
			$menu_type  = ( ! empty( $menu_type ) ) ? $menu_type : 'standard';
			$menus_array = $this->litho_get_menus_list();

			if ( ! isset( $settings['litho_menu'] ) || count( $menus_array ) == 0 ) {
				return;
			}

			if ( ! $settings['litho_menu'] ) {
				if ( empty( $menus_array ) ) {
					return;
				} else {
					$menus_array = array_keys( $menus_array );
					$litho_menu  = $menus_array[0];
				}
			} else {
				$litho_menu = $settings['litho_menu'];
			}

			$defaults_args = array(
				'menu' => $litho_menu,
			);

			if ( class_exists( 'LithoAddons\Classes\Mega_Menu_Frontend_Walker' ) ) {

				$args = apply_filters(
					'litho_mega_menu_frontend_args',
					array(
						'container'   => 'ul',
						'items_wrap'  => '<ul id="%1$s" class="%2$s alt-font navbar-nav">%3$s</ul>',
						'before'      => '',
						'after'       => '',
						'link_before' => '',
						'link_after'  => '',
						'fallback_cb' => false,
						'walker'      => new Mega_Menu_Frontend_Walker(),
					)
				);
			}

			$args  = array_merge( $defaults_args, $args );
			if ( 'yes' === $this->get_settings( 'litho_menu_toggle' ) ) {
				if ( isset( $settings['litho_toggle_icon_text'] ) && ! empty( $settings['litho_toggle_icon_text'] ) ) {
					echo '<div class="toggle-menu-word alt-font">' . esc_html( $settings['litho_toggle_icon_text'] ) . '</div>';
				}
				?>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLeftNav" aria-controls="navbarLeftNav" aria-label="<?php echo esc_attr( 'Toggle navigation', 'litho-addons' ); ?>">
					<span class="navbar-toggler-line"></span>
					<span class="navbar-toggler-line"></span>
					<span class="navbar-toggler-line"></span>
					 <span class="navbar-toggler-line"></span>
				</button>
				<?php
			}
			?>
			<div id="navbarLeftNav" class="collapse navbar-collapse" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
				<?php wp_nav_menu( $args ); ?>
			</div>
			<?php
		}
		/**
		 * Return available menus list
		 */
		public function litho_get_menus_list() {

			$menus      = wp_get_nav_menus();
			$menus_list = wp_list_pluck( $menus, 'name', 'slug' );
			$parent     = isset( $_GET['parent_menu'] ) ? absint( $_GET['parent_menu'] ) : 0;

			if ( 0 < $parent && isset( $menus_list[ $parent ] ) ) {
				unset( $menus_list[ $parent ] );
			}

			return $menus_list;
		}
	}
}
