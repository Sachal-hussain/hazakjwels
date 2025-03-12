<?php
/**
 * Displaying right sidebar for portfolio
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
			</div>
		<?php
		break;
	case 'litho_layout_left_sidebar':
		?>
			</div>
			<aside id="secondary" class="col-12 col-xl-3 col-lg-4 col-md-12 sidebar litho-portfolio-sidebar litho-blog-sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_portfolio_left_sidebar );

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
		?>
			</div>
			<aside id="secondary" class="col-12 col-xl-3 col-lg-4 col-md-12 sidebar litho-portfolio-sidebar litho-blog-sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_portfolio_right_sidebar );

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
		?>
			</div>
			<aside id="primary" class="col-12 col-lg-3 sidebar litho-portfolio-sidebar both-sidebar-left litho-blog-sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_portfolio_left_sidebar );

				/**
				 * Fires immediately after siderbar content end
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_end' );
				?>
			</aside>
			<aside id="secondary" class="col-12 col-lg-3 sidebar litho-portfolio-sidebar both-sidebar-right litho-blog-sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
				<?php
				/**
				 * Fires immediately before siderbar content start
				 *
				 * @since 1.0
				 */
				do_action( 'litho_sidebar_content_start' );

				litho_page_sidebar_style( $litho_portfolio_right_sidebar );

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
