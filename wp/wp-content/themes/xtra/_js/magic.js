//stick elements based on anchor div
function glueIt() {
	var a = function() {
		var b = $(window).scrollTop();
		var d = $(".glue-anchor").offset().top-90;
		var c=$(".glue");
		// if (b>d) {
		// 	//if (b<1200){
		// 	//	$('.glue-anchor').css('height',1);
		//  	//	c.css({position:"fixed",top:"90px"});
		// 	//} else {
		// 		$('.glue-anchor').css('height',0);
		// 		c.css({position:"relative",top:"90px"})
		// 		//c.css({position:"relative",top:"980px"})
		// 	//}
			
		// } else {
			if (b<=d) {
				$('.glue-anchor').css('height',0);
				c.css({position:"relative",top:""})
			}
		//}
	};
	$(window).scroll(a);
}

$(function(){

	//initiate the sticky nav
	$('#stickable-boundary').stickyHeader();

	////////////////////////////
	// HOME                   //
	////////////////////////////

	//adjust borders on home items depending on amount
	if ($('#home-left').height()<$('#home-center').height()){
		var numHomeItems = $('#home-center li').size();
		if (numHomeItems%2 == 0){
			$('#home-center li:nth-last-child(-n+2)').css('border-bottom','none').css('margin-bottom',0);
		} else {
			$('#home-center li:last-child').css('border-bottom','none').css('margin-bottom',0);
		}
	}

	//flash the artist project box
	$('#home-artistp').hover(function(){
		$(this).addClass('flash');
	}, function(){
		$(this).removeClass('flash');
	});

	////////////////////////////
	// TOC                    //
	////////////////////////////

	//stick the issue info
	if ($('.glue-anchor').length){
		glueIt();
	}

	//render the issue archive in the right sidebar
	$('.volume-number').each(function(){
		$(this).click(function(){
			$('#archive-list > li > ul').slideUp(200);
			$(this).siblings('ul').slideDown(200);
		});
	});
	
	////////////////////////////
	// ARTICLES               //
	////////////////////////////

	$('.wp-caption').removeAttr('style');
	
	$('#footnote-list').insertAfter('#page-nav');
	
	$('#footnote-list li').each(function(){
		var number = $(this).attr('id');
		number = number.substr(9);
		$(this).attr('data-content',number);
	});
	
	$('.refmark').wrapInner('<span />');
		
	$('a[href*=#]').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
	        && location.hostname == this.hostname) {
	            var $target = $(this.hash);
	            $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
	            if ($target.length) {
	                var targetOffset = $target.offset().top - 52;
	                $('html,body').animate({scrollTop: targetOffset}, 200);
	                return false;
	            }
	        }
	});

	//grow images in an article to full-width
	$('#pages img').each(function(){
		var bigornot = false;
		$(this).click(function(){
			var imgH = $(this).height();
			var imgW = $(this).width();
			if (imgH > imgW){
				if (!bigornot){
					$(this).css('width',700);
					bigornot = true;
				} else {
					$(this).css('width',300);
					bigornot = false;
				}
			}
		});
	});


	////////////////////////////
	// EVENTS                 //
	////////////////////////////

	//initiate the cycle for each event
	$('.event-imgs').each(function(){
		var p = this.parentNode;
		$(this).cycle({
			fx: 'scrollHorz',
			speed: 300,
			prev:   $('.prev', p),
      		next:   $('.next', p),
      		pager:  $('.dots', p),
			pagerAnchorBuilder: function(idx, slide) { 
        		return '<a href="#">&#9679;</a>'; 
    		} 
		});
	});

	//create the event archive
	$('#event-archive>ul>li').each(function(){
		$(this).click(function(){
			if ($(this).attr('class') != 'activeEvent'){
				$('#event-archive>ul>li').removeClass('activeEvent');
				$(this).addClass('activeEvent');
				$('#event-archive > ul > li > ul').slideUp(200);
				$(this).children('ul').slideDown(200);
			}
		});
	});

});