<?php
/**
 * Displaying video for single post
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_video_type = litho_post_meta( 'litho_video_type' );
$litho_video      = litho_post_meta( 'litho_video' );

if ( 'self' == $litho_video_type ) {

	$litho_video_mp4   = litho_post_meta( 'litho_video_mp4' );
	$litho_video_ogg   = litho_post_meta( 'litho_video_ogg' );
	$litho_video_webm  = litho_post_meta( 'litho_video_webm' );
	$litho_mute        = litho_post_meta( 'litho_enable_mute' );
	$litho_enable_mute = ( 1 == $litho_mute ) ? ' muted' : '';

	if ( $litho_video_mp4 || $litho_video_ogg || $litho_video_webm ) {
		?>
		<div class="blog-image litho-blog-video-html5">
			<video<?php echo sprintf( '%s', $litho_enable_mute ); ?> playsinline autoplay loop controls><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php if ( ! empty( $litho_video_mp4 ) ) { ?>
					<source src="<?php echo esc_url( $litho_video_mp4 ); ?>" type="video/mp4">
				<?php } ?>
				<?php if ( ! empty( $litho_video_ogg ) ) { ?>
					<source src="<?php echo esc_url( $litho_video_ogg ); ?>" type="video/ogg">
				<?php } ?>
				<?php if ( ! empty( $litho_video_webm ) ) { ?>
					<source src="<?php echo esc_url( $litho_video_webm ); ?>" type="video/webm">
				<?php } ?>
			</video>
		</div>
		<?php
	}
} else {
	$litho_video_url = litho_post_meta( 'litho_video' );
	if ( ! empty( $litho_video_url ) ) {
		?>
		<div class="blog-image fit-videos litho-blog-video">
			<iframe src="<?php echo esc_url( $litho_video_url ); ?>" width="640" height="360" allowFullScreen allow="autoplay; fullscreen"></iframe>
		</div>
		<?php
	}
}

$litho_blog_image = litho_option( 'litho_featured_image', '1' );

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
