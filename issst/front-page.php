<?php get_header(); ?>


<section class="top-box" id="header-slides">
	<div class="container">
		<div class="row">
			<main class="col-md-11">
				<div class="issst-opening">
					<p>Be a</p>
					<span id="prefix">scien</span>
					<img class="issst-logo" src="<?php echo get_template_directory_uri();?>/img/issst.png" alt="">
				</div>
			</main>
		</div>
	</div>
</section>
<section>	
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Welcome to ISSST</h1>
				<p class="lead">ISSST is the International Symposium on Sustainable Systems & Technology.  This is a reunion, a gathering, a sleep over, of the foremost thinkers in sustainability thinking.</p>
			</div>
			<div class="col-md-3 pasta">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 avocado">
			</div>
			<div class="col-md-6">
				<h1>Welcome to ISSST</h1>
				<p class="lead">ISSST is the International Symposium on Sustainable Systems & Technology.  This is a reunion, a gathering, a sleep over, of the foremost thinkers in sustainability thinking.</p>
			</div>

		</div>
	</div>
</section>

<div id="maximage">
	<img src="http://localhost/issst/wp-content/themes/issst/img/slide1.jpg" alt="">
	<img src="http://localhost/issst/wp-content/themes/issst/img/slide2.jpg" alt="">
	<img src="http://localhost/issst/wp-content/themes/issst/img/slide3.jpg" alt="">
	<img src="http://localhost/issst/wp-content/themes/issst/img/slide4.jpg" alt="">
	<img src="http://localhost/issst/wp-content/themes/issst/img/slide5.jpg" alt="">
</div>


<script src="http://www.aaronvanderzwan.com/maximage/lib/js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
<script src="http://www.aaronvanderzwan.com/maximage/lib/js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
<script>

	(function ($){

		$prefixSelector = $('#prefix');

		function changePrefix (toText) {

			setTimeout( function () {

				$prefixSelector.addClass('animated fade-out');

			}, 0)

			setTimeout(function(){

				$prefixSelector
						.text(toText)
						.removeClass('animated fade-out')
						.addClass('animated fade-in');
			}, 1000);

		}

		prefixArray = ['art','theor','activ','ethic', 'optim','natur','futur', 'technolog', 'scient']; // 'environmental', too long

		var i = 0;

		setInterval(function(){
			changePrefix(prefixArray[i++ % prefixArray.length]);

		},3000);


		$('#maximage').maximage({
			cycleOptions: {
				fx: 'fade',
				speed: 1000, // Set the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
				timeout: 1000,
				pause: 1
			},
			fillElement: '#holder',
			backgroundSize: 'contain'
		});



	})(jQuery);
</script>
<?php get_footer(); ?>