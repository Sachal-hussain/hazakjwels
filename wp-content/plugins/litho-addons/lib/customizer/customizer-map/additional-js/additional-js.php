<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Addtional JS */
global $wp_version;

/* Separator Settings */
$wp_customize->add_setting(
	'litho_additional_js_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_additional_js_separator',
		array(
			'label'    => esc_html__( 'Additional JS', 'litho-addons' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_custom_js',
			'settings' => 'litho_additional_js_separator',
		)
	)
);

/* End Separator Settings */

if ( $wp_version < '4.9.0' ) {

	$wp_customize->add_setting(
		'litho_custom_js',
		array(
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'custom_html',
			array(
				'label'       => esc_html__( 'Additional JS', 'litho-addons' ),
				'type'        => 'textarea',
				'settings'    => 'litho_custom_js',
				'section'     => 'litho_custom_js',
				'description' => esc_html__( 'Only accepts javascript code, wrapped with <script> tags and valid HTML markup inside the </body> tag.', 'litho-addons' ),
			)
		)
	);

} else {

	$wp_customize->add_setting(
		'litho_custom_js',
		array(
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Code_Editor_Control(
			$wp_customize,
			'custom_html',
			array(
				'label'       => esc_html__( 'Additional JS', 'litho-addons' ),
				'code_type'   => 'javascript',
				'settings'    => 'litho_custom_js',
				'section'     => 'litho_custom_js',
				'description' => esc_html__( 'Only accepts javascript code, wrapped with <script> tags and valid HTML markup inside the </body> tag.', 'litho-addons' ),
			)
		)
	);
}
/* End Addtional Js */
