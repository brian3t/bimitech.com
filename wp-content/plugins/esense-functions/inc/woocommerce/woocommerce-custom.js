// JavaScript Document
//Woocommerce scripts //
jQuery(document).ready(function(){
	"use strict";
	
	jQuery(".compare").each(function () {
								var _this    = jQuery(this);
								var	_title = _this.text();
									_this.attr('title', _title);
									_this.tipsy({gravity: 'ne', fade: true, html: true, title:"title" , opacity:1 })
			
							});
	jQuery(".yith-wcwl-wishlistexistsbrowse a").each(function () {
								var _this    = jQuery(this);
								var _title= _this.parent().find(".feedback").text();
									_this.attr('title', _title);
									_this.tipsy({gravity: 'nw', fade: true, html: true, title:"title" , opacity:1 })
			
							});
	jQuery(".add_to_wishlist").each(function () {
								var _this    = jQuery(this);
								var	_title = _this.text();
									_this.attr('title', _title);
									_this.tipsy({gravity: 'nw', fade: true, html: true, title:"title" , opacity:1 })
			
							});
	jQuery(".toggleGrid").tipsy({gravity: 's', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	jQuery(".toggleList").tipsy({gravity: 's', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	jQuery(".toggleGrid").click(function(){
				jQuery(".toggleList").removeClass("active");
				jQuery(".toggleGrid").addClass("active");
				jQuery(".products").removeClass("list-layout");
				jQuery(".products").addClass("grid-layout");
				});
	jQuery(".toggleList").click(function(){
				jQuery(".toggleGrid").removeClass("active");
				jQuery(".toggleList").addClass("active");
				jQuery(".products").removeClass("grid-layout");
				jQuery(".products").addClass("list-layout");
				});
});		

