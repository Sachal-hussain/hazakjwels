<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for image offset shadow.
 *
 * @package Litho
 */

// If class `Image_Offset_Shadow` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Image_Offset_Shadow' ) ) {

	class Image_Offset_Shadow extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve image offset shadow widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-image-offset-shadow';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve image offset shadow widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Image Offset Shadow', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve image offset shadow widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-image';
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
			return [ 'image', 'flip', 'box', 'fancy', 'liquid', 'shadow', 'overlay', 'offset', 'back' ];
		}

		/**
		 * Register image offset shadow widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_image_offset_shadow_content_section',
				[
					'label' 		=> __( 'Image', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_image',
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
				'litho_image_offset_shadow_general_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_image_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .image-back-offset-shadow > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_image_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .image-back-offset-shadow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_image_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .image-back-offset-shadow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_image_overlay_style_section',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_image_overlay_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'selector' 			=> '{{WRAPPER}} .overlay',
				]
			);
			$this->add_responsive_control(
				'litho_image_overlay_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .image-back-offset-shadow .overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render image offset shadow widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			if ( ! empty( $settings['litho_image']['id'] ) || ! empty( $settings['litho_image']['url'] ) ) {

				$litho_image = '';
				if ( ! empty( $settings['litho_image']['id'] ) ) {

					$srcset_data     = litho_get_image_srcset_sizes( $settings['litho_image']['id'], 'full' );
					$litho_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_image']['id'], 'litho_thumbnail', $settings );
					$litho_image_alt = Control_Media::get_image_alt( $settings['litho_image'] );
					$litho_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_image_url ), esc_attr( $litho_image_alt ), $srcset_data );

				} elseif ( ! empty( $settings['litho_image']['url'] ) ) {
					$litho_image_url = $settings['litho_image']['url'];
					$litho_image_alt = '';
					$litho_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_image_url ), esc_attr( $litho_image_alt ) );
				}

				$this->add_render_attribute(
					'wrapper',
					'class',
					[
						'image-back-offset-shadow',
						'width-100',
					]
				);
				?>
				<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="overlay"></span>
				</div>
				<?php
			}
		}
	}
}
