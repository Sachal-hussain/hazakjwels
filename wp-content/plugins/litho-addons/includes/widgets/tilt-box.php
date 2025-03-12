<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;
use LithoAddons\Controls\Groups\Icon_Group_Control;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for tilt box.
 *
* @package Litho
 */

// If class `Tilt_Box` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Tilt_Box' ) ) {

	class Tilt_Box extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve tilt box widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-tilt-box';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve tilt box widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Tilt Box', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve tilt box widget icon.
		 *
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
			return [ 'image', 'flip', 'fancy', 'overlap', 'vertical', 'text-rotate' ];
		}

		/**
		 * Register tilt box widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_tilt_box_section',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_tilt_box_style',
				[
					'label'       	=> __( 'Select Style', 'litho-addons' ),
					'type'        	=> Controls_Manager::SELECT,
					'default'     	=> 'tilt-box-style-1',
					'options'     	=> [
							'tilt-box-style-1' 		=> __( 'Style 1', 'litho-addons' ),
							'tilt-box-style-2'   	=> __( 'Style 2', 'litho-addons' ),
							'tilt-box-style-3'   	=> __( 'Style 3', 'litho-addons' ),
							'tilt-box-style-4'   	=> __( 'Style 4', 'litho-addons' ),
					],
					'label_block' 	=> true,
				]
			);	
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_tilt_box_icon_image_section',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'condition'     => [ 'litho_tilt_box_style' => [ 'tilt-box-style-2' ] ], // IN
				]
			);

			Icon_Group_Control::icon_fields( $this );
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_content_section',
				[
					'label' 		=> __( 'Content / Image', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_tilt_box_selection',
				[
					'label' 		=> __( 'Display Image ?', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '1',
					'return_value' 	=> '1',
					'condition' 	=> [ 
						'litho_tilt_box_style'	=> [ 'tilt-box-style-3' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_tilt_box_image',	
				[
					'label'   		=> __( 'Image', 'litho-addons' ),
					'type'    		=> Controls_Manager::MEDIA,
					'dynamic'		=> [
						'active' => true,
					],
					'default' 		=> [
						'url' 		=> Utils::get_placeholder_image_src(),
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-1',
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-2',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '!==',
										'value' 	=> '',
									],
								],
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-4',
							],
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_thumbnail',
					'default' 		=> 'full',
					'separator' 	=> 'none',
					'conditions' 	=> [
						'relation' => 'or',
						'terms' => [
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-1',
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-2',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '!==',
										'value' 	=> '',
									],
								],
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-4',
							],
						],
					],
				]
			);
			$this->add_control(
				'litho_background_image_position',
				[
					'label'		=> __( 'Position', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'center center',
					'options'	=> [
						''				=> __( 'Default', 'litho-addons' ),
						'center center'	=> __( 'Center Center', 'litho-addons' ),
						'center left'	=> __( 'Center Left', 'litho-addons' ),
						'center right'	=> __( 'Center Right', 'litho-addons' ),
						'top center'	=> __( 'Top Center', 'litho-addons' ),
						'top left'		=> __( 'Top Left', 'litho-addons' ),
						'top right'		=> __( 'Top Right', 'litho-addons' ),
						'bottom center'	=> __( 'Bottom Center', 'litho-addons' ),
						'bottom left'	=> __( 'Bottom Left', 'litho-addons' ),
						'bottom right'	=> __( 'Bottom Right', 'litho-addons' ),
					],
					'selectors'	=> [
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'background-position: {{VALUE}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-1',
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-2',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '!==',
										'value' 	=> '',
									],
								],
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-4',
							],
						],
					],
				]
			);
			$this->add_control(
				'litho_background_image_repeat',
				[
					'label'		=> __( 'Repeat', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'no-repeat',
					'options'	=> [
						''			=> __( 'Default', 'litho-addons' ),
						'no-repeat' => __( 'No-repeat', 'litho-addons' ),
						'repeat'	=> __( 'Repeat', 'litho-addons' ),
						'repeat-x'	=> __( 'Repeat-x', 'litho-addons' ),
						'repeat-y'	=> __( 'Repeat-y', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'background-repeat: {{VALUE}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-1',
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-2',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '!==',
										'value' 	=> '',
									],
								],
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-4',
							],
						],
					],
				]
			);
			$this->add_control(
				'litho_background_image_size',
				[
					'label'		=> __( 'Size', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'cover',
					'options'	=> [
						''			=> __( 'Default', 'litho-addons' ),
						'auto'		=> __( 'Auto', 'litho-addons' ),
						'cover'		=> __( 'Cover', 'litho-addons' ),
						'contain'	=> __( 'Contain', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'background-size: {{VALUE}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-1',
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-2',
							],
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '!==',
										'value' 	=> '',
									],
								],
							],
							[
								'name' 		=> 'litho_tilt_box_style',
								'operator'	=> '===',
								'value' 	=> 'tilt-box-style-4',
							],
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_tilt_box_background_image',
					'selector' 			=> '{{WRAPPER}} .tilt-box-style-4 .tilt-box',
					'condition' 	=> [ 
						'litho_tilt_box_style'	=> 'tilt-box-style-4', // IN
					],
					'fields_options' => [
						'background' => [
							'separator' => 'before'
						]
					]
				]
			);

			$this->add_control(
				'litho_description_text',
				[
					'label' 		=> __( 'Description', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus', 'litho-addons' ),
					'rows' 			=> 10,
					'condition' 	=> [ 
						'litho_tilt_box_style'			=> 'tilt-box-style-3', // IN
						'litho_tilt_box_selection' 	=> '' 
					],
				]
			);
			$this->add_control(
				'litho_author_text',
				[
					'label' 		=> __( 'Author Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block' 	=> true,
					'default'		=> __( 'Albert schweitzer', 'litho-addons' ),
					'condition' 	=> [ 
						'litho_tilt_box_style'			=> 'tilt-box-style-3', // IN
						'litho_tilt_box_selection' 	=> '' 
					],
				]
			);
			$this->add_control(
				'litho_letter_text',
				[
					'label' 		=> __( 'Letter Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'		=> __( '1', 'litho-addons' ),
					'label_block' 	=> true,
					'condition' 	=> [ 
						'litho_tilt_box_style'	=> [ 'tilt-box-style-3' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_letter_position',
				[
					'label' 	=> __( 'Letter Position', 'litho-addons' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'default' 	=> 'above',
					'toggle' 	=> false,
					'options' 	=> [
						'above' => [
							'title' => __( 'Above', 'litho-addons' ),
							'icon' 	=> 'eicon-arrow-up',
						],
						'below' => [
							'title' => __( 'Below', 'litho-addons' ),
							'icon' 	=> 'eicon-arrow-down',
						]
					],
					'condition' => [ 
						'litho_tilt_box_style'	=> [ 'tilt-box-style-3' ], // IN
					]
				]
			);
			$this->add_control(
				'litho_tilt_box_overlay',
				[
					'label' 		=> 	__( 'Overlay', 'litho-addons' ),
					'type' 			=>	Controls_Manager::SWITCHER,
					'label_on' 		=> __( 'On', 'litho-addons' ),
					'label_off' 	=> __( 'Off', 'litho-addons' ),
					'condition' 	=> [ 
						'litho_tilt_box_style'			=> [ 'tilt-box-style-1' ], // IN
						'litho_tilt_box_image[id]!' 	=> ''
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_title_section',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'condition' 	=> [ 'litho_tilt_box_style'	=> [ 'tilt-box-style-2' ] ], // IN
				]
			);
			$this->add_control(
				'litho_tilt_box_title',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'		=> __( 'Write title here', 'litho-addons' ),
					'label_block'   => true,
					'condition' 	=> [ 'litho_tilt_box_style'	=> [ 'tilt-box-style-2' ] ], // IN
				]
			);
			$this->add_control(
				'litho_tilt_box_title_position',
				[
					'label'     => __( 'Position', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'top',
					'options'   => [
						'top' => [
							'title' => __( 'Top', 'litho-addons' ),
							'icon'  => 'eicon-v-align-top',
						],
						'bottom' => [
							'title' => __( 'Bottom', 'litho-addons' ),
							'icon'  => 'eicon-v-align-bottom',
						],
					],
					'condition'     => [ 'litho_tilt_box_style' => [ 'tilt-box-style-2' ] ], // IN
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_overlap_title_section',
				[
					'label' 		=> __( 'Overlap Title', 'litho-addons' ),
					'condition' 	=> [ 'litho_tilt_box_style'	=> [ 'tilt-box-style-1', 'tilt-box-style-2', 'tilt-box-style-4' ] ], // IN
				]
			);
			$this->add_control(
				'litho_tilt_box_overlap_title',
				[
					'label'         => __( 'Overlap Title', 'litho-addons' ),
					'default'		=> __( 'Overlap', 'litho-addons' ),
					'description'	=> __( 'Use || to break the word in new line.', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'   => true,
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_tilt_box_border_radius',
				[
					'label'			=> __( 'Border Radius', 'litho-addons' ),
					'type'			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .tilt-box-wrapper .tilt-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}}.tilt-box > .elementor-widget-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_tilt_box_style'	=> 'tilt-box-style-1' ], // IN
				]
			);

			$this->add_control(
				'litho_tilt_box__border_radius',
				[
					'label'			=> __( 'Border Radius', 'litho-addons' ),
					'type'			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'selectors'	 	=> [
						'{{WRAPPER}} .tilt-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_tilt_box_style'	=> 'tilt-box-style-2' ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_tilt_box_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .tilt-box',
					'condition' 	=> [ 'litho_tilt_box_style'	=> 'tilt-box-style-2' ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_title_style_section',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_tilt_box_style'	=> [ 'tilt-box-style-2' ] ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_tilt_box_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .tilt-box-wrapper .title',
				]
			);
			$this->add_control(
				'litho_tilt_box_title_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_tilt_box_title_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .title',
					'fields_options' 	=> [
						'background' 	=> [
							'frontend_available' => true,
						],
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_title_display_settings' ,
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
						'{{WRAPPER}} .tilt-box-wrapper .title' => 'display: {{VALUE}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_content_style_section',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_tilt_box_style'	=> 'tilt-box-style-3' ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 				=> 'litho_tilt_box_content_box_background_color',
					'types' 			=> [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector' 			=> '{{WRAPPER}} .tilt-box-wrapper .tilt-box-inner',
					'fields_options' 	=> [
						'background' 	=> [
							'frontend_available' 	=> true,
							'label' 				=> __( 'Content Box Color', 'litho-addons' ),
						],
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_control(
				'litho_tilt_box_content_separator_panel_style',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_control(
				'litho_tilt_box_content_letter_heading',
				[
					'label'         => __( 'Letter', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_tilt_box_letter_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .tilt-box-wrapper .letter-wrap > span',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_tilt_box_letter_color',
					'selector'	=> '{{WRAPPER}} .tilt-box-wrapper .letter-wrap > span',
				]
			);
			$this->add_control(
				'litho_tilt_box_content_separator_heading',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_tilt_box_separator_color',
					'fields_options' 	=> [ 'background' => [ 'label' => __( 'Color', 'litho-addons' ) ] ],
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .tilt-box-wrapper .letter-wrap .separator-line',
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_separator_width',
				[
					'label'		=> __( 'Width', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', 'custom' ],
					'range'		=> [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .tilt-box-wrapper .letter-wrap .separator-line' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_tilt_box_content_description_heading',
				[
					'label'         => __( 'Description', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator' => 'before',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_tilt_box_description_typography',
					'selector'	=> '{{WRAPPER}} .tilt-box-wrapper .description-text',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_control(
				'litho_tilt_box_description_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .description-text' => 'color: {{VALUE}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_description_margin_bottom',
				[
					'label'         => __( 'Spacing', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 500 ] ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .description-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_control(
				'litho_tilt_box_content_author_heading',
				[
					'label'         => __( 'Author', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator' => 'before',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_tilt_box_author_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .tilt-box-wrapper .author-text',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_tilt_box_author_color',
					'selector'	=> '{{WRAPPER}} .tilt-box-wrapper .author-text',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .tilt-box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .tilt-box-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_tilt_box_style',
										'operator'	=> '===',
										'value' 	=> 'tilt-box-style-3',
									],
									[
										'name' 		=> 'litho_tilt_box_selection',
										'operator'	=> '===',
										'value' 	=> '',
									],
								],
							]
						],
					],
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_overlap_title_style_section',
				[
					'label'         => __( 'Overlap Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_tilt_box_style'	=> [ 'tilt-box-style-1', 'tilt-box-style-2', 'tilt-box-style-4' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_box_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'options'       => [
						'left'          => [
							'title'         => __( 'Left', 'litho-addons' ),
							'icon'          => 'eicon-text-align-left',
						],
						'center'        => [
							'title'         => __( 'Center', 'litho-addons' ),
							'icon'          => 'eicon-text-align-center',
						],
						'right'         => [
							'title'         => __( 'Right', 'litho-addons' ),
							'icon'          => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .tilt-box' => 'text-align: {{VALUE}};',
					],
					'condition' 	=> [ 'litho_tilt_box_style'	=> 'tilt-box-style-4' ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_tilt_box_overlap_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .tilt-box-wrapper .overlap-title',
				]
			);
			$this->add_control(
				'litho_tilt_box_overlap_title_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'color: {{VALUE}};',
					],
					'condition' 	=> [ 'litho_tilt_box_style!'	=> [ 'tilt-box-style-2', 'tilt-box-style-4' ] ], // NOT IN
				]
			);

			$this->add_responsive_control(
				'litho_tilt_box_overlap_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_tilt_box_overlap_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_overlap_title_display_settings' ,
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
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'display: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_tilt_box_overlap_title_z_index',
				[
					'label'		=> __( 'Z-Index', 'litho-addons' ),
					'type'		=> Controls_Manager::NUMBER,
					'min'		=> -1500,
					'max'		=> 1500,
					'selectors' => [
						'{{WRAPPER}} .tilt-box-wrapper .overlap-title' => 'z-index: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_tilt_box_overlay_style_section',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 
						'litho_tilt_box_style'			=> [ 'tilt-box-style-1' ], // IN
						'litho_tilt_box_image[id]!' 	=> '',
						'litho_tilt_box_overlay!' 		=> ''
					],
				]
			);
			
			$this->add_control(
				'litho_tilt_box_overlay_opacity',
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
						'{{WRAPPER}} .tilt-box-overlay' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_tilt_box_overlay_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .tilt-box-overlay',
				]
			);

			$this->end_controls_section();

		}

		/**
		 * Render tilt box widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                     = $this->get_settings_for_display();
			$litho_tilt_box_overlay       = ( isset( $settings['litho_tilt_box_overlay'] ) && $settings['litho_tilt_box_overlay'] ) ? $settings['litho_tilt_box_overlay'] : '';
			$litho_tilt_box_overlap_title = ( isset( $settings['litho_tilt_box_overlap_title'] ) && $settings['litho_tilt_box_overlap_title'] ) ? $settings['litho_tilt_box_overlap_title'] : '';
			$litho_tilt_box_title         = ( isset( $settings['litho_tilt_box_title'] ) && $settings['litho_tilt_box_title'] ) ? $settings['litho_tilt_box_title'] : '';
			$litho_letter_position        = ( isset( $settings['litho_letter_position'] ) && $settings['litho_letter_position'] ) ? $settings['litho_letter_position'] : '';
			$litho_tilt_box_selection     = ( isset( $settings['litho_tilt_box_selection'] ) && $settings['litho_tilt_box_selection'] ) ? $settings['litho_tilt_box_selection'] : '';
			$litho_letter_text            = ( isset( $settings['litho_letter_text'] ) && $settings['litho_letter_text'] ) ? $settings['litho_letter_text'] : '';
			$litho_author_text            = ( isset( $settings['litho_author_text'] ) && $settings['litho_author_text'] ) ? $settings['litho_author_text'] : '';
			$litho_description_text       = ( isset( $settings['litho_description_text'] ) && $settings['litho_description_text'] ) ? $settings['litho_description_text'] : '';

			$this->add_render_attribute( 'wrapper', 'class', [ 'tilt-box-wrapper', $settings['litho_tilt_box_style' ] ] );
			$this->add_render_attribute( 'inner-wrap', 'class', [ 'tilt-box-inner' ] );

			if ( '1' !== $litho_tilt_box_selection ) {
				$this->add_render_attribute( 'inner-wrap', 'class', [ 'd-flex', 'align-items-start', 'flex-column', 'justify-content-center' ] );
			}
			$this->add_render_attribute( 'letter-wrap', 'class', [ 'letter-wrap', 'letter-position-' . $litho_letter_position ] );

			$litho_tilt_box_image     = '';
			$litho_tilt_box_image_url = '';
			$litho_tilt_box_image_alt = '';

			if ( ! empty( $settings['litho_tilt_box_image']['id'] ) ) {

				$srcset_data              = litho_get_image_srcset_sizes( $settings['litho_tilt_box_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_tilt_box_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_tilt_box_image']['id'], 'litho_thumbnail', $settings );
				$litho_tilt_box_image_alt = Control_Media::get_image_alt( $settings['litho_tilt_box_image'] );
				$litho_tilt_box_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_tilt_box_image_url ), esc_attr( $litho_tilt_box_image_alt ), $srcset_data );

			} elseif ( ! empty( $settings['litho_tilt_box_image']['url'] ) ) {
				$litho_tilt_box_image_url = $settings['litho_tilt_box_image']['url'];
				$litho_tilt_box_image_alt = '';
				$litho_tilt_box_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_tilt_box_image_url ), esc_attr( $litho_tilt_box_image_alt ) );
			}

			if ( ! empty( $settings['litho_link']['url'] ) ) {
				$this->add_link_attributes( 'link', $settings['litho_link'] );
			}

			$litho_tilt_box_image_url = ( ! empty( $litho_tilt_box_image_url ) ) ? 'background-image: url(' . esc_url( $litho_tilt_box_image_url ) . ');' : '';
			$this->add_render_attribute( 'img_bg', [
				'style' => $litho_tilt_box_image_url
			] );

			$litho_tilt_box_overlap_title = str_replace( '||', '<br />', $litho_tilt_box_overlap_title );

			switch ( $settings['litho_tilt_box_style'] ) {
				case 'tilt-box-style-1':
				default:
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
					   <?php if ( ! empty( $litho_tilt_box_overlap_title ) ) { ?>
							<span class="text-overlap overlap-title"><?php echo sprintf( '%s', wp_kses_post( $litho_tilt_box_overlap_title ) ); ?></span>
						<?php } ?>
						<div class="tilt-box">
							<?php if ( ! empty( $litho_tilt_box_image ) ) { ?>
								<?php if ( ! empty( $litho_tilt_box_overlay ) ) { ?>
									<div class="tilt-box-overlay"></div>
								<?php } ?>
								<?php echo sprintf( '%s', $litho_tilt_box_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php } ?>
						</div>	
					</div>
					<?php
					break;
				case 'tilt-box-style-2':
					?>
					<div class="tilt-box-inner">
						<div class="tilt-box">
							<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
								<?php echo Icon_Group_Control::render_icon_content( $this ); ?>
								<?php if ( 'top' === $settings[ 'litho_tilt_box_title_position' ] ) { ?>
									<?php if ( ! empty( $litho_tilt_box_title ) ) { ?>
										<span class="title"><?php echo esc_html( $litho_tilt_box_title ); ?></span>
									<?php } ?>
									<span class="overlap-title" <?php $this->print_render_attribute_string( 'img_bg' ); ?>><?php echo sprintf( '%s', wp_kses_post( $litho_tilt_box_overlap_title ) ); ?></span>
								<?php } else { ?>
									<span class="overlap-title" <?php $this->print_render_attribute_string( 'img_bg' ); ?>><?php echo sprintf( '%s', wp_kses_post( $litho_tilt_box_overlap_title ) ); ?></span>
									<?php if ( ! empty( $litho_tilt_box_title ) ) { ?>
										<span class="title"><?php echo esc_html( $litho_tilt_box_title ); ?></span>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
					break;
				case 'tilt-box-style-3':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="tilt-box">
							<?php if ( 'above' === $litho_letter_position && ! empty( $litho_letter_text ) ) { ?>
								<div <?php $this->print_render_attribute_string( 'letter-wrap' ); ?>>
									<span class="digit h-1"><?php echo esc_html( $litho_letter_text ); ?></span>
									<div class="separator-line mx-auto"></div>
								</div>
							<?php } ?>
							<div <?php $this->print_render_attribute_string( 'inner-wrap' ); ?>>
								<?php
								if ( ! empty( $litho_tilt_box_image ) || ! empty( $litho_description_text ) ) {
									if ( '1' === $litho_tilt_box_selection ) {
										if ( ! empty( $litho_tilt_box_image ) ) {
											echo sprintf( '%s', $litho_tilt_box_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										}
									} else {
										if ( ! empty( $litho_description_text ) ) { ?>
											<div class="description-text"><?php echo sprintf( '%s', wp_kses_post( $litho_description_text ) ); ?></div>
											<?php if ( ! empty( $litho_author_text ) ) { ?>
												<span class="author-text"><?php echo esc_html( $litho_author_text ); ?></span>
											<?php } ?>
											<?php
										}
									}
								}
								?>
							</div>
							<?php if ( 'below' === $litho_letter_position && ! empty( $litho_letter_text ) ) { ?>
								<div <?php $this->print_render_attribute_string( 'letter-wrap' ); ?>>
									<div class="separator-line mx-auto"></div>
									<span class="h-1"><?php echo esc_html( $litho_letter_text ); ?></span>
								</div>
							<?php } ?>
						</div>	
					</div>
					<?php
					break;
				case 'tilt-box-style-4':
					$this->add_render_attribute( 'background_img', [
						'class' => [ 'tilt-box', 'cover-background' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div <?php $this->print_render_attribute_string( 'background_img' ); ?>>
							<span class="overlap-title cover-background" <?php $this->print_render_attribute_string( 'img_bg' );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped   ?>><?php echo sprintf( '%s', wp_kses_post( $litho_tilt_box_overlap_title ) ); ?></span>
						</div>
					</div>
					<?php
					break;
			}
		}
	}
}
