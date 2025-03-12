<?php
/**
 * Displaying in gallery for single post
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_gallery               = '';
$litho_blog_lightbox_gallery = litho_post_meta( 'litho_lightbox_image' );
$litho_blog_gallery          = litho_post_meta( 'litho_gallery' );

if ( ! empty( $litho_blog_gallery ) ) {
	$litho_gallery = explode( ',', $litho_blog_gallery );
}

$litho_popup_id = 'blog-' . get_the_ID();

if ( 1 == $litho_blog_lightbox_gallery ) {
	if ( ( is_array( $litho_gallery ) ) || ( ! empty( $litho_gallery ) ) ) {
		?>
		<ul class="blog-post-gallery-type portfolio-grid grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col">
			<li class="grid-sizer"></li>
			<?php
			foreach ( $litho_gallery as $key => $value ) {
				$litho_thumb = wp_get_attachment_url( $value );
				if ( $litho_thumb ) {
					/* Lightbox */
					$litho_attachment_attributes        = '';
					$litho_image_title_lightbox_popup   = get_theme_mod( 'litho_image_title_lightbox_popup', '0' );
					$litho_image_caption_lightbox_popup = get_theme_mod( 'litho_image_caption_lightbox_popup', '0' );

					if ( 1 == $litho_image_title_lightbox_popup ) {
						$litho_attachment_title       = get_the_title( $value );
						$litho_attachment_attributes .= ! empty( $litho_attachment_title ) ? ' title="' . $litho_attachment_title . '"' : '';
					}

					if ( 1 == $litho_image_caption_lightbox_popup ) {
						$litho_lightbox_caption       = wp_get_attachment_caption( $value );
						$litho_attachment_attributes .= ! empty( $litho_lightbox_caption ) ? ' data-lightbox-caption="' . $litho_lightbox_caption . '"' : '';
					}
					?>
					<li class="grid-item">
						<a href="<?php echo esc_url( $litho_thumb ); ?>" data-elementor-open-lightbox="no" data-group="lightbox-gallery-<?php echo esc_attr( $litho_popup_id ); ?>" class="lightbox-group-gallery-item"<?php echo sprintf( '%s', $litho_attachment_attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<figure>
								<div class="blog-post-gallery-img portfolio-image">
									<?php echo wp_get_attachment_image( $value, 'full' ); ?>
								</div>
								<figcaption>
									<div class="portfolio-hover">
										<i class="feather icon-feather-zoom-in" aria-hidden="true"></i>
									</div>
								</figcaption>
							</figure>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<?php
	}
} else {
	if ( ( is_array( $litho_gallery ) ) || ( ! empty( $litho_gallery ) ) ) {
		?>
		<div class="blog-image litho-post-format-wrap">
			<div class="litho-post-single-slider swiper white-move">
				<div class="swiper-wrapper">
				<?php
				foreach ( $litho_gallery as $key => $value ) {
					if ( ! empty( $value ) ) {
						?>
						<div class="swiper-slide">
							<?php echo wp_get_attachment_image( $value, 'full' ); ?>
						</div>
						<?php
					}
				}
				?>
				</div>
				<div class="swiper-button-next slider-one-slide-next light slider-navigation-style-1"><i class="feather icon-feather-arrow-right" aria-hidden="true"></i></div>
				<div class="swiper-button-prev slider-one-slide-prev light slider-navigation-style-1"><i class="feather icon-feather-arrow-left" aria-hidden="true"></i></div>
			</div>
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
		<?php
		if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) :
			?>
			<figcaption class="wp-caption-text"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
			<?php
		endif;
		?>
	</div>
	<?php
}
