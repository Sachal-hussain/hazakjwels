<?php
/**
 * The template for displaying the header builder
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_enable_mini_header_general = litho_builder_customize_option( 'litho_enable_mini_header_general', '1' );
$litho_enable_header_general      = litho_builder_customize_option( 'litho_enable_header_general', '1' );
$litho_enable_mini_header         = litho_builder_option( 'litho_enable_mini_header', '0', $litho_enable_mini_header_general );
$litho_enable_header              = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
$header_with_mini_header          = ( 1 == $litho_enable_mini_header ) ? ' header-with-mini-header' : '';

if ( 1 == $litho_enable_header ) {
	?>
	<!-- Header -->
	<header id="masthead" class="site-header<?php echo esc_attr( $header_with_mini_header ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<?php
		if ( 1 == $litho_enable_mini_header ) {

			/* Mini header builder */
			get_template_part( 'templates/header/mini-header', 'builder' );
		}
		if ( 1 == $litho_enable_header ) {
			/* Main header builder */
			get_template_part( 'templates/header/main-header', 'builder' );
		}
		?>
	</header>
	<!-- End header -->
	<?php
}
