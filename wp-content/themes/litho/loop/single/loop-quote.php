<?php
/**
 * Displaying quote for single post
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_blog_quote = litho_post_meta( 'litho_quote' );
$litho_blog_image = litho_option( 'litho_featured_image', '1' );

if ( $litho_blog_quote ) {
	?>
	<div class="blog-image litho-blog-blockquote">
		<blockquote>
			<i class="ti-quote-left icon-medium"></i>
			<div class="blockquote-content alt-font"><?php echo nl2br( $litho_blog_quote ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		</blockquote>
	</div>
	<?php
}

if ( has_post_thumbnail() && 1 == $litho_blog_image ) {
	?>
	<div class="blog-image">
		<?php
		// Lazy-loading attributes should be skipped for thumbnails since they are immediately in the viewport.
		the_post_thumbnail( 'full', array( 'loading' => false ) );
		?>
		<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) : ?>
			<figcaption class="wp-caption-text"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
		<?php endif; ?>
	</div>
	<?php
}
