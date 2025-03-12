<?php
/**
 * The template for displaying the main header builder
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_data_sticky_column    = '';
$litho_nav_class             = array( 'header-common-wrapper', 'header-img' );
$litho_enable_header_general = litho_builder_customize_option( 'litho_enable_header_general', '1' );
$litho_enable_header         = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
$litho_header_section_id     = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );

/* Main header section */
if ( 1 == $litho_enable_header && ! empty( $litho_header_section_id ) ) {

	$litho_header_sticky_type    = get_post_meta( $litho_header_section_id, '_litho_header_sticky_type', true ); /* Header sticky type */
	$litho_template_header_style = get_post_meta( $litho_header_section_id, '_litho_template_header_style', true ); /* Header style */
	$litho_template_header_style = ( ! empty( $litho_template_header_style ) ) ? $litho_template_header_style : 'standard';
	$litho_header_sticky_type    = ( ! empty( $litho_header_sticky_type ) ) ? $litho_header_sticky_type : '';
	$litho_nav_class[]           = $litho_template_header_style;
	$litho_nav_class[]           = 'navbar';

	switch ( $litho_template_header_style ) {
		case 'standard':
		default:
			$litho_nav_class[] = 'navbar-expand-lg';

			if ( ! empty( $litho_header_sticky_type ) ) {
				$litho_nav_class[]  = $litho_header_sticky_type;
			}

			if ( 'no-sticky' != $litho_header_sticky_type ) {
				$litho_nav_class[] = 'fixed-top';
			}

			break;
		case 'left-menu-classic':
		case 'left-menu-modern':
			$litho_nav_class[]        = 'header-left-wrapper';
			$litho_data_sticky_column = ' data-sticky_column';
			break;
	}
}

/**
 * Filter to add header wrapper classes so user can add it's own classes
 *
 * @since 1.0
 */
$litho_header_wrapper_class = apply_filters( 'litho_main_header_wrapper_class', $litho_nav_class );
$class                      = ( is_array( $litho_header_wrapper_class ) ) ? ' ' . implode( ' ', $litho_header_wrapper_class ) : '';
?>
<nav class="<?php echo esc_attr( $class ); ?>"<?php echo esc_attr( $litho_data_sticky_column ); ?>>
	<?php
	if ( current_user_can( 'edit_posts' ) && ! is_customize_preview() && ! empty( $litho_header_section_id ) ) {
			$edit_link = add_query_arg(
				array(
					'post'   => $litho_header_section_id,
					'action' => 'elementor',
				),
				admin_url( 'post.php' )
			);
		?>
		<a href="<?php echo esc_url( $edit_link ); ?>" target="_blank" data-bs-placement="right" title="<?php echo esc_attr__( 'Edit header section', 'litho' ); ?>" class="edit-litho-section edit-header litho-tooltip">
				<i class="ti-pencil"></i>
		</a>
		<?php
	}

	/**
	 * Fires to Load Header from the Section Builder.
	 *
	 * @since 1.0
	 */
	do_action( 'theme_header' );
	?>
</nav>
