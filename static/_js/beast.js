var s, beast = {

	config: {
		
	},

	init: function() {
		s = this.config
		var that = this

		that.header()

		if($('body').hasClass('home')){
			that.views.home.init()
		}

		$('.issueChunk img').fadeIn()
	},

	header: function(){
		$(window).scroll(function() {
		    if ($(this).scrollTop() >= 214) {
		        $('.mainNav').addClass('fixed')
		    } else {
		        $('.mainNav').removeClass('fixed')
		    }
		})
	},

	views : {

		home : {

			init: function(){
				$('.loader').fadeIn()
				$('.slider').imagesLoaded(function(){
					$('.loader').hide()
					$(this).cycle({
						'slides': '> a.slide',
						'fx': 'scrollHorz',
						'speed': 300
					}).fadeIn(function(){
						$('.sliderLoader').css('border','5px solid black')
					})
				})
				$('.ads').cycle({
					'slides': '> li',
					'timeout':5000,
					'speed': 300
				})
			}
		}

	}

};

$(function(){
	beast.init()
})