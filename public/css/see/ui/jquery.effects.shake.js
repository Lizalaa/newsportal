/*
 * jQuery UI Effects Shake 1.9m5
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Shake
 *
 * Depends:
 *	jquery.effects.core.js
 */
(function( $, undefined ) {

$.effects.effect.shake = function( o ) {

	return this.queue( function() {

		var el = $( this ),
			props = [ "position", "top", "bottom", "left", "right" ],
			mode = $.effects.setMode( el, o.mode || "effect" ),
			direction = o.direction || "left",
			distance = o.distance || 20,
			times = o.times || 3,
			anims = times * 2 + 1,
			speed = o.duration,
			ref = (direction == "up" || direction == "down") ? "top" : "left",
			motion = (direction == "up" || direction == "left") ? "pos" : "neg",
			animation = {},
			animation1 = {},
			animation2 = {},
			i,

			// we will need to re-assemble the queue to stack our animations in place
			queue = el.queue(),
			queuelen = queue.length;
			

		$.effects.save( el, props );
		el.show();
		$.effects.createWrapper( el );

		// Animation
		animation[ ref ] = ( motion == "pos" ? "-=" : "+=" ) + distance;
		animation1[ ref ] = ( motion == "pos" ? "+=" : "-=" ) + distance * 2;
		animation2[ ref ] = ( motion == "pos" ? "-=" : "+=" ) + distance * 2;

		// Animate
		el.animate( animation, speed, o.easing );

		// Shakes
		for ( i = 1; i < times; i++ ) {
			el.animate( animation1, speed, o.easing ).animate( animation2, speed, o.easing );
		};
		el
			.animate( animation1, speed, o.easing )
			.animate( animation, speed / 2, o.easing )
			.queue( function( next ) {
				if ( mode === "hide" ) {
					el.hide();
				}
				$.effects.restore( el, props );
				$.effects.removeWrapper( el );
				$.isFunction( o.complete ) && o.complete.apply( this, arguments );
				next();
			});

		// inject all the animations we just queued to be first in line (after "inprogress")
		if ( queuelen > 1) {
			queue.splice.apply( queue,
				[ 1, 0 ].concat( queue.splice( queuelen, anims + 1 ) ) );
		}
		el.dequeue();
	});

};

})(jQuery);
