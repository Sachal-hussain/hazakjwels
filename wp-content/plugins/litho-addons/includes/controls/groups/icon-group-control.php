<?php
namespace LithoAddons\Controls\Groups;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Litho icon group control.
 *
 * A base control for creating icon control. Displays input fields to define
 * icon or image.
 *
 * @package Litho
 */

// If class `Icon_Group_Control` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Controls\Groups\Icon_Group_Control' ) ) {

	/**
	 * Define Icon_Group_Control class
	 */
	class Icon_Group_Control {

		public static function icon_fields( $element, $name = '', $default_arr = array() ) {

			$prefix = '';
			if ( ! empty( $name ) ) {
				$prefix = 'litho_' . $name . '_';
			} else {
				$prefix = 'litho_';
			}

			if ( empty( $default_arr ) ) {

				$default_arr = array(
					'value'   => 'fa-solid fa-star',
					'library' => 'fa-solid',
				);
			}

			$element->add_control(
				$prefix . 'custom_image',
				[
					'label'        => __( 'Custom Image?', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_off'    => __( 'No', 'litho-addons' ),
					'label_on'     => __( 'Yes', 'litho-addons' ),
					'return_value' => 'yes',
				]
			);

			$element->add_control(
				$prefix . 'icons',
				[
					'label'            => __( 'Icon', 'litho-addons' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default'          => $default_arr,
					'condition'        => [
						$prefix . 'custom_image' => '',
					],
				]
			);

			$element->add_control(
				$prefix . 'image',
				[
					'label'     => __( 'Choose Image', 'litho-addons' ),
					'type'      => Controls_Manager::MEDIA,
					'dynamic'   => [
						'active' => true,
					],
					'default' 		=> [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						$prefix . 'custom_image!' => '',
					],
				]
			);
			$element->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => $prefix . 'image',
					'default'   => 'large',
					'separator' => 'none',
					'condition' => [
						$prefix . 'custom_image!' => '',
					],
				]
			);
			$element->add_control(
				$prefix . '_image_size',
				[
					'label'      => __( 'Size', 'litho-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'condition'  => [
						$prefix . 'custom_image!' => '',
					],
					'size_units' => [ 'px', '%', 'custom' ],
					'range'      => [
						'px' => [
							'min' => 1,
							'max' => 500,
						],
						'%' => [
							'max' => 100,
							'min' => 1,
						],
					],
					'default'   => [
						'unit' => '%',
						'size' => 25,
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_control(
				$prefix . 'icon_view',
				[
					'label'   => __( 'View', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'default' => __( 'Default', 'litho-addons' ),
						'stacked' => __( 'Stacked', 'litho-addons' ),
						'framed'  => __( 'Framed', 'litho-addons' ),
					],
					'default'   => 'default',
					'condition' => [
						$prefix . 'custom_image' => '',
					],
					'prefix_class' => 'elementor-view-',
				]
			);
			$element->add_control(
				$prefix . 'icon_shape',
				[
					'label' 		=> __( 'Shape', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'circle' 	=> __( 'Circle', 'litho-addons' ),
						'square' 	=> __( 'Square', 'litho-addons' ),
					],
					'default' 		=> 'circle',
					'condition' 	=> [
						$prefix . 'icon_view!'	 => 'default',
						$prefix . 'custom_image' => '',
					],
					'prefix_class' 	=> 'elementor-shape-',
				]
			);
			$element->add_control(
				$prefix . 'icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 300 ] ],
					'condition' 	=> [
						$prefix . 'custom_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_control(
				$prefix . 'icon_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'em' => [ 'min' => 0, 'max' => 5 ] ],
					'condition' 	=> [
						$prefix . 'custom_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->start_controls_tabs( 'icon_tabs' );
			$element->start_controls_tab(
				$prefix . 'icon_colors_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
					'condition' 	=> [
						$prefix . 'custom_image' => '',
					],
				]
			);
			$element->add_responsive_control(
				$prefix . 'icon_primary_color',
				[
					'label' 		=> __( 'Primary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' 	=> [
						$prefix . 'custom_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
				$prefix . 'icon_secondary_color',
				[
					'label' 		=> __( 'Secondary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' 	=> [
						$prefix . 'icon_view!' 		=> 'default',
						$prefix . 'custom_image' 	=> '',
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon'     => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon'     => 'color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$element->end_controls_tab();
			$element->start_controls_tab(
				$prefix . 'icon_colors_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
					'condition' 	=> [
						$prefix . 'custom_image' => '',
					],
				]
			);

			$element->add_responsive_control(
				$prefix . 'icon_hover_primary_color',
				[
					'label' 		=> __( 'Primary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' 	=> [
						$prefix . 'custom_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
				$prefix . 'icon_hover_secondary_color',
				[
					'label' 		=> __( 'Secondary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' 	=> [
						$prefix . 'icon_view!'   => 'default',
						$prefix . 'custom_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' 	   => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' 	   => 'color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$element->add_control(
				$prefix . 'icon_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type' 			=> Controls_Manager::HOVER_ANIMATION,
					'condition' 	=> [
						$prefix . 'custom_image' => '',
					],
				]
			);
			$element->end_controls_tab();
			$element->end_controls_tabs();
		}

		/**
		 * Render icon group control output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access public
		 */
		public static function render_icon_content( $element, $name = '' ) {

			$prefix = '';
			if ( ! empty( $name ) ) {
				$prefix = 'litho_' . $name . '_';
			} else {
				$prefix = 'litho_';
			}

			$settings = $element->get_settings_for_display();

			$element->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );
			if ( ! empty( $settings[ $prefix . 'icon_hover_animation' ] ) ) {
				$element->add_render_attribute( 'icon-wrapper', 'class', [ 'hvr-' . $settings[ $prefix . 'icon_hover_animation' ] ] );
			}
			if ( ! empty( $settings['icon'] ) ) {
				$element->add_render_attribute( 'icon', 'class', $settings['icon'] );
				$element->add_render_attribute( 'icon', 'aria-hidden', 'true' );
			}

			$migrated = isset( $settings['__fa4_migrated'][ $prefix . 'icons' ] );
			$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( ! empty( $settings[ $prefix . 'icons' ]['value'] ) ) {

				?><div <?php $element->print_render_attribute_string( 'icon-wrapper' ); ?>><?php

				if ( $is_new || $migrated ) {
					Icons_Manager::render_icon( $settings[ $prefix . 'icons' ], [ 'aria-hidden' => 'true' ] );
				} else {
					?><i <?php $element->print_render_attribute_string( 'icon' ); ?>></i><?php
				}
				?></div><?php
			} elseif ( ! empty( $settings[ $prefix . 'custom_image' ] ) ) {
				?>
				<div class="elementor-icon">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', $prefix . 'image' ); // phpcs:ignore ?>
				</div>
				<?php
			}
		}
	}
}
