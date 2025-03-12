<?php
/**
 * Post layout 3
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
$litho_post_author_meta_array         = array();
$litho_post_layout_container          = litho_option( 'litho_post_layout_container_style', 'container' );
$litho_title_overlap_text             = litho_option( 'litho_post_layout_overlap_text', esc_html__( 'Blog', 'litho' ) );
$litho_heading_tag                    = litho_option( 'litho_heading_tag', 'h1' );
$litho_enable_post_title              = litho_option( 'litho_enable_post_title', '1' );
$litho_enable_category                = litho_option( 'litho_enable_category', '1' );
$litho_enable_author                  = litho_option( 'litho_enable_author', '1' );
$litho_enable_date                    = litho_option( 'litho_enable_date', '1' );
$litho_post_date_format               = litho_option( 'litho_post_date_format', '' );
$litho_post_format                    = get_post_format( get_the_ID() );
$litho_author_url                     = get_author_posts_url( get_the_author_meta( 'ID' ) );
$litho_author                         = get_the_author();
$litho_categories                     = get_the_category();
$litho_heading_tag                    = ( $litho_heading_tag ) ? $litho_heading_tag : 'h1';

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
?>
<div class="litho-main-layout-wrap post-layout-style-3">
	<div class="<?php echo esc_attr( $litho_post_layout_container ); ?>">
		<div class="row">
			<div class="col-12 col-lg-6 order-2 content-box">
				<div class="d-flex flex-column justify-content-center h-100">
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
			<div class="col-12 col-lg-6 order-1 align-self-end image-box">
				<?php
				// Include post format.
				if ( ! post_password_required() ) {

					if ( 'image' == $litho_post_format ) {
						?>
							<?php get_template_part( 'loop/single/loop', 'image' ); ?>
						<?php
					} elseif ( 'gallery' == $litho_post_format ) {
						?>
							<?php get_template_part( 'loop/single/loop', 'gallery' ); ?>
						<?php
					} elseif ( 'video' == $litho_post_format ) {
						?>
							<?php get_template_part( 'loop/single/loop', 'video' ); ?>
						<?php
					} elseif ( 'quote' == $litho_post_format ) {
						?>
							<?php get_template_part( 'loop/single/loop', 'quote' ); ?>
						<?php
					} elseif ( 'audio' == $litho_post_format ) {
						?>
							<?php get_template_part( 'loop/single/loop', 'audio' ); ?>
						<?php
					} else {
						?>
							<?php get_template_part( 'loop/single/loop' ); ?>
						<?php
					}
				}
				?>
			</div>
			<?php if ( $litho_title_overlap_text ) { ?>
				<div class="overlap-text alt-font"><?php echo esc_html( $litho_title_overlap_text ); ?></div>
			<?php } ?>
		</div>
	</div>
</div>
