jQuery(document).ready(function($) {
	$.admin_tabs = {
		init : function() {
			$("a.nav-tab").click( function(e) {
				e.preventDefault();

				$this = $(this);

				$this.parents(".nav-tab-wrapper:first").find(".nav-tab-active").removeClass("nav-tab-active");
				$this.addClass("nav-tab-active");

				$(".nav-container:visible").hide();

				var hash = $this.attr("href");

				$(hash+'_tab').show();

				//fix the referer so if changes are saved, we come back to the same tab
				var referer = $("input[name=_wp_http_referer]").val();
				if (referer.indexOf("#") >= 0) {
					referer = referer.substr(0, referer.indexOf("#"));
				}
				referer += hash;

				window.location.hash = hash;

				$("input[name=_wp_http_referer]").val(referer);
			});

			if (window.location.hash) {
				$('a.nav-tab[href="' + window.location.hash + '"]').click();
			}

			return false;
		}

	}; //End of admin_tabs

	$.admin_tabs.init();
    
	$(".socwig-table").tableDnD( { 
		dragHandle: ".socwig-dragme", 
		onDrop : function(table, row) {
			var sortOrder = $(table).tableDnDSerialize();
			$('#socwig-sort-order').val(sortOrder);
		}
	} );

	$('.socwig-table-check').click(function(e) {
		$(this).parents('tr:first').toggleClass('disabled');
		if ($('.socwig-table tbody tr.disabled').length > 0) {
			$('.column-cb input:checkbox').removeAttr('checked');
		} else {
			$('.column-cb input:checkbox').attr('checked', 'checked');
		}
	});
	
	$('.column-cb input:checkbox').click(function(e) {
		var $this = $(this);
		if ($this.is(':checked')) {
			$('.socwig-table-check').attr('checked', 'checked');
			$('.socwig-table tbody tr').removeClass('disabled');
		} else {
			$('.socwig-table-check').removeAttr('checked');
			$('.socwig-table tbody tr').addClass('disabled');
		}
	});
	
	$('.demo_drop_style, .demo_drop_wiggle').change(function() {
		$SOCWIG.unbind();

		var style = $('.demo_drop_style').val();
		var wiggle = $('.demo_drop_wiggle').val();

		if (style == 'rounded') {
			style = 'socwig-rounded';
		} else if (style == 'round') {
			style = 'socwig-round';
		}

		if (wiggle == 'random') {
			wiggle = 'socwig-wiggle-randomly';
		} else if (wiggle == 'start') {
			wiggle = 'socwig-wiggle-on-start';
		} else if (wiggle == 'hover') {
			wiggle = 'socwig-wiggle-on-hover';
		}

		$('.socwig-container')
			.removeClass('socwig-rounded socwig-round socwig-wiggle-randomly socwig-wiggle-on-hover socwig-wiggle-on-start')
			.addClass(style)
			.addClass(wiggle);

		$SOCWIG.init();		
	});

});