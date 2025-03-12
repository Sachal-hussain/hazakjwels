<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

use LithoAddons\Classes\Elementor_Templates;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Hamburger Menu.
 *
 * @package Litho
 */

// If class `Hamburger_Menu` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Hamburger_Menu' ) ) {

	class Hamburger_Menu extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-hamburger-menu';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Hamburger Menu', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-menu-bar';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 * @access public
		 *
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return [ 'litho', 'litho-header' ];
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
			return [ 'menu', 'nav', 'navigation', 'hamburger', 'toggle' ];
		}
		/**
		 * Register the widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_hamburger_menu_general_section',
				[
					'label' => __( 'Menu', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_hamburger_menu_layout_type',
				[
					'label'   => __( 'Select Style', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'hamburger-menu-default',
					'options' => [
						'hamburger-menu-default' => __( 'Default', 'litho-addons' ),
						'hamburger-menu-modern'  => __( 'Hamburger Menu Modern', 'litho-addons' ),
						'hamburger-menu-half'    => __( 'Hamburger Menu Half', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_item_template_id',
				[
					'label'       => __( 'Choose Template', 'litho-addons' ),
					'label_block' => true,
					'type'        => Controls_Manager::SELECT,
					'default'     => '0',
					'options'     => Elementor_Templates::get_elementor_templates_options(),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_hamburger_menu_settings_section',
				[
					'label' => __( 'Settings', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_hamburger_menu_position',
				[
					'label'   => __( 'Select Direction', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'right',
					'options' => [
						'right' => __( 'Right', 'litho-addons' ),
						'left'  => __( 'Left', 'litho-addons' ),
					],
				]
			);
			$this->add_responsive_control(
				'litho_hamburger_menu_width',
				[
					'label'      => __( 'Menu Panel Width', 'litho-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px', 'custom' ],
					'range'      => [
						'%' => [
							'max' => 100,
							'min' => 20,
						],
						'px' => [
							'max' => 1000,
							'min' => 200,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .hamburger-menu-half, {{WRAPPER}} .hamburger-menu-modern' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_hamburger_menu_layout_type' => [ 'hamburger-menu-half', 'hamburger-menu-modern' ], // IN
					],
				]
			);

			$this->add_control(
				'litho_toggle_icon_text',
				[
					'label'       => __( 'Toggle Icon with Text', 'litho-addons' ),
					'type'        => Controls_Manager::TEXT,
					'description' => __( 'Add menu word with toggle icon.', 'litho-addons' ),
					'label_block' => true,
					'dynamic'     => [
						'active' => true,
					],
				]
			);

			$this->add_control(
				'litho_heading_close_icon',
				[
					'label'     => __( 'Close Icon', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_close_icon',
				[
					'label'            => __( 'Close Icon', 'litho-addons' ),
					'type'             => Controls_Manager::ICONS,
					'label_block'      => true,
					'show_label'       => false,
					'fa4compatibility' => 'icon',
					'default'          => [
						'value'   => 'fa-solid fa-times',
						'library' => 'fa-solid',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_left_menu_container_style_section',
				[
					'label'      => __( 'Hamburger Style', 'litho-addons' ),
					'tab'        => Controls_Manager::TAB_STYLE,
					'show_label' => false,
				]
			);

			$this->add_responsive_control(
				'litho_hamburger_menu_color',
				[
					'label'     => __( 'Hamburger Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header-push-button span'   => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'    => 'litho_hamburger_menu_background',
					'types'   => [ 'classic', 'gradient' ],
					'exclude' => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'       => '{{WRAPPER}} .header-push-button .push-button',
					'fields_options' => [
						'background' => [
								'label' => __( 'Background Color', 'litho-addons' ),
						]
					]
				]
			);
			$this->add_control(
				'litho_menu_toggle_icon_text_heading',
				[
					'label'         => __( 'Toggle Icon with Text', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'litho_menu_mobile_toggle_text_typography',
					'selector' => '{{WRAPPER}} .toggle-menu-word',
				]
			);
			$this->add_control(
				'litho_menu_mobile_toggle_text_color',
				[
					'label'     => __( 'Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .toggle-menu-word' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_menu_toggle_text_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'rem', 'em', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .toggle-menu-word' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_hamburger_menu_open_panel_style_section',
				[
					'label' => __( 'Hamburger Menu Panel', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_hamburger_menu_shadow',
					'selector'      => '{{WRAPPER}} .hamburger-menu-half .hamburger-menu, {{WRAPPER}} .hamburger-menu-modern .hamburger-menu',
					'condition'     => [
						'litho_hamburger_menu_layout_type' => [ 'hamburger-menu-modern', 'hamburger-menu-half' ], // IN
					],
				]
			);
			$this->start_controls_tabs( 'litho_hamburger_menu_background_panel_tabs_styles' );
				$this->start_controls_tab(
					'litho_hamburger_menu_background_panel_tabs_control_normal',
					[
						'label'		=> __( 'Normal', 'litho-addons' ),
						'condition'     => [
							'litho_hamburger_menu_layout_type' => [ 'hamburger-menu-default' ], // IN
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'		=> 'litho_hamburger_menu_background_panel',
						'selector'	=> '{{WRAPPER}} .hamburger-menu',
						'fields_options' 	=> [
							'color' 	=> [
								'responsive' => true
							]
						],
						'condition'     => [
							'litho_hamburger_menu_layout_type' => [ 'hamburger-menu-default', 'hamburger-menu-modern', 'hamburger-menu-half' ], // IN
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_hamburger_menu_background_panel_tabs_control_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
						'condition'     => [
							'litho_hamburger_menu_layout_type' => [ 'hamburger-menu-default' ], // IN
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'          => 'litho_hamburger_menu_background_panel_hover',
						'selector'      => '{{WRAPPER}} .hamburger-menu:before',
						'condition'     => [
							'litho_hamburger_menu_layout_type' => [ 'hamburger-menu-default' ], // IN
						],
					]
				);
				$this->add_control(
					'litho_hamburger_menu_background_panel_hover_transition',
					[
						'label'         => __( 'Transition Duration', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'range'         => [
							'px'        => [
								'max'       => 3,
								'step'      => 0.1,
							],
						],
						'render_type'   => 'ui',
						'selectors'     => [
							'{{WRAPPER}} .hamburger-menu:before' => 'transition-duration: {{SIZE}}s',
						],
						'condition'     => [
							'litho_hamburger_menu_layout_type' => [ 'hamburger-menu-default' ], // IN
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_hamburger_menu_close_icon_style_section',
				[
					'label'         => __( 'Close Icon', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_hamburger_menu_close_icon_tabs_styles' );
				$this->start_controls_tab(
					'litho_hamburger_menu_close_icon_tabs_control_normal',
					[
						'label'         => __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_responsive_control(
					'litho_hamburger_menu_close_icon_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'selectors'     => [
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu'     => 'color: {{VALUE}};',
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu svg' => 'fill: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'litho_hamburger_menu_close_icon_font_size',
					[
						'label'         => __( 'Size', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'size_units'    => [ 'px', 'custom' ],
						'range'         => [ 'px'   => [ 'min' => 10, 'max' => 100 ] ],
						'selectors'     => [
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu'     => 'font-size: {{SIZE}}{{UNIT}}',
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
						],
					]
				);
				$this->add_responsive_control(
					'litho_hamburger_menu_close_icon_line_height',
					[
						'label'         => __( 'Line Height', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'size_units'    => [ 'px', 'custom' ],
						'range'         => [ 'px'   => [ 'min' => 1, 'max' => 300 ] ],
						'selectors'     => [
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu' => 'line-height: {{SIZE}}{{UNIT}}',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_hamburger_menu_close_icon_tabs_control_hover',
					[
						'label'         => __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_responsive_control(
					'litho_hamburger_menu_close_icon_color_hover',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'selectors'     => [
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu:hover'     => 'color: {{VALUE}};',
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu:hover svg' => 'fill: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'litho_hamburger_menu_close_icon_font_size_hover',
					[
						'label'         => __( 'Size', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'size_units'    => [ 'px', 'custom' ],
						'range'         => [ 'px'   => [ 'min' => 10, 'max' => 100 ] ],
						'selectors'     => [
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu:hover'     => 'font-size: {{SIZE}}{{UNIT}}',
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu:hover svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
						],
					]
				);
				$this->add_responsive_control(
					'litho_hamburger_menu_close_icon_line_height_hover',
					[
						'label'         => __( 'Line Height', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'size_units'    => [ 'px', 'custom' ],
						'range'         => [ 'px'   => [ 'min' => 1, 'max' => 300 ] ],
						'selectors'     => [
							'{{WRAPPER}} .hamburger-menu-wrapper .close-menu:hover' => 'line-height: {{SIZE}}{{UNIT}}',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * Render hamburger menu widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render( $instance = [] ) {

			$settings = $this->get_settings_for_display();

			$migrated = isset( $settings['__fa4_migrated']['litho_close_icon'] );
			$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			$this->add_render_attribute(
				[
					'toggle-menu'	=> [
						'href' => 'javascript:void(0);',
					],
					'navigation-wrapper'    => [
						'class' => 'hamburger-menu',
					],
					'close-menu'            => [
						'class' => 'close-menu',
						'href'  => 'javascript:void(0);',
					],
				]
			);

			$this->add_render_attribute(
				[
					'hamburger-menu-wrapper' => [
						'class' => [
							'hamburger-menu-wrapper',
							$settings['litho_hamburger_menu_layout_type'],
							$settings['litho_hamburger_menu_position'],
						],
					],
				]
			);

			$this->add_render_attribute(
				'toggle-menu-wrapper',
				'class',
				[
					'header-push-button',
				]
			);
			$this->add_render_attribute(
				'toggle-menu',
				'class',
				[
					'push-button',
				]
			);
			?>
			<div <?php $this->print_render_attribute_string( 'toggle-menu-wrapper' ); ?>>
			<?php
			if ( isset( $settings['litho_toggle_icon_text'] ) && ! empty( $settings['litho_toggle_icon_text'] ) ) {
				echo '<div class="toggle-menu-word alt-font">' . esc_html( $settings['litho_toggle_icon_text'] ) . '</div>';
			}
			?>
				<a <?php $this->print_render_attribute_string( 'toggle-menu' ); ?>>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
			<div <?php $this->print_render_attribute_string( 'hamburger-menu-wrapper' ); ?>>
				<?php
				if ( '0' !== $settings['litho_item_template_id'] ) {
					$template_content = litho_get_builder_content_for_display( $settings['litho_item_template_id'] );
					if ( ! empty( $template_content ) ) {
						if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
							$edit_url = add_query_arg(
								array(
									'elementor' => '',
								),
								get_permalink( $settings['litho_item_template_id'] )
							);
							echo sprintf( '<div class="edit-template-with-light-box elementor-template-edit-cover" data-template-edit-link="%s"><i aria-hidden="true" class="eicon-edit"></i></i><span>%s</span></div>', esc_url( $edit_url ), esc_html__( 'Edit Template', 'litho-addons' ) );
						}
						?>
						<div <?php $this->print_render_attribute_string( 'navigation-wrapper' ); ?>>
							<a <?php $this->print_render_attribute_string( 'close-menu' ); ?>>
								<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_close_icon']['value'] ) ) : ?>
									<?php
									if ( $is_new || $migrated ) {
										Icons_Manager::render_icon( $settings['litho_close_icon'], [ 'aria-hidden' => 'true' ] );
									} else { ?>
										<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
									<?php } ?>
								<?php endif; ?>
							</a>
							<?php printf( '%s', $template_content ); // phpcs:ignore ?>
						</div>
						<?php
					} else {
						printf( '%s', $this->no_template_content_message() ); // phpcs:ignore
					}
				} else {
					printf( '%s', $this->no_template_content_message() ); // phpcs:ignore
				}
				?>
			</div>
			<?php
		}
		/**
		 * Return available menus list
		 */
		public function get_menus_list() {

			$menus      = wp_get_nav_menus();
			$menus_list = wp_list_pluck( $menus, 'name', 'term_id' );
			$parent     = isset( $_GET['parent_menu'] ) ? absint( $_GET['parent_menu'] ) : 0; // phpcs:ignore

			if ( 0 < $parent && isset( $menus_list[ $parent ] ) ) {
				unset( $menus_list[ $parent ] );
			}
			return $menus_list;
		}
		/**
		 * Return template messages
		 */
		public function no_template_content_message() {

			$message = esc_html__( 'Template is not defined. ', 'litho-addons' );

			$link = add_query_arg(
				array(
					'post_type'     => 'elementor_library',
					'action'        => 'elementor_new_post',
					'_wpnonce'      => wp_create_nonce( 'elementor_action_new_post' ),
					'template_type' => 'section',
				),
				esc_url( admin_url( '/edit.php' ) )
			);

			$new_link = esc_html__( 'Select an existing template or create a ', 'litho-addons' ) . '<a class="elementor-custom-new-template-link elementor-clickable" href="' . $link . '">' . esc_html__( 'new one', 'litho-addons' ) . '</a>';

			return sprintf(
				'<div class="elementor-no-template-message alert alert-warning"><a class="close-menu" href="javascript:void(0);"><i aria-hidden="true" class="fa-solid fa-times"></i></a><div class="message">%1$s%2$s</div></div>',
				$message,
				( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) ? $new_link : ''
			);
		}
	}
}
