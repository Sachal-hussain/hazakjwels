<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Hamburger Menu.
 *
* @package Litho
 */

// If class `Left_Menu_Toggle` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Left_Menu_Toggle' ) ) {
	/**
	 * Litho Menu Toggle
	 */
	class Left_Menu_Toggle extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-left-menu-toggle';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Left Menu Toggle', 'litho-addons' );
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
			return [ 'menu', 'nav', 'navigation', 'hamburger', 'toggle' ];
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
				'litho_hamburger_menu_settings_section',
				[
					'label' => __( 'Close Icon', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_close_icon',
				[
					'label'            => __( 'Close Icon', 'litho-addons' ),
					'type'             => Controls_Manager::ICONS,
					'label_block'      => true,
					'show_label'       => false,
					'fa4compatibility' => 'icon',
					'default'    => [
						'value'   => 'fa-solid fa-times',
						'library' => 'fa-solid',
					],
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
				'litho_left_menu_container_style_section',
				[
					'label'      => __( 'Toggle Style', 'litho-addons' ),
					'tab'        => Controls_Manager::TAB_STYLE,
					'show_label' => false,
				]
			);
			$this->add_control(
				'litho_left_menu_toggle_color',
				[
					'label'     => __( 'Toggle Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .navbar-toggler-line' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'litho_menu_toggle_icon_text_heading',
				[
					'label'     => __( 'Toggle Icon with Text', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
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
					'label'      => __( 'Margin', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'rem', 'em', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .toggle-menu-word' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_left_menu_toggle_close_icon_style_section',
				[
					'label' => __( 'Close Icon', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_left_menu_toggle_close_icon_tabs_styles' );
				$this->start_controls_tab(
					'litho_left_menu_toggle_close_icon_normal',
					[
						'label' => __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_left_menu_toggle_close_icon_color',
					[
						'label'     => __( 'Color', 'litho-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'.navbar-collapse-show {{WRAPPER}} .navbar-toggler-line' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_left_menu_toggle_close_icon_hover',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_left_menu_toggle_close_icon_color_hover',
					[
						'label'     => __( 'Color', 'litho-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'.navbar-collapse-show {{WRAPPER}} .navbar-toggler:hover .navbar-toggler-line, .navbar-collapse-show {{WRAPPER}} .navbar-toggler:focus .navbar-toggler-line' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * Render Left menu toggle widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {
			$settings = $this->get_settings_for_display();
			?>
			<!-- Start navbar toggler -->
			<?php
			if ( isset( $settings['litho_toggle_icon_text'] ) && ! empty( $settings['litho_toggle_icon_text'] ) ) {
					echo '<div class="toggle-menu-word alt-font">' . esc_html( $settings['litho_toggle_icon_text'] ) . '</div>';
			}
			?>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLeftNav" aria-controls="navbarLeftNav" aria-label="<?php echo esc_html__( 'Toggle navigation', 'litho-addons' ); ?>">
				<span class="navbar-toggler-line"></span>
				<span class="navbar-toggler-line"></span>
				<span class="navbar-toggler-line"></span>
				<span class="navbar-toggler-line"></span>
			</button>
			<!-- End navbar toggler -->
			<?php
		}
	}
}
