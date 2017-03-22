jQuery(function($) {
	$(".fly-slider .slider-inner").owlCarousel({  
        items : 3,
        itemsCustom : false,
        singleItem: false,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        autoPlay : +sliderOptions.slideshowspeed,
        stopOnHover : true,
        navigation : true,
        navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        rewindNav : true,
        pagination : false,
        autoHeight : false,
	})
});

jQuery(function($) {
    $(".posts-slider .posts-slider-inner").owlCarousel({  
        itemsCustom : false,
        singleItem: true,
        autoPlay : false,
        stopOnHover : true,
        navigation : true,
        navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        rewindNav : true,
        pagination : false,
        autoHeight : true,   
    })
});


jQuery(function($) {
    $(window).bind('load', function() {
        $('.fly-slider .slider-inner').fadeIn();
        $('.posts-slider .posts-slider-inner').fadeIn();
    }); 
});
