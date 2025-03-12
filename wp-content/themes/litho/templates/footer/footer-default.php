<?php
/**
 * The template for displaying the default footer
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_logo        = get_theme_mod( 'litho_logo', '' );
$litho_logo_ratina = get_theme_mod( 'litho_logo_ratina', '' );
?>
<!-- start footer -->
<footer class="footer-default-wrapper site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<div class="container">
		<div class="row">
			<!-- logo -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-sm-start">
			<?php
			if ( $litho_logo ) {
				if ( $litho_logo_ratina ) {
					if ( $litho_logo ) {
						echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="logo-light">';
							echo '<img class="logo" src="' . esc_url( $litho_logo ) . '" data-rjs="' . esc_url( $litho_logo_ratina ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
						echo '</a>';
					}
				} else {
					if ( $litho_logo ) {
						echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="logo-light">';
							echo '<img class="logo" src="' . esc_url( $litho_logo ) . '" data-no-retina="" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
						echo '</a>';
					}
				}
			} else {
				echo '<span class="site-title alt-font">';
				echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				echo esc_html( get_bloginfo( 'name' ) );
				echo '</a>';
				echo '</span>';
			}
			?>
			</div>
			<div class="col-md-9 col-sm-6 col-xs-6 text-center text-sm-end">
				<span class="copyright-text">
				<?php
				printf(
					/* translators: %s: ThemeZaa. */
					esc_html__( 'Proudly powered by %s.', 'litho' ),
					'<a href="' . esc_url( 'https://www.themezaa.com' ) . '" class="imprint">ThemeZaa</a>'
				);
				?>
				</span>
			</div>
		</div>
	</div>
</footer>
<!-- end footer -->
