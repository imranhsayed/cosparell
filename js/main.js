(function($){


	window.cosparell = {

		init: function(){
			this.createMainSlider();
			this.backtoTop();
			this.animateSearchBox();
		},

		createMainSlider: function(){
			var cosparellSlider = $( '#cosparell-slider' );
			if ( cosparellSlider.length ) {
				cosparellSlider.slick( {
					// Custom Option
					dots: true,
					infinite: true,
					speed: 500,
					fade: true,
					cssEase: 'linear',
					autoplay: true
				} );
			}
		},

		backtoTop: function()
		{
			var $icon = $( '.footer-scroll' );
			$icon.on( 'click' , function () {
				  $("body,html").animate( { scrollTop: 0 }, 600); 
				  return false;
			});
		},
		animateSearchBox: function(){
			var $searchBox = $('.header-icons').find('.search-box');

			$('.header-icons').on( 'click' , '.search-icon', function (e) {

				var $this = $(this);

				if( $(this).hasClass('shown') ){
					$searchBox.animate( {width : '0'} , 400 , function(){
						$(this).hide();
						$this.removeClass('shown');
					} );
				}
				else{
					$searchBox.show().animate( {width: '250px'}, 400, function(){
						$this.addClass('shown');
					} );
					
				}
		     		e.stopPropagation();
		   	 });

			$searchBox.find('input').on( 'click' , function(e){
				e.stopPropagation();
			} );

			$('body').on('click', function(){
				$searchBox.animate( {width : '40px'} , 400 ).hide();

			});

		}


	};


	window.cosparell.init();

})(jQuery);