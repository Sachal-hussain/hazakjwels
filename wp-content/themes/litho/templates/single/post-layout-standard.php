<?php
/**
 * Post layout standard
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_post_content_container_fluid = litho_option( 'litho_post_container_style', 'container' );
$litho_post_within_content_area     = litho_option( 'litho_post_within_content_area', '0' );
$litho_post_layout_setting          = litho_option( 'litho_post_layout_setting', 'litho_layout_right_sidebar' );
$litho_enable_post_title            = litho_option( 'litho_enable_post_title', '1' );
$litho_heading_tag                  = litho_option( 'litho_heading_tag', 'h1' );
$litho_enable_category              = litho_option( 'litho_enable_category', '1' );
$litho_enable_author                = litho_option( 'litho_enable_author', '1' );
$litho_enable_date                  = litho_option( 'litho_enable_date', '1' );
$litho_post_date_format             = litho_option( 'litho_post_date_format', '' );
$litho_enable_tags                  = litho_option( 'litho_enable_tags', '1' );
$litho_enable_navigation_link       = litho_option( 'litho_enable_navigation_link', '1' );
$litho_enable_like                  = litho_option( 'litho_enable_like', '0' );
$litho_enable_share                 = litho_option( 'litho_enable_share', '1' );
$litho_enable_post_author_box       = litho_option( 'litho_enable_post_author_box', '1' );
$litho_enable_related_posts         = litho_option( 'litho_enable_related_posts', '1' );
$litho_related_posts_title          = litho_option( 'litho_related_posts_title', esc_html__( 'Related Posts', 'litho' ) );
$litho_related_posts_date_format    = litho_option( 'litho_related_posts_date_format', '' );
$litho_enable_comment               = litho_option( 'litho_enable_comment', '1' );
$post_format                        = get_post_format( get_the_ID() );
$litho_author_url                   = get_author_posts_url( get_the_author_meta( 'ID' ) );
$litho_author                       = get_the_author();
/**
 * Filter for change layout style for ex. ?sidebar=right_sidebar
 *
 * @since 1.0
 */
$litho_post_layout_setting = apply_filters( 'litho_page_layout_style', $litho_post_layout_setting );
$litho_post_layout_setting = ( ! empty( $litho_post_layout_setting ) ) ? ' ' . $litho_post_layout_setting . '_single' : '';
$litho_heading_tag         = ( $litho_heading_tag ) ? $litho_heading_tag : 'h1';
?>
<div class="<?php echo esc_attr( $litho_post_content_container_fluid ) . esc_attr( $litho_post_layout_setting ); ?>">
	<div class="row">
		<?php
		/* Get post left sidebar */
		get_template_part( 'templates/single-post', 'left' );

		$litho_single_post_meta_output = '';

		// Post meta output for all style.
		if ( 1 == $litho_enable_date ) {
			$litho_post_meta_array[] = '<li><i class="feather icon-feather-calendar text-fast-blue"></i>' . esc_html( get_the_date( $litho_post_date_format ) ) . '</li>';
		}
		if ( 1 == $litho_enable_category ) {
			ob_start();
				litho_single_post_meta_category( get_the_ID(), true );
				$litho_post_meta_array[] = ob_get_contents();
			ob_end_clean();
		}
		if ( 1 == $litho_enable_author && $litho_author ) {
			$litho_post_meta_array[] = '<li><i class="feather icon-feather-user text-fast-blue"></i><span>' . esc_html__( 'By', 'litho' ) . ' <a href="' . esc_url( $litho_author_url ) . '"> ' . esc_html( $litho_author ) . '</a></span></li>';
		}
		if ( ! empty( $litho_post_meta_array ) ) {
			$litho_single_post_meta_output .= '<ul class="litho-post-details-meta list-unstyled">';
			$litho_single_post_meta_output .= implode( '', $litho_post_meta_array );
			$litho_single_post_meta_output .= '</ul>';
		}
		if ( ! empty( $litho_single_post_meta_output ) ) {
			?>
			<div class="litho-single-post-meta vertical-align-middle">
				<?php echo sprintf( '%s', $litho_single_post_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php
		}
		if ( 1 == $litho_enable_post_title && get_the_title() ) {
			?>
			<<?php echo $litho_heading_tag;// phpcs:ignore ?> class="single-post-title alt-font">
				<?php the_title(); ?>
			</<?php echo $litho_heading_tag;// phpcs:ignore ?>>
			<?php
		}
		// Include Post Format Data.
		if ( ! post_password_required() ) {
			if ( 'image' == $post_format ) {
				?>
					<?php get_template_part( 'loop/single/loop', 'image' ); ?>
				<?php
			} elseif ( 'gallery' == $post_format ) {
				?>
					<div class="col-sm-12">
						<?php get_template_part( 'loop/single/loop', 'gallery' ); ?>
					</div>
				<?php
			} elseif ( 'video' == $post_format ) {
				?>
					<div class="col-sm-12">
						<?php get_template_part( 'loop/single/loop', 'video' ); ?>
					</div>
				<?php
			} elseif ( 'quote' == $post_format ) {
				?>
					<div class="col-sm-12">
						<?php get_template_part( 'loop/single/loop', 'quote' ); ?>
					</div>
				<?php
			} elseif ( 'audio' == $post_format ) {
				?>
					<div class="col-sm-12">
						<?php get_template_part( 'loop/single/loop', 'audio' ); ?>
					</div>
				<?php
			} else {
				?>
					<?php get_template_part( 'loop/single/loop' ); ?>
				<?php
			}
		}
		?>
		<!-- Show Post Content -->
		<div class="col-sm-12 blog-details-text entry-content"><?php the_content(); ?></div>
		<?php
		if ( 1 == $litho_post_within_content_area ) {
			get_template_part( 'templates/single/post-bottom/content-bottom' );
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
		?>
		<?php get_template_part( 'templates/single-post', 'right' ); /* Get post right sidebar */ ?>
	</div>
</div>
