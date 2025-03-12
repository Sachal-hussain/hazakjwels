<?php
/**
 * Litho import data.
 *
 * @package Litho
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Import scripts and styles.
add_action( 'admin_enqueue_scripts', 'litho_demo_import_script_style' );

if ( ! function_exists( 'litho_demo_import_script_style' ) ) {
	function litho_demo_import_script_style( $hook ) {

		wp_register_script(
			'litho-import',
			LITHO_ADDONS_ROOT_DIR . '/importer/assets/js/import.js',
			array(
				'jquery',
				'jquery-ui-accordion',
			),
			LITHO_ADDONS_PLUGIN_VERSION,
			true
		);

		// Check Theme Setup page.
		if ( is_admin() && ! empty( $hook ) && $hook == 'appearance_page_litho-theme-setup' ) {

			wp_enqueue_script( 'litho-import' );

			wp_localize_script(
				'litho-import',
				'lithoImport',
				array(
					'full_import_confirmation'   => __( 'Are you sure you want to proceed? It will skip matching items and add new ones.', 'litho-addons' ),
					'single_import_confirmation' => __( 'Are you sure you want to proceed? It will skip matching items and add new ones.', 'litho-addons' ),
					'no_single_layout'           => __( 'Please select at least one item from the list to import.', 'litho-addons' ),
					'delete_media_confirmation'  => __( 'Are you sure you want to remove all media permanently?', 'litho-addons' ),
					'delete_data_confirmation'   => __( 'Are you sure you want to remove all demo data?', 'litho-addons' ),
					'import_data_success_msg'    => esc_html__( 'Demo data has been imported successfully.', 'litho-addons' ),
					'delete_media_success_msg'   => esc_html__( 'Demo media has been deleted successfully.', 'litho-addons' ),
					'delete_data_success_msg'    => esc_html__( 'Demo data has been deleted successfully.', 'litho-addons' ),
				)
			);
		}
	}
}

// Display import demo data functionality in Admin panel > Appereance > Theme Setup.
add_action( 'litho_demo_import_callback', 'litho_demo_import_callback_function' );

if ( ! function_exists( 'litho_demo_import_callback_function' ) ) {
	function litho_demo_import_callback_function( $step ) {

		if ( $step == '3' ) {

			if ( is_theme_license_active() ) {

				/** WXR_Parser class */
				require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser.php';

				/** WXR_Parser_SimpleXML class */
				require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-simplexml.php';

				/** WXR_Parser_XML class */
				require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-xml.php';

				/** WXR_Parser_Regex class */
				require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-regex.php';

				$parser                  = new WXR_Parser();
				$post_array              = array();
				$page_array              = array();
				$portfolio_array         = array();
				$product_array           = array();
				$sectionbuilder_array    = array();
				$elementor_library_array = array();
				$contact_form_array      = array();
				$mailchimp_array         = array();

				$common_posts_xmls = array(
					'posts',
					'pages',
					'elements_features',
					'portfolio',
					'products',
					'elementor_library',
					'section_builder',
					'contact_forms',
					'mailchimp_form',
					'default_kit',
				);

				if ( ! is_woocommerce_activated() ) {
					unset( $common_posts_xmls[4] );
				}

				if ( ! is_elementor_activated() ) {
					unset( $common_posts_xmls[5], $common_posts_xmls[6], $common_posts_xmls[9] );
				}

				if ( ! is_contact_form_7_activated() ) {
					unset( $common_posts_xmls[7] );
				}

				if ( ! is_mailchimp_form_activated() ) {
					unset( $common_posts_xmls[8] );
				}

				if ( ! empty( $common_posts_xmls ) ) {

					foreach ( $common_posts_xmls as $common_posts_xml ) {

						if ( file_exists( dirname( __FILE__ ) . '/sample-data/' . $common_posts_xml . '.xml' ) ) {

							$parsed_xml = $parser->parse( dirname( __FILE__ ) . '/sample-data/' . $common_posts_xml . '.xml' );

							if ( ! empty( $parsed_xml ) && ! empty( $parsed_xml['posts'] ) ) {

								foreach ( $parsed_xml['posts'] as $xml_key => $xml_value ) {

									switch ( $xml_value['post_type'] ) {

										case 'post':
											$id = array( $xml_value['post_id'] );
											$post_array[ $xml_value['post_title'] ] = array( 'id' => $id );
											break;
										case 'page':
											$id   = array( $xml_value['post_id'] );
											$slug = array( $xml_value['post_name'] );

											$page_array[ $xml_value['post_title'] ] = array( 'id' => $id, 'slug' => $slug );
											break;
										case 'portfolio':
											$id = array( $xml_value['post_id'] );
											$portfolio_array[ $xml_value['post_title'] ] = array( 'id' => $id );
											break;
										case 'product':
											if ( is_woocommerce_activated() ) {
												$id   = array( $xml_value['post_id'] );
												$slug = array( $xml_value['post_name'] );

												$product_array[ $xml_value['post_title'] ] = array( 'id' => $id );
											}
											break;
										case 'sectionbuilder':
											$id = array( $xml_value['post_id'] );
											$sectionbuilder_array[ $xml_value['post_title'] ] = array( 'id' => $id );
											break;
										case 'elementor_library':
											$id = array( $xml_value['post_id'] );
											$elementor_library_array[ $xml_value['post_title'] ] = array( 'id' => $id );
											break;
										case 'wpcf7_contact_form':
											$id = array( $xml_value['post_id'] );
											$contact_form_array[ $xml_value['post_title'] ] = array( 'id' => $id );
											break;
										case 'mc4wp-form':
											$mailchimp_array[] = $xml_value['post_id'];
											break;
									}
								}
							}
						}
					}
				}

				echo '<div class="import-content-notices">';
				echo '<div id="import-export-desc" class="import-export-desc">';
				echo '<h3><i class="fa-solid fa-info-circle"></i>' . esc_html__( 'Requirements for demo data import', 'litho-addons' ) . '</h3>';
				$import_notice = array(
					__( 'Memory Limit of 256 MB and max execution time (php time limit) of 180 seconds.', 'litho-addons' ),
					__( 'Elementor and Slider Revolution must be activated for content and sliders to import.', 'litho-addons' ),
					__( 'WooCommerce must be activated for shop data to import.', 'litho-addons' ),
					__( 'Contact Form 7 must be activated for form data to import.', 'litho-addons' ),
					__( 'MailChimp for WordPress must be activated for newsletter form data to import.', 'litho-addons' ),
					__( 'For Import demo data', 'litho-addons' ) . ' <a href="' . LITHO_ADDONS_DEMO_URI . 'documentation/import-all-demo-data-in-one-click/?category=demo-data" target="_blank">' . __( 'please check this article', 'litho-addons' ) . '</a>.',
				);
				echo '<div>';
				echo '<p>' . esc_html__( 'If your server do not have enough speed or configuration as mentioned below then we recommend to import specific demo pages / posts / etc... using individual import option instead of using full import option.', 'litho-addons' ) . '</p>';
				echo '<ul>';
				foreach ( $import_notice as $single_notice ) {
					echo '<li><i class="fa-solid fa-check"></i>' . $single_notice . '</li>'; // phpcs:ignore
				}
				echo '</ul>';
				echo '</div>';
				echo '</div>';
				echo '</div>';

				if ( is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ) {

					echo '<div class="import-content import-content-tab-box"><strong class="litho-active-importer">' . esc_html__( 'Notice: Please deactivate WordPress Importer plugin and then try demo data import to make it run successfully.', 'litho-addons' ) . '</strong></div>';

				} else {

					echo '<div class="import-content-wrap">';
						echo '<ul class="import-inner-content-wrap">';
							echo '<li class="litho-demo">';
								echo '<div class="import-inner-content-wrap">';
									// Full Import Data Button.
									echo '<a data-demo-import="full_data" class="litho-full-import-button import-button litho-import-button-trigger active" href="javascript:void(0);">' . esc_html__( 'Full import', 'litho-addons' ) . '</a>';
									// Single Data Button.
									echo '<a data-demo-import="single_data" class="import-button litho-single-import-button litho-import-button-trigger" href="javascript:void(0);">' . esc_html__( 'Individual Import', 'litho-addons' ) . '</a>';
								echo '</div>';

								// .START Full Import Data Layout
								echo '<div class="import-content-full-wrap hidden active-inner-tab">';
									echo '<div class="import-content-full-inner-wrap">';
										echo '<a class="litho-import-close" href="javascript:void(0);">x</a>';
										echo '<h2>' . esc_html__( 'Full Import - Litho', 'litho-addons' ) . '</h2>';
										echo '<div class="litho-full-import-choice-wrap">';
											echo '<ul class="litho-import-choice-all">';
												echo '<li>';
													echo '<label><input type="checkbox" class="litho-checkbox-all" value="all">' . esc_html__( 'All Content', 'litho-addons' ) . '</label>';
													echo '<span class="description">' . esc_html__( 'This will contain all of your media, posts, pages, portfolios, products, section builder etc...', 'litho-addons' ) . '</span>';
												echo '</li>';
											echo '</ul>';
											echo '<ul class="litho-import-choice">';
												$import_choices = array(
													'posts'             => esc_html__( 'Posts', 'litho-addons' ),
													'pages'             => esc_html__( 'Pages', 'litho-addons' ),
													'elements_features' => esc_html__( 'Elements / Features', 'litho-addons' ),
													'portfolio'         => esc_html__( 'Portfolios', 'litho-addons' ),
													'products'          => esc_html__( 'Products', 'litho-addons' ),
													'elementor_library' => esc_html__( 'Elementor Templates', 'litho-addons' ),
													'section_builder'   => esc_html__( 'Section Builder', 'litho-addons' ),
													'default_kit'       => esc_html__( 'Elementor Site Settings', 'litho-addons' ),
													'navigation_menu'   => esc_html__( 'Navigation Menus', 'litho-addons' ),
													'contact_forms'     => esc_html__( 'Contact Forms', 'litho-addons' ),
													'mailchimp_form'    => esc_html__( 'Mailchimp Form', 'litho-addons' ),
													'customizer'        => esc_html__( 'Theme Options ( Customizer )', 'litho-addons' ),
													'widgets'           => esc_html__( 'Widgets', 'litho-addons' ),
													'media'             => esc_html__( 'Media ( Attachment ) ', 'litho-addons' ),
													'rev_slider'        => esc_html__( 'Slider Revolution', 'litho-addons' ),
												);

												// is active woocommerce.
												if ( ! is_woocommerce_activated() ) {
													unset( $import_choices['products'] );
												}

												// is active elementor.
												if ( ! is_elementor_activated() ) {
													unset( $import_choices['elementor_library'], $import_choices['section_builder'], $import_choices['default_kit'] );
												}

												// is active contact form 7.
												if ( ! is_contact_form_7_activated() ) {
													unset( $import_choices['contact_forms'] );
												}

												// is active mailchimp form.
												if ( ! is_mailchimp_form_activated() ) {
													unset( $import_choices['mailchimp_form'] );
												}

												// is active revolution slider.
												if ( ! is_revolution_slider_activated() ) {
													unset( $import_choices['rev_slider'] );
												}
												foreach ( $import_choices as $key_choice => $value_choice ) {

													echo '<li><label><input type="checkbox" class="litho-checkbox" value="' . esc_attr( $key_choice ) . '" data-label="' . esc_attr( $value_choice ) . '">' . $value_choice . '</label></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												}
											echo '</ul>';
										echo '</div>';

										echo '<div class="import-progress-bar-wrap">';
											echo '<div class="import-progress-bar progress progress-striped">';
												echo '<div role="progressbar progress-striped" class="import-progress-percentage progress-bar"></div>';
												echo '<div class="import-progress-msg"></div>';
											echo '</div>';
										echo '</div>';
										echo '<div class="litho-regenerate-notice">';
											echo '<span>' . esc_html__( 'Now, please install and run', 'litho-addons') . ' <a title="' . esc_attr__( 'Regenerate Thumbnails', 'litho-addons' ) . '" href="' . esc_url( admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472' ) ) . '">' . esc_html__( 'Regenerate Thumbnails', 'litho-addons' ) . '</a> ' . esc_html__( 'plugin once.', 'litho-addons' );
											echo '</span>';
										echo '</div>';

										echo '<div class="import-content-top">';
											echo '<a data-demo-import="full" class="litho-button-gradient litho-import-button litho-demo-import" href="javascript:void(0);">' . esc_html__( 'Import Full', 'litho-addons' ) . '</a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';

								// END Full Import Data Layout.

								// START Individual Data Layout.

								echo '<div class="import-content-single-wrap hidden">';
									echo '<div class="import-content-single-inner-wrap">';
										echo '<a class="litho-import-close" href="javascript:void(0);">x</a>';
										echo '<h2>' . esc_html__( 'Individual Import - Litho', 'litho-addons' ) . '</h2>';

										$single_import_details = array(
											'page'              => esc_html__( 'Pages', 'litho-addons' ),
											'post'              => esc_html__( 'Posts', 'litho-addons' ),
											'portfolio'         => esc_html__( 'Portfolio', 'litho-addons' ),
											'product'           => esc_html__( 'Products', 'litho-addons' ),
											'sectionbuilder'    => esc_html__( 'Section Builder', 'litho-addons' ),
											'elementor_library' => esc_html__( 'Elementor Templates', 'litho-addons' ),
										);

										// is active woocommerce.
										if ( ! is_woocommerce_activated() ) {
											unset( $single_import_details['product'] );
										}

										// is active elementor.
										if ( ! is_elementor_activated() ) {
											unset( $single_import_details['sectionbuilder'], $single_import_details['elementor_library'] );
										}

										echo '<div class="litho-single-import-choice-wrap">';

											foreach ( $single_import_details as $single_details_key => $single_details_value ) {

												echo '<div class="' . esc_attr( $single_details_key ) . '-main">';

													echo '<h3>' . esc_html( $single_details_value ) . '</h3>';

													$main_array = ${ $single_details_key . '_array' };

													if ( ! empty( $main_array ) ) {
														// Sorting alphabetically.
														if (  'product' != $single_details_key ) {
															ksort( $main_array );
														}
														echo '<ul class="litho-single-import-choice-all">';
															echo '<li><label><input type="checkbox" class="litho-single-import-checkbox-all" value="all">' . esc_html__( 'Select all', 'litho-addons' ) . '</label>';
															echo '</li>';
														echo '</ul>';
														echo '<ul class="litho-single-' . esc_attr( $single_details_key ) . '-import-choice litho-common-single-checkbox-wrap">';
															foreach ( $main_array as $main_key => $main_value ) {
																$single_id   = ! empty( $main_value['id'] ) ? implode( ',', $main_value['id'] ) : '';
																$single_slug = ! empty( $main_value['slug'] ) ? implode( ',', $main_value['slug'] ) : '';
																echo '<li>';
																	echo '<label><input type="checkbox" class="litho-single-checkbox" value="' . esc_attr( $single_id ) . '"><span>' . esc_html( $main_key ) . '</span></label>';
																	if ( 'page' === $single_details_key ) {
																		$current_url = LITHO_ADDONS_DEMO_URI . $single_slug;
																		echo '<a href="' . esc_url( $current_url ) . '" target="_blank"><i class="fa-solid fa-external-link-alt"></i></a>';
																	}
																echo '</li>';
															}
														echo '</ul>';
													}
												echo '</div>';
											}
										echo '</div>';

										echo '<div class="import-progress-bar-wrap">';
											echo '<div class="import-progress-bar progress progress-striped">';
												echo '<div role="progressbar progress-striped" class="import-progress-percentage progress-bar"></div>';
												echo '<div class="import-progress-msg"></div>';
											echo '</div>';
										echo '</div>';

										echo '<div class="litho-regenerate-notice">';
											echo '<span>' . esc_html__( 'Now, please install and run', 'litho-addons') . ' <a title="' . esc_attr__( 'Regenerate Thumbnails', 'litho-addons' ) . '" href="' . esc_url( admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472' ) ) . '">' . esc_html__( 'Regenerate Thumbnails', 'litho-addons' ) . '</a> ' . esc_html__( 'plugin once.', 'litho-addons' );
											echo '</span>';
										echo '</div>';

										echo '<div class="import-content-top">';
											echo '<a data-demo-import="import-single" id="litho-single-demo-import" class="litho-button-gradient litho-demo-import" href="javascript:void(0);">' . esc_html__( 'Import Selected Items', 'litho-addons' ) . '</a>';
										echo '</div>';

									echo '</div>';
								echo '</div>';
								// END Individual Data Layout.
							echo '</li>';
						echo '</ul>';
						echo '<div class="litho-data-delete-wrap">';
							echo '<div class="litho-data-delete-msg"></div>';
							echo '<div class="litho-data-delete-inner">';
								echo '<div class="delete-demo-media-wrap">';
									echo '<span>' . esc_html__( 'Please note that this action will remove all the demo placeholder images, which are imported in your WP setup. Are you sure to proceed?', 'litho-addons' ) . '</span>';

									echo '<div class="delete-btn-wrap">';
										echo '<a data-delete-key="media" class="litho-button-danger litho-demo-delete" href="javascript:void(0);">' . esc_html__( 'Delete Demo Media', 'litho-addons' ) . '</a>';
									echo '</div>';
								echo '</div>';
								echo '<div class="delete-demo-data-wrap">';
									echo '<span>' . esc_html__( 'Please note that this action will remove all the demo posts, pages, portfolios, media and forms, which are imported in your WP setup and no matter if those are changed or not by you. Are you sure to proceed?', 'litho-addons' ) . '</span>';
									echo '<div class="delete-btn-wrap">';
										echo '<a data-delete-key="data" class="litho-button-danger litho-demo-delete" href="javascript:void(0);">' . esc_html__( 'Delete Demo Data', 'litho-addons' ) . '</a>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		}
	}
}

// Don't resize images for import.
if ( ! function_exists( 'litho_no_image_resize' ) ) :
	function litho_no_image_resize( $sizes ) {
		return array();
	}
endif;

// Hook For Import Sample Data And Log Messages.
add_action( 'wp_ajax_litho_import_sample_data', 'litho_import_sample_data' );
add_action( 'wp_ajax_litho_refresh_import_log', 'litho_refresh_import_log' );

if ( ! function_exists( 'litho_import_sample_data' ) ) {
	function litho_import_sample_data() {
		global $wpdb;

		if ( current_user_can( 'manage_options' ) && is_theme_license_active() && ! is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ) {

			/* Load WP Importer */
			if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) { 
				define( 'WP_LOAD_IMPORTERS', true );
			}

			/* Check if main importer class doesn't exist */
			if ( ! class_exists( 'WP_Importer' ) ) {

				$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				include $wp_importer;
			}

			// if WP importer doesn't exist.
			if ( ! class_exists( 'WP_Import' ) ) {

				$wp_import = LITHO_ADDONS_IMPORT . '/wordpress-importer.php';
				include $wp_import;
			}

			// check for main import class and wp import class.
			// setup_key means full or individual import.
			if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {

				// Import demo data.
				if ( ! empty( $_POST['setup_key'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing

					$setup_key          = $_POST['setup_key']; // phpcs:ignore WordPress.Security.NonceVerification.Missing
					$import_options     = ! empty( $_POST['import_options'] ) ? $_POST['import_options'] : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
					$full_import_option = ! empty( $_POST['full_import_options'] ) ? $_POST['full_import_options'] : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

					add_filter( 'intermediate_image_sizes_advanced', 'litho_no_image_resize' );

					// Import Full data like ( Media, Posts, Pages, Portfolios, Products, Navigation menu, Mega menu, Section builder, Contact Forms, Mailchimp Forms )
					if ( 'full' == $setup_key && ! empty( $full_import_option ) ) {

						$post_xml_keys = array(
							'posts',
							'pages',
							'elements_features',
							'portfolio',
							'products',
							'media',
							'section_builder',
							'elementor_library',
							'mega_menu',
							'navigation_menu',
							'contact_forms',
							'mailchimp_form',
							'default_kit',
						);

						if ( in_array( $full_import_option, $post_xml_keys ) ) {

							$sample_data_xml = dirname( __FILE__ ) . '/sample-data/' . $full_import_option . '.xml';

							if ( file_exists( $sample_data_xml ) ) {

								// Delete old imported menu post data.
								if ( 'navigation_menu' == $full_import_option ) {
									$post_data = $wpdb->get_results( "SELECT * FROM `" . $wpdb->postmeta . "` WHERE meta_key='" . $wpdb->escape( '_litho_menu_import_data' ) . "' AND meta_value='1'" );
									if ( ! empty( $post_data ) ) {
										foreach ( $post_data as $key => $value ) {
											if ( ! empty( $value ) && ! empty( $value->post_id ) ) {
												wp_delete_post( $value->post_id );
											}
										}
									}
								}

								// Import Sample Data XML.
								$importer = new WP_Import();

								// Import Posts, Pages, Portfolio Content, Images, Menus.
								$importer->import_menu       = true;
								$importer->fetch_attachments = true;

								// Import Woocommerce data if WooCommerce plugin is activated and selected option from full import.
								if ( is_woocommerce_activated() && 'products' == $full_import_option ) {

									// Before Import Sample Data Add Woocommerce Attribute.
									$transient_name           = 'wc_attribute_taxonomies';
									$old_attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );

									if ( empty( $old_attribute_taxonomies ) ) {

										litho_import_log( 'MESSAGE - WooCommerce Before Import Sample Data Add Woocommerce Attributes Start.' );

										require_once dirname( __FILE__ ) . '/class-woocommerce-attribute-taxonomies.php';

										$attribute_taxonomies_data = new Litho_Set_Attribute_Taxonomies();

										$getresultdata = $attribute_taxonomies_data->add_woocommerce_attribute_taxonomies();

										litho_import_log( 'MESSAGE - WooCommerce Before Import Sample Data Add Woocommerce Attributes End.' );
									}

									// For Variation Products.
									$variation_sample_data_xml = dirname( __FILE__ ) . '/sample-data/' . $full_import_option . '-variation.xml';

									if ( file_exists( $variation_sample_data_xml ) ) {

										ob_start();
										litho_import_log( 'MESSAGE - Variation ' . ucfirst( $full_import_option ) . '.xml Import Start.' );

										$importer->import( $variation_sample_data_xml );

										ob_end_clean();
										litho_import_log( 'MESSAGE - Variation ' . ucfirst( $full_import_option ) . '.xml Import End' );
									}

									global $wpdb;

									$variation_product_ids = $wpdb->get_col( "SELECT DISTINCT p.post_parent FROM {$wpdb->prefix}posts p INNER JOIN {$wpdb->prefix}postmeta as pm ON p.ID = pm.post_id WHERE p.post_parent > 0 AND p.post_type LIKE 'product_variation' AND pm.meta_key = '_litho_demo_import_data' AND pm.meta_value = '1'" );

									if ( ! empty( $variation_product_ids ) ) {

										foreach ( $variation_product_ids as $variation_product_id ) {

											update_post_meta( $variation_product_id, '_stock_status', 'instock' );
										}
									}
								}

								// For Privacy policy page trash.
								if ( 'pages' == $full_import_option ) {

									$default_pp_page_id = get_option( 'wp_page_for_privacy_policy' );
									$theme_pp_page_meta = get_post_meta( $default_pp_page_id, '_litho_demo_import_data', true );

									if ( ! $theme_pp_page_meta ) {

										$privacy_policy = get_page_by_path( 'privacy-policy' );

										if ( ! empty( $default_pp_page_id ) && $default_pp_page_id == $privacy_policy->ID ) {

											wp_trash_post( $default_pp_page_id );
										}

										// Privacy Policy page assign in woocommerce setting.
										if ( ! empty( $privacy_policy ) && ! empty( $privacy_policy->ID ) ) {

											update_option( 'wp_page_for_privacy_policy', $privacy_policy->ID );
										}
									}
								}

								ob_start();

								litho_import_log( 'MESSAGE - ' . ucfirst( $full_import_option ) . '.xml Import Start.' );

									$importer->import( $sample_data_xml );

								ob_end_clean();
								litho_import_log( 'MESSAGE - ' . ucfirst( $full_import_option ) . '.xml Import End' );

								/*
								 * Active Site Setting Kit
								 */
								if ( 'default_kit' == $full_import_option ) {

									// Remove Exist Site Setting.
									delete_option( 'elementor_active_kit' );

									$default_kit_query = new WP_Query(
										array(
											'post_type'              => 'elementor_library',
											'title'                  => 'Litho Default Kit',
											'post_status'            => 'publish',
											'posts_per_page'         => 1,
											'no_found_rows'          => true,
											'ignore_sticky_posts'    => true,
											'update_post_term_cache' => false,
											'update_post_meta_cache' => false,
											'orderby'                => 'post_date ID',
											'order'                  => 'ASC',
										)
									);
									 
									if ( ! empty( $default_kit_query->post ) ) {
										$litho_default_kit = $default_kit_query->post;
									} else {
										$litho_default_kit = null;
									}

									if ( isset( $litho_default_kit ) && $litho_default_kit->ID ) {

										if ( get_option( 'elementor_active_kit' ) !== false ) {
											update_option( 'elementor_active_kit', $litho_default_kit->ID );
										} else {
											$autoload = 'no';
											add_option( 'elementor_active_kit', $litho_default_kit->ID, '', $autoload );
										}
									}
								}

								/*
								 * Active Site Setting Kit.
								 */

								// Set Woocommerce Default Pages.
								if ( is_woocommerce_activated() && 'pages' == $full_import_option ) {

									litho_import_log( 'MESSAGE - Import WooCommerce Pages Setting Start.' );

									$woopages = array(
										'woocommerce_shop_page_id'            => 'shop',
										'woocommerce_cart_page_id'            => 'cart',
										'woocommerce_checkout_page_id'        => 'checkout',
										'woocommerce_myaccount_page_id'       => 'my account',
										'woocommerce_lost_password_page_id'   => 'lost-password',
										'woocommerce_edit_address_page_id'    => 'edit-address',
										'woocommerce_view_order_page_id'      => 'view-order',
										'woocommerce_change_password_page_id' => 'change-password',
										'woocommerce_logout_page_id'          => 'logout',
										'woocommerce_pay_page_id'             => 'pay',
										'woocommerce_thanks_page_id'          => 'order-received',
										'woocommerce_wishlist_page_id'        => 'wishlist',
									);

									foreach ( $woopages as $woo_page_name => $woo_page_title ) {
										$woo_page_query = new WP_Query(
											array(
												'post_type'              => 'page',
												'title'                  => $woo_page_title,
												'post_status'            => 'publish',
												'posts_per_page'         => 12,
												'no_found_rows'          => true,
												'ignore_sticky_posts'    => true,
												'update_post_term_cache' => false,
												'update_post_meta_cache' => false,
												'orderby'                => 'post_date ID',
												'order'                  => 'ASC',
											)
										);
										 
										if ( ! empty( $woo_page_query->post ) ) {
											$woopage = $woo_page_query->post;
										} else {
											$woopage = null;
										}

										if ( isset( $woopage ) && $woopage->ID ) {
											update_option( $woo_page_name, $woopage->ID );
										}
									}

									litho_import_log( 'MESSAGE - Import WooCommerce Pages Setting End.' );

									// We no longer need to install pages.
									delete_option( '_wc_needs_pages' );
								}

								// For Mega menu Menu.
								$sample_mega_menu_data_xml = dirname( __FILE__ ) . '/sample-data/mega_menu.xml';

								if ( 'navigation_menu' == $full_import_option && file_exists( $sample_mega_menu_data_xml ) ) {

									$importer->import( $sample_mega_menu_data_xml );
								}

								// Registered menu locations in theme.
								if ( 'navigation_menu' == $full_import_option  ) {

									$locations = get_theme_mod( 'nav_menu_locations' );

									// registered menus.
									$menus = wp_get_nav_menus();
									litho_import_log( __( 'MESSAGE - Import Menu Location Start.', 'litho-addons' ) );
									// Assign menus to theme locations.
									if ( $menus ) {
										foreach ( $menus as $menu ) {
											if ( $menu->name == 'Main Menu' ) {
												$locations['primary-menu'] = $menu->term_id;
											}
										}
									}

									// set menus to locations.
									set_theme_mod( 'nav_menu_locations', $locations );
									litho_import_log( __( 'MESSAGE - Import Menu Location End.', 'litho-addons' ) );
								}

								litho_update_elementor_default_features();
								litho_update_elementor_replace_urls();
							}

							// Flush rules after install.
							flush_rewrite_rules();

						} elseif ( 'customizer' == $full_import_option ) {

							// Import Theme Customize file.
							$theme_options_file = dirname( __FILE__ ) . '/sample-data/theme_settings.json';

							if ( file_exists( $theme_options_file ) ) {

								$remove_options = get_theme_mods();

								if ( ! empty( $remove_options ) && ! is_array( $remove_options ) ) {

									$remove_options = json_decode( $remove_options );
								}
								litho_import_log( __( 'MESSAGE - Before Import Customize Clear All Customize Settings Start.', 'litho-addons' ) );
								if ( ! empty( $remove_options ) ) {
									foreach ( $remove_options as $key => $value ) {

										remove_theme_mod( $key );
									}
								}
								litho_import_log( __( 'MESSAGE - Before Import Customize Clear All Customize Settings End.', 'litho-addons' ) );

								// Save new settings.
								litho_import_log( __( 'MESSAGE - Import Customize Setting Start.', 'litho-addons' ) );
								$encode_options = file_get_contents( $theme_options_file );

								$options = json_decode( $encode_options, true );
								if ( ! empty( $options ) ) {
									foreach ( $options as $key => $value ) {

										set_theme_mod( $key, $value );
									}
								}
								litho_import_log( __( 'MESSAGE - Import Customize Setting End.', 'litho-addons' ) );

								// when customizer import, menu id can't change.
								$locations = get_theme_mod( 'nav_menu_locations' );

								// registered menus.
								$menus = wp_get_nav_menus();
								// assign menus to theme locations.
								if ( $menus ) {
									foreach ( $menus as $menu ) {
										if ( $menu->name == 'Main Menu' ) {
											$locations['primary-menu'] = $menu->term_id;
										}
									}
								}
								// set menus to locations.
								set_theme_mod( 'nav_menu_locations', $locations );

								// reading settings.
								$homepage_query = new WP_Query(
									array(
										'post_type'              => 'page',
										'title'                  => 'Home startup',
										'post_status'            => 'publish',
										'posts_per_page'         => 1,
										'no_found_rows'          => true,
										'ignore_sticky_posts'    => true,
										'update_post_term_cache' => false,
										'update_post_meta_cache' => false,
										'orderby'                => 'post_date ID',
										'order'                  => 'ASC',
									)
								);

								if ( ! empty( $homepage_query->post ) ) {
									$homepage = $homepage_query->post;
								} else {
									$homepage = null;
								}

								if ( isset( $homepage ) && $homepage->ID ) {
									litho_import_log( __( 'MESSAGE - Set Static Homepage Start.', 'litho-addons' ) );
									update_option( 'show_on_front', 'page' );
									update_option( 'page_on_front', $homepage->ID ); // Front Page.
									litho_import_log( __( 'MESSAGE - Set Static Homepage End.', 'litho-addons' ) );

								} else {
									litho_import_log( __( 'NOTICE - Static Homepage Couldn\'t Be Set.', 'litho-addons' ) );
								}
							}
						} elseif ( 'widgets' == $full_import_option ) {

							// Sidebar Widgets Json File.
							$widgets_file = dirname( __FILE__ ) . '/sample-data/widget_data.json';

							if ( file_exists( $widgets_file ) ) {

								// Add data to widgets
								litho_import_log( __( 'MESSAGE - Before Import Widget Clear All Widgetarea Start.', 'litho-addons' ) );
								$sidebars = wp_get_sidebars_widgets();

								unset( $sidebars['wp_inactive_widgets'] );

								foreach ( $sidebars as $sidebar => $widgets ) {

									$sidebars[ $sidebar ] = array();
								}

								$sidebars['wp_inactive_widgets'] = array();
								wp_set_sidebars_widgets( $sidebars );
								litho_import_log( __( 'MESSAGE - Before Import Widget Clear All Widgetarea End.', 'litho-addons' ) );

								$widget_data = file_get_contents( $widgets_file );
								litho_import_log( __( 'MESSAGE - Import Widget Setting Start.', 'litho-addons' ) );
								$import_widgets = litho_import_widget_sample_data( $widget_data );
							}
						} elseif ( 'rev_slider' == $full_import_option ) { // Import Revolution sliders.

							// Import Revslider.
							if ( is_revolution_slider_activated() ) {

								$rev_directory = dirname( __FILE__ ) . '/sample-data/revsliders/';
								// if revslider is activated.
								$rev_files = litho_get_zip_import_files( $rev_directory, 'zip' );

								$slider = new RevSlider();
								litho_import_log( __( 'MESSAGE - Import Revslider Start.', 'litho-addons' ) );
								foreach ( $rev_files as $rev_file ) {

									// finally import rev slider data files.
									$filepath = $rev_file;
									ob_start();
										$slider->importSliderFromPost( true, false, $filepath );
									ob_clean();
									ob_end_clean();
								}
								litho_import_log( __( 'MESSAGE - Import Revslider End.', 'litho-addons' ) );
							}
						}
					}

					// Import single ( Posts, Pages, Portfolio, Products, Section Builders, Elementor Library ).
					if ( 'import-single' == $setup_key && ! empty( $import_options ) && is_array( $import_options ) ) {

						// Import Sample Data XML.
						$importer = new WP_Import();

						// Fetch attachment.
						$importer->fetch_attachments = true;

						// Do not import menu.
						$importer->import_menu = false;

						ob_start();
						litho_import_log( __( 'MESSAGE - Import Single Layout Item Start.', 'litho-addons' ) );

						foreach ( $import_options as $import_option ) {

							foreach ( $import_option as $single_key => $single_key_ids ) {

								$single_key_ids = explode( ',', $single_key_ids );

								// Import Woocommerce data if WooCommerce plugin is activated and selected option from full import.
								if ( is_woocommerce_activated() && 'products' == $single_key ) {

									// Before Import Sample Data Add Woocommerce Attribute.
									$transient_name           = 'wc_attribute_taxonomies';
									$old_attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );

									if ( empty( $old_attribute_taxonomies ) ) {

										litho_import_log( 'MESSAGE - WooCommerce Before Import Sample Data Add Woocommerce Attributes Start.' );

										require_once dirname( __FILE__ ) . '/class-woocommerce-attribute-taxonomies.php';

										$attribute_taxonomies_data = new Litho_Set_Attribute_Taxonomies();

										$getresultdata = $attribute_taxonomies_data->add_woocommerce_attribute_taxonomies();

										litho_import_log( 'MESSAGE - WooCommerce Before Import Sample Data Add Woocommerce Attributes End.' );
									}

									// For Variation Products.
									$variation_sample_data_xml = dirname( __FILE__ ) . '/sample-data/' . $single_key . '-variation.xml';

									if ( file_exists( $variation_sample_data_xml ) ) {

										ob_start();
										litho_import_log( 'MESSAGE - Variation ' . ucfirst( $single_key ) . '.xml Import Start.' );

										$importer->import( $variation_sample_data_xml );

										ob_end_clean();
										litho_import_log( 'MESSAGE - Variation ' . ucfirst( $single_key ) . '.xml Import End' );
									}

									global $wpdb;

									$variation_product_ids = $wpdb->get_col( "SELECT DISTINCT p.post_parent FROM {$wpdb->prefix}posts p INNER JOIN {$wpdb->prefix}postmeta as pm ON p.ID = pm.post_id WHERE p.post_parent > 0 AND p.post_type LIKE 'product_variation' AND pm.meta_key = '_litho_demo_import_data' AND pm.meta_value = '1'" );

									if ( ! empty( $variation_product_ids ) ) {

										foreach ( $variation_product_ids as $variation_product_id ) {

											update_post_meta( $variation_product_id, '_stock_status', 'instock' );
										}
									}
								}

								if ( 'pages' == $single_key ) {

									$sample_data_xml              = dirname( __FILE__ ) . '/sample-data/' . $single_key . '.xml';
									$elements_features_sample_xml = dirname( __FILE__ ) . '/sample-data/elements_features.xml';

									if ( file_exists( $sample_data_xml ) ) {

										$importer->import( $sample_data_xml, $single_key_ids );
									}

									if ( 'pages' == $single_key && file_exists( $elements_features_sample_xml ) ) {

										$importer->import( $elements_features_sample_xml, $single_key_ids );
									}
								} else {

									$sample_data_xml = dirname( __FILE__ ) . '/sample-data/' . $single_key . '.xml';

									if ( file_exists( $sample_data_xml ) ) {
										$importer->import( $sample_data_xml, $single_key_ids );
									}
								}
							}
						}

						// For attachment.
						$media_xml = dirname( __FILE__ ) . '/sample-data/media.xml';

						if ( file_exists( $media_xml ) ) {
							litho_import_log( __( 'MESSAGE - Import Media Item Start.', 'litho-addons' ) );
							$importer->import( $media_xml );
							litho_import_log( __( 'MESSAGE - Import Media Item End.', 'litho-addons' ) );
						}

						litho_import_log( __( 'MESSAGE - Import Single Layout Item End.', 'litho-addons' ) );
						ob_end_clean();

						litho_update_elementor_default_features();
						litho_update_elementor_replace_urls();
					}
				}
			}
		}
		die();
	}
}

// For More Info Check Widget Import Plugin ( http://wordpress.org/plugins/widget-settings-importexport/ ).
if ( ! function_exists( 'litho_import_widget_sample_data' ) ) {
	function litho_import_widget_sample_data( $widget_data ) {

		$json_data    = json_decode( $widget_data, true );
		$sidebar_data = $json_data[0];
		$widget_data  = $json_data[1];

		if ( ! empty( $widget_data ) ) {

			foreach ( $widget_data as $widget_title => $widget_value ) {
				foreach ( $widget_value as $widget_key => $widget_value ) {

					$widgets[ $widget_title ][ $widget_key ] = $widget_data[ $widget_title ][ $widget_key ];
				}
			}
		}

		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
		litho_parse_import_widget_sample_data( $sidebar_data );
	}
}

if ( ! function_exists( 'litho_parse_import_widget_sample_data' ) ) {
	function litho_parse_import_widget_sample_data( $import_array ) {

		global $wp_registered_sidebars;

		$sidebars_data    = $import_array[0];
		$widget_data      = $import_array[1];
		$current_sidebars = get_option( 'sidebars_widgets' );
		$new_widgets      = array();

		if ( ! empty( $sidebars_data ) ) {

			foreach ( $sidebars_data as $import_sidebar => $import_widgets ) {

				foreach ( $import_widgets as $import_widget ) {

					// if the sidebar exists.
					if ( isset( $wp_registered_sidebars[ $import_sidebar ] ) ) {

						$title               = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
						$index               = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
						$current_widget_data = get_option( 'widget_' . $title );
						$new_widget_name     = litho_get_new_widget_name( $title, $index );
						$new_index           = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

						if ( ! empty( $new_widgets[ $title ] ) && is_array( $new_widgets[ $title ] ) ) {

							while ( array_key_exists( $new_index, $new_widgets[ $title ] ) ) {

								$new_index++;
							}
						}
						$current_sidebars[ $import_sidebar ][] = $title . '-' . $new_index;
						if ( array_key_exists( $title, $new_widgets ) ) {

							$new_widgets[ $title ][ $new_index ] = $widget_data[ $title ][ $index ];
							$multiwidget                         = $new_widgets[ $title ]['_multiwidget'];
							unset( $new_widgets[ $title ]['_multiwidget'] );
							$new_widgets[ $title ]['_multiwidget'] = $multiwidget;

						} else {

							$current_widget_data[ $new_index ] = $widget_data[ $title ][ $index ];
							$current_multiwidget               = isset( $current_widget_data['_multiwidget'] ) ? $current_widget_data['_multiwidget'] : false;
							$new_multiwidget                   = isset( $widget_data[ $title ]['_multiwidget'] ) ? $widget_data[ $title ]['_multiwidget'] : false;
							$multiwidget                       = ( $current_multiwidget != $new_multiwidget ) ? $current_multiwidget : 1;
							unset( $current_widget_data['_multiwidget'] );
							$current_widget_data['_multiwidget'] = $multiwidget;
							$new_widgets[ $title ]               = $current_widget_data;
						}
					}
				}
			}
		}

		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );

			foreach ( $new_widgets as $title => $content ) {
				update_option( 'widget_' . $title, $content );
			}
			litho_import_log( __( 'MESSAGE - Import Widget Setting End.', 'litho-addons' ) );
			return true;
		}
		litho_import_log( __( 'NOTICE - Import Widget Setting Not Completed.', 'litho-addons' ) );
		return false;
	}
}

if ( ! function_exists( 'litho_get_new_widget_name' ) ) {
	function litho_get_new_widget_name( $widget_name, $widget_index ) {

		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array();
		foreach ( $current_sidebars as $sidebar => $widgets ) {

			if ( ! empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {

					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {

			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}
}

if ( ! function_exists( 'litho_get_zip_import_files' ) ) {
	function litho_get_zip_import_files( $directory, $filetype ) {

		$phpversion = phpversion();
		$files      = array();

		// Check if the php version allows for recursive iterators.
		if ( version_compare( $phpversion, '5.2.11', '>' ) ) {

			if ( $filetype != '*' ) {
				$filetype = '/^.*\.' . $filetype . '$/';
			} else {
				$filetype = '/.+\.[^.]+$/';
			}
			$directory_iterator = new RecursiveDirectoryIterator( $directory );
			$recusive_iterator  = new RecursiveIteratorIterator( $directory_iterator );
			$regex_iterator     = new RegexIterator( $recusive_iterator, $filetype );

			foreach ( $regex_iterator as $file ) {

				$files[] = $file->getPathname();
			}
			// Fallback to glob() for older php versions.
		} else {

			if ( $filetype != '*' ) {
				$filetype = '*.' . $filetype;
			}

			foreach ( glob( $directory . $filetype ) as $filename ) {

				$filename = basename( $filename );
				$files[]  = $directory . $filename;
			}
		}
		return $files;
	}
}

// Function To Add Litho Import Log.
if ( ! function_exists( 'litho_import_log' ) ) {
	function litho_import_log( $message, $append = true ) {

		$upload_dir = wp_upload_dir();
		if ( isset( $upload_dir['baseurl'] ) ) {

			$data = '';
			if ( ! empty( $message ) ) {
				$data = '<p>' . date( 'Y-m-d H:i:s' ) . ' - ' . $message . '</p>';
			}

			if ( true === $append ) {

				file_put_contents( $upload_dir['basedir'] . '/importer.log', $data, FILE_APPEND );
				file_put_contents( $upload_dir['basedir'] . '/importer-full.log', $data, FILE_APPEND );

			} else {

				file_put_contents( $upload_dir['basedir'] . '/importer.log', $data );
			}
		}
	}
}

// Function To Get litho Import Log.
if ( ! function_exists( 'get_litho_import_log' ) ) {
	function get_litho_import_log() {

		$upload_dir = wp_upload_dir();
		if ( isset( $upload_dir['baseurl'] ) ) {

			if ( file_exists( $upload_dir['basedir'] . '/importer.log' ) ) {

				return file_get_contents( $upload_dir['basedir'] . '/importer.log' );
			}
		}
		return '';
	}
}

// Ajax Function To Check Refresh Import Logs.
if ( ! function_exists( 'litho_refresh_import_log' ) ) {
	function litho_refresh_import_log() {
		$check_litho_log = get_litho_import_log();
		// Don't add message if ERROR was found, JS script is going to stop refreshing.
		if ( strpos( $check_litho_log, 'ERROR' ) === false ) {

			litho_import_log( __( 'MESSAGE - Import in progress...', 'litho-addons' ) );
		}
		$printlog = get_litho_import_log();
		echo $printlog; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		die();
	}
}

// Delete demo data and demo media.
add_action( 'wp_ajax_litho_delete_sample_data', 'litho_delete_sample_data' );
if ( ! function_exists( 'litho_delete_sample_data' ) ) {
	function litho_delete_sample_data() {

		// Delete Import demo data.
		if ( ! empty( $_POST['delete_key'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing

			global $wpdb;

			$delete_key = $_POST['delete_key']; // phpcs:ignore WordPress.Security.NonceVerification.Missing

			if ( 'media' == $delete_key ) { // Delete import media ( attachment ).
				$query = "SELECT p.ID FROM $wpdb->posts p INNER JOIN $wpdb->postmeta pm WHERE p.ID = pm.post_id AND pm.meta_key = '_litho_demo_import_data' AND pm.meta_value = 1 AND p.post_type = 'attachment'";
				$attachment_ids = $wpdb->get_col( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

				if ( ! empty( $attachment_ids ) ) {
					foreach ( $attachment_ids as $attachment_id ) {
						wp_delete_post( $attachment_id );
					}
				}
			} elseif ( 'data' == $delete_key ) { // Delete imported media, posts, pages, portfolio, categories, terms, etc...

				// Delete import media ( attachment )
				$query = "SELECT p.ID FROM $wpdb->posts p INNER JOIN $wpdb->postmeta pm WHERE p.ID = pm.post_id AND pm.meta_key = '_litho_demo_import_data' AND pm.meta_value = 1 AND p.post_type = 'attachment'";
				$attachment_ids = $wpdb->get_col( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

				if ( ! empty( $attachment_ids ) ) {
					foreach ( $attachment_ids as $attachment_id ) {
						wp_delete_post( $attachment_id );
					}
				}

				// For Term data.
				$term_data = $wpdb->get_results( "SELECT * FROM `" . $wpdb->termmeta . "` WHERE meta_key='" . $wpdb->escape( '_litho_demo_import_data' ) . "' AND meta_value='1'" );
				if ( ! empty( $term_data ) ) {
					foreach ( $term_data as $key => $value ) {
						if ( ! empty( $value ) && ! empty( $value->term_id ) ) {
							wp_delete_term( $value->term_id, 'category' );
							wp_delete_term( $value->term_id, 'post_tag' );
							wp_delete_term( $value->term_id, 'portfolio-category' );
							wp_delete_term( $value->term_id, 'portfolio-tags' );

							if ( is_woocommerce_activated() ) {
								wp_delete_term( $value->term_id, 'product_cat' );
								wp_delete_term( $value->term_id, 'product_tag' );
								wp_delete_term( $value->term_id, 'pa_color' );
								wp_delete_term( $value->term_id, 'pa_size' );
							}
						}
					}
				}

				// For Post data.
				$post_data = $wpdb->get_results( "SELECT * FROM `" . $wpdb->postmeta . "` WHERE meta_key='" . $wpdb->escape( '_litho_demo_import_data' ) . "' AND meta_value='1'" );
				if ( ! empty( $post_data ) ) {
					foreach ( $post_data as $key => $value ) {
						if ( ! empty( $value ) && ! empty( $value->post_id ) ) {
							wp_delete_post( $value->post_id );
						}
					}
				}
			}
			die();
		}
	}
}

/* Replace URls with Old urls */
if ( ! function_exists( 'litho_update_elementor_replace_urls' ) ) {
	function litho_update_elementor_replace_urls() {

		global $wpdb;

		$from = rtrim( LITHO_ADDONS_DEMO_URI , '/' );
		$to   = rtrim( site_url() , '/' );

		litho_import_log( __( 'MESSAGE - Import Replace URLs Item Start.', 'litho-addons' ) );

		// @codingStandardsIgnoreStart cannot use `$wpdb->prepare` because it remove's the backslashes
		$rows_affected1 = $wpdb->query(
			"UPDATE {$wpdb->postmeta} " .
			"SET `meta_value` = REPLACE(`meta_value`, '" . $from . "', '" .  $to . "') " .
			"WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE '[%' ;" );
		// @codingStandardsIgnoreEnd

		// @codingStandardsIgnoreStart cannot use `$wpdb->prepare` because it remove's the backslashes
		$rows_affected2 = $wpdb->query(
			"UPDATE {$wpdb->postmeta} " .
			"SET `meta_value` = REPLACE(`meta_value`, '" . str_replace( '/', '\\\/', $from ) . "', '" . str_replace( '/', '\\\/', $to ) . "') " .
			"WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE '[%' ;" );
		// @codingStandardsIgnoreEnd

		// @codingStandardsIgnoreStart cannot use `$wpdb->prepare` because it remove's the backslashes
		$second_rows_affected = $wpdb->query(
			"UPDATE {$wpdb->postmeta} " .
			$wpdb->prepare( 'SET `meta_value` = REPLACE(`meta_value`, %s, %s) ', $from, $to ) .
			'WHERE `meta_key` = \'_elementor_page_settings\'' );
		// @codingStandardsIgnoreEnd

		litho_import_log( __( 'MESSAGE - Import Replace URLs Item End.', 'litho-addons' ) );
	}
}

/**
 * Set default - Elementor > Settings > Features
 *
 * @since 2.1
 */
if ( ! function_exists( 'litho_update_elementor_default_features' ) ) {
	function litho_update_elementor_default_features() {

		$autoload = 'yes';
		if ( get_option( 'elementor_experiment-e_font_icon_svg' ) === 'active' ||
			get_option( 'elementor_experiment-e_font_icon_svg' ) === 'default' ) {
			update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
		} else {
			add_option( 'elementor_experiment-e_font_icon_svg', 'inactive', '', $autoload );
		}

		if ( get_option( 'elementor_experiment-container_grid' ) === 'active' ||
		get_option( 'elementor_experiment-container_grid' ) === 'default' ) {
			update_option( 'elementor_experiment-container_grid', 'inactive' );
		} else {			
			add_option( 'elementor_experiment-container_grid', 'inactive', '', $autoload );
		}

		if ( get_option( 'elementor_experiment-container' ) === 'active' ||
		get_option( 'elementor_experiment-container' ) === 'default' ) {
			update_option( 'elementor_experiment-container', 'inactive' );
		} else {			
			add_option( 'elementor_experiment-container', 'inactive', '', $autoload );
		}
	}
}
