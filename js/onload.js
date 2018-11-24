jQuery(document).ready(function($){
	var mainNavOuter = $("#mainNavOuter");

	$("#mainNavLink").click(function(e){
		$(this).toggleClass("active");
		$("#mainNavOuter").toggle();
		e.preventDefault();
	});

	var toTop = $("#toTop");

	toTop.click(function(){
		$("html,body").animate({scrollTop:0},"slow");
	});

	$(document).scroll(function(){
		if ($(this).scrollTop() > 70) {
			toTop.fadeIn();
		} else {
			toTop.fadeOut();
		}
	});

	if ($(document).scrollTop() > 70) {
		toTop.fadeIn();
	}

	function xsResizing() {
		if ($("#xsJsTest").is(':visible')) {
			$("#imageBlocks .text a").each(function(){
				$(this).css("min-height", $(this).outerWidth() + "px");
			});

			$("#serviceBoxes a").each(function(){
				$(this).css("min-height", $(this).outerWidth() + "px");
			});

			$("#serviceBoxesInfo .service a").each(function(){
				$(this).css("min-height", $(this).outerWidth() + "px");
			});

			$("#caseStudies .casestudy").each(function(){
				var thisWidth = $(this).outerWidth();
				var halfWidth = (thisWidth / 2);
				var LinkElement = $(this).children("a");

				LinkElement.css("min-height", thisWidth + "px");
				LinkElement.children(".inner").css("min-height", halfWidth + "px");

				if ($(this).hasClass("casestudy2") || $(this).hasClass("casestudy4") || $(this).hasClass("casestudy6")) {
					LinkElement.css("padding-top", halfWidth + "px");
				}
			});
		}
	}

	xsResizing();

	$(window).resize(function(){
		xsResizing();
	});
});
