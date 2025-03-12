<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for contact form 7.
 *
 * @package Litho
 */

// If class `Contact_form` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Contact_form' ) ) {

	class Contact_form extends Widget_Base {

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
			return 'litho-contact-form';
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
			return __( 'Litho Contact Form 7', 'litho-addons' );
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
			return 'eicon-mail';
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
		 * Retrieve the contact form 7 form list.
		 *
		 *
		 *
		 * @access public
		 *
		 * @return string Form list.
		 */

		public function get_contact_form_list() {
			
			$contact_form_list  = array();
			$contact_forms_args = array( 'posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form' );
			$contact_forms      = get_posts( $contact_forms_args );       

			if ( $contact_forms ) {
				foreach ( $contact_forms as $form ) {
					$contact_form_list[ $form->ID ] = $form->post_title;
				}
			} else {
				$contact_form_list['0'] = esc_html__( 'Form not found', 'litho-addons' );
			}
			return $contact_form_list;
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
				'litho_section_content',
				[
					'label'     => __( 'Contact Form', 'litho-addons' ),
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
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_contact_form_style',
				[
					'label' => __( 'Form', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'      => 'litho_contact_form_section_background',
					'types'     => [ 'classic', 'gradient' ],
					'selector'  => '{{WRAPPER}} .contact-form-wrapper',
				]
			);
			$this->add_responsive_control(
				'litho_contact_form_section_align',
				[
					'label'     => __( 'Alignment', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'center',
					'options'   => [
						'left'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						],
						'justify'   => [
							'title'     => __( 'Justified', 'litho-addons' ),
							'icon'      => 'eicon-text-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper' => 'text-align: {{VALUE}};',
					],
					'separator' =>'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_contact_form_field_style',
				[
					'label'     => __( 'Fields', 'litho-addons' ),
					'tab' 	    => Controls_Manager::TAB_STYLE,
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
					'selector'  => '{{WRAPPER}} .wpcf7-form label',
				]
			);
			$this->add_control(
				'litho_contact_form_label_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpcf7-form label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_heading_style_input_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
				]
			);
			$this->add_control(
				'litho_heading_style_input',
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
					'selector'  => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"],
						{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"],
						{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], 
						{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], 
						{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], 
						{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"],
						{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea,
						{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',  

				]
			);
			$this->add_control(
				'litho_contact_form_input_box_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'				 => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_form_input_box_placeholder_color',
				[
					'label'     => __( 'Placeholder Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-webkit-input-placeholder'  	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:-ms-input-placeholder' 		=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-webkit-input-placeholder' 	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-moz-placeholder'  		=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:-ms-input-placeholder'  	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-webkit-input-placeholder'  	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-webkit-input-placeholder'  	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-moz-placeholder'  			=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:-ms-input-placeholder'  		=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-webkit-input-placeholder'  			=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-moz-placeholder' 	 					=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:-ms-input-placeholder'  					=> 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'      								=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_heading_style_textarea_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
				]
			);
			$this->add_control(
				'litho_heading_style_textarea',
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
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'height: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'  => 'resize: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_Text_style_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
				]
			);
			$this->add_control(
				'litho_Text_style_label',
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
					'selector'  => '{{WRAPPER}} .wpcf7-form .contact-form-text, {{WRAPPER}}.elementor-widget-litho-contact-form .wpcf7-form label .wpcf7-list-item-label',
				]
			);
			$this->add_control(
				'litho_contact_form_text_color',
				[
					'label'     => __( 'Text Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpcf7-form .contact-form-text, {{WRAPPER}}.elementor-widget-litho-contact-form .wpcf7-form label .wpcf7-list-item-label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_contact_form_input_box_background',
				[
					'label'     => __( 'Background Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'         	 => 'background-color: {{VALUE}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'litho_contact_form_input_box_border',
					'separator' => 'before', 
					'selector' 	=> '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
				]
			);
			$this->add_control(
				'litho_contact_form_input_box_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::DIMENSIONS,                 
					'selectors' => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' 	=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' 	=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]'=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' 	=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'  => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' 		=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'				=> 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' 		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' 		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'  		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' 		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' 			=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' 				=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' 		 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' 			 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_contact_form_button_style',
				[
					'label'         => __( 'Submit Button', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'litho_submit_button_typography',
						'global' => [
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
						],
						'selector'  => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
					]
				);
				$this->add_group_control(
					Group_Control_Text_Shadow::get_type(),
					[
						'name'      => 'litho_submit_button_text_shadow',
						'selector'  => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
					]
				);
				$this->start_controls_tabs( 'litho_contact_form_submit_button_tabs' );
					$this->start_controls_tab(
						'litho_submit_button_normal_tab',
						[
							'label'     => __( 'Normal', 'litho-addons' ),
						]
					);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'              => 'litho_submit_button_background_color',
								'types'             => [ 'classic', 'gradient' ],
								'exclude'           => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
							]
						);
						$this->add_control(
							'litho_submit_button_text_color',
							[
								'label'     => __( 'Text Color', 'litho-addons' ),
								'type'      => Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .wpcf7-form .wpcf7-submit'  => 'color: {{VALUE}};',
								],
							]
						);

						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name' 		=> 'litho_submit_submit_border',
								'selector'  => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
							]
						);
					$this->end_controls_tab();
					$this->start_controls_tab(
						'litho_submit_button_hover_tab',
						[
							'label'     => __( 'Hover', 'litho-addons' ),
						]
					);
						$this->add_group_control(
							Group_Control_Background::get_type(),
							[
								'name'              => 'litho_submit_button_hover_background_color',
								'types'             => [ 'classic', 'gradient' ],
								'exclude'           => [
									'image',
									'position',
									'attachment',
									'attachment_alert',
									'repeat',
									'size',
								],
								'selector'      => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover',
							]
						);
						$this->add_control(
							'litho_submit_button_hover_text_color',
							[
								'label'         => __( 'Text Color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover'  => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name' 		   => 'litho_submit_button_hover_border',
								'selector'     => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover',
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
									'{{WRAPPER}} .wpcf7-form .wpcf7-submit:active, {{WRAPPER}} .wpcf7-form .wpcf7-submit:focus'  => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_control(
							'litho_submit_button_active_background_color',
							[
								'label'         => __( 'Background Color', 'litho-addons' ),
								'type'          => Controls_Manager::COLOR,
								'selectors'     => [
									'{{WRAPPER}} .wpcf7-form .wpcf7-submit:active, {{WRAPPER}} .wpcf7-form .wpcf7-submit:focus'  => 'background-color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name'          => 'litho_submit_button_active_border',
								'selector'      => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:active, {{WRAPPER}} .wpcf7-form .wpcf7-submit:focus',
							]
						);
					$this->end_controls_tab();
				$this->end_controls_tabs();
				$this->add_control(
					'litho_submit_border_radius',
					[
						'label'         => __( 'Border Radius', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'selectors'     => [
							'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
						],
						'separator'     => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'          => 'litho_submit_button_box_shadow',
						'selector'      => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
						'separator'     => 'before',
					]
				);
				$this->add_responsive_control(
					'litho_submit_padding',
					[
						'label'         => __( 'Padding', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator'     => 'before',
					]
				);
				$this->add_responsive_control(
					'litho_submit_margin',
					[
						'label'         => __( 'Margin', 'litho-addons' ),
						'type'          => Controls_Manager::DIMENSIONS,
						'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'     => [
							'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator'     => 'before',
					]
				);
				$this->add_control(
					'litho_heading_style_spinner',
					[
						'label'     => __( 'Spinner', 'litho-addons' ),
						'type'      => Controls_Manager::HEADING,
						'separator'         => 'before',
					]
				);				
				$this->add_control(
					'litho_submit_button_spinner_color',
					[
						'label'             => __( 'Color', 'litho-addons' ),
						'type'              => Controls_Manager::COLOR,
						'selectors'         => [
							'{{WRAPPER}} .wpcf7-form .wpcf7-spinner::before' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_submit_button_spinner_bg_color',
					[
						'label'             => __( 'Background Color', 'litho-addons' ),
						'type'              => Controls_Manager::COLOR,
						'selectors'         => [
							'{{WRAPPER}} .wpcf7-form .wpcf7-spinner' => 'background-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_contact_form_messages_style',
				[
					'label'             => __( 'Messages', 'litho-addons' ),
					'tab' 	            => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'litho_contact_form_messages_typography',
					'selector'          => '{{WRAPPER}} .wpcf7-form .wpcf7-response-output',
				]
			);
			$this->add_control(
				'litho_contact_form_success_messages_color',
				[
					'label'             => __( 'Success Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-mail-sent-ok'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'              => 'litho_contact_form_success_messages_border',
					'selector'          => '{{WRAPPER}} .wpcf7-form .wpcf7-mail-sent-ok',
				]
			);
			$this->add_control(
				'litho_contact_form_error_messages_color',
				[
					'label'             => __( 'Error Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-validation-errors, {{WRAPPER}} .wpcf7-form .wpcf7-acceptance-missing'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'              => 'litho_contact_form_error_messages_border',
					'selector'          => '{{WRAPPER}} .wpcf7-form .wpcf7-validation-errors, {{WRAPPER}} .wpcf7-form .wpcf7-acceptance-missing',
				]
			);
			$this->add_control(
				'litho_contact_form_spam_messages_color',
				[
					'label'             => __( 'Spam/Blocked Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-spam-blocked'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		       => 'litho_contact_form_spam_messages_border',
					'selector' 	       => '{{WRAPPER}} .wpcf7-form .wpcf7-spam-blocked',
				]
			);
			$this->add_control(
				'litho_contact_form_aborted_messages_color',
				[
					'label'             => __( 'Aborted Message Border Color', 'litho-addons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'{{WRAPPER}} .wpcf7-form .wpcf7-aborted, {{WRAPPER}} .wpcf7-form .wpcf7-mail-sent-ng'  => 'color: {{VALUE}};',
					],
					'separator'         => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		       => 'litho_contact_form_aborted_messages_border',
					'selector' 	       => '{{WRAPPER}} .wpcf7-form .wpcf7-aborted, {{WRAPPER}} .wpcf7-form .wpcf7-mail-sent-ng',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render contact form 7 widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();
			$this->add_render_attribute( 'form_attr', 'class', 'contact-form-wrapper' );
			$this->add_render_attribute( 'shortcode', 'id', $settings['litho_contact_form_id'] );
			$shortcode = sprintf( '[contact-form-7 %s]', $this->get_render_attribute_string( 'shortcode' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
			<div <?php $this->print_render_attribute_string( 'form_attr' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php
				if ( ! empty( $settings['litho_contact_form_id'] ) ) {
					echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					?>
					<div class="form-not-available alert alert-warning"><?php echo esc_html__( 'Please Select contact form.', 'litho-addons' ); ?></div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}
