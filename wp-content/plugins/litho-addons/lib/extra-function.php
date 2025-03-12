<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Check if Elementor is active.*/
if ( ! function_exists( 'is_elementor_activated' ) ) {
	function is_elementor_activated() {
		return defined( 'ELEMENTOR_VERSION' ) ? true : false;
	}
}

/* Check if WooCommerce is Active.*/
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

/* Check if Contact Form 7 is Active. */
if ( ! function_exists( 'is_contact_form_7_activated' ) ) {
	function is_contact_form_7_activated() {
		return class_exists( 'WPCF7' ) ? true : false;
	}
}

// Check if mailchimp form is active.
if ( ! function_exists( 'is_mailchimp_form_activated' ) ) {
	function is_mailchimp_form_activated() {
		return class_exists( 'MC4WP_MailChimp' ) ? true : false;
	}
}

// Check if revolution slider is active.
if ( ! function_exists( 'is_revolution_slider_activated' ) ) {
	function is_revolution_slider_activated() {
		return class_exists( 'UniteFunctionsRev' ) ? true : false;
	}
}

// To get register sidebar list in metabox.
if ( ! function_exists( 'litho_register_sidebar_array' ) ) {
	function litho_register_sidebar_array() {
		global $wp_registered_sidebars;
		$sidebar_array = array();
		if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
			$sidebar_array['default'] = esc_html__( 'Default', 'litho-addons' );
			$sidebar_array['none']    = esc_html__( 'No Sidebar', 'litho-addons' );
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebar_array[ $sidebar['id'] ] = $sidebar['name'];
			}
		}
		return $sidebar_array;
	}
}

if ( ! class_exists( 'Litho_filesystem' ) ) {
	/**
	 * Filesystem
	 */
	final class Litho_filesystem {

		public static function init_filesystem() {

			// The WordPress filesystem.
			global $wp_filesystem;

			$credentials = array();

			if ( ! defined( 'FS_METHOD' ) ) {
				define( 'FS_METHOD', 'direct' );
			}

			$method = defined( 'FS_METHOD' ) ? FS_METHOD : false;

			if ( 'ftpext' === $method ) {
				// If defined, set it to that, Else, set to NULL.
				$credentials['hostname'] = defined( 'FTP_HOST' ) ? preg_replace( '|\w+://|', '', FTP_HOST ) : null;
				$credentials['username'] = defined( 'FTP_USER' ) ? FTP_USER : null;
				$credentials['password'] = defined( 'FTP_PASS' ) ? FTP_PASS : null;

				// Set FTP port.
				if ( strpos( $credentials['hostname'], ':' ) && null !== $credentials['hostname'] ) {
					list( $credentials['hostname'], $credentials['port'] ) = explode( ':', $credentials['hostname'], 2 );
					if ( ! is_numeric( $credentials['port'] ) ) {
						unset( $credentials['port'] );
					}
				} else {
					unset( $credentials['port'] );
				}
				// Set connection type.
				if ( ( defined( 'FTP_SSL' ) && FTP_SSL ) && 'ftpext' === $method ) {
					$credentials['connection_type'] = 'ftps';
				} elseif ( ! array_filter( $credentials ) ) {
					$credentials['connection_type'] = null;
				} else {
					$credentials['connection_type'] = 'ftp';
				}
			}

			if ( empty( $wp_filesystem ) ) {
				require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem( $credentials );
			}

			return $wp_filesystem;
		}
	}
}

/* Allow to support MIME Type */
if ( ! function_exists( 'litho_allow_mime_types' ) ) {
	function litho_allow_mime_types( $mimes ) {
		$litho_svg_support = get_theme_mod( 'litho_svg_support', '0' );
		if ( 1 == $litho_svg_support ) {
			$mimes['svg']   = 'imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)ge/svg+xml';
			$mimes['ttf']   = 'font/ttf';
			$mimes['woff']  = 'font/woff';
			$mimes['woff2'] = 'font/woff2';
			$mimes['csv']   = 'text/csv';
		}
		return $mimes;
	}
}
add_filter( 'upload_mimes', 'litho_allow_mime_types' );

// Customize save custom fonts.
if ( ! function_exists( 'litho_customize_save' ) ) {
	function litho_customize_save() {
		$filesystem = Litho_filesystem::init_filesystem();
		$upload_dir = wp_upload_dir();
		$srcdir     = untrailingslashit( wp_normalize_path( $upload_dir['basedir'] ) ) . '/litho-fonts/litho-temp-fonts';

		if ( file_exists( $srcdir ) ) {
			$filesystem->delete( $srcdir, FS_CHMOD_DIR );
		}
	}
}
add_action( 'customize_save', 'litho_customize_save' );

// Customize custom fonts create folders.
if ( ! function_exists( 'litho_customize_preview_init' ) ) {
	function litho_customize_preview_init() {

		$theme_custom_fonts = get_theme_mod( 'litho_custom_fonts', '' );
		$theme_custom_fonts = ! empty( $theme_custom_fonts ) ? json_decode( $theme_custom_fonts ) : array();

		if ( is_array( $theme_custom_fonts ) && ! empty( $theme_custom_fonts ) ) {
			foreach ( $theme_custom_fonts as $key => $fonts ) {
				if ( ! empty( $fonts[0] ) ) {
					$fontfamily           = str_replace( " ", "-", $fonts[0] );
					$filesystem           = Litho_filesystem::init_filesystem();
					$upload_dir           = wp_upload_dir();
					$targetdir            = untrailingslashit( wp_normalize_path( $upload_dir['basedir'] ) ) . '/litho-fonts/' . $fontfamily;
					$srcdir               = untrailingslashit( wp_normalize_path( $upload_dir['basedir'] ) ) . '/litho-fonts/litho-temp-fonts';
					$font_family_location = $srcdir . '/' . $fontfamily;

					if ( ! file_exists( $targetdir ) ) {
						wp_mkdir_p( $targetdir );
						copy_dir( $font_family_location, $targetdir );
						if ( file_exists( $font_family_location ) ) {
							$filesystem->delete( $font_family_location, FS_CHMOD_DIR );
						}
					} else {
						copy_dir( $font_family_location, $targetdir );
						if ( file_exists( $font_family_location ) ) {
							$filesystem->delete( $font_family_location, FS_CHMOD_DIR );
						}
					}
				}
			}
		}
	}
}
add_action( 'customize_controls_init', 'litho_customize_preview_init' );

// Customize custom fonts uploads Ajax callback
if ( ! function_exists( 'litho_upload_custom_font_action_data' ) ) {
	function litho_upload_custom_font_action_data() {

		$mime_type = '';
		$output    = array();

		if ( ! isset( $_FILES['file'] ) || empty( $_FILES['file'] ) ) {
			return;
		}
		$file      = $_FILES['file'];
		$filename  = $_FILES['file']['name'];
		$type      = $_FILES['file']['type'];
		$ext       = pathinfo( $filename, PATHINFO_EXTENSION);
		$font_type = ( isset( $_POST['font_type'] ) && ! empty( $_POST['font_type'] ) ) ? $_POST['font_type'] : esc_html__( 'Current', 'litho-addons' );

		if ( isset( $_POST['mime_type'] ) && ! empty( $_POST['mime_type'] ) ) {
			$mime_type = explode( ',', $_POST['mime_type'] );
		}

		if ( $ext === $font_type ) {

			add_filter( 'upload_dir', 'litho_custom_font_upload_dir' );
			$upload_result = wp_handle_upload( $file, [ 'test_form' => false ] );
			remove_filter( 'upload_dir', 'litho_custom_font_upload_dir' );

			$output['flag']    = true;
			$output['message'] = sprintf( '%1$s %2$s %3$s', esc_html__( 'Your', 'litho-addons' ), $font_type, esc_html__( 'file was uploaded', 'litho-addons' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$output['url']     = $upload_result['url'];

			echo json_encode( $output );
			die();

		} else {

			$output['flag']    = false;
			$output['message'] = sprintf( '%1$s %2$s %3$s', esc_html__( 'The file you are trying to upload is not a', 'litho-addons' ), $font_type, esc_html__( 'file. Please try again.', 'litho-addons' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo json_encode( $output );
			die();
		}
	}
}
add_action( 'wp_ajax_litho_upload_custom_font_action_data', 'litho_upload_custom_font_action_data' );
add_action( 'wp_ajax_nopriv_litho_upload_custom_font_action_data', 'litho_upload_custom_font_action_data' );

// Customize custom fonts upload dir
if ( ! function_exists( 'litho_custom_font_upload_dir' ) ) {
	function litho_custom_font_upload_dir( $path ) {

		if ( ! empty( $path['error'] ) ) {
			return $path;
		}

		if ( isset( $_POST['fontFamily'] ) && ! empty( $_POST['fontFamily'] ) ) { // phpcs:ignore
			$font_family = ( isset( $_POST['fontFamily'] ) && ! empty( $_POST['fontFamily'] ) ) ? $_POST['fontFamily'] : ''; // phpcs:ignore
			$font_family = str_replace( ' ', '-', $font_family );
			$customdir   = '/litho-fonts/' . $font_family; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			$path['path'] = str_replace( $path['subdir'], '', $path['path'] );
			$path['url']  = str_replace( $path['subdir'], '', $path['url'] );

			$path['subdir'] = $customdir; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$path['path']  .= $customdir; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$path['url']   .= $customdir; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		return $path;
	}
}

// Check if section builder template type is post archive.
if ( ! function_exists( 'is_section_builder_archive_template' ) ) {
	function is_section_builder_archive_template() {

		global $post;

		if ( is_category() || is_archive() || is_author() || is_tag() || is_search() || is_home() ) {
			return true;
		}

		if ( empty( $post->ID ) || ! isset( $post->ID )) {
			return false;
		}

		$litho_get_template_type = litho_post_meta_by_id( $post->ID, 'litho_section_builder_template' );

		if ( 'sectionbuilder' === $post->post_type && ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) {

			if ( 'archive' === $litho_get_template_type ) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
}

// Check if section builder template type is portfolio archive.
if ( ! function_exists( 'is_section_builder_archive_portfolio_template' ) ) {
	function is_section_builder_archive_portfolio_template() {

		global $post;

		if ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) {
			return true;
		}

		if ( empty( $post->ID ) || ! isset( $post->ID )) {
			return false;
		}

		$litho_get_template_type = litho_post_meta_by_id( $post->ID, 'litho_section_builder_template' );

		if ( 'sectionbuilder' === $post->post_type && ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) {

			if ( 'archive-portfolio' === $litho_get_template_type ) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
}

// Check if section builder template type is custom title.
if ( ! function_exists( 'is_section_builder_page_title_template' ) ) {
	function is_section_builder_page_title_template() {

		global $post;

		if ( is_category() || is_archive() || is_author() || is_tag() || is_search() || is_home() || is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) || ( is_woocommerce_activated() && ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_tax( 'product_brand' ) ) ) ) {
			return true;
		}

		if ( empty( $post->ID ) || ! isset( $post->ID )) {
			return false;
		}

		$litho_get_template_type = litho_post_meta_by_id( $post->ID, 'litho_section_builder_template' );

		if ( 'sectionbuilder' === $post->post_type && ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) {

			if ( ( 'custom-title' === $litho_get_template_type ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
}

// Return template type.
if ( ! function_exists( 'litho_get_template_type_by_key' ) ) {
	function litho_get_template_type_by_key( $template_type = '' ) {

		$template_type_data = litho_section_builder_template_types();
		$template_type_data = ! empty( $template_type ) && isset( $template_type_data[ $template_type ] ) ? $template_type_data[ $template_type ] : $template_type_data;
		return $template_type_data;
	}
}

// Return section builder template array.
if ( ! function_exists( 'litho_section_builder_template_types' ) ) {
	function litho_section_builder_template_types() {
		$litho_template_type = array(
			'mini-header'       => esc_html__( 'Mini Header', 'litho-addons' ),
			'header'            => esc_html__( 'Header', 'litho-addons' ),
			'footer'            => esc_html__( 'Footer', 'litho-addons' ),
			'archive'           => esc_html__( 'Archive', 'litho-addons' ),
			'archive-portfolio' => esc_html__( 'Archive Portfolio', 'litho-addons' ),
			'custom-title'      => esc_html__( 'Page Title', 'litho-addons' ),
			'promo_popup'       => esc_html__( 'Promo popup', 'litho-addons' ),
			'side_icon'         => esc_html__( 'Side Icon', 'litho-addons' ),
		);
		return $litho_template_type;
	}
}

// Return header sticky type.
if ( ! function_exists( 'litho_get_header_sticky_type_by_key' ) ) {
	function litho_get_header_sticky_type_by_key( $header_sticky_type = '' ) {

		$header_sticky_type_data = array(
			'appear-down-scroll' => esc_html__( 'Sticky on down scroll', 'litho-addons' ),
			'appear-up-scroll'   => esc_html__( 'Sticky on up scroll', 'litho-addons' ),
			'shrink-nav'         => esc_html__( 'Shrink', 'litho-addons' ),
			'no-sticky'          => esc_html__( 'Non sticky', 'litho-addons' ),
		);
		return ! empty( $header_sticky_type ) ? $header_sticky_type_data[ $header_sticky_type ] : $header_sticky_type_data;
	}
}

// Return header layout style.
if ( ! function_exists( 'litho_get_header_style_by_key' ) ) {
	function litho_get_header_style_by_key( $header_style = '' ) {

		$header_style_data = array(
			'standard'          => esc_html__( 'Standard', 'litho-addons' ),
			'left-menu-classic' => esc_html__( 'Left Menu Classic', 'litho-addons' ),
			'left-menu-modern'  => esc_html__( 'Left Menu Modern', 'litho-addons' ),
		);
		return ! empty( $header_style ) ? $header_style_data[ $header_style ] : $header_style_data;
	}
}

// Return mini header sticky type.
if ( ! function_exists( 'litho_get_mini_header_sticky_type_by_key' ) ) {
	function litho_get_mini_header_sticky_type_by_key( $mini_header_sticky_type = '' ) {

		$mini_header_sticky_type_data = array(
			'appear-down-scroll' => esc_html__( 'Sticky on down scroll', 'litho-addons' ),
			'appear-up-scroll'   => esc_html__( 'Sticky on up scroll', 'litho-addons' ),
			'no-sticky'          => esc_html__( 'Non sticky', 'litho-addons' ),
		);
		return ! empty( $mini_header_sticky_type ) ? $mini_header_sticky_type_data[ $mini_header_sticky_type ] : $mini_header_sticky_type_data;
	}
}

// Return footer sticky type.
if ( ! function_exists( 'litho_get_footer_sticky_type_by_key' ) ) {
	function litho_get_footer_sticky_type_by_key( $footer_sticky_type = '' ) {

		$footer_sticky_type_data = array(
			'no-sticky' => esc_html__( 'Non sticky', 'litho-addons' ),
			'sticky'    => esc_html__( 'Sticky', 'litho-addons' ),
		);
		return ! empty( $footer_sticky_type ) ? $footer_sticky_type_data[ $footer_sticky_type ] : $footer_sticky_type_data;
	}
}

// Return archive style.
if ( ! function_exists( 'litho_get_archive_style_by_key' ) ) {
	function litho_get_archive_style_by_key( $archive_style = '' ) {

		$archive_style_data = array(
			'general'           => esc_html__( 'General', 'litho-addons' ),
			'category-archives' => esc_html__( 'Category', 'litho-addons' ),
			'tag-archives'      => esc_html__( 'Tag', 'litho-addons' ),
			'author-archives'   => esc_html__( 'Author', 'litho-addons' ),
			'search-archives'   => esc_html__( 'Search', 'litho-addons' ),
		);
		return ! empty( $archive_style ) ? $archive_style_data[ $archive_style ] : $archive_style_data;
	}
}

// Return archive portfolio style.
if ( ! function_exists( 'litho_get_archive_portfolio_style_by_key' ) ) {
	function litho_get_archive_portfolio_style_by_key( $archive_portfolio_style = '' ) {

		$archive_portfolio_style_data = array(
			'general'                 => esc_html__( 'General', 'litho-addons' ),
			'portfolio-cat-archives'  => esc_html__( 'Portfolio Category', 'litho-addons' ),
			'portfolio-tags-archives' => esc_html__( 'Portfolio Tags', 'litho-addons' ),
			'portfolio-archives'      => esc_html__( 'Portfolio Archive', 'litho-addons' ),
		);
		return ! empty( $archive_portfolio_style ) ? $archive_portfolio_style_data[ $archive_portfolio_style ] : $archive_portfolio_style_data;
	}
}

/* To get section builder template list */
if ( ! function_exists( 'litho_get_builder_section_data' ) ) {
	function litho_get_builder_section_data( $section_type = '', $meta = false, $general = false ) {

		$builder_section_data = array();

		if ( empty( $section_type ) ) {
			return $builder_section_data;
		}

		$litho_filter_section = ( $section_type ) ? array( 'key' => '_litho_section_builder_template', 'value' => $section_type, 'compare' => '=' ) : array();

		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'sectionbuilder',
			'post_status'    => 'publish',
			'meta_query'     => array(
				$litho_filter_section,
			),
		);

		$posts_data = get_posts( $args );

		$builder_section_data[''] = esc_html__( 'Default', 'litho-addons' );

		if ( ! empty( $posts_data ) ) {
			foreach ( $posts_data as $key => $value ) {
				$builder_section_data[ $value->ID ] = esc_html( $value->post_title );
			}
		}
		return $builder_section_data;
	}
}

/* Check current page is sectionbuilder or not */
if ( ! function_exists( 'is_sectionbuilder_screen' ) ) {
	function is_sectionbuilder_screen() {

		global $pagenow, $typenow;

		if ( 'sectionbuilder' === $typenow && ( 'edit.php' === $pagenow || 'post.php' === $pagenow ) ) {
			return true;
		}
		return false;
	}
}

/* AJAX callback to save mega menu settings */
if ( ! function_exists( 'litho_save_mega_menu_settings' ) ) {
	function litho_save_mega_menu_settings() {

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'You are not allowed to do this', 'litho-addons' ),
				)
			);
		}

		$current_menu_itemt_id = ( isset( $_POST['current_menu_itemt_id'] ) ) ? absint( $_POST['current_menu_itemt_id'] ) : false;

		if ( ! $current_menu_itemt_id ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Incorrect input data', 'litho-addons' ),
				)
			);
		}

		if ( ! isset( $_POST['enable_mega_submenu'] ) ) {
			$_POST['enable_mega_submenu'] = '';
		}
		$enable_mega_submenu = $_POST['enable_mega_submenu'];
		update_post_meta( $current_menu_itemt_id, '_enable_mega_submenu', $enable_mega_submenu );

		if ( ! isset( $_POST['menu-item-icon'] ) ) {
			$_POST['menu-item-icon'] = '';
		}
		$menu_item_icon = $_POST['menu-item-icon'];
		update_post_meta( $current_menu_itemt_id, '_menu_item_icon', $menu_item_icon );

		if ( ! isset( $_POST['menu-item-icon-position'] ) ) {
			$_POST['menu-item-icon-position'] = '';
		}
		$menu_item_icon_position = $_POST['menu-item-icon-position'];
		update_post_meta( $current_menu_itemt_id, '_menu_item_icon_position', $menu_item_icon_position );

		if ( ! isset( $_POST['menu-item-icon-color'] ) ) {
			$_POST['menu-item-icon-color'] = '';
		}
		$menu_item_icon_color = $_POST['menu-item-icon-color'];
		update_post_meta( $current_menu_itemt_id, '_menu_item_icon_color', $menu_item_icon_color );

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Success!', 'litho-addons' ),
			)
		);
		die();
	}
}
add_action( 'wp_ajax_litho_save_mega_menu_settings', 'litho_save_mega_menu_settings' );
add_action( 'wp_ajax_nopriv_litho_save_mega_menu_settings', 'litho_save_mega_menu_settings' );

/* AJAX callback to add new template with lightbox */
if ( ! function_exists( 'litho_section_builder_lightbox' ) ) {

	function litho_section_builder_lightbox() {

		$output = '';
		if ( ! isset( $_REQUEST['sectionbuilder_template_type'] ) && empty( $_REQUEST['sectionbuilder_template_type'] ) ) {
			return;
		}
		$sectionbuilder_template_type              = $_REQUEST['sectionbuilder_template_type'];
		$sectionbuilder_template_style             = ( isset( $_REQUEST['sectionbuilder_template_style'] ) && ! empty( $_REQUEST['sectionbuilder_template_style'] ) ) ? $_REQUEST['sectionbuilder_template_style'] : 'standard';
		$sectionbuilder_template_title             = ( isset( $_REQUEST['sectionbuilder_template_title'] ) && ! empty( $_REQUEST['sectionbuilder_template_title'] ) ) ? $_REQUEST['sectionbuilder_template_title'] : '';
		$sectionbuilder_template_archive           = ( isset( $_REQUEST['sectionbuilder_template_archive'] ) && ! empty( $_REQUEST['sectionbuilder_template_archive'] ) ) ? $_REQUEST['sectionbuilder_template_archive'] : '';
		$sectionbuilder_template_archive_portfolio = ( isset( $_REQUEST['sectionbuilder_template_archive_portfolio'] ) && ! empty( $_REQUEST['sectionbuilder_template_archive_portfolio'] ) ) ? $_REQUEST['sectionbuilder_template_archive_portfolio'] : '';

		$meta_query_arr = array(
			'_litho_section_builder_template' => $sectionbuilder_template_type
		);

		if ( 'header' === $sectionbuilder_template_type ) {
			$meta_query_arr['_litho_template_header_style'] = $sectionbuilder_template_style;
		}
		if ( 'archive' === $sectionbuilder_template_type ) {
			$meta_query_arr['_litho_template_archive_style'] = $sectionbuilder_template_archive;
		}

		if ( 'archive-portfolio' === $sectionbuilder_template_archive_portfolio ) {
			$meta_query_arr['_litho_template_archive_portfolio_style'] = $sectionbuilder_template_archive_portfolio;
		}

		$sectionbuilder_last_postID = wp_insert_post(
			array(
				'post_title' => $sectionbuilder_template_title,
				'post_type'  => 'sectionbuilder',
				'meta_input' => $meta_query_arr,
			),
			true
		);

		if ( empty( $sectionbuilder_template_title ) ) {
			$sectionbuilder_post_data = array(
				'ID'          => $sectionbuilder_last_postID,
				'post_title'  => sprintf( '%1$s %2$s %3$s%4$s', esc_html__( 'Section', 'litho-addons' ), esc_html__( ucfirst( $sectionbuilder_template_type ) ), esc_html__( '#', 'litho-addons' ), esc_html( $sectionbuilder_last_postID ) )
			);
			wp_update_post( $sectionbuilder_post_data );
		}

		$output = add_query_arg( array(
			'post'      => $sectionbuilder_last_postID,
			'action'    => 'elementor',
		), admin_url( "edit.php" ) );

		printf( $output );
		die();
	}
}
add_action( 'wp_ajax_litho_section_builder_lightbox', 'litho_section_builder_lightbox' );
add_action( 'wp_ajax_nopriv_litho_section_builder_lightbox', 'litho_section_builder_lightbox' );

/* Section Builder - Added templete to view as popup*/
if ( ! function_exists( 'litho_admin_new_template_lightbox' ) ) {
	function litho_admin_new_template_lightbox() {
		if ( is_sectionbuilder_screen() ) {

			global $post, $pagenow;
			$litho_current_template          = '';
			$litho_current_header            = '';
			$litho_current_archive           = '';
			$litho_current_archive_portfolio = '';

			if ( is_admin() && 'post.php' === $pagenow ) {

				$litho_current_template          = get_post_meta( $post->ID, '_litho_section_builder_template', true );
				$litho_current_header            = get_post_meta( $post->ID, '_litho_template_header_style', true );
				$litho_current_archive           = get_post_meta( $post->ID, '_litho_template_archive_style', true );
				$litho_current_archive_portfolio = get_post_meta( $post->ID, '_litho_template_archive_portfolio_style', true );
			}
			?>
			<div class="sectionbuilder-outer">
				<div class="sectionbuilder-inner">
					<button class="close"><?php echo esc_html__( 'X', 'litho-addons' ); ?></button>
					<form class="sectionbuilder-new-template-form">
						<div class="sectionbuilder-new-template-form-title">
							<?php echo esc_html__( 'Choose Template Type', 'litho-addons' ); ?>
						</div>
						<div class="sectionbuilder-form-field">
							<div class="template-form-field">
								<label for="sectionbuilder-template-type" class="sectionbuilder-new-template-form-label">
									<?php echo esc_html__( 'Select the type of template', 'litho-addons' ); ?>
								</label>
								<div class="sectionbuilder-form-field-select-wrapper">
									<select id="sectionbuilder-template-type" class="sectionbuilder-form-field-select sectionbuilder-dropdown" name="template_type" required="required" autocomplete="off">
									<?php
									$litho_types = litho_section_builder_template_types();
									foreach ( $litho_types as $key => $value ) {
										if ( ! empty( $litho_current_template ) && 'post.php' === $pagenow ) {
											$selected = ( $litho_current_template === $key ) ? ' selected="selected"' : '';
										} else {
											$selected = ( 'header' === $key ) ? ' selected="selected"' : '';
										}
										?>
										<option value="<?php echo esc_attr( $key ); ?>"<?php echo esc_attr( $selected ); ?>>
										<?php
											echo esc_attr( $value );
										?>
										</option>
										<?php
									}
									?>
									</select>
								</div>
							</div>
							<div class="header-form-field input-field-control">
								<label for="sectionbuilder-template-style" class="sectionbuilder-new-template-form-label">
									<?php echo esc_html__( 'Select the style of header', 'litho-addons' ); ?>
								</label>
								<div class="sectionbuilder-form-field-select-wrapper">
									<select id="sectionbuilder-template-style" class="sectionbuilder-form-field-select-style sectionbuilder-dropdown" name="template_style" required="required">
									<?php
									$litho_header_style = litho_get_header_style_by_key();
									foreach ( $litho_header_style as $key => $value ) {
										if ( ! empty( $litho_current_header ) && 'post.php' === $pagenow ) {
											$selected = ( $litho_current_header === $key ) ? ' selected="selected"' : '';
										} else {
											$selected = ( 'standard' === $key ) ? ' selected="selected"' : '';
										}
										?>
										<option value="<?php echo esc_attr( $key ); ?>"<?php echo esc_attr( $selected ); ?>>
										<?php
											echo esc_attr( $value );
										?>
										</option>
										<?php
									}
									?>
									</select>
								</div>
							</div>
							<div class="archive-form-field input-field-control" style="display: none;">
								<label for="sectionbuilder-archive-style" class="sectionbuilder-new-template-form-label">
									<?php echo esc_html__( 'Select archive', 'litho-addons' ); ?>
								</label>
								<div class="sectionbuilder-form-field-select-wrapper">
									<select id="sectionbuilder-archive-style" class="sectionbuilder-form-field-archive-style litho-dropdown-select2 sectionbuilder-dropdown" name="archive_style[]" multiple="multiple" style="width:99%;max-width:25em;">
										<?php
										$litho_archive_style = litho_get_archive_style_by_key();
										foreach ( $litho_archive_style as $key => $value ) {

											if ( ! empty( $litho_current_archive ) && is_array( $litho_current_archive ) && 'post.php' === $pagenow ) {
												$selected = ( in_array( $key, $litho_current_archive ) ) ? ' selected="selected"' : '';
											} else {
												$selected = ( 'general' === $key ) ? ' selected="selected"' : '';
											}
											?>
											<option value="<?php echo esc_attr( $key ); ?>"<?php echo esc_attr( $selected ); ?>><?php echo esc_attr( $value ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="archive-portfolio-form-field input-field-control" style="display: none;">
								<label for="sectionbuilder-archive-portfolio-style" class="sectionbuilder-new-template-form-label">
									<?php echo esc_html__( 'Select archive portfolio', 'litho-addons' ); ?>
								</label>
								<div class="sectionbuilder-form-field-select-wrapper">
									<select id="sectionbuilder-archive-portfolio-style" class="sectionbuilder-form-field-archive-portfolio-style litho-dropdown-select2 sectionbuilder-dropdown" name="archive_portfolio_style[]" multiple="multiple" style="width:99%;max-width:25em;">
										<?php
										$litho_archive_portfolio_style = litho_get_archive_portfolio_style_by_key();
										foreach ( $litho_archive_portfolio_style as $key => $value ) {

											if ( ! empty( $litho_current_archive_portfolio ) && is_array( $litho_current_archive_portfolio ) && 'post.php' === $pagenow ) {
												$selected = ( in_array( $key, $litho_current_archive_portfolio ) ) ? ' selected="selected"' : '';
											} else {
												$selected = ( 'general' === $key ) ? ' selected="selected"' : '';
											}
											?>
											<option value="<?php echo esc_attr( $key ); ?>"<?php echo esc_attr( $selected ); ?>><?php echo esc_attr( $value ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="sectionbuilder-form-field">
							<label for="sectionbuilder-new-template-form-post-title" class="sectionbuilder-new-template-form-label">
								<?php echo esc_html__( 'Name your template', 'litho-addons' ); ?>
							</label>
							<input type="text" placeholder="<?php echo esc_attr__( 'Enter template name (optional)', 'litho-addons' ); ?>" id="sectionbuilder-new-template-form-post-title" class="sectionbuilder-new-template-form-post-title" name="sectionbuilder-new-template-post-title">
						</div>
						<button id="sectionbuilder-form-submit" class="create-template-button">
							<?php echo esc_html__( 'Create Template', 'litho-addons' ); ?>
						</button>
					</form>
				</div>
			</div>
		<?php
		}
	}
}
add_action( 'admin_footer', 'litho_admin_new_template_lightbox' );

// Add alternate image for portfolio.
if ( ! function_exists( 'litho_add_portfolio_meta_box' ) ) {
	function litho_add_portfolio_meta_box() {

		add_meta_box( 'litho-portfolio-alternate-image', esc_html__( 'Alternate image', 'litho-addons' ), 'litho_portfolio_alternate_image_content', 'portfolio', 'side', 'low' );
	}
}
add_action( 'add_meta_boxes', 'litho_add_portfolio_meta_box' );

if ( ! function_exists( 'litho_portfolio_alternate_image_content' ) ) {

	function litho_portfolio_alternate_image_content( $post ) {

		$id               = 'portfolio_alternate_image';
		$alternate_img_id = get_post_meta( $post->ID, '_litho_portfolio_alternate_image_single', true );
		$nonce            = wp_create_nonce( $id . $post->ID );

		if ( $alternate_img_id ) {
			$link_title         = wp_get_attachment_image( $alternate_img_id, 'full', false, array( 'style' => 'width:100%; height:auto;' ) );
			$hide_remove_button = '';
		} else {
			$alternate_img_id   = -1;
			$link_title         = esc_html__( 'Add alternate portfolio image', 'litho-addons' );
			$hide_remove_button = 'display: none;';
		}
		?>
		<p class="hide-if-no-js portfolio-alternate-image-container-<?php echo esc_attr( $id ); ?>">
			<a href="#" class="portfolio-alternate-add-media portfolio-alternate-media-edit portfolio-alternate-media-edit-<?php echo esc_attr( $id ); ?>" data-title="<?php esc_html_e( 'Alternate image', 'litho-addons' ); ?>" data-button="<?php esc_html_e( 'Use as alternate portfolio image', 'litho-addons' ); ?>" data-id="<?php echo esc_attr( $id ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>" data-postid="<?php echo esc_attr( $post->ID ); ?>" style="display: inline-block;">
				<?php echo wp_kses_post( $link_title ); ?>
			</a>
		</p>
		<p class="hide-if-no-js howto" style="<?php echo esc_attr( $hide_remove_button ); ?>"><?php esc_html_e( 'Click the image to edit or update', 'litho-addons' ); ?></p>

		<p class="hide-if-no-js hide-if-no-image-<?php echo esc_attr( $id ); ?>" style="<?php echo esc_attr( $hide_remove_button ); ?>">
			<a href="#" class="portfolio-alternate-media-delete portfolio-alternate-media-delete-<?php echo esc_attr( $id ); ?>" data-title="<?php esc_html_e( 'Alternate image', 'litho-addons' ); ?>" data-button="<?php esc_html_e( 'Use as alternate portfolio image', 'litho-addons' ); ?>" data-id="<?php echo esc_attr( $id ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>" data-postid="<?php echo esc_attr( $post->ID ); ?>" data-label_set="<?php esc_html_e( 'Add alternate portfolio image', 'litho-addons' ); ?>">
				<?php esc_html_e( 'Remove alternate portfolio image', 'litho-addons' ); ?>
			</a>
		</p>
		<?php
	}
}

if ( ! function_exists( 'litho_ajax_set_portfolio_alternate_image' ) ) {
	function litho_ajax_set_portfolio_alternate_image() {

		$alt_img_id = intval( $_POST['alt_img_id'] );
		$postid     = intval( $_POST['postid'] );
		$id         = $_POST['id'];

		check_ajax_referer( $id . $postid, 'sec' );

		if ( wp_attachment_is_image( $alt_img_id ) ) {
			echo wp_get_attachment_image( $alt_img_id, 'full', false, array( 'style' => 'width:100%; height:auto;' ) );
			update_post_meta( $postid, '_litho_portfolio_alternate_image_single', $alt_img_id );
		}
		wp_die();
	}
}

if ( ! function_exists( 'litho_ajax_remove_portfolio_alternate_image' ) ) {
	function litho_ajax_remove_portfolio_alternate_image() {

		$postid    = intval( $_POST['postid'] );
		$label_set = $_POST['label_set'];
		$id        = $_POST['id'];

		check_ajax_referer( $id . $postid, 'sec' );
		delete_post_meta( $postid, '_litho_portfolio_alternate_image_single' );
		echo esc_attr( $label_set );

		wp_die();
	}
}

add_action( 'wp_ajax_set_portfolio_alternate_image', 'litho_ajax_set_portfolio_alternate_image' );
add_action( 'wp_ajax_remove_portfolio_alternate_image', 'litho_ajax_remove_portfolio_alternate_image' );

/* Meta add for address bar color */
if ( ! function_exists( 'litho_addressbar_color_wp_head_meta' ) ) {
	function litho_addressbar_color_wp_head_meta() {

		$litho_addressbar_color = get_theme_mod( 'litho_addressbar_color', '' );

		if ( ! empty( $litho_addressbar_color ) ) {

			//this is for Chrome, Firefox OS, Opera
			echo '<meta name="theme-color" content="' . $litho_addressbar_color . '">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			//Windows Phone **
			echo '<meta name="msapplication-navbutton-color" content="' . $litho_addressbar_color . '">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
		}
	}
}
add_action( 'wp_head', 'litho_addressbar_color_wp_head_meta' );

/* Return litho custom hover animation effect */
if ( ! function_exists( 'litho_custom_hover_animation_effect' ) ) {
	function litho_custom_hover_animation_effect() {

		$button_hover_animation_effect_array = array(
			'btn-slide-up-bg',
			'btn-slide-down-bg',
			'btn-slide-left-bg',
			'btn-slide-right-bg',
			'btn-expand-ltr',
		);
		return apply_filters( 'litho_button_hover_animation_effect', $button_hover_animation_effect_array );
	}
}

/* Return post meta value */
if ( ! function_exists( 'litho_post_meta' ) ) {
	function litho_post_meta( $option ) {
		global $post;

		if ( empty( $post->ID ) ) {
			return;
		}
		// Meta Prefix.
		$meta_prefix = '_';

		$value = get_post_meta( $post->ID, $meta_prefix . $option . '_single', true );
		return $value;
	}
}

/* Return post meta id */
if ( ! function_exists( 'litho_post_meta_by_id' ) ) {
	function litho_post_meta_by_id( $id, $option ) {
		if ( ! $id ) {
			return;
		}
		// Meta Prefix.
		$meta_prefix = '_';

		$value = get_post_meta( $id, $meta_prefix . $option, true );
		return $value;
	}
}

/* Return post types array */
if ( ! function_exists( 'litho_get_post_types' ) ) {
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
		$_post_types    = get_post_types( $post_type_args, 'objects' );
		$post_types     = [];

		foreach ( $_post_types as $post_type => $object ) {
			$post_types[ $post_type ] = $object->label;
		}

		return apply_filters( 'litho_get_post_types/get_public_post_types', $post_types );
	}
}

// Woocommerce Pagination args.
if ( ! function_exists( 'litho_woocommerce_pagination_args' ) ) {
	function litho_woocommerce_pagination_args( $args ) {

		if ( isset( $args['prev_text'] ) ) {
			$args['prev_text'] = sprintf( '<i aria-hidden="true" class="feather icon-feather-arrow-left"></i>' );
		}

		if ( isset( $args['next_text'] ) ) {
			$args['next_text'] = sprintf( '<i aria-hidden="true" class="feather icon-feather-arrow-right"></i>' );
		}
		return $args;

	}
}
add_filter( 'woocommerce_pagination_args', 'litho_woocommerce_pagination_args' );

/* Return post categories array */
if ( ! function_exists( 'litho_post_category_array' ) ) {
	function litho_post_category_array() {

		$categories_array = array();

		$args = array(
			'hide_empty' => true,
			'orderby'    => 'name',
			'order'      => 'ASC',
		);

		$categories = get_categories( $args );
		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$categories_array[ $category->slug ] = $category->name;
			}
		}
		return $categories_array;
	}
}

// Get the Post Category.
if ( ! function_exists( 'litho_single_post_meta_category' ) ) {
	function litho_single_post_meta_category( $id, $icon = false ) {

		if ( '' == $id ) {
			return;
		}

		if ( 'post' == get_post_type() ) {
			$litho_term_limit = apply_filters( 'litho_single_post_category_limit', '40' );
			$category_list    = litho_post_category( $id, true, $litho_term_limit );
			$icon_data        = '';
			if ( $icon ) {
				$icon_data = '<i class="feather icon-feather-folder text-fast-blue"></i>';
			}
			if ( $category_list ) {
				printf( '<li>%1$s%2$s</li>', $icon_data, $category_list );
			}
		}
	}
}

if ( ! function_exists( 'litho_post_exists' ) ) {
	// Post exists or not.
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

if ( ! function_exists( 'litho_post_category' ) ) {
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

/* Return post tags array */
if ( ! function_exists( 'litho_post_tags_array' ) ) {
	function litho_post_tags_array() {

		$tags_array = array();

		$tags = get_terms(
			array(
				'taxonomy' => 'post_tag',
			)
		);

		if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
			foreach ( $tags as $tag ) {
				$tags_array[ $tag->slug ] = $tag->name;
			}
		}
		return $tags_array;
	}
}

/* Return post array */
if ( ! function_exists( 'litho_post_array' ) ) {
	function litho_post_array() {

		$post_array = array();

		$query_args = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'no_found_rows'  => true,
		);

		$the_query = new \WP_Query( $query_args );

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$post_array[ get_the_ID() ] = get_the_title();
			endwhile;
		}
		return $post_array;
	}
}

/* Return post array */
if ( ! function_exists( 'litho_portfolio_array' ) ) {
	function litho_portfolio_array() {

		$post_array = array();

		$query_args = array(
			'post_type'      => 'portfolio',
			'post_status'    => 'publish',
			'posts_per_page' => -1
		);

		$the_query = new \WP_Query( $query_args );

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$post_array[ get_the_ID() ] = get_the_title();
			endwhile;
		}
		return $post_array;
	}
}

/* Return portfolio category array */
if ( ! function_exists( 'litho_portfolio_category_array' ) ) {
	function litho_portfolio_category_array() {

		$categories_array = array();

		$categories = get_terms(
			array(
				'taxonomy' => 'portfolio-category',
			)
		);

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$categories_array[ $category->slug ] = $category->name;
			}
		}
		return $categories_array;
	}
}

/* Return portfolio tags array */
if ( ! function_exists( 'litho_portfolio_tags_array' ) ) {
	function litho_portfolio_tags_array() {

		$tags_array = array();

		$tags = get_terms(
			array(
				'taxonomy' => 'portfolio-tags',
			)
		);

		if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
			foreach ( $tags as $tag ) {
				$tags_array[ $tag->slug ] = $tag->name;
			}
		}
		return $tags_array;
	}
}

/* Return product category array */
if ( ! function_exists( 'litho_product_category_array' ) ) {
	function litho_product_category_array() {

		$categories_array = array();

		$categories = get_terms(
			array(
				'taxonomy' => 'product_cat',
			)
		);

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$categories_array[ $category->slug ] = $category->name;
			}
		}
		return $categories_array;
	}
}

/* Return product tags array */
if ( ! function_exists( 'litho_product_tags_array' ) ) {
	function litho_product_tags_array() {

		$tags_array = array();

		$tags = get_terms(
			array(
				'taxonomy' => 'product_tag',
			)
		);
		if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
			foreach ( $tags as $tag ) {
				$tags_array[ $tag->slug ] = $tag->name;
			}
		}
		return $tags_array;
	}
}

if ( ! function_exists( 'litho_option' ) ) {
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

				if ( is_string( $value ) && ( strlen( $value ) > 0 || is_array( $value ) ) && ( 'default' != $value ) ) {
					if ( strtolower( $value ) == '.' ) {
						$litho_option_value = '';
					} else {
						$litho_option_value = $value;
					}
				} else {
					$litho_option_value = get_theme_mod( $option, $default_value );
				}
			}else{
				$litho_option_value = get_theme_mod( $option, $default_value );
			}
		}
		return $litho_option_value;
	}
}

if ( ! function_exists( 'litho_builder_customize_option' ) ) {
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

				if ( is_string( $value ) && ( strlen( $value ) > 0 || is_array( $value ) ) && ( 'default' != $value ) ) {

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

/* Check For Product Brand, Product Tag, Product Category, Category & Tag Title */
if ( ! function_exists( 'litho_taxonomy_title_option' ) ) {
	function litho_taxonomy_title_option( $option, $default_value ) {

		$litho_option_value = '';
		$litho_t_id         = ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || ( is_woocommerce_activated() && ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_tax( 'product_brand' ) ) ) || is_category() || is_tag() ) ? get_queried_object()->term_id : get_query_var( 'cat' );

		$value = get_term_meta( $litho_t_id, $option, true );

		if ( strlen( $value ) > 0 && ( $value != 'default' ) && ( is_category() || is_tag() || is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || ( is_woocommerce_activated() && ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_tax( 'product_brand' ) ) ) ) && ! ( is_author() || is_search() ) ) {
			$litho_option_value = $value;
		} else {
			$litho_option_value = get_theme_mod( $option, $default_value );
		}

		return $litho_option_value;
	}
}

/* For Image Alt Text */
if ( ! function_exists( 'litho_option_image_alt' ) ) {
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

/* For Image Title Text */
if ( ! function_exists( 'litho_option_image_title' ) ) {
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

if ( ! function_exists( 'litho_get_intermediate_image_sizes' ) ) {
	function litho_get_intermediate_image_sizes() {
		global $wp_version;
		$image_sizes = array( 'full', 'thumbnail', 'medium', 'medium_large', 'large' ); // Standard sizes.
		if ( $wp_version >= '4.7.0' ) {
			$_wp_additional_image_sizes = wp_get_additional_image_sizes();
			if ( ! empty( $_wp_additional_image_sizes ) ) {
				$image_sizes = array_merge( $image_sizes, array_keys( $_wp_additional_image_sizes ) );
			}
			return apply_filters( 'intermediate_image_sizes', $image_sizes );
		} else {
			return $image_sizes;
		}
	}
}

/* For Get image srcset and sizes */
if ( ! function_exists( 'litho_get_image_srcset_sizes' ) ) {
	function litho_get_image_srcset_sizes( $attachment_id, $image_srcset ) {

		$srcset_data = '';
		$sizes_data  = '';
		$srcset      = ! empty( $attachment_id ) ? wp_get_attachment_image_srcset( $attachment_id, $image_srcset ) : '';
		if ( $srcset ) {
			$srcset_data = ' srcset="' . esc_attr( $srcset ) . '"';
		}

		if ( $srcset_data ) {
			$sizes = ! empty( $attachment_id ) ? wp_get_attachment_image_sizes( $attachment_id, $image_srcset ) : '';
			if ( $sizes ) {
				$sizes_data = ' sizes="' . esc_attr( $sizes ) . '"';
			}
		}

		return $srcset_data . $sizes_data;
	}
}

if ( ! function_exists( 'litho_get_thumbnail_image_sizes' ) ) {
	function litho_get_thumbnail_image_sizes() {

		$thumbnail_image_sizes = array();

		// Hackily add in the data link parameter.
		$litho_srcset = litho_get_intermediate_image_sizes();

		if ( ! empty( $litho_srcset ) ) {
			foreach ( $litho_srcset as $value => $label ) {

				$key                     = esc_attr( $label );
				$litho_srcset_image_data = litho_get_image_size( $label );

				if ( isset( $litho_srcset_image_data['width'] ) ) {
					if ( $litho_srcset_image_data['width'] == 0 ) {
						$width = esc_html__( 'Auto', 'litho-addons' );
					} else {
						$width = $litho_srcset_image_data['width'] . 'px';
					}
				} else {
					$width = esc_html__( 'Auto', 'litho-addons' );
				}

				if ( isset( $litho_srcset_image_data['height'] ) ) {
					if ( $litho_srcset_image_data['height'] == 0 ) {
						$height = esc_html__( 'Auto', 'litho-addons' );
					} else {
						$height = $litho_srcset_image_data['height'] . 'px';
					}
				} else {
					$height = esc_html__( 'Auto', 'litho-addons' );
				}

				if ( 'full' === $label ) {
					$data = esc_html__( 'Original Full Size', 'litho-addons' );
				} else {
					$data = ucwords( str_replace( '_', ' ', str_replace( '-', ' ', esc_attr( $label ) ) ) ) . ' (' . esc_attr( $width ) . ' X ' . esc_attr( $height ) . ')';
				}
				$thumbnail_image_sizes[ $key ] = $data;
			}
		}

		return $thumbnail_image_sizes;
	}
}

if ( ! function_exists( 'litho_get_image_sizes' ) ) {
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
	function litho_get_image_size( $size ) {
		$sizes = litho_get_image_sizes();

		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		}

		return false;
	}
}

if ( ! function_exists( 'litho_remove_wpautop' ) ) {
	function litho_remove_wpautop( $content, $force_br = true ) {
		if ( $force_br ) {
			$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
		}
		return do_shortcode( shortcode_unautop( $content ) );
	}
}

if ( ! function_exists( 'litho_get_the_post_content' ) ) {
	function litho_get_the_post_content() {
		return apply_filters( 'the_content', get_the_content() );
	}
}

if ( ! function_exists( 'litho_get_the_excerpt_theme' ) ) {
	function litho_get_the_excerpt_theme( $length ) {
		return Litho_Excerpt::litho_get_by_length( $length );
	}
}

if ( ! function_exists( 'litho_hex2rgb' ) ) {
	function litho_hex2rgb( $colour, $opacity = '0.4' ) {
		if ( empty( $colour ) ) {
			return;
		}
		if ( $colour[0] == '#' ) {
			$colour = substr( $colour, 1 );
		}
		if ( strlen( $colour ) == 6 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
		} elseif ( strlen( $colour ) == 3 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
		} else {
			return false;
		}
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );
		return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
	}
}

if ( ! function_exists( 'litho_extract_shortcode_contents' ) ) {
	/**
	 * Extract text contents from all shortcodes for usage in excerpts
	 *
	 * @return string The shortcode contents
	 **/
	function litho_extract_shortcode_contents( $m ) {
		global $shortcode_tags;

		// Setup the array of all registered shortcodes.
		$shortcodes = array_keys( $shortcode_tags );

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

// Pagination.
if ( ! function_exists( 'litho_get_pagination' ) ) {
	function litho_get_pagination() {

		global $wp_query;

		$current = ( $wp_query->query_vars['paged'] > 1 ) ? $wp_query->query_vars['paged'] : 1;

		if ( $wp_query->max_num_pages > 1 ) {
			?>
			<div class="col-12 litho-pagination">
				<div class="pagination align-items-center">
				<?php
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

if ( ! function_exists( 'litho_get_builder_content_for_display' ) ) {
	function litho_get_builder_content_for_display( $template_id ) {

		$template_content = '';

		if ( ! class_exists( 'Elementor\Plugin' ) ) {
			return;
		}

		if ( empty( $template_id ) ) {
			return;
		}

		$template_content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );

		return $template_content;
	}
}

/* Add mobile navigation body data attr */
if ( ! function_exists( 'litho_mobile_nav_body_attributes' ) ) {
	function litho_mobile_nav_body_attributes( $attributes ) {

		$litho_enable_header_general = litho_builder_customize_option( 'litho_enable_header_general', '1' );
		$litho_enable_header         = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
		$litho_header_section_id     = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );

		if ( ! litho_post_exists( $litho_header_section_id ) ) {
			$litho_header_section_id = get_theme_mod( 'litho_header_section' );
		}
		$litho_header_style                 = get_post_meta( $litho_header_section_id, '_litho_template_header_style', true );
		$litho_header_style                 = ( ! empty( $litho_header_style ) ) ? $litho_header_style : 'standard';
		$litho_header_mobile_menu_style     = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_style', true );
		$litho_header_mobile_menu_alignment = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_trigger_alignment', true );
		$litho_header_mobile_menu_bg_color  = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_bg_color', true );

		// Default Values.
		if ( 'standard' === $litho_header_style ) {

			$attributes['data-mobile-nav-style']             = ( ! empty( $litho_header_mobile_menu_style ) ) ? $litho_header_mobile_menu_style : 'classic';
			$attributes['data-mobile-nav-trigger-alignment'] = ( ! empty( $litho_header_mobile_menu_alignment ) ) ? $litho_header_mobile_menu_alignment : 'left';
			if ( $litho_header_mobile_menu_bg_color ) {
				$attributes['data-mobile-nav-bg-color'] = $litho_header_mobile_menu_bg_color;
			}
		}
		return $attributes;
	}
}
add_filter( 'litho_attr_body', 'litho_mobile_nav_body_attributes', 10 );

/* Add mobile navigation body data attr in Elementor preview */
if ( ! function_exists( 'litho_mobile_nav_body_attributes_elementor_preview' ) ) {
	function litho_mobile_nav_body_attributes_elementor_preview() {

		if ( is_singular( 'sectionbuilder' ) ) {

			$litho_enable_header_general        = litho_builder_customize_option( 'litho_enable_header_general', '1' );
			$litho_enable_header                = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
			$litho_header_section_id            = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );
			$litho_header_style                 = get_post_meta( $litho_header_section_id, '_litho_template_header_style', true );
			$litho_header_style                 = ( ! empty( $litho_header_style ) ) ? $litho_header_style : 'standard';
			$litho_header_mobile_menu_style     = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_style', true );
			$litho_header_mobile_menu_alignment = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_trigger_alignment', true );
			$litho_header_mobile_menu_bg_color  = get_post_meta( $litho_header_section_id, '_litho_header_mobile_menu_bg_color', true );

			$litho_header_mobile_menu_style     = ( ! empty( $litho_header_mobile_menu_style ) ) ? $litho_header_mobile_menu_style : 'classic';
			$litho_header_mobile_menu_alignment = ( ! empty( $litho_header_mobile_menu_alignment ) ) ? $litho_header_mobile_menu_alignment : 'left';

			if ( 'standard' === $litho_header_style ) {
				?>
				<script type="text/javascript">
					( function( $ ) {
						setTimeout( function () {
						$( 'body' ).attr( { 'data-mobile-nav-style': '<?php echo sprintf( '%s', $litho_header_mobile_menu_style ); // phpcs:ignore ?>', 'data-mobile-nav-trigger-alignment': '<?php echo sprintf( '%s', $litho_header_mobile_menu_alignment ); // phpcs:ignore ?>', 'data-mobile-nav-bg-color': '<?php echo sprintf( '%s', $litho_header_mobile_menu_bg_color ); // phpcs:ignore ?>' } );
					}, 1000 );
					})( jQuery );
				</script>
				<?php
			}
		}
	}
}
add_action( 'wp_head', 'litho_mobile_nav_body_attributes_elementor_preview' );

// [litho_single_post_share] Shortcode.
if ( ! function_exists( 'litho_single_post_share_shortcode' ) ) {
	function litho_single_post_share_shortcode() {
		global $post;

		if ( ! $post ) {
			return false;
		}

		$output                         = '';
		$litho_enable_share             = litho_option( 'litho_enable_share', '1' );
		$litho_single_post_social_share = litho_option( 'litho_single_post_social_sharing', array( 'facebook', '1', 'Facebook', 'twitter', '1', 'Twitter', 'linkedin', '1', 'Linkedin', 'pinterest', '1', 'Pinterest' ) );
		$permalink                      = get_permalink( $post->ID );
		$featured_image                 = urlencode( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) );
		$post_title                     = rawurlencode( get_the_title( $post->ID ) );
		ob_start();
		?>
		<?php if ( 1 == $litho_enable_share && ! empty( $litho_single_post_social_share ) ) { ?>
			<div class="social-icon-style-3 medium-icon blog-details-social-sharing">
				<ul>
					<?php
					$i = 0;

					$count = count( $litho_single_post_social_share );
					foreach ( $litho_single_post_social_share as $key => $value ) {
						if ( $i < $count ) {
							if ( $litho_single_post_social_share[ $i+1 ] == '1' ) {
								switch ( $litho_single_post_social_share[ $i ] ) {
									case 'facebook':
										?>
										<li><a class="social-sharing-icon facebook-f" href="//www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
										<?php
										break;
									case 'twitter':
										?>
										<li><a class="social-sharing-icon twitter" href="//twitter.com/share?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-x-twitter"></i><span></span></a></li>
										<?php
										break;
									case 'linkedin':
										?>
										<li><a class="social-sharing-icon linkedin-in" href="//linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
										<?php
										break;
									case 'pinterest':
										?>
										<li><a class="social-sharing-icon pinterest-p" href="//pinterest.com/pin/create/button/?url=<?php echo esc_url( $permalink ); ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo esc_attr ( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-pinterest-p"></i><span></span></a></li>
										<?php
										break;
									case 'reddit':
										?>
										<li><a class="social-sharing-icon reddit" href="//reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-reddit"></i><span></span></a></li>
										<?php
										break;
									case 'stumbleupon':
										?>
										<li><a class="social-sharing-icon stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-stumbleupon"></i><span></span></a></li>
										<?php
										break;
									case 'digg':
										?>
										<li><a class="social-sharing-icon digg" href="//www.digg.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-digg"></i><span></span></a></li>
										<?php
										break;
									case 'vk':
										?>
										<li><a class="social-sharing-icon vk" href="//vk.com/share.php?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-vk"></i><span></span></a></li>
										<?php
										break;
									case 'xing':
										?>
										<li><a class="social-sharing-icon xing" href="//www.xing.com/app/user?op=share&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" data-pin-custom="true"><i class="fa-brands fa-xing"></i><span></span></a></li>
										<?php
										break;
									case 'telegram':
										?>
										<li><a class="social-sharing-icon telegram-plane" href="//t.me/share/url?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-telegram-plane"></i><span></span></a></li>
										<?php
										break;
									case 'ok':
										?>
										<li><a class="social-sharing-icon odnoklassniki" href="//connect.ok.ru/offer?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-odnoklassniki"></i><span></span></a></li>
										<?php
										break;
									case 'viber':
										?>
										<li><a class="social-sharing-icon viber" href="//viber://forward?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-viber"></i><span></span></a></li>
										<?php
										break;
									case 'whatsapp':
										?>
										<li><a class="social-sharing-icon whatsapp" href="//api.whatsapp.com/send?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-whatsapp"></i><span></span></a></li>
										<?php
										break;
									case 'skype':
										?>
										<li><a class="social-sharing-icon skype" href="//web.skype.com/share?source=button&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-skype"></i><span></span></a></li>
										<?php
										break;
								}
							}
							$i = $i + 3;
						}
					}
					?>
				</ul>
			</div>
		<?php } ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}
add_shortcode( 'litho_single_post_share', 'litho_single_post_share_shortcode' );

// [litho_single_portfolio_share] Shortcode.
if ( ! function_exists( 'litho_single_portfolio_share_shortcode' ) ) {

	function litho_single_portfolio_share_shortcode() {
		global $post;

		if ( ! $post ) {
			return false;
		}

		$output                              = '';
		$litho_hide_single_portfolio_share   = litho_option( 'litho_hide_single_portfolio_share', '1' );
		$litho_single_portfolio_social_share = litho_option( 'litho_single_portfolio_social_sharing', '' );
		$permalink                           = get_permalink( $post->ID );
		$featured_image                      = urlencode( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) );
		$post_title                          = rawurlencode( get_the_title( $post->ID ) );

		if ( 1 == $litho_hide_single_portfolio_share && ! empty( $litho_single_portfolio_social_share ) ) {
			?>
			<div class="social-icon-style-3 medium-icon blog-details-social-sharing">
				<ul>
					<?php
					$i = 0;

					$count = count( $litho_single_portfolio_social_share );
					foreach ( $litho_single_portfolio_social_share as $key => $value ) {
						if ( $i < $count ) {
							if ( '1' == $litho_single_portfolio_social_share[ $i+1 ] ) {
								switch ( $litho_single_portfolio_social_share[ $i ] ) {
									case 'facebook':
										?>
										<li><a class="social-sharing-icon facebook-f" href="//www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
										<?php
										break;
									case 'twitter':
										?>
										<li><a class="social-sharing-icon twitter" href="//twitter.com/share?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-x-twitter"></i><span></span></a></li>
										<?php
										break;
									case 'linkedin':
										?>
										<li><a class="social-sharing-icon linkedin-in" href="//linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
										<?php
										break;
									case 'pinterest':
										?>
										<li><a class="social-sharing-icon pinterest-p" href="//pinterest.com/pin/create/button/?url=<?php echo esc_url( $permalink ); ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo esc_attr ( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-pinterest-p"></i><span></span></a></li>
										<?php
										break;
									case 'reddit':
										?>
										<li><a class="social-sharing-icon reddit" href="//reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-reddit"></i><span></span></a></li>
										<?php
										break;
									case 'stumbleupon':
										?>
										<li><a class="social-sharing-icon stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-stumbleupon"></i><span></span></a></li>
										<?php
										break;
									case 'digg':
										?>
										<li><a class="social-sharing-icon digg" href="//www.digg.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-digg"></i><span></span></a></li>
										<?php
										break;
									case 'vk':
										?>
										<li><a class="social-sharing-icon vk" href="//vk.com/share.php?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-vk"></i><span></span></a></li>
										<?php
										break;
									case 'xing':
										?>
										<li><a class="social-sharing-icon xing" href="//www.xing.com/app/user?op=share&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" data-pin-custom="true"><i class="fa-brands fa-xing"></i><span></span></a></li>
										<?php
										break;
									case 'telegram':
										?>
										<li><a class="social-sharing-icon telegram-plane" href="//t.me/share/url?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-telegram-plane"></i><span></span></a></li>
										<?php
										break;
									case 'ok':
										?>
										<li><a class="social-sharing-icon odnoklassniki" href="//connect.ok.ru/offer?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-odnoklassniki"></i><span></span></a></li>
										<?php
										break;
									case 'viber':
										?>
										<li><a class="social-sharing-icon viber" href="//viber://forward?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-viber"></i><span></span></a></li>
										<?php
										break;
									case 'whatsapp':
										?>
										<li><a class="social-sharing-icon whatsapp" href="//api.whatsapp.com/send?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-whatsapp"></i><span></span></a></li>
										<?php
										break;
									case 'skype':
										?>
										<li><a class="social-sharing-icon skype" href="//web.skype.com/share?source=button&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-skype"></i><span></span></a></li>
										<?php
										break;
								}
							}
							$i = $i + 3;
						}
					}
					?>
				</ul>
			</div>
		<?php } ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}
add_shortcode( 'litho_single_portfolio_share', 'litho_single_portfolio_share_shortcode' );

// [litho_single_product_share] Shortcode.
if ( ! function_exists( 'litho_single_product_share_shortcode' ) ) {
	function litho_single_product_share_shortcode() {

		global $post;

		if ( ! $post ) {
			return false;
		}

		$output                                   = '';
		$litho_single_product_enable_social_share = get_theme_mod( 'litho_single_product_enable_social_share', '1' );
		$litho_single_product_share_title         = get_theme_mod( 'litho_single_product_share_title', esc_html__( 'Share:', 'litho-addons' ) );
		$litho_single_product_social_sharing      = get_theme_mod( 'litho_single_product_social_sharing', '' );
		$permalink                                = get_permalink( $post->ID );
		$featured_image                           = urlencode( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) );
		$post_title                               = rawurlencode( get_the_title( $post->ID ) );

		ob_start();
		?>
		<?php if ( is_woocommerce_activated() && 1 == $litho_single_product_enable_social_share && ! empty( $litho_single_product_social_sharing ) ) { ?>
			<div class="default social-icons-wrapper">
				<?php if ( ! empty( $litho_single_product_share_title ) ) { ?>
					<span class="share-heading-text"><?php echo esc_html( $litho_single_product_share_title ); ?></span>
				<?php } ?>
				<ul class="default-icon">
					<?php
					$i = 0;

					$count = count( $litho_single_product_social_sharing );
					foreach ( $litho_single_product_social_sharing as $key => $value ) {
						if ( $i < $count ) {
							if ( '1' == $litho_single_product_social_sharing[ $i+1 ] ) {
								switch ( $litho_single_product_social_sharing[ $i ] ) {
									case 'facebook':
										?>
										<li><a class="social-sharing-icon facebook-f" href="//www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
										<?php
										break;
									case 'twitter':
										?>
										<li><a class="social-sharing-icon twitter" href="//twitter.com/share?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-x-twitter"></i><span></span></a></li>
										<?php
										break;
									case 'linkedin':
										?>
										<li><a class="social-sharing-icon linkedin-in" href="//linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;"  rel="nofollow" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
										<?php
										break;
									case 'pinterest':
										?>
										<li><a class="social-sharing-icon pinterest-p" href="//pinterest.com/pin/create/button/?url=<?php echo esc_url( $permalink ); ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo esc_attr ( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" title="<?php echo esc_attr( $post_title ); ?>"><i class="fa-brands fa-pinterest-p"></i><span></span></a></li>
										<?php
										break;
									case 'reddit':
										?>
										<li><a class="social-sharing-icon reddit" href="//reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-reddit"></i><span></span></a></li>
										<?php
										break;
									case 'stumbleupon':
										?>
										<li><a class="social-sharing-icon stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-stumbleupon"></i><span></span></a></li>
										<?php
										break;
									case 'digg':
										?>
										<li><a class="social-sharing-icon digg" href="//www.digg.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo esc_attr( $post_title ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-digg"></i><span></span></a></li>
										<?php
										break;
									case 'vk':
										?>
										<li><a class="social-sharing-icon vk" href="//vk.com/share.php?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-vk"></i><span></span></a></li>
										<?php
										break;
									case 'xing':
										?>
										<li><a class="social-sharing-icon xing" href="//www.xing.com/app/user?op=share&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" data-pin-custom="true"><i class="fa-brands fa-xing"></i><span></span></a></li>
										<?php
										break;
									case 'telegram':
										?>
										<li><a class="social-sharing-icon telegram-plane" href="//t.me/share/url?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-telegram-plane"></i><span></span></a></li>
										<?php
										break;
									case 'ok':
										?>
										<li><a class="social-sharing-icon odnoklassniki" href="//connect.ok.ru/offer?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-odnoklassniki"></i><span></span></a></li>
										<?php
										break;
									case 'viber':
										?>
										<li><a class="social-sharing-icon viber" href="//viber://forward?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-viber"></i><span></span></a></li>
										<?php
										break;
									case 'whatsapp':
										?>
										<li><a class="social-sharing-icon whatsapp" href="//api.whatsapp.com/send?text=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-whatsapp"></i><span></span></a></li>
										<?php
										break;
									case 'skype':
										?>
										<li><a class="social-sharing-icon skype" href="//web.skype.com/share?source=button&url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px'); return false;" data-pin-custom="true"><i class="fa-brands fa-skype"></i><span></span></a></li>
										<?php
										break;
								}
							}
							$i = $i + 3;
						}
					}
					?>
				</ul>
			</div>
		<?php } ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}
add_shortcode( 'litho_single_product_share', 'litho_single_product_share_shortcode' );

// Add additional hover animations effect.
if ( ! function_exists( 'litho_add_additional_hover_animations' ) ) {
	function litho_add_additional_hover_animations() {

		$animations = [
			'forward'                => __( 'Fordward', 'litho-addons' ),
			'backword'               => __( 'Backward', 'litho-addons' ),
			'fade'                   => __( 'Fade', 'litho-addons' ),
			'back-pulse'             => __( 'Back Pulse', 'litho-addons' ),
			'sweep-to-right'         => __( 'Sweep To Right', 'litho-addons' ),
			'sweep-to-left'          => __( 'Sweep To Left', 'litho-addons' ),
			'sweep-to-bottom'        => __( 'Sweep To Bottom', 'litho-addons' ),
			'sweep-to-top'           => __( 'Sweep To Top', 'litho-addons' ),
			'bounce-to-right'        => __( 'Bounce To Right', 'litho-addons' ),
			'bounce-to-left'         => __( 'Bounce To Left', 'litho-addons' ),
			'bounce-to-bottom'       => __( 'Bounce To Bottom', 'litho-addons' ),
			'bounce-to-top'          => __( 'Bounce To Top', 'litho-addons' ),
			'radial-out'             => __( 'Radial Out', 'litho-addons' ),
			'radial-in'              => __( 'Radial In', 'litho-addons' ),
			'rectangle-in'           => __( 'Rectangle In', 'litho-addons' ),
			'rectangle-out'          => __( 'Rectangle Out', 'litho-addons' ),
			'shutter-in-horizontal'  => __( 'Shutter In Horizontal', 'litho-addons' ),
			'shutter-out-horizontal' => __( 'Shutter Out Horizontal', 'litho-addons' ),
			'shutter-in-vertical'    => __( 'Shutter In Vertical', 'litho-addons' ),
			'shutter-out-vertical'   => __( 'Shutter Out Vertical', 'litho-addons' ),
			'hollow'                 => __( 'Hollow', 'litho-addons' ),
			'trim'                   => __( 'Trim', 'litho-addons' ),
			'ripple-out'             => __( 'Ripple Out', 'litho-addons' ),
			'ripple-in'              => __( 'Ripple In', 'litho-addons' ),
			'outline-out'            => __( 'Outline Out', 'litho-addons' ),
			'outline-in'             => __( 'Outline In', 'litho-addons' ),
			'round-corners'          => __( 'Round Corners', 'litho-addons' ),
			'underline-from-left'    => __( 'Underline From Left', 'litho-addons' ),
			'underline-from-center'  => __( 'Underline From Center', 'litho-addons' ),
			'underline-from-right'   => __( 'Underline From Right', 'litho-addons' ),
			'reveal'                 => __( 'Reveal', 'litho-addons' ),
			'underline-reveal'       => __( 'Underline Reveal', 'litho-addons' ),
			'overline-reveal'        => __( 'Overline Reveal', 'litho-addons' ),
			'overline-from-left'     => __( 'Overline From Left', 'litho-addons' ),
			'overline-from-center'   => __( 'Overline From Center', 'litho-addons' ),
			'overline-from-right'    => __( 'Overline From Right', 'litho-addons' ),
			'shadow'                 => __( 'Shadow', 'litho-addons' ),
			'grow-shadow'            => __( 'Grow Shadow', 'litho-addons' ),
			'float-shadow'           => __( 'Float Shadow', 'litho-addons' ),
			'glow'                   => __( 'Glow', 'litho-addons' ),
			'shadow-radial'          => __( 'Shadow Radial', 'litho-addons' ),
			'box-shadow-outset'      => __( 'Box Shadow Outset', 'litho-addons' ),
			'box-shadow-inset'       => __( 'Box Shadow Inset', 'litho-addons' ),
			'bubble-top'             => __( 'Bubble Top', 'litho-addons' ),
			'bubble-right'           => __( 'Bubble Right', 'litho-addons' ),
			'bubble-bottom'          => __( 'Bubble Bottom', 'litho-addons' ),
			'bubble-left'            => __( 'Bubble Left', 'litho-addons' ),
			'bubble-float-top'       => __( 'Bubble Float Top', 'litho-addons' ),
			'bubble-float-right'     => __( 'Bubble Float Right', 'litho-addons' ),
			'bubble-float-bottom'    => __( 'Bubble Float Bottom', 'litho-addons' ),
			'bubble-float-left'      => __( 'Bubble Float Left', 'litho-addons' ),
			'curl-top-left'          => __( 'Curl Top Left', 'litho-addons' ),
			'curl-top-right'         => __( 'Curl Top Right', 'litho-addons' ),
			'curl-bottom-right'      => __( 'Curl Bottom Right', 'litho-addons' ),
			'curl-bottom-left'       => __( 'Curl Bottom Left', 'litho-addons' ),
			'float-3px'              => __( 'Litho Float Three Up', 'litho-addons' ),
			'float-5px'              => __( 'Litho Float Five Up', 'litho-addons' ),
			'float-10px'             => __( 'Litho Float Ten Up', 'litho-addons' ),
			'scale-effect'           => __( 'Litho Scale', 'litho-addons' ),
			'scale-3d-effect'        => __( 'Litho Scale (3d)', 'litho-addons' ),
			'scale-9-effect'         => __( 'Litho Scale (9)', 'litho-addons' ),
			'zoom-effect'            => __( 'Litho Zoom', 'litho-addons' ),
			'btn-slide-up-bg'        => __( 'Litho Button Slide Up', 'litho-addons' ),
			'btn-slide-down-bg'      => __( 'Litho Button Slide Down', 'litho-addons' ),
			'btn-slide-left-bg'      => __( 'Litho Button Slide Left', 'litho-addons' ),
			'btn-slide-right-bg'     => __( 'Litho Button Slide Right', 'litho-addons' ),
			'btn-expand-ltr'         => __( 'Litho Button Expand Width', 'litho-addons' ),
			'icon-sweep-bottom'      => __( 'Litho Icon Sweep To Bottom', 'litho-addons' ),
		];
		return $animations;
	}
}
add_filter( 'elementor/controls/hover_animations/additional_animations', 'litho_add_additional_hover_animations' );

// Deregister js.
if ( ! function_exists( 'litho_before_register_style_js_callback' ) ) {
	function litho_before_register_style_js_callback() {
		if ( litho_load_javascript_by_key( 'swiper' ) ) {
			wp_deregister_script( 'swiper' );
			wp_deregister_style( 'e-swiper' );			
		}
	}
}
add_action( 'litho_before_register_style_js', 'litho_before_register_style_js_callback' );

// Custom Js in Output in Frontend.
if ( ! function_exists( 'litho_addons_additional_js_output' ) ) {
	function litho_addons_additional_js_output() {

		$js = get_option( 'litho_custom_js', '' );

		if ( '' === $js ) {
			return;
		}
		wp_add_inline_script( 'litho-main', $js );
	}
}

add_action( 'wp_enqueue_scripts', 'litho_addons_additional_js_output', 999 );

// Customizer settings export import init.
if ( ! function_exists( 'litho_customizer_settings' ) ) {
	function litho_customizer_settings( $wp_customize ) {
		if ( current_user_can( 'edit_theme_options' ) ) {

			if ( isset( $_REQUEST['litho-export'] ) ) {
				litho_customizer_export( $wp_customize );
			}
			if ( isset( $_REQUEST['litho-import'] ) && isset( $_FILES['litho-import-file'] ) ) {
				litho_customizer_import( $wp_customize );
			}
		}
	}
}
add_action( 'customize_register', 'litho_customizer_settings', 100 );

// Customizer settings export.
if ( ! function_exists( 'litho_customizer_export' ) ) {
	function litho_customizer_export( $wp_customize ) {
		if ( ! wp_verify_nonce( $_REQUEST['litho-export'], 'litho-exporting' ) ) {
			return;
		}

		$core_options = array(
			'page_for_posts',
			'blogname',
			'show_on_front',
			'blogdescription',
			'page_on_front',
		);

		$theme_name     = get_stylesheet();
		$template       = get_template();
		$charset        = get_option( 'blog_charset' );
		$theme_settings = get_theme_mods();
		$settings_data  = array(
			'template' => $template,
			'mods'     => $theme_settings ? $theme_settings : array(),
			'options'  => array(),
		);

		// Get options from the Customizer API.
		$settings = $wp_customize->settings();

		foreach ( $settings as $key => $setting ) {

			if ( 'option' == $setting->type ) {

				// Don't save widget data.
				if ( 'widget_' === substr( strtolower( $key ), 0, 7 ) ) {
					continue;
				}

				// Don't save sidebar data.
				if ( 'sidebars_' === substr( strtolower( $key ), 0, 9 ) ) {
					continue;
				}

				// Don't save core options.
				if ( in_array( $key, $core_options ) ) {
					continue;
				}

				$settings_data['options'][ $key ] = $setting->value();
			}
		}

		if ( function_exists( 'wp_get_custom_css_post' ) ) {
			$settings_data['wp_css'] = wp_get_custom_css();
		}

		// Set the download headers.
		header( 'Content-disposition: attachment; filename=' . $theme_name . '-export.json' );
		header( 'Content-Type: application/octet-stream; charset=' . $charset );

		// Serialize the export data.
		echo serialize( $settings_data );

		// Start the download.
		die();
	}
}

// Customizer settings import.
if ( ! function_exists( 'litho_customizer_import' ) ) {
	function litho_customizer_import( $wp_customize ) {
		// Make sure import form.
		if ( ! wp_verify_nonce( $_REQUEST['litho-import'], 'litho-importing' ) ) {
			return;
		}

		// Make sure WordPress upload support is loaded.
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Setup global vars.
		global $wp_customize;

		// Setup internal vars.
		$template  = get_template();
		$overrides = array( 'test_form' => false, 'test_type' => false, 'mimes' => array( 'json' => 'text/plain' ) );
		$file      = wp_handle_upload( $_FILES['litho-import-file'], $overrides );

		// Make sure we have an uploaded file.
		if ( isset( $file['error'] ) && ! file_exists( $file['file'] ) ) {
			return;
		}

		// Get the upload data.
		$file_content = file_get_contents( $file['file'] );
		$file_data    = @unserialize( $file_content );

		// Remove the uploaded file.
		unlink( $file['file'] );

		// Data checks.
		if ( 'array' != gettype( $file_data ) ) {
			$error_message = __( 'Error importing settings! Please check that you uploaded a customizer export file.', 'litho-addons' );
			echo "<script type='text/javascript'>alert('$error_message');</script>";
			return;
		}
		if ( ! isset( $file_data['template'] ) || ! isset( $file_data['mods'] ) ) {
			$error_message = __( 'Error importing settings! Please check that you uploaded a customizer export file.', 'litho-addons' );
			echo "<script type='text/javascript'>alert('$error_message');</script>";
			return;
		}
		if ( $file_data['template'] != $template ) {
			$error_message = __( 'Error importing settings! The settings you uploaded are not for the current theme.', 'litho-addons' );
			echo "<script type='text/javascript'>alert('$error_message');</script>";
			return;
		}

		// If wp_css is set then import it.
		if ( function_exists( 'wp_update_custom_css_post' ) && isset( $file_data['wp_css'] ) && '' !== $file_data['wp_css'] ) {
			wp_update_custom_css_post( $file_data['wp_css'] );
		}

		// Call the customize_save action.
		do_action( 'customize_save', $wp_customize );

		// Loop through the mods.
		foreach ( $file_data['mods'] as $key => $val ) {

			// Call the customize_save_ dynamic action.
			do_action( 'customize_save_' . $key, $wp_customize );

			// Save the mod.
			set_theme_mod( $key, $val );
		}

		// Call the customize_save_after action.
		do_action( 'customize_save_after', $wp_customize );
	}
}

// Remove revslider conflict in widget.php.
if ( ! function_exists( 'litho_revslider_gutenberg_cgb_editor_assets' ) ) {
	function litho_revslider_gutenberg_cgb_editor_assets() {
		global $pagenow;
		if ( 'widgets.php' == $pagenow ) {
			wp_dequeue_script( 'revslider_gutenberg-cgb-block-js' );
		}
	}
}
add_action( 'enqueue_block_editor_assets', 'litho_revslider_gutenberg_cgb_editor_assets' );

// Load stylesheet.
if ( ! function_exists( 'litho_load_stylesheet_by_key' ) ) {
	function litho_load_stylesheet_by_key( $value ) {

		$flag = true;

		$style_details = litho_option( 'litho_disable_style_details', '' );

		if ( ! empty( $style_details ) ) {
			$style_details = explode( ',', $style_details );
			if ( in_array( $value, $style_details ) ) {
				$flag = false;
			}
		}
		return apply_filters( 'litho_load_stylesheet_by_key', $flag, $value );
	}
}

// Load javascript.
if ( ! function_exists( 'litho_load_javascript_by_key' ) ) {
	function litho_load_javascript_by_key( $value ) {
		$flag = true;

		$script_details = litho_option( 'litho_disable_script_details', '' );
		if ( ! empty( $script_details ) ) {
			$script_details = explode( ',', $script_details );
			if ( in_array( $value, $script_details ) ) {
				$flag = false;
			}
		}
		return apply_filters( 'litho_load_javascript_by_key', $flag, $value );
	}
}

// Get within content area settings.
if ( ! function_exists( 'litho_get_within_content_area' ) ) {
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

// Issue fixed: SG speed optimizer and Litho theme both uses the same "data-icon" attribute to display the icon.
if ( ! function_exists( 'litho_admin_dequeue_scripts' ) ) {
	function litho_admin_dequeue_scripts() {

		$page = isset( $_GET['page'] ) && ! empty( $_GET['page'] ) ? $_GET['page'] : '';

		if ( is_admin() && ( 'sg-security' === $page || 'site-security' === $page || 'login-settings' === $page || 'activity-log' === $page || 'post-hack-actions' === $page || 'sgo_frontend' === $page || 'sg-cachepress' === $page || 'sgo_caching' === $page || 'sgo_environment' === $page || 'sgo_media' === $page || 'sgo_analysis' === $page ) ) {
			wp_deregister_style( 'font-awesome' );
			wp_deregister_style( 'et-line-icons' );
			wp_deregister_style( 'themify-icons' );

			wp_dequeue_style( 'font-awesome' );
			wp_dequeue_style( 'et-line-icons' );
			wp_dequeue_style( 'themify-icons' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'litho_admin_dequeue_scripts', 999 );

// Disable Crawling and indexing for mega menu items
add_filter( 'wp_robots', function( $robots ) {
	if ( is_singular( 'litho-mega-menu' ) || is_singular( 'sectionbuilder' ) ) {
		$robots = array();
		$robots['noindex'] = true;
		$robots['nofollow'] = true;
	}
	return $robots;
} );

add_filter( 'wpml_pb_elementor_register_string_name_litho-team-memeber-carousel', function( $name, $args ) {
	$widgetType = $args['element']['widgetType'];
	return $widgetType . '-' . $args['key'] . '-' . $args['field'] . '-' . $args['nodeId'] . '-' . $args['item']['_id'];
}, 10, 2 );

add_filter( 'wpml_pb_elementor_register_string_name_litho-slider', function( $name, $args ) {
	$widgetType = $args['element']['widgetType'];
	return $widgetType . '-' . $args['key'] . '-' . $args['field'] . '-' . $args['nodeId'] . '-' . $args['item']['_id'];
}, 10, 2 );

