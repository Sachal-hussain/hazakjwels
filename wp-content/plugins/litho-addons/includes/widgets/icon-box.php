<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;
use LithoAddons\Controls\Groups\Button_Group_Control;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for icon box.
 *
 * @package Litho
 */

// If class `Icon_Box` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Icon_Box' ) ) {

	class Icon_Box extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve icon box widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-icon-box';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve icon box widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Icon Box', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve icon box widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-icon-box';
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
			return [ 'icon box', 'icon' ];
		}

		/**
		 * Register icon box widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_icon',
				[
					'label' => __( 'Icon Box', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_item_use_image',
				[
					'label'        	=> __( 'Use Image?', 'litho-addons' ),
					'type'         	=> Controls_Manager::SWITCHER,
					'label_on'     	=> __( 'Yes', 'litho-addons' ),
					'label_off'    	=> __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'default'      	=> '',
				]
			);
			$this->add_control(
				'litho_selected_icon',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-star',
						'library' 		=> 'fa-solid',
					],
					'condition' 	=> [
						'litho_item_use_image' => '',
					],
				]
			);
			$this->add_control(
				'litho_item_image',
				[
					'label'   		=> __( 'Image', 'litho-addons' ),
					'type'    		=> Controls_Manager::MEDIA,
					'dynamic'		=> [
						'active' => true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'			=> 'litho_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
					'default'		=> 'full',
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'default' 		=> __( 'Default', 'litho-addons' ),
						'stacked' 		=> __( 'Stacked', 'litho-addons' ),
						'framed' 		=> __( 'Framed', 'litho-addons' ),
						'custom' 		=> __( 'Custom', 'litho-addons' ),
					],
					'default' 		=> 'default',
					'prefix_class' 	=> 'elementor-view-',
				]
			);

			$this->add_control(
				'litho_shape',
				[
					'label' 		=> __( 'Shape', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
							'circle' 	=> __( 'Circle', 'litho-addons' ),
							'square' 	=> __( 'Square', 'litho-addons' ),
					],
					'default' 		=> 'circle',
					'condition' 	=> [
						'litho_view!' 	=> 'default',
						'litho_selected_icon[value]!' => '',
					],
					'prefix_class' => 'elementor-shape-',
				]
			);

			$this->add_control(
				'litho_title_text',
				[
					'label' 		=> __( 'Title & Description', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'This is the heading', 'litho-addons' ),
					'placeholder' 	=> __( 'Enter your title', 'litho-addons' ),
					'description'	=> __( 'Use || to break the word in new line.', 'litho-addons' ),
					'label_block' 	=> true,
				]
			);

			$this->add_control(
				'litho_description_text',
				[
					'label' 		=> __( 'Description', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'show_label' 	=> false,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'litho-addons' ),
					'placeholder' 	=> __( 'Enter your description', 'litho-addons' ),
					'rows' 			=> 10,
					'separator' 	=> 'none',
				]
			);
			$this->add_control(
				'litho_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'separator' 	=> 'before',
				]
			);

			$this->add_responsive_control(
				'litho_position',
				[
					'label' 		 => __( 'Icon Position', 'litho-addons' ),
					'type' 			 => Controls_Manager::CHOOSE,
					'default' 		 => 'top',
					'mobile_default' => 'top',
					'options' 		 => [
							'left' => [
								'title'	=> __( 'Left', 'litho-addons' ),
								'icon' 	=> 'eicon-h-align-left',
							],
							'top' => [
								'title'	=> __( 'Top', 'litho-addons' ),
								'icon' 	=> 'eicon-v-align-top',
							],
							'right' => [
								'title' => __( 'Right', 'litho-addons' ),
								'icon' 	=> 'eicon-h-align-right',
							],
					],
					'prefix_class'   => 'elementor%s-position-',
					'toggle'		 => true,
				]
			);

			$this->add_control(
				'litho_title_size',
				[
					'label' 	=> __( 'Title HTML Tag', 'litho-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'h1' 	=> 'H1',
						'h2' 	=> 'H2',
						'h3' 	=> 'H3',
						'h4' 	=> 'H4',
						'h5' 	=> 'H5',
						'h6' 	=> 'H6',
						'div' 	=> 'div',
						'span' 	=> 'span',
						'p' 	=> 'p',
					],
					'default' 	=> 'h3',
				]
			);

			$this->end_controls_section();
			Button_Group_Control::button_content_fields( $this, 'primary', __( 'Button', 'litho-addons' ) );

			$this->start_controls_section(
				'litho_section_style_general',
				[
					'label'		=> __( 'General', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_text_align',
				[
					'label' => __( 'Alignment', 'litho-addons' ),
					'type' => Controls_Manager::CHOOSE,
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
						'justify' => [
							'title' => __( 'Justified', 'litho-addons' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
					],
					'condition'   	=> [
						'litho_item_use_image' => ''
					],
				]
			);

			$this->add_control(
				'litho_content_vertical_alignment',
				[
					'label'			=> __( 'Vertical Alignment', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'options'		=> [
						'top'			=> __( 'Top', 'litho-addons' ),
						'middle'		=> __( 'Middle', 'litho-addons' ),
						'bottom'		=> __( 'Bottom', 'litho-addons' ),
					],
					'default'		=> 'top',
					'prefix_class'	=> 'elementor-vertical-align-',
					'condition'   	=> [
						'litho_item_use_image' => ''
					],
				]
			);
			$this->add_control(
				'litho_icon_box_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->add_control(
				'litho_icon_box_hover_transition',
				[
					'label'         => __( 'Transition Duration', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'size'          => 0.6,
					],
					'range'         => [
						'px'        => [
							'max'   => 3,
							'step'  => 0.1,
						],
					],
					'render_type'   => 'ui',
					'selectors'     => [
						'{{WRAPPER}} .icon-box-hover' => 'transition-duration: {{SIZE}}s',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_icon',
				[
					'label'		=> __( 'Icon', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE,
					'condition'	=> [ 'litho_item_use_image' => '' ],
				]
			);

			$this->start_controls_tabs( 'icon_colors' );

			$this->start_controls_tab(
				'litho_icon_colors_normal',
				[
					'label' => __( 'Normal', 'litho-addons' ),
				]
			);

			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 		=> 'litho_icon_color',
					'condition' => [
						'litho_view'	=> [ 'default', 'custom' ],
					],
					'selector' => '{{WRAPPER}}.elementor-view-default .elementor-icon i:before, {{WRAPPER}}.elementor-view-custom .elementor-icon i:before, {{WRAPPER}}.elementor-view-default .elementor-icon svg, {{WRAPPER}}.elementor-view-custom .elementor-icon svg, {{WRAPPER}}.elementor-view-default .elementor-icon svg path, {{WRAPPER}}.elementor-view-custom .elementor-icon svg path',
					'fields_options' => [
						'color' 	=> [
							'responsive' => true
						],
						'background'	=> [
							'label' => __( 'Icon Color', 'litho-addons' ),
						]
					]
				]
			);
			$this->add_responsive_control(
				'litho_primary_color',
				[
					'label' 		=> __( 'Primary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'global' 		=> [
						'default'	=> Global_Colors::COLOR_PRIMARY,
					],
					'condition' 	=> [
						'litho_view!'	=> [ 'default', 'custom' ],
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_secondary_color',
				[
					'label' 		=> __( 'Secondary Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' 	=> [
						'litho_view!'	=> [ 'default', 'custom' ],
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_icon_background_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}}.elementor-view-custom .elementor-icon',
					'condition' 	=> [
							'litho_view'	=> 'custom',
					],
					'fields_options' => [
						'color' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'litho_icon_colors_hover',
				[
					'label' 	=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 		=> 'litho_hover_icon_color',
					'condition' => [
						'litho_view' => [ 'default', 'custom' ],
					],
					'selector' 	=> '{{WRAPPER}}.elementor-view-default:hover .elementor-icon i:before, {{WRAPPER}}.elementor-view-custom:hover .elementor-icon i:before, {{WRAPPER}}.elementor-view-default:hover .elementor-icon svg, {{WRAPPER}}.elementor-view-custom:hover .elementor-icon svg, {{WRAPPER}}.elementor-view-default:hover .elementor-icon svg path, {{WRAPPER}}.elementor-view-custom:hover .elementor-icon svg path',
					'fields_options' => [
						'color' 	=> [
							'responsive' => true
						],
						'background'	=> [
							'label' => __( 'Icon Color', 'litho-addons' ),
						]
					]
				]
			);

			$this->add_responsive_control(
				'litho_hover_primary_color',
				[
					'label'		=> __( 'Primary Color', 'litho-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> '',
					'condition' => [
						'litho_view!' => [ 'default', 'custom' ],
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon, {{WRAPPER}}.elementor-view-default:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_hover_secondary_color',
				[
					'label' 	=> __( 'Secondary Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'condition' => [
							'litho_view!' => [ 'default', 'custom' ],
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon' 	=> 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_icon_hover_background_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}}.elementor-view-custom:hover .elementor-icon',
					'condition' 	=> [
							'litho_view'	=> 'custom',
					],
					'fields_options' => [
						'color' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 	=> __( 'Hover Animation', 'litho-addons' ),
					'type' 		=> Controls_Manager::HOVER_ANIMATION,
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_icon_space',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
							'size' => 15,
					],
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'(mobile){{WRAPPER}} .elementor-icon-box-icon'                  => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-right .litho-image-box-img'     => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-left .litho-image-box-img'      => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-top .litho-image-box-img'       => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'(mobile){{WRAPPER}} .litho-image-box-img'                      => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'	=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label' 	=> __( 'Size', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 6,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
					],
					'range' 		=> [
						'em' 		=> [
							'min' => 0,
							'max' => 5,
						],
					],
					'condition' 	=> [
						'litho_view!' => 'default',
					],
				]
			);
			$this->add_control(
				'litho_rotate',
				[
					'label' 	=> __( 'Rotate', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size' 	=> 0,
						'unit' 	=> 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_responsive_control(
				'litho_border_width',
				[
					'label' 		=> __( 'Border Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
							'litho_view'	=> 'framed',
					],
				]
			);
			$this->add_responsive_control(
				'litho_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
							'litho_view!'	=> 'default',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'litho_icon_box_shadow',
					'selector'  => '{{WRAPPER}} .elementor-icon',
					'fields_options' => [
						'box_shadow' 	=> [
							'responsive' => true
						]
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_image',
				[
					'label' 		=> __( 'Image', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);

			$this->add_responsive_control(
				'litho_image_space',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'default' 		=> [
								'size'	=> 15,
					],
					'range' 		=> [
						'px' 		=> [
								'min'	=> 0,
								'max'	=> 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-position-right .litho-image-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-left .litho-image-box-img' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-position-top .litho-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'(mobile){{WRAPPER}} .litho-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_image_size',
				[
					'label' 		=> __( 'Width', 'litho-addons' ) . ' (%)',
					'type' 			=> Controls_Manager::SLIDER,
					'default' 		=> [
								'size'	=> 30,
								'unit'	=> '%',
					],
					'tablet_default' => [
								'unit'	=> '%',
					],
					'mobile_default' => [
								'unit'	=> '%',
					],
					'size_units' 	=> [ '%' ],
					'range'			=> [
							'%' => [
								'min' => 5,
								'max' => 100,
							],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .litho-image-box-wrapper .litho-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_image_effects' );
			$this->start_controls_tab( 'litho_image_normal',
				[
					'label'		=> __( 'Normal', 'litho-addons' ),
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name'			=> 'litho_image_css_filters',
					'selector'		=> '{{WRAPPER}} .litho-image-box-img img',
				]
			);
			$this->add_control(
				'litho_image_opacity',
				[
					'label'		=> __( 'Opacity', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 1,
							'min' 	=> 0.10,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .litho-image-box-img img' => 'opacity: {{SIZE}};',
					],
				]
			);

			$this->add_control(
				'litho_image_background_hover_transition',
				[
					'label'		=> __( 'Transition Duration', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
							'size'	=> 0.3,
					],
					'range' 	=> [
							'px' => [
								'max' => 3,
								'step' => 0.1,
							],
					],
					'selectors'	=> [
						'{{WRAPPER}} .litho-image-box-img img' => 'transition-duration: {{SIZE}}s',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'litho_image_hover',
				[
					'label' 	=> __( 'Hover', 'litho-addons' ),
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' 		=> 'litho_image_css_filters_hover',
					'selector' 	=> '{{WRAPPER}}:hover .litho-image-box-img img',
				]
			);
			$this->add_control(
				'litho_image_opacity_hover',
				[
					'label' 	=> __( 'Opacity', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 1,
							'min' 	=> 0.10,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}}:hover .litho-image-box-img img' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_content',
				[
					'label' => __( 'Content', 'litho-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_heading_title',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'litho_title_typography',
					'selector' 		=> '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title, {{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title a',
					'global' 		=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
				]
			);
			$this->start_controls_tabs( 'litho_title_styles_tabs' );
			$this->start_controls_tab(
				'litho_title_color_tab',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_title_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
					],
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_title_hover_color_tab',
				[
					'label'			=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_title_hover_color',
				[
					'label' 		=> __( 'Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' 	=> [
						'{{WRAPPER}}:hover .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_title_bottom_space',
				[
					'label' => __( 'Spacing', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'	=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_title_display_settings' ,
				[
					'label'        	=> __( 'Display', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-title' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'litho_heading_description',
				[
					'label' => __( 'Description', 'litho-addons' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'litho_description_typography',
					'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
				]
			);
			$this->add_responsive_control(
				'litho_description_width',
				[
					'label' => __( 'Content Width', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_description_styles_tabs' );
			
			$this->start_controls_tab(
				'litho_description_color_tab',
				[
					'label' => __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_description_color',
				[
					'label' => __( 'Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_description_link_color',
				[
					'label' => __( 'Link Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a' => 'color: {{VALUE}};',
					]
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'litho_description_hover_color_tab',
				[
					'label' => __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_responsive_control(
				'litho_description_hover_color',
				[
					'label' => __( 'Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}:hover .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_description_link_hover_color',
				[
					'label' => __( 'Link Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a:hover' => 'color: {{VALUE}};',
					]
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_description_display_settings' ,
				[
					'label'        	=> __( 'Display', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-description' => 'display: {{VALUE}}',
					],
					'separator'		=> 'before'
				]
			);
			$this->end_controls_section();
			Button_Group_Control::button_style_fields( $this, 'primary', __( 'Button', 'litho-addons' ) );
		}

		/**
		 * Render icon box widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['litho_hover_animation'] ] );
			$icon_tag = 'span';

			if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
				// add old default
				$settings['icon'] = 'fa fa-star';
			}

			$has_icon = ! empty( $settings['icon'] );

			if ( ! empty( $settings['litho_link']['url'] ) ) {
				$icon_tag = 'a';
				$this->add_link_attributes( 'litho_link', $settings['litho_link'] );
			}

			if ( $has_icon ) {
				$this->add_render_attribute( 'i', 'class', $settings['icon'] );
				$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
			}

			$icon_attributes = $this->get_render_attribute_string( 'icon' );
			$link_attributes = $this->get_render_attribute_string( 'litho_link' );

			$this->add_render_attribute( 'litho_description_text', 'class', 'elementor-icon-box-description' );

			$this->add_inline_editing_attributes( 'litho_title_text', 'none' );
			$this->add_inline_editing_attributes( 'litho_description_text' );
			if ( ! $has_icon && ! empty( $settings['litho_selected_icon']['value'] ) ) {
				$has_icon = true;
			}
			$migrated = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
			$is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( $has_icon ) {
				$this->add_render_attribute( 'wrapper', 'class', [ 'elementor-icon-box-wrapper', 'litho-icon-box-wrapper' ] );
				$this->add_render_attribute( 'inner_wrapper', 'class', [ 'elementor-icon-box-icon' ] );

			} else {

				$this->add_render_attribute( 'wrapper', 'class', [ 'litho-image-box-wrapper' ] );
				$this->add_render_attribute( 'inner_wrapper', 'class', [ 'litho-image-box-img' ] );
			}
			if ( $this->get_settings( 'litho_icon_box_hover_animation' ) ) {
				$this->add_render_attribute( 'wrapper', [
					'class' => [ 'icon-box-hover', 'hvr-' . $this->get_settings( 'litho_icon_box_hover_animation' ) ]
				] );
			}
			$icon = '';
			if ( $is_new || $migrated ) {
				ob_start();
				?>
					<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
						<?php Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</<?php echo $icon_tag; ?>>
				<?php
				$icon .= ob_get_clean();
			} else {
				ob_start();
				?>
					<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
						<i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i>
					</<?php echo $icon_tag; ?>>
				<?php
				$icon .= ob_get_clean();
			}

			$litho_item_image = '';
			if ( ! empty( $settings['litho_item_image']['id'] ) ) {

				if ( 'custom' === $settings['litho_thumbnail_size'] ) {

					$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_item_image']['id'], 'litho_thumbnail', $settings );
					$litho_item_image_alt = Control_Media::get_image_alt( $settings['litho_item_image'] );
					$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
		
				} else {
					$srcset_data          = litho_get_image_srcset_sizes( $settings['litho_item_image']['id'], $settings['litho_thumbnail_size'] );
					$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_item_image']['id'], 'litho_thumbnail', $settings );
					$litho_item_image_alt = Control_Media::get_image_alt( $settings['litho_item_image'] );
					$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );
				}

			} elseif ( ! empty( $settings['litho_item_image']['url'] ) ) {
				$litho_item_image_url = $settings['litho_item_image']['url'];
				$litho_item_image_alt = '';
				$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
			}
			?>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php
				if ( ! empty( $settings['litho_selected_icon'] ) || ! empty( $litho_item_image ) ) {
					?>
				<div <?php $this->print_render_attribute_string( 'inner_wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
					echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
				?></div>
				<?php
				}
				?>
				<div class="elementor-icon-box-content">
					<?php
					if ( ! empty( $settings['litho_title_text'] ) ) {
						$litho_title_text = str_replace( '||', '<br />', $settings['litho_title_text'] );
						?>
						<<?php echo $settings['litho_title_size']; ?> class="elementor-icon-box-title"><<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php
								$this->print_render_attribute_string( 'litho_title_text' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
									echo sprintf( '%s', wp_kses_post( $litho_title_text ) );
									?></<?php echo $icon_tag; ?>>
						</<?php echo $settings['litho_title_size']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php
					}

					if ( ! Utils::is_empty( $settings['litho_description_text'] ) ) :
						?>
					<p <?php $this->print_render_attribute_string( 'litho_description_text' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
						echo sprintf( '%s', $settings['litho_description_text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?></p>
					<?php
					endif;
					?>
					<?php Button_Group_Control::render_button_content( $this, 'primary' ); ?>
				</div>
			</div>
		<?php
		}

		public function on_import( $element ) {
			return Icons_Manager::on_import_migration( $element, 'icon', 'litho_selected_icon', true );
		}
	}
}
