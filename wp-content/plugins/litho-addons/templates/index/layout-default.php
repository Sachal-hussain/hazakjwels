<?php
/**
 * The template for displaying the default/blog default archive
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( have_posts() ) :

	$litho_no_of_posts_columns_default     = get_theme_mod( 'litho_no_of_posts_columns_default', '2' );
	$litho_post_enable_thumbnail_default   = get_theme_mod( 'litho_post_enable_thumbnail_default', '1' );
	$litho_post_feature_image_size_default = get_theme_mod( 'litho_post_feature_image_size_default', 'full' );
	$litho_post_enable_title_default       = get_theme_mod( 'litho_post_enable_title_default', '1' );
	$litho_post_enable_author_default      = get_theme_mod( 'litho_post_enable_author_default', '1' );
	$litho_post_enable_comment_default     = get_theme_mod( 'litho_post_enable_comment_default', '1' );
	$litho_post_enable_date_default        = get_theme_mod( 'litho_post_enable_date_default', '1' );
	$litho_post_date_format_default        = get_theme_mod( 'litho_post_date_format_default', '' );
	$litho_post_enable_excerpt_default     = get_theme_mod( 'litho_post_enable_excerpt_default', '1' );
	$litho_post_excerpt_length_default     = get_theme_mod( 'litho_post_excerpt_length_default', '15' );
	$litho_post_enable_read_more_default   = get_theme_mod( 'litho_post_enable_read_more_default', '1' );
	$litho_post_read_more_text_default     = get_theme_mod( 'litho_post_read_more_text_default', esc_html__( 'Read more', 'litho-addons' ) );
	$litho_post_enable_category_default    = get_theme_mod( 'litho_post_enable_category_default', '1' );
	$litho_post_terms_default              = get_theme_mod( 'litho_post_terms_default', 'category' );
	$litho_post_enable_pagination_default  = get_theme_mod( 'litho_post_enable_pagination_default', '1' );

	$column_class = '';
	switch ( $litho_no_of_posts_columns_default ) {
		case '1':
			$column_class .= 'row-cols-1 ';
			break;
		case '2':
			$column_class .= 'row-cols-1 row-cols-sm-2 ';
			break;
		case '4':
			$column_class .= 'row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 ';
			break;
		case '5':
			$column_class .= 'row-cols-1 row-cols-xl-5 row-cols-lg-3 row-cols-sm-2 ';
			break;
		case '6':
			$column_class .= 'row-cols-1 row-cols-xl-6 row-cols-lg-3 row-cols-sm-2 ';
			break;
		case '3':
		default:
			$column_class .= 'row-cols-1 row-cols-lg-3 row-cols-sm-2 ';
			break;
	}
	?>
	<ul class="<?php echo esc_attr( $column_class ); ?>row grid blog-grid grid-masonry list-unstyled default-blog-grid">
		<li class="grid-sizer d-none p-0 m-0"></li>
		<?php
		while ( have_posts() ) :
			the_post();
			if ( ! is_sticky() ) {
				?>
				<li id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'grid-item grid-gutter' ); ?>>
					<div class="blog-post">
						<?php
						if ( ! post_password_required() && has_post_thumbnail() && 1 == $litho_post_enable_thumbnail_default ) {
							?>
							<div class="blog-post-images">
								<a href="<?php the_permalink(); ?>">
									<?php
									/* Image Alt, Title, Caption */
									$litho_img_alt     = litho_option_image_alt( get_post_thumbnail_id() );
									$litho_img_title   = litho_option_image_title( get_post_thumbnail_id() );
									$litho_image_alt   = ( isset( $litho_img_alt['alt'] ) && ! empty( $litho_img_alt['alt'] ) ) ? $litho_img_alt['alt'] : '';
									$litho_image_title = ( isset( $litho_img_title['title'] ) && ! empty( $litho_img_title['title'] ) ) ? $litho_img_title['title'] : '';

									$litho_img_attr = array(
										'title' => $litho_image_title,
										'alt'   => $litho_image_alt,
									);
									echo get_the_post_thumbnail( get_the_ID(), $litho_post_feature_image_size_default, $litho_img_attr ); // phpcs:ignore
									?>
								</a>
								<?php if ( 1 == $litho_post_enable_category_default && has_post_thumbnail() && 1 == $litho_post_enable_thumbnail_default ) { ?>
									<span class="blog-category alt-font">
										<?php echo litho_post_category( get_the_ID(), true, '1', $litho_post_terms_default ); // phpcs:ignore ?>
									</span>
								<?php } ?>
							</div>
							<?php
						}
						?>
						<?php if ( 1 == $litho_post_enable_author_default || 1 == $litho_post_enable_comment_default || 1 == $litho_post_enable_date_default || 1 == $litho_post_enable_title_default || 1 == $litho_post_enable_excerpt_default || 1 == $litho_post_enable_read_more_default ) { ?>
							<div class="post-details">
								<?php if ( 1 == $litho_post_enable_date_default ) { ?>
									<span class="post-date published"><?php echo esc_html( get_the_date( $litho_post_date_format_default, get_the_ID() ) ); ?></span><time class="updated d-none" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( $litho_post_date_format_default ) ); ?></time>
								<?php } ?>
								<?php if ( 1 == $litho_post_enable_title_default ) { ?>
									<a href="<?php the_permalink(); ?>" class="entry-title alt-font"><?php the_title(); ?></a>
								<?php } ?>
								<?php
								if ( 1 == $litho_post_enable_excerpt_default ) {
									$show_excerpt_grid = ! empty( $litho_post_excerpt_length_default ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length_default ) : litho_get_the_excerpt_theme( 15 );
									if ( $show_excerpt_grid ) {
										?>
										<div class="entry-content">
											<?php
											echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) );
											?>
										</div>
										<?php
									}
								}
								?>
								<?php if ( 1 == $litho_post_enable_read_more_default ) { ?>
									<div class="blog-post-meta-wrapper d-flex align-items-center">
										<div class="litho-button-wrapper default-button-wrapper">
											<a href="<?php the_permalink(); ?>" class="btn litho-button-link blog-post-button" role="button">
												<span class="button-text alt-font"><?php echo esc_html( $litho_post_read_more_text_default ); ?></span>
											</a>
										</div>
									</div>
								<?php } ?>
								<div class="horizontal-separator"></div>
								<?php if ( 1 == $litho_post_enable_author_default || 1 == $litho_post_enable_comment_default ) { ?>
									<div class="d-flex align-items-center post-meta ">
										<?php if ( 1 == $litho_post_enable_author_default ) { ?>
											<span class="post-author-meta alt-font">
												<span class="author-name">
													<?php
													esc_html_e( 'By&nbsp;', 'litho-addons' );
													?>
													<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php
														echo esc_html( get_the_author() ); ?></a>
												</span>
											</span>
										<?php } ?>
										<?php
										if ( 1 == $litho_post_enable_comment_default && ( comments_open() || get_comments_number() ) ) {
											?>
											<span class="post-meta-comments">
												<?php
												echo comments_popup_link( '<i class="far fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">' . esc_html__( 'Comment', 'litho-addons' ) . '</span>', '<i class="far fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">' . esc_html__( 'Comment', 'litho-addons' ) . '</span>', '<i class="far fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">' . esc_html__( 'Comments', 'litho-addons' ) . '</span>', 'comment-link' );
												?>
											</span>
											<?php
										}
										?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</li>
				<?php
			}
		endwhile;
		?>
	</ul>
	<?php
	if ( 1 == $litho_post_enable_pagination_default ) :
		litho_get_pagination(); // phpcs:ignore
	endif;
else :
	if ( file_exists( LITHO_ADDONS_ROOT . '/templates/content-none.php' ) ) {
		include LITHO_ADDONS_ROOT . '/templates/content-none.php';
	}
endif;
