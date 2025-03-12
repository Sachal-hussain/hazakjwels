<?php
/**
 * WooCommerce Attributes Taxonomy
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Litho_Set_Attribute_Taxonomies' ) ) {
	/**
	 * Define Litho_Set_Attribute_Taxonomies Class
	 */
	class Litho_Set_Attribute_Taxonomies {

		/**
		 * Add WooCommerce Attributes.
		 */
		public function add_woocommerce_attribute_taxonomies() {

			global $wpdb;

			$transient_name = 'wc_attribute_taxonomies';
			delete_transient( $transient_name );

			$wpdb->insert(
				$wpdb->prefix . 'woocommerce_attribute_taxonomies',
				array(
					'attribute_name'    => 'color',
					'attribute_label'   => 'Color',
					'attribute_type'    => 'select',
					'attribute_orderby' => 'menu_order',
					'attribute_public'  => '0',
				),
				array(
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
				),
			);

			$wpdb->insert(
				$wpdb->prefix . 'woocommerce_attribute_taxonomies',
				array(
					'attribute_name'    => 'size',
					'attribute_label'   => 'Size',
					'attribute_type'    => 'select',
					'attribute_orderby' => 'menu_order',
					'attribute_public'  => '0',
				),
				array(
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
				),
			);

			register_taxonomy(
				'pa_color',
				'product',
				array(
					'label'        => __( 'Product', 'litho-addons' ),
					'rewrite'      => array( 'slug' => 'pa_color' ),
					'hierarchical' => true,
				)
			);
			register_taxonomy(
				'pa_size',
				'product',
				array(
					'label'        => __( 'Size', 'litho-addons' ),
					'rewrite'      => array( 'slug' => 'pa_size' ),
					'hierarchical' => true,
				)
			);

			$attribute_taxonomies = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'woocommerce_attribute_taxonomies' );
			set_transient( $transient_name, $attribute_taxonomies );
		}

	} // end of class

	$litho_set_attribute_taxonomies = new Litho_Set_Attribute_Taxonomies();

} // end of class_exists
