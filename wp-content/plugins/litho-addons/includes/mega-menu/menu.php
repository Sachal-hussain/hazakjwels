<?php
namespace LithoAddons\Mega_menu;

/**
 * Mega Menu initialize
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Menu` doesn't exists yet.
if ( ! class_exists( 'Menu' ) ) {

	/**
	 * Define menu class
	 */
	class Menu {

		protected $current_menu_id = null;

		/**
		 * Custom post type slug
		 *
		 * @var string $post_type Post type slug
		 */
		public $post_type = 'litho-mega-menu';

		/**
		 * Constructor for the class
		 */
		public function __construct() {

			add_action( 'init', [ $this, 'register_post_type' ] );
			add_action( 'admin_footer', [ $this, 'admin_templates' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'litho_menu_admin_script' ], 1001 );
			add_action( 'template_include', [ $this, 'set_post_type_template' ], 9999 );

			$this->edit_redirect();

			foreach ( $this->litho_menu_tabs() as $tab ) {

				$ajax_action   = $tab['action'];
				$ajax_callback = $tab['callback'];

				add_action( 'wp_ajax_' . $ajax_action, [ $this, $ajax_callback ] );
				add_action( 'wp_ajax_nopriv_' . $ajax_action, [ $this, $ajax_callback ] );
			}
		}
		public function litho_menu_admin_script() {

			global $pagenow;

			if ( 'nav-menus.php' === $pagenow ) {

				wp_register_style(
					'litho-mega-menu-style',
					LITHO_ADDONS_MEGAMENU_DIR . '/assets/admin/mega-menu-style.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_register_style(
					'themify-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/themify-icons.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_register_style(
					'feather-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/feather-icons.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_register_style(
					'simple-line-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/simple-line-icons.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_register_style(
					'et-line-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/et-line-icons.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION
				);

				wp_register_style(
					'iconsmind-line-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/iconsmind-line.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_register_style(
					'iconsmind-solid-icons',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/iconsmind-solid.css',
					[],
					LITHO_ADDONS_PLUGIN_VERSION
				);
				wp_register_style(
					'font-awesome',
					LITHO_ADDONS_INCLUDES_DIR . '/assets/css/font-awesome.min.css',
					[],
					'6.5.2'
				);

				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'litho-mega-menu-style' );
				wp_enqueue_style( 'themify-icons' );
				wp_enqueue_style( 'feather-icons' );
				wp_enqueue_style( 'simple-line-icons' );
				wp_enqueue_style( 'et-line-icons' );
				wp_enqueue_style( 'iconsmind-line-icons' );
				wp_enqueue_style( 'iconsmind-solid-icons' );
				wp_enqueue_style( 'font-awesome' );

				wp_register_script(
					'litho-mega-menu-script',
					LITHO_ADDONS_MEGAMENU_DIR . '/assets/admin/mega-menu-script.js',
					[ 'jquery', 'wp-util', 'select2' ],
					LITHO_ADDONS_PLUGIN_VERSION,
					true
				);

				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'litho-mega-menu-script' );

				$litho_disable_lithomenu     = '';
				$litho_enable_header_general = litho_builder_customize_option( 'litho_enable_header_general', '1' );
				$litho_header_section_id     = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );

				if ( ! empty( $litho_header_section_id ) && litho_post_exists( $litho_header_section_id ) ) {
					$litho_disable_lithomenu = 'yes';
				}

				wp_localize_script(
					'litho-mega-menu-script',
					'LithoMegamenu',
					array(
						'currentMenuId'    => $this->get_selected_menu_id(),
						'tabs'             => $this->litho_menu_tabs(),
						'disableLithoMenu' => $litho_disable_lithomenu,
						'i18n'             => array(
							'placeholder'          => __( 'Select menu item icon', 'litho-addons' ),
							'saveLabel'            => __( 'Save', 'litho-addons' ),
							'triggerLabel'         => __( 'LithoMenu', 'litho-addons' ),
							'leaveEditor'          => __( 'Are you sure you want to leave this panel? The changes you made may be lost.', 'litho-addons' ),
							'megaMenuAlertMessage' => __( 'Please enable Litho Menu settings for current location', 'litho-addons' ),
						),
						'editURL'          => add_query_arg(
							array(
								'litho-open-editor' => 1,
								'item'              => '%id%',
								'menu'              => '%menuid%',
							),
							esc_url( admin_url( '/' ) )
						),
					)
				);
			}
		}

		public function litho_menu_tabs() {

			return apply_filters(
				'litho-menu/settings/tabs',
				array(
					'content' => array(
						'label'        => __( 'Item Content', 'litho-addons' ),
						'template'     => false,
						'templateFile' => false,
						'action'       => 'litho_menu_tab_content',
						'callback'     => 'get_tab_content',
						'data'         => array(),
						'depthFrom'    => 0,
						'depthTo'      => 1,
					),
					'icon'    => array(
						'label'        => __( 'Item Icon', 'litho-addons' ),
						'template'     => false,
						'templateFile' => false,
						'action'       => 'litho_menu_tab_icon',
						'callback'     => 'get_tab_icon',
						'data'         => array(),
						'depthFrom'    => 0,
						'depthTo'      => 100,
					),
				)
			);
		}

		public function get_tab_content() {

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error(
					array(
						'message' => esc_html__( 'You are not allowed to do this', 'litho-addons' ),
					)
				);
			}
			$menu_id = $this->get_requested_menu_id();
			?>
			<div class="litho-content-tab-wrap content-tab-field-control">
				<?php
				$enable_mega_submenu = get_post_meta( $menu_id, '_enable_mega_submenu', true );
				?>
				<div class="litho-content-tab-wrap-box">
					<span class="title">
						<?php esc_html_e( 'Enable Mega submenu', 'litho-addons' ); ?>
					</span>
					<label for="enable_mega_submenu" class="menu-checkbox-switch">
						<input type="checkbox" name="enable_mega_submenu" id="enable_mega_submenu" class="enable-mega-submenu" value="yes" <?php if ( isset( $enable_mega_submenu ) ) checked( $enable_mega_submenu, 'yes' ); ?> data-current-nav-menu="<?php echo esc_attr( $this->get_selected_menu_id() ); ?>"/>
							<span class="toggle"></span>
					</label>
				</div>
				<div class="litho-content-tab-wrap-box">
					<label for="mega_menu_item_content" class="title">
						<?php esc_html_e( 'Mega menu item content', 'litho-addons' ); ?>
					</label>
					<button id="mega_menu_item_content" class="litho-menu-editor button button-primary button-large">
						<?php esc_html_e( 'Edit with elementor', 'litho-addons' ); ?>
					</button>
				</div>
			</div>
			<?php
			die();
		}

		public function get_tab_icon() {

			$menu_id                 = $this->get_requested_menu_id();
			$menu_item_icon          = get_post_meta( $menu_id, '_menu_item_icon', true );
			$menu_item_icon_position = get_post_meta( $menu_id, '_menu_item_icon_position', true );
			$menu_item_icon_color    = get_post_meta( $menu_id, '_menu_item_icon_color', true );
			?>
			<div class="litho-icon-tab-wrap content-tab-field-control">
				<div class="litho-icon-container litho-content-tab-wrap-box">
					<label for="menu-item-icon" class="title">
						<?php esc_html_e( 'Select menu icon', 'litho-addons' ); ?>
					</label>
					<?php
					$litho_fontawesome_solid = litho_fontawesome_solid();
					$litho_fontawesome_reg   = litho_fontawesome_reg();
					$litho_fontawesome_brand = litho_fontawesome_brand();
					$litho_fontawesome_light = litho_fontawesome_light();
					$litho_et_line_icons     = litho_et_line_icons();
					$litho_themify_icons     = litho_themify_icons();
					$litho_simple_icons      = litho_simple_icons();
					?>
					<select id="menu-item-icon" class="litho-menu-icons" name="menu-item-icon">
						<option></option>
						<?php /* Font awesome solid icons */ ?>
						<?php if ( ! empty( $litho_fontawesome_solid ) ) { ?>
							<optgroup label="<?php echo esc_attr__( 'Font awesome solid icon', 'litho-addons' ); ?>">
								<?php foreach ( $litho_fontawesome_solid as $icon => $val ) { ?>
									<?php $selected = ( ( 'fas ' . $val == $menu_item_icon ) || ( 'fa-solid ' . $val == $menu_item_icon ) ) ? ' selected="selected"' : ''; ?>
									<option <?php echo esc_attr( $selected ); ?> data="<?php echo esc_attr( $menu_item_icon ); ?> value, <?php echo esc_attr( $val ); ?> val, id=<?php echo esc_attr( $menu_id ); ?>" data-icon="fa-solid <?php echo esc_attr( $val ); ?>" value="fa-solid <?php echo esc_attr( $val ); ?>">fa-solid <?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
						<?php /* Font awesome regular icons */ ?>
						<?php if ( ! empty( $litho_fontawesome_reg ) ) { ?>
							<optgroup label="<?php echo esc_attr__( 'Font awesome regular icon', 'litho-addons' ); ?>">
								<?php foreach ( $litho_fontawesome_reg as $icon => $val ) { ?>
									<?php $selected = ( ( 'far ' . $val == $menu_item_icon ) || ( 'fa-regular ' . $val == $menu_item_icon ) ) ? ' selected="selected"' : ''; ?>
									<option <?php echo esc_attr( $selected ); ?> data="<?php echo esc_attr( $menu_item_icon ); ?> value, <?php echo esc_attr( $val ); ?> val, id=<?php echo esc_attr( $menu_id ); ?>" data-icon="fa-regular <?php echo esc_attr( $val ); ?>" value="fa-regular <?php echo esc_attr( $val ); ?>">fa-regular <?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
						<?php /* Font awesome brand icons */ ?>
						<?php if ( ! empty( $litho_fontawesome_brand ) ) { ?>
							<optgroup label="<?php echo esc_attr__( 'Font awesome brand icon', 'litho-addons' ); ?>">
								<?php foreach ( $litho_fontawesome_brand as $icon => $val ) { ?>
									<?php $selected = ( ( 'fab ' . $val == $menu_item_icon ) || ( 'fa-brands ' . $val == $menu_item_icon ) ) ? ' selected="selected"' : ''; ?>
									<option <?php echo esc_attr( $selected ); ?> data="<?php echo esc_attr( $menu_item_icon ); ?> value, <?php echo esc_attr( $val ); ?> val, id=<?php echo esc_attr( $menu_id ); ?>" data-icon="fa-brands <?php echo esc_attr( $val ); ?>" value="fa-brands <?php echo esc_attr( $val ); ?>">fa-brands <?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
						<?php /* Font awesome light icons */ ?>
						<?php if ( ! empty( $litho_fontawesome_light ) ) { ?>
							<optgroup label="<?php echo esc_attr__( 'Font Awesome Light Icon', 'litho-addons' ); ?>">
								<?php foreach ( $litho_fontawesome_light as $icon => $val ) { ?>
									<?php $selected = ( ( 'fal ' . $val == $menu_item_icon ) || ( 'fa-light ' . $val == $menu_item_icon ) ) ? ' selected="selected"' : ''; ?>
									<option <?php echo esc_attr( $selected ); ?> data="<?php echo esc_attr( $menu_item_icon ); ?> value, <?php echo esc_attr( $val ); ?> val, id=<?php echo esc_attr( $menu_id ); ?>" data-icon="fa-light <?php echo esc_attr( $val ); ?>" value="fa-light <?php echo esc_attr( $val ); ?>">fa-light <?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
						<?php /* ET-line icons */ ?>
						<?php if ( ! empty( $litho_et_line_icons ) ) { ?>
							<optgroup label="<?php echo esc_attr__( 'ET-line icon', 'litho-addons' ); ?>">
								<?php foreach ( $litho_et_line_icons as $icon => $val ) { ?>
									<?php $selected = ( $val == $menu_item_icon ) ? ' selected="selected"' : ''; ?>
									<option <?php echo esc_attr( $selected ); ?> data="<?php echo esc_attr( $menu_item_icon ); ?> value, <?php echo esc_attr( $val ); ?> val, id=<?php echo esc_attr( $menu_id ); ?>" data-icon="<?php echo esc_attr( $val ); ?>" value="<?php echo esc_attr( $val ); ?>"><?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
						<?php /* Themify icons */ ?>
						<?php if ( ! empty( $litho_themify_icons ) ) { ?>
							<optgroup label="<?php echo esc_attr__( 'Themify icon', 'litho-addons' ); ?>">
								<?php foreach ( $litho_themify_icons as $icon => $val ) { ?>
									<?php $selected = ( $val == $menu_item_icon ) ? ' selected="selected"' : ''; ?>
									<option <?php echo esc_attr( $selected ); ?> data="<?php echo esc_attr( $menu_item_icon ); ?> value, <?php echo esc_attr( $val ); ?> val, id=<?php echo esc_attr( $menu_id ); ?>" data-icon="<?php echo esc_attr( $val ); ?>" value="<?php echo esc_attr( $val ); ?>"><?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
						<?php /* Simple icons */ ?>
						<?php if ( ! empty( $litho_simple_icons ) ) { ?>
							<optgroup label="<?php echo esc_attr__( 'Simple icon', 'litho-addons' ); ?>">
								<?php foreach ( $litho_simple_icons as $icon => $val ) { ?>
									<?php $selected = ( $val == $menu_item_icon ) ? ' selected="selected"' : ''; ?>
									<option <?php echo esc_attr( $selected ); ?> data="<?php echo esc_attr( $menu_item_icon ); ?> value, <?php echo esc_attr( $val ); ?> val, id=<?php echo esc_attr( $menu_id ); ?>" data-icon="<?php echo esc_attr( $val ); ?>" value="<?php echo esc_attr( $val ); ?>"><?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
					</select>
				</div>
				<div class="litho-icon-container litho-content-tab-wrap-box">
					<label for="menu-item-icon-position" class="title">
						<?php esc_html_e( 'Icon position', 'litho-addons' ); ?>
					</label>
					<?php 
					$menu_item_icon_position_arr = array(
						'before' => esc_html__( 'Before', 'litho-addons' ),
						'after'  => esc_html__( 'After', 'litho-addons' ),
					);
					?>
					<select id="menu-item-icon-position" class="menu-item-icon-position" name="menu-item-icon-position">
						<?php foreach ( $menu_item_icon_position_arr as $key => $val ) { ?>
							<?php $selected = ( $key == $menu_item_icon_position ) ? ' selected="selected"' : ''; ?>
							<option <?php echo esc_attr( $selected ); ?> value="<?php echo esc_attr( $key ); ?>"><?php echo htmlspecialchars( $val ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="litho-icon-container litho-content-tab-wrap-box">
					<label for="menu-item-icon-color" class="title">
						<?php esc_html_e( 'Icon color', 'litho-addons' ); ?>
					</label>
					<input id="menu-item-icon-color" class="menu-item-icon-color" type="text" name="menu-item-icon-color" value="<?php echo esc_attr( $menu_item_icon_color ); ?>" />
				</div>
			</div>
			<?php
			die();
		}

		/**
		 * Print templates
		 */
		public function admin_templates() {

			$screen = get_current_screen();

			if ( 'nav-menus' !== $screen->base ) {
				return;
			}

			$templates = array(
				'menu-trigger'  => 'menu-trigger.html',
				'popup-wrapper' => 'popup-wrapper.html',
				'popup-tabs'    => 'popup-tabs.html',
				'editor-frame'  => 'editor-frame.html',
			);
			$this->print_templates_array( $templates );
		}

		/**
		 * Print templates array
		 *
		 * @param array $templates List of templates to print.
		 */
		public function print_templates_array( $templates = array() ) {

			if ( empty( $templates ) ) {
				return;
			}

			foreach ( $templates as $id => $file ) {

				$file = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/' . $file;

				if ( ! file_exists( $file ) ) {
					continue;
				}
				ob_start();
				include $file;
				$content = ob_get_clean();
				printf( '<script type="text/html" id="tmpl-%1$s">%2$s</script>', esc_attr( $id ), $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
		public function register_post_type() {

			$labels = array(
				'name'          => __( 'Mega Menu Items', 'litho-addons' ),
				'singular_name' => __( 'Mega Menu Item', 'litho-addons' ),
				'add_new'       => __( 'Add New Mega Menu Item', 'litho-addons' ),
				'add_new_item'  => __( 'Add New Mega Menu Item', 'litho-addons' ),
				'edit_item'     => __( 'Edit Mega Menu Item', 'litho-addons' ),
				'menu_name'     => __( 'Mega Menu Items', 'litho-addons' ),
			);

			$args = array(
				'labels'              => $labels,
				'hierarchical'        => false,
				'description'         => 'description',
				'taxonomies'          => array(),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_admin_bar'   => true,
				'menu_position'       => null,
				'menu_icon'           => null,
				'show_in_nav_menus'   => false,
				'publicly_queryable'  => true,
				'exclude_from_search' => true,
				'has_archive'         => false,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite'             => false,
				'capability_type'     => 'post',
				'supports'            => array( 'title', 'thumbnail', 'elementor', 'author' ),
			);
			register_post_type( 'litho-mega-menu', $args );
		}

		public function apply_flush_rules() {
			global $wp_rewrite;

			// Flush the rules and tell it to write htaccess.
			$wp_rewrite->flush_rules( true );
		}

		public function edit_redirect() {

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			if ( empty( $_REQUEST['litho-open-editor'] ) ) {
				return;
			}

			if ( empty( $_REQUEST['item'] ) ) {
				return;
			}

			if ( empty( $_REQUEST['menu'] ) ) {
				return;
			}

			$menu_id 	  = intval( $_REQUEST['menu'] );
			$menu_item_id = intval( $_REQUEST['item'] );
			$mega_menu_id = get_post_meta( $menu_item_id, '_litho_menu_item', true );

			if ( ! $mega_menu_id ) {

				$mega_menu_id = wp_insert_post(
					array(
						'post_title'  => 'mega-item-' . $menu_item_id,
						'post_status' => 'publish',
						'post_type'   => 'litho-mega-menu',
					)
				);

				update_post_meta( $menu_item_id, '_litho_menu_item', $mega_menu_id );
			}

			$edit_link = add_query_arg(
				array(
					'post'        => $mega_menu_id,
					'action'      => 'elementor',
					'context'     => 'litho-addons',
					'parent_menu' => $menu_id,
				),
				admin_url( 'post.php' )
			);
			wp_redirect( $edit_link );
			die();
		}

		public function set_post_type_template( $template ) {

			if ( is_singular( $this->post_type ) ) {
				$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/blank.php';
			}
			return $template;
		}

		public function get_selected_menu_id() {

			if ( null !== $this->current_menu_id ) {
				return $this->current_menu_id;
			}

			$nav_menus  = wp_get_nav_menus( array( 'orderby' => 'name' ) );
			$menu_count = count( $nav_menus );
			$nav_menu_selected_id = isset( $_REQUEST['menu'] ) ? (int) $_REQUEST['menu'] : 0;
			$add_new_screen = ( isset( $_GET['menu'] ) && 0 == $_GET['menu'] ) ? true : false;

			$this->current_menu_id = $nav_menu_selected_id;

			// If we have one theme location, and zero menus, we take them right into editing their first menu.
			$page_count = wp_count_posts( 'page' );

			$one_theme_location_no_menus = ( 1 == count( get_registered_nav_menus() ) && ! $add_new_screen && empty( $nav_menus ) && ! empty( $page_count->publish ) ) ? true : false;

			// Get recently edited nav menu.
			$recently_edited = absint( get_user_option( 'nav_menu_recently_edited' ) );
			if ( empty( $recently_edited ) && is_nav_menu( $this->current_menu_id ) ) {
				$recently_edited = $this->current_menu_id;
			}

			// Use $recently_edited if none are selected.
			if ( empty( $this->current_menu_id ) && ! isset( $_GET['menu'] ) && is_nav_menu( $recently_edited ) ) {
				$this->current_menu_id = $recently_edited;
			}

			// On deletion of menu, if another menu exists, show it.
			if ( ! $add_new_screen && 0 < $menu_count && isset( $_GET['action'] ) && 'delete' == $_GET['action'] ) {
				$this->current_menu_id = $nav_menus[0]->term_id;
			}

			// Set $this->current_menu_id to 0 if no menus.
			if ( $one_theme_location_no_menus ) {
				$this->current_menu_id = 0;
			} elseif ( empty( $this->current_menu_id ) && ! empty( $nav_menus ) && ! $add_new_screen ) {
				// if we have no selection yet, and we have menus, set to the first one in the list.
				$this->current_menu_id = $nav_menus[0]->term_id;
			}

			return $this->current_menu_id;
		}

		public function get_requested_menu_id() {

			$menu_id = isset( $_REQUEST['menu_id'] ) ? absint( $_REQUEST['menu_id'] ) : false;

			if ( ! $menu_id ) {
				wp_send_json_error(
					array(
						'message' => esc_html__( 'Incorrect input data', 'litho-addons' ),
					)
				);
			}
			return $menu_id;
		}
	}
}
