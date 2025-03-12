<?php
/**
 * WooCommerce Functions
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* if WooCommerce plugin is activated */
if ( is_woocommerce_activated() ) {

	/* Remove default woocommerce sidebar */
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	if ( ! function_exists( 'litho_product_attribute_customizer_array' ) ) :
		/**
		 * To get Product Attribute list in Customize
		 */
		function litho_product_attribute_customizer_array() {

			$attribute_array      = array();
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( ! empty( $attribute_taxonomies ) ) {
				foreach ( $attribute_taxonomies as $tax ) {
					if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
						$attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
					}
				}
			}
			return $attribute_array;
		}
	endif;


	// remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
	// add_action( 'woocommerce_cart_is_empty', 'litho_empty_cart_message', 10 );

	if ( ! function_exists( 'litho_empty_cart_message' ) ) {
		/**
		 * Show notice if cart is empty.
		 */
		function litho_empty_cart_message() {

			echo '<p class="cart-empty alt-font"><i class="icon-basket base-color"></i>' . wp_kses_post( apply_filters( 'wc_empty_cart_message', esc_html__( 'Your cart is currently empty.', 'litho' ) ) ) . '</p>';
		}
	}	

	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'litho_woocommerce_breadcrumb', 'litho_woocommerce_breadcrumb', 20, 0 );
	if ( ! function_exists( 'litho_woocommerce_breadcrumb' ) ) {
		/**
		 * To Remove woocommerce_breadcrumb Action And Add New Action For WooCommerce Breadcrumb
		 */
		function litho_woocommerce_breadcrumb( $args = array() ) {
			$args = wp_parse_args(
				$args,
				apply_filters(
					'woocommerce_breadcrumb_defaults',
					array(
						'delimiter'   => '',
						'wrap_before' => '',
						'wrap_after'  => '',
						'before'      => '',
						'after'       => '',
						'home'        => _x( 'Home', 'breadcrumb', 'litho' ),
					)
				)
			);

			$breadcrumbs = new WC_Breadcrumb();

			if ( ! empty( $args['home'] ) ) {
				$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
			}

			$args['breadcrumb'] = $breadcrumbs->generate();

			/**
			 * WooCommerce Breadcrumb hook
			 *
			 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
			 */
			do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

			wc_get_template( 'global/breadcrumb.php', $args );
		}
	}

	add_action( 'woocommerce_before_shop_loop', 'litho_override_woocommerce_before_shop_loop' );
	if ( ! function_exists( 'litho_override_woocommerce_before_shop_loop' ) ) {
		/**
		 *  WordPress Shop Rich Snippet Code
		 */
		function litho_override_woocommerce_before_shop_loop() {
			if ( is_shop() ) { // Check if product shop page.
				global $post;
				$litho_product_rich_snippet_archive = get_theme_mod( 'litho_product_rich_snippet_archive', '1' );
				$litho_author                       = get_the_author_meta( 'display_name', $post->post_author );

				if ( 1 == $litho_product_rich_snippet_archive ) {
					$output  = '';
					$output .= '<div class="litho-rich-snippet d-none">';
					$output .= '<span class="entry-title">' . esc_html( woocommerce_page_title( false ) ) . '</span>';
					$output .= '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( $litho_author ) . '</a></span>';
					$output .= '<span class="published">' . esc_html( get_the_date() ) . '</span><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time>';
					$output .= '</div>';
					echo $output;
				}
			}
		}
	}

	add_action( 'woocommerce_before_single_product_summary', 'litho_override_woocommerce_after_shop_loop_item' );
	add_action( 'woocommerce_after_shop_loop_item', 'litho_override_woocommerce_after_shop_loop_item' );
	if ( ! function_exists( 'litho_override_woocommerce_after_shop_loop_item' ) ) {
		/**
		 *  WordPress Shop Rich Snippet Code
		 */
		function litho_override_woocommerce_after_shop_loop_item() {

			$litho_product_rich_snippet = get_theme_mod( 'litho_product_rich_snippet', '1' );

			if ( 1 == $litho_product_rich_snippet ) {
				global $post;
				$litho_author = get_the_author_meta( 'display_name', $post->post_author );

				$output  = '';
				$output .= '<div class="litho-rich-snippet d-none">';
				$output .= '<span class="entry-title">' . esc_html( get_the_title() ) . '</span>';
				$output .= '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( $litho_author ) . '</a></span>';
				$output .= '<span class="published">' . esc_html( get_the_date() ) . '</span><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time>';
				$output .= '</div>';
				echo wp_kses_post( $output );
			}
		}
	}

	add_action( 'wp', 'litho_wp_hook' );
	if ( ! function_exists( 'litho_wp_hook' ) ) {
		/**
		 *  WordPress Wp Action
		 */
		function litho_wp_hook() {

			if ( ! is_admin() && is_product() ) {

				/* To Remove product title */
				$litho_single_product_enable_title = get_theme_mod( 'litho_single_product_enable_title', '1' );

				if ( 1 != $litho_single_product_enable_title ) {
					remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
				}

				/* On / Off setting for related products */
				$litho_single_product_enable_related = get_theme_mod( 'litho_single_product_enable_related', '1' );
				if ( 1 != $litho_single_product_enable_related ) {
					remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
				}

				/* On / Off setting for Up Sells products */
				$litho_single_product_enable_up_sells = get_theme_mod( 'litho_single_product_enable_up_sells', '1' );
				if ( 1 != $litho_single_product_enable_up_sells ) {
					remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
				}
			}

			if ( ! is_admin() && is_cart() ) {

				/* On / Off setting for Cross Sells products */
				$litho_single_product_enable_cross_sells = get_theme_mod( 'litho_single_product_enable_cross_sells', '1' );
				if ( 1 != $litho_single_product_enable_cross_sells ) {
					remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
				}
			}

			if ( ! is_admin() && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() ) ) {

				/* On / Off setting for taxonomy description */
				$litho_show_product_archive_description_archive = get_theme_mod( 'litho_show_product_archive_description_archive', '0' );
				if ( 1 != $litho_show_product_archive_description_archive ) {
					remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
				}
			}
		}
	}

	add_filter( 'woocommerce_gallery_thumbnail_size', 'litho_override_woocommerce_gallery_thumbnail_size', 999 );
	if ( ! function_exists( 'litho_override_woocommerce_gallery_thumbnail_size' ) ) {
		/**
		 * To change Single product thumbnail size
		 */
		function litho_override_woocommerce_gallery_thumbnail_size() {

			return 'litho-popular-posts-thumb';
		}
	}


	add_filter( 'woocommerce_short_description', 'litho_override_woocommerce_short_description', 99 );
	if ( ! function_exists( 'litho_override_woocommerce_short_description' ) ) {
		/**
		 * To Remove product short description
		 */
		function litho_override_woocommerce_short_description( $short_description ) {
			if ( ! is_admin() && is_product() ) {
				$litho_single_product_enable_short_description = get_theme_mod( 'litho_single_product_enable_short_description', '1' );
				if ( 1 != $litho_single_product_enable_short_description ) {
					return false;
				}
			}
			return $short_description;
		}
	}


	add_filter( 'woocommerce_product_description_heading', 'litho_override_woocommerce_product_tab_content_heading', 99 );
	add_filter( 'woocommerce_product_additional_information_heading', 'litho_override_woocommerce_product_tab_content_heading', 99 );
	if ( ! function_exists( 'litho_override_woocommerce_product_tab_content_heading' ) ) {
		/**
		 * To Remove Tab Content Heading
		 */
		function litho_override_woocommerce_product_tab_content_heading( $heading ) {
			if ( ! is_admin() && is_product() ) {
				$litho_single_product_enable_tab_content_heading = get_theme_mod( 'litho_single_product_enable_tab_content_heading', '1' );
				if ( 1 != $litho_single_product_enable_tab_content_heading ) {
					return false;
				}
			}
			return $heading;
		}
	}


	add_filter( 'woocommerce_output_related_products_args', 'litho_override_woocommerce_output_related_products_args', 99 );
	if ( ! function_exists( 'litho_override_woocommerce_output_related_products_args' ) ) {
		/**
		 * Add product per page & no. of column for related products
		 */
		function litho_override_woocommerce_output_related_products_args( $args ) {

			$litho_single_product_no_of_products_related = get_theme_mod( 'litho_single_product_no_of_products_related', '3' );
			$litho_single_product_no_of_columns_related  = get_theme_mod( 'litho_single_product_no_of_columns_related', '3' );

			if ( ! empty( $litho_single_product_no_of_products_related ) ) {
				$args['posts_per_page'] = esc_attr( $litho_single_product_no_of_products_related );
			}
			if ( ! empty( $litho_single_product_no_of_columns_related ) ) {
				$args['columns'] = esc_attr( $litho_single_product_no_of_columns_related );
			}
			return $args;
		}
	}

	add_filter( 'woocommerce_upsell_display_args', 'litho_override_woocommerce_upsell_display_args', 99 );
	if ( ! function_exists( 'litho_override_woocommerce_upsell_display_args' ) ) {
		/**
		 * Add product per page & no. of column for Up Sells products
		 */
		function litho_override_woocommerce_upsell_display_args( $args ) {

			$litho_single_product_no_of_products_up_sells = get_theme_mod( 'litho_single_product_no_of_products_up_sells', '3' );
			$litho_single_product_no_of_columns_up_sells  = get_theme_mod( 'litho_single_product_no_of_columns_up_sells', '3' );

			if ( ! empty( $litho_single_product_no_of_products_up_sells ) ) {
				$args['posts_per_page'] = esc_attr( $litho_single_product_no_of_products_up_sells );
			}
			if ( ! empty( $litho_single_product_no_of_columns_up_sells ) ) {
				$args['columns'] = esc_attr( $litho_single_product_no_of_columns_up_sells );
			}

			return $args;
		}
	}

	add_filter( 'woocommerce_cross_sells_columns', 'litho_override_woocommerce_cross_sells_columns', 99 );
	if ( ! function_exists( 'litho_override_woocommerce_cross_sells_columns' ) ) {
		/**
		 * Add product no. of column for Cross Sells products
		 */
		function litho_override_woocommerce_cross_sells_columns( $no_of_columns ) {

			$litho_single_product_no_of_columns_cross_sells = get_theme_mod( 'litho_single_product_no_of_columns_cross_sells', '3' );
			if ( ! empty( $litho_single_product_no_of_columns_cross_sells ) ) {
				$no_of_columns = esc_attr( $litho_single_product_no_of_columns_cross_sells );
			}

			return $no_of_columns;
		}
	}

	/* Add product per page for Cross Sells products */
	add_filter( 'woocommerce_cross_sells_total', 'litho_override_woocommerce_cross_sells_total', 99 );
	if ( ! function_exists( 'litho_override_woocommerce_cross_sells_total' ) ) {
		function litho_override_woocommerce_cross_sells_total( $per_page ) {

			$litho_single_product_no_of_products_cross_sells = get_theme_mod( 'litho_single_product_no_of_products_cross_sells', '3' );
			if ( ! empty( $litho_single_product_no_of_products_cross_sells ) ) {
				$per_page = esc_attr( $litho_single_product_no_of_products_cross_sells );
			}

			return $per_page;
		}
	}

	/* Add social share on product page */
	add_action( 'woocommerce_product_meta_end', 'litho_override_woocommerce_product_meta_end' );
	if ( ! function_exists( 'litho_override_woocommerce_product_meta_end' ) ) {
		function litho_override_woocommerce_product_meta_end() {

			$litho_single_product_enable_social_share = get_theme_mod( 'litho_single_product_enable_social_share', '1' );
			if ( 1 == $litho_single_product_enable_social_share && function_exists( 'litho_single_product_share_shortcode' ) ) {
				echo do_shortcode( '[litho_single_product_share]' );
			}
		}
	}

	/* Add dynamic class for no. of columns */
	add_filter( 'post_class', 'litho_override_wc_product_post_class', 99, 3 );
	if ( ! function_exists( 'litho_override_wc_product_post_class' ) ) {
		function litho_override_wc_product_post_class( $classes, $class = '', $post_id = '' ) {
			if ( ! $post_id || ! in_array( get_post_type( $post_id ), array( 'product', 'product_variation' ) ) ) {
				return $classes;
			}

			$product = wc_get_product( $post_id );

			if ( $product && ! is_admin() ) {

				global $woocommerce_loop;

				$columns = isset( $woocommerce_loop['columns'] ) ? $woocommerce_loop['columns'] : '';

				// Added Custom No. of column dynamic class.
				$classes[] = 'litho-product-' . $columns . 'col';
			}

			return $classes;
		}
	}

	/* To Remove product star rating */
	add_filter( 'woocommerce_product_get_rating_html', 'litho_override_woocommerce_product_get_rating_html', 99 );
	if ( ! function_exists( 'litho_override_woocommerce_product_get_rating_html' ) ) {
		function litho_override_woocommerce_product_get_rating_html( $star_rating_html ) {
			if ( ! is_admin() ) {

				if ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() ) {

					$litho_product_archive_enable_star_rating = get_theme_mod( 'litho_product_archive_enable_star_rating', '1' );
					if ( '1' != $litho_product_archive_enable_star_rating ) {
						return false;
					}
				}
			}
			return $star_rating_html;
		}
	}

	/* Add no. of column for shop or archive page */
	add_filter( 'loop_shop_columns', 'litho_override_loop_shop_columns', 99 );
	if ( ! function_exists( 'litho_override_loop_shop_columns' ) ) {
		function litho_override_loop_shop_columns( $no_of_columns ) {

			$litho_product_archive_page_column = get_theme_mod( 'litho_product_archive_page_column', '3' );
			if ( ! empty( $litho_product_archive_page_column ) ) {
				$no_of_columns = esc_attr( $litho_product_archive_page_column );
			}

			return $no_of_columns;
		}
	}

	/* Add product per page for shop or archive page */
	add_filter( 'loop_shop_per_page', 'litho_override_loop_shop_per_page', 99 );
	if ( ! function_exists( 'litho_override_loop_shop_per_page' ) ) {
		function litho_override_loop_shop_per_page( $per_page ) {

			$litho_product_archive_page_per_page = get_theme_mod( 'litho_product_archive_page_per_page', '12' );
			if ( ! empty( $litho_product_archive_page_per_page ) ) {
				$per_page = esc_attr( $litho_product_archive_page_per_page );
			}

			return $per_page;
		}
	}
}

add_filter( 'woocommerce_layered_nav_count', 'litho_override_woocommerce_layered_nav_count', 10, 2 );
if ( ! function_exists( 'litho_override_woocommerce_layered_nav_count' ) ) {
	/**
	 * To Remove bracket from attribute product counter
	 */
	function litho_override_woocommerce_layered_nav_count( $count_html, $count ) {

		$count_html = str_replace( '(', '<span> ', $count_html );
		$count_html = str_replace( ')', '</span>', $count_html );
		$count_html = str_replace( $count, str_pad( $count, 2, 0, STR_PAD_LEFT ), $count_html );
		return $count_html;
	}
}

add_filter( 'woocommerce_rating_filter_count', 'litho_override_woocommerce_rating_filter_count', 10, 2 );
if ( ! function_exists( 'litho_override_woocommerce_rating_filter_count' ) ) {
	/**
	 * To Remove bracket from rating widget
	 */
	function litho_override_woocommerce_rating_filter_count( $count_html, $count ) {

		$count_html = str_replace( '(', '', $count_html );
		$count_html = str_replace( ')', '', $count_html );
		$count_html = str_replace( $count, str_pad( $count, 2, 0, STR_PAD_LEFT ), $count_html );
		return $count_html;
	}
}

add_filter( 'woocommerce_breadcrumb_defaults', 'litho_override_woocommerce_breadcrumb_defaults' );
if ( ! function_exists( 'litho_override_woocommerce_breadcrumb_defaults' ) ) {
	/**
	 * Override default breadcrumb
	 */
	function litho_override_woocommerce_breadcrumb_defaults( $defaults ) {
		$defaults['before'] = '<li>';
		$defaults['after']  = '</li>';
		return $defaults;
	}
}

/* Product single page */
add_action( 'woocommerce_before_main_content', 'litho_add_content_woocommerce_before_main_content', 1 );

// Change WooCommerce wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'litho_add_content_woocommerce_before_main_content' ) ) {
	function litho_add_content_woocommerce_before_main_content() {

		$class  = '';
		$class .= ' default-top-space-main-section';
		if ( ! is_litho_addons_activated() ) {
			$class .= ' default-shop-main-section';
		}

		if ( is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() || is_archive() ) ) {

			$litho_product_layout_setting          = get_theme_mod( 'litho_product_layout_setting_archive', 'litho_layout_right_sidebar' );
			$litho_product_container_style_archive = get_theme_mod( 'litho_product_container_style_archive', 'container' );
			$litho_product_top_space_archive       = get_theme_mod( 'litho_product_top_space_archive', '0' );
			$class                                .= ( 1 == $litho_product_top_space_archive ) ? ' top-space' : '';
			// Filter for change layout style for ex. ?sidebar=right_sidebar.
			$litho_product_layout_setting = apply_filters( 'litho_page_layout_style', $litho_product_layout_setting ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			// Filter for change layout style for ex. ?sidebar=right_sidebar.
			$litho_product_archive_container_style = apply_filters( 'litho_page_container_style', $litho_product_container_style_archive );
			$litho_produc_layout_setting_class     = ( ! empty( $litho_product_layout_setting ) ) ? ' ' . $litho_product_layout_setting . '_single' : '';

			echo '<div class="litho-shop-content-wrap litho-main-inner-content-wrap' . esc_attr( $class ) . '">';
				echo '<div class="' . esc_attr( $litho_product_archive_container_style ) . esc_attr( $litho_produc_layout_setting_class ) . '">';
					echo '<div class="row">';
					get_template_part( 'templates/woocommerce/archive', 'before-product' );

		} else {

			$litho_product_layout_setting   = litho_option( 'litho_product_layout_setting', 'litho_layout_no_sidebar' );
			$litho_product_container_style  = litho_option( 'litho_product_container_style', 'container' );
			$litho_single_product_top_space = litho_option( 'litho_single_product_top_space', '1' );
			// Filter for change layout style for ex. ?sidebar=right_sidebar.
			$litho_product_layout_setting = apply_filters( 'litho_page_layout_style', $litho_product_layout_setting ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			$litho_produc_layout_setting_class = ( ! empty( $litho_product_layout_setting ) ) ? ' ' . $litho_product_layout_setting . '_single' : '';

			$class .= ( 1 == $litho_single_product_top_space ) ? ' top-space' : '';

			echo '<div class="litho-single-product-content-wrap litho-main-inner-content-wrap' . esc_attr( $class ) . '">';
				echo '<div class="' . esc_attr( $litho_product_container_style ) . esc_attr( $litho_produc_layout_setting_class ) . '">';
					echo '<div class="row">';
						get_template_part( 'templates/woocommerce/content', 'before-product' );
		}
	}
}

add_action( 'woocommerce_after_main_content', 'litho_add_content_woocommerce_after_main_content', 99 );

if ( ! function_exists( 'litho_add_content_woocommerce_after_main_content' ) ) {
	function litho_add_content_woocommerce_after_main_content() {

		if ( is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() || is_archive() ) ) {
			get_template_part( 'templates/woocommerce/archive', 'after-product' );
		} else {
			get_template_part( 'templates/woocommerce/content', 'after-product' );
		}
					echo '</div>';
				echo '</div>';
			echo '</div>';
	}
}

add_filter( 'woocommerce_show_page_title', 'litho_remove_woocommerce_show_page_title', 10, 1 );
if ( ! function_exists( 'litho_remove_woocommerce_show_page_title' ) ) {
	/**
	 * Remove shop title
	 */
	function litho_remove_woocommerce_show_page_title( $true ) {
		return false;
	}
}

/* Remove cross sell products from right part */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

add_action( 'woocommerce_checkout_before_customer_details', 'litho_woocommerce_checkout_before_customer_details' );
if ( ! function_exists( 'litho_woocommerce_checkout_before_customer_details' ) ) {
	function litho_woocommerce_checkout_before_customer_details() {
		echo '<div class="checkout-content-left">';
	}
}

add_action( 'woocommerce_checkout_after_customer_details', 'litho_woocommerce_checkout_after_customer_details' );
if ( ! function_exists( 'litho_woocommerce_checkout_after_customer_details' ) ) {
	function litho_woocommerce_checkout_after_customer_details() {
		echo '</div>';
	}
}

add_action( 'woocommerce_checkout_before_order_review_heading', 'litho_woocommerce_checkout_before_order_review_heading' );
if ( ! function_exists( 'litho_woocommerce_checkout_before_order_review_heading' ) ) {
	function litho_woocommerce_checkout_before_order_review_heading() {
		echo '<div class="checkout-content-right">';
	}
}

add_action( 'woocommerce_checkout_after_order_review', 'litho_woocommerce_checkout_after_order_review', 999 );
if ( ! function_exists( 'litho_woocommerce_checkout_after_order_review' ) ) {
	function litho_woocommerce_checkout_after_order_review() {
		echo '</div>';
	}
}

if ( ! function_exists( 'litho_woocommerce_pagination_args' ) ) {
	/**
	 * Woocommerce Pagination args
	 */
	function litho_woocommerce_pagination_args( $args ) {

		if ( isset( $args['prev_text'] ) ) {
			$args['prev_text'] = sprintf( '<i aria-hidden="true" class="feather icon-feather-arrow-left"></i>' );
		}

		if ( isset( $args['next_text'] ) ) {
			$args['next_text'] = sprintf( '<i aria-hidden="true" class="feather icon-feather-arrow-right"></i>' );
		}
		return $args;
	}
}
add_filter( 'woocommerce_pagination_args', 'litho_woocommerce_pagination_args' );
