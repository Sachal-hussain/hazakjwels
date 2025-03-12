<?php
/**
 * Include Required files
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// For Import.
if ( file_exists( LITHO_ADDONS_IMPORT . '/importer.php' ) ) {
	require_once LITHO_ADDONS_IMPORT . '/importer.php';
}
// For Customizer.
if ( file_exists( LITHO_ADDONS_CUSTOMIZER . '/customizer.php' ) ) {
	require_once LITHO_ADDONS_CUSTOMIZER . '/customizer.php';
}
/* For custom post type */
if ( file_exists( LITHO_ADDONS_CUSTOM_POST_TYPE_PATH . '/register-post-type-portfolio.php' ) ) {
	require_once LITHO_ADDONS_CUSTOM_POST_TYPE_PATH . '/register-post-type-portfolio.php';
}
/* For meta box */
if ( file_exists( LITHO_ADDONS_METABOX_PATH . '/meta-box.php' ) ) {
	require_once LITHO_ADDONS_METABOX_PATH . '/meta-box.php';
}
/* For extra function */
if ( file_exists( LITHO_ADDONS_ROOT . '/lib/extra-function.php' ) ) {
	require_once LITHO_ADDONS_ROOT . '/lib/extra-function.php';
}
/* For enqueue script/style */
if ( file_exists( LITHO_ADDONS_ROOT . '/lib/enqueue-scripts-styles.php' ) ) {
	require_once LITHO_ADDONS_ROOT . '/lib/enqueue-scripts-styles.php';
}
/* For meta box for archive */
if ( file_exists( LITHO_ADDONS_ROOT . '/lib/archive-meta.php' ) ) {
	require_once LITHO_ADDONS_ROOT . '/lib/archive-meta.php';
}
/* For excerpt */
if ( file_exists( LITHO_ADDONS_ROOT . '/lib/class-excerpt.php' ) ) {
	require_once LITHO_ADDONS_ROOT . '/lib/class-excerpt.php';
}
/* For icon list */
if ( file_exists( LITHO_ADDONS_ROOT . '/lib/icon-list.php' ) ) {
	require_once LITHO_ADDONS_ROOT . '/lib/icon-list.php';
}
/* For post like button */
if ( file_exists( LITHO_ADDONS_ROOT . '/lib/blog-post-like.php' ) ) {
	require_once LITHO_ADDONS_ROOT . '/lib/blog-post-like.php';
}
/* For woocommerece */
if ( is_woocommerce_activated() ) {
	if ( file_exists( LITHO_ADDONS_ROOT . '/lib/woocommerce/woocommerce-functions.php' ) ) {
		require_once LITHO_ADDONS_ROOT . '/lib/woocommerce/woocommerce-functions.php';
	}
}
