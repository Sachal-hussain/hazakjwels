<?php
/**
 * The template for displaying the header default
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_logo              = get_theme_mod( 'litho_logo', '' );
$litho_logo_light        = get_theme_mod( 'litho_logo_light', '' );
$litho_logo_ratina       = get_theme_mod( 'litho_logo_ratina', '' );
$litho_logo_light_ratina = get_theme_mod( 'litho_logo_light_ratina', '' );
$litho_h1_logo_font_page = get_theme_mod( 'litho_h1_logo_font_page', '1' );
?>
<!-- header -->
<header id="masthead" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<!-- navigation -->
	<nav class="header-common-wrapper standard navbar navbar-default header-default-wrapper header-img navbar-expand-lg">
		<div class="container nav-header-container">
			<!-- logo -->
			<div class="col-6 col-md-2 col-sm-6">
				<?php
				if ( is_front_page() && '1' == $litho_h1_logo_font_page ) {
					echo '<h1>';
				}
				if ( $litho_logo || $litho_logo_light ) {
					echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
					if ( $litho_logo_ratina ) {
						if ( $litho_logo ) {
							echo '<img class="logo logo-light" src="' . esc_url( $litho_logo ) . '" data-rjs="' . esc_url( $litho_logo_ratina ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
						}
					} else {
						if ( $litho_logo ) {
							echo '<img class="logo logo-light" src="' . esc_url( $litho_logo ) . '" data-no-retina="" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
						}
					}
					if ( $litho_logo_light_ratina ) {
						if ( $litho_logo_light ) {
							echo '<img class="logo logo-dark" src="' . esc_url( $litho_logo_light ) . '" data-rjs="' . esc_url( $litho_logo_light_ratina ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
						}
					} else {
						if ( $litho_logo_light ) {
							echo '<img class="logo logo-dark" src="' . esc_url( $litho_logo_light ) . '" data-no-retina="" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
						}
					}
					echo '</a>';
				} else {
					echo '<span class="site-title alt-font">';
					echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
					echo esc_html( get_bloginfo( 'name' ) );
					echo '</a>';
					echo '</span>';
				}

				if ( is_front_page() && '1' == $litho_h1_logo_font_page ) {
					echo '</h1>';
				}
				?>
			</div>
			<!-- end logo -->
			<!-- accordion-menu -->
			<div class="col-auto menu-order accordion-menu">
				<button type="button" class="navbar-toggler collapsed pull-right" data-bs-toggle="collapse" data-bs-target="#navbar-collapse-toggle-1">
					<span class="sr-only"><?php echo esc_html__( 'Toggle Navigation', 'litho' ); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-collapse collapse pull-right" id="navbar-collapse-toggle-1" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php
					if ( has_nav_menu( 'primary-menu' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary-menu',
								'container'      => 'ul',
								'menu_class'     => 'nav navbar-nav alt-font litho-normal-menu navbar-left no-margin',
								'menu_id'        => '',
								'echo'           => true,
								'items_wrap'     => '<ul id="%1$s" class="simple-dropdown %2$s">%3$s</ul>',
							)
						);
					} else {
						wp_nav_menu(
							array(
								'container'  => 'ul',
								'menu_class' => 'nav navbar-nav alt-font litho-normal-menu navbar-left no-margin',
								'menu_id'    => '',
								'echo'       => true,
								'items_wrap' => '<ul id="%1$s" class="simple-dropdown %2$s">%3$s</ul>',
							)
						);
					}
					?>
				</div>
			</div>
			<!-- end accordion-menu -->
		</div>
		<!-- end container -->
	</nav>
	<!-- end navigation -->
</header>
<!-- end header -->
