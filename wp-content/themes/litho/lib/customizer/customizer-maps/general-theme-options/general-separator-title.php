<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Separator Settings */
$wp_customize->add_setting( 'litho_title_tagline_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_title_tagline_separator', array(
	'label'				=> esc_html__( 'Site Identity', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'title_tagline',
	'settings'   		=> 'litho_title_tagline_separator',
	'priority'	 		=> 1
) ) );

/* End Separator Settings */

/* Separator Settings */
$wp_customize->add_setting( 'litho_header_image_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_header_image_separator', array(
	'label'				=> esc_html__( 'Header Image', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'header_image',
	'settings'   		=> 'litho_header_image_separator',
	'priority'	 		=> 1
) ) );

/* End Separator Settings */


/* Separator Settings */
$wp_customize->add_setting( 'litho_background_image_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_background_image_separator', array(
	'label'				=> esc_html__( 'Background Image Identity', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'background_image',
	'settings'   		=> 'litho_background_image_separator',
	'priority'	 		=> 1
) ) );

/* End Separator Settings */

/* Separator Settings */
$wp_customize->add_setting( 'litho_store_notice_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_store_notice_separator', array(
	'label'				=> esc_html__( 'Store Notice', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'woocommerce_store_notice',
	'settings'   		=> 'litho_store_notice_separator',
	'priority'	 		=> 1
) ) );

/* End Separator Settings */

/* Separator Settings */
$wp_customize->add_setting( 'litho_product_catalog_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_catalog_separator', array(
	'label'				=> esc_html__( 'Product Catalog', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'woocommerce_product_catalog',
	'settings'   		=> 'litho_product_catalog_separator',
	'priority'	 		=> 1
) ) );

/* End Separator Settings */

/* Separator Settings */
$wp_customize->add_setting( 'litho_product_images_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_images_separator', array(
	'label'				=> esc_html__( 'Product Images', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'woocommerce_product_images',
	'settings'   		=> 'litho_product_images_separator',
	'priority'	 		=> 1
) ) );

/* End Separator Settings */

/* Separator Settings */
$wp_customize->add_setting( 'litho_product_checkout_separator', array(
	'default' 			=> '',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Litho_Customize_Separator_Control( $wp_customize, 'litho_product_checkout_separator', array(
	'label'				=> esc_html__( 'Checkout', 'litho' ),
	'type'              => 'litho_separator',
	'section'    		=> 'woocommerce_checkout',
	'settings'   		=> 'litho_product_checkout_separator',
	'priority'	 		=> 1
) ) );

/* End Separator Settings */
