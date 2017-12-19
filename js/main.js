(function( $ ){


	var cosparell = {

		init: function(){
			this.createMainSlider();
			this.backtoTop();
			this.animateSearchBox();
			this.createMobileMenu();
			this.fixAdminBar();
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

		backtoTop: function() {
			var $icon = $( '.footer-scroll' );
			$icon.on( 'click' , function () {
				  $("body,html").animate( { scrollTop: 0 }, 600);
				  return false;
			});
		},
		animateSearchBox: function() {
			var headerIcons = $( '.header-icons' );
				$searchBox = headerIcons.find( '.search-box' );

			headerIcons.on( 'click' , '.search-icon', function (e) {

				var $this = $( this );

				if( $( this ).hasClass( 'shown' ) ){
					$searchBox.animate( {width : '0'} , 400 , function() {
						$( this ).hide();
						$this.removeClass( 'shown' );
					} );
				}
				else{
					$searchBox.show().animate( {width: '250px'}, 400, function(){
						$this.addClass( 'shown' );
					} );

				}
		     		e.stopPropagation();
		   	 });

			$searchBox.find( 'input' ).on( 'click' , function( event ){
				event.stopPropagation();
			} );

			$( 'body' ).on( 'click', function() {
				$searchBox.animate( {width : '40px'} , 400 ).hide();

			});

		},

		createMobileMenu: function() {
			var api,
				menuContainer = $( '.cosparell-mobile-menu' );
			menuContainer.mmenu();
			api = menuContainer.data( 'mmenu' );

			$( '.navicon' ).click( function() {
				api.open();
			} );
		},

		fixAdminBar: function() {
			//Mmenu sometimes wrapes adminbar inside its div.
			var mmPage = $( 'div.mm-page' );
			if ( mmPage.length && mmPage.find( '#wpadminbar' ).length ) {
				var $adminBar = $( '#wpadminbar' );
				$( 'body' ).append( $adminBar );
			}
		},

	};

	cosparell.init();

})( jQuery );