/*
* Initialize Modules
* Icon Hover Animation Control
*/
;(function( $, window, document, undefined ) {

    $( window ).on( 'elementor:init', function() {		

		var IconAnimationItemView = elementor.modules.controls.BaseData.extend( {
            onReady: function() {
                this.ui.select.select2();
            },
            onBeforeDestroy: function() {
                this.ui.select.select2( 'destroy' );
            }
        } );
        elementor.addControlView( 'icon-hover-animation', IconAnimationItemView );
	} );

})( jQuery, window, document );