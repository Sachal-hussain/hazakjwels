( function( $ ) {

	"use strict";
	
	// Tablet Breakpoint
	var tabletBreakPoint = 1024;
	if ( typeof elementorFrontendConfig != "undefined" ) {
		if ( typeof elementorFrontendConfig.breakpoints != "undefined" ) {
			if ( typeof elementorFrontendConfig.breakpoints.lg != "undefined" ) {
				tabletBreakPoint = elementorFrontendConfig.breakpoints.lg - 1;
			}
		}
	}

	// define varibale
	var lastScroll   = 0,
		linkDropdown = 0;

	// Check for browser OS
	var isMobile     = false,
		isiPhoneiPad = false;

	if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
		isMobile = true;
	}
	if ( /iPhone|iPad|iPod/i.test(navigator.userAgent ) ) {
		isiPhoneiPad = true;
	}

	// Check IE
	function isIE() {
		var ua = window.navigator.userAgent,
			msie = ua.indexOf( 'MSIE ' );
		if ( msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./) ) {
			return true;
		} else {
			return false;
		}
		return false;
	}

	// Get window width
	function getWindowWidth() {
		return $( window ).width();
	}

	// Get window height
	function getWindowHeight() {
		return $( window ).height();
	}

	function headerWrapper( scrollTop ) {

		var mini_header_height    = 0,
			main_header_height    = 0,
			mini_header_ts_height = 0,
			main_header_ts_height = 0,
			wpadminbarHeight      = 0,
			aboveHeaderHeight     = 0,
			ts_height             = 0;

		if ( $( '#wpadminbar' ).length > 0 ) {
			wpadminbarHeight = $( '#wpadminbar' ).outerHeight();
			wpadminbarHeight = Math.round( wpadminbarHeight );
		}

		if ( $( '.mini-header-main-wrapper' ).length > 0 ) {
			var mini_header_object = $( '.mini-header-main-wrapper' );
				mini_header_height = mini_header_object.outerHeight();
				ts_height          = ts_height + mini_header_height;
		}

		if ( $( '.header-common-wrapper.standard' ).length > 0 ) {
			var main_header_object = $( '.header-common-wrapper.standard' );
				main_header_height = main_header_object.outerHeight();
				main_header_object.css( 'margin-top', ts_height );
				ts_height = ts_height + main_header_height;
		}

		var headerAppearFlag = false;
		if ( scrollTop > ts_height ) { // Scroll position is greater than header height
			headerAppearFlag = true;
		}

		if ( $( '.mini-header-main-wrapper' ).length > 0 ) {
			var mini_header_object = $( '.mini-header-main-wrapper' );
				mini_header_object.css( 'margin-top', '0px' );

			if ( mini_header_object.hasClass( 'appear-up-scroll' ) ) {

				if ( scrollTop > lastScroll ) {

					scrollTop = scrollTop - 1;

					if ( headerAppearFlag ) {

						mini_header_object.css( 'top', '-' + ( ts_height ) + 'px' );
					}
					mini_header_object.removeClass( 'header-appear' );

				} else {

					if ( headerAppearFlag ) {

						aboveHeaderHeight = aboveHeaderHeight + mini_header_height;
					}
					mini_header_object.addClass( 'header-appear' );
					mini_header_object.css( 'top', wpadminbarHeight + 'px' );
				}
				
			} else if ( mini_header_object.hasClass( 'appear-down-scroll' ) ) {

				if ( headerAppearFlag && ! $( '.header-common-wrapper.standard' ).hasClass( 'no-sticky' ) ) {

					aboveHeaderHeight = aboveHeaderHeight + mini_header_height;

				} else if ( scrollTop > aboveHeaderHeight && $( '.header-common-wrapper.standard' ).hasClass( 'no-sticky' ) ) {
					mini_header_object.css( 'margin-top',  aboveHeaderHeight + 'px' );
				} 
			}
		}

		if ( $( '.header-common-wrapper.standard' ).length > 0 ) {
			var main_header_object = $( '.header-common-wrapper' );
				main_header_height = main_header_object.outerHeight();

			if ( ! main_header_object.hasClass( 'no-sticky' ) ) {
				if ( headerAppearFlag && scrollTop > 0 ) {
					main_header_object.css( 'margin-top', aboveHeaderHeight + 'px' );

				} else if ( scrollTop > aboveHeaderHeight && $( '.mini-header-main-wrapper' ).hasClass( 'no-sticky' ) ) {

					main_header_object.css( 'margin-top', aboveHeaderHeight + 'px' );
				}
			}

			if ( main_header_object.hasClass( 'appear-up-scroll' ) ) {
				
				if ( scrollTop > lastScroll ) {

					scrollTop = scrollTop - 1;

					if ( headerAppearFlag ) {

						main_header_object.css( 'top', '-' + ( ts_height ) + 'px' );
					}
					main_header_object.removeClass( 'header-appear' );

				} else {

					main_header_object.addClass( 'header-appear' );
					main_header_object.css( 'top', wpadminbarHeight + 'px' );
				}
				
			} else if ( main_header_object.hasClass( 'appear-down-scroll' ) ) {

				if ( headerAppearFlag && ! $( '.mini-header-main-wrapper' ).hasClass( 'no-sticky' ) ) {

					aboveHeaderHeight = aboveHeaderHeight + main_header_height;

				} else if ( scrollTop > aboveHeaderHeight && $( '.mini-header-main-wrapper' ).hasClass( 'no-sticky' ) ) {
					main_header_object.css( 'margin-top', aboveHeaderHeight + 'px' );
				}
			}
		}

		if ( scrollTop > ts_height ) {
			$( 'header.site-header' ).addClass( 'sticky' );
		} else {
			$( 'header.site-header' ).removeClass( 'sticky' );
			$( '.mini-header-main-wrapper, .header-common-wrapper' ).removeClass( 'header-appear' );
		}

		lastScroll = scrollTop;

		// Scroll to top
		var el_scroll_top_arrow = $( '.scroll-top-arrow' );

		if ( scrollTop > 150 ) {
			el_scroll_top_arrow.fadeIn( 'slow' );
			$( '.theme-demos' ).css( 'display', 'block' );
		} else {
			el_scroll_top_arrow.fadeOut( 'slow' );
		}
	}

	$( window ).on( 'load', function () {

		var el_preloader_overlay = $( '.preloader-overlay' );
		if ( el_preloader_overlay.length > 0 ) {
			el_preloader_overlay.delay( 2000 ).fadeOut( 'slow' );
			if ( $( 'body' ).hasClass( 'preloader-overflow-hidden' ) ) {
				setTimeout( function () {
					$( 'body' ).removeClass( 'preloader-overflow-hidden' );
				}, 2100 );
			}
		}

		// No retina image code
		$( 'img:not([data-at2x])' ).each( function() {
			$( this ).attr( 'data-no-retina', '' );
		});
	});

	// document ready event
	$( document ).ready( function () {

		var scrollTop = $( this ).scrollTop();
		headerWrapper( scrollTop );

		// One page scroll
		if ( $( '.inner-link' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'smooth-scroll', LithoMain.disable_scripts ) < 0 ) {
			$( '.inner-link' ).smoothScroll( {
				speed: 900,
				offset: 1,
				beforeScroll: function() {
					$( '.navbar-collapse.collapse' ).collapse( 'hide' );
				}
			});
		}

		if ( scrollTop == 10 ) {
			var firstmenuLinks = $( '.navbar-nav li:first-child a' );
			if ( firstmenuLinks.attr( 'href' ) && firstmenuLinks.attr( 'href' ).indexOf( '#' ) > -1 ) {
				firstmenuLinks.addClass( 'active' );
			}
		}

		// swiper slider for single post page
		if ( $( '.litho-post-single-slider' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'swiper', LithoMain.disable_scripts ) < 0 ) {
			var swiperFull = new Swiper( '.litho-post-single-slider', {
				loop: true,
				autoplay: {
					delay: 5000,
				},
				keyboard: {
					enabled: true,
					onlyInViewport: true,
				},
				slidesPerView: 1,
				keyboardControl: true,
				preventClicks: false,
				watchOverflow: true,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				on: {
					resize: function () {
						this.update();
					}
				}
			});
		}

		// fit videos
		if ( $( '.fit-videos' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'fitvids', LithoMain.disable_scripts ) < 0 ) {
			$( '.fit-videos' ).fitVids();
		}

		// mini cart 
		if ( $( '.site-header .litho-mini-cart-lists-wrap' ).length > 0 ) {
			lithoCustomVerticalScroll( '.site-header .litho-mini-cart-lists-wrap' );
		}

		/* Successfully loaded cart */
		$( document.body ).on( 'wc_fragments_loaded', function( event, fragments, cart_hash, $button ) {
			lithoCustomVerticalScroll( '.site-header .litho-mini-cart-lists-wrap' );
		});

		/* Update Custom scroll bar after hover mini cart */
		$( document ).on( 'mouseenter', '.widget_shopping_cart_content', function() {
			lithoCustomVerticalScroll( '.site-header .litho-mini-cart-lists-wrap' );
		});

		/* Custom Vertical Scroll Bar Function */
		function lithoCustomVerticalScroll( key ) {

			if ( 'undefined' === typeof key || key === null || key === '' ) { 
				key = '.site-header .litho-mini-cart-lists-wrap';
			}

			if ( 'undefined' != typeof LithoMain && $.inArray( 'mCustomScrollbar', LithoMain.disable_scripts ) < 0 ) {
				/* Vertical Custom Scrollbar - mini cart */
				$( key ).mCustomScrollbar({
					theme: "dark",
					scrollInertia: 100,
					scrollButtons: {
						enable: false
					},
					keyboard: {
						enable: true
					},
					mouseWheel: {
						enable: true,
						scrollAmount: 200
					},
					advanced: {
						updateOnContentResize: true, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
						autoExpandHorizontalScroll: true, /*auto-expand width for horizontal scrolling: boolean*/
					}
				});
			}
		}

		// Tooltip for all tooltips
		if ( $( '.litho-tooltip' ).length > 0 && $.isFunction( window.tooltip ) ) {
			$( '.litho-tooltip' ).tooltip( { boundary: 'window' } );
		}

		// tiltbox
		if ( $( '.tilt-box' ).length > 0 && ! isMobile && 'undefined' != typeof LithoMain && $.inArray( 'tilt', LithoMain.disable_scripts ) < 0 ) {
			$( '.tilt-box' ).each( function () {
				var _self	= $( this );
				_self.tilt( {
					maxTilt: 20,
					perspective: 1000,
					easing: 'cubic-bezier(.03,.98,.52,.99)',
					scale: 1,
					speed: 500,
					transition: true,
					reset: true,
					glare: false,
					disableAxis: null,
					maxGlare: 1
				});
			});
		}

		if ( 'undefined' != typeof LithoMain ) {
			// GDPR
			var gdpr_cookie_name = 'litho_gdpr_cookie_notice_accepted' + LithoMain.site_id,
				div_wrap         = $( '.litho-cookie-policy-wrapper' );

			if ( typeof getLithoCookie( gdpr_cookie_name ) != 'undefined' && getLithoCookie( gdpr_cookie_name ) ) {
				div_wrap.addClass( 'banner-visited' );
				div_wrap.remove();
			}else{
				div_wrap.removeClass( 'banner-visited' );
			}
			
			$( '.litho-cookie-policy-button' ).on( 'click', function() {
				div_wrap.remove();
				setLithoCookie( gdpr_cookie_name, 'visited', '7' );
			});
		}

		/* Set litho Cookie Function */
		function setLithoCookie( cname, cvalue, exdays ) {
			var d = new Date();
			d.setTime( d.getTime() + ( exdays*24*60*60*1000 ) );
			var expires = ( exdays != 0 && exdays != '' ) ? d.toUTCString() : 0;
			document.cookie = cname + "=" + cvalue + ";expires=" + expires + ";path=/";
		}

		/* Remove litho Cookie Function */
		function getLithoCookie( cname ) {
			var name = cname + "=";
			var decodedCookie = decodeURIComponent( document.cookie );
			var ca = decodedCookie.split( ';' );
			for ( var i = 0; i < ca.length; i++ ) {
				var c = ca[i];
				while ( c.charAt(0) == ' ' ) {
					c = c.substring(1);
				}
				if ( c.indexOf(name) == 0 ) {
					return c.substring( name.length, c.length );
				}
			}
			return "";
		}

		// Comment form validation
		$( '#commentform .submit' ).on( 'click', function () {
			
			var fields;
				fields = "";
			var _grandParent = $( this ).parent().parent();
			
			if ( _grandParent.find( '#author' ).length == 1 ) {
				if ( $( '#author' ).val().length == 0 || $( '#author' ).val().value == '' ) {
					fields ='1';
					$( '#author' ).addClass( 'inputerror' );
				}
			}
			if ( _grandParent.find( '#comment' ).length == 1 ) {
				if ( $( '#comment' ).val().length == 0 || $( '#comment' ).val().value == '' ) {
					fields ='1';
					$( '#comment' ).addClass( 'inputerror' );
				}
			}
			if ( _grandParent.find( '#email' ).length == 1 ) {
				if ( $( '#email' ).val().length == 0 || $( '#email' ).val().length == '' ) {
					fields ='1';
					$( '#email' ).addClass( 'inputerror' );

				} else {
					var re = new RegExp();
					re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
					var sinput ;
					sinput= "" ;
					sinput = $( '#email' ).val();
					if ( ! re.test( sinput ) ) {
						fields ='1';
						$( '#email' ).addClass( 'inputerror' );
					}
				}
			}
			if ( fields != "" ) {
				return false;
			} else {
				return true;
			}
		});

		$( '.comment-field, #author, #email, #comment' ).on( 'keyup focus', function( e ) {
			$( this ).removeClass( 'inputerror' );
		});

		/* Side Icon */
		$( '.theme-demos' ).find( '.portfolio-grid' ).removeClass( 'portfolio-grid' );
		$( document ).on( 'click', '.all-demo', function() {

			if ( $( 'body' ).hasClass( 'overflow-hidden' ) ) {
				$( 'body' ).removeClass( 'overflow-hidden' );
			} else {
				$( 'body' ).addClass( 'overflow-hidden' );
			}
			
			var themeDemosObj = $( this ).parents( '.theme-demos' );
			themeDemosObj.find( '.grid-loading' ).removeClass( 'grid-loading' );
			
			if ( ! themeDemosObj.hasClass( 'show' ) ) {
				themeDemosObj.addClass( 'show' );
				var themeDemosScrollObj = themeDemosObj.find( '.demos-wrapper' );
				var scrollOptions       = themeDemosScrollObj.attr( 'data-scroll-options' ) || '{ "theme": "dark" }';
				if ( typeof ( scrollOptions ) !== 'undefined' && scrollOptions !== null  && 'undefined' != typeof LithoMain && $.inArray( 'mCustomScrollbar', LithoMain.disable_scripts ) < 0 ) {
					scrollOptions = $.parseJSON( scrollOptions );
					themeDemosScrollObj.mCustomScrollbar( scrollOptions );
				}
			} else {
				themeDemosObj.removeClass( 'show' );
			}
		});
		/* END Side Icon */
		
		/* Other Video magnific popup */
		if ( 'undefined' != typeof LithoMain && $.inArray( 'magnific-popup', LithoMain.disable_scripts ) < 0 && ( $( '.popup-youtube' ).length > 0 || $( '.popup-vimeo' ).length > 0 || $( '.popup-googlemap' ).length > 0 ) ) {

			$( '.popup-youtube, .popup-vimeo, .popup-googlemap' ).magnificPopup( {
				preloader: false,
				type: 'iframe',
				mainClass: 'mfp-fade litho-video-popup',
				removalDelay: 160,
				fixedContentPos: true,
				closeBtnInside: false,
			} );
		}

		// magnific popup dismiss
		$( document ).on( 'click', '.popup-modal-dismiss', function ( e ) {
			e.preventDefault();
			if ( 'undefined' != typeof LithoMain && $.inArray( 'magnific-popup', LithoMain.disable_scripts ) < 0 ) {
				$.magnificPopup.close();
			}
		});

		/* Group light box gallery image */
		if ( 'undefined' != typeof LithoMain && $.inArray( 'magnific-popup', LithoMain.disable_scripts ) < 0 ) {
			var lightboxgallerygroups = {};
			$( '.lightbox-group-gallery-item' ).each(function () {
				var id = $( this ).attr( 'data-group' );
				if ( ! lightboxgallerygroups[id] ) {
					lightboxgallerygroups[id] = [];
				}
				lightboxgallerygroups[id].push( this );
			});
			
			$.each( lightboxgallerygroups, function () {
				$( this ).magnificPopup({
					type: 'image',
					closeOnContentClick: true,
					closeBtnInside: false,
					fixedContentPos: true,
					gallery: { enabled: true },
					image: {
						titleSrc: function ( item ) {
							var title            = '';
							var lightbox_caption = '';

							if ( item.el.attr( 'title' ) ) {
								title = item.el.attr( 'title' );
							}

							if ( item.el.attr( 'data-lightbox-caption' ) ) {
								lightbox_caption += '<span class="litho-lightbox-caption">';
								lightbox_caption += item.el.attr( 'data-lightbox-caption' );
								lightbox_caption += '</span>';
							}
							return title + lightbox_caption;
						}
					},
					callbacks: {
						elementParse: function( item ) {
							if ( item.el[0].className === 'lightbox-group-gallery-item popup-youtube' || item.el[0].className === 'lightbox-group-gallery-item popup-vimeo' ) {
								item.type = 'iframe';
							} else {
								item.type = 'image';
							}
						}
					},
				});
			});
		}

		if ( $( '.blog-post-gallery-type' ).length > 0 && 'undefined' !== typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {
			$( '.blog-post-gallery-type' ).imagesLoaded( function () {
				$( '.blog-post-gallery-type' ).isotope({
					layoutMode: 'masonry',
					itemSelector: '.grid-item',
					percentPosition: true,
					masonry: {
						columnWidth: '.grid-sizer'
					}
				});	
				$( '.blog-post-gallery-type' ).isotope();
			});
		}

		if ( $( '.litho-related-posts-wrap .blog-grid' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {
			$( '.litho-related-posts-wrap .blog-grid' ).each( function () {
				var _self = $( this );
				_self.imagesLoaded( function () {
					_self.isotope({
						layoutMode: 'masonry',
						itemSelector: '.grid-item',
						percentPosition: true,
						masonry: {
							columnWidth: '.grid-sizer'
						}
					});
					_self.isotope();
				});
			});
		}

		if ( $( '.default-blog-grid' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {
			$( '.default-blog-grid' ).each( function () {
				var _self = $( this );
				_self.imagesLoaded( function () {
					_self.isotope({
						layoutMode: 'masonry',
						itemSelector: '.grid-item',
						percentPosition: true,
						masonry: {
							columnWidth: '.grid-sizer'
						}
					});
					_self.isotope();
				});
			});
		}

		if ( $( '.default-portfolio-grid' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {
			$( '.default-portfolio-grid' ).imagesLoaded( function () {
				$( '.default-portfolio-grid' ).isotope({
					layoutMode: 'masonry',
					itemSelector: '.grid-item',
					percentPosition: true,
					masonry: {
						columnWidth: '.grid-sizer'
					}
				});
				$( '.default-portfolio-grid' ).isotope();
			});
		}

		if ( $( '.litho-related-portfolio-wrap .grid-masonry' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {
			$( '.litho-related-portfolio-wrap .grid-masonry' ).imagesLoaded( function () {
				$( '.litho-related-portfolio-wrap .grid-masonry' ).isotope({
					layoutMode: 'masonry',
					itemSelector: '.grid-item',
					percentPosition: true,
					masonry: {
						columnWidth: '.grid-sizer'
					}
				});
				$( '.litho-related-portfolio-wrap .grid-masonry' ).isotope();
			});
		}

		// dropdown menu when elementor disabled
		if ( ! $( 'body' ).hasClass( 'elementor-default' ) ) {

			// Open menu on hover
			$( document ).on( 'mouseenter touchstart', '.dropdown', function ( e ) {

				var _this = $( this );
				_this.addClass( 'open' );
				
				if ( _this.hasClass( 'open' ) && getWindowWidth() > tabletBreakPoint  ) {
					_this.find( '.dropdown-menu' ).removeClass( 'show' );
				}
				_this.siblings( '.dropdown' ).removeClass( 'open' );
				if ( getWindowWidth() >= tabletBreakPoint ) {
					if ( $( e.target ).siblings( '.dropdown-menu' ).length ) {
						e.preventDefault();
					}
				}
				
			}).on( 'mouseleave', '.dropdown', function() {
				
				var _this = $( this );
				_this.removeClass( 'open' );
			});
		}

		// Parent menu active in mega menu
		$( '.header-common-wrapper ul.navbar-nav .megamenu' ).each( function () {
			var activeMenuLength = $( this ).find( '.megamenu-content .current-menu-item' ).length;
			if ( activeMenuLength ) {
				if ( ! $( this ).hasClass( 'current-menu-ancestor' ) ) {
					$( this ).addClass( 'current-menu-ancestor' );
				}
			}
		});

		// close side menu on outside area
		$( document ).on( 'touchstart click', '.show-menu', function ( e ) {
			if ( ! ( $( e.target ).hasClass( 'push-button' ) || $( e.target ).closest( '.push-button' ).length || $( e.target ).closest( '.push-menu' ).length || $( e.target ).closest( '.hamburger-menu' ).length || $( e.target ).parents( '.left-menu-modern' ).length || $( e.target ).closest( 'div.elementor-no-template-message' ).length ) ) {
			  $( '.close-menu' ).trigger( 'click' );
			}
		});

		// hambarger menu open
		$( document ).on( 'click', '.header-push-button .push-button', function ( event ) {
			event.preventDefault();

			if ( $( 'body' ).hasClass( 'show-menu' ) ) {
				$( 'body' ).removeClass( 'show-menu' );
				$( '.sub-menu-item' ).collapse( 'hide' );
				$( '.menu-list-item.open' ).removeClass( 'show' );
			} else {
				$( 'body' ).addClass( 'show-menu' );
			}
		} );

		// side menu submenu toggle
		$( document ).on( 'click', '.litho-left-menu > li.menu-item-has-children > .menu-toggle', function () {

			$( '.sub-menu-item' ).each( function () {
				$( this ).collapse( 'hide' );
			});
			$( '.left-sidebar-wrapper .left-sidebar-nav' ).parents( 'body' ).addClass( 'left-classic-mobile-menu' );
			setTimeout( function () {
				if ( 'undefined' != typeof LithoMain && $.inArray( 'sticky-kit', LithoMain.disable_scripts ) < 0 ) {
					$( '.left-sidebar-wrapper' ).trigger( 'sticky_kit:recalc' );
				}

			}, 500 );
		});

		// side menu submenu toggle
		$( document ).on( 'click', '.sub-menu-item > li.menu-item-has-children > .menu-toggle', function (e) {
			e.preventDefault();
			
			var _parent = $( this ).parent().find( '.sub-menu-item' );
			var _parentAttr = $( this ).attr( 'data-bs-target' );
			$( this ).parent().parent( '.sub-menu-item' ).find( '.sub-menu-item' ).each( function () {
				var _this   = $( this ),
					attr    = _this.parent().find( '.menu-toggle' ).attr( 'data-bs-target' );

				if ( attr != _parentAttr ) {
					_this.parent().find( '.menu-toggle:not(.collapsed)' ).addClass( 'collapsed' );
					_this.collapse( 'hide' );
				}
			});
			$( '.left-sidebar-wrapper .left-sidebar-nav' ).parents( 'body' ).addClass( 'left-classic-mobile-menu' );
			setTimeout( function () {
				if ( 'undefined' != typeof LithoMain && $.inArray( 'sticky-kit', LithoMain.disable_scripts ) < 0 ) {
					$( '.left-sidebar-wrapper' ).trigger( 'sticky_kit:recalc' );
				}
			}, 500);
		});

		// hamburger / side menu close
		var flag = false;
		$( document ).on( 'click', '.close-menu', function () {
			if ( ! flag ) {
				flag = true;
				setTimeout(function () {
					flag = false;
				}, 500 );

				$( 'body' ).removeClass( 'show-menu left-classic-mobile-menu' );
				$( '.sub-menu-item' ).collapse( 'hide' );
				$( '.menu-item.open' ).removeClass( 'show' );
			}
		} );

		//Close on escape key
		$( document ).on( 'keydown', function (e) {
			if ( e.keyCode === 27 ) {
				
				// Close side menu
				$( '.close-menu' ).trigger( 'click' );

				$( window ).trigger( 'closemenu' );
			}
		});

		// Return header top space
		function getTopSpaceHeaderHeight() {

			var mini_header_height = 0,
				main_header_height = 0,
				wpadminbarHeight   = 0,
				ts_height          = 0;

			if ( $( '.admin-bar #wpadminbar' ).length > 0 ) {

				wpadminbarHeight = $( '.admin-bar #wpadminbar' ).outerHeight();
				wpadminbarHeight = Math.round( wpadminbarHeight );
				ts_height        = ts_height + wpadminbarHeight;
			}

			if ( $( '.mini-header-main-wrapper' ).length > 0 ) {

				var mini_header_object = $( '.mini-header-main-wrapper' );
					mini_header_height = mini_header_object.outerHeight();
					ts_height          = ts_height + mini_header_height;
			}

			if ( $( '.header-common-wrapper.standard' ).length > 0 ) {

				var main_header_object = $( '.header-common-wrapper.standard' );
					main_header_height = main_header_object.outerHeight();
					ts_height          = ts_height + main_header_height;
			}

			return ts_height;
		}

		// header top space + title space + first section of content
		setHeaderTopSpace();
		function setHeaderTopSpace() {
			
			var mini_header_height    = 0,
				main_header_height    = 0,
				mini_header_ts_height = 0,
				main_header_ts_height = 0,
				wpadminbarHeight      = 0,
				ts_height             = 0,
				ts_full_title_height  = 0;

			if ( $( '.mini-header-main-wrapper' ).length > 0 ) {

				var mini_header_object = $( '.mini-header-main-wrapper' );
				if ( ! $( 'header' ).hasClass( 'sticky' ) ) {
					mini_header_height = mini_header_object.outerHeight();
					ts_height          = ts_height + mini_header_height;
				}
			}

			if ( $( '.header-common-wrapper.standard' ).length > 0 ) {

				var main_header_object = $( '.header-common-wrapper.standard' );
					main_header_height = main_header_object.outerHeight();
					main_header_object.css( 'margin-top', ts_height );
					ts_height = ts_height + main_header_height;
			}

			// for  Left Menu Classic mobile menu
			if ( $( '.header-common-wrapper.left-menu-classic' ).length > 0 ) {

				var main_header_object = $( '.header-common-wrapper.left-menu-classic' ).find( '.elementor section' ).first();
					main_header_height = main_header_object.outerHeight();
					ts_height = ts_height + main_header_height;
			}

			// for page content first section ( elementor )
			var pageContent  = $( '.litho-main-content-wrap' ).find( '.entry-content-inner' ),
				sectionFirst = pageContent.find( '.elementor section' ).first();

			// for page title first section
			var pageTitle        = $( '.litho-main-title-wrappper' ),
				pageTitlesection = pageTitle.find( '.elementor section' ).first();

			if ( $( '.litho-main-title-wrappper' ).length > 0 && pageTitlesection.hasClass( 'top-space' ) || $( '.default-main-title-wrappper' ).length > 0 ) {

				var padding_top = $( '.litho-main-title-wrappper' ).attr( 'data-padding-top' );
				
				if ( padding_top == '' || padding_top == undefined ) {

					padding_top = $( '.litho-main-title-wrappper' ).css( 'padding-top' );

					$( '.litho-main-title-wrappper' ).attr( 'data-padding-top', padding_top );
				}
				
				ts_height =  parseInt( ts_height ) + parseInt( padding_top );

				$( '.litho-main-title-wrappper .top-space' ).css( 'padding-top', ts_height + 'px' );

			} else if ( $( '.litho-main-inner-content-wrap' ).hasClass( 'top-space' ) && $( '.litho-main-title-wrappper' ).length === 0 ) {

				// single post
				$( '.litho-main-inner-content-wrap.top-space' ).parents( '.litho-main-content-wrap' ).css( 'margin-top', ts_height + 'px' );

			} else if ( ( sectionFirst.hasClass( 'top-space' ) || $( '.error-404' ).hasClass( 'top-space' ) ) && $( '.litho-main-title-wrappper' ).length === 0 ) {
				// First section of page content header top space
				$( '.litho-main-content-wrap .top-space, .error-404.top-space' ).parents( '.litho-main-content-wrap' ).css( 'margin-top', ts_height + 'px' );

			} else {
				
				// For Mobile Menu Top Space
				if ( getWindowWidth() <= tabletBreakPoint ) {

					$( 'header nav' ).addClass( 'mobile-top-space' );
					
					if ( $( 'header nav' ).hasClass( 'mobile-top-space' ) ) {
						$( 'body' ).css( 'padding-top', ts_height + 'px' );
					}
					
				} else {

					$( 'header nav' ).removeClass( 'mobile-top-space' );
					$( 'body' ).css( 'padding-top', '' );
					if ( ( ! $( 'header nav' ).hasClass( 'no-sticky' ) && $( 'header nav' ).hasClass( 'mobile-top-space' ) ) || $( '.left-menu-classic' ).hasClass( 'mobile-top-space' ) ) {
						$( 'body' ).css( 'padding-top', ts_height + 'px' );
					} else {
						$( 'body' ).css( 'padding-top', '' );
					}
				}
			}
			
			// FULLSCREEN min-height
			if ( $( '.full-screen' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 ) {

				if ( $( '.admin-bar #wpadminbar' ).length > 0 ) {

					wpadminbarHeight = $( '.admin-bar #wpadminbar' ).outerHeight();
					wpadminbarHeight = Math.round( wpadminbarHeight );
				}

				$( '.full-screen' ).each( function() {
					var _self = $( this );
					
					_self.parents( '.elementor-top-section' ).imagesLoaded( function () {
						
						var minheight = getWindowHeight();
						if ( _self.parents( '.elementor-top-section' ).hasClass( 'top-space' ) ) {
							
							minheight = minheight - ts_height;
							_self.css( 'min-height', ( minheight - wpadminbarHeight ) );
							
						} else {

							if ( getWindowWidth() <= tabletBreakPoint ) {

								var fulltotalHeight =  wpadminbarHeight + ts_height;

								_self.css( 'min-height', minheight - fulltotalHeight );

							} else {

								_self.css( 'min-height', ( minheight - wpadminbarHeight ) );
							}
						}

					});
				});
			}

			// FULLSCREEN Height
			if ( $( '.full-screen-height' ).length > 0 ) {
				
				if ( $( '.admin-bar #wpadminbar' ).length > 0 ) {

					wpadminbarHeight = $( '.admin-bar #wpadminbar' ).outerHeight();
					wpadminbarHeight = Math.round( wpadminbarHeight );
				}
				
				$( '.full-screen-height' ).each( function() {
					var _self = $( this );
					var _height = getWindowHeight();

					setTimeout( function () {
						if ( getWindowWidth() <= tabletBreakPoint ) {
							var fulltotalHeight =  wpadminbarHeight + ts_height;
							_self.css( 'height', ( _height - fulltotalHeight ) );
						} else {
							_self.css( 'height', ( _height - wpadminbarHeight ) );
						}
					}, 500 );
				});
			}
		}
		
		// sticky left menu
		stickyElement();
		function stickyElement() {
			if ( getWindowWidth() >= tabletBreakPoint ) { 
				if ( $( '.left-sidebar-wrapper .header-left-wrapper' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'sticky-kit', LithoMain.disable_scripts ) < 0 ) {
					$( '.left-sidebar-wrapper .header-left-wrapper' ).stick_in_parent( {
						recalc: 1
					} );
				}
			}
		}

		// Sticky footer
		stickyFooter();
		function stickyFooter() {
			if ( $( '.footer-sticky' ).length > 0 ) {
				if ( 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 ) {
					$( '.footer-sticky' ).imagesLoaded( function () {
						stickyFootercallback();
					});
				} else {
					stickyFootercallback();
				}
			}
			if ( $( '.box-layout' ).length > 0 && $( '.footer-sticky' ).length > 0 ) {
				var boxLayoutObj    = $( '.box-layout' ),
					boxLayoutwidth  = boxLayoutObj.width();
				boxLayoutObj.find( '.footer-sticky' ).css({'margin': '0 auto', 'width': boxLayoutwidth, 'max-width': boxLayoutwidth });
			}
		}

		function stickyFootercallback() {
			var footerHeight = $( '.footer-sticky' ).outerHeight();
			$( '.litho-main-content-wrap' ).css({ 'margin-bottom': footerHeight });
		}

		// For mobile left menu classic
		if ( $( '.header-common-wrapper' ).hasClass( 'left-menu-classic' ) ) {
			var $leftMenu = $( '.left-menu-classic' ).find( '.elementor-widget-litho-left-menu' );
			if ( $leftMenu.length > 0 ) {
				$leftMenu.parents( '.elementor-top-section' ).addClass( 'left-menu-classic-section' );
			}
		}

		var $navbarWidgetNavbar = $( '.header-common-wrapper.standard .elementor-widget-litho-mega-menu .navbar-collapse' );
		var $navbarWidgetNavbarToggle = $( '.header-common-wrapper.standard .elementor-widget-litho-mega-menu .navbar-toggler' );
		var mobileNavStyle = $( 'body' ).attr( 'data-mobile-nav-style' );

		// mobile navigation modern/full-screen style
		mobileModernFullscreenNavigation();
		function mobileModernFullscreenNavigation() {
			
			var layout_class = '';
			if ( $( '.box-layout' ).length > 0 ) {
				layout_class = '.box-layout';
			} else {
				layout_class = '.page-layout';
			}

			if ( getWindowWidth() <= tabletBreakPoint ) {

				if ( ( mobileNavStyle == 'modern' || mobileNavStyle == 'full-screen-menu' ) && $navbarWidgetNavbar.length > 1 && ! $( '.navbar-nav-clone' ).length ) {

					$navbarWidgetNavbar.first().find( '.navbar-nav' ).clone( false ).addClass( 'navbar-nav-clone' ).insertBefore( $navbarWidgetNavbar.last().find( '.navbar-nav' ) );
					$navbarWidgetNavbar.last().addClass( 'navbar-collapse-final' );
					$navbarWidgetNavbarToggle.last().addClass( 'navbar-toggler-final' );
				}

			} else {

				if ( ( mobileNavStyle == 'modern' || mobileNavStyle == 'full-screen-menu' ) && $navbarWidgetNavbar.length > 1 && $( '.navbar-nav-clone' ).length > 0 ) {
					$navbarWidgetNavbar.last().removeClass( 'navbar-collapse-final' );
					$navbarWidgetNavbarToggle.last().removeClass( 'navbar-toggler-final' );
					$navbarWidgetNavbar.last().find( '.navbar-nav-clone' ).remove();
				}
			}

			if ( getWindowWidth() <= tabletBreakPoint ) {

				if ( ( mobileNavStyle == 'modern' || mobileNavStyle == 'full-screen-menu' ) && ! $( '.navbar-' + mobileNavStyle + '-inner' ).length ) {

					if ( $navbarWidgetNavbar.length > 1 ) {
						
						var targetButtonClone   = $( '.header-common-wrapper.standard .navbar-toggler-final' ).clone( false ).addClass( 'navbar-toggler-clone' ).insertAfter( layout_class ),
							targetNavClone      = $( '.header-common-wrapper.standard .navbar-collapse-final' ).clone( false ).addClass( 'navbar-collapse-clone' ).attr( 'id', 'navbarNav-clone' ).insertAfter( layout_class );
						
						var mobileNavInnerHTML	= '';
							mobileNavInnerHTML += '<div class="navbar-';
							mobileNavInnerHTML += mobileNavStyle;
							mobileNavInnerHTML += '-inner"></div>';
						$( '.navbar-toggler-clone, .navbar-collapse-clone' ).wrapAll( mobileNavInnerHTML );
						$( '.navbar-toggler' ).attr( 'data-bs-target', '#navbarNav-clone' ).attr( 'aria-controls', '#navbarNav-clone' );
						
					} else {

						var targetButtonClone   = $( '.header-common-wrapper.standard .navbar-toggler' ).clone( false ).addClass( 'navbar-toggler-clone' ).insertAfter( layout_class ),
							targetNavClone      = $( '.header-common-wrapper.standard .navbar-collapse' ).clone( false ).addClass( 'navbar-collapse-clone' ).attr( 'id', 'navbarNav-clone' ).insertAfter( layout_class );
						
						var mobileNavInnerHTML	= '';
							mobileNavInnerHTML += '<div class="navbar-';
							mobileNavInnerHTML += mobileNavStyle;
							mobileNavInnerHTML += '-inner"></div>';
						$( '.navbar-toggler-clone, .navbar-collapse-clone' ).wrapAll( mobileNavInnerHTML );
						$( '.navbar-toggler' ).attr( 'data-bs-target', '#navbarNav-clone' ).attr( 'aria-controls', '#navbarNav-clone' );
					}
					
					$( '.navbar-' + mobileNavStyle + '-inner' ).find( '.dropdown-toggle' ).addClass( 'dropdown-toggle-clone' );

					if ( $( '.navbar-collapse-clone' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'mCustomScrollbar', LithoMain.disable_scripts ) < 0 ) {
						$( '.navbar-collapse-clone' ).mCustomScrollbar();
					}

					if ( mobileNavStyle == 'modern' && ! $( '.navbar-show-modern-bg' ).length ) {
						$( '<div class="navbar-show-modern-bg"></div>' ).insertAfter( layout_class );
					}
				}
			}			
		}

		// hide collaps on outside click
		$( document ).on( 'touchstart click', 'body', function ( e ) {

			if ( ! $( e.target ).parents( 'nav' ).hasClass( 'standard' ) && getWindowWidth() >= tabletBreakPoint ) {
				if ( $( '.dropdown' ).length > 0 ) {
					$( '.dropdown' ).each( function () {
						if ( $( this ).hasClass( 'open' ) ) {
							$( this ).removeClass( 'open show' );
						}
					});
				}
			}

			if ( ! $( '.navbar-collapse' ).has( e.target ).is( '.navbar-collapse' ) &&
				$( '.navbar-collapse' ).hasClass( 'show' ) &&
				! $( e.target ).hasClass( 'navbar-toggle' ) &&
				! $( e.target ).hasClass( 'navbar-collapse-clone' ) ) {
				
				$( '.navbar-collapse' ).collapse( 'hide' );
			}

			if ( ! $( e.target ).closest( '.theme-demos' ).length && $( '.theme-demos' ).hasClass( 'show' ) ) {
				$( '.theme-demos' ).removeClass( 'show' );

				if ( $( 'body' ).hasClass('overflow-hidden') ) {
					$( 'body' ).removeClass('overflow-hidden');
				}
			}
		});

		// navbar toggle
		var flag = false;
		$( document ).on( 'click', '.navbar-toggle', function ( e ) {
			if ( getWindowWidth() >= tabletBreakPoint ) {
				if ( ! flag ) {
					flag = true;
					setTimeout(function () {
						flag = false;
					}, 500);
					$( 'body' ).addClass( 'show-menu' );
				} else {
					if ( ! $( '.navbar-collapse' ).has( e.target ).is( '.navbar-collapse' ) && $( '.navbar-collapse ul' ).hasClass( 'show' ) ) {
						$( '.navbar-collapse' ).find( 'a.dropdown-toggle' ).addClass( 'collapsed' );
						$( '.navbar-collapse' ).find( 'ul.dropdown-menu' ).removeClass( 'show' );
						$( '.navbar-collapse a.dropdown-toggle' ).removeClass( 'active' );
					}
				}
			}
		});

		// Bootstrap dropdown toggle
		navbarDropdown();
		function navbarDropdown() {
			if ( $( '.navbar-modern-inner' ).length > 0 ) {
				
				if ( $( '.dropdown-toggle-clone' ).length > 0 && $.isFunction( window.dropdown ) ) {
					$( '.dropdown-toggle-clone' ).dropdown();
				}

			} else {
				if ( $( '.dropdown-toggle' ).length > 0 && $.isFunction( window.dropdown ) ) {
					$( '.dropdown-toggle' ).dropdown();
				}
			}
		}

		// Navbar collapse modern & full screen menu event
		navbarCollapseToggle();
		function navbarCollapseToggle() {
			$( '.navbar-collapse-clone.collapse' ).on( 'show.bs.collapse', function () {
				if ( ! $( 'body' ).hasClass( 'navbar-collapse-show' ) ) {
					$( 'body' ).addClass( 'navbar-collapse-show' );
					if ( $( 'body' ).attr( 'data-mobile-nav-bg-color' ) && $( '.navbar-modern-inner' ).length > 0 ) {
						var bgColor = $( 'body' ).attr( 'data-mobile-nav-bg-color' );
						$( '.navbar-show-modern-bg' ).css( 'background', bgColor );
					}
					if ( $( 'body' ).attr( 'data-mobile-nav-bg-color' ) && $( '.navbar-full-screen-menu-inner' ).length > 0 ) {
						var bgColor = $( 'body' ).attr( 'data-mobile-nav-bg-color' );
						$( '.navbar-full-screen-menu-inner' ).css( 'background', bgColor );
					}
				}

				var windowHeight = getWindowHeight();
				if ( $( '.navbar-modern-inner' ).length > 0 || $( '.navbar-full-screen-menu-inner' ).length > 0 ) {
					$( this ).css( 'max-height', windowHeight );
				} else {
					$( this ).css( 'max-height', ( windowHeight - getTopSpaceHeaderHeight() ) );
				}
				
			}).on( 'hide.bs.collapse', function () {
				if ( $( 'body' ).hasClass( 'navbar-collapse-show' ) ) {
					$( 'body' ).removeClass( 'navbar-collapse-show' );
				}
			});
		}

		// START window scroll event
		var pageScroll = 0;
		$( window ).on( 'scroll', function() {
			var scrollTop = $( this ).scrollTop();
			if ( pageScroll > 0 || scrollTop > pageScroll ) {
				headerWrapper( scrollTop );
			}
			pageScroll++;

			/****** One page navigation ******/
			var menuLinks = $( '.navbar-nav li a' ),
			scrollPos = scrollTop + 60;
			if ( menuLinks.length > 0 ) {
				menuLinks.each( function () {
					var _this = $( this );
					if( _this.attr( 'href' ) != '' && _this.attr( 'href' ) != undefined ) {
						var hasPos  = _this.attr( 'href' ).indexOf( '#' );
						if ( hasPos > -1 ) {
							var res = _this.attr( 'href' ).substring( hasPos );
							var hashID = res.replace( '#', '' );
							var elementExists = document.getElementById( hashID );
							if ( res != '' && res != '#' && elementExists != '' && elementExists != null ) {
								var refElement = $( res );
								if ( refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos ) {
									menuLinks.removeClass( 'active' );
									_this.addClass( 'active' );
								}

								if ( scrollTop < 1 ) {
									_this.removeClass( 'active' );
								}
							}
						}
					}
				});
			}
		} );
		// END window scroll event
		
		// START window resize event
		$( window ).on( 'resize', function() {
			
			//megaMenuOnResize();
			stickyElement();
			stickyFooter();

			//mobileClassicNavigation();
			mobileModernFullscreenNavigation();
			navbarCollapseToggle();
			// Bootstrap dropdown toggle
			navbarDropdown();

			setTimeout( function () {
				setHeaderTopSpace();
			}, 400 );

			if ( ! $( 'body' ).hasClass( 'elementor-editor-active' ) ) {
				setTimeout(function () {
					if ( $( '.litho-related-posts-wrap .blog-grid' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {

						$( '.litho-related-posts-wrap .blog-grid' ).imagesLoaded( function() {
							$( '.litho-related-posts-wrap .blog-grid' ).isotope();
						});
					}
					if ( $( '.blog-post-gallery-type' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {
						
						$( '.blog-post-gallery-type' ).imagesLoaded( function() {
							$( '.blog-post-gallery-type' ).isotope( 'layout' );
						});
					}
					if ( $( '.default-portfolio-grid' ).length > 0 && 'undefined' != typeof LithoMain && $.inArray( 'imagesloaded', LithoMain.disable_scripts ) < 0 && $.inArray( 'isotope', LithoMain.disable_scripts ) < 0 ) {

						$( '.default-portfolio-grid' ).imagesLoaded( function() {
							$( '.default-portfolio-grid' ).isotope( 'layout' );
						});
					}

				}, 500 );
			}
		});
		// END window resize event

		// Window orientationchange
		$( window ).on( 'orientationchange', function( e ) {

			// Close side menu
			$( '.close-menu' ).trigger( 'click' );

			$( window ).trigger( 'closemenu' );
		});

		$( window ).on( 'closemenu', function( e ) {
			// Close all dropdown
			$( '.dropdown' ).each( function () {
				var _this = $( this );
				_this.trigger( 'mouseleave' );
				_this.removeClass( 'show' );
				_this.children( '.dropdown-menu' ).removeClass( 'show' );
			});

			// Close all menu
			if ( $( '.navbar-collapse' ).hasClass( 'show' ) ) {
				$( '.navbar-collapse' ).collapse( 'hide' );
				$( '.navbar-collapse' ).removeClass( 'show' );
			}
			if ( $( 'body' ).hasClass( 'navbar-collapse-show' ) ) {
				$( 'body' ).removeClass( 'navbar-collapse-show' );
			}
			setTimeout( function () {
				if ( $( 'body' ).hasClass( 'navbar-collapse-show-after' ) ) {
					$( 'body' ).removeClass( 'navbar-collapse-show-after' );
				}
			}, 500 );

			setTimeout( function () {
				$( '.navbar-collapse' ).css( 'left', '' );
			}, 400 );
		});

		$( document ).on( 'click', '.scroll-top-arrow', function () {
			$( 'html, body' ).animate({ scrollTop: 0 }, 800 );
			return false;
		});

	} ); // End document ready

})( jQuery );
