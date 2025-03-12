<?php
/**
 * The template for displaying all single elementor posts
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/* Start of the loop. */
while ( have_posts() ) :
	the_post();
	$litho_post_classes      = '';
	$litho_heading_tag       = litho_option( 'litho_heading_tag', 'h1' );
	$litho_heading_tag       = ( $litho_heading_tag ) ? $litho_heading_tag : 'h1';
	$litho_post_rich_snippet = litho_option( 'litho_post_rich_snippet', '1' );
	/* Post main class */
	$class = 'single-post-main-section litho-main-inner-content-wrap big-section';

	// Get post class and id.
	ob_start();
		post_class( $class );
		$litho_post_classes .= ob_get_contents();
	ob_end_clean();

	echo '<section id="post-' . esc_attr( get_the_ID() ) . '" ' . $litho_post_classes . '>'; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( 1 == $litho_post_rich_snippet ) {
			?>
			<div class="litho-rich-snippet d-none">
				<span class="entry-title">
				<?php
					the_title();
				?>
				</span>
				<span class="author vcard">
					<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<?php
						echo esc_html( get_the_author() );
					?>
					</a>
				</span>
				<span class="published">
				<?php
					echo esc_html( get_the_date() );
				?>
				</span>
				<time class="updated" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
				<?php
					echo esc_html( get_the_modified_date() );
				?>
				</time>
			</div>
			<?php
		}

		if ( get_the_title() ) {
			?>
			<<?php echo $litho_heading_tag; ?> class="single-post-title alt-font"><?php the_title(); ?></<?php echo $litho_heading_tag; // PHPCS:Ignore ?>>
			<?php
		}
		get_template_part( 'loop/single/loop' );
		?>
		<!-- Show Post Content -->
		<div class="blog-details-text entry-content"><?php the_content(); ?></div>
		<?php
	echo '</section>'; // @codingStandardsIgnoreLine

endwhile; // End of the loop.

get_footer();
