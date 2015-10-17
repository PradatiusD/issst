# ISSST network

<!-- grunt 2016sass && grunt 2016 -->

<div class="container">
	<section class="text-center">
	  <p class="h1">ISSST 2016</p>
	  <p class="h3">17-19 May in Phoenix, AZ</p>
	  50 E Adams St, Phoenix, AZ 85004
	</section>
</div>
<?php

// Custom fonts
function custom_fonts() {
    wp_dequeue_style('custom_fonts');
    wp_enqueue_style('custom_fonts','//fonts.googleapis.com/css?family=Droid+Sans:400,700|Oswald:400,700', array(), '1.0');    
}

add_action('wp_enqueue_scripts','custom_fonts');