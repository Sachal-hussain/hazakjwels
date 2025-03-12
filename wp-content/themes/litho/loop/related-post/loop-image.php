<?php
/**
 * Displaying featured image for related posts
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_related_post_srcset = litho_option( 'litho_related_post_feature_image_size', 'full' );
/* Image Alt, Title, Caption */
$litho_img_alt     = litho_option_image_alt( get_post_thumbnail_id() );
$litho_img_title   = litho_option_image_title( get_post_thumbnail_id() );
$litho_image_alt   = ( isset( $litho_img_alt['alt'] ) && ! empty( $litho_img_alt['alt'] ) ) ? $litho_img_alt['alt'] : '';
$litho_image_title = ( isset( $litho_img_title['title'] ) && ! empty( $litho_img_title['title'] ) ) ? $litho_img_title['title'] : '';

$litho_img_attr = array(
	'title' => $litho_image_title,
	'alt'   => $litho_image_alt,
);
if ( has_post_thumbnail() ) {
	?>
	<a href="<?php the_permalink(); ?>">
		<?php echo get_the_post_thumbnail( get_the_ID(), $litho_related_post_srcset, $litho_img_attr ); ?>
		<div class="hover-icon"><i aria-hidden="true" class=" icon-feather-arrow-right"></i></div>
	</a>
	<?php
}
