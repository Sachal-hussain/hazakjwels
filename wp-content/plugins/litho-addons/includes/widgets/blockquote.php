<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for blockquote.
 *
 * @package Litho
 */

// If class `Blockquote` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Blockquote' ) ) {
	/**
	 * Define class Blockquote.
	 */	
	class Blockquote extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-blockquote';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Blockquote', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-blockquote';
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
		 * Register blockquote widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_blockquote_general_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_blockquote_icon',
				[
					'label'         => __( 'Icon', 'litho-addons' ),
					'type'          => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
				]
			);
			$this->add_control(
				'litho_blockquote_content',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'type'          => Controls_Manager::TEXTAREA,
					'dynamic'       => [
						'active' => true,
					],
					'default'       => __( 'Enter your quote', 'litho-addons' ),
					'placeholder'   => __( 'Enter your quote', 'litho-addons' ),
					'rows' => 10,
				]
			);

			$this->add_control(
				'litho_blockquote_author_name',
				[
					'label' => __( 'Author', 'litho-addons' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => __( 'Tom Harry', 'litho-addons' ),
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blockquote_general_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blockquote_typography',
					'selector'	=> '{{WRAPPER}} blockquote',
				]
			);
			$this->add_control(
				'litho_blockquote_color',
				[
					'label' => __( 'Text Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} blockquote' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'litho_blockquote_border',
					'selector' => '{{WRAPPER}} blockquote',
				]
			);

			$this->add_responsive_control(
				'litho_blockquote_padding',
				[
					'label'      => __( 'Padding', 'litho-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} blockquote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blockquote_icon_style_section',
				[
					'label'     => __( 'Icon', 'litho-addons' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'litho_blockquote_icon[value]!' => '',
					],
				]
			);
			$this->add_control(
				'litho_blockquote_icon_color',
				[
					'label'     => __( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} blockquote i'   => 'color: {{VALUE}}',
						'{{WRAPPER}} blockquote svg' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_icon_size',
				[
					'label'     => __( 'Size', 'litho-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} blockquote i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} blockquote i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} blockquote i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blockquote_content_style_section',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} blockquote > p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} blockquote > p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blockquote_author_style_section',
				[
					'label'         => __( 'Author', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blockquote_author_typography',
					'selector'	=> '{{WRAPPER}} blockquote footer',
				]
			);
			$this->add_control(
				'litho_blockquote_author_color',
				[
					'label'		=> __( 'Text Color', 'litho-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} blockquote footer' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_author_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} blockquote footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blockquote_author_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} blockquote footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render blockquote widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();
			$migrated = isset( $settings['__fa4_migrated']['litho_blockquote_icon'] );
			$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			$this->add_inline_editing_attributes( 'litho_blockquote_content' );
			$this->add_inline_editing_attributes( 'litho_blockquote_author_name', 'none' );

			if ( ! empty( $settings['litho_blockquote_content'] ) || ! empty( $settings['litho_blockquote_author_name'] ) || ! empty( $settings['icon'] ) || ! empty( $settings['litho_blockquote_icon']['value'] ) ) {
				?><blockquote class="elementor-blockquote">
					<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_blockquote_icon']['value'] ) ) : ?>
						<?php if ( $is_new || $migrated ) :
							Icons_Manager::render_icon( $settings['litho_blockquote_icon'], [ 'aria-hidden' => 'true' ] );
						else : ?>
							<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( ! empty( $settings['litho_blockquote_content'] ) ) : ?>
						<p><?php echo sprintf( '%s', $settings['litho_blockquote_content'] ); // phpcs:ignore ?></p>
					<?php endif ?>
					<?php if ( ! empty( $settings['litho_blockquote_author_name'] ) ) : ?>
						<footer><?php echo esc_html( $settings['litho_blockquote_author_name'] ); ?></footer>
					<?php endif ?>
				</blockquote><?php
			}
		}
	}
}
