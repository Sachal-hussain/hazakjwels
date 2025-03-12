<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$column_class  = '';
$litho_columns = wc_get_loop_prop( 'columns' );

if ( isset( $_GET['column'] ) ) {
 $litho_columns = $_GET['column']; // phpcs:ignore
}

switch ( $litho_columns ) {
 case '1':
     $column_class .= 'row-cols-1 ';
     break;
 case '2':
     $column_class .= 'row-cols-1 row-cols-sm-2 ';
     break;
 case '4':
     $column_class .= 'row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 ';
     break;
 case '5':
     $column_class .= 'row-cols-1 row-cols-xl-5 row-cols-lg-3 row-cols-sm-2 ';
     break;
 case '6':
     $column_class .= 'row-cols-1 row-cols-xl-6 row-cols-lg-3 row-cols-sm-2 ';
     break;
 case '3':
 default:
     $column_class .= 'row-cols-1 row-cols-lg-3 row-cols-sm-2 ';
     break;
}
echo '<ul class="' . esc_attr( $column_class ) . 'row shop-product-list">';
