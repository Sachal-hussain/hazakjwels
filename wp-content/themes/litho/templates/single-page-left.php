<?php
/**
 * Displaying left template for pages
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
		/* if WooCommerce plugin is activated */
		$litho_page_class = ( is_woocommerce_activated() && is_account_page() ) ? ' litho-my-account-full' : '';
		?>
			<div class="col-12 litho-content-full-part<?php echo esc_attr( $litho_page_class ); ?>">
		<?php
		break;
	case 'litho_layout_left_sidebar':
		/* if WooCommerce plugin is activated */
		$litho_page_class = ( is_woocommerce_activated() && is_account_page() ) ? ' pull-right' : ' pull-right litho-page-content-area';
		?>
			<div class="col-12 col-xl-9 col-lg-8 litho-content-right-part<?php echo esc_attr( $litho_page_class ); ?>">
		<?php
		break;
	case 'litho_layout_right_sidebar':
		/* if WooCommerce plugin is activated */
		$litho_page_class = ( is_woocommerce_activated() && is_account_page() ) ? '' : ' litho-page-content-area';
		?>
			<div class="col-12 col-xl-9 col-lg-8 litho-content-left-part<?php echo esc_attr( $litho_page_class ); ?>">
		<?php
		break;
	case 'litho_layout_both_sidebar':
		/* if WooCommerce plugin is activated */
		$litho_page_class = ( is_woocommerce_activated() && is_account_page() ) ? ' both-content-center' : ' both-content-center litho-page-content-area';
		?>
			<div class="col-12 col-lg-6 litho-layout-both-sidebar litho-content-center-part<?php echo esc_attr( $litho_page_class ); ?>">
		<?php
		break;
}
