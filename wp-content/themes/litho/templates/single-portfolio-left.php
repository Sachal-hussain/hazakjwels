<?php
/**
 * Displaying left template for portfolio
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_portfolio_layout_setting = litho_option( 'litho_portfolio_layout_setting', 'litho_layout_no_sidebar' );
$litho_portfolio_right_sidebar  = litho_option( 'litho_portfolio_right_sidebar', '' );
$litho_portfolio_left_sidebar   = litho_option( 'litho_portfolio_left_sidebar', '' );

/**
 * Filter for change layout style for ex. ?sidebar=right_sidebar
 *
 * @since 1.0
 */
$litho_portfolio_layout_setting = apply_filters( 'litho_page_layout_style', $litho_portfolio_layout_setting );

/* Left Sidebar */
if ( 'litho_layout_left_sidebar' == $litho_portfolio_layout_setting ) {

	if ( ! empty( $litho_portfolio_left_sidebar ) && ! is_active_sidebar( $litho_portfolio_left_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_no_sidebar';

	} elseif ( empty( $litho_portfolio_left_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_no_sidebar';
	}
}

/* Right Sidebar */
if ( 'litho_layout_right_sidebar' == $litho_portfolio_layout_setting ) {

	if ( ! empty( $litho_portfolio_right_sidebar ) && ! is_active_sidebar( $litho_portfolio_right_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_no_sidebar';

	} elseif ( empty( $litho_portfolio_right_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_no_sidebar';
	}
}

/* Both Sidebar */
if ( 'litho_layout_both_sidebar' == $litho_portfolio_layout_setting ) {

	if ( ! empty( $litho_portfolio_left_sidebar ) && ! is_active_sidebar( $litho_portfolio_left_sidebar ) && ! empty( $litho_portfolio_right_sidebar ) && ! is_active_sidebar( $litho_portfolio_right_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_no_sidebar';

	} elseif ( ( ! empty( $litho_portfolio_left_sidebar ) && is_active_sidebar( $litho_portfolio_left_sidebar ) ) && ! empty( $litho_portfolio_right_sidebar ) && is_active_sidebar( $litho_portfolio_right_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_both_sidebar';

	} elseif ( ! empty( $litho_portfolio_left_sidebar ) && is_active_sidebar( $litho_portfolio_left_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_left_sidebar';

	} elseif ( ! empty( $litho_portfolio_right_sidebar ) && is_active_sidebar( $litho_portfolio_right_sidebar ) ) {

		$litho_portfolio_layout_setting = 'litho_layout_right_sidebar';

	} else {

		$litho_portfolio_layout_setting = 'litho_layout_no_sidebar';
	}
}

switch ( $litho_portfolio_layout_setting ) {
	case 'litho_layout_no_sidebar':
		?>
			<div class="col-12 litho-content-full-part">
		<?php
		break;
	case 'litho_layout_left_sidebar':
		?>
			<div class="col-12 col-xl-9 col-lg-8 litho-layout-left-sidebar litho-portfolio-left-sidebar litho-content-right-part">
		<?php
		break;
	case 'litho_layout_right_sidebar':
		?>
			<div class="col-12 col-xl-9 col-lg-8 litho-layout-right-sidebar litho-portfolio-right-sidebar litho-content-left-part">
		<?php
		break;
	case 'litho_layout_both_sidebar':
		?>
			<div class="col-12 col-lg-6 litho-layout-both-sidebar litho-portfolio-both-sidebar litho-content-center-part">
		<?php
		break;
}
