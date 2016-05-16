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

function schedule () {
  ?>
  <section ng-app="ScheduleApp">
    <div ng-controller="ScheduleController" class="container">
      <h1 class="text-center">Conference Schedule</h1>
      <hr>
      <section ng-repeat="(day, events) in days">
        <h2>{{day}}</h2>
        <article ng-repeat="event in events | orderBy:eventOrder">
          <h3>
            {{event["Session Title"]}}  <i class="ion-information-circled text-small" ng-if="event.Description.length > 10" ng-click="event.display = !event.display"></i><br>
            <small class="text-muted">{{event["Time Start"]}} - {{event["Time End"]}}</small>
          </h3>

          <footer ng-bind-html="trustSnippet(event.Description)" ng-show="event.display"></footer>
          <hr>
        </article>
      </section>
    </div>
  </section>
  <?php
}


function homepage_scripts() {

  // For D3
  wp_enqueue_script('d3js', "http://d3js.org/d3.v3.min.js", array(), '1.0.0', true);

  // For Moment.js
  wp_enqueue_script('momentjs',    get_stylesheet_directory_uri() . '/js/moment.js', array(), '2.10.0', true);

  // Angular.js
  wp_enqueue_script('angular',     get_stylesheet_directory_uri() . '/js/angular.js' , array(), '1.0.0', true);

  // Homepage Main Script
  wp_enqueue_script('homepage-js',  get_stylesheet_directory_uri() . '/js/homepage.js' , array('jquery','d3js','momentjs'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'homepage_scripts');

add_action('genesis_before_loop','homepage_header');
add_action('genesis_before_loop','neural_network');
add_action('genesis_before_loop','schedule');

remove_action( 'genesis_loop', 'genesis_do_loop');

add_filter('genesis_pre_get_option_site_layout','__genesis_return_full_width_content');


genesis();

?>