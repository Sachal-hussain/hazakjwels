<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Menu List Items
 *
 * @package Litho
 */

// If class `Menu List Items` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Menu_List_Items' ) ) {

	class Menu_List_Items extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-menu-list-items';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Menu List Items', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-menu-bar';
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
			return [ 'menu', 'nav', 'navigation', 'simple', 'list', 'menu items' ];
		}

		/**
		 * Register the widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */

		protected function register_controls() {

			$this->start_controls_section(
				'litho_menu_list_items_general_section',
				[
					'label'         => __( 'Menu', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_menu_list_items_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic'       => [
						'active' => true
					],
					'label_block' 	=> true,
				]
			);
			$this->add_control(
				'litho_menu_list_items_header_size',
				[
					'label'         => __( 'Title HTML Tag', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'h1'            => 'H1',
						'h2'            => 'H2',
						'h3'            => 'H3',
						'h4'            => 'H4',
						'h5'            => 'H5',
						'h6'            => 'H6',
						'div'           => 'div',
						'span'          => 'span',
						'p'             => 'p',
					],
					'default'       => 'h5',
					'condition'     => [
						'litho_menu_list_items_title[value]!' => '',
					]
				]
			);
			$this->add_control(
				'litho_menu_list_items_menu',
				[
					'label'         => __( 'Select Menu', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'label_block'	=> true,
					'default'       => '',
					'options'       => $this->get_menus_list(),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_title_style_section',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [
						'litho_menu_list_items_title[value]!' => '',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_menu_title_typography',
					'global'	=> [
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .litho-navigation-wrapper .title',
				]
			);
			$this->add_control(
				'litho_menu_title_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper .title'   => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_list_items_style_section',
				[
					'label'         => __( 'Menu Container', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_menu_list_items_container_background',
					'selector'      => '{{WRAPPER}} .litho-navigation-wrapper',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_menu_list_items_container_border',
					'selector'      => '{{WRAPPER}} .litho-navigation-wrapper',
					'separator'     => 'before'
				]
			);

			$this->add_responsive_control(
				'litho_menu_list_items_container_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_menu_list_items_container_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_menu_list_items_container_shadow',
					'selector'      => '{{WRAPPER}} .litho-navigation-wrapper',
				]
			);
			$this->add_control(
				'litho_menu_list_style',
				[
					'label' 		=> __( 'List Style', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'default'       => 'none',
					'options' 		=> [
						'none' 	=> [
							'title' 	=> __( 'None', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-justify',
						],
						'disc' => [
							'title' 	=> __( 'Bullet', 'litho-addons' ),
							'icon' 		=> 'eicon-checkbox',
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .litho-navigation-wrapper ul' => 'list-style: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_list_items_section_top_menu_style',
				[
					'label'         => __( 'Top Level', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_top_menu_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > a',
				]
			);

			$this->start_controls_tabs( 'navigation_link_top_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_list_items_top_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_top_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_top_menu_border',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_top_menu_shadow',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_top_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_list_items_top_menu_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_top_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > a:hover'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_top_navigation_link_border_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_top_navigation_link_shadow_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li:hover',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_navigation_link_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_list_items_top_menu_active',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_top_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-item > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-parent > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-ancestor > a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_top_menu_border_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-item, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-parent, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_top_menu_shadow_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-item, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-parent, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-ancestor',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_top_menu_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-item, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-parent, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li.current-menu-ancestor'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_menu_list_items_top_menu_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_list_items_top_menu_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_list_items_section_sub_menu_style',
				[
					'label'         => __( '2nd Level', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_menu_list_items_sub_menu_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > a',
				]
			);
			$this->start_controls_tabs( 'litho_menu_list_items_sub_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_list_items_sub_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_sub_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_border',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_shadow',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_sub_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_list_items_sub_menu_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_sub_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > a:hover'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_border_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_shadow_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li:hover',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_sub_menu_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_list_items_sub_menu_active',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_sub_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-item > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.item-depth-1.current-menu-parent > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-ancestor > a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_border_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-item, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-parent, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_shadow_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-item, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-parent, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-ancestor',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_sub_menu_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-parent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li.current-menu-ancestor' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_menu_list_items_sub_menu_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_list_items_sub_menu_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_list_items_section_sub_menu_third_style',
				[
					'label'         => __( '3rd Level', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_menu_list_items_sub_menu_third_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li a',
				]
			);
			$this->start_controls_tabs( 'litho_menu_list_items_sub_menu_third_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_list_items_sub_menu_third',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_sub_menu_third_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_third_border',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_third_shadow',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_sub_menu_third_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_list_items_sub_menu_third_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_sub_menu_third_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li > a:hover'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_third_border_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_third_shadow_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li:hover',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_sub_menu_third_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_list_items_sub_menu_third_active',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_list_items_sub_menu_third_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-item > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-parent > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-ancestor > a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_third_border_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-item, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-parent, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_list_items_sub_menu_third_shadow_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-item, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-parent, {{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-ancestor',
						]
					);
					$this->add_responsive_control(
						'litho_menu_list_items_sub_menu_third_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-parent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li.current-menu-ancestor' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_menu_list_items_sub_menu_third_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_list_items_sub_menu_third_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-wrapper .litho-navigation-link > li > ul > li > ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		* Render simple navigation widget output on the frontend.
		*
		* Written in PHP and used to generate the final HTML.
		*
		* @access protected
		*/

		protected function render() {
			$args        = array();
			$settings    = $this->get_settings_for_display();
			$litho_menu  = $this->get_settings( 'litho_menu_list_items_menu' );
			$menus_array = $this->get_menus_list();

			if ( ! isset( $litho_menu ) || 0 == count( $menus_array ) ) {
				return;
			}

			if ( ! $litho_menu ) {
				if ( empty( $menus_array ) ) {
					return;
				} else {
					$menus_array = array_keys( $menus_array );
					$litho_menu  = $menus_array[0];
				}
			} else {
				$litho_menu = $litho_menu;
			}

			$defaults_args = array(
				'menu' => $litho_menu,
			);

			$args = apply_filters(
				'litho_menu_list_items_args',
				array(
					'container'   => 'ul',
					'items_wrap'  => '<ul id="%1$s" class="%2$s litho-navigation-link">%3$s</ul>',
					'before'      => '',
					'after'       => '',
					'link_before' => '',
					'link_after'  => '',
				)
			);
			$args = array_merge( $defaults_args, $args );
			?>
			<div class="litho-navigation-wrapper">
				<?php if ( $this->get_settings( 'litho_menu_list_items_title' ) ) { ?>
					<<?php echo $this->get_settings( 'litho_menu_list_items_header_size' ); ?> class="title"><?php echo esc_html( $this->get_settings( 'litho_menu_list_items_title' ) ); ?></<?php echo $this->get_settings( 'litho_menu_list_items_header_size' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php } ?>
				<?php wp_nav_menu( $args ); ?>
			</div><?php
		}
		/**
		 * Return available menus list
		 */
		public function get_menus_list() {
			$menus      = wp_get_nav_menus();
			$menus_list = wp_list_pluck( $menus, 'name', 'slug' );
			$parent     = isset( $_GET['parent_menu'] ) ? absint( $_GET['parent_menu'] ) : 0;// phpcs:ignore

			if ( 0 < $parent && isset( $menus_list[ $parent ] ) ) {
				unset( $menus_list[ $parent ] );
			}
			return $menus_list;
		}
	}
}
