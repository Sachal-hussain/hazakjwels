<?php
/**
 * The template for displaying the footer from section builder
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_footer_class          = array( 'footer-main-wrapper', 'site-footer' );
$litho_enable_footer_general = litho_builder_customize_option( 'litho_enable_footer_general', '1' );
$litho_enable_footer         = litho_builder_option( 'litho_enable_footer', '1', $litho_enable_footer_general );
$litho_footer_section_id     = litho_builder_option( 'litho_footer_section', '', $litho_enable_footer_general );

/**
 * Filter to add footer wrapper classes so user can add it's own classes
 *
 * @since 1.0
 */
$litho_footer_wrapper_class = apply_filters( 'litho_main_footer_wrapper_class', $litho_footer_class );

if ( 1 == $litho_enable_footer && ! empty( $litho_footer_section_id ) ) {
	/* footer sticky type */
	$litho_footer_sticky_type = get_post_meta( $litho_footer_section_id, '_litho_footer_sticky_type', true );
	if ( 'sticky' == $litho_footer_sticky_type ) {
		$litho_footer_wrapper_class[] = 'footer-sticky';
	}
	$class = ( is_array( $litho_footer_wrapper_class ) ) ? implode( ' ', $litho_footer_wrapper_class ) : '';
	?>
	<!-- start footer -->
		<footer class="<?php echo esc_attr( $class ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
			<?php
			if ( current_user_can( 'edit_posts' ) && ! is_customize_preview() ) {
				$edit_link = add_query_arg(
					array(
						'post'   => $litho_footer_section_id,
						'action' => 'elementor',
					),
					admin_url( 'post.php' )
				);
				?>
				<a href="<?php echo esc_url( $edit_link ); ?>" target="_blank" data-bs-placement="right" title="<?php echo esc_attr__( 'Edit footer section', 'litho' ); ?>" class="edit-litho-section edit-footer litho-tooltip">
						<i class="ti-pencil"></i>
				</a>
				<?php
			}

			/**
			 * Fires to Load Footer from the Section Builder.
			 *
			 * @since 1.0
			 */
			do_action( 'theme_footer' );
			?>
		</footer>
	<!-- end footer -->
	<?php
}
