<?php
/**
 * The template for displaying the footer
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'templates/footer/footer', 'wrapper' );

$litho_hide_scroll_to_top           = get_theme_mod( 'litho_hide_scroll_to_top', '1' );
$litho_hide_scroll_to_top_on_tablet = get_theme_mod( 'litho_hide_scroll_to_top_on_tablet', '0' );

if ( 1 == $litho_hide_scroll_to_top ) {
	$mobile_class = ( 0 == $litho_hide_scroll_to_top_on_tablet ) ? ' hide-in-tablet' : '';
	?>
		<a class="scroll-top-arrow<?php echo esc_attr( $mobile_class ); ?>" href="javascript:void(0);">
			<i class="feather icon-feather-arrow-up"></i>
		</a>
	<?php
}

// GDPR options.
$litho_gdpr_enable         = get_theme_mod( 'litho_gdpr_enable', '0' );
/**
 * Filters to enable GDPR so user can enable or disable it
 *
 * @since 1.0
 */
$litho_gdpr_enable         = apply_filters( 'litho_gdpr_enable', $litho_gdpr_enable );
$litho_gdpr_text           = get_theme_mod( 'litho_gdpr_text', sprintf( '%s <a href="/privacy-policy/" target="_blank">%s</a>', esc_html__( 'Our site uses cookies. By continuing to our site you are agreeing to our cookie', 'litho' ), esc_html__( 'privacy policy', 'litho' ) ) );
$litho_gdpr_button_text    = get_theme_mod( 'litho_gdpr_button_text', esc_html__( 'GOT IT', 'litho' ) );
$litho_gdpr_style          = get_theme_mod( 'litho_gdpr_style', 'left-content' );
$litho_gdpr_style          = ( ! empty( $litho_gdpr_style ) ) ? ' ' . $litho_gdpr_style : '';
$litho_gdpr_cookie_name    = ( is_multisite() ) ? 'litho_gdpr_cookie_notice_accepted-' . get_current_blog_id() : 'litho_gdpr_cookie_notice_accepted';
$litho_gdpr_enable_overlay = ( '1' != get_theme_mod( 'litho_gdpr_enable_overlay', '1' ) ) ? ' litho-gdpr-disable-overlay' : '';

if ( ! isset( $_COOKIE[ $litho_gdpr_cookie_name ] ) && '1' == $litho_gdpr_enable && ( ! empty( $litho_gdpr_text ) || ! empty( $litho_gdpr_button_text ) ) ) {
	?>
	<div class="litho-cookie-policy-wrapper<?php echo esc_attr( $litho_gdpr_style ) . esc_attr( $litho_gdpr_enable_overlay ); ?>">
		<div class="cookie-container">
			<?php if ( ! empty( $litho_gdpr_text ) ) { ?>
				<div class="litho-cookie-policy-text alt-font">
					<?php echo wp_kses_post( $litho_gdpr_text ); ?>
				</div>
			<?php } ?>
			<?php if ( ! empty( $litho_gdpr_button_text ) ) { ?>
				<a class="btn btn-black litho-cookie-policy-button"><?php echo esc_html( $litho_gdpr_button_text ); ?></a>
			<?php } ?>
		</div>
	</div>
	<?php
}
?>
	
		<?php wp_footer(); ?>
	</body>
</html>
