<?php
/**
 * This file use for define custom functions, conditions etc...
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'is_litho_addons_activated' ) ) {
	/**
	 * Check if Litho Addons is active
	 */
	function is_litho_addons_activated() {
		return class_exists( 'Litho_Addons' ) ? true : false;
	}
}

if ( ! function_exists( 'is_elementor_activated' ) ) {
	/**
	 * Check if Elementor is active
	 */
	function is_elementor_activated() {
		return defined( 'ELEMENTOR_VERSION' ) ? true : false;
	}
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	/**
	 * Check if WooCommerce is active
	 */
	function is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'litho_update_theme_license' ) ) {
	/**
	 * Update theme license purchase code.
	 *
	 * @param string $code License purchase code.
	 */
	function litho_update_theme_license( $code ) {

		update_option( 'litho_green_light_pcode', $code );
		if ( empty( $code ) ) {
			$plugins = array(
				'litho-addons/litho-addons.php',
				'revslider/revslider.php',
			);
			// Deactivate plugins.
			deactivate_plugins( $plugins );
			// Delete plugins.
			delete_plugins( $plugins );
		}
	}
}

if ( ! function_exists( 'is_theme_license_active' ) ) {
	/**
	 * Check theme license active or not
	 */
	function is_theme_license_active() {

		$purchase_code = litho_get_theme_license();
		if ( ! empty( $purchase_code ) || defined( 'ENVATO_HOSTED_SITE' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'litho_get_theme_license' ) ) {
	/**
	 * Get theme license purchase code
	 */
	function litho_get_theme_license() {

		return get_option( 'litho_green_light_pcode' );
	}
}

if ( ! function_exists( 'litho_get_encrypt_theme_license' ) ) {
	/**
	 * Get theme license encrypted purchase code
	 */
	function litho_get_encrypt_theme_license() {

		$purchase_code = litho_get_theme_license();
		if ( ! empty( $purchase_code ) ) {
			$data    = explode( '-', $purchase_code );
			$data[2] = 'xxxx';
			$data[3] = 'xxxx';
			$data[4] = 'xxxxxxxxxxxx';
			return implode( '-', $data );
		}
		return '';
	}
}

if ( ! function_exists( 'litho_elementor_edit_mode' ) ) {
	/**
	 * Check page/post edit with elementor
	 */
	function litho_elementor_edit_mode() {

		global $post;

		if ( ! is_elementor_activated() ) {
			return true;
		}

		if ( ( is_search() || is_archive() || is_home() || is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) || ( is_woocommerce_activated() && is_shop() ) ) {

			return true;

		} elseif ( isset( $post->ID ) ) {

			$edit_mode = get_post_meta( $post->ID, '_elementor_edit_mode', true );

			if ( 'builder' === $edit_mode ) {

				return false;

			} else {

				return true;
			}
		} else {

			return false;
		}
	}
}

if ( ! function_exists( 'litho_pingback_header' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function litho_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
		}
	}
}
add_action( 'wp_head', 'litho_pingback_header', 1 );

if ( ! function_exists( 'litho_widgets' ) ) {
	/**
	 * Register custom sidebars
	 */
	function litho_widgets() {

		$litho_custom_sidebars = get_theme_mod( 'litho_custom_sidebars', '' );
		$litho_custom_sidebars = explode( ',', $litho_custom_sidebars );

		if ( is_array( $litho_custom_sidebars ) ) {
			foreach ( $litho_custom_sidebars as $sidebar ) {

				if ( empty( $sidebar ) ) {
					continue;
				}

				register_sidebar(
					array(
						'name'          => $sidebar,
						'id'            => sanitize_title( $sidebar ),
						'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="widget-title">',
						'after_title'   => '</div>',
					)
				);
			}
		}
	}
}
add_action( 'widgets_init', 'litho_widgets' );

if ( ! function_exists( 'litho_get_post_types' ) ) {
	/**
	 * Return post types array
	 *
	 * @param array $args Args of post type.
	 */
	function litho_get_post_types( $args = [] ) {

		$post_type_args = [
			// Default is the value $public.
			'show_in_nav_menus' => true,
		];

		// Keep for backwards compatibility.
		if ( ! empty( $args['post_type'] ) ) {
			$post_type_args['name'] = $args['post_type'];
			unset( $args['post_type'] );
		}

		$post_type_args = wp_parse_args( $post_type_args, $args );

		$_post_types = get_post_types( $post_type_args, 'objects' );

		$post_types = [];

		foreach ( $_post_types as $post_type => $object ) {
			if ( 'e-landing-page' !== $post_type ) {
				$post_types[ $post_type ] = $object->label;
			}
		}

		/**
		 * Apply filters for get all post types so user can add its post types.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'litho_get_post_types/get_public_post_types', $post_types );
	}
}

if ( ! function_exists( 'litho_search_pre_get_posts' ) ) {
	/**
	 * Customize for search with multiple posts. For example, post, page, portfolio or any custom post type
	 *
	 * @param object $query Object of post.
	 */
	function litho_search_pre_get_posts( $query ) {

		if ( ! is_admin() && $query->is_main_query() ) {

			if ( is_search() ) {

				$litho_search_content_setting = get_theme_mod( 'litho_search_content_setting', 'page, post' );
				$litho_search_content_setting = ( ! empty( $litho_search_content_setting ) && is_string( $litho_search_content_setting ) ) ? explode( ',', $litho_search_content_setting ) : array();

				if ( ! empty( $litho_search_content_setting ) ) {

					$query->set( 'post_type', $litho_search_content_setting );
				}
			}
		}
	}
}
add_action( 'pre_get_posts', 'litho_search_pre_get_posts' );

if ( ! function_exists( 'litho_get_builder_section_data' ) ) {
	/**
	 * To get section builder template list
	 */
	function litho_get_builder_section_data( $section_type = '', $meta = false, $general = false ) {

		$builder_section_data = array();

		if ( empty( $section_type ) ) {
			return $builder_section_data;
		}

		$litho_filter_section = ( $section_type ) ? array( 'key' => '_litho_section_builder_template', 'value' => $section_type, 'compare' => '=' ) : array(); // phpcs:ignore

		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'sectionbuilder',
			'post_status'    => 'publish',
			'meta_query'     => array(
				$litho_filter_section,
			),
		);

		$posts_data = get_posts( $args );

		if ( $meta ) {
			$builder_section_data['default'] = esc_html__( 'Default', 'litho' );

		} elseif ( $general ) {
			$builder_section_data[''] = esc_html__( 'General', 'litho' );

		} else {
			$builder_section_data[''] = esc_html__( 'Select', 'litho' );
		}

		if ( ! empty( $posts_data ) ) {

			foreach ( $posts_data as $key => $value ) {

				$builder_section_data[ $value->ID ] = esc_html( $value->post_title );
			}
		}
		return $builder_section_data;
	}
}

if ( ! function_exists( 'litho_remove_font_family_action_data' ) ) {
	/**
	 * AJAX callback to load litho custom fonts
	 */
	function litho_remove_font_family_action_data() {

		if ( ! isset( $_POST['fontfamily'] ) || empty( $_POST['fontfamily'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			return;
		}
		$fontfamily           = $_POST['fontfamily']; // phpcs:ignore
		$fontfamily           = str_replace( ' ', '-', $fontfamily );
		$filesystem           = Litho_filesystem::init_filesystem();
		$upload_dir           = wp_upload_dir();
		$srcdir               = untrailingslashit( wp_normalize_path( $upload_dir['basedir'] ) ) . '/litho-fonts/' . $fontfamily;// phpcs:ignore WordPress.Security.NonceVerification.Missing
		$targetdir            = untrailingslashit( wp_normalize_path( $upload_dir['basedir'] ) ) . '/litho-fonts/litho-temp-fonts';
		$font_family_location = $targetdir . '/' . $fontfamily;

		if ( ! file_exists( $targetdir ) ) {
			wp_mkdir_p( $targetdir );
		}

		if ( ! file_exists( $font_family_location ) ) {
			wp_mkdir_p( $font_family_location );
		}

		if ( file_exists( $srcdir ) ) {
			copy_dir( $srcdir, $font_family_location );
			$filesystem->delete( $srcdir, FS_CHMOD_DIR );
		} else {
			return true;
		}
		die();
	}
}
add_action( 'wp_ajax_litho_remove_font_family_action_data', 'litho_remove_font_family_action_data' );
add_action( 'wp_ajax_nopriv_litho_remove_font_family_action_data', 'litho_remove_font_family_action_data' );

if ( ! function_exists( 'litho_sanitize_multiple_checkbox' ) ) {
	/**
	 * Custom sanitize function for Validate the multiple checkbox field.
	 *
	 * @param mixed $values Optional. Default value.
	 */
	function litho_sanitize_multiple_checkbox( $values ) {
		$litho_multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
		return ! empty( $litho_multi_values ) ? array_map( 'sanitize_text_field', $litho_multi_values ) : array();
	}
}

if ( ! function_exists( 'litho_deregister_section' ) ) {
	/**
	 * Customizer deregister section
	 *
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 */
	function litho_deregister_section( $wp_customize ) {

		// Remove the section for colors.
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_control( 'display_header_text' );
		// Change site icon section.
		$wp_customize->get_control( 'site_icon' )->section = 'litho_add_logo_favicon_panel';
	}
}
add_action( 'customize_register', 'litho_deregister_section', 999 );

if ( ! function_exists( 'litho_font_list' ) ) {

	/**
	 * Retrieve font lists
	 *
	 * @param array $subsets Subsets of fonts.
	 */
	function litho_font_list( $subsets = array() ) {
		/**
		 * Apply filters to retrieve font lists so user can add its fonts.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'litho_font_list', array(), $subsets );
	}
}

if ( ! function_exists( 'litho_google_fonts_list' ) ) {

	/**
	 * Retrieve google font lists
	 *
	 * @param array $fonts_array Array of google fonts.
	 */
	function litho_google_fonts_list( $fonts_array ) {

		$litho_google_fonts      = litho_googlefonts_list();
		$litho_google_font_array = array();

		foreach ( $litho_google_fonts as $fontkey => $fontvalue ) {

			$litho_google_font_array[ $fontvalue ] = $fontvalue;
		}

		$fonts_array['google'] = $litho_google_font_array;

		return $fonts_array;
	}
}
add_filter( 'litho_font_list', 'litho_google_fonts_list' );

if ( ! function_exists( 'litho_enqueue_fonts_url' ) ) {

	/**
	 * Enqueue theme google fonts
	 */
	function litho_enqueue_fonts_url() {
		/*
		 * Load google font
		 */
		$litho_font_list         = array();
		$litho_font_subsets      = '';
		$litho_enable_main_font  = get_theme_mod( 'litho_enable_main_font', '1' );
		$litho_enable_alt_font   = get_theme_mod( 'litho_enable_alt_font', '1' );
		$litho_main_font         = get_theme_mod( 'litho_main_font', 'Roboto' );
		$litho_alt_font          = get_theme_mod( 'litho_alt_font', 'Poppins' );
		$litho_main_font_weight  = get_theme_mod( 'litho_main_font_weight', array( '100', '300', '400', '500', '700', '900' ) );
		$litho_main_font_subsets = get_theme_mod( 'litho_main_font_subsets', array( 'cyrillic', 'cyrillic-ext', 'greek', 'greek-ext', 'latin-ext', 'vietnamese' ) );
		$litho_alt_font_weight   = get_theme_mod( 'litho_alt_font_weight', array( '100', '200', '300', '400', '500', '600', '700', '800', '900' ) );
		$litho_main_font_display = get_theme_mod( 'litho_main_font_display', 'swap' );
		$font_list               = litho_font_list();
		$google_font_list        = ! empty( $font_list['google'] ) ? $font_list['google'] : array();

		/* Enable Main Font */
		if ( '1' == $litho_enable_main_font && $litho_main_font && array_key_exists( $litho_main_font, $google_font_list ) ) {

			/* For Main Font Weight */
			if ( ! empty( $litho_main_font_weight ) ) {
				$litho_main_font_weight = implode( ',', $litho_main_font_weight );
				$litho_font_list[]      = $litho_main_font . ':' . $litho_main_font_weight;
			} else {
				$litho_font_list[] = $litho_main_font;
			}

			/* For Main Font Subsets */
			if ( ! empty( $litho_main_font_subsets ) ) {
				$litho_font_subsets = implode( ',', $litho_main_font_subsets );
			} else {
				$litho_font_subsets = false;
			}
		}

		/* Enable Alt Main Font */
		if ( '1' == $litho_enable_alt_font && $litho_alt_font && array_key_exists( $litho_alt_font, $google_font_list ) ) {

			/* For Alt Font Weight */
			if ( ! empty( $litho_alt_font_weight ) ) {
				$litho_alt_font_weight = implode( ',', $litho_alt_font_weight );
				$litho_font_list[]     = $litho_alt_font . ':' . $litho_alt_font_weight;
			} else {
				$litho_font_list[] = $litho_alt_font;
			}

			/* For Main Font Subsets */
			if ( ! empty( $litho_main_font_subsets ) ) {
				$litho_font_subsets = implode( ',', $litho_main_font_subsets );
			} else {
				$litho_font_subsets = false;
			}
		}

		/**
		 * Apply filters to load another google fonts
		 *
		 * @since 1.0
		 */
		$litho_google_font_list = apply_filters( 'litho_google_font', array() );
		if ( ! empty( $litho_google_font_list ) ) {

			$litho_font_list = array_merge( $litho_font_list, $litho_google_font_list );
		}

		/**
		 * Apply filters to load another google font subsets
		 *
		 * @since 1.0
		 */
		$litho_font_subsets = apply_filters( 'litho_google_font_subset', $litho_font_subsets );

		/* Check Google Fonts are not empty */
		if ( ! empty( $litho_font_list ) ) {

			$google_font_args = array(
				'family' => urlencode( implode( '|', $litho_font_list ) ),
				'subset' => urlencode( $litho_font_subsets ),
			);

			if ( ! empty( $litho_main_font_display ) ) {

				$google_font_args['display'] = $litho_main_font_display;
			}

			$litho_google_font_url = add_query_arg( $google_font_args, '//fonts.googleapis.com/css' );

			/* Google Font URL */
			return $litho_google_font_url;

		} else {

			return;
		}
	}
}

if ( ! function_exists( 'litho_enqueue_abobe_fonts_url' ) ) {

	/**
	 * Enqueue theme adobe fonts
	 */
	function litho_enqueue_abobe_fonts_url() {

		$url             = '';
		$adobe_font_list = array();
		$litho_main_font = get_theme_mod( 'litho_main_font', 'Roboto' );
		$litho_alt_font  = get_theme_mod( 'litho_alt_font', 'Poppins' );

		$font_list = litho_font_list();
		if ( ! empty( $font_list['Adobe fonts'] ) ) {
			$adobe_font_list = $font_list['Adobe fonts'];
		}

		$litho_enable_adobe_font = get_theme_mod( 'litho_enable_adobe_font', '0' );
		$litho_adobe_font_id     = get_theme_mod( 'litho_adobe_font_id', '' );

		if ( '1' == $litho_enable_adobe_font && $litho_adobe_font_id ) {
			// Check Select Adobe Font.
			if ( array_key_exists( $litho_main_font, $adobe_font_list ) || array_key_exists( $litho_alt_font, $adobe_font_list ) ) {
				$url = 'https://use.typekit.net/' . $litho_adobe_font_id . '.css'; // phpcs:ignore
			}
		}

		return $url;
	}
}

if ( ! function_exists( 'litho_get_intermediate_image_sizes' ) ) {

	/**
	 * Return all image sizes
	 */
	function litho_get_intermediate_image_sizes() {
		global $wp_version;
		$image_sizes = array( 'full', 'thumbnail', 'medium', 'medium_large', 'large' ); // Standard sizes.
		if ( $wp_version >= '4.7.0' ) {
			$_wp_additional_image_sizes = wp_get_additional_image_sizes();
			if ( ! empty( $_wp_additional_image_sizes ) ) {
				$image_sizes = array_merge( $image_sizes, array_keys( $_wp_additional_image_sizes ) );
			}
			/**
			 * Apply filters to get image sizes
			 *
			 * @since 1.0
			 */
			return apply_filters( 'intermediate_image_sizes', $image_sizes );
		} else {
			return $image_sizes;
		}
	}
}

if ( ! function_exists( 'litho_get_image_sizes' ) ) {
	/**
	 * Return all image sizes
	 */
	function litho_get_image_sizes() {

		global $_wp_additional_image_sizes;
		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'full', 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}
		return $sizes;
	}
}

if ( ! function_exists( 'litho_get_image_size' ) ) {
	/**
	 * Return image size
	 *
	 * @param mixed $size Size.
	 */
	function litho_get_image_size( $size ) {
		$sizes = litho_get_image_sizes();

		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		}

		return false;
	}
}

if ( ! function_exists( 'litho_register_sidebar_customizer_array' ) ) {
	/**
	 * Return Register Sidebars list in Customize
	 */
	function litho_register_sidebar_customizer_array() {
		global $wp_registered_sidebars;

		if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
			$sidebar_array     = array();
			$sidebar_array[''] = esc_html__( 'No Sidebar', 'litho' );

			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebar_array[ $sidebar['id'] ] = $sidebar['name'];
			}
		}
		return $sidebar_array;
	}
}

if ( ! function_exists( 'litho_option' ) ) {
	/**
	 * Return meta options or customize settings
	 */
	function litho_option( $option, $default_value ) {

		global $post;
		$litho_option_value = '';

		if ( is_404() ) {
			$litho_option_value = get_theme_mod( $option, $default_value );

		} else {

			if ( ( ! ( is_category() || is_archive() || is_author() || is_tag() || is_search() || is_home() || is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) || ( is_woocommerce_activated() && is_shop() ) ) && isset( $post->ID ) ) {

				// Meta Prefix.
				$meta_prefix = '_';

				if ( is_woocommerce_activated() && is_shop() ) {

					$page_id = wc_get_page_id( 'shop' );
					$option  = str_replace( '_product_archive_', '_page_', $option );
					$value   = get_post_meta( $page_id, $meta_prefix . $option . '_single', true );

				} else {
					$value = get_post_meta( $post->ID, $meta_prefix . $option . '_single', true );
				}

				if ( is_string( $value ) && ( strlen( $value ) > 0 || is_array( $value ) ) && ( $value !== 'default' ) ) {
					if ( strtolower( $value ) == '.' ) {
						$litho_option_value = '';
					} else {
						$litho_option_value = $value;
					}
				} else {
					$litho_option_value = get_theme_mod( $option, $default_value );
				}
			} else {
				$litho_option_value = get_theme_mod( $option, $default_value );
			}
		}

		return $litho_option_value;
	}
}

if ( ! function_exists( 'litho_builder_customize_option' ) ) {
	/**
	 * Return customize settings
	 */
	function litho_builder_customize_option( $option, $default_value, $general_option = false ) {

		if ( $general_option ) {

			return get_theme_mod( $option, $default_value );
		}

		if ( is_404() ) { // if 404 page.

			$litho_option_value = get_theme_mod( $option . '_404_page', $default_value );

		} elseif ( is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() ) ) { // if WooCommerce plugin is activated and WooCommerce category, brand, shop page.

			$litho_option_value = get_theme_mod( $option . '_product_archive', $default_value );

		} elseif ( is_woocommerce_activated() && is_product() ) { // if WooCommerce plugin is activated and WooCommerce product page.

			$litho_option_value = get_theme_mod( $option . '_single_product', $default_value );

		} elseif ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) { // if Portfolio archive.

			$litho_option_value = get_theme_mod( $option . '_portfolio_archive', $default_value );

		} elseif ( is_singular( 'portfolio' ) ) { // if single portfolio.

			$litho_option_value = get_theme_mod( $option . '_single_portfolio', $default_value );

		} elseif ( is_search() || is_category() || is_archive() || is_tag() ) {

			$litho_option_value = get_theme_mod( $option . '_archive', $default_value );

		} elseif ( is_home() ) {

			$litho_option_value = get_theme_mod( $option . '_default', $default_value );

		} elseif ( is_single() ) {

			$litho_option_value = get_theme_mod( $option . '_single_post', $default_value );

		} elseif ( is_page() ) {

			$litho_option_value = get_theme_mod( $option . '_single_page', $default_value );

		} else {

			$litho_option_value = get_theme_mod( $option, $default_value );
		}

		if ( '' == $litho_option_value ) {

			$litho_option_value = get_theme_mod( $option, $default_value );
		}

		return $litho_option_value;
	}
}

if ( ! function_exists( 'litho_builder_option' ) ) {
	/**
	 * Return meta options and customize settings in Section Builder
	 */
	function litho_builder_option( $option, $default_value, $general_option = false ) {

		global $post;
		$litho_option_value = '';

		if ( is_404() ) {

			if ( $general_option ) {

				return get_theme_mod( $option, $default_value );
			}

			$litho_option_value = get_theme_mod( $option . '_404_page', $default_value );

		} else {

			if ( ( ! ( is_category() || is_archive() || is_author() || is_tag() || is_search() || is_home() || is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) || ( is_woocommerce_activated() && is_shop() ) ) && isset( $post->ID ) ) {

				// Meta Prefix.
				$meta_prefix = '_';

				if ( is_woocommerce_activated() && is_shop() ) {

					$page_id = wc_get_page_id( 'shop' );
					$option  = str_replace( '_product_archive_', '_page_', $option );
					$value   = get_post_meta( $page_id, $meta_prefix . $option . '_single', true );

				} else {
					$value = get_post_meta( $post->ID, $meta_prefix . $option . '_single', true );
				}

				if ( is_string( $value ) && ( strlen( $value ) > 0 || is_array( $value ) ) && ( $value != 'default' ) ) {
					if ( strtolower( $value ) == '.' ) {
						$litho_option_value = '';
					} else {
						$litho_option_value = $value;
					}
				} else {
					$litho_option_value = litho_builder_customize_option( $option, $default_value, $general_option );
				}
			} else {
				$litho_option_value = litho_builder_customize_option( $option, $default_value, $general_option );
			}
		}
		return $litho_option_value;
	}
}

if ( ! function_exists( 'litho_post_meta' ) ) {
	/**
	 * Return post meta value
	 */
	function litho_post_meta( $option ) {
		global $post;

		if ( empty( $post->ID ) ) {
			return;
		}
		// Meta Prefix.
		$meta_prefix = '_';
		$value       = get_post_meta( $post->ID, $meta_prefix . $option . '_single', true );
		return $value;
	}
}

if ( ! function_exists( 'litho_post_meta_by_id' ) ) {
	/**
	 * Return post meta id
	 */
	function litho_post_meta_by_id( $id, $option ) {
		if ( ! $id ) {
			return;
		}
		// Meta Prefix.
		$meta_prefix = '_';
		$value       = get_post_meta( $id, $meta_prefix . $option, true );
		return $value;
	}
}

if ( ! function_exists( 'litho_post_category' ) ) {
	/**
	 * Return post category / tags
	 */
	function litho_post_category( $id, $separator = true, $count = '10', $terms = 'category' ) {

		if ( '' == $id ) {
			return;
		}

		$post_term_arr = array();
		$post_terms    = '';

		if ( 'post' === get_post_type() ) {

			if ( 'category' === $terms ) {
				$categories       = get_the_category( $id );
				$category_counter = 0;
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $cat ) {
						if ( $count == $category_counter ) {
							break;
						}
						$cat_link   = get_category_link( $cat->cat_ID );
						$post_term_arr[] = '<a rel="category tag" href="' . esc_url( $cat_link ) . '">' . esc_html( $cat->name ) . '</a>';
						$category_counter++;
					}
				}
			} else {
				$tags         = get_the_tags( $id );
				$tags_counter = 0;
				if ( ! empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						if ( $count == $tags_counter ) {
							break;
						}
						$tag_link   = get_tag_link( $tag->term_id );
						$post_term_arr[] = '<a rel="category tag" href="' . esc_url( $tag_link ) . '">' . esc_html( $tag->name ) . '</a>';
						$tags_counter++;
					}
				}
			}

			if ( $separator == true ) {
				$post_terms = ! empty( $post_term_arr ) ? implode( ', ', $post_term_arr ) : '';
			} else {
				$post_terms = ! empty( $post_term_arr ) ? implode( '', $post_term_arr ) : '';
			}

		}
		return $post_terms;
	}
}

if ( ! function_exists( 'litho_single_post_meta_category' ) ) {
	/**
	 * Get the Post Category.
	 */
	function litho_single_post_meta_category( $id, $icon = false ) {

		if ( '' == $id ) {
			return;
		}

		if ( 'post' == get_post_type() ) {
			$icon_data        = '';
			$litho_term_limit = apply_filters( 'litho_single_post_category_limit', '40' );
			$category_list    = litho_post_category( $id, true, $litho_term_limit );
			if ( $icon ) {
				$icon_data = '<i class="feather icon-feather-folder text-fast-blue"></i>';
			}
			if ( $category_list ) {
				printf( '<li>%1$s%2$s</li>', $icon_data, $category_list ); // phpcs:ignore
			}
		}
	}
}

if ( ! function_exists( 'litho_post_exists' ) ) {
	/**
	 * Post exists or not.
	 */
	function litho_post_exists( $id ) {

		if ( '' == $id ) {
			return;
		}

		if ( is_string( get_post_status( $id ) ) ) {
			return true;
		}
		return false;
	}
}

if ( ! function_exists( 'litho_breadcrumb_display' ) ) {

	/**
	 * Page title option for individual pages - breadcrumb
	 */
	function litho_breadcrumb_display() {

		if ( is_woocommerce_activated() && ( is_product() || is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_shop() ) ) {// if WooCommerce plugin is activated and WooCommerce category, brand, shop page.

			ob_start();
				do_action( 'litho_woocommerce_breadcrumb' );
			return ob_get_clean();

		} elseif ( class_exists( 'Litho_Breadcrumb_Navigation' ) ) {

			$breadcrumb_title_blog = esc_html__( 'Home', 'litho' );
			$breadcrumb_title_home = esc_html__( 'Home', 'litho' );

			$litho_breadcrumb = new Litho_Breadcrumb_Navigation();

			$litho_breadcrumb->opt['static_frontpage']                = false;
			$litho_breadcrumb->opt['url_blog']                        = '';
			$litho_breadcrumb->opt['title_blog']                      = apply_filters( 'litho_breadcrumb_title_blog', $breadcrumb_title_blog );
			$litho_breadcrumb->opt['title_home']                      = apply_filters( 'litho_breadcrumb_title_home', $breadcrumb_title_home );
			$litho_breadcrumb->opt['separator']                       = '';
			$litho_breadcrumb->opt['tag_page_prefix']                 = '';
			$litho_breadcrumb->opt['singleblogpost_category_display'] = false;

			return $litho_breadcrumb->litho_display_breadcrumb();
		}
	}
}

if ( ! function_exists( 'navigation_menu_widget_args' ) ) {
	/**
	 * Navigation menu widget Args
	 *
	 * @param array $nav_menu_args Menu widget argument.
	 */
	function navigation_menu_widget_args( $nav_menu_args ) {

		if ( class_exists( 'Navigation_Menu_Widget_Walker' ) ) {

			$nav_menu_args['items_wrap']  = '<ul id="%1$s" class="%2$s alt-font litho-navigation-menu simple-navigation-menu">%3$s</ul>';
			$nav_menu_args['before']      = '';
			$nav_menu_args['after']       = '';
			$nav_menu_args['link_before'] = '';
			$nav_menu_args['link_after']  = '';
			$nav_menu_args['fallback_cb'] = false;
			$nav_menu_args['walker']      = new Navigation_Menu_Widget_Walker();
		}
		return $nav_menu_args;
	}
}
add_filter( 'litho_simple_navigation_args', 'navigation_menu_widget_args' );
add_filter( 'widget_nav_menu_args', 'navigation_menu_widget_args' );

if ( ! function_exists( 'adobe_font_saver' ) ) {

	/**
	 * Retrieve Adobe fonts
	 */
	function adobe_font_saver() {

		$litho_fonts             = array();
		$litho_enable_adobe_font = get_theme_mod( 'litho_enable_adobe_font', '0' );
		$litho_adobe_font_id     = get_theme_mod( 'litho_adobe_font_id', '' );

		if ( $litho_enable_adobe_font == 1 && $litho_adobe_font_id ) {

			$adobe_font_transient = get_transient( 'litho_adobe_fonts_transient' );

			if ( $adobe_font_transient == false ) {

				$adobe_uri = 'https://typekit.com/api/v1/json/kits/' . $litho_adobe_font_id . '/published'; // phpcs:ignore

				$response = wp_remote_get(
					$adobe_uri,
					array(
						'timeout' => '30',
					)
				);
				if ( ! is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) == 200 ) {

					$litho_fonts = json_decode( wp_remote_retrieve_body( $response ), true );
					set_transient( 'litho_adobe_fonts_transient', $litho_fonts, 24 * HOUR_IN_SECONDS );
					update_option( 'litho_adobe_font_list', $litho_fonts );
					update_option( 'litho_adobe_font_id', $litho_adobe_font_id );

				} else {
					$litho_fonts = get_option( 'litho_adobe_font_list' );
				}
			} else {
				$litho_fonts = get_option( 'litho_adobe_font_list' );
			}
		}
		return $litho_fonts;
	}
}

if ( ! function_exists( 'adobe_font_generator' ) ) {

	/**
	 * Adobe font generator
	 */
	function adobe_font_generator() {

		$adobe_fonts = array();
		$litho_data  = adobe_font_saver();

		if ( empty( $litho_data ) ) {
			return false;
		}

		$families = $litho_data['kit']['families'];

		foreach ( $families as $family ) {

			$family_name = str_replace( ' ', '-', $family['name'] );

			$adobe_fonts[ $family_name ] = array(
				'family'   => $family_name,
				'fallback' => str_replace( '"', '', $family['css_stack'] ),
				'weights'  => array(),
			);

			foreach ( $family['variations'] as $variation ) {

				$variations = str_split( $variation );

				switch ( $variations[0] ) {
					case 'n':
						$style = 'normal';
						break;
					default:
						$style = 'normal';
						break;
				}

				$weight = $variations[1] . '00';

				if ( ! in_array( $weight, $adobe_fonts[ $family_name ]['weights'] ) ) {
					$adobe_fonts[ $family_name ]['weights'][] = $weight;
				}
			}
			$adobe_fonts[ $family_name ]['slug']      = $family['slug'];
			$adobe_fonts[ $family_name ]['css_names'] = $family['css_names'];
		}
		return $adobe_fonts;
	}
}
add_filter( 'litho_adobe_font', 'adobe_font_generator' );

if ( ! function_exists( 'litho_page_sidebar_style' ) ) {

	/**
	 * Get sidebar.
	 */
	function litho_page_sidebar_style( $sidebar = '' ) {
		if ( empty( $sidebar ) ) {
			return;
		}

		dynamic_sidebar( $sidebar );
	}
}

if ( ! function_exists( 'litho_single_post_navigation' ) ) {

	/**
	 * Post Next Previous Navigation
	 */
	function litho_single_post_navigation() {

		$output                      = '';
		$litho_single_post_prev_text = apply_filters( 'litho_single_post_prev_text', esc_html__( 'Previous Post', 'litho' ) );
		$litho_single_post_next_text = apply_filters( 'litho_single_post_next_text', esc_html__( 'Next Post', 'litho' ) );
		$prev_url                    = get_previous_post_link( '<i class="icon-feather-arrow-left blog-nav-icon"></i> %link', $litho_single_post_prev_text );
		$next_url                    = get_next_post_link( '%link <i class="icon-feather-arrow-right blog-nav-icon"></i>', $litho_single_post_next_text );

		ob_start();
		// Previous Link.
		if ( ! empty( $prev_url ) ) {
			?>
			<div class="blog-nav-link blog-nav-link-prev">
				<?php printf( '%s', $prev_url ); // phpcs:ignore ?>
			</div>
			<?php
		}
		// Next Link.
		if ( ! empty( $next_url ) ) {
			?>
			<div class="blog-nav-link blog-nav-link-next">
				<?php printf( '%s', $next_url ); // phpcs:ignore ?>
			</div>
			<?php
		}

		$output .= ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

if ( ! function_exists( 'litho_option_image_alt' ) ) {

	/**
	 * Return Image Alt text
	 */
	function litho_option_image_alt( $attachment_id ) {

		if ( wp_attachment_is_image( $attachment_id ) == false ) {
			return;
		}

		/* Check image alt is on / off */
		$litho_image_alt = get_theme_mod( 'litho_image_alt', '1' );

		if ( $attachment_id && ( $litho_image_alt == 1 ) ) {
			/* Get attachment metadata by attachment id */
			$litho_image_meta = array(
				'alt' => get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ),
			);

			return $litho_image_meta;
		} else {
			return;
		}
	}
}

if ( ! function_exists( 'litho_option_image_title' ) ) {
	/**
	 * Return Image Title text
	 */
	function litho_option_image_title( $attachment_id ) {

		if ( wp_attachment_is_image( $attachment_id ) == false ) {
			return;
		}

		/* Check image title is on / off */
		$litho_image_title = get_theme_mod( 'litho_image_title', '0' );

		if ( $attachment_id && ( $litho_image_title == 1 ) ) {
			/* Get attachment metadata by attachment id */
			$litho_image_meta = array(
				'title' => esc_attr( get_the_title( $attachment_id ) ),
			);

			return $litho_image_meta;
		} else {
			return;
		}
	}
}

if ( ! function_exists( 'litho_related_posts' ) ) {

	/**
	 * Single Post Related Post Block
	 *
	 * @param $post_id string Post ID.
	 */
	function litho_related_posts( $post_id ) {

		global $litho_related_post_srcset;

		$args                                      = '';
		$column_class                              = '';
		$litho_post_within_content_area            = litho_option( 'litho_post_within_content_area', '0' );
		$litho_related_posts_title                 = litho_option( 'litho_related_posts_title', esc_html__( 'Related Posts', 'litho' ) );
		$litho_related_posts_subtitle              = litho_option( 'litho_related_posts_subtitle', esc_html__( 'YOU MAY ALSO LIKE', 'litho' ) );
		$litho_no_of_related_posts                 = litho_option( 'litho_no_of_related_posts', '3' );
		$litho_no_of_related_posts_columns         = litho_option( 'litho_no_of_related_posts_columns', '3' );
		$litho_related_post_srcset                 = litho_option( 'litho_related_post_feature_image_size', 'full' );
		$litho_related_posts_date_format           = litho_option( 'litho_related_posts_date_format', '' );
		$litho_related_posts_enable_post_thumbnail = litho_option( 'litho_related_posts_enable_post_thumbnail', '1' );
		$litho_related_posts_enable_date           = litho_option( 'litho_related_posts_enable_date', '1' );
		$litho_related_posts_enable_author         = litho_option( 'litho_related_posts_enable_author', '0' );
		$litho_related_post_excerpt                = litho_option( 'litho_related_post_excerpt', '0' );
		$litho_related_post_excerpt_length         = litho_option( 'litho_related_post_excerpt_length', '35' );
		$litho_related_post_enable_category        = litho_option( 'litho_related_post_enable_category', '0' );
		$litho_related_post_terms                  = litho_option( 'litho_related_post_terms', 'category' );
		$litho_related_post_enable_comment         = litho_option( 'litho_related_post_enable_comment', '0' );
		$litho_related_post_enable_like            = litho_option( 'litho_related_post_enable_like', '0' );
		$litho_related_post_enable_button          = litho_option( 'litho_related_post_enable_button', '0' );
		$litho_related_post_button_text            = litho_option( 'litho_related_post_button_text', esc_html__( 'Read more', 'litho' ) );
		$litho_related_posts_separator             = litho_option( 'litho_related_posts_separator', '0' );
		$wrapper_tag                               = ( 1 == $litho_post_within_content_area ) ? 'div' : 'section';

		switch ( $litho_no_of_related_posts_columns ) {
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

		$args = array(
			'category__in'        => wp_get_post_categories( $post_id ),
			'ignore_sticky_posts' => 1,
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $litho_no_of_related_posts,
			'post__not_in'        => array( $post_id ),
		);

		$recent_post = new WP_Query( $args );

		if ( $recent_post->have_posts() ) {
			?>
			<<?php echo $wrapper_tag; // phpcs:ignore. ?> class="litho-related-posts-wrap">
				<div class="container">
					<div class="row">
					<?php
					if ( $litho_related_posts_title || $litho_related_posts_subtitle ) {
						?>
						<div class="col-12">
							<?php
							if ( ! empty( $litho_related_posts_subtitle ) ) {
								?>
								<span class="related-post-general-subtitle alt-font"><?php
									echo esc_html( $litho_related_posts_subtitle );
								?></span>
								<?php
							}
							if ( ! empty( $litho_related_posts_title ) ) {
								?>
								<span class="related-post-general-title alt-font"><?php
									echo esc_html( $litho_related_posts_title );
								?></span>
							<?php } ?>
						</div>
					<?php } ?>
					</div>
					<ul class="<?php echo esc_attr( $column_class ); ?>row justify-content-center blog-clean blog-grid grid-masonry list-unstyled">
						<li class="grid-sizer d-none p-0 m-0"></li>
						<?php
						while ( $recent_post->have_posts() ) {
							$recent_post->the_post();
							?>
							<li id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'grid-item grid-gutter' ); ?>>
								<div class="blog-post">
									<?php
									if ( ! post_password_required() ) {
										if ( has_post_thumbnail() && 1 == $litho_related_posts_enable_post_thumbnail ) {
											?>
											<div class="blog-post-images">
												<?php get_template_part( 'loop/related-post/loop', 'image' ); ?>
												<?php if ( 1 == $litho_related_post_enable_category ) { ?>
													<span class="blog-category alt-font">
														<?php
														$blog_category_data = litho_post_category( get_the_ID(), false, $count = '1', $litho_related_post_terms );
														echo wp_kses_post( $blog_category_data );
														?>
													</span>
												<?php } ?>
											</div>
											<?php
										}
									}
									?>
									<div class="post-details">
										<?php if ( 1 == $litho_related_posts_enable_date ) { ?>
											<span class="post-date published"><?php echo esc_html( get_the_date( $litho_related_posts_date_format, get_the_ID() ) ); ?></span><time class="updated d-none" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( $litho_related_posts_date_format ) ); ?></time>
										<?php } ?>
										<a href="<?php echo esc_url( get_permalink() ); ?>" class="entry-title alt-font"><?php echo get_the_title(); // phpcs:ignore ?></a>
										<?php
										if ( 1 == $litho_related_post_excerpt ) {
											$show_excerpt_grid = ! empty( $litho_related_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_related_post_excerpt_length ) : litho_get_the_excerpt_theme( 15 );
											if ( $show_excerpt_grid ) {
												?>
													<div class="entry-content"><?php echo sprintf( '%s', wp_kses_post( $show_excerpt_grid ) ); ?></div>
												<?php
											}
										}
										?>
										<?php if ( 1 == $litho_related_post_enable_button ) { ?>
											<div class="litho-button-wrapper">
												<a href="<?php the_permalink(); ?>" class="btn litho-button-link blog-post-button" role="button">
													<span class="button-text alt-font"><?php echo esc_html( $litho_related_post_button_text ); ?></span>
												</a>
											</div>
										<?php } ?>
										<?php
										if ( 1 == $litho_related_posts_separator ) {
											?>
											<div class="horizontal-separator"></div>
											<?php
										}
										?>
										<?php
										if ( 1 == $litho_related_posts_enable_author || 1 == $litho_related_post_enable_like || ( 1 == $litho_related_post_enable_comment && ( comments_open() || get_comments_number() ) ) ) {
											?><div class="d-flex align-items-center post-meta"><?php
												if ( 1 == $litho_related_posts_enable_author && get_the_author() ) {
													?><span class="post-author-meta"><?php
														echo get_avatar( get_the_author_meta( 'ID' ), '30' );
														?><span class="author-name"><?php
															echo esc_html__( 'By&nbsp;', 'litho' );
															?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php
																echo esc_html( get_the_author() );
															?></a>
														</span>
													</span><?php
												}
												if ( 1 == $litho_related_post_enable_like && function_exists( 'litho_get_simple_likes_button' ) ) {
													?><span class="post-meta-like"><?php
														echo litho_get_simple_likes_button( get_the_ID() ); // phpcs:ignore
													?></span><?php
												}
												if ( 1 == $litho_related_post_enable_comment && ( comments_open() || get_comments_number() ) ) {
													?><span class="post-meta-comments"><?php
														echo comments_popup_link( '<i class="fa-regular fa-comment"></i><span class="comment-count">0</span> <span class="comment-text">' . esc_html__( 'Comment', 'litho' ) . '</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">1</span> <span class="comment-text">' . esc_html__( 'Comment', 'litho' ) . '</span>', '<i class="fa-regular fa-comment"></i><span class="comment-count">%</span> <span class="comment-text">' . esc_html__( 'Comments', 'litho' ) . '</span>', 'comment-link' );
													?></span><?php
												}
											?></div><?php
										}
										?>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>
					<?php
					wp_reset_postdata();
					?>
					</div>
			</<?php echo $wrapper_tag; ?>><?php // phpcs:ignore ?>
			<?php
		}
	}
}

if ( ! function_exists( 'litho_related_portfolio' ) ) {

	/**
	 * Single Post Related Portfolio Block
	 */
	function litho_related_portfolio( $post_id ) {

		global $litho_related_portfolio_srcset;
		$args                           = '';
		$column_class                   = '';
		$litho_portfolio_title          = litho_option( 'litho_related_single_portfolio_title', esc_html__( 'Our Recent Works', 'litho' ) );
		$litho_portfolio_title          = ( ! empty( $litho_portfolio_title ) ) ? str_replace( '||', '<br>', $litho_portfolio_title ) : '';
		$litho_portfolio_content        = litho_option( 'litho_related_single_portfolio_content', esc_html__( 'Other creative work for brands', 'litho' ) );
		$litho_no_of_portfolio          = litho_option( 'litho_no_of_related_single_portfolio', '3' );
		$litho_related_portfolio_srcset = litho_option( 'litho_related_single_portfolio_feature_image_size', 'full' );
		$litho_portfolio_display_by     = litho_option( 'litho_related_single_portfolio_display_by', 'portfolio-category' );
		$litho_no_of_portfolio_columns  = litho_option( 'litho_no_of_related_single_portfolio_columns', '3' );
		$litho_portfolio_display_by     = ( ! empty( $litho_portfolio_display_by ) ) ? $litho_portfolio_display_by : 'portfolio-category';
		$portfolio_terms                = wp_get_object_terms( $post_id, $litho_portfolio_display_by, array( 'fields' => 'ids' ) );
		$litho_portfolio_rich_snippet   = litho_option( 'litho_portfolio_rich_snippet', '1' );

		switch ( $litho_no_of_portfolio_columns ) {
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

		if ( ! empty( $portfolio_terms ) && ! is_wp_error( $portfolio_terms ) ) {
			$args = array(
				'post_type'           => 'portfolio',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => $litho_no_of_portfolio,
				'post__not_in'        => array( $post_id ),
				'tax_query'           => array(
					array(
						'taxonomy' => $litho_portfolio_display_by,
						'field'    => 'term_id',
						'terms'    => $portfolio_terms,
					),
				),
			);

			$recent_portfolio = new WP_Query( $args );

			if ( $recent_portfolio->have_posts() ) {
				?>
				<div class="litho-related-portfolio-wrap">
					<div class="container">
						<div class="row">
							<?php
							if ( $litho_portfolio_title || $litho_portfolio_content ) {
								?>
								<div class="col-12">
									<?php
									if ( $litho_portfolio_content ) {
										?>
										<span class="related-portfolio-general-subtitle alt-font"><?php
											echo esc_html( $litho_portfolio_content );
										?></span>
										<?php
									}
									if ( $litho_portfolio_title ) {
										?>
										<h6 class="related-portfolio-general-title alt-font"><?php
											echo esc_html( $litho_portfolio_title );
										?></h6>
									<?php } ?>
								</div>
								<?php
							}
							?>
						</div>
						<ul class="<?php echo esc_attr( $column_class ); ?>portfolio-classic portfolio-wrap portfolio-grid blog-grid grid-masonry text-center list-unstyled">
							<li class="grid-sizer"></li>
							<?php
							while ( $recent_portfolio->have_posts() ) :
								$recent_portfolio->the_post();
								$litho_portfolio_classes = '';
								ob_start();
									post_class( 'portfolio-item grid-item portfolio-single-post col' );
									$litho_portfolio_classes .= ob_get_contents();
								ob_end_clean();

								/* Image Alt, Title, Caption */
								$thumbnail_id      = get_post_thumbnail_id();
								$litho_img_alt     = ! empty( $thumbnail_id ) ? litho_option_image_alt( $thumbnail_id ) : array();
								$litho_img_title   = ! empty( $thumbnail_id ) ? litho_option_image_title( $thumbnail_id ) : array();
								$litho_image_alt   = ( isset( $litho_img_alt['alt'] ) && ! empty( $litho_img_alt['alt'] ) ) ? $litho_img_alt['alt'] : '';
								$litho_image_title = ( isset( $litho_img_title['title'] ) && ! empty( $litho_img_title['title'] ) ) ? $litho_img_title['title'] : '';

								$litho_img_attr = array(
									'title' => $litho_image_title,
									'alt'   => $litho_image_alt,
								);

								$litho_subtitle_single = litho_post_meta( 'litho_subtitle' );

								echo '<li id="post-' . esc_attr( get_the_ID() ) . '" ' . $litho_portfolio_classes . '>'; // phpcs:ignore
									?>
									<figure >
										<div class="portfolio-image">
											<?php
											if ( has_post_thumbnail() && ! post_password_required() ) {
												echo get_the_post_thumbnail( get_the_ID(), $litho_related_portfolio_srcset, $litho_img_attr );
											}

											if ( 1 == $litho_portfolio_rich_snippet ) {
												?>
												<div class="litho-rich-snippet d-none">
													<span class="entry-title">
														<?php echo esc_html( get_the_title() ); ?>
													</span>
													<span class="author vcard">
														<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
															<?php echo esc_html( get_the_author() ); ?>
														</a>
													</span>
													<span class="published">
														<?php echo esc_html( get_the_date() ); ?>
													</span>
													<time class="updated" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
														<?php echo esc_html( get_the_modified_date() ); ?>
													</time>
												</div>
												<?php
											}
											?>
											<div class="portfolio-hover d-flex">
												<div class="portfolio-icon">
													<a href="<?php the_permalink(); ?>" class="external-link"><i aria-hidden="true" class="fa-solid fa-link"></i></a>
												</div>
											</div>
										</div>
										<figcaption>
											<div class="portfolio-caption">
												<span class="title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</span>
													<span class="subtitle">
													<?php if ( ! empty( $litho_subtitle_single ) ) { ?>
														<span class="category"><?php echo esc_html( $litho_subtitle_single ); ?></span>
													<?php } ?>
													</span>
											</div>
										</figcaption>
									</figure>
								</li>
								<?php
							endwhile;
							?>
						</ul>
						<?php
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'litho_single_portfolio_navigation' ) ) {

	/**
	 * Portfolio Navigation
	 */
	function litho_single_portfolio_navigation() {

		$litho_portfolio_navigation_type              = litho_option( 'litho_portfolio_navigation_type', 'latest' );
		$litho_portfolio_navigation_nextlink_text     = litho_option( 'litho_portfolio_navigation_nextlink_text', esc_html__( 'Next Project', 'litho' ) );
		$litho_portfolio_navigation_priviouslink_text = litho_option( 'litho_portfolio_navigation_priviouslink_text', esc_html__( 'Prev Project', 'litho' ) );
		$litho_portfolio_navigation_orderby           = litho_option( 'litho_portfolio_navigation_orderby', 'date' );
		$litho_portfolio_navigation_order             = litho_option( 'litho_portfolio_navigation_order', 'DESC' );

		if ( 'category' == $litho_portfolio_navigation_type || 'tag' == $litho_portfolio_navigation_type ) {

			if ( 'category' == $litho_portfolio_navigation_type ) {

				$terms = get_the_terms( get_the_ID(), 'portfolio-category' );
				if ( $terms ) {
					$taxonomy = 'portfolio-category';
				} else {
					return;
				}
			}
			if ( 'tag' == $litho_portfolio_navigation_type ) {
				$terms = get_the_terms( get_the_ID(), 'portfolio-tags' );
				if ( $terms ) {
					$taxonomy = 'portfolio-tags';
				} else {
					return;
				}
			}

			if ( empty( $terms ) ) {
				return;
			}

			$args = array(
				'post_type'      => 'portfolio',
				'posts_per_page' => -1,
				'tax_query'      => array(
					array(
						'taxonomy' => $taxonomy,
						'terms'    => array( $terms[0]->term_id ),
						'field'    => 'term_id',
						'operator' => 'IN',
					),
				),
				'orderby'        => $litho_portfolio_navigation_orderby,
				'order'          => $litho_portfolio_navigation_order,
			);

			$ids   = array();
			$posts = get_posts( $args );
			foreach ( $posts as $thepost ) {
				$ids[] = $thepost->ID;
			}

			// get and echo previous and next post in the same category.
			$thisindex = array_search( get_the_ID(), $ids );

			if ( ( $thisindex - 1 ) < 0 ) {
				$nextid = '';
			} else {
				$nextid = $ids[ $thisindex - 1 ];
			}

			if ( ( $thisindex + 1 ) > count( $ids ) - 1 ) {
				$previd = '';
			} else {
				$previd = $ids[ $thisindex + 1 ];
			}
		} else {

			$previd = '';
			$nextid = '';
			if ( isset( get_previous_post()->ID ) ) {
				$previd = get_previous_post()->ID;
			}

			if ( isset( get_next_post()->ID ) ) {
				$nextid = get_next_post()->ID;
			}
		}
		?>
		<div class="portfolio-navigation-wrapper">
			<div class="container-fluid">
				<div class="row row-cols-1 justify-content-center alt-font">
					<?php
					if ( ! empty( $previd ) ) {
						?>
						<div class="col-md nav-link-prev fancy-box-item px-0">
							<a rel="prev" href="<?php echo esc_url( get_permalink( $previd ) ); ?>" class="d-flex h-100 align-items-center justify-content-center justify-content-lg-between justify-content-md-start">
								<?php
								if ( has_post_thumbnail() ) {
									$litho_portfolio_post_thumbnail = get_the_post_thumbnail_url( $previd );
									?>
									<div class="cover-background" style="background-image: url(<?php echo esc_url( $litho_portfolio_post_thumbnail ); ?>)"></div>
									<?php
								}
								?>
								<div class="next-previous-navigation">
									<i class="line-icon-Arrow-OutLeft"></i>
									<span class="prev-link-text"><?php echo sprintf( '%s', $litho_portfolio_navigation_priviouslink_text ); // phpcs:ignore ?></span>
								</div>
								<span class="title"><?php echo get_the_title( $previd ); // phpcs:ignore ?></span>
							</a>
						</div>
						<?php
					}

					if ( ! empty( $nextid ) ) {
						?>
						<div class="col-md nav-link-next fancy-box-item px-0">
							<a rel="next" href="<?php echo esc_url( get_permalink( $nextid ) ); ?>" class="d-flex h-100 align-items-center justify-content-center justify-content-lg-between justify-content-md-start">
								<?php
								if ( has_post_thumbnail() ) {
									$litho_portfolio_post_thumbnail = get_the_post_thumbnail_url( $nextid );
									?>
									<div class="cover-background" style="background-image: url(<?php echo esc_url( $litho_portfolio_post_thumbnail ); ?>)"></div>
									<?php
								}
								?>
								<span class="title"><?php echo get_the_title( $nextid ); // phpcs:ignore ?></span>
								<div class="next-previous-navigation">
									<span class="next-link-text"><?php echo sprintf( '%s', $litho_portfolio_navigation_nextlink_text ); // phpcs:ignore ?></span>
									<i class="line-icon-Arrow-OutRight"></i>
								</div>
							</a>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'litho_move_comment_field_to_bottom' ) ) {

	/**
	 * For WordPress 4.4 move comment textarea bottom
	 */
	function litho_move_comment_field_to_bottom( $fields ) {

		if ( class_exists( 'WooCommerce' ) && is_product() ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;
		} else {
			$comment_field = $fields['comment'];
			$cookies       = $fields['cookies'];

			unset( $fields['comment'] );
			unset( $fields['cookies'] );

			$fields['comment'] = $comment_field;
			$fields['cookies'] = $cookies;
		}
		return $fields;
	}
}
add_filter( 'comment_form_fields', 'litho_move_comment_field_to_bottom' );

if ( ! function_exists( 'litho_comment_callback' ) ) {

	/**
	 * Comment Callback
	 */
	function litho_comment_callback( $comment, $args, $depth ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? 'post-comment' : 'parent post-comment' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-author-wrapper d-block d-md-flex w-100 align-items-center align-items-md-start">
		<?php } ?>
			<?php
			if ( $args['avatar_size'] != 0 ) {
				if ( get_avatar( $comment, $args['avatar_size'] ) ) {
					?>
					<div class="comment-image-box">
						<?php
							echo get_avatar( $comment, $args['avatar_size'] );
						?>
					</div>
					<?php
				}
			}
			?>
			<div class="comment-text-box w-100">
				<div class="comment-title-edit-link">
					<a href="<?php echo esc_url( $author_url ); ?>" class="alt-font"><?php echo get_comment_author(); // phpcs:ignore. ?></a>
					<?php edit_comment_link( esc_html__( '(edit)', 'litho' ), '  ', '' ); ?>
				</div>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<div class="comments-date">
					<?php
					/* translators: 1: date, 2: time */
					printf( esc_html__( '%1$s, %2$s', 'litho' ), get_comment_date(),  get_comment_time() ); // phpcs:ignore. ?>
				</div>
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>
			</div>
			<?php if ( '0' == $comment->comment_approved ) { ?>
				<em class="comment-awaiting-moderation alert alert-warning"><?php esc_html_e( 'Your comment is awaiting moderation.', 'litho' ); ?></em>
				<br />
			<?php } ?>

		<?php if ( 'div' != $args['style'] ) { ?>
		</div>
		<?php } ?>
		<?php
	}
}

if ( ! function_exists( 'litho_replace_reply_link_class' ) ) {

	/**
	 * Filter to replace class on reply link ( comment_reply_link ) function.
	 */
	function litho_replace_reply_link_class( $class ) {
		$class = str_replace( "class='comment-reply-link", "class='comment-reply-link inner-link", $class );
		return $class;
	}
}
add_filter( 'comment_reply_link', 'litho_replace_reply_link_class' );

if ( ! function_exists( 'litho_categories_postcount_filter' ) ) {

	/**
	 * Remove Post category brackets.
	 */
	function litho_categories_postcount_filter( $variable ) {

		$variable = str_replace( array( '(1)', '(2)', '(3)', '(4)', '(5)', '(6)', '(7)', '(8)', '(9)' ), array( '(01)', '(02)', '(03)', '(04)', '(05)', '(06)', '(07)', '(08)', '(09)' ), $variable );
		$variable = str_replace( array( '(', ')', 'cat-item ' ), array( '<span class="count">', '</span>', 'cat-item category-list ' ), $variable );
		return $variable;
	}
}
add_filter( 'wp_list_categories', 'litho_categories_postcount_filter' );

if ( ! function_exists( 'litho_archive_count_no_brackets' ) ) {

	/**
	 * Remove Post archieve brackets.
	 */
	function litho_archive_count_no_brackets( $variable ) {

		$variable = str_replace( array( '(1)', '(2)', '(3)', '(4)', '(5)', '(6)', '(7)', '(8)', '(9)' ), array( '(01)', '(02)', '(03)', '(04)', '(05)', '(06)', '(07)', '(08)', '(09)' ), $variable );
		$variable = str_replace( array( '(', ')' ), array( '<span class="count">', '</span>' ), $variable );
		return $variable;
	}
}
add_filter( 'get_archives_link', 'litho_archive_count_no_brackets' );

if ( ! function_exists( 'litho_extract_shortcode_contents' ) ) {
	/**
	 * Extract text contents from all shortcodes for usage in excerpts
	 *
	 * @return string $m The shortcode contents
	 **/
	function litho_extract_shortcode_contents( $m ) {
		global $shortcode_tags;

		// Setup the array of all registered shortcodes.
		$shortcodes          = array_keys( $shortcode_tags );
		$no_space_shortcodes = array( 'dropcap' );
		$omitted_shortcodes  = array( 'slide' );

		// Extract contents from all shortcodes recursively.
		if ( in_array( $m[2], $shortcodes ) && ! in_array( $m[2], $omitted_shortcodes ) ) {
			$pattern = get_shortcode_regex();
			// Add space the excerpt by shortcode, except for those who should stick together, like dropcap.
			$space = ' ';
			if ( in_array( $m[2], $no_space_shortcodes ) ) {
				$space = '';
			}
			$content = preg_replace_callback( "/$pattern/s", 'litho_extract_shortcode_contents', rtrim( $m[5] ) . $space );
			return $content;
		}
		// allow [[foo]] syntax for escaping a tag.
		if ( $m[1] == '[' && $m[6] == ']' ) {
			return substr( $m[0], 1, -1 );
		}
		return $m[1] . $m[6];
	}
}

if ( ! function_exists( 'litho_get_the_post_content' ) ) {

	/**
	 * Get the post content
	 */
	function litho_get_the_post_content() {
		return apply_filters( 'the_content', get_the_content() );
	}
}

if ( ! function_exists( 'litho_get_the_excerpt_theme' ) ) {
	function litho_get_the_excerpt_theme( $length ) {
		return litho_Excerpt::litho_get_by_length( $length );
	}
}

if ( ! function_exists( 'litho_get_pagination' ) ) {

	/**
	 * Return Pagination
	 */
	function litho_get_pagination() {
		global $wp_query;
		$current = ( $wp_query->query_vars['paged'] > 1 ) ? $wp_query->query_vars['paged'] : 1;
		if ( $wp_query->max_num_pages > 1 ) {
			?>
			<div class="col-12 litho-pagination">
				<div class="pagination align-items-center">
				<?php
				// phpcs:ignore
				echo paginate_links(
					array(
						'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
						'format'    => '',
						'add_args'  => '',
						'current'   => $current,
						'total'     => $wp_query->max_num_pages,
						'prev_text' => '<i aria-hidden="true" class="feather icon-feather-arrow-left"></i>',
						'next_text' => '<i aria-hidden="true" class="feather icon-feather-arrow-right"></i>',
						'type'      => 'list',
						'end_size'  => 2,
						'mid_size'  => 2,
					)
				);
				?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'litho_promo_popup' ) ) {

	/**
	 * To Add promo popup functionality
	 */
	function litho_promo_popup() {

		// Promo Popup.
		$litho_enable_promo_popup              = get_theme_mod( 'litho_enable_promo_popup', '0' );
		$litho_enable_promo_popup_on_home_page = get_theme_mod( 'litho_enable_promo_popup_on_home_page', '0' );
		$litho_enable_promo_popup              = apply_filters( 'litho_enable_promo_popup', $litho_enable_promo_popup );// phpcs:ignore
		$litho_promo_popup_section             = get_theme_mod( 'litho_promo_popup_section', '' );

		if ( '1' == $litho_enable_promo_popup && ! empty( $litho_promo_popup_section ) ) {

			if ( '0' == $litho_enable_promo_popup_on_home_page || ( '1' == $litho_enable_promo_popup_on_home_page && is_front_page() ) ) {

				$flag         = false;
				$litho_siteid = ( is_multisite() ) ? '-' . get_current_blog_id() : '';
				$cookie_name  = 'litho-promo-popup' . $litho_siteid;// phpcs:ignore

				if ( ! isset( $_COOKIE[ $cookie_name ] ) || ( isset( $_COOKIE[ $cookie_name ] ) && $_COOKIE[ $cookie_name ] != 'shown' ) ) {
					$flag = true;
				}
				?>
				<div class="litho-promo-popup-wrap">
					<?php
					if ( current_user_can( 'edit_posts' ) && ! is_customize_preview() && ! empty( $litho_promo_popup_section ) ) {
						$edit_link = add_query_arg(
							array(
								'post'   => $litho_promo_popup_section,
								'action' => 'elementor',
							),
							admin_url( 'post.php' )
						);
						?>
						<a href="<?php echo esc_url( $edit_link ); ?>" target="_blank" data-bs-placement="right" title="<?php echo esc_attr__( 'Edit promo section', 'litho' ); ?>" class="edit-litho-section edit-promo litho-tooltip">
							<i class="ti-pencil"></i>
						</a>
						<?php
					}

					/**
					 * Fires to Load Promo Popup from the Section Builder.
					 *
					 * @since 1.0
					 */
					do_action( 'theme_promo_popup' );
					?>
				</div>
				<?php
				wp_enqueue_script( 'promo-popup' );
			}
		}
	}
}

/**
 * Load promo popup details in footer
 *
 * @see litho_promo_popup()
 */
add_action( 'wp_footer', 'litho_promo_popup', -1 );

if ( ! function_exists( 'litho_side_icon' ) ) {

	/**
	 * Side Icon
	 */
	function litho_side_icon() {

		// Side Icon options.
		$litho_enable_side_icon               = get_theme_mod( 'litho_enable_side_icon', '0' );
		$litho_enable_side_icon_on_home_page  = get_theme_mod( 'litho_enable_side_icon_on_home_page', '0' );
		$litho_enable_side_icon               = apply_filters( 'litho_enable_side_icon', $litho_enable_side_icon ); // phpcs:ignore
		$litho_side_icon_section              = get_theme_mod( 'litho_side_icon_section', '' );
		$litho_side_icon_button_first_text    = get_theme_mod( 'litho_side_icon_button_first_text', esc_html__( '37+ demos', 'litho' ) );
		$litho_side_icon_second_button_text   = get_theme_mod( 'litho_side_icon_second_button_text', esc_html__( 'Buy now', 'litho' ) );
		$litho_side_icon_second_button_link   = get_theme_mod( 'litho_side_icon_second_button_link', '' );
		$litho_enable_side_icon_first_button  = get_theme_mod( 'litho_enable_side_icon_first_button', '0' );
		$litho_enable_side_icon_second_button = get_theme_mod( 'litho_enable_side_icon_second_button', '0' );

		if ( '1' == $litho_enable_side_icon ) {

			if ( ( '1' == $litho_enable_side_icon_on_home_page && is_front_page() ) || ( ! is_front_page() ) ) {
				?>
				<div class="theme-demos">
					<?php if ( '1' == $litho_enable_side_icon_first_button && ! empty( $litho_side_icon_section ) ) { ?>
						<div class="all-demo">
							<a href="javascript:void(0);" class="demo-link">
								<i class="feather icon-feather-x align-middle"></i>
									<div class="theme-wrapper">
										<div>
											<i class="feather icon-feather-layers align-middle"></i><?php echo esc_html( $litho_side_icon_button_first_text ); ?>
										</div>
								</div>
							</a>
						</div>
					<?php } ?>
					<?php if ( '1' == $litho_enable_side_icon_second_button && ! empty( $litho_side_icon_second_button_link ) ) { ?>
						<div class="buy-theme">
							<a href="<?php echo esc_url( $litho_side_icon_second_button_link ); ?>" target="_blank">
								<i class="feather icon-feather-shopping-bag align-middle"></i>
								<div class="theme-wrapper">
									<div>
										<i class="feather icon-feather-shopping-bag align-middle"></i><?php echo esc_html( $litho_side_icon_second_button_text ); ?>
									</div>
								</div>
							</a>
						</div>
					<?php } ?>
					<div class="demos-wrapper">
						<?php
						if ( current_user_can( 'edit_posts' ) && ! is_customize_preview() && '1' == $litho_enable_side_icon_first_button && ! empty( $litho_side_icon_section ) ) {
							$edit_link = add_query_arg(
								array(
									'post'   => $litho_side_icon_section,
									'action' => 'elementor',
								),
								admin_url( 'post.php' )
							);
							?>
							<a href="<?php echo esc_url( $edit_link ); ?>" target="_blank" data-bs-placement="right" title="<?php echo esc_attr__( 'Edit side icon section', 'litho' ); ?>" class="edit-litho-section edit-side-icon">
								<i class="ti-pencil"></i>
							</a>
							<?php
						}
						/**
						 * Fires to Load Side Icon Content from the Section Builder.
						 *
						 * @since 1.0
						 */
						do_action( 'theme_side_icon' );
						?>
					</div>
				</div>
				<?php
			}
		}
	}
}

/**
 * Load Side Icon details in footer
 *
 * @see litho_side_icon()
 */
add_action( 'wp_footer', 'litho_side_icon', -2 );

if ( ! function_exists( 'litho_filter_the_post_thumbnail_atts' ) ) :

	/**
	 * Filter For the_post_thumbnail function attributes
	 */
	function litho_filter_the_post_thumbnail_atts( $atts, $attachment ) {

		/* Check image alt is on / off */
		$litho_image_alt      = get_theme_mod( 'litho_image_alt', '1' );
		$litho_image_alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
		// Check image title is on / off.
		$litho_image_title = get_theme_mod( 'litho_image_title', '0' );

		/* For image alt attribute */
		if ( $litho_image_alt == '1' ) {
			$atts['alt'] = $litho_image_alt_text;
		} else {
			$atts['alt'] = '';
		}

		/* For image title attribute */
		if ( $litho_image_title == 1 && $attachment->post_title ) {
			$atts['title'] = esc_attr( $attachment->post_title );
		}

		return $atts;
	}
endif;
add_filter( 'wp_get_attachment_image_attributes', 'litho_filter_the_post_thumbnail_atts', 10, 2 );

if ( ! function_exists( 'litho_render_elementor_post_css' ) ) {

	/**
	 * Render post CSS files in header
	 */
	function litho_render_elementor_post_css() {

		if ( ! class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			return;
		}

		$template_ids = array();
		// Mini Header options.
		$litho_enable_mini_header_general = litho_builder_customize_option( 'litho_enable_mini_header_general', '1' );
		$litho_enable_mini_header         = litho_builder_option( 'litho_enable_mini_header', '0', $litho_enable_mini_header_general );
		$litho_mini_header_section        = litho_builder_option( 'litho_mini_header_section', '', $litho_enable_mini_header_general );

		if ( 1 == $litho_enable_mini_header && ! empty( $litho_mini_header_section ) ) {
			$template_ids[] = $litho_mini_header_section;
		}

		// Header options.
		$litho_enable_header_general = litho_builder_customize_option( 'litho_enable_header_general', '1' );
		$litho_enable_header         = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
		$litho_header_section        = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );

		if ( 1 == $litho_enable_header && ! empty( $litho_header_section ) ) {
			$template_ids[] = $litho_header_section;
		}

		// Footer options.
		$litho_enable_footer_general = litho_builder_customize_option( 'litho_enable_footer_general', '1' );
		$litho_enable_footer         = litho_builder_option( 'litho_enable_footer', '1', $litho_enable_footer_general );
		$litho_footer_section        = litho_builder_option( 'litho_footer_section', '', $litho_enable_footer_general );

		if ( 1 == $litho_enable_footer && ! empty( $litho_footer_section ) ) {
			$template_ids[] = $litho_footer_section;
		}

		// Page title options.
		$litho_enable_custom_title_general = litho_builder_customize_option( 'litho_enable_custom_title_general', '1' );
		$litho_enable_custom_title         = litho_builder_option( 'litho_enable_custom_title', '1', $litho_enable_custom_title_general );
		$litho_custom_title_section        = litho_builder_option( 'litho_custom_title_section', '', $litho_enable_custom_title_general );

		if ( 1 == $litho_enable_custom_title && ! empty( $litho_custom_title_section ) ) {
			$template_ids[] = $litho_custom_title_section;
		}

		if ( ! empty( $template_ids ) ) {
			foreach ( $template_ids as $template_id ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
				$css_file->enqueue();
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'litho_render_elementor_post_css', 500 );

if ( ! function_exists( 'litho_load_stylesheet_by_key' ) ) {

	/**
	 * Load stylesheet.
	 *
	 * @param string $value Library key.
	 */
	function litho_load_stylesheet_by_key( $value ) {
		$flag          = true;
		$style_details = litho_option( 'litho_disable_style_details', '' );
		if ( ! empty( $style_details ) ) {
			$style_details = explode( ',', $style_details );
			if ( in_array( $value, $style_details ) ) {
				$flag = false;
			}
		}
		/**
		 * Filters to check CSS libraries by handle
		 *
		 * @since 1.0
		 *
		 * @param bool $flag    Check style exists or not.
		 * @param string $value CSS Library handle.
		 */
		return apply_filters( 'litho_load_stylesheet_by_key', $flag, $value );
	}
}

if ( ! function_exists( 'litho_load_javascript_by_key' ) ) {

	/**
	 * Load javascript.
	 *
	 * @param string $value Library key.
	 */
	function litho_load_javascript_by_key( $value ) {
		$flag           = true;
		$script_details = litho_option( 'litho_disable_script_details', '' );
		if ( ! empty( $script_details ) ) {
			$script_details = explode( ',', $script_details );
			if ( in_array( $value, $script_details ) ) {
				$flag = false;
			}
		}
		/**
		 * Filters to check Javascripts libraries by handle
		 *
		 * @since 1.0
		 *
		 * @param bool $flag    Check script exists or not.
		 * @param string $value Javascript Library handle.
		 */
		return apply_filters( 'litho_load_javascript_by_key', $flag, $value );
	}
}

if ( ! function_exists( 'litho_get_within_content_area' ) ) {

	/**
	 * Get within content area settings.
	 */
	function litho_get_within_content_area() {

		$litho_post_within_content_area = 0;

		if ( is_singular( 'portfolio' ) ) {

			$litho_post_within_content_area = litho_option( 'litho_portfolio_within_content_area', '0' );

		} elseif ( is_single() ) {

			$litho_post_within_content_area = litho_option( 'litho_post_within_content_area', '0' );

		} elseif ( is_page() ) {

			$litho_post_within_content_area = litho_option( 'litho_page_within_content_area', '0' );
		}

		return $litho_post_within_content_area;
	}
}

if ( ! function_exists( 'litho_preloader_callback' ) ) {
	/**
	 * Preloader callback.
	 */
	function litho_preloader_callback() {
		$litho_preload       = get_theme_mod( 'litho_preload', '0' );
		$litho_preload_types = get_theme_mod( 'litho_preload_types', 'style-1' );
		$litho_preload_image = get_theme_mod( 'litho_page_preload_image', '' );		

		if ( '1' === $litho_preload ) {
			$litho_preload_image_url = '';
			if ( ! empty( $litho_preload_image )  ) {
				$litho_preload_image_url = $litho_preload_image;
			} else {
				$litho_preload_image_url = LITHO_THEME_IMAGES_URI . '/preloader.svg';
			}

			/**
			 * Apply filters to load preload image url so user can add change image.
			 *
			 * @since 1.0
			 */
			$litho_preload_image = apply_filters( 'litho_preload_image', $litho_preload_image_url );
			?>
			<div class="preloader-overlay">
				<span class="preloader">
					<span class="loader-inner">
						<img src="<?php echo esc_url( $litho_preload_image_url ); ?>" alt="<?php echo esc_attr__( 'Preload Image', 'litho' ); ?>">
					</span>
				</span>
			</div>
			<?php
		}
	}
}
add_action( 'litho_preloader', 'litho_preloader_callback' );

if ( ! function_exists( 'litho_preloader_body_class' ) ) {
	/**
	 * Add class when preloader active.
	 */
	function litho_preloader_body_class( $classes ) {
		$litho_preload = get_theme_mod( 'litho_preload', '0' );
		if ( '1' === $litho_preload ) {
			$classes[] = 'preloader-overflow-hidden';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'litho_preloader_body_class' );

if ( ! function_exists( 'wpml_option_wp_page_for_privacy_policy' ) ) {

	/* Privacy link text translation */
	function wpml_option_wp_page_for_privacy_policy( $value ) {

	    return apply_filters( 'wpml_object_id', $value, 'page', true );
	}
}
add_filter( 'option_wp_page_for_privacy_policy', 'wpml_option_wp_page_for_privacy_policy' );


if ( ! function_exists( 'litho_portfolio_format_support_filter' ) ) {
	/**
	 * Portfolio Support Filter.
	 */
	function litho_portfolio_format_support_filter() {

		$screen = get_current_screen();

		// Bail if not on the projects screen.
		if ( empty( $screen->post_type ) || 'portfolio' !== $screen->post_type ) {
			return;
		}

		// Check if the current theme supports formats.
		if ( current_theme_supports( 'post-formats' ) ) {

			$formats = get_theme_support( 'post-formats' );

			// If we have formats, add theme support for only the allowed formats.
			if ( isset( $formats[0] ) ) {
				$new_formats = array_intersect( $formats[0], [ 'link' ] );

				// Remove post formats support.
				remove_theme_support( 'post-formats' );

				// If the theme supports the allowed formats, add support for them.
				if ( $new_formats ) {
					add_theme_support( 'post-formats', $new_formats );
				}
			}
		}

		// Filter the default post format.
		add_filter( 'option_default_post_format', 'litho_portfolio_default_format_filter', 95 );
	}
}

if ( ! function_exists( 'litho_portfolio_default_format_filter' ) ) {

	/**
	 * Portfolio default Support Filter.
	 *
	 * @param mixed $format Get Format.
	 */
	function litho_portfolio_default_format_filter( $format ) {

		return in_array( $format, [ 'link' ], true ) ? $format : 'standard';
	}
}

add_action( 'load-post.php', 'litho_portfolio_format_support_filter' );
add_action( 'load-post-new.php', 'litho_portfolio_format_support_filter' );
add_action( 'load-edit.php', 'litho_portfolio_format_support_filter' );
