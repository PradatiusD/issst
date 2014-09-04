<?php get_header(); ?>
<section class="container">
  <div class="row">
    <div class="col-md-12">
      <img src="<?php echo get_stylesheet_directory_uri()."/img/issst-2015-header.png";?>" class="img-responsive" style="margin:6em auto 1em;">   
    </div>

    <aside ng-app="CoolHomepageApp">
      <div ng-controller="CloudsController">
        <div ng-repeat="cloud in clouds">
          <div cloud-flying></div>        
        </div>
      </div> 
    </aside>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h1>Our Team</h1>
      <p class="lead">Big thanks to the organizing committee hard at work making this ISSST the best one yet!</p>
      <hr>
      <section class="conference-committee" id="container">
        
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
        ?>

              <article class="item item-<?php echo $j;?>">
                <div>
                  <h1><?php the_title();?></h1>
                  <?php echo $custom["wpcf-org-title"][0];?>                
                </div>
                <?php the_post_thumbnail('thumbnail');?>
              </article>

              <aside class="item item-<?php echo $j;?>">
                <?php
                  $custom = get_post_custom($post->ID);
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
</section>
<style>
  html {
    margin-top: 0 !important;
  }
</style>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.9/jquery.transit.min.js"></script>
<script>
  angular.module('CoolHomepageApp',[])
  
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

        moveCloud($cloud);

      }
    }
  });
</script>
<script>
  (function hoverMatchImg ($){

    var $container = $('#container');
    var $items     = $container.find('.item');

    $items.hover(
      function(){
        var classes = $(this).attr('class');
        var number = parseInt(classes.match(/[0-999]/g).join(''));
        $container.find('.item-'+number).find('img').toggleClass('hovered');
      },
      function(){
        $container.find('img').removeClass('hovered');
      }
    );

    var $articles = $container.find('article');

    $articles.click(function(){
      $articles.find('div').removeClass('clicked animated fade-in');
      $(this).find('div').addClass('clicked animated fade-in');
    });

    // Shuffle all items
    while ($items.length) {
      $container.append($items.splice(Math.floor(Math.random() * $items.length), 1)[0]);
    }

    // Now start isotope
    $container.isotope();

  })(jQuery);
</script>
</script>
<?php get_footer(); ?>