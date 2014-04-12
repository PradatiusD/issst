<?php get_header(); ?>


<section class="top-box" id="header-slides">
	<div class="container">
		<div class="row">
			<main class="col-md-11">
				<div class="issst-opening">
					<p>be a</p><p id="n" style="width:0px">n</p><br>
					<span id="prefix">scien</span>
					<img class="issst-logo" src="<?php echo get_template_directory_uri();?>/img/issst.png" alt="">
				</div>
			</main>
		</div>
	</div>
</section>
<div class="rest-of-content">

	<div class="container">
		<section class="row">
			<div class="col-md-8">
				<h1>Welcome to ISSST</h1>
				<p class="lead">The <strong>International Symposium on Sustainable Systems and Technology</strong> (ISSST) covers the spectrum of issues for assessing and managing products and services across their life cycle, and the design, management, and policy implications of sustainable engineered systems and technologies.</p>
				<div class="row">
					<div class="col-md-6">
						<p><strong>Authors</strong> are invited to submit papers describing research, applications, tools, and case studies addressing the topics below. Proceedings will be distributed exclusively to the conference participants and authors may retain copyrights to the submitted papers, or elect to submit their papers for consideration in sustainability-related journals.</p>				
					</div>
					<div class="col-md-6">
						<p><strong>Students</strong> are especially encouraged to attend and can participate in special paper and poster competitions, judged by leading academics and researchers from government and industry.</p>
					</div>				
				</div>
			</div>
			<div class="col-md-4 pasta">
			</div>
		</section>
		<section class="row">
			<div class="col-md-6">
				<div id="map-canvas"></div>
			</div>
			<div class="col-md-6">
				<h1>Welcome to Oakland</h1>
				<p class="lead">This year’s conference will be held in Oakland, California at the Marriott City Center from <strong>19-21 May, 2014</strong>.</p>
				<p>A pre-conference workshop will be held on May 18th, and a post-conference workshops will be held on May 22nd.</p>
				<p>Information on registration and the schedule will be available soon. If you have any questions, direct them to <a href="mailto:ISSSTNetwork@gmail.com">ISSSTNetwork@gmail.com</a>.</p>
				<p><a href="https://www.regonline.com/builder/site/?eventid=1482855" class="btn btn-primary btn-large btn-success btn-block register-now">Register Now!</a></p>
			</div>
		</section>

		<section class="row program-schedule">
			<div class="col-md-12">
			<?php 
			$programPost = get_post(1714); //Production
			// $programPost = get_post(1595); //Local
			?>
	
			<h1><?php echo $programPost->post_title; ?></h1>
			<div><?php echo $programPost->post_content; ?></div>
		</section>

		<section class="row">
			<div class="col-md-6 col-md-offset-3 mailchimp-join-list">
				<h1>Want to get PISSST weekly?</h1>
				<p class="lead">Sign up to be part of Proceedings from the International Symposium on Sustainable Systems & Technology, better known as PISSST.</p>

				<!-- Begin MailChimp Signup Form -->
				<div id="mc_embed_signup">
					<form action="http://wordpress.us6.list-manage1.com/subscribe/post?u=9c4c3f7f77bdb09de3fa52e0a&amp;id=8f5c8a5f2d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
						<div class="mc-field-group">
							<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
						</label>
							<input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL">
						</div>
						<br>
						<div class="row">
							<div class="mc-field-group col-md-6">
								<label for="mce-FNAME">First Name </label>
								<input type="text" value="" name="FNAME" class="form-control" id="mce-FNAME">
							</div>
							<div class="mc-field-group col-md-6">
								<label for="mce-LNAME">Last Name </label>
								<input type="text" value="" name="LNAME" class="form-control" id="mce-LNAME">
							</div>
						</div>
						<br>
						<div class="mc-field-group input-group">
						    <strong>Email Format </strong>
						    <div class="radio">
						    	<label for="mce-EMAILTYPE-1">
						    		<input type="radio" value="text" name="EMAILTYPE" id="mce-EMAILTYPE-1">
						    		text
						    	</label>
						    </div>
						    <div class="radio">
					    		<label for="mce-EMAILTYPE-0">
					    			<input type="radio" value="html" name="EMAILTYPE" id="mce-EMAILTYPE-0">
					    			html
					    		</label>					    	
						    </div>
						</div>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    <div style="position: absolute; left: -5000px;"><input type="text" name="b_9c4c3f7f77bdb09de3fa52e0a_8f5c8a5f2d" value=""></div>
							<div class="clear text-center">
								<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary btn-lg btn-success">
							</div>
					</form>
				</div>
				<script type="text/javascript">
				var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';
				try {
				    var jqueryLoaded=jQuery;
				    jqueryLoaded=true;
				} catch(err) {
				    var jqueryLoaded=false;
				}
				var head= document.getElementsByTagName('head')[0];
				if (!jqueryLoaded) {
				    var script = document.createElement('script');
				    script.type = 'text/javascript';
				    script.src = '//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
				    head.appendChild(script);
				    if (script.readyState && script.onload!==null){
				        script.onreadystatechange= function () {
				              if (this.readyState == 'complete') mce_preload_check();
				        }    
				    }
				}

				var err_style = '';
				try{
				    err_style = mc_custom_error_style;
				} catch(e){
				    err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
				}
				var head= document.getElementsByTagName('head')[0];
				var style= document.createElement('style');
				style.type= 'text/css';
				if (style.styleSheet) {
				  style.styleSheet.cssText = err_style;
				} else {
				  style.appendChild(document.createTextNode(err_style));
				}
				head.appendChild(style);
				setTimeout('mce_preload_check();', 250);

				var mce_preload_checks = 0;
				function mce_preload_check(){
				    if (mce_preload_checks>40) return;
				    mce_preload_checks++;
				    try {
				        var jqueryLoaded=jQuery;
				    } catch(err) {
				        setTimeout('mce_preload_check();', 250);
				        return;
				    }
				    var script = document.createElement('script');
				    script.type = 'text/javascript';
				    script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
				    head.appendChild(script);
				    try {
				        var validatorLoaded=jQuery("#fake-form").validate({});
				    } catch(err) {
				        setTimeout('mce_preload_check();', 250);
				        return;
				    }
				    mce_init_form();
				}
				function mce_init_form(){
				    jQuery(document).ready( function($) {
				      var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
				      var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
				      $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
				      options = { url: 'http://wordpress.us6.list-manage.com/subscribe/post-json?u=9c4c3f7f77bdb09de3fa52e0a&id=8f5c8a5f2d&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
				                    beforeSubmit: function(){
				                        $('#mce_tmp_error_msg').remove();
				                        $('.datefield','#mc_embed_signup').each(
				                            function(){
				                                var txt = 'filled';
				                                var fields = new Array();
				                                var i = 0;
				                                $(':text', this).each(
				                                    function(){
				                                        fields[i] = this;
				                                        i++;
				                                    });
				                                $(':hidden', this).each(
				                                    function(){
				                                        var bday = false;
				                                        if (fields.length == 2){
				                                            bday = true;
				                                            fields[2] = {'value':1970};//trick birthdays into having years
				                                        }
				                                    	if ( fields[0].value=='MM' && fields[1].value=='DD' && (fields[2].value=='YYYY' || (bday && fields[2].value==1970) ) ){
				                                    		this.value = '';
													    } else if ( fields[0].value=='' && fields[1].value=='' && (fields[2].value=='' || (bday && fields[2].value==1970) ) ){
				                                    		this.value = '';
													    } else {
													        if (/\[day\]/.test(fields[0].name)){
				    	                                        this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
													        } else {
				    	                                        this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
					                                        }
					                                    }
				                                    });
				                            });
				                        $('.phonefield-us','#mc_embed_signup').each(
				                            function(){
				                                var fields = new Array();
				                                var i = 0;
				                                $(':text', this).each(
				                                    function(){
				                                        fields[i] = this;
				                                        i++;
				                                    });
				                                $(':hidden', this).each(
				                                    function(){
				                                        if ( fields[0].value.length != 3 || fields[1].value.length!=3 || fields[2].value.length!=4 ){
				                                    		this.value = '';
													    } else {
													        this.value = 'filled';
					                                    }
				                                    });
				                            });
				                        return mce_validator.form();
				                    }, 
				                    success: mce_success_cb
				                };
				      $('#mc-embedded-subscribe-form').ajaxForm(options);
				      
				      
				    });
				}
				function mce_success_cb(resp){
				    $('#mce-success-response').hide();
				    $('#mce-error-response').hide();
				    if (resp.result=="success"){
				        $('#mce-'+resp.result+'-response').show();
				        $('#mce-'+resp.result+'-response').html(resp.msg);
				        $('#mc-embedded-subscribe-form').each(function(){
				            this.reset();
				    	});
				    } else {
				        var index = -1;
				        var msg;
				        try {
				            var parts = resp.msg.split(' - ',2);
				            if (parts[1]==undefined){
				                msg = resp.msg;
				            } else {
				                i = parseInt(parts[0]);
				                if (i.toString() == parts[0]){
				                    index = parts[0];
				                    msg = parts[1];
				                } else {
				                    index = -1;
				                    msg = resp.msg;
				                }
				            }
				        } catch(e){
				            index = -1;
				            msg = resp.msg;
				        }
				        try{
				            if (index== -1){
				                $('#mce-'+resp.result+'-response').show();
				                $('#mce-'+resp.result+'-response').html(msg);            
				            } else {
				                err_id = 'mce_tmp_error_msg';
				                html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
				                
				                var input_id = '#mc_embed_signup';
				                var f = $(input_id);
				                if (ftypes[index]=='address'){
				                    input_id = '#mce-'+fnames[index]+'-addr1';
				                    f = $(input_id).parent().parent().get(0);
				                } else if (ftypes[index]=='date'){
				                    input_id = '#mce-'+fnames[index]+'-month';
				                    f = $(input_id).parent().parent().get(0);
				                } else {
				                    input_id = '#mce-'+fnames[index];
				                    f = $().parent(input_id).get(0);
				                }
				                if (f){
				                    $(f).append(html);
				                    $(input_id).focus();
				                } else {
				                    $('#mce-'+resp.result+'-response').show();
				                    $('#mce-'+resp.result+'-response').html(msg);
				                }
				            }
				        } catch(e){
				            $('#mce-'+resp.result+'-response').show();
				            $('#mce-'+resp.result+'-response').html(msg);
				        }
				    }
				}

				</script>
				<!--End mc_embed_signup-->
			</div>

		</section>
	</div>
	<div class="partners" style="margin-bottom: -70px; margin-top: 2em;">
		<div class="container">
			<section class="row">
				<div class="col-md-12">
					<h1>Say hello!</h1>
					<p class="lead">To our wonderful set of partners!  Please on them click to find more about their conferences.</p>
					<div class="logos">
						<a href="http://www.care-electronics.net/CI2014/">
							<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/img/partner-care.jpg" alt="">
						</a>
						<a href="http://www.egg2012.de/">
							<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/img/partner-egg.jpg" alt="">							
						</a>
						<a href="http://ecodesign.or.kr/sub/overview.asp">
							<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/img/partner-eco-design.jpg" alt="">						
						</a>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

<div id="maximage">
	<img src="<?php bloginfo('template_url'); ?>/img/slide1.jpg" alt="">
	<img src="<?php bloginfo('template_url'); ?>/img/slide2.jpg" alt="">
	<img src="<?php bloginfo('template_url'); ?>/img/slide3.jpg" alt="">
	<img src="<?php bloginfo('template_url'); ?>/img/slide4.jpg" alt="">
	<img src="<?php bloginfo('template_url'); ?>/img/slide5.jpg" alt="">
	<img src="<?php bloginfo('template_url'); ?>/img/slide6.jpg" alt="">
	<img src="<?php bloginfo('template_url'); ?>/img/slide7.jpg" alt="">
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
</script>
<script>

	(function ($){

		var $n = $('#n');

		function squeeze () {

			$n.removeClass('expand squeeze');
			$n.addClass('squeeze');

			setTimeout(function(){
				$n.css('width','0px')
			}, 1000)

		}

		function expand () {

			$n.removeClass('expand squeeze');
			$n.addClass('expand');

			setTimeout(function(){
				$n.css('width','');
			}, 1000)

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
		// 'environmental', too long
		// Idea Altruist Biologist

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
<style>
	html {
		margin-top: 0 !important;
	}
</style>
<?php get_footer(); ?>