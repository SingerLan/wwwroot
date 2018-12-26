/**
 * Theme functions file.
 *
 * Contains handlers for navigation, search and scroll to top button.
 */


( function( $ ) {
	"use strict";

	var body, masthead, menuToggle, mainNavigation, additionalNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: screenReaderText.expand
		} ) );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		} );
	}
	initMainNavigation( $( '.main-navigation' ) );

	masthead             = $( '#masthead' );
	menuToggle           = masthead.find( '#menu-toggle' );
	siteHeaderMenu       = masthead.find( '#site-header-menu' );
	mainNavigation       = masthead.find( '#main-navigation' );
	additionalNavigation = masthead.find( '#additional-navigation' );

	// Enable menuToggle.
	( function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggle.add( mainNavigation ).add( additionalNavigation ).attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click.windmill', function() {
			$( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );

			// jscs:disable
			$( this ).add( mainNavigation ).add( additionalNavigation ).attr( 'aria-expanded', $( this ).add( mainNavigation ).add( additionalNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! mainNavigation.length || ! mainNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 992 ) {
				$( document.body ).on( 'touchstart.windmill', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				mainNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.windmill', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				mainNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.windmill' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.windmill', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		mainNavigation.find( 'a' ).on( 'focus.windmill blur.windmill', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();

	// Add the default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( window.innerWidth < 992 ) {
			if ( menuToggle.hasClass( 'toggled-on' ) ) {
				menuToggle.attr( 'aria-expanded', 'true' );
			} else {
				menuToggle.attr( 'aria-expanded', 'false' );
			}

			if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
				mainNavigation.attr( 'aria-expanded', 'true' );
				additionalNavigation.attr( 'aria-expanded', 'true' );
			} else {
				mainNavigation.attr( 'aria-expanded', 'false' );
				additionalNavigation.attr( 'aria-expanded', 'false' );
			}

			menuToggle.attr( 'aria-controls', 'main-navigation additional-navigation' );
		} else {
			menuToggle.removeAttr( 'aria-expanded' );
			mainNavigation.removeAttr( 'aria-expanded' );
			additionalNavigation.removeAttr( 'aria-expanded' );
			menuToggle.removeAttr( 'aria-controls' );
		}
	}

	// Add 'below-entry-meta' class to elements.
	function belowEntryMetaClass( param ) {
		if ( body.hasClass( 'page' ) || body.hasClass( 'search' ) || body.hasClass( 'single-attachment' ) || body.hasClass( 'error404' ) ) {
			return;
		}

		$( '.entry-content' ).find( param ).each( function() {
			var element              = $( this ),
				elementPos           = element.offset(),
				elementPosTop        = elementPos.top,
				entryFooter          = element.closest( 'article' ).find( '.entry-footer' ),
				entryFooterPos       = entryFooter.offset(),
				entryFooterPosBottom = entryFooterPos.top + ( entryFooter.height() + 20 ),
				caption              = element.closest( 'figure' ),
				newImg;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > entryFooterPosBottom ) {

				// Check if full-size images and captions are larger than or equal to 840px.
				if ( 'img.size-full' === param ) {

					// Create an image to find native image width of resized images (i.e. max-width: 100%).
					newImg = new Image();
					newImg.src = element.attr( 'src' );

					$( newImg ).on( 'load.windmill', function() {
						if ( newImg.width >= 690  ) {
							element.addClass( 'below-entry-meta' );

							if ( caption.hasClass( 'wp-caption' ) ) {
								caption.addClass( 'below-entry-meta' );
								caption.removeAttr( 'style' );
							}
						}
					} );
				} else {
					element.addClass( 'below-entry-meta' );
				}
			} else {
				element.removeClass( 'below-entry-meta' );
				caption.removeClass( 'below-entry-meta' );
			}
		} );
	}

	$( document ).ready( function() {
		body = $( document.body );

		$( window )
			.on( 'load.windmill', onResizeARIA )
			.on( 'resize.windmill', function() {
				clearTimeout( resizeTimer );
				resizeTimer = setTimeout( function() {
					belowEntryMetaClass( 'img.size-full' );
					belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
				}, 300 );
				onResizeARIA();
			} );

		belowEntryMetaClass( 'img.size-full' );
		belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );

		// Search.
		$('#button-search').on('click', function(event) {
			event.preventDefault();
			$('#search-overlay').addClass('search-overlay-open');
			$('#search-overlay > form > label > input[type="search"]').focus();
		});

		$('#search-overlay, #search-overlay button.search-overlay-close').on('click keyup', function(event) {
			if (event.target == this || event.target.className == 'search-overlay-close' || event.keyCode == 27) {
				$(this).removeClass('search-overlay-open');
			}
		});

		// Scroll to top button.
		$( window )
			.scroll( function() {
				if ( $( this ).scrollTop() > $( window ).height() / 2 ) {
					$( '#scroll-to-top' ).fadeIn( 1000 );
				} else {
					$( '#scroll-to-top' ).fadeOut( 1000 );
				}
			} );

			$( '#scroll-to-top' ).on( 'click', function() {
				$( 'html, body' ).animate( { scrollTop: 0 }, 1000 );
				return false;
			} );
	} );
} )( jQuery );

$.fn.postLike = function () {  
    if ($(this).hasClass('done')) {  
        alert('您已经赞过了~');  
        return false;  
    } else {  
        $(this).addClass('done');  
        var id = $(this).data("id"),  
            action = $(this).data('action'),  
            rateHolder = $(this).children('.count');  
        var ajax_data = {  
            action: "dotGood",  
            um_id: id,  
            um_action: action  
        };  
       $.post("/wp-admin/admin-ajax.php", ajax_data,  
		//$.post(site_url.ajax_url, ajax_data,
            function (data) {  
                $(rateHolder).html(data);  
            });  
        return false;  
    }  
};  
$(".dotGood").click(function () {  
    $(this).postLike();  
});  

(function( $ ){
    $.fn.miPopup = function() { 

    	this.bind('click touchstart', function(event) {
    		// event.preventDefault();
    		
    		var html = $('<div class="dialog_overlay"></div>');

    		var selector = $(this).data('selector');

    		var close_icon = $(selector).find('.btn-close');

    		$(selector).addClass('open').find('.btn-close').on('click touchstart', function(event) {
    			event.preventDefault();
    			$(html).remove();
    			$(selector).removeClass('open');
				$(selector).addClass('close');
				$('body').removeClass('modal-open');
    			setTimeout(function(){
					$(selector).removeClass('close');
				},200);
				close_icon.unbind();
    		});
    		$('body').addClass('modal-open');
    		$('body').append(html);

    		$('body').on("keyup", function (e) {
		        if (e.keyCode === 27) close_icon.click();
		    });

    	});   	
        	    		    
    };  	
	$('[data-module="miPopup"]').miPopup();	
})( jQuery );
