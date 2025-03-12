<?php
/**
 * The template for displaying all pages
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/* Start of the loop. */
while ( have_posts() ) :
	the_post();
	/* Page main class */
	$class = 'litho-page-main-section';
	/* Check if page comment is show / hide */
	$litho_hide_page_comment         = litho_option( 'litho_hide_page_comment', '1' );
	$litho_page_container_style      = litho_option( 'litho_page_container_style', 'container' );
	$litho_page_within_content_area  = litho_option( 'litho_page_within_content_area', '0' );
	$litho_page_layout_setting       = litho_option( 'litho_page_layout_setting', 'litho_layout_no_sidebar' );
	$litho_page_right_sidebar        = litho_option( 'litho_page_right_sidebar', '' );
	$litho_page_left_sidebar         = litho_option( 'litho_page_left_sidebar', '' );
	$litho_page_rich_snippet         = litho_option( 'litho_page_rich_snippet', '1' );

	/**
	 * Filter for change layout style for ex. ?sidebar=right_sidebar
	 *
	 * @since 1.0
	 */
	$litho_page_layout_setting       = apply_filters( 'litho_page_layout_style', $litho_page_layout_setting );
	$litho_main_wrapper_tag          = ( 'litho_layout_no_sidebar' === $litho_page_layout_setting ) ? 'div' : 'section';
	$litho_page_layout_setting_class = ( ! empty( $litho_page_layout_setting ) ) ? ' ' . $litho_page_layout_setting . '_single' : '';
	$litho_author_url                = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$class                          .= ( 1 == $litho_page_within_content_area ) ? ' within-content-area' : '';

	if ( ! is_litho_addons_activated() ) {
		$class .= ' default-page-main-section';
	}

	/* Get post class and id */
	$litho_page_classes = '';
	ob_start();
		post_class( $class );
		$litho_page_classes .= ob_get_contents();
	ob_end_clean();

	echo '<' . $litho_main_wrapper_tag . ' id="post-' . esc_attr( get_the_ID() ) . '" ' . $litho_page_classes . '>'; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
	<div class="<?php echo esc_attr( $litho_page_container_style ) . esc_attr( $litho_page_layout_setting_class ); ?>">
		<div class="row">
			<?php
			/* Get page left part template */
			get_template_part( 'templates/single-page', 'left' );

			if ( 1 == $litho_page_rich_snippet ) {
				?>
				<div class="litho-rich-snippet d-none">
					<span class="entry-title">
					<?php
						echo esc_html( get_the_title() );
					?>
					</span>
					<span class="author vcard">
						<a class="url fn n" href="<?php echo esc_url( $litho_author_url ); ?>">
							<?php echo esc_html( get_the_author() ); ?>
						</a>
					</span>
					<span class="published">
					<?php
						echo esc_html( get_the_date() );
					?>
					</span>
					<time class="updated" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
					<?php
						echo esc_html( get_the_modified_date() );
					?>
					</time>
				</div>
				<?php
			}
			?>
			<div class="entry-content entry-content-inner"><?php the_content(); ?></div>
			<?php
			if ( 1 == $litho_hide_page_comment && 1 == $litho_page_within_content_area && ( comments_open() || get_comments_number() ) ) {
				comments_template();
			}
			/* Displays page-links for paginated pages. */
			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><div class="inner-page-links"><span class="pagination-title">' . esc_html__( 'Pages:', 'litho' ) . '</span>',
					'after'       => '</div></div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			);
			/* Get page right part template */
			get_template_part( 'templates/single-page', 'right' );
			?>
		</div>
	</div>
	<?php
	echo '</' . $litho_main_wrapper_tag . '>'; // @codingStandardsIgnoreLine

	if ( 1 == $litho_hide_page_comment && 0 == $litho_page_within_content_area && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
endwhile;// End of the loop.

get_footer();
