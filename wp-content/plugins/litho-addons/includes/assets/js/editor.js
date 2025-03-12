( function( $ ) {

	"use strict";

	var customFonts   = [];
	var customTypekit = false;

	var LithoEditor = {

		init: function() {
			window.elementor.on( 'preview:loaded', LithoEditor.onPreviewLoaded );
			window.elementor.channels.editor.on( 'font:insertion', LithoEditor.onFontChange );
			window.elementor.on( 'panel:init', LithoEditor.addMenuItems );
		},
		onPreviewLoaded: function() {

			elementorFrontend.hooks.addAction( 'frontend/element_ready/litho-tabs.default', function( $scope ) {
				$scope.find( '.edit-template-with-light-box' ).on( 'click', LithoEditor.showTemplatesModal );
				$scope.find( '.elementor-custom-new-template-link' ).on( 'click', function( event ) {
					window.location.href = $( this ).attr( 'href' );
				} );
				
			});

			elementorFrontend.hooks.addAction( 'frontend/element_ready/litho-hamburger-menu.default', function( $scope ) {
				$scope.find( '.edit-template-with-light-box' ).on( 'click', LithoEditor.showTemplatesModal );
				$scope.find( '.elementor-custom-new-template-link' ).on( 'click', function( event ) {
					window.location.href = $( this ).attr( 'href' );
				} );
			});

			LithoEditor.getModal().on( 'hide', function() {
				window.elementor.reloadPreview();
			});
		},
		showTemplatesModal: function() {

			var editLink = $( this ).data( 'template-edit-link' );
			LithoEditor.showModal( editLink );
		},
		showModal: function( link ) {

			var $iframe,
				$loader;

			LithoEditor.getModal().show();

			var dialogFrame = '';
				dialogFrame += '<iframe src="';
				dialogFrame += link;
				dialogFrame += '" id="tabs-edit-frame" width="100%" height="100%"></iframe>';

			var dialogLoader = '';
				dialogLoader += '<div id="elementor-template-loading">';
				dialogLoader += '<div class="elementor-loader-wrapper">';
				dialogLoader += '<div class="elementor-loader">';
				dialogLoader += '<div class="elementor-loader-boxes">';
				dialogLoader += '<div class="elementor-loader-box"></div>';
				dialogLoader += '<div class="elementor-loader-box"></div>';
				dialogLoader += '<div class="elementor-loader-box"></div>';
				dialogLoader += '<div class="elementor-loader-box"></div>';
				dialogLoader += '</div>';
				dialogLoader += '</div>';
				dialogLoader += '<div class="elementor-loading-title">Loading</div>';
				dialogLoader += '</div>';
				dialogLoader += '</div>';
			
			$( '#custom-template-edit-modal .dialog-message' ).html( dialogFrame );
			$( '#custom-template-edit-modal .dialog-message' ).append( dialogLoader );

			$iframe = $( '#tabs-edit-frame');
			$loader = $( '#elementor-template-loading');
			$iframe.on( 'load', function() {
				$loader.fadeOut( 300 );
			} );
		},
		getModal: function( link ) {

			if ( ! LithoEditor.modal ) {
				this.modal = elementor.dialogsManager.createWidget( 'lightbox', {
					id: 'custom-template-edit-modal',					
					closeButton: true,
					closeButtonClass: 'eicon-close',
					hide: {
						onBackgroundClick: false
					}
				} );
			}
			return LithoEditor.modal;
		},
		onFontChange: function ( fontType, font ) {
			
			if ( 'custom' !== fontType && 'typekit' !== fontType ) {
				return;
			}

			if ( -1 !== customFonts.indexOf( font ) ) {
				return;
			}

			if ( 'typekit' === fontType && customTypekit ) {
				return;
			}

			LithoEditor.litho_Get_CustomFont( fontType, font );
		},
		litho_Get_CustomFont: function ( fontType, font ) {

			elementorCommon.ajax.addRequest( 'Litho_CustomFonts_action_data', {
				unique_id: 'font_' + fontType + font,
				data: {
					service: 'font',
					type: fontType,
					font: font
				},
				success: function success( data ) {
					if ( data.font_face ) {
						var dataFontFace = '';
							dataFontFace += '<style type="text/css">';
							dataFontFace += data.font_face;
							dataFontFace += '</style>';

						elementor.$previewContents.find( 'style:last' ).after( dataFontFace );
					}

					if ( data.font_url ) {
						var dataFontURL = '';
							dataFontURL += '<link href="';
							dataFontURL += data.font_url;
							dataFontURL += '" rel="stylesheet" type="text/css">';

						elementor.$previewContents.find( 'link:last' ).after( dataFontURL );
					}
				}
			});

			customFonts.push( font );

			if ( 'typekit' === fontType ) {
				customTypekit = true;
			}
		},
		addMenuItems: function() {
			if ( typeof elementorCommonConfig.finder !== 'undefined' ) {
				var items = [{
					name: 'litho-theme-settings-url',
					icon: 'eicon-settings',
					title: elementor.config.i18n.litho_panel_menu_item_customizer,
					type: 'link',
					link: elementorCommonConfig.finder.data.site.items['wordpress-customizer'].url,
					newTab: true
				}];
				
				items.forEach( function ( item ) {
				  elementor.modules.layouts.panel.pages.menu.Menu.addItem( item, 'more', 'exit-to-dashboard' );
				});
			}
		}
	}

	$( window ).on( 'elementor:init', LithoEditor.init );

})( jQuery );