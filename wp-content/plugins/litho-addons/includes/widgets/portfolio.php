<?php
namespace LithoAddons\Widgets;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use LithoAddons\Controls\Groups\Column_Group_Control;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for portfolio.
 *
 * @package Litho
 */

// If class `Portfolio` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Portfolio' ) ) {

	class Portfolio extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-portfolio';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Portfolio', 'litho-addons' );
		}

		/**
		 * Retrieve the widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-posts-grid';
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
			return [
				'portfolio',
				'masonry',
				'grid',
				'gallery',
				'list',
				'project',
			];
		}

		/**
		 * Register portfolio widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'litho_portfolio_section_content',
				[
					'label' => __( 'General', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_portfolio_style',
				[
					'label'              => __( 'Select style', 'litho-addons' ),
					'type'               => Controls_Manager::SELECT,
					'default'            => 'portfolio-classic',
					'frontend_available' => true,
					'options'            => [
						'portfolio-classic'           => __( 'Classic', 'litho-addons' ),
						'portfolio-boxed'             => __( 'Boxed', 'litho-addons' ),
						'portfolio-colorful'          => __( 'Colorful', 'litho-addons' ),
						'portfolio-bordered'          => __( 'Bordered', 'litho-addons' ),
						'portfolio-overlay'           => __( 'Overlay', 'litho-addons' ),
						'portfolio-switch'            => __( 'Switch', 'litho-addons' ),
						'portfolio-justified-gallery' => __( 'Justified Gallery', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_portfolio_metro_positions',
				[
					'label'   => __( 'Metro grid positions', 'litho-addons' ),
					'type'    => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'description' => __( 'Mention the positions (comma separated like 1, 4, 7) where that image will cover spacing of multiple columns and / or rows considering the image width and height.', 'litho-addons' ),
					'condition'   => [
						'litho_portfolio_style!' => 'portfolio-justified-gallery',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_type_selection',
				[
					'label'   => __( 'Type of Selection', 'litho-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'portfolio-category',
					'options' => [
						'portfolio-category' => __( 'Category', 'litho-addons' ),
						'portfolio-tags'     => __( 'Tags', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_portfolio_categories_list',
				[
					'label'       => __( 'Categories', 'litho-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,
					'options'     => ( function_exists( 'litho_portfolio_category_array' ) ) ? litho_portfolio_category_array() : [],
					'condition'   => [
						'litho_portfolio_type_selection' => 'portfolio-category',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_tags_list',
				[
					'label'       => __( 'Tags', 'litho-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,
					'options'     => ( function_exists( 'litho_portfolio_tags_array' ) ) ? litho_portfolio_tags_array() : [],
					'condition'   => [
						'litho_portfolio_type_selection' => 'portfolio-tags'
					],
				]
			);
			$this->add_control(
				'litho_exclude_portfolio_ids',
				[
					'label'       => __( 'Exclude Portfolio', 'litho-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,
					'options'     => ( function_exists( 'litho_portfolio_array' ) ) ? litho_portfolio_array() : [],
					'description' => __( 'You can use this option to remove certain posts from the list.', 'litho-addons' ),
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_settings',
				[
					'label' => __( 'Settings', 'litho-addons' ),
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
				]
			);
			$this->add_control(
				'litho_portfolio_enable_filter',
				[
					'label'        => __( 'Enable Filter', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'litho-addons' ),
					'label_off'    => __( 'No', 'litho-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);
			$this->add_group_control(
				Column_Group_Control::get_type(),
				[
					'name'      => 'litho_column_settings',
					'condition' => [
						'litho_portfolio_style!' => 'portfolio-justified-gallery',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_last_row',
				[
					'label'     => __( 'Last Row ( Justify )', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'nojustify',
					'options'   => [
						'nojustify' => __( 'No Justify', 'litho-addons' ),
						'justify'   => __( 'Justify', 'litho-addons' ),
						'left'      => __( 'Left', 'litho-addons' ),
						'center'    => __( 'Center', 'litho-addons' ),
						'right'     => __( 'Right', 'litho-addons' ),
						'hide'      => __( 'Hide', 'litho-addons' ),
					],
					'condition' => [
						'litho_portfolio_style' => 'portfolio-justified-gallery',
					],
				]
			);
			$this->add_responsive_control(
				'litho_columns_gap',
				[
					'label'   => __( 'Columns Gap', 'litho-addons' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' => 15,
					],
					'range'   => [
						'px'  => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .portfolio-wrap:not(.portfolio-slider) .portfolio-item, {{WRAPPER}} .portfolio-wrap .portfolio-item' => 'padding: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'litho_portfolio_style!' => [ 'portfolio-justified-gallery' ],
					],
				]
			);
			$this->add_control(
				'litho_portfolio_post_per_page',
				[
					'label'   => __( 'Number of posts to show', 'litho-addons' ),
					'type'    => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => 8,
				]
			);
			$this->add_control(
				'litho_thumbnail',
				[
					'label'          => __( 'Size', 'litho-addons' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => 'full',
					'options'        => ( function_exists( 'litho_get_thumbnail_image_sizes' ) ) ? litho_get_thumbnail_image_sizes() : [],
					'style_transfer' => true,
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_title',
				[
					'label'        => __( 'Show Title', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'litho-addons' ),
					'label_off'    => __( 'No', 'litho-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_subtitle',
				[
					'label'        => __( 'Show Subtitle', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'litho-addons' ),
					'label_off'    => __( 'No', 'litho-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);
			$this->add_control(
				'litho_portfolio_orderby',
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
					],
				]
			);
			$this->add_control(
				'litho_portfolio_order',
				[
					'label'     => __( 'Posts sort by', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'DESC',
					'options'   => [
						'DESC'      => __( 'Descending', 'litho-addons' ),
						'ASC'       => __( 'Ascending', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_porfolio_grid_animation',
				[
					'label'     => __( 'Entrance Animation', 'litho-addons' ),
					'type'      => Controls_Manager::ANIMATION,
					'condition' => [
						'litho_portfolio_style!' => [ 'portfolio-justified-gallery' ],
					],
				]
			);
			$this->add_control(
				'litho_porfolio_grid_animation_duration',
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
						'litho_porfolio_grid_animation!' => [ '', 'default' ],
						'litho_portfolio_style!'         => [ 'portfolio-justified-gallery' ] // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_porfolio_grid_animation_delay',
				[
					'label'			=> __( 'Animation Delay', 'litho-addons' ),
					'type'			=> Controls_Manager::NUMBER,
					'default'		=> '',
					'min'			=> 0,
					'max'			=> 1500,
					'step' 			=> 50,
					'condition'     => [
						'litho_porfolio_grid_animation!' => [ '', 'default' ],
						'litho_portfolio_style!' 		 => [ 'portfolio-justified-gallery' ] // NOT IN
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_pagination',
				[
					'label'         => __( 'Pagination', 'litho-addons' ),
					'show_label'    => false
				]
			);
			$this->add_control(
				'litho_porfolio_pagination_type',
				[
					'label'         => __( 'Pagination Type', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => '',
					'description'	=> __( 'Changes will be reflected in the frontend only.', 'litho-addons' ),
					'options'       => [
						''								=> __( 'None', 'litho-addons' ),
						'number-pagination'				=> __( 'Number', 'litho-addons' ),
						'infinite-scroll-pagination'	=> __( 'Infinite Scroll', 'litho-addons' ),
						'load-more-pagination'			=> __( 'Load More', 'litho-addons' )
					],
					'condition'     => [
						'litho_enable_masonry' => 'yes',
					]
				]
			);
			$this->add_control(
				'litho_porfolio_pagination_type1',
				[
					'label'         => __( 'Pagination Type', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => '',
					'description'	=> __( 'Changes will be reflected in the frontend only.', 'litho-addons' ),
					'options'       => [
						''                  => __( 'None', 'litho-addons' ),
						'number-pagination' => __( 'Number', 'litho-addons' ),
					],
					'condition'     => [
						'litho_enable_masonry' => '',
					]
				]
			);
			$this->add_control(
				'litho_pagination_next_label',
				[
					'label'         => __( 'Next Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'Next', 'litho-addons' ),
					'condition'     => [
						'litho_porfolio_pagination_type' => [ 'number-pagination' ]
					]
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
					'condition'     => [
						'litho_porfolio_pagination_type' => [ 'number-pagination' ]
					]
				]
			);

			$this->add_control(
				'litho_pagination_prev_label',
				[
					'label'         => __( 'Previous Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'Previous', 'litho-addons' ),
					'separator' 	=> 'before',
					'condition'     => [
						'litho_porfolio_pagination_type' => [ 'number-pagination' ]
					]
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
					'condition'     => [
						'litho_porfolio_pagination_type' => [ 'number-pagination' ]
					]
				]
			);
			$this->add_control(
				'litho_pagination_load_more_button_label',
				[
					'label'         => __( 'Button Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'Load more', 'litho-addons' ),
					'render_type'	=> 'template',
					'condition'     => [
						'litho_porfolio_pagination_type' => [ 'load-more-pagination' ]
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_icons',
				[
					'label'			=> __( 'Link or Lightbox', 'litho-addons' ),
					'condition'      => [
						'litho_portfolio_style'	=> [ 'portfolio-classic', 'portfolio-boxed', 'portfolio-colorful', 'portfolio-overlay', 'portfolio-bordered', 'portfolio-switch' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_portfolio_show_custom_link',
				[
					'label'         => __( 'Show Link', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => 'yes',
					'condition'      => [
						'litho_portfolio_style!' => 'portfolio-justified-gallery' // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_portfolio_custom_link_icon',
				[
					'label'             => __( 'Icon', 'litho-addons' ),
					'type'              => Controls_Manager::ICONS,
					'fa4compatibility'  => 'icon',
					'default'           => [
							'value'         => 'fa-solid fa-link',
							'library'       => 'fa-solid',
					],
					'condition'         => [
						'litho_portfolio_show_custom_link' => 'yes',
						'litho_portfolio_style!' 			=> [ 'portfolio-bordered', 'portfolio-switch', 'portfolio-justified-gallery' ] // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_portfolio_open_lightbox_separator',
				[
					'type'      => Controls_Manager::DIVIDER,
					'style'     => 'thick',
					'condition'		=> [
						'litho_portfolio_style!'	=> [ 'portfolio-bordered', 'portfolio-switch', 'portfolio-justified-gallery' ] // NOT IN
					]
				]
			);
			$this->add_control(
				'litho_portfolio_open_lightbox',
				[
					'label'			=> __( 'Show Lightbox', 'litho-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'Yes', 'litho-addons' ),
					'label_off'		=> __( 'No', 'litho-addons' ),
					'return_value'	=> 'yes',
					'default'		=> 'yes',
					'condition'		=> [
						'litho_portfolio_style' => 'portfolio-classic', // IN
					]
				]
			);
			$this->add_control(
				'litho_portfolio_lightbox_icon',
				[
					'label'             => __( 'Icon', 'litho-addons' ),
					'type'              => Controls_Manager::ICONS,
					'fa4compatibility'  => 'icon',
					'default'           => [
							'value'         => 'fa-solid fa-search',
							'library'       => 'fa-solid',
					],
					'condition'         => [
						'litho_portfolio_open_lightbox'	=> 'yes',
						'litho_portfolio_style'			=> 'portfolio-classic' // IN
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_general_style',
				[
					'label'             => __( 'General', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'show_label'        => false,
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_content_box_alignment',
				[
					'label'             => __( 'Text  Alignment', 'litho-addons' ),
					'type'              => Controls_Manager::CHOOSE,
					'label_block'       => false,
					'default'           => 'center',
					'options'           => [
						'left'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-caption' => 'text-align: {{VALUE}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_item_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-item figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .justified-gallery .jg-entry' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style!' => 'portfolio-switch' // NOT IN
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_portfolio_item_shadow',
					'selector'      => '{{WRAPPER}} .portfolio-item figure, {{WRAPPER}} .portfolio-justified-gallery .jg-entry',
					'condition' 	=> [
						'litho_portfolio_style!' => 'portfolio-switch' // NOT IN
					]
				]
			);

			// Image Box Shadow for switch style.
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_portfolio_image_box_shadow',
					'selector'      => '{{WRAPPER}} .portfolio-item .portfolio-image',
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-switch' // IN
					],
				]
			);
			// END Image Box Shadow for switch style.

			$this->add_control(
				'litho_portfolio_content_box_heading',
				[
					'label'         => __( 'Content Box', 'litho-addons' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);
			$this->start_controls_tabs( 'litho_portfolio_content_box_tabs' );
				$this->start_controls_tab(
					'litho_portfolio_content_box_normal_tab',
					[
						'label' => __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-switch' ] // IN
						],
					]
				);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'		=> 'litho_portfolio_content_box_color',
							'types'		=> [ 'classic', 'gradient' ],
							'exclude'	=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'	=> '{{WRAPPER}} .portfolio-wrap:not(.portfolio-bordered) .portfolio-caption, {{WRAPPER}} .portfolio-bordered .portfolio-hover',

						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_portfolio_content_box_hover_tab', 
					[ 
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-switch' ] // IN
						],
					] 
				);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_portfolio_content_box_hover_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'          => '{{WRAPPER}} .portfolio-wrap:not(.portfolio-bordered) figure:hover .portfolio-caption',
							'condition' 		=> [
								'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-switch' ] // IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_portfolio_content_box_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-wrap:not(.portfolio-bordered) .portfolio-caption, {{WRAPPER}} .portfolio-bordered .portfolio-hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style!' => [ 'portfolio-classic', 'portfolio-overlay', 'portfolio-switch' ] // NOT IN
					],
					'separator'	=> 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_portfolio_content_box_shadow',
					'selector'      => '{{WRAPPER}} .portfolio-wrap:not(.portfolio-bordered) .portfolio-caption, {{WRAPPER}} .portfolio-bordered .portfolio-hover',
					'condition' 	=> [
						'litho_portfolio_style!' => [ 'portfolio-classic', 'portfolio-overlay', 'portfolio-switch' ] // NOT IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_content_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-wrap:not(.portfolio-bordered) .portfolio-caption, {{WRAPPER}} .portfolio-bordered .portfolio-hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_content_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-wrap:not(.portfolio-bordered) .portfolio-caption, {{WRAPPER}} .portfolio-bordered .portfolio-hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_title_style',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition' 	=> [
						'litho_portfolio_show_post_title' => 'yes'
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .portfolio-caption .title',
				]
			);
			$this->start_controls_tabs( 'litho_portfolio_title_tabs' );
				$this->start_controls_tab(
					'litho_portfolio_title_normal_tab',
					[
						'label'			=> __( 'Normal', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style' => 'portfolio-classic' // IN
						],
					]
				);
					$this->add_control(
						'litho_portfolio_title_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-caption .title'		=> 'color: {{VALUE}};',
								'{{WRAPPER}} .portfolio-caption .title a'	=> 'color: {{VALUE}};',
							]
						]
					);  
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_portfolio_title_hover_tab',
					[
						'label'			=> __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style' => 'portfolio-classic' // IN
						],
					]
				);
					$this->add_control(
						'litho_portfolio_title_hover_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-caption .title a:hover' => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_portfolio_style' => 'portfolio-classic' // IN
							],
						]
					);
					
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'litho_portfolio_title_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'default'       => 'move-bottom-top-self',
					'options'       => [
						''						=> __( 'None', 'litho-addons' ),
						'move-bottom-top-self'	=> __( 'Move Bottom Top Self', 'litho-addons' ),
						'move-top-bottom-self'	=> __( 'Move Top Bottom Self', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-colorful' ] // IN
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_title_min_height',
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
						'{{WRAPPER}} .portfolio-caption' => 'min-height: {{SIZE}}{{UNIT}} !important;',
					],
					'condition' => [ 
						'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-switch' ] // IN
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_subtitle_style',
				[
					'label'             => __( 'Subtitle', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'show_label'        => false,
					'condition' 	=> [
						'litho_portfolio_show_post_subtitle' => 'yes'
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_subtitle_typography',
					'selector'	=> '{{WRAPPER}} .portfolio-caption .subtitle',
				]
			);

			$this->add_control(
				'litho_portfolio_subtitle_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .portfolio-caption .subtitle' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_control(
				'litho_portfolio_subtitle_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'default'       => 'move-top-bottom-self',
					'options'       => [
						''						=> __( 'None', 'litho-addons' ),
						'move-bottom-top-self'	=> __( 'Move Bottom Top Self', 'litho-addons' ),
						'move-top-bottom-self'	=> __( 'Move Top Bottom Self', 'litho-addons' ),
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-colorful' ] // IN
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_overlay_style',
				[
					'label'         => __( 'Overlay', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_overlay_icon_v_alignment',
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
						'{{WRAPPER}} .portfolio-hover' => 'align-items: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-colorful', 'portfolio-bordered', 'portfolio-overlay' ] // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_overlay_icon_h_alignment',
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
						'{{WRAPPER}} .portfolio-hover' => 'justify-content: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-colorful', 'portfolio-bordered' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_portfolio_overlay_image_opacity',
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
						'{{WRAPPER}} .portfolio-justified-gallery.justified-gallery .jg-entry-visible:hover img' => 'opacity: {{SIZE}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-justified-gallery' ] // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_overlay_bordered',
				[
					'label' 	=> __( 'Border', 'litho-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 400,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .portfolio-bordered .portfolio-hover' => 'left: calc({{SIZE}}{{UNIT}}/2); top: calc({{SIZE}}{{UNIT}}/2); height: calc(100% - {{SIZE}}{{UNIT}} ); width: calc(100% - {{SIZE}}{{UNIT}} );',
					],
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-bordered' ] // IN
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'              => 'litho_portfolio_overlay_color',
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
					'selector'			=> '{{WRAPPER}} .portfolio-classic .portfolio-image, {{WRAPPER}} .portfolio-bordered .portfolio-image, {{WRAPPER}} .portfolio-overlay .portfolio-image, {{WRAPPER}} .portfolio-colorful .portfolio-hover, {{WRAPPER}} .portfolio-justified-gallery .jg-entry',
					'condition' 	=> [
						'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-bordered', 'portfolio-overlay', 'portfolio-colorful', '.portfolio-justified-gallery' ] // IN
					]
				]
			);
			$this->add_control(
				'litho_portfolio_overlay_hover_animation',
				[
					'label'         => __( 'Hover Animation', 'litho-addons' ),
					'type'          => Controls_Manager::HOVER_ANIMATION,
					'condition' 	=> [
						'litho_portfolio_style!' => [ 'portfolio-bordered', 'portfolio-justified-gallery' ] // NOT IN
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_icons_style',
				[
					'label' 		=> __( 'Icons', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition' 	=> [
						'litho_portfolio_style!'	=> [ 'portfolio-bordered', 'portfolio-switch', 'portfolio-justified-gallery' ] // NOT IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_icon_size',
				[
					'label'		=> __( 'Size', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'range'		=> [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .portfolio-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator'	=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_icon_box_size',
				[
					'label'		=> __( 'Box Size', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'range'		=> [
							'px' => [
								'min' => 10,
								'max' => 200,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .portfolio-icon a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-classic' // IN
					],
				]
			);
			$this->add_responsive_control(
				'litho_icon_space',
				[
					'label'		=> __( 'Spacing', 'litho-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'range'		=> [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
					],
					'selectors' => [
						'{{WRAPPER}} .portfolio-icon .lightbox-group-gallery-item' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-classic' // IN
					],
				]
			);

			$this->start_controls_tabs( 'litho_portfolio_icons_tabs' );
				$this->start_controls_tab( 'litho_portfolio_icons_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_portfolio_icons_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-icon i' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_control(
						'litho_portfolio_icons_bg_color',
						[
							'label'     => __( 'Background Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-icon a' => 'background-color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_portfolio_style' => 'portfolio-classic' // IN
							]
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 			=> 'litho_portfolio_icons_box_shadow',
							'selector' 		=> '{{WRAPPER}} .portfolio-icon a',
							'condition' 	=> [
								'litho_portfolio_style' => 'portfolio-classic' // IN
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_portfolio_icons_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
						'condition' 	=> [
							'litho_portfolio_style' => [ 'portfolio-classic', 'portfolio-colorful', 'portfolio-overlay' ] // IN
						]
					]
				);
					$this->add_control(
						'litho_portfolio_icons_hover_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-icon a:hover i' => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_portfolio_style' => 'portfolio-classic' // IN
							]
						]
					);
					$this->add_control(
						'litho_portfolio_icons_bg_hover_color',
						[
							'label'     => __( 'Background Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .portfolio-icon a:hover' => 'background-color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_portfolio_style' => 'portfolio-classic' // IN
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 			=> 'litho_portfolio_icons_hover_box_shadow',
							'selector' 		=> '{{WRAPPER}} .portfolio-icon a:hover',
							'condition' 	=> [
								'litho_portfolio_style' => 'portfolio-classic' // IN
							],
						]
					);
					$this->add_control(
						'litho_portfolio_icon_hover_animation',
						[
							'label'         => __( 'Hover Animation', 'litho-addons' ),
							'type'          => Controls_Manager::SELECT2,
							'label_block'   => true,
							'default'       => 'move-right-left',
							'options'       => [
								''						=> __( 'None', 'litho-addons' ),
								'move-top-bottom'		=> __( 'Move Top Bottom', 'litho-addons' ),
								'move-bottom-top'		=> __( 'Move Bottom Top', 'litho-addons' ),
								'move-left-right'		=> __( 'Move Left Right', 'litho-addons' ),
								'move-right-left'		=> __( 'Move Right Left', 'litho-addons' ),
							],
							'condition' 	=> [
								'litho_portfolio_style' => [ 'portfolio-colorful', 'portfolio-overlay' ] // IN
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'           => 'litho_portfolio_icons_border',
					'default'        => '1px',
					'selector'       => '{{WRAPPER}} .portfolio-icon a',
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-classic' // IN
					],
					'separator'      => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_icons_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'custom' ],
					'default'       => [
						'unit'      => '%',
						'top'       => 50,
						'right'     => 50,
						'bottom'    => 50,
						'left'      => 50,
					],
					'selectors'     => [
						'{{WRAPPER}} .portfolio-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-classic', // IN
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_icons_margin',
				[
					'label'			=> __( 'Margin', 'litho-addons' ),
					'type'			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .portfolio-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_portfolio_style' => 'portfolio-classic' // IN
					]
				]
			);
			$this->end_controls_section();
			

			$this->start_controls_section(
				'litho_section_pagination_style',
				[
					'label'         => __( 'Pagination', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false,
					'condition'     => [
						'litho_porfolio_pagination_type' => [ 'number-pagination', 'load-more-pagination' ]
					]
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
						'flex-start' => [
							'title'         => __( 'Left', 'litho-addons' ),
							'icon'          => 'eicon-text-align-left',
						],
						'center'     => [
							'title'         => __( 'Center', 'litho-addons' ),
							'icon'          => 'eicon-text-align-center',
						],
						'flex-end'   => [
							'title'         => __( 'Right', 'litho-addons' ),
							'icon'          => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .litho-pagination' => 'display: flex; justify-content: {{VALUE}};',
						'{{WRAPPER}} .litho-pagination .load-more-btn' => 'text-align: {{VALUE}};',
					],
					'condition'     => [
						'litho_porfolio_pagination_type' => [ 'number-pagination', 'load-more-pagination' ]
					]
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
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'number-pagination'
					]
				]
			);
			$this->start_controls_tabs( 'litho_pagination_tabs' );
				$this->start_controls_tab( 'litho_pagination_normal_tab',
					[
						'label'		=> __( 'Normal', 'litho-addons' ),
						'condition'	=> [
							'litho_porfolio_pagination_type' => 'number-pagination'
						]

					]);
					$this->add_control(
						'litho_pagination_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .page-numbers li .page-numbers , {{WRAPPER}} .new-post a , {{WRAPPER}} .old-post a' => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_porfolio_pagination_type' => 'number-pagination'
							]
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_pagination_hover_tab',
					[
						'label'		=> __( 'Hover', 'litho-addons' ),
						'condition'	=> [
							'litho_porfolio_pagination_type' => 'number-pagination'
						]

					]);
					$this->add_control(
						'litho_pagination_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .page-numbers li .page-numbers:hover, {{WRAPPER}} .new-post a:hover , {{WRAPPER}} .old-post a:hover'    => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_porfolio_pagination_type' => 'number-pagination'
							]
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab( 'litho_pagination_active_tab',
					[
						'label' => __( 'Active', 'litho-addons' ),
						'condition' 	=> [
							'litho_pagination' => 'number-pagination'
						]
					]);
					$this->add_control(
						'litho_pagination_active_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .page-numbers li .page-numbers.current'    => 'color: {{VALUE}};',
							],
							'condition' 	=> [
								'litho_porfolio_pagination_type' => 'number-pagination'
							] 
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

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
						'litho_porfolio_pagination_type' => 'number-pagination'
					],
					'separator'		=> 'before'
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
						'{{WRAPPER}} .litho-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'number-pagination'
					]
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
					'selector' 	=> '{{WRAPPER}} .litho-pagination .view-more-button',
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->start_controls_tabs( 'litho_tabs_button_style' );
			$this->start_controls_tab(
				'litho_tab_button_normal',
				[
					'label' 		=> __( 'Normal', 'litho-addons' ),
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
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
						'{{WRAPPER}} .litho-pagination .view-more-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
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
					'selector' 			=> '{{WRAPPER}} .litho-pagination .view-more-button',
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'litho_tab_button_hover',
				[
					'label' 		=> __( 'Hover', 'litho-addons' ),
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->add_control(
				'litho_hover_color',
				[
					'label' 		=> __( 'Text Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-pagination .view-more-button:hover, {{WRAPPER}} .litho-pagination .view-more-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} .litho-pagination .view-more-button:hover svg, {{WRAPPER}} .litho-pagination .view-more-button:focus svg' => 'fill: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
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
					'selector' 			=> '{{WRAPPER}} .litho-pagination .view-more-button:hover, {{WRAPPER}} .litho-pagination .view-more-button:focus',
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);

			$this->add_control(
				'litho_button_hover_border_color',
				[
					'label' 		=> __( 'Border Color', 'litho-addons' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .litho-pagination .view-more-button:hover, {{WRAPPER}} .litho-pagination .view-more-button:focus' => 'border-color: {{VALUE}};',
					],
					'condition' 	=> [
						'litho_border_border!' => '',
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->add_control(
				'litho_hover_animation',
				[
					'label' 		=> __( 'Hover Animation', 'litho-addons' ),
					'type'			=> Controls_Manager::HOVER_ANIMATION,
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->add_control(
				'litho_button_hover_transition',
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
						'{{WRAPPER}} .litho-pagination .view-more-button' => 'transition-duration: {{SIZE}}s',
					],
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'litho_border',
					'selector' 		=> '{{WRAPPER}} .litho-pagination .view-more-button',
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
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
						'{{WRAPPER}} .litho-pagination .view-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 			=> 'litho_button_box_shadow',
					'selector' 		=> '{{WRAPPER}} .litho-pagination .view-more-button',
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
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
						'{{WRAPPER}} .litho-pagination .view-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'litho_porfolio_pagination_type' => 'load-more-pagination'
					]
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render portfolio widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			global $litho_portfolio_unique_id;

			$portfolio_classes_infinite_scroll = '';
			$settings                          = $this->get_settings_for_display();
			$litho_exclude_portfolio_ids       = $this->get_settings( 'litho_exclude_portfolio_ids' );
			$is_new                            = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$custom_link_icon_migrated         = isset( $settings['__fa4_migrated']['litho_portfolio_custom_link_icon'] );
			$portfolio_style                   = ( isset( $settings['litho_portfolio_style'] ) && $settings['litho_portfolio_style'] ) ? $settings['litho_portfolio_style'] : '';
			$portfolio_type_selection          = ( isset( $settings['litho_portfolio_type_selection'] ) && $settings['litho_portfolio_type_selection'] ) ? $settings['litho_portfolio_type_selection'] : 'portfolio-category';
			$portfolio_enable_filter           = ( isset( $settings['litho_portfolio_enable_filter'] ) && $settings['litho_portfolio_enable_filter'] ) ? $settings['litho_portfolio_enable_filter'] : '';
			$litho_portfolio_last_row          = ( isset( $settings['litho_portfolio_last_row'] ) && $settings['litho_portfolio_last_row'] ) ? $settings['litho_portfolio_last_row'] : '';
			$litho_enable_masonry              = ( isset( $settings['litho_enable_masonry'] ) && $settings['litho_enable_masonry'] ) ? $settings['litho_enable_masonry'] : '';

			
			/* Column Settings */
			$litho_column_desktop_column = ! empty( $settings[ 'litho_column_settings_litho_larger_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_larger_desktop_column' ] : 'grid-3col';

			$litho_column_ratio = '';
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
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_larger_desktop_column'] ) ? $settings['litho_column_settings_litho_larger_desktop_column'] : 'grid-3col';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_large_desktop_column'] ) ? $settings['litho_column_settings_litho_large_desktop_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_desktop_column'] ) ? $settings['litho_column_settings_litho_desktop_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_tablet_column'] ) ? $settings['litho_column_settings_litho_tablet_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_landscape_phone_column'] ) ? $settings['litho_column_settings_litho_landscape_phone_column'] : '';
			$litho_column_class[]    = ! empty( $settings['litho_column_settings_litho_portrait_phone_column'] ) ? $settings['litho_column_settings_litho_portrait_phone_column'] : '';

			$litho_column_class      = array_filter( $litho_column_class );
			$litho_column_class_list = implode( ' ', $litho_column_class );
			/* End Column Settings */

			$portfolio_categories_list               = ( isset( $settings['litho_portfolio_categories_list'] ) && $settings['litho_portfolio_categories_list'] ) ? $settings['litho_portfolio_categories_list'] : array();
			$portfolio_tags_list                     = ( isset( $settings['litho_portfolio_tags_list'] ) && $settings['litho_portfolio_tags_list'] ) ? $settings['litho_portfolio_tags_list'] : array();
			$portfolio_post_per_page                 = ( isset( $settings['litho_portfolio_post_per_page'] ) && $settings['litho_portfolio_post_per_page'] ) ? $settings['litho_portfolio_post_per_page'] : -1;
			$portfolio_show_post_title               = ( isset( $settings['litho_portfolio_show_post_title'] ) && $settings['litho_portfolio_show_post_title'] ) ? $settings['litho_portfolio_show_post_title'] : '';
			$portfolio_show_post_subtitle            = ( isset( $settings['litho_portfolio_show_post_subtitle'] )&& $settings['litho_portfolio_show_post_subtitle'] ) ? $settings['litho_portfolio_show_post_subtitle'] : '';
			$portfolio_orderby                       = ( isset( $settings['litho_portfolio_orderby'] ) && $settings['litho_portfolio_orderby'] ) ? $settings['litho_portfolio_orderby'] : '';
			$portfolio_order                         = ( isset( $settings['litho_portfolio_order'] ) && $settings['litho_portfolio_order'] ) ? $settings['litho_portfolio_order'] : '';
			$porfolio_pagination_type                = ( isset( $settings['litho_porfolio_pagination_type'] ) && $settings['litho_porfolio_pagination_type'] ) ? $settings['litho_porfolio_pagination_type'] : '';
			$litho_pagination_next_label             = ( isset( $settings['litho_pagination_next_label'] ) && $settings['litho_pagination_next_label'] ) ? $settings['litho_pagination_next_label'] : '';
			$litho_pagination_prev_label             = ( isset( $settings['litho_pagination_prev_label'] ) && $settings['litho_pagination_prev_label'] ) ? $settings['litho_pagination_prev_label'] : '';
			$litho_pagination_load_more_button_label = ( isset( $settings['litho_pagination_load_more_button_label'] ) && $settings['litho_pagination_load_more_button_label'] ) ? $settings['litho_pagination_load_more_button_label'] : esc_html__( 'Load more', 'litho-addons' );

			$litho_hover_animation                   = ( isset( $settings['litho_hover_animation'] ) && $settings['litho_hover_animation'] ) ? ' hvr-' . $settings['litho_hover_animation'] : '';

			// Entrance Animation.
			$litho_porfolio_grid_animation          = ( isset( $settings['litho_porfolio_grid_animation'] ) && $settings['litho_porfolio_grid_animation'] ) ? $settings['litho_porfolio_grid_animation'] : '';
			$litho_porfolio_grid_animation_duration = ( isset( $settings['litho_porfolio_grid_animation_duration'] ) && $settings['litho_porfolio_grid_animation_duration'] ) ? $settings['litho_porfolio_grid_animation_duration'] : '';
			$litho_porfolio_grid_animation_delay    = ( isset( $settings['litho_porfolio_grid_animation_delay'] ) && $settings['litho_porfolio_grid_animation_delay'] ) ? $settings['litho_porfolio_grid_animation_delay'] : 100;

			// Hover Animation.
			$portfolio_title_hover_animation    = ( isset( $settings['litho_portfolio_title_hover_animation'] ) && $settings['litho_portfolio_title_hover_animation'] ) ? ' hvr-' . $settings['litho_portfolio_title_hover_animation'] : '';
			$portfolio_subtitle_hover_animation = ( isset( $settings['litho_portfolio_subtitle_hover_animation'] ) && $settings['litho_portfolio_subtitle_hover_animation'] ) ? ' hvr-' . $settings['litho_portfolio_subtitle_hover_animation'] : '';
			$portfolio_icon_hover_animation     = ( isset( $settings['litho_portfolio_icon_hover_animation'] ) && $settings['litho_portfolio_icon_hover_animation'] ) ? ' hvr-' . $settings['litho_portfolio_icon_hover_animation'] : '';
			$portfolio_overlay_hover_animation  = ( isset( $settings['litho_portfolio_overlay_hover_animation'] ) && $settings['litho_portfolio_overlay_hover_animation'] ) ? 'hvr-' . $settings['litho_portfolio_overlay_hover_animation'] : '';

			// Check if portfolio id and class.
			$litho_portfolio_unique_id = ! empty( $litho_portfolio_unique_id ) ? $litho_portfolio_unique_id : 1;
			$litho_portfolio_id        = 'litho-portfolio';
			$litho_portfolio_id        .= '-' . $litho_portfolio_unique_id;
			$litho_portfolio_unique_id++;

			if ( 'portfolio-tags' === $portfolio_type_selection ) {
				$categories_to_display_ids = ( ! empty( $portfolio_tags_list ) ) ? $portfolio_tags_list : array();
			} else {
				$categories_to_display_ids = ( ! empty( $portfolio_categories_list ) ) ? $portfolio_categories_list : array();
			}

			// If no categories are chosen or "All categories", we need to load all available categories.
			if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
				$terms = get_terms( $portfolio_type_selection );
				if ( ! is_array( $categories_to_display_ids ) ) {
					$categories_to_display_ids = array();
				}
				foreach ( $terms as $term ) {
					$categories_to_display_ids[] = $term->slug;
				}
			} else {
				$categories_to_display_ids = array_values( $categories_to_display_ids );
			}

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' ); 
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' ); 
			} else {
				$paged = 1;
			}

			$query_args = array(
				'post_type'      => 'portfolio',
				'post_status'    => 'publish',
				'posts_per_page' => intval( $portfolio_post_per_page ),
				'paged'          => $paged,
			);

			if ( ! empty( $categories_to_display_ids ) ) {
				$query_args['tax_query'] = [
					[
						'taxonomy' => $portfolio_type_selection,
						'field'    => 'slug',
						'terms'    => $categories_to_display_ids
					]
				];
			}

			if ( ! empty( $portfolio_orderby ) ) {
				$query_args['orderby'] = $portfolio_orderby;
			}

			if ( ! empty( $portfolio_order ) ) {
				$query_args['order'] = $portfolio_order;
			}

			$portfolio_grid_status_filter = ( 'yes' === $portfolio_enable_filter ) ? 'portfolio-grid-with-filter' : 'portfolio-grid-without-filter';

			if ( ! empty( $litho_exclude_portfolio_ids ) ) {
				$litho_exclude_portfolio_ids = array_merge( $litho_exclude_portfolio_ids );
		
			}

			if ( ! empty( $litho_exclude_portfolio_ids ) ) {
				$query_args[ 'post__not_in' ] = $litho_exclude_portfolio_ids;
			}


			$the_query = new \WP_Query( $query_args );

			$data_settings = array(
				'pagination_type'      => $porfolio_pagination_type,
				'litho_enable_masonry' => $litho_enable_masonry
			);

			$this->add_render_attribute( 'wrapper', [
				'class' => [
					$portfolio_style
				]
			] );

			if ( 'yes' === $this->get_settings( 'litho_image_stretch' ) ) {
				$this->add_render_attribute(
					'main_wrapper',
					'class',
					'swiper-image-stretch'
				);
			}

			// common class for all styles
			if ( 'yes' === $litho_enable_masonry ) {
				// common class for all styles.
				$this->add_render_attribute(
					'wrapper',
					[
						'class' => [
							'portfolio-wrap',
							'grid-masonry',
						],
					],
				);
			} else {
				// common class for all styles.
				$this->add_render_attribute(
					'wrapper',
					[
						'class' => [
							'portfolio-wrap',
							'no-masonry',
						],
					],
				);
			}

			$loader_class = '';
			if ( ! Plugin::$instance->editor->is_edit_mode() ) {
				$loader_class = 'grid-loading';
			} elseif ( ! Plugin::$instance->preview->is_preview_mode() ) {
				$loader_class = 'grid-loading';
			}

			$this->add_render_attribute(
				'main_wrapper',
				[
					'class' => 'filter-content'
				]
			);

			switch ( $portfolio_style ) {
				case 'portfolio-justified-gallery':
					$this->add_render_attribute(
						'wrapper',
						[
							'class'                   => [
								'portfolio-grid',
								'justified-gallery',
								$portfolio_grid_status_filter,
								$litho_portfolio_id,
							],
							'data-filter-status'      => $portfolio_enable_filter,
							'data-portfolio-settings' => json_encode( $data_settings ),
							'data-last-row'           =>  $litho_portfolio_last_row
					] );
					break;
				default:
					if ( 'yes' === $litho_enable_masonry ) {
						$this->add_render_attribute(
							'wrapper',
							[
								'class'                   => [
									'portfolio-grid',
									'grid',
									$loader_class,
									$portfolio_grid_status_filter,
									$litho_column_class_list,
								],
								'data-filter-status'      => $portfolio_enable_filter,
								'data-portfolio-settings' => json_encode( $data_settings )
							]
						);
					} else {
						$this->add_render_attribute(
							'wrapper',
							[
								'class'                   => [
									'portfolio-grid',
									'grid',
									$portfolio_grid_status_filter,
									$litho_column_class_list,
								],
								'data-filter-status'      => $portfolio_enable_filter,
								'data-portfolio-settings' => json_encode( $data_settings )
							]
						);
					}
					break;
			}

			// Pagination.
			if ( ! empty( $porfolio_pagination_type ) ) {
				switch ( $porfolio_pagination_type ) {
					case 'infinite-scroll-pagination':
					case 'load-more-pagination':
						$this->add_render_attribute(
							'wrapper',
							[
								'class' => 'portfolio-infinite-scroll-pagination',
							]
						);
						$portfolio_classes_infinite_scroll = 'portfolio-single-post';
						break;
				}
			}

			/* Portfolio Metro */
			$litho_portfolio_metro_positions = $this->get_settings( 'litho_portfolio_metro_positions' );
			$litho_double_grid_position      = ( ! empty( $litho_portfolio_metro_positions ) ) ? explode( ',', $litho_portfolio_metro_positions ) : array();

			if ( $the_query->have_posts() ) {
				?>
				<div <?php $this->print_render_attribute_string( 'main_wrapper' ); ?>>
					<?php 
					$this->litho_start_wrapper();

					$index            = 0;
					$grid_count       = 1;
					$grid_metro_count = 1;

					while( $the_query->have_posts() ) : $the_query->the_post();

						if ( $index % $litho_column_ratio == 0 ) {
							$grid_count = 1;
						}

						$image_url          = '';
						$image_alt          = '';
						$alternate_image    = '';
						$cat_links          = array();
						$cat_slug_cls       = array();
						$figure_wrap_key    = 'figure_wrap_' . $index;
						$inner_wrap_key     = 'inner_wrap_' . $index;
						$custom_link_key    = 'custom_link_' . $index;
						$litho_subtitle     = litho_post_meta( 'litho_subtitle' );
						$alternate_image_id = litho_post_meta( 'litho_portfolio_alternate_image' );
						$has_post_format    = litho_post_meta( 'litho_portfolio_post_type' );
						$cat                = get_the_terms( get_the_ID(), $portfolio_type_selection );
						
						if ( 'link' == $has_post_format || has_post_format( 'link', get_the_ID() ) ) {

							$portfolio_external_link = litho_post_meta( 'litho_portfolio_external_link' );
							$portfolio_link_target   = litho_post_meta( 'litho_portfolio_link_target' );
							$portfolio_external_link = ( ! empty( $portfolio_external_link ) ) ? $portfolio_external_link : '#' ;
							$portfolio_link_target   = ( ! empty( $portfolio_link_target ) ) ? $portfolio_link_target : '_self';

						} else {

							$portfolio_external_link = get_permalink() ;
							$portfolio_link_target   = '_self';
						}

						$this->add_render_attribute( $custom_link_key, [
							'href'   => $portfolio_external_link,
							'target' => $portfolio_link_target
						] );

						if ( ! empty( $cat ) && ! is_wp_error( $cat ) ) {
							foreach ( $cat as $key => $c ) {
								$cat_slug_cls[]	= 'portfolio-filter-' . $c->term_id;
							}
						}

						$litho_subtitle = ( $litho_subtitle ) ? str_replace( '||', '<br />', $litho_subtitle ) : '';
						
						if ( ! empty( $alternate_image_id ) ) {

							$srcset_data         = litho_get_image_srcset_sizes( $alternate_image_id, 'full' );
							$alternate_image_url = wp_get_attachment_url( $alternate_image_id );
							$alternate_image_alt = Control_Media::get_image_alt( $alternate_image_id );
							$alternate_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s class="portfolio-switch-image" />', esc_url( $alternate_image_url ), esc_attr( $alternate_image_alt ), $srcset_data );
						}
						
						$cat_slug_class_list = implode( ' ', $cat_slug_cls );
						if ( 'portfolio-justified-gallery' === $portfolio_style ) {
							$this->add_render_attribute(
								$inner_wrap_key,
								[
									'class' => [
										'jg-entry',
										'grid-item',
										$cat_slug_class_list,
										$portfolio_classes_infinite_scroll,
									]
								]
							);

						} else {
							$this->add_render_attribute(
								$inner_wrap_key,
								[
									'class' => [
										'portfolio-item',
										'grid-item',
										$cat_slug_class_list,
										$portfolio_classes_infinite_scroll,
									]
								]
							);
						}
						
						// Entrance Animation
						if ( ! empty( $litho_porfolio_grid_animation ) ) {
							$this->add_render_attribute(
								$inner_wrap_key,
								[
									'class'                => [
										'litho-animated',
										'elementor-invisible',
									],
									'data-animation'       => [
										$litho_porfolio_grid_animation,
										$litho_porfolio_grid_animation_duration,
									],
									'data-animation-delay' => $grid_count * $litho_porfolio_grid_animation_delay
								]
							);
						}

						// Portfolio Metro
						if ( ! empty( $litho_double_grid_position ) && in_array( $grid_metro_count, $litho_double_grid_position ) ) {
							$this->add_render_attribute( $inner_wrap_key, [
								'class' => [ 'grid-item-double' ]
							] );
						}

						switch ( $portfolio_style ) {
							case 'portfolio-classic':
							default:
								if ( $portfolio_overlay_hover_animation ) {
									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ $portfolio_overlay_hover_animation ]
									] );
								}
								?>
								<li <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
									<figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
										<div class="portfolio-image">
											<?php
											$this->litho_get_portfolio_thumbnail();
											if ( 'yes' === $settings['litho_portfolio_open_lightbox'] || 'yes' === $settings['litho_portfolio_show_custom_link'] ) {
												?>
												<div class="portfolio-hover d-flex">
													<div class="portfolio-icon"><?php
														if ( 'yes' === $settings['litho_portfolio_open_lightbox'] ) {
															$this->litho_get_open_lightbox_link( $index );
														}

														if ( 'yes' === $settings['litho_portfolio_show_custom_link'] && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) {
															?>
															<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>>
															<?php
																if ( $is_new || $custom_link_icon_migrated ) {
																	Icons_Manager::render_icon( $settings['litho_portfolio_custom_link_icon'], [ 'aria-hidden' => 'true' ] );
																} elseif ( isset( $settings['litho_portfolio_custom_link_icon']['value'] ) && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) {
																	?><i class="<?php echo esc_attr( $settings['litho_portfolio_custom_link_icon']['value'] ); ?>" aria-hidden="true"></i><?php
																}
																?>
															</a>
															<?php
														}
													?></div>
												</div>
											<?php
											}
											?>
										</div>
										<?php if ( 'yes' === $portfolio_show_post_title || ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) ) { ?>
											<figcaption>
												<div class="portfolio-caption"><?php 
													if ( 'yes' === $portfolio_show_post_title ) {
														?><span class="title">
															<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>><?php the_title(); ?></a>
														</span><?php
													}
													if ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) {
														printf( '<span class="subtitle">%s</span>', esc_html( $litho_subtitle ) );
													}
												?></div>
											</figcaption>
										<?php } ?>
									</figure>
								</li>
								<?php
								break;
							case 'portfolio-boxed':
								if ( $portfolio_overlay_hover_animation ) {
									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ $portfolio_overlay_hover_animation ]
									] );
								}
								?>
								<li <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>><?php
									if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) {
									?><a <?php $this->print_render_attribute_string( $custom_link_key ); ?>><?php
									}
									?><figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
										<div class="portfolio-image"><?php
											$this->litho_get_portfolio_thumbnail();
										?></div>
										<?php if ( 'yes' === $portfolio_show_post_title || ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) || ( 'yes' === $settings['litho_portfolio_show_custom_link'] && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) ) { ?>
											<figcaption>
												<div class="portfolio-caption">
													<div class="portfolio-caption-text"><?php
														if ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) {
															printf( '<span class="subtitle">%s</span>', esc_html( $litho_subtitle ) );
														}
														if ( 'yes' === $portfolio_show_post_title ) {
														?><span class="title"><?php
															the_title();
														?></span><?php
														}
													?></div>
													<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) { ?>
														<div class="portfolio-icon"><?php
															if ( $is_new || $custom_link_icon_migrated ) {
																Icons_Manager::render_icon( $settings['litho_portfolio_custom_link_icon'], [ 'aria-hidden' => 'true' ] );
															} elseif ( isset( $settings['litho_portfolio_custom_link_icon']['value'] ) && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) {
																?><i class="<?php echo esc_attr( $settings['litho_portfolio_custom_link_icon']['value'] ); ?>" aria-hidden="true"></i><?php
															}
														?></div>
													<?php } ?>
												</div>
											</figcaption>
										<?php } ?>
									</figure><?php
									if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) {
									?></a><?php
									}
								?>
								</li>
								<?php
								break;
							case 'portfolio-colorful':
								if ( ! empty( $portfolio_title_hover_animation ) || ! empty( $portfolio_subtitle_hover_animation ) || ! empty( $portfolio_icon_hover_animation ) ) {

									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ 'hover-box-slide-text' ]
									] );
								}
								if ( $portfolio_overlay_hover_animation ) {
									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ $portfolio_overlay_hover_animation ]
									] );
								}
								$litho_single_portfolio_item_hover_color = litho_post_meta( 'litho_single_portfolio_item_hover_color' );
								
								$litho_item_hover_color_style = '';
								if ( $litho_single_portfolio_item_hover_color ) {
									$litho_item_hover_color_style = ' style="background-color:' . $litho_single_portfolio_item_hover_color . '"';
								}
								?>
								<li <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>><?php
									if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) {
										?><a <?php $this->print_render_attribute_string( $custom_link_key ); ?>><?php
									}
									?><figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
											<div class="portfolio-image"><?php
												$this->litho_get_portfolio_thumbnail();
											?></div>
											<figcaption>
												<div class="portfolio-hover d-flex flex-row"<?php echo sprintf( '%s', $litho_item_hover_color_style ); // phpcs:ignore ?>>
													<div class="portfolio-caption">
														<div class="portfolio-caption-text"><?php
															if ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) {
																?><div class="subtitle<?php echo esc_attr( $portfolio_subtitle_hover_animation ); ?>">
																	<span><?php echo esc_html( $litho_subtitle ); ?></span>
																</div><?php
															}
															if ( 'yes' === $portfolio_show_post_title ) {
																?><div class="title<?php echo esc_attr( $portfolio_title_hover_animation ); ?>">
																	<span><?php the_title(); ?></span>
																</div><?php
															}
														?></div>
														<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) { ?>
															<div class="portfolio-icon<?php echo esc_attr( $portfolio_icon_hover_animation ); ?>"><?php
																if ( $is_new || $custom_link_icon_migrated ) {
																	Icons_Manager::render_icon( $settings['litho_portfolio_custom_link_icon'], [ 'aria-hidden' => 'true' ] );
																} elseif ( isset( $settings['litho_portfolio_custom_link_icon']['value'] ) && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) {
																	?><i class="<?php echo esc_attr( $settings['litho_portfolio_custom_link_icon']['value'] ); ?>" aria-hidden="true"></i><?php
																}
															?></div>
														<?php } ?>
													</div>
												</div>
											</figcaption>
										</figure><?php 
									if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) {
									?></a><?php
									}
								?>
								</li>
								<?php
								break;
							case 'portfolio-bordered':
								?>
								<li <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>><?php
									if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) {
									?><a <?php $this->print_render_attribute_string( $custom_link_key ); ?>><?php
									}
									?><figure>
										<div class="portfolio-image"><?php
											$this->litho_get_portfolio_thumbnail();
										?></div>
										<figcaption>
											<div class="portfolio-hover d-flex">
												<div class="portfolio-caption scale"><?php
													if ( 'yes' === $portfolio_show_post_title ) {
														?><div class="title">
															<span><?php the_title(); ?></span>
														</div><?php
													}
													if ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) {
														?><div class="subtitle">
															<span><?php echo esc_html( $litho_subtitle ); ?></span>
														</div><?php
													}
												?></div>
											</div>
										</figcaption>
									</figure><?php
									if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) {
									?></a><?php
									}
								?>
								</li>
								<?php
								break;
							case 'portfolio-overlay':
								if ( ! empty( $portfolio_icon_hover_animation ) ) {
									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ 'hover-box-slide-text' ]
									] );
								}
								if ( $portfolio_overlay_hover_animation ) {
									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ $portfolio_overlay_hover_animation ]
									] );
								}
								?>
								<li <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
									<?php if ( 'yes' == $settings['litho_portfolio_show_custom_link'] ) { ?>
										<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>>
									<?php } ?>
										<figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
											<div class="portfolio-image">
												<?php $this->litho_get_portfolio_thumbnail(); ?>
											</div>
											<?php if ( 'yes' === $portfolio_show_post_title || ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) || ( 'yes' === $settings['litho_portfolio_show_custom_link'] && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) ) { ?>
												<figcaption>
													<div class="portfolio-hover d-flex">
														<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) { ?>
															<div class="portfolio-icon<?php echo esc_attr( $portfolio_icon_hover_animation ); ?>">
																<?php
																	if ( $is_new || $custom_link_icon_migrated ) {
																		Icons_Manager::render_icon( $settings['litho_portfolio_custom_link_icon'], [ 'aria-hidden' => 'true' ] );
																	} elseif ( isset( $settings['litho_portfolio_custom_link_icon']['value'] ) && ! empty( $settings['litho_portfolio_custom_link_icon']['value'] ) ) { ?>
																		<i class="<?php echo esc_attr( $settings['litho_portfolio_custom_link_icon']['value'] ); ?>" aria-hidden="true"></i>
																	<?php
																	}
																?>
															</div>
														<?php } ?>
														<?php if ( 'yes' === $portfolio_show_post_title || ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) ) { ?>
															<div class="portfolio-caption">
																<?php if ( 'yes' === $portfolio_show_post_title ) { ?>
																	<span class="title"><?php the_title(); ?></span>
																<?php } ?>
																<?php if ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) {
																	printf( '<span class="subtitle">%s</span>', esc_html( $litho_subtitle ) );
																} ?>
															</div>
														<?php } ?>
													</div>
												</figcaption>
											<?php } ?>
										</figure>
									<?php if ( 'yes' == $settings['litho_portfolio_show_custom_link'] ) { ?>
										</a>
									<?php } ?>
								</li>
								<?php
								break;
							case 'portfolio-switch':
								if ( $portfolio_overlay_hover_animation ) {
									$this->add_render_attribute( $figure_wrap_key, [
										'class' => [ $portfolio_overlay_hover_animation ]
									] );
								}
								?>
								<li <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
									<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
									<a <?php $this->print_render_attribute_string( $custom_link_key ); ?>>
									<?php } ?>
									<figure <?php $this->print_render_attribute_string( $figure_wrap_key ); ?>>
										<div class="portfolio-image">
											<?php
												$this->litho_get_portfolio_thumbnail();
												if ( ! empty( $alternate_image ) ) {
													echo sprintf( '%s', $alternate_image ); // phpcs:ignore
												}
											?>
										</div>
										<?php if ( 'yes' === $portfolio_show_post_title || ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) ) { ?>
											<figcaption>
												<div class="portfolio-caption">
													<?php if ( 'yes' === $portfolio_show_post_title ) { ?>
														<span class="title"><?php the_title(); ?></span>
													<?php } ?>
													<?php if ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) {
														printf( '<span class="subtitle">%s</span>', esc_html( $litho_subtitle ) );
													} ?>
												</div>
											</figcaption>
										<?php } ?>
									</figure>
									<?php if ( 'yes' === $settings['litho_portfolio_show_custom_link'] ) { ?>
									</a>
									<?php } ?>
								</li>
								<?php
								break;
							case 'portfolio-justified-gallery':
								$link_key     = 'link_' . $index;
								$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
								if ( has_post_thumbnail() ) {
									$image_url                          = get_the_post_thumbnail_url( get_the_ID(), 'full' );
									$litho_image_title_lightbox_popup   = get_theme_mod( 'litho_image_title_lightbox_popup', '0' );
									$litho_image_caption_lightbox_popup = get_theme_mod( 'litho_image_caption_lightbox_popup', '0' );

									if ( 1 == $litho_image_title_lightbox_popup ) {
										$litho_attachment_title = get_the_title( $thumbnail_id );
										if ( ! empty( $litho_attachment_title ) ) {
											$this->add_render_attribute( $link_key, [
												'title' => $litho_attachment_title,
											] );
										}
									}

									if ( 1 == $litho_image_caption_lightbox_popup ) {
										$litho_lightbox_caption = wp_get_attachment_caption( $thumbnail_id );
										if ( ! empty( $litho_lightbox_caption ) ) {
											$this->add_render_attribute( $link_key, [
												'data-lightbox-caption' => $litho_lightbox_caption,
											] );
										}
									}
								} else {
									$image_url = Utils::get_placeholder_image_src();
								}

								$this->add_render_attribute( $link_key, [
									'href'                         => $image_url,
									'data-group'                   => $this->get_id(),
									'class'                        => 'lightbox-group-gallery-item',
									'data-elementor-open-lightbox' => 'no',
								] );
								?>
								<div <?php $this->print_render_attribute_string( $inner_wrap_key ); ?>>
									<a <?php $this->print_render_attribute_string( $link_key ); ?>>
										<?php $this->litho_get_portfolio_thumbnail(); ?>
									</a>
									<?php if ( 'yes' === $portfolio_show_post_title || ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) ) { ?>
										<div class="portfolio-caption caption jg-caption">
											<?php if ( 'yes' === $portfolio_show_post_subtitle && $litho_subtitle ) {
												echo sprintf( '<span class="subtitle">%s</span>', esc_html( $litho_subtitle ) ); 
											} ?>
											<?php if ( 'yes' === $portfolio_show_post_title ) { ?>
												<span class="title"><?php the_title(); ?></span>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
								<?php
								break;
						}
						$index++;
						$grid_metro_count++;
						$grid_count++;
					endwhile;

					$this->litho_end_wrapper();

					// Pagination
					$litho_pagination_prev_icon_attr = '';
					$litho_pagination_next_icon_attr = '';

					if ( $porfolio_pagination_type ) {
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

					if ( ! empty( $porfolio_pagination_type ) && $the_query->max_num_pages > 1 ) {
						
						$this->add_render_attribute( 'pagination_main', [
							'class' => [ 'col-12', 'litho-pagination' ]
						] );
						switch ( $porfolio_pagination_type ) {
							case 'number-pagination':
								$the_query->query_vars['paged'] > 1 ? $current = $the_query->query_vars['paged'] : $current = 1;
								add_action( 'number_format_i18n', [ $this, 'litho_pagination_zero_prefix' ] );
								?><div <?php $this->print_render_attribute_string( 'pagination_main' ); ?>>
									<div class="pagination align-items-center"><?php
										// phpcs:ignore
										echo paginate_links( array(
											'base'      => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
											'format'    => '',
											'add_args'  => '',
											'current'   => $current,
											'total'     => $the_query->max_num_pages,
											'prev_text' => $litho_pagination_prev_icon_attr,
											'next_text' => $litho_pagination_next_icon_attr,
											'type'      => 'list',
											'end_size'  => 2,
											'mid_size'  => 2
										) );
									?></div>
								</div>
								<?php
								remove_action( 'number_format_i18n', [ $this, 'litho_pagination_zero_prefix' ] );
								break;
							case 'infinite-scroll-pagination':
								$this->add_render_attribute( 'pagination_main', [
									'class'           => [ 'litho-portfolio-infinite-scroll', 'd-none' ],
									'data-pagination' => $the_query->max_num_pages
								] );
								?>
								<div <?php $this->print_render_attribute_string( 'pagination_main' ); ?>><?php
									if ( get_next_posts_link( '', $the_query->max_num_pages ) ) {
										next_posts_link( '<span class="old-post">'. esc_html__( 'Older Portfolio', 'litho-addons' ). '</span><i class="fa-solid fa-long-arrow-alt-right"></i>', $the_query->max_num_pages );
									}
								?>
								</div>
								<?php
								break;
							case 'load-more-pagination':
								$this->add_render_attribute( 'pagination_main', [
									'class'           => [ 'litho-portfolio-infinite-scroll', 'litho-portfolio-load-more' ],
									'data-pagination' => $the_query->max_num_pages
								] );
								?>
								<div <?php $this->print_render_attribute_string( 'pagination_main' ); ?>><?php
										if ( get_next_posts_link( '', $the_query->max_num_pages ) ) {
											next_posts_link( '<span class="old-post">'. esc_html__( 'Older Portfolio', 'litho-addons' ). '</span><i class="fa-solid fa-long-arrow-alt-right"></i>', $the_query->max_num_pages );
										}
									?><div class="load-more-btn">
										<button class="btn view-more-button<?php echo esc_attr( $litho_hover_animation ); ?>"><?php
											echo sprintf( '%s', $litho_pagination_load_more_button_label ); // phpcs:ignore
										?></button>
									</div>
								</div>
								<?php
								break;
						}
					}
					wp_reset_postdata();
					?>
				</div>
				<?php
			}
		}

		public function litho_start_wrapper() {

			$style_exclude_arr    = array( 'portfolio-justified-gallery' );
			$portfolio_style      = $this->get_settings( 'litho_portfolio_style' );
			$litho_enable_masonry = $this->get_settings( 'litho_enable_masonry' );

			if ( in_array( $portfolio_style, $style_exclude_arr, true ) ) {
				?>
				<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<?php
			} else {
			?>
			<ul <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<?php
				if ( 'yes' === $litho_enable_masonry ) {
					?>
					<li class="grid-sizer"></li>
					<?php
				}
			}
		}

		public function litho_end_wrapper() {
			$style_exclude_arr = array( 'portfolio-justified-gallery' );
			$portfolio_style   = $this->get_settings( 'litho_portfolio_style' );

			if ( in_array( $portfolio_style, $style_exclude_arr, true ) ) {
				?>
				</div>
				<?php
			} else {
				?>
				</ul>
				<?php
			}
		}

		public function litho_get_portfolio_thumbnail() {

			$post_thumbanail = '';
			$litho_thumbnail = $this->get_settings( 'litho_thumbnail' );

			if ( has_post_thumbnail() ) {
				$post_thumbanail = get_the_post_thumbnail( get_the_ID(), $litho_thumbnail );
			} else {
				$post_thumbanail = sprintf( '<img src="%1$s" alt="%2$s" />', Utils::get_placeholder_image_src(), __( 'Portfolio Image ' . get_the_ID(), 'litho-addons' ) );
			}
			echo sprintf( '%s', $post_thumbanail ); // phpcs:ignore
		}

		public function litho_get_open_lightbox_link( $index ) {

			$image_url              = '';
			$open_lightbox_link     = '';
			$settings               = $this->get_settings_for_display();
			$is_new                 = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
			$lightbox_icon_migrated = isset( $settings['__fa4_migrated']['litho_portfolio_lightbox_icon'] );
			$link_key               = 'link_' . $index;
			$thumbnail_id           = get_post_thumbnail_id( get_the_ID() );

			/* Lightbox */
			if ( has_post_thumbnail() ) {
				$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				
				$litho_image_title_lightbox_popup 	= get_theme_mod( 'litho_image_title_lightbox_popup', '0' );
				$litho_image_caption_lightbox_popup = get_theme_mod( 'litho_image_caption_lightbox_popup', '0' );

				if ( 1 == $litho_image_title_lightbox_popup ) {
					$litho_attachment_title = get_the_title( $thumbnail_id );
					if ( ! empty( $litho_attachment_title ) ) {
						$this->add_render_attribute( $link_key, [
							'title' => $litho_attachment_title,
						] );
					}
				}

				if ( 1 == $litho_image_caption_lightbox_popup ) {
					$litho_lightbox_caption = wp_get_attachment_caption( $thumbnail_id );
					if ( ! empty( $litho_lightbox_caption ) ) {
						$this->add_render_attribute( $link_key, [
							'data-lightbox-caption' => $litho_lightbox_caption,
						] );
					}
				}
			} else {
				$image_url = Utils::get_placeholder_image_src();
			}

			$this->add_render_attribute(
				$link_key,
				[
					'href'                         => $image_url,
					'data-group'                   => $this->get_id(),
					'class'                        => 'lightbox-group-gallery-item',
					'data-elementor-open-lightbox' => 'no',
				]
			);

			if ( ! empty( $settings['litho_portfolio_lightbox_icon']['value'] ) ) {
				$open_lightbox_link .= '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
					if ( $is_new || $lightbox_icon_migrated ) {
						ob_start();
							Icons_Manager::render_icon( $settings['litho_portfolio_lightbox_icon'], [ 'aria-hidden' => 'true' ] );
						$open_lightbox_link .= ob_get_clean();
					} elseif ( isset( $settings['litho_portfolio_lightbox_icon']['value'] ) && ! empty( $settings['litho_portfolio_lightbox_icon']['value'] ) ) {
						$open_lightbox_link .= '<i class="' . esc_attr( $settings['litho_portfolio_lightbox_icon']['value'] ) . '" aria-hidden="true"></i>';
					}
				$open_lightbox_link .= '</a>';
			}

			echo sprintf( '%s', $open_lightbox_link ); // phpcs:ignore
		}

		public function litho_pagination_zero_prefix( $format ) {
			$number = intval( $format );
			if ( intval( $number / 10 ) > 0 ) {
				return $format;
			}
			return '0' . $format; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
