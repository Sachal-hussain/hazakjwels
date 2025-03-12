<?php
/**
 * Register Custom Post Type Portfolio.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Portfolio custom post type
 */
$labels = array(
	'name'               => _x( 'Portfolio', 'Projects', 'litho-addons' ),
	'singular_name'      => _x( 'Portfolio', 'Project', 'litho-addons' ),
	'add_new'            => _x( 'Add New', 'Project', 'litho-addons' ),
	'add_new_item'       => __( 'Add New Project', 'litho-addons' ),
	'edit_item'          => __( 'Edit Project', 'litho-addons' ),
	'new_item'           => __( 'New Project', 'litho-addons' ),
	'all_items'          => __( 'All Projects', 'litho-addons' ),
	'view_item'          => __( 'View Project', 'litho-addons' ),
	'search_items'       => __( 'Search Projects', 'litho-addons' ),
	'not_found'          => __( 'No Projects found', 'litho-addons' ),
	'not_found_in_trash' => __( 'No Projects found in the Trash', 'litho-addons' ),
	'parent_item_colon'  => '',
	'menu_name'          => __( 'Portfolio', 'litho-addons' ),
);

$args = array(
	'labels'        => $labels,
	'description'   => __( 'Holds our products and product specific data', 'litho-addons' ),
	'public'        => true,
	'menu_icon'     => 'dashicons-portfolio',
	'menu_position' => 21,
	'show_in_rest'  => true,
	'show_ui'       => true,
	'supports'      => array( 'title', 'thumbnail', 'editor', 'author', 'excerpt', 'post-formats', 'comments', 'revisions', 'page-attributes', 'elementor' ),
	'has_archive'   => true,
	'hierarchical'  => true,
);

$litho_portfolio_url_slug = get_theme_mod( 'litho_portfolio_url_slug', '' );

if ( ! empty( $litho_portfolio_url_slug ) ) {
	$args['rewrite'] = array( 'slug' => trim( $litho_portfolio_url_slug ) );
}
register_post_type( 'portfolio', $args );

/**
 * Portflio Category
 */
$labels = array(
	'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'litho-addons' ),
	'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'litho-addons' ),
	'search_items'      => __( 'Search categories', 'litho-addons' ),
	'all_items'         => __( 'All Categories', 'litho-addons' ),
	'parent_item'       => __( 'Parent Category', 'litho-addons' ),
	'parent_item_colon' => __( 'Parent Category:', 'litho-addons' ),
	'edit_item'         => __( 'Edit Category', 'litho-addons' ),
	'update_item'       => __( 'Update Category', 'litho-addons' ),
	'add_new_item'      => __( 'Add New Category', 'litho-addons' ),
	'new_item_name'     => __( 'New Category Name', 'litho-addons' ),
	'menu_name'         => __( 'Categories', 'litho-addons' ),
);

$args = array(
	'labels'            => $labels,
	'public'            => true,
	'show_ui'           => true,
	'hierarchical'      => true,
	'show_admin_column' => true,
	'show_in_nav_menus' => true,
	'show_in_rest'      => true,
);

$litho_portfolio_cat_url_slug = get_theme_mod( 'litho_portfolio_cat_url_slug', '' );
if ( ! empty( $litho_portfolio_cat_url_slug ) ) {
	$args['rewrite'] = array( 'slug' => trim( $litho_portfolio_cat_url_slug ) );
}
register_taxonomy( 'portfolio-category', 'portfolio', $args );


/**
 * Portflio Tag
 */

$labels = array(
	'name'              => _x( 'Portfolio Tags', 'taxonomy general name', 'litho-addons' ),
	'singular_name'     => _x( 'Portfolio Tag', 'taxonomy singular name', 'litho-addons' ),
	'search_items'      => __( 'Search tags', 'litho-addons' ),
	'all_items'         => __( 'All Tags', 'litho-addons' ),
	'parent_item'       => __( 'Parent Tag', 'litho-addons' ),
	'parent_item_colon' => __( 'Parent Tag:', 'litho-addons' ),
	'edit_item'         => __( 'Edit Tag', 'litho-addons' ),
	'update_item'       => __( 'Update Tag', 'litho-addons' ),
	'add_new_item'      => __( 'Add New Tag', 'litho-addons' ),
	'new_item_name'     => __( 'New Tag Name', 'litho-addons' ),
	'menu_name'         => __( 'Tags', 'litho-addons' ),
);

$args = array(
	'labels'       => $labels,
	'hierarchical' => false,
	'query_var'    => true,
	'show_in_rest' => true,
);

$litho_portfolio_tags_url_slug = get_theme_mod( 'litho_portfolio_tags_url_slug', '' );
if ( ! empty( $litho_portfolio_tags_url_slug ) ) {
	$args['rewrite'] = array( 'slug' => trim( $litho_portfolio_tags_url_slug ) );
}
register_taxonomy( 'portfolio-tags', 'portfolio', $args );
