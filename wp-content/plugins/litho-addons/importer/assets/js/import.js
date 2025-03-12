( function( $ ) {

	"use strict";

	// For Notice accordian
	if ( $( '#import-export-desc' ).length > 0 ) {

		$( '#import-export-desc' ).accordion({
			collapsible : true,
			active      : false,
			height      : 'fill',
			header      : 'h3'
		});
	}

	// Active Import Full Tab on load
	var activeFullTab = $( '.litho-demo' ).find( '.import-content-full-wrap' );
	if ( activeFullTab.length > 0 ) {
		var activeTabcontentHeight = activeFullTab.outerHeight();
		$( '.litho-demo' ).addClass( 'active-tab' ).css( 'margin-bottom', activeTabcontentHeight );
		activeFullTab.slideDown();
	}

	// Full and Single Import Button Click code start
	$( document ).on( 'click', '.litho-import-button-trigger', function() {

		/* Return false if current element has disable attribute */
		if ( $( this ).attr( 'disabled' ) ) {

			return false;
		}

		$( this ).addClass( 'active' );

		var setupKey    = $( this ).attr( 'data-demo-import' ); // full_data or single_data
		var currentTab  = $( this ).parents( 'li' );        
		var parentTab   = $( this ).parents( 'ul' );

		if ( setupKey == 'full_data' ) {
			var contentHeight = currentTab.find( '.import-content-full-wrap' ).outerHeight();
		} else {
			var contentHeight = currentTab.find( '.import-content-single-wrap' ).outerHeight();
		}
		
		// Call function after closed content block
		lithoTriggerCloseContentBlock( currentTab );

		if ( ! $( currentTab ).hasClass( 'active-tab' ) ) { // Not active content

			if ( $( parentTab ).find( 'li.active-tab' ).length > 0 ) { //  !== 0

				$( '.active-tab' ).find( '.import-content-full-wrap' ).slideUp();
				$( '.active-tab' ).find( '.import-content-single-wrap' ).slideUp();
				$( '.active-tab' ).find( '.active-inner-tab' ).removeClass( 'active-inner-tab' );
				$( '.active-tab' ).css( 'margin', '0' );
				$( '.active-tab' ).find( '.active' ).removeClass( 'active' );
				$( '.active-tab' ).removeClass( 'active-tab' );
			}

			if ( setupKey == 'full_data' ) { // Full import

				$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).addClass( 'active-inner-tab' );
				$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).slideDown();

			} else { // Single import

				$( '.litho-import-button' ).attr( 'disabled', false );
				$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap .litho-import-button' ).attr( 'disabled', false );
				$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).addClass( 'active-inner-tab' );
				$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).slideDown();
			}

			$( currentTab ).addClass( 'active-tab' );
			currentTab.css( 'margin-bottom', contentHeight );

		} else { // Active content

			if ( setupKey == 'full_data' ) { // Full import

				if ( $( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).hasClass( 'active-inner-tab' ) ) {
					
					var contentHeight = currentTab.find( '.import-content-full-wrap' ).outerHeight();
					$( currentTab ).find( '.litho-single-import-button' ).removeClass( 'active' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).removeClass( 'active-inner-tab' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).slideUp();
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).addClass( 'active-inner-tab' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).slideDown();
					currentTab.css( 'margin-bottom', contentHeight );

				} else {

					$( currentTab ).find( '.litho-full-import-button' ).removeClass( 'active' );
					currentTab.removeClass( 'active-tab' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).slideUp( 'slow' );
					currentTab.css( 'margin-bottom', '0' );
				}

			} else { // Single import

				if ( $( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).hasClass( 'active-inner-tab' ) ) {

					var contentHeight = currentTab.find( '.import-content-single-wrap' ).outerHeight();
					$( currentTab ).find( '.litho-full-import-button' ).removeClass( 'active' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).removeClass( 'active-inner-tab' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-full-wrap' ).slideUp();
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).addClass( 'active-inner-tab' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).slideDown();
					currentTab.css( 'margin-bottom', contentHeight );

				} else {

					$( currentTab ).find( '.litho-single-import-button' ).removeClass( 'active' );
					currentTab.removeClass( 'active-tab' );
					$( this ).parent( '.import-inner-content-wrap' ).siblings( '.import-content-single-wrap' ).slideUp();
					currentTab.css( 'margin-bottom', '0' );
				}
			}
		}
	});
	// Full and Single Import Button Click code end

	// Litho Close content block in single and full import code start
	$( document ).on( 'click', '.litho-import-close', function( e ) {

		e.preventDefault();

		/* Return false if current element has disable attribute */
		if ( $( this ).attr( 'disabled' ) ) {

			return false;
		}

		var currentTab = $( this ).parents( '.active-tab' );
		$( currentTab ).find( '.litho-full-import-button' ).removeClass( 'active' );
		var importSingleParent = $( this ).parents( 'li' ).find('.single-layout-wrapper');

		currentTab.removeClass( 'active-tab' );
		$( this ).parents( '.import-inner-content-wrap' ).find( '.active' ).removeClass( 'active' );
		importSingleParent.slideUp( 'slow' );
		$( '.litho-import-button' ).attr( 'disabled', false );
		$( this ).parents( '.import-content-single-wrap' ).removeClass( 'active-inner-tab' ).slideUp( 'slow' );
		$( this ).parents( '.import-content-full-wrap' ).removeClass( 'active-inner-tab' ).slideUp( 'slow' );
		currentTab.css( 'margin-bottom', '0' );
		$( '.litho-demo' ).css( 'margin-bottom', '0' );
		
		// Call function after closed content block
		lithoTriggerCloseContentBlock( currentTab );
	});
	// Litho Close content block in single and full import code end

	//litho check all posts while checked all content from full import
	$( document ).on( 'change', '.litho-checkbox-all', function() {

		$( '.active-tab .litho-checkbox' ).prop( 'checked', $( this ).prop( "checked" ) );
	});

	//litho change all content based on checked individual checkbox
	$( '.litho-checkbox' ).on( 'click', function() {

		if ( $( '.litho-checkbox' ).length == $( '.litho-checkbox:checked' ).length ) {

			$( '.litho-checkbox-all' ).prop( "checked", true );

		} else {

			$( '.litho-checkbox-all' ).prop( "checked", false );
		}
	});

	// Select all pages / posts in individual import section
	var all_checkboxs_key = [ "post", "page", "portfolio", "product", "sectionbuilder", "elementor_library" ];
	$.each( all_checkboxs_key, function ( index, value ) {
		
		//litho check all Posts, Pages, Products, & Section Builder checkbox
		$( document ).on( 'change', '.' + value + '-main .litho-single-import-checkbox-all', function() {

			$( '.active-tab .' + value + '-main .litho-single-checkbox' ).prop( 'checked', $( this ).prop( "checked" ) );
		});

		//litho check all Posts, Pages, Products, & Section Builder checked individual checkbox
		$( '.' + value + '-main .litho-single-checkbox' ).on( 'click', function() {

			if ( $( '.active-tab .' + value + '-main .litho-single-checkbox' ).length == $( '.litho-single-checkbox:checked' ).length ) {

				$( '.active-tab .' + value + '-main .litho-single-import-checkbox-all' ).prop( "checked", true );

			} else {

				$( '.active-tab .' + value + '-main .litho-single-import-checkbox-all' ).prop( "checked", false );
			}
		});
	});

	// Import delete demo data and media
	$( '.litho-demo-delete' ).on( 'click', function( e ) {
		e.preventDefault();

		/* Return false if current element has disable attribute */
		if ( $( this ).attr( 'disabled' ) ) {

			return false;
		}

		// Content block hide
		//$( '.litho-import-close' ).trigger( 'click' );

		/* Add disable attribute in all element to block import click */
		lithoDisableButton( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );

		var deleteKey = $( this ).attr( 'data-delete-key' );
		var deleteProceedFlag = false;

		if ( deleteKey == 'media' ) { // Delete demo media

			var confirmMsg = confirm( lithoImport.delete_media_confirmation );
			if ( confirmMsg ) {

				// Add loader
				lithoAddLoader( this );

				// Proceed to delete demo media
				deleteProceedFlag = true;
			}

		} else if ( deleteKey == 'data' ) { // Delete demo data

			var confirmMsg = confirm( lithoImport.delete_data_confirmation );
			if ( confirmMsg ) {

				// Add loader
				lithoAddLoader( this );

				// Proceed to delete demo data
				deleteProceedFlag = true;
			}
		}

		// Check flag for ready to import / delete process
		if ( deleteProceedFlag == true ) {

			lithoDemoDelete( deleteKey );

		} else {

			// Remove loader
			lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );
		}

	});

	$( '.litho-demo-import' ).on( 'click', function( e ) {
		e.preventDefault();

		/* Return false if current element has disable attribute */
		if ( $( this ).attr( 'disabled' ) ) {

			return false;
		}

		/* Add disable attribute in all element to block import click */
		lithoDisableButton( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );
		
		var setupKey = $( this ).attr( 'data-demo-import' );
		var demoKey  = 'litho';
		var importProceedFlag = false;
		var importFullOptions = [];

		if ( setupKey == 'full' ) { // Full import

			var fullImportSelected = [];

			$( '.litho-checkbox' ).each( function( key, option ) {

				if ( $( this ).is( ":checked" ) ) {
					
					fullImportSelected.push( $( option ).val() );
					importFullOptions.push( $( option ).val() );

				} else if ( $( this ).is( ":not(:checked)" ) ) {

					$( this ).attr( 'disabled', 'disabled' );
				}
			});
			if ( $( '.litho-checkbox-all' ).is( ":not(:checked)" ) ) {

				$( '.litho-checkbox-all' ).attr( 'disabled', 'disabled' );
			}

			// Check at least empty post id and display info message
			if ( importFullOptions.length === 0 ) {

				alert( lithoImport.no_single_layout );

				importProceedFlag = false;

				// Remove loader
				lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );

				var currentTab = $( this ).parents( '.active-tab' );
				
				// Call function after closed content block
				lithoTriggerCloseContentBlock( currentTab );

				return false;

			} else {

				var confirmMsg = confirm( lithoImport.full_import_confirmation );
				if ( confirmMsg ) {

					// Add loader
					lithoAddLoader( this );

					// Proceed to import demo data
					importProceedFlag = true;
				}
			}

		} else if ( setupKey == 'import-single' ) { // Individual import ids

			var importSingles         = [],
				posts_ids             = [],
				pages_ids             = [],
				portfolios_ids        = [],
				products_ids          = [],
				elementor_library_ids = [],
				builder_ids           = [];

			$( '.active-tab .litho-single-post-import-choice .litho-single-checkbox:checked' ).each( function( key, option ) {
				posts_ids.push( $( option ).val() );
			});
			$( '.active-tab .litho-single-page-import-choice .litho-single-checkbox:checked' ).each( function( key, option ) {
				pages_ids.push( $( option ).val() );
			});
			$( '.active-tab .litho-single-portfolio-import-choice .litho-single-checkbox:checked' ).each( function( key, option ) {
				portfolios_ids.push( $( option ).val() );
			});
			$( '.active-tab .litho-single-product-import-choice .litho-single-checkbox:checked' ).each( function( key, option ) {
				products_ids.push( $( option ).val() );
			});
			$( '.active-tab .litho-single-elementor_library-import-choice .litho-single-checkbox:checked' ).each( function( key, option ) {
				elementor_library_ids.push( $( option ).val() );
			});
			$( '.active-tab .litho-single-sectionbuilder-import-choice .litho-single-checkbox:checked' ).each( function( key, option ) {
				builder_ids.push( $( option ).val() );
			});

			// Individual Posts in one array
			if ( posts_ids.length > 0 ) {
				importSingles.push({ posts: posts_ids.toString() });
			}
			if ( pages_ids.length > 0 ) {
				importSingles.push({ pages: pages_ids.toString() });
			}
			if ( portfolios_ids.length > 0 ) {
				importSingles.push({ portfolio: portfolios_ids.toString() });
			}
			if( products_ids.length > 0 ) {
				importSingles.push({ products: products_ids.toString() });
			}
			if ( elementor_library_ids.length > 0 ) {
				importSingles.push({ elementor_library: elementor_library_ids.toString() });
			}
			if ( builder_ids.length > 0 ) {
				importSingles.push({ section_builder: builder_ids.toString() });
			}

			// Check at least empty post id and display info message
			if ( importSingles.length === 0 ) {

				alert( lithoImport.no_single_layout );

				importProceedFlag = false;

				// Remove loader
				lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );

				return false;

			} else {

				var confirmMsg = confirm( lithoImport.single_import_confirmation );
				if ( confirmMsg ) {

					// Add loader
					lithoAddLoader( this );

					// Proceed to import demo data 
					importProceedFlag = true;
				}
			}
		}

		// Check flag for ready to import / delete process
		if ( importProceedFlag == true ) {

			if ( setupKey == 'full' ) { // Full import

				var totalImportCount = importFullOptions.length;
				var activeProgessObj = $( '.' + demoKey + '-demo.active-tab .import-content-full-wrap .import-progress-bar-wrap' );
				activeProgessObj.removeClass( 'progressed' ).fadeIn();
				activeProgessObj.find( '.import-progress-percentage' ).html( '' ).width( '0px' );
				activeProgessObj.find( '.import-progress-msg' ).html( 'Processing...' );

				// Increase content height
				var contentHeight = $( '.' + demoKey + '-demo .active-inner-tab' ).outerHeight();
				$( '.' + demoKey + '-demo.active-tab' ).css( 'margin-bottom', contentHeight );

				lithoFullDemoImport( importFullOptions, demoKey, setupKey, totalImportCount, fullImportSelected );

			} else { // Individual import

				var activeProgessObj = $( '.' + demoKey + '-demo.active-tab .import-content-single-wrap .import-progress-bar-wrap' );
				activeProgessObj.removeClass( 'progressed' ).fadeIn();
				activeProgessObj.find( '.import-progress-percentage' ).html( '' ).width( '0px' );
				activeProgessObj.find( '.import-progress-msg' ).html( 'Processing...' );

				// Increase content height
				var contentHeight = $( '.' + demoKey + '-demo .active-inner-tab' ).outerHeight();
				$( '.' + demoKey + '-demo.active-tab' ).css( 'margin-bottom', contentHeight );

				lithoIndividualDemoImport( importSingles, demoKey, setupKey );
			}

		} else {

			// Remove loader
			lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );

			var currentTab = $( this ).parents( '.active-tab' );
			
			// Call function after closed content block
			lithoTriggerCloseContentBlock( currentTab );

			return false;
		}
	});

	// Import full demo data
	function lithoFullDemoImport( importFullOptions, demoKey, setupKey, totalImportCount, fullImportSelected ) {
		
		var importOption    = importFullOptions.shift(),
			totalWeight     = lithoTotalWeight( fullImportSelected ),
			remainingWeight = lithoTotalWeight( importFullOptions ),
			currentWeight   = totalWeight - remainingWeight;

		if ( importOption != '' && importOption != undefined ) {

			var importSingles = [];
			var ajaxData = {
				action: 'litho_import_sample_data',
				full_import_options: importOption,
				setup_key: setupKey,
				import_options: importSingles
			};            

			var request = $.ajax({
				url: ajaxurl,
				type: "POST",
				data: ajaxData
			});
			request.success( function( msg ) {
				
				lithoDisableCheckbox( '.import-content-full-wrap .litho-checkbox', importOption, demoKey );

				var importOptionLabel   = $( '.' + demoKey + '-demo.active-tab' ).find( '.litho-checkbox[value="' + importOption + '"]' ).attr( 'data-label' );
				var remainImportCount   = importFullOptions.length;
				var weightage           = Math.round( ( currentWeight * 100 ) / totalWeight );
				var activeProgessObj    = $( '.' + demoKey + '-demo.active-tab .import-content-full-wrap  .import-progress-bar-wrap' );
					activeProgessObj.find( '.import-progress-msg' ).html( '' );

				if ( remainImportCount > 0 ) {

					activeProgessObj.find( '.import-progress-percentage' ).html( importOptionLabel + ' Done' ).animate({
						width: weightage + '%'
					}, 500 );

					lithoFullDemoImport( importFullOptions, demoKey, setupKey, totalImportCount, fullImportSelected );

				} else {

					activeProgessObj.find( '.import-progress-percentage' ).animate({
						width: weightage + '%'
					}, 500, function() {

						$( '.' + demoKey + '-demo.active-tab .import-content-full-wrap .import-progress-bar-wrap' ).addClass( 'progressed' );
					} );

					$( '.' + demoKey + '-demo.active-tab .import-content-full-wrap .import-progress-bar-wrap .import-progress-percentage' ).html( lithoImport.import_data_success_msg );

					// Regenerate thumbnails plugin install notice
					$( '.litho-regenerate-notice' ).fadeIn();

					// Remove loader
					lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );
					$( '.' + demoKey + '-demo.active-tab .import-content-full-wrap .litho-checkbox-all' ).prop( "checked", false );
					$( '.' + demoKey + '-demo.active-tab .import-content-full-wrap .litho-checkbox' ).prop( "checked", false );
				}
			});
			request.fail( function( jqXHR, textStatus ) {

				alert( 'Request failed: ' + textStatus );

				// Remove loader
				lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );
			});
		}
	}

	// Import individual demo data
	function lithoIndividualDemoImport( importSingles, demoKey, setupKey ) {

		var weightage = '100';
		var activeProgessObj = $( '.' + demoKey + '-demo.active-tab .import-content-single-wrap  .import-progress-bar-wrap' );

		var importOption = '';
		var ajaxData = {
			action: 'litho_import_sample_data',
			full_import_options: importOption,
			setup_key: setupKey,
			import_options: importSingles
		};

		var request = $.ajax({
			url: ajaxurl,
			type: "POST",
			data: ajaxData
		});
		request.success( function( msg ) {

			activeProgessObj.find( '.import-progress-percentage' ).animate({
				width: weightage + '%'
			}, 500, function() {
				
				$( '.' + demoKey + '-demo.active-tab .import-content-single-wrap .import-progress-bar-wrap' ).addClass( 'progressed' );
			} );

			$( '.' + demoKey + '-demo.active-tab .import-content-single-wrap .import-progress-bar-wrap .import-progress-msg' ).html( lithoImport.import_data_success_msg );
			
			// Remove loader
			lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );

			$( '.' + demoKey + '-demo.active-tab .import-content-single-wrap .litho-single-import-checkbox-all' ).prop( "checked", false );
			$( '.' + demoKey + '-demo.active-tab .import-content-single-wrap .litho-single-checkbox' ).prop( "checked", false );
		});

		request.fail( function( jqXHR, textStatus ) {

			alert( 'Request failed: ' + textStatus );

			// Remove loader
			lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );
		});
	}

	// Import delete demo data and media
	function lithoDemoDelete( deleteKey ) {

		$( '.litho-data-delete-msg' ).fadeOut();

		var data = {
			action: 'litho_delete_sample_data',
			delete_key: deleteKey,
		};

		var request = $.ajax({
			url: ajaxurl,
			type: "POST",
			data: data
		});
		request.success( function( msg ) {

			if ( deleteKey == 'media' ) {

				var deleteMsg = '';
					deleteMsg += '<span>';
					deleteMsg += lithoImport.delete_media_success_msg;
					deleteMsg += '</span>';
				$( '.litho-data-delete-msg' ).html( deleteMsg ).fadeIn();

			} else if ( deleteKey == 'data' ) {
				
				var deleteMsg = '';
					deleteMsg += '<span>';
					deleteMsg += lithoImport.delete_data_success_msg;
					deleteMsg += '</span>';
				$( '.litho-data-delete-msg' ).html( deleteMsg ).fadeIn();
			}
			// Remove loader
			lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );
		});

		request.fail( function( jqXHR, textStatus ) {

			alert( 'Request failed: ' + textStatus );

			// Remove loader
			lithoRemoveLoader( '.litho-demo-import, .litho-demo-delete, .litho-import-close, .litho-import-button-trigger' );
		});
	}

	// Get weight
	function lithoGetWeight( key ) {

		var weightageData = [];
			weightageData['posts']				= '7';
			weightageData['pages']				= '10';
			weightageData['elements_features']	= '19';
			weightageData['portfolio']			= '8';
			weightageData['products']			= '11';
			weightageData['media']				= '25';
			weightageData['section_builder']	= '10';
			weightageData['elementor_library']	= '19';
			weightageData['mega_menu']			= '2';
			weightageData['navigation_menu']	= '12';
			weightageData['contact_forms']		= '2';
			weightageData['mailchimp_form']		= '2';
			weightageData['customizer']			= '2';
			weightageData['widgets']			= '2';
			weightageData['rev_slider']			= '3';
			weightageData['default_kit']		= '2';

		return weightageData[key] != '' && weightageData[key] != undefined ? parseInt( weightageData[key] ) : 0;
	}

	// Total weight
	function lithoTotalWeight( selectedAllOptions ) {

		var totalWeight = 0;

		if ( selectedAllOptions != '' && selectedAllOptions != undefined ) {

			$( selectedAllOptions ).each( function( index, value ) {
				
				totalWeight = totalWeight + lithoGetWeight( value );
			});
		}

		return totalWeight;
	}

	// Call function after closed content block
	function lithoTriggerCloseContentBlock( currentTab ) {

		// Unchecked all full import options and remove disabled attribute
		currentTab.find( '.litho-checkbox-all, .litho-checkbox' ).prop( "checked", false ).removeAttr( 'disabled' );

		// Unchecked all individual import options
		currentTab.find( '.litho-single-import-checkbox-all, .litho-single-checkbox' ).prop( "checked", false );

		// Hide progress bar
		$( '.import-progress-bar-wrap' ).removeClass( 'progressed' ).fadeOut();

		// Hide regenerate thumbnail notice
		$( '.litho-regenerate-notice' ).hide();
	}

	// Disable Checkbox
	function lithoDisableCheckbox( obj, key, demoKey ) {

		$( '.' + demoKey + '-demo.active-tab' ).find( obj + '[value="' + key + '"]' ).attr( 'disabled', 'disabled' );
	}

	// Add Loader
	function lithoAddLoader( objName ) {

		$( objName ).addClass( 'loading' );
	}

	// Remove Loader
	function lithoRemoveLoader( objName ) {

		$( objName ).removeClass( 'btn-link-disabled' ).removeClass( 'loading' ).removeAttr( 'disabled' );

		// Remove delete success message after sometime
		setTimeout( function(){

			$( '.litho-data-delete-msg' ).html( '' ).hide();
			
		}, 3000 );
	}

	// Disable Button
	function lithoDisableButton( objName ) {

		$( objName ).addClass( 'btn-link-disabled' ).attr( 'disabled', 'disabled' );
	}

})( jQuery );