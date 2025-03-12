<?php
/**
 * Post content
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
$litho_enable_tags                  = litho_option( 'litho_enable_tags', '1' );
$litho_enable_navigation_link       = litho_option( 'litho_enable_navigation_link', '1' );
$litho_enable_like                  = litho_option( 'litho_enable_like', '0' );
$litho_enable_share                 = litho_option( 'litho_enable_share', '1' );
$litho_enable_post_author_box       = litho_option( 'litho_enable_post_author_box', '1' );

/**
 * Filter for change layout style for ex. ?sidebar=right_sidebar
 *
 * @since 1.0
 */
$litho_post_layout_setting = apply_filters( 'litho_page_layout_style', $litho_post_layout_setting ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
$litho_post_layout_setting = ( ! empty( $litho_post_layout_setting ) ) ? ' ' . $litho_post_layout_setting . '_single' : '';
?>
<div class="<?php echo esc_attr( $litho_post_content_container_fluid ) . esc_attr( $litho_post_layout_setting ); ?>">
	<div class="row">
		<?php
		/* Get post left sidebar */
		get_template_part( 'templates/single-post', 'left' );
		?>
		<!-- Show Post Content -->
		<div class="col-sm-12 blog-details-text entry-content"><?php the_content(); ?></div>
		<?php
		if ( 1 == $litho_post_within_content_area ) {
			get_template_part( 'templates/single/post-bottom/content-bottom' );
		}
		?>
		<?php get_template_part( 'templates/single-post', 'right' ); /* Get post right sidebar */ ?>
	</div>
</div>
