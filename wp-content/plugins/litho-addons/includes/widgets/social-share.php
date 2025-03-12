<?php
namespace LithoAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Widget_Base;
use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Social Share.
 *
 * @package Litho
 */

// If class `Social_Share` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Social_Share' ) ) {
	class Social_Share extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve Litho social share widget name.
		 *
		 * @return string Widget name.
		 * @since 1.0.0
		 * @access public
		 */
		public function get_name() {
			return 'litho-social-share';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve Litho social share widget title.
		 *
		 * @return string Widget title.
		 * @since 1.0.0
		 * @access public
		 */
		public function get_title() {
			return esc_html__( 'Litho Social Share', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve Litho social share widget icon.
		 *
		 * @return string Widget icon.
		 * @since 1.0.0
		 * @access public
		 */
		public function get_icon() {
			return 'eicon-share';
		}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the Litho social share widget belongs to.
		 *
		 * Used to determine where to display the widget in the editor.
		 *
		 * @return array Widget categories.
		 * @since 1.0.0
		 * @access public
		 */
		public function get_categories() {
			return [ 'litho' ];
		}

		/**
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the widget belongs to.
		 *
		 * @return array Widget keywords.
		 * @since 1.0.0
		 * @access public
		 */
		public function get_keywords() {
			return [
				'social',
				'share',
				'media',
				'marketing',
				'network',
			];
		}

		/**
		 * Register widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_section_social_share',
				[
					'label' => esc_html__( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'social_share_layout_type',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'social-share-default',
					'options' 		=> [
						'social-share-default' => __( 'Default', 'litho-addons' ),
						'social-share-style-1' => __( 'Style 1', 'litho-addons' ),
						'social-share-style-2' => __( 'Style 2', 'litho-addons' ),
					],				
				]
			);
			$repeater = new Repeater();
			$repeater->add_control(
				'litho_social_share_network',
				[
					'label'       => esc_html__( 'Network', 'litho-addons' ),
					'type'        => Controls_Manager::SELECT,
					'label_block' => false,
					'default'     => 'facebook',
					'options'     => [
						'facebook'    => esc_html__( 'Facebook', 'litho-addons' ),
						'twitter'     => esc_html__( 'Twitter', 'litho-addons' ),
						'linkedin'    => esc_html__( 'Linkedin', 'litho-addons' ),
						'pinterest'   => esc_html__( 'Pinterest', 'litho-addons' ),
						'reddit'      => esc_html__( 'Reddit', 'litho-addons' ),
						'stumbleupon' => esc_html__( 'StumbleUpon', 'litho-addons' ),
						'digg'        => esc_html__( 'Digg', 'litho-addons' ),
						'vk'          => esc_html__( 'VK', 'litho-addons' ),
						'xing'        => esc_html__( 'XING', 'litho-addons' ),
						'telegram'    => esc_html__( 'Telegram', 'litho-addons' ),
						'ok'          => esc_html__( 'Ok', 'litho-addons' ),
						'viber'       => esc_html__( 'Viber', 'litho-addons' ),
						'whatsapp'    => esc_html__( 'WhatsApp', 'litho-addons' ),
						'skype'       => esc_html__( 'Skype', 'litho-addons' ),
					],
				]
			);
			$repeater->add_control(
				'litho_social_share_icon_color_type',
				[
					'label'   => esc_html__( 'Color', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' => esc_html__( 'Official Color', 'litho-addons' ),
						'custom'  => esc_html__( 'Custom', 'litho-addons' ),
					],
				]
			);
			$repeater->start_controls_tabs( 'litho_social_icon_tabs' );
			$repeater->start_controls_tab(
				'litho_social_share_icon_normal_tab',
				[
					'label'     => esc_html__( 'Normal', 'litho-addons' ),
					'condition' => [
						'litho_social_share_icon_color_type' => 'custom',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_social_share_icon_bgcolor',
				[
					'label'     => esc_html__( 'Background Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => [
						'litho_social_share_icon_color_type' => 'custom',
					],
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper li a{{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
					],
				]
			);

			$repeater->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'           => 'litho_social_share_icon_color',
					'selector'       => '{{WRAPPER}} .social-share-wrapper li a{{CURRENT_ITEM}} i',
					'fields_options' => [
						'color'      => [
							'responsive' => true,
						],
						'background' => [
							'label' => esc_html__( 'Icon Color', 'litho-addons' ),
						],
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_social_share_icon_border_color',
				[
					'label'     => esc_html__( 'Border Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => [
						'litho_social_share_icon_color_type' => 'custom',
					],
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper li a{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
					],
				]
			);
			$repeater->add_control(
				'litho_social_share_icon_border_width',
				[
					'label'     => esc_html__( 'Border Width', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper li a{{CURRENT_ITEM}}' => 'border-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$repeater->end_controls_tab();
			$repeater->start_controls_tab(
				'litho_social_share_icon_tab_hover',
				[
					'label'     => esc_html__( 'Hover', 'litho-addons' ),
					'condition' => [
						'litho_social_share_icon_color_type' => 'custom',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_hover_social_share_icon_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => [
						'litho_social_share_icon_color_type' => 'custom',
					],
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper.social-share-default ul li a{{CURRENT_ITEM}}:hover, {{WRAPPER}} .social-share-wrapper.social-share-style-1 ul li a{{CURRENT_ITEM}}:hover, {{WRAPPER}} .social-share-wrapper.social-share-style-2 ul li a{{CURRENT_ITEM}}:hover .social-share-hover-effect' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .social-share-wrapper.social-share-style-1 ul li a{{CURRENT_ITEM}}:hover:after' => 'border-color: {{VALUE}};'
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_hover_social_share_icon_color',
				[
					'label'     => esc_html__( 'Icon Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => [
						'litho_social_share_icon_color_type' => 'custom',
					],
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper li a{{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}};',
					],
				]
			);
			$repeater->add_responsive_control(
				'litho_hover_social_share_icon_border_color',
				[
					'label'     => esc_html__( 'Border Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => [
						'litho_social_share_icon_color_type' => 'custom',
					],
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper li a{{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}};',
					],
					'condition'	=> [
						'social_share_layout_type!' => [ 'social-share-style-1', 'social-share-style-2' ], // NOT IN
					]
				]
			);
			$repeater->end_controls_tabs();

			$this->add_control(
				'litho_social_share_item',
				[
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'title_field' => '{{ litho_social_share_network }}',
					'show_label'  => false,
					'default'     => [
						[
							'litho_social_share_network' => 'facebook',
						],
						[
							'litho_social_share_network' => 'twitter',
						],
						[
							'litho_social_share_network' => 'linkedin',
						],
					],
				]
			);
			$this->add_control(
				'litho_share_buttons_list_view',
				[
					'label'        => esc_html__( 'View', 'litho-addons' ),
					'type'         => Controls_Manager::CHOOSE,
					'default'      => 'horizontal',
					'options'      => [
						'horizontal' => [
							'title' => esc_html__( 'Horizontal', 'litho-addons' ),
							'icon'  => 'eicon-ellipsis-h',
						],
						'vertical'   => [
							'title' => esc_html__( 'Vertical', 'litho-addons' ),
							'icon'  => 'eicon-ellipsis-v',
						],
					],
					'prefix_class' => 'elementor-icon-view-',
					'description'  => esc_html__( 'Changes will be reflected in the preview only after the page reload.', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_social_share_sticky_position',
				[
					'label'        => esc_html__( 'Sticky Icon', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'On', 'litho-addons' ),
					'label_off'    => esc_html__( 'Off', 'litho-addons' ),
					'return_value' => 'yes',
					'condition'    => [
						'litho_share_buttons_list_view' => 'vertical',
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_share_position',
				[
					'label'     => esc_html__( 'Icon Position', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'left',
					'options'   => [
						'left'  => [
							'title' => esc_html__( 'Left', 'litho-addons' ),
							'icon'  => 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'litho-addons' ),
							'icon'  => 'eicon-h-align-right',
						],
					],
					'toggle'    => true,
					'condition' => [
						'litho_social_share_sticky_position' => 'yes',
						'litho_share_buttons_list_view' => 'vertical',
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_share_align',
				[
					'label'     => esc_html__( 'Alignment', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'   => [
							'title' => esc_html__( 'Left', 'litho-addons' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'litho-addons' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'  => [
							'title' => esc_html__( 'Right', 'litho-addons' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'toggle'    => false,
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper' => 'text-align: {{VALUE}};',
					],
					'condition' => [
						'litho_share_buttons_list_view' => 'horizontal',
					],
				]
			);
			$this->add_control(
				'social_share_icon_size',
				[
					'label'   => esc_html__( 'Icon Size', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'extra-small-icon',
					'options' => [
						'default-icon'     => esc_html__( 'Default', 'litho-addons' ),
						'extra-small-icon' => esc_html__( 'Extra Small Icon', 'litho-addons' ),
						'small-icon'       => esc_html__( 'Small Icon', 'litho-addons' ),
						'medium-icon'      => esc_html__( 'Medium Icon', 'litho-addons' ),
						'large-icon'       => esc_html__( 'Large Icon', 'litho-addons' ),
						'extra-large-icon' => esc_html__( 'Extra Large Icon', 'litho-addons' ),
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_social_share_style',
				[
					'label' => esc_html__( 'General', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'litho_social_share' );

			$this->start_controls_tab(
				'litho_social_share_normal',
				[
					'label' => esc_html__( 'Normal', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_social_share_color',
				[
					'label'     => esc_html__( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper.social-share-default li a i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'litho_social_share_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper.social-share-default ul li a' => 'background-color: {{VALUE}};',
					],
					'condition'	=> [
						'social_share_layout_type!' => [ 'social-share-style-1', 'social-share-style-2' ], // NOT IN
					]
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'litho_social_share_list_active',
				[
					'label' => esc_html__( 'Hover', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_social_share_hover_color',
				[
					'label'     => esc_html__( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper li a:hover i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'litho_social_share_hover_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .social-share-wrapper.social-share-default li a:hover' => 'background-color: {{VALUE}};',
					],
					'condition'	=> [
						'social_share_layout_type!' => [ 'social-share-style-1', 'social-share-style-2' ], // NOT IN
					]
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'social_icon_border',
					'selector'  => '{{WRAPPER}} .social-share-wrapper li a',
					'separator' => 'before',
					'condition'	=> [
						'social_share_layout_type!' => [ 'social-share-style-1', 'social-share-style-2' ], // NOT IN
					]
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'social_share_box_shadow',
					'selector'  => '{{WRAPPER}} .social-share-wrapper li a',
				]
			);

			$this->add_control(
				'litho_social_share_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [
						'px',
						'%',
						'custom',
					],
					'selectors'  => [
						'{{WRAPPER}} .social-share-wrapper li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'	 => [
						'social_share_layout_type!' => [ 'social-share-style-1', 'social-share-style-2' ], // NOT IN
					]
				]
			);

			$this->add_responsive_control(
				'litho_social_share_icon_width',
				[
					'label'      => esc_html__( 'Width', 'litho-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [
						'px',
						'%',
						'custom',
					],
					'range'      => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
						'%'  => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default'    => [
						'unit' => 'px',
					],
					'selectors'  => [
						'{{WRAPPER}} .social-share-wrapper li a' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_share_icon_height',
				[
					'label'      => esc_html__( 'Height', 'litho-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [
						'px',
						'%',
						'custom',
					],
					'range'      => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
						'%'  => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default'    => [
						'unit' => 'px',
					],
					'selectors'  => [
						'{{WRAPPER}} .social-share-wrapper li a' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_share_icon_lineheight',
				[
					'label'      => esc_html__( 'Line Height', 'litho-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [
						'px',
						'%',
						'custom',
					],
					'range'      => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
						'%'  => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default'    => [
						'unit' => 'px',
					],
					'selectors'  => [
						'{{WRAPPER}} .social-share-wrapper li a' => 'line-height: {{SIZE}}{{UNIT}};',
					],
					'condition'	 => [
						'social_share_layout_type!' => [ 'social-share-style-1', 'social-share-style-2' ], // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_social_share_padding',
				[
					'label'      => esc_html__( 'Padding', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [
						'px',
						'%',
						'em',
						'rem',
						'custom',
					],
					'selectors'  => [
						'{{WRAPPER}} .social-share-wrapper li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_social_share_icon_margin',
				[
					'label'      => esc_html__( 'Margin', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [
						'px',
						'%',
						'em',
						'rem',
						'custom',
					],
					'selectors'  => [
						'{{WRAPPER}} .social-share-wrapper li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_social_icon_style',
				[
					'label' => esc_html__( 'Icon', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'litho_social_share_icon_size',
				[
					'label'      => esc_html__( 'Size', 'litho-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [
						'px',
					],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .social-share-wrapper li i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->end_controls_section();
		}

		/**
		 * Render Litho Social Share output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function render() {
			global $post;
			$settings     = $this->get_settings_for_display();
			$social_icons = $settings['litho_social_share_item'];
			$this->add_render_attribute( 'icon_class', 'class', [ $settings['social_share_icon_size'] ] );
			$this->add_render_attribute( 'icon_position', 'class', [ 'social-share-wrapper', $settings['social_share_layout_type'] ] );

			if ( 'yes' === $settings['litho_social_share_sticky_position'] ) {
				$this->add_render_attribute(
					'icon_position',
					'class',
					[
						'social-sticky-icon',
						'social-icon-position-' . $settings['litho_social_share_position'],
					]
				);
			}

			$litho_animation_div        = '';
			$litho_animation_style_list = array(
				'social-share-style-1',
				'social-share-style-2',
			);
			if ( in_array( $settings['social_share_layout_type'], $litho_animation_style_list, true ) ) {
				$litho_animation_div ='<span class="social-share-hover-effect"></span>';
			}
			?>
			<div <?php $this->print_render_attribute_string( 'icon_position' ); ?>>
				<ul <?php $this->print_render_attribute_string( 'icon_class' ); ?>>
				<?php
				foreach ( $social_icons as $index => $icon ) :

					$link_key          = 'link_' . $index;
					$social_media_name = $icon['litho_social_share_network'];

					$this->add_render_attribute(
						$link_key,
						'class',
						[
							'social-sharing-icon',
							'elementor-repeater-item-' . $icon['_id'],
							$social_media_name,
						]
					);
					
					$permalink  = get_permalink( $post->ID );
					$post_title = rawurlencode( get_the_title( $post->ID ) );
					switch ( $social_media_name ) {
						case 'facebook':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-facebook-f"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'twitter':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//twitter.com/share?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-x-twitter"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'linkedin':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-linkedin-in"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'pinterest':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//pinterest.com/pin/create/button/?url=<?php echo esc_url( $permalink ); ?>&amp;description=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-pinterest-p"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'reddit':
							?>
							<li><a  href="//reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-reddit"></i></a></li>
							<?php
							break;
						case 'stumbleupon':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-stumbleupon"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'digg':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//www.digg.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-digg"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'vk':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//vk.com/share.php?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-vk"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'xing':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//www.xing.com/app/user?op=share&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" data-pin-custom="true"><i class="fa-brands fa-xing"></i></a></li>
							<?php
							break;
						case 'telegram':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//t.me/share/url?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-telegram-plane"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'ok':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//connect.ok.ru/offer?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-odnoklassniki"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'viber':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//viber://forward?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-viber"></i></a></li>
							<?php
							break;
						case 'whatsapp':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//api.whatsapp.com/send?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-whatsapp"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						case 'skype':
							?>
							<li><a <?php $this->print_render_attribute_string( $link_key ); ?> href="//web.skype.com/share?source=button&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-skype"></i><?php echo sprintf( '%s', $litho_animation_div ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></li>
							<?php
							break;
						}
					endforeach;
					?>
				</ul>
			</div>
			<?php
		}
	}
}
