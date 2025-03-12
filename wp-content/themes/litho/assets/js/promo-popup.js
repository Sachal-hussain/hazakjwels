( function( $ ) {

    "use strict";

    /* Window ready event start code */
    $( document ).ready( function () {

        if ( LithoMain.enable_promo_popup == '1' ) {
            if ( LithoMain.enable_mobile_promo_popup == '1' && $( window ).width() < 768 ) {
                return false;
            } else {
                if ( LithoMain.display_promo_popup_after == 'some-time' ) {
                    var promo_cookie_name = 'litho-promo-popup' + LithoMain.site_id;
                    var promo_popup = getLithoCookie( promo_cookie_name );
                    if ( promo_popup != 'shown' ) {
                        setTimeout( function() {
                            showpromoPopup();
                        }, LithoMain.delay_time_promo_popup );
                    }
                } else {
                    $( window ).scroll( function () {
                        var promo_cookie_name = 'litho-promo-popup' + LithoMain.site_id;
                        var promo_popup = getLithoCookie( promo_cookie_name );
                        if ( $( document ).scrollTop() >= LithoMain.scroll_promo_popup && promo_popup != 'shown' ) {
                            showpromoPopup();
                        }
                    });
                }
            }
        }

    }); /* Window ready event end code */

    /*Promo Popup*/
    function showpromoPopup() {
        
        if ( LithoMain.enable_promo_popup == '1' ) {
            
            var cookie_name = 'litho-promo-popup' + LithoMain.site_id;
            var promo_popup = getLithoCookie( cookie_name );
        
            $( '#litho-promo-show-popup' ).change( function() {
                setLithoCookie( cookie_name, 'shown', LithoMain.expired_days_promo_popup );
            });

            $( '.litho-promo-popup-wrap' ).css( 'display','block' );
        
            $.magnificPopup.open({
                items: {
                    src: '.litho-promo-popup-wrap'
                },
                fixedContentPos: true,
                type: 'inline',
                removalDelay: 10,
            });
        }
    }

    /* Remove litho Cookie Function */
    function getLithoCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent( document.cookie );
        var ca = decodedCookie.split(';');
        for ( var i = 0; i < ca.length; i++ ) {
            var c = ca[i];
            while ( c.charAt(0) == ' ' ) {
                c = c.substring(1);
            }
            if ( c.indexOf( name ) == 0 ) {
                return c.substring( name.length, c.length );
            }
        }
        return "";
    }

    /* Set litho Cookie Function */
    function setLithoCookie( cname, cvalue, exdays ) {
        var d = new Date();
        d.setTime( d.getTime() + ( exdays*24*60*60*1000 ) );
        var expires = ( exdays != 0 && exdays != '' ) ? d.toUTCString() : 0;
        document.cookie = cname + "=" + cvalue + ";expires=" + expires + ";path=/";
    }

})( jQuery );