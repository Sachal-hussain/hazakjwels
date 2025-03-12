<?php
use LithoAddons\Section_builder\Section_Builder_Init as Section_Builder;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'sectionbuilder_render_html_mini_header' ) ) {
	/**
	 * Render mini header template in theme header section.
	 */
	function sectionbuilder_render_html_mini_header() {

		$litho_enable_mini_header_general = litho_builder_customize_option( 'litho_enable_mini_header_general', '1' );
		$litho_enable_mini_header         = litho_builder_option( 'litho_enable_mini_header', '0', $litho_enable_mini_header_general );
		$litho_default_template_id        = litho_builder_option( 'litho_mini_header_section', '', $litho_enable_mini_header_general );

		if ( 1 == $litho_enable_mini_header && ! empty( $litho_default_template_id ) ) {

			Section_Builder::get_content_frontend( $litho_default_template_id );

		} else {
			if ( is_admin() ) {

				echo sprintf(
					'<a target="_blank" href="%s">%s </a> %s',
					esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=mini-header' ),
					esc_html__( 'Click here', 'litho-addons' ),
					esc_html__( 'to create / manage mini header in the section builder.', 'litho-addons' )
				);
			} else {
				return;
			}
		}
	}
}

if ( ! function_exists( 'sectionbuilder_render_html_header' ) ) {
	/**
	 * Render header template in theme header section
	 */
	function sectionbuilder_render_html_header() {

		$litho_enable_header_general = litho_builder_customize_option( 'litho_enable_header_general', '1' );
		$litho_enable_header         = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
		$litho_default_template_id   = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );

		if ( ! empty( $litho_default_template_id ) ) {

			if ( 1 == $litho_enable_header ) {

				Section_Builder::get_content_frontend( $litho_default_template_id );

			} else {

				if ( is_admin() ) {
					echo sprintf(
						'<a target="_blank" href="%s">%s </a> %s',
						esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=header' ),
						esc_html__( 'Click here', 'litho-addons' ),
						esc_html__( 'to create / manage header in the section builder.', 'litho-addons' )
					);
				} else {
					return;
				}
			}
		}
	}
}

/*===============================================================*/

if ( ! function_exists( 'sectionbuilder_render_html_footer' ) ) {
	/**
	 * Render footer template in theme footer section
	 */
	function sectionbuilder_render_html_footer() {

		$litho_enable_footer_general = litho_builder_customize_option( 'litho_enable_footer_general', '1' );
		$litho_enable_footer         = litho_builder_option( 'litho_enable_footer', '1', $litho_enable_footer_general );
		$litho_default_template_id   = litho_builder_option( 'litho_footer_section', '', $litho_enable_footer_general );

		if ( ! empty( $litho_default_template_id ) ) {

			if ( 1 == $litho_enable_footer ) {

				Section_Builder::get_content_frontend( $litho_default_template_id );

			} else {

				if ( is_admin() ) {
					echo sprintf(
						'<a target="_blank" href="%s">%s </a> %s',
						esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=footer' ),
						esc_html__( 'Click here', 'litho-addons' ),
						esc_html__( 'to create / manage footer in the section builder.', 'litho-addons' )
					);
				} else {
					return;
				}
			}
		}
	}
}

/*===============================================================*/

if ( ! function_exists( 'sectionbuilder_render_html_custom_title' ) ) {
	/**
	 * Render title template in theme page title content area
	 */
	function sectionbuilder_render_html_custom_title() {

		$litho_enable_custom_title_general = litho_builder_customize_option( 'litho_enable_custom_title_general', '1' );
		$litho_enable_custom_title         = litho_builder_option( 'litho_enable_custom_title', '1', $litho_enable_custom_title_general );
		$litho_default_template_id         = litho_builder_option( 'litho_custom_title_section', '', $litho_enable_custom_title_general );

		if ( ! empty( $litho_default_template_id ) ) {

			if ( 1 == $litho_enable_custom_title ) {

				Section_Builder::get_content_frontend( $litho_default_template_id );

			} else {

				if ( is_admin() ) {
					echo sprintf(
						'<a target="_blank" href="%s">%s </a> %s',
						esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=custom-title' ),
						esc_html__( 'Click here', 'litho-addons' ),
						esc_html__( 'to create / manage page title in the section builder.', 'litho-addons' )
					);
				} else {
					return;
				}
			}
		}
	}
}

/*===============================================================*/

if ( ! function_exists( 'sectionbuilder_render_html_promo_popup' ) ) {
	/**
	 * Render promo popup template
	 */
	function sectionbuilder_render_html_promo_popup() {

		$litho_enable_promo_popup  = get_theme_mod( 'litho_enable_promo_popup', '0' );
		$litho_default_template_id = get_theme_mod( 'litho_promo_popup_section', '' );

		if ( ! empty( $litho_default_template_id ) ) {

			if ( 1 == $litho_enable_promo_popup ) {

				Section_Builder::get_content_frontend( $litho_default_template_id );

			} else {

				if ( is_admin() ) {
					echo sprintf(
						'<a target="_blank" href="%s">%s </a> %s',
						esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=promo_popup' ),
						esc_html__( 'Click here', 'litho-addons' ),
						esc_html__( 'to create / manage promo popup in the section builder.', 'litho-addons' )
					);
				} else {
					return;
				}
			}
		}
	}
}

/*===============================================================*/

if ( ! function_exists( 'sectionbuilder_render_html_side_icon' ) ) {
	/**
	 * Render Side Icon template
	 */
	function sectionbuilder_render_html_side_icon() {

		$litho_enable_side_icon    = get_theme_mod( 'litho_enable_side_icon', '0' );
		$litho_default_template_id = get_theme_mod( 'litho_side_icon_section', '' );

		if ( ! empty( $litho_default_template_id ) ) {

			if ( 1 == $litho_enable_side_icon ) {

				Section_Builder::get_content_frontend( $litho_default_template_id );

			} else {

				if ( is_admin() ) {
					echo sprintf(
						'<a target="_blank" href="%s">%s </a> %s',
						esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=side_icon' ),
						esc_html__( 'Click here', 'litho-addons' ),
						esc_html__( 'to create / manage side icon in the section builder.', 'litho-addons' )
					);
				} else {
					return;
				}
			}
		}
	}
}

/*===============================================================*/

if ( ! function_exists( 'sectionbuilder_render_html_archive' ) ) {
	/**
	 * Render archive template in theme archive page content area
	 */
	function sectionbuilder_render_html_archive() {

		$category_template_id = litho_get_archive_template( 'category-archives' );
		$tag_template_id      = litho_get_archive_template( 'tag-archives' );
		$author_template_id   = litho_get_archive_template( 'author-archives' );
		$search_template_id   = litho_get_archive_template( 'search-archives' );
		$archive_template_id  = litho_get_archive_template( 'general' );

		if ( is_category() && $category_template_id ) {

			litho_edit_section_link( $category_template_id );

			Section_Builder::get_content_frontend( $category_template_id );

		} elseif ( is_tag() && $tag_template_id ) {

			litho_edit_section_link( $tag_template_id );

			Section_Builder::get_content_frontend( $tag_template_id );

		} elseif ( is_author() && $author_template_id ) {

			litho_edit_section_link( $author_template_id );

			Section_Builder::get_content_frontend( $author_template_id );

		} elseif ( is_search() && $search_template_id ) {

			litho_edit_section_link( $search_template_id );

			Section_Builder::get_content_frontend( $search_template_id );

		} else {

			if ( $archive_template_id ) {

				litho_edit_section_link( $archive_template_id );

				Section_Builder::get_content_frontend( $archive_template_id );

			} else {

				if ( is_search() || is_category() || is_tag() || is_archive() ) {
					if ( file_exists( LITHO_ADDONS_ROOT . '/templates/archive/layout-default.php' ) ) {
						include LITHO_ADDONS_ROOT . '/templates/archive/layout-default.php';
					}
				} elseif ( is_home() ) {
					if ( file_exists( LITHO_ADDONS_ROOT . '/templates/index/layout-default.php' ) ) {
						include LITHO_ADDONS_ROOT . '/templates/index/layout-default.php';
					}
				} else {
					if ( is_admin() ) {
						echo sprintf(
							'<a target="_blank" href="%s">%s </a> %s',
							esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=archive' ),
							esc_html__( 'Click here', 'litho-addons' ),
							esc_html__( 'to create / manage archive in the section builder.', 'litho-addons' )
						);
					} else {
						if ( file_exists( LITHO_ADDONS_ROOT . '/templates/content-none.php' ) ) {
							include LITHO_ADDONS_ROOT . '/templates/content-none.php';
						}
					}
				}
			}
		}
	}
}

if ( ! function_exists( 'litho_get_archive_template' ) ) {
	/**
	 * Return archive template ID
	 *
	 * @param string $archive_key Archive key ( like categories, tags, author etc.. ).
	 */
	function litho_get_archive_template( $archive_key ) {

		$templates_query = new \WP_Query(
			[
				'post_type'      => 'sectionbuilder',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'meta_query'     => [
					'relation' => 'AND',
					[
						'key'   => '_litho_section_builder_template',
						'value' => 'archive',
					],
					[
						'key'     => '_litho_template_archive_style',
						'value'   => $archive_key,
						'compare' => 'LIKE',
					],
				],
			]
		);

		if ( $templates_query->have_posts() ) {
			foreach ( $templates_query->get_posts() as $post ) {
				return $post->ID;
			}
			wp_reset_postdata();
		}
	}
}

/*===============================================================*/


if ( ! function_exists( 'sectionbuilder_render_html_archive_portfolio' ) ) {
	/**
	 * Render portfolio archive template in theme archive page content area
	 */
	function sectionbuilder_render_html_archive_portfolio() {

		$portfolio_category_template_id = litho_get_archive_portfolio_template( 'portfolio-cat-archives' );
		$portfolio_tags_template_id     = litho_get_archive_portfolio_template( 'portfolio-tags-archives' );
		$portfolio_archives_template_id = litho_get_archive_portfolio_template( 'portfolio-archives' );
		$archive_template_id            = litho_get_archive_portfolio_template( 'general' );

		if ( is_tax( 'portfolio-category' ) && $portfolio_category_template_id ) {

			litho_edit_section_link( $portfolio_category_template_id );

			Section_Builder::get_content_frontend( $portfolio_category_template_id );

		} elseif ( is_tax( 'portfolio-tags' ) && $portfolio_tags_template_id ) {

			litho_edit_section_link( $portfolio_tags_template_id );

			Section_Builder::get_content_frontend( $portfolio_tags_template_id );

		} elseif ( is_post_type_archive( 'portfolio' ) && $portfolio_archives_template_id ) {

			litho_edit_section_link( $portfolio_archives_template_id );

			Section_Builder::get_content_frontend( $portfolio_archives_template_id );

		} else {

			if ( $archive_template_id ) {

				litho_edit_section_link( $archive_template_id );

				Section_Builder::get_content_frontend( $archive_template_id );

			} else {

				if ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) {
					if ( file_exists( LITHO_ADDONS_ROOT . '/templates/portfolio-archive/layout-default.php' ) ) {
						include LITHO_ADDONS_ROOT . '/templates/portfolio-archive/layout-default.php';
					}
				} else {
					if ( is_admin() ) {
						echo sprintf(
							'<a target="_blank" href="%s">%s </a> %s',
							esc_url( get_admin_url() . 'edit.php?post_type=sectionbuilder&template_type=archive-portfolio' ),
							esc_html__( 'Click here', 'litho-addons' ),
							esc_html__( 'to create / manage archive in the section builder.', 'litho-addons' )
						);
					} else {
						if ( file_exists( LITHO_ADDONS_ROOT . '/templates/content-none.php' ) ) {
							include LITHO_ADDONS_ROOT . '/templates/content-none.php';
						}
					}
				}
			}
		}
	}
}


if ( ! function_exists( 'litho_get_archive_portfolio_template' ) ) {
	/**
	 * Return portfolio archive template ID
	 *
	 * @param string $archive_portfolio_key Archive key ( like categories, tags, author etc.. ).
	 */
	function litho_get_archive_portfolio_template( $archive_portfolio_key ) {

		$templates_query = new \WP_Query(
			[
				'post_type'      => 'sectionbuilder',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'meta_query'     => [
					'relation' => 'AND',
					[
						'key'   => '_litho_section_builder_template',
						'value' => 'archive-portfolio',
					],
					[
						'key'     => '_litho_template_archive_portfolio_style',
						'value'   => $archive_portfolio_key,
						'compare' => 'LIKE',
					],
				],
			]
		);

		if ( $templates_query->have_posts() ) {
			foreach ( $templates_query->get_posts() as $post ) {
				return $post->ID;
			}
			wp_reset_postdata();
		}
	}
}

if ( ! function_exists( 'litho_edit_section_link' ) ) {
	/**
	 * Edit archive section link
	 */
	function litho_edit_section_link( $template_id ) {

		if ( current_user_can( 'edit_posts' ) && ! is_customize_preview() && $template_id ) {
			$edit_link = add_query_arg(
				array(
					'post'   => $template_id,
					'action' => 'elementor',
				),
				admin_url( 'post.php' )
			);
			?>
			<a href="<?php echo esc_url( $edit_link ); ?>" target="_blank" data-bs-placement="right" title="<?php echo esc_attr__( 'Edit archive section', 'litho-addons' ); ?>" class="edit-litho-section edit-archive litho-tooltip">
				<i class="ti-pencil"></i>
			</a>
			<?php
		}
	}
}
