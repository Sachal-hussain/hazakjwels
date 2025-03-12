<?php
/**
 * The template for displaying the default title
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_single() || ( is_woocommerce_activated() && is_product() ) ) {
	return;
}

/**
 * Default title
 */
if ( is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() ) ) {

	$litho_title = woocommerce_page_title( false );

} elseif ( is_search() || is_category() || is_tag() || is_archive() ) {

	if ( is_tag() ) {
		$litho_archive_title = sprintf( '%s', single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$litho_archive_title = sprintf( '%s', get_the_author() );
	} elseif ( is_category() ) {
		$litho_archive_title = sprintf( '%s', single_tag_title( '', false ) );
	} elseif ( is_year() ) {
		$litho_archive_title = sprintf( '%s', get_the_date( _x( 'Y', 'yearly archives date format', 'litho' ) ) );
	} elseif ( is_month() ) {
		$litho_archive_title = sprintf( '%s', get_the_date( _x( 'F Y', 'monthly archives date format', 'litho' ) ) );
	} elseif ( is_day() ) {
		$litho_archive_title = sprintf( '%s', get_the_date( _x( '', 'daily archives date format', 'litho' ) ) ); // phpcs:ignore
	} elseif ( is_search() ) {
		$litho_archive_title = __( 'Search Results For&nbsp;', 'litho' ) . '"' . get_search_query() . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} elseif ( is_archive() ) {
		$litho_archive_title = esc_html__( 'Archives', 'litho' );
	} else {
		$litho_archive_title = get_the_title();
	}

	$litho_title = $litho_archive_title;

} elseif ( is_home() ) {

	$litho_title = esc_html__( 'Blog', 'litho' );

} else {
	$litho_title = get_the_title();
}

if ( ! empty( $litho_title ) || '' !== $litho_title ) {
	?>
	<div class="litho-main-title-wrappper default-main-title-wrappper">
		<div class="top-space">
			<div class="litho-main-title-wrap main-title-inner litho-page-title-wrap left-alignment">
				<div class="container">
					<div class="row align-items-center title-content-wrap alt-font">
						<div class="col-xl-8 col-lg-6 text-center text-lg-start">
							<h1 class="litho-main-title litho-page-title"><?php echo esc_html( $litho_title ); ?></h1>
						</div>
						<div class="col-xl-4 col-lg-6 text-center text-lg-end justify-content-center justify-content-lg-end breadcrumb-wrapper">
							<ul class="litho-main-title-breadcrumb main-title-breadcrumb litho-page-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
								<?php echo litho_breadcrumb_display(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
