<?php
/**
 * Metabox Class Fill.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Calls the class on the post edit screen.
 */
function litho_meta_box_obj() {
	new Litho_Meta_Boxes();
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'litho_meta_box_obj' );
	add_action( 'load-post-new.php', 'litho_meta_box_obj' );
	add_action( 'load-edit-tags.php', 'litho_meta_box_obj' );
	add_action( 'load-term.php', 'litho_meta_box_obj' );
}

// If class `Litho_Meta_Boxes` doesn't exists yet.
if ( ! class_exists( 'Litho_Meta_Boxes' ) ) {

	/**
	 * Define Litho_Meta_Boxes Class
	 */
	class Litho_Meta_Boxes {

		/**
		 * Hook into the appropriate actions when the class is constructed.
		 */
		public function __construct() {

			$this->litho_metabox_addons();
			add_action( 'add_meta_boxes', array( $this, 'litho_add_meta_boxs' ) );
			add_action( 'save_post', array( $this, 'litho_save_meta_box' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_script_loader' ) );

			/* Portfolio */
			add_action( 'add_meta_boxes', array( $this, 'litho_add_meta_boxs_portfolios' ) );
		}

		/**
		 * Adds the meta box functions container.
		 */
		public function litho_metabox_addons() {
			if ( file_exists( LITHO_ADDONS_METABOX_PATH . '/meta-box-maps.php' ) ) {
				require_once LITHO_ADDONS_METABOX_PATH . '/meta-box-maps.php';
			}
		}

		/**
		 * Adds the meta box container.
		 */
		public function litho_add_meta_boxs( $litho_post_type ) {

			// limit meta box to certain post types.
			$litho_post_types = array(
				'post',
				'page',
				'portfolio',
				'sectionbuilder',
			);

			/* if WooCommerce plugin is activated */
			if ( is_woocommerce_activated() ) {
				$litho_post_types[] = 'product';
			}

			$flag = false;
			if ( in_array( $litho_post_type, $litho_post_types ) ) {
				$flag = true;
			}
			if ( $flag == true ) {
				switch ( $litho_post_type ) {
					case 'post':
						$this->litho_add_meta_box( 'litho_admin_options', esc_html__( 'Litho Post Settings', 'litho-addons' ), $litho_post_type );
						break;
					case 'portfolio':
						$this->litho_add_meta_box( 'litho_admin_options', esc_html__( 'Litho Portfolio Settings', 'litho-addons' ), $litho_post_type );
						break;
					case 'product':
						/* if WooCommerce plugin is activated */
						if ( is_woocommerce_activated() ) {
							$this->litho_add_meta_box( 'litho_admin_options', esc_html__( 'Litho Product Settings', 'litho-addons' ), $litho_post_type );
						}
						break;
					case 'sectionbuilder':
						$this->litho_add_meta_box( 'litho_meta_builder_setting', esc_html__( 'Litho Section Builder Settings', 'litho-addons' ), $litho_post_type );
						break;
					case 'page':
						$this->litho_add_meta_box( 'litho_admin_options', esc_html__( 'Litho Page Settings', 'litho-addons' ), $litho_post_type );
						break;
				}
			}
		}

		public function litho_add_meta_box( $litho_id, $litho_label_name, $litho_post_type ) {

			add_meta_box(
				$litho_id,
				$litho_label_name,
				array( $this, $litho_id ),
				$litho_post_type,
				'advanced',
				'default'
			);
		}

		public function litho_admin_options() {

			global $post;
			$layout_settings_tab = $post->post_type . '_layout_settings';

			if ( is_woocommerce_activated() && 'product' === $post->post_type ) {/* if WooCommerce plugin is activated */
				$litho_page_title_tabs  = esc_html__( 'Page Title', 'litho-addons' );
				$litho_tabs_title       = array(); // 'Page Title'
				$litho_tabs_sub_title   = array( '' );
				$litho_page_tabs        = array( $litho_page_title_tabs );
				$litho_page_tab_content = array( 'title_wrapper' );

			} elseif ( 'post' === $post->post_type || 'portfolio' === $post->post_type ) {

				$litho_tabs_title = array(
					0 => esc_html__( 'Layout Settings', 'litho-addons' ),
					1 => esc_html__( 'Header and Footer', 'litho-addons' ),
					2 => esc_html__( 'Page Title Settings', 'litho-addons' ),
					3 => esc_html__( 'Comments Settings', 'litho-addons' ),
					4 => sprintf( '%s %s %s', esc_html__( 'Single', 'litho-addons' ), ucfirst( $post->post_type ), esc_html__( 'Settings', 'litho-addons' ) ),
				);

				$litho_tabs_sub_title = array(
					0 => esc_html__( 'Layout configuration settings', 'litho-addons' ),
					1 => esc_html__( 'Header and Footer configuration settings', 'litho-addons' ),
					2 => esc_html__( 'Title section configuration settings', 'litho-addons' ),
					3 => sprintf( '%s %s', esc_html__( 'Enable&#47;Disable comments in', 'litho-addons' ), $post->post_type ),
					4 => '',
				);

				$litho_page_tabs = array(
					0 => esc_html__( 'Layout Settings', 'litho-addons' ),
					1 => esc_html__( 'Header and Footer', 'litho-addons' ),
					2 => esc_html__( 'Page Title Settings', 'litho-addons' ),
					3 => esc_html__( 'Comments Settings', 'litho-addons' ),
					4 => sprintf( '%s %s %s', esc_html__( 'Single', 'litho-addons' ), ucfirst( $post->post_type ), esc_html__( 'Layout', 'litho-addons' ) ),
				);

				$litho_page_tab_content = array(
					$layout_settings_tab,
					'builder_page_settings',
					'title_wrapper',
					'content',
					'single_post_layout',
				);

			} else {

				$litho_tabs_title = array(
					0 => esc_html__( 'Layout Settings', 'litho-addons' ),
					1 => esc_html__( 'Header and Footer', 'litho-addons' ),
					2 => esc_html__( 'Page Title Settings', 'litho-addons' ),
					3 => esc_html__( 'Comments Settings', 'litho-addons' ),
				);

				$litho_tabs_sub_title = array(
					0 => esc_html__( 'Layout configuration settings', 'litho-addons' ),
					1 => esc_html__( 'Header and Footer configuration settings', 'litho-addons' ),
					2 => esc_html__( 'Title section configuration settings', 'litho-addons' ),
					3 => esc_html__( 'Enable&#47;Disable comments in page', 'litho-addons' ),
				);

				$litho_page_tabs = array(
					0 => esc_html__( 'Layout Settings', 'litho-addons' ),
					1 => esc_html__( 'Header and Footer', 'litho-addons' ),
					2 => esc_html__( 'Page Title Settings', 'litho-addons' ),
					3 => esc_html__( 'Comments Settings', 'litho-addons' ),
				);

				$litho_page_tab_content = array(
					$layout_settings_tab,
					'builder_page_settings',
					'title_wrapper',
					'content',
				);
			}

			if ( is_woocommerce_activated() && 'product' === $post->post_type ) {/* if WooCommerce plugin is activated */

				$litho_icon_class = array(
					'ti-layout-accordion-separated',
				);

			} else {

				$litho_icon_class = array(
					'icon-gears',
					'fa-solid fa-window-maximize',
					'fa-solid fa-heading',
					'ti-layout-accordion-separated',
					'fa-solid fa-align-left',
					'fa-solid fa-server',
					'ti-layout-accordion-separated',
					'ti-layout-media-overlay-alt',
					'ti-layout-menu-separated',
					'ti-layout-accordion-separated',
				);
			}

			if ( ! empty( $litho_tabs_title ) ) {
				?>
				<ul class="litho_meta_box_tabs">
					<?php
					$litho_icon     = 0;
					$litho_showicon = '';

					foreach ( $litho_tabs_title as $tab_key => $tab_name ) {
						if ( $litho_icon_class ) {
							$litho_showicon = '<i class="' . esc_attr( $litho_icon_class[ $litho_icon ] ) . '"></i>';
						}
						?>
						<li class="litho_tab_<?php echo esc_attr( $litho_page_tab_content[ $tab_key ] ); ?>">
							<a href="<?php echo esc_url( $tab_name ); ?>">
								<?php printf( '%s', $litho_showicon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<span class="group_title"><?php echo esc_html( $tab_name ); ?></span>
							</a>
						</li>
						<?php
						$litho_icon++;
					}
					?>
				</ul>
				<?php
			}
			?>
			<div class="litho_meta_box_tab_content">
				<?php foreach ( $litho_page_tab_content as $tab_content_key => $tab_content_name ) { ?>
					<div class="litho_meta_box_tab" id="litho_tab_<?php echo esc_attr( $tab_content_name ); ?>">
						<div class="main_tab_title">
							<h3>
								<?php
								echo isset( $litho_page_tabs[ $tab_content_key ] ) ? $litho_page_tabs[ $tab_content_key ] : '';// phpcs:ignore
								$reset_key = isset( $litho_page_tabs[ $tab_content_key ] ) ? $litho_page_tabs[ $tab_content_key ] : '';

								$clear_button_value = __( 'Clear', 'litho-addons' ) . ' ' . $reset_key;
								?>
								<a href="javascript:void(0);" reset_key="<?php echo esc_attr( $reset_key ); ?>" class="button button-primary litho_tab_reset_settings"><?php echo esc_html( $clear_button_value ); ?></a>
							</h3>
							<span class="description"><?php echo esc_html( $litho_tabs_sub_title[ $tab_content_key ] ); ?></span>
						</div>
						<?php
						if ( file_exists( LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_' . $tab_content_name . '.php' ) ) {

							require_once LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_' . $tab_content_name . '.php';
						}
						?>
					</div>
				<?php } ?>
			</div>
			<div class="clear"></div>
			<?php
		}

		/**
		 * Adds the meta box for Portfolio.
		 */
		public function litho_add_meta_boxs_portfolios( $litho_post_type ) {
			// limit meta box to certain post types.
			$litho_post_types = array(
				'portfolio',
				'post',
			);

			$flag = false;

			if ( in_array( $litho_post_type, $litho_post_types ) ) {
				$flag = true;
			}
			if ( $flag == true ) {
				$this->litho_add_meta_box( 'litho_admin_options_single', 'Litho ' . ucfirst( $litho_post_type ) . ' Format Settings', $litho_post_type );
			}
		}

		/**
		 * Adds the meta box for Section Builder.
		 */
		public function litho_meta_builder_setting() {

			global $post;
			?>
			<div class="litho_meta_box_tab_content_single">
				<div class="litho_meta_box_tab" id="litho_tab_single"></div>
				<?php
				if ( 'sectionbuilder' === $post->post_type ) {

					if ( file_exists( LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_bulider_section_settings.php' ) ) {
						require_once LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_bulider_section_settings.php';
					}
				}
				?>
			</div>
			<div class="clear"></div>
			<?php
		}

		/**
		 * Adds the meta box for single post and portfolio
		 */
		public function litho_admin_options_single() {
			global $post;
			?>
			<div class="litho_meta_box_tab_content_single">
				<?php if ( 'portfolio' === $post->post_type ) { ?>
					<input name="litho_portfolio_post_type_single" id="litho_portfolio_post_type_single" type="hidden" value="" />
				<?php } ?>
				<div class="litho_meta_box_tab" id="litho_tab_single"></div>
				<?php
				if ( 'post' === $post->post_type ) {

					if ( file_exists( LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_post_setting.php' ) ) {
						require_once LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_post_setting.php';
					}
				} else {

					if ( file_exists( LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_portfolio_setting.php' ) ) {
						require_once LITHO_ADDONS_METABOX_PATH . '/metabox-tabs/metabox_portfolio_setting.php';
					}
				}
				?>
			</div>
			<div class="clear"></div>
			<?php
		}

		/**
		 * Save the meta when the post is saved.
		 *
		 * @param int $litho_post_id The ID of the post being saved.
		 */
		public function litho_save_meta_box( $litho_post_id ) {

			// If this is an autosave, our form has not been submitted,
			// so we don't want to do anything.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $litho_post_id;
			}

			/* OK, its safe for us to save the data now. */
			$litho_data = array();

			foreach ( $_POST as $key => $value ) { // phpcs:ignore

				// Sanitize the user input.
				$litho_data = isset( $_POST[ $key ] ) ? $_POST[ $key ] : ''; // phpcs:ignore

				if ( strstr( $key, '_litho_' ) ) {

					// Update the meta field.
					update_post_meta( $litho_post_id, $key, $litho_data );

				} elseif ( strstr( $key, 'litho_' ) ) {

					// Meta Prefix.
					$meta_prefix = '_';

					// Update the meta field.
					update_post_meta( $litho_post_id, $meta_prefix . $key, $litho_data );
				}
			}
		}
		/**
		 * Enqueue scripts and styles admin side
		 */
		public function admin_script_loader() {

			global $pagenow;

			if ( is_admin() && ( 'post-new.php' === $pagenow || 'post.php' === $pagenow || 'edit-tags.php' === $pagenow || 'term.php' === $pagenow ) ) {

				wp_register_style(
					'alpha-color-picker',
					LITHO_ADDONS_METABOX_DIR . '/css/alpha-color-picker.css',
					array( 'wp-color-picker' ),
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_register_style(
					'litho-admin-metabox',
					LITHO_ADDONS_METABOX_DIR . '/css/meta-box.css',
					array(),
					LITHO_ADDONS_PLUGIN_VERSION
				);

				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'thickbox' );
				wp_enqueue_style( 'alpha-color-picker' );
				wp_enqueue_style( 'litho-admin-metabox' );

				wp_register_script(
					'alpha-color-picker',
					LITHO_ADDONS_METABOX_DIR . '/js/alpha-color-picker.js',
					array( 'jquery', 'wp-color-picker' ),
					LITHO_ADDONS_PLUGIN_VERSION,
					true
				);
				wp_register_script(
					'litho-admin-metabox-cookie',
					LITHO_ADDONS_METABOX_DIR . '/js/metabox-cookie.js',
					array( 'jquery' ),
					LITHO_ADDONS_PLUGIN_VERSION,
					true
				);
				wp_register_script(
					'litho-admin-metabox',
					LITHO_ADDONS_METABOX_DIR . '/js/meta-box.js',
					array( 'jquery', 'litho-admin-metabox-cookie', 'media-upload', 'jquery-ui-sortable', 'alpha-color-picker' ),
					LITHO_ADDONS_PLUGIN_VERSION,
					true
				);

				wp_enqueue_media();
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'media-upload' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'jquery-ui-sortable' );
				wp_enqueue_script( 'alpha-color-picker' );
				wp_enqueue_script( 'litho-admin-metabox-cookie-js' );
				wp_enqueue_script( 'litho-admin-metabox' );

				wp_localize_script(
					'litho-admin-metabox',
					'LithoMetabox',
					array(
						'i18n' => array(
							'reset_message' => esc_attr__( 'This will remove / clear all ### for this page and then it will use settings from WordPress customize panel. Are you sure to clear ###?', 'litho-addons' ),
						),
					)
				);
			}
		}
	}
}
