<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for team member.
 *
 * @package Litho
 */

// If class `Team_Member` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Team_Member' ) ) {

	class Team_Member extends Widget_Base {

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
			return 'litho-team-member';
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
			return __( 'Litho Team Member', 'litho-addons' );
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
			return 'eicon-person';
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
		 * Register team member widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */

		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_team_member_section_content',
				[
					'label'     => __( 'Content', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_team_member_style',
				[
					'label'     => __( 'Select style', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'team-style-1',
					'options'   => [
						'team-style-1'   => __( 'Style 1', 'litho-addons' ),
						'team-style-2'   => __( 'Style 2', 'litho-addons' ),
						'team-style-3'   => __( 'Style 3', 'litho-addons' ),
						'team-style-4'   => __( 'Style 4', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->start_controls_tabs( 'litho_team_member_tabs' );
				$this->start_controls_tab( 'litho_team_member_general_tab', [ 'label' => __( 'General', 'litho-addons' ) ] );
				$this->add_control(
					'litho_team_member_image',
					[
						'label'		=> __( 'Image', 'litho-addons' ),
						'type'		=> Controls_Manager::MEDIA,
						'dynamic'	=> [
							'active' => true,
						],
						'default'   => [
							'url'       => Utils::get_placeholder_image_src(),
						],
					]
				);
				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name'      => 'litho_thumbnail',
						'default'   => 'full',
						'exclude'   => [ 'custom' ],
						'separator' => 'none',
					]
				);
				$this->add_control(
					'litho_team_member_full_name',
					[               
						'label'     => __( 'Name', 'litho-addons' ),
						'type'      => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'   => __( 'Patrick Smith', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_team_member_position',
					[
						'label'     => __( 'Designation', 'litho-addons' ),
						'type'      => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'   => __( 'Executive Chef', 'litho-addons' ),
					]
				);
				$this->add_control(
					'litho_team_member_description',
					[
						'label'     => __( 'Description', 'litho-addons' ),
						'type'      => Controls_Manager::TEXTAREA,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'condition'		=> [
							'litho_team_member_style' => [ 'team-style-1', 'team-style-2' ], // IN
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_team_member_social_tab', [ 'label' => __( 'Social', 'litho-addons' ) ] );
				$repeater = new Repeater();
				$repeater->add_control(
					'litho_team_member_social_icon',
					[
						'label'             => __( 'Icon', 'litho-addons' ),
						'type'              => Controls_Manager::ICONS,
						'fa4compatibility'  => 'icon',
						'default' 		=> [
							'value'     => 'fab fa-facebook-f',
							'library'   => 'fa-brands'
						],
					]
				);
				$repeater->add_control(
					'litho_team_member_social_label',
					[
						'label'             => __( 'Label', 'litho-addons' ),
						'type'              => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'           => __( 'Label', 'litho-addons' ),
					]
				);
				$repeater->add_control(
					'litho_team_member_social_link',
					[
						'label'             => __( 'Link', 'litho-addons' ),
						'type'              => Controls_Manager::URL,
						'dynamic'       	=> [
							'active' => true,
						],
						'label_block'       => true,
						'default' 			=> [
							'url'	=> '#',
						],
						'placeholder'       => __( 'https://your-link.com', 'litho-addons' ),
					]
				);
				$repeater->add_control(
					'litho_team_member_label_visible',
					[
						'label'         => __( 'Label visible', 'litho-addons' ),
						'type'          => Controls_Manager::SWITCHER,
						'label_on'      => __( 'Yes', 'litho-addons' ),
						'label_off'     => __( 'No', 'litho-addons' ),
						'return_value'  => 'yes',
						'default'       => '',
					]
				);
				$this->add_control(
					'litho_team_member_social_icon_items',
					[
						'label'         => __( 'Social Icon', 'litho-addons' ),
						'type'          => Controls_Manager::REPEATER,
						'fields'        => $repeater->get_controls(),
						'show_label'	=> false,
						'default'       => [
							[
								'litho_team_member_social_icon'   => [
									'value'     => 'fab fa-facebook-f',
									'library'   => 'fa-brands'
								],
								'litho_team_member_social_label'  => __( 'Facebook', 'litho-addons' ),
								'litho_team_member_social_link'   => [
									'default' 		=> [
										'url' 		=> '#',
									],
								],
								'litho_team_member_label_visible' => 'false',
							],
							[   
								'litho_team_member_social_icon'   => [
									'value'     => 'fab fa-instagram',
									'library'   => 'fa-brands'
								],
								'litho_team_member_social_label'  => __( 'Instagram', 'litho-addons' ),
								'litho_team_member_social_link'   => [
									'default' 		=> [
										'url' 		=> '#',
									],
								],
								'litho_team_member_label_visible' => 'false',
							],
							[
								'litho_team_member_social_icon'   => [
									'value'     => 'fab fa-x-twitter',
									'library'   => 'fa-brands'
								],   
								'litho_team_member_social_label'  => __( 'Twitter', 'litho-addons' ),
								'litho_team_member_social_link'   => [
									'default' 		=> [
										'url' 		=> '#',
									],
								],
								'litho_team_member_label_visible' => 'false',
							],
						],
						'title_field'   => '{{{ litho_team_member_social_label }}}',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();      

			$this->start_controls_section(
				'litho_section_team_member_general_style',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_team_member_image_stretch',
				[
					'label'         => __( 'Image Stretch', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
				]
			);
			$this->add_responsive_control(
				'litho_team_member_vertical_position',
				[
					'label'         => __( 'Vertical Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'center',
					'options'       => [
						'flex-start'    => [
							'title'         => __( 'Top', 'litho-addons' ),
							'icon'          => 'eicon-v-align-top',
						],
						'center'        => [
							'title'         => __( 'Middle', 'litho-addons' ),
							'icon'          => 'eicon-v-align-middle',
						],
						'flex-end'      => [
							'title'         => __( 'Bottom', 'litho-addons' ),
							'icon'          => 'eicon-v-align-bottom',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .team-member-details' => 'display: flex; justify-content: {{VALUE}};',
					],
					'condition'		=> [
						'litho_team_member_style!' => [ 'team-style-1', 'team-style-3' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_horizontal_position',
				[
					'label'         => __( 'Horizontal Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'center',
					'options'       => [
						'flex-start'    => [
							'title'         => __( 'Left', 'litho-addons' ),
							'icon'          => 'eicon-h-align-left',
						],
						'center'        => [
							'title'         => __( 'Center', 'litho-addons' ),
							'icon'          => 'eicon-h-align-center',
						],
						'flex-end'      => [
							'title'         => __( 'Right', 'litho-addons' ),
							'icon'          => 'eicon-h-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .team-member-details' => 'display: flex; align-items: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_team_member_image_box_shadow',
					'exclude'       => [
						'box_shadow_position',
					],
					'selector'      => '{{WRAPPER}} .team-member',
				]
			);
			$this->add_control(
				'litho_team_member_image_box_heading_title',
				[
					'label'         => __( 'Image Box', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_team_member_image_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member .team-member-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_image_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member .team-member-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'litho_team_member_image_figcaption_heading_title',
				[
					'label'         => __( 'Content Box', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
					'condition'     => [ 'litho_team_member_style!' => [ 'team-style-4' ] ],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_team_member_image_figcaption_background',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} figcaption',
					'condition'     => [ 'litho_team_member_style' => [ 'team-style-2', 'team-style-3' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_team_member_image_figcaption_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member figcaption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_team_member_style!' => [ 'team-style-4' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_image_figcaption_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member figcaption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_team_member_style!' => [ 'team-style-4' ] ],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_team_member_image_style',
				[
					'label'         => __( 'Image', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_team_member_custom_image_size',
				[
					'label'         => __( 'Custom size', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
				]
			);
			$this->add_responsive_control(
				'litho_team_member_image_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'em', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 50, 'max' => 800 ], '%'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-image'     => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_team_member_custom_image_size' => 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_image_height',
				[
					'label'         => __( 'Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'em', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 50, 'max' => 800 ], '%'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-image'     => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_team_member_custom_image_size' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_team_member_image_border',
					'selector'      => '{{WRAPPER}} .team-member-image',
				]
			);
			$this->add_responsive_control(
				'litho_team_member_image_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_team_member_name_style',
				[
					'label'         => __( 'Name', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_team_member_name_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .team-member-name' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_team_member_name_typography',
					'global'	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .team-member-name',
				]
			);
			$this->add_responsive_control(
				'litho_team_member_name_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_name_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_team_member_designation_style',
				[
					'label'         => __( 'Designation', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_team_member_designation_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .team-member-designation' => 'color: {{VALUE}};',
					] 
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_team_member_designation_typography',
					'global' 	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .team-member-designation',
				]
			);
			$this->add_responsive_control(
				'litho_team_member_designation_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_designation_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_team_member_description_style',
				[
					'label'         => __( 'Description', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'		=> [
						'litho_team_member_style' => [ 'team-style-1', 'team-style-2' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_team_member_description_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .team-member-description' => 'color: {{VALUE}};',
					] 
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_team_member_description_typography',
					'selector'  => '{{WRAPPER}} .team-member-description',
				]
			);

	        $this->add_responsive_control(
	            'litho_team_member_description_width',
	            [
	                'label'         => __( 'Width', 'litho-addons' ),
	                'type'          => Controls_Manager::SLIDER,
	                /*'default'       => [ 'size' => '10', 'unit' => '%'],*/
	                'range'         => [
	                    '%'    => [
	                        'min'   => 1,
	                        'max'   => 100,
	                    ],
	                    'px'    => [
	                        'min'   => 1,
	                        'max'   => 100,
	                    ],
	                ],
	                'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-description' => 'width: {{SIZE}}{{UNIT}};',
					],
	            ]
	        );
			$this->add_responsive_control(
				'litho_team_member_description_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_team_member_description_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_team_member_social_style',
				[
					'label'         => __( 'Social', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_section_team_member_social_position',
				[
					'label'         => __( 'Position', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'top',
					'options'       => [
						'top'    => [
							'title'         => __( 'Top', 'litho-addons' ),
							'icon'          => 'eicon-v-align-top',
						],
						'bottom'      => [
							'title'         => __( 'Bottom', 'litho-addons' ),
							'icon'          => 'eicon-v-align-bottom',
						],
					],
					'condition'     => [ 'litho_team_member_style' => [ 'team-style-1' ] ],
				]
			);
			$this->add_control(
				'litho_team_member_social_items_spacing',
				[
					'label'         => __( 'Items Spacing', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px' ],
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ], 
					'default'       => [ 'unit' => 'px', 'size' => 15 ],
					'selectors'     => [
						'{{WRAPPER}} .team-member-details .social-icon a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_team_member_social_items_bottom',
				[
					'label'         => __( 'Items Bottom Spacing', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 10, 'max' => 160 ] ], 
					'default'       => [ 'unit' => 'px', 'size' => 30 ],
					'selectors'     => [
						'{{WRAPPER}} .social-icon' => 'bottom: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 'litho_team_member_style!' => 'team-style-3' ], // NOT IN
				]
			);
			$this->add_control(
				'litho_team_member_social_icon_heading',
				[
					'label'         => __( 'Icon', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->start_controls_tabs( 'litho_team_member_social_icon_tabs' );
				$this->start_controls_tab( 'litho_team_member_social_icon_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_team_member_social_icon_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a > i'   => 'color: {{VALUE}};',
								'{{WRAPPER}} .social-icon > a > svg' => 'fill: {{VALUE}};',
							]
						]
					);
					$this->add_control(
						'litho_team_member_social_icon_label_color',
						[
							'label'         => __( 'Label Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a > .team-member-socials-label' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_control(
						'litho_team_member_social_icon_bg_color',
						[
							'label'         => __( 'Background Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a' => 'background-color: {{VALUE}};',
							]
						]
					);
					$this->add_responsive_control(
						'litho_team_member_social_icon_font_size',
						[
							'label'         => __( 'Icon Font Size', 'litho-addons' ),
							'type'          => Controls_Manager::SLIDER,
							'size_units'    => [ 'px', 'em', 'rem', 'custom' ],
							'range'         => [ 'px'   => [ 'min' => 10, 'max' => 200 ] ], 
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a > i'   => 'font-size: {{SIZE}}{{UNIT}}',
								'{{WRAPPER}} .social-icon > a > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_team_member_social_icon_border',
							'selector'      => '{{WRAPPER}} .social-icon > a',
						]
					);
					$this->add_control(
						'litho_team_member_social_icon_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_team_member_social_icon_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_team_member_social_icon_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a:hover i'   => 'color: {{VALUE}};',
								'{{WRAPPER}} .social-icon > a:hover svg' => 'fill: {{VALUE}};',
							]
						]
					);
					$this->add_control(
						'litho_team_member_social_icon_label_hover_color',
						[
							'label'         => __( 'Label Hover Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a:hover .team-member-socials-label' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_control(
						'litho_team_member_social_icon_hover_bg_color',
						[
							'label'         => __( 'Background Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a:hover' => 'background-color: {{VALUE}};',
							]
						]
					);
					$this->add_control(
						'litho_team_member_social_icon_hover_animation',
						[
							'label'         => __( 'Hover Animation', 'litho-addons' ),
							'type'          => Controls_Manager::HOVER_ANIMATION,
						]
					);
					$this->add_control(
						'litho_team_member_social_icon_hover_transition',
						[
							'label'         => __( 'Transition Duration', 'litho-addons' ),
							'type'          => Controls_Manager::SLIDER,
							'default'       => [
								'size'          => 0.3,
							],
							'range'         => [
								'px'        => [
									'max'       => 3,
									'step'      => 0.1,
								],
							],
							'render_type'   => 'ui',
							'selectors'     => [
								'{{WRAPPER}} .social-icon > a:hover' => 'transition: all {{SIZE}}s; -webkit-transition: all {{SIZE}}s;',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_team_member_social_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .social-icon > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_team_member_social_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .social-icon > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_team_member_overlay_style',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'		=> [
						'litho_team_member_style!' => [ 'team-style-3' ], //NOT IN
					],
				]
			);
			$this->add_control(
				'litho_team_member_background_overlay',
				[
					'label'         => __( 'Background Overlay', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_team_member_background_overlay_color',
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
					'selector'          => '{{WRAPPER}} .team-member-overlay',
					'condition'         => [
							'litho_team_member_background_overlay' => 'yes',
					],
				]
			);
			
			$this->end_controls_section();
		}
		/**
		 * Render team member widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$litho_team_member_image                   = '';
			$settings                                  = $this->get_settings_for_display();
			$team_member_style                         = ( isset( $settings['litho_team_member_style'] ) && $settings['litho_team_member_style'] ) ? $settings['litho_team_member_style'] : 'team-style-1';
			$team_member_full_name                     = ( isset( $settings['litho_team_member_full_name'] ) && $settings['litho_team_member_full_name'] ) ? $settings['litho_team_member_full_name'] : '';
			$team_member_position                      = ( isset( $settings['litho_team_member_position'] ) && $settings['litho_team_member_position'] ) ? $settings['litho_team_member_position'] : '';
			$team_member_description                   = ( isset( $settings['litho_team_member_description'] ) && $settings['litho_team_member_description'] ) ? $settings['litho_team_member_description'] : '';
			$social_icon_items                         = ( isset( $settings['litho_team_member_social_icon_items'] ) && $settings['litho_team_member_social_icon_items'] ) ? $settings['litho_team_member_social_icon_items'] : '';
			$litho_section_team_member_social_position = ( isset( $settings['litho_section_team_member_social_position'] ) && $settings['litho_section_team_member_social_position'] ) ? $settings['litho_section_team_member_social_position'] : '';
			$image_bg_overlay                          = ( isset( $settings['litho_team_member_background_overlay'] ) && $settings['litho_team_member_background_overlay'] ) ? $settings['litho_team_member_background_overlay'] : '';
			$migrated                                  = isset( $settings['__fa4_migrated']['litho_team_member_social_icon'] );
			$is_new                                    = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( ! empty( $settings['litho_team_member_image']['id'] ) ) {
				$srcset_data                 = litho_get_image_srcset_sizes( $settings['litho_team_member_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_team_member_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_team_member_image']['id'], 'litho_thumbnail', $settings );
				$litho_team_member_image_alt = Control_Media::get_image_alt( $settings['litho_team_member_image'] );
				$litho_team_member_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', $litho_team_member_image_url, $litho_team_member_image_alt, $srcset_data );

			} elseif ( ! empty( $settings['litho_team_member_image']['url'] ) ) {
				$litho_team_member_image_url = $settings['litho_team_member_image']['url'];
				$litho_team_member_image_alt = '';
				$litho_team_member_image     = sprintf( '<img src="%1$s" alt="%2$s" />', $litho_team_member_image_url, $litho_team_member_image_alt );
			}

			$this->add_render_attribute( 'wrapper', 'class', ['team-member', $team_member_style ] );
			$this->add_render_attribute( 'inner_wrapper', 'class', ['team-member-image' ] );
			$this->add_render_attribute( 'inner_wrapper_details', 'class', [ 'team-member-details', 'd-flex', 'flex-column' ] ); 

			if ( 'yes' === $this->get_settings( 'litho_team_member_image_stretch' ) ) {
				$this->add_render_attribute( 'inner_wrapper', 'class', 'image-stretch' );
			}
			
			$social_icon_hover_animation = ' litho-no-animation';
			if ( $this->get_settings( 'litho_team_member_social_icon_hover_animation' ) ) {
				$social_icon_hover_animation = ' hvr-' . $this->get_settings( 'litho_team_member_social_icon_hover_animation' );
			}

			switch ( $team_member_style ) {
				case 'team-style-1':
					if ( 'yes' === $image_bg_overlay ) {
						$this->add_render_attribute( 'inner_wrapper_details', 'class', [ 'team-member-overlay' ] );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<figure>
							<div <?php $this->print_render_attribute_string( 'inner_wrapper' ); ?>>
								<?php if ( ! empty( $litho_team_member_image ) ) {
									echo sprintf( '%s', $litho_team_member_image ); // phpcs:ignore
								} ?>
							</div>
							<figcaption <?php $this->print_render_attribute_string( 'inner_wrapper_details' ); ?>>
								<?php if ( is_array( $social_icon_items ) && ! empty( $social_icon_items ) && 'top' === $litho_section_team_member_social_position ) { ?>
									<div class="social-icon">
										<?php foreach ( $social_icon_items as $key => $icon_data ) {
											$link_key = 'link_' . $key;
											if ( ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) {
												$this->add_link_attributes( $link_key, $icon_data['litho_team_member_social_link'] );
											}
											if ( ! empty( $icon_data[ 'litho_team_member_social_icon' ] ) && ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) { ?>
												<a <?php $this->print_render_attribute_string( $link_key ); ?>>
													<?php if ( $is_new || $migrated ) {
														Icons_Manager::render_icon( $icon_data['litho_team_member_social_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
													} elseif ( isset( $settings['litho_team_member_social_icon']['value'] ) && ! empty( $settings['litho_team_member_social_icon']['value'] ) ) { ?> 
														<i class="<?php echo esc_attr( $icon_data['litho_team_member_social_icon']['value'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
													<?php } ?>
													<?php if ( filter_var( $icon_data['litho_team_member_label_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
														echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $icon_data[ 'litho_team_member_social_label' ] ) );
													} ?>
												</a>
											<?php } ?>
										<?php } ?>
									</div>
								<?php } ?>
								<?php if ( ! empty( $team_member_description ) ) { ?>
									<div class="team-member-description"><?php
										echo sprintf( '%s', wp_kses_post( $team_member_description ) );
									?></div>
								<?php } ?>
								<?php if ( ! empty( $team_member_full_name ) ) { ?>
									<div class="team-member-name"><?php
										echo esc_html( $team_member_full_name );
									?></div>
								<?php } ?>
								<?php if ( ! empty( $team_member_position ) ) { ?>
									<div class="team-member-designation"><span><?php
										echo esc_html( $team_member_position );
									?></span></div>
								<?php } ?>
								<?php if ( is_array( $social_icon_items ) && ! empty( $social_icon_items ) && 'bottom' === $litho_section_team_member_social_position ) { ?>
									<div class="social-icon social-icon-bottom">
										<?php foreach ( $social_icon_items as $key => $icon_data ) {
											$link_key = 'link_' . $key;
											if ( ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) {
												$this->add_link_attributes( $link_key, $icon_data['litho_team_member_social_link'] );
											}
											if ( ! empty( $icon_data[ 'litho_team_member_social_icon' ] ) && ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) { ?>
												<a <?php $this->print_render_attribute_string( $link_key ); ?>>
													<?php if ( $is_new || $migrated ) {
														Icons_Manager::render_icon( $icon_data['litho_team_member_social_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
													} elseif ( isset( $settings['litho_team_member_social_icon']['value'] ) && ! empty( $settings['litho_team_member_social_icon']['value'] ) ) { ?> 
														<i class="<?php echo esc_attr( $icon_data['litho_team_member_social_icon']['value'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
													<?php } ?>
													<?php if ( filter_var( $icon_data['litho_team_member_label_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
														echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $icon_data[ 'litho_team_member_social_label' ] ) );
													} ?>
												</a>
											<?php } ?>
										<?php } ?>
									</div>
								<?php } ?>
							</figcaption>
						</figure>
					</div>
					<?php
					break;
				case 'team-style-2':
					if ( 'yes' === $image_bg_overlay ) {
						$this->add_render_attribute( 'inner_wrapper_details', 'class', [ 'team-member-overlay' ] );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<figure>
							<div <?php $this->print_render_attribute_string( 'inner_wrapper' ); ?>>
								<?php if ( ! empty( $litho_team_member_image ) ) {
									echo sprintf( '%s', $litho_team_member_image );
								} ?>
								<?php if ( 'yes' === $image_bg_overlay ) { ?>
									<div <?php $this->print_render_attribute_string( 'inner_wrapper_details' ); ?>>
										<?php if ( ! empty( $team_member_description ) ) { ?>
											<div class="team-member-description"><?php
												echo sprintf( '%s', wp_kses_post( $team_member_description ) );
											?></div>
										<?php } ?>
										<?php if ( is_array( $social_icon_items ) && ! empty( $social_icon_items ) ) { ?>
											<div class="social-icon position-absolute">
												<?php foreach ( $social_icon_items as $key => $icon_data ) {
													$link_key = 'link_' . $key;
													if ( ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) {
														$this->add_link_attributes( $link_key, $icon_data['litho_team_member_social_link'] );
													}
													if ( ! empty( $icon_data[ 'litho_team_member_social_icon' ] ) && ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) { ?>
														<a <?php $this->print_render_attribute_string( $link_key ); ?>>
															<?php if ( $is_new || $migrated ) {
																Icons_Manager::render_icon( $icon_data['litho_team_member_social_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_team_member_social_icon']['value'] ) && ! empty( $settings['litho_team_member_social_icon']['value'] ) ) { ?> 
																<i class="<?php echo esc_attr( $icon_data['litho_team_member_social_icon']['value'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
															<?php } ?>
															<?php if ( filter_var( $icon_data['litho_team_member_label_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
																echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $icon_data[ 'litho_team_member_social_label' ] ) );
															} ?>
														</a>
												   <?php } ?>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
							<?php if ( ! empty( $team_member_full_name ) || ! empty( $team_member_position ) ) { ?>
								<figcaption class="text-center">
									<?php if ( ! empty( $team_member_full_name ) ) { ?>
										<div class="team-member-name"><?php
											echo esc_html( $team_member_full_name );
										?></div>
									<?php } ?>
									<?php if ( ! empty( $team_member_position ) ) { ?>
										<div class="team-member-designation"><span><?php
											echo esc_html( $team_member_position );
										?></span></div>
									<?php } ?>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'team-style-3':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<figure>
							<div <?php $this->print_render_attribute_string( 'inner_wrapper' ); ?>>
								<?php if ( ! empty( $litho_team_member_image ) ) {
									echo sprintf( '%s', $litho_team_member_image );
								} ?>
							</div>
							<?php if ( ! empty( $team_member_full_name ) || ! empty( $team_member_position ) ) { ?>
								<figcaption <?php $this->print_render_attribute_string( 'inner_wrapper_details' ); ?>>
									<?php if ( ! empty( $team_member_full_name ) ) { ?>
										<div class="team-member-name"><?php
											echo esc_html( $team_member_full_name );
										?></div>
									<?php } ?>
									<?php if ( ! empty( $team_member_position ) ) { ?>
										<div class="team-member-designation"><span><?php
											echo esc_html( $team_member_position );
										?></span></div>
									<?php } ?>
									<?php if ( is_array( $social_icon_items ) && ! empty( $social_icon_items ) ) { ?>
									<div class="social-icon">
										<?php foreach ( $social_icon_items as $key => $icon_data ) {
											$link_key = 'link_' . $key;
											if ( ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) {
												$this->add_link_attributes( $link_key, $icon_data['litho_team_member_social_link'] );
											}
											if ( ! empty( $icon_data[ 'litho_team_member_social_icon' ] ) && ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) { ?>
												<a <?php $this->print_render_attribute_string( $link_key ); ?>>
													<?php if ( $is_new || $migrated ) {
														Icons_Manager::render_icon( $icon_data['litho_team_member_social_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
													} elseif ( isset( $settings['litho_team_member_social_icon']['value'] ) && ! empty( $settings['litho_team_member_social_icon']['value'] ) ) { ?> 
														<i class="<?php echo esc_attr( $icon_data['litho_team_member_social_icon']['value'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
													<?php } ?>
													<?php if ( filter_var( $icon_data['litho_team_member_label_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
														echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $icon_data[ 'litho_team_member_social_label' ] ) );
													} ?>
												</a>
											<?php } ?>
										<?php } ?>
									</div>
								<?php } ?>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'team-style-4':
					if ( 'yes' === $image_bg_overlay ) {
						$this->add_render_attribute( 'inner_wrapper_details', 'class', [ 'team-member-overlay' ] );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div <?php $this->print_render_attribute_string( 'inner_wrapper' ); ?>>
							<?php if ( ! empty( $litho_team_member_image ) ) {
								echo sprintf( '%s', $litho_team_member_image );
							} ?>
							<div <?php $this->print_render_attribute_string( 'inner_wrapper_details' ); ?>>
								<?php if ( ! empty( $team_member_full_name ) ) { ?>
									<div class="team-member-name"><?php
										echo esc_html( $team_member_full_name );
									?></div>
								<?php } ?>
								<?php if ( ! empty( $team_member_position ) ) { ?>
									<div class="team-member-designation"><span><?php
										echo esc_html( $team_member_position );
									?></span></div>
								<?php } ?>
								<?php
								if ( is_array( $social_icon_items ) && ! empty( $social_icon_items ) ) { ?>
									<div class="social-icon position-absolute">
										<?php foreach ( $social_icon_items as $key => $icon_data ) {
											$link_key = 'link_' . $key;
											if ( ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) {
												$this->add_link_attributes( $link_key, $icon_data['litho_team_member_social_link'] );
											}
											if ( ! empty( $icon_data[ 'litho_team_member_social_icon' ] ) && ! empty( $icon_data['litho_team_member_social_link']['url'] ) ) { ?>
												<a <?php $this->print_render_attribute_string( $link_key ); ?>>
													<?php if ( $is_new || $migrated ) {
														Icons_Manager::render_icon( $icon_data['litho_team_member_social_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
													} elseif ( isset( $settings['litho_team_member_social_icon']['value'] ) && ! empty( $settings['litho_team_member_social_icon']['value'] ) ) { ?> 
														<i class="<?php echo esc_attr( $icon_data['litho_team_member_social_icon']['value'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
													<?php } ?>
													<?php if ( filter_var( $icon_data['litho_team_member_label_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
														echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $icon_data[ 'litho_team_member_social_label' ] ) );
													} ?>
												</a>
											<?php } ?>
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
