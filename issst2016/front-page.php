<?php

function homepage_header (){
  ?>
  <section id="conf-header" class="conference-header">
    <div class="message">
      <h1 class="headline">ISSST</h1><br>
      <p class="tagline">
        where experts co-create knowledge<br>
        of sustainable technology systems</p>      
    </div>
  </section>
  <?php
}



function neural_network() {
  ?>
  <div class="neural-network">
    <svg id="neural-network"></svg>
    <h2>
      <span>ISSST</span> is a network<br>
      of <span>scientists</span>, <span>engineers</span>,<br> 
      <span>artists</span>, & <span>humanists</span><br>
      committed to creating and sharing<br>
      knowledge of sustainability
    </h2>
  </div>
  <?php
}

function hotel_info () {
  ?>
  <section class="hotel-info">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">  
        <p class="h1 text-center">16-18 May 2016<br><small>Phoenix, AZ</small></p>
        <p class="lead" style="margin-bottom:0;">Ensure your room at the Renaissance Phoenix Downtown Hotel now, at less than half the standard rate, before it overbooks due to the city-wide convention competing on the same week!</p>
      </div>
    </div>
    <hr>
    <div class="row text-center">
      <div class="col-sm-5 col-xs-6">
        <p class="h2" style="margin-top: 0;">
          <small>Regular Rate</small><br>
          $<span>329</span> per night
        </p>
      </div>
      <div class="col-sm-2 hidden-xs">
        <p class="h1 text-muted" style="margin-top: 0;">
          <span id="days-left"></span><br>
          <small class="text-uppercase">days left</small>
        </p>
      </div>

      <div class="col-sm-5 col-xs-6">
        <p class="h2" style="margin-top: 0;">
          <small>Our Rate</small><br>
          <span class="text-success">$<span id="countdown">329</span></span> per night
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 text-center">
        <div class="btn-group">
          <a href="https://resweb.passkey.com/go/SSST2016" target="_blank" class="btn btn-primary btn-lg">Book Hotel</a>
          <a href="https://www.regonline.com/ISSST2016" target="_blank" class="btn btn-primary btn-lg">Register for ISSST</a>
        </div>
      </div>
    </div>
  </section>
  <?php
}


function homepage_scripts() {

  // For D3
  wp_enqueue_script('d3js', "http://d3js.org/d3.v3.min.js", array(), '1.0.0', true);

  // For Moment.js
  wp_enqueue_script('momentjs', get_stylesheet_directory_uri() . '/js/moment.js', array(), '2.10.0', true);

  // Homepage Main Script
  wp_enqueue_script('homepage-js',  get_stylesheet_directory_uri() . '/js/homepage.js' , array('jquery','d3js','momentjs'), '1.0.0', true);  


}

add_action('wp_enqueue_scripts', 'homepage_scripts');

add_action('genesis_before_loop','homepage_header');
add_action('genesis_before_loop','neural_network');
add_action('genesis_before_loop','hotel_info');

remove_action( 'genesis_loop', 'genesis_do_loop');

add_filter('genesis_pre_get_option_site_layout','__genesis_return_full_width_content');


genesis();

?>