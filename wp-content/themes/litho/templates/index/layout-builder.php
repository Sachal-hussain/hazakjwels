<?php
/**
 * The template for displaying the default/blog from section builder
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( have_posts() ) {

	while ( have_posts() ) :
		the_post();
		if ( is_sticky() && is_home() ) {
			/* Check if post thumbnail hide or show */
			$litho_show_post_thumbnail_sticky = get_theme_mod( 'litho_show_post_thumbnail_sticky', '1' );
			/* Check Image SRCSET */
			$litho_srcset_sticky = get_theme_mod( 'litho_image_srcset_sticky', 'full' );
			/* Check if title hide or show */
			$litho_show_post_title_sticky = get_theme_mod( 'litho_show_post_title_sticky', '1' );
			/* Check if author hide or show */
			$litho_show_post_author_sticky = get_theme_mod( 'litho_show_post_author_sticky', '1' );
			/* Check if author image hide or show */
			$litho_show_post_author_image_sticky = get_theme_mod( 'litho_show_post_author_image_sticky', '0' );
			/* Check if date hide or show */
			$litho_show_post_date_sticky = get_theme_mod( 'litho_show_post_date_sticky', '1' );
			/* Check date format to show */
			$litho_date_format_sticky = get_theme_mod( 'litho_date_format_sticky', '' );
			/* Check if post excerpt hide or show */
			$litho_show_excerpt_sticky = get_theme_mod( 'litho_show_excerpt_sticky', '1' );
			/* Check post excerpt length to show */
			$litho_excerpt_length_sticky = get_theme_mod( 'litho_excerpt_length_sticky', '35' );
			/* Check if post content like hide or show */
			$litho_show_content_sticky = get_theme_mod( 'litho_show_content_sticky', '1' );
			/* Check if category like hide or show */
			$litho_show_category_sticky = get_theme_mod( 'litho_show_category_sticky', '1' );

			$litho_post_terms_sticky = get_theme_mod( 'litho_post_terms_sticky', 'category' );

			/* Check if post like hide or show */
			$litho_show_like_sticky = get_theme_mod( 'litho_show_like_sticky', '1' );
			/* Check if post comment ike hide or show */
			$litho_show_comment_sticky = get_theme_mod( 'litho_show_comment_sticky', '1' );
			/* Check if button hide or show */
			$litho_show_button_sticky = get_theme_mod( 'litho_show_button_sticky', '0' );
			$litho_button_text_sticky = get_theme_mod( 'litho_button_text_sticky', esc_html__( 'Read more', 'litho' ) );
			$post_separator           = '<span class="post-meta-separator">' . esc_html__( '•', 'litho' ) . '</span>';

			$post_meta_array = array();
			if ( 1 == $litho_show_post_date_sticky ) {
				$post_meta_array[] = '<span class="post-date published">' . esc_html( get_the_date() ) . '</span><time class="updated d-none" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time>';
			}
			if ( 1 == $litho_show_category_sticky ) {
				$post_meta_array[] = '<span class="blog-category alt-font">' . litho_post_category( get_the_ID(), true, $count = '3', $litho_post_terms_sticky ) . '</span>';
			}

			$img_alt     = litho_option_image_alt( get_post_thumbnail_id() );
			$img_title   = litho_option_image_title( get_post_thumbnail_id() );
			$image_alt   = ( isset( $img_alt['alt'] ) && ! empty( $img_alt['alt'] ) ) ? $img_alt['alt'] : '';
			$image_title = ( isset( $img_title['title'] ) && ! empty( $img_title['title'] ) ) ? $img_title['title'] : '';

			$img_attr = array(
				'title' => $image_title,
				'alt'   => $image_alt,
			);
			?>
			<div class="blog-standard blog-post-sticky default-blog-post-sticky">
				<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'grid-item', 'grid-gutter' ) ); ?>>
					<div class="blog-post text-center">
						<?php if ( ! post_password_required() && 1 == $litho_show_post_thumbnail_sticky && has_post_thumbnail() ) { ?>
							<div class="blog-post-images">
								<a href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), $litho_srcset_sticky, $img_attr ); ?>
								</a>
							</div>
						<?php } ?>
						<?php if ( 1 == $litho_show_post_title_sticky || 1 == $litho_show_excerpt_sticky || 1 == $litho_show_content_sticky ) { ?>
							<div class="post-details">
								<?php if ( ! empty( $post_meta_array ) ) { ?>
									<div class="post-meta alt-font">
										<?php echo implode( $post_separator, $post_meta_array ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div>
								<?php } ?>
								<?php
								if ( 1 == $litho_show_post_title_sticky ) {
									?>
									<h6><a class="entry-title alt-font" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
								<?php } ?>
								<?php
								if ( 1 == $litho_show_excerpt_sticky ) {
									$show_excerpt_grid = ! empty( $litho_excerpt_length_sticky ) ? litho_get_the_excerpt_theme( $litho_excerpt_length_sticky ) : litho_get_the_excerpt_theme( 35 );

									if ( ! empty( $show_excerpt_grid ) ) {
										?>
										<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
										<?php
									}
								} elseif ( 1 == $litho_show_content_sticky ) {
									?>
									<div class="entry-content blog-full-content"><?php echo litho_get_the_post_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
									<?php
								}

								if ( 1 == $litho_show_button_sticky ) {
									?>
									<div class="litho-button-wrapper default-button-wrapper">
										<a href="<?php the_permalink(); ?>" class="btn litho-button-link blog-post-button" role="button">
											<span class="button-text alt-font"><?php echo esc_html( $litho_button_text_sticky ); ?></span>
										</a>
									</div>
									<?php
								}
								?>
							</div>
						<?php } ?>
						<?php if ( 1 == $litho_show_post_author_sticky || 1 == $litho_show_like_sticky || 1 == $litho_show_comment_sticky ) { ?>
							<div class="post-meta-wrapper alt-font">
								<?php
								if ( 1 == $litho_show_post_author_sticky && get_the_author() ) {
									?>
									<span class="post-author-meta">
										<?php
										if ( 1 == $litho_show_post_author_image_sticky ) {
											echo get_avatar( get_the_author_meta( 'ID' ), '30' );
										}
										?>
										<span class="author-name"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
											<i class="fa-regular fa-user blog-icon"></i><?php echo esc_html__( 'By', 'litho' ) . ' ' . esc_html( get_the_author() ); ?></a>
										</span>
									</span>
								<?php } ?>
								<?php
								if ( 1 == $litho_show_like_sticky && function_exists( 'litho_get_simple_likes_button' ) ) {
									?>
									<span class="post-meta-like">
										<?php echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</span>
								<?php } ?>
								<?php
								if ( 1 == $litho_show_comment_sticky && ( comments_open() || get_comments_number() ) ) {
									?>
									<span class="post-meta-comments">
										<?php
										echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">' . esc_html__( 'Comment', 'litho' ) . '</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">' . esc_html__( 'Comment', 'litho' ) . '</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">' . esc_html__( 'Comments', 'litho' ) . '</span>', 'comment-link' ); // phpcs:ignore
										?>
									</span>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
	endwhile;
}

/**
 * Fires to Load Archive Content from the Section Builder.
 *
 * @since 1.0
 */
do_action( 'theme_archive' );
