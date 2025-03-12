<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Classes\Left_Menu_Frontend_Walker;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Left Menu.
 *
 * @package Litho
 */

// If class `Left_Menu` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Left_Menu' ) ) {

	class Left_Menu extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-left-menu';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Left Menu', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-navigation-vertical';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 * @access public
		 *
		 * @return string Widget categories.
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
			return [ 'menu', 'nav', 'navigation', 'sidebar' ];
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
				'litho_left_menu_general_section',
				[
					'label'         => __( 'Menu', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_menu',
				[
					'label'         => __( 'Select Menu', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => '',                
					'options'       => $this->get_menus_list(),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_left_menu_container_style_section',
				[
					'label'         => __( 'Menu Container', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_responsive_control(
				'litho_menu_container_item_align',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						],
					],
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .litho-left-menu li'   => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_menu_container_background',
					'selector'      => '{{WRAPPER}} .litho-left-menu-wrap',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_menu_container_border',
					'selector'      => '{{WRAPPER}} .litho-left-menu-wrap',
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_container_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-left-menu-wrap'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .litho-left-menu-wrap'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_menu_container_shadow',
					'selector'      => '{{WRAPPER}} .litho-left-menu-wrap',
				]
			);

			$this->add_control(
				'litho_menu_scrollbar_theme',
				[
					'label'         => __( 'Scrollbar Theme', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'default'       => 'dark',
					'options'       => [
						'dark'      => [
							'title'     => __( 'dark', 'litho-addons' ),
							'icon'      => 'fa-solid fa-moon',
						],
						'light'     => [
							'title'     => __( 'Light', 'litho-addons' ),
							'icon'      => 'fa-solid fa-sun',
						],
					],
					'separator'     => 'before'
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
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > a',
				]
			);
			$this->start_controls_tabs( 'menu_top_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_top_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_top_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > a'   => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > span.menu-toggle::before'   => 'background-color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > span.menu-toggle::after'    => 'background-color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > a:before'    => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_top_menu_icon_color',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_top_menu_border',
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_top_menu_shadow',
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					$this->add_control(
						'litho_menu_top_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0:hover > a'   => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0:hover > a:before' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_top_menu_icon_color_hover',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0:hover > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_top_menu_border_hover',
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_top_menu_shadow_hover',
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0:hover',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					$this->add_control(
						'litho_menu_top_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-item > a, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-parent > a, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-ancestor > a'   => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-item > a:before, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-parent > a:before, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-ancestor > a:before' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_top_menu_icon_color_active',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-item > a > i, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-parent > a > i, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-ancestor > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-item, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-parent, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_top_menu_border_active',
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-item, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-parent, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_top_menu_shadow_active',
							'selector'      => '{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-item, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-parent, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-ancestor',
						]
					);
					$this->add_responsive_control(
						'litho_menu_top_menu_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-item, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-parent, {{WRAPPER}} .litho-left-menu-wrap li.item-depth-0.current-menu-ancestor'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > a'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .litho-left-menu-wrap li.item-depth-0 > a'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_sub_menu_style',
				[
					'label'         => __( '2nd Level', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_menu_sub_menu_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1 > a',
				]
			);
			$this->start_controls_tabs( 'litho_menu_sub_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_sub_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_sub_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1 > a'   => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1 > span.menu-toggle::before'   => 'background-color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1 > span.menu-toggle::after'    => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_sub_menu_icon_color',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1 > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_border',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_shadow',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_sub_menu_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_sub_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1:hover > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_sub_menu_icon_color_hover',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1:hover > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_border_hover',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_shadow_hover',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1:hover',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					$this->add_control(
						'litho_menu_sub_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-item > a, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-parent > a, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-ancestor > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_sub_menu_icon_color_active',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-item > a > i, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-parent > a > i, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-ancestor > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_border_active',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_shadow_active',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-ancestor',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1.current-menu-ancestor'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
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
						'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1 > a'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li.item-depth-1 > a'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li > a',
				]
			);
			$this->start_controls_tabs( 'litho_menu_sub_menu_third_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_sub_menu_third',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_sub_menu_third_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li > a'   => 'color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li > span.menu-toggle::before'   => 'background-color: {{VALUE}};',
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li > span.menu-toggle::after'    => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_sub_menu_third_icon_color',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_third_border',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_third_shadow',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_third_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_sub_menu_third_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_menu_sub_menu_third_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li:hover > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_sub_menu_third_icon_color_hover',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li:hover > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_third_border_hover',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_third_shadow_hover',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li:hover',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_third_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					$this->add_control(
						'litho_menu_sub_menu_third_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-item > a, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-parent > a, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-ancestor > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_menu_sub_menu_third_icon_color_active',
						[
							'label'         => __( 'Icon color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-item > a > i, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-parent > a > i, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-ancestor > a > i'   => 'color: {{VALUE}};',
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
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_third_border_active',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-ancestor',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_sub_menu_third_shadow_active',
							'selector'      => '{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-ancestor',
						]
					);
					$this->add_responsive_control(
						'litho_menu_sub_menu_third_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-item, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-parent, {{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li.current-menu-ancestor'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li > a'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .litho-left-menu ul.sub-menu-item > li > ul.sub-menu-item > li > a'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render left menu widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$args        = array();
			$settings    = $this->get_settings_for_display();
			$litho_menu  = $this->get_settings( 'litho_menu' );
			$menus_array = $this->get_menus_list();

			$litho_menu_scrollbar_theme = $settings['litho_menu_scrollbar_theme'] ? $settings['litho_menu_scrollbar_theme'] : 'dark';

			if ( ! isset( $litho_menu ) || count( $menus_array ) == 0 ) {
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

			$this->add_render_attribute(
				[
					'navigation-wrapper' => [
						'class' => [
							'litho-left-menu-wrap navbar-expand-lg navbar-container'
						],
						'data-scrollbar-theme' => $litho_menu_scrollbar_theme,
					],
				]
			);

			if ( class_exists( 'LithoAddons\Classes\Left_Menu_Frontend_Walker' ) ) {

				$args = apply_filters(
					'litho_left_menu_frontend_args',
					array(
						'container'   => 'ul',
						'items_wrap'  => '<ul id="%1$s" class="%2$s alt-font litho-left-menu" role="menu">%3$s</ul>',
						'before'      => '',
						'after'       => '',
						'link_before' => '',
						'link_after'  => '',
						'fallback_cb' => false,
						'walker'      => new Left_Menu_Frontend_Walker(),
					)
				);
			}
			$args = array_merge( $defaults_args, $args );

			?><div <?php $this->print_render_attribute_string( 'navigation-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<div id="navbarLeftNav" class="litho-left-menu-wrapper navbar-collapse collapse" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu( $args ); ?>
				</div>
			</div><?php
		}

		/**
		 * Return availbale menus list
		 */
		public function get_menus_list() {

			$menus      = wp_get_nav_menus();
			$menus_list = wp_list_pluck( $menus, 'name', 'slug' );
			$parent     = isset( $_GET['parent_menu'] ) ? absint( $_GET['parent_menu'] ) : 0;//phpcs:ignore

			if ( 0 < $parent && isset( $menus_list[ $parent ] ) ) {
				unset( $menus_list[ $parent ] );
			}

			return $menus_list;
		}
	}
}
