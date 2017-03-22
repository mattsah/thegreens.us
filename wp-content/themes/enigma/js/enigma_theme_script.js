 //enigma  social tooltip js
 jQuery(function(){
	jQuery('li').tooltip();
	jQuery("[data-toggle='tooltip']").tooltip();
	jQuery("[data-toggle='popover']").popover();



	/*----------------------------------------------------*/
	/*	Open external links in new window
	/*----------------------------------------------------*/

	jQuery('a').each(function() {
		var a = new RegExp('/' + window.location.host + '/');
		if(!a.test(this.href)) {
			jQuery(this).click(function(event) {
				event.preventDefault();
				event.stopPropagation();
				window.open(this.href, '_blank');
			});
		}
	});
});

/*----------------------------------------------------*/
/*	Scroll To Top Section
/*----------------------------------------------------*/
	jQuery(document).ready(function () {

		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.enigma_scrollup').fadeIn();
			} else {
				jQuery('.enigma_scrollup').fadeOut();
			}
		});

		jQuery('.enigma_scrollup').click(function () {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});

	});


	jQuery.browser = {};
			(function () {
				jQuery.browser.msie = false;
				jQuery.browser.version = 0;
				if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
					jQuery.browser.msie = true;
					jQuery.browser.version = RegExp.$1;
				}
			})();
