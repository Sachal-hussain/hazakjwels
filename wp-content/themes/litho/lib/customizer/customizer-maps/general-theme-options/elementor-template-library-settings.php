<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'LITHO_ADDONS_PLUGIN_VERSION' ) ) {
	return;
}


/* Litho Mini Cart Enable*/

$wp_customize->add_setting(
	'litho_litho_mini_cart_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_litho_mini_cart_separator',
		array(
			'label'    => esc_html__( 'Litho Mini Cart', 'litho' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_add_elementor_template_library_panel',
			'settings' => 'litho_litho_mini_cart_separator',
			'priority' => 7,
		)
	)
);

/* End Separator Settings */

$wp_customize->add_setting(
	'litho_litho_mini_cart_hide',
	array(
		'default'           => '1',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Switch_Control(
		$wp_customize,
		'litho_litho_mini_cart_hide',
		array(
			'label'    => esc_html__( 'Mini Cart', 'litho' ),
			'section'  => 'litho_add_elementor_template_library_panel',
			'settings' => 'litho_litho_mini_cart_hide',
			'type'     => 'litho_switch',
			'choices'  => array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
			),
			'priority' => 7,
		)
	)
);

/* END Litho Mini Cart Enable*/

/* Litho Mobile Animation Enable*/

$wp_customize->add_setting(
	'litho_litho_mobile_animation_separator',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Separator_Control(
		$wp_customize,
		'litho_litho_mobile_animation_separator',
		array(
			'label'    => esc_html__( 'Mobile Animation', 'litho' ),
			'type'     => 'litho_separator',
			'section'  => 'litho_add_elementor_template_library_panel',
			'settings' => 'litho_litho_mobile_animation_separator',
			'priority' => 7,
		)
	)
);

/* End Separator Settings */

$wp_customize->add_setting(
	'litho_litho_mobile_animation_enable',
	array(
		'default'           => '0',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control(
	new Litho_Customize_Switch_Control(
		$wp_customize,
		'litho_litho_mobile_animation_enable',
		array(
			'label'    => esc_html__( 'Mobile Animation', 'litho' ),
			'section'  => 'litho_add_elementor_template_library_panel',
			'settings' => 'litho_litho_mobile_animation_enable',
			'type'     => 'litho_switch',
			'choices'  => array(
				'1' => esc_html__( 'On', 'litho' ),
				'0' => esc_html__( 'Off', 'litho' ),
			),
			'priority' => 7,
		)
	)
);

/* END Litho Mobile Animation Enable*/
