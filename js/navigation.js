/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();


/*******************************
       SUB MENU NAVIGATION
********************************/
$(document).ready(function(){
	var $root = $('html, body');

	$(window).resize(function(){
		$("#submenu_pusher").height( $("#submenu_wrapper").outerHeight() );
	});
	$("#submenu_pusher").height( $("#submenu_wrapper").outerHeight() );


	$("#submenu_wrapper a").click(function(event){

		event.preventDefault();

		// $("#submenu_wrapper a").removeClass("current");
		// $(this).addClass("current"); // on n'applique la classe current qu'au scroll, plus smooth
		var href = $.attr(this, 'href');

		$root.animate({
			scrollTop: $(href).offset().top - $("#submenu_wrapper").outerHeight()
		}, 500, function () {
			history.pushState(null, null, href);
		});
	});

	//Direct link to anchor
	if ($("#submenu_wrapper").length ) {

		hash = window.location.hash;
		if(hash==""){
			$('#submenu_wrapper a[href="#presentation"]').addClass("current");
		}
		else{
			$('#submenu_wrapper a[href="'+hash+'"]').addClass("current");
			$root.animate({
				scrollTop: $(hash).offset().top - $("#submenu_wrapper").outerHeight()
			}, 500);
		}

		//Update submenu current class on scroll
		$submenu_items = $("#submenu_wrapper a");
		$subtitles = $("#presentation, .vc-titreancre-title");
		$( window ).scroll(function() {
			current_scroll = $(window).scrollTop();
			submenu_wrapper_height = $("#submenu_wrapper").outerHeight();
			//GET Current SUBTITLE
			var $current_subtitle = '';
			$subtitles.each(function(){
				submenu_offset = $(this).offset();
				submenu_top = submenu_offset.top;
				if(submenu_top < current_scroll + submenu_wrapper_height + 20){
					$current_subtitle = $(this);
				}
			});

			if($current_subtitle!=''){
				//GET Associated submenu item
				hash = "#" + $current_subtitle.attr('id');
				$current_submenu = $('#submenu_wrapper a[href="'+hash+'"]');
				if($current_submenu.hasClass("current")){
					//Do nothing
				}
				else{
					//Update current class
					$("#submenu_wrapper a").removeClass("current");
					$current_submenu.addClass("current");
				}
			}
		});
	}



});
