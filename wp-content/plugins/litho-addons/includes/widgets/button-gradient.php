<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for button gradient.
 *
 * @package Litho
 */

// If class `Button_Gradient` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Button_Gradient' ) ) {

	class Button_Gradient extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve button widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-button-gradient';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve button widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Button Gradient', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve button widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-button';
		}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the button widget belongs to.
		 *
		 * Used to determine where to display the widget in the editor.
		 *
		 *
		 * @access public
		 *
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return [ 'litho', 'litho-header' ];
		}

		/**
		 * Get button sizes.
		 *
		 * Retrieve an array of button sizes for the button widget.
		 *
		 *
		 * @access public
		 * @static
		 *
		 * @return array An array containing button sizes.
		 */
		public static function get_button_sizes() {
			return [
				'xs' => __( 'Extra Small', 'litho-addons' ),
				'sm' => __( 'Small', 'litho-addons' ),
				'md' => __( 'Medium', 'litho-addons' ),
				'lg' => __( 'Large', 'litho-addons' ),
				'xl' => __( 'Extra Large', 'litho-addons' ),
			];
		}

		/**
		 * Register button widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_section_button',
				[
					'label' 		=> __( 'Button', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_text',
				[
					'label' 		=> __( 'Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'Click here', 'litho-addons' ),
					'placeholder' 	=> __( 'Click here', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'default' 		=> [
						'url' 		=> '#',
					],
				]
			);
			$this->add_responsive_control(
				'litho_align',
				[
					'label' 		=> __( 'Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left'    	=> [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' 	=> [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' 	=> [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
						'justify' 	=> [
							'title' => __( 'Justified', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-justify',
						],
					],
					'prefix_class' 	=> 'elementor%s-align-',
					'default' 		=> '',
				]
			);
			$this->add_control(
				'litho_size',
				[
					'label' 			=> __( 'Size', 'litho-addons' ),
					'type' 				=> Controls_Manager::SELECT,
					'default' 			=> 'xs',
					'options' 			=> self::get_button_sizes(),
					'style_transfer' 	=> true,
				]
			);
			$this->add_responsive_control(
				'litho_button_width',
				[
					'label'			=> __( 'Width', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'range'			=> [ 'px'   => [ 'min' => 10, 'max' => 200 ], '%'   => [ 'min' => 10, 'max' => 100 ] ],
					'selectors'		=> [
						'{{WRAPPER}} a.elementor-gradient-button:not(.btn-custom-effect), {{WRAPPER}} a.elementor-gradient-button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-gradient-button.hvr-btn-expand-ltr:before' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_button_height',
				[
					'label'			=> __( 'Height', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'range'			=> [ 'px'   => [ 'min' => 10, 'max' => 200 ], '%'   => [ 'min' => 10, 'max' => 100 ] ],
					'selectors'		=> [
						'{{WRAPPER}} a.elementor-gradient-button:not(.btn-custom-effect), {{WRAPPER}} a.elementor-gradient-button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-gradient-button.hvr-btn-expand-ltr:before' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_selected_icon',
				[
					'label' 			=> __( 'Icon', 'litho-addons' ),
					'type' 				=> Controls_Manager::ICONS,
					'label_block' 		=> true,
					'fa4compatibility' 	=> 'icon',
				]
			);
			$this->add_control(
				'litho_icon_align',
				[
					'label' 		=> __( 'Icon Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'left',
					'options' 		=> [
						'left' 		=> __( 'Before', 'litho-addons' ),
						'right' 	=> __( 'After', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_selected_icon[value]!' => '',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_indent',
				[
					'label' 		=> __( 'Icon Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'max' 	=> 50,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-gradient-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-gradient-button .elementor-align-icon-left' 	=> 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);		

			$this->add_control(
				'litho_button_css_id',
				[
					'label' 		=> __( 'Button ID', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> '',
					'title'	 		=> __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'litho-addons' ),
					'label_block' 	=> false,
					'description' 	=> __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'litho-addons' ),
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style',
				[
					'label' 		=> __( 'Button', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-gradient-button, {{WRAPPER}} .elementor-gradient-button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-gradient-button, {{WRAPPER}} .elementor-gradient-button',
				]
			);
			$this->start_controls_tabs( 'litho_tabs_button_style' );
			$this->start_controls_tab(
				'litho_tab_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_button_text_color',
					'selector'	=> '{{WRAPPER}} a.elementor-gradient-button .elementor-gradient-button-text, {{WRAPPER}} .elementor-gradient-button .elementor-gradient-button-text, {{WRAPPER}} a.elementor-gradient-button .elementor-gradient-button-icon i, {{WRAPPER}} .elementor-gradient-button .elementor-gradient-button-icon i, {{WRAPPER}} a.elementor-gradient-button .elementor-gradient-button-icon svg, {{WRAPPER}} .elementor-gradient-button .elementor-gradient-button-icon svg', 
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-gradient-button:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-gradient-button.btn-custom-effect:before, {{WRAPPER}} a.elementor-gradient-button.hvr-btn-expand-ltr:before',
					'fields_options' 	=> [
						'color' 	=> [
							'responsive' => true,
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-gradient-button',
					'fields_options' 	=> [
						'box_shadow' 	=> [
							'responsive' => true,
						],
					],
				]
			);
			$this->add_responsive_control(
				'litho_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-gradient-button:not(.btn-custom-effect), {{WRAPPER}} a.elementor-gradient-button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-gradient-button.hvr-btn-expand-ltr:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tab_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_hover_color',
					'selector'	=> '{{WRAPPER}} a.elementor-gradient-button:hover .elementor-gradient-button-text, {{WRAPPER}} .elementor-gradient-button:hover .elementor-gradient-button-text, {{WRAPPER}} a.elementor-gradient-button:focus .elementor-gradient-button-text, {{WRAPPER}} .elementor-gradient-button:focus .elementor-gradient-button-text, {{WRAPPER}} a.elementor-gradient-button:not(.hvr-btn-expand-ltr):focus .elementor-gradient-button-text, {{WRAPPER}} a.elementor-gradient-button.btn-custom-effect:not(.hvr-btn-expand-ltr):focus:before, {{WRAPPER}} a.elementor-gradient-button:hover .elementor-gradient-button-icon i, {{WRAPPER}} .elementor-gradient-button:hover .elementor-gradient-button-icon i, {{WRAPPER}} .elementor-gradient-button:hover .elementor-gradient-button-icon svg, {{WRAPPER}} a.elementor-gradient-button:hover .elementor-gradient-button-icon svg',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_button_background_hover_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-gradient-button:not(.hvr-btn-expand-ltr):hover, {{WRAPPER}} a.elementor-gradient-button.btn-custom-effect:not(.hvr-btn-expand-ltr):hover:before, {{WRAPPER}} a.elementor-gradient-button:not(.hvr-btn-expand-ltr):focus, {{WRAPPER}} a.elementor-gradient-button.btn-custom-effect:not(.hvr-btn-expand-ltr):focus:before',
					'fields_options' 	=> [
						'color' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_hover_box_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-gradient-button:hover, {{WRAPPER}} .elementor-gradient-button:hover, {{WRAPPER}} a.elementor-gradient-button:focus, {{WRAPPER}} .elementor-gradient-button:focus',
					'fields_options' 	=> [
						'box_shadow' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->add_responsive_control(
				'litho_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-gradient-button:hover, {{WRAPPER}} .elementor-gradient-button:hover, {{WRAPPER}} a.elementor-gradient-button:focus, {{WRAPPER}} .elementor-gradient-button:focus' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_button_hover_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-gradient-button:hover, {{WRAPPER}} .elementor-gradient-button:hover, {{WRAPPER}} a.elementor-gradient-button:focus, {{WRAPPER}} .elementor-gradient-button:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->add_control(
				'litho_button_hover_transition',
				[
					'label'         => __( 'Transition Duration', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [
						'px'        => [
							'max'       => 3,
							'step'      => 0.1,
						],
					],
					'render_type'   => 'ui',
					'selectors'     => [
						'{{WRAPPER}} a.elementor-gradient-button, {{WRAPPER}} .elementor-gradient-button' => 'transition-duration: {{SIZE}}s',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_border',
					'selector' 		=> '{{WRAPPER}} .elementor-gradient-button',
					'fields_options' 	=> [
						'border' 	=> [
							'separator'	=> 'before'
						]
					]
				]
			);
			$this->add_responsive_control(
				'litho_button_icon_size',
				[
					'label' 		=> __( 'Icon Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'max' 	=> 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-gradient-button .elementor-align-icon-right, {{WRAPPER}} .elementor-gradient-button .elementor-align-icon-left' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_selected_icon[value]!' => '',
					],
				]
			);
			$this->add_responsive_control(
				'litho_text_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-gradient-button, {{WRAPPER}} .elementor-gradient-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render button widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			$this->add_render_attribute(
				[
					'wrapper' => [
						'class' => [
							'elementor-gradient-button-wrapper',
						]
					]
				]
			);

			if ( ! empty( $settings['litho_link']['url'] ) ) {
				$this->add_link_attributes( 'button', $settings['litho_link'] );
				$this->add_render_attribute( 'button', 'class', 'elementor-gradient-button-link' );
			} else {
				$this->add_render_attribute( 'button', 'href', '#' );
			}

			$this->add_render_attribute( 'button', 'class', 'elementor-gradient-button' );
			$this->add_render_attribute( 'button', 'role', 'button' );

			if ( ! empty( $settings['litho_button_css_id'] ) ) {
				$this->add_render_attribute( 'button', 'id', $settings['litho_button_css_id'] );
			}

			if ( ! empty( $settings['litho_size'] ) ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['litho_size'] );
			}

			/* Custom Effect */
			$hover_animation_effect_array = litho_custom_hover_animation_effect();
			$custom_animation_class       = '';
			if ( ! empty( $settings['litho_hover_animation'] ) ) {
				$this->add_render_attribute( 'button', 'class', [ 'hvr-' . $settings['litho_hover_animation']] );
				if ( in_array( $settings['litho_hover_animation'], $hover_animation_effect_array ) ) {
					$custom_animation_class = 'btn-custom-effect';
				}
			}
			$this->add_render_attribute( 'button', 'class', [ $custom_animation_class ] );
			?>
				<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore ?>>
					<a <?php $this->print_render_attribute_string( 'button' ); // phpcs:ignore ?>>
						<?php $this->render_text(); // phpcs:ignore ?>
					</a>
				</div>
			<?php
		}

		/**
		 *
		 * Render button widget text.
		 *
		 * @access protected
		 */
		protected function render_text() {

			$settings = $this->get_settings_for_display();

			$migrated = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
			$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( ! $is_new && empty( $settings['litho_icon_align'] ) ) {
				// @todo: remove when deprecated
				// added as bc in 2.6
				// old default
				$settings['litho_icon_align'] = $this->get_settings( 'litho_icon_align' );
			}

			$this->add_render_attribute( [
				'content-wrapper' => [
					'class' => 'elementor-gradient-button-content-wrapper',
				],
				'icon-align' => [
					'class' => [
						'elementor-gradient-button-icon',
						'elementor-align-icon-' . $settings['litho_icon_align'],
					],
				],
				'litho_text' => [
					'class' => 'elementor-gradient-button-text',
				],
			] );

			$this->add_inline_editing_attributes( 'litho_text', 'none' );
			?>
			<span <?php $this->print_render_attribute_string( 'content-wrapper' ); // phpcs:ignore ?>>
				<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
				<span <?php $this->print_render_attribute_string( 'icon-align' ); // phpcs:ignore ?>>
					<?php
					if ( $is_new || $migrated ) {
						Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
					} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
						?><i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i><?php
					}
					?>
				</span>
				<?php endif; ?>
				<?php if ( $settings['litho_text'] ) : ?>
					<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore ?>><?php echo esc_html( $settings['litho_text'] ); ?></span>
				<?php endif; ?>
			</span>
			<?php
		}

		public function on_import( $element ) {
			return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon' );
		}
	}
}
