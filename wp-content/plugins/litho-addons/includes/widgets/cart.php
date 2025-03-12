<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for Mini Cart.
 *
 * @package Litho
 */

$litho_litho_mini_cart_hide = get_theme_mod( 'litho_litho_mini_cart_hide', '1' );

if ( 1 != $litho_litho_mini_cart_hide ) {
	return;
}

// If class `Cart` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Cart' ) ) {

	class Cart extends Widget_Base {

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
			return 'litho-woocommerce-cart';
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
			return __( 'Litho Mini Cart', 'litho-addons' );
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
			return 'eicon-cart';
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
			return [ 'litho', 'litho-header' ];
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
			return [ 'cart', 'bag', 'shop' ];
		}

		/**
		 * Register the widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 *
		 * @access protected
		 */

		protected function register_controls() {

			$this->start_controls_section(
				'litho_section_menu_icon_content',
				[
					'label' => __( 'General', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_alignment',
				[
					'label' => __( 'Alignment', 'litho-addons' ),
					'type' => Controls_Manager::CHOOSE,
					'label_block' => false,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_general_style',
				[
					'label' => __( 'General', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_cart_content_box_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 300 ] ],
					'selectors'     => [
						'{{WRAPPER}} .litho-top-cart-wrapper, {{WRAPPER}} .top-cart-wrapper' => 'line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_toggle_style',
				[
					'label' => __( 'Cart Icon', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'litho_toggle_button_colors' );
				$this->start_controls_tab( 'litho_toggle_button_normal_colors', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_responsive_control(
						'litho_mini_cart_icon_color',
						[
							'label' => __( 'Icon Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .litho-cart-icon' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'litho_mini_cart_indicator_color',
						[
							'label' => __( 'Indicator Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .litho-mini-cart-counter' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'litho_mini_cart_indicator_background_color',
						[
							'label' => __( 'Indicator Background Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .litho-mini-cart-counter' => 'background-color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_toggle_button_hover_colors', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_responsive_control(
						'litho_mini_cart_icon_hover_color',
						[
							'label' => __( 'Icon Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper:hover .litho-cart-icon' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'litho_mini_cart_indicator_hover_color',
						[
							'label' => __( 'Indicator Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper:hover .litho-mini-cart-counter' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'litho_mini_cart_indicator_hover_background_color',
						[
							'label' => __( 'Indicator Background Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper:hover .litho-mini-cart-counter' => 'background-color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_mini_cart_icon_size',
				[
					'label' => __( 'Size', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
					],
					'size_units' => [ 'px', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .litho-top-cart-wrapper .litho-cart-icon' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_mini_cart_style',
				[
					'label'		=> __( 'Cart', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_subtotal_style',
				[
					'type'			=> Controls_Manager::HEADING,
					'label'			=> __( 'Subtotal', 'litho-addons' ),
					'separator'		=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'			=> 'litho_mini_cart_subtotal_typography',
					'selector'		=> '{{WRAPPER}} .litho-top-cart-wrapper .woocommerce-mini-cart__total strong, {{WRAPPER}} .litho-top-cart-wrapper .woocommerce-mini-cart__total .amount',
				]
			);
			$this->add_control(
				'litho_mini_cart_subtotal_color',
				[
					'label'			=> __( 'Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-top-cart-wrapper .total strong, {{WRAPPER}} .litho-top-cart-wrapper .total .amount' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_mini_cart_product_tabs_style',
				[
					'label'		=> __( 'Products', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_product_title_style',
				[
					'type'			=> Controls_Manager::HEADING,
					'label'			=> __( 'Product Title', 'litho-addons' ),
					'separator'		=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'			=> 'litho_mini_cart_product_title_typography',
					'global'		=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'		=> '{{WRAPPER}} .cart_list li .product-detail a',
				]
			);
			$this->start_controls_tabs( 'litho_mini_cart_product_title_tabs' );
				$this->start_controls_tab( 'litho_mini_cart_product_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_mini_cart_product_title_color',
						[
							'label'			=> __( 'Color', 'litho-addons' ),
							'type'			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .cart_list li .product-detail a' => 'color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_mini_cart_product_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_mini_cart_product_title_hover_color',
						[
							'label'			=> __( 'Color', 'litho-addons' ),
							'type'			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .cart_list li .product-detail a:hover' => 'color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_heading_product_price_style',
				[
					'type'			=> Controls_Manager::HEADING,
					'label'			=> __( 'Product Price', 'litho-addons' ),
					'separator'		=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'			=> 'litho_mini_cart_product_price_typography',
					'global'		=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'		=> '{{WRAPPER}} .litho-top-cart-wrapper .cart_list li .product-detail .quantity, {{WRAPPER}} .litho-top-cart-wrapper .cart_list li .product-detail .amount',
				]
			);
			$this->add_control(
				'litho_mini_cart_product_price_color',
				[
					'label'			=> __( 'Color', 'litho-addons' ),
					'type'			=> Controls_Manager::COLOR,
					'selectors'		=> [
						'{{WRAPPER}} .litho-top-cart-wrapper .cart_list li .product-detail .quantity, {{WRAPPER}} .litho-top-cart-wrapper .cart_list li .product-detail .amount' => 'color: {{VALUE}}',

					],
				]
			);

			$this->add_control(
				'litho_heading_product_separator_style',
				[
					'type' => Controls_Manager::HEADING,
					'label' => __( 'Separator', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_mini_cart_separator_style',
				[
					'label' => __( 'Style', 'litho-addons' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => __( 'None', 'litho-addons' ),
						'solid' => __( 'Solid', 'litho-addons' ),
						'double' => __( 'Double', 'litho-addons' ),
						'dotted' => __( 'Dotted', 'litho-addons' ),
						'dashed' => __( 'Dashed', 'litho-addons' ),
						'groove' => __( 'Groove', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .litho-top-cart-wrapper .cart_list li' => 'border-bottom-style: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'litho_mini_cart_separator_color',
				[
					'label' => __( 'Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .litho-top-cart-wrapper .cart_list li' => 'border-color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_mini_cart_separator_width',
				[
					'label' => __( 'Weight', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .litho-top-cart-wrapper .cart_list li' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_mini_cart_style_buttons',
				[
					'label' => __( 'Buttons', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'litho_mini_cart_buttons_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}} .litho-top-cart-wrapper .buttons a',
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_mini_cart_border_radius',
				[
					'label' => __( 'Border Radius', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .litho-top-cart-wrapper .buttons a' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'litho_heading_view_cart_button_style',
				[
					'type' => Controls_Manager::HEADING,
					'label' => __( 'View Cart', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->start_controls_tabs( 'litho_view_cart_buttons' );
				$this->start_controls_tab( 'litho_view_cart_buttons_normal_colors', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_view_cart_button_text_color',
						[
							'label' => __( 'Text Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'litho_view_cart_button_background_color',
						[
							'label' => __( 'Background Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_view_cart_buttons_hover_colors', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_view_cart_button_text_hover_color',
						[
							'label' => __( 'Text Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a:hover' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_view_cart_button_background_hover_color',
						[
							'label' => __( 'Background Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_view_cart_button_border_hover_color',
						[
							'label' => __( 'Border Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a:hover' => 'border-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'litho_view_cart_border',
					'selector' => '{{WRAPPER}} .litho-top-cart-wrapper .buttons a',
				]
			);
			$this->add_control(
				'litho_heading_checkout_button_style',
				[
					'type' => Controls_Manager::HEADING,
					'label' => __( 'Checkout', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->start_controls_tabs( 'litho_checkout_buttons' );
				$this->start_controls_tab( 'litho_checkout_buttons_normal_colors', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_checkout_button_text_color',
						[
							'label' => __( 'Text Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a.checkout' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_checkout_button_background_color',
						[
							'label' => __( 'Background Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a.checkout' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_checkout_buttons_hover_colors', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_checkout_button_text_hover_color',
						[
							'label' => __( 'Text Color', 'litho-addons' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a.checkout:hover' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_checkout_button_background_hover_color',
						[
							'label'		=> __( 'Background Color', 'litho-addons' ),
							'type'		=> Controls_Manager::COLOR,
							'selectors'	=> [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a.checkout:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_checkout_button_border_hover_color',
						[
							'label'		=> __( 'Border Color', 'litho-addons' ),
							'type'		=> Controls_Manager::COLOR,
							'selectors'	=> [
								'{{WRAPPER}} .litho-top-cart-wrapper .buttons a.checkout:hover' => 'border-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'		=> 'litho_checkout_border',
					'selector'	=> '{{WRAPPER}} .litho-top-cart-wrapper .buttons a.checkout',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render mini cart widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			if ( ! is_woocommerce_activated() ) {
				return;
			}

			if ( null === WC()->cart ) {
				return;
			}

			$option_name   = 'elementor_use_mini_cart_template';
			$new_value_no  = 'no';
			$new_value_yes = 'no';

			if ( get_option( $option_name ) !== false ) {
				update_option( $option_name, $new_value_no );
			} else {
				$autoload = 'no';
				add_option( $option_name, $new_value_no, '', $autoload );
			}

			echo '<div class="widget_shopping_cart_content">';
				wc_get_template( 'cart/mini-cart.php' );
			echo '</div>';

			if ( get_option( $option_name ) !== false ) {
				update_option( $option_name, $new_value_yes );
			} else {
				$autoload = 'no';
				add_option( $option_name, $new_value_yes, '', $autoload );
			}
		}
	}
}
