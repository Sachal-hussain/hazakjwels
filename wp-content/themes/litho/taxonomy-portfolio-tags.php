<?php
/**
 * The template for displaying Portfolio tags
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

	// Include the archive layout template.
	get_template_part( 'templates/portfolio-archive/layout' );

get_footer();
