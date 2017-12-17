var Cosparell = (function( $ ) {

	"use strict";

	var component = {};

	component.init = function() {
		component.nav = $('#masthead');
		component.nav.on('click', component.doSomething );
	};

	component.doSomething = function() {
		console.log('hello');
	};

	return component;

})( jQuery );

Cosparell.init();
