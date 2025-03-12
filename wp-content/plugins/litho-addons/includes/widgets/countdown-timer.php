<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for countdown timer.
 *
 * @package Litho
 */

// If class `CountDown_Timer` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\CountDown_Timer' ) ) {

	class CountDown_Timer extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-countdown';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Countdown Timer', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-countdown';
		}

		/**
		 * Retrieve the list of scripts the countdown timer widget depended on.
		 *
		 * Used to set scripts dependencies required to run the widget.
		 *
		 * @access public
		 *
		 * @return array Widget scripts dependencies.
		 */
		public function get_script_depends() {
			return [ 'elementor-frontend' ];
		}

		/**
		 * Retrieve the widget categories.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return array Widget categories.
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
			return [ 'countdown', 'timer', 'count', 'number' ];
		}

		/**
		 * Register countdown timer widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_countdown_general_section',
				[
					'label' => __( 'Countdown', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_countdown_styles',
				[
					'label'         => __( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'countdown-style-1'         => __( 'Style 1', 'litho-addons' ),
						'countdown-style-2'         => __( 'Style 2', 'litho-addons' ),
					], 
					'default'       => 'countdown-style-1',
					'frontend_available' => true,
				]
			);

			$default_date = date(
				'Y-m-d', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS )
			);

			$this->add_control(
				'litho_due_date',
				[
					'label'             => __( 'Timer end date', 'litho-addons' ),
					'type'              => Controls_Manager::DATE_TIME,
					'dynamic'           => [
						'active' => true
					],
					'default'           => $default_date,
					'picker_options'    => [
						'enableTime'    => false,
					],
				]
			);
			$this->add_control(
				'litho_countdown_hide_separator',
				[
					'label'        => __( 'Hide Separator', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'condition'    => [ 'litho_countdown_styles' => 'countdown-style-1' ] // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_countdown_settings_section',
				[
					'label'     => __( 'Settings', 'litho-addons' ),
				]
			);

			$this->start_controls_tabs( 'litho_countdown_tabs' );
				$this->start_controls_tab( 'litho_countdown_day_tab', [ 'label' => __( 'Day', 'litho-addons' ) ] );
					$this->add_control(
						'litho_countdown_day_show',
						[
							'label'         => __( 'Show Day', 'litho-addons' ),
							'type'          => Controls_Manager::SWITCHER,
							'description'   => __( 'Select Yes to Show Day.', 'litho-addons' ),
							'label_on'      => __( 'Yes', 'litho-addons' ),
							'label_off'     => __( 'No', 'litho-addons' ),
							'return_value'  => 'yes',
							'default'       => 'yes',
						]
					);
					$this->add_control(
						'litho_countdown_day_label',
						[               
							'label'         => __( 'Day Label', 'litho-addons' ),
							'type'          => Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'default'       => __( 'Day', 'litho-addons' ),
							'condition'     => [
								'litho_countdown_day_show' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_countdown_hours_tab', [ 'label' => __( 'Hours', 'litho-addons' ) ] );
					$this->add_control(
						'litho_countdown_hours_show',
						[
							'label'         => __( 'Show Hours', 'litho-addons' ),
							'type'          => Controls_Manager::SWITCHER,
							'description'   => __( 'Select Yes to Show Hours.', 'litho-addons' ),
							'label_on'      => __( 'Yes', 'litho-addons' ),
							'label_off'     => __( 'No', 'litho-addons' ),
							'return_value'  => 'yes',
							'default'       => 'yes',
						]
					);
					$this->add_control(
						'litho_countdown_hours_label',
						[               
							'label'         => __( 'Hours Label', 'litho-addons' ),
							'type'          => Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'default'       => __( 'Hours', 'litho-addons' ),
							'condition'     => [
								'litho_countdown_hours_show' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_countdown_minutes_tab', [ 'label' => __( 'Minutes', 'litho-addons' ) ] );
					$this->add_control(
						'litho_countdown_minutes_show',
						[
							'label'         => __( 'Show Minutes', 'litho-addons' ),
							'type'          => Controls_Manager::SWITCHER,
							'description'   => __( 'Select Yes to Show Minutes.', 'litho-addons' ),
							'label_on'      => __( 'Yes', 'litho-addons' ),
							'label_off'     => __( 'No', 'litho-addons' ),
							'return_value'  => 'yes',
							'default'       => 'yes',
						]
					);
					$this->add_control(
						'litho_countdown_minutes_label',
						[               
							'label'         => __( 'Minutes Label', 'litho-addons' ),
							'type'          => Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'default'       => __( 'Minutes', 'litho-addons' ),
							'condition'     => [
								'litho_countdown_minutes_show' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_countdown_seconds_tab', [ 'label' => __( 'Seconds', 'litho-addons' ) ] );
					$this->add_control(
						'litho_countdown_seconds_show',
						[
							'label'         => __( 'Show Seconds', 'litho-addons' ),
							'type'          => Controls_Manager::SWITCHER,
							'description'   => __( 'Select Yes to Show Seconds.', 'litho-addons' ),
							'label_on'      => __( 'Yes', 'litho-addons' ),
							'label_off'     => __( 'No', 'litho-addons' ),
							'return_value'  => 'yes',
							'default'       => 'yes',
						]
					);
					$this->add_control(
						'litho_countdown_seconds_label',
						[               
							'label'         => __( 'Seconds Label', 'litho-addons' ),
							'type'          => Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true
							],
							'default'       => __( 'Seconds', 'litho-addons' ),
							'condition'     => [
								'litho_countdown_seconds_show' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_countdown_general_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_responsive_control(
				'litho_countdown_items_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'center',
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
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper' => 'text-align: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_countdown_items_color',
				[
					'label'         => __( 'Background Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box' => 'background-color: {{VALUE}};',
					]   
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'          => 'litho_countdown_items_box_shadow',
					'selector'      => '{{WRAPPER}} .elementor-countdown-wrapper .counter-box',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_countdown_items_border',
					'selector'      => '{{WRAPPER}} .elementor-countdown-wrapper .counter-box',
				]
			);
			$this->add_control(
				'litho_countdown_items_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px'    => [ 'min'   => 0, 'max'   => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box' => 'border-radius: {{SIZE}}{{UNIT}};',
					],               
				]
			);
			$this->add_control(
				'litho_countdown_items_width',
				[
					'label'         => __( 'Number Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [ 'min' => 0, 'max' => 500 ],
						'%'  => [ 'min' => 0, 'max' => 100 ],
					],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box .number' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_countdown_items_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_countdown_items_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_countdown_digits_style_section',
				[
					'label'         => __( 'Digits', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_countdown_digits_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box .number' => 'color: {{VALUE}};',
					]   
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_countdown_digits_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .elementor-countdown-wrapper .counter-box .number',
				]
			);
			$this->add_responsive_control(
				'litho_countdown_digits_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box .number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_countdown_digits_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_countdown_labels_style_section',
				[
					'label'         => __( 'Labels', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_countdown_labels_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box span' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_countdown_labels_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .elementor-countdown-wrapper .counter-box span',
				]
			);
			$this->add_responsive_control(
				'litho_countdown_labels_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_countdown_labels_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_countdown_separator_style_section',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [
						'litho_countdown_hide_separator' => '',
						'litho_countdown_styles'         => 'countdown-style-1', // IN
					],
				]
			);

			$this->add_control(
				'litho_countdown_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box:after' => 'color: {{VALUE}};',
					],
					'condition'     => [
						'litho_countdown_styles' => 'countdown-style-1', // IN
					], 
				]
			);
			$this->add_control(
				'litho_countdown_separator_thickness',
				[
					'label'         => __( 'Separator Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px'    => [ 'min'   => 10, 'max'   => 60 ] ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-countdown-wrapper .counter-box:after' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_countdown_styles' => 'countdown-style-1', // IN
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render countdown timer widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                       = $this->get_settings_for_display();
			$countdown_styles               = ( isset( $settings['litho_countdown_styles'] ) && $settings['litho_countdown_styles'] ) ? $settings['litho_countdown_styles'] : 'countdown-style-1';
			$due_date                       = ( isset( $settings['litho_due_date'] ) && $settings['litho_due_date'] ) ? $settings['litho_due_date'] : '';
			$litho_countdown_hide_separator = ( isset( $settings['litho_countdown_hide_separator'] ) && $settings['litho_countdown_hide_separator'] ) ? 'hide-separator' : '';
			$day_label                      = ( isset( $settings['litho_countdown_day_label'] ) && $settings['litho_countdown_day_label'] ) ? $settings['litho_countdown_day_label'] : esc_html__( 'Day', 'litho-addons' );
			$hours_label                    = ( isset( $settings['litho_countdown_hours_label'] ) && $settings['litho_countdown_hours_label'] ) ? $settings['litho_countdown_hours_label'] : esc_html__( 'Hours', 'litho-addons' );
			$minutes_label                  = ( isset( $settings['litho_countdown_minutes_label'] ) && $settings['litho_countdown_minutes_label'] ) ? $settings['litho_countdown_minutes_label'] : esc_html__( 'Minutes', 'litho-addons' );
			$seconds_label                  = ( isset( $settings['litho_countdown_seconds_label'] ) && $settings['litho_countdown_seconds_label'] ) ? $settings['litho_countdown_seconds_label'] : esc_html__( 'Seconds', 'litho-addons' );

			$data_settings = array(
				'day_show'      => $this->get_settings( 'litho_countdown_day_show' ),
				'minutes_show'  => $this->get_settings( 'litho_countdown_minutes_show' ),
				'hours_show'    => $this->get_settings( 'litho_countdown_hours_show' ),
				'seconds_show'  => $this->get_settings( 'litho_countdown_seconds_show' ),
				'day_label'     => $day_label,
				'hours_label'   => $hours_label,
				'minutes_label' => $minutes_label,
				'seconds_label' => $seconds_label,
			);

			$this->add_render_attribute(
				[
					'wrapper' => [
						'class'         => [
							'elementor-countdown-wrapper',
							'countdown',
						],
						'data-enddate'  => $due_date,
						'data-settings' => json_encode( $data_settings ),
					],
				]
			);

			switch ( $countdown_styles ) {
				case 'countdown-style-1':
					$this->add_render_attribute(
						[
							'wrapper' => [
								'class' => [
									'counter-box-1',
									$litho_countdown_hide_separator,
								],
							],
						]
					);
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>></div>
					<?php
					break;
				case 'countdown-style-2':
					$this->add_render_attribute(
						[
							'wrapper' => [
								'class' => [
									'counter-box-2',
								],
							],
						]
					);
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>></div>
					<?php
					break;
			}
		}
	}
}
