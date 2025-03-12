<?php
/**
 * Template for displaying search forms
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_unique_id = uniqid( 'search-form-' );
/**
 * Filter for change seach placeholder text
 *
 * @since 1.0
 */
$litho_search_placeholder_text = apply_filters( 'litho_search_placeholder_text', esc_html__( 'Enter your keywords...', 'litho' ) );
?>
<form role="search" method="get" class="search-box alt-font" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-input-wrap">
		<input class="search-input" id="<?php echo esc_attr( $litho_unique_id ); ?>" placeholder="<?php echo esc_attr( $litho_search_placeholder_text ); ?>" name="s" value="<?php echo get_search_query(); ?>" type="text" autocomplete="off">
		<button class="btn" type="submit"><i class="feather icon-feather-search ml-0"></i></button>
	</div>
</form>
