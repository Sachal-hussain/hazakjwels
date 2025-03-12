<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for liquid image.
 *
* @package Litho
 */

// If class `Liquid_Image` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Liquid_Image' ) ) {

	class Liquid_Image extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve liquid image widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-liquid-image';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve liquid image widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Liquid Image', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve liquid image widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-info-box';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 *
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
		 *
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'image', 'flip', 'box', 'fancy', 'liquid' ];
		}

		/**
		 * Register liquid image widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_liquid_content_section',
				[
					'label'		=> __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_liquid_image_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'liquid-image-style-1',
					'options'     	=> [
						'liquid-image-style-1' 	=> __( 'Style 1', 'litho-addons' ),
						'liquid-image-style-2' 	=> __( 'Style 2', 'litho-addons' )
					],
					'label_block' 	=> true,
				]
			);
			$this->start_controls_tabs( 'litho_liquid_images_tabs' );
				$this->start_controls_tab( 'litho_liquid_images_primary_tab', [ 'label' => __( 'Primary', 'litho-addons' ) ] );
					$this->add_control(
						'litho_liquid_image_primary',
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

				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_liquid_images_secondary_tab', [ 'label' => __( 'Secondary', 'litho-addons' ) ] );	
					$this->add_control(
						'litho_liquid_image_secondary',
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
				$this->end_controls_tab();
			$this->end_controls_tabs();
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
				'litho_liquid_section_settings',
				[
					'label' 		=> __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_enable_parallax',
				[
					'label'         => __( 'Enable Parallax', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'  		=> 'yes',
				]
			);
			$this->add_control(
				'litho_swap_parallax',
				[
					'label'         => __( 'Swap Parallax', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'description'   => __( 'Select yes to show parallax in secondary image.', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'  		=> '',
					'condition'     => [ 'litho_enable_parallax' => [ 'yes' ] ]
				]
			);
			$this->add_control(
				'litho_parallax_ratio',
				[
					'label' 	=> __( 'Parallax Ratio', 'litho-addons' ),
					'type'	 	=> Controls_Manager::SLIDER,
					'default' 	=> [
						'unit' 	=> 'px',
					],
					'range' 	=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1.5,
							'step' 	=> 0.1,
						],
					],
					'condition'     => [ 'litho_enable_parallax' => [ 'yes' ] ]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_liquid_image_general_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_liquid_image_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'range'			=> [ 'px'   => [ 'min' => 0, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .liquid-image-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_liquid_imag_box_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .primary-image-box img, {{WRAPPER}} .secondary-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_liquid_primary_img_heading',
				[
					'label'         => __( 'Primary Image', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_liquid_imag_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'default' 		=> [
						'unit'		=> '%',
					],
					'tablet_default' => [
						'unit' 		=> '%',
					],
					'mobile_default' => [
						'unit' 		=> '%',
					],
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 200,
								'max' => 1500,
						],
						'%' => [
							'max' => 100,
							'min' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .primary-image-box' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'litho_liquid_secondary_img_heading',
				[
					'label'         => __( 'Secondary Image', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'		=> 'before',
					'condition' => [
						'litho_liquid_image_secondary[url]!' => '',
					],
				]
			);
			$this->add_responsive_control(
				'litho_liquid_secondary_imag_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'default' 		=> [
						'unit'		=> '%',
					],
					'tablet_default' => [
						'unit' 		=> '%',
					],
					'mobile_default' => [
						'unit' 		=> '%',
					],
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 200,
								'max' => 1500,
						],
						'%' => [
							'max' => 100,
							'min' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .secondary-image-box' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'litho_liquid_image_secondary[url]!' => '',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_liquid_image_overlay_style_section',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_liquid_image_overlay',
				[
					'label' 		=> __( 'Overlay', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'return_value'	=> 'yes',
					'conditions' 	=> [
						'terms' 	=> [
							[
								'name' 		=> 'litho_liquid_image_secondary[url]',
								'operator' 	=> '!=',
								'value' 	=> '',
							],
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_liquid_image_overlay_color',
					'fields_options'    => [ 'background' => [ 'label' => __( 'Overlay Color', 'litho-addons' ) ] ],
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'conditions' 	=> [
						'terms' 	=> [
							[
								'name' 		=> 'litho_liquid_image_overlay',
								'value' 	=> 'yes',
							],
						],
					],
					'selector'          => '{{WRAPPER}} .liquid-image-overlay',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render liquid image widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                 = $this->get_settings_for_display();
			$litho_liquid_image_style = ( isset( $settings['litho_liquid_image_style'] ) && $settings['litho_liquid_image_style'] ) ? $settings['litho_liquid_image_style'] : 'liquid-image-style-1';
			$enable_parallax          = ( isset( $settings['litho_enable_parallax'] ) && $settings['litho_enable_parallax'] ) ? $settings['litho_enable_parallax'] : '';
			$swap_parallax            = ( isset( $settings['litho_swap_parallax'] ) && $settings['litho_swap_parallax'] ) ? $settings['litho_swap_parallax'] : '';
			$parallax_ratio           = ( isset( $settings['litho_parallax_ratio']['size'] ) && $settings['litho_parallax_ratio']['size'] ) ? $settings['litho_parallax_ratio']['size'] : '';
			$liquid_image_overlay     = ( isset( $settings['litho_liquid_image_overlay'] ) && $settings['litho_liquid_image_overlay'] ) ? $settings['litho_liquid_image_overlay'] : '';

			// Get primary image.
			$litho_liquid_image_primary = '';
			if ( ! empty( $settings['litho_liquid_image_primary']['id'] ) ) {
				$srcset_data                    = litho_get_image_srcset_sizes( $settings['litho_liquid_image_primary']['id'], $settings['litho_thumbnail_size'] );
				$litho_liquid_image_primary_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_liquid_image_primary']['id'], 'litho_thumbnail', $settings );
				$litho_liquid_image_primary_alt = Control_Media::get_image_alt( $settings['litho_liquid_image_primary'] );
				$litho_liquid_image_primary     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_liquid_image_primary_url ), esc_attr( $litho_liquid_image_primary_alt ), $srcset_data ); // phpcs:ignore

			} elseif ( ! empty( $settings['litho_liquid_image_primary']['url'] ) ) {
				$litho_liquid_image_primary_url = $settings['litho_liquid_image_primary']['url'];
				$litho_liquid_image_primary_alt = '';
				$litho_liquid_image_primary     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_liquid_image_primary_url ), esc_attr( $litho_liquid_image_primary_alt ) );
			}

			// Get secondary image.
			$litho_liquid_image_secondary = '';
			if ( ! empty( $settings['litho_liquid_image_secondary']['id'] ) ) {

				$srcset_data                      = litho_get_image_srcset_sizes( $settings['litho_liquid_image_secondary']['id'], $settings['litho_thumbnail_size'] );
				$litho_liquid_image_secondary_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_liquid_image_secondary']['id'], 'litho_thumbnail', $settings );
				$litho_liquid_image_secondary_alt = Control_Media::get_image_alt( $settings['litho_liquid_image_secondary'] );
				$litho_liquid_image_secondary     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_liquid_image_secondary_url ), esc_attr( $litho_liquid_image_secondary_alt ), $srcset_data ); // phpcs:ignore

			} elseif ( ! empty( $settings['litho_liquid_image_secondary']['url'] ) ) {
				$litho_liquid_image_secondary_url = $settings['litho_liquid_image_secondary']['url'];
				$litho_liquid_image_secondary_alt = '';
				$litho_liquid_image_secondary     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_liquid_image_secondary_url ), esc_attr( $litho_liquid_image_secondary_alt ) );
			}

			if ( empty( $litho_liquid_image_primary ) && empty( $litho_liquid_image_secondary ) ) {
				return;
			}

			$this->add_render_attribute( 'wrapper', 'class', [ 'liquid-image-wrapper', $settings['litho_liquid_image_style' ] ] );
			$this->add_render_attribute( 'primary_image_box', 'class', [ 'primary-image-box' ] );
			$this->add_render_attribute( 'secondary_image_box', 'class', [ 'secondary-image-box' ] );

			if ( 'yes' === $enable_parallax ) {
				if ( 'yes' === $swap_parallax ) {
					$this->add_render_attribute( 'secondary_image_box', [
						'data-parallax-layout-ratio' => ( ! empty( $parallax_ratio ) ) ? $parallax_ratio : 1.1,
					] );
				} else {
					$this->add_render_attribute( 'primary_image_box', [
						'data-parallax-layout-ratio' => ( ! empty( $parallax_ratio ) ) ? $parallax_ratio : 1.1,
					] );
				}
			}

			switch ( $litho_liquid_image_style ) {
				case 'liquid-image-style-1':
				case 'liquid-image-style-2':
				default:
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore ?>>
						<div <?php $this->print_render_attribute_string( 'secondary_image_box' ); // phpcs:ignore ?>>
							<?php echo sprintf( '%s', $litho_liquid_image_secondary ); // phpcs:ignore ?>
							<?php if ( 'yes' === $liquid_image_overlay ) { ?>
								<div class="liquid-image-overlay"></div>
							<?php } ?>
						</div>
						<div <?php $this->print_render_attribute_string( 'primary_image_box' ); // phpcs:ignore ?>>
							<?php echo sprintf( '%s', $litho_liquid_image_primary ); // phpcs:ignore ?>
						</div>
					</div>
					<?php
					break;
			}
		}
	}
}
