<?php
/**
 * The template for displaying the default portfolio archive
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( have_posts() ) :

	$column_class                               = '';
	$litho_no_of_portfolios_columns_archive     = get_theme_mod( 'litho_no_of_portfolios_columns_archive', '3' );
	$litho_portfolio_enable_title_archive       = get_theme_mod( 'litho_portfolio_enable_title_archive', '1' );
	$litho_portfolio_enable_subtitle_archive    = get_theme_mod( 'litho_portfolio_enable_subtitle_archive', '1' );
	$litho_portfolio_enable_link_icon_archive   = get_theme_mod( 'litho_portfolio_enable_link_icon_archive', '1' );
	$litho_portfolio_feature_image_size_archive = get_theme_mod( 'litho_portfolio_feature_image_size_archive', 'full' );
	$litho_portfolio_enable_pagination_archive  = get_theme_mod( 'litho_portfolio_enable_pagination_archive', '0' );

	switch ( $litho_no_of_portfolios_columns_archive ) {
		case '1':
			$column_class .= 'row-cols-1 ';
			break;
		case '2':
			$column_class .= 'row-cols-1 row-cols-sm-2 ';
			break;
		case '4':
			$column_class .= 'row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 ';
			break;
		case '5':
			$column_class .= 'row-cols-1 row-cols-xl-5 row-cols-lg-3 row-cols-sm-2 ';
			break;
		case '6':
			$column_class .= 'row-cols-1 row-cols-xl-6 row-cols-lg-3 row-cols-sm-2 ';
			break;
		case '3':
		default:
			$column_class .= 'row-cols-1 row-cols-lg-3 row-cols-sm-2 ';
			break;
	}
	?>
	<ul class="<?php echo esc_attr( $column_class ); ?>row list-unstyled portfolio-classic portfolio-wrap portfolio-grid default-portfolio-grid">
		<li class="grid-sizer d-none p-0 m-0"></li>
		<?php
		while ( have_posts() ) :
			the_post();
			$litho_subtitle  = litho_post_meta( 'litho_subtitle' );
			$has_post_format = litho_post_meta( 'litho_portfolio_post_type' );
			if ( 'link' == $has_post_format || has_post_format( 'link', get_the_ID() ) ) {
				$portfolio_external_link = litho_post_meta( 'litho_portfolio_external_link' );
				$portfolio_link_target   = litho_post_meta( 'litho_portfolio_link_target' );
				$portfolio_external_link = ( ! empty( $portfolio_external_link ) ) ? $portfolio_external_link : '#';
				$portfolio_link_target   = ( ! empty( $portfolio_link_target ) ) ? $portfolio_link_target : '_self';
			} else {
				$portfolio_external_link = get_permalink();
				$portfolio_link_target   = '_self';
			}

			$litho_subtitle = ( $litho_subtitle ) ? str_replace( '||', '<br />', $litho_subtitle ) : '';
			?>
			<li id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'portfolio-item grid-item portfolio-single-post' ); ?>>
				<figure>
					<div class="portfolio-image">
						<?php
							/* Image Alt, Title, Caption */
							$litho_img_alt     = litho_option_image_alt( get_post_thumbnail_id() );
							$litho_img_title   = litho_option_image_title( get_post_thumbnail_id() );
							$litho_image_alt   = ( isset( $litho_img_alt['alt'] ) && ! empty( $litho_img_alt['alt'] ) ) ? $litho_img_alt['alt'] : '';
							$litho_image_title = ( isset( $litho_img_title['title'] ) && ! empty( $litho_img_title['title'] ) ) ? $litho_img_title['title'] : '';

							$litho_img_attr = array(
								'title' => $litho_image_title,
								'alt'   => $litho_image_alt,
							);
							echo get_the_post_thumbnail( get_the_ID(), $litho_portfolio_feature_image_size_archive, $litho_img_attr );
							?>
						<?php
						if ( 1 == $litho_portfolio_enable_link_icon_archive && ! empty( $portfolio_external_link ) ) {
							?>
							<div class="portfolio-hover d-flex">
								<div class="portfolio-icon">
									<a href="<?php echo esc_url( $portfolio_external_link ); ?>" target="<?php echo esc_attr( $portfolio_link_target ); ?>" class="rounded-circle">
										<i aria-hidden="true" class="fa-solid fa-link"></i>
									</a>
								</div>
							</div>
							<?php
						}
						?>
					</div>
					<?php if ( 1 == $litho_portfolio_enable_title_archive || 1 == $litho_portfolio_enable_subtitle_archive ) { ?>
						<figcaption>
							<div class="portfolio-caption">
								<?php if ( 1 == $litho_portfolio_enable_title_archive ) { ?>
									<span class="title">
										<a href="<?php echo esc_url( $portfolio_external_link ); ?>"><?php the_title(); ?></a>
									</span>
								<?php } ?>
								<?php if ( 1 == $litho_portfolio_enable_subtitle_archive && ! empty( $litho_subtitle ) ) { ?>
									<span class="subtitle"><?php echo sprintf( '%s', esc_html( $litho_subtitle ) ); ?></span>
								<?php } ?>
							</div>
						</figcaption>
					<?php } ?>
				</figure>
				</li>
			<?php
		endwhile;
		?>
	</ul>
	<?php
	if ( 1 == $litho_portfolio_enable_pagination_archive ) :
		litho_get_pagination(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	endif;
else :
	get_template_part( 'templates/content', 'none' );
endif;
