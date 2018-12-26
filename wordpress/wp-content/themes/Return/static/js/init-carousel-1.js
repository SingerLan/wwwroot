/**
 * Init Carousel.
 */


( function( $ ) {
	"use strict";

	$( document ).ready( function() {
		// Header Carousel.
		$( '#featured-carousel' ).slick( {
			dots: true,
			autoplay: true,
			autoplaySpeed: 10000,
			fade: true,
			cssEase: 'linear'
		} );
	} );
} )( jQuery );
