/**
 * Init Carousel.
 */


( function( $ ) {
	"use strict";

	$( document ).ready( function() {
		// Header Carousel.
		$( '#featured-carousel' ).slick( {
			centerMode: true,
			slidesToShow: 3,
			centerPadding: '180px',
			autoplay: true,
			autoplaySpeed: 10000,
			responsive: [
				{
					breakpoint: 1920,
					settings: {
						slidesToShow: 2,
						centerPadding: '30px',
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						centerPadding: '0px',
					}
				}
			]
		} );
	} );
} )( jQuery );
