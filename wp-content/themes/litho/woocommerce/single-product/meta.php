<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$litho_single_product_enable_sku      = get_theme_mod( 'litho_single_product_enable_sku', '1' );
$litho_single_product_enable_category = get_theme_mod( 'litho_single_product_enable_category', '1' );
$litho_single_product_enable_tag      = get_theme_mod( 'litho_single_product_enable_tag', '1' );
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( '1' == $litho_single_product_enable_sku ) { ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<?php
			$sku = ( $product->get_sku() ) ? $product->get_sku() : esc_html__( 'N/A', 'litho' );
			?>
			<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'litho' ); ?> <span class="sku"><?php echo sprintf( '%s', esc_html( $sku ) ); ?></span></span>

		<?php endif; ?>

	<?php } ?>

	<?php if ( '1' == $litho_single_product_enable_category ) { ?>

		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'litho' ) . ' ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<?php } ?>

	<?php if ( '1' == $litho_single_product_enable_tag ) { ?>

		<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'litho' ) . ' ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	<?php } ?>
</div>
