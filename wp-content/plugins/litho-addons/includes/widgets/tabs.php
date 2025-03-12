<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Classes\Elementor_Templates;
use LithoAddons\Controls\Icon_Hover_Animation;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for tabs.
 *
 * @package Litho
 */

// If class `Tabs` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Tabs' ) ) {
	class Tabs extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve tabs widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-tabs';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve tabs widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Tabs', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve tabs widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-tabs';
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
			return [ 'tabs', 'accordion', 'toggle' ];
		}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the tabs widget belongs to.
		 *
		 * Used to determine where to display the widget in the editor.
		 *
		 * @access public
		 *
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return [ 'litho' ];
		}

		/**
		 * Register tabs widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_tabs',
				[
					'label' => __( 'Tabs', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_tab_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'tab-style-1',
					'options'     	=> [
						'tab-style-1' 		=> __( 'Style 1', 'litho-addons' ),
						'tab-style-2'   	=> __( 'Style 2', 'litho-addons' ),
					]
				]
			);
			$repeater = new Repeater();
			$repeater->start_controls_tabs( 'litho_tabs_content_tabs' );
				$repeater->start_controls_tab( 'litho_icon_tab', [ 'label' => __( 'Icon', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_item_use_image',
						[
							'label'			=> __( 'Use Image?', 'litho-addons' ),
							'type'			=> Controls_Manager::SWITCHER,
							'label_on'		=> __( 'Yes', 'litho-addons' ),
							'label_off'		=> __( 'No', 'litho-addons' ),
							'return_value'	=> 'yes',
							'default'		=> '',
						]
					);
					$repeater->add_control(
						'litho_item_icon',
						[
							'label'       		=> __( 'Icon', 'litho-addons' ),
							'type'        		=> Controls_Manager::ICONS,
							'fa4compatibility' 	=> 'icon',
							'label_block' 		=> true,
							'condition'   	    => [
								'litho_item_use_image' => '',
							]
						]
					);
					$repeater->add_control(
						'litho_item_image',
						[
							'label'   		=> __( 'Image', 'litho-addons' ),
							'type'    		=> Controls_Manager::MEDIA,
							'dynamic'		=> [
								'active' => true,
							],
							'condition'   	=> [
								'litho_item_use_image' => 'yes',
							]
						]
					);
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_content_tab', [ 'label' => __( 'Content', 'litho-addons' ) ] );
					$repeater->add_control(
						'litho_tab_title',
						[
							'label' 		=> __( 'Title', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'default' 		=> __( 'Tab Title', 'litho-addons' ),
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_tab_subtitle',
						[
							'label' 		=> __( 'Subtitle', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' 		=> [
								'active' 	=> true,
							],
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_item_content_type',
						[
							'label'       	=> __( 'Content Type', 'litho-addons' ),
							'type'        	=> Controls_Manager::SELECT,
							'default'     	=> 'template',
							'options'     	=> [
								'template' 		=> __( 'Template', 'litho-addons' ),
								'editor'   		=> __( 'Editor', 'litho-addons' ),
							],
							'label_block' 	=> true,
						]
					);
					$repeater->add_control(
						'litho_item_template_id',
						[
							'label'       	=> __( 'Choose Template', 'litho-addons' ),
							'label_block' 	=> true,
							'type'        	=> Controls_Manager::SELECT2,
							'default'     	=> '0',
							'options'     	=> Elementor_Templates::get_elementor_templates_options(),
							'condition'   	=> [ 'litho_item_content_type' => 'template' ],
						]
					);
					$repeater->add_control(
						'litho_item_content',
						[
							'label' 		=> __( 'Content', 'litho-addons' ),
							'type' 			=> Controls_Manager::WYSIWYG,
							'dynamic' 		=> [
							    'active' => true
							],
							'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
							'condition'   	=> [ 'litho_item_content_type' => 'editor' ],
						]
					);
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_current_item_styles_tab', [ 'label' => __( 'Styles', 'litho-addons' ) ] );
				$repeater->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     		=> 'litho_tabs_control_current_item_background',
						'types'			=> [ 'classic', 'gradient' ],
						'exclude'		=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs {{CURRENT_ITEM}}.nav-item a.nav-link',
					]
				);
				$repeater->add_control(
					'litho_tabs_control_current_item_border_style_heading',
					[
						'label'     	=> __( 'Please make sure border will use only in style 2.', 'litho-addons' ),
						'type'      	=> Controls_Manager::HEADING,
						'separator'		=> 'before',
					]
				);
				$repeater->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'        	=> 'litho_tabs_control_current_item_border',
						'selector'  	=> '{{WRAPPER}} .litho-tabs:not(.tab-style-1) .nav-tabs {{CURRENT_ITEM}}.nav-item a.nav-link',
					]
				);
				$repeater->end_controls_tab();
			$repeater->end_controls_tabs();
			$this->add_control(
				'litho_tabs',
				[
					'label' 		=> __( 'Tabs Items', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[ 'litho_tab_title' 	=> __( 'Tab #1', 'litho-addons' ) ],
						[ 'litho_tab_title' 	=> __( 'Tab #2', 'litho-addons' ) ],
					],
					'title_field' 	=> '{{{ litho_tab_title }}}',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_settings_data',
				[
					'label' => __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_icon_thumbnail',
					'default' 		=> 'thumbnail',
					'exclude'		=> [ 'custom' ],
					'separator'		=> 'none',
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_general_style',
				[
					'label'      	=> __( 'General', 'litho-addons' ),
					'tab'        	=> Controls_Manager::TAB_STYLE,
					'show_label' 	=> false,
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_tabs_container_background',
					'selector' 		=> '{{WRAPPER}} .litho-tabs',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_tabs_container_border',
					'selector'    	=> '{{WRAPPER}} .litho-tabs',
				]
			);
			$this->add_responsive_control(
				'litho_tabs_container_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_container_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_container_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_tabs_container_box_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-tabs',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_tabs_control_style',
				[
					'label'      	=> __( 'Tabs Control', 'litho-addons' ),
					'tab'        	=> Controls_Manager::TAB_STYLE,
					'show_label' 	=> false,
				]
			);
			$this->add_responsive_control(
				'litho_tabs_controls_aligment',
				[
					'label'   		=> __( 'Tabs Alignment', 'litho-addons' ),
					'type'    		=> Controls_Manager::CHOOSE,
					'default' 		=> 'flex-start',
					'options' 		=> [
						'flex-start'    => [
							'title' 		=> __( 'Left', 'litho-addons' ),
							'icon'  		=> 'eicon-text-align-left',
						],
						'center' 		=> [
							'title' 		=> __( 'Center', 'litho-addons' ),
							'icon'  		=> 'eicon-text-align-center',
						],
						'flex-end' 		=> [
							'title' 		=> __( 'Right', 'litho-addons' ),
							'icon'  		=> 'eicon-text-align-right',
						],
					],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_tabs_content_wrapper_background',
					'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs',
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_wrapper_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range'      	=> [ 'px'	=> [ 'min' 	=> 1, 'max'	=> 500 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_tabs_control_wrapper_border',
					'selector'    	=> '{{WRAPPER}} .litho-tabs .nav-tabs',
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_wrapper_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_wrapper_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_wrapper_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_tabs_control_wrapper_box_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_tabs_control_item_style',
				[
					'label'      	=> __( 'Tabs Control Item', 'litho-addons' ),
					'tab'        	=> Controls_Manager::TAB_STYLE,
					'show_label' 	=> false,
				]
			);
			$this->add_responsive_control(
				'litho_tabs_controls_text_aligment',
				[
					'label'   		=> __( 'Text Alignment', 'litho-addons' ),
					'type'    		=> Controls_Manager::CHOOSE,
					'default' 		=> 'left',
					'options' 		=> [
						'left'    			=> [
							'title' 		=> __( 'Left', 'litho-addons' ),
							'icon'  		=> 'eicon-text-align-left',
						],
						'center' 			=> [
							'title' 		=> __( 'Center', 'litho-addons' ),
							'icon'  		=> 'eicon-text-align-center',
						],
						'right' 			=> [
							'title' 		=> __( 'Right', 'litho-addons' ),
							'icon'  		=> 'eicon-text-align-right',
						],
					],
					'selectors'  	=> [
						'{{WRAPPER}} .nav-tabs > li.nav-item > a.nav-link' => 'text-align: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'litho_tabs_control_icon_style_heading',
				[
					'label'     	=> __( 'Icon Styles', 'litho-addons' ),
					'type'      	=> Controls_Manager::HEADING,
				]
			);
			$this->add_control(
				'litho_tabs_control_icon_position',
				[
					'label'       	=> __( 'Icon Position', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'nav-icon-top',
					'options' 		=> [
						'nav-icon-top'	=> __( 'Top', 'litho-addons' ),
						'nav-icon-left'	=> __( 'Left', 'litho-addons' ),
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_icon_right_spacing',
				[
					'label'      	=> __( 'Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'custom' ],
					'range'      	=> [ 'px'	=> [ 'min' 	=> 0, 'max'	=> 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .nav-tabs > li.nav-item.nav-icon-left > a.nav-link > i'   => 'margin-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .nav-tabs > li.nav-item.nav-icon-left > a.nav-link > svg' => 'margin-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .nav-item a.nav-link .tab-title-image'                    => 'margin-right: {{SIZE}}{{UNIT}}',
					],
					'condition'   	=> [
						'litho_tabs_control_icon_position' => 'nav-icon-left',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_icon_bottom_spacing',
				[
					'label'      	=> __( 'Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'custom' ],
					'range'      	=> [ 'px'	=> [ 'min' 	=> 0, 'max'	=> 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .nav-tabs > li.nav-item.nav-icon-top > a.nav-link > i'   => 'margin-bottom: {{SIZE}}{{UNIT}}',						
						'{{WRAPPER}} .nav-tabs > li.nav-item.nav-icon-top > a.nav-link > svg' => 'margin-bottom: {{SIZE}}{{UNIT}}',						
						'{{WRAPPER}} .nav-item a.nav-link .elementor-tabs-label-image'        => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'   	=> [
						'litho_tabs_control_icon_position' => 'nav-icon-top',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_image_width',
				[
					'label'      	=> __( 'Image Icon Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'default' 		=> [ 'size'	=> 28, 'unit'	=> 'px' ],
					'size_units' 	=> [ 'px', 'custom' ],
					'range'      	=> [ 'px'	=> [ 'min' 	=> 20, 'max'	=> 200 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .nav-item a.nav-link .elementor-tabs-label-image' => 'width: {{SIZE}}{{UNIT}}',
					]
				]
			);
			$this->add_control(
				'litho_tabs_control_state_style_heading',
				[
					'label'     	=> __( 'State Styles', 'litho-addons' ),
					'type'      	=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
				]
			);
			$this->start_controls_tabs( 'tabs_control_styles' );
			$this->start_controls_tab(
				'litho_tabs_control_normal',
				[
					'label' => __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_tabs_control_label_color',
				[
					'label'  		=> __( 'Text Color', 'litho-addons' ),
					'type'   		=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link'  => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     	=> 'litho_tabs_control_label_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link',
				]
			);
			$this->add_control(
				'litho_tabs_control_icon_color',
				[
					'label'     	=> __( 'Icon Color', 'litho-addons' ),
					'type'      	=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link > i'   => 'color: {{VALUE}};',
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link > svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_icon_size',
				[
					'label'      	=> __( 'Icon Size', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range'      	=> [ 'px'	=> [ 'min' 	=> 18, 'max'	=> 200 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link > i'   => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_tabs_control_background',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_tabs_control_border',
					'placeholder' 	=> '1px',
					'default'     	=> '1px',
					'selector'  	=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link',
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tabs_control_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_tabs_control_label_color_hover',
				[
					'label'  		=> __( 'Text Color', 'litho-addons' ),
					'type'   		=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     	=> 'litho_tabs_control_label_typography_hover',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover',
				]
			);
			$this->add_control(
				'litho_tabs_control_icon_color_hover',
				[
					'label'     	=> __( 'Icon Color', 'litho-addons' ),
					'type'      	=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover > i'   => 'color: {{VALUE}}',
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover > svg' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_icon_size_hover',
				[
					'label'      	=> __( 'Icon Size', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range'      	=> [ 'px' => [ 'min' => 18, 'max' => 200 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover > i'   => 'font-size: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_tabs_control_background_hover',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_tabs_control_border_hover',
					'placeholder' 	=> '1px',
					'default'     	=> '1px',
					'selector'  	=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link:hover',
				]
			);
			$this->add_control(
				'litho_tabs_control_label_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type' 			=> 'icon-hover-animation',
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tabs_control_active',
				[
					'label' 		=> __( 'Active', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_tabs_control_label_color_active',
				[
					'label'  		=> __( 'Text Color', 'litho-addons' ),
					'type'   		=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     	=> 'litho_tabs_control_label_typography_active',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active',
				]
			);
			$this->add_control(
				'litho_tabs_control_icon_color_active',
				[
					'label'     	=> __( 'Icon Color', 'litho-addons' ),
					'type'      	=> Controls_Manager::COLOR,
					'selectors'	 	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > i, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > svg, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > svg' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_icon_size_active',
				[
					'label'     	=> __( 'Icon Size', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range'      	=> [ 'px'	=> [ 'min' 	=> 18, 'max'	=> 200 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > i, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > i' => 'font-size: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > svg, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_tabs_control_background_active',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_tabs_control_border_active',
					'placeholder' 	=> '1px',
					'default'     	=> '1px',
					'selector'  	=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active, {{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link.active',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_tabs_content_box_shadow_active',
					'selector'  	=> '{{WRAPPER}} .litho-tabs:not(.tab-style-1) .nav-tabs .nav-item a.nav-link.active, {{WRAPPER}} .litho-tabs:not(.tab-style-1) .nav-tabs .nav-item a.nav-link.active',
					'condition'		=> [
						'litho_tab_style' => 'tab-style-2', // IN
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_tabs_control_border_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'			=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item .tab-border',
					'fields_options'	=> [ 'background' => [ 'label' => __( 'Bottom Border Color', 'litho-addons' ) ] ],
					'condition'			=> [
						'litho_tab_style' => 'tab-style-1' // IN
					],
					'separator'			=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_border_height',
				[
					'label' 	=> __( 'Bottom Border Thickness', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size' => 2,
					],
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 20,
						],
					],
					'condition'		=> [
						'litho_tab_style' => 'tab-style-1' // IN
					],
					'selectors' => [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item .tab-border' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_border_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_tabs_control_margin',
				[
					'label'      	=> __( 'Margin', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_tabs_control_box_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a.nav-link',
				]
			);

			$this->add_control(
				'litho_tabs_control_subtitle_heading',
				[
					'label'			=> __( 'Subtitle', 'litho-addons' ),
					'type'			=> Controls_Manager::HEADING,
					'separator'		=> 'before',
				]
			);
			$this->add_control(
				'litho_tabs_control_subtitle_color',
				[
					'label'  		=> __( 'Color', 'litho-addons' ),
					'type'   		=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a span' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     		=> 'litho_tabs_control_subtitle_typography',
					'global' 		=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 		=> '{{WRAPPER}} .litho-tabs .nav-tabs .nav-item a span',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_tabs_content_style',
				[
					'label'      	=> __( 'Tabs Content', 'litho-addons' ),
					'tab'        	=> Controls_Manager::TAB_STYLE,
					'show_label' 	=> false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     		=> 'litho_tabs_content_typography',
					'selector' 		=> '{{WRAPPER}} .litho-tabs .tab-content, {{WRAPPER}} .litho-tabs .tab-content .elementor-widget-wrap > .elementor-element',
				]
			);
			$this->add_control(
				'litho_tabs_content_text_color',
				[
					'label' 		=> __( 'Text color', 'litho-addons' ),
					'type'  		=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-tabs .tab-content, {{WRAPPER}} .litho-tabs .tab-content .elementor-widget-wrap > .elementor-element' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     		=> 'litho_tabs_content_background',
					'selector' 		=> '{{WRAPPER}} .litho-tabs .tab-content',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_tabs_content_border',
					'placeholder' 	=> '1px',
					'default'    	=> '1px',
					'selector'  	=> '{{WRAPPER}} .litho-tabs .tab-content',
				]
			);
			$this->add_responsive_control(
				'litho_tabs_content_radius',
				[
					'label'      	=> __( 'Border Radius', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tabs_content_padding',
				[
					'label'      	=> __( 'Padding', 'litho-addons' ),
					'type'       	=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  	=> [
						'{{WRAPPER}} .litho-tabs .tab-content, {{WRAPPER}} .litho-tabs .tab-content .elementor-widget-wrap > .elementor-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     		=> 'litho_tabs_content_box_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-tabs .tab-content',
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render tabs widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();
			$tabs     = $this->get_settings_for_display( 'litho_tabs' );

			if ( ! $tabs || empty( $tabs ) ) {
				return false;
			}

			$id_int                     = $this->get_id_int();
			$litho_icon_hover_animation = ( isset( $settings['litho_tabs_control_label_hover_animation'] ) && $settings['litho_tabs_control_label_hover_animation'] ) ? 'hvr-' . $settings['litho_tabs_control_label_hover_animation'] : '';
			$migrated                   = isset( $settings['__fa4_migrated']['litho_item_icon'] );
			$is_new                     = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			$this->add_render_attribute(
				'tabs_wrapper',
				[
					'class' => [
						'litho-tabs',
						$settings[ 'litho_tab_style' ],
					],
				]
			);
			?>
			<div <?php $this->print_render_attribute_string( 'tabs_wrapper' ); ?>>
				<ul class="nav nav-tabs alt-font">
					<?php
					$active_title_index = 1;
					foreach ( $tabs as $index => $item ) {
						$title_icon             = '';
						$title_image            = '';
						$litho_icon_hover       = '';
						$tab_count              = $index + 1;
						$tab_title_setting_key  = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
						$tab_anchor_setting_key = $this->get_repeater_setting_key( 'tab_title_anchor', 'tabs', $index );
						$active_class           = ( $active_title_index == 1 ) ? 'active' : '';

						$this->add_render_attribute( $tab_title_setting_key, [
							'class' => [ 'elementor-repeater-item-' . $item['_id'], 'nav-item', $settings['litho_tabs_control_icon_position' ] ],
						] );
						
						$this->add_render_attribute( $tab_anchor_setting_key, [
							'class' 			=> [ 'nav-link', $active_class ],
							'data-bs-toggle' 	=> 'tab',
							'href'				=> '#tab-' . $id_int . $tab_count,
						] );

						if ( ! empty( $litho_icon_hover_animation ) ) {
							$this->add_render_attribute( $tab_anchor_setting_key, 'class', $litho_icon_hover_animation );
							$litho_icon_hover = 'hvr-icon';
						}

						if ( $is_new || $migrated ) {
							ob_start();
								Icons_Manager::render_icon( $item['litho_item_icon'], [ 'class' => $litho_icon_hover, 'aria-hidden' => 'true' ] );
							$title_icon .= ob_get_clean();
						} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
							$title_icon .= '<i class="' . esc_attr( $item['litho_item_icon']['value'] ) . esc_attr( $litho_icon_hover ) . '" aria-hidden="true"></i>';
						}

						if ( ! empty( $item['litho_item_image']['id'] ) ) {
							$srcset_data    = litho_get_image_srcset_sizes( $item['litho_item_image']['id'], $settings['litho_icon_thumbnail_size'] );
							$icon_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_item_image']['id'], 'litho_icon_thumbnail', $settings );
							$icon_image_alt = Control_Media::get_image_alt( $item['litho_item_image'] );
							$title_image    = sprintf( '<span class="tab-title-image"><img src="%1$s" alt="%2$s" %3$s class="elementor-tabs-label-image" /></span>', esc_url( $icon_image_url ), esc_attr( $icon_image_alt ), $srcset_data );
						} elseif ( ! empty( $item['litho_item_image']['url'] ) ) {
							$icon_image_url = $item['litho_item_image']['url'];
							$icon_image_alt = '';
							$title_image    = sprintf( '<span class="tab-title-image"><img src="%1$s" alt="%2$s" class="elementor-tabs-label-image" /></span>', esc_url( $icon_image_url ), esc_attr( $icon_image_alt ) );
						}

						switch ( $settings[ 'litho_tab_style' ] ) {
							case 'tab-style-1':
							default:
								?><li <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>>
									<a <?php $this->print_render_attribute_string( $tab_anchor_setting_key ); ?>><?php
										echo filter_var( $item['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $title_image : $title_icon; // phpcs:ignore
										if ( $item['litho_tab_subtitle'] ) {
											?><span><?php
												echo esc_html( $item['litho_tab_subtitle'] );
											?></span><?php
										}
										echo esc_html( $item['litho_tab_title'] );
									?></a>
									<span class="tab-border"></span>
								</li><?php
								break;
							case 'tab-style-2':
								?><li <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>>
									<a <?php $this->print_render_attribute_string( $tab_anchor_setting_key ); ?>><?php
										echo filter_var( $item['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $title_image : $title_icon;// phpcs:ignore
										if ( $item['litho_tab_subtitle'] ) {
											?><span><?php
												echo esc_html( $item['litho_tab_subtitle'] );
											?></span><?php
										}
										echo esc_html( $item['litho_tab_title'] );
									?></a>
								</li><?php
								break;
						}
						$active_title_index++;
					}
				?></ul>
				<div class="tab-content"><?php
					$active_content_index = 1;
					foreach ( $tabs as $index => $item ) {
						$tab_count               = $index + 1;
						$tab_content_setting_key = $this->get_repeater_setting_key( 'item_content', 'tabs', $index );
						$tab_anchor_setting_key  = $this->get_repeater_setting_key( 'tab_title_anchor', 'tabs', $index );
						$active_class            = ( $active_content_index == 1 ) ? 'in active show' : '';

						$this->add_render_attribute( $tab_content_setting_key, [
							'id'    => 'tab-' . $id_int . $tab_count,
							'class' => [ 'tab-pane', 'fade', $active_class ],
						] );
						?><div <?php $this->print_render_attribute_string( $tab_content_setting_key ); ?>><?php
							if ( 'template' === $item[ 'litho_item_content_type' ] ) {
								if ( '0' !== $item['litho_item_template_id'] ) {
									$template_content = litho_get_builder_content_for_display( $item['litho_item_template_id'] );
									if ( ! empty( $template_content ) ) {
										if ( Plugin::$instance->editor->is_edit_mode() ) {
											$edit_url = add_query_arg(
												array(
													'elementor' => '',
												),
												get_permalink( $item['litho_item_template_id'] )
											);
											echo sprintf( '<div class="edit-template-with-light-box elementor-template-edit-cover" data-template-edit-link="%s"><i aria-hidden="true" class="eicon-edit"></i></i><span>%s</span></div>', esc_url( $edit_url ), esc_html__( 'Edit Template', 'litho-addons' ) );
										}
										echo sprintf( '%s', $template_content ); // phpcs:ignore
									} else {
										echo sprintf( '%s', $this->no_template_content_message() ); // phpcs:ignore
									}
								} else {
									echo sprintf( '%s', $this->no_template_content_message() ); // phpcs:ignore
								}
							} else {
								echo sprintf( '%s', $this->parse_text_editor( $item['litho_item_content'] ) ); // phpcs:ignore
							}
						?></div><?php
						$active_content_index++;
					}
				?></div>
			</div><?php
		}

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
				'<div class="elementor-no-template-message alert alert-warning"><div class="message">%1$s%2$s</div></div>',
				$message,
				( Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode() ) ? $new_link : ''
			);
		}
	}
}
