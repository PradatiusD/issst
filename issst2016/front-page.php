<?php

function homepage_header (){
  ?>
  <section class="conference-header">
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
    <video id="my-video" class="video-js" autoplay loop preload width="1278" height="720" poster="<?php echo get_stylesheet_directory_uri();?>/img/video-poster.jpg" data-setup="{}">
      
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



function register_homepage_video_scripts() {
  wp_enqueue_script('video-js-ie8' , "http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js", array(), '1.1.0', false);
  wp_enqueue_style( 'video-js-css' , "http://vjs.zencdn.net/5.0.2/video-js.css"          , array(), '5.0.2', 'all');
  wp_enqueue_script('video-js-main', "http://vjs.zencdn.net/5.0.2/video.js"              , array(), '5.0.2', true);
}



add_action('wp_enqueue_scripts', 'register_homepage_video_scripts');
add_action('genesis_before_loop','homepage_header');
add_action('genesis_before_loop','conference_video');
remove_action( 'genesis_loop', 'genesis_do_loop');

add_filter('genesis_pre_get_option_site_layout','__genesis_return_full_width_content');


genesis();

?>