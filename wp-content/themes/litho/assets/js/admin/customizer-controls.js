( function( $ ) {
	 "use strict";

	/**======================START social share drag and drop ===============================**/
	
	$( document ).ready(function() {
		
		if ( $( '.customize-control-checkbox-social' ).length > 0 ) {

			$( '.customize-control-checkbox-social' ).each( function() {
				if ( $( this ).is( ':checked' ) ) {
					$( this ).val(1);
				} else {
					$( this ).val(0);
				}
			} );
			
			$( '.customize-control-checkbox-social' ).on( 'change', function() {
				
				if ( $( this ).is( ':checked' ) ) {
					$( this ).val(1);
				} else {
					$( this ).val(0);
				}

				var arr1 = [];
				var i = 0;

				$( this ).parents( '.litho-post-social-icon-list' ).find( '.customize-control-textbox-social' ).each( function( index ) {
					if ( $( this ).attr( 'data-value' ) != '' ) {
						arr1.push( $( this ).attr( 'data-value' ) );
						arr1.push( $( this ).siblings( '.customize-control-checkbox-social' ).attr( 'value' ) );
						arr1.push( $( this ).attr( 'data-label' ) );
						i++;
					}
				});

				$( this ).parents( '.customize-control' ).find( '.litho-post-social-icon-list' ).val( arr1 ).trigger( 'change' );
			});
		}

		if ( $( '.litho-post-social-icon-list' ).length > 0 ) {

				$( '.litho-post-social-icon-list' ).sortable({
					handle: 'img.icon-move',
					cancel: '',
					update : function () {
						var arr = [];
						var i = 0;
						$( this ).find( '.customize-control-textbox-social' ).each(function( index ) {
							if ( $( this ).attr( 'data-value' ) != '' ) {
								arr.push( $( this ).attr( 'data-value' ) );
								arr.push( $( this ).siblings( '.customize-control-checkbox-social' ).attr( 'value' ) );
								arr.push( $( this ).attr( 'data-label' ) );
								i++;
							}
						});
						$( this ).parents( '.customize-control' ).find( '.litho-post-social-icon-list' ).val( arr ).trigger( 'change' );
				   }
				});
		}
		
		/**======================END social share drag and drop ===============================**/

		$( document ).on( 'click', 'li.litho-switch-option', function( event ) {
			var _parents = $( this ).parent();
			_parents.find( '.active' ).removeClass( 'active' );
			$( this ).addClass( 'active' );
		});
		/**======================END Switch button ===============================**/

		/**======================START Custom Fonts===============================**/

		$( document ).on( 'focus', '.custom-font .font-family', function( event ) {
		  $( this ).removeClass( 'error' );
		});

		$( document ).on( 'change', '.litho_font_upload_button', function( event ) {
			event.preventDefault();

			var _self           = $( this ),
				mime_type       = _self.data( 'mime_type' ),
				font_type       = _self.data( 'font_type' ),
				inputTextField  = _self.parent().parent().find( 'input[type="text"]' ),
				fontFamily      = _self.parents( '.custom-font' ).find( '.font-family' ),
				fontFamily_val  = fontFamily.val();

			var fontTextpattern = /^[a-zA-Z\s-_]+$/; // Allow characters, spaces, dash, underscore

			if ( ! fontTextpattern.test( fontFamily_val ) || fontFamily.length === 0 || fontFamily_val === '' ) {
				
				alert( LithoCustomizer.i18n.error_message );
				
				fontFamily.focus();
				
				return false;

			} else {

				var file_data = _self.prop( 'files' )[0];
				var	form_data = new FormData();
					form_data.append( 'file', file_data );
					form_data.append( 'fontFamily', fontFamily_val );
					form_data.append( 'mime_type', mime_type );
					form_data.append( 'font_type', font_type );
					form_data.append( 'action', 'litho_upload_custom_font_action_data' );

				$.ajax({
					url: LithoCustomizer.ajaxurl,
					type: 'POST',
					contentType: false,
					processData: false,
					data: form_data,
					success: function ( response ) {
						var response = JSON.parse( response );
						if ( response.flag === true ) {
							inputTextField.val('');
							inputTextField.val( response.url );
							customFontValue();
						} else {
							customFontValue();
							alert( response.message );
						}
					}
				});
				return false;
			}
		});
		
		$( document ).on( 'click', '.add_more_fonts', function() {
			var template = wp.template( 'litho-custom-font-repeater' );
			setTimeout( function() {
				var html = template();
				$( '.add-custom-font' ).append( html );
			}, 600 );
		});

		$( document ).on( 'keyup', '.custom-font input', function() {
			customFontValue();
		});

		$( document ).on( 'click', '.remove-custom-font', function() {
			var button          = $( this ),
				fontFamily      = button.parents( '.custom-font' ).find( '.font-family' ),
				fontFamily_val  = fontFamily.val();

			var data = {
				'action'      : 'litho_remove_font_family_action_data',
				'fontfamily'  : fontFamily_val,
			};

			$.post( LithoCustomizer.ajaxurl, data, function( response ) {
				button.parent().parent().remove();
				customFontValue();
			});
		});
		
		function customFontValue( response ) {

			var final_array = [];
			if ( $( '.add-custom-font ul' ).length > 0 ) {
				$( document ).find( '.custom-font' ).each( function() {
					var array = [];
					$( this ).find( 'input[type="text"]' ).each( function() {
						array.push( $( this ).val() );
					});
					final_array.push( array );
					$( this ).parents( '#customize-control-litho_custom_fonts' ).find( 'input[type=hidden]' ).val( JSON.stringify( final_array ) ).trigger( 'change' );
				});
			} else {
				wp.customize.value( 'litho_custom_fonts' )('');
			}
		}

		/**======================END Custom Fonts===============================**/

		/**======================START Multiple Images Upload===============================**/

		$( document ).on( 'click', '.litho_upload_button_multiple_customizer', function( event ) {
			
			var file_frame,
				button = $( this ),
				button_parent = $( this ).parent(),
				id = button.attr( 'id' ).replace( '_button', '' );

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
				multiple: true  // Set to true to allow multiple files to be selected
			});

			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {

				var thumb_hidden    = button_parent.find( '.upload_field_multiple_customizer' ).attr( 'name' ),
					selection       = file_frame.state().get( 'selection' );

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

				var attach_id = [];

				button_parent.find( '.multiple_images' ).each( function() {
					
					if ( $( this ).children().length > 0 ) {
						$( this ).children( 'div' ).each( function() {
							attach_id.push( $( this ).attr( 'id' ) );
						});
					}
				});
				button_parent.find( '.multiple_images' ).parent().parent().find( '.upload_field_multiple_customizer' ).val( attach_id ).trigger( 'change' );
			});
			// Finally, open the modal
			file_frame.open();
		});

		$( document ).on( 'click', '.remove', function() {
			var button_parent = $( this ).parent().parent();
			$( this ).parent().slideUp();
			$( this ).parent().remove();
			var attach_id = [];

			button_parent.each( function() {
				if ( $( this ).children().length > 0 ) {
					$( this ).children( 'div' ).each( function() {
						attach_id.push( $( this ).attr('id') );
					});
				}
			});
			button_parent.parent().parent().find( '.upload_field_multiple_customizer' ).val( attach_id ).trigger( 'change' );
		});

		/**======================END Multiple Images Upload===============================**/

		/**======================START Multiple Checkbox===============================**/

		$( document ).on( 'change', '.customize-control-checkbox-multiple .checkbox-field', function () {
			getcheckedvalue( $( this ) );
		});

		$( document ).on( 'change', '.customize-control-checkbox-multiple .selectall', function () {
			$( this ).parents( '.customize-control-checkbox-multiple' ).find( '.checkbox-field' ).prop( 'checked', this.checked );
			getcheckedvalue( $( this ) );
		});

		$( '.customize-control-checkbox-multiple .checkbox-field' ).each( function( index ) {
			getcheckedvalue( $( this ) );
		});

		function getcheckedvalue( self ) {
			var _parents = self.parents( '.customize-control-checkbox-multiple' );
			if ( _parents.find( '.checkbox-field:checked' ).length === _parents.find( '.checkbox-field' ).length ) {
				_parents.find( '.selectall' ).prop( 'checked', true );
			} else {
				_parents.find( '.selectall' ).prop( 'checked', false );
			}
			var checkbox_values = _parents.find( '.checkbox-field:checked' ).map( function () {
				return $( this ).val();
			}).get();

			self.parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values.join( ',' ) ).trigger( 'change' );
		}

		/**======================END Multiple Checkbox===============================**/

		/**======================START Alpha Color Picker===============================**/
		
		$( document ).on( 'click', '.wp-picker-clear', function( event ) {

			$( this ).parent().find( '.alpha-color-control' ).trigger( 'change' );
		});

		/**======================END Alpha Color Picker===============================**/

		/**======================START Image preview selector ===============================**/

		$( document ).on( 'click', '.litho-image-select img', function() {
			
			var current_click = $( this ),
				_parents = current_click.parent().parent();
				
			_parents.parent().find( '.active' ).removeClass( 'active' );
			_parents.addClass( 'active' );
		});

		/**======================END Image preview selector ===============================**/

		/**======================START Custom sidebars ===============================**/

		if ( $( '#litho_field_add_sidebar' ).length > 0 ) {
			
			var current_val = $( '#litho_field_add_sidebar' ).find( 'input[type=hidden]' ).val();
			var content = null;
			if ( current_val != '' ) {
				var count = current_val.split( "," ).length;
				for( var i=0; i < count; i++ ) {
					var template = wp.template( 'litho-custom-sidebar-repeater' );
					var get_input_val = current_val.split( "," )[i];
					
					content = template( {
						input_val: get_input_val
					} );

					$( '.add-custom-text-box' ).append( content );
				}
			}
		}
		
		$( document ).on( 'click', '.add_more_sidebar', function() {
			var template = wp.template( 'litho-custom-sidebar-repeater' );
			var content = null;
			content = template( {
				input_val: ''
			} );
			$( '.add-custom-text-box' ).append( content );
		});
		
		$( document ).on( 'keyup', '.add-text-input', function() {
			display();
		});

		$( document ).on( 'click', '.remove-text-box', function() {
			$( this ).parent().remove();
			display();
		});

		function display() {
			var array = [];
			if ( $( '.add-custom-text-box li' ).length > 0 ) {
				$( '.add-text-input' ).each( function( index ) {
					array.push( $( this ).val() );
					$( this ).parents( '#customize-control-litho_custom_sidebars' ).find( 'input[type=hidden]' ).val( array ).trigger( 'change' );
				});
			} else {
				wp.customize.value( 'litho_custom_sidebars' )( '' );
			}
		}

		/**======================END Custom sidebars ===============================**/

	} );

} )( jQuery );