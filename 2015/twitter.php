<?php

require_once __DIR__ . '/TwitterOAuth/TwitterOAuth.php';
require_once __DIR__ . '/TwitterOAuth/Exception/TwitterException.php';


use TwitterOAuth\TwitterOAuth;

date_default_timezone_set('UTC');


/**
 * Array with the OAuth tokens provided by Twitter when you create application
 *
 * output_format - Optional - Values: text|json|array|object - Default: object
 */
$config = array(
   'consumer_key'       => 'Rnhs3w2BWaldhcNGoC0P5yJnu',
   'consumer_secret'    => 'x4gElNC9rH3nkc0XUnlkDbwEKf3tYC7ZNZebQPbWJLyOMr25td',
   'oauth_token'        => '838713331-CuGiqQKophIIoq9uPXYKHsStj4En46g3qvujBHOZ',
   'oauth_token_secret' => 'yIgo5aiVHgEY82Ltp3SryPmPwKSz2ektVafvoQp0uPAZN',
   'output_format'      => 'object'
);

/**
 * Instantiate TwitterOAuth class with set tokens
 */
$tw = new TwitterOAuth($config);


/**
 * Returns a collection of the most recent Tweets posted by the user
 * https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
 */

function twitter_feed() {

  global $tw;

/**
 * Send a GET call with set parameters
 */

	$params = array(
	  'q' => '#issst2015'
	);

	$response = $tw->get('search/tweets', $params);
	ob_start();
?>
  <script>
    var twitterFeed = <?php print_r(json_encode($response));?>;
  </script>

    <div ng-controller="TwitterController" class="twitterFeed">

      <h1>Follow <a href="https://twitter.com/search?q=%23ISSST2015&src=typd">#ISSST2015</a>!</h1>
      <hr>

      <article ng-repeat="status in feed.statuses">

        <section class="row">
          <aside class="col-xs-2">
            <a href="http://twitter.com/@{{status.user.screen_name}}" target="_blank">
              <img ng-src="{{status.user.profile_image_url}}" alt="" class="twit-img">
            </a>
          </aside>

          <section class="col-xs-10">
            <header>
              <strong ng-bind-html="status.user.name | linkUsername"></strong> 
              <a href="http://twitter.com/@{{status.user.screen_name}}" target="_blank" class="text-muted small">
                @{{status.user.screen_name}}
              </a>
            </header>
            <p class="lead tweet">
              <span ng-bind-html="status.text | tweet"></span><br>
              <a href="http://{{status.entities.media[0].expanded_url}}" ng-show="status.entities.media[0]">
                <img ng-src="{{status.entities.media[0].media_url}}" alt="" class="img-responsive img-rounded twit-media">                
              </a>
              <small>{{fixDate(status.created_at)}}</small>
            </p>
          </section>          
        </section>

        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
      </article>
    </div>

<?php
	$content = ob_get_clean();
	echo $content;
};