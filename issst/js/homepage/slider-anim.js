(function headerISTAnimation($){

	var $n = $('#n');

	function squeeze () {

		$n.removeClass('expand squeeze');
		$n.addClass('squeeze');

		setTimeout(function(){
			$n.css('width','0px');
		}, 1000);

	}

	function expand () {

		$n.removeClass('expand squeeze');
		$n.addClass('expand');

		setTimeout(function(){
			$n.css('width','');
		}, 1000);

	}

	$prefixSelector = $('#prefix');

	function changePrefix (toText) {

		setTimeout( function () {

			$prefixSelector.addClass('animated fade-out');

			if (toText.charAt('0') === 'a' || toText.charAt('0') === 'e' || toText.charAt('0') === 'i' || toText.charAt('0') === 'o' || toText.charAt('0') === 'u') {

				expand();

			} else {

				squeeze();
			}


		}, 0);

		setTimeout(function(){

			$prefixSelector
					.text(toText)
					.removeClass('animated fade-out')
					.addClass('animated fade-in');

		}, 1000);

	}

	prefixArray = ['art','theor','activ','ethic', 'optim','natural','futur', 'technolog', 'scient', 'human','ecolog','special'];

	var i = 0;

	setInterval(function(){
		changePrefix(prefixArray[i++ % prefixArray.length]);

	},3000);


	$('#maximage').maximage({
		cycleOptions: {
			fx: 'fade',
			speed: 1000,
			timeout: 1000,
			pause: 1
		},
		fillElement: '#holder',
		backgroundSize: 'contain'
	});

})(jQuery);