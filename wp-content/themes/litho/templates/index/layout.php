<?php
/**
 * The template for displaying the default/blog part
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Page main class */
$class                      = '';
$litho_post_container_style = get_theme_mod( 'litho_post_container_style_default', 'container' );
$litho_post_layout_setting  = get_theme_mod( 'litho_post_layout_setting_default', 'litho_layout_right_sidebar' );

/**
 * Filter for change layout style for ex. ?sidebar=right_sidebar
 *
 * @since 1.0
 */
$litho_post_layout_setting       = apply_filters( 'litho_page_layout_style', $litho_post_layout_setting );
$litho_main_wrapper_tag          = ( 'litho_layout_no_sidebar' === $litho_post_layout_setting ) ? 'div' : 'section';
$litho_post_layout_setting_class = ( ! empty( $litho_post_layout_setting ) ) ? ' ' . $litho_post_layout_setting . '_single' : '';

if ( ! is_litho_addons_activated() ) {
	$class .= ' default-blog-main-section default-top-space-main-section';
}

echo '<' . $litho_main_wrapper_tag . ' class="litho-default-main-section litho-main-inner-content-wrap' . $class . '">'; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>
	<div class="<?php echo esc_attr( $litho_post_container_style ) . esc_attr( $litho_post_layout_setting_class ); ?>">
		<div class="row">
			<?php
				/* Get page left part template */
				get_template_part( 'templates/default', 'left' );
			?>
			<div class="entry-content entry-content-inner">

				<?php
				if ( is_litho_addons_activated() && is_elementor_activated() ) {

					get_template_part( 'templates/index/layout', 'builder' );

				} else {

					get_template_part( 'templates/index/layout', 'default' );
				}
				?>
			</div>
			<?php
				/* Get page right part template */
				get_template_part( 'templates/default', 'right' );
			?>
		</div>
	</div>
	<?php
echo '</' . $litho_main_wrapper_tag . '>'; // @codingStandardsIgnoreLine
