<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;
use LithoAddons\Controls\Groups\Column_Group_Control;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for blog list.
 *
 * @package Litho
 */

// If class `Blog_List` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Blog_List' ) ) {

	/**
	 * Define Blog_List class
	 */
	class Blog_List extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-blog-list';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Blog List', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-post-list';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 * @access public
		 *
		 * @return array Widget categories.
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
			return [ 'post', 'posts', 'cpt', 'loop', 'query', 'custom post type', 'blog', 'article' ];
		}

		/**
		 * Register blog list widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
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
					'default'       => 'blog-grid',
					'options'       => [
						'blog-grid'          => __( 'Grid', 'litho-addons' ),
						'blog-masonry'       => __( 'Masonry', 'litho-addons' ),
						'blog-classic'       => __( 'Classic', 'litho-addons' ),
						'blog-simple'        => __( 'Simple', 'litho-addons' ),
						'blog-side-image'    => __( 'Side Image', 'litho-addons' ),
						'blog-metro'         => __( 'Metro', 'litho-addons' ),
						'blog-overlay-image' => __( 'Overlay Image', 'litho-addons' ),
						'blog-modern'        => __( 'Modern', 'litho-addons' ),
						'blog-clean'         => __( 'Clean', 'litho-addons' ),
						'blog-widget'        => __( 'Widget', 'litho-addons' ),
						'blog-standard'      => __( 'Standard', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_post_type_source',
				[
					'label'   => __( 'Source', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'post',
					'options' => ( function_exists( 'litho_get_post_types' ) ) ? litho_get_post_types() : [],
				]
			);
			$this->add_control(
				'litho_post_type_selection',
				[
					'label'		=> __( 'Type of Selection', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'categories',
					'options'	=> [
						'categories'	=> __( 'Categories', 'litho-addons' ),
						'tags'			=> __( 'Tags', 'litho-addons' ),
					],
					'condition'     => [ 'litho_post_type_source' => 'post' ],
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
					'condition'     => [
						'litho_post_type_source' 		=> 'post',
						'litho_post_type_selection'	=> 'categories'
					],
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
					'condition'     => [
						'litho_post_type_source'    => 'post',
						'litho_post_type_selection' => 'tags'
					],
				]
			);
			$this->add_control(
				'litho_exclude_post_ids',
				[
					'label'       => __( 'Exclude Posts', 'litho-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,					
					'options' => ( function_exists( 'litho_post_array' ) ) ? litho_post_array() : [],
					'description' => __( 'You can use this option to remove certain posts from the list.', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_blog_metro_positions',
				[
					'label'         => __( 'Metro grid positions', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'description'   => __( 'Mention the positions (comma separated like 1, 4, 7) where that image will cover spacing of multiple columns and / or rows considering the image width and height.', 'litho-addons' ),
					'condition'     => [ 'litho_blog_style' => 'blog-metro' ],
				]
			);
			$this->add_group_control(
				Column_Group_Control::get_type(),
				[
					'name'		=> 'litho_column_settings',
					'condition' => [ 
						'litho_blog_style!' => 'blog-side-image', // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_columns_gap',
				[
					'label' 	=> __( 'Columns Gap', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size'	=> 15,
					],
					'range' 	=> [
						'px' => [
							'min'	=> 0,
							'max'	=> 100,
							'step'	=> 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} ul li.grid-gutter' => 'padding: {{SIZE}}{{UNIT}};'
					],
				]
			);
			$this->add_control(
				'litho_enable_masonry',
				[
					'label'     => esc_html__( 'Enable Masonry', 'litho-addons' ),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => esc_html__( 'Yes', 'litho-addons' ),
					'label_off' => esc_html__( 'No', 'litho-addons' ),
					'default'   => 'yes',
					'condition' => [ 
						'litho_blog_style!' => [
							'blog-masonry',
							'blog-side-image',
							'blog-metro',

						],
					],
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
			
			$this->add_control(
				'litho_post_per_page',
				[
					'label'         => __( 'Number of posts to show', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => 6,
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
				'litho_show_post_thumbnail',
				[
					'label'         => __( 'Post Thumbnail', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_thumbnail',
				[
					'label' 		=> __( 'Size', 'litho-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'full',					
					'options' => ( function_exists( 'litho_get_thumbnail_image_sizes' ) ) ? litho_get_thumbnail_image_sizes() : [],
					'style_transfer'=> true,
					'condition'     => [ 
						'litho_show_post_thumbnail' => 'yes'
					]
				]
			);
			$this->add_control(
				'litho_show_post_format',
				[
					'label'         => __( 'Post Featured Image Only', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __( 'If Off is selected then it will display block as per post format type like audio, video, gallery, etc… otherwise it will show post featured image no matter what is post format type.', 'litho-addons' ),
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [ 
						'litho_show_post_thumbnail' => 'yes',
						'litho_blog_style!' => [ 'blog-simple', 'blog-overlay-image', 'blog-clean', 'blog-widget' ] // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_show_post_thumbnail_icon',
				[
					'label'         => __( 'Post Type Icon', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'condition'     => [
						'litho_show_post_thumbnail' => 'yes',
						'litho_show_post_format'    => 'yes',
						'litho_blog_style!'         => [ 'blog-overlay-image', 'blog-clean' ] // NOT IN
					]
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
					'condition'     => [						
						'litho_blog_style!'	=> 'blog-overlay-image' // NOT IN
					]
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
						'litho_show_post_author'	=> 'yes',
						'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
					]
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
					'default'       => __( 'By&nbsp;', 'litho-addons' ),
					'condition'     => [
						'litho_show_post_author'	=> 'yes',
						'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
					]
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
					'description'   => sprintf(
						'%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s',
						esc_html__( 'Date format should be like F j, Y', 'litho-addons' ),
						esc_url( 'https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples' ),
						esc_html__( 'click here', 'litho-addons' ),
						esc_html__( 'to see other date formates.', 'litho-addons' )
					),
					'condition'     => [ 'litho_show_post_date' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_show_post_excerpt',
				[
					'label'         => __( 'Post Excerpt', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [
						'litho_blog_style!'	=> 'blog-overlay-image' // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_post_excerpt_length',
				[
					'label'         => __( 'Excerpt Length', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'min'           => 1,
					'default'       => 18,
					'condition'     => [
						'litho_show_post_excerpt'	=> 'yes',
						'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
					]
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
				]
			);
			$this->add_control(
				'litho_show_post_read_more_button_text',
				[
					'label'			=> __( 'Read More Text', 'litho-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default'		=> __( 'Read More', 'litho-addons' ),
					'condition'     => [ 'litho_show_post_read_more_button' => 'yes' ],
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
					],
				]
			);
			$this->add_control(
				'litho_show_post_category_text',
				[
					'label'			=> __( 'Post Category Text', 'litho-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default'		=> __( 'In&nbsp;', 'litho-addons' ),
					'condition' 	=> [
						'litho_show_post_category' => 'yes',
						'litho_blog_style' => [ 'blog-side-image' ],
					],
				]
			);

			$this->add_control(
				'litho_show_post_comments',
				[
					'label'         => __( 'Post Comments', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
				]
			);
			$this->add_control(
				'litho_show_post_comments_text',
				[
					'label'         => __( 'Show Comments Text', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'inline-block',
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .comment-link span.comment-text' => 'display: {{VALUE}} !important;',
					],
					'condition'     => [ 'litho_show_post_comments' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_show_post_like',
				[
					'label'         => __( 'Post Like', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
				]
			);
			$this->add_control(
				'litho_show_post_like_text',
				[
					'label'         => __( 'Show Like Text', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'inline-block',
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .blog-like span.posts-like' => 'display: {{VALUE}} !important;',
					],
					'condition'     => [ 'litho_show_post_like' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_separator',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [ 'litho_blog_style!' => [ 'blog-masonry', 'blog-overlay-image', 'blog-simple', 'blog-standard' ] ], // NOT IN
				]
			);
			$this->add_control(
				'litho_remove_order',
				[
					'label'         => __( 'Left/Right Post Position', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'     => [ 'litho_blog_style' => 'blog-side-image' ], // IN
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
				'litho_hover_icon',
				[
					'label'         => __( 'Hover Icon', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-clean' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_post_meta_separator_heading',
				[
					'label'         => __( 'Post Meta Separator', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ], // IN
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
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_blog_grid_animation',
				[
					'label'			=> __( 'Entrance Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::ANIMATION,
				]
			);
			$this->add_control(
				'litho_blog_grid_animation_duration',
				[
					'label'			=> __( 'Animation Duration', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'default'		=> '',
					'options'		=> [
							'slow'		=> __( 'Slow', 'litho-addons' ),
							''			=> __( 'Normal', 'litho-addons' ),
							'fast'		=> __( 'Fast', 'litho-addons' )
					],
					'condition'     => [
						'litho_blog_grid_animation!' => '',
					]
				]
			);
			$this->add_control(
				'litho_blog_grid_animation_delay',
				[
					'label'			=> __( 'Animation Delay', 'litho-addons' ),
					'type'			=> Controls_Manager::NUMBER,
					'default'		=> '',
					'min'			=> 0,
					'max'			=> 1500,
					'step' 			=> 50,
					'condition'     => [
						'litho_blog_grid_animation!' 	=> '',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_filter',
				[
					'label'			=> __( 'Filter', 'litho-addons' ),
					'show_label'	=> false,
					'condition'     => [
						'litho_post_type_source' 	=> 'post',
					],
				]
			);
			$this->add_control(
				'litho_enable_filter',
				[
					'label'         => __( 'Enable Filter', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => '',
				]
			);
			$this->add_control(
				'litho_filter_post_type_selection',
				[
					'label'		=> __( 'Type of Selection', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'category',
					'options'	=> [
						'category'	=> __( 'Categories', 'litho-addons' ),
						'post_tag'	=> __( 'Tags', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_filter_categories_list',
				[
					'label'         => __( 'Categories', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,					
					'options' => ( function_exists( 'litho_post_category_array' ) ) ? litho_post_category_array() : [],
					'condition'		=> [
						'litho_filter_post_type_selection'	=> 'category'
					]
				]
			);
			$this->add_control(
				'litho_filter_tags_list',
				[
					'label'         => __( 'Tags', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_post_tags_array' ) ) ? litho_post_tags_array() : [],
					'condition'		=> [
						'litho_filter_post_type_selection'	=> 'post_tag'
					]
				]
			);
			
			$this->add_control(
				'litho_default_category_selected',
				[
					'label'         => __( 'Select Default Categories Selected', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_post_category_array' ) ) ? litho_post_category_array() : [],
					'condition'     => [
						'litho_filter_post_type_selection'  => 'category'
					]
				]
			);
			$this->add_control(
				'litho_default_tags_selected',
				[
					'label'         => __( 'Select Default Tags Selected', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_post_tags_array' ) ) ? litho_post_tags_array() : [],
					'condition'     => [
						'litho_filter_post_type_selection'  => 'post_tag'
					]
				]
			);
			$this->add_control(
				'litho_categories_orderby',
				[
					'label'         => __( 'Order by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'id',
					'options'       => [
						'name'          => __( 'Name', 'litho-addons' ),
						'slug'          => __( 'Slug', 'litho-addons' ),
						'id'            => __( 'Id', 'litho-addons' ),
						'count'         => __( 'Count', 'litho-addons' )
					]
				]
			);
			$this->add_control(
				'litho_categories_order',
				[
					'label'         => __( 'Sort by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'DESC',
					'options'       => [                        
						'DESC'          => __( 'Descending', 'litho-addons' ),
						'ASC'           => __( 'Ascending', 'litho-addons' )
					]
				]
			);
			$this->add_control(
				'litho_show_all_text_filter',
				[
					'label'         => __( 'Show All Text Filter', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_show_all_label',
				[               
					'label'         => __( '`All` Filter Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default'       => __( 'All', 'litho-addons' ),
					'condition'     => [
						'litho_show_all_text_filter'  => 'yes'
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_pagination',
				[
					'label'         => __( 'Pagination', 'litho-addons' ),
					'show_label'    => false,
				]
			);

			$this->add_control(
				'litho_pagination',
				[
					'label'			=> __( 'Pagination', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'default'		=> '',
					'options'		=> [
						''								=> __( 'None', 'litho-addons' ),
						'number-pagination'				=> __( 'Number', 'litho-addons' ),
						'next-prev-pagination'			=> __( 'Next / Previous', 'litho-addons' ),
						'infinite-scroll-pagination'	=> __( 'Infinite Scroll', 'litho-addons' ),
						'load-more-pagination'			=> __( 'Load More', 'litho-addons' )
					],
					'description'	=> __( 'Changes will be reflected in the frontend only.', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_pagination_next_label',
				[
					'label'         => __( 'Next Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default'       => __( 'Next', 'litho-addons' ),
					'condition'     => [ 'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ] ],
				]
			);
			
			$this->add_control(
				'litho_pagination_next_icon',
				[
					'label' 		=> __( 'Next Icon', 'litho-addons' ),
					'type'		 	=> Controls_Manager::ICONS,
					'separator' 	=> 'before',
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-angle-right',
						'library' 		=> 'fa-solid',
					],
					'recommended' 	=> [
						'fa-solid' 	=> [
							'angle-right',
							'caret-square-right',
						],
						'fa-regular' => [
							'caret-square-right',
						],
					],
					'skin' 			=> 'inline',
					'exclude_inline_options' => 'svg',
					'label_block' 	=> false,
					'condition'     => [ 'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ] ],
				]
			);

			$this->add_control(
				'litho_pagination_prev_label',
				[
					'label'         => __( 'Previous Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default'       => __( 'Previous', 'litho-addons' ),
					'separator' 	=> 'before',
					'condition'     => [ 'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ] ],
				]
			);
			$this->add_control(
				'litho_pagination_prev_icon',
				[
					'label' 		=> __( 'Previous Icon', 'litho-addons' ),
					'type'		 	=> Controls_Manager::ICONS,
					'separator' 	=> 'before',
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-angle-left',
						'library' 		=> 'fa-solid',
					],
					'recommended' 	=> [
						'fa-solid' 	=> [
							'angle-left',
							'caret-square-left',
						],
						'fa-regular' => [
							'caret-square-left',
						],
					],
					'skin' 			=> 'inline',
					'exclude_inline_options' => 'svg',
					'label_block' 	=> false,
					'condition'     => [ 'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ] ],
				]
			);
			$this->add_control(
				'litho_pagination_load_more_button_label',
				[
					'label'         => __( 'Button Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default'       => __( 'Load more', 'litho-addons' ),
					'render_type'	=> 'template',
					'condition'     => [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_list_general_style',
				[
					'label'			=> __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_content_box_alignment',
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
					'condition'     => [ 'litho_blog_style!' => 'blog-classic' ], // NOT IN
				]
			);
			$this->start_controls_tabs( 'litho_blog_list_content_box_tabs' );
				$this->start_controls_tab( 'litho_blog_list_content_box_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_blog_list_content_box_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .blog-post',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 			=> 'litho_blog_list_blog_post_shadow',
							'selector' 		=> '{{WRAPPER}} .blog-post',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_blog_list_blog_post_border',
							'selector'      => '{{WRAPPER}} .blog-post',
						]
					);
					$this->add_responsive_control(
						'litho_blog_list_blog_post_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .blog-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'litho_blog_list_blog_post_content_shadow_title',
						[
							'label'     => __( 'Post Content Shadow', 'litho-addons' ),
							'type'      => Controls_Manager::HEADING,
							'condition' => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 			=> 'litho_blog_list_blog_post_content_shadow',
							'selector' 		=> '{{WRAPPER}} .blog-post .post-details',
							'condition'     => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
						]
					);
					$this->add_responsive_control(
						'litho_blog_list_blog_post_content_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .blog-post .post-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition'     => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_list_content_box_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_blog_list_content_box_hover_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'      => '{{WRAPPER}} .blog-post:hover',
						]
					);
					$this->add_control(
						'litho_blog_list_hover_title_hover_color',
						[
							'label'     => __( 'Title Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .blog-post:hover .entry-title' => 'color: {{VALUE}};',
							],
							'condition'     => [ 'litho_blog_style' => [ 'blog-overlay-image' ] ], // IN
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' 			=> 'litho_blog_list_category_hover_border',
							'selector' 		=> '{{WRAPPER}} .blog-post:hover .blog-category a',
							'fields_options'=> [
								'border' 	=> [
									'label' => __( 'Category Border', 'litho-addons' ),
								],
							],
							'condition'     => [ 'litho_blog_style' => [ 'blog-overlay-image' ] ], // IN
						]
					);
					$this->add_control(
						'litho_blog_list_category_hover_color',
						[
							'label'     => __( 'Category Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .blog-post:hover .blog-category a' => 'color: {{VALUE}};',
							],
							'condition'     => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 			=> 'litho_blog_list_blog_post_hover_shadow',
							'selector' 		=> '{{WRAPPER}} .blog-post:hover',
						]
					);

					$this->add_control(
						'litho_blog_list_blog_post_content_hover_shadow_title',
						[
							'label'     => __( 'Post Content Shadow', 'litho-addons' ),
							'type'      => Controls_Manager::HEADING,
							'condition' => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 			=> 'litho_blog_list_blog_post_content_hover_shadow',
							'selector' 		=> '{{WRAPPER}} .blog-post:hover .post-details',
							'condition'     => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
						]
					);
					$this->add_responsive_control(
						'litho_blog_list_blog_post_content_hover_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .blog-post:hover .post-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition'     => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
						]
					);
					$this->add_control(
						'litho_blog_post_content_box_hover_animation',
						[
							'label'         => __( 'Hover Animation', 'litho-addons' ),
							'type'          => Controls_Manager::HOVER_ANIMATION,
						]
					);
					$this->add_control(
						'litho_blog_post_content_box_hover_transition',
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
								'{{WRAPPER}} .blog-post' => 'transition-duration: {{SIZE}}s',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_blog_list_content_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .blog-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_content_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .blog-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_content_box_area_padding',
				[
					'label'         => __( 'Content Box Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .post-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
					'condition'     => [ 'litho_blog_style' => [ 'blog-standard', 'blog-clean' ] ], // IN
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_content_box_area_margin',
				[
					'label'         => __( 'Content Box Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .post-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'     => [ 'litho_blog_style' => [ 'blog-classic' ] ], // IN
				]
			);
			$this->add_control(
				'litho_blog_list_box_setting_title',
				[
					'label'     => __( 'Box Setting', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition'     => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_blog_list_box_background',
					'types'             => [ 'classic', 'gradient' ],
					'exclude'           => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'        => '{{WRAPPER}} .post-details',
					'condition'     => [ 'litho_blog_style' => [ 'blog-modern' ] ], // IN
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_filter_general_style',
				[
					'label'         => __( 'Filter', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [
						'litho_post_type_source' 	=> 'post',
						'litho_enable_filter'		=> 'yes'
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_blog_filter_bg_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size'
					],
					'selector'      => '{{WRAPPER}} .blog-grid-filter'
				]
			);
			$this->add_responsive_control(
				'litho_section_blog_filter_align',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'default'       => 'center',                
					'options'       => [
						'flex-start'    => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'flex-end'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						]      
					],
					'selectors'     => [
						'{{WRAPPER}} .blog-grid-filter' => 'justify-content: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_blog_filter_border',
					'selector'      => '{{WRAPPER}} .blog-grid-filter.nav-tabs',
					'separator'     => 'before'
				]
			);
			$this->add_control(
				'litho_blog_filter_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .blog-grid-filter' => 'border-radius: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_filter_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .blog-grid-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_filter_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .blog-grid-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_blog_filter_box_shadow',
					'selector'      => '{{WRAPPER}} .blog-grid-filter'
				]
			);

			$this->add_control(
				'litho_blog_filter_items_style_heading',
				[
					'label'     => __( 'Filter Items', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_filter_items_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .blog-grid-filter li a',
					'fields_options'	=> [ 'typography' => [ 'separator' => 'before' ] ]
				]
			);
			$this->start_controls_tabs( 'litho_blog_filter_items_tabs' );
				$this->start_controls_tab( 'litho_blog_filter_items_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_blog_filter_items_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .blog-grid-filter > li > a' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_blog_filter_items_bg_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size'
							],
							'selector'          => '{{WRAPPER}} .blog-grid-filter > li'
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_filter_items_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_blog_filter_items_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .blog-grid-filter > li:hover > a, {{WRAPPER}} .blog-grid-filter > li.active > a'  => 'color: {{VALUE}};'
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_blog_filter_items_hover_bg_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size'
							],
							'selector'		=> '{{WRAPPER}} .blog-grid-filter > li:hover, {{WRAPPER}} .blog-grid-filter > li.active'
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_blog_filter_items_border',
					'default'       => '1px',
					'selector'      => '{{WRAPPER}} .blog-grid-filter > li',
					'separator'     => 'before'
				]
			);
			$this->add_control(
				'litho_blog_filter_items_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 50 ] ],
					'selectors'     => [
						'{{WRAPPER}} .blog-grid-filter > li' => 'border-radius: {{SIZE}}{{UNIT}};'
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_filter_items_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .blog-grid-filter li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_filter_items_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .blog-grid-filter li'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_blog_filter_items_shadow',
					'selector'      => '{{WRAPPER}} .blog-grid-filter li'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_list_image_style',
				[
					'label'         => __( 'Post Thumbnail', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 'litho_show_post_thumbnail' => 'yes' ],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_image_border',
					'selector'      => '{{WRAPPER}} .blog-post-images',
				]
			);
			$this->add_responsive_control(
				'litho_image_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .blog-post-images' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_image_overlay_heading',
				[
					'label'     => __( 'Overlay', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [ 
						'litho_blog_style!' => [ 'blog-classic' ], // NOT IN
					],
				]
			);

			$this->start_controls_tabs( 'litho_image_overlay_tabs' );
				$this->start_controls_tab( 'litho_image_overlay_normal_tab', 
					[ 
						'label' => __( 'Normal', 'litho-addons' ),
						'condition' => [ 
							'litho_blog_style!' => [ 'blog-classic', 'blog-metro', 'blog-overlay-image' ], // NOT IN
						],
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
								'{{WRAPPER}} ul:not(.blog-metro) .blog-post-images, {{WRAPPER}} .blog-post-images .blog-overlay' => 'opacity: {{SIZE}};',
							],
							'condition' => [ 
								'litho_blog_style!' => [ 'blog-classic' ], // NOT IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_overlay_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'          => '{{WRAPPER}} ul:not(.blog-metro) .blog-post-images, {{WRAPPER}} .blog-post-images .blog-overlay',
							'condition' => [ 
								'litho_blog_style!' => [ 'blog-masonry', 'blog-classic', 'blog-simple', 'blog-side-image', 'blog-widget', 'blog-standard' ]
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_image_overlay_hover_tab', 
					[ 
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' => [ 
							'litho_blog_style!' => [ 'blog-classic', 'blog-metro', 'blog-overlay-image' ], // NOT IN
						],
					]
				);
					$this->add_control(
						'litho_image_overlay_hover_opacity',
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
								'{{WRAPPER}} ul:not(.blog-metro) .blog-post-images:hover, {{WRAPPER}} .blog-post-images:hover .blog-overlay' => 'opacity: {{SIZE}};',
							],
							'condition' => [ 
								'litho_blog_style!' => [ 'blog-classic', 'blog-metro', 'blog-overlay-image' ], // NOT IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_overlay_hover_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'          => '{{WRAPPER}} ul:not(.blog-metro) .blog-post-images:hover, {{WRAPPER}} .blog-post-images:hover .blog-overlay',
							'condition' => [
								'litho_blog_style!' => [ 'blog-masonry', 'blog-classic', 'blog-simple', 'blog-side-image', 'blog-metro', 'blog-overlay-image', 'blog-widget', 'blog-standard' ]
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_list_post_type_icon_style',
				[
					'label'         => __( 'Post Type Icon', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [
						'litho_show_post_thumbnail_icon'	=> 'yes',
						'litho_blog_style!'				=> [ 'blog-overlay-image', 'blog-clean' ] // NOT IN
					],
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' => 'litho_post_type_icon_color',
					'selector' => '{{WRAPPER}} .post-icon:before',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_post_type_icon_bg_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'		=> '{{WRAPPER}} .post-icon',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_post_type_icon_box_shadow',
					'selector' 		=> '{{WRAPPER}} .post-icon',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_list_title_style',
				[
					'label'         => __( 'Post Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 
						'litho_show_post_title' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_list_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .entry-title, {{WRAPPER}} .blog-grid .grid-item .entry-title',
				]
			);
			$this->start_controls_tabs( 'litho_blog_list_title_tabs' );
				$this->start_controls_tab( 'litho_blog_list_title_normal_tab', 
					[ 
						'label' => __( 'Normal', 'litho-addons' ),
						'condition' => [ 
							'litho_blog_style!' => [ 'blog-overlay-image' ], // NOT IN
						],
					]
				);
					$this->add_control(
						'litho_blog_list_title_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .entry-title, {{WRAPPER}} .blog-grid .grid-item .entry-title' => 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_list_title_hover_tab', 
					[ 
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' => [ 
							'litho_blog_style!' => [ 'blog-overlay-image' ], // NOT IN
						],
					]
				);
					$this->add_control(
						'litho_blog_list_title_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .entry-title:hover, {{WRAPPER}} .blog-grid .grid-item .entry-title:hover' => 'color: {{VALUE}};',
							],
							'condition' => [ 
								'litho_blog_style!' => [ 'blog-overlay-image' ], // NOT IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_blog_list_title_width',
				[
					'label'         => __( 'Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'default'       => [ 'unit' => '%', 'size' => 100 ],
					'selectors'     => [
						'{{WRAPPER}} .entry-title, {{WRAPPER}} .blog-grid .grid-item .entry-title' => 'width: {{SIZE}}{{UNIT}}',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_title_min_height',
				[
					'label'         => __( 'Min Height', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'default' 		=> [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 500 ] ],
					'selectors'     => [
						'{{WRAPPER}} .entry-title, {{WRAPPER}} .blog-grid .grid-item .entry-title' => 'min-height: {{SIZE}}{{UNIT}}',
					],
					'condition' => [ 
						'litho_blog_style' => [ 'blog-grid', 'blog-classic', 'blog-simple', 'blog-clean', 'blog-widget', 'blog-standard' ], // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .entry-title, {{WRAPPER}} .blog-grid .grid-item .entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .entry-title, {{WRAPPER}} .blog-grid .grid-item .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_list_content_style',
				[
					'label'         => __( 'Post Content', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 
						'litho_show_post_excerpt'	=> 'yes',
						'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
					],
				]
			);
			$this->add_control(
				'litho_blog_list_content_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .entry-content' => 'color: {{VALUE}};',
					]
				]
			); 
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_list_content_typography',
					'selector'	=> '{{WRAPPER}} .entry-content',
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_content_width',
				[
					'label'         => __( 'Content Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 18, 'max' => 200 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'default'       => [ 'unit' => '%', 'size' => 95 ],
					'selectors'     => [
						'{{WRAPPER}} .entry-content' => 'width: {{SIZE}}{{UNIT}}',
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .entry-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_blog_list_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .entry-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_list_cta_button',
				[
					'label' 		=> __( 'Read More', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_show_post_read_more_button'	=> 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'litho_post_button_width',
				[
					'label' 		=> __( 'Width', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'custom' ],
					'default' 		=> [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' 		=> [
						'px' => [
							'min' => 1,
							'max' => 1000,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} a.elementor-button:not(.btn-custom-effect), {{WRAPPER}} a.elementor-button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-button.hvr-btn-expand-ltr:before, {{WRAPPER}} .elementor-gradient-button' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_post_button_height',
				[
					'label' 		=> __( 'Height', 'litho-addons' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em' ],
					'default' 		=> [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' 		=> [
						'px' => [
							'min' => 1,
							'max' => 1000,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-button, {{WRAPPER}} .elementor-gradient-button' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_post_button_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .elementor-button, {{WRAPPER}} .elementor-gradient-button',
				]
			);
			$this->start_controls_tabs( 'litho_tabs_button' );
				$this->start_controls_tab(
					'litho_tabs_button_normal',
					[
						'label'			=> __( 'Normal', 'litho-addons' ),
						'condition'		=> [ 'litho_blog_style!' => 'blog-overlay-image' ], // NOT IN
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_post_button_color',
						'selector'	=> '{{WRAPPER}} .elementor-button',
						'condition'	=> [
							'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ], // NOT IN
						],

					]
				);
				// Text Color for Overlay image
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name' 		=> 'litho_post_button_text_color',
						'selector'	=> '{{WRAPPER}} a.elementor-gradient-button .elementor-gradient-button-text, {{WRAPPER}} .elementor-gradient-button .elementor-gradient-button-text, {{WRAPPER}} a.elementor-gradient-button .elementor-gradient-button-icon i, {{WRAPPER}} .elementor-gradient-button .elementor-gradient-button-icon i',
						'condition'	=> [
							'litho_blog_style' => [ 'blog-classic', 'blog-overlay-image' ], // IN
						],

					]
				);
				// END Text Color for Overlay image

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'			=> 'litho_post_button_bg_color',
						'types'			=> [ 'classic', 'gradient' ],
						'exclude'		=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'		=> '{{WRAPPER}} a.elementor-button:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-button.btn-custom-effect:before, {{WRAPPER}} a.elementor-button.hvr-btn-expand-ltr:before',
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);
				$this->add_control(
					'litho_post_button_border_heading',
					[
						'label' 		=> __( 'Border', 'litho-addons' ),
						'type'			=> Controls_Manager::HEADING,
						'separator' 	=> 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' 			=> 'litho_post_button_border',
						'selector' 		=> '{{WRAPPER}} .elementor-button, {{WRAPPER}} .elementor-gradient-button',
					]
				);

				$this->add_control(
					'litho_post_button_border_radius',
					[
						'label' 		=> __( 'Border Radius', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'custom' ],
						'default' 		=> [
							'unit'	=> 'px',
						],
						'selectors' 	=> [
							'{{WRAPPER}} a.elementor-button:not(.btn-custom-effect), {{WRAPPER}} a.elementor-button.btn-custom-effect:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-button.hvr-btn-expand-ltr:before, {{WRAPPER}} .elementor-gradient-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_post_button_box_shadow',
						'selector' 		=> '{{WRAPPER}} .elementor-button, {{WRAPPER}} .elementor-gradient-button',
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'litho_tabs_button_hover',
					[
						'label' 		=> __( 'Hover', 'litho-addons' ),
						'condition'     => [ 'litho_blog_style!' => 'blog-overlay-image' ], // NOT IN
					]
				);
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'			=> 'litho_post_button_hover_color',
						'selector'		=> '{{WRAPPER}} .elementor-button:hover',
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);
				// Text hover color for classic
				$this->add_group_control(
					Text_Gradient_Background::get_type(),
					[
						'name'			=> 'litho_post_button_hover_text_color',
						'selector'		=> '{{WRAPPER}} a.elementor-gradient-button:hover .elementor-gradient-button-text, {{WRAPPER}} .elementor-gradient-button:hover .elementor-gradient-button-text, {{WRAPPER}} a.elementor-gradient-button:hover .elementor-gradient-button-icon i, {{WRAPPER}} .elementor-gradient-button:hover .elementor-gradient-button-icon i',
						'condition'     => [ 'litho_blog_style' => [ 'blog-classic', 'blog-overlay-image' ] ], // IN
					]
				);
				// END Text hover color for  classic
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'			=> 'litho_post_button_hover_bg_color',
						'types'			=> [ 'classic', 'gradient' ],
						'exclude'		=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'		=> '{{WRAPPER}} a.elementor-button:not(.hvr-btn-expand-ltr):hover, {{WRAPPER}} a.elementor-button.btn-custom-effect:not(.hvr-btn-expand-ltr):hover:before',
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);

				$this->add_control(
					'litho_post_button_hover_border_heading',
					[
						'label' 		=> __( 'Border', 'litho-addons' ),
						'type'			=> Controls_Manager::HEADING,
						'separator' 	=> 'before',
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' 			=> 'litho_post_hover_button_border',
						'selector' 		=> '{{WRAPPER}} .elementor-button:hover',
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);

				$this->add_control(
					'litho_post_button_hover_border_radius',
					[
						'label' 		=> __( 'Border Radius', 'litho-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'custom' ],
						'default' 		=> [
									'unit'	=> 'px',
						],
						'selectors' 	=> [
							'{{WRAPPER}} a.elementor-button:hover:not(.btn-custom-effect), {{WRAPPER}} a.elementor-button.btn-custom-effect:hover:not(.hvr-btn-expand-ltr), {{WRAPPER}} a.elementor-button.hvr-btn-expand-ltr:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_post_button_hover_box_shadow',
						'selector' 		=> '{{WRAPPER}} .elementor-button:hover',
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);

				$this->add_control(
					'litho_hover_animation',
					[
						'label' 		=> __( 'Hover Animation', 'litho-addons' ),
						'type'			=> Controls_Manager::HOVER_ANIMATION,
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
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
						'condition'     => [ 'litho_blog_style!' => [ 'blog-classic', 'blog-overlay-image' ] ], // NOT IN
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_blog_list_button_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-button, {{WRAPPER}} .elementor-gradient-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_post_button_spacing',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-button, {{WRAPPER}} .elementor-gradient-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_section_blog_list_meta_style',
				[
					'label'         => __( 'Post Meta', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_control(
				'litho_post_meta_categories_date_style_heading',
				[
					'label'     => __( 'Post Meta Category and Date Background', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_categories_date_bg_color',
				[
					'label'         => __( 'Background Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .blog-standard .post-meta' => 'background-color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_responsive_control(
				'litho_post_meta_categories_date_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'custom' ],
					'default' 		=> [
						'unit'	=> 'px',
					],
					'selectors' 	=> [
						'{{WRAPPER}} .blog-standard .post-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);

			$this->add_control(
				'litho_post_meta_border_style_heading',
				[
					'label'     => __( 'Post Meta Border', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_top_border_style',
				[
					'label'         => __( 'Border Type', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						''          => __( 'None', 'litho-addons' ),
						'solid'     => __( 'Solid', 'litho-addons' ),
						'double'    => __( 'Double', 'litho-addons' ),
						'dotted'    => __( 'Dotted', 'litho-addons' ),
						'dashed'    => __( 'Dashed', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .post-meta-wrapper' => 'border-top-style: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_responsive_control(
				'litho_post_meta_top_border_width',
				[
					'label'         => __( 'Top Border Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 10 ] ],
					'selectors' => [
						'{{WRAPPER}} .post-meta-wrapper' => 'border-top-width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_top_border_color',
				[
					'label'         => __( 'Top Border Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .post-meta-wrapper' => 'border-top-color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_right_border_style',
				[
					'label'         => __( 'Border Type', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						''          => __( 'None', 'litho-addons' ),
						'solid'     => __( 'Solid', 'litho-addons' ),
						'double'    => __( 'Double', 'litho-addons' ),
						'dotted'    => __( 'Dotted', 'litho-addons' ),
						'dashed'    => __( 'Dashed', 'litho-addons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .post-meta-wrapper > span:not(:last-child)' => 'border-right-style: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_responsive_control(
				'litho_post_meta_right_border_width',
				[
					'label'         => __( 'Right Border Width', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 10 ] ],
					'selectors' => [
						'{{WRAPPER}} .post-meta-wrapper > span:not(:last-child)' => 'border-right-width: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_right_border_color',
				[
					'label'         => __( 'Right Border Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .post-meta-wrapper > span:not(:last-child)' => 'border-right-color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_categories_style_heading',
				[
					'label'     => __( 'Post Meta Category', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'condition' 	=> [
						'litho_show_post_category' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_list_meta_categories_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .blog-category a, {{WRAPPER}} .blog-side-image .blog-category',
					'condition' 	=> [
						'litho_show_post_category' => 'yes',
					],
				]
			);
			$this->start_controls_tabs( 'litho_blog_list_meta_categories_tabs' );
				$this->start_controls_tab( 'litho_blog_list_meta_categories_normal_tab', [ 
					'label'			=> __( 'Normal', 'litho-addons' ),
					'condition' 	=> [
						'litho_show_post_category' => 'yes',
					],
				] );
					$this->add_control(
						'litho_blog_list_meta_categories_bg_color',
						[
							'label'         => __( 'Background Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .blog-grid:not(.blog-masonry) .blog-category a' => 'background-color: {{VALUE}};',
								'{{WRAPPER}} .blog-masonry .blog-category'					 => 'background-color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
								'litho_blog_style!'		=> [ 'blog-side-image', 'blog-standard' ], // NOT IN
							],
						]
					);
					
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name'			=> 'litho_blog_list_meta_categories_color',
							'selector'		=> '{{WRAPPER}} .blog-category a, {{WRAPPER}} .blog-side-image .blog-category',
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_blog_list_meta_categories_border',
							'selector'      => '{{WRAPPER}} .blog-category a',
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
								'litho_blog_style!' 		=> [ 'blog-masonry', 'blog-side-image', 'blog-standard' ], // NOT IN
							],
						]
					);
					$this->add_responsive_control(
						'litho_blog_list_meta_categories_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .blog-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
								'litho_blog_style!' => [ 'blog-masonry', 'blog-side-image', 'blog-standard' ],// NOT IN
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_list_meta_categories_hover_tab', [ 
					'label'			=> __( 'Hover', 'litho-addons' ),
					'condition'		=> [
						'litho_show_post_category' => 'yes',
					],
				] );
					$this->add_control(
						'litho_blog_list_meta_categories_hover_bg_color',
						[
							'label'         => __( 'Background Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .blog-grid:not(.blog-masonry) .blog-post:hover .blog-category a' 	=> 'background-color: {{VALUE}};',
								'{{WRAPPER}} .blog-masonry .blog-post:hover .blog-category'						=> 'background-color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
								'litho_blog_style!'		=> [ 'blog-side-image', 'blog-standard' ], // NOT IN
							],
						]
					);
					
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name'			=> 'litho_blog_list_meta_categories_hover_color',
							'selector'		=> '{{WRAPPER}} .blog-grid:not(.blog-standard) .blog-post:hover .blog-category a, {{WRAPPER}} .blog-standard .blog-post:hover .blog-category a, {{WRAPPER}} .blog-side-image .blog-category a:hover',
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'          => 'litho_blog_list_meta_categories_hover_border',
							'selector'      => '{{WRAPPER}} .blog-category a:hover',
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
								'litho_blog_style!' => [ 'blog-side-image' ], // NOT IN
							],
						]
					);
					$this->add_responsive_control(
						'litho_blog_list_meta_categories_hover_border_radius',
						[
							'label'         => __( 'Border Radius', 'litho-addons' ),
							'type'          => Controls_Manager::DIMENSIONS,
							'size_units'    => [ 'px', '%', 'custom' ],
							'selectors'     => [
								'{{WRAPPER}} .blog-category a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'condition' 	=> [
								'litho_show_post_category' => 'yes',
								'litho_blog_style!' => [ 'blog-side-image' ], // NOT IN
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_post_meta_date_style_heading',
				[
					'label'     => __( 'Post Meta Date', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' 	=> [
						'litho_show_post_date' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_list_meta_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .post-date',
					'condition' 	=> [
						'litho_show_post_date' => 'yes',
					],
				]
			);
			$this->add_control(
				'litho_blog_list_meta_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .post-date' => 'color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_show_post_date' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'litho_blog_list_meta_date_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_show_post_date' => 'yes',
					],
				]
			);

			$this->add_control(
				'litho_post_meta_author_style_heading',
				[
					'label'     => __( 'Post Meta Author', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' 	=> [
						'litho_show_post_author'	=> 'yes',
						'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_list_meta_author_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .author-name, {{WRAPPER}} .author-name a',
					'condition' 	=> [
						'litho_show_post_author' 	=> 'yes',
						'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
					],
				]
			);
			$this->start_controls_tabs( 'litho_blog_list_meta_author_tabs' );
				$this->start_controls_tab( 'litho_blog_list_meta_author_normal_tab', 
					[ 
						'label' => __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_show_post_author'	=> 'yes',
							'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
						],
					]
				);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' 		=> 'litho_blog_list_meta_author_color',
							'selector' 	=> '{{WRAPPER}} .author-name, {{WRAPPER}} .author-name a',
							'condition' 	=> [
								'litho_show_post_author'	=> 'yes',
								'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_list_meta_author_hover_tab', 
					[ 
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_show_post_author' => 'yes',
							'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
						],
					]
				);
					$this->add_group_control(
						Text_Gradient_Background::get_type(),
						[
							'name' 		=> 'litho_blog_list_meta_author_hover_color',
							'selector' 	=> '{{WRAPPER}} .author-name a:hover',
							'condition' 	=> [
								'litho_show_post_author' => 'yes',
								'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'litho_blog_list_meta_author_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .post-author-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_show_post_author'	=> 'yes',
						'litho_blog_style!'		=> 'blog-overlay-image' // NOT IN
					],
				]
			);

			$this->add_control(
				'litho_post_meta_likes_style_heading',
				[
					'label'     => __( 'Post Meta Like', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' 	=> [
						'litho_show_post_like' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_list_meta_likes_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .post-meta-like a',
					'condition' 	=> [
						'litho_show_post_like' => 'yes',
					],
				]
			);
			$this->start_controls_tabs( 'litho_blog_list_meta_likes_tabs' );
				$this->start_controls_tab( 'litho_blog_list_meta_likes_normal_tab', 
					[ 
						'label' => __( 'Normal', 'litho-addons' ) ,
						'condition' 	=> [
							'litho_show_post_like' => 'yes',
						],
					]
				);
					$this->add_control(
						'litho_blog_list_meta_likes_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .post-meta-like a'	=> 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_show_post_like' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_list_meta_likes_hover_tab', 
					[ 
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_show_post_like' => 'yes',
						],
					]
				);
					$this->add_control(
						'litho_blog_list_meta_likes_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .post-meta-like a:hover'    => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_show_post_like' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_post_meta_comment_style_heading',
				[
					'label'     => __( 'Post Meta Comment', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' 	=> [
						'litho_show_post_comments' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_blog_list_meta_comment_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .post-meta-comments a',
					'condition' 	=> [
						'litho_show_post_comments' => 'yes',
					],
				]
			);
			$this->start_controls_tabs( 'litho_blog_list_meta_comment_tabs' );
				$this->start_controls_tab( 'litho_blog_list_meta_comment_normal_tab', 
					[ 
						'label' => __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_show_post_comments' => 'yes',
						],
					]
				);
					$this->add_control(
						'litho_blog_list_meta_comment_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .post-meta-comments a'	=> 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_show_post_comments' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_blog_list_meta_comment_hover_tab', 
					[ 
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_show_post_comments' => 'yes',
						],
					]
				);
					$this->add_control(
						'litho_blog_list_meta_comment_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .post-meta-comments a:hover'    => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_show_post_comments' => 'yes',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'litho_post_meta_separator_style_heading',
				[
					'label'     => __( 'Post Meta Separator', 'litho-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_separator_typo',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '#d6d5d5',
					'selectors'     => [
						'{{WRAPPER}} .post-meta-separator' => 'color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
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
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'			=> 'litho_post_meta_separator_typography',
					'exclude' 	=> [
						'text_transform',
						'text_decoration',
						'letter_spacing'
					],
					'condition'		=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->add_control(
				'litho_post_meta_separator_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '#d6d5d5',
					'selectors'     => [
						'{{WRAPPER}} .post-meta-separator' => 'color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
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
						'{{WRAPPER}} .post-meta-separator' => 'margin-left: {{LEFT}}{{UNIT}} !important; margin-right: {{RIGHT}}{{UNIT}} !important;',
					],
					'allowed_dimensions' => 'horizontal',
					'condition' 	=> [
						'litho_blog_style' => [ 'blog-standard' ],
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_blog_list_separator_style',
				[
					'label'         => __( 'Separator', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 
						'litho_blog_style!' => [ 'blog-masonry', 'blog-overlay-image', 'blog-simple', 'blog-standard' ],// NOT IN
						'litho_separator' => 'yes',
					], // NOT IN
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'			=> 'litho_separator_color',
					'types'			=> [ 'classic', 'gradient' ],
					'exclude'		=> [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'fields_options' => [
						'background' 	=> [
							'label' => __( 'Color', 'litho-addons' ),
						],
					],
					'selector'		=> '{{WRAPPER}} .horizontal-separator',
				]
			);
			$this->add_control(
				'litho_separator_thickness',
				[
					'label'         => __( 'Separator Thickness', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 10 ] ],
					'selectors'     => [
						'{{WRAPPER}} .horizontal-separator' => 'height: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_separator_length',
				[
					'label'         => __( 'Separator Length', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 200 ], '%'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .horizontal-separator' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_separator_spacing',
				[
					'label'         => __( 'Separator Spacing', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .horizontal-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_style_icon',
				[
					'label' 		=> __( 'Hover Icon', 'litho-addons' ),
					'tab'   		=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_hover_icon'	=> 'yes',
						'litho_blog_style' => [ 'blog-clean' ], // IN
					],
				]
			);
			$this->add_control(
				'litho_selected_icon',
				[
					'label' 		=> __( 'Icon', 'litho-addons' ),
					'type' 			=> Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default' 		=> [
						'value' 		=> 'fa-solid fa-arrow-right',
						'library' 		=> 'fa-solid',
					]
				]
			);
			$this->start_controls_tabs( 'icon_colors' );

			$this->start_controls_tab(
				'litho_icon_colors_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_icon_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_icon_background_color',
				[
					'label'         => __( 'Background Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'background-color: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_icon_border',
					'selector'      => '{{WRAPPER}} .elementor-icon',
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'litho_icon_colors_hover',
				[
					'label'	 	=> __( 'Hover', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_hover_icon_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon:hover' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'litho_hover_icon_background_color',
				[
					'label'         => __( 'Background Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon:hover' => 'background-color: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_icon_hover_border',
					'selector'      => '{{WRAPPER}} .elementor-icon:hover',
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_icon_box_width',
				[
					'label' 	=> __( 'Box Width', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range'	 	=> [ 'px' => [ 'min' => 6, 'max' => 300 ] ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_box_height',
				[
					'label' 	=> __( 'Box Height', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range'	 	=> [ 'px' => [ 'min' => 6, 'max' => 300 ] ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label' 	=> __( 'Size', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range'	 	=> [ 'px' => [ 'min' => 6, 'max' => 300 ] ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_rotate',
				[
					'label' 	=> __( 'Rotate', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size' 		=> 0,
						'unit' 		=> 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_section_pagination_style',
				[
					'label'         => __( 'Pagination', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [ 'litho_pagination!' => [ '', 'infinite-scroll-pagination' ] ],
				]
			);
			$this->add_responsive_control(
				'litho_pagination_alignment',
				[
					'label'         => __( 'Alignment', 'litho-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'center',
					'options'       => [
						'flex-start'          => [
							'title'         => __( 'Left', 'litho-addons' ),
							'icon'          => 'eicon-text-align-left',
						],
						'center'        => [
							'title'         => __( 'Center', 'litho-addons' ),
							'icon'          => 'eicon-text-align-center',
						],
						'flex-end'         => [
							'title'         => __( 'Right', 'litho-addons' ),
							'icon'          => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .litho-pagination' => 'display: flex; justify-content: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_pagination' => 'number-pagination',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_pagination_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .page-numbers li .page-numbers, {{WRAPPER}} .new-post a , {{WRAPPER}} .old-post a',
					'condition'	=> [
						'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ]
					],
				]
			);
			$this->start_controls_tabs( 'litho_pagination_tabs' );
				$this->start_controls_tab( 'litho_pagination_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' ),
						'condition'	=> [
							'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ]
						],
					] );
					$this->add_control(
						'litho_pagination_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .page-numbers li .page-numbers , {{WRAPPER}} .new-post a , {{WRAPPER}} .old-post a' => 'color: {{VALUE}};',
							],
							'condition'     => [ 'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ] ],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_pagination_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
						'condition'	=> [
							'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ]
						],
					] );
					$this->add_control(
						'litho_pagination_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .page-numbers li .page-numbers:hover, {{WRAPPER}} .new-post a:hover , {{WRAPPER}} .old-post a:hover'    => 'color: {{VALUE}};',
							],
							'condition'     => [ 'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ] ],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_pagination_active_tab',
					[
						'label'		=> __( 'Active', 'litho-addons' ),
						'condition'	=> [
							'litho_pagination' => 'number-pagination'
						]
					] );
					$this->add_control(
						'litho_pagination_active_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .page-numbers li .page-numbers.current'    => 'color: {{VALUE}};',
							],
							'condition'	=> [
								'litho_pagination' => 'number-pagination'
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_pagination_border',
					'selector'      => '{{WRAPPER}} .blog-pagination, {{WRAPPER}} .litho-pagination',
					'condition' 	=> [
						'litho_pagination' => 'next-prev-pagination',
					],
				]
			);
			$this->add_responsive_control(
				'litho_pagination_space',
				[
					'label'         => __( 'Space Between', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .page-numbers li' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_pagination' => 'number-pagination',
					],
				]
			);
			$this->add_responsive_control(
				'litho_pagination_margin',
				[
					'label'         => __( 'Top Space', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px', '%', 'custom' ],
					'range'         => [ 'px'   => [ 'min' => 1, 'max' => 200 ] ],
					'selectors'     => [
						'{{WRAPPER}} .litho-pagination, {{WRAPPER}} .blog-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 'litho_pagination' => [ 'number-pagination', 'next-prev-pagination' ] ],
				]
			);

			// load more button style
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'litho_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' 	=> '{{WRAPPER}} .blog-pagination .view-more-button',
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->start_controls_tabs( 'litho_tabs_button_style' );
			$this->start_controls_tab(
				'litho_tab_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
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
						'{{WRAPPER}} .blog-pagination .view-more-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
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
					'selector' 			=> '{{WRAPPER}} .blog-pagination .view-more-button',
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tab_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->add_control(
				'litho_hover_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .blog-pagination .view-more-button:hover, {{WRAPPER}} .blog-pagination .view-more-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} .blog-pagination .view-more-button:hover svg, {{WRAPPER}} .blog-pagination .view-more-button:focus svg' => 'fill: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
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
					'selector' 			=> '{{WRAPPER}} .blog-pagination .view-more-button:hover, {{WRAPPER}} .blog-pagination .view-more-button:focus',
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);

			$this->add_control(
				'litho_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .blog-pagination .view-more-button:hover, {{WRAPPER}} .blog-pagination .view-more-button:focus' => 'border-color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_border_border!' => '',
						'litho_pagination'		=> 'load-more-pagination'
					]
				]
			);
			$this->add_control(
				'litho_load_more_btn_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->add_control(
				'litho_load_more_button_hover_transition',
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
						'{{WRAPPER}} .blog-pagination .view-more-button' => 'transition-duration: {{SIZE}}s',
					],
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_border',
					'selector' 		=> '{{WRAPPER}} .blog-pagination .view-more-button',
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					],
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
						'{{WRAPPER}} .blog-pagination .view-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .blog-pagination .view-more-button',
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->add_responsive_control(
				'litho_text_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .blog-pagination .view-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_pagination' => 'load-more-pagination'
					]
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render blog widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			global $litho_blog_unique_id;

			$settings                  = $this->get_settings_for_display();
			$litho_post_type_source    = $this->get_settings( 'litho_post_type_source' );
			$litho_blog_style          = $this->get_settings( 'litho_blog_style' );
			$litho_post_type_selection = $this->get_settings( 'litho_post_type_selection' );
			$litho_categories_list     = $this->get_settings( 'litho_categories_list' );
			$litho_tags_list           = $this->get_settings( 'litho_tags_list' );
			$litho_exclude_post_ids    = $this->get_settings( 'litho_exclude_post_ids' );
			$litho_ignore_sticky_posts = $this->get_settings( 'litho_ignore_sticky_posts' );
			$litho_post_per_page       = $this->get_settings( 'litho_post_per_page' );
			$litho_show_post_title     = $this->get_settings( 'litho_show_post_title' );
			/* Blog list filter */
			$litho_enable_filter              = $this->get_settings( 'litho_enable_filter' );
			$litho_filter_post_type_selection = $this->get_settings( 'litho_filter_post_type_selection' );
			$litho_filter_categories_list     = $this->get_settings( 'litho_filter_categories_list' );
			$litho_filter_tags_list           = $this->get_settings( 'litho_filter_tags_list' );
			$show_all_text_filter             = $this->get_settings( 'litho_show_all_text_filter' );
			$default_category_selected        = $this->get_settings( 'litho_default_category_selected' );
			$default_tags_selected            = $this->get_settings( 'litho_default_tags_selected' );
			$litho_categories_orderby         = $this->get_settings( 'litho_categories_orderby' );
			$litho_categories_order           = $this->get_settings( 'litho_categories_order' );
			$show_all_label                   = $this->get_settings( 'litho_show_all_label' );
			/* END Blog list filter */

			/* Column Settings */
			$litho_column_desktop_column = ! empty( $settings[ 'litho_column_settings_litho_larger_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_larger_desktop_column' ] : 'grid-3col';
			
			$litho_column_class_list = '';
			$litho_column_ratio      = '';

			if ( 'blog-side-image' !== $litho_blog_style ) {
				switch ( $litho_column_desktop_column ) {
					case 'grid-1col':
						$litho_column_ratio = 1;
						break;
					case 'grid-2col':
						$litho_column_ratio = 2;
						break;
					case 'grid-3col':
					default:
						$litho_column_ratio = 3;
						break;
					case 'grid-4col':
						$litho_column_ratio = 4;
						break;
					case 'grid-5col':
						$litho_column_ratio = 5;
						break;
					case 'grid-6col':
						$litho_column_ratio = 6;
						break;
				}

				$litho_column_class      = array();
				$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_larger_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_larger_desktop_column' ] : 'grid-3col';
				$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_large_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_large_desktop_column' ] : '';
				$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_desktop_column' ] : '';
				$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_tablet_column' ] ) ? $settings[ 'litho_column_settings_litho_tablet_column' ] : '';
				$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_landscape_phone_column' ] ) ? $settings[ 'litho_column_settings_litho_landscape_phone_column' ] : '';
				$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_portrait_phone_column' ] ) ? $settings[ 'litho_column_settings_litho_portrait_phone_column' ] : '';
				$litho_column_class      = array_filter( $litho_column_class );
				$litho_column_class_list = implode( ' ', $litho_column_class );
			}
			/* End Column Settings */

			$litho_show_post_thumbnail      = ( isset( $settings['litho_show_post_thumbnail'] ) && $settings['litho_show_post_thumbnail'] ) ? $settings['litho_show_post_thumbnail'] : '';
			$litho_thumbnail                = ( isset( $settings['litho_thumbnail'] ) && $settings['litho_thumbnail'] ) ? $settings['litho_thumbnail'] : 'full';
			$litho_show_post_format         = ( isset( $settings['litho_show_post_format'] ) && $settings['litho_show_post_format'] ) ? $settings['litho_show_post_format'] : '';
			$litho_show_post_thumbnail_icon = ( isset( $settings['litho_show_post_thumbnail_icon'] ) && $settings['litho_show_post_thumbnail_icon'] ) ? $settings['litho_show_post_thumbnail_icon'] : '';

			$litho_show_post_author         = ( isset( $settings['litho_show_post_author'] ) && $settings['litho_show_post_author'] ) ? $settings['litho_show_post_author'] : '';
			$litho_show_post_author_image   = ( isset( $settings['litho_show_post_author_image'] ) && $settings['litho_show_post_author_image'] ) ? $settings['litho_show_post_author_image'] : '';
			$litho_show_post_author_text    = $this->get_settings( 'litho_show_post_author_text' );
			$litho_show_post_date           = ( isset( $settings['litho_show_post_date'] ) && $settings['litho_show_post_date'] ) ? $settings['litho_show_post_date'] : '';
			$litho_post_date_format         = ( isset( $settings['litho_post_date_format'] ) && $settings['litho_post_date_format'] ) ? $settings['litho_post_date_format'] : '';
			$litho_show_post_excerpt        = ( isset( $settings['litho_show_post_excerpt'] ) && $settings['litho_show_post_excerpt'] ) ? $settings['litho_show_post_excerpt'] : '';
			$litho_post_excerpt_length      = ( isset( $settings['litho_post_excerpt_length'] )&& $settings['litho_post_excerpt_length'] ) ? $settings['litho_post_excerpt_length'] : '';
			$litho_show_post_category       = ( isset( $settings['litho_show_post_category'] )&& $settings['litho_show_post_category'] ) ? $settings['litho_show_post_category'] : '';
			$litho_show_post_category_text  = $this->get_settings( 'litho_show_post_category_text' );
			$litho_post_terms               = $this->get_settings( 'litho_post_terms' );

			$litho_show_post_comments       = ( isset( $settings['litho_show_post_comments'] ) && $settings['litho_show_post_comments'] ) ? $settings['litho_show_post_comments'] : '';
			$litho_show_post_like           = ( isset( $settings['litho_show_post_like'] ) && $settings['litho_show_post_like'] ) ? $settings['litho_show_post_like'] : '';
			$litho_orderby                  = ( isset( $settings['litho_orderby'] ) && $settings['litho_orderby'] ) ? $settings['litho_orderby'] : '';
			$litho_order                    = ( isset( $settings['litho_order'] ) && $settings['litho_order'] ) ? $settings['litho_order'] : '';
			$litho_separator                = ( isset( $settings['litho_separator'] ) && $settings['litho_separator'] ) ? $settings['litho_separator'] : '';
			// Entrance Animation
			$litho_blog_grid_animation          = ( isset( $settings['litho_blog_grid_animation'] ) && $settings['litho_blog_grid_animation'] ) ? $settings['litho_blog_grid_animation'] : '';
			$litho_blog_grid_animation_duration = ( isset( $settings['litho_blog_grid_animation_duration'] ) && $settings['litho_blog_grid_animation_duration'] ) ? $settings['litho_blog_grid_animation_duration'] : '';
			$litho_blog_grid_animation_delay    = ( isset( $settings['litho_blog_grid_animation_delay'] ) && $settings['litho_blog_grid_animation_delay'] ) ? $settings['litho_blog_grid_animation_delay'] : 100;
			// pagination
			$litho_pagination                      = ( isset( $settings['litho_pagination'] ) && $settings['litho_pagination'] ) ? $settings['litho_pagination'] : '';
			$litho_show_post_read_more_button      = ( isset( $settings['litho_show_post_read_more_button'] ) && $settings['litho_show_post_read_more_button'] ) ? $settings['litho_show_post_read_more_button'] : '';
			$litho_show_post_read_more_button_text = ( isset( $settings['litho_show_post_read_more_button_text'] ) && $settings['litho_show_post_read_more_button_text'] ) ? $settings['litho_show_post_read_more_button_text'] : '';

			$litho_remove_order        = ( isset( $settings['litho_remove_order'] ) && $settings['litho_remove_order'] ) ? $settings['litho_remove_order'] : '';
			$litho_post_meta_separator = ( isset( $settings['litho_post_meta_separator'] ) && $settings['litho_post_meta_separator'] ) ? $settings['litho_post_meta_separator'] : '|';
			$litho_post_meta_separator = '<span class="post-meta-separator">'. esc_html( $litho_post_meta_separator ) .'</span>';

			$litho_blog_list_content_box_alignment = ( isset( $settings['litho_blog_list_content_box_alignment'] ) && $settings['litho_blog_list_content_box_alignment'] ) ? $settings['litho_blog_list_content_box_alignment'] : '';

			$litho_blog_post_content_box_hover_animation = ( isset( $settings['litho_blog_post_content_box_hover_animation'] ) && $settings['litho_blog_post_content_box_hover_animation'] ) ? 'hvr-'. $settings['litho_blog_post_content_box_hover_animation'] : '';

			// Check if blog id and class.
			$litho_blog_unique_id = ! empty( $litho_blog_unique_id ) ? $litho_blog_unique_id : 1;
			$litho_blog_id        = 'litho-blog';
			$litho_blog_id        .= '-' . $litho_blog_unique_id;
			$litho_blog_unique_id++;
			
			if ( 'yes' === $litho_enable_filter && 'post' === $litho_post_type_source ) {

				$query_filter_args = array(
					'hide_empty' => true,
				);
				
				if ( 'post_tag' === $litho_filter_post_type_selection ) {
					$categories_to_display_ids = ( ! empty( $litho_filter_tags_list ) ) ? $litho_filter_tags_list : array();
				} else {
					$categories_to_display_ids = ( ! empty( $litho_filter_categories_list ) ) ? $litho_filter_categories_list : array();
				}

				// If no categories are chosen or "All categories", we need to load all available categories.
				if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
					$terms = get_terms( $litho_filter_post_type_selection );
					if ( ! is_array( $categories_to_display_ids ) ) {
						$categories_to_display_ids = array();
					}
					foreach ( $terms as $term ) {
						$categories_to_display_slug[] = $term->slug;
					}
				} else {
					if ( ! empty( $categories_to_display_ids ) && ! is_wp_error( $categories_to_display_ids ) ) {
						foreach ( $categories_to_display_ids as $slug ) {
							$categories_to_display_slug[] = $slug;
						}
					}
				}

				if ( ! empty( $categories_to_display_slug ) ) {
					$query_filter_args['slug'] = $categories_to_display_slug;
				}
				if ( ! empty( $litho_categories_orderby ) ) {
					$query_filter_args['orderby'] = $litho_categories_orderby;
				}
				if ( ! empty( $litho_categories_order ) ) {
					$query_filter_args['order'] = $litho_categories_order;
				}

				$query_filter_args[ 'taxonomy' ] = $litho_filter_post_type_selection;

				$tax_terms = get_terms( $query_filter_args );
				
				if ( is_array( $tax_terms ) && count( $tax_terms ) == 0 ) {
					return;
				}
				$this->add_render_attribute( 'filter_wrapper', [
					'class' => [
						'blog-grid-filter',
						'nav',
						'nav-tabs',
					],
				] );
				?><ul <?php $this->print_render_attribute_string( 'filter_wrapper' ); // phpcs:ignore ?>><?php
					
					$active_class = '';
					if ( 'tags' === $litho_post_type_selection  ) {
						if ( 'yes' === $show_all_text_filter ) {
							$active_class = empty( $default_tags_selected ) ? 'active' : '';
						}
					} else {
						if ( 'yes' === $show_all_text_filter ) {
							$active_class = empty( $default_category_selected ) ? 'active' : '';
						}
					}

					$this->add_render_attribute(
						'filter_li',
						[
							'class' => [
								'nav',
								$active_class,
							]
						]
					);
					$this->add_render_attribute(
						'filter_a',
						[
							'href'        => 'javascript:void(0);',
							'data-filter' => '*',
						]
					);
					
					if ( 'yes' === $show_all_text_filter ) {
						?><li <?php $this->print_render_attribute_string( 'filter_li' ); // phpcs:ignore ?>>
							<a <?php $this->print_render_attribute_string( 'filter_a' ); // phpcs:ignore ?>><?php
								echo esc_html( $show_all_label );
							?></a>
						</li><?php
					}
					
					foreach ( $tax_terms as $index => $tax_term ) {

						$active_class  = '';
						$filter_li_key = 'filter_li' . $index;
						$filter_a_key  = 'filter_a' . $index;

						if ( 'post_tag' === $litho_filter_post_type_selection ) {
							$active_class	= ( $default_tags_selected == $tax_term->term_id ) ? 'active' : '';
						} else {
							$active_class	= ( $default_category_selected == $tax_term->term_id ) ? 'active' : '';
						}
						$this->add_render_attribute(
							$filter_li_key,
							[
								'class' => [
									'nav',
									$active_class
								]
							]
						);
						$this->add_render_attribute(
							$filter_a_key,
							[
								'href'        => 'javascript:void(0);',
								'data-filter' => '.blog-filter-' . $tax_term->term_id
							]
						);

						?><li <?php $this->print_render_attribute_string( $filter_li_key ); // phpcs:ignore ?>>
							<a <?php $this->print_render_attribute_string( $filter_a_key ); // phpcs:ignore ?>><?php
								echo esc_html( $tax_term->name );
							?></a>
						</li><?php
					}
				?></ul>
			<?php
			}

			$litho_blog_list_content_box_alignment_main_class = '';
			$litho_blog_list_content_box_alignment_sub_class  = '';

			switch ( $litho_blog_list_content_box_alignment ) {
				case 'center':
					$litho_blog_list_content_box_alignment_main_class = 'text-center';
					$litho_blog_list_content_box_alignment_sub_class  = ' justify-content-center';
					break;
				case 'right':
					$litho_blog_list_content_box_alignment_main_class = 'text-end';
					$litho_blog_list_content_box_alignment_sub_class  = ' justify-content-end';
					break;
			}
			
			$dataSettings = array(
				'pagination_type' => $litho_pagination
			);

			$this->add_render_attribute(
				'wrapper',
				[
					'data-uniqueid'      => $litho_blog_id,
					'class'              => [
						'grid',
						'litho-blog-list',
						$litho_blog_id,
						$litho_blog_style,
						$litho_column_class_list,
					],
					'data-blog-settings' => json_encode( $dataSettings )
				]
			);

			if ( ! empty( $litho_pagination ) ) {
				$this->add_render_attribute(
					'wrapper',
					'class',
					$litho_pagination
				);
			}

			if ( 'yes' !== $litho_remove_order ) {
				$this->add_render_attribute(
					'wrapper',
					'class',
					'litho-grid-no-order'
				);
			}

			switch ( $litho_blog_style ) {
				case 'blog-masonry':
				case 'blog-classic':
				case 'blog-simple':
				case 'blog-metro':
				case 'blog-overlay-image':
				case 'blog-modern':
				case 'blog-clean':
				case 'blog-widget':
				case 'blog-standard':
					$this->add_render_attribute(
						'wrapper',
						[
							'class' => [
								'blog-grid'
							]
						]
					);
					break;
			}

			switch ( $litho_blog_style ) {
				case 'blog-grid':
				case 'blog-classic':
				case 'blog-simple':
				case 'blog-overlay-image':
				case 'blog-modern':
				case 'blog-clean':
				case 'blog-widget':
				case 'blog-standard':
					if ( 'yes' === $this->get_settings( 'litho_enable_masonry' ) ) {
						$this->add_render_attribute(
							'wrapper',
							'class',
							'grid-masonry'
						);
					} else {
						$this->add_render_attribute(
							'wrapper',
							'class',
							'no-masonry'
						);
					}
					break;
				case 'blog-masonry':
				case 'blog-side-image':
				case 'blog-metro':
					$this->add_render_attribute(
						'wrapper',
						'class',
						'grid-masonry'
					);
					break;
			}			

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' ); 
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' ); 
			} else {
				$paged = 1;
			}

			
			$query_args = array(
				'post_status'    => 'publish',
				'posts_per_page' => intval( $litho_post_per_page ),
				'paged'          => $paged,
			);

			if ( ! empty( $litho_post_type_source ) ) {
				$query_args['post_type'] = $litho_post_type_source;
			} else {
				$query_args['post_type'] = 'post';
			}
			
			if ( 'post' === $litho_post_type_source ) {
				if ( 'tags' === $litho_post_type_selection ) {
					if ( ! empty( $litho_tags_list ) ) {
						$query_args['tag_slug__in'] = $litho_tags_list;
					}
				} else {
					if ( ! empty( $litho_categories_list ) ) {
						$query_args['category_name'] = implode( ',', $litho_categories_list );
					}
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
				if ( ! empty( $litho_exclude_post_ids ) ) {
					$litho_exclude_post_ids            = array_merge( $litho_exclude_post_ids, get_option( 'sticky_posts' ) );
				} else {
					$query_args[ 'post__not_in' ] = get_option( 'sticky_posts' );
				}
			}

			if ( ! empty( $litho_exclude_post_ids ) ) {
				$query_args[ 'post__not_in' ] = $litho_exclude_post_ids;
			}
			
			$the_query = new \WP_Query( $query_args );

			if ( $the_query->have_posts() ) {
				?>
				<ul <?php $this->print_render_attribute_string( 'wrapper' ); // phpcs:ignore ?>>
					<?php
					if ( 'blog-side-image' !== $litho_blog_style ) { ?>
						<?php if ( 'blog-metro' === $litho_blog_style ) { ?>
						<li class="grid-sizer"></li>
						<?php } else { ?>
						<li class="grid-sizer d-none p-0 m-0"></li>
						<?php } ?>
						<?php
					}

					$index            = 0;
					$grid_count       = 1;
					$grid_metro_count = 1;
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						if ( 'blog-side-image' !== $litho_blog_style ) {
							if ( $index % $litho_column_ratio == 0 ) {
								$grid_count = 1;
							}
						}

						$post_meta_array    = $post_cat = $cat_slug_cls = array();
						$inner_wrapper_key  = '_inner_wrapper_' . $index;
						$blog_post_key      = 'blog_post_' . $index;
						$button_key         = 'button_' . $index;
						$button_link_key    = 'button_link_' . $index;
						$button_link_key    = 'button_link_' . $index;
						$button_content_key = 'button_content_wrapper_' . $index;
						$button_text_key    = 'button_text_' . $index;

						$taxonomy = '';
						if ( 'tags' === $litho_post_type_selection  ) {
							$taxonomy = 'post_tag';
						} else {
							$taxonomy = 'category';
						}

						$categories  = get_the_terms( get_the_ID(), $taxonomy );
						$post_format = get_post_format( get_the_ID() );
						
						if ( $categories && ! is_wp_error( $categories ) ) {
							foreach ( $categories as $cat ) {

								$cat_slug_cls[] = 'blog-filter-' . $cat->term_id;
								$cat_link       = get_category_link( $cat->term_id );
								$post_cat[]     = '<a href="' . esc_url( $cat_link ) . '" rel="category tag">' . esc_html( $cat->name ) . '</a>';
							}
						}

						$post_category       = implode( ', ', $post_cat );
						$cat_slug_class_list = implode( ' ', $cat_slug_cls );
						$post_class_list     = get_post_class( array( 'grid-item', 'grid-gutter', $cat_slug_class_list ) );

						$this->add_render_attribute( $inner_wrapper_key, [
							'class' => $post_class_list
						] );

						// Entrance Animation
						if ( ! empty( $litho_blog_grid_animation ) ) {
							$this->add_render_attribute(
								$inner_wrapper_key,
								[
									'class'                => [
										'litho-animated',
										'elementor-invisible',
									],
									'data-animation'       => [
										$litho_blog_grid_animation,
										$litho_blog_grid_animation_duration,
									],
									'data-animation-delay' => $grid_count * $litho_blog_grid_animation_delay
								]
							);
						}
						
						$this->add_render_attribute(
							$blog_post_key,
							[
								'class' => [
									'blog-post',
									$litho_blog_list_content_box_alignment_main_class,
									$litho_blog_post_content_box_hover_animation,
								],
							]
						);

						/* For button */
						if ( 'blog-overlay-image' == $litho_blog_style || 'blog-classic' == $litho_blog_style ) {
							$this->add_render_attribute(
								$button_key,
								'class',
								'elementor-gradient-button-wrapper'
							);

							$this->add_render_attribute(
								$button_link_key,
								[
									'href'  => get_permalink(),
									'class' => [
										'elementor-gradient-button-link',
										'elementor-gradient-button',
										'blog-button',
									],
									'role'  => 'button'
								]
							);

							$this->add_render_attribute( [
								$button_content_key => [
									'class' => 'elementor-gradient-button-content-wrapper',
								],
								$button_text_key => [
									'class' => 'elementor-gradient-button-text',
								],
							] );
						} else {

							$this->add_render_attribute(
								$button_key,
								'class',
								'elementor-button-wrapper'
							);
							$this->add_render_attribute(
								$button_link_key,
								[
									'href'  => get_permalink(),
									'class' => [
										'elementor-button-link',
										'elementor-button',
										'blog-post-button',
									],
									'role'  => 'button'
								]
							);

							$this->add_render_attribute(
								[
									$button_content_key => [
										'class' => 'elementor-button-content-wrapper',
									],
									$button_text_key => [
										'class' => 'elementor-button-text',
									],
								]
							);
						}

						/* Custom Effect */
						$custom_animation_class       = '';
						$hover_animation_effect_array = litho_custom_hover_animation_effect();

						if ( ! empty( $settings['litho_hover_animation'] ) ) {
							$this->add_render_attribute(
								$button_link_key,
								'class',
								[
									'hvr-' . $settings[ 'litho_hover_animation' ]
								]
							);

							if ( in_array( $settings['litho_hover_animation'], $hover_animation_effect_array ) ) {
								$custom_animation_class = 'btn-custom-effect';
							}
						}

						$this->add_render_attribute(
							$button_link_key,
							'class',
							[ $custom_animation_class ]
						);

						switch ( $litho_blog_style ) {

							case 'blog-grid':
								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
									?>
									<li <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
										<div <?php $this->print_render_attribute_string( $blog_post_key ); // phpcs:ignore ?>><?php
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												?>
												<div class="blog-post-images"><?php
													if ( 'gallery' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_gallery_format(); // phpcs:ignore
													} elseif ( 'video' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_video_format(); // phpcs:ignore
													} elseif ( 'quote' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_quote_format(); // phpcs:ignore
													} elseif ( 'audio' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_audio_format(); // phpcs:ignore
													} else {
														if ( has_post_thumbnail() ) {
															?><a href="<?php the_permalink(); ?>"><?php
																echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );
																if ( 'yes' === $litho_show_post_thumbnail_icon ) {
																	$blog_lightbox_gallery = get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
																	$video_type_single     = get_post_meta( get_the_ID(), '_litho_video_type_single', true );

																	if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {

																		?><span class="post-icon post-type-<?php echo esc_attr( $post_format ); ?>"></span><?php

																		} elseif ( 'gallery' === $post_format ) {

																		?><span class="post-icon post-type-<?php echo esc_attr( $post_format ); ?>-slider"></span><?php

																		} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {

																		?><span class="post-icon post-type-<?php echo esc_attr( $post_format ); ?>-html5"></span><?php

																		} elseif ( 'video' === $post_format ) {

																		?><span class="post-icon post-type-<?php echo esc_attr( $post_format ); ?>"></span><?php

																		} elseif ( 'audio' === $post_format ) {

																		?><span class="post-icon post-type-<?php echo esc_attr( $post_format ); ?>"></span><?php

																		} elseif ( 'quote' === $post_format ) {

																		?><span class="post-icon post-type-<?php echo esc_attr( $post_format ); ?>"></span><?php
																	}
																}
															?></a><?php
														}
													}
													if ( 'yes' === $litho_show_post_category ) {
														?><span class="blog-category alt-font"><?php
															echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
														?></span><?php
													}
												?></div><?php //.blog-post-images
											}

											if ( 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
												?><div class="post-details"><?php

													if ( 'yes' === $litho_show_post_date ) {
														?><span class="post-date published"><?php
															echo esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) );
														?></span>
														<time class="updated d-none" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php
															echo esc_html( get_the_modified_date( $litho_post_date_format ) );
														?></time><?php
													}

													if ( 'yes' === $litho_show_post_title ) {
														?><a href="<?php the_permalink(); ?>" class="entry-title"><?php
															the_title();
														?></a><?php 
													}

													if ( 'yes' === $litho_show_post_excerpt ) {

														$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
														if ( ! empty( $show_excerpt_grid ) ) {
														?><div class="entry-content"><?php
															echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) );
														?></div><?php
														} 
													}

													if ( 'yes' === $litho_show_post_read_more_button ) {
														?><div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
															<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php
																		echo esc_html( $litho_show_post_read_more_button_text );
																	?></span>
																</span>
															</a>
														</div><?php
													}

													if ( 'yes' === $litho_separator ) {
														?><div class="horizontal-separator"></div><?php
													}

													if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
														?><div class="d-flex align-items-center post-meta post-meta-grid"><?php
															if ( 'yes' === $litho_show_post_author && get_the_author() ) {
																?><span class="post-author-meta"><?php
																	if ( 'yes' === $litho_show_post_author_image ) {
																		echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																	}
																	?><span class="author-name"><?php
																		echo esc_html( $litho_show_post_author_text );
																		?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php
																			echo esc_html( get_the_author() );
																		?></a>
																	</span>
																</span><?php
															}
															if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
																?><span class="post-meta-like"><?php
																	echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
																?></span><?php
															}
															if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																?><span class="post-meta-comments"><?php
																	echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
																?></span><?php
															}
														?></div><?php
													}
												?></div><?php // .post-details
											}
										?></div>
									</li><?php
								}
								break;
							case 'blog-masonry':
								if ( 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) || 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button ) {

									echo '<li '.$this->get_render_attribute_string( $inner_wrapper_key ).'>'; // phpcs:ignore
										echo '<div '.$this->get_render_attribute_string( $blog_post_key ).'>'; // phpcs:ignore
											if ( 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
												echo '<div class="d-flex align-items-center post-meta">';
													if ( 'yes' === $litho_show_post_date ) {
														echo '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
													}
													if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
														echo '<span class="post-meta-like">';
															echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
														echo '</span>';
													}
													if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
														echo '<span class="post-meta-comments">';
															echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' ); // phpcs:ignore
														echo '</span>';
													}
												echo '</div>';
											}
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												echo '<div class="blog-post-images">';
													if ( 'gallery' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_gallery_format(); // phpcs:ignore
													} elseif ( 'video' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_video_format(); // phpcs:ignore
													} elseif ( 'quote' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_quote_format(); // phpcs:ignore
													} elseif ( 'audio' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_audio_format(); // phpcs:ignore
													} else {
														if ( has_post_thumbnail() ) {
															echo '<a href="'.get_permalink().'">';
																echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );
																if ( 'yes' === $litho_show_post_thumbnail_icon ) {
																	$blog_lightbox_gallery = get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
																	$video_type_single     = get_post_meta( get_the_ID(), '_litho_video_type_single', true );

																	if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'gallery' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
																	} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
																	} elseif ( 'video' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'audio' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'quote' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	}
																}
															echo '</a>';
														}
													}
													if ( 'yes' === $litho_show_post_category ) {
														echo '<span class="blog-category alt-font">';
															echo litho_post_category( get_the_ID(), true, '1', $litho_post_terms );
														echo '</span>';
													}
												echo '</div>';
											}

											if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button ) {
												echo '<div class="post-details">';
													if ( 'yes' === $litho_show_post_author && get_the_author() ) {
														echo '<span class="post-author-meta">';
															if ( 'yes' === $litho_show_post_author_image ) {
																echo get_avatar( get_the_author_meta( 'ID' ), '30' );
															}
															echo '<span class="author-name">';
																echo esc_html( $litho_show_post_author_text );
																echo '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
															echo '</span>';
														echo '</span>';
													}
													if ( 'yes' === $litho_show_post_title ) { ?>
														<a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a>
													<?php }
													if ( 'yes' === $litho_show_post_excerpt ) {
														$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
														if ( ! empty( $show_excerpt_grid ) ) { 
														?>
														<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
														<?php } 
													}
													if ( 'yes' === $litho_show_post_read_more_button ) { ?>
														<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
															<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																</span>
															</a>
														</div>
													<?php }
												echo '</div>';
											}
										echo '</div>';
									echo '</li>';
								}
								break;
							case 'blog-classic':

								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

									echo '<li '.$this->get_render_attribute_string( $inner_wrapper_key ).'>'; // phpcs:ignore
										echo '<div '.$this->get_render_attribute_string( $blog_post_key ).'>'; // phpcs:ignore
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												echo '<div class="blog-post-images">';
													if ( 'gallery' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_gallery_format(); // phpcs:ignore
													} elseif ( 'video' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_video_format(); // phpcs:ignore
													} elseif ( 'quote' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_quote_format(); // phpcs:ignore
													} elseif ( 'audio' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_audio_format(); // phpcs:ignore
													} else {
														if ( has_post_thumbnail() ) {
															echo '<a href="'.get_permalink().'">';
																echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );

																if ( 'yes' === $litho_show_post_thumbnail_icon ) {

																	$blog_lightbox_gallery = get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
																	$video_type_single     = get_post_meta( get_the_ID(), '_litho_video_type_single', true );

																	if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'gallery' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
																	} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
																	} elseif ( 'video' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'audio' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'quote' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	}
																}
															echo '</a>';
														}
													}
												echo '</div>';
											}
											if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
												echo '<div class="post-details">';
													if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_date ) {
														echo '<div class="post-meta-wrapper d-flex align-items-center post-meta">';
															if ( 'yes' === $litho_show_post_author && get_the_author() ) {
																echo '<span class="post-author-meta">';
																	if ( 'yes' === $litho_show_post_author_image ) {
																		echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																	}
																	echo '<span class="author-name">';
																		echo esc_html( $litho_show_post_author_text );
																		echo '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. esc_html( get_the_author() ) .'</a>';
																	echo '</span>';
															}
															if ( 'yes' === $litho_show_post_date ) {
																echo '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
															}
														echo '</div>';
													}
													if ( 'yes' === $litho_show_post_category ) {
														echo '<span class="blog-category alt-font">';
															echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
														echo '</span>';
													}
													if ( 'yes' === $litho_show_post_title ) { ?>
														<a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a>
													<?php }
													if ( 'yes' === $litho_show_post_excerpt ) {
														$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
														if ( ! empty( $show_excerpt_grid ) ) { 
														?>
														<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
														<?php } 
													}
													if ( 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
														echo '<div class="blog-post-meta-wrapper d-flex align-items-center">';
															if ( 'yes' === $litho_separator || 'yes' === $litho_show_post_read_more_button ) {
																echo '<div class="blog-post-button-wrapper">';
																	if ( 'yes' === $litho_separator ) {
																		echo '<div class="horizontal-separator"></div>';
																	}
																	if ( 'yes' === $litho_show_post_read_more_button ) { ?>
																		<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
																			<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																				<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																					<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																				</span>
																			</a>
																		</div>
																	<?php }
																echo '</div>';
															}
															if ( 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																echo '<div class="post-meta">';
																	if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
																		echo '<span class="post-meta-like">';
																			echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
																		echo '</span>';
																	}
																	if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																		echo '<span class="post-meta-comments">';
																			echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
																		echo '</span>';
																	}
																echo '</div>';
															}
														echo '</div>';
													}
												echo '</div>';
											}
										echo '</div>';
									echo '</li>';
								}
								break;
							case 'blog-simple':

								if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

									echo '<li '.$this->get_render_attribute_string( $inner_wrapper_key ).'>'; // phpcs:ignore
										echo '<div '.$this->get_render_attribute_string( $blog_post_key ).'>'; // phpcs:ignore
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												$bg_img_key  = '_bg_image_'.$index;
												$this->add_render_attribute( $bg_img_key, 'class', 'blog-post-images cover-background' );
												$this->add_render_attribute( $bg_img_key, 'style', 'background-image: url('.esc_url( get_the_post_thumbnail_url() ).');' );
												
												echo '<div '.$this->get_render_attribute_string( $bg_img_key ).'>';
													echo '<a href="'.get_permalink().'">';
														if ( 'yes' === $litho_show_post_thumbnail_icon ) {
															$blog_lightbox_gallery 	= get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
															$video_type_single 		= get_post_meta( get_the_ID(), '_litho_video_type_single', true );

															if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {
																echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
															} elseif ( 'gallery' === $post_format ) {
																echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
															} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {
																echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
															} elseif ( 'video' === $post_format ) {
																echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
															} elseif ( 'audio' === $post_format ) {
																echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
															} elseif ( 'quote' === $post_format ) {
																echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
															}
														}
													echo '</a>';
												echo '</div>';
											}
											if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
												echo '<div class="post-details">';
													if ( 'yes' === $litho_show_post_category ) {
														echo '<span class="blog-category alt-font">';
															echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
														echo '</span>';
													}

													if ( 'yes' === $litho_show_post_date ) {

														echo '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
													}
													if ( 'yes' === $litho_show_post_title ) { ?>
														<a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a>
													<?php }
													if ( 'yes' === $litho_show_post_excerpt ) {
														$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
														if ( ! empty( $show_excerpt_grid ) ) { 
														?>
														<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
														<?php } 
													}

													if ( 'yes' === $litho_show_post_read_more_button ) { ?>
														<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
															<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																</span>
															</a>
														</div>
													<?php }
													if ( 'yes' === $litho_show_post_author && get_the_author() ) {
														echo '<span class="post-author-meta">';
															if ( 'yes' === $litho_show_post_author_image ) {
																echo get_avatar( get_the_author_meta( 'ID' ), '30' );
															}
															echo '<span class="author-name">';
															echo esc_html( $litho_show_post_author_text );
															echo '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. esc_html( get_the_author() ) .'</a></span>';
														echo '</span>';
													}
													if ( 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
														echo '<div class="post-meta">';
															if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
																echo '<span class="post-meta-like">';
																	echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
																echo '</span>';
															}
															if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																echo '<span class="post-meta-comments">';
																	echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
																echo '</span>';
															}
														echo '</div>';
													}
												echo '</div>';
											}
										echo '</div>';
									echo '</li>';
								}
								break;
							case 'blog-side-image':

								$this->add_render_attribute( $blog_post_key, [
									'class'  => [ 'd-flex', 'flex-column', 'flex-md-row', 'align-items-center' ],
								] );
								if ( ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
									
									echo '<li '.$this->get_render_attribute_string( $inner_wrapper_key ).'>'; // phpcs:ignore
										echo '<div '.$this->get_render_attribute_string( $blog_post_key ).'>'; // phpcs:ignore
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												echo '<div class="blog-post-images">';
													if ( 'gallery' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_gallery_format(); // phpcs:ignore
													} elseif ( 'video' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_video_format(); // phpcs:ignore
													} elseif ( 'quote' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_quote_format(); // phpcs:ignore
													} elseif ( 'audio' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_audio_format(); // phpcs:ignore
													} else {
														if ( has_post_thumbnail() ) {
															echo '<a href="'.get_permalink().'">';
																echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );
																if ( 'yes' === $litho_show_post_thumbnail_icon ) {
																	$blog_lightbox_gallery 	= get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
																	$video_type_single 		= get_post_meta( get_the_ID(), '_litho_video_type_single', true );

																	if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'gallery' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
																	} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
																	} elseif ( 'video' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'audio' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'quote' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	}
																}
															echo '</a>';
														}
													}
												echo '</div>';
											}

											if ( 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
												echo '<div class="post-details">';
													if ( 'yes' === $litho_show_post_date ) {

														echo '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
													}
													if ( 'yes' === $litho_show_post_title ) { ?>
														<a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a>
													<?php }
													if ( 'yes' === $litho_show_post_excerpt ) {
														$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
														if ( ! empty( $show_excerpt_grid ) ) { 
														?>
														<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
														<?php } 
													}
													if ( 'yes' === $litho_show_post_read_more_button ) { ?>
														<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
															<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																</span>
															</a>
														</div>
													<?php }

													if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_category ) {
														echo '<div class="d-flex align-items-center'.esc_attr( $litho_blog_list_content_box_alignment_sub_class ).'">';
															if ( 'yes' === $litho_show_post_author && get_the_author() ) {
																echo '<span class="post-author-meta">';
																	if ( 'yes' === $litho_show_post_author_image ) {
																		echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																	}
																	echo '<span class="author-name">';
																	echo esc_html( $litho_show_post_author_text );
																	echo '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. esc_html( get_the_author() ) .'</a></span>';
																echo '</span>';
															}
															if ( 'yes' === $litho_separator && 'yes' === $litho_show_post_category && 'yes' === $litho_show_post_author ) {
																echo '<div class="horizontal-separator"></div>';
															}
															if ( 'yes' === $litho_show_post_category ) {
																echo '<span class="blog-category alt-font">';
																	echo esc_html( $litho_show_post_category_text );
																	echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
																echo '</span>';
															}
														echo '</div>';
													}
													if ( 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
														echo '<div class="post-meta">';
															if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
																echo '<span class="post-meta-like">';
																	echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
																echo '</span>';
															}
															if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																echo '<span class="post-meta-comments">';
																	echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
																echo '</span>';
															}
														echo '</div>';
													}
												echo '</div>';
											}
										echo '</div>';
									echo '</li>';
								}
								break;
							case 'blog-metro':
								
								$litho_blog_metro_positions = $this->get_settings( 'litho_blog_metro_positions' );
								$litho_double_grid_position = ! empty( $litho_blog_metro_positions ) ? explode( ',', $litho_blog_metro_positions ) : array();

								if ( ! empty( $litho_double_grid_position ) && in_array( $grid_metro_count, $litho_double_grid_position ) ) {
									$this->add_render_attribute( $inner_wrapper_key, [
										'class' => 'grid-item-double',
									] );
								}

								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
									
									echo '<li '.$this->get_render_attribute_string( $inner_wrapper_key ).'>'; // phpcs:ignore
										echo '<div '.$this->get_render_attribute_string( $blog_post_key ).'>'; // phpcs:ignore
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												echo '<div class="blog-post-images">';
													if ( 'gallery' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_gallery_format(); // phpcs:ignore
													} elseif ( 'video' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_video_format(); // phpcs:ignore
													} elseif ( 'quote' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_quote_format(); // phpcs:ignore
													} elseif ( 'audio' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_audio_format(); // phpcs:ignore
													} else {
														if ( has_post_thumbnail() ) {
															echo '<a href="'.get_permalink().'">';
																echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );
																if ( 'yes' === $litho_show_post_thumbnail_icon ) {

																	$blog_lightbox_gallery 	= get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
																	$video_type_single 		= get_post_meta( get_the_ID(), '_litho_video_type_single', true );

																	if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'gallery' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
																	} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
																	} elseif ( 'video' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'audio' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'quote' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	}
																}
															echo '</a>';
														}
													}
													echo '<div class="blog-overlay"></div>';
												echo '</div>';
											}

											if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

												echo '<div class="post-details d-flex flex-column align-item-end">';
													if ( 'yes' === $litho_show_post_category ) {
														echo '<div class="mb-auto w-100">';
															echo '<span class="blog-category alt-font">';
																echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
															echo '</span>';
														echo '</div>';
													}
													echo '<div class="align-self-end w-100">';
														if ( 'yes' === $litho_show_post_date ) {

															echo '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
														}
														if ( 'yes' === $litho_show_post_title ) { ?>
															<a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a>
														<?php }
														if ( 'yes' === $litho_show_post_excerpt ) {

															$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
															if ( ! empty( $show_excerpt_grid ) ) { 
															?>
															<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
															<?php } 
														}
														if ( 'yes' === $litho_show_post_read_more_button ) { ?>
															<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
																<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																		<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																	</span>
																</a>
															</div>
														<?php }
														if ( 'yes' === $litho_separator ) {
															echo '<div class="horizontal-separator"></div>';
														}

														if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
															echo '<div class="d-flex align-items-center post-meta">';
																if ( 'yes' === $litho_show_post_author && get_the_author() ) {
																	echo '<span class="post-author-meta">';
																		if ( 'yes' === $litho_show_post_author_image ) {
																			echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																		}
																		echo '<span class="author-name">';
																		echo esc_html( $litho_show_post_author_text );
																		echo '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. esc_html( get_the_author() ) .'</a></span>';
																	echo '</span>';
																}
																if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
																	echo '<span class="post-meta-like">';
																		echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
																	echo '</span>';
																}
																if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																	echo '<span class="post-meta-comments">';
																		echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
																	echo '</span>';
																}
															echo '</div>';
														}
													echo '</div>';
												echo '</div>';
											}
										echo '</div>';
									echo '</li>';
								}
								break;
							case 'blog-overlay-image':

								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

									echo '<li '.$this->get_render_attribute_string( $inner_wrapper_key ).'>'; // phpcs:ignore
										echo '<div '.$this->get_render_attribute_string( $blog_post_key ).'>'; // phpcs:ignore
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												$this->add_render_attribute( 'background-image', 'class', 'blog-post-images' );
												$this->add_render_attribute( 'background-cover', 'class', 'post-images-bg' );
												$this->add_render_attribute( 'background-cover', 'style', 'background-image: url('.esc_url( get_the_post_thumbnail_url() ).');' );
												echo '<div '.$this->get_render_attribute_string( 'background-image' ).'>';
													echo '<div '.$this->get_render_attribute_string( 'background-cover' ).'></div>';
													echo '<div class="blog-overlay-image"></div>';
												echo '</div>';
											}
											if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

												echo '<div class="post-details">';
													if ( 'yes' === $litho_show_post_category ) {
														echo '<span class="blog-category alt-font">';
															echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
														echo '</span>';
													}
													if ( 'yes' === $litho_show_post_date ) {
														
														echo '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
													}
													if ( 'yes' === $litho_show_post_title ) { ?>
														<a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a>
													<?php }
													
													if ( 'yes' === $litho_show_post_read_more_button ) { ?>
														<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
															<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																</span>
															</a>
														</div>
													<?php }
													
													if ( 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
														echo '<div class="post-meta">';
															if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
																echo '<span class="post-meta-like">';
																	echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
																echo '</span>';
															}
															if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																echo '<span class="post-meta-comments">';
																	echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
																echo '</span>';
															}
														echo '</div>';
													}
												echo '</div>';
											}
										echo '</div>';
									echo '</li>';
								}
								break;
							case 'blog-modern':

								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

									echo '<li '.$this->get_render_attribute_string( $inner_wrapper_key ).'>'; // phpcs:ignore
										echo '<div '.$this->get_render_attribute_string( $blog_post_key ).'>'; // phpcs:ignore
											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												echo '<div class="blog-post-images">';
													if ( 'gallery' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_gallery_format(); // phpcs:ignore
													} elseif ( 'video' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_video_format(); // phpcs:ignore
													} elseif ( 'quote' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_quote_format(); // phpcs:ignore
													} elseif ( 'audio' === $post_format && '' === $litho_show_post_format ) {
														echo $this->litho_post_audio_format(); // phpcs:ignore
													} else {
														if ( has_post_thumbnail() ) {
															echo '<a href="'.get_permalink().'">';
																echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );

																if ( 'yes' === $litho_show_post_thumbnail_icon ) {

																	$blog_lightbox_gallery 	= get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
																	$video_type_single 		= get_post_meta( get_the_ID(), '_litho_video_type_single', true );

																	if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'gallery' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
																	} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
																	} elseif ( 'video' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'audio' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'quote' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	}
																}
															echo '</a>';
														}
													}
												echo '</div>';
											}

											if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
												
												echo '<div class="post-details">';
													if ( 'yes' === $litho_show_post_category ) {
														echo '<span class="blog-category alt-font">';
															echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
														echo '</span>';
													}
													if ( 'yes' === $litho_show_post_title ) { ?>
														<a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title(); ?></a>
													<?php }
													if ( 'yes' === $litho_show_post_date ) {
														echo '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
													}
													if ( 'yes' === $litho_show_post_excerpt ) {
														$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
														if ( ! empty( $show_excerpt_grid ) ) { 
														?>
														<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
														<?php } 
													}
													if ( 'yes' === $litho_show_post_read_more_button ) { ?>
														<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
															<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																</span>
															</a>
														</div>
													<?php }
													if ( 'yes' === $litho_separator ) {
														echo '<div class="horizontal-separator"></div>';
													}
													if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
														echo '<div class="post-meta">';
															if ( 'yes' === $litho_show_post_author && get_the_author() ) {
																echo '<span class="post-author-meta">';
																	if ( 'yes' === $litho_show_post_author_image ) {
																		echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																	}
																	echo '<span class="author-name">';
																		echo esc_html( $litho_show_post_author_text );
																	echo '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. esc_html( get_the_author() ) .'</a></span>';
																echo '</span>';
															}
															if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
																echo '<span class="post-meta-like">';
																	echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
																echo '</span>';
															}
															if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
																echo '<span class="post-meta-comments">';
																	echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
																echo '</span>';
															}
														echo '</div>';
													}
												echo '</div>';
											}
										echo '</div>';
									echo '</li>';
								}
								break;
							case 'blog-clean':

								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
									
									?><li <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
										<div <?php $this->print_render_attribute_string( $blog_post_key ); // phpcs:ignore ?>><?php

											if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
												?><div class="blog-post-images">
													<a href="<?php the_permalink(); ?>"><?php
														the_post_thumbnail( $litho_thumbnail );
														
														$hover_icon = '';
														if ( ! empty( $settings['litho_selected_icon'] ) || ( ! empty( $settings['litho_selected_icon']['value'] ) ) ) { 
															$migrated = isset( $settings['__fa4_migrated']['litho_selected_icon'] );
															$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
															?><div class="elementor-icon">
																<?php
																if ( $is_new || $migrated ) {
																	Icons_Manager::render_icon( $settings['litho_selected_icon'], [ 'aria-hidden' => 'true' ] );
																} elseif ( isset( $settings['litho_selected_icon']['value'] ) && ! empty( $settings['litho_selected_icon']['value'] ) ) {
																	?><i class="<?php echo esc_attr( $settings['litho_selected_icon']['value'] ); ?>" aria-hidden="true"></i><?php
																}
																?>
															</div><?php
														}
													?></a><?php
													if ( 'yes' === $litho_show_post_category ) {
														?><span class="blog-category alt-font"><?php
															echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
														?></span><?php
													}
												?></div><?php
											}

											if ( 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

											?><div class="post-details"><?php
												if ( 'yes' === $litho_show_post_date ) {
													?><span class="post-date published"><?php
														echo esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) );
													?></span>
													<time class="updated d-none" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php
														echo esc_html( get_the_modified_date( $litho_post_date_format ) );
													?></time><?php
												}
												if ( 'yes' === $litho_show_post_title ) {
													?><a class="entry-title" href="<?php the_permalink(); ?>"><?php
														the_title();
													?></a><?php
												}
												if ( 'yes' === $litho_show_post_excerpt ) {
													$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
													if ( ! empty( $show_excerpt_grid ) ) { 
														?><div class="entry-content"><?php
															echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) );
														?></div><?php
													} 
												}
												if ( 'yes' === $litho_show_post_read_more_button ) {
													?><div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
														<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
															<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php
																	echo esc_html( $litho_show_post_read_more_button_text );
																?></span>
															</span>
														</a>
													</div><?php
												}
												if ( 'yes' === $litho_separator ) {
													?><div class="horizontal-separator"></div><?php
												}
												if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {

													?><div class="d-flex align-items-center post-meta"><?php
														if ( 'yes' === $litho_show_post_author && get_the_author() ) {
															?><span class="post-author-meta"><?php
																if ( 'yes' === $litho_show_post_author_image ) {
																	echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																}
																?><span class="author-name"><?php
																	echo esc_html( $litho_show_post_author_text );
																	?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php
																		echo esc_html( get_the_author() );
																	?></a>
																</span>
															</span><?php
														}

														if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
															?><span class="post-meta-like"><?php
																echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
															?></span><?php
														}
														if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
															?><span class="post-meta-comments"><?php
																echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
															?></span><?php
														}
													?></div><?php
												}
											?></div><?php 
											}
										?></div>
									</li><?php
								}
								break;
							case 'blog-widget':

								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
									?>
									<li <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
										<div <?php $this->print_render_attribute_string( $blog_post_key ); // phpcs:ignore ?>>
											<?php
												if ( ! post_password_required() && 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() ) {
													?>
													<div class="blog-post-images">
														<a href="<?php the_permalink(); ?>">
															<?php the_post_thumbnail( $litho_thumbnail ); ?>
															<?php
															if ( 'yes' === $litho_show_post_thumbnail_icon ) {
																$blog_lightbox_gallery 	= get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true);
																$video_type_single 		= get_post_meta( get_the_ID(), '_litho_video_type_single', true);

																if ( 'gallery' === $post_format && $blog_lightbox_gallery == '1' ) {
																	echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																} elseif ( 'gallery' === $post_format ) {
																	echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
																} elseif ( 'video' === $post_format && $video_type_single == 'self' ) {
																	echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
																} elseif ( 'video' === $post_format ) {
																	echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																} elseif ( 'audio' === $post_format ) {
																	echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																} elseif ( 'quote' === $post_format ) {
																	echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																}
															}
															?>
														</a>
													</div>
												<?php
												}
											
											if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
											?>
											<div class="post-details">
												<?php
													if ( 'yes' === $litho_show_post_category ) {
														echo '<span class="blog-category alt-font">';
															echo litho_post_category( get_the_ID(), false, '1', $litho_post_terms ); // phpcs:ignore
														echo '</span>';
													}
												?>
												<?php if ( 'yes' === $litho_show_post_date ) { ?>
													<span class="post-date published"><?php echo esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ); ?></span>
													<time class="updated d-none" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( $litho_post_date_format ) ); ?></time>
												<?php } ?>
												<?php if ( 'yes' === $litho_show_post_title ) { ?>
													<a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												<?php } ?>
												<?php if ( 'yes' === $litho_show_post_excerpt ) {
													$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
													if ( ! empty( $show_excerpt_grid ) ) { 
													?>
													<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
													<?php } 
												}
												if ( 'yes' === $litho_show_post_read_more_button ) { ?>
													<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
														<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
															<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
															</span>
														</a>
													</div>
												<?php }
												if ( 'yes' === $litho_separator ) {
													echo '<div class="horizontal-separator"></div>';
												}
												if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
													echo '<div class="post-meta">';
														if ( 'yes' === $litho_show_post_author && get_the_author() ) {
															echo '<span class="post-author-meta">';
																if ( 'yes' === $litho_show_post_author_image ) {
																	echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																}
																echo '<span class="author-name">';
																echo esc_html( $litho_show_post_author_text );
																echo '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. esc_html( get_the_author() ) .'</a></span>';
															echo '</span>';
														}
														if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
															echo '<span class="post-meta-like">';
																echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
															echo '</span>';
														}
														if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
															echo '<span class="post-meta-comments">';
																echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
															echo '</span>';
														}
													echo '</div>';
												}
												?>
											</div>
										<?php } ?>
										</div>
									</li>
									<?php
								}
								break;
							case 'blog-standard':

								if ( 'yes' === $litho_show_post_date ) {
									$post_meta_array[] = '<span class="post-date published">'.esc_html( get_the_date( $litho_post_date_format, get_the_ID() ) ).'</span><time class="updated d-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.esc_html( get_the_modified_date( $litho_post_date_format ) ).'</time>';
								}

								if ( 'yes' === $litho_show_post_category ) {
									$post_meta_array[] = '<span class="blog-category alt-font">'. litho_post_category( get_the_ID(), true, '1', $litho_post_terms ).'</span>';
								}

								if ( 'yes' === $litho_show_post_thumbnail && has_post_thumbnail() || 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button || 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
									?>
									<li <?php $this->print_render_attribute_string( $inner_wrapper_key ); // phpcs:ignore ?>>
										<div <?php $this->print_render_attribute_string( $blog_post_key ); // phpcs:ignore ?>>
											<?php
											if ( ! post_password_required() ) {
												if ( 'yes' === $litho_show_post_thumbnail ) {
													?>
													<div class="blog-post-images">
													<?php
														if ( 'gallery' === $post_format && '' === $litho_show_post_format ) {
															echo $this->litho_post_gallery_format(); // phpcs:ignore
														} elseif ( 'video' === $post_format && '' === $litho_show_post_format ) {
															echo $this->litho_post_video_format(); // phpcs:ignore
														} elseif ( 'quote' === $post_format && '' === $litho_show_post_format ) {
															echo $this->litho_post_quote_format(); // phpcs:ignore
														} elseif ( 'audio' === $post_format && '' === $litho_show_post_format ) {
															echo $this->litho_post_audio_format(); // phpcs:ignore
														} else {
															if ( has_post_thumbnail() ) {
															echo '<a href="'.get_permalink().'">';
																echo get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );

																if ( 'yes' === $litho_show_post_thumbnail_icon ) {

																	$blog_lightbox_gallery 	= get_post_meta( get_the_ID(), '_litho_lightbox_image_single', true );
																	$video_type_single 		= get_post_meta( get_the_ID(), '_litho_video_type_single', true );

																	if ( 'gallery' === $post_format && '1' === $blog_lightbox_gallery ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'gallery' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-slider"></span>';
																	} elseif ( 'video' === $post_format && 'self' === $video_type_single ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'-html5"></span>';
																	} elseif ( 'video' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'audio' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	} elseif ( 'quote' === $post_format ) {
																		echo '<span class="post-icon post-type-'.esc_attr( $post_format ).'"></span>';
																	}
																}
															echo '</a>';
														}
														}
													?>
													</div>
												<?php
												}
											}
											if ( 'yes' === $litho_show_post_category || 'yes' === $litho_show_post_date || 'yes' === $litho_show_post_title || 'yes' === $litho_show_post_excerpt || 'yes' === $litho_show_post_read_more_button ) {
												?>
												<div class="post-details">
													<?php if ( ! empty( $post_meta_array ) ) { ?>
														<div class="post-meta">
															<?php echo implode( $litho_post_meta_separator, $post_meta_array ); // phpcs:ignore ?>
														</div>
													<?php } ?>
													<?php if ( 'yes' === $litho_show_post_title ) { ?>
														<h6><a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
													<?php } ?>
													<?php if ( 'yes' === $litho_show_post_excerpt ) {
														$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
														if ( ! empty( $show_excerpt_grid ) ) { 
														?>
														<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
														<?php } 
													} ?>
													<?php if ( 'yes' === $litho_show_post_read_more_button ) { ?>
														<div <?php $this->print_render_attribute_string( $button_key ); // phpcs:ignore ?>>
															<a <?php $this->print_render_attribute_string( $button_link_key ); // phpcs:ignore ?>>
																<span <?php $this->print_render_attribute_string( $button_content_key ); // phpcs:ignore ?>>
																	<span <?php $this->print_render_attribute_string( $button_text_key ); // phpcs:ignore ?>><?php echo esc_html( $litho_show_post_read_more_button_text ); ?></span>
																</span>
															</a>
														</div>
													<?php } ?>
												</div>
												<?php
											}
												if ( 'yes' === $litho_show_post_author || 'yes' === $litho_show_post_like || 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
													echo '<div class="post-meta-wrapper">'; 
														if ( 'yes' === $litho_show_post_author && get_the_author() ) {
															echo '<span class="post-author-meta">';
																if ( 'yes' === $litho_show_post_author_image ) {
																	echo get_avatar( get_the_author_meta( 'ID' ), '30' );
																}
																echo '<span class="author-name"><a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'"><i class="fa-regular fa-user blog-icon"></i> '. esc_html__( 'By', 'litho-addons' ) .' '. esc_html( get_the_author() ) .'</a></span>';
															echo '</span>';
														}
														if ( 'yes' === $litho_show_post_like && function_exists( 'litho_get_simple_likes_button' ) ) {
															echo '<span class="post-meta-like">';
																echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
															echo '</span>';
														}
														if ( 'yes' === $litho_show_post_comments && ( comments_open() || get_comments_number() ) ) {
															echo '<span class="post-meta-comments">';
																echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">'.esc_html__( 'Comment', 'litho-addons' ).'</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">'.esc_html__( 'Comments', 'litho-addons' ).'</span>', 'comment-link' );
															echo '</span>';
														}
													echo '</div>';
												}
											?>
										</div>
									</li>
									<?php
								}
								break;
						}
						$index++;
						$grid_metro_count++;
						$grid_count++;
					endwhile;
					get_next_posts_page_link( $the_query->max_num_pages );
				?>
				</ul>
				<?php
				$this->litho_post_pagination( $the_query );
				
				wp_reset_postdata();
			}
		}

		public function litho_post_pagination( $wpQuery ) {

				$litho_pagination_prev_icon_attr         = '';
				$litho_pagination_next_icon_attr         = '';
				$settings                                = $this->get_settings_for_display();
				$litho_pagination                        = ( isset( $settings['litho_pagination'] ) && $settings['litho_pagination'] ) ? $settings['litho_pagination'] : '';
				$litho_pagination_next_label             = ( isset( $settings['litho_pagination_next_label'] ) && $settings['litho_pagination_next_label'] ) ? $settings['litho_pagination_next_label'] : '';
				$litho_pagination_prev_label             = ( isset( $settings['litho_pagination_prev_label'] ) && $settings['litho_pagination_prev_label'] ) ? $settings['litho_pagination_prev_label'] : '';
				$litho_pagination_load_more_button_label = ( isset( $settings['litho_pagination_load_more_button_label'] ) && $settings['litho_pagination_load_more_button_label'] ) ? $settings['litho_pagination_load_more_button_label'] : esc_html__( 'Load more', 'litho-addons' );
				$litho_load_more_btn_hover_animation     = ( isset( $settings['litho_load_more_btn_hover_animation'] ) && $settings['litho_load_more_btn_hover_animation'] ) ? 'hvr-' . $settings['litho_load_more_btn_hover_animation'] : '';

				if ( $litho_pagination ) {
					ob_start();
						Icons_Manager::render_icon( $settings['litho_pagination_prev_icon'], [
							'aria-hidden' => 'true',
						] );
						$litho_pagination_prev_icon_attr .= ob_get_contents();
					ob_end_clean();
					$litho_pagination_prev_icon_attr .= $litho_pagination_prev_label;

					$litho_pagination_next_icon_attr .= $litho_pagination_next_label;
					ob_start();
						Icons_Manager::render_icon( $settings['litho_pagination_next_icon'], [
							'aria-hidden' => 'true',
						] );
						$litho_pagination_next_icon_attr .= ob_get_contents();
					ob_end_clean();
				}

				switch ( $litho_pagination ) {
					case 'number-pagination':
						$current = ( $wpQuery->query_vars['paged'] > 1 ) ? $wpQuery->query_vars['paged'] : 1;

						add_action( 'number_format_i18n', [ $this, 'litho_pagination_zero_prefix' ] );

						if ( $wpQuery->max_num_pages > 1 ) {
							?><div class="col-12 litho-pagination">
								<div class="pagination align-items-center">
									<?php
									// phpcs:ignore
									echo paginate_links( array(
										'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
										'format'    => '',
										'add_args'  => '',
										'current'   => $current,
										'total'     => $wpQuery->max_num_pages,
										'prev_text' => $litho_pagination_prev_icon_attr,
										'next_text' => $litho_pagination_next_icon_attr,
										'type'      => 'list',
										'end_size'  => 2,
										'mid_size'  => 2
									) );
								?></div>
							</div><?php
						}
						remove_action( 'number_format_i18n', [ $this, 'litho_pagination_zero_prefix' ] );
						break;
					case 'next-prev-pagination':
						if ( $wpQuery->max_num_pages > 1 ) {
							?><div class="blog-pagination col-12">
								<div class="new-post"><?php
									echo get_previous_posts_link( $litho_pagination_prev_icon_attr ); // phpcs:ignore
								?></div>
								<div class="old-post"><?php
									echo get_next_posts_link( $litho_pagination_next_icon_attr, $wpQuery->max_num_pages ); // phpcs:ignore
								?></div>
							</div><?php
						}
						break;
					case 'infinite-scroll-pagination':
						?><div class="blog-pagination blog-infinite-scroll-pagination col-12 d-none" data-pagination="<?php echo esc_attr( $wpQuery->max_num_pages ); ?>">
							<div class="old-post"><?php
								if ( get_next_posts_link( '', $wpQuery->max_num_pages ) ) {
									next_posts_link( esc_html__( 'Next', 'litho-addons' ).'<i aria-hidden="true" class="fa-solid fa-angle-right"></i>', $wpQuery->max_num_pages );
								}
							?></div>
						</div><?php
						break;
					case 'load-more-pagination':
						$this->add_render_attribute( 'pagination_main', [
							'class'           => [ 'blog-pagination blog-infinite-scroll-pagination', 'litho-blog-load-more' ],
							'data-pagination' => $wpQuery->max_num_pages
						] );
						?><div <?php $this->print_render_attribute_string( 'pagination_main' ); // phpcs:ignore ?>>
							<div class="old-post d-none"><?php
								if ( get_next_posts_link( '', $wpQuery->max_num_pages ) ) {
									next_posts_link( esc_html__( 'Next', 'litho-addons' ).'<i aria-hidden="true" class="fa-solid fa-angle-right"></i>', $wpQuery->max_num_pages );
								}
							?></div>
							<div class="load-more-btn text-center">
								<button class="btn view-more-button"><?php
									echo esc_html( $litho_pagination_load_more_button_label );
								?></button>
							</div>
						</div><?php
						break;
				}
		}

		public function litho_post_gallery_format() {
			
			global $litho_srcset;
			
			$litho_blog_lightbox_gallery = litho_post_meta( 'litho_lightbox_image' );
			$litho_blog_gallery          = litho_post_meta( 'litho_gallery' );

			if ( $litho_blog_gallery ) {
				$litho_gallery = explode( ',', $litho_blog_gallery );
			} else {
				$litho_gallery = array();
			}
			$litho_gallery_length = count( $litho_gallery );

			if ( $litho_blog_lightbox_gallery == 1 ) {

				$litho_popup_id = 'blog-' . get_the_ID();

				?><ul class="blog-post-gallery-grid row-cols-lg-3 row-cols-md-2 row-cols-1 row"><?php
					if ( is_array( $litho_gallery ) ) {
						?><li class="grid-gallery-sizer grid-sizer"></li><?php
						foreach ( $litho_gallery as $key => $value ) {
							$litho_thumb = wp_get_attachment_url( $value );
							if ( $litho_thumb ) {
								/* Lightbox */
								$litho_attachment_attributes        = '';
								$litho_image_title_lightbox_popup   = get_theme_mod( 'litho_image_title_lightbox_popup', '0' );
								$litho_image_caption_lightbox_popup = get_theme_mod( 'litho_image_caption_lightbox_popup', '0' );

								if ( 1 == $litho_image_title_lightbox_popup ) {
									$litho_attachment_title      = get_the_title( $value );
									$litho_attachment_attributes .= ! empty( $litho_attachment_title ) ? ' title="' . $litho_attachment_title . '"' : '';
								}

								if ( 1 == $litho_image_caption_lightbox_popup ) {
									$litho_lightbox_caption      = wp_get_attachment_caption( $value );
									$litho_attachment_attributes .= ! empty( $litho_lightbox_caption ) ? ' data-lightbox-caption="' . $litho_lightbox_caption . '"' : '';
								}

								?><li class="grid-gallery-item">
									<a href="<?php echo esc_url( $litho_thumb ); ?>" data-elementor-open-lightbox="no" data-group="lightbox-gallery-<?php echo esc_attr( $litho_popup_id ); ?>" class="lightbox-group-gallery-item"<?php echo sprintf( '%s', $litho_attachment_attributes ); // phpcs:ignore ?>>
										<figure>
											<div class="portfolio-img bg-extra-dark-gray"><?php
												echo wp_get_attachment_image( $value, $litho_srcset );
											?></div>
											<figcaption>
												<div class="blog-post-gallery-hover-main text-center">
													<div class="blog-post-gallery-hover-box">
														<div class="blog-post-gallery-hover-content">
															<i class="ti-plus"></i>
														</div>
													</div>
												</div>
											</figcaption>
										</figure>
									</a>
								</li><?php
							}
						}
					}
				?></ul><?php
			} else {
				if ( is_array( $litho_gallery ) ) {
					?><div class="blog-image">
						<div class="post-format-slider swiper-full-screen swiper white-move">
							<div class="swiper-wrapper"><?php
								foreach ( $litho_gallery as $key => $value ) {
									?><div class="swiper-slide"><?php
										echo wp_get_attachment_image( $value, 'full' );
									?></div><?php
								}
							?></div><?php
							if ( $litho_gallery_length > 1 ) {
								?><div class="swiper-pagination swiper-pagination-border swiper-pagination-white"></div>
								<div class="swiper-button-next swiper-button-white-highlight"><i class="fa-solid fa-chevron-right"></i></div>
								<div class="swiper-button-prev swiper-button-white-highlight"><i class="fa-solid fa-chevron-left"></i></div><?php
							}
						?></div>
					</div>
				<?php
				}
			}
		}

		public function litho_post_quote_format() {

			$litho_blog_quote = litho_post_meta( 'litho_quote' );

			if ( $litho_blog_quote ) {
				?>
				<div class="blog-image litho-blog-blockquote">
					<div class="blockquote-style-3">
						<i class="base-color fa-solid fa-quote-left icon-large"></i>
						<div class="blockquote-content last-paragraph-no-margin alt-font"><?php
							echo nl2br( $litho_blog_quote ); // phpcs:ignore
						?></div>
					</div>
				</div>
				<?php
			}
		}

		public function litho_post_video_format() {

			$litho_video_type = litho_post_meta( 'litho_video_type' );

			if ( 'self' === $litho_video_type ) {
				$litho_video_mp4   = litho_post_meta( 'litho_video_mp4' );
				$litho_video_ogg   = litho_post_meta( 'litho_video_ogg' );
				$litho_video_webm  = litho_post_meta( 'litho_video_webm' );
				$litho_mute        = litho_post_meta( 'litho_enable_mute' );
				$litho_enable_mute = ( 1 === $litho_mute ) ? ' muted' : '';

				if ( $litho_video_mp4 || $litho_video_ogg || $litho_video_webm ) {
					?><div class="blog-image fit-videos blog-video">
						<video<?php echo esc_attr( $litho_enable_mute ); ?> playsinline autoplay loop controls><?php
							if ( ! empty( $litho_video_mp4 ) ) {
								?><source src="<?php echo esc_url( $litho_video_mp4 ); ?>" type="video/mp4"><?php
							}
							if ( ! empty( $litho_video_ogg ) ) {
							   ?><source src="<?php echo esc_url( $litho_video_ogg ); ?>" type="video/ogg"><?php
							}
							if ( ! empty( $litho_video_webm ) ) {
							   ?><source src="<?php echo esc_url( $litho_video_webm ); ?>" type="video/webm"><?php
							}
						?></video>
					</div><?php
				}

			} else {

				$fullscreen_class = '';
				$litho_video_url  = litho_post_meta( 'litho_video' );

				if ( strpos( $litho_video_url, 'player.vimeo.com' ) == true ) {
					$fullscreen_class = ' webkitAllowFullScreen mozallowfullscreen allowFullScreen';
				} else {
					$fullscreen_class = ' allowFullScreen="true"';
				}
				if ( $litho_video_url ) {
					?><div class="blog-image fit-videos blog-video">
						<iframe src="<?php echo esc_url( $litho_video_url ); ?>" width="640" height="360" frameborder="0"<?php echo esc_attr( $fullscreen_class ); ?> allow="autoplay; fullscreen"></iframe>
					</div><?php
				}
			}
		}

		public function litho_post_audio_format() {
			
			$litho_blog_audio = litho_post_meta( 'litho_audio' );
			if ( $litho_blog_audio ) {
				?><div class="blog-image fit-videos litho-blog-audio"><?php
					if ( $litho_blog_audio ) {
						echo wp_oembed_get( $litho_blog_audio );
					} else {
						printf( $litho_blog_audio ); // phpcs:ignore
					}
				?></div><?php
			}
		}

		public function litho_pagination_zero_prefix( $format ) {
			$number = intval( $format );
			if ( intval( $number / 10 ) > 0 ) {
				return $format;
			}
			return '0' . $format;
		}
	}
}
