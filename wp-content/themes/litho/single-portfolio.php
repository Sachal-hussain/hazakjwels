<?php
/**
 * The template for displaying all single portfolio
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Start of the loop.
while ( have_posts() ) :
	the_post();
	/* Portfolio main class */
	$class = 'single-portfolio-main-section';
	/* Feature Image */
	$litho_portfolio_featured_image      = litho_option( 'litho_portfolio_featured_image', '0' );
	$litho_portfolio_container_style     = litho_option( 'litho_portfolio_container_style', 'container' );
	$litho_portfolio_layout_setting      = litho_option( 'litho_portfolio_layout_setting', 'litho_layout_no_sidebar' );
	$litho_portfolio_within_content_area = litho_option( 'litho_portfolio_within_content_area', '0' );
	$litho_portfolio_rich_snippet        = litho_option( 'litho_portfolio_rich_snippet', '1' );

	/* Portfolio Navigation */
	$litho_hide_navigation_single_portfolio = litho_option( 'litho_hide_navigation_single_portfolio', '1' );
	/**
	 * Filter for change layout style for ex. ?sidebar=right_sidebar
	 *
	 * @since 1.0
	 */
	$litho_portfolio_layout_setting       = apply_filters( 'litho_page_layout_style', $litho_portfolio_layout_setting );
	$litho_portfolio_layout_setting_class = ( ! empty( $litho_portfolio_layout_setting ) ) ? ' ' . $litho_portfolio_layout_setting . '_single' : ''; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	$litho_author_url                     = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$class                               .= ( 1 == $litho_portfolio_within_content_area ) ? ' within-content-area' : '';

	if ( litho_elementor_edit_mode() ) {
		$class .= ' default-top-space-main-section';
	}

	/* Get post class and id */
	$litho_portfolio_classes = '';
	ob_start();
		post_class( $class );
		$litho_portfolio_classes .= ob_get_contents();
	ob_end_clean();

	echo '<div id="post-' . esc_attr( get_the_ID() ) . '" ' . $litho_portfolio_classes . '>'; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
		<div class="<?php echo esc_attr( $litho_portfolio_container_style ) . esc_attr( $litho_portfolio_layout_setting_class ); ?>">
			<div class="row">
				<?php
				/* Get page left part template */
				get_template_part( 'templates/single-portfolio', 'left' );

				// Include Post Format Data.
				if ( ! post_password_required() && has_post_thumbnail() && 1 == $litho_portfolio_featured_image ) {

					/* Image Alt, Title, Caption */
					$thumbnail_id      = get_post_thumbnail_id();
					$litho_img_alt     = ! empty( $thumbnail_id ) ? litho_option_image_alt( $thumbnail_id ) : array();
					$litho_img_title   = ! empty( $thumbnail_id ) ? litho_option_image_title( $thumbnail_id ) : array();
					$litho_image_alt   = ( isset( $litho_img_alt['alt'] ) && ! empty( $litho_img_alt['alt'] ) ) ? $litho_img_alt['alt'] : '';
					$litho_image_title = ( isset( $litho_img_title['title'] ) && ! empty( $litho_img_title['title'] ) ) ? $litho_img_title['title'] : '';

					$litho_img_attr = array(
						'title' => $litho_image_title,
						'alt'   => $litho_image_alt,
					);
					?>
					<div class="default-portfolio-image text-center">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'full', $litho_img_attr ); ?>
					</div>
					<?php
				}

				if ( 1 == $litho_portfolio_rich_snippet ) {
					?>
					<div class="litho-rich-snippet d-none">
						<span class="entry-title">
							<?php echo esc_html( get_the_title() ); ?>
						</span>
						<span class="author vcard">
							<a class="url fn n" href="<?php echo esc_url( $litho_author_url ); ?>">
								<?php echo esc_html( get_the_author() ); ?>
							</a>
						</span>
						<span class="published">
							<?php echo esc_html( get_the_date() ); ?>
						</span>
						<time class="updated" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_modified_date() ); ?>
						</time>
					</div>
					<?php
				}
				?>
				<div class="entry-content entry-content-inner">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
				<?php
				if ( 1 == $litho_portfolio_within_content_area ) {
					get_template_part( 'templates/single-portfolio/content', 'bottom' );
				}
				/* Get page right part template */
				get_template_part( 'templates/single-portfolio', 'right' );
				?>
			</div>
		</div>
	</div>
	<?php
	if ( 0 == $litho_portfolio_within_content_area ) {
		get_template_part( 'templates/single-portfolio/content', 'bottom' );
	}
	// If Is Set Get Post Portfolio Navigation.
	if ( 1 == $litho_hide_navigation_single_portfolio ) {
		litho_single_portfolio_navigation();
	}
endwhile;
// End of the loop.

get_footer();
