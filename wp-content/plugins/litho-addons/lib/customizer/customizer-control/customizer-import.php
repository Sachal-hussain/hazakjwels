<?php
/**
 * Customizer Import Export settings control
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Customize_Import_Export` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Import_Export' ) ) {

		class Litho_Customize_Import_Export extends WP_Customize_Control {

			public function enqueue() {

				$blank_file_error = __( 'Please select settings file', 'litho-addons' );
				$valid_file_error = __( 'Please select valid file type', 'litho-addons' );

				wp_enqueue_script( 'litho-addons-customizer-import', LITHO_ADDONS_ROOT_DIR . '/assets/js/admin/customizer-import-control.js', array( 'jquery' ), LITHO_ADDONS_PLUGIN_VERSION, false );

				wp_localize_script(
					'litho-addons-customizer-import',
					'lithoImport',
					array(
						'customizeurl'   => admin_url( 'customize.php' ),
						'exportnonce'    => wp_create_nonce( 'litho-exporting' ),
						'blankFileError' => $blank_file_error,
						'validFileError' => $valid_file_error,
					)
				);
			}

			public function render_content() {
				?>
					<span class="customize-control-title">
						<?php esc_html_e( 'Export', 'litho-addons' ); ?>
					</span>
					<span class="description customize-control-description">
						<?php esc_html_e( 'Click the below button for export the customization settings.', 'litho-addons' ); ?>
					</span>
					<input type="button" class="button button-primary" name="litho-export-button" value="<?php esc_attr_e( 'Export', 'litho-addons' ); ?>" />
					<hr class="litho-import-separator"/>
					<span class="customize-control-title">
						<?php esc_html_e( 'Import', 'litho-addons' ); ?>
					</span>
					<span class="description customize-control-description">
						<?php esc_html_e( 'Upload a file for import customization settings.', 'litho-addons' ); ?>
					</span>
					<div class="litho-import-controls">
						<input type="file" name="litho-import-file" class="litho-import-file" />
						<?php wp_nonce_field( 'litho-importing', 'litho-import' ); ?>
					</div>
					<div class="litho-uploading display-none"><?php esc_html_e( 'Importing...', 'litho-addons' ); ?></div>
					<input type="button" class="button button-primary" name="litho-import-button" value="<?php esc_attr_e( 'Import', 'litho-addons' ); ?>" />
				<?php
			}
		}
	}
}
