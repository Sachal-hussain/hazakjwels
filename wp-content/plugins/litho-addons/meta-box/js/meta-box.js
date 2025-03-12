( function( $ ) {

	"use strict";

	$( window ).on( 'load', function () {
		
		if ( $( '.litho_meta_box_tab' ).hasClass( 'active' ) ) {
			$( '.litho_meta_box_tab' ).find( '.separator_box:first' ).addClass( 'active' );
			$( '.litho_meta_box_tab' ).find( '.separator_start_content_wrap:first' ).css( 'display','block' );
		}
	});

	$( document ).ready(function() {

		$( document ).on( 'click', '.litho_upload_button_category', function( event ) {
			var file_frame;
			var button = $( this );
			var button_parent = $( this ).parent();
			var id = button.attr('id').replace( '_button_category', '' );
			
			event.preventDefault();
		  

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: $( this ).data( 'uploader_title' ),
				button: {
				  text: $( this ).data( 'uploader_button_text' ),
				},
				multiple: false  // Set to true to allow multiple files to be selected
			});

		  	// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				var full_attachment = file_frame.state().get( 'selection' ).first().toJSON();

				var attachment = file_frame.state().get('selection').first();

				var thumburl = attachment.attributes.sizes.thumbnail;
				var thumb_hidden = button_parent.find( '.upload_field' ).attr('name');

				if ( thumburl || full_attachment ) {
					button_parent.find( '#' + id ).val( full_attachment.url );
					button_parent.find( '.' + thumb_hidden + '_thumb' ).val( full_attachment.url );
					
					button_parent.find( '.upload_image_screenshort' ).attr( 'src', full_attachment.url );
					button_parent.find( '.upload_image_screenshort' ).slideDown();
				}
			});

			// Finally, open the modal
			file_frame.open();
	 	});

		/* multiple image upload */
		$( document ).on( 'click', '.litho_upload_button_multiple_category', function( event ) {
			var file_frame;
			var button = $( this );
			var button_parent = $( this ).parent();
			var id = button.attr( 'id' ).replace( '_button_category', '' );
			var app=[];
			event.preventDefault();

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: $( this ).data( 'uploader_title' ),
				button: {
					text: $( this ).data( 'uploader_button_text' ),
				},
				multiple: true  // Set to true to allow multiple files to be selected
			});

			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {

				var thumb_hidden = button_parent.find( '.upload_field_multiple' ).attr( 'name' );
			 
				var selection = file_frame.state().get( 'selection' );
				var app=[];
					selection.map( function( attachment ) {
					var attachment = attachment.toJSON();
					var imageHTML = '';
						imageHTML += '<div id="';
						imageHTML += attachment.id;
						imageHTML += '">';
						imageHTML += '<img src="';
						imageHTML += attachment.url;
						imageHTML += '" class="upload_image_screenshort_multiple" alt="" style="width:100px;"/>';
						imageHTML += '<a href="javascript:void(0)" class="remove">remove</a>';
						imageHTML += '</div>';
					button_parent.find( '.multiple_images' ).append( imageHTML );
				});
			});
			// Finally, open the modal
			file_frame.open();
		});

		// Remove button function to remove attach image and hide screenshort Div.
		$( document ).on( 'click', '.litho_remove_button_category', function( event ) {
			var remove_parent = $( this ).parent();
			remove_parent.find( '.upload_field' ).val( '' );
			remove_parent.find( 'input[type="hidden"]' ).val( '' );
			remove_parent.find( '.upload_image_screenshort' ).slideUp();
		});

		// On page load add all image url to show in screenshort.
		if ( $( '.upload_field' ).length > 0 ) {
			$( '.upload_field' ).each( function() {
			if ( $( this ).val() ) {
				$( this ).parent().find( '.upload_image_screenshort' ).attr( 'src', $( this ).val() );
			} else {
				$( this ).parent().find( '.upload_image_screenshort' ).hide();
			}
			});
		}

		$( '.button-primary' ).on( 'click', function() {
			var pr_div;
			if ( $( '.multiple_images' ).length > 0 ) {
			  	$( '.multiple_images' ).each( function() {
					if ( $( this ).children().length > 0 ) {
					  var attach_id = [];
					  var pr_div = $( this ).parent();
					  $( this ).children( 'div' ).each( function() {
							attach_id.push( $( this ).attr( 'id' ) );
					  });
					  
						pr_div.find( '.upload_field_multiple' ).val( attach_id );
					}else{
					  	$( this ).parent().find( '.upload_field_multiple' ).val( '' );
					}
				});
			}
		});

		$( document ).on( 'click', '.litho_tab_reset_settings', function() {

			var reset_message = LithoMetabox.i18n.reset_message,
				reset_name    = $( this ).attr( 'reset_key' );
				reset_message = reset_message.replace( /###|_/g, reset_name );

			var flag = confirm( reset_message );
				
			if ( flag ) {

				var reset_tab = $( this ).parents( '.litho_meta_box_tab' );

				// for input type text field
				reset_tab.find( 'input[type="text"]' ).val( '' );

				// for textarea
				reset_tab.find( 'textarea' ).val( '' );

				// for select
				reset_tab.find( 'select' ).val( 'default' );

				// for colorpicker
				reset_tab.find( '.wp-color-result' ).attr( 'style', '' );

				// for input type hidden field
				reset_tab.find( 'input[type="hidden"]' ).val( '' );

				// for image upload field
				reset_tab.find( '.litho_remove_button, .multiple_images .remove' ).trigger( 'click' );
			}
		} );

		if ( $( '.litho_meta_box_tab' ).hasClass( 'active' ) ) {

			$( '.litho_meta_box_tab' ).find( '.separator_box:first' ).addClass( 'active' );
		}

		$( document ).on( 'click', '.separator_box', function() {

			if ( $( this ).hasClass( 'active' ) ) {
				
				$( this ).parents( '.separator_main_start_main_content_wrap' ).find( '.active' ).removeClass( 'active' );

			} else {

				$( this ).parents( '.separator_main_start_main_content_wrap' ).find( '.active' ).removeClass( 'active' );
				$( this ).toggleClass( 'active' );
			}
		});

		// Check on load for selected tab when user come before if not it show first one active
		if ( $.cookie( 'litho_metabox_active_id_' + $( '#post_ID' ).val() ) ) {
			
			var active_class = $.cookie( 'litho_metabox_active_id_' + $( '#post_ID' ).val() );

			$( '#litho_admin_options' ).find( '.litho_meta_box_tabs li' ).removeClass( 'active' );
			$( '#litho_admin_options' ).find( '.litho_meta_box_tab' ).removeClass( 'active' ).hide();

			$( '.' + active_class ).addClass( 'active' ).fadeIn();
			$( '#litho_admin_options' ).find( '#' + active_class ).addClass( 'active' ).fadeIn();
		} else {
			
			$( '.litho_meta_box_tabs li:first-child' ).addClass( 'active' );
			$( '.litho_meta_box_tab_content .litho_meta_box_tab:first-child' ).addClass( 'active' ).fadeIn();
		}
		
		$( '.litho_meta_box_tabs li a' ).on( 'click', function( e ) {
			e.preventDefault();

			var tab_click_id = $( this ).parent().attr( 'class' ).split( ' ' )[0];
			var tab_main_div = $( this ).parents( '#litho_admin_options' );

			$.cookie( 'litho_metabox_active_id_' + $( '#post_ID' ).val(), tab_click_id, { expires: 7 } );
			
			tab_main_div.find( '.litho_meta_box_tabs li' ).removeClass( 'active' );

			tab_main_div.find( '.litho_meta_box_tab' ).removeClass( 'active' ).hide();

			$( this ).parent().addClass( 'active' ).fadeIn();
			tab_main_div.find( '#' + tab_click_id ).addClass( 'active' ).fadeIn();

		} );

		/* Metabox dependance of fields */
		$( '.litho_select_parent' ).on( 'change', function () {
			var str_selected           = $( this ).find( 'option:selected' ).val(),
				tab_active_status_main = $( this ).parents( '#litho_admin_options' );

			$( '.hide_dependent' ).find( 'input[type="hidden"]' ).val( '0' );
			tab_active_status_main.find( '.hide_dependent' ).addClass( 'hide_dependency' );

			if ( tab_active_status_main.find( '.hide_dependency' ).hasClass( str_selected + '_single' ) ) {
				tab_active_status_main.find( '.' + str_selected + '_single' ).removeClass( 'hide_dependency' );
				tab_active_status_main.find( '.' + str_selected + '_single' ).find( 'input[type="hidden"]' ).val( '1' );
			}
			
			/* Special case for Both sidebar*/ 
			if ( 'litho_layout_both_sidebar' == str_selected ) {

				$( '.litho_layout_left_sidebar_single' ).removeClass( 'hide_dependency' );
				$( '.litho_layout_left_sidebar_single' ).find( 'input[type="hidden"]' ).val( '1' );
				$( '.litho_layout_right_sidebar_single' ).removeClass( 'hide_dependency' );
				$( '.litho_layout_right_sidebar_single' ).find( 'input[type="hidden"]' ).val( '1' );
			}
		} );

		$( '#litho_layout_settings_single' ).on( 'change', function () {

			var str_selected 		= $( this ).find( 'option:selected' ).val(),
				str_selected_parent = $( this ).parents( '#litho_tab_layout_settings' );

			str_selected_parent.find( '.hide-child' ).addClass( 'hide-children' );
			str_selected_parent.find( '.' + str_selected + '_single_box' ).removeClass( 'hide-children' );
			str_selected_parent.find( '.' + str_selected + '_single_box' ).addClass( 'show-children' );

		} );

		/* Dependency */
		$( '.description_box, .separator_box' ).each( function() {

			if ( $( this ).attr( 'data-element' ) && $( this ).attr( 'data-value' ) ) {
				
				var data_val     = $( this ).attr( 'data-value' ),
					data_val_arr = data_val.split( ',' ),
					data_element = $( this ).attr( 'data-element' ),
					current      = $( this );

				$( document ).on( 'change', '#' + $( this ).attr( 'data-element' ), function () {
					var val = $( this ).val();
					if ( $.inArray( val, data_val_arr ) !== -1 ) {
						$( current ).removeClass( 'hidden' );
					} else {
						$( current ).addClass( 'hidden' );
					}
				} );

				if ( $.inArray( $( '#' + data_element ).val(), data_val_arr ) !== -1 ) {
					$( current ).removeClass( 'hidden' );
				} else {
					$( current ).addClass( 'hidden' );
				}
			}
		} );
		/* End Dependency */

		// Change template selection notice
		$( document ).on( 'change', 'select[name="litho_section_builder_template"]', function() {
			var _selfValue = $( this ).val(),
				_parents   = $( this ).parents( '.litho_meta_box_tab_content_single' );

			_parents.find( '.litho_section_builder_template_settings_box .template-notice' ).addClass( 'hidden' );
			_parents.find( '.litho_section_builder_template_settings_box ' + '.' + _selfValue ).removeClass( 'hidden' );
		});
		
		/* Image Upload Button Click*/
		$( document ).on( 'click', '.litho_upload_button', function( event ) {
			
			var file_frame,
				button = $( this ),
				button_parent = $( this ).parent(),
				id = button_parent.find( '.upload_field' ).attr( 'class' );
				
				event.preventDefault();

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media( {
				title: $( this ).data( 'uploader_title' ),
				button: {
					text: $( this ).data( 'uploader_button_text' ),
				},
				multiple: false  // Set to true to allow multiple files to be selected
			} );

			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				var full_attachment = file_frame.state().get( 'selection' ).first().toJSON(),
					attachment      = file_frame.state().get( 'selection' ).first(),
					thumburl        = attachment,
					thumb_hidden    = button_parent.find( '.upload_field' ).attr( 'name' );

				if ( thumburl || full_attachment ) {
					button_parent.find( '.' + id ).val( full_attachment.url );
					button_parent.find( '.' + thumb_hidden + '_id' ).val( full_attachment.id );
					button_parent.find( '.upload_image_screenshort' ).attr( 'src', full_attachment.url );
					button_parent.find( '.upload_image_screenshort' ).slideDown();
				}
			} );

			// Finally, open the modal
			file_frame.open();
		} );
		
		// Remove button function to remove attach image and hide screenshort Div.
		$( document ).on( 'click', '.litho_remove_button', function( event ) {
			
			var remove_parent = $( this ).parent();
			remove_parent.find( '.upload_field' ).val( '' );
			remove_parent.find( 'input[type="hidden"]' ).val( '' );
			remove_parent.find( '.upload_image_screenshort' ).slideUp();
		} );

		/* Color picker for meta  */
		var link_color = $( '.litho-color-picker' );
		if ( link_color.length > 0 ) {
			link_color.each( function () {
				$( this ).alphaColorPicker();
			} );
		}

		/* Image Sortable */
		if ( $( '.multiple_images' ).length > 0 ) {
			$( '.multiple_images' ).sortable();
		}

		if ( $( 'body' ).hasClass( 'block-editor-page' ) ) {

			/* multiple image upload */
			$( document ).on( 'click', '.litho_upload_button_multiple', function( event ) {
				
				var file_frame,
					button = $( this ),
					button_parent = $( this ).parent(),
					id = button.attr( 'id' ).replace( '_button', '' ),
					app = [];
					event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: $( this ).data( 'uploader_title' ),
					button: {
						text: $( this ).data( 'uploader_button_text' ),
					},
					multiple: true  // Set to true to allow multiple files to be selected
				} );

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {

					var thumb_hidden = button_parent.find( '.upload_field' ).attr( 'name' ),
						selection    = file_frame.state().get( 'selection' ),
						app          = [];

					selection.map( function( attachment ) {
						
						var attachment = attachment.toJSON();
							button_parent.find( '.multiple_images' ).append( '<div id="' + attachment.id + '"><img src="' + attachment.url + '" class="upload_image_screenshort_multiple" alt="" style="width:100px;"/><a href="javascript:void(0)" class="remove">remove</a></div>' );

						$( '.multiple_images' ).each( function() {

							if ( $( this ).children().length > 0 ) {
								var attach_id = [],
									pr_div    = $( this ).parent();

								$( this ).children( 'div' ).each( function() {
									attach_id.push( $( this ).attr( 'id' ) );
								} );

								pr_div.find( '.upload_field' ).val( attach_id );
							} else {
								$( this ).parent().find( '.upload_field' ).val( '' );
							}
						} );
					} );
				} );
				// Finally, open the modal
				file_frame.open();
			} );

			$( '.multiple_images' ).on( 'click', '.remove', function() {

				var remove_Item = $( this ).parent().attr( 'id' );

				$( '.multiple_images' ).each( function() {

					if ( $( this ).children().length > 0 ) {
						var attach_id = [],
							pr_div    = $( this ).parent();
						$( this ).children( 'div' ).each( function() {
								attach_id.push( $( this ).attr( 'id' ) );
						} );
						attach_id = $.grep( attach_id, function( value ) {
							return value != remove_Item;
						} );
						pr_div.find( '.upload_field' ).val( attach_id );
					} else {
						$( this ).parent().find( '.upload_field' ).val( '' );
					}
				} );

				$( this ).parent().slideUp();
				$( this ).parent().remove();
			} );

			/* multiple image upload End */

			/*==============================================================*/
			// Post Format Meta Start
			/*==============================================================*/
			function post_format_selection_options( format_val ) {

				setTimeout( function() {
					$( 'body.post-type-portfolio select[id^="post-format-selector"] option[value="gallery"]' ).remove();
					$( 'body.post-type-portfolio select[id^="post-format-selector"] option[value="video"]' ).remove();
					$( 'body.post-type-portfolio select[id^="post-format-selector"] option[value="image"]' ).remove();
					$( 'body.post-type-portfolio select[id^="post-format-selector"] option[value="quote"]' ).remove();
					$( 'body.post-type-portfolio select[id^="post-format-selector"] option[value="audio"]' ).remove();
				}, 500);
				
				if ( format_val == 'link' ) {
					
					$( '.litho_portfolio_external_link_single_box' ).fadeIn();
				} else {

					$( '.litho_portfolio_external_link_single_box' ).hide();
				}
				
				$( 'body.post-type-post #litho_admin_options_single' ).hide();

				if ( format_val == 'gallery' ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).fadeIn();
					$( '.litho_lightbox_image_single_box' ).fadeIn();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					
				} else if ( format_val == 'video' ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).fadeIn();
					$( '.litho_video_ogg_single_box' ).fadeIn();
					$( '.litho_video_webm_single_box' ).fadeIn();
					$( '.litho_video_single_box' ).fadeIn();
					$( '.litho_video_type_single_box' ).fadeIn();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).fadeIn();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					post_format_video_selection();

				} else if ( format_val == 'audio' ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );


				} else if ( format_val == 'quote' ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).fadeIn();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					
				} else if ( format_val == 'image' ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_image_single_box' ).fadeIn();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					
				} else {

					$( 'body.post-type-post #litho_admin_options_single' ).hide();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );

				}
			}

			post_format_selection_options( $( 'select[id^="post-format-selector"]' ).val() );
			
			setTimeout( function() {
				$( 'select[id^="post-format-selector"]' ).on( 'change', function() {
					post_format_selection_options( this.value );
				} );
				post_format_selection_options( $( 'select[id^="post-format-selector"]' ).val() );

				$( '.edit-post-sidebar__panel-tab[data-label="Portfolio"]' ).on( 'click', function() {
					post_format_selection_options();
				} );

			}, 500);

			let previousValue = '';
			function checkButtonValue() {
				const labels = document.querySelectorAll( '.editor-post-panel__row-label' );
				labels.forEach( label => {
					if ( label.textContent.trim() === 'Format' ) {
						const row = label.closest( '.editor-post-panel__row' );
						if ( row ) {
							const button = row.querySelector( '.components-button' );
							if ( button ) {
								const currentValue = button.textContent.trim().toLowerCase();
								if ( currentValue !== previousValue ) {
									previousValue = currentValue;
									post_format_selection_options( previousValue );
								}
							}
						}
					}
				});
			}

			// Poll every second
			setInterval( checkButtonValue, 1000 );

			/*==============================================================*/
			// Post Format Meta End
			/*==============================================================*/

		} else {
			
			/* multiple image upload */
			$( document ).on( 'click', '.litho_upload_button_multiple', function( event ) {

				var file_frame,
					button = $( this ),
					button_parent = $( this ).parent(),
					id = button.attr( 'id' ).replace( '_button', '' ),
					app = [];

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: $( this ).data( 'uploader_title' ),
					button: {
						text: $( this ).data( 'uploader_button_text' ),
					},
					multiple: true  // Set to true to allow multiple files to be selected
				} );

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {

					var thumb_hidden = button_parent.find( '.upload_field_multiple' ).attr( 'name' ),
						selection    = file_frame.state().get( 'selection' ),
						app          = [];

					selection.map( function( attachment ) {
						var attachment = attachment.toJSON();
						button_parent.find( '.multiple_images' ).append( '<div id="' + attachment.id + '"><img src="' + attachment.url + '" class="upload_image_screenshort_multiple" alt="" style="width:100px;"/><a href="javascript:void(0)" class="remove">remove</a></div>' );
					} );
				} );
				// Finally, open the modal
				file_frame.open();
			} );

			$( '.button-primary' ).on( 'click', function() {
				var pr_div;
				$( '.multiple_images' ).each( function() {
				  if ( $( this ).children().length > 0 ) {
					var attach_id = [];
					var pr_div = $( this ).parent();
					$( this ).children( 'div' ).each( function() {
						attach_id.push( $( this ).attr( 'id' ) );
					} );
					
					pr_div.find( '.upload_field_multiple' ).val( attach_id );
				  } else {
					$( this ).parent().find( '.upload_field_multiple' ).val( '' );
				  }
				} );
			} );

			$( '.multiple_images' ).on( 'click', '.remove', function() {
				$( this ).parent().slideUp();
				$( this ).parent().remove();
			} );
			/* multiple image upload End */

			/*==============================================================*/
			// Post Format Meta Start
			/*==============================================================*/

			function post_format_selection_options() {
					
				//Hide Link Format in Post type
				$( 'body.post-type-portfolio #post-format-gallery, body.post-type-portfolio .post-format-gallery' ).hide();
				$( 'body.post-type-portfolio #post-format-video, body.post-type-portfolio .post-format-video' ).hide();
				$( 'body.post-type-portfolio #post-format-image, body.post-type-portfolio .post-format-image' ).hide();
				$( 'body.post-type-portfolio #post-format-quote, body.post-type-portfolio .post-format-quote' ).hide();
				$( 'body.post-type-portfolio #post-format-audio, body.post-type-portfolio .post-format-audio' ).hide();

				$( 'body.post-type-portfolio .post-format-quote' ).next( 'br' ).hide();
				$( 'body.post-type-portfolio .post-format-gallery' ).next( 'br' ).hide();
				$( 'body.post-type-portfolio .post-format-image' ).next( 'br' ).hide();
				$( 'body.post-type-portfolio .post-format-video' ).next( 'br' ).hide();
				$( 'body.post-type-portfolio .post-format-audio' ).next( 'br' ).hide();

				if ( $( '#post-format-link' ).is( ':selected' ) ) {

					$( '.litho_portfolio_external_link_single_box' ).fadeIn();
				} else {
					$( '.litho_portfolio_external_link_single_box' ).hide();
				}
				
				$( 'body.post-type-post #litho_admin_options_single' ).hide();

				if ( $( '#post-format-gallery' ).is( ':checked' ) ) {
					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).fadeIn();
					$( '.litho_lightbox_image_single_box' ).fadeIn();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );

				} else if ( $( '#post-format-video' ).is( ':checked' ) ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).fadeIn();
					$( '.litho_video_ogg_single_box' ).fadeIn();
					$( '.litho_video_webm_single_box' ).fadeIn();
					$( '.litho_video_single_box' ).fadeIn();
					$( '.litho_video_type_single_box' ).fadeIn();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).fadeIn();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					post_format_video_selection();

				} else if ( $( '#post-format-audio' ).is( ':checked' ) ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );

				} else if ( $( '#post-format-quote' ).is( ':checked' ) ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).fadeIn();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					
				} else if ( $( '#post-format-image' ).is( ':checked' ) ) {

					$( 'body.post-type-post #litho_admin_options_single' ).show();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_image_single_box' ).fadeIn();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					
				} else {

					$( 'body.post-type-post #litho_admin_options_single' ).hide();
					$( '.litho_gallery_single_box' ).hide();
					$( '.litho_lightbox_image_single_box' ).hide();
					$( '.litho_quote_single_box' ).hide();
					$( '.litho_link_type_single_box' ).hide();
					$( '.litho_link_single_box' ).hide();
					$( '.litho_video_mp4_single_box' ).hide();
					$( '.litho_video_ogg_single_box' ).hide();
					$( '.litho_video_webm_single_box' ).hide();
					$( '.litho_video_single_box' ).hide();
					$( '.litho_video_type_single_box' ).hide();
					$( '.litho_audio_single_box' ).hide();
					$( '.litho_enable_mute_single_box' ).hide();
					$( '.litho_featured_image_single_box' ).fadeIn();
					$( '.litho_subtitle_single_box' ).fadeIn();
					$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
					$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
				}
			}

			post_format_selection_options();

			var select_type = $( '#post-formats-select input' );

			$( this ).on( 'change', function() {
				post_format_selection_options();
			} );

			$( '.edit-post-sidebar__panel-tab[data-label="Portfolio"]' ).on( 'click', function() {
				post_format_selection_options();
			} );

			/*==============================================================*/
			// Post Format Meta End
			/*==============================================================*/
		}

		// Post format change in Portfolio
		if ( $( 'body' ).hasClass( 'post-type-portfolio' ) ) {
			
			setTimeout( function() {
				
				var defaultPortfolioSelect = $( '.post-type-portfolio .editor-post-format select' ).val();

				if ( defaultPortfolioSelect == 0 ) {
					defaultPortfolioSelect = 'standard';
				}

				$( '#litho_portfolio_post_type_single' ).val( defaultPortfolioSelect );

				$( '.post-type-portfolio' ).on( 'click', '.editor-post-format select', function() {

					var clickVal = $( this ).val();

					if ( clickVal == 'link' ) {

						$( '#litho_portfolio_post_type_single' ).val( clickVal );

					} else {

						$( '#litho_portfolio_post_type_single' ).val( 'standard' );
					}
				});

			}, 500 );
		}

		// To add alternate image for portfolio
		$( document ).on( 'click', '.portfolio-alternate-add-media', function( event ) {
			event.preventDefault();

			var id      = $( this ).data( 'id' );
			var postid  = $( this ).data( 'postid' );
			var title   = $( this ).data( 'title' );
			var button  = $( this ).data( 'button' );
			var nonce   = $( this ).data( 'nonce' );

			// Create file frame.
			var file_frame = wp.media.frames.file_frame = wp.media( {
				title: title,
				button: {
					text: button
				},
				multiple: false  // Set to true to allow multiple files to be selected
			});

			// Hande file frame event
			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get( 'selection' ).first().toJSON();

				$.post( ajaxurl, {
					action: 'set_portfolio_alternate_image',
					alt_img_id: attachment.id,
					postid: postid,
					id: id,
					sec: nonce
				}, function( response ) {
					if ( response ) {
						$( '.portfolio-alternate-image-container-' + id + ' a' ).html( response );
						$( '.hide-if-no-image-' +  id ).show();
						$( '.hide-if-no-image-' +  id ).parent().find( '.howto' ).show();
					}
				});
			});

			// Open file frame
			file_frame.open();
		});

		// To remove alternate image for portfolio
		$( document ).on( 'click', '.portfolio-alternate-media-delete', function( event ) {
			event.preventDefault();

			var id        = $( this ).data( 'id' );
			var postid    = $( this ).data( 'postid' );
			var nonce     = $( this ).data( 'nonce' );
			var label_set = $( this ).data( 'label_set' );

			$.post( ajaxurl, {
				action: 'remove_portfolio_alternate_image',
				postid: postid,
				id: id,
				label_set: label_set,
				sec: nonce
			}, function( response ) {
			   $( '.portfolio-alternate-image-container-' + id + ' a' ).html( response );
			   $( '.hide-if-no-image-' +  id ).hide();
			   $( '.hide-if-no-image-' +  id ).parent().find( '.howto' ).hide();
			});
		});

		/* To add alternate image for product */
		$( document ).on( 'click', '.litho-product-alternate-add-media', function( event ) {
			event.preventDefault();

			var id      = $( this ).data( 'id' );
			var postid  = $( this ).data( 'postid' );
			var title   = $( this ).data( 'title' );
			var button  = $( this ).data( 'button' );
			var nonce   = $( this ).data( 'nonce' );

			// Create file frame.
			var file_frame = wp.media.frames.file_frame = wp.media({
				title: title,
				button: {
					text: button
				},
				multiple: false  // Set to true to allow multiple files to be selected
			});

			// Hande file frame event
			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get( 'selection' ).first().toJSON();

				$.post( ajaxurl, {
					action: 'set_product_alternate_image',
					alt_img_id: attachment.id,
					postid: postid,
					id: id,
					sec: nonce
				}, function( response ) {
					if ( response ) {
						
						$( '.litho-product-alternate-image-container-' + id + ' a' ).html( response );

						$( '.hide-if-no-image-' +  id).show();
						$( '.hide-if-no-image-' +  id).parent().find( '.howto' ).show();
					}
				});
			});

			// Open file frame
			file_frame.open();
		});
		/* END to add alternate image for product */

		/* To remove alternate image for product */
		$( document ).on( 'click', '.litho-product-alternate-media-delete', function( event ) {
			event.preventDefault();

			var id        = $( this ).data( 'id' );
			var postid    = $( this ).data( 'postid' );
			var nonce     = $( this ).data( 'nonce' );
			var label_set = $( this ).data( 'label_set' );

			$.post( ajaxurl, {
				action: 'remove_product_alternate_image',
				postid: postid,
				id: id,
				label_set: label_set,
				sec: nonce
			}, function( response ) {
			   $( '.litho-product-alternate-image-container-' + id + ' a' ).html( response );

			   $( '.hide-if-no-image-' +  id ).hide();
			   $( '.hide-if-no-image-' +  id ).parent().find( '.howto' ).hide();
			});
		});
		/* END to remove alternate image for product */

		/*==============================================================*/
		// Video Post Format Meta End
		/*==============================================================*/

		$( '#litho_video_type_single' ).on( 'change', function() {
			post_format_video_selection();
		} );

		function post_format_video_selection() {

			if ( $( '#litho_video_type_single' ).val() == 'self' && ( $( '#post-format-video' ).is( ':checked' ) || $( 'select[id^="post-format-selector"]' ).val() == 'video' ) ) {

				$( '.litho_enable_mute_single_box' ).addClass( 'show_div' ).removeClass( 'hide_div' ).show();
				$( '.litho_video_mp4_single_box' ).addClass( 'show_div' ).removeClass( 'hide_div' ).show();
				$( '.litho_video_ogg_single_box' ).addClass( 'show_div' ).removeClass( 'hide_div' ).show();
				$( '.litho_video_webm_single_box' ).addClass( 'show_div' ).removeClass( 'hide_div' ).show();
				$( '.litho_video_single_box' ).removeClass( 'show_div' ).addClass( 'hide_div' ).show();

			} else if ( $( '#litho_video_type_single' ).val() == 'external' && ( $( '#post-format-video' ).is( ':checked' ) || $( 'select[id^="post-format-selector"]' ).val() == 'video' ) ) {

				$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).addClass( 'hide_div' ).hide();
				$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).addClass( 'hide_div' ).hide();
				$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).addClass( 'hide_div' ).hide();
				$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).addClass( 'hide_div' ).hide();
				$( '.litho_video_single_box' ).addClass( 'show_div' ).removeClass( 'hide_div' ).hide();
			} else  {
				$( '.litho_enable_mute_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
				$( '.litho_video_mp4_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
				$( '.litho_video_ogg_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
				$( '.litho_video_webm_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
				$( '.litho_video_single_box' ).removeClass( 'show_div' ).removeClass( 'hide_div' );
			}
		}
		/*==============================================================*/
		// Video Post Format Meta End
		/*==============================================================*/

	} );

})( jQuery );
