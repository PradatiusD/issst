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
				<p class="lead">The International Symposium on Sustainable Systems and Technology (ISSST) is the premier conference for research related to the sustainability of science and technology systems. The program covers the spectrum of issues for assessing and managing products and services across their life cycle, and the design, management, and policy implications of sustainable engineered systems and technologies.</p>
				<p><strong>Authors</strong> are invited to submit papers describing research, applications, tools, and case studies addressing the topics below. Proceedings will be distributed exclusively to the conference participants and authors may retain copyrights to the submitted papers, or elect to submit their papers for consideration in sustainability-related journals.</p>
				<p><strong>Students</strong> are especially encouraged to attend and can participate in special paper and poster competitions, judged by leading academics and researchers from government and industry.</p>
				<p>ISSST is entering its 20th successful year.  Between 1993 and 2008, the conference was known as the IEEE International Symposium on Electronics and the Environment (IEEE ISEE). In 2008, however, the scope of the conference was broadened to all industries and products while still maintaining a focus on the sustainability of information and communication technology (ICT) services. The new scope further strengthens this premier event on sustainable technology issues. Accordingly, the name has been changed to International Symposium on Sustainable Systems and Technology (ISSST).</p>
			</div>
			<div class="col-md-3 pasta">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div id="map-canvas"></div>
			</div>
			<div class="col-md-6">
				<h1>Welcome to Oakland</h1>
				<p class="lead">This year’s conference will be held in Oakland, California at the Marriott City Center from 19 May – 21 May, 2014, with a pre-conference workshop being held on May 18th, and post-conference workshops being held on May 22nd. Information on registration and the schedule will be available soon. If you have any questions, direct them to ISSSTNetwork@gmail.com.</p>
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

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="http://www.aaronvanderzwan.com/maximage/lib/js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
<script src="http://www.aaronvanderzwan.com/maximage/lib/js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
<script>
var issstHotel = new google.maps.LatLng(37.802206, -122.272897);
var map;
var marker;
var MY_MAPTYPE_ID = 'custom_style';

function initialize() {

	var featureOpts = [{
		stylers: [
			{ hue: '#d5f3d9' },
			{ visibility: 'simplified' },
			{ gamma: 0.75 },
			{ weight: 0.5 }
		]},
		{
			elementType: 'labels',
			stylers: [
				{ visibility: 'on' }
			]
		},
		{
			featureType: 'water',
			stylers: [
				{ color: '#4245ae' }
			]
		}
	];

	var mapOptions = {
		zoom: 12,
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
		},
		mapTypeId: MY_MAPTYPE_ID,
		center: issstHotel
	};

	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	marker = new google.maps.Marker({
		position: issstHotel,
		map: map,
		title: 'Hello World!'
	});

	var contentString = 
		'<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<h4>Marriott City Center</h4>'+
			'<div id="bodyContent">'+
				'<b>Address</b>: 1001 Broadway, Oakland, CA 94607<br>'+
				'<b>Phone:</b>(510) 451-4000</b>' +
			'</div>'+
		'</div>';

	var infowindow = new google.maps.InfoWindow({
	content: contentString
	});

	var styledMapOptions = {
		name: 'Custom Style'
	};

	var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

	map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	});
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
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