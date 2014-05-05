(function googleMapHomepage(){

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
					'<b>Phone:</b>(510) 451-4000</b><br></br>' +
					'<a href="https://resweb.passkey.com/Resweb.do?mode=welcome_gi_new&groupID=20984319" class="btn btn-success btn-xs">Make a Reservation</a>'+
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

})();