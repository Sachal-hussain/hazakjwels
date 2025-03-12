<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for accordion.
 *
 * @package Litho
 */

// If class `Accordion` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Accordion' ) ) {

	/**
	 * Define Accordion class.
	 */
	class Accordion extends Widget_Base {

		/**
		 * Constructor
		 */
		public function __construct( $data = [], $args = null ) {

			parent::__construct( $data, $args );
			wp_register_script(
				'litho-addons-accordion',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/js/accordion.js',
				[ 'elementor-frontend' ],
				LITHO_ADDONS_PLUGIN_VERSION,
				true
			);
		}

		/**
		 * Retrieve the list of scripts the accordian widget depended on.
		 *
		 * Used to set scripts dependencies required to run the widget.
		 *
		 * @access public
		 *
		 * @return array Widget scripts dependencies.
		 */
		public function get_script_depends() {
			return [ 'litho-addons-accordion' ];
		}

		/**
		 * Get widget name.
		 *
		 * Retrieve accordion widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-accordion';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve accordion widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return esc_html__( 'Litho Accordion', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve accordion widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-accordion';
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
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the widget belongs to.
		 *
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'accordion', 'tabs', 'toggle' ];
		}

		/**
		 * Register accordion widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_general_section',
				[
					'label' => esc_html__( 'General', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_accordion_style',
				[
					'label'         => esc_html__( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'accordion-style-1',
					'options'       => [
						'accordion-style-1'	=> esc_html__( 'Style 1', 'litho-addons' ),
						'accordion-style-2'	=> esc_html__( 'Style 2', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'litho_accordion_active',
				[
					'label'         => esc_html__( 'Enable Default Active', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => esc_html__( 'Yes', 'litho-addons' ),
					'label_off'     => esc_html__( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'prefix_class' 	=> 'elementor-default-active-',
					'description'	=> esc_html__( 'Changes will be reflected in the preview only after the page reload.', 'litho-addons' ),
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_title',
				[
					'label' 	=> esc_html__( 'Accordion', 'litho-addons' ),
				]
			);

			$repeater = new Repeater();
			$repeater->add_control(
				'litho_tab_title',
				[
					'label' 		=> esc_html__( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' => true
					],
					'default' 		=> esc_html__( 'Accordion Title', 'litho-addons' ),
					'label_block' 	=> true,
				]
			);
			$repeater->add_control(
				'litho_tab_content',
				[
					'label' 		=> esc_html__( 'Description', 'litho-addons' ),
					'type'	 		=> Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
						'active' => true
					],
					'default' 		=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_tabs',
				[
					'label' 		=> esc_html__( 'Accordion Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_tab_title' 		=> esc_html__( 'Accordion #1', 'litho-addons' ),
							'litho_tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
						],
						[
							'litho_tab_title' 		=> esc_html__( 'Accordion #2', 'litho-addons' ),
							'litho_tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
						],
					],
					'title_field' 	=> '{{{ litho_tab_title }}}',
					'condition'     => [ 'litho_accordion_style!' => [ 'accordion-style-2' ] ]
				]
			);

			$repeater_style2 = new Repeater();
			$repeater_style2->add_control(
				'litho_tab_panel_time',
				[
					'label' 		=> esc_html__( 'Time', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default' 		=> esc_html__( '06:00 - 07:00', 'litho-addons' ),
					'label_block' 	=> true,
				]
			);
			$repeater_style2->add_control(
				'litho_tab_panel_title',
				[
					'label' 		=> esc_html__( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default' 		=> esc_html__( 'Accordion Title', 'litho-addons' ),
					'label_block' 	=> true,
				]
			);
			$repeater_style2->add_control(
				'litho_tab_panel_speaker',
				[
					'label' 		=> esc_html__( 'Speaker', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default' 		=> esc_html__( 'By Edward watson', 'litho-addons' ),
					'label_block' 	=> true,
				]
			);
			$repeater_style2->add_control(
				'litho_tab_panel_content',
				[
					'label' 		=> esc_html__( 'Description', 'litho-addons' ),
					'type'	 		=> Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
						'active' => true
					],
					'default' 		=> esc_html__( 'Accordion Content', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_tabs_style4',
				[
					'label' 		=> esc_html__( 'Accordion Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater_style2->get_controls(),
					'default' 		=> [
						[
							'litho_tab_panel_time' 	=> esc_html__( '06:00 - 07:00', 'litho-addons' ),
							'litho_tab_panel_title' 	=> esc_html__( 'Accordion #1', 'litho-addons' ),
							'litho_tab_panel_speaker' 	=> esc_html__( 'By ThemeZaa', 'litho-addons' ),
							'litho_tab_panel_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
						],
						[
							'litho_tab_panel_time' 	=> esc_html__( '08:00 - 09:00', 'litho-addons' ),
							'litho_tab_panel_title' 	=> esc_html__( 'Accordion #2', 'litho-addons' ),
							'litho_tab_panel_speaker' 	=> esc_html__( 'By ThemeZaa', 'litho-addons' ),
							'litho_tab_panel_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
						],
					],
					'title_field' 	=> '{{{ litho_tab_panel_title }}}',
					'condition'     => [ 'litho_accordion_style' => [ 'accordion-style-2' ] ]
				]
			);

			$this->add_control(
				'litho_view',
				[
					'label' 		=> esc_html__( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::HIDDEN,
					'default' 		=> 'traditional',
				]
			);

			$this->add_control(
				'litho_selected_icon',
				[
					'label' 		=> esc_html__( 'Icon', 'litho-addons' ),
					'type'		 	=> Controls_Manager::ICONS,
					'separator' 	=> 'before',
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-plus',
						'library' 		=> 'fa-solid',
					],
					'recommended' 	=> [
							'fa-solid' 	=> [
								'chevron-down',
								'angle-down',
								'angle-double-down',
								'caret-down',
								'caret-square-down',
							],
							'fa-regular' => [
								'caret-square-down',
							],
					],
					'skin' 			=> 'inline',
					'label_block' 	=> false,
				]
			);

			$this->add_control(
				'litho_selected_active_icon',
				[
					'label' 		=> esc_html__( 'Active Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::ICONS,
					'fa4compatibility' => 'icon_active',
					'default' 		=> [
							'value' 	=> 'fa-solid fa-minus',
							'library' 	=> 'fa-solid',
					],
					'recommended' 	=> [
							'fa-solid' 	=> [
								'chevron-up',
								'angle-up',
								'angle-double-up',
								'caret-up',
								'caret-square-up',
							],
							'fa-regular' => [
								'caret-square-up',
							],
					],
					'skin' 			=> 'inline',
					'label_block' 	=> false,
					'condition' 	=> [
							'litho_selected_icon[value]!' => '',
					],
				]
			);

			$this->add_control(
				'litho_title_html_tag',
				[
					'label' 		=> esc_html__( 'Title HTML Tag', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'h1'  => 'H1',
						'h2'  => 'H2',
						'h3'  => 'H3',
						'h4'  => 'H4',
						'h5'  => 'H5',
						'h6'  => 'H6',
						'div' => 'div',
					],
					'default' 		=> 'div',
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_title_style',
				[
					'label' 	=> esc_html__( 'Accordion', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_accordion_background_tabs' );
				$this->start_controls_tab( 'litho_accordion_background_normal_tab', [ 'label' => esc_html__( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_accordion_background',
						[
							'label' 	=> esc_html__( 'Background', 'litho-addons' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_accordion_background_active_tab', [ 'label' => esc_html__( 'Active', 'litho-addons' ) ] );
					$this->add_control(
						'litho_section_active_accordion_background',
						[
							'label' 	=> esc_html__( 'Background', 'litho-addons' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-active' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_accordion_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_accordion_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_accordion_border_radius',
				[
					'label'			=> esc_html__( 'Border Radius', 'litho-addons' ),
					'type'			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'			=> 'litho_accordion_box_shadow',
					'exclude'		=> [
						'box_shadow_position',
					],
					'selector'		=> '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_toggle_style_title',
				[
					'label' 	=> esc_html__( 'Title', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_title_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-title',
				]
			);
			$this->start_controls_tabs( 'litho_accordion_title_tabs' );
				$this->start_controls_tab( 'litho_accordion_title_normal_tab', [ 'label' => esc_html__( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_title_color',
						[
							'label' 	=> esc_html__( 'Color', 'litho-addons' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .elementor-accordion .elementor-tab-title'	=> 'color: {{VALUE}};',
								'{{WRAPPER}} .elementor-accordion-icon, {{WRAPPER}} a'	=> 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'      => 'litho_title_border',
							'selector'  => '{{WRAPPER}} .elementor-accordion .elementor-tab-title',
						]
					);
					$this->add_responsive_control(
						'litho_title_padding',
						[
							'label' 	=> esc_html__( 'Padding', 'litho-addons' ),
							'type' 		=> Controls_Manager::DIMENSIONS,
							'size_units'=> [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors' => [
								'{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_accordion_title_active_tab', [ 'label' => esc_html__( 'Active', 'litho-addons' ) ] );
				$this->add_control(
					'litho_tab_active_color',
					[
						'label' 	=> esc_html__( 'Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' 					=> 'color: {{VALUE}};',
							'{{WRAPPER}} .elementor-active .elementor-accordion-icon, {{WRAPPER}} .elementor-active a' 	=> 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_section_active_accordion_title_color',
					[
						'label' 	=> esc_html__( 'Border Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}};',
						],
						'condition' 	=> [
							'litho_title_border_border!' => '',
						],
					]
				);
				$this->add_responsive_control(
					'litho_section_active_accordion_title_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_toggle_style_icon',
				[
					'label' 	=> esc_html__( 'Icon', 'litho-addons' ),
					'tab'	 	=> Controls_Manager::TAB_STYLE,
					'condition' => [
						'litho_selected_icon[value]!' => '',
					],
				]
			);

			$this->add_control(
				'litho_icon_align',
				[
					'label' 	=> esc_html__( 'Alignment', 'litho-addons' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Start', 'litho-addons' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'End', 'litho-addons' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
					'default' 		=> 'right',
					'toggle' 		=> false,
					'label_block' 	=> false,
				]
			);

			$this->add_control(
				'litho_icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label' 	=> esc_html__( 'Size', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range'	 	=> [ 'px' => [ 'min' => 6, 'max' => 100 ] ],
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_icon_space',
				[
					'label' 	=> esc_html__( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon.elementor-accordion-icon-left'	=> 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' =>[
						'litho_icon_align'			=> [ 'left' ],
						'litho_accordion_style'	=> 'accordion-style-2' // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_space_left',
				[
					'label' 	=> esc_html__( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon.elementor-accordion-icon-left'	=> 'margin-left: {{SIZE}}{{UNIT}};',
					],
					'condition' =>[
						'litho_icon_align'			=> [ 'left' ],
						'litho_accordion_style'	=> 'accordion-style-1' // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_space_right',
				[
					'label' 	=> esc_html__( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon.elementor-accordion-icon-right' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' =>[
						'litho_icon_align' => [ 'right' ],
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_top_space',
				[
					'label' 	=> esc_html__( 'Icon Top Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon'	=> 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_active_heading',
				[
					'label'     => esc_html__( 'Active Icon', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'litho_icon_active_color',
				[
					'label' 	=> esc_html__( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_active_icon_top_space',
				[
					'label' 	=> esc_html__( 'Icon Top Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_toggle_style_content',
				[
					'label' => esc_html__( 'Description', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_content_color',
				[
					'label'     => esc_html__( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-content .panel-tab-content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'litho_content_typography',
					'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-content .panel-tab-content',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'litho_content_border',
					'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-content .panel-tab-content',
				]
			);

			$this->add_responsive_control(
				'litho_content_padding',
				[
					'label'      => esc_html__( 'Padding', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-content .panel-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_content_margin',
				[
					'label'      => esc_html__( 'Margin', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-content .panel-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_time_text_style',
				[
					'label'     => esc_html__( 'Time Text', 'litho-addons' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'litho_accordion_style' => [ 'accordion-style-2' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_time_text_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .elementor-accordion .elementor-tab-title .panel-time',
					'condition' => [
						'litho_accordion_style' => [ 'accordion-style-2' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_time_text_color',
				[
					'label' 	=> esc_html__( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title .panel-time'	=> 'color: {{VALUE}};',
					],
					'condition'     => [
						'litho_accordion_style' => [ 'accordion-style-2' ], // IN
					],
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_section_speaker_text_style',
				[
					'label' 	=> esc_html__( 'Speaker Text', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_accordion_style' => [ 'accordion-style-2' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_speaker_text_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-title .panel-speaker',
					'condition'     => [
						'litho_accordion_style' => [ 'accordion-style-2' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_speaker_text_color',
				[
					'label' 	=> esc_html__( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title .panel-speaker'	=> 'color: {{VALUE}};',
					],
					'condition'     => [
						'litho_accordion_style' => [ 'accordion-style-2' ], // IN
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render accordion widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();
			$litho_accordion_style	= ( isset( $settings['litho_accordion_style'] ) && $settings['litho_accordion_style'] ) ? $settings['litho_accordion_style'] : 'accordion-style-1';
			$migrated = isset( $settings['__fa4_migrated']['litho_selected_icon'] );

			if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
				// @todo: remove when deprecated
				// added as bc in 2.6
				// add old default
				$settings['icon'] 			= 'fa fa-plus';
				$settings['icon_active'] 	= 'fa fa-minus';
				$settings['litho_icon_align'] 	= $this->get_settings( 'litho_icon_align' );
			}

			$is_new 	= empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$has_icon 	= ( ! $is_new || ! empty( $settings['litho_selected_icon']['value'] ) );
			$id_int 	= $this->get_id_int();

			$this->add_render_attribute( 'wrapper', [
				'class' => [ 'elementor-accordion', $litho_accordion_style ],
				'role'	=> 'tablist',
			] );
			?><div <?php $this->print_render_attribute_string( 'wrapper' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				if ( 'accordion-style-2' === $litho_accordion_style ) {
					foreach ( $settings['litho_tabs_style4'] as $index => $item ) {
					
						$tab_count = $index + 1;
						$tab_title_setting_key   = $this->get_repeater_setting_key( 'litho_tab_panel_title', 'litho_tabs_style4', $index );
						$tab_content_setting_key = $this->get_repeater_setting_key( 'litho_tab_panel_content', 'litho_tabs_style4', $index );

						$this->add_render_attribute( $tab_title_setting_key, [
							'id'            => 'elementor-accordion-title-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
							'class'         => [ 'elementor-tab-title' ],
							'data-tab'      => esc_attr( $tab_count ),
							'role'          => 'tab',
							'aria-controls' => 'elementor-accordion-content-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
							'aria-expanded' => 'false',
						] );

						$this->add_render_attribute( $tab_content_setting_key, [
							'id'              => 'elementor-accordion-content-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
							'class'           => [ 'elementor-tab-content', 'elementor-clearfix' ],
							'data-tab'        => esc_attr( $tab_count ),
							'role'            => 'tabpanel',
							'aria-labelledby' => 'elementor-accordion-title-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
						] );
						$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
						
						if ( ! empty( $item['litho_tab_panel_title'] ) || ! empty( $item['litho_tab_panel_content'] ) || ! empty( $item['litho_tab_panel_speaker'] ) || ! empty( $item['litho_tab_panel_time'] ) ) {
						?><div class="elementor-accordion-item">
							<<?php echo $settings['litho_title_html_tag']; ?> <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php
								if ( $has_icon ) {
									?>
									<span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['litho_icon_align'] ); ?>" aria-hidden="true"><?php
									if ( $is_new || $migrated ) { ?>
										<span class="elementor-accordion-icon-closed"><?php
											Icons_Manager::render_icon( $settings['litho_selected_icon'] );
										?></span>
										<span class="elementor-accordion-icon-opened"><?php
											Icons_Manager::render_icon( $settings['litho_selected_active_icon'] );
										?></span><?php
									} else {
									?>
										<i class="elementor-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
										<i class="elementor-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i>
									<?php
									}
									?></span><?php
								}
								if ( ! empty( $item['litho_tab_panel_time'] ) ) {
									?>
									<span class="panel-time"><?php
										echo esc_html( $item['litho_tab_panel_time'] );
									?></span><?php
								}
							if ( ! empty( $item['litho_tab_panel_title'] ) ) {
							?><a href="#" class="accordion-toggle"><?php
								echo esc_html( $item['litho_tab_panel_title'] );
							?></a><?php
							}

							if ( ! empty( $item['litho_tab_panel_speaker'] ) ) {
								?><span class="panel-speaker"><?php
									echo esc_html( $item['litho_tab_panel_speaker'] );
								?></span><?php
							}
							?></<?php echo $settings['litho_title_html_tag']; ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							if ( ! empty( $item['litho_tab_panel_content'] ) ) {
							?><div <?php $this->print_render_attribute_string( $tab_content_setting_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="panel-tab-content"><?php
									echo $this->parse_text_editor( $item['litho_tab_panel_content'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?></div>
							</div><?php
							}
						?></div><?php // .elementor-accordion-item
						}
					}
				} else {
					foreach ( $settings['litho_tabs'] as $index => $item ) {
						
						$tab_count = $index + 1;

						$tab_title_setting_key 		= $this->get_repeater_setting_key( 'litho_tab_title', 'litho_tabs', $index );
						$tab_content_setting_key 	= $this->get_repeater_setting_key( 'litho_tab_content', 'litho_tabs', $index );

						$this->add_render_attribute( $tab_title_setting_key, [
							'id'            => 'elementor-accordion-title-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
							'class'         => [ 'elementor-tab-title' ],
							'data-tab'      => esc_attr( $tab_count ),
							'role'          => 'tab',
							'aria-controls' => 'elementor-accordion-content-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
							'aria-expanded' => 'false',
						] );

						$this->add_render_attribute( $tab_content_setting_key, [
							'id'              => 'elementor-accordion-content-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
							'class'           => [ 'elementor-tab-content', 'elementor-clearfix' ],
							'data-tab'        => esc_attr( $tab_count ),
							'role'            => 'tabpanel',
							'aria-labelledby' => 'elementor-accordion-title-' . esc_attr( $id_int ) . esc_attr( $tab_count ),
						] );
						if ( ! empty( $item['litho_tab_title'] ) || ! empty( $item['litho_tab_content'] ) ) {
						
						?><div class="elementor-accordion-item">
							<<?php echo $settings['litho_title_html_tag']; ?> <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php
								if ( $has_icon ) {
									?>
									<span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['litho_icon_align'] ); ?>" aria-hidden="true"><?php
									if ( $is_new || $migrated ) {
										?>
										<span class="elementor-accordion-icon-closed"><?php
											Icons_Manager::render_icon( $settings['litho_selected_icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										?></span>
										<span class="elementor-accordion-icon-opened"><?php
											Icons_Manager::render_icon( $settings['litho_selected_active_icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										?></span><?php
									} else {
										?>
										<i class="elementor-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
										<i class="elementor-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i><?php
									}
									?></span><?php
								}
							if ( ! empty( $item['litho_tab_title'] ) ) { // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?><a href="#"><?php
								echo sprintf( '%s', esc_html( $item['litho_tab_title'] ) );
							?></a><?php
							}
							?></<?php echo $settings['litho_title_html_tag']; ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							if ( ! empty( $item['litho_tab_content'] ) ) {
							?><div <?php $this->print_render_attribute_string( $tab_content_setting_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="panel-tab-content"><?php
									echo $this->parse_text_editor( $item['litho_tab_content'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?></div>
							</div><?php
							}
						?></div><?php // .elementor-accordion-item
						}
					}
				}
			?></div><?php // .elementor-accordion
		}
	}
}
