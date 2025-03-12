<?php
/**
 * The template for displaying the mini header builder
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_enable_mini_header_general = litho_builder_customize_option( 'litho_enable_mini_header_general', '1' );
$litho_enable_mini_header         = litho_builder_option( 'litho_enable_mini_header', '0', $litho_enable_mini_header_general );
$litho_mini_header_section        = litho_builder_option( 'litho_mini_header_section', '', $litho_enable_mini_header_general );
$litho_header_sticky_type         = get_post_meta( $litho_mini_header_section, '_litho_mini_header_sticky_type', true );
/* Mini Header sticky type */
$litho_header_sticky_type = ( ! empty( $litho_header_sticky_type ) ) ? ' ' . $litho_header_sticky_type : '';

/* Mini header section */
if ( 1 == $litho_enable_mini_header && ! empty( $litho_mini_header_section ) && 'elementor_library' !== get_post_type( get_the_ID() ) ) {
	?>
	<div class="mini-header-main-wrapper<?php echo esc_attr( $litho_header_sticky_type ); ?>">
	<?php
	if ( current_user_can( 'edit_posts' ) && ! is_customize_preview() && ! empty( $litho_mini_header_section ) ) {
			$edit_link = add_query_arg(
				array(
					'post'   => $litho_mini_header_section,
					'action' => 'elementor',
				),
				admin_url( 'post.php' )
			);
		?>
		<a href="<?php echo esc_url( $edit_link ); ?>" target="_blank" data-bs-placement="right" title="<?php echo esc_attr__( 'Edit mini header section', 'litho' ); ?>" class="edit-litho-section edit-mini-header litho-tooltip">
				<i class="ti-pencil"></i>
		</a>
		<?php
	}

	/**
	 * Fires to Load Mini Header from the Section Builder.
	 *
	 * @since 1.0
	 */
	do_action( 'theme_mini_header' );
	?>
	</div>
	<?php
}
