/**
 *
 * Template  frontend scripts
 *
 **/

 //Boxed layout//
 jQuery(document).ready(function(){
	 "use strict";
	if ($Esense_LAYOUT == 'boxed') {
	if (jQuery(window).width() <= $Esense_TABLET_WIDTH) {
		jQuery("body").removeClass("boxed");
	}
	 jQuery(window).resize(function() {
     if (jQuery(window).width() <= $Esense_TABLET_WIDTH) {
		jQuery("body").removeClass("boxed");
	}
	if (jQuery(window).width() > $Esense_TABLET_WIDTH) {
		
		jQuery("body").addClass("boxed");
	} 
	
    });
	}
  });
