<?php get_header(); ?>

<section class="top-box">
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

<script>

	(function ($){

		$prefixSelector = $('#prefix');

		function changePrefix (toText) {

			console.log(toText)

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

		prefixArray = ['art','theor','activ','ethic', 'optim','natur','futur', 'environmental', 'technolog', 'scient']

		var i = 0;

		setInterval(function(){
			console.log(prefixArray[i++ % prefixArray.length]);
			changePrefix(prefixArray[i++ % prefixArray.length]);
		},3000);



	})(jQuery);
</script>
<?php get_footer(); ?>