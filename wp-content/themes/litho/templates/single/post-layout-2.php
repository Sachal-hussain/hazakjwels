<?php
/**
 * Post layout 2
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
$litho_post_layout_bg_image           = litho_option( 'litho_post_layout_bg_image', '' );
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

$litho_background_image_url = ( ! empty( $litho_post_layout_bg_image ) ) ? ' style="background-image: url(' . esc_url( $litho_post_layout_bg_image ) . ');"' : '';
?>
<section class="litho-main-layout-wrap cover-background post-layout-style-2"<?php echo sprintf( '%s', $litho_background_image_url ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="<?php echo esc_attr( $litho_post_layout_container ); ?>">
		<div class="row justify-content-center">
			<div class="col-12 col-xl-6 col-lg-7 col-sm-8 text-center">
				<!-- start post categories meta -->
				<?php if ( 1 == $litho_enable_category ) { ?>
					<div class="litho-single-post-categories alt-font">
						<?php echo sprintf( '%s', $litho_cat_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>
				<!-- end post categories meta -->
				<!-- start post date -->
				<?php if ( 1 == $litho_enable_date ) { ?>
					<span class="litho-single-post-date alt-font"><?php echo esc_html( get_the_date( $litho_post_date_format ) ); ?></span>
				<?php } ?>
				<!-- end post date -->
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
				<?php if ( 1 == $litho_enable_author && $litho_author ) { ?>
					<span class="litho-single-post-author alt-font">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), '30' ); ?>
						<span><?php echo esc_html__( 'By', 'litho' ); ?> <a href="<?php echo esc_url( $litho_author_url ); ?>"><?php echo esc_html( $litho_author ); ?></a></span>
					</span>
				<?php } ?>
				<!-- end author meta -->
			</div>
		</div>
	</div>
</section>
