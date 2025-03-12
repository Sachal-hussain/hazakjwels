<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for portfolio filter.
 *
* @package Litho
 */

// If class `Portfolio_Filter` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Portfolio_Filter' ) ) {

	class Portfolio_Filter extends Widget_Base {

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
			return 'litho-portfolio-filter';
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
			return __( 'Litho Portfolio Filter', 'litho-addons' );
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
			return 'eicon-filter';
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
		 *  Register portfolio filter widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 *
		 * @access protected
		 */

		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_portfolio_filter_content',
				[
					'label'         => __( 'General', 'litho-addons' )
				]
			);
			$this->add_control(
				'litho_portfolio_filter_type_selection',
				[
					'label'         => __( 'Type of Selection', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'		=> 'portfolio-category',
					'options'       => [
						'portfolio-category'    => __( 'Category', 'litho-addons' ),
						'portfolio-tags'        => __( 'Tags', 'litho-addons' )
					]
				]
			);
			$this->add_control(
				'litho_categories_list',
				[
					'label'         => __( 'Categories', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_portfolio_category_array' ) ) ? litho_portfolio_category_array() : [],
					'condition'     => [
						'litho_portfolio_filter_type_selection'   => 'portfolio-category'
					]
				]
			);
			$this->add_control(
				'litho_tags_list',
				[
					'label'         => __( 'Tags', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_portfolio_tags_array' ) ) ? litho_portfolio_tags_array() : [],
					'condition'     => [
						'litho_portfolio_filter_type_selection'   => 'portfolio-tags'
					]
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_portfolio_filter_settings',
				[
					'label'         => __( 'Settings', 'litho-addons' )
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
					'default'       => 'yes'
				]
			);
			$this->add_control(
				'litho_default_category_selected',
				[
					'label'         => __( 'Select Default Categories Selected', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_portfolio_category_array' ) ) ? litho_portfolio_category_array() : [],
					'condition'     => [
						'litho_portfolio_filter_type_selection'  => 'portfolio-category'
					]
				]
			);
			$this->add_control(
				'litho_default_tags_selected',
				[
					'label'         => __( 'Select Default Tags Selected', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_portfolio_tags_array' ) ) ? litho_portfolio_tags_array() : [],
					'condition'     => [
						'litho_portfolio_filter_type_selection'  => 'portfolio-tags'
					]
				]
			);
			$this->add_control(
				'litho_show_all_label',
				[               
					'label'         => __( '`All` Filter Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'All', 'litho-addons' ),
					'condition'     => [
						'litho_show_all_text_filter'  => 'yes'
					]
				]
			);
			$this->add_control(
				'litho_portfolio_categories_orderby',
				[
					'label'         => __( 'Order by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'name',
					'options'       => [
						'name'          => __( 'Name', 'litho-addons' ),
						'slug'          => __( 'Slug', 'litho-addons' ),
						'id'            => __( 'Id', 'litho-addons' ),
						'count'         => __( 'Count', 'litho-addons' )
					]
				]
			);
			$this->add_control(
				'litho_portfolio_categories_order',
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
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_portfolio_filter_general_style',
				[
					'label'         => __( 'General', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_portfolio_filter_bg_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size'
					],
					'selector'      => '{{WRAPPER}} .grid-filter'
				]
			);
			$this->add_responsive_control(
				'litho_section_portfolio_filter_align',
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
						'{{WRAPPER}} .grid-filter' => 'justify-content: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_portfolio_filter_border',
					'selector'      => '{{WRAPPER}} .grid-filter.nav-tabs',
					'separator'     => 'before'
				]
			);
			$this->add_control(
				'litho_portfolio_filter_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 100 ] ],
					'selectors'     => [
						'{{WRAPPER}} .grid-filter' => 'border-radius: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_filter_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .grid-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_filter_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .grid-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_portfolio_filter_box_shadow',
					'selector'      => '{{WRAPPER}} .grid-filter'
				]
			);
			$this->end_controls_section();
			
			$this->start_controls_section(
				'litho_portfolio_filter_items_style',
				[
					'label'         => __( 'Filter Items', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'show_label'    => false
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_filter_items_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .grid-filter li a',
					'fields_options'	=> [ 'typography' => [ 'separator' => 'before' ] ]
				]
			);
			$this->start_controls_tabs( 'litho_portfolio_filter_items_tabs' );
				$this->start_controls_tab( 'litho_portfolio_filter_items_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_portfolio_filter_items_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .grid-filter > li > a' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'              => 'litho_portfolio_filter_items_bg_color',
							'types'             => [ 'classic', 'gradient' ],
							'exclude'           => [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size'
							],
							'selector'          => '{{WRAPPER}} .grid-filter > li'
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_portfolio_filter_items_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
					$this->add_control(
						'litho_portfolio_filter_items_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .grid-filter > li:hover > a, {{WRAPPER}} .grid-filter > li.active > a'  => 'color: {{VALUE}};'
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_portfolio_filter_items_hover_bg_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size'
							],
							'selector'		=> '{{WRAPPER}} .grid-filter > li:hover, {{WRAPPER}} .grid-filter > li.active'
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_portfolio_filter_items_border',
					'default'       => '1px',
					'selector'      => '{{WRAPPER}} .grid-filter > li',
					'separator'     => 'before'
				]
			);
			$this->add_control(
				'litho_portfolio_filter_items_border_radius',
				[
					'label'         => __( 'Border Radius', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px'   => [ 'min' => 0, 'max' => 50 ] ],
					'selectors'     => [
						'{{WRAPPER}} .grid-filter > li' => 'border-radius: {{SIZE}}{{UNIT}};'
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_filter_items_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .grid-filter li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_filter_items_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .grid-filter li'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'litho_portfolio_filter_items_shadow',
					'selector'      => '{{WRAPPER}} .grid-filter li'
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render portfolio filter widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render( $instance = [] ) {
			 
			global $litho_portfolio_filter_unique_id;
			$settings = $this->get_settings_for_display();
			$portfolio_filter_type_selection = ( isset( $settings['litho_portfolio_filter_type_selection'] ) && $settings['litho_portfolio_filter_type_selection'] ) ? $settings['litho_portfolio_filter_type_selection'] : 'portfolio-category';
			$categories_list            	= ( isset( $settings['litho_categories_list'] ) && $settings['litho_categories_list'] ) ?  $settings['litho_categories_list'] : array();
			$tags_list                 	 	= ( isset( $settings['litho_tags_list'] ) && $settings['litho_tags_list'] ) ?  $settings['litho_tags_list'] : array();
			$show_all_text_filter       	= ( isset( $settings['litho_show_all_text_filter'] ) && $settings['litho_show_all_text_filter'] ) ? $settings['litho_show_all_text_filter'] : '';
			$default_category_selected  	= ( isset( $settings['litho_default_category_selected'] )&& $settings['litho_default_category_selected'] ) ? $settings['litho_default_category_selected'] : '';
			$default_tags_selected      	= ( isset( $settings['litho_default_tags_selected'] ) && $settings['litho_default_tags_selected'] ) ? $settings['litho_default_tags_selected'] : '';
			$show_all_label             	= ( isset( $settings['litho_show_all_label'] ) && $settings['litho_show_all_label'] ) ? $settings['litho_show_all_label'] : '';
			$portfolio_categories_orderby 	= ( isset( $settings['litho_portfolio_categories_orderby'] ) && $settings['litho_portfolio_categories_orderby'] ) ? $settings['litho_portfolio_categories_orderby'] : '';
			$portfolio_categories_order 	= ( isset( $settings['litho_portfolio_categories_order'] ) && $settings['litho_portfolio_categories_order'] ) ? $settings['litho_portfolio_categories_order'] : '';

			// Check if portfolio id and class
			$litho_portfolio_filter_unique_id  = ! empty( $litho_portfolio_filter_unique_id ) ? $litho_portfolio_filter_unique_id : 1;
			$litho_portfolio_id 				=  'litho-portfolio';
			$litho_portfolio_id 				.= '-' . $litho_portfolio_filter_unique_id;
			$litho_portfolio_filter_unique_id++;

			$query_args = array();
			
			if ( 'portfolio-tags' === $portfolio_filter_type_selection  ) {
				$categories_to_display_ids = ( ! empty( $tags_list ) ) ? $tags_list :  array();
			} else {
				$categories_to_display_ids = ( ! empty( $categories_list ) ) ? $categories_list :  array();
			}

			// If no categories are chosen or "All categories", we need to load all available categories
			if ( !  is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
				$terms = get_terms( $portfolio_filter_type_selection );
				if ( ! is_array( $categories_to_display_ids ) ) {
					$categories_to_display_ids = array();
				}
				foreach ( $terms as $term ) {
					$categories_to_display_ids[] = $term->slug;
				}
			} else {
				$categories_to_display_ids = array_values( $categories_to_display_ids );
			}

			if ( ! empty( $categories_to_display_ids ) ) {
				$query_args[ 'slug' ] = $categories_to_display_ids;
			}
			if ( ! empty( $portfolio_categories_orderby ) ) {
				$query_args[ 'orderby' ] = $portfolio_categories_orderby;
			}
			if ( ! empty( $portfolio_categories_order ) ) {
				$query_args[ 'order' ] = $portfolio_categories_order;
			}
			
			$query_args[ 'taxonomy' ] = $portfolio_filter_type_selection;

			$tax_terms  = get_terms( $query_args );

			if ( is_array( $tax_terms ) && count( $tax_terms ) == 0 ) {
				return;
			}
			$this->add_render_attribute( 'filter_wrapper', [
			   'id'     => $litho_portfolio_id,
			   'class'  => [ 'grid-filter', 'nav', 'nav-tabs' ],
			] );
			?><ul <?php $this->print_render_attribute_string( 'filter_wrapper' ); ?>><?php
				
				$active_class = '';
				if ( 'portfolio-tags' === $portfolio_filter_type_selection  ) {
					if ( 'yes' === $show_all_text_filter ) {
						$active_class = empty( $default_tags_selected ) ? 'active' : '';
					}
				} else {
					if ( 'yes' === $show_all_text_filter ) {
						$active_class = empty( $default_category_selected ) ? 'active' : '';
					}
				}

				$this->add_render_attribute( 'filter_li', [ 'class' => [ 'nav', $active_class ] ] );
				$this->add_render_attribute( 'filter_a', [
				   'href'           => 'javascript:void(0);',
				   'data-filter'    => '*',
				   'data-id'        => $litho_portfolio_id,
				] );
				
				if ( 'yes' === $show_all_text_filter ) {
					?><li <?php $this->print_render_attribute_string( 'filter_li' ); ?>>
						<a <?php $this->print_render_attribute_string( 'filter_a' ); ?>><?php
							echo esc_html( $show_all_label );
						?></a>
					</li><?php
				}
				
				foreach ( $tax_terms as $index => $tax_term ) {
					$active_class 	= '';
					$filter_li_key	= 'filter_li' . $index;
					$filter_a_key	= 'filter_a' . $index;

					if ( 'portfolio-tags' === $portfolio_filter_type_selection  ) {
						$active_class	= ( $default_tags_selected == $tax_term->slug ) ? 'active' : '';
					} else {
						$active_class	= ( $default_category_selected == $tax_term->slug ) ? 'active' : '';
					}
					$this->add_render_attribute( $filter_li_key, [ 'class' => [ 'nav', $active_class ] ] );
					$this->add_render_attribute( $filter_a_key, [
					   'href'           => 'javascript:void(0);',
					   'data-filter'    => '.portfolio-filter-' . $tax_term->term_id,
					   'data-id'        => $litho_portfolio_id,
					] );

					?><li <?php $this->print_render_attribute_string( $filter_li_key ); ?>>
						<a <?php $this->print_render_attribute_string( $filter_a_key ); ?>><?php
							echo esc_html( $tax_term->name );
						?></a>
					</li><?php
				}
			?></ul>
		<?php
		}
	}
}
