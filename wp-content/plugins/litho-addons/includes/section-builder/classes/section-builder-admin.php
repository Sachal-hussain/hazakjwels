<?php
namespace LithoAddons\Section_builder\Classes;

/**
 * Section builder Elementor Canvas
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Section_Builder_Admin` doesn't exists yet.
if ( ! class_exists( 'Section_Builder_Admin' ) ) {

	/**
	 * Define Section_Builder_Admin classe
	 */
	class Section_Builder_Admin {

		public $post_type = 'sectionbuilder';

		public function __construct() {

			add_action( 'init', array( $this, 'litho_sectionbuilder_post_type_init' ) );
			add_action( 'template_redirect', array( $this, 'litho_sectionbuilder_block_template_frontend' ) );
			add_filter( 'single_template', array( $this, 'litho_sectionbuilder_load_canvas_template' ) );
			add_filter( 'manage_sectionbuilder_posts_columns', array( $this, 'litho_sectionbuilder_set_columns_fields' ) );
			add_action( 'manage_sectionbuilder_posts_custom_column', array( $this, 'litho_sectionbuilder_render_column_fields' ), 10, 2 );
			add_filter( 'manage_edit-sectionbuilder_sortable_columns', array( $this, 'litho_sectionbuilder_sortable_columns' ) );
			add_filter( 'views_edit-sectionbuilder', array( $this, 'litho_sectionbuilder_admin_print_tabs' ) );
			add_filter( 'pre_get_posts', array( $this, 'litho_sectionbuilder_make_sortable' ) );
		}

		public function litho_sectionbuilder_admin_print_tabs( $views ) {

			if ( is_admin() && isset( $_GET['post_type'] ) && $this->post_type === $_GET['post_type'] ) { // phpcs:ignore.

				$template_type = array(
					'all'               => __( 'Saved Templates', 'litho-addons' ),
					'mini-header'       => __( 'Mini Header', 'litho-addons' ),
					'header'            => __( 'Header', 'litho-addons' ),
					'footer'            => __( 'Footer', 'litho-addons' ),
					'archive'           => __( 'Archive', 'litho-addons' ),
					'archive-portfolio' => __( 'Archive Portfolio', 'litho-addons' ),
					'custom-title'      => __( 'Page Title', 'litho-addons' ),
					'promo_popup'       => __( 'Promo popup', 'litho-addons' ),
					'side_icon'         => __( 'Side Icon', 'litho-addons' ),
				);
				?>
				<div class="litho-nav-tabs nav-tab-wrapper">
					<?php
					$counter = 1;
					foreach ( $template_type as $key => $type ) {
						$current_tab = ( 1 === $counter ) ? ' nav-tab-active' : '';
						if ( isset( $_GET['template_type'] ) && ! empty( $_GET['template_type'] ) ) { // phpcs:ignore.
							$current_tab = ( $_GET['template_type'] === $key ) ? ' nav-tab-active' : '';// phpcs:ignore.
						}
						echo sprintf(
							'<a href="%s" class="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $this->post_type, 'template_type' => $key ), 'edit.php' ) ),
							'nav-tab' . esc_attr( $current_tab ),
							esc_html( $type )
						);
						$counter++;
					}
					?>
				</div>
				<?php
				return $views;
			}
		}

		public function litho_sectionbuilder_post_type_init() {

			$labels = array(
				'name'               => __( 'Section Builder', 'litho-addons' ),
				'singular_name'      => __( 'Section Builder', 'litho-addons' ),
				'menu_name'          => __( 'Section Builder', 'litho-addons' ),
				'name_admin_bar'     => __( 'Section Builder', 'litho-addons' ),
				'add_new'            => __( 'Add New', 'litho-addons' ),
				'add_new_item'       => __( 'Add New Template', 'litho-addons' ),
				'new_item'           => __( 'New Template', 'litho-addons' ),
				'edit_item'          => __( 'Edit Template', 'litho-addons' ),
				'view_item'          => __( 'View Template', 'litho-addons' ),
				'all_items'          => __( 'All Templates', 'litho-addons' ),
				'search_items'       => __( 'Search Template', 'litho-addons' ),
				'parent_item_colon'  => __( 'Parent Template:', 'litho-addons' ),
				'not_found'          => __( 'No Template Found.', 'litho-addons' ),
				'not_found_in_trash' => __( 'No Template Found in Trash.', 'litho-addons' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => false,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'menu_position'       => 70,
				'menu_icon'           => 'dashicons-editor-kitchensink',
				'exclude_from_search' => true,
				'rewrite'             => false,
				'supports'            => array( 'title', 'elementor', 'author' ),
			);

			register_post_type( 'sectionbuilder', $args );
		}

		public function litho_sectionbuilder_block_template_frontend() {

			if ( is_singular( $this->post_type ) && ! current_user_can( 'edit_posts' ) ) {
				wp_redirect( site_url(), 301 );
				die;
			}
		}

		public function litho_sectionbuilder_load_canvas_template( $single_template ) {

			global $post;

			if ( $this->post_type === $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {

					return $elementor_2_0_canvas;

				} else {

					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

		public function litho_sectionbuilder_set_columns_fields( $columns ) {

			$date_column = $columns['date'];

			unset( $columns['date'] );

			$columns['template_type'] = esc_html__( 'Section type', 'litho-addons' );
			if ( isset( $_GET['template_type'] ) && ( 'archive' === $_GET['template_type'] || 'archive-portfolio' === $_GET['template_type'] ) ) { // phpcs:ignore.
				$columns['archive_type'] = esc_html__( 'Archive type', 'litho-addons' );
			}

			if ( isset( $_GET['template_type'] ) && ( 'mini-header' === $_GET['template_type'] || 'header' === $_GET['template_type'] ) ) { // phpcs:ignore.
				$columns['sticky_type'] = esc_html__( 'Sticky type', 'litho-addons' );
			}
			$columns['date'] = $date_column;

			return $columns;
		}

		public function litho_sectionbuilder_render_column_fields( $column, $post_id ) {

			switch ( $column ) {
				case 'template_type':
					$template_type  = get_post_meta( $post_id, '_litho_section_builder_template', true );
					$template_label = ( $template_type ) ? litho_get_template_type_by_key( $template_type ) : '-';

					if ( ! empty( $template_type ) ) {
						$out[] = sprintf(
							'<a href="%s">%s</a>',
							esc_url(
								add_query_arg(
									array(
										'post_type'     => $this->post_type,
										'template_type' => $template_type,
									),
									'edit.php'
								)
							),
							$template_label
						);
						echo join( ', ', $out ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					} else {
						printf( '%s', esc_html__( 'N/A', 'litho-addons' ) );
					}
					break;
				case 'sticky_type':
					$template_type = get_post_meta( $post_id, '_litho_section_builder_template', true );

					if ( 'mini-header' === $template_type ) {

						$header_sticky = get_post_meta( $post_id, '_litho_mini_header_sticky_type', true );

					} else {

						$header_sticky = get_post_meta( $post_id, '_litho_header_sticky_type', true );
					}

					if ( $header_sticky && ( 'mini-header' === $template_type || 'header' === $template_type ) ) {

						$sticky_label = litho_get_header_sticky_type_by_key( $header_sticky );

					} else {

						$sticky_label = esc_html__( 'N/A', 'litho-addons' );
					}

					echo sprintf( '%s', $sticky_label ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;
				case 'archive_type':
					$template_type                   = get_post_meta( $post_id, '_litho_section_builder_template', true );
					$template_archive_type           = get_post_meta( $post_id, '_litho_template_archive_style', true );
					$template_archive_portfolio_type = get_post_meta( $post_id, '_litho_template_archive_portfolio_style', true );

					if ( $template_archive_type && 'archive' === $template_type ) {
						$archive_label_arr = array();

						foreach ( litho_get_archive_style_by_key() as $key => $option ) {
							if ( is_array( $template_archive_type ) && in_array( $key, $template_archive_type ) ) {
								$archive_label_arr[] = $option;
							}
						}
						$archive_label = implode( ', ', $archive_label_arr );
					} elseif ( $template_archive_portfolio_type && 'archive-portfolio' === $template_type ) {
						$archive_label_arr = array();

						foreach ( litho_get_archive_style_by_key() as $key => $option ) {
							if ( is_array( $template_archive_portfolio_type ) && in_array( $key, $template_archive_portfolio_type ) ) {
								$archive_label_arr[] = $option;
							}
						}
						$archive_label = implode( ', ', $archive_label_arr );

					} else {
						$archive_label = esc_html__( 'N/A', 'litho-addons' );
					}

					echo sprintf( '%s', $archive_label ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;
			}
		}

		public function litho_sectionbuilder_make_sortable( $query ) {

			global $pagenow;

			if ( ! is_admin() && ( 'edit.php' !== $pagenow ) ) {
				return;
			}

			if ( ! empty( $_GET['template_type'] ) && 'all' !== $_GET['template_type'] ) { // phpcs:ignore

				$query->query_vars['meta_key']   = '_litho_section_builder_template';// phpcs:ignore
				$query->query_vars['meta_value'] = $_GET['template_type']; // phpcs:ignore

			} else {

				$orderby = $query->get( 'orderby' );

				if ( 'sectionbuilder_template_type' === $orderby ) {
					$query->set( 'meta_key', '_litho_section_builder_template' );
					$query->set( 'orderby', 'meta_value' );
				}
			}
		}

		public function litho_sectionbuilder_sortable_columns( $cols ) {

			$cols['template_type'] = 'sectionbuilder_template_type';
			return $cols;
		}

	} // End of Class.

} // End of Class Exists.
