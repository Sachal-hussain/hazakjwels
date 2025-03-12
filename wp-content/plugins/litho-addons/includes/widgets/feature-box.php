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
use Elementor\Group_Control_Image_Size;
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
 * Litho widget for feature box.
 *
 * @package Litho
 */

// If class `Feature_Box` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Feature_Box' ) ) {

	class Feature_Box extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-feature-box';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Feature Box', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-info-box';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 * @access public
		 *
		 * @return string Widget categories.
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
			return [ 'content', 'box', 'info' ];
		}

		/**
		 * Register feature box widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_feature_box_settings_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_feature_box_styles',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'icon-text-style-1',
					'options' 		=> [
						'icon-text-style-1'  => __( 'Style 1', 'litho-addons' ),
						'icon-text-style-2'  => __( 'Style 2', 'litho-addons' ),
						'icon-text-style-3'  => __( 'Style 3', 'litho-addons' ),
						'icon-text-style-4'  => __( 'Style 4', 'litho-addons' ),
						'icon-text-style-5'  => __( 'Style 5', 'litho-addons' ),
						'icon-text-style-6'  => __( 'Style 6', 'litho-addons' ),
						'icon-text-style-7'  => __( 'Style 7', 'litho-addons' ),
						'icon-text-style-8'  => __( 'Style 8', 'litho-addons' ),
						'icon-text-style-9'  => __( 'Style 9', 'litho-addons' ),
						'icon-text-style-10' => __( 'Style 10', 'litho-addons' ),
					], 
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_show_separator',
				[
					'label'         => __( 'Show Separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-3' ] ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_background_image_section',
				[
					'label' 		=> __( 'Background Image', 'litho-addons' ),
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-4', 'icon-text-style-6', 'icon-text-style-7', 'icon-text-style-8' ] ], // IN
				]
			);
			$this->add_control(
				'litho_bg_image',
				[
					'label' 	=> __( 'Choose Image', 'litho-addons' ),
					'type' 		=> Controls_Manager::MEDIA,
					'dynamic' 	=> [
						'active' 	=> true,
					],
					'default' 	=> [
						'url' 	=> Utils::get_placeholder_image_src(),
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 		=> 'litho_bg_image_thumbnail',
					'label' 	=> __( 'Image Resolution', 'litho-addons' ),
					'default' 	=> 'full',
					'exclude'	=> [ 'custom' ],
					'condition' => [
						'litho_bg_image[id]!' => '',
					],
					'separator' => 'none',
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_feature_box_icon_image_section',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'condition'     => [ 'litho_feature_box_styles!' => [ 'icon-text-style-7', 'icon-text-style-8' ] ], // NOT IN
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
				'litho_item_icon',
				[
					'label'       	=> __( 'Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
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
			$this->add_control(
				'litho_view',
				[
					'label' 		=> __( 'View', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'default' 	=> __( 'Default', 'litho-addons' ),
						'stacked' 	=> __( 'Stacked', 'litho-addons' ),
						'framed' 	=> __( 'Framed', 'litho-addons' ),
					],
					'default' 		=> 'default',
					'condition' 	=> [
						'litho_item_use_image' => '',
						'litho_feature_box_styles!' => [ 'icon-text-style-4' ],
					],
					'prefix_class' 	=> 'elementor-view-',				
				]
			);
			$this->add_control(
				'litho_icon_shape',
				[
					'label' 		=> __( 'Shape', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'circle' 	=> __( 'Circle', 'litho-addons' ),
						'square' 	=> __( 'Square', 'litho-addons' ),
					],
					'default' 		=> 'circle',
					'condition' 	=> [
						'litho_view!'	 => 'default',
						'litho_item_use_image' => '',
						'litho_feature_box_styles!' => [ 'icon-text-style-4' ],
					],
					'prefix_class' 	=> 'elementor-shape-',
				]
			);
			$this->add_control(
				'litho_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 300 ] ],
					'condition' 	=> [
						'litho_item_use_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 2000 ] ],
					'condition' 	=> [
						'litho_item_use_image' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_box_width',
				[
					'label'      	=> __( 'Width', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 500 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .icon-text-style-4 .hover-action-btn .elementor-icon' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_item_use_image' => '',
						'litho_feature_box_styles' => [ 'icon-text-style-4' ],
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_box_height',
				[
					'label'      	=> __( 'Height', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 500 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'  	=> [
						'{{WRAPPER}} .icon-text-style-4 .hover-action-btn .elementor-icon' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_item_use_image' => '',
						'litho_feature_box_styles' => [ 'icon-text-style-4' ],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'exclude'	=> [ 'custom' ],
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_title_section',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_feature_box_title',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'label_block'   => true,
					'default'       => __( 'Write title here', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_link_on_title',
				[
					'label'         => __( 'Link on Title?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'condition'     => [
						'litho_feature_box_styles!' => 'icon-text-style-10' // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_title_link',
				[
					'label'         => __( 'Link', 'litho-addons' ),
					'type'          => Controls_Manager::URL,
					'dynamic'       => [
						'active' => true,
					],
					'placeholder'   => __( 'https://your-link.com', 'litho-addons' ),
					'default'       => [
						'url'       => '#',
					],
					'condition'     => [
						'litho_link_on_title!' => '',
						'litho_feature_box_styles!' => 'icon-text-style-10' // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_header_size',
				[
					'label' 		=> __( 'HTML Tag', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'h1' 			=> 'H1',
						'h2' 			=> 'H2',
						'h3' 			=> 'H3',
						'h4' 			=> 'H4',
						'h5' 			=> 'H5',
						'h6' 			=> 'H6',
						'div' 			=> 'div',
						'span' 			=> 'span',
						'p' 			=> 'p',
					],
					'default' 		=> 'span'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_subtitle_section',
				[
					'label' 		=> __( 'Subtitle', 'litho-addons' ),
					'condition'     => [
						'litho_feature_box_styles!' => [ 'icon-text-style-1', 'icon-text-style-6' ]  // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_feature_box_subtitle',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'label_block'   => true,
				]
			);
			$this->add_control(
				'litho_link_on_subtitle',
				[
					'label'         => __( 'Link on Subtitle?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'condition'     => [ 
						'litho_feature_box_styles' => [ 'icon-text-style-2', 'icon-text-style-10' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_subtitle_link',
				[
					'label'         => __( 'Link', 'litho-addons' ),
					'type'          => Controls_Manager::URL,
					'dynamic'       => [
						'active' => true,
					],
					'placeholder'   => __( 'https://your-link.com', 'litho-addons' ),
					'default'       => [
						'url'       => '#',
					],
					'condition'     => [ 
						'litho_link_on_subtitle!' 	=> '' ,
						'litho_feature_box_styles' => [ 'icon-text-style-2', 'icon-text-style-10' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_content_section',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'condition'     => [ 'litho_feature_box_styles!' => [ 'icon-text-style-7', 'icon-text-style-8' ] ], // NOT IN
				]
			);
			$this->add_control(
				'litho_feature_box_content',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'type'          => Controls_Manager::WYSIWYG,
					'show_label'    => false,
					'dynamic'       => [
						'active'    => true,
					],
					'default'       => __( 'Lorem ipsum is simply dummy text of the printing typesetting lorem ipsum been text. Adipiscing eiusmod tempor incididunt magna.', 'litho-addons' ),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_button_section',
				[
					'label'         => __( 'Button', 'litho-addons' ),
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-1', 'icon-text-style-4', 'icon-text-style-5', 'icon-text-style-6', 'icon-text-style-7', 'icon-text-style-8', 'icon-text-style-9' ] ], // IN
				]
			);
			$this->add_control(
				'litho_feature_box_button_text',
				[
					'label' 		=> __( 'Button Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'default' 		=> __( 'Click Here', 'litho-addons' ),
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
					'label_block' 	=> true,
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'default'       => [
						'url'       => '#',
					],
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
					'condition'     => [ 'litho_feature_box_styles!' => [ 'icon-text-style-1' ] ], // NOT IN
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
					'condition' 	=> [
							'litho_selected_icon[value]!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'litho_icon_indent',
				[
					'label' 		=> __( 'Icon Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'max' 	=> 50,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-button .elementor-align-icon-left' 	=> 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_selected_icon[value]!' => '',
						'litho_feature_box_styles!' => [ 'icon-text-style-5' ], // NOT IN
					]
				]
			);	

			$this->add_responsive_control(
				'litho_feature_box_button_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-button-wrapper .elementor-button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_selected_icon[value]!' => '',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_general_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_tabs' );
				$this->start_controls_tab( 'litho_feature_box_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_feature_box_background',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .feature-box',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'          => 'litho_feature_box_shadow',
							'selector'      => '{{WRAPPER}} .feature-box',
						]
					);
					$this->add_control(
						'litho_feature_box_normal_border_radius',
						[
							'label' 		=> __( 'Border Radius', 'litho-addons' ),
							'type' 			=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .feature-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-1', 'icon-text-style-9' ] ], // IN
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_feature_box_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_feature_box_background_hover',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .feature-box:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'			=> 'litho_feature_hover_box_shadow',
							'selector'		=> '{{WRAPPER}} .feature-box:hover',
						]
					);
					$this->add_control(
						'litho_feature_box_border_radius',
						[
							'label' 		=> __( 'Border Radius', 'litho-addons' ),
							'type' 			=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .feature-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-1', 'icon-text-style-9' ] ], // IN
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_feature_box_border',
					'selector'      => '{{WRAPPER}} .feature-box',
					'separator' 	=> 'before',
				]
			);			
			$this->add_responsive_control(
				'litho_feature_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_feature_box_content_box_heading',
				[
					'label'         => __( 'Content Box', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-4', 'icon-text-style-6' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_content_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} figcaption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-4', 'icon-text-style-6' ] ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_icon_style_section',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_feature_box_styles!' => [ 'icon-text-style-7', 'icon-text-style-8' ] ], // NOT IN
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_icon_style_tabs' );
				$this->start_controls_tab(
					'litho_feature_box_icon_style_normal_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_item_use_image' => '',
						],
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_icon_color',
						'condition' => [
							'litho_item_use_image' => '',
							'litho_view'           => 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .elementor-icon i:before, {{WRAPPER}}.elementor-view-default .elementor-icon svg, {{WRAPPER}} .icon-text-style-4 .elementor-icon svg',
					]
				);
				$this->add_control(
					'litho_primary_color',
					[
						'label'			=> __( 'Primary Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'condition'		=> [
							'litho_view!' => 'default',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_secondary_color',
					[
						'label' 		=> __( 'Secondary Color', 'litho-addons' ),
						'type'			=> Controls_Manager::COLOR,
						'default'		=> '',
						'condition'		=> [
								'litho_view!' => 'default',
						],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor-view-framed .elementor-icon'  => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_feature_box_icon_style_hover_tab',
					[
						'label'     => __( 'Hover', 'litho-addons' ),
						'condition' => [
							'litho_item_use_image' => '',
						],
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_hover_icon_color',
						'condition' => [
							'litho_item_use_image' => '',
							'litho_view' 			=> 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default:hover .elementor-icon i:before, {{WRAPPER}}.elementor-view-default:hover .elementor-icon svg, {{WRAPPER}}.elementor-view-default:hover .elementor-icon svg path',
					]
				);
				$this->add_control(
					'litho_hover_primary_color',
					[
						'label' 	=> __( 'Primary Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon, {{WRAPPER}}.elementor-view-default:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_hover_secondary_color',
					[
						'label' 	=> __( 'Secondary Color', 'litho-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon' 	=> 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_feature_icon_image_size',
				[
					'label' 	=> __( 'Image Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 1,
								'max' => 1000,
						],
						'%' => [
							'max' => 100,
							'min' => 1,
						],
					],
					'default'   => [ 'unit' => 'px' ],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon img' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_responsive_control(
				'litho_feature_icon_image_size_height',
				[
					'label'      => __( 'Image Height', 'litho-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 1000,
						],
						'%' => [
							'max' => 100,
							'min' => 1,
						],
					],
					'default' => [ 'unit' => 'px' ],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon img' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_feature_icon_image_border',
					'selector' 		=> '{{WRAPPER}} .elementor-icon',
				]
			);
			$this->add_control(
				'litho_feature_icon_image_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_feature_box_styles' => [ 'icon-text-style-3', 'icon-text-style-5' ], // IN
						'litho_item_use_image' 	=> 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .elementor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_feature_icon_box_shadow',
					'selector'      => '{{WRAPPER}} .feature-box .elementor-icon',
					'condition'     => [ 'litho_feature_box_styles' => 'icon-text-style-3' ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_title_style_section',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_primary_display_title_settings' ,
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
						'{{WRAPPER}} .feature-box-content .title' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_feature_box_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .feature-box .title',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_title_width',
				[
					'label' => __( 'Width', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max'	=> 1000,
							'step'	=> 1,
						],
						'%' => [
							'min'	=> 0,
							'max'	=> 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .feature-box .title' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-3', 'icon-text-style-7' ] ], // IN
				]
			);

			$this->start_controls_tabs( 'litho_feature_box_title_tabs' );
				$this->start_controls_tab( 'litho_feature_box_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_feature_box_title_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .feature-box .title, {{WRAPPER}} .feature-box .title a' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_feature_box_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_feature_box_title_color_hover',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}}:hover .feature-box .title, {{WRAPPER}}:hover .feature-box .title a' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_feature_box_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_subtitle_style_section',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-2', 'icon-text-style-3', 'icon-text-style-4', 'icon-text-style-5', 'icon-text-style-7', 'icon-text-style-8', 'icon-text-style-9', 'icon-text-style-10' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_primary_display_subtitle_settings' ,
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
						'{{WRAPPER}} .feature-box-content .subtitle' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_feature_box_subtitle_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .feature-box .subtitle',
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_subtitle_tabs' );
				$this->start_controls_tab( 'litho_feature_box_subtitle_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_feature_box_subtitle_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .feature-box .subtitle, {{WRAPPER}} .feature-box .subtitle a' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_feature_box_subtitle_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_feature_box_subtitle_color_hover',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}}:hover .feature-box .subtitle, {{WRAPPER}}:hover .feature-box .subtitle a' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_feature_box_subtitle_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_subtitle_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_content_style_section',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_feature_box_styles!' => [ 'icon-text-style-7', 'icon-text-style-8' ] ], // NOT IN
				]
			);
			$this->add_responsive_control(
				'litho_primary_display_content_settings' ,
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
						'{{WRAPPER}} .content' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_feature_box_content_typography',
					'selector'  => '{{WRAPPER}} .feature-box .content',
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_content_tabs' );
				$this->start_controls_tab( 'litho_feature_box_content_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_feature_box_content_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .feature-box .content' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_feature_box_content_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_feature_box_content_color_hover',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}}:hover .feature-box .content' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_feature_box_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			
			/* Button For Style 1, 5 */
			$this->start_controls_section(
				'litho_section_style_button',
				[
					'label'		=> __( 'Button', 'litho-addons' ),
					'tab' 		=> Controls_Manager::TAB_STYLE,
					'condition' => [ 'litho_feature_box_styles' => [ 'icon-text-style-1', 'icon-text-style-5' ] ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->start_controls_tabs( 'litho_tabs_button_style' );
			$this->start_controls_tab(
				'litho_tab_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_button_text_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
					'fields_options' 	=> [
						'background' 	=> [
							'frontend_available' => true,
						],
					],
				]
			);
			$this->add_control(
				'litho_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tab_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_hover_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}}:hover a.elementor-button, {{WRAPPER}}:hover .elementor-button, {{WRAPPER}}:focus a.elementor-button, {{WRAPPER}}:focus .elementor-button' => 'color: {{VALUE}};',
						'{{WRAPPER}}:hover a.elementor-button svg, {{WRAPPER}}:hover .elementor-button svg, {{WRAPPER}}:focus a.elementor-button svg, {{WRAPPER}}:focus .elementor-button svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_button_background_hover_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}}:hover a.elementor-button, {{WRAPPER}}:hover .elementor-button, {{WRAPPER}}:focus a.elementor-button, {{WRAPPER}}:focus .elementor-button',
					'fields_options' 	=> [
						'background' 	=> [
							'frontend_available' => true,
						],
					],
				]
			);

			$this->add_control(
				'litho_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_border_border!' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}}:hover a.elementor-button, {{WRAPPER}}:hover .elementor-button, {{WRAPPER}}:focus a.elementor-button, {{WRAPPER}}:focus .elementor-button' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_button_hover_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}}:hover a.elementor-button, {{WRAPPER}}:hover .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
					'condition'     => [
						'litho_feature_box_styles' => [ 'icon-text-style-1' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_button_hover_transition',
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
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'transition-duration: {{SIZE}}s',
					],
					'condition'     => [
						'litho_feature_box_styles' => [ 'icon-text-style-1' ] // IN
					]
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
				]
			);
			$this->add_responsive_control(
				'litho_text_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();

			/* Button For Style 4, 7, 8 & 9 */
			$this->start_controls_section(
				'litho_feature_box_button',
				[
					'label' 			=> __( 'Button', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-4', 'icon-text-style-6', 'icon-text-style-7', 'icon-text-style-8', 'icon-text-style-9' ] ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_feature_box_button_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_feature_box_button_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->add_responsive_control(
				'litho_button_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'width: {{SIZE}}{{UNIT}}',
					]
				]
			);
			$this->add_responsive_control(
				'litho_button_height',
				[
					'label'         => __( 'Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'height: {{SIZE}}{{UNIT}}',
					]
				]
			);
			$this->start_controls_tabs( 'litho_feature_box_button_style' );
			$this->start_controls_tab(
				'litho_feature_box_button_normal_style',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_feature_box_button_text_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_feature_box_button_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
					'fields_options' 	=> [
						'background' 	=> [
							'frontend_available' => true,
						],
					],
				]
			);
			$this->add_control(
				'litho_feature_box_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_feature_box_button_hover_style',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_feature_box_button_hover_text_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} a.elementor-button:hover svg, {{WRAPPER}} .elementor-button:hover svg, {{WRAPPER}} a.elementor-button:focus svg, {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_feature_box_button_background_hover_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus',
					'fields_options' 	=> [
						'background' 	=> [
							'frontend_available' => true,
						],
					],
				]
			);

			$this->add_control(
				'litho_feature_box_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_feature_box_button_border_border!' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_feature_box_button_hover_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_feature_box_button_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->add_control(
				'litho_feature_box_button_hover_transition',
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
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'transition-duration: {{SIZE}}s',
					],
					'condition'     => [
						'litho_feature_box_styles' => [ 'icon-text-style-4', 'icon-text-style-6', 'icon-text-style-7', 'icon-text-style-8', 'icon-text-style-9' ] // IN
					]
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_feature_box_button_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_feature_box_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_button_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_separator_style_section',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_show_separator'		=> 'yes',
						'litho_feature_box_styles' => [ 'icon-text-style-3' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_feature_box_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .feature-box .separator-line' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_separator_thickness',
				[
					'label'         => __( 'Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'size'      => 1,
						'unit'      => 'px',
					],
					'size_units'    => [ 'px' ],
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 30 ] ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .separator-line' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_separator_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'size'      => 10,
						'unit'      => '%',
					],
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 200 ], '%' => [ 'min' => 1, 'max' => 100 ]  ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .separator-line' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_feature_box_separator_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .feature-box .separator-line' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_feature_box_overlay_section',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 'litho_feature_box_styles' => [ 'icon-text-style-4', 'icon-text-style-6', 'icon-text-style-7', 'icon-text-style-8' ] ], // IN
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_feature_box_image_overlay_color',
					'fields_options'    => [ 'background' => [ 'label' => __( 'Image Overlay', 'litho-addons' ) ] ],
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .bg-overlay',
					'condition'     => [ 'litho_feature_box_styles' => 'icon-text-style-6' ], // IN
				]
			);


			$this->add_control(
				'litho_feature_box_hover_overlay_heading',
				[
					'label'         => __( 'Hover Overlay', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
					'condition'     => [ 'litho_feature_box_styles' => 'icon-text-style-6' ], // IN
				]
			);

			$this->start_controls_tabs( 'litho_feature_box_overlay_tabs' );
				$this->start_controls_tab(
					'litho_feature_box_overlay_normal_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'              => 'litho_feature_box_background_overlay_color',
						'fields_options'    => [ 'background' => [ 'label' => __( 'Overlay Color', 'litho-addons' ) ] ],
						'types'             => [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'          => '{{WRAPPER}} .icon-text-overlay',
					]
				);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_feature_box_overlay_hover_tab',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'              => 'litho_feature_box_background_overlay_hover_color',
						'fields_options'    => [ 'background' => [ 'label' => __( 'Overlay Color', 'litho-addons' ) ] ],
						'types'             => [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'          => '{{WRAPPER}}:hover .icon-text-overlay',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * Render feature box widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$icon                 = '';
			$litho_item_image     = '';
			$settings             = $this->get_settings_for_display();
			$feature_box_styles   = ( isset( $settings['litho_feature_box_styles'] ) && $settings['litho_feature_box_styles'] ) ? $settings['litho_feature_box_styles'] : 'icon-text-style-1';
			$feature_box_title    = ( isset( $settings['litho_feature_box_title'] ) && $settings['litho_feature_box_title'] ) ? $settings['litho_feature_box_title'] : '';
			$feature_box_subtitle = ( isset( $settings['litho_feature_box_subtitle'] ) && $settings['litho_feature_box_subtitle'] ) ? $settings['litho_feature_box_subtitle'] : '';
			$feature_box_content  = ( isset( $settings['litho_feature_box_content'] ) && $settings['litho_feature_box_content'] ) ? $settings['litho_feature_box_content'] : '';
			$link_on_title        = ( isset( $settings['litho_link_on_title'] ) && $settings['litho_link_on_title'] ) ? $settings['litho_link_on_title'] : '';
			$link_on_subtitle     = ( isset( $settings['litho_link_on_subtitle'] ) && $settings['litho_link_on_subtitle'] ) ? $settings['litho_link_on_subtitle'] : '';
			$show_separator       = ( isset( $settings['litho_show_separator'] ) && $settings['litho_show_separator'] ) ? $settings['litho_show_separator'] : '';
			$migrated             = isset( $settings['__fa4_migrated']['litho_item_icon'] );
			$is_new               = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
				$icon .= '<i class="' . esc_attr( $settings['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
			}
			
			if ( ! empty( $settings['litho_item_image']['id'] ) ) {
				$srcset_data          = litho_get_image_srcset_sizes( $settings['litho_item_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_item_image']['id'], 'litho_thumbnail', $settings );
				$litho_item_image_alt = Control_Media::get_image_alt( $settings['litho_item_image'] );
				$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );
			} elseif ( ! empty( $settings['litho_item_image']['url'] ) ) {
				$litho_item_image_url = $settings['litho_item_image']['url'];
				$litho_item_image_alt = '';
				$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
			}

			$this->add_render_attribute( 'wrapper', 'class', [ 'feature-box', $feature_box_styles ] );

			// Start Link on title
			if ( ! empty( $settings['litho_title_link']['url'] ) ) {

				$this->add_link_attributes( '_link', $settings['litho_title_link'] );
				$this->add_render_attribute( '_link', 'class', 'title-link' );
			}
			// End Link on title

			// Start Link on subtitle
			if ( ! empty( $settings['litho_subtitle_link']['url'] ) ) {

				$this->add_link_attributes( '_subtitle_link', $settings['litho_subtitle_link'] );
				$this->add_render_attribute( '_subtitle_link', 'class', 'subtitle-link' );

			}
			// End Link on subtitle

			$migrated_btn_icon = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
			$is_new_btn_icon   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			$this->add_render_attribute( 'button', 'class', [ 'elementor-button-wrapper' ] );

			if ( ! empty( $settings['litho_link']['url'] ) ) {

				$this->add_link_attributes( 'link', $settings['litho_link'] );
				$this->add_render_attribute( 'link', 'class', 'elementor-button-link' );

			}

			$this->add_render_attribute( 'link', 'class', 'elementor-button' );
			$this->add_render_attribute( 'link', 'role', 'button' );

			if ( ! empty( $settings['litho_size'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'elementor-size-' . $settings['litho_size'] );
			}

			/* Custom Effect */
			$hover_animation_effect_array = litho_custom_hover_animation_effect();
			
			$custom_animation_class = '';
			switch ( $feature_box_styles ) {
				case 'icon-text-style-1':
					if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
						$this->add_render_attribute( 'link', 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
						if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
							$custom_animation_class = 'btn-custom-effect';
						}
					}
					break;
				case 'icon-text-style-4':
				case 'icon-text-style-6':
				case 'icon-text-style-7':
				case 'icon-text-style-8':
				case 'icon-text-style-9':
					if ( ! empty( $this->get_settings( 'litho_feature_box_button_hover_animation' ) ) ) {
						$this->add_render_attribute( 'link', 'class', [ 'hvr-' . $this->get_settings( 'litho_feature_box_button_hover_animation' ) ] );
						if ( in_array( $this->get_settings( 'litho_feature_box_button_hover_animation' ), $hover_animation_effect_array ) ) {
							$custom_animation_class = 'btn-custom-effect';
						}
					}
					break;
			}
			$this->add_render_attribute( 'link', 'class', [ $custom_animation_class ] );

			$this->add_render_attribute( [
				'content-wrapper' => [
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

			switch ( $feature_box_styles ) {
				case 'icon-text-style-1':
				default:
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>><?php
						if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) {
							?><div class="elementor-icon"><?php
								echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; // phpcs:ignore
							?></div><?php
						}
						if ( ! empty( $feature_box_title ) || ! empty( $feature_box_content ) ) {
							?><div class="feature-box-content"><?php
								if ( ! empty( $feature_box_title ) ) {
									?><<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title"><?php
										if ( 'yes' === $link_on_title ) {
											?><a <?php $this->print_render_attribute_string( '_link' ); ?>><?php
										}
										echo esc_html( $feature_box_title );
										if ( 'yes' === $link_on_title ) {
											?></a><?php
										}
									?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>><?php
								}
								if ( ! empty( $feature_box_content ) ) {
									?><div class="content"><?php
										echo sprintf( '%s', wp_kses_post( $feature_box_content ) );
									?></div><?php
								}
								if ( $this->get_settings( 'litho_feature_box_button_text' ) ) {
									?><div <?php $this->print_render_attribute_string( 'button' ); ?>>
										<a <?php $this->print_render_attribute_string( 'link' ); ?>>
											<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>><?php
												if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) :
												?>
												<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
													<?php
													if ( $is_new_btn_icon || $migrated_btn_icon ) {
														Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
													} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
														?>
														<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
														<?php
													}
													?>
												</span>
												<?php
											endif;
												?><span <?php $this->print_render_attribute_string( 'litho_text' ); ?>><?php
													echo esc_html( $this->get_settings( 'litho_feature_box_button_text' ) );
												?></span>
											</span>
										</a>
									</div><?php
								}
							?>
							</div>
							<?php
						}
						?>
					</div>
					<?php
					break;
				case 'icon-text-style-2':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="icon-text-style-wrapper"><?php
							if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) {
								?><div class="elementor-icon"><?php
									echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon;// phpcs:ignore
								?></div><?php
							}
							if ( ! empty( $feature_box_title ) || ! empty( $feature_box_subtitle ) ) {
								?><div class="feature-box-content"><?php
									if ( ! empty( $feature_box_title ) ) {
										?><<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title"><?php
											if ( 'yes' === $link_on_title ) {
												?><a <?php $this->print_render_attribute_string( '_link' ); ?>><?php
											}
											echo esc_html( $feature_box_title );
											if ( 'yes' === $link_on_title ) {
												?></a><?php
											}
											?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>><?php
									}
									if ( ! empty( $feature_box_subtitle ) ) {
										?><span class="subtitle"><?php
											if ('yes' === $link_on_subtitle) {
											?><a <?php $this->print_render_attribute_string( '_subtitle_link' ); ?>><?php
											}
											echo esc_html( $feature_box_subtitle );
											if ('yes' === $link_on_subtitle) {
												?></a><?php
											}
										?></span><?php
									}
								?></div><?php
							}
							if ( 'yes' === $show_separator ) {
								?><div class="separator-line"></div><?php 
							}
							if ( ! empty( $feature_box_content ) ) {
								?><div class="content"><span><?php
									echo sprintf( '%s', wp_kses_post( $feature_box_content ) );
								?></span></div><?php
							}
						?></div>
					</div>
					<?php
					break;
				case 'icon-text-style-3':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>><?php 
						if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) {
							?><div class="elementor-icon"><?php
								echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon;// phpcs:ignore
							?></div><?php
						}
						if ( ! empty( $feature_box_title ) || ! empty( $feature_box_subtitle ) ) {
							?><div class="feature-box-content"><?php
								if ( ! empty( $feature_box_title ) ) {
									?><<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title"><?php
									if ( 'yes' === $link_on_title ) {
										?><a <?php $this->print_render_attribute_string( '_link' ); ?>><?php
									}
										echo esc_html( $feature_box_title );
										if ( 'yes' === $link_on_title ) {
										?></a><?php
									}
									?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>><?php
								}
								if ( ! empty( $feature_box_subtitle ) ) {
									?><span class="subtitle text-medium"><?php
										echo esc_html( $feature_box_subtitle );
									?></span><?php
								}
							?></div><?php
						}
						if ( 'yes' === $show_separator ) {
							?><div class="separator-line"></div><?php
						}
						if ( ! empty( $feature_box_content ) ) {
							?><div class="content"><?php
							echo sprintf( '%s', wp_kses_post( $feature_box_content ) );
							?></div><?php
						}
					?>
					</div>
					<?php
					break;
				case 'icon-text-style-4':
					if ( ! empty( $settings['litho_bg_image']['id'] ) ) {
						$srcset_data             = litho_get_image_srcset_sizes( $settings['litho_bg_image']['id'], $settings['litho_bg_image_thumbnail_size'] );
						$litho_bg_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_bg_image']['id'], 'litho_bg_image_thumbnail', $settings );
						$litho_bg_item_image_alt = Control_Media::get_image_alt( $settings['litho_bg_image'] );
						$litho_bg_image          = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_bg_item_image_url ), esc_attr( $litho_bg_item_image_alt ), $srcset_data );

					} elseif ( ! empty( $settings['litho_bg_image']['url'] ) ) {
						$litho_bg_item_image_url = $settings['litho_bg_image']['url'];
						$litho_bg_item_image_alt = '';
						$litho_bg_image          = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_bg_item_image_url ), esc_attr( $litho_bg_item_image_alt ) );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<figure>
							<?php echo sprintf( '%s', $litho_bg_image ); ?>
							<figcaption>
								<div class="hover-content">
									<?php if ( ! empty( $feature_box_subtitle ) ) { ?>
										<div class="subtitle">
											<?php echo esc_html( $feature_box_subtitle ); ?>
										</div>
									<?php } ?>
									<?php if ( ! empty( $feature_box_title ) ) { ?>
										<<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title">
											<?php if ( 'yes' === $link_on_title ) { ?>
												<a <?php $this->print_render_attribute_string( '_link' ); ?>>
											<?php } ?>
											<?php echo esc_html( $feature_box_title ); ?>
											<?php if ( 'yes' === $link_on_title ) { ?>
												</a>
											<?php } ?>
										</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
									<?php } ?>
									<div class="hover-show-content">
										<?php if ( ! empty( $feature_box_content ) ) { ?>
											<div class="content"><?php echo sprintf( '%s', wp_kses_post( $feature_box_content ) ); ?></div>
										<?php } ?>
										<?php if ( $this->get_settings( 'litho_feature_box_button_text' ) ) { ?>
											<div <?php $this->print_render_attribute_string( 'button' ); ?>>
												<a <?php $this->print_render_attribute_string( 'link' ); ?>>
													<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
														<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
														<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
															<?php
															if ( $is_new_btn_icon || $migrated_btn_icon ) {
																Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
																?>
																<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
																<?php
															}
															?>
														</span>
														<?php endif; ?>
														<span <?php $this->print_render_attribute_string( 'litho_text' ); ?>><?php echo esc_html( $this->get_settings( 'litho_feature_box_button_text' ) ); ?></span>
													</span>
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
								<?php if ( $litho_item_image || $icon ) { ?>
									<div class="hover-action-btn">
										<div class="elementor-icon">
											<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; ?>
										</div>
									</div>
								<?php } ?>
								<?php if ( ! empty( $litho_bg_item_image_alt ) ) { ?>
									<div class="icon-text-overlay"></div>
								<?php } ?>
							</figcaption>
						</figure>
					</div>
					<?php
					break;
				case 'icon-text-style-5':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<?php if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) { ?>
							<div class="elementor-icon">
								<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon;// phpcs:ignore ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $feature_box_title ) || ! empty( $feature_box_subtitle ) ) { ?>
							<div class="feature-box-content">
								<?php if ( ! empty( $feature_box_title ) ) { ?>
									<<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title">
										<?php if ( 'yes' === $link_on_title ) { ?>
											<a <?php $this->print_render_attribute_string( '_link' ); ?>>
										<?php } ?>
										<?php echo esc_html( $feature_box_title ); ?>
										<?php if ( 'yes' === $link_on_title ) { ?>
											</a>
										<?php } ?>
									</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
								<?php } ?>
								<?php if ( ! empty( $feature_box_subtitle ) ) { ?>
									<span class="subtitle"><?php echo esc_html( $feature_box_subtitle ); ?></span>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $feature_box_content ) ) { ?>
							<div class="content"><?php echo sprintf( '%s', wp_kses_post( $feature_box_content ) ); ?></div>
						<?php } ?>
						<?php if ( $this->get_settings( 'litho_feature_box_button_text' ) ) { ?>
							<div <?php $this->print_render_attribute_string( 'button' ); ?>>
								<a <?php $this->print_render_attribute_string( 'link' ); ?>>
									<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
										<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
											<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
												<?php
												if ( $is_new_btn_icon || $migrated_btn_icon ) {
													Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
												} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
													?>
													<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
													<?php
												}
												?>
											</span>
										<?php endif; ?>
										<span <?php $this->print_render_attribute_string( 'litho_text' ); ?>><?php echo esc_html( $this->get_settings( 'litho_feature_box_button_text' ) ); ?></span>
									</span>
								</a>
							</div>
						<?php } ?>
					</div>
					<?php
					break;
				case 'icon-text-style-6':
					if ( ! empty( $settings['litho_bg_image']['id'] ) ) {
						$srcset_data             = litho_get_image_srcset_sizes( $settings['litho_bg_image']['id'], $settings['litho_bg_image_thumbnail_size'] );
						$litho_bg_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_bg_image']['id'], 'litho_bg_image_thumbnail', $settings );
						$litho_bg_item_image_alt = Control_Media::get_image_alt( $settings['litho_bg_image'] );
						$litho_bg_image          = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_bg_item_image_url ), esc_attr( $litho_bg_item_image_alt ), $srcset_data );
					} elseif ( ! empty( $settings['litho_bg_image']['url'] ) ) {
						$litho_bg_item_image_url = $settings['litho_bg_image']['url'];
						$litho_bg_item_image_alt = '';
						$litho_bg_image          = sprintf( '<img src="%1$s" alt="%2$s" />',esc_url( $litho_bg_item_image_url ), esc_attr( $litho_bg_item_image_alt ) );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<figure>
							<?php echo sprintf( '%s', $litho_bg_image ); ?>
							<div class="bg-overlay"></div>
							<?php if ( $litho_item_image || $icon ) { ?>
								<div class="hover-action-btn">
									<div class="elementor-icon">
										<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon;// phpcs:ignore ?>
									</div>
								</div>
							<?php } ?>
							<figcaption>
								<div class="hover-content d-table h-100 w-100">
									<div class="d-table-cell align-bottom">
										<?php if ( ! empty( $feature_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title">
											<?php
											if ( 'yes' === $link_on_title ) {
													?><a <?php $this->print_render_attribute_string( '_link' ); ?>><?php
												}
												echo esc_html( $feature_box_title );
												if ( 'yes' === $link_on_title ) {
													?></a><?php
												}
												?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
										<?php } ?>
										<div class="hover-show-content">
											<?php if ( ! empty( $feature_box_content ) ) { ?>
												<div class="content"><?php echo sprintf( '%s', wp_kses_post( $feature_box_content ) ); ?></div>
											<?php } ?>
											<?php if ( $this->get_settings( 'litho_feature_box_button_text' ) ) { ?>
												<div <?php $this->print_render_attribute_string( 'button' ); ?>>
													<a <?php $this->print_render_attribute_string( 'link' ); ?>>
														<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
															<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
															<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
																<?php
																if ( $is_new_btn_icon || $migrated_btn_icon ) {
																	Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
																} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
																	?>
																	<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
																	<?php
																}
																?>
															</span>
															<?php endif; ?>
															<span <?php $this->print_render_attribute_string( 'litho_text' ); ?>><?php echo esc_html( $this->get_settings( 'litho_feature_box_button_text' ) ); ?></span>
														</span>
													</a>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if ( ! empty( $litho_bg_item_image_url ) ) { ?>
									<div class="icon-text-overlay"></div>
								<?php } ?>
							</figcaption>
						</figure>
					</div>
					<?php
					break;
				case 'icon-text-style-7':
					$bg_image_url = '';
					if ( ! empty( $settings['litho_bg_image']['id'] ) ) {
						$bg_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_bg_image']['id'], 'litho_bg_image_thumbnail', $settings );

					} elseif ( ! empty( $settings['litho_bg_image']['url'] ) ) {
						$bg_image_url = $settings['litho_bg_image']['url'];
					}
					
					$bg_image_url = ( $bg_image_url ) ? 'background-image: url('. esc_url( $bg_image_url ) .'); background-repeat: no-repeat;' : '';

					$this->add_render_attribute( 'background_wrap', [
						'class' => [ 'cover-background', 'feature-background-img' ],
						'style' => $bg_image_url
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div <?php $this->print_render_attribute_string( 'background_wrap' ); ?>>
							<?php if ( ! empty( $bg_image_url ) ) { ?>
								<div class="icon-text-overlay"></div>
							<?php } ?>
						</div>
						<?php if ( ! empty( $feature_box_subtitle ) ) { ?>
							<div class="subtitle"><?php echo esc_html( $feature_box_subtitle ); ?> </div>
						<?php } ?>
						<?php if ( ! empty( $feature_box_title ) ) { ?>
							<<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title">
								<?php if ( 'yes' === $link_on_title ) { ?>
									<a <?php $this->print_render_attribute_string( '_link' ); ?>>
								<?php } ?>
								<?php echo esc_html( $feature_box_title ); ?>
								<?php if ( 'yes' === $link_on_title ) { ?>
									</a>
								<?php } ?>
							</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
						<?php } ?>
						<div <?php $this->print_render_attribute_string( 'button' ); ?>>
							<a <?php $this->print_render_attribute_string( 'link' ); ?>>
								<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
									<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
										<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
											<?php
											if ( $is_new_btn_icon || $migrated_btn_icon ) {
												Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
											} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
												?>
												<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
												<?php
											}
											?>
										</span>
									<?php endif; ?>
									<?php if ( $this->get_settings( 'litho_feature_box_button_text' ) ) { ?>
										<span <?php $this->print_render_attribute_string( 'litho_text' ); ?>><?php echo esc_html( $this->get_settings( 'litho_feature_box_button_text' ) ); ?></span>
									<?php } ?>
								</span>
							</a>
						</div>
					</div>
					<?php
					break;
				case 'icon-text-style-8':
					$bg_image_url = '';
					if ( ! empty( $settings['litho_bg_image']['id'] ) ) {
						$bg_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_bg_image']['id'], 'litho_bg_image_thumbnail', $settings );

					} elseif ( ! empty( $settings['litho_bg_image']['url'] ) ) {
						$bg_image_url = $settings['litho_bg_image']['url'];
					}
					
					$bg_image_url = ( $bg_image_url ) ? 'background-image: url('. esc_url( $bg_image_url ) .'); background-repeat: no-repeat;' : '';

					$this->add_render_attribute( 'background_wrap', [
						'class' => [ 'cover-background', 'feature-background-img' ],
						'style' => $bg_image_url
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div <?php $this->print_render_attribute_string( 'background_wrap' ); ?>>
							<?php if ( ! empty( $bg_image_url ) ) { ?>
								<div class="icon-text-overlay"></div>
							<?php } ?>
							<div class="d-flex flex-column h-100 justify-content-center feature-box-content">
								<?php if ( ! empty( $feature_box_subtitle ) ) { ?>
									<div class="subtitle"><?php echo esc_html( $feature_box_subtitle ); ?> </div>
								<?php } ?>
								<?php if ( ! empty( $feature_box_title ) ) { ?>
									<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title">
										<?php if ( 'yes' === $link_on_title ) { ?>
											<a <?php $this->print_render_attribute_string( '_link' ); ?>>
										<?php } ?>
										<?php echo esc_html( $feature_box_title ); ?>
										<?php if ( 'yes' === $link_on_title ) { ?>
											</a>
										<?php } ?>
									</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
								<?php } ?>
								<div <?php $this->print_render_attribute_string( 'button' ); ?>>
									<a <?php $this->print_render_attribute_string( 'link' ); ?>>
										<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
											<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
												<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
												<?php
												if ( $is_new_btn_icon || $migrated_btn_icon ) {
													Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
												} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
													?>
													<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
													<?php
												}
												?>
												</span>
											<?php endif; ?>
											<?php if ( $this->get_settings( 'litho_feature_box_button_text' ) ) { ?>
												<span <?php $this->print_render_attribute_string( 'litho_text' ); ?>><?php echo esc_html( $this->get_settings( 'litho_feature_box_button_text' ) ); ?></span>
											<?php } ?>
										</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php
					break;
				case 'icon-text-style-9':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="feature-box-wrap">
							<?php if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) { ?>
								<div class="elementor-icon">
									<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon;// phpcs:ignore ?>
								</div>
							<?php } ?>
							<?php if ( ! empty( $feature_box_title ) || ! empty( $feature_box_subtitle ) ) { ?>
								<div class="feature-box-content">
									<?php if ( ! empty( $feature_box_title ) ) { ?>
										<<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title">
											<?php if ( 'yes' === $link_on_title ) { ?>
												<a <?php $this->print_render_attribute_string( '_link' ); ?>>
											<?php } ?>
											<?php echo esc_html( $feature_box_title ); ?>
											<?php if ( 'yes' === $link_on_title ) { ?>
												</a>
											<?php } ?>
										</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
									<?php } ?>
									<?php if ( ! empty( $feature_box_subtitle ) ) { ?>
										<span class="subtitle"><?php echo esc_html( $feature_box_subtitle ); ?></span>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if ( ! empty( $feature_box_content ) ) { ?>
								<div class="content"><?php echo sprintf( '%s', wp_kses_post( $feature_box_content ) ); ?></div>
							<?php } ?>
							<?php if ( $this->get_settings( 'litho_feature_box_button_text' ) ) { ?>
								<div <?php $this->print_render_attribute_string( 'button' ); ?>>
									<a <?php $this->print_render_attribute_string( 'link' ); ?>>
										<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
											<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
												<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
													<?php
													if ( $is_new_btn_icon || $migrated_btn_icon ) {
														Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
													} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
														?>
														<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
														<?php
													}
													?>
												</span>
											<?php endif; ?>
											<span <?php $this->print_render_attribute_string( 'litho_text' ); ?>><?php echo esc_html( $this->get_settings( 'litho_feature_box_button_text' ) ); ?></span>
										</span>
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php
					break;
				case 'icon-text-style-10':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="icon-text-style-wrapper align-items-center d-flex">
							<div class="feature-box-wrap">
								<?php if ( ! empty( $feature_box_title ) || ! empty( $litho_item_image ) || ! empty( $icon ) ) { ?>
								<div class="feature-box-content-hover">
									<?php if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) { ?>
										<div class="elementor-icon">
											<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon;// phpcs:ignore ?>
										</div>
									<?php } ?>
									<?php if ( ! empty( $feature_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?> class="title">
												<?php echo esc_html( $feature_box_title ); ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore ?>>
										<?php } ?>
								</div>
								<?php } ?>
								<?php if ( ! empty( $feature_box_subtitle ) || ! empty( $feature_box_content ) ) { ?>
									<div class="feature-box-content">
										<?php if ( ! empty( $feature_box_subtitle ) ) { ?>
											<span class="subtitle">
												<?php if ( 'yes' === $link_on_subtitle ) { ?>
													<a <?php $this->print_render_attribute_string( '_subtitle_link' ); ?>>
												<?php } ?>
												<?php echo esc_html( $feature_box_subtitle ); ?>
												<?php if ( 'yes' === $link_on_subtitle ) { ?>
													</a>
												<?php } ?>
											</span>
										<?php } ?>
										<?php if ( ! empty( $feature_box_content ) ) { ?>
											<div class="content"><?php echo sprintf( '%s', wp_kses_post( $feature_box_content ) ); ?></div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
					break;
			}
		}
	}
}
