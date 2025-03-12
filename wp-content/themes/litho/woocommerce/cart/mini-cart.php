<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="litho-top-cart-wrapper top-cart-wrapper">
	<div class="litho-cart-top-counter cart-top-counter">
		<i class="litho-cart-icon cart-icon icon-feather-shopping-bag" aria-hidden="true"></i>
		<span class="litho-mini-cart-counter mini-cart-counter alt-font"><?php echo WC()->cart->get_cart_contents_count(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	</div>
	<div class="litho-mini-cart-content-wrap mini-cart-content-wrap">
		<?php if ( ! WC()->cart->is_empty() ) : ?>
			<div class="litho-mini-cart-lists-wrap">
				<ul class="woocommerce-mini-cart cart_list product_list_widget">
					<?php
					do_action( 'woocommerce_before_mini_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'litho-popular-posts-thumb' ), $cart_item, $cart_item_key );
							$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo apply_filters(
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr__( 'Remove this item', 'litho' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
								<div class="product-image">
									<?php if ( ! $_product->is_visible() ) : ?>
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . esc_html( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</a>
									<?php endif; ?>
								</div>
								<div class="product-detail alt-font">
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo esc_html( $product_name ); ?>
									</a>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
							</li>
							<?php
						}
					}
					do_action( 'woocommerce_mini_cart_contents' );
					?>
				</ul>
			</div>
			<div class="min-cart-total">

				<p class="woocommerce-mini-cart__total total alt-font">
					<?php
					/**
					 * Hook: woocommerce_widget_shopping_cart_total.
					 *
					 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
					 */
					do_action( 'woocommerce_widget_shopping_cart_total' );
					?>
				</p>
				<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

				<p class="woocommerce-mini-cart__buttons buttons alt-font">
					<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
				</p>
			</div>

			<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

		<?php else : ?>

				<div class="litho-mini-cart-content-inner mini-cart-content-inner">
					<p class="woocommerce-mini-cart__empty-message alt-font"><span><i class="icon-basket litho-no-cart-icon no-cart-icon"></i></span><?php esc_html_e( 'No products in the cart', 'litho' ); ?></p>
				</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_mini_cart' ); ?>

	</div>

</div>
