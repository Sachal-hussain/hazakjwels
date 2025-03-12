<?php
/**
 * Post layout 4
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
$litho_blog_image                     = litho_option( 'litho_featured_image', '1' );
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
	$count             = 0;
	$litho_cat_output .= '<ul class="alt-font">';
	foreach ( $litho_categories as $category ) {
		if ( 1 === $count ) {
			break;
		}
		$litho_cat_output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
		$count++;
	}
	$litho_cat_output .= '</ul>';
}

$litho_background_image_url = ( has_post_thumbnail() && 1 == $litho_blog_image ) ? ' style="background-image: url(' . esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) . ');"' : '';
?>
<section class="litho-main-layout-wrap cover-background post-layout-style-4"<?php echo sprintf( '%s', $litho_background_image_url ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="<?php echo esc_attr( $litho_post_layout_container ); ?>">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-6 offset-xl-1 col-md-6 d-flex justify-content-center flex-column">
				<!-- start post categories meta -->
				<?php if ( 1 == $litho_enable_category || 1 == $litho_enable_date ) { ?>
					<div class="litho-single-post-categories alt-font">
						<?php echo sprintf( '%s', $litho_cat_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php if ( 1 == $litho_enable_date ) { ?>
							<span><?php echo ( 1 == $litho_enable_author ) ? esc_html__( 'On&nbsp;', 'litho' ) : ''; ?></span>
							<div class="post-date"><?php echo esc_html( get_the_date( $litho_post_date_format ) ); ?></div>
						<?php } ?>
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
			</div>
			<?php if ( 1 == $litho_enable_author && $litho_author ) { ?>
				<!-- start separator -->
				<div class="col-12 col-md-3 d-md-flex justify-content-center flex-column page-title-separator d-none">
					<span class="separator-line w-100 d-inline-block"></span>
				</div>
					<!-- end separator -->
				<!-- start author meta -->
				<div class="col-12 col-xl-2 col-md-3 d-flex justify-content-center flex-column">
					<div class="litho-single-post-author alt-font">
						<?php echo esc_html__( 'By', 'litho' ); ?> <a href="<?php echo esc_url( $litho_author_url ); ?>"><?php echo esc_html( $litho_author ); ?></a>
					</div>
				</div>
			<?php } ?>
			<!-- end author meta -->
		</div>
	</div>
</section>
