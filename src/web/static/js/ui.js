$( function() {
	$( "#pub" ).checkboxradio();
	$( "#priv" ).checkboxradio();
	
	$( document ).tooltip({
      track: true,
	  show: {
        effect: "slideDown",
        delay: 250
      }
    });
	
} );