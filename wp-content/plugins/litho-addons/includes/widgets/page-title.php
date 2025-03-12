<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Icons_Manager;
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
 * Litho widget for page title.
 *
* @package Litho
 */

if ( function_exists( 'is_section_builder_page_title_template' ) && ! is_section_builder_page_title_template() ) {
	return;
}

// If class `Page_Title` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Page_Title' ) ) {
	
	class Page_Title extends Widget_Base {

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
			return 'litho-page-title';
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
			return __( 'Litho Page Title', 'litho-addons' );
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
			return 'eicon-post-title';
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
			return [ 'litho-page-title' ];
		}

		/**
		 * Register page title widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_page_title_general_section',
				[
					'label'	=> __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_page_title_style',
				[
					'label'         => __( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'left-alignment',
					'options'       => [
						'left-alignment'            => __( 'Left Alignment', 'litho-addons' ),
						'right-alignment'           => __( 'Right Alignment', 'litho-addons' ),
						'center-alignment'          => __( 'Center Alignment', 'litho-addons' ),
						'colorful-style'            => __( 'Colorful Style', 'litho-addons' ),
						'big-typography'            => __( 'Big Typography', 'litho-addons' ),
						'parallax-background'       => __( 'Parallax background', 'litho-addons' ),
						'separate-breadcrumbs'      => __( 'Separate breadcrumbs', 'litho-addons' ),
						'gallery-background'        => __( 'Gallery Background', 'litho-addons' ),
						'background-video'          => __( 'Background Video', 'litho-addons' )
					],
					'frontend_available' => true,
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_title_section',
				[
					'label' 	=> __( 'Title', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_page_enable_title_heading',
				[
					'label'         => __( 'Title Heading Text', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'description' 	=> __( 'If yes, a title text will display in page.', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);

			$this->add_control(
				'litho_page_title_text',
				[
					'label' 		=> __( 'Add title', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'condition'			=> [
						'litho_page_enable_title_heading!' => ''
					]
				]
			);

			$this->add_control(
				'litho_header_size',
				[
					'label' 		=> __( 'Title HTML Tag', 'litho-addons' ),
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
						'p' 			=> 'p'
					],
					'default' 		=> 'h1',
					'condition'			=> [
						'litho_page_enable_title_heading!' => ''
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_subtitle_section',
				[
					'label' 	=> __( 'Subtitle', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_page_subtitle_enable',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'description' 	=> __( 'If yes, a subtitle will display in page title area', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'separator'		=> 'before'
				]
			);

			$this->add_control(
				'litho_page_subtitle',
				[
					'label' 		=> __( 'Add subtitle', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'condition'			=> [
						'litho_page_subtitle_enable!' => ''
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_background_section',
				[
					'label' 	=> __( 'Background', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_page_title_enable_bg_image',
				[
					'label'         => __( 'Enable background image', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'		=> [
						'litho_page_title_style!' => [ 'colorful-style', 'gallery-background' ] // NOT IN
					]
				]
			);

			$this->add_control(
				'litho_fallback_image',
				[
					'label' 	=> __( 'Choose Fallback Image', 'litho-addons' ),
					'type' 		=> Controls_Manager::MEDIA,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 	=> [
						'url' 	=> Utils::get_placeholder_image_src(),
					],
					'separator'	=> 'before',
					'condition'			=> [
						'litho_page_title_enable_bg_image!' => '',
						'litho_page_title_style!' => [ 'colorful-style', 'gallery-background' ] // NOT IN
					]
				]
			);

			$this->add_control(
				'litho_image_gallery_data',
				[
					'label'			=> __( 'Add Images', 'litho-addons' ),
					'type'			=> Controls_Manager::GALLERY,
					'default' 		=> [],
					'show_label'	=> false,
					'condition'		=> [
						'litho_page_title_style' => 'gallery-background' // IN
					]
				]
			);
			
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 		=> 'litho_thumbnail',
					'default' 	=> 'full',
					'exclude'	=> [ 'custom' ],
					'conditions' 	=> [
						'relation' => 'or',
						'terms' => [
							[
								'relation' => 'and',
								'terms' => [
									[
										'name' 		=> 'litho_page_title_enable_bg_image',
										'operator'	=> '===',
										'value' 	=> 'yes'
									],
									[
										'name' 		=> 'litho_page_title_style',
										'operator'	=> '!==',
										'value' 	=> 'colorful-style'
									],
								],
							]
						],
					],
				]
			);

			// For colorful style
			$this->add_control(
				'litho_page_title_wrapper_color_first',
				[
					'label'         => __( 'Color 1', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'		=> '#0038e3',
					'condition'		=> [
						'litho_page_title_style' => 'colorful-style' // IN
					]
				]
			);
			$this->add_control(
				'litho_page_title_wrapper_color_second',
				[
					'label'         => __( 'Color 2', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'		=> '#ff6737',
					'condition'		=> [
						'litho_page_title_style' => 'colorful-style' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_wrapper_color_third',
				[
					'label'         => __( 'Color 3', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'		=> '#25b15f',
					'condition'		=> [
						'litho_page_title_style' => 'colorful-style' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_wrapper_color_fourth',
				[
					'label'         => __( 'Color 4', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'		=> '#cc2d92',
					'condition'		=> [
						'litho_page_title_style' => 'colorful-style' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_wrapper_color_fifth',
				[
					'label'         => __( 'Color 5', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'		=> '#ff6737',
					'condition'		=> [
						'litho_page_title_style' => 'colorful-style' // IN
					]
				]
			);
			// END colorful style

			$this->add_control(
				'litho_page_title_parallax',
				[
					'label'         => __( 'Parallax effects', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'no-parallax' => __( 'No Parallax', 'litho-addons' ),
						'0.1' 		=> __( 'Parallax Effect 1', 'litho-addons' ),
						'0.2' 		=> __( 'Parallax Effect 2', 'litho-addons' ),
						'0.3' 		=> __( 'Parallax Effect 3', 'litho-addons' ),
						'0.4' 		=> __( 'Parallax Effect 4', 'litho-addons' ),
						'0.5' 		=> __( 'Parallax Effect 5', 'litho-addons' ),
						'0.6' 		=> __( 'Parallax Effect 6', 'litho-addons' ),
						'0.7' 		=> __( 'Parallax Effect 7', 'litho-addons' ),
						'0.8' 		=> __( 'Parallax Effect 8', 'litho-addons' ),
						'0.9' 		=> __( 'Parallax Effect 9', 'litho-addons' ),
						'1.0' 		=> __( 'Parallax Effect 10', 'litho-addons' ),
					],
					'default' 		=> 'no-parallax',
					'condition'	=> [
						'litho_page_title_enable_bg_image'	=> 'yes',
						'litho_fallback_image[url]!'		=> '',
						'litho_page_title_style!' 			=> [ 'colorful-style', 'gallery-background', 'background-video' ] // NOT IN
					],
					'description'	=> __( 'Parallax changes will be reflected in the frontend only.', 'litho-addons' ),
					'separator'		=> 'before'
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_title_video_section',
				[
					'label' 	=> __( 'Video', 'litho-addons' ),
					'condition'	=> [
						'litho_page_title_style' => [ 'background-video' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_page_title_video_type',
				[
					'label' 		=> __( 'Video Type', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> [
						'self' 			=> __( 'Self', 'litho-addons' ),
						'external' 		=> __( 'External', 'litho-addons' )
					],
					'default' 		=> 'self',
					'separator'		=> 'before',
					'condition'		=> [
						'litho_page_title_style'		=> 'background-video' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_video_mp4',
				[
					'label' 		=> __( 'Video Link ( MP4 )', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'condition'		=> [
						'litho_page_title_video_type'	=> 'self',
						'litho_page_title_style'		=> 'background-video' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_video_ogg',
				[
					'label' 		=> __( 'Video Link ( OGG )', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'condition'		=> [
						'litho_page_title_video_type'	=> 'self',
						'litho_page_title_style'		=> 'background-video' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_video_webm',
				[
					'label' 		=> __( 'Video Link ( WEBM )', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'condition'		=> [
						'litho_page_title_video_type'	=> 'self',
						'litho_page_title_style'		=> 'background-video' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_video_youtube',
				[
					'label' 		=> __( 'Video Link', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					 'description'	=> __( 'Add YOUTUBE VIDEO EMBED URL like https://www.youtube.com/embed/xxxxxxxxxx, you will get this from youtube embed iframe src code. or add VIMEO VIDEO EMBED URL like https://player.vimeo.com/video/xxxxxxxx, you will get this from vimeo embed iframe src code.', 'litho-addons' ),
					'label_block'	=> true,
					'condition'		=> [
						'litho_page_title_video_type'	=> 'external',
						'litho_page_title_style'		=> 'background-video' // IN
					]
				]
			);
			
			$this->add_control(
				'litho_page_title_video_loop',
				[
					'label'         => __( 'Loop video', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'separator'		=> 'before',
					'condition'		=> [
						'litho_page_title_video_type'	=> 'self',
						'litho_page_title_style'		=> 'background-video' // IN
					]
				]
			);

			$this->add_control(
				'litho_page_title_video_muted',
				[
					'label'         => __( 'Mute', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'		=> [
						'litho_page_title_video_type'	=> 'self',
						'litho_page_title_style'		=> 'background-video' // IN
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_title_breadcrumb_section',
				[
					'label' 	=> __( 'Breadcrumb', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_page_title_breadcrumb',
				[
					'label'         => __( 'Breadcrumb', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'description' 	=> __( 'If yes, a breadcrumb will display in page title area', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_page_breadcrumb_position',
				[
					'label' 		=> __( 'Breadcrumb Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'title-area',
					'options' 		=> [
						'title-area' 		=> __( 'In title area', 'litho-addons' ),
						'after-title-area'	=> __( 'After title area', 'litho-addons' ),
					],
					'condition'     => [
						'litho_page_title_breadcrumb' => 'yes'
					],
				]
			);
			$this->add_responsive_control(
				'litho_page_breadcrumb_alignment',
				[
					'label' 		=> __( 'Breadcrumb Alignment', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'left',
					'options' 		=> [
							'left'		=> __( 'Left', 'litho-addons' ),
							'center'	=> __( 'Center', 'litho-addons' ),
							'right'		=> __( 'Right', 'litho-addons' ),
					],
					'condition'     => [
						'litho_page_title_breadcrumb'		=> 'yes',
						'litho_page_breadcrumb_position'	=> 'after-title-area'
					],
					'selectors' => [
						'{{WRAPPER}} .main-title-breadcrumb' => 'text-align: {{VALUE}}',
					],
				]
			);
				
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_title_scroll_to_down_section',
				[
					'label' 	=> __( 'Scroll To Down', 'litho-addons' ),
					'condition'	=> [
						'litho_page_title_style' => [ 'big-typography', 'gallery-background' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_page_title_scroll_to_down',
				[
					'label'         => __( 'Scroll To Down', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_page_title_scroll_to_section_id',
				[
					'label' 		=> __( 'Next section ID', 'litho-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default'		=> 'about',
					'title'	=> __( 'Add your next section id WITHOUT the Hash key. e.g: my-id', 'litho-addons' ),
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'	=> true,
					'condition'     => [
						'litho_page_title_scroll_to_down' => 'yes'
					],
				]
			);
			$this->add_control(
				'litho_selected_icon',
				[
					'label'     => __( 'Choose Icon', 'litho-addons' ),
					'type'      => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default'   => [
						'value'     => 'fa-solid fa-arrow-down',
						'library'   => 'fa-solid',
					],
					'condition' => [
						'litho_page_title_scroll_to_down' => 'yes',
					],
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
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_title_settings',
				[
					'label' 	=> __( 'Settings', 'litho-addons' ),
				]
			);	
			$this->add_responsive_control(
				'litho_content_height',
				[
					'label' => __( 'Content Height', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' 	=> 1600,
							'min'	=> 1
						],
					],
					'render_type' => 'ui',
					'selectors' => [
						'{{WRAPPER}} .title-content-wrap, {{WRAPPER}} .litho-main-title-wrap.background-video' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'litho_page_title_meta_category',
				[
					'label'         => __( 'Category', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'description' 	=> __( 'If yes, a category will display in page title area', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					],
					'separator'		=> 'before'
				]
			);

			$this->add_control(
				'litho_page_title_meta_author',
				[
					'label'         => __( 'Author', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'description' 	=> __( 'If yes, a author will display in page title area', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					]
				]
			);
			$this->add_control(
				'litho_page_title_meta_author_text',
				[
					'label'         => __( 'Author Text', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'By&nbsp;', 'litho-addons' ),
					'condition'     => [
						'litho_page_title_meta_author'		=> 'yes',
						'litho_page_breadcrumb_position'	=> 'after-title-area',
					]
				]
			);

			$this->add_control(
				'litho_page_title_meta_date',
				[
					'label'         => __( 'Date', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'description' 	=> __( 'If yes, a date will display in page title area', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					]
				]
			);
			$this->add_control(
				'litho_page_title_meta_date_format',
				[
					'label'         => __( 'Date Format', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'		=> '',
					'description'   => sprintf(
											'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
											esc_html__( 'Date format should be like F j, Y', 'litho-addons' ),
											esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
											esc_html__( 'click here', 'litho-addons' ),
											esc_html__( 'to see other date formates.', 'litho-addons' )
										),
					'condition'     => [
						'litho_page_title_meta_date'		=> 'yes',
						'litho_page_breadcrumb_position'	=> 'after-title-area',
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_general_style_section',
				[
					'label' 		=> __( 'Background', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE
				]
			);			
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_page_title_wrapper_background_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .main-title-inner',
				]
			);

			$this->add_responsive_control(
				'litho_page_title_wrapper_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .main-title-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_page_title_wrapper_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .main-title-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_page_title_wrapper_box_shadow',
					'selector' 		=> '{{WRAPPER}} .main-title-inner'
				]
			);

			$this->add_control(
				'litho_title_container_separator_heading',
				[
					'label'         => __( 'Container', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_title_container_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'default' 		=> [ 'unit'	=> 'px', 'size' => 1140 ],
					'range'         => [ 'px'	=> [ 'min' => 500, 'max' => 2200 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .title-container' => 'max-width: {{SIZE}}px',
					],
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_background_overlay_style_section',
				[
					'label' 		=> __( 'Background Overlay', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'			=> [
						'litho_page_title_style!' => 'colorful-style' // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_background_overlay',
				[
					'label'         => __( 'Enable Overlay', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
					'condition'			=> [
						'litho_page_title_style!' => 'colorful-style' // NOT IN
					]
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_title_overlay_color',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'          => '{{WRAPPER}} .background-overlay',
					'condition'			=> [
						'litho_background_overlay' => 'yes',
						'litho_page_title_style!' => 'colorful-style' // NOT IN
					]
				]
			);	
			$this->add_control(
				'litho_title_overlay_opacity',
				[
					'label'		=> __( 'Opacity', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default'	=> [ 'size' => 0.75 ],
					'range' 	=> [
						'px' 	=> [
							'max' 	=> 1,
							'min' 	=> 0.10,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .background-overlay' => 'opacity: {{SIZE}};',
					],
					'condition'			=> [
						'litho_background_overlay' => 'yes',
						'litho_page_title_style!' => 'colorful-style' // NOT IN
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_title_style_section',
				[
					'label'		=> __( 'Title', 'litho-addons' ),
					'tab'		=> Controls_Manager::TAB_STYLE
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_page_title_typography',
					'global'	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .litho-main-title',
				]
			);
			
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_page_title_color',
					'selector'	=> '{{WRAPPER}} .litho-main-title',
				]
			);

			$this->add_control(
				'litho_page_title_opacity',
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
						'{{WRAPPER}} .litho-main-title' => 'opacity: {{SIZE}};',
					]
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_page_title_text_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-main-title',
				]
			);

			$this->add_control(
				'litho_page_title_separator_color',
				[
					'label'         => __( 'Separator Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .page-title-separator-line' => 'background-color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_page_title_style' => [ 'colorful-style', 'background-video' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_page_title_margin_bottom',
				[
					'label' => __( 'Spacing', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' 	=> 150,
							'min'	=> 0
						],
					],
					'render_type' => 'ui',
					'selectors' => [
						'{{WRAPPER}} .litho-main-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'		=> [
						'litho_page_title_style' => [ 'colorful-style', 'big-typography', 'parallax-background', 'separate-breadcrumbs', 'gallery-background', 'background-video' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_subtitle_style_section',
				[
					'label' 		=> __( 'Subtitle', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_page_subtitle_enable'		=> 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'litho_page_subtitle_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'          => '{{WRAPPER}} .litho-main-subtitle',
				]
			);

			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' 		=> 'litho_page_subtitle_color',
					'selector'	=> '{{WRAPPER}} .litho-main-subtitle',
				]
			);
			$this->add_control(
				'litho_page_subtitle_opacity',
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
						'{{WRAPPER}} .litho-main-subtitle' => 'opacity: {{SIZE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_page_subtitle_text_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-main-subtitle',
				]
			);
			$this->add_control(
				'litho_page_subtitle_separator_color',
				[
					'label'         => __( 'Separator Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .litho-main-subtitle:before' => 'border-left-color: {{VALUE}};',
					],
					'condition'		=> [
						'litho_page_title_style' => [ 'left-alignment', 'right-alignment', 'center-alignment' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_page_subtitle_margin_bottom',
				[
					'label' => __( 'Spacing', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' 	=> 150,
							'min'	=> 0
						],
					],
					'render_type' => 'ui',
					'selectors' => [
						'{{WRAPPER}} .litho-main-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'		=> [
						'litho_page_title_style' => [ 'colorful-style', 'big-typography', 'parallax-background', 'separate-breadcrumbs', 'gallery-background', 'background-video' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_breadcrumb_style_section',
				[
					'label' 		=> __( 'Breadcrumb', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_page_title_breadcrumb'		=> 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'litho_page_breadcrumb_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'          => '{{WRAPPER}} .main-title-breadcrumb li, {{WRAPPER}} .main-title-breadcrumb li a',
				]
			);
			$this->start_controls_tabs( 'litho_page_breadcrumb_tabs' );
				$this->start_controls_tab( 'litho_page_breadcrumb_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' )
					]
				);
				$this->add_control(
					'litho_page_breadcrumb_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'selectors'     => [
							'{{WRAPPER}} .main-title-breadcrumb li, {{WRAPPER}} .main-title-breadcrumb li a' => 'color: {{VALUE}};',
						]
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_page_breadcrumb_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' )
					]
				);
				$this->add_control(
					'litho_page_breadcrumb_hover_color',
					[
						'label'         => __( 'Color', 'litho-addons' ),
						'type'          => Controls_Manager::COLOR,
						'selectors'     => [
							'{{WRAPPER}} .main-title-breadcrumb li a:hover' => 'color: {{VALUE}};',
						]
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_page_breadcrumb_background_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .main-breadcrumb-section',
					'fields_options' => [
						'background' 	=> [
							'separator' => 'before',
						],
					],
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_page_breadcrumb_border',
					'default'       => '1px',
					'selector'      => '{{WRAPPER}} .main-breadcrumb-section',
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_page_breadcrumb_box_shadow',
					'selector' 		=> '{{WRAPPER}} .main-breadcrumb-section',
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					],
				]
			);
			$this->add_control(
				'litho_page_breadcrumb_separator_heading',
				[
					'label'     => __( 'Separator', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'litho_page_breadcrumb_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .main-title-breadcrumb > li:after' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_responsive_control(
				'litho_page_breadcrumb_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .main-breadcrumb-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					],
					'separator' 	=> 'before'
				]
			);
			
			$this->add_responsive_control(
				'litho_page_breadcrumb_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .main-breadcrumb-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_page_breadcrumb_position' => 'after-title-area'
					],
				]
			);
			$this->add_responsive_control(
				'litho_page_breadcrumb_wrapper_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .breadcrumb-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [
						'litho_page_breadcrumb_position' => 'title-area'
					],
					'separator' 	=> 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_page_scroll_to_down_style_section',
				[
					'label' 		=> __( 'Scroll To Down', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'	=> [
						'litho_page_title_scroll_to_down'	=> 'yes',
						'litho_page_title_style'			=> [ 'big-typography', 'gallery-background' ] // IN
					]
				]
			);

			$this->start_controls_tabs( 'litho_icon_style_tabs' );
				$this->start_controls_tab(
					'litho_icon_style_normal_tab',
					[
						'label' 		=> __( 'Normal', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_icon_color',
						'condition' => [
							'litho_view' 	=> 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .elementor-icon i:before',
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
							'litho_view!'	=> 'default',
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
						'label' 		=> __( 'Hover', 'litho-addons' ),
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'		=> 'litho_hover_icon_color',
						'condition' => [
							'litho_view' 			=> 'default',
						],
						'selector' 	=> '{{WRAPPER}}.elementor-view-default .elementor-icon:hover i:before',
					]
				);
				$this->add_control(
					'litho_hover_primary_color',
					[
						'label' => __( 'Primary Color', 'litho-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'litho_hover_secondary_color',
					[
						'label' => __( 'Secondary Color', 'litho-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'condition' => [
							'litho_view!' => 'default',
						],
						'selectors' => [
							'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' 	=> 'background-color: {{VALUE}};',
							'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' 	=> 'fill: {{VALUE}}; color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}
		
		/**
		 * Render page title widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			global $post;

			$settings = $this->get_settings_for_display();

			if ( is_singular( 'attachment' ) ) {
				return;
			}

			$litho_page_enable_title_heading = $this->get_settings( 'litho_page_enable_title_heading' );
			$litho_subtitle_enable           = $this->get_settings( 'litho_page_subtitle_enable' );

			if ( '' === $litho_page_enable_title_heading && '' === $litho_subtitle_enable ) {
				return;
			}

			$litho_page_title_style                = $this->get_settings( 'litho_page_title_style' );
			$litho_default_title                   = $this->get_settings( 'litho_page_title_text' );
			$litho_default_subtitle                = $this->get_settings( 'litho_page_subtitle' );
			$litho_enable_breadcrumb               = $this->get_settings( 'litho_page_title_breadcrumb' );
			$litho_breadcrumb_position             = $this->get_settings( 'litho_page_breadcrumb_position' );
			$migrated                              = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
			$is_new                                = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$litho_page_title_scroll_to_down       = $this->get_settings( 'litho_page_title_scroll_to_down' );
			$litho_page_title_scroll_to_section_id = $this->get_settings( 'litho_page_title_scroll_to_section_id' );
			// get post meta options
			$litho_enable_category                 = $this->get_settings( 'litho_page_title_meta_category' );
			$litho_enable_author                   = $this->get_settings( 'litho_page_title_meta_author' );
			$litho_author_text                     = $this->get_settings( 'litho_page_title_meta_author_text' );
			$litho_enable_date                     = $this->get_settings( 'litho_page_title_meta_date' );
			$litho_date_format                     = $this->get_settings( 'litho_page_title_meta_date_format' );
			$litho_enable_title_image              = ( isset( $settings['litho_page_title_enable_bg_image'] ) && $settings['litho_page_title_enable_bg_image'] ) ? $settings['litho_page_title_enable_bg_image'] : '';
			$litho_default_parallax                = $this->get_settings( 'litho_page_title_parallax' );
			//get gallery images ids
			$litho_image_gallery_data              = $this->get_settings( 'litho_image_gallery_data' );
			$litho_image_gallery_ids               = wp_list_pluck( $litho_image_gallery_data, 'id' );
			// get video options
			$litho_page_title_video_type           = $this->get_settings( 'litho_page_title_video_type' );
			$litho_default_video_mp4               = $this->get_settings( 'litho_page_title_video_mp4' );
			$litho_default_video_ogg               = $this->get_settings( 'litho_page_title_video_ogg' );
			$litho_default_video_webm              = $this->get_settings( 'litho_page_title_video_webm' );
			$litho_default_video_youtube           = $this->get_settings( 'litho_page_title_video_youtube' );
			$litho_page_title_video_loop           = $this->get_settings( 'litho_page_title_video_loop' );
			$litho_page_title_video_muted          = $this->get_settings( 'litho_page_title_video_muted' );
			// get gradient color options
			$litho_default_color1                  = $this->get_settings( 'litho_page_title_wrapper_color_first' );
			$litho_default_color2                  = $this->get_settings( 'litho_page_title_wrapper_color_second' );
			$litho_default_color3                  = $this->get_settings( 'litho_page_title_wrapper_color_third' );
			$litho_default_color4                  = $this->get_settings( 'litho_page_title_wrapper_color_fourth' );
			$litho_default_color5                  = $this->get_settings( 'litho_page_title_wrapper_color_fifth' );

			$litho_page_title = $litho_page_subtitle = $litho_title_bg_image_url = $litho_title_bg_multiple_image = $litho_single_post_meta_output = $litho_gradient_color1 = $litho_gradient_color2 = $litho_gradient_color3 = $litho_gradient_color4 = $litho_gradient_color5 = $litho_page_title_video_mp4 = $litho_page_title_video_ogg = $litho_page_title_video_webm = $litho_page_title_video_youtube = $litho_breadcrumb_attribute	= $litho_breadcrumb_class = $litho_title_class = $litho_subtitle_class = '';

			if ( is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() ) ) { // if WooCommerce plugin is activated and WooCommerce category, brand, shop page

				$litho_page_title               = woocommerce_page_title( false );
				$litho_title_class              = 'litho-product-archive-title';
				$litho_subtitle_class           = 'litho-product-archive-subtitle';
				$litho_breadcrumb_class         = 'litho-product-archive-breadcrumb';
				$litho_breadcrumb_attribute     = '';
				$litho_page_subtitle            = litho_taxonomy_title_option( 'litho_product_archive_title_subtitle', '' );
				// Background / Gallery image
				$litho_title_bg_image           = litho_taxonomy_title_option( 'litho_product_archive_title_bg_image', '' );
				$litho_title_bg_multiple_image  = litho_taxonomy_title_option( 'litho_product_archive_title_bg_multiple_image', '' );
				// END Background / Gallery image
				// For background video style
				$litho_page_title_video_mp4     = litho_taxonomy_title_option( 'litho_product_archive_title_video_mp4', '' );
				$litho_page_title_video_ogg     = litho_taxonomy_title_option( 'litho_product_archive_title_video_ogg', '' );
				$litho_page_title_video_webm    = litho_taxonomy_title_option( 'litho_product_archive_title_video_webm', '' );
				$litho_page_title_video_youtube = litho_taxonomy_title_option( 'litho_product_archive_title_video_youtube', '' );
				// END background video style

			} elseif ( is_woocommerce_activated() && is_product() ) {

				$litho_title_class                  = 'litho-single-product-title';
				$litho_subtitle_class               = 'litho-single-product-subtitle';
				$litho_breadcrumb_class             = 'litho-single-product-breadcrumb';
				$litho_breadcrumb_attribute         = '';
				$litho_page_title                   = get_the_title();
				$litho_page_subtitle                = litho_post_meta( 'litho_single_product_title_subtitle' );
				// Background / Gallery image
				$litho_title_bg_image               = litho_post_meta( 'litho_single_product_title_bg_image' );
				$litho_title_bg_multiple_image      = litho_post_meta( 'litho_single_product_title_bg_multiple_image' );
				// END Background / Gallery image
				// next section id
				$litho_page_title_callto_section_id = litho_post_meta( 'litho_single_product_title_callto_section_id' );
				// For colorful style
				$litho_gradient_color1              = litho_post_meta( 'litho_single_product_title_gradient_color_first' );
				$litho_gradient_color2              = litho_post_meta( 'litho_single_product_title_gradient_color_second' );
				$litho_gradient_color3              = litho_post_meta( 'litho_single_product_title_gradient_color_third' );
				$litho_gradient_color4              = litho_post_meta( 'litho_single_product_title_gradient_color_fourth' );
				$litho_gradient_color5              = litho_post_meta( 'litho_single_product_title_gradient_color_fifth' );
				// END colorful style
				// For background video style
				$litho_page_title_video_mp4         = litho_post_meta( 'litho_single_product_title_video_mp4' );
				$litho_page_title_video_ogg         = litho_post_meta( 'litho_single_product_title_video_ogg' );
				$litho_page_title_video_webm        = litho_post_meta( 'litho_single_product_title_video_webm' );
				$litho_page_title_video_youtube     = litho_post_meta( 'litho_single_product_title_video_youtube' );
				// END background video style

			} elseif ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) { // if Portfolio archive

				if ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) ) {

					$litho_portfolio_archive_title = sprintf( '%s', single_tag_title( '', false ) );
					
				} else {
					
					if ( empty( $litho_default_title ) ) {
						$litho_portfolio_archive_title = esc_html__( 'Portfolio', 'litho-addons' );
					} else {
						$litho_portfolio_archive_title = $litho_default_title;
					}
				}

				$litho_page_title               = $litho_portfolio_archive_title;
				$litho_title_class              = 'litho-portfolio-archive-title';
				$litho_subtitle_class           = 'litho-portfolio-archive-subtitle';
				$litho_breadcrumb_class         = 'litho-portfolio-archive-breadcrumb';
				$litho_breadcrumb_attribute     = ' itemscope="" itemtype="http://schema.org/BreadcrumbList"';
				$litho_page_subtitle            = litho_taxonomy_title_option( 'litho_portfolio_archive_title_subtitle', '' );
				// Background / Gallery image
				$litho_title_bg_image           = litho_taxonomy_title_option( 'litho_portfolio_archive_title_bg_image', '' );
				$litho_title_bg_multiple_image  = litho_taxonomy_title_option( 'litho_portfolio_archive_title_bg_multiple_image', '' );
				// END Background / Gallery image
				// For background video style
				$litho_page_title_video_mp4     = litho_taxonomy_title_option( 'litho_portfolio_archive_title_video_mp4', '' );
				$litho_page_title_video_ogg     = litho_taxonomy_title_option( 'litho_portfolio_archive_title_video_ogg', '' );
				$litho_page_title_video_webm    = litho_taxonomy_title_option( 'litho_portfolio_archive_title_video_webm', '' );
				$litho_page_title_video_youtube = litho_taxonomy_title_option( 'litho_portfolio_archive_title_video_youtube', '' );
				// END background video style
		
			} elseif ( is_search() || is_category() || is_tag() || is_archive() ) { // if Post category, tag, archive page
				if ( is_tag() ) {
					$litho_archive_title = sprintf( '%s', single_tag_title( '', false ) );
				} elseif ( is_author() ) {
					$litho_archive_title = sprintf( '%s', get_the_author() );
				} elseif ( is_category() ) {
					$litho_archive_title = sprintf( '%s', single_tag_title( '', false ) );
				} elseif ( is_year() ) {
					$litho_archive_title = sprintf( '%s', get_the_date( _x( 'Y', 'yearly archives date format', 'litho-addons' ) ) );
				} elseif ( is_month() ) {
					$litho_archive_title = sprintf( '%s', get_the_date( _x( 'F Y', 'monthly archives date format', 'litho-addons' ) ) );
				} elseif ( is_day() ) {
					$litho_archive_title = sprintf( '%s', get_the_date( _x( 'd', 'daily archives date format', 'litho-addons' ) ) );
				} elseif ( is_search() ) {
					if ( empty( $litho_default_title ) ) {
						$litho_archive_title = esc_html__( 'Search Results For ', 'litho-addons' ) . '"' . get_search_query() . '"';
					} else {
						$litho_archive_title = $litho_default_title;
					}
				} elseif ( is_archive() ) {
					if ( empty( $litho_default_title ) ) {
						$litho_archive_title = esc_html__( 'Archives', 'litho-addons' );
					} else {
						$litho_archive_title = $litho_default_title;
					}
				} else {
					$litho_archive_title = get_the_title();
				}
				
				$litho_page_title               = $litho_archive_title;
				$litho_title_class              = 'litho-archive-title';
				$litho_subtitle_class           = 'litho-archive-subtitle';
				$litho_breadcrumb_class         = 'litho-archive-breadcrumb';
				$litho_breadcrumb_attribute     = ' itemscope="" itemtype="http://schema.org/BreadcrumbList"';
				
				$litho_page_subtitle            = litho_taxonomy_title_option( 'litho_archive_title_subtitle', '' );
				
				// Background / Gallery image
				$litho_title_bg_image           = litho_taxonomy_title_option( 'litho_archive_title_bg_image', '' );
				$litho_title_bg_multiple_image  = litho_taxonomy_title_option( 'litho_archive_title_bg_multiple_image', '' );
				// END Background / Gallery image

				// For background video style
				$litho_page_title_video_mp4     = litho_taxonomy_title_option( 'litho_archive_title_video_mp4', '' );
				$litho_page_title_video_ogg     = litho_taxonomy_title_option( 'litho_archive_title_video_ogg', '' );
				$litho_page_title_video_webm    = litho_taxonomy_title_option( 'litho_archive_title_video_webm', '' );
				$litho_page_title_video_youtube = litho_taxonomy_title_option( 'litho_archive_title_video_youtube', '' );
				// END background video style

			} elseif ( is_home() ) { // if Home page

				$litho_title_class          = 'litho-default-title';
				$litho_subtitle_class       = 'litho-default-subtitle';
				$litho_breadcrumb_class     = ' litho-default-breadcrumb';
				$litho_breadcrumb_attribute = ' itemscope="" itemtype="http://schema.org/BreadcrumbList"';

				if ( empty( $litho_default_title ) ) {
					$litho_page_title = esc_html__( 'Blog', 'litho-addons' );
				} else {
					$litho_page_title = $litho_default_title;
				}

			} elseif ( 'portfolio' === get_post_type() && is_singular( 'portfolio' ) ) { // if single portfolio

				$litho_author_url           = '';
				$litho_author               = '';
				$litho_title_class          = 'litho-single-portfolio-title';
				$litho_subtitle_class       = 'litho-single-portfolio-subtitle';
				$litho_breadcrumb_class     = 'litho-single-portfolio-breadcrumb';
				$litho_breadcrumb_attribute = ' itemscope="" itemtype="http://schema.org/BreadcrumbList"';
				
				if ( is_object( $post ) && $post ) {

					$litho_author_url = get_author_posts_url( $post->post_author );
					$litho_author     = get_the_author_meta( 'display_name', $post->post_author );
				}
				// Post meta output
				if ( ! $this->litho_is_editor_mode() ) {

					if ( 'yes' === $litho_enable_date ) {
						$litho_post_meta_array[] = '<li>' . esc_html( get_the_date( $litho_date_format ) ) . '</li>';
					}		
					if ( 'yes' === $litho_enable_author && $litho_author ) {
						$litho_post_meta_array[] = '<li><span>' . esc_html( $litho_author_text ) . ' <a href="' . esc_url( $litho_author_url ) . '"> ' . esc_html( $litho_author ) . '</a></span></li>';
					}
					if ( 'yes' === $litho_enable_category ) {
						ob_start();
							litho_single_post_meta_category( get_the_ID() );
							$litho_post_meta_array[] = ob_get_contents();
						ob_end_clean();
					}
					if ( ! empty( $litho_post_meta_array ) ) {
						$litho_single_post_meta_output .= '<ul class="litho-post-details-meta alt-font">';
						$litho_single_post_meta_output .= implode( '', $litho_post_meta_array ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						$litho_single_post_meta_output .= '</ul>';
					}
				}
				// END Post meta output

				$litho_page_title                   = get_the_title();
				$litho_page_subtitle                = litho_post_meta( 'litho_single_portfolio_title_subtitle' );
				// Background / Gallery image
				$litho_title_bg_image               = litho_post_meta( 'litho_single_portfolio_title_bg_image' );
				$litho_title_bg_multiple_image      = litho_post_meta( 'litho_single_portfolio_title_bg_multiple_image' );
				// END Background / Gallery image
				// next section id
				$litho_page_title_callto_section_id = litho_post_meta( 'litho_single_portfolio_title_callto_section_id' );
				// For colorful style
				$litho_gradient_color1              = litho_post_meta( 'litho_single_portfolio_title_gradient_color_first' );
				$litho_gradient_color2              = litho_post_meta( 'litho_single_portfolio_title_gradient_color_second' );
				$litho_gradient_color3              = litho_post_meta( 'litho_single_portfolio_title_gradient_color_third' );
				$litho_gradient_color4              = litho_post_meta( 'litho_single_portfolio_title_gradient_color_fourth' );
				$litho_gradient_color5              = litho_post_meta( 'litho_single_portfolio_title_gradient_color_fifth' );
				// END colorful style
				// For background video style
				$litho_page_title_video_mp4         = litho_post_meta( 'litho_single_portfolio_title_video_mp4' );
				$litho_page_title_video_ogg         = litho_post_meta( 'litho_single_portfolio_title_video_ogg' );
				$litho_page_title_video_webm        = litho_post_meta( 'litho_single_portfolio_title_video_webm' );
				$litho_page_title_video_youtube     = litho_post_meta( 'litho_single_portfolio_title_video_youtube' );
				// END background video style

			} elseif ( is_single() ) { // if single post

				$litho_author_url           = '';
				$litho_author               = '';
				$litho_title_class          = 'litho-single-post-title';
				$litho_subtitle_class       = 'litho-single-post-subtitle';
				$litho_breadcrumb_class     = 'litho-single-post-breadcrumb';
				$litho_breadcrumb_attribute = ' itemscope="" itemtype="http://schema.org/BreadcrumbList"';

				if ( is_object( $post ) && $post ) {
					$litho_author_url = get_author_posts_url( $post->post_author );
					$litho_author     = get_the_author_meta( 'display_name', $post->post_author );
				}
				$category_list = litho_post_category( get_the_ID(), false );

				// Post meta output
				if ( ! $this->litho_is_editor_mode() ) {

					if ( 'yes' === $litho_enable_date ) {
						$litho_post_meta_array[] = '<li>' . esc_html( get_the_date( $litho_date_format ) ) . '</li>';
					}		
					
					if ( 'yes' === $litho_enable_author && $litho_author ) {
						$litho_post_meta_array[] = '<li><span>' . esc_html( $litho_author_text ) . ' <a href="' . esc_url( $litho_author_url ) . '"> ' . esc_html( $litho_author ) . '</a></span></li>';
					}
					
					if ( 'yes' === $litho_enable_category ) {
						ob_start();
							litho_single_post_meta_category( get_the_ID() );
							$litho_post_meta_array[] = ob_get_contents();
						ob_end_clean();
					}
					if ( ! empty( $litho_post_meta_array ) ) {
						
						$litho_single_post_meta_output .= '<ul class="litho-post-details-meta alt-font">';
						$litho_single_post_meta_output .= implode( '', $litho_post_meta_array ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						$litho_single_post_meta_output .= '</ul>';
					}
				}
				
				// END Post meta output

				$litho_page_title                   = get_the_title();
				$litho_page_subtitle                = litho_post_meta( 'litho_single_post_title_subtitle' );
				// Background / Gallery image
				$litho_title_bg_image               = litho_post_meta( 'litho_single_post_title_bg_image' );
				$litho_title_bg_multiple_image      = litho_post_meta( 'litho_single_post_title_bg_multiple_image' );
				// END Background / Gallery image
				// next section id
				$litho_page_title_callto_section_id = litho_post_meta( 'litho_single_post_title_callto_section_id' );
				// For colorful style
				$litho_gradient_color1              = litho_post_meta( 'litho_single_post_title_gradient_color_first' );
				$litho_gradient_color2              = litho_post_meta( 'litho_single_post_title_gradient_color_second' );
				$litho_gradient_color3              = litho_post_meta( 'litho_single_post_title_gradient_color_third' );
				$litho_gradient_color4              = litho_post_meta( 'litho_single_post_title_gradient_color_fourth' );
				$litho_gradient_color5              = litho_post_meta( 'litho_single_post_title_gradient_color_fifth' );
				// END colorful style
				// For background video style
				$litho_page_title_video_mp4         = litho_post_meta( 'litho_single_post_title_video_mp4' );
				$litho_page_title_video_ogg         = litho_post_meta( 'litho_single_post_title_video_ogg' );
				$litho_page_title_video_webm        = litho_post_meta( 'litho_single_post_title_video_webm' );
				$litho_page_title_video_youtube     = litho_post_meta( 'litho_single_post_title_video_youtube' );
				// END background video style

			} else {
	
				$litho_title_class                  = 'litho-page-title';
				$litho_subtitle_class               = 'litho-page-subtitle';
				$litho_breadcrumb_class             = 'litho-page-breadcrumb';
				$litho_breadcrumb_attribute         = ' itemscope="" itemtype="http://schema.org/BreadcrumbList"';
				$litho_page_title                   = get_the_title();
				$litho_page_subtitle                = litho_post_meta( 'litho_page_title_subtitle' );
				// Background / Gallery image
				$litho_title_bg_image               = litho_post_meta( 'litho_page_title_bg_image' );
				$litho_title_bg_multiple_image      = litho_post_meta( 'litho_page_title_bg_multiple_image' );
				// END Background / Gallery image
				// next section id
				$litho_page_title_callto_section_id = litho_post_meta( 'litho_page_title_callto_section_id' );
				// For colorful style
				$litho_gradient_color1              = litho_post_meta( 'litho_page_title_gradient_color_first' );
				$litho_gradient_color2              = litho_post_meta( 'litho_page_title_gradient_color_second' );
				$litho_gradient_color3              = litho_post_meta( 'litho_page_title_gradient_color_third' );
				$litho_gradient_color4              = litho_post_meta( 'litho_page_title_gradient_color_fourth' );
				$litho_gradient_color5              = litho_post_meta( 'litho_page_title_gradient_color_fifth' );
				// END colorful style
				// For background video style
				$litho_page_title_video_mp4         = litho_post_meta( 'litho_page_title_video_mp4' );
				$litho_page_title_video_ogg         = litho_post_meta( 'litho_page_title_video_ogg' );
				$litho_page_title_video_webm        = litho_post_meta( 'litho_page_title_video_webm' );
				$litho_page_title_video_youtube     = litho_post_meta( 'litho_page_title_video_youtube' );
				// END background video style
			}
			
			// Title heading text
			$litho_title = '';
			if ( ! empty( $litho_default_title ) ) {
				$litho_title = $litho_default_title;
			} else {
				$litho_title = $litho_page_title;
			}

			// Subtitle
			$litho_subtitle = '';
			if ( ! empty( $litho_page_subtitle ) ) {
				$litho_subtitle = $litho_page_subtitle;
			} else {
				$litho_subtitle = $litho_default_subtitle;
			}
			// END Subtitle

			// Colorful style
			$litho_gradient_colors  = array();
			$litho_gradient_bg_data = '';

			if ( ! empty( $litho_gradient_color1 ) ) {
				$litho_gradient_colors[] = $litho_gradient_color1;
			} else {
				$litho_gradient_colors[] = $litho_default_color1;
			}

			if ( ! empty( $litho_gradient_color2 ) ) {
				$litho_gradient_colors[] = $litho_gradient_color2;
			} else {
				$litho_gradient_colors[] = $litho_default_color2;
			}

			if ( ! empty( $litho_gradient_color3 ) ) {
				$litho_gradient_colors[] = $litho_gradient_color3;
			} else {
				$litho_gradient_colors[] = $litho_default_color3;
			}

			if ( ! empty( $litho_gradient_color4 ) ) {
				$litho_gradient_colors[] = $litho_gradient_color4;
			} else {
				$litho_gradient_colors[] = $litho_default_color4;
			}

			if ( ! empty( $litho_gradient_color5 ) ) {
				$litho_gradient_colors[] = $litho_gradient_color5;
			} else {
				$litho_gradient_colors[] = $litho_default_color5;
			}

			if ( $litho_gradient_colors && 'colorful-style' == $litho_page_title_style ) {
				$litho_gradient_color_list = implode( ',', $litho_gradient_colors );
				$litho_gradient_bg_data    = $litho_gradient_color_list;
			}
			// END Colorful style

			// Background image
			$litho_title_bg_image_url = '';
			if ( 'yes' === $litho_enable_title_image ) {
				if ( ! empty( $litho_title_bg_image ) ) {
					$litho_title_bg_image_url = $litho_title_bg_image;
				} else {
					if ( ! empty( $settings['litho_fallback_image']['id'] ) ) {
						$litho_title_bg_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_fallback_image']['id'], 'litho_thumbnail', $settings );
					} elseif ( ! empty( $settings['litho_fallback_image']['url'] ) ) {
						$litho_title_bg_image_url = $settings['litho_fallback_image']['url'];
					}
				}
			}

			// END Background image

			// Image Gallery
			$litho_bg_multiple_image = '';
			if ( ! empty( $litho_title_bg_multiple_image ) ) {

				$litho_bg_multiple_image = explode( ',', $litho_title_bg_multiple_image );

			} elseif ( ! empty( $litho_image_gallery_ids ) ) {

				$litho_bg_multiple_image = $litho_image_gallery_ids;
			}
			// END Gallery

			// Background video
			$litho_title_video_mp4 = $litho_title_video_ogg = $litho_title_video_webm = $litho_title_video_youtube = '';
			if ( ! empty( $litho_page_title_video_mp4 ) ) {
				$litho_title_video_mp4 = $litho_page_title_video_mp4;
			} else {
				$litho_title_video_mp4 = $litho_default_video_mp4;
			}

			if ( ! empty( $litho_page_title_video_ogg ) ) {
				$litho_title_video_ogg = $litho_page_title_video_ogg;
			} else {
				$litho_title_video_ogg = $litho_default_video_ogg;
			}

			if ( ! empty( $litho_page_title_video_webm ) ) {
				$litho_title_video_webm = $litho_page_title_video_webm;
			} else {
				$litho_title_video_webm = $litho_default_video_webm;
			}

			if ( ! empty( $litho_page_title_video_youtube ) ) {
				$litho_title_video_youtube = $litho_page_title_video_youtube;
			} else {
				$litho_title_video_youtube = $litho_default_video_youtube;
			}
			// END Background video

			// scroll to next section id
			$litho_title_callto_section_id = '';

			if ( ! empty( $litho_page_title_callto_section_id ) ) {
				
				$litho_title_callto_section_id = $litho_page_title_callto_section_id;

			} elseif ( ! empty( $litho_page_title_scroll_to_section_id ) ) {

				$litho_title_callto_section_id = $litho_page_title_scroll_to_section_id;
			}
			
			$litho_icon = '';
			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
				$litho_icon .= ob_get_clean();
			} else {
				ob_start();
				?>
				<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				<?php
				$litho_icon .= ob_get_clean();
			}
			// END scroll to next section id

			$this->add_render_attribute( 'main-title-wrapper', [
				'class' => [ 'litho-main-title-wrap', 'main-title-inner', $litho_title_class . '-wrap ', $litho_page_title_style ]
			] );

			switch ( $litho_page_title_style ) {
				case 'left-alignment':
				case 'right-alignment':
				case 'center-alignment':
				case 'left-alignment':
				case 'big-typography':
				case 'parallax-background':
				case 'separate-breadcrumbs':
					$litho_default_parallax       = ( ! empty( $litho_default_parallax ) && $litho_default_parallax != 'no-parallax' ) ? esc_attr( $litho_default_parallax ) : '';
					$litho_default_parallax_class = ( ! empty( $litho_default_parallax ) ) ? 'parallax' : 'cover-background';

					if ( ! empty( $litho_title_bg_image_url ) ) {
						$this->add_render_attribute( 'main-title-wrapper', [
							'class' => $litho_default_parallax_class,
							'style' => 'background-image: url(' . esc_url( $litho_title_bg_image_url ) . ');',
						] );
					}

					if ( ! empty( $litho_title_bg_image_url ) && $litho_default_parallax ) {
						$this->add_render_attribute( 'main-title-wrapper', [
							'data-parallax-background-ratio' => $litho_default_parallax
						] );
					}
					break;
				case 'background-video':
					if ( 'self' === $litho_page_title_video_type ) {
						$this->add_render_attribute( 'video', [
							'class'    => 'html-video',
							'autoplay' => 'autoplay'
						] );

						if ( 'yes' === $litho_page_title_video_loop ) {
							$this->add_render_attribute( 'video', [
								'loop' => 'loop'
							] );
						}

						if ( 'yes' === $litho_page_title_video_muted ) {
							$this->add_render_attribute( 'video', [
								'muted'	=> 'muted'
							] );
						}

						if ( ! empty( $litho_title_bg_image_url ) ) {
							$this->add_render_attribute( 'video', [
								'poster' => esc_url( $litho_title_bg_image_url ),
							] );
						}
					}
					break;
				case 'colorful-style':
					if ( $litho_gradient_bg_data ) {
						$this->add_render_attribute( 'main-title-wrapper', [
							'data-background-color' => $litho_gradient_bg_data
						] );
					}
					break;
			}

			$this->add_render_attribute( 'main-container', [
				'class' => [ 'title-container' ]
			] );

			$this->add_render_attribute( 'main-row', [
				'class' => [ 'title-content-wrap' ]
			] );

			$this->add_render_attribute( 'title', [
				'class' => [ 'litho-main-title', $litho_title_class ]
			] );

			$this->add_render_attribute( 'subtitle', [
				'class' => [ 'litho-main-subtitle', $litho_subtitle_class ]
			] );

			// In title area
			$this->add_render_attribute( 'title-breadcrumb', [
				'class' => [ 'litho-main-title-breadcrumb', 'main-title-breadcrumb', $litho_title_class.'-breadcrumb' ]
			] );

			// After title area
			$this->add_render_attribute( 'main-breadcrumb', [
				'class' => [ 'litho-main-breadcrumb', 'main-breadcrumb-section', $litho_breadcrumb_class ]
			] );

			if ( ( $this->litho_is_editor_mode() && is_single() && 'sectionbuilder' == get_post_type() ) ) {
				$litho_title    = esc_html__( 'Page title goes here', 'litho-addons' );
				$litho_subtitle = esc_html__( 'Page subtitle goes here', 'litho-addons' );
			}

			switch ( $litho_page_title_style ) {
				case 'left-alignment':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-center' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) && ! empty( $litho_title_bg_image_url ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-xl-8 col-lg-6 text-center text-lg-start">
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
									<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php
											echo esc_html( $litho_title );
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<!-- end page title -->
									<?php } ?>
									<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
									<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $litho_subtitle ); ?></span>
									<!-- end sub title -->
									<?php } ?>
								</div>
								<div class="col-xl-4 col-lg-6 text-center text-lg-end justify-content-center justify-content-lg-end breadcrumb-wrapper">
									<?php
									if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
										?>
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'right-alignment':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-center justify-content-center' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) && ! empty( $litho_title_bg_image_url ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-xl-4 col-lg-6 text-center text-lg-start justify-content-center justify-content-lg-start breadcrumb-wrapper">
									<?php
									if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
										?>
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
								</div>
								<div class="col-xl-8 col-lg-6 text-center text-lg-end">
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
									<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											echo esc_html( $litho_title );
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<!-- end page title -->
									<?php } ?>
									<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
									<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											echo esc_html( $litho_subtitle );
										?></span>
									<!-- end sub title -->
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'center-alignment':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-center justify-content-center' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) && ! empty( $litho_title_bg_image_url ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-12 text-center">
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
									<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php
											echo esc_html( $litho_title );
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<!-- end page title -->
									<?php } ?>
									<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
									<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $litho_subtitle ); ?></span>
									<!-- end sub title -->
									<?php } ?>
									<?php
									if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
										?>
										<!-- start breadcrumb -->
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<!-- end breadcrumb -->
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'colorful-style':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'd-flex flex-column flex-md-row justify-content-end extra-small-screen' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="w-100 align-self-end page-title-extra-small">
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
									<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											echo esc_html( $litho_title );
										?><span class="page-title-separator-line w-70px"></span>
										</<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<!-- end page title -->
									<?php } ?>
								</div>
								<div class="w-100 align-self-end">
									<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
									<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); ?>><?php
											echo esc_html( $litho_subtitle );
										?></span>
									<!-- end sub title -->
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'big-typography':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-stretch justify-content-center small-screen' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) && ! empty( $litho_title_bg_image_url ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-12 col-xl-6 col-lg-7 col-md-8 text-center d-flex align-items-center justify-content-center flex-column">
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
										<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php
											echo esc_html( $litho_title );
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<!-- end page title -->
									<?php
									}
									
									if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
										<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $litho_subtitle ); ?></span>
										<!-- end sub title -->
									<?php
									}
									if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
										?>
										<!-- start breadcrumb -->
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<!-- end breadcrumb -->
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
								</div>
							</div>
							<?php if ( 'yes' === $litho_page_title_scroll_to_down ) { ?>
								<div class="down-section text-center">
									<a href="<?php echo sprintf( '#%s', $litho_title_callto_section_id ); ?>" class="section-link elementor-icon">
										<?php
										if ( ! empty( $litho_icon ) ) {
											echo sprintf( '%s', $litho_icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										} else {
										?>
											<i class="ti-arrow-down"></i>
										<?php } ?>
										<span class="elementor-screen-only"><?php echo esc_html__( 'Scroll Down', 'litho-addons' ); ?></span>
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'parallax-background':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-stretch justify-content-center small-screen' ]
					] );
					if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
						$this->add_render_attribute( 'main-row', [
							'class' => [ 'breadcrumb-in-title-area' ]
						] );
					}
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) && ! empty( $litho_title_bg_image_url ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-12 col-xl-6 col-lg-7 col-md-10 text-center d-flex align-items-center justify-content-center flex-column">
									<div class="parallax-content-wrap">
										<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
											<!-- start sub title -->
											<span <?php $this->print_render_attribute_string( 'subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $litho_subtitle ); ?></span>
											<!-- end sub title -->
										<?php } ?>
										<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
											<!-- start page title -->
											<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php
												echo esc_html( $litho_title );
											?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
											<!-- end page title -->
										<?php } ?>
									</div>
									<?php if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
										?>
										<!-- start breadcrumb -->
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<!-- end breadcrumb -->
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'separate-breadcrumbs':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-center justify-content-center' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) && ! empty( $litho_title_bg_image_url ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-12 col-xl-6 col-lg-7 col-md-10 text-center">
									<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
										<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $litho_subtitle ); ?></span>
										<!-- end sub title -->
									<?php } ?>
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
										<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php
											echo esc_html( $litho_title );
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<!-- end page title -->
									<?php } ?>
									<?php if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
										?>
										<!-- start breadcrumb -->
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<!-- end breadcrumb -->
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'gallery-background':
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-center justify-content-center one-third-screen' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-12 col-xl-6 col-lg-7 col-md-10 page-title-large text-center">
									<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
										<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $litho_subtitle ); ?></span>
										<!-- end sub title -->
									<?php } ?>
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
										<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											echo esc_html( $litho_title );
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<!-- end page title -->
									<?php } ?>

									<?php if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
										?>
										<!-- start breadcrumb -->
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<!-- end breadcrumb -->
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
								</div>		
								<?php if ( 'yes' === $litho_page_title_scroll_to_down ) { ?>
									<div class="down-section text-center">
										<a href="<?php echo sprintf( '#%s', $litho_title_callto_section_id ); ?>" class="section-link elementor-icon">
											<?php
											if ( ! empty( $litho_icon ) ) {
												echo sprintf( '%s', $litho_icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											} else {
											?>
												<i class="ti-arrow-down"></i>
											<?php } ?>
											<span class="elementor-screen-only"><?php echo esc_html__( 'Scroll Down', 'litho-addons' ); ?></span>
										</a>
									</div>
								<?php } ?>							
							</div>
						</div>
						<?php if ( is_array( $litho_bg_multiple_image ) && ! empty( $litho_bg_multiple_image ) ) { ?>
							<div class="swiper page-title-slider">
								<div class="swiper-wrapper">
									<?php
										foreach ( $litho_bg_multiple_image as $id ) {
											$litho_image_url 	= wp_get_attachment_image_url( $id, 'full' );
											$litho_bg_url 		= ( $litho_image_url ) ? ' style="background-image:url(' . esc_url( $litho_image_url ).');"' : '';
											?>
										<div class="swiper-slide cover-background"<?php echo sprintf( '%s', $litho_bg_url ); ?>></div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
				case 'background-video':
					$this->add_render_attribute( 'main-title-wrapper', [
						'class' => [ 'one-third-screen' ]
					] );
					$this->add_render_attribute( 'main-row', [
						'class' => [ 'row align-items-end justify-content-center one-third-screen' ]
					] );
					?>
					<div <?php $this->print_render_attribute_string( 'main-title-wrapper' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( 'yes' === $this->get_settings( 'litho_background_overlay' ) ) {
							?><div class="background-overlay litho-overlay"></div><?php
						}
						?>
						<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<div <?php $this->print_render_attribute_string( 'main-row' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="col-12 col-xl-6 col-lg-7 col-md-10 text-center">
									<?php if ( 'yes' === $litho_subtitle_enable && $litho_subtitle ) { ?>
										<!-- start sub title -->
										<span <?php $this->print_render_attribute_string( 'subtitle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $litho_subtitle ); ?></span>
										<!-- end sub title -->
									<?php } ?>
									<?php if ( 'yes' === $litho_page_enable_title_heading && $litho_title ) { ?>
										<!-- start page title -->
										<<?php echo $this->get_settings( 'litho_header_size' ); ?>  <?php $this->print_render_attribute_string( 'title' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											echo esc_html( $litho_title );
										?></<?php echo $this->get_settings( 'litho_header_size' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
										<!-- end page title -->
									<?php } ?>
									<?php
									if ( 'yes' === $litho_enable_breadcrumb && 'title-area' === $litho_breadcrumb_position ) {
									?>
										<!-- start breadcrumb -->
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
										<!-- end breadcrumb -->
										<?php
									}
									?>
									<?php if ( ! empty( $litho_single_post_meta_output ) && 'after-title-area' === $litho_breadcrumb_position ) { ?>
										<div class="litho-single-post-meta vertical-align-middle">
											<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>
									<span class="page-title-separator-line"></span>
								</div>
							</div>
						</div>
						<?php
						if ( 'self' == $litho_page_title_video_type && ( $litho_title_video_mp4 || $litho_title_video_ogg || $litho_title_video_webm ) ) {
							?>
							<video <?php $this->print_render_attribute_string( 'video' ); ?> playsinline>
								<?php if ( $litho_title_video_mp4 ) { ?>
									<source type="video/mp4" src="<?php echo esc_url( $litho_title_video_mp4 ); ?>" />
								<?php } ?>
								<?php if ( $litho_title_video_ogg ) { ?>
									<source type="video/ogg" src="<?php echo esc_url( $litho_title_video_ogg ); ?>" />
								<?php } ?>
								<?php if ( $litho_title_video_webm ) { ?>
									<source type="video/webm" src="<?php echo esc_url( $litho_title_video_webm ); ?>" />
								<?php } ?>
							</video>
							<?php
						} elseif ( 'external' == $litho_page_title_video_type && ( $litho_title_video_youtube ) ) {
						?>
							<div class="external-fit-videos fit-videos width-100">
								<iframe width="540" height="315" src="<?php echo esc_url( $litho_title_video_youtube ); ?>" allowfullscreen allow="autoplay; fullscreen"></iframe>
							</div>
						<?php } ?>
					</div>
					<?php if ( 'yes' === $litho_enable_breadcrumb && 'after-title-area' === $litho_breadcrumb_position ) {
						?>
						<div <?php $this->print_render_attribute_string( 'main-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div <?php $this->print_render_attribute_string( 'main-container' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<div class="row">
									<div class="col-12">
										<ul <?php $this->print_render_attribute_string( 'title-breadcrumb' ); ?><?php echo sprintf( '%s', $litho_breadcrumb_attribute ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					break;
			}
		}
		
		public function litho_is_editor_mode() {

			if ( Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode() || is_singular( 'sectionbuilder' ) ) {
				return true;
			} else {
				return false;
			}
		}
	}
}
