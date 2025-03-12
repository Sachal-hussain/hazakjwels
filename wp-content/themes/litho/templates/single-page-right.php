<?php
/**
 * Displaying right sidebar for pages
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_page_layout_setting = litho_option( 'litho_page_layout_setting', 'litho_layout_no_sidebar' );
$litho_page_right_sidebar  = litho_option( 'litho_page_right_sidebar', '' );
$litho_page_left_sidebar   = litho_option( 'litho_page_left_sidebar', '' );
/**
 * Filter for change layout style for ex. ?sidebar=right_sidebar
 *
 * @since 1.0
 */
$litho_page_layout_setting = apply_filters( 'litho_page_layout_style', $litho_page_layout_setting );

/* Left Sidebar */
if ( 'litho_layout_left_sidebar' === $litho_page_layout_setting ) {

	if ( ! empty( $litho_page_left_sidebar ) && ! is_active_sidebar( $litho_page_left_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_no_sidebar';

	} elseif ( empty( $litho_page_left_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_no_sidebar';
	}
}

/* Right Sidebar */
if ( 'litho_layout_right_sidebar' === $litho_page_layout_setting ) {

	if ( ! empty( $litho_page_right_sidebar ) && ! is_active_sidebar( $litho_page_right_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_no_sidebar';

	} elseif ( empty( $litho_page_right_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_no_sidebar';
	}
}

/* Both Sidebar */
if ( 'litho_layout_both_sidebar' === $litho_page_layout_setting ) {

	if ( ! empty( $litho_page_left_sidebar ) && ! is_active_sidebar( $litho_page_left_sidebar ) && ! empty( $litho_page_right_sidebar ) && ! is_active_sidebar( $litho_page_right_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_no_sidebar';

	} elseif ( ( ! empty( $litho_page_left_sidebar ) && is_active_sidebar( $litho_page_left_sidebar ) ) && ! empty( $litho_page_right_sidebar ) && is_active_sidebar( $litho_page_right_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_both_sidebar';

	} elseif ( ! empty( $litho_page_left_sidebar ) && is_active_sidebar( $litho_page_left_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_left_sidebar';

	} elseif ( ! empty( $litho_page_right_sidebar ) && is_active_sidebar( $litho_page_right_sidebar ) ) {

		$litho_page_layout_setting = 'litho_layout_right_sidebar';

	} else {
		$litho_page_layout_setting = 'litho_layout_no_sidebar';
	}
}

switch ( $litho_page_layout_setting ) {
	case 'litho_layout_no_sidebar':
		?>
			</div>
		<?php
		break;
	case 'litho_layout_left_sidebar':
		/* if WooCommerce plugin is activated */
		$litho_page_class = ( is_woocommerce_activated() && is_account_page() ) ? '' : ' litho-page-widget-area';
		?>
			</div>
			<aside id="secondary" class="col-12 col-xl-3 col-lg-4 col-md-12 sidebar litho-page-sidebar litho-blog-sidebar<?php echo esc_attr( $litho_page_class ); ?>" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_page_left_sidebar );

				/**
				 * Fires immediately after siderbar content end
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_end' );
				?>
			</aside>
		<?php
		break;
	case 'litho_layout_right_sidebar':
		/* if WooCommerce plugin is activated */
		$litho_page_class = ( is_woocommerce_activated() && is_account_page() ) ? '' : ' litho-page-widget-area';
		?>
			</div>
			<aside id="secondary" class="col-12 col-xl-3 col-lg-4 col-md-12 sidebar litho-page-sidebar litho-blog-sidebar<?php echo esc_attr( $litho_page_class ); ?>" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_page_right_sidebar );

				/**
				 * Fires immediately after siderbar content end
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_end' );
				?>
			</aside>
		<?php
		break;
	case 'litho_layout_both_sidebar':
		/* if WooCommerce plugin is activated */
		$litho_page_left_class  = ( is_woocommerce_activated() && is_account_page() ) ? ' both-sidebar-left' : ' both-sidebar-left litho-page-widget-area';
		$litho_page_right_class = ( is_woocommerce_activated() && is_account_page() ) ? ' both-sidebar-right' : ' both-sidebar-right litho-page-widget-area';
		?>
			</div>
			<aside id="primary" class="col-12 col-lg-3 sidebar litho-page-sidebar litho-blog-sidebar<?php echo esc_attr( $litho_page_left_class ); ?>" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_page_left_sidebar );

				/**
				 * Fires immediately after siderbar content end
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_end' );
				?>
			</aside>
			<aside id="secondary" class="col-12 col-lg-3 sidebar litho-page-sidebar litho-blog-sidebar<?php echo esc_attr( $litho_page_right_class ); ?>" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_page_right_sidebar );

				/**
				 * Fires immediately after siderbar content end
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_end' );
				?>
			</aside>
		<?php
		break;
}
