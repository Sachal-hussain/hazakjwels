<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper">
		<?php
		if ( $post_thumbnail_id ) {

			$attachment_id     = $product->get_image_id();
			$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
			$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
			$image_size        = apply_filters( 'woocommerce_gallery_image_size', 'woocommerce_single' );
			$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
			$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
			$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
			$image             = wp_get_attachment_image(
				$attachment_id,
				$image_size,
				false,
				array(
					'title'                   => get_post_field( 'post_title', $attachment_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
					'data-src'                => $full_src[0],
					'data-large_image'        => $full_src[0],
					'data-large_image_width'  => $full_src[1],
					'data-large_image_height' => $full_src[2],
					'class'                   => 'wp-post-image',
				)
			);

			$html = '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="woocommerce-product-gallery__image"><a data-elementor-open-lightbox="no" href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>'; // phpcs:ignore

		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'litho' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:ignore

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</div>
</div>
