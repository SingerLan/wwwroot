/**
 * Affix Sidebar.
 */

( function( $ ) {
	"use strict";

	var $window, curscroll, nextscroll, resizeTimer;

	function affix() {
		nextscroll = $window.scrollTop();

		$( ".affix" ).each( function() {
			var bottom_compare, top_compare, screen_scroll, parent_top, parent_height, parent_bottom, scroll_status = 0, topab;
			var width = $( '#secondary' ).width();
			var sidebarID = "#" + $( this ).attr( ( "id" ) );

			bottom_compare = $( sidebarID ).offset().top + $( sidebarID ).outerHeight( true );
			screen_scroll = $window.scrollTop() + $window.height();
			parent_top = $( '#primary' ).offset().top;
			parent_height = $( '#primary' ).height();
			parent_bottom = parent_top + parent_height;
			topab = parent_height - $( sidebarID ).outerHeight( true );

			if ( window.innerWidth > 991 ) {
				if ( parent_height > $( sidebarID ).outerHeight( true ) ) {
					if ( $window.scrollTop() < parent_top ) {
						scroll_status = 0;
					} else if ( ( $window.scrollTop() >= parent_top ) && ( screen_scroll < parent_bottom ) ) {
						if ( curscroll <= nextscroll ) {
							scroll_status = 1;
						} else if ( curscroll > nextscroll ) {
							scroll_status = 3;
						}
					} else if ( screen_scroll >= parent_bottom ) {
						scroll_status = 2;
					}

					if ( scroll_status == 0 ) {
						$( sidebarID ).css( {
							"position" : "static",
							"top"      : "auto",
							"bottom"   : "auto"
						} );
					} else if ( scroll_status == 1 ) {
						if ( $window.height() > $( sidebarID ).outerHeight( true ) ) {
							var admin_bar = $( '#wpadminbar' );

							if ( admin_bar.length != 0 ) {
								var sidebar_height_fixed = 45 + admin_bar.height() + 'px';
							} else {
								var sidebar_height_fixed = 45 + 'px';
							}

							$( sidebarID ).css( {
								"position" : "fixed",
								"top"      : sidebar_height_fixed,
								"bottom"   : "auto",
								"width"    : width
							} );
						} else {
							if ( screen_scroll < bottom_compare ) {
								topab = $( sidebarID ).offset().top - parent_top;

								$( sidebarID ).css( {
									"position" : "absolute",
									"top"      : topab,
									"bottom"   : "auto",
									"width"    : width
								} );
							} else {
								$( sidebarID ).css( {
									"position" : "fixed",
									"top"      : "auto",
									"bottom"   : "1px",
									"width"    : width
								} );
							}
						}
					} else if ( scroll_status == 3 ) {
						if ( $window.scrollTop() > ( $( sidebarID ).offset().top ) ) {
							topab = $( sidebarID ).offset().top - parent_top;

							$( sidebarID ).css( {
								"position" : "absolute",
								"top"      : topab,
								"bottom"   : "auto",
								"width"    : width
							} );
						} else {
							var admin_bar = $( '#wpadminbar' );

							if ( admin_bar.length != 0 ) {
								var sidebar_height_fixed = 45 + admin_bar.height() + 'px';
							} else {
								var sidebar_height_fixed = 45 + 'px';
							}

							$( sidebarID ).css( {
								"position" : "fixed",
								"top"      : sidebar_height_fixed,
								"bottom"   : "auto",
								"width"    : width
							} );
						}
					} else if ( scroll_status == 2 ) {
						if ( $window.height() > $( sidebarID ).outerHeight( true ) ) {
							var status2_inner = 0;

							if ( curscroll <= nextscroll ) {
								status2_inner = 1;
							} else if ( curscroll > nextscroll ) {
								status2_inner = 2;
							}

							if ( ( ( status2_inner == 1 ) && ( bottom_compare < parent_bottom ) ) || ( ( status2_inner == 2 ) && ( $window.scrollTop() < $( sidebarID ).offset().top ) ) ) {
								var admin_bar = $( '#wpadminbar' );

								if ( admin_bar.length != 0 ) {
									var sidebar_height_fixed = 45 + admin_bar.height() + 'px';
								} else {
									var sidebar_height_fixed = 45 + 'px';
								}

								$( sidebarID ).css( {
									"position" : "fixed",
									"top"      : sidebar_height_fixed,
									"bottom"   : "auto",
									"width"    : width
								} );
							} else {
								$( sidebarID ).css( {
									"position" : "absolute",
									"top"      : topab,
									"bottom"   : "auto",
									"width"    : width
								} );
							}
						} else {
							$( sidebarID ).css( {
								"position" : "absolute",
								"top"      : topab,
								"bottom"   : "auto",
								"width"    : width
							} );
						}
					}
				}
			}

			$( sidebarID ).parent().css( "height", $( sidebarID ).height() );
		} );

		curscroll = nextscroll;
	}

	function resize() {
		$( ".affix" ).each( function() {
			var sidebarID = "#" + $( this ).attr( ( "id" ) );

			if ( window.innerWidth > 991 ) {
				if ( $( this ).parent().hasClass( 'sidebar-wrapper' ) ) {
					var width = $( '.sidebar-wrapper' ).width();

					$( sidebarID ).css( {
						"width" : width
					} );
				}
			} else {
				$( sidebarID ).css( {
					"position" : "static",
					"top"      : "auto",
					"bottom"   : "auto",
					"width"    : "auto"
				} );
			}
		} );
	}

	function resizeAndAffix() {
		resize();
		affix();
	}

	$( document ).ready( function() {
		$window = $( window );

		$( ".affix" ).each( function() {
			$( this ).wrap( "<div class='sidebar-wrapper'></div>" );
		} );

		$window
			.on( 'scroll.windmill', affix )
			.on( 'resize.windmill', function() {
				clearTimeout( resizeTimer );
				resizeTimer = setTimeout( resizeAndAffix, 50 );
			} );

		resizeAndAffix();
	} );
} )( jQuery );
