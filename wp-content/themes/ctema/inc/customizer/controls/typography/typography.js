( function($) {

	$( document ).ready(function () {

		$( '.ctemawp-typography-select' ).each( function() {
			$(this).append( ctema_wp_fonts_list.content );
		});

		$( '.ctemawp-typography-select' ).select2();
	} );

} )( jQuery );