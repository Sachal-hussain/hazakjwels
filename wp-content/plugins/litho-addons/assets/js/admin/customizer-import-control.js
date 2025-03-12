( function( $ ) {
	
	"use strict";
	
	// Export code
	$( document ).on( 'click', 'input[name=litho-export-button]', function() {
		
		window.location.href = lithoImport.customizeurl + '?litho-export=' + lithoImport.exportnonce;
	});

	// Import code
	$( document ).on( 'click', 'input[name=litho-import-button]', function() {
		var form     = $( '<form class="litho-form" method="POST" enctype="multipart/form-data"></form>' ),
			controls = $( '.litho-import-controls' );

		if ( '' == $( 'input[name=litho-import-file]' ).val() ) {
			alert( lithoImport.blankFileError );
		}
		else {
			if ( $( 'input[name=litho-import-file]' ).val().match( '.json$', 'i' ) ) {

				$( window ).off( 'beforeunload' );
				$( 'body' ).append( form );
				form.append( controls );
				$( '.litho-uploading' ).show();
				form.submit();
			} else {
				alert( lithoImport.validFileError );
			}
		}
	});

})( jQuery );