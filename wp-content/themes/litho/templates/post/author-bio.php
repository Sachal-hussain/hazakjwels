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

if ( (bool) get_the_author_meta( 'description' ) ) : ?>
	<div class="author-bio">
		<h2 class="author-title">
			<span class="author-heading">
				<?php
				printf(
					/* translators: %s: post author */
					esc_html__( 'Published by %s', 'litho' ),
					esc_html( get_the_author() )
				);
				?>
			</span>
		</h2>
		<p class="author-description">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php esc_html_e( 'View more posts', 'litho' ); ?>
			</a>
		</p><!-- .author-description -->
	</div><!-- .author-bio -->
	<?php
endif;
