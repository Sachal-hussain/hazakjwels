<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "header" tag.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<!-- keywords -->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<!-- viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!-- profile -->
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
	</head>
	<?php
	$litho_custom_attr_body = '';
	if ( function_exists( 'litho_custom_attr_helper_obj' ) ) {
		ob_start();
		litho_custom_attr_helper_obj()->attr( 'body' );
		$litho_custom_attr_body = ob_get_contents();
		ob_end_clean();
	}
	?>
	<body <?php body_class(); ?> <?php echo sprintf( '%s', $litho_custom_attr_body ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		/**
		 * Fires immediately after body tag
		 *
		 * @since 1.0
		 */
		do_action( 'wp_body_open' );
	}

	/**
	 * Fires immediately when page loaded
	 *
	 * @since 1.0
	 */
	do_action( 'litho_preloader' );


	get_template_part( 'templates/header/header', 'wrapper' );
