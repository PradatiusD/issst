(function ($) {

	var $confHeader = $('#conf-header');
	$confHeader.idealRatio = 768/1283;

	var $win = $(window);

	function adjustHeaderAndVideoSizing (e) {
		var width = e.target.innerWidth;

		$confHeader.css('min-height', width * $confHeader.idealRatio);

		var $phoenixSkyline = $('#my-video');
		$phoenixSkyline.idealRatio = 0.56338028169;  // or 240/426;

		$phoenixSkyline.css({
			width: width,
			height: width * $phoenixSkyline.idealRatio
		});
	}


	// On Initialization
	adjustHeaderAndVideoSizing({
		target: {
			innerWidth: $win.width()
		}
	});

	// On Reize
	$win.resize(adjustHeaderAndVideoSizing);

})(jQuery);