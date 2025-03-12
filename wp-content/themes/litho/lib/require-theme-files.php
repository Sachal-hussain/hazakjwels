<?php
/**
 * Include Required Files
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Require_Files_Class` doesn't exists yet.
if ( ! class_exists( 'Litho_Require_Files_Class' ) ) {
	/**
	 * Define class
	 */
	class Litho_Require_Files_Class {

		/**
		 * Constructor
		 */
		public function __construct() { }

		/**
		 * Includes all (require_once) php file(s) inside selected folder using class.
		 *
		 * @throws Exception If File is not found in folder.
		 * @param string $file_name Filename.
		 */
		public static function Litho_Theme_Require_Files( $file_name ) { // phpcs:ignore

			if ( is_array( $file_name ) ) {
				foreach ( $file_name as $name ) {
					require get_parent_theme_file_path( "/lib/{$name}.php" );
				}
			} else {
				throw new Exception( esc_html__( 'File is not found in folder as you given', 'litho' ) );
			}
		}
	}
}

$Litho_Require_Files_Class = new Litho_Require_Files_Class(); // phpcs:ignore

/*
 * Includes all required files for Litho Theme.
 */
Litho_Require_Files_Class::Litho_Theme_Require_Files(
	array(
		'license-activation/class-license-activation',
		'tgm/tgm-init',
		'enqueue-scripts-styles',
		'customizer/customizer',
		'register-sidebars',
		'navigation-menu-widget-walker',
		'default-header-menu--walker',
		'breadcrumb',
		'custom-attr-helper',
		'extra-functions',
		'class-excerpt',
		'google-font-list',
		'parameter-functions',
		'woocommerce/woocommerce-functions',
		'woocommerce/woocommerce-archive-page-functions',
	)
);
