<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for popup.
 *
 * @package Litho
 */

// If class `Popup` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Popup' ) ) {

	class Popup extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve popup widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-popup';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve popup widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Popup', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve popup widget icon.
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
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return [ 'litho' ];
		}

		/**
		 * Get button sizes.
		 *
		 * Retrieve an array of button sizes for the button widget.
		 *
		 * @access public
		 * @static
		 *
		 * @return array An array containing button sizes.
		 */
		public static function get_button_sizes() {
			return [
				'xs' => __( 'Extra Small', 'litho-addons' ),
				'sm' => __( 'Small', 'litho-addons' ),
				'md' => __( 'Medium', 'litho-addons' ),
				'lg' => __( 'Large', 'litho-addons' ),
				'xl' => __( 'Extra Large', 'litho-addons' ),
			];
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
			return [ 'lightbox', 'magnific' ];
		}

		/**
		 * Register popup widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_popup_section',
				[
					'label' 		=> __( 'Popup', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_popup_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'simple-model-popup',
					'options'     	=> [
						'simple-model-popup'	=> __( 'Simple model', 'litho-addons' ),
						'subscribe-form-popup'	=> __( 'Subscribe form', 'litho-addons' ),
						'contact-form-popup'	=> __( 'Contact form', 'litho-addons' ),
						'youtube-video-popup'	=> __( 'Youtube video', 'litho-addons' ),
						'vimeo-video-popup'		=> __( 'Vimeo video', 'litho-addons' ),
						'google-map-popup'		=> __( 'Google map', 'litho-addons' ),
					],
					'label_block' 	=> true,
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_popup_content_section',
				[
					'label' => __( 'Content', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_popup_image',
				[
					'label'         => __( 'Image', 'litho-addons' ),
					'type'          => Controls_Manager::MEDIA,
					'dynamic'		=> [
						'active' => true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'condition'     => [
						'litho_popup_style' => 'subscribe-form-popup', // IN
					],
				]
			);
			$this->add_control(
				'litho_popup_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'Write title here', 'litho-addons' ),
					'label_block'	=> true,
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'contact-form-popup', 'subscribe-form-popup' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_popup_content',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'type'          => Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
					    'active' => true
					],
					'default'       => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'subscribe-form-popup' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_popup_dismiss_text',
				[
					'label' 		=> __( 'Dismiss Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'Dismiss', 'litho-addons' ),
					'condition'     => [
						'litho_popup_style' => 'simple-model-popup', // IN
					],
				]
			);
			$this->add_control(
				'litho_contact_form_id',
				[
					'label'         => __( 'Select Form', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'label_block'   => true,
					'options'       => $this->get_contact_form_list(),
					'default'       => '0',
					'condition'     => [
						'litho_popup_style' => 'contact-form-popup', // IN
					],
				]
			);
			$this->add_control(
				'litho_video_link',
				[
					'label'         => __( 'Video URL/Map URL', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'   => true,
					'condition'     => [
						'litho_popup_style' => [ 'youtube-video-popup', 'vimeo-video-popup', 'google-map-popup' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_newsletter_prevent_checkbox_section',
				[
					'label'         => __( 'Prevent Text', 'litho-addons' ),
					'condition'     => [
						'litho_popup_style' => 'subscribe-form-popup' // IN
					],
				]
			);
			$this->add_control(
				'litho_newsletter_auto_enable',
				[
					'label' 		=> __( 'Enable Auto Loading', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'Yes', 'litho-addons' ),
					'label_off'		=> __( 'No', 'litho-addons' ),
					'default'		=> '',
				]
			);
			$this->add_control(
				'litho_prevent_label',
				[
					'label' 		=> __( 'Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'Prevent This Pop-up', 'litho-addons' ),
					'placeholder' 	=> __( 'Prevent This Pop-up', 'litho-addons' ),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_popup_button_section',
				[
					'label' => __( 'Button', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_button_text',
				[
					'label' 		=> __( 'Button Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'Click Here', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_size',
				[
					'label' 			=> __( 'Size', 'litho-addons' ),
					'type' 				=> Controls_Manager::SELECT,
					'default' 			=> 'xs',
					'options' 			=> self::get_button_sizes(),
					'style_transfer' 	=> true,
				]
			);
			$this->add_control(
				'litho_selected_icon',
				[
					'label' 			=> __( 'Icon', 'litho-addons' ),
					'type' 				=> Controls_Manager::ICONS,
					'label_block' 		=> true,
					'fa4compatibility' 	=> 'icon',
				]
			);
			$this->add_control(
				'litho_icon_align',
				[
					'label' 		=> __( 'Icon Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'left',
					'options' 		=> [
						'left' 		=> __( 'Before', 'litho-addons' ),
						'right' 	=> __( 'After', 'litho-addons' ),
					],

				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_popup_title_section_style',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'contact-form-popup', 'subscribe-form-popup' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_popup_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '#elementor-lightbox-{{ID}} .popup-title',					
				]
			);
			$this->add_control(
				'litho_popup_title_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .popup-title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_popup_title_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 200 ] ],
					'selectors' 	=> [
						'#elementor-lightbox-{{ID}} .popup-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_popup_content_section_style',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'subscribe-form-popup' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_popup_content_typography',
					'selector'  => '#elementor-lightbox-{{ID}} .popup-content',
				]
			);
			$this->add_control(
				'litho_popup_content_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .popup-content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_popup_content_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 200 ] ],
					'selectors' 	=> [
						'#elementor-lightbox-{{ID}} .popup-content' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_popup_dismiss_text_section_style',
				[
					'label' 		=> __( 'Dismiss Button', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => 'simple-model-popup', // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_popup_dismiss_text_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '#elementor-lightbox-{{ID}} .popup-modal-dismiss',
				]
			);
			$this->start_controls_tabs( 'litho_popup_dismiss_tabs' );
				$this->start_controls_tab(
					'litho_popup_dismiss_tab_normal',
					[
						'label' => __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_popup_dismiss_text_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'default'       => '',
						'selectors'     => [
							'#elementor-lightbox-{{ID}} .popup-modal-dismiss' => 'color: {{VALUE}};',
						]
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_popup_dismiss_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '#elementor-lightbox-{{ID}} .popup-modal-dismiss',
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'litho_popup_dismiss_tab_hover',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_popup_dismiss_text_hover_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'default'       => '',
						'selectors'     => [
							'#elementor-lightbox-{{ID}} .popup-modal-dismiss:hover' => 'color: {{VALUE}};',
						]
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_popup_dismiss_hover_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '#elementor-lightbox-{{ID}} .popup-modal-dismiss:hover',
					]
				);
				$this->add_control(
					'litho_popup_dismiss_hover_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'condition' 	=> [
							'litho_popup_dismiss_border_border!' => '',
						],
						'selectors' 	=> [
							'#elementor-lightbox-{{ID}} .popup-modal-dismiss:hover, #elementor-lightbox-{{ID}} .popup-modal-dismiss:focus' => 'border-color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_popup_dismiss_border',
					'selector' 		=> '#elementor-lightbox-{{ID}} .popup-modal-dismiss',
					'fields_options'=> [
						'border' => [ 'separator' => 'before' ]
					],
				]
			);
			$this->add_control(
				'litho_popup_dismiss_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'#elementor-lightbox-{{ID}} .popup-modal-dismiss' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_popup_dismiss_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .popup-modal-dismiss' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_popup_dismiss_box_shadow',
					'selector' 		=> '#elementor-lightbox-{{ID}} .popup-modal-dismiss',
				]
			);
			$this->end_controls_section();


			$this->start_controls_section(
				'litho_popup_button_section_style',
				[
					'label' 		=> __( 'Button', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_popup_button_text_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .elementor-button',
				]
			);
			$this->start_controls_tabs( 'litho_popup_button_tabs' );
				$this->start_controls_tab(
					'litho_popup_button_tab_normal',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_popup_button_text_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'default'       => '',
						'selectors'     => [
							'{{WRAPPER}} .elementor-button' => 'color: {{VALUE}}; fill: {{VALUE}};',
						]
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_popup_button_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .elementor-button',
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'litho_popup_button_tab_hover',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_popup_button_text_hover_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'default'       => '',
						'selectors'     => [
							'{{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
						]
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_popup_button_hover_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .elementor-button:hover',
					]
				);
				$this->add_control(
					'litho_popup_button_hover_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=>  Controls_Manager::COLOR,
						'condition' 	=> [
							'litho_popup_button_border_border!' => '',
						],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_popup_button_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
					'fields_options'=> [
						'border' => [ 'separator' => 'before' ]
					],
				]
			);
			$this->add_control(
				'litho_popup_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_popup_button_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before',
				]
			);
			$this->add_responsive_control(
				'litho_popup_button_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_popup_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_popup_lightbox_section_style',
				[
					'label' 		=> __( 'Lightbox', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_popup_lightbox_align',
				[
					'label' 		=> __( 'Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left'    	=> [
							'title' 	=> __( 'Left', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-left',
						],
						'center' 	=> [
							'title' 	=> __( 'Center', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-center',
						],
						'right' 	=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon' 		=> 'eicon-text-align-right',
						],
					],
					'default' 		=> '',
					'selectors' 	=> [
						'#elementor-lightbox-{{ID}} .modal-wrap' 	=> 'text-align: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .contact-form-wrap-main' 	=> 'text-align: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .contact-form-wrap-main .newsletter-popup' 	=> 'text-align: {{VALUE}};',
					],
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'subscribe-form-popup', 'contact-form-popup' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_popup_lightbox_width',
				[
					'label' => __( 'Width', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
							'min' => 400,
							'max' => 3000,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'#elementor-lightbox-{{ID}}.modal-main-wrap'         => 'max-width: {{SIZE}}{{UNIT}};',
						'.litho-video-popup .mfp-iframe-holder .mfp-content' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'lightbox_ui_color',
				[
					'label' => __( 'Close Button Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'.mfp-wrap button.mfp-close' => 'color: {{VALUE}} !important',
					],
				]
			);

			$this->add_control(
				'lightbox_ui_color_hover',
				[
					'label' => __( 'Close Button Hover Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'.mfp-wrap button.mfp-close:hover' => 'color: {{VALUE}} !important',
					],
					'separator' => 'after',
				]
			);

			$this->add_control(
				'lightbox_box_color',
				[
					'label' => __( 'Background Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .modal-wrap' 	                           => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .contact-form-wrap-main .newsletter-popup' => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .modal-popup-wrap' 	                       => 'background-color: {{VALUE}};',

					],
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'subscribe-form-popup', 'contact-form-popup' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_lightbox_box_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .modal-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .contact-form-wrap-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .modal-popup-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'subscribe-form-popup', 'contact-form-popup' ], // IN
					],
				]
			);

			$this->add_responsive_control(
				'litho_lightbox_ui_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .modal-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .contact-form-wrap-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .modal-popup-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_popup_style' => [ 'simple-model-popup', 'subscribe-form-popup', 'contact-form-popup' ], // IN
					],
				]
			);

			$this->add_control(
				'lightbox_content_animation',
				[
					'label'		=> __( 'Animation', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> '',
					'options'	=> [
						''	 					=> __( 'None', 'litho-addons' ),
						'zoom-in'				=> __( 'Zoom In', 'litho-addons' ),
						'zoom-in-slide-bottom'	=> __( 'Zoom In with Slide Bottom', 'litho-addons' )
					],
					'condition'     => [
						'litho_popup_style' => 'simple-model-popup', // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_lightbox_newsletter_style',
				[
					'label'         => __( 'Form', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => 'subscribe-form-popup', // IN
					],
				]
			);

			/* For subscribe form */
			$this->add_control(
				'litho_lightbox_newsletter_form_fields',
				[
					'label'     => __( 'Fields', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
				]
			);
			$this->add_responsive_control(
				'litho_lightbox_newsletter_form_field_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 200 ] ],
					'selectors' 	=> [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_lightbox_newsletter_input_box_typography',
					'selector'  => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input',
				]
			);
			$this->add_control(
				'litho_lightbox_newsletter_input_box_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_lightbox_newsletter_input_box_placeholder_color',
				[
					'label'     => __( 'Placeholder Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input::-webkit-input-placeholder' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_lightbox_newsletter_input_background_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_lightbox_newsletter_input_border',
					'selector'      => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input',
				]
			);
			$this->add_responsive_control(
				'litho_lightbox_newsletter_input_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_lightbox_newsletter_input_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_lightbox_newsletter_input_shadow',
					'selector'      => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input',
					'separator'     => 'before',
				]
			);
			$this->add_control(
				'litho_lightbox_newsletter_form_submit',
				[
					'label'     => __( 'Submit Button', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_submit_button_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'      => 'litho_submit_button_text_shadow',
					'selector'  => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button',
				]
			);
			$this->start_controls_tabs( 'litho_newsletter_submit_button_tabs' );
				$this->start_controls_tab(
					'litho_submit_button_normal_tab',
					[
						'label'     => __( 'Normal', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_submit_button_text_color',
						[
							'label'     => __( 'Text Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button'  => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name'           => 'litho_submit_button_icon_color',
							'fields_options' => [
								'background' => [
									'label' => __( 'Icon Color', 'litho-addons' ),
								]
							],
							'selector'       => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"] > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"] > svg, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button > svg',
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'litho_submit_button_background_color',
							'types'     => [ 'classic', 'gradient' ],
							'exclude'	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'  => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' 		=> 'litho_submit_submit_border',
							'selector'  => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_submit_button_hover_tab',
					[
						'label'     => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_submit_button_hover_text_color',
						[
							'label'         => __( 'Text Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:hover'  => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name'           => 'litho_submit_button_hover_icon_color',
							'fields_options' => [
								'background' => [
									'label' => __( 'Icon Color', 'litho-addons' ),
								]
							],
							'selector'       => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:hover > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover > svg, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:hover > svg',
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'litho_submit_button_hover_background_color',
							'types'     => [ 'classic', 'gradient' ],
							'exclude'	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'  => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' 		   => 'litho_submit_button_hover_border',
							'selector'     => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:hover, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:hover',
						]
					);
					$this->add_control(
						'litho_submit_button_hover_transition',
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
								'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button' => 'transition-duration: {{SIZE}}s',
								'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"] > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button > i' => 'transition-duration: {{SIZE}}s',
								'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"] > svg, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button > svg' => 'transition-duration: {{SIZE}}s',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_submit_button_active_tab',
					[
						'label'     => __( 'Active', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_submit_button_active_text_color',
						[
							'label'         => __( 'Text Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:active, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:focus'  => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' => 'litho_submit_button_active_icon_color',
							'selector' => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:active > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:focus > i, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active > svg, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:active > svg, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus > svg, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:focus > svg',
							'fields_options'    => [ 'background' => [ 'label' => __( 'Icon Color', 'litho-addons' ) ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'litho_submit_button_active_background_color',
							'types'     => [ 'classic', 'gradient' ],
							'exclude'	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'  => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:active, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:focus',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_submit_button_active_border',
							'selector'      => '#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:active, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:active, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"]:focus, #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button:focus',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_submit_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					],
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_submit_button_icon_spacing',
				[
					'label'			=> __( 'Icon Spacing', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', 'custom' ],
					'range'			=> [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
					'selectors'		=> [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button > i'   => 'margin-right: {{SIZE}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button > svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_submit_button_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_submit_button_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form input[type*="submit"], #elementor-lightbox-{{ID}} .newsletter-form-wrapper .mc4wp-form button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_contact_form_field_style',
				[
					'label'     => __( 'Fields', 'litho-addons' ),
					'tab' 	    => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => 'contact-form-popup',// IN
					],
				]
			);
			$this->add_control(
				'litho_heading_style_label',
				[
					'label'     => __( 'Label', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,			
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_contact_form_label_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '#elementor-lightbox-{{ID}} .wpcf7-form label',
				]
			);
			$this->add_control(
				'litho_contact_form_label_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .wpcf7-form label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_heading_style_input_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
				]
			);
			$this->add_control(
				'litho_contact_heading_style_input',
				[
					'label'     => __( 'Input', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_contact_form_input_box_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"],
						#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"],
						#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], 
						#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], 
						#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], 
						#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"],
						#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea,
						#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',  

				]
			);
			$this->add_control(
				'litho_contact_form_input_box_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea'				 => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_form_input_box_placeholder_color',
				[
					'label'     => __( 'Placeholder Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-webkit-input-placeholder'  	=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:-ms-input-placeholder' 		=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-webkit-input-placeholder' 	=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-moz-placeholder'  		=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:-ms-input-placeholder'  	=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-webkit-input-placeholder'  	=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-webkit-input-placeholder'  	=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea::-webkit-input-placeholder'  			=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea::-moz-placeholder' 	 					=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea:-ms-input-placeholder'  					=> 'color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'      								=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_heading_style_textarea_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
				]
			);
			$this->add_control(
				'litho_contact_heading_style_textarea',
				[
					'label'     => __( 'Textarea', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
				]
			);
			$this->add_control(
				'litho_contact_form_textarea_box_height',
				[
					'label'         => __( 'Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
							'min' => 100,
							'max' => 500,
						],
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default'       => [ 'unit' => '%', 'size' => 100 ],
					'selectors'     => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_form_textarea_resize',
				[
					'label'     => __( 'Resize', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'vertical',
					'options'   => [
						'none'         => __( 'None', 'litho-addons' ),
						'horizontal'   => __( 'Horizontal', 'litho-addons' ),
						'vertical'     => __( 'Vertical', 'litho-addons' ),
					],
					'selectors' => [                   
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea'  => 'resize: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_text_style_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
				]
			);
			$this->add_control(
				'litho_contact_text_style_label',
				[
					'label'     => __( 'Info Text', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,           
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_contact_form_text_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '#elementor-lightbox-{{ID}} .wpcf7-form .contact-form-text',
				]
			);
			$this->add_control(
				'litho_contact_form_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .contact-form-text' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_form_input_box_background',
				[
					'label'     => __( 'Background Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'background-color: {{VALUE}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea'         	 => 'background-color: {{VALUE}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'litho_contact_form_input_box_border',
					'separator' => 'before', 
					'selector' 	=> '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select, #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea',
				]
			);
			$this->add_control(
				'litho_contact_form_input_box_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::DIMENSIONS,                 
					'selectors' => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' 	=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' 	=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]'=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' 	=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'  => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' 		=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea'				=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					],
				]
			);
			$this->add_responsive_control(
				'litho_contact_form_input_box_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'separator' 	=> 'before',
					'selectors' 	=> [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' 		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' 		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'  		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' 		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' 			=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea' 				=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_contact_form_input_box_margin',
				[
					'label' 	 	=> __( 'Margin', 'litho-addons' ),
					'type' 		 	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
					'separator' 	=> 'before',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' 		 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-form-control-wrap textarea' 			 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_contact_form_button_style',
				[
					'label'         => __( 'Submit Button', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => 'contact-form-popup',// IN
					],
				]
			);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'litho_contact_submit_button_typography',
						'global' => [
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
						],
						'selector'  => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit',
					]
				);
				$this->add_group_control(
					Group_Control_Text_Shadow::get_type(),
					[
						'name'      => 'litho_contact_submit_button_text_shadow',
						'selector'  => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit',
					]
				);
				$this->start_controls_tabs( 'litho_contact_form_submit_button_tabs' );
					$this->start_controls_tab(
						'litho_contact_submit_button_normal_tab',
						[
							'label'     => __( 'Normal', 'litho-addons' ),
						]
					);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'              => 'litho_contact_submit_button_background_color',
								'types'             => [ 'classic', 'gradient' ],
								'exclude'           => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit',
							]
						);
						$this->add_control(
							'litho_contact_submit_button_text_color',
							[
								'label'     => __( 'Text Color', 'litho-addons' ),
								'type'      => Controls_Manager::COLOR,
								'selectors' => [
									'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit'  => 'color: {{VALUE}};',
								],
							]
						);

						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name' 		=> 'litho_contact_submit_submit_border',
								'selector'  => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit',
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_contact_submit_button_hover_tab',
						[
							'label'     => __( 'Hover', 'litho-addons' ),
						]
					);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'              => 'litho_contact_submit_button_hover_background_color',
								'types'             => [ 'classic', 'gradient' ],
								'exclude'           => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:hover',
							]
						);
						$this->add_control(
							'litho_contact_submit_button_hover_text_color',
							[
								'label'         => __( 'Text Color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:hover'  => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name' 		   => 'litho_contact_submit_button_hover_border',
								'selector'     => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:hover',
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_contact_submit_button_active_tab',
						[
							'label'     => __( 'Active', 'litho-addons' ),
						]
					);
						$this->add_control(
							'litho_contact_submit_button_active_text_color',
							[
								'label'         => __( 'Text Color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:active, #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:focus'  => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_control(
							'litho_contact_submit_button_active_background_color',
							[
								'label'         => __( 'Background Color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:active, #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:focus'  => 'background-color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_contact_submit_button_active_border',
								'selector'      => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:active, #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit:focus',
							]
						);
					$this->end_controls_tab();
				$this->end_controls_tabs();
				$this->add_control(
					'litho_contact_submit_border_radius',
					[
						'label'         => __( 'Border Radius', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'selectors'     => [
							'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						],
						'separator'     => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'          => 'litho_contact_submit_button_box_shadow',
						'selector'      => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit',
						'separator'     => 'before',
					]
				);
				$this->add_responsive_control(
					'litho_contact_submit_padding',
					[
						'label'         => __( 'Padding', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator'     => 'before',
					]
				);
				$this->add_responsive_control(
					'litho_contact_submit_margin',
					[
						'label'         => __( 'Margin', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator'     => 'before',
					]
				);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_contact_form_messages_style',
				[
					'label'             => __( 'Messages', 'litho-addons' ),
					'tab' 	            => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => 'contact-form-popup',// IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'litho_contact_form_messages_typography',
					'selector'          => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-response-output',
				]
			);
			$this->add_control(
				'litho_contact_form_success_messages_color',
				[
					'label'             => __( 'Success Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-mail-sent-ok'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'              => 'litho_contact_form_success_messages_border',
					'selector'          => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-mail-sent-ok',
				]
			);
			$this->add_control(
				'litho_contact_form_error_messages_color',
				[
					'label'             => __( 'Error Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-validation-errors, #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-acceptance-missing'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'              => 'litho_contact_form_error_messages_border',
					'selector'          => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-validation-errors, #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-acceptance-missing',
				]
			);
			$this->add_control(
				'litho_contact_form_spam_messages_color',
				[
					'label'             => __( 'Spam/Blocked Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-spam-blocked'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		       => 'litho_contact_form_spam_messages_border',
					'selector' 	       => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-spam-blocked',
				]
			);
			$this->add_control(
				'litho_contact_form_aborted_messages_color',
				[
					'label'             => __( 'Aborted Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-aborted, #elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-mail-sent-ng'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		       => 'litho_contact_form_aborted_messages_border',
					'selector' 	       => '#elementor-lightbox-{{ID}} .wpcf7-form .wpcf7-aborted, {{WRAPPER}} .wpcf7-form .wpcf7-mail-sent-ng',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_newsletter_prevent_checkbox_style',
				[
					'label'         => __( 'Prevent Text', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_popup_style' => 'subscribe-form-popup' // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_newsletter_prevent_text_typography',
					'selector'  => '{{WRAPPER}} .popup-prevent-text',
				]
			);
			$this->add_control(
				'litho_newsletter_prevent_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .popup-prevent-text' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render popup widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings                 = $this->get_settings_for_display();
			$litho_popup_style        = $this->get_settings( 'litho_popup_style' );
			$litho_popup_image        = $this->get_settings( 'litho_popup_image' );
			$litho_popup_title        = $this->get_settings( 'litho_popup_title' );
			$litho_popup_content      = $this->get_settings( 'litho_popup_content' );
			$litho_popup_dismiss_text = $this->get_settings( 'litho_popup_dismiss_text' );
			$litho_video_link         = $this->get_settings( 'litho_video_link' );

			if ( empty( $this->get_settings( 'litho_button_text') ) ) {
				return;
			}
			$this->add_render_attribute( 'shortcode', 'id', $settings[ 'litho_contact_form_id' ] );

			$this->add_render_attribute( 'wrapper', 'class', [ 'elementor-wrapper', $litho_popup_style ] );
			$this->add_render_attribute( 'wrapper', 'class', [ 'elementor-wrapper', $litho_popup_style ] );

			$this->add_render_attribute( [
				'modal_main' => [
					'id'    => 'elementor-lightbox-'.$this->get_id(),
					'class' => [ 'modal-main-wrap', 'mfp-hide' ],
				]
			] );
			
			$output = '';
			switch ( $litho_popup_style ) {
				case 'simple-model-popup':
					ob_start();
					if ( ! empty( $this->get_settings( 'lightbox_content_animation') ) ) {
						$this->add_render_attribute( [
							'modal_main' => [
								'class' => [ 'zoom-anim-dialog' ],
							]
						] );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'modal_main' ); ?>>
						<div class="modal-wrap">
							<?php if ( ! empty( $litho_popup_title ) ) { ?>
								<span class="popup-title"><?php echo esc_html( $litho_popup_title ); ?></span>
							<?php } ?>
							<?php if ( ! empty( $litho_popup_content ) ) { ?>
								<div class="popup-content"><?php echo sprintf( '%s', wp_kses_post( $litho_popup_content ) ); ?></div>
							<?php } ?>
							<?php if ( ! empty( $litho_popup_dismiss_text ) ) { ?>
								<button class="btn popup-modal-dismiss"><?php echo esc_html( $litho_popup_dismiss_text ); ?></button>
							<?php } ?>
						</div>
					</div>
					<?php
					$output .= ob_get_contents();
					ob_end_clean();
					printf( '%s', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;
				case 'contact-form-popup':
					$shortcode = sprintf( '[contact-form-7 %s]', $this->get_render_attribute_string( 'shortcode' ) );
					ob_start();
					?>
					<div <?php $this->print_render_attribute_string( 'modal_main' ); ?>>
						<div class="modal-wrap contact-form-wrap">
							<?php if ( ! empty( $litho_popup_title ) ) { ?>
								<h6 class="popup-title"><?php echo esc_html( $litho_popup_title ); ?></h6>
							<?php } ?>
							<?php if ( ! empty( $settings[ 'litho_contact_form_id' ] ) ) {
								echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							} else { ?>
								<div class="form-not-available"><?php echo esc_html( 'Please Select contact form.', 'litho-addons' ); ?></div>
							<?php } ?>
						</div>
					</div>
					<?php
					$output .= ob_get_contents();
					ob_end_clean();
					printf( '%s', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;
				case 'subscribe-form-popup':
					$mailchimp_id = get_option( 'mc4wp_default_form_id' );

					$litho_prevent_label          = ( isset( $settings['litho_prevent_label'] ) && ! empty( $settings['litho_prevent_label'] ) ) ? $settings['litho_prevent_label'] : esc_html__( 'Prevent This Pop-up', 'litho-addons' );
					$litho_newsletter_auto_enable = ( isset( $settings['litho_newsletter_auto_enable'] ) && ! empty( $settings['litho_newsletter_auto_enable'] ) ) ? $settings['litho_newsletter_auto_enable'] : '';

					if ( 'yes' == $litho_newsletter_auto_enable ) {
						$this->add_render_attribute( [
							'wrapper' => [
								'class' => [ 'subscribe-pop-auto' ],
							]
						] );
					}
					ob_start();
						?>	
						<div <?php $this->print_render_attribute_string( 'modal_main' ); ?>>
							<div class="contact-form-wrap-main">
								<div class="contact-form-wrap popup-lightbox-container newsletter-popup">
									<?php if ( ! empty( $litho_popup_title ) ) { ?>
										<span class="popup-title"><?php echo esc_html( $litho_popup_title ); ?></span>
									<?php } ?>
									<?php if ( ! empty( $litho_popup_content ) ) { ?>
										<div class="popup-content"><?php echo sprintf( '%s', wp_kses_post( $litho_popup_content ) ); ?></div>
									<?php } ?>
									<?php if ( $mailchimp_id && defined( 'MC4WP_PLUGIN_FILE' ) ) { ?>
										<div class="newsletter-form-wrapper newsletter-style-1">
											<?php
												$shortcode  = sprintf( '[mc4wp_form id="%s"]', $mailchimp_id );
												echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											?>
										</div>
										<?php if ( 'yes' == $litho_newsletter_auto_enable && ! empty( $litho_prevent_label ) ) { ?>
											<label class="litho-show-popup popup-prevent-text subscribe-popup-prevent-text"><input type="checkbox" class="litho-promo-show-popup" id="litho-promo-show-popup"><?php echo esc_html( $litho_prevent_label ); ?></label>
										<?php } ?>
									<?php
									} else { ?>
											<div class="form-not-available"><?php echo esc_html( 'No form exists.', 'litho-addons' ); ?></div>
										<?php
									}
									?>
								</div>
								<?php 
									if ( ! empty( $settings['litho_popup_image']['id'] ) ) {
										$litho_popup_image_url = wp_get_attachment_url( $settings['litho_popup_image']['id'], 'full' );
										echo '<div class="newsletter-popup-img" style="background-image:url(' . esc_url( $litho_popup_image_url ) . ');"></div>';
									} elseif ( ! empty( $settings['litho_popup_image']['url'] ) ) {
										$litho_popup_image_url = $settings['litho_popup_image']['url'];
										echo '<div class="newsletter-popup-img" style="background-image:url(' . esc_url( $litho_popup_image_url ) . ');"></div>';
									}
								?>
							</div>
						</div>
					<?php
					$output .= ob_get_contents();
					ob_end_clean();
					printf( '%s', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;
			}

			$this->add_render_attribute( 'inner-wrapper', [
				'class' => 'litho-popup-wrapper',
			]);
			?>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<div <?php $this->print_render_attribute_string( 'inner-wrapper' ); ?>>
					<?php $this->get_open_popup_button(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
			<?php
		}

		/**
		 * Retrieve the open popup button.
		 *
		 * @access public
		 *
		 * @return string popup button.
		 */

		public function get_open_popup_button() {

			$class             = '';
			$settings          = $this->get_settings_for_display();
			$litho_popup_style = $this->get_settings( 'litho_popup_style' );
			$litho_video_link  = $this->get_settings( 'litho_video_link' );
			$migrated          = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
			$is_new            = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			
			// start button
			$this->add_render_attribute( [
				'button' => [
					'class' => [ 'elementor-button-wrapper', 'litho-button-wrapper' ],
				]
			] );

			switch ( $litho_popup_style ) {
				case 'simple-model-popup':
					$litho_content_animation_class = '';
					if ( 'zoom-in' === $this->get_settings( 'lightbox_content_animation') ) {

						$litho_content_animation_class = 'popup-with-zoom-anim';

					} elseif ( 'zoom-in-slide-bottom' === $this->get_settings( 'lightbox_content_animation') ) {

						$litho_content_animation_class = 'popup-with-move-anim';

					} else {
						$litho_content_animation_class = 'modal-popup';
					}
					$this->add_render_attribute( [
						'button' => [
							'href'  => '#elementor-lightbox-' . $this->get_id(),
							'class' =>	$litho_content_animation_class,
						]
					] );
					break;
				case 'subscribe-form-popup':
					$this->add_render_attribute( [
						'button' => [
							'href'  => '#elementor-lightbox-' . $this->get_id(),
							'class' => 'modal-popup'
						]
					] );
					break;
				case 'contact-form-popup':
					$this->add_render_attribute( [
						'button' => [
							'href'  => '#elementor-lightbox-' . $this->get_id(),
							'class' => 'popup-with-form'
						]
					] );
					break;
			}

			if ( 'youtube-video-popup' == $litho_popup_style ) {
				$class = 'popup-youtube';
			} elseif ( 'vimeo-video-popup' == $litho_popup_style ) {
				$class = 'popup-vimeo';
			} elseif ( 'google-map-popup' == $litho_popup_style ) {
				$class = 'popup-googlemap';
			}

			switch ( $litho_popup_style ) {
				case 'youtube-video-popup':
				case 'vimeo-video-popup':
				case 'google-map-popup':
					if ( ! empty( $litho_video_link ) ) {
						$this->add_render_attribute( [
							'button' => [
								'href'  => $litho_video_link,
								'class' => $class
							]
						] );
					}
					break;
			}

			$this->add_render_attribute( 'link', 'class', 'elementor-button' );

			if ( ! empty( $settings['litho_size'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'elementor-size-' . $settings['litho_size'] );
			}

			$this->add_render_attribute( [
				'btn-content-wrapper' => [
					'class' => 'elementor-button-content-wrapper',
				],
				'icon-align' => [
					'class' => [
						'elementor-button-icon',
						'elementor-align-icon-' . $settings['litho_icon_align'],
					],
				],
				'litho_text' => [
					'class' => 'elementor-button-text',
				],
			] );
			// end button
			?>
			<a <?php $this->print_render_attribute_string( 'button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<div <?php $this->print_render_attribute_string( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<span <?php $this->print_render_attribute_string( 'btn-content-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
							<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
								<?php if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
								} else { ?>
									<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
								<?php } ?>
							</span>
						<?php endif; ?>
						<?php if ( $this->get_settings( 'litho_button_text') ) { ?>
							<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $this->get_settings( 'litho_button_text') ); ?></span>
						<?php } ?>
					</span>
				</div>
			</a>
			<?php
		}

		/**
		 * Retrieve the contact form 7 form list.
		 *
		 * @access public
		 *
		 * @return string Form list.
		 */

		public function get_contact_form_list() {
			
			$contact_form_list  = array();
			$contact_forms_args = array(
				'posts_per_page' => -1,
				'post_type'      => 'wpcf7_contact_form'
			);
			$contact_forms      = get_posts( $contact_forms_args );

			if ( $contact_forms ) {
				foreach ( $contact_forms as $form ) {
					$contact_form_list[ $form->ID ] = $form->post_title;
				}
			} else {
				$contact_form_list['0'] = __( 'Form not found', 'litho-addons' );
			}
			return $contact_form_list;
		}
	}
}
