<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
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
 * Litho widget for blog post slider.
 *
 * @package Litho
 */

// If class `Blog_Post_Slider` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Blog_Post_Slider' ) ) {
	
	class Blog_Post_Slider extends Widget_Base {

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
			return 'litho-blog-post-slider';
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
			return __( 'Litho Blog Post Slider', 'litho-addons' );
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
			return 'eicon-posts-carousel';
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
		 * Get button sizes.
		 *
		 * Retrieve an array of button sizes for the button widget.
		 *
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
		 *
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'blog', 'slider', 'post', 'carousel'];
		}

		/**
		 * Register blog post slider widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_blog_content',
				[
					'label'     => __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_blog_style',
				[
					'label'         => __( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'blog-carousel-style-1',
					'options'       => [
						'blog-carousel-style-1'	=> __( 'Style 1', 'litho-addons' ),
						'blog-carousel-style-2'	=> __( 'Style 2', 'litho-addons' ),
						'blog-carousel-style-3'	=> __( 'Style 3', 'litho-addons' ),
						'blog-carousel-style-4'	=> __( 'Style 4', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_post_data_source',
				[
					'label'		=> __( 'Source', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'categories',
					'options'	=> [
						'categories'	=> __( 'Categories', 'litho-addons' ),
						'tags'			=> __( 'Tags', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_categories_list',
				[
					'label'         => __( 'Categories', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_post_category_array' ) ) ? litho_post_category_array() : [],
					'condition'     => [ 'litho_post_data_source' => 'categories' ],
				]
			);
			$this->add_control(
				'litho_tags_list',
				[
					'label'         => __( 'Tags', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_post_tags_array' ) ) ? litho_post_tags_array() : [],
					'condition'     => [ 'litho_post_data_source' => 'tags' ],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_settings',
				[
					'label'     => __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_ignore_sticky_posts',
				[
					'label'         => __( 'Ignore Sticky Posts', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'          => 'litho_thumbnail',
					'default'       => 'full',
					'exclude'	=> [ 'custom' ],
					'separator'     => 'none',
				]
			);
			$this->add_control(
				'litho_post_per_page',
				[
					'label'         => __( 'Number of posts to show', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'default'       => 3,
				]
			);
			$this->add_control(
				'litho_show_post_title',
				[
					'label'         => __( 'Post Title', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
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
					'default' 		=> 'span',
					'condition'     => [ 'litho_show_post_title' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_show_post_author',
				[
					'label'         => __( 'Post Author', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition' => [
						'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_show_post_author_image',
				[
					'label'         => __( 'Post Author Image', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'condition'     => [ 
						'litho_show_post_author' => 'yes',
						'litho_blog_style' => [ 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_show_post_author_text',
				[
					'label'         => __( 'Post Author Text', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'default'       => 'By&nbsp;',
					'condition'     => [ 
						'litho_show_post_author' => 'yes',
						'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_show_post_date',
				[
					'label'         => __( 'Post Date', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition' => [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->add_control(
				'litho_post_date_format',
				[
					'label'         => __( 'Post Date Format', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'default'       => '',
					'description'   => sprintf(
										'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
										esc_html__( 'Date format should be like F j, Y', 'litho-addons' ),
										esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
										esc_html__( 'click here', 'litho-addons' ),
										esc_html__( 'to see other date formates.', 'litho-addons' )
									),
					'condition'     => [
						'litho_show_post_date' => 'yes',
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->add_control(
				'litho_show_post_read_more_button',
				[
					'label'         => __( 'Read More', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'condition'     => [
						'litho_blog_style' => 'blog-carousel-style-2', // IN
					],
				]
			);
			$this->add_control(
				'litho_post_read_more_button_text',
				[
					'label'			=> __( 'Read More Text', 'litho-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'default'		=> __( 'Read More', 'litho-addons' ),
					'condition'     => [
						'litho_show_post_read_more_button' => 'yes',
						'litho_blog_style' => 'blog-carousel-style-2', // IN
					],
				]
			);
			$this->add_control(
				'litho_show_post_category',
				[
					'label'         => __( 'Post Terms', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [
						'litho_blog_style!' => 'blog-carousel-style-4', // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_post_terms',
				[
					'label'   => __( 'Select Post Terms', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'category',
					'options' => [
						'category' => __( 'Category', 'litho-addons' ),
						'tags'     => __( 'Tags', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_show_post_category' => 'yes',
						'litho_blog_style!' => 'blog-carousel-style-4', // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_orderby',
				[
					'label'         => __( 'Posts order by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'date',
					'options'       => [
						'date'          => __( 'Date', 'litho-addons' ),
						'ID'            => __( 'ID', 'litho-addons' ),
						'author'        => __( 'Author', 'litho-addons' ),
						'title'         => __( 'Title', 'litho-addons' ),
						'modified'      => __( 'Modified', 'litho-addons' ),
						'rand'          => __( 'Random', 'litho-addons' ),
						'comment_count' => __( 'Comment count', 'litho-addons' ),
						'menu_order'    => __( 'Menu order', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_order',
				[
					'label'         => __( 'Posts sort by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'DESC',
					'options'       => [
						'DESC'          => __( 'Descending', 'litho-addons' ),
						'ASC'           => __( 'Ascending', 'litho-addons' ),
					],
				]
			);
			
			$this->add_control(
				'litho_post_meta_separator_heading',
				[
					'label'         => __( 'Post Meta Separator', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
					'condition'     => [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->add_control(
				'litho_post_meta_separator',
				[
					'label'         => __( 'Meta Separator', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
					    'active' => true
					],
					'default'       => '|',
					'condition'     => [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_button',
				[
					'label' 			=> __( 'Read More Button', 'litho-addons' ),
					'condition'     => [
						'litho_show_post_read_more_button' => 'yes',
						'litho_blog_style' => 'blog-carousel-style-2', // IN
					],
				]
			);
			$this->add_control(
				'litho_size',
				[
					'label' 			=> __( 'Button Size', 'litho-addons' ),
					'type' 				=> Controls_Manager::SELECT,
					'default' 			=> 'xs',
					'options' 			=> self::get_button_sizes(),// phpcs:ignore
					'style_transfer' 	=> true,
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
					]
				]
			);
			$this->add_responsive_control(
				'litho_icon_left_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [
						'litho_selected_icon[value]!' => '',
						'litho_icon_align'	=> 'left',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_right_spacing',
				[
					'label' 		=> __( 'Spacing', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 150 ] ],
					'selectors' 	=> [
						'{{WRAPPER}} .swiper-slide .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}}',
					],
					'condition' 	=> [
						'litho_selected_icon[value]!' => '',
						'litho_icon_align'	=> 'right'
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_post_slider_config',
				[
					'label'         => __( 'Slider Configuration', 'litho-addons' )
				]
			);
			$slides_to_show = range( 1, 10 );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
			
			$this->add_responsive_control(
				'litho_slides_to_show',
				[
					'label'         => __( 'Slides to Show', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 2,
					'options'       => [
						''          => __( 'Default', 'litho-addons' ),
					] + $slides_to_show,
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_items_spacing',
				[
					'label'         => __( 'Items Spacing', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px' ],
					'range'         => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
					'default'       => [ 'unit' => 'px', 'size' => 30 ],
				]
			);
			$this->add_control(
				'litho_image_stretch',
				[
					'label'        => __( 'Image Stretch', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_navigation',
				[
					'label'         => __( 'Navigation', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'both',
					'options'       => [
						'both'          => __( 'Arrows and Dots', 'litho-addons' ),
						'arrows'        => __( 'Arrows', 'litho-addons' ),
						'dots'          => __( 'Dots', 'litho-addons' ),
						'none'          => __( 'None', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_pause_on_hover',
				[
					'label'         => __( 'Pause on Hover', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_centered_slides',
				[
					'label' 		=> __( 'Center Slide', 'litho-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'default' 		=> 'yes',
					'frontend_available' => true,
					'condition' => [
						'litho_slides_to_show!' => '1',
						'litho_blog_style' => [ 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_autoplay',
				[
					'label'         => __( 'Autoplay', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_autoplay_speed',
				[
					'label'         => __( 'Autoplay Speed', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => 5000,
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_infinite',
				[
					'label'         => __( 'Infinite Loop', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_effect',
				[
					'label'         => __( 'Effect', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'slide',
					'options'       => [
						'slide'         => __( 'Slide', 'litho-addons' ),
						'fade'          => __( 'Fade', 'litho-addons' ),
					],              
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_speed',
				[
					'label'         => __( 'Animation Speed', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => 500,
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_rtl',
				[
					'label'         => __( 'RTL', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'ltr',
					'options'       => [
						''      => __( 'Default', 'litho-addons' ),
						'ltr'   => __( 'Left', 'litho-addons' ),
						'rtl'   => __( 'Right', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_slider_cursor',
				[
					'label'         => __( 'Cursor', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						''              => __( 'Default', 'litho-addons' ),
						'white-cursor'  => __( 'White Cursor', 'litho-addons' ),
						'black-cursor'  => __( 'Black Cursor', 'litho-addons' ),
					],
					'frontend_available' => true,
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
						'value' 		=> 'fas fa-chevron-left',
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
						'value' 		=> 'fas fa-chevron-right',
						'library' 		=> 'fa-solid',
					],
					'condition' => [
						'litho_navigation' => [ 'both', 'arrows' ],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_post_slide_general_style',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_responsive_control(
				'litho_blog_post_slider_content_box_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'center',
					'options'       => [
						'left'          => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'        => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'         => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->start_controls_tabs( 'litho_blog_post_slider_content_box_tabs' );
				$this->start_controls_tab( 'litho_blog_post_slider_content_box_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_blog_post_slider_content_box_bg_color',
							'selector'      => '{{WRAPPER}} .slider-typography',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_post_slider_content_box_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'          => 'litho_blog_post_slider_content_box_bg_hover_color',
							'selector'      => '{{WRAPPER}} .swiper-slide:hover .slider-typography',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_blog_post_slider_content_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_post_slide_content_box_style',
				[
					'label'         => __( 'Slide Content box', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [
						'litho_blog_style!' => [ 'blog-carousel-style-1', 'blog-carousel-style-4' ], // NOT IN
					],
				]
			);

			$this->add_responsive_control(
				'litho_section_blog_post_slide_content_box_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 600 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .slider-inner-wrap' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_blog_style'	=> [ 'blog-carousel-style-2' ], // IN
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_blog_post_slide_content_box_bg_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .slider-typography .slider-inner-wrap',
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-carousel-style-2', 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_blog_post_slide_content_box_inner_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .slider-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before',
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-carousel-style-2', 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_blog_post_slide_content_box_inner_box_shadow',
					'selector' 		=> '{{WRAPPER}} .slider-typography .slider-inner-wrap',
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-carousel-style-2', 'blog-carousel-style-3' ], // IN
					],
				]
			);
			
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_post_slide_image_style',
				[
					'label'         => __( 'Slide', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_image_border',
					'selector'      => '{{WRAPPER}} .swiper-slide',
				]
			);
			$this->add_responsive_control(
				'litho_image_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_post_slide_title_style',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 'litho_show_post_title' => 'yes' ],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'litho_blog_post_slider_title_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'          => '{{WRAPPER}} .slider-typography .entry-title',
				]      
			);
			$this->start_controls_tabs( 'litho_blog_post_slider_title_tabs' );
				$this->start_controls_tab( 'litho_blog_post_slider_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_blog_post_slider_title_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .slider-typography .entry-title, {{WRAPPER}} .slider-typography a.entry-title' => 'color: {{VALUE}};',
							]
						]
					);  
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_post_slider_title_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_blog_post_slider_title_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .slider-typography a.entry-title:hover, {{WRAPPER}} .slider-typography .entry-title:hover' => 'color: {{VALUE}};',
							] 
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_blog_post_slider_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_blog_post_slider_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blog_post_slider_category_meta_style_section',
				[
					'label'         => __( 'Post Meta Category', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'		=> [
						'litho_show_post_category' => 'yes',
						'litho_blog_style!' 		=> 'blog-carousel-style-4', // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'			=> 'litho_blog_post_slider_category_meta_typography',
					'selector'		=> '{{WRAPPER}} .slider-typography .blog-category, {{WRAPPER}} .slider-typography .blog-category a',
				]
			);
			$this->start_controls_tabs( 'litho_blog_post_slider_category_meta_tabs' );
				$this->start_controls_tab( 'litho_blog_post_slider_category_meta_normal_tab',
					[
						'label'			=> __( 'Normal', 'litho-addons' ),
					] );
					$this->add_control(
						'litho_blog_post_slider_category_meta_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .slider-typography .blog-category, {{WRAPPER}} .slider-typography .blog-category a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'litho_blog_post_slider_category_meta_before_border_color',
						[
							'label'         => __( 'Border Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .slider-typography .blog-category a::before' => 'background-color: {{VALUE}};',
							],
							'condition' => [
								'litho_blog_style' 		=> [ 'blog-carousel-style-2' ], // IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_blog_post_slider_category_meta_bg_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .slider-typography .blog-category',
							'condition'		=> [
								'litho_blog_style'	=> [ 'blog-carousel-style-3' ], // IN
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_post_slider_category_meta_hover_tab',
					[
						'label'			=> __( 'Hover', 'litho-addons' ),
					] );
					$this->add_control(
						'litho_blog_post_slider_category_meta_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .slider-typography .blog-category:hover a'    => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_blog_post_slider_category_meta_hover_bg_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .slider-typography .blog-category:hover',
							'condition' 	=> [
								'litho_blog_style'	=> [ 'blog-carousel-style-3' ], // IN
							],
						]
					);
					$this->add_control(
						'litho_blog_post_slider_category_meta_hover_border_color',
						[
							'label'         => __( 'Border Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .slider-typography .blog-category a:hover'    => 'border-color: {{VALUE}};',
							],
							'condition' => [
								'litho_blog_style' => 'blog-carousel-style-3', // IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_blog_post_slider_category_meta_right_border_color',
				[
					'label'         => __( 'Separator Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .blog-carousel-style-1 .post-meta' => 'border-right-color: {{VALUE}};',
					],
					'separator'		=> 'before',
					'condition'		=> [
						'litho_blog_style' => 'blog-carousel-style-1', // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_post_slider_category_meta_spacing',
				[
					'label'         => __( 'Spacing', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 100 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'default'       => [ 'unit' => 'px', 'size' => 30 ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .blog-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'		=> 'before',
					'condition' 	=> [
						'litho_blog_style'	=> [ 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_blog_post_slider_category_meta_border',
					'selector'      => '{{WRAPPER}} .slider-typography .blog-category a',
					'condition' => [
						'litho_blog_style' => [ 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_blog_post_slider_category_meta_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .blog-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_blog_style'		=> [ 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_blog_post_slider_category_meta_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .blog-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'		=> [
						'litho_blog_style'	=> [ 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_blog_post_slider_category_meta_box_shadow',
					'selector' 		=> '{{WRAPPER}} .slider-typography .blog-category',
					'condition'		=> [
						'litho_blog_style' => [ 'blog-carousel-style-3' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blog_post_slider_author_meta_style_section',
				[
					'label'         => __( 'Post Meta Author', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'		=> [
						'litho_show_post_author'	=> 'yes',
						'litho_blog_style' 		=> [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'litho_blog_post_slider_author_meta_typography',
					'selector'          => '{{WRAPPER}} .slider-typography .author-name, {{WRAPPER}} .slider-typography .author-name a',
					'condition' => [
						'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					],
				]
			);
			$this->start_controls_tabs( 'litho_blog_post_slider_author_meta_tabs' );
				$this->start_controls_tab( 'litho_blog_post_slider_author_meta_normal_tab', [ 
					'label' => __( 'Normal', 'litho-addons' ),
					'condition' => [
						'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					],

				] );
					$this->add_control(
						'litho_blog_post_slider_author_meta_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .slider-typography .author-name, {{WRAPPER}} .slider-typography .author-name a' => 'color: {{VALUE}};',
							],
							'condition' => [
								'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_post_slider_author_meta_hover_tab', [ 
					'label' => __( 'Hover', 'litho-addons' ),
					'condition' => [
						'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					],
				] );
					$this->add_control(
						'litho_blog_post_slider_author_meta_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .slider-typography .author-name a:hover'    => 'color: {{VALUE}};',
							],
							'condition' => [
								'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blog_post_slider_date_meta_style_section',
				[
					'label'         => __( 'Post Meta Date', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'		=> [
						'litho_show_post_date' => 'yes',
						'litho_blog_style' 	=> 'blog-carousel-style-3', // IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'litho_blog_post_slider_date_meta_typography',
					'selector'          => '{{WRAPPER}} .slider-typography .post-date, {{WRAPPER}} .slider-typography .post-date a',
					'condition' => [
						'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_blog_post_slider_date_meta_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .slider-typography .post-date, {{WRAPPER}} .slider-typography .post-date a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'litho_blog_style' => [ 'blog-carousel-style-3', 'blog-carousel-style-4' ], // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_blog_post_slider_meta_separator_style_section',
				[
					'label'         => __( 'Post Meta Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'		=> [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_post_meta_separator_vertical_align_settings' ,
				[
					'label'        	=> __( 'Vertical Align', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'default'		=> 'middle',
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'top' 			=> __( 'Top', 'litho-addons' ),
						'middle' 		=> __( 'Middle', 'litho-addons' ),
						'bottom' 		=> __( 'Bottom', 'litho-addons' ),
						'space-between' => __( 'Space Between', 'litho-addons' ),
						'space-around' 	=> __( 'Space Around', 'litho-addons' ),
						'space-evenly' 	=> __( 'Space Evenly', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .post-meta-separator' => 'vertical-align: {{VALUE}}',
					],
					'condition'		=> [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'			=> 'litho_post_meta_separator_typography',
					'exclude' 		=> [
						'text_transform',
						'text_decoration',
						'letter_spacing'
					],
					'condition'		=> [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->add_control(
				'litho_post_meta_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .post-meta-separator' => 'color: {{VALUE}};',
					],
					'condition' => [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_post_meta_separator_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'placeholder'   => [
						'top'       => 'auto',
						'right'     => '',
						'bottom'    => 'auto',
						'left'      => '',
					],
					'selectors'     => [
						'{{WRAPPER}} .post-meta-separator' => 'margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}};',
					],
					'allowed_dimensions' => 'horizontal',
					'condition' => [
						'litho_blog_style' => 'blog-carousel-style-3', // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_button',
				[
					'label' 			=> __( 'Read More Button', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_show_post_read_more_button' => 'yes',
						'litho_blog_style' => 'blog-carousel-style-2', // IN
					],
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
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
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
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} a.elementor-button:hover svg, {{WRAPPER}} .elementor-button:hover svg, {{WRAPPER}} a.elementor-button:focus svg, {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
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
					'selector' 			=> '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus',
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
						'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_hover_box_shadow',
					'selector' 		=> '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover',
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
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
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_border',
					'selector' 		=> '{{WRAPPER}} .elementor-button',
					'fields_options' => [
						'border' 	=> [
							'separator' => 'before',
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
			$this->add_responsive_control(
				'litho_text_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_navigation',
				[
					'label' 			=> __( 'Navigation', 'litho-addons' ),
					'tab' 				=> Controls_Manager::TAB_STYLE,
					'condition' 		=> [
						'litho_navigation'		=> [ 'arrows', 'dots', 'both' ],
					],
				]
			);
			$this->add_control(
				'litho_heading_style_arrows',
				[
					'label' 		=> __( 'Arrows style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
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
						'custom' 	=> __( 'Custom', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-arrows-position-',
					'condition' => [
						'litho_blog_style!' => 'blog-carousel-style-1', // NOT IN
						'litho_navigation' => [ 'arrows', 'both' ]
					],
				]
			);
			$this->add_responsive_control(
				'litho_arrows_custom_position',
				[
					'label' 		=> __( 'Custom Position', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => -1000, 'max' => 1000 ] ],
					'selectors' 	=> [
						'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.elementor-arrows-position-custom .elementor-swiper-button.elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_arrows_position' 	=> 'custom',
						'litho_navigation'			=> [ 'arrows', 'both' ],
					],
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
				'litho_heading_style_dots',
				[
					'label' 		=> __( 'Dots style', 'litho-addons' ),
					'type' 			=> Controls_Manager::HEADING,
					'separator' 	=> 'before',
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
						'outside' 		=> __( 'Outside', 'litho-addons' ),
						'inside' 		=> __( 'Inside', 'litho-addons' ),
					],
					'prefix_class' 	=> 'elementor-pagination-position-',
					'condition' 	=> [ 'litho_navigation' 	=> [ 'dots', 'both' ] ],
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
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 30 ],
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
					$this->add_responsive_control(
						'litho_dots_margin',
						[
							'label'      	=> __( 'Margin', 'litho-addons' ),
							'type'       	=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors'  	=> [
								'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
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
							'range' 		=> [ 'px'	=> [ 'min' 	=> 5, 'max' => 30 ],
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
							'name'        	=> 'litho_dots_active_border',
							'default'       => '1px',
							'selector'    	=> '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
							'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
						]
					);
				$this->add_responsive_control(
					'litho_dots_active_margin',
					[
						'label'      	=> __( 'Margin', 'litho-addons' ),
						'type'       	=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'  	=> [
							'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'condition' 	=> [ 'litho_navigation' => [ 'dots', 'both' ] ],
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * Register blog post slider widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function render() {
			
			$settings                         = $this->get_settings_for_display();
			$migrated                         = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
			$is_new                           = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$litho_blog_style                 = $this->get_settings( 'litho_blog_style' );
			$litho_post_data_source           = $this->get_settings( 'litho_post_data_source' );
			$litho_categories_list            = $this->get_settings( 'litho_categories_list' );
			$litho_tags_list                  = $this->get_settings( 'litho_tags_list' );
			$litho_post_per_page              = $this->get_settings( 'litho_post_per_page' );
			$litho_thumbnail                  = $this->get_settings( 'litho_thumbnail' );
			$litho_ignore_sticky_posts        = $this->get_settings( 'litho_ignore_sticky_posts' );
			$litho_show_post_title            = $this->get_settings( 'litho_show_post_title' );
			$litho_show_post_author           = $this->get_settings( 'litho_show_post_author' );
			$litho_show_post_author_image     = $this->get_settings( 'litho_show_post_author_image' );
			$litho_show_post_author_text      = $this->get_settings( 'litho_show_post_author_text' );
			$litho_show_post_read_more_button = $this->get_settings( 'litho_show_post_read_more_button' );
			$litho_show_post_date             = $this->get_settings( 'litho_show_post_date' );
			$litho_show_post_category         = $this->get_settings( 'litho_show_post_category' );
			$litho_post_terms                 = $this->get_settings( 'litho_post_terms' );
			$litho_post_read_more_button_text = $this->get_settings( 'litho_post_read_more_button_text' );
			$litho_post_date_format           = $this->get_settings( 'litho_post_date_format' );
			$litho_orderby                    = $this->get_settings( 'litho_orderby' );
			$litho_order                      = $this->get_settings( 'litho_order' );
			$litho_post_meta_separator        = $this->get_settings( 'litho_post_meta_separator' );

			if ( $litho_post_meta_separator ) {
				$litho_post_meta_separator = '<span class="post-meta-separator">' . esc_html( $litho_post_meta_separator ) . '</span>';
			}

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' ); 
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' ); 
			} else {
				$paged = 1;
			}

			$query_args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => intval( $litho_post_per_page ),
				'paged'          => $paged,
			);
			if ( 'tags' === $litho_post_data_source ) {
				if ( ! empty( $litho_tags_list ) ) {
					$query_args['tag_slug__in'] = $litho_tags_list;
				}
			} else {
				if ( ! empty( $litho_categories_list ) ) {
					$query_args['category_name'] = implode( ',', $litho_categories_list );
				}
			}

			if ( ! empty( $litho_orderby ) ) {
				$query_args[ 'orderby' ] = $litho_orderby;
			}
			if ( ! empty( $litho_order ) ) {
				$query_args[ 'order' ] = $litho_order;
			}

			if ( 'yes' === $litho_ignore_sticky_posts ) {
				$query_args['ignore_sticky_posts'] = true;
				$query_args['post__not_in']        = get_option( 'sticky_posts' );
			}

			$blog_query = new \WP_Query( $query_args );

			if ( $blog_query->have_posts() ) {

					$slides       = [];
					$slides_count = '';
					$id_int       = substr( $this->get_id_int(), 0, 3 );

					// For button
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

					//Custom button hover effect
					$hover_animation_effect_array = litho_custom_hover_animation_effect();

					$index = 0;
					while ( $blog_query->have_posts() ) :
						$blog_query->the_post();

						$image_url         = '';
						$inner_wrapper_key = '_inner_wrapper_' . $index;
						$link_key          = 'link_' . $index;
						$btn_wrapper_key   = 'btn_' . $index;
						$thumbnail_id      = get_post_thumbnail_id( get_the_ID() );

						if ( has_post_thumbnail() ) {
							$image_url = Group_Control_Image_Size::get_attachment_image_src( $thumbnail_id, 'litho_thumbnail', $settings );
							
						} else {
							$image_url = Utils::get_placeholder_image_src();
						}

						$image_url = ( ! empty( $image_url ) ) ? 'background-image: url(' . esc_url( $image_url ) . '); background-repeat: no-repeat;' : '';

						$post_meta_array = array();
						$post_term_arr   = array();

						if ( 'category' === $litho_post_terms ) {
							$categories      = get_the_category();
							if ( $categories && ! is_wp_error( $categories ) ) {
								foreach ( $categories as $cat ) {
									$cat_link   = get_category_link( $cat->cat_ID );
									$post_term_arr[] = '<a href="' . esc_url( $cat_link ) . '" rel="blog-category">' . esc_html( $cat->name ) . '</a>';
								}
							}
						} else {
							$tags = get_the_tags();
							if ( ! empty( $tags ) ) {
								foreach ( $tags as $tag ) {
									$tag_link   = get_tag_link( $tag->term_id );
									$post_term_arr[] = '<a href="' . esc_url( $tag_link ) . '" rel="blog-category">' . esc_html( $tag->name ) . '</a>';
								}
							}
						}

						$post_terms = implode( ', ', $post_term_arr );

						if ( 'yes' === $litho_show_post_category ) {
							$post_meta_array[] = $post_terms;
						}

						$this->add_render_attribute( [
							$btn_wrapper_key => [
								'class' => [ 'elementor-button-wrapper', 'litho-button-wrapper' ] ]
						] );

						$this->add_render_attribute( $link_key, 'href', get_permalink() );
						$this->add_render_attribute( $link_key, 'class', 'elementor-button-link elementor-button blog-post-button' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						if ( ! empty( $this->get_settings( 'litho_size' ) ) ) {
							$this->add_render_attribute( $link_key, 'class', 'elementor-size-' . $this->get_settings( 'litho_size' ) );
						}

						if ( ! empty( $this->get_settings( 'litho_hover_animation' ) ) ) {
							$custom_animation_class = '';
							$this->add_render_attribute( $link_key, 'class', [ 'hvr-' . $this->get_settings( 'litho_hover_animation' ) ] );
							if ( in_array( $this->get_settings( 'litho_hover_animation' ), $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
							$this->add_render_attribute( $link_key, 'class', [ $custom_animation_class ] );
						}

						if ( 'blog-carousel-style-4' === $litho_blog_style ) {

							$this->add_render_attribute( $inner_wrapper_key, [
								'class' => [ 'elementor-repeater-item-' . get_the_ID(), 'swiper-slide', 'blog-post' ],
							] );

						} else {
							
							$this->add_render_attribute( $inner_wrapper_key, [
								'class' => [ 'elementor-repeater-item-' . get_the_ID(), 'swiper-slide', 'blog-post', 'cover-background' ],
								'style' => $image_url
							] );
						}

						switch ( $litho_blog_style ) {
							case 'blog-carousel-style-1':
							default:
								ob_start();
								?>
								<div <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
									<?php if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_title ) { ?>
										<div class="slider-typography">
											<?php if ( ! empty( $post_meta_array ) ) { ?>
												<div class="post-meta blog-category">
													<?php echo implode( $litho_post_meta_separator, $post_meta_array ); // phpcs:ignore ?>
												</div>
											<?php } ?>
											<?php if ( 'yes' === $litho_show_post_title ) { ?>
												<<?php echo $this->get_settings( 'litho_header_size' ); ?>><a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a></<?php echo $this->get_settings( 'litho_header_size' ); ?>>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
								<?php
								$slides[] = ob_get_contents();
								ob_end_clean();
								break;
							case 'blog-carousel-style-2':
								ob_start();
								?>
								<div <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
									<?php if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_read_more_button ) { ?>
										<div class="slider-typography justify-content-center justify-content-md-start d-flex">
											<div class="slider-inner-wrap align-self-center">
												<?php if ( ! empty( $post_meta_array ) ) { ?>
													<div class="post-meta blog-category">
														<?php echo implode( $litho_post_meta_separator, $post_meta_array ); // phpcs:ignore ?>
													</div>
												<?php } ?>
												<?php if ( 'yes' === $litho_show_post_title ) { ?>
													<<?php echo $this->get_settings( 'litho_header_size' ); ?>><a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a></<?php echo $this->get_settings( 'litho_header_size' ); ?>>
												<?php } ?>
												<?php if ( 'yes' === $litho_show_post_read_more_button ) { ?>
													<div <?php $this->print_render_attribute_string( $btn_wrapper_key ); ?>>
														<a <?php $this->print_render_attribute_string( $link_key ); ?>>
															<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
																<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['litho_selected_icon']['value'] ) ) : ?>
																<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
																	<?php
																	if ( $is_new || $migrated ) {
																		Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
																	} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) { ?>
																		<i class="<?php echo esc_attr( $settings['litho_selected_icon'] ); ?>" aria-hidden="true"></i>
																	<?php
																	}
																	?>
																</span>
																<?php endif; ?>
																<span <?php $this->print_render_attribute_string( 'litho_text' ); // phpcs:ignore ?>><?php echo esc_html( $litho_post_read_more_button_text ); ?></span>
															</span>
														</a>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
								<?php
								$slides[] = ob_get_contents();
								ob_end_clean();
								break;
							case 'blog-carousel-style-3':
								ob_start();
								?>
								<div <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
									<?php if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_author ) { ?>
										<div class="slider-typography d-flex align-items-center align-items-lg-end">
											<div class="slider-inner-wrap">
												<?php if ( 'yes' === $litho_show_post_category ) { ?>
													<span class="blog-category">
														<?php echo litho_post_category( get_the_ID(), true, '1', $litho_post_terms ); // phpcs:ignore ?>
													</span>
												<?php } ?>
												<?php if ( 'yes' === $litho_show_post_title ) { ?>
													<<?php echo $this->get_settings( 'litho_header_size' ); ?>><a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a></<?php echo $this->get_settings( 'litho_header_size' ); ?>>
												<?php } ?>
												<?php if ( 'yes' === $litho_show_post_date ) { ?>
													<span class="post-date published"><?php echo esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ); ?></span><time class="updated d-none" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( $litho_post_date_format ) ); ?></time>
												<?php } ?>
												<?php if ( 'yes' === $litho_show_post_author && get_the_author() ) { ?>
													<?php
														if ( 'yes' === $litho_show_post_date ) {
															echo sprintf( '%s', $litho_post_meta_separator );  // phpcs:ignore
														}
													?>
													<span class="post-author-meta">
													   <?php
														if ( 'yes' === $litho_show_post_author_image ) {
															echo get_avatar( get_the_author_meta( 'ID' ), '30' );
														}
														?>
														<span class="author-name"><?php
															echo esc_html( $litho_show_post_author_text );
															?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
														</span>
													</span>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
								<?php
								$slides[] = ob_get_contents();
								ob_end_clean();
								break;
							case 'blog-carousel-style-4':
								ob_start();
								?>
								<div <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
									<?php if ( has_post_thumbnail() || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_author ) { ?>
										<div class="slider-typography">
											<div class="slider-inner-wrap">
												<?php
												if ( ! post_password_required() && has_post_thumbnail() ) {
													echo '<a href="' . get_permalink() . '">';
														echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );
													echo '</a>';
												}
												?>
												<?php if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_title ) { ?>
													<div class="title-content-box">
														<?php if ( 'yes' === $litho_show_post_author && get_the_author() ) { ?>
															<span class="post-author-meta">
																<span class="author-name"><?php
																	echo esc_html( $litho_show_post_author_text );
																	?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
																</span>
															</span>
														<?php } ?>
														<?php if ( 'yes' === $litho_show_post_title ) { ?>
																<<?php echo $this->get_settings( 'litho_header_size' ); ?>><a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a></<?php echo $this->get_settings( 'litho_header_size' ); ?>><?php // phpcs:ignore ?>
														<?php } ?>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
								<?php
								$slides[] = ob_get_contents();
								ob_end_clean();
								break;
						}
						$index++;
					endwhile;
					wp_reset_postdata();

					if ( empty( $slides ) ) {
						return;
					}
			
					$slides_count        = $blog_query->post_count;
					$litho_rtl           = $this->get_settings( 'litho_rtl' );
					$litho_slider_cursor = $this->get_settings( 'litho_slider_cursor' );
					$litho_navigation    = $this->get_settings( 'litho_navigation' );

					$sliderConfig = array(
						'navigation'            => $this->get_settings( 'litho_navigation' ),
						'autoplay'              => $this->get_settings( 'litho_autoplay' ),
						'autoplay_speed'        => $this->get_settings( 'litho_autoplay_speed' ),
						'pause_on_hover'        => $this->get_settings( 'litho_pause_on_hover' ),
						'loop'                  => $this->get_settings( 'litho_infinite' ),
						'effect'                => $this->get_settings( 'litho_effect' ),
						'speed'                 => $this->get_settings( 'litho_speed' ),
						'image_spacing'         => $this->get_settings( 'litho_items_spacing' ),
						'slides_to_show'        => $this->get_settings( 'litho_slides_to_show' ),
						'slides_to_show_mobile' => $this->get_settings( 'litho_slides_to_show_mobile' ),
						'slides_to_show_tablet' => $this->get_settings( 'litho_slides_to_show_tablet' ),
					);

					$slideOptions = array();

					switch ( $litho_blog_style ) {
						case 'blog-carousel-style-3':
							$slideOptions = array(
								'centered_slides' => $this->get_settings( 'litho_centered_slides' )
							);
							break;
					} 

					$slideSettingsArray = array_merge( $sliderConfig, $slideOptions );

					$this->add_render_attribute( [
						'carousel-wrapper' => [
							'class'         => [
								'blog-post-slider-wrapper',
								'swiper',
								$litho_blog_style,
								$litho_slider_cursor,
							],
							'data-settings' => json_encode( $slideSettingsArray ),
						],
						'carousel' => [
							'class' => 'blog-post-slider swiper-wrapper',
						],
					] );

					if ( ! empty( $litho_rtl ) ) {
						$this->add_render_attribute( 'carousel-wrapper', 'dir', $litho_rtl );
					}

					$show_dots   = ( in_array( $litho_navigation, [ 'dots', 'both' ] ) );
					$show_arrows = ( in_array( $litho_navigation, [ 'arrows', 'both' ] ) );

					if ( 'yes' ===  $this->get_settings( 'litho_image_stretch' ) ) {
						$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
					}

					$left_arrow_icon     = '';
					$right_arrow_icon    = '';
					$is_new              = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
					$left_icon_migrated  = isset( $settings['__fa4_migrated']['litho_left_arrow_icon'] );
					$right_icon_migrated = isset( $settings['__fa4_migrated']['litho_right_arrow_icon'] );

					if ( isset( $settings['litho_left_arrow_icon'] ) && ! empty( $settings['litho_left_arrow_icon'] ) ) {
						if ( $is_new || $left_icon_migrated ) {
							ob_start();
								Icons_Manager::render_icon( $settings['litho_left_arrow_icon'], [ 'aria-hidden' => 'true' ] );
							$left_arrow_icon .= ob_get_clean();
						} elseif ( isset( $settings['litho_left_arrow_icon']['value'] ) && ! empty( $settings['litho_left_arrow_icon']['value'] ) ) {
							$left_arrow_icon .= '<i class="' . esc_attr( $settings['litho_left_arrow_icon']['value'] ) . '" aria-hidden="true"></i>';
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
					?>
					<div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
						<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
							<?php echo implode( '', $slides ); // phpcs:ignore ?>
						</div>
						<?php if ( 1 < $slides_count ) { ?>
							<?php if ( $show_dots ) { ?>
								<div class="swiper-pagination"></div>
							<?php } ?>
							<?php if ( $show_arrows ) { ?>
								<div class="elementor-swiper-button elementor-swiper-button-prev">
									<?php if ( ! empty( $left_arrow_icon ) ) {
										echo sprintf( '%s', $left_arrow_icon ); // phpcs:ignore
									} else { ?>
										<i class="eicon-chevron-left" aria-hidden="true"></i>
									<?php } ?>
									<span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'litho-addons' ); ?></span>
								</div>
								<div class="elementor-swiper-button elementor-swiper-button-next">
									<?php if ( ! empty( $right_arrow_icon ) ) {
										echo sprintf( '%s', $right_arrow_icon ); // phpcs:ignore
									} else { ?>
										<i class="eicon-chevron-right" aria-hidden="true"></i>
									<?php } ?>
									<span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'litho-addons' ); ?></span>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				<?php
			}
		}
	}
}
