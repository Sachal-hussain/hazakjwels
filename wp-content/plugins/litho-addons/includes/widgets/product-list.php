<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for product list.
 *
* @package Litho
 */

if ( ! is_woocommerce_activated() ) {
	return;
}

// If class `Product_List` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Product_List' ) ) {
	
	class Product_List extends Widget_Base {

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
			return 'litho-product-list';
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
			return __( 'Litho Product List', 'litho-addons' );
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
			return 'eicon-post-list';
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

			return [ 'woocommerce', 'wc', 'shop', 'store', 'product', 'archive', 'e-commerce' ];
		}

		/**
		 * Register product list widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */

		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_section_product_content',
				[
					'label'     => __( 'General', 'litho-addons' ),
				]
			);
			
			$this->add_control(
				'litho_product_column_type',
				[
					'label'			=> __( 'Column', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT,
					'default'		=> '3',
					'options'		=> [
						'2'		=> __( '2', 'litho-addons' ),
						'3'		=> __( '3', 'litho-addons' ),
						'4'		=> __( '4', 'litho-addons' ),
						'5'		=> __( '5', 'litho-addons' ),
						'6'		=> __( '6', 'litho-addons' ),
					]
				]
			);
			$this->add_control(
				'litho_post_type_selection',
				[
					'label'		=> __( 'Type of Selection', 'litho-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'product_cat',
					'options'	=> [
						'product_cat'	=> __( 'Categories', 'litho-addons' ),
						'product_tag'	=> __( 'Tags', 'litho-addons' ),
						'sale'			=> __( 'Sale', 'litho-addons' ),
						'featured'		=> __( 'Featured', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_product_categories_list',
				[
					'label'			=> __( 'Categories', 'litho-addons' ),
					'type'			=> Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_product_category_array' ) ) ? litho_product_category_array() : [],
					'condition'     => [
						'litho_post_type_selection' => 'product_cat'
					]
				]
			);
			$this->add_control(
				'litho_product_tags_list',
				[
					'label'         => __( 'Tags', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT2,
					'multiple'      => true,
					'label_block'   => true,
					'options' => ( function_exists( 'litho_product_tags_array' ) ) ? litho_product_tags_array() : [],
					'condition'     => [
						'litho_post_type_selection' => 'product_tag'
					]
				]
			);
			$this->add_control(
				'litho_product_per_page',
				[
					'label'         => __( 'Products Per Page', 'litho-addons' ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => 12,
				]
			);

			$this->add_control(
				'litho_orderby',
				[
					'label'         => __( 'Order by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'date',
					'options'       => [
						'date' 			=> __( 'Date', 'litho-addons' ),
						'title' 		=> __( 'Title', 'litho-addons' ),
						'price' 		=> __( 'Price', 'litho-addons' ),
						'popularity' 	=> __( 'Popularity', 'litho-addons' ),
						'rating'		=> __( 'Rating', 'litho-addons' ),
						'rand' 			=> __( 'Random', 'litho-addons' ),
						'menu_order' 	=> __( 'Menu Order', 'litho-addons' ),
					],
				]
			);
			$this->add_control(
				'litho_order',
				[
					'label'         => __( 'Sort by', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'DESC',
					'options'       => [
						'DESC'          => __( 'Descending', 'litho-addons' ),
						'ASC'           => __( 'Ascending', 'litho-addons' ),
					],
				]
			);

			$this->add_control(
				'litho_pagination',
				[
					'label'         => __( 'Pagination', 'litho-addons' ),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => __( 'Yes', 'litho-addons' ),
					'label_off'     => __( 'No', 'litho-addons' ),
					'return_value'  => 'yes',
					'default'       => ''
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_product_title_style',
				[
					'label'			=> __( 'Title', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'show_label'	=> false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_product_title_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-product__title a, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-category__title a',
				]
			);
			$this->start_controls_tabs( 'litho_product_title_tabs' );
				$this->start_controls_tab( 'litho_product_title_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_product_title_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-product__title a' => 'color: {{VALUE}};',
								'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-category__title a' => 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_product_title_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				 );
					$this->add_control(
						'litho_product_title_hover_color',
						[
							'label'     => __( 'Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-product__title a:hover'	=> 'color: {{VALUE}};',
								'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-category__title a:hover'	=> 'color: {{VALUE}};',
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'litho_product_title_spacing',
				[
					'label'			=> __( 'Spacing', 'litho-addons' ),
					'type'			=> Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', 'em', 'custom' ],
					'range'			=> [
						'em' => [
							'min' => 0,
							'max' => 5,
							'step' => 0.1,
						],
					],
					'selectors'		=> [
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-product__title a'	=> 'margin-bottom: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .woocommerce-loop-category__title a'	=> 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'separator'	=> 'before'
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_product_rating_star_style',
				[
					'label'			=> __( 'Rating', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'show_label'	=> false,
				]
			);
			$this->add_control(
				'litho_product_star_color',
				[
					'label' => __( 'Star Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .star-rating, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .star-rating span::before' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'litho_product_empty_star_color',
				[
					'label' => __( 'Empty Star Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .star-rating::before' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_product_price_style',
				[
					'label'			=> __( 'Price', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'show_label'	=> false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_product_price_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .woocommerce ul.shop-product-list li.product .price, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .price ins, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .price ins .amount',
				]
			);
			$this->add_control(
				'litho_product_price_color',
				[
					'label' => __( 'Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .price' 				=> 'color: {{VALUE}}',
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .price ins' 			=> 'color: {{VALUE}}',
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .price ins .amount'	=> 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_product_regular_price_style',
				[
					'label'			=> __( 'Regular Price', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'show_label'	=> false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_product_regular_price_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .woocommerce ul.shop-product-list li.product .price del, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .price del .amount',
				]
			);
			$this->add_control(
				'litho_product_regular_price_color',
				[
					'label' => __( 'Color', 'litho-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .price del' => 'color: {{VALUE}}',
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .price del .amount' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'litho_section_product_button_style',
				[
					'label'			=> __( 'Button', 'litho-addons' ),
					'tab'			=> Controls_Manager::TAB_STYLE,
					'show_label'	=> false,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_product_button_typography',
					'global' 	=> [
						'default'	=> Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .woocommerce ul.shop-product-list li.product .added_to_cart',
				]
			);
			$this->start_controls_tabs( 'litho_product_button_tabs' );
				$this->start_controls_tab( 'litho_product_button_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
					$this->add_control(
						'litho_product_button_color',
						[
							'label'     => __( 'Text Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .button, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .added_to_cart' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_product_button_background_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .woocommerce ul.shop-product-list li.product .button, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .added_to_cart',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'litho_product_button_hover_tab',
					[
						'label' => __( 'Hover', 'litho-addons' ),
					]
				 );
					$this->add_control(
						'litho_product_button_hover_color',
						[
							'label'     => __( 'Text Hover Color', 'litho-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .button:hover, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .added_to_cart:hover'	=> 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'			=> 'litho_product_button_background_hover_color',
							'types'			=> [ 'classic', 'gradient' ],
							'exclude'		=> [
								'image',
								'position',
								'attachment',
								'attachment_alert',
								'repeat',
								'size',
							],
							'selector'		=> '{{WRAPPER}} .woocommerce ul.shop-product-list li.product .button:hover, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .added_to_cart:hover',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(), [
					'name'		=> 'litho_product_button_border',
					'selector'	=> '{{WRAPPER}} .woocommerce ul.shop-product-list li.product .button, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .added_to_cart',
					'separator'	=> 'before',
				]
			);
			$this->add_control(
				'litho_product_button_border_radius',
				[
					'label'			=> __( 'Border Radius', 'litho-addons' ),
					'type'			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .woocommerce ul.shop-product-list li.product .button, {{WRAPPER}} .woocommerce ul.shop-product-list li.product .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
		}
		protected function render() {

			global $woocommerce_loop;

			$settings                      = $this->get_settings_for_display();
			$litho_product_per_page        = $this->get_settings( 'litho_product_per_page' );
			$litho_post_type_selection     = $this->get_settings( 'litho_post_type_selection' );
			$litho_product_categories_list = $this->get_settings( 'litho_product_categories_list' );
			$litho_product_tags_list       = $this->get_settings( 'litho_product_tags_list' );
			$litho_orderby                 = $this->get_settings( 'litho_orderby' );
			$litho_order                   = $this->get_settings( 'litho_order' );
			$litho_pagination              = $this->get_settings( 'litho_pagination' );

			$this->add_render_attribute(
				'wrapper',
				[
					'class'  => [
						'woocommerce',
					],
				]
			);

			$litho_product_per_page        = ( ! empty( $litho_product_per_page ) ) ? $litho_product_per_page : -1 ;
			$litho_product_categories_list = ( ! empty( $litho_product_categories_list ) ) ?  $litho_product_categories_list : array();
			$litho_product_tags_list       = ( ! empty( $litho_product_tags_list ) ) ?  $litho_product_tags_list : array();

			if ( 'product_tag' === $litho_post_type_selection ) {
				$categories_to_display_ids = ( ! empty( $litho_product_tags_list ) ) ? $litho_product_tags_list : array();
			} else {
				$categories_to_display_ids = ( ! empty( $litho_product_categories_list ) ) ? $litho_product_categories_list : array();
			}

			if ( 'product_cat' === $litho_post_type_selection || 'product_tag' === $litho_post_type_selection ) {
				// If no categories are chosen or "All categories", we need to load all available categories.
				if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {

					$terms = get_terms( $litho_post_type_selection );

					if ( ! is_array( $categories_to_display_ids ) ) {
						$categories_to_display_ids = array();
					}
					foreach ( $terms as $term ) {
						$categories_to_display_ids[] = $term->slug;
					}
				} else {
					$categories_to_display_ids = array_values( $categories_to_display_ids );
				}
			}

			$woocommerce_loop['columns'] = $this->get_settings( 'litho_product_column_type' );

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' ); 
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' ); 
			} else {
				$paged = 1;
			}

			$query_args = array(
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
				'post_type'           => 'product',
				'posts_per_page'      => $litho_product_per_page,
				'paged'               => $paged,
			);

			$query_args['meta_query'] = WC()->query->get_meta_query();
			$query_args['tax_query']  = [];

			if ( ! empty( $litho_orderby ) && ! empty( $litho_order ) ) {

				$ordering_args         = WC()->query->get_catalog_ordering_args( $litho_orderby, $litho_order );
				$query_args['orderby'] = $litho_orderby;
				$query_args['order']   = $litho_order;
			}

			if ( $ordering_args['meta_key'] ) {
				$query_args['meta_key'] = $ordering_args['meta_key'];
			}
			if ( 'product_cat' === $litho_post_type_selection || 'product_tag' === $litho_post_type_selection ) {

				if ( ! empty( $categories_to_display_ids ) ) {
					$query_args['tax_query'][] = [
						[
							'taxonomy'	=> $litho_post_type_selection,
							'field'		=> 'slug',
							'terms'		=> $categories_to_display_ids,
							'operator'	=> 'IN'
						]
					];
				}
			} elseif ( 'featured' === $litho_post_type_selection ) {

				$product_visibility_term_ids = wc_get_product_visibility_term_ids();

				$query_args['tax_query'][] = [
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => [ $product_visibility_term_ids['featured'] ],
				];
			} elseif ( 'sale' === $litho_post_type_selection ) {

				$post__in = wc_get_product_ids_on_sale();

				$query_args['post__in'] = $post__in;
				remove_action( 'pre_get_posts', [ WC()->query, 'product_query' ] );
			}

			$query_args['tax_query'][] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'exclude-from-catalog', // Possibly 'exclude-from-search' too.
				'operator' => 'NOT IN',
			];

			$the_query = new \WP_Query( $query_args );

			if ( $the_query->have_posts() ) {
				?>
				<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
					<?php
					woocommerce_product_loop_start();

					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						if ( Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode() ) {
							?>
							<li <?php wc_product_class( '', get_the_ID() ); ?>>

									<div class="litho-product-image">
									<?php 
										woocommerce_template_loop_product_link_open();

										wc_get_template( 'loop/sale-flash.php' );
										$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
										the_post_thumbnail( $image_size );


										woocommerce_template_loop_product_link_close();

										wc_get_template( 'loop/add-to-cart.php' );
									?>
									</div>
									<?php
										echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										wc_get_template( 'loop/rating.php' );
										wc_get_template( 'loop/price.php' );
									?>
							</li>
							<?php
						} else {

							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();

					woocommerce_reset_loop();
					?>
				</div>
			<?php
			}

			$current = ( $the_query->query_vars['paged'] > 1 ) ? $the_query->query_vars['paged'] : 1;
			if ( 'yes' === $litho_pagination ) {
				if ( $the_query->max_num_pages > 1 ) {
					?>
					<div class="col-12 litho-pagination">
						<div class="pagination justify-content-center">
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo paginate_links(
								array(
									'base'      => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
									'format'    => '',
									'add_args'  => '',
									'current'   => $current,
									'total'     => $the_query->max_num_pages,
									'prev_text' => '<i aria-hidden="true" class="feather icon-feather-arrow-left"></i>',
									'next_text' => '<i aria-hidden="true" class="feather icon-feather-arrow-right"></i>',
									'type'      => 'list',
									'end_size'  => 3,
									'mid_size'  => 3,
								)
							);
						?>
						</div>
					</div>
					<?php
				}
			}
			wp_reset_postdata();
		}
	}
}
