( function( $ ) {
	
	"use strict";

		if ( $( '.litho-dropdown-select2' ).length > 0 ) {
			$( '.litho-dropdown-select2' ).select2( {
				placeholder: LithoBuilder.i18n.placeholder
			});
		}

		$( window ).on( 'load', function( e ) {
			hashChange();
		} );


		$( '#menu-posts-sectionbuilder ul.wp-submenu li:nth-child(3)' ).on( 'click', function() {

			$( window ).on( 'hashchange', function() {
				hashChange();
			} );
		} );

		$( '.page-title-action:first' ).on( 'click', function() {

			if ( $( '.sectionbuilder-form-field-select' ).length > 0 ) {
				$( '.sectionbuilder-form-field-select' ).trigger( 'click' );
			}

			showModal();
			return false;
		} );

		$( '.sectionbuilder-outer .close' ).on( 'click', function() {

			$( '.sectionbuilder-outer' ).fadeOut( 'slow' );
		} );

		$( document ).on( 'click', '.sectionbuilder-form-field-select', function( event ) {
			
			var _self         = $( this ),
				_parents      = $( this ).parents( '.sectionbuilder-inner' ),
				template_type = _self.val();

			if ( 'undefined' === typeof template_type || '' === template_type ) {
				return;
			}

			_parents.find( '.input-field-control' ).hide();
			_parents.find( '.' + template_type + '-form-field' ).show();
		});

		$( document ).on( 'click', '.create-template-button', function( event ) {
			event.preventDefault();

			var template_type          = $( '.sectionbuilder-new-template-form .sectionbuilder-form-field-select option' ).filter( ':selected' ).val(),
				template_style         = $( '.sectionbuilder-new-template-form .sectionbuilder-form-field-select-style option' ).filter( ':selected' ).val(),
				archive_type           = $( '.sectionbuilder-new-template-form .sectionbuilder-form-field-archive-style' ).select2().val(),
				archive_portfolio_type = $( '.sectionbuilder-new-template-form .sectionbuilder-form-field-archive-portfolio-style' ).select2().val(),
				template_title         = $( '.sectionbuilder-new-template-form .sectionbuilder-new-template-form-post-title' ).val();

			if ( 0 === archive_type.length ) {
				archive_type = [ 'general' ];
			}

			if ( 'undefined' === typeof template_type || '' === template_type ) {
				return;
			}

			$.ajax( {
				type: 'POST',
				url: LithoBuilder.ajaxurl,
				data: {
					'action': 'litho_section_builder_lightbox',
					'sectionbuilder_template_type': template_type,
					'sectionbuilder_template_style': template_style,
					'sectionbuilder_template_archive': archive_type,
					'sectionbuilder_template_archive_portfolio': archive_portfolio_type,
					'sectionbuilder_template_title': template_title
				},
				success: function( response ) {
					if ( 0 === response.length ) {
						alert( LithoBuilder.i18n.responseErrorMessage );
					} else {
						window.location.href = response;
					}
				}
			} );
			return false;
		} );

		function hashChange() {
			if ( '#add_new' === location.hash ) {
				showModal();
				location.hash = '';
			}
		}
		function showModal() {
			$( '.sectionbuilder-outer' ).fadeIn( 'slow' );
			return false;
		}
}( jQuery ));