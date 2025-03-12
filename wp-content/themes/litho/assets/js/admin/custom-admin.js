! function( $ ) {
	
	"use strict";

	$( document ).ready(function() {

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

		$( '.multiple_images' ).on( 'click', '.remove', function() {
		 	$( this ).parent().slideUp();
		  	$( this ).parent().remove();
		});
		
        /* Licence - START CODE */
        $( document ).on( 'click', '#litho_license_btn', function(e) {
            e.preventDefault();

            var _this           = $( this ),
            	unregisterObj 	= _this.parents( '.litho-license-form-wrapper' ).find( '#litho_purchase_code_unregister' ),
                purchaseCodeObj = _this.parents( '.litho-license-form-wrapper' ).find( '#litho_purchase_code' ),
                responseMsgObj  = _this.parents( '.litho-license-form-wrapper' ).find( '#litho_response_msg' ),
                purchaseCodeVal = purchaseCodeObj.val(),
                unregisterVal 	= unregisterObj.val();

            if ( _this.attr( 'disabled' ) ) {
                return false;
            }

            // Confirm for deactivate license
            if ( '1' == unregisterVal ) {
				var r = confirm( LithoCustomAdmin.confirm_deactivate );
				if ( r == false ) {
					return false;
				}
            }

            if ( '' == purchaseCodeVal ) {
                responseMsgObj.html( LithoCustomAdmin.empty_purchase_code );
                purchaseCodeObj.addClass( 'error' );
                return false;
            }

            // Show loader
            _this.addClass( 'loading' ).attr( 'disabled' );

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data : {
                    action 			: 'litho_active_theme_license',
                    purchase_code 	: purchaseCodeVal,
                    unregister 		: unregisterVal
                },
                success: function( response ) {

                    response = JSON.parse( response );

                    if ( response && response.status ) {

                    	window.location = response.url
                    	
                    } else {

                    	alert( response.message );

						// Hide loader
						_this.removeClass( 'loading' ).removeAttr( 'disabled' );
                    }
                },
                fail: function( jqXHR, textStatus ) {
                    // Hide loader
                    _this.removeClass( 'loading' ).removeAttr( 'disabled' );

                    alert( 'Request failed: ' + textStatus );
                }
            });
        });
        /* Licence - END CODE */
	});

}( window.jQuery );