<?php get_header(); ?>
<section class="container">
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
?>
  <div class="row">
    <div class="col-md-12">
      <img src="<?php echo get_stylesheet_directory_uri()."/img/issst-2015-header.png";?>" class="img-responsive" style="margin:6em auto 1em;">   
    </div>

    <aside class="cloudWrap invisible">
      <div ng-controller="CloudsController">
        <div ng-repeat="cloud in clouds">
          <div cloud-flying></div>        
        </div>
      </div> 
    </aside>
  </div>

</section>

<div class="homeBlue">
  <section class="container">

    <div class="row">
      <div class="col-md-12">
        <h1>Our Team</h1>
        <section class="conference-committee invisible" id="container">
          
          <?php
          
            $args = array (
              'post_type' => '2015-team',
              'post_status' => 'publish',
              'nopaging'=> true
            );
            
            $wp_query = new WP_Query($args);

            $j = 0;

            if ( $wp_query->have_posts() ):

              while ( $wp_query->have_posts() ) : $wp_query->the_post();
                $custom = get_post_custom($post->ID);
          ?>

                <article class="item item-<?php echo $j;?>">
                  <div>
                    <h1><?php the_title();?></h1>
                    <?php echo $custom["wpcf-org-title"][0];?>                
                  </div>
                  <?php the_post_thumbnail(array(160, 160));?>
                </article>

                <aside class="item item-<?php echo $j;?>">
                  <?php
                    $member_institution = $custom["wpcf-institution-logo"][0];
                    echo "<img src='$member_institution'/>";
                  ?>
                </aside>
          <?php
            $j++;
            endwhile;
          else:
            echo '<h2>No Team Members found/h2>';
          endif;
          ?>
          
        </section>
        <br>
      </div>
    </div>
    <div class="row">

      <!-- Windmills -->
    <style>
      .fan-holder {
          position: relative;
          display: inline-block;
      }

      .pole, .blades {
        width: 100%;
        height: auto;
      }

      .blades {
          position: absolute;
      }

      .spinny {
        -webkit-animation-name: spin;
        -webkit-animation-duration: 2000ms;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
        -moz-animation-name: spin;
        -moz-animation-duration: 2000ms;
        -moz-animation-iteration-count: infinite;
        -moz-animation-timing-function: linear;
        -ms-animation-name: spin;
        -ms-animation-duration: 2000ms;
        -ms-animation-iteration-count: infinite;
        -ms-animation-timing-function: linear;
        
        animation-name: spin;
        animation-duration: 2000ms;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
      }

      @-ms-keyframes spin {
          from { -ms-transform: rotate(0deg); }
          to { -ms-transform: rotate(360deg); }
      }
      @-moz-keyframes spin {
          from { -moz-transform: rotate(0deg); }
          to { -moz-transform: rotate(360deg); }
      }
      @-webkit-keyframes spin {
          from { -webkit-transform: rotate(0deg); }
          to { -webkit-transform: rotate(360deg); }
      }
      @keyframes spin {
          from {
              transform:rotate(0deg);
          }
          to {
              transform:rotate(360deg);
          }
      }
      </style>
      <div ng-controller="fanController" class="col-md-7">
        <span ng-repeat="fan in fans">
          <span spinning-fan></span>
        </span>
      </div> 

      <!-- End Windmills -->
        <?php
          require('twitter.php');
          $params = array(
              'q' => '#issst2015',
              'count' => 10,
              'exclude_replies' => true
          );


          $response = $tw->get('search/tweets', $params);
        ?>
      <script>
        var twitterFeed = <?php print_r(json_encode($response));?>;
      </script>

      <!-- Twitter Feed -->

      <div ng-controller="TwitterController" class="col-md-5">
        <h1>Follow <a href="https://twitter.com/search?q=%23ISSST2015&src=typd">#ISSST2015</a>!</h1>
        <hr>
          <div ng-repeat="status in feed.statuses" class="row">

            <aside class="col-xs-2">
              <img ng-src="{{status.user.profile_image_url}}" alt="" class="twit-img">
            </aside>

            <section class="col-xs-10">
              <p class="lead">
                <strong>{{status.user.name}}</strong> 
                <a class="text-muted small" target="_blank"href="http://twitter.com/@{{status.user.screen_name}}">@{{status.user.screen_name}}</a><br>
                <span ng-bind-html="status.text | linky"></span><br>
                <a href="http://{{status.entities.media[0].expanded_url}}" ng-show="status.entities.media[0]">
                  <img ng-src="{{status.entities.media[0].media_url}}" alt="" class="img-responsive img-rounded twit-media">                
                </a>
                <small>{{fixDate(status.created_at)}}</small>
              </p>
            </section>
            
            <hr>
          </div>
      </div>

      <!-- End Twitter Feed -->

    </div>
  </section>
</div>

<style>
  html {
    margin-top: 0 !important;
  }
</style>


<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-sanitize.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.9/jquery.transit.min.js"></script>
<script>
  angular.module('issstApp',['ngSanitize'])
  
  .controller('CloudsController',['$scope', function($scope){
    $scope.clouds = [];
    for (var i = 0; i < 10; i++) {
      $scope.clouds.push({
        x: Math.random() * 100,                // x is in percents
        y: Math.max(58, Math.random() * 300),  // y is in pixels
        opacity: Math.max(0.5, Math.random()), // opacity is in percentages
        size: Math.max(6, Math.random() * 11)  // size is in ems
      })
    };
  }])
  
  .directive('cloudFlying', function(){
    return {
      template: '<i class="fa fa-cloud blue" style="position: absolute;top: {{cloud.y}}px;right: {{cloud.x}}%;opacity:{{cloud.opacity}}; font-size:{{cloud.size}}em"></i>',
      link: function(scope, element, attrs) {

        // var distanceToTravel = window.innerWidth - scope.cloud.x;
        var $cloud = jQuery(element).find('.fa-cloud');

        function moveCloud($cloud){
          
          $cloud.css({
            'transform': '',
            'right': 0
          });
          
          $cloud.transition({
            x: -window.innerWidth,
            duration: Math.max(10000, Math.random()*20000), // take between 10s and 20s to go from end to end
            easing: 'linear',
            complete: function() {
              moveCloud($cloud);
            }
          });

        }

        jQuery('.cloudWrap')
        .removeClass('invisible')
        .addClass('animated fade-in');


        moveCloud($cloud);

      }
    }
  })

  .controller('fanController', ['$scope', function($scope) {
    
    $scope.fans = [];
    var widths = [250, 200, 150];

    for (var i = 0; i < widths.length; i++) {
      $scope.fans.push({
        width: widths[i]
      });
    }
  }])

  .directive('spinningFan', function() {
    var themePath = '<?php echo get_stylesheet_directory_uri();?>';

    return {
      template: '<div class="fan-holder" style="width:{{fan.width}}px;">'+
                  '<img src="'+themePath+'/img/blades.png" alt="" class="blades" style="top:{{.041*fan.width}}px; left:{{.011*fan.width}}px">'+
                  '<img src="'+themePath+'/img/pole.png" class="pole" alt="">'+
                '</div>',
      link: function(scope, element, attrs) {

        var $blades = jQuery(element).find('.blades');
        var timeToStart = scope.fan.width * 10;

        setTimeout(function(){
          $blades.toggleClass('spinny');
        }, timeToStart);
      }
    };
  })

  .controller('TwitterController',['$scope', '$filter', function($scope, $filter){
    $scope.feed = twitterFeed;

    $scope.fixDate = function(date){
      date = Date.parse(date);
      date = $filter('date')(date, 'MMM d, h:mma');
      return date;
    }

    console.log($scope.feed);
  }]);
</script>
<script>
  (function hoverMatchImg ($){

    var $container = $('#container');
    var $items     = $container.find('.item');

    // Remove Duplicates
    var images = [];

    $items.each(function(){
      var $this = $(this);

      if ($this.is('aside')) {
        
        var src = $this.find('img').attr('src');

        if (images.indexOf(src) === -1){
          images.push(src);
        } else {
          $this.remove();
        }
      }
    });


    // Shuffle all items
    // Have to requery DOM
    $items = $container.find('.item');

    while ($items.length) {
      $container.append($items.splice(Math.floor(Math.random() * $items.length), 1)[0]);
    }


    // Now start isotope
    $container
      .removeClass('invisible')
      .addClass('animated fade-up-in')
      .isotope();

  })(jQuery);
</script>
</script>
<?php get_footer(); ?>