<?php
namespace LithoAddons\Widgets;

use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for lists.
 *
* @package Litho
 */

// If class `Lists` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Lists' ) ) {
	/**
	 * Define Lists class
	 */
	class Lists extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-lists';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Lists', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-bullet-list';
		}

		/**
		 * Retrieve the list of scripts the lists widget depended on.
		 *
		 * Used to set scripts dependencies required to run the widget.
		 *
		 * @access public
		 *
		 * @return array Widget scripts dependencies.
		 */
		public function get_script_depends() {
			return [ 'elementor-frontend' ];
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
			return [ 'icon list', 'icon', 'list' ];
		}

		/**
		 * Register lists widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_lists_settings_section',
				[
					'label' 		=> __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_view',
				[
					'label' 		=> __( 'Layout', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'traditional',
					'options' 		=> [
						'traditional' 	=> [
							'title' 	=> __( 'Default', 'litho-addons' ),
							'icon' 		=> 'eicon-editor-list-ul',
						],
						'inline' 	=> [
							'title' 	=> __( 'Inline', 'litho-addons' ),
							'icon' 		=> 'eicon-ellipsis-h',
						],
					],
					'render_type' 	 => 'template',
					'classes' 		 => 'elementor-control-start-end',
					'label_block' 	 => false,
					'style_transfer' => true,
					'prefix_class' 	 => 'elementor-icon-list--layout-',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_lists_content_section',
				[
					'label' 		=> __( 'Lists', 'litho-addons' ),
				]
			);
			$repeater = new Repeater();
			$repeater->add_control(
				'litho_text',
				[
					'label' 		=> __( 'Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'label_block' 	=> true,
					'placeholder' 	=> __( 'List Item', 'litho-addons' ),
					'default' 		=> __( 'List Item', 'litho-addons' ),
				]
			);
			$repeater->add_control(
				'litho_selected_icon',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'default' 		=> [
						'value' 		=> 'fa-solid fa-check',
						'library' 		=> 'fa-solid',
					],
					'fa4compatibility' 	=> 'icon',
				]
			);
			$repeater->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_icon_list',
				[
					'label' 		=> '',
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_text' 				=> __( 'List Item #1', 'litho-addons' ),
							'litho_selected_icon' 	=> [
								'value' 		=> 'fa-solid fa-check',
								'library' 		=> 'fa-solid',
							],
						],
						[
							'litho_text' 				=> __( 'List Item #2', 'litho-addons' ),
							'litho_selected_icon' 	=> [
								'value' 		=> 'fa-solid fa-times',
								'library'		=> 'fa-solid',
							],
						],
						[
							'litho_text' 				=> __( 'List Item #3', 'litho-addons' ),
							'litho_selected_icon' 	=> [
								'value' 		=> 'fa-solid fa-dot-circle',
								'library' 		=> 'fa-solid',
							],
						],
					],
					'title_field' 	=> '{{{ elementor.helpers.renderIcon( this, litho_selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ litho_text }}}',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_icon_list',
				[
					'label' 		=> __( 'List', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_section_icon_list_tabs' );
				$this->start_controls_tab( 'litho_section_icon_list_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_section_icon_list_bg_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_section_icon_list_border',
							'selector'      => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item',
						]
					);
					$this->add_responsive_control(
						'litho_section_icon_list_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_section_icon_list_box_shadow',
							'exclude'       => [
								'box_shadow_position',
							],
							'selector'      => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item',
						]
					);
					$this->add_responsive_control(
						'litho_lists_box_padding',
						[
							'label'         => __( 'Padding', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'litho_lists_box_margin',
						[
							'label'         => __( 'Margin', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_section_icon_list_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_section_icon_list_hover_bg_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_section_icon_list_border_hover',
							'selector'      => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover',
						]
					);
					$this->add_responsive_control(
						'litho_section_icon_list_border_hover_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_section_icon_list_hover_box_shadow',
							'exclude'       => [
								'box_shadow_position',
							],
							'selector'      => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover',
						]
					);
					$this->add_responsive_control(
						'litho_lists_box_hover_padding',
						[
							'label'         => __( 'Padding', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'litho_lists_box__hover_transition',
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
								'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'transition-duration: {{SIZE}}s',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_space_between',
				[
					'label' 		=> __( 'Space Between', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'max' 		=> 50,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [ 'litho_view' 	=> 'traditional' ],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_icon_align',
				[
					'label' 		=> __( 'Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left' 		=> [
							'title' 	=> __( 'Left', 'litho-addons' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 	=> [
							'title' 	=> __( 'Center', 'litho-addons' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right'	 	=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
					'prefix_class' 	=> 'elementor%s-align-',
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_icon_style',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_icon_tabs' );
				$this->start_controls_tab( 'litho_icon_color_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_icon_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors' 	=> [
								'{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_icon_color_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_icon_color_hover',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'default' 		=> [
						'size' 			=> 14,
					],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 6,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-icon-list-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_icon_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-list-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_self_align',
				[
					'label' 		=> __( 'Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left' 		=> [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'center' 	=> [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' 	=> 'eicon-h-align-center',
						],
						'right' 	=> [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-list-icon' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_text_style',
				[
					'label' 		=> __( 'Text', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_text_tabs' );
				$this->start_controls_tab( 'litho_text_color_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_text_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_text_color_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_text_color_hover',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_text_indent',
				[
					'label' 		=> __( 'Text Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px'	 	=> [
							'max' 	=> 50,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'litho_icon_typography',
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}} .elementor-icon-list-text',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render icon list widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			$this->add_render_attribute( 'litho_icon_list', 'class', 'elementor-icon-list-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elementor-icon-list-item' );

			if ( 'inline' === $settings['litho_view'] ) {
				$this->add_render_attribute( 'litho_icon_list', 'class', 'elementor-inline-items' );
				$this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
			}
			?>
			<ul <?php $this->print_render_attribute_string( 'litho_icon_list' ); ?>>
				<?php
				foreach ( $settings['litho_icon_list'] as $index => $item ) {
					$repeater_setting_key = $this->get_repeater_setting_key( 'litho_text', 'litho_icon_list', $index );
					$this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-icon-list-text' );
					$migration_allowed = Icons_Manager::is_migration_allowed();
					$lib_class = ( isset( $item['litho_selected_icon']['library'] ) && 'svg' === $item['litho_selected_icon']['library'] ) ? ' svg-icon': '';
					?>
					<li class="elementor-icon-list-item list-item<?php echo $lib_class; // phpcs:ignore ?>">
						<?php
						if ( ! empty( $item['litho_link']['url'] ) ) {
							$link_key = 'litho_link_' . $index;
							$this->add_link_attributes( $link_key, $item['litho_link'] );
							?>
								<a <?php $this->print_render_attribute_string( $link_key ); ?>>
							<?php
						}

						$migrated = isset( $item['__fa4_migrated']['litho_selected_icon'] );
						$is_new = ! isset( $item['icon'] ) && $migration_allowed;

						if ( ! empty( $item['icon'] ) || ( ! empty( $item['litho_selected_icon']['value'] ) && $is_new ) ) { 
							?>
							<span class="elementor-icon-list-icon">
								<?php
								if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $item['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
								} else { ?>
										<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
								<?php } ?>
							</span>
						<?php } ?>
						<span <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>><?php echo esc_html( $item['litho_text'] ); ?></span>
						<?php if ( ! empty( $item['litho_link']['url'] ) ) { ?>
							</a>
							<?php
						}
						?>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		}
	}
}
