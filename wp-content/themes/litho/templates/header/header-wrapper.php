<?php
/**
 * Header Wrapper
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_main_content_class = '';
$litho_box_layout         = litho_option( 'litho_enable_box_layout', '0' );
// Get header settings.
$litho_enable_header_general = litho_builder_customize_option( 'litho_enable_header_general', '1' );
$litho_enable_header         = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
$litho_header_section_id     = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );

$litho_template_header_style = get_post_meta( $litho_header_section_id, '_litho_template_header_style', true );
// Get footer settings.
$litho_enable_footer_general = litho_builder_customize_option( 'litho_enable_footer_general', '1' );
$litho_enable_footer         = litho_builder_option( 'litho_enable_footer', '1', $litho_enable_footer_general );
$litho_footer_section_id     = litho_builder_option( 'litho_footer_section', '', $litho_enable_footer_general );
$litho_footer_sticky_type    = get_post_meta( $litho_footer_section_id, '_litho_footer_sticky_type', true );

if ( 'sticky' == $litho_footer_sticky_type ) {
	$litho_main_content_class = ' main-content';
}

$main_wrapper_class = ( 1 == $litho_box_layout ) ? 'box-layout' : 'page-layout';

if ( 'standard' === $litho_template_header_style ) {

	get_template_part( 'templates/header/header' );
	?>
	<!-- Page layout / Box layout Start -->
	<div class="<?php echo esc_attr( $main_wrapper_class ); ?>">
		<?php
			/* Title OR WooCommerce plugin is activated and WooCommerce product page */
			get_template_part( 'templates/title/title' );
		?>
			<!-- Start .litho-main-content-wrap -->
			<div class="litho-main-content-wrap<?php echo esc_attr( $litho_main_content_class ); ?>">
		<?php
} else {
	?>
	<!-- Page layout / Box layout Start -->
	<div class="<?php echo esc_attr( $main_wrapper_class ); ?>">
		<?php
		// Left Menu Classic Style Start.
		if ( ( 'left-menu-classic' === $litho_template_header_style ) && 1 == $litho_enable_header ) {
			?>
			<!-- Start .left-sidebar-wrapper -->
			<div class="left-sidebar-wrapper" data-sticky_parent>
			<?php
		}

		get_template_part( 'templates/header/header' );
		// Left Menu Classic Style Content Start.
		if ( 'left-menu-classic' === $litho_template_header_style ) {
			?>
			<!-- Start .page-main-site-content -->
			<div class="page-main-site-content" data-sticky_column>
			<?php
		}
		// Left Menu Modern Style Start.
		if ( ( 'left-menu-modern' === $litho_template_header_style ) && 1 == $litho_enable_header ) {
			?>
				<!-- Start .page wrapper -->
				<div class="page-wrapper">
			<?php
		}
		/* Title OR WooCommerce plugin is activated and WooCommerce product page */
		get_template_part( 'templates/title/title' );
		?>
		<!-- Start .litho-main-content-wrap -->
		<div class="litho-main-content-wrap<?php echo esc_attr( $litho_main_content_class ); ?>">
			<?php
}
