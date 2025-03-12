<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_litho_addons_activated() ) {

	/* Separator Settings */
	$wp_customize->add_setting(
		'litho_post_social_sharing_separator',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr'
		)
	);

	$wp_customize->add_control(
		new Litho_Customize_Separator_Control(
			$wp_customize,
			'litho_post_social_sharing_separator',
			array(
				'label'    => esc_html__( 'Social share', 'litho' ),
				'type'     => 'litho_separator',
				'section'  => 'litho_add_social_share_section',
				'settings' => 'litho_post_social_sharing_separator',
			)
		)
	);

	/* End Separator Settings */

	/* Social Social share icon */

	$wp_customize->add_setting(
		'litho_single_post_social_sharing',
		array(
			'default'           => array( 'facebook', '1', 'Facebook', 'twitter', '1', 'Twitter', 'linkedin', '1', 'Linkedin', 'pinterest', '1', 'Pinterest' ),
			'sanitize_callback' => 'litho_sanitize_multiple_checkbox'
		)
	);

	$wp_customize->add_control(new Litho_Customize_Post_Social_Share( $wp_customize, 'litho_single_post_social_sharing', array(
		'label'       		=> esc_html__( 'Social media websites', 'litho' ),
		'type'              => 'litho_post_social_icons',
		'section'     		=> 'litho_add_social_share_section',
		'settings'			=> 'litho_single_post_social_sharing',
		'choices'           => array(
			'facebook' 		=> esc_html__( 'Facebook', 'litho' ),
			'twitter' 		=> esc_html__( 'Twitter', 'litho' ),
			'linkedin' 		=> esc_html__( 'Linkedin', 'litho' ),
			'pinterest' 	=> esc_html__( 'Pinterest', 'litho' ),
			'reddit' 		=> esc_html__( 'Reddit', 'litho' ),
			'stumbleupon'	=> esc_html__( 'StumbleUpon', 'litho' ),
			'digg' 			=> esc_html__( 'Digg', 'litho' ),
			'vk' 			=> esc_html__( 'VK', 'litho' ),
			'xing' 			=> esc_html__( 'XING', 'litho' ),
			'telegram' 		=> esc_html__( 'Telegram', 'litho' ),
			'ok' 			=> esc_html__( 'Ok', 'litho' ),
			'viber' 		=> esc_html__( 'Viber', 'litho' ),
			'whatsapp' 		=> esc_html__( 'WhatsApp', 'litho' ),
			'skype' 		=> esc_html__( 'Skype', 'litho' ),
	   	),
	) ) );

	/* End Social Social share icon */


	/* Separator Settings */
	$wp_customize->add_setting( 'litho_portfolio_social_sharing_separator', array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_portfolio_social_sharing_separator', array(
		'label'			=> esc_attr__( 'Social Share', 'litho' ),
		'type'			=> 'litho_separator',
		'section'		=> 'litho_portfolio_add_social_share_section',
		'settings'		=> 'litho_portfolio_social_sharing_separator',
	) ) );

	/* End Separator Settings */

	/* Social share icon */

	$wp_customize->add_setting( 'litho_single_portfolio_social_sharing', array(
		'default' 			=> '',
		'sanitize_callback' => 'litho_sanitize_multiple_checkbox'
	) );

	$wp_customize->add_control( new Litho_Customize_Post_Social_Share( $wp_customize, 'litho_single_portfolio_social_sharing', array(
		'label'    => esc_html__( 'Social Media Websites', 'litho' ),
		'type'     => 'litho_post_social_icons',
		'section'  => 'litho_portfolio_add_social_share_section',
		'settings' => 'litho_single_portfolio_social_sharing',
		'choices'  => array(
			'facebook' 		=> esc_html__( 'Facebook', 'litho' ),
			'twitter' 		=> esc_html__( 'Twitter', 'litho' ),
			'linkedin' 		=> esc_html__( 'Linkedin', 'litho' ),
			'pinterest' 	=> esc_html__( 'Pinterest', 'litho' ),
			'reddit' 		=> esc_html__( 'Reddit', 'litho' ),
			'stumbleupon'	=> esc_html__( 'StumbleUpon', 'litho' ),
			'digg' 			=> esc_html__( 'Digg', 'litho' ),
			'vk' 			=> esc_html__( 'VK', 'litho' ),
			'xing' 			=> esc_html__( 'XING', 'litho' ),
			'telegram' 		=> esc_html__( 'Telegram', 'litho' ),
			'ok' 			=> esc_html__( 'Ok', 'litho' ),
			'viber' 		=> esc_html__( 'Viber', 'litho' ),
			'whatsapp' 		=> esc_html__( 'WhatsApp', 'litho' ),
			'skype' 		=> esc_html__( 'Skype', 'litho' ),
		),
	) ) );

	/* End Social share icon */
}

if ( is_woocommerce_activated() ) {
	
	/* Separator Settings */
	$wp_customize->add_setting( 'litho_product_social_sharing_separator', array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_social_sharing_separator', array(
		'label'      		=> esc_attr__( 'Social Share', 'litho' ),
		'type'              => 'litho_separator',
		'section'    		=> 'litho_product_add_social_share_section',
		'settings'   		=> 'litho_product_social_sharing_separator',
	) ) );

	/* End Separator Settings */

	/* Social share icon */

	$wp_customize->add_setting( 'litho_single_product_social_sharing', array(
		'default' 			=> '',
		'sanitize_callback' => 'litho_sanitize_multiple_checkbox'
	) );

	$wp_customize->add_control( new Litho_Customize_Post_Social_Share( $wp_customize, 'litho_single_product_social_sharing', array(
		'label'       		=> esc_html__( 'Social Media Websites', 'litho' ),
		'type'              => 'litho_post_social_icons',
		'section'     		=> 'litho_product_add_social_share_section',
		'settings'			=> 'litho_single_product_social_sharing',
		'choices'           => array(
			'facebook' 		=> esc_html__( 'Facebook', 'litho' ),
			'twitter' 		=> esc_html__( 'Twitter', 'litho' ),
			'linkedin' 		=> esc_html__( 'Linkedin', 'litho' ),
			'pinterest' 	=> esc_html__( 'Pinterest', 'litho' ),
			'reddit' 		=> esc_html__( 'Reddit', 'litho' ),
			'stumbleupon'	=> esc_html__( 'StumbleUpon', 'litho' ),
			'digg' 			=> esc_html__( 'Digg', 'litho' ),
			'vk' 			=> esc_html__( 'VK', 'litho' ),
			'xing' 			=> esc_html__( 'XING', 'litho' ),
			'telegram' 		=> esc_html__( 'Telegram', 'litho' ),
			'ok' 			=> esc_html__( 'Ok', 'litho' ),
			'viber' 		=> esc_html__( 'Viber', 'litho' ),
			'whatsapp' 		=> esc_html__( 'WhatsApp', 'litho' ),
			'skype' 		=> esc_html__( 'Skype', 'litho' ),
		),
	) ) );

	/* End Social share icon */
}
