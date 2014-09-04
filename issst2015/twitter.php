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

/**
 * Send a GET call with set parameters
 */

?>