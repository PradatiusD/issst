  angular.module('issstApp',['ngSanitize'])
  
  .controller('CloudsController',['$scope', function($scope){
    $scope.clouds = [];
    for (var i = 0; i < 10; i++) {
      $scope.clouds.push({
        x: Math.random() * 100,                // x is in percents
        y: Math.max(58, Math.random() * 300),  // y is in pixels
        opacity: Math.max(0.5, Math.random()), // opacity is in percentages
        size: Math.max(6, Math.random() * 11)  // size is in ems
      });
    }
  }])
  
  .directive('cloudFlying', function(){
    return {
      template: '<i class="fa fa-cloud blue" style="position: absolute;top: {{cloud.y}}px;right: {{cloud.x}}%;opacity: 0; font-size:{{cloud.size}}em"></i>',
      link: function(scope, element, attrs) {

        // var distanceToTravel = window.innerWidth - scope.cloud.x;
        var $cloud = jQuery(element).find('.fa-cloud');

        function moveCloud($cloud){
          
          $cloud.css({
            'transform': '',
            'right': 0,
            'opacity': scope.cloud.opacity
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
    };
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
    var themePath = 'http://issst2015.net/wp-content/themes/issst2015/';

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
    };

    console.log($scope.feed);
  }]);