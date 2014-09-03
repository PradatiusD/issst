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
</section>
<style>
  html {
    margin-top: 0 !important;
  }
</style>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
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
<?php get_footer(); ?>