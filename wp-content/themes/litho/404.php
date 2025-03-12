<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Litho
 */

get_header();

$litho_page_not_found_image = get_theme_mod( 'litho_page_not_found_image', '' );
/* Get 404 page main title */
$litho_page_not_found_main_title = get_theme_mod( 'litho_page_not_found_main_title', esc_html__( 'OOOPS!', 'litho' ) );
/* Get 404 page title */
$litho_page_not_found_title = get_theme_mod( 'litho_page_not_found_title', esc_html__( '404', 'litho' ) );
/* Get 404 page subtitle */
$litho_page_not_found_subtitle = get_theme_mod( 'litho_page_not_found_subtitle', esc_html__( 'This page could not be found!', 'litho' ) );
/* Check if button hide / show */
$litho_page_not_found_button = get_theme_mod( 'litho_page_not_found_button', '1' );
/* Get button text */
$litho_page_not_found_button_text = get_theme_mod( 'litho_page_not_found_button_text', esc_html__( 'BACK TO HOMEPAGE', 'litho' ) );
/* Get button url */
$litho_page_not_found_button_url = get_theme_mod( 'litho_page_not_found_button_url', home_url( '/' ) );
/* Get 404 top space header height */
$litho_page_not_found_top_space = get_theme_mod( 'litho_page_not_found_top_space', 'no' );

$litho_page_not_found_top_space_class = ( 'yes' === $litho_page_not_found_top_space ) ? ' top-space' : '';

if ( ! empty( $litho_page_not_found_image ) ) {
	echo '<section class="p-0 cover-background error-404 error-404-bg' . esc_attr( $litho_page_not_found_top_space_class ) . '" style="background-image: url(' . esc_url( $litho_page_not_found_image ) . ');">';
} else {
	echo '<section class="p-0 cover-background error-404' . esc_attr( $litho_page_not_found_top_space_class ) . '">';
}
echo '<div class="container">';
echo '<div class="row align-items-stretch justify-content-center full-screen">';
echo '<div class="col-12 col-xl-6 col-lg-7 col-md-8 text-center d-flex align-items-center justify-content-center flex-column">';
if ( ! empty( $litho_page_not_found_main_title ) ) {
	$litho_page_not_found_main_title = str_replace( '||', '<br />', $litho_page_not_found_main_title );
	echo '<h6 class="alt-font litho-sub-heading">' . esc_html( $litho_page_not_found_main_title ) . '</h6>';
}

if ( ! empty( $litho_page_not_found_title ) ) {
	$litho_page_not_found_title = str_replace( '||', '<br />', $litho_page_not_found_title );
	echo '<h1 class="alt-font litho-heading">' . esc_html( $litho_page_not_found_title ) . '</h1>';
}
if ( ! empty( $litho_page_not_found_subtitle ) ) {
	$litho_page_not_found_subtitle = str_replace( '||', '<br />', $litho_page_not_found_subtitle );
	echo '<span class="alt-font litho-not-found-text">' . esc_html( $litho_page_not_found_subtitle ) . '</span>';
}
if ( '1' === $litho_page_not_found_button ) {
	echo '<a href="' . esc_url( $litho_page_not_found_button_url ) . '" class="btn">' . esc_html( $litho_page_not_found_button_text ) . '</a>';
}
echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';

get_footer();
