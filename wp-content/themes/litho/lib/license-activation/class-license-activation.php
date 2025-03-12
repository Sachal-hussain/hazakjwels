<?php
/**
 * License Activation Class
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Litho_License_Activation' ) ) {
	/**
	 * Define Litho_License_Activation class
	 */
	class Litho_License_Activation {

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'admin_enqueue_scripts', array( $this, 'litho_demo_import_script_style' ) );
			add_action( 'admin_menu', array( $this, 'litho_license_activation_page' ), 5 );
			add_action( 'wp_ajax_litho_active_theme_license', array( $this, 'litho_active_theme_license' ) );
			add_action( 'admin_init', array( $this, 'litho_theme_activate' ) );
			add_action( 'admin_init', array( $this, 'litho_maybe_redirect_to_getting_started' ) );
			add_action( 'wp_before_admin_bar_render', array( $this, 'litho_admin_bar_theme_setup_link' ) );
		}

		/**
		 * Add theme setup page link in admin bar.
		 */
		public function litho_admin_bar_theme_setup_link() {

			global $wp_admin_bar;

			$theme_setup_url = admin_url( 'themes.php' );
			$theme_setup_url = add_query_arg( array( 'page' => 'litho-theme-setup' ), $theme_setup_url );

			$args = array(
				'id'     => 'theme-setup-menu',
				'parent' => 'appearance',
				'title'  => esc_html__( 'Theme Setup', 'litho' ),
				'href'   => esc_url( $theme_setup_url ),
			);
			$wp_admin_bar->add_menu( $args );
		}

		/**
		 * Scripts & Styles.
		 *
		 * @param string $hook Action hook to execute when the event is run.
		 */
		public function litho_demo_import_script_style( $hook ) {

			if ( is_admin() && ! empty( $hook ) && $hook == 'appearance_page_litho-theme-setup' ) {

				wp_register_style( 'litho-import', LITHO_THEME_ADMIN_CSS_URI . '/import.css', array(), LITHO_THEME_VERSION );
				wp_enqueue_style( 'litho-import' );
			}
		}

		/**
		 * Theme setup page in Admin panel > Appereance.
		 */
		public function litho_license_activation_page() {

			add_theme_page(
				esc_html__( 'Theme Setup', 'litho' ), // page title.
				esc_html__( 'Theme Setup', 'litho' ), // menu title.
				'manage_options', // capability.
				'litho-theme-setup', // menu slug.
				array( $this, 'litho_license_activation_callback' ) // callback function.
			);
		}

		/**
		 * Theme setup page callback for demo data install in Admin panel > Appereance.
		 */
		public function litho_license_activation_callback() {

			/* Check current user permission */
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'litho' ) );
			}

			// Update license activation.
			$license_message = '';
			if ( isset( $_GET['token'] ) && isset( $_GET['response'] ) ) {
				$litho_license_token = get_transient( 'litho_license_token' );
				if ( $_GET['token'] == $litho_license_token ) {
					if ( 'true' == $_GET['response'] && ! empty( $_GET['pcode'] ) && isset( $_GET['msg'] ) ) {
						if ( isset( $_GET['unregister'] ) && '1' == $_GET['unregister'] ) {
							litho_update_theme_license( '' );
						} else {
							litho_update_theme_license( $_GET['pcode'] ); // phpcs:ignore
						}
					} elseif ( 'false' == $_GET['response'] && isset( $_GET['msg'] ) ) {
						$license_message .= '<div class="license-activated-failed is-dismissible notice error notice-error"><p>' . esc_html( $_GET['msg'] ) . '</p></div>'; // phpcs:ignore
					} elseif ( 'access_denied' == $_GET['response'] && isset( $_GET['msg'] ) ) {
						$license_message .= '<div class="license-activated-access-denied is-dismissible notice error notice-error"><p>' . esc_html( $_GET['msg'] ) . '</p></div>'; // phpcs:ignore
					}
				}
			}

			// For Get site license activate or not.
			$is_theme_license_active = is_theme_license_active();

			/* Gets a WP_Theme object for a theme. */
			$litho_theme_obj      = wp_get_theme();
			$litho_theme_name     = $litho_theme_obj->get( 'Name' );
			$litho_theme_themeuri = rtrim( $litho_theme_obj->get( 'ThemeURI' ), '/' );
			$litho_theme_author   = rtrim( $litho_theme_obj->get( 'AuthorURI' ), '/' );
			$litho_theme_name     = str_ireplace( array( 'child', ' child' ), array( '', '' ), $litho_theme_name );
			$litho_theme_name     = trim( $litho_theme_name );

			echo '<div class="wrap theme-setup-wrap">';
				echo wp_kses_post( $license_message );
				echo '<div class="theme-setup-content">';

					echo '<h1 class="display-none"></h1>';
					echo '<div class="litho-header-license">';

						echo '<div class="litho-head-left">';
							echo '<img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/white-logo.png' ) . '" alt="' . esc_attr( $litho_theme_name ) . '" />';
						echo '</div>';
						echo '<div class="litho-head-right">';
							echo '<span class="litho-version">' . esc_html( sprintf( __( 'Version %s', 'litho' ), LITHO_THEME_VERSION ) ) . '</span>';
							echo '<span class="link_sep">|</span>';
							echo '<a target="_blank" href="' . esc_url( $litho_theme_themeuri ) . '/documentation/">' . esc_html__( 'Online documentation', 'litho' ) . '</a>';
							echo '<span class="link_sep">|</span>';
							echo '<a target="_blank" href="' . esc_url( $litho_theme_author ) . '/support/">' . esc_html__( 'Support center', 'litho' ) . '</a>';
						echo '</div>';
						echo '<div class="clear"></div>';
					echo '</div>';

					echo '<div class="litho-welcome-wrap">';
						echo '<div class="litho-welcome-wrapper">';
							echo '<div class="welcome-title">';
								echo '<h2>' . esc_html( sprintf( __( 'Welcome to %s', 'litho' ), $litho_theme_name ) ) . '</h2>';
							echo '</div>';
							echo '<div class="welcome-description">';
							if ( $is_theme_license_active ) {
								echo '<p>' . esc_html( sprintf( __( 'Awesome! Your %1$s theme license is already activated. Enjoy premium features of %2$s.', 'litho' ), $litho_theme_name, $litho_theme_name ) ) . '</p>';
							} else {
								echo '<p>' . esc_html( sprintf( __( 'Please enter your %s theme purchase code and activate theme license to enjoy premium features.', 'litho' ), $litho_theme_name ) ) . '</p>';
							}
							echo '</div>';
						echo '</div>';
					echo '</div>';

					echo '<div class="litho-import-tab">';
						echo '<ul>';
							$steps = array(
								'1' => esc_html__( 'Theme License', 'litho' ),
								'2' => esc_html__( 'Install Plugins', 'litho' ),
								'3' => esc_html__( 'Import Demo', 'litho' ),
							);
							if ( is_woocommerce_activated() ) {
								$steps['4'] = esc_html__( 'WooCommerce', 'litho' );
							}

							$step = isset( $_GET['step'] ) ? $_GET['step'] : '1'; // phpcs:ignore

							foreach ( $steps as $key => $value ) {
								$active_class = '';
								if ( $key == $step ) {
									$active_class = ' class="active"';
								}
								$url = add_query_arg(
									array(
										'page' => 'litho-theme-setup',
										'step' => $key
									), admin_url( 'themes.php' )
								);
								echo '<li><a href="' . esc_url( $url ) . '"' . $active_class . '>' . esc_html( $value ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
						echo '</ul>';
					echo '</div>';

					$step = isset( $_GET['step'] ) ? $_GET['step'] : '1'; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					if ( $step ) {
						echo '<div class="litho-import-tab-content">';
						switch ( $step ) {
							case '1':
								echo '<div class="litho-license-box">';
									echo '<div class="litho-license-top-content">';
										echo '<div class="litho-license-left-content">';
											echo '<div class="litho-license-left-top-inner">';
												echo '<img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/white-logo.png' ) . '" alt="' . esc_attr( $litho_theme_name ) . '" />';
												echo '<div class="litho-license-left-right-inner">';
														echo '<span>' . sprintf( esc_html__( 'Thanks for using %s theme', 'litho' ), esc_html( $litho_theme_name ) ) . '</span>';
														if ( $is_theme_license_active ) {
															echo '<p>' . sprintf( esc_html__( 'Awesome! Your %1$s theme license is already activated. Enjoy premium features of %2$s.', 'litho' ), esc_html( $litho_theme_name ), esc_html( $litho_theme_name ) ) . '</p>';
														} else {
															echo '<p>' . sprintf( esc_html__( 'Please enter your %s theme purchase code and activate theme license to enjoy premium features.', 'litho' ), esc_html( $litho_theme_name ) ) . '</p>';
														}
												echo '</div>';

												echo '<div class="litho-license-left-bottom-inner">';
													$response = isset( $_GET['response'] ) ? $_GET['response'] : false;
													$message  = isset( $_GET['msg'] ) ? $_GET['msg'] : '';
													$pcode    = litho_get_encrypt_theme_license();
													echo '<div class="litho-license-form-wrapper">';
														if ( ! $is_theme_license_active ) {
															$register_btn_label = __( 'Activate Now', 'litho' );
															$register_btn_class = ' active';
															$pcode_attr         = '';
														} else {
															$register_btn_label = __( 'Deactivate Now', 'litho' );
															$register_btn_class = ' inactive';
															$pcode_attr         = ' readonly="readonly"';
															echo '<input type="hidden" id="litho_purchase_code_unregister" value="1" />';
														}
														echo '<input type="text" id="litho_purchase_code" class="litho-purchase-code-field' . esc_attr( $register_btn_class ) . '" value="' . esc_attr( $pcode ) . '" placeholder="' . esc_attr__( 'Enter your purchase code...', 'litho' ) . '"' . $pcode_attr . ' />';
														echo '<button type="button" id="litho_license_btn" class="litho-button-license-register">' . esc_html( $register_btn_label ) . '</button>';

														if ( isset( $_GET['token'] ) && isset( $_GET['response'] ) ) {
															$litho_get_transient = get_transient( 'litho_license_token' );
															if ( $_GET['token'] == $litho_get_transient ) {
																if ( 'true' == $_GET['response'] && ! empty( $_GET['pcode'] ) && isset( $_GET['msg'] ) ) {
																	if ( isset( $_GET['unregister'] ) && '1' == $_GET['unregister'] ) {
																		echo '<div id="litho_response_msg" class="license-response-msg license-activated-success"><img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/active.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span>' . esc_attr( $_GET['msg'] ) . '</span></div>';
																		litho_update_theme_license( '' );

																	} else {

																		echo '<div id="litho_response_msg" class="license-response-msg license-activated-success"><img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/active.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span><span>' . esc_attr( $_GET['msg'] ) . '</span></div>';
																		litho_update_theme_license( $_GET['pcode'] );
																	}
																} elseif ( 'false' == $_GET['response'] && isset( $_GET['msg'] ) ) {
																	echo '<div id="litho_response_msg" class="license-response-msg license-activated-failed"><img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/deactivate.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span>' . esc_attr( $_GET['msg'] ) . '</span></div>';

																} elseif ( 'access_denied' == $_GET['response'] && isset( $_GET['msg'] ) ) {
																	echo '<div id="litho_response_msg" class="license-response-msg license-activated-access-denied"><img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/deactivate.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span>' . esc_attr( $_GET['msg'] ) . '</span></div>';
																}
															}
														}
													echo '</div>';
													echo '<div class="find-purchase-code"><img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/how-to-find.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" />' . esc_html__( 'How to find ', 'litho' ) . '<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">' . esc_html__( 'purchase code?', 'litho' ) . '</a></div>';
													echo '<p>' . sprintf( esc_html__( 'Please note that you will need to login to your ThemeForest account from which you have purchased %1$s theme and allow the access to verify your theme purchase. If license is activated already then you can deactivate it also to use the theme in new WP site instead of this one. ', 'litho' ), $litho_theme_name ) . '<a href="' . esc_url( $litho_theme_themeuri ) . '/documentation/" target="_blank">' . esc_html__( 'For more details please check this article.', 'litho' ) . '</a></p>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
										echo '<div class="litho-license-right-content">';
											echo '<h3>' . esc_html__( 'Premium and exclusive features included', 'litho' ) . '</h3>';
											echo '<div class="litho-license-support-content">';
												echo '<ul>';
													$license_content = array(
														esc_html__( 'Lifetime free updates', 'litho' ),
														esc_html__( '6 months of support included', 'litho' ),
														esc_html__( 'Premium plugins at no cost', 'litho' ),
														esc_html__( 'Intuitive and powerful demo data import', 'litho' ),
														esc_html__( 'Over 60 pre-built elements', 'litho' ),
														esc_html__( 'Template library', 'litho' ),
													);
													foreach ( $license_content as $single_content ) {
														echo '<li>';
															echo '<img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/right-icon.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span>' . esc_html( $single_content ) . '</span>';
														echo '</li>';
													}
												echo '</ul>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="litho-purchase-notification-content">';
										echo '<div class="litho-purchase-notification-message">';
											echo '<p>' . esc_html__( 'One standard license can be used for one project (1 live and 1 staging for the same project). Using the one theme license in multiple projects is a copyright violation. If you don\'t have a license or need more for new websites, click on purchase now button.', 'litho' ) . '</p>';
										echo '</div>';
										echo '<div class="litho-purchase-now-button-wrap">';
											echo '<a href="https://1.envato.market/n1NzvX" id="purchase-now-btn" class="litho-purchase-button" target="_blank">' . esc_html__( 'PURCHASE NOW', 'litho' ) . '</a>';
										echo '</div>';
									echo '</div>';
									echo '<div class="litho-license-bottom-content">';
										echo '<ul>';
											echo '<li class="license-documentation">';
												echo '<a href="' . esc_url( $litho_theme_themeuri ) . '/documentation/" target="_blank"><img src="' . esc_url( LITHO_THEME_IMAGES_URI.'/import/online-documentation.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span>' . esc_html__( 'Online documentation', 'litho' ) . '</span></a>';
											echo '</li>';
											echo '<li class="license-support">';
												echo '<a href="' . esc_url( $litho_theme_author ) . '/support/" target="_blank"><img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/support-center.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span>' . esc_html__( 'Support center', 'litho' ) . '</span></a>';
											echo '</li>';
											echo '<li class="license-video">';
												echo '<a href="' . esc_url( $litho_theme_themeuri ) . '/documentation/video-tutorials/" target="_blank"><img src="' . esc_url( LITHO_THEME_IMAGES_URI . '/import/video-tutorials.png' ) . '" alt="' . esc_attr__( 'Icon', 'litho' ) . '" /><span>' . esc_html__( 'Video tutorials', 'litho' ) . '</span></a>';
											echo '</li>';
										echo '</ul>';
									echo '</div>';
								echo '</div>';
								break;
							case '2':
								if ( ! $is_theme_license_active ) {
									echo '<div class="import-content-notices">';
										echo '<div class="import-export-desc import-install-plugins">';
											echo '<h3><i class="ti ti-info-alt"></i>' . esc_html__( 'Important Notice: ', 'litho' ) . '<span>' . esc_html__( 'Theme license must be activated to install theme bundled premium plugins.', 'litho' ) . '</span></h3>';
											if ( ! empty( $_GET['msg'] ) ) {
												echo '<p>' . esc_html( $_GET['msg'] ) . '</p>'; // phpcs:ignore
											}
										echo '</div>';
									echo '</div>';
								}
								do_action( 'litho_theme_setup_plugins' );
								break;
							case '3':
								if ( ! ( is_litho_addons_activated() && $is_theme_license_active ) ) {
									$theme_setup_url   = admin_url( 'themes.php' );
									$theme_license_url = add_query_arg( array( 'page' => 'litho-theme-setup', 'step' => '1' ), $theme_setup_url );
									$plugin_setup_url  = add_query_arg( array( 'page' => 'litho-theme-setup', 'step' => '2' ), $theme_setup_url );

									echo '<div class="import-content-notices">';
										echo '<div class="import-export-desc import-install-plugins">';
											if ( ! $is_theme_license_active ) {
												echo '<h3><i class="ti ti-info-alt"></i>' . esc_html__( 'Important Notice: ', 'litho' ) . '<span>' . sprintf( esc_html__( 'Please %1$s your %2$s theme license and install %3$s plugin to enjoy premium features of import demo data.', 'litho' ), '<a href="' . esc_url( $theme_license_url ) . '">activate</a>', esc_html( $litho_theme_name ), '<a href="' . esc_url( $plugin_setup_url ) . '">' . esc_html__( 'Litho Addons', 'litho' ) . '</a>' ) . '</span></h3>';
											} else {
												echo '<h3><i class="ti ti-info-alt"></i>' . esc_html__( 'Important Notice: ', 'litho' ) . '<span>' . sprintf( esc_html__( 'Please install %s plugin to enjoy premium features of import demo data.', 'litho' ), '<a href="' . esc_url( $plugin_setup_url ) . '">' . esc_html__( 'Litho Addons', 'litho' ) . '</a>' ) . '</span></h3>';
											}
										echo '</div>';
									echo '</div>';
								} else {
									do_action( 'litho_demo_import_callback', $_GET['step'] ); // phpcs:ignore
								}
								break;
							case '4':
								if ( is_woocommerce_activated() ) {
									$wc_setup_url = admin_url( 'admin.php' );
									$wc_setup_url = add_query_arg( array( 'page' => 'wc-admin', 'path' => '/setup-wizard' ), $wc_setup_url );
									echo '<div class="litho-license-box litho-wc-setup-box">';
										echo '<div class="litho-license-top-content">';
											echo '<div class="litho-license-full-content">';
												echo '<div class="litho-license-full-top-inner">';
													echo '<p>' . esc_html__( 'Having a customizable eCommerce platform means that there are a lot of available settings to tweak. The Setup Wizard takes you through all necessary steps to set up your store and get it ready to start selling!', 'litho' ) . '</p>';

													echo '<p>' . esc_html__( 'You can use parts of the wizard, by completing and skipping steps as you like or can setup everything manually also.', 'litho' ) . '</p>';

													echo '<ul>';
														echo '<li>' . esc_html__( 'Use the wizard', 'litho' ) . '</li>';
														echo '<li>' . esc_html__( 'Select \'Not right now\' and set up everything manually', 'litho' ) . '</li>';
														echo '<li>' . esc_html__( 'Use parts of the wizard, by completing and skipping steps as you like.', 'litho' ) . '</li>';
													echo '</ul>';
												echo '</div>';
											echo '</div>';
											echo '<div class="litho-license-full-bottom-content">';
												echo '<a class="litho-button-gradient litho-wc-setup-btn" href="' . esc_url( $wc_setup_url ) .  '">' . esc_html__( 'Setup Wizard', 'litho' ) . '</a>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								}
								break;
						}
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';
		}
		/**
		 * Prevent automatic redirection
		 */
		public function litho_maybe_redirect_to_getting_started() {

			if ( is_woocommerce_activated() ) {
				add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );
			}

			delete_transient( 'elementor_activation_redirect' );

			delete_transient( '_revslider_welcome_screen_activation_redirect' );
		}

		/**
		 * Check Active Theme License
		 */
		public function litho_active_theme_license() {

			if ( ! empty( $_POST['purchase_code'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				// Licence API URL.
				$litho_license_api_url = $this->litho_get_api_url() . '/activate-license/';
				// Redirect license page URL.
				$litho_redirect_url = admin_url( 'themes.php' );
				$litho_redirect_url = add_query_arg( 'page', 'litho-theme-setup', $litho_redirect_url );
				// Site home URL.
				$litho_home_url = esc_url( home_url( '/' ) );
				// Licence token.
				$litho_token = sha1( current_time( 'timestamp' ) . '|' . $this->litho_random_string( 20 ) );

				if ( false === ( $litho_token == get_transient( 'litho_license_token' ) ) ) {
					set_transient( 'litho_license_token', $litho_token, HOUR_IN_SECONDS );
				}
				$litho_get_transient = get_transient( 'litho_license_token' );
				// Item id.
				$litho_item_id = $this->litho_get_item_id();
				// Purchase code.
				$unregister = '';

				if ( ! empty( $_POST['unregister'] ) && '1' == $_POST['unregister'] ) { // phpcs:ignore
					$unregister    = $_POST['unregister']; // phpcs:ignore
					$purchase_code = litho_get_theme_license();
				} else {
					$purchase_code = $_POST['purchase_code'];  // phpcs:ignore
				}
				$api_args = array(
					'code'       => $purchase_code,
					'token'      => $litho_get_transient,
					'url'        => $litho_home_url,
					'itemid'     => $litho_item_id,
					'redirect'   => $litho_redirect_url,
					'unregister' => $unregister,
				);

				$litho_license_api_url = add_query_arg( $api_args, $litho_license_api_url );

				$litho_response = array(
					'status' => true,
					'url'    => $litho_license_api_url,
				);
			} else {
				$litho_response = array(
					'status'  => false,
					'message' => esc_html__( 'Please enter your purchase code.', 'litho' ),
				);
			}

			die( json_encode( $litho_response ) );
		}

		/**
		 * Check Theme License active or not
		 */
		public function litho_check_theme_license() {

			// Purchase code.
			$purchase_code = litho_get_theme_license();

			if ( ! empty( $purchase_code ) ) {

				// Licence API URL.
				$litho_license_api_url = $this->litho_get_api_url() . '/check-license/';
				// Site home URL.
				$litho_home_url = esc_url( home_url( '/' ) );
				// Item id.
				$litho_item_id = $this->litho_get_item_id();
				// API args.
				$api_args = array(
					'code'   => $purchase_code,
					'itemid' => $litho_item_id,
					'url'    => $litho_home_url,
					'random' => rand(),
				);

				$litho_license_api_url = add_query_arg( $api_args, $litho_license_api_url );
				$response              = wp_remote_get( $litho_license_api_url );

				if ( is_array( $response ) && ! is_wp_error( $response ) ) {

					$responseBody = wp_remote_retrieve_body( $response );

					if ( ! empty( $responseBody ) && 'found' == $responseBody ) {

						// Deactivate theme license.
						litho_update_theme_license( '' );

						$args = array(
							'page' => 'litho-theme-setup',
							'step' => '2',
							'msg'  => esc_html__( 'Unfortunately we have deactivated your purchase code, because of purchase code is already being used on another domain.', 'litho' ),
						);

						$redirect_url = add_query_arg( $args, admin_url( 'themes.php' ) );
						wp_redirect( $redirect_url );
						exit;
					}
				}
			}
		}

		/**
		 * Random string generator
		 *
		 * @param int $length Length of character.
		 */
		public function litho_random_string( $length = 20 ) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$len        = strlen( $characters );
			$str        = '';

			for ( $i = 0; $i < $length; $i ++ ) {
				$str .= $characters[ rand( 0, $len - 1 ) ];
			}

			return $str;
		}
		/**
		 * Return Litho Item ID.
		 */
		public function litho_get_item_id() {
			return '33077980';
		}

		/**
		 * Return Litho API URL.
		 */
		public function litho_get_api_url() {
			return 'https://api.themezaa.com/license';
		}

		/**
		 * Redirect to Litho theme setup page after licence activated.
		 */
		public function litho_theme_activate() {
			global $pagenow;

			if ( is_admin() && 'themes.php' == $pagenow ) {

				if ( isset( $_GET['activated'] ) ) { // phpcs:ignore

					wp_redirect( admin_url( 'themes.php?page=litho-theme-setup' ) );
					exit;

				} elseif ( isset( $_GET['page'] ) && 'litho-theme-setup' == $_GET['page'] && isset( $_GET['step'] ) && '2' == $_GET['step'] ) { // phpcs:ignore

					$this->litho_check_theme_license(); // phpcs:ignore
				}
			}
		}

	} // end of class

	$Litho_License_Activation = new Litho_License_Activation();

} // end of class_exists
