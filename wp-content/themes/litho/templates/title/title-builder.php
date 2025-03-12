<?php
/**
 * The template for displaying the title from section builder
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_enable_custom_title_general = litho_builder_customize_option( 'litho_enable_custom_title_general', '1' );
$litho_enable_custom_title         = litho_builder_option( 'litho_enable_custom_title', '1', $litho_enable_custom_title_general );
$litho_custom_title_section_id     = litho_builder_option( 'litho_custom_title_section', '', $litho_enable_custom_title_general );
$litho_custom_title_class          = array( 'litho-main-title-wrappper' );

/**
 * Filter to add title wrapper classes so user can add it's own classes
 *
 * @since 1.0
 */
$litho_custom_title_wrapper_class = apply_filters( 'litho_main_title_wrapper_class', $litho_custom_title_class );

$class = ( is_array( $litho_custom_title_wrapper_class ) ) ? implode( ' ', $litho_custom_title_wrapper_class ) : '';

if ( 1 == $litho_enable_custom_title && $litho_custom_title_section_id ) {
	?>
	<!-- start title -->
		<section class="<?php echo esc_attr( $class ); ?>">
			<?php
			if ( current_user_can( 'edit_posts' ) && ! is_customize_preview() ) {
				$edit_link = add_query_arg(
					array(
						'post'   => $litho_custom_title_section_id,
						'action' => 'elementor',
					),
					admin_url( 'post.php' )
				);
				?>
				<a href="<?php echo esc_url( $edit_link ); ?>" target="_blank" data-bs-placement="right" title="<?php echo esc_attr__( 'Edit page title section', 'litho' ); ?>" class="edit-litho-section edit-page-title litho-tooltip">
						<i class="ti-pencil"></i>
				</a>
				<?php
			}

			/**
			 * Fires to Load Custom Title Content from the Section Builder.
			 *
			 * @since 1.0
			 */
			do_action( 'theme_custom_title' );
			?>
		</section>
	<!-- end title -->
	<?php
}
