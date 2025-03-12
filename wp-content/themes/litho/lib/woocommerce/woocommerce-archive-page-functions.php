<?php
/**
 * WooCommerce Archive Page Functions
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'litho_template_loop_alternate_product_image' ) ) {
	/**
	 * To Add alternate product image to shop page
	 */
	function litho_template_loop_alternate_product_image() {

		global $post;

		$litho_product_archive_enable_alternate_image = litho_get_product_archive_enable_alternate_image();

		if ( $litho_product_archive_enable_alternate_image != '1' ) {
			return false;
		}

		$alternate_img_id = get_post_meta( $post->ID, '_litho_product_alternate_image_single', true );
		if ( empty( $alternate_img_id ) ) {
			return;
		}

		$image_size = apply_filters( 'litho_loop_alternate_product_thumbnail_size', 'woocommerce_thumbnail' );
		$attr       = array( 'class' => "litho-alternate-image attachment-$image_size size-$image_size" );
		$image      = wp_get_attachment_image( $alternate_img_id, $image_size, '', $attr );

		echo apply_filters( 'litho_loop_get_alternate_product_image', $image, $image_size, $attr ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'litho_template_loop_alternate_product_image', 15 );

if ( ! function_exists( 'litho_get_product_archive_enable_alternate_image' ) ) {
	/**
	 * To get Product archive enable alternate image
	 */
	function litho_get_product_archive_enable_alternate_image() {

		$enable_alternate_image = get_theme_mod( 'litho_product_archive_enable_alternate_image', '1' );

		return apply_filters( 'litho_product_archive_enable_alternate_image', $enable_alternate_image );
	}
}

/* add DIV befor link open */
add_action( 'woocommerce_before_shop_loop_item', 'litho_woocommerce_template_loop_product_link_open', 5 );
if ( ! function_exists( 'litho_woocommerce_template_loop_product_link_open' ) ) {
	function litho_woocommerce_template_loop_product_link_open() {
		echo '<div class="litho-product-image">';
	}
}

add_action( 'woocommerce_after_shop_loop_item', 'litho_woocommerce_template_loop_product_link_close', 15 );
if ( ! function_exists( 'litho_woocommerce_template_loop_product_link_close' ) ) {
	function litho_woocommerce_template_loop_product_link_close() {
		echo '</div>';
	}
}
/* END DIV after link close */

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item', 'litho_woocommerce_template_loop_product_title', 20 );
if ( ! function_exists( 'litho_woocommerce_template_loop_product_title' ) ) {
	function litho_woocommerce_template_loop_product_title() {
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 20 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 20 );
