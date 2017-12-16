/**
 *  Contains custom scripts for customizer controls pane
 */

( function ( $, window, undefined ) {

	"use strict";

	window.CosparellCC = {
		Models: { },
		Views: { }
	};

	/*==============================
	 Main
	 ===============================*/

	CosparellCC.Views.Main = Backbone.View.extend( {
		el: '',
		events: {
			
		},
		initialize: function () {

		}
	} );

	new CosparellCC.Views.Main();

} )( jQuery, window, undefined );

