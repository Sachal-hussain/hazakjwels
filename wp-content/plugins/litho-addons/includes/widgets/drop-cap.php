<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for drop cap.
 *
 * @package Litho
 */

// If class `Drop_Cap` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Drop_Cap' ) ) {

	class Drop_Cap extends Widget_Base {

		public function __construct( $data = [], $args = null ) {

			parent::__construct( $data, $args );

			wp_register_script(
				'litho-addons-drop-cap',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/js/drop-cap.js',
				[ 'elementor-frontend' ],
				LITHO_ADDONS_PLUGIN_VERSION,
				true
			);
		}

		/**
		 * Retrieve the list of scripts the drop cap widget depended on.
		 *
		 * Used to set scripts dependencies required to run the widget.
		 *
		 * @access public
		 *
		 * @return array Widget scripts dependencies.
		 */
		public function get_script_depends() {
			return [ 'litho-addons-drop-cap' ];
		}

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-drop-cap';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Drop Cap', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-text';
		}

		/**
		 * Retrieve the widget categories.
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
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'text', 'editor', 'drop-cap', 'letter', 'paragraph', 'character', 'first' ];
		}

		/**
		 * Register text editor widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_section_editor',
				[
					'label' => __( 'Text Editor', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_editor',
				[
					'label' 		=> __( 'Description', 'litho-addons' ),
					'show_label'	=> false,
					'type' 			=> Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
						'active' => true
					],
					'default' 		=> '<p>' . __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ) . '</p>',
				]
			);

			$this->add_control(
				'drop_cap', [
					'label'              => __( 'Drop Cap', 'litho-addons' ),
					'type'               => Controls_Manager::SWITCHER,
					'label_off'          => __( 'Off', 'litho-addons' ),
					'label_on'           => __( 'On', 'litho-addons' ),
					'prefix_class'       => 'elementor-drop-cap-',
					'frontend_available' => true,
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style',
				[
					'label' => __( 'Text Editor', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'litho_align',
				[
					'label' 	=> __( 'Alignment', 'litho-addons' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-justify',
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'litho_text_color',
				[
					'label' 	=> __( 'Text Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}}' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_typography',
					'selector'	=> '{{WRAPPER}} .elementor-text-editor',
				]
			);

			$text_columns = range( 1, 10 );
			$text_columns = array_combine( $text_columns, $text_columns );
			$text_columns[''] = __( 'Default', 'litho-addons' );

			$this->add_responsive_control(
				'litho_text_columns',
				[
					'label' 	=> __( 'Columns', 'litho-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'separator' => 'before',
					'options' 	=> $text_columns,
					'selectors' => [
						'{{WRAPPER}} .elementor-text-editor' => 'columns: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_column_gap',
				[
					'label' 	=> __( 'Columns Gap', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'vw', 'custom' ],
					'range' 	=> [
						'px' => [
							'max' => 100,
						],
						'%' => [
							'max' => 10,
							'step' => 0.1,
						],
						'vw' => [
							'max' => 10,
							'step' => 0.1,
						],
						'em' => [
							'max' => 10,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-text-editor' => 'column-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_drop_cap',
				[
					'label' 	=> __( 'Drop Cap', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
					'condition' => [
						'drop_cap' => 'yes',
					],
				]
			);

			$this->add_control(
				'litho_drop_cap_view',
				[
					'label'		=> __( 'View', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'options'	=> [
						'default'	=> __( 'Default', 'litho-addons' ),
						'stacked'	=> __( 'Stacked', 'litho-addons' ),
						'framed'	=> __( 'Framed', 'litho-addons' ),
					],
					'default'	=> 'default',
					'prefix_class'	=> 'elementor-drop-cap-view-',
				]
			);
			$this->add_control(
				'litho_drop_cap_stripe',
				[
					'label'		=> __( 'Stripe', 'litho-addons' ),
					'type'		=> Controls_Manager::SWITCHER,
					'label_off'	=> __( 'No', 'litho-addons' ),
					'label_on'	=> __( 'Yes', 'litho-addons' ),
					'condition'	=> [
						'litho_drop_cap_view' => 'stacked',
					],
				]
			);
			$this->add_control(
				'litho_drop_cap_primary_color',
				[
					'label'		=> __( 'Primary Color', 'litho-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap, {{WRAPPER}}.elementor-drop-cap-view-default .elementor-drop-cap' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					],
					'global'	=> [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
				]
			);

			$this->add_control(
				'litho_drop_cap_secondary_color',
				[
					'label'		=> __( 'Secondary Color', 'litho-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'color: {{VALUE}};',
						'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap-stripe .elementor-drop-cap-letter:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'litho_drop_cap_view!' => 'default',
					],
				]
			);

			$this->add_responsive_control(
				'litho_drop_cap_size',
				[
					'label'         => __( 'Size', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-drop-cap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'		=> [
						'litho_drop_cap_view!' => 'default',
					],
				]
			);

			$this->add_control(
				'litho_drop_cap_space',
				[
					'label'		=> __( 'Space', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
							'size'	=> 10,
					],
					'range'		=> [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'body:not(.rtl) {{WRAPPER}} .elementor-drop-cap' => 'margin-right: {{SIZE}}{{UNIT}};',
						'body.rtl {{WRAPPER}} .elementor-drop-cap' => 'margin-left: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_drop_cap_border_radius',
				[
					'label'			=> __( 'Border Radius', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ '%', 'px', 'custom' ],
					'default'		=> [
						'unit' => '%',
					],
					'range'			=> [
						'%' => [
							'max' => 50,
						],
					],
					'selectors'		=> [
						'{{WRAPPER}} .elementor-drop-cap' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
					'condition'	=> [
						'litho_drop_cap_view!' => 'default',
					],
				]
			);

			$this->add_control(
				'litho_drop_cap_border_width',
				[
					'label'		=> __( 'Border Width', 'litho-addons' ),
					'type'		=> Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} .elementor-drop-cap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_drop_cap_view' => 'framed',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'litho_drop_cap_typography',
					'selector' => '{{WRAPPER}} .elementor-drop-cap-letter',
					'exclude'  => [
						'letter_spacing',
					],
				]
			);

			$this->end_controls_section();
		}

		/**
		 * Render text editor widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$editor_content = $this->get_settings_for_display( 'litho_editor' );
			$editor_content = $this->parse_text_editor( $editor_content );

			$this->add_render_attribute( 'litho_editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );

			$this->add_inline_editing_attributes( 'litho_editor', 'advanced' );

			$drop_cap              = $this->get_settings( 'drop_cap' );
			$litho_drop_cap_stripe = $this->get_settings( 'litho_drop_cap_stripe' );

			if ( $drop_cap && $litho_drop_cap_stripe ) {
				$this->add_render_attribute( 'litho_editor', 'class', [ 'elementor-drop-cap-stripe' ] );
			}
			?>
			<div <?php $this->print_render_attribute_string( 'litho_editor' ); ?>><?php echo sprintf( '%s', wp_kses_post( $editor_content ) ); ?></div> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php
		}

		/**
		 * Render text editor widget as plain content.
		 *
		 * Override the default behavior by printing the content without rendering it.
		 *
		 * @access public
		 */
		public function render_plain_content() {
			// In plain mode, render without shortcode.
			echo $this->get_settings( 'litho_editor' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
