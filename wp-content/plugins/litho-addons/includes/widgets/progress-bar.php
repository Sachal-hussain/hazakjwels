<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for progress bar.
 *
* @package Litho
 */

// If class `Progress_Bar` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Progress_Bar' ) ) {

	class Progress_Bar extends Widget_Base {

		/**
		 * Constructor
		 */
		public function __construct( $data = [], $args = null ) {

			parent::__construct( $data, $args );
			wp_register_script(
				'litho-addons-progressbar',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/js/progressbar.js',
				[ 'elementor-frontend' ],
				LITHO_ADDONS_PLUGIN_VERSION,
				true
			);
		}

		/**
		 * Retrieve the list of scripts the progressbar widget depended on.
		 *
		 * Used to set scripts dependencies required to run the widget.
		 *
		 * @access public
		 *
		 * @return array Widget scripts dependencies.
		 */
		public function get_script_depends() {
			return [ 'litho-addons-progressbar' ];
		}

		/**
		 * Get widget name.
		 *
		 * Retrieve progress bar widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-progress';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve progress bar widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Progress Bar', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve progress bar widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-skill-bar';
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
			return [ 'progress', 'bar', 'skill' ];
		}

		/**
		 * Register progress widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_section_progress',
				[
					'label' 		=> __( 'Progress Bar', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_progress_percent',
				[
					'label' 		=> __( 'Percentage', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'default' 		=> [
						'size' 		=> 50,
						'unit' 		=> '%',
					],
					'label_block' 	=> true,
				]
			);
			$this->add_control(
				'litho_display_percentage',
				[
					'label' 	=> __( 'Display Percentage', 'litho-addons' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'show' 	=> [
							'title' => __( 'Show', 'litho-addons' ),
							'icon' 	=> 'far fa-eye',
						],
						'hide' => [
							'title' => __( 'Hide', 'litho-addons' ),
							'icon' 	=> 'far fa-eye-slash',
						],
					],
					'default' 		=> 'show',
				]
			);
			$this->add_control(
				'litho_inner_text',
				[
					'label' 	=> __( 'Inner Text', 'litho-addons' ),
					'type' 		=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> __( 'e.g. Web Designer', 'litho-addons' ),
					'default' 		=> __( 'Web Designer', 'litho-addons' ),
					'label_block' 	=> true,
				]
			);
			$this->add_control(
				'view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::HIDDEN,
					'default' 		=> 'traditional',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_progress_style',
				[
					'label' 		=> __( 'Progress Bar', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_progress_bar_color_tabs' );
				$this->start_controls_tab(
					'litho_progress_bar_skill_color_tab',
					[
						'label' 		=> __( 'Skill Color', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_bar_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-bar',
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_progress_bar_bg_color_tab',
					[
						'label' 		=> __( 'Background', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'			=> 'litho_bar_bg_color',
						'types'			=> [ 'classic', 'gradient' ],
						'exclude'		=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 		=> '{{WRAPPER}} .elementor-progress-wrapper',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_bar_thickness',
				[
					'label' 		=> __( 'Thickness', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 100 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-progress-bar' 	=> 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .litho-progress-wrapper' 		=> 'height: {{SIZE}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_control(
				'litho_bar_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-progress-bar, {{WRAPPER}} .litho-progress-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_progress_bar_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .litho-progress-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_control(
				'litho_percentage_text_heading',
				[
					'label' 		=> __( 'Percentage Style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition'		=> [
						'litho_display_percentage' => 'show'
					]
				]
			);
			$this->add_control(
				'litho_bar_percentage_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-percentage' => 'color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_display_percentage' => 'show'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'litho_bar_percentage_typography',
					'selector' 		=> '{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-percentage',
					'global' 		=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'exclude' 		=> [
						'line_height',
					],
					'condition'		=> [
						'litho_display_percentage' => 'show'
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_title_style_section',
				[
					'label' 		=> __( 'Inner Text Style', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_title_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-progress-text' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'litho_title_typography',
					'selector' 		=> '{{WRAPPER}} .elementor-progress-text',
					'global' 		=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render progress bar widget output on the frontend.
		 * Make sure value does no exceed 100%.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();

			$progress_percentage = is_numeric( $settings['litho_progress_percent']['size'] ) ? $settings['litho_progress_percent']['size'] : '0';
			
			if ( 100 < $progress_percentage ) {
				$progress_percentage = 100;
			}

			$this->add_render_attribute( 'wrapper', [
				'class'          => [ 'elementor-progress-wrapper', 'litho-progress-wrapper' ],
				'role'           => 'progressbar',
				'aria-valuemin'  => '0',
				'aria-valuemax'  => '100',
				'aria-valuenow'  => $progress_percentage,
				'aria-valuetext' => $this->get_settings( 'litho_inner_text' )
			] );

			$this->add_render_attribute( 'wrapper', [
				'class' => 'progress-style-1'
			] );

			$this->add_render_attribute( 'progress-bar', [
				'class'    => 'elementor-progress-bar',
				'data-max' => $progress_percentage
			] );

			$this->add_render_attribute( 'litho_inner_text', [
				'class' => 'elementor-progress-text'
			] );

			$this->add_inline_editing_attributes( 'litho_inner_text' );
			?>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<div <?php $this->print_render_attribute_string( 'progress-bar' ); ?>>
					<?php if ( $this->get_settings( 'litho_inner_text' ) ) { ?>
						<span <?php $this->print_render_attribute_string( 'litho_inner_text' ); ?>><?php echo esc_html( $this->get_settings( 'litho_inner_text' ) ); ?></span>
					<?php } ?>
					<?php if ( 'hide' !== $this->get_settings( 'litho_display_percentage' ) ) { ?>
						<span class="elementor-progress-percentage"><?php echo esc_html( $progress_percentage ); ?>%</span>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}
