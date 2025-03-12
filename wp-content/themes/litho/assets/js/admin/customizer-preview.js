( function( $ ) {

	"use strict";

	$( document ).ready(function() {
		
		var litho_customize = wp.customize;

		/* For Body Background Color */
		litho_customize( 'litho_body_background_color', function( value ) {
			value.bind( function( to ) {
				$( 'body' ).css( 'background', to );
			});
		});

		/* For Body Text Color */
		litho_customize( 'litho_body_text_color', function( value ) {
			value.bind( function( to ) {
				$( 'body' ).css( 'color', to );
			});
		});

		/* For Comment Title Color */
		litho_customize( 'litho_general_comment_title_color', function( value ) {
			value.bind( function( to ) {
			   $( '.comment-title, .litho-comments-wrap .comment-respond .comment-reply-title' ).css( 'color', to );
			});
		});

		var $litho_gdpr_content_color,
			$litho_gdpr_content_hover_color,
			$litho_gdpr_button_color,
			$litho_gdpr_button_hover_color,
			$litho_gdpr_button_bg_color,
			$litho_gdpr_button_bg_hover_color,
			$litho_gdpr_button_border_color,
			$litho_gdpr_button_border_hover_color = '';

		/* GDPR Box Background Color */
		litho_customize( 'litho_gdpr_box_background_color', function( value ) {
			value.bind( function( to ) {
			   $( '.litho-cookie-policy-wrapper .cookie-container' ).css( 'background-color', to );
			});
		});

		/* GDPR Overlay Color */
		 litho_customize( 'litho_gdpr_overlay_color', function( value ) {
			value.bind( function( to ) {
			   $( '.litho-cookie-policy-wrapper' ).css( 'background-color', to );
			});
		});

		/* GDPR Content Color */
		litho_customize( 'litho_gdpr_content_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_content_color = to;
				$( '.cookie-container .litho-cookie-policy-text, .cookie-container .litho-cookie-policy-text a' ).css( 'color', to );
				if ( ! $litho_gdpr_content_hover_color ) {
					litho_customize( 'litho_gdpr_content_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.cookie-container .litho-cookie-policy-text a', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.cookie-container .litho-cookie-policy-text a', function() {
							$( this ).css( 'color', $litho_gdpr_content_color );
						});
					});
				}
			});
		});

		/* GDPR Content Hover Color */
		litho_customize( 'litho_gdpr_content_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_content_hover_color = to;
				$( document ).on( 'mouseenter', '.cookie-container .litho-cookie-policy-text a', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.cookie-container .litho-cookie-policy-text a', function() {
					$( this ).css( 'color', $litho_gdpr_content_color );
				});
			});
		});

		/* GDPR Button Background Color */
		litho_customize( 'litho_gdpr_button_bg_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_button_bg_color = to;
				$( '.litho-cookie-policy-wrapper .cookie-container .btn' ).css( 'background-color', to );
				if ( ! $litho_gdpr_button_bg_hover_color ) {
					litho_customize( 'litho_gdpr_button_bg_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-cookie-policy-wrapper .cookie-container .btn', function () {
							$( this ).css( 'background-color', '' );
						}).on( 'mouseleave', '.litho-cookie-policy-wrapper .cookie-container .btn', function() {
							$( this ).css( 'background-color', $litho_gdpr_button_bg_color );
						});
					});
				}
			});
		});

		/* GDPR Button Background Hover Color */
		litho_customize( 'litho_gdpr_button_bg_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_button_bg_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-cookie-policy-wrapper .cookie-container .btn', function () {
					$( this ).css( 'background-color', to );
				}).on( 'mouseleave', '.litho-cookie-policy-wrapper .cookie-container .btn', function() {
					$( this ).css( 'background-color', $litho_gdpr_button_bg_color );
				});
			});
		});

		/* GDPR Button Color */
		litho_customize( 'litho_gdpr_button_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_button_color = to;
				$( '.litho-cookie-policy-wrapper .cookie-container .btn' ).css( 'color', to );
				if ( ! $litho_gdpr_button_hover_color ) {
					litho_customize( 'litho_gdpr_button_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-cookie-policy-wrapper .cookie-container .btn', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-cookie-policy-wrapper .cookie-container .btn', function() {
							$( this ).css( 'color', $litho_gdpr_button_color );
						});
					});
				}
			});
		});

		/* GDPR Button Hover Color */
		litho_customize( 'litho_gdpr_button_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_button_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-cookie-policy-wrapper .cookie-container .btn', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-cookie-policy-wrapper .cookie-container .btn', function() {
					$( this ).css( 'color', $litho_gdpr_button_color );
				});
			});
		});

		/* GDPR Button Border Color */
		litho_customize( 'litho_gdpr_button_border_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_button_border_color = to;
				$( '.litho-cookie-policy-wrapper .cookie-container .btn' ).css( 'border-color', to );
				if ( ! $litho_gdpr_button_border_hover_color ) {
					litho_customize( 'litho_gdpr_button_border_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-cookie-policy-wrapper .cookie-container .btn', function () {
							$( this ).css( 'border-color', '' );
						}).on( 'mouseleave', '.litho-cookie-policy-wrapper .cookie-container .btn', function() {
							$( this ).css( 'border-color', $litho_gdpr_button_border_color );
						});
					});
				}
			});
		});

		/* GDPR Button Border Hover Color */
		litho_customize( 'litho_gdpr_button_border_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_gdpr_button_border_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-cookie-policy-wrapper .cookie-container .btn', function () {
					$( this ).css( 'border-color', to );
				}).on( 'mouseleave', '.litho-cookie-policy-wrapper .cookie-container .btn', function() {
					$( this ).css( 'border-color', $litho_gdpr_button_border_color );
				});
			});
		});
		
		/* For H1 Color */
		litho_customize( 'litho_heading_h1_color', function( value ) {
			value.bind( function( to ) {
			   $( 'h1' ).css( 'color', to );
			});
		});

		/* For H2 Color */
		litho_customize( 'litho_heading_h2_color', function( value ) {
			value.bind( function( to ) {
			   $( 'h2' ).css( 'color', to );
			});
		});

		/* For H3 Color */
		litho_customize( 'litho_heading_h3_color', function( value ) {
			value.bind( function( to ) {
			   $( 'h3' ).css( 'color', to );
			});
		});

		/* For H4 Color */
		litho_customize( 'litho_heading_h4_color', function( value ) {
			value.bind( function( to ) {
			   $( 'h4' ).css( 'color', to );
			});
		});

		/* For H5 Color */
		litho_customize( 'litho_heading_h5_color', function( value ) {
			value.bind( function( to ) {
			   $( 'h5' ).css( 'color', to );
			});
		});

		/* For H6 Color */
		litho_customize( 'litho_heading_h6_color', function( value ) {
			value.bind( function( to ) {
			   $( 'h6' ).css( 'color', to );
			});
		});

		var $litho_default_content_text_color,
			$litho_default_content_text_hover_color = '';

		/* For Content Text Color */
		litho_customize( 'litho_content_link_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_content_text_color = to;
				$( 'a' ).css( 'color', to );
				if ( ! $litho_default_content_text_hover_color ) {
					litho_customize( 'litho_content_link_hover_color', function( value ) {
						$( document ).on( 'mouseenter', 'a', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', 'a', function() {
							$( this ).css( 'color', $litho_default_content_text_color );
						});
					});
				}
			});
		});

		/* For Content Text Hover Color */
		litho_customize( 'litho_content_link_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_content_text_hover_color = to;
				$( document ).on( 'mouseenter', 'a', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', 'a', function() {
					$( this ).css( 'color', $litho_default_content_text_color );
				});
			});
		});
		
		/* Scroll to Top Settings */
		var $litho_default_scroll_to_top_background_color,
			$litho_default_scroll_to_top_background_hover_color,
			$litho_default_scroll_to_top_color,
			$litho_default_scroll_to_top_hover_color = '';

		litho_customize( 'litho_scroll_to_top_background_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_scroll_to_top_background_color = to;
				$( '.scroll-top-arrow' ).css( 'background', to );
				if ( ! $litho_default_scroll_to_top_background_hover_color ) {
					litho_customize( 'litho_scroll_to_top_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.scroll-top-arrow', function () {
							$( this ).css( 'background', '' );
						}).on( 'mouseleave', '.scroll-top-arrow', function() {
							$( this ).css( 'background', $litho_default_scroll_to_top_background_color );
						});
					});
				}
			});
		});

		litho_customize( 'litho_scroll_to_top_background_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_scroll_to_top_background_hover_color = to;
				$( document ).on( 'mouseenter', '.scroll-top-arrow', function () {
					$( this ).css( 'background', to );
				}).on( 'mouseleave', '.scroll-top-arrow', function() {
					$( this ).css( 'background', $litho_default_scroll_to_top_background_color );
				});
			});
		});

		litho_customize( 'litho_scroll_to_top_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_scroll_to_top_color = to;
				$( '.scroll-top-arrow' ).css( 'color', to );
				if ( ! $litho_default_scroll_to_top_hover_color ) {
					litho_customize( 'litho_scroll_to_top_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.scroll-top-arrow', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.scroll-top-arrow', function() {
							$( this ).css( 'color', $litho_default_scroll_to_top_color );
						});
					});
				}
			});
		});

		litho_customize( 'litho_scroll_to_top_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_scroll_to_top_hover_color = to;
				$( document ).on( 'mouseenter', '.scroll-top-arrow', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.scroll-top-arrow', function() {
					$( this ).css( 'color', $litho_default_scroll_to_top_color );
				});
			});
		});

		/* 404 Page Color Settings */
		
		var $litho_default_404_button_color,
			$litho_default_404_button_hover_color = '';

		litho_customize( 'litho_404_main_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.error404 .litho-sub-heading' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_404_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.error404 .litho-heading' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_404_subtitle_color', function( value ) {
			value.bind( function( to ) {
				$( '.error404 .litho-not-found-text' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_404_button_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_404_button_color = to;
				$( '.error404 .btn' ).css( 'color', to );
				if ( ! $litho_default_404_button_hover_color ) {
					litho_customize( 'litho_404_button_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.error404 .btn', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.error404 .btn', function() {
							$( this ).css( 'color', $litho_default_404_button_color );
						});
					});
				}
			});
		});

		litho_customize( 'litho_404_button_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_default_404_button_hover_color = to;
				$( document ).on( 'mouseenter', '.error404 .btn', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.error404 .btn', function() {
					$( this ).css( 'color', $litho_default_404_button_color );
				});
			});
		});

		litho_customize( 'litho_404_button_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.error404 .btn' ).css( 'background', to );
			});
		});

		/* Sticky Post Color Setting */

		/* Title Typography And Color */
		var $litho_title_color_sticky,
			$litho_title_hover_color_sticky = '';

		litho_customize( 'litho_title_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_title_color_sticky = to;
				$( '.blog-standard.blog-post-sticky .entry-title' ).css( 'color', to );
				if ( ! $litho_title_hover_color_sticky ) {
					litho_customize( 'litho_title_hover_color_sticky', function( value ) {
						$( document ).on( 'mouseenter', '.blog-standard.blog-post-sticky .entry-title', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.blog-standard.blog-post-sticky .entry-title', function() {
							$( this ).css( 'color', $litho_title_color_sticky );
						});
					});
				}
			});
		});

		litho_customize( 'litho_title_hover_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_title_hover_color_sticky = to;
				$( document ).on( 'mouseenter', '.blog-standard.blog-post-sticky .entry-title', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.blog-standard.blog-post-sticky .entry-title', function() {
					$( this ).css( 'color', $litho_title_color_sticky );
				});
			});
		});

		/* Content Typography And Color */
		litho_customize( 'litho_content_color_sticky', function( value ) {
			value.bind( function( to ) {
				$( '.blog-standard.blog-post-sticky .entry-content' ).css( 'color', to );
			});
		});

		/* Post Meta And Button Colors */
		var $litho_post_meta_color_sticky,
			$litho_post_meta_hover_color_sticky,
			$litho_button_color_sticky,
			$litho_button_hover_color_sticky,
			$litho_button_text_color_sticky,
			$litho_button_hover_text_color_sticky = '';

		litho_customize( 'litho_box_bg_color_sticky', function( value ) {
			value.bind( function( to ) {
				$( '.blog-standard.blog-post-sticky .blog-post' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_post_meta_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_post_meta_color_sticky = to;
				$( '.blog-standard.blog-post-sticky .post-meta, .blog-standard.blog-post-sticky .post-meta a, .blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a' ).css( 'color', to );
				if ( ! $litho_post_meta_hover_color_sticky ) {
					litho_customize( 'litho_post_meta_hover_color_sticky', function( value ) {
						$( document ).on( 'mouseenter', '.blog-standard.blog-post-sticky .post-meta a, .blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a, .blog-standard.blog-post-sticky .blog-post .blog-category a', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.blog-standard.blog-post-sticky .post-meta a, .blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a, .blog-standard.blog-post-sticky .blog-post .blog-category a', function() {
							$( this ).css( 'color', $litho_post_meta_color_sticky );
						});
					});
				}
			});
		});

		litho_customize( 'litho_post_meta_hover_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_post_meta_hover_color_sticky = to;
				$( document ).on( 'mouseenter', '.blog-standard.blog-post-sticky .post-meta a, .blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a, .blog-standard.blog-post-sticky .blog-post .blog-category a', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.blog-standard.blog-post-sticky .post-meta a, .blog-standard.blog-post-sticky .post-meta-wrapper > span, .blog-standard.blog-post-sticky .post-meta-wrapper > span a, .blog-standard.blog-post-sticky .blog-post .blog-category a', function() {
					$( this ).css( 'color', $litho_post_meta_color_sticky );
				});
			});
		});

		litho_customize( 'litho_box_border_color_sticky', function( value ) {
			value.bind( function( to ) {
				$( '.blog-standard.blog-post-sticky .blog-post' ).css( 'border-color', to );
			});
		});

		litho_customize( 'litho_button_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_button_color_sticky = to;
				$( '.litho-button-wrapper .elementor-button, .elementor-widget-litho-button a.elementor-button, .btn' ).css( 'background-color', to );
				if ( ! $litho_button_hover_color_sticky ) {
					litho_customize( 'litho_button_hover_color_sticky', function( value ) {
						$( document ).on( 'mouseenter', '.litho-button-wrapper .elementor-button, .elementor-widget-litho-button a.elementor-button, .btn', function () {
							$( this ).css( 'background-color', '' );
						}).on( 'mouseleave', '.litho-button-wrapper .elementor-button, .elementor-widget-litho-button a.elementor-button, .btn', function() {
							$( this ).css( 'background-color', $litho_button_color_sticky );
						});
					});
				}
			});
		});

		litho_customize( 'litho_button_hover_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_button_hover_color_sticky = to;
				$( document ).on( 'mouseenter', '.litho-button-wrapper .elementor-button, .elementor-widget-litho-button a.elementor-button, .btn', function () {
					$( this ).css( 'background-color', to );
				}).on( 'mouseleave', '.litho-button-wrapper .elementor-button, .elementor-widget-litho-button a.elementor-button, .btn', function() {
					$( this ).css( 'background-color', $litho_button_color_sticky );
				});
			});
		});

		litho_customize( 'litho_button_text_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_button_text_color_sticky = to;
				$( '.blog-standard.blog-post-sticky .post-details .btn' ).css( 'color', to );
				if ( ! $litho_button_hover_text_color_sticky ) {
					litho_customize( 'litho_button_hover_text_color_sticky', function( value ) {
						$( document ).on( 'mouseenter', '.blog-standard.blog-post-sticky .post-details .btn', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.blog-standard.blog-post-sticky .post-details .btn', function() {
							$( this ).css( 'color', $litho_button_text_color_sticky );
						});
					});
				}
			});
		});
		litho_customize( 'litho_button_hover_text_color_sticky', function( value ) {
			value.bind( function( to ) {
				$litho_button_hover_text_color_sticky = to;
				$( document ).on( 'mouseenter', '.blog-standard.blog-post-sticky .post-details .btn', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.blog-standard.blog-post-sticky .post-details .btn', function() {
					$( this ).css( 'color', $litho_button_text_color_sticky );
				});
			});
		});

		litho_customize( 'litho_button_border_color_sticky', function( value ) {
			value.bind( function( to ) {
				$( '.blog-standard.blog-post-sticky .post-details .btn' ).css( 'border-color', to );
			});
		});

		litho_customize( 'litho_meta_border_color_sticky', function( value ) {
			value.bind( function( to ) {
				$( '.blog-standard.blog-post-sticky .post-meta-wrapper,.blog-standard.blog-post-sticky .post-meta-wrapper > span' ).css( 'border-color', to );
			});
		});

		/* Single Post Color Setting */
		var $litho_related_post_title_color,
			$litho_related_post_title_hover_color,
			$litho_related_post_meta_color,
			$litho_related_post_meta_hover_color,
			$litho_related_post_button_bg_color,
			$litho_related_post_button_bg_hover_color,
			$litho_related_post_button_text_color,
			$litho_related_post_button_text_hover_color,
			$litho_related_post_button_border_color,
			$litho_related_post_button_border_hover_color,
			$litho_post_meta_color,
			$litho_post_meta_hover_color,
			$litho_post_tag_like_color,
			$litho_post_tag_like_hover_color,
			$litho_post_tag_like_bg_color,
			$litho_post_tag_like_hover_bg_color,
			$litho_post_navigation_color,
			$litho_post_navigation_hover_color,
			$litho_post_author_title_text_color,
			$litho_post_author_title_text_hover_color,
			$litho_button_text_color_author_box,
			$litho_button_hover_text_color_author_box,
			$litho_button_border_color_author_box,
			$litho_button_hover_border_color_author_box = '';

		litho_customize( 'litho_related_post_general_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-posts-wrap .related-post-general-title' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_related_post_general_sub_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-posts-wrap .related-post-general-subtitle' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_related_post_title_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_title_color = to;
				$( '.litho-related-posts-wrap .blog-clean.blog-grid .entry-title' ).css( 'color', to );
				if ( ! $litho_related_post_title_hover_color ) {
					litho_customize( 'litho_related_post_title_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-clean.blog-grid .entry-title', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-related-posts-wrap .blog-clean.blog-grid .entry-title', function() {
							$( this ).css( 'color', $litho_related_post_title_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_related_post_title_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_title_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-clean.blog-grid .entry-title', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-related-posts-wrap .blog-clean.blog-grid .entry-title', function() {
					$( this ).css( 'color', $litho_related_post_title_color );
				});
			});
		});

		litho_customize( 'litho_related_post_content_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-posts-wrap .blog-clean.blog-grid .entry-content' ).css( 'color', to );
			});
		});
		
		litho_customize( 'litho_related_post_meta_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_meta_color = to;
				$( '.litho-related-posts-wrap .blog-grid .post-date, .litho-related-posts-wrap .blog-grid .author-name, .litho-related-posts-wrap .blog-grid .author-name a, .litho-related-posts-wrap .blog-grid .blog-like, .litho-related-posts-wrap .blog-grid .comment-link' ).css( 'color', to );
				if ( ! $litho_related_post_meta_hover_color ) {
					litho_customize( 'litho_related_post_meta_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .author-name a, .litho-related-posts-wrap .blog-grid .blog-like, .litho-related-posts-wrap .blog-grid .comment-link', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .author-name a, .litho-related-posts-wrap .blog-grid .blog-like, .litho-related-posts-wrap .blog-grid .comment-link', function() {
							$( this ).css( 'color', $litho_related_post_meta_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_related_post_meta_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_meta_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .author-name a, .litho-related-posts-wrap .blog-grid .blog-like, .litho-related-posts-wrap .blog-grid .comment-link', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .author-name a, .litho-related-posts-wrap .blog-grid .blog-like, .litho-related-posts-wrap .blog-grid .comment-link', function() {
					$( this ).css( 'color', $litho_related_post_meta_color );
				});
			});
		});

		litho_customize( 'litho_related_post_separator_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-posts-wrap .horizontal-separator' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_related_post_button_bg_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_button_bg_color = to;
				$( '.litho-related-posts-wrap .blog-grid .blog-post-button' ).css( 'background-color', to );
				if ( ! $litho_related_post_button_bg_hover_color ) {
					litho_customize( 'litho_related_post_button_bg_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .blog-post-button', function () {
							$( this ).css( 'background-color', '' );
						}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .blog-post-button', function() {
							$( this ).css( 'background-color', $litho_related_post_button_bg_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_related_post_button_bg_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_button_bg_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .blog-post-button', function () {
					$( this ).css( 'background-color', to );
				}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .blog-post-button', function() {
					$( this ).css( 'background-color', $litho_related_post_button_bg_color );
				});
			});
		});

		litho_customize( 'litho_related_post_button_text_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_button_text_color = to;
				$( '.litho-related-posts-wrap .blog-grid .blog-post-button' ).css( 'color', to );
				if ( ! $litho_related_post_button_text_hover_color ) {
					litho_customize( 'litho_related_post_button_text_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .blog-post-button', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .blog-post-button', function() {
							$( this ).css( 'color', $litho_related_post_button_text_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_related_post_button_text_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_button_text_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .blog-post-button', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .blog-post-button', function() {
					$( this ).css( 'color', $litho_related_post_button_text_color );
				});
			});
		});
		litho_customize( 'litho_related_post_button_border_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_button_border_color = to;
				$( '.litho-related-posts-wrap .blog-grid .blog-post-button' ).css( 'border-color', to );
				if ( ! $litho_related_post_button_border_hover_color ) {
					litho_customize( 'litho_related_post_button_border_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .blog-post-button', function () {
							$( this ).css( 'border-color', '' );
						}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .blog-post-button', function() {
							$( this ).css( 'border-color', $litho_related_post_button_border_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_related_post_button_border_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_related_post_button_border_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-related-posts-wrap .blog-grid .blog-post-button', function () {
					$( this ).css( 'border-color', to );
				}).on( 'mouseleave', '.litho-related-posts-wrap .blog-grid .blog-post-button', function() {
					$( this ).css( 'border-color', $litho_related_post_button_border_color );
				});
			});
		});

		litho_customize( 'litho_post_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-post-main-section .single-post-title' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_post_meta_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-post-main-section .litho-single-post-meta ul li' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_post_meta_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_meta_color = to;
				$( '.single-post-main-section .litho-single-post-meta ul li, .single-post-main-section .litho-single-post-meta ul li a' ).css( 'color', to );
				if ( ! $litho_post_meta_hover_color ) {
					litho_customize( 'litho_post_meta_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.single-post-main-section .litho-single-post-meta ul li, .single-post-main-section .litho-single-post-meta ul li a', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.single-post-main-section .litho-single-post-meta ul li, .single-post-main-section .litho-single-post-meta ul li a', function() {
							$( this ).css( 'color', $litho_post_meta_color );
						});
					});
				}
			});
		});

		litho_customize( 'litho_post_meta_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_meta_hover_color = to;
				$( document ).on( 'mouseenter', '.single-post-main-section .litho-single-post-meta ul li a', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.single-post-main-section .litho-single-post-meta ul li a', function() {
					$( this ).css( 'color', $litho_post_meta_color );
				});
			});
		});

		litho_customize( 'litho_post_meta_icon_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-post-main-section .litho-single-post-meta ul li i' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_post_tag_like_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_tag_like_color = to;
				$( '.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .litho-blog-detail-like a i, .tag-like-social-wrapper .tagcloud a, .blog-details-social-sharing ul li a' ).css( 'color', to );
				$( '.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a' ).css( 'border-color', to );
				if ( ! $litho_post_tag_like_hover_color ) {
					litho_customize( 'litho_post_tag_like_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a, .single-post .blog-details-social-sharing ul li a', function () {
							$( this ).css( 'color', '' );
							$( this ).css( 'border-color', '' );
							$( this ).find( 'i' ).css( 'color', '' );
						}).on( 'mouseleave', '.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a, .single-post .blog-details-social-sharing ul li a', function() {
							$( this ).css( 'color', $litho_post_tag_like_color );
							$( this ).css( 'border-color', $litho_post_tag_like_color );
							$( this ).find( 'i' ).css( 'color', $litho_post_tag_like_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_post_tag_like_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_tag_like_hover_color = to;
				$( document ).on( 'mouseenter', '.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a, .single-post .blog-details-social-sharing ul li a', function () {
					$( this ).css( 'color', to );
					$( this ).css( 'border-color', to );
					$( this ).find( 'i' ).css( 'color', to );
				}).on( 'mouseleave', '.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a, .single-post .blog-details-social-sharing ul li a', function() {
					$( this ).find( 'i' ).css( 'color', $litho_post_tag_like_color );
					$( this ).css( 'color', $litho_post_tag_like_color );
					$( this ).css( 'border-color', $litho_post_tag_like_color );
				});
			});
		});

		litho_customize( 'litho_post_tag_like_bg_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-post .tag-like-social-wrapper .litho-blog-detail-like a, .single-post .tag-like-social-wrapper .tagcloud a' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_post_navigation_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_navigation_color = to;
				$( '.single-post-navigation .blog-nav-link a, .single-post-navigation .blog-nav-link i' ).css( 'color', to );
				if ( ! $litho_post_navigation_hover_color ) {
					litho_customize( 'litho_post_navigation_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.single-post-navigation .blog-nav-link', function () {
							$( this ).find( 'a' ).css( 'color', '' );
							$( this ).find( 'i' ).css( 'color', '' );
						}).on( 'mouseleave', '.single-post-navigation .blog-nav-link', function() {
							$( this ).find( 'a' ).css( 'color', $litho_post_navigation_color );
							$( this ).find( 'i' ).css( 'color', $litho_post_navigation_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_post_navigation_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_navigation_hover_color = to;
				$( document ).on( 'mouseenter', '.single-post-navigation .blog-nav-link a', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.single-post-navigation .blog-nav-link a', function() {
					$( this ).css( 'color', $litho_post_navigation_color );
				});
			});
		});
		litho_customize( 'litho_post_author_box_bg_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-author-box-wrap .litho-author-box' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_post_author_title_text_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_author_title_text_color = to;
				$( '.litho-author-box-wrap .litho-author-box .avtar-image-meta .author-title' ).css( 'color', to );
				if ( ! $litho_post_author_title_text_hover_color ) {
					litho_customize( 'litho_post_author_title_text_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-author-box-wrap .litho-author-box .avtar-image-meta .author-title', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-author-box-wrap .litho-author-box .avtar-image-meta .author-title', function() {
							$( this ).css( 'color', $litho_post_author_title_text_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_post_author_title_text_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_author_title_text_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-author-box-wrap .litho-author-box .avtar-image-meta .author-title', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-author-box-wrap .litho-author-box .avtar-image-meta .author-title', function() {
					$( this ).css( 'color', $litho_post_author_title_text_color );
				});
			});
		});

		litho_customize( 'litho_post_author_content_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-author-box-wrap .litho-author-box .author-content-meta p' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_button_text_color_author_box', function( value ) {
			value.bind( function( to ) {
				$litho_button_text_color_author_box = to;
				$( '.litho-author-box-wrap .litho-author-box .author-content-meta .btn' ).css( 'color', to );
				if ( ! $litho_button_hover_text_color_author_box ) {
					litho_customize( 'litho_button_hover_text_color_author_box', function( value ) {
						$( document ).on( 'mouseenter', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function() {
							$( this ).css( 'color', $litho_button_text_color_author_box );
						});
					});
				}
			});
		});
		litho_customize( 'litho_button_hover_text_color_author_box', function( value ) {
			value.bind( function( to ) {
				$litho_button_hover_text_color_author_box = to;
				$( document ).on( 'mouseenter', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function() {
					$( this ).css( 'color', $litho_button_text_color_author_box );
				});
			});
		});

		litho_customize( 'litho_button_border_color_author_box', function( value ) {
			value.bind( function( to ) {
				$litho_button_border_color_author_box = to;
				$( '.litho-author-box-wrap .litho-author-box .author-content-meta .btn' ).css( 'border-color', to );
				if ( ! $litho_button_hover_border_color_author_box ) {
					litho_customize( 'litho_button_hover_border_color_author_box', function( value ) {
						$( document ).on( 'mouseenter', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function () {
							$( this ).css( 'border-color', '' );
						}).on( 'mouseleave', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function() {
							$( this ).css( 'border-color', $litho_button_border_color_author_box );
						});
					});
				}
			});
		});
		litho_customize( 'litho_button_hover_border_color_author_box', function( value ) {
			value.bind( function( to ) {
				$litho_button_hover_border_color_author_box = to;
				$( document ).on( 'mouseenter', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function () {
					$( this ).css( 'border-color', to );
				}).on( 'mouseleave', '.litho-author-box-wrap .litho-author-box .author-content-meta .btn', function() {
					$( this ).css( 'border-color', $litho_button_border_color_author_box );
				});
			});
		});

		/* Portfolio Single Color Setting */
		var $litho_single_portfolio_meta_color,
			$litho_single_portfolio_meta_hover_color,
			$litho_navigation_single_portfolio_link_color,
			$litho_navigation_single_portfolio_link_hover_color = '';

		litho_customize( 'litho_single_portfolio_meta_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-portfolio .porfolio-categories-lists .posted_in' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_portfolio_meta_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_portfolio_meta_color = to;
				$( '.single-portfolio .porfolio-categories-lists .posted_in a, .single-portfolio .porfolio-categories-lists .tagcloud a' ).css( 'color', to );
				$( '.single-portfolio .porfolio-categories-lists .posted_in a, .single-portfolio .porfolio-categories-lists .tagcloud a' ).css( 'border-color', to );

				if ( ! $litho_single_portfolio_meta_hover_color ) {
					litho_customize( 'litho_single_portfolio_meta_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.single-portfolio .porfolio-categories-lists .posted_in a, .single-portfolio .porfolio-categories-lists .tagcloud a', function () {
							$( this ).css( 'color', '' );
							$( this ).css( 'border-color', '' );
						}).on( 'mouseleave', '.single-portfolio .porfolio-categories-lists .posted_in a, .single-portfolio .porfolio-categories-lists .tagcloud a', function() {
							$( this ).css( 'color', $litho_single_portfolio_meta_color );
							$( this ).css( 'border-color', $litho_single_portfolio_meta_color );
						});
					});
				}
			});
		});

		litho_customize( 'litho_single_portfolio_meta_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_portfolio_meta_hover_color = to;
				$( document ).on( 'mouseenter', '.single-portfolio .porfolio-categories-lists .posted_in a, .single-portfolio .porfolio-categories-lists .tagcloud a', function () {
					$( this ).css( 'color', to );
					$( this ).css( 'border-color', to );
				}).on( 'mouseleave', '.single-portfolio .porfolio-categories-lists .posted_in a, .single-portfolio .porfolio-categories-lists .tagcloud a', function() {
					$( this ).css( 'color', $litho_single_portfolio_meta_color );
					$( this ).css( 'border-color', $litho_single_portfolio_meta_color );
				});
			});
		});

		litho_customize( 'litho_single_portfolio_share_heading_text_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-portfolio .share-heading' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_portfolio_share_icon_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-portfolio .blog-details-social-sharing ul li a' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_related_single_portfolio_box_bg_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-main-content-wrap .litho-related-portfolio-wrap' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_related_single_portfolio_title_text_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-portfolio-wrap .related-portfolio-general-title' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_related_single_portfolio_content_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-portfolio-wrap .related-portfolio-general-subtitle' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_related_single_portfolio_bg_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-portfolio-wrap .portfolio-classic .portfolio-item .portfolio-caption' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_related_single_portfolio_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-portfolio-wrap .blog-grid .portfolio-item .title a' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_related_single_portfolio_subtitle_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-related-portfolio-wrap .portfolio-classic .portfolio-item .portfolio-caption .subtitle' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_navigation_single_portfolio_bg_color', function( value ) {
			value.bind( function( to ) {
				$( '.portfolio-navigation-wrapper .fancy-box-item' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_navigation_single_portfolio_text_color', function( value ) {
			value.bind( function( to ) {
				$( '.portfolio-navigation-wrapper .fancy-box-item .title' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_navigation_single_portfolio_link_color', function( value ) {
			value.bind( function( to ) {
				$litho_navigation_single_portfolio_link_color = to;
				$( '.portfolio-navigation-wrapper .fancy-box-item .next-previous-navigation .prev-link-text, .portfolio-navigation-wrapper .fancy-box-item .next-previous-navigation .next-link-text, .portfolio-navigation-wrapper .fancy-box-item .next-previous-navigation i' ).css( 'color', to );
				if ( ! $litho_navigation_single_portfolio_link_hover_color ) {
					litho_customize( 'litho_navigation_single_portfolio_link_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.portfolio-navigation-wrapper .fancy-box-item', function () {
							$( this ).find( '.prev-link-text' ).css( 'color', '' );
							$( this ).find( '.next-link-text' ).css( 'color', '' );
							$( this ).find( 'i' ).css( 'color', '' );
						}).on( 'mouseleave', '.portfolio-navigation-wrapper .fancy-box-item', function() {
							$( this ).find( '.prev-link-text' ).css( 'color', $litho_navigation_single_portfolio_link_color );
							$( this ).find( '.next-link-text' ).css( 'color', $litho_navigation_single_portfolio_link_color );
							$( this ).find( 'i' ).css( 'color', $litho_navigation_single_portfolio_link_color );
						});
					});
				}
			});
		});
		litho_customize( 'litho_navigation_single_portfolio_link_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_navigation_single_portfolio_link_hover_color = to;
				$( document ).on( 'mouseenter', '.portfolio-navigation-wrapper .fancy-box-item', function () {
					$( this ).find( '.prev-link-text' ).css( 'color', to );
					$( this ).find( '.next-link-text' ).css( 'color', to );
					$( this ).find( 'i' ).css( 'color', to );
				}).on( 'mouseleave', '.portfolio-navigation-wrapper .fancy-box-item', function() {
					$( this ).find( '.prev-link-text' ).css( 'color', $litho_navigation_single_portfolio_link_color );
					$( this ).find( '.next-link-text' ).css( 'color', $litho_navigation_single_portfolio_link_color );
					$( this ).find( 'i' ).css( 'color', $litho_navigation_single_portfolio_link_color );
				});
			});
		});

		/* ========== Product Single Color Setting ============ */

		litho_customize( 'litho_single_product_sale_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product > .onsale' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_product_sale_bg_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product > .onsale' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_single_product_sale_border_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product > .onsale' ).css( 'border-color', to );
			});
		});
		
		litho_customize( 'litho_single_product_page_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .product_title' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_product_rating_star_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .star-rating span' ).css( 'color', to );
			});
		});
				
		litho_customize( 'litho_single_product_price_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .price, .single-product .product .summary .price ins' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_product_regular_price_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .price del' ).css( 'color', to );
			});
		});
		
		litho_customize( 'litho_single_product_short_description_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .woocommerce-product-details__short-description' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_product_stock_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .stock.in-stock' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_product_out_of_stock_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .stock.out-of-stock' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_single_product_stock_bg_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary p.stock' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_single_product_stock_border_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .stock.in-stock' ).css( 'border-color', to );
			});
		});

		litho_customize( 'litho_single_product_out_of_stock_border_color', function( value ) {
			value.bind( function( to ) {
				$( '.single-product .product .summary .stock.out-of-stock' ).css( 'border-color', to );
			});
		});

		var $litho_single_product_button_color,
			$litho_single_product_button_hover_color,
			$litho_single_product_button_bg_color,
			$litho_single_product_button_hover_bg_color = '';


		/* Single Product Button Color */
		litho_customize( 'litho_single_product_button_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_product_button_color = to;
				$( '.single-product .product .summary .button' ).css( 'color', to );

				if ( ! $litho_single_product_button_hover_color ) {
					litho_customize( 'litho_single_product_button_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.single-product .product .summary .button', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.single-product .product .summary .button', function() {
							$( this ).css( 'color', $litho_single_product_button_color );
						});
					});
				}
			});
		});

		/* Single Product Button Hover Color */
		litho_customize( 'litho_single_product_button_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_product_button_hover_color = to;
				$( document ).on( 'mouseenter', '.single-product .product .summary .button', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.single-product .product .summary .button', function() {
					$( this ).css( 'color', $litho_single_product_button_color );
				});
			});
		});

		/* Single Product Button BG Color */
		litho_customize( 'litho_single_product_button_bg_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_product_button_bg_color = to;
				$( '.single-product .product .summary .button' ).css( 'background-color', to );

				if ( ! $litho_single_product_button_hover_bg_color ) {
					litho_customize( 'litho_single_product_button_hover_bg_color', function( value ) {
						$( document ).on( 'mouseenter', '.single-product .product .summary .button', function () {
							$( this ).css( 'background-color', '' );
						}).on( 'mouseleave', '.single-product .product .summary .button', function() {
							$( this ).css( 'background-color', $litho_single_product_button_bg_color );
						});
					});
				}
			});
		});

		/* Single Product Button BG Hover Color */
		litho_customize( 'litho_single_product_button_hover_bg_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_product_button_hover_bg_color = to;
				$( document ).on( 'mouseenter', '.single-product .product .summary .button', function () {
					$( this ).css( 'background-color', to );
				}).on( 'mouseleave', '.single-product .product .summary .button', function() {
					$( this ).css( 'background-color', $litho_single_product_button_bg_color );
				});
			});
		});

		/* Single Product Button Border Color */
		litho_customize( 'litho_single_product_button_border_color', function( value ) {
			value.bind( function( to ) {
			   $( '.single-product .product .summary .button' ).css( 'border-color', to );
			});
		});

		var $litho_single_product_page_meta_color,
			$litho_single_product_page_meta_link_hover_color,
			litho_single_product_page_tab_color,
			litho_single_product_page_tab_active_color = '';

		/* Single Product Meta Color */
		litho_customize( 'litho_single_product_page_meta_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce.single-product .product .summary .product_meta .sku_wrapper .sku, .woocommerce.single-product .product .summary .product_meta .posted_in a, .woocommerce.single-product .product .summary .product_meta .tagged_as a, .woocommerce div.product form.cart .variations label, .woocommerce div.product form.cart .reset_variations' ).css( 'color', to );
			});
		});

		/* Single Product Meta Color */
		litho_customize( 'litho_single_product_page_meta_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_product_page_meta_color = to;
				$( '.woocommerce.single-product .product .summary .product_meta .sku_wrapper .sku, .woocommerce.single-product .product .summary .product_meta .posted_in a, .woocommerce.single-product .product .summary .product_meta .tagged_as a, .woocommerce div.product form.cart .variations label, .woocommerce div.product form.cart .reset_variations' ).css( 'color', to );

				if ( !  $litho_single_product_page_meta_link_hover_color ) {
					litho_customize( 'litho_single_product_page_meta_link_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.woocommerce.single-product .product .summary .product_meta .sku_wrapper .sku, .woocommerce.single-product .product .summary .product_meta .posted_in a, .woocommerce.single-product .product .summary .product_meta .tagged_as a, .woocommerce div.product form.cart .variations label, .woocommerce div.product form.cart .reset_variations', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.woocommerce.single-product .product .summary .product_meta .sku_wrapper .sku, .woocommerce.single-product .product .summary .product_meta .posted_in a, .woocommerce.single-product .product .summary .product_meta .tagged_as a, .woocommerce div.product form.cart .variations label, .woocommerce div.product form.cart .reset_variations', function() {
							$( this ).css( 'color', $litho_single_product_page_meta_color );
						});
					});
				}
			});
		});

		/* Single Product Meta Link Hover Color */
		litho_customize( 'litho_single_product_page_meta_link_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_single_product_page_meta_link_hover_color = to;
				$( document ).on( 'mouseenter', '.woocommerce.single-product .product .summary .product_meta .sku_wrapper .sku, .woocommerce.single-product .product .summary .product_meta .posted_in a, .woocommerce.single-product .product .summary .product_meta .tagged_as a, .woocommerce div.product form.cart .variations label, .woocommerce div.product form.cart .reset_variations', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.woocommerce.single-product .product .summary .product_meta .sku_wrapper .sku, .woocommerce.single-product .product .summary .product_meta .posted_in a, .woocommerce.single-product .product .summary .product_meta .tagged_as a, .woocommerce div.product form.cart .variations label, .woocommerce div.product form.cart .reset_variations', function() {
					$( this ).css( 'color', $litho_single_product_page_meta_color );
				});
			});
		});

		/* Single Product Meta social icon color */
		litho_customize( 'litho_single_product_page_meta_social_icon_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce.single-product .product_meta .social-icons-wrapper .default-icon li a' ).css( 'color', to );
			});
		});

		/* Single Product Meta heading color */
		litho_customize( 'litho_single_product_page_meta_heading_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce.single-product .product .summary .product_meta .sku_wrapper, .woocommerce.single-product .product .summary .product_meta .posted_in, .woocommerce.single-product .product .summary .product_meta .tagged_as, .woocommerce.single-product .product .summary .product_meta .social-icons-wrapper' ).css( 'color', to );
			});
		});        

		/* Single Product Tab Color */
		litho_customize( 'litho_single_product_page_tab_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce.single-product .product .woocommerce-tabs ul.tabs li a' ).css( 'color', to );
			});
		});
		
		/* Single Product Active Tab Color */
		litho_customize( 'litho_single_product_page_tab_active_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce.single-product .product .woocommerce-tabs ul.tabs li.active a' ).css( 'color', to );
				$( '.woocommerce.single-product .product .woocommerce-tabs ul.tabs li.active a' ).css( 'border-bottom-color', to );
			});
		});

		 /* Single Product Related Product Heading Color */
		litho_customize( 'litho_single_product_related_product_heading_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce .related > h2' ).css( 'color', to );
			});
		});

		/* Single Product Up Sells Product Heading Color */
		litho_customize( 'litho_single_product_up_sells_product_heading_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce .up-sells > h2' ).css( 'color', to );
			});
		});

		/* Single Product Cross Sells Product Heading Color */
		litho_customize( 'litho_single_product_cross_sells_product_heading_color', function( value ) {
			value.bind( function( to ) {
				$( '.woocommerce .cross-sells > h2' ).css( 'color', to );
			});
		});

		/* ============== Product archive Setting ===============*/

		/* Product Archive Product Sale Color */
		litho_customize( 'litho_product_archive_product_sale_color', function( value ) {
			value.bind( function( to ) {
			   $( '.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale' ).css( 'color', to );
			});
		});

		/* Product Archive Product Sale Background Color */
		litho_customize( 'litho_product_archive_product_sale_bg_color', function( value ) {
			value.bind( function( to ) {
			   $( '.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale' ).css( 'background-color', to );
			});
		});

		/* Product Archive Product Sale Border Color */
		litho_customize( 'litho_product_archive_product_sale_border_color', function( value ) {
			value.bind( function( to ) {
			   $( '.woocommerce.archive .litho-shop-content-wrap ul li.product .onsale' ).css( 'border-color', to );
			});
		});

		var $litho_product_archive_product_title_color,
			$litho_product_archive_product_title_hover_color = '';

		/* Product Archive Product Title Color */
		litho_customize( 'litho_product_archive_product_title_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_archive_product_title_color = to;
				$( '.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a' ).css( 'color', to );
				if ( !  $litho_product_archive_product_title_hover_color ) {
					litho_customize( 'litho_product_archive_product_title_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a', function() {
							$( this ).css( 'color', $litho_product_archive_product_title_color );
						});
					});
				}
			});
		});

		/* Product Archive Product Title Hover Color */
		litho_customize( 'litho_product_archive_product_title_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_archive_product_title_hover_color = to;
				$( document ).on( 'mouseenter', '.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.woocommerce.archive .litho-shop-content-wrap ul li.product .woocommerce-loop-product__title a', function() {
					$( this ).css( 'color', $litho_product_archive_product_title_color );
				});
			});
		});

		/* Product Archive Product Price Color */
		litho_customize( 'litho_product_archive_product_price_color', function( value ) {
			value.bind( function( to ) {
			   $( '.woocommerce.archive .litho-shop-content-wrap ul li.product .price, .woocommerce.archive .litho-shop-content-wrap ul li.product .price ins' ).css( 'color', to );
			});
		});

		/* Product Archive Product Price Color */
		litho_customize( 'litho_product_archive_product_regular_price_color', function( value ) {
			value.bind( function( to ) {
			   $( '.woocommerce.archive .litho-shop-content-wrap ul li.product .price del' ).css( 'color', to );
			});
		});

		var $litho_product_archive_product_button_color,
			$litho_product_archive_product_button_hover_color,
			$litho_product_archive_product_button_bg_color,
			$litho_product_archive_product_button_hover_bg_color = '';

		/* Product Archive Product Button Color */
		litho_customize( 'litho_product_archive_product_button_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_archive_product_button_color = to;
				$( '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button' ).css( 'color', to );

				if ( !  $litho_product_archive_product_button_hover_color ) {
					litho_customize( 'litho_product_archive_product_button_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function() {
							$( this ).css( 'color', $litho_product_archive_product_button_color );
						});
					});
				}
			});
		});

		/* Product Archive Product Button Hover Color */
		litho_customize( 'litho_product_archive_product_button_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_archive_product_button_hover_color = to;
				$( document ).on( 'mouseenter', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function() {
					$( this ).css( 'color', $litho_product_archive_product_button_color );
				});
			});
		});

		/* Product Archive Product Button BG Color */
		litho_customize( 'litho_product_archive_product_button_bg_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_archive_product_button_bg_color = to;
				$( '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button' ).css( 'background-color', to );

				if ( !  $litho_product_archive_product_button_hover_bg_color ) {
					litho_customize( 'litho_product_archive_product_button_hover_bg_color', function( value ) {
						$( document ).on( 'mouseenter', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function () {
							$( this ).css( 'background-color', '' );
						}).on( 'mouseleave', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function() {
							$( this ).css( 'background-color', $litho_product_archive_product_button_bg_color );
						});
					});
				}
			});
		});

		/* Product Archive Product Button BG Hover Color */
		litho_customize( 'litho_product_archive_product_button_hover_bg_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_archive_product_button_hover_bg_color = to;
				$( document ).on( 'mouseenter', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function () {
					$( this ).css( 'background-color', to );
				}).on( 'mouseleave', '.woocommerce.archive .litho-shop-content-wrap ul li.product a.button', function() {
					$( this ).css( 'background-color', $litho_product_archive_product_button_bg_color );
				});
			});
		});
		
		/* ============== SIDEBAR Setting ===============*/

		var $litho_post_widget_content_link_color,
			$litho_post_widget_content_link_hover_color = '';

		/* Post Widget title Color */
		litho_customize( 'litho_post_widget_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-post-sidebar .widget-title' ).css( 'color', to );
			});
		});

		/* Post Widget content Color */
		litho_customize( 'litho_post_widget_content_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-post-sidebar p, .litho-post-sidebar .widget, .litho-post-sidebar .about-me-wp-widget .author-name, .litho-post-sidebar .about-me-wp-widget .author-designation' ).css( 'color', to );
			});
		});

		/* Post Widget Content link Color */
		litho_customize( 'litho_post_widget_content_link_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_widget_content_link_color = to;
				$( '.litho-post-sidebar a, .litho-post-sidebar .social-icon-style-1 a, .litho-post-sidebar ul.recent-post-wp-widget li .media-body .recent-post-title' ).css( 'color', to );
				if ( ! $litho_post_widget_content_link_hover_color ) {
					litho_customize( 'litho_post_widget_content_link_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-post-sidebar a, .litho-post-sidebar .social-icon-style-1 a, .litho-post-sidebar ul.recent-post-wp-widget li .media-body .recent-post-title', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-post-sidebar a, .litho-post-sidebar .social-icon-style-1 a, .litho-post-sidebar ul.recent-post-wp-widget li .media-body .recent-post-title', function() {
							$( this ).css( 'color', $litho_post_widget_content_link_color );
						});
					});
				}
			});
		});

		/* Post Widget Content Link Hover Color */
		litho_customize( 'litho_post_widget_content_link_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_post_widget_content_link_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-post-sidebar a, .litho-post-sidebar .social-icon-style-1 a, .litho-post-sidebar ul.recent-post-wp-widget li .media-body .recent-post-title', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-post-sidebar a, .litho-post-sidebar .social-icon-style-1 a, .litho-post-sidebar ul.recent-post-wp-widget li .media-body .recent-post-title', function() {
					$( this ).css( 'color', $litho_post_widget_content_link_color );
				});
			});
		});

		/* Post Widget background Color */
		litho_customize( 'litho_post_widget_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-post-sidebar .about-me-wp-widget' ).css( 'background-color', to );
			});
		});

		/* Post Widget border Color */
		litho_customize( 'litho_post_widget_border_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-post-sidebar .about-me-wp-widget, .litho-post-sidebar .widget_search input' ).css( 'border-color', to );
			});
		});

		var $litho_page_widget_content_link_color,
			$litho_page_widget_content_link_hover_color = '';

		/* Page Widget title Color */
		litho_customize( 'litho_page_widget_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-page-sidebar .widget-title' ).css( 'color', to );
			});
		});

		/* Page Widget content Color */
		litho_customize( 'litho_page_widget_content_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-page-sidebar p, .litho-page-sidebar .widget, .litho-page-sidebar .about-me-wp-widget .author-name, .litho-page-sidebar .about-me-wp-widget .author-designation' ).css( 'color', to );
			});
		});

		/* Page Widget Content link Color */
		litho_customize( 'litho_page_widget_content_link_color', function( value ) {
			value.bind( function( to ) {
				$litho_page_widget_content_link_color = to;
				$( '.litho-page-sidebar a, .litho-page-sidebar .social-icon-style-1 a, .litho-page-sidebar ul.recent-page-wp-widget li .media-body .recent-page-title' ).css( 'color', to );
				if ( ! $litho_page_widget_content_link_hover_color ) {
					litho_customize( 'litho_page_widget_content_link_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-page-sidebar a, .litho-page-sidebar .social-icon-style-1 a, .litho-page-sidebar ul.recent-page-wp-widget li .media-body .recent-page-title', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-page-sidebar a, .litho-page-sidebar .social-icon-style-1 a, .litho-page-sidebar ul.recent-page-wp-widget li .media-body .recent-page-title', function() {
							$( this ).css( 'color', $litho_page_widget_content_link_color );
						});
					});
				}
			});
		});

		/* Page Widget Content Link Hover Color */
		litho_customize( 'litho_page_widget_content_link_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_page_widget_content_link_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-page-sidebar a, .litho-page-sidebar .social-icon-style-1 a, .litho-page-sidebar ul.recent-page-wp-widget li .media-body .recent-page-title', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-page-sidebar a, .litho-page-sidebar .social-icon-style-1 a, .litho-page-sidebar ul.recent-page-wp-widget li .media-body .recent-page-title', function() {
					$( this ).css( 'color', $litho_page_widget_content_link_color );
				});
			});
		});

		/* Page Widget background Color */
		litho_customize( 'litho_page_widget_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-page-sidebar .about-me-wp-widget' ).css( 'background-color', to );
			});
		});

		/* Page Widget border Color */
		litho_customize( 'litho_page_widget_border_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-page-sidebar .about-me-wp-widget, .litho-page-sidebar .widget_search input' ).css( 'border-color', to );
			});
		});
		
		var $litho_portfolio_widget_content_link_color,
			$litho_portfolio_widget_content_link_hover_color = '';

		/* Portfolio Widget title Color */
		litho_customize( 'litho_portfolio_widget_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-portfolio-sidebar .widget-title' ).css( 'color', to );
			});
		});

		/* Portfolio Widget content Color */
		litho_customize( 'litho_portfolio_widget_content_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-portfolio-sidebar p, .litho-portfolio-sidebar .widget, .litho-portfolio-sidebar .about-me-wp-widget .author-name, .litho-portfolio-sidebar .about-me-wp-widget .author-designation' ).css( 'color', to );
			});
		});

		/* Portfolio Widget Content link Color */
		litho_customize( 'litho_portfolio_widget_content_link_color', function( value ) {
			value.bind( function( to ) {
				$litho_portfolio_widget_content_link_color = to;
				$( '.litho-portfolio-sidebar a, .litho-portfolio-sidebar .social-icon-style-1 a, .litho-portfolio-sidebar ul.recent-portfolio-wp-widget li .media-body .recent-portfolio-title' ).css( 'color', to );
				if ( ! $litho_portfolio_widget_content_link_hover_color ) {
					litho_customize( 'litho_portfolio_widget_content_link_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-portfolio-sidebar a, .litho-portfolio-sidebar .social-icon-style-1 a, .litho-portfolio-sidebar ul.recent-portfolio-wp-widget li .media-body .recent-portfolio-title', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-portfolio-sidebar a, .litho-portfolio-sidebar .social-icon-style-1 a, .litho-portfolio-sidebar ul.recent-portfolio-wp-widget li .media-body .recent-portfolio-title', function() {
							$( this ).css( 'color', $litho_portfolio_widget_content_link_color );
						});
					});
				}
			});
		});

		/* Portfolio Widget Content Link Hover Color */
		litho_customize( 'litho_portfolio_widget_content_link_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_portfolio_widget_content_link_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-portfolio-sidebar a, .litho-portfolio-sidebar .social-icon-style-1 a, .litho-portfolio-sidebar ul.recent-portfolio-wp-widget li .media-body .recent-portfolio-title', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-portfolio-sidebar a, .litho-portfolio-sidebar .social-icon-style-1 a, .litho-portfolio-sidebar ul.recent-portfolio-wp-widget li .media-body .recent-portfolio-title', function() {
					$( this ).css( 'color', $litho_portfolio_widget_content_link_color );
				});
			});
		});

		/* Portfolio Widget background Color */
		litho_customize( 'litho_portfolio_widget_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-portfolio-sidebar .about-me-wp-widget' ).css( 'background-color', to );
			});
		});

		/* Portfolio Widget border Color */
		litho_customize( 'litho_portfolio_widget_border_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-portfolio-sidebar .about-me-wp-widget, .litho-portfolio-sidebar .widget_search input' ).css( 'border-color', to );
			});
		});

		var $litho_product_widget_content_link_color,
			$litho_product_widget_content_link_hover_color = '';

		/* Product Widget title Color */
		litho_customize( 'litho_product_widget_title_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-product-sidebar .widget-title' ).css( 'color', to );
			});
		});

		/* Product Widget content Color */
		litho_customize( 'litho_product_widget_content_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-product-sidebar p, .litho-product-sidebar .widget, .litho-product-sidebar .about-me-wp-widget .author-name, .litho-product-sidebar .about-me-wp-widget .author-designation' ).css( 'color', to );
			});
		});

		/* Product Widget Content link Color */
		litho_customize( 'litho_product_widget_content_link_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_widget_content_link_color = to;
				$( '.litho-product-sidebar a, .litho-product-sidebar .social-icon-style-1 a, .litho-product-sidebar ul.recent-product-wp-widget li .media-body .recent-product-title' ).css( 'color', to );
				if ( ! $litho_product_widget_content_link_hover_color ) {
					litho_customize( 'litho_product_widget_content_link_hover_color', function( value ) {
						$( document ).on( 'mouseenter', '.litho-product-sidebar a, .litho-product-sidebar .social-icon-style-1 a, .litho-product-sidebar ul.recent-product-wp-widget li .media-body .recent-product-title', function () {
							$( this ).css( 'color', '' );
						}).on( 'mouseleave', '.litho-product-sidebar a, .litho-product-sidebar .social-icon-style-1 a, .litho-product-sidebar ul.recent-product-wp-widget li .media-body .recent-product-title', function() {
							$( this ).css( 'color', $litho_product_widget_content_link_color );
						});
					});
				}
			});
		});

		/* Product Widget Content Link Hover Color */
		litho_customize( 'litho_product_widget_content_link_hover_color', function( value ) {
			value.bind( function( to ) {
				$litho_product_widget_content_link_hover_color = to;
				$( document ).on( 'mouseenter', '.litho-product-sidebar a, .litho-product-sidebar .social-icon-style-1 a, .litho-product-sidebar ul.recent-product-wp-widget li .media-body .recent-product-title', function () {
					$( this ).css( 'color', to );
				}).on( 'mouseleave', '.litho-product-sidebar a, .litho-product-sidebar .social-icon-style-1 a, .litho-product-sidebar ul.recent-product-wp-widget li .media-body .recent-product-title', function() {
					$( this ).css( 'color', $litho_product_widget_content_link_color );
				});
			});
		});

		/* Product Widget background Color */
		litho_customize( 'litho_product_widget_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-product-sidebar .about-me-wp-widget' ).css( 'background-color', to );
			});
		});

		/* Product Widget border Color */
		litho_customize( 'litho_product_widget_border_color', function( value ) {
			value.bind( function( to ) {
				$( '.litho-product-sidebar .about-me-wp-widget, .litho-product-sidebar .widget_search input' ).css( 'border-color', to );
			});
		});

		/* Side Icon Color*/

		litho_customize( 'litho_side_icon_first_button_text_color', function( value ) {
			value.bind( function( to ) {
				$( '.theme-demos .all-demo a' ).css( 'color', to );
			});
		});

		litho_customize( 'litho_side_icon_second_button_text_color', function( value ) {
			value.bind( function( to ) {
				$( '.theme-demos .buy-theme a' ).css( 'color', to );
			});
		});

		/* Side Icon Background Color*/

		litho_customize( 'litho_side_icon_first_button_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.theme-demos .all-demo' ).css( 'background-color', to );
			});
		});

		litho_customize( 'litho_side_icon_second_button_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.theme-demos .buy-theme' ).css( 'background-color', to );
			});
		});

	});

})( jQuery );
