<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for team member carousel.
 *
 * @package Litho
 */

// If class `Team_Member_Carousel` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Team_Member_Carousel' ) ) {

	class Team_Member_Carousel extends Widget_Base {

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
			return 'litho-team-memeber-carousel';
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
			return __( 'Litho Team Member Carousel', 'litho-addons' );
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
			return [ 'image', 'photo', 'visual', 'slide', 'carousel', 'slider', 'content' ];
		}
		
		/**
		 * Register team member carousel widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_team_member_content_section',
				[
					'label'			=> __( 'Carousel', 'litho-addons' ),
				]
			);
			$repeater = new Repeater();
			$repeater->start_controls_tabs( 'litho_team_member_tabs' );
				$repeater->start_controls_tab( 'litho_team_member_general_tab', [ 'label' => __( 'General', 'litho-addons' ) ] );
				$repeater->add_control(
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
				$repeater->add_control(
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
				$repeater->add_control(
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
				$repeater->end_controls_tab();
				$repeater->start_controls_tab( 'litho_team_member_social_tab', [ 'label' => __( 'Social', 'litho-addons' ) ] );
				
				// Facebook social icon
				$repeater->add_control(
					'litho_team_member_social_facebook_icon',
					[
						'label'             => __( 'Facebook Icon', 'litho-addons' ),
						'type'              => Controls_Manager::ICONS,
						'fa4compatibility'  => 'icon',
						'default' 		=> [
							'value'     => 'fab fa-facebook-f',
							'library'   => 'fa-brands'
						],
					]
				);
				$repeater->add_control(
					'litho_team_member_social_facebook_link',
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
					'litho_team_member_label_facebook_visible',
					[
						'label'         => __( 'Label visible', 'litho-addons' ),
						'type'          => Controls_Manager::SWITCHER,
						'label_on'      => __( 'Yes', 'litho-addons' ),
						'label_off'     => __( 'No', 'litho-addons' ),
						'return_value'  => 'yes',
						'default'       => '',
					]
				);

				$repeater->add_control(
					'litho_team_member_social_facebook_label',
					[
						'label'             => __( 'Label', 'litho-addons' ),
						'type'              => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'           => __( 'Label', 'litho-addons' ),
						'condition'			=> [ 'litho_team_member_label_facebook_visible' => 'yes' ],
					]
				);
				// END Facebook social icon

				// Instagram social icon
				$repeater->add_control(
					'litho_team_member_social_instagram_icon',
					[
						'label'             => __( 'Instagram Icon', 'litho-addons' ),
						'type'              => Controls_Manager::ICONS,
						'fa4compatibility'  => 'icon',
						'default' 		=> [
							'value'     => 'fab fa-instagram',
							'library'   => 'fa-brands'
						],
						'separator'		=> 'before'
					]
				);
				$repeater->add_control(
					'litho_team_member_social_instagram_link',
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
					'litho_team_member_label_instagram_visible',
					[
						'label'         => __( 'Label visible', 'litho-addons' ),
						'type'          => Controls_Manager::SWITCHER,
						'label_on'      => __( 'Yes', 'litho-addons' ),
						'label_off'     => __( 'No', 'litho-addons' ),
						'return_value'  => 'yes',
						'default'       => '',
					]
				);
				$repeater->add_control(
					'litho_team_member_social_instagram_label',
					[
						'label'             => __( 'Label', 'litho-addons' ),
						'type'              => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'           => __( 'Label', 'litho-addons' ),
						'condition'			=> [ 'litho_team_member_label_instagram_visible' => 'yes' ],
					]
				);

				// END Instagram social icon

				// Twitter social icon
				$repeater->add_control(
					'litho_team_member_social_twitter_icon',
					[
						'label'             => __( 'Twitter Icon', 'litho-addons' ),
						'type'              => Controls_Manager::ICONS,
						'fa4compatibility'  => 'icon',
						'default' 		=> [
							'value'     => 'fab fa-x-twitter',
							'library'   => 'fa-brands'
						],
						'separator'		=> 'before'
					]
				);
				$repeater->add_control(
					'litho_team_member_social_twitter_link',
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
					'litho_team_member_label_twitter_visible',
					[
						'label'         => __( 'Label visible', 'litho-addons' ),
						'type'          => Controls_Manager::SWITCHER,
						'label_on'      => __( 'Yes', 'litho-addons' ),
						'label_off'     => __( 'No', 'litho-addons' ),
						'return_value'  => 'yes',
						'default'       => '',
					]
				);
				$repeater->add_control(
					'litho_team_member_social_twitter_label',
					[
						'label'             => __( 'Label', 'litho-addons' ),
						'type'              => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'           => __( 'Label', 'litho-addons' ),
						'condition'			=> [ 'litho_team_member_label_twitter_visible' => 'yes' ],
					]
				);

				// END Twitter social icon

				// Pinterest social icon
				$repeater->add_control(
					'litho_team_member_social_pinterest_icon',
					[
						'label'             => __( 'Pinterest Icon', 'litho-addons' ),
						'type'              => Controls_Manager::ICONS,
						'fa4compatibility'  => 'icon',
						'default' 		=> [
							'value'     => 'fab fa-pinterest',
							'library'   => 'fa-brands'
						],
						'separator'		=> 'before'
					]
				);
				$repeater->add_control(
					'litho_team_member_social_pinterest_link',
					[
						'label'             => __( 'Link', 'litho-addons' ),
						'type'              => Controls_Manager::URL,
						'dynamic'       	=> [
							'active' => true,
						],
						'label_block'       => true,
						'default' 			=> [
							'url'	=> '',
						],
						'placeholder'       => __( 'https://your-link.com', 'litho-addons' ),
					]
				);
				$repeater->add_control(
					'litho_team_member_label_pinterest_visible',
					[
						'label'         => __( 'Label visible', 'litho-addons' ),
						'type'          => Controls_Manager::SWITCHER,
						'label_on'      => __( 'Yes', 'litho-addons' ),
						'label_off'     => __( 'No', 'litho-addons' ),
						'return_value'  => 'yes',
						'default'       => '',
					]
				);
				$repeater->add_control(
					'litho_team_member_social_pinterest_label',
					[
						'label'             => __( 'Label', 'litho-addons' ),
						'type'              => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'           => __( 'Label', 'litho-addons' ),
						'condition'			=> [ 'litho_team_member_label_pinterest_visible' => 'yes' ],
					]
				);

				// END Pinterest social icon

				// Linkedin social icon
				$repeater->add_control(
					'litho_team_member_social_linkedin_icon',
					[
						'label'             => __( 'Linkedin Icon', 'litho-addons' ),
						'type'              => Controls_Manager::ICONS,
						'fa4compatibility'  => 'icon',
						'default' 		=> [
							'value'     => 'fab fa-linkedin',
							'library'   => 'fa-brands'
						],
						'separator'		=> 'before'
					]
				);
				$repeater->add_control(
					'litho_team_member_social_linkedin_link',
					[
						'label'             => __( 'Link', 'litho-addons' ),
						'type'              => Controls_Manager::URL,
						'dynamic'       	=> [
							'active' => true,
						],
						'label_block'       => true,
						'default' 			=> [
							'url'	=> '',
						],
						'placeholder'       => __( 'https://your-link.com', 'litho-addons' ),
					]
				);
				$repeater->add_control(
					'litho_team_member_label_linkedin_visible',
					[
						'label'         => __( 'Label visible', 'litho-addons' ),
						'type'          => Controls_Manager::SWITCHER,
						'label_on'      => __( 'Yes', 'litho-addons' ),
						'label_off'     => __( 'No', 'litho-addons' ),
						'return_value'  => 'yes',
						'default'       => '',
					]
				);
				$repeater->add_control(
					'litho_team_member_social_linkedin_label',
					[
						'label'             => __( 'Label', 'litho-addons' ),
						'type'              => Controls_Manager::TEXT,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default'           => __( 'Label', 'litho-addons' ),
						'condition'			=> [ 'litho_team_member_label_linkedin_visible' => 'yes' ],
					]
				);

				// END Linkedin social icon

				$repeater->end_controls_tab();
			 $repeater->end_controls_tabs();

			$this->add_control(
				'litho_team_member_carousel',
				[
					'label' 		=> __( 'Carousel Items', 'litho-addons' ),
					'show_label'    => false,
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_team_member_image'				=> Utils::get_placeholder_image_src(),
							'litho_team_member_full_name' 			=> __( 'Alexander Harvard', 'litho-addons' ),
							'litho_team_member_position'			=> __( 'Co founder', 'litho-addons' ),
						],
						[
							'litho_team_member_image' 				=> Utils::get_placeholder_image_src(),
							'litho_team_member_full_name' 			=> __( 'Jeremy Dupont', 'litho-addons' ),
							'litho_team_member_position'			=> __( 'Manager', 'litho-addons' ),
						],
						[
							'litho_team_member_image' 				=> Utils::get_placeholder_image_src(),
							'litho_team_member_full_name' 			=> __( 'Jemmy Watson', 'litho-addons' ),
							'litho_team_member_position'			=> __( 'Designer', 'litho-addons' ),
						],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_team_member_settings_section',
				[
					'label' 		=> __( 'Slider Configuration', 'litho-addons' ),
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
			$slides_to_show = range( 1, 10 );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
			$this->add_responsive_control(
				'litho_slides_to_show',
				[
					'label' 		=> __( 'Slides to Show', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 3,
					'options' 		=> [
						'' 			=> __( 'Default', 'litho-addons' ),
					] + $slides_to_show,
				]
			);
			$this->add_control(
				'litho_items_spacing',
				[
					'label'      	=> __( 'Items Spacing', 'litho-addons' ),
					'type'       	=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
					'default' 		=> [ 'unit' => 'px', 'size' => 30 ],
					'condition' 	=> [ 'litho_slides_to_show!' => '1' ],
				]
			);
			$this->add_control(
				'litho_image_stretch',
				[
					'label' 		=> __( 'Image Stretch', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
				]
			);
			$this->add_control(
				'litho_navigation',
				[
					'label' 		=> __( 'Navigation', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'arrows',
					'options' 		=> [
						'both' 			=> __( 'Arrows and Dots', 'litho-addons' ),
						'arrows' 		=> __( 'Arrows', 'litho-addons' ),
						'dots' 			=> __( 'Dots', 'litho-addons' ),
						'none'			=> __( 'None', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_navigation_dynamic_bullets',
				[
					'label' 		=> __( 'Dynamic Bullets', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> '',
					'condition' => [
						'litho_navigation' => [ 'both', 'dots' ],
					],
				]
			);
			$this->add_control(
				'litho_pause_on_hover',
				[
					'label' 		=> __( 'Pause on Hover', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
				]
			);
			$this->add_control(
				'litho_autoplay',
				[
					'label' 		=> __( 'Autoplay', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
				]
			);
			$this->add_control(
				'litho_autoplay_speed',
				[
					'label' 		=> __( 'Autoplay Speed', 'litho-addons' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 3000,
				]
			);
			$this->add_control(
				'litho_infinite',
				[
					'label' 		=> __( 'Infinite Loop', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
				]
			);
			$this->add_control(
				'litho_effect',
				[
					'label' 		=> __( 'Effect', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'slide',
					'options' 		=> [
						'slide' 	=> __( 'Slide', 'litho-addons' ),
						'fade' 		=> __( 'Fade', 'litho-addons' ),
					],
					'condition' 	=> [ 'litho_slides_to_show' => '1' ],
				]
			);
			$this->add_control(
				'litho_speed',
				[
					'label' 		=> __( 'Animation Speed', 'litho-addons' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 500,
				]
			);
			$this->add_control(
				'litho_rtl',
				[
					'label' 		=> __( 'RTL', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'ltr',
					'options' 		=> [
						''		=> __( 'Default', 'litho-addons' ),
						'ltr'	=> __( 'Left', 'litho-addons' ),
						'rtl' 	=> __( 'Right', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_slider_cursor',
				[
					'label' 		=> __( 'Cursor', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'' 				=> __( 'Default', 'litho-addons' ),
						'white-cursor'	=> __( 'White Cursor', 'litho-addons' ),
						'black-cursor' 	=> __( 'Black Cursor', 'litho-addons' ),
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_arrows_options',
				[
					'label' 		=> __( 'Arrows', 'litho-addons' ),
					'condition' => [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->add_control(
				'litho_left_arrow_icon',
				[
					'label'       	=> __( 'Left Arrow Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-chevron-left',
						'library' 		=> 'fa-solid',
					],
					'condition' => [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->add_control(
				'litho_right_arrow_icon',
				[
					'label'       	=> __( 'Right Arrow Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-chevron-right',
						'library' 		=> 'fa-solid',
					],
					'condition' => [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->end_controls_section();

			/////////////////// STYLE TAB START ///////////////////////

			$this->start_controls_section(
				'litho_section_team_member_general_style',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
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
				'litho_section_team_member_social_style',
				[
					'label'         => __( 'Social', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
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

			$this->add_control(
				'litho_team_member_social_icon_title_heading',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->start_controls_tabs( 'litho_team_member_social_title_tabs' );
				$this->start_controls_tab( 'litho_team_member_social_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_team_member_social_title_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon .team-member-socials-label' => 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_team_member_social_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_team_member_social_title_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .social-icon a:hover .team-member-socials-label' => 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_team_member_overlay_style',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
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
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_navigation',
				[
					'label' 		=> __( 'Navigation', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'dots', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_heading_style_arrows',
				[
					'label' 		=> __( 'Arrows', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_position',
				[
					'label' 		=> __( 'Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'inside',
					'options' 		=> [
						'inside' 	=> __( 'Inside', 'litho-addons' ),
						'outside' 	=> __( 'Outside', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-arrows-position-',
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_width',
				[
					'label' 		=> __( 'Box Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_height',
				[
					'label' 		=> __( 'Box Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 15, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev i, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .elementor-widget-container .elementor-swiper-button.elementor-swiper-button-next svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_top',
				[
					'label' 		=> __( 'Top', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> [ 'min' => 1, 'max' => 500 ], '%' => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_arrows_box_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
				]
			);
			$this->start_controls_tabs( 'litho_arrows_box_style' );
				$this->start_controls_tab(
					'litho_arrows_box_normal_style',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);

				$this->add_control(
					'litho_arrows_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next svg' => 'fill: {{VALUE}};',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_arrows_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_box_border',
						'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_arrows_box_hover_style',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_control(
					'litho_arrows_hover_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'selectors' 	=> [
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:focus svg' => 'fill: {{VALUE}};',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_arrows_background_hover_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'litho_arrows_box_border_hover',
						'selector'      => '{{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .swiper .elementor-swiper-button.elementor-swiper-button-next:hover',
						'condition' 	=> [ 'litho_navigation' => [ 'arrows', 'both' ] ],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
			'litho_divider',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
					'condition' 	=> [ 'litho_navigation' => 'both' ],
				]
			);
			$this->add_control(
				'litho_heading_style_dots',
				[
					'label' 		=> __( 'Dots', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_dots_position',
				[
					'label' 		=> __( 'Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'outside',
					'options' 		=> [
						'outside' 	=> __( 'Outside', 'litho-addons' ),
						'inside' 	=> __( 'Inside', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-pagination-position-',
					'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
				]
			);
			$this->add_control(
				'litho_dots_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-pagination-position-outside .swiper' => 'padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [ 
						'litho_navigation' 	=> [ 'dots', 'both' ],
						'litho_dots_position'	=> 'outside'
					],
				]
			);
			$this->start_controls_tabs( 'litho_dots_tabs', [ 'condition' => [ 'litho_navigation' => [ 'dots', 'both' ] ] ] );
				$this->start_controls_tab( 'litho_dots_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_dots_size',
						[
							'label' 		=> __( 'Size', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 10 ],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
					$this->add_control(
						'litho_dots_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'        	=> 'litho_dots_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)',
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_dots_active_tab', [ 'label' => __( 'Active', 'litho-addons' ) ] );
					$this->add_control(
						'litho_dots_active_size',
						[
							'label' 		=> __( 'Size', 'litho-addons' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 10 ],
							],
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
					$this->add_control(
						'litho_dots_active_color',
						[
							'label' 		=> __( 'Color', 'litho-addons' ),
							'type' 			=> Controls_Manager::COLOR,
							'selectors' 	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
							],
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'        	=> 'litho_dots_hover_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();
		}

		/**
		 * Render team member carousel widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings = $this->get_settings_for_display();
			if ( empty( $settings['litho_team_member_carousel'] ) ) {
				return;
			}

			$slides_count = '';
			$slides       = [];
			$id_int       = substr( $this->get_id_int(), 0, 3 );
			$is_new       = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			foreach ( $settings['litho_team_member_carousel'] as $index => $item ) {

				$litho_team_member_image   = '';
				$wrapper_key               = 'wrapper_'.$index;
				$inner_wrapper_key         = 'inner_wrapper_'.$index;
				$inner_wrapper_details_key = 'inner_wrapper_details_'.$index;
				$team_member_full_name     = ( isset( $item['litho_team_member_full_name'] ) && $item['litho_team_member_full_name'] ) ? $item['litho_team_member_full_name'] : '';
				$team_member_position      = ( isset( $item['litho_team_member_position'] ) && $item['litho_team_member_position'] ) ? $item['litho_team_member_position'] : '';

				if ( ! empty( $item['litho_team_member_image']['id'] ) ) {
					$srcset_data                 = litho_get_image_srcset_sizes( $item['litho_team_member_image']['id'], $settings['litho_thumbnail_size'] );
					$litho_team_member_image_url = Group_Control_Image_Size::get_attachment_image_src( $item['litho_team_member_image']['id'], 'litho_thumbnail', $settings );
					$litho_team_member_image_alt = Control_Media::get_image_alt( $item['litho_team_member_image'] );
					$litho_team_member_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_team_member_image_url ), esc_attr( $litho_team_member_image_alt ), $srcset_data );
				} elseif ( ! empty( $item['litho_team_member_image']['url'] ) ) {
					$litho_team_member_image_url = $item['litho_team_member_image']['url'];
					$litho_team_member_image_alt = '';
					$litho_team_member_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_team_member_image_url ), esc_attr( $litho_team_member_image_alt ) );
				}

				$this->add_render_attribute( $wrapper_key, [
					'class' => [ 'elementor-repeater-item-' . $item['_id'], 'swiper-slide', 'team-member team-style-4' ],
				] );

				$this->add_render_attribute( $inner_wrapper_key, 'class', [ 'team-member-image' ] );
				$this->add_render_attribute( $inner_wrapper_details_key, 'class', [ 'team-member-details', 'team-member-overlay', 'd-flex', 'flex-column' ] ); 

				$social_icon_hover_animation = ' litho-no-animation';
				if ( $this->get_settings( 'litho_team_member_social_icon_hover_animation' ) ) {
					$social_icon_hover_animation = ' hvr-' . $this->get_settings( 'litho_team_member_social_icon_hover_animation' );
				}
				ob_start();
				?>
				<div <?php $this->print_render_attribute_string( $wrapper_key ); ?>>
					<figure>
						<div <?php $this->print_render_attribute_string( $inner_wrapper_key ); ?>>
							<?php if ( ! empty( $litho_team_member_image ) ) {
								echo sprintf( '%s', $litho_team_member_image ); // phpcs:ignore
							} ?>
						</div>
						<figcaption <?php $this->print_render_attribute_string( $inner_wrapper_details_key ); ?>>
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
								<div class="social-icon position-absolute">
									<?php
									/** Facebook **/
									$link_key = 'link_facebook' . $index;
									if ( ! empty( $item['litho_team_member_social_facebook_link']['url'] ) ) {
										$this->add_link_attributes( $link_key, $item['litho_team_member_social_facebook_link'] );
									}
									if ( ! empty( $item[ 'litho_team_member_social_facebook_icon' ]['value'] ) && ! empty( $item['litho_team_member_social_facebook_link']['url'] ) ) { ?>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php
											$migrated_facebook = isset( $item['__fa4_migrated']['litho_team_member_social_facebook_icon'] );
											if ( $is_new || $migrated_facebook ) {
												Icons_Manager::render_icon( $item['litho_team_member_social_facebook_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
											} else {
												?> 
												<i class="<?php echo esc_attr( $item['icon'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
											<?php } ?>
											<?php if ( filter_var( $item['litho_team_member_label_facebook_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
												echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $item[ 'litho_team_member_social_facebook_label' ] ) );
											} ?>
										</a><?php
									}
									?>
									<?php
									/** Instagram **/
									$link_key = 'link_instagram' . $index;
									if ( ! empty( $item['litho_team_member_social_instagram_link']['url'] ) ) {
										$this->add_link_attributes( $link_key, $item['litho_team_member_social_instagram_link'] );
									}
									if ( ! empty( $item[ 'litho_team_member_social_instagram_icon' ]['value'] ) && ! empty( $item['litho_team_member_social_instagram_link']['url'] ) ) { ?>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php
											$migrated_instagram = isset( $item['__fa4_migrated']['litho_team_member_social_instagram_icon'] );
											if ( $is_new || $migrated_facebook ) {
												Icons_Manager::render_icon( $item['litho_team_member_social_instagram_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
											} else { ?> 
												<i class="<?php echo esc_attr( $item['icon'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
											<?php } ?>
											<?php if ( filter_var( $item['litho_team_member_label_instagram_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
												echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $item[ 'litho_team_member_social_instagram_label' ] ) );
											} ?>
										</a><?php
									}
									?>
									<?php
									/** Twitter **/
									$link_key = 'link_twitter' . $index;
									if ( ! empty( $item['litho_team_member_social_twitter_link']['url'] ) ) {
										$this->add_link_attributes( $link_key, $item['litho_team_member_social_twitter_link'] );
									}
									if ( ! empty( $item[ 'litho_team_member_social_twitter_icon' ]['value'] ) && ! empty( $item['litho_team_member_social_twitter_link']['url'] ) ) { ?>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php
											$migrated_twitter = isset( $item['__fa4_migrated']['litho_team_member_social_twitter_icon'] );
											if ( $is_new || $migrated_twitter ) {
												Icons_Manager::render_icon( $item['litho_team_member_social_twitter_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
											} else { ?> 
												<i class="<?php echo esc_attr( $item['icon'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
											<?php } ?>
											<?php if ( filter_var( $item['litho_team_member_label_twitter_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
												echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $item[ 'litho_team_member_social_twitter_label' ] ) );
											} ?>
										</a><?php
									}
									?>
									<?php
									/** Pinterest **/
									$link_key = 'link_pinterest' . $index;
									if ( ! empty( $item['litho_team_member_social_pinterest_link']['url'] ) ) {
										$this->add_link_attributes( $link_key, $item['litho_team_member_social_pinterest_link'] );
									}
									if ( ! empty( $item[ 'litho_team_member_social_pinterest_icon' ]['value'] ) && ! empty( $item['litho_team_member_social_pinterest_link']['url'] ) ) { ?>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php
											$migrated_pinterest = isset( $item['__fa4_migrated']['litho_team_member_social_pinterest_icon'] );
											if ( $is_new || $migrated_pinterest ) {
												Icons_Manager::render_icon( $item['litho_team_member_social_pinterest_icon'], [ 'class' => $social_icon_hover_animation, 'aria-hidden' => 'true' ] );
											} else { ?> 
												<i class="<?php echo esc_attr( $item['icon'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
											<?php } ?>
											<?php if ( filter_var( $item['litho_team_member_label_pinterest_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
												echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $item[ 'litho_team_member_social_pinterest_label' ] ) );
											} ?>
										</a><?php
									}
									?>
									<?php
									/** Linkedin **/
									$link_key = 'link_linkedin' . $index;
									if ( ! empty( $item['litho_team_member_social_linkedin_link']['url'] ) ) {
										$this->add_link_attributes( $link_key, $item['litho_team_member_social_linkedin_link'] );
									}
									if ( ! empty( $item[ 'litho_team_member_social_linkedin_icon' ]['value'] ) && ! empty( $item['litho_team_member_social_linkedin_link']['url'] ) ) { ?>
										<a <?php $this->print_render_attribute_string( $link_key ); ?>>
											<?php
											$migrated_linkedin = isset( $item['__fa4_migrated']['litho_team_member_social_linkedin_icon'] );
											if ( $is_new || $migrated_linkedin ) {
												Icons_Manager::render_icon( $item['litho_team_member_social_linkedin_icon'], [ 'class' => ( $social_icon_hover_animation ) ? $social_icon_hover_animation : 'social', 'aria-hidden' => 'true' ] );
											} else { ?> 
												<i class="<?php echo esc_attr( $item['icon']['value'] ); ?><?php echo esc_attr( $social_icon_hover_animation ); ?>" aria-hidden="true"></i>
											<?php } ?>
											<?php if ( filter_var( $item['litho_team_member_label_linkedin_visible'], FILTER_VALIDATE_BOOLEAN ) ) {
												echo sprintf( '<span class="team-member-socials-label">%s</span>', esc_html( $item[ 'litho_team_member_social_linkedin_label' ] ) );
											} ?>
										</a><?php
									}
									?>
								</div>
						</figcaption>
					</figure>
				</div>
				<?php 
				$slides[] = ob_get_contents();
				ob_end_clean();
			}

			if ( empty( $slides ) ) {
				return;
			}

			$litho_left_arrow_icon = '';
			$right_arrow_icon      = '';
			$left_icon_migrated    = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
			$right_icon_migrated   = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );
			$is_new                = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( isset( $settings['litho_left_arrow_icon'] ) && ! empty( $settings['litho_left_arrow_icon'] ) ) {
				if ( $is_new || $left_icon_migrated ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_left_arrow_icon'], [ 'aria-hidden' => 'true' ] );
					$litho_left_arrow_icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_left_arrow_icon']['value'] ) && ! empty( $settings['litho_left_arrow_icon']['value'] ) ) {
					$litho_left_arrow_icon .= '<i class="' . esc_attr( $settings['litho_left_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}
			if ( isset( $settings['litho_right_arrow_icon'] ) && ! empty( $settings['litho_right_arrow_icon'] ) ) {
				if ( $is_new || $right_icon_migrated ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_right_arrow_icon'], [ 'aria-hidden' => 'true' ] );
					$right_arrow_icon .= ob_get_clean();
				} elseif ( isset( $settings['litho_right_arrow_icon']['value'] ) && ! empty( $settings['litho_right_arrow_icon']['value'] ) ) {
					$right_arrow_icon .= '<i class="' . esc_attr( $settings['litho_right_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
				}
			}

			$slides_count        = count( $settings['litho_team_member_carousel'] );
			$litho_rtl           = $this->get_settings( 'litho_rtl' );
			$litho_slider_cursor = $this->get_settings( 'litho_slider_cursor' );
			$litho_navigation    = $this->get_settings( 'litho_navigation' );

			$dataSettings = array(
				'navigation'                 => $this->get_settings( 'litho_navigation' ),
				'autoplay'                   => $this->get_settings( 'litho_autoplay' ),
				'autoplay_speed'             => $this->get_settings( 'litho_autoplay_speed' ),
				'pause_on_hover'             => $this->get_settings( 'litho_pause_on_hover' ),
				'loop'                       => $this->get_settings( 'litho_infinite' ),
				'effect'                     => $this->get_settings( 'litho_effect' ),
				'speed'                      => $this->get_settings( 'litho_speed' ),
				'image_spacing'              => $this->get_settings( 'litho_items_spacing' ),
				'slides_to_show'             => $this->get_settings( 'litho_slides_to_show' ),
				'slides_to_show_mobile'      => $this->get_settings( 'litho_slides_to_show_mobile' ),
				'slides_to_show_tablet'      => $this->get_settings( 'litho_slides_to_show_tablet' ),
				'navigation_dynamic_bullets' => $this->get_settings( 'litho_navigation_dynamic_bullets' ),
				'slides_count'               => $slides_count,
			);

			$this->add_render_attribute( [
				'carousel' => [
					'class' => [ 'elementor-team-member-carousel swiper-wrapper' ],
				],
				'carousel-wrapper' => [
					'class'         => [
						'elementor-team-member-carousel-wrapper',
						'swiper',
						$litho_slider_cursor,
					],
					'data-settings' => json_encode( $dataSettings ),
				],
			] );

			if ( ! empty( $litho_rtl ) ) {
				$this->add_render_attribute( 'carousel-wrapper', 'dir', $litho_rtl );
			}

			$show_dots   = ( in_array( $litho_navigation, [ 'dots', 'both' ] ) );
			$show_arrows = ( in_array( $litho_navigation, [ 'arrows', 'both' ] ) );

			if ( 'yes' === $this->get_settings( 'litho_image_stretch' ) ) {
				$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
			}
			?>
			<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
				<div <?php $this->print_render_attribute_string( 'carousel' );?>><?php
					echo implode( '', $slides );
				?></div>
				<?php
				if ( 1 < $slides_count ) {
					if ( $show_dots ) {
						?>
						<div class="swiper-pagination"></div>
					<?php
					}
					if ( $show_arrows ) {
						?>
						<div class="elementor-swiper-button elementor-swiper-button-prev">
							<?php
							if ( ! empty( $litho_left_arrow_icon ) ) {
								echo sprintf( '%s', $litho_left_arrow_icon ); // phpcs:ignore
							} else {
							?>
								<i class="eicon-chevron-left" aria-hidden="true"></i>
							<?php
							}
							?>
							<span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'litho-addons' ); ?></span>
						</div>
						<div class="elementor-swiper-button elementor-swiper-button-next">
							<?php
							if ( ! empty( $right_arrow_icon ) ) {
								echo sprintf( '%s', $right_arrow_icon ); // phpcs:ignore
							} else {
							?>
								<i class="eicon-chevron-right" aria-hidden="true"></i>
							<?php
							}
							?>
							<span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'litho-addons' ); ?></span>
						</div>
					<?php
					}
				}
				?>
			</div>
			<?php
		}
	}
}
