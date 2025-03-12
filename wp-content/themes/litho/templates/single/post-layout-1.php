<?php
/**
 * Post layout 1
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_post_layout_container          = '';
$litho_cat_output                     = '';
$litho_single_post_author_meta_output = '';
$litho_gallery                        = '';
$litho_post_author_meta_array         = array();
$litho_post_layout_container          = litho_option( 'litho_post_layout_container_style', 'container' );
$litho_heading_tag                    = litho_option( 'litho_heading_tag', 'h1' );
$litho_enable_post_title              = litho_option( 'litho_enable_post_title', '1' );
$litho_enable_category                = litho_option( 'litho_enable_category', '1' );
$litho_enable_author                  = litho_option( 'litho_enable_author', '1' );
$litho_enable_date                    = litho_option( 'litho_enable_date', '1' );
$litho_post_date_format               = litho_option( 'litho_post_date_format', '' );
$litho_blog_image                     = litho_option( 'litho_featured_image', '1' );
$litho_enable_gallery                 = litho_post_meta( 'litho_lightbox_image' );
$litho_blog_gallery                   = litho_post_meta( 'litho_gallery' );
$litho_post_format                    = get_post_format( get_the_ID() );
$litho_author_url                     = get_author_posts_url( get_the_author_meta( 'ID' ) );
$litho_author                         = get_the_author();
$litho_categories                     = get_the_category();
$litho_heading_tag                    = ( $litho_heading_tag ) ? $litho_heading_tag : 'h1';

if ( ! empty( $litho_blog_gallery ) ) {
	$litho_gallery = explode( ',', $litho_blog_gallery );
}

$litho_popup_id = 'blog-' . get_the_ID();

if ( ! empty( $litho_categories ) ) {
	$litho_cat_output .= '<ul class="alt-font">';
	foreach ( $litho_categories as $category ) {
		$litho_cat_output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
	}
	$litho_cat_output .= '</ul>';
}

if ( 1 == $litho_enable_author && $litho_author ) {
	$litho_post_author_meta_array[] = '<span>' . esc_html__( 'By', 'litho' ) . ' <a href="' . esc_url( $litho_author_url ) . '"> ' . esc_html( $litho_author ) . '</a></span>';
}
if ( 1 == $litho_enable_date ) {
	$litho_post_author_meta_array[] = '<span> ' . ( 1 == $litho_enable_author ? __( 'On&nbsp;', 'litho' ) : '' ) . esc_html( get_the_date( $litho_post_date_format ) ) . '</span>';
}

if ( is_array( $litho_post_author_meta_array ) && count( $litho_post_author_meta_array ) != 0 ) {
	$litho_single_post_author_meta_output .= implode( '', $litho_post_author_meta_array );
}

$litho_background_image_url = ( has_post_thumbnail() && 1 == $litho_blog_image ) ? ' style="background-image: url(' . esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) . ');"' : '';
?>
<section class="litho-main-layout-wrap post-layout-style-1">
	<div class="one-third-screen cover-background"<?php echo sprintf( '%s', $litho_background_image_url ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>></div>
	<div class="<?php echo esc_attr( $litho_post_layout_container ); ?>">
		<div class="row align-items-end justify-content-center h-100">
			<div class="col-12 col-lg-10 overlap-section tilt-box text-center">
				<span class="page-title-separator"></span>
				<!-- start post categories meta -->
				<?php if ( 1 == $litho_enable_category ) { ?>
					<div class="litho-single-post-categories alt-font">
						<?php echo sprintf( '%s', $litho_cat_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>
				<!-- end post categories meta -->
				<?php
				if ( 1 == $litho_enable_post_title ) {
					?>
					<!-- start page title -->
					<<?php echo $litho_heading_tag;// phpcs:ignore ?> class="litho-main-title alt-font">
						<?php echo sprintf( '%s', get_the_title() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</<?php echo $litho_heading_tag;// phpcs:ignore ?>>
					<!-- end page title -->
					<?php
				}
				?>
				<!-- start author meta -->
				<?php if ( 1 == $litho_enable_author || 1 == $litho_enable_date ) { ?>
					<div class="litho-single-post-author alt-font">
						<?php echo sprintf( '%s', $litho_single_post_author_meta_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>
				<!-- end author meta -->
			</div>
		</div>
	</div>
</section>
