<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for pie chart.
 *
* @package Litho
 */

// If class `Pie_Chart` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Pie_Chart' ) ) {

	class Pie_Chart extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve pie chart widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-pie-chart';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve pie chart widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Pie Chart', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve pie chart widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-loading';
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
			return [ 'chart', 'canvas', 'pie', 'figure', 'graph' ];
		}

		/**
		 * Register pie chart widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_pie_chart_content_section',
				[
					'label'         => __( 'Content', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_pie_chart_title',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'   => true,
					'default'       => __( 'Write title here', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_pie_chart_content',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'type'          => Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
					    'active' => true
					],
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_show_vertical_separator',
				[
					'label'         => __( 'Show Vertical Separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_pie_chart_general_style',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_chart_text_align',
				[
					'label' 		=> __( 'Text Align', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
						'left' 		=> [
							'title' 	=> __( 'Left', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-left',
						],
						'center' 	=> [
							'title'	 	=> __( 'Center', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-center',
						],
						'right' 	=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-right',
						],
					],
					'default' 		=> 'center',
					'selectors' 	=> [
						'{{WRAPPER}} .pie-charts' => 'text-align: {{VALUE}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_pie_chart_style',
				[
					'label'		=> __( 'Chart', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_pie_chart_track_color',
				[
					'label'     => __( 'Track Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#EDEDED',
				]
			);
			$this->add_control(
				'litho_pie_chart_start_color',
				[
					'label'     => __( 'Start Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#B783FF',
				]
			);
			$this->add_control(
				'litho_pie_chart_end_color',
				[
					'label'         => __( 'End Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'   	=> '#FF9393',
				]
			);
			$this->add_control(
				'litho_pie_chart_line_width',
				[
					'label'         => __( 'Line Width', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => 10,
					'min' 			=> 1,
					'max' 			=> 20,
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_pie_chart_percent',
				[
					'label'         => __( 'Percent', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => 75,
					'min' 			=> 1,
					'max' 			=> 100,
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_pie_chart_size',
				[
					'label'			=> __( 'Size', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'default' 		=> [ 'unit' => 'px', 'size' => 180 ],
					'range'			=> [ 'px'	=> [ 'min' => 100, 'max' => 300 ] ],
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_spacing',
				[
					'label'			=> __( 'Spacing', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'			=> [ 'px'	=> [ 'min' => 10, 'max' => 300 ], '%'	=> [ 'min' => 1, 'max' => 100 ] ],
					'selectors'		=> [
						'{{WRAPPER}} .chart-canvas:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					]
				]
			);		
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_pie_chart_number_style_section',
				[
					'label'         => __( 'Number', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_pie_chart_number_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .chart-percent .percent',
				]
			);
			$this->add_control(
				'litho_pie_chart_number_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .chart-percent .percent' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'          => 'litho_pie_chart_number_shadow',
					'selector'      => '{{WRAPPER}} .chart-percent .percent',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_pie_chart_title_style_section',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_pie_chart_title_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .chart-text .chart-title',
				]
			);
			$this->add_control(
				'litho_pie_chart_title_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .chart-text .chart-title' => 'color: {{VALUE}};',
					],
				]
			);
			 $this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'          => 'litho_pie_chart_title_shadow',
					'selector'      => '{{WRAPPER}} .chart-text .chart-title',
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .chart-text .chart-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .chart-text .chart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_pie_chart_content_style_section',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_pie_chart_content_typography',
					'selector'  => '{{WRAPPER}} .chart-text .chart-content',
				]
			);
			$this->add_control(
				'litho_pie_chart_content_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .chart-text .chart-content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_content_width',
				[
					'label' 	=> __( 'Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .chart-text .chart-content' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .chart-text .chart-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .chart-text .chart-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_pie_chart_separator_style_section',
				[
					'label'         => __( 'Vertical Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_show_vertical_separator'   => [ 'yes' ],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_pie_chart_separator_background',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .chart-text .vertical-separator',
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_separator_thickness',
				[
					'label'         => __( 'Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 10 ] ],
					'selectors'     => [
						'{{WRAPPER}} .chart-text .vertical-separator' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_pie_chart_separator_height',
				[
					'label'         => __( 'Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px' => [ 'min' => 20, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .chart-text .vertical-separator' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render pie chart widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                    = $this->get_settings_for_display();
			$chart_size                  = $settings['litho_pie_chart_size']['size'];
			$litho_pie_chart_line_width  = $this->get_settings( 'litho_pie_chart_line_width' );
			$litho_pie_chart_percent     = $this->get_settings( 'litho_pie_chart_percent' );
			$litho_pie_chart_track_color = $this->get_settings( 'litho_pie_chart_track_color' );
			$litho_pie_chart_start_color = $this->get_settings( 'litho_pie_chart_start_color' );
			$litho_pie_chart_end_color   = $this->get_settings( 'litho_pie_chart_end_color' );
			$chart_size                  = ( $chart_size ) ? $chart_size : 180;
			$litho_pie_chart_line_width  = ( $litho_pie_chart_line_width ) ? $litho_pie_chart_line_width : 10;
			$litho_pie_chart_percent     = ( $litho_pie_chart_percent ) ? $litho_pie_chart_percent : 75;
			$litho_pie_chart_track_color = ( $litho_pie_chart_track_color ) ? $litho_pie_chart_track_color : '#EDEDED';
			$litho_pie_chart_start_color = ( $litho_pie_chart_start_color ) ? $litho_pie_chart_start_color : '#B783FF';
			$litho_pie_chart_end_color   = ( $litho_pie_chart_end_color ) ? $litho_pie_chart_end_color : '#FF9393';

			$this->add_render_attribute(
				[
					'chart-settings' => [
						'class'            => [ 'chart' ],
						'data-line-width'  => $litho_pie_chart_line_width,
						'data-percent'     => $litho_pie_chart_percent,
						'data-track-color' => $litho_pie_chart_track_color,
						'data-start-color' => $litho_pie_chart_start_color,
						'data-end-color'   => $litho_pie_chart_end_color,
					],
				]
			);
			?>
			<div class="pie-charts" data-size="<?php echo esc_attr( $chart_size ); ?>">
				<div class="chart-canvas-inner">
					<div class="chart-canvas chart-percent">
						<span <?php $this->print_render_attribute_string( 'chart-settings' ); ?>>
							<span class="percent"></span>
						</span>
					</div>
					<div class="chart-text">
						<?php if ( 'yes' === $this->get_settings( 'litho_show_vertical_separator' ) ) { ?>
							<span class="vertical-separator"></span>
						<?php } ?>
						<?php if ( $this->get_settings( 'litho_pie_chart_title' ) ) { ?>
							<span class="chart-title"><?php echo esc_html( $this->get_settings( 'litho_pie_chart_title' ) ); ?></span>
						<?php } ?>
						<?php if ( $this->get_settings( 'litho_pie_chart_content' ) ) { ?>
							<div class="chart-content"><?php echo sprintf( '%s', wp_kses_post( $this->get_settings( 'litho_pie_chart_content' ) ) ); ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
