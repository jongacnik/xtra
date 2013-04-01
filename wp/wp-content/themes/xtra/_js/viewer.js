'use strict';

//this original height is the height in pixels of the PDF at 100% height,
//we add 100 pixels so even with top margin we fit in view finder. Set a minimum scale of 1
var vH = 792+72;
var winH = $(window).height();
var scale = winH/vH;
scale = scale<1 ? scale=1 : scale=scale;

PDFJS.getDocument(thePDF).then(function(pdf) {

	function renderPage(p,c,s){
		pdf.getPage(p+1).then(function(page){
			var scale = s;
			var viewport = page.getViewport(scale);
			
			var context = c[0].getContext('2d');

			c[0].height = viewport.height;
			c[0].width = viewport.width;
			
			$('.wrapper').css('width',c[0].width);

			var renderContext = {
				canvasContext: context,
				viewport: viewport
			};
			page.render(renderContext);
		});
	}

	var numPages = pdf.numPages;
	for (var i=1;i<=numPages;i++){
		$('.wrapper').append('<canvas class="page" />');
	}

	$('.page').each(function(e){
		var canvas = $(this);
		renderPage(e,canvas,scale);
	});

	$('#zoomIn').click(function(){
		scale += .25;
		$('.page').each(function(e){
			var canvas = $(this);
			renderPage(e,canvas,scale);
		});
	});

	$('#zoomOut').click(function(){
		scale -= .25;
		$('.page').each(function(e){
			var canvas = $(this);
			renderPage(e,canvas,scale);
		});
	});
  
});