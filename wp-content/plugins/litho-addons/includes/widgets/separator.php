<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for separator.
 *
* @package Litho
 */

// If class `Separator` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Separator' ) ) {

	class Separator extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve separator widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-separator';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve separator widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Separator', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve separator widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-ellipsis-v';
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
			return [ 'separator', 'divider', 'hr', 'line', 'border' ];
		}

		/**
		 * Register separator widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_separator_content_section',
				[
					'label' 		=> __( 'Separator', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_enable_separator',
				[
					'label' 		=> __( 'Enable Separator', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default'		=> 'yes',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_separator_general_style_section',
				[
					'label'         => __( 'Style', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_responsive_control(
				'litho_display_settings' ,
				[
					'label'			=> __( 'Display', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'options' 		=> [
						'' 				=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors'		=> [
						'{{WRAPPER}} .separator-wrap .separator-line' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'litho_separator_color',
				[
					'label'     	=> __( 'Color', 'litho-addons' ),
					'type'      	=> Controls_Manager::COLOR,
					'default'		=> '#FF0000',
					'selectors' 	=> [
						'{{WRAPPER}} .separator-line' => 'background-color: {{VALUE}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_separator_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px', 'custom' ],
					'range' 		=> [
							'px' 		=> [
								'min'	=> 1,
								'max' 	=> 100,
							],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .separator-line' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_separator_height',
				[
					'label' 		=> __( 'Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px', 'custom' ],
					'range' 		=> [
							'px' 		=> [
								'min'	=> 10,
								'max' 	=> 200,
							],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .separator-line' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_separator_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .separator-line' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render separator widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings 			= $this->get_settings_for_display();
			$enable_separator	= ( isset( $settings['litho_enable_separator'] ) && $settings['litho_enable_separator'] ) ? $settings['litho_enable_separator'] : '';
			?>
			<?php if ( 'yes' === $enable_separator ) { ?>
				<div class="separator-wrap"><div class="separator-line"></div></div>
			<?php } ?>
			<?php
			
		}
	}
}