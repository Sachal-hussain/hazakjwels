<?php
/**
 * Displaying audio for single post
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_blog_audio = litho_post_meta( 'litho_audio' );
$litho_blog_image = litho_option( 'litho_featured_image', '1' );

if ( $litho_blog_audio ) {
	?>
	<div class="blog-image fit-videos litho-blog-audio">
	<?php
	if ( $litho_blog_audio ) {
		echo wp_oembed_get( $litho_blog_audio ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		echo sprintf( '%s', $litho_blog_audio ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	?>
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
