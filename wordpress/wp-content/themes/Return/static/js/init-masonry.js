/**
 * Init Masonry.
 */


( function( $ ) {
	"use strict";

	$( document ).ready( function() {
		// init Masonry
		var $grid = $( '#content-masonry' ).masonry( {
			itemSelector: '.js-masonry-item',
			columnWidth: '.masonry-grid-sizer',
			percentPosition: true
		} );

		// layout Masonry after each image loads
		$grid.imagesLoaded().progress( function() {
			$grid.masonry( 'layout' );
		} );

	    // add class to items after Masonry layout complete
	    $grid.on( 'layoutComplete', function( event, laidOutItems ) {
	        $( '.js-masonry-item' ).each( function(i) {
	            setTimeout( function() {
	                $( '.js-masonry-item' ).eq(i).addClass( 'is-visible' );
	            }, 200 * i );
	        } );
	    } );
	} );
} )( jQuery );
