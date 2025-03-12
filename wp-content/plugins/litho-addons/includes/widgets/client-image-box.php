<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for client box.
 *
 * @package Litho
 */

// If class `Client_Image_Box` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Client_Image_Box' ) ) {

	class Client_Image_Box extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve client box widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-client-box';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve client box widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Client Image Box', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve client box widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-gallery-grid';
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
			return [ 'image' ];
		}

		/**
		 * Register client box widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_client_box_section',
				[
					'label' => __( 'Client Box', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_client_box_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'client-logo-style-1',
					'options'     	=> [
						'client-logo-style-1' => __( 'Style 1', 'litho-addons' ),
						'client-logo-style-2' => __( 'Style 2', 'litho-addons' ),
						'client-logo-style-3' => __( 'Style 3', 'litho-addons' ),
					],
					'label_block' 	=> true,
				]
			);
			$this->add_control(
				'litho_client_box_image',
				[
					'label'   		=> __( 'Image', 'litho-addons' ),
					'type'    		=> Controls_Manager::MEDIA,
					'dynamic'		=> [
							'active' => true,
						],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
				]
			);
			$this->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'default' 		=> [
						'url' 		=> '',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'separator' 	=> 'none',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_client_box_section_style',
				[
					'label' 		=> __( 'Style', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'litho_client_box_styles' );
				$this->start_controls_tab(
					'litho_client_box_normal',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
						'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-2', 'client-logo-style-3' ] ], // IN
					]
				);
					$this->add_control(
						'litho_client_box_opacity',
						[
							'label' 		=> __( 'Opacity', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max' 	=> 1,
									'step' 	=> 0.01,
								],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .client-box'  => 'opacity: {{SIZE}};',
							],
							'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-2', 'client-logo-style-3' ] ], // IN
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'litho_client_box_hover',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
						'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-2', 'client-logo-style-3' ] ], // IN
					]
				);
					$this->add_control(
						'litho_client_box_hover_opacity',
						[
							'label' 		=> __( 'Opacity', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max' => 1,
									'step' => 0.01,
								],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .client-box:hover'  => 'opacity: {{SIZE}};',
							],
							'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-2', 'client-logo-style-3' ] ], // IN
						]
					);
					$this->add_control(
						'litho_client_box_hover_animation',
						[
							'label' 		=> __( 'Hover Animation', 'litho-addons' ),
							'type'			=> Controls_Manager::HOVER_ANIMATION,
							'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-2', 'client-logo-style-3' ] ], // IN
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter::get_type(),
						[
							'name' 			=> 'litho_client_box_css_filters_hover',
							'selector' 		=> '{{WRAPPER}} .client-box:hover img',
							'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-2', 'client-logo-style-3' ] ], // IN
						]
					);
					$this->add_control(
						'litho_client_box_hover_transition',
						[
							'label'         => __( 'Transition Duration', 'litho-addons' ),
							'type'          => Controls_Manager::SLIDER,
							'default'       => [
								'size'          => 0.6,
							],
							'range'         => [
								'px'        => [
									'max'       => 3,
									'step'      => 0.1,
								],
							],
							'render_type'   => 'ui',
							'selectors'     => [
								'{{WRAPPER}} .client-box' => 'transition-duration: {{SIZE}}s',
							],
							'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-2', 'client-logo-style-3' ] ], // IN
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_client_box_border_color',
				[
					'label'         => __( 'Border Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .client-box' => 'border-color: {{VALUE}};',
					],
					'condition'     => [ 'litho_client_box_style' => [ 'client-logo-style-1' ] ], // IN
				]
			);
			$this->add_control(
				'litho_client_box_overlay_heading',
				[
					'label'     => __( 'Client Overlay', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [ 'litho_client_box_style' => [ 'client-logo-style-2' ] ]
				]
			);        
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'           => 'litho_client_box_overlay_bg_color',
					'types'          => [ 'classic', 'gradient' ],
					'selector'       => '{{WRAPPER}} .client-box .client-overlay',
					'fields_options' => [
						'background' => [
							'frontend_available' => true,
						],
					],
					'condition'      => [ 'litho_client_box_style' => [ 'client-logo-style-2' ] ]
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render client box widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			$this->add_render_attribute( 'wrapper', 'class', [ $settings['litho_client_box_style'] ] );

			if ( ! empty( $settings['litho_client_box_image']['id'] ) ) {

				$srcset_data                = litho_get_image_srcset_sizes( $settings['litho_client_box_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_client_box_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_client_box_image']['id'], 'litho_thumbnail', $settings );
				$litho_client_box_image_alt = Control_Media::get_image_alt( $settings['litho_client_box_image'] );
				$litho_client_box_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s class="client-box-image" />', esc_url( $litho_client_box_image_url ), esc_attr( $litho_client_box_image_alt ), $srcset_data ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			} elseif ( ! empty( $settings['litho_client_box_image']['url'] ) ) {

				$litho_client_box_image_url = $settings['litho_client_box_image']['url'];
				$litho_client_box_image_alt = '';
				$litho_client_box_image     = sprintf( '<img src="%1$s" alt="%2$s" class="client-box-image" />', esc_url( $litho_client_box_image_url ), esc_attr( $litho_client_box_image_alt ) );
			}

			if ( ! empty( $settings['litho_link']['url'] ) ) {
				$this->add_link_attributes( 'link', $settings['litho_link'] );
			}

			$this->add_render_attribute( 'overlay', [
				'class' => [ 'client-overlay' ],
			] );

			if ( $this->get_settings( 'litho_client_box_hover_animation' ) ) {
				$this->add_render_attribute( 'overlay', 'class', 'hvr-' . $this->get_settings( 'litho_client_box_hover_animation' ) );
			}

			switch ( $settings['litho_client_box_style'] ) {
				case 'client-logo-style-1':
				default:
					?><div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<div class="client-box"><?php
							if ( ! empty( $litho_client_box_image ) ) {
								if ( ! empty( $settings['litho_link']['url'] ) ) {
									?><a <?php $this->print_render_attribute_string( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
								}
									echo sprintf( '%s', $litho_client_box_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

								if ( ! empty( $settings['litho_link']['url'] ) ) {
									?></a><?php
								}
							}
						?></div>
					</div><?php
					break;
				case 'client-logo-style-2':
					?><div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<div class="client-box"><?php
							if ( ! empty( $litho_client_box_image ) ) {
								if ( ! empty( $settings['litho_link']['url'] ) ) {
									?><a <?php $this->print_render_attribute_string( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
								}
									echo sprintf( '%s', $litho_client_box_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

								if ( ! empty( $settings['litho_link']['url'] ) ) {
									?></a><?php
								}
							}
							?><span <?php $this->print_render_attribute_string( 'overlay' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>></span>
						</div>
					</div><?php
					break;
			}
		}
	}
}
