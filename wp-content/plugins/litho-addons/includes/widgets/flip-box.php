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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for flip box.
 *
 * @package Litho
 */

// If class `Flip_Box` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Flip_Box' ) ) {

	class Flip_Box extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve flip box widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-flip-box';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve flip box widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Flip Box', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve flip box widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-flip-box';
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
			return [ 'image', 'flip', 'box', 'fancy', 'transform' ];
		}

		/**
		 * Get button sizes.
		 *
		 * Retrieve an array of button sizes for the flip box widget.
		 *
		 *
		 * @access public
		 * @static
		 *
		 * @return array An array containing button sizes.
		 */
		public static function get_button_sizes() {
			return [
				'default' 	=> __( 'Default', 'litho-addons' ),
				'xs' 		=> __( 'Extra Small', 'litho-addons' ),
				'sm' 		=> __( 'Small', 'litho-addons' ),
				'md' 		=> __( 'Medium', 'litho-addons' ),
				'lg' 		=> __( 'Large', 'litho-addons' ),
				'xl' 		=> __( 'Extra Large', 'litho-addons' ),
			];
		}
		/**
		 * Register flip box widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			// START of FRONT SIDE section
			$this->start_controls_section(
				'litho_flip_box_front_content_section',
				[
					'label'	=> __( 'Front Side', 'litho-addons' ),
				]
			);

			$this->start_controls_tabs( 'litho_flip_box_front_side_content_tabs' );
				$this->start_controls_tab( 'litho_flip_box_front_side_content_tab', [ 'label' => __( 'Content', 'litho-addons' ) ] );
					$this->add_control(
						'litho_flip_box_front_side_content_title',
						[
							'label' 		=> __( 'Title', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'default' 		=> __( 'Add title here', 'litho-addons' ),
							'label_block' 	=> true,
							'separator' 	=> 'before',
						]
					);
					$this->add_control(
						'litho_flip_box_front_side_content_subtitle',
						[
							'label' 		=> __( 'Subtitle', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'default' 		=> __( 'Add subtitle here', 'litho-addons' ),
							'label_block' 	=> true,
						]
					);
					$this->add_control(
						'litho_flip_box_front_side_content_description_text',
						[
							'label' 		=> __( 'Description', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXTAREA,
							'dynamic' => [
							    'active' => true
							],
							'separator' 	=> 'none',
							'rows' 			=> 10,
							'show_label' 	=> false,
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_flip_box_front_side_background_tab', [ 'label' => __( 'Background', 'litho-addons' ) ] );
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 		=> 'litho_flip_box_front_side_background',
						'selector' => '{{WRAPPER}} .flip-front-side',
					]
				);
				$this->add_control(
					'litho_flip_box_front_side_background_overlay_heading_title',
					[
						'type' 		=> Controls_Manager::HEADING,
						'label' 	=> __( 'Overlay', 'litho-addons' ),
						'condition' => [
							'litho_flip_box_front_side_background_image[id]!' => '',
						],
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_flip_box_front_side_background_overlay',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .flip-front-side .flip-box-front-overlay',
						'fields_options' 	=> [
							'background' 	=> [
								'frontend_available' => true,
							],
						],
						'condition' => [
							'litho_flip_box_front_side_background_image[id]!' => '',
						]
					]
				);
				$this->end_controls_tab();

			$this->end_controls_tabs(); // End of front_content_tabs

			$this->end_controls_section(); 

			// End of FRONT SIDE section

			// START of BACK SIDE section
			$this->start_controls_section(
				'litho_flip_box_back_content_section',
				[
					'label'	=> __( 'Back Side', 'litho-addons' ),
				]
			);

			$this->start_controls_tabs( 'litho_flip_box_back_side_content_tabs' );
				$this->start_controls_tab( 'litho_flip_box_back_side_content_tab', [ 'label' => __( 'Content', 'litho-addons' ) ] );
					$this->add_control(
						'litho_flip_box_back_side_content_item_use_image',
						[
							'label' 		=> __( 'Select Icon Type', 'litho-addons' ),
							'type' 			=> Controls_Manager::CHOOSE,
							'label_block' 	=> false,
							'options' 		=> [
								'none' => [
									'title' 	=> __( 'None', 'litho-addons' ),
									'icon' 		=> 'eicon-ban',
								],
								'image' => [
									'title' 	=> __( 'Image', 'litho-addons' ),
									'icon' 		=> 'eicon-image',
								],
								'icon' => [
									'title' 	=> __( 'Icon', 'litho-addons' ),
									'icon' 		=> 'eicon-star',
								],
							],
							'default' => 'icon',
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_item_image',
						[
							'label' 	=> __( 'Choose Image', 'litho-addons' ),
							'type' 		=> Controls_Manager::MEDIA,
							'dynamic'	=> [
								'active' => true,
							],
							'default' 	=> [
								'url' 		=> Utils::get_placeholder_image_src(),
							],
							'condition' => [
								'litho_flip_box_back_side_content_item_use_image' => 'image',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Image_Size::get_type(),
						[
							'name' 		=> 'litho_flip_box_back_side_thumbnail',
							'default' 	=> 'full',
							'exclude'	=> [ 'custom' ],
							'condition' => [
								'litho_flip_box_back_side_content_item_use_image' => 'image',
							],
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_item_icon',
						[
							'label' 	=> __( 'Choose Icon', 'litho-addons' ),
							'type' 		=> Controls_Manager::ICONS,
							'fa4compatibility' => 'icon',
							'default' 	=> [
								'value' 	=> 'fas fa-star',
								'library' 	=> 'fa-solid',
							],
							'condition' => [
								'litho_flip_box_back_side_content_item_use_image' => 'icon',
							],
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_icon_view',
						[
							'label' 	=> __( 'View', 'litho-addons' ),
							'type' 		=> Controls_Manager::SELECT,
							'options' 	=> [
								'default' 	=> __( 'Default', 'litho-addons' ),
								'stacked' 	=> __( 'Stacked', 'litho-addons' ),
								'framed' 	=> __( 'Framed', 'litho-addons' ),
							],
							'default' 	=> 'default',
							'prefix_class' 	=> 'elementor-view-',
							'condition' => [
								'litho_flip_box_back_side_content_item_use_image' => 'icon',
							],
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_icon_shape',
						[
							'label' 	=> __( 'Shape', 'litho-addons' ),
							'type' 		=> Controls_Manager::SELECT,
							'options' 	=> [
								'circle' 	=> __( 'Circle', 'litho-addons' ),
								'square' 	=> __( 'Square', 'litho-addons' ),
							],
							'default' 	=> 'circle',
							'prefix_class' => 'elementor-shape-',
							'condition' => [
								'litho_flip_box_back_side_content_icon_view!' => 'default',
								'litho_flip_box_back_side_content_item_use_image' => 'icon',
							],
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_title',
						[
							'label' 		=> __( 'Title', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'default' 		=> __( 'Add title here', 'litho-addons' ),
							'label_block' 	=> true,
							'separator' 	=> 'before',
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_subtitle',
						[
							'label' 		=> __( 'Subtitle', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic' => [
							    'active' => true
							],
							'default' 		=> __( 'Add subtitle here', 'litho-addons' ),
							'label_block' 	=> true,
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_description_text',
						[
							'label' 		=> __( 'Description', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXTAREA,
							'dynamic' => [
							    'active' => true
							],
							'default' 		=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'litho-addons' ),
							'separator' 	=> 'none',
							'rows' 			=> 10,
							'show_label' 	=> false,
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_button_text',
						[
							'label' 		=> __( 'Text', 'litho-addons' ),
							'type' 			=> Controls_Manager::TEXT,
							'dynamic'		=> [
							    'active' => true
							],
							'default' 		=> __( 'Click here', 'litho-addons' ),
							'placeholder' 	=> __( 'Click here', 'litho-addons' ),
							'separator'		=> 'before'
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_button_link',
						[
							'label' 		=> __( 'Link', 'litho-addons' ),
							'type' 			=> Controls_Manager::URL,
							'dynamic'		=> [
								'active' => true,
							],
							'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
							'default' 		=> [
								'url' 		=> '#',
							],
						]
					);
					$this->add_control(
						'litho_flip_box_back_side_content_button_size',
						[
							'label' 			=> __( 'Size', 'litho-addons' ),
							'type' 				=> Controls_Manager::SELECT,
							'default' 			=> 'xs',
							'options' 			=> self::get_button_sizes(),
							'style_transfer' 	=> true,
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_flip_box_back_side_background_tab', [ 'label' => __( 'Background', 'litho-addons' ) ] );
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 		=> 'litho_flip_box_back_side_background',
						'selector' => '{{WRAPPER}} .flip-back-side',
					]
				);
				$this->add_control(
					'litho_flip_box_back_side_background_overlay_heading_title',
					[
						'type' 		=> Controls_Manager::HEADING,
						'label' 	=> __( 'Overlay', 'litho-addons' ),
						'condition' => [
							'litho_flip_box_back_side_background_image[id]!' => '',
						],
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_flip_box_back_side_background_overlay',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .flip-back-side .flip-box-back-overlay',
						'fields_options' 	=> [
							'background' 	=> [
								'frontend_available' => true,
							],
						],
						'condition' => [
							'litho_flip_box_back_side_background_image[id]!' => '',
						]
					]
				);
				$this->end_controls_tab();

			$this->end_controls_tabs();
			// End of back_content_tabs

			$this->end_controls_section();
			// End of BACK SIDE section
			
			// START of Settings section
			$this->start_controls_section(
				'litho_flip_box_settings_section',
				[
					'label' => __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_flip_box_effect',
				[
					'label' 	=> __( 'Flip Effect', 'litho-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'flip',
					'options' 	=> [
						'flip' 		=> __( 'Flip', 'litho-addons' ),
						'slide' 	=> __( 'Slide', 'litho-addons' ),
						'push' 		=> __( 'Push', 'litho-addons' ),
						'zoom-in' 	=> __( 'Zoom In', 'litho-addons' ),
						'zoom-out' 	=> __( 'Zoom Out', 'litho-addons' ),
						'fade' 		=> __( 'Fade', 'litho-addons' )
					],
					'prefix_class' => 'elementor-flip-box--effect-',
				]
			);
			$this->add_control(
				'litho_flip_box_direction',
				[
					'label' 	=> __( 'Flip Direction', 'litho-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'right',
					'options' 	=> [
						'left' 		=> __( 'Left', 'litho-addons' ),
						'right' 	=> __( 'Right', 'litho-addons' ),
						'up' 		=> __( 'Up', 'litho-addons' ),
						'down' 		=> __( 'Down', 'litho-addons' ),
					],
					'condition' => [
						'litho_flip_box_effect!' => [
							'fade',
							'zoom-in',
							'zoom-out',
						],
					],
					'prefix_class' => 'elementor-flip-box--direction-',
				]
			);
			$this->add_control(
				'litho_flip_box_3d',
				[
					'label' 		=> __( '3D Depth', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> __( 'On', 'litho-addons' ),
					'label_off' 	=> __( 'Off', 'litho-addons' ),
					'return_value' 	=> 'elementor-flip-box-3d',
					'default' 		=> '',
					'prefix_class' 	=> '',
					'condition' 	=> [
						'litho_flip_box_effect' => 'flip',
					],
				]
			);
			$this->end_controls_section();
			// End of Settings section

			// START of GENERAL Style section
			$this->start_controls_section(
				'litho_flip_box_general_style_section',
				[
					'label' => __( 'General', 'litho-addons' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_height',
				[
					'label' 	=> __( 'Height', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' => [
							'min' => 100,
							'max' => 1000,
						],
						'%' => [
							'min' => 1,
							'max' => 100,
						],
						'vh' => [
							'min' => 10,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'vh', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .flip-box-wrapper' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_flip_box_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'separator' => 'after',
					'selectors' => [
						'{{WRAPPER}} .flip-box' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->end_controls_section();
			// End of GENERAL section

			// START of FRONT SIDE Style section
			$this->start_controls_section(
				'litho_flip_box_front_side_style_section',
				[
					'label' => __( 'Front Side', 'litho-addons' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_front_side_content_alignment',
				[
					'label' 		=> __( 'Text Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
								'left' => [
									'title' 	=> __( 'Left', 'litho-addons' ),
									'icon' 		=> 'eicon-text-align-left',
								],
								'center' => [
									'title' 	=> __( 'Center', 'litho-addons' ),
									'icon' 		=> 'eicon-text-align-center',
								],
								'right' => [
									'title' 	=> __( 'Right', 'litho-addons' ),
									'icon' 		=> 'eicon-text-align-right',
								],
					],
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .flip-front-side .flip-box-front-overlay' => 'text-align: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_front_side_content_v_alignment',
				[
					'label'             => __( 'Vertical Alignment', 'litho-addons' ),
					'type'              => Controls_Manager::CHOOSE,
					'label_block'       => false,
					'default'           => '',
					'options'           => [
						'flex-start'      => [
							'title'     => __( 'Top', 'litho-addons' ),
							'icon'      => 'eicon-v-align-top',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-v-align-middle',
						],
						'flex-end'     => [
							'title'     => __( 'Bottom', 'litho-addons' ),
							'icon'      => 'eicon-v-align-bottom',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .flip-front-side .flip-box-front-overlay' => 'justify-content: {{VALUE}};',
					],
				]
			);
			// $this->add_responsive_control(
			// 	'litho_flip_box_front_side_content_h_alignment',
			// 	[
			// 		'label'             => __( 'Horizontal Alignment', 'litho-addons' ),
			// 		'type'              => Controls_Manager::CHOOSE,
			// 		'label_block'       => false,
			// 		'default'           => '',
			// 		'options'           => [
			// 			'flex-start'      => [
			// 				'title'     => __( 'Left', 'litho-addons' ),
			// 				'icon'      => 'eicon-h-align-left',
			// 			],
			// 			'center'    => [
			// 				'title'     => __( 'Center', 'litho-addons' ),
			// 				'icon'      => 'eicon-h-align-center',
			// 			],
			// 			'flex-end'     => [
			// 				'title'     => __( 'Right', 'litho-addons' ),
			// 				'icon'      => 'eicon-h-align-right',
			// 			],
			// 		],
			// 		'selectors'     => [
			// 			'{{WRAPPER}} .flip-front-side .flip-box-front-overlay' => 'align-items: {{VALUE}};',
			// 		],
			// 	]
			// );
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'litho_flip_box_front_side_border',
					'selector' 	=> '{{WRAPPER}} .flip-front-side',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_front_side_content_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .flip-front-side .flip-box-front-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_flip_box_front_side_box_shadow',
					'selector' 		=> '{{WRAPPER}} .flip-front-side',
					'condition' => [
						'litho_flip_box_effect' => [
							'flip'
						],
					],
				]
			);
			$this->add_control(
				'litho_flip_box_front_side_heading_title',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Title', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_flip_box_front_side_title_color',
				[
					'label' 	=> __( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flip-front-side .title' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_flip_box_front_side_title_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .flip-front-side .title',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_front_side_title_spacing',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-front-side .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_flip_box_front_side_heading_subtitle',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Subtitle', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_flip_box_front_side_subtitle_color',
				[
					'label' 	=> __( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flip-front-side .subtitle' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_flip_box_front_side_subtitle_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .flip-front-side .subtitle',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_front_side_subtitle_spacing',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-front-side .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_flip_box_front_side_heading_description',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Description', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_flip_box_front_side_description_color',
				[
					'label' 	=> __( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flip-front-side .description' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_flip_box_front_side_description_typography',
					'selector' 	=> '{{WRAPPER}} .flip-front-side .description',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_front_side_description_spacing',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
								'px' => [
									'min' => 0,
									'max' => 500,
								],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-front-side .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();
			// End of FRONT SIDE Style section

			// START of BACK SIDE Style section
			$this->start_controls_section(
				'litho_flip_box_back_side_style_section',
				[
					'label' => __( 'Back Side', 'litho-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_content_alignment',
				[
					'label' 		=> __( 'Text Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'label_block' 	=> false,
					'options' 		=> [
							'left' => [
								'title' 	=> __( 'Left', 'litho-addons' ),
								'icon' 		=> 'eicon-text-align-left',
							],
							'center' => [
								'title' 	=> __( 'Center', 'litho-addons' ),
								'icon' 		=> 'eicon-text-align-center',
							],
							'right' => [
								'title' 	=> __( 'Right', 'litho-addons' ),
								'icon' 		=> 'eicon-text-align-right',
							],
					],
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .flip-back-side .flip-box-back-overlay' => 'text-align: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'litho_flip_box_back_side_content_h_alignment',
				[
					'label'             => __( 'Horizontal Alignment', 'litho-addons' ),
					'type'              => Controls_Manager::CHOOSE,
					'label_block'       => false,
					'default'           => '',
					'options'           => [
						'flex-start'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-h-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-h-align-center',
						],
						'flex-end'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-h-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .flip-back-side .flip-box-back-overlay' => 'align-items: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'litho_flip_box_back_side_border',
					'selector' 	=> '{{WRAPPER}} .flip-back-side',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_content_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .flip-back-side .flip-box-back-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_flip_box_back_side_box_shadow',
					'selector' 		=> '{{WRAPPER}} .flip-back-side',
					'condition' => [
						'litho_flip_box_effect' => [
							'flip'
						],
					],
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_heading_icon',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Icon / Image', 'litho-addons' ),
					'separator' => 'before',
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image!' => 'none',
					],

				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_image_width',
				[
					'label' 	=> __( 'Size', 'litho-addons' ) . ' (%)',
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
							'unit'	=> '%',
							'size'	=> 15
					],
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 1,
								'max' => 500,
						],
						'%' => [
							'max' => 100,
							'min' => 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .elementor-icon img' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image' => 'image',
					],
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_image_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
							'px' => [
								'min' => 0,
								'max' => 200,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .elementor-icon img' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image' => 'image',
					],
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_image_spacing',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .elementor-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_icon_primary_color',
				[
					'label' 	=> __( 'Primary Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon'						=> 'background-color: {{VALUE}}',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon svg'					=> 'stroke: {{VALUE}}',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon svg, {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}}; border-color: {{VALUE}}',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image' => 'icon',
					],
				]
			);

			$this->add_control(
				'litho_flip_box_back_side_icon_secondary_color',
				[
					'label' 	=> __( 'Secondary Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image'	=> 'icon',
						'litho_flip_box_back_side_content_icon_view!'		=> 'default',
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon'			=> 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon svg'		=> 'stroke: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon'		=> 'color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon svg'	=> 'fill: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_icon_size',
				[
					'label' 	=> __( 'Icon Size', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
							'px' => [
								'min' => 6,
								'max' => 500,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' 		=> 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-icon svg' 	=> 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image' => 'icon',
					],
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_icon_padding',
				[
					'label' 	=> __( 'Icon Padding', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'default' 	=> [
							'unit' => 'em',
					],
					'range' 	=> [
						'em' => [
							'min' => 0,
							'max' => 5,
						],
						'px' => [
							'min' => 0,
							'max' => 300,
						],
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image' 	=> 'icon',
						'litho_flip_box_back_side_content_icon_view!' 		=> 'default',
					],
				]
			);

			$this->add_control(
				'litho_flip_box_back_side_icon_rotate',
				[
					'label' 	=> __( 'Icon Rotate', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size' => 0,
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon i'		=> 'transform: rotate({{SIZE}}{{UNIT}});',
						'{{WRAPPER}} .elementor-icon svg'	=> 'transform: rotate({{SIZE}}{{UNIT}});',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image' => 'icon',
					],
				]
			);

			$this->add_control(
				'litho_flip_box_back_side_icon_border_width',
				[
					'label' 	=> __( 'Border Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image'	=> 'icon',
						'litho_flip_box_back_side_content_icon_view'		=> 'framed',
					],
				]
			);

			$this->add_control(
				'litho_flip_box_back_side_icon_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::DIMENSIONS,
					'size_units'=> [ 'px', '%', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_flip_box_back_side_content_item_use_image'	=> 'icon',
						'litho_flip_box_back_side_content_icon_view!'		=> 'default',
					],
				]
			);	
			$this->add_control(
				'litho_flip_box_back_side_heading_title',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Title', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_title_color',
				[
					'label' 	=> __( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .title' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_flip_box_back_side_title_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .flip-back-side .title',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_title_spacing',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_heading_subtitle',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Subtitle', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_subtitle_color',
				[
					'label' 	=> __( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .subtitle' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_flip_box_back_side_subtitle_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .flip-back-side .subtitle',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_subtitle_spacing',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_heading_description',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Description', 'litho-addons' ),
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_description_color',
				[
					'label' 	=> __( 'Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .description' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_flip_box_back_side_description_typography',
					'selector' 	=> '{{WRAPPER}} .flip-back-side .description',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_description_spacing',
				[
					'label' 	=> __( 'Spacing', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
								'px' => [
									'min' => 0,
									'max' => 500,
								],
					],
					'selectors' => [
						'{{WRAPPER}} .flip-back-side .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_heading_button',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Button', 'litho-addons' ),
					'separator' => 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_flip_box_back_side_button_typography',
					'global'	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_flip_box_back_side_button_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
				]
			);
			$this->start_controls_tabs( 'litho_flip_box_back_side_tabs_button_style' );
			$this->start_controls_tab(
				'litho_flip_box_back_side_tab_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_button_text_color',
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
					'name' 				=> 'litho_flip_box_back_side_button_background_color',
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
				'litho_flip_box_back_side_button_border_radius',
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
				'litho_flip_box_back_side_tab_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_button_hover_color',
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
					'name' 				=> 'litho_flip_box_back_side_button_background_hover_color',
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
				'litho_flip_box_back_side_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'condition' 	=> [
						'litho_flip_box_back_side_button_border_border!' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_button_hover_border_radius',
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
				'litho_flip_box_back_side_button_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->add_control(
				'litho_flip_box_back_side_button_hover_transition',
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
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_flip_box_back_side_button_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_flip_box_back_side_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
				]
			);
			$this->add_responsive_control(
				'litho_flip_box_back_side_button_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);
			$this->end_controls_section();
			// End of BACK SIDE Style section
		}

		/**
		 * Render flip box widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings                       = $this->get_settings_for_display();
			$front_side_content_title 		= ( isset( $settings['litho_flip_box_front_side_content_title'] ) && $settings['litho_flip_box_front_side_content_title'] ) ? $settings['litho_flip_box_front_side_content_title'] : '';
			$front_side_content_subtitle 	= ( isset( $settings['litho_flip_box_front_side_content_subtitle'] ) && $settings['litho_flip_box_front_side_content_subtitle'] ) ? $settings['litho_flip_box_front_side_content_subtitle'] : '';
			$front_side_content_description = ( isset( $settings['litho_flip_box_front_side_content_description_text'] ) && $settings['litho_flip_box_front_side_content_description_text'] ) ? $settings['litho_flip_box_front_side_content_description_text'] : '';

			$back_side_content_title 		= ( isset( $settings['litho_flip_box_back_side_content_title'] ) && $settings['litho_flip_box_back_side_content_title'] ) ? $settings['litho_flip_box_back_side_content_title'] : '';
			$back_side_content_subtitle 	= ( isset( $settings['litho_flip_box_back_side_content_subtitle'] ) && $settings['litho_flip_box_back_side_content_subtitle'] ) ? $settings['litho_flip_box_back_side_content_subtitle'] : '';
			$back_side_content_description 	= ( isset( $settings['litho_flip_box_back_side_content_description_text'] ) && $settings['litho_flip_box_back_side_content_description_text'] ) ? $settings['litho_flip_box_back_side_content_description_text'] : '';

			$this->add_render_attribute( 'wrapper', 'class', [ 'flip-box-wrapper' ] );
			?>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore ?>>
				<div class="flip-box flip-front-side">
					<div class="flip-box-front-overlay">
						<div class="flip-box-inner">
							<?php
							if ( $front_side_content_title ) {
								?>
								<span class="title"><?php
									echo esc_html( $front_side_content_title );
								?></span>
							<?php
							}
							if ( $front_side_content_subtitle ) {
								?>
								<span class="subtitle"><?php
									echo esc_html( $front_side_content_subtitle );
								?></span>
							<?php
							}
							if ( $front_side_content_description ) {
								?>
								<div class="description"><?php
									echo sprintf( '%s', wp_kses_post( $front_side_content_description ) );
								?></div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="flip-box flip-back-side">
					<div class="flip-box-back-overlay">
						<div class="flip-box-inner">
							<?php $this->litho_get_back_side_icon(); // phpcs:ignore ?>
							<?php
							if ( $back_side_content_title ) {
								?>
								<span class="title"><?php
									echo esc_html( $back_side_content_title );
								?></span>
							<?php
							}
							if ( $back_side_content_subtitle ) {
								?>
								<span class="subtitle"><?php
									echo esc_html( $back_side_content_subtitle );
								?></span>
							<?php
							}
							if ( $back_side_content_description ) {
								?>
								<div class="description"><?php
									echo sprintf( '%s', wp_kses_post( $back_side_content_description ) );
								?></div>
							<?php
							}
							?>
							<?php $this->litho_get_button(); // phpcs:ignore ?>
						</div>
					</div>
				</div>
			</div>
		<?php
		}

		/**
		 * Retrieve the button.
		 *
		 * @access public
		 *
		 */
		public function litho_get_button() {

			$settings = $this->get_settings_for_display();

			$button_text = ( isset( $settings['litho_flip_box_back_side_content_button_text'] ) && $settings['litho_flip_box_back_side_content_button_text'] ) ? $settings['litho_flip_box_back_side_content_button_text'] : '';

			$this->add_render_attribute( [
				'btn_wrapper' => [ 'class' => [
					'elementor-button-wrapper',
					'litho-button-wrapper',
				]]
			] );

			if ( ! empty( $settings['litho_flip_box_back_side_content_button_link']['url'] ) ) {
				$this->add_link_attributes( 'link', $settings['litho_flip_box_back_side_content_button_link'] );
				$this->add_render_attribute( 'link', 'class', 'elementor-button-link' );

			}

			/* Custom button hover effect */
			$hover_animation_effect_array = litho_custom_hover_animation_effect();
			
			if ( ! empty( $this->get_settings( 'litho_flip_box_back_side_button_hover_animation' ) ) ) {
				$custom_animation_class = '';
				$this->add_render_attribute( 'link', 'class', [ 'hvr-' . $this->get_settings( 'litho_flip_box_back_side_button_hover_animation' ) ] );
				if ( in_array( $this->get_settings( 'litho_flip_box_back_side_button_hover_animation' ), $hover_animation_effect_array ) ) {
					$custom_animation_class = 'btn-custom-effect';
				}
				$this->add_render_attribute( 'link', 'class', [ $custom_animation_class ] );
			}

			$this->add_render_attribute( 'link', 'class', 'elementor-button' );
			$this->add_render_attribute( 'link', 'role', 'button' );

			if ( ! empty( $settings['litho_flip_box_back_side_content_button_size'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'elementor-size-' . $settings['litho_flip_box_back_side_content_button_size'] );
			}
			if ( ! empty( $button_text ) ) {
				ob_start();
				?>
				<div <?php $this->print_render_attribute_string( 'btn_wrapper' ); // phpcs:ignore ?>>
					<a <?php $this->print_render_attribute_string( 'link' ); // phpcs:ignore ?>><?php
						echo esc_html( $button_text );
					?></a>
				</div>
				<?php
				$output = ob_get_contents();
				ob_get_clean();
				echo sprintf( '%s', $output ); // phpcs:ignore
			}
		}

		/**
		 * Retrieve the icon
		 *
		 * @access public
		 *
		 */
		public function litho_get_back_side_icon() {

			$icon = '';

			$settings = $this->get_settings_for_display();

			$migrated 	= isset( $settings['__fa4_migrated']['litho_flip_box_back_side_content_item_icon'] );
			$is_new 	= empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_flip_box_back_side_content_item_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_flip_box_back_side_content_item_icon']['value'] ) && ! empty( $settings['litho_flip_box_back_side_content_item_icon']['value'] ) ) {
				$icon .= '<i class="' . esc_attr( $settings['litho_flip_box_back_side_content_item_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			if ( ! empty( $settings['litho_flip_box_back_side_content_item_image']['id'] ) ) {
				$srcset_data 										= litho_get_image_srcset_sizes( $settings['litho_flip_box_back_side_content_item_image']['id'], $settings['litho_flip_box_back_side_thumbnail_size'] );
				$litho_flip_box_back_side_content_item_image_url 	= Group_Control_Image_Size::get_attachment_image_src( $settings['litho_flip_box_back_side_content_item_image']['id'], 'litho_flip_box_back_side_thumbnail', $settings );
				$litho_flip_box_back_side_content_item_image_alt 	= Control_Media::get_image_alt( $settings['litho_flip_box_back_side_content_item_image'] );
				$litho_flip_box_back_side_content_item_image 		= sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_flip_box_back_side_content_item_image_url ), esc_attr( $litho_flip_box_back_side_content_item_image_alt ), $srcset_data ); // phpcs:ignore
			} elseif ( ! empty( $settings['litho_flip_box_back_side_content_item_image']['url'] ) ) {
				$litho_flip_box_back_side_content_item_image_url 	= $settings['litho_flip_box_back_side_content_item_image']['url'];
				$litho_flip_box_back_side_content_item_image_alt 	= '';
				$litho_flip_box_back_side_content_item_image 		= sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_flip_box_back_side_content_item_image_url ), esc_attr( $litho_flip_box_back_side_content_item_image_alt ) );
			}

			if ( 'none' != $settings['litho_flip_box_back_side_content_item_use_image'] ) {
			 	if ( ! empty( $litho_flip_box_back_side_content_item_image ) || ! empty( $icon ) ) {
				?>
				<div class="elementor-icon"><?php
					echo ( 'image' === $settings['litho_flip_box_back_side_content_item_use_image'] ) ? $litho_flip_box_back_side_content_item_image : $icon; // phpcs:ignore
				?></div>
				<?php 
				}
			} 
		}
	}
}
