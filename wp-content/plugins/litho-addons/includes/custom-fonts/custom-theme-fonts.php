<?php
namespace LithoAddons\Custom_fonts;

/**
 * Custom Fonts Initialize
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

// If class `Custom_Theme_Fonts` doesn't exists yet.
if ( ! class_exists( 'Custom_Theme_Fonts' ) ) {

	/**
	 * Define Custom_Theme_Fonts class
	 */
	class Custom_Theme_Fonts {

		const ADOBE_TYPEKIT_EMBED = 'https://use.typekit.net/%s.css';
		/**
		 * Constructor
		 */
		public function __construct() {
			// Add custom font group.
			add_filter( 'elementor/fonts/groups', [ $this, 'litho_add_fonts_groups' ] );
			add_filter( 'elementor/fonts/additional_fonts', [ $this, 'litho_add_additional_fonts' ] );
			// Enqueue adobe fonts.
			add_action( 'wp_enqueue_scripts', [ $this, 'litho_adobe_font_css' ] );

			// Render custom font CSS.
			add_action( 'elementor/css-file/post/parse', [ $this, 'litho_enqueue_fonts' ] );
			add_action( 'elementor/css-file/global/parse', [ $this, 'litho_enqueue_fonts' ] );
			// Render custom font Preview with Editor.
			add_action( 'elementor/ajax/register_actions', [ $this, 'litho_register_ajax_actions' ] );
		}

		public function litho_add_fonts_groups( $font_groups ) {

			$litho_custom_fonts   = '';
			$litho_get_fonts_list = $this->litho_get_custom_fonts();

			if ( ! empty( $litho_get_fonts_list ) ) {
				$litho_custom_fonts = array( 'custom' => esc_html__( 'Theme Fonts', 'litho-addons' ) );
				$font_groups        = array_merge( $litho_custom_fonts, $font_groups );
			}

			$litho_adobe_font = apply_filters( 'litho_adobe_font', array() );
			if ( ! empty( $litho_adobe_font ) ) {
				$litho_adobe_fonts = array( 'adobe' => esc_html__( 'Adobe Fonts', 'litho-addons' ) );
				$font_groups       = array_merge( $litho_adobe_fonts, $font_groups );
			}

			return $font_groups;
		}

		public function litho_add_additional_fonts( $additional_fonts ) {

			$litho_get_fonts_list = $this->litho_get_custom_fonts();

			if ( is_array( $litho_get_fonts_list ) && ! empty( $litho_get_fonts_list ) ) {
				foreach ( $litho_get_fonts_list as $key => $val ) {
					if ( ! empty( $val[0] ) ) {
						$additional_fonts[ $val[0] ] = 'custom';
					}
				}
			}

			$litho_adobe_font = apply_filters( 'litho_adobe_font', array() );

			if ( ! empty( $litho_adobe_font ) ) {
				foreach ( $litho_adobe_font as $adobe_font_family => $adobe_fonts_url ) {
					$font_slug = ( isset( $adobe_fonts_url['slug'] ) ) ? $adobe_fonts_url['slug'] : '';
					$font_css  = ( isset( $adobe_fonts_url['css_names'][0] ) ) ? $adobe_fonts_url['css_names'][0] : $font_slug;

					$additional_fonts[ $font_css ] = 'adobe';
				}
			}

			return $additional_fonts;
		}

		public function litho_enqueue_fonts( $post_css ) {

			$litho_custom_css     = '';
			$litho_get_fonts_list = $this->litho_get_custom_fonts();

			if ( is_array( $litho_get_fonts_list ) && ! empty( $litho_get_fonts_list ) ) {
				ob_start();

				foreach ( $litho_get_fonts_list as $key => $fonts ) {
					if ( ! empty( $fonts[0] ) ) {
						?>
							@font-face {
								<?php echo ! empty( $fonts[0] ) ? "font-family: '" . esc_attr( $fonts[0] ) . "';" : ''; ?>
								<?php echo ! empty( $fonts[1] ) ? "src: url( '" . esc_url( $fonts[1] ) . "' ) format('woff2');" : ''; ?>
								<?php echo ! empty( $fonts[2] ) ? "src: url( '" . esc_url( $fonts[2] ) . "' ) format('woff');" : ''; ?>
								<?php echo ! empty( $fonts[3] ) ? "src: url( '" . esc_url( $fonts[3] ) . "' ) format('truetype');" : ''; ?>
								<?php echo ! empty( $fonts[4] ) ? "src: url( '" . esc_url( $fonts[4] ) . "' ) format('embedded-opentype');" : ''; ?>
							}
						<?php
					}
				}
				$litho_custom_css .= ob_get_contents();
				ob_end_clean();
				$post_css->get_stylesheet()->add_raw_css( $litho_custom_css );
			}
		}

		public function litho_adobe_font_css() {

			$litho_adobe_font = apply_filters( 'litho_adobe_font', array() );
			$litho_adobe_id   = get_option( 'litho_adobe_font_id' );

			if ( empty( $litho_adobe_font ) ) {
				return false;
			}

			$adobe_url = sprintf( self::ADOBE_TYPEKIT_EMBED, $litho_adobe_id );

			wp_enqueue_style( 'litho-adobe-font', $adobe_url, array() );
		}

		public function litho_get_custom_fonts() {

			$litho_theme_custom_fonts = get_theme_mod( 'litho_custom_fonts', '' );
			$litho_theme_custom_fonts = ( ! empty( $litho_theme_custom_fonts ) ) ? json_decode( $litho_theme_custom_fonts ) : array();
			return $litho_theme_custom_fonts;
		}

		public function litho_register_ajax_actions( Ajax $ajax ) {

			$ajax->register_ajax_action( 'Litho_CustomFonts_action_data', [ $this, 'litho_fonts_preview' ] );
		}

		public function litho_fonts_preview() {

			$litho_custom_css     = '';
			$litho_get_fonts_list = $this->litho_get_custom_fonts();

			if ( is_array( $litho_get_fonts_list ) && ! empty( $litho_get_fonts_list ) ) {
				ob_start();
				foreach ( $litho_get_fonts_list as $key => $fonts ) {
					if ( ! empty( $fonts[0] ) ) {
						?>
							@font-face {
								<?php echo ! empty( $fonts[0] ) ? "font-family: '" . esc_attr( $fonts[0] ) . "';" : ''; ?>
								<?php echo ! empty( $fonts[1] ) ? "src: url( '" . esc_url( $fonts[1] ) . "' ) format('woff2');" : ''; ?>
								<?php echo ! empty( $fonts[2] ) ? "src: url( '" . esc_url( $fonts[2] ) . "' ) format('woff');" : ''; ?>
								<?php echo ! empty( $fonts[3] ) ? "src: url( '" . esc_url( $fonts[3] ) . "' ) format('truetype');" : ''; ?>
								<?php echo ! empty( $fonts[4] ) ? "src: url( '" . esc_url( $fonts[4] ) . "' ) format('embedded-opentype');" : ''; ?>
							}
						<?php
					}
				}
				$litho_custom_css .= ob_get_contents();
				ob_end_clean();
				return [
					'font_face' => $litho_custom_css,
				];
			}
		}
	}
}
