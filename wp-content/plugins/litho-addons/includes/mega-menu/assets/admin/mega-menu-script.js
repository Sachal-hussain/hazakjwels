( function( $, settings ) {
	'use strict';
	
	var lithoMenuAdmin = {

		instance: [],

		init: function() {

			if ( '' == LithoMegamenu.disableLithoMenu ) {
				return;
			}

			this.initTriggers();
			$( document ).ready( this.render );
			$( document ).on( 'click.lithoMenuAdmin', '.litho-menu-trigger', this.initPopup );
			$( document ).on( 'click.lithoMenuAdmin', '.litho-menu-tabs__nav-item', this.switchTabs );
			$( document ).on( 'click.lithoMenuAdmin', '.litho-menu-editor', this.openEditor );
			$( document ).on( 'click.lithoMenuAdmin', '.litho-save-menu', this.saveMenu );
			$( document ).on( 'click.lithoMenuAdmin', '.litho-menu-popup__close', this.closePopup );
			$( document ).on( 'click.lithoMenuAdmin', '.litho-close-frame', this.closeEditor )
			$( document ).on( 'click.lithoMenuAdmin', '.litho-menu-popup__overlay', this.closePopup )

		},
		render: function() {
			
			$( document ).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
				if ( ! $( event.target ).is( 'a' ) ) {
					var id = $( this ).find( '.litho-menu-trigger' ).attr( 'data-item-id' );
					if ( $( '#litho-popup-' + id ).length > 0 ) {
						$( '#litho-popup-' + id ).remove();
					}
					setTimeout( update_megamenu_item_depth, 300 );
				}
			} );

			function update_megamenu_item_depth() {
				var menu_li_items = $( '.menu-item' );
				menu_li_items.each( function( i ) {
					var depth = lithoMenuAdmin.getItemDepth( $( this ) );
					$( this ).find( '.litho-menu-trigger' ).attr( 'data-item-depth', depth );
				} );
			}
		},
		saveMenu: function() {

			var _this                 = $( this ),
				data                  = [],
				preparedData          = {},
				current_menu_itemt_id = _this.parents( '.litho-menu-popup' ).data( 'id' );
				data                  = $( '.litho-menu-tabs__content input, .litho-menu-tabs__content select' ).serializeArray();
				
			$.each( data, function( index, field ) {
				preparedData[ field.name ] = field.value;
			});

			preparedData.action                = 'litho_save_mega_menu_settings';
			preparedData.current_menu          = settings.currentMenuId;
			preparedData.current_menu_itemt_id = current_menu_itemt_id;

			_this.parent().find( '.spinner' ).css( 'visibility', 'visible' );

			$.ajax( {
				url: ajaxurl,
				type: 'post',
				dataType: 'json',
				data: preparedData
			} ).done( function( response ) {

				_this.parent().find( '.spinner' ).css( 'visibility', 'hidden' );
				if ( true === response.success ) {
					_this.parent().find( '.dashicons-yes' ).removeClass( 'hidden' );
					setTimeout( function() { 
						_this.parent().find( '.dashicons-yes' ).addClass( 'hidden' );
						_this.parents( '.litho-menu-popup' ).addClass( 'litho-hidden' );
					}, 2000 );
				}
			} );
		},
		getItemId: function( $item ) {

			var id = $item.attr( 'id' );
			return id.replace( 'menu-item-', '' );
		},
		getItemDepth: function( $item ) {

			var depthClass = $item.attr( 'class' ).match( /menu-item-depth-\d/ );

			if ( ! depthClass[0] ) {
				return 0;
			}

			return depthClass[0].replace( 'menu-item-depth-', '' );
		},
		initTriggers: function() {

			var trigger = wp.template( 'menu-trigger' );

			$( document ).on( 'menu-item-added', function( event, $menuItem ) {
				var id = lithoMenuAdmin.getItemId( $menuItem );
				$menuItem.find( '.item-title' ).append( trigger( { id: id, label: settings.i18n.triggerLabel } ) );
			});

			$( '#menu-to-edit .menu-item' ).each( function() {
				var _this = $( this ),
					depth = lithoMenuAdmin.getItemDepth( _this ),
					id    = lithoMenuAdmin.getItemId( _this );

				_this.find( '.item-title' ).append( trigger( {
					id: id,
					depth: depth,
					label: settings.i18n.triggerLabel
				} ) );
			} );
		},
		initPopup: function(event) {

			var _this   = $( this ),
				id      = _this.attr( 'data-item-id' ),
				depth   = _this.attr( 'data-item-depth' ),
				content = null,
				wrapper = wp.template( 'popup-wrapper' ),
				tabs    = wp.template( 'popup-tabs' );

				content = wrapper( {
					id: id,
					content: tabs( { tabs: settings.tabs, depth: depth } ),
					saveLabel: settings.i18n.saveLabel
				} );

				$( 'body' ).append( content );
				lithoMenuAdmin.instance[ id ] = '#litho-popup-' + id;

			$( lithoMenuAdmin.instance[ id ] ).removeClass( 'litho-hidden' );
			lithoMenuAdmin.menuId = id;
			lithoMenuAdmin.depth  = depth;
			lithoMenuAdmin.tabs.showActive(
				$( lithoMenuAdmin.instance[ id ] ).find( '.litho-menu-tabs__nav-item:first' )
			);
		},
		tabs: {
			showActive: function( $item ) {
				
				var tab      = $item.data( 'tab' ),
					action   = $item.data( 'action' ),
					template = $item.data( 'template' ),
					$content = $item.closest( '.litho-settings-tabs' ).find( '.litho-menu-tabs__content-item[data-tab="' + tab + '"]' ),
					loaded   = parseInt( $content.data( 'loaded' ) );

				if ( $item.hasClass( 'litho-active-tab' ) ) {
					return;
				}

				if ( 0 === loaded ) {
					lithoMenuAdmin.tabs.loadTabContent( tab, $content, template, action );
				}

				$item.addClass( 'litho-active-tab' ).siblings().removeClass( 'litho-active-tab' );
				$content.removeClass( 'litho-hidden-tab' ).siblings().addClass( 'litho-hidden-tab' );

				$( $content ).append( '<div class="preloading-wrap"><div class="preloading"></div></div>' );
				
				setTimeout( function() {
					
					var counter    = 1,
						$iconItems = $content.find( '.litho-icon-tab-wrap .litho-menu-icons' );

					function MenuIconCallback( state ) {

						
						if ( ! state.id ) {
							return state.text;
						}
						var icontext = state.text;
						
						if ( icontext.indexOf( 'fa-' ) >= 0 ) {
							var iconTextHTML = '';
								iconTextHTML += '<span>';
								iconTextHTML += '<i class="';
								iconTextHTML += state.element.value.toLowerCase();
								iconTextHTML += '"></i>  ';
								iconTextHTML += icontext;
								iconTextHTML += '</span>';
							var $state = $( iconTextHTML );
						} else {
							var iconTextHTML = '';
								iconTextHTML += '<span>';
								iconTextHTML += '<i class="';
								iconTextHTML += state.element.value.toLowerCase();
								iconTextHTML += '"></i>  ';
								iconTextHTML += icontext;
								iconTextHTML += '</span>';
							var $state = $( iconTextHTML );
						}
						return $state;
					};

					if ( $( '.litho-menu-icons' ).length > 0 ) {
						$( '.litho-menu-icons' ).select2({
							placeholder: LithoMegamenu.i18n.placeholder,
							allowClear: true,
							templateResult: MenuIconCallback,
							templateSelection: MenuIconCallback,
							width: '50%'
						} );
					}

					if ( $( '.menu-item-icon-color' ).length > 0 ) {
						$( '.menu-item-icon-color' ).wpColorPicker();
					}

					$( $content ).find( '.preloading-wrap' ).remove();
					
				}, 2000 );
			},
			loadTabContent: function( tab, $content, template, action ) {

				if ( ! template && ! action ) {
					return;
				}

				var renderTemplate = null,
					$popup         = $content.closest( '.litho-menu-popup' ),
					id             = $popup.attr( 'data-id' ),
					data           = {};

				$content.has( '.tab-loader' ).addClass( 'tab-loading' );

				if ( ! template ) {
					if ( 0 < settings.tabs[ tab ].data.length ) {
						data = settings.tabs[ tab ].data;
						data.action  = action;
						data.menu_id = id;
					} else {
						data = {
							action: action,
							menu_id: id
						};
					}
					$.ajax({
						url: ajaxurl,
						type: 'post',
						data: data

					}).done( function( response ) {
						$content.removeClass( 'tab-loading' ).html( response );

					});

				} else {
					renderTemplate = wp.template( template );
					$content.html( renderTemplate( settings.tabs[ tab ].data ) );
				}
				
				$content.data( 'loaded', 1 );
			}
		},
		switchTabs: function() {
			lithoMenuAdmin.tabs.showActive( $( this ) );
		},
		openEditor: function() {

			var $popup   = $( this ).closest( '.litho-menu-popup' ),
				menuItem = $popup.attr( 'data-id' ),
				url      = settings.editURL.replace( '%id%', menuItem ),
				frame    = null,
				loader   = null,
				editor   = wp.template( 'editor-frame' );
				url      = url.replace( '%menuid%', settings.currentMenuId );
				
			$popup
				.addClass( 'litho-menu-editor-active' )
				.find( '.litho-menu-editor-wrap' )
				.addClass( 'litho-editor-active' )
				.html( editor( { url: url } ) );

			frame  = $popup.find( '.litho-edit-frame' )[0];
			loader = $popup.find( '#elementor-loading' );

			$( frame.contentWindow ).on( 'load', function() {
				$popup.find( '.litho-close-frame' ).addClass( 'litho-loaded' );
				loader.fadeOut( 300 );
			} );

		},
		closePopup: function( event ) {

			event.preventDefault();

			lithoMenuAdmin.menuId = 0;
			lithoMenuAdmin.depth  = 0;

			$( this )
				.closest( '.litho-menu-popup' ).addClass( 'litho-hidden' )
				.removeClass( 'litho-menu-editor-active' )
				.find( '.litho-menu-editor-wrap.litho-editor-active' ).removeClass( 'litho-editor-active' )
				.find( '.litho-close-frame' ).removeClass( 'litho-loaded' )
				.siblings( '#elementor-loading' ).fadeIn( 0 );
		},
		closeEditor: function( event ) {

			var _this    = $( this ),
				$popup   = _this.closest( '.litho-menu-popup' ),
				$frame   = $( this ).siblings( 'iframe' ),
				$loader  = $popup.find( '#elementor-loading' ),
				$editor  = $frame.closest( '.litho-menu-editor-wrap' ),
				$content = $frame[0].contentWindow,
				saver    = null,
				enabled  = true;

			if ( $content.elementor.saver && 'function' === typeof $content.elementor.saver.isEditorChanged ) {
				saver = $content.elementor.saver;
			} else if ( 'function' === typeof $content.elementor.isEditorChanged ) {
				saver = $content.elementor;
			}

			if ( null !== saver &&  true === saver.isEditorChanged() ) {
				if ( ! confirm( settings.i18n.leaveEditor ) ) {
					enabled = false;
				}
			}

			if ( ! enabled ) {
				return;
			}

			$loader.fadeIn(0);
			$popup.removeClass( 'litho-menu-editor-active' );
			_this.removeClass( 'litho-loaded' );
			$editor.removeClass( 'litho-editor-active' );
		},
	}

	lithoMenuAdmin.init();

}( jQuery, window.LithoMegamenu ) );