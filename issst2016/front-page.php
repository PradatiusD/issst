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

function conference_video () {
  ?>
  <div class="skyline-container">
    <div class="black-overlay">
      <div class="message">
        <div class="purple-bg">        
          <h2>16-18 May 2016<small>Phoenix, AZ</small></h2>
          <a href="https://www.conftool.net/issst2016/" target="_blank" class="btn btn-primary">
            <i class="ion-compose"></i> Register for ISSST
          </a>
        </div>
      </div>
    </div>
    <video id="my-video" class="video-js" autoplay loop preload poster="<?php echo get_stylesheet_directory_uri();?>/img/video-poster.jpg" data-setup="{}">
      <source src="<?php echo get_stylesheet_directory_uri();?>/assets/phoenix_skyline.mp4" type='video/mp4'>
      <!-- <source src="MY_VIDEO.webm" type='video/webm'> -->
      <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a web browser that
        <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
      </p>
    </video>
  </div>
  <?php
}

function neural_network() {
  ?>
  <div class="neural-network">
    <svg id="neural-network"></svg>
    <h2>
      ISSST Builds a growing family<br>
      of scientists committed to sustainabilty<br>
    </h2>
  </div>
  <?php
}


function homepage_scripts() {

  // For Video
  wp_enqueue_script('video-js-ie8' , "http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js", array(), '1.1.0', false);
  wp_enqueue_style( 'video-js-css' , "http://vjs.zencdn.net/5.0.2/video-js.css"          , array(), '5.0.2', 'all');
  wp_enqueue_script('video-js-main', "http://vjs.zencdn.net/5.0.2/video.js"              , array(), '5.0.2', true);

  // For D3
  wp_enqueue_script('d3js', "http://d3js.org/d3.v3.min.js", array(), '1.0.0', true);

  // For Resizing
  wp_enqueue_script('homepage-js',  get_stylesheet_directory_uri() . '/js/homepage.js' , array('jquery'), '1.0.0', true);  
}



add_action('wp_enqueue_scripts', 'homepage_scripts');

add_action('genesis_before_loop','homepage_header');
add_action('genesis_before_loop','conference_video');
add_action('genesis_before_loop','neural_network');

remove_action( 'genesis_loop', 'genesis_do_loop');

add_filter('genesis_pre_get_option_site_layout','__genesis_return_full_width_content');


genesis();

?>