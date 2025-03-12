<?php
namespace LithoAddons\Section_builder;

/**
 * Section builder initialize
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Section_Builder_Init` doesn't exists yet.
if ( ! class_exists( 'Section_Builder_Init' ) ) {

	class Section_Builder_Init {

		private static $elementor_instance;

		public function __construct() {

			if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
				self::$elementor_instance = \Elementor\Plugin::instance();
				$this->includes_files();
			}

			add_action( 'elementor/page_templates/canvas/before_content', array( $this, 'before_content' ) );
			add_action( 'elementor/page_templates/canvas/after_content', array( $this, 'after_content' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'litho_load_style_and_script' ) );
		}

		// Section Builder - Enqueue scripts and styles.
		public function litho_load_style_and_script() {

			if ( is_sectionbuilder_screen() ) {

				wp_register_style(
					'sectionbuilder-new-template',
					LITHO_ADDONS_BUILDER_DIR . '/assets/admin/sectionbuilder.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION,
					false
				);
				wp_enqueue_style( 'sectionbuilder-new-template' );

				wp_register_script(
					'sectionbuilder-new-template',
					LITHO_ADDONS_BUILDER_DIR . '/assets/admin/sectionbuilder.js',
					[ 'jquery', 'select2' ],
					LITHO_ADDONS_PLUGIN_VERSION,
					true
				);
				wp_enqueue_script( 'sectionbuilder-new-template' );

				wp_localize_script(
					'sectionbuilder-new-template',
					'LithoBuilder',
					array(
						'ajaxurl' => admin_url( 'admin-ajax.php' ),
						'i18n'    => array(
							'placeholder'          => esc_html__( 'Please select at least one item', 'litho-addons' ),
							'responseErrorMessage' => esc_html__( 'Something went wrong', 'litho-addons' ),
						),
					)
				);
			}
		}

		public function before_content() {

			global $post;

			$litho_header_layout_class = '';
			$litho_header_sticky_type  = '';
			$litho_default_template    = get_post_meta( $post->ID, '_litho_section_builder_template', true );

			if ( ! empty( $post ) && is_object( $post ) && isset( $post->ID ) ) {

				$litho_header_template_id_by_meta = get_post_meta( $post->ID, '_litho_template_header_style', true );
				$litho_header_template_id_by_meta = ( ! empty( $litho_header_template_id_by_meta ) ) ? $litho_header_template_id_by_meta : 'standard';
				$litho_header_layout_class        = ' ' . $litho_header_template_id_by_meta;
			}

			switch ( $litho_default_template ) {
				case 'mini-header':
					$litho_header_sticky_type = get_post_meta( $post->ID, '_litho_mini_header_sticky_type', true );
					?>
						<div class="mini-header-main-wrapper <?php echo esc_attr( $litho_header_sticky_type ); ?>">
					<?php
					break;
				case 'header':
					$litho_header_sticky_type = get_post_meta( $post->ID, '_litho_header_sticky_type', true );
					?>
						<header id="masthead" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
							<nav class="header-common-wrapper navbar navbar-expand-lg fixed-top <?php echo esc_attr( $litho_header_sticky_type ) . esc_attr( $litho_header_layout_class ); ?>">
					<?php
					break;
				case 'footer':
					?>
					<footer class="footer-main-wrapper site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
					<?php
					break;
				case 'custom-title':
					$litho_custom_title_class         = array( 'litho-main-title-wrappper' );
					$litho_custom_title_wrapper_class = apply_filters( 'litho_main_title_wrapper_class', $litho_custom_title_class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$class                            = ( is_array( $litho_custom_title_wrapper_class ) ) ? implode( ' ', $litho_custom_title_wrapper_class ) : '';
					?>
					<section class="<?php echo esc_attr( $class ); ?>">
					<?php
					break;
			}
		}

		public function after_content() {

			global $post;
			$litho_default_template = get_post_meta( $post->ID, '_litho_section_builder_template', true );

			switch ( $litho_default_template ) {

				case 'mini-header':
					?>
						</div>
					<?php
					break;
				case 'header':
					?>

							</nav>
						</header>
					<?php
					break;
				case 'footer':
					?>
					</footer>
					<?php
					break;
				case 'custom-title':
					?>
					</section>
					<?php
					break;
			}
		}

		public function includes_files() {

			if ( file_exists( LITHO_ADDONS_BUILDER_PATH . '/conditions/section-builder-functions.php' ) ) {
				require_once LITHO_ADDONS_BUILDER_PATH . '/conditions/section-builder-functions.php';
			}
		}

		public static function get_content_frontend( $template_id = '' ) {

			if ( ! empty( $template_id ) ) {
				$template_content = litho_get_builder_content_for_display( $template_id );
				printf( '%s', $template_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				return true;
			}
		}

		public static function get_template_id( $type ) {

			global $post;

			$post_id = array();
			if ( ! empty( $post ) && is_object( $post ) && isset( $post->ID ) && 'sectionbuilder' == get_post_type( $post->ID ) ) {
				$post_id = array( $post->ID );
			}
			$args = array(
				'post_type'   => 'sectionbuilder',
				'post_status' => array( 'publish', 'draft' ),
				'post__in'    => $post_id,
				'orderby'     => 'meta_value',
				'order'       => 'ASC',
				'meta_query'  => array(
					'relation' => 'OR',
					array(
						'key'     => '_litho_section_builder_template',
						'value'   => $type,
						'compare' => '==',
						'type'    => 'post',
					),
				),
			);

			$args = apply_filters( 'litho_sectionbuilder_get_template_id_args', $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			$template = new \WP_Query( $args );

			if ( $template->have_posts() ) {

				$posts = wp_list_pluck( $template->posts, 'ID' );
				wp_cache_set( $type, $posts );

				return $posts;
			}
			return '';
		}

	} // End of Class

} // End of Class Exists
