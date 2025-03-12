<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for vertical counter.
 *
* @package Litho
 */

// If class `Vertical_Counter` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Vertical_Counter' ) ) {

	class Vertical_Counter extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve vertical counter widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-vertical-counter';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve vertical counter widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Vertical Counter', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve counter widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-counter';
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
			return [ 'counter', 'number', 'random' ];
		}

		/**
		 * Register vertical counter widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_counter',
				[
					'label' 	=> __( 'Counter', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_counter_number',
				[
					'label' 		=> __( 'Counter Number', 'litho-addons' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 1234,
				]
			);
			$this->add_control(
				'litho_number_prefix',
				[
					'label' 		=> __( 'Number Prefix', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> false,
					'default' 		=> '',
					'placeholder' 	=> __( '0', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_number_suffix',
				[
					'label' 		=> __( 'Number Suffix', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> false,
					'default' 		=> '',
					'placeholder' 	=> __( '+', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_strong_title',
				[
					'label' 		=> __( 'Strong Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
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
					'default' 		=> __( 'Cool Number', 'litho-addons' ),
					'placeholder' 	=> __( 'Cool Number', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::HIDDEN,
					'default' 		=> 'traditional',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_general',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
	            'litho_vertical_counter_display_settings' ,
	            [
	                'label'        	=> __( 'Display', 'litho-addons' ),
	                'type'         	=> Controls_Manager::SELECT,
	                'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .vertical-counter-wrapper' => 'display: {{VALUE}}',
					],
	            ]
	        );
	        $this->add_responsive_control(
				'litho_vertical_counter_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => '',
					'options'       => [
						'left'          => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'        => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'         => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .vertical-counter-wrapper' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_number',
				[
					'label' 		=> __( 'Number', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography_number',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .vertical-counter-wrapper .vertical-counter',
				]
			);
			$this->add_control(
				'litho_number_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .vertical-counter-wrapper .vertical-counter' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_vertical_heading_style_number_prefix',
				[
					'label' 		=> __( 'Number prefix style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_vertical_counter_number_prefix_typography',
					'exclude' => [
						'text_transform',
						'text_decoration',
						'letter_spacing'
					],
					'selector'	=> '{{WRAPPER}} .number-prefix',
				]
			);
			$this->add_control(
				'litho_vertical_counter_number_prefix_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .number-prefix' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_vertical_counter_number_prefix_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .number-prefix' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_vertical_heading_style_number_suffix',
				[
					'label' 		=> __( 'Number Suffix style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_vertical_counter_number_suffix_typography',
					'exclude' => [
						'text_transform',
						'text_decoration',
						'letter_spacing'
					],
					'selector'	=> '{{WRAPPER}} .number-suffix',
				]
			);
			$this->add_control(
				'litho_vertical_counter_number_suffix_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .number-suffix' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_vertical_counter_number_suffix_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .number-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_strong_title',
				[
					'label' 		=> __( 'Strong Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_strong_title!' => '',
					],
				]
			);
			$this->add_control(
				'litho_strong_title_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .vertical-counter-wrapper .title span' => 'color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_strong_title!' => '',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography_strong_title',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .vertical-counter-wrapper .title span',
					'condition' 	=> [
						'litho_strong_title!' => '',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_section_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_title_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .vertical-counter-wrapper .title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography_title',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .vertical-counter-wrapper .title',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render vertical counter widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$settings       = $this->get_settings_for_display();
			$counter_number = $this->get_settings( 'litho_counter_number' );

			if ( empty( $counter_number ) ) {
				return;
			}
			$this->add_render_attribute( 'counter', [
				'class' => 'vertical-counter-wrapper',
			] );
			$this->add_render_attribute( 'counter_number', [
				'class'      => [ 'vertical-counter', 'd-inline-flex' ],
				'data-value' => $counter_number,
			] );
			?>
			<div <?php $this->print_render_attribute_string( 'counter' ); ?>>
				<?php if ( ! empty( $this->get_settings( 'litho_number_prefix' ) ) ) { ?>
					<span class="number-prefix"><?php echo esc_html( $this->get_settings( 'litho_number_prefix' ) ); ?></span>
				<?php } ?>
				<div <?php $this->print_render_attribute_string( 'counter_number' ); ?>></div>
				<?php if ( ! empty( $this->get_settings( 'litho_number_suffix' ) ) ) { ?>
					<span class="number-suffix"><?php echo esc_html( $this->get_settings( 'litho_number_suffix' ) ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->get_settings( 'litho_title' ) ) || ! empty( $this->get_settings( 'litho_strong_title' ) ) ) { ?>
					<span class="title">
						<?php if ( ! empty( $this->get_settings( 'litho_strong_title' ) ) ) { ?>
						<span><?php echo esc_html( $this->get_settings( 'litho_strong_title' ) ); ?></span>
						<?php } ?>
						<?php echo esc_html( $this->get_settings( 'litho_title' ) ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}
}
