$(window).on('load', function() {
	$("#flexiselDemo3").flexisel({
	visibleItems: 3,
	itemsToScroll: 1,         
	autoPlay: 
	{
		enable: true,
		interval: 2500,
		pauseOnHover: true
	}        
    });
});