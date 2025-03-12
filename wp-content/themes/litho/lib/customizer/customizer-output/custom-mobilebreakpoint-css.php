<?php
/**
 * Generate css for theme responsive.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_header_mobile_menu_breakpoint = '';
$litho_header_tablet_menu_breakpoint = '';

if ( is_elementor_activated() ) {
	$litho_get_breakpoints               = \Elementor\Plugin::$instance->breakpoints->get_breakpoints( 'tablet' )->get_value();
	$litho_header_tablet_menu_breakpoint = ! empty( $litho_get_breakpoints ) ? apply_filters( 'litho_header_tablet_menu_breakpoint', $litho_get_breakpoints ) : '1024';
}

// Tablet Menu Breakpoint.
$litho_header_tablet_menu_breakpoint      = ! empty( $litho_header_tablet_menu_breakpoint ) ? ( $litho_header_tablet_menu_breakpoint ) : '1024';
$litho_header_tablet_min_width_breakpoint = ( $litho_header_tablet_menu_breakpoint + 1 ) . 'px';
$litho_header_tablet_menu_breakpoint      = $litho_header_tablet_menu_breakpoint . 'px';
?>
@media (max-width: 1600px) {
/* hamburger menu modern */
.hamburger-menu-modern { width: 60%; }
}
@media (max-width: 1199px) {
/* hamburger menu modern */
.hamburger-menu-modern { width:70%; }

/* header type */
.navbar-nav .nav-link, .navbar-expand-lg .navbar-nav .nav-link { margin: 0 16px; }

/* hamburger menu half */
.hamburger-menu-half .litho-left-menu-wrap { height: calc(100vh - 330px); }
}

@media (min-width: <?php echo esc_attr( $litho_header_tablet_min_width_breakpoint ); ?>) {
.navbar-expand-lg .navbar-toggler { display: none; }
.navbar-expand-lg .navbar-collapse { display: flex!important; flex-basis: auto; }
.navbar-expand-lg .navbar-nav { flex-direction: row; }
.navbar-expand-lg .elementor-widget-litho-mega-menu .toggle-menu-word { display: none; }
.left-menu-modern .header-push-button { display: block;}

}

/* Tablet menu breakpoint */
@media (max-width: <?php echo esc_attr( $litho_header_tablet_menu_breakpoint ); ?>) {

<?php
$litho_enable_header_general              = litho_builder_customize_option( 'litho_enable_header_general', '1' );
$litho_enable_header                      = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
$litho_header_section_id                  = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );
$litho_header_mobile_menu_bg_color        = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_bg_color', true );
$litho_header_mobile_menu_navbar_bg_color = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_navbar_bg_color', true );
?>
<?php if ( $litho_header_mobile_menu_bg_color ) : ?>
	/* Header menu background color */
	.site-header .header-common-wrapper.standard .elementor-widget-litho-mega-menu .navbar-collapse { background-color: <?php echo esc_attr( $litho_header_mobile_menu_bg_color ); ?>; }
<?php endif; ?>

<?php if ( $litho_header_mobile_menu_navbar_bg_color ) : ?>
	/* Header navbar background color */
	.site-header .header-common-wrapper.standard { background-color: <?php echo esc_attr( $litho_header_mobile_menu_navbar_bg_color ); ?>; }
<?php endif; ?>

.admin-bar .left-sidebar-wrapper .header-left-wrapper { margin-top: 32px; }
.admin-bar .left-sidebar-wrapper .header-left-wrapper .navbar-toggler { top: 63px; }
.admin-bar .left-menu-modern { margin-top: 32px; }
.admin-bar .left-menu-modern .navbar-toggler { top: 63px; }
.admin-bar[data-mobile-nav-style="modern"] .navbar-modern-inner .navbar-toggler, .admin-bar[data-mobile-nav-style="full-screen-menu"] .navbar-full-screen-menu-inner .navbar-toggler { right: 25px; top: 60px; }

[data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-section, [data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-widget, [data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-widget-container, [data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-widget-wrap, [data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-column, [data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-column-wrap, [data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-section .elementor-container, [data-mobile-nav-style=classic].navbar-collapse-show-after header .elementor-section.elementor-section-stretched,
[data-mobile-nav-style=classic].navbar-collapse-show header .elementor-section, [data-mobile-nav-style=classic].navbar-collapse-show header .elementor-widget, [data-mobile-nav-style=classic].navbar-collapse-show header .elementor-widget-container, [data-mobile-nav-style=classic].navbar-collapse-show header .elementor-widget-wrap, [data-mobile-nav-style=classic].navbar-collapse-show header .elementor-column, [data-mobile-nav-style=classic].navbar-collapse-show header .elementor-column-wrap, [data-mobile-nav-style=classic].navbar-collapse-show header .elementor-section .elementor-container, [data-mobile-nav-style=classic].navbar-collapse-show header .elementor-section.elementor-section-stretched { position: inherit !important; }
.navbar-expand-lg .navbar-collapse.collapse:not(.show) { display: none !important; }
.navbar-expand-lg .navbar-collapse { display: inline !important; display: inline !important; -ms-flex-preferred-size: inherit !important; flex-basis: inherit !important; }
[data-mobile-nav-style=classic] .navbar-expand-lg .navbar-collapse { width: 100% !important }
.navbar-expand-lg .navbar-nav { -ms-flex-direction: column !important; flex-direction: column !important; }
.header-with-mini-header .header-common-wrapper.standard { margin-top: 0; }
.admin-bar.navbar-collapse-show[data-mobile-nav-style=classic] .sticky .header-common-wrapper {top: 32px !important; }

/* push button */
.push-button:hover { opacity: 1; }

/* header type */
.shrink-nav .navbar-toggler { transition-duration: 0.5s; -webkit-transition-duration: 0.5s; -moz-transition-duration: 0.5s; -ms-transition-duration: 0.5s; -o-transition-duration: 0.5s; }
.sticky .shrink-nav .navbar-toggler { margin: 25px 0 23px 0; }
.sticky .shrink-nav.navbar-nav .nav-link, .sticky .shrink-nav.navbar-expand-lg .navbar-nav .nav-link { padding: 9px 40px; }

/* logo */
header .default-logo, header .alt-logo { display: none; }
header .navbar-brand .mobile-logo { visibility: visible; opacity: 1; width: auto; }

/* search form */
.search-form-wrapper .search-form-icon { color: #232323; padding: 5px 0 5px 5px; }
.search-form-wrapper .search-form-icon .elementor-icon, header .social-icons-wrapper ul li a.elementor-social-icon i { color: #232323; }
.search-form-wrapper .search-form-icon:hover .elementor-icon { color: rgba(0,0,0,0.6); }

/* mini cart */
.litho-top-cart-wrapper .litho-cart-top-counter i { color: #232323; }
.litho-top-cart-wrapper:hover .litho-cart-top-counter i { color: rgba(0,0,0,0.6); }

/* navbar toggle */
.push-button span { background-color: #232323; }
.navbar-toggler { margin: 30px 0 28px 0; padding: 0; font-size: 24px; width: 22px; height: 14px; display: inline-block !important; position: relative; border: none; vertical-align: middle; border-radius: 0; }
.navbar-toggler-line { background: #232323; height: 2px; width: 22px; content: ""; display: block; border-radius: 0; position: absolute; left: 0; right: 0; margin-left: auto; margin-right: auto; -webkit-transform: rotate(0deg); -moz-transform: rotate(0deg); -o-transform: rotate(0deg); transform: rotate(0deg); -webkit-transition: .25s ease-in-out; -moz-transition: .25s ease-in-out; -o-transition: .25s ease-in-out; transition: .25s ease-in-out; }
.navbar-toggler-line:nth-child(1) { top: 0px; width: 14px; }
.navbar-toggler-line:nth-child(2),.navbar-toggler-line:nth-child(3) { top: 6px; }
.navbar-toggler-line:nth-child(4) { top: 12px; width: 14px; }
.navbar-collapse-show .navbar-toggler-line:nth-child(1) { top: 7px; width: 0%; }
.navbar-collapse-show .navbar-toggler-line:nth-child(2) { -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -o-transform: rotate(45deg); -ms-transform: rotate(45deg); transform: rotate(45deg); }
.navbar-collapse-show .navbar-toggler-line:nth-child(3) { -webkit-transform: rotate(-45deg); -moz-transform: rotate(-45deg); -o-transform: rotate(-45deg); -ms-transform: rotate(-45deg); transform: rotate(-45deg); }
.navbar-collapse-show .navbar-toggler-line:nth-child(4) { top: 7px; width: 0%; }
.dropdown-toggle:after, .simple-dropdown .sub-menu li .dropdown-toggle { display: none; }

/* header default */
.navbar-collapse {left: 0 !important; position: absolute; top: calc(100% - 1px); left: 0; width: 100vw; background: #fff; overflow: hidden; box-shadow: 0 20px 15px 0 rgba(23,23,23,.05); max-height: calc(100vh - 70px); }
.header-with-mini-header .navbar-collapse { max-height: calc(100vh - 120px); }
.navbar-collapse.show {overflow-y: auto !important; }
.admin-bar .navbar-collapse { max-height: calc(100vh - 116px); }

/* navigation */
.header-common-wrapper { background-color: #fff; }
.navbar-nav { padding: 15px 0 25px; text-align: left; }
.nav-item.dropdown.megamenu { position: relative; }
.navbar-nav .nav-link, .navbar-expand-lg .navbar-nav .nav-link { font-size: 15px; color: #232323; padding: 9px 40px; font-weight: 500; margin: 0; display: block; }
.navbar-nav .nav-link:hover, .navbar-expand-lg .navbar-nav .nav-link:hover, .navbar-nav .open > .nav-link, .navbar-expand-lg .navbar-nav .open > .nav-link, .navbar-nav .current-menu-ancestor > .nav-link, .navbar-nav .current-menu-item > .nav-link { color: rgba(0,0,0,0.6); }
.nav-item > .dropdown-toggle { display: block; width: 48px; height: 48px; right: 27px; position: absolute; top: 0; text-align: center; line-height: 50px; }
.nav-item.show > .dropdown-toggle, .nav-item > .dropdown-toggle.show { -ms-transform: rotate(-180deg); -webkit-transform: rotate(-180deg); transform: rotate(-180deg); }

/* megamenu and simple dropdown */
.nav-item.dropdown.megamenu .menu-back-div, header .sub-menu, .simple-dropdown .sub-menu { width: 100% !important; background-color: #f7f7f7; padding: 30px 40px 30px; box-shadow: none; -moz-box-shadow: none; -webkit-box-shadow: none; border-radius: 0; border: 0; left: 0 !important; position: initial !important; }
.nav-item.dropdown.megamenu .menu-back-div { display: none; }
.nav-item.dropdown.megamenu.show .menu-back-div, .nav-item.dropdown.megamenu .menu-back-div.show { display: block; }
.dropdown.open > .sub-menu, .dropdown.open > .dropdown-menu { display: none }
.dropdown.show > .sub-menu, .dropdown.show > .dropdown-menu, .dropdown > .sub-menu.show, .dropdown > .dropdown-menu.show { display: block; }
.simple-dropdown .sub-menu { display: none; }
.simple-dropdown .sub-menu li { padding: 0; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown { margin-bottom: 20px; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > li ~ .dropdown { margin-top: 20px; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown:last-child, .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item:last-child { margin-bottom: 0; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown > a { color: #232323; margin: 15px 0 7px 0; font-size: 14px; font-weight: 500; line-height: normal; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item > a { padding: 3px 15px 3px; margin-top: 0; font-size: 14px; margin-bottom: 7px; line-height: inherit; color: #232323; }
.dropdown-menu.megamenu-content li a, .simple-dropdown .sub-menu a, .nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown.menu-item ul li a { font-weight: 400; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown.menu-item a { line-height: normal; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown.menu-item ul li a { color: #828282; }
.nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu { margin: 0 0 5px; left: 0; top: 0; padding: 0; }
.simple-dropdown .sub-menu li .handler { display: none; }
.dropdown > .sub-menu .sub-menu{ display: block; }
.navbar-nav-clone { padding-bottom: 0 }
.navbar-nav-clone + ul { padding-top: 0; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown.menu-item > ul li ul { padding-left: 15px; }

/* hamburger menu modern */
.hamburger-menu-modern .litho-left-menu li a { font-size: 30px; line-height: 38px; }
.hamburger-menu-modern { width:45%; }
.hamburger-menu-modern .full-screen, .hamburger-menu-wrapper .hamburger-menu .full-screen { height: 100vh !important; }

/* sidebar nav style 1 */
.left-sidebar-wrapper { padding-left: 0; }
.left-sidebar-wrapper .left-sidebar-wrapper header.site-header { left: -290px; height: 100%; top: 0; padding-top: 60px; -webkit-box-align: start; -ms-flex-align: start; align-items: start; -webkit-transition-duration: .3s; -moz-transition-duration: .3s; -ms-ransition-duration: .3s; -o-transition-duration: .3s; transition-duration: .3s; }
.left-sidebar-wrapper .header-left-wrapper { position: fixed; left: 0; top: 0; text-align: left!important; width: 100%; z-index: 9; height: auto; }
.left-sidebar-wrapper .header-left-wrapper .navbar-toggler { position: fixed; right: 40px; top: 31px; margin: 0; }
.litho-left-menu-wrapper, .navbar-expand-lg .litho-left-menu-wrapper.navbar-collapse, .navbar-expand-lg .litho-left-menu-wrapper.navbar-collapse.collapse:not(.show), .navbar-collapse-show .litho-left-menu-wrapper, .navbar-collapse-show .navbar-expand-lg .litho-left-menu-wrapper.navbar-collapse, .navbar-collapse-show .navbar-expand-lg .litho-left-menu-wrapper.navbar-collapse.collapse:not(.show) { padding: 0; left: 0 !important; overflow: visible; height: auto !important; top: 0; width: 100%; position: relative; display: block !important; box-shadow: 0 0 0 0 rgba(23,23,23,.05); max-height: 100%; background-color: transparent; }
.left-menu-classic-section { left: -290px !important; z-index: -1; overflow: visible; height: 100%; top: 0; width: 290px; position: fixed; display: block !important; background-color: #fff; transition: all .3s ease-in-out; -moz-transition: all .3s ease-in-out; -webkit-transition: all .3s ease-in-out; -ms-transition: all .3s ease-in-out; -o-transition: all .3s ease-in-out; }
.navbar-collapse-show .litho-left-menu-wrapper, .navbar-collapse-show .navbar-expand-lg .litho-left-menu-wrapper.navbar-collapse, .navbar-collapse-show .navbar-expand-lg .litho-left-menu-wrapper.navbar-collapse.collapse:not(.show) { left: 0 !important; }
.left-sidebar-wrapper header.site-header { left: -290px; }
.navbar-collapse-show .left-menu-classic-section, .navbar-collapse-show .left-sidebar-wrapper header.site-header { left: 0 !important; }
.navbar-collapse-show .left-menu-classic-section > div { overflow-y: auto; height: 100%; }
.header-left-wrapper { overflow-y: visible; }

/* sidebar nav style 2 */
.left-menu-modern.header-left-wrapper { border-bottom: 0; padding: 0; }
.left-menu-modern .social-icons-wrapper li { margin: 0 7px; width: auto; }
.left-menu-modern { height: auto; width: 100%; display: block; }
.show-menu .left-menu-modern .hamburger-menu { left: 0; }
.header-left-wrapper .hamburger-menu-wrapper .litho-left-menu-wrap { height: calc(100vh - 100px); }
.page-wrapper { padding-left: 0; }
.hamburger-menu-wrapper .litho-left-menu .menu-toggle:before, .hamburger-menu-wrapper .litho-left-menu .menu-toggle:after { top: 16px; }

/* hamburger half */
.hamburger-menu-half { width: 60%; }

/* default css */
.navbar-expand-lg.navbar-default .navbar-nav .page_item > a, .navbar-expand-lg.navbar-default .navbar-nav > .menu-item > a { padding: 9px 15px; margin: 0; font-size: 15px; }
.navbar-expand-lg.navbar-default .accordion-menu { position: inherit; }
.navbar-default .navbar-nav .menu-item .sub-menu li.current-menu-parent:before, .navbar-default .navbar-nav .menu-item .sub-menu li.current-menu-ancestor:before { display: none; font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f105"; position: absolute; right: 25px; top: 10px; }
.navbar-default .navbar-nav li.current-menu-parent:before, .navbar-default .navbar-nav li.current-menu-ancestor:before { font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f105"; position: absolute; right: 25px; top: 10px; padding: 5px 10px; -ms-transform: rotate(90deg); -webkit-transform: rotate(90deg); transform: rotate(90deg); right: 15px; top: 5px; }
.navbar-default .navbar-nav li.current-menu-parent.active:before, .navbar-default .navbar-nav li.current-menu-ancestor.active:before { -ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg); }
.navbar-expand-lg.navbar-default .navbar-nav .menu-item:hover > .sub-menu { display: block; }
.navbar-default .navbar-nav li.current-menu-parent.active .sub-menu, .navbar-default .navbar-nav li.current-menu-ancestor.active .sub-menu { display: block; }
.navbar-expand-lg.navbar-default .navbar-nav .menu-item .sub-menu li a { padding: 10px 0; font-size: 14px; }
.navbar-expand-lg.navbar-default .navbar-nav .menu-item .sub-menu { left: 0; top: 0; }
.navbar-expand-lg.navbar-default .navbar-nav .menu-item .sub-menu li > .sub-menu { padding: 5px 20px 0; padding-bottom: 5px; }
.navbar-expand-lg.navbar-default .navbar-nav .menu-item .sub-menu { display: block; }
.navbar-default .navbar-nav .menu-item .sub-menu li.menu-item-has-children::before { display: none; }
.navbar-expand-lg.navbar-default .navbar-nav .page_item .children { display: block; }
.navbar-expand-lg.navbar-default .navbar-nav .page_item > .children { background-color: #f7f7f7; left: 0; width: 100%; margin: 0; box-shadow: 0 0 0 rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 0 0 rgba(0, 0, 0, 0.1); -webkit-box-shadow: 0 0 0 rgba(0, 0, 0, 0.1); border-radius: 0; border: 0; position: inherit; }
.navbar-expand-lg.navbar-default .navbar-nav .page_item > .children li .children { left: 0; top: 0; padding: 10px 0 0; }
.navbar-expand-lg.navbar-default .navbar-nav .page_item > .children li .children li { padding-left: 15px; padding-right: 15px; }
.navbar-expand-lg.navbar-default .navbar-nav .page_item > .children li.page_item_has_children::before, .navbar-default .navbar-nav li.current-menu-parent::before, .navbar-default .navbar-nav li.current-menu-ancestor::before { display: none; }
.navbar-expand-lg.navbar-default .navbar-nav .menu-item .sub-menu li.current-menu-ancestor > a { color: #232323; }
.navbar-expand-lg.navbar-default .navbar-toggler { margin: 22px 0 28px 0; }

/* menu modern */
[data-mobile-nav-style=modern] .page-layout, [data-mobile-nav-style=modern] .box-layout { background-color: #fff; }
[data-mobile-nav-style=modern] header .navbar-collapse { display: none !important; }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-nav { width: 100%; padding: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-collapse.show { height: 100%; }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-toggler-line { background-color: #fff; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item i, [data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .dropdown a.active, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown > a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item > a { color: #fff; display: inline-block; right: 0; font-size: 17px; font-weight: 500; padding: .5rem 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .current-menu-item > a { text-decoration: underline; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item i { font-size: 14px; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item i.dropdown-toggle { font-size: 17px; font-weight: 600; padding: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item .megamenu-content h5 { font-size: 15px; font-weight: 500; color: #fff; opacity: .7; margin-top: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item .megamenu-content a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown > a { font-size: 13px; padding: 0}
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div { color: #fff; position: inherit !important; margin-bottom: 15px !important; margin-top: 6px; padding: 0 !important; right: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div ul { padding: 0; list-style: none; }
[data-mobile-nav-style=modern] .navbar-modern-inner .dropdown-menu.megamenu-content li, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu {line-height: normal; padding-bottom: 10px; font-size: 15px; background-color: transparent; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div, [data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown > .dropdown-menu { border-radius: 0; background-color: transparent; transform: translate3d(0, 0, 0px) !important; position: inherit !important; padding: 8px 15px !important; margin-bottom: 0 !important }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column ul { margin-bottom: 20px; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown { margin-bottom: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown > .dropdown-menu { padding-top: 14px !important; padding-bottom: 0 !important; }
[data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown > .dropdown-menu li:last-child > ul { margin-bottom: 0 !important; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li { padding: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu { margin-bottom: 5px; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown > a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item > a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item > ul.sub-menu.dropdown-menu > li.menu-item-has-children > a { opacity: .7; font-size: 14px; margin-bottom: 10px; margin-top: 0; padding: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown > .dropdown-toggle-clone, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li .dropdown-toggle-clone { display: none; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li > a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li.menu-item-has-children > a { margin-bottom: 10px; font-size: 13px; color: #fff; opacity: 1; }
[data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .dropdown:hover > a, [data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .dropdown a:hover, [data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .dropdown a.active, [data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .dropdown a:focus, [data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .dropdown.active > a, [data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .current-menu-item > a, [data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li.current-menu-item > a, [data-mobile-nav-style=modern] .navbar-modern-inner .dropdown-menu.megamenu-content li.current-menu-item > a, [data-mobile-nav-style=modern] .navbar-modern-inner .dropdown-menu.megamenu-content li.current_page_item > a { color: rgba(255,255,255,0.6); }
[data-mobile-nav-style=modern] .navbar-modern-inner .mCustomScrollBox { height: auto; width: 100%; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown a { padding: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .simple-dropdown .dropdown-menu .dropdown a .dropdown-toggle { display: none; right: 13px; top: 4px; transform: translateY(0); -webkit-transform: translateY(0); -moz-transform: translateY(0); -o-transform: translateY(0); -ms-transform: translateY(0); }
[data-mobile-nav-style=modern] .navbar-modern-inner .dropdown-menu.megamenu-content li.active a, [data-mobile-nav-style=modern] .navbar-modern-inner .dropdown-menu.megamenu-content li a:hover { color: rgba(255,255,255,0.6); }
.navbar-collapse-show[data-mobile-nav-style=modern] { overflow: hidden; padding-top: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner { opacity: 0; visibility: hidden; overflow: visible !important; width: 70vw; height: 100vh !important; position: fixed; top: 0; right: -40vw; z-index: 90; display: -ms-flexbox !important; display: -webkit-box !important; display: flex !important; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -webkit-transition-duration: 0.65s; transition-duration: 0.65s; -webkit-transition-timing-function: cubic-bezier(0.23, 1, 0.32, 1); transition-timing-function: cubic-bezier(0.23, 1, 0.32, 1); -webkit-transform: translate3d(25vw, 0, 0); transform: translate3d(25vw, 0, 0); }
.navbar-collapse-show[data-mobile-nav-style=modern] .navbar-modern-inner { right: 0; opacity: 1; visibility: visible !important; display: -ms-flexbox !important; display: -webkit-box !important; display: flex !important; -webkit-transition-delay: 0.1s; transition-delay: 0.1s; -webkit-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0); }
[data-mobile-nav-style=modern] .navbar-show-modern-bg { display: inline-block; width: 100vw; height: 100vh; position: fixed; top: 0; left: 0; z-index: -1; opacity: 0; background-image: linear-gradient(to right top, #0039e3, #4132e0, #5e28dd, #741bd9, #8600d4); -webkit-transform: scale(1.75); transform: scale(1.75); transition: opacity .3s,-webkit-transform .3s; transition: opacity .3s,transform .3s; transition: opacity .3s,transform .3s,-webkit-transform .3s; -webkit-transition-delay: 0.4s; -o-transition-delay: 0.4s; transition-delay: 0.4s; }
.navbar-collapse-show[data-mobile-nav-style=modern] .navbar-show-modern-bg { -webkit-transform: scale(1); transform: scale(1); opacity: 1; -webkit-transition-delay: 0s; -o-transition-delay: 0s; transition-delay: 0s; }
[data-mobile-nav-style=modern] .navbar, [data-mobile-nav-style=modern] .sticky.header-appear .header-reverse-scroll, [data-mobile-nav-style=modern] header .top-bar + .navbar.fixed-top { -webkit-transition-duration: 0.75s; -moz-transition-duration: 0.75s; -ms-transition-duration: 0.75s; -o-transition-duration: 0.75s; transition-duration: 0.75s; }
[data-mobile-nav-style=modern] .navbar, [data-mobile-nav-style=modern] .page-layout, [data-mobile-nav-style=modern] .box-layout, [data-mobile-nav-style=modern] .top-bar, [data-mobile-nav-style=modern] footer { -webkit-transition: all 0.3s, -webkit-transform 0.75s cubic-bezier(0.23, 1, 0.32, 1); transition: all 0.3s, -webkit-transform 0.75s cubic-bezier(0.23, 1, 0.32, 1); transition: transform 0.75s cubic-bezier(0.23, 1, 0.32, 1), all 0.3s; transition: transform 0.75s cubic-bezier(0.23, 1, 0.32, 1), all 0.3s, -webkit-transform 0.75s cubic-bezier(0.23, 1, 0.32, 1); }
.navbar-collapse-show[data-mobile-nav-style=modern] .navbar, .navbar-collapse-show[data-mobile-nav-style=modern] .page-layout, .navbar-collapse-show[data-mobile-nav-style=modern] .box-layout, .navbar-collapse-show[data-mobile-nav-style=modern] .top-bar, .navbar-collapse-show[data-mobile-nav-style=modern] footer { -webkit-transform: translate3d(-70vw, 0, 0); transform: translate3d(-70vw, 0, 0); }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-toggler { position: absolute; right: 35px; top: 35px; margin: 0; }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-collapse { position: static; left: 0; top: 0; width: 100%; height: 100%; background: transparent; padding: 100px 12vw; box-shadow: none; max-height: 100%; display:flex !important; -ms-flex-pack: center!important; justify-content: center!important; }
.navbar-collapse-show[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] .navbar-modern-inner .navbar-toggler .navbar-collapse-show[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] .navbar { position: absolute; }
.navbar-collapse-show[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] .navbar, .navbar-collapse-show[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] .page-layout, .navbar-collapse-show[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] .box-layout, .navbar-collapse-show[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] .top-bar, .navbar-collapse-show[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] footer { -webkit-transform: translate3d(80vw, 0, 0); transform: translate3d(80vw, 0, 0); }
[data-mobile-nav-trigger-alignment=left] .navbar-modern-inner { width: 80vw; right: inherit; left: -30vw; -webkit-transform: translate3d(-25vw, 0, 0); transform: translate3d(-25vw, 0, 0); }
.navbar-collapse-show[data-mobile-nav-trigger-alignment=left] .navbar-modern-inner { left: 0; right: inherit; }
[data-mobile-nav-trigger-alignment=left] .navbar-modern-inner .navbar-collapse { right: 0; left: inherit; padding-right: 10vw; padding-left: 10vw; }
[data-mobile-nav-trigger-alignment=left][data-mobile-nav-style=modern] .parallax { background-attachment: scroll !important; }
[data-mobile-nav-style=modern] .navbar-nav > .nav-item { border-bottom: 1px solid rgba(255,255,255,.1); padding-top: 10px; padding-bottom: 12px; }
[data-mobile-nav-style=modern] .navbar-nav > .nav-item:last-child { border-bottom: 0; }
[data-mobile-nav-style=modern] .nav-item > .dropdown-toggle { top: 7px; }
[data-mobile-nav-style=modern] .navbar-nav > .nav-item.current-menu-ancestor > a { color: rgba(255,255,255,0.6); }
[data-mobile-nav-trigger-alignment=right][data-mobile-nav-style=modern] .navbar-modern-inner .navbar-toggler { display: none; }

/* full screen menu */
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] { overflow: hidden; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] .navbar .navbar-nav { padding: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner { background-image: linear-gradient(to right top, #0039e3, #4132e0, #5e28dd, #741bd9, #8600d4); visibility: hidden; overflow: hidden !important; width: 100vw; height: 100vh !important; position: fixed; top: -100vh; left: 0; z-index: 9999; display: -ms-flexbox !important; display: -webkit-box !important; display: flex !important; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -webkit-transition: all 0.4s ease-ou; transition: all 0.4s ease-out; -webkit-transition-delay: 0.6s; transition-delay: 0.6s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner { height: 100vh !important; top: 0; visibility: visible !important; -webkit-transition: all 0.2s ease-in; transition: all 0.2s ease-in; -webkit-transition-delay: 0.20s; transition-delay: 0.20s; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-collapse { position: inherit; left: 0; top:0; width: 100%; height: 100%; padding: 100px 0; max-height: 100%; box-shadow: none; background: transparent; display: -ms-flexbox !important; display: -webkit-box !important; display: flex !important; -ms-flex-pack: center!important; justify-content: center!important; -webkit-overflow-scrolling: touch; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-nav { padding: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column ul { margin-bottom: 20px; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.megamenu .menu-back-div, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown > .dropdown-menu { border-radius: 0; background-color: transparent; transform: translate3d(0, 0, 0px) !important; position: inherit !important; padding: 8px 15px !important; margin-bottom: 0 !important; margin-top: 6px; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .mCustomScrollBox { height: auto; width: 80%; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item i, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown > a { color: #fff; font-size: 17px; font-weight: 500; padding: .5rem 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item i { padding: 0; font-size: 14px; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .megamenu-content h5 { font-size: 15px; font-weight: 500; color: #fff; opacity: .7; margin-top: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.megamenu .menu-back-div { color: #fff; line-height: normal; padding-bottom: 5px; font-size: 15px; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .dropdown-menu.megamenu-content li.active a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .dropdown-menu.megamenu-content li a:hover { color: rgba(255,255,255,0.6); }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.megamenu .menu-back-div ul { margin-bottom: 20px; padding: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.megamenu .menu-back-div ul:last-child { list-style: none; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .dropdown-menu.megamenu-content li, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu { line-height: normal; padding-bottom: 12px; font-size: 15px; background-color: transparent; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item .megamenu-content a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown > a { font-size: 13px; padding: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown > .dropdown-menu { padding-bottom: 0 !important; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown { margin-bottom: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li.menu-item-has-children > a { padding: 3px 0 3px; font-size: 13px; margin-bottom: 6px; margin-top: 0; color: #fff; opacity: 1; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item > ul.sub-menu.dropdown-menu > li.menu-item-has-children > a { color: #fff; opacity: .7; margin-bottom: 7px; font-size: 14px; padding: 3px 0 3px; line-height: normal; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown > .dropdown-menu li:last-child > ul { margin-bottom: 0 !important; padding-bottom: 5px !important; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown .dropdown-menu .dropdown:hover > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown .dropdown-menu .dropdown a:hover, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown .dropdown-menu .dropdown a.active, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown .dropdown-menu .dropdown a:focus, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown .dropdown-menu .dropdown.active > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .simple-dropdown .dropdown-menu .current-menu-item > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu li.current-menu-item > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .dropdown-menu.megamenu-content li.current-menu-item > a, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .dropdown-menu.megamenu-content li.current_page_item > a { color: rgba(255,255,255,0.6); }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-toggler { margin: 0; position: absolute; right: 35px; top: 35px; opacity: 0; -webkit-transition: all 0.4s ease-ou; transition: all 0.4s ease-out; -webkit-transition-delay: 0.6s; transition-delay: 0.6s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-toggler { opacity: 1}
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-toggler-line { background-color: #fff; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li.nav-item > .dropdown-toggle { font-weight: 600; top: 8px; right: 0; font-size: 17px; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li.nav-item { border-bottom: 1px solid rgba(255,255,255,.1); padding-top: 10px; padding-bottom: 12px; -webkit-transform: scale(1.15) translateY(-30px); transform: scale(1.15) translateY(-30px); opacity: 0; -webkit-transition: opacity 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99); transition: opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99); transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99); transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99); }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li.nav-item:last-child { border-bottom: 0; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li { -webkit-transform: scale(1) translateY(0px); transform: scale(1) translateY(0px); opacity: 1; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(1) { -webkit-transition-delay: 0.49s; transition-delay: 0.49s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(2) { -webkit-transition-delay: 0.42s; transition-delay: 0.42s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(3) { -webkit-transition-delay: 0.35s; transition-delay: 0.35s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(4) { -webkit-transition-delay: 0.28s; transition-delay: 0.28s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(5) { -webkit-transition-delay: 0.21s; transition-delay: 0.21s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(6) { -webkit-transition-delay: 0.14s; transition-delay: 0.14s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(7) { -webkit-transition-delay: 0.07s; transition-delay: 0.07s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(8) { -webkit-transition-delay: 0s; transition-delay: 0s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(9) { -webkit-transition-delay: -0.07s; transition-delay: -0.07s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(10) { -webkit-transition-delay: -0.14s; transition-delay: -0.14s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(11) { -webkit-transition-delay: -0.21s; transition-delay: -0.21s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(12) { -webkit-transition-delay: -0.28s; transition-delay: -0.28s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(13) { -webkit-transition-delay: -0.35s; transition-delay: -0.35s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(14) { -webkit-transition-delay: -0.42s; transition-delay: -0.42s; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(15) { -webkit-transition-delay: -0.49s; transition-delay: -0.49s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(1) { -webkit-transition-delay: 0.27s; transition-delay: 0.27s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(2) { -webkit-transition-delay: 0.34s; transition-delay: 0.34s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(3) { -webkit-transition-delay: 0.41s; transition-delay: 0.41s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(4) { -webkit-transition-delay: 0.48s; transition-delay: 0.48s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(5) { -webkit-transition-delay: 0.55s; transition-delay: 0.55s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(6) { -webkit-transition-delay: 0.62s; transition-delay: 0.62s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(7) { -webkit-transition-delay: 0.69s; transition-delay: 0.69s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(8) { -webkit-transition-delay: 0.76s; transition-delay: 0.76s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(9) { -webkit-transition-delay: 0.83s; transition-delay: 0.83s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(10) { -webkit-transition-delay: 0.9s; transition-delay: 0.9s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(11) { -webkit-transition-delay: 0.97s; transition-delay: 0.97s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(12) { -webkit-transition-delay: 1.04s; transition-delay: 1.04s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(13) { -webkit-transition-delay: 1.11s; transition-delay: 1.11s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(14) { -webkit-transition-delay: 1.18s; transition-delay: 1.18s; }
.navbar-collapse-show[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li:nth-child(15) { -webkit-transition-delay: 1.25s; transition-delay: 1.25s; }
[data-mobile-nav-style=full-screen-menu] .navbar-collapse.collapsing .mCSB_scrollTools { opacity: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-collapse.collapse .mCSB_scrollTools { opacity: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-collapse.collapse.show .mCSB_scrollTools { opacity: 1; }
[data-mobile-nav-style=full-screen-menu] ul.navbar-nav > li.nav-item.current-menu-ancestor > a { color: rgba(255,255,255,0.6); }

.navbar-collapse-show[data-mobile-nav-style=classic] .sticky .header-common-wrapper{ -webkit-transform: translateY(0); -moz-transform: translateY(0); -ms-transform: translateY(0); -o-transform: translateY(0); transform: translateY(0); -webkit-transition-duration: 0s; -moz-transition-duration: 0s; -ms-ransition-duration: 0s; -o-transition-duration: 0s; transition-duration: 0s; top: 0 !important; }
body.navbar-collapse-show { overflow: hidden; }

/* toggler menu text */
.left-sidebar-wrapper .header-left-wrapper .toggle-menu-word { margin: 0px 35px 0 0; color: #232323; font-weight: 400; font-size: 14px; line-height: 20px; }
.navbar-expand-lg .elementor-widget-litho-mega-menu .toggle-menu-word { display: inline-block; color: #232323; font-size: 15px; margin: 0 6px 0 0; position: relative; top: 2px; }
.header-push-button .toggle-menu-word { color: #232323;}
.left-menu-modern .header-push-button .toggle-menu-word { font-size: 14px; margin-right: 8px; }
.left-menu-modern .header-push-button .toggle-menu-word ~ .push-button { margin: 0; }

/* navigation edit */
.edit-litho-section { display: none; }
<?php
$litho_litho_mobile_animation_enable = get_theme_mod( 'litho_litho_mobile_animation_enable', '0' );
if ( 0 == $litho_litho_mobile_animation_enable ) { // phpcs:ignore
	?>
	/* Turn Off animations in devices */
	.elementor-invisible, .litho-elementor-visible, .litho-animated, .animated { -webkit-animation: none !important; -moz-animation: none important; -o-animation: none !important; -ms-animation: none !important; animation: none !important; visibility: visible !important; animation-duration: 0ms !important;
	}
	<?php
}
?>
}

@media (max-width: 991px) {
/* hamburger menu modern */
.hamburger-menu-modern { width:55%; }
.hamburger-menu-wrapper .hamburger-menu .full-screen { height: 100vh !important; }

/* menu modern */
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-collapse { padding-left: 7vw; padding-right: 7vw; }

/* full screen menu */
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .mCustomScrollBox { width: 55%; }
}

@media (max-width: 782px) {
.admin-bar.navbar-collapse-show[data-mobile-nav-style=classic] .sticky .header-common-wrapper { top: 46px !important; }
}

@media (max-width: 767px) {
/* navigation */
.navbar-nav { padding-left: 0; padding-right: 0; }
.header-common-wrapper .extra-small-icon li { margin: 0 5px; }
.navbar-nav .nav-link, .navbar-expand-lg .navbar-nav .nav-link { padding-left: 15px; padding-right: 15px; }
.nav-item > .dropdown-toggle { right: 0; }
.nav-item.dropdown.megamenu .menu-back-div, header .sub-menu, .simple-dropdown .sub-menu { padding: 30px 30px 15px; }
.dropdown-menu.megamenu-content .litho-navigation-menu { margin-bottom: 15px; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item > a { padding-left: 0; padding-right: 0; }
.nav-item.dropdown.simple-dropdown .dropdown-menu > .dropdown:last-child, .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item:last-child { margin-bottom: 20px; }
.dropdown-menu.megamenu-content li a, .simple-dropdown .sub-menu a, .simple-dropdown .sub-menu li .handler { font-size: 14px; }
.sticky .shrink-nav.navbar-nav .nav-link, .sticky .shrink-nav.navbar-expand-lg .navbar-nav .nav-link { padding-left: 15px; padding-right: 15px; }
.header-with-mini-header .navbar-collapse { max-height: calc(100vh - 70px); }

/* hamburger */
.hamburger-menu-wrapper .hamburger-menu .close-menu { right: 0; top: 0; }
.hamburger-menu-half .hamburger-menu .elementor,
.hamburger-menu-half .hamburger-menu .elementor-inner,
.hamburger-menu-half .hamburger-menu .elementor-section-wrap,
.hamburger-menu-half .hamburger-menu .elementor-section-wrap > .elementor-section,
.hamburger-menu-half .hamburger-menu .elementor-container { height: 100%; }

/* hamburger menu modern */
.hamburger-menu-modern .litho-left-menu li a { font-size: 24px; line-height: 30px; }
.hamburger-menu-modern { width: 100%; }
.hamburger-menu-modern .litho-left-menu-wrap { height: calc(100vh - 100px); }

/* hamburger half */
.hamburger-menu-half { width: 100%; }
.hamburger-menu-half .litho-left-menu-wrap { height: calc(100vh - 150px); }

/* sidebar nav style 1 */
.left-sidebar-wrapper .header-left-wrapper .navbar-toggler { right: 15px; top: 26px; }

/* sidebar nav style 2 */
.left-menu-modern .hamburger-menu { width: 100%; left: -100%; }

/* menu modern */
.navbar-collapse-show[data-mobile-nav-style=modern] .navbar, .navbar-collapse-show[data-mobile-nav-style=modern] .page-layout, .navbar-collapse-show[data-mobile-nav-style=modern] .top-bar, .navbar-collapse-show[data-mobile-nav-style=modern] footer { -webkit-transform: translate3d(-70vw, 0, 0); transform: translate3d(-70vw, 0, 0); }
[data-mobile-nav-style=modern] .navbar-modern-inner { width: 70vw; }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-collapse { padding-right: 12vw; padding-left: 12vw; }
[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .navbar-modern-inner { width: 70vw; }
[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .navbar-modern-inner .navbar-collapse { padding-right: 12vw; padding-left: 12vw; }
.navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .navbar, .navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .page-layout, .navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .top-bar, .navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] footer { -webkit-transform: translate3d(70vw, 0, 0); transform: translate3d(70vw, 0, 0); }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item:last-child { margin-bottom: 0}
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column ul { margin-bottom: 15px; }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column:last-child ul { margin-bottom: 0; }

/* full screen menu */
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-collapse { padding: 60px 0 }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-toggler { top: 20px; right: 20px; }
[data-mobile-nav-style=full-screen-menu] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column ul { margin-bottom: 15px; }
[data-mobile-nav-style=full-screen-menu] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column:last-child ul { margin-bottom: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .mCustomScrollBox { width: 75%; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.megamenu .menu-back-div ul { margin-bottom: 15px; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column:last-child ul { margin-bottom: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .megamenu-content h5 { margin-bottom: 18px; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .dropdown-menu.megamenu-content li, [data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu .dropdown .dropdown-menu { padding-bottom: 15px; margin-bottom: 0; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item:last-child { margin-bottom: 0}

/* toggler menu text */
.admin-bar .left-sidebar-wrapper .header-left-wrapper .toggle-menu-word { margin-top: 8px; }

}

@media (max-width: 575px) {
/* modern menu */
.navbar-collapse-show[data-mobile-nav-style=modern] .navbar, .navbar-collapse-show[data-mobile-nav-style=modern] .page-layout, .navbar-collapse-show[data-mobile-nav-style=modern] .top-bar, .navbar-collapse-show[data-mobile-nav-style=modern] footer { -webkit-transform: translate3d(-85vw, 0, 0); transform: translate3d(-85vw, 0, 0); }
[data-mobile-nav-style=modern] .navbar-modern-inner { width: 85vw; }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-collapse { padding-right: 10vw; padding-left: 10vw; }
[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .navbar-modern-inner { width: 85vw; }
[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .navbar-modern-inner .navbar-collapse { padding-right: 10vw; padding-left: 10vw; }
.navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .navbar, .navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .page-layout, .navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] .top-bar, .navbar-collapse-show[data-mobile-nav-style=modern][data-mobile-nav-trigger-alignment=left] footer { -webkit-transform: translate3d(85vw, 0, 0); transform: translate3d(85vw, 0, 0); }
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.simple-dropdown .dropdown-menu > .menu-item:last-child { margin-bottom: 0}
[data-mobile-nav-style=modern] .navbar-modern-inner .nav-item.dropdown.megamenu .menu-back-div .elementor-column:last-child ul { margin-bottom: 0; }
}
@media (max-width: 600px) {
.admin-bar.navbar-collapse-show[data-mobile-nav-style=classic] .sticky .header-common-wrapper { top: 0 !important; }
.admin-bar .left-sidebar-wrapper .sticky .header-left-wrapper .toggle-menu-word { margin-top: 0; }
}

@media (max-height: 600px) {

/* modern menu */
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-collapse { padding-top: 30px; padding-bottom: 30px; }
[data-mobile-nav-style=modern] .navbar-modern-inner .navbar-toggler { right: 15px; top: 15px; }

/* full screen menu */
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-collapse { padding-top: 30px; padding-bottom: 30px; }
[data-mobile-nav-style=full-screen-menu] .navbar-full-screen-menu-inner .navbar-toggler { right: 15px; top: 15px; }
}
