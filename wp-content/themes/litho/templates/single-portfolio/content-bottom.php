<?php
/**
 * Content bottom portfolio
 *
 * @package Litho
 */

/* Portfolio Share */
$litho_hide_single_portfolio_share = litho_option( 'litho_hide_single_portfolio_share', '1' );
/* Portfolio Share Heading */
$litho_hide_single_portfolio_share_heading = litho_option( 'litho_single_portfolio_share_title', esc_html__( 'Share this project', 'litho' ) );
/* Check if page comment is show / hide */
$litho_hide_single_portfolio_comment = litho_option( 'litho_hide_single_portfolio_comment', '0' );
/* Related Portfolio */
$litho_hide_related_single_portfolio = litho_option( 'litho_hide_related_single_portfolio', '1' );
/* Portfolio Category */
$litho_portfolio_enable_category = litho_option( 'litho_portfolio_enable_category', '0' );
/* Portfolio Tag */
$litho_portfolio_enable_tag = litho_option( 'litho_portfolio_enable_tag', '0' );

if ( 1 == $litho_hide_single_portfolio_share && function_exists( 'litho_single_portfolio_share_shortcode' ) ) {
	?>
	<div class="portfolio-share-wrapper">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 text-center alt-font">
					<?php
					if ( ! empty( $litho_hide_single_portfolio_share_heading ) ) {
						?>
						<span class="alt-font share-heading"><?php echo esc_html( $litho_hide_single_portfolio_share_heading ); ?></span>
						<?php
					}
					echo do_shortcode( '[litho_single_portfolio_share]' );
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
// If Is Set Get Related Portfolio.
if ( 1 == $litho_hide_related_single_portfolio ) {
	litho_related_portfolio( get_the_ID() );
}
if ( 1 == $litho_hide_single_portfolio_comment && ( comments_open() || get_comments_number() ) ) { // If comments are open or we have at least one comment, load up the comment template.
	comments_template();
}
// If Is Set Get Post Portfolio Category.
if ( 1 == $litho_portfolio_enable_category || 1 == $litho_portfolio_enable_tag ) {
	$portfolio_categories_list = get_the_terms( get_the_ID(), 'portfolio-category' );
	$portfolio_tags_list       = get_the_terms( get_the_ID(), 'portfolio-tags' );
	if ( ! empty( $portfolio_categories_list ) || ! empty( $portfolio_tags_list ) ) {
		?>
		<div class="porfolio-categories-lists">
			<div class="container">
				<div class="row">
					<div class="col-md-6 posted_in text-center text-md-start">
						<?php
						if ( 1 == $litho_portfolio_enable_category && ! empty( $portfolio_categories_list ) && ! is_wp_error( $portfolio_categories_list ) ) {
							echo esc_html__( 'Categories:&nbsp;', 'litho' );
							foreach ( $portfolio_categories_list as $key => $portfolio_category ) {
								$portfolio_category_link = get_term_link( $portfolio_category->term_id, $portfolio_category->taxonomy );
								if ( ! empty( $portfolio_category_link ) ) {
									echo '<a href="' . esc_url( $portfolio_category_link ) . '" rel="category tag">' . esc_html( $portfolio_category->name ) . '</a>';
								}
							}
						}
						?>
					</div>
					<div class="col-md-6 text-center text-md-end tagcloud">
						<?php
						if ( 1 == $litho_portfolio_enable_tag && ! empty( $portfolio_tags_list ) && ! is_wp_error( $portfolio_tags_list ) ) {
							foreach ( $portfolio_tags_list as $key => $portfolio_tag ) {
								$portfolio_tag_link = get_term_link( $portfolio_tag->term_id, $portfolio_tag->taxonomy );
								if ( ! empty( $portfolio_tag_link ) ) {
									echo '<a href="' . esc_url( $portfolio_tag_link ) . '" rel="category tag">' . esc_html( $portfolio_tag->name ) . '</a>';
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
