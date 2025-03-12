<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Addons_Customizer` doesn't exists yet.
if ( ! class_exists( 'Litho_Addons_Customizer' ) ) {

	/* Main Customizer class */
	class Litho_Addons_Customizer {

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'litho_add_customizer_sections' ), 10 );
			add_action( 'customize_register', array( $this, 'litho_register_options_settings_and_controls' ), 20 );
		}

		public function litho_add_customizer_sections( $wp_customize ) {

			// Add Custom Additional JS.
			$wp_customize->add_section(
				'litho_custom_js',
				array(
					'title'    => esc_html__( 'Additional JS', 'litho-addons' ),
					'priority' => 230,
				)
			);

			// Add Customizer import export.
			$wp_customize->add_section(
				'litho_import_export',
				array(
					'title'    => esc_html__( 'Export / Import Settings', 'litho-addons' ),
					'priority' => 240,
				)
			);
		}

		/* Register option settings To Customizer */
		public function litho_register_options_settings_and_controls( $wp_customize ) {

			/* Register Custom Controls */
			if ( file_exists( LITHO_ADDONS_CUSTOMIZER_CONTROLS . '/custom-controls.php' ) ) {
				require_once LITHO_ADDONS_CUSTOMIZER_CONTROLS . '/custom-controls.php';
			}

			/* Register Custom Select with optgroup */
			if ( file_exists( LITHO_ADDONS_CUSTOMIZER_CONTROLS . '/customizer-import.php' ) ) {
				require_once LITHO_ADDONS_CUSTOMIZER_CONTROLS . '/customizer-import.php';
			}

			/* Register Additional Settings */
			if ( file_exists( LITHO_ADDONS_CUSTOMIZER_MAPS . '/additional-js/additional-js.php' ) ) {
				require_once LITHO_ADDONS_CUSTOMIZER_MAPS . '/additional-js/additional-js.php';
			}

			/* Register General theme Settings */
			if ( file_exists( LITHO_ADDONS_CUSTOMIZER_MAPS . '/general-theme-options/general-layout-settings.php' ) ) {
				require_once LITHO_ADDONS_CUSTOMIZER_MAPS . '/general-theme-options/general-layout-settings.php';
			}
		}
	} // end of class

	$litho_addons_customizer = new Litho_Addons_Customizer();

} // end of class_exists
