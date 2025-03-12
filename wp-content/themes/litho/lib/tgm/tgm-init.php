<?php
/**
 * TGM Init Class
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if use is not logged in.
if ( ! is_admin() ) {
	return;
}

define( 'LITHO_PLUGINS_URI', 'http://api.themezaa.com/litho/plugins/' );
define( 'LITHO_PLUGINS_CURRENT_USER_URI', LITHO_PLUGINS_URI . LITHO_THEME_VERSION );

if ( file_exists( LITHO_THEME_TGM . '/class-tgm-plugin-activation.php' ) ) {
	require_once LITHO_THEME_TGM . '/class-tgm-plugin-activation.php';
}

if ( ! function_exists( 'litho_register_required_plugins' ) ) :
	/**
	 * Register required plugins
	 */
	function litho_register_required_plugins() {

		$plugin_list = array(
			array(
				'name'               => esc_html__( 'Litho Addons', 'litho' ),                  // The plugin name.
				'slug'               => 'litho-addons',                                         // The plugin slug (typically the folder name).
				'source'             => LITHO_PLUGINS_CURRENT_USER_URI . '/litho-addons.zip',   // The plugin source.
				'required'           => true,                                                   // If false, the plugin is only 'recommended' instead of required.
				'version'            => LITHO_ADDONS_VERSION,                                   // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented.
				'force_activation'   => false,                                                  // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false,                                                  // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '',                                                     // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'     => esc_html__( 'Elementor', 'litho' ),   // The plugin name.
				'slug'     => 'elementor',                          // The plugin slug (typically the folder name).
				'required' => true,                                 // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'               => esc_html__( 'Slider Revolution', 'litho' ),          // The plugin name.
				'slug'               => 'revslider',                                         // The plugin slug (typically the folder name).
				'source'             => LITHO_PLUGINS_CURRENT_USER_URI . '/revslider.zip',   // The plugin source.
				'required'           => false,                                               // If false, the plugin is only 'recommended' instead of required.
				'version'            => LITHO_REVOLUTION_VERSION,                            // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented.
				'force_activation'   => false,                                               // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false,                                               // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '',                                                  // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'     => esc_html__( 'WooCommerce', 'litho' ),   // The plugin name.
				'slug'     => 'woocommerce',                          // The plugin slug (typically the folder name).
				'required' => false,                                  // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'litho' ),   // The plugin name.
				'slug'     => 'contact-form-7',                          // The plugin slug (typically the folder name).
				'required' => false,                                     // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'     => esc_html__( 'MC4WP: Mailchimp for WordPress', 'litho' ),   // The plugin name.
				'slug'     => 'mailchimp-for-wp',                                        // The plugin slug (typically the folder name).
				'required' => false,                                                     // If false, the plugin is only 'recommended' instead of required.
			),
		);

		$mainconfig =
			array(
				'id'           => 'litho_tgmpa',          // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',                     // Default absolute path to bundled plugins.
				'menu'         => 'litho-theme-setup',    // Menu slug.
				'step'         => '2',
				'parent_slug'  => 'themes.php',           // Parent menu slug.
				'capability'   => 'edit_theme_options',   // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
				'has_notices'  => true,                   // Show admin notices or not.
				'dismissable'  => true,                   // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                     // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false,                  // Automatically activate plugins after installation or not.
				'message'      => '',                     // Message to output right before the plugins table.
			);

		tgmpa( $plugin_list, $mainconfig );

	}
endif;
add_action( 'tgmpa_register', 'litho_register_required_plugins' );

if ( ! function_exists( 'litho_upgrader_pre_download' ) ) {
	/**
	 * Check pre download notice
	 */
	function litho_upgrader_pre_download( $reply, $package, $upgrader ) {

		if ( strpos( $package, 'api.themezaa.com' ) !== false ) {

			$is_theme_license_active = is_theme_license_active();
			if ( ! $is_theme_license_active ) {
				return new WP_Error( 'litho_license_error', esc_html__( 'Theme license must be activated to install theme bundled premium plugins.', 'litho' ) );
			}
		}

		return $reply;
	}
}
add_filter( 'upgrader_pre_download', 'litho_upgrader_pre_download', 10, 3 );
