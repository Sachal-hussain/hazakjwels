<?php
/**
 * The template for displaying the portfolio archive part
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Page main class */
$class                             = ' default-top-space-main-section';
$litho_portfolio_container_style   = get_theme_mod( 'litho_portfolio_container_style_archive', 'container' );
$litho_portfolio_layout_setting    = get_theme_mod( 'litho_portfolio_layout_setting_archive', 'litho_layout_no_sidebar' );
$litho_portfolio_top_space_archive = get_theme_mod( 'litho_portfolio_top_space_archive', '0' );
$litho_show_archive_description    = get_theme_mod( 'litho_show_portfolio_archive_description_archive', '0' );
/**
 * Filter for change layout style for ex. ?sidebar=right_sidebar
 *
 * @since 1.0
 */
$litho_portfolio_layout_setting       = apply_filters( 'litho_page_layout_style', $litho_portfolio_layout_setting );
$litho_main_wrapper_tag               = ( 'litho_layout_no_sidebar' === $litho_portfolio_layout_setting ) ? 'div' : 'section';
$litho_portfolio_layout_setting_class = ( ! empty( $litho_portfolio_layout_setting ) ) ? ' ' . $litho_portfolio_layout_setting . '_single' : '';

if ( ! is_litho_addons_activated() && 1 == $litho_portfolio_top_space_archive ) {
	$class = ' top-space';
}

if ( 1 == $litho_show_archive_description && get_the_archive_description() ) {
	?>
	<section class="archive-description post-portfolio-description no-padding-bottom">
		<div class="<?php echo esc_attr( $litho_portfolio_container_style ); ?>">
			<div class="row">
				<div class="col-12 text-center">
					<?php the_archive_description(); ?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

echo '<' . $litho_main_wrapper_tag . ' class="litho-portfolio-main-section litho-main-inner-content-wrap' . $class . '">'; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>
	<div class="<?php echo esc_attr( $litho_portfolio_container_style ) . esc_attr( $litho_portfolio_layout_setting_class ); ?>">
		<div class="row">
			<?php
				/* Get page left part template */
				get_template_part( 'templates/portfolio-archive', 'left' );
			?>
			<div class="entry-content entry-content-inner">
				<?php
				if ( is_litho_addons_activated() && is_elementor_activated() ) {

					get_template_part( 'templates/portfolio-archive/layout', 'builder' );

				} else {
					get_template_part( 'templates/portfolio-archive/layout', 'default' );
				}
				?>
			</div>
			<?php
			/* Get page right part template */
			get_template_part( 'templates/portfolio-archive', 'right' );
			?>
		</div>
	</div>
	<?php
echo '</' . $litho_main_wrapper_tag . '>'; // @codingStandardsIgnoreLine
