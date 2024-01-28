jQuery(document).ready(function($) {


	// Toggle mobile menu
	$(".nav-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$(".mobile-menu").slideToggle();
		if ($(".search-toggle").hasClass("active")) {
			$(".search-toggle").removeClass("active");
			$(".search-container").slideToggle();
		}
		return false;
	});
	//Toggle menu if resize from mobile to desktop
	$(window).resize(function() {
		if ($(window).width() > 680) {
			$(".mobile-menu").hide();
			$(".nav-toggle").removeClass("active");
		}
	});
	
	// Toggle search container
	$(".search-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$(".search-container").slideToggle();
		if ($(".nav-toggle").hasClass("active")) {
			$(".nav-toggle").removeClass("active");
			$(".mobile-menu").slideToggle();
		}
		return false;
	});
	//Togle
	// Add focus class to menus
	$( '.dropdown-menu a' ).on( 'blur focus', function( e ) {
		$( this ).parents( 'li.menu-item-has-children' ).toggleClass( 'focus' );
	} );
	
	
	
	// smooth scroll to the top	
	jQuery(document).ready(function($){
	    $('.to-the-top').click(function(){
	        $("html, body").animate({ scrollTop: 0 }, 500);
	        return false;
	    });
	});
	
	
	// resize videos after container
	var vidSelector = ".post iframe, .post object, .post video";	
	var resizeVideo = function(sSel) {
		$( sSel ).each(function() {
			var $video = $(this),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( !$video.attr("data-origwidth") ) {
				$video.attr("data-origwidth", $video.attr("width"));
				$video.attr("data-origheight", $video.attr("height"));
			}

			var ratio = iTargetWidth / $video.attr("data-origwidth");

			$video.css("width", iTargetWidth + "px");
			$video.css("height", ( $video.attr("data-origheight") * ratio ) + "px");
		});
	};

	resizeVideo(vidSelector);

	$(window).resize(function() {
		resizeVideo(vidSelector);
	});

});