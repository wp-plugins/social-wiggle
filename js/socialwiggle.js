var $SOCWIG = $SOCWIG || {};
(function( $SOCWIG, $, undefined ) {
	$SOCWIG.unbind = function() {
		$('.socwig-container').each(function() {
			if (this.interval) {
				clearInterval(this.interval);
				this.interval = null;
			}
		}).find('a').unbind('.socwig');
	};
	
	$SOCWIG.init = function() {
		$('.socwig-container.socwig-wiggle-on-start').each(function() {
			var duration = $(this).data('wiggle-duration') || 3;
			var $buttons = $(this).find('a');
			$buttons.SocialWiggle('start', {limit: duration});
			var interval = null;
			var count = $buttons.size();
		});
		
		$('.socwig-container.socwig-wiggle-randomly').each(function() {
			var duration = $(this).data('wiggle-duration') || 3;
			var delay = $(this).data('wiggle-delay') || 1000;
			var $buttons = $(this).find('a');
			this.interval = null;
			var count = $buttons.size();
			this.interval = setInterval(function() {
				$($buttons.get(Math.floor(Math.random() * count))).SocialWiggle('start', {limit: duration});
			}, delay);
		});
		
		$('.socwig-container.socwig-wiggle-on-hover a').bind('mouseenter.socwig', function() {
				$(this).SocialWiggle('start', {limit: 2});
		});
	};
}( $SOCWIG, jQuery ));

/*!
 * SocialWiggle is powered by jQuery ClassyWiggle
 * http://www.class.pm/projects/jquery/classywiggle
 *
 * Copyright 2011 - 2013, Class.PM www.class.pm
 * Written by Marius Stanciu - Sergiu <marius@picozu.net>
 * Licensed under the GPL Version 3 license.
 * Version 1.1.0
 *
 */
(function($) {
    $.fn.SocialWiggle = function(method, options) {
        options = $.extend({
            degrees: ['2','4','2','0','-2','-4','-2','0'],
            delay: 35,
            limit: null,
            randomStart: true,
            onWiggle: function(o) {},
            onWiggleStart: function(o) {},
            onWiggleStop: function(o) {}
        }, options);
        var methods = {
            wiggle: function(o, step){
                if (step === undefined) {
                    step = options.randomStart ? Math.floor(Math.random() * options.degrees.length) : 0;
                }
                if (!$(o).hasClass('wiggling')) {
                    $(o).addClass('wiggling');
                }
                var degree = options.degrees[step];
                $(o).css({
                    '-webkit-transform': 'rotate(' + degree + 'deg)',
                    '-moz-transform': 'rotate(' + degree + 'deg)',
                    '-o-transform': 'rotate(' + degree + 'deg)',
                    '-sand-transform': 'rotate(' + degree + 'deg)',
                    'transform': 'rotate(' + degree + 'deg)'
                });
                if (step == (options.degrees.length - 1)) {
                    step = 0;
                    if ($(o).data('wiggles') === undefined) {
                        $(o).data('wiggles', 1);
                    }
                    else {
                        $(o).data('wiggles', $(o).data('wiggles') + 1);
                    }
                    options.onWiggle(o);
                }
                if (options.limit && $(o).data('wiggles') == options.limit) {
                    return methods.stop(o);
                }
                o.timeout = setTimeout(function() {
                    methods.wiggle(o, step + 1);
                }, options.delay);
            },
            stop: function(o) {
                $(o).data('wiggles', 0);
                $(o).css({
                    '-webkit-transform': '',
                    '-moz-transform': '',
                    '-o-transform': '',
                    '-sand-transform': '',
                    'transform': ''
                });
                if ($(o).hasClass('wiggling')) {
                    $(o).removeClass('wiggling');
                }
                clearTimeout(o.timeout);
                o.timeout = null;
                options.onWiggleStop(o);
            },
            isWiggling: function(o) {
                return !o.timeout ? false : true;
            }
        };
        if (method == 'isWiggling' && this.length == 1) {
            return methods.isWiggling(this[0]);
        }
        this.each(function() {
            if ((method == 'start' || method === undefined) && !this.timeout) {
                methods.wiggle(this);
                options.onWiggleStart(this);
            }
            else if (method == 'stop') {
                methods.stop(this);
            }
        });
        return this;
    }
})(jQuery);

jQuery(function($) {
	$SOCWIG.init();
});