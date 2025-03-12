<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

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

// If class `Interactive_Portfolio` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Interactive_Portfolio' ) ) {

	class Interactive_Portfolio extends Widget_Base {

		/**
		 * Retrieve the widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-interactive-portfolio';
		}

		/**
		 * Retrieve the widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Interactive Portfolio', 'litho-addons' );
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
			return [ 'portfolio', 'masonry', 'grid', 'gallery', 'list', 'project', 'interactive' ];
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
				'litho_portfolio_type_selection',
				[
					'label'     => __( 'Type of Selection', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'	=> 'portfolio-category',
					'options'   => [
						'portfolio-category' => __( 'Category', 'litho-addons' ),
						'portfolio-tags'     => __( 'Tags', 'litho-addons' ),
					],
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_portfolio_categories_list',
				[
					'label'			=> __( 'Categories', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_portfolio_category_array' ) ) ? litho_portfolio_category_array() : [],
					'condition'     => [
						'litho_portfolio_type_selection' => 'portfolio-category',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_tags_list',
				[
					'label'         => __( 'Tags', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options'     => ( function_exists( 'litho_portfolio_tags_array' ) ) ? litho_portfolio_tags_array() : [],
					'condition'     => [
						'litho_portfolio_type_selection' => 'portfolio-tags',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_settings',
				[
					'label'			=> __( 'Settings', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_portfolio_post_per_page',
				[
					'label'     => __( 'Number of posts to show', 'litho-addons' ),
					'type'      => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true
					],
					'default' => 5,
				]
			);
			$this->add_control(
				'litho_portfolio_thumbnail',
				[
					'label'          => __( 'Size', 'litho-addons' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => 'full',
					'options' => ( function_exists( 'litho_get_thumbnail_image_sizes' ) ) ? litho_get_thumbnail_image_sizes() : [],
					'style_transfer' => true,
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_title',
				[
					'label'         => __( 'Enable Title', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);
			$this->add_control(
				'litho_portfolio_show_post_subtitle',
				[
					'label'         => __( 'Enable Number', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
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
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_general_style',
				[
					'label'             => __( 'General', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'show_label'        => false,
				]
			);

			$this->add_control(
				'litho_portfolio_separator_color',
				[
					'label'     => __( 'Separator Color', 'litho-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .interactive-separator' => 'background-color: {{VALUE}};',
					]
				]
			); 
			$this->add_responsive_control(
				'litho_portfolio_content_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .interactive-portfolio-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_title_style',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_portfolio_show_post_title' => 'yes',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_title_tag',
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
					'default' 		=> 'span'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_portfolio_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .title',
				]
			);
			$this->start_controls_tabs( 'litho_portfolio_title_tabs' );
				$this->start_controls_tab( 'litho_portfolio_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_portfolio_title_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .title' => 'text-stroke: 2px {{VALUE}}; -webkit-text-stroke: 2px {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_portfolio_title_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_portfolio_title_hover_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} li:hover .title:after, {{WRAPPER}} a:hover .title:after, {{WRAPPER}} .title:after' => '-webkit-text-fill-color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_portfolio_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_portfolio_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_subtitle_style',
				[
					'label'             => __( 'Subtitle', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'litho_portfolio_show_post_subtitle' => 'yes',
					],
				]
			);
			$this->add_control(
				'litho_portfolio_subtitle_tag',
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
					'default' 		=> 'h6'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'litho_portfolio_subtitle_typography',
					'selector' => '{{WRAPPER}} .subtitle',
				]
			);
			$this->start_controls_tabs( 'litho_portfolio_subtitle_tabs' );
				$this->start_controls_tab( 'litho_portfolio_subtitle_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_portfolio_subtitle_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'litho_portfolio_subtitle_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				);
					$this->add_control(
						'litho_portfolio_subtitle_hover_color',
						[
							'label'         => __( 'Color', 'litho-addons' ),
							'type'          => Controls_Manager::COLOR,
							'selectors'     => [
								'{{WRAPPER}} li:hover .subtitle, {{WRAPPER}} a:hover .subtitle' => 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_portfolio_section_arrow_icon_style',
				[
					'label'             => __( 'Arrow icon (Mobile)', 'litho-addons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'litho_portfolio_arrow_icon_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .interactive-icon' => 'color: {{VALUE}};',
					]
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render interactive portfolio widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                           = $this->get_settings_for_display();
			$litho_portfolio_type_selection     = ( isset( $settings['litho_portfolio_type_selection'] ) && $settings['litho_portfolio_type_selection'] ) ? $settings['litho_portfolio_type_selection'] : 'portfolio-category';
			$litho_portfolio_categories_list    = ( isset( $settings['litho_portfolio_categories_list'] ) && $settings['litho_portfolio_categories_list'] ) ? $settings['litho_portfolio_categories_list'] : array();
			$litho_portfolio_tags_list          = ( isset( $settings['litho_portfolio_tags_list'] ) && $settings['litho_portfolio_tags_list'] ) ? $settings['litho_portfolio_tags_list'] : array();
			$litho_portfolio_post_per_page      = ( isset( $settings['litho_portfolio_post_per_page'] ) && $settings['litho_portfolio_post_per_page'] ) ? $settings['litho_portfolio_post_per_page'] : '';
			$litho_portfolio_thumbnail          = ( isset( $settings['litho_portfolio_thumbnail'] ) && $settings['litho_portfolio_thumbnail'] ) ? $settings['litho_portfolio_thumbnail'] : '';
			$litho_portfolio_show_post_title    = ( isset( $settings['litho_portfolio_show_post_title'] ) && $settings['litho_portfolio_show_post_title'] ) ? $settings['litho_portfolio_show_post_title'] : '';
			$litho_portfolio_show_post_subtitle = ( isset( $settings['litho_portfolio_show_post_subtitle'] ) && $settings['litho_portfolio_show_post_subtitle'] ) ? $settings['litho_portfolio_show_post_subtitle'] : '';
			$litho_portfolio_orderby            = ( isset( $settings['litho_portfolio_orderby'] ) && $settings['litho_portfolio_orderby'] ) ? $settings['litho_portfolio_orderby'] : '';
			$litho_portfolio_order              = ( isset( $settings['litho_portfolio_order'] ) && $settings['litho_portfolio_order'] ) ? $settings['litho_portfolio_order'] : '';
			$litho_portfolio_title_tag          = ( isset( $settings['litho_portfolio_title_tag'] ) && $settings['litho_portfolio_title_tag'] ) ? $settings['litho_portfolio_title_tag'] : '';
			$litho_portfolio_subtitle_tag       = ( isset( $settings['litho_portfolio_subtitle_tag'] ) && $settings['litho_portfolio_subtitle_tag'] ) ? $settings['litho_portfolio_subtitle_tag'] : '';

			if ( 'portfolio-tags' === $litho_portfolio_type_selection ) {
				$categories_to_display_ids = ( ! empty( $litho_portfolio_tags_list ) ) ? $litho_portfolio_tags_list : array();
			} else {
				$categories_to_display_ids = ( ! empty( $litho_portfolio_categories_list ) ) ? $litho_portfolio_categories_list : array();
			}

			// If no categories are chosen or "All categories", we need to load all available categories.
			if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {

				$terms = get_terms( $litho_portfolio_type_selection );

				if ( ! is_array( $categories_to_display_ids ) ) {
					$categories_to_display_ids = array();
				}
				foreach ( $terms as $term ) {
					$categories_to_display_ids[] = $term->slug;
				}
			} else {
				$categories_to_display_ids = array_values( $categories_to_display_ids );
			}

			$query_args = array(
				'post_type'      => 'portfolio',
				'post_status'    => 'publish',
				'posts_per_page' => intval( $litho_portfolio_post_per_page ),
			);
			if ( ! empty( $categories_to_display_ids ) ) {
				$query_args['tax_query'] = [
					[
						'taxonomy' => $litho_portfolio_type_selection,
						'field'    => 'slug',
						'terms'    => $categories_to_display_ids,
					],
				];
			}

			if ( ! empty( $litho_portfolio_orderby ) ) {
				$query_args['orderby'] = $litho_portfolio_orderby;
			}

			if ( ! empty( $litho_portfolio_order ) ) {
				$query_args['order'] = $litho_portfolio_order;
			}

			$portfolio_query = new \WP_Query( $query_args );

			if ( $portfolio_query->have_posts() ) {
				?><div class="interactive-portfolio-wrapper full-screen justify-content-center flex-column d-flex">
					<ul><?php
						$counter = 1;
						while ( $portfolio_query->have_posts() ) :
							$portfolio_query->the_post();
							$custom_link_key           = 'link_'.$counter;
							$litho_portfolio_thumbnail = $this->get_settings( 'litho_portfolio_thumbnail' );
							$has_post_format           = litho_post_meta( 'litho_portfolio_post_type' );

							if ( 'link' == $has_post_format || has_post_format( 'link', get_the_ID() ) ) {
								$portfolio_external_link = litho_post_meta( 'litho_portfolio_external_link' );
								$portfolio_link_target   = litho_post_meta( 'litho_portfolio_link_target' );
								$portfolio_external_link = ( ! empty( $portfolio_external_link ) ) ? $portfolio_external_link : '#';
								$portfolio_link_target   = ( ! empty( $portfolio_link_target ) ) ? $portfolio_link_target : '_self';
							} else {
								$portfolio_external_link = get_permalink();
								$portfolio_link_target   = '_self';
							}

							$this->add_render_attribute( $custom_link_key, [
								'href'   => $portfolio_external_link,
								'target' => $portfolio_link_target
							] );

							$active_class = ( 1 === $counter ) ? ' active' : '';
							?>
							<li class="hover-list-item<?php echo esc_attr( $active_class ); ?>">
								<a <?php $this->print_render_attribute_string( $custom_link_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<?php
									if ( 'yes' === $litho_portfolio_show_post_subtitle ) {
										?><<?php echo $this->get_settings( 'litho_portfolio_subtitle_tag' ); ?> class="subtitle"><?php
											$number_text = ( $counter < 10 ) ? '0' . $counter : $counter;
											echo esc_html( $number_text );
										?></<?php echo $this->get_settings( 'litho_portfolio_subtitle_tag' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									?><span class="interactive-separator"></span><?php
									}
									if ( 'yes' === $litho_portfolio_show_post_title ) {
										?><<?php echo $this->get_settings( 'litho_portfolio_title_tag' ); ?> class="title" data-link-text="<?php echo get_the_title(); ?>"><?php
											the_title();
										?></<?php echo $this->get_settings( 'litho_portfolio_title_tag' ); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									}
									if ( has_post_thumbnail() ) {
										$litho_portfolio_post_thumbnail = get_the_post_thumbnail_url( get_the_ID(), $litho_portfolio_thumbnail );
										?><div class="fullscreen-hover-image cover-background" style="background-image: url( <?php echo esc_url( $litho_portfolio_post_thumbnail ); ?> )"></div><?php
									}
									?><i class="line-icon-Arrow-OutRight interactive-icon"></i>
								</a>
							</li><?php
							$counter++;
						endwhile;
						wp_reset_postdata();
					?></ul><?php
				?></div>
			<?php
			}
		}
	}
}
