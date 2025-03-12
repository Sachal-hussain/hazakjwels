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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for fancy text box.
 *
 * @package Litho
 */

// If class `Fancy_Text_Box` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Fancy_Text_Box' ) ) {

	class Fancy_Text_Box extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-fancy-text-box';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Fancy Text Box', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-image-box';
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
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the widget belongs to.
		 *
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'text', 'content', 'box', 'info' ];
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
				'default' => __( 'Default', 'litho-addons' ),
				'xs'      => __( 'Extra Small', 'litho-addons' ),
				'sm'      => __( 'Small', 'litho-addons' ),
				'md'      => __( 'Medium', 'litho-addons' ),
				'lg'      => __( 'Large', 'litho-addons' ),
				'xl'      => __( 'Extra Large', 'litho-addons' ),
			];
		}

		/**
		 * Register fancy text box widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_fancy_text_box_general_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_fancy_text_box_styles',
				[
					'label' 		=> __( 'Select style', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default'		=> 'fancy-text-box-style-1',
					'options' 		=> [
						'fancy-text-box-style-1'  => __( 'Style 1', 'litho-addons' ),
						'fancy-text-box-style-2'  => __( 'Style 2', 'litho-addons' ),
						'fancy-text-box-style-3'  => __( 'Style 3', 'litho-addons' ),
						'fancy-text-box-style-4'  => __( 'Style 4', 'litho-addons' ),
						'fancy-text-box-style-5'  => __( 'Style 5', 'litho-addons' ),
						'fancy-text-box-style-6'  => __( 'Style 6', 'litho-addons' ),
						'fancy-text-box-style-7'  => __( 'Style 7', 'litho-addons' ),
						'fancy-text-box-style-8'  => __( 'Style 8', 'litho-addons' ),
						'fancy-text-box-style-9'  => __( 'Style 9', 'litho-addons' ),
						'fancy-text-box-style-10' => __( 'Style 10', 'litho-addons' ),
						'fancy-text-box-style-11' => __( 'Style 11', 'litho-addons' ),
						'fancy-text-box-style-12' => __( 'Style 12', 'litho-addons' ),
						'fancy-text-box-style-13' => __( 'Style 13', 'litho-addons' ),
						'fancy-text-box-style-14' => __( 'Style 14', 'litho-addons' ),
						'fancy-text-box-style-15' => __( 'Style 15', 'litho-addons' ),
					], 
					'frontend_available' => true
				]
			);
			$this->end_controls_section();

			// Start IMAGE Panel
			$this->start_controls_section(
				'litho_fancy_text_box_image_section',
				[
					'label'     => __( 'Image', 'litho-addons' ),
					'condition' => [ 'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-1' ] ],   // NOT IN
				]
			);
			$this->add_control(
				'litho_image',
				[
					'label'   => __( 'Image', 'litho-addons' ),
					'type'    => Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					]
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'litho_thumbnail',
					'default'   => 'full',
					'exclude'   => [ 'custom' ],
					'separator' => 'none',
					'condition' => [
						'litho_image[url]!' => '',
					]
				]
			);
			$this->add_control(
				'litho_link_on_image',
				[
					'label'         => __( 'Link on Image?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'condition'     => [
						'litho_image[url]!' => '',
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-12', 'fancy-text-box-style-13', 'fancy-text-box-style-15' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_image_link',
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
						'litho_image[url]!' 	=> '',
						'litho_link_on_image!' => '',
						'litho_fancy_text_box_styles' 	=> [ 'fancy-text-box-style-12', 'fancy-text-box-style-13', 'fancy-text-box-style-15' ] // IN
					],
				]
			);
			$this->end_controls_section();

			// End IMAGE Panel.

			// Start TITLE Panel.
			$this->start_controls_section(
				'litho_fancy_text_box_title_section',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_fancy_text_box_title',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'label_block'   => true,
					'default'       => __( 'Add title', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_fancy_text_box_strong_title',
				[
					'label'         => __( 'Strong Title', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'label_block'   => true,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_link_on_title',
				[
					'label'         => __( 'Link on Title?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'condition'     => [
						'litho_fancy_text_box_title!' => '',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-6' ] // NOT IN
					]
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
						'litho_fancy_text_box_title!' 	=> '',
						'litho_link_on_title!' 		=> '',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-6' ] // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_header_size',
				[
					'label' 		=> __( 'HTML Tag', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'h1'   => 'H1',
						'h2'   => 'H2',
						'h3'   => 'H3',
						'h4'   => 'H4',
						'h5'   => 'H5',
						'h6'   => 'H6',
						'div'  => 'div',
						'span' => 'span',
						'p'    => 'p',
					],
					'default' 		=> 'span',
				]
			);

			$this->end_controls_section();
			// End TITLE Panel

			// Start FANCY ICON Panel
			$this->start_controls_section(
				'litho_fancy_text_box_icon_section',
				[
					'label'     => __( 'Icon', 'litho-addons' ),
					'condition' => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-1', 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-5', 'fancy-text-box-style-6', 'fancy-text-box-style-9', 'fancy-text-box-style-11', 'fancy-text-box-style-12', 'fancy-text-box-style-13', 'fancy-text-box-style-14', 'fancy-text-box-style-15' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_fancy_text_box_icon',
				[
					'label'       	=> __( 'Icon', 'litho-addons' ),
					'type'        	=> Controls_Manager::ICONS,
					'label_block' 	=> true,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'icon-feather-arrow-right',
						'library' 		=> 'feather',
					],
				]
			);
			$this->add_control(
				'litho_link_on_icon',
				[
					'label'         => __( 'Link on Icon?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'condition'     => [
						'litho_fancy_text_box_icon[value]!' => '',
						'litho_fancy_text_box_styles'       => [ 'fancy-text-box-style-7', 'fancy-text-box-style-10' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_icon_link',
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
						'litho_fancy_text_box_icon[value]!' 	=> '',
						'litho_link_on_icon!' 					=> '',
						'litho_fancy_text_box_styles' 			=> [ 'fancy-text-box-style-7', 'fancy-text-box-style-10' ], // IN
					],
				]
			);
			$this->end_controls_section();
			// End FANCY ICON Panel

			// Start SUBTITLE Panel
			$this->start_controls_section(
				'litho_fancy_text_box_subtitle_section',
				[
					'label'     => __( 'Subtitle', 'litho-addons' ),
					'condition' => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-1', 'fancy-text-box-style-5', 'fancy-text-box-style-8', 'fancy-text-box-style-9', 'fancy-text-box-style-11', 'fancy-text-box-style-12', 'fancy-text-box-style-13', 'fancy-text-box-style-14', 'fancy-text-box-style-15' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_fancy_text_box_subtitle',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'label_block'   => true,
					'default'       => __( 'Write subtitle here', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_link_on_subtitle',
				[
					'label'         => __( 'Link on Subtitle?', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value' 	=> 'yes',
					'condition'     => [
						'litho_fancy_text_box_subtitle!'	=> '', 
						'litho_fancy_text_box_styles'		=> 'fancy-text-box-style-6', // IN
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
						'litho_fancy_text_box_subtitle!'	=> '',
						'litho_link_on_subtitle!' 			=> '',
						'litho_fancy_text_box_styles' 		=> 'fancy-text-box-style-6' // IN
					]
				]
			);
			$this->end_controls_section();
			// End SUBTITLE Panel

			// Start CONTENT Panel
			$this->start_controls_section(
				'litho_fancy_text_box_content_section',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1', 'fancy-text-box-style-3', 'fancy-text-box-style-5', 'fancy-text-box-style-9', 'fancy-text-box-style-11', 'fancy-text-box-style-14' ] ] // IN
				]
			);
			$this->add_control(
				'litho_fancy_text_box_content',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'type'          => Controls_Manager::WYSIWYG,
					'dynamic' 		=> [
						'active' => true
					],
					'show_label'    => false,
					'default'		=> __( 'Lorem ipsum is simply dummy..', 'litho-addons' ),
				]
			);
			$this->end_controls_section();
			// End CONTENT Panel

			// Start BUTTON Panel
			$this->start_controls_section(
				'litho_section_button',
				[
					'label' 		=> __( 'Button', 'litho-addons' ),
					'condition'     => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-1', 'fancy-text-box-style-7', 'fancy-text-box-style-8' ],
					]
				]
			);
			$this->add_control(
				'litho_button_text',
				[
					'label' 		=> __( 'Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default'     => __( 'Click here', 'litho-addons' ),
					'placeholder' => __( 'Click here', 'litho-addons' ),
					'condition'   => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15', // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_button_subtext',
				[
					'label' 		=> __( 'Subtext', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-9', // IN
					],
				]
			);
			$this->add_control(
				'litho_button_link',
				[
					'label' 		=> __( 'Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::URL,
					'dynamic'       => [
						'active' => true,
					],
					'placeholder' 	=> __( 'https://your-link.com', 'litho-addons' ),
					'default' 		=> [
						'url' 		=> '#',
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
					'condition' 		=> [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15' ], // NOT IN
					],
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
					'label'       		=> __( 'Icon', 'litho-addons' ),
					'type'        		=> Controls_Manager::ICONS,
					'label_block' 		=> true,
					'fa4compatibility' 	=> 'icon',
					'condition' 		=> [
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
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15' ], // NOT IN
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
						'litho_view!'	 		=> 'default',
						'litho_item_use_image' => '',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15' ], // NOT IN
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
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_item_use_image' => '',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_icon_line_height',
				[
					'label' 		=> __( 'Line Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 6, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_view'	 		=> 'default',
						'litho_item_use_image' => '',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2' ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_icon_left_spacing',
				[
					'label' 		=> __( 'Spacing1', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 0, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-text-box-style-3 .elementor-icon i' => 'margin-left: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_item_use_image' => '',
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-3', // IN
					],
				]
			);
			$this->add_control(
				'litho_icon_right_spacing',
				[
					'label' 		=> __( 'Spacing2', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [ 'px'	=> ['min' => 0, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-text-box-wrapper:not(.fancy-text-box-style-3) .elementor-icon i' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_fancy_text_box_styles' => [
							'fancy-text-box-style-4',
							'fancy-text-box-style-5',
							'fancy-text-box-style-6',
							'fancy-text-box-style-10',
							'fancy-text-box-style-13',
							'fancy-text-box-style-14',
						], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 			=> 'litho_icon_thumbnail',
					'default' 		=> 'full',
					'exclude'		=> [ 'custom' ],
					'condition'   	=> [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->end_controls_section();
			// End BUTTON Panel

			// Start GENERAL Style Panel
			$this->start_controls_section(
				'litho_fancy_text_box_general_style_section',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'   	=> [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-6', 'fancy-text-box-style-7', 'fancy-text-box-style-12', 'fancy-text-box-style-13' ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_text_aligment',
				[
					'label'   		=> __( 'Alignment', 'litho-addons' ),
					'type'    		=> Controls_Manager::CHOOSE,
					'default' 		=> '',
					'options' 		=> [
						'left'    		=> [
							'title' 	=> __( 'Left', 'litho-addons' ),
							'icon'  	=> 'eicon-text-align-left',
						],
						'center' 		=> [
							'title' 	=> __( 'Center', 'litho-addons' ),
							'icon'  	=> 'eicon-text-align-center',
						],
						'right' 		=> [
							'title' 	=> __( 'Right', 'litho-addons' ),
							'icon'  	=> 'eicon-text-align-right',
						],
					],				
					'selectors'  	=> [
						'{{WRAPPER}} .fancy-text-box-wrapper'	=> 'text-align: {{VALUE}};',
					],
					'condition' 	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-4' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_text_aligment_h_alignment',
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
						'{{WRAPPER}} .fancy-text-box' => 'display:inline-flex; align-items: {{VALUE}};',
					],
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1' ] ] // IN
				]
			);
			$this->add_control(
				'litho_fancy_text_box_after_before_border_heading',
				[
					'label'         => __( 'After / Before Border', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1' ] ] // IN
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_fancy_text_box_after_before_border',
					'selector'      => '{{WRAPPER}} .fancy-text-box:before, {{WRAPPER}} .fancy-text-box:after',
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1' ] ] // IN
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_after_and_before_border_height',
				[
					'label'         => __( 'Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px' ],
					'range'         => [ 'px'   => [ 'min' => 165, 'max' => 1000 ] ],
					'default'       => [ 'unit' => 'px', 'size' => 165 ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box:before, {{WRAPPER}} .fancy-text-box:after' => 'height: {{SIZE}}{{UNIT}}',
					],
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1' ] ] // IN
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_fancy_text_box_content_background_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .fancy-text-box-style-5:hover .fancy-text-box',
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-5' ] ] // IN
				]
			);

			$this->add_control(
				'litho_fancy_text_box_wrapper_height',
				[
					'label'		=> __( 'Height', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'default',
					'options'	=> [
						'default'	=> __( 'Default', 'litho-addons' ),
						'100'		=> __( 'Height ( 100% )', 'litho-addons' ),
					],
					'prefix_class'	=> 'h-'
				]
			);

			$this->start_controls_tabs( 'litho_fancy_text_box_content__background_tabs' );
				$this->start_controls_tab( 'litho_fancy_text_box_content__background_normal_tab',
					[
						'label'		=> __( 'Normal', 'litho-addons' ),
						'condition'	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-15' ] ] // IN
					]
				);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_fancy_text_box_content__background_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'          => '{{WRAPPER}} .fancy-text-box-wrapper:not(:hover) figcaption .fancy-text-box',
							'condition'     	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-15' ] ] // IN
						]
					);
					$this->add_control(
						'litho_fancy_text_box_content___border_radius',
						[
							'label' 		=> __( 'Border Radius', 'litho-addons' ),
							'type' 			=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .fancy-text-box-wrapper:not(:hover) figcaption .fancy-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition'     	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-15' ] ] // IN
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_fancy_text_box_content__background_hover_tab',
					[
						'label'		=> __( 'Hover', 'litho-addons' ),
						'condition'	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-15' ] ] // IN
					]
				);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_fancy_text_box_content__hover_background_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'          => '{{WRAPPER}} .fancy-text-box-wrapper:hover figcaption .fancy-text-box',
							'condition'     	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-15' ] ] // IN
						]
					);
					$this->add_control(
						'litho_fancy_text_box_content___hover_border_radius',
						[
							'label' 		=> __( 'Border Radius', 'litho-addons' ),
							'type' 			=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .fancy-text-box-wrapper:hover figcaption .fancy-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition'     	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-15' ] ] // IN
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_fancy_text_box_content___background_separator_panel_style',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
					'condition'     	=> [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-15' ] ] // IN
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_fancy_text_box_shadow',
					'selector'      => '{{WRAPPER}} .fancy-text-box-wrapper',
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-11' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_height',
				[
					'label'         => __( 'Min Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 1000 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
					'default'       => [ 'unit' => 'px', 'size' => '' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box-style-5' => 'min-height: {{SIZE}}{{UNIT}}',
					],
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-5' ] ] // IN
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1', 'fancy-text-box-style-3', 'fancy-text-box-style-5', 'fancy-text-box-style-15' ] ] // IN
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1', 'fancy-text-box-style-5', 'fancy-text-box-style-15' ] ] // IN
				]
			);

			// START figcaption style
			$this->add_control(
				'litho_fancy_text_figcaption_separator_panel_style',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-4', 'fancy-text-box-style-11' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_fancy_text_figcaption_heading',
				[
					'label'         => __( 'Figcaption', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-4', 'fancy-text-box-style-10', 'fancy-text-box-style-11' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_fancy_text_figcaption_background',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .fancy-text-box-wrapper figcaption',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-10', 'fancy-text-box-style-11' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_fancy_text_figcaption_border',
					'selector'    	=> '{{WRAPPER}} .fancy-text-box-wrapper figcaption',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-10', 'fancy-text-box-style-11' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_fancy_text_figcaption_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-text-box-wrapper figcaption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-10', 'fancy-text-box-style-11' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_figcaption_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box-wrapper figcaption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-4', 'fancy-text-box-style-10', 'fancy-text-box-style-11' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_figcaption_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box-wrapper figcaption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-10', 'fancy-text-box-style-11' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_fancy_text_figcaption_box_shadow',
					'selector' 		=> '{{WRAPPER}} .fancy-text-box-wrapper figcaption',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-10', 'fancy-text-box-style-11' ] // IN
					],

				]
			);
			// END figcaption style

			// START content box style
			$this->add_control(
				'litho_fancy_text_content_box_separator_panel_style',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-4' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_fancy_text_content_box_heading',
				[
					'label'         => __( 'Content Box', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-8', 'fancy-text-box-style-9' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_content_box_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [
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
					'default' 	=> [
							'unit' => '%',
							'size' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .fancy-text-box-wrapper .conter-wrap' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'	=> [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2' ] // IN
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_fancy_text_content_box_background',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .fancy-text-box-wrapper .conter-wrap',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-8', 'fancy-text-box-style-9' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        	=> 'litho_fancy_text_content_box_border',
					'selector'    	=> '{{WRAPPER}} .fancy-text-box-wrapper .conter-wrap',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-8', 'fancy-text-box-style-9' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_fancy_text_content_box_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-text-box-wrapper .conter-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-8', 'fancy-text-box-style-9' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_content_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box-wrapper .conter-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-8', 'fancy-text-box-style-9' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_content_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box-wrapper .conter-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-8', 'fancy-text-box-style-9' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_fancy_text_content_box_box_shadow',
					'selector' 		=> '{{WRAPPER}} .fancy-text-box-wrapper .conter-wrap',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-4', 'fancy-text-box-style-8', 'fancy-text-box-style-9' ] // IN
					],

				]
			);
			// END content box style

			// START Image Box Animation
			$this->add_control(
				'litho_image_animation_heading',
				[
					'label'         => __( 'Image Box Animation', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_image_animation',
				[
					'label' => __( 'Entrance Animation', 'litho-addons' ),
					'type' => Controls_Manager::ANIMATION,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
				]
			);

			$this->add_control(
				'litho_image_animation_duration',
				[
					'label' => __( 'Animation Duration', 'litho-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'slow' => __( 'Slow', 'litho-addons' ),
						'' => __( 'Normal', 'litho-addons' ),
						'fast' => __( 'Fast', 'litho-addons' ),
					],
					'condition' => [
						'litho_image_animation!' => '',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
				]
			);
			// START Image Box Animation
			$this->add_control(
				'litho_content_animation_heading',
				[
					'label'         => __( 'Content Box Animation', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_content_animation',
				[
					'label' => __( 'Entrance Animation', 'litho-addons' ),
					'type' => Controls_Manager::ANIMATION,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
				]
			);

			$this->add_control(
				'litho_content_animation_duration',
				[
					'label' => __( 'Animation Duration', 'litho-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'slow' => __( 'Slow', 'litho-addons' ),
						'' => __( 'Normal', 'litho-addons' ),
						'fast' => __( 'Fast', 'litho-addons' ),
					],
					'condition' => [
						'litho_content_animation!' => '',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
				]
			);

			$this->end_controls_section();
			// End GENERAL Style Panel

			// Start IMAGE Style Panel
			$this->start_controls_section(
				'litho_fancy_text_box_image_style_section',
				[
					'label'         => __( 'Image Box', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-6' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_fancy_text_image_box_background',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .fancy-text-box-image, {{WRAPPER}} .fancy-text-box-wrapper figure',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-6' ] // IN
					],
				]
			);

			$this->end_controls_section();
			// End IMAGE Style Panel

			// Start TITLE Style Panel
			$this->start_controls_section(
				'litho_fancy_text_box_title_style_section',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_fancy_text_box_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .fancy-text-box .title, {{WRAPPER}} .conter-wrap .title',
				]
			);

			$this->add_control(
				'litho_fancy_text_box_strong_title_heading',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Strong Typography', 'litho-addons' ),
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_fancy_text_box_strong_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .fancy-text-box .title span',
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-14' ] // IN
					],
				]
			);
			$this->start_controls_tabs( 'litho_fancy_text_box_title_tabs' );
				$this->start_controls_tab( 'litho_fancy_text_box_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_fancy_text_box_title_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .fancy-text-box .title, {{WRAPPER}} .fancy-text-box .title-link, {{WRAPPER}} .conter-wrap .title, {{WRAPPER}} .conter-wrap .title-link' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_fancy_text_box_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_fancy_text_box_title_color_hover',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .fancy-text-box .title-link:hover, {{WRAPPER}} .conter-wrap .title-link:hover' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_fancy_text_box_title_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'range' 		=> [
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
					'default' 	=> [
						'unit' => '%',
						'size' => '',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-text-box .title, {{WRAPPER}} .conter-wrap .title' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-1' ] ], // NOT IN
				]
			);

			$this->add_responsive_control(
				'litho_fancy_text_box_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box .title, {{WRAPPER}} .conter-wrap .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-1' ] ], // NOT IN
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box .title, {{WRAPPER}} .conter-wrap .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-1' ] ], // NOT IN
				]
			);
			$this->end_controls_section();
			// End TITLE Style Panel
			
			// Start FANCY ICON style Panel
			$this->start_controls_section(
				'litho_fancy_text_box_icon_section_style',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-8', 'fancy-text-box-style-10' ] ] // IN
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_icon_width',
				[
					'label' 	=> __( 'Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range'		=> [ 'px'   => [ 'min' => 0, 'max' => 300 ] ],
					'default' 	=> [
							'unit' => 'px',
							'size' => 40,
					],
					'selectors'	=> [
						'{{WRAPPER}} .fancy-icon' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'	=> [ 
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_icon_height',
				[
					'label' 		=> __( 'Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 300 ] ],
					'default' => [
						'unit' => 'px',
						'size' => 40,
					],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-icon' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
					]
				]
			);
			
			$this->add_responsive_control(
				'litho_fancy_text_box_icon_size',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px' => [ 'min' => 0, 'max' => 300 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .fancy-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-8', 'fancy-text-box-style-10' ],
					]
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_icon_line_height',
				[
					'label'         => __( 'Line Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px' => [ 'min' => 1, 'max' => 500 ] ],
					'default' => [
						'unit' => 'px',
						'size' => 42,
					],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-icon' => 'line-height: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ],
					]
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_icon_left',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 800 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-icon' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-3'  // IN
					]
				]
			);

			$this->start_controls_tabs( 'litho_fancy_text_box_icon_tabs' );
				$this->start_controls_tab( 'litho_fancy_text_box_icon_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' ),
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
						]
					]
				);
				$this->add_control(
					'litho_fancy_text_box_icon_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .fancy-icon, {{WRAPPER}} .fancy-icon i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .fancy-icon, {{WRAPPER}} .fancy-icon svg' => 'fill: {{VALUE}};'
						],
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-8', 'fancy-text-box-style-10' ]  // IN
						]
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_fancy_text_box_icon_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .fancy-icon',
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
						]
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_fancy_text_box_icon_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
						]
					]
				 );
				$this->add_control(
					'litho_fancy_text_box_icon_hover_color',
					[
						'label' 		=> __( 'Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .fancy-icon:hover i, {{WRAPPER}} .fancy-icon:hover a' => 'color: {{VALUE}};',
							'{{WRAPPER}} .fancy-icon:hover svg, {{WRAPPER}} .fancy-icon:hover a' => 'fill: {{VALUE}};',
						],
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
						]
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_fancy_text_box_icon_hover_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .fancy-icon:hover',
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
						]
					]
				);
				$this->add_control(
					'litho_fancy_text_box_icon_hover_border_color',
					[
						'label' 		=> __( 'Border Color', 'litho-addons' ),
						'type' 			=> Controls_Manager::COLOR,
						'default' 		=> '',
						'selectors' 	=> [
							'{{WRAPPER}} .fancy-icon:hover' => 'border-color: {{VALUE}};',
						],
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
						]
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_fancy_text_box_icon_border',
					'selector'      => '{{WRAPPER}} .fancy-icon',
					'condition'     => [ 
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
					],
					'separator'		=> 'before',
				]
			);
			$this->add_control(
				'litho_fancy_text_box_icon_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ]  // IN
					]
				]
			);
			$this->end_controls_section();
			// End FANCY ICON style Panel

			// Start SUBTITLE style Panel
			$this->start_controls_section(
				'litho_fancy_text_box_subtitle_style_section',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-4', 'fancy-text-box-style-6', 'fancy-text-box-style-7', 'fancy-text-box-style-10' ] ] // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_fancy_text_box_subtitle_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .fancy-text-box .subtitle, {{WRAPPER}} .conter-wrap .subtitle',
				]
			);
			$this->start_controls_tabs( 'litho_fancy_text_box_subtitle_tabs' );
				$this->start_controls_tab( 'litho_fancy_text_box_subtitle_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
				$this->add_control(
					'litho_fancy_text_box_subtitle_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'default'       => '',
						'selectors'     => [
							'{{WRAPPER}} .fancy-text-box .subtitle, {{WRAPPER}} .conter-wrap .subtitle' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_fancy_text_box_subtitle_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} .fancy-text-box .subtitle, {{WRAPPER}} .conter-wrap .subtitle',
						'condition'     => [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-7' ]  // IN
						]
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_fancy_text_box_subtitle_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
				$this->add_control(
					'litho_fancy_text_box_subtitle_color_hover',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'default'       => '',
						'selectors'     => [
							'{{WRAPPER}} figure:hover figcaption .subtitle' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 				=> 'litho_fancy_text_box_subtitle_hover_background_color',
						'types' 			=> [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector' 			=> '{{WRAPPER}} figure:hover figcaption .subtitle',
						'condition'     	=> [ 
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-7' ]  // IN
						]
					]
				);
				$this->add_control(
					'litho_fancy_text_box_subtitle_background_hover_transition',
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
							'{{WRAPPER}} .fancy-text-box .subtitle, {{WRAPPER}} .conter-wrap .subtitle' => 'transition-duration: {{SIZE}}s',
						],
						'condition'     => [
							'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-7' ] // IN
						],
					]
				);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_fancy_text_box_subtitle_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box .subtitle, {{WRAPPER}} .conter-wrap .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_subtitle_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box .subtitle, {{WRAPPER}} .conter-wrap .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			// End SUBTITLE style Panel

			// Start CONTENT style Panel
			$this->start_controls_section(
				'litho_fancy_text_box_content_style_section',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-1', 'fancy-text-box-style-3', 'fancy-text-box-style-5', 'fancy-text-box-style-9', 'fancy-text-box-style-11', 'fancy-text-box-style-14' ] ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_fancy_text_box_content_typography',
					'selector'  => '{{WRAPPER}} .fancy-text-box .content, {{WRAPPER}} .content',
				]
			);
			$this->start_controls_tabs( 'litho_fancy_text_box_content_tabs' );
				$this->start_controls_tab( 'litho_fancy_text_box_content_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_fancy_text_box_content_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .fancy-text-box .content, {{WRAPPER}} .content' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_fancy_text_box_content_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_fancy_text_box_content_color_hover',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'default'       => '',
							'selectors'     => [
								'{{WRAPPER}} .fancy-text-box:hover .content' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_fancy_text_box_content_width',
				[
					'label' 	=> __( 'Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units'=> [ 'px', '%', 'custom' ],
					'range' 	=> [
						'px' 	=> [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' 	=> [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'default' 	=> [
						'unit' 		=> '%',
						'size' 		=> '',
					],
					'selectors' => [
						'{{WRAPPER}} .fancy-text-box .content, {{WRAPPER}} .content' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-5', 'fancy-text-box-style-9', 'fancy-text-box-style-11' ]  // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box .content, {{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-5', 'fancy-text-box-style-9', 'fancy-text-box-style-11' ]  // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_fancy_text_box_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .fancy-text-box .content, {{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-5', 'fancy-text-box-style-9', 'fancy-text-box-style-11' ]  // IN
					],
				]
			);
			$this->end_controls_section();
			// End CONTENT style Panel

			// Start BUTTON style Panel
			$this->start_controls_section(
				'litho_section_style',
				[
					'label' 		=> __( 'Button', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-4', 'fancy-text-box-style-5', 'fancy-text-box-style-6', 'fancy-text-box-style-9', 'fancy-text-box-style-10', 'fancy-text-box-style-11', 'fancy-text-box-style-12', 'fancy-text-box-style-13', 'fancy-text-box-style-14', 'fancy-text-box-style-15' ]  // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'litho_btn_typography',
					'global' 		=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 		=> '{{WRAPPER}} a.fancy-text-button span, {{WRAPPER}} .fancy-text-button span, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15'  // NOT IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_shadow',
					'selector' 		=> '{{WRAPPER}} a.fancy-text-button span, {{WRAPPER}} .fancy-text-button span, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15'  // NOT IN
					]
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
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button, {{WRAPPER}} .fancy-text-button' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-10', 'fancy-text-box-style-15' ]  // NOT IN
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
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button, {{WRAPPER}} .fancy-text-button' => 'height: {{SIZE}}{{UNIT}}',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-10', 'fancy-text-box-style-15' ]  // NOT IN
					]
				]
			);
			$this->start_controls_tabs( 'litho_tabs_button_style' );
			$this->start_controls_tab(
				'litho_tab_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15'  // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_button_text_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} a.fancy-text-button span, {{WRAPPER}} .fancy-text-button span, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15'  // NOT IN
					]
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
					'selector' 			=> '{{WRAPPER}} a.fancy-text-button, {{WRAPPER}} .fancy-text-button, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.fancy-text-button, {{WRAPPER}} .fancy-text-button, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tab_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15'  // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_hover_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} a.fancy-text-button:hover span, {{WRAPPER}} .fancy-text-button:hover span, {{WRAPPER}} a.fancy-text-button:focus span, {{WRAPPER}} .fancy-text-button:focus span, {{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} a.fancy-text-button:hover svg, {{WRAPPER}} .fancy-text-button:hover svg, {{WRAPPER}} a.fancy-text-button:focus svg, {{WRAPPER}} .fancy-text-button:focus svg' => 'fill: {{VALUE}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					]
				]
			);
			// btn text color for Fancy Style 15
			$this->add_control(
				'litho_button_text_color_hover',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .fancy-text-box-wrapper:hover figcaption .fancy-text-box .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-15',  // IN
					]
				]
			);
			// End btn text color for Fancy Style 15
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_button_background_hover_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} a.fancy-text-button:hover, {{WRAPPER}} .fancy-text-button:hover, {{WRAPPER}} a.fancy-text-button:focus, {{WRAPPER}} .fancy-text-button:focus, {{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus',
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					]
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
						'{{WRAPPER}} a.fancy-text-button:hover, {{WRAPPER}} .fancy-text-button:hover, {{WRAPPER}} a.fancy-text-button:focus, {{WRAPPER}} .fancy-text-button:focus, {{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_button_hover_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.fancy-text-button:hover, {{WRAPPER}} .fancy-text-button:hover, {{WRAPPER}} a.elementor-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-4', 'fancy-text-box-style-5', 'fancy-text-box-style-6', 'fancy-text-box-style-10', 'fancy-text-box-style-11', 'fancy-text-box-style-12', 'fancy-text-box-style-13' ] // IN
					],
				]
			);
			$this->add_control(
				'litho_button_hover_transition',
				[
					'label'         => __( 'Transition Duration', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'default'		=> [ 'size' => 0.6 ],
					'range'         => [
						'px'        => [
							'max'       => 3,
							'step'      => 0.1,
						],
					],
					'render_type'   => 'ui',
					'selectors'     => [
						'{{WRAPPER}} a.fancy-text-button, {{WRAPPER}} .fancy-text-button, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'transition-duration: {{SIZE}}s',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-4', 'fancy-text-box-style-5', 'fancy-text-box-style-6', 'fancy-text-box-style-10', 'fancy-text-box-style-11', 'fancy-text-box-style-12', 'fancy-text-box-style-13' ] // IN
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_border',
					'selector' 		=> '{{WRAPPER}} .fancy-text-button, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					],
					'separator' 	=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .fancy-text-button, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_text_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.fancy-text-button, {{WRAPPER}} .fancy-text-button, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15'  // NOT IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_text_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.fancy-text-button, {{WRAPPER}} .fancy-text-button, {{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15'  // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_icon_heading_title__separator',
				[
					'type' 			=> Controls_Manager::DIVIDER,
					'style' 		=> 'thick',
					'condition'     => [ 'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-15' ] ] // NOT IN
				]
			);
			$this->add_control(
				'litho_icon_heading_title',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Icon or Image', 'litho-addons' ),
				]
			);
			$this->start_controls_tabs( 'litho_icon_style_tabs' );
			$this->start_controls_tab(
				'litho_icon_style_normal_tab',
				[
					'label' 	=> __( 'Normal', 'litho-addons' ),
					'condition' => [
							'litho_item_use_image' => '',
					],
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'			=> 'litho_icon_color',
					'condition'		=> [
						'litho_item_use_image' => '',
						'litho_view' 			=> 'default',
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					],
					'selector'		=> '{{WRAPPER}}.elementor-view-default .elementor-icon, {{WRAPPER}} .elementor-icon',
				]
			);
			// Icon color for Fancy style 15
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'			=> 'litho_icon_btn_color',
					'condition'		=> [
						'litho_item_use_image' => '',
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-15',  //  IN
					],
					'selector'		=> '{{WRAPPER}} .elementor-icon i, {{WRAPPER}} .elementor-icon svg',
				]
			);
			// End icon color for Fancy style 15

			$this->add_control(
				'litho_primary_color',
				[
					'label'		=> __( 'Primary Color', 'litho-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> '',
					'condition'	=> [
						'litho_view!' => 'default',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15' ], // NOT IN
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
					'label' 	=> __( 'Secondary Color', 'litho-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> '',
					'condition'	=> [
						'litho_view!'	=> 'default',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15'  ], // NOT IN
					],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_icon_style_hover_tab',
				[
					'label' 	=> __( 'Hover', 'litho-addons' ),
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
						'litho_fancy_text_box_styles!' => 'fancy-text-box-style-15',  // NOT IN
					],
					'selector' 	=> '{{WRAPPER}}.elementor-view-default a.fancy-text-button:hover .elementor-icon, {{WRAPPER}}.elementor-view-default .fancy-text-button:hover .elementor-icon,{{WRAPPER}} a.fancy-text-button:hover .elementor-icon, {{WRAPPER}}.elementor-view-default a.elementor-button:hover .elementor-icon',
				]
			);

			// Icon color for Fancy style 15
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'			=> 'litho_icon_btn_hover_color',
					'condition'		=> [
						'litho_item_use_image' => '',
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-15',  //  IN
					],
					'selector'		=> '{{WRAPPER}} .fancy-text-box-wrapper:hover figcaption .fancy-text-box .elementor-button i, {{WRAPPER}} .fancy-text-box-wrapper:hover figcaption .fancy-text-box .elementor-button svg',
				]
			);
			// End icon color for Fancy style 15

			$this->add_control(
				'litho_hover_primary_color',
				[
					'label' 	=> __( 'Primary Color', 'litho-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'condition' => [
						'litho_view!' => 'default',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15' ], // NOT IN
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-stacked  a.fancy-text-button:hover .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed  a.fancy-text-button:hover .elementor-icon, {{WRAPPER}}.elementor-view-default  a.fancy-text-button:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
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
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15'  ], // NOT IN
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-view-framed a.fancy-text-button:hover .elementor-icon' 	=> 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked a.fancy-text-button:hover .elementor-icon' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_icon_hover_transition',
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
						'{{WRAPPER}}.elementor-view-default .elementor-icon, {{WRAPPER}} .elementor-icon' => 'transition-duration: {{SIZE}}s',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_icon_image_size',
				[
					'label' 	=> __( 'Width', 'litho-addons' ),
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
					'default'   => [ 'unit' => '%', 'size' => 100 ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon img' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'litho_item_use_image' => 'yes' ],
					'separator'	=> 'before'
				]
			);
			$this->add_control(
				'litho_icon_image_border_radius',
				[
					'label' 	=> __( 'Border Radius', 'litho-addons' ),
					'type' 		=> Controls_Manager::DIMENSIONS,
					'size_units'=> [ 'px', '%', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_item_use_image' => 'yes',
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15'  ], // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'litho_icon_image_border',
					'selector' 	=> '{{WRAPPER}} .elementor-icon',
					'condition' => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9', 'fancy-text-box-style-15'  ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9'  ], // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'litho_fancy_text_box_styles!' => [ 'fancy-text-box-style-2', 'fancy-text-box-style-3', 'fancy-text-box-style-9'  ], // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_button_subtext_heading',
				[
					'type' 		=> Controls_Manager::HEADING,
					'label' 	=> __( 'Subtext', 'litho-addons' ),
					'condition'     => [
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-9', // IN
					],
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'litho_button_subtext_typography',
					'global' 		=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 		=> '{{WRAPPER}} a.fancy-text-button .subtext',
					'condition'     => [
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-9', // IN
					],
				]
			);
			$this->add_control(
				'litho_button_subtext_color',
				[
					'label' 		=> __( 'Subtext Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} a.fancy-text-button .subtext' => 'color: {{VALUE}};',
					],
					'condition'     => [
						'litho_fancy_text_box_styles' => 'fancy-text-box-style-9', // IN
					],
				]
			);
			$this->end_controls_section();
			// End BUTTON style Panel

			// Start Overlay style Panel
			$this->start_controls_section(
				'litho_fancy_text_box_overlay_section',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 'litho_fancy_text_box_styles' => [ 'fancy-text-box-style-3', 'fancy-text-box-style-4', 'fancy-text-box-style-5', 'fancy-text-box-style-6', 'fancy-text-box-style-7', 'fancy-text-box-style-9', 'fancy-text-box-style-10', 'fancy-text-box-style-15' ] ] // IN
				]
			);
			$this->start_controls_tabs( 'litho_fancy_text_box_overlay_tabs' );
			$this->start_controls_tab(
				'litho_fancy_text_box_overlay_normal_tab',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_fancy_text_box_overlay_background_color',
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
					'selector'          => '{{WRAPPER}} .fancy-text-box-overlay',
				]
			);

			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_fancy_text_box_overlay_hover_tab',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_fancy_text_box_overlay_background_hover_color',
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
					'selector'          => '{{WRAPPER}}:hover .fancy-text-box-overlay',
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * Render fancy text box widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$litho_image                 = '';
			$icon                        = '';
			$icon_image                  = '';
			$settings                    = $this->get_settings_for_display();
			$fancy_text_box_styles       = ( isset( $settings['litho_fancy_text_box_styles'] ) && $settings['litho_fancy_text_box_styles'] ) ? $settings['litho_fancy_text_box_styles'] : 'fancy-text-box-style-1';
			$fancy_text_box_title        = ( isset( $settings['litho_fancy_text_box_title'] ) && $settings['litho_fancy_text_box_title'] ) ? $settings['litho_fancy_text_box_title'] : '';
			$fancy_text_box_strong_title = ( isset( $settings['litho_fancy_text_box_strong_title'] ) && $settings['litho_fancy_text_box_strong_title'] ) ? $settings['litho_fancy_text_box_strong_title'] : '';
			$fancy_text_box_subtitle     = ( isset( $settings['litho_fancy_text_box_subtitle'] ) && $settings['litho_fancy_text_box_subtitle'] ) ? $settings['litho_fancy_text_box_subtitle'] : '';
			$fancy_text_box_content      = ( isset( $settings['litho_fancy_text_box_content'] ) && $settings['litho_fancy_text_box_content'] ) ? $settings['litho_fancy_text_box_content'] : '';
			$button_text                 = ( isset( $settings['litho_button_text'] ) && $settings['litho_button_text'] ) ? $settings['litho_button_text'] : '';
			$button_subtext              = ( isset( $settings['litho_button_subtext'] ) && $settings['litho_button_subtext'] ) ? $settings['litho_button_subtext'] : '';
			$link_on_image               = ( isset( $settings['litho_link_on_image'] ) && $settings['litho_link_on_image'] ) ? $settings['litho_link_on_image'] : '';
			$link_on_title               = ( isset( $settings['litho_link_on_title'] ) && $settings['litho_link_on_title'] ) ? $settings['litho_link_on_title'] : '';
			$link_on_icon                = ( isset( $settings['litho_link_on_icon'] ) && $settings['litho_link_on_icon'] ) ? $settings['litho_link_on_icon'] : '';
			$link_on_subtitle            = ( isset( $settings['litho_link_on_subtitle'] ) && $settings['litho_link_on_subtitle'] ) ? $settings['litho_link_on_subtitle'] : '';
			$migrated                    = isset( $settings['__fa4_migrated']['litho_item_icon'] );
			$is_new                      = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			/* Animation */
			$image_animation             = ( isset( $settings['litho_image_animation'] ) && $settings['litho_image_animation'] ) ? $settings['litho_image_animation'] : '';
			$image_animation_duration    = ( isset( $settings['litho_image_animation_duration'] ) && $settings['litho_image_animation_duration'] ) ? $settings['litho_image_animation_duration'] : '';
			$content_animation           = ( isset( $settings['litho_content_animation'] ) && $settings['litho_content_animation'] ) ? $settings['litho_content_animation'] : '';
			$content_animation_duration  = ( isset( $settings['litho_content_animation_duration'] ) && $settings['litho_content_animation_duration'] ) ? $settings['litho_content_animation_duration'] : '';

			$this->add_render_attribute( 'image_wrapper', 'class', [ 'fancy-text-box-image' ] );
			
			if ( ! empty( $image_animation ) ) {

				$this->add_render_attribute( 'image_wrapper', 'class', [ 'litho-animated', 'elementor-invisible' ] );
				$this->add_render_attribute( 'image_wrapper', 'data-animation', [ $image_animation ] );
				$this->add_render_attribute( 'image_wrapper', 'data-animation-duration', [ $image_animation_duration ] );
			}
			if ( ! empty( $content_animation ) ) {
				$this->add_render_attribute( 'text_box_wrapper', 'class', [ 'litho-animated', 'elementor-invisible' ] );
				$this->add_render_attribute( 'text_box_wrapper', 'data-animation', [ $content_animation ] );
				$this->add_render_attribute( 'text_box_wrapper', 'data-animation-duration', [ $content_animation_duration ] );
			}
			/* For Box Icon */
			$box_migrated = isset( $settings['__fa4_migrated']['litho_fancy_text_box_icon'] );

			// Image
			if ( ! empty( $settings['litho_image']['id'] ) ) {

				$srcset_data     = litho_get_image_srcset_sizes( $settings['litho_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_image']['id'], 'litho_thumbnail', $settings );
				$litho_image_alt = Control_Media::get_image_alt( $settings['litho_image'] );
				$litho_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_image_url ), esc_attr( $litho_image_alt ), $srcset_data ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			} elseif ( ! empty( $settings['litho_image']['url'] ) ) {
				$litho_image_url = $settings['litho_image']['url'];
				$litho_image_alt = '';
				$litho_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_image_url ), esc_attr( $litho_image_alt ) );
			}
			// End Image

			$this->add_render_attribute( 'wrapper', 'class', [ 'fancy-text-box-wrapper', $fancy_text_box_styles ] );

			// Link on Image
			if ( ! empty( $settings['litho_image_link']['url'] ) ) {
				$this->add_link_attributes( '_imagelink', $settings['litho_image_link'] );
				
			}
			// End Link on Image

			// Link on Title
			if ( ! empty( $settings['litho_title_link']['url'] ) ) {
				$this->add_render_attribute( '_link', 'class', 'title-link' );
				$this->add_link_attributes( '_link', $settings['litho_title_link'] );
			}
			// End Link on Title

			// Link on Icon
			if ( ! empty( $settings['litho_icon_link']['url'] ) ) {
				$this->add_render_attribute( '_iconlink', 'class', 'fancy-icon-link' );
				$this->add_link_attributes( '_iconlink', $settings['litho_icon_link'] );
			}
			// End Link on Icon

			// Link on Subtitle
			if ( ! empty( $settings['litho_subtitle_link']['url'] ) ) {
				$this->add_render_attribute( '_sublink', 'class', 'subtitle-link' );
				$this->add_link_attributes( '_sublink', $settings['litho_subtitle_link'] );
			}
			// End Link on Subtitle

			// Custom Effect
			$hover_animation_effect_array = litho_custom_hover_animation_effect();

			switch ( $fancy_text_box_styles ) {
				case 'fancy-text-box-style-3':
				case 'fancy-text-box-style-9':
				case 'fancy-text-box-style-11':
					$custom_animation_class = '';
					if ( ! empty( $settings['litho_hover_animation'] ) ) {
						$this->add_render_attribute( 'url', 'class', [ 'hvr-' . $settings['litho_hover_animation'] ] );
						if ( in_array( $settings['litho_hover_animation'], $hover_animation_effect_array ) ) {
							$custom_animation_class = 'btn-custom-effect';
						}
					}
					if ( $custom_animation_class ) {
						$this->add_render_attribute( 'url', 'class', [ $custom_animation_class ] );
					}
					break;
			}

			$this->add_render_attribute( 'url', 'class', [ 'fancy-text-button' ] );
			if ( ! empty( $settings['litho_button_link']['url'] ) ) {
				$this->add_link_attributes( 'url', $settings['litho_button_link'] );
			} else {
				$this->add_render_attribute( 'url', 'href', '#' );
			}

			switch ( $fancy_text_box_styles ) {
				case 'fancy-text-box-style-1':
				default:
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<div class="fancy-text-box">
							<?php if ( $fancy_text_box_title ) { ?>
								<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php if ( 'yes' === $link_on_title ) { ?>
										<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<?php } ?>
										<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
									<?php if ( 'yes' === $link_on_title ) { ?>
										</a>
									<?php } ?>
								</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_content ) ) { ?>
								<div class="content"><?php echo sprintf( '%s', wp_kses_post( $fancy_text_box_content ) ); ?></div>
							<?php } ?>
						</div>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-2':
					$this->add_render_attribute( 'url', 'class', [ 'd-flex', 'align-items-center', 'justify-content-center', 'flex-column' ] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) || ! empty( $button_text ) ) { ?>
								<div class="fancy-text-box-image">
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<div class="fancy-text-box-details align-items-center justify-content-center d-flex flex-column">
										<a <?php $this->print_render_attribute_string( 'url' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
											<?php $this->litho_get_button_icon(); ?>
											<?php if ( ! empty( $button_text ) ) { ?>
												<span><?php echo esc_html( $button_text ); ?></span>
											<?php } ?>
										</a>
									</div>
								</div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_subtitle ) ) { ?>
								<figcaption>
									<div class="conter-wrap">
										<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
										<?php if ( ! empty( $fancy_text_box_subtitle ) ) { ?>
											<span class="subtitle"><?php echo esc_html( $fancy_text_box_subtitle ); ?></span>
										<?php } ?>
									</div>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-3':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<div class="fancy-text-box-image">
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
								<div class="fancy-text-box-overlay"></div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_subtitle ) || ! empty( $fancy_text_box_content ) || ! empty( $button_text ) ) { ?>
								<figcaption>
									<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_subtitle ) ) { ?>
										<div class="fancy-text-box">
											<?php if ( ! empty( $fancy_text_box_subtitle ) ) { ?>
												<span class="subtitle"><?php echo esc_html( $fancy_text_box_subtitle ); ?></span>
											<?php } ?>
											<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
												<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
													<?php if ( 'yes' === $link_on_title ) { ?>
														<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
													<?php } ?>
														<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
													<?php if ( 'yes' === $link_on_title ) { ?>
														</a>
													<?php } ?>
												</<?php echo $this->get_settings( 'litho_header_size' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
											<?php } ?>
											<?php
											if ( $is_new || $box_migrated ) { ?>
												<span class="fancy-icon"><?php Icons_Manager::render_icon( $settings['litho_fancy_text_box_icon'] ); ?></span>
											<?php } else { ?>
												<span class="fancy-icon"><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
											<?php } ?>
										</div>
									<?php } ?>
									<?php if ( ! empty( $fancy_text_box_content ) || ! empty( $button_text ) ) { ?>
										<div class="fancy-text-box fancy-text-box-hover">
											<?php if ( ! empty( $fancy_text_box_content ) ) { ?>
												<div class="content"><?php echo sprintf( '%s', wp_kses_post( $fancy_text_box_content ) ); ?></div>
											<?php } ?>
											<?php if ( ! empty( $button_text ) ) { ?>
												<a <?php $this->print_render_attribute_string( 'url' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
													<span><?php echo esc_html( $button_text ); ?></span>
													<?php $this->litho_get_button_icon(); ?>
												</a>
											<?php } ?>
										</div>
									<?php } ?>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-4':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
							<div class="fancy-text-box-image">
								<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<div class="fancy-text-box-overlay"></div>
							</div>
						<?php } ?>
						<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_subtitle ) || ! empty( $button_text ) ) { ?>
							<figcaption>
								<div class="conter-wrap">
									<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
										<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php if ( 'yes' === $link_on_title ) { ?>
												<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
											<?php } ?>
												<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
											<?php if ( 'yes' === $link_on_title ) { ?>
												</a>
											<?php } ?>
										</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<?php } ?>
									<?php if ( ! empty( $fancy_text_box_subtitle ) ) { ?>
										<span class="subtitle"><?php echo esc_html( $fancy_text_box_subtitle ); ?></span>
									<?php } ?>
									<?php $this->litho_get_button(); ?>
								</div>
							</figcaption>
						<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-5':
					$image_url = ( ! empty( $litho_image_url ) ) ? 'background-image: url('. esc_url( $litho_image_url ) .'); background-repeat: no-repeat;' : '';
					$this->add_render_attribute( 'bg-banner', [
						'class' => [ 'cover-background', 'fancy-text-bg-banner-image' ],
						'style' => $image_url
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<div <?php $this->print_render_attribute_string( 'bg-banner' ); ?>>
							<?php if ( ! empty( $image_url ) ) { ?>
								<div class="fancy-text-box-overlay"></div>
							<?php } ?>
						</div>
						<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_content ) ) { ?>
							<div class="fancy-text-box">
								<div class="conter-wrap">
									<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
										<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php if ( 'yes' === $link_on_title ) { ?>
												<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
											<?php } ?>
												<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
											<?php if ( 'yes' === $link_on_title ) { ?>
												</a>
											<?php } ?>
										</<?php echo $this->get_settings( 'litho_header_size' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<?php } ?>
									<div class="content-bottom media">
										<?php if ( ! empty( $fancy_text_box_content ) ) { ?>
											<div class="content">
												<?php echo sprintf( '%s', wp_kses_post( $fancy_text_box_content ) ); ?>
											</div>
										<?php } ?>
										<?php $this->litho_get_button(); ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-6':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<div class="fancy-text-box-overlay"></div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_subtitle ) ) { ?>
							<figcaption class="banners-hover">
								 <div class="d-table h-100 w-100">
									<div class="d-table-cell align-bottom conter-wrap">
										<?php $this->litho_get_button(); ?>
										<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo sprintf( '%s', $fancy_text_box_title ); ?></<?php echo $this->get_settings( 'litho_header_size' ); ?>>
										<?php } ?>
										<?php if ( ! empty( $fancy_text_box_subtitle ) ) { ?>
											<div class="subtitle-box">
												<?php if ( 'yes' === $link_on_subtitle ) { ?>
													<a <?php $this->print_render_attribute_string( '_sublink' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<span class="subtitle"><?php echo esc_html( $fancy_text_box_subtitle ); ?></span>
												<?php if ( 'yes' === $link_on_subtitle ) { ?>
													</a>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								 </div>
							</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-7':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<div class="fancy-text-box-image">
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
								<div class="fancy-text-box-overlay"></div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_subtitle ) ) { ?>
								<figcaption>
									<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
										<div class="fancy-text-box">
											<?php if ( ! empty( $fancy_text_box_subtitle ) ) { ?>
												<span class="subtitle"><?php
													if ( 'yes' === $link_on_subtitle ) { ?>
														<a <?php $this->print_render_attribute_string( '_sublink' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
													}
													echo sprintf( '%s', $fancy_text_box_subtitle );
													if ( 'yes' === $link_on_subtitle ) {
														?></a><?php
													}
												?></span>
											<?php } ?>
											<div class="banner-content">
												<div class="media">
													<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
														<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php
															if ( 'yes' === $link_on_title ) { ?>
																<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php
															}
															echo sprintf( '%s', $fancy_text_box_title );
															if ( 'yes' === $link_on_title ) {
															?></a><?php
															}
														?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>>
													<?php } ?>
													<?php if ( isset( $settings['litho_fancy_text_box_icon'] ) && ! empty( $settings['litho_fancy_text_box_icon'] ) ) { ?>
														<span class="fancy-icon">
															<?php if ( 'yes' === $link_on_icon ) { ?>
																<a <?php $this->print_render_attribute_string( '_iconlink' ); ?>>
															<?php } ?>
																<?php if ( $is_new || $box_migrated ) { ?>
																	<?php Icons_Manager::render_icon( $settings['litho_fancy_text_box_icon'] ); ?>
																<?php } else { ?>
																	<i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i>
																<?php } ?>
															<?php if ( 'yes' === $link_on_icon ) { ?>
																</a>
															<?php } ?>
														</span>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php } ?>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-8':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $link_on_title ) { ?>
							<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php } ?>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<div class="fancy-text-box-image"><?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
							<?php } ?>
							<div class="conter-wrap">
								<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
									<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo sprintf( '%s', $fancy_text_box_title ); ?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<?php } ?>
								<span class="fancy-icon">
									<?php if ( $is_new || $box_migrated ) { ?>
										<?php Icons_Manager::render_icon( $settings['litho_fancy_text_box_icon'] ); ?>
									<?php } else { ?>
										<i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i>
									<?php } ?>
								</span>
							</div>
						<?php if ( 'yes' === $link_on_title ) { ?>
							</a>
						<?php } ?>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-9':
					$this->add_render_attribute( 'url', 'class', [ 'd-flex', 'align-items-center', 'justify-content-center', 'flex-column' ] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) || ! empty( $button_text ) || ! empty( $button_subtext ) ) { ?>
								<div class="fancy-text-box-image">
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<div class="fancy-text-box-details align-items-center justify-content-center d-flex flex-column">
										<a <?php $this->print_render_attribute_string( 'url' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
											<?php $this->litho_get_button_icon(); ?>
											<?php if ( ! empty( $button_text ) ) { ?>
												<span><?php echo esc_html( $button_text ); ?></span>
											<?php } ?>
											<?php if ( ! empty( $button_subtext ) ) { ?>
												<span class="subtext"><?php echo esc_html( $button_subtext ); ?></span>
											<?php } ?>
										</a>
									</div>
									<?php if ( ! empty( $litho_image ) ) { ?>
										<div class="fancy-text-box-overlay"></div>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_content ) ) { ?>
								<figcaption>
									<div class="conter-wrap">
										<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													</a>
												<?php } ?>
											</<?php echo $this->get_settings( 'litho_header_size' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
										<?php if ( ! empty( $fancy_text_box_content ) ) { ?>
											<div class="content">
												<?php echo sprintf( '%s', wp_kses_post( $fancy_text_box_content ) ); ?>
											</div>
										<?php } ?>
									</div>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-10':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<?php if ( 'yes' === $link_on_icon ) { ?>
									<a <?php $this->print_render_attribute_string( '_iconlink' ); ?>>
								<?php } ?>
								<div class="fancy-text-box-image">
									<div class="fancy-text-box-overlay"></div>
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php if ( $is_new || $box_migrated ) { ?>
										<span class="fancy-icon"><?php Icons_Manager::render_icon( $settings['litho_fancy_text_box_icon'] ); ?></span>
									<?php } else { ?>
										<span class="fancy-icon"><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
									<?php } ?>
								</div>
								<?php if ( 'yes' === $link_on_icon ) { ?>
									</a>
								<?php } ?>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_subtitle ) || ! empty( $fancy_text_box_content ) || ! empty( $button_text ) ) { ?>
								<figcaption>
									<div class="conter-wrap">
										<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													</a>
												<?php } ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
										<div class="button-box">
											<?php if ( ! empty( $fancy_text_box_subtitle ) ) { ?>
												<span class="subtitle"><?php echo esc_html( $fancy_text_box_subtitle ); ?></span>
											<?php } ?>
											<?php $this->litho_get_button(); ?>
										</div>
									</div>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-11':
					$this->add_render_attribute( 'url', 'class', [ 'd-flex', 'align-items-center', 'justify-content-center', 'flex-column' ] );
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<div class="fancy-text-box-image">
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<div class="fancy-text-box-details align-items-center justify-content-center d-flex flex-column">
										<a <?php $this->print_render_attribute_string( 'url' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
											<?php $this->litho_get_button_icon(); ?>
											<?php if ( ! empty( $button_text ) ) { ?>
												<span><?php echo esc_html( $button_text ); ?></span>
											<?php } ?>
										</a>
									</div>
								</div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_content ) ) { ?>
								<figcaption>
									<div class="conter-wrap">
										<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													</a>
												<?php } ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
										<?php if ( ! empty( $fancy_text_box_content ) ) { ?>
											<div class="content">
												<?php echo sprintf( '%s', wp_kses_post( $fancy_text_box_content ) ); ?>
											</div>
										<?php } ?>
									</div>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-12':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<div class="fancy-text-box-image">
									<?php if ( 'yes' === $link_on_image ) { ?>
										<a <?php $this->print_render_attribute_string( '_imagelink' ); ?>>
									<?php } ?>
										<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php if ( 'yes' === $link_on_image ) { ?>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
								<figcaption>
									<div class="fancy-text-box">
										<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													</a>
												<?php } ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
										<?php $this->litho_get_button(); ?>
									</div>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-13':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<?php if ( 'yes' === $link_on_image ) { ?>
									<a <?php $this->print_render_attribute_string( '_imagelink' ); ?>>
								<?php } ?>
								<div class="fancy-text-box-image">
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
								<?php if ( 'yes' === $link_on_image ) { ?>
										</a>
									<?php } ?>
							<?php } ?>
								<figcaption>
									<div class="fancy-text-box">
										<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													</a>
												<?php } ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
										<?php $this->litho_get_button(); ?>
									</div>
								</figcaption>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-14':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<div <?php $this->print_render_attribute_string( 'image_wrapper' ); ?>>
									<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php $this->litho_get_button(); ?>
								</div>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
								<figcaption <?php $this->print_render_attribute_string( 'text_box_wrapper' ); ?>>
									<div class="fancy-text-box">
										<?php if ( ! empty( $fancy_text_box_content ) ) { ?>
											<div class="content">
												<?php echo sprintf( '%s', wp_kses_post( $fancy_text_box_content ) ); ?>
											</div>
										<?php } ?>
										<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_strong_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
													<?php if ( ! empty( $fancy_text_box_strong_title ) ) { ?>
														<span><?php echo esc_html( $fancy_text_box_strong_title ); ?></span>
													<?php } ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													</a>
												<?php } ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
									</div>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
				case 'fancy-text-box-style-15':
					?>
					<div <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<figure>
							<?php if ( ! empty( $litho_image ) ) { ?>
								<?php if ( 'yes' === $link_on_image ) { ?>
									<a <?php $this->print_render_attribute_string( '_imagelink' ); ?>>
								<?php } ?>
									<div class="fancy-text-box-image">
										<?php echo sprintf( '%s', $litho_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div>
									<div class="fancy-text-box-overlay"></div>
								<?php if ( 'yes' === $link_on_image ) { ?>
									</a>
								<?php } ?>
							<?php } ?>
							<?php if ( ! empty( $fancy_text_box_title ) ) { ?>
								<figcaption>
									<div class="fancy-text-box">
										<?php if ( ! empty( $fancy_text_box_content ) ) { ?>
											<div class="content">
												<?php echo sprintf( '%s', wp_kses_post( $fancy_text_box_content ) ); ?>
											</div>
										<?php } ?>
										<?php if ( ! empty( $fancy_text_box_title ) || ! empty( $fancy_text_box_strong_title ) ) { ?>
											<<?php echo $this->get_settings( 'litho_header_size' ); ?> class="title"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													<a <?php $this->print_render_attribute_string( '_link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
												<?php } ?>
													<?php echo sprintf( '%s', $fancy_text_box_title ); ?>
													<?php if ( ! empty( $fancy_text_box_strong_title ) ) { ?>
														<span><?php echo esc_html( $fancy_text_box_strong_title ); ?></span>
													<?php } ?>
												<?php if ( 'yes' === $link_on_title ) { ?>
													</a>
												<?php } ?>
											</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<?php } ?>
										<?php $this->litho_get_button(); ?>
									</div>
								</figcaption>
							<?php } ?>
						</figure>
					</div>
					<?php
					break;
			}
		}

		/**
		 * Retrieve the button.
		 *
		 * @access public
		 *
		 */
		public function litho_get_button() {

			$settings              = $this->get_settings_for_display();
			$fancy_text_box_styles = ( isset( $settings['litho_fancy_text_box_styles'] ) && $settings['litho_fancy_text_box_styles'] ) ? $settings['litho_fancy_text_box_styles'] : 'fancy-text-box-style-1';
			$button_text           = ( isset( $settings['litho_button_text'] ) && $settings['litho_button_text'] ) ? $settings['litho_button_text'] : '';

			$this->add_render_attribute( [
				'btn_wrapper' => [
					'class' => [
						'elementor-button-wrapper',
						'litho-button-wrapper',
					]
				]
			] );

			// Custom Effect
			$custom_animation_class       = '';
			$hover_animation_effect_array = litho_custom_hover_animation_effect();
			switch ( $fancy_text_box_styles ) {
				case 'fancy-text-box-style-4':
				case 'fancy-text-box-style-6':
				case 'fancy-text-box-style-10':
				case 'fancy-text-box-style-12':
					if ( ! empty( $settings['litho_hover_animation'] ) ) {
						$this->add_render_attribute( 'link', 'class', [ 'hvr-' . $settings['litho_hover_animation']] );
						if ( in_array( $settings['litho_hover_animation'], $hover_animation_effect_array ) ) {
							$custom_animation_class = 'btn-custom-effect';
						}
					}
					break;
				case 'fancy-text-box-style-5':
					$this->add_render_attribute( 'btn_wrapper', 'class', [ 'align-self-center', 'text-center', 'ms-auto' ] );
					if ( ! empty( $settings['litho_hover_animation'] ) ) {
						$this->add_render_attribute( 'link', 'class', [ 'hvr-' . $settings['litho_hover_animation']] );
						if ( in_array( $settings['litho_hover_animation'], $hover_animation_effect_array ) ) {
							$custom_animation_class = 'btn-custom-effect';
						}
					}
					break;
			}
			$this->add_render_attribute( 'link', 'class', [ $custom_animation_class ] );

			if ( ! empty( $settings['litho_button_link']['url'] ) ) {
				
				$this->add_render_attribute( 'link', 'class', 'elementor-button-link' );
				$this->add_link_attributes( 'link', $settings['litho_button_link'] );
			}
			$this->add_render_attribute( 'link', 'class', 'elementor-button' );
			$this->add_render_attribute( 'link', 'role', 'button' );

			if ( ! empty( $settings['litho_size'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'elementor-size-' . $settings['litho_size'] );
			}
			ob_start();
			?><div <?php $this->print_render_attribute_string( 'btn_wrapper' ); ?>>
				<a <?php $this->print_render_attribute_string( 'link' ); ?>><?php 
					$this->litho_get_button_icon();
					echo esc_html( $button_text );
				?></a>
			</div><?php
			$output = ob_get_contents();
			ob_get_clean();
			echo sprintf( '%s', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Retrieve the button icon
		 *
		 * @access public
		 *
		 */
		public function litho_get_button_icon() {

			$icon           = '';
			$icon_image     = '';
			$icon_image_url = '';
			$icon_image_alt = '';
			$settings       = $this->get_settings_for_display();
			$migrated       = isset( $settings['__fa4_migrated']['litho_item_icon'] );
			$is_new         = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
				$icon .= '<i class="' . esc_attr( $settings['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			if ( ! empty( $settings['litho_item_image']['id'] ) ) {
				$icon_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_item_image']['id'], 'litho_icon_thumbnail', $settings );
				$icon_image_alt = Control_Media::get_image_alt( $settings['litho_item_image'] );

			} elseif ( ! empty( $settings['litho_item_image']['url'] ) ) {
				$icon_image_url = $settings['litho_item_image']['url'];
			}

			if ( ! empty( $icon_image_url ) ) {
				$icon_image = sprintf( '<img src="%1$s" alt="%2$s">', esc_url( $icon_image_url ), esc_attr( $icon_image_alt ) );
			}

			if ( ! empty( $icon_image ) || ! empty( $icon ) ) {
				?><div class="elementor-icon"><?php
					echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $icon_image : $icon;
				?></div><?php
			}
		}
	}
}
