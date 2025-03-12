<?php
/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting(
	'litho_import_export_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_import_export_separator',
		array(
			'label'    => esc_html__( 'Export Import Settings', 'litho-addons' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_import_export',
			'settings' => 'litho_import_export_separator',
		)
	)
);

/* End Separator Settings */

/* Customizer import export settings */

$wp_customize->add_setting(
	'litho_import_export_setting',
	array(
		'default' => '',
		'type'    => 'none',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Import_Export(
		$wp_customize,
		'litho_import_export_setting',
		array(
			'type'     => 'litho_import_export',
			'section'  => 'litho_import_export',
			'settings' => 'litho_import_export_setting',
		)
	)
);

/* Customizer import export settings */
