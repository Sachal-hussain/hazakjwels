<?php
namespace LithoAddons\Classes;

use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use LithoAddons\Controls\Groups\Text_Gradient_Background;

/**
 * Extend Section Features
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Section_Extended` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Classes\Section_Extended' ) ) {

	/**
	 * Define Section_Extended class
	 */
	class Section_Extended {

		public function __construct() {

			add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'litho_add_section_litho_advanced_panel' ], 10, 2 );
			add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'litho_add_section_litho_equal_height_panel' ], 10, 2 );
			add_action( 'elementor/element/section/section_layout/after_section_end', [ $this, 'litho_add_section_litho_settings_tab' ], 10, 2 );
			add_action( 'elementor/frontend/section/before_render', [ $this, 'litho_section_before_render' ], 10, 2 );
		}

		public function litho_add_section_litho_advanced_panel( $element, $args ) {

			$element->start_controls_section(
				'_litho_advanced_tab_style',
				[
					'label' 		=> __( 'Litho Advanced', 'litho-addons' ),
					'tab'	 		=> Controls_Manager::TAB_ADVANCED,
				]
			);
			$element->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type' 			=> Controls_Manager::HOVER_ANIMATION,
					'prefix_class' => 'hvr-',
				]
			);
			$element->end_controls_section();
		}

		public function litho_add_section_litho_equal_height_panel( $element, $args ) {

			$element->start_controls_section(
				'_litho_equal_height_tab_style',
				[
					'label' 		=> __( 'Litho Equal Height', 'litho-addons' ),
					'tab'	 		=> Controls_Manager::TAB_ADVANCED,
				]
			);

			$element->add_control(
				'litho_equal_height_enable',
				[
					'label'			=> __( 'Enable', 'litho-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'description'	=> __( 'Changes will be reflected in the preview only after the page reload.', 'litho-addons' ),
					'default'		=> '',
					'label_on'		=> __( 'Yes', 'litho-addons' ),
					'label_off'		=> __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
				]
			);

			$element->add_control(
				'litho_disable_on_tablet',
				[
					'label'			=> __( 'Disable on Tablet', 'litho-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'default'		=> '',
					'label_on'		=> __( 'Yes', 'litho-addons' ),
					'label_off'		=> __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'condition' => [
						'litho_equal_height_enable' => 'yes',
					]
				]
			);

			$element->add_control(
				'litho_disable_on_mobile',
				[
					'label'			=> __( 'Disable on Mobile', 'litho-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'default'		=> 'yes',
					'label_on'		=> __( 'Yes', 'litho-addons' ),
					'label_off'		=> __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'condition' => [
						'litho_equal_height_enable' => 'yes',
					]
				]
			);

			$element->end_controls_section();
		}

		public function litho_add_section_litho_settings_tab( $element, $args ) {

			$element->update_responsive_control(
				'custom_height',
				[					
					'range'         => [
							'px' => [
								'min' => 0,
								'max' => 1440,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
							'vh' => [
								'min' => 0,
								'max' => 100,
							],
							'vw' => [
								'min' => 0,
								'max' => 100,
							],
					],
					'size_units'    => [ '%', 'px', 'vh', 'vw', 'custom' ]
				]
			);

			$element->start_controls_section(
				'_litho_layout_tab_style',
				[
					'label' 		=> __( 'Litho Settings', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_LAYOUT,
				]
			);

			$element->add_control(
				'litho_top_space' ,
				[
					'label'         => __( 'Top Space', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => '',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'prefix_class'  => 'top-',
					'return_value'  => 'space',
					'description'	=> __( 'Changes will be reflected in the preview only after the page reload.', 'litho-addons' ),
				]
			);

			$element->add_control(
				'litho_parallax' ,
				[
					'label'         => __( 'Parallax', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => '',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'parallax',
					'separator'		=> 'before',
				]
			);

			$element->add_control(
				'litho_parallax_ratio',
				[
					'label'     => __( 'Parallax Ratio', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'default'		=> [
						'unit' => 'px',
						'size' => 0.5,
					],
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 1.5,
							'step' => 0.1,
						],
					],
					'condition' => [
						'litho_parallax' => 'parallax',
					],
				]
			);

			$element->add_control(
				'litho_position_settings' ,
				[
					'label'         => __( 'Position', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
							''          => __( 'Default', 'litho-addons' ),
							'relative'  => __( 'Relative', 'litho-addons' ),
							'absolute'  => __( 'Absolute', 'litho-addons' ),
							'inherit'   => __( 'Inherit', 'litho-addons' ),
							'initial'   => __( 'Initial', 'litho-addons' ),
					],
					'selectors'     => [
						'{{WRAPPER}}' => 'position: {{VALUE}}',
					],
					'separator'		=> 'before',
				]
			);

			$element->end_controls_section();

			$element->start_controls_section(
				'litho_scroll_to_down_tab',
				[
					'label'     => __( 'Scroll To Down', 'litho-addons' ),
					'tab'       => Controls_Manager::TAB_LAYOUT,
				]
			);
			$element->add_control(
				'litho_scroll_to_down',
				[
					'label'         => __( 'Scroll to down?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => '',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
				]
			);
			$element->add_control(
				'litho_scroll_to_down_style_types',
				[
					'label'         => __( 'Select type', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'default',
					'options'       => [
						'default'               => __( 'Default', 'litho-addons' ),
						'scroll-down-type-1'    => __( 'Style 1', 'litho-addons' ),
						'scroll-down-type-2'    => __( 'Style 2', 'litho-addons' ),
						'scroll-down-type-3'    => __( 'Style 3', 'litho-addons' ),
					],
					'condition' => [
						'litho_scroll_to_down' => 'yes',
					],
				]
			);
			$element->add_control(
				'litho_scroll_to_down_text',
				[
					'label'             => __( 'Text', 'litho-addons' ),
					'type'              => Controls_Manager::TEXT,
					'dynamic'       	=> [
						'active' => true,
					],
					'default'           => __( 'Scroll', 'litho-addons' ),
					'label_block'       => false,
					'style_transfer'    => false,
					'condition'         => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => 'scroll-down-type-2', // IN
					],
				]
			);

			$element->add_control(
				'litho_target_id',
				[
					'label'             => __( 'Target id', 'litho-addons' ),
					'type'              => Controls_Manager::TEXT,
					'default'           => 'my-id',
					'placeholder'		=> 'my-id',
					'title'				=> __( 'Add your target id WITHOUT the Hash(#) key. e.g: my-id', 'litho-addons' ),
					'label_block'       => false,
					'style_transfer'    => false,
					'condition'         => [
						'litho_scroll_to_down' => 'yes',
					],
				]
			);
			$element->add_control(
				'litho_custom_image' ,
				[
					'label'         => __( 'Custom Image?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => '',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'condition'     => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types!' => 'scroll-down-type-2', // NOT IN
					],
				]
			);
			$element->add_control(
				'litho_image',
				[
					'label'     => __( 'Upload Image', 'litho-addons' ),
					'type'      => Controls_Manager::MEDIA,
					'dynamic'   => [
						'active' => true,
					],
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'litho_custom_image!' => '',
						'litho_scroll_to_down_style_types!' => 'scroll-down-type-2', // NOT IN
					],
				]
			);
			$element->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'litho_image',
					'default'   => 'full',
					'separator' => 'none',
					'condition' => [
						'litho_custom_image!' => '',
						'litho_scroll_to_down_style_types!' => 'scroll-down-type-2', // NOT IN
					],
				]
			);

			$element->add_control(
				'litho_selected_icon',
				[
					'label'     => __( 'Choose Icon', 'litho-addons' ),
					'type'      => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default'   => [
						'value'     => 'fas fa-arrow-down',
						'library'   => 'fa-solid',
					],
					'condition' => [
						'litho_custom_image'   => '',
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types!' => 'scroll-down-type-2', // NOT IN
					],
				]
			);

			$element->add_responsive_control(
				'litho_selected_icon_size',
				[
					'label'     => __( 'Icon Size', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
					],
					'condition' => [
						'litho_custom_image'   => '',
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types!' => 'scroll-down-type-2', // NOT IN
					],
					'selectors' => [
						'{{WRAPPER}} .scroll-to-next i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_responsive_control(
				'litho_selected_icon_width',
				[
					'label'     => __( 'Icon Width', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 10,
							'max' => 300,
						],
					],
					'condition' => [
						'litho_custom_image'   => '',
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-3' ], // IN
					],
					'selectors' => [
						'{{WRAPPER}} .scroll-to-next a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_scroll_to_down_text_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .scroll-to-down-text',
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_text!' => '',
						'litho_scroll_to_down_style_types' => 'scroll-down-type-2', // IN
					],
				]
			);
			$element->add_control(
				'litho_scroll_text_separator_after',
				[
					'label'         => __( 'Enable separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'condition'     => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_text!' => '',
						'litho_scroll_to_down_style_types' => 'scroll-down-type-2', // IN
					],
				]
			);
			$element->start_controls_tabs( 'litho_scroll' );
			$element->start_controls_tab(
				'litho_scroll_normal',
				[
					'label'     => __( 'Normal', 'litho-addons' ),
					'condition' => [
						'litho_scroll_to_down' => 'yes',
					],
				]
			);
			$element->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'      => 'litho_scroll_to_down_text_color',
					'selector'  => '{{WRAPPER}} .scroll-to-down-text',
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'scroll-down-type-2' ], // IN
					],
				]
			);
			$element->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_scroll_to_down_after_text_seprator_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .scroll-down-type-2.scroll-to-next .section-link.after-text:after',
					'fields_options'    => [
						'background'    => [
							'label' => __( 'Separator Color', 'litho-addons' ),
						],
					],
					'condition' => [
						'litho_scroll_to_down'                 => 'yes',
						'litho_scroll_text_separator_after'    => 'yes',
						'litho_scroll_to_down_text!'           => '',
						'litho_scroll_to_down_style_types'     => [ 'scroll-down-type-2' ], // IN
					],
				]
			);
			$element->add_control(
				'litho_scroll_to_down_color',
				[
					'label'     => __( 'Icon Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .scroll-to-next i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-1', 'scroll-down-type-3' ], // IN
					],
				]
			);
			$element->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_scroll_to_down_bg_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .scroll-to-next a',
					'fields_options'    => [
						'background'    => [
							'label' => __( 'Background Color', 'litho-addons' ),
						],
					],
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-3' ], // IN
					],
				]
			);
			$element->end_controls_tab();

			$element->start_controls_tab(
				'litho_scroll_hover',
				[
					'label'     => __( 'Hover', 'litho-addons' ),
					'condition' => [
						'litho_scroll_to_down' => 'yes',
					],
				]
			);
			$element->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'      => 'litho_scroll_to_down_text_hover_color',
					'selector'  => '{{WRAPPER}} .scroll-to-next a:hover .scroll-to-down-text',
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'scroll-down-type-2' ], // IN
					],
				]
			);

			$element->add_control(
				'litho_scroll_to_down_hover_color',
				[
					'label'     => __( 'Icon Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .scroll-to-next a:hover i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-1', 'scroll-down-type-3' ], // IN
					],
				]
			);
			$element->add_control(
				'litho_scroll_to_down_hover_border_color',
				[
					'label'         => __( 'Border Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'condition' => [
						'litho_scroll_to_down_border_border!'	=> '',
						'litho_scroll_to_down'					=> 'yes',
						'litho_scroll_to_down_style_types'		=> [ 'default', 'scroll-down-type-3' ], // IN
					],
					'selectors'     => [
						'{{WRAPPER}} .scroll-to-next a:hover' => 'border-color: {{VALUE}};',
					],
				]
			);
			$element->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_scroll_to_down_hover_bg_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .scroll-to-next a:hover',
					'fields_options'    => [
						'background'    => [
							'label' => __( 'Background Color', 'litho-addons' ),
						],
					],
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-3' ], //IN
					],
				]
			);
			$element->end_controls_tab();
			$element->end_controls_tabs();

			$element->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_scroll_to_down_border',
					'fields_options' => [
						'border'    => [
							'separator' => 'before',
						],
					],
					'selector'      => '{{WRAPPER}} .scroll-to-next a',
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-3' ], // IN
					],
				]
			);
			$element->add_responsive_control(
				'litho_scroll_to_down_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .scroll-to-next a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-3' ], // IN
					],
				]
			);
			$element->add_responsive_control(
				'litho_scroll_to_down_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem' ],
					'selectors'     => [
						'{{WRAPPER}} .scroll-to-next a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_scroll_to_down'             => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-3' ], // IN
					],
					'separator'     => 'before'
				]
			);
			$element->add_responsive_control(
				'litho_scroll_to_down_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem' ],
					'selectors'     => [
						'{{WRAPPER}} .scroll-to-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'         => [
						'litho_scroll_to_down' => 'yes',
					],
					'separator'     => 'before'
				]
			);
			$element->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_scroll_to_down_box_shadow',
					'selector'      => '{{WRAPPER}} .scroll-to-next a',
					'condition' => [
						'litho_scroll_to_down' => 'yes',
						'litho_scroll_to_down_style_types' => [ 'default', 'scroll-down-type-3' ], // IN
					],
				]
			);
			$element->end_controls_section();
		}

		public function litho_section_before_render( $element ) {

			if ( 'section' === $element->get_name() ) {

				/** Section parallax data attributes **/
				$litho_parallax       = $element->get_settings( 'litho_parallax' );
				$litho_parallax_ratio = $element->get_settings( 'litho_parallax_ratio' );

				if ( 'parallax' === $litho_parallax ) {
					$litho_parallax_ratio = ( isset( $litho_parallax_ratio['size'] ) & ! empty( $litho_parallax_ratio['size'] ) ) ? $litho_parallax_ratio['size'] : 0.5;

					$litho_parallax_config = array(
						'parallax_ratio'    => $litho_parallax_ratio,
						'parallax'          => $litho_parallax
					);

					$element->add_render_attribute(
						'_wrapper', [
							'data-parallax-section-settings' => json_encode( $litho_parallax_config ),
						]
					);
				}
				// END section parallax data attributes.

				// Section scroll to down data attributes.
				$settings                          = $element->get_settings_for_display();
				$litho_scroll_to_down              = $element->get_settings( 'litho_scroll_to_down' );
				$litho_scroll_to_down_style_types  = $element->get_settings( 'litho_scroll_to_down_style_types' );
				$litho_target_id                   = $element->get_settings( 'litho_target_id' );
				$litho_scroll_text_separator_after = $element->get_settings( 'litho_scroll_text_separator_after' );
				$litho_scroll_to_down_text         = $element->get_settings( 'litho_scroll_to_down_text' );
				$litho_custom_image                = $element->get_settings( 'litho_custom_image' );
				$migrated                          = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
				$is_new                            = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

				$litho_icon = '';
				if ( $litho_custom_image ) {
					$litho_icon .= Group_Control_Image_Size::get_attachment_image_html( $settings, 'litho_image' );
				} elseif ( $is_new || $migrated ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
					$litho_icon .= ob_get_clean();
				} else {
					ob_start();
					?>
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
					<?php
					$litho_icon .= ob_get_clean();
				}

				if ( 'yes' === $litho_scroll_to_down ) {

					$litho_scroll_to_down_config = array(
						'scroll_to_down'        => $litho_scroll_to_down,
						'scroll_style_types'    => $litho_scroll_to_down_style_types,
						'scroll_target_id'      => $litho_target_id,
						'scroll_text_separator' => $litho_scroll_text_separator_after,
						'scroll_text'           => $litho_scroll_to_down_text,
						'scroll_custom_image'   => $litho_custom_image,
						'scroll_icon'           => $litho_icon,
					);

					$element->add_render_attribute(
						'_wrapper',
						'data-scroll-to-down-settings',
						json_encode( $litho_scroll_to_down_config )
					);
				}
				// END section scroll to down data attributes.
				/* Start Equal Height */

				$litho_equal_height_enable = $element->get_settings( 'litho_equal_height_enable' );
				$litho_disable_on_tablet   = $element->get_settings( 'litho_disable_on_tablet' );
				$litho_disable_on_mobile   = $element->get_settings( 'litho_disable_on_mobile' );

				if ( 'yes' === $litho_equal_height_enable ) {
					$litho_equal_height_config = array(
						'litho_equal_height_enable' => $litho_equal_height_enable,
						'litho_disable_on_tablet'   => $litho_disable_on_tablet,
						'litho_disable_on_mobile'   => $litho_disable_on_mobile,

					);
					$element->add_render_attribute(
						'_wrapper',
						'data-litho-equal-height-settings',
						json_encode( $litho_equal_height_config )
					);
				}

				/* End Equal Height */
			}
		}
	}
}
