<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Icon_Group_Control;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for search form.
 *
* @package Litho
 */

// If class `Search_form` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Search_form' ) ) {

	class Search_form extends Widget_Base {

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
			return 'litho-search-form';
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
			return __( 'Litho Search Form', 'litho-addons' );
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
			return 'eicon-search';
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
			return [ 'litho', 'litho-header' ];
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
				'litho_search_form_section_general',
				[
					'label'         => __( 'Search Form', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_search_form_style',
				[
					'label'			=> __( 'Select style', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'default'		=> 'popup',
					'options'		=> [
						'popup'			=> __( 'Popup', 'litho-addons' ),
						'simple'		=> __( 'Simple', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			
			$this->add_control(
				'litho_search_form_label',
				[
					'label'         => __( 'Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'default'       => __( 'What are you looking for?', 'litho-addons' ),
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_search_form_placeholder',
				[
					'label'         => __( 'Placeholder', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'default'       => __( 'Enter your keywords...', 'litho-addons' ),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_search_form_section_icon',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			Icon_Group_Control::icon_fields( 
				$this,
				'primary',
				[
					'value' 	=> 'icon-magnifier',
					'library' 	=> 'simpleline',
				]
			); 

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_search_form_button_section',
				[
					'label'         => __( 'Submit Button', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_search_form_buton_text',
				[
					'label'         => __( 'Button Text', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'Search', 'litho-addons' ),
					'condition' 	=> [
						'litho_search_form_style' => [ 'simple' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_enable_custom_image',
				[
					'label' 		=> __( 'Custom Image?', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
				]
			);
			$this->add_control(
				'litho_search_form_button_icon',
				[
					'label' 			=> __( 'Icon', 'litho-addons' ),
					'type' 				=> Controls_Manager::ICONS,
					'default' 			=> [
						'value' 		=> 'icon-magnifier',
						'library' 		=> 'simpleline',
					],
					'label_block' 		=> true,
					'fa4compatibility' 	=> 'icon',
					'condition' 	=> [
						'litho_enable_custom_image' => '',
					],
				]
			);
			$this->add_control(
				'litho_search_form_button_image',
				[
					'label' 		=> __( 'Choose Image', 'litho-addons' ),
					'type' 			=> Controls_Manager::MEDIA,
					'dynamic'		=> [
						'active' => true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'condition' 	=> [
						'litho_enable_custom_image!' => '',
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
					'condition' 	=> [
						'litho_enable_custom_image!' => '',
					],
				]
			);
			$this->add_responsive_control(
				'litho_search_form_button_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px' 	=> ['min' => 6, 'max' => 100 ] ],
					'condition' 	=> [
						'litho_enable_custom_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .search-form-box .search-button, {{WRAPPER}} .search-form-simple-box .search-button > i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_search_form_button_icon_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'em' => [ 'min' => 0, 'max' => 5 ] ],
					'condition' 	=> [
						'litho_enable_custom_image' => '',
						'litho_search_form_style' => [ 'popup' ], //IN
					],
					'selectors' 	=> [
						'{{WRAPPER}} .search-form-box .search-button, {{WRAPPER}} .search-form-simple-box .search-button' => 'padding: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_search_form_button_icon_tabs' );
				$this->start_controls_tab(
					'litho_search_form_button_icon_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_enable_custom_image' => '',
							'litho_search_form_style' => [ 'popup' ], // IN
						],
					]
				);
				$this->add_responsive_control(
					'litho_search_form_button_icon_primary_color',
					[
						'label' 		=> __( 'Primary Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'condition' 	=> [
							'litho_enable_custom_image' => '',
							'litho_search_form_style' => [ 'popup' ], //IN
						],
						'selectors' 	=> [
							'{{WRAPPER}} .search-form-box .search-button, {{WRAPPER}} .search-form-box .search-button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
							'{{WRAPPER}} .search-form-box .search-button, {{WRAPPER}} .search-form-box .search-button svg' => 'fill: {{VALUE}};',
						],
					]
				);

				$this->add_responsive_control(
					'litho_search_form_button_icon_secondary_color',
					[
						'label' 		=> __( 'Secondary Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'condition' 	=> [
							'litho_search_form_button_icon_view!' 	=> 'default',
							'litho_enable_custom_image' 			=> '',
						],
						'selectors' 	=> [
							'{{WRAPPER}} .search-form-box .search-button' 		=> 'color: {{VALUE}};',
							'{{WRAPPER}} .search-form-box .search-button svg' 	=> 'fill: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_search_form_button_icon_hover_tab',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_enable_custom_image' => '',
							'litho_search_form_style' => [ 'popup' ], // IN
						],
					]
				);

				$this->add_responsive_control(
					'litho_search_form_button_icon_hover_primary_color',
					[
						'label' 		=> __( 'Primary Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'condition' 	=> [
							'litho_enable_custom_image' => '',
						],
						'selectors' 	=> [
							'{{WRAPPER}} .search-form-box .search-button:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
							'{{WRAPPER}} .search-form-box .search-button:hover, {{WRAPPER}} .search-form-box .search-button:hover svg' => 'fill: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'litho_search_form_button_icon_hover_secondary_color',
					[
						'label' 		=> __( 'Secondary Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'condition' 	=> [
							'litho_search_form_button_icon_view!' => 'default',
							'litho_enable_custom_image' => '',
						],
						'selectors' 	=> [
							'{{WRAPPER}} .search-form-box .search-button:hover' 		=> 'color: {{VALUE}};',
							'{{WRAPPER}} .search-form-box .search-button:hover svg' 	=> 'fill: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_search_form_label_style',
				[
					'label'         => __( 'Label', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_search_form_input_align',
				[
					'label' 		=> __( 'Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default'	 	=> 'left',
					'options' 		=> [
						'left' 		=> [
							'title' => __( 'Left', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' 	=> [
							'title' => __( 'Center', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' 	=> [
							'title' => __( 'Right', 'litho-addons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'prefix_class' 	=> 'elementor%s-align-',
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_search_form_label_typography',
					'global'		=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .search-form-box .search-label',
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_search_form_label_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .search-form-box .search-label' => 'color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_search_form_input_style',
				[
					'label'         => __( 'Input', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_responsive_control(
				'litho_search_form_input_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px', 'custom' ],
					'default' 		=> [
						'unit' 		=> '%',
					],
					'range' 		=> [
						'%' 		=> [
							'min' 	=> 5,
							'max' 	=> 100,
						],
						'px' 		=> [
							'min' 	=> 0,
							'max' 	=> 1000,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input'	=> 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_search_form_input_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input',
				]
			);
			$this->add_control(
				'litho_search_form_input_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_search_form_input_placeholder_color',
				[
					'label'     => __( 'Placeholder Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .search-form-box .search-input::-webkit-input-placeholder, {{WRAPPER}} .search-form-simple-box .search-input::-webkit-input-placeholder' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_search_form_input_background_color',
				[
					'label' 		=> __( 'Background Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_search_form_input_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_search_form_input_border_heading',
				[
					'label' 		=> __( 'Border', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_search_form_input_border',
					'selector'      => '{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input',
				]
			);
			$this->add_responsive_control(
				'litho_search_form_input_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_search_form_input_box_shadow',
					'selector'      => '{{WRAPPER}} .search-form-box .search-input, {{WRAPPER}} .search-form-simple-box .search-input',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_search_form_close_btn_style',
				[
					'label'         => __( 'Close button', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'litho_search_form_close_btn_typography',
					'global'		=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'      => '{{WRAPPER}} .search-form-wrapper .search-close',
				]
			);
			$this->start_controls_tabs( 'litho_search_form_close_btn_tabs' );
				$this->start_controls_tab( 'litho_search_form_close_btn_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_search_form_close_btn_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .search-form-wrapper .search-close' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						 Group_Control_Background::get_type(),
						[
							'name' 			=> 'litho_search_form_close_btn_bg_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector' 		=> '{{WRAPPER}} .search-form-wrapper .search-close',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_search_form_close_btn_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_search_form_close_btn_hvr_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .search-form-wrapper .search-close:hover' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						 Group_Control_Background::get_type(),
						[
							'name' 			=> 'litho_search_form_close_btn_hvr_bg_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector' 		=> '{{WRAPPER}} .search-form-wrapper .search-close:hover',
						]
					);
					$this->add_control(
						'litho_search_form_close_btn_hover_transition',
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
								'{{WRAPPER}} .search-form-wrapper .search-close' => 'transition-duration: {{SIZE}}s',
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_search_form_overlay_section',
				[
					'label' 		=> __( 'Overlay', 'litho-addons' ),
					'tab'          	=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->add_group_control(
				 Group_Control_Background::get_type(),
				[
					'name' 			=> 'litho_overlay_background',
					'selector' 		=> '{{WRAPPER}} .search-form',
					'condition' 	=> [
						'litho_search_form_style' => [ 'popup' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_search_form_button_section_style',
				[
					'label' 		=> __( 'Button', 'litho-addons' ),
					'tab'          	=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_search_form_style' => [ 'simple' ],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'			=> 'litho_search_form_button_title_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'		=> '{{WRAPPER}} .search-button .search-label',
				]
			);
			$this->start_controls_tabs( 'litho_search_form_button_tabs' );
				$this->start_controls_tab( 'litho_search_form_button_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_search_form_button_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .search-button',
						]
					);
					$this->add_control(
						'litho_search_form_title_color',
						[
							'label'     => __( 'Text Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .search-button .search-label' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_control(
						'litho_search_form_button_icon_color',
						[
							'label'         => __( 'Icon Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .search-button > i' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_search_form_button_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_search_form_button_hover_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .search-button:hover',
						]
					);
					$this->add_control(
						'litho_search_form_button_title_hover_color',
						[
							'label'         => __( 'Text Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .search-button:hover .search-label' => 'color: {{VALUE}};',
							] 
						]
					);
					$this->add_control(
						'litho_search_form_button_icon_hover_color',
						[
							'label'         => __( 'Icon Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .search-button:hover > i' => 'color: {{VALUE}};',
							] ,
						]
					);
				$this->end_controls_tab();
				$this->end_controls_tabs();

				$this->add_control(
					'litho_search_form-button_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .search-button' => 'border-color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' 				=> 'litho_search_form_button_border',
						'placeholder' 		=> '1px',
						'exclude' 			=> [ 'color' ],
						'fields_options' 	=> [
							'width' => [
								'label' => __( 'Border Width', 'litho-addons' ),
							],
						],
						'selector' 			=> '{{WRAPPER}} .search-button',
					]
				);

				$this->add_control(
					'litho_search_form_border_button_radius',
					[
						'label' 		=> __( 'Border Radius', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'custom' ],
						'default' 		=> [
									'unit'	=> 'px',
						],
						'selectors' 	=> [
							'{{WRAPPER}} .search-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'litho_search_form_button_padding',
					[
						'label' 		=> __( 'Padding', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors' 	=> [
							'{{WRAPPER}} .search-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'litho_search_form_button_margin',
					[
						'label' 		=> __( 'Margin', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors' 	=> [
							'{{WRAPPER}} .search-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();
		}

		/**
		 * Render search form widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$litho_search_form_button_image = '';
			$settings                       = $this->get_settings_for_display();
			$input_unique_id                = wp_unique_id( 'search-form-input' );
			$form_unique_id                 = wp_unique_id( 'search-form-' );
			$litho_search_form_style        = ( isset( $settings['litho_search_form_style'] ) && $settings['litho_search_form_style'] ) ? $settings['litho_search_form_style'] : '';
			$search_form_placeholder        = ( isset( $settings['litho_search_form_placeholder'] ) && $settings['litho_search_form_placeholder'] ) ? $settings['litho_search_form_placeholder'] : '';
			$litho_search_form_label        = ( isset( $settings['litho_search_form_label'] ) && $settings['litho_search_form_label'] ) ? $settings['litho_search_form_label'] : '';
			$litho_search_form_buton_text   = ( isset( $settings['litho_search_form_buton_text'] ) && $settings['litho_search_form_buton_text'] ) ? $settings['litho_search_form_buton_text'] : '';
			$icon_is_new                    = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$icon_migrated                  = isset( $settings['__fa4_migrated']['litho_search_form_button_icon'] );

			$this->add_render_attribute( 'search_form_button_icon_wrapper', 'class', 'elementor-icon' );

			if ( ! empty( $settings['litho_search_form_button_image']['id'] ) ) {

				$srcset_data                        = litho_get_image_srcset_sizes( $settings['litho_search_form_button_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_search_form_button_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_search_form_button_image']['id'], 'litho_thumbnail', $settings );
				$litho_search_form_button_image_alt = Control_Media::get_image_alt( $settings['litho_search_form_button_image'] );
				$litho_search_form_button_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_search_form_button_image_url ), esc_attr( $litho_search_form_button_image_alt ), $srcset_data );

			} elseif ( ! empty( $settings['litho_search_form_button_image']['url'] ) ) {
				$litho_search_form_button_image_url = $settings['litho_search_form_button_image']['url'];
				$litho_search_form_button_image_alt = '';
				$litho_search_form_button_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_search_form_button_image_url ), esc_attr( $litho_search_form_button_image_alt ) );
			}

			$this->add_render_attribute( 'wrapper', [
				'class' => [ 'simple-search-form' ]
			] );
			
			switch ( $litho_search_form_style ) {
				case 'popup':
				default:
					?>
					<div class="search-form-wrapper">
						<a href="javascript:void(0);" class="search-form-icon">
							<?php echo Icon_Group_Control::render_icon_content( $this, 'primary' ); ?>
						</a>
						<div class="form-wrapper">
							<button title="<?php echo esc_attr( 'Close', 'litho-addons' ); ?>" type="button" class="search-close alt-font"><?php echo esc_html__( '×', 'litho-addons' ); ?></button>
							<form id="<?php echo esc_attr( $form_unique_id ); ?>" role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<div class="search-form-box">
									<?php if ( ! empty( $litho_search_form_label ) ) { ?>
										<span class="search-label alt-font text-small"><?php echo esc_html( $litho_search_form_label ); ?></span>
									<?php } ?>
									<input class="search-input alt-font" id="<?php echo esc_attr( $input_unique_id ); ?>" placeholder="<?php echo esc_attr( $search_form_placeholder ); ?>" name="s" value="<?php echo get_search_query(); ?>" type="text" autocomplete="off">
									<button type="submit" class="search-button">
										<?php
										if ( '' === $settings['litho_enable_custom_image'] ) {
											if ( $icon_is_new || $icon_migrated ) {
												Icons_Manager::render_icon( $settings['litho_search_form_button_icon'], [ 'aria-hidden' => 'true' ] );
											} else {
											?>
												<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
											<?php
											}
										} elseif ( ! empty( $litho_search_form_button_image ) ) {
											echo sprintf( '%s', $litho_search_form_button_image ); // phpcs:ignore
										}
										?>
									</button>
								</div>
							</form>
						</div>
					</div>
					<?php
					break;
				case 'simple':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<form id="<?php echo esc_attr( $form_unique_id ); ?>" role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<div class="search-form-simple-box">
								<input class="search-input alt-font" id="<?php echo esc_attr( $input_unique_id ); ?>" placeholder="<?php echo esc_attr( $search_form_placeholder ); ?>" name="s" value="<?php echo get_search_query(); ?>" type="text" autocomplete="off">
								<button type="submit" class="search-button">
									<?php
									if ( '' === $settings['litho_enable_custom_image'] ) {
										if ( $icon_is_new || $icon_migrated ) {
											Icons_Manager::render_icon( $settings['litho_search_form_button_icon'], [ 'aria-hidden' => 'true' ] );
											if ( $litho_search_form_buton_text ) {
												?>
												<span class="search-label">
													<?php echo esc_html( $litho_search_form_buton_text ); ?>
												</span>
												<?php
											}
										} else {
											?>
											<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
											<?php
										}
									} elseif ( ! empty( $litho_search_form_button_image ) ) {
										echo sprintf( '%s', $litho_search_form_button_image ); // phpcs:ignore
									}
									?>
								</button>
							</div>
						</form>
					</div>
					<?php
					break;
			}
		}
	}
}
