<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

use LithoAddons\Controls\Groups\Text_Gradient_Background;
use LithoAddons\Controls\Groups\Column_Group_Control;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for image gallery.
 *
 * @package Litho
 */

// If class `Image_Gallery` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Image_Gallery' ) ) {

	class Image_Gallery extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-image-gallery';
		}

		/**
		 * Retrieve the widget title.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Image Gallery', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 *
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
			return [ 'image', 'photo', 'visual', 'gallery', 'lightbox', 'group', 'justify' ];
		}

		/**
		 * Register image gallery widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */

		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_image_gallery_section',
				[
					'label' => __( 'Image Gallery', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_image_gallery_style',
				[
					'label'   => esc_html__( 'Style', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						''        => esc_html__( 'Default', 'litho-addons' ),
						'justify' => esc_html__( 'Justify', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_image_gallery_data',
				[
					'label'      => __( 'Add Images', 'litho-addons' ),
					'type'       => Controls_Manager::GALLERY,
					'show_label' => false,
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'		=> 'litho_image_gallery_thumbnail',
					'exclude'	=> [ 'custom' ],
					'separator'	=> 'none',
				]
			);
			$this->add_control(
				'litho_image_gallery_metro_positions',
				[
					'label'			=> __( 'Metro grid positions', 'litho-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'description'	=> __( 'Mention the positions (comma separated like 1, 4, 7) where that image will cover spacing of multiple columns and / or rows considering the image width and height.', 'litho-addons' ),
					'condition' => [
						'litho_image_gallery_style!' => 'justify',
					]
				]
			);
			$this->add_control(
				'litho_single_image_active',
				[
					'label'         => esc_html__( 'Single Image View', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => esc_html__( 'Yes', 'litho-addons' ),
					'label_off'     => esc_html__( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
					'prefix_class' 	=> 'elementor-default-active-',
					'description'	=> esc_html__( 'Changes will be reflected in the preview only after the page reload.', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Column_Group_Control::get_type(),
				[
					'name'      => 'litho_column_settings',
					'condition' => [
						'litho_single_image_active'  => '',
						'litho_image_gallery_style!' => 'justify',
					]
				]
			);

			$this->add_control(
				'litho_gallery_last_row',
				[
					'label'     => __( 'Last Row ( Justify )', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'nojustify',
					'options'   => [
						'nojustify' => __( 'No Justify', 'litho-addons' ),
						'justify'   => __( 'Justify', 'litho-addons' ),
						'left'      => __( 'Left', 'litho-addons' ),
						'center'    => __( 'Center', 'litho-addons' ),
						'right'     => __( 'Right', 'litho-addons' ),
						'hide'      => __( 'Hide', 'litho-addons' ),
					],
					'condition' => [
						'litho_image_gallery_style' => 'justify',
					],
				]
			);

			$this->add_control(
				'litho_image_gallery_link',
				[
					'label'		=> __( 'Link', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'file',
					'options'	=> [
						'file'		=> __( 'Media File', 'litho-addons' ),
						'none'		=> __( 'None', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_image_gallery_lightbox',
				[
					'label'		=> __( 'Lightbox', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'no',
					'options'	=> [
						'yes'		=> __( 'Yes', 'litho-addons' ),
						'no'		=> __( 'No', 'litho-addons' ),
					],
					'condition'	=> [
						'litho_image_gallery_link' => 'file',
					],
				]
			);
			$this->add_control(
				'litho_image_gallery_animation',
				[
					'label'			=> __( 'Entrance Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::ANIMATION,
				]
			);
			$this->add_control(
				'litho_image_gallery_animation_duration',
				[
					'label'			=> __( 'Animation Duration', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'default'		=> '',
					'options'		=> [
							'slow'		=> __( 'Slow', 'litho-addons' ),
							''			=> __( 'Normal', 'litho-addons' ),
							'fast'		=> __( 'Fast', 'litho-addons' )
					],
					'condition'     => [
						'litho_image_gallery_animation!' => '',
					]
				]
			);
			$this->add_control(
				'litho_image_gallery_animation_delay',
				[
					'label'			=> __( 'Animation Delay', 'litho-addons' ),
					'type'			=> Controls_Manager::NUMBER,
					'default'		=> '',
					'min'			=> 0,
					'max'			=> 1500,
					'step' 			=> 50,
					'condition'     => [
						'litho_image_gallery_animation!' 	=> '',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_image_gallery_icon_section',
				[
					'label'		=> __( 'Hover Icon', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_image_gallery_icon',
				[
					'label'         => __( 'Icon', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);

			$this->add_control(
				'litho_image_gallery_select_icon',
				[
					'label'             => __( 'Select Icon', 'litho-addons' ),
					'type'              => Controls_Manager::ICONS,
					'fa4compatibility'  => 'icon',
					'default'           => [
						'value'         => 'feather icon-feather-zoom-in',
						'library' 		=> 'feather',
					],
					'condition'         => [
						'litho_image_gallery_icon' => 'yes',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_image_gallery_images',
				[
					'label'		=> __( 'Images', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_image_gallery_columns_gap',
				[
					'label'		=> __( 'Columns Gap', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size' 	=> 15,
					],
					'range'		=> [
						'px' => [
							'min' 	=> 0,
							'max'	=> 100,
							'step'	=> 1,
						],
					],
					'selectors'	=> [
						'{{WRAPPER}} ul li.grid-item:not(.grid-item-double)' => 'padding: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'litho_image_gallery_style!' => 'justify',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'litho_image_border',
					'selector'  => '{{WRAPPER}} .portfolio-box .portfolio-image',
				]
			);
			$this->add_responsive_control(
				'litho_image_border_radius',
				[
					'label'			=> __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-box .portfolio-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'litho_image_box_shadow',
					'selector'  => '{{WRAPPER}} .portfolio-box .portfolio-image',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_icon',
				[
					'label'		=> __( 'Hover Icon', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_icon_color',
					'selector'	=> '{{WRAPPER}} .image-gallery-box i:before',
								   '{{WRAPPER}} .image-gallery-box svg path:before',
				]
			);
			$this->add_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .image-gallery-box i' => 'font-size: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_image_gallery_image_overlay',
				[
					'label'		=> __( 'Overlay', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_image_gallery_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .portfolio-image',
				]
			);
			$this->add_control(
				'litho_image_overlay_hover_opacity',
				[
					'label'		=> __( 'Opacity', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 1,
							'min' 	=> 0.10,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .portfolio-box.image-gallery-box:hover .portfolio-image img' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render image gallery widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render( $instance = [] ) {

			$settings = $this->get_settings_for_display();

			if ( ! $settings['litho_image_gallery_data'] ) {
				return;
			}

			$litho_image_gallery_style = $this->get_settings( 'litho_image_gallery_style' );
			$litho_gallery_last_row    = $this->get_settings( 'litho_gallery_last_row' );


			/* Column Settings */
			$litho_column_class_list = '';
			
			$litho_column_desktop_column = ! empty( $settings['litho_column_settings_litho_larger_desktop_column'] ) ? $settings['litho_column_settings_litho_larger_desktop_column'] : 'grid-3col';
			$litho_column_ratio = '';
			switch ( $litho_column_desktop_column ) {
				case 'grid-1col':
					$litho_column_ratio = 1;
					break;
				case 'grid-2col':
					$litho_column_ratio = 2;
					break;
				case 'grid-3col':
				default:
					$litho_column_ratio = 3;
					break;
				case 'grid-4col':
					$litho_column_ratio = 4;
					break;
				case 'grid-5col':
					$litho_column_ratio = 5;
					break;
				case 'grid-6col':
					$litho_column_ratio = 6;
					break;
			}

			$litho_column_class      = array();
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_larger_desktop_column'] ) ? $settings['litho_column_settings_litho_larger_desktop_column'] : 'grid-3col';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_large_desktop_column'] ) ? $settings['litho_column_settings_litho_large_desktop_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_desktop_column'] ) ? $settings['litho_column_settings_litho_desktop_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_tablet_column'] ) ? $settings['litho_column_settings_litho_tablet_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_landscape_phone_column'] ) ? $settings['litho_column_settings_litho_landscape_phone_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_portrait_phone_column'] ) ? $settings['litho_column_settings_litho_portrait_phone_column'] : '';
			$litho_column_class      = array_filter( $litho_column_class );
			$litho_column_class_list = implode( ' ', $litho_column_class );
			/* End Column Settings */

			// Entrance Animation.
			$litho_image_gallery_animation          = ( isset( $settings['litho_image_gallery_animation'] ) && $settings['litho_image_gallery_animation'] ) ? $settings['litho_image_gallery_animation'] : '';
			$litho_image_gallery_animation_duration = ( isset( $settings['litho_image_gallery_animation_duration'] ) && $settings['litho_image_gallery_animation_duration'] ) ? $settings['litho_image_gallery_animation_duration'] : '';
			$litho_image_gallery_animation_delay    = ( isset( $settings['litho_image_gallery_animation_delay'] ) && $settings['litho_image_gallery_animation_delay'] ) ? $settings['litho_image_gallery_animation_delay'] : 100;
			$ids                                    = wp_list_pluck( $settings['litho_image_gallery_data'], 'id' );
			$litho_image_gallery_icon               = ( isset( $settings['litho_image_gallery_icon'] ) && $settings['litho_image_gallery_icon'] ) ? $settings['litho_image_gallery_icon'] : '';
			$litho_image_gallery_link               = ( isset( $settings['litho_image_gallery_link'] ) && $settings['litho_image_gallery_link'] ) ? $settings['litho_image_gallery_link'] : '';

			if ( 'justify' === $litho_image_gallery_style ) {
				$this->add_render_attribute(
					'main_wrapper',
					[
						'class'                => [
							'portfolio-grid',
							'justified-gallery',
						],
						'data-last-row' => $litho_gallery_last_row
					]
				);
			} else {

				$this->add_render_attribute(
					'main_wrapper',
					'class',
					[
						'portfolio-grid',
						'grid',
						$litho_column_class_list,
					]
				);
			}

			if ( ! empty( $settings['litho_single_image_active'] ) ) {
				$this->add_render_attribute( 'main_wrapper', 'class', 'single-view-image' );
			}
			
			$litho_image_gallery_thumbnail = $this->get_settings( 'litho_image_gallery_thumbnail' );
			$litho_image_gallery_lightbox  = isset( $settings['litho_image_gallery_lightbox'] ) ? $settings['litho_image_gallery_lightbox'] : null;

			$custom_link = '';
			$is_new      = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$migrated    = isset( $settings['__fa4_migrated']['litho_image_gallery_select_icon'] );
			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_image_gallery_select_icon'], [ 'aria-hidden' => 'true' ] );
				$custom_link .= ob_get_clean();
			} elseif ( isset( $settings['litho_image_gallery_select_icon']['value'] ) && ! empty( $settings['litho_image_gallery_select_icon']['value'] ) ) {
				$custom_link .= '<i class="' . esc_attr( $settings['litho_image_gallery_select_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			if ( ! empty( $ids ) ) {
				if ( 'justify' === $litho_image_gallery_style ) {
					?>
					<div <?php $this->print_render_attribute_string( 'main_wrapper' ); ?>>
					<?php
				} else {
				?>
					<ul <?php $this->print_render_attribute_string( 'main_wrapper' ); ?>>
					<li class="grid-sizer"></li>
					<?php
				}

					$index            = 0;
					$grid_count       = 1;
					$grid_metro_count = 1;

					foreach ( $ids as $key => $id ) {
						if( $litho_column_ratio !== 0 ){
							if ( $index % $litho_column_ratio === 0 ) {
								$grid_count = 1;
							}	
						}

						$link_wrapper               = $key . '_link_wrapper';
						$inner_wrapper              = $key . '_inner_wrapper';
						$litho_blog_metro_positions = $this->get_settings( 'litho_image_gallery_metro_positions' );
						$litho_double_grid_position = ! empty( $litho_blog_metro_positions ) ? explode( ',', $litho_blog_metro_positions ) : array();

						$this->add_render_attribute( $inner_wrapper, 'class', 'grid-item', true );

						if ( 'justify' === $litho_image_gallery_style ) {
							$this->add_render_attribute( $inner_wrapper, 'class', 'jg-entry', true );
						} else {
							if ( ! empty( $litho_double_grid_position ) && in_array( $grid_metro_count, $litho_double_grid_position ) ) {
								$this->add_render_attribute( $inner_wrapper, 'class', 'grid-item-double grid-item', true );
							}
						}

						// Entrance Animation.
						if ( ! empty( $litho_image_gallery_animation ) ) {

							$this->add_render_attribute(
								$inner_wrapper,
								[
									'class'                => [
										'litho-animated',
										'elementor-invisible',
									],
									'data-animation'       => [
										$litho_image_gallery_animation,
										$litho_image_gallery_animation_duration,
									],
									'data-animation-delay' => $grid_count * $litho_image_gallery_animation_delay
								]
							);
						}

						if ( 'file' === $litho_image_gallery_link ) {
							$image = wp_get_attachment_image_url( $id, $litho_image_gallery_thumbnail );
							$this->add_render_attribute(
								$link_wrapper,
								[
									'href'                         => $image,
									'data-elementor-open-lightbox' => 'no',
								]
							);

							if ( 'yes' === $litho_image_gallery_lightbox ) {
								$this->add_render_attribute(
									$link_wrapper,
									[
										'data-group' => $this->get_id(),
										'class'      => 'lightbox-group-gallery-item ',
									]
								);

								$litho_image_title_lightbox_popup   = get_theme_mod( 'litho_image_title_lightbox_popup', '0' );
								$litho_image_caption_lightbox_popup = get_theme_mod( 'litho_image_caption_lightbox_popup', '0' );

								if ( 1 == $litho_image_title_lightbox_popup ) {
									$litho_attachment_title = get_the_title( $id );
									if ( ! empty( $litho_attachment_title ) ) {
										$this->add_render_attribute( $link_wrapper, [
											'title'	=> $litho_attachment_title,
										] );
									}
								}

								if ( 1 == $litho_image_caption_lightbox_popup ) {
									$litho_lightbox_caption = wp_get_attachment_caption( $id );
									if ( ! empty( $litho_lightbox_caption ) ) {
										$this->add_render_attribute( $link_wrapper, [
											'data-lightbox-caption' => $litho_lightbox_caption,
										] );
									}
								}
							}
						}

						if ( 'justify' === $litho_image_gallery_style ) {
							?>
							<div <?php $this->print_render_attribute_string( $inner_wrapper ); ?>>
								<div class="portfolio-box image-gallery-box">
									<?php
									if ( 'file' === $litho_image_gallery_link ) {
										?>
										<a <?php $this->print_render_attribute_string( $link_wrapper ); ?>>
										<?php
									}
									?>
									<div class="portfolio-image">
										<?php echo wp_get_attachment_image( $id, $litho_image_gallery_thumbnail ); ?>
									</div>
									<?php
									if ( 'file' === $litho_image_gallery_link ) {
										?>
										</a>
										<?php
									}
									?>
								</div>
							</div>
							<?php
						} else {
							?>
							<li <?php $this->print_render_attribute_string( $inner_wrapper ); ?>>
								<?php if ( 'file' === $litho_image_gallery_link ) { ?>
									<a <?php $this->print_render_attribute_string( $link_wrapper ); ?>>
								<?php } ?>
									<div class="portfolio-box image-gallery-box">
										<div class="portfolio-image">
											<?php echo wp_get_attachment_image( $id, $litho_image_gallery_thumbnail ); ?>
											<?php if ( 'yes' === $litho_image_gallery_icon ) { ?>
												<div class="portfolio-hover"><?php printf( '%s', $custom_link ); // phpcs:ignore ?></div>
											<?php } ?>
										</div>
									</div>
								<?php if ( 'file' === $litho_image_gallery_link ) { ?>
									</a>
								<?php } ?>
							</li>
							<?php
						}

						$index++;
						$grid_metro_count++;
						$grid_count++;	
					}
					?>
				</ul>
				<?php 
			}
		}
	}
}
