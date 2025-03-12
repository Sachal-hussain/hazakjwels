<?php
/**
 * The template for displaying Author info
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_author_decription = get_the_author_meta( 'description' );

if ( $litho_author_decription ) {

	$litho_author_url              = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$litho_author_box_button_title = get_theme_mod( 'litho_author_box_button_title', esc_html__( 'All author posts', 'litho' ) );
	$litho_author_description      = get_the_author_meta( 'description' );
	/* Start Author Info. */
	?>
	<div class="col-md-12 col-sm-12 col-xs-12 litho-author-box-wrap">
		<div class="d-block d-md-flex align-items-center litho-author-box">
			<div class="avtar-image-meta text-center">
				<a href="<?php echo esc_url( $litho_author_url ); ?>" class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 300 ); ?>
				</a>
				<a href="<?php echo esc_url( $litho_author_url ); ?>" class="author-title alt-font display-inline-block">
					<?php echo esc_html( get_the_author() ); ?>
				</a>
			</div>
			<div class="author-content-meta text-center text-md-start">
				<p><?php echo esc_html( $litho_author_description ); ?></p>
				<a href="<?php echo esc_url( $litho_author_url ); ?>" class="btn btn-very-small btn-black alt-font">
					<?php echo esc_html( $litho_author_box_button_title ); ?>
				</a>
			</div>
		</div>
	</div>
	<?php
	/* End Author Info. */
}
