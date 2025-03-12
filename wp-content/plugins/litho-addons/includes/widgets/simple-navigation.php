<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for simple navigation
 *
 * @package Litho
 */

// If class `Simple_Navigation` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Simple_Navigation' ) ) {
	/**
	 * Define Simple Navigation class
	 */
	class Simple_Navigation extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-simple-navigation';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Simple Navigation', 'litho-addons' );
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
			return [ 'menu', 'nav', 'navigation', 'simple' ];
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
				'litho_menu_general_section',
				[
					'label'         => __( 'Menu', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
				]
			);
			$this->add_control(
				'litho_menu',
				[
					'label'         => __( 'Select Menu', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'label_block'	=> true,
					'default'       => '',
					'options'       => $this->get_menus_list(),
				]
			);
			$this->add_control(
				'litho_header_size',
				[
					'label' 		=> __( 'Title HTML Tag', 'litho-addons' ),
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
					'default' 		=> 'h5'
				]
			);
			$this->add_control(
				'litho_menu_view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'vertical',
					'options' 		=> [
						'vertical' 	=> [
							'title' 	=> __( 'Default', 'litho-addons' ),
							'icon' 		=> 'eicon-ellipsis-v',
						],
						'horizontal' 	=> [
							'title' 	=> __( 'Inline', 'litho-addons' ),
							'icon' 		=> 'eicon-ellipsis-h',
						],
					],
					'prefix_class' 	=> 'elementor-menu-view-',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_container_style_section',
				[
					'label'         => __( 'Menu Container', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_menu_container_background',
					'selector'      => '{{WRAPPER}} .litho-navigation-menu',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_menu_container_border',
					'selector'      => '{{WRAPPER}} .litho-navigation-menu',
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_container_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-menu'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .litho-navigation-menu'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_menu_container_shadow',
					'selector'      => '{{WRAPPER}} .litho-navigation-menu',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_menu_style',
				[
					'label'         => __( 'Menu style', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_menu_simple_menu_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .litho-navigation-menu li > a',
				]
			);
			$this->start_controls_tabs( 'menu_top_menu_state_tabs' );
				$this->start_controls_tab(
					'litho_menu_simple_menu',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_simple_menu_text_color',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-menu li > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_background',
							'types' 		=> [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'fields_options' 	=> [
								'color' 	=> [
									'responsive' => true
								]
							],
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_border',
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_shadow',
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li',
						]
					);
					$this->add_responsive_control(
						'litho_menu_simple_menu_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-menu li'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_simple_menu_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_simple_menu_text_color_hover',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-menu li > a:hover'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_background_hover',
							'types' 		=> [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'fields_options' 	=> [
								'color' 	=> [
									'responsive' => true
								]
							],
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_border_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_shadow_hover',
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li:hover',
						]
					);
					$this->add_responsive_control(
						'litho_menu_simple_menu_border_radius_hover',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-menu li:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_menu_simple_menu_active',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_responsive_control(
						'litho_menu_simple_menu_text_color_active',
						[
							'label'         => __( 'Text color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-menu li.current-menu-item > a'   => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_background_active',
							'types' 		=> [ 'classic', 'gradient' ],
							'exclude'       => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'fields_options' 	=> [
								'color' 	=> [
									'responsive' => true
								]
							],
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li.current-menu-item',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_border_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li.current-menu-item',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_menu_simple_menu_shadow_active',
							'selector'      => '{{WRAPPER}} .litho-navigation-menu li.current-menu-item',
						]
					);
					$this->add_responsive_control(
						'litho_menu_simple_menu_border_radius_active',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .litho-navigation-menu li.current-menu-item'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_menu_simple_menu_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-menu li > a'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_simple_menu_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-navigation-menu li > a'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_menu_section_menu_title_style',
				[
					'label'         => __( 'Title style', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [
						'litho_title!' 	=> ''
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_menu_simple_menu_title_typography',
					'global' 		=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .title',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_menu_simple_menu_title_color',
					'global' 	=> [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'fields_options' 	=> [
						'color' 	=> [
							'responsive' => true
						]
					],
					'selector' 	=> '{{WRAPPER}} .title',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'          => 'litho_menu_simple_menu_title_text_shadow',
					'selector'      => '{{WRAPPER}} .title',
				]
			);
			$this->add_responsive_control(
				'litho_menu_simple_menu_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .title'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_menu_simple_menu_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .title'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			$litho_menu  = $this->get_settings( 'litho_menu' );
			$menus_array = $this->get_menus_list();

			if ( ! isset( $litho_menu ) || 0 == count( (array)$menus_array ) ) {
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
				'litho_simple_navigation_args',
				array(
					'container'   => 'ul',
					'items_wrap'  => '<ul id="%1$s" class="%2$s litho-navigation-menu simple-navigation-menu">%3$s</ul>',
					'before'      => '',
					'after'       => '',
					'link_before' => '',
					'link_after'  => '',
				)
			);

			$args = array_merge( $defaults_args, $args );
			?>
			<?php
			if ( $this->get_settings( 'litho_title' ) ) {
				?>
				<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"><?php echo esc_html( $this->get_settings( 'litho_title' ) ); ?></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php
			}
			wp_nav_menu( $args );
		}
		/**
		 * Return available menus list
		 */
		public function get_menus_list() {

			$menus      = wp_get_nav_menus();
			$menus_list = wp_list_pluck( $menus, 'name', 'slug' );
			$parent     = isset( $_GET['parent_menu'] ) ? absint( $_GET['parent_menu'] ) : 0; // phpcs:ignore

			if ( 0 < $parent && isset( $menus_list[ $parent ] ) ) {
				unset( $menus_list[ $parent ] );
			}

			return $menus_list;
		}
	}
}
