<?php
/**
 * Post content bottom
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tags_list                      = '';
$litho_single_post_navigation   = '';
$litho_related_posts            = '';
$litho_post_within_content_area = litho_option( 'litho_post_within_content_area', '0' );
$litho_enable_related_posts     = litho_option( 'litho_enable_related_posts', '1' );
$litho_enable_comment           = litho_option( 'litho_enable_comment', '1' );
$litho_enable_tags              = litho_option( 'litho_enable_tags', '1' );
$litho_enable_navigation_link   = litho_option( 'litho_enable_navigation_link', '1' );
$litho_enable_like              = litho_option( 'litho_enable_like', '0' );
$litho_enable_share             = litho_option( 'litho_enable_share', '1' );
$litho_enable_post_author_box   = litho_option( 'litho_enable_post_author_box', '1' );

if ( 'post' === get_post_type() ) {
	$tags_list = get_the_tag_list();
}

if ( function_exists( 'litho_single_post_navigation' ) ) {
	$litho_single_post_navigation = litho_single_post_navigation(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

if ( ( 1 == $litho_enable_post_author_box && (bool) get_the_author_meta( 'description' ) ) || ( 1 == $litho_enable_tags && $tags_list ) || ( 1 == $litho_enable_navigation_link && $litho_single_post_navigation ) || ( 1 == $litho_enable_like && function_exists( 'litho_get_simple_likes_button' ) ) || ( 1 == $litho_enable_share && function_exists( 'litho_single_post_share_shortcode' ) ) ) {
	$wrapper_tag = ( 1 == $litho_post_within_content_area ) ? 'div' : 'section';
	?>
	<<?php echo $wrapper_tag; ?> class="tag-like-social-wrapper"><?php // phpcs:ignore ?>
		<div class="container">
			<div class="row">
				<?php
				if ( 1 == $litho_enable_navigation_link && ! empty( $litho_single_post_navigation ) ) {
					?>
						<div class="col-12 single-post-navigation">
							<?php echo sprintf( '%s', $litho_single_post_navigation ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php
				}
				?>
				<div class="col-12 col-md-9 text-center text-md-start tagcloud">
					<?php
					if ( 1 == $litho_enable_tags ) {
						echo sprintf( '%s', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
				<div class="col-12 col-md-3 text-center text-md-end litho-blog-detail-like">
					<?php
					if ( 1 == $litho_enable_like && function_exists( 'litho_get_simple_likes_button' ) ) {
						?>
						<ul class="extra-small-icon">
							<li><?php echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
						</ul>
					<?php } ?>
				</div>
			</div>
			<?php if ( 1 == $litho_enable_post_author_box && (bool) get_the_author_meta( 'description' ) ) { ?>
				<div class="row">
					<?php get_template_part( 'author-bio' ); ?>
				</div>
			<?php } ?>
			<?php if ( 1 == $litho_enable_share && function_exists( 'litho_single_post_share_shortcode' ) ) { ?>
				<div class="row">
					<div class="col-12 text-center alt-font float-end elements-social">
						<?php echo do_shortcode( '[litho_single_post_share]' ); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</<?php echo $wrapper_tag; ?>><?php // phpcs:ignore ?>
	<?php
}

if ( function_exists( 'litho_related_posts' ) ) {
	ob_start();
	litho_related_posts( get_the_ID() );
	$litho_related_posts = ob_get_contents();
	ob_end_clean();
}

if ( 1 == $litho_enable_related_posts && $litho_related_posts ) {
	echo sprintf( '%s', $litho_related_posts ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

if ( 1 == $litho_enable_comment && ( comments_open() || get_comments_number() ) ) { // If comments are open or we have at least one comment, load up the comment template.
	?>
	<?php comments_template(); ?>
	<?php
}
