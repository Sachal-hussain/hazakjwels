<?php
/**
 * The template for displaying all single posts and attachments
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
	/* Post main class */
	$class                             = 'single-post-main-section litho-main-inner-content-wrap default-top-space-main-section';
	$litho_single_post_layout_setting  = litho_option( 'litho_post_layout_setting', 'litho_layout_right_sidebar' );
	$litho_post_within_content_area    = litho_option( 'litho_post_within_content_area', '0' );
	$litho_post_layout_style           = litho_option( 'litho_post_layout_style', 'post-layout-standard' );
	$litho_single_post_top_space       = litho_option( 'litho_single_post_top_space', '1' );
	$litho_enable_custom_title_general = litho_builder_customize_option( 'litho_enable_custom_title_general', '1' );
	$litho_single_post_enable_title    = litho_builder_option( 'litho_enable_custom_title', '1', $litho_enable_custom_title_general );
	$litho_post_rich_snippet           = litho_option( 'litho_post_rich_snippet', '1' );

	/**
	 * Filter for change layout style for ex. ?sidebar=right_sidebar
	 *
	 * @since 1.0
	 */
	$litho_single_post_layout_setting = apply_filters( 'litho_page_layout_style', $litho_single_post_layout_setting );
	$litho_main_wrapper_tag           = ( 'litho_layout_no_sidebar' === $litho_single_post_layout_setting ) ? 'div' : 'section';

	$class .= ( 1 == $litho_post_within_content_area ) ? ' within-content-area' : '';
	$class .= ( 1 == $litho_single_post_top_space ) ? ' top-space' : '';
	$class .= ' single-' . $litho_post_layout_style;

	if ( ! is_litho_addons_activated() ) {
		$class .= ' default-single-main-section';
	}

	// Get post class and id.
	$litho_post_classes = '';
	ob_start();
		post_class( $class );
		$litho_post_classes .= ob_get_contents();
	ob_end_clean();

	echo '<' . $litho_main_wrapper_tag . ' id="post-' . esc_attr( get_the_ID() ) . '" ' . $litho_post_classes . '>'; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped

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

	// Get post layout style 1 to 5 template.
	switch ( $litho_post_layout_style ) {
		case 'post-layout-style-1':
			get_template_part( 'templates/single/post-layout-1' );
			break;
		case 'post-layout-style-2':
			get_template_part( 'templates/single/post-layout-2' );
			break;
		case 'post-layout-style-3':
			get_template_part( 'templates/single/post-layout-3' );
			break;
		case 'post-layout-style-3':
			get_template_part( 'templates/single/post-layout-3' );
			break;
		case 'post-layout-style-4':
			get_template_part( 'templates/single/post-layout-4' );
			break;
		case 'post-layout-style-5':
			get_template_part( 'templates/single/post-layout-5' );
			break;
	}
	// Get post layout style standard template and layout content.
	switch ( $litho_post_layout_style ) {
		case 'post-layout-style-1':
		case 'post-layout-style-2':
		case 'post-layout-style-3':
		case 'post-layout-style-4':
		case 'post-layout-style-5':
			get_template_part( 'templates/single/post-layout/post-layout-content' );
			break;
		default:
			get_template_part( 'templates/single/post-layout-standard' );
			break;
	}

	echo '</' . $litho_main_wrapper_tag . '>'; // @codingStandardsIgnoreLine
	if ( 0 == $litho_post_within_content_area ) {
		get_template_part( 'templates/single/post-bottom/content-bottom' );
	}
endwhile; // End of the loop.

get_footer();
