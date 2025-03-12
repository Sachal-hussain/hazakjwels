<?php
namespace LithoAddons\Widgets;

use Elementor\Conditions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Control_Media;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use LithoAddons\Controls\Groups\Text_Gradient_Background;
use LithoAddons\Controls\Groups\Column_Group_Control;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for media gallery.
 *
 * @package Litho
 */

// If class `Media_Gallery` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Media_Gallery' ) ) {

	/**
	 *
	 * Define Class `Media Gallery`
	 */
	class Media_Gallery extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-media-gallery';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return esc_html__( 'Litho Media Gallery', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
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
			return [
				'media',
				'carousel',
				'image',
				'video',
				'lightbox',
			];
		}

		/**
		 * Register media gallery widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {
			$this->start_controls_section(
				'litho_section_media_gallery',
				[
					'label' => esc_html__( 'Media', 'litho-addons' ),
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'litho_type',
				[
					'label'   => esc_html__( 'Type', 'litho-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'default' => 'image',
					'options' => [
						'image' => [
							'title' => esc_html__( 'Image', 'litho-addons' ),
							'icon'  => 'eicon-image-bold',
						],
						'video' => [
							'title' => esc_html__( 'Video', 'litho-addons' ),
							'icon'  => 'eicon-video-camera',
						],
					],
					'toggle'  => false,
				]
			);

			$repeater->add_control(
				'litho_image',
				[
					'label'     => esc_html__( 'Image', 'litho-addons' ),
					'type'      => Controls_Manager::MEDIA,
					'dynamic'   => [
						'active' => true,
					],
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'litho_type' => 'image',
					],
				]
			);

			$repeater->add_control(
				'litho_video_source',
				[
					'label'     => esc_html__( 'Source', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'youtube',
					'options'   => [
						'youtube'    => esc_html__( 'YouTube', 'litho-addons' ),
						'vimeo'      => esc_html__( 'Vimeo', 'litho-addons' ),
						'selfhosted' => esc_html__( 'Self Hosted', 'litho-addons' ),
					],
					'condition' => [
						'litho_type' => 'video',
					],
				]
			);

			$repeater->add_control(
				'litho_poster_image',
				[
					'label'     => esc_html__( 'Poster Image', 'litho-addons' ),
					'type'      => Controls_Manager::MEDIA,
					'dynamic'   => [
						'active' => true,
					],
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'litho_type'         => 'video',
						'litho_video_source' => 'selfhosted',
					],
				]
			);

			$repeater->add_control(
				'litho_selfhosted_video_link',
				[
					'label'       => esc_html__( 'Choose Video File', 'litho-addons' ),
					'type'        => Controls_Manager::MEDIA,
					'media_types' => [
						'video',
					],
					'condition'   => [
						'litho_type'         => 'video',
						'litho_video_source' => 'selfhosted',
					],
				]
			);

			$repeater->add_control(
				'litho_youtube_video_link',
				[
					'label'       => esc_html__( 'YouTube Link', 'litho-addons' ),
					'type'        => Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://www.youtube.com/watch?v=XHOmBV4js_E', 'litho-addons' ),
					'options'     => false,
					'default'     => [
						'url'         => esc_url( 'https://www.youtube.com/watch?v=XHOmBV4js_E' ),
						'is_external' => true,
						'nofollow'    => true,
					],
					'condition'   => [
						'litho_type'         => 'video',
						'litho_video_source' => 'youtube',
					],
				]
			);

			$repeater->add_control(
				'litho_vimeo_video_link',
				[
					'label'       => esc_html__( 'Vimeo Link', 'litho-addons' ),
					'type'        => Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://vimeo.com/235215203', 'litho-addons' ),
					'options'     => false,
					'separator'   => 'after',
					'default'     => [
						'url'         => esc_url( 'https://vimeo.com/235215203' ),
						'is_external' => true,
						'nofollow'    => true,
					],
					'condition'   => [
						'litho_type'         => 'video',
						'litho_video_source' => 'vimeo',
					],
				]
			);

			$this->add_control(
				'litho_media_gallery_list',
				[
					'label'  => esc_html__( 'Media Items', 'litho-addons' ),
					'type'   => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_media_gallery_setting',
				[
					'label' => esc_html__( 'Settings', 'litho-addons' ),
				]
			);

			$this->add_group_control(
				Column_Group_Control::get_type(),
				[
					'name' => 'litho_column_settings',
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'litho_thumbnail',
					'default'   => 'full',
					'exclude'   => [ 'custom' ],
					'separator' => 'none',
				]
			);
			$this->add_control(
				'litho_media_gallery_icon',
				[
					'label'        => esc_html__( 'Enable Icon', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'litho-addons' ),
					'label_off'    => esc_html__( 'No', 'litho-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);
			$this->add_control(
				'litho_media_gallery_select_icon',
				[
					'label'            => esc_html__( 'Select Icon', 'litho-addons' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'skin'             => 'inline',
					'label_block'      => false,
					'default'          => [
						'value'   => 'fa-solid fa-plus',
						'library' => 'fa-solid',
					],
					'condition'        => [
						'litho_media_gallery_icon' => 'yes',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_media_gallery_images',
				[
					'label' => esc_html__( 'Images', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_media_gallery_columns_gap',
				[
					'label'     => esc_html__( 'Columns Gap', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 15,
					],
					'range'     => [
						'px' => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} ul li.grid-item:not(.grid-item-double)' => 'padding: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'litho_image_border',
					'selector' => '{{WRAPPER}} .portfolio-box .portfolio-image',
				]
			);
			$this->add_responsive_control(
				'litho_image_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [
						'px',
						'%',
						'em',
						'rem',
						'custom',
					],
					'selectors'  => [
						'{{WRAPPER}} .portfolio-box .portfolio-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'litho_image_box_shadow',
					'selector' => '{{WRAPPER}} .portfolio-box .portfolio-image',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_icon',
				[
					'label' => esc_html__( 'Hover Icon', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'     => 'litho_icon_color',
					'selector' => '{{WRAPPER}} .image-gallery-box i, {{WRAPPER}} .image-gallery-box svg',
				]
			);
			$this->add_control(
				'litho_icon_size',
				[
					'label'     => esc_html__( 'Size', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 1,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .image-gallery-box i'   => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .image-gallery-box svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_media_gallery_image_overlay',
				[
					'label' => esc_html__( 'Media Overlay', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'litho_media_gallery_color',
					'types'    => [ 'classic', 'gradient' ],
					'exclude'  => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' => '{{WRAPPER}} .portfolio-image',
				]
			);
			$this->add_control(
				'litho_image_overlay_hover_opacity',
				[
					'label'     => esc_html__( 'Opacity', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max'  => 1,
							'min'  => 0.10,
							'step' => 0.01,
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
		 * Render media gallery widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			if ( ! $settings['litho_media_gallery_list'] ) {
				return;
			}

			$litho_media_gallery_icon = ( isset( $settings['litho_media_gallery_icon'] ) && $settings['litho_media_gallery_icon'] ) ? $settings['litho_media_gallery_icon'] : '';

			/* Column Settings */
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

			$this->add_render_attribute(
				'main_wrapper',
				[
					'class' => [
						'portfolio-grid grid',
						$litho_column_class_list,
					],
				]
			);

			$custom_icon = '';
			$is_new      = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$migrated    = isset( $settings['__fa4_migrated']['litho_media_gallery_select_icon'] );

			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_media_gallery_select_icon'], [ 'aria-hidden' => 'true' ] );
				$custom_icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_media_gallery_select_icon']['value'] ) && ! empty( $settings['litho_media_gallery_select_icon']['value'] ) ) {
				$custom_icon .= '<i class="' . esc_attr( $settings['litho_media_gallery_select_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			if ( ! empty( $settings['litho_media_gallery_list'] ) ) {
				?>
				<ul <?php $this->print_render_attribute_string( 'main_wrapper' ); ?>>
					<li class="grid-sizer"></li>
					<?php
					foreach ( $settings['litho_media_gallery_list'] as $key => $item ) {
						$link_wrapper  = $key . '_link_wrapper';
						$inner_wrapper = $key . '_inner_wrapper';

						$this->add_render_attribute(
							$link_wrapper,
							[
								'data-group' => $this->get_id(),
								'class'      => 'lightbox-group-gallery-item',
								'data-elementor-open-lightbox' => 'no',
							]
						);

						if ( ! empty( $item['litho_image'] ) ) {
							$this->add_render_attribute(
								$link_wrapper,
								[
									'href' => $item['litho_image']['url'],
								]
							);
						} elseif ( ! empty( $item['litho_youtube_video_link'] ) && '' !== $item['litho_youtube_video_link']['url'] ) {
							$this->add_render_attribute(
								$link_wrapper,
								[
									'href'  => $item['litho_youtube_video_link']['url'],
									'class' => 'popup-youtube',
								]
							);
						} elseif ( ! empty( $item['litho_vimeo_video_link']['url'] ) ) {
							$this->add_render_attribute(
								$link_wrapper,
								[
									'href'  => $item['litho_vimeo_video_link']['url'],
									'class' => 'popup-vimeo',
								]
							);
						} elseif ( ! empty( $item['litho_selfhosted_video_link']['url'] ) ) {
							$this->add_render_attribute(
								$link_wrapper,
								[
									'href'  => $item['litho_selfhosted_video_link']['url'],
									'class' => 'popup-vimeo',
								]
							);
						} else {
							$this->add_render_attribute(
								$link_wrapper,
								[
									'href'  => $item['litho_youtube_video_link']['url'],
									'class' => 'popup-youtube',
								]
							);
						}
						if ( ! empty( $item['litho_image']['id'] ) ) {
							$litho_attachment_title = get_the_title( $item['litho_image']['id'] );
							$litho_lightbox_caption = wp_get_attachment_caption( $item['litho_image']['id'] );
							$this->add_render_attribute(
								$link_wrapper,
								[
									'title' => $litho_attachment_title,
									'data-lightbox-caption' => $litho_lightbox_caption,
								]
							);
						}

						if ( ! empty( $item['litho_image']['id'] ) ) {
							$srcset_data     = litho_get_image_srcset_sizes( $item['litho_image']['id'], $settings['litho_thumbnail_size'] );
							$litho_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_image']['id'], 'litho_thumbnail', $settings );
							$litho_image_alt = Control_Media::get_image_alt( $item['litho_image'] );
							$litho_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s class="client-box-image" />', esc_url( $litho_image_url ), esc_attr( $litho_image_alt ), $srcset_data ); // phpcs:ignore
						} elseif ( ! empty( $item['litho_image']['url'] ) ) {
							$litho_image_url = $item['litho_image']['url'];
							$litho_image_alt = '';
							$litho_image     = sprintf( '<img src="%1$s" alt="%2$s" class="client-box-image" />', esc_url( $litho_image_url ), esc_attr( $litho_image_alt ) );
						}

						$this->add_render_attribute( $inner_wrapper, 'class', 'grid-item' );
						?>
						<li <?php $this->print_render_attribute_string( $inner_wrapper ); ?>>
							<a <?php $this->print_render_attribute_string( $link_wrapper ); ?>>
								<div class="portfolio-box image-gallery-box">
									<div class="portfolio-image fit-videos">
										<?php
										if ( 'image' === $item['litho_type'] ) {
												echo sprintf( '%s', $litho_image ); // phpcs:ignore
										} else {
											if ( ! empty( $item['litho_youtube_video_link'] ) && '' !== $item['litho_youtube_video_link']['url'] ) {
												$youtube_video = $item['litho_youtube_video_link']['url'];
												preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_video, $match );
												$background_video = ( ! empty( $youtube_video ) ) ? ' <iframe allowfullscreen mozallowfullscreen webkitallowfullscreen src="http://www.youtube.com/embed/' . esc_attr( $match[1] ) . '"></iframe>' : '';
												echo $background_video; //phpcs:ignore
											} elseif ( ! empty( $item['litho_vimeo_video_link'] ) && '' !== $item['litho_vimeo_video_link']['url'] ) {
												$vimeo_video = $item['litho_vimeo_video_link']['url'];
												preg_match( '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $vimeo_video, $output_array );
												$background_video = ( ! empty( $vimeo_video ) ) ? ' <iframe allowfullscreen mozallowfullscreen webkitallowfullscreen src="https://player.vimeo.com/video/' . esc_attr( $output_array[5] ) . '"></iframe>' : '';
												echo $background_video; //phpcs:ignore
											} elseif ( ! empty( $item['litho_selfhosted_video_link'] ) && '' !== $item['litho_selfhosted_video_link']['url'] ) {
												$poster_image = '';
												if ( ! empty( $item['litho_poster_image'] ) && '' !== $item['litho_poster_image']['url'] ) {
													$poster_image = ' poster=' . $item['litho_poster_image']['url'];
												}
												?>
												<video id="video_player" class="video-player"<?php echo esc_attr( $poster_image ); ?>>
													<source type="video/mp4" src="<?php echo esc_url( $item['litho_selfhosted_video_link']['url'] ); ?>">
												</video>
												<span class="video-icon"></span>
												<div class="overlay"></div>
												<?php
											} else {
												$youtube_video = esc_url( 'https://www.youtube.com/watch?v=XHOmBV4js_E' );
												preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_video, $match );
												$background_video = ( ! empty( $youtube_video ) ) ? ' <iframe allowfullscreen mozallowfullscreen webkitallowfullscreen src="http://www.youtube.com/embed/' . esc_attr( $match[1] ) . '"></iframe>' : '';
												echo $background_video; //phpcs:ignore
											}
										}

										if ( 'yes' === $litho_media_gallery_icon ) {
											?>
											<div class="portfolio-hover">
												<?php echo sprintf( '%s', $custom_icon ); // phpcs:ignore ?>
											</div>
											<?php
											}
										?>
									</div>
								</div>
							</a>
						</li>
						<?php
					}
					?>
				</ul>
				<?php
			}
		}
	}
}
