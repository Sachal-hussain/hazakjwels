<?php
namespace LithoAddons\Controls\Groups;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Litho button group control.
 *
 * A base control for creating button control.
 *
 * @package Litho
 */

// If class `Button_Group_Control` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Controls\Groups\Button_Group_Control' ) ) {

	/**
	 * Define Button_Group_Control class
	 */
	class Button_Group_Control {

		/**
		 * Get button sizes.
		 *
		 * Retrieve an array of button sizes for the button widget.
		 *
		 * @access public
		 * @static
		 *
		 * @return array An array containing button sizes.
		 */
		public static function get_button_sizes() {
			return [
				'default' => __( 'Default', 'litho-addons' ),
				'xs'      => __( 'Extra Small', 'litho-addons' ),
				'sm'      => __( 'Small', 'litho-addons' ),
				'md'      => __( 'Medium', 'litho-addons' ),
				'lg'      => __( 'Large', 'litho-addons' ),
				'xl'      => __( 'Extra Large', 'litho-addons' ),
			];
		}

		public static function button_content_fields( $element, $button_type = 'primary', $section_label = 'Button' ) {

			$prefix = 'litho_' . $button_type . '_';

			$element->start_controls_section(
				$prefix . '_button_section',
				[
					'label' => $section_label,
				]
			);

			$element->add_control(
				$prefix . 'button_text',
				[
					'label'       => __( 'Text', 'litho-addons' ),
					'type'        => Controls_Manager::TEXT,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Click here', 'litho-addons' ),
				]
			);
			$element->add_control(
				$prefix . 'button_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic'       => [
						'active' => true,
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'default' 		=> [
						'url' 		=> '#',
					],
				]
			);
			$element->add_control(
				$prefix . 'button_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'sm',
					'options' 		=> self::get_button_sizes(),
					'style_transfer'=> true,
				]
			);
			$element->add_control(
				$prefix . 'button_icon',
				[
					'label' 			=> __( 'Icon', 'litho-addons' ),
					'type' 				=> Controls_Manager::ICONS,
					'label_block' 		=> true,
					'fa4compatibility' 	=> 'icon',
				]
			);
			$element->add_control(
				$prefix . 'button_icon_align',
				[
					'label' 		=> __( 'Icon Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'left',
					'options' 		=> [
						'left' 			=> __( 'Before', 'litho-addons' ),
						'right' 		=> __( 'After', 'litho-addons' ),
					],
					'condition' 	=> [
						$prefix . 'button_icon[value]!' => '',
					],
				]
			);
			$element->add_responsive_control(
				$prefix . 'button_icon_spacing',
				[
					'label' 		=> __( 'Icon Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' => [ 'max' => 200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .'. $prefix .'button.elementor-align-icon-right i'   => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .'. $prefix .'button.elementor-align-icon-left i' 	  => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .'. $prefix .'button.elementor-align-icon-right svg' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .'. $prefix .'button.elementor-align-icon-left svg'  => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_responsive_control(
				$prefix . 'button_width',
				[
					'label'			=> __( 'Width', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'range'			=> [ 'px'   => [ 'min' => 10, 'max' => 200 ], '%'   => [ 'min' => 10, 'max' => 100 ] ],
					'selectors'		=> [
						'{{WRAPPER}} a.'. $prefix .'button:not(.btn-custom-effect), {{WRAPPER}} a.'. $prefix .'button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.'. $prefix .'button.hvr-btn-expand-ltr:before' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->end_controls_section();
		}

		public static function button_style_fields( $element, $button_type = 'primary', $section_label = 'Button' ) {

			$prefix = 'litho_' . $button_type . '_';

			$element->start_controls_section(
				$prefix . 'section_style',
				[
					'label' => $section_label,
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);
			$element->start_controls_tabs( $prefix . 'button_tabs' );
			$element->start_controls_tab(
				$prefix . 'button_normal',
				[
					'label' => __( 'Normal', 'litho-addons' ),
				]
			);
			$element->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => $prefix . 'typography',
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}} a.' . $prefix . 'button, {{WRAPPER}} .' . $prefix . 'button',
				]
			);
			$element->add_control(
				$prefix . 'button_text_color',
				[
					'label'     => __( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} a.' . $prefix . 'button' => 'color: {{VALUE}}; fill: {{VALUE}};',
					],
				]
			);
			$element->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => $prefix . 'button_background_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} a.'. $prefix .'button:not(.btn-custom-effect), {{WRAPPER}} a.' . $prefix . 'button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.' . $prefix . 'button.hvr-btn-expand-ltr:before',
				]
			);
			$element->end_controls_tab();
			$element->start_controls_tab(
				$prefix . 'button_hover',
				[
					'label' => __( 'Hover', 'litho-addons' ),
				]
			);
			$element->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => $prefix . 'typography_hover',
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}} a.' . $prefix . 'button:hover, {{WRAPPER}} .' . $prefix . 'button:hover',
				]
			);
			$element->add_control(
				$prefix . 'button_hover_text_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} a.' . $prefix . 'button:hover' => 'color: {{VALUE}}; fill: {{VALUE}}',
					],
				]
			);
			$element->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => $prefix . 'button_hover_background_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} a.' . $prefix . 'button:not(.btn-custom-effect):hover, {{WRAPPER}} a.' . $prefix . 'button.btn-custom-effect:not(.hvr-btn-expand-ltr):hover:before',
				]
			);
			$element->add_control(
				$prefix . 'button_hover_border_color',
				[
					'label'     => __( 'Border Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} a.' . $prefix . 'button:hover' => 'border-color: {{VALUE}};',
					],
				]
			);
			$element->add_control(
				$prefix . 'button_hover_animation',
				[
					'label' => __( 'Hover Animation', 'litho-addons' ),
					'type'  => Controls_Manager::HOVER_ANIMATION,
				]
			);
			$element->end_controls_tab();
			$element->end_controls_tabs();

			$element->add_responsive_control(
				$prefix . 'display' ,
				[
					'label'        	=> __( 'Display', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'options'       => [
						''             => __( 'Default', 'litho-addons' ),
						'block'        => __( 'Block', 'litho-addons' ),
						'inline'       => __( 'Inline', 'litho-addons' ),
						'inline-block' => __( 'Inline Block', 'litho-addons' ),
						'none'         => __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .' . $prefix . 'button' => 'display: {{VALUE}}',
					],
					'separator'     => 'before',
				]
			);

			$element->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => $prefix . 'border',
					'selector' => '{{WRAPPER}} .' . $prefix . 'button',
				]
			);
			$element->add_control(
				$prefix . 'button_border_radius',
				[
					'label'     => __( 'Border Radius', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' => [
						'{{WRAPPER}} a.' . $prefix . 'button:not(.btn-custom-effect), {{WRAPPER}} a.' . $prefix . 'button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.' . $prefix . 'button.hvr-btn-expand-ltr:before' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_responsive_control(
				$prefix . 'button_padding',
				[
					'label'      => __( 'Padding', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .' . $prefix . 'button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$element->add_responsive_control(
				$prefix . 'button_margin',
				[
					'label'      => __( 'Margin', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .' . $prefix . 'button' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$element->end_controls_section();
		}

		public static function render_button_content( $element, $button_type = 'primary' ) {

			$settings = $element->get_settings_for_display();
			$prefix   = 'litho_' . $button_type . '_';

			$element->add_render_attribute(
				[
					$prefix . 'btn_wrapper' => [
						'class' => [
							'elementor-button-wrapper',
							'litho-button-wrapper',
						],
					],
				]
			);

			if ( ! empty( $settings[ $prefix . 'button_link' ]['url'] ) ) {
				$element->add_render_attribute( $prefix . 'button', 'href', $settings[ $prefix . 'button_link' ]['url'] );

				if ( $settings[ $prefix . 'button_link' ]['is_external'] ) {
					$element->add_render_attribute( $prefix . 'button', 'target', '_blank' );
				}

				if ( $settings[ $prefix . 'button_link' ]['nofollow'] ) {
					$element->add_render_attribute( $prefix . 'button', 'rel', 'nofollow' );
				}
			}

			if ( ! empty( $settings['icon'] ) || ! empty( $settings[ $prefix . 'button_icon' ]['value'] ) ) {
				$element->add_render_attribute( $prefix . 'button', 'class', 'elementor-align-icon-' . $settings[ $prefix . 'button_icon_align' ] );
			}

			$element->add_render_attribute( $prefix . 'button', 'class', [ 'elementor-button', $prefix . 'button' ] );
			$element->add_render_attribute( $prefix . 'button', 'role', 'button' );

			if ( ! empty( $settings[ $prefix . 'button_size' ] ) ) {
				$element->add_render_attribute( $prefix . 'button', 'class', 'elementor-size-' . $settings[ $prefix . 'button_size' ] );
			}

			/* Custom Effect */
			$hover_animation_effect_array = litho_custom_hover_animation_effect();

			if ( $element->get_settings( $prefix . 'button_hover_animation') ) {
				$element->add_render_attribute( $prefix . 'button', 'class', 'hvr-' . $element->get_settings( $prefix . 'button_hover_animation' ) );
				if ( in_array( $element->get_settings( $prefix . 'button_hover_animation'), $hover_animation_effect_array ) ) {
					$element->add_render_attribute( $prefix . 'button', 'class', 'btn-custom-effect' );
				}
			}

			if ( $settings[ $prefix . 'button_text' ] || ( ! empty( $settings['icon'] ) || ! empty( $settings[ $prefix . 'button_icon' ]['value'] ) ) ) {
				?><div <?php $element->print_render_attribute_string( $prefix . 'btn_wrapper' ); ?>>
					<a <?php $element->print_render_attribute_string( $prefix . 'button' ); ?>><?php
						self::button_render_text( $element, $button_type );
					?></a>
				</div><?php
			}
		}

		/**
		 * Render button group control output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access public
		 */
		public static function button_render_text( $element, $button_type = 'primary' ) {

			$prefix   = 'litho_' . $button_type . '_';
			$settings = $element->get_settings_for_display();
			$migrated = isset( $settings['__fa4_migrated'][ $prefix . 'button_icon'] );
			$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( ! $is_new && empty( $settings[ $prefix . 'button_icon_align' ] ) ) {
				$settings[ $prefix . 'button_icon_align' ] = $element->get_settings( $prefix . 'button_icon_align' );
			}

			$element->add_render_attribute(
				[
					'content-wrapper' => [
						'class' => 'elementor-button-content-wrapper',
					],
					'icon-align' => [
						'class' => [
							'elementor-button-icon',
							'elementor-align-icon-' . $settings[ $prefix . 'button_icon_align' ],
						],
					],
					'text' => [
						'class' => 'elementor-button-text',
					],
				]
			);

			?>
			<span <?php $element->print_render_attribute_string( 'content-wrapper' ); ?>>
				<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings[ $prefix . 'button_icon' ]['value'] ) ) { ?>
					<span <?php $element->print_render_attribute_string( 'icon-align' ); ?>>
						<?php if ( $is_new || $migrated ) {
							Icons_Manager::render_icon( $settings[ $prefix . 'button_icon' ], [ 'aria-hidden' => 'true' ] );
						} else { ?>
							<i class="<?php echo esc_attr( $settings['icon']['value'] ); ?>" aria-hidden="true"></i>
						<?php } ?>
					</span>
				<?php } ?>
				<?php if ( ! empty( $settings[ $prefix . 'button_text' ] ) ) { ?>
					<span <?php $element->print_render_attribute_string( 'text' ); ?>><?php
						echo sprintf( '%s', esc_html( $settings[ $prefix . 'button_text' ] ) );
					?></span>
				<?php } ?>
			</span>
			<?php
		}
	}
}
